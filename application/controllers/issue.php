<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issue extends MY_Controller {
	


	public function __construct(){
		parent::__construct();

		$this->confirm_login();
		$this->load->model('issue_model');
		$this->load->model('product_model');
		$this->load->model('inventory_model');

		$this->data['page_title']='Issue';
	}

	public function index(){
		$this->render_template('issue/index',$this->data);
	}

	public function insert(){
		$response=array();

		$this->form_validation->set_rules('reason','Reason','required');
		$this->form_validation->set_rules('quantity', 'Quantity','required');

		if($this->form_validation->run()==true){
			$this->db->trans_begin();

			$product_id=$this->input->post('product_id');
			$quantity=$this->input->post('quantity');
			
			$data=array(
				'id'			=>'',
				'product_id'	=>$product_id,
				'price'			=>$this->input->post('price'),
				'quantity'		=>$quantity,
				'total'			=>$this->input->post('total'),
				'reason'		=>$this->input->post('reason'),
				'date_issue'	=>date("Y-m-d"),
				'remarks'		=>$this->input->post('remarks')
			);
			$this->issue_model->insert($data);
			
            $product=$this->product_model->view($product_id)['stocks'];
			$new_stocks=$product-$quantity;
			$this->product_model->update($product_id,['stocks'=>$new_stocks]);

            $inventory=array(
                'id'            =>'',
                'date_time'		=>date('Y-m-d'),
                'product_id'    =>$product_id,
                'user_id'       =>$this->user['id'],
                'price'			=>$this->input->post('price'),
                'quantity'      =>$quantity,
                'total'			=>$this->input->post('total'),
                'action'        =>"Issue"
            );
            $this->inventory_model->insert($inventory);

			$response=array();
			if($this->db->trans_status()==true){
				$response['success']=true;
				$response['messages']='Stocks Update';

                $this->action_log($this->user['id'],'Issues','Add Issues product id : '.$data['product_id'].'quantity :'.$data['quantity'].'');
				$this->db->trans_commit();
			}else{
				$response['success']=false;
				$response['messages']='An error encounter!';
				
				$this->db->trans_rollback();
			}
			echo  json_encode($response);
		}else{
			redirect('stocks','refresh');
		}
	}

	public function find_issue(){
		$result=array('data'=>array());

		$data=$this->issue_model->view();
		foreach($data as $key => $value) {
			$product=$this->product_model->view($value['product_id']);

			$result['data'][$key]=array($value['date_issue'],$product['product'],'₱ '.number_format($value['price'],2),$value['quantity'],'₱ '.number_format($value['total'],2),$value['reason'],$value['remarks']);
		}
		echo  json_encode($result);
	}
}
