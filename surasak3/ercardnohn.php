
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>โปรแกรมบันทึกข้อมูล  โรค/หัตถการ ห้องฉุกเฉิน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p></p>
  <p>กดที่ HN ให้รหัสโรคผู้ป่วยนอก</p>
  <p>ค้นหาคนไข้จาก&nbsp; HN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hnno" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ตกลง  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  " name="B2"></p>

</form>
<?php

    $today="$d-$m-$yr";

       $today="$yr-$m-$d";

?>
<table>

 <tr>

 
 <th bgcolor=6495ED>#</th> 
<th bgcolor=6495ED>วัน</th>

 
 <th bgcolor=6495ED>เวลา</th>

  
<th bgcolor=6495ED>HN</th>


  <th bgcolor=6495ED>ชื่อ</th>


  <th bgcolor=6495ED>AN</th>

 
 <th bgcolor=6495ED>โรคจากOPD</th>

  
<th bgcolor=6495ED>แพทย์</th>

 
 <th bgcolor=6495ED><font face='Angsana New'>ลงรายการER</th>

  </tr>




<?php

   
If (!empty($hnno)){
    include("connect.inc");
    global $hnno;
 $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,doctor,erok FROM opday WHERE erok='N'and hn ='$hnno' ";

   
 $result = mysql_query($query)

        or die("Query failed");



   
 while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$doctor,$erok) = mysql_fetch_row ($result)) {

     
   $time=substr($thidate,11);
	
$num++;

       
 print (" <tr>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".

    
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$thidate</td>\n".

   
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".

      
     "  <td BGCOLOR=66CDAA><font face='Angsana New'><a   href=\"dxeredit.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cGoup=$goup&cDxg=$dxgroup&cIcd10=$icd10&cVn=$vn\">$hn</td>\n".

        
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</a></td>\n".

       
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".

     
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".

     
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".

      
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$erok</td>\n".

   
        " </tr>\n");

       }

   
include("unconnect.inc");
       }
?>
</table>