<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FinanceModel extends CI_model
{
  public function getPaymentData($projectId)
  {
    $result =  $this->db->select('* , SUM(paymentAmount) AS paidAmount')
      ->where(['projectId' => $projectId])
      ->get('paymentreceived')
      ->row_array();
    return $result;
  }

  public function getPaymentDataWithSum($projectId)
  {
    $result =  $this->db->select()
      ->where(['projectId' => $projectId])
      ->get('paymentreceived')
      ->result_array();
    return $result;
  }
  public function getDocumentType()
  {
    $q = $this->db->select()
      ->get('customerdocument');
    return $q->result_array();
  }

  public function getDocumentData($id)
  {
    $customerdocument = array();
    $result =  $this->db->select()
      ->where(['projectId' => $id])
      ->get('projectdocument');
    $customerdocument['document'] = $result->result_array();
    $i = 0;
    foreach ($customerdocument['document'] as $key => $value) {
      $q = $this->db->select()
        ->where(['document_id' => $value['document_id']])
        ->get('customerdocument')
        ->result_array();
      $customerdocument['document'][$i++]['documentName'] = $q[0]['documentName'];
    }
    return $customerdocument;
  }
}
