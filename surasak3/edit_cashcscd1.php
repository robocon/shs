<?php
session_start();
include("connect.inc");
 $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$sql = "Select idname From opacc where row_id = '".$_GET["id"]."' ";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);

//if($_SESSION["sOfficer"] != $arr["idname"] ){

//echo "�����¤�Ѻ �����Ź�� ����§ ".$arr["idname"]." ��ҹ�鹷������¹��";

//exit();

//}


if(isset($_POST["submit"])){
	

	
	$sql = "Update opacc set credit ='".$_POST["credit"]."', credit_detail = '".$_POST["detail_1"]."',idname='".$_SESSION["sOfficer"]."',lastupdate='$Thidate' where row_id = '".$_POST["idrow"]."'   ";

	Mysql_Query($sql);
	echo "��䢢��������º�������Ǥ�Ѻ";
	echo "
		<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){

			opener.location.href='opmonrepcscdc.php';

		}
		
		</SCRIPT>
	
	";
	exit();


}

include("unconnect.inc");
?>
<SCRIPT LANGUAGE="JavaScript">

	function checkformf1(){
		
		if(document.f1.credit[0].checked == false && document.f1.credit[1].checked == false && document.f1.credit[2].checked == false && document.f1.credit[3].checked == false && document.f1.credit[4].checked == false && document.f1.credit[5].checked == false && document.f1.credit[6].checked == false && document.f1.credit[7].checked == false && document.f1.credit[8].checked == false){
			alert("��س����͡�Ը� �����Թ���¤�Ѻ");
			return false;
		}else if((document.f1.credit[1].checked == true || document.f1.credit[2].checked == true) && document.f1.detail_1.value == ''){
			alert("�ó� �������Թ���� �ѵ��ôԵ ����͡������ �����Ţ�Ţ�ѵ��ôԵ ���¤�Ѻ");
			document.f1.detail_1.focus();
			return false;
		}else if(document.f1.credit[6].checked == true && document.f1.detail_1.value == ''){
			alert("�ó� �������ԹẺ �Թ���� ����͡������ ������� ���¤�Ѻ");
			document.f1.detail_1.focus();
			return false;
		}else if(document.f1.credit[7].checked == true && document.f1.detail_1.value == ''){
			alert("�óշ�����͡ ���� ����͡������ ������� ���¤�Ѻ");
			document.f1.detail_1.focus();
			return false;
		}

	}


</SCRIPT>

��䢢����š�è����Թ

<FORM name="f1" METHOD=POST ACTION="" onsubmit="return checkformf1();">
<TABLE>
		 <TR>
		 <TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='�ԴC' onclick="document.getElementById('detail1').innerHTML='���ʷ��Դ'; detailhead1.style.display='';document.f1.detail_1.focus();"></TD>
		 	<TD>�ԴC</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='¡��ԡc' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
		 	<TD colspan="6">¡��ԡ</TD>
		 </TR>
		 <TR>
		 	<TD colspan="8"><span id='detailhead1' style='display:none'><span id='detail1'></span><INPUT TYPE='text' NAME='detail_1'></span></TD>
		 </TR>
		 <TR>
		 	<TD colspan="8"><INPUT TYPE="submit" name="submit" value="��ŧ"></TD>
		 </TR>
		 </TABLE>
		 <INPUT TYPE="hidden" name="idrow" value="<?php echo $_GET["id"];?>">
</FORM>