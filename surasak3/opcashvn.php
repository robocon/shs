<?php
    session_start();//for security
    if (isset($sIdname)){} else {die;} //for security
    $today="$d-$m-$yr";
	if($today=="--"){
		$today = $_GET['a']."-".$_GET['b']."-".$_GET['c'];
	}
   print "<font face='Angsana New'><b>�ѹ��� $today: ���Թ�����·���ѧ�����  '�����Թ' , *�ó��ԡ�ç������Թ��ǹ��� '�ԡ�����' &nbsp;<U>�������ᴧ�ʴ�����Է�ԡ���ѡ���ջѭ��</U></b><br>";
    print "<br><strong>��¡�õ�Ǩ���������ä���ͷ��ѵ����</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<<&nbsp<a target=_self  href='../nindex.htm'>�����</a>";
// print "VN= $vn";
 //  print "&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
   
print "&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;<<&nbsp<a target=_self  href='vncash.php'>��µ���</a>&nbsp&nbsp;";
//print  $acc;


  $today="$yr-$m-$d";
	if($today=="--"){
		$today = $_GET['c']."-".$_GET['b']."-".$_GET['a'];
	}
  $dateid = $today;
  
	$vn = $_GET['vn'];
	if($vn==""){
		$vn = $_POST['vn'];
	}
	include("connect.inc");
		
	$query = "select hn,ptname from opday where vn='$vn' and thidate like '$dateid%' ";
	$result = mysql_query($query) or die("Query failed");
	list($hn,$cPtname) = mysql_fetch_row($result);
	if($hn!=''){
		if($_POST['op']=="1"||$_POST['op']=="2"){
			$thidate = (date("Y")+543).date("-m-d H:i:s"); 
			
			//runno  for chktranx
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
				$result = mysql_query($query) or die("Query failed");
				
				$query = "SELECT * FROM opcard WHERE hn = '$hn'";
				$result = mysql_query($query) or die("Query failed");
				
				for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
					if (!mysql_data_seek($result, $i)) {
						echo "Cannot seek to row $i\n";
						continue;
					}
				
					if(!($row = mysql_fetch_object($result)))
					continue;
				}
				
				if($result){
					//$cHn=$row->hn;
					$cYot = $row->yot;
					$cIdcard = $row->idcard;
					$cName = $row->name;
					$cSurname = $row->surname;
					//$cPtname=$cYot.' '.$cName.'  '.$cSurname;
					$cPtright = $row->ptright;
				}
				
				/*$query = "select vn from opday where hn='$hn' and thidate like '".(date("Y")+543).date("-m-d")."%' ";
				$result = mysql_query($query) or die("Query failed");*/
				$nVn=$vn;
					/////////////////////////////////////////////////////////////
				$spai = $_POST['ncal'];//�ӹǹ��Ѻ�ͧᾷ��
				$pri =0;
				if($_POST['op']=="1"){
					$pri = 20;
				}
				elseif($_POST['op']=="2"){
					$pri = 50;
				}
				$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$hn','','OTHER','".$spai."','��Һ�ԡ�÷ҧ���ᾷ��',($pri*$spai),'0',($pri*$spai),'','$sOfficer','0','$nVn','$cPtright');";
				$result = mysql_query($query);
				$idno=mysql_insert_id();
			 
				$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
	VALUES('$thidate','$hn','','$cPtname','1','CHEK-UP','(55830)��õ�Ǩ��ҧ������͢���Ѻ�ͧᾷ��','$spai',($pri*$spai),'0',($pri*$spai),'OTHER','NCARE','$idno','$cPtright');";
	
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
				
				$query ="UPDATE opday SET other=(other+($pri*$spai)) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
				$result = mysql_query($query) or die("Query failed,update opday");
		}
	}else{
			?>
			<script>
            	alert("����ռ����� vn �����");
				window.location.href="vncash.php";
            </script>
			<?
		} 

?>

<form name="from3" method="post" action="opitem2.php" target="_blank">
<table>
 <tr>
  <th bgcolor=6495ED>���Թ</th>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>����&���Թ��ǹ�Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>AN</th>
  <th bgcolor=6495ED><font face='Angsana New'>VN</th>
  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>
  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>
  <th bgcolor=6495ED><font face='Angsana New'>����Թ</th>
  <th bgcolor=F08080><font face='Angsana New'>�ԡ�����</th>
  <th bgcolor=#99FF99><font face='Angsana New'>�����Թ</th>
    <th bgcolor=6495ED><font face='Angsana New'>�Է��</th> 
	<th bgcolor=#CC0000><font face='Angsana New'>������</th>
    <th bgcolor=6495ED><font face='Angsana New' size='1'>�͡opcard</th>
  </tr>

