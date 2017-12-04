<?
session_start();
include("connect.inc");
//include("checklogin.php");
?>
<style type="text/css">
	<!--
	.formdrug {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	-->
</style>

<a href="../nindex.htm"><h3> &lt;&lt;ไปเมนู</h3></a>
<form action="" name="form1" method="post">
<table border="1" cellpadding="0" cellspacing="0" bordercolordark="#000000" bordercolorlight="#FFFFFF" class="formdrug">
<tr>
  <td height="27" colspan="5" align="center" >ใบรับรองการใช้ยากลูโคซามีนซัลเฟต</td>
</tr>
<tr>
  <td height="54" colspan="5" align="center">HN :  <input name="hn" type="text" /></td></tr>
  <tr>
  <td height="54" colspan="5" align="center"><input name="search" type="submit"  value=" ตกลง "/></td></tr>
</form>
<?
if(isset($_POST['search'])){
?>
	<tr>
    <td width="45" align="center">ลำดับ</td><td width="64" align="center">HN</td><td width="159" align="center">ชื่อ - สกุล</td>
    <td width="165" align="center">แพทย์</td>
    <td width="155" align="center">วันที่ - เวลา</td>
  </tr>
	<?
    $sqlselectdruga = "select * from drug_gruco where hn='".$_POST['hn']."' "; 	
$rowdruga = mysql_query($sqlselectdruga);
$i=0;
while($resulta = mysql_fetch_array($rowdruga)){
?>
		<tr>
        <td align="center"><?=++$i?></td><td>&nbsp;<a href="arbs.php?rowE=<?=$resulta['row_id']?>" target="_blank"><?=$resulta['hn']?></a></td><td>&nbsp;<?=$resulta['name_pt']?></td><td>&nbsp;<?=$resulta['name_doc']?></td><td align="center"><?=$resulta['dateup']?></td>
        </tr>
     <?
	}
}
?>
</table>