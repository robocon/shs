<?php
    session_start();
	include("connect.inc");
	
//-------------------------�� druginteraction	
	$csql = "SELECT a.drugcode FROM ddrugrx as a, drugslip as b WHERE a.slcode = b.slcode AND a.idno = '".$_GET["nRow_id"]."'   AND a.date = '".$_GET["sDate"]."' ";
	//echo $csql;
	$cquery=mysql_query($csql);
	$cnum=mysql_num_rows($cquery);
	while($crows=mysql_fetch_array($cquery)){
		$cdrugcode=$crows["drugcode"];
		$fsql="select first_drugcode, between_drugcode from drug_interaction where first_drugcode='$cdrugcode'";
		//echo $fsql;
		$fquery=mysql_query($fsql);
		$fnum=mysql_num_rows($fquery);
		if($fnum > 0){
			//echo "<script>alert('�� $cdrugcode �Դ INTERACTION �Ѻ�Ҵѧ���仹�� ";
				while($frows=mysql_fetch_array($fquery)){
					$bdrugcode=$frows["between_drugcode"];
					echo "$bdrugcode,";
				}
			echo "');</script>";
		}else if($fnum < 1){
			$bsql="select first_drugcode, between_drugcode from drug_interaction where first_drugcode='$cdrugcode'";
			//echo $bsql;
			$bquery=mysql_query($bsql);
			$bnum=mysql_num_rows($bquery);		
			if($bnum > 0){
				//echo "<script>alert('�� $cdrugcode �Դ INTERACTION �Ѻ�Ҵѧ���仹�� ";
					while($frows=mysql_fetch_array($fquery)){
						$fdrugcode=$frows["first_drugcode"];
						echo "$fdrugcode,";
					}
				echo "');</script>";	
			}else{
				//echo "<script>alert('�� $cdrugcode ����Դ DRUGINTERACTION �Ѻ������";
					while($frows=mysql_fetch_array($fquery)){
						echo "";
					}
				echo "</script>";				
			}	//close if $bnum
		} //close if $fnum
	}  //close while $crows
//----------------------------���� druginteraction

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
	//echo $query."<br>";
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
    $cPaid=$sNetprice;
	$_SESSION["session_Date"] = $row->date;
	  $sPtright=$row->ptright;
	  $stkcutdate_now = $row->stkcutdate;

//�礡�����Ѻ�� Balm ��� 1 ��ʹ/��͹ 
$chkDate=(date("Y")+543)."-".date("m");  //��-��͹ �Ѩ�غѹ
$sqlb="select * from drugrx where `date` like '$chkDate%' and hn='".$sHn."' and drugcode='4MET25' and part='DDL' and amount >0";
//echo $sqlb;
$queryb=mysql_query($sqlb);
$numb=mysql_num_rows($queryb);
$rowsb=mysql_fetch_array($queryb);
$datebalm=$rowsb["date"];
if($numb > 0){
	echo "<script>alert('������ HN : $sHn ���Ѻ�� 4MET25 ��ջ�Ш���͹ $chkDate ����� ������ѹ��� $datebalm');</script>";
}

//�礡�����Ѻ�� �ž�ԡ ��� 1 ��ʹ/��͹ 
$sqlj="select * from drugrx where `date` like '$chkDate%' and hn='".$sHn."' and drugcode='10H014' and part='DDL' and amount >0";
$queryj=mysql_query($sqlj);
$numj=mysql_num_rows($queryj);
$rowsj=mysql_fetch_array($queryj);
$datejel=$rowsj["date"];
if($numj > 0){
	echo "<script>alert('������ HN : $sHn ���Ѻ�� 10H014 ��ջ�Ш���͹ $chkDate ����� ������ѹ��� $datejel');</script>";
}



