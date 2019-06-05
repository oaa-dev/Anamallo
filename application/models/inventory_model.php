<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function insert($data){
		return $this->db->insert('tblinventory',$data);
	}

	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblinventory');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblinventory',['id' => $id]);
			return $result_set->row_array();
		}
	}

	public function filter($data){
		$result_set = $this->db->select('date_time, tblinventory.product_id, user_id, price, quantity, total, action, category_id')->join('tblproduct', 'tblinventory.product_id = tblproduct.id')->join('tblproduct_supplier', 'tblinventory.product_id = tblproduct_supplier.product_id')->get_where('tblinventory',$data);
		return $result_set->result_array();			
	}

}
?>