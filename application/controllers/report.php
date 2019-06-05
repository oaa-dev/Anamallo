<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->confirm_login();		
		$this->load->model('invoice_model');
		$this->load->model('purchase_model');
		$this->load->model('user_model');
		$this->load->model('supplier_model');
		$this->load->model('report_model');
		$this->load->model('product_model');
		$this->load->model('customer_model');
		$this->load->model('inventory_model');
		$this->load->model('category_model');

		$this->data['page_title']='Reports';
		$this->data['product_list']=$this->product_model->view();
		$this->data['category_list']=$this->category_model->view();
		$this->data['supplier_list']=$this->supplier_model->view();	
	}

	public function sales(){
		$this->render_template('report/sales',$this->data);
	}

	public function detailed_sales(){
		$this->render_template('report/detailed_sales',$this->data);
	}

	public function get_sales($from="",$to=""){

		$result=array('data'=>array());
		$total_invoice=0;
		$total_amount=0;
		$total_vat=0;
		$total_income=0;

		$data = $this->report_model->get_sales($from, $to);
		foreach ($data as $key => $value) {
			$result['data'][$key]=array($value['date_time'],$value['total_invoice'],'₱ '.number_format($value['total_amount'],2),'₱ '.number_format($value['total_vat'],2),'₱ '.number_format($value['total_income'],2));
			$total_invoice+=$value['total_invoice'];
			$total_amount+=$value['total_amount'];
			$total_vat+=$value['total_vat'];
			$total_income+=$value['total_income'];
		}
		$result['data'][]=array('<b>TOTAL </b>','<span title="'.number_format($total_invoice).'" class="label label-primary">'.number_format($total_invoice).'</span>','<span title="" class="label label-primary">₱ '.number_format($total_amount,2).'</span>','<span title="" class="label label-primary">₱ '.number_format($total_vat,2).'</span>','<span title="" class="label label-primary">₱ '.number_format($total_income,2).'</span>');
		echo json_encode($result);
	}


	public function inventory(){
		$this->render_template('report/inventory',$this->data);
	}

	public function invoice(){
		$this->render_template('report/invoice',$this->data);
	}


	public function purchase(){
		$this->render_template('report/purchase',$this->data);
	}

	public function get_inventory($from="", $to="",$action="",$category="",$product="",$supplier=""){
		$result = array('data' => array());
		$filter = array();
			
		if($from=='' && $to=='' && $action=='' && $category=='' && $product=='' && $supplier==''){
			$data = $this->inventory_model->view();
		}else{
			if($from !='na' && $to !='na'){
				$filter=['date_time >='=>$from,'date_time <='=>$to];
			}if($action !='na'){
				$filter['action']=$action;
			}if($category !='na'){
				$filter['category_id']=$category;
			}if($product !='na'){
				$filter['tblinventory.product_id']=$product;
			}if($supplier !='na'){
				$filter['supplier_id']=$supplier;
			}
			$data = $this->inventory_model->filter($filter);
		}
		foreach ($data as $key => $value) {
			$product=$this->product_model->view($value['product_id']);
			$user=$this->user_model->view($value['user_id']);
			$result['data'][$key] = array($value['date_time'],$user['username'],$product['product'],"₱ ".number_format($value['price'],2),$value['quantity'],"₱ ".number_format($value['total'],2),$value['action']);
		}
		echo json_encode($result);
	}
}