<?php
//    $detail="�����";
    $num=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,hn,an,depart,detail,price,sumnprice,paid,row_id,accno,tvn,ptright FROM depart WHERE date LIKE '$today%' and tvn='$vn' ";
	//echo $query;
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$sumnprice,$paid,$row_id,$accno,$tvn,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);
 $totalpri1=$totalpri1+$price;
 $totalpri11=$totalpri11+$paid;
	
	$query4= "SELECT * FROM patdata WHERE idno ='$row_id' ";
    $result4 = mysql_query($query4) or die("Query failed");
	$cunt = mysql_num_rows($result4);

 if(substr($ptright,0,3)=='R07'){
			$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "#CCFF00";
			}else{
				$color = "FF8C8C";
			}
		}else if(substr($ptright,0,3)=='R03'){
			$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "99CC00";
			}else{
				$color = "FF8C8C";
			}
		}else{
			$color = "66CDAA";
		}

$sql = "Select credit,billno From opacc where txdate = '$date' and hn= '$hn' order by row_id desc limit 1";
$result2 = Mysql_Query($sql);
list($credit,$billno) = Mysql_fetch_row($result2);

if($credit=='�Թʴ'){$color3='#CC0000';}
else if($credit=='������'){$color3='#CC0000';}
else {$color3='#00CC99';}
$hnid = $hn;
		$sqlf = "select toborow from opday where hn='".$hn."' and thidate like '$today%' ";
		list($toborow) = mysql_fetch_array(mysql_query($sqlf));
$totalpaid1=$sumnprice;



        print " <tr>\n".
           "  <td BGCOLOR=$color><font face='Angsana New' size='1' ><input name='ch$num' type='checkbox' value='$row_id'><font color='#CC0000'><B>$credit</B></font></td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$time</td>\n";
		   if($sumnprice>0&$sumnprice!=$price||$cunt>15){
		   		print "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"opitem.php?sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n";
		   }else{
				print "  <td BGCOLOR=$color><font face='Angsana New'>$ptname</td>\n";
		   }
	 print "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"printcscd1.php?sDate=$date&nRow_id=$row_id&nAccno=$accno\">$hn</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$an</td>\n".
    	   "  <td BGCOLOR=$color><font face='Angsana New'>$tvn</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New' size='1'>$depart</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New' size='1'>$detail</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=FFE4C4><font face='Angsana New'>$sumnprice</td>\n".
           "  <td BGCOLOR=#99FF99><font face='Angsana New'>$paid</td>\n".
	       "  <td BGCOLOR=$color><font face='Angsana New' size='1'>$ptright</td>\n".
		   "  <td BGCOLOR=$color3><font face='Angsana New' size='1'>$credit($billno)</td>\n".
		   "  <td BGCOLOR=$color3><font face='Angsana New' size='1'>$toborow</td>\n".
           " </tr>\n";
		echo "<input name='sDate$num' value='$date' type='hidden' />";
		echo "<input name='nhn' value='$hn' type='hidden' />";
		echo "<input name='nAccno$num' value='$accno' type='hidden' />";
       }
    	include("unconnect.inc");
?>



<?php
    session_start();//for security
    if (isset($sIdname)){} else {die;} //for security
     $today="$d-$m-$yr"; 
	 if($today=="--"){
		$today = $_GET['a']."-".$_GET['b']."-".$_GET['c'];
	}
     $today="$yr-$m-$d";
	 if($today=="--"){
		$today = $_GET['c']."-".$_GET['b']."-".$_GET['a'];
	}
	 
	
?>

<table>
 <tr>
 <th bgcolor=6495ED>���Թ</th>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>����&���Թ��ǹ�Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>AN</th>
 <th bgcolor=6495ED><font face='Angsana New'>VN</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����</th>
    <th bgcolor=F08080><font face='Angsana New'>�ԡ�����</th>
  <th bgcolor=#99FF99><font face='Angsana New'>�����Թ</th>
      <th bgcolor=6495ED><font face='Angsana New'>�Է��</th>
  <th bgcolor=6495ED><font face='Angsana New'>��Ѻ�ͧ�ҹ͡</th>
   <th bgcolor=#CC0000><font face='Angsana New'>������</th>
   <th bgcolor=6495ED><font face='Angsana New' size='1'>�͡opcard</th>
  </tr>

