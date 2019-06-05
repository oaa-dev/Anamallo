<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		
		$this->confirm_login();
		$this->load->model('user_model');

		$this->data['page_title']="User";
		
		$this->data['group']=$this->group_model->getActive();
	}



	public function index(){
		$this->render_template('user/index',$this->data);
	}



	public function add(){
		if(!in_array('createUser', $this->permission)){ show_404(); }
		$this->render_template('user/add',$this->data);
	}



	public function edit($id=""){
		if(!in_array('updateUser', $this->permission)||$id==null){ show_404(); }

		$this->data['user']=$this->user_model->view($id);
		$this->render_template('user/edit',$this->data);
	}
	

	public function logs(){
		$this->render_template('user/logs',$this->data);
	}

	public function activity_logs(){
		$result=array('data'=>array());
		$record=array();
		$path="application/logs/logs.txt";
		
		$data=explode(";",read_file($path));
		for($index=0;$index<count($data)-1;$index++){
			$record=explode("|", $data[$index]);
			$result['data'][]=array($record[0],$record[1],$record[2],$record[3]);
		}
		echo json_encode($result);
	}

	public function profile(){
		$this->render_template('user/profile',$this->data);
	}

	public function find_all(){
		$result=array('data' => array());

		$data=$this->user_model->view();
		foreach ($data as $key => $value) {
			$buttons="";

			$name=$value['lastname'].', '.$value['firstname'].' '.$value['middlename'];
			$group=$this->group_model->view($value['group_id']);

			$images=!empty($value['image'])? '<a href="'.base_url().'images/'.$value['image'].'" terget="_self"><img src="'.base_url().'images/'.$value['image'].'" width="30px"></a>' : '<a href="'.base_url().'images/null.jpg" terget="_self"><img src="'.base_url().'images/null.jpg" width="30px"></a>';

			if(in_array('updateUser', $this->permission)){
				$buttons .= '<a class="btn btn-success btn-xs" href="'.base_url().'user/edit/'.$value['id'].'"><i class="fa fa-pencil"></i> Edit</a>';
			}

			// if(in_array('deleteUser', $this->permission)){
			// 	$buttons .= '<button type="button" class="btn btn-danger" onclick="remove('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button>';
			// }

			$result['data'][$key]=array($images, $value['username'], $name, $value['email'], $value['contact'],$group['group_user'],$buttons);
		}
		echo json_encode($result);
	}



	public function insert(){

		if(!in_array('createUser', $this->permission)){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('group', 'Group', 'required');
		$this->form_validation->set_rules('firstname', 'First Name', 'required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required');
		$this->form_validation->set_rules('middlename', 'Middle Name', 'required');
		$this->form_validation->set_rules('dateofbirth', 'Date of Birth', 'required');
		$this->form_validation->set_rules('contact', 'Contact Number', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('confirmation', 'Confirmation', 'required|matches[password]');

		if ($this->form_validation->run() == TRUE) {
			
			$do_upload=$this->do_upload();
			$user_data=array();
			$username_exist=$this->user_model->view();
			foreach ($username_exist as $key => $value) {
					$user_data[]=$value['username'];
			}

			if(!in_array($this->input->post('username'), $user_data)){
				$data=array(
					'id'			=>'',
					'group_id'		=>$this->input->post('group'),
					'lastname'		=>$this->input->post('lastname'),
					'firstname'		=>$this->input->post('firstname'),
					'middlename'	=>$this->input->post('middlename'),
					'dateofbirth'	=>$this->input->post('dateofbirth'),
					'contact'		=>$this->input->post('contact'),
					'gender'		=>$this->input->post('gender'),
					'email'			=>$this->input->post('email'),
					'username'		=>$this->input->post('username'),
					'password'		=>md5($this->input->post('password')),
					'address'		=>$this->input->post('address'),
					'status'		=>$this->input->post('status'),
					'image'			=>$do_upload
				);

				$create=$this->user_model->insert($data);
				if($create){
					$this->session->set_flashdata('success',"User {$data['username']} successfully created");

	                $this->action_log($this->user['id'],'User','Add '.$data['username']);
				}else{
					$this->session->set_flashdata('error','Record not save');
				}
				redirect('user','refresh');
			}else{
				$this->session->set_flashdata('error','Record not saved, username already exist!');
				redirect('user','refresh');
			}
		}else {
			$this->data['group']=$this->group_model->view();
			$this->render_template('user/add', $this->data);
		}
	}



	public function update($id=""){

		if(!in_array('updateUser', $this->permission)||$id==null){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('group', 'Group', 'required');
		$this->form_validation->set_rules('firstname', 'First Name', 'required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required');
		$this->form_validation->set_rules('middlename', 'Middle Name', 'required');
		$this->form_validation->set_rules('dateofbirth', 'Date of Birth', 'required');
		$this->form_validation->set_rules('contact', 'Contact Number', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'trim');
		$this->form_validation->set_rules('confirmation', 'Confirmation', 'trim|matches[password]');
		
		if ($this->form_validation->run() == TRUE) {
			$data=array(
				'group_id'		=>$this->input->post('group'),
				'lastname'		=>$this->input->post('lastname'),
				'firstname'		=>$this->input->post('firstname'),
				'middlename'	=>$this->input->post('middlename'),
				'dateofbirth'	=>$this->input->post('dateofbirth'),
				'contact'		=>$this->input->post('contact'),
				'gender'		=>$this->input->post('gender'),
				'email'			=>$this->input->post('email'),
				'username'		=>$this->input->post('username'),
				'address'		=>$this->input->post('address'),
				'status'		=>$this->input->post('status')
			);
			if(!empty($this->input->post('password'))){
				$data['password'] =md5($this->input->post('password'));
			}
			elseif(!empty($_FILES['user_image']['name'])){
				$do_upload=$this->do_upload();
				$data['image'] =$do_upload;
			}

			$update=$this->user_model->update($id, $data);
			if($update){
				$this->session->set_flashdata('success',"User {$data['username']} successfully update");

                $this->action_log($this->user['id'],'user','Update '.$data['username']);
			}else{
				$this->session->set_flashdata('error','Record not update');
			}
			redirect('user', 'refresh');
		}else {
			$this->data['user']=$this->user_model->view($id);
			$this->data['group']=$this->group_model->view();
			$this->render_template('user/edit', $this->data);
		}
	}



	// public function delete($id=""){

	// 	if(!in_array('deleteUser', $this->permission)||$id==null){
	// 		redirect('user','refresh');
	// 	}

	// 	$response=array();

	// 	$data=$this->user_model->delete($id);
	// 	if($data){
	// 		$response['success']=true;
	// 		$response['messages']='Deleted record successfully';
	// 	}else{
	// 		$response['success']=false;
	// 		$response['messages']='Record not deleted';
	// 	}
	// 	echo json_encode($response);
	// }


	public function deactivate($id=""){

		$response=array();

		$data=$this->user_model->update($id,['status'=>1]);
		if($data){
			$response['success']=true;
			$response['messages']='Deacivate record successfully';
		}else{
			$response['success']=false;
			$response['messages']='Account not deactivate';
		}
		echo json_encode($response);
	}



	public function do_upload(){
        $config['upload_path'] = "images/user";
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';

        $this->load->library('upload', $config);
        
        if(!$this->upload->do_upload('user_image')){
            $errors = array('error' => $this->upload->display_errors());
            $new_name = 'null.jpg';
            return $new_name;
        } else {    
        	$data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['user_image']['name']);
            $type = $type[count($type) - 1];
            
            $path ='user/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;
        }
    }
}
?>