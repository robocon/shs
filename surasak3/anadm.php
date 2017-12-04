<?php
session_start();
print "  HN:  $cHn <br> ";
print "  $cPtname<br>"; 
print "สิทธิการรักษา : $cPtright<br>";

print "<form method='POST' action='anadmit.php'> ";
print "  <p>หมายเลข AN :&nbsp; <input type='text' name='vAN' size='12'></p> ";
print "  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='submit' value='      ตกลง      ' name='B1'></p> ";
print "</form> ";
?>
