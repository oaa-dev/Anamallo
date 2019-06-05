<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase extends MY_Controller {
	

	public function __construct(){
		parent::__construct();

		$this->confirm_login();
		$this->load->model('purchase_model');
		$this->load->model('supplier_model');
		$this->load->model('product_model');
		$this->load->model('markup_model');
		$this->load->model('purchase_details_model');
		$this->load->model('inventory_model');

		$this->data['page_title']='Purchase';
		$this->data['supplier']=$this->supplier_model->find_active();
		$this->data['product']=$this->product_model->find_active();
	}
	
	
    public function search($keyword){
        $data = $this->product_model->search_w_supplier($keyword);
        echo json_encode($data);
    }

	public function index(){
		if(!in_array('createPurchase', $this->permission)){ show_404(); }
		
		$this->render_template('purchase/index',$this->data);
	}

	public function insert(){

		if(!in_array('createPurchase', $this->permission)){ show_404(); }

		$response=array();

		$this->form_validation->set_rules('date_supplied', 'Date Supplied', 'required');
		$this->form_validation->set_rules('or_number', 'Official Receipt', 'required');

		if($this->form_validation->run()==true){

			$this->db->trans_begin();

			$purchase=array(
				'id'				=>'',
				'supplier_id'		=>$this->input->post('supplier'),
				'or_number'			=>$this->input->post('or_number'),
				'date_supplied'		=>$this->input->post('date_supplied'),
				'purchase_price'	=>$this->input->post('purchase_price'),
				'purchase_quantity'	=>$this->input->post('purchase_quantity')
			);
			$create=$this->purchase_model->insert($purchase);

			$counter=count($this->input->post('product[]'));
			for($index=0;$index<$counter;$index++){
				$details=array(
					'id'			=>'',
					'purchase_id'	=>$this->purchase_model->get_id(),
					'product_id'	=>$this->input->post('product['.$index.']'),
					'total_price'	=>$this->input->post('totalprice['.$index.']'),
					'price'			=>$this->input->post('price['.$index.']'),
					'quantity'		=>$this->input->post('quantity['.$index.']')
				);
				$create=$this->purchase_details_model->insert($details);
				
				$product_data=$this->product_model->view($this->input->post('product['.$index.']'));
				$new_stocks=(int)($this->input->post('quantity['.$index.']')) + (int)($product_data['stocks']);

				$product=array('stocks'=>$new_stocks);
				$create=$this->product_model->update($this->input->post('product['.$index.']'),$product);

                $inventory=array(
                    'id'            =>'',
                    'date_time'		=>date('Y-m-d'),
                    'product_id'    =>$this->input->post('product['.$index.']'),
                    'user_id'       =>$this->user['id'],
                    'price'			=>$this->input->post('sellingprice['.$index.']'),
                    'quantity'      =>$this->input->post('quantity['.$index.']'),
                    'total'			=>$this->input->post('totalprice['.$index.']'),
                    'action'        =>'Purchase'
                );
                $this->inventory_model->insert($inventory);
			}

			$response=array();
            if($this->db->trans_status()==true){
                $response['success']=true;
                $response['messages']="Transaction {$purchase['or_number']} complete!";
                $this->db->trans_commit();

                $this->action_log($this->user['id'],'Purchase','Add Purchase '.$purchase['or_number']);
            }else{
                $response['success']=false;
                $response['messages']='An error occured!';
                $this->db->trans_rollback();
            }
            echo json_encode($response);
		}else{
			$this->render_template('purchase/index',$this->data);
		}
	}

	//find all data
	public function find_purchase($from="", $to=""){
		$result = array('data' => array());
		$total_purchase=0;
		$total_price=0;

		$data = $this->purchase_model->view_by_range($from, $to);
		foreach ($data as $key => $value) {

			$supplier = $this->supplier_model->view($value['supplier_id']);
			$buttons = '';
			
			$buttons = ' <a data-toggle="modal" data-target="#detailsModal" onclick="details('.$value['id'].')" class="btn btn-info btn-xs details"><i class="fa fa-arrows-alt"></i>Details</a>';
		
			$result['data'][$key] = array($value['or_number'],$value['date_supplied'],$supplier['supplier'], $value['purchase_quantity'], '₱ '.number_format($value['purchase_price'],2),  $buttons);

			$total_purchase+=$value['purchase_quantity'];
			$total_price+=$value['purchase_price'];
		}
		$result['data'][] = array('-','-','<b>TOTAL</b>','<span class="label label-primary">'.$total_purchase.'</span>', '<span class="label label-primary">₱ '.number_format($total_price,2).'</span>','-');

		echo json_encode($result);
	}

	public function find_purchase_details($id){
		$result = array('data' => array());
		$total_quantity=0;
		$total_price=0;

		$data = $this->purchase_details_model->view($id);
		foreach ($data as $key => $value) {
			$product = $this->product_model->view($value['product_id']);

			$result['data'][$key] = array($product['barcode'],$product['product'],'₱ '.number_format($value['price'],2), $value['quantity'],'₱ '.number_format($value['total_price'],2));

			$total_quantity+=$value['quantity'];
			$total_price+=$value['total_price'];
		}
        $result['data'][] = array('-','-','<b>TOTAL</b>','<span class="label label-primary">'.$total_quantity.'</span>','<span class="label label-primary">₱'.number_format($total_price,2).'</span>');
		echo json_encode($result);
	}

	//-------------------------purchase Details-------------------------------


	public function find_by_id($id){
		$result = $this->purchase_details_model->view_details_info($id);
		echo json_encode($result);	
	}
}
