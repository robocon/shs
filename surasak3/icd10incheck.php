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
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายชื่อผู้ป่วยตาม ICD 10</p>
<form method="post" action="<?php echo $PHP_SELF ?>">

<TABLE>
<TR>
	<TD align="right">ICD10 หลัก :</TD>
	<TD><input type="text" name="icd10" size="20"></TD>
</TR>
<TR>
	<TD align="right">ICD10 รอง :</TD>
	<TD><input type="text" name="icd101" size="20"></TD>
</TR>
<TR>
  <TD align="right">ICD โรคแทรก</TD>
  <TD><input type="text" name="icd102" size="20"/></TD>
</TR>
<TR>
	<TD align="right" valign="top">การเรียกข้อมูล :</TD>
	<TD><INPUT TYPE="radio" NAME="type" value="1" onclick="hidden_style('1');" checked> เจาะจงเป็น ปี, เดือน หรือ วัน <BR><INPUT TYPE="radio" NAME="type" value="2"  onclick="hidden_style('2');"> เลือกเป็นช่วง </TD>
</TR>
<TR id="row1">
	<TD align="right" valign="top">ปี :</TD>
	<TD><input type="text" name="thiyr" size="10"> <BR>*ถ้าต้องการเลือกเดือนหรือวันด้วย ให้ใส่ปีและตามด้วยเดือนและวัน เช่น 2550-06-03 เป็นต้น
</TD>
</TR>
<TR id="row2" style="display:none">
	<TD align="right">ตั้งแต่วันที่ :</TD>
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
<TR id="row3" style="display:none">
	<TD align="right">ถึงวันที่ :</TD>
	<TD><INPUT TYPE="text" NAME="end_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="end_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="end_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD>
</TR>
</TABLE>
<BR>สิทธิ์ : 
<select  name='ptright'>
 <option value='' >ดูทั้งหมด</option>
 <option value='R01' >R01&nbsp;เงินสด</option>
 <option value='R02' >R02&nbsp;เบิกคลังจังหวัด</option>
 <option value='R03' >R03&nbsp;โครงการเบิกจ่ายตรง</option>
 <option value='R04' >R04&nbsp;รัฐวิสาหกิจ</option>
 <option value='R05' >R05&nbsp;บริษัท(มหาชน)</option>
 <option value='R06' >R06&nbsp;พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ</option>
 <option value='R07' >R07&nbsp;ประกันสังคม</option>
 <option value='R08' >R08&nbsp;ก.ท.44(บาดเจ็บในงาน)</option>
 <option value='R09' >R09&nbsp;ประกันสุขภาพถ้วนหน้า</option>
 <option value='R10' >R10&nbsp;ประกันสุขภาพถ้วนหน้า(เด็กเกิดใหม่)</option>
 <option value='R11' >R11&nbsp;ประกันสุขภาพถ้วนหน้า(มาตรา8)</option>
 <option value='R12' >R12&nbsp;ประกันสุขภาพถ้วนหน้า(ทหารผ่านศึก/ผู้พิการ)</option>
 <option value='R13' >R13&nbsp;ประกันสุขภาพถ้วนหน้า(ในจังหวักฉุกเฉิน)</option>
 <option value='R14' >R17&nbsp;ประกันสุขภาพถ้วนหน้า(นอกจังหวัดฉุกเฉิน)</option>
 <option value='R15' >R15&nbsp;ประกันสุขภาพนักเรียน(บริษัท)</option>
 <option value='R16' >R16&nbsp;ศึกษาธิการ(ครูเอกชน)</option>
 <option value='R17' >R17&nbsp;พลทหาร</option>
 <option value='R18' >R18&nbsp;โครงการรักษาโรคไต (HD)</option>
 <option value='R19' >R19&nbsp;โครงการนภา(NAPA)</option>
 <option value='R20' >R20&nbsp;ประกันสังคมกรณีคลอดบุตร</option>
 <option value='R21' >R21&nbsp;องค์กรปกครองส่วนท้องถิ่น</option>
 <option value='R22' >R22&nbsp;ตรวจสุขภาพประจำปีกองทัพบก</option>
 <option value='R23' >R23&nbsp;นักเรียน/นักศึกษาทหาร</option>
 </select> <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
 <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function hidden_style(xxx){

			document.getElementById('row1').style.display = 'none';
			document.getElementById('row2').style.display = 'none';
			document.getElementById('row3').style.display = 'none';
			
			if(xxx == 1){
				document.getElementById('row1').style.display = '';
			}else{
				document.getElementById('row2').style.display = '';
				document.getElementById('row3').style.display = '';
			}
	}

