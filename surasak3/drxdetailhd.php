<?php
    session_start();
include("connect.inc");


    session_unregister("sRow_id");
	session_unregister("sChktranx");
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aAmount");
    session_unregister("aSlipcode");
    session_unregister("cPtname");
	session_unregister("session_Date");

	session_register("sRow_id");
	session_register("sChktranx");
    session_register("x");	
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aAmount");
    session_register("aSlipcode");
	session_register("session_Date");
    session_register("cPtname");
	
	$_SESSION["sRow_id"]=$_GET["nRow_id"];
    $dDate=$_GET["sDate"];
	$_SESSION["aDgcode"] = array("������");
    $_SESSION["aTrade"]  = array("      ���͡�ä��");
    $_SESSION["aAmount"] = array("        �ӹǹ   ");
    $_SESSION["aSlipcode"] = array("        �Ը���   ");
	$_SESSION["cPtname"] = '';
	$_SESSION["x"] = 0;
  
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
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx

    $query = "SELECT * FROM dphardep WHERE row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."'"; 
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
    $sHn=$row->hn;
    $sAn=$row->an;
    $_SESSION["cPtname"] = $row->ptname;
    $sDoctor=$row->doctor;
    $sEssd=$row->essd;
    $sNessdy=$row->nessdy;
    $sNessdn=$row->nessdn;
    $sDPY=$row->dpy;
    $sDPN=$row->dpn;     
    $sNetprice=$row->price;
    $sDiag=$row->diag;
	  $sPtright=$row->ptright;
    $cPaid=$sNetprice;
	$_SESSION["session_Date"] = $row->date;
?>

<table>
 <tr >
 <th bgcolor=CD853F>����</th>
  <th bgcolor=CD853F>��¡��</th>
  <th bgcolor=CD853F>�ӹǹ</th>
  <th bgcolor=CD853F>�Ҥ�</th>
  <th bgcolor=CD853F>�Ը���</th>
   <th bgcolor=CD853F>##</th>
     <th bgcolor=CD853F>���Ը���</th>
 </tr>

<?php
    $query = "SELECT tradname,amount,price,slcode,drugcode,row_id,office FROM ddrugrx WHERE idno = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' ";
    $result = mysql_query($query) or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
    print "�ѹ��� $d/$m/$y<br>";
    print $_SESSION["cPtname"].", HN: $sHn, �Է��:$sPtright<br> ";
    print "�ä: $sDiag<br>";
//    print "ᾷ�� :$sDoctor<br><br>";
	
	$count_row = mysql_num_rows($result);
	
    while (list ($tradname,$amount,$price,$slcode,$drugcode,$row_id,$office) = mysql_fetch_row ($result)) {
        $x++;
        $_SESSION["aDgcode"][$x]=$drugcode;
        $_SESSION["aTrade"][$x]=$tradname;
        $_SESSION["aSlipcode"][$x]=$slcode;        
        $_SESSION["aAmount"][$x]=$amount;


		

if ($slcode==('HD') ){
	$slcode="�ͧ�׹�����";
	$onclick= "<A HREF='drxdeldrug.php?action=del&grow_id2=".$_GET["nRow_id"]."&grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."' target='_blank'>ź</A>";
}else
	{$slcode=$slcode;
		$onclick = "ź�����";
}

        print (" <tr>\n".
			    "  <td BGCOLOR=F5DEB3>$drugcode</td>\n".
           "  <td BGCOLOR=F5DEB3>$tradname</td>\n".
           "  <td BGCOLOR=F5DEB3>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
           "  <td BGCOLOR=F5DEB3>$slcode</td>\n".
			 
  "  <td BGCOLOR=F5DEB3><A HREF='drxdeldrug.php?action=del&grow_id2=".$_GET["nRow_id"]."&grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."' target='_blank'>ź</A></td>\n".
 "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"drxeditdrughd.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">�׹�ͧ�����</a></td>\n".
		
    "  <td BGCOLOR=F5DEB3>$office</td>\n".
			///////////////////////////////////**/////////////////////

				 // "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"drxek1.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">�������</a></td>\n".
		//	"<td BGCOLOR=F5DEB3>".$onclick."ź</A></td>\n".
           " </tr>\n");
      }
    
?>
</table>
<?php
    print "����Թ  ".$sNetprice." �ҷ<br>";
    print "ᾷ�� :".$sDoctor."<br><br>";
	print "���˹�ҷ��:".$sOfficer."<br><br>";
?>
	<a target="_blank" href="drxadddrughd.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>">������</a>&nbsp;&nbsp;<A HREF="drxadddiag.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>" target="_blank" >��䢪����ä</A>&nbsp;&nbsp;<A HREF="drxaddptr.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>" target="_blank" >������Ѻ����¹�Է�ԡó��Է���ԡ���µç&HD ��ҹ��</A><BR><BR><A HREF="drxaddsent.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>" target="_blank" >�觢����������ͧ��</A><BR>


<?php
$today1=(date("Y")+543).date("-m-d");	
$sql = "Select hn,ptname From dphardep WHERE hn = '".$sHn."' AND  date LIKE '$today1%'  and dr_cancle is null ";
	$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 1){
		list($hn,$ptname) = Mysql_fetch_row($result);
		echo "<br><br><font face='Angsana New' size='5' color='#FF0066'><center>***���������������ҡ���� 1 �*** </center></FONT>";
	}

include("unconnect.inc");
?>
