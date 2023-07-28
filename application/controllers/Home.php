<?php
defined('BASEPATH') or exit('No direct script access allowed');
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Home extends CI_Controller
{

	public function index()
	{
		$this->load->view('index');
	}
	public function lg()
	{
		$this->load->view('Admin/index');
	}
	public function enquiry()
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
			$enquiryId =  strtotime(date("Y-m-d H:i:s"));
			$enquiryData = array(
				'enqId' => $enquiryId,
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
				'AgentId' => '',
				'pdf' => 'No',
				'created_at' => date("Y-m-d")
			);

			$this->load->model('enquiry');
			$r = $this->enquiry->insEnquiry($enquiryData);
			if ($r) {
				$fromMail = "enquiry@crm.evergreensolar.co.in";
				sendMail($enquiry['email'], $fromMail, $enquiryId);
				$this->session->set_flashdata('success', 'Enquiry submit successfully');
				return redirect('home/success');
			} else {
				$this->session->set_flashdata('failed', 'opss!.. Something went wrong.');
				return redirect('home/fail');
			}
		} else {
			$this->load->view('index');
		}
	}
	public function success()
	{
		$this->load->view('index');
	}
	public function fail()
	{
		$this->load->view('index');
	}
	public function approx()
	{
		$output = '';
		$grid = $this->input->post('grid');
		$kw = $this->input->post('kw');

		$this->load->model('Enquiry');
		$q = $this->Enquiry->approx($grid, $kw);
		$output = '<h5>KWP Solar Plant System Have Approx Price is 5000</h5>';
		echo $output;
	}
}

function sendMail($customerMail, $fromMail, $enquiryId)
{


	$logo = base_url('dist/img/evergreen-solar-2.png');
	$messageBody = '<!DOCTYPE html>
	<html 
		lang="en"
		xmlns:o="urn:schemas-microsoft-com:office:office"
		xmlns:v="urn:schemas-microsoft-com:vml">
		<head>
			<title></title>
			<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
			<meta content="width=device-width, initial-scale=1.0" name="viewport" />
			<style>
				* {box-sizing: border-box;}
	
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
																							Dear Sir/Madam,</span
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
																						>Thank you for reaching out to us with
																						your inquiry. We appreciate your
																						interest in M/s Evergreen Solar and
																						are delighted to provide you with the
																						information you are seeking. Our team
																						has carefully reviewed your request
																						and is dedicated to addressing your
																						needs promptly.</span
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
                                          >Your Enquiry Number is :
                                          <strong>' . $enquiryId . '</strong>
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
																						>If you have any further questions or
																						require immediate assistance, please
																						feel free to contact us at
																						<a href="tel: +917074833525">
																							+91 7074833525</a
																						>. Our knowledgeable staff will be
																						more than happy to assist you.</span
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
																						>We look forward to fulfilling your
																						information needs.</span
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
																				style="color: #ffffff; text-decoration: none; font-size:12px">info@evergreensolar.co.in</a></p>
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
	$subject = "Enquiry Submitted Success.....";


	$mail = new PHPMailer(true);
	$mail->isSMTP();
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->Host = "mumult1.hostarmada.net";
	$mail->SMTPAuth = true;
	$mail->Username = $fromMail;
	$mail->Password = "awE.RP0yyEoc";
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	$mail->Port = "465";

	$mail->From = $fromMail;
	$mail->FromName = "EverGreen Solar";
	$mail->addAddress($customerMail, ""); //Provide file path and name of the attachments 
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
