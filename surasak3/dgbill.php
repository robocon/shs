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
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
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
	.font_tr{ font-family:"Angsana New"; font-size:20px; background-color:"#F5DEB3"; }
	.font_hd{ font-family:"Angsana New"; font-size:20px; background-color:"#004080"; color:#FFFFFF; }
</style>
</HEAD>

<BODY>

<FORM METHOD=POST ACTION="">
<TABLE>
<TR >
	<TD align="right">ตั้งแต่วันที่ :</TD>
	<TD>
		<INPUT TYPE="text" NAME="start_day" value="<?php if(isset($_POST["start_day"])) echo $_POST["start_day"]; else echo "01";?>" size="2" maxlength="2"> / 
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
	<TD align="center" colspan="2"><INPUT TYPE="submit" value="ตกลง"></TD>
</TR>
</TABLE>
</FORM>

 <a target=_self  href='../nindex.htm'> &lt;&lt; ไปเมนู</a></p>

 <?php
 if(!empty($_POST["end_day"]) && !empty($_POST["start_day"])){

	 $i=1;
 ?>
<table >
 <tr class="font_hd">
	<th width="10">ลำดับ</th>
	<th width="70">รหัส</th>
	<th width="150">ชื่อการค้า</th>
	<th width="70">Packing</th>
	<th width="70">จำนวน Pack</th>
	<th width="70">จำนวน</th>
	<th width="70">ราคา/pack รวม VAT</th>
	<th width="70">ราคาทุน</th>
	<th width="70">ราคาขาย</th>
	<th width="80">วันที่EXP</th>
	<th width="70">ราคาทั้งสิ้น</th>
   
</tr>
<?php
	
	$where = "  (getdate between '".($_POST["start_year"])."-".$_POST["start_month"]."-".$_POST["start_day"]."' AND '".($_POST["end_year"])."-".$_POST["end_month"]."-".$_POST["end_day"]."' ) ";
	


	$sql = "Select * From combill where ".$where."  Order by `getdate` ASC ";

	$result = mysql_query($sql) or die(mysql_error());
	while($arr = mysql_fetch_assoc($result)){
	
	$packpri_vat = $arr["packpri_vat"];
	if($arr["packpri_vat"] ==0)
		list($packpri_vat) = mysql_fetch_row(mysql_query("Select packpri_vat From druglst where drugcode = '".$arr["drugcode"]."' limit 0,1 "));
?>
 <tr class="font_tr">
	<td ><A HREF="dgprocure_print.php?id=<?php echo $arr["row_id"];?>" target="_blank"><?php echo $i;?></A></td>
		<td width="70"><?php echo $arr["drugcode"];?></td>
	<td width="150"><?php echo substr($arr["tradname"],0,20);?></td>
	<td align="center" ><?php echo $arr["packing"];?></td>
	<td align="center"><?php echo $arr["packamt"];?></td>
	<td align="center"><?php echo $arr["stkbak"];?></td>
	<td align="center"><?php echo $packpri_vat;?></td>
	<td align="center" ><?php echo $arr["unitpri"];?></td>
	<td align="center" ><?php echo $arr["salepri"];?></td>
	<td align="center"  width="80"><?php echo $arr["expdate"];?></td>
	<td align="center"><?php echo $arr["price"];?></th>

    
</tr>
<?php
	$i++;
	}	
?>
</table>
<?php
 }	

 include("unconnect.inc");   
?>
</BODY>
</HTML>