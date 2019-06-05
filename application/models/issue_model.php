<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issue_Model extends CI_Model {

	public function __construct(){
		parent::__construct();
		
	}

	public function insert($data){
		return $this->db->insert('tblissue', $data);
	}

	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblissue');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblissue',['id' => $id]);
			return $result_set->row_array();
		}
	}

}
?>