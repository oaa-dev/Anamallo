<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_Model extends CI_Model {



	public function __construct(){
		parent::__construct();
	}



	public function insert($data){
		return $this->db->insert('tblgroup', $data);
	}



	public function update($id, $data){
		return $this->db->update('tblgroup', $data, ['id' => $id]);
	}



	public function delete($id){
		return $this->db->delete('tblgroup', ['id' => $id]);
	}



	public function view($id=null){
		if($id==null){
			$result_set=$this->db->get_where('tblgroup', ['id !=' => 1]);
			return $result_set->result_array();
		}else{
			$result_set=$this->db->get_where('tblgroup', ['id' => $id]);
			return $result_set->row_array();
		}
	}



	public function getActive(){
		$result_set=$this->db->get_where('tblgroup', ['status' => 1, 'id !=' => 1]);
		return $result_set->result_array();
	}



	public function count_all(){
		return $this->db->count_all('tblgroup');
	}
}
?>