
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;รายชื่อผู้ป่วยตาม ICD 9CM&nbsp;&nbsp;&nbsp;
  
<input type="text" name="icd9cm" size="20">&nbsp;&nbsp;&nbsp;&nbsp;

<font face="Angsana New">&nbsp;&nbsp; 
ปี&nbsp;
  <input type="text" name="thiyr" size="10"> <br>ถ้าต้องการเลือกเดือนหรือวันด้วย ให้ใส่ปีและตามด้วยเดือนและวัน เช่น 2550-06-03 เป็นต้น
</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <BR>สิทธิ์ : 
<select  name='ptright'>
 <option value='' >ดูทั้งหมด</option>
 <option value='R01' >R01&nbsp;เงินสด</option>
 <option value='R02' >R02&nbsp;เบิกคลังจังหวัด</option>
 <option value='R03' >R03&nbsp;โครงการเบิกจ่ายตรง</option>
 <option value='R04' >R04&nbsp;รัฐวิสาหกิจ</option>
 <option value='R05' >R05&nbsp;บริษัท(มหาชน)</option>
 <option value='R06' >R06&nbsp;พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ</option>
 <option value='R07' >R07&nbsp;ประกันสังคม</option>
 <option value='R08' >R08&nbsp;ก.ท.44(บาดเจ็บในงาน)</option>
 <option value='R09' >R09&nbsp;ประกันสุขภาพถ้วนหน้า</option>
 <option value='R10' >R10&nbsp;ประกันสุขภาพถ้วนหน้า(เด็กเกิดใหม่)</option>
 <option value='R11' >R11&nbsp;ประกันสุขภาพถ้วนหน้า(มาตรา8)</option>
 <option value='R12' >R12&nbsp;ประกันสุขภาพถ้วนหน้า(ทหารผ่านศึก/ผู้พิการ)</option>
 <option value='R13' >R13&nbsp;ประกันสุขภาพถ้วนหน้า(ในจังหวักฉุกเฉิน)</option>
 <option value='R14' >R17&nbsp;ประกันสุขภาพถ้วนหน้า(นอกจังหวัดฉุกเฉิน)</option>
 <option value='R15' >R15&nbsp;ประกันสุขภาพนักเรียน(บริษัท)</option>
 <option value='R16' >R16&nbsp;ศึกษาธิการ(ครูเอกชน)</option>
 <option value='R17' >R17&nbsp;พลทหาร</option>
 <option value='R18' >R18&nbsp;โครงการรักษาโรคไต (HD)</option>
 <option value='R19' >R19&nbsp;โครงการนภา(NAPA)</option>
 <option value='R20' >R20&nbsp;ประกันสังคมกรณีคลอดบุตร</option>
 <option value='R21' >R21&nbsp;องค์กรปกครองส่วนท้องถิ่น</option>
 <option value='R22' >R22&nbsp;ตรวจสุขภาพประจำปีกองทัพบก</option>
 <option value='R23' >R23&nbsp;นักเรียน/นักศึกษาทหาร</option>
 </select>


 <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a></p>
</form>


<table>

 <tr>

  <th bgcolor=CD853F>#</th>
 

  <th bgcolor=CD853F>วัน-เวลา</th>
 
<th bgcolor=CD853F>HN</th>
 
 <th bgcolor=CD853F>ชื่อ-สกุล</th>
 <th bgcolor=CD853F>สิทธิ์</th>
  
<th bgcolor=CD853F>โรค</th>

  <th bgcolor=CD853F>ICD9CM</th>
  
  

  <th bgcolor=CD853F>ปัตร ปชช.</th>
  <th bgcolor=CD853F>ที่อยุ่</th>
  <th bgcolor=CD853F>ตำบล</th>
  <th bgcolor=CD853F>อำเภอ</th>
  <th bgcolor=CD853F>จังหวัด</th>
  <th bgcolor=CD853F>โทรศัพท์</th>
  
</tr>


<?php
 

  $num=0;
