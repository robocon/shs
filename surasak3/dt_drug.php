<?php
session_start();

ini_set('display_errors', '1');
error_reporting(1);


if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}


include("connect.inc");
//include("checklogin.php");

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

$_SESSION['nsaids13_count'] = 0;

// หา eGFR
$curr_date = date('Y-m-d');
$sql_egfr = "SELECT b.`result` 
FROM `resulthead` AS a 
LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
WHERE a.`hn` = '".$_SESSION['hn_now']."' 
AND a.`orderdate` LIKE '$curr_date%' 
AND ( a.`profilecode` = 'CREA' OR a.`profilecode` = 'CREAG' ) 
AND b.`labname` = 'eGFR' ";
$q_egfr = mysql_query($sql_egfr);
$res_egfr ='';
if ( mysql_num_rows($q_egfr) > 0 ) {
	$fetch_egfr = mysql_fetch_assoc($q_egfr);
	$res_egfr = $fetch_egfr['result'];
}


//******************************* เรียกข้อมูลจาก SESSION มาแสดงเป็น Form ********************
if(isset($_GET["action"]) && $_GET["action"] == "alert500"){

	echo $_SESSION["alert500"];
	$_SESSION["alert500"] = 1;
	exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "drug_500"){
	$dayToday = date("D");
	$time = date("H");
	if($_SESSION["dt_doctor"]!="อรรณพ ธรรมลักษมี (ว.16633)"&&$_SESSION["dt_doctor"]!="ธนบดินทร์ ผลศรีนาค (ว.19921)"){
		if(substr($_SESSION["ptright_now"],0,3) == "R"  || substr($_SESSION["ptright_now"],0,3) == "R"  ){
			if($dayToday=="Sat"||$dayToday == "Sun"){
				echo "1";
			}elseif($time>=17||$time<8){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "check30day"){

$times = mktime("0","0","0",date("m"),date("d")-$limit30checkday,date("Y"));
$date1 = (date("Y",$times)+543).date("-m-d H:i:s",$times);
$date2 = (date("Y")+543).date("-m-d H:i:s");
$sql = " Select date_format(date,'%d-%m-%Y'), tradname, amount, slcode From drugrx where amount > 0 AND hn = '".$_SESSION["hn_now"]."' AND drugcode = '".$_GET["search"]."' AND status = 'Y' AND  date between '".$date1."' AND '".$date2."' Order by date DESC ";
$result = mysql_query($sql);
$rows = mysql_num_rows($result);
	if($rows == 0){
		echo "0";
	}
	else{
		list($date, $tradname, $amount, $slcode) = mysql_fetch_row($result);
		echo "เคยจ่ายยา ".$tradname." ครั้งล่าสุดเมื่อวันที่ ".$date." จำนวน ".$amount." วิธีใช้ ".$slcode." \n ท่านต้องการสั่งยาหรือไม่?";
	}
exit();
}
///////////////////////////////////////////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "checktoday"){
$date2 = (date("Y")+543).date("-m-d");

$sql2 = " Select tradname, amount, slcode,idno From ddrugrx where amount > 0 AND hn = '".$_SESSION["hn_now"]."' AND drugcode = '".$_GET["search"]."' AND  date like '".$date2."%' Order by date DESC ";
$result2 = mysql_query($sql2);
$rows2 = mysql_num_rows($result2);
list($tradname2, $amount2, $slcode2,$idno2)=mysql_fetch_array($result2);

$sql3 = " Select doctor From dphardep where row_id='$idno2'";
$result3 = mysql_query($sql3);
$rows3 = mysql_fetch_array($result3);

	if($rows2 == 0){
		echo "0";
	}elseif($rows3['doctor']==$_SESSION["dt_doctor"]){
		echo "0";
	}else{
		//list($tradname, $amount, $slcode) = mysql_fetch_row($result2);
		echo "คำเตือน : มีการจ่ายยา ".$tradname2." จากแพทย์ท่านอื่นแล้ว\nกรุณาตรวจสอบการจ่ายยาด้านล่าง เพื่อมิให้การจ่ายยาซ้ำซ้อน\nท่านต้องการสั่งยาหรือไม่?";
	}

exit();
}

function dump($txt){
	echo "<pre>";
	var_dump($txt);
	echo "</pre>";
}


if(isset($_GET["action"]) && $_GET["action"] == "rduin13"){

	$nsaids13_list = Array("1CELE200*",
	"1INDO",
	"1LOXO",
	"1NID",
	"1VOL-C",
	"1VOLSR",
	"1PONS",
	"1ARCO",
	"1BREX",
	"1MOBI",
	"1ARCO30",
	"1CELE_400",
	"1MOBI-C",
	"1ACEO",
	"1NID-C",
	"1ARCO_60",
	"1LOXO-N",
	"1NAPR",
	"1MOB7.5",
	"1VOL-N",
	"1VOL-NN",
	"1INDO-N",
	"1NAPR-N",
	"1ARCO120");
	
	foreach ($_SESSION["list_drugcode"] as $key_i => $dCode) {

		$test_in = in_array($dCode, $nsaids13_list);
		if ( $test_in == true ) {
			$_SESSION['nsaids13_count']++;
		}

	}

	echo $_SESSION['nsaids13_count'];

	exit;

}



///////////////////////////////////////////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "viewtolist"){
	$count = count($_SESSION["list_drugcode"]);
	$sql ="select toborow from opday where hn='".$_SESSION["hn_now"]."' AND thidate like '".((date("Y")+543).date("-m-d"))."%' ";
	$rows = mysql_query($sql);
	list($tobor) = mysql_fetch_array($rows);
	$exopd = substr($tobor,0,4);
	if($exopd=="EX02"){
		$code = "ER";
	}else if($exopd=="EX24"){
		$code = "VIP";
	}else{
		$code = "OTHER";
	}
if(substr($_SESSION["ptright_now"],0,3) == "R12" || substr($_SESSION["ptright_now"],0,3) == "R13" || substr($_SESSION["ptright_now"],0,3) == "R36"){
	$sql="select sum(price),hn,ptname from depart where hn = '".$_SESSION["hn_now"]."' and date like '".((date("Y")+543).date("-m-d"))."%' ";
	//echo "==>".$sql;
	$query=mysql_query($sql);
	list($sumprice,$hn,$ptname)=mysql_fetch_array($query);
	echo "<div style=\"background-color: #FF0000;\">ค่าบริการทางการแพทย์ รวมทั้งสิ้น ".$sumprice." บาท เบิกต้นสังกัดได้ไม่เกิน 700.00 บาท</div>";
	$pay=700;
}
		
	echo "<FORM name=\"form_list\" METHOD=POST ACTION=\"dt_drug_reason.php\" onsubmit=\"return viatch($count,'$code');\">
	<A HREF=\"javascript:showremed();checkall(false);\">Remedผป.นอก</A> ";
	echo "| <A HREF=\"javascript:showremed2();checkall4(false);\">Remedผป.ใน</A> ";
	
$sql = "Select idname From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1 ";
list($sld) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select row_id From dr_drugsuit where code_dr = '".$sld."' limit 1";
	
	$rows = mysql_num_rows(Mysql_Query($sql));
	if($rows > 0)
		echo "| <A HREF=\"javascript:showsult();checkall3(true);\">สูตรยา</A>";

	//หัวตารางรายการยาที่สั่งจ่ายผู้ป่วย
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
	//echo $count;

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
	$sql = " Select date_format(date,'%d/%m/%Y'), amount, slcode From drugrx where amount > 0 AND hn = '".$_SESSION["hn_now"]."' AND drugcode = '".$_SESSION["list_drugcode"][$i]."' AND status = 'Y' AND  date between '".$date1."' AND '".$date2."' Order by date DESC ";
	//echo $sql;
	$result = mysql_query($sql);
	
	$remark = array();
	
	if($_SESSION["list_drug_reason"][$i] != ""){
		$atip="";$btip="";$ctip="";$dtip="";$etip="";$ftip="";
		if(substr($_SESSION["list_drug_reason"][$i],0,1)=="A"){
			$atip = "selected";
		}else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="B"){
			$btip = "selected";
		}else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="C"){
			$ctip = "selected";
		}else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="D"){
			$dtip = "selected";
		}else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="E"){
			$etip = "selected";
		}else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F"){
			$ftip = "selected";
		}
		//if($_SESSION["list_drug_reason"][$i]=="ไม่มีสูตรยานี้ในบัญชียา ED"){
		if(substr($_SESSION["list_drug_reason"][$i],0,3)=="FPT"){
			//array_push($remark,"<FONT style=\"font-size: 20;\">เหตุผล <select name='ch$i' id='ch$i'><Option value=''>กรุณาเลือกเหตุผล</Option><Option value='F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)' $ftip>ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option></select></FONT>");
		}else{
			//array_push($remark,"<FONT style=\"font-size: 20;\">เหตุผล <select name='ch$i' id='ch$i'><Option value=''>กรุณาเลือกเหตุผล</Option><Option value='A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา' $atip>เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา</Option><Option value='B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย' $btip>ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย</Option><Option value='C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด' $ctip>ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด</Option><Option value='D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ' $dtip>มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ</Option><Option value='E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า' $etip>ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า</Option><Option value='F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)' $ftip>ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option></select></FONT>");
		}
		/*}else{
			array_push($remark,"<FONT style=\"font-size: 20;\">เหตุผล ".$_SESSION["list_drug_reason"][$i]."</FONT>");	
		}*/
	}

	if(mysql_num_rows($result) > 0){
		list($d, $a, $s) = mysql_fetch_row($result);
		array_push($remark,"<FONT style=\"font-size: 20px;\" COLOR=\"red\">เคยจ่ายยาครั้งสุดท้าย วันที่ ".$d." จำนวน ".$a." วิธีใช้ ".$s."</FONT>");
	}

			$sql = "Select tradname, unit, stock, salepri, freepri, part, medical_sup_free  From druglst  where drugcode = '".$_SESSION["list_drugcode"][$i]."' limit 1";
			//echo "$i==>".$sql."<br>";
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
					}  //close if $part

					$total_price = $total_price+ ($salepri * $_SESSION["list_drugamount"][$i]);
					if($_SESSION["list_drugcode"][$i] != "INJ");
						$total_item++;
					$Netprice = 	$Netprice + ($salepri * $_SESSION["list_drugamount"][$i]);
			}  //close if $_SESSION["list_drugamount"][$i]
			
			
			$c1 = substr($_SESSION["list_drugcode"][$i],0,1);
			$c2 = substr($_SESSION["list_drugcode"][$i],0,2);
			$sql = "Select detail1, detail2, detail3, detail4  From drugslip where slcode = '".$_SESSION["list_drugslip"][$i]."' limit 1";
			$result = Mysql_Query($sql);
			list($detail1,$detail2,$detail3,$detail4) = Mysql_fetch_row($result);
			if($c2!='20'&&($c1=='2'||$c1=='0')){
				array_push($remark,"<FONT style=\"font-size: 20;\" color=\"#000000\"> ".$_SESSION["list_drug_inject_amount"][$i]." ".$_SESSION["list_drug_inject_unit"][$i]." ".$_SESSION["list_drug_inject_amount2"][$i]." ".$_SESSION["list_drug_inject_unit2"][$i]." ".$_SESSION["list_drug_inject_time"][$i]." ".$_SESSION["list_drug_inject_slip"][$i]." ".$_SESSION["list_drug_inject_etc"][$i]."</FONT>");
			}else{
			array_push($remark,"<FONT style=\"font-size: 20;\" color=\"#000000\"> ".$detail1." ".$detail2." ".$detail3." ".$detail4."</FONT>");
			}
			
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
			
			
			////////////////---------- รายการยาที่สั่งจ่ายให้ผู้ป่วย--------------////////////////
			//print_r($_SESSION);
			//echo $_SESSION["list_drugcode"][$i]." Amont :".$_SESSION["list_drugamount"][$i]."<br>";
			
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
			document.getElementById('drug_inject_amount').style.display = '';
			document.getElementById('drug_inject_time').style.display = '';
			document.getElementById('drug_inject_slip').style.display = '';
			document.getElementById('drug_inject_type').style.display = '';
			document.getElementById('drug_inject_etc').style.display = '';
			document.getElementById('drug_inject_amount2').style.display = 'none';
			
			document.form1.drug_inject_amount.value = '",jschars($_SESSION["list_drug_inject_amount"][$i]),"';
			document.form1.drug_inject_unit.value = '",jschars($_SESSION["list_drug_inject_unit"][$i]),"';
			document.form1.drug_inject_amount2.value = '",jschars($_SESSION["list_drug_inject_amount2"][$i]),"';
			document.form1.drug_inject_unit2.value = '",jschars($_SESSION["list_drug_inject_unit2"][$i]),"';
			document.form1.drug_inject_time.value = '",jschars($_SESSION["list_drug_inject_time"][$i]),"';
			document.form1.drug_inject_slip.value = '",jschars($_SESSION["list_drug_inject_slip"][$i]),"';
			document.form1.drug_inject_type.value = '",jschars($_SESSION["list_drug_inject_type"][$i]),"';
			document.form1.drug_inject_etc.value = '",jschars($_SESSION["list_drug_inject_etc"][$i]),"';

					if(document.form1.drug_inject_slip.value=='2ins'){
							document.getElementById('drug_inject_amount2').style.display = '';
							document.getElementById('drug_inject_time').style.display = 'none';
							document.getElementById('drug_inject_type').style.display = 'none';
					}
				}else{
			document.getElementById('slip_detail').style.display = '';	
			document.getElementById('drug_inject_amount').style.display = 'none';
			document.getElementById('drug_inject_amount2').style.display = 'none';
			document.getElementById('drug_inject_time').style.display = 'none';
			document.getElementById('drug_inject_slip').style.display = 'none';
			document.getElementById('drug_inject_type').style.display = 'none';
			document.getElementById('drug_inject_etc').style.display = 'none';
					
				}";
				
			if($part=='DDY'){ 
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 
				
				

			}/*else if($_SESSION["list_drugcode"][$i] == "1NEUT300*$"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 
				
		   }else if($_SESSION["list_drugcode"][$i] == "1NEUT100*$"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 
		
			}else if($_SESSION["list_drugcode"][$i] == "1NEU100-C"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 

		}else if($_SESSION["list_drugcode"][$i] == "1NEU300-C"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 
	
			}else if($_SESSION["list_drugcode"][$i] == "1PLAV*"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 
				
			}*/else if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'DDY','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')";
			}else{
				echo " document.getElementById('reason').style.display = 'none';clearobt(document.form1.reason);";
			}
			echo "\">แก้ไข</A></TD>
			</TR>
			";

	}
	if($i >0)
/*	if(substr($_SESSION["ptright_now"],0,3) == "R36"){
	$sql="select sum(price),hn,ptname from patdata where hn = '".$_SESSION["hn_now"]."' and date like '".((date("Y")+543).date("-m-d"))."%' ";
	//echo "==>".$sql;
	$query=mysql_query($sql);
	list($sumprice,$hn,$ptname)=mysql_fetch_array($query);
	//echo "-->".$sumprice;
	$pay=700;
	
	$rest=$pay-$sumprice-$total_price;	
	echo "<TR class='tb_detail'>
					<TD   colspan=\"6\">&nbsp;&nbsp;รวมค่ายา : $total_price บาท, ค่าบริการ : 50 บาท <BR>&nbsp;&nbsp;ค่ายาที่เบิกได้ : ".($pricetype["DDL"]+$pricetype["DDY"]+$pricetype["DPY"]).", ค่ายาที่เบิกไม่ได้ : ".($pricetype["DSY"]+$pricetype["DDN"]+$pricetype["DSN"]+$pricetype["DPN"]).", รวมสั่งยาทั้งหมด : <strong>".($total_price)."</strong> บาท <BR>&nbsp;&nbsp;ค่าใช้จ่ายก่อนสั่งยา <strong>".($sumprice)."</strong> บาท<BR>&nbsp;&nbsp;สั่งยาได้อีก <strong style='color:red'>".(number_format($rest,2))."</strong> บาท</TD>
	</TR>";	
	echo "<TR class='tb_detail'>
				<TD  align=\"center\" ><INPUT TYPE=\"button\" value=\"  ลบ  \" onclick=\"del_list();\"></TD>
				<TD  colspan=\"5\">";
	if($_SESSION["dt_special"])
	echo "&nbsp;&nbsp;&nbsp;&nbsp;คิดค่าคลินิกพิเศษ <INPUT TYPE=\"text\" NAME=\"clinic150\" value=\"100\" size=\"4\">";
		if($rest <= 0){  //จำนวนเงินเหลือน้อยกว่าหรือเท่ากับ 0
			echo "<div  align=\"center\"></div></TD>
		</TR>";	
		}else{
			echo "<div  align=\"center\"><INPUT TYPE=\"submit\" value=\"      ตกลง      \" ></div></TD>
		</TR>";			
		}
	}else{*/
	echo "<TR class='tb_detail'>
					<TD   colspan=\"6\">&nbsp;&nbsp;รวมค่ายา : $total_price บาท, ค่าบริการ : 50 บาท <BR>&nbsp;&nbsp;ค่ายาที่เบิกได้ : ".($pricetype["DDL"]+$pricetype["DDY"]+$pricetype["DPY"]).", ค่ายาที่เบิกไม่ได้ : ".($pricetype["DSY"]+$pricetype["DDN"]+$pricetype["DSN"]+$pricetype["DPN"]).", รวมทั้งหมด : ".($total_price+50)." บาท</TD>
	</TR>";
	echo "<TR class='tb_detail'>
				<TD  align=\"center\" ><INPUT TYPE=\"button\" value=\"  ลบ  \" onclick=\"del_list();\"></TD>
				<TD  colspan=\"5\">";
	if($_SESSION["dt_special"])
	echo "&nbsp;&nbsp;&nbsp;&nbsp;คิดค่าคลินิกพิเศษ <INPUT TYPE=\"text\" NAME=\"clinic150\" value=\"100\" size=\"4\">";
		$chkprice=$total_price;
		if(substr($_SESSION["ptright_now"],0,3) == "R12" && $chkprice > 700){
		echo "<div  align=\"center\" style=\"color:red;\"><strong>ท่านสั่งจ่ายยาเกิน 700 บาท กรุณาแก้ไขการสั่งจ่ายยาด้วยครับ</strong></div>";
		}else{
		echo "<div  align=\"center\"><INPUT TYPE=\"submit\" value=\"     ตกลง     \" onclick=\"return chklist()\"></div>";		
		}
	
	echo "	</TD>
	</TR>";

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

