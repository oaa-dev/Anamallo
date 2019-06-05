<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_Model extends CI_Model{



	function __construct(){
		parent::__construct();
	}



	public function insert($data){
		return $this->db->insert('tblcategory',$data);
	}



	public function delete($id){
		return $this->db->delete('tblcategory',['id' => $id]); 
	}



	public function update($id, $data){
		return $this->db->update('tblcategory', $data, ['id' => $id]);
	}



	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblcategory');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblcategory',['id' => $id]);
			return $result_set->row_array();
		}
	}



	public function find_active(){
		$result_set=$this->db->get_where('tblcategory',['status' => '1']);
		return $result_set->result_array();
	}
}

?>