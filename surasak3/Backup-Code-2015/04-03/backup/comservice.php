<?
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�ѹ�֡��û�Ժѵԧҹ �ٹ�����������</title>
<style type="text/css">
<!--
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
.style2 {	font-size: 22px;
	font-weight: bold;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style3 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<?
if($_POST["act"]=="add"){
$keydate =date('Y-m-d');
$keytime =date('H:i:s');
$datekey =$keydate." ".$keytime;
$add = "insert into comservice set datework ='$_POST[datework]',
													timework ='$_POST[timework]',
													depart='$_POST[depart]',
													idsupport='$_POST[idsupport]',
													personal='$_POST[personal]',
													detail='$_POST[detail]',
													type='$_POST[type]',
													user='$_POST[user]',
													location='$_POST[location]',													
													datekey='$datekey' ";
				if(mysql_query($add)){
					echo "<script>alert('�ѹ�֡�����������');window.location='showcomservice.php';</script>";									
				}else{
					echo "<script>alert('�Դ��Ҵ �ѹ�֡��������������');window.location='comservice.php';</script>";
				}
}
?>
<body>
<table width="80%" border="0" align="center">
  <tr>
    <td colspan="2" align="center" bgcolor="#3399CC"><span class="style3">�ѹ�֡��û�Ժѵԧҹ��Ш��ѹ</span></td>
  </tr>
  <tr>
    <td width="46%"><strong><a target="_self"  href='../nindex.htm'>&lt;--------- �����</a></strong></td>
    <td width="54%" align="right"><a href="showcomservice.php">�٢�����</a></td>
  </tr>
</table>
<? if($_GET["act"]=="win"){
$num = "A";
list($y,$m,$d)=explode("-",$datecomin);
$y=$y-543;
$newdate="$y-$m-$d";

$newtime = substr($_GET["datecomin"],11,5);


$sql = "SELECT  * FROM com_support   WHERE status ='$num' and row='$_GET[row]' ORDER BY row  ";
$query=mysql_query($sql); 
$num=mysql_num_rows($query);  
$rows =mysql_fetch_array($query);
	$datecomin = substr($rows["date"],0,10); 
	list($y,$m,$d)=explode("-",$datecomin);
	$y=$y-543;
	$newdate="$y-$m-$d";

	$newtime = substr($rows["date"],11,5);	
	
	$runnumber = $rows["row"];
	$user = $rows["user"];
	$detail = $rows["detail"];
	$programmer = $rows["programmer"];

?>
<form id="form1" name="form1" method="post" action="comservice.php">
<input name="act" type="hidden" value="add" />
<input name="idsupport" type="hidden" value="<?=$runnumber;?>" />
  <table width="100%" border="0" align="center" bgcolor="#CCCCCC">
    <tr>
      <td width="40%" align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>Ἱ������ͧ�� : </strong></td>
      <td width="60%" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="depart" id="depart" class="forntsarabun">
          <option value="0">----------���͡Ἱ�----------</option>
          <?
		  				$num = "A";
						$sql ="SELECT * FROM com_support WHERE status ='$num' and row='$_GET[row]'"; //�����Ũҡ���ҧ��ѡ
						$rs = mysql_query($sql);
						$rowsdb = mysql_fetch_array($rs);
						$depart = $rowsdb['depart']; //��ŷ���������͹�����䢢�����
					?>
          <?
						$query1 = "SELECT * from departments where status='y' order by name asc";
						$result1 = mysql_query($query1);
						while($tbrows=mysql_fetch_assoc($result1)){
							if($tbrows['name'] == $depart)
							{
					?>
          <option value="<?=$tbrows['name'];?>" selected="selected">
          <?=$tbrows['name']?>
          </option>
          <?
					}else{
					?>
          <option value="<?=$tbrows['name'];?>" >
          <?=$tbrows['name']?>
          </option>
          <?
						}
					}
					?>
        </select></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>���ͼ����ͧ�� :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><label>
        <input name="personal" type="text" id="personal" value="<?="($runnumber) $user";?>" size="30" class="forntsarabun" />
      <a href="com_support.php" target="_blank"><span style="font-size:16px; color:#FF0000;">�������駻�Ѻ��ا</span></a></label></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>�ѹ��軯Ժѵԧҹ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="datework" type="text" class="forntsarabun" id="datework" value="<? echo date('Y-m-d');?>" size="10" />        &nbsp;&nbsp;&nbsp;<span class="style2">���� : 
          <input name="timework" type="text" class="forntsarabun" id="timework" value="<? echo date('H:i');?>" size="5" /> 
      �.</span></td>
    </tr>
    <tr>
      <td align="right" valign="top" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>�������ҹ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="type" id="type" class="forntsarabun">
        <option value="0" selected="selected">----------���͡----------</option>
        <option value="1">����� SHS</option>
        <option value="2">���������</option>
        <option value="3">SHS+���������</option>
        <option value="4">��������</option>
        <option value="5">��á��/����</option>
            </select></td>
    </tr>
    <tr>
      <td align="right" valign="top" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>��������´�ҹ���� :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><label>
        <textarea name="detail" id="detail" cols="80" rows="10" class="forntsarabun"><?=$detail;?></textarea>
      </label></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>ʶҹ��軯Ժѵԧҹ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="location" type="text" id="location" value="��ͧ����������" size="40" class="forntsarabun" /></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>����Ѻ�Դ�ͺ�ҹ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="user" id="user" class="forntsarabun">
        <option value="0" selected="selected" >----------���͡----------</option>
        <option value="�����ԧ����  �ػ�ѹ��" selected="selected" <? if($programmer=="��ԧ����"){ echo "selected='selected'";}?>>��ԧ����  �ػ�ѹ��</option>
        <option value="������Թ���  �ػ�ѹ��" <? if($programmer=="���Թ���"){ echo "selected='selected'";}?>>���Թ���  �ػ�ѹ��</option>
        <option value="�����Թ  ������" <? if($programmer=="��Թ"){ echo "selected='selected'";}?>>��Թ  ������</option>
      </select></td>
    </tr>
    <tr>
      <td height="48" align="right" valign="bottom" bordercolor="#CCCCCC" bgcolor="#CCCCCC">&nbsp;</td>
      <td valign="bottom" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="button" type="submit" class="forntsarabun" id="button" value="�ѹ�֡������" />
      &nbsp;&nbsp;
      <input name="button2" type="reset" class="forntsarabun" id="button2" value="ź���" /></td>
    </tr>
  </table>
</form>
<? }else{ ?>
<form id="form1" name="form1" method="post" action="comservice.php">
<input name="act" type="hidden" value="add" />
  <table width="80%" border="0" align="center" bgcolor="#CCCCCC">
    <tr>
      <td width="20%" align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>Ἱ������ͧ�� : </strong></td>
      <td width="80%" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="depart" id="depart" class="forntsarabun">
        <option value="0">----------���͡Ἱ�----------</option>
        <?
		$sql="select  *  from   departments where status='y' order by id asc";
		$result=mysql_query($sql);
			while($arr=mysql_fetch_array($result)) {
    		echo '<option value="'.$arr['name'].'">'.$arr['name'].' </option>';
		}
	  ?>
      </select></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>���ͼ����ͧ�� :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><label>
        <input name="personal" type="text" id="personal" size="30" class="forntsarabun" />
      </label></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>�ѹ��軯Ժѵԧҹ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="datework" type="text" class="forntsarabun" id="datework" value="<? echo date('Y-m-d');?>" size="10" />
      &nbsp;&nbsp;&nbsp;<span class="style2">���� : 
      <input name="timework" type="text" class="forntsarabun" id="timework" value="<? echo date('H:i');?>" size="5" /> 
      �.</span></td>
    </tr>
    <tr>
      <td align="right" valign="top" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>�������ҹ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="type" id="type" class="forntsarabun">
        <option value="0" selected="selected">----------���͡----------</option>
        <option value="1">����� SHS</option>
        <option value="2">���������</option>
        <option value="3">SHS+���������</option>
        <option value="4">��������</option>
        <option value="5">��á��/����</option>
            </select></td>
    </tr>
    <tr>
      <td align="right" valign="top" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>��������´�ҹ���� :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><label>
        <textarea name="detail" id="detail" cols="80" rows="10" class="forntsarabun"></textarea>
      </label></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>ʶҹ��軯Ժѵԧҹ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="location" type="text" id="location" size="40" class="forntsarabun" value="��ͧ����������" /></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>����Ѻ�Դ�ͺ�ҹ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="user" id="user" class="forntsarabun">
        <option value="0" selected="selected" >----------���͡----------</option>
        <option value="�����ԧ����  �ػ�ѹ��">��ԧ����  �ػ�ѹ��</option>
        <option value="������Թ���  �ػ�ѹ��">���Թ���  �ػ�ѹ��</option>
        <option value="�����Թ  ������">��Թ  ������</option>
		<option value="��¡�ɳ��ѡ��� �ѹ���">��ɳ��ѡ��� �ѹ���</option>
      </select>      </td>
    </tr>
    <tr>
      <td height="48" align="right" valign="bottom" bordercolor="#CCCCCC" bgcolor="#CCCCCC">&nbsp;</td>
      <td valign="bottom" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="button" type="submit" class="forntsarabun" id="button" value="�ѹ�֡������" />
      &nbsp;&nbsp;
      <input name="button2" type="reset" class="forntsarabun" id="button2" value="ź���" /></td>
    </tr>
  </table>
</form>
<? } ?>
<p>&nbsp;</p>
</body>
</html>
