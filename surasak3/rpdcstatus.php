<?
include("connect.inc");
if(isset($_POST['search'])){
$sql = "select * from dcstatus where status like '%������ͷ��ǹ%' and date like '".$_POST['year']."-".$_POST['month']."%' ";
$rows = mysql_query($sql);
?>
<style>
.font1{
	font-family:AngsanaUPC;
  	font-size:18px;
}
</style>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="font1">
<tr><td align="center">�ӴѺ</td><td align="center">�ѹ���</td><td align="center">AN / HN / ����-ʡ��</td><td align="center">�ä</td><td align="center">�˵ؼŷ�跺�ǹ</td><td align="center">���</td><td align="center">������</td></tr>
<?
while($result = mysql_fetch_array($rows)){
	$sql2 = "select * from ipcard where an = '".$result['an']."' ";
	$rows2 = mysql_query($sql2);
	$result2 = mysql_fetch_array($rows2);
	$i++;
	$rep = explode(" ",$result['status']);
	$date = substr($result['date'],8,2)."-".substr($result['date'],5,2)."-".substr($result['date'],0,4);
?>
	<tr><td align="center"><?=$i?></td><td><?=$date?></td><td><?=$result['an']." / ".$result2['hn']." / ".$result2['ptname']?></td><td><?=$result2['diag']?></td><td><?=$result['status2']?></td><td><?=$rep[1]." ".$rep[2]?></td><td><?=$rep[3]?></td></tr>
<?
}
?>
</table>
<?
}else{
?>
<a target=_self  href='../nindex.htm'><<�����</a>
<form action="<? $_SERVER['PHP_SELF']?>" method="post" target="_blank">
<table width="37%" border="0">
  <tr>
    <td height="39">��§ҹ����������ѵԼ������</td>
  </tr>
  <tr>
    <td height="50">��͹
      <select size="1" name="month">
        <option value="01" <?php if(date("m")=="01") echo " Selected "; ?> >���Ҥ�</option>
        <option value="02" <?php if(date("m")=="02") echo " Selected "; ?> >����Ҿѹ��</option>
        <option value="03" <?php if(date("m")=="03") echo " Selected "; ?> >�չҤ�</option>
        <option value="04" <?php if(date("m")=="04") echo " Selected "; ?> >����¹</option>
        <option value="05" <?php if(date("m")=="05") echo " Selected "; ?> >����Ҥ�</option>
        <option value="06" <?php if(date("m")=="06") echo " Selected "; ?> >�Զع�¹</option>
        <option value="07" <?php if(date("m")=="07") echo " Selected "; ?> >�á�Ҥ�</option>
        <option value="08" <?php if(date("m")=="08") echo " Selected "; ?> >�ԧ�Ҥ�</option>
        <option value="09" <?php if(date("m")=="09") echo " Selected "; ?> >�ѹ��¹</option>
        <option value="10" <?php if(date("m")=="10") echo " Selected "; ?> >���Ҥ�</option>
        <option value="11" <?php if(date("m")=="11") echo " Selected "; ?> >��ɨԡ�¹</option>
        <option value="12" <?php if(date("m")=="12") echo " Selected "; ?> >�ѹ�Ҥ�</option>
      </select>
      ��
      <select name="year">
        <?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
        <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
        <?php }?>
      </select></td>
  </tr>
  <tr>
    <td height="53"><input type="submit" name="search" id="search" value="     ��ŧ     "></td>
  </tr>
</table>

</form>
<?
}
?>