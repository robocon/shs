<?php 

session_start();

$month["01"] ="���Ҥ�";
$month["02"] ="����Ҿѹ��";
$month["03"] ="�չҤ�";
$month["04"] ="����¹";
$month["05"] ="����Ҥ�";
$month["06"] ="�Զع�¹";
$month["07"] ="�á�Ҥ�";
$month["08"] ="�ԧ�Ҥ�";
$month["09"] ="�ѹ��¹";
$month["10"] ="���Ҥ�";
$month["11"] ="��Ȩԡ�¹";
$month["12"] ="�ѹ�Ҥ�";
session_register("cHn");

if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >�����¤�Ѻ ��� Login �ͧ��ҹ������� </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">��Ѻ˹���á</a></center>";
exit();
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�Ѵ�¡������</title>
<style type="text/css">

.data_show{ 
	font-family:"TH SarabunPSK"; 
	font-size:18px; 
	color:#000000;
	}

.data_drugreact{ 
	font-family:"TH SarabunPSK"; 
	font-size:18px; 
	color:#FF0000;
	
	}
.data_title{ 
	font-family:"TH SarabunPSK"; 
	font-size:22px; 
	color:#FFFFFF;
	font-weight:bold;
	background-color:#339999;
	}
.txtsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:16px; 
	font-weight:bold;
	}	
.headsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:22px; 
	}
	
body{ font-family:"TH SarabunPSK"; 
font-size:18px;
}

.style1 {
	font-size: 28px;
	font-weight: bold;
}
.buttonred {
  background-color: #f44336; /* red */
  font-family:"TH SarabunPSK"; 
  border: none;
  border-radius: 12px;
  color: white;
  padding: 12px 28px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 22px;
  font-weight:bold;
}
</style>
<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
</head>

<body >
<?php
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

include("connect.inc");   

$thidate = date("d-m-").(date("Y")+543);
$thidatehn = $thidate.$_REQUEST["hn"];
$thidatevn = $thidate.$_POST["vn"];
$thidate_now = (date("Y")+543).date("-m-d").date(" H:i:s");

if((isset($_POST["basic_opd"]) && $_POST["basic_opd"] != "") || (isset($_POST["print_basic_opd"]) && $_POST["print_basic_opd"] != "") ){

$strSQL1 = "SELECT * FROM doctor WHERE status='y' and row_id= '$_POST[doctor]'";
$result1 = mysql_query($strSQL1);
$row1 = mysql_fetch_array($result1);
$doctorname = $row1['name'];
//$clinicname = $row1['position'];
//$roomname = $row1['room'];

if($_POST["cigarette"]=="1"){
	$_POST["member2"]=$_POST["member2"];
}else{
	$_POST["member2"]="";
}

	$bp3 = $_POST['bp3'];
	$bp4 = $_POST['bp4'];
	$cAge = $_POST['age'];

	$mens = ( empty($_POST['mens']) ) ? NULL : $_POST['mens'] ;
	$mens_date = ( empty($_POST['mens_date']) ) ? '0000-00-00' : $_POST['mens_date'] ;
	$vaccine = ( empty($_POST['vaccine']) ) ? NULL : $_POST['vaccine'] ;
	$parent_smoke = ( empty($_POST['parent_smoke']) ) ? NULL : $_POST['parent_smoke'] ;
	$parent_smoke_amount = ( empty($_POST['parent_smoke_amount']) ) ? 0 : $_POST['parent_smoke_amount'] ;
	$parent_drink = ( empty($_POST['parent_drink']) ) ? NULL : $_POST['parent_drink'] ;
	$parent_drink_amount = ( empty($_POST['parent_drink_amount']) ) ? 0 : $_POST['parent_drink_amount'] ;
	$smoke_amount = ( empty($_POST['smoke_amount']) ) ? 0 : $_POST['smoke_amount'] ;
	$drink_amount = ( empty($_POST['drink_amount']) ) ? 0 : $_POST['drink_amount'] ;
	$ht_amount = ( empty($_POST['ht_amount']) ) ? NULL : $_POST['ht_amount'] ;
	$dm_amount = ( empty($_POST['dm_amount']) ) ? NULL : $_POST['dm_amount'] ;
	$hpi = htmlspecialchars($_POST['hpi'], ENT_QUOTES);

	$grade = ( empty($_POST['grade']) ) ? NULL : $_POST['grade'] ;
	$mind = ( empty($_POST['mind']) ) ? NULL : $_POST['mind'] ;
	$the_pill = ( empty($_POST['the_pill']) ) ? NULL : $_POST['the_pill'] ;
	
	$sql = "Select count(row_id) From opd where thdatehn = '".$thidatehn."' limit 1";
	$result = Mysql_Query($sql);
	list($rows) = Mysql_fetch_row($result);
	
if($rows > 0){

$sql = "Update `opd` set  `thidate` = '".$thidate_now."', 
`temperature`  = '".$_POST["temperature"]."', 
`pause`  = '".$_POST["pause"]."', 
`rate`  = '".$_POST["rate"]."', 
`weight`  = '".$_POST["weight"]."', 
`bp1`  = '".$_POST["bp1"]."', 
`bp2`  = '".$_POST["bp2"]."', 
`drugreact`  = '".$_POST["drugreact"]."', 
`congenital_disease`  = '".$_POST["congenital_disease"]."', 
`type`  = '".$_POST["type"]."', 
`organ`  = '".$_POST["organ"]."', 
`doctor` = '".$doctorname."',  
`officer` = '".$_SESSION["sOfficer"]."' ,  
`dc_diag` = Null, `vn`= '".$_POST["vn"]."', 
`toborow` = '".$_POST["toborow"]."', 
`height` = '".$_POST["height"]."' , 
`clinic`  = '".$_POST["clinic"]."' , 
`cigarette`= '".$_POST["cigarette"]."', 
`alcohol`= '".$_POST["alcohol"]."', 
`cigok`= '".$_POST["member2"]."', 
`waist`= '".$_POST["waist"]."',
`chkup`= '".$_POST["typediag"]."',
`room`= '".$_POST["room"]."' ,
`painscore`= '".$_POST["painscore"]."',
`age`='".$cAge."',
`bp3`='$bp3',
`bp4`='$bp4', 
`mens` = '$mens', 
`mens_date` = '$mens_date', 
`vaccine` = '$vaccine', 
`parent_smoke` = '$parent_smoke', 
`parent_smoke_amount` = '$parent_smoke_amount', 
`parent_drink` = '$parent_drink', 
`parent_drink_amount` = '$parent_drink_amount', 
`smoke_amount` = '$smoke_amount', 
`drink_amount` = '$drink_amount', 
`ht_amount` = '$ht_amount', 
`dm_amount` = '$dm_amount', 
`hpi` = '$hpi',
`grade` = '$grade', 
`mind` = '$mind', 
`the_pill` = '$the_pill' 

where  `thdatehn` = '".$thidatehn."' limit 1 ";



}else{
		
$sql = "INSERT INTO `opd` (
	`row_id` ,`thidate` ,`thdatehn`, `hn`, `ptname` ,`temperature` ,
	`pause` ,`rate` ,`weight` ,`bp1`  ,`bp2` ,`drugreact` ,
	`congenital_disease` ,`type` ,`organ` ,`doctor`, `officer`, `vn` , 
	`toborow`, `height`, `clinic`, `cigarette`, `alcohol`,`cigok`,
	`waist`,`chkup`,`room`,`painscore`,`age`,`bp3`,
	`bp4`,`mens`,`mens_date`,`vaccine`,`parent_smoke`,`parent_smoke_amount`,
	`parent_drink`,`parent_drink_amount`,`smoke_amount`,`drink_amount`,`ht_amount`,`dm_amount`,
	`hpi`,`grade`,`mind`,`the_pill`
)VALUES (
	NULL , '".$thidate_now."', '".$thidatehn."', '".$_REQUEST["hn"]."', '".$_POST["ptname"]."', '".$_POST["temperature"]."', 
	'".$_POST["pause"]."', '".$_POST["rate"]."', '".$_POST["weight"]."', '".$_POST["bp1"]."', '".$_POST["bp2"]."', '".$_POST["drugreact"]."', 
	'".$_POST["congenital_disease"]."', '".$_POST["type"]."', '".$_POST["organ"]."', '".$doctorname."', '".$_SESSION["sOfficer"]."', '".$_POST["vn"]."', 
	'".$_POST["toborow"]."', '".$_POST["height"]."', '".$_POST["clinic"]."', '".$_POST["cigarette"]."', '".$_POST["alcohol"]."', '".$_POST["member2"]."', 
	'".$_POST["waist"]."', '".$_POST["typediag"]."', '".$_POST["room"]."', '".$_POST["painscore"]."' ,'".$cAge."','$bp3',
	'$bp4','$mens','$mens_date','$vaccine','$parent_smoke','$parent_smoke_amount', 
	'$parent_drink','$parent_drink_amount','$smoke_amount','$drink_amount','$ht_amount','$dm_amount', 
	'$hpi', '$grade','$mind','$the_pill'
);";

}

	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	$field="";
	if($_POST["appoint"] > 0){
		$field = ", toborow = 'EX04 �����¹Ѵ' ";
	}

	$sql ="UPDATE opday SET clinic = '".$_POST["clinic"]."' ".$field.", typeservice='".$_POST["typeservice"]."', subgroup= '".$_POST["subgroup"]."'  WHERE  thdatehn='".$thidatehn."' AND vn = '".$_POST["vn"]."' ";   // ��䢢����ŵ��ҧ opday ����ѹ��� ��� vn
	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	$sql1 ="UPDATE opcard SET goup ='".$_POST["goup"]."', typeservice='".$_POST["typeservice"]."', subgroup= '".$_POST["subgroup"]."'  WHERE  hn = '".$_REQUEST["hn"]."' ";   // ��䢢����ŵ��ҧ opcard ��� hn
	$result1 = Mysql_Query($sql1) or die(Mysql_Error());	
	
	if($_POST["appoint"] > 0){
	$sql = "Select count(row_id) From opday2 where thdatehn = '".$thidatehn."' AND toborow like 'EX04%' limit 1";
	
	list($countex03) = mysql_fetch_row(mysql_query($sql));

		if($countex03 == 0){
			
			$sql = "Select * From opday2 where thdatehn = '".$thidatehn."'  limit 1 ";
			$arr = mysql_fetch_assoc(mysql_query($sql));

			$sql = "INSERT INTO opday2(thidate,thdatehn,hn,vn,thdatevn,ptname,age,  ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw)VALUES('".$thidate_now."','".$thidatehn."','".$_REQUEST["hn"]."','".$_POST["vn"]."',  '".$thidatevn."','".$arr["ptname"]."','".$arr["age"]."','".$arr["ptright"]."','".$arr["goup"]."','".$arr["camp"]."','".$arr["note"]."','".$arr["idcard"]."','EX04 �����¹Ѵ','".$arr["borow"]."','".$arr["dxgroup"]."','$sOfficer','');";
			mysql_query($sql) or die(mysql_error());


		}
	}
	
	if(!empty($_GET["close"])){
		$plus = "window.close();";
	}else{
		$plus = "";
	}

	if((isset($_POST["print_basic_opd"]) && $_POST["print_basic_opd"] != "")){
		echo "<SCRIPT LANGUAGE=\"JavaScript\">window.onload = function(){ window.open('stk_basic_opd.php?dthn=".urlencode($thidatehn)."'); ".$plus." }</SCRIPT>";
	echo "<center><br /><a href=\"basic_opd.php\" style=\"font-family:'MS Sans Serif'; font-size:14px; color:#FF0000;\"> &lt;&lt;  ��Ѻ</a></center>";
	$time = "6";
	}else{
		echo "<SCRIPT LANGUAGE=\"JavaScript\">window.onload = function(){ window.open('insert_basic_opd.php?dthn=".urlencode($thidatehn)."'); ".$plus." }</SCRIPT>";
	echo "<center><br /><a href=\"basic_opd.php\" style=\"font-family:'MS Sans Serif'; font-size:14px; color:#FF0000;\"> &lt;&lt;  ��Ѻ</a></center>";
		$time = "3";
	}

	if($plus == ""){
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"".$time.";URL=basic_opd.php\">";
	}
	exit();
}

