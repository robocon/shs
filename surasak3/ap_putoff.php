<?php
session_start();
include("connect.inc");
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
?>

<style type="text/css">
<!--
.font3 {
	font-family: "TH SarabunPSK";
	font-size:30px;
}
.font1 {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}

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
-->
</style>

<script>
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
</script>
</head>
<?
function LastDay($m, $y) {
   for ($i=29; $i<=32; $i++) {
      if (checkdate($m, $i, $y) == 0) {
         return $i - 1;
      }
   }
}

if($_GET["action"] == "carlendar"){

/*$sql = "Select mdcode From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1";
list($mdcode) = Mysql_fetch_row(Mysql_Query($sql));
echo $sql;*/

$sql = "Select name From doctor where name like '".substr($_SESSION["dt_doctor"],0,5)."%' limit 1 ";
list($appoint_doctor) = Mysql_fetch_row(Mysql_Query($sql));


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

$sql = "Select appdate, apptime, count(distinct hn) as total_app From appoint  where appdate like '% ".$thmonthname[$month - 1]." ".($year+543)."' AND doctor in ('".$_SESSION["dt_doctor"]."','".$appoint_doctor."') AND apptime <> '¡��ԡ��ùѴ' GROUP BY appdate, apptime  ";

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
         echo "<td width=\"50\" valign=\"top\" align=\"center\" class=\"sunday\"><A class=\"sunday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\">$iday</A>";
		 if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
			 echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
		 else
			 echo "<BR>&nbsp;";
		 echo "</td>\n";
      }else  if ($i == 6 ) {
      //�óշ�����ѹ�ҷԵ�� ���������ѹ�Ѩ�غѹ
         echo "<td width=\"50\" align=\"center\" class=\"saturday\"><A class=\"saturday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\">$iday</A>";
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



         echo "<td width=\"50\" align=\"center\" class=\"".$class."\"><A class=\"".$class."\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\"  ".$holiday_detail.">$iday</A>";
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
				echo "<td width=\"50\" align=\"center\" class=\"sunday\"><A class=\"sunday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail.">$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
						echo "</td>\n";
			}else  if ($i == 6 ) {
				if($holiday["A".sprintf("%02d",$iday)]["date"]){
					$class = "sunday";
					$holiday_detail = " OnmouseOver = \"show_tooltip('�ѹ��ش','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
				  }else{
					$class = "norm";
				  }
				echo "<td width=\"50\" align=\"center\" class=\"saturday\"><A class=\"saturday\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail." >$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsaturday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
				echo "</td>\n";
			}else {
				if($holiday["A".sprintf("%02d",$iday)]["date"]){
					$class = "sunday";
					$holiday_detail = " OnmouseOver = \"show_tooltip('�ѹ��ش','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip();\" ";
				  }else{
					$class = "norm";
				  }
				echo "<td width=\"50\" align=\"center\" class=\"".$class."\"><A class=\"".$class."\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('datenew').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail." >$iday</A>";
					if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
						echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appoint".$class."\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
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
</TR>
</TABLE>";
exit();

}
?>
<script>
<!-- 
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

	xmlhttp = newXmlHttp();
	
	url = 'ap_putoff.php?action=carlendar' + xxx;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_right_list").innerHTML = xmlhttp.responseText;

}

//-->
</script>
<body onLoad="show_carlendar('');">
<div id="no_print" >
<center><span class="font3"><strong>���������͹�Ѵ</strong></span></center>
<a target=_top  href="../nindex.htm"><< ����� </a><br />
<form action="ap_putoff.php" method="post" class="font1" name="form11">
<table width="38%" border="1" cellpadding="0" cellspacing="0">
<tr>
  <td>
	<table width="100%">
  <tr>
    <td>�ѹ���
      <select name="d">
        <option value="0">-</option>
        <?
		for($a=1;$a<=31;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
        <option value="<?=$ss?><?=$a?>">
          <?=$a?>
          </option>
        <?
	}
	?>
        </select>
      ��͹
      <select name="m">
        <?
	$month = array('0','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
	for($a=1;$a<13;$a++){
	?>
        <option value="<?=$month[$a]?>">
          <?=$month[$a]?>
          </option>
        <?
	}
	?>
        </select>
      �.�.
      <select name="yr">
        <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
        <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'";?>>
          <?=$a?>
          </option>
        <?
	}
	?>
      </select></td>
    </tr>
  <tr>
    <td>ᾷ��
      <select name="dr">
        <?
	$strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
	while($objResult = mysql_fetch_array($objQuery)){
	?>
        <option value="<?=$objResult["name"];?>">
          <?=$objResult["name"];?>
          </option>
        <?
	}
	?>
      </select></td>
    </tr>
    <tr>
    <td>�Ѵ������ 
      <select name="detail">
      <option value="">--���͡������--</option>
        <?
	$strSQL ="select * from applist where status='Y' ";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
	while($objResult = mysql_fetch_array($objQuery)){
	?>
        <option value="<?=$objResult["appvalue"];?>"><?=$objResult["applist"];?></option>
        <?
	}
	?>
      </select></td>
  </tr>
  <tr>
    <td align="center"><input name="okbtn" type="submit" value="  ��ŧ  " class="font1"/></td>
    </tr></table></td></tr>
