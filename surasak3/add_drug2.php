<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

// ตั้งค่าเปิด dgprofile
if($_GET['action']=='setOn'){
	
	$sql = sprintf("UPDATE `dgprofile` SET `onoff`='ON' WHERE (`row_id`='%s') LIMIT 1;", $dbi->real_escape_string($_GET['row_id']));
	$q = $dbi->query($sql);
	$res = array('status'=>200);
	if($q===false){
		$res = array('status'=>400,'msg'=>$dbi->error);
	}
	echo $json->encode($res);
	exit;
}

// อัพเดท drugslip
if($_GET['action']=='update_drugslip'){
	$res = array('status'=>200);
	if(!empty($_GET['row_id'])){
		$sql = sprintf("UPDATE `dgprofile` SET `slcode`='%s' WHERE `row_id`='%s' LIMIT 1;", $dbi->real_escape_string($_GET['slcode']), $dbi->real_escape_string($_GET['row_id']));
		$q = $dbi->query($sql);
		if($q===false){
			$res = array('status'=>400,'msg'=>$dbi->error);
		}else{
			$key = array_search($_GET['row_id'], $_SESSION['list_druglst']['row_id']);
			$_SESSION['list_druglst']['slcode'][$key] = sprintf('%s', $dbi->real_escape_string($_GET['slcode']));
		}
	}else{ // ถ้าไม่มี ID อัพเดทแค่ตัว SESSION
		$ii = $_GET['ii'];
		$_SESSION['list_druglst']['slcode'][$ii] = sprintf('%s', $dbi->real_escape_string($_GET['slcode']));
	}
	echo $json->encode($res);
	exit;
}