$choose = array();

array_push($choose,"�� �� ����_�ѹ");
array_push($choose,"�Ǵ����� �Ҿ������ ����_�ѹ");
array_push($choose,"�Ѻ Fax ����ҹ Refer �ҡ þ.�ӻҧ �Է����Сѹ�ѧ�� þ.�����");
array_push($choose,"�����һ���ѵԡ���ѡ��");
array_push($choose,"����Ѻ�ͧᾷ��");
array_push($choose,"����Ѻ�ͧᾷ�짴ࡳ�����");
array_push($choose,"����Ѻ�ͧᾷ�� ��Сͺ����ػ���� �кص�Ǩ HIV , Urine Amphetamine");
array_push($choose,"����Ѻ�ͧᾷ�� ��Сͺ�����Ѥ���Ҫԡ ���. �кص�Ǩ HIV , UA , Urine Amphetamine , CXR");
array_push($choose,"����Ѻ�ͧᾷ�� �ػ����");
array_push($choose,"�����һ���ѵ��ѡ��");
array_push($choose,"���Ѻ�Ѥ�չ�Ѵ�մ�ä����عѢ��� ������");
array_push($choose,"���Ѻ�Ѥ�չ�Ѵ�մ�Ҵ���ѡ ������");
array_push($choose,"���Ѻ�Ѥ�չ�Ѵ�մ����ʵѺ�ѡ�ʺ�� ������");
array_push($choose,"���������§���Ѻ��ԡ�éմ�Ѥ�չ��Դ 19 ������ 1 �ҡ�÷���任��� �й��ҡ�â�ҧ��§����ҡ�üԴ������ѧ�մ�Ѥ�չ �������Ѻ��Һ����");
array_push($choose,"���������§���Ѻ��ԡ�éմ�Ѥ�չ��Դ 19 ������ 2 �ҡ�÷���任��� �й��ҡ�â�ҧ��§����ҡ�üԴ������ѧ�մ�Ѥ�չ �������Ѻ��Һ����");

sort($choose);
$sql = "Select distinct organ From opd where hn = '".$_REQUEST["hn"]."' AND organ <> '' Order by row_id DESC limit 10";
$result = Mysql_Query($sql);
$choose2 = array();
while($arr = Mysql_fetch_assoc($result)){
	array_push($choose2,$arr["organ"]);
}

