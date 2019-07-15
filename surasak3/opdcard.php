<?php
    session_start();
	include("connect.inc");
    if (isset($sIdname)){} else {die;} //for security
?>
<div align='left'>
  <table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td width='13%'></td>
      <td width='87%'>&nbsp;
        <p><b><font size='4'>โปรดทราบ !</font></b><br>
	ต้องการทำบัตรตรวจโรคให้เลือก  ทำบัตรตรวจโรค<br>
	ให้ทำการตรวจหาข้อมูลผู้ป่วยก่อนทำการทำประวัติใหม่
    <p>&nbsp;</p>
	<?php
	$q = mysql_query("SELECT * FROM `runno` WHERE `title` = 'kewcard' ");
	$item = mysql_fetch_assoc($q);
	$dVndate=$item['startday'];
	$nVkew=$item['runno'];
	?>        
        <a href="kewcard.php" target="_blank" onclick="refresh">คิวทำบัตรใหม่</a><br>
        <a target=_parent href="opcard.php">ทำบัตรตรวจโรค</a><br>
    
    &nbsp;&nbsp;&nbsp;&nbsp <a target=_self  href="../nindex.htm"><< ยกเลิก</a></td>
    </tr>
  </table>
</div>



