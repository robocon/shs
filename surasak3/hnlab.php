<?php
$cHn="";
$cPtname="";
$cPtright="";
$nRunno="";
$tvn="";
session_register("nRunno");
session_register("cHn");
session_register("cPtname");
session_register("cPtright");
session_register("tvn");
	
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
	
?>
<form method="POST" action="<?php echo $PHP_SELF ?>">
	<p>�����¹͡  HN (��ҡ�Ǫ����¹)</p>
	<p>&nbsp;&nbsp;HN&nbsp;&nbsp;<input type="text" name="hn" size="12" id="aLink"></p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="        ��ŧ        " name="B1"></p>
</form>
<script type="text/javascript">
	document.getElementById('aLink').focus();
</script>

<?php
include("connect.inc");
if(!empty($_POST['hn']) && $confirm != true){

$today = date("d-m-Y");   
$d=substr($today,0,2);
$m=substr($today,3,2);
$yr=substr($today,6,4) +543;  

$thdatehn=$d.'-'.$m.'-'.$yr.$hn;
$query = "SELECT idcard ,hn, concat(yot,' ',name,' ',surname) as ptname, ptright FROM opcard WHERE hn = '".$_POST['hn']."'  limit 1 ";

$result = mysql_query($query) or die(Mysql_Error());
$row=mysql_num_rows($result);
list($ccc,$xxx,$yyy,$zzz) = Mysql_fetch_row($result);
	
if($row){	
	
	print "HN :$xxx<br>";
   	print "$yyy<br>";
   	print "�Է�ԡ���ѡ�� :$zzz";
	if(substr($zzz,0,3)=='R07'){
		$sql = "Select id From ssodata where id LIKE '$ccc%' limit 1 ";

		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
		echo "<span style=\"background-color: #0033CC\"><B><FONT SIZE=\"3\"  COLOR=\"#FFFF00\"><BR>&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�ҡ�Է�Լ��������Է�Ի�Сѹ�ѧ��&nbsp;&nbsp;&nbsp;</FONT></B></span>";
		
			print "<br><a href='hnlab.php?hn=".$xxx."&confirm=true'>!���Ͷ١��ͧ ����¡�õ���</a>";
		}else{
			echo "<span style=\"background-color: #FF0000\"><B><FONT SIZE=\"3\"  COLOR=\"#0033CC\"><BR>&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�ҡ�Է�Լ���������Է�Ի�Сѹ�ѧ��&nbsp;&nbsp;&nbsp;</FONT></B></span>";
			echo "</br><FONT SIZE=\"3\"  COLOR=\"#0033CC\">��سҵԴ���Ἱ�����¹���ͻ�Ѻ��ا�Է�ԡ���ѡ��</FONT>";
		}
	}else if(substr($zzz,0,3)=='R03'){
		$sql = "Select hn, status From cscddata where hn = '$xxx' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";

		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
		echo "<span style=\"background-color: #0033CC\"><B><FONT SIZE=\"3\"  COLOR=\"#FFFF00\"><BR>&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�ҡ�Է�Լ��������Է�Ԩ��µç&nbsp;&nbsp;&nbsp;</FONT></B></span>";
			print "<br><a href='hnlab.php?hn=".$xxx."&confirm=true'>!���Ͷ١��ͧ ����¡�õ���</a>";
		}else{
			echo "<span style=\"background-color: #FF0000\"><B><FONT SIZE=\"3\"  COLOR=\"#0033CC\"><BR>&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�ҡ�Է�Լ���������Է�Ԩ��µç&nbsp;&nbsp;&nbsp;</FONT></B></span>";
			echo "</br><FONT SIZE=\"3\"  COLOR=\"#0033CC\">��سҵԴ���Ἱ�����¹���ͻ�Ѻ��ا�Է�ԡ���ѡ��</FONT>";
		}
	}else{
		print "<br><a href='hnlab.php?hn=".$xxx."&confirm=true'>!���Ͷ١��ͧ ����¡�õ���</a>";
	}
}else{
	echo "��辺 HN $xxx";
}
	
   

}else if (!empty($hn) && !empty($confirm)){
	
    include("connect.inc");

    $vnlab = 'EX93 �͡ VN �� LAB';

	// ��Ǩ�ͺ�����͡ EX44 ��Ǩ�آ�Ҿ��Сѹ�ѧ��
	$today_check = date('Y-m-d');
	$sql = "SELECT `hn` 
	FROM `testmatch` 
	WHERE `hn` = '$hn' 
	AND `date_start` <= '$today_check' 
	AND `date_end` >= '$today_check' ";
	$q = mysql_query($sql) or die( mysql_query() );
	$test_rows = mysql_num_rows($q);

	if( $test_rows > 0 ){
		$vnlab = 'EX44 ��Ǩ�آ�Ҿ��Сѹ�ѧ��';
	}
	// ��Ǩ�ͺ�����͡ EX44 ��Ǩ�آ�Ҿ��Сѹ�ѧ��

    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
    $thdatehn=$d.'-'.$m.'-'.$yr.$hn;
    $thidate = (date("Y")+543).date("-m-d H:i:s"); 
	
	// ��Ǩ�����ŧ����¹�����ѧ
    $query = "SELECT * FROM opday WHERE thdatehn = '$thdatehn' Order by row_id DESC ";
    $result = mysql_query($query) or die("Query failed,opday ".mysql_error());

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if(!($row = mysql_fetch_object($result)))
			continue;
	}

	if(mysql_num_rows($result)){
		//�ó�ŧ����¹����
		$cHn=$row->hn;
		$cPtname=$row->ptname;
		$cPtright=$row->ptright;
		$tvn=$row->vn;
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=labask.php\">";
	}else{
		//�Ң����Ũҡ opcard �ͧ $cHn ��������㹡ó�ŧ����¹���� �����ѧ���ŧ
	    $query = "SELECT * FROM opcard WHERE hn = '$hn'";
	    $result = mysql_query($query) or die("Query failed".mysql_error());

	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
			}
	        if(!($row = mysql_fetch_object($result)))
	            continue;
		}

        if(mysql_num_rows($result)){

			$cHn=$row->hn;
			$cYot = $row->yot;
			$cName = $row->name;
			$cSurname = $row->surname;
			$cPtname=$cYot.' '.$cName.'  '.$cSurname;
			$cPtright = $row->ptright;
			$cGoup=$row->goup;
			$cCamp=$row->camp;
			$cNote=$row->note;
			$cIdcard=$row->idcard;
			$dbirth=$row->dbirth;
			$cAge=calcage($dbirth);

			//��˹���� VN �ҡ runno table
			$query = "SELECT * FROM runno WHERE title = 'VN'";
			$result = mysql_query($query) or die("Query failed".mysql_error());
			for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
				if (!mysql_data_seek($result, $i)) {
					echo "Cannot seek to row $i\n";
					continue;
				}
				if(!($row = mysql_fetch_object($result)))
					continue;
			}
			$nVn=$row->runno;
			$dVndate=$row->startday;
			$dVndate=substr($dVndate,0,10);
			$today = date("Y-m-d");

			//�ѧ�������¹�ѹ���
			if($today==$dVndate){
				$nVn++;
				$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
				$query ="UPDATE runno SET runno = $nVn WHERE title='VN'";
				$result = mysql_query($query) or die("Query failed".mysql_error());
				$tvn=$nVn;
			}

			//�ѹ����
			if($today<>$dVndate){
				$nVn=1;
				$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
				$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
				$result = mysql_query($query) or die("Query failed".mysql_error());
				$tvn=$nVn;
			}

			//ŧ����¹� opday table
			$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,
			ptright,goup,camp,note,toborow,idcard,officer)VALUES('$thidate','$thdatehn','$cHn','$nVn',
			'$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$cNote','$vnlab',' $cIdcard','".$_SESSION["sOfficer"]."');";
			$result = mysql_query($query) or die("Query failed,cannot insert into opday1".mysql_error());
		
			////////////�Դ�Թ 50 �ҷ
			$check = "select * from depart where hn = '".$cHn."' and  detail = '(55020/55021 ��Һ�ԡ�ü����¹͡)' and date like '".(date("Y")+543).date("-m-d")."%' ";
			$resultcheck = mysql_query($check) or die( mysql_error() );
			$cal = mysql_num_rows($resultcheck);
			if($cal==0){
				//runno  for chktranx
				$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
				$result = mysql_query($query) or die("Query failed ".mysql_error());
			
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
				$result = mysql_query($query) or die("Query failed".mysql_error());
			
				$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$thidate."','".$cPtname."','".$cHn."','','OTHER','1','(55020/55021 ��Һ�ԡ�ü����¹͡)', '50','50','0','','".$_SESSION["sOfficer"]."','0','".$nVn."','".$cPtright."');";
				$result = mysql_query($query) or die( mysql_error() );
				$idno=mysql_insert_id();
			
				$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$thidate."','".$cHn."','','".$cPtname."','1','SERVICE','(55020/55021 ��Һ�ԡ�ü����¹͡)','1','50','50','0','OTHER','OTHER','".$idno."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata".mysql_error());
				
				$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
				$result = mysql_query($query) or die("Query failed,update opday".mysql_error());
			}
			////////////////////////////////���Դ�Թ 50 �ҷ

			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=labask.php\">";
		}else{
   			print"��辺 HN $hn ��Ǫ����¹";
		}
	} // �����ŧ����¹

	//runno  for chktranx
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
    $result = mysql_query($query) or die("Query failed".mysql_error());

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
    $result = mysql_query($query) or die("Query failed".mysql_error());
    include("unconnect.inc");
}
?>