<?php
   session_start();
   print "ผู้ป่วยนอก<br>";
   print "HN :$cHn<br>";
 print "VN:$tvn<br>";
   print "ชื่อ:$cPtname<br>";
   print "สิทธิการรักษา :$cPtright<br>";
?>
<script>
function check()
{
	if(document.getElementById("doctor").selectedIndex=='0'){
		alert("กรุณาเลือกแพทย์");
		return false;
	}
	else{
		return true;
	}
}
</script>
<form method="POST" action="prerx.php" onsubmit="return check();">
  <p><font face="Angsana New"><a target=_BLANK href='diaghlp.htm'>&#3650;&#3619;&#3588;</a>&nbsp;&nbsp;&nbsp; 
  <input type="text" name="diag" size="15" id="aLink"> <script type="text/javascript">
document.getElementById('aLink').focus();
</script>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></p>
  <p><font face="Angsana New">&#3649;&#3614;&#3607;&#3618;&#3660; 

  <?php
   include("connect.inc");
  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));

  if($menucode == "ADMMAINOPD"){
  ?>
  
  <? 

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" id="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>



  
	  <?php }else{?>
	  <? 
	 $strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" id="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>

	  <?php }?>

</font> </p>

  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input type="submit" value="   &#3605;&#3585;&#3621;&#3591;   " name="B1"></font></p>
</form>