</table>
</form><br />
</a>
</div>
<?
if(isset($_POST['okbtn'])){
		$_SESSION["dt_doctor"]=$_POST['dr'];
		if($_POST['detail']!=""){
			$where = "and detail = '".$_POST['detail']."' ";
		}else{
			$where = "";
		}
		$sql = "select * from appoint where appdate LIKE '".$_POST['d']." ".$_POST['m']." ".$_POST['yr']."%' and doctor ='".$_POST['dr']."' and apptime !='¡��ԡ��ùѴ' $where";
		//echo $sql;
		$row = mysql_query($sql);
		$num1 = mysql_num_rows($row);
		if($num1>0){
			echo "<form action='ap_putoff.php' method='post' class='font1' name='form12'>";
			echo "<strong>�ѹ��� ".$_POST['d']." ".$_POST['m']." ".$_POST['yr']."</strong>";
			echo "<table border='1' class='font1' style='border-collapse:collapse' width='100%'><tr><strong><td align='center'>���͡ </td><td align='center'>HN</td><td align='center'>����-ʡ��</td><td align='center'>�������</td><td align='center'>������.</td><td align='center'>����</td><td align='center'>�Ѵ������</td><td align='center'>�ѹ���</td><td align='center'>����</td></strong>";
			//<input name='chch' type='checkbox' onclick=CheckAll();>
			$i=0;
			while($result = mysql_fetch_array($row)){
				$sql3 = "select concat(address,' ',tambol,' ',ampur,' ',changwat) as address,phone from opcard where hn='".$result['hn']."'";
				$row3 = mysql_query($sql3);
				$num3 = mysql_fetch_array($row3);
				$doctor= $result['doctor'];
				$i++;
				echo "<tr><td align='center'><input name='ch".$i."' id='ch".$i."' type='checkbox' value='".$result['row_id']."' ></td>";
				echo "<td>".$result['hn']."</td>";
				echo "<td>".$result['ptname']."</td>";
				echo "<td>".$num3['address']."</td>";
				echo "<td>".$num3['phone']."</td>";
				echo "<td>".$result['age']."</td>";
				echo "<td>".$result['detail']."</td>";
				echo "<td>".$result['appdate']."</td>";
				echo "<td>".$result['apptime']."</td></tr>";
			}?>
			</table><br />
            <div id="div_right_list" ></div><br>
			����͹�Ѵ���ѹ��� <input name="datenew" type="text"  size="15" id="datenew"/>
            
����
<?php if($_SESSION["sIdname"]== '�ѧ���' || $_COOKIE["until"] == "�ѧ���"){
		   
		   if(empty($_COOKIE["until"])){
			 @setcookie("until", "�ѧ���", time()+(3600*12));
		   }
	
		   ?>
<select size="1" name="capptime">
		<option value="07:30 �. - 08:00 �.">07:30 �. - 08:00 �.</option>
			<option value="08:30 �. - 09:00 �.">08:30 �. - 09:00 �.</option>
			<option value="09:30 �. - 10:00 �.">09:30 �. - 10:00 �.</option>
			<option value="10:30 �. - 11:00 �.">10:30 �. - 11:00 �.</option>
			<option value="11:30 �. - 12:00 �.">11:30 �. - 12:00 �.</option>
			<option value="12:30 �. - 13:00 �.">12:30 �. - 13:00 �.</option>
			<option value="15:30 �. - 16:00 �.">15:30 �. - 16:00 �.</option>
			<option value="16:30 �. - 17:00 �.">16:30 �. - 17:00 �.</option>
			<option value="17:30 �. - 18:00 �.">17:30 �. - 18:00 �.</option>
			<option value="18:30 �. - 19:00 �.">18:30 �. - 19:00 �.</option>
	
	</select>
	
	   <?php }else{ ?>
		<select size="1" name="capptime">
		<option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>
		<option selected>08:00 &#3609;. - 10.30 &#3609;.</option>
		<option>07:00 &#3609;.</option>
		<option>07:30 &#3609;.</option>
		<option>08:00 &#3609;.</option>
		<option>08:30 &#3609;.</option>
		<option>09:00 &#3609;.</option>
		<option>09:30 &#3609;.</option>
		<option>10:00 &#3609;.</option>
		<option>10:30 &#3609;.</option>
		<option>11:00 &#3609;.</option>
		<option>11:30 &#3609;.</option>
		<option>13:00 &#3609;.</option>
		<option>13:30 &#3609;.</option>
		<option>14:00 &#3609;.</option>
		<option>14:30 &#3609;.</option>
		<option>15:00 &#3609;.</option>
		<option>15:30 &#3609;.</option>
		<option>16:00 &#3609;.</option>
		<option>16:30 &#3609;.</option>
		<option>17:00 &#3609;.</option>
		<option>17:30 &#3609;.</option>
		<option>18:00 &#3609;.</option>
		<option>18:30 &#3609;.</option>
		<option>19:00 &#3609;.</option>
		<option>19:30 &#3609;.</option>
		<option>20:00 &#3609;.</option>
		<option>21:00 &#3609;.</option>
		</select>
		<?php 
		} 
		?><br><br>
      <input name="chdr" type="checkbox" value="1" onClick="if(document.getElementById('dr2').style.display=='none'){document.getElementById('dr2').style.display='';}else{document.getElementById('dr2').style.display='none'}"/>��ͧ�������¹ᾷ�� 
        <select name="dr2" id="dr2" style="display:none">
          <?
            $strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
            $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
            while($objResult = mysql_fetch_array($objQuery)){
            ?>
          <option value="<?=$objResult["name"];?>" <? if($doctor==$objResult["name"]) echo "selected";?>><?=$objResult["name"];?>
          </option>
          <?
            }
            ?>
        </select><br><br>
		<input name="count" type="hidden" value="<?=$i?>" />
		<input type="submit" name="ok2" value="��ŧ����͹�Ѵ"  />
		<?
        echo "</form>";		
		}else{
		echo "����բ����š�ùѴ";
	}
}
	
