<?php
session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}

include 'connect.inc';

$limit30checkday = 30;
$sql = "CREATE TEMPORARY TABLE drugrx_notinj SELECT row_id FROM drugrx WHERE hn = '".$_SESSION["hn_now"]."' AND drugcode <> 'INJ' AND 
(
	(left( drugcode, 1 ) = '0' AND drug_inject_amount ='' AND drug_inject_slip ='' AND  drug_inject_type ='' )
	OR
	(left( drugcode, 1 ) = '2' AND right( left( drugcode, 2 ) , 1 ) NOT IN ('0', '1', '2', '3', '4', '5', '6', '7', '8', '9') AND drug_inject_amount ='' AND drug_inject_slip ='' AND  drug_inject_type ='')
)";
$result = Mysql_Query($sql) or die(mysql_error());

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}


//******************************* เรียกข้อมูลจาก SESSION มาแสดงเป็น Form ********************

if(isset($_GET["action"]) && $_GET["action"] == "viewtolist"){
	$count = count($_SESSION["list_drugcode"]);
	echo "<FORM name=\"form_list\" METHOD=POST ACTION=\"ward_tranrx.php\" >";

	
	$sql = "Select idname From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1 ";
	list($sld) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select row_id From dr_drugsuit where code_dr = '".$sld."' limit 1";
	
	$rows = mysql_num_rows(Mysql_Query($sql));
	if($rows > 0)

	echo "<TABLE width='100%'>";
	echo "
			<TR class='tb_head'>
				<TD><INPUT TYPE=\"checkbox\" NAME=\"all\" onclick=\"checkall2(this.checked)\"></TD>
				<TD>ชื่อยา</TD>
				<TD>จำนวน</TD>
				<TD>หน่วย</TD>
				<TD>วิธีใช้</TD>
				<TD>&nbsp;</TD>
			</TR>
			";
	$count = count($_SESSION["list_drugcode"]);
	$pricetype["DDL"] = 0;
	$pricetype["DDY"] = 0;
	$pricetype["DPY"] = 0;
	$pricetype["DSY"] = 0;
	$pricetype["DDN"] = 0;
	$pricetype["DSN"] = 0;
	$pricetype["DPN"] = 0;
	$total_item=0;
	$Netprice = 0;

for($i=0;$i<$count;$i++){
	$times = mktime("0","0","0",date("m"),date("d")-$limit30checkday,date("Y"));
	$date1 = (date("Y",$times)+543).date("-m-d H:i:s",$times);
	$date2 = (date("Y")+543).date("-m-d H:i:s");

	$remark = array();
	$sql = "Select tradname, unit, stock, salepri, freepri, part, medical_sup_free  From druglst  where drugcode = '".$_SESSION["list_drugcode"][$i]."' limit 1";
	$result = Mysql_Query($sql);
	list($drugname,$unit, $stock, $salepri, $freepri, $part, $medical_sup_free) = Mysql_fetch_row($result);
				
				if($_SESSION["list_drugamount"][$i] > 0){
					if($part == "DPY"){
						
						if($freepri > $salepri)
							$freepri = $salepri;

						$pricetype["DPY"]= $pricetype["DPY"] + ($freepri * $_SESSION["list_drugamount"][$i]); 
						$pricetype["DPN"]=$pricetype["DPN"] + (($salepri - $freepri) * $_SESSION["list_drugamount"][$i]);

					}else if($part == "DSY"){
						
						if($freepri > $salepri)
							$freepri = $salepri;

						if($medical_sup_free ==0){
							$pricetype["DSN"]=$pricetype["DSN"] + ($salepri * $_SESSION["list_drugamount"][$i]);
						}else{
							$pricetype["DSY"]= $pricetype["DSY"] + ($freepri * $_SESSION["list_drugamount"][$i]); 
							$pricetype["DSN"]=$pricetype["DSN"] + (($salepri - $freepri) * $_SESSION["list_drugamount"][$i]);
						}

					}else{
						$pricetype[$part] = $pricetype[$part] + ($salepri * $_SESSION["list_drugamount"][$i]);
					}

					$total_price = $total_price+ ($salepri * $_SESSION["list_drugamount"][$i]);
					if($_SESSION["list_drugcode"][$i] != "INJ");
						$total_item++;
					$Netprice = 	$Netprice + ($salepri * $_SESSION["list_drugamount"][$i]);
				}

			array_push($remark,"<FONT style=\"font-size: 20;\" color=\"#000000\"> ".$detail1." ".$detail2." ".$detail3." ".$detail4."</FONT>");

			if(count($remark) > 0){
				$list_remark = implode("<BR>",$remark);
			}

			if($part == "DDY"){
				$style=" style=\"color:#0000FF\" ";
			}elseif($part == "DDN"||$part == "DSN"||$part == "DPN"){
				$style = " style=\"color:#FF0000\" ";
			}else{
				$style="";	
			}
			
			if($part == "DDY"){
				if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F"){
					
					if($part == "DDY"){
						$pricetype["DDN"]+=($salepri * $_SESSION["list_drugamount"][$i]);//บวกราคาใหม่
						$pricetype["DDY"]-=($salepri * $_SESSION["list_drugamount"][$i]);//ลบราคาเก่าออก
					}
					
					$part="DDN";
					
				}else{
					echo "<INPUT TYPE=\"hidden\" name=\"ddnnew\" value=\"$i\">";
				}
			}
			//แก้ช่อง textbox จำนวน <TD align='right'><input name='piece$i' value='".$_SESSION["list_drugamount"][$i]."' type='text' size=3> &nbsp;&nbsp;</TD>
			//แก้ช่องวิธีใช้ <input name='act$i' value='".$_SESSION["list_drugslip"][$i]."' type='text' size=5 onKeyPress=addslip2('slip2',this.value,2,$i); >
			echo "
			<TR  class='tb_detail' ".$style.">
				<TD align=\"center\"><INPUT TYPE=\"checkbox\" NAME=\"check_list[]\" value=\"".$i."\"></TD>
				<TD>&nbsp;&nbsp;<span style=\"CURSOR: pointer\" OnmouseOver = \"show_tooltip('รายละเอียดยา','&nbsp;&nbsp;&nbsp;<B>",substr($drugname,0,10),"</B>&nbsp;&nbsp;&nbsp;<BR>สต็อก : ",$stock," ",$unit,"<BR>ราคา : ".$salepri." บาท <BR>PART : ".$part." ','left',-200,-180);\" OnmouseOut = \"hid_tooltip();\">",$drugname," (ราคา ",($salepri * $_SESSION["list_drugamount"][$i])," บาท)</span><BR>".$list_remark."</TD>
				<TD align='right'>".$_SESSION["list_drugamount"][$i]."</TD>
				<TD>",$unit,"</TD>
				<TD><span style=\"CURSOR: pointer\" OnmouseOver = \"show_tooltip('วิธีใช้ยา','",$detail1."<BR>".$detail2."<BR>".$detail3."<BR>".$detail4,"','center',-200,-180);\" OnmouseOut = \"hid_tooltip();\">".$_SESSION["list_drugslip"][$i]."</span></TD>
				<TD align='center'><A HREF=\"#\" Onclick=\"javascript : document.getElementById('drug_code').value='",jschars($_SESSION["list_drugcode"][$i]),"';document.getElementById('drug_amount').value='",jschars($_SESSION["list_drugamount"][$i]),"';document.getElementById('drug_slip').value='",jschars($_SESSION["list_drugslip"][$i]),"';document.getElementById('addoredit').value='".$i."';
				if(check_inject('",jschars($_SESSION["list_drugcode"][$i]),"') == true){
					
			document.getElementById('drug_slip').value='b';
			document.getElementById('slip_detail').style.display = 'none';
			
			document.form1.drug_inject_amount.value = '",jschars($_SESSION["list_drug_inject_amount"][$i]),"';

				}else{
			document.getElementById('slip_detail').style.display = '';	
					
				}";
			echo "\">แก้ไข</A></TD>
			</TR>
			";

	}
	if($i >0)
	echo "<TR class='tb_detail'>
					<TD   colspan=\"6\">&nbsp;&nbsp;รวมทั้งหมด : ".($total_price)." บาท</TD>
				</TR>";

	echo "<TR class='tb_detail'>
					<TD  align=\"center\" ><INPUT TYPE=\"button\" value=\"  ลบ  \" onclick=\"del_list();\"></TD>
					<TD  colspan=\"5\">";

	echo "<div  align=\"center\"><INPUT TYPE=\"submit\" value=\"      ตกลง      \" ></div></TD></TR>";
	$phar = $pricetype["DDL"]+$pricetype["DDY"]+$pricetype["DDN"];
	echo "</TABLE>


		<INPUT TYPE=\"hidden\" name=\"DDL\" value=\"",$pricetype["DDL"],"\">
		<INPUT TYPE=\"hidden\" name=\"DDY\" value=\"",$pricetype["DDY"],"\">
		<INPUT TYPE=\"hidden\" name=\"DPY\" value=\"",$pricetype["DPY"],"\">
		<INPUT TYPE=\"hidden\" name=\"DSY\" value=\"",$pricetype["DSY"],"\">
		<INPUT TYPE=\"hidden\" name=\"DDN\" value=\"",$pricetype["DDN"],"\">
		<INPUT TYPE=\"hidden\" name=\"DSN\" value=\"",$pricetype["DSN"],"\">
		<INPUT TYPE=\"hidden\" name=\"DPN\" value=\"",$pricetype["DPN"],"\">
		<INPUT TYPE=\"hidden\" name=\"totalitem\" value=\"",$total_item,"\">
		<INPUT TYPE=\"hidden\" name=\"Netprice\" value=\"",$Netprice,"\">
		<INPUT TYPE=\"hidden\" id=\"total_all_price\" value=\"",$total_price,"\">
		<INPUT TYPE=\"hidden\" id=\"total_phar_price\" value=\"",$phar,"\">
		
	</FORM>";
	exit();
}

