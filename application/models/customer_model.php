<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_Model extends CI_Model{



	function __construct(){
		parent::__construct();
	}



	public function insert($data){
		return $this->db->insert('tblcustomer',$data);
	}



	public function update($id, $data){
		return $this->db->update('tblcustomer', $data, ['id' => $id]);
	}



	// public function delete($id){
	// 	return $this->db->delete('tblcustomer',['id'=>$id]); 
	// }



	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblcustomer');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblcustomer',['id' => $id]);
			return $result_set->row_array();
		}
	}


	public function get_id(){
		$this->db->select('*');
		$this->db->from('tblcustomer');
		$this->db->order_by('id', 'desc');
		$this->db->limit('1');
		return $this->db->get()->row_array()['id'];
	}
}

?>