<?php
 include("connect.inc");   
	$month["01"] = "���Ҥ�";
    $month["02"] = "����Ҿѹ��";
    $month["03"] = "�չҤ�";
    $month["04"] = "����¹";
    $month["05"] = "����Ҥ�";
    $month["06"] = "�Զع�¹";
    $month["07"] = "�á�Ҥ�";
    $month["08"] = "�ԧ�Ҥ�";
    $month["09"] = "�ѹ��¹";
    $month["10"] = "���Ҥ�";
    $month["11"] = "��Ȩԡ�¹";
    $month["12"] = "�ѹ�Ҥ�";




?>
<FORM METHOD=POST ACTION="">
	<TABLE>
	<TR>
		<TD align="right">����� �ѹ��� : </TD>
		<TD><INPUT TYPE="text" NAME="start_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $index) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD>
	</TR>
	<TR>
		<TD align="right">�֧ �ѹ��� : </TD>
		<TD>
		<INPUT TYPE="text" NAME="end_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="end_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $index) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="end_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4">
		</TD>
	</TR>
	<TR>
		<TD align="center" colspan="2"><INPUT TYPE="submit" value="��ŧ"></TD>
	</TR>
	</TABLE>
</FORM>
<a href='../nindex.htm'>&lt;&lt; �����</A>


