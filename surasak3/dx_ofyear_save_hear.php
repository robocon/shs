<?php
session_start();
include("connect.inc");
$daten = (date("Y")+543).date("-m-d H:i:s");

$sqlrun = "select prefix from runno where title='y_chekup' ";
$rowrun = mysql_query($sqlrun);
list($prefix) = mysql_fetch_array($rowrun);
$prefix="25".$prefix;

$sql ="insert into chk_hear (date,hn,ptname,age,hear500R,hear500L,hear1000R,hear1000L,hear2000R,hear2000L,hear3000R,hear3000L,hear4000R,hear4000L,hear6000R,hear6000L,hear8000R,hear8000L,Lowright,Lowleft,Highright,Highleft,ptaright1,ptaleft1,ptaright2,ptaleft2,yearchk) value('$daten','$hn','$ptname','$age','$right1','$left1','$right2','$left2','$right3','$left3','$right4','$left4','$right5','$left5','$right6','$left6','$right7','$left7','$tone1','$tone2','$tone3','$tone4','$pta1','$pta2','$pta3','$pta4','$prefix')";
$result = mysql_query($sql);

if($result){
	echo "บันทึกข้อมูลเรียบร้อยแล้วคะ";
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=dx_ofyear_hear.php\">";
}
?>