// ********************************* บันทึกข้อมูลยา ลงในรายการ SESSION *****************************************
if(isset($_GET["action"]) && $_GET["action"] == "addtolist"){
	
	$count = count($_SESSION["list_drugcode"]);
	
	$sql = "Select part From druglst Where drugcode = '".$_GET["drugcode"]."' limit 1";
	$result = Mysql_Query($sql);
	list($part) = Mysql_fetch_row($result);
	

	if($_GET["addoredit"] != "E"){
		$add = false;
		
				$_SESSION["list_drugcode"][$_GET["addoredit"]] = $_GET["drugcode"];
				$_SESSION["list_drugamount"][$_GET["addoredit"]] = $_GET["drugamount"];
				$_SESSION["list_drugslip"][$_GET["addoredit"]] = $_GET["drugslip"];

	}else{
		$add = true;

	}

	if($add){

		array_push($_SESSION["list_drugcode"],$_GET["drugcode"]);
		array_push($_SESSION["list_drugamount"],$_GET["drugamount"]);
		array_push($_SESSION["list_drugslip"],$_GET["drugslip"]);

		$count = count($_SESSION["list_drugcode"]);

	}
	exit();
}


// ********************************* ดึกรายการยาเดิมออกมาแสดงเพื่อทำการแก้ไข *****************************************
if(isset($_GET["action"]) && $_GET["action"] == "listdrugprov"){
	
	$_SESSION["list_drugcode"] = array() ;
	$_SESSION["list_drugamount"] = array() ;
	$_SESSION["list_drugslip"] = array() ;

	$sql = " Select row_id, item, stkcutdate From dphardep where hn = '".$_SESSION["hn_now"]."' AND whokey = 'DR' AND idname='".$_SESSION["dt_doctor"]."' AND date like '".((date("Y")+543).date("-m-d"))."%' Order by row_id DESC limit 1";
	$result = Mysql_Query($sql);
	list($id, $item, $stkcutdate) = Mysql_fetch_row($result);
	
	if($stkcutdate)
	session_register("cancle_row_id");
	$_SESSION["cancle_row_id"] = $id;

	$sql = "Select drugcode, amount, slcode, drug_inject_amount, drug_inject_unit, drug_inject_time,  drug_inject_slip,  drug_inject_type,  drug_inject_etc, reason   From ddrugrx where idno = '".$id."' AND hn='".$_SESSION["hn_now"]."' AND  date like '".((date("Y")+543).date("-m-d"))."%' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($_SESSION["list_drugcode"],$arr["drugcode"]);
		array_push($_SESSION["list_drugamount"],$arr["amount"]);
		array_push($_SESSION["list_drugslip"],$arr["slcode"]);

	}
	
	if($_SESSION["nRunno"] == ""){

		$query = "SELECT runno FROM runno WHERE title = 'phardep' limit 0,1";
		$result2 = mysql_query($query) or die("Query failed");
		list($_SESSION["nRunno"]) = mysql_fetch_row($result2);
		 $_SESSION["nRunno"]++;
		
		$query ="UPDATE runno SET runno = ".$_SESSION["nRunno"]." WHERE title='phardep'";
		$result2 = mysql_query($query) or die("Query failed");

	}

	exit();
}

