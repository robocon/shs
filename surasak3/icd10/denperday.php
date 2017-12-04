<?php
?>
<form method="POST" action="" >
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
สรุปจำนวนหัตถการของกองทันตกรรม ต่อวัน</b></font></font></p>
  <p><font face="Angsana New"><font size="3">
 (วันที่ 01,02,....30,31  ถ้าไม่มีวันที่ จะเป็นข้อมูลต่อเดือน)</font></font></p>
  <font face="Angsana New">วันที่&nbsp;&nbsp;<input type="text" name="appdate" size="2"><select size="1" name="appmo">
    <option selected>--เดือน--</option>
    <option value="01">มกราคม</option>
    <option value="02">กุมภาพันธ์</option>
    <option value="03">มีนาคม</option>
    <option value="04">เมษายน</option>
    <option value="05">พฤษภาคม</option>
    <option value="06">มิถุนายน</option>
    <option value="07">กรกฏาคม</option>
    <option value="08">สิงหาคม</option>
    <option value="09">กันยายน</option>
    <option value="10">ตุลาคม</option>
    <option value="11">พฤศจิกายน</option>
    <option value="12">ธันวาคม</option>
  </select><select size="1" name="thiyr">
    <option>2548</option>
    <option>2549</option>
    <option>2550</option>
    <option selected>2551</option>
    <option>2552</option>
    <option>2553</option>
    <option>2554</option>
    <option>2555</option>

  </select></p>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="ตกลง" name="B1">

<?php
    print "&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";
?>

