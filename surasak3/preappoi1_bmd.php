<?php
session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
	session_register("cAge");
    session_register("cHn");  
    session_register("cPtname");
 	session_register("cptright");
 	session_register("cnote");
	session_register("cidguard");

//    $cHn="";

    include("connect.inc");   

function calcage($birth){
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

//$dbirth="$y-$m-$d"; ���ѹ�Դ� opcard= "$y-$m-$d" ���=$birth in function

// print "<p><b><font face='Angsana New'>�ç��Һ�Ť�������ѡ��������</font></b></p>";
if(isset($idguard)){
	$cPtname=$cYot.' '.$cName.' '.$cSurname;
    $cAge=$Age;
   	$cptright=$ptright;
 	$cnote=$note;
	$cidguard=$idguard;
	$cAge=calcage($cAge);
print "<p><font face='Angsana New' size = '5'>���� $cPtname  HN: $cHn ���� $cAge &nbsp;<B>�Է��:$cptright:$idguard</font></B></p>";
	$query5 = "select * from orderbmd where hn='$cHn' and date like '".(date("Y")+543)."-".date("m-d")."%' order by row_id desc";
	$rows5 = mysql_query($query5);
	$rep= mysql_fetch_array($rows5);
	$dt_doctor=$rep['doctor'];
	print "<font face='Angsana New' size = '5'>ᾷ�� : $dt_doctor</font>";
	if($dt_doctor==""){
		print "<p><font face='Angsana New' size='6' color='#FF0000' >��辺�����š����觵�Ǩ BMD �ѹ��� ��س����ᾷ����������ա����</font></B></p>";
	}
	print "<br><font face='Angsana New' size = '4'><strong>�˵ؼš����觵�Ǩ :</strong><br>";
	for($i=1;$i<=8;$i++){
		if($rep['sub'.$i]!=""){
			$s=0;
			$l=50;
			echo "-".$rep['sub'.$i]."<br>";
			if($rep['detail_sub'.$i]!=""){
				echo "&nbsp;�".$rep['detail_sub'.$i];
				if($rep['detail_sub'.$i.'1']!=""){
					echo "&nbsp;<u>".$rep['detail_sub'.$i.'1']."<u>";
				}
				echo "<br>";
			}
		}	
	}
	print "</font>";
}

function LastDay($m, $y) {
   for ($i=29; $i<=32; $i++) {
      if (checkdate($m, $i, $y) == 0) {
         return $i - 1;
      }
   }
}

if($_GET["action"] == "carlendar"){
/*	if($_GET['id']==""){
	}
	else{
	//$dt_doctor = $_GET['id'];
	//echo $dt_doctor ;
	}*/
	
	
//$sql = "Select mdcode From inputm where name = '".$_GET['id']."' limit 1";
//list($mdcode) = Mysql_fetch_row(Mysql_Query($sql));

/*$sql = "Select name From doctor where name like '".$dt_doctor."%' limit 1 ";
list($appoint_doctor) = Mysql_fetch_row(Mysql_Query($sql));*/


/*switch($_SESSION["dt_doctor"]){
	case '���кص� �ح�� (�.29265)': $appoint_doctor ="MD060  ���кص� �ح�"; Break;
	case '��Ѫ�� ���¨��� (�.20182)': $appoint_doctor ="MD014 ��Ѫ�� ���¨���"; Break;
	case '�ԾԸ ����ʡ�� (�.38220)': $appoint_doctor ="MD056  �ԾԸ  ����ʡ��"; Break;
	case '����ѷ� ��չ��� (�.29290)': $appoint_doctor ="MD048  ����ѷ� ��չ���"; Break;
	case '�ѹ�ҵ� �ӻ�����԰��� (�.24535)': $appoint_doctor ="MD047  �ѹ�ҵ� �ӻ�����԰���"; Break;
	case '�Ը��� �ح�� (�.28437)': $appoint_doctor ="MD053  �Ը���  �ح��"; Break;
	case '��Ծ��� ��շ��ѳ�� (�.10212)': $appoint_doctor ="MD037 ��Ծ���  ��շ��ѳ��"; break;
	case '侺���� ������ʧ (�.38222)': $appoint_doctor ="MD057  侺����  ������ʧ"; Break;
	case '����Թ ���๵� (�.21329)': $appoint_doctor ="MD016 ����Թ ���๵�"; Break;
	case '����Է��� ���ռ� (�.20278)': $appoint_doctor ="MD036 ����Է���  ���ռ�"; Break;
	case '����Թ��� ����չҤ (�.19921)': $appoint_doctor ="MD013 ����Թ��� ����չҤ"; Break;
	case '͹ؾ��� �ʹ��� (�.20186)': $appoint_doctor ="MD011 ͹ؾ��� �ʹ���"; Break;
	case '����� �����ѡ��� (�.19364)': $appoint_doctor ="MD009 ����� �����ѡ���"; Break;
	case '�ͧᴧ �Ҳ�оѹ�� (�.24512)': $appoint_doctor ="MD051  �ͧᴧ  �Ҳ�оѹ��"; Break;
	case '�ز��� ����� (�.14286)': $appoint_doctor ="MD052  �ز���  �����"; Break;
	case '���Է�� ǧ����� (�.27035)': $appoint_doctor ="MD041  ���Է�� ǧ�����"; Break;
	case '���͡  ��ҹ���ҧ  (�.12891)': $appoint_doctor ="MD006 ���͡ ��ҹ���ҧ"; Break;
	case '�ç�� ��մ�͹ѹ��آ (�.12456)': $appoint_doctor ="MD007 �ç�� ��մ�͹ѹ��آ"; Break;
	case '��ó� �����ѡ��� (�.16633)': $appoint_doctor ="MD008 ��ó� �����ѡ���"; Break;
	case '���๵����� ๵þԪԵ (�.28422)': $appoint_doctor ="MD059  ���๵����� ๵þԪԵ"; Break;
	case '���س�� �����ǧ�쾧�� (�.13553)': $appoint_doctor ="MD054  ���س��  �����ǧ�쾧��"; Break;
	case '��ɮ�쾧�� ��������ѡ��': $appoint_doctor ="MD061 ��ɮ�쾧�� ��������ѡ��"; Break;
	case '�ѳ��ѵ�� �ѹ������ͧ': $appoint_doctor ="MD062 �ѳ��ѵ�� �ѹ������ͧ"; Break;
	case '�Ѱ�� �������': $appoint_doctor ="MD063 �Ѱ�� �������"; Break;
	case '��ɴҡ� �Ƿ��¸Թ (�.37525)': $appoint_doctor ="MD050  ��ɴҡ� �Ƿ��¸Թ"; Break;
}*/

   /* $diffHour ��� $diffMinute ��͵���÷�����纨ӹǹ���������Шӹǹ�ҷշ��ᵡ��ҧ�ѹ�����ҧ����ͧ ���͹��Ѻ����ͧ��������� ����ӴѺ �蹶�����Ңͧ����ͧ����繵����ǡ������Ңͧ����ͧ��������� 11 ������� 15 �ҷ� ������˹� $diffHour �� 11 ��С�˹� $diffMinute �� 15 */
$diffHour = 0;
$diffMinute = 0;

if ($dfMonth == "") {
   /* �������ա���к�����ʴ���ԷԹ�ͧ��͹���͹˹�� ��Ҩ��ʴ���ԷԹ�ͧ��͹�Ѩ�غѹ������������ͧ����繵� ����ѧ���� getdate() ���ҧ�ѹ���/���һѨ�غѹ�ͧ����ͧ����繵������㹵���� $calTime ��觿ѧ���蹹��Ф׹��ҡ�Ѻ������������ */
   $calTime = getdate(date(mktime(date("H") + $diffHour,
   date("i") + $diffMinute)));
   $today = $calTime["mday"];     //�ѹ���
   $month = $calTime["mon"];      //��͹
   $year = $calTime["year"];        // ��
}
else {
   /* �óշ���к�����ʴ���ԷԹ�ͧ��͹/��˹��� ��� ���ա���觵���� $today,
$dfMonth ��� $dfYear ��ҹ�ҷҧ query string ���� */
   if ($dfMonth == 0) {
   /* ��ҵ���� $dfMonth �� 0 ��Ҩ��ʴ���ԷԹ�ͧ��͹�ѹ�Ҥ��ͧ�շ����¡��һշ����ѧ�ʴ����� */
       $dfMonth = 12;
       $dfYear = $dfYear - 1;
   }
   elseif ($dfMonth == 13) {
   /* ��ҵ���� $dfMonth �� 13 ��Ҩ��ʴ���ԷԹ�ͧ��͹���Ҥ��ͧ�շ���ҡ���һշ����ѧ�ʴ����� */
       $dfMonth = 1;
       $dfYear = $dfYear + 1;
   }

   //���ҧ�ѹ/���Ңͧ��͹��лշ�������к� �����㹵���� $calTime
   $calTime = getdate(date(mktime((date("H") + $diffHour),
      (date("i") + $diffMinute), 0, $dfMonth, $today, $dfYear)));
   $today = $calTime["mday"];      //�ѹ���
   $month = $calTime["mon"];       //��͹
   $year = $calTime["year"];         //��
}



/* ���¡�ѧ��ѹ LastDay() ����繿ѧ���蹷��������ҧ����ͧ ������"�ӹǹ�ѹ" �ͧ��͹��лշ����ʴ���ԷԹ �������㹵���� $Lday */
$Lday = LastDay($month, $year);
//�� timestamp �ͧ�ѹ��� 1 �ͧ��͹�����ʴ���ԷԹ ���㹵���� $FTime
$FTime = getdate(date(mktime(0, 0, 0, $month, 1, $year)));
//�� "�ѹ��ѻ����" (�ѹ���, �ѧ��� ���) �ͧ�ѹ��� 1 �ͧ��͹���㹵���� $wday
$wday = $FTime["wday"];

//���ҧ����ê�Դ���������纪�����͹������
$thmonthname = array("���Ҥ�", "����Ҿѹ��", "�չҤ�", "����¹", "����Ҥ�", "�Զع�¹", "�á�Ҥ�", "�ԧ�Ҥ�", "�ѹ��¹", "���Ҥ�", "��Ȩԡ�¹", "�ѹ�Ҥ�");

$sql = "Select appdate, apptime, count(distinct hn) as total_app From appoint  where appdate like '%".$thmonthname[$month - 1]." ".($year+543)."' AND detail = 'FU32 �Ѵ��ǨBMD' AND apptime <> '¡��ԡ��ùѴ' GROUP BY appdate, apptime  ";

$result = Mysql_Query($sql);
$list_app = array();
while($arr = Mysql_fetch_assoc($result)){
	
	$list_app["A".substr($arr["appdate"],0,2)]["detail"] .= " ".$arr["apptime"]." �ӹǹ ".$arr["total_app"]." ��<BR>";
	$list_app["A".substr($arr["appdate"],0,2)]["sum"] = $list_app["A".substr($arr["appdate"],0,2)]["sum"] + $arr["total_app"];


}

$sql = "Select date_format(date_holiday,'%d') as date_holiday2, detail From holiday where date_holiday like '".($year+543)."-".sprintf("%02d",$month)."%' ";


$result = Mysql_Query($sql);
while($arr = Mysql_fetch_assoc($result)){
	$holiday["A".$arr["date_holiday2"]]["date"] = true;
	$holiday["A".$arr["date_holiday2"]]["detail"] = $arr["detail"];

}

$long_time = $month+$year;
$month2 = date("m");
$year2 = date("Y");
$long_time2 = $month2 + $year2;


if($year == $year2){
	if(($long_time - $long_time2) >0 )
		$title_time = " (�Ѵ ".($long_time - $long_time2)." ��͹)";
}else{
		$title_time = " (�Ѵ ".(12 - date("m") + $month )." ��͹)";
}

echo "<TABLE>
<TR   valign=\"top\">
	<TD>";

	/*	$i=  count($_COOKIE);
		if($i > 1){

			foreach($_COOKIE as $key => $value){
				
				$xxx = explode(">",$value);
				$yyy = explode("<",$xxx[1]);
				$zzz = $yyy[0];
				
				$sql = "Select count(appdate) as c_app From appoint where appdate = '".$zzz."' AND doctor in ('".$_SESSION["dt_doctor"]."','".$appoint_doctor."') AND apptime <> '¡��ԡ��ùѴ'  ";

				$result = Mysql_Query($sql) or die(mysql_error());
				list($c_app) = Mysql_fetch_row($result);

				echo "",$value,"(".$c_app." ��)(1M)[X]<BR>";
				$i--;
				if($i==1)
					break;
			}
		}
*/
echo "	</TD>
</TD>
	<TD>";

if(!checkdate  ( $month - 1, $today  , $year  )){
	$today1 = "1";
}else{
	$today1 = $today;
}

if(!checkdate  ( $month + 1, $today  , $year  )){
	$today2 = "1";
}else{
	$today2 = $today;
}


echo "<table border=\"1\" bordercolor=\"black\" width=\"320\" height=\"270\">
<tr class=\"norm\"><td width=\"50\" align=\"center\">
<a href=\"javascript:void(0);\" Onclick=\"show_carlendar('&today=".$today1."&dfMonth=".($month - 1)."&dfYear=".$year."');\">&lt;</a>
</td>
<td width=\"250\" align=\"center\" colspan=\"5\" bgcolor=\"#F9F4DD\">
".$thmonthname[$month - 1]."&nbsp;
".($year + 543)." ".$title_time."
</td>
<td width=\"50\" align=\"center\">
<a href=\"javascript:void(0);\" Onclick=\"show_carlendar('&today=".$today2."&dfMonth=".($month + 1)."&dfYear=".$year."');\">&gt;</a>
</td></tr>

<tr><td width=\"50\" align=\"center\" class=\"sunday\">��</td>
<td width=\"50\" align=\"center\" class=\"norm\">�</td>
<td width=\"50\" align=\"center\" class=\"norm\">�</td>
<td width=\"50\" align=\"center\" class=\"norm\">�</td>
<td width=\"50\" align=\"center\" class=\"norm\">��</td>
<td width=\"50\" align=\"center\" class=\"norm\">�</td>
<td width=\"50\" align=\"center\" class=\"saturday\">�</td></tr><tr height=\"60\" valign=\"top\">";


$iday = 1;
//�ʴ����á�ͧ��ԷԹ
for ($i=0; $i<=6; $i++) {
	$holiday_detail = "";
   if ($i < $wday) {    //�ʴ�������ҧ��͹�ѹ��� 1 �ͧ��͹
      if ($i == 0) {       //�óշ�����ѹ�ҷԵ��
         echo "<td width=\"50\" align=\"center\" class=\"sunday\">&nbsp;</td>\n";
      }else if ($i == 6) {       //�óշ�����ѹ�����
         echo "<td width=\"50\" align=\"center\" class=\"saturday\">&nbsp;</td>\n";
      }
      else {              //�óշ�����ѹ���� ���������ѹ�ҷԵ��
         echo "<td width=\"50\" align=\"center\" class=\"norm\">&nbsp;</td>\n";
      }
   }
   else {                  //�ʴ��ѹ�������á�ͧ��ԷԹ
      if ($i == 0 ) {
      //�óշ�����ѹ�ҷԵ�� ���������ѹ�Ѩ�غѹ
         echo "<td width=\"50\" valign=\"top\" align=\"center\" class=\"sunday\"><A class=\"sunday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\">$iday</A>";
		 if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
			 echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
		 else
			 echo "<BR>&nbsp;";
		 echo "</td>\n";
      }else  if ($i == 6 ) {
      //�óշ�����ѹ�ҷԵ�� ���������ѹ�Ѩ�غѹ
         echo "<td width=\"50\" align=\"center\" class=\"saturday\"><A class=\"saturday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\">$iday</A>";
		  if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
			 echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsaturday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
		  else
			 echo "<BR>&nbsp;";
		 echo "</td>\n";
      }
      else {

		  if($holiday["A".sprintf("%02d",$iday)]["date"]){
			$class = "sunday";
			$holiday_detail = " OnmouseOver = \"show_tooltip('�ѹ��ش','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
		  }else{
			$class = "norm";
		  }



         echo "<td width=\"50\" align=\"center\" class=\"".$class."\"><A class=\"".$class."\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\"  ".$holiday_detail.">$iday</A>";
		  if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
			 echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appoint".$class."\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
		  else
			 echo "<BR>&nbsp;";
		 echo "</td>\n";

      }

      $iday++;

   }
}

//�ʴ��Ƿ������ͧ͢��ԷԹ (��ѧ�ҡ�ʴ����á����� ����������ҧ�ҡ 5 ��)
for ($j=0; $j<=4; $j++) {
   if ($iday <= $Lday) {
      echo "<tr  height=\"60\" valign=\"top\">\n";
		for ($i=0; $i<=6; $i++) {
			$holiday_detail = "";
			if ($iday <= $Lday) {
			if ($i == 0 ) {
				if($holiday["A".sprintf("%02d",$iday)]["date"]){
					$class = "sunday";
					$holiday_detail = " OnmouseOver = \"show_tooltip('�ѹ��ش','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
				  }else{
					$class = "norm";
				  }
				echo "<td width=\"50\" align=\"center\" class=\"sunday\"><A class=\"sunday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail.">$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-80,-150);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
						echo "</td>\n";
			}else  if ($i == 6 ) {
				if($holiday["A".sprintf("%02d",$iday)]["date"]){
					$class = "sunday";
					$holiday_detail = " OnmouseOver = \"show_tooltip('�ѹ��ش','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
				  }else{
					$class = "norm";
				  }
				echo "<td width=\"50\" align=\"center\" class=\"saturday\"><A class=\"saturday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail." >$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-80,-150);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsaturday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
				echo "</td>\n";
			}else {
				if($holiday["A".sprintf("%02d",$iday)]["date"]){
					$class = "sunday";
					$holiday_detail = " OnmouseOver = \"show_tooltip('�ѹ��ش','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
				  }else{
					$class = "norm";
				  }
				echo "<td width=\"50\" align=\"center\" class=\"".$class."\"><A class=\"".$class."\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail." >$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-80,-150);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appoint".$class."\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
				echo "</td>\n";
			}
		$iday++;
		}
		else {
		echo "<td width=\"50\" align=\"center\" class=\"norm\">&nbsp;</td>\n";
		}
      }
      echo "</tr>\n";
   }
   else {
      break;
   }
}