//************************** ลบยา ออกจาก SESSION ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "deltolist"){
	
	$count = count($_SESSION["list_drugcode"]);

	for($i=$_GET["number"];$i<$count-1;$i++){
		
			$_SESSION["list_drugcode"][$i] = $_SESSION["list_drugcode"][$i+1];
			$_SESSION["list_drugamount"][$i] = $_SESSION["list_drugamount"][$i+1];
			$_SESSION["list_drugslip"][$i] = $_SESSION["list_drugslip"][$i+1];
		
	}

	unset($_SESSION["list_drugcode"][$count-1]);
	unset($_SESSION["list_drugamount"][$count-1]);
	unset($_SESSION["list_drugslip"][$count-1]);
	exit();
}

//************************** แสดงรายการยาให้เลือก  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "drug"){
	
	$sql = "Select prefix From `runno` where `title`  = 'passdrug' limit 1 ";
	list($pass_drug) = mysql_fetch_row(mysql_query($sql));
	//$sql = "Select drugcode, tradname, genname,unit, stock, salepri, part, `lock`, lock_dr From druglst where ".$where." (drugcode like '%".$_GET["search"]."%' OR genname LIKE '%".$_GET["search"]."%' OR  tradname LIKE '%".$_GET["search"]."%') and (part!='DDL' and part!='DDY' and part!='DDN' ) Order by drugcode ASC";

	// ไม่แสดงชื่อ tradname ที่มี (Z) Ward บอกพี่วามาอีกที
	$sql = "SELECT `drugcode`,`tradname`,`genname`,`unit`,`stock`,`salepri`,`part`,`lock`,`lock_dr` 
	FROM `druglst` 
	WHERE `drugcode` LIKE '".$_GET["search"]."%' 
	AND `tradname` NOT LIKE '%(Z)%' 
	AND ( `part` != 'DDL' AND `part` != 'DDY' AND `part` != 'DDN' ) 
	ORDER BY `drugcode` ASC ";
	$result = mysql_query($sql) or die(mysql_error());

	if( mysql_num_rows($result) > 0 ){
		?>
		<Div style="position: absolute;text-align: left; width:770px; height:430px; overflow:auto;">
		<table bgcolor="#FFFFCC" width="750" border="0" cellpadding="0" cellspacing="0">
		<tr align="center" bgcolor="#3333CC">
			<td width="20">
				<font style="color: #FFFFFF"></font>
			</td>
			<td width="73">
				<font style="color: #FFFFFF"></font>
			</td>
			<td width="368">
				<font style="color: #FFFFFF"><strong>ชื่อยา</strong></font>
			</td>
			<td width="110">
				<font style="color: #FFFFFF"><strong>หน่วย</strong></font>
			</td>
			<td width="">
				<font style="color: #FFFFFF"><strong>เหลือยา</strong></font>
			</td>
			<td width="79">
				<font style="color: #FFFFFF"><strong>ราคา</strong></font>
			</td>
			<td width="24" bgcolor="#3333CC">
				<font style="color: #FF0000;">
					<strong><A HREF="#" onclick="document.getElementById('list').innerHTML='';">X</A></strong>
				</font>
			</td>
		</tr>
		<?php
		$i=1;
		while($arr = Mysql_fetch_assoc($result)){

			$obj = "<INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13)add_drug('".trim($arr["drugcode"])."'); \" onclick=\"add_drug('".trim($arr["drugcode"])."'); \">";
			$alert="";

			if($i%2==0)
				$bgcolor="#FFFFFF";
			else
				$bgcolor="#FFFFCC";
			
			if($arr["part"] == "DDY"){
				$style = " style='color:#0000FF;' ";
			}elseif($arr["part"] == "DDN"||$arr["part"] == "DSN"||$arr["part"] == "DPN"){
				$style = " style='color:#FF0000;' ";
			}else{
				$style = "";
			}

			$arr["genname"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["genname"]);
			$arr["tradname"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["tradname"]);

			$stock = (int) $arr["stock"];
			?>
			<tr bgcolor="<?=$bgcolor;?>" <?=$style;?>>
				<td rowspan="3" align="center"><?=$obj;?></td>
				<td align="right" bgcolor="<?=$bgcolor;?>">ชื่อสามัญ : </td>
				<td bgcolor="<?=$bgcolor;?>"><?=$arr["genname"];?></td>
				<td rowspan="2" bgcolor="<?=$bgcolor;?>" align="center"><?=$arr["unit"];?></td>
				<td colspan="2" rowspan="2" bgcolor="<?=$bgcolor;?>"><?php echo ( $stock > 0 ) ? $stock : 0 ;?></td>
				<td colspan="2" rowspan="2" bgcolor="<?=$bgcolor;?>"><?=$arr["salepri"];?></td>
			</tr>
			<tr <?=$style;?>>
				<td align="right" bgcolor="<?=$bgcolor;?>">ชื่อการค้า : </td>
				<td bgcolor="<?=$bgcolor;?>"><?=$arr["tradname"];?></td>
			</tr>
			<tr >
				<td colspan="4" bgcolor="<?=$bgcolor;?>"><?=$alert;?></td>
			</tr>
			<tr bgcolor="#A45200">
				<td height="5"></td>
				<td height="5"></td>
				<td height="5"></td>
				<td height="5"></td>
				<td height="5"></td>
				<td height="5"></td>
				<td height="5"></td>
				<td height="5"></td>
			</tr>
			<?php
			$i++;
		}
		
		?>
		</TABLE></Div>
		<?php
	}

	exit();
}

