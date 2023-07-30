<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdminDashboard');
		$this->load->model('General_model');
		$this->load->library('session');
	}


	public function index()
	{
		$this->load->view('Admin/index');
	}
	public function dashboard()
	{

		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');

		$data['articles'] = $this->AdminDashboard->dashagent();
		//$data=$this->AdminDashboard->dashagent();
		$adminId = $this->session->userdata('admin_id');
		$data['enq'] = $this->AdminDashboard->dashenquiry();
		$data['payment'] = $this->AdminDashboard->paymentReceived();
		$data['adminData'] = $this->General_model->fetch_single_data('users', array('id' => $adminId));
		$data['quotation'] = $this->General_model->record_count('enquiry', array('quoid' => "", 'AgentId !=' => ''));

		$this->session->set_userdata('admin_data', 	$data['adminData']);
		$this->load->view('Admin/index1', $data);
	}

	/*public function __construct()
{
	//parent::__construct();
	
	if(!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		
}*/
	public function updateAdmin()
	{

		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$post = $this->input->post();
		$id = $this->input->post('id');

		if ($this->AdminDashboard->updateAdmin($id, $post)); {
			$this->session->set_flashdata('update', 'Agent Details Update Successful');
			$agent = $this->AdminDashboard->dashagent();
			//$data=$this->AdminDashboard->dashagent();
			$enq = $this->AdminDashboard->dashenquiry();
			$this->load->view('Admin/index1', ['articles' => $agent, 'enq' => $enq,]);
		}
	}

	public function navdash()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$agent = $this->AdminDashboard->dashagent();
		//$data=$this->AdminDashboard->dashagent();
		$enq = $this->AdminDashboard->dashenquiry();
		$this->load->view('Admin/index1', ['articles' => $agent, 'enq' => $enq,]);
	}

	public function quotation()
	{

		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');

		$rt['details'] = $this->AdminDashboard->getqouitemdata();
		$rt['status'] = $this->General_model->fetch_data('quotationstatus', array());
		$this->load->view('Admin/quotation', $rt);
	}
	public function crtProduct()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('price', 'Material Price', 'required');
		if ($this->form_validation->run() == TRUE) {
			$name = $this->input->post('name');
			$supplier = $this->input->post('supplier');
			$spec = $this->input->post('spec');
			$uom = $this->input->post('uom');
			$qty = $this->input->post('qty');
			$price = $this->input->post('price');
			$category = $this->input->post('category');

			$r = $this->AdminDashboard->createProduct($name, $supplier, $spec, $uom, $qty, $price, $category);
			if ($r) {
				return redirect('Admin/createSuccess');
			}
		} else {
			echo "validation error";
		}
	}
	public function createSuccess()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$data['details'] = $this->AdminDashboard->getProduct();
		$this->load->view('Admin/ProductDetails', $data);
	}
	public function ProductDetails()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');

		$data['details'] = $this->AdminDashboard->getProduct();
		$data['category'] = $this->General_model->fetch_data('productcategory', array());
		$this->load->view('Admin/ProductDetails', $data);
	}

	public function CreateAgent()
	{

		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$data['details'] = $this->AdminDashboard->getagent();
		$this->load->view('Admin/CreateAgent', $data);
	}
	public function AgentList()
	{

		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');

		$data['details'] = $this->AdminDashboard->getagent();
		$this->load->view('Admin/AgentList', $data);
	}
	public function DashAgent()
	{
	}
	public function enquiry()
	{

		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');

		$data['enquiry'] = $this->AdminDashboard->getenquiry();
		$this->load->view('Admin/enquiry', $data);
	}
	public function customer()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');

		$data['enquiry'] = $this->AdminDashboard->customer();
		$this->load->view('Admin/customer', $data);
	}
	public function register()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email Id', 'required');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required');
		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$address = $this->input->post('address');
			$password = $this->input->post('password');
			$role = $this->input->post('role');

			$r = $this->AdminDashboard->createAgent($id, $name, $phone, $email, $address, $password, $role);
			if ($r) {
				$this->session->set_flashdata('success', 'Team Create Successful');
				return redirect('Admin/CreateAgent');
			} else {
				$this->session->set_flashdata('fail', 'Unable To Create Team');
				return redirect('Admin/CreateAgent');
			}
		} else {
			$this->session->set_flashdata('fail', 'Validation Error');
			return redirect('Admin/CreateAgent');
		}
	}

	public function deleteProduct()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$id = $this->input->post('id');
		$this->load->model('AdminDashboard', 'ad');
		$q = $this->ad->delproduct($id);
		if ($q) {
			$this->session->set_flashdata('delete', 'Product Deleted Successful');
			return redirect('Admin/ProductDetails');
		}
	}
	public function getProduct()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$id = $this->input->post('id');

		$rt = $this->AdminDashboard->getproductdata($id);
		$data = $this->General_model->fetch_data('productcategory', array());
		$this->load->view('Admin/editproduct', ['product' => $rt, 'category' => $data]);
	}
	public function updateProduct($id)
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$post = $this->input->post();

		if ($this->AdminDashboard->updateproduct($id, $post)); {
			$this->session->set_flashdata('update', 'Product Update Successful');
			return redirect('Admin/ProductDetails');
		}
		/*else
		{
			$this->session->set_flashdata('update','Product Details Unable to update');
					 	 return redirect('Admin/editproduct');
		}*/
	}
	public function deleteAgent()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$id = $this->input->post('id');

		$q = $this->AdminDashboard->delAgent($id);
		if ($q) {
			$this->session->set_flashdata('delete', 'Agent Deleted Successful');
			return redirect('Admin/AgentList');
		}
	}
	public function getAgent()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$id = $this->input->post('id');

		$rt = $this->AdminDashboard->getAgentdata($id);
		$this->load->view('Admin/editAgent', ['Agent' => $rt]);
	}
	public function updateAgent($id)
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$post = $this->input->post();

		if ($this->AdminDashboard->updateAgent($id, $post)); {
			$this->session->set_flashdata('update', 'Agent Details Update Successful');
			return redirect('Admin/createAgent');
		}
		/*else
		{
			$this->session->set_flashdata('update','Product Details Unable to update');
					 	 return redirect('Admin/editproduct');
		}*/
	}

	public function kw()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');

		$data['details'] = $this->AdminDashboard->getkw();
		$this->load->view('Admin/kw', $data);
	}
	public function crtkw()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('price', 'KW Price', 'required');
		if ($this->form_validation->run() == TRUE) {
			$post = $this->input->post();

			$r = $this->AdminDashboard->createkw($post);
			if ($r) {
				return redirect('Admin/createkwSuccess');
			}
		} else {
			echo "validation error";
		}
	}
	public function createkwSuccess()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$data['details'] = $this->AdminDashboard->getkw();
		$this->load->view('Admin/kw', $data);
	}
	public function deletekw()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$id = $this->input->post('id');

		$q = $this->AdminDashboard->delkw($id);
		if ($q) {
			$this->session->set_flashdata('delete', 'KW Deleted Successful');
			return redirect('Admin/kw');
		}
	}
	public function getkw()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$id = $this->input->post('id');

		$rt = $this->AdminDashboard->getkwdata($id);
		$this->load->view('Admin/editkw', ['kw' => $rt]);
	}
	public function updatekw($id)
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$post = $this->input->post();

		if ($this->AdminDashboard->updatekw($id, $post)); {
			$this->session->set_flashdata('update', 'KW Details Update Successful');
			return redirect('Admin/kw');
		}
		/*else
		{
			$this->session->set_flashdata('update','Product Details Unable to update');
					 	 return redirect('Admin/editproduct');
		}*/
	}
	public function pdfview($qid)
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$id = $this->session->admin_id;
		$this->load->model('Agentmodel');
		$rt = $this->Agentmodel->getqouitemdata($qid);
		$enqid = $rt[0]['enqId'];
		$enqdata = $this->Agentmodel->getqouitemenqdata($enqid);
		$quoid = $rt[0]['quoId'];
		$chk = $this->Agentmodel->getcheckdata($quoid);
		$this->load->view('Admin/pdfview', ['enq' => $enqdata, 'prodata' => $chk, 'quoitem' => $rt]);
	}

	//--------Excel Export--------------

	function action()
	{
		$this->load->model("AdminDashboard");
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);




		$column = 0;


		$object->getActiveSheet()->SetCellValue('A1',  'Name');
		$object->getActiveSheet()->SetCellValue('B1',  'Phone');
		$object->getActiveSheet()->SetCellValue('C1',  'Email');
		$object->getActiveSheet()->SetCellValue('D1',  'Address-1');
		$object->getActiveSheet()->SetCellValue('E1',  'Address-2');
		$object->getActiveSheet()->SetCellValue('F1',  'State');
		$object->getActiveSheet()->SetCellValue('G1',  'Pin Code');
		$column++;


		$employee_data = $this->AdminDashboard->customerexcel();

		$excel_row = 2;

		foreach ($employee_data as $row) {

			$object->getActiveSheet()->SetCellValue('A' . $excel_row, $row->cName);
			$object->getActiveSheet()->SetCellValue('B' . $excel_row, $row->phone);
			$object->getActiveSheet()->SetCellValue('C' . $excel_row, $row->email);
			$object->getActiveSheet()->SetCellValue('D' . $excel_row, $row->billAddress1);
			$object->getActiveSheet()->SetCellValue('E' . $excel_row, $row->billAddress2);
			$object->getActiveSheet()->setCellValue('F' . $excel_row, $row->billstate);
			$object->getActiveSheet()->setCellValue('G' . $excel_row, $row->billPin);
			$excel_row = $excel_row + 1;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'CSV');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Customer Data"' . time() . '".csv"');
		$object_writer->save('php://output');
	}

	/*-------------------Invoice----------------*/

	public function getinvoice()
	{

		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');

		$rt['details'] = $this->AdminDashboard->getqouitemdata();
		$this->load->view('Admin/quotationlist', $rt);
	}

	public function Makeinvoice($qid)
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$this->load->library('cart');

		/*
        $this->session->set_userdata('enqid',$enq);
        $this->session->set_userdata('quono',$quoNo);*/
		$chk = $this->AdminDashboard->getcheckdatabydID($qid);
		foreach ($chk as $value) {
			$pro = $value['pro'];
			$prodetails = explode(":", $pro);
			$pid = $prodetails[0];
			$pqty = $prodetails[1];
			$Product_data = $this->AdminDashboard->getproductdatabydID($pid);
			foreach ($Product_data as $data) {
				$quotedata = array(
					'id' => $data['id'],
					'name' => $data['name'],
					'supplier' => $data['supplier'],
					'spec' => $data['spec'],
					'uom' => $data['uom'],
					'qty' => $pqty,
					'price' => $data['price']
				);
			}

			$this->cart->insert($quotedata);
		}
		return redirect('Admin/viewmakeinvoice');
	}
	public function viewmakeinvoice()
	{
		$this->load->library('cart');
		if (!empty($this->cart->contents())) {
			$this->load->view('Admin/createinvoice');
		} else {
		}
	}

	public function cloneEnquiry()
	{

		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$enquiryId = $this->input->get('id');
		$buttonAction = $this->input->get('action');
		$cond = array('id' => base64_decode($enquiryId));
		$agent = array('role' => 'Agent');
		$enquiryDatabyId['enquiryData'] = $this->General_model->fetch_single_data('enquiry', $cond);
		$enquiryDatabyId['agentData'] =  $this->General_model->fetch_data('agent', $agent, $fields = null, $orderby = array());
		if ($buttonAction == 2) {
			$conddel = array('condition' => array('id' => base64_decode($enquiryId)));
			$deleteProduct = $this->General_model->delete_data('enquiry', $conddel);
			if (!empty($deleteProduct)) {
				$this->session->set_flashdata('Success', 'Enquiry deleted Successfully');
				return redirect('Enquiry-List');
			} else {
				$this->session->set_flashdata('fail', 'Unable to delete Enquiry');
				return redirect('Enquiry-List');
			}
		} else {
			$enquiryDatabyId['buttonAction'] = $buttonAction;
			$this->load->view('Admin/cloneEnquiry', $enquiryDatabyId);
		}
	}
	public function cloneEnquiryAction()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
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
			$buttonAction = $this->input->post('clone');
			$cloneData = array(
				'EnqId' => $buttonAction == 0 ? strtotime(date("Y-m-d H:i:s")) : $enquiry['enqId'],
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
				'AgentId' =>  $buttonAction == 0 ? $enquiry['AgentId'] : "",
				'pdf' => 'No',
				'created_at' => date("Y-m-d")
			);
		}
		if ($buttonAction == 0) {
			$successStatus = "Clone";
			$insertSuccess = $this->General_model->insert('enquiry', $cloneData);
		} else {
			$successStatus = "Edit";
			$cond = array('enqId' => $enquiry['enqId']);
			$insertSuccess = $this->General_model->update('enquiry', $cloneData, $cond);
		}
		if (!empty($insertSuccess)) {
			$this->session->set_flashdata('Success', 'Enquiry ' . $successStatus . ' Successfully');
			return redirect('Enquiry-List');
		} else {
			$this->session->set_flashdata('fail', 'Unable to ' . $successStatus . ' Enquiry....Something went wrong');
			return redirect('Enquiry-List');
		}
	}
	public function paymentTermList()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$cond1          = array();
		$data['paymentTerm'] = $this->General_model->fetch_data('paymentterm', $cond1, $fields = null, $orderby = array());
		$this->load->view('Admin/paymentTermList', $data);
	}
	public function paymentTermAction()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$paymentTermData = $this->input->post();
		$paymentTerm = array(
			'paymentPercent' => $paymentTermData['paymentPercent'],
			'paymentTermDescription' => $paymentTermData['paymentTermDescription'],
			'sequence' => $paymentTermData['sequence']
		);
		$insertSuccess = $this->General_model->insert('paymentterm', $paymentTerm);
		if (!empty($insertSuccess)) {
			$this->session->set_flashdata('Success', 'Payment Term Added  Successfully');
			return redirect('Payment-Term');
		} else {
			$this->session->set_flashdata('fail', 'Unable to add payment term!....Something went wrong');
			return redirect('Payment-Term');
		}
	}
	public function deletePaymentTerm()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$paymentTermId = $this->input->get('id');
		$conddel = array('condition' => array('paymentTermId' => base64_decode($paymentTermId)));
		$deleteProduct = $this->General_model->delete_data('paymentterm', $conddel);
		if ($deleteProduct) {
			$this->session->set_flashdata('delete', 'Payment Term Deleted  Successfully');
			return redirect('Payment-Term');
		} else {
			$this->session->set_flashdata('fail', 'Unable to delete payment term!....Something went wrong');
			return redirect('Payment-Term');
		}
	}
	public function termAndCondition()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$cond1          = array();
		$data['paymentTerm'] = $this->General_model->fetch_data('termcondition', $cond1, $fields = null, $orderby = array());
		$this->load->view('Admin/termAndCondition', $data);
	}
	public function termConditionAction()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$paymentTerm = $this->input->post();
		$insertSuccess = $this->General_model->insert('termcondition', $paymentTerm);
		if (!empty($insertSuccess)) {
			$this->session->set_flashdata('Success', 'Term and Condition Added  Successfully');
			return redirect('Term-And-Condition');
		} else {
			$this->session->set_flashdata('fail', 'Unable to add Term and Condition!....Something went wrong');
			return redirect('Term-And-Condition');
		}
	}
	public function agentListData()
	{

		$data = $this->AdminDashboard->getAgentList();
		foreach ($data as $key => $value) {
			$result['data'][] = array(
				'id' =>	$value['id'],
				'agentName' => $value['name']
			);
		}
		echo json_encode($result);
	}
	public function agentTransfer()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$post = $this->input->post();
		$condition =  array('EnqId' => $post['EnqId']);
		$value = array('AgentId' => $post['AgentId']);
		$success = $this->General_model->update('enquiry', $value, $condition);
		if ($success) {
			$this->session->set_flashdata('success', 'Enquiry transfer Successful.');
			return redirect('Enquiry-List');
		} else {
			$this->session->set_flashdata('fail', 'Enquiry transfer Failed.');
			return redirect('Enquiry-List');
		}
	}

	public function referenceEnquiry()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$condition = array('status' => 'In Process');
		$allData['enquiryData'] = $this->General_model->fetch_data('refference_enquiry', $condition, $fields = null, $orderby = array());
		$this->load->view('Admin/referenceEnquiry', $allData);
	}
	public function counterCommission()
	{
		$data = $this->input->post();
		$condition =  array('p_enquiryId' => $data['p_enquiryId']);
		$value = array('counterCommission' => $data['counterCommission']);
		$success = $this->General_model->update('refference_enquiry', $value, $condition);
		if ($success) {
			$this->session->set_flashdata('success', 'Counter Commission Updated Successfully.');
			return redirect('Reference-Enquiry');
		} else {
			$this->session->set_flashdata('fail', 'Counter Commission Updated Failed.');
			return redirect('Reference-Enquiry');
		}
	}
	public function acceptOffer()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$referenceId = $this->uri->segment(2);
		$commission = $this->uri->segment(3);
		$condition =  array('p_enquiryId' => $referenceId);
		$value = array('status' => 'Approve', 'counterCommission' => $commission);
		$success = $this->General_model->update('refference_enquiry', $value, $condition);
		if ($success) {
			$enquiry = $this->General_model->fetch_single_data('refference_enquiry', $condition);
			$billingAddress = explode(",", $enquiry['billingAddress']);
			$shippingAddress = explode(",", $enquiry['shippingAddress']);
			$enquiryId = strtotime(date("Y-m-d H:i:s"));
			$enquiryData = array(
				'enqId' => $enquiryId,
				'cname' => $enquiry['fullName'],
				'phone' => $enquiry['phone'],
				'email' => $enquiry['email'],
				'billAddress1' => $billingAddress[0],
				'billAddress2' => $billingAddress[1],
				'billState' => $billingAddress[2],
				'billPin' => $billingAddress[3],
				'ShipAddress1' => $shippingAddress[0],
				'ShipAddress2' => $shippingAddress[1],
				'shipstate' => $shippingAddress[2],
				'shippin' => $shippingAddress[3],
				'gst' => $enquiry['gstNo'],
				'grid' => $enquiry['grid'],
				'kw' => $enquiry['kw'],
				'unit' => $enquiry['unit'],
				'quantity' => $enquiry['quantity'],
				'remark' => $enquiry['remark'],
				'status' => 'Active',
				'AgentId' => '',
				'pdf' => 'No'
			);
			$successInsert = $this->General_model->insert('enquiry', $enquiryData);
			if ($successInsert) {
				$condition =  array('p_enquiryId' => $referenceId);
				$value = array('enquiryId' => $enquiryId);
				$successAccept = $this->General_model->update('refference_enquiry', $value, $condition);
				if ($successAccept) {
					$this->session->set_flashdata('success', '<strong>Well done!</strong> You successfully Accept your enquiry. ');
					return redirect('Reference-Enquiry');
				} else {
					$this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to Accept your enquiry, Please try after sometime. ');
					return redirect('Reference-Enquiry');
				}
			} else {
				$this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to Accept your enquiry, Please try after sometime. ');
				return redirect('Reference-Enquiry');
			}
		} else {
			$this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to Accept your enquiry, Please try after sometime. ');
			return redirect('Reference-Enquiry');
		}
	}

	public function deleteTermAndCondition()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$id =  $this->uri->segment(2);
		$deleteData = $this->AdminDashboard->delete_data($id);
		if ($deleteData) {
			$this->session->set_flashdata('success', '<strong>Well done!</strong> You successfully delete Term and condition. ');
			return redirect('Term-And-Condition');
		} else {
			$this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to delete Term and condition, Please try after sometime. ');
			return redirect('Term-And-Condition');
		}
	}
	public function referenceEnquiryList()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$successAccept['referenceEnquiry'] = $this->AdminDashboard->getReferenceEnquiryData();
		$this->load->view('Admin/referenceEnquiryList', $successAccept);
	}
	public function projectList()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$condition = array('Status' => "Process");
		$projectData['projectData'] = $this->General_model->fetch_data('project', $condition);
		$index = 0;
		foreach ($projectData['projectData'] as $key => $value) {

			$projectData['projectData'][$key]['quotationData'] = $this->General_model->fetch_single_data('quotation', array('projectCreated' => 1, 'quotationId' => $value['quotationId']));

			$projectData['projectData'][$key]['EnquiryData'] = $this->General_model->fetch_single_data('enquiry', array('quoid' => $value['quotationId']));

			$projectData['projectData'][$key]['amountPaid'] = $this->AdminDashboard->getPaymentData($value['projectId']);
			$index++;
		}
		$this->load->view('Admin/projectList', $projectData);
	}
	public function projectDetails()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$id = base64_decode($this->input->get('id'));
		$projectId = str_replace(":", "/", $id);

		$condition = array('Status' => "Process", "projectId" => $projectId);
		$projectData['projectData'] = $this->General_model->fetch_single_data('project', $condition);

		$projectData['projectData']['quotationData'] = $this->General_model->fetch_single_data('quotation', array('projectCreated' => 1, 'quotationId' => $projectData['projectData']['quotationId']));

		$projectData['projectData']['EnquiryData'] = $this->General_model->fetch_single_data('enquiry', array('quoid' => $projectData['projectData']['quotationId']));

		$projectData['projectData']['amountPaid'] = $this->AdminDashboard->getPayment($projectData['projectData']['projectId']);

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
		$projectData['projectData']['document'] = $this->AdminDashboard->getDocumentData($projectId);
		$this->load->view('Admin/projectDetails', $projectData);
	}
	public function customerDocuments()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$documents['documentName'] = $this->General_model->fetch_data('customerdocument', array());
		$this->load->view('Admin/customerDocuments', $documents);
	}

	public	function customerDocumentsAction()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$post =	$this->input->post();
		$data = array(
			'documentName' => $post['documentName']
		);
		$insertSuccess = $this->General_model->insert('customerdocument', $data);
		if ($insertSuccess) {
			$this->session->set_flashdata('success', '<strong>Well done!</strong> You successfully add document name. ');
			return redirect('Customer-Document');
		} else {
			$this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to document name, Please try after sometime. ');
			return redirect('Customer-Document');
		}
	}
	public function deleteDocument()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$documentId = $this->input->get('id');
		$conddel = array('condition' => array('document_id' => base64_decode($documentId)));
		$deleteProduct = $this->General_model->delete_data('customerdocument', $conddel);
		if ($deleteProduct) {
			$this->session->set_flashdata('delete', 'Document Deleted  Successfully');
			return redirect('Customer-Document');
		} else {
			$this->session->set_flashdata('fail', 'Unable to delete document!....Something went wrong');
			return redirect('Customer-Document');
		}
	}

	public function quotationStatus()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$quotationStatus['status'] = $this->General_model->fetch_data('quotationstatus', array());
		$this->load->view('Admin/quotationStatus', $quotationStatus);
	}
	public function quotationStatusAction()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$post =	$this->input->post();
		$data = array(
			'status' => $post['quotationStatus']
		);
		$insertSuccess = $this->General_model->insert('quotationstatus', $data);
		if ($insertSuccess) {
			$this->session->set_flashdata('success', '<strong>Well done!</strong> You successfully add Status. ');
			return redirect('Quotation-Status');
		} else {
			$this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to Status, Please try after sometime. ');
			return redirect('Quotation-Status');
		}
	}
	public function getEditData()
	{
		$id = $this->input->get('id');
		$data = $this->General_model->fetch_single_data('quotationstatus', array('quotationId' => $id));
		echo json_encode($data);
	}
	public function statusAction()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');
		$post =	$this->input->post();
		$data = array(
			'status' => $post['quotationStatus']
		);
		$insertSuccess = $this->General_model->update('quotationstatus', $data, array('quotationId' => $post['id']));
		if ($insertSuccess) {
			$this->session->set_flashdata('success', '<strong>Well done!</strong> You successfully update Status name. ');
			return redirect('Quotation-Status');
		} else {
			$this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to Status name, Please try after sometime. ');
			return redirect('Quotation-Status');
		}
	}
	public function productCategory()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');

		if ($this->input->method() == 'post') {
			$post =	$this->input->post();
			$data = array(
				'categoryName' => $post['categoryName']
			);
			$insertSuccess = $this->General_model->insert('productcategory', $data);
		}
		$data['category'] = $this->General_model->fetch_data('productcategory', array());
		$this->load->view('Admin/productCategory', $data);
	}

	public function quotationNotGenerate()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');


		$data['quotation'] = $this->General_model->fetch_data('enquiry', array('quoid' => "", 'AgentId !=' => ''), null, array('id' => 'DESC'));

		foreach ($data['quotation'] as $key =>  $value) {
			$data['quotation'][$key]['agent'] = $this->General_model->fetch_single_data('agent', array('id' => $value['AgentId']));
		}
		$this->load->view('Admin/quotationNotCreated', $data);
	}
	public function paymentReport()
	{
		if (!$this->session->userdata('admin_id'))
			return redirect('Admin/index');


		$data['project'] = $this->General_model->fetch_data('project', array(), null, array('id' => 'DESC'));

		foreach ($data['project'] as $key =>  $value) {
			$data['project'][$key]['quotation'] = $this->General_model->fetch_single_data('quotation', array('quotationId' => $value['quotationId']));
			$data['project'][$key]['customer'] = $this->General_model->fetch_single_data('enquiry', array('quoId' => $value['quotationId']));
			$data['project'][$key]['paymentReceived'] = $this->AdminDashboard->getPaymentReport($value['projectId']);
		}
		$this->load->view('Admin/paymentReport', $data);
	}
}
