<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends MY_Controller {
	


	public function __construct(){
		parent::__construct();

		$this->confirm_login();
		$this->load->model('brand_model');

		$this->data['page_title']='Brand';
	}
	
	public function index(){
		if(!in_array('createBrand',$this->permission)&&
			!in_array('updateBrand',$this->permission)&&
			!in_array('viewBrand',$this->permission)){
			
			show_404();
		}

		$this->render_template('brand/index',$this->data);
	}



	public function insert(){

		if(!in_array('createBrand', $this->permission)){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('brand','Brand','required');
		$this->form_validation->set_rules('status','Status','required');

		if($this->form_validation->run()==true){
			$data=array(
				'id'=>'',
				'brand'=>$this->input->post('brand'),
					'status'=>$this->input->post('status'),
			);
			$create=$this->brand_model->insert($data);
			if($create){
				$response['success'] = true;
        		$response['messages'] = "Brand {$data['brand']} succesfully created";

        		//logs
				$this->action_log($this->user['id'],'Brand','Add '.$data['brand']);
			}else{
				$response['success'] = false;
        		$response['messages'] = 'Brand not saved';
			}
		}
		echo json_encode($response);
	}



	public function update($id=""){

		if(!in_array('updateBrand',$this->permission)||$id==null){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('brand','Brand','required');
		$this->form_validation->set_rules('status','Status','required');

		if($this->form_validation->run()==true){
			$data=array(
				'brand' => $this->input->post('brand'),
				'status' => $this->input->post('status')
			);

			$old_data=$this->brand_model->view($id);
			$update=$this->brand_model->update($id, $data);

			if($update){
				$response['success']=true;
				$response['messages']='Brand '.$old_data['brand'].' update successfully';

				$action="Update {$old_data['brand']} ({$old_data['status']}) to {$data['brand']} ({$data['status']})";
				$this->action_log($this->user['id'],'Brand',$action);
			}else{
				$response['success']=false;
				$response['messages']='Record not updated';
			}
		}
		echo json_encode($response);
	}



	// public function delete($id=""){

	// 	if(!in_array('deleteBrand',$this->permission)||$id==null){ show_404(); }

	// 	$response=array();

	// 	$delete=$this->brand_model->delete($id);
	// 	if($delete){
	// 		$response['success']=true;
	// 		$response['messages']='Delete record successfully';
	// 	}else{
	// 		$response['success']=false;
	// 		$response['messages']='Record not deleted';
	// 	}
	// 	echo json_encode($response);
	// }



	public function find_all(){
		$result = array('data' => array());

		$data = $this->brand_model->view();
		foreach ($data as $key => $value) {

			$status = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$buttons = '';

			if(in_array('updateBrand', $this->permission)){
				$buttons .= '<button type="button" class="btn btn-success btn-xs" onclick="edit('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i>Edit</button>';	
			}
			// if(in_array('deleteBrand', $this->permission)){
			// 	$buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="remove('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i>Delete</button>';			
			// }
			$result['data'][$key] = array(strtoupper($value['brand']), $status, $buttons);
		}
		echo json_encode($result);
	}



	public function find_by_id($id){
		if($id){
			$result = $this->brand_model->view($id);
			echo json_encode($result);
		}
	}
}
