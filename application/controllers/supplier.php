<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends MY_Controller {
	


	public function __construct(){
		parent::__construct();

		$this->confirm_login();
		$this->load->model('supplier_model');

		$this->data['page_title']='Supplier';
	}
	


	public function index(){

		if(!in_array('createSupplier', $this->permission)&&
			!in_array('updateSupplier', $this->permission)&&
			!in_array('deleteSupplier', $this->permission)&&
			!in_array('viewSupplier', $this->permission)){

			show_404();
		}
		$this->render_template('supplier/index',$this->data);
	}



	public function insert(){

		if(!in_array('createSupplier', $this->permission)){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('supplier','Supplier','required');
		$this->form_validation->set_rules('address', 'Address','required');
		$this->form_validation->set_rules('contact', 'Contact', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('status','Status','required');

		if($this->form_validation->run()==true){
			$data=array(
				'id'=>'',
				'supplier'=>$this->input->post('supplier'),
				'address'=>$this->input->post('address'),
				'contact'=>$this->input->post('contact'),
				'email'=>$this->input->post('email'),
				'status'=>$this->input->post('status'),
			);
			$create=$this->supplier_model->insert($data);
			if($create){
				$response['success'] = true;
        		$response['messages'] = "Supplier {$data['supplier']} succesfully created";

				$this->action_log($this->user['id'],'Supplier','Add '.$data['supplier']);
			}else{
				$response['success'] = false;
        		$response['messages'] = 'Record not saved';
			}
		}
		echo json_encode($response);
	}



	public function update($id=""){

		if(!in_array('updateSupplier', $this->permission)||$id==null){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('supplier','Supplier','required');
		$this->form_validation->set_rules('address', 'Address','required');
		$this->form_validation->set_rules('contact', 'Contact', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('status','Status','required');

		if($this->form_validation->run()==true){
			$data=array(
				'supplier'=>$this->input->post('supplier'),
				'address'=>$this->input->post('address'),
				'contact'=>$this->input->post('contact'),
				'email'=>$this->input->post('email'),
				'status'=>$this->input->post('status'),
			);
			$old_data=$this->supplier_model->view($id);
			$update=$this->supplier_model->update($id, $data);
			if($update){
				$response['success']=true;
				$response['messages']="Supplier {$old_data['supplier']} update successfully";

				$this->action_log($this->user['id'],'Supplier','Update '.$data['supplier']);
			}else{
				$response['success']=false;
				$response['messages']="Record not updated";
			}
		}
		echo json_encode($response);
	}



	// public function delete($id=""){

	// 	if(!in_array('deleteSupplier', $this->permission)||$id==null){ show_404(); }

	// 	$response=array();

	// 	$delete=$this->supplier_model->delete($id);
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

		$data = $this->supplier_model->view(); // return 2 dimentional array
		foreach ($data as $key => $value) {

			$status = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$buttons = '';
			if(in_array('updateSupplier', $this->permission)){
				$buttons .= '<button type="button" class="btn btn-success btn-xs" onclick="edit('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i>Edit</button>';	
			}
			// if(in_array('deleteSupplier', $this->permission)){
			// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="remove('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i>Delete</button>';
			// }			

			$result['data'][$key] = array(strtoupper($value['supplier']),$value['contact'],$value['email'], $status, $buttons);
		}
		echo json_encode($result);
	}



	public function find_by_id($id=""){
		if($id){
			$result = $this->supplier_model->view($id);
			echo json_encode($result);
		}
	}
}