//********************** Form Remed ยาผู้ป่วยใน **************************************************************
if(isset($_GET["action"]) && $_GET["action"] == "date_remed2"){
	
?>
<FORM name="form_remed2" METHOD=POST ACTION="">
		<table width="722" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="45" align="center"><input type="checkbox" name="checkbox2" value="" Onclick="checkall4(this.checked)"/></td>
            <td align="center" >รายการยา IPD</td>
			<td align="center" >วิธีใช้</td>
            <td align="center" >ประเภท</td>
			<td align="center" width="70" >จำนวนยา</td>
			<td align="center" >จำนวนที่ฉีด</td>
			<td align="center" >วิธีฉีด</td>
			<td align="center" >แบบ</td>
          </tr>

<?php
	
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){
		$where1 = " where `lock` = 'Y' ";
	}else{
		$where1 = "";
	}

	$sql = "
	SELECT a.date, a.drugcode, a.tradname, a.slcode, sum( a.amount ) AS amount, a.reason, a.part, a.drug_inject_amount,a.drug_inject_unit,a.drug_inject_amount2,a.drug_inject_unit2 ,a.drug_inject_time, a.drug_inject_slip , a.drug_inject_type,  a.drug_inject_etc, a.part,b.lock_dr 
	FROM drugrx as a INNER JOIN (Select `drugcode`,`lock_dr` From druglst ".$where1.") as b ON a.drugcode = b.drugcode
	WHERE a.hn = '".$_SESSION["hn_now"]."' AND a.an is not null AND a.date like '".$_GET["date_remed"]."%' AND a.drugcode <> 'INJ' AND a.row_id not in (Select row_id From drugrx_notinj)
	GROUP BY a.drugcode, a.slcode
	HAVING sum( a.amount ) >0
	";

	$result = Mysql_Query($sql) or die(Mysql_Error());
	$i=0;
	$j=0;
	while($arr = Mysql_fetch_assoc($result)){
		$arr["reason"] = "";
		if($arr["part"] == "DDY" && $arr["reason"] == ""){
				//$arr["reason"] = "ไม่มีสูตรยานี้ในบัญชียา ED";
		}

		if(($arr["drugcode"][0] == "0" || $arr["drugcode"][0] == "0") && !(ord($arr["drugcode"][1])  >= 48 && ord($arr["drugcode"][1]) <= 57 )){
			continue;
		}

		if($i%2==0)
			$bgcolor="#FFFF99";
		else
			$bgcolor="#FFFFFF";
		
	$sql1="select * from drug_pharlock where hn = '".$_SESSION["hn_now"]."' and drugcode='".$arr["drugcode"]."'";
	//echo $sql1;
	$query1=mysql_query($sql1);
	$num1=mysql_num_rows($query1);
	if($num1 < 1){  //ถ้าไม่มีการ lock จ่ายยาตัวนี้ ให้แสดงข้อมูล
?>
          <tr bgcolor="<?php echo $bgcolor;?>">
            <td width="45" align="center">
			<?php 
			$sqlrect = " Select row_id FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."'  AND drugcode = '".$arr["drugcode"]."' ";
	$dgrect = mysql_query($sqlrect);
	
			if(mysql_num_rows($dgrect)>0){
				echo "<FONT COLOR=\"RED\" >แพ้ยา</FONT>";
			}else if($arr["lock_dr"] == 'Y'){?>
              <input type="checkbox" id="drug_remed2<?php echo $i+1;?>" name="drug_remed<?php echo $i+1;?>" value="<?php echo $arr["drugcode"];?>][<?php echo $arr["slcode"];?>][<?php echo $arr["amount"];?>][<?php echo $arr["reason"];?>][<?php echo $arr["drug_inject_amount"];?>][<?php echo $arr["drug_inject_unit"];?>][<?php echo $arr["drug_inject_amount2"];?>][<?php echo $arr["drug_inject_unit2"];?>][<?php echo $arr["drug_inject_time"];?>][<?php echo $arr["drug_inject_slip"];?>][<?php echo $arr["drug_inject_type"];?>][<?php echo $arr["drug_inject_etc"];?>][<?php echo $arr["reason2"];?>]" />
			  <?php $i++; $j++;}else{ 
				if($arr["lock_dr"] =="N"){
					echo "ยาตัดออก";
				}else{
					echo $arr["lock_dr"];
				}
			} 
		
			?>
            </td>
            <td >&nbsp;<?php echo $arr["tradname"];?></td>
			<td align="center">&nbsp;<?php echo $arr["slcode"];?></td>
            <td align="center">&nbsp;<?php echo $arr["part"];?></td>
			<td align="center" >&nbsp;<?php echo $arr["amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_slip"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_type"];?></td>
          </tr>
          <? } ?>
		  <?php if($arr["reason"] == "" && ($arr["part"] == "DDY" )){
					// || $arr["drugcode"] == "1NEU300-C"|| $arr["drugcode"] == "1NEUT300*$"  || $arr["drugcode"] == "1NEUT100*$" || $arr["drugcode"] == "1NEU100-C"  || $arr["drugcode"] =="1PLAV*"
					$i1=$i2=$i3=$i4=$i5=$i6=$i7=$i8=$i9=$i10=$i11 = "";
					switch($arr["reason"]){
						case "ใช้ยาในบัญชียาหลักแห่งชาติแล้วไม่ดีขึ้น": $i1=" Selected "; break;
						case "ไม่มียาในบัญชียาหลักแห่งชาติที่ใช้รักษาตามข้อบ่งชี้": $i2=" Selected "; break;
						case "แพ้ยาในบัญชียาหลักแห่งชาติ": $i3=" Selected "; break;
						case "มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชียาหลักต่อไปได้": $i4=" Selected "; break;

						case "ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา(drug interaction)กับยาในบัญชียาหลักแห่งชาติ": $ii5=" Selected "; break;
						case "ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน": $ii6=" Selected "; break;
						case "มีความจำเป็นที่ต้องใช้ยานอกบัญชียาหลักเพราะมีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย": $ii7=" Selected "; break;


						case "ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท": $i5=" Selected "; break;
						case "ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น": $i6=" Selected "; break;
						case "เกิดอาการข้างเคียงจากยากลุ่มอื่น": $i7=" Selected "; break;
						case "ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin": $i8=" Selected "; break;
						case "ใช้ระยะสั้นในการใส่ stent": $i9=" Selected "; break;
						case "AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้": $i10=" Selected "; break;
						case "ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้": $i11=" Selected "; break;
					}

			?>
		  <tr bgcolor="<?php echo $bgcolor;?>">
            <td colspan="7" align="left"><!--เหตุผล :--> 
                <? if($arr["part"]=="DDY"){?>
                <!--<SELECT id="chose_reason2<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>" >
          		<Option value="กรุณาระบุเหตุผล" >กรุณาระบุเหตุผล</Option>
                <Option value="A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา" >เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา</Option>
                <Option value="B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย">ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย</Option>
                <Option value="C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด">ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด</Option>
                <Option value="D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ">มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ</Option>
                <Option value="E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า">ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า</Option>
                <Option value="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)">ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option>
                </SELECT>-->
				<?php  }/*else if($arr["drugcode"] == "1NEUT300*$"){ ?>
        <SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>" >
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEUT100*$"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEU100-C"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEU300-C"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] =="1PLAV*"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin" <?php echo $i8;?>>ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin</Option>
					<Option value="ใช้ระยะสั้นในการใส่ stent" <?php echo $i9;?>>ใช้ระยะสั้นในการใส่ stent</Option>
					<Option value="AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้"  <?php echo $i10;?>>AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้</Option>
					<Option value="ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้" <?php echo $i11;?>>ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้</Option>
				</SELECT>
				<?php } */?>
					
				
				</td>
          </tr>
		  <?php }else {?>
			<INPUT TYPE="hidden" id="chose_reason2<?php echo $j;?>" name="chose_reason<?php echo $j;?>" value="-">
		  <?php } ?>


<?php }?>
		  <tr>
			<td>&nbsp;&nbsp;
				<FONT COLOR="red"><B><A HREF="#" onClick="document.getElementById('head_remed2').style.display='none';" style="text-decoration:underline; color:#FF0000;">Close</A></B></FONT>
			</td>
		    <td colspan="3" align="center"><label>
		      <input type="button" name="Submit" value="ตกลง" onClick="addtolist_muli3();document.getElementById('head_remed2').style.display='none';"/>
		    </label></td>
		    </tr>
	<INPUT TYPE="hidden" name="totalcheck2" value="<?php echo $i;?>">
        </table>
		</FORM>
<?
exit();
}