<?php
$credit="";
$date="";
    $detail="�����";
   // $num=0;
   $k=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,hn,an,price,paid,essd,nessdy,nessdn,dsy,dpy,dsn,dpn,row_id,accno,tvn,ptright FROM phardep WHERE (datedr LIKE '$today%' or (datedr LIKE '$today%' and price <=0)) and tvn='$vn' ";
	//echo $query;
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date, $ptname,$hn,$an,$price,$paid,$essd,$nessdy,$nessdn,$dsy,$dpy,$dsn,$dpn,$row_id,$accno,$tvn,$ptright) = mysql_fetch_row ($result)) {
    $num++;
	$k++;
    $time=substr($date,11);
	
	$query6= "SELECT * FROM drugrx WHERE idno ='$row_id' ";
    $result6 = mysql_query($query6) or die("Query failed");
	$cunt6 = mysql_num_rows($result6);
	
	if( $price>0){  $totalpri2=$totalpri2+$price;} else { $totalpri2=$totalpri2+$price;};
// $totalpri2=$totalpri2+$price;
	//echo "$totalpri2=$totalpri2+$price;<br>";

if($paid != 0){

	if( $price > 0 ){ $paid1 = $price; }
	if( $price < 0 ){ $paid1 = $price; }
}else{ 
	$paid1 = 0;
}

 //$rowid=$row_id; //report
 $totalpri22=$totalpri22+$paid1;

 //����Թ��ǹ����ԡ�����
 	$topay=0;
if (empty($an)){    
	//$topay=$nessdn+$dsy+ $dsn+$dpn;   ��.�͡�ԡ�����
	$topay=$nessdn+ $dsn+$dpn;
	}
if (!empty($an)){    
	$topay=$nessdn+ $dsn+$dpn; //��.��ԡ�����
	}
$totalpaid2=$topay;
 if(substr($ptright,0,3)=='R07'){
			$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "#CCFF00";
			}else{
				$color = "FF8C8C";
			}
		}else if(substr($ptright,0,3)=='R03'){
			$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
			//echo $sql;

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "99CC00";
			}else{
				$color = "FF8C8C";
			}
		}else{
			$color = "66CDAA";
		}
$credit="";
$sql = "Select credit,billno From opacc where txdate = '$date' and $paid1 > '0' and hn='$hn' order by row_id desc limit 1";
//echo $sql;
$result2 = Mysql_Query($sql);
list($credit,$billno) = Mysql_fetch_row($result2);

if($credit=='�Թʴ'){$color3='#CC0000';}
else if($credit=='������'){$color3='#CC0000';}
else {$color3='#00CC99';}
$hnid = $hn;

        print " <tr>\n".
		   "  <td BGCOLOR=$color><font face='Angsana New' size='1' ><input name='ch$num' type='checkbox' value='$row_id'><font color='#CC0000'><B>$credit</B></font></td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$k</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$time</td>\n";
		
		if($topay>0&&$price!=$topay||$cunt6>15){
		   		print "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"oprxitem.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n";
		}else{
				print "  <td BGCOLOR=$color><font face='Angsana New'>$ptname</td>\n";
		}
		print "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"printcscd.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$hn</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$tan</td>\n".
		   "  <td BGCOLOR=$color><font face='Angsana New'>$tvn</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=FFE4C4><font face='Angsana New'>$topay</td>\n".
           "  <td BGCOLOR=#99FF99><font face='Angsana New'>$paid1</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"oprxitemno50.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptright</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"rxcertify.php? Fulname=$ptname&Nessdy=$nessdy&hn=$hn&sDate=$date&tDate=$today&nRow_id=$row_id\">Ẻ���</a>.....<a target=_BLANK  href=\"rxcertify1.php? Fulname=$ptname&Nessdy=$nessdy&hn=$hn&sDate=$date&tDate=$today&nRow_id=$row_id\">Ẻ����</a>.....<a target=_BLANK  href=\"Medical_certificate.php? Fulname=$ptname&Nessdy=$nessdy&hn=$hn&sDate=$date&tDate=$today&nRow_id=$row_id\">A5</a>....</td>\n".

			      "  <td BGCOLOR=$color3><font face='Angsana New' size='1'>$credit($billno)</td>\n".
				  "  <td BGCOLOR=$color3><font face='Angsana New' size='1'>$toborow</td>\n".
           " </tr>\n";
		echo "<input name='sDate$num' value='$date' type='hidden' />";
		echo "<input name='nhn' value='$hn' type='hidden' />";
		echo "<input name='nAccno$num' value='$accno' type='hidden' />";
       }