//************************** แสดงรายการวิธีใช้ยาให้เลือก  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "slip"){

	$sql = "Select detail1, detail2, detail3, detail4, slcode  From drugslip where  (slcode LIKE '%".$_GET["search"]."%') OR (detail1 LIKE '%".$_GET["search"]."%') OR (detail2 LIKE '%".$_GET["search"]."%') OR (detail3 LIKE '%".$_GET["search"]."%')  Order by slcode ASC ";
	$result = Mysql_Query($sql);
	if(Mysql_num_rows($result) > 0){
		$i=" id='choice1' ";
		echo "<Div style=\"position: absolute;text-align: left; width:720px; height:400px; overflow:auto; \"><TABLE width=\"100%\" bgcolor=\"#FFFFCC\"><TD align=\"center\" bgcolor=\"#3333CC\" width=\"460\"><FONT COLOR=\"#FFFFFF\"><B>รายการวิธีใช้ยา</B></FONT></TD><TD  bgcolor=\"red\" align=\"center\"><FONT COLOR=\"#FFFFFF\"><B><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></B></FONT></TD>";
		while($arr = Mysql_fetch_assoc($result)){
			echo "<TR bgcolor=\"#FFFFCC\">
					<TD colspan=\"2\"><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13)addslip('",$arr["slcode"],"'); \" ondblclick=\"addslip('",$arr["slcode"],"'); \" >&nbsp;",$arr["detail1"]," ",$arr["detail2"]," ",$arr["detail3"]," ",$arr["detail4"],"</TD>
				</TR>
			<TR height=\"3\" bgcolor=\"#FFFFFF\"><TD colspan=\"2\"></TD></TR>";
		}
		echo "</TABLE></Div>";
	}
	exit();
}



