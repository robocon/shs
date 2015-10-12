<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style>
	<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.table_font{font-family:"MS Sans Serif"; font-size:12px;}
.colo_fil{background-color:#006633; color:#C2FEFE;}
.style1 {
	font-size: 30px;
	font-weight: bold;
	font-weight:lighter;
}
-->
</style>
<SCRIPT LANGUAGE="JavaScript">

	window.onload = function(){
		window.print();
		window.close();
	}

</SCRIPT>
</head>

<body>
<?php
include("connect.inc");

$name = $_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"];
$datetime = date("Y-m-d-H-i-s");
$xx = explode("-",$datetime);

$dt = $xx[2]."/".$xx[1]."/".($xx[0]+543)." ".$xx[3].":".$xx[4];

$dt2 = $xx[0]."-".$xx[1]."-".$xx[2]." ".$xx[3].":".$xx[4].":".$xx[5];

$dthn = substr($dt2,0,-9).$_SESSION["hn_now"];

if(!empty($_POST["p_an"]) && $_POST["p_an"] != ""){

$pname = $_POST["p_name"];
$page = $_POST["p_age"];
$pan_hn = $_POST["p_an"];
$pan_hn_value = "AN";
$p_hn = $_POST["p_hn"];
$p_ptright=$_POST["p_ptright"];

//echo "post an";

}else{

$pname = $name;
$page = $_SESSION["age_now"];
$pan_hn = $_SESSION["hn_now"];
$pan_hn_value = "HN";
$p_hn = $_SESSION["hn_now"];
$p_ptright=$_SESSION["ptright_now"];


//echo "DR";
}

$sql = "select `row_id` From `dr_colonoscopy` where datehn = '".$dthn."' limit 0,1";
$result = mysql_query($sql);
list($row_id) = mysql_fetch_row($result);
$count = mysql_num_rows($result);

if($count ==0){
	
	$sql="INSERT INTO  `dr_colonoscopy` (`thidate` ,  `hn` ,  `an` ,  `ptname` ,  `age` ,  `ptright` ,  `datehn`,  `gender`,  `ward` ,  `financial` ,  `endo1` ,  `endo2` ,  `consul` ,  `anesthesist` ,  `instrument` ,  `anesthesiaa` ,  `medication` ,  `indication` ,  `pre_diagnosis` ,  `brief` ,  `consent` ,  `anal` ,  `rectun` ,  `sigmoid` , `desending` ,  `splenic` ,  `transverse` ,  `hepatic` ,  `ascending` ,  `cecum` ,  `terminal` ,  `bowel` ,  `post_diag` ,  `complication` ,  `histopatho` ,  `therapy` ,  `recommen` ,  `note`, `signature`  ) 
VALUES ('".$dt2."',  '".$pan_hn."',  '".$_POST["p_an"]."',  '".$pname."',  '".$page."',  '".$p_ptright."',  '".$dthn."',  '".$_POST["sex"]."',  '".$_POST["ward"]."',  '".$_POST['financial']."',  '".$_POST['endoscopist-1']."',  '".$_POST['endoscopist-2']."',  '".$_POST['consultant']."',  '".$_POST['anesthesist']."',  '".$_POST['instrument']."',  '".$_POST['anesthesia']."',  '".$_POST['medication']."',  '".$_POST['indication']."',  '".$_POST['pre-diagnosis']."',  '".$_POST['brief_history']."', '".$_POST['consent']."',  '".$_POST['anal_canal']."', '".$_POST['rectun']."',  '".$_POST['sigmoid_colon']."',  '".$_POST['descending_colon']."',  '".$_POST['splenic_flexure']."',  '".$_POST['transverse_colon']."',  '".$_POST['hepatic_flexure']."',  '".$_POST['ascending_colon']."', '".$_POST['cecum']."',  '".$_POST['terminal_ileum']."',  '".$_POST['bowel_preparation']."',  '".$_POST['post-diagnosis']."',  '".$_POST['complication']."',  '".$_POST['histopathology']."',  '".$_POST['therapy']."', '".$_POST['recommendation']."',  '".$_POST['notes/comments']."','".$_POST["signature"]."')";
}else{
	
$sql="UPDATE  `dr_colonoscopy` SET  `thidate` =  '".$dt2."',
`hn` =  '".$p_hn."',
`an` =  '".$_POST["p_an"]."',
`ptname` =  '".$pname."',
`age` =  '".$page."',
`ptright` =  '".$p_ptright."',
`datehn` =  '".$dthn."',
`gender` =  '".$_POST["sex"]."',
`ward` =  '".$_POST["ward"]."',
`financial` =  '".$_POST['financial']."',
`endo1` =  '".$_POST['endoscopist-1']."',
`endo2` =  '".$_POST['endoscopist-2']."',
`consul` =  '".$_POST['consultant']."',
`anesthesist` =  '".$_POST['anesthesist']."',
`instrument` =  '".$_POST['instrument']."',
`anesthesiaa` =  '".$_POST['anesthesia']."',
`medication` =  '".$_POST['medication']."',
`indication` =  '".$_POST['indication']."',
`pre_diagnosis` =  '".$_POST['pre-diagnosis']."',
`brief` =  '".$_POST['brief_history']."',
`consent` =  '".$_POST['consent']."',
`anal` =  '".$_POST['anal_canal']."',
`rectun` =  '".$_POST['rectun']."',
`sigmoid` = '".$_POST['sigmoid_colon']."',
`desending` = '".$_POST['descending_colon']."',
`splenic` =  '".$_POST['splenic_flexure']."',
`transverse` =  '".$_POST['transverse_colon']."',
`hepatic` =  '".$_POST['hepatic_flexure']."',
`ascending` =  '".$_POST['ascending_colon']."',
`cecum` = '".$_POST['cecum']."',
`terminal` =  '".$_POST['terminal_ileum']."',
`bowel` =  '".$_POST['bowel_preparation']."',
`post_diag` =  '".$_POST['post-diagnosis']."',
`complication` =  '".$_POST['complication']."',
`histopatho` =  '".$_POST['histopathology']."',
`therapy` =  '".$_POST['therapy']."',
`recommen` =  '".$_POST['recommendation']."',
`note` =  '".$_POST['notes/comments']."',
`signature` =  '".$_POST['signature']."'
 WHERE  `row_id` =  '".$row_id."' ";	
}
mysql_query($sql);


?><br />
<br />
<center>
  <span class="style1"><u>Colonoscopy Report</u></span>
</center>
<table class="table_font" width="681" border="0" align="center" style="line-height:0.8;">
  <tr>
    <td align="right">Name : </td>
    <td width="156"><?php echo $pname;?></td>
    <td width="70" align="right">Age : </td>
    <td width="125"><?php echo $page;?></td>
    <td width="48" align="right">Sex : </td>
    <td width="108"><?php echo $_POST["sex"];?></td>
  </tr>
  <tr>
    <td align="right">HN : </td>
    <td><?php echo $pan_hn;?></td>
    <td align="right">Data/Time : </td>
    <td><?php echo date("d/m/").(date("Y")+543).date(" H:i");?></td>
    <td align="right">Ward : </td>
    <td><?php echo $_POST["ward"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Financial : </td>
    <td colspan="5"><?php echo $_POST["financial"];?></td>
  </tr>
  <tr>
    <td align="right">Endoscopist- 1 : </td>
    <td colspan="5"><?php echo $_POST["endoscopist-1"];?></td>
  </tr>
  <tr>
    <td align="right">Endoscopist- 2 : </td>
    <td colspan="5"><?php echo $_POST["endoscopist-2"];?></td>
  </tr>
  <tr>
    <td align="right">Consultant : </td>
    <td colspan="5"><?php echo $_POST["consultant"];?></td>
  </tr>
  <tr>
    <td align="right">Anesthesist : </td>
    <td colspan="5"><?php echo $_POST["anesthesist"];?></td>
  </tr>
  <tr>
    <td align="right">Instrument : </td>
    <td colspan="5"><?php echo $_POST["instrument"];?></td>
  </tr>
  <tr>
    <td align="right">Anesthesia : </td>
    <td colspan="5"><?php echo $_POST["anesthesia"];?></td>
  </tr>
  <tr>
    <td align="right">Medication : </td>
    <td colspan="5"><?php echo $_POST["medication"];?></td>
  </tr>
  <tr>
    <td align="right">Indication : </td>
    <td colspan="5"><?php echo $_POST["indication"];?></td>
  </tr>
  <tr>
    <td align="right">Pre-Diagnosis : </td>
    <td colspan="5"><?php echo $_POST["pre-diagnosis"];?></td>
  </tr>
  <tr>
    <td align="right">Brief History : </td>
    <td colspan="5"><?php echo $_POST["brief_history"];?></td>
  </tr>
  <tr>
    <td align="right">Consent : </td>
    <td colspan="5"><?php echo $_POST["consent"];?></td>
  </tr>
</table>
<br />
<table width="681" border="0" align="center" class="table_font"  style="line-height:0.8;">
  <tr align="right">
    <td colspan="2" align="left">Finding # </td>
  </tr>
  <tr>
    <td width="148" align="right">Anal Canal : </td>
    <td width="523"><?php echo $_POST["anal_canal"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Rectun : </td>
    <td><?php echo $_POST["rectun"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Sigmoid colon : </td>
    <td><?php echo $_POST["sigmoid_colon"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Descending colon : </td>
    <td><?php echo $_POST["descending_colon"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Splenic flexure : </td>
    <td><?php echo $_POST["splenic_flexure"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Transverse colon : </td>
    <td><?php echo $_POST["transverse_colon"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Hepatic flexure : </td>
    <td><?php echo $_POST["hepatic_flexure"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Ascending colon : </td>
    <td><?php echo $_POST["ascending_colon"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Cecum : </td>
    <td><?php echo $_POST["cecum"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Terminal ileum : </td>
    <td><?php echo $_POST["terminal_ileum"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Bowel preparation : </td>
    <td><?php echo $_POST["bowel_preparation"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Post-Diagnosis(DX1) : </td>
    <td><?php echo $_POST["post-diagnosis"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Complication : </td>
    <td><?php echo $_POST["complication"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Histopathology : </td>
    <td><?php echo $_POST["histopathology"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">therapy : </td>
    <td><?php echo $_POST["therapy"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">recommendation : </td>
    <td><?php echo $_POST["recommendation"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Notes/Comments : </td>
    <td><?php echo $_POST["notes/comments"];?></td>
  </tr>
</table>
<br />

<table width="681" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>SIGNATURE : <?php echo $_POST["signature"]?></td>
  </tr>
  <tr>
    <td>ห้องตรวจทางเดินอาหารและลำไส้ รพ.ค่ายสุรศักดิ์มนตรี</td>
  </tr>
</table>
</body>
</html>
<?php include("unconnect.inc");?>