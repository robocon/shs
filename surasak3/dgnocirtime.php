<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
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

echo "��§ҹ�ҷ�������ع���¹ ( ����ա�è����ҵ����ǧ���� ) &nbsp;&nbsp;&nbsp;<A HREF=\"../nindex.htm\">&lt;&lt;����</A><BR>";
echo "� �ѹ��� ",date("d")," ",$month_[date("m")]," ",date("Y")+543,"<BR>";
echo "<div align='center' style='color:red;'>���ѧ��Ѻ��ا Report �ѧ�����������ó�</div>";
echo "<TABLE>
<TR bgcolor=\"blue\" style=\"color: #FFFFFF\">
	<TD><strong>������</strong></TD>
	<TD><strong>������</strong></TD>
	<TD><strong>������</strong></TD>
	<TD width=\"7%\"><strong>�ѹ����ԡ����ش</strong></TD>
	<TD width=\"5%\" align=\"center\"><strong>�ӹǹ��<br>㹤�ѧ</strong></TD>
	<TD width=\"7%\"><strong>�ѹ����������</strong></TD>
	<TD><strong>���ʺ���ѷ</strong></TD>
	<TD><strong>���ͺ���ѷ</strong></TD>
</TR>";

$string_time = mktime(0,0,0,date("m"),date("d")-30,date("Y"));

//where  datetranx < '".date("d-m-Y",$string_time)." 00:00:00' AND datetranx IS NOT NULL 

$sql = "SELECT drugcode, tradname, genname, date_format( datetranx, '%d-%m-%Y' ) AS format_datetranx, mainstk, comcode, comname  FROM `druglst` where  datetranx < '".(date("Y",$string_time)+543)."".date("-m-d",$string_time)." 00:00:00' AND datetranx IS NOT NULL";
//echo $sql;
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

//���ѹ������آͧ�� �ҡ��ù�����Ҥ�ѧ�����ش����	
$query1=mysql_query("select date_format(expdate,'%d-%m-%Y') from stktranx where drugcode='$arr[drugcode]' and amount > 0 order by row_id desc limit 1");
list($newexpdate)=mysql_fetch_array($query1);
list($d,$m,$y)=explode("-",$newexpdate);
$y=$y+543;
$expdate="$d-$m-$y";


	echo"
	<TR bgcolor=\"",$bgcolor,"\">
		<TD>",$arr["drugcode"],"</TD>
		<TD>",$arr["tradname"],"</TD>
		<TD>",$arr["genname"],"</TD>
		<TD>",$arr["format_datetranx"],"</TD>
		<TD>",$arr["mainstk"],"</TD>
		<TD>",$expdate,"</TD>
		<TD>",$arr["comcode"],"</TD>
		<TD>",$arr["comname"],"</TD>						
	</TR>";
}

echo"</TABLE>";



include("unconnect.inc");
?>

