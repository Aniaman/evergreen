<?php

$commi = $quoitem[0]['commi'];
?>

<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>

<body>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container">
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<!-- Main content -->
							<div class="invoice p-3 mb-3">
								<!-- title row -->
								<div class="row">
									<div class="col-12">
										<h4>
											<img src="<?php echo base_url('dist/img/this.jpg'); ?>" height="500px" width="100%" title=""></a>
										</h4>
									</div>
									<!-- /.col -->
								</div>
								<!-- info row -->
								<div class="row invoice-info">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center" colspan="8" style="font-size: 40px;font-weight: 600px;">Ever Green Solar</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td colspan="4" class="text-center"> <strong>GST NO:- 19ESRPK1175D1ZG</strong> </td>
												<td colspan="4" class="text-center"> <strong>Company ADDRESS :- 81/75, N.C.C ROAD,<br> BANIPUR ,HABRA, NORTH 24 PGS</strong></td>
											</tr>

										</tbody>

									</table>
									<table class="table table-bordered">
										<thead>

										</thead>
										<tbody>
											<tr>
												<td width="60%"><strong>To</strong></td>
												<td width="20%"> <strong>Quotation No</strong> </td>
												<td width="20%"> <strong><?php echo $enq[0]['quoid'] != "" ? $enq[0]['quoid'] : "---NA---"; ?></strong></td>
											</tr>
											<tr>
												<td width="60%"><strong><?php echo $enq[0]['cName']; ?><br> <?php echo $enq[0]['phone']; ?> <br><?php echo $enq[0]['email']; ?><br> <?php echo $enq[0]['Gst']; ?></strong></td>
												<td width="20%"> <strong>Date</strong></td>
												<td width="20%"> <strong><?php echo  $quoitem[0]['created']; ?></strong></td>
											</tr>
										</tbody>

									</table>
									<table class="table table-bordered">
										<thead>
										</thead>
										<tbody>
											<tr>
												<td width="50%" class="text-center"><strong>Bill To</strong></td>
												<td width="50%" class="text-center"><strong> Ship To </strong></td>
											</tr>
											<tr>
												<td width="50%"><strong><?php echo $enq[0]['billAddress1']; ?><br> <?php echo $enq[0]['billAddress1']; ?> <br><?php echo $enq[0]['billstate']; ?><br> <?php echo $enq[0]['billPin']; ?></strong></td>
												<td width="50%"><strong><?php echo $enq[0]['shipAddress1']; ?><br> <?php echo $enq[0]['shipAddress1']; ?> <br><?php echo $enq[0]['shipState']; ?><br> <?php echo $enq[0]['shipPin']; ?></strong></td>
											</tr>
										</tbody>

									</table>
									<table class="table">
										<thead>
										</thead>
										<tbody>
											<tr>
												<td class="text-center" colspan="8" style="font-size: 30px;font-weight: 400px;"><strong><?php echo $enq[0]['KW']; ?> KWp Solar Plant <?php echo $enq[0]['Grid']; ?> System</strong></td>
											</tr>
											<tr>
												<td class="text-center" colspan="8" style="font-size: 40px;font-weight: 600px;">TECHNO-COMMERCIAL PROPOSAL</td>
											</tr>
										</tbody>

									</table>
									<!-- /.col -->
									<table class="table ">
										<h1>1.Company Profile</h1>
										<thead>

										</thead>
										<tbody>
											<tr>
												<td>“I feel more confident than ever that the power to save the planet rests with the individual consumer.” <br><strong>– Denis Hayes</strong></td>
											</tr>
											<tr>
												<td>“The only way forward, if we are going to improve the quality of the environment, is to get everybody involved.” <br><strong>– Richard Rogers</strong></td>
											</tr>
											<tr>
												<td>“The sun is the only safe nuclear reactor, situated as it is some ninety-three million miles away.”<br><strong>– Stephanie Mills</strong></td>
											</tr>
											<tr>
												<td>“Convergence between economy, ecology and energy should define our future.”<br><strong>– PM Modi</strong></td>
											</tr>

											<tr>
												<td>At Everenergy, we look forward to these days where we, every people in this mother earth would be able to contribute to nature by producing its own energy. Solar is the easiest way to achieve our dream of a sustainable green future. We help to achieve this by making Solar more economically viable to each and every person.</td>
											</tr>
											<tr>
												<td>Business and sustainability can go hand-in-hand. Our unique strategy interweaves business goals with environmental sustainability and social responsibility, producing mutually beneficial results. </td>
											</tr>
											<tr>
												<td>We, social entrepreneurs, are working with industry-leading technologies and also making it viable to all forms of consumer. We are making Solar not only economically viable but also take care of its sustainability to make your savings to the maximum. </td>
											</tr>
											<tr>
												<td>We have people who are working in the industry for more than 8 years with the Industry leaders. We have a cumulative experience of more than 50 MW in all around the industry. Now it's time to make the solar more viable with our knowledge of the technology and economics of the Industry.</td>
											</tr>
											<tr>
												<td>Let's join our hands together for a better future for you and your family as well as our environment. </td>
											</tr>
										</tbody>

									</table>
									<table class="table table-bordered">
										<h3>2.Billing Of Materials</h3>
										<thead>
											<th>Sl No</th>
											<th>Material Name</th>
											<th>Supplier</th>
											<th>Qty</th>
											<th>Specification</th>
											<th>Price</th>
										</thead>
										<tbody>
											<?php $s = 1;
											foreach ($prodata as $key) {
												$pro = $key['pro'];
												$prodetails = explode(":", $pro);
												$pid = $prodetails[0];
												$q = $this->db->select()
													->where(['id' => $pid])
													->get('product');
												$product = $q->result_array();

												foreach ($product as  $value) {

													$subtotal = $value['price'] * $prodetails[1];
											?>
													<tr>
														<td><?php echo $s; ?></td>
														<td><?php echo $value['name']; ?></td>
														<td><?php echo $value['supplier']; ?></td>
														<td><?php echo $prodetails[1]; ?></td>
														<td><?php echo $value['spec']; ?> </td>
														<td><?php echo $subtotal; ?></td>
													</tr>
											<?php $s++;
												}
											}

											?>
										</tbody>

									</table>
									<!-- /.row -->
									<table class="table table-bordered">
										<h1>3. Project Economics</h1>
										<thead>
											<th>Sl No</th>
											<th>Description</th>
											<th>Quantity</th>
											<th>Rate</th>
											<th>Total</th>
										</thead>
										<tbody>
											<td>1</td>
											<td><?php echo $enq[0]['KW']; ?> KWp Solar Power Plant</td>
											<td><?php echo $enq[0]['quantity']; ?></td>
											<td><?php echo $commi; ?></td>
											<td><?php echo $commi * $enq[0]['quantity']; ?></td>
										</tbody>

									</table>
									<table class="table table-bordered">
										<h1>4. Tax</h1>
										<thead>
										</thead>
										<?php

										$seventy = ($commi * $enq[0]['quantity']) * (70 / 100);
										$three = ($commi * $enq[0]['quantity']) * (30 / 100);
										$gstfive = $seventy * (12 / 100);
										$gsteight = $three * (18 / 100);
										$AmountWithgst = $seventy + $gstfive;
										$Withgst = $three + $gsteight;
										$Net = $Withgst + $AmountWithgst;

										?>
										<tbody>
											<tr>
												<td>12% GST ON <br> 70% AMOUNT</td>
												<td><?php echo $seventy; ?></td>
												<td>GST 12% &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo "" . $gstfive; ?></td>
												<td>AMOUNT WITH 12% GST &nbsp;&nbsp;&nbsp;= &nbsp;&nbsp;&nbsp;<?php echo " " . $AmountWithgst; ?></td>
												<td rowspan="2"><?php echo $Net; ?></td>
											</tr>
											<tr>
												<td>18% GST ON <br> 30% AMOUNT</td>
												<td><?php echo $three; ?></td>
												<td>GST 18% &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo "" . $gsteight; ?></td>
												<td>AMOUNT WITH 18% GST &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo " " . $Withgst; ?></td>
											</tr>
										</tbody>

									</table>
									<table class="table table-bordered">
										<h1>5. Payment Term</h1>
										<thead>
										</thead>
										<?php
										$twenty = $Net * (20 / 100);
										$sixty = $Net * (60 / 100);
										$ten = $Net * (10 / 100);
										$remain = $Net * (10 / 100);

										?>
										<tbody>
											<tr>
												<td>20% upon Issuing PO&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo $twenty; ?></td>
												<td>60% before Dispatch &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo $sixty; ?></td>
												<td>10% Upon Delivery &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo "" . $ten; ?></td>
												<td>10% After Installation &nbsp;&nbsp;&nbsp;= &nbsp;&nbsp;&nbsp;<?php echo " " . $remain; ?></td>
											</tr>
										</tbody>

									</table>
								</div>


								<div class="row">
									<!-- accepted payments column -->

									<!-- /.col -->
								</div>
								<!-- /.row -->

								<!-- this row will not appear when printing -->
								<div class="row">
									<div class="col-12">
										<a href="<?php echo site_url('Admin/dashboard'); ?>" class="nav-link btn btn-success float-right">Dashboard</a>
									</div>
								</div>
							</div>
							<!-- /.invoice -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
	</section>

</body>

</html>