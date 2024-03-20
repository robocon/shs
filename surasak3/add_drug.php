<?php
session_start();

include("connect.inc");
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");


$_SESSION["an_now"] = $my_an = sprintf("%s", $_REQUEST["an"]);

$sql = "SELECT an,drugcode,tradname,firstdate,enddate  FROM `dgprofile`  where an='$my_an' and statcon = 'CONT' and onoff='ON' and enddate='".date("Y-m-d")."'";
$result = mysql_query($sql);
$num = mysql_num_rows($result);
if($num > 0){
	$rows=mysql_fetch_array($result);
	$show_an=$rows["an"];
	echo "<script>alert('ผู้ป่วย AN : $show_an มียาที่ครบกำหนด Cont ยาในวันนี้จำนวน $num รายการ');</script>";
}

/**
 * ข้อมูลเบื้องต้นของผู้ป่วยจาก an
 */
$sql = "Select an, hn, ptname, bedcode, ptright, doctor From bed where an = '$my_an' limit 0,1 ";
$result = Mysql_Query($sql);
$bed = Mysql_fetch_assoc($result);
if(!$bed){
	?>
	<h1 style="color:red;">คำเตือน ไม่พบข้อมูล AN: <?=$my_an;?> กรุณาตรวจสอบ AN อีกครั้ง</h1>
	<?php
}

// session_register("hn_now");
$my_hn = $_SESSION["hn_now"] = $bed["hn"];
// session_register("an_now");
$_SESSION["an_now"] = $bed["an"];
$_SESSION["ptright_now"] = $bed["ptright"];

// แสดงโรคประจำตัวด้านล่าง และหาว่าคนไข้มีโรคประจำตัวเป็น G6PD รึป่าว
$qOp = $dbi->query("SELECT congenital_disease FROM opcard WHERE hn = '$my_hn' ");
$opcard = $qOp->fetch_assoc();
$opcard_g6pd = false;
if(preg_match('/(G6PD)/', $opcard['congenital_disease'], $matchs)){
	$opcard_g6pd = true;
}

// ถ้าเภสัชได้ติ๊กว่าผู้ป่วยคนนี้มีประวัติการเป็น G6PD ในระบบแพ้ยาให้ทำการดึงรายการยาในกลุ่ม g6pd ออกมา
$drugreactGroup10 = array();
$queryG6pdInDrugreact = $dbi->query("SELECT row_id FROM drugreact WHERE hn='$my_hn' AND g6pd='1'");
if($queryG6pdInDrugreact->num_rows > 0){
	$queryGroup10 = $dbi->query("SELECT * FROM drugreact_group_list WHERE drugreact_group = '10' ");
	while ($g10 = $queryGroup10->fetch_assoc()) {
		$drugreactGroup10[] = trim($g10['drugcode']);
	}
}

// รายการยาที่แพ้ตามที่เภสัชได้บันทึกเอาไว้
$drugreact_list = array();
$drugreact_list_js = array();
$drugreact_g6pd = false;
$res_drugreact = $dbi->query("SELECT * FROM `drugreact` WHERE hn = '$my_hn' AND advreact != '' AND g6pd IS NULL  GROUP BY drugcode");
$rowdg1 = $res_drugreact->num_rows;
if($rowdg1 > 0){
	while($arrdg1 = $res_drugreact->fetch_assoc()){
		$drugcode = trim($arrdg1['drugcode']);
		$drugreact_list[] = $drugcode;
		$drugreact_list_js[] = "'$drugcode'";

		if($arrdg1['g6pd']=="1"){
			$drugreact_g6pd = true;
		}
	}
}

// กลุ่มที่แพ้ตามที่เภสัชได้่บันทึกเอาไว้
$sqlGroup = "SELECT `groupname`,advreact,asses FROM `drugreact` WHERE hn = '$my_hn' AND groupname <> '' AND sideeffects='' GROUP BY `groupname`";
$qGroup = $dbi->query($sqlGroup);
$groupnameList = array();
if ($qGroup->num_rows>0) { 
	while ($a = $qGroup->fetch_assoc()) {
		$groupnameList[] = $a;
	}
}

// รายการยาที่แพ้ ตามกลุ่ม
$sql1="SELECT b.* FROM ( 
	SELECT `groupname` FROM `drugreact` WHERE `hn` = '$my_hn' AND `groupname` != '' AND sideeffects='' GROUP BY `groupname`
) AS a 

LEFT JOIN `drugreact_group` AS c ON c.`name` = a.`groupname`
LEFT JOIN `drugreact_group_list` AS b ON c.`id` = b.`drugreact_group` 
WHERE b.drugcode NOT IN (SELECT `drugcode` FROM `drugreact` WHERE `hn` = '$my_hn' AND drugcode != '' AND advreact != '' AND g6pd IS NULL GROUP BY drugcode)";

$res = $dbi->query($sql1);
$drugreact_groups = array();
$drugreact_groups_js = array();
while ($a = $res->fetch_assoc()) {
	$drugreact_groups[] = $a['drugcode'];
	$drugreact_groups_js[] = "'".trim($a['drugcode'])."'";
}

if(isset($_GET["action"]) && ($_GET["action"] == "drug_interaction" || $_GET["action"] == "drug_alert")){
	header("content-type: application/x-javascript; charset=UTF-8");
}

/**
 * แยกฟังก์ชั่นมาจาก listAjax ===ในเงื่อนไข===> $_GET["action"] == "drugcode"
 * 
 * แสดงรายการยาตามที่ keypress ในช่องรหัสยา (id="drugcode")
 */
