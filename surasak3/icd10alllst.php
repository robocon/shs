<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<body onload="window.print();">
<?php
    
set_time_limit(30);
$yrmonth="$thiyr-$rptmo";

   function goup($xx){
		switch($xx){
			case "G1": $yy = "�"; break;
			case "G2": $yy = "�"; break;
			case "G3": $yy = "�"; break;
			case "G4": $yy = "�"; break;

case "G11": $yy = "�.1 ��·��û�Шӡ��"; break;
case "G12": $yy = "�.2 ����Ժ  �ŷ��û�Шӡ��"; break;
case "G13": $yy = "�.3 ����Ҫ��á����������͹"; break;
case "G14": $yy = "�.4 �١��ҧ��Ш�"; break;
case "G15 ": $yy = "�.5 �١��ҧ���Ǥ���"; break;
case "G21": $yy = "�.1 �Ժ��� �ŷ��áͧ��Шӡ��"; break;
case "G22": $yy = "�.2 �ѡ���¹����"; break;
case "G23 ": $yy = "�.3 ������Ѥ÷��þ�ҹ"; break;
case "G24 ": $yy = "�.4 �ѡ�ɷ���"; break;
case "G31": $yy = "�.1 ��ͺ���Ƿ���"; break;
case "G32": $yy = "�.2 ���ù͡��Шӡ��"; break;
case "G33": $yy = "�.3 �ѡ�֡���Ԫҷ���(ô)"; break;
case "G34": $yy = "�.4 ���Ѳ������ͧ"; break;
case "G35": $yy = "�.5 �ѵû�Сѹ�ѧ��"; break;
case "G36": $yy = "�.6 �ѵ÷ͧ30�ҷ"; break;
case "G37": $yy = "�.7 ����Ҫ��þ����͹(�ԡ���ѧ�Ѵ)"; break;
case "G38": $yy = "�.8 �����͹(����ԡ���ѧ�Ѵ)"; break;
case "G39": $yy = "�.9 ��������к�"; break;

		}
		return $yy;
   }

print "<font face='TH SarabunPSK'><b>��ª��ͼ����µ�� ICD10 </b>";
  
print "<b>��Ш���͹</b> $yrmonth <BR>";
 echo "<div id='no_print'>";  
 print "<br>.........<input type=button onclick='history.back()' value=' << ��Ѻ� '>";
  print "�ӹǹ���������� ICD 10  <a target=_self  href='../nindex.htm'><<�����</a><br> ";
 echo "</div>";
?>
<?php
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday_2 SELECT *, left(goup,3) as goup_2 FROM opday  WHERE thidate LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die(mysql_error());

	$query="CREATE TEMPORARY TABLE opday_3 SELECT icd10, goup_2, count(icd10) as c_icd10 FROM opday_2  group by icd10, goup_2 HAVING count(icd10) > 0";
    $result = mysql_query($query) or die(mysql_error());


 
   $query="SELECT  icd10,COUNT(*) AS duplicate FROM opday_2 GROUP BY icd10 HAVING duplicate > 0 ORDER BY duplicate DESC limit 30 ";
   $result = mysql_query($query);
     $n=0;
 while (list ($icd10,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>$n .&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>$icd10&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<BR>");
				$sql2 = "Select goup_2, c_icd10 From opday_3 where icd10 = '".$icd10."' ";
				$result2 = mysql_query($sql2);
				print "<TR><TD colspan='3'>";
					while(list($goup_2, $c_icd10) = mysql_fetch_row($result2)){
						print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".goup($goup_2)." = ".$c_icd10." <BR>";
					}
				print "</TD></TR><HR>";
               }
echo "<div id='no_print'>";
print "�ӹǹ�����·�����.... $num..��</a><br> ";

echo "</div>";
include("unconnect.inc");
?>