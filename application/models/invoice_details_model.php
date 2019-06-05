<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_Details_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	//insert data in tblinvoice_details
	public function insert($data){
		return $this->db->insert('tblinvoice_details',$data);
	}
	//update tblinvoice_details
	public function update($id, $data){
		return $this->db->update('tblinvoice_details', $data, ['id' => $id]);
	}
	//view tblinvoice_details all and by id
	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblinvoice_details');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblinvoice_details',['id' => $id]);
			return $result_set->row_array();
		}
	}
	//view invoice details by invoice id
	public function view_invoice($id=null){
		$result_set = $this->db->get_where('tblinvoice_details',['invoice_id' => $id]);
		return $result_set->result_array();
	}
	//find tblinvoice_details active status
	public function find_active(){
		$result_set=$this->db->get_where('tblinvoice_details',['status' => '1']);
		return $result_set->result_array();
	}
	//count all data in tblinvoice_details
	public function count_all(){
		return $this->db->count_all('tblinvoice_details');
	}
	//filter data, load first
	public function filter($data){
		$result_set = $this->db->join('tblinvoice', 'tblinvoice_details.invoice_id = tblinvoice.id')->join('tblproduct', 'tblinvoice_details.product_id = tblproduct.id')->get_where('tblinvoice_details',$data);
		return $result_set->result_array();			
	}
	//filter data, by parameter data
	public function filter_w_supplier($data){
		$result_set = $this->db->join('tblinvoice', 'tblinvoice_details.invoice_id = tblinvoice.id')->join('tblproduct', 'tblinvoice_details.product_id = tblproduct.id')->join('tblproduct_supplier', 'tblinvoice_details.product_id = tblproduct_supplier.product_id')->get_where('tblinvoice_details',$data);
		return $result_set->result_array();			
	}
}

?>