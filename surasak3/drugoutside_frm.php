<? session_start(); 

if(isset($_GET["action"]) && $_GET["action"] == "slcode"){
	include("connect.inc");
	
	$sql = "Select slcode,detail1,detail2,detail3 from  drugslip  where  slcode like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:700px; height:430px; overflow:auto; \">";

		echo "<table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\">
		<tr align=\"center\" bgcolor=\"#333333\">
		<td><strong>&nbsp;</strong></td>
		<td><font style=\"color: #FFFFFF;\"><strong>����</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>�Ը���</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>�Ը���</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>�Ը���</strong></font></td>
		<td><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">�Դ</font></A></strong></td>
		</tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr>
		<td valign=\"top\"></td>
		<td align=\"left\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value='",trim($se["slcode"]),"';document.getElementById('list').innerHTML ='';\">",$se["slcode"],"</A></td>
		<td>".$se['detail1']."</td>
		<td>".$se['detail2']."</td>
		<td>".$se['detail3']."</td>
		<td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
.font1 {
	font-family: "TH Niramit AS";
	font-size:22px;
}
</style>

<body>
<script>
 function checkm(etext){
	if(etext=='t'){
		if(confirm('�������ع��¡��� 3 ��͹��ͧ��÷���¡�õ���������')){
			return true;
		}else{
			return false;
		}
	}else if(etext=='f'){
		return true;
	}
}

//////// ���¡�������� ////////
function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}
function searchSuggest(str,len,getto) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){

			url = 'drugoutside_frm.php?action=slcode&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
<?
include("connect.inc");






$build = array("42"=>"�ͼ��������","44"=>"�ͼ����� ICU","43"=>"�ͼ������ٵ�","45"=>"�ͼ����¾����");
$Thidate = (date("Y")+543).date("-m-d H:i:s");



	$sql = "Select an, hn, ptname, bedcode, ptright, doctor,diagnos  From bed where an = '".$_POST["cAn"]."' limit 0,1 ";
	$result = mysql_query($sql);
	$arr = mysql_fetch_assoc($result);
?>
<h3 align="center" class="font1">�����ҹ͡�ç��Һ�� �������</h3>

<form name="f1" method="post">
<fieldset class="font1">
<legend>��������ǹ��Ǽ�����</legend>
<TABLE  align="center" width="70%">
<TR>
  <TD align="right">AN : </TD>
  <TD bgcolor="#FFFFBC"><?php echo $arr["an"];?><input type="hidden" name="an" value="<?php echo $arr["an"];?>" /></TD>
  <TD align="right">HN : </TD>
  <TD bgcolor="#FFFFBC"><?php echo $arr["hn"];?><input type="hidden" name="hn" value="<?php echo $arr["hn"];?>" /></TD>
  <TD align="right">����-ʡ�� : </TD>
  <TD bgcolor="#FFFFBC"><?php echo $arr["ptname"];?><input type="hidden" name="ptname" value="<?php echo $arr["ptname"];?>" /></TD>
</TR>
<TR>
	<TD align="right">�ͼ����� : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $build[substr($arr["bedcode"],0,2)];?></TD>
	<TD align="right">�Է��� : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["ptright"];?><input type="hidden" name="ptright" value="<?php echo $arr["ptright"];?>" /></TD>
	<TD align="right">ᾷ�� : </TD>
	<TD bgcolor="#FFFFBC"><?php echo $arr["doctor"];?><input type="hidden" name="doctor" value="<?php echo $arr["doctor"];?>" /></TD>
</TR>
<TR>
  <TD align="right">Diag :</TD>
  <TD bgcolor="#FFFFBC"><?php echo $arr["diagnos"];?><input type="hidden" name="diagnos" value="<?php echo $arr["diagnos"];?>" /></TD>
  <TD align="right">&nbsp;</TD>
  <TD bgcolor="#FFFFBC">&nbsp;</TD>
  <TD align="right">&nbsp;</TD>
  <TD bgcolor="#FFFFBC">&nbsp;</TD>
</TR>
</TABLE>
</fieldset>
<br />
<fieldset class="font1">
<legend>��������</legend>
<TABLE  align="center">
<TR>
  <TD align="right">������ : </TD>
  <TD bgcolor="#FFFFBC"><input type="text" name="drugcode" /></TD>
  <TD align="right">������ (��ä��) : </TD>
  <TD bgcolor="#FFFFBC"><input type="text" name="tradname" /></TD>
  <Div id="list" style="left:150PX;top:70PX;position:absolute;"></Div>
  <TD align="right">�Ը��� : </TD>
  <TD bgcolor="#FFFFBC"><input type="text" name="slcode"  id="slcode" onKeyPress="searchSuggest(this.value,2,'slcode');" /></TD>
</TR>
<TR>
	<TD align="right">�ӹǹ : </TD>
	<TD bgcolor="#FFFFBC"><input type="text" name="amount" /></TD>
	<TD align="right">˹��� : </TD>
	<TD bgcolor="#FFFFBC"><input type="text" name="unit" /></TD>
	<TD align="right">������ : </TD>
	<TD bgcolor="#FFFFBC"><select name="part" class="font1">
    
    <option value="DDL">DDL</option>
    <option value="DDY">DDY</option>
    <option value="DDN">DDN</option>
    <option value="DSN">DSN</option>
    <option value="DSY">DSY</option>
    <option value="DPY">DPY</option>
    <option value="DPN">DPN</option>
    </select>
    </TD>
</TR>
<TR>
  <TD align="right">�Ҥ� :</TD>
  <TD bgcolor="#FFFFBC"><input type="text" name="price" id="price" /></TD>
  <TD align="right">�ԡ�� :</TD>
  <TD bgcolor="#FFFFBC"><input type="text" name="yprice" id="yprice" /></TD>
  <TD align="right">�ԡ����� :</TD>
  <TD bgcolor="#FFFFBC"><input type="text" name="nprice" id="nprice" /></TD>
</TR>
<TR>
  <TD colspan="6" align="center"></TD>
  </TR>
</TABLE>
<br />
<div align="center"><INPUT ID="button_submit" name="button_submit" TYPE="submit" VALUE=" ��ŧ "> <a target=_self  href='../nindex.htm'> �����</a></div>
</fieldset>
</form>
<br />
<?
if($_POST['button_submit']){
	
	include("connect.inc");
	
session_unregister("nRunno");
session_register("nRunno");

	$query = "SELECT runno FROM runno WHERE title = 'phardep' limit 0,1";
	$result = mysql_query($query) or die("Query failed");
	
	list($_SESSION["nRunno"]) = mysql_fetch_row($result);
	

	 $_SESSION["nRunno"]++;

    $query ="UPDATE runno SET runno = ".$_SESSION["nRunno"]." WHERE title='phardep'";
    $result = mysql_query($query) or die("Query failed");
	
	///////////////////////////////////////////////////	
	
function jschars($str)
	{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

	
	


$Thidate = (date("Y")+543).date("-m-d H:i:s");

$strsql2="INSERT INTO `phardep` (`chktranx` , `date` , `ptname` , `hn` , `an` , `price` , `paid` , `doctor` , `item` , `idname` , `diag` , `essd` , `nessdy` , `nessdn` , `dpy` , `dpn` , `accno` , `dsy` , `dsn` , `dgtake` , `tvn` , `ptright` , `phapt` , `borrow` , `cashok` , `inj` )
VALUES ('".$_SESSION["nRunno"]."', '".$Thidate."', '".$_POST['ptname']."', '".$_POST['hn']."', '".$_POST['an']."', '".$_POST['price']."', '', '".$_POST['doctor']."', '', '".$_SESSION["sOfficer"]."', '".jschars($_POST['diagnos'])."', '', '', '', '', '', '', '', '', '', '', '".$_POST['ptright']."', '', '', '', '');";
$strquery2=mysql_query($strsql2)or die (mysql_error());

$idno=mysql_insert_id(); 
/////////////////


$strsql="INSERT INTO `drugrx` (`date` , `hn` , `an` , `drugcode` , `tradname` , `amount` , `price` , `item` , `slcode` , `part` , `idno` , `stock` , `statcon` , `DPY` , `DPN` , `reason` , `drug_inject_amount` , `drug_inject_unit` , `drug_inject_amount2` , `drug_inject_unit2` , `drug_inject_time` , `drug_inject_slip` , `drug_inject_type` , `drug_inject_etc` , `status` , `drug_status` , `mainstk` , `reject` , `drug_inject_amount3` , `drug_inject_unit3`)
VALUES ('".$Thidate."', '".$_POST['hn']."', '".$_POST['an']."', '".$_POST['drugcode']."', '".$_POST['tradname']."', '".$_POST['amount']."', '".$_POST['price']."', '".$_POST['item']."', '".$_POST['slcode']."','".$_POST['part']."', '".$idno."', '', NULL , NULL , NULL , '', '', '', '', '', '', '', '', '', 'Y', '', '', '', '', '');";
$strquery=mysql_query($strsql) or die (mysql_error());


$detail=$_POST['tradname'].','.$_POST['slcode'];

$strsql3="INSERT INTO `ipacc` ( `date` , `an` , `code` , `depart` , `detail` , `amount` , `price` , `paid` , `part` , `yprice` , `nprice` , `idname` , `accno`,`idno`)
VALUES ('".$Thidate."', '".$_POST['an']."', '".$_POST['drugcode']."', 'PHAR', '".$detail."', '".$_POST['amount']."', '".$_POST['price']."', '', '".$_POST['part']."', '".$_POST['yprice']."', '".$_POST['nprice']."', '".$_SESSION["sOfficer"]."', '1','".$idno."')";
$strquery3=mysql_query($strsql3)or die (mysql_error());

//echo $_POST['amount'];

if($strquery3){
	
	echo "�ѹ�֡���������º�������Ǥ�Ѻ";
	
	echo "<meta HTTP-EQUIV='REFRESH' CONTENT='2; URL=drugoutside.php'>";
	
}


}
?>

</body>
</html>