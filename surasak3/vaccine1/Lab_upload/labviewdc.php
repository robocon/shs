<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p class="forntsarabun">ดูผล LAB ชิ้นเนื้อ</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="hn" type="text" class="forntsarabun" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="B1" type="submit" class="forntsarabun" value="      ตกลง      "> <a target=_self  href='../../../nindex.htm' class="forntsarabun">&lt;&lt;กลับเมนู</a></p>
</form>

   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
 <tr bgcolor="#0099FF">
  <th>วันและเวลา</th>
  <th>HN</th>
  <th>AN</th>
  <th>ชื่อ-สกุล</th>
  <th>รายการ</th>
 
  <th>ดูไฟล์</th>
 </tr>

<?php
if(!empty($hn)){
   include("../Connections/connect.inc.php"); 
   
    $query = "SELECT * FROM patdata as a ,  labcare  as b  WHERE  a.code=b.code and a.hn = '$hn' and a.depart='patho' and b.labtype !='IN'  Order by date desc";
    $result = mysql_query($query) or die("Query failed");
	

    while ($dbarr= mysql_fetch_array($result)) {
		
		$filename=$dbarr[0].'.pdf';
		$filename1=$dbarr[0].'.jpg';
		
        echo " <tr class=\"forntsarabun\">
				 <td>$dbarr[date]</td>
				  <td>$dbarr[hn]</td>
				  <td>$dbarr[an]</td>
				  <td>$dbarr[ptname]</td>
 				  <td>$dbarr[detail]</td>";

if(file_exists("dcorder/$filename")){
	
	echo   "<td><a href=\"dcorder/$filename\" target='_blank'>ดูไฟล์ $filename</a></td>";
		
}elseif(file_exists("dcorder/$filename1")){

	echo   "<td><a href=\"dcorder/$filename1\" target='_blank'>ดูไฟล์ $filename1</a></td>";
}else{
	echo   "<td>ไม่มีไฟล์</td>";
}
	echo "</tr>";
       }
}
?>
</table>
