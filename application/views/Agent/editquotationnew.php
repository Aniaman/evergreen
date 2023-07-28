<?php
// echo '<pre>';
// print_r($enq);
// die;
include 'header.php';
$quono = $this->session->quono;
$grid = $enq[0]['Grid'];
$this->load->library('session');
$total = $this->cart->total();
$commi = $this->session->Commission;
$rate = $this->session->rate;
$netAmount = 0;
if (!empty($enq['referenceEnquiry'])) {
	$commissionAmount = ($commi * $enq[0]['quantity']) * ($enq['referenceEnquiry']['counterCommission'] / 100);
	$netAmount = $commissionAmount + ($commi * $enq[0]['quantity']);
	$this->session->set_userdata('referenceCommissionAmount', $commissionAmount);
} else {
	$netAmount = $commi * $enq[0]['quantity'];
}
if ($grid == 'PUMP' || $grid == 'SOLAR WATER HEATER' || $grid == 'DEFAULT' || $grid == 'STREET LIGHT') {
	$gstfive = $netAmount * (12 / 100);
	$Net = $netAmount + $gstfive;
} else {
	$seventy = $netAmount * (70 / 100);
	$three = $netAmount * (30 / 100);
	$gstfive = $seventy * (12 / 100);
	$gsteight = $three * (18 / 100);
	$AmountWithgst = $seventy + $gstfive;
	$Withgst = $three + $gsteight;
	$Net = $Withgst + $AmountWithgst;
}
?>
<script src="//cdn.ckeditor.com/4.10.0/full-all/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<!-- Content Header (Page header) -->

