<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Return_Product extends MY_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->confirm_login();
		$this->load->model('return_product_model');
		$this->load->model('invoice_model');
		$this->load->model('invoice_details_model');
		$this->load->model('customer_model');
		$this->load->model('vat_model');
		$this->load->model('product_model');
		$this->load->model('inventory_model');

		$this->data['page_title']='Return';
	}
	
	public function index(){
		if(!in_array('createBrand',$this->permission)&&
			!in_array('updateBrand',$this->permission)&&
			!in_array('viewBrand',$this->permission)){
			
			show_404();
		}

		$this->render_template('return/index',$this->data);
	}

	public function add(){
        $this->data['vat']=$this->vat_model->view();
		$this->render_template('return/add',$this->data);
	}

	public function insert(){
		$response=array();
		$this->db->trans_begin();

		$invoice=array(
            'id'=>'',
            'or_number'     =>$this->input->post('or_number'),
            'date_time'     =>date('Y-m-d'),
            'customer_id'   =>$this->input->post('cust_id'),
            'gross_amount'  =>$this->input->post('balance_amount'),
			'vat'           =>$this->input->post('vat'),
            'net_total'     =>$this->input->post('balance_amount'),
            'payment'       =>$this->input->post('payment'),
            'payment_change'=>$this->input->post('change'),
            'income'        =>0
        );

        $this->invoice_model->insert($invoice);
        for($index=0;$index<count($this->input->post('id_invoice[]'));$index++){
                
            $id = $this->input->post('id_invoice['.$index.']');
            $qty = $this->input->post('qty_invoice['.$index.']');

            $product = $this->product_model->view($id);
            $subtotal = (double)($product['selling_price'] * $qty);
            $markup=($product['selling_price'])-($product['manufacturer_price']);
            $total_markup=(double)($markup)*(int)($qty);
            $income+=$total_markup;
            $cart=array(
                'id'=>'',
                'invoice_id'    =>$this->invoice_model->get_id(),
                'product_id'    =>$id,
                'quantity'      =>$qty,
                'rate'          =>$product['selling_price'],
                'amount'        =>$subtotal,
                'markup'        =>$total_markup
            );
            $this->invoice_details_model->insert($cart);

            $new_stocks=(int)$product['stocks']-(int)$qty;
            $this->product_model->update($id, array('stocks'=>$new_stocks));

            $inventory=array(
                'id'            =>'',
                'date_time'     =>date('Y-m-d'),
                'product_id'    =>$id,
                'user_id'       =>$this->user['id'],
                'price'         =>$product['selling_price'],
                'quantity'      =>$qty,
                'total'         =>$subtotal,
                'action'        =>'Return'
            );
            $this->inventory_model->insert($inventory);
        }
        $this->invoice_model->update($this->invoice_model->get_id(),['income'=>$income]);



		for ($index=0; $index < count($this->input->post('id[]')); $index++) {
			$data=array('id'=>'',
				'invoice_id'=>$this->input->post('invoice_id'),
				'invoice_details_id'=>$this->input->post('id['.$index.']'),
				'quantity'=>$this->input->post('qty['.$index.']'),
				'status'=>'not replaced',
				'date_time'=>date('Y-m-d')
			);
			$this->return_product_model->insert($data);
		}
		if($this->db->trans_status()==true){
            $response['success']=true;
            $response['messages']="Transaction {$invoice['or_number']} complete!";
            $this->db->trans_commit();

            $this->action_log($this->user['id'],'Invoice','Add Transaction '.$invoice['or_number']);
        }else{
            $response['success']=false;
            $response['messages']='An error Occured!';
            $this->db->trans_rollback();
        }
		echo json_encode($response);
	}

    public function find_by_or($or_number=""){
        $response=array();
        $invoice = $this->invoice_model->view_by_or($or_number);
        $data = $this->invoice_details_model->view_invoice($invoice['id']);
        $customer = $this->customer_model->view($invoice['customer_id']);
        $response[]=array('invoice_id'=>$invoice['id']);
        $response[]=$customer;
        foreach ($data as $key => $value) {
            $product = $this->product_model->view($value['product_id']);
            $response[]=array('id'=>$value['id'],'barcode'=>$product['barcode'],'product'=>$product['product'],'price'=>$value['rate'],'quantity'=>$value['quantity'],'amount'=>$value['amount']);
        }
        echo json_encode($response);
    }

	public function find_all(){
		$result = array('data' => array());

		$data = $this->return_product_model->view();
		foreach ($data as $key => $value) {
			$details=$this->invoice_details_model->view($value['invoice_details_id']);
			$invoice=$this->invoice_model->view($value['invoice_id']);
			$product=$this->product_model->view($details['product_id']);
			$result['data'][$key] = array($value['date_time'],$invoice['or_number'],$product['product'],$value['quantity'],$details['rate']);
		}
		echo json_encode($result);
	}
}
