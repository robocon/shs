<?php
session_start();
include("connect.inc");


if($_GET["action"] == "add"){
	
	

		$sql = "Update dphardep set whokey = '".$_POST["whokey"]."' WHERE row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' limit 1"; 
	$result = Mysql_Query($sql);
	
	if($result){
		echo "ส่งข้อมูลเรียบร้อยแล้ว";
		echo "
			<SCRIPT LANGUAGE=\"JavaScript\">
				opener.location.reload();
				window.close();		
			</SCRIPT>
		";
	}else{
		echo "ไม่สามารถส่งข้อมูลได้";
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
	<TD>ส่งข้อมูล</TD>
	<TD> <select size="1" name="whokey">
    <option selected>HD&nbsp;ส่งข้อมูลไปห้องยา</option>
    <option>ยังไม่ส่งข้อมูล</option> value="<?php echo $whokey;?>"></TD>
</TR>
<TR>
	<TD><INPUT TYPE="submit" name="submit" value="ตกลง"></TD>
</TR>
</TABLE>
</FORM>



<?php

include("unconnect.inc");
?>