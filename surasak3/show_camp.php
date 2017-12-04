<?
include("connect.inc");
?>
<style type="text/css">
	<!--
	.formdrug {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	-->
</style>
<form name="f1" method="post" action="">
<table border="1" cellspacing="0" cellpadding="0"  bordercolor="#000000" style="border-collapse:collapse" class="formdrug">
  <tr>
    <td colspan="4" align="center" bgcolor="#FFCCCC">แสดงข้อมูลผู้ป่วยตามสังกัด</td>
  </tr>
  <tr>
    <td align="center">เลือกสังกัด</td>
    <td><? 
print " <select  name='camp' class='formdrug'>";
print " <option value='0' ><--เลือกสังกัด--></option>";
//print "<option value=\"M01 พลเรือน\">พลเรือน</option>";
print "<option value=\"M02 ร.17 พัน2\">ร.17 พัน2</option>";
print "<option value=\"M03 มณฑลทหารบกที่32\">มณฑลทหารบกที่32</option>";
print "<option value=\"M04 ร.พ.ค่ายสุรศักดิ์มนตรี\">ร.พ.ค่ายสุรศักดิ์มนตรี</option>";
print "<option value=\"M05 ช.พัน4\">ช.พัน4</option>";
print "<option value=\"M06 ร้อยฝึกรบพิเศษประตูผา\">ร้อยฝึกรบพิเศษประตูผา</option>";
print "<option value=\"M0301 บก.มทบ.32\">บก.มทบ.32</option>";
print "<option value=\"M0302 กกพ.มทบ.32\">กกพ.มทบ.32</option>";
print "<option value=\"M0303 กขว.,ฝผท.มทบ.32\">กขว.,ฝผท.มทบ.32</option>";
print "<option value=\"M0304 กยก.มทบ.32\">กยก.มทบ.32</option>";
print "<option value=\"M0305 กกบ.มทบ.32\">กกบ.มทบ.32</option>";
print "<option value=\"M0306 กกร.มทบ.32\">กกร.มทบ.32</option>";
print "<option value=\"M0307 ฝคง.มทบ.32\">ฝคง.มทบ.32</option>";
print "<option value=\"M0308 ฝกง.มทบ.32\">ฝกง.มทบ.32</option>";
print "<option value=\"M0309 ฝสก.มทบ.32\">ฝสก.มทบ.32</option>";
print "<option value=\"M0310 ฝปบฝ.มทบ.32\">ฝปบฝ.มทบ.32</option>";
print "<option value=\"M0311 ผพธ.มทบ.32\">ผพธ.มทบ.32</option>";
print "<option value=\"M0312 อก.ศาล มทบ.32\">อก.ศาล มทบ.32</option>";
print "<option value=\"M0313 ฝสวส.มทบ.32\">ฝสวส.มทบ.32</option>";
print "<option value=\"M0314 ฝธน.มทบ.32\">ฝธน.มทบ.32</option>";
print "<option value=\"M0315 อศจ.มทบ.32\">อศจ.มทบ.32</option>";
print "<option value=\"M0316 ร้อย.มทบ.32\">ร้อย.มทบ.32</option>";
print "<option value=\"M0317 สขส.มทบ.32\">สขส.มทบ.32</option>";
print "<option value=\"M0313 รจ.มทบ.32\">รจ.มทบ.32</option>";
print "<option value=\"M0318 ผยย.มทบ.32\">ผยย.มทบ.32</option>";
print "<option value=\"M0319 สส.มทบ.32\">สส.มทบ.32</option>";
print "<option value=\"M0320 ฝสห.มทบ.32\">ฝสห.มทบ.32</option>";
print "<option value=\"M0321 ร้อย.สห.มทบ.32\">ร้อย.สห.มทบ.32</option>";
print "<option value=\"M0322 มว.ดย.มทบ.32\">มว.ดย.มทบ.32</option>";
print "<option value=\"M0323 ผสพ.มทบ.32\">ผสพ.มทบ.32</option>";
print "<option value=\"M0324 สรรพกำลัง มทบ.32\">สรรพกำลัง มทบ.32</option>";
print "<option value=\"M0325 ศฝ.นศท.มทบ.32\">ศฝ.นศท.มทบ.32</option>";
print "<option value=\"M0326 ศาล.มทบ.32\">ศาล.มทบ.32</option>";
print "<option value=\"M0327 ศูนย์โทรศัพท์ มทบ.32\">ศูนย์โทรศัพท์ มทบ.32</option>";
print "<option value=\"M0328 ผปบ.มทบ.32\">ผปบ.มทบ.32</option>";
print "<option value=\"M08 สัสดีจังหวัดลำปาง\">สัสดีจังหวัดลำปาง</option>";
print "<option value=\"M09 มว.คลัง สป.๓ฯ\">มว.คลัง สป.๓ฯ</option>";
print "<option value=\"M07 หน่วยทหารอื่นๆ\">หน่วยทหารอื่นๆ</option>";
print "</select>";
?>
    <td align="center"><input name="button" type="submit" class="formdrug" id="button" value="ค้นหา" /></td>
    <td align="center"><a target=_self  href='../nindex.htm' class="formdrug"> <-----ไปเมนู </a></td>
  </tr>
</table>
</form>


<hr />

<?
if(isset($_POST['button'])){

$strcamp=explode(" ",$_POST['camp']);


$sql1="CREATE TEMPORARY TABLE  opcard1  Select * from  opcard  WHERE (camp like '%".$strcamp[1]."%' and goup not like 'G31%' and goup not like 'G32%' and goup not like 'G36%' and goup not like 'G39%'  and goup not like 'G33%' and yot !='' and name  !='' and surname !='') ";
$query1 = mysql_query($sql1); 

$sql="select hn,concat(yot,name,' ',surname)as name,camp from opcard1  Order by row_id ASC";
$result=mysql_query($sql);

//echo $sql1;

 ?>
<table border="1" cellspacing="0" cellpadding="0"  bordercolor="#000000" style="border-collapse:collapse" class="formdrug">
  <tr>
    <td colspan="4" align="center" bgcolor="#CCCCCC">รายชื่อผู้ป่วยตามสังกัด  <?=$strcamp[0].' '.$strcamp[1];?></td>
    
  </tr>
  <tr>
    <td>ลำดับ</td>
    <td>HN</td>
    <td>ชื่อ-สกุล</td>
    <td>สังกัด</td>
  </tr>
  <?
  $n=0;
  while($dbarr=mysql_fetch_array($result)){
  ?>
  <tr>
    <td><?=++$n;?></td>
    <td><?=$dbarr['hn']?></td>
    <td><?=$dbarr['name']?></td>
    <td><?=$dbarr['camp']?></td>
  </tr>
  <?
  } 
  ?>
</table>
<?
}
?>