//********************** Form Remed ยาผู้ป่วยนอก ******************************************
if(isset($_GET["action"]) && $_GET["action"] == "date_remed"){
	
?>
<FORM name="form_remed" METHOD=POST ACTION="">
		<table width="722" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="45" align="center"><input type="checkbox" name="checkbox2" value="" Onclick="checkall(this.checked)"/></td>
            <td align="center" >รายการยาOPD</td>
			<td align="center" >วิธีใช้</td>
            <td align="center" >ประเภท</td>
			<td align="center" width="70" >จำนวนยา</td>
			<td align="center" >จำนวนที่ฉีด</td>
			<td align="center" >วิธีฉีด</td>
			<td align="center" >แบบ</td>
          </tr>

<?php
	
	/*if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){  //ถ้าเป็นสิทธิประกันสังคม/ประกันสุขภาพ
		$where1 = " where `lock` = 'Y' ";  //เลือกเฉพาะยาที่ไม่ต้องใส่รหัสผ่านมา REMED
	}else if(substr($_SESSION["ptright_now"],0,3) == "R02" || substr($_SESSION["ptright_now"],0,3) == "R03"){
		$where1 = " where `lockptright` != 'Y' ";
	}else{
		$where1 = "";
	}*/

	$sql = "
	SELECT a.date, a.drugcode, a.tradname, a.slcode, sum( a.amount ) AS amount, a.reason, a.part, a.drug_inject_amount,a.drug_inject_unit,a.drug_inject_amount2,a.drug_inject_unit2 ,a.drug_inject_time, a.drug_inject_slip , a.drug_inject_type,  a.drug_inject_etc, a.part,b.lock,b.lock_dr, b.drug_lockintern,b.drug_active   
	FROM drugrx as a INNER JOIN (Select `drugcode`,`lock`,`lock_dr`,`drug_lockintern`,`drug_active` From druglst ".$where1.") as b ON a.drugcode = b.drugcode
	WHERE a.hn = '".$_SESSION["hn_now"]."' AND a.date like '".$_GET["date_remed"]."%' AND a.drugcode <> 'INJ' AND a.row_id not in (Select row_id From drugrx_notinj)
	GROUP BY a.drugcode, a.slcode
	HAVING sum( a.amount ) >0
	";
	//echo $sql;
	$result = Mysql_Query($sql) or die(Mysql_Error());
	$i=0;
	$j=0;
	while($arr = Mysql_fetch_assoc($result)){
		$arr["reason"] = "";
		if($arr["part"] == "DDY" && $arr["reason"] == ""){
				//$arr["reason"] = "ไม่มีสูตรยานี้ในบัญชียา ED";
		}

		if(($arr["drugcode"][0] == "0" || $arr["drugcode"][0] == "0") && !(ord($arr["drugcode"][1])  >= 48 && ord($arr["drugcode"][1]) <= 57 )){
			continue;
		}

		if($i%2==0)
			$bgcolor="#FFFF99";
		else
			$bgcolor="#FFFFFF";
	$sql1="select * from drug_pharlock where hn = '".$_SESSION["hn_now"]."' and drugcode='".$arr["drugcode"]."'";
	//echo $sql1;
	$query1=mysql_query($sql1);
	$num1=mysql_num_rows($query1);
	if($num1 < 1){  //ถ้าไม่มีการ lock จ่ายยาตัวนี้ ให้แสดงข้อมูล
?>
          <tr bgcolor="<?php echo $bgcolor;?>">
            <td width="45" align="center">
			<?php 			
			$sqlrect = " Select row_id FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."'  AND drugcode = '".$arr["drugcode"]."' ";
	$dgrect = mysql_query($sqlrect);
			if(mysql_num_rows($dgrect)>0){
				echo "<FONT COLOR=\"RED\" >แพ้ยา</FONT>";
			}else{
				if($arr["drug_active"]=="n"){  //ถ้าเป็นยาที่เลิกใช้แล้ว
					if($arr["lock_dr"] == 'N'){
						echo "<FONT COLOR=\"BLUE\" >เลิกใช้</FONT>";
					}else{
						echo $arr["lock_dr"];
					}
				}else{  //ถ้าเป็นยาที่ยังใช้อยู่
					if((substr($_SESSION["ptright_now"],0,3) == "R07" || substr($_SESSION["ptright_now"],0,3) == "R09" || substr($_SESSION["ptright_now"],0,3) == "R10" || substr($_SESSION["ptright_now"],0,3) == "R11" || substr($_SESSION["ptright_now"],0,3) == "R12" || substr($_SESSION["ptright_now"],0,3) == "R13" || substr($_SESSION["ptright_now"],0,3) == "R14" || substr($_SESSION["ptright_now"],0,3) == "R17" || substr($_SESSION["ptright_now"],0,3) == "R35" || substr($_SESSION["ptright_now"],0,3) == "R36" || substr($_SESSION["ptright_now"],0,3) == "R40")){  //ถ้าเป็นสิทธิประกันสังคม/ประกันสุขภาพ
					//echo "==>".$arr["lock"];
						if($arr["lock"]=="N"){  //ถ้าเป็นยา NED ที่ต้องใส่รหัสผ่าน
							echo "<FONT COLOR=\"RED\" >ใส่รหัสผ่านทุกครั้ง</FONT>";
						}else{  //ยาที่ไม่ต้องใส่รหัสผ่าน
							if($arr["lock_dr"] == 'Y'){
						?>
							<input type="checkbox" id="drug_remed<?php echo $i+1;?>" name="drug_remed<?php echo $i+1;?>" value="<?php echo $arr["drugcode"];?>][<?php echo $arr["slcode"];?>][<?php echo $arr["amount"];?>][<?php echo $arr["reason"];?>][<?php echo $arr["drug_inject_amount"];?>][<?php echo $arr["drug_inject_unit"];?>][<?php echo $arr["drug_inject_amount2"];?>][<?php echo $arr["drug_inject_unit2"];?>][<?php echo $arr["drug_inject_time"];?>][<?php echo $arr["drug_inject_slip"];?>][<?php echo $arr["drug_inject_type"];?>][<?php echo $arr["drug_inject_etc"];?>][<?php echo $arr["reason2"];?>]" />
			  <?php $i++; $j++;
			  				}else if($arr["lock_dr"] == 'N'){
								echo "<FONT COLOR=\"RED\" >ยาตัดออก</FONT>";
							}else{
								echo $arr["lock_dr"];
							}
						}					
					}else{  //ถ้าเป็นสิทธิอื่นๆ
						if($arr["lock_dr"] == 'Y'){
					?>
						<input type="checkbox" id="drug_remed<?php echo $i+1;?>" name="drug_remed<?php echo $i+1;?>" value="<?php echo $arr["drugcode"];?>][<?php echo $arr["slcode"];?>][<?php echo $arr["amount"];?>][<?php echo $arr["reason"];?>][<?php echo $arr["drug_inject_amount"];?>][<?php echo $arr["drug_inject_unit"];?>][<?php echo $arr["drug_inject_amount2"];?>][<?php echo $arr["drug_inject_unit2"];?>][<?php echo $arr["drug_inject_time"];?>][<?php echo $arr["drug_inject_slip"];?>][<?php echo $arr["drug_inject_type"];?>][<?php echo $arr["drug_inject_etc"];?>][<?php echo $arr["reason2"];?>]" />
			  		<?php $i++; $j++;	
			  				}else if($arr["lock_dr"] == 'N'){
								echo "<FONT COLOR=\"RED\" >ยาตัดออก</FONT>";
							}else{
								echo $arr["lock_dr"];
							}					                    
					}  //close 672
				}  //close 667
			}  //close 664
				
			?>
            </td>
            <td >&nbsp;<?php echo $arr["tradname"];?></td>
			<td align="center">&nbsp;<?php echo $arr["slcode"];?></td>
            <td align="center">&nbsp;<?php echo $arr["part"];?></td>
			<td align="center" >&nbsp;<?php echo $arr["amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_slip"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_type"];?></td>
          </tr>
          <? } ?>
		  <?php if($arr["reason"] == "" && ($arr["part"] == "DDY" )){
					// || $arr["drugcode"] == "1NEU300-C"|| $arr["drugcode"] == "1NEUT300*$"  || $arr["drugcode"] == "1NEUT100*$" || $arr["drugcode"] == "1NEU100-C"  || $arr["drugcode"] =="1PLAV*"
					$i1=$i2=$i3=$i4=$i5=$i6=$i7=$i8=$i9=$i10=$i11 = "";
					switch($arr["reason"]){
						case "ใช้ยาในบัญชียาหลักแห่งชาติแล้วไม่ดีขึ้น": $i1=" Selected "; break;
						case "ไม่มียาในบัญชียาหลักแห่งชาติที่ใช้รักษาตามข้อบ่งชี้": $i2=" Selected "; break;
						case "แพ้ยาในบัญชียาหลักแห่งชาติ": $i3=" Selected "; break;
						case "มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชียาหลักต่อไปได้": $i4=" Selected "; break;

						case "ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา(drug interaction)กับยาในบัญชียาหลักแห่งชาติ": $ii5=" Selected "; break;
						case "ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน": $ii6=" Selected "; break;
						case "มีความจำเป็นที่ต้องใช้ยานอกบัญชียาหลักเพราะมีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย": $ii7=" Selected "; break;


						case "ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท": $i5=" Selected "; break;
						case "ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น": $i6=" Selected "; break;
						case "เกิดอาการข้างเคียงจากยากลุ่มอื่น": $i7=" Selected "; break;
						case "ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin": $i8=" Selected "; break;
						case "ใช้ระยะสั้นในการใส่ stent": $i9=" Selected "; break;
						case "AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้": $i10=" Selected "; break;
						case "ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้": $i11=" Selected "; break;
					}

			?>
		  <tr bgcolor="<?php echo $bgcolor;?>">
            <td colspan="7" align="left"><!--เหตุผล :--> 
                <? if($arr["part"]=="DDY"){?>
                <!--<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>" >
          		<Option value="กรุณาระบุเหตุผล" >กรุณาระบุเหตุผล</Option>
                <Option value="A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา" >เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา</Option>
                <Option value="B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย">ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย</Option>
                <Option value="C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด">ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด</Option>
                <Option value="D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ">มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ</Option>
                <Option value="E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า">ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า</Option>
                <Option value="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)">ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option>
                </SELECT>-->
				<?php  }/*else if($arr["drugcode"] == "1NEUT300*$"){ ?>
        <SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>" >
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEUT100*$"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEU100-C"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEU300-C"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท" <?php echo $i5;?>>ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท</Option>
					<Option value="ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น" <?php echo $i6;?>>ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น</Option>
					<Option value="เกิดอาการข้างเคียงจากยากลุ่มอื่น"  <?php echo $i7;?>>เกิดอาการข้างเคียงจากยากลุ่มอื่น</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] =="1PLAV*"){ ?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>">
					<Option value="ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin" <?php echo $i8;?>>ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin</Option>
					<Option value="ใช้ระยะสั้นในการใส่ stent" <?php echo $i9;?>>ใช้ระยะสั้นในการใส่ stent</Option>
					<Option value="AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้"  <?php echo $i10;?>>AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้</Option>
					<Option value="ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้" <?php echo $i11;?>>ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้</Option>
				</SELECT>
				<?php } */?>
					
				
				</td>
          </tr>
		  <?php }else {?>
			<INPUT TYPE="hidden" id="chose_reason<?php echo $j;?>" name="chose_reason<?php echo $j;?>" value="-">
		  <?php } ?>


<?php }?>
		  <tr>
			<td>&nbsp;&nbsp;
				<FONT COLOR="red"><B><A HREF="#" onClick="document.getElementById('head_remed').style.display='none';" style="text-decoration:underline; color:#FF0000;">Close</A></B></FONT>
			</td>
		    <td colspan="3" align="center"><label>
		      <input type="button" name="Submit" value="ตกลง" onClick="addtolist_muli();document.getElementById('head_remed').style.display='none';"/>
		    </label></td>
		    </tr>
	<INPUT TYPE="hidden" name="totalcheck" value="<?php echo $i;?>">
        </table>
		</FORM>
<?
exit();
}


//********************** Form สูตรยา **************************************************************
if(isset($_GET["action"]) && $_GET["action"] == "date_sult"){
?>
	<FORM name="form_sult" METHOD=POST ACTION="">
		<table width="722" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="75" align="center"><input type="checkbox" name="checkbox2" value="" Onclick="checkall3(this.checked)" checked /></td>
            <td align="center" >รายการยา</td>
			<td align="center" >วิธีใช้</td>
			<td align="center" >จำนวน</td>
			<td align="center" >จำนวนที่ฉีด</td>
			<td align="center" >วิธีฉีด</td>
			<td align="center" >แบบ</td>
          </tr>

<?php
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){
		$where1 = " AND b.`lock` = 'Y' ";
	}else{
		$where1 = "";
	}
	$sql = "Select a.drugcode, b.tradname, a.slcode, a.amount, b.part, b.lock_dr, a.drug_inject_amount,a.drug_inject_slip,  a.drug_inject_type,  a.drug_inject_etc  From dr_drugsuit_detail as a, druglst as b where a.drugcode = b.drugcode ".$where1." AND a.for_id = '".$_GET["date_sult"]."' ";
	
	$result = Mysql_Query($sql);
	$i=0;
	while($arr = Mysql_fetch_assoc($result)){
		
		$reason = "";
		if($arr["part"] == "DDY"){
		//$reason = "ไม่มีสูตรยานี้ในบัญชียา ED";
		}else{
			$reason = "";
		}
		if(($arr["drugcode"][0] == "0" || $arr["drugcode"][0] == "2") && !(ord($arr["drugcode"][1])  >= 48 && ord($arr["drugcode"][1]) <= 57 )){
			continue;
		}
		
		if($i%2==0)
			$bgcolor="#FFFFCC";
		else
			$bgcolor="#FFFFFF";
?>
          <tr bgcolor="<?php echo $bgcolor;?>">
            <td width="75" align="center">
            <?
	$sqlrect = " Select row_id FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."'  AND drugcode = '".$arr["drugcode"]."' ";
	$dgrect = mysql_query($sqlrect);
	
			if(mysql_num_rows($dgrect)>0){
				echo "<FONT COLOR=\"RED\" >แพ้ยา</FONT>";
			}else if(($arr["drugcode"][0] == "0" || $arr["drugcode"][0] == "2") && !(ord($arr["drugcode"][1])  >= 48 && ord($arr["drugcode"][1]) <= 57 ) && ($arr["drug_inject_amount"] == "" || $arr["drug_inject_slip"] == "" || $arr["drug_inject_type"] == "")){
				echo "<FONT SIZE=\"2\" >ข้อมูลไม่ครบ</FONT>";
			}else if($arr["lock_dr"]=="Y"){?>
              <input type="checkbox" id="drug_sult<?php echo $i+1;?>" name="drug_sult<?php echo $i+1;?>" value="<?php echo $arr["drugcode"];?>][<?php echo $arr["slcode"];?>][<?php echo $arr["amount"];?>][<?php echo $reason;?>][<?php echo $arr["drug_inject_amount"];?>][<?php echo $arr["drug_inject_slip"];?>][<?php echo $arr["drug_inject_type"];?>][<?php echo $arr["drug_inject_etc"];?>" />
			  <?php $i++;}else{ 
				if($arr["lock_dr"] =="N"){
					echo "ยาตัดออก";
				}else{
					echo $arr["lock_dr"];
				}
			} ?>
            </td>
            <td >&nbsp;<?php echo $arr["tradname"];?></td>
			<td align="center">&nbsp;<?php echo $arr["slcode"];?></td>
			<td align="right">&nbsp;<?php echo $arr["amount"];?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_slip"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_type"];?></td>
          </tr>
          <tr><td colspan="7">
	<? if($arr["part"]=="DDY"){?><!--เหตุผล :
                   <SELECT id="chose_reasonsul<?php echo $i;?>" NAME="chose_reasonsul<?php echo $i;?>" >
                     <Option value="กรุณาระบุเหตุผล" >กรุณาระบุเหตุผล</Option>
                    <Option value="A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา" >เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา</Option>
                    <Option value="B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย">ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย</Option>
                    <Option value="C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด">ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด</Option>
                    <Option value="D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ">มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ</Option>
                    <Option value="E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า">ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า</Option>
                    <Option value="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)">ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option>
                    </SELECT>-->
                <?php }else {?>
                <INPUT TYPE="hidden" id="chose_reasonsul<?php echo $i;?>" name="chose_reasonsul<?php echo $i;?>" value="-">
              <?php } ?>
            </td></tr>
<?php }?>
		  <tr>
			<td>&nbsp;&nbsp;
				<FONT COLOR="red"><B><A HREF="#" onClick="document.getElementById('head_sult').style.display='none';" style="text-decoration:underline; color:#FF0000;">Close</A></B></FONT>
			</td>
		    <td colspan="3" align="center"><label>
		      <input type="button" name="Submit" value="ตกลง" onClick="addtolist_muli2();document.getElementById('head_sult').style.display='none';"/>
		    </label></td>
		    </tr>
	<INPUT TYPE="hidden" name="totalcheck" value="<?php echo $i;?>">
        </table>
		</FORM>
<?
exit();
}


// ********************************* บันทึกข้อมูลยา ลงในรายการ SESSION *****************************************
if(isset($_GET["action"]) && $_GET["action"] == "addtolist"){
	
	if( isset($_GET['drugcode']) && $_GET['drugcode'] === '1para500' ){
		$_GET['drugcode'] = '1PARA500';
	}
	if( isset($_GET['drugcode']) && $_GET['drugcode'] === '1para325' ){
		$_GET['drugcode'] = '1PARA325';
	}
	if( isset($_GET['drugcode']) && $_GET['drugcode'] === '2para' ){
		$_GET['drugcode'] = '2PARA';
	}
	
	$count = count($_SESSION["list_drugcode"]);
	
	$sql = "Select part From druglst Where drugcode = '".$_GET["drugcode"]."' limit 1";
	$result = Mysql_Query($sql);
	list($part) = Mysql_fetch_row($result);
	
	
	if($part != "DDY" )
		$_GET["reason"] = "";
	//&& $_GET["drugcode"] != "1NEU300-C"&& $_GET["drugcode"] != "1NEUT300*$"&& $_GET["drugcode"] != "1NEUT100*$"&& $_GET["drugcode"] != "1NEU100-C" && $_GET["drugcode"] != "1PLAV*"
	
	/*if( ($_GET["drugcode"][0] == "0" || $_GET["drugcode"][0] == "2") && !(ord($_GET["drugcode"][1]) >=48 && ord($_GET["drugcode"][1]) <=57) ){
		$_GET["drug_inject_amount"] = "";
		$_GET["drug_inject_slip"] = "";
		$_GET["drug_inject_type"] = "";
		$_GET["drug_inject_etc"] = "";

	}*/

	if($_GET["addoredit"] != "E"){
		$add = false;
		
				$_SESSION["list_drugcode"][$_GET["addoredit"]] = $_GET["drugcode"];
				$_SESSION["list_drugamount"][$_GET["addoredit"]] = $_GET["drugamount"];
				$_SESSION["list_drugslip"][$_GET["addoredit"]] = $_GET["drugslip"];

				$_SESSION["list_drug_inject_amount"][$_GET["addoredit"]] = $_GET["drug_inject_amount"];
				$_SESSION["list_drug_inject_unit"][$_GET["addoredit"]] = $_GET["drug_inject_unit"];
				$_SESSION["list_drug_inject_amount2"][$_GET["addoredit"]] = $_GET["drug_inject_amount2"];
				$_SESSION["list_drug_inject_unit2"][$_GET["addoredit"]] = $_GET["drug_inject_unit2"];
				$_SESSION["list_drug_inject_time"][$_GET["addoredit"]] = $_GET["drug_inject_time"];
				$_SESSION["list_drug_inject_slip"][$_GET["addoredit"]] = $_GET["drug_inject_slip"];
				$_SESSION["list_drug_inject_type"][$_GET["addoredit"]] = $_GET["drug_inject_type"];
				$_SESSION["list_drug_inject_etc"][$_GET["addoredit"]] = $_GET["drug_inject_etc"];
				
				$_SESSION["list_drug_reason"][$_GET["addoredit"]] = $_GET["reason"];
				
				$_SESSION["list_drug_reason2"][$_GET["addoredit"]] = $_GET["reason2"];

	}else{
		$add = true;

	}

	if($add){

		array_push($_SESSION["list_drugcode"],$_GET["drugcode"]);
		array_push($_SESSION["list_drugamount"],$_GET["drugamount"]);
		array_push($_SESSION["list_drugslip"],$_GET["drugslip"]);
		array_push($_SESSION["list_drug_inject_amount"],$_GET["drug_inject_amount"]);
		array_push($_SESSION["list_drug_inject_unit"],$_GET["drug_inject_unit"]);
		array_push($_SESSION["list_drug_inject_amount2"],$_GET["drug_inject_amount2"]);
		array_push($_SESSION["list_drug_inject_unit2"],$_GET["drug_inject_unit2"]);
		array_push($_SESSION["list_drug_inject_time"],$_GET["drug_inject_time"]);
		array_push($_SESSION["list_drug_inject_slip"],$_GET["drug_inject_slip"]);
		array_push($_SESSION["list_drug_inject_type"],$_GET["drug_inject_type"]);
		array_push($_SESSION["list_drug_inject_etc"],$_GET["drug_inject_etc"]);
		array_push($_SESSION["list_drug_reason"],$_GET["reason"]);
		array_push($_SESSION["list_drug_reason2"],$_GET["reason2"]);
		
		$count = count($_SESSION["list_drugcode"]);

		if( ($_GET["drugcode"][0] == "0" || $_GET["drugcode"][0] == "2") && !(ord($_GET["drugcode"][1]) >=48 && ord($_GET["drugcode"][1]) <=57) ){
			$inj = true;
			for($i=0;$i<$count;$i++){
				
				if($_SESSION["list_drugcode"][$i] == "INJ"){
						$inj = false;
						break;
				}

			}
		
			/*if($inj){
				array_push($_SESSION["list_drugcode"],"INJ");
				array_push($_SESSION["list_drugamount"],"1");
				array_push($_SESSION["list_drugslip"],"");
			}*/
		}

	}
	exit();
}


