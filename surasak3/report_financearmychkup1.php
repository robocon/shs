<?php
session_start();
?>
<style>
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.font1{
	font-family: "TH SarabunPSK";
	font-size:20px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
</style>
<?
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" G:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
	 $doctor="$doctor1";   

    
	$today="$yr-$m-$d";
    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
	$num=1;
?>
	 <strong>�١˹���Ǩ�آ�Ҿ��Шӻ� <?=$year;?><br />
	 Ἱ�/���� <?  if($_GET["camp"]=="all"){ echo "�ء�ѧ�Ѵ";}else{ echo $camp;}?><br />
    ��§ҹ�ѹ��� <?=$Thidate;?></strong>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
 <tr>
   <th width="2%" bgcolor="6495ED">#</th>
  <th width="6%" bgcolor="6495ED">HN</th>
  <th width="5%" bgcolor="6495ED">��</th>
  <th width="15%" bgcolor="6495ED">����</th>
  <th width="4%" bgcolor="6495ED">����</th>
  <th width="11%" bgcolor="6495ED">�Ţ��Шӵ�ǻ�ЪҪ�</th>
  <th width="10%" bgcolor="6495ED">���˹�</th>
  <th width="8%" bgcolor="6495ED">�����Ҫ���</th>
  <th width="8%" bgcolor="6495ED">�ѹ���ѹ�֡������</th>
  <th width="8%" bgcolor="6495ED">��Һ�ԡ��<br />
    LAB</th>
  <th width="8%" bgcolor="6495ED">��Һ�ԡ��<br />
    XRAY</th>
  <th width="15%" bgcolor="6495ED">������Թ</th>
 </tr>

<?php
 include("connect.inc");
 if($_GET["camp"]=="all"){
 $query="SELECT * FROM opacc as a INNER JOIN chkup_solider as b ON a.hn=b.hn WHERE  a.credit='CHKUP$year' AND b.yearchkup='$year' GROUP BY a.hn ORDER by b.thidate,b.idno";
 }else{
 $query="SELECT * FROM opacc as a INNER JOIN chkup_solider as b ON a.hn=b.hn WHERE b.camp='$camp' AND a.credit='CHKUP$year' AND b.yearchkup='$year' GROUP BY a.hn ORDER by b.thidate,b.idno";
 }
 //echo $query;
  $result = mysql_query($query)or die("Query failed");
  while($rows=mysql_fetch_array($result)){	
 
?>
 <? if((!empty($rows["lab"]) || !empty($orderdate)) &&  !empty($rows["xray"]) &&  !empty($rows["opd"]) && !empty($rows["dr"])){ $bgcolor="F5DEB3";}else{ $bgcolor="F5DEB3";}?>
  <tr>
    <td align="center" bgcolor="<?=$bgcolor;?>"><?=$num;?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["hn"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["yot"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["ptname"];?></td>
	<td align="center" bgcolor="<?=$bgcolor;?>"><?=$rows["age"];?></td>
	<td align="center" bgcolor="<?=$bgcolor;?>"><?=$rows["idcard"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["position"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["ratchakarn"];?></td>
	<td align="center" bgcolor="<?=$bgcolor;?>"><?=$rows["date"];?></td>
	<td align="right" bgcolor="<?=$bgcolor;?>"><?
		$labsql="select price from opacc where hn='$rows[hn]' and depart='PATHO' and ptright='R22 ��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��' and credit='CHKUP$year'";
		$labquery=mysql_query($labsql);
		list($pricelab) = mysql_fetch_array($labquery);
		echo $pricelab;
		$totallab=$totallab+$pricelab;
	?>    </td>
	<td align="right" bgcolor="<?=$bgcolor;?>"><?
		$xraysql="select price from opacc where hn='$rows[hn]' and depart='XRAY'  and credit='CHKUP$year'";
		$xrayquery=mysql_query($xraysql);
		list($pricexray) = mysql_fetch_array($xrayquery);
		echo $pricexray;
		$totalxray=$totalxray+$pricexray;
		
	?>    </td>
	<td align="right" bgcolor="<?=$bgcolor;?>">
	<?
	$sumprice=$pricelab+$pricexray;
	echo number_format($sumprice,2);
	$totalsum=$totalsum+$sumprice;
	?>    </td>
  </tr>
<?  
$num++;
}       
?>
  <tr>
  	<td colspan="9" align="right"><strong>������Թ����Թ</strong></td>
    <td align="right"><strong>
      <?=number_format($totallab,2);?>
    </strong></td>
    <td align="right"><strong>
      <?=number_format($totalxray,2);?>
    </strong></td>
    <td align="right"><strong>
      <?=number_format($totalsum,2);?>
    </strong></td>
  </tr>
</table>
<br />
<hr />
<br />
	 <strong>���ѧ�ŷ���ѧ����ҵ�Ǩ�آ�Ҿ��Шӻ� 
	 <?=$year;?><br />
	 Ἱ�/���� <?  if($_GET["camp"]=="all"){ echo "�ء�ѧ�Ѵ";}else{ echo $camp;}?><br />
    ��§ҹ�ѹ��� <?=$Thidate;?></strong>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
 <tr>
   <th width="4%" bgcolor="#66CC99">#</th>
  <th width="9%" bgcolor="#66CC99">HN</th>
  <th width="7%" bgcolor="#66CC99">��</th>
  <th width="19%" bgcolor="#66CC99">����</th>
  <th width="8%" bgcolor="#66CC99">����</th>
  <th width="12%" bgcolor="#66CC99">�Ţ��Шӵ�ǻ�ЪҪ�</th>
  <th width="13%" bgcolor="#66CC99">���˹�</th>
  <th width="13%" bgcolor="#66CC99">�����Ҫ���</th>
  <th width="15%" bgcolor="#66CC99">�ѹ��辺ᾷ��</th>
 </tr>

<?php
 include("connect.inc");
 if($_GET["camp"]=="all"){
 $query="SELECT * FROM chkup_solider  WHERE yearchkup='$year' ORDER by idno";
 }else{
 $query="SELECT * FROM chkup_solider  WHERE yearchkup='$year' AND camp='$camp' ORDER by idno";
 }
 //echo $query;
  $result = mysql_query($query)or die("Query failed");
  while($rows=mysql_fetch_array($result)){	
 		$sql1="select hn from opacc where hn='$rows[hn]'  and credit='CHKUP$year'";
		$query1=mysql_query($sql1);
		list($chkhn) = mysql_fetch_array($query1);
		if(empty($chkhn)){
?>
 <? if((!empty($rows["lab"]) || !empty($orderdate)) &&  !empty($rows["xray"]) &&  !empty($rows["opd"]) && !empty($rows["dr"])){ $bgcolor="#CCFFCC";}else{ $bgcolor="#CCFFCC";}?>
  <tr>
    <td align="center" bgcolor="<?=$bgcolor;?>"><?=$num;?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["hn"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["yot"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["ptname"];?></td>
	<td align="center" bgcolor="<?=$bgcolor;?>"><?=$rows["age"];?></td>
	<td align="center" bgcolor="<?=$bgcolor;?>"><?=$rows["idcard"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["position"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["ratchakarn"];?></td>
    <td <? if(empty($rows["dr"])){?>bgcolor="<?=$bgcolor;?>" <? }else{ ?> bgcolor="#FF0000" <? } ?>><?=$rows["dr"];?></td>
  </tr>
<?  
	}
$num++;
}       
?>
</table>

<?
include("unconnect.inc");
?>
