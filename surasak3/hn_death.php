<link href="sm3_style.css" rel="stylesheet" type="text/css" />
<body onLoad="hide()">


<script>
function hide(){
	
	var opd=document.getElementById('opd1').checked;
	var ipd=document.getElementById('opd2').checked;
	
	if(opd==true){
		document.getElementById('show1').style.display='';
		document.getElementById('show2').style.display='none';
	}else if(ipd==true){
		document.getElementById('show1').style.display='none';
		document.getElementById('show2').style.display='';
	}else{
		document.getElementById('show1').style.display='none';
		document.getElementById('show2').style.display='none';
	}
}
</script>
<fieldset class="fontsara1" style="width:50%">
  <legend>ระบุ HN </legend><form id="form1" name="form1" method="post" >
  <table border="0" align="center">
    <tr>
      <td colspan="2"><input type="radio" name="opd" id="opd1" value="opd"  onClick="hide()">
        ผู้ป่วยนอก 
        <input type="radio" name="opd" id="opd2" value="ipd" onClick="hide()">
        ผู้ป่วยใน</td>
      </tr>
    <tr id="show1">
      <td>HN:</td>
      <td><input name="cHn" type="text" class="fontsara1" id="cHn" value="<?=$_POST['cHn'];?>" /></td>
    </tr>
    <tr id="show2">
      <td>AN:</td>
      <td>
      <input name="cAn" type="text" class="fontsara1" id="cAn" value="<?=$_POST['cAn'];?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="fontsara1" id="button" value="ตกลง" /><a target=_self  href='../nindex.htm'><<ไปเมนู</a>&nbsp;&nbsp;<a target=_self  href='report_death.php'>รายงานการแจ้งตาย</a>
    </td>
    </tr>
  </table>
</form>
</fieldset>
<? 
	include("connect.inc");

if(isset($_POST['button'])){
	

	
if($_POST['opd']=='opd'){
$sql="SELECT *,concat(yot,name,' ',surname)as ptname FROM `opcard` WHERE hn='".$_POST['cHn']."' ";
}else if($_POST['opd']=='ipd'){
$sql="SELECT * FROM `ipcard` WHERE an='".$_POST['cAn']."' ";
}

$query=mysql_query($sql) or die (mysql_error());
$arr=mysql_fetch_array($query);

	$sqlid="SELECT idcard FROM `opcard` WHERE hn='$arr[hn]' ";
	$queryid=mysql_query($sqlid) or die (mysql_error());
	$arrid=mysql_fetch_array($queryid);
	
  ///// runno //////

// ปรับเรียกการใช้งานเป็นแบบปีงบประมาณ
require_once 'includes/functions.php';
$year_now = get_year_checkup();

// $year_now = substr(date("Y")+543,2);	
	
	$sqlrunno="SELECT prefix,runno FROM `runno` WHERE `title` = 'death' ";
	$queryrunno=mysql_query($sqlrunno) or die (mysql_error());
	$arrrunno=mysql_fetch_array($queryrunno);
	
if($arrrunno['prefix']!=$year_now){

$sql1= "Update runno set prefix = '$year_now', runno = 1 where  title = 'death'";
$result1 = mysql_Query($sql1);
}

?>
<form id="form2" name="form2" method="post" >
<table width="50%" border="0" >
  <tr>
    <td width="34%">HN
    : <strong>
    <?=$arr['hn'];?>
    </strong></td>
    <td width="66%">AN :
      <strong>
      <?=$arr['an'];?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="2">ชื่อ-สกุล
    : <strong>
    <?=$arr['ptname'];?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="2">ID : <strong>
      <?=$arrid['idcard'];?>
    </strong></td>
  </tr>
<!--  <tr>
    <td colspan="2">หมายเลขการแจ้งตาย : <?//=$arrrunno['runno'];?></td>
  </tr>-->
  <tr>
    <td colspan="2">
    <input type="hidden" name="ptname" value="<?=$arr['ptname'];?>">
    <input type="hidden" name="hn" value="<?=$arr['hn'];?>">
    <input type="hidden" name="an" value="<?=$arr['an'];?>">
    <input type="hidden" name="pid" value="<?=$arrid['idcard'];?>">
    <input type="hidden" name="prefix" value="<?=$arrrunno['prefix'];?>">
    <input type="hidden" name="runno" value="<?=$arrrunno['runno'];?>">
    <input type="submit" name="button2" id="button2" value="ขอเลขการแจ้งตาย" class="fontsara1">
    </td>
  </tr>
</table>
</form>

<?
 } 
