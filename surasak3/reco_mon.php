<?php
    $cHn="";
    $cPtname="";
    $cPtright="";
    $nRunno="";
	$nPrintXray="";
    session_register("nRunno");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");
	session_register("nPrintXray");

?>
<a href="../nindex.htm" class="forntsarabun"><<����� </a>
<form method="POST" action="<?php echo $PHP_SELF ?>">
	<u><p>�ԡ��ǹ�Թ�� RECORMON</p></u>
  <p>�����¹͡  VN (��ҡ�Ǫ����¹)</p>
  <p>&nbsp;&nbsp;VN&nbsp;&nbsp;<input type="text" name="vn" size="8" id="aLink"> <script type="text/javascript">
document.getElementById('aLink').focus();
</script></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="   ��ŧ   " name="B1"></p>
</form>

<?php
$tvn="$vn";
 session_register("tvn");
If (!empty($vn)){
    include("connect.inc");

    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
    $thdatevn=$d.'-'.$m.'-'.$yr.$vn;
// ��Ǩ�����ŧ����¹�����ѧ
    $query = "SELECT * FROM opday WHERE thdatevn = '$thdatevn'";
    $result = mysql_query($query)
        or die("Query failed,opday");
/*
    echo mysql_errno() . ": " . mysql_error(). "\n";
    echo "<br>";
*/
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }	
//�ó��ѧ���ŧ����¹
    If (empty($row->hn)){
        print "VN :$vn<br>";
        print "�ѧ�����ŧ����¹��Ǩ�ѹ���  �ô�� VN ����ҡ��ͧ����¹<br>";
                                    }
//�ó�ŧ����¹����
   else { 
        $cHn=$row->hn;
        $cPtname=$row->ptname;
        $cPtright=$row->ptright;
		

        //print "VN  :$vn<br>";
        //print "HN :$cHn<br>";
        //print "$cPtname<br>";
        //print "�Է�ԡ���ѡ�� :$cPtright";
        //print "<br><a href='labask.php'>���Ͷ١��ͧ ����¡�õ���</a>";
//runno  for chktranx
		print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=recinfo.php\">";
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'phardep'";
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

    $_SESSION["sChktranx"]=$row->runno;
    $_SESSION["sChktranx"]++;

    $query ="UPDATE runno SET runno = ".$_SESSION["sChktranx"]." WHERE title='phardep'";
    $result = mysql_query($query) or die("Query failed");
//end  runno  for chktranx
           }
   include("unconnect.inc");
   }
?>