If (!empty($icd9cm)){
    include("connect.inc");
    global $icd9cm;
   

 $query = "SELECT thidate, hn,ptname,diag,icd9cm,ptright FROM opday WHERE icd9cm LIKE '%$icd9cm%' and thidate LIKE '$thiyr%' AND ptright like '".$_POST["ptright"]."%' ";
    $result = mysql_query($query)
        or die("Query failed");

   
 while (list ($thidate,$hn, $ptname,$diag,$icd9cm,$ptright) = mysql_fetch_row ($result)) 
{
        $Total =$Total+$amount; 


 $num++;


 $sql = "SELECT idcard,address,tambol,ampur,changwat,phone FROM opcard WHERE  hn = '".$hn."' limit 1";

   list($idcard,$address,$tambol,$ampur,$changwat,$phone) = mysql_fetch_row(Mysql_Query($sql));


 print (" <tr>\n".       
	"  <td BGCOLOR=F5DEB3>$num</td>\n".
	"  <td BGCOLOR=F5DEB3>$thidate</td>\n".
	"  <td BGCOLOR=F5DEB3>$hn</td>\n".
	"  <td BGCOLOR=F5DEB3>$ptname</a></td>\n".
	"  <td BGCOLOR=F5DEB3>$ptright</a></td>\n".
	"  <td BGCOLOR=F5DEB3>$diag</td>\n".
	"  <td BGCOLOR=F5DEB3>$icd9cm</td>\n".
	"  <td BGCOLOR=F5DEB3>$idcard</td>\n".
	"  <td BGCOLOR=F5DEB3>$address</td>\n".
	"  <td BGCOLOR=F5DEB3>$tambol</td>\n".
	"  <td BGCOLOR=F5DEB3>$ampur</td>\n".
	"  <td BGCOLOR=F5DEB3>$changwat</td>\n".
	"  <td BGCOLOR=F5DEB3>$phone</td>\n".
	" </tr>\n");

	   if($icd9cm != ""){
				if(!isset($sum[$icd9cm]))
					$sum[$icd9cm] = 0;
				$sum[$icd9cm] = $sum[$icd9cm]+1;
			}
       }

}
$icd101=$icd10;
If (!empty($icd9cm)){
    include("connect.inc");
    global $icd9cm;
   
 $query = "SELECT thidate, hn,ptname,diag,icd9cm,FROM opday WHERE icd9cm LIKE '%$icd10%' and thidate LIKE '$thiyr%'   ";
    $result = mysql_query($query)
        or die("Query failed");


   
 while (list ($thidate,$hn,$ptname,$diag,$icd9cm) = mysql_fetch_row ($result)) 
{
        $Total =$Total+$amount; 



$sql = "SELECT idcard,address,tambol,ampur,changwat,phone FROM opcard WHERE  hn = '".$hn."' ";

   list($idcard,$address,$tambol,$ampur,$changwat,$phone) = mysql_fetch_row(Mysql_Query($sql));



 $num++;

 print (" <tr>\n".

       
       "  <td BGCOLOR=F5DEB3>$num</td>\n".
   
       "  <td BGCOLOR=F5DEB3>$thidate</td>\n".
   
    "  <td BGCOLOR=F5DEB3>$hn</td>\n".
  
   "  <td BGCOLOR=F5DEB3>$ptname</a></td>\n".
     
      "  <td BGCOLOR=F5DEB3>$diag</td>\n".
    
  "  <td BGCOLOR=F5DEB3>$icd9cm</td>\n".
      
 
		      "  <td BGCOLOR=F5DEB3>$idcard</td>\n".
				 "  <td BGCOLOR=F5DEB3>$address</td>\n".
				 "  <td BGCOLOR=F5DEB3>$tambol</td>\n".
				 "  <td BGCOLOR=F5DEB3>$ampur</td>\n".
				 "  <td BGCOLOR=F5DEB3>$changwat</td>\n".
				 "  <td BGCOLOR=F5DEB3>$phone</td>\n".
      
         " </tr>\n");
			
		

       }


include("unconnect.inc");
       }
?>

</table>

<BR><BR>
สรุป ICD9cm

<TABLE>
<TR align="center">
	<TD BGCOLOR=F5DEB3>ICD9cm</TD>
	<TD BGCOLOR=F5DEB3>จำนวนผู้ป่วย</TD>
</TR>
<?php

	foreach ($sum as $key => $value){

?>
<TR>
	<TD BGCOLOR=F5DEB3><?php echo $key;?></TD>
	<TD BGCOLOR=F5DEB3><?php echo $value;?></TD>
</TR>
<?php
}	
?>
</TABLE>

