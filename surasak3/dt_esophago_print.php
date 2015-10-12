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
	font-size: 22px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.table_font{font-family:"MS Sans Serif"; font-size:10px;}
.colo_fil{background-color:#006633; color:#C2FEFE;}
.style1 {
	font-size: 28px;
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
}else{

$pname = $name;
$page = $_SESSION["age_now"];
$pan_hn = $_SESSION["hn_now"];
$pan_hn_value = "HN";
$p_hn = $_SESSION["hn_now"];
}


$sql = "select `row_id` From `dr_esophago` where datehn = '".$dthn."' limit 0,1";
$result = mysql_query($sql);
list($row_id) = mysql_fetch_row($result);
$count = mysql_num_rows($result);

if($count ==0){
$sql = "INSERT INTO `dr_esophago` (
`row_id` ,
`date` ,
`hn` ,
`an` ,
`datehn` ,
`ptname` ,
`age` ,
`gender` ,
`no` ,
`ward` ,
`medication` ,
`indication` ,
`pre_diagnosis` ,
`brief_history` ,
`oropha` ,
`esophagus` ,
`eg_junction` ,
`cardia` ,
`fundus` ,
`body` ,
`antrum` ,
`pylorus` ,
`bulb` ,
`2nd_portion` ,
`post_diagnosis_dx1` ,
`complication` ,
`histopathology` ,
`clo_test` ,
`therapy` ,
`recommendation` ,
`notes_comments` ,
`endoscopist` 
)
VALUES (
NULL , '".$dt2."', '".$_SESSION["hn_now"]."', '".$_POST["p_an"]."', '".$dthn."', '".$pname."', '".$page."', '".$_POST["sex"]."', '".$_POST["no"]."', '".$_POST["ward"]."', '".$_POST["medication"]."', '".$_POST["indication"]."', '".$_POST["pre-diagnosis"]."', '".$_POST["brief_history"]."', '".$_POST["oropha"]."', '".$_POST["esophagus"]."', '".$_POST["eg_junction"]."', '".$_POST["cardia"]."', '".$_POST["fundus"]."', '".$_POST["body"]."', '".$_POST["antrum"]."', '".$_POST["pylorus"]."', '".$_POST["bulb"]."', '".$_POST["2nd_portion"]."', '".$_POST["post-diagnosis"]."', '".$_POST["complication"]."', '".$_POST["histopathology"]."', '".$_POST["clo_test"]."', '".$_POST["therapy"]."', '".$_POST["recommendation"]."', '".$_POST["notes/comments"]."', '".$_POST["signature"]."'
);";
}else{
	
	$sql = "UPDATE `dr_esophago` SET `date` = '".$dt2."',
`hn` = '".$_SESSION["hn_now"]."',
`an` = '".$_POST["p_an"]."',
`datehn` = '".$dthn."',
`ptname` = '".$name."',
`age` = '".$_SESSION["age_now"]."',
`gender` = '".$_POST["sex"]."',
`no` = '".$_POST["no"]."',
`ward` = '".$_POST["ward"]."',
`medication` = '".$_POST["medication"]."',
`indication` = '".$_POST["indication"]."',
`pre_diagnosis` = '".$_POST["pre-diagnosis"]."',
`brief_history` = '".$_POST["brief_history"]."',
`oropha` = '".$_POST["oropha"]."',
`esophagus` = '".$_POST["esophagus"]."',
`eg_junction` = '".$_POST["eg_junction"]."',
`cardia` = '".$_POST["cardia"]."',
`fundus` = '".$_POST["fundus"]."',
`body` = '".$_POST["body"]."',
`antrum` = '".$_POST["antrum"]."',
`pylorus` = '".$_POST["pylorus"]."',
`bulb` = '".$_POST["bulb"]."',
`2nd_portion` = '".$_POST["2nd_portion"]."',
`post_diagnosis_dx1` = '".$_POST["post-diagnosis"]."',
`complication` = '".$_POST["complication"]."',
`histopathology` = '".$_POST["histopathology"]."',
`clo_test` = '".$_POST["clo_test"]."',
`therapy` = '".$_POST["therapy"]."',
`recommendation` = '".$_POST["recommendation"]."',
`notes_comments` = '".$_POST["notes/comments"]."',
`endoscopist` = '".$_POST["signature"]."' WHERE `dr_esophago`.`row_id` =".$row_id." LIMIT 1 ;";

}
//echo $sql;
	mysql_query($sql);
	//$_SESSION["esophago_add"] = false;





