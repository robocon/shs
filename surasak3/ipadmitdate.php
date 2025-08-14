<?php 
session_start();
include("connect.inc");
?>
<style type="text/css">
body {
	font-family:"TH SarabunPSK"; 
	font-size:36px;
    }
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 28px;
}	
</style>
<?
if($_POST["act"]=="edit"){
	$date=$_POST["admitdate"];
	$admittime=$_POST["admittime"];
	$newdate="$date $admittime";
	//echo $dcdate;
	$an=$_POST["an"];
	
	$edit="UPDATE ipcard SET date='$newdate' WHERE an='$an'";
	if(mysql_query($edit)){
		echo "<script>alert('บันทึกข้อมูลเรียบร้อย');window.close();</script>";
	}else{
		echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง');window.close();</script>";
	}
}

$Can=$_GET["Can"];
    $query = "SELECT ipcard.an,ipcard.hn,ipcard.date,ipcard.dcdate,ipcard.days,ipcard.bedcode,ipcard.weight,opcard.yot,opcard.name,opcard.surname,opcard.idcard,opcard.ptright,opcard.dbirth,opcard.sex,opcard.address,opcard.tambol,opcard.ampur,opcard.changwat,opcard.phone,opcard.ptf,opcard.ptfadd,opcard.ptffone,opcard.camp 
    FROM ipcard 
    LEFT JOIN opcard ON ipcard.hn=opcard.hn WHERE an = '$Can'";
    $result = mysql_query($query)or die("Query failed");
    list ($an,$hn,$date,$dcdate,$days,$bedcode,$weight,$yot,$name,$surname,$idcard,$ptright,$dbirth,$sex,$address,$tambol,$ampur,$changwat,$phone,$ptf,$ptfadd,$ptffone,$camp) = mysql_fetch_row ($result);

	$ptname="$yot$name $surname";
	$admittime=substr($date,11);
?>
<FORM name="f1" METHOD=POST ACTION="ipadmitdate.php" >
<input name="act" type="hidden" value="edit"/>
<input name="an" type="hidden" value="<?php echo $an;?>" />
<input name="admitdate" type="hidden" value="<?php echo substr($date,0,10);?>" />
<TABLE bgcolor="#ABEBC6" width="50%" align="center" border="0" bordercolor="#1E8449" cellpadding="5" cellspacing="5">
<TR>
	<TD>
<TR>
	<TD colspan="2" align="center"><strong>แก้ไขเวลาที่รับAdmitป่วยใน</strong></TD>
</TR>
<TR>
	<TD width="34%" align="right">HN : </TD>
	<TD width="66%"><?php echo $hn;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">AN : </TD>
	<TD width="66%"><?php echo $an;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">ชื่อ - นามสกุล : </TD>
	<TD width="66%"><?php echo $ptname;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">สิทธิการรักษา : </TD>
	<TD width="66%"><?php echo $ptright;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">วันที่ admit : </TD>
	<TD width="66%"><?php echo $date;?>	</TD>
</TR>
<TR>
	<TD width="34%" align="right">เวลาที่ admit: </TD>
	<TD width="66%"><input name="admittime" type="text" size="10" value="<?php echo $admittime;?>" class="forntsarabun" /></TD>
</TR>
<TR>
	<TD colspan="2" align="center"><INPUT TYPE="submit" name="submit" value="บันทึกข้อมูล" class="forntsarabun"></TD>
</TR>
</TABLE>
</FORM>