<?
if(isset($_POST["start_month"]) && isset($_POST["start_day"]) && isset($_POST["start_year"]) && isset($_POST["end_day"]) && isset($_POST["end_month"]) && isset($_POST["end_year"]) && $_POST["end_day"] > 0 && $_POST["end_year"] > 2000){

$sql="CREATE TEMPORARY TABLE rptranx SELECT `row_id`, `idno`, `hn`, `an`, `date`,date_format( `date` , '%Y-%m-%d' ) as date3, `amount`, `price` FROM drugrx WHERE (`date` between '".$_POST["start_year"]."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".$_POST["end_year"]."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:00')  ORDER BY date ASC ";

 $result = mysql_query($sql) or die("Query failed,rptranx");

 $sql="CREATE TEMPORARY TABLE iptranx SELECT `row_id`, `idno`,  `an`, `date`,date_format( `date` , '%Y-%m-%d' ) as date3, `amount`, `price` FROM ipacc WHERE (`date` between '".$_POST["start_year"]."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".$_POST["end_year"]."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:59') AND depart = 'PHAR' ORDER BY date ASC ";

 $result = mysql_query($sql) or die("Query failed,iptranx".mysql_error());
 



$sql = "SELECT date_format( `date` , '%d-%m-%Y' ) AS date2, date3
				FROM `rptranx` 
				GROUP BY date2
				ORDER BY date2 ASC   
				";

$result = Mysql_Query($sql) or die(mysql_error());
//echo $sql;
echo "
<TABLE width='650' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0' >
<TR align=\"center\">
	<TD>�ѹ���</TD>
	<TD>��¡��</TD>
	<TD>�ӹǹ(�����¹͡)</TD>
	<TD>�ӹǹ(�������)</TD>

</TR>
";
while($arr = Mysql_fetch_assoc($result)){

	$sql = "Select count( distinct idno) as count_tranx , count(row_id ), sum(amount) as count_item From rptranx where date3 = '".$arr["date3"]."' AND hn != '' AND (an is Null OR an = '') AND price > 0 ";
	list($xx1, $yy1, $zz1) = Mysql_fetch_row(Mysql_Query($sql));

	$sql = "Select count( distinct idno) as count_tranx , count(row_id ), sum(amount) as count_item From rptranx where date3 = '".$arr["date3"]."' AND hn != '' AND (an is Null OR an = '') AND price < 0";
	list($xx2, $yy2, $zz2) = Mysql_fetch_row(Mysql_Query($sql));
	
	$patientout_count_tranx = $xx1 - $xx2;
	$patientout_count_item = $yy1 - $yy2;
	$patientout_sum_amount = $zz1 + $zz2;

	$sql = "Select count( distinct idno) as count_tranx , count(row_id ) as count_item, sum(amount) as count_item  From iptranx where date3 = '".$arr["date3"]."' AND  (an is not Null OR an != '') AND price > 0 ";
	list($xx1, $yy1, $zz1) = Mysql_fetch_row(Mysql_Query($sql));

	$sql = "Select count( distinct idno) as count_tranx , count(row_id ) as count_item, sum(amount) as count_item  From iptranx where date3 = '".$arr["date3"]."' AND  (an is not Null OR an != '') AND price < 0";
	list($xx2, $yy2, $zz2) = Mysql_fetch_row(Mysql_Query($sql));
	
	$patientin_count_tranx = $xx1 - $xx2;
	$patientin_count_item = $yy1 - $yy2;
	$patientin_sum_amount = $zz1 + $zz2;
	
	if($patientout_sum_amount == "") $patientout_sum_amount = 0;
	if($patientin_sum_amount == "") $patientin_sum_amount = 0;

	$sql = "Select sum(price) as count_tranx  From rptranx where date3 = '".$arr["date3"]."' AND hn != '' AND (an is Null OR an = '')";
	list($hn_price_tranx, ) = Mysql_fetch_row(Mysql_Query($sql));

	$sql = "Select sum(price) as count_tranx  From iptranx where date3 = '".$arr["date3"]."' AND  (an is not Null OR an != '')";
	list($an_price_tranx,) = Mysql_fetch_row(Mysql_Query($sql));


echo "
<TR height=\"30\">
	<TD rowspan=\"4\"align=\"center\">",$arr["date2"],"</TD>
	<TD>&nbsp;&nbsp;&nbsp;�ӹǹ Item</TD>
	<TD align=\"right\">",$patientout_count_item,"&nbsp;&nbsp;&nbsp;</TD>
	<TD align=\"right\">",$patientin_count_item,"&nbsp;&nbsp;&nbsp;</TD>
</TR>
<TR height=\"30\">
	<TD>&nbsp;&nbsp;&nbsp;�ӹǹ������</TD>
	<TD align=\"right\">",$patientout_count_tranx,"&nbsp;&nbsp;&nbsp;</TD>
	<TD align=\"right\">",$patientin_count_tranx,"&nbsp;&nbsp;&nbsp;</TD>
</TR>
<TR height=\"30\">
	<TD>&nbsp;&nbsp;&nbsp;�ӹǹ�Ѻ��</TD>
	<TD align=\"right\">",$patientout_sum_amount,"&nbsp;&nbsp;&nbsp;</TD>
	<TD align=\"right\">",$patientin_sum_amount,"&nbsp;&nbsp;&nbsp;</TD>
</TR>
<TR height=\"30\">
	<TD>&nbsp;&nbsp;&nbsp;��Ť����</TD>
	<TD align=\"right\">",$hn_price_tranx,"&nbsp;&nbsp;&nbsp;</TD>
	<TD align=\"right\">",$an_price_tranx,"&nbsp;&nbsp;&nbsp;</TD>
</TR>
<TR height=\"3\">
	<TD colspan=\"2\"></TD>
</TR>
";

}

echo "
</TABLE>
";


}else if(isset($_POST["start_month"]) && isset($_POST["start_year"])){

$sql="CREATE TEMPORARY TABLE rptranx SELECT `row_id`, `idno`, `hn`, `an`, `date`, `amount`, `price` FROM `drugrx` 
				Where (`date` like '".$_POST["start_year"]."-".$_POST["start_month"]."-%')
				AND hn != '' ";

 $result = mysql_query($sql) or die("Query failed,rptranx");

 $sql="CREATE TEMPORARY TABLE iptranx SELECT `row_id`, `idno`,  `an`, `date`, `amount`, `price` FROM `ipacc` 
				Where (`date` like '".$_POST["start_year"]."-".$_POST["start_month"]."-%') AND 
				depart = 'PHAR' ";

 $result = mysql_query($sql) or die("Query failed,iptranx".mysql_error());

$sql = "SELECT count( distinct idno) as sum_tranx,count(row_id) as sum_item, sum(amount) as sum_amount 
				FROM `rptranx` 
				Where (`date` like '".$_POST["start_year"]."-".$_POST["start_month"]."-%')
				AND hn != '' AND (an is null OR an = '' ) AND price > 0
				";

$result = Mysql_Query($sql) or die(mysql_error());
list($xx1, $yy1, $zz1) = Mysql_fetch_row($result);

$sql = "SELECT count( distinct idno) as sum_tranx,count(row_id) as sum_item, sum(amount) as sum_amount 
				FROM `rptranx` 
				Where (`date` like '".$_POST["start_year"]."-".$_POST["start_month"]."-%')
				AND hn != '' AND (an is null OR an = '' )  AND price < 0
				";

$result = Mysql_Query($sql);
list($xx2, $yy2, $zz2) = Mysql_fetch_row($result);

$out_sum_tranx = $xx1 - $xx2;
$out_sum_item = $yy1 - $yy2;
$patientout_sum_amount = $zz1 + $zz2;

$sql = "SELECT count( distinct idno) as sum_tranx,count(row_id) as sum_item , sum(amount) as sum_amount
				FROM `iptranx` 
				Where (`date` like '".$_POST["start_year"]."-".$_POST["start_month"]."-%')
				 AND (an is not null OR an != '' ) AND price > 0
				";

$result = Mysql_Query($sql);
list($xx1, $yy1, $zz1) = Mysql_fetch_row($result);

$sql = "SELECT count( distinct idno) as sum_tranx,count(row_id) as sum_item , sum(amount) as sum_amount
				FROM `iptranx` 
				Where (`date` like '".$_POST["start_year"]."-".$_POST["start_month"]."-%')
				 AND (an is not null OR an != '' ) AND price < 0
				";

$result = Mysql_Query($sql);
list($xx2, $yy2, $zz2) = Mysql_fetch_row($result);

$in_sum_tranx = $xx1 - $xx2;
$in_sum_item = $yy1 - $yy2;
$patientin_sum_amount = $zz1 + $zz2;

$sql = "SELECT sum( price) as sum_tranx
				FROM `rptranx` 
				Where (`date` like '".$_POST["start_year"]."-".$_POST["start_month"]."-%')
				AND hn != '' AND (an is null OR an = '' ) 
				";

$result = Mysql_Query($sql);
list($hn_price_tranx) = Mysql_fetch_row($result);

$sql = "SELECT sum( price) as sum_tranx
				FROM `iptranx` 
				Where (`date` like '".$_POST["start_year"]."-".$_POST["start_month"]."-%')
				AND (an is not null OR an != '' )
				";

$result = Mysql_Query($sql);
list($an_price_tranx) = Mysql_fetch_row($result);

echo "
<TABLE width='650' border='1' bordercolor='#000000' cellspacing='0' cellpadding='0' >
<TR align=\"center\">
	<TD>�ѹ���</TD>
	<TD>��¡��</TD>
	<TD>�ӹǹ(�����¹͡)</TD>
	<TD>�ӹǹ(�������)</TD>
</TR>
";


echo "
<TR height=\"30\">
	<TD rowspan=\"4\"align=\"center\">��͹",$_POST["start_month"],"-",$_POST["start_year"],"</TD>
	<TD>&nbsp;&nbsp;&nbsp;�ӹǹ Item</TD>
	<TD align=\"right\">",$out_sum_item,"&nbsp;&nbsp;&nbsp;</TD>
	<TD align=\"right\">",$in_sum_item,"&nbsp;&nbsp;&nbsp;</TD>
</TR>
<TR height=\"30\">
	<TD>&nbsp;&nbsp;&nbsp;�ӹǹ������</TD>
	<TD align=\"right\">",$out_sum_tranx,"&nbsp;&nbsp;&nbsp;</TD>
	<TD align=\"right\">",$in_sum_tranx,"&nbsp;&nbsp;&nbsp;</TD>
</TR>
<TR height=\"30\">
	<TD>&nbsp;&nbsp;&nbsp;�ӹǹ�Ѻ��</TD>
	<TD align=\"right\">",$patientout_sum_amount,"&nbsp;&nbsp;&nbsp;</TD>
	<TD align=\"right\">",$patientin_sum_amount,"&nbsp;&nbsp;&nbsp;</TD>
</TR>
<TR height=\"30\">
	<TD>&nbsp;&nbsp;&nbsp;��Ť����</TD>
	<TD align=\"right\">",$hn_price_tranx,"&nbsp;&nbsp;&nbsp;</TD>
	<TD align=\"right\">",$an_price_tranx,"&nbsp;&nbsp;&nbsp;</TD>
</TR>
<TR height=\"3\">
	<TD colspan=\"2\"></TD>
</TR>
</TABLE>
";

}

