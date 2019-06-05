<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends MY_Controller {



	public function __construct(){
		parent::__construct();

		$this->load->model('authentication_model');
		$this->load->model('group_model');
	}



	public function index(){
		$this->logged_in();
	}



	public function login()
	{
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run()==true){
			
			$isExist=$this->authentication_model->check_username($this->input->post('username'));

			if($isExist){
				$isActive=$this->authentication_model->check_status($this->input->post('username'));
				if($isActive){
					$result=$this->authentication_model->login($this->input->post('username'),md5($this->input->post('password')));
					if($result){
	           			$data = array(
	           				'user_id' 		=> $result['id'],
					        'logged_in' 	=> true
						);
						$this->session->set_userdata($data);

						$this->action_log($result['id'],'Login','logged in');
						
						if($result['group_id']=='3'){
							redirect('group/cashier','refresh');
						}
						redirect('dashboard');
					}else{
	           			$this->data['errors'] = 'Incorrect username/password combination!';
	           			$this->load->view('login', $this->data);
					}
				}else{
	       			$this->data['errors'] = 'Sorry, Your account is deactivated!';
	       			$this->load->view('login', $this->data);
				}	
			}else{
       			$this->data['errors'] = 'Username does not exist!';
       			$this->load->view('login', $this->data);
			}
		}else{
       		$this->load->view('login', $this->data);
		}
	}


	public function authenticate($username="",$password=""){
		$result=$this->authentication_model->login($username,md5($password));
		if(!empty($result)){
			$permission = $this->group_model->view($result['group_id']);
			$response = array();
			$response['status'] = false;
			if(in_array('createDiscount', unserialize($permission['permission']))){
				$response['status'] = true;
			}
		}
		echo json_encode($response);
	}


	public function logout(){
		$this->session->sess_destroy();
       	redirect('authentication');
	}
}
?>