$search_txt = trim(sprintf("%s", $_GET['search']));
if($_GET["action"] == "drugcode" && !empty($search_txt)){

	$sql = "Select prefix From `runno` where `title`  = 'passdrug' limit 1 ";
	list($pass_drug) = mysql_fetch_row(mysql_query($sql));
	
	$sql = "SELECT a.`drugcode`,a.`tradname`,a.genname,a.`unit`,a.`unitpri`,a.`stock`,a.`part`,b.`slcode`, a.`lock`, a.`lock_ipd`
	FROM ( 
		SELECT * FROM `druglst` WHERE ( `drugcode` LIKE '$search_txt%' OR `genname` LIKE '$search_txt%' OR `tradname` LIKE '$search_txt%' ) AND `drug_active`='y' 
	) AS a 
	LEFT JOIN (
		SELECT `drugcode`,`slcode`,COUNT(`slcode`) AS `sl_rows` FROM `dgprofile` WHERE `drugcode` LIKE '$search_txt%' AND `slcode` != '' GROUP BY `drugcode` ORDER BY `sl_rows` DESC
	) AS b ON b.`drugcode` = a.`drugcode` 
	ORDER BY a.`drugcode` ASC;";
	$res = $dbi->query($sql);
	if($res->num_rows > 0){
		?>
		<TABLE width="100%" border="1" bordercolor="009688" cellspacing="0" cellpadding="0"  >
			<TR>
				<TD>
					<TABLE width="100%" bgcolor="#FFFFFF" cellspacing="4" cellpadding="2">
						<tr>
							<td colspan="6" style="text-align:center;">
								<span align="right"><A HREF="javascript:void(0);" Onclick="document.getElementById('listdrugcode').innerHTML='';"><b>[ ปิดหน้าต่าง ]</b></A>&nbsp;</span>
							</td>
						</tr>
						<TR bgcolor="009688" align="center">
							<td></td>
							<TD><FONT  COLOR="#FFFFDD"><B>รหัสยา</B></FONT></TD>
							<TD><FONT  COLOR="#FFFFDD"><B>ชื่อการค้า</B></FONT></TD>
							<TD><FONT  COLOR="#FFFFDD"><B>ชื่อสามัญ</B></FONT></TD>
							<TD><FONT  COLOR="#FFFFDD"><B>ประเภท</B></FONT></TD>
							<TD><FONT  COLOR="#FFFFDD"><B>ราคา</B></FONT></TD>
							<TD><FONT  COLOR="#FFFFDD"><B>จำนวนคงเหลือ</B></FONT></TD>
						</TR>
						<?php
						$i=0;

						// while($arr = Mysql_fetch_assoc($result)){
						while($arr = $res->fetch_assoc()){

						
							$drugcode = jschars($arr["tradname"]);

							$mydrugcode = trim($arr['drugcode']);
							$alert_txt = '';
							$relative_react_txt = '';
							if(in_array($mydrugcode, $drugreact_list)===true){
								$alert_txt = '<span style="background-color: #ff7373;font-weight: bold;padding: 0 8px;">แพ้ยา</span>';
							}else{
								if(in_array($mydrugcode, $drugreact_groups)===true){
									$relative_react_txt = '<span style="background-color: yellow;font-weight: bold;padding: 0 8px;">แพ้ยาในกลุ่ม</span>';

									if ($opcard_g6pd===true && in_array($mydrugcode, $drugreactGroup10)) {
										$relative_react_txt = '<span style="background-color: #63cdff;font-weight: bold;padding: 0 8px;">ระวังผู้ป่วย G6PD</span>';

									}
								}
							}

							if($i == 0){
								$txt = "list_radio";
							}else{
								$txt = "select_radio".$i;
							}
							
							if(($arr["lock_ipd"]=="N") && (substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09" || substr($_SESSION["ptright_now"],0,3) == "R10"  || substr($_SESSION["ptright_now"],0,3) == "R11"  || substr($_SESSION["ptright_now"],0,3) == "R12"  || substr($_SESSION["ptright_now"],0,3) == "R13"  || substr($_SESSION["ptright_now"],0,3) == "R14"  || substr($_SESSION["ptright_now"],0,3) == "R17"  || substr($_SESSION["ptright_now"],0,3) == "R27" || substr($_SESSION["ptright_now"],0,3) == "R35"  || substr($_SESSION["ptright_now"],0,3) == "R36"  || substr($_SESSION["ptright_now"],0,3) == "R40")){  //ถ้า lock ยา  R27 รับสั่งการที่ทิวา  22/11/2565
							?>
							<TR>
								<TD>
									<INPUT TYPE="text" class="input_check_pass" ID="<?=$txt;?>" NAME="select_radio" size="3" maxlength="3" onkeypress="if(event.keyCode==13){if(this.value=='<?=$pass_drug;?>'){ update_field('<?=$arr['drugcode'];?>','<?=$arr['tradname'];?>','<?=$arr['unit'];?>','<?=$arr['part'];?>','<?=$arr['slcode'];?>'); }else{ alert('รหัสผ่านไม่ถูกต้อง') } } ">
									<br><FONT style="font-size: 16px;" COLOR="red"><u>รับรหัสผ่านได้ที่ผู้อำนวยการโรงพยาบาลเท่านั้น</u></FONT>
								</TD>
								<TD><?=$arr["drugcode"];?> <?=$alert_txt;?><?=$relative_react_txt;?></TD>
								<TD><?=$arr["tradname"];?></TD>
								<td><?=$arr['genname'];?></td>
								<TD><?=$arr["part"];?></TD>
								<TD><?=$arr["unitpri"];?></TD>
								<TD><?=$arr["stock"];?></TD>
							</TR>
							<?php
							}else{  //ถ้าไม่ได้ lock ยา
								?>
								<TR>
									<td>
										<input type="radio" name="simple" id="simple" ondblclick="update_field('<?=$arr['drugcode'];?>','<?=$arr['tradname'];?>','<?=$arr['unit'];?>','<?=$arr['part'];?>','<?=$arr['slcode'];?>')">
									</td>
									<TD>
										<A HREF="javascript:void(0)" Onclick="update_field('<?=$arr['drugcode'];?>','<?=$arr['tradname'];?>','<?=$arr['unit'];?>','<?=$arr['part'];?>','<?=$arr['slcode'];?>')"><?=$arr['drugcode'];?></A>
										<?=$alert_txt;?><?=$relative_react_txt;?>
									</TD>
									<TD><?=$arr["tradname"];?></TD>
									<td><?=$arr['genname'];?></td>
									<TD><?=$arr["part"];?></TD>
									<TD><?=$arr["unitpri"];?></TD>
									<TD><?=$arr["stock"];?></TD>
								</TR>
								<?php			
							}
							$i++;
						}
						?>
					</TABLE>
				</TD>
			</TR>
		</TABLE>
		<?php
		
	}else{
		?>
		<p style="background-color:#ffffff;padding:8px;margin:0;border:2px solid #000000;"><b>ไม่พบข้อมูล</b></p>
		<?php
	}

	exit;
}


if(isset($_POST["action"]) && $_POST["action"] == "changeSession"){ 
	$i = sprintf("%s", $_POST['i']);
	$value = sprintf("%s", $_POST['value']);
	$sql = "UPDATE `dgprofile` SET `statcon`='$value' WHERE `row_id` = '$i' ";
	$q = mysql_query($sql);
	if($q===true){
		echo $value;
	}else{
		echo mysql_error();
	}
	exit;
}

if(isset($_GET["action"]) && $_GET["action"] == "drug_interaction"){
	
	$list = "";
	
	for($j=0;$j<$_SESSION["num_list"];$j++){
		$list .= "'".trim($_SESSION["list_druglst"]["drugcode"][$j])."',";
	}
		$list = substr($list,0,-1);
	if($_SESSION["num_list"] == 0){

		echo "0";
		exit();
	}

	$sql = "SELECT first_drugcode, between_drugcode, effect, action, follow, onset, violence, referable  FROM drug_interaction  where (first_drugcode = '".$_GET["drugcode"]."' AND between_drugcode in (".$list.") ) OR (between_drugcode = '".$_GET["drugcode"]."' AND first_drugcode in (".$list.") ) ";
	
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

			echo " เกิด Drug Interaction ระหว่างยา ".$druglist[0]." กับยา ".$druglist[1]." \n ผลกระทบ : ".$arr["effect"]." \n กลไกที่เกิด : ".$arr["action"]." \n การติดตาม : ".$arr["follow"]." \n onset : ".$arr["onset"]." \n ความรุนแรง : ".$arr["violence"]." \n หลักฐาน : ".$arr["referable"]." \n ท่านยังต้องการจ่ายยาหรือไม่? ";
		}
	
	exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "drug_alert"){
	
	$hn = sprintf("%s", $_GET['hn']);
	$sql = "SELECT row_id, tradname FROM drugreact  where drugcode = '".$_GET["drugcode"]."' AND hn = '$hn' limit 1 ";
	
	$result = Mysql_Query($sql);
	$rows = Mysql_num_rows($result);
	$arr = Mysql_fetch_assoc($result);
		if($rows == 0){
			
		//แพ้ยาตามกลุ่ม
		$sql1 = "Select drugcode,tradname FROM drugreact WHERE  hn = '$hn' and drugcode='".$_GET["drugcode"]."' and groupname !='' limit 1";
		//echo $sql1;
		$result1 = mysql_query($sql1);
		$rows1 = mysql_num_rows($result1);
			if($rows1 > 0){
			list($drugcode1,$tradname1)=mysql_fetch_array($result1);

					$sql3="SELECT drugcode,drugreact_group FROM `drugreact_group_list` where drugcode='".$_GET["drugcode"]."'";  //เช็คก่อนว่ามียาที่คีย์มาในกลุ่มที่แพ้หรือไม่	
					$query3=mysql_query($sql3);
					$num3=mysql_num_rows($query3);
					list($drugcode2,$drugreact_group)=mysql_fetch_array($query3);
					if($num3 > 0){  //ถ้ามีอยู่ในกลุ่มที่แพ้ ให้เช็คต่ออีกว่าได้ระบุการแพ้ยาตามกลุ่มไปหรือยัง
						if($drugcode1==$drugcode2){  //ถ้ายาที่ระบุในกลุ่มว่ามีโอกาสแพ้ ตรงกับ ยาที่สั่งจ่ายยา
							echo "คนไข้แพ้ยาตามกลุ่ม ".$drugcode1." , (".$tradname1.")  \n ท่านยังต้องการจ่ายยาหรือไม่? ";  //lock
						}else{
							$sql4="select tradname from druglst where drugcode='".$_GET["drugcode"]."' limit 1";
							$result4 = mysql_query($sql4);
							list($tradname4)=mysql_fetch_array($result4);
							echo "ท่านสั่งจ่ายยา ".$_GET["drugcode"]." , (".$tradname4.") เป็นยาในกลุ่มเดียวกับยาที่ผู้ป่วยมีโอกาสแพ้ยา  \n ท่านยังต้องการจ่ายยาหรือไม่? ";  //alert
						}		
					}else{			
						echo "0";  //ไม่แพ้
					}
			}else{
				echo "0";  //ไม่แพ้
			}		
		}else{			
		//แพ้ยาตามกลุ่ม
		$sql1 = "Select drugcode,tradname FROM drugreact WHERE  hn = '$hn' and drugcode='".$_GET["drugcode"]."' and groupname !='' limit 1";
		//echo $sql1;
		$result1 = mysql_query($sql1);
		$rows1 = mysql_num_rows($result1);
		list($drugcode1,$tradname1)=mysql_fetch_array($result1);

				$sql3="SELECT drugcode,drugreact_group FROM `drugreact_group_list` where drugcode='".$_GET["drugcode"]."'";  //เช็คก่อนว่ามียาที่คีย์มาในกลุ่มที่แพ้หรือไม่	
				$query3=mysql_query($sql3);
				$num3=mysql_num_rows($query3);
				list($drugcode2,$drugreact_group)=mysql_fetch_array($query3);
				if($num3 > 0){  //ถ้ามีอยู่ในกลุ่มที่แพ้ ให้เช็คต่ออีกว่าได้ระบุการแพ้ยาตามกลุ่มไปหรือยัง
					if($drugcode1==$drugcode2){  //ถ้ายาที่ระบุในกลุ่มว่ามีโอกาสแพ้ ตรงกับ ยาที่สั่งจ่ายยา
						echo "คนไข้แพ้ยาตามกลุ่ม ".$drugcode1." , (".$tradname1.")  \n ท่านยังต้องการจ่ายยาหรือไม่? ";  //lock
					}else{
						echo "ท่านสั่งจ่ายยา ".$drugcode1." , (".$tradname1.") เป็นยาในกลุ่มเดียวกับยาที่ผู้ป่วยมีโอกาสแพ้ยา  \n ท่านยังต้องการจ่ายยาหรือไม่? ";  //alert
					}		
				}else{			
					echo "คนไข้มีประวัติแพ้ยา ".$_GET["drugcode"]." , (".$arr["tradname"].")  \n ท่านยังต้องการจ่ายยาหรือไม่? ";  //lock
				}
		}

	exit();
}

	$build = array("42"=>"หอผู้ป่วยหญิง","44"=>"หอผู้ป่วย ICU","43"=>"หอผู้ป่วยสูติ","45"=>"หอผู้ป่วยพิเศษ");

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