<br/>
<? 
include("../Connections/connect.inc.php");
include("../Connections/all_function.php");


	
	if($_REQUEST['B1']=="ตกลง"){
		
			 $thidate=$thiyr.'-'.$appmo.'-'.$appdate;
			
			$sql="SELECT  count(*)as counticd FROM opday  WHERE  thidate  LIKE  '$thidate%'";
			$result = mysql_query($sql) or die("Query failed");	
			$dbarr=mysql_fetch_array($result);


			$sql2="SELECT  count(*)as icdnull  FROM opday  WHERE thidate  LIKE  '$thidate%' and (icd10 =''OR icd10 is NULL) ";
			$result2 = mysql_query($sql2) or die("Query failed2");		
			$dbarr2=mysql_fetch_array($result2);
			
			
			$sql3="SELECT  count(*)as icdnotnull  FROM opday  WHERE  thidate  LIKE  '$thidate%' and icd10 !='' ";
			$result3 = mysql_query($sql3) or die("Query failed3");		
			$dbarr3=mysql_fetch_array($result3);
			
			
			$avgnotnull=100*$dbarr3['icdnotnull']/$dbarr['counticd'];
			$avgnull=100*$dbarr2['icdnull']/$dbarr['counticd'];
			
			
			/*		$avgnotnull=number_format($avgnotnull,2);
			$avgnull=number_format($avgnull,2);*/
			///////////////////////////////////////  Diag ///////////////////////////////////////////////////////
			
	
			$diag="SELECT  count(*)as alldiag FROM opday  WHERE thidate  LIKE  '$thidate%' ";
			$resultdiag = mysql_query($diag) or die("Query failed diag");	
			$dbarrdiag=mysql_fetch_array($resultdiag);
			
			$diag2="SELECT  count(*)as diagnull  FROM opday  WHERE thidate  LIKE  '$thidate%' and ((diag !='' and diag!='ระบุโรคเบื้องต้น')OR(diag !='' and diag IS NULL))";
			$resultdiag2 = mysql_query($diag2) or die("Query failed diag");		
			$dbarrdiag2=mysql_fetch_array($resultdiag2);//// มี 
			
			$sqldiag3="SELECT  count(*)as diagnotnull  FROM opday  WHERE  thidate  LIKE  '$thidate%' and ((diag ='' and diag IS NOT NULL) OR(diag ='' and  diag='ระบุโรคเบื้องต้น')OR diag='ระบุโรคเบื้องต้น' OR diag IS NULL) ";
			$resultdiag3 = mysql_query($sqldiag3) or die("Query failed diag");		
			$dbarrdiag3=mysql_fetch_array($resultdiag3);// ไม่มี
			
			
			$avgdiag1=100*$dbarrdiag3['diagnotnull']/$dbarrdiag['alldiag'];
			$avgdiag2=100*$dbarrdiag2['diagnull']/$dbarrdiag['alldiag'];
		?>
        
	<table width="55%" border="1">
  <tr>
    <td colspan="4" align="center">ความสมบูรณ์ของเวชระเบียนตาม ICD10</td>
    </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC">รายการ</td>
    <td align="center" bgcolor="#CCCCCC">จำนวน</td>
    <td align="center" bgcolor="#CCCCCC">เปอร์เซนต์</td>
    <td align="center" bgcolor="#CCCCCC">ดูข้อมูล</td>
  </tr>
  <tr>
    <td width="45%">ผู้ป่วยที่ลงทะเบียนทั้งหมด</td>
    <td width="23%"><? if($dbarr['counticd']==0){ echo "ยังไม่มีรายการ" ;}else{ echo $dbarr['counticd']; } ?>&nbsp;</td>
    <td width="14%">100%</td>
    <td width="18%" align="center"><a href="viewicd10.php?list=all&date=<?=$thidate;?>" target="_blank">ดูข้อมูล</a></td>
  </tr>
  <tr>
    <td>มี ICD10</td>
    <td><? if($dbarr3['icdnotnull']==0){ echo "ยังไม่มีรายการ" ;}else{ echo $dbarr3['icdnotnull']; }?></td>
    <td><?=number_format($avgnotnull,2);?>%</td>
    <td align="center"><a href="viewicd10.php?list=notnull&date=<?=$thidate;?>"  target="_blank">ดูข้อมูล</a></td>
  </tr>
  <tr>
    <td>ไม่มี ICD10</td>
    <td><? if($dbarr2['icdnull']==0){ echo "ยังไม่มีรายการ" ;}else{ echo $dbarr2['icdnull']; }?>&nbsp;</td>
    <td><?=number_format($avgnull,2);?>%</td>
    <td align="center"><a href="viewicd10.php?list=null&date=<?=$thidate;?>"  target="_blank">ดูข้อมูล</a></td>
  </tr>
</table>
<BR/>
<BR/>
	<table width="55%" border="1">
  <tr>
    <td colspan="4" align="center">diag</td>
    </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC">รายการ</td>
    <td align="center" bgcolor="#CCCCCC">จำนวน</td>
    <td align="center" bgcolor="#CCCCCC">เปอร์เซนต์</td>
    <td align="center" bgcolor="#CCCCCC">ดูข้อมูล</td>
  </tr>
  <tr>
    <td width="45%">ผู้ป่วยที่ลงทะเบียนทั้งหมด</td>
    <td width="23%"><? if($dbarrdiag['alldiag']==0){ echo "ยังไม่มีรายการ" ;}else{ echo $dbarrdiag['alldiag']; } ?>&nbsp;</td>
    <td width="14%">100%</td>
    <td width="18%" align="center"><a href="viewdiag.php?list=all&date=<?=$thidate;?>" target="_blank">ดูข้อมูล</a></td>
  </tr>
  <tr>
    <td>มี diag</td>
    <td><? if($dbarrdiag3['diagnotnull']==0){ echo "ยังไม่มีรายการ" ;}else{ echo $dbarrdiag3['diagnotnull']; }?></td>
    <td><?=number_format($avgdiag1,2);?>%</td>
    <td align="center"><a href="viewdiag.php?list=notnull&date=<?=$thidate;?>"  target="_blank">ดูข้อมูล</a></td>
  </tr>
  <tr>
    <td>ไม่มี diag</td>
    <td><? if($dbarrdiag2['diagnull']==0){ echo "ยังไม่มีรายการ" ;}else{ echo $dbarrdiag2['diagnull']; }?>&nbsp;</td>
    <td><?=number_format($avgdiag2,2);?>%</td>
    <td align="center"><a href="viewdiag.php?list=null&date=<?=$thidate;?>"  target="_blank">ดูข้อมูล</a></td>
  </tr>
</table>

        <?

}
?>