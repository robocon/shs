<?
session_start();
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style1 {color: #FF0000}
-->
</style></head>

<body>
<?
if($_POST["act"]=="add"){
$sql="select row from opcardchk order by row desc limit 0,1";
//echo $sql;
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);

$newrow=$rows["row"]+1;

	$add="insert into opcardchk set HN='$_POST[HN]',
												   row='$newrow',
												   exam_no='$_POST[exam_no]',
												   pid='$_POST[pid]',
												   name='$_POST[name]',
												   part='$_POST[part]',
												   course='$_POST[course]',
												   branch='$_POST[branch]',
												   datechkup='$_POST[datechkup]',
												   active='$_POST[active]'";
	//echo $add;
	if(mysql_query($add)){
		echo "<script>alert('�ѹ�֡���������º���¤�Ѻ');</script>";
	}else{
		echo "<script>alert('�������úѹ�֡�������� ��س��ͧ�����ա���� !!!');</script>";
	}			
}

$sql="select HN,exam_no from opcardchk order by row desc limit 0,1";
//echo $sql;
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);
?>
<p align="center"><strong>������ª��͹ѡ�֡���Ҫ����59</strong></p>
<form name="form1" action="<? $PHP_SELF;?>" method="post">
<input type="hidden" name="act" value="add" />
<input type="hidden" name="part" value="�Ҫ����59" />
<input type="hidden" name="active" value="y" />
<table width="40%" border="2" align="center" cellpadding="4" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#66CC99">
  <tr>
    <td><strong>�ӴѺ���</strong></td>
    <td align="center"><strong>:</strong></td>
    <td><input type="text" name="exam_no" id="exam_no" />
      &nbsp;����ش ��� 
      <span class="style1"><?=$rows["exam_no"];?></span>
      </td>
  </tr>
  <tr>
    <td width="24%"><strong>HN</strong></td>
    <td width="3%" align="center"><strong>:</strong></td>
    <td width="73%"><input type="text" name="HN" id="HN" />
      &nbsp;����ش ���    
      <span class="style1"><?=$rows["HN"];?></span>
      </td>
  </tr>
  <tr>
    <td><strong>���ʹѡ�֡��</strong></td>
    <td align="center"><strong>:</strong></td>
    <td><input type="text" name="pid" id="pid" /></td>
  </tr>
  <tr>
    <td><strong>���� - ���ʡ��</strong></td>
    <td align="center"><strong>:</strong></td>
    <td><input type="text" name="name" id="name" /></td>
  </tr>
  <tr>
    <td><strong>�����</strong></td>
    <td align="center"><strong>:</strong></td>
    <td><select name="course" id="course">
    <option value="������к�">������к�</option>
    <?
	$sql="select distinct(course) from opcardchk where part='�Ҫ����59' order by row asc";
	$query=mysql_query($sql);
	while($rows=mysql_fetch_array($query)){
	?>
      <option value="<?=$rows["course"];?>"><?=$rows["course"];?></option>
    <? } ?>
    </select>    </td>
  </tr>
  <tr>
    <td><strong>�ز�/�Ң�</strong></td>
    <td align="center"><strong>:</strong></td>
    <td><select name="branch" id="branch">
    <option value="������к�">������к�</option>
    <?
	$sql="select distinct(branch) from opcardchk  where part='�Ҫ����59' order by row asc";
	$query=mysql_query($sql);
	while($rows=mysql_fetch_array($query)){
	?>
      <option value="<?=$rows["branch"];?>"><?=$rows["branch"];?></option>
    <? } ?>
    </select></td>
  </tr>
  <tr>
    <td><strong>�ѹ����Ǩ</strong></td>
    <td align="center"><strong>:</strong></td>
    <td><select name="datechkup" id="datechkup">
      <?
	$sql="select distinct(datechkup) from opcardchk  where part='�Ҫ����59' order by row asc";
	$query=mysql_query($sql);
	while($rows=mysql_fetch_array($query)){
	?>
      <option value="<?=$rows["datechkup"];?>">
        <?=$rows["datechkup"];?>
        </option>
      <? } ?>
    </select></td>
  </tr>
</table>
<p align="center"><input name="submit" type="submit" value="�ѹ�֡������" /></p>
</form>
<hr />
<p align="center"><strong>��ª��͹ѡ�֡���Ҫ����59</strong></p>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="2%" align="center" bgcolor="#66CC99"><span class="style5">�ӴѺ</span></td>
    <td width="5%" align="center" bgcolor="#66CC99"><span class="style5">HN</span></td>
    <td width="10%" align="center" bgcolor="#66CC99"><span class="style5">���ʹѡ�֡��</span></td>
    <td width="19%" align="center" bgcolor="#66CC99"><span class="style5">���� - ���ʡ��</span></td>
    <td width="17%" align="center" bgcolor="#66CC99"><span class="style5">�����</span></td>
    <td width="28%" align="center" bgcolor="#66CC99"><span class="style5">�Ң�</span></td>
    <td width="14%" align="center" bgcolor="#66CC99">�ѹ����Ǩ</td>
  </tr>
<?
$sql="select * from opcardchk where part='�Ҫ����59' order by row desc";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
if($i%2==0)
{
$bg = "#CCCCCC";
}
else
{
$bg = "#FFFFFF";
}
?>  
  <tr bgcolor="<?=$bg;?>">
    <td align="center"><?=$i;?></td>
    <td><?=$rows["HN"];?></td>
    <td><?=$rows["pid"];?></td>
    <td><?=$rows["name"];?></td>
    <td><?=$rows["course"];?></td>
    <td><?=$rows["branch"];?></td>
    <td><?=$rows["datechkup"];?></td>
  </tr>
<?
}
?>  
</table>
</body>
</html>
