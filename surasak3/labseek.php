

<?php
  
 session_start();
 global $code;
 session_register("sourcecode");
 if($_POST['bcode']!=""){
	$_SESSION['sourcecode']=$_POST['bcode'];
 }
	
 function jschars($str)
{
    $str = str_replace('"', '\\"', $str);

    return $str;
}



if(isset($_GET["action"]) && $_GET["action"] == "code"){
	include("connect.inc");
	
	$sql = "Select  code,detail,price,depart from labcare  where  code !='12723-sso' and code like '%".$_GET["search1"]."%' or detail 	 like '%".$_GET["search1"]."%' or codex 	 like '%".$_GET["search1"]."%' or icd9cm 	 like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute; top: 130px;text-align: left; width:350px; height:300px; overflow:auto; \">";

		echo "<table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\">
		<tr align=\"center\" bgcolor=\"#333333\">
		<td><strong>&nbsp;</strong></td>
		<td><font style=\"color: #FFFFFF;\"><strong>����</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>��¡��</strong></font></td>
		<td><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">�Դ</font></A></strong></td>
		</tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr>
		<td valign=\"top\"></td>
		<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value='",trim($se["code"]),"';document.getElementById('list').innerHTML ='';\">",$se["code"],"</A></td><td>".$se['detail']."</td><td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}


 include("connect.inc");
if($cDepart=="WARD"&$x==0){
	$x=0;
    $aDgcode = array("����");
    $aTrade  = array("��¡��");
    $aPrice  = array("�Ҥ� ");
    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
    $aMoney= array("       ����Թ   ");
    $Netprice="";   

    $aYprice = array("�Ҥ� ");
    $aNprice = array("�Ҥ� ");
    $aSumYprice = array("�Ҥ� ");
    $aSumNprice = array("�Ҥ� ");
	$aFilmsize= array("       ��Ҵ   ");
	$aPriority = $_POST["priority"];
    session_register("aYprice");
    session_register("aNprice");
    session_register("aSumYprice");
    session_register("aSumNprice");
	session_register("aFilmsize");
	session_register("aPriority");
}
if($_SESSION["until_login"] == "xray" && (!empty($_POST["xraydetail"]) && count($_POST["xraydetail"]) > 0)){
		session_register("cXraydetail");
		$_SESSION["cXraydetail"] = "";
		$count = count($_POST["xraydetail"]);

		for($i=0;$i<$count;$i++)
		$_SESSION["cXraydetail"] .= ($i+1).".".$_POST["xraydetail"][$i]."";


		$sql = "Select yot,name, surname, dbirth From opcard where hn ='".$cHn."' limit 0,1";
		list($yot, $name, $surname, $dbirth) = Mysql_fetch_row(Mysql_Query($sql));

				
		$query = "SELECT runno FROM runno WHERE title = 'xrayno' limit 0,1";
		$result = mysql_query($query) or die("Query failed");
		list($xray_no) = mysql_fetch_row($result);
		$xray_no++;
		 $query ="UPDATE runno SET runno = $xray_no WHERE title='xrayno' limit 1 ";
		$result = mysql_query($query) or die("Query failed");
		
		$sql = "INSERT INTO `xray_doctor` (`date` ,`hn` ,`vn` ,`yot` ,`name` ,`sname` ,`detail` ,`doctor` ,`status` ,`xrayno` ,`film` ,`type_diag`,`detail_all`,`dbirth`,`orderby`)VALUES ('".(date("Y")+543).date("-m-d H:i:s")."', '".$cHn."', '".$tvn."', '".$yot."', '".$name."', '".$surname."', '".$_SESSION["cXraydetail"]."', '".$_POST["doctor"]."', 'N', '".$xray_no."', 'digital', '".$_POST["diag"]."', '".$_SESSION["cXraydetail"]."', '".$dbirth."', 'XRAY');";
		
		mysql_query($sql);

		

		$_SESSION["nPrintXray"] = "<A HREF=\"xraydoctor_print.php?vn=".urlencode($tvn)."&hn=".urlencode($cHn)."&name=".urlencode($yot." ".$name." ".$surname)."&detail_all=".urlencode($_SESSION["cXraydetail"])."&doctor=".urlencode($_POST["doctor"])."&xrayno=".urlencode($xray_no)."\" target=\"_blank\">����� �����Ţ X-Ray</A>";

}
//$cPtright1
			$month["01"] = "���Ҥ�";
			$month["02"] = "����Ҿѹ��";
			$month["03"] = "�չҤ�";
			$month["04"] = "����¹";
			$month["05"] = "����Ҥ�";
			$month["06"] = "�Զع�¹";
			$month["07"] = "�á�Ҥ�";
			$month["08"] = "�ԧ�Ҥ�";
			$month["09"] = "�ѹ��¹";
			$month["10"] = "���Ҥ�";
			$month["11"] = "��Ȩԡ�¹";
			$month["12"] = "�ѹ�Ҥ�";
	//$date_n = date("d")." ".$month[date("m")]." ".(date("Y")+543);
	$date_n=$_SESSION['appday']." ".$month[$_SESSION['appmon']]." ".$_SESSION['appyr'];
	$sql = "Select labextra,other From appoint where appdate like '%".$date_n."%' AND apptime <> '¡��ԡ��ùѴ' AND hn = '".$cHn."' ";
	$result = mysql_query($sql) or die(mysql_error());
	list($labex,$other) = mysql_fetch_array($result);

$sqlemp="select * from opcardchk where HN='".$cHn."' and part='�١��ҧ60' and active='y'";
//echo $sqlemp;
$queryemp=mysql_query($sqlemp);
$numemp=mysql_num_rows($queryemp);
if($numemp > 0){  //������١��ҧ þ.
 echo "<font face='Angsana New' size='4'>HN : $cHn,<b>&nbsp;VN:$tvn&nbsp; $cPtname</b><br> �Է��: $cPtright, (�١��ҧ þ.�����)<br> ";
}else{
 echo "<font face='Angsana New' size='4'>HN : $cHn,<b>&nbsp;VN:$tvn&nbsp; $cPtname</b><br> �Է��: $cPtright <br> ";
}
 
 
 
if($_SESSION["smenucode"]=="ADM" || $_SESSION["smenucode"]=="ADMDEN" || $_SESSION["sOfficer"] == "˹��ķ�� ����ȹѹ�� (�.3448)" || $_SESSION["sOfficer"] == "���͡�� �Ҫ���� (�.5947)"){ 

	$dateid=(date("Y")+543)."-".date("m-d");	 
	$strsql2="select  * from  opday  where thidate like '$dateid%' and  hn='".$cHn."' and toborow='EX07 �ѹ�����'";
	//echo $strsql2;
	$strresult2= mysql_query($strsql2);
	$strrow2=mysql_num_rows($strresult2);
	$strrows=mysql_fetch_array($strresult2);	
	//echo "==>".$strrows["ptright"];	
	if($strrows["ptright"]=="R07 ��Сѹ�ѧ��"){	
	$chkdate=substr($dateid,0,4);
	$chksql="SELECT sum( denta ) AS pricedental, sum( other ) AS priceother
	FROM `opday`
	WHERE toborow = 'EX07 �ѹ�����' AND hn='".$cHn."' and (thidate like '$chkdate%')  AND `denta` >0 AND `other` >0";	
	//echo $chksql;
	$chkquery= mysql_query($chksql);
	$chknum=mysql_num_rows($chkquery);
	$chkrows=mysql_fetch_array($chkquery);
	$sumprice=$chkrows["pricedental"]+$chkrows["priceother"];
	$total=900-$sumprice;
		if($sumprice > 900){
			echo "<script>alert('����͹ : ������ HN : $cHn ���ʹ�����ҷ��ѵ���÷ѹ����� ��$chkdate �Թ 900 �ҷ/�� ����Է�Ի���ª��ͧ��Сѹ�ѧ������ �����¨е�ͧ�����Թ��ǹ�Թ�ͧ') </script>";
		}else{
			echo "<script>alert('����͹ : ������ HN : $cHn ���ʹ�����ҷ��ѵ���÷ѹ����� ��$chkdate ��� $sumprice �ҷ ����ö���Է�����ա $total �ҷ (�ӹǹ�Թ��������Ѻ�ѹ��� $dateid ����)') </script>";
		}	
	}
}

 
 echo $_SESSION["nPrintXray"];
// echo "<br>����觾���� $labex";
if($cDepart  == "PATHO"){
	if($labex!=""|| $other!=""){
		 echo "<br><font color='#FF0000' >����觾����: $labex <br>���� : $other</font>";
	?>
<script>
	alert("�դ���觾���ɤ�Ѻ");
	</script>
	<?
	}
}
?>

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
function searchSuggest(str,len,getto) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){

			url = 'labseek.php?action=code&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

</script>
<form method="POST" action="<?php echo $PHP_SELF ?>"> <font face="Angsana New"><a target=_BLANK href="codehlp.php">&#3619;&#3627;&#3633;&#3626;</a><Div id="list" style="left: 9px; top: 121px; position: absolute;"></Div>&nbsp;&nbsp;&nbsp;
<? if($_SESSION["sOfficer"]=="����ѵ�� �������"){?>
  <input type="text" name="code" size="8" id="aLink" value="42703" onkeypress="searchSuggest(this.value,2,'code');">
<? }else{ ?>
  <input type="text" name="code" size="8" id="aLink" onkeypress="searchSuggest(this.value,2,'code');">
 <? } ?> 
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>* <input type="text" name="amount" size="4" value="1">&nbsp;
  <?php if($_SESSION["until_login"] == "xray"){?>��Ҵ����� 
  <SELECT NAME="film_size">
  <OPTION value="DIGITAL">DIGITAL</OPTION>
	<OPTION value="10*12">10*12</OPTION>
	<OPTION value="14*17">14*17</OPTION>
    <? if($_SESSION["sOfficer"]=="����ѵ�� �������"){?>
	<OPTION value="NONE" selected="selected">NONE</OPTION>
    <? }else{ ?>
	<OPTION value="NONE">NONE</OPTION>
	<? } ?>
  </SELECT>
  <?php } ?>
  </font>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face="Angsana New" >
  <input type="submit" value="��ŧ" name="B1" style="height:40px; width:110px; font-size:16px;"></font></p>
</form><? //echo "==>$cDiag---->$aDetail";?>
*���<FONT COLOR="#FF6464">��ᴧ</FONT>���¶֧�¤Դ������������
<? //echo "==>".print_r($_POST);
//echo "==>".$_POST["code"];
//echo "==>".$_POST["amount"];
//echo "==>".$_SESSION["cPtright"];
?>
<table>
 <tr>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>��¡��</th>
  <th bgcolor=6495ED>�Ҥ����</th>
    <th bgcolor=6495ED>�ԡ�����</th>
 </tr>

<?php

 If (!empty($_POST["code"])){

	if($_POST["code"]=="12723" && $_POST["amount"]=="2500" && $_SESSION["cPtright"]=="R07 ��Сѹ�ѧ��"){
    $query = "SELECT code,depart,detail,price,nprice FROM labcare WHERE (code LIKE '".$_POST["code"]."%' or codelab LIKE '12723-sso')  ";	
	}else if($_POST["code"]=="12723"){
    $query = "SELECT code,depart,detail,price,nprice FROM labcare WHERE (code LIKE '".$_POST["code"]."%' or codelab = '".$_POST["code"]."')  ";	
	}else{   
    $query = "SELECT code,depart,detail,price,nprice FROM labcare WHERE (code LIKE '".$_POST["code"]."%' or codelab LIKE '".$_POST["code"]."%')  ";
	}
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($code,$depart,$detail,$price,$nprice) = mysql_fetch_row ($result)) {
		if(isset($_SESSION["list_codeed"][$code])){
			$color = "#FF6464";
		}else{
			$color = "#66CDAA";
		}

        print (" <tr>\n".
           "  <td BGCOLOR='$color'><a target='right'  href=\"labinfo.php? Dgcode=$code & Depart=$depart & Amount=$amount &Trade=".urlencode($detail)." & nPrice=$price&tvn=$tvn&films=".urlencode($film_size)."\">$code</a></td>\n".
           "  <td BGCOLOR='$color'>");
		   print $detail;
$priceall1=$price*$amount;
$npriceall1=$nprice*$amount;
		   print ("</td>\n".
           "  <td BGCOLOR='$color'>$priceall1</td>\n".
			   "  <td BGCOLOR='$color'>$npriceall1</td>\n".
           " </tr>\n");
		}
		 }

