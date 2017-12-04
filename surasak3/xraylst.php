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
		$date_select = (date("Y")+543).date("-m-d%");
		$date_select2 = (date("Y")+543).date("-m%");
		//$date_head = date("d-m-").(date("Y")+543);
		$date_head = date("d ").$month[date("m")]." ".(date("Y")+543);
	}else{
		$date_select = $_POST["start_year"]."-".$_POST["start_month"]."-".$_POST["start_day"]."%";
		$date_select2 = $_POST["start_year"]."-".$_POST["start_month"]."%";
		$date_head = $_POST["start_day"]." ".$month[$_POST["start_month"]]." ".$_POST["start_year"];
	}
	
	if(isset($_POST["Submit_edit"]) && $_POST["detail_edit"] != ""){
	
		$sql = "update xray_stat set `detail` = '".$_POST["detail_edit"]."', `digital` = '".$_POST["edit_digital"]."', `10_12` = '".$_POST["edit10_12"]."', `14_14` = '".$_POST["edit14_14"]."' , `NONE` = '".$_POST["edit_none"]."' , `filmbk` = '".$_POST["edit_filmbk"]."' where row_id = '".$_POST["id"]."' limit 1;";
		//echo $sql;
		mysql_query($sql);
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=xraylst.php\">";
	exit();
	}else if(isset($_GET["del"]) && $_GET["del_id"] != ""){
	
		$sql = "update xray_stat set `cancle` = '1', `office` = '".$sOfficer."' where row_id = '".$_GET["del_id"]."' limit 1;";
		//echo $sql;
		mysql_query($sql);
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=xraylst.php\">";
	exit();
	}else if(isset($_POST["Submit_add"]) && $_POST["Submit_add"] != ""){
		
		$sql = "Select concat(yot,' ',name,' ',surname), ptright, dbirth From opcard where hn = '".$_POST["hn"]."' limit 0,1";
		list($ptname,$ptright,$dbirth) = mysql_fetch_row(mysql_query($sql));
		

		$sql = "Select xn From xrayno where hn = '".$_POST["hn"]."' Order by row_id DESC limit 0,1 ";
		list($xn) = mysql_fetch_row(mysql_query($sql));
			
			if(substr($xn,-2) == substr(date("Y")+543,-2)){
				$xn_new = $xn;
				$xn = "";
			}

		$age = calcage($dbirth);
		$sql = "
		INSERT INTO `smdb`.`xray_stat` (
			`row_id` ,
			`date` ,
			`hn` ,
			`xn` ,
			`xn_new` ,
			`ptname` ,
			`age` ,
			`ptright` ,
			`patient_from` ,
			`detail` ,
			`doctor` ,
			`digital` ,
			`10_12` ,
			`14_14` ,
			`NONE` ,
			`filmbk` ,
			`office` ,
			`idno` ,
			`remark` ,
			`cancle` 
			)
			VALUES (
			NULL , '".$_POST["start_year"]."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00', '".$_POST["hn"]."', '".$xn."', '".$xn_new."', '".$ptname."', '".$age."', '".$ptright."', '".$_POST["patien_from"]."', '".$_POST["detail"]."', '".$_POST["doctor"]."', '".$_POST["digital"]."', '".$_POST["add10_12"]."', '".$_POST["add14_14"]."', '".$_POST["addnone"]."', '".$_POST["filmbk"]."', '".$sOfficer."', '', '".$_POST["remark"]."', '0'
			);";
			mysql_query($sql) or die("<!-- ".mysql_error()." -->");
			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=xraylst.php\">";
	exit();
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

.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
	.form_detail{
		border:2px solid;
		border-radius:25px;
		border-color: #66CDAA;
		font-family: Angsana New;
		font-size: 22px;
		border-collapse: collapse;
	}
</style>

</head>
<body>
<form method="post" action="<?php echo $PHP_SELF ?>" class="tb_search">
 &nbsp;&nbsp;<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>
 <TABLE id="f_search" >
<TR>
	<TD align="right">วันที่ :</TD>
	<TD>
		<INPUT TYPE="text" NAME="start_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4">
	</TD>
</TR>
</TABLE>

 <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;<A HREF="#blog_add">เพิ่มข้อมูล</A>&nbsp;&nbsp;
 <input type="button" value="      พิมพ์      " onClick="window.print();">

 </p>
</form>

<div style="text-align:center;width:1000px;margin-top:15px; margin-bottom:15px;">
<span>ทะเบียนผู้ป่วย<br />แผนกรังสีกรรม เอกสารหมายเลข FR-XRA-001/4 แก้ไขครั้งที่.........  วันที่มีผลบังคับใช้ 9 มีนาคม พ.ศ.2543
<br />
รายงานวันที่ <?php echo $date_head;?>
<br /><br /></span>
<table  class="font_tb" border="1" cellspacing="0" cellpadding="0" width="100%">
<tr>
  <td rowspan="2" class="tb_search">ลำดับ</td>
  <td rowspan="2" class="tb_search">ลบ</td>
<td rowspan="2" class="tb_search">แก้ไข</td>
<td colspan="1" rowspan="2">ว/ด/ป</td>
<td colspan="1" rowspan="2">HN</td>
<td colspan="2" rowspan="1">XN</td>
<td colspan="1" rowspan="2">ชื่อสกุล</td>
<td colspan="1" rowspan="2">อายุ</td>
<td colspan="1" rowspan="2">สิทธิ</td>
<td colspan="1" rowspan="2">ผู้ป่วยส่งจาก</td>
<td colspan="1" rowspan="2">ตรวจ</td>
<td colspan="1" rowspan="2">แพทย์ผู้สั่ง</td>
<td colspan="4" rowspan="1">จำนวนฟิล์ม</td>
<td colspan="1" rowspan="2">หมายเหตุ</td>
</tr>

<tr>
<td colspan="1" rowspan="1">เก่า</td>
<td colspan="1" rowspan="1">ใหม่</td>

<td colspan="1" rowspan="1">Digital</td>
<td colspan="1" rowspan="1">10x<br />12</td>
<td colspan="1" rowspan="1">14x<br />17</td>
<td colspan="1" rowspan="1">NONE</td>
</tr>

<?php 
	
	
//Query patdata ****************************************
	

	
	//$sql = "CREATE TEMPORARY TABLE  depart_2 Select * From depart where date like '".$date_select."'  AND depart = 'XRAY' AND price >0 AND status = 'Y' ";
	//$result = mysql_query($sql) or die(mysql_error());

	//$sql = "CREATE TEMPORARY TABLE  xray_stat_2 Select date_format(date,'%Y-%m-%d') as date2, hn,  xn,  xn_new,  ptname,  age,  ptright,  patient_from,  detail,  doctor,  digital,  10_12,  14_14,  NONE  From xray_stat where date like '".$date_select."'   ";
	//$result = mysql_query($sql) or die(mysql_error());

	$sql = "Select row_id, date_format(date,'%d/%m/%Y') as date3, hn,  xn,  xn_new,  ptname,  age,  ptright,  patient_from,  detail,  doctor,  digital,  10_12,  14_14,  NONE From xray_stat  where date like '".$date_select."' AND cancle = '0'  ";
	$result = mysql_query($sql) or die(mysql_error());
echo $sql;
$i=1;
	while($arr = mysql_fetch_assoc($result)){
		
		//$sql = "Select xn From xrayno where hn = '".$arr["hn"]."' limit 0,1 ";
		//list($xn) = mysql_fetch_row(mysql_query($sql));

		//$sql = "Select dbirth From opcard where hn = '".$arr["hn"]."' limit 0,1 ";
		//list($dbirth) = mysql_fetch_row(mysql_query($sql));
		
		//$age = "-";
		//if(!empty($dbirth))
		//	$age = calcage($dbirth);

		//$sql = "Select SUBSTRING(ptright,5), doctor, an, patient_from, detailbydr  From depart_2 where row_id = ".$arr["idno"]." limit 0,1 ";
		//list($ptright, $doctor, $an, $by, $detailbydr) = mysql_fetch_row(mysql_query($sql));
		
		//if($doctor[0] == "M")
		//	$doctor = substr($doctor,6);

		
		/*$sql = "Select film_size, count(film_size) as film_size_c, sum(price) From patdata_2 where date2 = '".$arr["date2"]."' AND hn = '".$arr["hn"]."' group by film_size ";
		//echo $sql;
		$result2 = mysql_query($sql)  or die(mysql_error());
		$count_film = array();
		$sum =0;
		while(list($film_size, $film_size_c, $price_s) = mysql_fetch_row($result2)){
			$count_film[$film_size] = $film_size_c;
			$sum = $sum + $price_s; 
			//echo $price_s;

		}*/
		
		if($arr["xn"] == "" && $arr["xn_new"] == ""){
			$sql = "Select xn From xrayno where hn = '".$arr["hn"]."' Order by row_id DESC limit 0,1 ";
			list($pxn) = mysql_fetch_row(mysql_query($sql));
			$arr["xn_new"] = $pxn;
		}

		//$sum = $arr["digital"] + $arr["10_12"] + $arr["14_14"] + $arr["NONE"];

?>
<tr>
  <td class="tb_search"><?=$i?></td>
  <td class="tb_search"><A HREF="#"onclick="if(confirm('ท่านต้องการลบข้อมูลสถิติใช้หรือไม่?')){window.location.href='?del=true&del_id=<?php echo $arr["row_id"];?> ';}">ลบ</A></td>
	<td class="tb_search"><A HREF="?edit=true&id=<?php echo $arr["row_id"];?>#blog_edit">แก้ไข</A></td>
	<td><?php echo $arr["date3"];?></td>
	<td><?php echo $arr["hn"];?></td>
	<td>&nbsp;<?php echo $arr["xn"];?>&nbsp;</td>
	<td>&nbsp;<?php echo $arr["xn_new"];?>&nbsp;</td>
	<td><?php echo $arr["ptname"];?></td>
	<td><?php echo $arr["age"];?></td>
	<td>&nbsp;<?php echo $arr["ptright"];?>&nbsp;</td>
	<td>&nbsp;<?php echo $arr["patient_from"];?>&nbsp;</td>
	<td>&nbsp;<?php echo $arr["detail"];?>&nbsp;</td>
	<td>&nbsp;<?php echo $arr["doctor"];?>&nbsp;</td>
	<td>&nbsp;<?php echo $arr["digital"];?>&nbsp;</td>
	<td>&nbsp;<?php echo $arr["10_12"];?>&nbsp;</td>
	<td>&nbsp;<?php echo $arr["14_14"];?>&nbsp;</td>
	<td>&nbsp;<?php echo $arr["NONE"];?>&nbsp;</td>
	<td>&nbsp;<?php echo $arr["remark"];?></td>
</tr>


<?php
$i++;
 }?>
</table>

</div>

<?php
	if($_GET["edit"]){
	$sql = "Select `detail` , `digital` , `10_12` , `14_14`  ,`NONE` ,`filmbk` From xray_stat where row_id = ".$_GET["id"]." limit 0,1 ";
	list($detail, $digital, $a10_12, $a14_14, $none, $filmbk) = mysql_fetch_row(mysql_query($sql));
?>
<a name="blog_edit"></a>

<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		if(document.form_edit.detail_edit.value==""){
			alert("กรุณาใส่ข้อมูล 'ตรวจ' ด้วยครับ ");
			return false;
		}else if((document.form_edit.edit_digital.value=="" || document.form_edit.edit_digital.value=="0") && (document.form_edit.edit10_12.value=="" || document.form_edit.edit10_12.value=="0") && (document.form_edit.edit14_14.value=="" || document.form_edit.edit14_14.value=="0") && (document.form_edit.edit_none.value=="" || document.form_edit.edit_none.value=="0")){
			alert("กรุณาใส่จำนวนของฟิล์ม  ด้วยครับ ");
			return false;
		}

	}

</SCRIPT>
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FF0000" class="tb_search">
  <tr>
    <td>

<form action="" name="form_edit" method="post" onSubmit="return checkForm();">
<TABLE align="center">
<TR bgcolor="#FF0000">
  <TD colspan="2" align="right" class="font_tb style1">แก้ไขข้อมูล</TD>
  </TR>
<TR>
	<TD align="right" class="font_tb">ตรวจ : </TD>
	<TD><textarea name="detail_edit" cols="50" rows="8"><?php echo $detail;?></textarea></TD>
</TR>
<TR>
	<TD align="right" class="font_tb">digital : </TD>
	<TD><input name="edit_digital" type="text" value="<?php echo $digital;?>" size="3" maxlength="3"></TD>
</TR>
<TR>
	<TD align="right" class="font_tb">10 X 12 : </TD>
	<TD><input name="edit10_12" type="text" value="<?php echo $a10_12;?>" size="3" maxlength="3"></TD>
</TR>
<TR>
	<TD align="right" class="font_tb">14 X 14 : </TD>
	<TD><input name="edit14_14" type="text" value="<?php echo $a14_14;?>" size="3" maxlength="3"></TD>
</TR>
<TR>
	<TD align="right" class="font_tb">NONE : </TD>
	<TD><input name="edit_none" type="text" value="<?php echo $none;?>" size="3" maxlength="3"></TD>
</TR>
<TR>
  <TD align="right" class="font_tb">ฟิล์มเสีย</TD>
  <TD><input name="edit_filmbk" type="text" id="edit_filmbk" value="<?php echo $filmbk;?>" size="3" maxlength="3"></TD>
</TR>
<TR>
	<TD colspan="2" align="center"><input type="submit" name="Submit_edit" value="แก้ไขข้อมูล">&nbsp;<input name="cancle" type="button" value="ยกเลิก" onClick="window.location.href='xraylst.php';">
	  <input name="id" type="hidden" id="id" value="<?php echo $_GET["id"];?>"></TD>
</TR>
</TABLE>
</form>
</td>
  </tr>
</table>
<?php
	}else{
	echo '<a name="blog_add"></a>';
	include("xraylst_add.php");

} 

include("xraylst2.php");
?>
 

</body>
<?php
include("unconnect.inc");
?>