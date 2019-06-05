<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Controller {



	public function __construct(){
		parent::__construct();

		$this->confirm_login();
		$this->data['page_title']='Group';
		$this->load->model('group_model');
		$this->load->model('vat_model');
	}



	public function index(){

		if(!in_array('createGroup', $this->permission)&&
			!in_array('updateGroup', $this->permission)&&
			!in_array('viewGroup', $this->permission)){

			show_404();
		}

		$this->render_template('group/index',$this->data);
	}



	public function add(){

		if(!in_array('createGroup', $this->permission)){ show_404(); }

		$this->render_template('group/add',$this->data);
	}



	public function edit($id=""){

		if(!in_array('updateGroup', $this->permission)||$id==null){ show_404(); }

		if($id){
			$this->data['permission']=$this->group_model->view($id);
			$this->render_template('group/edit',$this->data);
		}
	}



	public function find_all(){

		$result=array('data' => array());

		$data=$this->group_model->view();
		foreach($data as $key => $value){
			$buttons="";


			if(in_array('updateGroup', $this->permission)&&$value['id']!='2'&&$value['id']!='3'){
			$buttons .= '<a type="button" class="btn btn-success btn-xs" href="'.base_url().'group/edit/'.$value['id'].'"><i class="fa fa-pencil"></i>Edit</a>';	
			}

			// if(in_array('deleteGroup', $this->permission)){
			// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="remove('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i>Delete</button>';
			// }
			$status=($value['status']==1)? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';		

			$result['data'][$key]=array(strtoupper($value['group_user']), $status, $buttons);	
		}
		echo json_encode($result);
	}



	public function insert(){

		if(!in_array('createGroup', $this->permission)){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('group', 'Group', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		if($this->form_validation->run()==true){
			$data=array(
				'id'			=>'',
				'group_user'	=>$this->input->post('group'),
				'status'		=>$this->input->post('status'),
				'permission'	=>serialize($this->input->post('permission'))
			);

			$create=$this->group_model->insert($data);
			if($create){
				$this->session->set_flashdata('success', "Group {$data['group_user']} successfully created");

				$this->action_log($this->user['id'],'Group','Add '.$data['group_user']);
			}else{
				$this->session->set_flashdata('error', 'Record not saved');
			}
			redirect('group/', 'refresh');
		}else{
			$this->render_template('group/add',$this->data);
		}
	}



	public function update($id=""){

		if(!in_array('updateGroup', $this->permission)||$id==null){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('group', 'Group', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		if($this->form_validation->run()==true){
			$data=array(
				'group_user'=>$this->input->post('group'),
				'status'	=>$this->input->post('status'),
				'permission'=>serialize($this->input->post('permission'))
			);
			$old_data=$this->group_model->view($id);
			$update=$this->group_model->update($id ,$data);

			if($update){
				$this->session->set_flashdata('success', "Group {$old_data['group_user']} successfully update");

				$this->action_log($this->user['id'],'Group','Update '.$data['group_user']);
			}else{
				$this->session->set_flashdata('error', 'Record not update');
			}
			redirect('group', 'refresh');
		}else{
			$this->data['permission']=$this->group_model->view($id);
			$this->render_template('group/edit',$this->data);
		}
	}



	public function cashier(){
		$this->data['page_title']="Cashier";
        $this->data['vat']=$this->vat_model->view();
		$this->load->view('cashier/index',$this->data);
	}



	// public function delete($id=""){

	// 	if(!in_array('deleteGroup', $this->permission)||$id==null){ show_404(); }

	// 	$response=array();

	// 	$delete=$this->group_model->delete($id);
	// 	if($delete){
	// 		$response['success']=true;
	// 		$response['messages']="Delete Record successfully";
	// 	}else{
	// 		$response['success']=true;
	// 		$response['messages']="Record not deleted";
	// 	}
	// 	echo json_encode($response);
	// }
}
?>