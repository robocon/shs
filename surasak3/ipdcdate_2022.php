<?php 
session_start();
include("connect.inc");
?>
<style type="text/css">
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}	
</style>
<?
if($_POST["act"]=="edit"){
	$date=$_POST["dcdate"];
	$dctime=$_POST["dctime"];
	$dcdate="$date $dctime";
	//echo $dcdate;
	$an=$_POST["an"];
	$diag_thai=$_POST["diag_thai"];
	
	$edit="UPDATE ipcard SET dcdate='$dcdate',diag_thai='$diag_thai' WHERE an='$an'";
	if(mysql_query($edit)){
		echo "<script>alert('บันทึกข้อมูลเรียบร้อย');window.close();</script>";
	}else{
		echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง');window.close();</script>";
	}
}

    $query = "SELECT diag,diag_thai FROM ipcard WHERE an = '$vAn' ";
    $result = mysql_query($query)or die("Query failed ipcard");
    list ($diag,$diag_thai) = mysql_fetch_row ($result);
?>
<FORM name="f1" METHOD=POST ACTION="ipdcdate_2022.php" >
<input name="act" type="hidden" value="edit"/>
<input name="an" type="hidden" value="<?php echo $vAn;?>" />
<input name="dcdate" type="hidden" value="<?php echo substr($vDcdate1,0,10);?>" />
<TABLE bgcolor="#ABEBC6" width="50%" align="center" border="0" bordercolor="#1E8449" cellpadding="5" cellspacing="5">
<TR>
	<TD>
<TR>
	<TD colspan="2" align="center"><strong>แก้ไขข้อมูลการจำหน่ายผู้ป่วยใน</strong></TD>
</TR>
<TR>
	<TD width="34%" align="right">HN : </TD>
	<TD width="66%"><?php echo $vHn;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">AN : </TD>
	<TD width="66%"><?php echo $vAn;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">ชื่อ - นามสกุล : </TD>
	<TD width="66%"><?php echo $vPtname;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">สิทธิการรักษา : </TD>
	<TD width="66%"><?php echo $vPtright;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">โรค : </TD>
	<TD width="66%"><?php echo $diag;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">จำนวนวันนอน : </TD>
	<TD width="66%"><?php echo $vDays;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">วันที่ admit : </TD>
	<TD width="66%"><?php echo $vDate;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">วันที่จำหน่าย : </TD>
	<TD width="66%"><?php echo $vDcdate1;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">วันที่จำหน่าย : </TD>
	<TD width="66%"><input name="dctime" type="text" size="10" value="<?php echo $vDcdate;?>" class="forntsarabun" /></TD>
</TR>
<TR>
	<TD width="34%" align="right">ชื่อโรคภาษาไทย : </TD>
	<TD width="66%"><input name="diag_thai" type="text" size="50" value="<?php echo $diag_thai;?>" class="forntsarabun" /></TD>
</TR>
<TR>
	<TD colspan="2" align="center"><INPUT TYPE="submit" name="submit" value="บันทึกข้อมูล" class="forntsarabun"></TD>
</TR>
</TABLE>
</FORM>

