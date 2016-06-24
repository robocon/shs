<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
//    session_destroy();
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
//    session_unregister('cBedcode');
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

////////
session_register('cBedcode');
session_register('cBed');
$_SESSION["cBed"] = $_GET["cBed"];
$_SESSION["cBedcode"] = $_GET["cBedcode"];

 include("connect.inc");
 
$cbedname=$_GET["cbedname"];

	$sql="SELECT * FROM bed WHERE an='$cAn' limit 1";
	$result = mysql_query($sql)or die(mysql_error());
	$arr=mysql_fetch_array($result);
	
	$hn=$arr['hn'];
?>
<link href="css/stylelog.css" rel="stylesheet" type="text/css" />

<fieldset>
  <legend>ข้อมูลผู้ป่วย</legend>
  <br />
<?
echo "เตียง $cBed<br>";
echo "$cFulname<br>  HN :  $hn    AN   : $cAn<br>";
echo "แพทย์เจ้าของไข้เดิมเป็น : นพ. $cDoctor ";
?>
</fieldset>
<br />
<form method="POST" action="ipdrok.php">
<fieldset>
  <legend>เปลี่ยนแพทย์เป็น</legend>
 <br />
     &nbsp;&nbsp;แพทย์ 
 
  <?php
  
  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));

  if($menucode == "ADMMAINOPD"){
?>
<? 

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'  order by name "; 
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

	  <?php }?>
 
 
 
 </font> </p>

   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="  ตกลง  " name="B1">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="  ลบทิ้ง  " name="B2"></p>
   
<input type="hidden" name="hn" value="<?=$arr['hn']?>" />
<input type="hidden" name="an" value="<?=$cAn;?>" />
<input type="hidden" name="bedcode" value="<?=$arr['bedcode']?>" />
<input type="hidden" name="dr_old" value="<?=$cDoctor;?>" />
<input type="hidden" name="ward" value="<?=$cbedname;?>" />
<input type="hidden" name="lastcall" value="<?=$arr['lastcalroom'];?>" />
   </fieldset>
</form>