//$totalpri1=$totalpri1+50;
$totalpri=$totalpri1+$totalpri2;
//$totalpri=$totalpri+50;
//echo "===>$totalpri1+$totalpri2";

$totalpri2=$totalpri11+$totalpri22;

$totalpri3=$totalpri-$totalpri2;
$totaltopay1=$totalpaid1+$totalpaid2;

 print "<center><font face='AngsanaUPC' size='5' COLOR='#000066'>�������ѡ�Ҿ�Һ�ŷ�����<b>  $totalpri</b> �ҷ</FONT>";
  print "  &nbsp;&nbsp&nbsp;&nbsp  <font face='AngsanaUPC' size='5' COLOR='#FF0033'><U>**�ԡ����� &nbsp;&nbsp $totaltopay1 &nbsp;&nbsp �ҷ**</U> </b></FONT>";
 print " <BR><font face='AngsanaUPC' size='5' COLOR='#000066'><b>�����Թ���� <b>$totalpri2 </b>�ҷ</FONT>";
 print "&nbsp;&nbsp&nbsp;&nbsp <font face='AngsanaUPC' size='5' COLOR='#FF0033'>**�ѧ���������Թ &nbsp;&nbsp $totalpri3 &nbsp;&nbsp �ҷ** </b></FONT></center>";
 
 print "<font face='Angsana New'>������ �Ǫ�ѳ�� ";

?>


<tr><td colspan="15">
<input name="sumch" value="<?=$num?>" type="hidden" />
<input name="vnnow" value="<?=$vn?>" type="hidden" />
<input type="submit" name="btnsubmit" value="�͡�����"/></td></tr>
</table>

</form>

<form name="from3" method="post" action="opitem2_pt.php" target="_blank">

<?php
    session_start();//for security
    if (isset($sIdname)){} else {die;} //for security
     $today="$d-$m-$yr"; 
	 if($today=="--"){
		$today = $_GET['a']."-".$_GET['b']."-".$_GET['c'];
	}
     $today="$yr-$m-$d";
	 if($today=="--"){
		$today = $_GET['c']."-".$_GET['b']."-".$_GET['a'];
	}
	 
	
?>

<table>
 <tr>
 <th bgcolor=6495ED>���Թ</th>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>����&���Թ��ǹ�Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>AN</th>
 <th bgcolor=6495ED><font face='Angsana New'>VN</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����</th>
    <th bgcolor=F08080><font face='Angsana New'>�ԡ�����</th>
  <th bgcolor=#99FF99><font face='Angsana New'>�����Թ</th>
      <th bgcolor=6495ED><font face='Angsana New'>�Է��</th>
  <th bgcolor=6495ED><font face='Angsana New'>��Ѻ�ͧ�ҹ͡</th>
   <th bgcolor=#CC0000><font face='Angsana New'>������</th>
   <th bgcolor=6495ED><font face='Angsana New' size='1'>�͡opcard</th>
  </tr>

<?php
$credit="";
$date="";
    $detail="�����";
   // $num=0;
   $k=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,hn,an,price,paid,essd,nessdy,nessdn,dsy,dpy,dsn,dpn,row_id,accno,tvn,ptright FROM dphardep_pt WHERE (date LIKE '$today%' or (date LIKE '$today%' and price <=0)) and tvn='$vn' ";
	//echo $query;
    $result = mysql_query($query)
        or die("Query failed000");

    while (list ($date, $ptname,$hn,$an,$price,$paid,$essd,$nessdy,$nessdn,$dsy,$dpy,$dsn,$dpn,$row_id,$accno,$tvn,$ptright) = mysql_fetch_row ($result)) {
    $num++;
	$k++;
    $time=substr($date,11);
	
	$query6= "SELECT * FROM ddrugrx_pt WHERE idno ='$row_id' ";
    $result6 = mysql_query($query6) or die("Query failed111");
	$cunt6 = mysql_num_rows($result6);
	
	if( $price>0){  $totalpri2=$totalpri2+$price;} else { $totalpri2=$totalpri2+$price;};
// $totalpri2=$totalpri2+$price;

 if($paid!=0){

if($price>0){$paid1=$price;};
if($price<0){$paid1=$price;};
;}else {$paid1=0;};

 //$rowid=$row_id; //report
 $totalpri22=$totalpri22+$paid1;

 //����Թ��ǹ����ԡ�����
 	$topay=0;
if (empty($an)){    
	//$topay=$nessdn+$dsy+ $dsn+$dpn;   ��.�͡�ԡ�����
	$topay=$nessdn+ $dsn+$dpn;
	}
if (!empty($an)){    
	$topay=$nessdn+ $dsn+$dpn; //��.��ԡ�����
	}
$totalpaid2=$topay;
 if(substr($ptright,0,3)=='R07'){
			$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "#CCFF00";
			}else{
				$color = "FF8C8C";
			}
		}else if(substr($ptright,0,3)=='R03'){
			$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
			//echo $sql;

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "99CC00";
			}else{
				$color = "FF8C8C";
			}
		}else{
			$color = "66CDAA";
		}
