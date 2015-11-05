<?php
include 'connect.php';

$q = mysql_query("SELECT `runno` FROM `runno` WHERE `title` = 'kewsold'; ") or die( mysql_query() );
$item = mysql_fetch_assoc($q);

$runno = $item['runno'] + 1;

$sql = "UPDATE `smdb`.`runno` SET `runno`='$runno' WHERE  `title`='kewsold' LIMIT 1;";
$update = mysql_query($sql) or die( mysql_query() );
if( $update ){
	?><p>อัพเดทคิวเรียบร้อย</p><?php
}
?>
<script type="text/javascript">
function CloseWindowsInTime(){
	setTimeout(function(){ window.close(); },1000);
}
CloseWindowsInTime(); 
</script>