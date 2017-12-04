<?
include("connect.inc"); 

?>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
	font-size: 16px;
}
-->
</style>

<form action="" method="post">
มูลค่าสัดส่วนการใช้ยานอกบัญชียาหลักฯต่อยาในบัญชียาหลักฯ เป็นเงิน
<!--<select name="year">
<option value="2556">2556</option>
<option value="2555">2555</option>
<option value="2554">2554</option>
<option value="2553">2553</option>
<option value="2552">2552</option>
<option value="2551">2551</option>
</select>--><br>
<input type="submit" value="ตกลง" name="search">
</form>

 <?
if(isset($_POST['search'])){
?>
<table width="80%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%" align="center"><span class="font1">ประเภท</span></td>
    <td width="8%" align="center"><span class="font1">ลำดับ</span></td>
    <td width="12%" align="center"><span class="font1">ปีงบประมาณ</span></td>
    <td width="25%" align="center"><span class="font1">รายการ (Items) ยานอกฯ<br>
ที่ใช้ทั้งหมดในผู้ป่วย</span></td>
    <td width="26%" align="center"><span class="font1">รายการ (Items) ยาในฯ<br> 
    ที่ใช้ทั้งหมดในผู้ป่วยทั้งหมด</span></td>
    <td width="10%" align="center"><span class="font1">อัตราส่วน</span></td>
    <td width="9%" align="center"><span class="font1">หมายเหตุ</span></td>
  </tr>
  
 <?

//for($i=2556;$i>=2551;$i--){
	$k++;

  $sql = "SELECT  sum(price) FROM drugrx WHERE (an is null or an ='') and ( part =  'DDY' OR part =  'DDN' ) AND ( date BETWEEN  '2556-04-01 00:00:00' AND  '2556-06-30 23:59:59' ) ";
  $rows = mysql_query($sql);
  list($sum1) = mysql_fetch_array($rows);
  
  $sql2 = "SELECT  sum(price) FROM drugrx WHERE (an is null or an ='') and part =  'DDL'  AND ( date BETWEEN  '2556-04-01 00:00:00' AND  '2556-06-30 23:59:59' ) ";
  $rows = mysql_query($sql2);
  list($sum2) = mysql_fetch_array($rows);
  ?>
  <tr>
    <td><span class="font1">ผู้ป่วยนอก</span></td>
    <td align="center"><span class="font1">
      <?=$k?>
    </span></td>
    <td align="center"><span class="font1">
      <?=$i?>
    </span></td>
    <td align="right"><span class="font1">
      <?=$sum1?>
    </span></td>
    <td align="right"><span class="font1">
      <?=$sum2?>
    </span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<?
//}

?>
</table>
<br>
<br>
<table width="80%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%" align="center"><span class="font1">ประเภท</span></td>
    <td width="8%" align="center"><span class="font1">ลำดับ</span></td>
    <td width="12%" align="center"><span class="font1">ปีงบประมาณ</span></td>
    <td width="25%" align="center"><span class="font1">รายการ (Items) ยานอกฯ<br>
      ที่ใช้ทั้งหมดในผู้ป่วย</span></td>
    <td width="26%" align="center"><span class="font1">รายการ (Items) ยาในฯ<br>
      ที่ใช้ทั้งหมดในผู้ป่วยทั้งหมด</span></td>
    <td width="10%" align="center"><span class="font1">อัตราส่วน</span></td>
    <td width="9%" align="center"><span class="font1">หมายเหตุ</span></td>
  </tr>
  <?
$k=0;
//for($i=2556;$i>=2551;$i--){
	$k++;

  $sql = "SELECT sum(price) FROM drugrx WHERE (an is not null and an !='') and ( part =  'DDY' OR part =  'DDN' ) AND ( date BETWEEN  '2556-04-01 00:00:00' AND  '2556-06-30 23:59:59' ) ";
  $rows = mysql_query($sql);
  list($sum1) = mysql_fetch_array($rows);
  
  $sql2 = "SELECT sum(price) FROM drugrx WHERE (an is not null and an !='') and part =  'DDL'  AND ( date BETWEEN  '2556-04-01 00:00:00' AND  '2556-06-30 23:59:59' ) ";
  $rows = mysql_query($sql2);
  list($sum2) = mysql_fetch_array($rows);
  ?>
  <tr>
    <td><span class="font1">ผู้ป่วยใน</span></td>
    <td align="center"><span class="font1">
      <?=$k?>
    </span></td>
    <td align="center"><span class="font1">
      <?=$i?>
    </span></td>
    <td align="right"><span class="font1">
      <?=$sum1?>
    </span></td>
    <td align="right"><span class="font1">
      <?=$sum2?>
    </span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?
//}
}
?>
</table>
