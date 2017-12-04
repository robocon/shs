<?php
   session_start();
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

require("connect.php");

$pdf = new PDF();

$pdf->SetThaiFont();

$pdf->SetMargins(10, 10);

$pdf->AddPage();

$pdf->SetFont('AngsanaNew', '', 14);

   Function calcage($birth){
      $today = getdate();   
      $nY  = $today['year']; 
      $nM = $today['mon'] ;
      $bY=substr($birth,0,4)-543;
      $bM=substr($birth,5,2);
      $ageY=$nY-$bY;
      $ageM=$nM-$bM;
       if ($ageM<0) {
           $ageY=$ageY-1;
           $ageM=12+$ageM;
                    }
      if ($ageM==0){
           $pAge="$ageY ��";
             }
      else{
            $pAge="$ageY �� $ageM ��͹";
                        }
      return $pAge;
          }


   $query = "Select report From patdata where row_id = '".$_GET["nRow_id"]."' ";
		 $result = mysql_query($query);
		 list($report) = Mysql_fetch_row($result);

	    $query = "SELECT * FROM opcard WHERE hn = '".$_GET["cHn"]."' ";
 	    $result = mysql_query($query)
	        or die("Query failed");
 
	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
  	      if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	        }

    	    if(!($row = mysql_fetch_object($result)))
    	        continue;
    	     }
       	   If ($result){
  	       $sHn=$row->hn;
  	       $cYot = $row->yot;
            $cName = $row->name;
   	       $cSurname = $row->surname;
   	       $sPtname=$row->yot.' '.$row->name.' '.$row->surname;
   	       $sPtright = $row->ptright;
		   $cAge=$row->dbirth;
		   $cAddress=$row->address;
		   $cMuang="�. $row->tambol  �. $row->ampur  �. $row->changwat" ; 
		   $sAge=calcage($cAge);
			
			if (!empty($cAn)){
	        	//print "AN $sAn &nbsp;&nbsp;";
				$cAn = "AN ".$cAn;
			}

			if (!empty($sPtright)){
			//	print "�Է�ԡ���ѡ��: $sPtright<br>";
				$sPtright = "�Է�ԡ���ѡ��: ".$sPtright;
			}

			$line1 = "HN $sHn  $sAn  $sPtname  ����: $sAge ";
			$line2 = "$sPtright";
			$line3 = "ᾷ��: $cDoctor";
			$line4 = "��õ�Ǩ: $cDetail";
			$line5 = "�ѹ����Ǩ: $sDate";
			$line6 = "��ҹ��:-";
			$line7 = $report;
			
			$pdf->Cell(0,9,$line1,0,0);
			$pdf->Ln();
			$pdf->Cell(0,9,$line2,0,0);
			$pdf->Ln();
			$pdf->Cell(0,9,$line3,0,0);
			$pdf->Ln();
			$pdf->Cell(0,9,$line4,0,0);
			$pdf->Ln();
			$pdf->Cell(0,9,$line5,0,0);
			$pdf->Ln();
			$pdf->Cell(0,9,$line6,0,0);
			$pdf->Ln();
			$pdf->MultiCell( 180  , 6 , $line7,0 );

			//$pdf->Cell(0,9,$line7,0,0);
			$pdf->Ln();
			$pdf->Output();
           //print "<font style=\"font-family:AngsanaUPC; font-size:20px;\">HN $sHn&nbsp;&nbsp;";
	       //if (!empty($cAn)){
	        //	print "AN $sAn &nbsp;&nbsp;";
			//}
	       //print "$sPtname&nbsp;&nbsp;";
	       //print "����: $sAge <br>";
	      // if (!empty($sPtright)){
			//	print "�Է�ԡ���ѡ��: $sPtright<br>";
			//}
	       //print "�������:$cAddress $cMuang<br>";
	       //print "ᾷ��: $cDoctor<br>";
           //print "��õ�Ǩ: $cDetail<br>";
	       //print "�ѹ����Ǩ: $sDate<br>";
	       //print "��ҹ��:-<br>";
	//     print "$cReport";
			//$report = nl2br(htmlspecialchars($report));
	       //print $report."</font>";
         	   	       }  
 	  else {
  	       //echo "��辺 HN : $hn ";
		   $pdf->Cell(0,7,"��辺 HN : $hn ",0,0,'C');
  	         }    
	    	       

require("unconnect.php");

?>

