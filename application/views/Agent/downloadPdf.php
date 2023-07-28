<?php
$this->load->library('session');
include 'header.php';
$jpg = file_get_contents(base_url() . "/dist/img/this.jpg");
$jpgbase64 = base64_encode($jpg);
?>
<style type="">
  .pagebreak
  {
    page-break-before: always;
  }
</style>
<div style="width: 650px;margin:auto; background-color: #fff;border:solid 1px #716f6f;padding: 20px 20px;">
  <table>
    <tbody>
      <tr>
        <td>
          <img src='data:image;base64,<?= $jpgbase64; ?>' width="650px" height="400px">

        </td>
      </tr>
    </tbody>
  </table>
  <h1 style="text-align: center;font-weight: 900px;font-size: 40px;">Ever Green Solar</h1>
  <table style="width: 100%;text-align: center; margin-bottom:10px;">
    <tbody>
      <tr>
        <td style="text-align: left;padding-left: 20px;padding-right: 20px;padding-top: 20px;padding-bottom: 10px;border: 1px solid #000000;"><b>Company Address :-<br> 81/75, N.C.C ROAD,<br> BANIPUR ,HABRA, NORTH 24 PGS</b></td>
        <td style="text-align: left;padding-left: 20px;padding-right: 20px;padding-top: 20px;padding-bottom: 10px;border: 1px solid #000000;"><b>GST NO:- 19ESRPK1175D1ZG</b></td>
      </tr>
      <tr>
        <td style="text-align: left;padding-left: 20px;padding-right: 20px; font-weight: 600px;border: 1px solid #000000;"><b>To</b></td>
        <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b>Quotation No:-<?php echo $quotation['quotationId']; ?></b></td>
      </tr>

      <tr>
        <td style="text-align: left;padding-left: 20px;padding-right: 20px;border: 1px solid #000000;"><b><span style="color: #03D53C;font-weight: 800px;font-size: 20px;"><?php echo $quotation['EnquiryData']['cName']; ?></span><br><?php echo $quotation['EnquiryData']['phone']; ?><br><?php echo $quotation['EnquiryData']['email']; ?><br><?php echo $quotation['EnquiryData']['Gst']; ?></b></td>
        <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b>Date:<?php echo date('d-M-y'); ?></b></td>

      </tr>

      <tr>
        <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b>Bill To</b></td>
        <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b>Ship To</b></td>
      </tr>

      <tr>
        <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b><?php echo $quotation['EnquiryData']['billAddress1']; ?><br><?php echo $quotation['EnquiryData']['billAddress2']; ?><br><?php echo $quotation['EnquiryData']['billstate']; ?><br><?php echo $quotation['EnquiryData']['billPin']; ?></b></td>
        <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b><?php echo $quotation['EnquiryData']['shipAddress1']; ?><br><?php echo $quotation['EnquiryData']['shipAddress2'] ?> <br><?php echo $quotation['EnquiryData']['shipState']; ?><br><?php echo $quotation['EnquiryData']['shipPin']; ?></b></td>

      </tr>

    </tbody>
  </table>
  <table style="margin-left: 150px; width: 80%;text-align: center; margin-bottom:15px;">
    <tbody>
      <tr>
        <td style="text-align: center;border-radius: 5px;border: 2px solid #FF5733;font-size: 15px;line-height: 50px;color:#60C363;"><b> <?php echo  $quotation['EnquiryData']['KW'] . $quotation['EnquiryData']['unit']; ?> Solar Plant <?php echo $quotation['EnquiryData']['Grid']; ?> System<br><span style="padding-top: 10px;color: #020790;font-size: 20px;"><b>TECHNO-COMMERCIAL PROPOSAL</b></span>
          </b></td>
      </tr>
    </tbody>
  </table>
