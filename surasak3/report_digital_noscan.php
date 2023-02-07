<?php
include("connect.inc");  
session_start();
?>
<style>
body {
	background-color: #FDEDEC;
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
  background-color: white;
  color: black;
  border: 2px solid #2980B9;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  width: 5em;  
  
}

a:visited {
  background-color: #229954;
  color: white;
  border: 2px solid #229954;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-weight:bold;
}

a:hover, a:active {
  background-color: #85C1E9;
  color: #000000;
  font-weight:bold;
}
	
</style>
<title>ไม่ได้อัพโหลดประวัติการรักษา</title>
<?php
	print "<strong class=\"txtsarabun\" style='font-size:28px;'>ข้อมูลป่วยนอกที่ไม่ได้อัพโหลดประวัติการรักษา</strong>";
?>
<? 
	$date=$_GET["getdate"];
	
	list($y,$m,$d)=explode("-",$date);
	$showdate="$d/$m/$y";
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
    $num=0;

	$query = "SELECT row_id,thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd,officer2 FROM opday WHERE thidate like '$date%' ORDER BY toborow,thidate ASC ";
	echo "<div style='font-size:22px;'>ข้อมูลทั้งหมดที่ลงทะเบียน วันที่ $showdate</div>";	
	//echo $query;
	$result = mysql_query($query)
        or die("Query failed");


    while (list ($row_id,$thidate,$thdatehn,$ptname,$hn,$ptright,$doctor,$vn,$clinic,$toborow,$an,$icd10,$diag,$dxgroup,$goup,$okopd,$office) = mysql_fetch_row ($result)) {
        
        $time=substr($thidate,11);		


	$sql111 = "Select row_id From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($opcard_id) = Mysql_fetch_row($result111);

	$sql112 = "Select opday_id From digital_opcard where opcard_id='$opcard_id' and last_update LIKE '$regisdate_en%' group by opcard_id order by row_id desc limit 1 ";
	//echo "Pt: $hn==>".$sql112."<br>";
	$result112 = Mysql_Query($sql112);
	$numapp=mysql_num_rows($result112);
	list($opday_id) = Mysql_fetch_row($result112);

		if($opday_id==$row_id){
			$num++;
		$statusicd10="#FFFFFF";	
	
        print (" <tr BGCOLOR='$statusicd10'>\n".
           "  <td align='center'>$num</td>\n".
           "  <td>$time</td>\n".
           "  <td>$ptname</td>\n".
           "  <td align='center'>$hn</td>\n".
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