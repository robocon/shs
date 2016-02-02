<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<? 
include("connect.inc");

$sql="SELECT * FROM `opd_eye` ORDER BY `date_eye` DESC ";
$query=mysql_query($sql);
?>
<a  class="font2" target="_top" href="../nindex.htm">&lt;&lt;ไปเมนู</a> 
<h1 class="f1" align="center">OPD ตา</h1>
<table border="1" style="border-collapse:collapse; border-color:#000;" cellpadding="0" cellspacing="0" class="f1" align="center">
  <tr>
    <td bgcolor="#FFCCCC"><div align="center">วัน/เดือน/ปี</div></td>
    <td bgcolor="#FFCCCC">hn</td>
    <td bgcolor="#FFCCCC"><div align="center">ชื่อ-สกุล</div></td>
    <td bgcolor="#FFCCCC">FBS</td>
 
    <td bgcolor="#FFCCCC"><div align="center">Hba1c</div></td>
    <td bgcolor="#FFCCCC">DR</td>
    <td bgcolor="#FFCCCC"><div align="center">หมายเหตุ</div></td>
    <td bgcolor="#FFCCCC"><div align="center">แก้ไข</div></td>
  </tr>
  <? 
  while($arr=mysql_fetch_array($query)){
  ?>
  <tr>
    <td><?=$arr['date_eye'];?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['fbs'];?></td>

    <td><?=$arr['hba1c'];?></td>
    <td><?=$arr['dr'];?></td>
    <td><?=$arr['comment'];?></td>
    <td align="center"><a href="javascript:MM_openBrWindow('eye_from_edit.php?id=<?=$arr['row_id'];?>','','toolbar=no,location=no,status=n o,menubar=no,scrollbars=yes,resizable=yes,width=950, height=800')">แก้ไข</a></td>
  </tr>
  
  <?  } ?>
</table>