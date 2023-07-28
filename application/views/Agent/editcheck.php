<?php $this->load->library('session');
$commi = $this->session->Commission;
$rate = $this->session->rate;
$enqid = $this->session->enqid;
$dat = $this->session->dat;
$day = $this->session->day;
$quono = $this->session->quono;
$referenceCommissionAmount = $this->session->referenceCommissionAmount;
$grid = $enq[0]['Grid'];
$paymentDataAbc = explode(';', $this->session->paymentData);
foreach ($paymentDataAbc as  $value) {
    $payment[] = explode(':', $value);
}
foreach ($payment as  $value) {
    $paymentArray[] = array(
        'percent' =>  $value[0],
        'description' => $value[1],
        'Amount' => $value[2]
    );
}
?>
<?php include 'header.php';

$jpg = file_get_contents(base_url() . "dist/img/this.jpg");
$jpgbase64 = base64_encode($jpg);
?>
<style type="">
    .pagebreak{
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
                <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b>Quotation No:-<?php echo $quono; ?></b></td>
            </tr>

            <tr>
                <td style="text-align: left;padding-left: 20px;padding-right: 20px;border: 1px solid #000000;"><b><span style="color: #03D53C;font-weight: 800px;font-size: 20px;"><?php echo $enq[0]['cName']; ?></span><br><?php echo $enq[0]['phone']; ?><br><?php echo $enq[0]['email']; ?><br><?php echo $enq[0]['Gst']; ?></b></td>
                <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b>Date:<?php echo date('d-M-y'); ?></b><br><b>Expiry Date: <?= $this->session->expiryDate ?></b></td>

            </tr>

            <tr>
                <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b>Bill To</b></td>
                <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b>Ship To</b></td>
            </tr>

            <tr>
                <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b><?php echo $enq[0]['billAddress1']; ?><br><?php echo $enq[0]['billAddress2']; ?><br><?php echo $enq[0]['billstate']; ?><br><?php echo $enq[0]['billPin']; ?></b></td>
                <td style="text-align: left;padding-left: 20px;padding-right: 20px; ;font-weight: 600px;border: 1px solid #000000;"><b><?php echo $enq[0]['shipAddress1']; ?><br><?php echo $enq[0]['shipAddress2']; ?> <br><?php echo  $enq[0]['shipState']; ?><br><?php echo  $enq[0]['shipPin']; ?></b></td>

            </tr>

        </tbody>
    </table>
    <table style="margin-left: 150px; width: 80%;text-align: center; margin-bottom:15px;">
        <tbody>
            <tr>
                <td style="text-align: center;border-radius: 5px;border: 2px solid #FF5733;font-size: 15px;line-height: 50px;color:#60C363;"><b> <?php echo $enq[0]['KW']; ?> KWp Solar Plant <?php echo $enq[0]['Grid']; ?> System<br><span style="padding-top: 10px;color: #020790;font-size: 20px;"><b>TECHNO-COMMERCIAL PROPOSAL</b></span>
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
            $this->load->library('cart');
            $data = $this->cart->contents();
            $p = 1;
            foreach ($data as $id => $value) {

                $id = $value['id'];
                $q = $this->db->select()
                    ->where(['id' => $id])
                    ->get('product');
                $s = $q->result_array();
                $name = $s[0]['name'];
                $supplier = $s[0]['supplier'];
                $qty = $value['qty'];
                $uom = $s[0]['uom'];
                $spec = $s[0]['spec'];

            ?>
                <tr style="background-color: #F4DA8A;">
                    <td style="border:1px solid #000; text-align: left; font-size: 12px;    vertical-align: top;height: 5px;"><b><?php echo $p; ?></b></td>
                    <td style="border:1px solid #080807; text-align: left; font-size: 12px;    vertical-align: top;height: 10px;"><b><?php echo  $name; ?></b></td>
                    <td style="border:1px solid #080807; text-align: left; font-size: 12px;    vertical-align: top;height: 10px;"><b><?php echo $supplier; ?></b></td>
                    <td style="border:1px solid #080807; text-align: left; font-size: 12px;    vertical-align: top;height: 10px;"><b><?php echo $qty; ?></b></td>
                    <td style="border:1px solid #080807; text-align: left; font-size: 12px;    vertical-align: top;height: 10px;"><b><?php echo $uom; ?></b></td>
                    <td style="border:1px solid #080807; text-align: left; font-size: 12px;    vertical-align: top;height: 10px;"><b><?php echo $spec; ?></b></td>
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
                <td style="width:50px;border:1px solid #075784; line-height:1.2; text-align: center; font-size: 12px; width: 20px;color: #fff;">Rate</td>
                <td style="border:1px solid #075784; line-height:1.2; text-align: center; font-size: 12px; width: 20px;color: #fff;">Total</td>
            </tr>
            <tr>
                <td style="border:1px solid #000; text-align: left; font-size: 12px;vertical-align: top;height:20px;"><b>1</b></td>
                <td style="border:1px solid #080807; text-align: left; font-size: 12px;vertical-align: top;height: 20px;"><b><?php echo $enq[0]['KW']; ?> <?php echo $enq[0]['unit']; ?> Solar Power Plant<?php echo $enq[0]['Grid']; ?> System</b></td>
                <td style="border:1px solid #080807;; text-align: left; font-size: 12px;vertical-align: top;height: 20px;"><b><?php echo $enq[0]['quantity']; ?></b></td>
                <td style="border:1px solid #080807; text-align: left; font-size: 12px;vertical-align: top;height: 20px;"><b><?php echo number_format($commi, 2); ?></b></td>
                <td style="border:1px solid #080807; text-align: left; font-size: 12px;vertical-align: top;height: 40px;"><b><?php echo number_format(($commi * $enq[0]['quantity']), 2); ?></b></td>
            </tr>

        </tbody>

    </table>
    <h1 style="background-color: #ffffff;padding: 11px 10px; font-size: 25px;color: #075784;">4. Tax</h1>
    <table style="width: 100%;text-align:left;" border="1px">
        <?php
        $netAmount = 0;
        if ($referenceCommissionAmount > 0) {
            $netAmount = ($commi * $enq[0]['quantity']) + $referenceCommissionAmount;
        } else {
            $netAmount = ($commi * $enq[0]['quantity']);
        }
        if ($grid == 'PUMP' || $grid == 'SOLAR WATER HEATER' || $grid == 'DEFAULT' || $grid == 'STREET LIGHT') { ?>
            <thead>
            </thead>
            <?php

            $total = $this->cart->total();
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
            $total = $this->cart->total();
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
            <td><?php echo number_format($three, 2); ?></td>
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
            foreach ($paymentArray as  $value) { ?>
                <td style="border:1px solid #080807; text-align: left; font-size: 13px;    vertical-align: top;height: 40px;"><?= $value['percent'] . '% ' . $value['description']  ?> = <?php echo $value['Amount']; ?></td>
            <?php  }
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
            <td><?= $this->session->termAndCondition; ?></td>
        </tr>
    </tbody>

</table>
<div>
    <h1 style="background-color: #ffffff;padding: 11px 10px; font-size: 25px;color: #075784;">6. Return of Investment : <span style=" color:blue;"> <?php echo $this->session->roi ? number_format($this->session->roi, 2) : "NA" ?></span> </h1>
</div>

</div>