$his_hpi = array();
$sql = "SELECT DISTINCT `hpi` FROM `opd` WHERE `hn` = '".$_REQUEST["hn"]."' AND `hpi` <> '' ORDER BY `row_id` DESC LIMIT 10";
$q = mysql_query($sql) or die (mysql_error());
while ($hpi_item = mysql_fetch_assoc($q)) {
	$his_hpi[] = $hpi_item['hpi'];
}

$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$showyear="25".$nPrefix;
?>
<p class="txtsarabun"><strong>������ѡ����ѵ� OPD</strong> &nbsp;&nbsp;&nbsp;<a href='dx_ofyear.php' target="_blank">�ѡ����ѵԵ�Ǩ�آ�Ҿ���û�Шӻ�<?=$showyear;?></a> &nbsp;&nbsp;&nbsp;<a href='dx_ofyear_out.php' target="_blank">�ѡ����ѵԵ�Ǩ�آ�Ҿ�١��ҧ þ.�����</a> &nbsp;&nbsp;&nbsp;<a href='dx_ofyear_out.php' target="_blank">�ѡ����ѵԵ�Ǩ�آ�Ҿ��Шӻ� (Walk in) &amp;&amp; �ѡ�ѹ������60</a> </p>
<p class="txtsarabun"><a href="opd_chkcompany.php" target="_blank">�Ѵ��ê���˹��§ҹ</a></p>
<form id="f1" name="f1" method="post" action="">
    <strong>��͡ HN :</strong> 
  <input name="hn" type="text" class="txtsarabun" id="hn" size="10" maxlength="10" />

  <input name="Submit" type="submit" class="txtsarabun" value=" ��ŧ " />
  <BR>
 <INPUT TYPE="checkbox" NAME="unshow" value="1">&nbsp;&nbsp;����С�� ��� ������
</form>
 <p><span class="tb_font">
  <input type="button" name="button" id="button" value="��Ѻ˹����ѡ" onclick="window.location='../nindex.htm' " class="txtsarabun" />
 </span>&nbsp;&nbsp; <input type="button" name="button" id="button" value="�ʴ�������" onclick="window.open('rp_basic_opd.php') " class="txtsarabun" />&nbsp;&nbsp;<input type="button" name="button" id="button" value="��Թ���" onclick="window.open('consent4.php') " class="txtsarabun" />&nbsp;&nbsp;<input type="button" name="button" id="button" value="���º��º����͹��ѧ" onclick="window.open('compareopd1.php?hn=<?php echo $hn;?>') " class="txtsarabun" /></p>
<p>&nbsp; </p>
 
 <?php
 $onfocus = "hn";

 	if(isset($_REQUEST["hn"]) && $_REQUEST["hn"] !=""){
		$onfocus = "weight";
	
	$thidate = date("d-m-").(date("Y")+543);
	$date_app = date("d")." ".$month[date("m")]." ".(date("Y")+543);
	
	// ��Ǩ�ͺ��ùѴ **************************************************
	$sql = "Select count(hn) From appoint where hn = '".$_REQUEST["hn"]."' AND appdate = '".$date_app."' AND apptime <> '¡��ԡ��ùѴ'  limit 1";
	list($app_row) = mysql_fetch_row(mysql_query($sql));

	// ��Ǩ�ͺ���ŧ����¹ **************************************************
	$sqlOpdayRow = "Select right(thidate,8), time2, vn, toborow, note, kew, row_id,hn,ptname   From opday where thdatehn = '".$thidatehn."' limit 1";
	$opdayResult = Mysql_Query($sqlOpdayRow);
	$opday_row = mysql_num_rows($opdayResult);
	list($regis_time, $time1, $vn, $toborow, $note, $kew, $row_id,$hn,$ptname) = mysql_fetch_row($opdayResult);
	if(substr($toborow,0,4)=="EX16" || substr($toborow,0,4)=="EX26"){
		?>
		<script>
        	alert("�������ա��ŧ����¹Ẻ�آ�Ҿ\n��Ҽ����µ�Ǩ�آ�Ҿ��Шӻ� ��س���ѡ����ѵ�Ẻ�آ�Ҿ");
        </script>
		<?
	}

	
	if($app_row > 0){
		$og="��Ǩ����Ѵ";
	}
	
	
		

	if($opday_row == 0 && $app_row > 0){
		
		$query = "SELECT `idcard` , `hn` , `yot` , `name` , `surname` , `goup` , `dbirth` , `idguard` , `ptright` , `note` , `camp`   FROM opcard WHERE hn = '".$_REQUEST["hn"]."' limit 1";
	    $result = mysql_query($query) or die("Query failed");
		list($cIdcard,$cHn,$cYot,$cName,$cSurname,$cGoup,$dbirth,$cIdguard,$cPtright,$cNote,$cCamp) = mysql_fetch_row($result);
		$cAge=calcage($dbirth);
		$cPtname=$cYot.' '.$cName.'  '.$cSurname;
		$vnlab = 'EX04 �����¹Ѵ';
		$_SESSION["cHn"] = $cHn;
		
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

			$tvn=$nVn;
			$time1 = date("H:i:s");
			$thdatevn=$thidate.$nVn;
			$thidate_now1 = (date("Y")+543).date("-m-d").date(" H:i:s");
			$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age, ptright,goup,camp,note,toborow,time1,idcard,dxgroup,officer)VALUES('".$thidate_now1."','".$thidatehn."','".$cHn."','".$nVn."', '".$thdatevn."','".$cPtname."','".$cAge."','".$cPtright."','".$cGoup."','".$cCamp."','".$cNote."','".$vnlab."','".$time1."','".$cIdcard."','21','".$_SESSION["sOfficer"]."');";
			$result = mysql_query($query) or die("Query failed,cannot insert into opday line 311");
			
			$sql = "UPDATE opcard SET lastupdate='".$thidate_now."' WHERE hn='$cHn' ";
			$result = mysql_query($sql) or die("Query failed UPDATE opcard line 315");

			$regis_time = substr($thidate,10);
			$vn = $nVn;
			$toborow = $vnlab;
			$note = $cNote;
			$kew = "";
			
			////////////�Դ�Թ 50 �ҷ
			$check = "select * from depart where hn = '".$cHn."' and  detail = '(55020/55021 ��Һ�ԡ�ü����¹͡)' and date like '".(date("Y")+543).date("-m-d")."%' ";
			$resultcheck = mysql_query($check);
			$cal = mysql_num_rows($resultcheck);
			if($cal==0){
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
					/////////////////////////////////////////////////////////////
				$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$thidate_now."','".$cPtname."','".$cHn."','','OTHER','1','(55020/55021 ��Һ�ԡ�ü����¹͡)', '50.00','50.00','0.00','0.00','".$_SESSION["sOfficer"]."','0','".$nVn."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into depart ".mysql_error());
				$idno=mysql_insert_id();
			 
				$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$thidate_now."','".$cHn."','','".$cPtname."','1','SERVICE','(55020/55021 ��Һ�ԡ�ü����¹͡)','1','50.00','50.00','0.00','OTHER','OTHER','".$idno."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata ".mysql_error());

				$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '".$thidatehn."' AND vn = '".$nVn."' ";
      			$result = mysql_query($query) or die("Query failed,update opday");
			}


		////////////////////////////////���Դ�Թ 50 �ҷ

	}else if($opday_row > 0){
		
		$opdayResult = Mysql_Query($sqlOpdayRow);
		list($regis_time, $time1, $vn, $toborow, $note, $kew, $row_id,$hn,$ptname) = mysql_fetch_row($opdayResult);

		if($toborow == "�͡ VN �� LAB" && app_row > 0){
			$sql = "Update opday set toborow = 'EX04 �����¹Ѵ' where row_id = '".$row_id."' AND vn = '".$vn."' limit 1 ";
			mysql_query($sql);
			$toborow = "EX04 �����¹Ѵ";
		}


		
		$_SESSION["cHn"] = $_REQUEST["hn"];
	}else{
		echo "HN : ".$_REQUEST["hn"]." �ѧ�����ŧ����¹";
		exit();
	}

