<?
session_start();
include("connect.inc"); 

$an = $_REQUEST['an'];
$date_current = (date('Y')+543).date('-m-d');
$sql_ipcard = "SELECT `hn`,`an`,`date`,SUBSTRING(`date`,1,10) AS `admit_date` FROM `ipcard` WHERE `an` = '$an' ";
$q_ipcard = mysql_query($sql_ipcard);
if($q_ipcard !== false)
{
	$ipcard_item = mysql_fetch_assoc($q_ipcard);
	$date_admit = $ipcard_item['admit_date'];
}
else
{
	echo mysql_error();
}

?>
<style type="text/css">
<!--
.te {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.subject {
	font-size: 22px;
}
-->
</style>
<script>
	function cal(a,p,des){
		//alert(p*a);
		document.getElementById(des).value = (p*a).toFixed(2);
	}
</script>
<?
if(isset($_POST['d1'])){
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$item = 0;
	$list_drugrx = array();
	$list_amount = array();
	$list_row = array();
	$return = "select * from drug_return where an='".$_POST['an']."' and status = 'N' and txtdate = '".$_POST['txt']."'";
	$query = mysql_query($return);
	while(list($row_id,$Thn,$Tan,$camp,$age,$indate,$dcdate,$txtdate,$phardate,$rowref,$tradename,$slcode,$unit,$amount,$price,$doctor,$my_ward,$bed,$officer,$status) = mysql_fetch_array($query)){
			$item++;
			array_push($list_drugrx,$rowref);
			array_push($list_amount,$_POST["num".$item]);
			$cHn = $Thn;
			array_push($list_row,$row_id);
	}
	$cAn = $an;
$Netprice = 0;
 
for($i=0;$i<$item;$i++){
	
	$sql = "Select date,drugcode,tradname,amount,price,slcode,part,statcon,DPY,DPN From drugrx where row_id = ".$list_drugrx[$i]." limit 1 ";
	list($date,$drugcode,$tradname,$amount,$price,$slcode,$part, $statcon,$rdpy,$rdpn) = mysql_fetch_row(mysql_query($sql));

		$amount2 = $list_amount[$i];

		$unit_price = $price/ $amount;
		$price = $unit_price*$amount2;

		$unit_DPY = $rdpy/ $amount;
		$rdpy = $unit_DPY*$amount2;

		$unit_DPN = $rdpn/ $amount;
		$rdpn = $unit_DPN*$amount2;
	
		
		$amount = $list_amount[$i];


	switch($part){
		case "DDL" : $Essd = $Essd + $price; break;
		case "DDY" : $Nessdy = $Nessdy + $price; break;
		case "DDN" : $Nessdn = $Nessdn + $price; break;
		
		case "DPY" : $DPY = $DPY + $rdpy; $DPN = $DPN + $rdpn; break;
		case "DPN" : $DPN = $DPN + $price;    break;
		case "DSY" : $DSY = $DSY + $rdpy; $DSN = $DSN + $rdpn; break;
		case "DSN" : $DSN = $DSN + $price; break;

	}

	$query ="update druglst SET stock = stock + $list_amount[$i], rxaccum = rxaccum - $list_amount[$i], rx1day   = rx1day -$list_amount[$i], totalstk = stock + mainstk WHERE drugcode= '$drugcode' ";
	mysql_query($query);

	$sql = "Select stock From druglst where drugcode = '$drugcode' limit 0,1 ";

	list($stock) = mysql_fetch_row(mysql_query($sql));

	$list_sql[$i] = "INSERT INTO drugrx(date,hn,an,drugcode,tradname, amount,price,item,slcode,part,idno,stock,statcon, DPY , DPN  )VALUES('$Thidate','$cHn','$cAn','$drugcode','$tradname', $amount*-1,$price*-1,'$item','$slcode','$part','[idno]','$stock','".$statcon."',$rdpy*-1,$rdpn*-1);";

	
	$Netprice = $Netprice+$price;
}
 	$query1 = "SELECT *  FROM phardep WHERE ( date >= '$date_admit' AND date <= '$date_current' ) AND an = '$an'";
    $result1 = mysql_query($query1);
	$rep1 = mysql_fetch_array($result1);
	
	$query = "SELECT * FROM phardep WHERE row_id = '".$rep1['row_id']."' limit 1 ";
	//echo $query;
	
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$ptname  =$row->ptname;
	$ptright  =$row->ptright;
	$hn         =$row->hn;
    $an          =$row->an;  
	$Netprice  =$Netprice*-1;
	$doctor  =$row->doctor;
	$diag    =$row->diag;
    $cAccno  =$row->accno;
    $tvn   =$row->tvn;

	$sql = "INSERT INTO phardep(date,ptname,hn,an,price,doctor,item,idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,accno,tvn,ptright,phapt)VALUES('".$Thidate."','".$ptname."','".$hn."','".$an."','".$Netprice."','".$doctor."','".$item."','".$_SESSION["sOfficer"]."','".$diag."','".($Essd*-1)."','".($Nessdy*-1)."','".($Nessdn*-1)."','".($DPY*-1)."','".($DPN*-1)."','".($pricetype["DSY"]*-1)."','".($DSY*-1)."','".$accno."','".$tvn."','".$ptright."','".$_SESSION["sOfficer"]."');";
	
	$result = mysql_query($sql) or die("Query failed,insert into phardep");
	$idno=mysql_insert_id();
	
	for($i=0;$i<$item;$i++){
		$list_sql[$i] = str_replace("[idno]",$idno,$list_sql[$i]);
		$result = mysql_query($list_sql[$i]) or die("Query failed,insert into drugrx".$i);

	}

	if($an != "")
	for($i=0;$i<$item;$i++){
	
	$sql = "Select drugcode,tradname,amount,price,slcode,part,statcon,DPY,DPN From drugrx where row_id = ".$list_drugrx[$i]." limit 1 ";
	list($drugcode,$tradname,$amount,$price,$slcode,$part, $statcon,$rdpy,$rdpn) = mysql_fetch_row(mysql_query($sql));

		$amount2 = $list_amount[$i];

		$unit_price = $price/ $amount;
		$price = $unit_price*$amount2;

		$unit_DPY = $rdpy/ $amount;
		$rdpy = $unit_DPY*$amount2;

		$unit_DPN = $rdpn/ $amount;
		$rdpn = $unit_DPN*$amount2;
	
		
		$amount = $list_amount[$i];

	If ($part=="DPY" & $rdpn > 0){
          $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno                                  )VALUES('$Thidate','$an','$drugcode','PHAR','$tradname',$amount*-1,$rdpy*-1,'DPY','".$_SESSION["sOfficer"]."','$cAccno','$idno');";



		 $result = mysql_query($query) or die("insert into ipacc failed1");
			
			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno                                )VALUES('$Thidate','$an','$drugcode','PHAR','$tradname','0',$rdpn*-1,'DPN','".$_SESSION["sOfficer"]."','$cAccno','$idno');";
            $result = mysql_query($query) or die("insert into ipacc failed2");



	
	}else{

          $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno)VALUES('$Thidate','$an','$drugcode','PHAR','$tradname',$amount*-1,$price*-1,'$part','".$_SESSION["sOfficer"]."','$cAccno');";


		  $result = mysql_query($query) or die("insert into ipacc failed3");
 	}
	

	$update = "update drug_return SET status = 'Y', phardate = '$Thidate' where row_id='".$list_row[$i]."'";
	//echo $update;
	$result2 = mysql_query($update) or die("update return failed");

	
}
?>
<div id="no_print" > 
<?
print "�׹�ҷ����� ".$item." ��¡�����º��������<br>";
print "���. $sOfficer  $Thaidate<br>";
print "<hr/>";
?>
</div>
<?
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$return = "select * from drug_return where an='".$_POST['an']."' and status = 'Y'";
	
	$query = mysql_query($return);
	$sa = mysql_fetch_array($query);

	$query1 = "SELECT *  FROM phardep WHERE ( date >= '$date_admit' AND date <= '$date_current' ) AND an = '".$_POST['an']."'";
    $result1 = mysql_query($query1);
	$rep1 = mysql_fetch_array($result1);
