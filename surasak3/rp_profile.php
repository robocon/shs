<?php
session_start();
 include("connect.inc");

     $month_["01"] = "���Ҥ�";
    $month_["02"] = "����Ҿѹ��";
    $month_["03"] = "�չҤ�";
    $month_["04"] = "����¹";
    $month_["05"] = "����Ҥ�";
    $month_["06"] = "�Զع�¹";
    $month_["07"] = "�á�Ҥ�";
    $month_["08"] = "�ԧ�Ҥ�";
    $month_["09"] = "�ѹ��¹";
    $month_["10"] = "���Ҥ�";
    $month_["11"] = "��Ȩԡ�¹";
    $month_["12"] = "�ѹ�Ҥ�";
	
	$list_status_drug["STAT1"] = "Stat";
	$list_status_drug["STAT"] = "One day";
	$list_status_drug["CONT"] = "Continue";
	$list_status_drug["OLD"] = "�����";
	$list_status_drug["OLDEX"] = "������͡�ç��Һ��";	

?>

<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#669900; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}
body,td,th {
font-family:  MS Sans Serif;
font-size: 16 px;
}
.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}

</style>
<SCRIPT LANGUAGE="JavaScript">
	
	function print_page(){
		
		document.getElementById('form_search').style.display='none';
		document.getElementById('print_button').style.display='none';
		setTimeout("window.print();",1500);

	}

</SCRIPT>

<FORM   METHOD=POST ACTION="">

	<TABLE ID="form_search">
	<TR>
		<TD align="right">AN&nbsp;:&nbsp;</TD>
		<TD><INPUT TYPE="text" NAME="an" value="<?php echo $_REQUEST["an"];?>"></TD>
	</TR>
	<TR>
		<TD align="right">��͹&nbsp;:&nbsp;</TD>
		<TD><SELECT NAME="month">
	
	<?php
	while(list($key, $value) = each($month_)){
		echo "<OPTION VALUE=\"",$key,"\" ";
			if($key == date("m")) echo " Selected ";
		echo ">",$value,"</OPTION>";
	}
	?>
		
	</SELECT>&nbsp;&nbsp;��&nbsp;:&nbsp;<INPUT TYPE="text" NAME="year" size="4" value="<?php echo date("Y")+543;?>"></TD>
	</TR>
	<!-- <TR>
		<TD align="right">ʶҹ�&nbsp;:&nbsp;</TD>
		<TD><SELECT NAME="statcon">
			<OPTION VALUE="" SELECTED>������</OPTION>
			<OPTION VALUE="STAT" >one day</OPTION>
			<OPTION VALUE="CONT">contine</OPTION>
		</SELECT></TD>
	</TR> -->
	<TR>
		<TD colspan="2"><INPUT TYPE="submit" value="��ŧ"></TD>
	</TR>
	</TABLE>
	
</FORM>

<?php

if(trim($_REQUEST["an"]) == ""){
	exit();
}