//******************************************** ตรวจสอบรหัสยา *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkdrugcode"){

	$sql = "SELECT count(drugcode) as amountcode FROM `druglst` where drugcode = '".$_GET["search"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	
	$sql = " Select row_id FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."'  AND drugcode = '".$_GET["search"]."' ";
	$result = Mysql_Query($sql);
	if(Mysql_num_rows($result) > 0){
		echo "3";
	}else if($arr["amountcode"] > 0){
		echo "1";
	}else{
		echo "0";
	}
exit();
}

//******************************************** ตรวจสอบรหัสวิธีใช้ยา *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkdrugslip"){

	$sql = "SELECT count(slcode) as amountcode FROM `drugslip` where slcode = '".$_GET["search"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	echo $arr["amountcode"];
exit();
}
/////////////////////////////////////////

#### click drug list ####
if(isset($_GET["action"]) && $_GET["action"] == "addamount"){

	$limit_date = mktime(0,0,0,date("m")-2,date("d"),date("Y"));
	$sql = "Select count(row_id) From drugrx where drugcode = '".$_GET["search"]."' AND date BETWEEN '".(date("Y",$limit_date)+543).date("-m-d H:i:s",$limit_date)."' AND '".(date("Y")+543).date("-m-d H:i:s")."' ";
	
	list($limit_row) = mysql_fetch_row(mysql_query($sql));
	
	if($limit_row > 30)
		$limit_row = 30;

	$sql = "CREATE TEMPORARY TABLE drugrx2 Select slcode, drugcode, amount From  `drugrx` where drugcode = '".$_GET["search"]."' Order by row_id DESC  limit ".$limit_row;
	$result = Mysql_Query($sql);

	$sql = "SELECT amount, count( amount ) FROM `drugrx2` where amount > 0 GROUP BY amount Order by `count( amount )` DESC limit 1";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	echo $arr["amount"].",";

	$sql = "SELECT slcode , count(slcode) FROM `drugrx2` where  amount > 0 AND slcode != 'er' AND slcode != 'hd'  GROUP BY slcode  Order by `count(slcode)` DESC limit 1";
	$result = Mysql_Query($sql) or die(Mysql_ERROR());
	$arr = Mysql_fetch_assoc($result);
	echo $arr["slcode"];
	

	$sql = "Select part From druglst Where drugcode = '".$_GET["search"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($part) = Mysql_fetch_row($result);
	echo ",".$part;
	exit();
}
####  ####
//**********************************************************************************************
?>
<html>
<head>
<title>เบิกเวชภัณฑ์</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFC1; color:#0000FF; }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>

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

// แสดงรายการยา
function searchSuggest(action,str,len) {

	if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){
		document.getElementById('choice').focus();
		document.getElementById('choice').checked = true;
		return false; 
	}
	// str = str+String.fromCharCode(event.keyCode);

	if(str.length >= len){
		url = 'ward_rx.php?action='+action+'&search=' + str;

		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);

		document.getElementById("list").innerHTML = xmlhttp.responseText;
	}
}


