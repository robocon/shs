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
<?
if(isset($_GET['du_id'])){
	unset($_SESSION['duid']);
	$_SESSION['duid']=$_GET['du_id'];
	//echo $_SESSION['duid'];
	$sqlselectdruga = "select * from dt_drugadd where type ='".$_SESSION['duid']."' "; 
	if($_GET['du_id']=="E"){
		$sqlselectdruga = "select * from drug_gruco"; 	
	}
}
elseif(isset($_GET['mo_id'])&isset($_SESSION['duid'])){
	$sqlselectdruga = "select * from dt_drugadd where date like '%-".$_GET['mo_id']."-%'  and type ='".$_SESSION['duid']."'";
	if($_SESSION['duid']=="E"){
		$sqlselectdruga = "select * from drug_gruco where dateup like '%-".$_GET['mo_id']."-%'";
	}
}
else{
	//$sqlselectdruga = "select * from dt_drugadd"; 
}
?>
<a href="../nindex.htm">
<h3> &lt;&lt;�����</h3></a>
<table border="1" cellpadding="0" cellspacing="0" bordercolordark="#000000" bordercolorlight="#FFFFFF" class="formdrug">
<tr>
  <td height="27" colspan="5" align="center" >�ʴ������š���������</td>
</tr>
<tr>
  <td height="54" colspan="5" align="center">����� :    
    <select class="formdrug" name="sed" onChange="location.href='show_dtdrug.php?du_id='+this.value;">
      <option value="0">-���͡���������������-</option>
      <option value="A" <? if($_GET['du_id']=="A"|$_SESSION['duid']=="A") echo "selected='selected'";?>>Angiotensin II receptor antagonists</option>
      <option value="B" <? if($_GET['du_id']=="B"|$_SESSION['duid']=="B") echo "selected='selected'";?>>Statins</option>
      <option value="C" <? if($_GET['du_id']=="C"|$_SESSION['duid']=="C") echo "selected='selected'";?>>Proton pump inhibitor</option>
      <option value="D" <? if($_GET['du_id']=="D"|$_SESSION['duid']=="D") echo "selected='selected'";?>>Selective COX-II inhibitors</option>
      <option value="E" <? if($_GET['du_id']=="E"|$_SESSION['duid']=="E") echo "selected='selected'";?>>��Ѻ�ͧ������ҡ��⤫��չ���࿵</option>
      </select>
    ��͹ :
    <select  class="formdrug" name="month" onChange="location.href='show_dtdrug.php?mo_id='+this.value;" >
      <option value="0">-���͡��͹-</option>
      <option value="01" <? if($_GET['mo_id']=="01") echo "selected='selected'";?>>���Ҥ�</option>
      <option value="02" <? if($_GET['mo_id']=="02") echo "selected='selected'";?>>����Ҿѹ��</option>
      <option value="03" <? if($_GET['mo_id']=="03") echo "selected='selected'";?>>�չҤ�</option>
      <option value="04" <? if($_GET['mo_id']=="04") echo "selected='selected'";?>>����¹</option>
      <option value="05" <? if($_GET['mo_id']=="05") echo "selected='selected'";?>>����Ҥ�</option>
      <option value="06" <? if($_GET['mo_id']=="06") echo "selected='selected'";?>>�Զع�¹</option>
      <option value="07" <? if($_GET['mo_id']=="07") echo "selected='selected'";?>>�á�Ҥ�</option>
      <option value="08" <? if($_GET['mo_id']=="08") echo "selected='selected'";?>>�ԧ�Ҥ�</option>
      <option value="09" <? if($_GET['mo_id']=="09") echo "selected='selected'";?>>�ѹ��¹</option>
      <option value="10" <? if($_GET['mo_id']=="10") echo "selected='selected'";?>>���Ҥ�</option>
      <option value="11" <? if($_GET['mo_id']=="11") echo "selected='selected'";?>>��Ȩԡ�¹</option>
      <option value="12" <? if($_GET['mo_id']=="12") echo "selected='selected'";?>>�ѹ�Ҥ�</option>
</select></td></tr>

<?
if($_SESSION['duid']!="E"){
?>
<tr>
    <td width="45" align="center">�ӴѺ</td><td width="64" align="center">HN</td><td width="159" align="center">���� - ʡ��</td><td width="165" align="center">������</td>
    <td width="155" align="center">�ѹ��� - ����</td>
  </tr>
<?
$rowdruga = mysql_query($sqlselectdruga);
$i=0;
while($resulta = mysql_fetch_array($rowdruga)){
	
	?>
		<tr>
        <td align="center"><?=++$i?></td><td align="center"><a href="arbs.php?row<?=$_SESSION['duid']?>=<?=$resulta[0]?>" target="_blank"><?=$resulta[3]?></a></td><td>&nbsp;<?=$resulta[2]?></td><td>&nbsp;<?=$resulta[1]?></td><td align="center"><?=$resulta[13]?></td>
        </tr>
	<?
	}
}
else{
	?>
	<tr>
    <td width="45" align="center">�ӴѺ</td><td width="64" align="center">HN</td><td width="159" align="center">���� - ʡ��</td>
    <td width="165" align="center">ᾷ��</td>
    <td width="155" align="center">�ѹ��� - ����</td>
  </tr>
	<?
$rowdruga = mysql_query($sqlselectdruga);
$i=0;
while($resulta = mysql_fetch_array($rowdruga)){
?>
		<tr>
        <td align="center"><?=++$i?></td><td>&nbsp;<a href="arbs.php?row<?=$_SESSION['duid']?>=<?=$resulta['row_id']?>" target="_blank"><?=$resulta['hn']?></a></td><td>&nbsp;<?=$resulta['name_pt']?></td><td>&nbsp;<?=$resulta['name_doc']?></td><td align="center"><?=$resulta['dateup']?></td>
        </tr>
     <?
	}
}
?>
</table>