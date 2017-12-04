<?php
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>รพ.ค่ายสุรศักดิ์มนตรี</TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<style>
body{
	font-family:"Angsana New"; font-size:20px; 
}
	.font_tr{ font-family:"Angsana New"; font-size:20px; background-color:"#F5DEB3";text-align: center; }
	.font_hd{ font-family:"Angsana New"; font-size:20px; background-color:"#004080"; color:#FFFFFF; }
</style>
</HEAD>

<BODY>

<FORM METHOD=POST ACTION="">
<TABLE>
<TR >
	<TD align="right">ตั้งแต่วันที่ :</TD>
	<TD>
		<INPUT TYPE="text" NAME="start_day" value="<?php if(isset($_POST["start_day"])) echo $_POST["start_day"]; else echo "1";?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			if($_POST["start_month"] == $value){ echo " Selected ";}
			 else if( !isset($_POST["start_month"]) && date("m") == $value){ echo " Selected ";}
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<SELECT NAME="start_year">
		<?php
		for($i=date("Y");$i>date("Y")-5;$i--){
			echo "<OPTION VALUE=\"",$i,"\" ";
			if($_POST["start_year"] == $i){ echo " Selected ";}
			 else if( !isset($_POST["start_month"]) && date("m") == $i){ echo " Selected ";}
			echo ">",$i+543;
			
			}	?>
			
		</SELECT>

	</TD>
</TR>
<TR >
	<TD align="right">ถึงวันที่ :</TD>
	<TD><INPUT TYPE="text" NAME="end_day" value="<?php if(isset($_POST["end_day"])) echo $_POST["end_day"]; else echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="end_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if($_POST["end_month"] == $value){ echo " Selected ";}
			 else if( !isset($_POST["end_month"]) && date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<SELECT NAME="end_year">
		<?php
		for($i=date("Y");$i>date("Y")-5;$i--){
			echo "<OPTION VALUE=\"",$i,"\" ";
			if($_POST["end_year"] == $i){ echo " Selected ";}
			 else if( !isset($_POST["end_year"]) && date("m") == $i){ echo " Selected ";}
			echo ">",$i+543;
			
			}	?>
			
		</SELECT>
		</TD>
</TR>
<TR>
	<TD align="right">รหัสยา :</TD>
	<TD><INPUT TYPE="text" NAME="drugcode" size="15" value="<?php echo $_POST["drugcode"];?>"></TD>
</TR>
<TR>
	<TD align="center" colspan="2"><INPUT TYPE="submit" value="ตกลง"></TD>
</TR>
</TABLE>
</FORM>

 <a target=_self  href='../nindex.htm'> &lt;&lt; ไปเมนู</a></p>

 <?php
 if(!empty($_POST["end_day"]) && !empty($_POST["start_day"])){

	 $i=1;
 ?>
<table width="710">
 <tr class="font_hd">
	<th width="10">ลำดับ</th>
	<th width="150">วันที่ตัดยา</th>
	<th width="100">รหัสยา</th>
	<th width="250">ชื่อยา</th>
	<th width="150">จำนวนที่เบิก</th>
	<th width="50">ราคาทุน</th>
	<th width="50">ราคาขาย</th>
	<th width="150">มูลค่ายา</th>
</tr>
<?php
	
	$where = "  (date between '".($_POST["start_year"])."-".$_POST["start_month"]."-".$_POST["start_day"]."' AND '".($_POST["end_year"])."-".$_POST["end_month"]."-".$_POST["end_day"]."' ) ";
	
	if(trim($_POST["drugcode"]) != ""){
		$where .= " AND drugcode like '".$_POST["drugcode"]."%' ";
	}

	$sql = "Select date_format(`date`,'%d-%m-') as date_title, date_format(`date`,'%Y') as date_last, `drugcode`, tradname, sum(stkcut) as sum_stkcut, unitpri From stktranx where ".$where." group by `drugcode`, `date` Order by `date` ASC ";

	$result = mysql_query($sql) or die(mysql_error());
	while($arr = mysql_fetch_assoc($result)){
	
	list($salepri, $unitpri) = mysql_fetch_row(mysql_query("Select salepri, unitpri From druglst where drugcode = '".$arr["drugcode"]."' limit 0,1 "));
?>
 <tr class="font_tr">
	<td ><?php echo $i;?></td>
	<td ><?php echo $arr["date_title"],($arr["date_last"]+543);?></td>
	<td><?php echo $arr["drugcode"];?></td>
	<td><?php echo $arr["tradname"];?></td>
	<td><?php echo $arr["sum_stkcut"];?></td>
	<td><?php echo $unitpri;?></td>
	<td><?php echo $salepri;?></td>
	
	<td><?php echo $arr["sum_stkcut"]*$unitpri;?></td>
</tr>
<?php
	$i++;
	}	
?>
</table>
<?php
 }	
?>
</BODY>
</HTML>
