<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder extends CI_Controller {


	public function remind()
	{
	

         
		$this->load->model('AdminDashboard');
		$data=$this->AdminDashboard->getagent();

		foreach ($data as  $value) {
		 $id=$value['id'];
		  $email=$value['email'];
		
      
		$this->load->model('Agentmodel');
		$rt=$this->Agentmodel->allquotationdataReminder($id);
		 $date=date("d");
		 foreach ($rt as $datetime) {
		 	$d=$datetime['created'];
		 	$da=explode("-",$d);
		 	 $creatDate=$da[2];
		 	 if ($creatDate==$date) 
		 	 {
		 	 	$re=$creatDate-$date;
		 	 } 
		 	 else 
		 	 	{
			 	 	if ($creatDate<$date) 
			 	 	{
			 	 		$re=$date-$creatDate;
			 	 	}
			 	 	else
			 	 	{
			 	 		$re=$creatDate-$date;
			 	 	}
		 	 	}

		 	 if($re>6)
		 	 {

		 	 	$enqid=$datetime['enqId'];
		 	 	$qouremid=$datetime['id'];
		 	 
		 	 	$enquiry=$this->Agentmodel->getqouitemenqdata($enqid);

		 	 	$cname=$enquiry[0]['cName'];
		 	 	$phone=$enquiry[0]['phone'];
		 	 	$kw=$enquiry[0]['KW'];
		 	 	$grid=$enquiry[0]['Grid'];
		 	 	$quoid=$datetime['quoId'];
		 	 	$commi=$datetime['commi'];
		 	 	$rem=$this->Agentmodel->updatequoidreminder($qouremid);
		 	 	$remind=$this->Agentmodel->reminder($enqid,$cname,$phone,$kw,$grid,$quoid,$commi,$id);
		 	 	if($remind)
		 	 	{
		 	 		$to = $email;
		 	 		//$to = "anisrivastavaas641@gmail.com";
					$subject = "Follow Up";

					$message = '
					<html>
					<head>
					<title>Follow Up For Quotation</title>
					</head>
					<body>
					<table>
					<tr>
					<th>Enquiry Id</th>
					<th>Customer Name</th>
					<th>Phone</th>
					<th>Quotation Id</th>
					</tr>
					<tr>
					<td>'.$enqid.'</td>
					<td>'.$cname.'</td>
					<td>'.$phone.' </td>
					<td>'.$quoid.'</td>
					</tr>
					</table>
					</body>
					</html>
					';

					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";



					mail($to,$subject,$message,$headers);
					
         
		 	 	}

					
		 	 }
		 }
	}

	}

}
?>