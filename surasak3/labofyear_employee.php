<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
}
-->
</style><a href ="labemployee.php" >&lt;&lt; �����¡������</a><br />
<style type="text/css">
.font5 {
	font-family: AngsanaUPC;
	font-size: 22px;
}
</style>
<script>
function check(){
	if(document.form1.pro1.checked == false && document.form1.pro2.checked == false && document.form1.pro3.checked == false && document.form1.pro4.checked == false){
		alert('��س����͡�������õ�Ǩ');
		document.form1.pro1.focus();
		return false;																																			
	}else{
		return true;
	}
}
</script>
<div style="font-size:28px"><strong>��� LAB ��Ǩ�آ�Ҿ�١��ҧ��Шӻ�</strong></div>
<hr />
<?
session_start();
include("connect.inc");
session_start('nRunno');
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

if(isset($_GET['id'])){
	session_register('hn');
	$sql ="select * from opcard where hn='".$_GET['id']."' ";
	$row = mysql_query($sql);
	$rep = mysql_fetch_array($row);
	echo "<span class='font5'>HN :".$rep['hn']."&nbsp;&nbsp;&nbsp;&nbsp;���� : ".$rep['yot']." ".$rep['name']." ".$rep['surname']."<br>";
	$_SESSION['hn']=$rep['hn'];
	$age = calcage($rep['dbirth']);
	if($age=="255"){ $age="����Һ����";}
	echo "���� : ".$age."<br>";
	echo "�ä : ��Ǩ�آ�Ҿ &nbsp;&nbsp;�Է�� : R42 ��Ǩ�آ�Ҿ�١��ҧ��Шӻ�</span>";
?>
<hr />
<form name="form1" method="post" action="labofyear_employee.php" onsubmit="return check()" >
  <span class="font5"><strong>���͡�������õ�Ǩ</strong><br />
<input name="pro" type="radio" id="pro1" value="1" <? if(substr($age,0,2) < 35){ echo "checked='checked'";}?> /> ����� 1 (��������Թ 35 ��)<br />
<input name="pro" type="radio" id="pro3" value="3" <? if(substr($age,0,2) >= 35){ echo "checked='checked'";}?> /> ����� 3 (���ص���� 35 �բ���)<br />
<input type="hidden" value="<?=$rep['hn']?>" name="hn" />
<input type="submit" name="okbtn" value="��ŧ"/>
  </span>
</form>
<span class="font5">
<?
}elseif(isset($_POST['okbtn'])){
	///////////////////////////////////
	$chn=$_SESSION['hn'];
	$_SESSION['cHn'] = $_SESSION['hn'];
	$thidate = (date("Y")+543).date("-m-d H:i:s");
	$thdatehn= date("d-m-").(date("Y")+543).$_SESSION['hn'];
	$vnlab = '��Ǩ�آ�Ҿ�١��ҧ��Шӻ�';   
	// ��Ǩ�����ŧ����¹�����ѧ
    $query = "SELECT * FROM opday WHERE thdatehn = '$thdatehn' Order by row_id DESC ";
    $result = mysql_query($query) or die("Query failed,opday");

		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
	
			if(!($row = mysql_fetch_object($result)))
				continue;
         }

 //     $cHn=$row->hn;
        if(mysql_num_rows($result)){
  //�ó�ŧ����¹����
  	      	$cHn=$row->hn;
  	      	$cPtname=$row->ptname;
 	      	$cPtright=$row->ptright;
  	  		$tvn=$row->vn;
		}
		else{
//�Ң����Ũҡ opcard �ͧ $cHn ��������㹡ó�ŧ����¹���� �����ѧ���ŧ
			$query = "SELECT * FROM opcard WHERE hn = '$chn'";
			$result = mysql_query($query) or die("Query failed");
	
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
	
		//print"$cPtname $cGoup<br>";
	
		//��˹���� VN �ҡ runno table
			$query = "SELECT * FROM runno WHERE title = 'VN'";
			$result = mysql_query($query) or die("Query failed");
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
				$result = mysql_query($query) or die("Query failed");
				$tvn=$nVn;
	//	        print "�������Ţ VN = $nVn<br>";
			}
	//�ѹ����
			if($today<>$dVndate){    
				$nVn=1;
				$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
				$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
				$result = mysql_query($query) or die("Query failed");
				$tvn=$nVn;
	//                         print "�ѹ����  ����� VN = $nVn <br>";
			}
	//ŧ����¹� opday table
			$thdatevn = date("d-m-").(date("Y")+543).$nVn;
			$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,ptright,goup,camp,note,toborow,idcard,officer)VALUES('$thidate','$thdatehn','$cHn','$nVn','$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp','$cNote','$vnlab',' $cIdcard','".$_SESSION["sOfficer"]."');";
			$result = mysql_query($query) or die("Query failed,cannot insert into opday");
			}
		}
		
	/////////////////////////////////////
	$_SESSION['aDgcode'] = array();
	$sqlvn = "select vn from opday WHERE thdatehn= '$thdatehn'";
	$rowvn = mysql_query($sqlvn);
	list($vn_now) = mysql_fetch_array($rowvn);
	
	$sql ="select * from opcard where hn='".$_POST['hn']."' ";
	$row = mysql_query($sql);
	$rep = mysql_fetch_array($row);
	$_SESSION['hn']=$rep['hn'];
	echo "<span class='font5'>HN :".$rep['hn']."&nbsp;&nbsp;&nbsp;&nbsp;���� : ".$rep['yot']." ".$rep['name']." ".$rep['surname']."<br>";
	$age = calcage($rep['dbirth']);
	if($age=="255"){ $age="����Һ����";}
	echo "���� : ".$age."&nbsp;&nbsp;VN :".$vn_now."<br>";
	echo "�ä : ��Ǩ�آ�Ҿ &nbsp;&nbsp;�Է�� : R42 ��Ǩ�آ�Ҿ�١��ҧ��Шӻ�<br><br>";
	echo "<fieldset><legend><strong>��¡�õ�Ǩ</strong></legend>";
	$i=0;
	if($_POST['pro']=="3" || $_POST['pro']=="4"){
		$sql = "select * from labcare where (code='CBC' OR code='UA' OR code='BS' OR code='LDL'  OR code='BUN' OR code='CR' OR code='SGOT' OR code='SGPT' OR code='ALK')";  //���� lab ����Ǩ
	}else{
		$sql = "select * from labcare where (code='CBC' OR code='UA')";  //���� lab ����Ǩ
	}
	$row = mysql_query($sql);
	while($rep = mysql_fetch_array($row)){
		$i++;
		echo "$i"." ".$rep['code']." ".$rep['detail']." �Ҥ� ".$rep['price']." �ҷ<br>";
		$allpri+=$rep['price'];
		array_push($_SESSION['aDgcode'],$rep['code']);  //����� lab ����Ǩ� array	
	}
	

	echo "�Ҥ���� $allpri �ҷ &nbsp;&nbsp;&nbsp;";
	echo "�ѹ��� ".date("d-m-").(date("Y")+543)." ".date("H:i:s");
	echo "</fieldset><br><br>";
	
	$query = "SELECT * FROM runno WHERE title = 'depart'";
	$result = mysql_query($query) or die("Query failed");
	
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
	$_SESSION['nRunno'] = $nRunno;
	echo "<a href='labofyeartranx_employee.php?pro=$_POST[pro]' target='_blank'>�����¡�����˹��</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='labslip4bc_chkup_employee.php' target='_blank'>ʵ������</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='labslip4cbc_chkup_employee.php' target='_blank'>ʵ������ CBC</a>
&nbsp;&nbsp;&nbsp;&nbsp;<a href='labslip4ua_chkup_employee.php' target='_blank'>ʵ������ UA</a><br><br></span>";
	
	
	
}
?>

</span>
<a href ="labemployee.php" >&lt;&lt; �����¡������</a><br />