$credit="";
$sql = "Select credit,billno From opacc where txdate = '$date' and $paid1 > '0' and hn='$hn' order by row_id desc limit 1";
//echo $sql;
$result2 = Mysql_Query($sql);
list($credit,$billno) = Mysql_fetch_row($result2);

if($credit=='�Թʴ'){$color3='#CC0000';}
else if($credit=='������'){$color3='#CC0000';}
else {$color3='#00CC99';}
$hnid = $hn;

        print " <tr>\n".
		   "  <td BGCOLOR=$color><font face='Angsana New' size='1' ><input name='ch$num' type='checkbox' value='$row_id'><font color='#CC0000'><B>$credit</B></font></td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$k</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$time</td>\n";
		
		if($topay>0&&$price!=$topay||$cunt6>15){
		   		print "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"oprxitem_pt.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n";
		}else{
				print "  <td BGCOLOR=$color><font face='Angsana New'>$ptname</td>\n";
		}
		print "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"printcscd.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$hn</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$tan</td>\n".
		   "  <td BGCOLOR=$color><font face='Angsana New'>$tvn</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=FFE4C4><font face='Angsana New'>$topay</td>\n".
           "  <td BGCOLOR=#99FF99><font face='Angsana New'>$paid1</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"oprxitemno50.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptright</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"rxcertify.php? Fulname=$ptname&Nessdy=$nessdy&hn=$hn&sDate=$date&tDate=$today&nRow_id=$row_id\">Ẻ���</a>.....<a target=_BLANK  href=\"rxcertify1.php? Fulname=$ptname&Nessdy=$nessdy&hn=$hn&sDate=$date&tDate=$today&nRow_id=$row_id\">Ẻ����</a>.....<a target=_BLANK  href=\"Medical_certificate.php? Fulname=$ptname&Nessdy=$nessdy&hn=$hn&sDate=$date&tDate=$today&nRow_id=$row_id\">A5</a>....</td>\n".

			      "  <td BGCOLOR=$color3><font face='Angsana New' size='1'>$credit($billno)</td>\n".
				  "  <td BGCOLOR=$color3><font face='Angsana New' size='1'>$toborow</td>\n".
           " </tr>\n";
		echo "<input name='sDate$num' value='$date' type='hidden' />";
		echo "<input name='nhn' value='$hn' type='hidden' />";
		echo "<input name='nAccno$num' value='$accno' type='hidden' />";
       }
//$totalpri1=$totalpri1+50;
//$totalpri=$totalpri1+$totalpri2; ���ٵù���͹ 09/10/58
//echo "--->$totalpri1+$totalpri2";
$totalpri=$totalpri2;  //���ٵù����ѧ 09/10/58
//$totalpri=$totalpri+50;
$totalpri2=$totalpri11+$totalpri22;
$totalpri3=$totalpri-$totalpri2;
$totaltopay1=$totalpaid1+$totalpaid2;
 print "<center><font face='AngsanaUPC' size='5' COLOR='#000066'>�������ѡ�Ҿ�Һ�ŷ�����<b>  $totalpri</b> �ҷ</FONT>";
  print "  &nbsp;&nbsp&nbsp;&nbsp  <font face='AngsanaUPC' size='5' COLOR='#FF0033'><U>**�ԡ����� &nbsp;&nbsp $totaltopay1 &nbsp;&nbsp �ҷ**</U> </b></FONT>";
 print " <BR><font face='AngsanaUPC' size='5' COLOR='#000066'><b>�����Թ���� <b>$totalpri2 </b>�ҷ</FONT>";
 print "&nbsp;&nbsp&nbsp;&nbsp <font face='AngsanaUPC' size='5' COLOR='#FF0033'>**�ѧ���������Թ &nbsp;&nbsp $totalpri3 &nbsp;&nbsp �ҷ** </b></FONT></center>";
 
 print "<font face='Angsana New'>�����ػ�ó� �Ǫ�ѳ�� ����Ҿ ";

