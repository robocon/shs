<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
  <form name="form1" method="post" action="<? $PHP_SELF; ?>">
    <tr>
      <td align="right" valign="bottom"><span>หน่วยงาน :</span>
        <select  name="txtcamp">
          <option value="0">---------- เลือก ----------</option>
          <option value="M02">ร.17 พัน2</option>
          <option value="M04">ร.พ.ค่ายสุรศักดิ์มนตรี</option>
          <option value="M05">ช.พัน4</option>
          <option value="M06">ร้อยฝึกรบพิเศษประตูผา</option>
          <option value="M0301">บก.มทบ.32</option>
          <option value="M0302">กกพ.มทบ.32</option>
          <option value="M0303">กขว.,ฝผท.มทบ.32</option>
          <option value="M0304">กยก.มทบ.32</option>
          <option value="M0305">กกบ.มทบ.32</option>
          <option value="M0306">กกร.มทบ.32</option>
          <option value="M0307">ฝคง.มทบ.32</option>
          <option value="M0308">ฝกง.มทบ.32</option>
          <option value="M0309">ฝสก.มทบ.32</option>
          <option value="M0311">ผพธ.มทบ.32</option>
          <option value="อก.ศาล">อก.ศาล มทบ.32</option>
          <option value="ฝสวส">ฝสวส.มทบ.32</option>
          <option value="M0314">ฝธน.มทบ.32</option>
          <option value="M0315">อศจ.มทบ.32</option>
          <option value="M0316">ร้อย.มทบ.32</option>
          <option value="M0317">สขส.มทบ.32</option>
          <option value="รจ">รจ.มทบ.32</option>
          <option value="M0318">ผยย.มทบ.32</option>
          <option value="M0319">ฝสส.มทบ.32</option>
          <option value="M0320">ฝสห.มทบ.32</option>
          <option value="M0321">ร้อย.สห.มทบ.32</option>
          <option value="M0322">มว.ดย.มทบ.32</option>
          <option value="M0323">ผสพ.มทบ.32</option>
          <option value="M0324">สรรพกำลัง มทบ.32</option>
          <option value="M0325">ศฝ.นศท.มทบ.32</option>
          <option value="ศาล.มทบ.32">ศาล.มทบ.32</option>
          <option value="M0327">ศูนย์โทรศัพท์ มทบ.32</option>
          <option value="M0328">ผปบ.มทบ.32</option>
          <option value="M08">สัสดีจังหวัดลำปาง</option>
        </select>        &nbsp;ปี :
        <select name="year" id="yr">
        <?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
        <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
        <?php }?>
        </select>
                  <input type="submit" class="formbutton" name="submit" value="ค้นหาข้อมูล" />
                  <input type="hidden" name="page" value="1" />	  </td>
    </tr>
  </form>
</table>
<?php
include("../connect.inc");
$sql = "select * from condxofyear_so where yearcheck='$_POST[year]' and camp like '%$_POST[txtcamp]%'";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
$rows=mysql_fetch_array($query);
$camp = $rows["camp"];
?>
<p><span><strong>พฤติกรรมการดำเนินชีวิตของกำลังพล ทบ. ที่ทำให้เกิดความเสี่ยงต่อโรค<br />
</strong></span> <strong>หน่วยที่มารับการตรวจ
    <? if($_POST["txtcamp"]=="0"){ echo "รวมทุกหน่วย"; }else{ echo $camp; }?>
</strong></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="36%" align="center" valign="middle"><strong>ข้อมูลเกี่ยวกับพฤติกรรมการดำเนินชีวิต</strong></td>
    <td width="19%" align="center" valign="middle"><strong>นายทหารสัญญาบัตร (ราย)</strong></td>
    <td width="21%" align="center" valign="middle"><strong>นายทหารชั้นประทวน (ราย)</strong></td>
    <td width="16%" align="center" valign="middle"><strong>ลูกจ้างประจำ (ราย)</strong></td>
    <td width="8%" align="center" valign="middle"><strong>รวม (ราย)</strong></td>
  </tr>
  <tr>
    <td align="left" valign="middle">การสูบบุหรี่</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ไม่เคยสูบ</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%ร.ต%' OR ptname
