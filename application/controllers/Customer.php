<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('General_model', 'gm');
    $this->load->model('CustomerModel', 'cm');
    $this->load->library('session');
  }
  public function dashboard()
  {
    $condition = array('Status' => "Process", "customerId" => $this->session->customer_id);
    $projectData['projectData'] = $this->gm->fetch_data('project', $condition);
    $index = 0;
    foreach ($projectData['projectData'] as $key => $value) {

      $projectData['projectData'][$key]['quotationData'] = $this->gm->fetch_single_data('quotation', array('projectCreated' => 1, 'quotationId' => $value['quotationId']));

      $projectData['projectData'][$key]['EnquiryData'] = $this->gm->fetch_single_data('enquiry', array('quoid' => $value['quotationId']));

      $projectData['projectData'][$key]['amountPaid'] = $this->cm->getPaymentData($value['projectId']);
      $index++;
    }

    $this->load->view('Customer/dashBoard', $projectData);
  }
  public function customerLogin()
  {
    $this->load->view('Customer/login');
  }
  public function projectDetails()
  {
    $id = base64_decode($this->input->get('id'));
    $projectId = str_replace(":", "/", $id);

    $condition = array('Status' => "Process", "projectId" => $projectId);
    $projectData['projectData'] = $this->gm->fetch_single_data('project', $condition);

    $projectData['projectData']['quotationData'] = $this->gm->fetch_single_data('quotation', array('projectCreated' => 1, 'quotationId' => $projectData['projectData']['quotationId']));

    $projectData['projectData']['EnquiryData'] = $this->gm->fetch_single_data('enquiry', array('quoid' => $projectData['projectData']['quotationId']));

    $projectData['projectData']['amountPaid'] = $this->cm->getPayment($projectData['projectData']['projectId']);

    $productDataArray = explode(",", $projectData['projectData']['quotationData']['productData']);
    foreach ($productDataArray as  $value) {
      $productData[] = explode(':', $value);
    }
    foreach ($productData as $key =>  $value) {
      $condition = array("id" => $value[0]);
      $product[]  = $this->gm->fetch_single_data('product', $condition);
      $product[$key]['warranty'] = sizeof($productData[$key]) == 4 ? $productData[$key][3] : "";
      $product[$key]['quantity'] = $productData[$key][1];
      $product[$key]['cost'] = $productData[$key][2];
    }
    $projectData['projectData']['document'] = $this->cm->getDocumentData($projectId);
    $projectData['projectData']['bom'] = $product;
    $this->load->view('Customer/projectDetails', $projectData);
  }
}
