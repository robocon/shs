<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:22px;
}
</style>
<script>

function Show(sel){
	
	var obj=document.getElementById('labtype').value;
	if (obj=='OUT'){
		if(document.getElementById('sel').style.display=='none'){
		document.getElementById('sel').style.display='block';
		// document.getElementById('sel1').style.display='none';
	
		document.getElementById('outlab_part').style.display='table-row';
	

		} 
	}else if (obj=='IN'){
		
		if (document.getElementById('sel').style.display=='block'){
		document.getElementById('sel').style.display='none';
		// document.getElementById('sel1').style.display='none';
		document.getElementById('outlab_part').style.display='none';

		}
	}
}

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
.del-item{
  color: blue;
}
.del-item:hover{
  text-decoration: underline;
  cursor: pointer;
}
</style>
<?
include("connect.inc");
if($_POST["act"]=="add"){
	$add1="INSERT INTO labcare SET depart='PATHO',
													 part='".$_POST["part"]."',
													 code='".$_POST["code"]."',
													 codex='".$_POST["codex"]."',
													 codelab='".$_POST["codelab"]."',
													 detail='".$_POST["detail"]."',
													 unit='".$_POST["unit"]."',
													 price='".$_POST["price"]."',
													 yprice='".$_POST["yprice"]."',
													 nprice='".$_POST["nprice"]."',
													 labpart='".$_POST["labpart"]."',
													 labtype='".$_POST["labtype"]."',
													 outlab_name='".$_POST["outlab_name"]."',
													 labstatus='Y',
													 reportlabno='99',
													 lab_list='0',
													 version='Create'";
	//echo $add;													 
	$query=mysql_query($add1);
	if($query){
		echo "<script>alert('�ѹ�֡���������º����');window.location='labcareedit1.php';</script>";
	}else{
		echo "<script>alert('�ѹ�֡�������������� ��س��ͧ�����ա����');</script>";
	}											 
}
?>
<form name="f1" action="lab_add.php" method="post"   onSubmit="JavaScript:return fncSubmit();">
<input name="act" type="hidden" value="add">
<table width="685" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#666666" class="font1" style="border-collapse:collapse; font-weight: bold;">
  <tr>
    <td colspan="2" align="center" bgcolor="#00CC99">������������¡�� LAB</td>
  </tr>
  <tr>
    <td width="150">���ʤԴ�Թ</td>
    <td width="478"><input type="text" name="code"   class="font1"/></td>
  </tr>
  <tr>
    <td>���ʡ���ѭ�ա�ҧ</td>
    <td><input type="text" name="codex"   class="font1"/></td>
  </tr>
  <tr>
    <td>���� Sticker</td>
    <td><input type="text" name="codelab"  class="font1" id="codelab"/></td>
  </tr>
  <tr>
    <td>��������´</td>
    <td><input name="detail" type="text" class="font1"   size="60"/></td>
  </tr>
  <tr>
    <td>˹���</td>
    <td><input type="text" name="unit"  class="font1" id="unit"/> 
      �� Test, Unit, ���� �繵�</td>
  </tr>
  <tr>
    <td>�Ҥ�</td>
    <td><input type="text" name="price"  class="font1" id="price"/></td>
  </tr>
  <tr>
    <td>�Ҥ��ԡ��</td>
    <td><input type="text" name="yprice"  class="font1" id="yprice"/></td>
  </tr>
  <tr>
    <td>�Ҥ��ԡ�����</td>
    <td><input type="text" name="nprice"  class="font1" id="nprice"/></td>
  </tr>
  <tr>
    <td>Part</td>
    <td><select name="part" class="font1" id="part">
      <option value="" >--��س����͡--</option>
      <option value="LAB">LAB</option>
      <option value="BLOOD">BLOOD</option>
    </select></td>
  </tr>
  <tr>
    <td>Labpart</td>
    <td><select name="labpart" class="font1">
    <option value="" >--��س����͡--</option>
    <option value="Heamato">Heamato</option>
    <option value="Chemistry">Chemistry</option>
    <option value="Micros">Micros</option>
    <option value="Micro">Micro</option>
    <option value="Serology">Serology</option>
    <option value="Outlab">Outlab</option>
    <option value="Blood Bank">Blood Bank</option>
    </select>    </td>
  </tr>
  <tr>
    <td>������Lab  </td>
    <td>
      <select name="labtype"  id="labtype" class="font1" onChange="Show(this);" >
        <option value="" >--��س����͡--</option>
        <option value="IN">LAB �</option>
        <option value="OUT">LAB �͡</option>
      </select>
<div id="sel" style="display:none"><select name="outlab_name" class="font1">
    <option value="" >--��س����͡ Lab-�͡ --</option>
      <option value="�Ѱ���">�Ѱ���</option>
      <option value="�Թ����-�Ż">�Թ����-�Ż</option>
      <option value="������-�Ż">������-�Ż</option>
      <option value="��ا෾-��Ҹ�">��ا෾-��Ҹ�</option>
      <option value="���ʵ���-�Ż">���ʵ���-�Ż</option>
    </select></div></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <input type="submit" name="b1"  value="����������" class="font1"/>
    <a target=_self  href='../nindex.htm' class="font1"><---- �����</a>&nbsp;&nbsp;&nbsp;
    <a target=_self  href='labcareedit1.php' class="font1">�٢�������¡�� LAB</a>
        </td>
  </tr>
</table>
</form>
