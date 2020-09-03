<?php
session_start();
session_unregister("druglot");
session_unregister("druglot_new");
session_unregister("drugbill");
session_unregister("drughome");
session_unregister("drugstk");
session_unregister("total_stiker");

session_register("druglot");
session_register("druglot_new");
session_register("drugbill");
session_register("drughome");
session_register("drugstk");
session_register("total_stiker");

$_SESSION["druglot"] = "";
$_SESSION["druglot_new"] = "";
$_SESSION["drugbill"] = "";
$_SESSION["drughome"] = "";
$_SESSION["drugstk"] = "";

if(isset($_POST["Save_dgprofile"]) && $_POST["Save_dgprofile"] == "   จ่ายยา   " ){
	include("connect.inc");
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	
	$item = count($_POST["Drugcode"]);

	$cAccno = "1";
	$cDepart="PHAR";
	$_SESSION["drugbill"] = "
		<table width='650'>
		<tr>
		<td>#</td>
		<td>รหัส</td>
		<td>รายการ</td>
		<td>สถานะ</td>
		<td>วิธีใช้</td>
			<td></td>
			<td></td>
			<td></td>
		<td>จำนวน</td>
		<td>ราคา</td>
		<td>PART</td>
		</tr>
	";
	
	$_SESSION["drughome"] = "
<table style='font-size: 22px;font-family: Angsana New' bordercolor='#000000'  cellpadding='2' cellspacing='0' border='1' style='BORDER-COLLAPSE: collapse'>
		<tr align='center'>
			<td>#</td>
			<td>รหัส</td>
			<td>รายการ</td>
			<td>วิธีใช้</td>
		</tr>
			";

for($i=0;$i<$item;$i++){
	if($_POST["Amount"][$i] =="")
		$_POST["Amount"][$i] = 0;
}

//*********************************** หาราคารวมของยาแต่ละประเภท (Part) ********************************** 

$total_item = 0;
$item2=0;
	for($i=0;$i<$item;$i++){

		if($_POST["Amount"][$i] > 0){
			$item2++;
			
			if($_POST["Freepri"][$i] > $_POST["Salepri"][$i])
				$_POST["Freepri"][$i] = $_POST["Salepri"][$i];

			if($_POST["Part"] == "DPY" ){
				$pricetype["DPY"]= $pricetype["DPY"] + ($_POST["Freepri"][$i] * $_POST["Amount"][$i]); 
				$pricetype["DPN"]=$pricetype["DPN"] + (($_POST["Salepri"][$i] - $_POST["Freepri"][$i]) * $_POST["Amount"][$i]);

			}else if($_POST["Part"] == "DSY"){
				$pricetype["DSY"]= $pricetype["DSY"] + ($_POST["Freepri"][$i] * $_POST["Amount"][$i]); 
				$pricetype["DSN"]=$pricetype["DSN"] + (($_POST["Salepri"][$i] - $_POST["Freepri"][$i]) * $_POST["Amount"][$i]);
			}else{
				$pricetype[$_POST["Part"][$i]] = $pricetype[$_POST["Part"][$i]] + ($_POST["Salepri"][$i] * $_POST["Amount"][$i]);
				
			}

			$total_price = $total_price+ ($_POST["Salepri"][$i] * $_POST["Amount"][$i]);

			if($_POST["Drugcode"] != "INJ")
				$total_item++;
		}
	}
//*********************************** จบ หาราคารวมของยาแต่ละประเภท (Part) ********************************** 

			$netfree=$pricetype["DDL"]+$pricetype["DDY"]+$pricetype["DPY"]+$pricetype["DSY"];
			$netpay=$pricetype["DDN"]+ $pricetype["DSN"]+$pricetype["DPN"];
			$totalpay=$netfree+$netpay;

	$sql = "INSERT INTO phardep(chktranx,date,ptname,hn,an,price,doctor,item, idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright,accno)VALUES('".$_SESSION["nRunno"]."','".$Thidate."','".$_POST["Ptname"]."','".$_POST["Hn"]."','".$_POST["An"]."', '".$total_price."','".$_POST["Doctor"]."','".$item2."','".$_SESSION["sOfficer"]."','".$_POST["Diag"]."','".$pricetype["DDL"]."','".$pricetype["DDY"]."','".$pricetype["DDN"]."','".$pricetype["DPY"]."','".$pricetype["DPN"]."','".$pricetype["DSY"]."','".$pricetype["DSN"]."','".$_POST["Bedcode"]."','".$_POST["Ptright"]."','".$cAccno."');";
	//echo $sql;

	$result = Mysql_Query($sql) or die("ไม่สามารถบันทึกรายการได้ ท่านอาจเคยทำการบันทึกไปแล้ว");
	$idno=mysql_insert_id(); # ********** Cretae $idno ************

	$sql = "Update bed set last_drug = '".(date("Y")+543)."".date("-m-d H:i:s")."' where an = '".$_POST["An"]."' ";
	$result = Mysql_Query($sql);

	$j=1;
	$dlot = true;
	$dlot_new = true;

$i1=0;
$j1=35;
$k11=10;
$k21=$k11+180;
$k31=$k21+50;

	for($i=0;$i<$item;$i++){
		If (($_POST["Statcon"][$i] != "OLD" && $_POST["Amount"][$i] > 0) || $_POST["Statcon"][$i] == "OLD" ){
				
				if($_POST["Statcon"][$i] == "OLD")
					$_POST["Amount"][$i] = 0;
			#*************************************************** ตัดสต็อกยา ***************************************************
			$sql ="UPDATE druglst SET stock = stock-".$_POST["Amount"][$i].",rxaccum = rxaccum + ".$_POST["Amount"][$i].",rx1day   = rx1day +".$_POST["Amount"][$i].",totalstk = stock + mainstk WHERE drugcode= '".$_POST["Drugcode"][$i]."' ";
			$result = mysql_query($sql) or die("Query failed,update druglst in case of  IPD");
			#*************************************************** จบตัดสต็อกยา ***************************************************
		$sql = "Select stock,mainstk From druglst where drugcode = '".$_POST["Drugcode"][$i]."' limit 0,1 ";
		 $result = Mysql_Query($sql);
		 $arr = Mysql_fetch_assoc($result);
		 $stock = $arr["stock"];
		 $mainstk = $arr["mainstk"];
			#*************************************************** บันทึกการจ่ายยา ***************************************************

			if($_POST["Part"][$i] == "DPY"){
				$field_val = " ,'".($_POST["Freepri"][$i] * $_POST["Amount"][$i])."','".(($_POST["Salepri"][$i] - $_POST["Freepri"][$i])*$_POST["Amount"][$i])."' ";
			}else{
				$field_val = " ,Null, Null ";
			}
			
			if($_POST["Freepri"][$i] > $_POST["Salepri"][$i])
				$_POST["Freepri"][$i] = $_POST["Salepri"][$i];

			$dg_dpy = ($_POST["Freepri"][$i] * $_POST["Amount"][$i]);
			$dg_dpn = (($_POST["Salepri"][$i] - $_POST["Freepri"][$i])*$_POST["Amount"][$i]);

			$dg_dsy = ($_POST["Freepri"][$i] * $_POST["Amount"][$i]);
			$dg_dsn = (($_POST["Salepri"][$i] - $_POST["Freepri"][$i])*$_POST["Amount"][$i]);


			$sql = "INSERT INTO drugrx(date,hn,an,drugcode,tradname,amount,price,item,slcode,part,idno,statcon,DPY, DPN,stock,mainstk )VALUES('".$Thidate."','".$_POST["Hn"]."','".$_POST["An"]."','".$_POST["Drugcode"][$i]."','".$_POST["Tradname"][$i]."','".$_POST["Amount"][$i]."','".($_POST["Salepri"][$i] * $_POST["Amount"][$i])."','".$item2."','".$_POST["Slipcode"][$i]."','".$_POST["Part"][$i]."','".$idno."','".$_POST["Statcon"][$i]."' ".$field_val.",'$stock','$mainstk');";
			$result = mysql_query($sql) or die("Query failed,insert into drugrx");

			#*************************************************** จบบันทึกการจ่ายยา ***************************************************


			#*************************************************** บันทึกค่าใช้จ่ายคนไข้ใน ***************************************************

			If(substr($_POST["Part"][$i],0,2) != "DP"){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno, status,ptright)VALUES('".$Thidate."','".$_POST["An"]."','".$_POST["Drugcode"][$i]."','".$cDepart."','".$_POST["Tradname"][$i].",".$_POST["Slipcode"][$i]."', '".$_POST["Amount"][$i]."','".($_POST["Salepri"][$i] * $_POST["Amount"][$i])."','".$_POST["Part"][$i]."','".$_SESSION["sOfficer"]."','".$cAccno."','".$idno."','".$status."','".$_POST["Ptright"]."');";
                   $result = mysql_query($query) or die("insert into ipacc failed");
			}

			 If($_POST["Part"][$i]=="DPY"){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno , status,ptright)VALUES('".$Thidate."','".$_POST["An"]."','".$_POST["Drugcode"][$i]."','".$cDepart."','".$_POST["Tradname"][$i].",".$_POST["Slipcode"][$i]."', '$aAmount[$n]','".$dg_dpy."','DPY','".$_SESSION["sOfficer"]."','".$cAccno."','".$idno."','".$status."','".$_POST["Ptright"]."');";
                   $result = mysql_query($query) or die("insert into ipacc failed");

                   If ($dg_dpn > 0){
                                $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno , status,ptright )VALUES('".$Thidate."','".$_POST["An"]."','".$_POST["Drugcode"][$i]."','".$cDepart."','".$_POST["Tradname"][$i].",".$_POST["Slipcode"][$i]."', '','".$dg_dpn."','DPN','".$_SESSION["sOfficer"]."','".$cAccno."','".$idno."','".$status."','".$_POST["Ptright"]."');";
                                 $result = mysql_query($query) or die("insert into ipacc failed");
					}

			}

			 If($_POST["Part"][$i]=="DPN"){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno, status,ptright)VALUES('".$Thidate."','".$_POST["An"]."','".$_POST["Drugcode"][$i]."','".$cDepart."','".$_POST["Tradname"][$i].",".$_POST["Slipcode"][$i]."', '".$_POST["Amount"][$i]."','".$dg_dpn."','".$_POST["Part"][$i]."','".$_SESSION["sOfficer"]."','".$cAccno."','".$idno."','".$status."','".$_POST["Ptright"]."');";
                   $result = mysql_query($query) or die("insert into ipacc failed");
			}
			

			#*************************************************** จบบันทึกค่าใช้จ่ายคนไข้ใน ***************************************************
				$Trade = substr($_POST["Tradname"][$i],0,20);

				$_SESSION["drugbill"] .= "
					<tr><td>".$j."</td>
						<td><font face='Angsana New'>".$_POST["Drugcode"][$i]."</td>
						<td><font face='Angsana New'>".$Trade."</td>
						<td><font face='Angsana New'>".$_POST["Statcon"][$i]."</td>
						<td><font face='Angsana New'>".$_POST["Slipcode"][$i]."</td>";

					$sql = "Select date_format(date,'%d-%m-%Y') as date2, sum(amount) as samount From drugrx where hn='".$_POST["Hn"]."' AND drugcode = '".$_POST["Drugcode"][$i]."' AND date < '".(date("Y")+543).date("-m-d ")."00:00:00"."'  Group by date2 Order by row_id DESC LIMIT 3 ";
					$result = Mysql_Query($sql);
					$xk =0;
					$txt = "";
					while($arr = Mysql_fetch_assoc($result)){
						$txt = "<td align='center'><font face='Angsana New'>".substr($arr["date2"],0,-5)."<BR>".$arr["samount"]."</td>".$txt;
						$xk++;
					}

					while($xk <3){
						$txt = "<td></td>".$txt;
						$xk++;
					}

					$_SESSION["drugbill"] .= $txt;
					$_SESSION["drugbill"] .= "	<td  align=\"right\"><font face='Angsana New'>".$_POST["Amount"][$i]."&nbsp;</td>
						<td align=\"right\"><font face='Angsana New'>".($_POST["Salepri"][$i] * $_POST["Amount"][$i])."&nbsp;</td>
						<td align=\"center\"><font face='Angsana New'>".$_POST["Part"][$i]."</td>
					</tr>
					";

					if($j==8){
						$_SESSION["drugbill"] .= "<tr><td  colspan=\"11\"><div style=\"page-break-before: always;\"></div></td></tr>";
					}else if($j==14){
						$_SESSION["drugbill"] .= "<tr><td  colspan=\"11\"><div style=\"page-break-before: always;\"></div></td></tr>";
					}
				
				$_SESSION["drugstk"] .="
						<DIV style='left:".$k11."PX;top:".$j1."PX;width:306PX;height:30PX; position:absolute'>
						<font style=\"font-family:'MS Sans Serif'; font-size:12px\"> ".$_POST["Tradname"][$i]."&nbsp;(".$_POST["Unit"][$i].")
						</DIV>
						<DIV style='left:".$k21."px;top:".$j1."PX;width:306PX;height:30PX;position:absolute'>
						<font style=\"font-family:'MS Sans Serif'; font-size:12px\" >&nbsp;&nbsp;&nbsp;&nbsp;".$_POST["Slipcode"][$i]."
						</DIV>
						<DIV style='left:".$k31."px;top:".$j1."PX;width:306PX;height:30PX;position:absolute'>
						<font style=\"font-family:'MS Sans Serif'; font-size:12px\">&nbsp;".$_POST["Amount"][$i]."
						</DIV>
				
				";

				$i1++;
				$j1 = $j1+12;

				
				$sql = "Select detail1,  detail2,  detail3,  detail4 From drugslip where slcode = '".$_POST["Slipcode"][$i]."'  ";
				$result = Mysql_Query($sql);
				list($detail1,$detail2,$detail3,$detail4) = Mysql_fetch_row($result);

				$_SESSION["drughome"] .= "
					<tr><td>".$j."</td>
						<td><font face='Angsana New'>".$_POST["Drugcode"][$i]."</td>
						<td><font face='Angsana New'>".$_POST["Tradname"][$i]."</td>
						<td><font face='Angsana New'>".$detail1." ".$detail2." ".$detail3." ".$detail4."</td>
					</tr>
				";
				
				#******************************* Session ทำสลากยา ***************************************
				if($_POST["Drugcode"] != "INJ"  && isset($_SESSION["druglot"])){

					if($dlot == false){
						$_SESSION["druglot"] .= "<div style=\"page-break-before: always;\"></div>";
					}else{
						$dlot = false;
					}

					$_SESSION["druglot"] .= "<font style='line-height:12px;' face='Cordia UPC' size='1'><center>".$_POST["Ptname"]."<br></font>";

					$_SESSION["druglot"] .= "<font style='line-height:10px;' face='Angsana New' size='1'>".$Thaidate."&nbsp;(vn".$_POST["An"].")&nbsp;HN:".$_POST["Hn"].".&nbsp;&nbsp;NO.".$j."/".$total_item." <br></font>";
					
					$Trade = substr($_POST["Tradname"][$i],0,22);

					$_SESSION["druglot"] .= "<font  style='line-height:10px;' face='Angsana New' size='2'><b>$Trade</b></font>";

					$_SESSION["druglot"] .= "<font style='line-height:10px;' face='Angsana New' size='1'>&nbsp;&nbsp;(".$_POST["Drugcode"][$i].")</font>&nbsp;<font face='Angsana New' size='1'>=</font><font style='line-height:10px;' face='Angsana New' size='4'><B>&nbsp;".$_POST["Amount"][$i]."</B><br></font>";


						$sql = "Select drugnote From druglst  where drugcode = '".$_POST["Drugcode"][$i]."' limit 0,1 " ;
						$result = Mysql_Query($sql);
						list($drugnote) = Mysql_fetch_row($result);

					$_SESSION["druglot"] .= "<font style='line-height:16px;' face='Angsana New' size='3'><b>".$detail1."</b></font><br>";
					$_SESSION["druglot"] .= "<font style='line-height:16px;' face='Angsana New' size='3'><b>".$detail2."</b></font><br>";
					
					if($j == $total_item){
						$_SESSION["druglot"] .= "<font style='line-height:16px;' face='Angsana New' size='3'><b>".$detail3."</b></font><br>";
						if($drugnote !="")
							$_SESSION["druglot"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><u><b>".$drugnote."</u></b></font>";
					}else{
						$_SESSION["druglot"] .= "<font style='line-height:16px;' face='Angsana New' size='3'><b>".$detail3."</b></font><br>";
						if($drugnote !="")
							$_SESSION["druglot"] .= "<font style='line-height:12px;' face='Angsana New' size='2'><u><b>".$drugnote."</u></b></font>";
					}
					//$_SESSION["druglot"] .= "<font face='Angsana New' >".$detail4."<br><br><BR></font>";
				}
				#******************************* จบ Session ทำสลากยา ***************************************
				
				
				#******************************* Session ทำสลากยาใหม่ ***************************************
				if($_POST["Drugcode"] != "INJ" && isset($_SESSION["druglot_new"])){
					
					if($dlot_new == false){
						$_SESSION["druglot_new"] .= "<div style=\"page-break-before: always;\"></div>";
					}else{
						$dlot_new = false;
					}

					$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='2'><center><b>".$_POST["Ptname"]."</b><br></font>";

					$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'>".$Thaidate."&nbsp;(AN:".$_POST["An"].")&nbsp;HN:".$_POST["Hn"].".&nbsp;&nbsp;NO.".$j."/".$total_item." <br></font>";
					
					$Trade = substr($_POST["Tradname"][$i],0,22);

					$_SESSION["druglot_new"] .= "<font  style='line-height:14px;' face='Angsana New' size='2'><b>$Trade</b>&nbsp;&nbsp;(".$_POST["Drugcode"][$i].")&nbsp;=<B>&nbsp;".$_POST["Amount"][$i]."</B><br></font>";


						$sql = "Select drugname,drugnote,drug_nature,drug_properties From druglst  where drugcode = '".$_POST["Drugcode"][$i]."' limit 0,1 " ;
						$result = Mysql_Query($sql);
						list($drugname,$drugnote,$drug_nature,$drug_properties) = Mysql_fetch_row($result);
						$chkdrugname=trim($drugname);
						$lendrugname=strlen($chkdrugname);
					$_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>".$detail1."</b></font><br>";
					$_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>".$detail2."</b></font><br>";
					
					if($j == $total_item){
						if($detail3 !="")
							$_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>".$detail3."</b></font><br>";
						if($drug_properties !="")  //ถ้ามีสรรพคุณ
							$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b><u>".$drug_properties."</u></b></font><br>";
						
						if($drugnote !="")  //ถ้ามีคำเตือน
							$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b>".$drugnote."</b></font>";
						
					}else{
							if($detail3 !="")
							$_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>".$detail3."</b></font><br>";  //br 2 อัน
						if($drug_properties !="")  //ถ้ามีสรรพคุณ
							$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b><u>".$drug_properties."</u></b></font><br>";														
						if($drugnote !="")  //ถ้ามีคำเตือน
							$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b>".$drugnote."</b></font>";  
					}
					//$_SESSION["druglot_new"] .= "<font face='Angsana New' >".$detail4."<br><br><BR></font>";
				}
				#******************************* จบ Session ทำสลากยาใหม่ ***************************************
				
			

		$j++;
		}# end if
	}# end for
	

