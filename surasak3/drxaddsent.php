<?php
session_start();
include("connect.inc");


if($_GET["action"] == "add"){
	
	

		$sql = "Update dphardep set whokey = '".$_POST["whokey"]."' WHERE row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' limit 1"; 
	$result = Mysql_Query($sql);
	
	if($result){
		echo "�觢��������º��������";
		echo "
			<SCRIPT LANGUAGE=\"JavaScript\">
				opener.location.reload();
				window.close();		
			</SCRIPT>
		";
	}else{
		echo "�������ö�觢�������";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=drxaddsent.php?sDate=".$_GET["sDate"]."&nRow_id=".$_GET["nRow_id"]."\">";
	}
	exit();

}

$sql = "Select whokey  From dphardep where row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' limit 1 ";
$result = Mysql_Query($sql);
list($whokey) = Mysql_fetch_row($result);

?>

<FORM METHOD=POST ACTION="drxaddsent.php?action=add&sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>">
<TABLE>
<TR>
	<TD>�觢�����</TD>
	<TD> <select size="1" name="whokey">
    <option selected>HD&nbsp;�觢��������ͧ��</option>
    <option>�ѧ����觢�����</option> value="<?php echo $whokey;?>"></TD>
</TR>
<TR>
	<TD><INPUT TYPE="submit" name="submit" value="��ŧ"></TD>
</TR>
</TABLE>
</FORM>



<?php

include("unconnect.inc");
?>