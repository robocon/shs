<?php
    session_start();
    include("connect.inc");
    $query = "SELECT * FROM ipcard WHERE an = '$cAn' ";
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
	$cPtname=$row->ptname;
//	$cPtright=$row->ptright;
    include("unconnect.inc");
    print "<a target=_blank href='dgreact.php'>?แพ้ยา</a>";
    print "<font face='AngsanaUPC' size='4'><b>   $cPtname,HN:$cHn, AN:$cAn,สิทธิ:$cPtright,โรค:$cDiag, แพทย์:$cDoctor, เตียง $cBed</b></font>";
?>
