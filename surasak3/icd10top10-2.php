<style type="text/css">
<!--
.fontm{
	font-family: "TH SarabunPSK";
	font-size:16px;
}
.font1{
	font-family: "TH SarabunPSK";
	font-size:18px;
}
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>

<form method="POST" action="icd10top10-2.php">
<p class="forntsarabun">รายงานจำนวนผู้ป่วย จำแนกตาม ICD 10  </p>
<table>
  <tr>
        <td><span class="forntsarabun">เดือน<? $m=date("m")?>
            <select name="rptmo" class="forntsarabun" id="rptmo">
             <option value="">ไม่เลือกเดือน</option>
              <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
              <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
              <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
              <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
              <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
              <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
              <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
              <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
              <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
              <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
              <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
              <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
            </select>
            <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr' class='forntsarabun'>";
				foreach($dates as $i){
				?>
            <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
            <?=$i;?>
            </option>
            <?
				}
				echo "<select>";
				?>
        </span></td>
      </tr>
      <tr>
        <td align="center"><span class="forntsarabun">
          <input type="submit" value="ตกลง" name="B1" class="forntsarabun" />
        <a target=_self  href='../nindex.htm' class="forntsarabun"><--ไปเมนู</a></span></td>
      </tr>
    </table>
</form>
    <hr />  <br />
