<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication_Model extends CI_Model{



	public function __construct(){
		parent::__construct();
	}




	public function check_username($username){
		$result=$result=$this->db->get_where('tbluser',['username'=>$username]);
		return ($result->num_rows()==1)? true:false;
	}
	



	public function check_status($username){
		$result=$this->db->get_where('tbluser',['username'=>$username, 'status'=>1]);
		return ($result->num_rows()==1)? true:false;
	}




	public function login($username,$password){
		$result=$this->db->get_where('tbluser',['username'=>$username,'password'=>$password,'status'=>1]);
		return $result->row_array();
	}
}

?>