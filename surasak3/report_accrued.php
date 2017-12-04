<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.angsana{
	font-family:"Angsana New";
	font-size:18px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<script language="JavaScript" type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<form action="" method="post" name="frmSearch" id="frmSearch">
 <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse" class="angsana" >
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">ผู้ป่วยค้างชำระเงิน </td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">วัน/เดือน/ปี</span></td>
    <td >
    <? $d=date("d");?>
    <input type="text" name="d_start" value="<?=$d;?>" class="forntsarabun"  size="5"/>
	
	<? $m=date('m'); ?>
      <select name="m_start" class="forntsarabun">
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
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center">* ค้นหาจากวันที่รับบริการ
      <input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
    <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>  ||  <a href="report_accrueddetail.php" target="_blank">รายงานค้างชำระแบบละเอียด</a>
      </td>
  </tr>
</table>

</form>

<?php

if($_POST['submit']=="ค้นหา"){
	
include("connect.inc");
	
if($_POST['d_start']!=''){
$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
$day="วันที่";
}else{
$date1=$_POST['y_start'].'-'.$_POST['m_start'];
$day="เดือน";
}

//// ค้างชำระ

$status_pay='n';
$tsql1="CREATE TEMPORARY TABLE  acc1  Select * from  accrued   WHERE  txdate
LIKE  '$date1%' and status_pay='".$status_pay."' ";
$tquery1 = mysql_query($tsql1);	  

$strSQL1 = "SELECT  * FROM acc1 as a , opcard as b  WHERE a.hn=b.hn order by a.txdate asc";
$objQuery1 = mysql_query($strSQL1) or die ("Error Query [".$strSQL1."]");
$rows1=mysql_num_rows($objQuery1);

//// ราการที่ชำระแล้ว
$status_pay2='y';
$tsql2="CREATE TEMPORARY TABLE  acc2  Select * from  accrued   WHERE  txdate
LIKE  '$date1%' and status_pay='".$status_pay2."' ";
$tquery2 = mysql_query($tsql2);	


$strSQL2 = "SELECT  * FROM acc2 as a , opcard as b  WHERE a.hn=b.hn order by a.txdate asc";
$objQuery2 = mysql_query($strSQL2) or die ("Error Query [".$strSQL2."]");
$rows2=mysql_num_rows($objQuery2);




}else{
	/////แสดงทั้งหมด
include("connect.inc");

$status_pay='n';	  
$status_pay2='y';

$strSQL1 = "SELECT  * FROM accrued as a , opcard as b  WHERE a.hn=b.hn and a.status_pay='".$status_pay."' order by a.txdate desc";
$objQuery1 = mysql_query($strSQL1) or die ("Error Query1 [".$strSQL1."]");



$strSQL2 = "SELECT  * FROM accrued as a , opcard as b  WHERE a.hn=b.hn and a.status_pay='".$status_pay2."' order by a.txdate asc";
$objQuery2 = mysql_query($strSQL2) or die ("Error Query2 [".$strSQL2."]");


}

echo "<font size='+2' class='angsana'>แสดงรายการที่ค้างชำระ</font>";
?>

<br />
<br />


<table  border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse"  bordercolor="#000000" class="angsana" width="100%">
  <tr bgcolor="#ADDFFF" onmouseover="this.style.backgroundColor='#ADDFFF'" onmouseout="this.style.backgroundColor=''">

    <th align="center">ลำดับ</th>
    <th align="center">วันที่รับบริการ</th>
    <th align="center">วันที่บันทึกข้อมูล</th>
    <th align="center">VN</th>
    <th align="center">HN</th>
    <th align="center">ชื่อ-สกุล</th>
    <th align="center">รายการ</th>
    <th align="center">สิทธิ</th>
    <th align="center">จำนวนเงิน</th>
	<th align="center">ลบ</th>
    <!--<th>ลบ</th>-->
  </tr>
<?
$i=1;
while($objResult1 = mysql_fetch_array($objQuery1))
{
	
	$ptname1=$objResult1['yot'].$objResult1['name'].' '.$objResult1['surname'];
	
	if($objResult1["depart"]=='PHAR'){
	$link="<a href='acc_phardetail.php?pdate=$objResult1[txdate]&phn=$objResult1[hn]' target='_blank'>$objResult1[detail]</a>";	
	}else{
	$link="<a href='acc_hudthakandetail.php?pdate=$objResult1[txdate]&phn=$objResult1[hn]' target='_blank'>$objResult1[detail]</a>";		
	}
	
	$date1=explode(" ",$objResult1["txdate"]);
	$date=explode("-",$date1[0]);
	$yr=$date[0];
	$m=$date[1];
	$d=$date[2];
?>
  <tr  onmouseover="this.style.backgroundColor='#ADDFFF'" onmouseout="this.style.backgroundColor=''">


    <td align="center"><?=$i;?></td>
    <td align="left"><?=$objResult1["txdate"];?></td>
    <td align="left"><?=$objResult1["date"];?></td>
    <td align="center"><a href="opcashvn.php?vn=<?=$objResult1["vn"];?>&d=<?=$d;?>&m=<?=$m;?>&yr=<?=$yr;?>" target="_blank"><?=$objResult1["vn"];?></a></td>
    <td align="center"><?=$objResult1["hn"];?></td>
    <td align="left"><?=$ptname1;?></td>
    <td align="left"><?=$link;?></td>
    <td align="left"><?=$objResult1[7];?></td>
   <td align="right"><?=$objResult1["price"];?></td>
   <td align="center"><a href="JavaScript:if(confirm('ยืนยันการชำระเงินค้างจ่าย?')==true){ window.location='accrued_delete.php?row_id=<?=$objResult1[0];?>';}">ลบ</a></td>
  </tr>
<?
$i++;
$sumtotal+=$objResult1["price"];
}
?> 
  <tr  onmouseover="this.style.backgroundColor='#ADDFFF'" onmouseout="this.style.backgroundColor=''">
    <td colspan="8" align="center">รวมเงินทั้งหมด</td>
    <td align="right"><?=number_format($sumtotal,2)?></td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<BR />
<BR />

<?  
echo "<font size='+2' class='angsana'>แสดงรายการที่ชำระแล้ว</font>";
?>
<br />
<br />
<table  border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse"  bordercolor="#000000" width="100%" class="angsana">
  <tr bgcolor="#ADDFFF" onmouseover="this.style.backgroundColor='#ADDFFF'" onmouseout="this.style.backgroundColor=''">

    <th align="center">ลำดับ</th>
    <th align="center">วันที่รับบริการ</th>
    <th align="center">วันที่บันทึกข้อมูล</th>
    <th align="center">เลขที่ใบเสร็จ</th>
    <th align="center">VN</th>
    <th align="center">HN</th>
    <th align="center">ชื่อ-สกุล</th>
    <th align="center">รายการ</th>
    <th align="center">สิทธิ</th>
    <th align="center">จำนวนเงิน</th>
	<!--<th align="center">ลบ</th>-->
    <!--<th>ลบ</th>-->
  </tr>
<?
$i=1;
while($objResult2 = mysql_fetch_array($objQuery2))
{
	
	$ptname=$objResult2['yot'].$objResult2['name'].' '.$objResult2['surname'];
	
	if($objResult2["depart"]=='PHAR'){
	$link="<a href='acc_phardetail.php?pdate=$objResult2[txdate]&phn=$objResult2[hn]' target='_blank'>$objResult2[detail]</a>";	
	}else{
	$link="<a href='acc_hudthakandetail.php?pdate=$objResult2[txdate]&phn=$objResult2[hn]' target='_blank'>$objResult2[detail]</a>";		
	}
?>
  <tr  onmouseover="this.style.backgroundColor='#ADDFFF'" onmouseout="this.style.backgroundColor=''">

    <td align="center"><?=$i;?></td>
    <td><?=$objResult2["txdate"];?></td>
    <td><?=$objResult2["date"];?></td>
    <td><?=$objResult2["billno"];?></td>
    <td align="center"><?=$objResult2["vn"];?></td>
    <td align="center"><?=$objResult2["hn"];?></td>
    <td align="left"><?=$ptname;?></td>
    <td align="left"><?=$link;?></td>
    <td align="left"><?=$objResult2["ptright"];?></td>
   <td align="right"><?=$objResult2["price"];?></td>
   <!--<td align="center"><a href="JavaScript:if(confirm('ยืนยันการชำระเงินค้างจ่าย?')==true){ window.location='accrued_delete.php?row_id=<?//=$objResult2[0];?>';}">ลบ</a></td>-->
  </tr>
 <?
$i++;
$sumtotal2+=$objResult2["price"];
}
?>
  <tr  onmouseover="this.style.backgroundColor='#ADDFFF'" onmouseout="this.style.backgroundColor=''">
    <td colspan="8" align="center">รวมเงินทั้งหมด</td>
    <td align="right"><?=number_format($sumtotal2,2);?></td>
  </tr>
</table>