</div>
<div style="width: 650px;margin:auto;border-top:solid 1px #716f6f; background-color: #fff;border:solid 1px #716f6f;padding: 20px 20px;" class="pagebreak">

  <h1 style="background-color: #ffffff;padding: 5px 5px; font-size: 25px;color: #075784;">1. Company Profile</h1>
  <table style="width: 100%;text-align:left;margin-bottom:100px;">
    <tbody>
      <tr>
        <td style="background-color: #ffffff;padding: 11px 10px; font-size: 18px;">“I feel more confident than ever that the power to save the planet rests with the individual consumer.” <br><strong>– Denis Hayes</strong></td>
      </tr>
      <tr>
        <td style="background-color: #ffffff;padding: 11px 10px; font-size: 18px;">“The only way forward, if we are going to improve the quality of the environment, is to get everybody involved.” <br><strong>– Richard Rogers</strong></td>
      </tr>
      <tr>
        <td style="background-color: #ffffff;padding: 11px 10px; font-size: 18px;">“The sun is the only safe nuclear reactor, situated as it is some ninety-three million miles away.”<br><strong>– Stephanie Mills</strong></td>
      </tr>
      <tr>
        <td style="background-color: #ffffff;padding: 11px 10px; font-size: 18px;">“Convergence between economy, ecology and energy should define our future.”<br><strong>– PM Modi</strong></td>
      </tr>

      <tr>
        <td style="background-color: #ffffff;padding: 11px 10px; font-size: 18px;">At Everenergy, we look forward to these days where we, every people in this mother earth would be able to contribute to nature by producing its own energy. Solar is the easiest way to achieve our dream of a sustainable green future. We help to achieve this by making Solar more economically viable to each and every person.</td>
      </tr>
      <tr>
        <td style="background-color: #ffffff;padding: 11px 10px; font-size: 18px;">Business and sustainability can go hand-in-hand. Our unique strategy interweaves business goals with environmental sustainability and social responsibility, producing mutually beneficial results. </td>
      </tr>
      <tr>
        <td style="background-color: #ffffff;padding: 11px 10px; font-size: 18px;">We, social entrepreneurs, are working with industry-leading technologies and also making it viable to all forms of consumer. We are making Solar not only economically viable but also take care of its sustainability to make your savings to the maximum. </td>
      </tr>
      <tr>
        <td style="background-color: #ffffff;padding: 11px 10px; font-size: 18px;">We have people who are working in the industry for more than 8 years with the Industry leaders. We have a cumulative experience of more than 50 MW in all around the industry. Now its time to make the solar more viable with our knowledge of the technology and economics of the Industry.</td>
      </tr>
      <tr>
        <td style="background-color: #ffffff;padding: 11px 10px; font-size: 18px;">Lets join our hands together for a better future for you and your family as well as our environment. </td>
      </tr>
    </tbody>
  </table>
</div>
<div style="width: 650px;margin:auto; background-color: #fff;border:solid 1px #716f6f;padding: 20px 20px;">
  <h1 style="background-color: #ffffff;padding: 5px 5px; font-size: 30px;color: #075784;">2. Bills Of Materials</h1>
  <table style="width: 500px;text-align:left;">
    <tbody>
      <tr style="background-color: #075784; border-top: 2px solid #080807;">
        <td style="border:1px solid #075784; line-height:1.42857143; text-align: center; font-size: 12px; width: 10px;color: #fff;">Sl No</td>
        <td style="border:1px solid #075784; line-height:1.42857143; text-align: center; font-size: 12px; width: 10px;color: #fff;">Material Name</td>
        <td style="border:1px solid #075784; line-height:1.42857143; text-align: center; font-size: 12px; width: 20px;color: #fff;">Supplier</td>
        <td style="border:1px solid #075784; line-height:1.42857143; text-align: center; font-size: 12px; width: 15px;color: #fff;">Qty</td>
        <td style="border:1px solid #075784; line-height:1.42857143; text-align: center; font-size: 12px; width: 20px;color: #fff;">UOM</td>
        <td style="border:1px solid #075784; line-height:1.42857143; text-align: center; font-size: 12px; width: 15px;color: #fff;">Specification</td>
      </tr>


      <?php
      $p = 1;
      foreach ($quotation['productData'] as  $value) {
      ?>
        <tr style="background-color: #F4DA8A;">
          <td style="border:1px solid #000; text-align: left; font-size: 12px;    vertical-align: top;height: 5px;"><b><?php echo $p; ?></b></td>
          <td style="border:1px solid #080807; text-align: left; font-size: 12px;    vertical-align: top;height: 5px;"><b><?php echo  $value['name']; ?></b></td>
          <td style="border:1px solid #080807; text-align: left; font-size: 12px;    vertical-align: top;height: 5px;"><b><?php echo $value['supplier']; ?></b></td>
          <td style="border:1px solid #080807; text-align: left; font-size: 12px;    vertical-align: top;height: 5px;"><b><?php echo $value['quantity']; ?></b></td>
          <td style="border:1px solid #080807; text-align: left; font-size: 12px;    vertical-align: top;height: 5px;"><b><?php echo $value['uom']; ?></b></td>
          <td style="border:1px solid #080807; text-align: left; font-size: 12px;    vertical-align: top;height: 5px;"><b><?php echo $value['spec']; ?></b></td>
        </tr>';

      <?php $p = $p + 1;
      } ?>
    </tbody>

  </table>
