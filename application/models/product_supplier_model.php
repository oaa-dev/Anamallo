<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Supplier_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function insert($data){
		return $this->db->insert('tblproduct_supplier',$data);
	}

	public function update($id, $data){
		return $this->db->update('tblproduct_supplier', $data, ['product_id' => $id]);
	}

	public function view($id=""){
		return $this->db->get_where('tblproduct_supplier',['product_id'=>$id])->result_array();
	}

	public function delete($data){
		return $this->db->delete('tblproduct_supplier', $data);
	}
}
?>