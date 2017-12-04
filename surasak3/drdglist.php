<?php
    session_start();
    include("connect.inc");

    $query = "SELECT * FROM druglst WHERE drugcode = '$Dgcode'";
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
        $cDoctor = substr($sOfficer,0,5);
                  }  
   $query = "INSERT INTO drdglst(drugcode, tradname,
	genname,unit,salepri,part,slcode,bcode,drugtype,amount,
	doctor)VALUES('$cDrugcode','$cTradname','$cGenname','$cUnit',
	'$cSalepri','$cPart','$cSlcode','$cBcode','$cDrugtype','','$cDoctor');";
   $result = mysql_query($query) or 
                die("**เลือกซ้ำ !  มีในบัญชียาแล้ว");
   If ($result){
        print"ยาที่เลือก ($cDrugcode)$cTradname,$cGenname";
	};
 
/*
  drugcode, tradname, genname,unit,salepri,part,slcode,bcode,drugtype,amount,doctor

  tradname
  genname
  unit
  salepri 
  part 
  slcode
  bcode
  drugtype
  amount
  doctor
*/
   include("unconnect.inc");
?>