echo "</table></TD>
</TR>";
echo "<tr><td colspan=\"2\"><br><font face=\"Angsana New\">�Ѵ���ѹ��� : </font><INPUT TYPE=\"text\" ID=\"date_appoint\" NAME=\"date_appoint\" size=\"15\" readonly>";
echo "</td></tr></TABLE>";

exit();

}

?>

<SCRIPT LANGUAGE="JavaScript">
function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
	}
	
function show_carlendar(xxx){
	//alert(xxx);
	xmlhttp = newXmlHttp();
	
	url = 'preappoi1.php?action=carlendar&id=' + xxx;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_right_list").innerHTML = xmlhttp.responseText;

}
function checkForm(){
	
	if(document.f1.doctor.value == ""){
		alert("��س����͡ྷ���Ѻ\n*�ҡ��������ª���������͡��¡�� 'MD022 (����Һᾷ��)' ");
		return false;
	}else{
		return true;
	}

}
function show_tooltip(title,detail,al,l,r){

	tooltip.style.left=document.body.scrollLeft+event.clientX+l;
	tooltip.style.top=document.body.scrollTop+event.clientY+r;
	tooltip.innerHTML="";
	tooltip.innerHTML = tooltip.innerHTML+"<TABLE border=\"1\" bordercolor=\"blue\"><TR bgcolor=\"blue\"><TD align=\"center\"><B><FONT COLOR=\"#FFFFFF\">"+title+"</FONT></B></TD></TR><TR><TD align=\""+al+"\">"+detail+"</TD></TR></TABLE>";
	tooltip.style.display="";
}