// ************************************************************ Submit ************************************************************
if(isset($_POST["Save_dgprofile"]) && $_POST["Save_dgprofile"] == "บันทึกข้อมูลใน DrugProfile" ){
	
	for($j=0;$j<$_SESSION["num_list"];$j++){
		if($_SESSION["list_druglst"]["row_id"][$j]  == ""){

			$w["drugcode"][$i] = $_SESSION["list_druglst"]["drugcode"][$j];
			$w["tradname"][$i] = $_SESSION["list_druglst"]["tradname"][$j];
			$w["part"][$i] = $_SESSION["list_druglst"]["part"][$j];
			$w["slcode"][$i] = $_SESSION["list_druglst"]["slcode"][$j];
			$w["statcon"][$i] = $_SESSION["list_druglst"]["statcon"][$j];
			$w["amount"][$i] = $_SESSION["list_druglst"]["amount"][$j];
			$w["row_id"][$i] = $_SESSION["list_druglst"]["row_id"][$j];
			$w["firstdate"][$i] = $_SESSION["list_druglst"]["firstdate"][$j];			
			$w["enddate"][$i] = $_SESSION["list_druglst"]["enddate"][$j];			
			$i++;

		}
	}

$Thidate = (date("Y")+543).date("-m-d H:i:s");


 /*
 $query = "
	INSERT INTO dphardep
	(chktranx,date,ptname,hn,an,price,doctor,item,idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,accno,tvn,ptright,whokey)
	VALUES
	('".$nRunno."','".$date."','".$ptname."','".$hn."','".$an."','".$price."','".$doctor."','".$item."','".$idname."','".$diag."','".$essd."','".$nessdy."','".$nessdn."','".$dpy."','".$dpn."','".$dsy."','".$dsn."','".$accno."','".$tvn."','".$ptright."','".$whokey."');
	";
*/
	
	$sql2 = "INSERT INTO dgprofile(date,an,drugcode,tradname,unit,salepri,freepri,amount,price,slcode,part,statcon,onoff,dateoff,officer,firstdate,enddate )VALUES ";
	
	$add_status = false;

	for($j=0;$j<$_SESSION["num_list"];$j++){
		if($_SESSION["list_druglst"]["row_id"][$j]  == ""){

			$add_status = true;
			$sql = "Select salepri, freepri, part, unit, tradname   From druglst where drugcode = '".$_SESSION["list_druglst"]["drugcode"][$j]."' limit 0,1 ";
			list($salepri, $freepri, $part, $unit, $tradname) = Mysql_fetch_row(Mysql_Query($sql));

			// เฉพาะ drugcode ทีเป็น old ถ้า tradname ไม่ตรงกันให้เอาตัวที่ user เป็นคนคีย์มาใช้งาน
			if( $_SESSION["list_druglst"]["drugcode"][$j]=="OLD" && $tradname != $_SESSION["list_druglst"]["tradname"][$j]){
				$tradname = $_SESSION["list_druglst"]["tradname"][$j];
			}

		 $sql2 .= "
			('".$Thidate."','".$_GET["an"]."','".$_SESSION["list_druglst"]["drugcode"][$j]."','".$tradname."','".$unit."','".$salepri."','".$freepri."', '".$_SESSION["list_druglst"]["amount"][$j]."','".($salepri * $_SESSION["list_druglst"]["amount"][$j])."','".$_SESSION["list_druglst"]["slcode"][$j]."','".$part."','".$_SESSION["list_druglst"]["statcon"][$j]."','ON','','".$_SESSION["sOfficer"]."', '".$_SESSION["list_druglst"]["firstdate"][$j]."', '".$_SESSION["list_druglst"]["enddate"][$j]."'), ";  
			
			$i++;
		}
	}
		
		$sql2 = substr($sql2,0,-2);
		//echo $sql2."<br>";
		if($add_status == true)
			$result = Mysql_Query($sql2);
		else
			$result = false;


		if($result == true || $_SESSION["num_list"] > 0){
			$txt = "<BR><BR><CENTER>ได้ทำการเพิ่มข้อมูลเรียบร้อยแล้ว<BR>
				<A HREF=\"phardividedrug.php?an=".$_GET["an"]."&bed=".$_GET["bed"]."&bedcode=".$_GET["bedcode"]."\">ตัดจ่ายยา</A>&nbsp;&nbsp;<A HREF=\"enddrugprofile.php\">กลับหน้าward</A>
			</CENTER>";
		}else{
			$txt = "<BR><BR><CENTER>เกิดความผิดพลาดในการเพิ่มข้อมูล</CENTER>";
		}
	
	echo $txt;
	//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"6;URL=",$_SERVER["php_self"],"\">";

exit();

}
// ***************************************************** จบ Submit **************************************************


