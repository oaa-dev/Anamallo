<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {
	


	public function __construct(){
		parent::__construct();

		$this->confirm_login();
		$this->load->model('category_model');

		$this->data['page_title']='Category';
	}
	


	public function index(){

		if(!in_array('createCategory', $this->permission)&&
			!in_array('updateCategory', $this->permission)&&
			!in_array('viewCategory', $this->permission)){

			show_404();
		}

		$this->render_template('category/index',$this->data);
	}



	public function insert(){

		if(!in_array('createCategory', $this->permission)){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('category','Category','required');
		$this->form_validation->set_rules('status','Status','required');

		if($this->form_validation->run()==true){
			$data=array(
				'id'=>'',
				'category'=>$this->input->post('category'),
				'status'=>$this->input->post('status'),
			);
			$create=$this->category_model->insert($data);
			if($create){
				$response['success'] = true;
        		$response['messages'] = 'Category '.$data['category'].' succesfully created';

				$this->action_log($this->user['id'],'Category','Add '.$data['category']);
			}else{
				$response['success'] = false;
        		$response['messages'] = 'Record not saved';
			}
		}
		echo json_encode($response);
	}



	public function update($id=""){

		if(!in_array('updateCategory', $this->permission)||$id==null){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('category','Category','required');
		$this->form_validation->set_rules('status','Status','required');

		if($this->form_validation->run()==true){
			$data=array(
				'category' => $this->input->post('category'),
				'status' => $this->input->post('status')
			);

			$old_data=$this->category_model->view($id);
			$update=$this->category_model->update($id, $data);
			if($update){
				$response['success']=true;
				$response['messages']="Category {$old_data['category']} update successfully";

				$action="Update {$old_data['category']} ({$old_data['status']}) to {$data['category']} ({$data['status']})";
				$this->action_log($this->user['id'],'Category',$action);
			}else{
				$response['success']=false;
				$response['messages']="Record not updated";
			}
		}
		echo json_encode($response);
	}



	// public function delete($id=""){

	// 	if(!in_array('deleteCategory', $this->permission)||$id==null){ show_404(); }

	// 	$response=array();

	// 	$delete=$this->category_model->delete($id);
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
		$result = array('data' => array()); // 2 dimentional array

		$data = $this->category_model->view(); // return 2 dimentional array
		foreach ($data as $key => $value) {

			$status = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$buttons = '';

			if(in_array('updateCategory', $this->permission)){
				$buttons .= '<button type="button" class="btn btn-success btn-xs" onclick="edit('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i>Edit</button>';
			}	
			// if(in_array('deleteCategory', $this->permission)){
			// 	$buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="remove('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i>Delete</button>';
			// }			

			$result['data'][$key] = array(strtoupper($value['category']), $status, $buttons);
		}
		echo json_encode($result);
	}
	


	public function find_by_id($id){
		if($id){
			$result = $this->category_model->view($id);
			echo json_encode($result);
		}
	}
}