if(empty($_POST["unshow"])){
			
			$sql = "Select kew, ptname   From opday where thdatehn = '".$thidatehn."' limit 1";
			$result = Mysql_Query($sql);
			list($list1,$list2) = mysql_fetch_row($result);
			if(trim($list1) != ""){
				$sql = "Update opd_show set queue='".$list1."' , hn='".$_REQUEST["hn"]."', ptname='".$list2."' where unit = 'opd' limit  1 ";	
				$result = Mysql_Query($sql);
			}
}
	
$sql = "Select congenital_disease, weight, height, (CASE WHEN cigarette = '1' THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN cigok = '0' THEN 'Checked' ELSE '' END ), (CASE WHEN cigok = '1' THEN 'Checked' ELSE '' END )   
,`mens`,`mens_date`,`vaccine`,`parent_smoke`,`parent_smoke_amount`,`parent_drink`,`parent_drink_amount`,`smoke_amount`,`drink_amount`,`ht_amount`,`dm_amount`,`hpi`
From opd 
where hn = '".$_REQUEST["hn"]."' 
AND type <> '�ҵ�' 
Order by row_id DESC 
limit 1";

$result = Mysql_Query($sql);
list($congenital_disease, $weight, $height, $cigarette1, $alcohol1, $cigarette0, $alcohol0,$cigok0,$cigok1,$mens,$mens_date,$vaccine,$parent_smoke,$parent_smoke_amount,$parent_drink,$parent_drink_amount,$smoke_amount,$drink_amount,$ht_amount,$dm_amount,$hpi) = Mysql_fetch_row($result);
	if($congenital_disease == "")
		$congenital_disease = "����ʸ�ä��Шӵ��";


	$sql = "Select hn, concat(yot,' ' ,name, ' ', surname) as fullname, ptright,dbirth,idcard  From opcard where hn = '".$_REQUEST["hn"]."' limit 1";
	$result = Mysql_Query($sql);
	list($hn, $fullname, $ptright, $dbirth,$idcard ) = mysql_fetch_row($result);
	
	$age = calcage($dbirth);
	
	$sql = "Select drugcode, tradname From drugreact where hn = '".$_REQUEST["hn"]."' ";
	$result = mysql_query($sql) or die(Mysql_Error());
	$i=0;
	while(list($drugcode, $tradname) = mysql_fetch_row($result)){ $txt_react[$i] = "&nbsp;&nbsp;&nbsp;<b>[".$drugcode."]</b> ".$tradname.", "; $i++; }
	
	$txt_react2 = implode("",$txt_react);
	
	$txt_react2 = "�ҷ����&nbsp;:&nbsp;".$txt_react2;

 ?>
 <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><div style="margin: 5px 5px 5px 5px;"><img src="../shs.png" width="119" height="92" border="0" /></div>      <span class="style1">������ѡ����ѵԼ����¹͡</span></td>
  </tr>
</table>

<form id="f2" name="f2" method="post" action="" Onsubmit="return checkForm();">
 <table width="95%" border="4" align="center" cellpadding="2" cellspacing="0" bordercolor="#339999">
  <tr valign="top">
    <td ><table width="100%" border="0" cellpadding="2" cellspacing="2" class="data_show2">
      <tr>
        <td colspan="2"align="center" class="data_title">�����ż����� </td>
      </tr>
	  <tr>
        <td class="headsarabun"><p>HN : <strong><?php echo $hn;?></strong>, ����-ʡ�� : <strong><?php echo $fullname;?></strong>,&nbsp;ID:<strong><?php echo $idcard;?></strong>,&nbsp;VN&nbsp;:&nbsp;<B><?php echo $vn;?></B>&nbsp;, ��� : <B><?php echo $kew;?></B>, <font color="#CE0000"><B><?php echo substr($toborow,4);?></B></font></td>
		<td rowspan="4">
		<IMG SRC="../image_patient/<?php echo $idcard;?>.jpg" WIDTH="100" HEIGHT="150" BORDER="0" ALT="">		</td>
      </tr>
      <tr class="headsarabun">
      <td>���� : <strong><?php echo $age;?></strong>&nbsp;,�Է�ԡ���ѡ��: <font color="#CE0000"><strong><?php echo $ptright;?></strong></font> &nbsp;&nbsp;&nbsp;
				, �����˵� : <?php echo $note;?>		</td>
      </tr>
      <tr class="headsarabun">
        <td><font class="data_drugreact"><?php echo $txt_react2;?></font></td>
      </tr>
      <tr>
        <td>����ŧ����¹ : <strong><?php echo $regis_time;?></strong>          , ���Ҩ���OPD Card : <strong><?php echo $time1;?></strong> , ���ҫѡ����ѵ� : <strong><?php echo date("H:i:s");?></strong></td>
      </tr>
      <tr>
        <td>
        <?
        $query = "SELECT `idcard` , `hn` , `yot` , `name` , `surname` , `goup` , `dbirth` , `idguard` , `ptright` , `note` , `camp`,`typeservice`,`sex`   FROM opcard WHERE hn = '".$_REQUEST["hn"]."' limit 1";
	    $result = mysql_query($query) or die("Query failed");
		list($cIdcard,$cHn,$cYot,$cName,$cSurname,$cGoup,$dbirth,$cIdguard,$cPtright,$cNote,$cCamp,$cTypeservice,$cSex) = mysql_fetch_row($result);
		?>
        ������ : 
          <select name="goup" class="txtsarabun" id="goup" onChange="dochange('type', this.value)">
          <option  selected="selected" value="0" >-------------------------���͡-------------------------</option>
          <?
						include("connect.inc");
						$query = "SELECT * from grouptype order by row_id asc";
						$result = mysql_query($query);
						while($tbrows=mysql_fetch_assoc($result)){
						$code = substr($cGoup,0,3);
							if($tbrows['code'] == $code){
		?>
          <option value="<?=$tbrows['name'];?>" selected="selected">
          <?=$tbrows['name']?>
          </option>
          <?
								}else{
					     ?>
          <option value="<?=$tbrows['name'];?>" >
          <?=$tbrows['name']?>
          </option>
          <?
                                 }
						  }
						?>
        </select></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>��������ѹ�� : <font id="type">
        <select name="select" class="txtsarabun">
          <option value='0'>--------------------------</option>
        </select>
        </font> </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>����������Ѻ��ԡ��: 
        <?
		if($cTypeservice==""){
		?>
          <select name="typeservice" class="txtsarabun" id="typeservice">
            <option  selected="selected" value="0" >--------------------���͡--------------------</option>
            <?
						include("connect.inc");
						$codeIdguard = substr($cIdguard,0,4);
						if($codeIdguard=="MX01" || $codeIdguard=="MX03" ){
							$guardname ="����/��ͺ����";
						}
						$query = "SELECT * from typeservice where ts_name like '%$guardname%' order by ts_id asc";
						$result = mysql_query($query);
						while($tbrows=mysql_fetch_assoc($result)){
							?>
								<option value="<?=$tbrows['ts_name'];?>" selected="selected">
								<?=$tbrows['ts_name']?>
								</option>
                        <?
						  }
						?>
          </select>        
        <?
        }else{
		?>
          <select name="typeservice" class="txtsarabun" id="typeservice">
            <option  selected="selected" value="0" >--------------------���͡--------------------</option>
            <?
						include("connect.inc");
						$query = "SELECT * from typeservice order by ts_id asc";
						$result = mysql_query($query);
						while($tbrows=mysql_fetch_assoc($result)){
						$cTypeservice = substr($cTypeservice,0,4);
							if($tbrows['ts_code'] == $cTypeservice){
							?>
								<option value="<?=$tbrows['ts_name'];?>" selected="selected">
								<?=$tbrows['ts_name']?>
								</option>
							<?
								}else{
					     	?>
                                <option value="<?=$tbrows['ts_name'];?>" >
                                <?=$tbrows['ts_name']?>
                                </option>
                            <?
                                 }
						  }
						?>
          </select>
          <?
		  }
		  ?>          </td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
 <p>
   <SCRIPT LANGUAGE="JavaScript">
