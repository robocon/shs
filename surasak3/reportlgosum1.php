<?php
session_start();
include("connect.inc");
$_POST["start_year"]="$start_year";
$_POST["start_month"]="$start_month";
$_POST["start_day"]="$start_day";
$_POST["end_year"]="$end_year";
$_POST["end_month"]="$end_month";
$_POST["end_day"]="$end_day";
//$yrmonth="$thiyr-$rptmo-$date";
//$date1 ="$thiyr-$rptmo-$date";
//$date2 ="$date-$rptmo-$thiyr";
//$date1 ="$start_year-$start_month";
//$date3 ="$start_month-$start_year";
$sql = "Select  a.depart, sum(a.paidcscd),sum(a.price) From opacc as a where  ( a.date between '".($start_year)."-".$start_month."-".$start_day." 00:00:00' AND '".($end_year)."-".$end_month."-".$end_day." 23:59:59' )  AND a.credit ='���µç ͻ�.' group by  a.depart   ORDER by a.date";
//echo $sql;

$result = mysql_Query($sql) or die(mysql_error());
 //$count =mysql_num_rows($result);
$list = array();
$list2 = array();


while(list( $depart, $paidcscd,$price) = Mysql_fetch_row($result)){
 

switch($depart){

	case "PHAR" : $list["PHAR"] = $list["PHAR"] + $paidcscd; break;
	case "PATHO" : $list["PATHO"] = $list["PATHO"] + $paidcscd; break;
	case "XRAY" : $list["XRAY"] = $list["XRAY"] + $price; break;
	case "DENTA" : $list["DENTA"] = $list["DENTA"] + $paidcscd; break;
	case "PHYSI" : $list["PHYSI"] = $list["PHYSI"] + $paidcscd; break;
	case "EMER" : $list["EMER"] = $list["EMER"] + $price; break;
	case "SURG" : $list["SURG"] = $list["SURG"] + $price; break;
	case "NID" : $list["NID"] = $list["NID"] + $paidcscd; break;
	case "HEMO" : $list["HEMO"] = $list["HEMO"] + $price; break;
		case "OTHER" : $list["OTHER"] = $list["OTHER"] + $paidcscd; break;
	default:  $list["OTHER2"] = $list["OTHER2"] + $paidcscd; break;

}

}
$num='0';
$i='0';
$p='1';


		$PHAR = $PHAR+$list["PHAR"];
		$PATHO = $PATHO+$list["PATHO"];
		$XRAY = $XRAY+$list["XRAY"];
		$DENTA = $DENTA+$list["DENTA"];
		$PHYSI = $PHYSI+$list["PHYSI"];
		$EMER = $EMER+$list["EMER"];
		$SURG = $SURG+$list["SURG"];
		$NID = $NID+$list["NID"];
		$HEMO = $HEMO+$list["HEMO"];
		$OTHER = $OTHER+$list["OTHER"];
		$OTHER2 = $OTHER2+$list["OTHER2"];

	$sum = $sum+($list["PHAR"]+$list["PATHO"]+$list["XRAY"]+$list["DENTA"]+$list["PHYSI"]+$list["EMER"]+$list["SURG"]+$list["NID"]+$list["HEMO"]+$list["OTHER"]+$list["OTHER2"]);



