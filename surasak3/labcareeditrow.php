<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:22px;
}
</style>
<script>
function fncSubmit(){
	var obj=document.getElementById('labtype').value;
	if(obj=='OUT'){
	if(document.f1.outlab_name.value=='')
	{
		alert('��س�кت��� Lab - �͡');
		document.f1.outlab_name.focus();
		return false;
	}	
	}
	document.f1.submit();
}


</script>
<style type="text/css">
.hd{
	font-family:"Angsana New";
	font-size: 30px;
}
.forntsarabun{
	font-family:"Angsana New";
	font-size: 22px;
}
</style>
<!--onsubmit="JavaScript:return fncSubmit();"--> <!--��ҵ�ͧ�����-->

<script type="text/javascript">

function Show(sel){
	//alert(sel);
var obj=document.getElementById('labtype').value;
if (obj=='OUT'){
if(document.getElementById('sel').style.display=='none'){
document.getElementById('sel').style.display='block';
document.getElementById('sel1').style.display='none';
} 
}else if (obj=='IN'){
	
if (document.getElementById('sel').style.display=='block'){
document.getElementById('sel').style.display='none';
document.getElementById('sel1').style.display='none';

}
}
}

</script>

<body onload="Show(sel);">
<?php
include("connect.inc");

$sql="select * from labcare Where row_id='".$_GET['rowid']."'";
$query=mysql_query($sql);
$dbarr=mysql_fetch_array($query);
?>

<form name="f1" action="" method="post"   onSubmit="JavaScript:return fncSubmit();">
<table border="1" cellspacing="0" cellpadding="0" class="font1" style="border-collapse:collapse; font-weight: bold;" bordercolor="#666666">
  <tr>
    <td colspan="2" align="center" bgcolor="#0099FF">��䢢�����</td>
 
  </tr>
  <tr>
    <td>codelab</td>
    <td><input type="text" name="codelab"  value="<?php echo $dbarr['codelab'];?>" class="font1"/></td>
  </tr>
  <tr>
    <td>Part</td>
    <td><select name="part" class="font1">
     <option value="" >--��س����͡--</option>
    <option value="Heamato" <?php if($dbarr['labpart']=="Heamato"){ echo "selected"; }?>>Heamato</option>
    <option value="Chemistry" <?php if($dbarr['labpart']=="Chemistry"){ echo "selected"; }?>>Chemistry</option>
    <option value="Micros" <?php if($dbarr['labpart']=="Micros"){ echo "selected"; }?>>Micros</option>
    <option value="Micro" <?php if($dbarr['labpart']=="Micro"){ echo "selected"; }?>>Micro</option>
    <option value="Serology" <?php if($dbarr['labpart']=="Serology"){ echo "selected"; }?>>Serology</option>
    <option value="Outlab" <?php if($dbarr['labpart']=="Outlab"){ echo "selected"; }?>>Outlab</option>
    <option value="Blood Bank" <?php if($dbarr['labpart']=="Blood Bank"){ echo "selected"; }?>>Blood Bank</option>
    </select>
    </td>
  </tr>
  <tr>
    <td>������Lab  </td>
    <td>
      <select name="labtype"  id="labtype" class="font1" onChange="Show(this);" >
        <option value="" >--��س����͡--</option>
        <option value="IN" <?php if($dbarr['labtype']=="IN"){ echo "selected"; }?>>LAB �</option>
        <option value="OUT"  <?php if($dbarr['labtype']=="OUT"){ echo "selected"; }?>>LAB �͡</option>
      </select>
<div id="sel" style="display:none"><select name="outlab_name" class="font1">
    <option value="" >--��س����͡ Lab-�͡ --</option>
      <option value="�Ѱ���" <?php if($dbarr['outlab_name']=="�Ѱ���"){ echo "selected"; }?>>�Ѱ���</option>
      <option value="�Թ����-�Ż" <?php if($dbarr['outlab_name']=="�Թ����-�Ż"){ echo "selected"; }?>>�Թ����-�Ż</option>
      <option value="������-�Ż" <?php if($dbarr['outlab_name']=="������-�Ż"){ echo "selected"; }?>>������-�Ż</option>	  <option value="��ا෾-��Ҹ�" <?php if($dbarr['outlab_name']=="��ا෾-��Ҹ�"){ echo "selected"; }?>>��ا෾-��Ҹ�</option>
      <option value="���ʵ���-�Ż" <?php if($dbarr['outlab_name']=="���ʵ���-�Ż"){ echo "selected"; }?>>���ʵ���-�Ż</option>
    </select></div></td>
  </tr>

  <tr>
    <td>ʶҹ�</td>
    <td><select name="status" class="font1">
    <option value="" >--��س����͡--</option>
      <option value="Y" <?php if($dbarr['labstatus']=="Y"){ echo "selected"; }?>>��ҹ</option>
      <option value="N" <?php if($dbarr['labstatus']=="N"){ echo "selected"; }?>>�����ҹ</option>
    </select></td>
  </tr>
    <tr>
    <td>chkup</td>
    <td><input type="text" name="chkup"  value="<?php echo $dbarr['chkup'];?>" class="font1"/></td>
  </tr>
    <tr>
      <td>Report LabNo.</td>
      <td><input type="text" name="reportlabno"  value="<?php echo $dbarr['reportlabno'];?>" class="font1"/></td>
    </tr>
  <tr>
    <td colspan="2" align="center">
     <input type="hidden" name="rowid"  value="<?=$_GET['rowid']?>" class="font1"/>
    <input type="submit" name="b1"  value="��ŧ" class="font1"/>
    <a target=_self  href='../nindex.htm' class="font1"><---- �����</a>
    </td>
  </tr>
</table>
</form>

<?php
if(isset($_POST['b1'])){
	include("connect.inc");
	
	$update="UPDATE labcare SET  codelab='".$_POST['codelab']."',outlab_name='".$_POST['outlab_name']."',labpart='".$_POST['part']."',labtype='".$_POST['labtype']."',labstatus='".$_POST['status']."',chkup='".$_POST['chkup']."',reportlabno='".$_POST['reportlabno']."' Where row_id='".$_POST['rowid']."' ";
	$query1=mysql_query($update);
	
	if($query1){

		echo "<h1 align=center class='font1'>��䢢������������º��������    ���ѧ............��Ѻ˹����¡��</h1>";
		echo "<meta http-equiv='refresh' content='3; url=labcareedit1.php'>" ;
	}
	
	
}
?>
</body>
</html>