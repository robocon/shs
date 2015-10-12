<?php
   session_start();
    session_unregister("sDgcode");  
    $sDgcode=$Dgcode;
    session_register("sDgcode"); 

    include("connect.inc");

    $query = "SELECT drugcode,tradname,genname,unit,slcode,bcode,drugnote,drugtype,had FROM druglst WHERE drugcode = '$Dgcode' ";
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

   If ($result){
        $cTradname=$row->tradname;
        $cGenname=$row->genname;
        $cSlcode=$row->slcode;
        $cBcode=$row->bcode;
        $cDrugnote=$row->drugnote;
        $cDrugtype=$row->drugtype;
		$cHad=$row->had;
                  }  
   else {
      echo "ไม่พบ รหัส : $Dgcode";
           }    
include("unconnect.inc");

?>
<body bgcolor='#339966' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
<form method='POST' action='drugeditok.php'>
<table  border="0">
  <tr>
    <td colspan="2">แก้ไขข้อมูลยา</td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong><?=$cTradname;?>, <?=$cGenname;?></strong></td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>คำเตือนการใช้ยา</td>
    <td><input type='text' name='drugnote' size='48' value='<?=$cDrugnote;?>'></td>
  </tr>
  <tr>
    <td><a target=_BLANK href='slipcode.php'>รหัสวิธีใช้ยา</a> </td>
    <td><input type='text' name='slcode' size='20' value='<?=$cSlcode;?>'></td>
  </tr>
  <tr>
    <td><a target=_BLANK href='bcode.php'>รหัสสารบัญ</a></td>
    <td><input type='text' name='bcode' size='20' value='<?=$cBcode;?>'></td>
  </tr>
  <tr>
    <td>ประเภทยา</td>
    <td><input type='text' name='drugtype' size='20' value='<?=$cDrugtype;?>'></td>
  </tr>
  <tr>
    <td>High Alert Drugs</td>
    <td><input type="radio" name="had"  id="had1"  value=""  checked="checked"/>ไม่  <input type="radio" name="had"  id="had2"  value="Y" <? if($cHad=='Y'){echo "checked"; } ?>/>ใช่
    <!--<input type='text' name='had' size='20' value='<?//=$cHad;?>'>--></td>
  </tr>
  <tr>
    <td colspan="2" align="center" ><input type='submit' value='       บันทึก       ' name='B1'> <input type='reset' value='    ลบทิ้ง    ' name='B2'></td>
    </tr>
</table>


</form>

</body>
<?
/*print "<body bgcolor='#339966' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
print "<form method='POST' action='drugeditok.php'>";
print "&nbsp;&nbsp;&nbsp;&nbsp;<b>แก้ไขข้อมูลยา</b><br><br>";
print "$cTradname, $cGenname <br>";
print "คำเตือนการใช้ยา :&nbsp;&nbsp;&nbsp;<input type='text' name='drugnote' size=48' value='$cDrugnote'><br> ";
print "<a target=_BLANK href='slipcode.php'>รหัสวิธีใช้ยา</a> :&nbsp;&nbsp;&nbsp;<input type='text' name='slcode' size=20' value='$cSlcode'><br> ";
print "<a target=_BLANK href='bcode.php'>รหัสสารบัญ</a> :&nbsp;&nbsp;&nbsp;<input type='text' name='bcode' size=20' value='$cBcode'><br>";
print "ประเภทยา :&nbsp;&nbsp;&nbsp;<input type='text' name='drugtype' size=20' value='$cDrugtype'><br>";
print "High Alert Drugs :&nbsp;&nbsp;&nbsp;<input type='text' name='had' size=20' value='$cHad'><br><br> ";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='       บันทึก       ' name='B1'>&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='reset' value='    ลบทิ้ง    ' name='B2'>&nbsp;";
print "</body>";*/
?>




    