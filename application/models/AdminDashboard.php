<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminDashboard extends CI_model
{
	public function updateAdmin($id, array $post)
	{

		$q = $this->db->where(['id' => $id])
			->update('users', $post);


		return $q;
	}
	public function createProduct($name, $supplier, $spec, $uom, $qty, $price, $category)
	{
		$prod = array(
			'name' => $name,
			'supplier' => $supplier,
			'spec' => $spec,
			'uom' => $uom,
			'qty' => $qty,
			'price' => $price,
			'category' => $category
		);

		$result = $this->db->insert('product', $prod);
		return $result;
	}
	public function getProduct()
	{
		$q = $this->db->get("product");
		$data = $q->result_array();
		return $data;
	}
	public function getAgent()
	{
		$q = $this->db->get("agent");
		$data = $q->result_array();
		return $data;
	}
	public function dashagent()
	{
		$q = $this->db->get("agent");
		return $q->result();
	}
	public function dashenquiry()
	{
		$q = $this->db->get("enquiry");
		return $q->result();
	}
	public function getenquiry()
	{
		$q = $this->db->get("enquiry");
		$data = $q->result_array();
		return $data;
	}
	public function customer()
	{
		$q = $this->db->get("enquiry");
		$data = $q->result_array();

		return $data;
	}
	public function customerexcel()
	{
		$q = $this->db->get("enquiry");
		$data = $q->result();
		/*echo "<pre>";
		print_r($data);
		exit;*/
		return $data;
	}
	public function createAgent($id, $name, $phone, $email, $address, $password, $role)
	{
		$agent = array(
			'AgentId' => $id,
			'name' => $name,
			'phone' => $phone,
			'email' => $email,
			'address' => $address,
			'password' => $password,
			'role' => $role
		);

		$result = $this->db->insert('agent', $agent);
		return $result;
	}
	public function delproduct($id)
	{

		$q = $this->db->where('id', $id)
			->delete('product');
		return $q;
	}
	public function delAgent($id)
	{

		$q = $this->db->where('id', $id)
			->delete('Agent');
		return $q;
	}
	public function getproductdata($id)
	{

		$q = $this->db->select()
			->where('id', $id)
			->get('product');
		return $q->row();
	}
	public function updateproduct($id, array $product)
	{
		$prod = array(
			'name' => $product['name'],
			'supplier' => $product['supplier'],
			'spec' => $product['spec'],
			'uom' => $product['uom'],
			'qty' => $product['qty'],
			'price' => $product['price'],
			'category' => $product['category']
		);
		return $this->db->where('id', $id)
			->update('product', $prod);
	}
	public function getAgentdata($id)
	{

		$q = $this->db->select()
			->where('id', $id)
			->get('Agent');
		return $q->row();
	}
	public function updateAgent($id, array $product)
	{
		return $this->db->where('id', $id)
			->update('Agent', $product);
	}
	public function createkw(array $kw)
	{

		return $this->db->insert('kw', $kw);
	}
	public function getkw()
	{
		$q = $this->db->get("kw");
		$data = $q->result_array();
		return $data;
	}
	public function delkw($id)
	{

		$q = $this->db->where('id', $id)
			->delete('kw');
		return $q;
	}
	public function getkwdata($id)
	{

		$q = $this->db->select()
			->where('id', $id)
			->get('kw');
		return $q->row();
	}
	public function updatekw($id, array $kw)
	{
		return $this->db->where('id', $id)
			->update('kw', $kw);
	}
	public function getqouitemdata()
	{
		$quotationDetail = array();
		$q = $this->db->select('*')
			->get('quoitem');
		foreach ($q->result_array()  as  $value) {
			$s = $this->db->select('*')
				->where(['EnqId' => $value['enqId']])
				->get('enquiry');
			$agent = $this->db->select('*')
				->where(['id' => $value['Agid']])
				->get('agent');
			$status = $this->db->select('*')
				->where(['quotationId ' => $value['quotationStatus']])
				->get('quotationstatus');

			$value['enquiry'] = $s->result_array();
			$value['agent'] = $agent->result_array();
			$value['status'] = $status->row_array();
			$quotationDetail[] = $value;
		}

		return $quotationDetail;
	}


	public function getcheckdatabydID($quoid)
	{

		$q = $this->db->select('pro')
			->like('quoid', $quoid, 'before')
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
	public function getAgentList()
	{
		$q = $this->db->select()
			->get('agent');
		return $q->result_array();
	}
	public function delete_data($condition)
	{
		$q = $this->db->where('id', $condition)
			->delete('termcondition');
		return $q;
	}
	public function getReferenceEnquiryData()
	{
		$q = $this->db->select()
			->get('refference_enquiry');
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

	public function paymentReceived()
	{
		$result =  $this->db->select_sum('paymentAmount')
			->get('paymentreceived')
			->row();
		return $result;
	}
	public function getPaymentReport($projectId)
	{
		$result =  $this->db->select_sum('paymentAmount')
			->where(['projectId' => $projectId])
			->get('paymentreceived')
			->row();
		return $result;
	}
}
