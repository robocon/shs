<?php
    session_start();
    session_unregister("cRow_id");
    session_unregister("cDrugcode");

    $cRow_id=$sRow_id;
    $cDrugcode='$sDrugcode';
    session_register("cRow_id");
    session_register("cDrugcode");

    //print"sRow_id=$sRow_id<br>";
    include("connect.inc");
    $query = "SELECT * FROM poitems WHERE row_id = '$sRow_id' ";
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
    $cDrugcode =$row->drugcode;
    $cTradname=$row->tradname;

    $cPacking    =$row->packing;
    $cPack         =$row->pack;
    $nMinimum =$row->minimum;
    $nTotalstk   =$row->totalstk; //not edit
    $nPackpri    =$row->packpri;
    $nAmount    =$row->amount;
    $sPrice       =$row->price;  //auto
    $nFree        =$row->free;
    $cSpecno    =$row->specno;

    session_register("sPrice");

    include("unconnect.inc");

    print"<font face='Angsana New'><b>�����䢢�����  ����䢷��ҹ�����Ŵ���</b><br>";
    print"����: $cDrugcode,   ���͡�ä��: $cTradname<br>";

    print"<form method='POST' action='packeditok.php'>";
    print"˹��¹Ѻ......................<input type='text' name='packing' size='20' value='$cPacking'><br>";
    print"��Ҵ��è�...................<input type='text' name='pack' size='20' value='$cPack'><br>";
    print"�ӹǹ�ҧ�дѺ.........<input type='text' name='minimum' size='20' value='$nMinimum'><br>";
    print"�ӹǹ����ѧ............ $nTotalstk ˹���<br>";    
    print"�Ҥ�(������VAT)........<input type='text' name='packpri' size='20' value='$nPackpri'><br>";
    print"�ӹǹ���.....................<input type='text' name='amount' size='20' value='$nAmount'><br>";
    print"�Ҥ����������............$sPrice �ҷ<br>";
    print"��................................<input type='text' name='free' size='20' value='$nFree'><br>";
    print"specno. .........................<input type='text' name='specno' size='20' value='$cSpecno'><br>";
    print"<br><input type='submit' value='      ��ŧ      ' name='B1'></font></p>";
    print"</form>";

?>