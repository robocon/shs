<?php
session_start();
/*if(isset($_GET["action"]) && $_GET["action"] != "edit" && $_GET["action"] != "del"){
	header("content-type: application/x-javascript; charset=UTF-8");
}*/
	 include("connect.inc");


	 Function calcage($birth){

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


if($_POST["act"]=="edit"){
//echo "555";
//echo "===>".$_POST["submit_update"];
	if(isset($_POST["submit_update"]) && $_POST["submit_update"] != ""){
	
		if($_POST["submit_update"] == "ล็อกยา"){
			$status = "N";
		}else{
			$status = "Y";
		}
			if(count($_POST["row_id"]) > 0){	
				if($_POST["lock"]=="opd"){
					$sql = "Update druglst set `lock` = '$status' Where row_id in ('".implode("','",$_POST["row_id"])."') ";
					//echo "===>".$_POST["lock"];
				}else{
					$sql = "Update druglst set `lock_ipd` = '$status' Where row_id in ('".implode("','",$_POST["row_id"])."') ";
					//echo "--->".$_POST["lock"];
				}
				//echo $sql;
				$result = Mysql_query($sql);
			}	
			echo "<script>alert('ปรับปรุงข้อมูลการ LOCK ยา เรียบร้อยแล้ว');</script>";
			//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=lock_drug_md.php\">";
			//exit();
	}
}

?><html>
<head>
<title>Lock ยา</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  TH SarabunPSK;
	font-size: 18 px;
}