print ("</table>");
		if($cDepart  == "PATHO"){

			$month["01"] = "���Ҥ�";
			$month["02"] = "����Ҿѹ��";
			$month["03"] = "�չҤ�";
			$month["04"] = "����¹";
			$month["05"] = "����Ҥ�";
			$month["06"] = "�Զع�¹";
			$month["07"] = "�á�Ҥ�";
			$month["08"] = "�ԧ�Ҥ�";
			$month["09"] = "�ѹ��¹";
			$month["10"] = "���Ҥ�";
			$month["11"] = "��Ȩԡ�¹";
			$month["12"] = "�ѹ�Ҥ�";

			//$sql = "Select b.id, b.code From appoint as a, appoint_lab as b where appdate like '%".date("d")." ". $month[date("m")]."  ".(date("Y")+543)."%' AND apptime <> '¡��ԡ��ùѴ' AND hn = '".$cHn."' AND a.row_id = b.id ";
//$date_n = date("d")." ".$month[date("m")]." ".(date("Y")+543);
$date_n=$_SESSION['appday']." ".$month[$_SESSION['appmon']]." ".$_SESSION['appyr'];

$sql = "Select b.id, b.code From appoint as a, appoint_lab as b where appdate like '%".$date_n."%' AND apptime <> '¡��ԡ��ùѴ' AND hn = '".$cHn."' AND a.row_id = b.id ";

			$result = mysql_query($sql) or die(mysql_error());
			$row_app = mysql_num_rows($result);
			
			
			if($row_app > 0){
				$list_app = array();
				$code_app = "";
				while($arr = mysql_fetch_assoc($result)){
					array_push($list_app, $arr["code"]);
					$code_app = $arr["id"];
				}
				$code_app = "#".$code_app;

				echo "<BR><TABLE border='1' bordercolor=\"#330099\">
				<TR>
					<TD><table  width='300'>";
					echo "<tr  bgcolor=\"#000080\">";
						echo "<td colspan='2' align='center'><FONT COLOR=\"#FFFFFF\">��¡�ùѴ������ʹ</FONT></td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td  align='center' ><A target='right'  HREF=\"labinfo.php?Dgcode=".urlencode($code_app)."&Depart=$depart&Amount=1&tvn=$tvn\">�Դ�Թ</A></td>";
						echo "<td>",implode("<BR> ",$list_app),"</td>";
					echo "</tr>";
				echo "</table></TD>
				</TR>
				</TABLE>";

			}
		}

		if($cDepart  == "PATHO" ){


//$date_n1 = (date("Y")+543)."-".date("m")."-".date("d");
$date_n1=$_SESSION['appyr']."-".$_SESSION['appmon']."-".$_SESSION['appday'];
$sql1 = "Select code,an From lab_ward where date like '".$date_n1."%' AND  an = '".$tvn."' ";

			$result1 = mysql_query($sql1) or die(mysql_error());
			$row_app1 = mysql_num_rows($result1);
			
			
			if($row_app1 > 0){
				$list_app = array();
				$code_app = "";
				while($arr = mysql_fetch_assoc($result1)){
					array_push($list_app, $arr["code"]);
					$code_app = $arr["an"];
				}
				$code_app = "AN".$code_app;

				echo "<BR><TABLE border='1' bordercolor=\"#330099\">
				<TR>
					<TD><table  width='300'>";
					echo "<tr  bgcolor=\"#000080\">";
						echo "<td colspan='2' align='center'><FONT COLOR=\"#FFFFFF\">��¡�èҡ�ͼ�����</FONT></td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td  align='center' ><A target='right'  HREF=\"labinfo.php?Dgcode1=".urlencode($code_app)."&Depart=$depart&Amount=1&tvn=$tvn\">�Դ�Թ</A></td>";
						echo "<td>",implode("<BR> ",$list_app),"</td>";
					echo "</tr>";
				echo "</table></TD>
				</TR>
				</TABLE>";

			}
		}
		////////////////////////
		
		$sql ="SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright,lab FROM labdepart WHERE hn = '".$cHn."' and date LIKE '$date_n1%' and depart='PATHO' AND (lab = 'DR' OR lab = 'ER') ";
		//echo $sql;
		$result = mysql_query($sql) or die(mysql_error());
		$row_app = mysql_num_rows($result);
		
		if($row_app > 0){
			$query = "SELECT code,detail,amount,price,nprice FROM labpatdata WHERE date like  '$date_n1%' AND hn = '".$cHn."' ";
		//echo $query;
			$result1 = mysql_query($query) or die(mysql_error());
			
			$list_app = array();
			$code_app = "";
			while($arr = mysql_fetch_assoc($result1)){
				array_push($list_app, $arr["code"]);
				$code_app = $cHn;
			}
			$code_app = "HN".$code_app;

				echo "<BR><TABLE border='1' bordercolor=\"#330099\">
				<TR>
					<TD><table  width='300'>";
					echo "<tr  bgcolor=\"#000080\">";
						echo "<td colspan='2' align='center'><FONT COLOR=\"#FFFFFF\">��¡����觨ҡᾷ��</FONT></td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td  align='center' ><A target='right'  HREF=\"labinfo.php?Dgcode=".urlencode($code_app)."&Depart=$depart&Amount=1&tvn=$tvn\">�Դ�Թ</A></td>";
						echo "<td>",implode("<BR> ",$list_app),"</td>";
					echo "</tr>";
				echo "</table></TD>
				</TR>
				</TABLE>";

			}

		////////////////////////

		// �ʴ���¡�õ�Ǩ�آ�Ҿ Ẻ�����
		include 'includes/JSON.php';
		$today = date('Y-m-d');
		$sql = "SELECT `hn`,`list` 
		FROM `testmatch` 
		WHERE `hn` = '$cHn' 
		AND ( `date_start` <= '$today' AND `date_end` >= '$today' )";
		$q = mysql_query($sql) or die( mysql_error() );

		// ����բ���������㹪�ǧ�ͧ��õ�Ǩ ���ʴ���
		$test_row = mysql_num_rows($q);
		$item = mysql_fetch_assoc($q);

		$json = new Services_JSON();
		$json_list = $json->decode($item['list']);
		
		// var_dump($_SESSION["list_codeed"]);

		if( $test_row > 0 && count($json_list) > 0 ){

			// ���͹� 2 ��Ǵ�ҹ��ҧ hardcode 仡�͹
			// �����觨ҡ˹�Ңͧ lab �еѴ xray �͡�
			if( $_SESSION['until_login'] == 'LAB' && ( $search_key = array_search('41001-sso',$json_list) ) !== false ){
				unset($json_list[$search_key]);
			}

			// ����� xray �����੾�Тͧ����ͧ
			if( $_SESSION['until_login'] == 'xray' && ( $search_key = array_search('41001-sso',$json_list) ) !== false ){
				$json_list = array('41001-sso');
			}
			?>
			<br>
			<table border="1" bordercolor="#330099">
				<tr>
					<td>
						<table  width="300">
							<tr bgcolor="#000080">
								<td colspan="2" align="center">
									<font color="#FFFFFF">��¡�� ��Ǩ�آ�Ҿ��Сѹ�ѧ��</font>
								</td>
							</tr>
							<tr>
								<td align="center" >
									<?php
									$href = "labinfo.php?Dgcode=sso&Amount=1&tvn=$tvn&hn=$cHn";
									?>
									<a target="right" href="<?=$href;?>">�Դ�Թ</A>
								</td>
								<td>
									<?//=implode('<br>', $json_list);?>
									<?php
									foreach( $json_list as $test_key => $test_val ){
										// var_dump($test_val);
										$color = 'white';
										if( array_key_exists($test_val, $_SESSION["list_codeed"]) === true ){
											$color = 'red';
										}

										?>
										<span style="background-color: <?=$color;?>"><?=$test_val;?></span><br>
										<?php
									}
									?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<?php
		}
		
		// �ó� ����� walk-in ��� ���������Է�Ի�Сѹ�ѧ��
		$thdate_format = date('d-m-').( date('Y') + 543 ).$cHn;
		$sql = "SELECT SUBSTRING(a.`age`, 1, 2) AS `age_year`, 
		SUBSTRING(a.`ptright`, 1, 3) AS `ptright_code`, 
		SUBSTRING(a.`toborow`, 1, 4) AS `ex_code`, 
		SUBSTRING(b.`dbirth`, 1, 4) AS `dbirth`, 
		b.`sex`
		FROM `opday` AS a 
		LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
		WHERE a.`thdatehn` = '$thdate_format' ";
		$q = mysql_query($sql);
		$test_checkup = mysql_fetch_assoc($q);

		// ��ͧ��ҹ����¹����͡ opdcard �� ex42
		if( $test_checkup['ptright_code'] == 'R07' && $test_checkup['ex_code'] == 'EX42' ){
			
			include 'includes/cu_sso.php';

			$user_gender = trim($test_checkup['sex']);
			$sex = ( $user_gender === '�' ) ? 1 : 2 ;
			$year_birth = $test_checkup['dbirth'];

			$sso = new CU_SSO();
			$sso->find_package_from_age($cHn, $year_birth, $test_checkup['age_year'], $sex);
			$can_check = $sso->get_code();

			$all_lists = $sso->get_checkup_from_age($test_checkup['age_year'], $year_birth, $sex);

			// ���͹� 2 ��Ǵ�ҹ��ҧ hardcode 仡�͹
			// �����觨ҡ˹�Ңͧ lab �еѴ xray �͡�
			if( $_SESSION['until_login'] == 'LAB' && ( $search_key = array_search('41001-sso',$all_lists) ) !== false ){
				unset($all_lists[$search_key]);
			}

			// ����� xray �����੾�Тͧ����ͧ
			if( $_SESSION['until_login'] == 'xray' && ( $search_key = array_search('41001-sso',$all_lists) ) !== false ){
				$all_lists = array('41001-sso');
			}

			?>
			<style>
			.sso-help{
				cursor: pointer;
			}
			</style>
			<table border="1" cellspacing="0">
				<tr style="background-color: #d2d2d2;">
					<td>��¡�õ�Ǩ����Ѻ������ �Է�Ի�Сѹ�ѧ��</td>
					
				</tr>
				<?php
				foreach( $all_lists as $key => $val ){

					$bg = 'background-color: #E91E63;';
					$help_class = '';
					if( in_array($val, $can_check) === true ){
						$bg = 'background-color: #4caf50;';
						$help_class = 'sso-help';
					}

					?>
					<tr align="center" style="<?=$bg;?>">
						<td class="<?=$help_class;?>" onclick="add_to_code('<?=$val;?>')"><?=$val;?></td>
					</tr>
					<?php
				}
				?>
			</table>
			<script>
				function add_to_code(str){
					document.getElementById('aLink').value = str;
				}
			</script>
			<?php
		}

	include("unconnect.inc");
?>




