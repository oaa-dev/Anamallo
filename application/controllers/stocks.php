<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stocks extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('brand_model');
		$this->data['page_title']="Stocks";
	}

	public function index(){
		$this->data['product_list']=$this->product_model->view();
		$this->data['category_list']=$this->category_model->view();
		$this->data['brand_list']=$this->brand_model->view();
		$this->render_template('stocks/index',$this->data);
	}



	//call in stocks
	public function find_details($by='',$product="",$brand="",$category=""){ 
		$result = array('data' => array());
		$filter = array();
		
		if($product=="" && $brand=="" && $category==""){
			$data = $this->product_model->view();
		}else{
			if($product != '' && $product != 'na'){
				$filter['id']=$product;
			}if($brand != '' && $brand != 'na'){
				$filter['brand_id']=$brand;
			}if($category != '' && $category != 'na'){
				$filter['category_id']=$category;
			}

			$data = $this->product_model->filter($filter);
		}
		foreach ($data as $key => $value) {
			$alert='';

			if($value['stocks']<=0){
				$alert='<label class="label label-danger">Out of stocks!</label>';
			}elseif($value['stocks']<=$value['minimum_quantity']){
				$alert='<label class="label label-warning">Low stocks!</label>';
			}
			$button='';
			$stat=($value['stocks']<=0)?'disabled':null;
			if(in_array('createIssue', $this->permission)){
				$button='<button class="btn btn-primary btn-xs" '.$stat.' data-toggle="modal" data-target="#addModal" onclick="issue('.$value['id'].')">Issue Product</button>';
			}

			$total_price = ($value['stocks'] * $value['selling_price']);
			if($by=='all'){
				$result['data'][] = array($value['barcode'], $value['product'], '₱ '.number_format($value['selling_price'],2), $value['stocks'].'&emsp;'.$alert, '₱ '.number_format($total_price,2),$button);
			}
			elseif($by=='low'){
				if($value['stocks']<=$value['minimum_quantity']&&$value['stocks']>0){
					$result['data'][] = array($value['barcode'], $value['product'], '₱ '.number_format($value['selling_price'],2), $value['stocks'].'&emsp;'.$alert, '₱ '.number_format($total_price,2),$button);
				}
			}elseif($by=='out'){
				if($value['stocks']<=0){
					$result['data'][] = array($value['barcode'], $value['product'], '₱ '.number_format($value['selling_price'],2), $value['stocks'].'&emsp;'.$alert, '₱ '.number_format($total_price,2),$button);
				}
			}
		}
		echo json_encode($result);
	}
}
?>