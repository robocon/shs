<?php 
session_start();
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

$sql = "Select a.name,b.name as username From doctor as a INNER JOIN inputm as b ON a.doctorcode = b.codedoctor where idname = '".$_SESSION["sIdname"]."' limit 1";
list($doctorname,$username) = Mysql_fetch_row(Mysql_Query($sql));

$thidate = (date("Y")+543).date("-m-d");
//$thidate ="2565-11-19";

$sql1 = "Select vn, hn, ptname, toborow,thidate  From opd where thidate like '".$thidate."%' AND doctor = '".$doctorname."' AND dc_diag is NULL Order by vn ASC ";
$result_list_pt = Mysql_Query($sql1);
$num_list_pt = Mysql_num_rows($result_list_pt );

$sql2 = "Select vn, hn, ptname, toborow ,thidate
From opd 
where thidate like '".$thidate."%' 
AND room like 'ห้อง%' 
AND dc_diag is NULL 
Order by vn ASC ";
//echo "==>$sql2";
$result_list_pt2 = Mysql_Query($sql2);
$num_list_pt2 = Mysql_num_rows($result_list_pt2 );
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
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFFF;  }
a{
	text-decoration:none;
}
#dt_other:target{
	text-decoration: underline;
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
<A HREF="javascript:switch_div('2');" id="dt_room" >รายชื่อผู้ป่วยหน้าห้องตรวจ (<?=$num_list_pt;?>)</A>  ||  <A HREF="javascript:switch_div('1');" id="dt_other">รายชื่อผู้ป่วยตรวจโรคทั่วไป/ห้องตรวจอื่นๆ  (<?=$num_list_pt2;?>)</A> 
<div  id="first" style="text-align: left; width:800px; overflow:auto; ">
<TABLE width='800'>
<TR class="tb_head">
  
	<TD>VN</TD>
	   <TD>เวลาซักประวัติ</TD>
	<TD>HN</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>สิทธิการรักษา</TD>
	<TD>สถานะ</TD>
</TR>
<?php

while(list($vn, $hn, $ptname, $toborow,$thidate) = Mysql_fetch_row($result_list_pt)){

	if(substr($toborow,-4) == "EX04"){
		$class = "tb_detail2";
	}else{
		$class = "tb_detail";
	}
	
$sql1="select ptright from opcard where hn='".$hn."'";
$query1=mysql_query($sql1);
list($ptright)=mysql_fetch_array($query1);	
?>
<TR class="<?php echo $class;?>">
	<TD><A HREF="javascript:document.form_vn.vn_now.value='<?php echo $vn;?>';form_vn.submit();" ><?php echo $vn;?></A></TD>
		<TD><?php echo substr($thidate,11,8);?></TD>
	<TD><?php echo $hn;?></TD>
	<TD><?php echo $ptname;?></TD>
	<TD><?php echo $ptright;?></TD>
	<TD><?php echo $toborow;?></TD>
</TR>
<?php }?>
</TABLE>
</div>

<div  id="sec" style="text-align: left; width:800px; overflow:auto; display:none; ">
<TABLE width='800'>
<TR class="tb_head">

	<TD>VN</TD>
	<TD>เวลาซักประวัติ</TD>
	<TD>HN</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>สิทธิการรักษา</TD>
	<TD>สถานะ</TD>
</TR>
<?php
while(list($vn, $hn, $ptname, $toborow,$thidate) = Mysql_fetch_row($result_list_pt2)){

	if(substr($toborow,-4) == "EX04"){
		$class = "tb_detail2";
	}else{
		$class = "tb_detail";
	}
	
$sql1="select ptright from opcard where hn='".$hn."'";
$query1=mysql_query($sql1);
list($ptright)=mysql_fetch_array($query1);		
?>
<TR class="<?php echo $class;?>">
	<TD><A HREF="javascript:document.form_vn.vn_now.value='<?php echo $vn;?>';form_vn.submit();" ><?php echo $vn;?></A></TD>

		<TD><?php echo substr($thidate,11,8);?></TD>
	<TD><?php echo $hn;?></TD>
	<TD><?php echo $ptname;?></TD>
	<TD><?php echo $ptright;?></TD>
	<TD><?php echo $toborow;?></TD>
</TR>
<?php }?>
</TABLE>
</div>

</body>

<?php include("unconnect.inc");?>
</html>