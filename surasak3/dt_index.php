<?php 
session_start();
$sOfficer = $_SESSION["sOfficer"];
if($_SESSION["sOfficer"] == ""){
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}
include("connect.inc");

function dump($txt){
	echo "<pre>";
	var_dump($txt);
	echo "</pre>";
}

include("checklogin.php");

$_SESSION['close_popup'] = false;


// ถ้าไม่ใช่หมอเป้
if($_SESSION['sIdname'] != "md19921"){
	
$sql = "Select a.name From doctor as a INNER JOIN inputm as b ON a.doctorcode = b.codedoctor where idname = '".$_SESSION["sIdname"]."' limit 1";
list($doctorname) = Mysql_fetch_row(Mysql_Query($sql));

$thidate = date("d-m-").(date("Y")+543);
if($doctorname=="MD065 พิศาล ศิริชีพชัยยันต์" || $doctorname=="MD089  เลอปรัชญ์ มังกรกนกพงศ์"){
	$sql = "Select vn, hn, ptname, toborow,thidate,officer  From opd where thdatehn like '".$thidate."%' AND (doctor = '".$doctorname."' OR doctor ='MD204 จักษุแพทย์') AND dc_diag is NULL Order by vn ASC ";
}else{
	$sql = "Select vn, hn, ptname, toborow,thidate,officer  From opd where thdatehn like '".$thidate."%' AND doctor = '".$doctorname."' AND dc_diag is NULL Order by vn ASC ";	
}
//echo $sql;
$result_list_pt = Mysql_Query($sql);
$num_list_pt = Mysql_num_rows($result_list_pt );

$sql = "Select vn, hn, ptname, toborow ,thidate ,officer
From opd 
where thdatehn like '".$thidate."%' 
AND room like 'ห้อง%' 
AND dc_diag is NULL 
Order by vn ASC ";
$result_list_pt2 = Mysql_Query($sql);
$num_list_pt2 = Mysql_num_rows($result_list_pt2 );

}
?>
<html>
<head>
<title><?php echo $_SESSION["sOfficer"];?></title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}

.tb_head {background-color: #45B39D; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #A3E4D7;  }
.tb_detail2 {background-color: #FFFFFF;  }
a{
	text-decoration:none;
}
#dt_other:target{
	text-decoration: underline;
}

.txtsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:16px; 
	font-weight:bold;
	}
-->
</style>
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	
	document.form_vn.vn_now.focus();

}

</SCRIPT>
</head>
</body>
<a href="dt_emp_manual_index.php">ตรวจสุขภาพสิทธิประกันสังคม (แบบไม่ต้องใช้ VN)</a>
|| <a href="dxdr_ofyear1_dr_manual.php">ตรวจสุขภาพประจำปีกองทัพบก (แบบไม่ต้องใช้ VN)</a>
|| <a href="dxdr_ofyearout_dr_hn.php">ตรวจสุขภาพประจำปีฮักกันยามเฒ่า (แบบไม่ต้องใช้ VN)</a> <br>
<a href="Edt_index.php">ตรวจสุขภาพ (ขอใบรับรองแพทย์อิเล็กทรอนิกส์)</a>
|| <A HREF="dt_listpatient.php" target="_blank" >รายชื่อผู้ป่วยตรวจโรควันนี้</A> 
<BR>
<table width="100%" border="0">
  <tr>
    <td>
	<FORM name="form_vn" METHOD=POST ACTION="dt_add_patient.php">
<TABLE>
<TR>
	<TD>
		<TABLE>
		<TR>
			<TD><font face=''>VN : </font></TD>
			<TD><INPUT TYPE="text" NAME="vn_now" class="txtsarabun"></TD>
			<TD><INPUT TYPE="submit" value="  ตกลง  " class="txtsarabun"></TD>
			<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="<< กลับไปเมนูหลัก" onclick="window.location='../nindex.htm' " class="txtsarabun" /></TD>
		</TR>
		<TR>
			<TD>&nbsp;</TD>
			<TD><INPUT TYPE="checkbox" NAME="special" value="true" <?php if($_SESSION["dt_special"]) echo "Checked"; ?>> : ค่าบริการคลินิกพิเศษ</TD>
			<TD>&nbsp;</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