// ***************************************************** กำหนด Session **************************************************
	session_unregister($list_druglst);
	session_unregister($num_list);

	session_register($list_druglst);
	session_register($num_list);

		$_SESSION["num_list"] = 0;

		$sql = "Select row_id,drugcode, tradname, amount, slcode, statcon, row_id,part From dgprofile where an = '".$_GET["an"]."' AND left( drugcode, 1 ) in ('0','1','2','3','4','5','6','7','8','9','O') AND ((onoff = 'ON' AND (statcon = 'CONT' OR statcon = 'OLD')) OR (`date` like '".(date("Y")+543).date("-m-d")."%' AND (statcon = 'STAT' OR statcon = 'STAT1') ) ) Order by row_id ASC ";


		$result = Mysql_Query($sql);
		while($arr = Mysql_fetch_assoc($result)){
			
			$_SESSION["list_druglst"]["row_id"][$_SESSION["num_list"]] = $arr["row_id"];
			$_SESSION["list_druglst"]["drugcode"][$_SESSION["num_list"]] = $arr["drugcode"];
			$_SESSION["list_druglst"]["tradname"][$_SESSION["num_list"]] = $arr["tradname"];
			$_SESSION["list_druglst"]["part"][$_SESSION["num_list"]] = $arr["part"];
			$_SESSION["list_druglst"]["slcode"][$_SESSION["num_list"]] = $arr["slcode"];
			$_SESSION["list_druglst"]["statcon"][$_SESSION["num_list"]] = $arr["statcon"];
			$_SESSION["list_druglst"]["amount"][$_SESSION["num_list"]] = $arr["amount"];
			$_SESSION["list_druglst"]["row_id"][$_SESSION["num_list"]] = $arr["row_id"];
			$_SESSION["list_druglst"]["firstdate"][$_SESSION["num_list"]] = $arr["firstdate"];
			$_SESSION["list_druglst"]["enddate"][$_SESSION["num_list"]] = $arr["enddate"];

			$sqlDruglst = "SELECT genname FROM druglst WHERE drugcode = '".$arr["drugcode"]."' ";
			$qDruglst = $dbi->query($sqlDruglst);
			if($qDruglst->num_rows>0){
				$druglst = $qDruglst->fetch_assoc();
				$_SESSION["list_druglst"]["genname"][$_SESSION["num_list"]] = $druglst['genname'];
			}else{
				$_SESSION["list_druglst"]["genname"][$_SESSION["num_list"]] = '';
			}

			$_SESSION["num_list"]++;
		}
// ***************************************************** จบ กำหนด Session **************************************************

?>
<html>
<head>
<title>เพิ่ม/ลบ/แก้ไข Drugprofile</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}
body,td,th {
	font-family:  TH SarabunPSK;
	font-size: 18px;
}
.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}

#slidemenubar, #slidemenubar2{
position:absolute;
left:-155px;
width:160px;
top:250px;
border:1.5px solid #FFCC00;


layer-background-color:lightyellow;
font:bold 12px ms sans serif;
line-height:20px;

}

.txtsarabun {
font-family:"TH SarabunPSK";
font-size:20px;
}	


body {
	background-color: #FFFFF0;
	font-family:  TH SarabunPSK;
	font-size: 18px;
}
</style>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript" src="epoch_classes_korsor.js"></script>
<script type="text/javascript">
var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('firstdate'));
	dp_cal  = new Epoch1('epoch_popup','popup',document.getElementById('enddate'));

	// Button ESC for Close Popup
	document.addEventListener("keydown", (event) => {
		if (event.isComposing || event.keyCode === 27) {
			document.getElementById('listdrugcode').innerHTML='';
		}
	});
		
};
</script>
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

function searchSuggest(action,str) {
	
		if(!submit_button(action)){
			return false;
		}

		if(action == 'drugcode')
			lengthsearch = 3;
		else
			lengthsearch = 2;


		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= lengthsearch){
			url = 'listAjax.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("listdrugcode").innerHTML = xmlhttp.responseText;
		}
}

function searchSuggest2(action,str) {
	
	if(!submit_button(action)){
		return false;
	}

	if(str.length >= 2){
		url = 'add_drug.php?action='+action+'&an=<?=$my_an;?>&search=' + str;

		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);

		document.getElementById("listdrugcode").innerHTML = xmlhttp.responseText;
	}else{
		document.getElementById("listdrugcode").innerHTML = '';
	}
}

var returnstr = '';
function update_field(drugcode,tradname,unit,part,slcode){ 
	document.getElementById('drugcode').focus();
	document.getElementById('drugcode').value=drugcode;
	document.getElementById('drugname').value=tradname;
	document.getElementById('unit').value=unit;
	document.getElementById('unit2').value=part;
	document.getElementById('drugslip').value=slcode;
	document.getElementById('listdrugcode').innerHTML = '';
}


function submit_button(action){
	
	if(event.keyCode == 13){
			if(action == "drugcode")
				document.getElementById('drugslip').focus();
			else if(action == "drugslip")
				document.getElementById('amount').focus();
			else if(action == "amount")
				document.getElementById('statcon').focus();
			else if(action == "statcon")
				document.getElementById('button_submit').focus();

		return false;
	}else{
		return true;
	}

}

function checkData(){

var stat = true;
var txt = "";

	if(document.getElementById('drugcode').value == ""){
		txt = txt+"กรุณากรอก รหัสยา  ด้วยครับ \n";
		stat = false;
	}

	if(document.getElementById('drugslip').value == ""){
		txt = txt+"กรุณากรอก วิธีใช้  ด้วยครับ \n";
		stat = false;
	}

	if(document.getElementById('amount').value == ""){
		txt = txt+"กรุณากรอก จำนวน  ด้วยครับ \n";
		stat = false;
	}

	if(document.getElementById('statcon').value == ""){
		txt = txt+"กรุณาเลือก สถานะ  ด้วยครับ \n";
		stat = false;
	}
	

	if(stat == false){
		alert(txt);
	}
return stat;
}

function clearData(){
	
	document.getElementById('drugcode').value = "";
	document.getElementById('drugname').value = "";
	document.getElementById('drugslip').value = "";
	document.getElementById('amount').value = "";
	document.getElementById('unit').value = "";
	document.getElementById('unit2').value = "";
	document.getElementById('statcon').options[0].selected = true;
	document.getElementById('firstdate').value = "";
	document.getElementById('enddate').value = "";	

}



