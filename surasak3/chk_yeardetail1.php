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
.style1 {
	font-size: 16px;
	color: #FF3333;
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
	 <strong>��ª��ͼ������Ѻ��Ǩ�آ�Ҿ��Шӻ� <?=$year;?><br />
	 Ἱ�/���� <?=$camp;?><br />
    ��§ҹ�ѹ��� <?=$Thidate;?></strong>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
 <tr>
   <th width="3%" bgcolor="6495ED">#</th>
  <th width="5%" bgcolor="6495ED">HN</th>
  <th width="4%" bgcolor="6495ED">��</th>
  <th width="11%" bgcolor="6495ED">����</th>
  <th width="3%" bgcolor="6495ED">��</th>
  <th width="3%" bgcolor="6495ED">����</th>
  <th width="8%" bgcolor="6495ED">�����</th>
  <th width="8%" bgcolor="6495ED">�Ţ��Шӵ�ǻ�ЪҪ�</th>
  <th width="7%" bgcolor="6495ED">�ѧ�Ѵ</th>
  <th width="6%" bgcolor="6495ED">���˹�</th>
  <th width="5%" bgcolor="6495ED">�����Ҫ���</th>
  <th width="5%" bgcolor="6495ED">�Է���ԡ</th>
  <th width="3%" bgcolor="6495ED">idno</th>
  <th width="6%" bgcolor="6495ED">�ѹ���ŧ����¹</th>
  <th width="4%" bgcolor="6495ED">�ѹ����Ǩ LAB</th>
  <th width="3%" bgcolor="6495ED">��� LAB</th>
  <th width="4%" bgcolor="6495ED">�ѹ��� XRAY</th>
  <th width="6%" bgcolor="6495ED">�ѹ���ѡ����ѵ�</th>
  <th width="6%" bgcolor="6495ED">�ѹ��辺ᾷ��</th>
 </tr>

<?php
 include("connect.inc");
 $query="SELECT * FROM chkup_solider WHERE camp='$camp' and yearchkup='$year' group by hn ORDER by chunyot,thidate,idno";
  $result = mysql_query($query)or die("Query failed");
  while($rows=mysql_fetch_array($result)){	
?>
 	<tr>
	<td align="center" bgcolor="F5DEB3"><?=$num;?></td>
	<td bgcolor="F5DEB3"><?=$rows["hn"];?></td>
	<td bgcolor="F5DEB3"><?=$rows["yot"];?></td>
	<td bgcolor="F5DEB3"><?=$rows["ptname"];?></td>
	<td bgcolor="F5DEB3"><? if($rows["gender"]==1){ echo "���";}else if($rows["gender"]==2){ echo "˭ԧ";}?></td>
	<td align="center" bgcolor="F5DEB3"><?=$rows["age"];?></td>
	<td bgcolor="F5DEB3"><?=substr($rows["chunyot"],5);?></td>
	<td align="center" bgcolor="F5DEB3"><?=$rows["idcard"];?></td>
	<td bgcolor="F5DEB3"><?=substr($rows["camp"],4);?></td>
	<td bgcolor="F5DEB3"><?=$rows["position"];?></td>
	<td bgcolor="F5DEB3"><?=$rows["ratchakarn"];?></td>
	<td bgcolor="F5DEB3"><? if($rows["dxptright"]==1){ echo "����Ҫ���";}?></td>
	<td bgcolor="F5DEB3"><?=$rows["idno"];?></td>  
    <td bgcolor="F5DEB3"><?=$rows["thidate"];?></td>
    <td bgcolor="F5DEB3"><?=$rows["lab"];?></td>
    <td bgcolor="F5DEB3"><?=$rows["qlab"];?></td>
    <td bgcolor="F5DEB3"><?=$rows["xray"];?></td>
    <td bgcolor="F5DEB3"><?=$rows["opd"];?></td>
    <td bgcolor="F5DEB3"><?=$rows["dr"];?></td>
  </tr>
<?  
$num++;
}       
?>
</table>
<?
include("unconnect.inc");
?>
