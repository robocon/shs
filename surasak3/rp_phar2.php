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
รายการที่มีมูลค่าการใช้สูงสุด 10 อันดับแรก (บาท)
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
	for($i=2556;$i>=2551;$i--){
?>
<span class="font1">ปีงบประมาณ <?=$i?></span><br />
<table width="80%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%" align="center"><span class="font1">ลำดับ</span></td>
    <td width="8%" align="center"><span class="font1">กลุ่มยา</span></td>
    <td width="12%" align="center"><span class="font1">ชื่อสามัญ</span></td>
    <td width="25%" align="center"><span class="font1">ชื่อการค้า</span></td>
    <td width="26%" align="center"><span class="font1">มูลค่าการใช้ยา</span></td>
    <td width="10%" align="center"><span class="font1">ปริมาณการใช้</span></td>
  </tr>
  
 <?
  $sql = "SELECT drugcode,sum(price) as sum,sum(amount) as sum2 FROM drugrx WHERE ( date BETWEEN  '".($i-1)."-10-01 00:00:00' AND  '".$i."-09-30 23:59:59' ) group by drugcode order by sum desc limit 20";
  
  $rows = mysql_query($sql);
  while(list($dgcode,$sum1,$sum2) = mysql_fetch_array($rows)){
  $k++;
  $sql2 = "select * from druglst where drugcode='$dgcode' ";
  $rows2 = mysql_query($sql2);
  $result = mysql_fetch_array($rows2);
 
  ?>
  <tr>
    <td align="center"><span class="font1"><?=$k?></span></td>
    <td align="center">&nbsp;</td>
    <td><span class="font1"><?=$dgcode?></span></td>
    <td><span class="font1"><?=$result['genname']?></span></td>
    <td align="right"><span class="font1"><?=$sum1?></span></td>
    <td align="right"><span class="font1"><?=$sum2?></span></td>
  </tr>

<?
  }
?>
</table>
<?
}

}
?>

