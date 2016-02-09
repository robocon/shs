รายชื่อผู้ป่วยที่ไม่มาโรงพยาบาล 5 ปี<BR>
<A HREF="../nindex.htm">&lt;&lt;ไปเมนู</A><BR>

<?php
include("connect.inc");

function Select_page($rows,$page='1',$max='15',$link='',$name="",$file=""){

$hidden = "";

if(isset($name) && $name !=""){
		$link2 = "name=".$name; $and="&"; $hidden .= "<INPUT TYPE=\"hidden\" name=\"name\" value=\"$name\">";}
if(isset($file) && $file !=""){
		$link2 .= $and."file=".$file;$and="&"; $hidden .= "<INPUT TYPE=\"hidden\" name=\"file\" value=\"$file\">";}

if($link != ""){
$link1 = split("&",$link);
$count = count($link1);
	for($i=1;$i<$count;$i++){
		$link3 = split("=",$link1[$i]);
		$hidden .= "<INPUT TYPE=\"hidden\" name=\"".$link3[0]."\" value=\"".$link3[1]."\">";
	}
}


if($rows <= $max){
	$total_page = 1;
}else if(($rows % $max)==0){
	$total_page =($rows/$max) ; 
}else{
	$total_page =($rows/$max)+1 ; 
}

$total_page = (int)$total_page; 

if(!isset($page) || $page == "") $page = '1';

echo "<FORM name=\"form_page\" METHOD=GET ACTION=\"\" onsubmit=\" return checkFrom();\">
".$hidden."
มีจำนวนหน้าทั้งหมด ",$total_page," หน้า ปัจจุบันอยู่ที่หน้า <INPUT TYPE=\"text\" NAME=\"name_page\" onmousedown=\"this.value='';\" onkeypress=\"function_page(this.value,'",$total_page,"');\" size=\"4\" value=\"",$page,"\">

</FORM>
<SCRIPT LANGUAGE=\"JavaScript\">
<!--

function function_page(xx,yy){
e_k=event.keyCode
if(e_k == 13){
	if(xx == ''){
		alert('กรุณากรอกเลขหน้าด้วยครับ');
		event.returnValue = false;
	}else{
		window.location.href='",$_SERVER["PHP_SELF"],"?",$link2.$and,"name_page='+xx+'",$link,"';
		event.returnValue = false;
	}
}else if ((e_k < 48) || (e_k > 57)) {
event.returnValue = false;
}else if(eval(xx+String.fromCharCode(e_k)) <= 0){
event.returnValue = false;
alert('เลขหน้าควรมากกว่า 0 ครับ');
}else if(eval(xx+String.fromCharCode(e_k)) > eval(yy)){
event.returnValue = false;
alert('มีจำนวนหน้าเพียง '+",$total_page,"+' เท่านั้นครับ');
}
}


//-->
</SCRIPT>	
";

if($page=='1'){
$resql = "  limit 0,".$max." ";
}else{

$start = $max*($page-1);
$resql = "  limit ".$start.",".$max." ";
}
return $resql;

}


$stringlast5year = mktime(0,0,0,date("m"),date("d"),date("Y")-5);
$datelast5year = (date("Y",$stringlast5year)+543).date("-m-d H:i:s",$stringlast5year);

$Sql = "Create temporary table opcard_now2 (hn varchar(15), hn_first int, hn_last int, fullname varchar(80) , lastupdate datetime) Select hn, SUBSTRING(hn,1,2) as hn_first, SUBSTRING(hn,4) as hn_last, concat(yot,' ',name,' ',surname) as fullname, lastupdate From opcard where lastupdate <  '".$datelast5year."' AND lastupdate != '0000-00-00 00:00:00' ";
$result = Mysql_Query($Sql);

$Sql = "Select count(hn) as row1 From opcard_now2 ";
list($count) = Mysql_fetch_row(Mysql_Query($Sql));



echo "<BR>จำนวนข้อมูลทั้งหมด : ",$count;
$limit = Select_page($count,$_GET["name_page"],$max='1000');
echo "
	<TABLE width=\"600\">
	<TR align=\"center\" bgcolor=\"#3300FF\">
		<TD><FONT COLOR=\"#FFFFFF\"><B>HN</B></FONT></TD>
		<TD><FONT COLOR=\"#FFFFFF\"><B>ชื่อ-สกุล</B></FONT></TD>
		<TD><FONT COLOR=\"#FFFFFF\"><B>วันที่มาล่าสุด</B></FONT></TD>
	</TR>

";



$Sql = "Select hn, fullname, lastupdate From opcard_now2  Order by hn_first, hn_last ASC ".$limit;

$result = Mysql_Query($Sql);
$i=0;
while($arr = Mysql_fetch_assoc($result)){

if($i % 2 == 0){
	$bgcolor = "#FFFFCC";
}else{
	$bgcolor = "#FFFFFF";
}

	$date1 = explode(" ",$arr["lastupdate"]);
	$date2 = explode("-",$date1[0]);
	$date3 = explode(":",$date1[1]);

	$updatedate = $date2[2]."/".$date2[1]."/".$date2[0]." ".$date3[0].":".$date3[1].":".$date3[2];

echo "
	<TR bgcolor=\"",$bgcolor,"\">
		<TD><a target=\"_blank\"  href=\"opdedit.php?cHn=",$arr["hn"],"\">",$arr["hn"],"</TD>
		<TD>",$arr["fullname"],"</TD>
		<TD>",$updatedate,"</TD>
	</TR>
";
$i++;
}
echo "
	</TABLE>
";


?>