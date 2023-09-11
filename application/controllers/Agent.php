<?php
defined('BASEPATH') or exit('No direct script access allowed');
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Agent extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Agentmodel');
		$this->load->model('General_model');
		$this->load->library('session');
		date_default_timezone_set('Asia/Kolkata');
		if ($this->session->agent_id == "") {
			return redirect('Admin/index');
		}
	}

	//--------------Navigation-----------------------
	public function dashboard()
	{

		$id = $this->session->agent_id;
		$this->session->roi ? $this->session->set_userdata('roi', '') : $this->session->set_userdata('roi', '');

		$data['Agent'] = $this->Agentmodel->getAgentdata($id);
		$data['project'] = $this->General_model->record_count('quoitem', array('Agid' => $id, 'projectCreated' => 1));
		$data['quotation'] = $this->General_model->record_count('quoitem', array('Agid' => $id));
		$data['enquiry'] = $this->General_model->record_count('enquiry', array('AgentId' => $id));
		$data['remind'] = $this->Agentmodel->getreminderdata($id);

		$this->session->set_userdata('firstName', $data['Agent']->name);
		$this->load->view('Agent/index', $data);
	}
	public function newEnquiry()
	{
		$id = $this->session->agent_id;
		$rt['details'] = $this->Agentmodel->getnewenquiry();
		$this->load->view('Agent/newEnquiry', $rt);
	}

	public function allEnquiry()
	{
		$id = $this->session->agent_id;
		$rt['details'] = $this->Agentmodel->allAcceptenquiry($id);
		$this->load->view('Agent/allEnquiry', $rt);
	}

	public function Generate()
	{
		$id = $this->session->agent_id;
		$rt['details'] = $this->Agentmodel->getquotation($id);
		$this->load->view('Agent/generateQuotation', $rt);
	}

	public function allquotationlist()
	{
		$id = $this->session->agent_id;
		$rt['details'] = $this->Agentmodel->allquotationdata($id);
		$rt['status'] = $this->General_model->fetch_data('quotationstatus', array());
		$this->load->view('Agent/allquotationlist', $rt);
	}


	//------------------Dashboard-------------------

	public function notification($id)
	{

		$rt = $this->Agentmodel->getremiderdata($id);
		$this->load->view('Agent/reminderdata', ['reminder' => $rt]);
	}
	public function notifi($id)
	{
		$rt = $this->Agentmodel->getallremiderdata($id);
		$this->load->view('Agent/allreminder', ['reminder' => $rt]);
	}

	public function updateAgent($id)
	{
		$post = $this->input->post();
		if (!empty($post)) {
			$this->load->model('AdminDashboard');
			if ($this->AdminDashboard->updateAgent($id, $post)); {
				$this->session->set_flashdata('update', 'Agent Details Update Successful');
				return redirect('Agent/dashboard');
			}
			/*else
				{
					$this->session->set_flashdata('update','Product Details Unable to update');
							 	 return redirect('Admin/editproduct');
				}*/
		}
	}

	//-------------------New Enquiry--------------------



	public function AcceptEnq()
	{
		$post = $this->input->post();
		$id =  $this->uri->segment(2);
		$Agid = $this->session->agent_id;
		$rt = $this->Agentmodel->AcceptEnquiry($id, $post, $Agid); {
			$this->session->set_flashdata('update', 'Enquiry Accept Sucessfully. Please check your All Enquiry & for making Quotation Go To Quotation.');
			return redirect('Agent/newenquiry');
		}
	}
	/*public function allenquiry($id)
	{
		
	if(!$this->session->userdata('id'))
			return redirect('Admin/index');
		
		$rt['details']=$this->Agentmodel->getallenquiry($id);
		$this->load->view('Agent/allenquiry',$rt);
	}*/



	//-------------------- Generate Quotation-----------------------------

	public function geneQuote()
	{
		$id = $this->session->agent_id;
		$this->load->library('cart');
		if (empty($this->cart->contents())) {
			$eid = $this->uri->segment(2);
			$this->session->set_userdata('enq_id', $eid);
		}


		$data['details'] = $this->Agentmodel->getProductWithCategory();
		$data['category'] = $this->General_model->fetch_data('productcategory', array());
		$this->load->view('Agent/genQuote', $data);
	}
	public function geneQuoteag()
	{
		$data['details'] = $this->Agentmodel->getProductWithCategory();
		$this->load->view('Agent/genQuote', $data);
	}

	public function AddProduct()
	{

		$id = $this->session->agent_id;
		$Pid = $this->input->post('pid');

		for ($i = 0; $i < sizeof($Pid); $i++) {
			$data = $this->Agentmodel->AddProd($Pid[$i]);

			$quotedata = array(
				'id' => $data['id'],
				'category' => $data['category'],
				'name' => $data['name'],
				'supplier' => $data['supplier'],
				'spec' => $data['spec'],
				'uom' => $data['uom'],
				'qty' => $data['qty'],
				'price' => $data['price']
			);
			$this->load->library('cart');
			$this->cart->product_name_rules = '[:print:]';
			$added = $this->cart->insert($quotedata);
		}

		if ($added) {
			$this->session->set_flashdata('add', 'Product Added Successful.');
			redirect('Agent/finalquote');
		} else {
			$this->session->set_flashdata('error', 'Product Not Added.');
			redirect('Agent/geneQuote');
		}
	}

	public function finalquote()
	{
		$this->load->library('cart');
		$this->load->view('Agent/finalquote');
	}


	public function updateitem()
	{
		$this->load->library('cart');
		$update = 0;
		$rowid = $this->input->get('rowid');
		$qty = $this->input->get('qty');
		if (!empty($rowid) && !empty($qty)) {
			$data = array(
				'rowid' => $rowid,
				'qty' => $qty
			);


			$update = $this->cart->update($data);
			echo $update ? 'ok' : 'err';
		}
	}
	public function removeitem($rowid)
	{
		$this->load->library('cart');
		$remove = $this->cart->remove($rowid);
		redirect('Agent/finalquote');
	}

	public function quotation()
	{
		$this->load->library('cart');

		$enqId = $this->session->enq_id;
		$Agid = $this->session->agent_id;

		$data['enq'] = $this->Agentmodel->getenquirydata($enqId);
		$data['referenceEnquiry'] = $this->General_model->fetch_single_data('refference_enquiry', array('enquiryId' => $enqId));


		$per = $this->input->post('comm');
		$cond1          = array();
		$termAndCondition['paymentTerm'] = $this->General_model->fetch_data('termcondition', $cond1, $fields = null, 	$orderby = array());
		$this->session->set_userdata('termAndCondition', $termAndCondition);
		if ($per > 0) {
			$gd = $this->cart->total();
			$comm = $gd * (($per + 5) / 100);
			$amt = $gd + $comm;


			$this->session->set_userdata('Commission', $amt);

			$this->session->set_userdata('rate', $per);
			$this->session->set_userdata('rateAmt', $comm);
			$this->load->view('Agent/finalquote', $data);
		} else {

			$this->session->set_flashdata('warning', 'Please Mention Commission Rate. If No Rate Please Mention 0');
			$this->load->view('Agent/quotation', $data);
		}
	}

	public function pdf()
	{
		$this->load->library('cart');

		$enqId = $this->session->enq_id;
		$commi = $this->session->Commission;
		$rate = $this->session->rate;
		$Agid = $this->session->agent_id;
		$paymentTerm = $this->session->paymentTermAmount;
		$referenceCommissionAmount = $this->session->referenceCommissionAmount;
		$termAndCondition = $this->input->post('termAndCondition');
		$expiryDate = $this->input->post('expiryDate');
		$total = $this->cart->total();

		$enqdata = $this->Agentmodel->getenquirydata($enqId);

		$no = $this->cart->total_items();
		$this->load->helper('string');
		$val = random_string('numeric', 5);
		$quoId = "EGS/QUO/" . $val;
		$this->session->set_userdata('enqid', $quoId);
		$this->session->set_userdata('termAndCondition', $termAndCondition);
		$this->session->set_userdata('expiryDate', $expiryDate);

		foreach ($paymentTerm as  $value) {
			$paymentDataArray[] = implode(':', $value);
		}
		$paymentData = implode(';', $paymentDataArray);
		$this->session->set_userdata('paymentData', $paymentData);

		foreach ($this->cart->contents() as $key) {
			$productData = array(
				'id' => $key['id'],
				'Qty' =>  $key['qty'],
				'price' => $key['price']
			);

			$productArray[] = implode(':', $productData);
			$pdata = implode(':', $productData);
			$data = $this->Agentmodel->checkdata($pdata, $quoId);
		}

		$products = implode(',', $productArray);

		$total = $this->cart->total();

		$taxAmount = 0;
		$gstfive = 0;
		$amountWithEighteen = 0;
		$amountWithTwelve = 0;
		$gstEighteen = 0;
		$gstTwelve = 0;
		if ($enqdata['Grid'] == 'PUMP' || $enqdata['Grid'] == 'SOLAR WATER HEATER' || $enqdata['Grid'] == 'DEFAULT' || $enqdata['Grid'] == 'STREET LIGHT') {
			if ($referenceCommissionAmount > 0) {
				$taxAmount  = $referenceCommissionAmount + ($commi * $enqdata['quantity']);
			} else {
				$taxAmount = ($commi * $enqdata['quantity']);
			}
			$gstfive = $taxAmount * (12 / 100);
		} else {
			if ($referenceCommissionAmount > 0) {
				$taxAmount  = $referenceCommissionAmount + ($commi * $enqdata['quantity']);
			} else {
				$taxAmount = ($commi * $enqdata['quantity']);
			}
			$seventy = $taxAmount * (70 / 100);
			$three = $taxAmount * (30 / 100);
			$gstTwelve = $seventy * (12 / 100);
			$gstEighteen = $three * (18 / 100);
			$amountWithTwelve = $seventy + $gstTwelve;
			$amountWithEighteen = $three + $gstEighteen;
		}

		if ($gstfive == 0) {
			$NetAmount = $amountWithEighteen + $amountWithTwelve;
		} else {
			$NetAmount = $taxAmount + $gstfive;
		}

		if ($referenceCommissionAmount != 0) {
			$commissionData = array('commissionAmount' => $referenceCommissionAmount, 'quotationId' => $quoId);
			$successAccept = $this->General_model->update('refference_enquiry', $commissionData, array('enquiryId' => $enqdata['EnqId']));
		}

		$quotationData = array(
			'productData' => $products,
			'enqId' => $enqdata['EnqId'],
			'quotationId' => $quoId,
			'commission' => $commi,
			'quantity' => $enqdata['quantity'],
			'rate' => $rate,
			'gstTwelve' => $gstTwelve == 0 ? $gstfive : $gstTwelve,
			'gstEighteen' => $gstEighteen == 0 ? 0 : $gstEighteen,
			'amountWithTwelve' => $amountWithTwelve == 0 ? 0 : $amountWithTwelve,
			'amountWithEighteen' => $amountWithEighteen == 0 ? 0 : $amountWithEighteen,
			'NetAmount' => $NetAmount,
			'paymentTerm' => $paymentData,
			'termAndCondition' => $termAndCondition,
			'expiryDate' => $expiryDate,
			'projectCreated' => 0
		);

		$succ = $this->Agentmodel->quote($enqId, $quoId, $commi, $rate, $total, $Agid, $termAndCondition, $expiryDate);
		$insertSuccess = $this->General_model->insert('quotation', $quotationData);

		if ($insertSuccess) {
			$this->load->view('Agent/check', $enqdata);
			$html = $this->output->get_output();
			$this->load->library('Pdf');
			// Load HTML content
			$this->dompdf->loadHtml($html);
			//$CI->dompdf->set_option('isRemoteEnabled',true);

			// (Optional) Setup the paper size and orientation
			$customPaper = array(0, 0, 650, 875);
			$this->dompdf->set_paper($customPaper);

			// Render the HTML as PDF
			$this->dompdf->render();
			$su = $this->Agentmodel->pdf($enqId, $quoId);
			// Output the generated PDF (1 = download and 0 = preview)

			$this->dompdf->stream($quoId, array("Attachment" => 0));
			$this->cart->destroy();

			$this->session->set_userdata('Commission', 0);
			$this->session->set_userdata('rate', 0);
			$this->session->set_userdata('rateAmt', 0);
			$this->session->set_userdata('dat', '');
			$this->session->set_userdata('day', '');
			$this->session->set_userdata('enq_id', '');

			$this->session->set_userdata('expdat', '');
			$this->session->set_userdata('expday', '');
			$this->Agentmodel->pdfyes($enqId, $quoId);
		}
	}
	public function commission()
	{
		$this->load->library('cart');

		$enqId = $this->session->enq_id;
		$Agid = $this->session->agent_id;
		$des = $this->cart->destroy();
	}


	public function viewpdf()
	{

		$id = $this->uri->segment(3);
		$condition = array('enqId' => $id,);
		$quotationData['quotation'] = $this->General_model->fetch_single_data('quotation', $condition);
		$products = explode(',', $quotationData['quotation']['productData']);
		foreach ($products  as  $value) {
			$productItems = explode(':', $value);

			$productData[] = array(
				'productId' => $productItems['0'],
				'productQty' => $productItems['1'],
				'productPrice' => $productItems['2']
			);
		}

		$product = $this->Agentmodel->quotationProductData($productData);
		$enqdata = $this->Agentmodel->getEnquiryDataQuotation($quotationData['quotation']['enqId']);
		$quotationData['quotation']['productData'] = $product;
		//$quotationData['quotation']['productData']['Quantity'] = $productData;
		$quotationData['quotation']['EnquiryData'] = $enqdata;
		$quotationData['quotation']['referenceEnquiry'] = $this->General_model->fetch_single_data('refference_enquiry', array('enquiryId' => $quotationData['quotation']['EnquiryData']['EnqId']));
		$index = 0;

		for ($i = 0; $i < sizeof($quotationData['quotation']['productData']); $i++) {
			$quotationData['quotation']['productData'][$i]['quantity'] = $productData[$index]['productQty'];
			$index++;
		}
		$paymentDataAbc = explode(';', $quotationData['quotation']['paymentTerm']);
		foreach ($paymentDataAbc as  $value) {
			$payment[] = explode(':', $value);
		}
		foreach ($payment as  $value) {
			$paymentArray[] = array(
				'percent' =>  $value[0],
				'description' => $value[1],
				'Amount' => $value[2]
			);
		}
		$quotationData['quotation']['paymentTermData'] = $paymentArray;
		// echo "<pre>";
		// print_r($quotationData);
		// die;
		$this->load->view('Agent/viewpdf', $quotationData);
	}


	//--------------------Edit Quotation--------------------
	public function editquotation()
	{
		$qid = $this->input->get('id');
		$this->load->library('cart');

		$re = $this->Agentmodel->getqouitemdatabydID($qid);

		$quoNo = $re[0]['quoId'];
		$enq = $re[0]['enqId'];


		$this->session->set_userdata('qid', $qid);
		$this->session->set_userdata('enqid', $enq);
		$this->session->set_userdata('quono', $quoNo);

		$chk = $this->Agentmodel->getcheckdatabydID($quoNo);
		foreach ($chk as $value) {
			$pro = $value['pro'];
			$prodetails = explode(":", $pro);
			$pid = $prodetails[0];
			$pqty = $prodetails[1];
			$Product_data = $this->Agentmodel->getproductdatabydID($pid);
			foreach ($Product_data as $data) {
				$quotedata = array(
					'id' => $data['id'],
					'category' => $data['category'],
					'name' => $data['name'],
					'supplier' => $data['supplier'],
					'spec' => $data['spec'],
					'uom' => $data['uom'],
					'qty' => $pqty,
					'price' => $data['price']
				);
			}
			$this->cart->product_name_rules = '[:print:]';
			$this->cart->insert($quotedata);
		}
		return redirect('Agent/vieweditaddquo');
	}
	public function vieweditaddquo()
	{
		$this->load->library('cart');
		if (!empty($this->cart->contents())) {
			$this->load->view('Agent/editaddquotation');
		}
	}
	public function editaddqouproduct()
	{

		$rt['details'] = $this->Agentmodel->getquotationproduct();
		$this->load->view('Agent/editaddqouproduct', $rt);
	}
	public function editAddProduct()
	{
		$Pid = $this->input->post('pid');

		for ($i = 0; $i < sizeof($Pid); $i++) {
			$data = $this->Agentmodel->AddProd($Pid[$i]);

			$quotedata = array(
				'id' => $data['id'],
				'category' => $data['category'],
				'name' => $data['name'],
				'supplier' => $data['supplier'],
				'spec' => $data['spec'],
				'uom' => $data['uom'],
				'qty' => $data['qty'],
				'price' => $data['price']
			);

			$this->load->library('cart');
			$this->cart->product_name_rules = '[:print:]';
			$added = $this->cart->insert($quotedata);
		}
		return redirect('Agent/vieweditaddquo');
	}
	public function updatecommission()
	{
		$this->load->library('cart');
		$enqId = $this->session->enqid;
		$data['enq'] = $this->Agentmodel->editgetenquirydata($enqId);

		$per = $this->input->post('comm');
		$cond1          = array();
		$termAndCondition['paymentTerm'] = $this->General_model->fetch_data('termcondition', $cond1, $fields = null, 	$orderby = array());
		$this->session->set_userdata('termAndCondition', $termAndCondition);
		$cond = array('enqId' => $enqId);
		$quoteItem['quoteItem'] = $this->General_model->fetch_single_data('quoitem', $cond);
		$data['enq'][0]['termAndCondition'] = !empty($quoteItem) && $quoteItem['quoteItem']['termAndCondition'] != "" ? $quoteItem['quoteItem']['termAndCondition'] : "";
		$data['enq'][0]['expiryDate'] = !empty($quoteItem) && $quoteItem['quoteItem']['expiryDate'] != ""  ? $quoteItem['quoteItem']['expiryDate'] : "";
		$data['enq']['referenceEnquiry'] = $this->General_model->fetch_single_data('refference_enquiry', array('enquiryId' => $data['enq'][0]['EnqId']));
		if ($per > 0) {
			$gd = $this->cart->total();
			$comm = $gd * (($per + 5) / 100);
			$amt = $gd + $comm;
			$this->session->set_userdata('Commission', $amt);
			$this->session->set_userdata('rate', $per);
			$this->session->set_userdata('rateAmt', $comm);
			$this->load->view('Agent/editaddquotation', $data);
		} else {
			$this->session->set_flashdata('warning', 'Please Mention Commission Rate. If No Rate Please Mention 0');
			$this->load->view('Agent/editquotationnew', $data);
		}
	}
	public function editremoveitem($rowid)
	{
		$this->load->library('cart');
		$remove = $this->cart->remove($rowid);
		redirect('Agent/vieweditaddquo');
	}

	public function updatereminderfollow()
	{
		$id = $this->input->post('id');

		$remin = $this->Agentmodel->reminderfollow($id);
		if ($remin) {
			$this->session->set_flashdata('update', 'Reminder Update Successful');
			$rt = $this->Agentmodel->getremiderdata($id);
			$this->load->view('Agent/reminderdata', ['reminder' => $rt]);
		}
	}


	public function editpdf()
	{

		$this->load->library('cart');
		$referenceCommissionAmount = $this->session->referenceCommissionAmount;
		$enqId = $this->session->enqid;
		$commi = $this->session->Commission;
		$rate = $this->session->rate;
		$Agid = $this->session->agent_id;
		$quono = $this->session->quono;
		$paymentTerm = $this->session->paymentTermAmount;
		$termAndCondition = $this->input->post('termAndCondition');
		$expiryDate = $this->input->post('expiryDate');
		//--------------------delete all old quotation data------------------    
		$q = $this->Agentmodel->delquoitemdata($quono);
		$r = $this->Agentmodel->delcheckdata($quono);
		$s = $this->Agentmodel->deleteQuotation($enqId);


		$total = $this->cart->total();

		$enqdata['enq'] = $this->Agentmodel->editgetenquirydata($enqId);

		$this->session->set_userdata('termAndCondition', $termAndCondition);
		$this->session->set_userdata('expiryDate', $expiryDate);
		$no = $this->cart->total_items();
		foreach ($paymentTerm as  $value) {
			$paymentDataArray[] = implode(':', $value);
		}
		$paymentData = implode(';', $paymentDataArray);
		$this->session->set_userdata('paymentData', $paymentData);

		foreach ($this->cart->contents() as $key) {
			$productData = array(
				'id' => $key['id'],
				'Qty' =>  $key['qty'],
				'price' => $key['price']
			);

			$productArray[] = implode(':', $productData);
			$pdata = implode(':', $productData);

			$data = $this->Agentmodel->checkdata($pdata, $quono);
		}
		$products = implode(',', $productArray);
		$taxAmount = 0;
		$gstfive = 0;
		$amountWithEighteen = 0;
		$amountWithTwelve = 0;
		$gstEighteen = 0;
		$gstTwelve = 0;
		if ($enqdata['enq'][0]['Grid'] == 'PUMP' || $enqdata['enq'][0]['Grid'] == 'SOLAR WATER HEATER' || $enqdata['enq'][0]['Grid'] == 'DEFAULT' || $enqdata['enq'][0]['Grid'] == 'STREET LIGHT') {
			if ($referenceCommissionAmount > 0) {
				$taxAmount  = $referenceCommissionAmount + ($commi * $enqdata['enq'][0]['quantity']);
			} else {
				$taxAmount = ($commi *  $enqdata['enq'][0]['quantity']);
			}
			$gstfive = $taxAmount * (12 / 100);
		} else {
			if ($referenceCommissionAmount > 0) {
				$taxAmount  = $referenceCommissionAmount + ($commi *  $enqdata['enq'][0]['quantity']);
			} else {
				$taxAmount = ($commi * $enqdata['enq'][0]['quantity']);
			}
			$seventy = $taxAmount * (70 / 100);
			$three = $taxAmount * (30 / 100);
			$gstTwelve = $seventy * (12 / 100);
			$gstEighteen = $three * (18 / 100);
			$amountWithTwelve = $seventy + $gstTwelve;
			$amountWithEighteen = $three + $gstEighteen;
		}
		if ($gstfive == 0) {
			$NetAmount = $amountWithEighteen + $amountWithTwelve;
		} else {
			$NetAmount = $taxAmount + $gstfive;
		}

		if ($referenceCommissionAmount != 0) {
			$commissionData = array('commissionAmount' => $referenceCommissionAmount, 'quotationId' => $quono);
			$successAccept = $this->General_model->update('refference_enquiry', $commissionData, array('enquiryId' => $enqdata['enq'][0]['EnqId']));
		}
		$quotationData = array(
			'productData' => $products,
			'enqId' => $enqId,
			'quotationId' => $quono,
			'commission' => $commi,
			'quantity' => $enqdata['enq'][0]['quantity'],
			'rate' => $rate,
			'gstTwelve' => $gstTwelve == 0 ? $gstfive : $gstTwelve,
			'gstEighteen' => $gstEighteen == 0 ? 0 : $gstEighteen,
			'amountWithTwelve' => $amountWithTwelve == 0 ? 0 : $amountWithTwelve,
			'amountWithEighteen' => $amountWithEighteen == 0 ? 0 : $amountWithEighteen,
			'NetAmount' => $NetAmount,
			'paymentTerm' => $paymentData,
			'termAndCondition' => $termAndCondition,
			'roi' =>  $this->session->roi != "" ? $this->session->roi : "NA",
			'projectCreated' => 0
		);

		//$data = $this->Agentmodel->checkdata($pdata, $quono);
		$succ = $this->Agentmodel->quote($enqId, $quono, $commi, $rate, $total, $Agid, $termAndCondition, $expiryDate);
		$insertSuccess = $this->General_model->insert('quotation', $quotationData);

		if ($succ) {
			$this->load->view('Agent/editcheck', $enqdata);
			//$this->load->view('Agent/check');
			$html = $this->output->get_output();
			$this->load->library('Pdf');
			// Load HTML content
			$this->dompdf->loadHtml($html);
			//$CI->dompdf->set_option('isRemoteEnabled',true);

			// (Optional) Setup the paper size and orientation
			$customPaper = array(0, 0, 650, 875);
			$this->dompdf->set_paper($customPaper);

			// Render the HTML as PDF
			$this->dompdf->render();
			//$su=$this->Agentmodel->pdf($enqId,$quono);
			// Output the generated PDF (1 = download and 0 = preview)

			$this->dompdf->stream($quono, array("Attachment" => 0));
			$this->cart->destroy();
			$this->session->set_userdata('Commission', 0);
			$this->session->set_userdata('rate', 0);
			$this->session->set_userdata('rateAmt', 0);
			$this->session->set_userdata('dat', '');
			$this->session->set_userdata('day', '');
			$this->session->set_userdata('quono', '');
			$this->session->set_userdata('expdat', '');
			$this->session->set_userdata('expday', '');
			$this->session->set_userdata('referenceCommissionAmount', '');
			$this->session->roi ? $this->session->set_userdata('roi', '') : $this->session->set_userdata('roi', '');
		}
	}

	public function downloadPdf()
	{
		$id = $this->uri->segment(2);
		$quotationData['quotation'] = $this->Agentmodel->quotationData($id);
		$products = explode(',', $quotationData['quotation']['productData']);
		foreach ($products  as  $value) {
			$productItems = explode(':', $value);

			$productData[] = array(
				'productId' => $productItems['0'],
				'productQty' => $productItems['1'],
				'productPrice' => $productItems['2']
			);
		}

		$product = $this->Agentmodel->quotationProductData($productData);
		$enqdata = $this->Agentmodel->getEnquiryDataQuotation($quotationData['quotation']['enqId']);
		$quotationData['quotation']['productData'] = $product;
		//$quotationData['quotation']['productData']['Quantity'] = $productData;
		$quotationData['quotation']['EnquiryData'] = $enqdata;

		$quotationData['quotation']['referenceEnquiry'] = $this->General_model->fetch_single_data('refference_enquiry', array('enquiryId' => $quotationData['quotation']['EnquiryData']['EnqId']));
		$index = 0;


		for ($i = 0; $i < sizeof($quotationData['quotation']['productData']); $i++) {
			$quotationData['quotation']['productData'][$i]['quantity'] = $productData[$index]['productQty'];
			$index++;
		}
		$paymentDataAbc = explode(';', $quotationData['quotation']['paymentTerm']);
		foreach ($paymentDataAbc as  $value) {
			$payment[] = explode(':', $value);
		}
		foreach ($payment as  $value) {
			$paymentArray[] = array(
				'percent' =>  $value[0],
				'description' => $value[1],
				'Amount' => $value[2]
			);
		}
		$quotationData['quotation']['paymentTermData'] = $paymentArray;


		$this->load->view('Agent/downloadPdf', $quotationData);
		$html = $this->output->get_output();
		$this->load->library('Pdf');
		// Load HTML content
		$this->dompdf->loadHtml($html);
		//$CI->dompdf->set_option('isRemoteEnabled',true);

		// (Optional) Setup the paper size and orientation
		$customPaper = array(0, 0, 650, 875);
		$this->dompdf->set_paper($customPaper);

		// Render the HTML as PDF
		$this->dompdf->render();
		// Output the generated PDF (1 = download and 0 = preview)

		$this->dompdf->stream($quotationData['quotation']['quotationId'], array("Attachment" => 1));
	}
	public function reminderDate()
	{
		$post = $this->input->post();
		$cond = array('enqId' => $post['quoId']);
		$quotationReminder = array('reminderDate' => $post['reminderDate'],);
		$insertSuccess = $this->General_model->update('quoitem', $quotationReminder, $cond);
		if ($insertSuccess) {
			return redirect('Agent/allquotationlist');
		}
	}
	public function followup()
	{
		$post = $this->input->post();

		$dateTime = date("Y-m-d H:i:s");
		$followup = array(
			'quoId' => $post['quoId'],
			'message' => $post['message'],
			'followupDate' => $dateTime
		);
		$insertSuccess = $this->General_model->insert('followup', $followup);
		if ($insertSuccess) {
			return redirect('Agent/allquotationlist');
		}
	}
	public function followUpData()
	{
		$quotationId = $this->uri->segment(4);
		$cond1          = array('quoId' => 'EGS/QUO/' . $quotationId);
		$data['followUp'] = $this->General_model->fetch_data('followup', $cond1, $fields = null, $orderby = array());
		$this->load->view('Agent/followUp', $data);
	}

	public function selfEnquiry()
	{
		$this->form_validation->set_rules('phone', 'Contact Number', 'required');
		$this->form_validation->set_rules('cname', 'Customer Name', 'required');
		$this->form_validation->set_rules('email', 'Email ID', 'required|valid_email');
		$this->form_validation->set_rules('location', 'Address', 'required');
		$this->form_validation->set_rules('pin', 'Billing Pin Code', 'required|numeric');
		$this->form_validation->set_rules('shiplocation', 'Shipping Address', 'required');
		$this->form_validation->set_rules('shippin', 'Shipping Pin Code', 'required|numeric');
		$this->form_validation->set_rules('unit', 'Select unit', 'required');
		if ($this->form_validation->run() == TRUE) {

			$enquiry = $this->input->post();

			$enquiryData = array(
				'enqId' => strtotime(date("Y-m-d H:i:s")),
				'cname' => $enquiry['cname'],
				'phone' => $enquiry['phone'],
				'email' => $enquiry['email'],
				'billAddress1' => $enquiry['location'],
				'billAddress2' => $enquiry['location1'],
				'billState' => $enquiry['state'],
				'billPin' => $enquiry['pin'],
				'ShipAddress1' => $enquiry['shiplocation'],
				'ShipAddress2' => $enquiry['shiplocation1'],
				'shipstate' => $enquiry['shipstate'],
				'shippin' => $enquiry['shippin'],
				'gst' => $enquiry['gst'],
				'grid' => $enquiry['grid'],
				'kw' => $enquiry['kw'],
				'unit' => $enquiry['unit'],
				'quantity' => $enquiry['qty'],
				'remark' => $enquiry['remark'],
				'status' => 'Active',
				'AgentId' => $enquiry['AgentId'],
				'pdf' => 'No',
				'created_at' => date("Y-m-d")
			);



			$insertSuccess = $this->General_model->insert('enquiry', $enquiryData);
			if ($insertSuccess) {
				$this->session->set_flashdata('Success', 'Self Enquiry Added Successfully.. Check in Generate Quotation');
				return redirect('New-Enquiry');
			} else {
				$this->session->set_flashdata('fail', 'Unable to Add Enquiry');
				return redirect('New-Enquiry');
			}
		}
	}
	public function paymentTermList()
	{
		$data = $this->Agentmodel->getPaymentTerm();
		foreach ($data as $key => $value) {
			$result['data'][] = array(
				'id' =>	$value['paymentTermId'],
				'paymentPercent' => $value['paymentPercent'],
				'paymentTermDescription' => $value['paymentTermDescription'],
				'sequence' => $value['sequence']
			);
		}
		echo json_encode($result);
	}
	public function paymentTermAddAction()
	{
		if (sizeof($this->session->paymentTermData) > 0) {
			$this->session->set_userdata('payment', '');
		}
		$paymentTermId = $this->input->post('paymentTermId');
		for ($i = 0; $i < sizeof($paymentTermId); $i++) {
			$data = $this->Agentmodel->getPaymentTermById($paymentTermId[$i]);
			$paymentPercentage = $paymentPercentage +  $data['paymentPercent'];
			if ($paymentPercentage > 100 || $paymentPercentage < 100  && $i == sizeof($paymentTermId) - 1) {
				$this->session->set_flashdata('paymentFail', 'Payment Term cannot be more than or less than 100%.');
				return redirect("Agent/vieweditaddquo");
			}
			$paymentTerm[] = array(
				'id' =>	$data['paymentTermId'],
				'paymentPercent' => $data['paymentPercent'],
				'paymentTermDescription' => $data['paymentTermDescription']
			);
		}
		$this->session->set_userdata('paymentTermData', $paymentTerm);
		$this->session->set_flashdata('payment', 'Payment Term Added Successful.');
		return redirect('Agent/finalquote');
	}
	public function paymentTermEditAction()
	{
		$qid = $this->session->qid;
		$this->session->set_userdata('enqid', $this->session->enqid);


		if (sizeof($this->session->paymentTermData) > 0) {
			$this->session->set_userdata('payment', '');
		}
		$paymentTermId = $this->input->post('paymentTermId');
		$paymentPercentage = 0;
		for ($i = 0; $i < sizeof($paymentTermId); $i++) {
			$data = $this->Agentmodel->getPaymentTermById($paymentTermId[$i]);
			$paymentPercentage = $paymentPercentage +  $data['paymentPercent'];
			if ($paymentPercentage > 100 || $paymentPercentage < 100 && $i == sizeof($paymentTermId) - 1) {
				$this->session->set_flashdata('paymentFail', 'Payment Term cannot be more than or less than 100% .');
				return redirect("Agent/vieweditaddquo");
			}
			$paymentTerm[] = array(
				'id' =>	$data['paymentTermId'],
				'paymentPercent' => $data['paymentPercent'],
				'paymentTermDescription' => $data['paymentTermDescription']
			);
		}
		$this->session->set_flashdata('payment', 'Payment Term Added Successful.');
		$this->session->set_userdata('paymentTermData', $paymentTerm);
		return redirect("Agent/vieweditaddquo");
	}
	public function calculateRoi()
	{
		$post = $this->input->post();
		$monthlyElectriProduct = (number_format(($post['electricProduce'] / 12), 2));
		$costOfMonthlyElectricProduce = ($monthlyElectriProduct * $post['electricKW']) * $post['electricCost'];
		$roi = (float)(str_replace(",", "", $post['projectCost'])) / $costOfMonthlyElectricProduce;
		$this->session->set_userdata('roi', $roi);
		return redirect('Agent/updatecommission');
	}
	public function returnDashboard()
	{
		$this->load->library('cart');
		$this->cart->destroy();
		return redirect('Dashboard');
	}

	public function createProject()
	{
		$id = $this->uri->segment(2);
		$condition = array('enqId' => $id,);
		$quotationData['quotation'] = $this->General_model->fetch_single_data('quotation', $condition);
		$products = explode(',', $quotationData['quotation']['productData']);
		foreach ($products  as  $value) {
			$productItems = explode(':', $value);

			$productData[] = array(
				'productId' => $productItems['0'],
				'productQty' => $productItems['1'],
				'productPrice' => $productItems['2'],
				'productWarranty' => sizeof($productItems) == 4 ? $productItems['3'] : "",
			);
		}

		$product = $this->Agentmodel->quotationProductData($productData);
		$enqdata = $this->Agentmodel->getEnquiryDataQuotation($quotationData['quotation']['enqId']);
		$quotationData['quotation']['productData'] = $product;
		//$quotationData['quotation']['productData']['Quantity'] = $productData;
		$quotationData['quotation']['EnquiryData'] = $enqdata;
		$quotationData['quotation']['referenceEnquiry'] = $this->General_model->fetch_single_data('refference_enquiry', array('enquiryId' => $quotationData['quotation']['EnquiryData']['EnqId']));
		$index = 0;

		for ($i = 0; $i < sizeof($quotationData['quotation']['productData']); $i++) {
			$quotationData['quotation']['productData'][$i]['quantity'] = $productData[$index]['productQty'];
			$quotationData['quotation']['productData'][$i]['warranty'] = $productData[$index]['productWarranty'];
			$index++;
		}
		$paymentDataAbc = explode(';', $quotationData['quotation']['paymentTerm']);
		foreach ($paymentDataAbc as  $value) {
			$payment[] = explode(':', $value);
		}
		foreach ($payment as  $value) {
			$paymentArray[] = array(
				'percent' =>  $value[0],
				'description' => $value[1],
				'Amount' => $value[2]
			);
		}
		$quotationData['quotation']['paymentTermData'] = $paymentArray;

		$this->load->view('Agent/createProject', $quotationData);
	}

	public function updateWarranty()
	{
		$data = $this->input->post();
		$condition = array('enqId' => $data['enqId']);
		$quotationData['quotation'] =  $this->General_model->fetch_single_data('quotation', $condition);

		$productData = explode(',', $quotationData['quotation']['productData']);

		foreach ($productData as  $value) {
			$productValue[] = explode(':', $value);
		}
		foreach ($productValue as $key => $value) {
			if ($value[0] == $data['quoId']) {
				$productValue[$key][3] = $data['warranty'];
			}
		}
		foreach ($productValue as  $value) {
			$productArray[] = implode(':', $value);
		}
		$products = implode(',', $productArray);


		$success = $this->General_model->update('quotation', array('productData' => $products), $condition);
		if ($insertSuccess) {
			$this->session->set_flashdata('Success', 'Self Enquiry Added Successfully.. Check in Generate Quotation');
			return redirect('Create-Project/' . $data['enqId']);
		} else {
			$this->session->set_flashdata('fail', 'Unable to Add Enquiry');
			return redirect('Create-Project/' . $data['enqId']);
		}
	}

	public function createProjectAction()
	{
		$post = $this->input->post();

		if ($_FILES['purchaseOrder']['name'] != '') {

			$config['upload_path'] = 'assets/images/purchaseOrder/';
			$config['allowed_types'] = 'pdf';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('purchaseOrder');
			$imgdata = $this->upload->data();
			$img = $imgdata['file_name'];
			$post['po'] = $img;
		} else {
			$post['po'] = "";
		}
		$projectId = $post['projectId'] . "/" . $post['projectNo'];

		$EnquiryData = $this->General_model->fetch_single_data('enquiry', array('quoid' => $post['quotationId']));
		$customerDatas = $this->General_model->fetch_single_data('customer', array(
			'email' => $EnquiryData['email'],
			'phone' => $EnquiryData['phone']
		));
		$customerId = "";
		if (!empty($customerDatas)) {
			$customerId = $customerDatas['id'];
			$customerData = array(
				'customerName' => $customerDatas['customerName'],
				'email' => $customerDatas['email'],
				'password' => $customerDatas['password']
			);
		} else {
			$customerData = getCustomerData($EnquiryData);
			$customerInsert = $this->General_model->insert('customer', $customerData);
			$customerId = $customerInsert;
		}
		$projectData = array(
			'projectId' => $projectId,
			'projectWarranty' => $post['projectLevel'],
			'quotationId' => $post['quotationId'],
			'projectDeadLine' => $post['projectDeadLine'],
			'po' => $post['po'],
			'customerId' => $customerId,
			'Status' => 'Process'
		);

		$projectInsert = $this->General_model->insert('project', $projectData);
		if ($projectInsert) {
			$quotationupdate = $this->General_model->update('quotation', array('projectCreated' => 1), array('quotationId' => $post['quotationId']));
			$quota = $this->General_model->update('quoitem', array('projectCreated' => 1), array('quoId' => $post['quotationId']));
			if ($projectInsert) {
				$from = "info@crm.evergreensolar.co.in";
				sendCretareProjectMail($customerData['customerName'], $customerData['email'], $customerData['password'], $from);
				$this->session->set_flashdata('Success', 'Project Create Successfull');
				return redirect('Agent/allquotationlist');
			} else {
				$this->session->set_flashdata('fail', 'Unable to Add Enquiry');
				return redirect('Agent/allquotationlist');
			}
		} else {
			$this->session->set_flashdata('fail', 'Unable to Add Enquiry');
			return redirect('Agent/allquotationlist');
		}
	}

	public function projectList()
	{
		$condition = array();
		$projectData['projectData'] = $this->General_model->fetch_data('project', $condition, '', array('id' => 'desc'));
		$index = 0;
		foreach ($projectData['projectData'] as $key => $value) {

			$projectData['projectData'][$key]['quotationData'] = $this->General_model->fetch_single_data('quotation', array('projectCreated' => 1, 'quotationId' => $value['quotationId']));
			$projectData['projectData'][$key]['quoitemData'] = $this->General_model->fetch_single_data('quoitem', array('projectCreated' => 1, 'quoId' => $value['quotationId']));

			$projectData['projectData'][$key]['EnquiryData'] = $this->General_model->fetch_single_data('enquiry', array('quoid' => $value['quotationId']));

			$projectData['projectData'][$key]['amountPaid'] = $this->Agentmodel->getPaymentData($value['projectId']);
			$index++;
		}
		// echo "<pre>";
		// print_r($projectData);
		// die;
		$this->load->view('Agent/projectList', $projectData);
	}

	public function bomExportToExcel()
	{
		$projectId = base64_decode($this->input->get('id'));
		$condition = array("projectId" => $projectId);
		$projectData['projectData'] = $this->General_model->fetch_single_data('project', $condition);
		$projectData['projectData']['quotationData'] = $this->General_model->fetch_single_data('quotation', array('projectCreated' => 1, 'quotationId' => $projectData['projectData']['quotationId']));
		$productDataArray = explode(",", $projectData['projectData']['quotationData']['productData']);
		foreach ($productDataArray as  $value) {
			$productData[] = explode(':', $value);
		}
		foreach ($productData as $key =>  $value) {
			$condition = array("id" => $value[0]);
			$product[]  = $this->General_model->fetch_single_data('product', $condition);
			$product[$key]['warranty'] = sizeof($productData[$key]) == 4 ? $productData[$key][3] : "";
			$product[$key]['quantity'] = $productData[$key][1];
			$product[$key]['cost'] = $productData[$key][2];
		}
		$this->load->library("excel");
		$object = new PHPExcel();
		$object->setActiveSheetIndex(0);
		$column = 0;
		$object->getActiveSheet()->SetCellValue('A1',  'Product Name');
		$object->getActiveSheet()->SetCellValue('B1',  'Supplier');
		$object->getActiveSheet()->SetCellValue('C1',  'Specification');
		$object->getActiveSheet()->SetCellValue('D1',  'UOM');
		$object->getActiveSheet()->SetCellValue('E1',  'Quantity');
		$object->getActiveSheet()->SetCellValue('F1',  'Rate');
		$object->getActiveSheet()->SetCellValue('G1',  'Cost');
		$object->getActiveSheet()->SetCellValue('H1',  'Warranty');
		$column++;

		$excel_row = 2;

		foreach ($product as $row) {

			$object->getActiveSheet()->SetCellValue('A' . $excel_row, $row['name']);
			$object->getActiveSheet()->SetCellValue('B' . $excel_row, $row['supplier']);
			$object->getActiveSheet()->SetCellValue('C' . $excel_row, $row['spec']);
			$object->getActiveSheet()->SetCellValue('D' . $excel_row, $row['uom']);
			$object->getActiveSheet()->SetCellValue('E' . $excel_row, $row['quantity']);
			$object->getActiveSheet()->setCellValue('F' . $excel_row, $row['price']);
			$object->getActiveSheet()->setCellValue('G' . $excel_row, $row['cost']);
			$object->getActiveSheet()->setCellValue('H' . $excel_row, $row['warranty']);
			$excel_row = $excel_row + 1;
		}
		$projectNo = str_replace("-", "/", $projectId);
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'CSV');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="BOM For"' . $projectNo . '".csv"');
		$object_writer->save('php://output');
	}

	public function updateProjectStatus()
	{
		$projectId = $this->input->get('projectId');
		$status = $this->input->get('status');
		$update = 	$this->General_model->update('project', array('Status' => $status), array('projectId' => $projectId));
		echo $update ? 'ok' : 'err';
	}

	public function projectDetails()
	{
		$id = base64_decode($this->input->get('id'));
		$projectId = str_replace(":", "/", $id);

		$condition = array("projectId" => $projectId);
		$projectData['projectData'] = $this->General_model->fetch_single_data('project', $condition);

		$projectData['projectData']['quotationData'] = $this->General_model->fetch_single_data('quotation', array('projectCreated' => 1, 'quotationId' => $projectData['projectData']['quotationId']));

		$projectData['projectData']['EnquiryData'] = $this->General_model->fetch_single_data('enquiry', array('quoid' => $projectData['projectData']['quotationId']));

		$projectData['projectData']['amountPaid'] = $this->Agentmodel->getPayment($projectData['projectData']['projectId']);

		$productDataArray = explode(",", $projectData['projectData']['quotationData']['productData']);
		foreach ($productDataArray as  $value) {
			$productData[] = explode(':', $value);
		}
		foreach ($productData as $key =>  $value) {
			$condition = array("id" => $value[0]);
			$product[]  = $this->General_model->fetch_single_data('product', $condition);
			$product[$key]['warranty'] = sizeof($productData[$key]) == 4 ? $productData[$key][3] : "";
			$product[$key]['quantity'] = $productData[$key][1];
			$product[$key]['cost'] = $productData[$key][2];
		}
		$projectData['projectData']['bom'] = $product;
		$projectData['projectData']['document'] = $this->Agentmodel->getDocumentData($projectId);

		$this->load->view('Agent/projectDetails', $projectData);
	}

	function updateQuotationStatus()
	{
		$quotationStatus = $this->input->get('status');
		$quotationId = $this->input->get('rowid');
		$updateStatus = array(
			'quotationStatus' => $quotationStatus,
		);
		$update = $this->General_model->update('quoitem', $updateStatus, array('enqId' => $quotationId));
		echo $update != "" ? 'ok' : 'err';
	}
}

