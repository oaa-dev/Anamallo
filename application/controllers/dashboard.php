<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('invoice_model');
		$this->load->model('invoice_details_model');
		$this->load->model('user_model');
		$this->load->model('supplier_model');
		$this->load->model('report_model');
		$this->load->model('product_model');
		$this->load->model('brand_model');
		$this->load->model('category_model');
		$this->load->model('model_model');

		$this->confirm_login();
		$this->data['page_title']="Dashboard";
	}
 	
 	public function brand_total_purchase(){
        $filter = array();
        $data=$this->invoice_details_model->filter($filter);
        $brand=$this->brand_model->view();
        foreach ($brand as $key1 => $value1) {
	        $total=array();
        	foreach ($data as $key2 => $value2) {
        		$product=$this->product_model->view($value2['product_id']);
        		if($value1['id']==$product['brand_id']){
        			$total[]=$value2['quantity'];
        		}
        	}
        	$brand_total[$value1['brand']]=array_sum($total);
        }
        return $brand_total;
    }
	
	public function category_total_purchase(){
        $result = array('data' => array());
        $filter = array();
        $total=array();
        $data=$this->invoice_details_model->filter($filter);
        $category=$this->category_model->view();
        foreach ($category as $key1 => $value1) {
	        $total=array();
        	foreach ($data as $key2 => $value2) {
        		$product=$this->product_model->view($value2['product_id']);
        		if($value1['id']==$product['category_id']){
        			$total[]=$value2['quantity'];
        		}
        	}
        	$category_total[$value1['category']]=array_sum($total);
        }
        return $category_total;
    }

    public function model_total_purchase(){
        $result = array('data' => array());
        $filter = array();
        $total=array();
        $data=$this->invoice_details_model->filter($filter);
        $model=$this->model_model->view();
        foreach ($model as $key1 => $value1) {
	        $total=array();
        	foreach ($data as $key2 => $value2) {
        		$product=$this->product_model->view($value2['product_id']);
        		if($value1['id']==$product['model_id']){
        			$total[]=$value2['quantity'];
        		}
        	}
        	$model_total[$value1['model']]=array_sum($total);
        }
        return $model_total;
    }

    public function product_total_purchase(){
        $result = array('data' => array());
        $filter = array();
        $total=array();
        $data=$this->invoice_details_model->filter($filter);
        $product=$this->product_model->view();
        foreach ($product as $key1 => $value1) {
	        $total=array();
        	foreach ($data as $key2 => $value2) {
        		$invoice=$this->invoice_model->view($value2['invoice_id']);
        		if($value1['id']==$value2['product_id'] && explode('-',$invoice['date_time'])[0]==date('Y')){
        			$total[]=$value2['quantity'];
        		}
        	}
        	$product_total[$value1['product']]=array_sum($total);
        }
        return $product_total;
    }


	public function index(){

		if($this->user['group_id']=='3'){ show_404(); }

		$pie_data=$this->input->post('pie_data');
		if($pie_data=="" || $pie_data=="product"){
			$this->data['pie2']=$this->product_total_purchase();
		}else if($pie_data=="model"){
			$this->data['pie2']=$this->model_total_purchase();
		}else if($pie_data=="category"){
			$this->data['pie2']=$this->category_total_purchase();
		}else if($pie_data=="brand"){
			$this->data['pie2']=$this->brand_total_purchase();
		}

		$this->data['best_selling']=$this->report_model->best_selling();
		$this->data['total_invoice_sales']='₱ '.number_format($this->invoice_model->sum_all());
		$this->data['total_invoices']=number_format($this->invoice_model->count_all());
		$this->data['total_users']=number_format($this->user_model->count_all());
		$this->data['total_products']=number_format($this->product_model->count_all_available());
		$this->data['total_sales']=$this->report_model->getTotalSales(date('Y'));
		$this->data['total_tax']=$this->report_model->getTotalTax(date('Y'));
		$this->data['total_invoice']=$this->report_model->getTotalInvoice(date('Y'));
		$this->data['pie']=$this->report_model->get_sales("","");

		$description=array();
		$total=array();
		$top_five=array();


		$data=$this->report_model->best_selling();
		foreach ($data as $key => $value) {
			$button='';
			$product=$this->product_model->view($value['product_id']);
			$button='<a class="btn btn-default" onclick="info('.$product['id'].')" data-toggle="modal" data-target="#large"><i class="fa fa-arrows-alt"></i>Details</a>';
			$top_five[] = array($product['product'],$product['selling_price'],$value['total_quantity'],$button);
			
		}
		$this->data['top_five'] = $top_five;
		$this->render_template('dashboard',$this->data);
	}
}
?>