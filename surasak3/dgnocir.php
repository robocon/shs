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

echo "��§ҹ�ҷ�������ع���¹ ( ����ա�è�������ͺ 3 ��͹ ) &nbsp;&nbsp;&nbsp;<A HREF=\"../nindex.htm\">&lt;&lt;����</A><BR>";
echo "� �ѹ��� ",date("d")," ",$month_[date("m")]," ",date("Y")+543,"<BR>";

echo "<TABLE>
<TR bgcolor=\"blue\" style=\"color: #FFFFFF\">
	<TD>������</TD>
	<TD>������</TD>
	<TD>������</TD>
	<TD>�ѹ����ԡ����ش</TD>
	<TD>�ӹǹ�Ѩ�غѹ���������㹤�ѧ��</TD>
</TR>";

$string_time = mktime(0,0,0,date("m"),date("d")-30,date("Y"));

//where  datetranx < '".date("d-m-Y",$string_time)." 00:00:00' AND datetranx IS NOT NULL 

$sql = "SELECT drugcode, tradname, genname, date_format( datetranx, '%d-%m-%Y' ) AS format_datetranx, mainstk  FROM `druglst` where  datetranx < '".(date("Y",$string_time)+543)."".date("-m-d",$string_time)." 00:00:00' AND datetranx IS NOT NULL";

$result = Mysql_Query($sql);
$i=true;
while($arr = Mysql_fetch_assoc($result)){
	if($i == true){
		$bgcolor="#FFFFCC";
		$i = false;
	}else{
		$bgcolor="#FFFFCC";
		$i = true;
	}

	echo"
	<TR bgcolor=\"",$bgcolor,"\">
		<TD>",$arr["drugcode"],"</TD>
		<TD>",$arr["tradname"],"</TD>
		<TD>",$arr["genname"],"</TD>
		<TD>",$arr["format_datetranx"],"</TD>
		<TD>",$arr["mainstk"],"</TD>
	</TR>";
}

echo"</TABLE>";



include("unconnect.inc");
?>