function checkList(){
	if(document.getElementById("goup").value=="0"){
		alert("��س����͡������");
		document.getElementById("goup").focus()
		return false;
	}else if(document.getElementById("typeservice").value=="0"){
		alert("��س����͡������������Ѻ��ԡ��");
		document.getElementById("typeservice").focus()
		return false;
/*	}else if(document.getElementById("typediag").value=="0"){
		alert("��س����͡��������õ�Ǩ");
		document.getElementById("typediag").focus()
		return false;	*/	
	}else{
		return true;
	}
}


function checkForm(){
	if(document.f2.doctor.value == "" || document.f2.doctor.value == 0){
		alert('��س����͡ ᾷ����¤�Ѻ');
		return false;
	}else if(document.f2.clinic.value == "" || document.f2.clinic.value == 0){
		alert('��س����͡ ��Թԡ���¤�Ѻ');
		return false;
	}else if(document.f2.cig1.checked == true&&document.f2.member2[0].checked == false&&document.f2.member2[1].checked == false){
		alert('��س����͡������ͧ�����ҡ��ԡ������������¤�Ѻ');
		return false;
	}else{
		return true;
	}
}

function clear_textbox(){
	var fn = document.f2;
	fn.weight.value = "";
	fn.height.value = "";
	fn.temperature.value = "";
	fn.pause.value = "";
	fn.rate.value = "";
	fn.bp1.value = "";
	fn.bp2.value = "";
//	fn.drugreact[0].checked = false;
//	fn.drugreact[1].checked = false;
	fn.cigarette[0].checked = false;
	fn.alcohol[0].checked = false;
	fn.cigarette[1].checked = false;
	fn.alcohol[1].checked = false;
	fn.cigarette[2].checked = false;
	fn.alcohol[2].checked = false;
	fn.member2[0].checked = false;
	fn.member2[1].checked = false;

}
function togglediv(divid){ 
	if(document.getElementById(divid).style.display == 'none'){ 
		document.getElementById(divid).style.display = 'block'; 
	}else{ 
		//document.getElementById(divid).style.display = 'none'; 
	} 
} 
function togglediv1(divid){ 
	if(document.getElementById(divid).style.display == 'block'){ 
		document.getElementById(divid).style.display = 'none'; 
	}else{
		//sss
	}
}

	function calbmi(a,b){
		//alert(a);
		var h=a/100;
		var bmi=b/(h*h);
		document.f2.bmi.value=bmi.toFixed(2);
	}
	 </script>
   <? 
		 $ht = $height/100;
		 $bmi=number_format($weight /($ht*$ht),2);
		 ?>
 </p>
<style>
label:hover{
	cursor: pointer;
}
</style>
<table width="95%" border="4" align="center" cellpadding="2" cellspacing="0" bordercolor="#339999">
<tr valign="top">
       <td ><table width="100%" border="0" cellpadding="2" cellspacing="2" >
         <tr>
           <td colspan="7" align="center" class="data_title">��سҡ�͡�����ūѡ����ѵ� </td>
         </tr>
         <tr>
           <td height="28" colspan="6" align="center" class="data_show"><table width="100%" border="0">
             <tr>
               <td width="10%" height="28" align="right" class="data_show">��.: </td>
               <td width="14%" align="left"><input name="weight" type="text" id="weight" size="3" value="<?php echo $weight;?>"  onblur="calbmi(document.f2.height.value,this.value)"/>
                 ��.</td>
               <td width="16%" align="right">��ǹ�٧.:</td>
               <td width="13%" align="left"><input name="height" type="text" id="height" size="3" value="<?php echo $height;?>"  onblur="calbmi(this.value,document.f2.weight.value)"/>
��.</td>
               <td width="10%" align="right">T :</td>
               <td width="37%" align="left"><input name="temperature" type="text" id="temperature" size="3" />
C&deg; </td>
             </tr>
             <tr>
               <td align="right" class="data_show"> P : </td>
               <td align="left"><input name="pause" type="text" id="pause" size="3" />
                 ����/�ҷ�</td>
               <td align="right">R :</td>
               <td align="left"><input name="rate" type="text" id="rate" value="20" size="3" />
����/�ҷ�</td>
               <td align="right">BP :</td>
               <td align="left"><input name="bp1" type="text" id="bp1" size="3" />
/
  <input name="bp2" type="text" id="bp2" size="3" />
mmHg </td>
             </tr>
             <tr>
               <td align="right" class="data_show">BMI :</td>
               <td align="left"><input name="bmi" type="text" size="3" maxlength="5" value="<?php echo $bmi; ?>"class="forntsarabun1" /></td>
               <td align="right"><?

//if(substr($toborow,5) == "��Ǩ�آ�Ҿ��Шӻ�"){	
?>
                 �ͺ���:</td>
               <td align="left"><input name="waist" type="text" id="waist" size="3" value="" />
