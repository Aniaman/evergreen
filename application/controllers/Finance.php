<?php
defined('BASEPATH') or exit('No direct script access allowed');
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Finance extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('General_model', 'gm');
    $this->load->model('FinanceModel', 'fm');
    $this->load->library('session');
    if ($this->session->finance_id == "") {
      return redirect('Login');
    }
  }

  public function dashboard()
  {
    $condition = array('Status' => "Process");
    $projectData['projectData'] = $this->gm->fetch_data('project', $condition, null, array('id' => 'DESC'));
    $index = 0;
    foreach ($projectData['projectData'] as $key => $value) {

      $projectData['projectData'][$key]['quotationData'] = $this->gm->fetch_single_data('quotation', array('projectCreated' => 1, 'quotationId' => $value['quotationId']));
      $projectData['projectData'][$key]['EnquiryData'] = $this->gm->fetch_single_data('enquiry', array('quoid' => $value['quotationId']));
      $projectData['projectData'][$key]['amountPaid'] = $this->fm->getPaymentData($value['projectId']);;
      $index++;
    }
    $this->load->view('Finance/dashBoard', $projectData);
  }
  public function paymentAction()
  {
    $post = $this->input->post();
    $projectData = array(
      'projectName' => $post['projectName'],
      'email' => $post['email'],
      'customerName' => $post['cName']
    );
    $paymentData = array(
      'projectId' => $post['projectId'],
      'paymentAmount' => $post['paymentAmount'],
      'paymentDate' => $post['paymentDate']
    );
    $paymentSuccess = $this->gm->insert('paymentreceived', $paymentData);
    if ($paymentSuccess) {
      $from = "info@crm.evergreensolar.co.in";
      sendMail($projectData, $paymentData, $from);
      $this->session->set_flashdata('success', '<strong>Well done!</strong> You successfully add payment. ');
      return redirect('Finance-DashBoard');
    } else {
      $this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to add payment, Please try after sometime. ');
      return redirect('Finance-DashBoard');
    }
  }
  public function getPaymentDataByProject()
  {
    $re_id = $this->input->get('re_id');
    $result = $this->fm->getPaymentDataWithSum($re_id);
    foreach ($result as $key => $value) {
      $paymentDetails['data'][] = array(
        'projectId' =>  $value['projectId'],
        'paymentAmount' => $value['paymentAmount'],
        'paymentDate' => $value['paymentDate']
      );
    }
    echo json_encode($paymentDetails);
  }

  public function getDocumentType()
  {
    $result = $this->fm->getDocumentType();
    foreach ($result as $key => $value) {
      $documentDetail['data'][] = array(
        'document_id' =>  $value['document_id'],
        'documentName' => $value['documentName'],
      );
    }
    echo json_encode($documentDetail);
  }

  public function documentUpload()
  {
    $this->load->helper('string');
    $post = $this->input->post();
    $documentType = $this->gm->fetch_single_data('customerdocument', array('document_id' => $post['documentType']));
    $fileName = str_replace(" ", "_", $documentType['documentName']) .  random_string('numeric', 5);
    if ($_FILES['document']['name'] != '') {

      $config['upload_path'] = 'assets/images/customerDocument/';
      $config['file_name'] = $fileName;
      $config['allowed_types'] = 'pdf|jpg|jpeg|png';

      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      $this->upload->do_upload('document');
      $imgdata = $this->upload->data();
      $img = $imgdata['file_name'];
      $post['document'] = $img;
    } else {
      $post['document'] = "";
    }

    $customerDocument = array(
      'projectId' => $post['projectId'],
      'document_id' => $post['documentType'],
      'document' => $post['document'],
    );

    $insertSuccess = $this->gm->insert('projectdocument', $customerDocument);
    if ($insertSuccess) {
      $this->session->set_flashdata('success', '<strong>Well done!</strong> You successfully Upload ' . $documentType['documentName'] . ' ');
      return redirect('Finance-DashBoard');
    } else {
      $this->session->set_flashdata('fail', '<strong>Oh snap!</strong>Something went wrong unable to upload ' . $documentType['documentName'] . ', Please try after sometime. ');
      return redirect('Finance-DashBoard');
    }
  }

  public function getDocumentData()
  {
    $id = str_replace(" ", "/", $this->input->get('id'));
    $result = $this->fm->getDocumentData($id);
    if (!empty($result) && sizeof($result) > 0) {
      foreach ($result['document'] as $key => $value) {
        $documentDetail['data'][] = array(
          'document_id' =>  $value['document_id'],
          'documentName' => $value['documentName'],
          'projectId' => $value['documentName'],
          'document' => $value['document'],
        );
      }
    }
    if (empty($documentDetail['data'])) {
      $documentDetail['data'][] = null;
    }
    echo json_encode($documentDetail);
  }

  public function quotationDetails()
  {
    $id = base64_decode($this->input->get('id'));
    $quotationData['quotationData'] = $this->gm->fetch_single_data('quotation', array('projectCreated' => 1, 'quotationId' => $id));
    $quotationData['quotationData']['EnquiryData'] = $this->gm->fetch_single_data('enquiry', array('quoid' => $quotationData['quotationData']['quotationId']));

    $productDataArray = explode(",", $quotationData['quotationData']['productData']);
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
    $quotationData['quotationData']['bom'] = $product;

    $this->load->view('Finance/quotationDetails', $quotationData);
  }
}

