<?php
include("connect.inc");  
session_start();
?>
<style>
body {
	background-color: #D0ECE7;
    font-family: "TH SarabunPSK";
    font-size: 20px;
    }
	
table, th, td {
     border: 1px solid black;
	 border-collapse: collapse;  //กรอบด้านในหายไป
}.

th {
  height: 100px;    //ความสูงแต่ละแถว
}
	
.txtsarabun {
font-family:"TH SarabunPSK";
font-size:20px;
}	
.style2 {
	font-family:"TH SarabunPSK";
	font-size: 20px;
	}
	
a:link{
  text-decoration: none; 
}

	
</style>
<title>อัพโหลดประวัติการรักษา</title>
<?php
	print "<strong class=\"txtsarabun\" style='font-size:28px;'>ข้อมูลป่วยนอกที่อัพโหลดประวัติการรักษาเรียบร้อย</strong>";
?>
<? 
	$date=$_GET["getdate"];
	
	list($y,$m,$d)=explode("-",$date);
	$showdate="$d/$m/$y";
	
	$yy=$y-543;
	$regisdate_en="$yy-$m-$d";
?>
<div style="margin-left:50px;">
<table border="0" width="90%" bordercolor="#000000">
 <tr>
  <th bgcolor="#2980B9">#</th>
  <th bgcolor="#2980B9">เวลา</th>
  <th bgcolor="#2980B9">ชื่อ</th>
  <th bgcolor="#2980B9" width="7%">HN</th>
  <th bgcolor="#2980B9">VN</th>
  <th bgcolor="#2980B9">AN</th>
  <th bgcolor="#2980B9">สิทธิ</th>
  <th bgcolor="#2980B9">การมาโรงพยาบาล</th>
  <th bgcolor="#2980B9">แพทย์</th>
  <th bgcolor="#2980B9">คลินิก</th>
 </tr>

<?php
	echo "<div style='font-size:22px;'>ข้อมูลทั้งหมดที่ลงทะเบียน วันที่ $showdate</div>";	
    $i=0;


	$query="Select opcard_id,opday_id From digital_opcard where last_update LIKE '$regisdate_en%' group by opcard_id";
	//echo $query;
	$result = mysql_query($query)or die("Query failed");
	$num=mysql_num_rows($result);
	//echo "Num ".$num;
    while($rows=mysql_fetch_array($result)){
        $opday_id=$rows["opday_id"];
	$sql111 = "SELECT row_id,thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd,officer2 FROM opday WHERE thidate like '$date%' and row_id='$opday_id' LIMIT 0,1";
	//echo $sql111."<br>";	
	$result111 = mysql_query($sql111)or die("Query failed");
	list ($row_id,$thidate,$thdatehn,$ptname,$hn,$ptright,$doctor,$vn,$clinic,$toborow,$an,$icd10,$diag,$dxgroup,$goup,$okopd,$office) = mysql_fetch_row($result111);	
		$time=substr($thidate,11);	
		
		$statusicd10="#FFFFFF";	
		if($opday_id==$row_id){
		$i++;
        print (" <tr BGCOLOR='$statusicd10'>\n".
           "  <td align='center'>$i</td>\n".
           "  <td>$time</td>\n".
           "  <td>$ptname</td>\n".
           "  <td align='center'><a href='dt_paperLess.php?hn=$hn' target='_blank'>$hn</a></td>\n".
           "  <td align='center'>$vn</td>\n".
		   "  <td>$an</td>\n".
		   "  <td>$ptright</td>\n".
		   "  <td>$toborow</td>\n".
   		   "  <td>$doctor</td>\n".
		   "  <td>$clinic</td>\n".	   
		   " </tr>\n");
		}   
	}   
    include("unconnect.inc");
?>
</table>

</div>