?>
	  <!--///////////////////////////////////////////////////////////////////////////////////-->
			<table width="590" class="te">
	<tr>
	<td colspan="3" align="center" ><strong>�ç��Һ�Ť�������ѡ��������<br />
	  㺤׹��</strong></td>
	</tr>
	<tr>
	<td colspan="3" align="center" ><strong>�ͧ���Ѫ����</strong> �͡��������Ţ FR-PHA-001/3 ��䢤��駷�� .........<br />
	  �ѹ����ռźѧ�Ѻ��................................</td>
	</tr>
	</table>
	<table width="590" border="1" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="#333333" class="te">
	<? $cDoctor = substr($sa['doctor'],6);
		//$camp = substr($sa['camp'],0,3);
	?>
	<tr>
	  <td width="155" rowspan="2" valign="top"><strong>㺤׹��-㺢��Ѻ�Թ����Ҥ׹</strong><br />�Է�� <?=$sa['camp']?> <br />�Ţ���� <strong><?=$rep1['an']?></strong> <br />�ѹ���׹�� <br />
	<?=$sa['txtdate']?></td>
	  <td width="324" rowspan="2" valign="top">����,�� : <strong><?=$rep1['ptname']?></strong> ���� <?=$sa['age']?>
		<br />�ѹ����Ѻ�繼������ : <?=$sa['indate']?><br />    
		 �ѹ��˹��� : ..............................................<br />
		ᾷ��������� <?=$cDoctor?><br />
		����Ѻ�Դ�ͺ��ä׹�� : <?=$sa['officer'];?></td>
	  <td width="103" valign="top"><?=$sa['my_ward']?> <br />   
		��§ <?=$sa['bed']?></td>
	</tr>
	<tr>
	  <td height="23" align="center" valign="top"><strong>���Ѫ 03</strong></td>
	</tr>
	</table>
	<table width="590" border="1" cellpadding="0" cellspacing="0" class="te" bordercolordark="#333333" bordercolorlight="#FFFFFF">
	<tr>
	<td width="31" align="center"><strong>�ѹ�Ѻ</strong></td>
	<td width="167" align="center"><strong>��¡��</strong></td>
	<td width="42" align="center"><strong>�Ը���</strong></td>
	<td align="center"><strong>�ӹǹ</strong></td>
	<td width="47" align="center"><strong>˹��¹Ѻ</strong></td>
	<td width="117" align="center"><strong>�ӹǹ����Ǩ�ͺ����</strong></td>
	<td width="53" align="center"><strong>�Ҥ�</strong></td>
	<td width="67" align="center"><strong>�����˵�</strong></td>
	</tr>
		<?
		$v=0;
		$return = "select * from drug_return where an='".$rep1['an']."' and status = 'Y' and txtdate = '".$_POST['txt']."'";
		$query = mysql_query($return);
		while(list($row_id,$hn,$an,$camp,$age,$indate,$dcdate,$txtdate,$phardate,$rowref,$tradname,$slcode,$unit,$amount,$price,$doctor,$my_ward,$bed,$officer,$status) = mysql_fetch_array($query)){
			$v++;
			if($_POST["num".$v]!=0){
			$query2 = "SELECT *  FROM ipacc WHERE an = '".$rep1['an']."' and detail = '".$tradname."' and date = '$phardate' ";
			$result2 = mysql_query($query2);
			$rep2 = mysql_fetch_array($result2);
				$q++;
		?>
			<tr>
			<td width="31" align="center"><?=$q?></td>
			<td width="167"><?=$tradname?></td>
			<td width="42" align="center"><?=$slcode?></td>
			<td width="48" align="center"><?=$_POST["num".$v]?></td>
			<td align="center"><?=$unit?></td>
			<td align="center">&nbsp;</td>
			<td width="53" align="right"><?=number_format($rep2['price']*-1,2)?></td>
			<td  align="center">&nbsp;</td>
			</tr>
	<?
		//amountsum +=$amount;
			$pricesum +=($rep2['price']*-1);
			}
		}
	
	?>
			<tr>
			<td colspan="6" align="right"><strong>���&nbsp;&nbsp;</strong></td>
			<? //$amountsum?>
			<td align="right"><?=number_format($pricesum,2)?></td>
			<td>&nbsp;</td>
	  </tr>
	  <tr>
			<td colspan="6" align="center" valign="top">�����˵ؾ����.........................................................................................<br />
			  .................................................................................................................</td>
			<? //$amountsum?>
		<td colspan="2">����Ѻ�Ҥ׹.......................<br />
		  �ѹ����Ѻ�Ҥ׹..................<br />
		  ���Ѫ��..........................</td>
	  </tr>
	</table>
	<br />
	<?
}else{
	$return = "select * from drug_return where an='$an' group by txtdate order by txtdate desc";
	$query = mysql_query($return);
	$numsa = mysql_num_rows($query);
	if($numsa=="0"){
		echo "�������¡�ä׹��";
	}else{
	$sa = mysql_fetch_array($query);
	
	$query1 = "SELECT *  FROM phardep WHERE ( date >= '$date_admit' AND date <= '$date_current' ) AND an = '".$sa['an']."'";
	$result1 = mysql_query($query1);
	$rep1 = mysql_fetch_array($result1);
	echo "<div id='no_print' > ";
	echo "<center><span class='subject'>�к������Ҽ������</span><br>";
	echo "<span class='subject'>AN : ".$sa['an']."  HN : ".$sa['hn']." ����-ʡ�� : ".$rep1['ptname']."</span></center>";
	echo "<table border='1' class='te' align='center'><tr><td align='center'>�ѹ���׹��</td><td align='center'>�٢�����</td></tr>";
	$query = mysql_query($return);
	while($sa = mysql_fetch_array($query)){
	?>
	<tr>
    <td><?=$sa['txtdate']?></td>
    <td align="center"><? if($sa['status']=="Y") echo "<a href='add_medical_supplies.php?do=view&an=".$sa['an']."&date=".$sa['txtdate']."'>�٢�����</a>"; else{ echo "<a href='add_medical_supplies.php?do=return&an=".$sa['an']."&date=".$sa['txtdate']."'>�׹��</a>";}?></td>
    </tr>

	<?
	}
	echo "</table><hr /></div>";
	}
}