//----------------------------������
$rsql= "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$sHn."' ";
$rquery = mysql_query($rsql);
$rnum=mysql_num_rows($rquery);		
if($rnum > 0){
	echo "<script>alert('������ HN : $sHn �ջ���ѵ����Ҵѧ���仹�� ";
	while($rrows= mysql_fetch_array($rquery)){
			$tradname=$rrows["tradname"];
			$advreact=$rrows["advreact"];
			$asses=$rrows["asses"];
			echo "$tradname...$advreact($asses), ";			
	}
	echo "');</script>";	
}else{
	//echo "<script>alert('������ HN : $sHn ����ջ���ѵ�����');";  
}
//----------------------------��������
?>
<script>

function chkin(){
	if(document.getElementById('cut2').style.display=='none'){
		document.getElementById('cut2').style.display='block';
		document.getElementById('cut1').style.display='none';
	}
	else if(document.getElementById('cut2').style.display=='block'){
		document.getElementById('cut2').style.display='none';
		document.getElementById('cut1').style.display='block';
	}
}
</script>
<?php 
$visit_date = substr($_GET['sDate'], 0, 10);
$sqlDiag = "SELECT `diag`,`type`,`diag_thai` FROM `diag` WHERE `regisdate` LIKE '$visit_date%' AND `hn` = '$sHn' ";
$res = mysql_query($sqlDiag);
if( mysql_num_rows($res) > 0 ){
	?>
	<div>
		<b>Diag �ҡᾷ��: </b>
		<table cellpadding="3" cellspacing="0" bordercolor="#000000" border="1" style="font-size: 13px;">
			<?php 
			while ($item = mysql_fetch_assoc($res)) {
				?>
				<tr>
					<td><?=$item['type'];?></td>
					<td>
						<?php 
						echo $item['diag'];
						if( $item['diag_thai'] ){
							echo ' ( '.$item['diag_thai'].' ) ';
						}
						?>
					</td>
				</tr>
				<?php
			}
			?>
		</table>
	</div>
	<?php
}
?>
<table>
 <tr >
 <th bgcolor=CD853F><font face='Angsana New'>#</th>
 <th bgcolor=CD853F><font face='Angsana New'>����</th>
  <th bgcolor=CD853F><font face='Angsana New'>��¡��</th>
    <th bgcolor=CD853F><font face='Angsana New'>part</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ</th>
  <th bgcolor=CD853F><font face='Angsana New'>�Ҥ�</th>
  <th bgcolor=CD853F><font face='Angsana New'>�Ը���</th>
  <th bgcolor=CD853F><font face='Angsana New'>����Ը���</th>
<!--  <th bgcolor=CD853F><font face='Angsana New'>ź</th>-->
   <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>��ҧ����</th>
   <th bgcolor=CD853F><font face='Angsana New'>���˹�ҷ��</th>
   <th bgcolor=CD853F><font face='Angsana New'>��䢨ӹǹ</th>
    
 </tr>

<?php
$inject = false;
    //$query = "SELECT tradname,amount,price,slcode,drugcode,row_id,office,detail1,detail2, detail3, detail4 FROM ddrugrx ,WHERE idno = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' ";
	
	// $query = "SELECT a.tradname,a.drugcode, a.amount, a.price, a.slcode,a.row_id, a.part,a.office, b.detail1, b.detail2, b.detail3, b.detail4, a.drug_inject_amount,a.drug_inject_unit, a.drug_inject_amount2,a.drug_inject_unit2,a.drug_inject_time,a.drug_inject_slip,a.drug_inject_etc,a.injno 
	// FROM ddrugrx as a, 
	// drugslip as b 
	// WHERE a.slcode = b.slcode 
	// AND a.idno = '".$_GET["nRow_id"]."'   
	// AND a.date = '".$_GET["sDate"]."' ";

	$query = "SELECT a.tradname,a.drugcode, a.amount, a.price, a.slcode,a.row_id, a.part,a.office, b.detail1, b.detail2, b.detail3, b.detail4, a.drug_inject_amount,a.drug_inject_unit, a.drug_inject_amount2,a.drug_inject_unit2,a.drug_inject_time,a.drug_inject_slip,a.drug_inject_etc,a.injno 
	FROM ddrugrx as a  
	LEFT JOIN drugslip as b ON b.slcode = a.slcode
	WHERE a.idno = '".$_GET["nRow_id"]."'   
	AND a.date = '".$_GET["sDate"]."' ";

	//echo $query;
    $result = mysql_query($query) or die("Query failed");
