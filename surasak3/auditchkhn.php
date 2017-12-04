<style type="text/css">
<!--
@media print{
	#print-page{
		page-break-after:always;
	}
	#print-page-no{
		display:none;
	}  
}
.font1 {
	font-family: AngsanaUPC;
	font-size: 18px;
}
.font2 {
	font-size: 24px;
}
.font3 {
	font-family: AngsanaUPC;
	font-size: 22px;
}
.style1 {font-family: AngsanaUPC; font-size: 18px; font-weight: bold; }
-->
</style>
<div id="print-page-no">
 <form name="form1" method="post" action="auditchkhn.php">
 <input name="act" type="hidden" value="search" />
<a target=_self  href='../nindex.htm'><< ไปเมนู</a>
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
 </div>
 <?
include("connect.inc");
if($_POST["act"]=="search"){
?>
<div align="center" class="font3" style="width:100%;"><strong>เอกสารการสุ่มตรวจเวชระเบียน opd billding</strong></div>
<div align="center" class="font3" style="width:100%;"><strong>วันที่ 1 ตุลาคม 2556- 31 ธันวาคม 2556</strong></div>
 <table width="100%" border="1" cellpadding="0" cellspacing="0"><tr><td width="6%" align="center" class="font1">#</td>
   <td width="27%" align="center" class="font1">วันที่-เวลา</td>
   <td width="22%" align="center" class="font1">HN</td>
   <td width="29%" align="center" class="font1">ชื่อ - สกุล</td>
   </tr>
   <?
	 $sql ="select * from opday where hn='".$_POST['hn']."' and thidate between '2556-10-01 00:00:00' and '2556-12-31 23:59:59' order by thidate desc ";
	 //echo $sql;
	 $rows = mysql_query($sql);
	 $num=mysql_num_rows($rows);
	 if(empty($num)){
	 	echo "<tr><td colspan='4' align='center'>------------------- ไม่พบข้อมูลที่ค้นหาในระบบ --------------------</td></tr>";
	 }else{
	 while($result = mysql_fetch_array($rows)){
		 $k++;
	 ?>
   <tr>
   	 <td align="center" class="font1"><?=$k?></td>
     <td class="font1"><a href="auditreportcash.php?hn=<?=$result['hn']?>&date=<?=substr($result['thidate'],0,10)?>" target="_blank"><?=substr($result['thidate'],8,2)."-".substr($result['thidate'],5,2)."-".substr($result['thidate'],0,4)." ".substr($result['thidate'],11)?></a></td>
     <td class="font1"><?=$result['hn']?></td>
     <td class="font1"><?=$result['ptname']?></td>
   </tr>
   <?
	 	}  //close while
	 }  // close num
?>
</table>
<?
}
 ?>