include("unconnect.inc");

?>

<?php
	// send d,m,yr 

	
 //  $yrmn=$yr."-".$m."-".$d;
    include("connect.inc");
	
	  $query="CREATE TEMPORARY TABLE dgpaid SELECT * FROM drugrx WHERE (`date` between '".$_POST["start_year"]."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".$_POST["end_year"]."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:59') ORDER BY drugcode";
    $result = mysql_query($query) or die("Query failed,drugrx"); 
   
   	$x=0;
    $aDgcode = array("������");
    $aTrade  = array("      ���͡�ä��");
    $aPrice  = array("  ����Թ  ");
    $aAmount = array("  �ӹǹ   ");
    $aDuplicate= array("   �ӹǹ����");
    $Netprice=0;   

   $query="SELECT  drugcode,tradname,COUNT(*) AS duplicate FROM dgpaid GROUP BY drugcode HAVING duplicate > 0 ORDER BY drugcode";
   
   $result = mysql_query($query);
    while (list ($drugcode,$tradname,$duplicate) = mysql_fetch_row ($result)) {
            $x++;
    $aDgcode[$x]=$drugcode;
    $aTrade[$x]=$tradname;
    $aDuplicate[$x]=$duplicate;
/*
			print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$x</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$aDgcode[$x]</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$aTrade[$x]</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ���駷�����(�ӹǹ�������Ѻ��)=   $aDuplicate[$x]</td>\n".
               " </tr>\n<br>");
*/
			   }
 //�Ѻ��������� drugcode
 for ($n=1; $n<=$x; $n++){
       $query = "SELECT amount,price FROM dgpaid WHERE drugcode = '$aDgcode[$n]' ";
       $result = mysql_query($query) or die("Query failed");
			    $aAmount[$n]=0;
				$aPrice[$n]=0;
       while (list ($amount,$price) = mysql_fetch_row ($result)) {
			    $aAmount[$n] =  $aAmount[$n]+$amount;
				$aPrice[$n]=$aPrice[$n]+$price;
						                 }
					};
 	   $Netprice=array_sum($aPrice);
    	$Netprice=number_format($Netprice,2,'.',',');
		//////////
    print "<font face='Angsana New'><b>��§ҹ��è���������Ǫ�ѳ��ͧ�ѹ��� $d-$m-$yr</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></font><br>";
