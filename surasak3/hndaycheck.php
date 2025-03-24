<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบจำนวนครั้งที่มาโรงพยาบาล</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F>HN</th>
 <th bgcolor=CD853F>AN</th>
 <th bgcolor=CD853F>VN</th>
  <th bgcolor=CD853F>ชื่อ-สกุล</th>
  <th bgcolor=CD853F>สิทธิ</th>
  <th bgcolor=CD853F>วันและเวลา</th>
  <th bgcolor=CD853F>โรค</th>
  
  <th bgcolor=CD853F>ICD หลัก</th>
  <th bgcolor=CD853F>ICD รอง</th>
  <th bgcolor=CD853F>แพทย์</th>
    <th bgcolor=CD853F>คืน OPD</th>


<th bgcolor=CD853F>ออกโดย</th>


    <th bgcolor=CD853F>ผู้ยืม</th>

 
<th bgcolor=CD853F>ผู้บันทึก</th>

 </tr>

<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT hn,an,vn,ptname,ptright,thidate,diag,doctor,okopd,toborow,borow,officer,icd10,icd101,thdatehn FROM opday WHERE hn = '$hn' ORDER BY thidate DESC   ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$an,$vn,$ptname,$ptright,$thidate,$diag,$doctor,$okopd,$toborow,$borow,$officer,$icd10,$icd101,$thdatehn) = mysql_fetch_row ($result)) {


$sql = "SELECT hn FROM opday2 WHERE  thdatehn = '$thdatehn'  limit 2 ";
			if(Mysql_num_rows(Mysql_Query($sql)) > 1){
				$ptname1="<a  href=\"hndaycheck1.php?hn=$hn&thdatehn=$thdatehn\">$ptname</a>";

			}else{
				$ptname1="$ptname";
			}


        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3 width=80 style='font-size:18px;'><a  href=\"appdaycheck.php?hn=$hn\">$hn</td>\n".
           "  <td BGCOLOR=F5DEB3 width=50 style='font-size:15px;'><a target=_BLANK href=\"dxipedit1.php?cAn=$an\">$an</td>\n".
  "  <td BGCOLOR=F5DEB3  width=20 style='font-size:18px;'>$vn</td>\n".
           "  <td BGCOLOR=F5DEB3  width=200 style='font-size:18px;'>$ptname1</td>\n".
           "  <td BGCOLOR=F5DEB3  width=80 style='font-size:15px;'>$ptright</td>\n".
           "  <td BGCOLOR=F5DEB3  width=80 style='font-size:15px;'>$thidate</a></td>\n".
           "  <td BGCOLOR=F5DEB3  width=80 style='font-size:15px;'>$diag</td>\n".
 "  <td BGCOLOR=F5DEB3  width=80 style='font-size:15px;'>$icd10</td>\n".
 "  <td BGCOLOR=F5DEB3  width=80 style='font-size:15px;'>$icd101 </td>\n".
           "  <td BGCOLOR=F5DEB3 width=80 style='font-size:15px;'>$doctor</td>\n".
   "  <td BGCOLOR=F5DEB3 width=80 style='font-size:15px;'>$okopd</td>\n".

       
     "  <td BGCOLOR=F5DEB3 width=80 style='font-size:15px;'>$toborow</td>\n".

           
     "  <td BGCOLOR=F5DEB3 width=80 style='font-size:15px;'>$borow</td>\n".

         
     "  <td BGCOLOR=F5DEB3 width=80 style='font-size:15px;'>$officer</td>\n".

         
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
