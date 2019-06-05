<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vat_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function save($data){
		if($this->db->count_all('tblvat')==0){
			$this->insert($data);
		}else{
			$this->update($data);
		}
	}

	public function update($data){
		$this->db->update('tblvat', $data);
	}

	public function insert($data){
		$this->db->insert('tblvat',$data);
	}

	public function view(){
		return $this->db->get('tblvat')->row_array()['vat'];
	}

}

/* End of file vat_markup_model.php */
/* Location: ./application/models/vat_markup_model.php */
?>