</td>
    <td align="right">
	<table border="1"  bordercolor="#FF0000" cellpadding="5" cellspacing="0">
  <tr>
    <td>จำนวนคนไข้ : <?php echo $num_list_pt;?> คน </td>
  </tr>
</table>

	</td>
  </tr>
</table>


<BR><FONT SIZE="4" COLOR="#990033"><B>ข่าวสาร</B></FONT><BR>
<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$num = Y;
$depart1=Y;
   $query = "SELECT  row,depart,new,datetime FROM new  WHERE status ='$num' and dr  ='$depart1' ORDER BY row DESC  ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($row,$depart,$new,$datetime) = mysql_fetch_row ($result)) {

        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><br>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=15 src='new.gif' width=30>&nbsp;***&nbsp$new</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>($depart</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>&nbsp$datetime)&nbsp*** <br></td>\n".

           " </tr>\n");
        }
    print "</table>";


?>
<BR>
<SCRIPT LANGUAGE="JavaScript">

	function switch_div(xx){
		if(xx == '1'){
			document.getElementById('first').style.display = 'none';
			document.getElementById('sec').style.display = '';
		}else{
			document.getElementById('first').style.display = '';
			document.getElementById('sec').style.display = 'none';
		}
	}

</SCRIPT>
<A HREF="javascript:switch_div('2');" id="dt_room" >รายชื่อผู้ป่วยหน้าห้องตรวจ</A>  |  <A HREF="javascript:switch_div('1');" id="dt_other">รายชื่อผู้ป่วยตรวจโรคทั่วไป( <?php echo $num_list_pt2;?> )</A>

<div  id="first" style="text-align: left; width:800px; height:350px; overflow:auto; ">
<TABLE width='600'>
<TR class="tb_head">
  
	<TD>VN</TD>
	   <TD>เวลาซักประวัติ</TD>
	<TD>HN</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>สถานะ</TD>
	<TD>ผู้ซักประวัติ</TD>
</TR>
<?php

while(list($vn, $hn, $ptname, $toborow,$thidate,$officer_opd) = Mysql_fetch_row($result_list_pt)){

	if(substr($toborow,-4) == "EX04"){
		$class = "tb_detail2";
	}else{
		$class = "tb_detail";
	}
?>
<TR class="<?php echo $class;?>">
	<TD><A HREF="javascript:document.form_vn.vn_now.value='<?php echo $vn;?>';form_vn.submit();" ><?php echo $vn;?></A></TD>
		<TD><?php echo substr($thidate,11,8);?></TD>
	<TD><?php echo $hn;?></TD>
	<TD><?php echo $ptname;?></TD>
	<TD><?php echo $toborow;?></TD>
	<TD><?php echo $officer_opd;?></TD>
</TR>
<?php }?>
</TABLE>
</div>

<div  id="sec" style="text-align: left; width:800px; height:350px; overflow:auto; display:none; ">
<TABLE width='600'>
<TR class="tb_head">

	<TD>VN</TD>
	<TD>เวลาซักประวัติ</TD>
	<TD>HN</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>สถานะ</TD>
	<TD>ผู้ซักประวัติ</TD>
</TR>
<?php

while(list($vn, $hn, $ptname, $toborow,$thidate,$officer_opd) = Mysql_fetch_row($result_list_pt2)){

	if(substr($toborow,-4) == "EX04"){
		$class = "tb_detail2";
	}else{
		$class = "tb_detail";
	}
?>
<TR class="<?php echo $class;?>">
	<TD><A HREF="javascript:document.form_vn.vn_now.value='<?php echo $vn;?>';form_vn.submit();" ><?php echo $vn;?></A></TD>

		<TD><?php echo substr($thidate,11,8);?></TD>
	<TD><?php echo $hn;?></TD>
	<TD><?php echo $ptname;?></TD>
	<TD><?php echo $toborow;?></TD>
	<TD><?php echo $officer_opd;?></TD>
</TR>
<?php }?>
</TABLE>
</div>

</body>

<?php include("unconnect.inc");?>
</html>