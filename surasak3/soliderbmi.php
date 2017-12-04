<?
include("connect.inc");
$query2 = "select prefix from runno where title = 'y_chekup'";
list($prefix)=mysql_fetch_array(mysql_query($query2));
?>
<form method="POST" action="soliderbmi1.php">
  <p><strong>รายชื่อ BMI การตรวจสุขภาพประจำปี</strong>
  <p>&nbsp;&nbsp;ปี&nbsp;&nbsp;<input type="text" name="year" size="12" value="<?=$prefix?>">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     &#3605;&#3585;&#3621;&#3591;     " name="B1">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;&#3641;</a></p>
  </form>
