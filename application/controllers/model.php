<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model extends MY_Controller {
	


	public function __construct(){
		parent::__construct();

		$this->confirm_login();
		$this->load->model('model_model');

		$this->data['page_title']='Model';
	}
	


	public function index(){
		if(!in_array('createModel', $this->permission)&&
			!in_array('updateModel', $this->permission)&&
			!in_array('viewModel', $this->permission)){

			show_404();
		}

		$this->render_template('model/index',$this->data);
	}



	public function insert(){

		if(!in_array('createModel', $this->permission)){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('model','Model','required');
		$this->form_validation->set_rules('status','Status','required');

		if($this->form_validation->run()==true){
			$data=array(
				'id'=>'',
				'model'=>$this->input->post('model'),
				'status'=>$this->input->post('status'),
			);
			$create=$this->model_model->insert($data);
			if($create){
				$response['success'] = true;
        		$response['messages'] = "Model {$data['model']} succesfully created";

				$this->action_log($this->user['id'],'Model','Add '.$data['model']);
			}else{
				$response['success'] = false;
        		$response['messages'] = 'Record not saved';
			}
		}
		echo json_encode($response);
	}



	public function update($id=""){

		if(!in_array('updateModel', $this->permission)||$id==null){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('model','Model','required');
		$this->form_validation->set_rules('status','Status','required');

		if($this->form_validation->run()==true){
			$data=array(
				'model' => $this->input->post('model'),
				'status' => $this->input->post('status')
			);

			$old_data=$this->model_model->view($id);
			$update=$this->model_model->update($id, $data);
			if($update){
				$response['success']=true;
				$response['messages']="Model {$old_data['model']} update successfully";

				$action="Update {$old_data['model']} ({$old_data['status']}) to {$data['model']} ({$data['status']})";
				$this->action_log($this->user['id'],'Model',$action);
			}else{
				$response['success']=false;
				$response['messages']="Record not updated";
			}
		}
		echo json_encode($response);
	}



	// public function delete($id=""){

	// 	if(!in_array('deleteModel', $this->permission)||$id==null){ show_404(); }

	// 	$response=array();

	// 	$delete=$this->model_model->delete($id);
	// 	if($delete){
	// 		$response['success']=true;
	// 		$response['messages']="Delete record successfully";
	// 	}else{
	// 		$response['success']=false;
	// 		$response['messages']="Record not deleted";
	// 	}
	// 	echo json_encode($response);
	// }



	public function find_all(){
		$result = array('data' => array());

		$data = $this->model_model->view();
		foreach ($data as $key => $value) {

			$status = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$buttons = '';

			if(in_array('updateModel', $this->permission)){
				$buttons .= '<button type="button" class="btn btn-success btn-xs" onclick="edit('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i>Edit</button>';
			}	

			// if(in_array('deleteModel', $this->permission)){
			// 	$buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="remove('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i>Delete</button>';	
			// }		
		
			$result['data'][$key] = array(strtoupper($value['model']), $status, $buttons);
		}
		echo json_encode($result);
	}



	public function find_by_id($id){
		if($id){
			$result = $this->model_model->view($id);
			echo json_encode($result);
		}
	}
}