// อัพเดท amount
if($_GET['action']=='update_amount'){
	$sql = sprintf("SELECT `salepri`,`freepri` FROM `druglst` WHERE `drugcode` = '%s' LIMIT 1;", $dbi->real_escape_string($_GET['drugcode']));
	$q = $dbi->query($sql);
	if($q->num_rows>0){
		$d = $q->fetch_assoc();
		$salepri = $d['salepri'];
		$freepri = $d['freepri'];
		$amount = sprintf('%d', $_GET['amount']);
		$price = $amount * $salepri;

		$sql = sprintf("UPDATE `dgprofile` SET 
		`amount`='%d',
		`salepri` = '%s',
		`freepri` = '%s',
		`price` = '%s'
		WHERE `row_id`='%s' LIMIT 1;", 
			$dbi->real_escape_string($_GET['amount']), 
			$dbi->real_escape_string($salepri), 
			$dbi->real_escape_string($freepri), 
			$dbi->real_escape_string($price), 
			$dbi->real_escape_string($_GET['row_id'])
		);
		$q = $dbi->query($sql);
		$res = array('status'=>200);
		if($q===false){
			$res = array('status'=>400,'msg'=>$dbi->error);
		}else{

			// ตามไปอัพเดท session
			$key = array_search($_GET['row_id'], $_SESSION['list_druglst']['row_id']);
			$_SESSION['list_druglst']['amount'][$key] = sprintf('%d', $dbi->real_escape_string($_GET['amount']));
		}
	}else{
		$res = array('status'=>400,'msg'=>sprintf('ไม่พบข้อมูลยารหัส %s', $dbi->real_escape_string($_GET['drugcode'])));
	}
	echo $json->encode($res);
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
		echo "<p><b>เกิด Drug Interaction</b></p>ระหว่างยา ".$druglist[0]." กับยา ".$druglist[1]." \n <br><b>ผลกระทบ</b> : ".$arr["effect"]." \n <br><b>กลไกที่เกิด</b> : ".$arr["action"]." \n <br><b>การติดตาม</b> : ".$arr["follow"]." \n <br><b>onset</b> : ".$arr["onset"]." \n <b>ความรุนแรง</b> : ".$arr["violence"]." \n <br><b>หลักฐาน</b> : ".$arr["referable"]." \n <br>ท่านยังต้องการจ่ายยาหรือไม่? ";
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

/**
 * แสดงรายการยาตามที่ keypress ในช่องรหัสยา (id="drugcode")
 */
$search_txt = trim(sprintf("%s", $_GET['search']));
if($_GET["action"] == "drugcode" && !empty($search_txt)){

	$sql = "Select prefix From `runno` where `title`  = 'passdrug' limit 1 ";
	list($pass_drug) = mysql_fetch_row(mysql_query($sql));
	
	$sql = "SELECT a.`drugcode`,a.`tradname`,a.genname,a.`unit`,a.`unitpri`,a.`stock`,a.`part`,b.`slcode`, a.`lock`, a.`lock_ipd`, a.`lock_dr`
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
						while($arr = $res->fetch_assoc()){
						
							// $drugcode = jschars($arr["tradname"]);

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
							
							if($arr["part"] == "DDY"){
								$style = "style='color:#0000FF;' ";
							}elseif($arr["part"] == "DDN" || $arr["part"] == "DSN" || $arr["part"] == "DPN"){
								$style = "style='color:#FF0000;' ";
							}else{
								$style = "";
							}
				
							if($arr["lock_dr"] != "Y"){  //lockยา
								if($arr["lock_dr"] =="N"){
									$obj = "ยาตัดออก";
								}else{
									$obj = $arr["lock_dr"];
								}
							}else{
								$obj="";
							}
							//echo $arr["drugcode"]."===>$obj";
							if(($arr["lock_ipd"]=="N") && (substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09" || substr($_SESSION["ptright_now"],0,3) == "R10"  || substr($_SESSION["ptright_now"],0,3) == "R11"  || substr($_SESSION["ptright_now"],0,3) == "R12"  || substr($_SESSION["ptright_now"],0,3) == "R13"  || substr($_SESSION["ptright_now"],0,3) == "R14"  || substr($_SESSION["ptright_now"],0,3) == "R17"  || substr($_SESSION["ptright_now"],0,3) == "R27" || substr($_SESSION["ptright_now"],0,3) == "R35"  || substr($_SESSION["ptright_now"],0,3) == "R36"  || substr($_SESSION["ptright_now"],0,3) == "R40")){  //ถ้า lock ยา  R27 รับสั่งการที่ทิวา  22/11/2565
							?>
							<TR <?=$style;?>>
								<? if($obj==""){?>
								<TD>
									<INPUT TYPE="text" class="input_check_pass" ID="<?=$txt;?>" NAME="select_radio" size="3" maxlength="3" onkeypress="if(event.keyCode==13){if(this.value=='<?=$pass_drug;?>'){ update_field('<?=$arr['drugcode'];?>','<?=$arr['tradname'];?>','<?=$arr['unit'];?>','<?=$arr['part'];?>','<?=$arr['slcode'];?>'); }else{ alert('รหัสผ่านไม่ถูกต้อง') } } ">
									<br><FONT style="font-size: 16px;" COLOR="red"><u>รับรหัสผ่านได้ที่ผู้อำนวยการโรงพยาบาลเท่านั้น</u></FONT>
								</TD>
								<? }else{ ?>
								<TD><?=$obj;?></TD>
								<? } ?>
								<TD><?=$arr["drugcode"];?> <?=$alert_txt;?><?=$relative_react_txt;?></TD>
								<TD align="left"><?=$arr["tradname"];?></TD>
								<td align="left"><?=$arr['genname'];?></td>
								<TD><?=$arr["part"];?></TD>
								<TD><?=$arr["unitpri"];?></TD>
								<TD><?=$arr["stock"];?></TD>
							</TR>
							<?php
							}else{  //ถ้าไม่ได้ lock ยา
								?>
								<TR <?=$style;?>>
									<? if($obj==""){  //ไม่ได้ lockยา ?>
									<TD>
										<input type="radio" name="simple" id="simple" ondblclick="update_field('<?=$arr['drugcode'];?>','<?=$arr['tradname'];?>','<?=$arr['unit'];?>','<?=$arr['part'];?>','<?=$arr['slcode'];?>')">
									</TD>
									<TD>
										<A HREF="javascript:void(0)" Onclick="update_field('<?=$arr['drugcode'];?>','<?=$arr['tradname'];?>','<?=$arr['unit'];?>','<?=$arr['part'];?>','<?=$arr['slcode'];?>')"><?=$arr['drugcode'];?></A>
										<?=$alert_txt;?><?=$relative_react_txt;?>
									</TD>
									<? }else{ ?>
									<TD><?=$obj;?></TD>
									<TD>
										<?=$arr['drugcode'];?>
										<?=$alert_txt;?><?=$relative_react_txt;?>
									</TD>
									<? } ?>
									<TD align="left"><?=$arr["tradname"];?></TD>
									<td align="left"><?=$arr['genname'];?></td>
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

if($_GET["action"] == "drugslip"){ //วิธีใช้********************************************************************
	$sql = "Select slcode,  detail1, detail2, detail3  From drugslip  where (slcode Like '".$_GET["search"]."%')  Order by slcode ASC   ";
	$result = Mysql_Query($sql);
	if(Mysql_num_rows($result) > 0 && $_GET["search"] != "" ){
		echo "<TABLE width=\"100%\" border=\"1\" bordercolor=\"blue\" cellspacing=\"0\" cellpadding=\"0\"  >
		<TR>
			<TD>
		<TABLE width=\"100%\"  bgcolor=\"#FFFFFF\">
		<TR bgcolor=\"blue\" align=\"center\">
			<TD>&nbsp;</TD>
			<TD><FONT  COLOR=\"#FFFFDD\"><B>รหัสการใช้</B></FONT></TD>
			<TD><FONT  COLOR=\"#FFFFDD\"><B>รายละเอียด</B></FONT>
			<span align=\"right\"><A HREF=\"#\" Onclick=\"document.getElementById('listdrugcode').innerHTML='';\">[ X ]</A>&nbsp;</span>
			</TD>
		</TR>";
		$i=0;
		while($arr = Mysql_fetch_assoc($result)){
			if($i == 0){
				$txt = "list_radio";
			}else{
				$txt = "select_radio".$i;
			}
			$i++; 
			echo "<TR>
				<TD><INPUT TYPE=\"radio\" ID = \"",$txt,"\" NAME=\"select_radio\" onkeypress=\"if(event.keyCode == 13){document.getElementById('amount').focus();document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('listdrugcode').innerHTML='';}\"></TD>
				<TD><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('drugslip').focus();document.getElementById('drugslip').value='",$arr["slcode"],"';document.getElementById('listdrugcode').innerHTML='';\">",$arr["slcode"],"</A></TD>
				<TD>",$arr["detail1"]," ",$arr["detail2"]," ",$arr["detail3"],"</TD>
			</TR>";
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE>";
	}
	exit;
}

if($_GET["action"] == "drugslip2"){ 
	$row_id = $_GET['row_id'];
    $container = $_GET['container'] ? $_GET['container'] : 'listdrugcode' ;
    $divId = $_GET['return'];
	$ii = $_GET['ii']; // ลำดับของ session
	$sql = sprintf("SELECT `slcode`,`detail1`,`detail2`,`detail3` From `drugslip` WHERE `slcode` LIKE '%s%%' ORDER BY `slcode` ASC", $dbi->real_escape_string($_GET["search"]));
	$result = $dbi->query($sql);
	$rows = $result->num_rows;
	if($rows > 0){
		?>
		<TABLE width="100%" border="1" bordercolor="blue" cellspacing="0" cellpadding="0" id="drugSlipTable" >
		<TR>
			<TD>
				<TABLE width="100%"  bgcolor="#FFFFFF">
				<TR bgcolor="blue" align="center">
					<TD><FONT COLOR="#FFFFDD"><B>รหัสการใช้</B></FONT></TD>
					<TD><FONT COLOR="#FFFFDD"><B>รายละเอียด</B></FONT>
					<span align="right"><A HREF="javascript:void(0)" Onclick="document.getElementById('<?= $container ?>').remove();">[ ปิด ]</A>&nbsp;</span>
					</TD>
				</TR>
				<?php
				while($arr = $result->fetch_assoc()){
					?>
					<TR>
						<TD align='left'><A HREF="javascript:void(0);" onclick="selectSlip('<?= $row_id ?>','<?=$divId;?>','<?=$arr['slcode'];?>','<?=$container;?>','<?= $ii ?>')"><?= $arr['slcode'];?></A></TD>
						<TD align='left'><?= $arr["detail1"]." ".$arr["detail2"]." ".$arr["detail3"] ?></TD>
					</TR>
					<?php
				}// end while
				?>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
		<?php
	} // end if
	else{
		echo "0";
	}
	exit;
}

if($_GET["action"] == "add"){
/******* เพิ่มข้อมูลใน SESSION ********************************************************************/

	// การเพิ่มยากรณีที่เป็นยา CONT ที่เคยมีอยู่แล้ว จะอัพเดทสถานะเป็น ON
	if($_GET["statcon"] == "CONT"){
		$sql = "Select row_id From dgprofile where drugcode='".$_GET["drugcode"]."' AND slcode = '".$_GET["slcode"]."' AND an = '".$_GET["an"]."' AND statcon='CONT' limit 0,1";
		$rowsProfile = Mysql_num_rows(Mysql_Query($sql));
	}else{
		$rowsProfile = 0;
	}

	if($rowsProfile == 1){
		$sql = "Update dgprofile set onoff = 'ON', dateoff='' where drugcode='".$_GET["drugcode"]."' AND slcode = '".$_GET["slcode"]."' AND an = '".$_GET["an"]."' AND statcon='CONT' ";
		Mysql_Query($sql);
		restart_session($_GET["an"]);
	}else{
		if($_GET["statcon"] == "OLD")
			$_GET["amount"] = "0";

		$_SESSION["list_druglst"]["drugcode"][$_SESSION["num_list"]] = $_GET["drugcode"];
		$_SESSION["list_druglst"]["unit"][$_SESSION["num_list"]] = $_GET["unit"]; // มาจากช่อง หน่วย
		$_SESSION["list_druglst"]["part"][$_SESSION["num_list"]] = $_GET["part"]; // มาจากช่อง ประเภท
		$_SESSION["list_druglst"]["slcode"][$_SESSION["num_list"]] = $_GET["slcode"];
		$_SESSION["list_druglst"]["statcon"][$_SESSION["num_list"]] = $_GET["statcon"];
		$_SESSION["list_druglst"]["amount"][$_SESSION["num_list"]] = $_GET["amount"];
		$_SESSION["list_druglst"]["row_id"][$_SESSION["num_list"]] = "";
		$_SESSION["list_druglst"]["firstdate"][$_SESSION["num_list"]] = $_GET["firstdate"];
		$_SESSION["list_druglst"]["enddate"][$_SESSION["num_list"]] = $_GET["enddate"];
		
		if($_GET["tradname"] == "")
			$_SESSION["list_druglst"]["tradname"][$_SESSION["num_list"]] = $tradname;
		else
			$_SESSION["list_druglst"]["tradname"][$_SESSION["num_list"]] = $_GET["tradname"];

		$_SESSION["num_list"]++;

	}

	// show_session();
	include_once 'add_drug_template.php';
	exit;
}

if($_GET["action"] == "del"){
	
/******* ลบข้อมูลใน SESSION ********************************************************************/
	if(isset($_GET["rowid"]) && $_GET["rowid"] != ""){
		$res = array('status'=>200);
		$sqlSelect = "SELECT * FROM `dgprofile` WHERE `row_id` = '".$_GET["rowid"]."' ";
		$result = Mysql_Query($sqlSelect);
		$arr = Mysql_fetch_assoc($result);
		if($arr["statcon"] == "CONT"){
			$sql = "Update dgprofile set onoff = 'OFF', dateoff = '".date("Y-m-d H:i:s")."' where row_id = '".$_GET["rowid"]."' limit 1 ";
			$result = Mysql_Query($sql);
		}else{

			// เก็บยา OLD ไว้เป็นประวัติ
			$insertOld = "INSERT INTO `dgprofile_old` ".$sqlSelect;
			$q = $dbi->query($insertOld);

			$sql = "Delete From dgprofile  where row_id = '".$_GET["rowid"]."' limit 1 ";
			$result = Mysql_Query($sql);
			if($result!==false){
				$res['statcon'] = $arr["statcon"];
			}else{
				$res = array('status'=>400,'error'=>mysql_error($result));
			}
		}
		
		// เอา an ไปดึงข้อมูลจากใน dgprofile แล้วสร้าง SESSION ใหม่
		restart_session($_GET["an"]);

	}else{

		$res = array('status'=>200);

		for($j=$_GET["delnum"];$j<$_SESSION["num_list"];$j++){
			$_SESSION["list_druglst"]["drugcode"][$j] = $_SESSION["list_druglst"]["drugcode"][$j+1];
			$_SESSION["list_druglst"]["tradname"][$j] = $_SESSION["list_druglst"]["tradname"][$j+1];
			$_SESSION["list_druglst"]["part"][$j] = $_SESSION["list_druglst"]["part"][$j+1];
			$_SESSION["list_druglst"]["slcode"][$j] = $_SESSION["list_druglst"]["slcode"][$j+1];
			$_SESSION["list_druglst"]["statcon"][$j] = $_SESSION["list_druglst"]["statcon"][$j+1];
			$_SESSION["list_druglst"]["amount"][$j] = $_SESSION["list_druglst"]["amount"][$j+1];
			$_SESSION["list_druglst"]["row_id"][$j] = $_SESSION["list_druglst"]["row_id"][$j+1];
			$_SESSION["list_druglst"]["firstdate"][$j] = $_SESSION["list_druglst"]["firstdate"][$j+1];
			$_SESSION["list_druglst"]["enddate"][$j] = $_SESSION["list_druglst"]["enddate"][$j+1];			
		}

		$_SESSION["num_list"]--;
		unset($_SESSION["list_druglst"]["drugcode"][$_SESSION["num_list"]]);
		unset($_SESSION["list_druglst"]["tradname"][$_SESSION["num_list"]]);
		unset($_SESSION["list_druglst"]["part"][$_SESSION["num_list"]]);
		unset($_SESSION["list_druglst"]["slcode"][$_SESSION["num_list"]]);
		unset($_SESSION["list_druglst"]["statcon"][$_SESSION["num_list"]]);
		unset($_SESSION["list_druglst"]["amount"][$_SESSION["num_list"]]);
		unset($_SESSION["list_druglst"]["row_id"][$_SESSION["num_list"]]);
		unset($_SESSION["list_druglst"]["firstdate"][$_SESSION["num_list"]]);
		unset($_SESSION["list_druglst"]["enddate"][$_SESSION["num_list"]]);			
	}

	echo $json->encode($res);
	exit;
}

function restart_session($an){
	
	$sql = "Select drugcode, tradname, amount, slcode, statcon, row_id,part From dgprofile where an = '".$_GET["an"]."' AND ((onoff = 'ON' AND statcon = 'CONT') OR  (`date` like '".(date("Y")+543).date("-m-d")."%' AND statcon <> 'CONT' ) ) ";

	$result = Mysql_Query($sql);
	$i=0;
	while($arr = Mysql_fetch_assoc($result)){
		
		$w["drugcode"][$i] = $arr["drugcode"];
		$w["tradname"][$i] = $arr["tradname"];
		$w["slcode"][$i] = $arr["slcode"];
		$w["statcon"][$i] = $arr["statcon"];
		$w["amount"][$i] = $arr["amount"];
		$w["part"][$i] = $arr["part"];
		$w["row_id"][$i] = $arr["row_id"];
		$i++;
	}
	
	for($j=0;$j<$_SESSION["num_list"];$j++){
		if($_SESSION["list_druglst"]["row_id"][$j]  == ""){

			$w["drugcode"][$i] = $_SESSION["list_druglst"]["drugcode"][$j];
			$w["tradname"][$i] = $_SESSION["list_druglst"]["tradname"][$j];
			$w["slcode"][$i] = $_SESSION["list_druglst"]["slcode"][$j];
			$w["statcon"][$i] = $_SESSION["list_druglst"]["statcon"][$j];
			$w["amount"][$i] = $_SESSION["list_druglst"]["amount"][$j];
			$w["part"][$i] = $_SESSION["list_druglst"]["part"][$j];
			$w["row_id"][$i] = $_SESSION["list_druglst"]["row_id"][$j];
			$i++;

		}
	}
	session_unregister("list_druglst");
	session_register("list_druglst");
	$_SESSION["list_druglst"] = $w;
	$_SESSION["num_list"] = $i;
}


function show_session(){
	include_once 'add_drug_template.php';
} // end show_session



/**
 * ไม่ได้ใช้งาน
 */
if($_GET["action"] == "edit"){

/******* แก้ไขข้อมูลใน SESSION ********************************************************************/

	$sql = "Select row_id From drugslip where slcode = '".$_GET["slcode"]."' limit 1";
	$result = Mysql_Query($sql);
	$count = Mysql_num_rows($result);
	if($count ==0){
		echo "<div  id=\"msgalert\" align = \"center\" style=\"position: absolute;text-align: center; overflow:auto; \">
		<TABLE align=\"center\" bgcolor=\"#FFFFFF\" border=\"1\" bordercolor=\"#FF0000\" cellspacing=\"0\" cellpadding=\"0\" width=\"85%\" Onclick=\"document.getElementById('msgalert').innerHTML = '';\">
			<TR>
				<TD>
					<TABLE width=\"100%\">
						<TR bgcolor=\"#FF0000\" class=\"font_title\" align=\"center\">
							<TD align=\"center\">
								<FONT COLOR=\"#FFFFFF\"><B>Alert</B></FONT>
							</TD>
						</TR>
						<TR>
							<TD align=\"center\"><BR>ไม่สามารถแก้ไขข้อมูลได้<BR>ไม่มีรหัสวิธีใช้ยา ".$_GET["slcode"]."<BR><BR></TD>
						</TR>
					</TABLE>
				</TD>
			</TR>
		</TABLE>
		</div>";
	}else if(isset($_GET["rowid"]) && $_GET["rowid"] != ""){
		
		$sql = "Select count(statcon) as count_dg,statcon From dgprofile where row_id = '".$_GET["rowid"]."' ";
		$result = Mysql_Query($sql);
		$arr = Mysql_fetch_assoc($result);
		$Thidate = (date("Y")+543).date("-m-d H:i:s");
		$Thidate2 = date("Y-m-d H:i:s");
		if($arr["count_dg"] > 0){
			
			if(($arr['statcon']!=$_GET["statcon"])&&($arr['statcon']!=$Thidate)){
				$sql = "Update dgprofile set onoff = 'OFF' , dateoff = '$Thidate2' where row_id = '".$_GET["rowid"]."' limit 1 ";
				$result = Mysql_Query($sql);
				
				$sql = "Select salepri, freepri, part, unit, tradname   From druglst where drugcode = '".$_SESSION["list_druglst"]["drugcode"][$_GET["delnum"]]."' limit 0,1 ";
				list($salepri, $freepri, $part, $unit, $tradname) = Mysql_fetch_row(Mysql_Query($sql));
				
				$sql2= "INSERT INTO dgprofile
				(date,an,drugcode,tradname,unit,salepri,
				freepri,amount,price,slcode,part,statcon,
				onoff,dateoff,officer )
				VALUES
				('".$Thidate."','".$_GET["an"]."','".$_SESSION["list_druglst"]["drugcode"][$_GET["delnum"]]."','".$tradname."','".$unit."','".$salepri."',
				'".$freepri."', '".$_SESSION["list_druglst"]["amount"][$_GET["delnum"]]."','".($salepri * $_SESSION["list_druglst"]["amount"][$_GET["delnum"]])."','".$_SESSION["list_druglst"]["slcode"][$_GET["delnum"]]."','".$part."','".$_GET["statcon"]."',
				'ON','','".$_SESSION["sOfficer"]."') ";
				$result2 = Mysql_Query($sql2);
				
	
			}else{
				$sql = "Update dgprofile set slcode = '".$_GET["slcode"]."', amount = '".$_GET["amount"]."' where row_id = '".$_GET["rowid"]."' limit 1 ";
				$result = Mysql_Query($sql);
			}
		}

		restart_session($_GET["an"]);

	}else{

		$_SESSION["list_druglst"]["slcode"][$_GET["delnum"]] = $_GET["slcode"];
		$_SESSION["list_druglst"]["amount"][$_GET["delnum"]] = $_GET["amount"];
		$_SESSION["list_druglst"]["statcon"][$_GET["delnum"]] = $_GET["statcon"];
	}
		// show_session();

	exit;
}
