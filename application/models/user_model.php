<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {



	public function __construct()
	{
		parent::__construct();
	}



	public function insert($data){
		return $this->db->insert('tbluser', $data);
	}



	// public function delete($id){
	// 	return $this->db->delete('tbluser', ['id' => $id]);
	// }



	public function update($id, $data){
		return $this->db->update('tbluser', $data, ['id' => $id]);
	}



	public function view($id=null){
		if($id===null){
			$result_set=$this->db->get_where('tbluser', ['group_id !=' => '1']);
			return $result_set->result_array();
		}else{
			$result_set=$this->db->get_where('tbluser',['id' => $id]);
			return $result_set->row_array();
		}
	}



	public function count_all(){
		$this->db->where(['id'=>1]);
		$this->db->from('tbluser');
		return $this->db->count_all_results();
	}
}
?>