if(isset($_POST['ok2'])){
	$dateadd = (date("Y")+543).date("-m-d H:i:s");
	//$_POST['datenew']=($_POST['datenew']+0);
	//if($_POST['datenew']<10) $_POST['datenew']= "0".$_POST['datenew'];
	//echo $_POST['datenew'];
	//$newdate = $_POST['datenew']." ".$_POST['monnew']." ".$_POST['yrnew'];
	$newdate = $_POST['datenew'];
	for($a=0;$a<=$count;$a++){
		 if(isset($_POST['ch'.$a])){
			 $sql1 = "select * from appoint where row_id ='".$_POST['ch'.$a]."' ";
			 $row1 = mysql_query($sql1);
			 $result1 = mysql_fetch_array($row1);
			  if($_POST['chdr']=="1"){
			 	$result1['doctor']=$_POST['dr2'];
			 }
			 $insert1 = "insert into appoint(row_id,date,officer,hn,ptname,age,doctor,appdate,apptime,room,detail,detail2,advice	,patho,xray,other,depcode,came,diag,remark) values('','".$dateadd."','".$sOfficer."','".$result1['hn']."','".$result1['ptname']."','".$result1['age']."','".$result1['doctor']."','".$newdate."','".$_POST['capptime']."','".$result1['room']."','".$result1['detail']."','".$result1['detail2']."','".$result1['advice']."','".$result1['patho']."','".$result1['xray']."','".$result1['other']."','".$result1['depcode']."','".$result1['came']."','".$result1['diag']."','".$result1['remark']."')";

			if(mysql_query($insert1)){
				$idno=mysql_insert_id();
				$cHn = $result1['hn'];
				
				$sql2 = "select * from appoint_lab where id ='".$_POST['ch'.$a]."' ";
				$row2 = mysql_query($sql2);
				while($result2 = mysql_fetch_array($row2)){
					$sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ('".$idno."','".$result2['code']."')  ";
					$result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
				}
				$update1 = "update appoint SET apptime='¡��ԡ��ùѴ' where row_id='".$_POST['ch'.$a]."'";

			  	$re = mysql_query($update1);
				include("ap_putoffprint.php");
				?>
                <div style="page-break-after:always;"></div>
                <?
			 }
		 }
	}
	if($re){
		?>
			<script>
                  alert("�ѹ�֡���������º��������");
            </script>
            <!--<a href="ap_putoffprint.php" target="_blank" style="font-family:AngsanaUPC; font-size:24px;">�����㺹Ѵ</a><br /><br />

			<a href="ap_putoffprint2.php" target="_blank" style="font-family:AngsanaUPC; font-size:24px;">�������ɳ�ºѵ�</a>-->
		<?
	}
}
?>
<div id = "tooltip" style="position:absolute;display:none;background-color:#FFFFFF;" >
</div>
</body>
</html>