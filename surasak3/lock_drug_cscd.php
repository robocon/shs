<?php
session_start();
include("connect.inc");

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
	$str = trim($str);
    return $str;
}

if(isset($_POST["submit_update"]) && $_POST["submit_update"] != ""){

	if($_POST["submit_update"] == "��͡��" && $_POST["text_alert"] == ""){
		echo "<CENTER>��ҵ�ͧ�����͡�ҡ�سҾ�����ͤ�������͹ᾷ����¤�Ѻ</CENTER>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=lock_drug_cscd.php\">";
	exit();
	}

	if($_POST["submit_update"] == "��͡��"){
		//$status = $_POST["text_alert"];
		$sql = "Update druglst set `lockptright` = 'Y' ,`lockptright_detail` = '".$_POST["text_alert"]."' Where row_id in ('".implode("','",$_POST["row_id"])."') ";
		
	}else{

		$sql = "Update druglst set `lockptright` = '' ,`lockptright_detail` = '' Where row_id in ('".implode("','",$_POST["row_id"])."') ";
	}

	$result = Mysql_query($sql);
	if($result){
		echo "�ѹ�֡���º�������Ǥ�";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=lock_drug_cscd.php\">";
	}
	exit();
}

?><html>
<head>
<title>Lock �� (�Է���ԡ���µç)</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>

<A HREF="../nindex.htm">&lt;&lt; ����</A>
</SCRIPT>
<TABLE width="100%">
<TR valign="top">
	<TD width="50%">
	<FORM name="form_search" METHOD=POST ACTION="" >
<TABLE   width="400" border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE border="0"    width="100%">
<TR  bgcolor="#3366FF" class="font_title">
	<TD colspan="2" align="center">������ (�Է���ԡ���µç)</TD>
</TR>
<TR >
	<TD  width="100" align="right">������ : </TD>
	<TD ><INPUT TYPE="text" NAME="drugcode" value="<?php echo $_POST["drugcode"];?>"></TD>
</TR>
<TR >
	<TD  width="100" align="right">���͡�ä�� : </TD>
	<TD ><INPUT TYPE="text" NAME="tradname" value="<?php echo $_POST["tradname"];?>"></TD>
</TR>
<TR>
	<TD align="right">�������ѭ : </TD>
	<TD><INPUT TYPE="text" NAME="genname" value="<?php echo $_POST["genname"];?>"></TD>
</TR>
<TR>
	<TD align="right">������ : </TD>
	<TD>
	<SELECT NAME="part">
		<Option value="">���͡������</Option>
		<Option value="DDL" <?php if($_POST["part"] == "DDL")echo " Selected ";?>>��㹺ѭ������ѡ��觪ҵ� �ԡ��</Option>
		<Option value="DDY" <?php if($_POST["part"] == "DDY")echo " Selected ";?>>�ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��(�������ᾷ��͹��ѵ�)</Option>
		<Option value="DSY" <?php if($_POST["part"] == "DSY")echo " Selected ";?>>�Ǫ�ѳ�� ����ԡ��(�����¹͡�ԡ�����,��������ԡ��)</Option>
		<Option value="DSN" <?php if($_POST["part"] == "DSN")echo " Selected ";?>>�Ǫ�ѳ�� ����ԡ�����</Option>
		<Option value="DPY" <?php if($_POST["part"] == "DPY")echo " Selected ";?>>�ػ�ó� ����ԡ��(�ԡ����������ͺҧ��ǹ)</Option>
		<Option value="DPN" <?php if($_POST["part"] == "DPN")echo " Selected ";?>>�ػ�ó� ����ԡ�����</Option>
	</SELECT>
	</TD>
