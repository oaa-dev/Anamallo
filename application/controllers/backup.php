<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}
	public function back_up(){
		$this->load->dbutil();

		$prefs = array(     
		    'format'      => 'zip',             
		    'filename'    => 'anamallo_db.sql'
		    );

		$backup =& $this->dbutil->backup($prefs); 
		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.sql';
		$save = base_url()."".$db_name;

		$this->load->helper('file');
		write_file($save, $backup); 


		$this->load->helper('download');
		force_download($db_name, $backup);
	}
}
