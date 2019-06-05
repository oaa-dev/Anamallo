<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {
	


	function __construct(){
		parent::__construct();

		$this->confirm_login();
		$this->load->model('supplier_model');
		$this->load->model('brand_model');
		$this->load->model('category_model');
		$this->load->model('product_model');
		$this->load->model('model_model');
		$this->load->model('markup_model');
		$this->load->model('product_pending_price_model');
		$this->load->model('product_supplier_model');

		$this->data['page_title']='Product';
		$this->data['category']= $this->category_model->find_active();
		$this->data['brand']= $this->brand_model->find_active();
		$this->data['supplier']= $this->supplier_model->find_active();
		$this->data['model']= $this->model_model->find_active();
	}
	


	public function index(){

		if(!in_array('createProduct', $this->permission)&&
			!in_array('updateProduct', $this->permission)&&
			!in_array('viewProduct', $this->permission)){

			show_404();
		}

		$this->data['markup']=$this->markup_model->view();
		$this->render_template('product/index',$this->data);
	}



	public function add(){

		if(!in_array('createProduct', $this->permission)){ show_404(); }
		
		$this->data['markup']=$this->markup_model->view();
		$this->render_template('product/add', $this->data);
	}



	public function edit($id=""){

		if(!in_array('updateProduct', $this->permission)){ show_404(); }
		
		$this->data['product'] = $this->product_model->view($id);
		$this->data['product_supplier'] = $this->product_supplier_model->view($id);
		$this->render_template('product/edit', $this->data);
	}



	public function find_all(){
		$result = array('data' => array());

		$data = $this->product_model->view();
		foreach ($data as $key => $value) {

			$brand=$this->brand_model->view($value['brand_id']);

			$buttons = '';

			$images=!empty($value['image'])? '<a href="'.base_url().'images/'.$value['image'].'" terget="_self"><img src="'.base_url().'images/'.$value['image'].'" width="30px"></a>' : '<a href="'.base_url().'images/null.jpg" terget="_self"><img src="'.base_url().'images/null.jpg" width="30px"></a>';

			$availability = ($value['availability'] == 1) ? '<span class="label label-success">Yes</span>' : '<span class="label label-warning">No</span>';

			//edit
			if(in_array('updateProduct',$this->permission)){
				$buttons .= '<a type="button" class="btn btn-primary btn-xs" href="'.base_url().'product/edit/'.$value['id'].'"><i class="fa fa-pencil"></i>Edit</a>';
				
				$buttons .= '<a type="button" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#updatePrice" onclick="edit('.$value['id'].')" title="Update Price"><i class="fa fa-pencil"></i>Price</a>';	
			}

			//delete
			//$buttons .= ' <button type="button" class="btn btn-danger" onclick="remove('.$value['id'].')" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i>Delete</button>';

			$result['data'][$key] = array($images,$value['barcode'], strtoupper($value['product']),'₱ '.number_format($value['selling_price'],2),$brand['brand'], $availability, $buttons);
		}
		echo json_encode($result);
	}

	

	public function insert(){

		if(!in_array('createProduct', $this->permission)){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('product','Product','required');
		$this->form_validation->set_rules('manufacturer_price','Manufacturer price','required');
		$this->form_validation->set_rules('selling_price','Selling Price','required');
		$this->form_validation->set_rules('barcode','Barcode','required');
		$this->form_validation->set_rules('minimum_quantity','Minimum Quantity','required');
		
		if($this->form_validation->run()==true){
			$this->db->trans_begin();

			$do_upload = $this->do_upload();			
			
			$data=array(
				'id'				=>'',
				'product'			=>$this->input->post('product'),
				'barcode'			=>$this->input->post('barcode'),
				'manufacturer_price'=>$this->input->post('manufacturer_price'),
				'selling_price'		=>$this->input->post('selling_price'),
				'category_id'		=>$this->input->post('category'),
				'brand_id'			=>$this->input->post('brand'),
				'model_id'			=>$this->input->post('model'),
				'image'				=>$do_upload,
				'minimum_quantity'	=>$this->input->post('minimum_quantity'),
				'availability'		=>$this->input->post('availability'),
				'description'		=>$this->input->post('description')
			);
			$this->product_model->insert($data);

			$update_price=array(
				'id'				=>'',
				'product_id'		=>$this->product_model->get_id(),
				'manufacturer_price'=>$this->input->post('manufacturer_price'),
				'selling_price'		=>$this->input->post('selling_price'),
				'date_pending'		=>''
			);
			$this->product_pending_price_model->insert($update_price);
			
			for ($i=0; $i < count($this->input->post('supplier[]')); $i++) {
				$product_supplier=array(
					'id'=>'',
					'product_id'=>$this->product_model->get_id(),
					'supplier_id'=>$this->input->post('supplier['.$i.']')
				);
				$this->product_supplier_model->insert($product_supplier);
			}
			

			if($this->db->trans_status()==true){
        		$this->session->set_flashdata('success',"Product {$data['product']} succesfully saved");
				$this->action_log($this->user['id'],'Product','Add '.$data['product']);
				$this->db->trans_commit();
			}else{
        		$this->session->set_flashdata('error','Record not saved');
        		$this->db->trans_rollback();
			}
			redirect('product','refresh');
		}else{
			$this->render_template('product/add', $this->data);
		}
	}



	public function update($id=""){

		if(!in_array('updateProduct', $this->permission)||$id==null){ show_404(); }

		$this->form_validation->set_rules('product','Product','required');
		$this->form_validation->set_rules('barcode','Barcode','required');
		$this->form_validation->set_rules('category','Category','required');
		$this->form_validation->set_rules('brand','Brand','required');
		$this->form_validation->set_rules('model','Model','required');

		$response=array();

		$this->form_validation->set_rules('product','Product','required');

		if($this->form_validation->run()==true){
			$data=array(
				'product'			=>$this->input->post('product'),
				'category_id'		=>$this->input->post('category'),
				'brand_id'			=>$this->input->post('brand'),
				'model_id'			=>$this->input->post('model'),
				'availability'		=>$this->input->post('availability'),
				'description'		=>$this->input->post('description')
			);
			if(!empty($_FILES['product_image']['name'])){
				$do_upload = $this->do_upload();	
				$data['image']=$do_upload;
			}

			$this->product_supplier_model->delete(['product_id' => $id]);
			for ($i=0; $i < count($this->input->post('supplier[]')); $i++) {
				$product_supplier=array(
					'id'=>'',
					'product_id'=>$id,
					'supplier_id'=>$this->input->post('supplier['.$i.']')
				);
				$this->product_supplier_model->insert($product_supplier);
			}

			$old_data=$this->product_model->view($id);
			$update=$this->product_model->update($id, $data);
			if($update){
        		$this->session->set_flashdata('success',"Product {$old_data['product']} succesfully update");

				$this->action_log($this->user['id'],'Product','Update '.$data['product']);
			}else{
        		$this->session->set_flashdata('error',"Product not update");
			}
			redirect('product','refresh');
		}else{
			$this->data['product']=$this->product_model->view($id);
			$this->render_template('product/edit', $this->data);
		}
	}



	public function insert_price($id=""){
		$response=array();
		$password=$this->input->post('password');
		if($this->user['password']==md5($password)){
			$data=array(
				'manufacturer_price'=>$this->input->post('manufacturer_price'),
				'selling_price'		=>$this->input->post('selling_price'),
				'date_pending'		=>$this->input->post('date_implement')
			);
			$create=$this->product_pending_price_model->update($id,$data);
			if($create){
				$response['success']=true;
				$response['messages']='Product price update in '.$data['date_pending'];
			}else{
				$response['success']=false;
				$response['messages']='Product price not scheduled';
			}
		}else{
			$response['success']=false;
			$response['messages']="Incorrect password combination!";
		}
		echo json_encode($response);
	}
	// public function delete($id=""){

	// 	if(!in_array('deleteProduct', $this->permission)||$id==null){ show_404(); }

	// 	$response=array();

	// 	$delete=$this->product_model->delete($id);
	// 	if($delete){
	// 		$response['success']=true;
	// 		$response['messages']="Delete record successfully";
	// 	}else{
	// 		$response['success']=false;
	// 		$response['messages']="Record not deleted";
	// 	}

	// 	echo json_encode($response);
	// }



	public function find_by_id($id=""){
		if($id){
			$result = $this->product_model->view($id);
			echo json_encode($result);
		}
	}



	public function do_upload(){
        $config['upload_path'] = "images/product";
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';
        
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('product_image')){
            $errors = array('error' => $this->upload->display_errors());
            $new_name = 'null.jpg';
            return $new_name;
        } else {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['product_image']['name']);
            $type = $type[count($type) - 1];
            
            $path ='product/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;   
        }
    }
}