</TR>
<TR>
	<TD align="right">�����͡ : </TD>
	<TD>
	<SELECT NAME="status_lock">
		<Option value="">���͡������</Option>
		<Option value="N" <?php if($_POST["status_lock"] == "N")echo " Selected ";?>>����ҷ���������͡</Option>
		<Option value="Y" <?php if($_POST["status_lock"] == "Y")echo " Selected ";?>>����ҷ����͡</Option>
	</SELECT>
	
	</TD>
</TR>
<TR>
	<TD align="center"><INPUT TYPE="submit" value="��ŧ" name="submit_search"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>
	</TD>
	<TD width="50%" align="right">
	<?php
		$sql = "Select prefix From runno where title='passdrug' limit 1";
		list($passdrug) = mysql_fetch_row(mysql_query($sql));
	?>
	&nbsp;
	</TD>
</TR>
</TABLE>


<FORM name="f1" METHOD=POST ACTION="" >
<TABLE   width="729" border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE border="0"  width="100%">
<TR  bgcolor="#3366FF" class="font_title">
	<TD width="12%" align="center" >����</TD>
	<TD width="15%" align="center" >���͡�ä��</TD>
	<TD width="16%" align="center" >�������ѭ</TD>
	<TD width="15%" align="center" >�˵ؼ�</TD>
	<TD width="16%" align="center" >�ҤҢ��</TD>
	<TD width="8%" align="center" >˹���</TD>
	<TD width="10%" align="center" >������</TD>
	<TD width="8%" align="center" >Check</TD>
</TR>
<?php

if(empty($_POST["submit_search"])){
	
	exit();
}else{
	
	if($_POST["drugcode"] != ""){
		$where .= " AND drugcode like '%".$_POST["drugcode"]."%' ";
	}

	if($_POST["tradname"] != ""){
		$where .= " AND tradname like '%".$_POST["tradname"]."%' ";
	}

	if($_POST["genname"] != ""){
		$where .= " AND genname like '%".$_POST["genname"]."%' ";
	}
	
	if($_POST["part"] != ""){
		$where .= " AND part ='".$_POST["part"]."' ";
	}

	if($_POST["status_lock"] == "Y"){
		//$where .= " AND `lock_dr` ='".$_POST["status_lock"]."' ";
		$where .= " AND `lockptright` ='Y' ";
	}
	
	if($_POST["status_lock"] == "N"){
		//$where .= " AND `lock_dr` ='".$_POST["status_lock"]."' ";
		$where .= " AND `lockptright` !='Y' ";
	}

	$where = substr($where,4);

}

$sql = "Select * From druglst where ".$where;


$result = mysql_query($sql);
while($arr = mysql_fetch_assoc($result)){

	if($arr["lockptright"]== "Y"){
		$bgcolor="#FF9393";
	}else{
		$bgcolor="#FFFFFF";
	}

?>
<TR bgcolor="<?php echo $bgcolor;?>">
	<TD><?php echo $arr["drugcode"];?></TD>
	<TD><?php echo $arr["tradname"];?></TD>
	<TD><?php echo $arr["genname"];?></TD>
	<TD><?php if($arr["lockptright"]!="Y") echo ""; else{echo $arr["lockptright_detail"];}?></TD>
	<TD><?php echo $arr["salepri"];?></TD>
	<TD><?php echo $arr["unit"];?></TD>
	<TD align="center"><?php echo $arr["part"];?></TD>
	<TD align="center"><INPUT TYPE="checkbox" NAME="row_id[]" value="<?php echo $arr["row_id"];?>"></TD>

</TR>
<?php
$rea = $arr["lock_dr"];
}	
?>
<TR>
	<TD colspan="1" align="center"><INPUT TYPE="text" NAME="text_alert" size="20" value="<?php if($rea=="Y") echo ""; else{echo $rea;}?>"></TD>
	<TD colspan="7" align="center"><INPUT TYPE="submit" name="submit_update" value="��͡��">&nbsp;&nbsp;<INPUT TYPE="submit" name="submit_update" value="�����͡��"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>


</body>
</html>
<?php include("unconnect.inc");?>
