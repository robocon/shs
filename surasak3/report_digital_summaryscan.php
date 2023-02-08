<?php
include("connect.inc");  
session_start();
?>
<style>
body {
	background-color: #FEF5E7;
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
<title>อัพโหลดสรุปประวัติการรักษา</title>
<?php
	print "<strong class=\"txtsarabun\" style='font-size:28px;'>ข้อมูลป่วยนอกที่อัพโหลดสรุปประวัติการรักษาเรียบร้อย</strong>";
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

	$query="SELECT row_id,thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd,officer2 FROM opday WHERE thidate like '$date%' ORDER BY thidate ASC";
	//echo $query;
	$result = mysql_query($query)or die("Query failed");
	$num=mysql_num_rows($result);
	//echo "Num ".$num;
    while(list ($row_id,$thidate,$thdatehn,$ptname,$hn,$ptright,$doctor,$vn,$clinic,$toborow,$an,$icd10,$diag,$dxgroup,$goup,$okopd,$office)= mysql_fetch_row($result)){
      
	  $time=substr($thidate,11);	
	  
	$sql111 = "Select row_id From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($opcard_id) = Mysql_fetch_row($result111);

	$sql112 = "Select last_update,opday_id From digital_opcard where opcard_id='$opcard_id' and last_update LIKE '$regisdate_en%' order by opday_id desc limit 1 ";
	//echo "Pt: $hn==>".$sql112."<br>";
	$result112 = Mysql_Query($sql112);
	$numapp=mysql_num_rows($result112);
	list($last_update,$opday_id) = Mysql_fetch_row($result112);
	
	$sql113 = "Select count(row_id) as countfile From digital_opcard where opcard_id='$opcard_id' and last_update LIKE '$regisdate_en%'";
	//echo "Pt: $hn==>".$sql113."<br>";
	$result113 = Mysql_Query($sql113);
	$numapp=mysql_num_rows($result113);
	list($countfile) = Mysql_fetch_row($result113);	

		
		$statusicd10="#FFFFFF";	
		if($opday_id==0 && $countfile > 0){
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