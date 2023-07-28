<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends CI_model
{
	
	public function insEnquiry($enquiryData)
	{
		
	
		 $result=$this->db->insert('enquiry', $enquiryData);
		 return $result;
	}
	public function approx($grid,$kw)
	{
		$q=$this->db->select()
				->where(['grid'=>$grid,'kw'=>$kw])
				->get('kw');
		return $q->result_array();
	}
}
