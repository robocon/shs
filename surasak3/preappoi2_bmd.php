<?php
session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}

include("connect.inc");   

if(isset($_GET["action"])  && $_GET["action"] == "viewlist"){

	$count = count($_SESSION["list_code"]);
	//"<A HREF=\"javascript:show_bock();\">������ʹ</A>
	echo "<TABLE bgcolor='#FFFFD2'>
	<TR>
		<TD>";
	for($i=0;$i<$count;$i++){
		echo "<A HREF=\"javascript:del_list(",$i,");\" >",$_SESSION["list_detail"][$i],"</A><BR>";
	}
	echo "</TD>
	</TR>
	</TABLE>";

	exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "addtolist"){

	//************************** �ʴ���¡�� lab  ********************************************************

	$array_new = array($_GET["code"]);

	$result = array_intersect($_SESSION["list_code"], $array_new);

	if(count($result) ==0){

	$sql = "Select detail, yprice, nprice From labcare where code = '".$_GET["code"]."' limit 1; ";
	list($detail, $yprice, $nprice) = Mysql_fetch_row(Mysql_Query($sql));

	array_push($_SESSION["list_code"],$_GET["code"]);
	array_push($_SESSION["list_detail"],$detail);
	
	}

	exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "delete"){
	
	$count = count($_SESSION["list_code"]);
	
	$j=$_GET["code"];


	for($i=$j;$i<$count;$i++){
		$_SESSION["list_code"][$i] = $_SESSION["list_code"][$i+1];
		$_SESSION["list_detail"][$i] = $_SESSION["list_detail"][$i+1];

	}
	
	unset($_SESSION["list_code"][$count-1]);
	unset($_SESSION["list_detail"][$count-1]);


	exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "lab"){

	$sql = "Select code, detail From labcare where  detail like '%".$_GET["search"]."%' AND part = 'lab' AND (left(code,1) >='0' AND left(code,1) <='9') Order by numbered ASC";

	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:410px; height:430px; overflow:auto; \">";

		echo "<table bgcolor=\"#FFFFCC\" width=\"500\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
		<tr align=\"center\" bgcolor=\"#3333CC\">
			<td width=\"368\"><font style=\"color: #FFFFFF\"><strong>��������´</strong></font></td>
			<td width=\"24\" bgcolor=\"#3333CC\"><font style=\"color: #FF0000;\"><strong><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></strong></font></td>
		</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";


				$arr["detail"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["detail"]);


			echo "<tr bgcolor=\"$bgcolor\">
					<td bgcolor=\"$bgcolor\"><A HREF=\"javascript:void(0);\" onclick=\"addtolist('".$arr["code"]."'); \">",$arr["detail"],"</A></td>
					<td colspan=\"2\"  bgcolor=\"$bgcolor\">",$arr["salepri"],"</td>
				</tr>
					<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
				</tr>
			";


		$i++;
		}
		echo "</TABLE></Div>";
	}

exit();
}

