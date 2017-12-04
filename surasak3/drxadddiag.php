<?php
session_start();
include("connect.inc");


if($_GET["action"] == "add"){
	
	if($_POST["chkdepart"]=="p"){	  //สั่งจ่ายยา
	
	$sdate=substr($_GET["sDate"],0,10);
	list($y1,$m1,$d1)=explode("-",$sdate);
	$chkdatevn="$d1-$m1-$y1".$_SESSION["sVn"];

		$sql = "Update opday set  diag='".$_POST["diag"]."' where thdatevn = '".$chkdatevn."' limit 1";
	$result = Mysql_Query($sql);
	
		$sql = "Update phardep set diag = '".$_POST["diag"]."' WHERE row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' limit 1"; 
	$result = Mysql_Query($sql);
	}
	
	if($_POST["chkdepart"]=="y"){  //หัตถการ/การรักษา
	
	$sdate=substr($_POST["chkdate"],0,10);
	list($y1,$m1,$d1)=explode("-",$sdate);
	$chkdatevn="$d1-$m1-$y1".$_SESSION["sVn"];
	
		$sql = "Update opday set  diag='".$_POST["diag"]."' where thdatevn = '".$chkdatevn."' limit 1";
	$result = Mysql_Query($sql);
		
		$sql = "Update depart set diag = '".$_POST["diag"]."' WHERE hn = '".$_POST["hn"]."' AND tvn='".$_SESSION["sVn"]."'  AND date like '".$sdate."%'"; 
			$result = Mysql_Query($sql);
	}
	
		$sql="insert into log_editdiag set log_date='".date("Y-m-d H:i:s")."',
															log_officer='".$_SESSION["sOfficer"]."',
															log_datevn='".$chkdatevn."',
															log_hn = '".$_POST["hn"]."',
															log_ptname = '".$_POST["ptname"]."',
															log_ptright = '".$_POST["ptright"]."',
															log_olddiag = '".$_POST["olddiag"]."',
															log_diag = '".$_POST["diag"]."',
															log_doctor = '".$_POST["doctor"]."'";
		
		$result = Mysql_Query($sql);
		
	
	if($result){
		echo "แก้ไขชื่อโรคเรียบร้อยแล้ว";
		echo "
			<SCRIPT LANGUAGE=\"JavaScript\">
				opener.location.reload();
				window.close();		
			</SCRIPT>
		";
	}else{
		echo "ไม่สามารถแก้ไขชื่อโรคได้";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=drxadddiag.php?sDate=".$_GET["sDate"]."&nRow_id=".$_GET["nRow_id"]."\">";
	}
	exit();

}

$sql = "Select hn,ptname,ptright,diag,doctor From phardep where row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' limit 1 ";
$result = Mysql_Query($sql);
$num=mysql_num_rows($result);
if($num > 0){
list($hn,$ptname,$ptright,$diag,$doctor) = Mysql_fetch_row($result);
$chkdepart="p";  //ถ้ามีการสั่งจ่ายยา
}else{
	if(empty($_GET["sDate"])){
		$getdate=(date("Y")+543)."-".date("m-d");
	}else{
		$getdate=substr($_GET["sDate"],0,10);
	}
$sql = "Select date,hn,ptname,ptright,diag,doctor From depart where hn = '".$_GET["aHn"]."'  AND tvn = '".$_GET["aVn"]."'  AND date like '".$getdate."%' AND diag is not null limit 1 ";
//echo $sql;
$result = Mysql_Query($sql);
list($date,$hn,$ptname,$ptright,$diag,$doctor) = Mysql_fetch_row($result);
$chkdepart="y";  //ทำเฉพาะหัตถการ/การรักษา
}
?><style type="text/css">
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

<FORM METHOD=POST ACTION="drxadddiag.php?action=add&sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>">
<INPUT TYPE="hidden" NAME="hn" value="<?php echo $hn;?>">
<INPUT TYPE="hidden" NAME="ptname" value="<?php echo $ptname;?>">
<INPUT TYPE="hidden" NAME="ptright" value="<?php echo $ptright;?>">
<INPUT TYPE="hidden" NAME="olddiag" value="<?php echo $diag;?>">
<INPUT TYPE="hidden" NAME="doctor" value="<?php echo $doctor;?>">
<INPUT TYPE="hidden" NAME="chkdepart" value="<?php echo $chkdepart;?>">
<INPUT TYPE="hidden" NAME="chkdate" value="<?php echo $date;?>">
<TABLE width="863">
<TR>
  <TD>&nbsp;</TD>
  <TD><strong>แก้ไขชื่อโรค</strong></TD>
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
	<TD>ชื่อโรค</TD>
	<TD><INPUT NAME="diag" TYPE="text" class="txtform" value="<?php echo $diag;?>" size="50"></TD>
</TR>
<TR>
	<TD>&nbsp;</TD>
    <TD><INPUT TYPE="submit" name="submit" value="แก้ไขข้อมูล" class="txtform"></TD>
</TR>
</TABLE>
</FORM>



<?php

include("unconnect.inc");
?>