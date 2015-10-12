<?php
session_start();
 include("connect.inc");   
	$month["01"] = "มกราคม";
    $month["02"] = "กุมภาพันธ์";
    $month["03"] = "มีนาคม";
    $month["04"] = "เมษายน";
    $month["05"] = "พฤษภาคม";
    $month["06"] = "มิถุนายน";
    $month["07"] = "กรกฏาคม";
    $month["08"] = "สิงหาคม";
    $month["09"] = "กันยายน";
    $month["10"] = "ตุลาคม";
    $month["11"] = "พฤศจิกายน";
    $month["12"] = "ธันวาคม";
	
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

	/*if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}*/

return $ageY;
}

	if($_POST["start_year"] =="" || $_POST["start_month"] =="" || $_POST["start_year"] ==""){
		$date_select = (date("Y")).date("-m-d%");
		//$date_head = date("d-m-").(date("Y")+543);
		$date_head = date("d ").$month[date("m")]." ".(date("Y")+543);
	}else{
		
		if($_POST["start_year"] > 2500)
			$_POST["start_year"] = $_POST["start_year"]-543;

		$date_select = $_POST["start_year"]."-".$_POST["start_month"]."-".$_POST["start_day"]."%";
		$date_head = $_POST["start_day"]." ".$month[$_POST["start_month"]]." ".$_POST["start_year"];
	}
	

	
?>
<html>
<head>
<style>
	body{
		font-family:"Angsana New";font-size:20px;
	}
	.font_tb{ 
		font-family:"Angsana New"; font-size:20px; text-align:center;
		}
</style>
<style media="print">
	.tb_search{
		display:none;
	}
</style>
<style>

@font-face {
 font-family: THSarabunPSK;
 src: url("/sm3/surasak3/THSarabun.eot") /* EOT file for IE */
}
@font-face {
 font-family: THSarabunPSK;
 src: url("/sm3/surasak3/THSarabun.ttf") /* TTF file for CSS3 browsers */
}
.style2 {color: #FFFFFF}
</style>
</head>
<body>
<form method="post" action="<?php echo $PHP_SELF ?>" class="tb_search">
 
 <TABLE id="f_search" >
<TR>
	<TD align="right">HN :</TD>
	<TD>
		<INPUT TYPE="text" NAME="POST_HN" value="<?php echo $_POST["POST_HN"];?>" >
	</TD>
</TR>
</TABLE>

 <input type="submit" value="      ตกลง      " name="B1">
 </p>
</form>

<div style="text-align:center;width:800px;margin-top:15px; margin-bottom:15px;">
<span>
ข้อมูล colonocopy
<br /><br /></span>
<table  class="font_tb" border="1" cellspacing="0" cellpadding="0" width="100%">
<tr bgcolor="#006595">
  <td class="tb_search style2">View</td>
<td colspan="1" ><span class="style2">ว/ด/ป</span></td>
<td colspan="1" ><span class="style2">HN</span></td>
<td colspan="1" ><span class="style2">AN</span></td>
<td colspan="1" ><span class="style2">ชื่อสกุล</span></td>
<td colspan="1" ><span class="style2">เพศ</span></td>
<td colspan="1" ><span class="style2">ผู้ป่วยจาก</span></td>
</tr>

<?php 
	
	
//Query dr_esophago ****************************************
	
if($_POST["POST_HN"] == "")
	exit();
	$sql = "Select row_id, date_format(thidate,'%d/%m/%Y') as date3, hn, an, ptname, gender, ward From  dr_colonoscopy   where hn ='".$_POST["POST_HN"]."'  ";

	$result = mysql_query($sql) or die(mysql_error());

$i=0;
	while($arr = mysql_fetch_assoc($result)){
		
		if($i%2 ==1){
			$bgcolor='#FFFFFF';
		}else{
			$bgcolor='#FFFFC4';
		}

?>
<tr bgcolor="<?php echo $bgcolor;?>">
  <td  class="tb_search"><A HREF="dt_colonocopy_show.php?id=<?php echo $arr["row_id"];?>" target="_blank">View</A></td>
	<td><?php echo $arr["date3"];?></td>
	<td><?php echo $arr["hn"];?></td>
	<td>&nbsp;<?php echo $arr["an"];?>&nbsp;</td>
	<td>&nbsp;<?php echo $arr["ptname"];?>&nbsp;</td>
	<td><?php echo $arr["gender"];?></td>
	<td><?php echo $arr["ward"];?></td>
</tr>


<?php }?>
</table>

</div>

</body>
<?php
include("unconnect.inc");
?>