function add_session(){

	if(checkData() == true){
		
		var drugcode;
		var slcode;
		var amount;
		var statcon;
		var tradname;
		var part;
		var firstdate;
		var enddate;
		an = '<?php echo $_GET["an"];?>';
		drugcode = document.getElementById('drugcode').value;
		// drugcode = encodeURIComponent(drugcode);
		slcode = document.getElementById('drugslip').value;
		// slcode = encodeURIComponent(slcode);
		tradname = document.getElementById('drugname').value;
		part = document.getElementById('unit2').value;
		amount = document.getElementById('amount').value;
		statcon = document.getElementById('statcon').value;
		firstdate = document.getElementById('firstdate').value;
		enddate = document.getElementById('enddate').value;		

		var drug_alert = [<?=implode(',', $drugreact_list_js);?>];
		var drug_notify = [<?=implode(',', $drugreact_groups_js);?>];

		if(drug_alert.indexOf(drugcode.trim())>-1){

			var resConfirm = confirm("!!! คำเตือน !!! \n >>> ผู้ป่วยมีการแพ้ยาตัวนี้ <<< \nคลิก OK เพื่อกรอกแบบฟอร์ม Rechallenge หากต้องการสั่งยาต่อไป\nคลิก Cancel เพื่อยกเลิก");
			if (resConfirm===true) {

				returnstr = [drugcode,tradname,unit,part,slcode].join('|');

				var url = 'phar_rechallenge.php?hn='+encodeURIComponent('<?=$bed["hn"];?>');
				url += '&drugcode='+encodeURIComponent(drugcode);
				url += '&returnstr='+returnstr;
				url += '&an='+encodeURIComponent(an);

				window.open(url,"myWindow","width=600,height=300,left=100,top=100");

			}else{
				return false;
			}

		}else{
			if(drug_notify.indexOf(drugcode.trim())>-1){
				alert("ยาที่สั่งใช้ เป็นยาในกลุ่มเดียวกับยาที่ผู้ป่วยมีโอกาสแพ้ยา");
			}
		}

	
		// if(drug_alert(document.getElementById('drugcode').value, '<?=$my_hn;?>')){ //ตรวจสอบการแพ้ยา
			if(drug_interaction(document.getElementById('drugcode').value)){ //ตรวจสอบ drug interaction

				action = "add";
				url = 'listAjax.php?action='+action;
				url += '&drugcode='+encodeURIComponent(drugcode)
				url += '&tradname='+encodeURIComponent(tradname);
				url += '&slcode='+encodeURIComponent(slcode);
				url += '&amount='+encodeURIComponent(amount);
				url += '&statcon='+encodeURIComponent(statcon);
				url += '&part='+encodeURIComponent(part);
				url += '&an='+encodeURIComponent(an);
				url += '&firstdate='+encodeURIComponent(firstdate);
				url += '&enddate='+encodeURIComponent(enddate);

				xmlhttp = newXmlHttp();
				xmlhttp.open("GET", url, false);
				xmlhttp.send(null);

				document.getElementById("show_druglst").innerHTML = xmlhttp.responseText;
				clearData();
				document.getElementById('drugcode').focus();
				list_off();
			}
		// }

	}
}

function del_session(delnum,rowid){

	if(rowid != ""){
		txt = "คุณต้องการ OFF ยา ใช่หรือไม่";
		rowid = "&rowid="+rowid;
	}else{
		txt = "คุณต้องการ ลบ ยาออกจากรายการใช่หรือไม่";
	}
	if(confirm(txt)){
		action = "del";
		an = '<?php echo $_GET["an"];?>';

		url = 'listAjax.php?action='+action+'&delnum='+delnum+'&an='+an+rowid;

				xmlhttp = newXmlHttp();
				xmlhttp.open("GET", url, false);
				xmlhttp.send(null);

				document.getElementById("show_druglst").innerHTML = xmlhttp.responseText;
				list_off();
	}
}

function edit_list(delnum,rowid,slcode,amount,statusdrug){

txt = "คุณต้องการ แก้ไขข้อมูล ใช่หรือไม่";

get_slcode = "&slcode="+slcode;
get_amount = "&amount="+amount;
get_stat = "&statcon="+statusdrug;
	if(slcode == 'OLD'){
		amount = 0;
	}

	if(rowid != ""){
		rowid = "&rowid="+rowid;
	}else{
		rowid = "";
	}
	if(slcode == "" || amount == ""){
		alert("กรุณา กรอกข้อมูล วิธีใช้ และ จำนวนยาให้ครบด้วยครับ");
	}else	if(confirm(txt)){
		action = "edit";
		an = '<?php echo $_GET["an"];?>';

		url = 'listAjax.php?action='+action+'&delnum='+delnum+'&an='+an+get_slcode+get_amount+rowid+get_stat;

				xmlhttp = newXmlHttp();
				xmlhttp.open("GET", url, false);
				xmlhttp.send(null);

				document.getElementById("show_druglst").innerHTML = xmlhttp.responseText;
				list_off();
	}
}

function list_off(){


		action = "list_off";
		if(layer1.style.display == 'none')
			hidd = "0";
		else
			hidd = "1";

		url = 'listAjax.php?action='+action+'&an=<?php echo $_GET["an"];?>&stat='+hidd;

				xmlhttp = newXmlHttp();
				xmlhttp.open("GET", url, false);
				xmlhttp.send(null);

				document.getElementById("div_listoff").innerHTML = xmlhttp.responseText;

}

function drug_alert(drugcode,hn){

	var return_drug_alert;

	xmlhttp = newXmlHttp();
	url = 'add_drug.php?action=drug_alert&drugcode='+ drugcode+'&hn='+hn;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return_drug_alert = xmlhttp.responseText;
	return_drug_alert = return_drug_alert.substr(4);
	
	if(return_drug_alert != "0"){
		if(confirm(return_drug_alert)){
			return true;
		}else{
			return false;
		}
			
	}else{
		return true;
	}

}

function drug_interaction(drugcode){
	
	var return_drug_interaction;

	xmlhttp = newXmlHttp();
	url = 'add_drug.php?action=drug_interaction&drugcode='+ drugcode;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return_drug_interaction = xmlhttp.responseText;
	return_drug_interaction = return_drug_interaction.substr(4);

	if(return_drug_interaction != "0"){
		if(confirm(return_drug_interaction)){
			return true;
		}else{
			return false;
		}
			
	}else{
		return true;
	}

}

</SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
<body>
<style>
	#show_druglst table td{
		padding-bottom: 8px;
	}
</style>
<!-- div Drug List -->

<div id="slidemenubar2" style="left:-350" >
  
<layer id="slidemenubar"  >

<TABLE width="380" class="font_title"  bgcolor="#FFFFFF">
<TR>
	<TD valign="top" width="340">
	<BR>
<CENTER><A HREF="javascript: chang_layer(layer2);">ยาที่เคยจ่าย</A>&nbsp;<FONT COLOR="#000000">|</FONT>&nbsp;<A HREF="javascript: chang_layer(layer1); ">ยาที่เคย Off</A>&nbsp;<FONT COLOR="#000000">|</FONT>&nbsp;<A HREF="javascript: chang_layer(layer3); ">รายการยาเดิม</A></CENTER>
<BR>


<TABLE id="layer2" border = 1 bordercolor="009688"  cellpadding="0" cellspacing="0">
<TR>
	<TD>
	<CENTER>รายการยาที่เคยจ่าย</CENTER>
<TABLE>
<TR align="center" bgcolor="#3300FF" class="font_title">
	<TD width="200" bgcolor="009688"><FONT COLOR="#FFFFFF"><B>รหัสยา</B></FONT></TD>
	<TD width="150" bgcolor="009688"><FONT COLOR="#FFFFFF"><B>วิธีใช้</B></FONT></TD>
</TR>
<?php

$sql = "Select distinct drugcode, unit, tradname, slcode,part From dgprofile where an = '".$_GET["an"]."' AND statcon = 'STAT' AND date < '".(date("Y")+543)."".date("-m-d H:i:s")."' Order by date DESC limit 0,5 ";
$result = Mysql_Query($sql);
while($arr = Mysql_fetch_assoc($result)){

echo "<TR>
	<TD><A HREF=\"#\" Onclick=\"
	document.getElementById('amount').focus();document.getElementById('drugcode').value='",$arr["drugcode"],"';document.getElementById('drugname').value='",jschars($arr["tradname"]),"';document.getElementById('unit').value='",$arr["unit"],"';document.getElementById('unit2').value='",$arr["part"],"';document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('statcon').options[1].selected = true;
	\" >",$arr["drugcode"],"</A></TD>
	<TD>",$arr["slcode"],"</TD>
</TR>";

}
Mysql_free_result($result);
?>
</TABLE>
</TD>
</TR>
</TABLE>
<div id="div_listoff">
<TABLE  id="layer1"  border = 1 bordercolor="#3300FF"  cellpadding="0" cellspacing="0" style="display:none">
<TR>
	<TD>
	<CENTER>รายการยาที่ OFF</CENTER>
