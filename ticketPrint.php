<?php
session_start();

if(isset($_SESSION['username'])){

	//koneksi terpusat
	include "config/koneksi.php";
	

	// get the HTML
    ob_start();
    include(dirname(__FILE__).'/bookingFinish.php');
    $content = ob_get_clean();

    // convert to PDF
    require_once(dirname(__FILE__).'./html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('L', 'A4', 'fr');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('exemple13.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
  

}else{
	session_destroy();
	header('Location:formRegistrasi.php?status=Silahkan Login');
}
?>