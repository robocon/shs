<form method="post" action="<?php echo $PHP_SELF ?>">
  <p >ตรวจสอบ LAB</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1"> <a target=_self  href='../../../nindex.htm'>&lt;&lt;กลับเมนู</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F>วันและเวลา</th>
  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>ชื่อ-สกุล</th>
  <th bgcolor=CD853F>รายการ</th>
  <th bgcolor=CD853F>อัพโหลดไฟล์</th>
  <th bgcolor=CD853F>ดูไฟล์</th>
 </tr>

<?php
if(!empty($hn)){
   include("../Connections/connect.inc.php"); 
   
    $query = "SELECT * FROM patdata as a ,  labcare  as b  WHERE  a.code=b.code and a.hn = '$hn' and a.depart='patho' and b.labtype !='IN'  Order by date desc";
    $result = mysql_query($query) or die("Query failed");
	

    while ($dbarr= mysql_fetch_array($result)) {
		
		$filename=$dbarr[0].'.pdf';
		$filename1=$dbarr[0].'.jpg';
		
        echo " <tr>
				 <td BGCOLOR=F5DEB3>$dbarr[date]</td>
				  <td BGCOLOR=F5DEB3>$dbarr[hn]</td>
				  <td BGCOLOR=F5DEB3>$dbarr[an]</td>
				  <td BGCOLOR=F5DEB3>$dbarr[ptname]</td>
 				  <td BGCOLOR=F5DEB3>$dbarr[detail]</td>
                 
                  <td BGCOLOR=F5DEB3><a href=\"upload.php?id=$dbarr[0]\">อัพโหลด</a></td>";

if(file_exists("dcorder/$filename")){
	
	    echo   "<td BGCOLOR=F5DEB3><a href=\"dcorder/$filename\" target='_blank'>ดูไฟล์ $filename</a></td>";
		
}elseif(file_exists("dcorder/$filename1")){

		  echo   "<td BGCOLOR=F5DEB3><a href=\"dcorder/$filename1\" target='_blank'>ดูไฟล์ $filename1</a></td>";
}else{
	echo   "<td BGCOLOR=F5DEB3>ไม่มีไฟล์</td>";
}

     	echo "</tr>";
       }
}
?>
</table>
