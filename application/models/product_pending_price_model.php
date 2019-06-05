<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Pending_Price_Model extends CI_Model{



	public function __construct(){
		parent::__construct();
	}

	public function insert($data){
		return $this->db->insert('tblproduct_price_pending',$data);
	}

	public function update($id,$data){
		return $this->db->update('tblproduct_price_pending',$data,['product_id'=>$id]);
	}

	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblproduct_price_pending');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblproduct_price_pending',['id' => $id]);
			return $result_set->row_array();
		}
	}
}
?>