��.
  <?php //} ?></td>
               <td align="right">Repeat BP :</td>
				<td align="left">
					<input name="bp3" type="text" id="bp3" size="3" />&nbsp;/&nbsp;<input name="bp4" type="text" id="bp4" size="3" />&nbsp;mmHg 
				</td>
             </tr>
			 <tr>
				<td align="right" class="data_show">Pain Score:</td>
				<td align="left">
					<input name="painscore" type="text" id="painscore" size="3" value="" />
				</td>
				<td align="right"></td>
				<td align="left"></td>
				<td align="right"></td>
				<td align="left"></td>
			 </tr>
           </table></td>
          </tr>

		<?php 
		preg_match('/(\d+)/',$age,$age_matchs);
		$match = preg_match('/(�ҧ|˭ԧ|�.�|�.�|ms|mis)/', $cYot, $matchs);

		$mens1 = $mens2 = $mens3 = '';
		if( $mens == 1 ){
			$mens1 = 'checked="checked"';
		}elseif ( $mens == 2 ) {
			$mens2 = 'checked="checked"';
		}elseif ( $mens == 3 ) {
			$mens3 = 'checked="checked"';
		}

		// ��Ш���͹ � 11-60��
		if( $match > 0 && $cSex == '�'){

			?>
			<tr valign="top">
				<td align="right"  class="data_show">��Ш���͹ : </td>
				<td colspan="5">
					<div>
						<label for="mens1"><input type="radio" name="mens" id="mens1" value="1" class="lmp" <?=$mens1;?> > �ѧ����ջ�Ш���͹</label>&nbsp;&nbsp;
						<label for="mens2"><input type="radio" name="mens" id="mens2" value="2" class="lmp" <?=$mens2;?> > �����Ш���͹</label>&nbsp;&nbsp;
						<label for="mens3"><input type="radio" name="mens" id="mens3" value="3" class="lmp" <?=$mens3;?> > �ѧ�ջ�Ш���͹</label> 
					</div>
					<?php 
					$def_mens_style = 'display: none;';
					if( $mens == '3' ){
						$def_mens_style = '';
					}
					?>
					<div class="lmp_date" style="<?=$def_mens_style;?> margin-bottom: 5px;">
						LMP: <input type="text" name="mens_date" id="mens_date" value="<?=$mens_date;?>"> (�ѹ����Ш���͹�Ҥ����ش����) 
						<input type="checkbox" name="the_pill" id="the_pill" value="1"><label for="the_pill">������Դ</label>
					</div>
				</td>
			</tr>
			<?php
		}

		// �� 0-14 �� 
		if ( $age_matchs['1'] >= 0 && $age_matchs['1'] <= 14 ) {
			?>
			<tr valign="top">
				<td align="right"  class="data_show">�Ѥ�չ�� : </td>
				<td colspan="5">
					<div>
						<label for="vaccine1"><input type="radio" name="vaccine" id="vaccine1" value="1"> ���ࡳ��</label>&nbsp;&nbsp;
						<label for="vaccine2"><input type="radio" name="vaccine" id="vaccine2" value="2"> �����ࡳ��</label> 
					</div>
					<div>
						<?php 
						$def_psmoke2 = 'checked="checked"';
						?>
						��黡��ͧ�ٺ������&nbsp;&nbsp;
						<label for="parent_smoke1"><input type="radio" class="ps_smoke" name="parent_smoke" id="parent_smoke1" value="1">�ٺ</label>&nbsp;&nbsp;
						<label for="parent_smoke2"><input type="radio" class="ps_smoke"  name="parent_smoke" id="parent_smoke2" value="2" <?=$def_psmoke2;?> >����ٺ</label>
						&nbsp;&nbsp;&nbsp;
						<span style="display:none;" class="ps_contain"><label for="parent_smoke_amount">�ӹǹ����ٺ<input type="text" name="parent_smoke_amount" id="parent_smoke_amount" size="3">�ǹ/�ѹ</label></span>
					</div>
					<div style="margin-bottom: 5px;">
						<?php 
						$def_pdrink2 = 'checked="checked"';
						?>
						��黡��ͧ��������&nbsp;&nbsp;
						<label for="parent_drink1"><input type="radio" class="pd_drink" name="parent_drink" id="parent_drink1" value="1">����</label>&nbsp;&nbsp;
						<label for="parent_drink2"><input type="radio" class="pd_drink" name="parent_drink" id="parent_drink2" value="2" <?=$def_pdrink2;?> >������</label>
						&nbsp;&nbsp;&nbsp;
						<span style="display:none;" class="pd_contain"><label for="parent_drink_amount">�ӹǹ������<input type="text" name="parent_drink_amount" id="parent_drink_amount" size="3">���/�ѻ����</label></span>
					</div>
				</td>
			</tr>
			<?php
		}
		?>
		 <tr>
		   <td width="116" align="right" class="data_show">���� : </td>
		   <td colspan="5" align="left" class="data_show">
				<input name="drugreact" type="radio" value="0" />����ջ���ѵԡ���� 
				<input name="drugreact" type="radio" value="1" />��
				<input name="drugreact" type="radio" value="2" />����Һ
				<font class="data_drugreact"><?php echo $txt_react2;?></font>
			</td>
	      </tr>
		  <tr>
           <td align="right" valign="top" class="data_show">������ : </td>
		   <td colspan="5">
			<INPUT TYPE="radio" NAME="cigarette" value="1" <?php echo $cigarette1;?> onClick="togglediv('kbk')" id="cig1">�ٺ&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="cigarette" value="0" <?php echo $cigarette0;?> onClick="togglediv1('kbk')">����ٺ&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="cigarette" value="2" <?php echo $cigarette2;?> onClick="togglediv1('kbk')">���ٺ&nbsp;&nbsp;&nbsp;
			<div id="kbk" style="display: none; margin-bottom: 8px;"> 
				<table id="member" class="fontthai">
					<tr>
						<td>
							<input type="radio" name="member2" value="1" id="permiss1" <?php echo $cigok1;?>/> ��ҡ��ԡ
							<input type="radio" name="member2" value="0" id="permiss2" <?php echo $cigok0;?>/> �����ҡ��ԡ
						</td>
					</tr>
					<tr>
						<td>
							<label for="smoke_amount">�ӹǹ����ٺ<input type="text" name="smoke_amount" id="smoke_amount" size="3">�ǹ/�ѹ</label>
						</td>
					</tr>
				</table>
			</div> 
			<script>
			if(document.f2.cig1.checked == true){
				togglediv('kbk');
			}
			</script>
		</td>
		</tr>
		<tr>
			<td align="right" valign="top" class="data_show">���� : </td>
			<td colspan="5">
				<input type="radio" class="da_alcohol" name="alcohol" value="1" <?php echo $alcohol1;?> >����&nbsp;&nbsp;&nbsp;
				<input type="radio" class="da_alcohol" name="alcohol" value="0" <?php echo $alcohol0;?> >������&nbsp;&nbsp;&nbsp;
				<input type="radio" class="da_alcohol" name="alcohol" value="2" <?php echo $alcohol2;?> >�´���&nbsp;&nbsp;&nbsp;
				<div style="display:none; margin-bottom: 8px;" class="da_amount">
					<label for="drink_amount">�ӹǹ������<input type="text" name="drink_amount" id="drink_amount" size="3">���/�ѻ����</label>
				</div>
			</td>
		</tr>
         <tr>
           <td align="right" class="data_show">�ä��Шӵ�� :</td>
           <td align="left" colspan="5"><span class="data_show">
             <input name="congenital_disease" type="text" id="congenital_disease" size="80"  value="<?php echo $congenital_disease;?>" class="txtsarabun"/>
             <input type="button"  onclick="document.getElementById('congenital_disease').value='����ʸ';" name="Submit3" value="����ʸ" class="txtsarabun" />
           </span></td>
         </tr>

		<tr>
			<td align="right" >�ӹǹ�շ���� HT: </td>
			<td align="left" colspan="5">
				<?php 
				$curYear = date('Y-m-d');
				$sql = "SELECT TIMESTAMPDIFF(YEAR,`dateN`,'$curYear') AS `year_diff`, 
				TIMESTAMPDIFF(
					YEAR,
					CONCAT( (SUBSTRING(`diag_date`,1,4)-543 ), SUBSTRING(`diag_date`,5,7)),
					'$curYear'
				) AS `diag_date_year`
				FROM `hypertension_clinic` 
				WHERE `hn` = '$cHn'";
				$q = mysql_query($sql) or die( mysql_error() );
				$ht_year = '';
				if( mysql_num_rows($q) > 0 ){
					$ht = mysql_fetch_assoc($q);
					$ht_year = $ht['diag_date_year'];
				}
				?>
				<input type="text" name="ht_amount" id="" size="3" value="<?=$ht_year;?>"> ��
			</td>
		</tr>

		<tr>
			<td align="right" >�ӹǹ�շ���� DM: </td>
			<td align="left" colspan="5">
				<?php 
				$sql = "SELECT TIMESTAMPDIFF(
					YEAR,
					CONCAT( ( SUBSTRING(`diagdetail`,1,4)-543 ) ,SUBSTRING(`diagdetail`,5,7) ),'$curYear'
				) AS `year_diff`
				FROM `diabetes_clinic` 
				WHERE `hn` = '$cHn'";
				$q = mysql_query($sql) or die( mysql_error() );
				$dm_year = '';
				if ( mysql_num_rows($q) > 0 ) {
					$dm_row = mysql_fetch_assoc($q);
					if($dm_row['year_diff'] > 0){
						$dm_year = (int)$dm_row['year_diff'];
					}
				}
				?>
				<input type="text" name="dm_amount" id="" size="3" value="<?=$dm_year;?>"> ��
			</td>
		</tr>

         <tr>
           <td align="right" class="data_show">�ѡɳм����� : </td>
           <td align="left" colspan="5"><span class="data_show">
             <input name="type" type="radio" value="�Թ��" checked="checked"/>
             �Թ��
             <input name="type" type="radio" value="���ö��" />
             ���ö��
             <input name="type" type="radio" value="�͹��" />
             �͹��
             <input name="type" type="radio" value="�ҵ�" onclick="clear_textbox();"/>
             �ҵ� </span></td>
         </tr>

		<tr>
			<td align="right" class="data_show">Griage Gr.</td>
			<td align="left" colspan="5">
				<input type="radio" name="grade" id="grade1" value="1"><label for="grade1">1</label>&nbsp;
				<input type="radio" name="grade" id="grade2" value="2"><label for="grade2">2</label>&nbsp;
				<input type="radio" name="grade" id="grade3" value="3"><label for="grade3">3</label>&nbsp;
				<input type="radio" name="grade" id="grade4" value="4"><label for="grade4">4</label>&nbsp;
				<input type="radio" name="grade" id="grade5" value="5" checked="checked"><label for="grade5">5</label>&nbsp;
			</td>
		</tr>

		<tr>
			<td align="right" class="data_show">����ШԵ�</td>
			<td align="left" colspan="5">
				<input type="radio" name="mind" id="mind1" value="�դ����Ե��ѧ��"><label for="mind1">�դ����Ե��ѧ��</label>&nbsp;
				<input type="radio" name="mind" id="mind2" value="����դ����Ե��ѧ��" checked="checked"><label for="mind2">����դ����Ե��ѧ��</label>&nbsp;
			</td>
		</tr>

         <tr>
           <td align="right" valign="top" class="data_show">�ҡ�ù� :</td>
           <td colspan="3" rowspan="3" align="left" valign="top"><textarea name="organ" cols="40" rows="6" class="txtsarabun" id="organ" ><?php echo $og;?></textarea>
           &nbsp;&nbsp;</td>
           <td align="left" valign="top"><select name="choose_organ" onchange="if(this.value != ''){document.getElementById('organ').value = document.getElementById('organ').value+''+this.value;}" style="position: absolute;" class="txtsarabun">
             <option value="">--- ��Ǫ��� ---</option>
             <?php
			 foreach($choose as $value){
			 	echo "<option value='".$value."'>".$value."</option>";
			 }
			 ?>
           </select></td>
         </tr>
         <tr>
           <td align="right" valign="top" class="data_show">&nbsp;</td>
           <td align="left" valign="top"><select name="select2" onchange="if(this.value !=''){document.getElementById('organ').value = document.getElementById('organ').value+' '+this.value;}" style="position: absolute;" class="txtsarabun">
             <option value="">--- �ҡ����� ---</option>
             <?php
			 foreach($choose2 as $value){
			 	echo "<option value='".$value."'>".$value."</option>";
			 }
			 ?>
           </select></td>
         </tr>
         <tr>
           <td align="right" valign="top" class="data_show">&nbsp;</td>
           <td width="796" align="left" valign="top">&nbsp;</td>
         </tr>
		<tr valign="top">
			<td align="right" valign="top" >HPI:</td>
			<td> 
			<textarea name="hpi" cols="40" rows="6" class="hpi" id="hpi" ><?=$hpi;?></textarea>

			
			</td>
			<td colspan="4">
				<?php 
				$hpiHelper = array(
					'�մ�Ѥ�չ��Դ 19 ������ 1',
					'�մ�Ѥ�չ��Դ 19 ������ 2',
					'Case HT, DM, DLP, Gout ��Ǩ����Ѵ �ѡ�ҵ�����ͧ��� þ.��������ѡ�������� �ҡ�÷���任��� ������������ʹ���㺹Ѵ����',
					'_�ѹ��͹�� þ.', 
					'_�ѻ�����͹�� þ.', 
					'�ѧ������ѡ�ҷ���', 
					'_�ѹ��͹�� þ. �� �� �纤� ���������_ �չ���١��_ �Ǵ�����µ����ҧ��� �Ǵ����� ����ջ���ѵ������ʼ���������Ѵ�˭� ����ʸ�Թ�ҧ/�����Դ仵�ҧ�����', 
					'����Ѻ�ͧᾷ��������Ѥ�_ �кص�Ǩ_', 
					'�к��ä_ �ѡ�ҷ��_ �� F/U ������ͧ ���һ���ѵԡ���ѡ��/��Ѻ�ͧᾷ���Ҿ�ᾷ��', 
					'�к��ä_ �ѡ�ҷ��_ �� F/U ������ͧ/�����Ѵ F/U ����¹/�ӧҹ�黡�� ���������һ���ѵԡ���ѡ��/��Ѻ�ͧᾷ���Ҿ�ᾷ�� �йӼ�����������ࡳ����������4 �й��������һ���ѵ��������蹷��ش�Ѵ���͡���� ����������'
				);
				?>
				<select style="width:600px;" name="" onchange="if(this.value != ''){ document.getElementById('hpi').value = document.getElementById('hpi').value+this.value;}" class="txtsarabun">
					<option value="">--- ��Ǫ��� ---</option>
					<?php
					foreach($hpiHelper as $value){
						echo "<option value='".$value."'>".$value."</option>";
					}
					?>
				</select>

				<br>
				<br>

				<select name="" onchange="if(this.value != ''){ document.getElementById('hpi').value = document.getElementById('hpi').value+' '+this.value;}" class="txtsarabun">
					<option value="">--- �ҡ����� ---</option>
					<?php
					foreach($his_hpi as $value){
						echo "<option value='".$value."'>".$value."</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="4">&nbsp;</td>
		</tr>

		<script language=Javascript>
            function Inint_AJAX() {
               try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
               try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
               try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
               alert("XMLHttpRequest not supported");
               return null;
            };
            
            function dochange(src, val) {
                 var req = Inint_AJAX();
                 req.onreadystatechange = function () { 
                      if (req.readyState==4) {
                           if (req.status==200) {
                                document.getElementById(src).innerHTML=req.responseText; //�Ѻ��ҡ�Ѻ��
                           } 
                      }
                 };
                 req.open("GET", "data_post.php?data="+src+"&val="+val+"&datar="+"room"+"&valr="+val); //���ҧ connection
                 req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
                 req.send(null); //�觤��
            }
            
            window.onLoad=dochange('doctor', -1);     
		</script>            
		 <tr>
		   <td align="right" class="data_show">ᾷ�� : </td>
		   <td colspan="2" align="left">
           <font id="doctor">
             <select class="txtsarabun">
               <option value="0">--------------------------</option>
             </select>
           </font> </td>
		   <td colspan="3" align="left"><table width="100%" border="0">
             <tr>
               <td width="18%" align="right"><span class="data_show">��Թԡ/��ͧ :</span></td>
               <td width="82%"><font id="clinic">
                 <select class="txtsarabun">
                   <option value='0'>--------------------------</option>
                 </select>
               </font></td>
             </tr>
           </table></td>
	      </tr>
		 <tr>
           <td align="right" class="data_show">��õ�Ǩ :</td>
           <td colspan="2" align="left"><select name="typediag" class="txtsarabun" id="typediag">
             <option selected="selected" value="��Ǩ�����" >��Ǩ�����</option>
             <option value="�մ�Ѥ�չ��Դ 19" <?php if($toborow=="EX52 �մ�Ѥ�չ��Դ 19"){ echo "selected='selected'";} ?>>�մ�Ѥ�չ��Դ 19</option>
             <option value="��Ǩ�آ�Ҿ�������ѭ�ա�ҧ">��Ǩ�آ�Ҿ�������ѭ�ա�ҧ</option>
             <option value="���">���</option>
             <option value="�Ǫ">�Ǫ</option>
           </select></td>    
           <td colspan="3" align="right">&nbsp;</td>
          </tr>
         <tr>
           <td align="right" class="data_show">&nbsp;</td>
           <td align="left" colspan="5">&nbsp;</td>
         </tr>

		<?php 
		$testTime = date("H:i:s");

		// ISO-8601 numeric representation of the day of the week -> 1 (for Monday) through 7 (for Sunday)
		$testDate = date('N');
		if ( $testDate >= 6 OR ( $testTime >= "16:00:00" && $testTime <= "23:59:59" ) ) {
			
			$sqlDepart50 = "select * from depart where hn = '$cHn' and detail = '(55020/55021 ��Һ�ԡ�ü����¹͡)' and date like '".(date("Y")+543).date("-m-d")."%' ";
			$resultDepart50 = mysql_query($sqlDepart50);
			$testRows = mysql_num_rows($resultDepart50);
			if( $testRows == 0 ){
				?>
				<tr>
					<td>&nbsp;</td>
					<td colspan="5" style="color: red;">
						<u>�����������Դ��Һ�ԡ�� 50.- <b><a href="service50.php" target="_blank">��ԡ�����</a></b> ���ͤԴ��Һ�ԡ��</u><br>
					</td>
				</tr>
				<?php 
			}

		}
		?>
		 
         <tr>
           <td colspan="6" align="center" class="data_show">
          
           <input name="printvn" type="submit" class="txtsarabun" id="printvn" value="�����㺵�Ǩ�ä" />
           &nbsp;<input type="button" class="txtsarabun" onclick="window.open('vnprintqueue.php?clinin='+document.getElementById('clinic').value+'&doctor='+document.getElementById('doctor').value);" value="�������" />
           &nbsp;<input name="basic_opd" type="submit" class="txtsarabun" id="basic_opd"  onclick="return checkList()" value="��ŧ&amp;ʵԡ���� OPD" />
           &nbsp;&nbsp;<input name="print_basic_opd" type="submit" class="txtsarabun" id="print_basic_opd" value="��ŧ &amp; ����ʵԡ����Ẻ PDF" />
           &nbsp;&nbsp;<a href="" target="_blank"><input name="button" type="button" class="buttonred" value=" �Ѵ��ͧ COVID 19 " /></a>

		   <input type="hidden" name="age" value="<?=$age;?>">
           
           
<?
if(isset($_POST["printvn"]) && $_POST["printvn"] != ""){
$strSQL1 = "SELECT * FROM doctor WHERE status='y' and row_id= '$_POST[doctor]'";
$result1 = mysql_query($strSQL1);
$row1 = mysql_fetch_array($result1);
$doctorname = $row1['name'];
$clinic = $_POST['clinic'];
$room = $_POST['room'];
	echo "<script>window.open('vnprint.php?clinin=$clinic&doctor=$doctorname&room=$room');</script>";
}
?>           </td>
         </tr>
       </table></td>
     </tr>
   </table>
<input name="hn" type="hidden" value="<?php echo $_REQUEST["hn"];?>" />
    <input name="ptname" type="hidden" value="<?php echo $fullname;?>" />
	<input name="vn" type="hidden" value="<?php echo $vn;?>" />
	<input name="toborow" type="hidden" value="<?php echo $toborow;?>" />
	<input name="appoint" type="hidden" value="<?php echo $app_row;?>" />
</form>
<br />
<?php } 
include("unconnect.inc");