if(isset($_POST['B1'])){
	$cdate_appoint = $_POST['date_appoint'];
	session_register("appd");
	session_register("cdoctor");
	//�ó����͡�ѹ�����͹��ѧ
	$yearnow = date("Y")+543;
	$datenow =date("dm").$yearnow;
	$cdoctor=  $_POST['dr'];
	$mon = array('','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
	$arr = explode (" ",$_POST['date_appoint']); 
	for($i=1;$i<13;$i++){
		if($arr[1]==$mon[$i]){
			if(strlen($i)==1) $month = "0".$i;
			else $month = $i;
		}
	}
	$day = $arr[0];
	$year = $arr[2];
	$datenut = $day.$month.$year;
	$datenut1 = $day."-".$month."-".$year;
	$year -=543; 
/*	if($datenut<$datenow){
		?>
		<script>
		//alert("���͡�ѹ������١��ͧ ��س����͡�ѹ����");
        //window.history.back();
        </script>
		<?
	}
	else{*/
	
		/*$dd = getdate ( mktime ( 0, 0, 0, $month, $day, $year ));
			if($cdoctor=="MD022 (����Һᾷ��)"){
			
			}
			elseif($dd['weekday']=="Saturday"|$dd['weekday']=="Sunday"){
				$droffline = "select count(*) from dr_offline where name = '$cdoctor' and dateoffline = '".$datenut1."' ";
					$rowdr1 = mysql_query($droffline);
					$showdr1 = mysql_fetch_array($rowdr1);
					if($showdr1[0]=="1"){
						?>
							<script>
								if(confirm("ᾷ�������ӡ���͡��Ǩ ��ͧ��÷������͡�����������?")==true){
									
								}  
								else{
									window.history.back();
								}
							</script>
						<?
					}
			}
			else{
				include("connect.inc");   
				$droff = "select count(*) from doctor where name = '$cdoctor' and ".$dd['weekday']." = '1' ";
				//echo $droff;
				$rowdr = mysql_query($droff);
				$showdr = mysql_fetch_array($rowdr);
				//echo $showdr[0];
				if($showdr[0]!='1'){
					?>
					<script>
						if(confirm("ᾷ�������ӡ���͡��Ǩ ��ͧ��÷������͡�����������?")==true){
							
						}  
						else{
							window.history.back();
						}
					</script>
					<?
				}
				else{
					$droffline = "select count(*) from dr_offline where name = '$cdoctor' and dateoffline = '".$datenut1."' ";
					$rowdr1 = mysql_query($droffline);
					$showdr1 = mysql_fetch_array($rowdr1);
					if($showdr1[0]=="1"){
						?>
							<script>
								if(confirm("ᾷ�������ӡ���͡��Ǩ ��ͧ��÷������͡�����������?")==true){
									
								}  
								else{
									window.history.back();
								}
							</script>
						<?
					}
				}
		//}
	}*/
}

//$cappdate=$appdate;
//$cappmo=$appmo;
//$cthiyr=$thiyr;
  //$cdoctor=$doctor;
//$cdate_appoint = $_POST['date_appoint'];
  //session_register("cappdate");
 //session_register("cappmo");
 //session_register("cthiyr");
// session_register("cdoctor");
//session_register("appd");

session_register("list_code");
session_register("list_detail");
$_SESSION["list_code"] = array();
$_SESSION["list_detail"] = array();

 function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    //$str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

//$dbirth="$y-$m-$d"; ���ѹ�Դ� opcard= "$y-$m-$d" ���=$birth in function
// print "<p><b><font face='Angsana New' size = '3'>�ç��Һ�Ť�������ѡ��������</font></b></p>";
   print "<p><font face='Angsana New' size = '4'>���� $cPtname  HN: $cHn ���� $cAge &nbsp;<B>�Է��:$cptright:$idguard</font></B><br>";
  print "<font face='Angsana New' size = '4'>ᾷ�� : $cdoctor &nbsp;&nbsp; �ѹ���: $cdate_appoint&nbsp; </font></B></p>";

  
   $queryT="SELECT phone FROM opcard where hn='$cHn'";
   $resultT = mysql_query($queryT);
   $rowT = mysql_fetch_array($resultT);

 $appd=$cdate_appoint;

  
    $query="CREATE TEMPORARY TABLE appoint1 SELECT * FROM appoint WHERE appdate = '$appd' and detail = 'FU32 �Ѵ��ǨBMD' ";
    $result = mysql_query($query) or die("Query failed,app");
	
    $query="SELECT  apptime,COUNT(*) AS duplicate FROM appoint1 GROUP BY apptime HAVING duplicate > 0 ORDER BY apptime";
    $result = mysql_query($query);
	$num=0;
    $n=0;
	while (list ($apptime,$duplicate) = mysql_fetch_row ($result)) {
		$n++;
		$num= $duplicate+$num;
		print (" <tr>\n".
           //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New' size = '3'><b>$apptime</b>&nbsp;&nbsp;</a></td>\n".
        	"  <td BGCOLOR=66CDAA><font face='Angsana New' size = '3'>�Ѵ�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
		" </tr>\n&nbsp;");
               }
 print "<br><font face='Angsana New' size = '5'><b>�ӹǹ�����·�����&nbsp;&nbsp; $num&nbsp;&nbsp;��</b></a> ";
  
    print "<fieldset><font face='Angsana New' size = '4'><strong>�˵ؼš���觵�Ǩ :</strong><br>";
    $Thidate2 = (date("Y")+543).date("-m-d"); 
  	$querysub  = "select * from orderbmd where hn='$cHn' and date like '$Thidate2%' order by row_id desc";
	$sub = mysql_query($querysub);
	$presult= mysql_fetch_array($sub);
	for($i=1;$i<=8;$i++){
		if($presult['sub'.$i]!=""){
			$s=0;
			$l=50;
			echo "-".$presult['sub'.$i]."<br>";
			if($presult['detail_sub'.$i]!=""){
				echo "&nbsp;�".$presult['detail_sub'.$i];
				if($presult['detail_sub'.$i.'1']!=""){
					echo "&nbsp;<u>".$presult['detail_sub'.$i.'1']."<u>";
				}
				echo "<br>";
			}
		}	
	}
	print "</fieldset></font>";
?>
<SCRIPT LANGUAGE="JavaScript">

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

function addtolist(code){
	
	xmlhttp = newXmlHttp();
	url = 'preappoi2.php?action=addtolist&code=' + code;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();
}

function viewlist(){

	xmlhttp = newXmlHttp();
	url = 'preappoi2.php?action=viewlist';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("list_patho").innerHTML = xmlhttp.responseText;
	document.getElementById("list").innerHTML = "";
}

function del_list(code){

	url = 'preappoi2.php?action=delete&code=' + code;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
	viewlist();
}

function show_bock(){
	
	if(document.getElementById("bock_lab").style.display=="none"){
		document.getElementById("bock_lab").style.display ="";
	}else{
		document.getElementById("bock_lab").style.display ="none";
	}

}

function searchSuggest(action,str,len) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'preappoi2.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			document.getElementById('list').style.display=''
			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function checktext(){
		if(document.getElementById('room').value=="NA"){
			alert('��س����͡��ͧ\"���㺹Ѵ���\"');
			return false;
		}
		else if(document.getElementById('detail').value=="NA"){
			alert('��س����͡��ͧ\"�Ѵ������\"');
			return false;
		}
		else if(document.getElementById('advice').value=="NA"){
			alert('��س����͡��ͧ\"��ͤ�û�Ժѵԡ�͹��ᾷ��\"');
			return false;
		}
		else if(document.getElementById('depcode').value=="NA"){
			alert('��س����͡��ͧ\"Ἱ����Ѵ\"');
			return false;
		}
		return true;
}

</SCRIPT>


<script language="javascript">
function fncSubmit(strPage)
{
	if(strPage == "page1")
	{
		document.form1.action="appinsert_stricker.php";
	}
	
	document.form1.submit();
}
</script>

<TABLE border="0">
<TR valign="top">
	<TD>
<form  name="form1" method="POST" action="appinsert1_bmd.php" target="_blank" onsubmit="return checktext();">
<font face="Angsana New" size = '4'>��س��кء�ùѴ������ ���ͷ��Ἱ�����¹�зӡ�ä��� OPD Card ��١��ͧ
<br>

<table border="0">
  <tr><td><font face="Angsana New">�Ѵ������&nbsp;&nbsp;&nbsp;</font></td>
    <td width="311"><font face="Angsana New">
      <select size="1" name="detail" onchange="listb(<?=$counter?>)" id="detail">
      <option value="NA"><<�Ѵ������>></option>
	<option value="FU32 �Ѵ��ǨBMD" selected="selected">�Ѵ��Ǩ BMD</option>
	 </select>
     <input type="hidden" name="rowid" value="<?=$presult['row_id']?>" />
    </font></td>
    <td width="280"><font face="Angsana New">
 <input type="text" id="detail2" name="detail2" size="20">
 <select size="1" name="detail_list" id="detail_list" style="display:none">
<option value="��ͧ�����������">��ͧ�����������</option>
<option value="��ͧ������˭�">��ͧ������˭�</option>
<option value="��ͧ�����������+��ͧ������˭�">��ͧ�����������+��ͧ������˭�</option>
</select></font></td></tr>
  <tr>
    <td width="115"><font face="Angsana New" size = '4'>���㺹Ѵ���</font></td>
    <td colspan="2"><font face="Angsana New" size = '4'>
      <select size="1" name="room" id="room">
        <option selected value="NA">&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3627;&#3657;&#3629;&#3591;&#3605;&#3619;&#3623;&#3592;&gt;</option>
        <option>�ش��ԡ�ùѴ��� 1</option>
        <option>�ش��ԡ�ùѴ��� 2</option>
        <option>Ἱ�����¹</option>
        <option>��ͧ�ء�Թ</option>
        <option>�ͧ�ѹ�����</option>
        <option>Ἱ���Ҹ��Է��</option>
        <option selected="selected">Ἱ��͡�����</option>
        <option>�ͧ�ٵ�-����</option>
        <option>����Ҿ</option>
        <option>��չԡ�ѧ���</option>
        <option>�ǴἹ��</option>
        <option>��ͧ��Ǩ�ѡ��(��)</option>
        <option>��ͧ��Ǩ����Ҿ�ӺѴ(�֡����Ҿ)</option>
        <option>��Ǩ����Ѵ OPD�Ǫ��ʵ���鹿�</option>
        <option>��չԡ�ä�</option>
		<option>����Ҿ�ӺѴ��� 2</option>
        </select>
      </font><font face="Angsana New" size = '4'>����
        <select size="1" name="capptime">
          <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>
          <option selected>08:00 &#3609;. - 10.30 &#3609;.</option>
          <option>08:00 &#3609;. - 11.00 &#3609;.</option>
          <option>07:00 &#3609;.</option>
          <option>07:30 &#3609;.</option>
          <option>08:00 &#3609;.</option>
          <option>08:30 &#3609;.</option>
          <option>09:00 &#3609;.</option>
          <option>09:30 &#3609;.</option>
          <option>10:00 &#3609;.</option>
          <option>10:30 &#3609;.</option>
          <option>11:00 &#3609;.</option>
          <option>11:30 &#3609;.</option>
          <option>13:00 &#3609;.</option>
          <option>13:30 &#3609;.</option>
          <option>14:00 &#3609;.</option>
          <option>14:30 &#3609;.</option>
          <option>15:00 &#3609;.</option>
          <option>15:30 &#3609;.</option>
          <option>16:00 &#3609;.</option>
          <option>16:30 &#3609;.</option>
          <option>17:00 &#3609;.</option>
          <option>17:30 &#3609;.</option>
          <option>18:00 &#3609;.</option>
          <option>18:30 &#3609;.</option>
          <option>19:00 &#3609;.</option>
          <option>19:30 &#3609;.</option>
          <option>20:00 &#3609;.</option>
          <option>21:00 &#3609;.</option>
          </select>
</font></td>
    </tr>
<tr>
  <td><font face="Angsana New" size = '4'>��ͤ�û�Ժѵԡ�͹��ᾷ��</font></td>
  <td colspan="2"><font face="Angsana New" size = '4'>
    <select size="1" name="advice" id="advice">
      <option selected value="NA">&lt;&#3650;&#3611;&#3619;&#3604;&#3648;&#3621;&#3639;&#3629;&#3585;&#3619;&#3634;&#3618;&#3585;&#3634;&#3619;&gt;</option>
      <option value="�����" selected="selected">�����</option>
      <option>����ͧ��������������</option>
      <option>�������ҹ����������ѧ���� 20:00 �.(���������������)</option>
      <option>�������ҹ����������ѧ���� 24:00 �.(���������������)</option>
      <option>���������������ѧ���� 20:00 �.</option>
      <option>���������������ѧ���� 24:00 �.</option>
      <option>���������������ѧ���� .............. �.</option>
      <option>�͡����� ��͹��ᾷ��</option>
      <option>������������ͧ��дѺ�ء��Դ �����Ū�� �駺���ǳ�鹤� ᢹ ��Т�</option>
      </select>
  </font></td>
  </tr>
<tr>
  <td colspan="3"><font face="Angsana New"><A HREF="javascript:show_bock();">������ʹ</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ������ʹ������� <font face="Angsana New">
    <input type="text" name="labm" size="30" />
  </font></td>
  </tr>
<tr>
  <td colspan="3"><div id="list_patho"></div></td>
</tr>
<tr>
  <td><font face="Angsana New">�͡�����&nbsp;</font></td>
  <td colspan="2"><font face="Angsana New">
    <select size="1" name="xray">
      <option selected value="NA">&#3652;&#3617;&#3656;&#3617;&#3637;&#3585;&#3634;&#3619;&#3648;&#3629;&#3585;&#3595;&#3648;&#3619;&#3618;&#3660;</option>
      <option>CXR</option>
      <option>KUB</option>
      <option>�͡����� ��͹��ᾷ��</option>
      &nbsp;
      </select>
    </font><font face="Angsana New">
      <input type="text" name="xray2" size="30" />
    </font></td>
  </tr>
<tr>
  <td><font face="Angsana New">����&nbsp;&nbsp;</font></td>
  <td><font face="Angsana New">
    <input type="text" name="other" size="30" />
  </font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td><font face="Angsana New">Ἱ����Ѵ</font></td>
  <td><font face="Angsana New">
    <select size="1" name="depcode" id="depcode">
      <option selected value="NA"><���͡Ἱ����Ѵ></option>
      <option>U09&nbsp;
        ��ͧ��Ǩ�ä</option>
      <option>U01&nbsp;
        �ͼ����ª��</option>
      <option>U02&nbsp;
        �ͼ�����˭ԧ</option>
      <option>U03&nbsp;
        �ͼ������ٵԹ��</option>
      <option>U19&nbsp;
        �ͼ����¾����3</option>
      <option>U04&nbsp;
        �ͼ�����˹ѡICU</option>
      <option>U05&nbsp;
        ��ͧ��ҵѴ</option>
      <option>U06&nbsp; ���ѭ��</option>
      <option>U12&nbsp;
        Ἱ������</option>
      <option>U10&nbsp;
        Ἱ���Ҹ�</option>
      <option selected="selected">U11&nbsp;
        Ἱ��͡������</option>
      <option>U13&nbsp;
        �ͧ�ѹ�����</option>
      <option >U16&nbsp;
        ��ͧ�ء�Թ</option>
      <option>U19&nbsp; �ͧ��Ǩ�ä�������ٵ�</option>
      <option>U20&nbsp; ����Ҿ</option>
      <option>U21&nbsp; �ǴἹ��</option>
      <option>U22&nbsp; ��ͧ��Ǩ�ѡ��(��)</option>
      <option>U23&nbsp; ��ͧ��Ǩ�Ǫ��ʵ���</option>
      <option>U24&nbsp; ��Թԡ�ѧ���</option>
      <option>U25&nbsp; CT Scan</option>
       <option>U26&nbsp; ��Թԡ�ä�</option>
       <option>U27&nbsp; OPD PM&R</option>
    </select>
  </font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td><font face="Angsana New">�������Ѿ�������</font></td>
  <td><font face="Angsana New">
    <input type="text" name="telp" size="20" value="<?=$rowT['phone']?>" />
  </font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2"><font face="Angsana New">*��Ҽ���������¹�ŧ�����Ţ���Ѿ������͡�����Ţ���Ѿ������᷹�����Ţ���</font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" value="     ��ŧ (A5)    " name="B1" /> <input name="btnButton1" type="button" value="��ŧ (㺹Ѵʵ������)"  onClick="JavaScript:fncSubmit('page1')">
    <a target=_top  href="../nindex.htm"><< ����</a></td>
  <td>&nbsp;</td>
</tr>
</table>
</font>
<br />
</p>
  </form>
&nbsp&nbsp;<<&nbsp<a target=_self  href='hnappoi1.php'>�͡㺹Ѵ����</a>
</TD>
	<TD>
	
	<?php
$i=0;
	$list_lab_check[$i]["code"] = "BS";
	$list_lab_check[$i]["detail"] = "BS";
	
$i++;
	$list_lab_check[$i]["code"] = "HBA1C";
	$list_lab_check[$i]["detail"] = "HbA1C";
	
$i++;
	$list_lab_check[$i]["code"] = "LIPID";
	$list_lab_check[$i]["detail"] = "Lipid";

$i++;
	$list_lab_check[$i]["code"] = "CHOL";
	$list_lab_check[$i]["detail"] = "CHOL";

$i++;
	$list_lab_check[$i]["code"] = "TRI";
	$list_lab_check[$i]["detail"] = "TG";
	
$i++;
	$list_lab_check[$i]["code"] = "HDL";
	$list_lab_check[$i]["detail"] = "HDL";
	
$i++;
	$list_lab_check[$i]["code"] = "LDL";
	$list_lab_check[$i]["detail"] = "LDL";
	
$i++;
	$list_lab_check[$i]["code"] = "URIC";
	$list_lab_check[$i]["detail"] = "URIC";
	
$i++;
	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN";
	
$i++;
	$list_lab_check[$i]["code"] = "CR";
	$list_lab_check[$i]["detail"] = "CR";

$i++;
	$list_lab_check[$i]["code"] = "E";
	$list_lab_check[$i]["detail"] = "E'Lyte";
	
$i++;
	$list_lab_check[$i]["code"] = "LFT";
	$list_lab_check[$i]["detail"] = "LFT";
	
$i++;
	$list_lab_check[$i]["code"] = "SGOT";
	$list_lab_check[$i]["detail"] = "AST";
	
$i++;
	$list_lab_check[$i]["code"] = "SGPT";
	$list_lab_check[$i]["detail"] = "ALT";
	
$i++;
	$list_lab_check[$i]["code"] = "ALK";
	$list_lab_check[$i]["detail"] = "AP";
	
$i++;
	$list_lab_check[$i]["code"] = "ALB";
	$list_lab_check[$i]["detail"] = "Alb";
	
$i++;	
	$list_lab_check[$i]["code"] = "CBC";
	$list_lab_check[$i]["detail"] = "CBC";
	
$i++;
	$list_lab_check[$i]["code"] = "UA";
	$list_lab_check[$i]["detail"] = "UA";
	
$i++;
	$list_lab_check[$i]["code"] = "HCT";
	$list_lab_check[$i]["detail"] = "HCT";
	
$i++;
	$list_lab_check[$i]["code"] = "BG";
	$list_lab_check[$i]["detail"] = "BG";

$i++;
	$list_lab_check[$i]["code"] = "FT3";
	$list_lab_check[$i]["detail"] = "FT3";
	
$i++;
	$list_lab_check[$i]["code"] = "FT4";
	$list_lab_check[$i]["detail"] = "FT4";
	
$i++;
	$list_lab_check[$i]["code"] = "TSH";
	$list_lab_check[$i]["detail"] = "TSH";
	
$i++;
	$list_lab_check[$i]["code"] = "TROP-T";
	$list_lab_check[$i]["detail"] = "TROP-T";
	
$i++;
	$list_lab_check[$i]["code"] = "HIV";
	$list_lab_check[$i]["detail"] = "AntiHIV";
	
$i++;
	$list_lab_check[$i]["code"] = "CD4";
	$list_lab_check[$i]["detail"] = "CD4";

$i++;
	$list_lab_check[$i]["code"] = "10530";
	$list_lab_check[$i]["detail"] = "HIV VL";
	
$i++;
	$list_lab_check[$i]["code"] = "VDRL";
	$list_lab_check[$i]["detail"] = "VDRL";
	
$i++;
	$list_lab_check[$i]["code"] = "HBSAG";
	$list_lab_check[$i]["detail"] = "HBsAg";
	
$i++;
	$list_lab_check[$i]["code"] = "HBSAB";
	$list_lab_check[$i]["detail"] = "HBsAb";
	
$i++;
	$list_lab_check[$i]["code"] = "HBCAB";
	$list_lab_check[$i]["detail"] = "HBcAb";
	
$i++;
	$list_lab_check[$i]["code"] = "HCV";
	$list_lab_check[$i]["detail"] = "HCV";
	
$i++;
	$list_lab_check[$i]["code"] = "10508";
	$list_lab_check[$i]["detail"] = "HBeAg";
	
$i++;
	$list_lab_check[$i]["code"] = "10509";
	$list_lab_check[$i]["detail"] = "HBeAg titer";

$i++;
	$list_lab_check[$i]["code"] = "10517";
	$list_lab_check[$i]["detail"] = "HBV VL";

$i++;
	$list_lab_check[$i]["code"] = "10522";
	$list_lab_check[$i]["detail"] = "HCV VL";

$i++;
	$list_lab_check[$i]["code"] = "10523";
	$list_lab_check[$i]["detail"] = "HCV genotype";

$i++;
	$list_lab_check[$i]["code"] = "HBTY";
	$list_lab_check[$i]["detail"] = "Hb typing";
		
$i++;
	$list_lab_check[$i]["code"] = "ESR";
	$list_lab_check[$i]["detail"] = "ESR";	

$i++;
	$list_lab_check[$i]["code"] = "CRP";
	$list_lab_check[$i]["detail"] = "CRP";

$i++;
	$list_lab_check[$i]["code"] = "RF";
	$list_lab_check[$i]["detail"] = "RF";
	
$i++;
	$list_lab_check[$i]["code"] = "PSA";
	$list_lab_check[$i]["detail"] = "PSA";

$i++;
	$list_lab_check[$i]["code"] = "ANA";
	$list_lab_check[$i]["detail"] = "ANA";

$i++;
	$list_lab_check[$i]["code"] = "AFP";
	$list_lab_check[$i]["detail"] = "AFP";
	
$i++;
	$list_lab_check[$i]["code"] = "CPK";
	$list_lab_check[$i]["detail"] = "CPK";
	
$i++;
	$list_lab_check[$i]["code"] = "10212";
	$list_lab_check[$i]["detail"] = "Stool exam";

$i++;
	$list_lab_check[$i]["code"] = "C-S";
	$list_lab_check[$i]["detail"] = "Stool C/S";

$i++;
	$list_lab_check[$i]["code"] = "STOCB";
	$list_lab_check[$i]["detail"] = "Stool occult blood";

$i++;
	$list_lab_check[$i]["code"] = "AFB";
	$list_lab_check[$i]["detail"] = "AFB";

$i++;
	$list_lab_check[$i]["code"] = "C-S";
	$list_lab_check[$i]["detail"] = "Sputum C/S";

$i++;
	$list_lab_check[$i]["code"] = "PT";
	$list_lab_check[$i]["detail"] = "PT,INR";
	
$i++;
	$list_lab_check[$i]["code"] = "BLTI";
	$list_lab_check[$i]["detail"] = "Bleeding time";

$i++;
	$list_lab_check[$i]["code"] = "FER";
	$list_lab_check[$i]["detail"] = "SF";
	
$i++;
	$list_lab_check[$i]["code"] = "PTT";
	$list_lab_check[$i]["detail"] = "PTT,Ratio";
	
$i++;
	$list_lab_check[$i]["code"] = "DCIP";
	$list_lab_check[$i]["detail"] = "DCIP";

$i++;
	$list_lab_check[$i]["code"] = "co2";
	$list_lab_check[$i]["detail"] = "CO2";

$i++;
	$list_lab_check[$i]["code"] = "Na";
	$list_lab_check[$i]["detail"] = "Na";

$i++;
	$list_lab_check[$i]["code"] = "k";
	$list_lab_check[$i]["detail"] = "K";

$i++;
	$list_lab_check[$i]["code"] = "Cl";
	$list_lab_check[$i]["detail"] = "Cl";
	
$i++;
	$list_lab_check[$i]["code"] = "PAP";
	$list_lab_check[$i]["detail"] = "PAP";

$i++;
	$list_lab_check[$i]["code"] = "CAL";
	$list_lab_check[$i]["detail"] = "Ca";

$i++;
	$list_lab_check[$i]["code"] = "PH";
	$list_lab_check[$i]["detail"] = "P";

$i++;
	$list_lab_check[$i]["code"] = "MAG";
	$list_lab_check[$i]["detail"] = "Mg";

$i++;
	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN2";

$i++;
	$list_lab_check[$i]["code"] = "BUNHD";
	$list_lab_check[$i]["detail"] = "BUN3";

$i++;
	$list_lab_check[$i]["code"] = "10362";
	$list_lab_check[$i]["detail"] = "Copper";

$i++;
	$list_lab_check[$i]["code"] = "10360";
	$list_lab_check[$i]["detail"] = "Cadmium";
	
$i++;
	$list_lab_check[$i]["code"] = "SI";
	$list_lab_check[$i]["detail"] = "Iron";
	
$i++;
	$list_lab_check[$i]["code"] = "10245";
	$list_lab_check[$i]["detail"] = "Zinc";

$i++;
	$list_lab_check[$i]["code"] = "UPT";
	$list_lab_check[$i]["detail"] = "UPT";
	
$i++;
	$list_lab_check[$i]["code"] = "SI";
	$list_lab_check[$i]["detail"] = "SI";

$i++;
	$list_lab_check[$i]["code"] = "TIBC";
	$list_lab_check[$i]["detail"] = "TIBC";

$i++;
	$list_lab_check[$i]["code"] = "10979";
	$list_lab_check[$i]["detail"] = "IPTH";

$i++;
	$list_lab_check[$i]["code"] = "ANA";
	$list_lab_check[$i]["detail"] = "ANCA";

$i++;
	$list_lab_check[$i]["code"] = "10617";
	$list_lab_check[$i]["detail"] = "C3";
	


$i++;
	$list_lab_check[$i]["code"] = "U-CR";
	$list_lab_check[$i]["detail"] = "Urine Cr";

$i++;
	$list_lab_check[$i]["code"] = "10623";
	$list_lab_check[$i]["detail"] = "C4";

$i++;
	$list_lab_check[$i]["code"] = "ASO";
	$list_lab_check[$i]["detail"] = "ASOtiter";

$i++;
	$list_lab_check[$i]["code"] = "U-PROT";
	$list_lab_check[$i]["detail"] = "Urine Protein";

$i++;
	$list_lab_check[$i]["code"] = "";
	$list_lab_check[$i]["detail"] = "";
	
$i++;
	$list_lab_check[$i]["code"] = "U-PROT24V";
	$list_lab_check[$i]["detail"] = "24 hr. Urine Vol";

$i++;
	$list_lab_check[$i]["code"] = "U-PROT24";
	$list_lab_check[$i]["detail"] = "24 hr. Urine Protien";
	
$i++;
	$list_lab_check[$i]["code"] = "10421";
	$list_lab_check[$i]["detail"] = "Urine Microalbumin";
	
	$r=5;
	$count = count($list_lab_check);

?>

<TABLE id="bock_lab" width="100%" border="1" bordercolor='#000000' cellpadding="3" cellspacing="0" style="display:none;">
<TR valign="top">
	<TD width="500">
	<CENTER><B>��¡�õ�Ǩ�ҧ��Ҹ�</B></CENTER>
<TABLE width="100%" align="left" border="0">
<TR  valign="top">
	<TD  colspan="<?php echo $r*2;?>" align='left' >��ǨLAB ���� �к� : <INPUT TYPE="text" NAME="" size="13" onkeypress="searchSuggest('lab',this.value,2);"><Div id="list"></Div></TD>
</TR>
<TR>
<?php
	for($i=1;$i<=$count;$i++){
		
		
		echo "<TD valign='top'><A HREF=\"javascript:void(0);\" onclick=\"addtolist('".jschars($list_lab_check[$i-1]["code"])."');\" >".jschars($list_lab_check[$i-1]["detail"])."</A></TD>";
		if($i%$r==0)
			echo "</TR><TR>";
	}
?>
</TR>
<TR>
	<TD colspan="<?php echo $r*2;?>">
	
		<?php
			/*$sql = "Select code, detail From labcare where left(code,3) ='DR@' ";
			$result = Mysql_Query($sql);
			if(Mysql_num_rows($result) > 0){
				echo "�ٵ� LAB<BR>";
			while($arr = Mysql_fetch_assoc($result)){
				$i=0;
				$list = array();
				$sql2 = "Select code From labsuit where suitcode = '".$arr["code"]."' ";
				$result2 = Mysql_Query($sql2);
				while($arr2 = Mysql_fetch_assoc($result2)){
					$list[$i] = $arr2["code"];
					$i++;
				}

				echo "<A HREF=\"#\" Onclick=\"addsuittolist('".implode("][",$list)."');\">".$arr["detail"]."</A><BR>";
			}		
			}*/
		?>
	</TD>
</TR>
</TABLE>
	
	</TD>
</TR>
</TABLE>

<?php  include("unconnect.inc");?>