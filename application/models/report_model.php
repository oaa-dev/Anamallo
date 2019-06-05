<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_Model extends CI_Model{


	public $month =  array('1','2','3','4','5','6','7','8','9','10','11','12');

	public function __construct(){
		parent::__construct();

		$this->load->model('product_model');
	}

	public function best_selling(){
		$this->db->select('product_id')
			->select_sum('quantity', 'total_quantity')
			->from('tblinvoice_details')
			->group_by('product_id')
			->order_by('total_quantity','DESC')
			->limit(5);

		return $this->db->get()->result_array();
	}

	public function get_sales($froms, $to){
		$sql='';
		if(!empty($froms)&&!empty($to)){
			$sql="SELECT date_time, COUNT(id) AS total_invoice, SUM(net_total) AS total_amount, SUM(vat) AS total_vat, SUM(income) AS total_income FROM tblinvoice WHERE date_time >='".$froms."' AND date_time <= '".$to."' GROUP BY(date_time)";
		}else{
			$sql="SELECT date_time, COUNT(id) AS total_invoice, SUM(net_total) AS total_amount, SUM(vat) AS total_vat, SUM(income) AS total_income FROM tblinvoice GROUP BY(date_time)";
		}
		return $this->db->query($sql)->result_array();
	}

	public function getTotalSales($year=""){

		$data =	$this->db->get('tblinvoice')->result_array();
		

		$total=0;
		$result=array();

		for($index1=0;$index1<count($this->month);$index1++){
			$sum=array();
			for($index2=0;$index2<count($data);$index2++){
				if(explode('-',$data[$index2]['date_time'])[1]==$this->month[$index1]&&explode('-',$data[$index2]['date_time'])[0]==$year){
					$sum[]=$data[$index2]['net_total'];
				}
			}
			$result[$this->month[$index1]]=array_sum($sum);
		}
		return $result;
	}

	public function getTotalTax($year=""){

		$data =	$this->db->get('tblinvoice')->result_array();
		
		$result=array();

		for($index1=0;$index1<count($this->month);$index1++){
			$sum=0;
			for($index2=0;$index2<count($data);$index2++){
				if(explode('-',$data[$index2]['date_time'])[0]==$year&&explode('-',$data[$index2]['date_time'])[1]==$this->month[$index1]){
					$sum+=$data[$index2]['vat'];
				}
			}
			$result[$this->month[$index1]]=$sum;
		}
		return $result;
	}

	public function getTotalInvoice($year=""){

		$data =	$this->db->get('tblinvoice')->result_array();
		
		$total=0;
		$result=array();

		for($index1=0;$index1<count($this->month);$index1++){
			$sum=array();
			$ctr=0;
			for($index2=0;$index2<count($data);$index2++){
				if(explode('-',$data[$index2]['date_time'])[1]==$this->month[$index1]&&explode('-',$data[$index2]['date_time'])[0]==$year){
					$ctr++;
				}
			}
			$result[$this->month[$index1]]=$ctr;
		}
		return $result;
	}
}
?>