<style type="text/css">
<!--
.font1 {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.font2 {
	font-size: 24px;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style1 {font-family: TH SarabunPSK; font-size: 18px; font-weight: bold; }
-->
</style>
 <form name="form1" method="post" action="rprecipthn.php">
 <a target=_self  href='../nindex.htm'><<ไปเมนู</a>
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
 <?
 include("connect.inc");
if(isset($_POST['search'])){
	?>
 <table width="70%" border="1" cellpadding="0" cellspacing="0"><tr><td width="5%" align="center" class="style1">#</td>
   <td width="23%" align="center" class="style1">วันที่-เวลา</td>
   <td width="13%" align="center" class="style1">HN</td>
   <td width="34%" align="center" class="style1">ชื่อ - สกุล</td>
   <td width="25%" align="center" class="style1">เอกสารแสดงข้อมูลยา</td>
 </tr>
   <?
	 $sql ="select * from opday where hn='".$_POST['hn']."' order by thidate desc ";
	 $rows = mysql_query($sql);
	 while($result = mysql_fetch_array($rows)){
		 $k++;
	 ?>
   <tr><td align="center" class="font1">
     <?=$k?>
     </td>
     <td class="font1">
      <a href="reportcash1.php?hn=<?=$result['hn']?>&date=<?=substr($result['thidate'],0,10)?>" target="_blank"><?=substr($result['thidate'],8,2)."-".substr($result['thidate'],5,2)."-".substr($result['thidate'],0,4)." ".substr($result['thidate'],11)?></a>     </td>
     <td class="font1">
      <?=$result['hn']?>     </td>
     <td class="font1">
      <?=$result['ptname']?>     </td>
     <td align="center" class="font1"><a href="reportcashdrug.php?hn=<?=$result['hn']?>&date=<?=substr($result['thidate'],0,10)?>" target="_blank">ดูข้อมูล</a></td>
   </tr>
   <?
	 }
?>
</table>
<?
}
 ?>