if(isset($_GET['do'])){
	if($_GET['do']=="return"){
		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
		$return = "select * from drug_return where an='$an' and status = 'N' and txtdate = '".$_GET['date']."'";
		//echo $return;
		$query = mysql_query($return);
		$sa = mysql_fetch_array($query);
		
		$query1 = "SELECT * FROM phardep WHERE ( date >= '$date_admit' AND date <= '$date_current' ) AND an = '$an'";
		$result1 = mysql_query($query1);
		$rep1 = mysql_fetch_array($result1);
		
		?>
	
	<form name="fromreturn1" action="<?= $_SERVER['PHP_SELF']?>" method="post">
	
	<table class="te">
	<tr>
	<td colspan="2" align="center" ><strong>�ç��Һ�Ť�������ѡ��������<br />
	  㺤׹��</strong></td>
	</tr>
	<tr>
	<td>���� : <?=$rep1['ptname']?></td>
	<td>�ѹ����Ѻ�繼������ :
	  <?=$sa['indate']?></td>
	</tr>
	<tr>
	<td width="276">�ѹ���׹�� : <?=$sa['txtdate']?> </td>
	<td width="302">����Ѻ�Դ�ͺ��ä׹�� 
	  : 
	  <?=$sa['officer']?></td>
	</tr>
	</table>
	<table width="590" class="te">
	<tr>
	<td width="39" align="center"><strong>�ѹ�Ѻ</strong></td>
	<td width="276" align="center"><strong>��¡��</strong></td>
	<td width="57" align="center"><strong>��Ҵ</strong></td>
	<td width="63" align="center"><strong>�ӹǹ</strong></td>
	<td width="62" align="center"><strong>˹���</strong></td>
	<td width="65" align="center"><strong>�Ҥ�</strong></td>
	</tr>
		<?
		$v=1;
		$perunit = array();
		$query = mysql_query($return);
		while($sa = mysql_fetch_array($query)){
			$perunit[$v]= $sa['price']/$sa['amount'];
		?>
		<tr>
			<td width="39" align="center"><?=$v?></td>
			<td width="276"><?=$sa['tradname']?></td>
			<td width="57" align="center"><?=$sa['slcode']?></td>
			<td width="63" align="center"><input name="num<?=$v?>" type="text" size="4" value="<?=$sa['amount']?>" dir="rtl" onkeyup="cal(this.value,'<?=$perunit[$v]?>','money<?=$v?>')" /></td>
			<td width="62" align="center"><?=$sa['unit']?></td>
			<td width="65" align="center"><input name="money<?=$v?>" type="text" value="<?=$sa['price']?>" size="4" readonly="readonly"  dir="rtl"/></td>
			</tr>
            <input name="txt" value="<?=$_GET['date']?>" type="hidden" />
	<?
			$v++;
		}
	?>
	<input name="an" value="<?=$an?>" type="hidden" />
    <tr><td colspan="6" align="center"><input name="d1" type="submit" value="      �ѹ�֡     " /></td></tr>
</table>
</form>
<?
	}
	elseif($_GET['do']=="view"){
		$return = "select * from drug_return where an='$an' and status = 'Y' and txtdate = '".$_GET['date']."'";
		//echo $return;
		$query = mysql_query($return);
		$sa = mysql_fetch_array($query);
		
		$query1 = "SELECT *  FROM phardep WHERE ( date >= '$date_admit' AND date <= '$date_current' ) AND an = '$an'";
		$result1 = mysql_query($query1);
		$rep1 = mysql_fetch_array($result1);
		
		
		?>
		<table width="590" class="te">
	<tr>
	<td colspan="3" align="center" ><strong>�ç��Һ�Ť�������ѡ��������<br />
	  㺤׹��</strong></td>
	</tr>
	<tr>
	<td colspan="3" align="center" ><strong>�ͧ���Ѫ����</strong> �͡��������Ţ FR-PHA-001/3 ��䢤��駷�� .........<br />
	  �ѹ����ռźѧ�Ѻ��................................</td>
	</tr>
	</table>
	<table width="590" border="1" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="#333333" class="te">
	<? $cDoctor = substr($sa['doctor'],6);
		//$camp = substr($sa['camp'],0,3);
	?>
	<tr>
	  <td width="155" rowspan="2" valign="top"><strong>㺤׹��-㺢��Ѻ�Թ����Ҥ׹</strong><br />�Է�� <?=$sa['camp']?> <br />�Ţ���� <strong><?=$rep1['an']?></strong> <br />�ѹ���׹�� <br />
	<?=$sa['txtdate']?></td>
	  <td width="324" rowspan="2" valign="top">����,�� : <strong><?=$rep1['ptname']?></strong> ���� <?=$sa['age']?>
		<br />�ѹ����Ѻ�繼������ : <?=$sa['indate']?><br />    
		 �ѹ��˹��� : ..............................................<br />
		ᾷ��������� <?=$cDoctor?><br />
		����Ѻ�Դ�ͺ��ä׹�� : <?=$sa['officer'];?></td>
	  <td width="103" valign="top"><?=$sa['my_ward']?> <br />   
		��§ <?=$sa['bed']?></td>
	</tr>
	<tr>
	  <td height="23" align="center" valign="top"><strong>���Ѫ 03</strong></td>
	</tr>
	</table>
	<table width="590" border="1" cellpadding="0" cellspacing="0" class="te" bordercolordark="#333333" bordercolorlight="#FFFFFF">
	<tr>
	<td width="31" align="center"><strong>�ѹ�Ѻ</strong></td>
	<td width="167" align="center"><strong>��¡��</strong></td>
	<td width="42" align="center"><strong>�Ը���</strong></td>
	<td align="center"><strong>�ӹǹ</strong></td>
	<td width="47" align="center"><strong>˹��¹Ѻ</strong></td>
	<td width="117" align="center"><strong>�ӹǹ����Ǩ�ͺ����</strong></td>
	<td width="53" align="center"><strong>�Ҥ�</strong></td>
	<td width="67" align="center"><strong>�����˵�</strong></td>
	</tr>
		<?
		$v=0;
		$return = "select * from drug_return where an='$an' and status = 'Y' and txtdate = '".$_GET['date']."'";
		//echo $return;
		$query = mysql_query($return);
		while(list($row_id,$hn,$an,$camp,$age,$indate,$dcdate,$txtdate,$phardate,$rowref,$tradname,$slcode,$unit,$amount,$price,$doctor,$my_ward,$bed,$officer,$status) = mysql_fetch_array($query)){
			$v++;
			$query2 = "SELECT *  FROM ipacc WHERE an = '$an' and detail = '".$tradname."' and date = '$phardate' ";
			//echo $query2;
			$result2 = mysql_query($query2);
			$rep2 = mysql_fetch_array($result2);
				$q++;
		?>
			<tr>
			<td width="31" align="center"><?=$q?></td>
			<td width="167"><?=$tradname?></td>
			<td width="42" align="center"><?=$slcode?></td>
			<td width="48" align="center"><?=$rep2['amount']*-1?></td>
			<td align="center"><?=$unit?></td>
			<td align="center">&nbsp;</td>
			<td width="53" align="right"><?=number_format($rep2['price']*-1,2)?></td>
			<td  align="center">&nbsp;</td>
			</tr>
	<?
		//amountsum +=$amount;
			$pricesum +=($rep2['price']*-1);
		}
	
	?>
			<tr>
			<td colspan="6" align="right"><strong>���&nbsp;&nbsp;</strong></td>
			<? //$amountsum?>
			<td align="right"><?=number_format($pricesum,2)?></td>
			<td>&nbsp;</td>
	  </tr>
	  <tr>
			<td colspan="6" align="center" valign="top">�����˵ؾ����.........................................................................................<br />
			  .................................................................................................................</td>
			<? //$amountsum?>
		<td colspan="2">����Ѻ�Ҥ׹.......................<br />
		  �ѹ����Ѻ�Ҥ׹..................<br />
		  ���Ѫ��..........................</td>
	  </tr>
	</table>
		<?
	}
}
?>  