if(isset($_REQUEST["an"])){


$an_now = $_REQUEST["an"];

$sql="CREATE TEMPORARY TABLE drugrx2 SELECT drugcode,tradname,slcode,statcon,date, amount FROM drugrx WHERE an = '".$an_now."' AND date LIKE '".$_REQUEST["year"]."-".$_REQUEST["month"]."%' AND slcode  <> '' AND  statcon is not NULL ";
$result = Mysql_Query($sql);

//echo $sql;


$sql="CREATE TEMPORARY TABLE dgprofile2 SELECT an, drugcode, tradname, onoff, slcode, statcon, dateoff From dgprofile WHERE an = '".$an_now."' AND left( drugcode, 1 ) in ('0','1','2','3','4','5','6','7','8','9')";
$result = Mysql_Query($sql);

$sql = "Select distinct drugcode, tradname, slcode,statcon From drugrx2  Order by drugcode,statcon ASC ";
$result = Mysql_Query($sql);
if(mysql_num_rows($result) == 0){
	echo "��辺�����Ţ AN ���� �������Ҩ����Թ��ѧ��������к������Ҥ���㹵������";
exit();
}

while($arr = Mysql_fetch_assoc($result)){
	
	$sql2 = "Select date, amount From  drugrx2 where drugcode ='".$arr["drugcode"]."' AND slcode ='".$arr["slcode"]."' AND  statcon ='".$arr["statcon"]."' ";

	$result2 = Mysql_Query($sql2);

	while($arr2 = Mysql_fetch_assoc($result2)){

		$date_show = intval(substr($arr2["date"],8,-9));

		$sum[$arr["drugcode"]][$arr["slcode"]][$arr["statcon"]][$date_show] = $sum[$arr["drugcode"]][$arr["slcode"]][$arr["statcon"]][$date_show] + $arr2["amount"];
		
	}

}

mysql_data_seek($result, 0);

echo $month_[$_REQUEST["month"]]," ",$_REQUEST["year"],"<BR>";

$sql_detail = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '".$_REQUEST["an"]."'";
$result_detail = Mysql_Query($sql_detail);
if(Mysql_num_rows($result_detail) == 0){
	$sql = "Select hn,an,ptname,age,ptright,bedcode,doctor,bed,diag From ipcard WHERE an = '".$_REQUEST["an"]."'";
	$result_detail = Mysql_Query($sql_detail);
	$arr = Mysql_fetch_assoc($result_detail);
}else{
	$arr = Mysql_fetch_assoc($result_detail);
}

			$sql_react = "Select drugcode,  tradname , advreact  From drugreact where hn = '".$arr["hn"]."'  ";

			$result_react = Mysql_Query($sql_react);
			$rows_react = Mysql_num_rows($result_react);
			if($rows_react> 0){
				echo "<FONT COLOR=\"red\">���ҷ����� ".$rows_react." ��¡��<BR>";
				while(list($drugcode,  $tradname , $advreact) = Mysql_fetch_row($result_react)){
					echo "[",$drugcode,"] : ", $tradname , " ( �ҡ�� : ",$advreact," )<BR>";
				}
				echo "</FONT>";
			}

echo "<CENTER>�ç��Һ�Ť�������ѡ��������</CENTER>";
echo "<CENTER>Ẻ�ѹ�֡�������/�Ǫ�ѳ��������</CENTER>";
echo "<CENTER>�ͧ���Ѫ�����͡��������Ţ FR-PHA-001/11</CENTER>";
echo "<CENTER>
HN<U>&nbsp;&nbsp;",$arr["hn"],"&nbsp;&nbsp;</U>
AN<U>&nbsp;&nbsp;",$arr["an"],"&nbsp;&nbsp;</U>
���ͼ�����<U>&nbsp;&nbsp;",$arr["ptname"],"&nbsp;&nbsp;</U>
����<U>&nbsp;&nbsp;",$arr["age"],"&nbsp;&nbsp;</U>
<BR>
�Է���<U>&nbsp;&nbsp;",$arr["ptright"],"&nbsp;&nbsp;</U>
�ä<U>&nbsp;&nbsp;",$arr["diagnos"],"&nbsp;&nbsp;</U>
ᾷ��<U>&nbsp;&nbsp;",$arr["doctor"],"&nbsp;&nbsp;</U>
</CENTER><BR>";


echo "<TABLE border = '1' bordercolor=\"#000000\" cellspacing=\"0\" cellpadding=\"0\" width=\"950\">
<TR align=\"center\">
	<TD >no.</TD><TD>������</TD><TD>������</TD><TD>�Ը���</TD><TD>ʶҹ�</TD>";

for($i=1;$i<32;$i++)
	echo "<TD>",$i,"</TD>";
	
	echo "<TD>OFF</TD>";

echo "</TR>\n";
$i=1;
while($arr = Mysql_fetch_assoc($result)){

echo "
<TR>
	<TD>&nbsp;",$i,"</TD><TD>&nbsp;",$arr["drugcode"],"</TD><TD>&nbsp;",$arr["tradname"],"</TD><TD>&nbsp;",$arr["slcode"],"</TD><TD>&nbsp;",$list_status_drug[$arr["statcon"]],"</TD>";

	for($j=1;$j<32;$j++)
	echo "<TD align=\"right\">",$sum[$arr["drugcode"]][$arr["slcode"]][$arr["statcon"]][$j],"&nbsp;</TD>";
	
	$sql = "Select dateoff From dgprofile2 where an = '".$_REQUEST["an"]."' AND drugcode = '".$arr["drugcode"]."' AND onoff = 'OFF' AND slcode= '".$arr["slcode"]."' AND statcon = '".$arr["statcon"]."'  limit 0,1 ";
	
	$result2 = Mysql_Query($sql);
	list($dateoff) = Mysql_fetch_row($result2);

	if($dateoff != ""){
	$day = explode(" ",$dateoff);
		$date = explode("-",$day[0]);
		echo "<TD align=\"center\">",$date[2],"/",$date[1],"/",($date[0]+543),"<BR>",$day[1],"&nbsp;</TD>";
	}else{
		echo "<TD align=\"center\">&nbsp;<BR>&nbsp;</TD>";
	}
echo "</TR>\n";
$i++;


$endtime = "";
}



echo "
</TABLE>
";
	
}
	
?>

<BR>
		<CENTER><div id="print_button"><A HREF="#" Onclick="print_page();" >Print</A><div></CENTER>

<?php
 include("unconnect.inc");
?>