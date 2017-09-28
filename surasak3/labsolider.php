<?
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

		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		$nPrefix=$row->prefix;
?>
<style>
	.font_title{
	font-family:"Angsana New";
	font-size:36px;
	text-align: center;
}
	.tb_font{font-family:"Angsana New"; font-size:24px;}
	.tb_font_1{font-family:"Angsana New"; font-size:24px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"Angsana New"; font-size:24px; background-color:#9FFF9F}

.tb_font_2 {
	color: #B00000;
	font-weight: bold;
}
.style5 {color: #000099; font-weight: bold; }
.font_title1 {	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;
}
</style>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form action="labsolider.php" method="post"><!--labsolider.php-->
<input name="act" type="hidden" value="show" />
<div class="font_title">คิดค่าบริการตรวจสุขภาพทหารประจำปี<?=$nPrefix;?></div><br>
<br>
<TABLE width="447" border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
  <TR>
	<TD width="439" height="168">
	<TABLE width="441" border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD width="302" align="center" bgcolor="#0000CC" class="tb_font_1">ค้นหา HN / ID</TD>
	</TR>
	<TR>
		<TD class="tb_font">HN :
		  <input type="text" name="p_hn"  value="<?php echo $_POST["p_hn"]?>"/>&nbsp;</TD>
	</TR>
	<TR>
	  <TD height="35" class="tb_font">ID :
	    <input type="text" name="p_id"  value="<?php echo $_POST["p_id"]?>"/></TD>
	  </TR>
	<TR>
	  <TD height="31" align="center" class="tb_font"><input type="submit" name="Submit" value="ตกลง" /></TD>
	  </TR>
	<TR>
		<TD height="8"></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<br />
<input name="post_vn" type="hidden" value="1" />
</form>
<?php 
if($_POST["act"]=="show"){
if(!empty($_POST["p_hn"]) && $_POST["p_hn"] != ""){
	$sql2 = "select * from opcard where  hn='".$_POST["p_hn"]."'";	
}elseif(!empty($_POST["p_id"]) && $_POST["p_id"] != ""){
	$sql2 = "select * from opcard where  idcard='".$_POST["p_id"]."'";		
}		
	//echo $sql2;
	$row2 = mysql_query($sql2);
	$count2 = mysql_num_rows($row2);
	if($count2 < 1){
		if(!empty($_POST["p_hn"]) && $_POST["p_hn"] != ""){		
				echo "<script>alert('HN : $_POST[p_hn] นี้ ยังไม่มี OPD CARD หรือ ยังไม่ได้ทำการลงทะเบียนตรวจสุขภาพประจำปี$nPrefix กรุณาติดต่อห้องทะเบียนก่อนจึงจะทำรายการได้');</script>";
		}elseif(!empty($_POST["p_id"]) && $_POST["p_id"] != ""){
				echo "<script>alert('ID CARD : $_POST[p_id] นี้ ยังไม่มี OPD CARD หรือ ยังไม่ได้ทำการลงทะเบียนตรวจสุขภาพประจำปี$nPrefix กรุณาติดต่อห้องทะเบียนก่อนจึงจะทำรายการได้');</script>";
		}			
	}else{
	
?>
<TABLE   width="100%" border="1" bordercolor="#3366FF">
	<TR>
		<TD>
			<TABLE border="0"  width="100%">
				<TR  bgcolor="#3366FF" class="font_title1">
                    <TD width="9%" align="center" >HN</TD>
                    <TD width="26%" align="center" >ชื่อ-สกุล</TD>
                    <TD width="29%" align="center" >สิทธิ</TD>
                    <TD width="13%" align="center" >อายุ</TD>
                    <TD width="23%" align="center" >หน่วย</TD>
				</TR>
			<?php
			while($result2 = mysql_fetch_array($row2)){
			?>
				<TR>
					<TD><a href="labofyear.php?id=<?=$result2["hn"]?>"><?php echo $result2["hn"];?></a></TD>
                    <TD><?php echo $result2["yot"]." ".$result2["name"]." ".$result2["surname"];?></TD>
                    <TD><?php echo $result2["ptright"];?></TD>
                    <TD><?php echo calcage($result2["dbirth"]);?></TD>
                    <TD><?php echo $result2["camp"];?></TD>
				</TR>
                <?
			}
				?>
			</TABLE>
	  </TD>
	</TR>
</TABLE>
<?
	}
}
?>