<?php
session_start();
include("connect.inc");


if($_GET["action"] == "add"){
	
	

		$sql = "Update dphardep set ptright = '".$_POST["ptright"]."' WHERE row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' limit 1"; 
	$result = Mysql_Query($sql);
	
	if($result){
		echo "����Է�ԡ���ѡ�����º��������";
		echo "
			<SCRIPT LANGUAGE=\"JavaScript\">
				opener.location.reload();
				window.close();		
			</SCRIPT>
		";
	}else{
		echo "�������ö����Է�ԡ���ѡ����";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=drxaddptr.php?sDate=".$_GET["sDate"]."&nRow_id=".$_GET["nRow_id"]."\">";
	}
	exit();

}

$sql = "Select ptright  From dphardep where row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' limit 1 ";
$result = Mysql_Query($sql);
list($ptright) = Mysql_fetch_row($result);

?>

<FORM METHOD=POST ACTION="drxaddptr.php?action=add&sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>">
<TABLE>
<TR>
	<TD>�Է�ԡ���ѡ��</TD>
	<TD> <select size="1" name="ptright">
    <option selected>R18 HD �ç����ԡ���µç (CSCD)</option>
    <option>R18 HD �ç����ѡ���ä� (HD)</option> value="<?php echo $ptright;?>"></TD>
</TR>
<TR>
	<TD><INPUT TYPE="submit" name="submit" value="��ŧ"></TD>
</TR>
</TABLE>
</FORM>



<?php

include("unconnect.inc");
?>