<?
session_start();
include("connect.inc");
?>
<script type="text/javascript" src="jquery/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="jquery/js/jquery.cookie.js"></script>
<link rel="stylesheet" type="text/css" href="jquery/css/smoothness/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="jquery/js/jquery-ui-1.8.7.custom.min.js"></script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
<link href="../css/font.css" rel="stylesheet" type="text/css">
<script>
function age(birthDay) {
	var nDate = new Date();
	var nYear = nDate.getFullYear(); 
	var bDate = new Date(birthDay);
	var bYear = bDate.getFullYear();
	if(birthDay!=""){
		document.getElementById('age').value = nYear - bYear +543;
	}
	else{
		document.getElementById('age').value = 0;
	}
}

</script>
<?
$sqlrun = "select prefix from runno where title='y_chekup' ";
$rowrun = mysql_query($sqlrun);
list($prefix) = mysql_fetch_array($rowrun);
$prefix="25".$prefix;
$selectmember1 = "select * from opcard where idcard = '".$_SESSION['user']."'";
$rowmem1 = mysql_query($selectmember1);
$resultmem1 = @mysql_fetch_array($rowmem1);

if(isset($_POST['save_detail'])){
	if($_POST['m1']=="����ٺ"){
		$yearcig = "";
	}elseif($_POST['m1']=="�ٺ"){
		$yearcig = $_POST['numcig3'];
	}elseif($_POST['m1']=="���ٺ ����ԡ����"){
		$yearcig = $_POST['numcig4'];
	}
	
	$food = $_POST['k1'].",".$_POST['k2'].",".$_POST['k3'].",".$_POST['k4'];
	$fname = $_POST['yot']." ".$_POST['name']." ".$_POST['surname'];
	
	if($_POST['r1']=="����������§���ͧ�鹵���ä"){
		$set1 = $_POST['ro1'];
		$set2 = $_POST['ro2'];
		$set3 = $_POST['ro3'];
		$set4 = $_POST['ro4'];
	}elseif($_POST['r1']=="���´����ä������ѧ"){
		$set1 = $_POST['ro5'];
		$set2 = $_POST['ro6'];
		$set3 = $_POST['ro7'];
		$set4 = $_POST['ro8'];
	}else{
		$set1 = "";
		$set2 = "";
		$set3 = "";
		$set4 = "";
	}
	
	if($_POST['r4']=="�ջѨ�������§�����Դ�ä (�Դ������硹���)"){
		$diag = $_POST['diag1'];
	}elseif($_POST['r4']=="���ä"){
		$diag = $_POST['diag2'];
	}else{
		$diag="";
	}
	
	if($_POST['ex11']!=""){
		$exother = $_POST['exother'];
	}else{
		$exother = "";
	}
	for($r=1;$r<12;$r++){
		$detailex .= $_POST['ex'.$r];
		if($_POST['ex'.($r+1)]!=""){
			$detailex .=",";
		}
	}
	
	$den1= $_POST['den11'].",".$_POST['den12'].",".$_POST['den13'];
	$den2= $_POST['den21'].",".$_POST['den22'];
	//$adviceden = $_POST['den31'].",".$_POST['den32'].",".$_POST['den33'].",".$_POST['den34'];
	
	$insertmember = "insert into detail_ofyear ( `cid` , `name` , `type`,`camp`, `dbirth` , `age` , `address` , `tambol` , `amphur` , `province` , `phone` , `sex` , `education` , `weight` , `height` , `bmi` , `round` , `bs`, `bs2` , `hours`, `pause` , `bp1` , `bp2` , `bp3`, `bp4`, `excercise`, `detailex`, `exother` , `food` , `cig` , `detailcig1` , `detailcig2` , `detailcig3` , `detailcig4` , `alco` , `detailalco` , `unitname` , `unitpro`, `unitdate`, `yearchk`, `dental`, `den1`, `den2`, `adviceden1`, `adviceden2`, `adviceden3`, `adviceden4`, `otherden`, `smbasic`, `smdm`, `smht`, `smstr`, `smobe`, `smchol`, `smchol2`, `cholresult`, `solution`, `solution2`, `solution3`, `summary`, `diag`, `selfresult`, `chkold`, `detailold`, `accept`) values( '".$_POST['cid']."' , '".$fname."' , '".$_POST['type']."' , '".$_POST['camp']."' , '".$_POST['birthday']."' , '".$_POST['age']."' , '".$_POST['address']."' , '".$_POST['tambol']."' , '".$_POST['amphur']."' , '".$_POST['province']."' , '".$_POST['phone']."' , '".$_POST['sex']."' , '".$_POST['education']."' , '".$_POST['weight']."' , '".$_POST['height']."' , '".$_POST['bmi']."' , '".$_POST['round']."' , '".$_POST['fbs']."', '".$_POST['fbs2']."' , '".$_POST['hours']."' , '".$_POST['pause']."', '".$_POST['bp1']."' , '".$_POST['bp2']."' , '".$_POST['bp3']."', '".$_POST['bp4']."', '".$_POST['m3']."' , '".$detailex."' , '".$exother."' , '".$food."' , '".$_POST['m1']."' , '".$_POST['numcig1']."' , '".$_POST['numcig2']."' , '".$_POST['m11']."' , '".$yearcig."' , '".$_POST['m2']."' , '".$_POST['numalco']."', '".$_POST['unit_name']."', '".$_POST['province2']."', '".$_POST['unit_date']."', '".$prefix."', '".$_POST['dental']."', '".$den1."', '".$den2."', '".$_POST['den31']."', '".$_POST['den32']."', '".$_POST['den33']."', '".$_POST['den34']."', '".$_POST['otherden']."', '".$_POST['r1']."', '".$set1."', '".$set2."', '".$set3."', '".$set4."', '".$_POST['r2']."', '".$_POST['r20']."', '".$_POST['chol']."', '".$_POST['r31']."', '".$_POST['r32']."', '".$_POST['r33']."', '".$_POST['r4']."', '".$diag."', '".$_POST['selfresult']."', '".$_POST['chkold']."', '".$_POST['detailold']."', '".$_POST['accept']."')";
	if(mysql_query($insertmember) or die(mysql_error())){

		$insertdetail = "INSERT INTO `detail_ofyear2` ( `cid` , `typerelative` , `dm` , `ht` , `mi` , `gout` , `crf` , `copd` , `stroke` , `non` , `other`,`nothave`,`pa1heart`,`pa2heart`)
VALUES ( '".$_POST['cid']."' , '1' , '".$_POST['p1']."' , '".$_POST['p2']."' , '".$_POST['p5']."' , '".$_POST['p3']."' , '".$_POST['p4']."' , '".$_POST['p7']."' , '".$_POST['p6']."' , '".$_POST['p8']."' , '".$_POST['other1']."' , '".$_POST['p10']."', '".$_POST['p11']."', '".$_POST['p12']."')";
		mysql_query($insertdetail);
		$insertdetail2 = "INSERT INTO `detail_ofyear2` ( `cid` , `typerelative` , `dm` , `ht` , `mi` , `gout` , `crf` , `copd` , `stroke` , `non` , `other` ,`nothave` ,`boyheart`,`girlheart`)
VALUES ( '".$_POST['cid']."' , '2' , '".$_POST['a1']."' , '".$_POST['a2']."' , '".$_POST['a5']."' , '".$_POST['a3']."' , '".$_POST['a4']."' , '".$_POST['a7']."' , '".$_POST['a6']."' , '".$_POST['a8']."' , '".$_POST['other2']."', '".$_POST['a10']."' , '".$_POST['a11']."' , '".$_POST['a12']."' )";
		mysql_query($insertdetail2);
		$insertdetail3 = "INSERT INTO `detail_ofyear2` ( `cid` , `typerelative` , `dm` , `ht` , `liver` , `palsy` , `heart` , `fat` , `foot` , `confined` , `otherself` )
VALUES ( '".$_POST['cid']."' , '3' , '".$_POST['b1']."' , '".$_POST['b2']."' , '".$_POST['b3']."' , '".$_POST['b4']."' , '".$_POST['b5']."' , '".$_POST['b6']."' , '".$_POST['b7']."' , '".$_POST['b8']."', '".$_POST['otherself']."' )";
		mysql_query($insertdetail3);
		$insertdetail4 = "INSERT INTO `detail_ofyear3` ( `cid` , `cid1` , `cid2` , `cid3` , `cid4` , `cid5` , `cid6` , `cid7` , `cid8` , `cid9` , `cid10` , `cid11` , `cid12` , `cid13` , `cid14` , `cid15` , `cid16` , `cid17` , `cid18` , `cid19` , `cid20` , `cid21`, `otherself2` ) VALUES ('".$_POST['cid']."' , '".$_POST['b9']."' , '".$_POST['b10']."' , '".$_POST['b11']."' , '".$_POST['b12']."' , '".$_POST['b13']."' , '".$_POST['b14']."' , '".$_POST['b15']."' , '".$_POST['b16']."', '".$_POST['b17']."', '".$_POST['b18']."', '".$_POST['b19']."', '".$_POST['b20']."', '".$_POST['b21']."', '".$_POST['b22']."', '".$_POST['b23']."', '".$_POST['b24']."', '".$_POST['b25']."', '".$_POST['b26']."', '".$_POST['b27']."', '".$_POST['b28']."', '".$_POST['b29']."', '".$_POST['otherself2']."')";
		mysql_query($insertdetail4);
?>
	<script>
		alert("�ѹ�֡���������º��������");
	</script>
<?
	}

}
elseif(isset($_POST['edit_detail'])){
	if($_POST['m1']=="����ٺ"){
		$yearcig = "";
	}elseif($_POST['m1']=="�ٺ"){
		$yearcig = $_POST['numcig3'];
	}elseif($_POST['m1']=="���ٺ ����ԡ����"){
		$yearcig = $_POST['numcig4'];
	}
	
	$food = $_POST['k1'].",".$_POST['k2'].",".$_POST['k3'].",".$_POST['k4'];
	$fname = $_POST['yot']." ".$_POST['name']." ".$_POST['surname'];
	
	if($_POST['r1']=="����������§���ͧ�鹵���ä"){
		$set1 = $_POST['ro1'];
		$set2 = $_POST['ro2'];
		$set3 = $_POST['ro3'];
		$set4 = $_POST['ro4'];
	}elseif($_POST['r1']=="���´����ä������ѧ"){
		$set1 = $_POST['ro5'];
		$set2 = $_POST['ro6'];
		$set3 = $_POST['ro7'];
		$set4 = $_POST['ro8'];
	}else{
		$set1 = "";
		$set2 = "";
		$set3 = "";
		$set4 = "";
	}
	
	if($_POST['r4']=="�ջѨ�������§�����Դ�ä (�Դ������硹���)"){
		$diag = $_POST['diag1'];
	}elseif($_POST['r4']=="���ä"){
		$diag = $_POST['diag2'];
	}else{
		$diag="";
	}
	
	if($_POST['ex11']!=""){
		$exother = $_POST['exother'];
	}else{
		$exother = "";
	}
	for($r=1;$r<12;$r++){
		$detailex .= $_POST['ex'.$r];
		if($_POST['ex'.($r+1)]!=""){
			$detailex .=",";
		}
	}
	
	$den1= $_POST['den11'].",".$_POST['den12'].",".$_POST['den13'];
	$den2= $_POST['den21'].",".$_POST['den22'];
	//$adviceden = $_POST['den31'].",".$_POST['den32'].",".$_POST['den33'].",".$_POST['den34'];
	$updatemember = "update detail_ofyear set `name`='".$fname."' , `type`='".$_POST['type']."',`camp`='".$_POST['camp']."', `dbirth`='".$_POST['birthday']."' , `age`='".$_POST['age']."' , `address` ='".$_POST['address']."', `tambol`='".$_POST['tambol']."' , `amphur`='".$_POST['amphur']."' , `province`='".$_POST['province']."' , `phone`='".$_POST['phone']."' , `sex`='".$_POST['sex']."' , `education` ='".$_POST['education']."', `weight`='".$_POST['weight']."' , `height`='".$_POST['height']."', `bmi`='".$_POST['bmi']."' , `round`='".$_POST['round']."' , `bs`='".$_POST['fbs']."', `bs2`='".$_POST['fbs2']."' , `hours`='".$_POST['hours']."', `pause`='".$_POST['pause']."', `bp1`='".$_POST['bp1']."' , `bp2` ='".$_POST['bp2']."', `bp3`='".$_POST['bp3']."', `bp4`='".$_POST['bp4']."', `excercise`='".$_POST['m3']."', `detailex`='".$detailex."', `exother`='".$exother."' , `food`='".$food."' , `cig`='".$_POST['m1']."' , `detailcig1`='".$_POST['numcig1']."' , `detailcig2`='".$_POST['numcig2']."' , `detailcig3`='".$_POST['m11']."' , `detailcig4`='".$yearcig."' , `alco`='".$_POST['m2']."' , `detailalco`='".$_POST['numalco']."' , `unitname`='".$_POST['unit_name']."' , `unitpro`='".$_POST['province2']."', `unitdate`='".$_POST['unit_date']."', `yearchk`='".$prefix."', `dental`='".$_POST['dental']."', `den1`='".$den1."', `den2`='".$den2."', `adviceden1`='".$_POST['den31']."', `adviceden2`='".$_POST['den32']."', `adviceden3`= '".$_POST['den33']."', `adviceden4`='".$_POST['den34']."', `otherden`='".$_POST['otherden']."', `smbasic`='".$_POST['r1']."', `smdm`='".$set1."', `smht`='".$set2."', `smstr`='".$set3."', `smobe`='".$set4."', `smchol`='".$_POST['r2']."', `smchol2`='".$_POST['r20']."', `cholresult`='".$_POST['chol']."', `solution`='".$_POST['r31']."', `solution2`='".$_POST['r32']."', `solution3`='".$_POST['r33']."', `summary`='".$_POST['r4']."', `diag`='".$diag."', `selfresult`='".$_POST['selfresult']."', `chkold`='".$_POST['chkold']."', `detailold`='".$_POST['detailold']."', `accept`='".$_POST['accept']."' , `unithos`='".$_POST['unithos']."' where row_id = '".$_POST['rowidupdate']."' ";

	if(mysql_query($updatemember) or die(mysql_error())){
		$updatedetail = "update detail_ofyear2 set  `dm`='".$_POST['p1']."' , `ht`='".$_POST['p2']."' , `mi`='".$_POST['p5']."' , `gout`='".$_POST['p3']."' , `crf`='".$_POST['p4']."' , `copd`='".$_POST['p7']."' , `stroke`='".$_POST['p6']."' , `non`='".$_POST['p8']."' , `other`='".$_POST['other1']."',`nothave`='".$_POST['p10']."',`pa1heart`='".$_POST['p11']."',`pa2heart`='".$_POST['p12']."' where typerelative='1' and cid ='".$_POST['cid']."' ";
		mysql_query($updatedetail);
		
		$updatedetail2 = "update detail_ofyear2 set  `dm`='".$_POST['a1']."' , `ht`='".$_POST['a2']."' , `mi`='".$_POST['a5']."' , `gout`='".$_POST['a3']."' , `crf`='".$_POST['a4']."' , `copd`='".$_POST['a7']."' , `stroke`='".$_POST['a6']."' , `non`='".$_POST['a8']."' , `other`='".$_POST['other2']."',`nothave`='".$_POST['a10']."',`boyheart`='".$_POST['a11']."',`girlheart`='".$_POST['a12']."' where typerelative='2' and cid ='".$_POST['cid']."' ";
		mysql_query($updatedetail2);
		
		$updatedetail3 = "update detail_ofyear2 set  `dm`='".$_POST['b1']."' , `ht`='".$_POST['b2']."' , `liver`='".$_POST['b3']."' , `palsy`='".$_POST['b4']."' , `heart`='".$_POST['b5']."' , `fat`='".$_POST['b6']."' , `foot`='".$_POST['b7']."' , `confined`='".$_POST['b8']."' , `otherself`='".$_POST['otherself']."' where typerelative='3' and cid ='".$_POST['cid']."' ";
		mysql_query($updatedetail3);
		
		$updatedetail4 = "update detail_ofyear3 set  `cid1`='".$_POST['b9']."' , `cid2`='".$_POST['b10']."' , `cid3`='".$_POST['b11']."' , `cid4`='".$_POST['b12']."' , `cid5`='".$_POST['b13']."' , `cid6`='".$_POST['b14']."' , `cid7`='".$_POST['b15']."' , `cid8`='".$_POST['b16']."' , `cid9`='".$_POST['b17']."', `cid10`='".$_POST['b18']."', `cid11`='".$_POST['b19']."', `cid12`='".$_POST['b20']."', `cid13`='".$_POST['b21']."', `cid14`='".$_POST['b22']."', `cid15`='".$_POST['b23']."', `cid16`='".$_POST['b24']."', `cid17`='".$_POST['b25']."', `cid18`='".$_POST['b26']."', `cid19`='".$_POST['b27']."', `cid20`='".$_POST['b28']."', `cid21`='".$_POST['b29']."', `otherself2`='".$_POST['otherself2']."' where cid ='".$_POST['cid']."' ";
		mysql_query($updatedetail4);
?>
	<script>
		alert("��䢢��������º��������");
	</script>
<?
	}

}
 
