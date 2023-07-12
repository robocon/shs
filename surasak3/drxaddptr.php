<?php
session_start();
include("connect.inc");


if($_GET["action"] == "add"){
	
	

		$sql = "Update dphardep set ptright = '".$_POST["ptright"]."' WHERE row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' limit 1"; 
	$result = Mysql_Query($sql);
	
	if($result){
		echo "แก้ไขสิทธิการรักษาเรียบร้อยแล้ว";
		echo "
			<SCRIPT LANGUAGE=\"JavaScript\">
				opener.location.reload();
				window.close();		
			</SCRIPT>
		";
	}else{
		echo "ไม่สามารถแก้ไขสิทธิการรักษาได้";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=drxaddptr.php?sDate=".$_GET["sDate"]."&nRow_id=".$_GET["nRow_id"]."\">";
	}
	exit();

}

$sql = "Select ptright  From dphardep where row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' limit 1 ";
$result = Mysql_Query($sql);
list($ptright) = Mysql_fetch_row($result);

?>
<style>
body{
font-family:TH SarabunPSK;
font-size:20px;	
}
.txt{
font-family:TH SarabunPSK;
font-size:20px;	
}	
</style>
<div align="center" style="margin-top:50px;" >
<h1><strong>เปลี่ยนสิทธิการรักษาผู้ป่วย</strong></h1>
<h2>สิทธิการรักษาเดิม  : <?php echo $ptright;?></h2>
<FORM METHOD=POST ACTION="drxaddptr.php?action=add&sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>">
<TABLE align="center" clsss="txt">
<TR>
	<TD><strong class="txt">สิทธิการรักษา : </strong></TD>
	<TD>
	<select size="1" name="ptright" class="txt">
	<?php
						
		$sql="select * from ptright where name like '%HD%' order by code asc";
		$query=mysql_query($sql);
		while($rows=mysql_fetch_array($query)){	
			$ptrightname=$rows["code"]." ".$rows["name"];
	?>
		<option value="<?=$ptrightname;?>" <?php if($rows["code"]=="R18"){ echo "select"; }?>><?php echo $ptrightname;?></option>		
	<?php
		}
	?>	
		<!--<option>R18 HD โครงการรักษาโรคไต (HD)</option> -->
	</select>
	
	</TD>
<TD><div style="margin-left:5px;"><INPUT TYPE="submit" name="submit" value="   ตกลง   " class="txt"></div></TD>	
</TR>
</TABLE>
</FORM>
<div style="color:red;">*** เป็นการแก้ไขเฉพาะใบสั่งยาเท่านั้น ***</div>
</div>


<?php

include("unconnect.inc");
?>