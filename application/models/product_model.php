<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Model extends CI_Model{



	public function __construct(){
		parent::__construct();
	}



	public function insert($data){
		return $this->db->insert('tblproduct',$data);
	}



	// public function delete($id){
	// 	return $this->db->delete('tblproduct',['id'=>$id]);
	// }



	public function update($id, $data){
		return $this->db->update('tblproduct', $data, ['id' => $id]);
	}



	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblproduct');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblproduct',['id' => $id]);
			return $result_set->row_array();
		}
	}



	public function find_active(){
		$result_set=$this->db->get_where('tblproduct',['availability' => '1']);
		return $result_set->result_array();
	}



	public function count_all(){
		return $this->db->count_all('tblproduct');
	}



	public function count_all_available(){
		$this->db->where(['availability'=>1]);
		$this->db->from('tblproduct');
		return $this->db->count_all_results();
	}



	public function search_w_supplier($keyword){
		$result_set = $this->db->query('SELECT product.id as id,product,barcode,manufacturer_price,selling_price,stocks,category_id,brand_id,model_id,availability,minimum_quantity,supplier_id FROM tblproduct as product inner join tblproduct_supplier as supplier on product.id=supplier.product_id WHERE barcode='.$keyword.' AND availability=1');
		return $result_set->result_array();		
	}

	public function search($keyword){
		$result_set = $this->db->query('SELECT * FROM tblproduct WHERE barcode='.$keyword.' AND availability=1');
		return $result_set->row_array();		
	}

	public function get_id(){
		$this->db->select('*');
		$this->db->from('tblproduct');
		$this->db->order_by('id', 'desc');
		$this->db->limit('1');
		return $this->db->get()->row_array()['id'];
	}


	public function filter($data){
		$result_set = $this->db->get_where('tblproduct',$data);
		return $result_set->result_array();			
	}
}
?>