// ********************************* ดึกรายการยาเดิมออกมาแสดงเพื่อทำการแก้ไข *****************************************
if(isset($_GET["action"]) && $_GET["action"] == "listdrugprov"){
	
	$_SESSION["list_drugcode"] = array() ;
	$_SESSION["list_drugamount"] = array() ;
	$_SESSION["list_drugslip"] = array() ;
	
	$_SESSION["list_drug_inject_amount"] = array() ;
	$_SESSION["list_drug_inject_unit"] = array() ;
	$_SESSION["list_drug_inject_amount2"] = array() ;
	$_SESSION["list_drug_inject_unit2"] = array() ;
	$_SESSION["list_drug_inject_time"] = array() ;
	$_SESSION["list_drug_inject_slip"] = array() ;
	$_SESSION["list_drug_inject_type"] = array() ;
	$_SESSION["list_drug_inject_etc"] = array() ;
	$_SESSION["list_drug_reason"] = array() ;
	$_SESSION["list_drug_reason2"] = array() ;

	$sql = " Select row_id, item, stkcutdate From dphardep where hn = '".$_SESSION["hn_now"]."' AND whokey = 'DR' AND idname='".$_SESSION["dt_doctor"]."' AND date like '".((date("Y")+543).date("-m-d"))."%' Order by row_id DESC limit 1";
	$result = Mysql_Query($sql);
	list($id, $item, $stkcutdate) = Mysql_fetch_row($result);
	
	if($stkcutdate)
		session_register("cancle_row_id");
		$_SESSION["cancle_row_id"] = $id;

	$sql = "SELECT `drugcode`,`amount`,`slcode`,`drug_inject_amount`,`drug_inject_unit`,`drug_inject_amount2`,`drug_inject_unit2`,`drug_inject_time`,
	`drug_inject_slip`,`drug_inject_type`,`drug_inject_etc`,`reason`   
	FROM `ddrugrx` 
	WHERE `idno` = '".$id."' 
	AND `hn` = '".$_SESSION["hn_now"]."' 
	AND `date` LIKE '".((date("Y")+543).date("-m-d"))."%' ";
	
	
	// เก็บ log หลังจากคลิกแก้ไขยา
	$logs = "ddrugrx - edit\r\n";
	$logs .= "[idno] : $id\r\n";
	$logs .= "[mysql] : $sql\r\n";
	
	$result = mysql_query($sql) or die( mysql_error() );
	while($arr = mysql_fetch_assoc($result)){
		
		if($arr["drugcode"] === '4MET25'){  //กรณีเป็น balm
		
			$sql2 = "Select drugcode, sum(amount) as amount, slcode, drug_inject_amount, drug_inject_unit,drug_inject_amount2, drug_inject_unit2, drug_inject_time,  drug_inject_slip,  drug_inject_type,  drug_inject_etc, reason   From ddrugrx where idno = '".$id."' AND hn='".$_SESSION["hn_now"]."' AND  date like '".((date("Y")+543).date("-m-d"))."%' GROUP BY amount  order by row_id desc limit 1";
			$res = mysql_query($sql2) or die( mysql_error() ) ;
			$arr2 = mysql_fetch_assoc($res);
			
			array_push($_SESSION["list_drugcode"],$arr2["drugcode"]);
			array_push($_SESSION["list_drugamount"],$arr2["amount"]);
			array_push($_SESSION["list_drugslip"],$arr2["slcode"]);
			array_push($_SESSION["list_drug_inject_amount"],$arr2["drug_inject_amount"]);
			array_push($_SESSION["list_drug_inject_unit"],$arr2["drug_inject_unit"]);
			array_push($_SESSION["list_drug_inject_amount2"],$arr2["drug_inject_amount2"]);
			array_push($_SESSION["list_drug_inject_unit2"],$arr2["drug_inject_unit2"]);
			array_push($_SESSION["list_drug_inject_time"],$arr2["drug_inject_time"]);
			array_push($_SESSION["list_drug_inject_slip"],$arr2["drug_inject_slip"]);
			array_push($_SESSION["list_drug_inject_type"],$arr2["drug_inject_type"]);
			array_push($_SESSION["list_drug_inject_etc"],$arr2["drug_inject_etc"]);
			array_push($_SESSION["list_drug_reason"],$arr2["reason"]);
			array_push($_SESSION["list_drug_reason2"],$arr2["reason2"]);
			
		}else{
			
			array_push($_SESSION["list_drugcode"],$arr["drugcode"]);
			array_push($_SESSION["list_drugamount"],$arr["amount"]);
			array_push($_SESSION["list_drugslip"],$arr["slcode"]);
			array_push($_SESSION["list_drug_inject_amount"],$arr["drug_inject_amount"]);
			array_push($_SESSION["list_drug_inject_unit"],$arr["drug_inject_unit"]);
			array_push($_SESSION["list_drug_inject_amount2"],$arr["drug_inject_amount2"]);
			array_push($_SESSION["list_drug_inject_unit2"],$arr["drug_inject_unit2"]);
			array_push($_SESSION["list_drug_inject_time"],$arr["drug_inject_time"]);
			array_push($_SESSION["list_drug_inject_slip"],$arr["drug_inject_slip"]);
			array_push($_SESSION["list_drug_inject_type"],$arr["drug_inject_type"]);
			array_push($_SESSION["list_drug_inject_etc"],$arr["drug_inject_etc"]);
			array_push($_SESSION["list_drug_reason"],$arr["reason"]);
			array_push($_SESSION["list_drug_reason2"],$arr["reason2"]);
		}  //close if
		
	}  //close while

	$logSession = $_SESSION['dt_doctor']."\r\n";
	$logSession .= implode(',', $_SESSION['list_drugcode'])."\r\n";
	$logSession .= implode(',', $_SESSION['list_drugamount'])."\r\n";
	$logSession .= implode(',', $_SESSION['list_drugslip'])."\r\n";
	
	$logs .= "[session] : $logSession\r\n";
	$logs .= "---------------------------\r\n\r\n";
	
	file_put_contents('logs/doctor-drug.log', $logs, FILE_APPEND);
	
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

			$_SESSION["list_drug_inject_amount"][$i] = $_SESSION["list_drug_inject_amount"][$i+1];
			$_SESSION["list_drug_inject_unit"][$i] = $_SESSION["list_drug_inject_unit"][$i+1];
			$_SESSION["list_drug_inject_amount2"][$i] = $_SESSION["list_drug_inject_amount2"][$i+1];
			$_SESSION["list_drug_inject_unit2"][$i] = $_SESSION["list_drug_inject_unit2"][$i+1];
			$_SESSION["list_drug_inject_time"][$i] = $_SESSION["list_drug_inject_time"][$i+1];
			$_SESSION["list_drug_inject_slip"][$i] = $_SESSION["list_drug_inject_slip"][$i+1];
			$_SESSION["list_drug_inject_type"][$i] = $_SESSION["list_drug_inject_type"][$i+1];
			$_SESSION["list_drug_inject_etc"][$i] = $_SESSION["list_drug_inject_etc"][$i+1];
			$_SESSION["list_drug_reason"][$i] = $_SESSION["list_drug_reason"][$i+1];
			
			$_SESSION["list_drug_reason2"][$i] = $_SESSION["list_drug_reason2"][$i+1];
		
	}

	unset($_SESSION["list_drugcode"][$count-1]);
	unset($_SESSION["list_drugamount"][$count-1]);
	unset($_SESSION["list_drugslip"][$count-1]);
	unset($_SESSION["list_drug_inject_amount"][$count-1]);
	unset($_SESSION["list_drug_inject_unit"][$count-1]);
	unset($_SESSION["list_drug_inject_amount2"][$count-1]);
	unset($_SESSION["list_drug_inject_unit2"][$count-1]);
	unset($_SESSION["list_drug_inject_time"][$count-1]);
	unset($_SESSION["list_drug_inject_slip"][$count-1]);
	unset($_SESSION["list_drug_inject_type"][$count-1]);
	unset($_SESSION["list_drug_inject_etc"][$count-1]);
	unset($_SESSION["list_drug_reason"][$count-1]);
	unset($_SESSION["list_drug_reason2"][$count-1]);
	exit();
}

//************************** แสดงรายการยาให้เลือก Ajax ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "drug"){
	
	if($_GET["search"] == "viat"){
		$where = "drugcode = '5FLES' OR ";
	}
	
	$sql = "Select prefix From `runno` where `title`  = 'passdrug' limit 1 ";
	list($pass_drug) = mysql_fetch_row(mysql_query($sql));
	$sql = "Select drugcode, tradname, genname,unit, stock, salepri, part, `lock`, lock_dr, drug_lockintern From druglst where ".$where." (drugcode like '%".$_GET["search"]."%' OR genname LIKE '%".$_GET["search"]."%' OR  tradname LIKE '%".$_GET["search"]."%') AND drug_active='y' Order by drugcode ASC";
	//echo $sql;
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:760px; height:320px; overflow:auto; \">";

		
		echo "<table bgcolor=\"#FFFFCC\" width=\"740\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
		<tr align=\"center\" bgcolor=\"#3333CC\">
			<td width=\"20\"><font style=\"color: #FFFFFF\"></font></td>
			<td width=\"50\"><font style=\"color: #FFFFFF\"></font></td>
			<td width=\"391\"><font style=\"color: #FFFFFF\"><strong>ชื่อยา</strong></font></td>
			<td width=\"110\"><font style=\"color: #FFFFFF\"><strong>หน่วย</strong></font></td>
			<td width=\"50\"><font style=\"color: #FFFFFF\"><strong>ราคา</strong></font></td>
			<td width=\"15\" bgcolor=\"#3333CC\"><font style=\"color: #FF0000;\"><strong><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></strong></font></td>
		</tr>"; 


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($arr["lock_dr"] != "Y"){
					if($arr["lock_dr"] =="N"){
						$obj = "ยาตัดออก";
					}else{
						$obj = $arr["lock_dr"];
					}
					$alert="";
				}else if($arr["drug_lockintern"] == "Y" && $sLevel=="intern"){
					$obj = "Staff Only !!!";
				}else if($arr["lock"] != "Y" && (substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09" || substr($_SESSION["ptright_now"],0,3) == "R10"  || substr($_SESSION["ptright_now"],0,3) == "R11"  || substr($_SESSION["ptright_now"],0,3) == "R12"  || substr($_SESSION["ptright_now"],0,3) == "R13"  || substr($_SESSION["ptright_now"],0,3) == "R14"  || substr($_SESSION["ptright_now"],0,3) == "R17"  || substr($_SESSION["ptright_now"],0,3) == "R35"  || substr($_SESSION["ptright_now"],0,3) == "R36"  || substr($_SESSION["ptright_now"],0,3) == "R40")){
					$obj = "รหัสผ่าน:<INPUT TYPE=\"text\" NAME=\"txt_choice\" size=\"3\" maxlength=\"3\" onkeypress=\"if(event.keyCode==13){if(this.value=='".$pass_drug."'){add_drug('".trim($arr["drugcode"])."');}else{alert('รหัสผ่านไม่ถูกต้อง')}} \">";
					$alert="<FONT style=\"font-size: 20px;\" COLOR=\"red\">ติดต่อรับรหัสผ่านได้ที่ผู้อำนวยการโรงพยาบาลเท่านั้น</FONT>";
				}else{
					$obj = "<INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13)add_drug('".trim($arr["drugcode"])."'); \" ondblclick=\"add_drug('".trim($arr["drugcode"])."'); \">";
					$alert="";
				}

				
					$bgcolor="#FF99CC";
				
				if($arr["part"] == "DDY"){
					$style = " style='color:#0000FF;' ";
				}elseif($arr["part"] == "DDN"||$arr["part"] == "DSN"||$arr["part"] == "DPN"){
					$style = " style='color:#FF0000;' ";
				}else{
					$style = "";
				}

				$arr["genname"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["genname"]);
				$arr["tradname"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["tradname"]);
			//แสดงรายการยาที่ค้นหา
			echo "<tr bgcolor=\"$bgcolor\" ".$style.">
					<td rowspan=\"3\" align=\"center\">
					".$obj."</td>
					<td align=\"left\" bgcolor=\"$bgcolor\">ชื่อยา : </td>
					<td align=\"left\" bgcolor=\"$bgcolor\">",$arr["genname"]," / ",$arr["tradname"],"</td>
					<td valign='top' rowspan=\"2\" bgcolor=\"$bgcolor\" align=\"center\">",$arr["unit"],"</td>
					<td valign='top' colspan=\"2\" rowspan=\"2\" bgcolor=\"$bgcolor\">",$arr["salepri"],"</td>
				</tr>
				<tr >
					<td colspan=\"4\" bgcolor=\"$bgcolor\">",$alert,"</td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td height=\"1\"></td>
					<td></td>
				</tr>
			";


			//echo "<TR bgcolor=\"#FFFFCC\">
			//	<TD colspan=\"2\">&nbsp;&nbsp;<B>[]</B> [] [สต็อก : ",$arr["stock"],"] [ บาท] [",$arr["part"],"]</TD>
			//</TR>
			//<TR height=\"3\" bgcolor=\"#FFFFFF\"><TD colspan=\"2\"></TD></TR>
			//";
		$i++;
		}
		echo "</TABLE></Div>";
	}

exit();
}

//************************** แสดงรายการวิธีใช้ยาให้เลือก  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "slip"){

	$sql = "Select detail1, detail2, detail3, detail4, slcode  From drugslip where  (slcode LIKE '%".$_GET["search"]."%') OR (detail1 LIKE '%".$_GET["search"]."%') OR (detail2 LIKE '%".$_GET["search"]."%') OR (detail3 LIKE '%".$_GET["search"]."%')  Order by slcode ASC ";
	$result = Mysql_Query($sql);
	if(Mysql_num_rows($result) > 0){
	$i=" id='choice1' ";
	echo "<Div style=\"position: absolute;text-align: left; width:720px; height:400px; overflow:auto; \"><TABLE width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><TD align=\"center\" bgcolor=\"#3333CC\" width=\"460\"><FONT COLOR=\"#FFFFFF\"><B>รายการวิธีใช้ยา</B></FONT></TD><TD  bgcolor=\"red\" align=\"center\"><FONT COLOR=\"#FFFFFF\"><B><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></B></FONT></TD>";
	while($arr = Mysql_fetch_assoc($result)){
	
	echo "<TR bgcolor=\"#FFCCE6\">
					<TD colspan=\"2\"><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13)addslip('",$arr["slcode"],"'); \" ondblclick=\"addslip('",$arr["slcode"],"'); \" >&nbsp;",$arr["detail1"]," ",$arr["detail2"]," ",$arr["detail3"]," ",$arr["detail4"],"</TD>
				</TR>
				<TR height=\"3\" bgcolor=\"#FFFFFF\"><TD colspan=\"2\"></TD></TR>
	";

	}
	echo "</TABLE></Div>";
	}

exit();
}

////////////////////////////////////slip edit
if(isset($_GET["action"]) && $_GET["action"] == "slip2"){

	$sql = "Select detail1, detail2, detail3, detail4, slcode  From drugslip where  (slcode LIKE '%".$_GET["search"]."%') OR (detail1 LIKE '%".$_GET["search"]."%') OR (detail2 LIKE '%".$_GET["search"]."%') OR (detail3 LIKE '%".$_GET["search"]."%')  Order by slcode ASC ";
	$result = Mysql_Query($sql);
	if(Mysql_num_rows($result) > 0){
	$i=" id='choice1' ";
	echo "<Div style=\"position: absolute;text-align: left; width:720px; height:400px; overflow:auto; \"><TABLE width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><TD align=\"center\" bgcolor=\"#3333CC\" width=\"460\"><FONT COLOR=\"#FFFFFF\"><B>รายการวิธีใช้ยา</B></FONT></TD><TD  bgcolor=\"red\" align=\"center\"><FONT COLOR=\"#FFFFFF\"><B><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></B></FONT></TD>";
	while($arr = Mysql_fetch_assoc($result)){
	
	echo "<TR bgcolor=\"#FFCCE6\">
					<TD colspan=\"2\"><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13)document.getElementById('act".$_GET['num']."').value='".$arr["slcode"]."';\" ondblclick=\"document.getElementById('act".$_GET['num']."').value='".$arr["slcode"]."';document.getElementById('list').innerHTML='';\" >&nbsp;",$arr["detail1"]," ",$arr["detail2"]," ",$arr["detail3"]," ",$arr["detail4"],"</TD>
				</TR>
				<TR height=\"3\" bgcolor=\"#FFFFFF\"><TD colspan=\"2\"></TD></TR>
	";

	}
	echo "</TABLE></Div>";
	}

exit();
}

//******************************************** เรียกวิธีใช้ และ จำนวน ที่ใช้บ่อยออกมาแสดง *****************************
if(isset($_GET["action"]) && $_GET["action"] == "addamount"){

if($_GET["search"] == "1BONA"){
		echo "120,1*2";
	}else if($_GET["search"] == "2HYRU"){
		echo "3,C";
	}else if($_GET["search"] == "2ACLA"){
		echo "1,IV";
	}else if($_GET["search"] == "1BonOne"){
		echo "60,1*1";
	}else if($_GET["search"] == "1CALTR"){
		echo "120,1*2";
	}else if($_GET["search"] == "5FLES"){
		echo "60,1F*1AC";
	}else if($_GET["search"] == "5Artr"){
		echo "180,1*2AC";
	}else if($_GET["search"] == "1SULFIN"){
		echo "90,1*1";
	}else if($_GET["search"] == "14OR016" || $_GET["search"] == "14OR017"  || $_GET["search"] == "4PLAI" ){
		echo "5,G*3";
	}else if($_GET["search"] == "1GASM"){
		echo "90,1*3";
	}else if($_GET["search"] == "1LYRI"){
		echo "60,1HS";
	}else{

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
	}

	$sql = "Select part From druglst Where drugcode = '".$_GET["search"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($part) = Mysql_fetch_row($result);
	echo ",".$part;
	
	$sql = "Select tradname From druglst Where drugcode = '".$_GET["search"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($trad) = Mysql_fetch_row($result);
	echo ",".$trad;

exit();
}

//******************************************** ไม่ใช้งาน *****************************
if(isset($_GET["action"]) && $_GET["action"] == "addslip"){
	
	$sql = "CREATE TEMPORARY TABLE drugrx2 Select slcode, drugcode, amount From  `drugrx` where drugcode = '".$_GET["search"]."' Order by row_id DESC  limit 20";
	//$result = Mysql_Query($sql);

	$sql = "SELECT slcode , count(slcode) FROM `drugrx2` where  amount > 0 GROUP BY slcode  Order by `count(slcode)` DESC limit 1";
	//$result = Mysql_Query($sql) or die(Mysql_ERROR());
	//$arr = Mysql_fetch_assoc($result);
	//echo $arr["slcode"];
exit();
}

//******************************************** ตรวจสอบรหัสยา *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkdrugcode"){

	$sql = "SELECT count(drugcode) as amountcode, genname FROM `druglst` where drugcode = '".$_GET["search"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	$chkgenname1=substr($arr["genname"],0,10);

	
	$sql1 = " Select row_id,genname FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."'  AND drugcode = '".$_GET["search"]."' ";
	$result1 = Mysql_Query($sql1);

	if(Mysql_num_rows($result1) > 0){  //ถ้ามียาที่แพ้อยู่
			echo "3";
	}else if($arr["amountcode"] > 0){
		$sql2 = "Select genname FROM drugreact WHERE  hn = '".$_SESSION["hn_now"]."'  AND genname like '".$chkgenname1."%' limit 0,1";
		$result2 = mysql_query($sql2);
		$arr2 = Mysql_fetch_assoc($result2);
		if(!empty($arr2["genname"])){  //ถ้ามียาในกลุ่มที่แพ้	
			echo "55";
		}else{
			echo "1";
		}	
	}else{
		echo "0";
	}
		
exit();
}

//*********************************** ตรวจสอบการlockจ่ายยา *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkpharlock"){

	$sql = "SELECT * FROM `drug_pharlock` where drugcode = '".$_GET["search"]."' and hn = '".$_SESSION["hn_now"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	if(Mysql_num_rows($result) ==1){  //พบการ lock ยา
		echo "Y";  //LOCK
	}else{
		echo "N";  //ไม่ LOCK
	}
exit();
}

//*********************************** ตรวจสอบการ DPY_CODE *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkdpycode"){

		$sql = "SELECT * FROM `druglst` where drugcode = '".$_GET["search"]."' and (dpy_code = '5702' || dpy_code = '5703' || dpy_code = '8701' || dpy_code = '8703' || dpy_code='8711')";
		$result = Mysql_Query($sql);
		$arr = Mysql_fetch_assoc($result);
		if(Mysql_num_rows($result) ==1  && substr($_SESSION["ptright_now"],0,3) == "R07"){  //พบ dpy_code ตามที่ระบุ เฉพาะสิทธิประกันสังคม
			echo "Y";  //ให้ออกใบรับรอง
		}else{
			echo "N";  //ไม่ต้องออกใบรับรอง
		}
exit();
}


///////////////////////////////////////////////////-ตรวจสอบสิทธิการจ่ายยา-///////////////////////////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "checkptright"){

	$sql = "SELECT lockptright,tradname,drug_lockucsso FROM `druglst` where drugcode = '".$_GET["search"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  || substr($_SESSION["ptright_now"],0,3) == "R02"|| substr($_SESSION["ptright_now"],0,3) == "R03"  )){
		if($arr['lockptright']=="Y"){
		//echo "1";
			echo "ยา ".$arr['tradname']." นี้ไม่สามารถจ่ายยาในสิทธิ ".substr($_SESSION["ptright_now"],4)." ได้ \nถ้าผู้ป่วยแจ้งความจำนงต้องจ่ายเงินเองเท่านั้น\nต้องการใช่หรือไม่?";
		}
		else{
			echo "0";
		}
	}else{
		echo "0";
	}
	
