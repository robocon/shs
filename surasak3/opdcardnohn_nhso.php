<style type="text/css">
.font1 {
	font-family: "TH Niramit AS";
	font-size:18px;
}
</style>

<div class="font1">
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
  <p>ค้นหา icd10 จาก&nbsp; HN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="hnno" type="text" class="font1"  id="aLink" size="12"  ></p>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input name="B1" type="submit" class="font1" value="  ตกลง  ">&nbsp;&nbsp;&nbsp;&nbsp; <input name="B2" type="reset" class="font1" value="  ลบทิ้ง  "></p>

</form>
<?php

if($_POST['B1']){
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

      
     "  <td BGCOLOR=66CDAA><font face='Angsana New'><a  href=\"dxopedit_nhso.php? cTdatehn=".urlencode($thdatehn)."&cPtname=".urlencode($ptname)."&cHn=".urlencode($hn)."&cGoup=".urlencode($goup)."&cDxg=".urlencode($dxgroup)."&cIcd10=".urlencode($icd10)."&cVn=".urlencode($vn)."\" >$hn</td>\n".

        
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

 
 <th bgcolor=#6495ED>#</th> 
<th bgcolor=#6495ED>วัน</th>

 


  
<th bgcolor=#6495ED>HN</th>




  <th bgcolor=#6495ED>AN</th>

 
 <th bgcolor=#6495ED>โรค</th>
 <th bgcolor=#6495ED>ออกโดย</th>

  
<th bgcolor=#6495ED>ICD10</th>

 
 <th bgcolor=#6495ED>ICD9CM</th>
  <th bgcolor=#6495ED>กลุ่มโรค</th>

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

      
     "  <td BGCOLOR=#FFFFFF><font face='Angsana New'><a  href=\"dxopedit_nhso.php? cTdatehn=".urlencode($thdatehn)."&cPtname=".urlencode($ptname)."&cHn=".urlencode($hn)."&cGoup=".urlencode($goup)."&cDxg=".urlencode($dxgroup)."&cIcd10=".urlencode($icd10)."&cVn=".urlencode($vn)."\" >$hn</td>\n".

        
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
}
?>
</table>
</div>