LIKE '%ร.ท%' OR ptname
LIKE '%ร.อ%' OR ptname
LIKE '%พ.ต%' OR ptname
LIKE '%พ.ท%' OR ptname
LIKE '%พ.อ%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="0"){
		echo $rows["cigsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%ส.ต%' OR ptname
LIKE '%ส.ท%' OR ptname
LIKE '%ส.อ%' OR ptname
LIKE '%จ.ส.ต%' OR ptname
LIKE '%จ.ส.ท%' OR ptname
LIKE '%จ.ส.อ%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="0"){
		echo $rows["cigsun"];
	}	
	}
?></td>
    <td align="center" valign="middle"><?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%นาง%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="0"){
		echo $rows["cigsun"];
	}	
	}
?></td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' 
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="0"){
		echo $rows["cigsun"];
	}	
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- เคยสูบแต่เลิกแล้ว</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%ร.ต%' OR ptname
LIKE '%ร.ท%' OR ptname
LIKE '%ร.อ%' OR ptname
LIKE '%พ.ต%' OR ptname
LIKE '%พ.ท%' OR ptname
LIKE '%พ.อ%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="2"){
		echo $rows["cigsun"];
	}	
	}
?>   </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'AND (
ptname
LIKE '%ส.ต%' OR ptname
LIKE '%ส.ท%' OR ptname
LIKE '%ส.อ%' OR ptname
LIKE '%จ.ส.ต%' OR ptname
LIKE '%จ.ส.ท%' OR ptname
LIKE '%จ.ส.อ%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="2"){
		echo $rows["cigsun"];
	}	
	}
?></td>
    <td align="center" valign="middle"><?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'AND (
ptname
LIKE '%นาง%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="2"){
		echo $rows["cigsun"];
	}	
	}
?></td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count(cigarette) AS countcig
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="2"){
		echo $rows["countcig"];
	}	
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ยังสูบอยู่</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%ร.ต%' OR ptname
LIKE '%ร.ท%' OR ptname
LIKE '%ร.อ%' OR ptname
LIKE '%พ.ต%' OR ptname
LIKE '%พ.ท%' OR ptname
LIKE '%พ.อ%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="1"){
		echo $rows["cigsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle"><?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%ส.ต%' OR ptname
LIKE '%ส.ท%' OR ptname
LIKE '%ส.อ%' OR ptname
LIKE '%จ.ส.ต%' OR ptname
LIKE '%จ.ส.ท%' OR ptname
LIKE '%จ.ส.อ%'
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="1"){
		echo $rows["cigsun"];
	}	
	}
?>	</td>
    <td align="center" valign="middle"><?
$sql = "SELECT cigarette, count( cigarette ) AS cigsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%นาง%' 
)
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="1"){
		echo $rows["cigsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT cigarette, count(cigarette) AS countcig
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'
GROUP BY cigarette";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["cigarette"]=="1"){
		echo $rows["countcig"];
	}	
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">การดื่มเครื่องดื่มแอลกอฮอล์</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ไม่ดื่ม</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%ร.ต%' OR ptname
LIKE '%ร.ท%' OR ptname
LIKE '%ร.อ%' OR ptname
LIKE '%พ.ต%' OR ptname
LIKE '%พ.ท%' OR ptname
LIKE '%พ.อ%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="0"){
		echo $rows["achsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%ส.ต%' OR ptname
LIKE '%ส.ท%' OR ptname
LIKE '%ส.อ%' OR ptname
LIKE '%จ.ส.ต%' OR ptname
LIKE '%จ.ส.ท%' OR ptname
LIKE '%จ.ส.อ%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="0"){
		echo $rows["achsun"];
	}	
	}
?>	</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%นาง%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="0"){
		echo $rows["achsun"];
	}	
	}
