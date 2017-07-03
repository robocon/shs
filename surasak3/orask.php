<?php
   session_start();
   print "ผู้ป่วยนอก<br>";
   print "HN :$cHn<br>";
     print "VN:$tvn<br>";

   print "$cPtname<br>";
   print "สิทธิการรักษา :$cPtright<br>";
?>
<form method="POST" action="preor.php">
  <p><font face="Angsana New">&nbsp;&nbsp;<a target=_BLANK href='diaghlp.htm'>&#3650;&#3619;&#3588;</a>&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;<input type="text" name="diag" size="20">&nbsp;</font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;</font><font face="Angsana New">&#3649;&#3614;&#3607;&#3618;&#3660;&nbsp;&nbsp;
  </font><font face="Angsana New">
  
  <?php
   include("connect.inc");
  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));

  if($menucode == "ADMNID"){
  ?>
  
  <? 

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode ='ADMNID'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>



  
	  <?php }else  if($menucode == "ADMDEN"){

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode ='ADMDEN'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
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
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>

	  <?php }?></font></p>

  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input type="submit" value="   &#3605;&#3585;&#3621;&#3591;   " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp; <input type="reset" value=" &#3618;&#3585;&#3648;&#3621;&#3636;&#3585; " name="B2"></font></p>
</form>
