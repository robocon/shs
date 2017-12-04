<form method="post" action="
<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;รายชื่อผู้ป่วยตาม ICD 10 หลัก&nbsp;&nbsp;&nbsp;
  
<input type="text" name="icd10" size="20">&nbsp;&nbsp;
<font face="Angsana New">&nbsp;&nbsp; 
ปี&nbsp;
  <input type="text" name="thiyr" size="10"> <br>ถ้าต้องการเลือกเดือนหรือวันด้วย ให้ใส่ปีและตามด้วยเดือนและวัน เช่น 2550-06-03 เป็นต้น
</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
 <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>


<table>

 <tr>

  <th bgcolor=CD853F>#</th>
 

  <th bgcolor=CD853F>วัน-เวลา</th>
 
<th bgcolor=CD853F>HN</th>
 
 <th bgcolor=CD853F>ชื่อ-สกุล</th>
  
<th bgcolor=CD853F>โรค</th>

  <th bgcolor=CD853F>ICD10 หลัก</th>
    <th bgcolor=CD853F>ICD10 รอง</th>
  

  <th bgcolor=CD853F>ปัตร ปชช.</th>
  <th bgcolor=CD853F>ที่อยุ่</th>
  <th bgcolor=CD853F>ตำบล</th>
  <th bgcolor=CD853F>อำเภอ</th>
  <th bgcolor=CD853F>จังหวัด</th>
  <th bgcolor=CD853F>โทรศัพท์</th>
  
</tr>


<?php
 

  $num=0;
If (!empty($icd10)){
    include("connect.inc");
    global $icd10;
   

 $query = "SELECT a.hn,a.an,a.ptname,a.date,b.sex FROM ipcard as a, opcard as b WHERE a.hn=b.hn and a.date LIKE '$thiyr%' and b.sex='ญ' ORDER by b.sex  ";
    $result = mysql_query($query)
        or die("Query failed");

   
 while (list ($hn,$an,$ptname,$date,$sex) = mysql_fetch_row ($result)) 
{
        $Total =$Total+$amount; 


 $num++;



 print (" <tr>\n".

       
       "  <td BGCOLOR=F5DEB3>$num</td>\n".
   
       "  <td BGCOLOR=F5DEB3>$hn</td>\n".
   
    "  <td BGCOLOR=F5DEB3>$an</td>\n".
  
   "  <td BGCOLOR=F5DEB3>$ptname</a></td>\n".
     
      "  <td BGCOLOR=F5DEB3>$date</td>\n".
    
  "  <td BGCOLOR=F5DEB3>$sex</td>\n".
      
  
      
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

