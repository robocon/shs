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
<h1 class="font2">��ª����ػ�ó� CMS </h1>

<table border="0"  >
  <tr class="font">
    <td bgcolor="#0066FF">�ӴѺ</td>
    <td bgcolor="#0066FF">�����ػ�ó�</td>
    <td bgcolor="#0066FF">�����ػ�ó�</td>
    <td bgcolor="#0066FF">˹��¹Ѻ</td>
    <td bgcolor="#0066FF">��������´</td>
    <? if($_SESSION['smenucode']=='ADM'){ ?>
    <td bgcolor="#0066FF">���</td>
    <td bgcolor="#0066FF">ź</td>
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
    <td align="center"><a href="javascript:MM_openBrWindow('cms_edit.php?row_id=<?=$arr['row_id'];?>','','width=500,height=500')">���</a></td>
    <td align="center"><a href="javascript:if(confirm('�׹�ѹ���ź <?=$arr['code']?>?')==true){MM_openBrWindow('cms_del.php?row_id=<?=$arr['row_id'];?>','','width=400,height=500')}">ź</a></td>
    <? } ?>
  </tr>
  <? 
  $i++;
  } 
  ?>
</table>

</body>
