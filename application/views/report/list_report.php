<?php 
  ob_start();

  // Include the main TCPDF library (search for installation path).
  require_once(FCPATH.'/vendor/tecnickcom/tcpdf/tcpdf.php');

  global $items_header;
  $items_header=$items;


  class MYPDF extends TCPDF {

    //Page header
    public function Header() {

   	 global $items_header;

   	 


      $header = '<img src="'.base_url().'assets/images/SEARCA.png" height="40">
		 <div align="center"><b>List Report</b>
		 <br>
		 <font size="7">Document Management System</font><br/>
		 <font size="7"><b>Page '.($items_header['current_page']<=0?1:$items_header['current_page']).' of '.$items_header['pages'].' in list results</b></font>
		 </div>
		 <hr>';
      $this->writeHTML($header, true, false, true, false);


    }

    // Page footer
    public function Footer() {

        // Position at 15 mm from bottom
        $this->SetY(-20);
        // Set font
        $this->SetFont('helvetica', 'I', 8);

	$date = date('d F Y');

        // Page number
	$footer = '<table style="font-size:10px;">
		     <tr>
		       <td>DMS - Date: '.$date.'</td>
		       <td align="right">Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'</td>
		     </tr>
		     <tr>
		       <td colspan="2" align="center">List Report<br>SEAMEO SEARCA</td>
		     </tr>
		   </table>';

	$this->writeHTML($footer, true, false, true, false);
    }

  }

  // create new PDF document
  $custom_layout = array(210, 297); /*** A4 ***/
  $pdf = new MYPDF("L", 'mm', $custom_layout, true, 'UTF-8', false);

  // set document information
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('Information Technology Services Unit');
  $pdf->SetTitle('Report - Document Management System');
  $pdf->SetSubject('Report');
  $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

  // set header and footer fonts
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

  // set default monospaced font
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

  // set margins
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetHeaderMargin(15); /* PDF_MARGIN_HEADER; 10 */
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

  // set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+20, PDF_MARGIN_RIGHT);

  // set auto page breaks
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

  // set image scale factor
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

  // set some language-dependent strings (optional)
  if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
      require_once(dirname(__FILE__).'/lang/eng.php');
      $pdf->setLanguageArray($l);
  }

  // ---------------------------------------------------------

  // set font
  $pdf->SetFont('helvetica', '', 10);

  // add a page
  $pdf->AddPage();

$pdf->Sety(50);

  $sign = '<style>.table-bordered tr td,.table-bordered th{ border:1px solid #000;} </style>
  <table class="table table-striped table-bordered" style="padding:3px;font-size:11px;">
	<thead style="background: rgb(150,150,150); color: rgb(240,240,240);">
		<tr style="background-color:#ccc;" width="5%">
			<th width="10%" >Record Number</th>
			<th width="30%" class="header">Title</th>
			<th class="display-description  display-field header" width="40%">Desription</th>
			<th class="display-keywords  display-field header" width="20%">Keywords</th>
		</tr>
	</thead>

	<tbody>';

for($x=0;$x<count($items['data']); $x++){
	$sign.='	<tr>
			<td class="display-record_number  display-field" style="display: table-cell;" width="10%">'.$items['data'][$x]->id.'</td>
			<td class="display-description  display-field" style="display: table-cell;" width="30%">'.utf8_encode($items['data'][$x]->document_title).'</td>
			<td class="display-keywords  display-field" style="display: table-cell;" width="40%">'.nl2br(utf8_encode($items['data'][$x]->content_description)).'</td>
			<td class="display-files  display-field" style="display: table-cell;" width="20%">'.utf8_encode($items['data'][$x]->keywords).'</td>
			
		</tr>';
}

	$sign.='</tbody>
</table>';

  $pdf->writeHTML($sign, true, false, true, false);

  ob_end_clean();
  $pdf->Output('custom-report.pdf', 'I');

?>