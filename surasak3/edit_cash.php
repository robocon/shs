<?php
session_start();
include("connect.inc");

		$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		$nPrefix=$row->prefix;
		
		
 $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
 
if($_SESSION["sOfficer"]=="Administrator"){

}else{
$sql = "Select idname From opacc where row_id = '".$_GET["id"]."' ";
//echo $sql;
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);


$xxx = explode(" ",$_SESSION["sOfficer"]);
if($xxx[0] == "�ҧ"){
	$xxx1 = substr($_SESSION["sOfficer"],4);
}else if($xxx[0] == "�ҧ���"){
	$xxx1 = substr($_SESSION["sOfficer"],7);
}else{
	$xxx1 = $_SESSION["sOfficer"];
}


$yyy = explode(" ",$arr["idname"]);
if($yyy[0] == "�ҧ"){
	$yyy1 = substr($arr["idname"],4);
}else if($yyy[0] == "�ҧ���"){
	$yyy1 = substr($arr["idname"],7);
}else{
	$yyy1 = $arr["idname"];
}
	if($xxx1 != $yyy1){
		if($_SESSION["sOfficer"] =="CSCD"){ //���͹� cscd ���ྪ� �Ѵ������� �������������ѹ��� 23/06/60
		
		}else{
			echo "�����¤�Ѻ �����Ź�� ����§ ".$arr["idname"]." ��ҹ�鹷������¹��";
			exit();
		}
	}
}
if(isset($_POST["submit"])){
	

	
	$sql = "Update opacc set credit ='".$_POST["credit"]."', credit_detail = '".$_POST["detail_1"]."' ,idname='".$_SESSION["sOfficer"]."',lastupdate='$Thidate'where row_id = '".$_POST["idrow"]."'   ";

	Mysql_Query($sql);
	echo "��䢢��������º�������Ǥ�Ѻ";
	echo "
		<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){

			opener.location.href='opdate.php';

		}
		
		</SCRIPT>
	
	";
	exit();


}

include("unconnect.inc");
?>
<SCRIPT LANGUAGE="JavaScript">

	function checkformf1(){
		
		if(document.f1.credit[0].checked == false && document.f1.credit[1].checked == false && document.f1.credit[2].checked == false && document.f1.credit[3].checked == false && document.f1.credit[4].checked == false && document.f1.credit[5].checked == false && document.f1.credit[6].checked == false && document.f1.credit[7].checked == false && document.f1.credit[8].checked == false && document.f1.credit[9].checked == false && document.f1.credit[10].checked == false && document.f1.credit[11].checked == false){
			alert("��س����͡�Ը� �����Թ���¤�Ѻ");
			return false;
		}else if((document.f1.credit[1].checked == true || document.f1.credit[2].checked == true) && document.f1.detail_1.value == ''){
			alert("�ó� �������Թ���� �ѵ��ôԵ ����͡������ �����Ţ�Ţ�ѵ��ôԵ ���¤�Ѻ");
			document.f1.detail_1.focus();
			return false;
		}else if(document.f1.credit[7].checked == true && document.f1.detail_1.value == ''){
			alert("�ó� �������ԹẺ �Թ���� ����͡������ ������� ���¤�Ѻ");
			document.f1.detail_1.focus();
			return false;
		}else if(document.f1.credit[8].checked == true && document.f1.detail_1.value == ''){
			alert("�óշ�����͡ ���� ����͡������ ������� ���¤�Ѻ");
			document.f1.detail_1.focus();
			return false;
		}

	}


</SCRIPT><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 24px;
}

.fontsarabun {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>

<strong>��䢢����š�è����Թ</strong>
<FORM name="f1" METHOD=POST ACTION="" onsubmit="return checkformf1();">
<TABLE width="80%">
		 <TR>
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='�Թʴ' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
		 	<TD>�Թʴ</TD>
		 	<td align='right'>&nbsp;&nbsp;
		 	    <input type='radio' name='credit' value='������' onclick="document.getElementById('detail1').innerHTML='�����Ţ�ѵ��ôԵ'; detailhead1.style.display='';document.f1.detail_1.focus();" /></td>
		 	<td>�ѵ��ôԵ �.������</td>
		 	<td align='right'>&nbsp;&nbsp;
		 	    <input type='radio' name='credit' value='���µç' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';" /></td>
		 	<td>���µç</td>
		 	<td align='right'>&nbsp;&nbsp;
		 	    <input type='radio' name='credit' value='���µç ͻ�.' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';" /></td>
		 	<td>���µç ͻ�.</td>
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='��Сѹ�ѧ��' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
		 	<TD>��Сѹ�ѧ��</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='30�ҷ' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
		 	<TD>30�ҷ</TD>
		 	<td align='right'>&nbsp;&nbsp;
		 	    <input type='radio' name='credit' value='����' onclick="document.getElementById('detail1').innerHTML='�������������'; detailhead1.style.display='';document.f1.detail_1.focus();" /></td>
		 	<td>����</td>
		 	<td align='right'>&nbsp;&nbsp;
                <input type='radio' name='credit' value='HD' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';" /></td>
		 	<td>HD</td>           
		 </TR>
		 <TR>
		   <td align="right"><input type='radio' name='credit' value='CHKUP<?=$nPrefix;?>' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';" /></td>
		   <td>CHKUP
		     <?=$nPrefix;?></td>
		   <td align='right'>&nbsp;&nbsp;
		       <input type='radio' name='credit' value='��44' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';" /></td>
		   <td>��.44</td>
		   <TD align='right'>&nbsp;</TD>
		 	<TD>&nbsp;</TD>                    
		    <TD>&nbsp;</TD>
		    <TD>&nbsp;</TD>
		 </TR>
		 <TR>
		   <td align='right'>&nbsp;&nbsp;
		       <input type='radio' name='credit' value='¡��ԡ' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';" /></td>
		   <td>¡��ԡ</td>
		   <TD align='right'>&nbsp;</TD>
		   <TD>&nbsp;</TD>
		   <TD align='right'>&nbsp;</TD>
		   <TD>&nbsp;</TD>
		   <TD>&nbsp;</TD>
		   <TD>&nbsp;</TD>
    </TR>
		 <TR>
		 	<TD colspan="8"><span id='detailhead1' style='display:none'><span id='detail1'></span><INPUT TYPE='text' NAME='detail_1'></span></TD>
		 </TR>
		 <TR>
		 	<TD>&nbsp;</TD>
		    <TD><input type="submit" name="submit" class="fontsarabun" value="   �ѹ�֡   " /></TD>
		    <TD>&nbsp;</TD>
		    <TD>&nbsp;</TD>
		    <TD>&nbsp;</TD>
		    <TD>&nbsp;</TD>
		    <TD>&nbsp;</TD>
		    <TD>&nbsp;</TD>
		 </TR>
		 </TABLE>
  <INPUT TYPE="hidden" name="idrow" value="<?php echo $_GET["id"];?>">
</FORM>