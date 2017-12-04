<?php
session_start();
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
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
	$str = trim($str);
    return $str;
}

if(isset($_POST["submit_update"]) && $_POST["submit_update"] != ""){

	if($_POST["submit_update"] == "ล็อกยา" && $_POST["text_alert"] == ""){
		echo "<CENTER>ถ้าต้องการล็อกยากรุณาพิมพ์ข้อความแจ้งเตือนแพทย์ด้วยครับ</CENTER>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=lock_drug_cscd.php\">";
	exit();
	}

	if($_POST["submit_update"] == "ล็อกยา"){
		//$status = $_POST["text_alert"];
		$sql = "Update druglst set `lockptright` = 'Y' ,`lockptright_detail` = '".$_POST["text_alert"]."' Where row_id in ('".implode("','",$_POST["row_id"])."') ";
		
	}else{

		$sql = "Update druglst set `lockptright` = '' ,`lockptright_detail` = '' Where row_id in ('".implode("','",$_POST["row_id"])."') ";
	}

	$result = Mysql_query($sql);
	if($result){
		echo "บันทึกเรียบร้อยแล้วคะ";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=lock_drug_cscd.php\">";
	}
	exit();
}

?><html>
<head>
<title>Lock ยา (สิทธิเบิกจ่ายตรง)</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>

<A HREF="../nindex.htm">&lt;&lt; เมนู</A>
</SCRIPT>
<TABLE width="100%">
<TR valign="top">
	<TD width="50%">
	<FORM name="form_search" METHOD=POST ACTION="" >
<TABLE   width="400" border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE border="0"    width="100%">
<TR  bgcolor="#3366FF" class="font_title">
	<TD colspan="2" align="center">ค้นหายา (สิทธิเบิกจ่ายตรง)</TD>
</TR>
<TR >
	<TD  width="100" align="right">รหัสยา : </TD>
	<TD ><INPUT TYPE="text" NAME="drugcode" value="<?php echo $_POST["drugcode"];?>"></TD>
</TR>
<TR >
	<TD  width="100" align="right">ชื่อการค้า : </TD>
	<TD ><INPUT TYPE="text" NAME="tradname" value="<?php echo $_POST["tradname"];?>"></TD>
</TR>
<TR>
	<TD align="right">ชื่อสามัญ : </TD>
	<TD><INPUT TYPE="text" NAME="genname" value="<?php echo $_POST["genname"];?>"></TD>
</TR>
<TR>
	<TD align="right">ประเภท : </TD>
	<TD>
	<SELECT NAME="part">
		<Option value="">เลือกทั้งหมด</Option>
		<Option value="DDL" <?php if($_POST["part"] == "DDL")echo " Selected ";?>>ยาในบัญชียาหลักแห่งชาติ เบิกได้</Option>
		<Option value="DDY" <?php if($_POST["part"] == "DDY")echo " Selected ";?>>ยานอกบัญชียาหลักแห่งชาติ เบิกได้(กรรมการแพทย์อนุมัติ)</Option>
		<Option value="DSY" <?php if($_POST["part"] == "DSY")echo " Selected ";?>>เวชภัณฑ์ ที่เบิกได้(ผู้ป่วยนอกเบิกไม่ได้,ผู้ป่วยในเบิกได้)</Option>
		<Option value="DSN" <?php if($_POST["part"] == "DSN")echo " Selected ";?>>เวชภัณฑ์ ที่เบิกไม่ได้</Option>
		<Option value="DPY" <?php if($_POST["part"] == "DPY")echo " Selected ";?>>อุปกรณ์ ที่เบิกได้(เบิกได้ทั้งหมดหรือบางส่วน)</Option>
		<Option value="DPN" <?php if($_POST["part"] == "DPN")echo " Selected ";?>>อุปกรณ์ ที่เบิกไม่ได้</Option>
	</SELECT>
	</TD>