$n='0';
    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
	
	$sdate=substr($_GET["sDate"],0,10);
	list($y1,$m1,$d1)=explode("-",$sdate);
	$chkdatevn="$d1-$m1-$y1".$_GET["sVn"];
	
	$sqlopday = "select toborow,diag from opday where hn='$sHn' and thdatevn = '$chkdatevn'";
	//echo $sqlopday;
	$res= mysql_query($sqlopday) or die("Query failed");
	list($toborow,$diagnosis) = mysql_fetch_row($res);
	$tob = substr($toborow,0,4);
	
	
    print "<font face='Angsana New'>�ѹ��� $d/$m/$y&nbsp;&nbsp;";
    print $_SESSION["cPtname"].", <font face='Angsana New'>HN: $sHn, <B>�Է��:$sPtright</B><br> ";
    // print "<font face='Angsana New'>�ä: $diagnosis<br>";
	print "<font face='Angsana New' size=5 color=FF0000>����: ";
	$query12 = "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$sHn."' ";
    $result12 = mysql_query($query12) or die("Query failed");
	while(list ($tradname,$advreact,$asses) = mysql_fetch_row ($result12)){
		echo $tradname."...".$advreact."(".$asses.") ";
	}
	print "</font>";
//    print "ᾷ�� :$sDoctor<br><br>";
	
	$count_row = mysql_num_rows($result);
    while (list ($tradname,$drugcode,$amount,$price,$slcode,$row_id,$part,$office,$detail1,$detail2,$detail3,$detail4,$drug_inject_amount,$drug_inject_unit,$drug_inject_amount2,$drug_inject_unit2,$drug_inject_time,$drug_inject_slip,$drug_inject_etc,$injno) = mysql_fetch_row ($result)) {
        $x++;
		$n++;
        $_SESSION["aDgcode"][$x]=$drugcode;
        $_SESSION["aTrade"][$x]=$tradname;
        $_SESSION["aSlipcode"][$x]=$slcode;        
        $_SESSION["aAmount"][$x]=$amount;
	
		if($_SESSION["aDgcode"][$x]=='1DILA' || $_SESSION["aDgcode"][$x]=='1GPO30*'  || $_SESSION["aDgcode"][$x]=='20SGPO30'  || $_SESSION["aDgcode"][$x]=='20SGPO30' || $_SESSION["aDgcode"][$x]=='1COTR4' || $_SESSION["aDgcode"][$x]=='1ALLO3'){

$color="#00CCFF";
}else{
$color="F5DEB3";
}

$ptright=substr($sPtright,0,3);
//echo $ptright."...<br>";
//if($ptright=="R07" || $ptright=="R09"){
	if($drugcode=="4MET25" || $drugcode=="10H014"){
		if($part=="DDN"){
			$comment="<strong style='color:#FF0000'>(�ԡ�����)</strong>";
		}else if($part=="DDL"){
			$comment="<strong style='color:#0000FF'>(�ԡ��)</strong>";
		}else{
			$comment="";
		}
	}else{
		$comment="";
	}
/*}else{
	$comment="";
}*/

		if($count_row ==1)
		$onclick= "<A HREF='#' onclick=\"alert('��س� �������¡����������ҧ���� 1 ��¡�ä�Ѻ');\">";
	else
		$onclick= "<A HREF='drxdeldrug.php?action=del&grow_id2=".$_GET["nRow_id"]."&grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."' target='_blank'>";

			$c1 = substr($drugcode,0,1);
			$c2 = substr($drugcode,0,2);
			if($injno!=""){ $injectno = "($injno)";}
			
        print (" <tr BGCOLOR=$color>\n".
		   "  <td><font face='Angsana New'>$n</td>\n".
		   "  <td><font face='Angsana New'>$drugcode</td>\n".
           "  <td><font face='Angsana New'>$tradname $injectno</td>\n".
		   "  <td><font face='Angsana New'>$part<br>$comment</td>\n".
           "  <td><font face='Angsana New'><span id=\"amount_value".$x."\">$amount</span>
		   <input type=\"text\" style=\"display:none\" name=\"amount".$x."\" value=\"".$amount."\" id=\"amount".$x."\" size=\"5\"></td>\n".
           "  <td><font face='Angsana New'>$price</td>");
		if($c2!='20'&&($c1=='2'||$c1=='0')){
			if($tob!="EX10"){$inject=true; }
			//$inject=true;
echo "  <td><font face='Angsana New'>$drug_inject_slip $drug_inject_amount $drug_inject_unit $drug_inject_amount2 $drug_inject_unit2 $drug_inject_time $drug_inject_etc</td>";	
		}else{
echo "  <td><font face='Angsana New'>$slcode $detail1 $detail2 $detail3 $detail4</td>";
		}
        echo "  <td><font face='Angsana New'><a target=_blank  href=\"drxeditdrug.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\" onclick=\"return confirm('�׹�ѹ�������Ը���')\">����Ը���</a></td>\n".
			//"<td><font face='Angsana New'>".$onclick."ź</A></td>\n".
  "  <td>#</td>\n".
  
			"  <td><font face='Angsana New'><a target=_blank  href=\"drxremain.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\" onclick=\"return confirm('�׹�ѹ��ä�ҧ����')\">��ҧ����</a></td>\n".
			
			    //"  <td><font face='Angsana New'><a target=_blank  href=\"drxremain.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">���Ѵ</a></td>\n".
					
// "  <td><font face='Angsana New'><a target=_blank  href=\"drxremain1.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">�Ѵ</a></td>\n".
			   "  <td><font face='Angsana New'>$office</td>\n".		
			   "  <td><font face='Angsana New'><a href=\"#\" onclick=\"window.open('upd_cdrug.php?nrow=$row_id',null,'height=300,width=320,scrollbars=0')\">��䢨ӹǹ</a></td>\n".
		//			  "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"drxek1.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">�������</a></td>\n".
		//	"<td BGCOLOR=F5DEB3>".$onclick."ź</A></td>\n".
		
           " </tr>";
      }
    
