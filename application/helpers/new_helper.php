<?php defined('BASEPATH') OR exit('No direct script access allowed');
// generate pdf
function generate_pdf($name, $tpl,$data)
{
     $ci = &get_instance();
    $data['data'] = $data;
    $ci->load->view($tpl, $data);
    // Get output html
    $html = $ci->output->get_output();
    $ci->dompdf->loadHtml($html);
    // setup size
    $ci->dompdf->setPaper('A4', 'portrait');
    // Render the HTML as PDF
    $ci->dompdf->render();
    // Output  PDF (1 = download and 0 = preview)
    $ci->dompdf->stream($name, array("Attachment" => 0));
}
?>