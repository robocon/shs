<?php
 session_start();
    $cHn="";
    $cPtname="";
    $cPtright="";
    $nRunno="";
    session_register("nRunno");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");

	function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}


   $tvn="";
    session_register("tvn");
If (!empty($hn)){
    include("connect.inc");
	


    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
	$thidatehn=$d.'-'.$m.'-'.$yr.$hn;

	$sql = "Select vn From opday where thdatehn = '".$thidatehn."' ORDER BY row_id DESC limit 1";
	$opday_result = Mysql_Query($sql);
	$opday_row = mysql_num_rows($opday_result);
	
	if($opday_row > 0){
		list($vn) = mysql_fetch_row($opday_result);
		$tvn = $vn;
	}else{
		$query = "SELECT `idcard` , `hn` , `yot` , `name` , `surname` , `goup` , `dbirth` , `idguard` , `ptright` , `note` , `camp`   FROM opcard WHERE hn = '".$hn."' limit 1";
	    $result = mysql_query($query) or die("Query failed");
		list($cIdcard,$cHn,$cYot,$cName,$cSurname,$cGoup,$dbirth,$cIdguard,$cPtright,$cNote,$cCamp) = mysql_fetch_row($result);
		$cAge=calcage($dbirth);
		$cPtname=$cYot.' '.$cName.'  '.$cSurname;
		$vnlab = 'EX04 �����¹Ѵ';
		$query = "SELECT runno, startday FROM runno WHERE title = 'VN' ";
	    $result = mysql_query($query) or die("Query failed1");
		list($nVn, $dVndate) = mysql_fetch_row($result);
		$dVndate=substr($dVndate,0,10);
		
		if(date("Y-m-d")==$dVndate){
			$nVn++;
			$query ="UPDATE runno SET runno = $nVn WHERE title='VN' limit 1 ";

		}else if(date("Y-m-d") <> $dVndate){
			$nVn=1;
			$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN' limit 1 ";
		}
			$result = mysql_query($query) or die("Query failed2");
			$tvn = $vn=$nVn;

			$time1 = date("H:i:s");
			$thidate = date("d-m-").(date("Y")+543);
			$thdatevn=$thidate.$nVn;
			$thidate_now = (date("Y")+543).date("-m-d").date(" H:i:s");
			 $query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname, ptright,goup,camp,note,toborow,time1,idcard,dxgroup,officer)VALUES('".$thidate_now."','".$thidatehn."','".$cHn."','".$nVn."', '".$thdatevn."','".$cPtname."','".$cPtright."','".$cGoup."','".$cCamp."','".$cNote."','".$vnlab."','".$time1."','".$cIdcard."','21','".$_SESSION["sOfficer"]."');";
			$result = mysql_query($query) or die("Query failed,cannot insert into opday");
	}


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

		$x=0;
    $aDgcode = array("����");
    $aTrade  = array("��¡��");
    $aPrice  = array("�Ҥ� ");
    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
    $aMoney= array("       ����Թ   ");
    $Netprice="";   

    $aYprice = array("�Ҥ� ");
    $aNprice = array("�Ҥ� ");
    $aSumYprice = array("�Ҥ� ");
    $aSumNprice = array("�Ҥ� ");
    session_register("aYprice");
    session_register("aNprice");
    session_register("aSumYprice");
    session_register("aSumNprice");

    $cPart="";
    $cDiag=$diag;
    $cDoctor=$doctor;
    $cAn="";
    $cAccno=0;
	$tvn="$tvn";
    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aMoney");
    session_register("Netprice");
    session_register("cPart");
    session_register("cDiag");
    session_register("cAn"); 
    session_register("cDoctor"); 
    session_register("cAccno"); 
	session_register("tvn"); 
	session_register("list_codeed");

	session_register("cDepart"); 

	$_SESSION["list_codeed"] = array();
	//$_SESSION["cDoctor"] = "MD013 ����Թ��� ����չҤ";
	$_SESSION["cDiag"] = "";
	$_SESSION["Amount"] = 1;
	$Amount = 1;

	$query = "SELECT * FROM labcare WHERE code = 'clinic100' ";
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
	    $x++;
	    $aDgcode[$x]=$row->code; 
	    $aTrade[$x]=$row->detail;
	    $aPrice[$x]=$row->price;

	    $aPart[$x]=$row->part;
	    $aAmount[$x]=$Amount;
	    $money = $Amount*$row->price ;
	    $aMoney[$x]=$money;
	    $Netprice=array_sum($aMoney);

	    $aYprice[$x]=$row->yprice*$Amount;
		$aNprice[$x]=$row->nprice*$Amount;
		
		$cDepart = $row->depart;

	    //$aSumYprice=array_sum($aYprice);
	    //$aSumNprice=array_sum($aNprice);