?>
<tr><td colspan="15">
<input name="sumch" value="<?=$num?>" type="hidden" />
<input name="vnnow" value="<?=$vn?>" type="hidden" />
<input type="submit" name="btnsubmit" value="�͡����稤���ػ�ó����Ҿ"/></td></tr>
</table>

</form>
<BR>
<CENTER>**********************************
</CENTER>

<a href="reportcash.php?hn=<?=$hnid?>&date=<?=$dateid?>" target="_blank">�͡����ʴ���������㹡���ѡ�Ҿ�Һ����к��ԡ���µç�����������¹͡</a><BR>
<a href="reportcash1.php?hn=<?=$hnid?>&date=<?=$dateid?>" target="_blank">�͡����ʴ���������㹡���ѡ�Ҿ�Һ�Ż����������¹͡</a>

<?
/// ��Ǩ�ͺ��� ��.���ʹ��ҧ�����������
  
  	$strsql="select * from accrued where hn='".$hnid."' and status_pay='n' ";
	$strresult = mysql_query($strsql);
	$strrow=mysql_num_rows($strresult);


	if($strrow>0){
		echo "<script>alert('���������ʹ��ҧ���� ��سҵ�Ǩ�ͺ') </script>";
		echo "<br><br>&nbsp;&nbsp;&nbsp<b><font style='font-weight:bold'><a target=BLANK  href='accrued_list.php?hn=$hnid'>���ʹ��ҧ����</a></b></font>";

	}
//////// ��Ǩ�ͺ�Ҥ�ҧ����

	$date=(date("Y")+543).date("-m-d");

	$strsql1="select  * from  dphardep  where date like '$date%' and  hn='".$hnid."' and stkcutdate  IS NULL and dr_cancle IS NULL";
	//echo $strsql1;
	$strresult1= mysql_query($strsql1);
	$strrow1=mysql_num_rows($strresult1);


	if($strrow1>0){
		echo "<script>alert('����������¡�ä�ҧ�������ѹ���  ��سҵԴ�����ͧ��') </script>";
	}

$strsql2="select  * from  opday  where thidate like '$dateid%' and  hn='".$hnid."' and toborow='EX07 �ѹ�����'";
//echo $strsql2;
$strresult2= mysql_query($strsql2);
$strrow2=mysql_num_rows($strresult2);
$strrows=mysql_fetch_array($strresult2);	
//echo "==>".$strrows["ptright"];	
if($strrows["ptright"]=="R07 ��Сѹ�ѧ��"){	
$chkdate=substr($dateid,0,4);
$chksql="SELECT sum( denta ) AS pricedental, sum( other ) AS priceother
FROM `opday`
WHERE toborow = 'EX07 �ѹ�����' AND hn='".$hnid."' and (thidate like '$chkdate%' AND thidate not like '$date%')  AND `denta` >0 AND `other` >0";	
//echo $chksql;
$chkquery= mysql_query($chksql);
$chknum=mysql_num_rows($chkquery);
$chkrows=mysql_fetch_array($chkquery);
$sumprice=$chkrows["pricedental"]+$chkrows["priceother"];
	if($sumprice > 900){
		echo "<script>alert('����͹ : ���������ʹ�����ҷ��ѵ���÷ѹ����� ��$chkdate �Թ 900 �ҷ/�� ����Է�Ի���ª��ͧ��Сѹ�ѧ������') </script>";
	}else{
		echo "<script>alert('����͹ : ���������ʹ�����ҷ��ѵ���÷ѹ����� ��$chkdate ��� $sumprice �ҷ (�ӹǹ�Թ����������Ѻ�ѹ��� $date)') </script>";
	}	
}
?>
<?php 

$sql = "SELECT `thidate`,`vn` 
FROM `opday` WHERE `hn` = '$hnid' 
AND `thidate` < '$dateid' 
ORDER BY `thidate` DESC LIMIT 1";
$q = mysql_query($sql);
$item_opday = mysql_fetch_assoc($q);
echo '<br><br>';
echo '<b style="color: red;">�������Ҥ����ش�����ѹ��� '.$item_opday['thidate'].' ���� VN '.$item_opday['vn'].'</b>';

    include("unconnect.inc");
?>
