<?php
include("Connections/connect.inc.php"); 


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
if(isset($_GET["action"]) && $_GET["action"] == "alert500"){
	echo $_SESSION["alert500"];
	$_SESSION["alert500"] = 1;
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
}else{
	list($date, $tradname, $amount, $slcode) = mysql_fetch_row($result);
	echo "เคยจ่ายยา ".$tradname." ครั้งล่าสุดเมื่อวันที่ ".$date." จำนวน ".$amount." วิธีใช้ ".$slcode." \n ท่านต้องการสั่งยาหรือไม่?";
}

exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "viewtolist"){

	echo "<FORM name=\"form_list\" METHOD=POST ACTION=\"dt_drug_add.php\">
	<A HREF=\"javascript:showremed();checkall(false);\">Remed</A> ";
	
$sql = "Select idname From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1 ";
list($sld) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select row_id From dr_drugsuit where code_dr = '".$sld."' limit 1";
	
	$rows = mysql_num_rows(Mysql_Query($sql));
	if($rows > 0)
		echo "| <A HREF=\"javascript:showsult();checkall3(true);\">สูตรยา</A>";


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
	$sql = " Select date_format(date,'%d/%m/%Y'), amount, slcode From drugrx where amount > 0 AND hn = '".$_SESSION["hn_now"]."' AND drugcode = '".$_SESSION["list_drugcode"][$i]."' AND status = 'Y' AND  date between '".$date1."' AND '".$date2."' Order by date DESC ";
	$result = mysql_query($sql);
	
	$remark = array();
	
	if($_SESSION["list_drug_reason"][$i] != ""){
		array_push($remark,"<FONT style=\"font-size: 20;\">เหตุผล ".$_SESSION["list_drug_reason"][$i]."</FONT>");
	}

	if(mysql_num_rows($result) > 0){
		list($d, $a, $s) = mysql_fetch_row($result);
		array_push($remark,"<FONT style=\"font-size: 20px;\" COLOR=\"red\">เคยจ่ายยาครั้งสุดท้าย วันที่ ".$d." จำนวน ".$a." วิธีใช้ ".$s."</FONT>");
	}



	

	

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

			$sql = "Select detail1, detail2, detail3, detail4  From drugslip where slcode = '".$_SESSION["list_drugslip"][$i]."' limit 1";
			$result = Mysql_Query($sql);
			list($detail1,$detail2,$detail3,$detail4) = Mysql_fetch_row($result);
			
			array_push($remark,"<FONT style=\"font-size: 20;\" color=\"#000000\">วิธีใช้ยา ".$detail1." ".$detail2." ".$detail3." ".$detail4."</FONT>");
			
			if(count($remark) > 0){
				$list_remark = implode("<BR>",$remark);
			}

			if($part == "DDY"){
				$style=" style=\"color:#0000FF\" ";
			}else{
				$style="";	
			}

			echo "
			<TR  class='tb_detail' ".$style.">
				<TD align=\"center\"><INPUT TYPE=\"checkbox\" NAME=\"check_list[]\" value=\"".$i."\"></TD>
				<TD>&nbsp;&nbsp;<span style=\"CURSOR: pointer\" OnmouseOver = \"show_tooltip('รายละเอียดยา','&nbsp;&nbsp;&nbsp;<B>",$drugname,"</B>&nbsp;&nbsp;&nbsp;<BR>สต็อก : ",$stock," ",$unit,"<BR>ราคา : ".$salepri." บาท <BR>PART : ".$part." ','left',-200,-180);\" OnmouseOut = \"hid_tooltip();\">",$drugname,"</span><BR>".$list_remark."</TD>
				<TD align='right'>",$_SESSION["list_drugamount"][$i],"&nbsp;&nbsp;</TD>
				<TD>",$unit,"</TD>
				<TD><span style=\"CURSOR: pointer\" OnmouseOver = \"show_tooltip('วิธีใช้ยา','",$detail1."<BR>".$detail2."<BR>".$detail3."<BR>".$detail4,"','center',-200,-180);\" OnmouseOut = \"hid_tooltip();\">",$_SESSION["list_drugslip"][$i],"</span></TD>
				<TD align='center'><A HREF=\"#\" Onclick=\"javascript : document.getElementById('drug_code').value='",jschars($_SESSION["list_drugcode"][$i]),"';document.getElementById('drug_amount').value='",jschars($_SESSION["list_drugamount"][$i]),"';document.getElementById('drug_slip').value='",jschars($_SESSION["list_drugslip"][$i]),"';document.getElementById('addoredit').value='".$i."';if(check_inject('",jschars($_SESSION["list_drugcode"][$i]),"') == true){
				
			document.getElementById('drug_inject_amount').style.display = '';
			document.getElementById('drug_inject_slip').style.display = '';
			document.getElementById('drug_inject_type').style.display = '';
			document.getElementById('drug_inject_etc').style.display = '';
			
			document.form1.drug_inject_amount.value = '",jschars($_SESSION["list_drug_inject_amount"][$i]),"';
			document.form1.drug_inject_slip.value = '",jschars($_SESSION["list_drug_inject_slip"][$i]),"';
			document.form1.drug_inject_type.value = '",jschars($_SESSION["list_drug_inject_type"][$i]),"';
			document.form1.drug_inject_etc.value = '",jschars($_SESSION["list_drug_inject_etc"][$i]),"';

				}else{
					
			document.getElementById('drug_inject_amount').style.display = 'none';
			document.getElementById('drug_inject_slip').style.display = 'none';
			document.getElementById('drug_inject_type').style.display = 'none';
			document.getElementById('drug_inject_etc').style.display = 'none';
					
				}";
				
			if($part=='DDY'){ 
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 

			}else if($_SESSION["list_drugcode"][$i] == "1NEUT300*$"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 
				
			}else if($_SESSION["list_drugcode"][$i] == "1PLAV*"){
				echo " document.getElementById('reason').style.display = '';clearobt(document.form1.reason);addobtreason(document.form1.reason,'".$part."','".$_SESSION["list_drugcode"][$i]."','".$_SESSION["list_drug_reason"][$i]."')"; 
				
			}else{
				echo " document.getElementById('reason').style.display = 'none';clearobt(document.form1.reason);";
			}
			echo "\">แก้ไข</A></TD>
			</TR>
			";

	}
	if($i >0)
	echo "<TR class='tb_detail'>
					<TD   colspan=\"6\">&nbsp;&nbsp;รวมค่ายา : $total_price บาท, ค่าบริการ : 50 บาท <BR>&nbsp;&nbsp;ค่ายาที่เบิกได้ : ".($pricetype["DDL"]+$pricetype["DDY"]+$pricetype["DPY"]).", ค่ายาที่เบิกไม่ได้ : ".($pricetype["DSY"]+$pricetype["DDN"]+$pricetype["DSN"]+$pricetype["DPN"]).", รวมทั้งหมด : ".($total_price+50)." บาท</TD>
				</TR>";

	echo "<TR class='tb_detail'>
					<TD  align=\"center\" ><INPUT TYPE=\"button\" value=\"  ลบ  \" onclick=\"del_list();\"></TD>
					<TD  colspan=\"5\">";
	if($_SESSION["dt_special"])
	echo "&nbsp;&nbsp;&nbsp;&nbsp;คิดค่าคลินิกพิเศษ <INPUT TYPE=\"text\" NAME=\"clinic150\" value=\"150\" size=\"4\">";

	echo "<div  align=\"center\"><INPUT TYPE=\"submit\" value=\"      ตกลง      \"></div></TD></TR>";
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
		
	</FORM>";
	exit();
}



