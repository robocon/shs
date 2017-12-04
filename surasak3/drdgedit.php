<?php
    session_start();
    session_unregister("sDgcode");  
    $sDgcode=$Dgcode;
    session_register("sDgcode"); 

    include("connect.inc");

    $query = "SELECT drugcode,tradname,genname,unit,salepri,part,slcode,bcode,drugtype,amount,doctor
                 FROM drdglst WHERE drugcode = '$Dgcode' ";
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
        $cDrugcode=$row->drugcode;
        $cTradname=$row->tradname;
        $cGenname=$row->genname;
        $cUnit=$row->unit;
        $cSalepri =$row->salepri;
        $cPart =$row->part;
        $cSlcode =$row->slcode;
        $cBcode =$row->bcode;
        $cDrugtype =$row->drugtype;
        $nAmount=$row->amount;
//        $cDoctor = substr($sOfficer,0,5);        
                  }  
   else {
      echo "ไม่พบ รหัส : $Dgcode";
           }    
include("unconnect.inc");

print "<body bgcolor='#339966' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
print "<form method='POST' action='drdgok.php'>";
print "&nbsp;&nbsp;&nbsp;&nbsp;<b>แก้ไขข้อมูลวิธีใช้ยา จำนวนเม็ดที่สั่ง</b><br><br>";
print "รหัส : $cDrugcode <br>";
print" ชื่อการค้า :$cTradname <br>";
print" ชื่อสามัญ : $cGenname <br>";
print "<a target=_BLANK href='slipcode.php'>รหัสวิธีใช้ยา</a>  &nbsp;&nbsp;&nbsp;<input type='text' name='slcode' size=20' value='$cSlcode'><br> ";

print "จำนวนที่จะสั่ง &nbsp;<input type='text' name='amount' size='20' value='$nAmount'><br><br> ";

print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='       บันทึก       ' name='B1'>&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='reset' value='    ลบทิ้ง    ' name='B2'>&nbsp;";
print "</body>";
?>




    