</div>
<div style="width: 650px;margin:auto; background-color: #fff;border:solid 1px #716f6f;padding: 20px 20px;" class="pagebreak">
  <h1 style="background-color: #ffffff;padding: 11px 10px; font-size: 25px;color: #075784;">3. Project Economics</h1>
  <table style="width: 90%;text-align:left; margin-bottom: 20px;">
    <tbody>
      <tr style="background-color: #075784; border-top: 2px solid #080807;">
        <td style="border:1px solid #075784; line-height:1.2; text-align: center; font-size: 12px; width: 20px;color: #fff;">Sl No</td>
        <td style="border:1px solid #075784; line-height:1.2; text-align: center; font-size: 12px; width: 10px;color: #fff;">Description</td>
        <td style="border:1px solid #075784; line-height:1.2; text-align: center; font-size: 12px; width: 20px;color: #fff;">Quantity</td>
        <td style="width:50px;border:1px solid #075784; line-height:1.2; text-align: center; font-size: 12px; width: 20px;color: #fff;">Unit Price (without GST)</td>
        <td style="border:1px solid #075784; line-height:1.2; text-align: center; font-size: 12px; width: 20px;color: #fff;">Total (without GST)</td>
      </tr>
      <tr>
        <td style="border:1px solid #000; text-align: left; font-size: 12px;vertical-align: top;height:20px;"><b>1</b></td>
        <td style="border:1px solid #080807; text-align: left; font-size: 12px;vertical-align: top;height: 20px;"><b><?php echo  $quotation['EnquiryData']['KW'] . $quotation['EnquiryData']['unit']; ?> Solar Plant <?php echo $quotation['EnquiryData']['Grid']; ?> System</b></td>
        <td style="border:1px solid #080807;; text-align: left; font-size: 12px;vertical-align: top;height: 20px;"><b><?php echo  $quotation['EnquiryData']['quantity']; ?></b></td>
        <td style="border:1px solid #080807; text-align: left; font-size: 12px;vertical-align: top;height: 20px;"><b><?php echo  $quotation['commission']; ?></b></td>
        <td style="border:1px solid #080807; text-align: left; font-size: 12px;vertical-align: top;height: 40px;"><b><?php echo $quotation['commission'] *  $quotation['quantity']; ?></b></td>
      </tr>

    </tbody>

  </table>
  <h1 style="background-color: #ffffff;padding: 11px 10px; font-size: 25px;color: #075784;">4. Tax</h1>
  <table style="width: 100%;text-align:left;" border="1px">
    <?php
    $netAmount = 0;
    if (!empty($quotation['referenceEnquiry'])) {
      $commissionAmount =  $quotation['referenceEnquiry']['commissionAmount'];
      $netAmount = $commissionAmount + $quotation['commission'] *  $quotation['quantity'];
    } else {
      $netAmount = $quotation['commission'] *  $quotation['quantity'];
    }

    $grid = $quotation['EnquiryData']['Grid'];
    if ($grid == 'PUMP' || $grid == 'SOLAR WATER HEATER' || $grid == 'DEFAULT' || $grid == 'STREET LIGHT') { ?>
      <thead>
      </thead>
      <?php
      $gstfive = $netAmount * (12 / 100);
      $Net = $netAmount + $gstfive;
      ?>
      <tbody>
        <tr>
          <td>12% GST ON <br> TOTAL AMOUNT</td>
          <td>GST 12% &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo "" . number_format($gstfive, 2); ?></td>
          <td>AMOUNT WITH 12% GST &nbsp;&nbsp;&nbsp;= &nbsp;&nbsp;&nbsp;<?php echo " " . number_format($Net, 2); ?></td>
        </tr>
      </tbody>

  </table>

<?php } else {

?>


  <thead>
  </thead>
  <?php
      $seventy = $netAmount * (70 / 100);
      $three = $netAmount * (30 / 100);
      $gstfive = $seventy * (12 / 100);
      $gsteight = $three * (18 / 100);
      $AmountWithgst = $seventy + $gstfive;
      $Withgst = $three + $gsteight;
      $Net = $Withgst + $AmountWithgst;

  ?>
  <tbody>
    <tr>
      <td>12% GST ON <br> 70% AMOUNT</td>
      <td><?php echo number_format($seventy, 2); ?></td>
      <td>GST 12% &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo "" . number_format($gstfive, 2); ?></td>
      <td>AMOUNT WITH 12% GST &nbsp;&nbsp;&nbsp;= &nbsp;&nbsp;&nbsp;<?php echo " " . number_format($AmountWithgst, 2); ?></td>
      <td rowspan="2"><?php echo number_format($Net, 2); ?></td>
    </tr>
    <tr>
      <td>18% GST ON <br> 30% AMOUNT</td>
      <td><?php echo $three; ?></td>
      <td>GST 18% &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo "" . number_format($gsteight, 2); ?></td>
      <td>AMOUNT WITH 18% GST &nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;<?php echo " " . number_format($Withgst, 2); ?></td>
    </tr>
  </tbody>

  </table>
<?php } ?>
<h1 style="background-color: #ffffff;padding: 11px 10px; font-size: 25px;color: #075784;">5. Payment Terms</h1>
<table style="width: 100%;text-align:left; " border="2px">
  <tbody>
    <tr>
      <?php
      foreach ($quotation['paymentTermData'] as  $value) { ?>
        <td style="border:1px solid #080807; text-align: left; font-size: 13px;    vertical-align: top;height: 40px;"><?= $value['percent'] . '% ' . $value['description']  ?> = <?php echo $value['Amount']; ?></td>
      <?php }
      ?>


    </tr>
  </tbody>

</table>
<!-- /.col -->
<table style="width: 100%;text-align:left; margin-bottom: 10px;">

  <thead>

  </thead>
  <tbody>
    <tr>
      <td>
        <h1 style="background-color: #ffffff;padding: 11px 10px; font-size: 25px;color: #075784;">6. Term & Conditions</h1>
      </td>
    </tr>
    <tr>
      <?= $quotation['termAndCondition']; ?>
    </tr>

  </tbody>

</table>

</div>