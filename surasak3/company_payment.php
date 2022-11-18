<?php

session_start();
/*if($_SESSION["sLevel"]!="admin"){
	exit();
}*/

include("connect.inc");
$subdate=substr($_GET["sDate"],0,10);

if($_POST["act"] == "add"){
	
	if(!empty($_POST["row_id"])){	
		$sql="update company_payment set company = '".$_POST["company"]."',
		officer='".$_POST["officer"]."',
		transaction_date='".date("Y-m-d H:i:s")."' where row_id='".$_POST["row_id"]."'";
		//echo $sql;
		$result = Mysql_Query($sql);
		if($result){
			echo "<script>alert('แก้ไขชื่อบริษัทเรียบร้อยแล้ว');window.close();</script>";
		}else{
			echo "<script>alert('ไม่สามารถแก้ไขชื่อบริษัทได้ กรุณาลองใหม่');window.close();</script>";
		}	
	}else{
		$sql="insert into company_payment set txdate = '".$_POST["txdate"]."',
		vn = '".$_POST["vn"]."',
		hn = '".$_POST["hn"]."',
		ptname = '".$_POST["ptname"]."',
		ptright = '".$_POST["ptright"]."',
		company = '".$_POST["company"]."',
		officer='".$_POST["officer"]."',
		transaction_date='".date("Y-m-d H:i:s")."'";
		//echo $sql;
		$result = Mysql_Query($sql);
			
		
		if($result){
			echo "<script>alert('เพิ่มชื่อบริษัทเรียบร้อยแล้ว');window.close();</script>";
		}else{
			echo "<script>alert('ไม่สามารถเพิ่มชื่อบริษัทได้ กรุณาลองใหม่');window.close();</script>";
		}
	}

}
$sql = "Select row_id,txdate,vn,hn,ptname,ptright,company From company_payment where vn = '".$_GET["aVn"]."' and hn = '".$_GET["aHn"]."' AND txdate like '".$subdate."%' limit 1";
//echo $sql;
$result = Mysql_Query($sql);
$num=mysql_num_rows($result);
if($num > 0){
list($row_id,$txdate,$vn,$hn,$ptname,$ptright,$company) = Mysql_fetch_row($result);
}else{
$sql = "Select thidate,vn,hn,ptname,ptright From opday where vn = '".$_GET["aVn"]."' and hn = '".$_GET["aHn"]."' AND thidate like '".$subdate."%' limit 1 ";
//echo $sql;
$result = Mysql_Query($sql);
list($txdate,$vn,$hn,$ptname,$ptright) = Mysql_fetch_row($result);
}
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.txtform {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>

<FORM METHOD=POST ACTION="company_payment.php">
<INPUT TYPE="hidden" NAME="act" value="add">
<INPUT TYPE="hidden" NAME="row_id" value="<?php echo $row_id;?>">
<INPUT TYPE="hidden" NAME="hn" value="<?php echo $hn;?>">
<INPUT TYPE="hidden" NAME="vn" value="<?php echo $vn;?>">
<INPUT TYPE="hidden" NAME="ptname" value="<?php echo $ptname;?>">
<INPUT TYPE="hidden" NAME="ptright" value="<?php echo $ptright;?>">
<INPUT TYPE="hidden" NAME="txdate" value="<?php echo $txdate;?>">
<INPUT TYPE="hidden" NAME="officer" value="<?php echo $_SESSION["sOfficer"];?>">
<TABLE width="863">
<TR>
  <TD>&nbsp;</TD>
  <TD><strong>เพิ่มชื่อบริษัทบนใบเสร็จรับเงิน สิทธิประกันสังคม กรณี กท44 เท่านั้น</strong></TD>
</TR>
<TR>
  <TD>&nbsp;</TD>
  <TD><strong>vn : </strong><?php echo $vn;?></TD>
</TR>
<TR>
  <TD>&nbsp;</TD>
  <TD><strong>HN : </strong><?php echo $hn;?></TD>
</TR>
<TR>
  <TD>&nbsp;</TD>
  <TD><strong>ชื่อ-สกุล : </strong><?php echo $ptname;?></TD>
</TR>
<TR>
  <TD>&nbsp;</TD>
  <TD><strong>สิทธิ : </strong><?php echo $ptright;?></TD>
</TR>
<TR>
	<TD>บริษัท</TD>
	<TD><INPUT NAME="company" TYPE="text" class="txtform" value="<?php echo $company;?>" size="80"></TD>
</TR>
<TR>
	<TD>&nbsp;</TD>
    <TD>
	<?
	if(!empty($row_id)){	
	?>
	<INPUT TYPE="submit" name="submit" value="แก้ไขข้อมูล" class="txtform">
	<? }else{ ?>
	<INPUT TYPE="submit" name="submit" value="บันทึกข้อมูล" class="txtform">
	<? } ?>
	</TD>
</TR>
</TABLE>
</FORM>



<?php

include("unconnect.inc");
?>