exit();
}


///////////////////////////////////////////////////-ตรวจสอบสิทธิการจ่ายยา original ให้ผู้ป่วย-///////////////////////////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "checkptrightucsso"){

	$sql = "SELECT drug_lockucsso FROM `druglst` where drugcode = '".$_GET["search"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09" || substr($_SESSION["ptright_now"],0,3) == "R10" || substr($_SESSION["ptright_now"],0,3) == "R11" || substr($_SESSION["ptright_now"],0,3) == "R12"|| substr($_SESSION["ptright_now"],0,3) == "R36"  )){
		if($arr['drug_lockucsso']=="1"){
			echo "1";  //กำหนด lock ยา original 
		}else{
			echo "0";  //ไม่ lock
		}
	}else{
		echo "0"; //ไม่ lock
	}
	
exit();
}



//////////////////////////// checkviat //////////////////////////////////

if(isset($_GET["action"]) && $_GET["action"] == "viatcheck"){
	$count = count($_SESSION["list_drugcode"]);
	for($i=0;$i<$count;$i++){
		if(trim($_SESSION["list_drugcode"][$i])=="5VIAT" && $_SESSION["list_drug_reason"][$i]!="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
			$sqlquery = "select * from drug_gruco where hn='".$_SESSION['hn_now']."' and dateup like '".date("d-m-Y")."%'";
			$resultq = Mysql_Query($sqlquery) or die(Mysql_ERROR());
			$arrq = mysql_num_rows($resultq);
			if($arrq=='0'){
				echo "0";
			}else{
				echo "1";
			}
		}
	}
exit();
}

//////////////////////////// checkartr //////////////////////////////////

if(isset($_GET["action"]) && $_GET["action"] == "artrcheck"){
	$count = count($_SESSION["list_drugcode"]);
	for($i=0;$i<$count;$i++){
		if($_SESSION["list_drugcode"][$i]=="5ARTR"&&$_SESSION["list_drug_reason"][$i]!="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
			$sqlquery = "select * from drug_gruco where hn='".$_SESSION['hn_now']."' and dateup like '".date("d-m-Y")."%'";
			$resultq = Mysql_Query($sqlquery) or die(Mysql_ERROR());
			$arrq = mysql_num_rows($resultq);
			if($arrq=='0'){
				echo "0";
			}else{
				echo "1";
			}
		}
	}
exit();
}

//////////////////////////// checkviatn //////////////////////////////////

if(isset($_GET["action"]) && $_GET["action"] == "viatncheck"){
	$count = count($_SESSION["list_drugcode"]);
	for($i=0;$i<$count;$i++){
		if($_SESSION["list_drugcode"][$i]=="5VIAT-N"&&$_SESSION["list_drug_reason"][$i]!="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
			$sqlquery = "select * from drug_gruco where hn='".$_SESSION['hn_now']."' and dateup like '".date("d-m-Y")."%'";
			$resultq = Mysql_Query($sqlquery) or die(Mysql_ERROR());
			$arrq = mysql_num_rows($resultq);
			if($arrq=='0'){
				echo "0";
			}else{
				echo "1";
			}
		}
	}
exit();
}



//******************************************** ตรวจสอบจำนวนยา *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkdrugamount"){
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){
	$sql = "SELECT limit_pay, limit_ptright, drug_condition, drug_minstock, drug_lacktime FROM `druglst` where drugcode='".$_GET["chkdrugcode"]."'";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
		if($arr["limit_ptright"] !="" && $arr["limit_ptright"] !=0 && $arr["limit_ptright"] < $_GET["search"]){
			echo "1";
		}else if($arr["limit_pay"] !="" && $arr["limit_pay"] !=0 && $arr["limit_pay"] < $_GET["search"]){
			echo "2";
		}
	if($arr["drug_condition"] > 0){
		echo "4";
	}else if($arr["drug_minstock"] > 0){
		echo "5";
	}else if($arr["drug_lacktime"] > 0){
		echo "6";
	}		
	exit();
	}else{
	$sql = "SELECT limit_pay, drug_condition, drug_minstock, drug_lacktime FROM `druglst` where drugcode='".$_GET["chkdrugcode"]."'";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
		if($arr["limit_pay"] !="" && $arr["limit_pay"] !=0 && $arr["limit_pay"] < $_GET["search"]){
				echo "3";
		}
	if($arr["drug_condition"] > 0){
		echo "4";
	}else if($arr["drug_minstock"] > 0){
		echo "5";
	}else if($arr["drug_lacktime"] > 0){
		echo "6";
	}		
	exit();	
	}
}

//******************************************** ตรวจสอบรหัสวิธีใช้ยา *****************************
if(isset($_GET["action"]) && $_GET["action"] == "checkdrugslip"){

	$sql = "SELECT count(slcode) as amountcode FROM `drugslip` where slcode = '".$_GET["search"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	echo $arr["amountcode"];
exit();
}


//******************************************** ตรวจสอบการเกิด DRUG INTERACTION *****************************
if(isset($_GET["action"]) && $_GET["action"] == "drug_interaction"){

///////////////////////////////////////////////////////
		$listinteraction =array();
		$listremedint =array();
		
		$sql = " Select row_id, doctor From dphardep where hn = '".$_SESSION["hn_now"]."' AND whokey = 'DR' AND idname <> '".$_SESSION["dt_doctor"]."' AND date like '".((date("Y")+543).date("-m-d"))."%' AND dr_cancle is null Order by row_id DESC limit 1 ";
		
		$result = mysql_query($sql);
		$rows = mysql_num_rows($result);
		if($rows > 0){
		
			while(list($row_id, $doctor) = mysql_fetch_row($result)){
				$sql = " Select b.genname, b.tradname, a.drugcode, a.amount, b.unit ,a.slcode From ddrugrx as a LEFT JOIN druglst as b ON a.drugcode = b.drugcode where a.idno = '".$row_id."'  ";
				$result2 = mysql_query($sql) or die(mysql_error());
	
	
				while(list($genname, $tradname, $drugcode, $amount, $unit ,$slcode) = mysql_fetch_row($result2)){
					$chkgenname=substr($genname,0,12);
					list($detail1,  $detail2,  $detail3,  $detail4 ) = mysql_fetch_row(mysql_query("Select detail1 , detail2 , detail3 , detail4 From drugslip where slcode = '".$slcode."' limit 1 "));
					array_push($listinteraction,$drugcode);
					
				}
			}

		}
		//print_r($listinteraction);
		$sql  = "SELECT  drugcode FROM drugrx  WHERE hn = '".$_SESSION["hn_now"]."' AND drugcode <> 'INJ' ";
		$result = mysql_query($sql);
		$rows = mysql_num_rows($result);
		if($rows > 0){
			while(list($codes) = mysql_fetch_row($result)){
				array_push($listremedint,$codes);
			}
		}
	$list_session = " '".implode("','",$_SESSION["list_drugcode"])."' ";
	$list_session2 = " '".implode("','",$listinteraction)."' ";//listยาที่มาจากแพทย์อื่น
	$list_session3 = " '".implode("','",$listremedint)."' ";//listยาที่มาจากการremed

	//print_r($listinteraction);

	$sql = "SELECT first_drugcode, between_drugcode,first_genname,between_genname effect, action, follow, onset, violence, referable, status  FROM drug_interaction  where (first_drugcode = '".$_GET["drugcode"]."' AND between_drugcode in (".$list_session.") ) OR (between_drugcode = '".$_GET["drugcode"]."' AND first_drugcode in (".$list_session.") ) OR (first_drugcode = '".$_GET["drugcode"]."' AND between_drugcode in (".$list_session2.") ) OR (between_drugcode = '".$_GET["drugcode"]."' AND first_drugcode in (".$list_session2.") ) OR (first_drugcode = '".$_GET["drugcode"]."' AND between_drugcode in (".$list_session3.") ) OR (between_drugcode = '".$_GET["drugcode"]."' AND first_drugcode in (".$list_session3.") ) ";
	
	$result = Mysql_Query($sql);
	$rows = Mysql_num_rows($result);
		if($rows == 0){
			echo "0";
		}else{
			$arr = Mysql_fetch_assoc($result);
			$i=0;
			$sql = " Select genname From  druglst where drugcode in ('".$arr["first_drugcode"]."','".$arr["between_drugcode"]."') ";
			$result = Mysql_Query($sql);
			while($arr2 = Mysql_fetch_assoc($result)){
				$druglist[$i] = $arr2["genname"];
				$i++;
			}

			if($arr["status"]=="popup"){
				echo "1เกิด Drug Interaction ระหว่างยา ".$druglist[0]." กับยา ".$druglist[1]." \n ผลกระทบ : ".$arr["effect"]." \n กลไกที่เกิด : ".$arr["action"]." \n การติดตาม : ".$arr["follow"]." \n onset : ".$arr["onset"]." \n ความรุนแรง : ".$arr["violence"]." \n หลักฐาน : ".$arr["referable"]." \n สถานะ : ".$arr["status"]." \n ท่านยังต้องการจ่ายยาหรือไม่? ";
			}else if($arr["status"]=="lock"){
				echo "2เกิด Drug Interaction ระหว่างยา ".$druglist[0]." กับยา ".$druglist[1]." \n ผลกระทบ : ".$arr["effect"]." \n กลไกที่เกิด : ".$arr["action"]." \n การติดตาม : ".$arr["follow"]." \n onset : ".$arr["onset"]." \n ความรุนแรง : ".$arr["violence"]." \n หลักฐาน : ".$arr["referable"]." \n สถานะ : ".$arr["status"]." \n";
			}
		}
	
	exit();
}


//**********************************************************************************************
?>
<html>
<head>
<title><?php echo $_SESSION["dt_doctor"];?></title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 22px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFC1; color:#0000FF; }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>

<SCRIPT LANGUAGE="JavaScript">
/*Fix trim not work on IE8 or under*/
if(typeof String.prototype.trim !== 'function'){
	String.prototype.trim = function(){
		return this.replace(/^\s+|\s+$/g, '');
	}
}

if(!Array.prototype.indexOf){
	Array.prototype.indexOf = function(obj, start){
		for(var i = (start || 0), j=this.length; i<j; i++){
			if(this[i] === obj){
				return i;
			}
		}
		return -1;
	}
}

var nsaids13_list = ["1CELE200*", "1INDO", "1LOXO", "1NID", "1VOL-C", "1VOLSR", "1PONS", "1ARCO", "1BREX", "1MOBI", "1ARCO30", "1CELE_400", "1MOBI-C", "1ACEO", "1NID-C", "1ARCO_60", "1LOXO-N", "1NAPR", "1MOB7.5", "1VOL-N", "1VOL-NN", "1INDO-N", "1NAPR-N", "1ARCO120" ];
var nsaids14_list = ["1CELE200*", "1INDO", "1LOXO", "1NID", "1VOL-C", "1VOLSR", "2CLOF", "2DYNA", "1PONS", "1ARCO", "4PLAI", "4VOLT-C", "1BREX", "1MOBI", "1ARCO30", "1CELE_400", "2KETO", "1MOBI-C", "1ACEO", "1NID-C", "1ARCO_60", "1LOXO-N", "1NAPR", "1MOB7.5", "1VOL-N", "1VOL-NN", "1INDO-N", "2DICL", "1NAPR-N", "1ARCO120"];

var drug_cc='';
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


function searchSuggest(action,str,len) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dt_drug.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

var count=0;
function check_drug(drug_cc){
	//1 มียาตัวอื่น
	//2 มียา 5VIAT
	//0 ไม่มียา
	if(drug_cc=='1APRO'|drug_cc=='1BLOP16*'|drug_cc=='1OLME40'|drug_cc=='1MICA40'|drug_cc=='1LIPI*??'|drug_cc=='1CRES20'|drug_cc=='1MEVA40*?'|drug_cc=='1LIVA'|drug_cc=='1LESC80*??'|drug_cc=='1PARI'|drug_cc=='1NEX40'|drug_cc=='1PREV'|drug_cc=='1ARCO'|drug_cc=='1CELE200*'|drug_cc=='2DYNA'|drug_cc=='1CODI160'){
		if(count==2){
			alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
			return false;
		}
		else{
		count=1;
window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
		return true;
		}
	}else if(drug_cc=='5VIAT' || drug_cc=='5VIAT    '){  //ยาไวอาทิล
		var sit = '<?=$_SESSION["ptright_now"]?>';
		sit = sit.substring(0,3);
		if(sit=="R02" || sit=="R03"){
				var agep = '<?=$_SESSION["age_now"]?>';
				agep = agep.substring(0,2);
				if(agep>="56"){
					if(count==1|count==2){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}
					else{
						count=2;
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
	window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
						return true;
						}
					}
				}//อายุ
				else{
					if(count==1){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}else{
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
							alert("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้?");
							return false;
/*							if(confirm("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้ ท่านต้องการจ่ายยาใช่หรือไม่ ?")==true){
								count=2;
								window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');						
								return true;
							}else{
								return false;
							}*/
						}
					}
				}//อายุ
		}//สิทธิ์
		else{
			if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
				return true;
			}else{
				window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
				return true;
			}
		}//สิทธิ์
	}else if(drug_cc=='5ARTR'){ //ยาไวอาทิล
		var sit = '<?=$_SESSION["ptright_now"]?>';
		sit = sit.substring(0,3);
		if(sit=="R02" || sit=="R03"){
				var agep = '<?=$_SESSION["age_now"]?>';
				agep = agep.substring(0,2);
				if(agep>="56"){
					if(count==1|count==2){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}
					else{
						count=2;
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
	window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
						return true;
						}
					}
				}//อายุ
				else{
					if(count==1){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}else{
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
							alert("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้?");
							return false;
/*							if(confirm("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้ ท่านต้องการจ่ายยาใช่หรือไม่ ?")==true){
								count=2;
								window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');						
								return true;
							}else{
								return false;
							}*/
						}
					}
				}//อายุ
		}//สิทธิ์
		else{
			if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
				return true;
			}else{
				window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
				return true;
			}
		}//สิทธิ์
	}else if(drug_cc=='5Artr'){ //ยาไวอาทิล ปรับปรุง 15-09-59
		var sit = '<?=$_SESSION["ptright_now"]?>';
		sit = sit.substring(0,3);
		if(sit=="R02" || sit=="R03"){
				var agep = '<?=$_SESSION["age_now"]?>';
				agep = agep.substring(0,2);
				if(agep>="56"){
					if(count==1|count==2){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}
					else{
						count=2;
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
	window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
						return true;
						}
					}
				}//อายุ
				else{
					if(count==1){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}else{
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
							alert("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้?");
							return false;
/*							if(confirm("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้ ท่านต้องการจ่ายยาใช่หรือไม่ ?")==true){
								count=2;
								window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');						
								return true;
							}else{
								return false;
							}*/
						}
					}
				}//อายุ
		}//สิทธิ์
		else{
			if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
				return true;
			}else{
				window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
				return true;
			}
		}//สิทธิ์		
	}else if(drug_cc=='5VIAT-N'){ //ยาไวอาทิล
		var sit = '<?=$_SESSION["ptright_now"]?>';
		sit = sit.substring(0,3);
		if(sit=="R02" || sit=="R03"){
				var agep = '<?=$_SESSION["age_now"]?>';
				agep = agep.substring(0,2);
				if(agep>="56"){
					if(count==1|count==2){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}
					else{
						count=2;
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
	window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
						return true;
						}
					}
				}//อายุ
				else{
					if(count==1){
						alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
						return false;
					}else{
						if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
							return true;
						}else{
							alert("ผู้ป่วยอายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้?");
							return false;
/*							if(confirm("อายุต่ำกว่า 56 ปี ไม่สามารถใช้ยาตัวนี้ในระบบจ่ายตรงได้ ท่านต้องการจ่ายยาใช่หรือไม่ ?")==true){
								count=2;
								window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');						
								return true;
							}else{
								return false;
							}*/
						}
					}
				}//อายุ
		}//สิทธิ์
		else{
			if(document.form1.reason.value=="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)"){
				return true;
			}else{
				window.open('arbs.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
				return true;
			}
		}//สิทธิ์				
	}else if(drug_cc=='2ESPO'|drug_cc=='2RECO'){
		window.open('eryth.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
		return true;
	}
	else if(drug_cc=='2CLE0.4*$'|drug_cc=='2CLE0.6*$'|drug_cc=='2INNO*'){
		window.open('drug_g.php?name='+drug_cc,null,'height=550,width=600,scrollbars=1');
		return true;
	}
	else{
		if(count==2){
			alert("ไม่สามารถสั่งร่วมกับยาตัวอื่นได้");
			return false;
		}
		else{
			count=1;
			return true;	
		}
	}
}

function check_inject(str){

	if(String(str).substring(0,1) == "2" || String(str).substring(0,1) == "0"){
		if(String(str).substring(2,1) != "0" && String(str).substring(2,1) != "1" && String(str).substring(2,1) != "2" && String(str).substring(2,1) != "3" && String(str).substring(2,1) != "4" && String(str).substring(2,1) != "5" && String(str).substring(2,1) != "6" && String(str).substring(2,1) != "7" && String(str).substring(2,1) != "8" && String(str).substring(2,1) != "9"){
			
			return true;
		}else{
			return false;
		}
		
	}else{
		return false;
	}

}

function clearobt(nameojt){
	for(i=document.form1.reason.options.length;i>=0;i--){
		document.form1.reason.remove(i);
	}
}