function clearobt(nameojt){
	for(i=document.form1.reason.options.length;i>=0;i--){
		document.form1.reason.remove(i);
	}
}

function add_drug(drugcode){
	
	var returnstr;

	xmlhttp = newXmlHttp();

	document.getElementById("drug_code").value = drugcode;
	url = 'ward_rx.php?action=addamount&search=' + drugcode;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	
	returnstr = xmlhttp.responseText;
	var vl = returnstr.split(",");
	document.getElementById("drug_amount").value = vl[0];


	document.getElementById("drug_slip").value = vl[1];
	document.getElementById('list').innerHTML='';
	document.getElementById("drug_amount").select();
		
}


function ajaxcheck(action,str){
	
	xmlhttp = newXmlHttp();
	url = 'ward_rx.php?action='+action+'&search=' + str;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return xmlhttp.responseText;
}

function viewlist(){

	xmlhttp = newXmlHttp();
	url = 'ward_rx.php?action=viewtolist';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("druglist").innerHTML = xmlhttp.responseText;

}

function addslip(drugslip){
	
	document.getElementById("drug_slip").value = drugslip;
	document.getElementById('list').innerHTML='';
	document.getElementById("form_submit").focus();
}


function addtolist(drugcode, drugamount, drugslip,addoredit){
	
	xmlhttp = newXmlHttp();
	url = 'ward_rx.php?action=addtolist&drugcode=' + drugcode+'&drugamount='+drugamount+'&drugslip='+drugslip+'&addoredit='+addoredit;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();

}


