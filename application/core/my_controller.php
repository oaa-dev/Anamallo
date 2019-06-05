<?php

class MY_Controller extends CI_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->load->model('product_pending_price_model');
		$this->load->model('product_model');
		$this->data['user_permission']=array();
		$this->data['user']=array();
		$this->permission=array();
		$this->user=array();

		if(!empty($this->session->userdata('user_id'))&&$this->session->userdata('logged_in')==true){

			$this->load->model('user_model');
			$this->load->model('group_model');
			$this->update_price();

			$user_id=$this->session->userdata('user_id');
			$user=$this->user_model->view($user_id);
			$group=$this->group_model->view($user['group_id']);
			
			
			$this->data['user_permission']=unserialize($group['permission']);
			$this->data['user_data']=$user;
			$this->data['user_group']=$group;
			$this->permission=unserialize($group['permission']);
			$this->user=$user;
			$this->data['stocks_alert']=$this->check_stocks();
			$this->data['update_alert']=$this->update_price();
		}
	}
	

	public function update_price(){
		$response=array();
		$message="";

		$data=$this->product_pending_price_model->view();
		foreach ($data as $key => $value) {
			if($value['date_pending']==date("Y-m-d")){		
				$data=array(
					'manufacturer_price'=>$value['manufacturer_price'],
					'selling_price'		=>$value['selling_price'],
				);
				$create=$this->product_model->update($value['product_id'],$data);
				$product=$this->product_model->view($value['product_id']);
				if($create){
					$message='Product '.$product['product'].' price update ';
				}
			}
		}
		return $message;
	}


	public function check_stocks(){
		$message="";
		$product_data=$this->product_model->view();
		foreach ($product_data as $key => $value) {
			if($value['stocks']<=$value['minimum_quantity'] && $value['stocks']>0){
				$message="Some products are low stocks";
			}elseif($value['stocks']<=0){
				$message="Some products are out of stocks";
				break;
			}else{
				$message="Stocks are in good condition";
			}
		}
		return $message;
	}

	public function render_template($page=null, $data=array()){
		$this->load->view('templates/header', $data);
		$this->load->view('templates/header-menu', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view($page,$data);
		$this->load->view('templates/footer', $data);
	}

	public function logged_in(){
		$is_login=$this->session->userdata('logged_in'); 
		if($is_login){
			if($this->user['group_id']=='3'){
				redirect('group/cashier');	
			}else{
				redirect('dashboard');
			}
		}else{
			$this->load->view('login');
		}
	}


	
	public function confirm_login(){
		$is_login=$this->session->userdata('logged_in'); 
		if(!$is_login){
			redirect('authentication');
		}
	}


	public function action_log($user,$module,$action){
		$path='application/logs/logs.txt';
	    //$path="logs.txt";
	    
	    $timestamp = strftime("%Y-%m-%d", time());
		$content = "{$timestamp} | {$user} | {$module} | {$action} ; ";
		write_file($path, $content,'a+');
	}
}

?>