<?php
session_start();

include("connect.inc");

if(isset($_GET["del"])){

$sql = "Delete From stiker_prepack where prepack_id = '".$_GET["id"]."' ";
$result = Mysql_Query($sql);

echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=prepack.php\">";
exit();

}

	$sql ="Select a.prepack_id,  a.drugcode,  a.total,  a.lot , a.startdate , a.enddate, b.tradname   From stiker_prepack as a , druglst  as b where a.drugcode  = b.drugcode  Order by drugcode ASC ";
	$result = Mysql_Query($sql);

include("unconnect.inc");

?>

<style type="text/css">
<!--
.title {font-family: "MS Sans Serif"; font-size:14px;color: "#FFFFFF";}
.detail {font-family: "MS Sans Serif"; font-size:14px}
-->
</style>

<TABLE cellpadding="0" cellspacing="0" width="99%" border="1" bordercolor="#3300FF">
<TR>
	<TD>
<TABLE align="center" width="100%" border="0">
<TR align="center" class="title" bgcolor="#3300FF">
	<TD><B>������</B></TD>
	<TD><B>���͡�ä��</B></TD>
	<TD><B>�ӹǹ</B></TD>
	<TD><B>Lot. No.</B></TD>
	<TD><B>�ѹ��Ե</B></TD>
	<TD><B>�ѹ�������</B></TD>
	<TD><B>���</B></TD>
	<TD><B>ź</B></TD>
	<TD><B>�����</B></TD>
</TR>
<?php 
$i=0;
while($arr = Mysql_fetch_assoc($result)){
	
	if($i ==0){
		$color = "#FFFF99";
		$i=1;
	}else{
		$color = "#FFFFEE";
		$i=0;
	}
	
?>
<TR class="detail" bgcolor="<?php echo $color;?>">
	<TD><?php echo $arr["drugcode"];?></TD>
	<TD><?php echo $arr["tradname"];?></TD>
	<TD><?php echo $arr["total"];?></TD>
	<TD><?php echo $arr["lot"];?></TD>
	<TD align="center"><?php echo $arr["startdate"];?></TD>
	<TD align="center"><?php echo $arr["enddate"];?></TD>
	<TD align="center"><a target='left'  href="dgstrik.php?id=<?php echo $arr["prepack_id"];?>&edit=true">���</A></TD>
	<TD align="center"><A HREF="prepack.php?id=<?php echo $arr["prepack_id"];?>&del=true">ź</A></TD>
	<TD align="center"><A HREF="phar_sticker.php?id=<?php echo $arr["prepack_id"];?>" target="_blank">�����</A></TD>
</TR>
<?php }?>
</TABLE>
</TD>
</TR>
</TABLE>