function hid_tooltip(){
	tooltip.style.display="none";
	tooltip.innerHTML = "";

}

function handlerMMX(e){
	x = (document.layers) ? e.pageX : document.body.scrollLeft+event.clientX

	return x;
}

function handlerMMY(e){
	y = (document.layers) ? e.pageY : document.body.scrollTop+event.clientY
	return y;
}
</SCRIPT>
<style type="text/css">
<!--
.t {
	color: #C69;
}
-->
</style>
  <style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }

#slidemenubar, #slidemenubar2{
	position:absolute;
	left:-155px;
	width:300px;
	top:260px;

	

	layer-background-color:#000000;
	font:bold 16px ms sans serif;
	line-height:20px;

}

-->

	.today { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #C6B3FF; color: #000000;  }
	.sunday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FF9393; color: #FFFFFF; }
	.saturday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #ECC4FF; color: #000000; }
	.norm     { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #000000; }
	.link_calendar { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #000000; }
	.total_appointnorm { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #FF0000; text-decoration:none;}
	.total_appointsunday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FF9393; color: #FF0000;
	text-decoration:none;}
	.total_appointsaturday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #ECC4FF; color: #FF0000;
	text-decoration:none;}
</style>

<form name="f1" method="POST" action="preappoi2_bmd.php" onsubmit="return checkForm();">
  <!--<p><font face="Angsana New">ᾷ����Ѵ&nbsp;&nbsp;&nbsp;&nbsp;-->
   <?php
   include("connect.inc");
/*  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));

  if($menucode == "ADMMAINOPD"){
  ?>
  
  <? 

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"  onChange="show_carlendar(this.value)"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>


  <?php }else  if($menucode == "ADMDEN"){

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode ='ADMDEN'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"  onChange="show_carlendar(this.value)">
<option value="0">��س����͡ᾷ��</option>  
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>


  <?php }else  if($menucode == "ADMNID"){

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode ='ADMNID'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
  <select name="doctor2"  onChange="show_carlendar(this.value)">
  <option value="0">��س����͡ᾷ��</option> 
    <? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?>
    <option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option>
    <? 
} 
?>
<option value="MD072 ���Թ ������Ѳ��">MD072 ���Թ ������Ѳ��</option> 
  </select>
  <?php }else{?>
	  <? 
	 $strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" onChange="show_carlendar(this.value)"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>
  </font> </p>
	  <?php }*/
	  ?>
  <div id="div_right_list" ></div>
  <input type="hidden" name="dr" value="<?=$dt_doctor?>" />

  &nbsp;&nbsp;<input type="submit" value="    ����     " name="B1">
  &nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;<span class="t">&#3641;</span></a>&nbsp&nbsp;<<&nbsp<a target=_self  href='hnappoi1.php'>�͡㺹Ѵ����</a></p>
</form>
<?php include("unconnect.inc");?>
<script>
	window.onload=show_carlendar();
</script>
<div id = "tooltip" style="position:absolute;display:none;background-color:#FFFFFF;" >
</div>