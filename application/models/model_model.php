<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Model extends CI_Model{



	function __construct(){
		parent::__construct();
	}



	public function insert($data){
		return $this->db->insert('tblmodel',$data);
	}



	public function update($id, $data){
		return $this->db->update('tblmodel', $data, ['id' => $id]);
	}



	// public function delete($id){
	// 	return $this->db->delete('tblmodel',['id'=>$id]); 
	// }



	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblmodel');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblmodel',['id' => $id]);
			return $result_set->row_array();
		}
	}



	public function find_active(){
		$result_set=$this->db->get_where('tblmodel',['status' => '1']);
		return $result_set->result_array();
	}
}

?>