<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_Model extends CI_Model{



	public function __construct(){
		parent::__construct();
	}



	public function insert($data){
		return $this->db->insert('tblpurchase',$data);
	}



	// public function delete($id){
	// 	return $this->db->delete('tblpurchase',['id'=>$id]);
	// }



	public function update($id, $data){
		return $this->db->update('tblpurchase', $data, ['id' => $id]);
	}



	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblpurchase');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblpurchase',['id' => $id]);
			return $result_set->row_array();
		}
	}

	public function view_by_range($from, $to){
		$result_set='';
		if(!empty($from)&&!empty($to)){
			$result_set = $this->db->get_where('tblpurchase',['date_supplied >='=>$from,'date_supplied <='=>$to]);
		}else{
			$result_set = $this->db->get('tblpurchase');
		}
		return $result_set->result_array();	
	}


	public function find_active(){
		$result_set=$this->db->get_where('tblpurchase',['status' => '1']);
		return $result_set->result_array();
	}



	public function get_id(){
		$this->db->select('*');
		$this->db->from('tblpurchase');
		$this->db->order_by('id', 'desc');
		$this->db->limit('1');
		return $this->db->get()->row_array()['id'];
	}



	public function count_all(){
		return $this->db->count_all('tblpurchase');
	}
}

?>