//-->
</SCRIPT>

<table>
 <tr>



  <th bgcolor=CD853F>#</th>
 

  <th bgcolor=CD853F>วัน-เวลา</th>
 
<th bgcolor=CD853F>HN</th>
 
<th bgcolor=CD853F>AN</th>
 
 <th bgcolor=CD853F>ชื่อ-สกุล</th>
  
<th bgcolor=CD853F>โรค</th>

  <th bgcolor=CD853F>ICD10</th>
  <th bgcolor=CD853F>ICD10 (โรครอง)</th>
  <th bgcolor=CD853F>ICD10 (โรคแทรก)</th>
  
<th bgcolor=CD853F>วันจำหน่าย</th>
<th bgcolor=CD853F>D/C Type</th>
</tr>

<?php
 

  $num=0;
If (!empty($B1)){
    include("connect.inc");
    global $icd10;
	
	$icd101=$_POST['icd101'];
	$icd102=$_POST['icd102'];
	
	
   
if($_POST["type"] == "2"){
	$where = " and (date between '".($_POST["start_year"])."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".($_POST["end_year"])."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:00' ) ";
}else{
	$where = " and date LIKE '$thiyr%' ";
}

if($_POST["ptright"] != ""){
	$where = " and ptright LIKE '".$_POST["ptright"]."%' ";
}
/*
else if($icd10!='' && $icd101!=''){ // ช่อง 1,2 ไม่ว่าง
$where1="(icd10 LIKE '%$icd10%'' AND  comorbid LIKE '%$icd101%')" ;	
}else if($icd101!='' && $icd102!=''){// ช่อง 2,3 ไม่ว่าง
$where1="(comorbid LIKE '%$icd101%'' AND  complica LIKE '%$icd102%')" ;	
}else if($icd10!='' && $icd102!=''){// ช่อง1,3 ไม่ว่าง
$where1="(icd10 LIKE '%$icd10%'' AND  complica LIKE '%$icd102%')" ;	
}*/

if( $icd10!='' || $icd101!='' || $icd102!=''){ 
$where1="(icd10 LIKE '%$icd10%' AND  comorbid LIKE '%$icd101%' AND  complica LIKE '%$icd102%')" ;	
}else{
$where1="1 ";
}


$query = "SELECT date,hn,an,ptname,diag,icd10, comorbid,dcdate, dctype ,complica FROM ipcard WHERE ".$where1."  ".$where." Order by  date ASC ";

$result = mysql_query($query)or die("Query failed");

   
 while (list ($date,$hn,$an,$ptname,$diag,$icd10, $comorbid,$dcdate, $dctype ,$complica) = mysql_fetch_row ($result)) 
{
        $Total =$Total+$amount; 


 $num++;

 print (" <tr>\n".

       
       "  <td BGCOLOR=F5DEB3>$num</td>\n".
   
       "  <td BGCOLOR=F5DEB3>$date</td>\n".
   
    "  <td BGCOLOR=F5DEB3>$hn</td>\n".
  
"  <td BGCOLOR=F5DEB3>$an</td>\n".
  
   "  <td BGCOLOR=F5DEB3>$ptname</a></td>\n".
     
      "  <td BGCOLOR=F5DEB3>$diag</td>\n".
    
  "  <td BGCOLOR=F5DEB3>$icd10</td>\n".
  "  <td BGCOLOR=F5DEB3>$comorbid</td>\n".
   "  <td BGCOLOR=F5DEB3>$complica</td>\n".
"  <td BGCOLOR=F5DEB3>$dcdate</td>\n".
"  <td BGCOLOR=F5DEB3>$dctype</td>\n".
       
         " </tr>\n");

	      if($icd10 != ""){
				if(!isset($sum[$icd10]))
					$sum[$icd10] = 0;
				$sum[$icd10] = $sum[$icd10]+1;
			}

       }


include("unconnect.inc");
       }
?>
</table>

<BR><BR>
สรุป ICD10

<TABLE>
<TR align="center">
	<TD BGCOLOR=F5DEB3>ICD10</TD>
	<TD BGCOLOR=F5DEB3>จำนวนผู้ป่วย</TD>
</TR>
<?php
	if(count($sum) > 0){
	foreach ($sum as $key => $value){

?>
<TR>
	<TD BGCOLOR=F5DEB3><?php echo $key;?></TD>
	<TD BGCOLOR=F5DEB3><?php echo $value;?></TD>
</TR>
<?php
}	}
?>
</TABLE>