.font_title{
	font-family:  TH Sarabun PSK;
	font-size: 18 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>
<div style="margin-left:50px; margin-top:50px;">
<TABLE width="100%">
<TR valign="top">
	<TD width="50%">
	<FORM name="form_search" METHOD=POST ACTION="" >
    <input name="act" type="hidden" value="show">
<TABLE   width="400" border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE border="0"    width="100%">
<TR  bgcolor="#3366FF" class="font_title">
	<TD colspan="2" align="center">ค้นหายา</TD>
</TR>
<TR>
	<TD align="right">ประเภท : </TD>
	<TD>
	<SELECT NAME="part">
		<Option value="">เลือกทั้งหมด</Option>
		<Option value="DDL" <?php if($_POST["part"] == "DDL")echo " Selected ";?>>ยาในบัญชียาหลักแห่งชาติ เบิกได้ (ED)</Option>
		<Option value="DDY" <?php if($_POST["part"] == "DDY")echo " Selected ";?>>ยานอกบัญชียาหลักแห่งชาติ เบิกได้ (NED)</Option>
		<Option value="DDN" <?php if($_POST["part"] == "DDN")echo " Selected ";?>>ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้ (NED)</Option>
		<Option value="DPY" <?php if($_POST["part"] == "DPY")echo " Selected ";?>>อุปกรณ์เบิกได้ (DPY)</Option>
		<Option value="DSY" <?php if($_POST["part"] == "DSY")echo " Selected ";?>>เวชภัณฑ์เบิกได้ (DSY)</Option>        
	</SELECT>
	</TD>
</TR>
<TR>
	<TD align="right">การล็อก : </TD>
	<TD>
	<SELECT NAME="lock">
		<Option value="">เลือกทั้งหมด</Option>
		<Option value="OPD_Y" <?php if($_POST["lock"] == "OPD_Y")echo " Selected ";?>>ยา OPD ที่ไม่ได้ล็อก</Option>
		<Option value="OPD_N" <?php if($_POST["lock"] == "OPD_N")echo " Selected ";?>>ยา OPD ที่ล็อก</Option>
        <Option value="IPD_Y" <?php if($_POST["lock"] == "IPD_Y")echo " Selected ";?>>ยา IPD ที่ไม่ได้ล็อก</Option>
        <Option value="IPD_N" <?php if($_POST["lock"] == "IPD_N")echo " Selected ";?>>ยา IPD ที่ล๊อก</Option>
        
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
<? if($_POST["act"]=="show"){ ?>	
<strong>
<div>สีเหลือง หมายถึง ยาที่ สถานะปกติ</div>
<div>สีชมพู&nbsp;&nbsp; หมายถึง ยาที่ สถานะ Lock การจ่ายยา</div>
<div></div>
</strong>
<form action="lock_drug_md.php" method="post" name="f1">
<input name="act" type="hidden" value="edit">
<?
if($_POST["lock"] == "OPD_Y" || $_POST["lock"] == "OPD_N"){
?>
<input name="lock" type="hidden" value="opd">
<? }else{ ?>
<input name="lock" type="hidden" value="ipd">
<? } ?>

<TABLE   width="98%" border="1" bordercolor="#3366FF">
<TR>
	<TD>
<?
if(empty($_POST["submit_search"])){	
	exit();
}else{
		
	if($_POST["part"] != ""){
		$where .= " AND part ='".$_POST["part"]."'";
	}else{
		$where .= " AND part LIKE 'DD%'";
	}

	if($_POST["lock"] == "OPD_Y"){
		$where .= " AND `lock` ='Y'";
	}
	
	if($_POST["lock"] == "OPD_N"){
		$where .= " AND `lock` ='N'";
	}
	
	if($_POST["lock"] == "IPD_Y"){
		$where .= " AND `lock_ipd` ='Y'";
	}
	
	if($_POST["lock"] == "IPD_N"){
		$where .= " AND `lock_ipd` ='N'";
	}	

	$where = substr($where,4);

}

$sql = "Select * From druglst where drug_active='y' AND ".$where;

//echo $sql;
$result = mysql_query($sql);
$num = mysql_num_rows($result);
?> 
<div align="center" style="font-size:20px; font-weight:bold;">
<?
if($_POST["part"]=="DDL"){
	if($_POST["lock"] == "OPD_Y"){  //ยาที่ถูก lock การจ่ายยา
			echo "<div>ยาในบัญชียาหลักแห่งชาติ ที่ไม่ได้ Lock รหัสผ่าน ประเภทผู้ป่วยนอก</div>";
	}else if($_POST["lock"] == "OPD_N"){
			echo "<div>ยาในบัญชียาหลักแห่งชาติ ที่ Lock รหัสผ่าน ประเภทผู้ป่วยนอก</div>";
	}else if($_POST["lock"] == "IPD_Y"){
			echo "<div>ยาในบัญชียาหลักแห่งชาติ ที่ไม่ได้ Lock รหัสผ่าน ประเภทผู้ป่วยใน</div>";
	}else if($_POST["lock"] == "IPD_N"){
			echo "<div>ยาในบัญชียาหลักแห่งชาติ ที่ Lock รหัสผ่าน ประเภทผู้ป่วยใน</div>";
	}
}else if($_POST["part"]=="DDY"){
	if($_POST["lock"] == "OPD_Y"){  //ยาที่ถูก lock การจ่ายยา
			echo "<div>ยานอกบัญชียาหลักแห่งชาติ(เบิกได้) ที่ไม่ได้ Lock รหัสผ่าน ประเภทผู้ป่วยนอก</div>";
	}else if($_POST["lock"] == "OPD_N"){
			echo "<div>ยานอกบัญชียาหลักแห่งชาติ(เบิกได้) ที่ Lock รหัสผ่าน ประเภทผู้ป่วยนอก</div>";
	}else if($_POST["lock"] == "IPD_Y"){
			echo "<div>ยานอกบัญชียาหลักแห่งชาติ(เบิกได้) ที่ไม่ได้ Lock รหัสผ่าน ประเภทผู้ป่วยใน</div>";
	}else if($_POST["lock"] == "IPD_N"){
			echo "<div>ยานอกบัญชียาหลักแห่งชาติ(เบิกได้) ที่ Lock รหัสผ่าน ประเภทผู้ป่วยใน</div>";
	}
}else if($_POST["part"]=="DDN"){
	if($_POST["lock"] == "OPD_Y"){  //ยาที่ถูก lock การจ่ายยา
			echo "<div>ยานอกบัญชียาหลักแห่งชาติ(เบิกไม่ได้) ที่ไม่ได้ Lock รหัสผ่าน ประเภทผู้ป่วยนอก</div>";
	}else if($_POST["lock"] == "OPD_N"){
			echo "<div>ยานอกบัญชียาหลักแห่งชาติ(เบิกไม่ได้) ที่ Lock รหัสผ่าน ประเภทผู้ป่วยนอก</div>";
	}else if($_POST["lock"] == "IPD_Y"){
			echo "<div>ยานอกบัญชียาหลักแห่งชาติ(เบิกไม่ได้) ที่ไม่ได้ Lock รหัสผ่าน ประเภทผู้ป่วยใน</div>";
	}else if($_POST["lock"] == "IPD_N"){
			echo "<div>ยานอกบัญชียาหลักแห่งชาติ(เบิกไม่ได้) ที่ Lock รหัสผ่าน ประเภทผู้ป่วยใน</div>";
	}
}	

?>
</div>
<div align="center" style="font-size:20px; color:#FF0000; font-weight:bold;">ค้นข้อมูลพบทั้งสิ้น <?=$num;?>รายการ</div>
<TABLE border="0"  width="100%">
<TR  bgcolor="#3366FF" class="font_title">
  <TD width="4%" align="center" >ลำดับ</TD>
	<TD width="12%" align="center" >รหัส</TD>
	<TD width="15%" align="center" >ชื่อการค้า</TD>
	<TD width="18%" align="center" >ชื่อสามัญ</TD>
	<TD width="11%" align="center" >วันหมดอายุ</TD>
	<TD width="9%" align="center" >ราคาขาย</TD>
	<TD width="7%" align="center" >หน่วย</TD>
	<TD width="9%" align="center" >ประเภท</TD>
	<TD width="15%" align="center" >เลือกยาที่ต้องการ</TD>
</TR>
<?php
$i=0;
while($arr = mysql_fetch_assoc($result)){
$i++;
	if($arr["lock"] == "N" || $arr["lock_ipd"] == "N"){  //ยาที่ถูก lock การจ่ายยา
		$bgcolor="#FF9393";
	}else{
		$bgcolor="#FFFFCC";
	}

		
$sql1="select expdate from combill where drugcode like '$arr[drugcode]%' and amount > 0 order by row_id desc limit 1";
//echo $sql;
$query=mysql_query($sql1);
list($expdate)=mysql_fetch_array($query);

?>
<TR bgcolor="<?php echo $bgcolor;?>">
  <TD align="center"><?=$i;?></TD>
	<TD><?php echo $arr["drugcode"];?></TD>
	<TD><?php echo $arr["tradname"];?></TD>
	<TD><?php echo $arr["genname"];?></TD>
	<TD><?php echo $expdate;?></TD>
	<TD><?php echo $arr["salepri"];?></TD>
	<TD><?php echo $arr["unit"];?></TD>
	<TD align="center"><?php echo $arr["part"];?></TD>
	<TD align="center"><INPUT TYPE="checkbox" NAME="row_id[]" value="<?php echo $arr["row_id"];?>"></TD>
</TR>
<?php
}	
?>
<TR>
  <TD colspan="10" align="center">&nbsp;</TD>
  </TR>
<TR>
	<TD colspan="10" align="center"><INPUT TYPE="submit" name="submit_update" value="ล็อกยา">&nbsp;&nbsp;<INPUT TYPE="submit" name="submit_update" value="ไม่ล็อกยา"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>
</div>
<? } ?>
</body>
</html>
<?php include("unconnect.inc");?>
