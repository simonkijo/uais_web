<?php 
	include('config/config.php');
	include('config/functions.php');
	include('header/headView.php');
	
	include("pdf/mpdf.php");

	if(isset($_GET['lmt']) && isset($_GET['tbl']) && isset($_GET['filename']) && isset($_GET['colname']) && isset($_GET['id'])){
		$lmt = $_GET['lmt'];
		$tbl = $_GET['tbl'];
		$filename = $_GET['filename'];
		$colname = $_GET['colname'];
		$id = $_GET['id'];
		
		$html = '<html><head>
					<title>'.$filename.'</title>
					<link rel="shortcut icon" type="image/ico" href="dist/img/ico.jpg">
				</head><body>';
		$html .= query($lmt,$tbl,$filename,$colname,$id).'</body></html>';
		
		$mpdf=new mPDF('utf-8','A4','','',20,5,10,10,5,10);  //mPDF('utf-8','A4-L','font-size','font-family',margin-left,margin-right,margin-top,margin-bottom,margin-header,margin-footer) units are in millimeter
		
		$mpdf->WriteHTML($html);
		$mpdf->Output($filename.'.pdf','I');
	}
?>