?>
</table>
<?php
    print "<font face='Angsana New'>����Թ  ".$sNetprice." �ҷ&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<font face='Angsana New'>ᾷ�� :".$sDoctor."<br>";
	if($stkcutdate_now !=""){
		$inject=false;
	}
if($inject){
?>
<input name="chkinject" value="1" type="checkbox" checked="checked" onclick="chkin();" /> �Դ�ҤҤ�ҩմ�� 20 �ҷ<br />
<?php 
}
echo "<table><tr>";
		if($stkcutdate_now ==""){
	?>
    <a target="_blank" href="drxadddrug.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>"><font face='Angsana New'>������</font></a>&nbsp;&nbsp;
   
	<!--<A HREF="drxadddiag.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>" target="_blank" ><font face='Angsana New'>��䢪����ä</font></A>--> <!--�Ѻ����� ˹.��ͧ�� (�����) ���Դ���� �ѹ��� 31/08/2560--><BR> 
    <td>
    <div id='cut1' style="display:block"><a target="_blank" href="drxstkcut.php?inject" <? if($inject==true){ ?> onclick="return confirm('�׹�ѹ��äԴ��ҩմ��'); "<? }?>>�Ѵʵ�͡��</a></div><div id='cut2' style="display:none"><a target="_blank" href="drxstkcut.php">�Ѵʵ�͡��</a></div>
    </td>
	<?php }else{ ?>
	<td><FONT COLOR="#FF0000"><B>�µѴʵ�͡����</B></FONT>&nbsp;&nbsp;&nbsp;</td>
	<?php }?>
    </td>
    <td><a target="_blank" href="drxprint.php"><font face='Angsana New'>�����������</a></td>
    <td><a target="_blank" href="slipprntest1.php"><font face='Angsana New'>�������ҡ��������(2560)</a></td>
    <td><a target="_blank" href="slipprntest1_new.php"><font face='Angsana New'>�������ҡ���������(2561)</a></td>
	<td><a target="_blank" href="drxprintopd.php"><font face='Angsana New'>��������¡���ҡ�Ѻ��ҹ</a></td>
	<td><a target="_blank" href="drxprintopd1.php"><font face='Angsana New'>�����ʵԡ����Դ	OPD</a></td>
    <td><a target="_blank" href="appoilst_inj.php?Thn=<?=$sHn?>"><font face='Angsana New'>�͡㺹Ѵ�մ��</a></td>
	<td><a target="_blank"  href="sticker_drx.php?hn=<?=$sHn?>&sDate=<?=$_GET["sDate"]?>">ʵ�������ҧ���µԴOPD</a></td>
 </tr></table>
 <div>
	<p><a href="slipprntest1_qrcode.php" target="_blank">��ҡ�Ҿ���� QR Code</a></p>
 </div>
