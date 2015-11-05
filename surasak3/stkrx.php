<?php
    session_start();
//    session_destroy();
//stkseek.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aExpdate");
    session_unregister("aLotno");
    session_unregister("aAmount");
    session_unregister("aUnit");
    session_unregister("aDglotno");
    session_unregister("aStkcut");
    session_unregister("cTotal");
    session_unregister("cRestkcut");
    session_unregister("aTotalstk");
    session_unregister("aMainstk");
    session_unregister("aStock");

    session_unregister("nRunno");
    $nRunno="";
    session_register("nRunno");

    include("connect.inc");
//runno  for chktranx
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'stktranx'";
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

    $nRunno=$row->runno;
    $nRunno++;

    $query ="UPDATE runno SET runno = $nRunno WHERE title='stktranx'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
    include("unconnect.inc");
?>
<frameset rows="50%,50%">
  <frame name="top" src="" scrolling="auto">
  <frame name="bottom" src="stkufrm.php" scrolling="auto">
  <noframes>
  <body>

  <p>This page uses frames, but your browser doesn't support them.</p>

  </body>
  </noframes>
</frameset>


