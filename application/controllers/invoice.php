<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->confirm_login();
        $this->load->model('product_model');
        $this->load->model('customer_model');
        $this->load->model('invoice_model');
        $this->load->model('invoice_details_model');
        $this->load->model('vat_model');
        $this->load->model('inventory_model');


        $this->data['page_title']="Invoice";
        $this->data['product']=$this->product_model->view();
    }

    public function index() {
        $this->data['vat']=$this->vat_model->view();
        $this->render_template('invoice/index', $this->data);
    }

    public function search($keyword){
        $data = $this->product_model->search($keyword);
        echo json_encode($data);
    }

    public function insert(){
        $data=array();

        $this->form_validation->set_rules('or_number', 'Official Receipt Number', 'required');
        $this->form_validation->set_rules('name', 'Customer Name', 'required');
        $this->form_validation->set_rules('contact', 'Contact Number', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('payment', 'Payment', 'required');

        if($this->form_validation->run()==TRUE){

            $this->db->trans_begin();

            $discount_id=explode(',' , $this->input->post('discount'));
            if(empty($this->input->post('customer_id'))){
                $customer=array(
                    'id'        =>'',
                    'name'      =>$this->input->post('name'),
                    'address'   =>$this->input->post('address'),
                    'contact'   =>$this->input->post('contact'),
                    'email'     =>$this->input->post('email')
                );
                $this->customer_model->insert($customer);
                $customer_id=$this->customer_model->get_id();
            }else{
                $customer_id=$this->input->post('customer_id');
            }
            $income=0;

            $invoice=array(
                'id'=>'',
                'or_number'     =>$this->input->post('or_number'),
                'date_time'     =>date('Y-m-d'),
                'customer_id'   =>$customer_id,
                'gross_amount'  =>$this->input->post('gross_amount'),
                'discount'      =>$this->input->post('discount'),
                'vat'           =>$this->input->post('vat'),
                'net_total'     =>$this->input->post('subtotal'),
                'payment'       =>$this->input->post('payment'),
                'payment_change'=>$this->input->post('change'),
                'income'        =>0
            );

            $this->invoice_model->insert($invoice);


            for($index=0;$index<count($this->input->post('id[]'));$index++){
                
                $id = $this->input->post('id['.$index.']');
                $qty = $this->input->post('qty['.$index.']');

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
                    'action'        =>'Invoice'
                );
                $this->inventory_model->insert($inventory);
            }
            $this->invoice_model->update($this->invoice_model->get_id(),['income'=>$income]);

            $response=array();
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
        }else {
            $this->render_template('invoice/index', $this->data);
        }
    }

    public function find_invoice($from="",$to=""){
        $result=array('data'=>array());
        $total_discount=0;
        $total_net=0;

        $data = $this->invoice_model->view_by_range($from, $to);
        foreach ($data as $key => $value) {

            $customer=$this->customer_model->view($value['customer_id']);

            $buttons='';

            $buttons='<a data-toggle="modal" data-target="#detailsModal" onclick="details('.$value['id'].')" class="btn btn-info btn-xs"><i class="fa fa-arrows-alt"></i>View Details</a>';

            $result['data'][$key]=array($value['date_time'], $value['or_number'], $customer['name'],'₱ '.number_format($value['discount']),'₱ '.number_format($value['net_total'],2),$buttons);

            $total_net+=$value['net_total'];
            $total_discount+=$value['discount'];
        }
        $result['data'][] = array('-','-','<b>TOTAL</b>','<span class="label label-primary">₱'.number_format($total_discount,2).'</span>','<span class="label label-primary">₱'.number_format($total_net,2).'</span>','-');
        
        echo json_encode($result);
    }

    public function find_invoice_details($id){
        $result=array('data'=>array());
        $total_quantity=0;
        $total_amount=0;

        $data=$this->invoice_details_model->view_invoice($id);
        foreach ($data as $key => $value) {
            $product=$this->product_model->view($value['product_id']);

            $result['data'][$key]=array($product['barcode'],$product['product'],$value['rate'],$value['quantity'],$value['amount']);

            $total_quantity+=$value['quantity'];
            $total_amount+=$value['amount'];
        }
        $result['data'][] = array('-','-','<b>TOTAL</b>','<span class="label label-primary">'.$total_quantity.'</span>','<span class="label label-primary">₱'.number_format($total_amount,2).'</span>');
        echo json_encode($result);
    }

    public function get_detailed_invoice($from="", $to="",$category="",$product="",$supplier="",$from_price="",$to_price=""){
        $result = array('data' => array());
        $filter = array();
        
        if($from=='' && $to=='' && $category=='' && $product=='' && $supplier=='' && $from_price=='' && $to_price==''){
            $data = $this->invoice_details_model->filter($filter);
        }else{
            if($from !='na' && $to !='na'){
                $filter=['date_time >='=>$from,'date_time <='=>$to];
            }if($category !='na'){
                $filter['category_id']=$category;
            }if($product !='na'){
                $filter['tblinvoice_details.product_id']=$product;
            }if($supplier !='na'){
                $filter['supplier_id']=$supplier;
            }if($from_price !='na' && $to_price !='na'){
                $filter=['rate >='=>$from_price,'rate <='=>$to_price];
            }

            if($supplier!='na'){
                $data = $this->invoice_details_model->filter_w_supplier($filter);   
            }else{         
                $data = $this->invoice_details_model->filter($filter);
            }
        }
        foreach ($data as $key => $value) {
            $product=$this->product_model->view($value['product_id']);
            $result['data'][$key] = array($value['date_time'],$value['or_number'],$product['product'],"₱ ".number_format($value['rate'],2),$value['quantity'],"₱ ".number_format($value['amount'],2));
        }
        echo json_encode($result);
    }
}       
?>