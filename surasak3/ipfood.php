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

///////////
session_register('cBedcode');
session_register('cBed');
$_SESSION["cBedcode"] = $_GET["cBedcode"];
$_SESSION["cBed"] = $_GET["cBed"];


	 include("connect.inc");
	 
	$sql="SELECT * FROM bed WHERE an='$cAn' limit 1";
	$result = mysql_query($sql)or die(mysql_error());
	$arr=mysql_fetch_array($result);
	
	$hn=$arr['hn'];
?>
<style>
legend{
font-size: 16px;
font-weight: bold;
color:#06F
padding:0px 3px;

}
fieldset{
display:inline;
width:70%;
margin-right:40px;
}
</style>

<fieldset>
  <legend>ข้อมูลผู้ป่วย</legend>
  <br />
<?
echo "เตียง $cBed<br>";
echo "$cFulname<br> HN :  $hn    AN   : $cAn<br>";
echo "อาหารเดิมเป็น : $cFood ";
?>
</fieldset>

<form method="POST" action="ipfoodok.php">

<fieldset>
  <legend>เปลี่ยนอาหาร</legend>
    <BR />
  <table border="0">
    <tr>
      <td align="right">เปลี่ยนอาหารเป็น :</td>
      <td><select size="1" name="food">
    <option selected>อาหารปกติ</option>
    <option>อาหารอ่อน</option>
    <option>อาหารเหลว</option>
    <option>NPO (งดอาหาร, น้ำ)</option>
  </select></td>
    </tr>
    <tr>
      <td align="right"> อาหารสั่งเพิ่ม :</td>
      <td><input type="text" name="addfood" size="70"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
      
<input type="submit" value="  ตกลง  " name="B1" />
<input type="reset" value="  ลบทิ้ง  " name="B2" />

<input type="hidden" name="hn" value="<?=$arr['hn']?>" />
<input type="hidden" name="an" value="<?=$cAn;?>" />
<input type="hidden" name="bedcode" value="<?=$arr['bedcode']?>" />
<?php
$cFood = htmlspecialchars($cFood, ENT_QUOTES);
?>
<input type="hidden" name="food_old" value="<?=$cFood;?>" />
<input type="hidden" name="ward" value="<?=$cbedname;?>" />
<input type="hidden" name="lastcall" value="<?=$arr['lastcalroom'];?>" />
        
        
        </td>
    </tr>
  </table>

 
  
</fieldset>
</form>
