


<?php
session_start();
include("connect.inc");
//  $yrmonth="$thiyr-$rptmo-$date";
$date1 ="$thiyr-$rptmo-$date";
$date2 ="$date-$rptmo-$thiyr";
$sql = "Select a.date,a.txdate, a.hn, CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name, a.depart, sum(a.price),b.idcard,b.note,sum(a.paidcscd) From opacc as a, opcard as b  where a.hn=b.hn AND a.date like '".$date1."%'  AND a.credit ='���µç ͻ�.' group by a.hn, a.depart   ORDER by a.date";
//echo $sql;
$result = mysql_Query($sql) or die(mysql_error());


$list = array();
$list2 = array();

while(list($date,$txdate, $hn, $full_name, $depart, $price,$idcard,$note,$paidcscd) = Mysql_fetch_row($result)){

 $date=substr($date,0,10);
 $d=substr($date,8,2);
  $m=substr($date,4,4);
   $y=substr($date,0,4);

  $note=substr($note,0,25);

	$list2[$hn] = $d."".$m."".$y."/".$full_name."/".$idcard."/".$note;
switch($depart){

	case "PHAR" : $list[$hn]["PHAR"] = $list[$hn]["PHAR"] + $paidcscd; break;
	case "PATHO" : $list[$hn]["PATHO"] = $list[$hn]["PATHO"] + $paidcscd; break;
	case "XRAY" : $list[$hn]["XRAY"] = $list[$hn]["XRAY"] + $paidcscd; break;
	case "NID" : $list[$hn]["NID"] = $list[$hn]["NID"] + $paidcscd; break;
	case "PHYSI" : $list[$hn]["PHYSI"] = $list[$hn]["PHYSI"] + $paidcscd; break;
//case "EMER" : $list[$hn]["EMER"] = $list[$hn]["EMER"] + $price; break;
//case "SURG" : $list[$hn]["SURG"] = $list[$hn]["SURG"] + $price; break;
default:  $list[$hn]["OTHER"] = $list[$hn]["OTHER"] + $paidcscd; break;


}

}
$num='0';
$i='0';
echo "<font face='Angsana New' size ='4'><center> <b>�١˹����µç ͻ�.��Ш��ѹ��� $date2 <br></b> ";
echo "<font face='Angsana New' size ='3'> �ç��Һ�Ť�������ѡ�������� �ӻҧ </center>";
echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='2' style='BORDER-COLLAPSE: collapse' >";
echo "<tr>
<td>&nbsp;&nbsp;#&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='1'><center> <b>&nbsp;&nbsp;���� - ʡ��&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='1'><center> <b>&nbsp;&nbsp;hn&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='1'><center> <b>&nbsp;&nbsp;�ѵû�ЪҪ�&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;��¨�ҧ&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;��&nbsp;&nbsp;</td><td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;��Ҹ�&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;�͡����&nbsp;&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;����Ҿ&nbsp;&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;�ѧ���&nbsp;&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='1'><center> <b>&nbsp;&nbsp;��Ǩ����&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;���&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;ICD10&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='2'><center>&nbsp;&nbsp;ICD9&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;ICD10�ͧ&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;ᾷ��&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;�ѹ������Ѻ��ԡ��&nbsp;&nbsp;</td>
</tr>";
foreach ($list2 as $key => $value) {

	$xx = explode("/",$value);
	$num++;
$i++;



$OTHER1=$list[$key]["NID"]+$list[$key]["OTHER"];

if ($list[$key]["PHAR"] > 0 ){$list[$key]["PHAR1"]=number_format( $list[$key]["PHAR"],2);} else {
	};
if ($list[$key]["PATHO"] > 0 ){$list[$key]["PATHO1"]=number_format( $list[$key]["PATHO"],2);} else {
	};
if ($list[$key]["XRAY"] > 0 ){$list[$key]["XRAY1"]=number_format( $list[$key]["XRAY"],2);} else {
	};
if ($list[$key]["PHYSI"] > 0 ){$list[$key]["PHYSI1"]=number_format( $list[$key]["PHYSI"],2);} else {
	};
if ($list[$key]["EMER"] > 0 ){$list[$key]["EMER1"]=number_format( $list[$key]["EMER"],2);} else {
	};
if ($list[$key]["SURG"] > 0 ){$list[$key]["SURG1"]=number_format( $list[$key]["SURG"],2);} else {
	};	
if ($list[$key]["NID"] > 0 ){$list[$key]["NID1"]=number_format( $list[$key]["NID"],2);} else {
	};
if ($list[$key]["OTHER"] > 0 ){$list[$key]["OTHER1"]=number_format( $list[$key]["OTHER"],2);} else {
	};		

/*if ($OTHER1 > 0 ){$OTHER1=number_format( $OTHER1,2);} else {
	};*/


$total=$list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"] +$list[$key]["NID"]+$list[$key]["OTHER"];
$total=number_format($total,2);




 $sql = "SELECT icd10,icd9cm,icd101,doctor,thidate FROM opday WHERE  hn = '".$key."' and  thdatehn like '".$date2."%' ";

   list($icd10,$icd9cm,$icd101,$doctor,$thidate) = mysql_fetch_row(Mysql_Query($sql));

$opdate=explode(' ',$thidate);
$dateth=$opdate[0];
	$dateth1=explode('-',$dateth);
		$day=$dateth1[2].'-'.$dateth1[1].'-'.$dateth1[0];
$timeth=$opdate[1];

$datetime=$day.' '.$timeth;


    echo "<tr  >
	<td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$num."&nbsp;</td>
	<td><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$xx[1]."&nbsp;</b></td>
	<td><font face='Angsana New' size ='2'>&nbsp;&nbsp;".$key."&nbsp;</td>
	<td><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$xx[2]."&nbsp;</td>
	<td><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$xx[3]."&nbsp;</td>
	<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["PHAR1"]."</td>
	<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["PATHO1"]."</td>
	<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["XRAY1"]."</td>
	<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["PHYSI1"]."</td>
	<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["NID1"]."</td>	
	<td align='right'><font face='Angsana New' size ='2'>".$list[$key]["OTHER1"]."</td>
	<td align='right'><font face='Angsana New' size ='2'><b>&nbsp;&nbsp;".$total."&nbsp;</b></td>
	<td align='right'><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$icd10."&nbsp;</td>
	<td align='right'><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$icd9cm."&nbsp;</td>
	<td align='right'><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$icd101."&nbsp;</td>
	<td align='right'><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$doctor."&nbsp;</td>
	<td align='right'><font face='Angsana New' size ='1'>&nbsp;&nbsp;".$datetime."&nbsp;</td>
	</tr>";



	if($i == '20'){
			echo "</table>";
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");

echo "<font face='Angsana New' size ='4'><center> <b>�١˹����µç ͻ�.��Ш��ѹ��� $date2 <br></b> ";
echo "<font face='Angsana New' size ='3'> �ç��Һ�Ť�������ѡ�������� �ӻҧ </center>";

echo "<table  border ='1' bordercolor='#000000' cellspacing='0' cellpadding='2'  style='BORDER-COLLAPSE: collapse' >";



echo "<tr><td border-style:dashed>&nbsp;&nbsp;#&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;���� - ʡ��&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;hn&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;�ѵû�ЪҪ�&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;��¨�ҧ&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;��&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;��Ҹ�&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;�͡����&nbsp;&nbsp;&nbsp;</td>
<td><font face='Angsana New' size ='2'><center> <b>&nbsp;&nbsp;��Ǩ����&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;���&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;ICD10��ѡ&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;ICD9&nbsp;&nbsp;</td>
<td><center> <b>&nbsp;&nbsp;ICD10�ͧ&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;ᾷ��&nbsp;&nbsp;</td>
<td><center> <b><font face='Angsana New' size ='1'><center>&nbsp;&nbsp;�ѹ������Ѻ��ԡ��&nbsp;&nbsp;</td>
</tr>";
$i='0';


		}



	$PHAR = $PHAR+$list[$key]["PHAR"];
	$PATHO = $PATHO+$list[$key]["PATHO"];
	$XRAY = $XRAY+$list[$key]["XRAY"];
		$PHYSI = $PHYSI+$list[$key]["PHYSI"];	
		$EMER = $EMER+$list[$key]["EMER"];	
		$SURG = $SURG+$list[$key]["SURG"];
		$NID = $NID+$list[$key]["NID"];
		$OTHER = $OTHER+$list[$key]["OTHER"];
	//$OTHER1=$OTHER+$NID;
	$sum = $sum+($list[$key]["PHAR"]+$list[$key]["PATHO"]+$list[$key]["XRAY"]+$list[$key]["PHYSI"]+$list[$key]["EMER"]+$list[$key]["SURG"]+$list[$key]["NID"]+$list[$key]["OTHER"]);
}


$PHAR=number_format( $PHAR,2);
$PATHO=number_format( $PATHO,2);
$XRAY=number_format($XRAY,2);
$PHYSI=number_format($PHYSI,2);
$EMER=number_format($EMER,2);
$SURG=number_format($SURG,2);
$NID=number_format($NID,2);
$OTHER=number_format($OTHER,2);
//$OTHER1=number_format($OTHER1,2);

$sum=number_format($sum,2);

echo "<tr><b>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><b><font face='Angsana New' size ='2'><center>���</td>
<td align='right'><font face='Angsana New' size ='2'><b>".$PHAR."</td>
<td align='right'><font face='Angsana New' size ='2'><b>".$PATHO."</td>
<td align='right'><font face='Angsana New' size ='2'><b>".$XRAY."</td>
<td align='right'><font face='Angsana New' size ='2'><b>".$PHYSI."</td> 
<td align='right'><font face='Angsana New' size ='2'><b>".$NID."</td>
<td align='right'><font face='Angsana New' size ='2'><b>".$OTHER."</td>
<td align='right'><font face='Angsana New' size ='3'><b>&nbsp;".$sum."&nbsp;</td></b>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr></FONT>";

echo "</table>";