<?php
	$strsql="select * from accrued where hn = '$sHn' and status_pay='n' ";
	$strresult = mysql_query($strsql);
	$strrow=mysql_num_rows($strresult);
	
	if($strrow>0){
		echo "<script>alert('���������ʹ��ҧ����  ��سҵԴ�����ǹ���Թ�����') </script>";
		//echo "&nbsp;&nbsp;&nbsp<b><font style='font-weight:bold'><a target=BLANK  href='accrued_list.php?hn=$hnid'>���ʹ��ҧ����</a></b></font>";

	}


$today1=(date("Y")+543).date("-m-d");	
$sql = "Select hn,ptname From dphardep WHERE hn = '".$sHn."' AND  date LIKE '$today1%'  and dr_cancle is null ";
	$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 1){
		list($hn,$ptname) = Mysql_fetch_row($result);
		echo "<br><br><font face='Angsana New' size='5' color='#FF0066'><center>***���������������ҡ���� 1 �*** </center></FONT>";
	}

/* ����͹ Warfarin */
// ��͹���㹪�ǧ 3��͹��͹��ѧ�������ա����ҹ��㹡��������ֻ���
if( !function_exists('ad_to_bc') ){
	function ad_to_bc($time = null){
		$time = preg_replace_callback('/^\d{4,}/', 'cal_to_bc', $time);
		return $time;
	}
}

if( !function_exists('cal_to_bc') ){
	function cal_to_bc($match){
		return ( $match['0'] + 543 );
	}
}

$date_end = date('Y-m-d');
$date_start = date('Y-m-d', strtotime(date('Y-m-d')."-3 months"));

$date_end = ad_to_bc($date_end);
$date_start = ad_to_bc($date_start);

$patient_hn = trim($sHn);
$sql = "SELECT COUNT(`row_id`) AS `rows` 
FROM `drugrx` 
WHERE `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2') 
AND ( `date` >= '$date_start' AND `date` <= '$date_end' ) 
AND `hn` = '$patient_hn' ";
$q = mysql_query($sql);
$item = mysql_fetch_assoc($q);
$count_wafarin = (int) $item['rows'];
if( $count_wafarin > 0 ){
	?>
	<script type="text/javascript">
		alert('�������ջ���ѵԡ������ Warfarin');
	</script>
	<?php
}
/* ����͹ Warfarin */

include("unconnect.inc");
?>
