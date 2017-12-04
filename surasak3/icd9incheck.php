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
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายชื่อผู้ป่วยตาม ICD9CM</p>
<form method="post" action="<?php echo $PHP_SELF ?>">

<TABLE>
<TR>
	<TD align="right">ICD9CM :</TD>
	<TD><input type="text" name="icd9cm" size="20"></TD>
</TR>

<TR>
	<TD align="right" valign="top">การเรียกข้อมูล :</TD>
	<TD><INPUT TYPE="radio" NAME="type" value="1" onclick="hidden_style('1');" checked> เจาะจงเป็น ปี, เดือน หรือ วัน <BR><INPUT TYPE="radio" NAME="type" value="2"  onclick="hidden_style('2');"> เลือกเป็นช่วง </TD>
</TR>
<TR id="row1">
	<TD align="right" valign="top">ปี :</TD>
	<TD><input type="text" name="thiyr" size="10"> <BR>*ถ้าต้องการเลือกเดือนหรือวันด้วย ให้ใส่ปีและตามด้วยเดือนและวัน เช่น 2550-06-03 เป็นต้น</TD>
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
 
<th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>ICD9</th>
 
 
<th bgcolor=CD853F>HN</th>
 

 <th bgcolor=CD853F>ชื่อ-สกุล</th>
  
<th bgcolor=CD853F>โรค</th>

 <th bgcolor=CD853F>ICD10</th>
  <th bgcolor=CD853F>ICD10 (โรครอง)</th>
  
<th bgcolor=CD853F>วันนอน</th>

<th bgcolor=CD853F>วันจำหน่าย</th>
<th bgcolor=CD853F>รวมวันนอน</th>
<th bgcolor=CD853F>แพทย์</th>

<th bgcolor=CD853F>D/C Type</th>

</tr>

<?php
 

  $num=0;
If (!empty($icd9cm)){
    include("connect.inc");
    global $icd9cm;
   
if($_POST["type"] == "2"){
	$where = " and (admdate between '".($_POST["start_year"])."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".($_POST["end_year"])."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:00' ) ";
}else{
	$where = " and admdate LIKE '$thiyr%' ";
}



 $query = "SELECT an,icd9cm,admdate FROM ipicd9cm WHERE icd9cm LIKE '%$icd9cm%'   ".$where." Order by  admdate ASC  ";

    $result = mysql_query($query)
        or die("Query failed");

   
 while (list ($an,$icd9cm,$admdate) = mysql_fetch_row ($result)) 	  
{
        $Total =$Total+$amount; 


$sql = "Select date,hn,an,ptname,diag,icd10, comorbid,dcdate,dctype,days,doctor FROM ipcard where an='$an'  limit 1";
$result3 = Mysql_Query($sql);
list($date,$hn,$an1,$ptname,$diag,$icd10,$comorbid,$dcdate,$dctype,$days,$doctor) = Mysql_fetch_row($result3);



 $num++;

 print (" <tr>\n".

       
       "  <td BGCOLOR=F5DEB3>$num</td>\n".
 
"  <td BGCOLOR=F5DEB3>$an</td>\n".
   
  "  <td BGCOLOR=F5DEB3>$icd9cm</td>\n".
	
"  <td BGCOLOR=F5DEB3>$hn</td>\n".

 "  <td BGCOLOR=F5DEB3>$ptname</a></td>\n".
     
      "  <td BGCOLOR=F5DEB3>$diag</td>\n".
    
  "  <td BGCOLOR=F5DEB3>$icd10</td>\n".
  "  <td BGCOLOR=F5DEB3>$comorbid</td>\n".
 "  <td BGCOLOR=F5DEB3>$date</td>\n".
"  <td BGCOLOR=F5DEB3>$dcdate</td>\n".
	  "  <td BGCOLOR=F5DEB3>$days</td>\n".
	  "  <td BGCOLOR=F5DEB3>$doctor</td>\n".
	"  <td BGCOLOR=F5DEB3>$dctype</td>\n".
       

       
         " </tr>\n");

	    
       }


include("unconnect.inc");
       }
?>
</table>