?>
<script>
function checkperson(){
	if(document.formsearch.s1.checked == false & document.formsearch.s2.checked == false & document.formsearch.s3.checked == false){
			    	alert("��س����͡������");
					return  false;
	}
	else{
		return true;
	}
}
</script>
<style>
.font45{
	font-family:AngsanaUPC;
	font-size:20px;
}
.font46{
	font-family:AngsanaUPC;
	font-size:30px;
}
</style>
<a href='../nindex.htm' ><h3>�����</h3></a>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
�Ţ�ѵû�Шӵ�ǻ�ЪҪ� : <input name="ofyearhn" type="text" maxlength="13" class="font46"><br>
<input type="submit" name="search" value="     ��ŧ     ">
</form>
<?
if(isset($_POST['ofyearhn'])){

	$selectmember1 = "select * from opcard where idcard = '".$_POST['ofyearhn']."'";
	$rowmem1 = mysql_query($selectmember1);
	$resultmem1 = mysql_fetch_array($rowmem1);
	if($resultmem1['name']!=""){
	
	}else{
		echo "��辺�������Ţ�ѵû�ЪҪ������ ��سҡ�͡���������ú��ǹ";
	}
	echo "<hr>";
}

if(isset($_POST['ofyearhn'])){	
	$sql1 = "select * from detail_ofyear where cid = '".$_POST['ofyearhn']."' ";
	$rows1 = mysql_query($sql1);
	$record = mysql_num_rows($rows1);
	$result1 = mysql_fetch_array($rows1);
/*		
	$selectdamem2 = "select * from detail_member2 where cid = '".$_SESSION['user']."'";
	$rowda2 = mysql_query($selectdamem2);
	$resultda2 = mysql_fetch_array($rowda2);
	
	$selectdamem3 = "select * from detail_member3 where cid = '".$_SESSION['user']."' and no = '5'";
	$rowda3 = mysql_query($selectdamem3);
	$resultda3 = mysql_fetch_array($rowda3);
	
	$selectdamem4 = "select * from examination where cid = '".$_SESSION['user']."'";
	$rowda4 = mysql_query($selectdamem4);
	$resultda4 = mysql_fetch_array($rowda4);*/
    $dbirth = substr($resultmem1['dbirth'],8,2)."-".substr($resultmem1['dbirth'],5,2)."-".substr($resultmem1['dbirth'],0,4);
?>
<body onLoad="age('<?=$dbirth?>')">
<form name="formsearch" action="<? $_SERVER['PHP_SELF']?>" method="post" onSubmit="return checkperson();">
<table align="center" width="100%" class="font45">
<tr>
  <td colspan="2" align="center" class="header2"><span class="fontthai2"><strong>Ẻ���Ǩ�آ�Ҿ��Шӻ�</strong></span></td></tr>
<tr>
  <td colspan="2" class="fontthai2"><input name="type" type="radio" value="����Ҫ���" id="s1" <? if($result1['type']=="����Ҫ���") echo "checked='checked'"?>>
����Ҫ���
  <input name="type" type="radio" value="�١��ҧ��Ш�"  id="s2" <? if($result1['type']=="�١��ҧ��Ш�") echo "checked='checked'"?>>
�١��ҧ��Ш�
<input name="type" type="radio" value="�١��ҧ���Ǥ���"  id="s3" <? if($result1['type']=="�١��ҧ���Ǥ���") echo "checked='checked'"?>>
�١��ҧ���Ǥ��� 
<select name="unithos">
<option value=''>---˹��§ҹ---</option>
<? 
 $depart = "select name from departments where status='Y' ";
 $rowdepart = mysql_query($depart);
 while(list($namedepart)= mysql_fetch_array($rowdepart)){
	 $txt="";
	if($result1['unithos']==$namedepart){ $txt = "selected='selected'";}
 	echo "<option value='$namedepart' $txt>$namedepart</option>";
 }
?>
</select>
</td>
</tr>
  <tr>
  <td height="30" colspan="2" class="fontthai2">�Ţ���ѵû�Шӵ�ǻ�ЪҪ� :
    <input name="cid" type="text" value="<?=$resultmem1['idcard']?>" size="12" maxlength="13" >
��
:
<input name="yot" type="text" id="yot" value="<?=$resultmem1['yot']?>" size="10">
���� :
<input name="name" type="text" value="<?=$resultmem1['name']?>" size="10">
���ʡ�� :
<input name="surname" type="text" id="surname" value="<?=$resultmem1['surname']?>" size="10"></td>
  </tr>
  <tr>
  <td width="400" height="30" class="fontthai2">�ѹ��͹���Դ :
    <input name="birthday" type="text" id="birthday" value="<?=$dbirth?>" size="10" maxlength="10">
    ���� :
    <input name="age" type="text" id="age" size="5">
��</td>
  <td width="328">&nbsp;</td>
  </tr>
  <? 
  $province = array("-- ���͡�ѧ��Ѵ --","��к��","��ا෾��ҹ��", "�ҭ������", "����Թ���","��ᾧྪ�","�͹��","�ѹ�����","���ԧ���","�ź���","��¹ҷ", "�ź���", "��¹ҷ","�����","��§���","��§����","��ѧ","��Ҵ","�ҡ","��ù�¡","��þ��","��þ��","����Ҫ����","�����ո����Ҫ", "������ä�","�������","��Ҹ����","��ҹ","���������","�֧���","�����ҹ�","��ШǺ���բѹ��","��Ҩչ����","�ѵ�ҹ�","��й�������ظ��","�����","�ѧ��", "�ѷ�ا","�ԨԵ�","��ɳ��š","ྪú���","ྪú�ó�","���","����","�����ä��","�ء�����","�����ͧ�͹","��ʸ�","����","�������","�йͧ",
"���ͧ","�Ҫ����","ž����","�ӻҧ","�Ӿٹ","���","�������","ʡŹ��","ʧ���","ʵ��","��طû�ҡ��","��ط�ʧ����","��ط��Ҥ�","������","��к���","�ԧ�����","��⢷��","�ؾ�ó����","����ɯ��ҹ�","���Թ���","˹ͧ���","˹ͧ�������","��ҧ�ͧ","�ӹҨ��ԭ","�شøҹ�","�صôԵ��","�ط�¸ҹ�","�غ��Ҫ�ҹ�");
  ?>
  <tr>
  <td height="29" colspan="2" class="fontthai2">�������Ѩ�غѹ �Ţ��� 
    <input name="address" type="text" size="5" value="<?=$resultmem1['address']?>">
    �Ӻ�
<input name="tambol" type="text" id="tambol" value="<?=$resultmem1['tambol']?>" size="8">
    �����
    <input name="amphur" type="text" id="amphur" value="<?=$resultmem1['ampur']?>" size="8">
�ѧ��Ѵ 
<input name="province" type="text" size="8" value="<?=$resultmem1['changwat']?>"></td>
  </tr>
  <tr>
    <td height="29" colspan="2" class="fontthai2">
      ���Ѿ����Ͷ�� : 
      <input name="phone" type="text" id="phone" value="<? echo $resultmem1['phone']?>" size="20"></td>
  </tr>
  <tr><td height="33" colspan="2" class="fontthai2">˹��º�ԡ�÷���Ǩ�Ѵ��ͧ ���� : 
    <input name="unit_name" type="text" size="20" value="<? if($result1['unitname']=="") echo "�ç��Һ�Ť�������ѡ��������"; else echo $result1['unitname']?>"> �ѧ��Ѵ : 
    <select name="province2" size="1">
      <? 
  			for($i=0;$i<79;$i++){
				if($result1['unitpro']=="") $result1['unitpro']="�ӻҧ";
				if($result1['unitpro']==$province[$i]) echo $ss = "selected='selected'";
				else $ss = "";
	        echo "<option value=$province[$i] ".$ss.">".$province[$i]."</option>";
			}?>
    </select>
    �ѹ����Ǩ :
    <input name="unit_date" type="text" size="10" value="<? if($result1['unitdate']==0) echo date('d/m/Y'); else echo $result1['unitdate'];?>">
  </td>
  </tr>
  <tr><td colspan="2">
  <fieldset>
  <legend><strong>�����š�õ�Ǩ�آ�Ҿ</strong></legend>
  <table width="88%" class="fontthai2">
    <tr>
    <td align="center" class="fontthai2"><strong>HN :</strong></td>
    <td align="center"  class="fontthai2"><strong>�ѹ����Ǩ :</strong></td>
    <td align="center" class="fontthai2"><strong>��Шӻ� : </strong></td>
    <td class="fontthai2"><strong>�š�õ�Ǩ :</strong></td>
    <td class="fontthai2"><strong>Diag :</strong></td>
  </tr>
  <?
  $sql21 = "select * from condxofyear_so where hn='".$resultmem1['hn']."' and status_dr='Y' ";
  $rows21 = mysql_query($sql21);
  while($result21 = mysql_fetch_array($rows21)){
  ?>
  <tr>
    <td width="12%" align="center" class="fontthai2"><a href="report_dxofyear.php?id=<?=$result21["row_id"]?>&no" target="_blank"><?=$result21['hn']?></a>&nbsp;</td>
    <td width="16%" align="center"  class="fontthai2"><?=substr($result21['thidate'],8,2)."-".substr($result21['thidate'],5,2)."-".substr($result21['thidate'],0,4);?>&nbsp;</td>
    <td width="10%" align="center" class="fontthai2"><?=$result21['yearcheck']?>&nbsp;</td>
    <td width="22%" class="fontthai2"><?=$result21['summary']?>&nbsp;</td>
    <td width="40%" class="fontthai2">&nbsp;<?=$result21['diag']?></td>
  </tr>
  <?
  }
  ?>
  </table>
  </fieldset>
  </td></tr>
  <tr>
    <td height="33" colspan="2" class="fontthai2">�š�õ�Ǩ�آ�Ҿ�ա�͹ 
      <input name="chkold" type="radio" value="������Ǩ"  id="s11" <? if($result1['chkold']=="������Ǩ") echo "checked='checked'"?>>
      ������Ǩ
      <input name="chkold" type="radio" value="����"  id="s12" <? if($result1['chkold']=="����") echo "checked='checked'"?>>
      ����
      <input name="chkold" type="radio" value="�Դ����"  id="s13" <? if($result1['chkold']=="�Դ����") echo "checked='checked'"?>>
      �Դ���� �к�
      <input name="detailold" type="text" size="30" id="detailold" value="<?=$result1['detailold']?>" ></td>
  </tr>
</table>
<table width="100%" align="center" class="font45">
  <tr>
    <td colspan="3"><strong>1. ����ѵ���ǹ���</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;�� : 
      <input name="sex" type="radio" value="���"  id="s9" <? if($resultmem1['sex']=="�") echo "checked='checked'"?>>��� 
    <input name="sex" type="radio" value="˭ԧ"  id="s10" <? if($resultmem1['sex']=="�") echo "checked='checked'"?>>˭ԧ</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;����֡�� : 
      <input name="education" type="radio" value="��ж��֡��"  id="s4" <? if($result1['education']=="��ж��֡��") echo "checked='checked'"?>>��ж��֡�� 
    <input name="education" type="radio" value="�Ѹ���֡��"  id="s5" <? if($result1['education']=="�Ѹ���֡��") echo "checked='checked'"?>>�Ѹ���֡�� 
    <input name="education" type="radio" value="͹ػ�ԭ��"  id="s6" <? if($result1['education']=="͹ػ�ԭ��") echo "checked='checked'"?>>͹ػ�ԭ�� 
    <input name="education" type="radio" value="��ԭ�ҵ��/�٧����"  id="s7" <? if($result1['education']=="��ԭ�ҵ��/�٧����") echo "checked='checked'"?>>��ԭ�ҵ��/�٧���� 
    <input name="education" type="radio" value="��������¹"  id="s8" <? if($result1['education']=="��������¹") echo "checked='checked'"?>>��������¹</td>
  </tr>
	<?
		$sqlmem1 = "select * from detail_ofyear2 where cid = '".$_POST['ofyearhn']."' and typerelative='1'";
		$rowda1 = mysql_query($sqlmem1);
		$resultda1 = mysql_fetch_array($rowda1);
	?>
  <tr>
    <td colspan="3"><strong>2. ����ѵԤ�ͺ����</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;1.1 �Դ�������ôҢͧ��ҹ�ջ���ѵԡ���纻��´���</td>
  </tr>
  <tr>
    <td width="39%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="p1" value="����ҹ (DM)" type="checkbox" id="p1" <? if($resultda1['dm']=="����ҹ (DM)") echo "checked='checked'"?>/>����ҹ (DM)</td>
    <td width="31%"><input name="p2" value="�����ѹ���Ե�٧ (HT)" type="checkbox" id="p2" <? if($resultda1['ht']=="�����ѹ���Ե�٧ (HT)") echo "checked='checked'"?>/>�����ѹ���Ե�٧ (HT)</td>
    <td width="30%"><input name="p3" value="�ä�ҷ� (Gout)" type="checkbox" id="p3" <? if($resultda1['gout']=="�ä�ҷ� (Gout)") echo "checked='checked'"?>/>�ä�ҷ� (Gout)</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="p4" value="����������ѧ (CRF)" type="checkbox" id="p4" <? if($resultda1['crf']=="����������ѧ (CRF)") echo "checked='checked'"?>/>����������ѧ (CRF)</td>
    <td><input name="p5" value="������������㨵�� (MI)" type="checkbox" id="p5" <? if($resultda1['mi']=="������������㨵�� (MI)") echo "checked='checked'"?>/>������������㨵�� (MI)</td>
    <td><input name="p6" value="������ʹ��ͧ (Stroke)" type="checkbox" id="p6" <? if($resultda1['stroke']=="������ʹ��ͧ (Stroke)") echo "checked='checked'"?>/>������ʹ��ͧ (Stroke)</td>
  </tr>
  <tr>
  	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="p7" value="�ا���觾ͧ (COPD)" type="checkbox" id="p7" <? if($resultda1['copd']=="�ا���觾ͧ (COPD)") echo "checked='checked'"?>/>�ا���觾ͧ (COPD)</td>
    <td><input name="p8" value="����Һ" type="checkbox" id="p8" <? if($resultda1['non']=="����Һ") echo "checked='checked'"?>/>����Һ </td>
    <td>
      <input name="p9" value="other1" type="checkbox" id="p9" <? if($resultda1['other']!="") echo "checked='checked'"?>/>�����к�
      <input name="other_1" type="text" size="10" value="<? if($resultda1['other']!="") echo $resultda1['other']?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="p10" value="�����" type="checkbox" id="p10" <? if($resultda1['nothave']=="�����") echo "checked='checked'"?>/>
      �����</td>
    <td><input name="p11" value="������ä���㨡�͹���� 55 ��" type="checkbox" id="p11" <? if($resultda1['pa1heart']=="������ä���㨡�͹���� 55 ��") echo "checked='checked'"?>/>
      ������ä���㨡�͹���� 55 ��</td>
    <td><input name="p12" value="������ä���㨡�͹���� 65 ��" type="checkbox" id="p12" <? if($resultda1['pa2heart']=="������ä���㨡�͹���� 65 ��") echo "checked='checked'"?>/>
      ������ä���㨡�͹���� 65 ��</td>
  </tr>
	<?
		$sqlmem2 = "select * from detail_ofyear2 where cid = '".$_POST['ofyearhn']."' and typerelative='2'";
		$rowda2 = mysql_query($sqlmem2);
		$resultda2 = mysql_fetch_array($rowda2);
	?>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;1.2 ����ͧ (��µç) �ͧ��ҹ�ջ���ѵԡ���纻��´����ä</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="a1" value="����ҹ (DM)" type="checkbox" id="a1" <? if($resultda2['dm']=="����ҹ (DM)") echo "checked='checked'"?>/>����ҹ (DM) </td>
    <td><input name="a2" value="�����ѹ���Ե�٧ (HT)" type="checkbox" id="a2" <? if($resultda2['ht']=="�����ѹ���Ե�٧ (HT)") echo "checked='checked'"?>/>�����ѹ���Ե�٧ (HT) </td>
    <td><input name="a3" value="�ä�ҷ� (Gout)" type="checkbox" id="a3" <? if($resultda2['gout']=="�ä�ҷ� (Gout)") echo "checked='checked'"?>/>�ä�ҷ� (Gout)</td>
  </tr>
  <tr>
  	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="a4" value="����������ѧ (CRF)" type="checkbox" id="a4" <? if($resultda2['crf']=="����������ѧ (CRF)") echo "checked='checked'"?>/>����������ѧ (CRF)</td>
    <td>
      <input name="a5" value="������������㨵�� (MI)" type="checkbox" id="a5" <? if($resultda2['mi']=="������������㨵�� (MI)") echo "checked='checked'"?>/>������������㨵�� (MI)</td>
    <td><input name="a6" value="������ʹ��ͧ (Stroke)" type="checkbox" id="a6" <? if($resultda2['stroke']=="������ʹ��ͧ (Stroke)") echo "checked='checked'"?>/>������ʹ��ͧ (Stroke)</td>
  </tr>
  <tr>
     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="a7" value="�ا���觾ͧ (COPD)" type="checkbox" id="a7" <? if($resultda2['copd']=="�ا���觾ͧ (COPD)") echo "checked='checked'"?>/>�ا���觾ͧ (COPD) </td>
    <td><input name="a8" value="����Һ" type="checkbox" id="a8" <? if($resultda2['non']=="����Һ") echo "checked='checked'"?>/>����Һ </td>
    <td>
      <input name="a9" value="other2" type="checkbox" id="a9" <? if($resultda2['other']!="") echo "checked='checked'"?>/>
       �����к�
      <input name="other_2" type="text" size="10" value="<? if($resultda2['other']!="") echo $resultda2['other']?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="a10" value="�����" type="checkbox" id="a10" <? if($resultda2['nothave']=="�����") echo "checked='checked'"?>/>
�����</td>
    <td><input name="a11" value="����ͧ(���) ���ä���㨡�͹���� 55 ��" type="checkbox" id="a11" <? if($resultda2['boyheart']=="����ͧ(���) ���ä���㨡�͹���� 55 ��") echo "checked='checked'"?>/>
      ����ͧ(���) ���ä���㨡�͹���� 55 ��</td>
    <td><input name="a12" value="����ͧ(˭ԧ) ���ä���㨡�͹���� 65 ��" type="checkbox" id="a12" <? if($resultda2['girlheart']=="����ͧ(˭ԧ) ���ä���㨡�͹���� 65 ��") echo "checked='checked'"?>/>
      ����ͧ(˭ԧ) ���ä���㨡�͹���� 65 ��</td>
  </tr>
	<?
		$sqlmem3 = "select * from detail_ofyear2 where cid = '".$_POST['ofyearhn']."' and typerelative='3'";
		$rowda3 = mysql_query($sqlmem3);
		$resultda3 = mysql_fetch_array($rowda3);
	?>
  <tr>
    <td colspan="3"><strong>3. ��ҹ�ջ���ѵԡ���纻��� ���͵�ͧ��ᾷ�� �����ä�����ҡ��</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- �ä����ҹ (DM)</td>
    <td colspan="2"><input name="b1" type="radio" value="����ҹ (DM)"  <? if($resultda3['dm']=="����ҹ (DM)") echo "checked='checked'";?> />��
        (<input name="b12" type="radio" value="��"  <? if($resultda3['drugdm']=="��") echo "checked='checked'";?>/>�Ѻ��зҹ�� 
        <input name="b12" type="radio" value="�����"  <? if($resultda3['drugdm']=="�����") echo "checked='checked'";?>/>����Ѻ��зҹ��)
        <input name="b1" type="radio"  value="�����" <? if($resultda3['dm']=="�����") echo "checked='checked'";?>/>�����
      <input name="b1" type="radio" value="����µ�Ǩ" <? if($resultda3['dm']=="����µ�Ǩ") echo "checked='checked'";?>/>����µ�Ǩ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- �����ѹ���Ե�٧ (HT)</td>
    <td colspan="2"><input name="b2" type="radio" value="�����ѹ���Ե�٧ (HT)"  <? if($resultda3['ht']=="�����ѹ���Ե�٧ (HT)") echo "checked='checked'";?>/>��
        (<input name="b22" type="radio" value="��"  <? if($resultda3['drught']=="��") echo "checked='checked'";?>/>�Ѻ��зҹ��
<input name="b22" type="radio" value="�����"  <? if($resultda3['drught']=="�����") echo "checked='checked'";?>/>����Ѻ��зҹ��)
<input name="b2" type="radio" value="�����"  <? if($resultda3['ht']=="�����") echo "checked='checked'";?>/>�����
      <input name="b2" type="radio" value="����µ�Ǩ"  <? if($resultda3['ht']=="����µ�Ǩ") echo "checked='checked'";?>/>����µ�Ǩ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- �ä�Ѻ</td>
    <td colspan="2"><input name="b3" type="radio" value="�Ѻ"  <? if($resultda3['liver']=="�Ѻ") echo "checked='checked'";?>/>��
        (<input name="b32" type="radio" value="��"  <? if($resultda3['drugliver']=="��") echo "checked='checked'";?>/>�Ѻ��зҹ��
<input name="b32" type="radio" value="�����"  <? if($resultda3['drugliver']=="�����") echo "checked='checked'";?>/>����Ѻ��зҹ��)
<input name="b3" type="radio" value="�����"  <? if($resultda3['liver']=="�����") echo "checked='checked'";?>/>�����
      <input name="b3" type="radio" value="����µ�Ǩ"  <? if($resultda3['liver']=="����µ�Ǩ") echo "checked='checked'";?>/>����µ�Ǩ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- �ä����ҵ</td>
    <td colspan="2"><input name="b4" type="radio" value="����ҵ"  <? if($resultda3['palsy']=="����ҵ") echo "checked='checked'";?>/>��
        (<input name="b42" type="radio" value="��"  <? if($resultda3['drugpalsy']=="��") echo "checked='checked'";?>/>�Ѻ��зҹ��
<input name="b42" type="radio" value="�����"  <? if($resultda3['drugpalsy']=="�����") echo "checked='checked'";?>/>����Ѻ��зҹ��)
<input name="b4" type="radio" value="�����"  <? if($resultda3['palsy']=="�����") echo "checked='checked'";?>/>�����
      <input name="b4" type="radio" value="����µ�Ǩ"  <? if($resultda3['palsy']=="����µ�Ǩ") echo "checked='checked'";?>/>����µ�Ǩ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- �ä����</td>
    <td colspan="2"><input name="b5" type="radio" value="����"  <? if($resultda3['heart']=="����") echo "checked='checked'";?>/>��
        (<input name="b52" type="radio" value="��"  <? if($resultda3['drugheart']=="��") echo "checked='checked'";?>/>�Ѻ��зҹ��
<input name="b52" type="radio" value="�����"  <? if($resultda3['drugheart']=="�����") echo "checked='checked'";?>/>����Ѻ��зҹ��)
<input name="b5" type="radio" value="�����"  <? if($resultda3['heart']=="�����") echo "checked='checked'";?>/>�����
      <input name="b5" type="radio" value="����µ�Ǩ"  <? if($resultda3['heart']=="����µ�Ǩ") echo "checked='checked'";?>/>����µ�Ǩ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- ��ѹ����ʹ�Դ����</td>
    <td colspan="2"><input name="b6" type="radio" value="��ѹ"  <? if($resultda3['fat']=="��ѹ") echo "checked='checked'";?>/>��
        (<input name="b62" type="radio" value="��"  <? if($resultda3['drugfat']=="��") echo "checked='checked'";?>/>�Ѻ��зҹ��
<input name="b62" type="radio" value="�����"  <? if($resultda3['drugfat']=="�����") echo "checked='checked'";?>/>����Ѻ��зҹ��)
<input name="b6" type="radio" value="�����"  <? if($resultda3['fat']=="�����") echo "checked='checked'";?>/>�����
      <input name="b6" type="radio" value="����µ�Ǩ"  <? if($resultda3['fat']=="����µ�Ǩ") echo "checked='checked'";?>/>����µ�Ǩ</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- �ŷ�����/�Ѵ��(�ҡ����ҹ)</td>
    <td colspan="2"><input name="b7" type="radio" value="�ŷ�����"  <? if($resultda3['foot']=="�ŷ�����") echo "checked='checked'";?>/>��
      <input name="b7" type="radio" value="�����"  <? if($resultda3['foot']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ��ʹ�صù��˹ѡ�Թ 4 ���š���<br>&nbsp;&nbsp;&nbsp;&nbsp;(੾�м��˭ԧ)</td>
    <td colspan="2" valign="top"><input name="b8" type="radio" value="��ʹ�ص�"  <? if($resultda3['confined']=="��ʹ�ص�") echo "checked='checked'";?>/>��
      <input name="b8" type="radio" value="�����"  <? if($resultda3['confined']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ���� �к�</td>
    <td colspan="2" valign="top"><span class="fontthai2">
      <input name="otherself" type="text" id="otherself" size="50" value="<?=$resultda3['otherself']?>">
    </span></td>
  </tr>
  	<?
		$sqlmem4 = "select * from detail_ofyear3 where cid = '".$_POST['ofyearhn']."' ";
		$rowda4 = mysql_query($sqlmem4);
		$resultda4 = mysql_fetch_array($rowda4);
	?>
  <tr>
    <td colspan="3"><strong>��ͺ�շ���ҹ�� ����㹢�й���ҹ���ҡ�üԴ���������վĵԡ������仹���������</strong></td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- ������Ӻ�������ҡ</td>
    <td colspan="2"><input name="b9" type="radio" value="��" <? if($resultda4['cid1']=="��") echo "checked='checked'";?> />��
      <input name="b9" type="radio" value="�����" checked  <? if($resultda4['cid1']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ����һ��������ѧ��ҹ͹�ҡ���� 2 ���駵�ͤ׹</td>
    <td colspan="2"><input name="b10" type="radio" value="��"  <? if($resultda4['cid2']=="��") echo "checked='checked'";?>/>��
      <input name="b10" type="radio" value="�����" checked  <? if($resultda4['cid2']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- �Թ������ŧ</td>
    <td colspan="2"><input name="b11" type="radio" value="��"  <? if($resultda4['cid3']=="��") echo "checked='checked'";?>/>��
      <input name="b11" type="radio" value="�����" checked  <? if($resultda4['cid3']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- �չ��˹ѡŴŧ�ҡ���� 5 ��.�1��͹</td>
    <td colspan="2"><input name="b12" type="radio" value="��" <? if($resultda4['cid4']=="��") echo "checked='checked'";?> />��
      <input name="b12" type="radio" value="�����" checked <? if($resultda4['cid4']=="�����") echo "checked='checked'";?> />�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ��������ջҡ�����������ҡ</td>
    <td colspan="2"><input name="b13" type="radio" value="��"  <? if($resultda4['cid5']=="��") echo "checked='checked'";?>/>��
      <input name="b13" type="radio" value="�����" checked  <? if($resultda4['cid5']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- �ѹ������˹ѧ����������׺�ѹ���</td>
    <td colspan="2"><input name="b14" type="radio" value="��"  <? if($resultda4['cid6']=="��") echo "checked='checked'";?>/>��
      <input name="b14" type="radio" value="�����" checked  <? if($resultda4['cid6']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- �Ҿ������ ��ͧ����¹��蹺���</td>
    <td colspan="2"><input name="b15" type="radio" value="��" <? if($resultda4['cid7']=="��") echo "checked='checked'";?> />��
      <input name="b15" type="radio" value="�����" checked  <? if($resultda4['cid7']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- �һ�����ͻ������������Һ���˵�</td>
    <td colspan="2"><input name="b16" type="radio" value="��"  <? if($resultda4['cid8']=="��") echo "checked='checked'";?>/>��
      <input name="b16" type="radio" value="�����" checked  <? if($resultda4['cid8']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ��������繹������ͻ������ᴧ�������</td>
    <td colspan="2"><input name="b17" type="radio" value="��"  <? if($resultda4['cid9']=="��") echo "checked='checked'";?>/>��
  <input name="b17" type="radio" value="�����" checked <? if($resultda4['cid9']=="�����") echo "checked='checked'";?> />�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- �բҺ������˹ѧ�Һ�� �������</td>
    <td colspan="2"><input name="b18" type="radio" value="��"  <? if($resultda4['cid10']=="��") echo "checked='checked'";?>/>��
  <input name="b18" type="radio" value="�����" checked  <? if($resultda4['cid10']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ��������ѧ</td>
    <td colspan="2"><input name="b19" type="radio" value="��"  <? if($resultda4['cid11']=="��") echo "checked='checked'";?>/>��
  <input name="b19" type="radio" value="�����" checked <? if($resultda4['cid11']=="�����") echo "checked='checked'";?> />�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ���ҡ���纡�ҧ˹��͡�����͡���ѧ</td>
    <td colspan="2"><input name="b20" type="radio" value="��"  <? if($resultda4['cid12']=="��") echo "checked='checked'";?>/>��
  <input name="b20" type="radio" value="�����" checked <? if($resultda4['cid12']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ��鹺ѹ�仪�� 2 ���͢���оҹ���<br>
      ��ͧ����ͺ������ش�ѡ</td>
    <td colspan="2"><input name="b21" type="radio" value="��"  <? if($resultda4['cid13']=="��") echo "checked='checked'";?>/>��
  <input name="b21" type="radio" value="�����" checked  <? if($resultda4['cid13']=="�����") echo "checked='checked'";?>/>�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ������͹�Դ�����Դ����������˹��<br>
      ���ҧ����������</td>
    <td colspan="2"><input name="b22" type="radio" value="��"  <? if($resultda4['cid14']=="��") echo "checked='checked'";?>/>��
  <input name="b22" type="radio" value="�����" checked <? if($resultda4['cid14']=="�����") echo "checked='checked'";?> />�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- �����ʹ�͡���¼Դ����</td>
    <td colspan="2"><input name="b23" type="radio" value="��"  <? if($resultda4['cid15']=="��") echo "checked='checked'";?>/>��
      <input name="b23" type="radio" value="�����" checked  <? if($resultda4['cid15']=="�����") echo "checked='checked'";?>/>�����</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- ����Դ��͡ѹ�ҹ����2�ѻ�����������</td>
    <td colspan="2"><input name="b24" type="radio" value="��"  <? if($resultda4['cid16']=="��") echo "checked='checked'";?>/>��
      <input name="b24" type="radio" value="�����" checked  <? if($resultda4['cid16']=="�����") echo "checked='checked'";?>/>�����</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- ��ͧ�����ҡ���� 3 ���駵���ѹ�Թ 2 �ѻ����</td>
    <td colspan="2"><input name="b25" type="radio" value="��"  <? if($resultda4['cid17']=="��") echo "checked='checked'";?>/>��
      <input name="b25" type="radio" value="�����" checked <? if($resultda4['cid17']=="�����") echo "checked='checked'";?> />�����</td>
    </tr>
  <tr>
    <td> &nbsp;&nbsp;- ���ҡ�õ�����ͧ ���͵������ͧ</td>
    <td colspan="2"><input name="b26" type="radio" value="��"  <? if($resultda4['cid18']=="��") echo "checked='checked'";?>/>��
      <input name="b26" type="radio" value="�����" checked  <? if($resultda4['cid18']=="�����") echo "checked='checked'";?>/>�����</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- ���ҡ��ᢹ ���͢���͹�ç</td>
    <td colspan="2"><input name="b27" type="radio" value="��" <? if($resultda4['cid19']=="��") echo "checked='checked'";?>/>��
      <input name="b27" type="radio" value="�����" checked  <? if($resultda4['cid19']=="�����") echo "checked='checked'";?>/>�����</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- �Ǵ⤹������������� ������ ������ �Թ��趹Ѵ</td>
    <td colspan="2"><input name="b28" type="radio" value="��" <? if($resultda4['cid20']=="��") echo "checked='checked'";?> />��
      <input name="b28" type="radio" value="�����" checked  <? if($resultda4['cid20']=="�����") echo "checked='checked'";?>/>�����</td>
    </tr>
  <tr>
    <td>&nbsp;&nbsp;- �����������֡����������</td>
    <td colspan="2"><input name="b29" type="radio" value="��"  <? if($resultda4['cid21']=="��") echo "checked='checked'";?>/>��
  <input name="b29" type="radio" value="�����" checked <? if($resultda4['cid21']=="�����") echo "checked='checked'";?> />�����</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;- ���ҡ�üԴ�������� �к�</td>
    <td colspan="2"><span class="fontthai2">
      <input name="otherself2" type="text" id="otherself2" size="50" value="<?=$resultda4['otherself2']?>">
    </span></td>
  </tr>
  <tr><td colspan="3">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ó����ä/�ҡ�ôѧ���ҧ��ҹ��ԺѵԵ����ҧ��</strong>
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="selfresult" type="radio" value="�Ѻ����ѡ������/��ԺѵԵ�����ᾷ���й�" <? if($result1['selfresult']=="�Ѻ����ѡ������/��ԺѵԵ�����ᾷ���й�") echo "checked='checked'";?>/>�Ѻ����ѡ������/��ԺѵԵ�����ᾷ���й�<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="selfresult" type="radio" value="�Ѻ����ѡ�� �������������" <? if($result1['selfresult']=="�Ѻ����ѡ�� �������������") echo "checked='checked'";?>/>�Ѻ����ѡ�� �������������
      <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="selfresult" type="radio" value="���ѡ�� ��й������ѡ��/���ҷҹ�ͧ" <? if($result1['selfresult']=="���ѡ�� ��й������ѡ��/���ҷҹ�ͧ") echo "checked='checked'";?>/>���ѡ�� ��й������ѡ��/���ҷҹ�ͧ</td></tr>
  <tr>
    <td colspan="3"><strong>4. ����ʾ�Դ</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>�ٺ������</strong>
      <input name="m1" type="radio" value="�ٺ" <? if($result1['cig']=="�ٺ") echo "checked='checked'";?>/> �ٺ 
      �ӹǹ 
      <input name="numcig1" type="text" id="numcig1" value="<?=$result1['detailcig1']?>" size="5"/>
      �ǹ/�ѹ �ӹǹ 
      <input name="numcig2" type="text" id="numcig2" value="<?=$result1['detailcig2']?>" size="5"/>
      Pack/year <strong>��Դ�ͧ������ </strong>
      <input name="m11" type="radio" value="�ա鹡�ͧ" <? if($result1['detailcig3']=="�ա鹡�ͧ") echo "checked='checked'";?> />
      �ա鹡�ͧ 
      <input name="m11" type="radio" value="����ա鹡�ͧ" <? if($result1['detailcig3']=="����ա鹡�ͧ") echo "checked='checked'";?>/>
      ����ա鹡�ͧ �������� 
      <input name="numcig3" type="text" id="numcig3" value="<? if($result1['cig']=="�ٺ") echo $result1['detailcig4']?>" size="5"/>
      ��<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="m1" type="radio" value="����ٺ" <? if($result1['cig']=="����ٺ") echo "checked='checked'";?>/>
����ٺ&nbsp;
<input name="m1" type="radio" value="���ٺ ����ԡ����" <? if($result1['cig']=="���ٺ ����ԡ����") echo "checked='checked'";?>/>
���ٺ����ԡ���� <strong>��Դ�ͧ������ </strong>
<input name="m11" type="radio" value="�ա鹡�ͧ2" <? if($result1['detailcig3']=="�ա鹡�ͧ2") echo "checked='checked'";?>/>
�ա鹡�ͧ
<input name="m11" type="radio" value="����ա鹡�ͧ2" <? if($result1['detailcig3']=="����ա鹡�ͧ2") echo "checked='checked'";?>/>
����ա鹡�ͧ ��������
<input name="numcig4" type="text" id="numcig4" value="<? if($result1['cig']=="���ٺ ����ԡ����") echo $result1['detailcig4']?>" size="5"/>
��</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>��������</strong>
      <input name="m2" type="radio" value="������" <? if($result1['alco']=="������") echo "checked='checked'";?>>
������
<input name="m2" type="radio" value="�´��� ����ԡ����" <? if($result1['alco']=="�´��� ����ԡ����") echo "checked='checked'";?>/>
�´�������ԡ���� 
<input name="m2" type="radio" value="����" <? if($result1['alco']=="����") echo "checked='checked'";?>/>
����
<input name="numalco" type="text" id="numalco" value="" size="5"/>
����/�ѻ����</td>
  </tr>
  <tr>
    <td colspan="3"><strong>5. ��ҹ�͡���ѧ���/��蹡���</strong></td>
  </tr> 
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="m3" type="radio" value="�͡���ѧ��·ء�ѹ ������ 30 �ҷ�" <? if($result1['excercise']=="�͡���ѧ��·ء�ѹ ������ 30 �ҷ�") echo "checked='checked'";?>/>
      �͡���ѧ���<strong>�ء�ѹ</strong> ������ 30 �ҷ�</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="m3" type="radio" value="�͡���ѧ����ѻ�������ҡ���� 3 ���� ������ 30 �ҷ� ��������" <? if($result1['excercise']=="�͡���ѧ����ѻ�������ҡ���� 3 ���� ������ 30 �ҷ� ��������") echo "checked='checked'";?>/>
      �͡���ѧ���<strong>�ѻ�������ҡ���� 3 ����</strong> ������ 30 �ҷ� ��������</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="m3" type="radio" value="�͡���ѧ����ѻ������ 3 ���� ������ 30 �ҷ� ��������" <? if($result1['excercise']=="�͡���ѧ����ѻ������ 3 ���� ������ 30 �ҷ� ��������") echo "checked='checked'";?>/>
      �͡���ѧ���<strong>�ѻ������ 3 ����</strong> ������ 30 �ҷ� ��������</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="m3" type="radio" value="�͡���ѧ��¹��¡����ѻ������ 3 ����" <? if($result1['excercise']=="�͡���ѧ��¹��¡����ѻ������ 3 ����") echo "checked='checked'";?>/>
      �͡���ѧ���<strong>���¡����ѻ������ 3 ����</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="m3" type="radio" value="����͡���ѧ������" <? if($result1['excercise']=="����͡���ѧ������") echo "checked='checked'";?>/>
      ����͡���ѧ������</td>
  </tr>
  <tr>
    <td colspan="3"><strong>�������ͧ����͡���ѧ��� ���͡���ҡ���� 1 ������</strong></td>
  </tr>
  <tr><?
  //echo strpos($result1['detailex'], "���");
  ?>
    <td colspan="3"><input name="ex1" type="checkbox" id="ex1" value="���" <? if(strpos($result1['detailex'], "���") == true) echo "checked='checked'"; ?>/>
      ��� 
      <input name="ex2" type="checkbox" id="ex2" value="�ص���" <? if(strpos($result1['detailex'], "�ص���") == true) echo "checked='checked'"; ?>/>
      �ص���
      <input name="ex3" type="checkbox" id="ex3" value="���úԡ" <? if(strpos($result1['detailex'], "���úԡ") === true) echo "checked='checked'"; ?>/>
      ���úԡ 
      <input name="ex4" type="checkbox" id="ex4" value="����" <? if(strpos($result1['detailex'], "����") == true) echo "checked='checked'"; ?>/>
      ����
      <input name="ex5" type="checkbox" id="ex5" value="�С���" <? if(strpos($result1['detailex'], "�С���") == true) echo "checked='checked'"; ?>/>
      �С���
      <input name="ex6" type="checkbox" id="ex6" value="�Թ����" <? if(strpos($result1['detailex'], "�Թ����") == true) echo "checked='checked'"; ?>/>
      �Թ����</td>
  </tr>
  <tr>
    <td colspan="3"><input name="ex7" type="checkbox" id="ex7" value="�Ե��" <? if(strpos($result1['detailex'], "�Ե��") == true) echo "checked='checked'"; ?>/>
�Ե��
  <input name="ex8" type="checkbox" id="ex8" value="�¤�" <? if(strpos($result1['detailex'], "�¤�") == true) echo "checked='checked'"; ?>/>
�¤�
<input name="ex9" type="checkbox" id="ex9" value="ẵ�Թ�ѹ" <? if(strpos($result1['detailex'], "ẵ�Թ�ѹ") == true) echo "checked='checked'"; ?>/>
ẵ�Թ�ѹ
<input name="ex10" type="checkbox" id="ex10" value="෹���" <? if(strpos($result1['detailex'], "෹���") == true) echo "checked='checked'"; ?>/>
෹���
<input name="ex11" type="checkbox" id="ex11" value="����" />
�����к�<span class="fontthai2">
<input name="exother" type="text" id="exother" size="30" value="<?=$result1['exother']?>">
</span></td>
  </tr>
  <tr>
    <td colspan="3"><strong>6. ��ҹ�ͺ�������� (�ͺ���ҡ���� 1 ���)</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<input name="k1" type="checkbox" id="k1" value="��ҹ" <? if(substr($result1['food'],0,4)=="��ҹ") echo "checked='checked'";?>/>
      ��ҹ
      <br />
      &nbsp;&nbsp;&nbsp;<input name="k2" type="checkbox" id="k2" value="���" <? if(substr($result1['food'],5,4)=="���"||substr($result1['food'],1,4)=="���") echo "checked='checked'";?>/>
      ���
      <br />
      &nbsp;&nbsp;&nbsp;<input name="k3" type="checkbox" id="k3" value="�ѹ" <? if(substr($result1['food'],11,3)=="�ѹ"||substr($result1['food'],6,3)=="�ѹ"||substr($result1['food'],2,3)=="�ѹ") echo "checked='checked'";?>/>
      �ѹ
      <br />
      &nbsp;&nbsp;&nbsp;<input name="k4" type="checkbox" id="k4" value="���ͺ�ء���" <? if(substr($result1['food'],14)=="���ͺ�ء���"||substr($result1['food'],10)=="���ͺ�ء���"||substr($result1['food'],6)=="���ͺ�ء���"||substr($result1['food'],3)=="���ͺ�ء���"||substr($result1['food'],7)=="���ͺ�ء���"||substr($result1['food'],11)=="���ͺ�ء���") echo "checked='checked'";?>/>
      ���ͺ�ء���</td>
  </tr>
  <tr>
    <td colspan="3"><strong>7. ��õ�Ǩ��ҧ���</strong></td>
  </tr>
  <script>
  function calcfunc() {
     var val1 = parseFloat(document.formsearch.weight.value);
     var val2 = parseFloat(document.formsearch.height.value);
	 val2 = val2/100;
	 var sum = val1/(val2*val2);
     document.formsearch.bmi.value=sum.toFixed(2);
}
  </script>
<?
	 $sql7 = "select * from detail_ofyear where cid='".$resultmem1['idcard']."' and yearchk='".$prefix."' ";
	$rows7 = mysql_query($sql7);
	$numrow = mysql_num_rows($rows7);
	if($numrow<=0){
		$sql6 = "select * from condxofyear_so where hn='".$resultmem1['hn']."' and yearcheck='".$prefix."' ";
		$rows6 = mysql_query($sql6);
		$rep6=mysql_fetch_array($rows6);
	}else{
		$rep6=mysql_fetch_array($rows7);
	}
	
	?>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>���˹ѡ</strong>
      <input name="weight" type="text" size="10" value="<?=$rep6['weight']?>" />
      <strong>��.</strong>
      &nbsp;&nbsp; <strong>��ǹ�٧</strong>
      <input name="height" type="text" size="10" onKeyUp="calcfunc();" value="<?=$rep6['height']?>"/>
      <strong>��.</strong> &nbsp;&nbsp;<strong>BMI</strong>
      <input name="bmi" type="text" size="10" value="<?=$rep6['bmi']?>"/>
      <strong>kg./m2</strong></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>����ͺ���</strong>
      <input name="round" type="text" id="round" value="<?=$rep6['round_']?><?=$rep6['round']?>" size="10"/>
      <strong>��.</strong> (�������Թ 90 ��. ˭ԧ����Թ 80 ��.)</td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>��õ�Ǩ�дѺ��ӵ������ʹ(FBS)</strong>
      <input name="fbs" type="text" size="5" value="<?=$rep6['bs']?>"/>
      <strong>mg% ���������ѧ�Ѻ��зҹ�����
      <input name="fbs2" type="text" id="fbs2" value="<?=$rep6['bs2']?>" size="5"/>
��.%(��ѧ�Ѻ��зҹ�����</strong>
      <input name="hours" type="text" id="hours" value="<?=$rep6['hours']?>" size="5"/>
      <strong>��.</strong><strong>)</strong></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;<strong>�վ�� 
      <input name="pause" type="text" size="5" value="<?=$rep6['pause']?>" id="pause"/> 
      ����/�ҷ�
      , �����ѹ���Ե���駷�� 1 </strong>
      <input name="bp1" type="text" size="5" value="<?=$rep6['bp1']?>"/>
/
<input name="bp2" type="text" size="5" value="<?=$rep6['bp2']?>"/>
<strong>mmHg. , �����ѹ���Ե���駷�� 2 </strong>
<input name="bp3" type="text" size="5" value="<?=$rep6['bp3']?>"/>
/
<input name="bp4" type="text" size="5" value="<?=$rep6['bp4']?>" id="bp4"/>
<strong>mmHg.</strong></td>
    </tr>
  <tr>
    <td colspan="3"><strong>8. �ѹ�ᾷ�� </strong></td>
  </tr>
  <tr>
    <td colspan="3">�آ�Ҿ��ͧ�ҡ 
      <input name="dental" type="radio" value="����" <? if($result1['dental']=="����") echo "checked='checked'"?>/>
      ����
      <input name="dental" type="radio" value="��軡��" <? if($result1['dental']=="��軡��") echo "checked='checked'"?> />
      ��軡��</td>
  </tr>
  <tr>
    <td colspan="3">�ä�ѹ 
      <input name="den11" type="checkbox" value="�ѹ��" <? if(substr($result1['den1'],0,5)=="�ѹ��") echo "checked='checked'"?>/>
      �ѹ��
      <input name="den12" type="checkbox" value="�ѹ�֡" <? if(substr($result1['den1'],1,6)=="�ѹ�֡"||substr($result1['den1'],6,6)=="�ѹ�֡") echo "checked='checked'"?>/>
      �ѹ�֡ 
      <input name="den13" type="checkbox" value="�ѹ�ش" <? if(substr($result1['den1'],2,6)=="�ѹ�ش"||substr($result1['den1'],7,6)=="�ѹ�ش"||substr($result1['den1'],8,6)=="�ѹ�ش") echo "checked='checked'"?>/>
      �ѹ�ش</td>
  </tr>
  <tr>
    <td colspan="3">�ä�˧�͡ 
      <input name="den21" type="checkbox" value="�ä�˧�͡�ѡ�ʺ" <? if(substr($result1['den2'],0,15)=="�ä�˧�͡�ѡ�ʺ") echo "checked='checked'"?>/>
      �ä�˧�͡�ѡ�ʺ 
      <input name="den22" type="checkbox" value="�ä��Էѹ���ѡ�ʺ" <? if(substr($result1['den2'],1,17)=="�ä��Էѹ���ѡ�ʺ"||substr($result1['den2'],16,17)=="�ä��Էѹ���ѡ�ʺ") echo "checked='checked'"?>/>
      �ä��Էѹ���ѡ�ʺ</td>
  </tr>
  <tr>
    <td colspan="3"><strong>���й�</strong>
      <br>
      <input name="den31" type="checkbox" value="������Ѻ��âٴ�Թ�ٹ�Ѵ�ѹ������Ҵ" id="den31" <? if($result1['adviceden1']=="������Ѻ��âٴ�Թ�ٹ�Ѵ�ѹ������Ҵ") echo "checked='checked'"?> />       ������Ѻ��âٴ�Թ�ٹ�Ѵ�ѹ������Ҵ
      <br>
      <input name="den32" type="checkbox" value="�Ѵ�Ҿ����� �ٴ�Թ�ٹ ���� 6 ��͹" id="den32"<? if($result1['adviceden2']=="�Ѵ�Ҿ����� �ٴ�Թ�ٹ ���� 6 ��͹") echo "checked='checked'"?> />
�Ѵ�Ҿ����� �ٴ�Թ�ٹ ���� 6 ��͹
<br>
<input name="den33" type="checkbox" value="�Ѵ�Ҿ����� �ش�ѹ ���� 3 ��͹" id="den33" 
<? if($result1['adviceden3']=="�Ѵ�Ҿ����� �ش�ѹ ���� 3 ��͹") echo "checked='checked'"?>/>
�Ѵ�Ҿ����� �ش�ѹ ���� 3 ��͹
<br>
<input name="den34" type="checkbox" value="�Ѵ�Ҿ����� �͹�ѹ ���� 1 ��͹" id="den34"
<? if($result1['adviceden4']=="�Ѵ�Ҿ����� �͹�ѹ ���� 1 ��͹") echo "checked='checked'"?>/>
�Ѵ�Ҿ����� �͹�ѹ ���� 1 ��͹<br>
���� <span class="fontthai2">
<input name="otherden" type="text" id="otherden" size="30" value="<?=$result1['otherden']?>">
</span></td>
  </tr>
  <tr>
    <td colspan="3"><u><strong>��Ҿ��� 
      <input name="accept" type="radio" value="�Թ���" <? if($result1['accept']=="�Թ���") echo "checked='checked'";?> />
      �Թ��� 
      <input name="accept" type="radio" value="����Թ���" <? if($result1['accept']=="����Թ���") echo "checked='checked'";?>/>
      ����Թ��� ���Ӽš�õ�Ǩ��ҧ��»�Шӻբͧ��Ҿ�������繢�����㹡���֡���Ԩ�����͡�����ҧ������آ�Ҿ���ѧ�šͧ�Ѿ��</strong></u></td>
  </tr>
  <tr>
    <td colspan="3"><u><strong>��ػ���ͧ��</strong></u></td>
  </tr>
  <tr>
    <td colspan="3"><input name="r1" type="radio" value="��辺��������§" <? if($rep6['smbasic']=="��辺��������§") echo "checked='checked'";?>/>
      ��辺��������§</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r1" type="radio" value="����������§���ͧ�鹵���ä" <? if($rep6['smbasic']=="����������§���ͧ�鹵���ä") echo "checked='checked'";?> />
      ����������§���ͧ�鹵���ä 
      <input name="ro1" type="checkbox" id="ro1" value="Y" <? if($rep6['smdm']=="Y"&&$rep6['smbasic']=="����������§���ͧ�鹵���ä") echo "checked='checked'";?>/>
      DM 
      <input name="ro2" type="checkbox" id="ro2" value="Y" <? if($rep6['smht']=="Y"&&$rep6['smbasic']=="����������§���ͧ�鹵���ä") echo "checked='checked'";?>/>
      HT 
      <input name="ro3" type="checkbox" id="ro3" value="Y" <? if($rep6['smstr']=="Y"&&$rep6['smbasic']=="����������§���ͧ�鹵���ä") echo "checked='checked'";?>/>
      Stroke 
      <input name="k8" type="checkbox" id="k8" value="Y" <? if($rep6['smobe']=="Y"&&$rep6['smbasic']=="����������§���ͧ�鹵���ä") echo "checked='checked'";?>/> 
      Obesity</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r1" type="radio" value="���´����ä������ѧ" <? if($rep6['smbasic']=="���´����ä������ѧ") echo "checked='checked'";?> />
      ���´����ä������ѧ
        <input name="ro5" type="checkbox" id="ro5" value="Y" <? if($rep6['smdm']=="Y"&&$rep6['smbasic']=="���´����ä������ѧ") echo "checked='checked'";?>/>
DM
<input name="ro6" type="checkbox" id="k10" value="Y" <? if($rep6['smht']=="Y"&&$rep6['smbasic']=="���´����ä������ѧ") echo "checked='checked'";?>/>
HT
<input name="ro7" type="checkbox" id="k11" value="Y" <? if($rep6['smstr']=="Y"&&$rep6['smbasic']=="���´����ä������ѧ") echo "checked='checked'";?>/>
Stroke
<input name="ro8" type="checkbox" id="k12" value="Y" <? if($rep6['smobe']=="Y"&&$rep6['smbasic']=="���´����ä������ѧ") echo "checked='checked'";?>/>
Obesity</td>
  </tr>
  <tr>
    <td colspan="3"><strong>9. �ó����� 35 �բ��� �ջ���ѵ�����§��Ф�� BMI&gt;25kg^2 ���Թ��õ�Ǩ Total Cholesterol</strong></td>
  </tr>
  <tr>
    <td colspan="3"><input name="r2" type="radio" value="1" <? if($rep6['chol']=="") echo "checked='checked'";?>/>
      ����Ǩ</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r2" type="radio" value="2" <? if($rep6['chol']!="") echo "checked='checked'";?> />
      ��Ǩ  <? if($rep6['chol']!=""){?> <input name="r20" type="radio" value="1" <? if($rep6['stat_chol']=="����") echo "checked='checked'";?>/>
      ���� 
      <input name="r20" type="radio" value="1" <? if($rep6['stat_chol']=="�Դ����") echo "checked='checked'";?>/>
      �Դ���� 
��ҷ���Ǩ��
<input name="chol" type="text" id="chol" value="<?=$rep6['chol']?>" size="5"/>  mg/dl <? }?>   </td>
  </tr>
  <tr>
    <td colspan="3"><u><strong>��ô��Թ�ҹ</strong></u></td>
  </tr>
  <tr>
    <td colspan="3"><input name="r31" type="checkbox" value="�����йӡ�ô��ŵ��ͧ ��е�Ǩ�Ѵ��ͧ��ӷء 1 ��" <? if($result1['solution']=="�����йӡ�ô��ŵ��ͧ ��е�Ǩ�Ѵ��ͧ��ӷء 1 ��") echo "checked='checked'";?>/>
      �����йӡ�ô��ŵ��ͧ ��е�Ǩ�Ѵ��ͧ��ӷء 1 ��</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r32" type="checkbox" value="ŧ����¹���������§��͡�����ä Metabolic ����й�����ç��û�Ѻ����¹�ĵԡ���" <? if($result1['solution2']=="ŧ����¹���������§��͡�����ä Metabolic ����й�����ç��û�Ѻ����¹�ĵԡ���") echo "checked='checked'";?>/>
      ŧ����¹���������§��͡�����ä Metabolic ����й�����ç��û�Ѻ����¹�ĵԡ���</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r33" type="checkbox" value="�觵�������ѡ��" <? if($result1['solution3']=="�觵�������ѡ��") echo "checked='checked'";?>/>
      �觵�������ѡ��</td>
  </tr>
  <tr>
    <td colspan="3"><u><strong>��ػ�š�õ�Ǩ�آ�Ҿ��Шӻ�</strong></u></td>
  </tr>
  <tr>
    <td colspan="3"><input name="r4" type="radio" value="����" <? if($rep6['summary']=="����") echo "checked='checked'";?>/>
      ����</td>
  </tr>
  <tr>
    <td colspan="3"><input name="r4" type="radio" value="�ջѨ�������§�����Դ�ä (�Դ������硹���)" <? if($rep6['summary']=="�ջѨ�������§�����Դ�ä (�Դ������硹���)") echo "checked='checked'";?>/>
      �ջѨ�������§�����Դ�ä (�Դ������硹���)
      <input name="diag1" type="text" value="<? if($rep6['summary']=="�ջѨ�������§�����Դ�ä (�Դ������硹���)") echo $rep6['diag'];?>" size="50"/></td>
  </tr>
  <tr>
    <td colspan="3"><input name="r4" type="radio" value="���ä" <? if($rep6['summary']=="���ä") echo "checked='checked'";?>/>
      ���ä
      <input name="diag2" type="text" value="<? if($rep6['summary']=="���ä") echo $rep6['diag'];?>" size="50"/></td>
  </tr>
    <tr>
    <td colspan="3"><strong>�����Դ���ᾷ��
      </strong><br>      
      <textarea name="dx" id="dx" cols="45" rows="5"><?=$rep6['dx']?></textarea>
      <input name="camp" value="<?=$resultmem1['camp']?>" type="hidden"></td>
  </tr>
  <?
	if($record>0){
  ?>
  <input name="rowidupdate" type="hidden" value="<?=$result1['row_id']?>" >
	<tr>
    	<td height="33" colspan="3" align="center"><input name="edit_detail" value=" ��䢢����� " type="submit" /></td>
  	</tr>
  <? 
   	}else{
  ?>
    <tr>
    	<td height="33" colspan="3" align="center"><input name="save_detail" value=" ��ŧ " type="submit" /></td>
  	</tr>
  <?
	}
  ?>
</table>
</form>
<?
}
?>
</body>