function getCustomerData($EnquiryData)
{
	$password = random_password();
	$customerData = array(
		'customerName' => $EnquiryData['cName'],
		'email' => $EnquiryData['email'],
		'phone' => $EnquiryData['phone'],
		'billingAddress' => $EnquiryData['billAddress1'] . "," . $EnquiryData['billAddress2'] . "," . $EnquiryData['billstate'] . "," . $EnquiryData['billPin'],
		'shippingAddress' => $EnquiryData['shipAddress1'] . "," . $EnquiryData['shipAddress2'] . "," . $EnquiryData['shipState'] . "," . $EnquiryData['shipPin'],
		'GST' => $EnquiryData['Gst'],
		'password' => $password
	);
	return $customerData;
}
function random_password()
{
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$password = array();
	$alpha_length = strlen($alphabet) - 1;
	for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alpha_length);
		$password[] = $alphabet[$n];
	}
	return implode($password);
}

function sendCretareProjectMail($customerName, $email, $password, $fromMail)
{
	$logo = base_url('dist/img/evergreen-solar-2.png');
	$message = '<!DOCTYPE html>
	<html
		lang="en"
		xmlns:o="urn:schemas-microsoft-com:office:office"
		xmlns:v="urn:schemas-microsoft-com:vml"
	>
		<head>
			<title></title>
			<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
			<meta content="width=device-width, initial-scale=1.0" name="viewport" />
			<style>
				* {
					box-sizing: border-box;
				}
	
				body {
					margin: 0;
					padding: 0;
				}
	
				a[x-apple-data-detectors] {
					color: inherit !important;
					text-decoration: inherit !important;
				}
	
				#MessageViewBody a {
					color: inherit;
					text-decoration: none;
				}
	
				p {
					line-height: inherit;
				}
	
				.desktop_hide,
				.desktop_hide table {
					mso-hide: all;
					display: none;
					max-height: 0px;
					overflow: hidden;
				}
	
				.image_block img + div {
					display: none;
				}
	
				@media (max-width: 700px) {
					.desktop_hide table.icons-inner,
					.social_block.desktop_hide .social-table {
						display: inline-block !important;
					}
	
					.icons-inner {
						text-align: center;
					}
	
					.icons-inner td {
						margin: 0 auto;
					}
	
					.row-content {
						width: 100% !important;
					}
	
					.mobile_hide {
						display: none;
					}
	
					.stack .column {
						width: 100%;
						display: block;
					}
	
					.mobile_hide {
						min-height: 0;
						max-height: 0;
						max-width: 0;
						overflow: hidden;
						font-size: 0px;
					}
	
					.desktop_hide,
					.desktop_hide table {
						display: table !important;
						max-height: none !important;
					}
				}
			</style>
		</head>
		<body
			style="
				background-color: #f9f9f9;
				margin: 0;
				padding: 0;
				-webkit-text-size-adjust: none;
				text-size-adjust: none;
			"
		>
			<table
				border="0"
				cellpadding="0"
				cellspacing="0"
				class="nl-container"
				role="presentation"
				style="
					mso-table-lspace: 0pt;
					mso-table-rspace: 0pt;
					background-color: #f9f9f9;
				"
				width="100%"
			>
				<tbody>
					<tr>
						<td>
							<table
								align="center"
								border="0"
								cellpadding="0"
								cellspacing="0"
								class="row row-1"
								role="presentation"
								style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
								width="100%"
							>
								<tbody>
									<tr>
										<td>
											<!-- top Logo Section -->
											<table
												align="center"
												border="0"
												cellpadding="0"
												cellspacing="0"
												class="row-content stack"
												role="presentation"
												style="
													mso-table-lspace: 0pt;
													mso-table-rspace: 0pt;
													background-color: #28a745 !important;
													color: #000000;
													width: 680px;
												"
												width="680"
											>
												<tbody>
													<tr>
														<td
															class="column column-1"
															style="
																mso-table-lspace: 0pt;
																mso-table-rspace: 0pt;
																font-weight: 400;
																text-align: left;
																vertical-align: top;
																border-top: 0px;
																border-right: 0px;
																border-bottom: 0px;
																border-left: 0px;
															"
															width="100%"
														>
															<table
																border="0"
																cellpadding="0"
																cellspacing="0"
																class="image_block block-1"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																"
																width="100%"
															>
																<tr>
																	<td
																		class="pad"
																		style="
																			padding-bottom: 10px;
																			padding-top: 10px;
																			width: 100%;
																			padding-right: 0px;
																			padding-left: 0px;
																		"
																	>
																		<div
																			align="center"
																			class="alignment"
																			style="line-height: 10px"
																		>
																			<a href="#">
																				<img
																					alt="Evergreen Solor"
																					src="' . $logo . '"
																					style="
																						display: block;
																						height: auto;
																						border: 0;
																						width: 100px;
																						max-width: 100%;
																					"
																					title="EverGreen Solar"
																					width="268"
																				/>
																			</a>
																		</div>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
							<table
								align="center"
								border="0"
								cellpadding="0"
								cellspacing="0"
								class="row row-3"
								role="presentation"
								style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
								width="100%"
							>
								<tbody>
									<tr>
										<td>
											<table
												align="center"
												border="0"
												cellpadding="0"
												cellspacing="0"
												class="row-content stack"
												role="presentation"
												style="
													mso-table-lspace: 0pt;
													mso-table-rspace: 0pt;
													background-color: #ffffff;
													color: #000000;
													width: 680px;
												"
												width="680"
											>
												<tbody>
													<tr>
														<td
															class="column column-1"
															style="
																mso-table-lspace: 0pt;
																mso-table-rspace: 0pt;
																font-weight: 400;
																text-align: left;
																vertical-align: top;
																border-top: 0px;
																border-right: 0px;
																border-bottom: 0px;
																border-left: 0px;
															"
															width="100%"
														>
															<table
																border="0"
																cellpadding="0"
																cellspacing="0"
																class="text_block block-1"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																	word-break: break-word;
																"
																width="100%"
															>
																<tr>
																	<td
																		class="pad"
																		style="
																			padding-bottom: 40px;
																			padding-left: 20px;
																			padding-right: 20px;
																			padding-top: 40px;
																		"
																	>
																		<div style="font-family: sans-serif">
																			<div
																				class=""
																				style="
																					font-size: 14px;
																					font-family: Arial, Helvetica Neue,
																						Helvetica, sans-serif;
																					mso-line-height-alt: 21px;
																					color: #2f2f2f;
																					line-height: 1.5;
																				"
																			>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 21px;
																						letter-spacing: normal;
																					"
																				>
																					<strong
																						><span style="font-size: 16px">
																							Dear ' . $customerName . ',</span
																						></strong
																					>
																				</p>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 21px;
																						letter-spacing: normal;
																					"
																				>
																					 
																				</p>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 24px;
																						letter-spacing: normal;
																					"
																				>
																					<span style="font-size: 16px"
																						>We are pleased to inform you that
																						your project has been successfully set
																						up on our CRM platform. We appreciate
																						your decision to use our M/s Evergreen
																						Solar team to manage your project
																						efficiently. To help you get started,
																						we are providing you with your login
																						details below:</span
																					>
																				</p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
															<table
																border="0"
																cellpadding="0"
																cellspacing="0"
																class="text_block block-1"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																	word-break: break-word;
																"
																width="100%"
															>
																<tr>
																	<td
																		class="pad"
																		style="
																			padding-bottom: 40px;
																			padding-left: 20px;
																			padding-right: 20px;
																			padding-top: 10px;
																		"
																	>
																		<div style="font-family: sans-serif">
																			<div
																				class=""
																				style="
																					font-size: 14px;
																					font-family: Arial, Helvetica Neue,
																						Helvetica, sans-serif;
																					mso-line-height-alt: 21px;
																					color: #2f2f2f;
																					line-height: 1.5;
																				"
																			>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 21px;
																						letter-spacing: normal;
																					"
																				></p>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 24px;
																						letter-spacing: normal;
																					"
																				>
																					<span style="font-size: 16px"
																						>CRM Portal :
																						<strong
																							><a
																								href="https://quote.evergreensolar.co.in/Customer"
																								>Customer Portal</a
																							></strong
																						>
																					</span>
																				</p>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 24px;
																						letter-spacing: normal;
																					"
																				>
																					<span style="font-size: 16px"
																						>Username:
																						<strong>' . $email . '</strong>
																					</span>
																				</p>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 24px;
																						letter-spacing: normal;
																					"
																				>
																					<span style="font-size: 16px"
																						>Password:
																						<strong>' . $password . '</strong>
																					</span>
																				</p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
	
															<table
																border="0"
																cellpadding="0"
																cellspacing="0"
																class="text_block block-1"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																	word-break: break-word;
																"
																width="100%"
															>
																<tr>
																	<td
																		class="pad"
																		style="
																			padding-bottom: 40px;
																			padding-left: 20px;
																			padding-right: 20px;
																			padding-top: 10px;
																		"
																	>
																		<div style="font-family: sans-serif">
																			<div
																				class=""
																				style="
																					font-size: 14px;
																					font-family: Arial, Helvetica Neue,
																						Helvetica, sans-serif;
																					mso-line-height-alt: 21px;
																					color: #2f2f2f;
																					line-height: 1.5;
																				"
																			>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 21px;
																						letter-spacing: normal;
																					"
																				></p>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 24px;
																						letter-spacing: normal;
																					"
																				>
																					<span style="font-size: 16px"
																						>To access your project and view its
																						details, kindly follow the
																						instructions below:</span
																					>
																				</p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
															<table
																border="0"
																cellpadding="0"
																cellspacing="0"
																class="text_block block-1"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																	word-break: break-word;
																"
																width="100%"
															>
																<tr>
																	<td
																		class="pad"
																		style="
																			padding-bottom: 40px;
																			padding-left: 20px;
																			padding-right: 20px;
																			padding-top: 10px;
																		"
																	>
																		<div style="font-family: sans-serif">
																			<div
																				class=""
																				style="
																					font-size: 14px;
																					font-family: Arial, Helvetica Neue,
																						Helvetica, sans-serif;
																					mso-line-height-alt: 21px;
																					color: #2f2f2f;
																					line-height: 1.5;
																				"
																			>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 21px;
																						letter-spacing: normal;
																					"
																				></p>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 24px;
																						letter-spacing: normal;
																					"
																				>
																					<span style="font-size: 16px"
																						>Visit
																						<a
																							href="https://quote.evergreensolar.co.in/Customer"
																							>Customer Portal</a
																						>
																						using any web browser. Enter your
																						assigned username (' . $email . ') and
																						password (' . $password . ') in the
																						designated login fields on the
																						portal\'s homepage. Click on the
																						"Login" or "Sign In" button to access
																						your CRM account. Once logged in, you
																						will have complete visibility of your
																						project, along with a wide range of
																						CRM features and tools. Our CRM
																						platform is designed to streamline
																						project management, enhance
																						collaboration, and boost productivity.
																						You can track work progress, assign
																						tasks, manage contacts, monitor
																						communication, and more.</span
																					>
																				</p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
	
															<table
																border="0"
																cellpadding="0"
																cellspacing="0"
																class="text_block block-1"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																	word-break: break-word;
																"
																width="100%"
															>
																<tr>
																	<td
																		class="pad"
																		style="
																			padding-bottom: 40px;
																			padding-left: 20px;
																			padding-right: 20px;
																			padding-top: 10px;
																		"
																	>
																		<div style="font-family: sans-serif">
																			<div
																				class=""
																				style="
																					font-size: 14px;
																					font-family: Arial, Helvetica Neue,
																						Helvetica, sans-serif;
																					mso-line-height-alt: 21px;
																					color: #2f2f2f;
																					line-height: 1.5;
																				"
																			>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 21px;
																						letter-spacing: normal;
																					"
																				></p>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 24px;
																						letter-spacing: normal;
																					"
																				>
																					<span style="font-size: 16px"
																						>We understand that each project is
																						unique, and our CRM system offers
																						flexibility and customization options
																						to cater to your specific
																						requirements. If you encounter any
																						difficulties or have any questions
																						regarding the CRM features or
																						functionality, our support team is
																						ready to assist you. Please don\'t
																						hesitate to reach out to us at
																						7074833525, and we will be happy to
																						help.</span
																					>
																				</p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
	
															<table
																border="0"
																cellpadding="0"
																cellspacing="0"
																class="text_block block-1"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																	word-break: break-word;
																"
																width="100%"
															>
																<tr>
																	<td
																		class="pad"
																		style="
																			padding-bottom: 40px;
																			padding-left: 20px;
																			padding-right: 20px;
																			padding-top: 10px;
																		"
																	>
																		<div style="font-family: sans-serif">
																			<div
																				class=""
																				style="
																					font-size: 14px;
																					font-family: Arial, Helvetica Neue,
																						Helvetica, sans-serif;
																					mso-line-height-alt: 21px;
																					color: #2f2f2f;
																					line-height: 1.5;
																				"
																			>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 21px;
																						letter-spacing: normal;
																					"
																				></p>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 24px;
																						letter-spacing: normal;
																					"
																				>
																					<span style="font-size: 16px"
																						>Your satisfaction is our priority,
																						and we are committed to providing you
																						with excellent service.</span
																					>
																				</p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
	
															<table
																border="0"
																cellpadding="0"
																cellspacing="0"
																class="text_block block-1"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																	word-break: break-word;
																"
																width="100%"
															>
																<tr>
																	<td
																		class="pad"
																		style="
																			padding-bottom: 40px;
																			padding-left: 20px;
																			padding-right: 20px;
																			padding-top: 10px;
																		"
																	>
																		<div style="font-family: sans-serif">
																			<div
																				class=""
																				style="
																					font-size: 14px;
																					font-family: Arial, Helvetica Neue,
																						Helvetica, sans-serif;
																					mso-line-height-alt: 21px;
																					color: #2f2f2f;
																					line-height: 1.5;
																				"
																			>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 21px;
																						letter-spacing: normal;
																					"
																				></p>
																				<p
																					style="
																						margin: 0;
																						mso-line-height-alt: 24px;
																						letter-spacing: normal;
																					"
																				>
																					<span style="font-size: 16px"
																						>Thank you for choosing our M/s
																						Evergreen Solar for your project. We
																						look forward to supporting you
																						throughout your project journey.</span
																					>
																				</p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
							<table
								align="center"
								border="0"
								cellpadding="0"
								cellspacing="0"
								class="row row-4"
								role="presentation"
								style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
								width="100%"
							>
								<tbody>
									<tr>
										<td>
											<table
												align="center"
												border="0"
												cellpadding="0"
												cellspacing="0"
												class="row-content stack"
												role="presentation"
												style="
													mso-table-lspace: 0pt;
													mso-table-rspace: 0pt;
													background-color: #ffffff;
													color: #000000;
													width: 680px;
												"
												width="680"
											>
												<tbody>
													<tr>
														<td
															class="column column-1"
															style="
																mso-table-lspace: 0pt;
																mso-table-rspace: 0pt;
																font-weight: 400;
																text-align: left;
																vertical-align: top;
																border-top: 0px;
																border-right: 0px;
																border-bottom: 0px;
																border-left: 0px;
															"
															width="100%"
														>
															<table
																border="0"
																cellpadding="0"
																cellspacing="0"
																class="text_block block-1"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																	word-break: break-word;
																"
																width="100%"
															>
																<tr>
																	<td
																		class="pad"
																		style="
																			padding-bottom: 40px;
																			padding-left: 30px;
																			padding-right: 30px;
																			padding-top: 40px;
																		"
																	>
																		<div style="font-family: sans-serif">
																			<div
																				class=""
																				style="
																					font-size: 14px;
																					font-family: Arial, Helvetica Neue,
																						Helvetica, sans-serif;
																					mso-line-height-alt: 21px;
																					color: #2f2f2f;
																					line-height: 1.5;
																				"
																			>
																				<p
																					style="
																						margin: 0;
																						font-size: 16px;
																						text-align: center;
																						mso-line-height-alt: 21px;
																					"
																				>
																					<span style="font-size: 14px"
																						>Auto-generated message: This is an
																						automated response. Please do not
																						reply to this email.</span
																					>
																				</p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
	
							<table
								align="center"
								border="0"
								cellpadding="0"
								cellspacing="0"
								class="row row-5"
								role="presentation"
								style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
								width="100%"
							>
								<tbody>
									<tr>
										<td>
											<table
												align="center"
												border="0"
												cellpadding="0"
												cellspacing="0"
												class="row-content stack"
												role="presentation"
												style="
													mso-table-lspace: 0pt;
													mso-table-rspace: 0pt;
													background-color: #038321 !important;
													color: #000000;
													width: 680px;
												"
												width="680"
											>
												<tbody>
													<tr>
														<td
															class="column column-1"
															style="
																mso-table-lspace: 0pt;
																mso-table-rspace: 0pt;
																font-weight: 400;
																text-align: left;
																padding-bottom: 5px;
																padding-top: 5px;
																vertical-align: top;
																border-top: 0px;
																border-right: 0px;
																border-bottom: 0px;
																border-left: 0px;
															"
															width="100%"
														>
															<div
																class="spacer_block block-1"
																style="
																	height: 20px;
																	line-height: 20px;
																	font-size: 1px;
																"
															>
																 
															</div>
	
															<table
																border="0"
																cellpadding="0"
																cellspacing="0"
																class="image_block block-2"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																"
																width="100%"
															>
																<tr>
																	<td
																		class="pad"
																		style="
																			width: 100%;
																			padding-right: 0px;
																			padding-left: 0px;
																		"
																	>
																		<div
																			align="center"
																			class="alignment"
																			style="line-height: 10px"
																		>
																			<a href="#">
																				<img
																					alt="Evergreen Solor"
																					src="' . $logo . '"
																					style="
																						display: block;
																						height: auto;
																						border: 0;
																						width: 100px;
																						max-width: 100%;
																					"
																					title="EverGreen Solar"
																					width="100"
																				/>
																			</a>
																		</div>
																	</td>
																</tr>
															</table>
	
															<table
																border="0"
																cellpadding="10"
																cellspacing="0"
																class="text_block block-4"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																	word-break: break-word;
																"
																width="100%"
															>
																<tr>
																	<td class="pad">
																		<div style="font-family: sans-serif">
																			<div
																				class=""
																				style="
																					font-size: 14px;
																					font-family: Arial, Helvetica Neue,
																						Helvetica, sans-serif;
																					mso-line-height-alt: 21px;
																					color: #f9f9f9;
																					line-height: 1.5;
																				"
																			>
																				<p
																					style="
																						margin: 0;
																						font-size: 12px;
																						text-align: center;
																						mso-line-height-alt: 18px;
																					"
																				>
																					<span style="font-size: 12px"
																						>81/75 NCC Road, Banipur, Habra, North
																						24 PGS, West Bengal -743233</span
																					>
																				</p>
																				<p
																					style="
																						margin: 0;
																						font-size: 12px;
																						text-align: center;
																						mso-line-height-alt: 18px;
																					"
																				>
																				<a href="mailto:info@evergreensolar.co.in"
																				style="color: #ffffff; text-decoration: none; font-size:12px">info@evergreensolar.co.in</a>
																				</p>
																				<p
																					style="
																						margin: 0;
																						font-size: 12px;
																						text-align: center;
																						mso-line-height-alt: 18px;
																					"
																				>
																				<a href="tel:7074833525"
																				style="color: #ffffff; text-decoration: none; font-size:12px">70748 33525</a></p>
																				</p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
	
							<table
								align="center"
								border="0"
								cellpadding="0"
								cellspacing="0"
								class="row row-6"
								role="presentation"
								style="mso-table-lspace: 0pt; mso-table-rspace: 0pt"
								width="100%"
							>
								<tbody>
									<tr>
										<td>
											<table
												align="center"
												border="0"
												cellpadding="0"
												cellspacing="0"
												class="row-content stack"
												role="presentation"
												style="
													mso-table-lspace: 0pt;
													mso-table-rspace: 0pt;
													background-color: #038321 !important;
													color: #000000;
													width: 680px;
												"
												width="680"
											>
												<tbody>
													<tr>
														<td
															class="column column-1"
															style="
																mso-table-lspace: 0pt;
																mso-table-rspace: 0pt;
																font-weight: 400;
																text-align: left;
																padding-bottom: 20px;
																vertical-align: top;
																border-top: 0px;
																border-right: 0px;
																border-bottom: 0px;
																border-left: 0px;
															"
															width="100%"
														>
															<table
																border="0"
																cellpadding="10"
																cellspacing="0"
																class="text_block block-1"
																role="presentation"
																style="
																	mso-table-lspace: 0pt;
																	mso-table-rspace: 0pt;
																	word-break: break-word;
																"
																width="100%"
															>
																<tr>
																	<td class="pad">
																		<div style="font-family: sans-serif">
																			<div
																				class=""
																				style="
																					font-size: 12px;
																					font-family: Arial, Helvetica Neue,
																						Helvetica, sans-serif;
																					mso-line-height-alt: 14.399999999999999px;
																					color: #cfceca;
																					line-height: 1.2;
																				"
																			>
																				<p
																					style="
																						margin: 0;
																						font-size: 14px;
																						text-align: center;
																						mso-line-height-alt: 16.8px;
																					"
																				>
																					<span style="font-size: 12px"
																						>2023 © All Rights Reserved</span
																					>
																				</p>
																			</div>
																		</div>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<!-- End -->
		</body>
	</html>
	';
	$subject = "Project Details";


	$mail = new PHPMailer(true);
	$mail->isSMTP();
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->Host = "mumult1.hostarmada.net";
	$mail->SMTPAuth = true;
	$mail->Username = $fromMail;
	$mail->Password = "P(4%{yM@AQ9M";
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	$mail->Port = "465";

	$mail->From = $fromMail;
	$mail->FromName = "EverGreen Solar";
	$mail->addAddress($email, ""); //Provide file path and name of the attachments 
	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->AltBody = "This is the plain text version of the email content";
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message has been sent successfully";
	}
}
