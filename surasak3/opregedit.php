


<script language="JavaScript1.2">
<!--
window.moveTo(0,0);
if (document.all) {
top.window.resizeTo(screen.availWidth,screen.availHeight);
}
else if (document.layers||document.getElementById) {
if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
top.window.outerHeight = screen.availHeight;
top.window.outerWidth = screen.availWidth;
}
}
//-->
</script>




<?php 
session_start();

$ward = array("�ͼ��������"=>"42","�ͼ����� ICU"=>"44","�ͼ������ٵ�"=>"43","�ͼ����¾����"=>"45");
$room = array("������ 300", "����� 600", "����� 800", "����� 1,200");
$book = array("������", "�ѧ�����", "�͡���¤���������", "�����");

include("connect.inc");

if(isset($_POST["add"]) && (trim($_POST["add"]) =="�ѹ�֡������" || trim($_POST["add"]) =="��䢢�����")){

$sql = "UPDATE `ipcard` SET 
`opreg` = '".$_POST["opreg"]."'
WHERE `an` = '".$_GET["Can"]."';";

$result = mysql_query($sql);

	if($result){
		echo "<script>alert('�ѹ�֡������ŧ㹰ҹ���������º��������');window.location='anchkcash.php';</script>";
		//echo "<meta http-equiv=\"refresh\" content=\"0; URL=anchkcash.php\">";
	}else{
		echo "�������ö�ѹ�֡��������";
		echo "<meta http-equiv=\"refresh\" content=\"3; URL=",$_SERVER['PHP_SELF'],"?Can=".$_GET["Can"]."&Chn=".$_GET["Chn"]."&Cdate=".$_GET["Cdate"]."\">";
	}
exit();
}

$sql = "SELECT an,hn,ptname,bedcode,my_ward, my_bedcode, my_earnest, my_confirmbk, my_food, my_cure, my_etc, my_blood,adm_w,ptright,opreg FROM ipcard  WHERE `an` = '".$_GET["Can"]."' ";

$result = mysql_query($sql);

list($an,$hn,$ptname,$bedcode,$my_ward, $my_bedcode, $my_earnest, $my_confirmbk, $my_food, $my_cure, $my_etc, $my_blood,$adm_w,$ptright,$opreg) = Mysql_fetch_row($result);

$sql = "SELECT note FROM opcard  WHERE `hn` = '".$hn."' limit 1 ";

$result = mysql_query($sql);

list($note) = Mysql_fetch_row($result);
?>
<html>
<head>
<title>�ѹ�֡�����������Ţ͹��ѵ�</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
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

-->
</style>
<SCRIPT LANGUAGE="JavaScript">

function check_number() {
e_k=event.keyCode
	if (e_k != 47 && e_k != 46 && (e_k < 48) || (e_k > 57)) {
		event.returnValue = false;
		alert("��سҡ�͡�繵���Ţ��ҹ�鹤��");
		return false;
	}else{
		return true;
	}
}

</SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"></head>
<body>
<div align="center"><a href="../nindex.htm">�������ѡ</a> || <a href="anchkcash.php">�ѹ�֡�Ѻ�������</a></div>
<FORM name="f1" METHOD=POST ACTION="" Onsubmit="return checkForm();">
<TABLE bgcolor="#FFFFDD" width="500" align="center" border="1" bordercolor="#0046D7" cellpadding="0" cellspacing="0">
<TR>
	<TD>
<TABLE width="100%">
<TR class="tb_head">
	<TD colspan="2" align="center"> �ѹ�֡�����������Ţ͹��ѵ�</TD>
</TR>
<TR>
	<TD width="50%" align="right">HN : </TD>
	<TD><?php echo $hn;?>	</TD>
</TR>
<TR>
	<TD align="right">AN : </TD>
	<TD><?php echo $an;?>	</TD>
</TR>
<TR>
	<TD align="right">���� - ʡ�� : </TD>
	<TD><?php echo $ptname;?>	</TD>
</TR>
<TR>
  <TD align="right">�Է�ԡ���ѡ�� : </TD>
  <TD style="color:#0000FF;"><?php echo $ptright;?> </TD>
</TR>
<TR>
	<TD align="right">�����˵�: </TD>
	<TD><?php echo $note;?>	</TD>
</TR>
<TR>
	<TD align="right">�����Ţ͹��ѵ� : </TD>
	<TD><input name="opreg" type="text" value="<?php echo $opreg;?>" /></TD>
</TR>
<TR>
	<TD align="right">���ѹ�֡������ : </TD>
	<TD><?php echo $_SESSION["sOfficer"];?></TD>
</TR>
<TR>
	<TD colspan="2" align="center"> 
    <? if($_GET["act"]=="edit"){ ?>
    <INPUT TYPE="submit" name="add" value=" ��䢢����� ">
    <? }else{ ?>
     <INPUT TYPE="submit" name="add" value=" �ѹ�֡������ ">&nbsp;<INPUT TYPE="reset" value=" ¡��ԡ ">
    <? } ?>
	</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>


</body>
</html>
<?php
include("unconnect.inc");
?>