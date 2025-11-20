<?php
include("connect.php");
?>
<style type="text/css">
  .font1 {font-family: "TH SarabunPSK";font-size: 18px;}
  .font2 {font-size: 24px;}
  body,td,th {font-family: "TH SarabunPSK";font-size: 18px;}
  .style1 {font-family: "TH SarabunPSK";font-size: 18px;font-weight: bold;}
</style>
<form name="form1" method="post" action="rprecipthn.php">
  <a target=_self href='../nindex.htm'>ไปเมนู</a>
      <table width="80%" border="0">
        <tr>
          <td height="30" class="font1"><STRONG class="font2">เอกสารแสดงค่าใช้จ่ายในการรักษาพยาบาลประเภทผู้ป่วยนอก</STRONG></td>
        </tr>
        <tr>
          <td height="44" class="font1"><span class="font2">HN :
              <input name="hn" type="text" id="hn" size="10">
            </span></td>
        </tr>
        <tr>
          <td height="39" class="font1">
            <input type="submit" name="search" id="search" value="    ค้นหา    ">
          </td>
        </tr>
      </table>
</form>
<?php
if (isset($_POST['search'])) {
?>
  <table width="70%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td width="5%" align="center" class="style1">#</td>
      <td width="23%" align="center" class="style1">วันที่-เวลา</td>
      <td align="center" class="style1">HN</td>
      <td align="center" class="style1">VN</td>
      <td align="center" class="style1">ชื่อ - สกุล</td>
      <td align="center" class="style1">ค่าใช้จ่าย</td>
      <td width="25%" align="center" class="style1">เอกสารแสดงข้อมูลยา</td>
    </tr>
    <?php
$sql = sprintf("SELECT a.*,b.`price`,SUM(`price`) AS `sum` FROM (
  SELECT `thidate`,`thdatehn`,`hn`,`vn`,`ptname` FROM `opday` WHERE `hn`='%s' ORDER BY `thidate` DESC
) AS a 
LEFT JOIN (
  SELECT `row_id`,`hn`,`date`,`price`,CONCAT(SUBSTRING(`date`,9,2),'-',SUBSTRING(`date`,6,2),'-',SUBSTRING(`date`,1,4),`hn`) AS `thdatehn` FROM `opacc` WHERE `hn`='%s' AND `credit` != 'ยกเลิก' ORDER BY `date` 
) AS b ON b.`thdatehn` = a.`thdatehn` 
WHERE b.`row_id` IS NOT NULL
GROUP BY a.`thdatehn`
ORDER BY b.`row_id` DESC", 
mysql_real_escape_string($_POST['hn']),
mysql_real_escape_string($_POST['hn'])
);
    $rows = mysql_query($sql);
    while ($result = mysql_fetch_array($rows)) {
      $k++;
    ?>
      <tr>
        <td align="center" class="font1">
          <?= $k ?>
        </td>
        <td class="font1">
          <a href="reportcash1.php?hn=<?= $result['hn'] ?>&vn=<?= $result['vn'] ?>&date=<?= substr($result['thidate'], 0, 10) ?>" target="_blank"><?= substr($result['thidate'], 8, 2) . "/" . substr($result['thidate'], 5, 2) . "/" . substr($result['thidate'], 0, 4) . " " . substr($result['thidate'], 11) ?></a>
        </td>
        <td class="font1"><?= $result['hn'] ?></td>
        <td class="font1"><?= $result['vn'] ?></td>
        <td class="font1"><?= $result['ptname'] ?></td>
        <td class="font1" align="right"><?=number_format($result['sum'],2);?></td>
        <td align="center" class="font1"><a href="reportcashdrug.php?hn=<?= $result['hn'] ?>&date=<?= substr($result['thidate'], 0, 10) ?>" target="_blank">ดูข้อมูล</a></td>
      </tr>
    <?
    }
    ?>
  </table>
<?
}
?>