<TABLE>
<TR align="center"  bgcolor="#3300FF" class="font_title">
	<TD width="150"><FONT  COLOR="#FFFFFF"><B>รหัสยา</B></FONT></TD>
	<TD width="100"><FONT COLOR="#FFFFFF"><B>วิธีใช้</B></FONT></TD>
	<TD width="50"><FONT COLOR="#FFFFFF"><B>จำนวน</B></FONT></TD>
	<TD width="50"><FONT COLOR="#FFFFFF"><B>ON</B></FONT></TD>
</TR>
<?php

$sql = "Select distinct drugcode, unit, tradname, slcode, amount,part From dgprofile where an = '".$_GET["an"]."' AND (onoff = 'OFF' AND statcon = 'CONT')  ";
$result = Mysql_Query($sql);
while($arr = Mysql_fetch_assoc($result)){

echo "<TR>
	<TD>",$arr["drugcode"],"</TD>
	<TD>",$arr["slcode"],"</TD>
	<TD align=\"right\">",$arr["amount"],"</TD>
	<TD align=\"center\"><A HREF=\"#\" Onclick=\"
	document.getElementById('amount').focus();document.getElementById('drugcode').value='",$arr["drugcode"],"';document.getElementById('drugname').value='",jschars($arr["tradname"]),"';document.getElementById('unit').value='",$arr["unit"],"';document.getElementById('unit2').value='",$arr["part"],"';document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('statcon').options[2].selected = true;
	document.getElementById('amount').value='",$arr["amount"],"'; add_session();\">ON</A></TD>
</TR>";

 }
 Mysql_free_result($result);
 ?>
</TABLE>
</TD>
</TR>
</TABLE>
</div>
<TABLE  id="layer3"  border = 1 bordercolor="#3300FF"  cellpadding="0" cellspacing="0" style="display:none">
<TR>
	<TD>
	<CENTER>รายการยาเดิม</CENTER>
<TABLE>
<TR align="center"  bgcolor="#3300FF" class="font_title">
	<TD width="150"><FONT  COLOR="#FFFFFF"><B>รหัสยา</B></FONT></TD>
	<TD width="100"><FONT COLOR="#FFFFFF"><B>วิธีใช้</B></FONT></TD>
</TR>
<?php

$sql = "Select distinct drugcode, unit, tradname, slcode,part From dgprofile where an = '".$_GET["an"]."' AND  statcon = 'OLD'  limit 0, 10 ";
$result = Mysql_Query($sql);
while($arr = Mysql_fetch_assoc($result)){

echo "<TR>
	<TD><A HREF=\"#\" Onclick=\"
	document.getElementById('amount').focus();document.getElementById('drugcode').value='",$arr["drugcode"],"';document.getElementById('drugname').value='",jschars($arr["tradname"]),"';document.getElementById('unit').value='",$arr["unit"],"';document.getElementById('unit2').value='",$arr["part"],"';document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('statcon').options[1].selected = true;
	\" >",$arr["drugcode"],"</A></TD>
	<TD>",$arr["slcode"],"</TD>

</TR>";

 }
 Mysql_free_result($result);
 ?>
</TABLE>
</TD>
</TR>
</TABLE>
</TD>
	<TD align="center" width="40" bgcolor="#FFCC00" Onclick="pull_draw();">
	D<BR>R<BR>U<BR>G<BR><BR>L<BR>I<BR>S<BR>T
	</TD>
</TR>
</TABLE>

</layer>
</div>


<script language="JavaScript1.2">
	
	function chang_layer(ly){
	 layer1.style.display='none'; 
	 layer2.style.display='none';
	 layer3.style.display='none';
	 ly.style.display = '';
	}

	function regenerate(){
		window.location.reload()
	}

	function regenerate2(){
		if (document.layers)
		setTimeout("window.onresize=regenerate",400)
	}

	// window.onload=regenerate2
	// if (document.all){

	// 	themenu=document.all.slidemenubar2.style
	// 	rightboundary=0
	// 	leftboundary=-350
	// }else{
	// 	themenu=document.layers.slidemenubar
	// 	rightboundary=350
	// 	leftboundary=10
	// }
	
	function pull_draw(){

		if(themenu.pixelLeft == -350){
			pull();
		}else{
			draw();
			
		}
	}

	function pull(){
		if (window.drawit)
			clearInterval(drawit)
		pullit=setInterval("pullengine()",5)
	}

	function draw(){
		clearInterval(pullit)
		drawit=setInterval("drawengine()",5)
	}
	
	function pullengine(){
		if (document.all && themenu.pixelLeft < rightboundary)
			themenu.pixelLeft+=20
		else if(document.layers && themenu.left<rightboundary)
			themenu.left+=5
		else if (window.pullit)
			clearInterval(pullit)
	}

	function drawengine(){
		if (document.all && themenu.pixelLeft > leftboundary)
			themenu.pixelLeft-=20
		else if(document.layers && themenu.left > leftboundary)
			themenu.left-=5
		else if (window.drawit)
			clearInterval(drawit)
	}
</script>

<!-- div End Drug List -->

<?php 
$sql = "Select an, hn, ptname, bedcode, ptright, doctor From bed where an = '".$_GET["an"]."' limit 0,1 ";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);
Mysql_free_result($result);

session_register("hn_now");
$_SESSION["hn_now"] = $arr["hn"];
session_register("an_now");
$_SESSION["an_now"] = $arr["an"];
$_SESSION["ptright_now"] = $arr["ptright"];

?>
<BR>
<TABLE align="center"  border="1" bordercolor="009688" cellspacing="0" cellpadding="0" width="80%">
<TR>
	<TD>
<TABLE width="100%" align="center" cellpadding="6" cellspacing="3">
<TR bgcolor="009688">
	<TD height="46" colspan="6" align="center"><FONT COLOR="#FFFFFF"><B>รายละเอียดผู้ป่วยใน</B></FONT></TD>
</TR>
<TR>
	<TD align="right" bgcolor="#009688"><strong>AN : </strong></TD>
	<TD bgcolor="#00CC99"><a href="med_phar.php?fill_an=<?=$arr["an"];?>" target="_blank" title="Doctor Order"><?=$arr["an"];?></a></TD>
	<TD align="right" bgcolor="009688"><strong>HN : </strong></TD>	
</TD>
	<TD bgcolor="#00CC99"><a href="med_record_detail.php?an=<?=$arr["an"];?>" target="_blank" title="Medication record"><?php echo $arr["hn"];?></a></TD>
	<TD align="right" bgcolor="#009688"><strong>ชื่อ-สกุล : </strong></TD>
	<TD bgcolor="#00CC99"><?php echo $arr["ptname"];?></TD>
</TR>
<TR>
	<TD align="right" bgcolor="#009688"><strong>หอผู้ป่วย : </strong></TD>
	<TD bgcolor="#00CC99"><?php echo $build[substr($arr["bedcode"],0,2)];?></TD>
	<TD align="right" bgcolor="009688"><strong>สิทธิ์ : </strong></TD>
	<TD bgcolor="#00CC99"><?php echo $arr["ptright"];?></TD>
	<TD align="right" bgcolor="#009688"><strong>แพทย์ : </strong></TD>
	<TD bgcolor="#00CC99"><?php echo $arr["doctor"];?></TD>