function addobtreason(nameojt,path,dc,sl){

	if(path == "DDY"){
		
		/*nameojt.options[nameojt.options.length]=new Option("ใช้ยาในบัญชียาหลักแล้วไม่ดีขึ้น","ใช้ยาในบัญชียาหลักแห่งชาติแล้วไม่ดีขึ้น");
		nameojt.options[nameojt.options.length]=new Option("ไม่มียาในบัญชียาหลักที่ใช้รักษาตามข้อบ่งชี้","ไม่มียาในบัญชียาหลักแห่งชาติที่ใช้รักษาตามข้อบ่งชี้");
		nameojt.options[nameojt.options.length]=new Option("แพ้ยาในบัญชียาหลักแห่งชาติ","แพ้ยาในบัญชียาหลักแห่งชาติ");
		nameojt.options[nameojt.options.length]=new Option("มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชีได้","มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชียาหลักต่อไปได้");

		nameojt.options[nameojt.options.length]=new Option("ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา","ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา(drug interaction)กับยาในบัญชียาหลักแห่งชาติ");
		nameojt.options[nameojt.options.length]=new Option("ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน","ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน");
		nameojt.options[nameojt.options.length]=new Option("มีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย","มีความจำเป็นที่ต้องใช้ยานอกบัญชียาหลักเพราะมีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย");*/
		nameojt.options[nameojt.options.length]=new Option("เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา","A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา");  
		nameojt.options[nameojt.options.length]=new Option("ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย","B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย");
		nameojt.options[nameojt.options.length]=new Option("ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด","C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด");
		nameojt.options[nameojt.options.length]=new Option("มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ","D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ");

		nameojt.options[nameojt.options.length]=new Option("ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า","E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า");
		nameojt.options[nameojt.options.length]=new Option("ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)","F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)");
		nameojt.value = sl;
		

	}/*else{
		
		if(dc=="1NEUT300*$"){
			nameojt.options[nameojt.options.length]=new Option("ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท","ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท");
			nameojt.options[nameojt.options.length]=new Option("ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น","ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น");
			nameojt.options[nameojt.options.length]=new Option("เกิดอาการข้างเคียงจากยากลุ่มอื่น","เกิดอาการข้างเคียงจากยากลุ่มอื่น");
			
        }else if(dc=="1NEUT100*$"){
			nameojt.options[nameojt.options.length]=new Option("ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท","ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท");
			nameojt.options[nameojt.options.length]=new Option("ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น","ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น");
			nameojt.options[nameojt.options.length]=new Option("เกิดอาการข้างเคียงจากยากลุ่มอื่น","เกิดอาการข้างเคียงจากยากลุ่มอื่น");
        }else if(dc=="1NEU100-C"){
			nameojt.options[nameojt.options.length]=new Option("ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท","ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท");
			nameojt.options[nameojt.options.length]=new Option("ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น","ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น");
			nameojt.options[nameojt.options.length]=new Option("เกิดอาการข้างเคียงจากยากลุ่มอื่น","เกิดอาการข้างเคียงจากยากลุ่มอื่น");
        }else if(dc=="1NEU300-C"){
			nameojt.options[nameojt.options.length]=new Option("ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท","ใช้บรรเทาอาการปวดซึ่งเกิดจากความผิดปกติของเส้นประสาท");
			nameojt.options[nameojt.options.length]=new Option("ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น","ล้มเหลวจากการใช้ยาแก้ปวดกลุ่มอื่น");
			nameojt.options[nameojt.options.length]=new Option("เกิดอาการข้างเคียงจากยากลุ่มอื่น","เกิดอาการข้างเคียงจากยากลุ่มอื่น");


		}else if(dc=="1PLAV*"){
			nameojt.options[nameojt.options.length]=new Option("ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin","ผู้ป่วยที่มีข้อห้ามใช้หรือแพ้aspirin");
			nameojt.options[nameojt.options.length]=new Option("ใช้ระยะสั้นในการใส่ stent","ใช้ระยะสั้นในการใส่ stent");
			nameojt.options[nameojt.options.length]=new Option("AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้","AF หรือ antiphospholipid syndrome ซึ่งไม่สามารถใช้ anticoagulant ได้");
			nameojt.options[nameojt.options.length]=new Option("ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้","ผู้ป่วยที่มี multiple thrombotic risk factors ซึ่งไม่สามารถควบคุมได้");
			
		}
		
		if(sl != ''){
			nameojt.value = sl;
		}else{
			nameojt.selectedIndex = 0;
		}

	}*/

	
	if(nameojt.value == '' && sl != ""){
			nameojt.options[nameojt.options.length]=new Option("กรุณาเลือกเหตุผล","กรุณาเลือกเหตุผล");
			nameojt.value = sl;
			nameojt.selectedIndex = 6;
			//nameojt.options[nameojt.options.length]=new Option(sl,sl);
			//nameojt.value = sl;
	}
	

}

function add_drug(drugcode){
	
	var doctor_id = document.getElementById('doctor_id').value;
	if( doctor_id != 'md32166' && doctor_id != 'md29268' ){
		if( drugcode == '6VISL' || drugcode == '6HIAL' ){
			alert('ยาควบคุมราคา กรุณาให้จักษุแพทย์สั่งยา');
		}
	}

	var returnstr;

	xmlhttp = newXmlHttp();

	document.getElementById("drug_code").value = drugcode;
	url = 'dt_drug.php?action=addamount&search=' + drugcode;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	
	returnstr = xmlhttp.responseText;
	var vl = returnstr.split(",");
	document.getElementById("drug_amount").value = vl[0];
	
	//url = 'dt_drug.php?action=addslip&search=' + drugcode;
	//xmlhttp.open("GET", url, false);
	//xmlhttp.send(null);

	document.getElementById("drug_slip").value = vl[1];
	document.getElementById('list').innerHTML='';
	document.getElementById("drug_amount").select();
	//document.getElementById("drug_code2").value = vl[3];
	
	if(vl[2] == "DDY" ){
		//|| drugcode =="1NEU300-C"|| drugcode =="1NEUT300*$" || drugcode =="1NEUT100*$"|| drugcode =="1NEU100-C"|| drugcode == "1PLAV*"
		document.getElementById('reason').style.display = '';
		clearobt(document.form1.reason);
		if(vl[2] == "DDY"){
			sl ="";
		}else{
			sl="";
		}
		addobtreason(document.form1.reason,vl[2],drugcode,sl);
	}else{
		document.getElementById('reason').style.display = 'none';
	}

	if(check_inject(drugcode) == true){
			//alert('เรียนแพทย์เนื่องจากมีการปรับเปลี่ยนวิธีการสั่งฉีดยา\nถ้าแพทย์ต้องการสั่ง อินซูลิน ให้แพทย์เลือกวิธีฉีดเป็น 1ins หรือ 2ins');
			document.getElementById('drug_slip').value='b';
			document.getElementById('slip_detail').style.display = 'none';
			document.getElementById('drug_inject_amount').style.display = '';
			document.getElementById('drug_inject_time').style.display = '';
			document.getElementById('drug_inject_slip').style.display = '';
			document.getElementById('drug_inject_type').style.display = '';
			document.getElementById('drug_inject_etc').style.display = '';
	}else{

			document.getElementById('drug_inject_amount').style.display = 'none';
			document.getElementById('drug_inject_amount2').style.display = 'none';
			document.getElementById('drug_inject_time').style.display = 'none';
			document.getElementById('drug_inject_slip').style.display = 'none';
			document.getElementById('drug_inject_type').style.display = 'none';
			document.getElementById('drug_inject_etc').style.display = 'none';
	}

	glibenclamide_alert(drugcode.trim());

	kidney_egfr_alert(drugcode.trim());
		
}

function glibenclamide_alert(drugcode){

	var hn_test = '<?=$_SESSION['hn_now'];?>';
	var age_test = '<?=$_SESSION['age_now']?>'.substring(0,2);
	age_test = parseInt(age_test);

	var egfr_test = '<?=$res_egfr;?>';
	egfr_test = parseFloat(egfr_test);

	/* glibenclamide ในตัวชี้วัดที่ 11 */
	if( drugcode == '1EUGL-C' ){

		var gliben_txt = '';

		if( age_test > 65 ){
			gliben_txt = '- ในผู้ป่วยอายุมากกว่า 65ปี'+"\n";
		}

		/* เหลือ เปรียบเทียบกับ egfr < 60 */
		if( egfr_test < 60.00 ){
			gliben_txt += '- ในผู้ป่วยที่มีค่า eGFR น้อยว่า60'+"\n";
		}

		if( gliben_txt !== '' ){
			alert("แจ้งเตือน การใช้ยาอย่างสมเหตุสมผล ห้ามใช้ Glibenclamide\n"+gliben_txt);
		}
	}
} 

function kidney_egfr_alert(drugcode){
	var egfr_test = '<?=$res_egfr;?>';
	egfr_test = parseFloat(egfr_test);

	var kidney_txt = '';
	if( egfr_test < 60.00 && nsaids14_list.indexOf(drugcode) > -1 ){
		kidney_txt += 'ในผู้ป่วยที่เป็นโรคไตเรื้อรังระดับ3ขึ้นไป';
	}

	if( kidney_txt !== '' ){
		alert("แจ้งเตือน การใช้ยาอย่างสมเหตุสมผล เลี่ยงการใช้ยา NSAIDs \n"+kidney_txt);
	}
}

function addslip(drugslip){
	
	document.getElementById("drug_slip").value = drugslip;
	document.getElementById('list').innerHTML='';
	document.getElementById("form_submit").focus();
}

function addslip2(action,str,len,no) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dt_drug.php?action='+action+'&search=' + str+'&num=' + no;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
function ajaxcheck(action,str,drugcode){
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action='+action+'&search=' + str+'&chkdrugcode=' + drugcode;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return xmlhttp.responseText;
}

function viewlist(){

	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=viewtolist';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("druglist").innerHTML = xmlhttp.responseText;

	xmlhttp2 = newXmlHttp();
	url = 'dt_drug.php?action=rduin13';
	xmlhttp2.open("GET", url, false);
	xmlhttp2.send(null);
	var test_rud13_count = parseInt(xmlhttp2.responseText.trim());

	if ( test_rud13_count > 1 ) {
		alert('แจ้งเตือน การใช้ยาอย่างสมเหตุสมผล เลี่ยงการใช้ยากลุ่ม NSAIDs ซ้ำซ้อน');
	}


}



function addtolist(drugcode, drugamount, drugslip,addoredit, drug_inject_amount, drug_inject_unit, drug_inject_amount2, drug_inject_unit2, drug_inject_time, drug_inject_slip, drug_inject_type, drug_inject_etc,reason,reason2){
	
	xmlhttp = newXmlHttp();
	
	//alert(reason2);

	
	
	url = 'dt_drug.php?action=addtolist&drugcode=' + drugcode+'&drugamount='+drugamount+'&drugslip='+drugslip+'&addoredit='+addoredit+'&drug_inject_amount='+drug_inject_amount+'&drug_inject_unit='+drug_inject_unit+'&drug_inject_amount2='+drug_inject_amount2+'&drug_inject_unit2='+drug_inject_unit2+'&drug_inject_time='+drug_inject_time+'&drug_inject_slip='+drug_inject_slip+'&drug_inject_type='+drug_inject_type+'&drug_inject_etc='+drug_inject_etc+'&reason='+reason+'&reason2='+reason2
	;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();
	alert500();

}

function alert500(){
	
	if(eval(document.getElementById("total_all_price").value) > 700){

	var ptright = '<?php echo substr($_SESSION["ptright_now"],0,3);?>';
	var stat = '';
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=alert500';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	stat = xmlhttp.responseText;
	stat = stat.substr(4);
		if(stat == '0'){
			if((ptright == 'R07' || ptright == 'R09' || ptright == 'R10' || ptright == 'R11' || ptright == 'R12' || ptright == 'R13' || ptright == 'R14' || ptright == 'R17' || ptright == 'R35' || ptright == 'R36') && eval(document.getElementById("total_all_price").value) > 700){
					alert("คำเตือน....ท่านได้จ่ายยาเกิน 700 บาท ให้ ผู้ป่วย สิทธิ <?php echo substr($_SESSION["ptright_now"],4);?>");
			}
		}
	}

}

function select_dateremed(date_remed){
	
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=date_remed&date_remed=' + date_remed;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_remed").innerHTML = xmlhttp.responseText;
}
function select_dateremed2(date_remed){
	
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=date_remed2&date_remed=' + date_remed;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_remed2").innerHTML = xmlhttp.responseText;
}

function select_datesult(date_sult){
	
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=date_sult&date_sult=' + date_sult;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_sult").innerHTML = xmlhttp.responseText;
	checkall3(true);
}