?>	</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count(alcohol) AS countach
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="0"){
		echo $rows["countach"];
	}	
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ดื่มเป็นครั้งคราว</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%ร.ต%' OR ptname
LIKE '%ร.ท%' OR ptname
LIKE '%ร.อ%' OR ptname
LIKE '%พ.ต%' OR ptname
LIKE '%พ.ท%' OR ptname
LIKE '%พ.อ%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="2"){
		echo $rows["achsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%ส.ต%' OR ptname
LIKE '%ส.ท%' OR ptname
LIKE '%ส.อ%' OR ptname
LIKE '%จ.ส.ต%' OR ptname
LIKE '%จ.ส.ท%' OR ptname
LIKE '%จ.ส.อ%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="2"){
		echo $rows["achsun"];
	}	
	}
?></td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%นาง%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="2"){
		echo $rows["achsun"];
	}	
	}
?>	</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count(alcohol) AS countach
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="2"){
		echo $rows["countach"];
	}	
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ดื่มเป็นประจำ</td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%ร.ต%' OR ptname
LIKE '%ร.ท%' OR ptname
LIKE '%ร.อ%' OR ptname
LIKE '%พ.ต%' OR ptname
LIKE '%พ.ท%' OR ptname
LIKE '%พ.อ%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="1"){
		echo $rows["achsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%ส.ต%' OR ptname
LIKE '%ส.ท%' OR ptname
LIKE '%ส.อ%' OR ptname
LIKE '%จ.ส.ต%' OR ptname
LIKE '%จ.ส.ท%' OR ptname
LIKE '%จ.ส.อ%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="1"){
		echo $rows["achsun"];
	}	
	}
?></td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count( alcohol ) AS achsun
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%' AND (
ptname
LIKE '%นาง%'
)
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="1"){
		echo $rows["achsun"];
	}	
	}
?>    </td>
    <td align="center" valign="middle">
<?
$sql = "SELECT alcohol, count(alcohol) AS countach
FROM condxofyear_so
WHERE yearcheck = '$_POST[year]' AND camp
LIKE '%$_POST[txtcamp]%'
GROUP BY alcohol";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	while($rows=mysql_fetch_array($query)){
	if($rows["alcohol"]=="1"){
		echo $rows["countach"];
	}
	}
?>    </td>
  </tr>
  <tr>
    <td align="left" valign="middle">การออกกำลังกาย (เกณฑ์ 3 ครั้ง/สัปดาห์)</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ไม่ออกกำลังกาย</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ออกกำลังกายไม่ถึงเกณฑ์</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ออกกำลังกายตามเกณฑ์</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
  </tr>
</table>

<p>&nbsp;</p>
<p><strong>จำนวนและร้อยละของกำลังพลที่มีผลการทดสอบสมรรถภาพร่างกายผ่านเกณฑ์ของหน่วย<br>
</strong></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0"  bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="36%" rowspan="2" align="center" valign="middle"><strong>จำนวนและร้อยละของกำลังพลที่มี<br>
    ผลการทดสอบสมรรถภาพร่างกายผ่านเกณฑ์</strong></td>
    <td width="19%" align="center" valign="middle" bordercolor="#000000"><strong>นายทหารสัญญาบัตร<br> 
    (ราย)</strong></td>
    <td width="19%" align="center" valign="middle" bordercolor="#000000"><strong>นายทหารชั้นประทวน <br>
    (ราย)</strong></td>
    <td width="26%" align="center" valign="middle"><strong>คิดเป็นร้อยละ</strong></td>
  </tr>
  <tr>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
  </tr>
</table>
<br>
<br>
<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td width="9%" height="31"><strong>ผู้รวบรวมข้อมูล</strong> .......................................................................</td>
  </tr>
  <tr>
    <td height="29"><strong>ตำแหน่ง</strong> ...................................................................................</td>
  </tr>
  <tr>
    <td height="31"><strong>เบอร์โทรศัพท์</strong> ...........................................................<strong>โทรทหาร</strong>................................................<strong>มือถือ</strong>................................................</td>
  </tr>
</table>
