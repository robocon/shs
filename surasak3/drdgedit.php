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
      echo "��辺 ���� : $Dgcode";
           }    
include("unconnect.inc");

print "<body bgcolor='#339966' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
print "<form method='POST' action='drdgok.php'>";
print "&nbsp;&nbsp;&nbsp;&nbsp;<b>��䢢������Ը����� �ӹǹ��紷�����</b><br><br>";
print "���� : $cDrugcode <br>";
print" ���͡�ä�� :$cTradname <br>";
print" �������ѭ : $cGenname <br>";
print "<a target=_BLANK href='slipcode.php'>�����Ը�����</a>  &nbsp;&nbsp;&nbsp;<input type='text' name='slcode' size=20' value='$cSlcode'><br> ";

print "�ӹǹ������� &nbsp;<input type='text' name='amount' size='20' value='$nAmount'><br><br> ";

print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='       �ѹ�֡       ' name='B1'>&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='reset' value='    ź���    ' name='B2'>&nbsp;";
print "</body>";
?>




    