<?php
if(isset($_POST['B1'])){
    
	
   $yrmonth="$thiyr-$rptmo";


print "<font class=\"forntsarabun\"><b>รายชื่อผู้ป่วยตาม ICD10 </b>";
  
print "<b>ประจำเดือน</b> $yrmonth ";
   
 print "<br><a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
?>
<?php
    include("connect.inc");
    $querydb1="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday  WHERE thidate LIKE '$yrmonth%'  and icd10 !='' and (an='' or an is null)";
    $resultdb1 = mysql_query($querydb1) or die(mysql_error());
	
	$querydb2="CREATE TEMPORARY TABLE ipday1 SELECT * FROM ipcard  WHERE dcdate LIKE '$yrmonth%'  and icd10 !=''";
    $resultdb2 = mysql_query($querydb2) or die(mysql_error());

  print "จำนวนผู้ป่วยแต่ละ ICD 10 <br><br>
<br> ";
	
	////////// ผป. นอก //////
	
   $query1="SELECT  COUNT(*) as c1 FROM opday1 ";
   $result1 = mysql_query($query1);
   list ($c1) = mysql_fetch_row ($result1);


   $query="SELECT  icd10,COUNT(*) AS duplicate FROM opday1 GROUP BY icd10 HAVING duplicate > 0 ORDER BY duplicate DESC ";
   $result = mysql_query($query);
   $n=0;
   
   
   ////////// ผป. ใน //////
   
   $query2="SELECT  COUNT(*) as c2 FROM ipday1";
   $result2 = mysql_query($query2);
   list ($c2) = mysql_fetch_row ($result2);
   
   $query1="SELECT  icd10,COUNT(*) AS duplicate FROM ipday1 GROUP BY icd10 HAVING duplicate > 0 ORDER BY duplicate DESC ";
   $result1 = mysql_query($query1);
   $n1=0;
   ?><table border="1" cellspacing="3" cellpadding="2" bordercolor="#000000" style="border-collapse:collapse;" >
  <tr>
    <td width="25%" align="center" valign="top"><table class="forntsarabun" style="border-collapse:collapse;" bordercolor="#000000"  border="1">
   <tr bgcolor="#00CCCC">
     <td colspan="5" align="center">ผู้ป่วยนอก   (<?=$c1;?>)/คน</td>
     </tr>
   <tr bgcolor="#00CCCC" class="fontm">
   <td>ลำดับ</td>
   <td>ICD10</td>
   <td>Diag</td>
   <td>จำนวน/คน</td>
   <td align="center">%</td>
   </tr>
   <?
while (list ($icd10,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
			
			$diag="SELECT detail  FROM `icd10`WHERE 1 AND `code`='$icd10'";
			$querydiag = mysql_query($diag);
			list ($detail) = mysql_fetch_row ($querydiag);
			
		$num= $duplicate+$num;
		$avg1=100*$duplicate/$c1;
		$avg1=number_format($avg1,2);
		

            print (" <tr>".
               "<td>$n</td>".
               "<td><a href='icd10_detail.php?do=op&icd10=$icd10&thidate=$yrmonth' target=_blank>$icd10</a></td>".
			   "<td>$detail</td>".
			   "<td align=\"center\">$duplicate</td>".
			   "<td align=\"center\">$avg1</td>".
               " </tr>");
               }
   ?>
   </table></td>
    <td width="25%" align="center" valign="top">
    
    <table class="forntsarabun" style="border-collapse:collapse;" bordercolor="#000000"  border="1">
   <tr bgcolor="#00CCCC">
     <td colspan="5" align="center">ผู้ป่วยใน   (<?=$c2;?>)/คน</td>
     </tr>
   <tr bgcolor="#00CCCC" class="fontm">
   <td>ลำดับ</td>
   <td>ICD10</td>
   <td>Diag</td>
   <td>จำนวน/คน</td>
   <td align="center">%</td>
   </tr>
   <?
while (list ($icd101,$duplicate1) = mysql_fetch_row ($result1)) {
            $n1++;
			
			$diag="SELECT detail  FROM `icd10`WHERE 1 AND `code`='$icd101'";
			$querydiag = mysql_query($diag);
			list ($detail) = mysql_fetch_row ($querydiag);
			
$num= $duplicate1+$num;

$avg2=100*$duplicate1/$c2;

$avg2=number_format($avg2,2);

            print (" <tr>".
               "<td>$n1</td>".
               "<td><a href='icd10_detail.php?do=ip&icd10=$icd101&thidate=$yrmonth' target=_blank>$icd101</a></td>".
			    "<td>$detail</td>".
			   "<td align=\"center\">$duplicate1</td>".
			   "<td align=\"center\">$avg2</td>".
               " </tr>");
               }
   ?>
   </table></td>
    <td width="35%" align="center" valign="top">
    
    <?
	////////// ผป. ใน  dead//////
   
   $query3="SELECT  COUNT(*) as c3 FROM ipday1 where dctype like '%Dead%' ";
   $result3 = mysql_query($query3)or die(mysql_error());
   list ($c3) = mysql_fetch_row ($result3);
   
   
   
   $query33="SELECT  icd10,COUNT(*) AS duplicate FROM ipday1 where dctype like '%Dead%' GROUP BY icd10 HAVING duplicate > 0 ORDER BY duplicate DESC ";
   $result33 = mysql_query($query33) or die(mysql_error());
   $n33=0;
   
   //echo $query33;
   ?>
    
    <table class="forntsarabun" style="border-collapse:collapse;" bordercolor="#000000"  border="1">
   <tr bgcolor="#00CCCC">
     <td colspan="5" align="center">ผู้ป่วยใน (dead) (<?=$c3;?>)/คน</td>
     </tr>
   <tr bgcolor="#00CCCC" class="fontm">
   <td>ลำดับ</td>
   <td>ICD10</td>
   <td>Diag</td>
   <td>จำนวน/คน</td>
   <td align="center">%</td>
   </tr>
   <?
while (list ($icd101,$duplicate3) = mysql_fetch_row ($result33)) {
            $n33++;
			
			$diag="SELECT detail  FROM `icd10`WHERE 1 AND `code`='$icd101'";
			$querydiag = mysql_query($diag);
			list ($detail) = mysql_fetch_row ($querydiag);
			
$num= $duplicate3+$num;

$avg3=100*$duplicate3/$c3;

$avg3=number_format($avg3,2);

            print (" <tr>".
               "<td>$n33</td>".
               "<td><a href='icd10_detail.php?do=deadip&icd10=$icd101&thidate=$yrmonth' target=_blank>$icd101</a></td>".
			   "<td>$detail</td>".
			   "<td align=\"center\">$duplicate3</td>".
			   "<td align=\"center\">$avg3</td>".
               " </tr>");
               }
   include("unconnect.inc");
   ?>
   </table>
    
    </td>
  </tr>
</table>

   
   <?
}
?>