?>
<form action="clinic100print.php" method="post" target="_blank">
<?
	print "�����¹͡<br>";
	print "HN :$cHn<br>";
	print "VN :$tvn<br>";
	print "$cPtname<br>";
	print "�Է�ԡ���ѡ�� :$cPtright<br>";
	print "�ä :$cDiag<br>";
	//print "ᾷ�� :$cDoctor<br>";
	print "ᾷ�� :";
?>
<select name="cDoctor" id="cDoctor"> 
<option value="" selected="selected">- - ��س����͡ᾷ�� - -</option>
<option value="MD007 �ç�� ��մ�͹ѹ��آ" >MD007 �ç�� ��մ�͹ѹ��آ</option>  
<option value="MD009 ����� �����ѡ���" >MD009 ����� �����ѡ���</option>
<option value="MD013 ����Թ��� ����չҤ" >MD013 ����Թ��� ����չҤ</option>
<option value="MD100 ����Թ��� �������" >MD100 ����Թ��� �������</option>
<!-- <option value="MD070 ��зջ ��������" >MD070 ��зջ ��������</option> -->
<option value="MD105 ��Ǵ� �زԾԷ������" >MD105 ��Ǵ� �زԾԷ������</option> 
<option value="MD106 ���ʨԵ�� �س·�þ" >MD106 ���ʨԵ�� �س·�þ</option> 
<option value="MD107 ��� ���ǡԵԾ���" >MD107 ��� ���ǡԵԾ���</option> 
<option value="MD117 �Ѫ������ ���դ�" >MD117 �Ѫ������ ���դ�</option> 
<option value="MD122 ���� �ع��������" >MD122 ���� �ع��������</option> 
<option value="MD123 �ҷԹ� �ʹ�����" >MD123 �ҷԹ� �ʹ�����</option>
<!-- <option value="MD125 ������ø��  ���ҧ��ǧ��" >MD125 ������ø��  ���ҧ��ǧ��</option> -->
<option value="MD136 ��ԭ�� ���͹����" >MD136 ��ԭ�� ���͹����</option> 
<option value="MD137 ��ɮ�쾧�� ��������ѡ��" >MD137 ��ɮ�쾧�� ��������ѡ��</option> 
<option value="MD138 �ѷ�� �������ǵ" >MD138 �ѷ�� �������ǵ</option> 
<option value="MD140 �Ѫ�����  �ǧ�ص��ѵ��" >MD140 �Ѫ�����  �ǧ�ص��ѵ��</option>
<option value="MD141 ��� ����" >MD141 ��� ����</option> 
<option value="MD142 ��óԡ���  �������ó" >MD142 ��óԡ���  �������ó</option>
<option value="MD144 ͹�Ѫ �ػ����ԭ�آ" >MD144 ͹�Ѫ �ػ����ԭ�آ</option>
<option value="MD150 �ѵ����õ� �����ѵ����" >MD150 �ѵ����õ� �����ѵ����</option>
<option value="MD152 ����Ԫ�� �Է������ʡ��" >MD152 ����Ԫ�� �Է������ʡ��</option>
<option value="MD164 ����ѵ�� ⪤�����ط�" >MD164 ����ѵ�� ⪤�����ط�</option>
<option value="MD171 ����Ѳ�� ����ķ���പ�" >MD171 ����Ѳ�� ����ķ���പ�</option>
</select>
<?
	print "<br><br>�Ҥ� :";
	?>
<select name="cPrice" id="cPrice"> 
<option value="" >- - ��س����͡��Һ�ԡ��- -</option>
<option value="100">100 �ҷ</option>  
<option value="150">150 �ҷ</option>
<option value="200">200 �ҷ</option>
<option value="300" selected="selected">300 �ҷ</option>  
</select>
<br /><br />
<input name="save" type="submit" value="���Ͷ١��ͧ �Դ��������" />
</form>
	<?
      //  print "VN  :$vn<br>";
      //  print "HN :$cHn<br>";
      //  print "$cPtname<br>";
     //   print "�Է�ԡ���ѡ�� :$cPtright";
        //print "<br><a target=_BLANK href=\"clinic100print.php\">���Ͷ١��ͧ �Դ��������</a>";
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
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
           }
   include("unconnect.inc");
   }
?>