function sendMail($projectData, $paymentData, $fromMail)
{
  $logo = base_url('dist/img/evergreen-solar-2.png');
  $messageBody = '<!DOCTYPE html>
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
                                          alt="Evergreen Solar"
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
                                      padding-bottom: 10px;
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
                                        >
                                          <strong
                                            ><span style="font-size: 16px">
                                              Dear ' . $projectData['customerName'] . '</span
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
                                            >We hope this email finds you well. We
                                            are writing to inform you about the
                                            payment received for your ongoing
                                            project, ' . $projectData['projectName'] . '. This is an
                                            auto-generated message, so please
                                            refrain from replying to this
                                            email.</span
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
                                      padding-bottom: 10px;
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
                                            ><strong>Payment Details :</strong>
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
                                            >Amount Received :
                                            <strong>' . $paymentData['paymentAmount'] . '</strong>
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
                                            >Project:
                                            <strong>' . $projectData['projectName'] . '</strong>
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
                                            >Project No:
                                            <strong>' . $paymentData['projectId'] . '</strong>
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
                                            >Payment Date:
                                            <strong>' . $paymentData['paymentDate'] . '</strong>
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
                                      padding-bottom: 10px;
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
                                            >We acknowledge the receipt of
                                            ' . $paymentData['paymentAmount'] . ' towards your project.
                                            Thank you for making the payment
                                            promptly. We appreciate your
                                            commitment to the project\'s
                                            success.</span
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
                                      padding-bottom: 10px;
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
                                            >To access comprehensive project
                                            details, updates, and collaboration
                                            features, we invite you to log in to
                                            our CRM platform. You will find all
                                            the necessary information related to
                                            your project, including tasks,
                                            milestones, communication logs, and
                                            more. Please follow the steps below to
                                            access the CRM portal:</span
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
                                      padding-bottom: 10px;
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
                                            >Visit <a
                                            href="https://quote.evergreensolar.co.in/Customer"
                                            >Customer Portal</a
                                          > using any web
                                            browser.<br />
                                            Once logged in, you will gain full
                                            visibility into your project and be
                                            able to track its progress, view
                                            associated documents, and communicate
                                            with our team effectively.</span
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
                                            >Please note that this email serves as
                                            an automated response, and any replies
                                            sent to this address will not be
                                            received or processed. If you have any
                                            inquiries or require further
                                            assistance, kindly reach out to our
                                            dedicated support team at 7074833525.
                                            We are here to address your concerns
                                            and ensure a seamless project
                                            experience.</span
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
                                      padding-bottom: 10px;
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
                                            >We value your trust in our services
                                            and appreciate your prompt payment. We
                                            remain committed to delivering the
                                            highest level of satisfaction and look
                                            forward to your continued success with
                                            our CRM platform.</span
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
                                      padding-bottom: 10px;
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
                                      padding-bottom: 10px;
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
                                          <span style="font-size: 12px"
                                            >70748 33525</span
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
  $subject = "Payment Received";


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
  $mail->addAddress($projectData['email'], ""); //Provide file path and name of the attachments 
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $messageBody;
  $mail->AltBody = "This is the plain text version of the email content";
  if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
  } else {
    echo "Message has been sent successfully";
  }
}
