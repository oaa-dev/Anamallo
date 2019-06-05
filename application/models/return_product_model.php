<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Return_Product_Model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function insert($data){
		return $this->db->insert('tblreturn',$data);
	}

	public function update($id, $data){
		return $this->db->update('tblreturn', $data, ['id' => $id]);
	}

	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblreturn');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblreturn',['id' => $id]);
			return $result_set->row_array();
		}
	}
}

?>