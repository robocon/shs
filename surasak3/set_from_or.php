<? session_start();?>
<script type="text/javascript">
if ((typeof Range !== "undefined")
&& !Range.prototype.createContextualFragment)
{
    Range.prototype.createContextualFragment = function(html)
    {
        var frag = document.createDocumentFragment(),
        div = document.createElement("div");
        frag.appendChild(div);
        div.outerHTML = html;
        return frag;
    };
}
</script>
<html>
<head>
<title>� SET ��ҵѴ</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>


<link rel="stylesheet" type="text/css" href="epoch_styles.css" />

<style>
.f1{
	font-family:"Angsana New";
	font-size:16pt;	
}
</style>
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_surg'));

};



function fncSubmit()
{

	if(document.frmMain.ward.value == "")
	{
		alert('��س����͡ �ͼ�����');
		document.frmMain.ward.focus();		
		return false;
	}	
		if(document.frmMain.hn.value == "")
	{
		alert('��س��к� HN');
		document.frmMain.hn.focus();		
		return false;
	}	
			if(document.frmMain.ptname.value == "")
	{
		alert('��س��к� ����-ʡ�� ');
		document.frmMain.ptname.focus();		
		return false;
	}	
		if(document.frmMain.diag.value == "")
	{
		alert('��س��кء���ԹԨ��� (diag)');
		document.frmMain.diag.focus();		
		return false;
	}	
	if(document.frmMain.surg.value == "")
	{
		alert('��س��кء�ü�ҵѴ');
		document.frmMain.surg.focus();		
		return false;
	}	
		if(document.frmMain.inhalation_type.value == "")
	{
		alert('��س��кت�Դ����');
		document.frmMain.inhalation_type.focus();		
		return false;
	}
	if(document.frmMain.doctor.value == "")
	{
		alert('��س��к�ᾷ��');
		document.frmMain.doctor.focus();		
		return false;
	}	
	
	document.frmMain.submit();
}

</script>
<?php

if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
   }
