<?php
    $cHn="";
    $cPtname="";
    $cPtright="";
	    $cPtright1="";
    $nRunno="";
	$nPrintXray="";
    session_register("nRunno");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");
	    session_register("cPtright1");
	session_register("nPrintXray");

?>
<? if($_SESSION["sOfficer"]!="����ѵ�� �������"){?>
<form method="POST" action="<?php echo $PHP_SELF ?>">
  <p>�����¹͡  VN (��ҡ�Ǫ����¹)</p>
  <p>&nbsp;&nbsp;VN&nbsp;&nbsp;<input type="text" name="vn" size="8" id="aLink"> <script type="text/javascript">
document.getElementById('aLink').focus();
</script></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="   ��ŧ   " name="B1"></p>
    <p>�� �ͧ/Ἱ� �����������ͧ�������������˹��Ŵ�����ҹ��д�� 㹡óշ����㺵�Ǩ�ä �����¹�Ҥ��㺵�Ǩ�ä ���ǹ�㺵�Ǩ�ä�Ҫ����Թ�������Ѻ�� 㹡óշ�����������Թ �к�������������㹡����䢢����� 2 ������� �ҡ��äբ��������Ǩй���Ң���������к� 㹡óշ�������㺵�Ǩ�ä��е�ͧ�����Թ ����������˹��������á��͹�������������ͧ����� 㹡óշ������Ѻ�ͧᾷ�캹���˹�� �����������͹���</p>
</form>
<? } ?>
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
        print "<FONT SIZE=\"4\"  COLOR=\"#0033CC\"><strong>�ѧ�����ŧ����¹��Ǩ�ѹ���  �ô�� VN ����ҡ��ͧ����¹</strong></FONT><br>";
    
	
	//�ó�ŧ����¹����
	}else { 
        $cHn=$row->hn;
        $cPtname=$row->ptname;
        $cPtright=$row->ptright;
		
        $ipsql="select * from ipcard where hn='".$cHn."' and dcdate='0000-00-00 00:00:00' AND my_ward IS NOT NULL";
$ipquery=mysql_query($ipsql);
$iprows=mysql_fetch_array($ipquery);
$my_ward=$iprows["my_ward"];
if(mysql_num_rows($ipquery) > 0){
	echo "<script>alert('��������¹�� Admit ������ $my_ward ��سҤԴ���������繼������');</script>";
}

        //print "VN  :$vn<br>";
        //print "HN :$cHn<br>";
        //print "$cPtname<br>";
        //print "�Է�ԡ���ѡ�� :$cPtright";
        //print "<br><a href='labask.php'>���Ͷ١��ͧ ����¡�õ���</a>";
//runno  for chktranx
		print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=labask.php\">";
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

    $nRunno=$row->runno;
    $nRunno++;

    $query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
           }
   include("unconnect.inc");
   }
?>

