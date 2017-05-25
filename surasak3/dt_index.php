<?php 
session_start();
include("connect.inc");

function dump($txt){
	echo "<pre>";
	var_dump($txt);
	echo "</pre>";
}

include("checklogin.php");

$_SESSION['close_popup'] = false;

$sql = "Select a.name From doctor as a INNER JOIN inputm as b ON a.doctorcode = b.codedoctor where idname = '".$_SESSION["sIdname"]."' limit 1";


list($doctorname) = Mysql_fetch_row(Mysql_Query($sql));

$thidate = date("d-m-").(date("Y")+543);
$sql = "Select vn, hn, ptname, toborow,thidate  From opd where thdatehn like '".$thidate."%' AND doctor = '".$doctorname."' AND dc_diag is NULL Order by vn ASC ";
$result_list_pt = Mysql_Query($sql);
$num_list_pt = Mysql_num_rows($result_list_pt );

$sql = "Select vn, hn, ptname, toborow ,thidate 
From opd 
where thdatehn like '".$thidate."%' 
AND room = 'ห้องตรวจโรคทั่วไป' 
AND dc_diag is NULL 
Order by vn ASC ";
$result_list_pt2 = Mysql_Query($sql);
$num_list_pt2 = Mysql_num_rows($result_list_pt2 );

?>
<html>
<head>
<title><?php echo $_SESSION["sOfficer"];?></title>
<style type="text/css">

body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFFF;  }
a{
	text-decoration:none;
}
#dt_other:target{
	text-decoration: underline;
}

</style>
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	
	document.form_vn.vn_now.focus();

}

</SCRIPT>
</head>
</body>
<a href='../nindex.htm'>&lt;&lt;ไปเมนู</a>  || <a href="dt_emp_manual_index.php">ตรวจสุขภาพลูกจ้าง รพ.</a>
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
			<TD><INPUT TYPE="text" NAME="vn_now"></TD>
			<TD><INPUT TYPE="submit" value="ตกลง"></TD>
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
<br>
<?php

$last_day = date('Y-m-d', strtotime("-2 week"));
$new_date = date('Y-m-d', strtotime("-1 week"));
$sql = "SELECT * FROM `news` 
WHERE `status` = 1
AND `date_start` > '$last_day'
ORDER BY `date_start` DESC;";
$q = mysql_query($sql);
$rows = mysql_num_rows($q);
if( $rows > 0 ){
?>
<style type="text/css">
.news-contain h3,ol{
	margin: 0;

}
.news-contain a{
	text-decoration: none;
}
.news-contain a:hover{
	text-decoration: underline;
}
</style>
<div class="news-contain">
	<h3 class="news-header">ข่าวประชาสัมพันธ์ บก. รพ.ค่าย</h3>
	<div>
		<ol>
			<?php
			while( $item = mysql_fetch_assoc($q) ){
				?>
				<li class="news-link">
					<a href="news_detail.php?id=<?=$item['id'];?>" target="_blank"><?=$item['title'];?></a>
					<?php
					if( $new_date < $item['date_start'] ){
						?><img height="15" src="../new.gif" width="30"><?php
					}
					?>
				</li>
				<?php
			}
			?>
		</ol>
	</div>
</div>
<?php
}
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
</TR>
<?php

while(list($vn, $hn, $ptname, $toborow,$thidate) = Mysql_fetch_row($result_list_pt)){

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
</TR>
<?php

while(list($vn, $hn, $ptname, $toborow,$thidate) = Mysql_fetch_row($result_list_pt2)){

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
</TR>
<?php }?>
</TABLE>
</div>

</body>

<?php include("unconnect.inc");?>
</html>