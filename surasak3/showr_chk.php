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

<a href="../nindex.htm"><h3> &lt;&lt;�����</h3></a>
<form action="" name="form1" method="post">
<table border="1" cellpadding="0" cellspacing="0" bordercolordark="#000000" bordercolorlight="#FFFFFF" class="formdrug">
<tr>
  <td height="27" colspan="5" align="center" >��Ѻ�ͧ������ҡ��⤫��չ���࿵</td>
</tr>
<tr>
  <td height="54" colspan="5" align="center">HN :  <input name="hn" type="text" /></td></tr>
  <tr>
  <td height="54" colspan="5" align="center"><input name="search" type="submit"  value=" ��ŧ "/></td></tr>
</form>
<?
if(isset($_POST['search'])){
?>
	<tr>
    <td width="45" align="center">�ӴѺ</td><td width="64" align="center">HN</td><td width="159" align="center">���� - ʡ��</td>
    <td width="165" align="center">ᾷ��</td>
    <td width="155" align="center">�ѹ��� - ����</td>
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