function del_list(){
	xmlhttp = newXmlHttp();
	for(i=0;i<eval(document.form_list.elements.length);i++){

		if(document.form_list.elements[i].name == "check_list[]" && document.form_list.elements[i].checked == true){
			url = 'dt_drug.php?action=deltolist&number=' + document.form_list.elements[i].value;
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

function drug_interaction(drugcode){
	var return_drug_interaction;

	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=drug_interaction&drugcode=' + drugcode;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return_drug_interaction = xmlhttp.responseText;
	return_drug_interaction = return_drug_interaction.substr(4);
	return return_drug_interaction;
}


function checkForm1(){
	var txt ;
	var txt1 ;
	var txt2 ;
	

	txt = ajaxcheck("checkdrugcode",document.form1.drug_code.value);
	txt = txt.substr(4);
	
	txt1 = ajaxcheck("checkdrugamount",document.form1.drug_amount.value,document.form1.drug_code.value);
	txt1 = txt1.substr(4);	

	txt2 = ajaxcheck("checkdrugslip",document.form1.drug_slip.value);
	txt2 = txt2.substr(4);
	
	txt3 = ajaxcheck("check30day",document.form1.drug_code.value);
	txt3 = txt3.substr(4);
	
	txt7 = ajaxcheck("checktoday",document.form1.drug_code.value);
	txt7 = txt7.substr(4);
	
	txt8 = ajaxcheck("checkptright",document.form1.drug_code.value);
	txt8 = txt8.substr(4);

	txt9 = ajaxcheck("checkptrightucsso",document.form1.drug_code.value);
	txt9 = txt9.substr(4);	
	
	txt10 = ajaxcheck("checkpharlock",document.form1.drug_code.value);
	txt10 = txt10.substr(4);		
	//alert(txt10);
	
	txt11 = ajaxcheck("checkdpycode",document.form1.drug_code.value);
	txt11 = txt11.substr(4);		
	//alert(txt11);	

	return_drug_interaction = drug_interaction(document.form1.drug_code.value);

	if(document.form1.drug_code.value == ""){
		alert("กรุณาใส่รหัสยา");
		document.form1.drug_code.focus();
	}else if(document.form1.drug_amount.value == "" || eval(document.form1.drug_amount.value) <=0){
		alert("กรุณาใส่จำนวนยา");
		document.form1.drug_amount.focus();
	}else if(document.form1.drug_slip.value == ""){
		alert("กรุณาใส่วิธีใช้ยา");
		document.form1.drug_slip.focus();	
	}else if(txt10 == "Y" && !alert("ยาระงับการจ่ายให้ผู้ป่วยรายนี้")){  //lock ในตาราง drug_pharlock
		document.form1.drug_code.focus();
	}else if(txt11 == "Y" && alert("กรุณาออกใบรับรองการใช้อวัยวะเทียมและอุปกรณ์ในการบำบัดรักษา เพื่อแนบเป็นเอกสารเบิกกับประกันสังคม!!!")){  //ออกใบรับรอง
		document.form1.drug_code.focus();		
	}else if(txt == "0"){
		alert("กรุณาลองใส่รหัสยาใหม่");
		document.form1.drug_code.focus();
	}else if(txt1 == "1"){
		alert("ผิดพลาด ท่านใส่จำนวนยามากกว่าเงื่อนไขที่ LIMIT PTRIGHT ไว้");
		document.form1.drug_amount.focus();	
	}else if(txt1 == "2"){
		alert("ผิดพลาด ผู้ป่วยสิทธิประกันสังคม และประกันสุขภาพถ้วนหน้า แต่ท่านใส่จำนวนยามากกว่าเงื่อนไขที่ LIMIT PAY ไว้");
		document.form1.drug_amount.focus();				
	}else if(txt1 == "3"){
		alert("ผิดพลาด ท่านใส่จำนวนยามากกว่าเงื่อนไขที่ LIMIT PAY ไว้");
		document.form1.drug_amount.focus();		
	}else if(txt1 == "4" && !alert("คำเตือน!!! ยาสั่งซื้อแล้ว แต่บริษัทยังไม่ได้จัดส่ง !!!")){
		document.form1.drug_amount.focus();		
	}else if(txt1 == "5" && !alert("คำเตือน!!! ยาใกล้หมด Stock แล้ว")){
		document.form1.drug_amount.focus();			
	}else if(txt1 == "6" && !alert("คำเตือน!!! ยาขาดคราวจากบริษัท")){
		document.form1.drug_amount.focus();										
	}else if(txt2 == "0"){
		alert("กรุณาใส่วิธีใช้ยา ใหม่");
		document.form1.drug_slip.focus();
	}else if(txt == "3" && !alert("ผู้ป่วยมีการแพ้ยาตัวนี้ ไม่สามารถจ่ายยาได้ ต้องการจ่ายยาให้ติดต่อห้องยาเพื่อลบการแพ้ยา")){
	document.form1.drug_code.focus();
	//else if(txt == "3" && !confirm("ผู้ป่วยมีการแพ้ยาตัวนี้ ต้องการจ่ายยาหรือไม่?")){
	//	document.form1.drug_code.focus();
	}else if(txt == "55" && !alert("ผู้ป่วยมีการแพ้ยาในกลุ่มนี้ ไม่สามารถจ่ายยาได้ กรุณาติดต่อเภสัชกรห้องยาค่ะ")){
	document.form1.drug_code.focus();
	}else if(txt7 != "0" && !confirm(txt7)){
		return false;
	}else if(txt3 != "0" && !confirm(txt3)){
		return false;
	}else if(txt9 == "1" && !alert("คำเตือน!!! สิทธิผู้ป่วยเป็นประกันสุขภาพถ้วนหน้า/ประกันสังคม กรุณาเปลี่ยนเป็นยา Generic")){
		document.form1.drug_code.focus();
	}else if(document.form1.drug_code.value == "1COVE5" && eval(document.form1.drug_amount.value) % 30 != 0 ){
		alert("ยา Coversyl arginine 5 mg. บรรจุขวดขวดละ 30 เม็ด ไม่สามารถแกะได้ \n กรุณาสั่งยา ด้วยจำนวน 30, 60, 90 หรือ 120 ครับ");
		document.form1.drug_amount.focus();
	}else if((document.form1.drug_code.value == "1SUDO" || document.form1.drug_code.value == "1SUDO-N"  || document.form1.drug_code.value == "1SUDO-NN") && eval(document.form1.drug_amount.value) > 60 ){
		alert("ยา PSEUDOEPHEDRINE  60 mg. 	วัตถุออกฤทธิ์ประเภท 2 \n ควบคุมการจ่ายได้ครั้งละไม่เกิน 60 เม็ด ครับ");  //ได้รับแจ้งจาก พี่ตู๋ หน.ห้องยา เมื่อ 25/05/2559
		document.form1.drug_amount.focus();		
	}else if((document.form1.drug_code.value == "6VISL  " || document.form1.drug_code.value == "6VISL") && eval(document.form1.drug_amount.value) > 60 ){
		alert("ยา Sodium  hyaluronate 0.18% , 0.3 ml.  ยามีโควต้าจัดซื้อ \n ควบคุมการจ่ายได้ไม่เกิน 60 หลอด/คน/เดือน");  //ได้รับแจ้งจาก พี่ตู๋ หก.ห้องยา เมื่อ 02/03/2561
		document.form1.drug_amount.focus();				
	}else if(document.getElementById('drug_inject_amount').style.display == '' && document.form1.drug_inject_amount.value==''){
		alert("กรุณาใส่ จำนวนยาที่ต้องการฉีดให้คนไข้ ");
		document.form1.drug_inject_amount.focus();
	}else if(document.getElementById('drug_inject_slip').style.display == '' && document.form1.drug_inject_slip.value==''){
		alert("กรุณาเลือกวิธีฉีด");
		document.form1.drug_inject_slip.focus();
	}else if(document.getElementById('drug_inject_type').style.display == '' && document.form1.drug_inject_type.value==''){
		alert("กรุณาเลือก แบบในการฉีด");
		document.form1.drug_inject_type.focus();
	}else if(document.getElementById('reason').style.display == '' && document.form1.reason.value==''){
		alert("กรุณาระบุเหตุผลในการเลือกใช้ยา NED");
		document.form1.reason.focus();
	}else if(document.getElementById('reason').style.display == '' && document.form1.reason2.value==''){
	//(document.getElementById('reason11').checked==false && document.getElementById('reason22').checked==false)){
		alert("กรุณาระบุข้อบ่งชี้ในการใช้ยานอก");
		/*document.form1.reason.focus();*/
	document.form1.reason2.focus();
	}else if(return_drug_interaction.substring(0,1) == "2" && confirm(return_drug_interaction)){  // lock
		document.form1.drug_code.focus();
	}else if(return_drug_interaction.substring(0,1) == "1" && !confirm(return_drug_interaction)){  //popup
		document.form1.drug_code.focus();	
/*	}else if(document.form1.drug_code.value == "4MET25" && eval(document.form1.drug_amount.value) >=11){
		alert("ผิดพลาด!!! ยา 4MET25 สั่งได้ไม่เกิน 10 หลอด");
		document.form1.drug_amount.focus();	*/
/*	}else if(document.form1.drug_code.value == "1CODIC-N" && eval(document.form1.drug_amount.value) >=11){
		alert("ผิดพลาด!!! ยา 1CODIC-N สั่งได้ไม่เกิน 10 เม็ด เนื่องจากยาใกล้หมด");
		document.form1.drug_amount.focus();	*/
	}else{
		
			if(check_inject(document.form1.drug_code.value) == false){
				
				document.form1.drug_inject_amount.value = '';
				document.form1.drug_inject_unit.value = '';
				document.form1.drug_inject_amount2.value = '';
				document.form1.drug_inject_unit2.value = '';
				document.form1.drug_inject_time.value = '';
				document.form1.drug_inject_slip.value = '';
				document.form1.drug_inject_type.value = '';
				document.form1.drug_inject_etc.value = '';

			}
			//document.form1.drug_inject_amount.value = document.form1.drug_inject_amount.value+" "+document.form1.drug_unit.value;
			if(txt8!="0"){
				var contxt8 = confirm(txt8);
				if(contxt8==true){
					var lockpt = "FPT ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)";
				}else if(txt8!="0"&&contxt8==false){
					return false;
				}
			}else{
				var lockpt = document.form1.reason.value;
				

				
			}
			if(check_drug(document.form1.drug_code.value)==true){
				
				
		//	alert(document.form1.reason2.value);
				/*if (document.getElementById('reason11').checked==true) {
 				var  rate_value = document.form1.reason2.value;
				}
				 if (document.getElementById('reason22').checked==true) {
				 var rate_value = document.form1.reason2.value;
				}*/
				
			addtolist(document.form1.drug_code.value,document.form1.drug_amount.value,document.form1.drug_slip.value,document.form1.addoredit.value,document.form1.drug_inject_amount.value,document.form1.drug_inject_unit.value,document.form1.drug_inject_amount2.value,document.form1.drug_inject_unit2.value,document.form1.drug_inject_time.value,document.form1.drug_inject_slip.value,document.form1.drug_inject_type.value,document.form1.drug_inject_etc.value,lockpt,document.form1.reason2.value);
			}	
		document.getElementById('drug_inject_amount').style.display = 'none';
		document.getElementById('drug_inject_amount2').style.display = 'none';
		document.getElementById('drug_inject_time').style.display = 'none';
		document.getElementById('drug_inject_slip').style.display = 'none';
		document.getElementById('drug_inject_type').style.display = 'none';
		document.getElementById('drug_inject_etc').style.display = 'none';
		document.getElementById('reason').style.display = 'none';
		// document.getElementById('reason2').style.display = 'none';
		document.getElementById('slip_detail').style.display = '';
		//drug_cc= document.form1.drug_code.value;
		document.form1.drug_code.value = "";
		document.form1.drug_amount.value = "";
		document.form1.drug_slip.value = "";
		document.form1.addoredit.value = "E";

		document.form1.drug_inject_amount.value ="1";
		document.form1.drug_inject_unit.selectedIndex = 0;
		document.form1.drug_inject_amount2.value ="1";
		document.form1.drug_inject_unit2.selectedIndex = 0;
		document.form1.drug_inject_time.selectedIndex = 0;
		document.form1.drug_inject_slip.selectedIndex = 0;
		document.form1.drug_inject_type.selectedIndex = 1;
		document.form1.drug_inject_etc.value ="";
		document.form1.reason.selectedIndex =2;
		document.form1.reason2.selectedIndex =0;
		
		document.form1.drug_code.focus();
		
	}


}

function listdrugprov(){

	if(confirm('ท่านต้องการแก้ไขข้อมูลการจ่ายยาใช่หรือไม่')){
		xmlhttp = newXmlHttp();
		url = 'dt_drug.php?action=listdrugprov';
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);
		viewlist();
	}
}

/**************************************************************************************************/
function addtolist_muli(){
	
	var max = document.form_remed.totalcheck.value;
	
	if(eval(max) > 0){
	for(i=1;i<=max;i++){
		if(document.getElementById("drug_remed"+i).checked == true){
			
			yy = document.getElementById("drug_remed"+i).value;
			zz = yy.split("][");
			

				//if(document.getElementById("chose_reason"+i).value != "-"){
					//zz[3] = document.getElementById("chose_reason"+i).value;
					zz[3]='';
				//}
			
		
			addtolist(zz[0],zz[2],zz[1],'E', zz[4], zz[5], zz[6], zz[7], zz[8], zz[9], zz[10], '',zz[3],zz[13]);
			

			//ตรวจสอบ glibenclamide
			glibenclamide_alert(zz[0].trim());

			kidney_egfr_alert(zz[0].trim());
		}
	}
	}

}
function addtolist_muli3(){
	
	var max = document.form_remed2.totalcheck2.value;
	
	if(eval(max) > 0){
	for(i=1;i<=max;i++){
		if(document.getElementById("drug_remed2"+i).checked == true){
			
			yy = document.getElementById("drug_remed2"+i).value;
			zz = yy.split("][");
			

				//if(document.getElementById("chose_reason2"+i).value != "-"){
					//zz[3] = document.getElementById("chose_reason2"+i).value;
					zz[3]='';
				//}
			
		
			addtolist(zz[0],zz[2],zz[1],'E', zz[4], zz[5], zz[6], zz[7], zz[8], zz[9], zz[10], '',zz[3],zz[13]);

		}
	}
	}

}

function addtolist_muli2(){
	
	var max = document.form_sult.totalcheck.value;
	
	if(eval(max) > 0){
	for(i=1;i<=max;i++){
		if(document.getElementById("drug_sult"+i).checked == true){
			
			yy = document.getElementById("drug_sult"+i).value;
			zz = yy.split("][");

			//if(document.getElementById("chose_reasonsul"+i).value != "-"){
				//zz[3] = document.getElementById("chose_reasonsul"+i).value;
				zz[3]='';
			//}
			
			addtolist(zz[0],zz[2],zz[1],'E', zz[4], '', '', '', '', zz[9], zz[10], zz[11],zz[3],zz[13]);

		}
	}
	}

}

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


function showremed(){
	if(document.getElementById("head_remed").style.display=="")
		document.getElementById("head_remed").style.display="none";
	else
		document.getElementById("head_remed").style.display="";

	
}
function showremed2(){
	
	if(document.getElementById("head_remed2").style.display=="")
		document.getElementById("head_remed2").style.display="none";
	else
		document.getElementById("head_remed2").style.display="";

	
}

function showsult(){
	
	if(document.getElementById("head_sult").style.display=="")
		document.getElementById("head_sult").style.display="none";
	else
		document.getElementById("head_sult").style.display="";

	
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

function selectins(){
	
	//document.getElementById('drug_inject_amount').value='1';document.getElementById('drug_inject_unit').selectedIndex=7;document.getElementById('drug_inject_time').style='none';document.getElementById('drug_inject_type').style='none';document.getElementById('drug_inject_etc').style='none'; }else{}

}

function viatch(ing,code){
	var return_drug500=0;
	if(code=="ER"){
		if(eval(document.getElementById("total_phar_price").value) > 1000){
			xmlhttp = newXmlHttp();
			url = 'dt_drug.php?action=drug_500';
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			return_drug500 = xmlhttp.responseText;
			return_drug500 = return_drug500.substr(4);
		}
	}else if(code=="VIP"){
		//อนุญาตไม่จำกัดจำนวนเงิน
	}else if(code =="OTHER"){
		if(eval(document.getElementById("total_phar_price").value) > 500){
			xmlhttp = newXmlHttp();
			url = 'dt_drug.php?action=drug_500';
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			return_drug500 = xmlhttp.responseText;
			return_drug500 = return_drug500.substr(4);
		}
	}
	
	
	txt6 = ajaxcheck("viatcheck",document.form1.drug_code.value);
	txt6 = txt6.substr(4);
	
	txt7 = ajaxcheck("artrcheck",document.form1.drug_code.value);
	txt7 = txt7.substr(4);	
	
	txt8 = ajaxcheck("viatncheck",document.form1.drug_code.value);
	txt8 = txt8.substr(4);		
	
	
	if(return_drug500=="1"){
		alert("คำสั่งจากผอ. ไม่สามารถจ่ายยานอกเวลาราชการเกินกว่า 500 บาทได้");
		return false;
	}else if(txt6 == "0"){
		var con = ing;
		for(var m=0;m<con;m++){
			if(document.getElementById("ch"+m).selectedIndex==6){
				return true;
			}else{
				window.open('arbs.php?name=5VIAT',null,'height=550,width=600,scrollbars=1');
				return false;
			}
		}
	}else if(txt7 == "0"){
		var con = ing;
		for(var m=0;m<con;m++){
			if(document.getElementById("ch"+m).selectedIndex==6){
				return true;
			}else{
				window.open('arbs.php?name=5ARTR',null,'height=550,width=600,scrollbars=1');
				return false;
			}
		}
	}else if(txt8 == "0"){
		var con = ing;
		for(var m=0;m<con;m++){
			if(document.getElementById("ch"+m).selectedIndex==6){
				return true;
			}else{
				window.open('arbs.php?name=5VIAT-N',null,'height=550,width=600,scrollbars=1');
				return false;
			}
		}		
	}/*else{
		//window.open('arbs.php?name=5VIAT',null,'height=550,width=600,scrollbars=1');
		
		var con = ing;
		for(var m=0;m<con;m++){
			if(document.getElementById("ch"+m).selectedIndex==0){
				//alert("กรุณาเลือกเหตุผล");
				//return false;
			}
		}
	}*/
	
	


	

}
</SCRIPT>
</head>
<body>

<!-- <a href='../nindex.htm'>&lt;&lt;ไปเมนู</a><BR>
<A HREF="dt_index.php">&lt;&lt; เลือกผู้ป่วยใหม่</A> -->

<?php include("dt_menu.php");?>
<?php include("dt_patient.php");?>


<!-- Layer Remed ยา -->
<div id="head_remed" style='left:250PX;top:10PX;width:100PX;height:30PX;position:absolute; display:none'>
<TABLE align="center" border="1" bordercolor="#3300FF" width="100%" cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<TABLE width="100%" cellpadding="0" cellspacing="0">
	<TR bgcolor="#3300FF" align="center">
		<TD align="left">&nbsp;&nbsp;</TD>
		<TD ><font color="#FFFFFF"><strong>วันที่มาตรวจ : </strong>
		  <label>
		  <select name="date_diag" onChange="select_dateremed(this.value);">
		 <?php
			$date_remed ="";
	
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){
		$where1 = " where `lock` = 'Y' ";
	}else{
		$where1 = "";
	}
//date_format( a.date, '%d/%m/%Y' )date_format( a.date, '%Y-%m-%d' )
	$sql = "
	SELECT DISTINCT  a.date AS date1,  a.date as date2 
	FROM drugrx as a INNER JOIN (Select `drugcode`,`lock_dr` From druglst ".$where1." ) as b ON a.drugcode = b.drugcode
	WHERE a.hn = '".$_SESSION["hn_now"]."' AND a.an is null and a.drugcode <> 'INJ' AND a.row_id not in (Select row_id From drugrx_notinj)
	GROUP BY date2, a.drugcode, a.slcode
	HAVING sum( a.amount ) >0
	Order by a.date DESC limit 100";

			$result = Mysql_Query($sql) or die(mysql_error());
			while($arr = Mysql_fetch_assoc($result)){
				$arr["date1"] = substr($arr["date1"],8,2)."/".substr($arr["date1"],5,2)."/".substr($arr["date1"],0,4);
				$arr["date2"] = substr($arr["date2"],0,10);
				echo "<option value=\"",$arr["date2"],"\">",$arr["date1"],"</option>";
				if($date_remed == "") $date_remed = $arr["date2"];
			}
			//echo $date_remed;

			$list_onload .= "select_dateremed('".$date_remed."'); \n";
		 ?>
		    
		    </select>
			

		  </label>
		</font></TD>
	</TR>
	<TR bgcolor="#FFFFFF">
		<TD colspan="2">
	<DIV id="div_remed" ></DIV>
	</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</div>
<!-- Layer Remed ยา -->
<div id="head_remed2" style='left:250PX;top:10PX;width:100PX;height:30PX;position:absolute; display:none'>
<TABLE align="center" border="1" bordercolor="#3300FF" width="100%" cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<TABLE width="100%" cellpadding="0" cellspacing="0">
	<TR bgcolor="#3300FF" align="center">
		<TD align="left">&nbsp;&nbsp;</TD>
		<TD ><font color="#FFFFFF"><strong>วันที่มาตรวจ : </strong>
		  <label>
		  <select name="date_diag" onChange="select_dateremed2(this.value);">
		 <?php
			$date_remed ="";
	
	if((substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){
		$where1 = " where `lock` = 'Y' ";   //ยาที่ถูกล็อครหัสผ่าน
		//$where1 = "";
	}else{
		$where1 = "";
	}
//date_format( a.date, '%d/%m/%Y' )date_format( a.date, '%Y-%m-%d' )
	$sql = "
	SELECT DISTINCT  a.date AS date1,  a.date as date2 
	FROM drugrx as a INNER JOIN (Select `drugcode`,`lock_dr` From druglst ".$where1." ) as b ON a.drugcode = b.drugcode
	WHERE a.hn = '".$_SESSION["hn_now"]."' AND a.an is not null AND a.drugcode <> 'INJ' AND a.row_id not in (Select row_id From drugrx_notinj)
	GROUP BY left(date2,10)
	HAVING sum( a.amount ) >0
	Order by a.date DESC limit 20
	
	";

			$result = Mysql_Query($sql) or die(mysql_error());
			while($arr = Mysql_fetch_assoc($result)){
				$arr["date1"] = substr($arr["date1"],8,2)."/".substr($arr["date1"],5,2)."/".substr($arr["date1"],0,4);
				$arr["date2"] = substr($arr["date2"],0,10);
				echo "<option value=\"",$arr["date2"],"\">",$arr["date1"],"</option>";
				if($date_remed == "") $date_remed = $arr["date2"];
			}
			//echo $date_remed;

			$list_onload .= "select_dateremed2('".$date_remed."'); \n";
			
		 ?>
		    
		    </select>
		  </label>
		</font></TD>
	</TR>
	<TR bgcolor="#FFFFFF">
		<TD colspan="2">
	<DIV id="div_remed2" ></DIV>
	</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</div>

<!-- Layer สูตรยา -->
<div id="head_sult" style='left:250PX;top:10PX;width:100PX;height:30PX;position:absolute; display:none'>
<TABLE align="center" border="1" bordercolor="#3300FF" width="100%" cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<TABLE width="100%" cellpadding="0" cellspacing="0">
	<TR bgcolor="#3300FF" align="center">
		<TD align="left">&nbsp;&nbsp;</TD>
		<TD ><font color="#FFFFFF"><strong>สูตรยา : </strong>
		  <label>
		  <select name="sult" onChange="select_datesult(this.value);">
		 <?php
			$date_sult ="";

			$sql = "Select idname From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1 ";
			list($sld) = mysql_fetch_row(mysql_query($sql));

			$sql = "Select row_id, name_formula From dr_drugsuit where code_dr = '".$sld."' Order by row_id ASC ";
	
			$result = Mysql_Query($sql) or die(mysql_error());
			while($arr = Mysql_fetch_assoc($result)){
				echo "<option value=\"",$arr["row_id"],"\">",$arr["name_formula"],"</option>";
				if($date_sult == "") $date_sult = $arr["row_id"];
			}
			$list_onload .= "select_datesult('".$date_sult."'); \n";
		 ?>
		    
		    </select>
		  </label>
		</font></TD>
	</TR>
	<TR bgcolor="#FFFFFF">
		<TD colspan="2">
	<DIV id="div_sult"></DIV>
	</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</div>
<TABLE border="0" width="100%">
<TR>
	<TD width="280" valign="top">
<FORM Name="form1" METHOD="POST" ACTION="" Onsubmit=" return false;">
<TABLE width="100%" border="1" bordercolor="#F0F000">
<TR>
	<TD>
<TABLE border="0">
<TR>
	<TD align="right" class="tb_detail">ยา : </TD>
	<TD><INPUT NAME="drug_code" TYPE="text" ID="drug_code" onKeyPress="searchSuggest('drug',this.value,3); " onKeyDown="if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="10">
	  <!--<INPUT NAME="drug_code2" TYPE="text" ID="drug_code2"  size="20" disabled>--></TD>

</TR>
<TR >
	<TD align="right" class="tb_detail">จำนวน : </TD>
	<TD><INPUT  ID="drug_amount" TYPE="text" NAME="drug_amount"  size="10" onkeypress = "if(event.keyCode == 13){ checkForm1(); return false; }else{ check_number();}"  > </TD>
</TR>
<TR ID="slip_detail" style="display:">
	<TD align="right" class="tb_detail">วิธีใช้ : </TD>
	<TD><INPUT NAME="drug_slip" TYPE="text" ID="drug_slip" onKeyPress="if(event.keyCode == 13){ checkForm1(); return false; }else{ searchSuggest('slip',this.value,2);} " onKeyDown="if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="10"></TD>
</TR>
<TR ID="drug_inject_slip" style="display:none">
	<TD align="right" class="tb_detail" id="">วิธีฉีด : </TD>
	<TD>
		<SELECT NAME="drug_inject_slip"  onChange="if(this.value=='1ins'){document.getElementById('drug_inject_time').style.display='none';document.getElementById('drug_inject_type').style.display='none';document.getElementById('d_unit').selectedIndex=7;document.getElementById('drug_inject_amount2').style.display='none';document.getElementById('d_am2').value='';document.getElementById('d_unit2').selectedIndex=0;}
else if(this.value=='2ins'){document.getElementById('drug_inject_time').style.display='none';document.getElementById('drug_inject_type').style.display='none';document.getElementById('d_unit').selectedIndex=7;document.getElementById('drug_inject_amount2').style.display='';document.getElementById('d_unit2').selectedIndex=1;document.getElementById('d_am2').value='1'}
else{document.getElementById('drug_inject_time').style.display='';document.getElementById('drug_inject_type').style.display='';document.getElementById('d_unit').selectedIndex=1;document.getElementById('drug_inject_amount2').style.display='none';document.getElementById('d_am2').value='';document.getElementById('d_unit2').selectedIndex=0;}">
		<Option value="IM">IM</Option>
		<Option value="IV">IV</Option>	
			<Option value="SC">SC</Option>
			<Option value="A">A</Option>
            <Option value="1ins">1ins</Option>
            <Option value="2ins">2ins</Option>
			<Option value="">----</Option>
			
		</SELECT>
	</TD>
</TR>
<TR ID="drug_inject_amount"  style="display:none">
	<TD align="right" class="tb_detail" >ฉีด : </TD>
	<TD><INPUT TYPE="text" NAME="drug_inject_amount" onkeypress = "if(event.keyCode == 13){ checkForm1(); return false; }"  size="3" value="1">
	  <SELECT NAME="drug_inject_unit" id="d_unit">
	    <Option value="AMP">AMP</Option>
	    <Option value="MG">MG</Option>
	    <Option value="GM">GM</Option>
	    <Option value="ML">ML</Option>
	    <Option value="VIAL">VIAL</Option>
        <Option value="UNIT">UNIT</Option>
        <Option value="ล้านUNIT">ล้านUNIT</Option>
        <Option value="UNIT ก่อนอาหารเช้า">UNIT ก่อนอาหารเช้า</Option>
		<Option value="UNIT ก่อนอาหารกลางวัน">UNIT ก่อนอาหารกลางวัน</Option>
		<Option value="UNIT ก่อนอาหารเย็น">UNIT ก่อนอาหารเย็น</Option>
	  </SELECT></TD>
</TR>
<TR ID="drug_inject_amount2"  style="display:none">
	<TD align="right" class="tb_detail" >&nbsp;</TD>
	<TD><INPUT TYPE="text" NAME="drug_inject_amount2" onkeypress = "if(event.keyCode == 13){ checkForm1(); return false; }"  size="3" id="d_am2">
    <SELECT NAME="drug_inject_unit2" id="d_unit2">
    	<Option value=""></Option>
        <Option value="UNIT ก่อนอาหารเย็น">UNIT ก่อนอาหารเย็น</Option>
	  </SELECT></TD>
</TR>
<TR  ID="drug_inject_time"  style="display:none">
  <TD align="right" class="tb_detail" >เวลา : </TD>
  <TD><SELECT NAME="drug_inject_time">
  		<Option value="STAT">STAT</Option>
	    <Option value="วันละครั้ง">วันละครั้ง</Option>
	    <Option value="วันเว้นวัน">วันเว้นวัน</Option>
	    <Option value="ทุก 2 ชั่วโมง">ทุก 2 ชั่วโมง</Option>
	    <Option value="ทุก 4 ชั่วโมง">ทุก 4 ชั่วโมง</Option>
	    <Option value="ทุก 6 ชั่วโมง">ทุก 6 ชั่วโมง</Option>
        <Option value="ทุก 8 ชั่วโมง">ทุก 8 ชั่วโมง</Option>
        <Option value="ทุก 12 ชั่วโมง">ทุก 12 ชั่วโมง</Option>
        <Option value="ทุก 18 ชั่วโมง">ทุก 18 ชั่วโมง</Option>
        <Option value="ทุก 24 ชั่วโมง">ทุก 24 ชั่วโมง</Option>
        <Option value="ทุก 5 วัน">ทุก 5 วัน</Option>
        <Option value="1 ครั้ง จันทร์ พุธ ศุกร์">1 ครั้ง จันทร์ พุธ ศุกร์</Option>
        <Option value="1 ครั้งเฉพาะวันพุธ">1 ครั้งเฉพาะวันพุธ</Option>
        <Option value="1 ครั้งเฉพาะวันศุกร์">1 ครั้งเฉพาะวันศุกร์</Option>
        <Option value="จันทร์ พุธ ศุกร์">จันทร์ พุธ ศุกร์</Option>
	  </SELECT></TD>
</TR>
<TR ID="drug_inject_type" style="display:none">
	<TD align="right" class="tb_detail">แบบ : </TD>
	<TD>
		<SELECT NAME="drug_inject_type">
			<Option value="">----</Option>
			<Option value="(1 DOSE)" Selected>1 DOSE</Option>
			<Option value="(1 COURSE)">1 COURSE</Option>
			<Option value="(3 DOSE)">3 DOSE</Option>
		</SELECT>
	</TD>
</TR>
<TR ID="drug_inject_etc" style="display:none">
	<TD align="right" class="tb_detail">คำสั่งอื่นๆ : </TD>
	<TD><INPUT  TYPE="text" NAME="drug_inject_etc" onKeyPress="if(event.keyCode == 13){ checkForm1(); return false; } " size="18"></TD>
</TR>
<TR ID="reason" style="display:none">
	<TD align="center" valign="top" class="tb_detail">เหตุผล : <BR> <br>
	  ข้อบ่งชี้</TD>
	<TD>
				<SELECT NAME="reason" onkeypress="if(event.keyCode == 13){ checkForm1(); return false; }">
					<!--<Option value="ใช้ยาในบัญชียาหลักแห่งชาติแล้วไม่ดีขึ้น">ใช้ยาในบัญชียาหลักแล้วไม่ดีขึ้น</Option>
					<Option value="ไม่มียาในบัญชียาหลักแห่งชาติที่ใช้รักษาตามข้อบ่งชี้">ไม่มียาในบัญชียาหลักที่ใช้รักษาตามข้อบ่งชี้</Option>
					<Option value="แพ้ยาในบัญชียาหลักแห่งชาติ" >แพ้ยาในบัญชียาหลักแห่งชาติ</Option>
					<Option value="มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชียาหลักต่อไปได้">มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชีได้</Option>
					<Option value="ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา(drug interaction)กับยาในบัญชียาหลักแห่งชาติ">ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา</Option>
					<Option value="ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน">ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน</Option>
					<Option value="มีความจำเป็นที่ต้องใช้ยานอกบัญชียาหลักเพราะมีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย">มีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย</Option>-->
                <Option value="A เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา">เกิดอาการข้างเคียงในการใช้ยาในบัญชียาหลักแห่งชาติ (ADR) หรือแพ้ยา</Option>
                <Option value="B ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย" >ผู้ป่วยใช้ยาในบัญชียาหลักแห่งชาติแล้ว ผลการรักษาไม่บรรลุเป้าหมาย</Option>
                <Option value="C ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด">ไม่มียาในบัญชียาหลักแห่งชาติให้ใช้ แต่ผู้ป่วยมีข้อบ่งชี้การใช้ยานี้ตามที่ อย. กำหนด</Option>
                <Option value="D มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ">มี Contraindication หรือ drug interaction กับยาในบัญชียาหลักแห่งชาติ</Option>
                <Option value="E ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า">ยาในบัญชียาหลักแห่งชาติราคาแพงกว่า</Option>
                <Option value="F ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)">ผู้ป่วยแสดงความจำนงต้องการ (เบิกไม่ได้)</Option>
				</SELECT><BR><BR>
<!--<span ><input name="reason2" id="reason11" type="radio" value="1">
                เคยใช้ยาในบัญชียาหลักมาก่อน<br><input name="reason2" type="radio"  id="reason22" value="2">ไม่มียาในบัญชียาหลักแห่งชาติ</span>-->
                <SELECT NAME="reason2" onkeypress="if(event.keyCode == 13){ checkForm1(); return false; }">
                <Option value="" selected></Option>
                <Option value="1">เคยใช้ยาในบัญชียาหลักมาก่อน</Option>
                <Option value="2">ไม่มียาในบัญชียาหลักแห่งชาติ</Option>
                </SELECT>
    </TD>
</TR>
<TR>
	<TD align="center" colspan="2">
		<INPUT id="form_submit" TYPE="submit" value="   ตกลง    " onClick="checkForm1();" onKeyPress="if(event.keyCode == 13) checkForm1(); return false;" onKeyDown="if(event.keyCode == 38){document.form1.drug_slip.focus();}">&nbsp;<INPUT TYPE="button" value="ยกเลิก" onClick="document.getElementById('drug_code').value='';document.getElementById('drug_amount').value='';document.getElementById('drug_slip').value='';document.getElementById('addoredit').value='E';">
		<input type="hidden" id="doctor_id" name="doctor_id" value="<?=$_SESSION['sIdname'];?>">
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

		echo "<CENTER><A HREF=\"#\" onclick=\"".$onclick."\">ยกเลิก/แก้ไขรายการครั้งล่าสุด</A></CENTER><BR>";
	}?>

	</TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" id="addoredit" name="addoredit" value="E">
</FORM>

</TD>
	<TD   width="30"  valign="top">
	<Div id="list" style="left:200PX;top:220PX;position:absolute;"></Div>
		&nbsp;
	</TD>
	<TD valign="top"><Div id="druglist" ></Div>
	<?php 
		$listinteraction =array();
		$sql = " Select row_id, doctor From dphardep where hn = '".$_SESSION["hn_now"]."' AND whokey = 'DR' AND idname <> '".$_SESSION["dt_doctor"]."' AND date like '".((date("Y")+543).date("-m-d"))."%' AND dr_cancle is null Order by row_id DESC limit 1 ";
		
		$result = mysql_query($sql);
		$rows = mysql_num_rows($result);
		if($rows > 0){
		
		echo "<Table width=\"100%\">";
		echo "<TR>";
					echo "<TD colspan='4'>รายการจ่ายยาจากแพทย์ท่านอื่น</TD>";
				echo "</TR>";
		while(list($row_id, $doctor) = mysql_fetch_row($result)){
			$sql = " Select b.tradname, a.drugcode, a.amount, b.unit ,a.slcode From ddrugrx as a LEFT JOIN druglst as b ON a.drugcode = b.drugcode where a.idno = '".$row_id."'  ";
			$result2 = mysql_query($sql) or die(mysql_error());
		echo "
		<tr class='tb_head' >
			<td align=\"center\" >ชื่อยา</td>
			<td align=\"center\" >จำนวน</td>
			<td align=\"center\" >วิธีใช้</td>
			<td align=\"center\" >แพทย์ผู้สั่ง</td>
		</tr>";

			while(list($tradname, $drugcode, $amount, $unit ,$slcode) = mysql_fetch_row($result2)){

				list($detail1,  $detail2,  $detail3,  $detail4 ) = mysql_fetch_row(mysql_query("Select detail1 , detail2 , detail3 , detail4 From drugslip where slcode = '".$slcode."' limit 1 "));
				array_push($listinteraction,$drugcode);
				echo "<TR>";
					echo "<TD>".$tradname."</TD>";
					echo "<TD align='right'>".$amount."&nbsp;&nbsp;&nbsp;</TD>";
					echo "<TD align='center'><span style=\"CURSOR: pointer\" OnmouseOver = \"show_tooltip('วิธีใช้ยา','",$detail1."<BR>".$detail2."<BR>".$detail3."<BR>".$detail4,"','center',-200,-180);\" OnmouseOut = \"hid_tooltip();\">".$slcode."</span></TD>";
					echo "<TD>".$doctor."</TD>";
				echo "</TR>";
			}
		}
		echo "</Table>";
		}
	
	?>
	&nbsp;</TD>
</TR>
</TABLE>
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	
	document.getElementById("drug_code").focus();
	viewlist();
	<?php echo $list_onload;?>
	
}

</SCRIPT>

<?

///*********************เตือน *****************///
include("connect.inc");
$sqldrugreact="SELECT * FROM `drugreact` WHERE hn = '".$_SESSION["hn_now"]."' ";
$resultdrugreact =mysql_query($sqldrugreact) or die(mysql_error());

//echo $sql;
$rowdg=mysql_num_rows($resultdrugreact);
if($rowdg){
	$aai=1;

	while($arrdg = mysql_fetch_assoc($resultdrugreact)){ 
	$txtdrugreact.='( '.$aai.' )'.$arrdg['drugcode'].' '.$arrdg['tradname'];
	$txtdrugreact.='\n';
	$aai++;
	 }
	 
	
	?>
<script>
	alert("ผู้ป่วยรายการแพ้ยา\n<?=$txtdrugreact?>");
</script>
    <?
}

/* แจ้งเตือน Warfarin */
if( !function_exists('ad_to_bc') ){
	function ad_to_bc($time = null){
		$time = preg_replace_callback('/^\d{4,}/', 'cal_to_bc', $time);
		return $time;
	}
}

if( !function_exists('cal_to_bc') ){
	function cal_to_bc($match){
		return ( $match['0'] + 543 );
	}
}

$date_end = date('Y-m-d');
$date_start = date('Y-m-d', strtotime(date('Y-m-d')."-3 months"));

$date_end = ad_to_bc($date_end);
$date_start = ad_to_bc($date_start);

$patient_hn = trim($_SESSION["hn_now"]);
$sql = "SELECT COUNT(`row_id`) AS `rows` 
FROM `drugrx` 
WHERE `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2') 
AND ( `date` >= '$date_start' AND `date` <= '$date_end' ) 
AND `hn` = '$patient_hn' ";
$q = mysql_query($sql);
$item = mysql_fetch_assoc($q);
$count_wafarin = (int) $item['rows'];
if( $count_wafarin > 0 ){
	?>
	<script type="text/javascript">
		alert('ผู้ป่วยมีประวัติการใช้ยา Warfarin ในช่วง 3 เดือนย้อนหลัง');
	</script>
	<?php
}
/* แจ้งเตือน Warfarin */

?>
</body>
<?php include("unconnect.inc");?>
</html>