?>

<table class="table_font" width="722" border="0"  style="line-height:0.8;">
<tr>
    <td align="center" colspan="8"  class="style1"><u>EsophagoGastroDuodenoscopy Report</u></td>
  </tr>
  <tr>
     <td width="98" align="right">Name : </td>
    <td width="162"><?php echo $pname;?></td>
    <td width="70" align="right">Age : </td>
    <td width="125"><?php echo $page;?></td>
    <td width="27" align="right">&nbsp;</td>
    <td width="70" align="right">&nbsp;</td>
    <td width="43" align="right">Sex : </td>
    <td width="93"><?php echo $_POST["sex"];?></td>
  </tr>
  <tr>
    <td align="right"><?php echo $pan_hn_value;?> : </td>
    <td><?php echo $pan_hn;?></td>
    <td align="right">Data/Time : </td>
    <td><?php echo $dt;?></td>
    <td align="right">No.</td>
    <td align="left"><?php echo $_POST["no"];?></td>
    <td align="right">Ward :</td>
    <td><?php echo $_POST["ward"];?></td>
  </tr>
  <tr>
    <td align="right">Medication : </td>
    <td colspan="2"><?php echo $_POST["medication"];?></td>
	<td colspan="5" rowspan="4"><!-- <IMG SRC="sac.gif" WIDTH="100" HEIGHT="173" BORDER="0" ALT=""> --></td>
  </tr>
  <tr>
    <td align="right">Indication : </td>
    <td colspan="2"><?php echo $_POST["indication"];?></td>
  </tr>
  <tr>
    <td align="right">Pre-Diagnosis : </td>
    <td colspan="2"><?php echo $_POST["pre-diagnosis"];?></td>
  </tr>
  <tr>
    <td align="right">Brief History : </td>
    <td colspan="2"><?php echo $_POST["brief_history"];?></td>
  </tr>
</table>

<table  border="0" >
  <tr>
    <td  align="right" valign="top"><table  width="270" border="0" align="center" class="table_font"  style="line-height:0.8;">
      <tr align="right">
        <td colspan="2" align="left">Finding # </td>
      </tr>
      <tr>
        <td width="120" align="right">Oropha : </td>
        <td align="left"><?php echo $_POST["oropha"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Esophagus : </td>
        <td align="left"><?php echo $_POST["esophagus"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">EG Junction: </td>
        <td align="left"><?php echo $_POST["eg_junction"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Stomach&nbsp;&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td width="120" align="right">Cardia : </td>
        <td align="left"><?php echo $_POST["cardia"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Fundus : </td>
        <td align="left"><?php echo $_POST["fundus"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Body : </td>
        <td align="left"><?php echo $_POST["body"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Antrum : </td>
        <td align="left"><?php echo $_POST["antrum"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Pylorus : </td>
        <td align="left"><?php echo $_POST["pylorus"];?></td>
      </tr>
    </table></td>
    <td  valign="top">
	<table width="270" class="table_font"  style="line-height:0.8;">
      <tr>
        <td width="145" align="right">Duodenum&nbsp;&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td width="145" align="right">Bulb : </td>
        <td ><?php echo $_POST["bulb"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">2nd Portion  : </td>
        <td ><?php echo $_POST["2nd_portion"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">Post-Diagnosis(DX1) : </td>
        <td ><?php echo $_POST["post-diagnosis"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">Complication : </td>
        <td ><?php echo $_POST["complication"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">Histopathology : </td>
        <td ><?php echo $_POST["histopathology"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">Clo-test : </td>
        <td ><?php echo $_POST["clo_test"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">therapy : </td>
        <td ><?php echo $_POST["therapy"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">recommendation : </td>
        <td ><?php echo $_POST["recommendation"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">Notes/Comments : </td>
        <td ><?php echo $_POST["notes/comments"];?></td>
      </tr>
    </table></td>
	<td  valign="top">
	<IMG SRC="sac.gif" WIDTH="100" HEIGHT="173" BORDER="0" ALT="">
	</td>
  </tr>
</table>
<table width="681" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>Endoscopist : <?php echo $_POST["signature"]?></td>
  </tr>
  <tr>
    <td>ห้องตรวจทางเดินอาหารและลำไส้ รพ.ค่ายสุรศักดิ์มนตรี</td>
  </tr>
</table>
</body>
</html>
<?php include("unconnect.inc");?>