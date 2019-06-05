<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('customer_model');
    }

    public function find_all() {
        $result=array('data'=>array());

        $data=$this->customer_model->view();
        foreach ($data as $key => $value) {

        	$button='<a type="button" class="btn btn-success btn-xs" onclick="customer(\''.$value['id'].'\',\''.$value['name'].'\',\''.$value['email'].'\',\''.$value['contact'].'\',\''.$value['address'].'\')">Select</a>';

        	$result['data'][$key]=array($value['name'],$value['email'],$value['contact'],$value['address'],$button);
        }
        echo json_encode($result);
    }
}
        
?>