function del_list(){
	xmlhttp = newXmlHttp();
	for(i=0;i<eval(document.form_list.elements.length);i++){

		if(document.form_list.elements[i].name == "check_list[]" && document.form_list.elements[i].checked == true){
			url = 'ward_rx.php?action=deltolist&number=' + document.form_list.elements[i].value;
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			
		}

	}
	viewlist();
	if(document.form_list.elements.length=="13"){
		count=0;
	}
}

function checkall2(xxx){
	
		for(i=0;i<eval(document.form_list.elements.length);i++){

			if(document.form_list.elements[i].name == "check_list[]" ){
				document.form_list.elements[i].checked = xxx;
			}
		}
}


function checkForm1(){
	var txt ;
	var txt2 ;

	txt = ajaxcheck("checkdrugcode",document.form1.drug_code.value);
	txt = txt.substr(4);

	if(document.form1.drug_code.value == ""){
		alert("กรุณาใส่รหัสยา");
		document.form1.drug_code.focus();
	}else if(document.form1.drug_amount.value == "" || eval(document.form1.drug_amount.value) <=0){
		alert("กรุณาใส่จำนวนยา");
		document.form1.drug_amount.focus();
	}else if(document.form1.drug_slip.value == ""){
		alert("กรุณาใส่วิธีใช้ยา");
		document.form1.drug_slip.focus();
	}else{
		
		addtolist(document.form1.drug_code.value,document.form1.drug_amount.value,document.form1.drug_slip.value,document.form1.addoredit.value);			

		//drug_cc= document.form1.drug_code.value;
		document.form1.drug_code.value = "";
		document.form1.drug_amount.value = "";
		document.form1.drug_slip.value = "";
		document.form1.addoredit.value = "E";
		document.form1.drug_code.focus();
		
	}


}

/**************************************************************************************************/


function check_number() {
e_k=event.keyCode
	//if (e_k != 47 && e_k != 46 && (e_k < 48) || (e_k > 57)) {
	if ((e_k < 48) || (e_k > 57)) {
		event.returnValue = false;
		alert("กรุณากรอกเป็นตัวเลขเท่านั้นค่ะ");
		return false;
	}else{
		return true;
	}
}

function checkall(xx){
	
	var max = document.form_remed.totalcheck.value;
	
	for(i=1;i<=max;i++){
		document.getElementById("drug_remed"+i).checked = xx;
	}

}

function checkall4(xx){
	 
	var max = document.form_remed2.totalcheck2.value;
	
	for(i=1;i<=max;i++){
		document.getElementById("drug_remed2"+i).checked = xx;
	}

}
function checkall3(xx){
	
	var max = document.form_sult.totalcheck.value;
	
	for(i=1;i<=max;i++){
		document.getElementById("drug_sult"+i).checked = xx;
	}

}


</SCRIPT>
</head>
<body>

<!-- <a href='../nindex.htm'>&lt;&lt;ไปเมนู</a><BR>
<A HREF="dt_index.php">&lt;&lt; เลือกผู้ป่วยใหม่</A> -->

