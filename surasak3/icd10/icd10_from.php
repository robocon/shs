<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>
 <form name="form1" method="post" action="?do=icdcount">
                     
					  <? $m=date('m'); ?>
                        <div align="left" class="forntsarabun"><h1 class="forntsarabun">ความสมบูรณ์ของเวชระเบียนตาม ICD10</h1>
                        *หากไม่เลือกวันที่ ให้เลือกที่คำว่า &quot; วันที่ &quot;<br>
                        วันที่
                         <select name="keydate" class="forntsarabun">
						<option value="">---วันที่----</option>
						<?
						for($i=1;$i<=31;$i++){
						?>
						<option value="<?=$i;?>" <? if($i==date("j")){ echo"selected"; } ?>><?=$i?></option>
						<?
						}
						?>
						</select>
                          เดือน 
                          <select name="keymonth" class="forntsarabun">
                            <option  value="">---เลือกเดือน-----</option>
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
                          ปี พ.ศ. 
               <? 
			   $Y=date("Y");
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='keyyear' class='forntsarabun'>";
				foreach($dates as $i){

				$ii=$i-543; ?>
                
				<option value='<?=$ii?>' <? if($Y==$ii){ echo "selected"; }?>><?=$i;?></option>
                <?
				}
				echo "<select>";
				?>
                        


                          <input type="submit" name="Submit" value="ตกลง">
                          <input type=button value='กลับ' onClick="window.location='http://192.168.1.2/sm3/nindex.htm'">
                        </div>
                      </form>
                      
<br/>
<hr align="center" />
<? 
include("../Connections/connect.inc.php");
include("../Connections/all_function.php");


if($_REQUEST['do']=="icdcount"){
	
	if($_REQUEST['Submit']=="ตกลง"){
		
			$keyyear=$_REQUEST['keyyear']+543;
			
			
			if($_REQUEST['keymonth']==''){ $keymonth=''; }else{ $keymonth=$_REQUEST['keymonth']; }
			if($_REQUEST['keydate']==''){ $keydate=''; }else{ $keydate=$_REQUEST['keydate']; }
			
			
			
			
			if($_REQUEST['keydate']!='' && $_REQUEST['keymonth']!='' && $_REQUEST['keydate']!=''){
				
				$thidate=$keyyear.'-'.$keymonth.'-'.$keydate;
				
			}else if($_REQUEST['keymonth']=='' && $_REQUEST['keydate']==''){
				
				$thidate=$keyyear;
				
			}else if($_REQUEST['keymonth']==''){
				
				$thidate=$keyyear;
				
			}else if($_REQUEST['keydate']==''){
			
				$thidate=$keyyear.'-'.$keymonth;
			}
			
			
			echo "<h1 class='forntsarabun'>แสดงข้อมูลวันที่  ".$keydate.'-'.$keymonth.'-'.$keyyear."</h1>";
			
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
        
	<table width="55%" border="1" class="forntsarabun">
  <tr>
    <td colspan="4" align="center">ความสมบูรณ์ของเวชรเบียนตาม ICD10</td>
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
    <td width="18%" align="center"><a href="viewicd10.php?list=all&date=<?=$thidate;?>" >ดูข้อมูล</a></td>
  </tr>
  <tr>
    <td>มี ICD10</td>
    <td><? if($dbarr3['icdnotnull']==0){ echo "ยังไม่มีรายการ" ;}else{ echo $dbarr3['icdnotnull']; }?></td>
    <td><?=number_format($avgnotnull,2);?>%</td>
    <td align="center"><a href="viewicd10.php?list=notnull&date=<?=$thidate;?>" >ดูข้อมูล</a></td>
  </tr>
  <tr>
    <td>ไม่มี ICD10</td>
    <td><? if($dbarr2['icdnull']==0){ echo "ยังไม่มีรายการ" ;}else{ echo $dbarr2['icdnull']; }?>&nbsp;</td>
    <td><?=number_format($avgnull,2);?>%</td>
    <td align="center"><a href="viewicd10.php?list=null&date=<?=$thidate;?>" >ดูข้อมูล</a></td>
  </tr>
</table>
<BR/>
<BR/>
	<table width="55%" border="1" class="forntsarabun">
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
    <td width="18%" align="center"><a href="viewdiag.php?list=all&date=<?=$thidate;?>" >ดูข้อมูล</a></td>
  </tr>
  <tr>
    <td>มี diag</td>
    <td><? if($dbarrdiag2['diagnull']==0){ echo "ยังไม่มีรายการ" ;}else{ echo $dbarrdiag2['diagnull']; }?></td>
    <td><?=number_format($avgdiag2,2);?>%</td>
    <td align="center"><a href="viewdiag.php?list=notnull&date=<?=$thidate;?>" >ดูข้อมูล</a></td>
  </tr>
  <tr>
    <td>ไม่มี diag</td>
    <td><? if($dbarrdiag3['diagnotnull']==0){ echo "ยังไม่มีรายการ" ;}else{ echo $dbarrdiag3['diagnotnull']; }?>&nbsp;</td>
    <td><?=number_format($avgdiag1,2);?>%</td>
    <td align="center"><a href="viewdiag.php?list=null&date=<?=$thidate;?>"  >ดูข้อมูล</a></td>
  </tr>
</table>

        <?
			 
	}
}
?>