function baht($nArabic,$until){
    $cTarget = Ltrim($nArabic);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
   $cRtnum=substr($cTarget,$x+1,2);
   $nUnit=$x;
   $nNum=$nUnit;
   $cRead  = "";

include("connect.inc");
 
 IF ($cLtnum <> "0"){
  $count=0;
  For ($i = 0;$i<=$nNum;$i++){
    $cNo   = Substr($cLtnum,$count,1);
     $count++;
//��ҹ��ѡ
    IF ($cNo <>0 and $cNo != "-"){
      If ($nUnit <> 1){  

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$nUnit' limit 1";
          $result = mysql_query($query) or die("Query 1 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

        $cVarU = $row->fld4;  //��ҹ��ѡ
                }
      Else {
        $cVarU = "";
              }

//��ҹ�Ţ
          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' limit 1 ";
          $result = mysql_query($query) or die("Query 2 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

      $cVar1 = $row->fld2; //��ҹ����Ţ
///           
if ($nUnit =='2' && $cNo =='2'):
   $cVar1 = "���";
elseif ($nUnit == '2' && $cNo=='1'):
    $cVar1 =  "";
elseif ($nUnit =='1' && $cNo =='1' && $nNum <> 1 ):
    $cVar1 = "���";
else:
   echo "";
endif; 

      $cRead  = $cRead.$cVar1.$cVarU;
        }
      $nUnit--;
            }
if($until =="T")
	$cRead = $cRead."�ҷ";
	}
////Stang////  
  IF ($cRtnum <> "00"){
    $nUnit = 2;
    $count=0;
    For ($i = 0;$i<=2;$i++){  
      $cNo = Substr($cRtnum,$count,1);
      $count++;
      If ($cNo != "0"){

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' limit 1 ";
          $result = mysql_query($query) or die("Query failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

         $cVar1 = $row->fld2 ;
         /////
         If ($nUnit == '2' && $cNo == '2'){
            $cVar1 = "���";
            }
         if ($nUnit == '2' && $cNo == '1'){
            $cVar1 = "" ;
             }   
         if ($nUnit == '1' && $cNo =='1'){
              $cVar1 = "���";
            }            
         If (Substr($cRtnum,0,1) == '0' && $cNo == '1'){
            $cVar1 = "˹��";
            }
         ///////
         If ($nUnit != '1'){ 
           $cRead = $cRead.$cVar1."�Ժ";
                 }
         Else{
           $cRead = $cRead.$cVar1;
                }
      }   
         $nUnit--;
             }
	if($until =="T")
    $cRead = $cRead."ʵҧ��**"  ;
	}    
    else{
		if($until =="T")
           $cRead = $cRead."��ǹ**" ;
           }  
    include("connect.inc");

   return $cRead;
}
///end function baht

$PHAR=number_format( $PHAR,2);
$PATHO=number_format( $PATHO,2);
$XRAY=number_format($XRAY,2);
$DENTA=number_format( $DENTA,2);
$PHYSI=number_format( $PHYSI,2);
$EMER=number_format( $EMER,2);
$SURG=number_format( $SURG,2);
$NID=number_format($NID,2);
$HEMO=number_format($HEMO,2);
$OTHER=number_format($OTHER,2);
$OTHER2=number_format($OTHER2,2);
$sum=number_format($sum,2,".","");

if(strlen($sum) > 10){

	$cbaht="**�Ժ".baht(substr($sum,-10),"T");
}else{
	$cbaht="**".baht($sum,"T");
}
$sum=number_format($sum,2);


//$cbaht=$sum;



/*
echo "<tr><b><td>&nbsp;</td><td>&nbsp;</td><td><b><font face='Angsana New' size ='2'><center>���������</td><td>&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHAR."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PATHO."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$XRAY."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$DENTA."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHYSI."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$EMER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$SURG."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>".$NID."</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER2."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$sum."&nbsp;&nbsp;</td></b></tr></FONT>";

echo "</table>";


			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
			*/
echo "<font face='Angsana New' size ='5'><br><br><center> <b>��ػ�١˹����µç ͻ�.��Ш��ѹ��� ".$start_day."-".$start_month."-".($start_year)." 00:00:00 �֧  ".$end_day."-".$end_month."-".($end_year)." 23:59:59<br></b> ";
echo "<font face='Angsana New' size ='5'> �ç��Һ�Ť�������ѡ�������� �ӻҧ <br>";
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
echo "<font face='Angsana New' size ='4'> ��§ҹ������ѹ���  $Thaidate </center>";
//echo "<font face='Angsana New' size ='4'>�ӹǹ &nbsp;$count &nbsp;�� </center>";

echo "<table  border ='1'  align='center' bordercolor='#000000' cellspacing='0' cellpadding='0' style='BORDER-COLLAPSE: collapse'>";
echo "<tr><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;��͹&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;��&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;��Ҹ�&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;�͡����&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;�ѹ�����&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;����Ҿ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;��ԡ��&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;��ҵѴ&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;�ѧ���&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;�����&nbsp;&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b><center> <b>&nbsp;&nbsp;��Ǩ����&nbsp;&nbsp;</td><td><center><b>&nbsp;&nbsp;��&nbsp;&nbsp;</td><td><center> <b>&nbsp;&nbsp;���&nbsp;&nbsp;</td></tr>";

echo "<tr><td><b><font face='Angsana New' size ='3'>&nbsp;&nbsp;".$start_day."-".$start_month."-".($start_year)." &nbsp; �֧ &nbsp; ".$end_day."-".$end_month."-".($end_year)." &nbsp;&nbsp;</td><td><b><font face='Angsana New' size ='2'><center>���������</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHAR."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PATHO."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$XRAY."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$DENTA."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$PHYSI."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$EMER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$SURG."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$NID."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$HEMO."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$OTHER2."&nbsp;&nbsp;</td><td align='right'><font face='Angsana New' size ='3'><b>&nbsp;&nbsp;".$sum."&nbsp;&nbsp;</td></b></tr></FONT>";
echo "</table>";

print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='30%'> </td>";
print "      <td width='70%'><center><font face='Angsana New'>($cbaht)</font></td>";
print "    </tr>";
print "  </table>";
$sql = "Select yot,fullname,position,position2 From officers where mancode = 'headmonysub' limit 1";
$result2 = Mysql_Query($sql);
list($yot,$fullname,$position,$position2) = Mysql_fetch_row($result2);

print "<br>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='60%'></td>";
print "      <td width='40%'><font face='Angsana New'>$yot</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>(&nbsp;$fullname&nbsp;)</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>����Ǩ�ͺ</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>............./...................../................</font></td>";
print "    </tr>";
print "  </table>";
print "<br>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>..............................................</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>���ѹ�֡</font></td>";
print "    </tr>";
print "  </table>";
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='50%'></td>";
print "      <td width='50%'><center><font face='Angsana New'>............./...................../................</font></td>";
print "    </tr>";
print "  </table> <div style=\"page-break-before: always;\"></div>";


$list = array();
$title_date = $start_day."-".$start_month."-".$start_year;
$date1 ="$start_year-$start_month";

$sql = "SELECT DATE_FORMAT( a.date, '%d-%m-%Y' ) AS date2, a.depart, sum(a.paidcscd), sum(a.price),a.date 
FROM opacc AS a 
WHERE  ( 
	a.date >= '$start_year-$start_month-$start_day 00:00:00' 
	AND a.date <= '$end_year-$end_month-$end_day 23:59:59' 
	)  
AND a.credit ='���µç ͻ�.' 
GROUP BY date2, a.depart 
ORDER by date";
// echo "<pre>";
// 	var_dump($sql);
// 	echo "</pre>";
$result = Mysql_Query($sql) or die(Mysql_Error());

while(list($date, $depart, $paidcscd,$price, $date2) = Mysql_fetch_row($result)){
	
	/* Override $date ������ �����ջѭ���ѹ��� 29 ��͹ �.�. ��Ҩҡ date_format ���� null */
	list($dd2, $tt2) = explode(' ', $date2);
	list($y2, $m2, $d2) = explode('-', $dd2);
	$date = "$d2-$m2-$y2";
	// echo "<pre>";
	// var_dump($date);
	// echo "</pre>";
//echo $depart,"<BR>";

$row='0';
	switch($depart){
		case "PHAR" : $list[$date]['PHAR'] = $list[$date]['PHAR'] + $paidcscd; break;
		case "PATHO" : $list[$date]['PATHO'] = $list[$date]['PATHO'] + $paidcscd; break;
		case "XRAY" : $list[$date]['XRAY']  = $list[$date]['XRAY'] +$price; break;
		case "DENTA" : $list[$date]['DENTA'] = $list[$date]['DENTA'] + $paidcscd; break;
		case "PHYSI" : $list[$date]['PHYSI'] = $list[$date]['PHYSI'] + $paidcscd; break;
		case "EMER" : $list[$date]['EMER'] = $list[$date]['EMER'] + $price; break;
		case "SURG" : $list[$date]['SURG'] = $list[$date]['SURG'] + $price; break;
		case "NID" : $list[$date]['NID'] = $list[$date]['NID'] + $paidcscd; break;
		case "HEMO" : $list[$date]['HEMO'] = $list[$date]['HEMO'] + $price; break;
		case "OTHER" : $list[$date]['OTHER'] = $list[$date]['OTHER'] + $paidcscd; break;
		default:  $list[$date]['OTHER2'] = $list[$date]['OTHER2'] + $paidcscd; break;
	}
	
}

echo "<BR><CENTER>��������´�١˹���Ш��ѹ<BR>";
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
echo "<font face='Angsana New' size ='2'> ��§ҹ������ѹ���  $Thaidate </center></font>";
echo "<table width='90%' align='center' border ='1' bordercolor='#000000' cellspacing='0' cellpadding='0' style='BORDER-COLLAPSE: collapse'>
				<tr align='center'>
				<td>�ѹ���</td>
				<td>&nbsp;</td>
				<td>��</td>
				<td>��Ҹ�</td>
				<td>�͡����</td>
				<td>�ѹ�����</td>
				<td>����Ҿ</td>
				<td>��ԡ��</td>
				<td>��ҵѴ</td>
				<td>�ѧ���</td>
				<td>�����</td>
				<td>��Ǩ����</td>
				<td>��</td>
				<td>���</td>
				</tr>
					";
$sum = 0;

foreach($list as $key => $value){
$row++;
	echo "<tr align=\"right\">
					<td>".$key."</td>
					<td>�������ѹ</td>
					<td>".number_format($list[$key]['PHAR'],2)."</td>
					<td>".number_format($list[$key]['PATHO'],2)."</td>
					<td>".number_format($list[$key]['XRAY'],2)."</td>
					<td>".number_format($list[$key]['DENTA'],2)."</td>
					<td>".number_format($list[$key]['PHYSI'],2)."</td>
					<td>".number_format($list[$key]['EMER'],2)."</td>
					<td>".number_format($list[$key]['SURG'],2)."</td>
					<td>".number_format($list[$key]['NID'],2)."</td>
					<td>".number_format($list[$key]['HEMO'],2)."</td>
					<td>".number_format($list[$key]['OTHER'],2)."</td>
					<td>".number_format($list[$key]['OTHER2'],2)."</td>
					<td><B>".(number_format($list[$key]['PHAR']+$list[$key]['PATHO']+$list[$key]['XRAY']+$list[$key]['DENTA']+$list[$key]['PHYSI']+$list[$key]['EMER']+$list[$key]['SURG']+$list[$key]['NID']+$list[$key]['HEMO']+$list[$key]['OTHER']+$list[$key]['OTHER2'],2))."</B></td>
				</tr>";


if($row == '15'){
		echo "</table>";
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
echo "<BR><CENTER>��������´�١˹���Ш��ѹ<BR></font>";
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
echo "<font face='Angsana New' size ='2'> ��§ҹ������ѹ���  $Thaidate </center>";
echo "<table width='90%' align='center' border ='1' bordercolor='#000000' cellspacing='0' cellpadding='0' style='BORDER-COLLAPSE: collapse'>
				<tr align='center'>
				<td>�ѹ���</td>
				<td>&nbsp;</td>
				<td>��</td>
				<td>��Ҹ�</td>
				<td>�͡����</td>
				<td>�ѹ�����</td>
				<td>����Ҿ</td>
				<td>��ԡ��</td>
				<td>��ҵѴ</td>
				<td>�ѧ���</td>
				<td>�����</td>
				<td>��Ǩ����</td>
				<td>��</td>
				<td>���</td>
				</tr>
					";

			



}

$sum = $sum + ($list[$key]['PHAR']+$list[$key]['PATHO']+$list[$key]['XRAY']+$list[$key]['DENTA']+$list[$key]['PHYSI']+$list[$key]['EMER']+$list[$key]['SURG']+$list[$key]['NID']+$list[$key]['HEMO']+$list[$key]['OTHER']+$list[$key]['OTHER2']);
}

echo "<tr align=\"right\">
					<td colspan=\"13\" align='center'>���</td>
					<td><B>".(number_format($sum,2))."</B></td>
				</tr>";

echo "</table>";

