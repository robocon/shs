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


<style>
	.font_tr{ font-family:"Angsana New"; font-size:20px; background-color:"#F5DEB3"; }
	.font_hd{ font-family:"Angsana New"; font-size:20px; background-color:"#CD853F"; }
</style>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายชื่อผู้มาขอใบรับรองงดเกณฑ์ทหาร</p>
<form name="ff1" method="post" action="<?php echo $PHP_SELF ?>">

<TABLE>


<TR id="row2" >
	<TD align="right">ตั้งแต่วันที่ :</TD>
	<TD>
		<INPUT TYPE="text" NAME="start_day" value="<?php if(isset($_POST["start_day"])) echo $_POST["start_day"]; else echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			if($_POST["start_month"] == $value){ echo " Selected ";}
			 else if( !isset($_POST["start_month"]) && date("m") == $value){ echo " Selected ";}
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php if(isset($_POST["start_year"])) echo $_POST["start_year"]; else echo date("Y")+543;?>"  size="4" maxlength="4">
	</TD>
</TR>
<TR id="row3">
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
		<INPUT TYPE="text" NAME="end_year" value="<?php if(isset($_POST["end_year"])) echo $_POST["end_year"]; else echo date("Y")+543;?>"  size="4" maxlength="4"></TD>
</TR>
</TABLE>
 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
 <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <INPUT TYPE="button" value="Print" Onclick="window.open('mc_soldier_print.php?sd='+document.ff1.start_year.value+'-'+document.ff1.start_month.value+'-'+document.ff1.start_day.value+'&ed='+document.ff1.end_year.value+'-'+document.ff1.end_month.value+'-'+document.ff1.end_day.value+'');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>
<table>
 <tr class="font_hd">
<th height="58">ลำดับ</th>
<th>ชื่อ-สกุล</th>
<th>โรคที่ตรวจพบ</th>
<th>ตามกฏทรวงฉบับที่ ๗๔ พ.ศ. ๒๕๔๐<br />
  และฉบับแก้ไขที่ ๗๖ พ.ศ. ๒๕๕๕</th>
<th>คณะแพทย์ผู้ตรวจ</th>
<th>ภูมิลำเนาทหาร</th>
<th>ว.ด.ป. ที่รับการตรวจ</th>
<th>เพิ่ม/แก้ไขข้อมูล</th>
</tr>

<?php

  $num=0;
If (!empty($B1)){
    include("connect.inc");


$where = " AND (thidate between '".($_POST["start_year"])."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".($_POST["end_year"])."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:59' ) ";

 $sql = "SELECT row_id, date_format(thidate,'%d-%m-%Y'), hn, ptname, organ, dx_mc_soldier, dr1_mc_soldier, dr2_mc_soldier, dr3_mc_soldier,address,thdatehn,rule FROM opd WHERE ((organ LIKE '%รับรอง%' AND organ LIKE '%ทหาร%' AND organ LIKE '%เกณ%' ) OR (organ LIKE '%รับรอง%' AND organ LIKE '%เลือกทหาร%' ) OR toborow like 'EX30%') ".$where." Order by  thidate ASC ";
//echo $sql;
    $result = mysql_query($sql) or die("Query failed ".mysql_error());

   
 while (list ($row_id, $date,$hn,$ptname,$organ, $dx_mc_soldier, $dr1_mc_soldier, $dr2_mc_soldier, $dr3_mc_soldier,$address1,$thdatehn,$rule) = mysql_fetch_row ($result)) 
{
        $Total =$Total+$amount; 
	list($address) = mysql_fetch_row(mysql_query("Select concat(address,' ', tambol,' ',  ampur,' ',  changwat  ) From opcard where hn = '".$hn."' limit 0,1 "));
	$thdatehn=substr($thdatehn,0,10);
 $num++;

 print (" <tr class=\"font_tr\">\n".
"  <td>$num</td>\n".
"  <td>$ptname</a></td>\n".
"  <td>$dx_mc_soldier</td>\n".
"  <td>$rule</td>\n".
"  <td>".substr($dr1_mc_soldier,5)."<BR>".substr($dr2_mc_soldier,5)."<BR>".substr($dr3_mc_soldier,5)."</td>\n".
"  <td>$address1</td>\n".
"  <td>$thdatehn</td>\n".
"  <td><A HREF=\"edit_report_mc.php?id=".$row_id."\" target=\"_blank\">เพิ่ม/แก้ไขข้อมูล</A></td>\n".
 " </tr>\n");

	      

 }


include("unconnect.inc");
}
?>
</table>
<?php

//include("add_report_mc.php");

?>