for($i=0;$i<$item;$i++){
	
	$drugcode2 = $_POST["Drugcode"][$i];
	if(($drugcode2[0] == "0" || $drugcode2[0] == "2") && !(ord($drugcode2[1])  >= 48 && ord($drugcode2[1]) <= 57 )){
		
		for($j=0;$j<$_POST["stiker"][$i];$j++){
			if($j%2 == 0){
				$_SESSION["druglot"] .= "<div style=\"page-break-before: always;\"></div>";
			}else{
				$_SESSION["druglot"] .= "<hr>";
			}
			$_SESSION["druglot"] .= "<font style='line-height:14px;' face='Angsana New' size='2'><B>".$Thaidate."<BR>".$_POST["Hn"]."  ".$_POST["Ptname"]." เตียง".$_POST["Bed"]."  <br>".$_POST["Tradname"][$i]."&nbsp;&nbsp;(".$_POST["Drugcode"][$i].")</B></font>";

		}
	}
}

for($i=0;$i<$item;$i++){
	
	$drugcode2 = $_POST["Drugcode"][$i];
	if(($drugcode2[0] == "0" || $drugcode2[0] == "2") && !(ord($drugcode2[1])  >= 48 && ord($drugcode2[1]) <= 57 )){
		
		for($j=0;$j<$_POST["stiker"][$i];$j++){
			if($j%2 == 0){
				$_SESSION["druglot_new"] .= "<div style=\"page-break-before: always;\"></div>";
			}else{
				$_SESSION["druglot_new"] .= "<hr>";
			}
			$_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='2'><B>".$Thaidate."<BR>".$_POST["Hn"]."  ".$_POST["Ptname"]." เตียง".$_POST["Bed"]."  <br>".$_POST["Tradname"][$i]."&nbsp;&nbsp;(".$_POST["Drugcode"][$i].")</B></font>";

		}
	}
}

		$_SESSION["drugbill"] .= "</table>";
		
		$arr_drugreact=array();
		$sql = "Select drugcode, tradname  From drugreact where hn='".$_POST["Hn"]."' ";
				$result = Mysql_Query($sql);
				if(Mysql_num_rows($result) > 0){
					while($arr = Mysql_fetch_assoc($result)){
							array_push($arr_drugreact,"".$arr["drugcode"]."&nbsp;,&nbsp;".$arr["tradname"].""); 
					}
				}else{
					array_push($arr_drugreact,"ไม่มีรายการแพ้ยา"); 
				}
					

		$_SESSION["drughome"] .= "</table>
		แพ้ยา : ".(implode(" | ",$arr_drugreact))."
	<BR>เอกสารนี้เป็นเอกสารสรุปรายการยาที่ผู้ป่วยใช้ต่อเนื่อง
	<BR>เพื่อประโยชน์ของผู้ป่วยควรนำเอกสารนี้มาด้วยทุกครั้งที่มาใช้บริการที่โรงพยาบาลหรือสถานบริการสุขภาพทุกแห่ง
	</TD>
