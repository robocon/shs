<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style>
body{
	font-family:"Angsana New";
	
}
</style>
<? 
include("connect.inc");
$n=0;
$sql="SELECT * FROM `opd_hd` ORDER BY `date_hd` asc ";
$query=mysql_query($sql);

?>
<a  class="font2" target="_top" href="../nindex.htm">&lt;&lt;�����</a> 
<h1 class="f1" align="center">OPD �ä�</h1>
<table border="1" style="border-collapse:collapse; border-color:#000;" cellpadding="2" cellspacing="2" class="f1" align="center">
  <tr>
      <td bgcolor="#FFCCCC"><div align="center">�ӴѺ</div></td>
    <td bgcolor="#FFCCCC"><div align="center">�ѹ/��͹/��</div></td>
    <td bgcolor="#FFCCCC"><div align="center">����-ʡ��</div></td>
    <td bgcolor="#FFCCCC"><div align="center">hn</div></td>
    <td bgcolor="#FFCCCC">eGFR (ckd-epi)</td>
 
    <td bgcolor="#FFCCCC"><div align="center">stage</div></td>
    <td bgcolor="#FFCCCC"><div align="center">�����˵�</div></td>
    <td bgcolor="#FFCCCC"><div align="center">���</div></td>
  </tr>
  <? 
  while($arr=mysql_fetch_array($query)){
	 $n=$n+1; 
  ?>
  <tr>
   <td><? echo $n; ?></td>
    <td><?=$arr['date_hd'];?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=floor($arr['gfr']);?></td>

    <td><?=$arr['stage'];?></td>
    <td><?=$arr['comment'];?></td>
    <td align="center"><a href="javascript:MM_openBrWindow('hd_from_edit.php?row_id=<?=$arr['row_id'];?>&cHn=<?=$arr['hn'];?>&frm1=2','','toolbar=no,location=no,status=n o,menubar=no,scrollbars=yes,resizable=yes,width=950, height=800')">���</a></td>
  </tr>
  
  <?  } ?>
</table>