<?php
    session_start();
    //wardpage.php
    session_unregister("cDepart");
    session_unregister("aDetail");
    session_unregister("cTitle");
    //ipdata.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");
    session_unregister('cDate');
    session_unregister('cBedcode');
    session_unregister('cBed');
    session_unregister('cPtname');
    session_unregister('cAge');
    session_unregister('cPtright');
    session_unregister('cDoctor');
    session_unregister('cHn');
    session_unregister('cAn');
    session_unregister('cDiag');
    session_unregister('cBedpri');
    session_unregister('cChgdate');
    session_unregister('cBedname');
    session_unregister('cAccno');
    session_unregister("nRunno");
////

    $Bedcode=$cBedcode;
    session_register("Bedcode");
  
    session_register('cBedcode');
	session_register('cBed');
	session_register('cDiag');

	$_SESSION["cBedcode"] = $_GET["cBedcode"];
	$_SESSION["cBed"] = $_GET["cBed"];
	$_SESSION["cDiag"] = $_GET["cDiag"];

	$cbedname=$_GET["cbedname"];
	
	include("connect.inc");
	 
	$sql="SELECT * FROM bed WHERE an='$cAn' limit 1";
	$result = mysql_query($sql)or die(mysql_error());
	$arr=mysql_fetch_array($result);
	
	$hn=$arr['hn'];
?>
<link href="css/stylelog.css" rel="stylesheet" type="text/css" />

<fieldset>
  <legend>�����ż�����</legend>
  <br />
<?
    echo "��§ $cBed<br>"; 
    echo "$cFulname<br> HN :  $hn    AN   : $cAn<br>";
    echo "����ԹԨ����ä : $cDiag ";
?>

</fieldset>

<form method="POST" action="ipdiagok1.php">
<fieldset>
  <legend>����¹����ԹԨ����ä��Шӵ��</legend>
<BR />
  ����¹�ä��Шӵ���� :&nbsp;
<input type="text" name="diag"  size="35">
<input type="hidden" name="hn" value="<?=$arr['hn']?>" />
<input type="hidden" name="an" value="<?=$cAn;?>" />
<input type="hidden" name="bedcode" value="<?=$arr['bedcode']?>" />
<input type="hidden" name="diag_old" value="<?=$cDiag;?>" />
<input type="hidden" name="ward" value="<?=$cbedname;?>" />
<input type="hidden" name="lastcall" value="<?=$arr['lastcalroom'];?>" />
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ��ŧ  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  ź���  " name="B2"></p>
  </fieldset>
</form>