</TR>
<tr>
	<td align="right" bgcolor="#009688"><b>โรคประจำตัว</b></td>
	<td bgcolor="#00CC99"><?=(!empty($opcard['congenital_disease']) ? $opcard['congenital_disease'] : '-' );?></td>
	<td></td>
	<td></td>
</tr>
</TABLE>
</TD>
</TR>
</TABLE>
<?
$chkdate=(date("Y")+543)."".date("-m-d");
$sql1="select * from phardep where hn = '".$arr["hn"]."' and date like '$chkdate%' and an is null ";
$query1=mysql_query($sql1);
$num=mysql_num_rows($query1);
$result=mysql_fetch_array($query1);
$lastdate=$result["date"];
if($num >0){
echo "<p align='center' style='color:red;'><strong>ผู้ป่วยมีประวัติการจ่ายยา OPD CASE ล่าสุดเมื่อ $lastdate</strong></p>";
}
?>
<TABLE align="center"  border="0" cellspacing="4" cellpadding="0" width="80%">
<TR>
	<TD>
		<?php 
			// แสดงรายการยาที่แพ้
			$sql = "SELECT `drugcode`, `tradname`, `advreact`, `groupname` FROM `drugreact` WHERE `hn` = '".$arr["hn"]."' AND advreact != '' ";
			$result = Mysql_Query($sql);
			$rows = Mysql_num_rows($result);
			if($rows> 0){
				echo "<FONT COLOR=\"red\"><B>แพ้ยาทั้งหมด ".$rows." รายการ</B>";
				?>
				<a href="drugreact_new_add.php?page=show&hn=<?=$my_hn;?>" target="_blank" style="color:blue;">[แก้ไขรายกาแพ้ยา]</a>
				<?php
				echo "<br>";
				$i = 1;
				while(list($drugcode,  $tradname , $advreact, $groupname) = Mysql_fetch_row($result)){ 

					$advreactTxt = '';
					if(!empty($advreact)){
						$advreactTxt = ' <b>อาการ :</b> '.$advreact;
					}

					$groupTxt = '';
					if (!empty($groupname)) {
						$groupTxt = ' <b>['.$groupname.']</b>';
					}

					echo "<b>$i)</b> [",$drugcode,"] : ", $tradname , $advreactTxt, $groupTxt, "<BR>";
					$i++;
				}
				echo "</FONT>";
			}
		?>
	</TD>
	<td valign="top">
		
		<?php 
		$sql = "SELECT a.*,b.`tradname` FROM ( SELECT `id`,`hn`,`an`,`drugcode`,`doctor`,`reason`, SUBSTRING(`date`,1,10) AS `date` FROM `dt_rechallenge` WHERE `an` = '$an' ORDER BY `id` ASC ) AS a 
		LEFT JOIN `druglst` AS b ON a.`drugcode` = b.`drugcode` ";
		$q = $dbi->query($sql);
		if ($q->num_rows > 0) {
			?>
			<table style="border:2px solid #009688;" width="100%">
				<tr>
					<th colspan="4"><b>บันทึก Rechallenge</b></th>
				</tr>
				<tr style="background-color: #009688; color: #ffffff;">
					<th>วันที่บันทึก</th>
					<th>รหัสยา</th>
					<th>แพทย์</th>
					<th>เหตุผล</th>
				</tr>
				<?php 
				while ($a = $q->fetch_assoc()) { 

					?>
					<tr style="background-color: #00CC99;">
						<td><?=$a['date'];?></td>
						<td>
							<a href="javascript:void(0);" onclick="show_rechallenge('<?=$a['id'];?>')">[<b><?=$a['drugcode'];?></b>] : <?=$a['tradname'];?></a>
						</td>
						<td><?=$a['doctor'];?></td>
						<td><?=$a['reason'];?></td>
					</tr>
					<?php
				}
				?>
			</table>
			<script>
				function show_rechallenge(id){
					window.open("dt_show_rechallenge.php?id="+id, "WinRechallenge","width=600,height=300,left=100,top=100");
				}
			</script>
			<?php
		}
		?>
	</td>
</TR>
		<?php 
		if (count($groupnameList)>0) {
			$i = 1;
			echo "<tr><td colspan='6'><font color=\"red\"><b>กลุ่มยาที่แพ้</b></font></td></tr>";
			foreach ($groupnameList as $key => $value) {
				echo "<tr><td colspan='6'><font color=\"red\">$i) ".$value['groupname']."...".$value['advreact']."( ".$value['asses']." )</font></td></tr>";
				$i++;
			}
		}
		?>
</TABLE>

<div align="center" ><BR>
</div>
<TABLE width="55%" align="center" cellpadding="6" cellspacing="3">
	<TR>
		<TD width="14%" align="right"><strong>รหัสยา : </strong></TD>
	  	<TD width="17%" style="position: relative;">
			<INPUT NAME="drugcode" TYPE="text" class="txtsarabun" ID="drugcode" onKeyPress="searchSuggest2('drugcode',this.value); " onKeyDown="if(event.keyCode == 40 && document.getElementById('listdrugcode').innerHTML != ''){ document.getElementById('list_radio').focus(); document.getElementById('list_radio').checked=true ; return false;  }" size="13" autofocus>
		</TD>
		<TD width="14%" align="right"><strong>ชื่อยา :</strong></TD>
		<TD width="25%"><INPUT NAME="drugname" TYPE="text" class="txtsarabun" ID = "drugname" onKeyPress="submit_button('drugcode');"  size="25" ></TD>
		<TD width="15%" align="right"><strong>วิธีใช้ :</strong></TD>
		<TD width="15%"><INPUT NAME="drugslip" TYPE="text" class="txtsarabun" ID = "drugslip"
	  onkeypress="searchSuggest('drugslip',this.value);" onKeyDown="if(event.keyCode == 40 && document.getElementById('listdrugcode').innerHTML != ''){ document.getElementById('list_radio').focus(); document.getElementById('list_radio').checked=true ; return false;  }" size="11"
		></TD>
	</TR>
	<TR>
		<TD style="position: relative;" align="right">
			<strong>จำนวน : </strong>
			<div id="listdrugcode" style="position: absolute; top:0; left:0; width:960px; height:auto; overflow:auto; background-color:#ffffff"></div>
		</TD>
	  <TD><INPUT NAME="amount" TYPE="text" class="txtsarabun" ID="amount"  onkeypress="submit_button('amount');" size="4"></TD>
		<TD align="right"><strong>หน่วย :</strong></TD>
		<TD align="left">
			<INPUT NAME="unit" TYPE="text" class="txtsarabun" ID="unit" onKeyPress="submit_button('amount');"  size="5" readonly> 
			<strong>ประเภท:</strong>
			<INPUT NAME="unit2" TYPE="text" class="txtsarabun" ID="unit2"   size="5" readonly></TD>
		<TD align="right"><strong>สถานะ :</strong></TD>
		<TD>
						<SELECT NAME="statcon" class="txtsarabun" ID="statcon"  onkeypress="submit_button('statcon');" >
					    <OPTION VALUE="" SELECTED>-- สถานะ --</OPTION>
							<OPTION VALUE="STAT1">STAT</OPTION>
							<OPTION VALUE="STAT">จ่ายวันเดียว</OPTION>
							<OPTION VALUE="CONT">ยา continue</OPTION>
							<OPTION VALUE="OLD">ยาเดิม</OPTION>
						</SELECT>		</TD>
	</TR>
	<TR>
	  <TD colspan="6" align="center"><table width="90%" border="0" cellspacing="2" cellpadding="4">
        <TR>
          <TD align="center"><strong>วันที่เริ่มต้น : </strong>            &nbsp;
            <input name="firstdate" type="text" class="txtsarabun" id="firstdate" size="15" placeholder="Ex. 2021-01-01">
            <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่สิ้นสุด : </strong>
            &nbsp;
          <input name="enddate" type="text" class="txtsarabun" id="enddate" size="15" placeholder="Ex. 2021-01-07"></TD>
        </TR>
        
      </table></TD>
  </TR>
	<TR>
		<TD height="50" colspan="6" align="center" valign="bottom">
			<INPUT ID="button_submit" TYPE="button" class="txtsarabun" VALUE=" เพิ่มข้อมูล " ONCLICK="add_session();">&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="button" class="txtsarabun" VALUE=" เลือกผู้ป่วยใหม่ " ONCLICK="window.location.href='enddrugprofile.php';">&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="button" class="txtsarabun" VALUE=" ข้อมูลการจ่ายยา " ONCLICK="window.open('rp_profile.php?an=<?php echo $arr["an"];?>&month=<?php echo date("m");?>&year=<?php echo (date("Y")+543);?>&date=<?php echo date("dmy");?>','_blank');">&nbsp;&nbsp;&nbsp;
            <input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="txtsarabun" /></TD>
  </TR>
	</TABLE>