if ($hn==='55-8821') {
	?>
	<script>
	alert('��سҵ�Ǩ�ͺ ��è����� ��л���ҳ�� 㹼�������¹�� �ҡ��ͧ�Ѻ�� �ä��Шӵ�� ��س�����ҵԴ���������Ҫ���');
	</script>
	<?php
}

?>
<script language="JavaScript" type="text/javascript">
window.onload = function(){
	document.getElementById("<?php echo $onfocus;?>").focus();
}
</script>

<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">
	var popup1;
	window.onload = function() {
		popup1 = new Epoch('popup1','popup',document.getElementById('mens_date'),false);
	};
</script>

<script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
(function( $ ) {
$(function() {
	
	$(document).on('click', '.lmp', function(){
		var test_lmp = $(this).val();
		if( test_lmp == 3 ){
			$('.lmp_date').show();
		}else{
			$('.lmp_date').hide();
		}
	});

	$(document).on('click', '.ps_smoke', function(){
		var test_lmp = $(this).val();
		if( test_lmp == 1 ){
			$('.ps_contain').show();
		}else{
			$('.ps_contain').hide();
		}
	});

	$(document).on('click', '.pd_drink', function(){
		var test_lmp = $(this).val();
		if( test_lmp == 1 ){
			$('.pd_contain').show();
		}else{
			$('.pd_contain').hide();
		}
	});

	$(document).on('click', '.da_alcohol', function(){
		var test_lmp = $(this).val();
		if( test_lmp == 1 ){
			$('.da_amount').show();
		}else{
			$('.da_amount').hide();
		}
	});
	
});
})(jQuery);
</script>

</body>

</html>