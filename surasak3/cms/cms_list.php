<? 
session_start();
?>
<body>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<? 
include("../connect.inc");


$sql1="SELECT * FROM `cms` order by code asc";
$query1 = mysql_query($sql1);
?>
<h1 class="font2">รายชื่ออุปกรณ์ CMS </h1>

<table border="0"  >
  <tr class="font">
    <td bgcolor="#0066FF">ลำดับ</td>
    <td bgcolor="#0066FF">รหัสอุปกรณ์</td>
    <td bgcolor="#0066FF">ชื่ออุปกรณ์</td>
    <td bgcolor="#0066FF">หน่วยนับ</td>
    <td bgcolor="#0066FF">รายละเอียด</td>
    <? if($_SESSION['smenucode']=='ADM'){ ?>
    <td bgcolor="#0066FF">แก้ไข</td>
    <td bgcolor="#0066FF">ลบ</td>
    <? } ?>
  </tr>
  <? 
  $i=1;
  while($arr=mysql_fetch_array($query1)){
  ?>
  <tr class="font2">
    <td align="center"><?=$i;?></td>
    <td><a href="javascript:MM_openBrWindow('cms_addsticker.php?row_id=<?=$arr['row_id'];?>','','width=550,height=500')"><?=$arr['code'];?></a></td>
    <td><?=$arr['detail'];?></td>
    <td><?=$arr['unit'];?></td>
    <td><?=$arr['note'];?></td>
    <? if($_SESSION['smenucode']=='ADM'){ ?>
    <td align="center"><a href="javascript:MM_openBrWindow('cms_edit.php?row_id=<?=$arr['row_id'];?>','','width=500,height=500')">แก้ไข</a></td>
    <td align="center"><a href="javascript:if(confirm('ยืนยันการลบ <?=$arr['code']?>?')==true){MM_openBrWindow('cms_del.php?row_id=<?=$arr['row_id'];?>','','width=400,height=500')}">ลบ</a></td>
    <? } ?>
  </tr>
  <? 
  $i++;
  } 
  ?>
</table>

</body>