print"<table>";
 print"<tr>";
  print"<th bgcolor=CD853F><font face='Angsana New'>#</th>";
  print"<th bgcolor=CD853F><font face='Angsana New'>����</th>";
  print"<th bgcolor=CD853F><font face='Angsana New'>�������ѭ</th>";
  print"<th bgcolor=CD853F><font face='Angsana New'>�ӹǹ����</th>";
  print"<th bgcolor=CD853F><font face='Angsana New'>����Թ</th>";
 print"<th bgcolor=CD853F><font face='Angsana New'>*�ӹǹ����</th>";
 print"</tr>";
 for ($n=1; $n<=$x; $n++){
            print (" <tr>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$n</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aDuplicate[$n]</td>\n".
               " </tr>\n");
  };
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>����Թ������  $Netprice �ҷ</font></th>";
    print "</table>";
	print "<font face='Angsana New'>(�����˵�: *�ӹǹ���� : �Ѻ�����ä׹�Ҩ֧�ҡ�Թ��ԧ , ���١��ͧ���� #)<br>";
//�٤���ء��
	print"<br><b>��§ҹ��è���������Ǫ�ѳ�� (�������Ф�) �ͧ�ѹ��� $d-$m-$yr</b></br>";
	print"<table>";
   print"<tr>";
  print"<th bgcolor=6495ED><font face='Angsana New'>#</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>�ѹ���</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>HN</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>AN</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>����</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>�ӹǹ</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>����Թ</th>";
 print"</tr>";
   $query="SELECT date,hn,an,drugcode,tradname,amount,price FROM dgpaid";
   $result = mysql_query($query);
     $n=0;
 while (list ($date,$hn,$an,$drugcode,$tradname,$amount,$price) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$amount</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
               " </tr>\n");
               }
 include("unconnect.inc");

    print "<table>";
    print " <tr>";
    print "  <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></th>";
    print "</table>";
?>

