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

   	 $document_title=@strlen($items_header[0]->document_title)>100?@substr($items_header[0]->document_title, 0,100).'...':@$items_header[0]->document_title;


      $header = '<img src="'.base_url().'assets/images/SEARCA.png" height="40">
		 <div align="center"><b>'.$document_title.'</b>
		 <br>
		 <font size="7">Document Management System</font>
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
		       <td colspan="2" align="center">Item Report<br>SEAMEO SEARCA</td>
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

  #filter custom attributes
  if(isset($_GET['custom'])){

    $custom=strip_tags(htmlentities(htmlspecialchars($_GET['custom'])));
    $custom_array=explode(',', $custom);

    $filtered_array=array();

    $filtered_array[0]=new stdClass;

    for($x=0; $x<count($custom_array); $x++){
      if(!empty($custom_array[$x])){
        $filtered_array[0]->{$custom_array[$x]}=$items[0]->{$custom_array[$x]};
      }
    }


    $items=$filtered_array;


  }


  $sign = '<style>.table-bordered tr td,.table-bordered th{ border:1px solid #000;} </style>
          <div>';

          if(isset($items[0]->document_title)&&!empty($items[0]->document_title)){
                $sign.='<p><b>Title :</b> '.utf8_encode($items[0]->document_title).'</p>';
          }

          if(isset($items[0]->author)&&!empty($items[0]->author)){
                $sign.='<p><b>Author :</b> '.utf8_encode($items[0]->author).'</p>';
          }


          if(isset($items[0]->creator)&&!empty($items[0]->creator)){
                $sign.='<p><b>Creator :</b> '.utf8_encode($items[0]->creator).'</p>';
          }


          if(isset($items[0]->publisher)&&!empty($items[0]->publisher)){
                $sign.='<p><b>Publisher :</b> '.utf8_encode($items[0]->publisher).'</p>';
          }


          if(isset($items[0]->source_title)&&!empty($items[0]->source_title)){
                $sign.='<p><b>Source Title :</b> '.utf8_encode($items[0]->source_title).'</p>';
          }

          if(isset($items[0]->category)&&!empty($items[0]->category)){
                $sign.='<p><b>Category :</b> '.utf8_encode($items[0]->category).'</p>';
          }


          if(isset($items[0]->content_description)&&!empty($items[0]->content_description)){
                $sign.='<p><b>Description :</b> '.nl2br(utf8_encode($items[0]->content_description)).'</p>';
          }


          if(isset($items[0]->place)&&!empty($items[0]->place)){
                $sign.='<p><b>Place :</b> '.utf8_encode($items[0]->place).'</p>';
          }


          if(isset($items[0]->date_of_input)&&!empty($items[0]->date_of_input)){
                $sign.='<p><b>Date :</b> '.utf8_encode($items[0]->date_of_input).'</p>';
          }


          if(isset($items[0]->collation)&&!empty($items[0]->collation)){
                $sign.='<p><b>Collation :</b> '.utf8_encode($items[0]->collation).'</p>';
          }


          if(isset($items[0]->language)&&!empty($items[0]->language)){
                $sign.='<p><b>Language :</b> '.utf8_encode($items[0]->language).'</p>';
          }

          if(isset($items[0]->access_condition)&&!empty($items[0]->access_condition)){
                $sign.='<p><b>Access Condition :</b> '.utf8_encode($items[0]->access_condition).'</p>';
          }

          if(isset($items[0]->physical_condition)&&!empty($items[0]->physical_condition)){
                $sign.='<p><b>Physical Condition :</b> '.utf8_encode($items[0]->physical_condition).'</p>';
          }


          if(isset($items[0]->record_number)&&!empty($items[0]->record_number)){
                $sign.='<p><b>Record Group :</b> '.utf8_encode($items[0]->record_number).'</p>';
          }

          if(isset($items[0]->material)&&!empty($items[0]->material)){
                $sign.='<p><b>Material :</b> '.utf8_encode($items[0]->material).'</p>';
          }

          if(isset($items[0]->notes)&&!empty(trim(utf8_encode($items[0]->notes)))){
                $sign.='<p><b>Notes :</b> '.utf8_encode($items[0]->notes).'</p>';
          }

          if(isset($items[0]->keywords)&&!empty($items[0]->keywords)){
                $sign.='<p><b>Keywords :</b> '.utf8_encode($items[0]->keywords).'</p>';
          }

          if(isset($items[0]->provenance)&&!empty($items[0]->provenance)){
                $sign.='<p><b>Provenance :</b> '.utf8_encode($items[0]->provenance).'</p>';
          }


          if(isset($items[0]->remarks)&&!empty(trim(utf8_encode($items[0]->remarks)))){
                $sign.='<p><b>Remarks :</b> '.utf8_encode($items[0]->remarks).'</p>';
          }


          if(isset($items[0]->location)&&!empty($items[0]->location)){
                $sign.='<p><b>Location :</b> '.utf8_encode($items[0]->location).'</p>';
          }


          if(isset($items[0]->shelf_cabinet_number)&&!empty($items[0]->shelf_cabinet_number)){
                $sign.='<p><b>Shelf Cabinet Number :</b> '.utf8_encode($items[0]->shelf_cabinet_number).'</p>';
          }


          if(isset($items[0]->tier_number)&&!empty($items[0]->tier_number)){
                $sign.='<p><b>Tier Number :</b> '.utf8_encode($items[0]->tier_number).'</p>';
          }


          if(isset($items[0]->box_number)&&!empty($items[0]->box_number)){
                $sign.='<p><b>Box Number:</b> '.utf8_encode($items[0]->box_number).'</p>';
          }

          if(isset($items[0]->folder_number)&&!empty($items[0]->folder_number)){
                $sign.='<p><b>Folder Number :</b> '.utf8_encode($items[0]->folder_number).'</p>';
          }

          if(isset($items[0]->id)&&!empty($items[0]->id)){
                $sign.='<p><b>Record/Code Number :</b> '.utf8_encode($items[0]->id).'</p>';
          }


          if(isset($items[0]->date_range)&&!empty($items[0]->date_range)){
                $sign.='<p><b>Date Range :</b> '.utf8_encode($items[0]->date_range).'</p>';
          }

          if(isset($items[0]->quantity)&&!empty($items[0]->quantity)){
                $sign.='<p><b>Quantity :</b> '.utf8_encode($items[0]->quantity).'</p>';
          }

          if(isset($items[0]->encoded_by)&&!empty($items[0]->encoded_by)){
                $sign.='<p><b>Encoded By :</b> '.utf8_encode($items[0]->encoded_by).'</p>';
          }


  $sign.='</div>';

  $pdf->writeHTML($sign, true, false, true, false);

  ob_end_clean();
  $pdf->Output('custom-report.pdf', 'I');


?>