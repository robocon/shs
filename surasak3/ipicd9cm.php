<?php
  session_start();

  print " <font face='Angsana New'>$cPtname, AN:$cAn, HN:$cHn<br>";
  print " วันรับป่วย:$cDate<br>";
   print " โรค $cDiag,ลงรหัส ICD9CM และวันที่ทำหัตถการในช่องว่าง<br>"; 
 print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ICD9CM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;............. วันที่<b>";
?>
<form method="POST" action="ipicd9ok.php">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="icd9cm1" size="15">&nbsp<input type="text" name="icddate1" size="20"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="icd9cm2" size="15">&nbsp;<input type="text" name="icddate2" size="20"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="icd9cm3" size="15">&nbsp;<input type="text" name="icddate3" size="20"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="icd9cm4" size="15">&nbsp;<input type="text" name="icddate4" size="20"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="icd9cm5" size="15">&nbsp;<input type="text" name="icddate5" size="20"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="icd9cm6" size="15">&nbsp;<input type="text" name="icddate6" size="20"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="icd9cm7" size="15">&nbsp;<input type="text" name="icddate7" size="20"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="icd9cm8" size="15">&nbsp;<input type="text" name="icddate8" size="20"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="icd9cm9" size="15">&nbsp;<input type="text" name="icddate9" size="20"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="icd9cm10" size="15">&nbsp;<input type="text" name="icddate10" size="20"><br>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="       &#3605;&#3585;&#3621;&#3591;       " 
  name="B1">&nbsp;&nbsp;&nbsp;&nbsp;  <input type="reset" value="    &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  " name="B2">


