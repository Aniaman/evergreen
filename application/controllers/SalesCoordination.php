<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SalesCoordination extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('General_model');
    $this->load->model('Agentmodel');
    $this->load->model('SalesCoordinationModel', 'scm');
    $this->load->library('session');
    if ($this->session->sales_cod_id == "") {
      return redirect('Login');
    }
  }
  public function index()
  {
    $cond = array('id' => $this->session->sales_cod_id);
    $allData['coordinatorData'] = $this->General_model->fetch_single_data('agent', $cond);
    $this->load->view('SalesCoordinator/index', $allData);
  }
  public function addEnquiry()
  {
    $cond = array('id' => $this->session->sales_cod_id);
    $allData['coordinatorData'] = $this->General_model->fetch_single_data('agent', $cond);
    $cond1 = array('agentId' => $this->session->sales_cod_id);
    $allData['enquiryData'] = $this->General_model->fetch_data('refference_enquiry', $cond1, $fields = null, $orderby = array());
    $this->load->view('SalesCoordinator/enquiryList', $allData);
  }
  public function confirmEnquiry()
  {
    $cond = array('id' => $this->session->sales_cod_id);
    $allData['coordinatorData'] = $this->General_model->fetch_single_data('agent', $cond);
    $cond1 = array('agentId' => $this->session->sales_cod_id);
    $allData['enquiryData'] = $this->General_model->fetch_data('refference_enquiry', $cond1, $fields = null, $orderby = array());
    $this->load->view('SalesCoordinator/approveEnquiryList', $allData);
  }
  public function addEnquiryAction()
  {
    $enquiryData = $this->input->post();
    $billingAddress = $enquiryData['area'] . ", " . $enquiryData['landMark'] . ", " . $enquiryData['state'] . "," . $enquiryData['pinCode'];
    $shippingAddress = $enquiryData['shipArea'] . ", " . $enquiryData['shipLandMark'] . ", " . $enquiryData['shipState'] . "," . $enquiryData['shipPinCode'];;
    $enquiry = array(
      'p_enquiryId' =>  strtotime(date("Y-m-d H:i:s")),
      'fullName' => $enquiryData['fullName'],
      'phone' =>  $enquiryData['phone'],
      'email' =>  $enquiryData['email'],
      'billingAddress' => $billingAddress,
      'shippingAddress' => $shippingAddress,
      'gstNo' => $enquiryData['gstNo'],
      'grid' => $enquiryData['grid'],
      'kw' => $enquiryData['kw'],
      'unit' => $enquiryData['unit'],
      'quantity' => $enquiryData['quantity'],
      'remark' => $enquiryData['remark'],
      'commission' => $enquiryData['commission'],
      'agentId' => $enquiryData['agentId'],
      'enquiryId' => '',
      'quotationId' => '',
      'counterCommission' => '',
      'commissionAmount' => '',
      'status' => 'In Process',
    );

    $success = $this->General_model->insert('refference_enquiry', $enquiry);
    if ($success) {
      $this->session->set_flashdata('success', '<strong>Well done!</strong> You successfully add your enquiry. 👍');
      return redirect('Add-Enquiry');
    } else {
      $this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to add your enquiry, Please try after sometime. 👎');
      return redirect('Add-Enquiry');
    }
  }
  public function deleteEnquiry()
  {
    $re_id = $this->uri->segment(2);
    $condition =  array('re_id' => $re_id);
    $success = $this->scm->deleteEnquiryData('refference_enquiry', $condition);
    if ($success) {
      $this->session->set_flashdata('success', '<strong>Well done!</strong> You successfully delete your enquiry. 👍');
      return redirect('Add-Enquiry');
    } else {
      $this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to delete your enquiry, Please try after sometime. 👎');
      return redirect('Add-Enquiry');
    }
  }
  public function getEnquiryDataById()
  {
    $re_id = $this->input->get('re_id');
    $cond = array('re_id' => $re_id);
    $result = $this->scm->fetch_single_data('refference_enquiry', $cond);
    echo json_encode($result);
  }
  public function editEnquiryAction()
  {
    $enquiryData = $this->input->post();
    $billingAddress = $enquiryData['area'] . ", " . $enquiryData['landMark'] . ", " . $enquiryData['state'] . "," . $enquiryData['pinCode'];
    $shippingAddress = $enquiryData['shipArea'] . ", " . $enquiryData['shipLandMark'] . ", " . $enquiryData['shipState'] . "," . $enquiryData['shipPinCode'];;
    $enquiry = array(
      'p_enquiryId' =>  $enquiryData['p_enquiryId'],
      'fullName' => $enquiryData['fullName'],
      'phone' =>  $enquiryData['phone'],
      'email' =>  $enquiryData['email'],
      'billingAddress' => $billingAddress,
      'shippingAddress' => $shippingAddress,
      'gstNo' => $enquiryData['gstNo'],
      'grid' => $enquiryData['grid'],
      'kw' => $enquiryData['kw'],
      'unit' => $enquiryData['unit'],
      'quantity' => $enquiryData['quantity'],
      'remark' => $enquiryData['remark'],
      'commission' => $enquiryData['commission'],
      'agentId' => $enquiryData['agentId'],
      'enquiryId' => '',
      'quotationId' => '',
      'counterCommission' => '',
      'commissionAmount' => '',
      'status' => 'In Process',
    );
    $condition = array('p_enquiryId' => $enquiryData['p_enquiryId']);
    $success = $this->General_model->update('refference_enquiry', $enquiry, $condition);
    if ($success) {
      $this->session->set_flashdata('success', '<strong>Well done!</strong> You successfully update your enquiry. 👍');
      return redirect('Add-Enquiry');
    } else {
      $this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to update your enquiry, Please try after sometime. 👎');
      return redirect('Add-Enquiry');
    }
  }
  public function acceptOffer()
  {
    $referenceId = $this->uri->segment(2);
    $condition =  array('p_enquiryId' => $referenceId);
    $value = array('status' => 'Approve');
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
          return redirect('Add-Enquiry');
        } else {
          $this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to Accept your enquiry, Please try after sometime. ');
          return redirect('Add-Enquiry');
        }
      } else {
        $this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to Accept your enquiry, Please try after sometime. ');
        return redirect('Add-Enquiry');
      }
    } else {
      $this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to Accept your enquiry, Please try after sometime. ');
      return redirect('Add-Enquiry');
    }
  }

  public function downloadQuotation()
  {
    $quotationId = $this->input->get('id');
    $quoteData = $this->General_model->fetch_single_data('quoitem', array('quoid' => base64_decode($quotationId)));
    $quotationData['quotation'] = $this->Agentmodel->quotationData($quoteData['id']);
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
}
