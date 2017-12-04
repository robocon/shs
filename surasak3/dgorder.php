<?php
    session_start();

    session_unregister("x");
    session_unregister("aComcode");
    session_unregister("aComname");

    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPacking");
    session_unregister("aPack");
    session_unregister("aAmount");
    session_unregister("aMinimum");
    session_unregister("aTotalstk");
    session_unregister("aPackpri");
    session_unregister("aPrice");
    session_unregister("aPackpri_vat");
    session_unregister("aPrice_vat");
 session_unregister("aSnspec");
  session_unregister("aSpec");
    session_unregister("nRunno");
    $nRunno="";
    session_register("nRunno");

    include("connect.inc");
//runno  for chktranx
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'dgorder'";
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

    $query ="UPDATE runno SET runno = $nRunno WHERE title='dgorder'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
    include("unconnect.inc");
?>
<frameset rows="40%,60%">
  <frame name="top" src="" scrolling="auto">
  <frame name="bottom" src="predgbuy.php" scrolling="auto">
  <noframes>
  <body>

  <p>This page uses frames, but your browser doesn't support them.</p>

  </body>
  </noframes>
</frameset>