</TR>
</TABLE>
";
		

		$_SESSION["drughome"] = "
		
		<TABLE width='650' style='font-size: 22px;font-family: Angsana New'>
<TR>
	<TD>
<CENTER><B>รายการยาที่ผู้ป่วยได้รับกลับบ้าน โรงพยาบาลค่ายสุรศักดิ์มนตรี</B></CENTER><BR>
<B>ชื่อ :</B> ".$_POST["Ptname"]." <B>อายุ :</B> ".$_POST["age"]." <B>HN : </B>".$_POST["Hn"]." <B>AN : </B>".$_POST["An"]." <B>หอผู้ป่วย : </B>".$_POST["Ward"]." <BR>
<B>วันที่ :</B> ".$Thaidate." <B>สิทธิ : </B>".$_POST["Ptright"]." <B>โรค :</B> ".$_POST["Diag"]." <B>แพทย์ :</B> ".$_POST["Doctor"]." <BR>".$_SESSION["drughome"];

		$_SESSION["drugbill"] .="ราคารวม  ".number_format($totalpay,strlen(strstr($totalpay,"."))-1, '.', ',')." บาท(เบิกไม่ได้ ".number_format($netpay,strlen(strstr($netpay,"."))-1, '.', ',')." บาท , เบิกได้ ".number_format($netfree,strlen(strstr($netfree,"."))-1, '.', ',')." บาท)<br><BR> ";
		
		$sql = "Select drugcode, tradname  From drugreact where hn='".$_POST["Hn"]."' ";
				$result = Mysql_Query($sql);
				if(Mysql_num_rows($result) > 0){
					$_SESSION["drugbill"] .="<Table><tr><td colspan=\"2\">รายการแพ้ยา</td></tr>";
					while($arr = Mysql_fetch_assoc($result)){
							$_SESSION["drugbill"] .="<tr><td>".$arr["drugcode"]."&nbsp;&nbsp;</td><td>&nbsp;&nbsp;".$arr["tradname"]."</td></tr>";
					}
					$_SESSION["drugbill"] .="</Table><BR>";
				}

		$_SESSION["drugbill"] .="ผู้บันทึกข้อมูล <U>".$_SESSION["sOfficer"]."</U>&nbsp;&nbsp;";
		$_SESSION["drugbill"] .="ผู้คิดราคา....................&nbsp;&nbsp;";
		$_SESSION["drugbill"] .="ผู้ตรวจสอบ.................&nbsp;&nbsp;";
		$_SESSION["drugbill"] .="ผู้จัดยา.....................&nbsp;&nbsp;";		
		$_SESSION["drugbill"] .="ผู้จ่ายยา....................&nbsp;&nbsp;";
		$_SESSION["drugbill"] .="ผู้รับยา.....................";
		
		$_SESSION["drugbill"] = "<BR>&nbsp;&nbsp;<font face='Angsana New'>$status, วันที่ ".$Thaidate."<BR>&nbsp;&nbsp;".$_POST["Ward"].", เตียง : ".$_POST["Bed"].", ".$_POST["Ptname"].", อายุ ".$_POST["age"].", HN:".$_POST["Hn"].", AN:".$_POST["An"]."<BR>&nbsp;&nbsp;สิทธิ:".$_POST["Ptright"].", แพทย์ : ".$_POST["Doctor"].", โรค ".$_POST["Diag"]."<BR>".$_SESSION["drugbill"];
		
		$_SESSION["drugstk"] = "<font style=\"font-family:'MS Sans Serif'; font-size:10px\"  >&nbsp;&nbsp;&nbsp&nbsp;".$Thaidate.";&nbsp;&nbsp;HN:".$_POST["Hn"].", &nbsp;&nbsp;AN:".$_POST["An"]."<br>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;".$_POST["Ptname"]."&nbsp;&nbsp;โรค ".$_POST["Diag"]."<BR>".$_SESSION["drugstk"];




		echo "บันทึกข้อมูลเรียบร้อยแล้ว<BR>
			<A HREF=\"drugbill.php\" target=\"_blank\">พิมพ์ใบสั่งยา</A>&nbsp;&nbsp;<A HREF=\"druglot.php\" target=\"_blank\">พิมพ์สลากยา</A>&nbsp;&nbsp;<A HREF=\"druglot_new.php\" target=\"_blank\">พิมพ์สลากยาใหม่</A>
		";

		echo "<BR><A HREF=\"drughome.php\" target=\"_blank\">พิมพ์ใบกลับบ้าน</A>&nbsp;&nbsp;<A HREF=\"drugstk.php\" target=\"_blank\">ติด OPD</A>";


		echo "
		
			<SCRIPT LANGUAGE=\"JavaScript\">

				window.opener.location.href='enddrugprofile.php';
				//window.open('druglot.php','_blank');

			</SCRIPT>
		
		";
	//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=",$_SERVER["php_self"],"\">";

exit();

include("unconnect.inc");
}

?>