<TABLE align="center" border="1" bordercolor="#F0F000">
  <TR>
    <TD><TABLE width="900">
      <TR>
        <TD colspan="8" class="tb_head">ข้อมูลผู้ป่วย&nbsp;&nbsp;<?php echo $toborow;?></TD>
      </TR>
      <TR>
        <TD align="right" class="tb_detail">AN : </TD>
        <TD><?php echo $_SESSION["cAn"];?></TD>
        <TD align="right" class="tb_detail">ชื่อ-สกุล : </TD>
        <TD><?php echo $_SESSION["ptname_ipd"];?></TD>
        <TD align="right" class="tb_detail">อายุ : </TD>
        <TD><?php echo $_SESSION["age_ipd"];?></TD>
        <TD align="right" class="tb_detail">สิทธิการรักษา : </TD>
        <TD><?php echo $_SESSION["ptright_ipd"];?></TD>
      </TR>
    </TABLE></TD>
  </TR>
</TABLE>
<br>
<TABLE border="0" width="100%">
  <TR>
	<TD width="240" valign="top">
	<script>
	// if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){
	// 	document.getElementById('choice').focus();
	// 	document.getElementById('choice').checked = true;
	// 	return false; 
	// }
	</script>
<FORM Name="form1" METHOD="post" ACTION="" Onsubmit=" return false;">
<TABLE width="98%" border="1" bordercolor="#F0F000">
<TR>
	<TD>
<TABLE width="232" border="0">
<TR>
	<TD align="right" class="tb_detail">ยา : </TD>
	<TD><INPUT ID="drug_code" TYPE="text" NAME="drug_code" onkeyup="searchSuggest('drug',this.value,3);"></TD>

</TR>
<TR>
	<TD align="right" class="tb_detail">จำนวน : </TD>
	<TD><INPUT  ID="drug_amount" TYPE="text" NAME="drug_amount"  size="5" onkeypress = "if(event.keyCode == 13){ checkForm1(); return false; }else{ check_number();}"  > </TD>
</TR>
<TR ID="slip_detail" style="display:">
	<TD align="right" class="tb_detail">วิธีใช้ : </TD>
	<TD><INPUT ID="drug_slip" TYPE="text" NAME="drug_slip" onKeyPress="if(event.keyCode == 13){ checkForm1(); return false; }else{ searchSuggest('slip',this.value,2);} " onKeyDown="if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"></TD>
</TR>
<TR>
  <TD align="center" colspan="2"><INPUT id="form_submit" TYPE="submit" value="   ตกลง    " onClick="checkForm1();" onKeyPress="if(event.keyCode == 13) checkForm1(); return false;" onKeyDown="if(event.keyCode == 38){document.form1.drug_slip.focus();}">&nbsp;<INPUT TYPE="button" value="ยกเลิก" onClick="document.getElementById('drug_code').value='';document.getElementById('drug_amount').value='';document.getElementById('drug_slip').value='';document.getElementById('addoredit').value='E';"><Div id="list" ></Div>
    </TD>
</TR>
</TABLE>
<?php 
$sql = " Select row_id, item, stkcutdate From dphardep where hn = '".$_SESSION["hn_now"]."' AND whokey = 'DR' AND idname='".$_SESSION["dt_doctor"]."' AND date like '".((date("Y")+543).date("-m-d"))."%' Order by row_id DESC limit 1 ";
	$result = Mysql_Query($sql);
	if(mysql_num_rows($result) >0 ){
		$arr = Mysql_fetch_assoc($result);

		if($arr["stkcutdate"] == "00:00:00" || $arr["stkcutdate"] == ""){
			$onclick = "listdrugprov();";
		}else{
			$onclick = "alert('รายการยาได้ถูกตัดสต๊อกแล้ว ให้ผู้ป่วยยกเลิกรายการยาที่ห้องยาก่อน จึงจะสามารถปรับปรุงรายการยาได้');";
		}

		//echo "<CENTER><A HREF=\"#\" onclick=\"".$onclick."\">ยกเลิก/แก้ไขรายการครั้งล่าสุด</A></CENTER><BR>";
	}?>

	</TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" id="addoredit" name="addoredit" value="E">
</FORM>

	</TD>
	<TD width="482" valign="top"><Div id="druglist" ></Div></TD>
</TR>
</TABLE>
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	
	document.getElementById("drug_code").focus();
	viewlist();
		
}

</SCRIPT>
</body>
<?php include("unconnect.inc");?>
</html>