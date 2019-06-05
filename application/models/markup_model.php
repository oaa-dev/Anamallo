<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Markup_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function save($data){
		if($this->db->count_all('tblmarkup')==0){
			$this->insert($data);
		}else{
			$this->update($data);
		}
	}

	public function update($data){
		$this->db->update('tblmarkup', $data);
	}

	public function insert($data){
		$this->db->insert('tblmarkup',$data);
	}

	public function view(){
		return $this->db->get('tblmarkup')->row_array()['markup'];
	}

}

/* End of file vat_markup_model.php */
/* Location: ./application/models/vat_markup_model.php */
?>