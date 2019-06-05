<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function insert($data){
		return $this->db->insert('tblinvoice',$data);
	}

	public function update($id, $data){
		return $this->db->update('tblinvoice', $data, ['id' => $id]);
	}

	public function view($id=null){
		if($id === null){
			$result_set = $this->db->get('tblinvoice');
			return $result_set->result_array();
		}else{
			$result_set = $this->db->get_where('tblinvoice',['id' => $id]);
			return $result_set->row_array();
		}
	}
	
	public function view_by_or($or=null){
		$result_set = $this->db->get_where('tblinvoice',['or_number'=>$or]);
		return $result_set->row_array();	
	}

	public function view_by_range($from, $to){
		$result_set="";
		if(!empty($from)&&!empty($to)){
			$result_set = $this->db->get_where('tblinvoice',['date_time >='=>$from,'date_time <='=>$to]);
		}else{
			$result_set = $this->db->get_where('tblinvoice');
		}
		return $result_set->result_array();	
	}

	public function view_by_date($date=null){
		$result_set = $this->db->get_where('tblinvoice',['date_time '=>$date]);
		return $result_set->result_array();	
	}

	public function find_active(){
		$result_set=$this->db->get_where('tblinvoice',['status' => '1']);
		return $result_set->result_array();
	}

	public function get_id(){
		$this->db->select('*');
		$this->db->from('tblinvoice');
		$this->db->order_by('id', 'desc');
		$this->db->limit('1');
		return $this->db->get()->row_array()['id'];
	}

	public function count_all(){
		return $this->db->count_all('tblinvoice');
	}

	public function sum_all(){
		$this->db->select_sum('net_total','total');
		return $this->db->get('tblinvoice')->row_array()['total'];
	}
}
?>