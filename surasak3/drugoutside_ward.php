<? session_start();  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
.font1 {
	font-family:"TH SarabunPSK";
	font-size:22px;
}
</style>

<body>
<script>
 /*function checkm(etext){
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
*/

//////// ���¡�������� ////////
/*function newXmlHttp(){
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
}*/
</script>
<?
include("connect.inc");

$build = array("42"=>"�ͼ��������","44"=>"�ͼ����� ICU","43"=>"�ͼ������ٵ�","45"=>"�ͼ����¾����");
$Thidate = (date("Y")+543).date("-m-d H:i:s");

	$sql = "Select an, hn, ptname, bedcode, ptright, doctor,diag From ipcard where an = '".$_REQUEST["cAn"]."' limit 0,1 ";
	$result = mysql_query($sql);
	$arr = mysql_fetch_assoc($result);
?>
<h3 align="center" class="font1">�ѹ�֡�������¹͡�ç��Һ�� �������</h3>
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
<legend>�����Ť�Һ�ԡ��</legend>
<TABLE  align="center">
<TR>
  <TD align="right">���ʤ�Һ�ԡ�� : </TD>
  <TD><input name="code" type="text" class="font1" /></TD>
  <TD align="right">�����Ѷ��� : </TD>
  <TD><input name="detail" type="text" class="font1" id="detail" size="40" /></TD>
  <TD align="right">&nbsp;</TD>
  <TD>&nbsp;</TD>
</TR>
<TR>
	<TD align="right">�ӹǹ : </TD>
	<TD bgcolor="#FFFFBC"><input name="amount" type="text" class="font1" /></TD>
	<TD align="right">������ : </TD>
	<TD bgcolor="#FFFFBC"><select name="part"  id="part">
	  <? $sqlpart="SELECT DISTINCT (part)as part FROM `ipacc` GROUP BY part";
	$querypart=mysql_query($sqlpart);
	while($arrpart=mysql_fetch_array($querypart)){
	?>
	  <option value="<?=$arrpart['part'];?>">
	    <?=$arrpart['part'];?>
	    </option>
	  <? }?>
	  </select></TD>
	<TD align="right">&nbsp;</TD>
	<TD>&nbsp;</TD>
</TR>
<TR>
  <TD align="right">�Ҥ� :</TD>
  <TD bgcolor="#FFFFBC"><input name="price" type="text" class="font1" id="price" /></TD>
  <!--<TD align="right">�ԡ�� :</TD>
  <TD bgcolor="#FFFFBC"><input name="yprice" type="text" class="font1" id="yprice" /></TD>
  <TD align="right">�ԡ����� :</TD>
  <TD bgcolor="#FFFFBC"><input name="nprice" type="text" class="font1" id="nprice" /></TD>-->
</TR>
<TR>
  <TD colspan="6" align="center"></TD>
  </TR>
</TABLE>
<br />
<div align="center"><INPUT name="button_submit" TYPE="submit" class="font1" ID="button_submit" VALUE=" ��ŧ ">
<a target=_self  href='../nindex.htm'> �����</a></div>
</fieldset>
</form>
<br />
<?
if($_POST['button_submit']){
	
	include("connect.inc");
	
/*session_unregister("nRunno");
session_register("nRunno");

	$query = "SELECT runno FROM runno WHERE title = 'phardep' limit 0,1";
	$result = mysql_query($query) or die("Query failed");
	
	list($_SESSION["nRunno"]) = mysql_fetch_row($result);
	

	 $_SESSION["nRunno"]++;

    $query ="UPDATE runno SET runno = ".$_SESSION["nRunno"]." WHERE title='phardep'";
    $result = mysql_query($query) or die("Query failed");*/
	
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

$detail=$_POST['detail'];

/*$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright,lab)VALUES('$Thidate','$arr[ptname]','$arr[hn]','$arr[an]','$arr[doctor]','WARD','$_POST[amount]','$detail', '$Netprice','$_POST[yprice]','$_POST[nprice]','','$sOfficer','$arr[diagnos]','$cAccno','$tvn','$arr[ptright]','$nLab');";

      $result = mysql_query($query) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>
	*�ô��Ǩ�ͺ�������¡������� [�١�è����Թ] �������<br>
	*������ʴ���� ��ѹ�֡仡�͹����<br>
	*���������ʴ����  ��úѹ�֡�������<br>");

$idno=mysql_insert_id(); 
/////////////////


                $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright,film_size)
                                 VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$aDgcode[$n]','$aTrade[$n]','$aAmount[$n]',
                                 '$aMoney[$n]','$aYprice[$n]','$aNprice[$n]','$cDepart','$aPart[$n]','$idno','$cPtright','$aFilmsize[$n]');";
                $result = mysql_query($query) or die("Query failed,cannot insert into patdata");*/


$strsql3="INSERT INTO `ipacc` ( `date` , `an` , `code` , `depart` , `detail` , `amount` , `price` , `paid` , `part` , `yprice` , `nprice` , `idname` , `accno`,`idno`)
VALUES ('".$Thidate."', '".$_POST['an']."', '".$_POST['code']."', 'WARD', '".$detail."', '".$_POST['amount']."', '".$_POST['price']."', '', '".$_POST['part']."', '".$_POST['price']."', '".$_POST['nprice']."', '".$_SESSION["sOfficer"]."', '1','".$idno."')";
$strquery3=mysql_query($strsql3)or die (mysql_error());

//echo $_POST['amount'];
if($strquery3){
	
	echo "�ѹ�֡���������º�������Ǥ�Ѻ";
	echo "<meta HTTP-EQUIV='REFRESH' CONTENT='2; URL=drugoutside_hnward.php'>";
}
}
?>

</body>
</html>