<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vat extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('vat_model');
        $this->load->model('markup_model');

        $this->data['page_title']='Value Added Tax';
    }

    public function index() {
    	$this->data['vat']=$this->vat_model->view();
    	$this->data['markup']=$this->markup_model->view();
        $this->render_template('vat/index',$this->data);
    }

    public function update_vat(){
    	$this->form_validation->set_rules('vat','Value Added Tax', 'required');
    	$this->form_validation->set_rules('password','Password', 'required');
        $response=array();

    	if($this->form_validation->run()==true){
    		if($this->user['password']==md5($this->input->post('password'))){
    			$vat = array('vat'=>$this->input->post('vat'));
    			$update = $this->vat_model->save($vat);

                $response['success']=true;
                $response['messages']="Value added tax sucessfully update";
                $this->action_log($this->user['id'],'Value Added Tax','Update to '.$vat['vat']);
			}else{
                $response['success']=false;
                $response['messages']="Incorrect password combination!";
            }
    	}
        echo json_encode($response);
    }

    public function update_markup(){
    	$this->form_validation->set_rules('markup','Markup', 'required');
    	$this->form_validation->set_rules('password','Password', 'required');
        $response=array();

    	if($this->form_validation->run()==true){
    		if($this->user['password']==md5($this->input->post('password'))){
    			$markup = array('markup'=>$this->input->post('markup'));
    			$update = $this->markup_model->save($markup);
    			
                $response['success']=true;
				$response['messages']="Mark up successfully update";
                $this->action_log($this->user['id'],'Mark up','Update to '.$markup['markup']);
			}else{
                $response['success']=false;
                $response['messages']="Incorrect password combination!";
			}
    	}
        echo json_encode($response);
    }
}
?>