if(isset($_POST['button2'])){
	
	$d_update=date('Y-m-d H:i:s');
	$death_number = $_POST['runno'];
	$sqlstr="INSERT INTO `death` (`hospcode` , `pid` , `runno` , `hn` , `an` , `d_update` )
	VALUES ('11512', '".$_POST['pid']."','".$_POST['prefix'].'/'.$_POST['runno']."', '".$_POST['hn']."', '".$_POST['an']."','".$d_update."');";
	$strquery=mysql_query($sqlstr) or die (mysql_error());
	
	$nRunno=$_POST['runno']+1;
	
	$query ="UPDATE runno SET runno = $nRunno  WHERE title='death'";
	$result = mysql_query($query) or die("Query failed runno");	
		
	if($_POST['an']!=''){
		$an="AN: <strong>$_POST[an]</strong>";	
    }
    

	// เก็บข้อมูลเข้าแฟ้ม death
	$hn = $_POST['hn'];
	$an = $_POST['an'];
	$cid = $_POST['pid'];



	$q = mysql_query("SELECT `icd10`,SUBSTRING(`doctor`,1,5) FROM `ipcard` WHERE `an` = '$an'");
	$ipcard = mysql_fetch_assoc($q);
	$cdeath = $cdeath_a = $ipcard['icd10'];
	$pre_doctor = $ipcard['doctor'];

	$vn = sprintf('%03d', $death_number);
	$seq = date('Ymd').$vn;
	$d_update = date('YmdHis');
	$ddeath = date('Ymd');

	$q = mysql_query("SELECT `doctorcode` FROM `doctor` WHERE `name` LIKE '$pre_doctor%' ");
	$dt = mysql_fetch_assoc($q);
	$dt_code = $dt['doctorcode'];
	$provider = $seq.$dt_code;

	$q = mysql_query("SELECT * FROM `death43` WHERE `PID` = '$hn' AND `DDEATH` = '$ddeath' ");
	$rows = mysql_num_rows($q);
	if( $rows > 0 ){

		// update
		$item = mysql_fetch_assoc($q);
		$id = $item['id'];

		$sql = "UPDATE `death43` SET 
		`HOSPCODE`='11512', `PID`='$hn', `HOSPDEATH`='11512', `AN`='$an', `SEQ`='$seq', `DDEATH`='$ddeath', 
		`CDEATH_A`='$cdeath_a', `CDEATH_B`=NULL, `CDEATH_C`=NULL, `CDEATH_D`=NULL, `ODISEASE`=NULL, `CDEATH`='$cdeath', 
		`PREGDEATH`=NULL, `PDEATH`=NULL, `PROVIDER`='$provider', `D_UPDATE`='$d_update', `CID`='$cid' WHERE (`id`='$id');";
		mysql_query($sql);

	}else{

		$sql = "INSERT INTO `death43` (
			`id`, `HOSPCODE`, `PID`, `HOSPDEATH`, `AN`, `SEQ`, 
			`DDEATH`, `CDEATH_A`, `CDEATH_B`, `CDEATH_C`, `CDEATH_D`, `ODISEASE`, 
			`CDEATH`, `PREGDEATH`, `PDEATH`, `PROVIDER`, `D_UPDATE`, `CID`
		) VALUES (
			NULL, '11512', '$hn', '11512', '$an', '$seq', 
			'$ddeath', '$cdeath_a', NULL, NULL, NULL, NULL, 
			'$cdeath', NULL, NULL, '$provider', '$d_update', '$cid'
		);";
		mysql_query($sql);

	}
	
	// เก็บข้อมูลเข้าแฟ้ม death

		if($strquery){
		echo "<BR><BR>";	
		echo "<div align=\"center\" class='fontsara2'><strong>$_POST[ptname]</strong>  HN: <strong>$_POST[hn]</strong> $an</div>";	
		echo "<div align=\"center\" class='fontsara2'>เลขการแจ้งตายคือ <strong>$_POST[runno]/$_POST[prefix]</strong></div>";	
		//echo "<a href='hn_death.php'></a>";
		}
	
}



?>
</body>