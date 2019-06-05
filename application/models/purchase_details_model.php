<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_Details_Model extends CI_Model{



	function __construct(){
		parent::__construct();
	}



	public function insert($data){
		return $this->db->insert('tblpurchase_details',$data);
	}



	public function update($id, $data){
		return $this->db->update('tblpurchase_details', $data, ['id' => $id]);
	}



	// public function delete($id){
	// 	return $this->db->delete('tblpurchase_details',['purchase_id'=>$id]); 
	// }



	public function view($id){
		$result_set = $this->db->get_where('tblpurchase_details',['purchase_id'=>$id] );
		return $result_set->result_array();
	}



	public function view_all_details(){
		$result_set = $this->db->get_where('tblpurchase_details',['status'=>'1']);
		return $result_set->result_array();
	}



	public function view_details_info($id=null){
		$result_set = $this->db->get_where('tblpurchase_details',['id' => $id]);
		return $result_set->row_array();
	}



	public function delete_details($id){
		return $this->db->delete('tblpurchase_details',['id'=>$id]); 
	}
}

?>	