<BR>
	<div align="center"><a href="add_drugold.php?an=<?=$_GET["an"];?>" target="_blank">เพิ่มยาเดิม (นอกโรงพยาบาล)</a></div>
<BR><BR>

<CENTER>
  <strong>[ รายการยา ]</strong>
</CENTER>
<BR>
<?php
	$sql = "Select date_format(date,'%d/%m/%Y') as dateform From dgprofile  where an = '".$_GET["an"]."' Order by date DESC limit 0,1 ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);

	echo "<DD>วันที่ปรับปรุงล่าสุด : ",$arr["dateform"],"<BR><BR>";
?>
<div id="show_druglst">
<TABLE align="center"  border="1" bordercolor="009688" cellspacing="0" cellpadding="0" width="85%">
<TR>
	<TD>
<TABLE width="100%">
<TR bgcolor="#3300FF" class="font_title" align="center">
	<TD bgcolor="009688">รหัสยา</TD>
	<TD bgcolor="009688">ชื่อยา</TD>
    <TD bgcolor="009688">ประเภท</TD>
	<TD bgcolor="009688">วิธีใช้</TD>
	<TD bgcolor="009688">จำนวน</TD>
	<TD bgcolor="009688">สถานะ</TD>
	<TD bgcolor="009688">OFF / ลบ</TD>
	<TD bgcolor="009688">แก้ไข</TD>
</TR>
<?php

$list_status_drug = array();

$list_status_drug["STAT1"] = "Stat";
$list_status_drug["STAT"] = "One day";
$list_status_drug["CONT"] = "Continue";
$list_status_drug["OLD"] = "ยาเดิม";


for($j=0;$j<$_SESSION["num_list"];$j++){

	if($_SESSION["list_druglst"]["statcon"][$j] == "CONT")
		$bgcolor = "#00CC99";
	else
		$bgcolor = "#FFFFCC";
		

	$sql = "SELECT an,drugcode,tradname,firstdate,enddate  FROM `dgprofile`  where an='".$_GET["an"]."' and statcon = 'CONT' and onoff='ON' and enddate='".date("Y-m-d")."' and drugcode='".$_SESSION["list_druglst"]["drugcode"][$j]."'";
	//echo $sql;
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	$rows=mysql_fetch_array($result);

	$row_id = $_SESSION["list_druglst"]["row_id"][$j];
	$genname = ''.$_SESSION["list_druglst"]["genname"][$j].'';

echo "
<TR bgcolor=\"",$bgcolor,"\" id=\"trParent$j\">
	<TD>",$_SESSION["list_druglst"]["drugcode"][$j],"</TD>
	<TD><b>",$_SESSION["list_druglst"]["tradname"][$j],"</b><br>",$genname,"</TD>
	<TD>",$_SESSION["list_druglst"]["part"][$j],"</TD>
	<TD><INPUT TYPE=\"text\" class=\"txtsarabun\" id=\"slcode",$j,"\" NAME=\"slcode",$j,"\" value=\"",$_SESSION["list_druglst"]["slcode"][$j],"\" size=\"6\"></TD>
	<TD ><INPUT TYPE=\"text\" class=\"txtsarabun\" id=\"amount",$j,"\" NAME=\"amount",$j,"\" value=\"",$_SESSION["list_druglst"]["amount"][$j],"\" size=\"3\"></TD>";
	?>
	<TD align="center">
    <select name="statusdrug<?=$j?>" class="txtsarabun" id="statusdrug<?=$j?>" onchange="updateStatdrugSession('<?=$j;?>','<?=$row_id;?>',this.value)">
    <option value="STAT1" <? if($_SESSION["list_druglst"]["statcon"][$j]=="STAT1"){ echo "selected";}?>>Stat</option>
    <option value="STAT" <? if($_SESSION["list_druglst"]["statcon"][$j]=="STAT"){ echo "selected";}?>>One day</option>
    <option value="CONT" <? if($_SESSION["list_druglst"]["statcon"][$j]=="CONT"){ echo "selected";}?>>Continue</option>
    <option value="OLD" <? if($_SESSION["list_druglst"]["statcon"][$j]=="OLD"){ echo "selected";}?>>ยาเดิม</option>
    </select>
    <?php
	if($num >0){
    echo "<div style=\"color:#FF0000; font-size: 16px;\"><strong>ครบกำหนด CONT ยา</strong></div>";
	}
	?>
</TD>
    <?
	
	echo "<TD align=\"center\">",(
		$_SESSION["list_druglst"]["row_id"][$j] != "" ? "<A HREF=\"javascript: del_session('".$j."','".$_SESSION["list_druglst"]["row_id"][$j]."');\">OFF</A>" : "<A HREF=\"javascript: del_session('".$j."','');\">ลบ</A>"
	),"</TD>
	<TD align=\"center\"><A HREF=\"javascript: edit_list('".$j."','".$_SESSION["list_druglst"]["row_id"][$j]."',document.getElementById('slcode",$j,"').value,document.getElementById('amount",$j,"').value,document.getElementById('statusdrug",$j,"').value);\">แก้ไข</A></TD>
</TR>

";

}

?>
</TABLE>
<script type="text/javascript">
	function updateStatdrugSession(i, row_id, value){

		var test_str = [];
		test_str.push(encodeURIComponent('action')+"="+encodeURIComponent('changeSession'));
		test_str.push(encodeURIComponent('i')+"="+encodeURIComponent(row_id));
		test_str.push(encodeURIComponent('value')+"="+encodeURIComponent(value));
		var data = test_str.join("&");

		var request = new newXmlHttp();
		request.open('POST', 'add_drug.php', true);
		request.setRequestHeader(
			'Content-Type',
			'application/x-www-form-urlencoded; charset=UTF-8'
		);
		request.onreadystatechange = function () {
			if (request.readyState === 4) {
				if (request.status >= 200 && request.status < 400) { 
					var res = request.responseText.replace(/^\s+|\s+$/g, '');;
					if(res=='CONT'){

						document.getElementById("trParent"+i).style.backgroundColor = '#00CC99';

					}else{

						document.getElementById("trParent"+i).style.backgroundColor = '#FFFFCC';

					}
				}else{
					//error
				}
			}
		}
		request.send(data);
		
	}
</script>
</TD>
</TR>
</TABLE>
<br>
<?php
if($_SESSION["num_list"] > 0)
	echo "
	<FORM METHOD=POST ACTION=\"\">
	<CENTER><INPUT TYPE=\"submit\" class=\"txtsarabun\" Name=\"Save_dgprofile\"  VALUE=\"บันทึกข้อมูลใน DrugProfile\" ></CENTER>
	</FORM>";
?>
</div>

</body>
</html>
<?php
//unset($_SESSION["hn_now"]);
include("unconnect.inc");
?>