</TR>
<TR>
	<TD align="right">การล็อก : </TD>
	<TD>
	<SELECT NAME="status_lock">
		<Option value="">เลือกทั้งหมด</Option>
		<Option value="N" <?php if($_POST["status_lock"] == "N")echo " Selected ";?>>ตัวยาที่ไม่ได้ล็อก</Option>
		<Option value="Y" <?php if($_POST["status_lock"] == "Y")echo " Selected ";?>>ตัวยาที่ล๊อก</Option>
	</SELECT>
	
	</TD>
</TR>
<TR>
	<TD align="center"><INPUT TYPE="submit" value="ตกลง" name="submit_search"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>
	</TD>
	<TD width="50%" align="right">
	<?php
		$sql = "Select prefix From runno where title='passdrug' limit 1";
		list($passdrug) = mysql_fetch_row(mysql_query($sql));
	?>
	&nbsp;
	</TD>
</TR>
</TABLE>


<FORM name="f1" METHOD=POST ACTION="" >
<TABLE   width="729" border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE border="0"  width="100%">
<TR  bgcolor="#3366FF" class="font_title">
	<TD width="12%" align="center" >รหัส</TD>
	<TD width="15%" align="center" >ชื่อการค้า</TD>
	<TD width="16%" align="center" >ชื่อสามัญ</TD>
	<TD width="15%" align="center" >เหตุผล</TD>
	<TD width="16%" align="center" >ราคาขาย</TD>
	<TD width="8%" align="center" >หน่วย</TD>
	<TD width="10%" align="center" >ประเภท</TD>
	<TD width="8%" align="center" >Check</TD>
</TR>
<?php

if(empty($_POST["submit_search"])){
	
	exit();
}else{
	
	if($_POST["drugcode"] != ""){
		$where .= " AND drugcode like '%".$_POST["drugcode"]."%' ";
	}

	if($_POST["tradname"] != ""){
		$where .= " AND tradname like '%".$_POST["tradname"]."%' ";
	}

	if($_POST["genname"] != ""){
		$where .= " AND genname like '%".$_POST["genname"]."%' ";
	}
	
	if($_POST["part"] != ""){
		$where .= " AND part ='".$_POST["part"]."' ";
	}

	if($_POST["status_lock"] == "Y"){
		//$where .= " AND `lock_dr` ='".$_POST["status_lock"]."' ";
		$where .= " AND `lockptright` ='Y' ";
	}
	
	if($_POST["status_lock"] == "N"){
		//$where .= " AND `lock_dr` ='".$_POST["status_lock"]."' ";
		$where .= " AND `lockptright` !='Y' ";
	}

	$where = substr($where,4);

}

$sql = "Select * From druglst where ".$where;


$result = mysql_query($sql);
while($arr = mysql_fetch_assoc($result)){

	if($arr["lockptright"]== "Y"){
		$bgcolor="#FF9393";
	}else{
		$bgcolor="#FFFFFF";
	}

?>
<TR bgcolor="<?php echo $bgcolor;?>">
	<TD><?php echo $arr["drugcode"];?></TD>
	<TD><?php echo $arr["tradname"];?></TD>
	<TD><?php echo $arr["genname"];?></TD>
	<TD><?php if($arr["lockptright"]!="Y") echo ""; else{echo $arr["lockptright_detail"];}?></TD>
	<TD><?php echo $arr["salepri"];?></TD>
	<TD><?php echo $arr["unit"];?></TD>
	<TD align="center"><?php echo $arr["part"];?></TD>
	<TD align="center"><INPUT TYPE="checkbox" NAME="row_id[]" value="<?php echo $arr["row_id"];?>"></TD>

</TR>
<?php
$rea = $arr["lock_dr"];
}	
?>
<TR>
	<TD colspan="1" align="center"><INPUT TYPE="text" NAME="text_alert" size="20" value="<?php if($rea=="Y") echo ""; else{echo $rea;}?>"></TD>
	<TD colspan="7" align="center"><INPUT TYPE="submit" name="submit_update" value="ล็อกยา">&nbsp;&nbsp;<INPUT TYPE="submit" name="submit_update" value="ไม่ล็อกยา"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>


</body>
</html>
<?php include("unconnect.inc");?>