include("connect.inc");
   if(isset($_GET["action"]) && $_GET["action"] == "set1"){
	
	Function calcage($birth){

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


	
	$sql = "SELECT hn,yot,name,surname,dbirth,ptright FROM opcard  WHERE hn like '%".$_GET['search']."%'  order by hn asc limit 10";
	
	$result = mysql_query($sql)or die(mysql_error());

	
	
	if(mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
				<td ><font style=\"color: #FFFFFF\"><strong>HN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>����-ʡ��</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>�Է��</strong></font></td>
			
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list2').innerHTML ='';\">�Դ</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = mysql_fetch_assoc($result)){
			
$age=calcage($arr['dbirth']);
				
$ptname=$arr["yot"].$arr["name"].' '.$arr["surname"];
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '",$arr["hn"],"';document.getElementById('".$_GET["getto2"]."').value = '",$ptname,"';document.getElementById('".$_GET["getto3"]."').value = '",$age,"';document.getElementById('".$_GET["getto4"]."').value = '",$arr["ptright"],"';document.getElementById('list2').innerHTML ='';\">",$arr["hn"],"</A></td>

					<td  align=\"center\">",$ptname,"</td>
					<td>",$arr["ptright"],"</td>
					<td></td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
				</tr>
			";

		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}

//////////////////////////////�Ҩҡ���ʡ�� ////////////////

if(isset($_GET["action2"]) && $_GET["action2"] == "set2"){
	
	$sql = "SELECT * FROM ipcard  WHERE an like '%".$_GET['search2']."%' order by an asc limit 10";
	
	$result = mysql_query($sql)or die(mysql_error());

	if(mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
				<td ><font style=\"color: #FFFFFF\"><strong>AN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>HN</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>����-ʡ��</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>�Է��</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list2').innerHTML ='';\">�Դ</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = mysql_fetch_assoc($result)){
				

				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '",$arr["hn"],"';document.getElementById('".$_GET["getto2"]."').value = '",$arr["an"],"';document.getElementById('".$_GET["getto3"]."').value = '",$arr["ptname"],"';document.getElementById('".$_GET["getto4"]."').value = '",$arr["age"],"';document.getElementById('".$_GET["getto5"]."').value = '",$arr["ptright"],"';document.getElementById('list2').innerHTML ='';\">",$arr["an"],"</A></td>
					<td  align=\"center\">",$arr["hn"],"</td>
					<td  align=\"center\">",$arr["ptname"],"</td>
					<td>",$arr["ptright"],"</td>
					<td></td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					
				</tr>
			";

		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
?>
<?
include("connect.inc");
$date_now = (date("Y")).date("-m-d");

?>
<body>
<script>

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

function searchSuggest(str,len,getto1,getto2,getto3,getto4) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'set_from_or.php?action=set1&search=' + str+'&getto1=' + getto1+'&getto2=' + getto2+'&getto3=' + getto3+'&getto4=' + getto4;


			//alert(url);
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list2").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest2(str,len,getto1,getto2,getto3,getto4,getto5) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'set_from_or.php?action2=set2&search2=' + str+'&getto1=' + getto1+'&getto2=' + getto2+'&getto3=' + getto3+'&getto4=' + getto4+'&getto5=' + getto5;


			//alert(url);
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list2").innerHTML = xmlhttp.responseText;
		}
}

</script>

<h1 class="f1" align="center">�ç��Һ�Ť�������ѡ��������</h1>
<h1 class="f1" align="center">� SET ��ҵѴ --/--- FR-NUR-002/1 ,03 ,1 �.�.48</h1>
<form name="frmMain" method="post" onSubmit="JavaScript:return fncSubmit();" action="set_from_or_print.php" target="_blank">
  <table border="1" align="center" cellpadding="0" cellspacing="0" class="f1" style="border-collapse:collapse; border-color:#000;">
  <tr>
    <td bgcolor="#FF66CC"><div align="center">�ͼ�����</div></td>
    <td><select name="ward" id="ward">
      <option value="">----��س����͡----</option>
      
      <? $sql="SELECT * FROM `departments` WHERE sOr = 'y' ";
	  		$query=mysql_query($sql);
				
	  	while($arr=mysql_fetch_array($query)){	
		
	  ?>
      <option value="<?=$arr['name']?>"><?=$arr['name']?></option>
 <!--     <option value="OPD">OPD</option>
      <option value="ER">ER</option>
      <option value="�ͼ��������">�ͼ��������</option>
      <option value="�ͼ������ٵ�">�ͼ������ٵ�</option>
      <option value="�ͼ����¾����">�ͼ����¾����</option>
      <option value="�ͼ�����˹ѡ">�ͼ�����˹ѡ</option>-->
      <? } ?>
      <option value="����к�">����к�</option>
    </select></td>
    <td bgcolor="#FF66CC"><div align="center">�ѹ/��͹/��</div></td>
    <td><input type="text" name="date_surg" id="date_surg" value="<?=$date_now;?>" size="10">
    ���� <SELECT NAME="time1">
    <option value="-" selected>-</option>
          <?php 
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						//if($nonconf_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
        </SELECT>
        :
        <SELECT NAME="time2">
        <option value="-" selected>-</option>
          <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
					//	if($nonconf_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
        </SELECT> 
        *��س����͡�ѹ���ҡ��ԷԹ</td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">HN</td>
    <td><input name="hn" type="text" id="hn" size="15" onKeyPress="searchSuggest(this.value,4,'hn','ptname','age','ptright');"></td>
    <td bgcolor="#FF66CC">AN</td>
    <td><input name="an" type="text" id="an" size="15" onKeyPress="searchSuggest2(this.value,4,'hn','an','ptname','age','ptright');"></td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">����-ʡ��</td>
    <td><input type="text" name="ptname" id="ptname"></td>
    <td bgcolor="#FF66CC">����</td>
    <td><input type="text" name="age" id="age"></td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">�Է�� </td>
    <td><input type="text" name="ptright" id="ptright"></td>
    <td bgcolor="#FF66CC">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">����ԹԨ���</td>
    <td><input type="text" name="diag" id="diag"></td>
    <td bgcolor="#FF66CC">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">��ü�ҵѴ</td>
    <td><input type="text" name="surg" id="surg"></td>
    <td bgcolor="#FF66CC">��Դ����</td>
    <td><input type="text" name="inhalation_type" id="inhalation_type"></td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">ᾷ��</td>
    <td><select name="doctor" id="doctor">
      <?php 
		echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
		echo "<option value='��ͧ��Ǩ�ä�����' >��ͧ��Ǩ�ä�����</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
    </select></td>
    <td bgcolor="#FF66CC">�����˵�</td>
    <td><textarea name="comment" id="comment" cols="45" rows="5"></textarea></td>
    </tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" name="button" id="button" value="     ��ŧ    ">  
    <a href="../nindex.htm">&lt;&lt;-����;</a> <a href="set_from_print.php" target="_blank">��§ҹ� SET ��ҵѴ  </a></td>
    </tr>
</table>
<br>
<div id="list2" style="position: absolute; left: 447px; top: 181px;"></div>
<br>

</form>
<?
include("set_from_list.php");
?>


</body>
</html>
