<?php
   session_start();

    $cDepart = 'EMER';
   $cDetail=$cDiag;
   $cTitle="������¡����ͧ�ء�Թ";
   session_register("cDepart");
   session_register("cDetail");
   session_register("cTitle");

   $m=0;
    $aLabcode = array("����");
    $aDetail  = array("��¡��");
    $aEachprice  = array("�Ҥ� ");
    $aLabpart = array("part");
    $aTime = array("        �ӹǹ   ");
    $aItemprice= array("       ����Թ   ");
    $nLabprice="";   
    $cLabpart="";
    $cAccno=0;
    session_register("m");
    session_register("aLabcode");
    session_register("aDetail");
    session_register("aEachprice");
    session_register("aLabpart");
    session_register("aTime");
    session_register("aItemprice");
    session_register("nLabprice");
    session_register("cLabpart");
    session_register("cAccno"); 

    $aYprice = array("�Ҥ� ");
    $aNprice = array("�Ҥ� ");
    $aSumYprice = array("�Ҥ� ");
    $aSumNprice = array("�Ҥ� ");
    session_register("aYprice");
    session_register("aNprice");
    session_register("aSumYprice");
    session_register("aSumNprice");

	//begin  runno  for chktranx
    $nChktranx="";
    session_register("nChktranx");
    include("connect.inc");
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
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
    $nChktranx=$row->runno;
    $nChktranx++;
    $query ="UPDATE runno SET runno = $nChktranx WHERE title='depart'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
   include("unconnect.inc");

   print "�ԹԨ����ä :$cDiag<br>";
   print "*��觷��ѵ������ͧ�ء�Թ*<br>";
//   print"<a target=_BLANK href='labform.php'>Check Box</a><br>";
   print"<a target=_BLANK href='lablist.php'>���͡��¡�èҡ��ͧ�ء�Թ </a><br>";
//   print"<a target=_BLANK href='labsuit.php'>���ٵ�</a><br>";
?>



