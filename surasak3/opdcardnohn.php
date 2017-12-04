

<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>โปรแกรมคืนบัตรผู้ป่วย  การคืนบัตรผู้ป่วย ให้คืนแค่ ครั้งเดียว โปรแกรมจะทำการ คืนบัตรให้ทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p></p>
  <p>กดที่ HN ให้รหัสโรคผู้ป่วยนอก</p>
  <p>ค้นหาคนไข้จาก&nbsp; HN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hnno" size="12"  id="aLink"  ></p>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>
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

 
 <th bgcolor=6495ED>โรค</th>
  <th bgcolor=6495ED>ออกโดย</th>

  
<th bgcolor=6495ED>แพทย์</th>

 
 <th bgcolor=6495ED><font face='Angsana New'>คืนOPD</th>

  </tr>




<?php



   
If (!empty($hnno)){
    include("connect.inc");
    global $hnno;
 $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,doctor,okopd,icd10,toborow FROM opday WHERE okopd='N'and hn ='".$_REQUEST["hnno"]."' ";

   
 $result = mysql_query($query)

        or die("Query failed");



   
 while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$doctor,$okopd,$icd10,$toborow) = mysql_fetch_row ($result)) {

     
   $time=substr($thidate,11);
	
$num++;

       
 print (" <tr>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".

    
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$thidate</td>\n".

   
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".

      
     "  <td BGCOLOR=66CDAA><font face='Angsana New'><a  href=\"dxopedit.php? cTdatehn=".urlencode($thdatehn)."&cPtname=".urlencode($ptname)."&cHn=".urlencode($hn)."&cGoup=".urlencode($goup)."&cDxg=".urlencode($dxgroup)."&cIcd10=".urlencode($icd10)."&cVn=".urlencode($vn)."\" >$hn</td>\n".

          "  <td BGCOLOR=66CDAA>$ptname</a></td>\n".

//   "  <td BGCOLOR=66CDAA><font face='Angsana New'><a   href=\"chkopd1.php? cTdatehn=".urlencode($thdatehn)."&cPtname=".urlencode($ptname)."&cHn=".urlencode($hn)."&cDoctor=".urlencode($doctor)."&cDiag=".urlencode($diag)."&cOkopd=".urlencode($okopd)."&cVn=".urlencode($vn)."\">$ptname</a></td>\n".

       
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".

     
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".

"  <td BGCOLOR=66CDAA><font face='Angsana New'>$toborow</td>\n".
     
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".

      
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$okopd</td>\n".

   
        " </tr>\n");

       }

   
include("unconnect.inc");
       }
?>
</table>
<BR><BR>
<CENTER>รายการย้อนหลัง </CENTER>
<table>

 <tr>

 
 <th bgcolor=#FFFFFF>#</th> 
<th bgcolor=#FFFFFF>วัน</th>

 


  
<th bgcolor=#FFFFFF>HN</th>




  <th bgcolor=#FFFFFF>AN</th>

 
 <th bgcolor=#FFFFFF>โรค</th>
 <th bgcolor=#FFFFFF>ออกโดย</th>

  
<th bgcolor=#FFFFFF>ICD10</th>

 
 <th bgcolor=#FFFFFF>ICD9CM</th>
  <th bgcolor=#FFFFFF>กลุ่มโรค</th>

  </tr>



<?php

   
If (!empty($hnno)){
    include("connect.inc");
    global $hnno;
	$num='0';
 $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,doctor,okopd,icd10,icd9cm,icd101,toborow,dxgroup FROM opday WHERE  hn ='".$_REQUEST["hnno"]."' ORDER BY thidate DESC  limit 20";

   
 $result = mysql_query($query)

        or die("Query failed");



   
 while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$doctor,$okopd,$icd10,$icd9cm,$icd101,$toborow,$dxgroup) = mysql_fetch_row ($result)) {

     
   $time=substr($thidate,11);
	
$num++;

$thidate1=substr($thidate,8,2);
$thidate2=substr($thidate,5,2);
$thidate3=substr($thidate,0,4);
$thidate4=$thidate1.'/'.$thidate2.'/'.$thidate3.'&nbsp;'.$time;
       
 print (" <tr>\n".

           "  <td BGCOLOR=#FFFFFF><font face='Angsana New'>$num</td>\n".

    
   "  <td BGCOLOR=#FFFFFF><font face='Angsana New'>$thidate4</td>\n".

   
 //  "  <td BGCOLOR=#FFFFFF><font face='Angsana New'>$time</td>\n".

      
     "  <td BGCOLOR=#FFFFFF><font face='Angsana New'><a  href=\"dxopedit.php? cTdatehn=".urlencode($thdatehn)."&cPtname=".urlencode($ptname)."&cHn=".urlencode($hn)."&cGoup=".urlencode($goup)."&cDxg=".urlencode($dxgroup)."&cIcd10=".urlencode($icd10)."&cVn=".urlencode($vn)."\" >$hn</td>\n".

        
//  "  <td BGCOLOR=#FFFFFF>$ptname</a></td>\n".

//   "  <td BGCOLOR=66CDAA><font face='Angsana New'><a   href=\"chkopd1.php? cTdatehn=".urlencode($thdatehn)."&cPtname=".urlencode($ptname)."&cHn=".urlencode($hn)."&cDoctor=".urlencode($doctor)."&cDiag=".urlencode($diag)."&cOkopd=".urlencode($okopd)."&cVn=".urlencode($vn)."\">$ptname</a></td>\n".

       
    "  <td BGCOLOR=#FFFFFF><font face='Angsana New'>$an</td>\n".

     
      "  <td BGCOLOR=#FFFFFF><font face='Angsana New'>$diag</td>\n".
		   "  <td BGCOLOR=#FFFFFF><font face='Angsana New'>$toborow</td>\n".

     
      "  <td BGCOLOR=#FFFFFF><font face='Angsana New'><B>$icd10</B>&nbsp;$icd101</td>\n".

      
     "  <td BGCOLOR=#FFFFFF><font face='Angsana New'>$icd9cm</td>\n".
		       
     "  <td BGCOLOR=#FFFFFF><font face='Angsana New'>$dxgroup</td>\n".

   
        " </tr>\n");

       }

   
include("unconnect.inc");
       }
?>
</table>