<div class="modal fade" id="modal-calculate">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Calculate ROI</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo form_open('Calculate-ROI'); ?>
				<div class="card-body">
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>1KW Electric Produce by System</label>
							<input type="text" class="form-control" name="electricProduce">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Cost of Electric Per unit</label>
							<input type="text" class="form-control" name="electricCost">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Total KW Required</label>
							<input type="text" class="form-control" value=" <?= $enq[0]['KW']; ?>" name="electricKW" readonly>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Project Cost</label>
							<input type="text" class="form-control" value=" <?= number_format($Net, 2); ?>" name="projectCost" readonly>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Calculate</button>
				</div>
				<?php echo form_close(); ?>

			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>
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
										<?php $this->load->helper('string');
										$val = random_string('numeric', 5);
										$quoId = "EGS/QUO/" . $val; ?>
									</thead>
									<tbody>
										<tr>
											<td width="60%"><strong>To</strong></td>
											<td width="20%"> <strong>Quotation No</strong> </td>
											<td width="20%"> <strong><?php echo $quono; ?></strong></td>
										</tr>
										<tr>
											<td width="60%"><strong><?php echo $enq[0]['cName']; ?><br> <?php echo $enq[0]['phone']; ?> <br><?php echo $enq[0]['email']; ?><br> <?php echo $enq[0]['Gst']; ?></strong></td>
											<td width="20%"> <strong>Date</strong><br> <strong>Expiry Date</strong></td>
											<td width="20%"> <strong><?php echo date('d-M-y') ?></strong><br><strong><?= $enq[0]['expiryDate'];  ?></strong></td>
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
								<?php  ?>
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
										<?php
										$s = 1;
										$this->load->library('cart');
										$data = $this->cart->contents();
										foreach ($data as $value) { ?>
											<tr>
												<td><?php echo $s; ?></td>
												<td><?php echo $value['name']; ?></td>
												<td><?php echo $value['supplier']; ?></td>
												<td><?php echo $value['qty']; ?></td>
												<td><?php echo $value['spec']; ?> </td>
												<td><?php echo $value['subtotal']; ?></td>
											</tr>
										<?php $s++;
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
										<td><?= $enq[0]['KW'] . $enq[0]['unit'] ?> Solar Plant <?= $enq[0]['Grid'] ?> System</td>
										<td><?= $enq[0]['quantity'] ?></td>
										<td><?php echo $commi; ?></td>
										<td><?php echo $commi * $enq[0]['quantity']; ?></td>
									</tbody>

								</table>
								<table class="table table-bordered">
									<?php
									if ($grid == 'PUMP' || $grid == 'SOLAR WATER HEATER' || $grid == 'DEFAULT' || $grid == 'STREET LIGHT') { ?>
										<h1>4. Tax</h1>
										<thead>
										</thead>
										<tbody>
											<tr>
												<td>12% GST ON <br> TOTAL AMOUNT</td>
												<td>GST 12% &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo "" . $gstfive; ?></td>
												<td>AMOUNT WITH 12% GST &nbsp;&nbsp;&nbsp;= &nbsp;&nbsp;&nbsp;<?php echo " " . number_format($Net); ?></td>
											</tr>
										</tbody>
								</table>
							<?php } else {	?>
								<h1>4. Tax</h1>
								<thead>
								</thead>
								<tbody>
									<tr>
										<td>12% GST ON <br> 70% AMOUNT</td>
										<td><?php echo $seventy; ?></td>
										<td>GST 12% &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo "" . number_format($gstfive, 2); ?></td>
										<td>AMOUNT WITH 12% GST &nbsp;&nbsp;&nbsp;= &nbsp;&nbsp;&nbsp;<?php echo " " . number_format($AmountWithgst, 2); ?></td>
										<td rowspan="2"><?php echo number_format($Net, 2); ?></td>
									</tr>
									<tr>
										<td>18% GST ON <br> 30% AMOUNT</td>
										<td><?php echo number_format($three, 2); ?></td>
										<td>GST 18% &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo "" . number_format($gsteight, 2); ?></td>
										<td>AMOUNT WITH 18% GST &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo " " . number_format($Withgst, 2); ?></td>
									</tr>
								</tbody>

								</table>
							<?php } ?>
							<table class="table table-bordered">
								<h1>5. Payment Term</h1>
								<thead>
								</thead>
								<tbody>
									<tr>
										<?php
										if (!empty($this->session->paymentTermData)) {
											foreach ($this->session->paymentTermData as  $value) {
												$percentAmount = $Net * ($value['paymentPercent'] / 100);
												$paymentTerm[] = array(
													'paymentPercent' => $value['paymentPercent'],
													'paymentTermDescription' => $value['paymentTermDescription'],
													'paymentAmount' => number_format($percentAmount, 2)
												);

										?>
												<td><?= $value['paymentPercent'] . '% ' . $value['paymentTermDescription']  ?>&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo number_format($percentAmount, 2); ?></td>
										<?php	}
										}
										$this->session->set_userdata('paymentTermAmount', $paymentTerm);
										?>
									</tr>
								</tbody>

							</table>
							</div>
							<h3>6. Terms and Condition</h3>
							<div class="row">
								<?= $enq[0]['termAndCondition']; ?>
							</div>
							<h3>6. Return of Investment : <span style="color:blue;"> <?php echo $this->session->roi ? number_format($this->session->roi, 2) . "Months" : "NA" ?></span> </h3>
							<?php echo form_open("Agent/editpdf") ?>
							<div class="row mt-5">
								<div class="col-sm-6">
									<div class="form-group">
										<?php
										$this->load->library('session');
										$terms = $this->session->termAndCondition;
										?>
										<label>Term and Condition</label>
										<select name="termAndCondition" id="" class="form-control">
											<option value="">Select terms</option>
											<?php
											foreach ($terms as $value) {
												for ($i = 0; $i < sizeof($value); $i++) { ?>
													<option value="<?= $value[$i]['description'] ?>"><?= $value[$i]['title'] ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Quotation Expiry Date</label>
										<input type="date" name="expiryDate" class="form-control">
									</div>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-sm-3">
									<div class="form-group">
										<?php echo form_submit(['class' => 'btn btn-block btn-primary', 'type' => 'submit', 'value' => 'Generate Pdf', 'target' => '_blank']); ?>
									</div>
								</div>
								<?= form_close(); ?>
								<div class="col-sm-3">
									<div class="form-group">
										<a href="<?php echo site_url('Agent/dashboard'); ?>" class="nav-link btn btn-block btn-primary">Dashboard</a>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<button class="btn btn-block btn-primary calculateRoi">Get ROI</button>
							</div>

						</div>
						<!-- /.invoice -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</section>
	</div>
</section>
<script>
	$(document).ready(function() {
		$('.calculateRoi').click(function() {
			$('#modal-calculate').modal({
				backdrop: 'static',
				keyboard: true,
				show: true
			});

		});
	});

	CKEDITOR.replace('message', {
		allowedContent: true,
		extraPlugins: 'wysiwygarea'
	});
</script>
<?php include 'footer.php' ?>