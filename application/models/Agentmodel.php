<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agentmodel extends CI_model
{


	public function getAgentdata($id)
	{

		$q = $this->db->select()
			->where('id', $id)
			->get('agent');
		return $q->row();
	}
	public function getreminderdata($id)
	{

		$q = $this->db->select()
			->where(['agid' => $id, 'followup' => 'No'])
			->get('reminder');
		return $q->result_array();
	}
	public function updateAgent($id, array $product)
	{
		return $this->db->where('id', $id)
			->update('agent', $product);
	}
	public function getnewenquiry()
	{

		$q = $this->db->select()
			->where(['AgentId' => "", 'status' => 'Active'])
			->order_by('id', 'desc')
			->get('enquiry');
		return $q->result_array();
	}
	public function allAcceptenquiry($id)
	{

		$q = $this->db->select()
			->where(['AgentId' => $id, 'status' => 'Deactive'])
			->order_by('id', 'desc')
			->get('enquiry');
		return $q->result_array();
	}
	public function AcceptEnquiry($id, array $enq, $agid)
	{
		$data = array(
			'status' => 'Deactive',
			'AgentId' => $agid
		);
		return $this->db->where('id', $id)
			->update('enquiry', $data);
	}
	public function getquotation($id)
	{

		$q = $this->db->select()
			->where(['AgentId' => $id, 'pdf' => 'No'])
			->order_by('id', 'desc')
			->get('enquiry');
		return $q->result_array();
	}
	public function Addproduct(array $post, $total)
	{
		$id = $post['AgentId'];
		$prod = array(
			'AgentId' => $id,
			'Pname' => $post['Pname'],
			'Psupplier' => $post['Psupplier'],
			'Pspec' => $post['Pspec'],
			'Puom' => $post['Puom'],
			'qty' => $post['qty'],
			'rate' => $post['rate'],
			'total' => ''
		);

		$result = $this->db->insert('quote', $prod);
		return $result;
	}
	public function prodetails($id)
	{

		$q = $this->db->select()
			->where(['AgentId' => $id])
			->get('quote');
		return $q->result_array();
	}

	public function getProductWithCategory()
	{
		$this->db->select('*');
		$this->db->join('product q', 'e.categoryName=q.category ');
		$q = $this->db->get('productcategory e');
		return $q->result_array();
	}

	public function AddProd($Pid = '')
	{
		$this->db->select('*');
		$this->db->from('product');
		if ($Pid) {
			$q = $this->db->where('id', $Pid)
				->get();
			$data = $q->row_array();
		} else {
			$q = $this->db->get();
			$data = $q->result_array();
		}
		return $data;
	}
	public function getenquirydata($enqId)
	{
		$q = $this->db->select()
			->where(['EnqId' => $enqId, 'pdf' => 'No'])
			->get('enquiry');
		return $q->row_array();
	}
	public function checkdata($pdata, $quoid)
	{
		$data = array('pro' => $pdata, 'quoid' => $quoid);
		$result = $this->db->insert('checkdata', $data);
		return $result;
	}

	public function quote($enqId, $quoId, $commi, $rate, $total, $Agid, $termAndCondition, $expiryDate)
	{
		$d = date("Y-m-d");

		$data = array(
			'enqId' => $enqId,
			'quoId' => $quoId,
			'commi' => $commi,
			'rate' => $rate,
			'total' => $total,
			'Agid' => $Agid,
			'created' => $d,
			'reminder' => 'No',
			'termAndCondition' => $termAndCondition,
			'expiryDate' => $expiryDate,
			'projectCreated' => 0,
			'quotationStatus' => 1

		);
		$result = $this->db->insert('quoitem', $data);
		return $result;
	}
	public function pdf($enqId, $quoId)
	{
		$data = array(
			'enqId' => $enqId,
			'quoId' => $quoId

		);
		$result = $this->db->insert('pdf', $data);
		return $result;
	}
	public function pdfyes($enqId, $quoid)
	{
		$yes = array('pdf' => 'yes', 'quoid' => $quoid);
		$q = $this->db->where('EnqId', $enqId)
			->update('enquiry', $yes);
		return $q->result_array();
	}


	public function allquotationdata($id)
	{
		$this->db->select('*', 'qs.*');
		$this->db->join('quoitem q', 'e.EnqId=q.enqId  And e.AgentId=' . $id);
		$this->db->join('quotationstatus qs', 'qs.quotationId =q.quotationStatus');
		$this->db->where('q.projectCreated != 1');
		$this->db->order_by('q.id', 'desc');
		$q = $this->db->get('enquiry e');
		return $q->result_array();
	}

	public function getqouitemdata($qId)
	{

		$q = $this->db->select()
			->where(['id' => $qId])
			->get('quoitem');
		return $q->result_array();
	}

	public function getqouitemenqdata($enqid)
	{

		$q = $this->db->select()
			->where(['EnqId' => $enqid])
			->get('enquiry');
		return $q->result_array();
	}
	public function getcheckdata($quoid)
	{

		$q = $this->db->select()
			->where(['quoid' => $quoid])
			->get('checkdata');
		return $q->result_array();
	}
	public function reminder($enqid, $cname, $phone, $kw, $grid, $quoid, $commi, $id)
	{
		$data = array(
			'enqId' => $enqid,
			'cname' => $cname,
			'phone' => $phone,
			'kw' => $kw,
			'grid' => $grid,
			'quoId' => $quoid,
			'commi' => $commi,
			'status' => 'Active',
			'agid' => $id,
			'followup' => 'No'

		);
		$result = $this->db->insert('reminder', $data);
		return $result;
	}

	public function allquotationdataReminder($id)
	{

		$q = $this->db->select()
			->where(['Agid' => $id, 'reminder' => 'No'])
			->get('quoitem');
		return $q->result_array();
	}
	public function getremiderdata($id)
	{

		$q = $this->db->select()
			->where(['id' => $id, 'status' => 'Active'])
			->get('reminder');
		return $q->result_array();
	}
	public function getallremiderdata($id)
	{

		$q = $this->db->select()
			->where(['agid' => $id, 'status' => 'Active'])
			->get('reminder');
		return $q->result_array();
	}


	public function updatequoidreminder($quoremid)
	{
		$yes = array(
			'reminder' => 'Yes'
		);
		$q = $this->db->where('id', $quoremid)
			->update('quoitem', $yes);

		return $q;
	}
	public function reminderfollow($id)
	{
		$yes = array(
			'followup' => 'Yes'
		);
		$q = $this->db->where('id', $id)
			->update('reminder', $yes);

		return $q;
	}

	public function getqouitemdatabydID($qid)
	{

		$q = $this->db->select()
			->where(['id' => $qid])
			->get('quoitem');
		return $q->result_array();
	}
	public function getcheckdatabydID($quoid)
	{

		$q = $this->db->select('pro')
			->where(['quoid' => $quoid])
			->get('checkdata');
		return $q->result_array();
	}
	public function getproductdatabydID($pid)
	{
		$q = $this->db->select()
			->where(['id' => $pid])
			->get('product');
		return $q->result_array();
	}
	public function getquotationproduct()
	{
		$this->db->select('*');
		$q = $this->db->get('product');
		return $q->result_array();
	}
	public function editgetenquirydata($enqId)
	{

		$q = $this->db->select()
			->where(['EnqId' => $enqId])
			->get('enquiry');
		return $q->result_array();
	}
	public function delquoitemdata($quono)
	{
		$q = $this->db->where('quoId', $quono);
		$this->db->delete('quoitem');
	}
	public function delcheckdata($quono)
	{
		$this->db->where('quoId', $quono);
		$this->db->delete('checkdata');
	}

	public function quotationData($id)
	{
		$q = $this->db->select('*')
			->where(['id' => $id])
			->get('quoitem');
		$quoteItem = $q->row_array();
		$quotationData = $this->db->select('*')
			->where(['quotationId' => $quoteItem['quoId']])
			->get('quotation');
		return $quotationData->row_array();
	}

	public function quotationProductData($product)
	{
		foreach ($product as  $value) {
			$q = $this->db->select('*')
				->where(['id' => $value['productId']])
				->get('product');
			$productData[] = $q->row_array();
		}
		return $productData;
	}
	public function getEnquiryDataQuotation($enqId)
	{
		$q = $this->db->select()
			->where(['EnqId' => $enqId])
			->get('enquiry');
		return $q->row_array();
	}

	public function getPaymentTerm()
	{

		$q = $this->db->select("*")
			->order_by('sequence', 'ASC')
			->get('paymentterm');
		return $q->result_array();
	}

	public function getPaymentTermById($paymentTermId)
	{

		$q = $this->db->select("*")
			->where(['paymentTermId' => $paymentTermId])
			->get('paymentterm');
		return $q->row_array();
	}

	public function deleteQuotation($quono)
	{
		$q = $this->db->where('enqId', $quono);
		$this->db->delete('quotation');
	}
	public function getTermAndCondition()
	{
		$q = $this->db->select('*')
			->get('termcondition');
		return $q->result_array();
	}

	public function getPaymentData($projectId)
	{
		$result =  $this->db->select('* , SUM(paymentAmount) AS paidAmount')
			->where(['projectId' => $projectId])
			->get('paymentreceived')
			->row_array();
		return $result;
	}
	public function getPayment($projectId)
	{
		$result =  $this->db->select('*')
			->where(['projectId' => $projectId])
			->get('paymentreceived')
			->result_array();
		return $result;
	}
	public function getDocumentData($id)
	{
		$customerdocument = array();
		$result =  $this->db->select()
			->where(['projectId' => $id])
			->get('projectdocument');
		$customerdocument = $result->result_array();
		$i = 0;
		foreach ($customerdocument as $key => $value) {
			$q = $this->db->select()
				->where(['document_id' => $value['document_id']])
				->get('customerdocument')
				->result_array();
			$customerdocument[$i++]['documentName'] = $q[0]['documentName'];
		}
		return $customerdocument;
	}
}