//********************** Form Remed ยา **************************************************************
if(isset($_GET["action"]) && $_GET["action"] == "date_remed"){
?>
<FORM name="form_remed" METHOD=POST ACTION="">
		<table width="722" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="45" align="center"><input type="checkbox" name="checkbox2" value="" Onclick="checkall(this.checked)"/></td>
            <td align="center" >รายการยา</td>
			<td align="center" >วิธีใช้</td>
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
	SELECT a.date, a.drugcode, a.tradname, a.slcode, sum( a.amount ) AS amount, a.reason, a.part, a.drug_inject_amount , a.drug_inject_slip , a.drug_inject_type,  a.drug_inject_etc, b.lock_dr 
	FROM drugrx as a INNER JOIN (Select `drugcode`,`lock_dr` From druglst ".$where1.") as b ON a.drugcode = b.drugcode
	WHERE a.hn = '".$_SESSION["hn_now"]."' AND a.date like '".$_GET["date_remed"]."%' AND a.drugcode <> 'INJ' AND a.row_id not in (Select row_id From drugrx_notinj)
	GROUP BY a.drugcode, a.slcode
	HAVING sum( a.amount ) >0
	";
	
	$result = Mysql_Query($sql) or die(Mysql_Error());
	$i=0;
	$j=0;
	while($arr = Mysql_fetch_assoc($result)){
		
		if($arr["part"] == "DDY" && $arr["reason"] == ""){
				$arr["reason"] = "ไม่มีสูตรยานี้ในบัญชียา ED";
		}

		/*if(($arr["drugcode"][0] == "0" || $arr["drugcode"][0] == "2") && !(ord($arr["drugcode"][1])  >= 48 && ord($arr["drugcode"][1]) <= 57 )){
			continue;
		}*/

		if($i%2==0)
			$bgcolor="#FFFF99";
		else
			$bgcolor="#FFFFFF";
		

?>
          <tr bgcolor="<?php echo $bgcolor;?>">
            <td width="45" align="center">
			<?php if($arr["lock_dr"] == 'Y'){?>
              <input type="checkbox" id="drug_remed<?php echo $i+1;?>" name="drug_remed<?php echo $i+1;?>" value="<?php echo $arr["drugcode"];?>][<?php echo $arr["slcode"];?>][<?php echo $arr["amount"];?>][<?php echo $arr["reason"];?>][<?php echo $arr["drug_inject_amount"];?>][<?php echo $arr["drug_inject_slip"];?>][<?php echo $arr["drug_inject_type"];?>][<?php echo $arr["drug_inject_etc"];?>" />
			  <?php $i++; $j++;}else{ 
				if($arr["lock_dr"] =="N"){
					echo "ยาตัดออก";
				}else{
					echo $arr["lock_dr"];
				}
			} ?>
            </td>
            <td >&nbsp;<?php echo $arr["tradname"];?></td>
			<td align="center">&nbsp;<?php echo $arr["slcode"];?></td>
			<td align="center" >&nbsp;<?php echo $arr["amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_amount"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_slip"];?></td>
			<td align="center">&nbsp;<?php echo $arr["drug_inject_type"];?></td>
          </tr>
		  <?php if($arr["reason"] == "" && ($arr["part"] == "DDY" || $arr["drugcode"] == "1NEUT300*$" || $arr["drugcode"] =="1PLAV*")){
					
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
            <td colspan="7" align="left">เหตุผล : 
				<?php if($arr["part"] == "DDY"){
					
				?>
				<SELECT id="chose_reason<?php echo $j;?>" NAME="chose_reason<?php echo $j;?>" >
					<Option value="ใช้ยาในบัญชียาหลักแห่งชาติแล้วไม่ดีขึ้น" <?php echo $i1;?>>ใช้ยาแล้วไม่ได้ผล ไม่ครอบคลุมอาการ</Option>
					<Option value="ไม่มียาในบัญชียาหลักแห่งชาติที่ใช้รักษาตามข้อบ่งชี้" <?php echo $i2;?>>ใช้ยา ED ใช้ยาแล้วมีผลข้างเคียง</Option>
					<Option value="แพ้ยาในบัญชียาหลักแห่งชาติ"  <?php echo $i3;?>>ไม่มีสูตรยานี้ในบัญชียา ED</Option>
					<Option value="มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชียาหลักต่อไปได้" <?php echo $i4;?>>รักษาต่อเนื่องจากโรงพยาบาลอื่น</Option>
					<Option value="ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา(drug interaction)กับยาในบัญชียาหลักแห่งชาติ" <?php echo $ii5;?>>ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา</Option>
					<Option value="ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน" <?php echo $ii6;?>>ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน</Option>
					<Option value="มีความจำเป็นที่ต้องใช้ยานอกบัญชียาหลักเพราะมีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย" <?php echo $ii7;?>>มีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย</Option>
				</SELECT>
				<?php }else if($arr["drugcode"] == "1NEUT300*$"){ ?>
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
				<?php } ?>
					
				
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
	$sql = "Select a.drugcode, b.tradname, a.slcode, a.amount, b.part, b.lock_dr, a.drug_inject_amount , a.drug_inject_slip,  a.drug_inject_type,  a.drug_inject_etc  From dr_drugsuit_detail as a, druglst as b where a.drugcode = b.drugcode ".$where1." AND a.for_id = '".$_GET["date_sult"]."' ";
	
	$result = Mysql_Query($sql);
	$i=0;
	while($arr = Mysql_fetch_assoc($result)){
		

		if($arr["part"] == "DDY"){
		$reason = "ไม่มีสูตรยานี้ในบัญชียา ED";
	}else{
		$reason = "";
	}

		if($i%2==0)
			$bgcolor="#FFFFCC";
		else
			$bgcolor="#FFFFFF";
?>
          <tr bgcolor="<?php echo $bgcolor;?>">
            <td width="75" align="center">
			<?php if(($arr["drugcode"][0] == "0" || $arr["drugcode"][0] == "2") && !(ord($arr["drugcode"][1])  >= 48 && ord($arr["drugcode"][1]) <= 57 ) && ($arr["drug_inject_amount"] == "" || $arr["drug_inject_slip"] == "" || $arr["drug_inject_type"] == "")){
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
	
	$count = count($_SESSION["list_drugcode"]);
	
	$sql = "Select part From druglst Where drugcode = '".$_GET["drugcode"]."' limit 1";
	$result = Mysql_Query($sql);
	list($part) = Mysql_fetch_row($result);
	
	
	if($part != "DDY" && $_GET["drugcode"] != "1NEUT300*$" && $_GET["drugcode"] != "1PLAV*")
		$_GET["reason"] = "";
	
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
				$_SESSION["list_drug_inject_slip"][$_GET["addoredit"]] = $_GET["drug_inject_slip"];
				$_SESSION["list_drug_inject_type"][$_GET["addoredit"]] = $_GET["drug_inject_type"];
				$_SESSION["list_drug_inject_etc"][$_GET["addoredit"]] = $_GET["drug_inject_etc"];
				
					$_SESSION["list_drug_reason"][$_GET["addoredit"]] = $_GET["reason"];

	}else{
		$add = true;

	}
	
	if($add){

		array_push($_SESSION["list_drugcode"],$_GET["drugcode"]);
		array_push($_SESSION["list_drugamount"],$_GET["drugamount"]);
		array_push($_SESSION["list_drugslip"],$_GET["drugslip"]);
		array_push($_SESSION["list_drug_inject_amount"],$_GET["drug_inject_amount"]);
		array_push($_SESSION["list_drug_inject_slip"],$_GET["drug_inject_slip"]);
		array_push($_SESSION["list_drug_inject_type"],$_GET["drug_inject_type"]);
		array_push($_SESSION["list_drug_inject_etc"],$_GET["drug_inject_etc"]);
		array_push($_SESSION["list_drug_reason"],$_GET["reason"]);

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
	$_SESSION["list_drug_inject_slip"] = array() ;
	$_SESSION["list_drug_inject_type"] = array() ;
	$_SESSION["list_drug_inject_etc"] = array() ;
	$_SESSION["list_drug_reason"] = array() ;

	$sql = " Select row_id, item, stkcutdate From dphardep where hn = '".$_SESSION["hn_now"]."' AND whokey = 'DR' AND idname='".$_SESSION["dt_doctor"]."' AND date like '".((date("Y")+543).date("-m-d"))."%' Order by row_id DESC limit 1";
	$result = Mysql_Query($sql);
	list($id, $item, $stkcutdate) = Mysql_fetch_row($result);
	
	if($stkcutdate)
	session_register("cancle_row_id");
	$_SESSION["cancle_row_id"] = $id;

	$sql = "Select drugcode, amount, slcode, drug_inject_amount,  drug_inject_slip,  drug_inject_type,  drug_inject_etc, reason   From ddrugrx where idno = '".$id."' AND hn='".$_SESSION["hn_now"]."' AND  date like '".((date("Y")+543).date("-m-d"))."%' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($_SESSION["list_drugcode"],$arr["drugcode"]);
		array_push($_SESSION["list_drugamount"],$arr["amount"]);
		array_push($_SESSION["list_drugslip"],$arr["slcode"]);

		array_push($_SESSION["list_drug_inject_amount"],$arr["drug_inject_amount"]);
		array_push($_SESSION["list_drug_inject_slip"],$arr["drug_inject_slip"]);
		array_push($_SESSION["list_drug_inject_type"],$arr["drug_inject_type"]);
		array_push($_SESSION["list_drug_inject_etc"],$arr["drug_inject_etc"]);
		array_push($_SESSION["list_drug_reason"],$arr["reason"]);

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

			$_SESSION["list_drug_inject_amount"][$i] = $_SESSION["list_drug_inject_amount"][$i+1];
			$_SESSION["list_drug_inject_slip"][$i] = $_SESSION["list_drug_inject_slip"][$i+1];
			$_SESSION["list_drug_inject_type"][$i] = $_SESSION["list_drug_inject_type"][$i+1];
			$_SESSION["list_drug_inject_etc"][$i] = $_SESSION["list_drug_inject_etc"][$i+1];
			$_SESSION["list_drug_reason"][$i] = $_SESSION["list_drug_reason"][$i+1];
		
	}

	unset($_SESSION["list_drugcode"][$count-1]);
	unset($_SESSION["list_drugamount"][$count-1]);
	unset($_SESSION["list_drugslip"][$count-1]);
	unset($_SESSION["list_drug_inject_amount"][$count-1]);
	unset($_SESSION["list_drug_inject_slip"][$count-1]);
	unset($_SESSION["list_drug_inject_type"][$count-1]);
	unset($_SESSION["list_drug_inject_etc"][$count-1]);
	unset($_SESSION["list_drug_reason"][$count-1]);

	exit();
}

//************************** แสดงรายการยาให้เลือก  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "drug"){
	
	if($_GET["search"] == "viat"){
		$where = "drugcode = '5FLES' OR ";
	}
	
	$sql = "Select prefix From `runno` where `title`  = 'passdrug' limit 1 ";
	list($pass_drug) = mysql_fetch_row(mysql_query($sql));
	$sql = "Select drugcode, tradname, genname,unit, stock, salepri, part, `lock`, lock_dr From druglst where ".$where." (drugcode like '%".$_GET["search"]."%' OR genname LIKE '%".$_GET["search"]."%' OR  tradname LIKE '%".$_GET["search"]."%') Order by drugcode ASC";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:770px; height:430px; overflow:auto; \">";
		
		
		echo "<table bgcolor=\"#09F\" width=\"750\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
		<tr align=\"center\" bgcolor=\"#09F\">
		<td width=\"20\"><font style=\"color: #09F\"></font></td>
		<td width=\"73\"><font style=\"color: #FFFFFF\"></font></td>
		<td width=\"368\"><font style=\"color: #FFFFFF\"><strong>ชื่อยา</strong></font></td>
		<td width=\"110\"><font style=\"color: #FFFFFF\"><strong>หน่วย</strong></font></td>
		<td width=\"79\"><font style=\"color: #FFFFFF\"><strong>ราคา</strong></font></td>
		<td width=\"24\" bgcolor=\"#09F\"><font style=\"color: #FF0000;\" size='2'><strong><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><img src='Windows-Close-Program-icon.png' width='37' height='36' alt=\"ปิดหน้าต่าง\" border=\"0\"/></A></strong></font></td>
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
				}else if($arr["lock"] != "Y" && (substr($_SESSION["ptright_now"],0,3) == "R07"  || substr($_SESSION["ptright_now"],0,3) == "R09"  )){
					$obj = "รหัส:<INPUT TYPE=\"text\" NAME=\"txt_choice\" size=\"3\" maxlength=\"3\" onkeypress=\"if(event.keyCode==13){if(this.value=='".$pass_drug."'){add_drug('".trim($arr["drugcode"])."');}else{alert('รหัสผ่านไม่ถูกต้อง')}} \">";
					$alert="<FONT style=\"font-size: 18px;\" COLOR=\"red\">ติดต่อรับรหัสผ่านได้ที่สำนักงานแพทย์ </FONT>";
				}else{
					$obj = "<INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13)add_drug('".trim($arr["drugcode"])."'); \" ondblclick=\"add_drug('".trim($arr["drugcode"])."'); \">";
					$alert="";
				}

				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";
				
				if($arr["part"] == "DDY"){
					$style = " style='color:#0000FF;' ";
				}else{
					$style = "";
				}

				$arr["genname"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["genname"]);
				$arr["tradname"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["tradname"]);

			echo "<tr bgcolor=\"$bgcolor\" ".$style.">
					<td rowspan=\"3\" align=\"center\">
					".$obj."</td>
					<td align=\"right\" bgcolor=\"$bgcolor\">ชื่อสามัญ : </td>
					<td bgcolor=\"$bgcolor\">",$arr["genname"],"</td>
					<td rowspan=\"2\" bgcolor=\"$bgcolor\" align=\"center\">",$arr["unit"],"</td>
					<td colspan=\"2\" rowspan=\"2\" bgcolor=\"$bgcolor\">",$arr["salepri"],"</td>
				</tr>
				<tr ".$style.">
					<td align=\"right\" bgcolor=\"$bgcolor\">ชื่อการค้า : </td>
					<td bgcolor=\"$bgcolor\">",$arr["tradname"],"</td>
				</tr>
				<tr >
					<td colspan=\"4\" bgcolor=\"$bgcolor\">",$alert,"</td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
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
	echo "<Div style=\"position: absolute;text-align: left; width:720px; height:400px; overflow:auto; \"><TABLE width=\"100%\" bgcolor=\"#FFFFCC\"><TD align=\"center\" bgcolor=\"#3333CC\" width=\"460\"><FONT COLOR=\"#FFFFFF\"><B>รายการวิธีใช้ยา</B></FONT></TD><TD  bgcolor=\"red\" align=\"center\"><FONT COLOR=\"#FFFFFF\"><B><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></B></FONT></TD>";
	while($arr = Mysql_fetch_assoc($result)){
	
	echo "<TR bgcolor=\"#FFFFCC\">
					<TD colspan=\"2\"><INPUT id='choice' TYPE=\"radio\" NAME=\"choice\" onkeypress=\"if(event.keyCode==13)addslip('",$arr["slcode"],"'); \" ondblclick=\"addslip('",$arr["slcode"],"'); \" >&nbsp;",$arr["detail1"]," ",$arr["detail2"]," ",$arr["detail3"]," ",$arr["detail4"],"</TD>
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


//******************************************** ตรวจสอบการเกิด DRUG INTERACTION *****************************
if(isset($_GET["action"]) && $_GET["action"] == "drug_interaction"){
	
	$list_session = " '".implode("','",$_SESSION["list_drugcode"])."' ";
	
	$sql = "SELECT first_drugcode, between_drugcode, effect, action, follow, onset, violence, referable  FROM drug_interaction  where (first_drugcode = '".$_GET["drugcode"]."' AND between_drugcode in (".$list_session.") ) OR (between_drugcode = '".$_GET["drugcode"]."' AND first_drugcode in (".$list_session.") ) ";
	
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


//**********************************************************************************************
?>
<html>
<head>
<title><?php echo $_SESSION["dt_doctor"];?></title>
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
		
		nameojt.options[nameojt.options.length]=new Option("ใช้ยาในบัญชียาหลักแล้วไม่ดีขึ้น","ใช้ยาในบัญชียาหลักแห่งชาติแล้วไม่ดีขึ้น");
		nameojt.options[nameojt.options.length]=new Option("ไม่มียาในบัญชียาหลักที่ใช้รักษาตามข้อบ่งชี้","ไม่มียาในบัญชียาหลักแห่งชาติที่ใช้รักษาตามข้อบ่งชี้");
		nameojt.options[nameojt.options.length]=new Option("แพ้ยาในบัญชียาหลักแห่งชาติ","แพ้ยาในบัญชียาหลักแห่งชาติ");
		nameojt.options[nameojt.options.length]=new Option("มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชีได้","มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชียาหลักต่อไปได้");

		nameojt.options[nameojt.options.length]=new Option("ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา","ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา(drug interaction)กับยาในบัญชียาหลักแห่งชาติ");
		nameojt.options[nameojt.options.length]=new Option("ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน","ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน");
		nameojt.options[nameojt.options.length]=new Option("มีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย","มีความจำเป็นที่ต้องใช้ยานอกบัญชียาหลักเพราะมีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย");
		nameojt.value = sl;
		

	}else{
		
		if(dc=="1NEUT300*$"){
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

	}

	
	if(nameojt.value == '' && sl != ""){
			nameojt.options[nameojt.options.length]=new Option(sl,sl);
			nameojt.value = sl;
	}
	

}

function add_drug(drugcode){
	
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
	
	if(vl[2] == "DDY" || drugcode =="1NEUT300*$" || drugcode == "1PLAV*"){
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
			
			document.getElementById('drug_inject_amount').style.display = '';
			document.getElementById('drug_inject_slip').style.display = '';
			document.getElementById('drug_inject_type').style.display = '';
			document.getElementById('drug_inject_etc').style.display = '';
	}else{

			document.getElementById('drug_inject_amount').style.display = 'none';
			document.getElementById('drug_inject_slip').style.display = 'none';
			document.getElementById('drug_inject_type').style.display = 'none';
			document.getElementById('drug_inject_etc').style.display = 'none';
	}
		
}

function addslip(drugslip){
	
	document.getElementById("drug_slip").value = drugslip;
	document.getElementById('list').innerHTML='';
	document.getElementById("form_submit").focus();
}

function ajaxcheck(action,str){
	
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action='+action+'&search=' + str;
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

}


function addtolist(drugcode, drugamount, drugslip,addoredit, drug_inject_amount, drug_inject_slip, drug_inject_type, drug_inject_etc,reason){
	
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=addtolist&drugcode=' + drugcode+'&drugamount='+drugamount+'&drugslip='+drugslip+'&addoredit='+addoredit+'&drug_inject_amount='+drug_inject_amount+'&drug_inject_slip='+drug_inject_slip+'&drug_inject_type='+drug_inject_type+'&drug_inject_etc='+drug_inject_etc+'&reason='+reason
	;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();
	alert500();

}

function alert500(){
	
	if(eval(document.getElementById("total_all_price").value) > 500){

	var ptright = '<?php echo substr($_SESSION["ptright_now"],0,3);?>';
	var stat = '';
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action=alert500';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	stat = xmlhttp.responseText;
	stat = stat.substr(4);
		if(stat == '0'){
			if((ptright == 'R07' || ptright == 'R09') && eval(document.getElementById("total_all_price").value) > 500){
					alert("ท่านได้จ่ายยาเกิน 500 บาท ให้ ผู้ป่วย สิทธิ <?php echo substr($_SESSION["ptright_now"],4);?>");
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
	var txt2 ;

	txt = ajaxcheck("checkdrugcode",document.form1.drug_code.value);
	txt = txt.substr(4);

	txt2 = ajaxcheck("checkdrugslip",document.form1.drug_slip.value);
	txt2 = txt2.substr(4);
	
	txt3 = ajaxcheck("check30day",document.form1.drug_code.value);
	txt3 = txt3.substr(4);

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
	}else if(txt == "0"){
		alert("กรุณาลองใส่รหัสยาใหม่");
		document.form1.drug_code.focus();
	}else if(txt2 == "0"){
		alert("กรุณาใส่วิธีใช้ยา ใหม่");
		document.form1.drug_slip.focus();
	}else if(txt == "3" && !confirm("ผู้ป่วยมีการแพ้ยาตัวนี้ ต้องการจ่ายยาหรือไม่?")){
		document.form1.drug_code.focus();
	}else if(txt3 != "0" && !confirm(txt3)){
		return false;
	}else if(document.form1.drug_code.value == "1COVE5" && eval(document.form1.drug_amount.value) % 30 != 0 ){
		alert("ยา Coversyl arginine 5 mg. บรรจุขวดขวดละ 30 เม็ด ไม่สามารถแกะได้ \n กรุณาสั่งยา ด้วยจำนวน 30, 60, 90 หรือ 120 ครับ");
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
	}
	
	else if(return_drug_interaction != "0" && !confirm(return_drug_interaction)){

		document.form1.drug_code.focus();
		
	}else{
		
			if(check_inject(document.form1.drug_code.value) == false){
				
				document.form1.drug_inject_amount.value = '1';
				document.form1.drug_inject_slip.value = '';
				document.form1.drug_inject_type.value = '';
				document.form1.drug_inject_etc.value = '';

			}
			addtolist(document.form1.drug_code.value,document.form1.drug_amount.value,document.form1.drug_slip.value,document.form1.addoredit.value,document.form1.drug_inject_amount.value,document.form1.drug_inject_slip.value,document.form1.drug_inject_type.value,document.form1.drug_inject_etc.value,document.form1.reason.value);
		
		document.getElementById('drug_inject_amount').style.display = 'none';
		document.getElementById('drug_inject_slip').style.display = 'none';
		document.getElementById('drug_inject_type').style.display = 'none';
		document.getElementById('drug_inject_etc').style.display = 'none';
		document.getElementById('reason').style.display = 'none';
		
		document.form1.drug_code.value = "";
		document.form1.drug_amount.value = "";
		document.form1.drug_slip.value = "";
		document.form1.addoredit.value = "E";

		document.form1.drug_inject_amount.value ="1";
		document.form1.drug_inject_slip.selectedIndex = 0;
		document.form1.drug_inject_type.selectedIndex = 1;
		document.form1.drug_inject_etc.value ="";
		document.form1.reason.selectedIndex = 2;

		document.form1.drug_code.focus();
		
	}


}

function listdrugprov(){

	if(confirm('ท่านต้องการแก้ไขข้อมูลใช้การจ่ายยาใช้หรือไม่')){
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
			

				if(document.getElementById("chose_reason"+i).value != "-"){
					zz[3] = document.getElementById("chose_reason"+i).value;
				}
			
		
			addtolist(zz[0],zz[2],zz[1],'E', zz[4], zz[5], zz[6], '',zz[3]);

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
			
			addtolist(zz[0],zz[2],zz[1],'E', zz[4], zz[5], zz[6], zz[7],zz[3]);

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

	$sql = "
	SELECT DISTINCT date_format( a.date, '%d/%m/%Y' ) AS date1, date_format( a.date, '%Y-%m-%d' ) as date2 
	FROM drugrx as a INNER JOIN (Select `drugcode`,`lock_dr` From druglst ".$where1." ) as b ON a.drugcode = b.drugcode
	WHERE a.hn = '".$_SESSION["hn_now"]."' AND a.drugcode <> 'INJ' AND a.row_id not in (Select row_id From drugrx_notinj)
	GROUP BY date2, a.drugcode, a.slcode
	HAVING sum( a.amount ) >0
	Order by a.date DESC limit 20
	
	";

			$result = Mysql_Query($sql) or die(mysql_error());
			while($arr = Mysql_fetch_assoc($result)){
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
	<DIV id="div_remed" >
	</DIV>
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
<FORM Name="form1" METHOD=POST ACTION="" Onsubmit=" return false;">
<TABLE width="100%" border="1" bordercolor="#F0F000">
<TR>
	<TD>
<TABLE border="0">
<TR>
	<TD align="right" class="tb_detail">ยา : </TD>
	<TD><INPUT ID="drug_code" TYPE="text" NAME="drug_code" onKeyPress="searchSuggest('drug',this.value,3); " onKeyDown="if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"></TD>

</TR>
<TR>

	<TD align="right" class="tb_detail">จำนวน : </TD>
	<TD><INPUT  ID="drug_amount" TYPE="text" NAME="drug_amount" onkeypress = "if(event.keyCode == 13){ checkForm1(); return false; }else{ check_number();}"  ></TD>
</TR>
<TR>
	<TD align="right" class="tb_detail">วิธีใช้ : </TD>
	<TD><INPUT ID="drug_slip" TYPE="text" NAME="drug_slip" onKeyPress="if(event.keyCode == 13){ checkForm1(); return false; }else{ searchSuggest('slip',this.value,2);} " onKeyDown="if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"></TD>
</TR>
<TR ID="drug_inject_amount"  style="display:none">
	<TD align="right" class="tb_detail" >จำนวนที่ฉีด : </TD>
	<TD><INPUT TYPE="text" NAME="drug_inject_amount" onkeypress = "if(event.keyCode == 13){ checkForm1(); return false; }"  size="15" value="1"></TD>
</TR>
<TR ID="drug_inject_slip" style="display:none">
	<TD align="right" class="tb_detail" id="">วิธีฉีด : </TD>
	<TD>
		<SELECT NAME="drug_inject_slip">
		<Option value="ฉีดวิธี:M">M</Option>
		<Option value="ฉีดวิธี:V">V</Option>	
			<Option value="ฉีดวิธี:SC">SC</Option>
			<Option value="ฉีดวิธี:A">A</Option>
			<Option value="">----</Option>
			
		</SELECT>
	</TD>
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
	<TD align="right" class="tb_detail">เหตุผล : </TD>
	<TD>
				<SELECT NAME="reason" onkeypress="if(event.keyCode == 13){ checkForm1(); return false; }">
					<Option value="ใช้ยาในบัญชียาหลักแห่งชาติแล้วไม่ดีขึ้น">ใช้ยาในบัญชียาหลักแล้วไม่ดีขึ้น</Option>
					<Option value="ไม่มียาในบัญชียาหลักแห่งชาติที่ใช้รักษาตามข้อบ่งชี้">ไม่มียาในบัญชียาหลักที่ใช้รักษาตามข้อบ่งชี้</Option>
					<Option value="แพ้ยาในบัญชียาหลักแห่งชาติ" >แพ้ยาในบัญชียาหลักแห่งชาติ</Option>
					<Option value="มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชียาหลักต่อไปได้">มีอาการข้างเคียงจนไม่สามารถใช้ยาในบัญชีได้</Option>
					<Option value="ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา(drug interaction)กับยาในบัญชียาหลักแห่งชาติ">ยาที่ผู้ป่วยต้องใช้ร่วมมีปัญหาอันตรกิริยา</Option>
					<Option value="ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน">ผู้ป่วยมีความเสียงสูงที่จะเกิดภาวะแทรกซ้อน</Option>
					<Option value="มีความจำเป็นที่ต้องใช้ยานอกบัญชียาหลักเพราะมีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย">มีรายงานทางการแพทย์สนับสนุนเพื่อประโยชน์ของผู้ป่วย</Option>
				</SELECT>
	</TD>
</TR>
<TR>
	<TD align="center" colspan="2"><INPUT id="form_submit" TYPE="submit" value="   ตกลง    " onClick="checkForm1();" onKeyPress="if(event.keyCode == 13) checkForm1(); return false;" onKeyDown="if(event.keyCode == 38){document.form1.drug_slip.focus();}">&nbsp;<INPUT TYPE="button" value="ยกเลิก" onClick="document.getElementById('drug_code').value='';document.getElementById('drug_amount').value='';document.getElementById('drug_slip').value='';document.getElementById('addoredit').value='E';">
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
	<TD  width="30"  valign="top">
	<Div id="list" style="left:240PX;top:80PX;position:absolute;"></Div>
		&nbsp;
	</TD>
	<TD valign="top"><Div id="druglist" ></Div>
	<?php 
	
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
			<td align=\"center\" >แพทย์ผู้ส่ง</td>
		</tr>";

			while(list($tradname, $drugcode, $amount, $unit ,$slcode) = mysql_fetch_row($result2)){

				list($detail1,  $detail2,  $detail3,  $detail4 ) = mysql_fetch_row(mysql_query("Select detail1 , detail2 , detail3 , detail4 From drugslip where slcode = '".$slcode."' limit 1 "));

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
</body>
</html>