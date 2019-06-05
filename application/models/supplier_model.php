<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_Model extends CI_Model{



	public function __construct(){
		parent::__construct();
	}



	public function insert($data){
		return $this->db->insert('tblsupplier',$data);
	}



	// public function delete($id){
	// 	return $this->db->delete('tblsupplier',['id'=>$id]);
	// }



	public function update($id, $data){
		return $this->db->update('tblsupplier', $data, ['id' => $id]); 
	}



	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblsupplier');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblsupplier',['id' => $id]);
			return $result_set->row_array();
		}
	}



	public function find_active(){
		$result_set=$this->db->get_where('tblsupplier',['status' => '1']);
		return $result_set->result_array();
	}



	public function count_all(){
		return $this->db->count_all('tblsupplier');
	}
}

?>