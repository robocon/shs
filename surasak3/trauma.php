<?php
session_start();
if(isset($_GET["action"]) && $_GET["action"] != "edit" && $_GET["action"] != "del"){
	header("content-type: application/x-javascript; charset=TIS-620");
}
	 include("connect.inc");

if(!isset($_SESSION["undo_organ"])){
	session_register("undo_organ");
}

if(isset($_SESSION["undo_maintenance"])){
	session_register("undo_maintenance");
}

session_register("report_trauma_word");
session_register("name_trauma_word");

$_SESSION["report_trauma_word"] = "";
$_SESSION["name_trauma_word"] = "";

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
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

/********************************************* AJAX *********************************************************************/
	 if(isset($_GET["action"]) && $_GET["action"] =="view"){
		//header("content-type: application/x-javascript; charset=TIS-620");

		$sql = "Select idcard,hn,yot, name, surname, dbirth, ptright, ptffone, phone, sex From opcard where hn='".$_GET["hn"]."' limit 1";
		$result = Mysql_Query($sql) or die(mysql_error());
		$arr = Mysql_fetch_assoc($result);

		switch($arr["sex"]){
			case 'ช': $sex = "ชาย"; break;
			case 'ญ': $sex = "หญิง"; break;
			default : $sex = "<FONT COLOR='#FF000000'><B>ไม่ได้ลงข้อมูล</B></FONT>"; break;
		}
		
		if($arr['idcard']=="" || $arr['idcard']=="-"){
		$img=$arr['hn'].'.jpg';
		}else{
		$img=$arr['idcard'].'.jpg';
		}
		if(file_exists("../image_patient/$img")){
		
		$image="<IMG SRC='../image_patient/$img' WIDTH='100' HEIGHT='150' BORDER='1' ALT=''><BR>";
	}else{
		$image="";
	}

		echo $arr["yot"]." ".$arr["name"]." ".$arr["surname"]."  อายุ : ".calcage($arr["dbirth"])." เพศ : ".$sex."  <BR>สิทธิ์ : ".$arr["ptright"]."  tel : ".$arr["phone"]."&nbsp;ผู้เกี่ยวข้อง : ".$arr["ptffone"]."<BR><center>$image</center><A HREF=\"consent4.php?hn=".urlencode($_GET["hn"])."\" target=\"_blank\">ออกใบยินยอม</A>";
		exit();
	}
	
	if(isset($_GET["action"]) && $_GET["action"] =="checksom"){
		//header("content-type: application/x-javascript; charset=TIS-620");
			
		$sql = "Select hn, date_format(date,'%d/%m/%Y %H:%m:%s') as datetime2  From trauma where hn='".$_GET["hn"]."' AND date_in = '".$_GET["date_in"]."'  limit 1";
		$result = Mysql_Query($sql) or die(mysql_error());
		$arr = Mysql_fetch_assoc($result);
		$rows = Mysql_num_rows($result);
		if($rows > 0)
			echo "ท่านเคยบันทึก HN : ".$arr["hn"]." เมื่อวันเวลา ".$arr["datetime2"]." \n ท่านต้องการบันทึก HN นี้อีกครั้งหรือไม่?";
		else
			echo "";
		
		exit();
	}
	

	if(isset($_GET["action"]) && $_GET["action"] =="drugreact"){
		//header("content-type: application/x-javascript; charset=TIS-620");

		$sql = "Select tradname, advreact  From drugreact where hn='".$_GET["hn"]."' ";
		$result = Mysql_Query($sql) or die(mysql_error());
		while($arr = Mysql_fetch_assoc($result)){
			echo "แพ้ยา".$arr["tradname"]." อาการ ".$arr["advreact"]." \n";
		}
		exit();
	}

	
	if(isset($_GET["action"]) && $_GET["action"] =="congenital_disease"){
		//header("content-type: application/x-javascript; charset=TIS-620");

		$sql = "Select congenital_disease  From opcard where hn='".$_GET["hn"]."' limit 1";
		$result = Mysql_Query($sql) or die(mysql_error());
		while($arr = Mysql_fetch_assoc($result)){
			echo $arr["congenital_disease"];
		}
		exit();
	}

	if(isset($_GET["action"]) && $_GET["action"] =="organ"){
			//header("content-type: application/x-javascript; charset=TIS-620");
	
			$sql = "Select thidate, organ  From opd where hn='".$_GET["hn"]."' Order by row_id DESC limit 1";
			$result = Mysql_Query($sql) or die(mysql_error());
			$row = mysql_num_rows($result);
			$arr = Mysql_fetch_assoc($result);

			$sql = "Select date, organ From trauma where hn = '".$_GET["hn"]."' Order by row_id DESC limit 1";
			$result = mysql_query($sql);
			$row2 = mysql_num_rows($result);
			$arr2 = mysql_fetch_assoc($result);
			if($row ==0 && $row2 != 0){
				echo $arr2["organ"];
			}else if($row !=0 && $row2 == 0){
				echo $arr["organ"];
			}else	if($arr2["date"] >= $arr2["thidate"]){
				echo $arr2["organ"];
			}else{
				echo $arr["organ"];
			}

			exit();
	}
		if(isset($_GET["action"]) && $_GET["action"] =="disease_people"){
			//header("content-type: application/x-javascript; charset=TIS-620");
	
			$sql = "Select congenital_disease  From opd where hn='".$_GET["hn"]."' Order by row_id DESC limit 1";
			$result = Mysql_Query($sql) or die(mysql_error());
			$arr = Mysql_fetch_assoc($result);
		
			
			if($arr["congenital_disease"] == "ปฎิเสธ" || $arr["congenital_disease"] == "ปฎิเสธโรคประจำตัว"){
				
				$sql = "Select disease_people From trauma where hn='".$_GET["hn"]."' AND disease_people not in ('','ปฏิเสธ','ปฏิเธ','ปฎิเสธ') Order by row_id limit 1";
				$result = mysql_query($sql);
				$rows = mysql_num_rows($result);
				if($rows > 0){
					list($disease_people) = mysql_fetch_row($result);
					echo $disease_people;
				}else{
					echo "ปฎิเสธ";
				}


			}else{
				echo $arr["congenital_disease"];
			}
			
			exit();
	}
		if(isset($_GET["action"]) && $_GET["action"] =="confirm_inj"){
		//header("content-type: application/x-javascript; charset=TIS-620");
		
		$sql = "Select CONCAT(yot,' ',name,' ',surname) as full_name, ptright, dbirth From opcard where hn = '".$_GET["hn"]."' limit 1 ";
		list($ptname,$ptright, $dbirth) = Mysql_fetch_row(Mysql_Query($sql));

		echo "<TABLE  width=\"100%\"  border=\"1\" bordercolor=\"#3366FF\">
					<TR>
						<TD>
							<table width=\"100%\" border=\"0\" align=\"center\">
						  <tr align=\"center\" bgcolor=\"#3366FF\" class=\"font_title\">
							<td >ยืนยันการฉีดยา</td>
						  </tr>
						  <tr>
							<td >";

							if($ptname != ""){
								echo "HN : ".$_GET["hn"]."<BR>";
								echo "ชื่อ-สกุล : ".$ptname."<BR>";
								echo "สิทธิ์ : ".$ptright."<BR>";
		
		$sql = "CREATE TEMPORARY TABLE drugrx_now  Select  right(date,8) as time2, date,  slcode, tradname, drugcode, drug_inject_slip, drug_inject_amount, drug_inject_type, drug_inject_etc, row_id, amount From drugrx  where date like '".((date("Y")+543).date("-m-d"))."%' AND hn = '".$_GET["hn"]."' AND left(drugcode,1) in ('2','0')  AND right(left(drugcode,2),1) not in ('0','1','2','3','4','5','6','7','8','9') AND drugcode not in ('2SYNV*@','2GOON','2HYRU') AND (an is null OR an = '' ) ";
		$result = Mysql_Query($sql) or die(Mysql_Error());

		$sql = "Select date ,  slcode, tradname, drugcode, drug_inject_slip, drug_inject_amount, drug_inject_type, drug_inject_etc, row_id, amount From drugrx_now group by drugcode, slcode Having sum(amount) > 0 ";
		//echo $sql;
		
		$result = Mysql_Query($sql) or die(Mysql_Error());
		while(list(   $date,  $slcode, $tradname, $drugcode, $drug_inject_slip, $drug_inject_amount, $drug_inject_type, $drug_inject_etc, $row_id, $amount) = Mysql_fetch_row($result)){
			
			$IV="";
			$IM="";
			$SC="";
			$drug_inject_slip = substr($drug_inject_slip,8);
			switch($drug_inject_slip){
				case "IV": $IV="Selected"; break;
				case "IM": $IM="Selected"; break;
				case "V": $IV="Selected"; break;
				case "M": $IM="Selected"; break;
				case "SC": $SC="Selected"; break;
			}
			
			echo "<B>ยา </B>".$tradname;

			echo "&nbsp;&nbsp;<B>เข็มที่</B> 
						<SELECT NAME=\"number[]\">
							<Option value=\"1\" >1</Option>
							<Option value=\"2\" >2</Option>
							<Option value=\"3\" >3</Option>
							<Option value=\"4\" >4</Option>
							<Option value=\"5\" >5</Option>
						</SELECT>
							";

			echo "&nbsp;&nbsp;<B>วิธีฉีด</B> 
						<SELECT NAME=\"type[]\">
							<Option value=\"V\" ".$IV.">V</Option>
							<Option value=\"M\" ".$IM.">M</Option>
							<Option value=\"SC\" ".$SC.">SC</Option>
							<Option value=\"NO\" >ไม่นับ</Option>
						</SELECT>
						";
			echo "<BR><BR>";

			$sql = "Select unit From druglst where drugcode = '".$drugcode."' limit 1 ";
			list($unit) = mysql_fetch_row(mysql_query($sql));

			echo "&nbsp;&nbsp;<B>จำนวนที่ฉีด</B> : ".$drug_inject_amount;
			echo "&nbsp;&nbsp;<B>ฉีดแบบ</B> : ".$drug_inject_type;
			echo "&nbsp;&nbsp;<B>จำนวนที่สั่ง</B> : ".$amount." ".$unit;
			echo "&nbsp;&nbsp;<B>อื่นๆ</B> : ".$drug_inject_etc;
			echo "<HR><BR><INPUT TYPE=\"hidden\" value=\"".$date."\" name=\"date[]\">";
			
			echo "<INPUT TYPE=\"hidden\" value=\"".$drugcode."\" name=\"drugcode[]\">";
			echo "<INPUT TYPE=\"hidden\" value=\"".$tradname."\" name=\"tradname[]\">";

		}
		echo "<INPUT TYPE=\"hidden\" value=\"".$_GET["hn"]."\" name=\"hn\">";
		echo "<INPUT TYPE=\"hidden\" value=\"".$ptname."\" name=\"ptname\">";
		echo "<INPUT TYPE=\"hidden\" value=\"".$dbirth."\" name=\"dbirth\">";
		echo "<INPUT TYPE=\"hidden\" value=\"".$ptright."\" name=\"ptright\">";

		if($_SESSION['smenucode']=="ADMMAINOPD")
		{
			?>
			<label for="isOpd">
				<input type="checkbox" name="isOpd" id="isOpd" value="1" checked="checked"> OPDฉีดยา 
			</label>
			<?php
		}
		
		$submit_button = "<INPUT TYPE=\"submit\" value=\" ตกลง \" >";
		}else{
								echo "ไม่มีหมายเลข HN : ".$_GET["hn"]."";
								$submit_button = "";
		}
		echo "
							</td>
						  </tr>
						  <tr>
							<td >
							".$submit_button."&nbsp;<INPUT TYPE=\"button\" value=\"ยกเลิก\" onclick=\"view_confirm_inj('reconfirm_inj',document.form_confirn_inject.hn.value);\">
							</td>
						  </tr>
						  </table>
						  </TD>
					</TR>
					</TABLE>
					<INPUT TYPE=\"hidden\" name=\"hn\" value=\"".$_GET["hn"]."\">
		";
		exit();
	}

	if(isset($_GET["action"]) && $_GET["action"] =="confirm_ds"){
		//header("content-type: application/x-javascript; charset=TIS-620");
		
		$sql = "Select CONCAT(yot,' ',name,' ',surname) as full_name, ptright, dbirth From opcard where hn = '".$_GET["hn"]."' limit 1 ";
		list($ptname,$ptright, $dbirth) = Mysql_fetch_row(Mysql_Query($sql));

		echo "<TABLE  width=\"100%\"  border=\"1\" bordercolor=\"#3366FF\">
					<TR>
						<TD>
							<table width=\"100%\" border=\"0\" align=\"center\">
						  <tr align=\"center\" bgcolor=\"#3366FF\" class=\"font_title\">
							<td >ยืนยันการทำแผล</td>
						  </tr>
						  <tr>
							<td >";

							if($ptname != ""){
								echo "HN : ".$_GET["hn"]."<BR>";
								echo "ชื่อ-สกุล : ".$ptname."<BR>";
								echo "สิทธิ์ : ".$ptright."<br>";
								if($_SESSION['smenucode']=="ADMMAINOPD")
								{
									?>
									<label for="isOpd">
										<input type="checkbox" name="isOpd" id="isOpd" value="1" checked="checked"> OPDทำแผล
									</label>
									<br>
									<?php
								}
								$submit_button = "<INPUT TYPE=\"submit\" value=\" ตกลง \" >";
							}else{
								echo "ไม่มีหมายเลข HN : ".$_GET["hn"]."";
								$submit_button = "";
							}

			echo "
							</td>
						  </tr>
						  <tr>
							<td >
							".$submit_button."&nbsp;<INPUT TYPE=\"button\" value=\"ยกเลิก\" onclick=\"view_confirm_ds('reconfirm_ds',document.form_confirn_ds.hn.value);\">
							</td>
						  </tr>
						  </table>
						  </TD>
					</TR>
					</TABLE>
					<INPUT TYPE=\"hidden\" name=\"hn\" value=\"".$_GET["hn"]."\">
		";
		exit();
	}

if(isset($_GET["action"]) && $_GET["action"] =="reconfirm_inj"){
		//header("content-type: application/x-javascript; charset=TIS-620");
		


		echo "<TABLE  width=\"100%\"  border=\"1\" bordercolor=\"#3366FF\">
					<TR>
						<TD>
							<table width=\"100%\" border=\"0\" align=\"center\">
						  <tr align=\"center\" bgcolor=\"#3366FF\" class=\"font_title\">
							<td >ยืนยันการฉีดยา</td>
						  </tr>
						  <tr>
							<td >
								HN : <INPUT TYPE=\"text\" NAME=\"hn\" id=\"form_confirn_inject_hn\">
							</td>
						  </tr>
						  <tr>
							<td >
							<INPUT TYPE=\"button\" value=\" ตกลง \" onclick=\"view_confirm_inj('confirm_inj',document.getElementById('form_confirn_inject_hn').value);\">
							</td>
						  </tr>
						  </table>
						  </TD>
					</TR>
					</TABLE>
		";
		exit();
	}

	if(isset($_GET["action"]) && $_GET["action"] =="reconfirm_ds"){
		//header("content-type: application/x-javascript; charset=TIS-620");
		
		echo "<TABLE  width=\"100%\"  border=\"1\" bordercolor=\"#3366FF\">
					<TR>
						<TD>
							<table width=\"100%\" border=\"0\" align=\"center\">
						  <tr align=\"center\" bgcolor=\"#3366FF\" class=\"font_title\">
							<td >ยืนยันการทำแผล</td>
						  </tr>
						  <tr>
							<td >
								HN : <INPUT TYPE=\"text\" NAME=\"hn\">
							</td>
						  </tr>
						  <tr>
							<td >
							<INPUT TYPE=\"button\" value=\" ตกลง \" onclick=\"view_confirm_ds('confirm_ds',document.form_confirn_ds.hn.value);\">
							</td>
						  </tr>
						  </table>
						  </TD>
					</TR>
					</TABLE>
		";
		exit();
	}

	if(isset($_GET["action"]) && $_GET["action"] =="view_expenses"){
		//header("content-type: application/x-javascript; charset=TIS-620");
			
			$sql = "SELECT an FROM ipcard WHERE an = '".$_GET["an"]."' limit  1 ";
			$result = mysql_query($sql) or die("Query failed");
			if(Mysql_num_rows($result) > 0){
				echo "ipaccount.php?an=".$an;
			}else{
				echo "";
			}

		exit();
	}
	
	/** If not json **/
	if( !function_exists('json_encode') ){
		function json_encode($items, $test = false){
			
			$new_items = array();
			foreach( $items as $key => $item){
				$new_items[] = '"'.$key.'":'.real_type($item);
			}
			$final = '{'.implode(',', $new_items).'}';
			return $final;
		}
	}
	
	function real_type($item){
		$type = gettype($item);
		if( $type === 'integer' ){
			$item = intval($item);
		} /*else if( $type === 'NULL' ){
			$item = 'NULL';
		}*/ else {
			$item = '"'.$item.'"';
		}
		return $item;
	}
	/** If not json **/
	
	if( isset($_GET['action']) && $_GET['action'] === 'get_hn_an' ){
		
		$hn = $_GET['hn'];
		$date = ( date('Y') + 543 ).'-'.date('m-d');
		$sql = "
		SELECT a.`hn`,a.`vn`,b.`an`
		FROM `opday` AS a 
		LEFT JOIN (
			SELECT `hn`,`an`,`date` FROM `ipcard` WHERE `hn` = '$hn' AND `date` LIKE '$date%'
		)
		AS b ON b.`hn` = a.`hn`
		WHERE a.`hn` = '$hn' 
		AND a.`thidate` LIKE '$date%' 
		";
		
		$query = mysql_query($sql);
		$item = mysql_fetch_assoc($query);
		
		$data = array( 'status' => 500 );
		if( $item !== false ){
			$data = array(
				'hn' => $hn,
				'vn' => $item['vn'],
				'an' => $item['an'],
				'status' => 200
			);
		}
		
		echo json_encode($data);
		exit(0);
	}
/********************************************* END AJAX *********************************************************************/

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
	$str = trim($str);
    return $str;
}

	if(isset($_POST["submit"]) && $_POST["submit"] == "เพิ่มข้อมูล"){

	include("class_file/class_refer.php");
	$obj = New refer();

		$thaidate = (date("Y")+543).date("-m-d H:i:s");
		
		if($_POST["trauma"] != "trauma"){
				
				$_POST["type_accident"] = "";
				$_POST["wounded_vehicle"] = "";
				$_POST["wounded_detail"] = "";
				$_POST["cause_accident"] = "";
				$_POST["with_cause_accident"] = "";
				$_POST["list_with_cause_accident"] = "";
				
				$_POST["spirits"] = "";
				$_POST["belt"] = "";
				$_POST["helmet"] = "";
				$_POST["accident_detail"] = "";

		}else{

			if($_POST["type_accident"] == "1"){
				$_POST["accident_detail"] = "";
			}else{
				$_POST["wounded_vehicle"] = "";
				$_POST["wounded_detail"] = "";
				$_POST["cause_accident"] = "";
				$_POST["with_cause_accident"] = "";
				$_POST["list_with_cause_accident"] = "";

			}
		}
		
		if($_POST["cure"] != "admit"){
			$_POST["admit_ward"] = "";
		}

		if($_POST["cure"] != "d/c"){
			$_POST["to_hpt_lp"] = "";
		}

		if($_POST["list_ptright2"] == "P01"){
			$_POST["list_ptright2"] = "";
		}

		if($_POST["cure"] != "refer"){
			$_POST["refer_hospital"] = "";
			$_POST["cause_refer"] = "";
			$_POST["type_patient"] = "";
			$_POST["means_refer"] = "";
			$_POST["take_care"] = "";
			$_POST["doc_refer"] = "";
			$_POST["nurse"] = "";
			$_POST["assistant_nurse"] = "";
			$_POST["estimate"] = "";
			$_POST["no_estimate"] = "";
			$_POST["cradle"] = "";
			$_POST["doc_txt"] = "";
			$_POST["consult"] = "";
			$_POST["er_tell"] = "";
			$_POST["problem_refer"] = "";
			$_POST["suggestion"] = "";
			$_POST["targe"] = "";
		}





		$sql = "Select dbirth From opcard where hn = '".$_POST["hn"]."' limit 1";
		list($dbirth) = Mysql_fetch_row(Mysql_Query($sql));

		$_POST["time_diag1"] = sprintf("%04d", $_POST["time_diag1"]);
		$_POST["time_in1"] = sprintf("%04d", $_POST["time_in1"]);
		$_POST["time_out1"] = sprintf("%04d", $_POST["time_out1"]);

		$time_diag = substr($_POST["time_diag1"],0,2).":".substr($_POST["time_diag1"],-2).":00";
		$time_in = substr($_POST["time_in1"],0,2).":".substr($_POST["time_in1"],-2).":00";
		$time_out = substr($_POST["time_out1"],0,2).":".substr($_POST["time_out1"],-2).":00";

$_SESSION["undo_organ"] = jschars($_POST["organ"]);
$_SESSION["undo_maintenance"] = jschars($_POST["maintenance"]);

		$freshWound = isset($_POST['freshWound']) ? (int)$_POST['freshWound'] : 'NULL' ;
		$woundhours = isset($_POST['woundhours']) ? (int)$_POST['woundhours'] : 'NULL' ;
		$_POST["no_estimate"] = isset($_POST['no_estimate']) ? (int)$_POST['no_estimate'] : 'NULL' ;

		$sql ="INSERT INTO `trauma` (  `date` , `vn` , `hn` , `an`, `age` , `list_ptright` , `list_ptright2` , `disease_people` , `drug_alert` , `dx`, `organ`, `maintenance`, `doctor`,  `type_accident` , `wounded_vehicle` , `wounded_detail` , `cause_accident` , `spirits` , `belt` , `helmet` , `sender` , `als_sender` , `cure`,  `time_diag` , `time_in` , `time_out`, `officer`, `trauma`, `obs`, `type_wounded`, `type_wounded2`, `accident_detail`, `date_in`,`etc_sender`, `with_cause_accident`, `list_with_cause_accident`, `admit_ward`, `refer_hospital`, `repeat`, `cause_refer`, `type_patient`, `means_refer`, `take_care`,`doc_refer`, `nurse`, `assistant_nurse`, `estimate`, `no_estimate`, `cradle`, `doc_txt`, `consult`, `to_or`, `to_lr`, `to_etc`, `er_tell`, `problem_refer`, `suggestion`, `to_hpt_lp`, `out_changwat` ,`fresh_wound`,`wound_hours`, `weight` ,`height`,`bmi`) VALUES ('".$thaidate."', '".$_POST["vn"]."', '".$_POST["hn"]."', '".$_POST["an"]."', '".calcage($dbirth)."', '".$_POST["list_ptright"]."', '".$_POST["list_ptright2"]."', '".jschars($_POST["disease_people"])."', '".jschars($_POST["drug_alert"])."', '".jschars($_POST["dx"])."', '".jschars($_POST["organ"])."', '".jschars($_POST["maintenance"])."', '".$_POST["doctor"]."', '".$_POST["type_accident"]."', '".$_POST["wounded_vehicle"]."', '".$_POST["wounded_detail"]."', '".$_POST["cause_accident"]."', '".$_POST["spirits"]."', '".$_POST["belt"]."', '".$_POST["helmet"]."', '".$_POST["sender"]."', '".$_POST["als_sender"]."', '".$_POST["cure"]."', '".$time_diag."', '".$time_in."', '".$time_out."', '".$_SESSION["sOfficer"]."', '".$_POST["trauma"]."', '".$_POST["obs"]."', '".$_POST["type_wounded"]."', '".$_POST["type_wounded2"]."', '".$_POST["accident_detail"]."','".$_POST["date_in"]."','".$_POST["etc_sender"]."','".$_POST["with_cause_accident"]."','".$_POST["list_with_cause_accident"]."','".$_POST["admit_ward"]."','".$_POST["refer_hospital"]."', '".$_POST["repeat"]."', '".$_POST["cause_refer"]."', '".$_POST["type_patient"]."', '".$_POST["means_refer"]."', '".$_POST["take_care"]."','".$_POST["doc_refer"]."', '".$_POST["nurse"]."', '".$_POST["assistant_nurse"]."', '".$_POST["estimate"]."', ".$_POST["no_estimate"].", '".$_POST["cradle"]."', '".$_POST["doc_txt"]."', '".$_POST["consult"]."', '".$_POST["to_or"]."', '".$_POST["to_lr"]."', '".$_POST["to_etc"]."', '".$_POST["er_tell"]."', '".$_POST["problem_refer"]."', '".$_POST["suggestion"]."', '".$_POST["to_hpt_lp"]."','".$_POST["out_changwat"]."', $freshWound, $woundhours, '".$_POST["weight"]."', '".$_POST["height"]."','".$_POST["bmi"]."');";
		$result = Mysql_Query($sql) or die(Mysql_error());
		$id= Mysql_insert_id();
		
		if($result){
			if(trim($_POST["disease_people"]) != "ปฏิเสธ"){
				$sql = "Update opcard set congenital_disease = '".$_POST["disease_people"]."' Where hn='".$_POST["hn"]."' limit 1 ;";
				$result_opd = Mysql_Query($sql);
			}

		$count = count($_POST["lst_labcare"]);
			for($i=0;$i<$count;$i++){
				
				$sql = "INSERT INTO `trauma_lst_labcare` (`for_id`, `hn`, `lst_labcare`, `amount`) values ('".$id."','".$_POST["hn"]."','".$_POST["lst_labcare"][$i]."', '".$_POST["amount_lst_labcare"][$i]."');";

				if($_POST["lst_labcare"][$i] != "L01")
					$result2 = Mysql_Query($sql);

			}

			$count = count($_POST["cpg"]);
			for($i=0;$i<$count;$i++){
				
				$sql = "INSERT INTO `trauma_cpg` (`for_id`, `datetime`, `date_in`, `time_in`, `code_cpg`) values ('".$id."','".$thaidate."','".$_POST["date_in"]."','".$time_in."', '".$_POST["cpg"][$i]."');";
				$result2 = Mysql_Query($sql);

			}

			$count = count($_POST["labcare"]);
			for($i=0;$i<$count;$i++){
				
				$sql = "INSERT INTO `trauma_labcare` (`for_id`, `hn`, `labcare`, `amount`) values ('".$id."','".$_POST["hn"]."','".jschars($_POST["labcare"][$i])."', '".$_POST["amount_labcare"][$i]."');";

				if($_POST["labcare"][$i] != "")
					$result2 = Mysql_Query($sql);

			}
		}

		if($_POST["cure"] == "refer"){
			
			$obj->sethn($_POST["hn"]);
			$obj->setan($_POST["an"]);
			$obj->setreferh($_POST["refer_hospital"]);
			$obj->setrefertype("2 ส่งต่อ");
			$obj->setdateopd($thaidate,$_POST["date_in"]);
			$obj->setpttype($_POST["type_wounded2"],$_POST["type_wounded"]);
			$obj->setdiag($_POST["dx"]);
			$obj->setexrefer($_POST["cause_refer"]);
			$obj->setrefercar($_POST["means_refer"]);
			$obj->setoffice($_SESSION["sOfficer"]);
			$obj->setdoctor($_POST["doctor"]);
			$obj->setward("ER");
			$obj->set_targe($_POST["targe"]);
			$obj->setid($id);
			$obj->inserttb();
		}


		// บันทึกข้อมูลเข้า ADMISSION 
		$hn = $_POST['hn'];
		$vn = sprintf("%03d",$_POST["vn"]);
		$seq = date('Ymd').$vn;
		$d_update = $dt_serv = date('YmdHis');
		$aetype = $_POST['accident_detail'];
		$typein_ae = $_POST['sender'];
		$vehicle = $traffic = $_POST['wounded_vehicle'];
		$alcohol = $_POST['spirits'];
		$belt = $_POST['belt'];
		$helmet = $_POST['helmet'];
		$urgency = $_POST['type_wounded'];

		$q = mysql_query("SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn'") or die( mysql_error() );
		$opcard_item = mysql_fetch_assoc($q);
		$cid = $opcard_item['idcard'];

		$sql = "INSERT INTO `accident` (
			`id`, `HOSPCODE`, `PID`, `SEQ`, `DATETIME_SERV`, `DATETIME_AE`, 
			`AETYPE`, `AEPLACE`, `TYPEIN_AE`, `TRAFFIC`, `VEHICLE`, `ALCOHOL`, 
			`NACROTIC_DRUG`, `BELT`, `HELMET`, `AIRWAY`, `STOPBLEED`, `SPLINT`, 
			`FLUID`, `URGENCY`, `COMA_EYE`, `COMA_SPEAK`, `COMA_MOVEMENT`, `D_UPDATE`, `CID`
		) VALUES (
			NULL, '11512', '$hn', '$seq', '$dt_serv', '$dt_serv', 
			'$aetype', NULL, '$typein_ae', '$traffic', '$vehicle', '$alcohol', 
			NULL, '$belt', '$helmet', NULL, NULL, NULL, 
			NULL, '$urgency', NULL, NULL, NULL, '$d_update', '$cid'
		);";
		mysql_query($sql) or die( mysql_error() );
		// บันทึกข้อมูลเข้า ADMISSION
		
		
		if($result){
			
			echo "<CENTER><B>บันทึกข้อมูลเรียบร้อยแล้ว</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; กลับ</A></CENTER>";

		}else{

			echo "<CENTER><B>ไม่สามารถบันทึกข้อมูลได้กรุณาติกต่อโปรแกรมเมอร์</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; กลับ</A></CENTER>";

		}
		
		//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=trauma.php\">";
		exit();
	}else if(isset($_POST["submit"]) && $_POST["submit"] == "แก้ไขข้อมูล"){
	include("class_file/class_refer.php");
	$obj = New refer;

		$thaidate = (date("Y")+543).date("-m-d H:i:s");
			
		if($_POST["trauma"] != "trauma"){
				
				$_POST["type_accident"] = "";
				$_POST["wounded_vehicle"] = "";
				$_POST["wounded_detail"] = "";
				$_POST["cause_accident"] = "";
				$_POST["with_cause_accident"] = "";
				$_POST["list_with_cause_accident"] = "";
			
				$_POST["spirits"] = "";
				$_POST["belt"] = "";
				$_POST["helmet"] = "";
				$_POST["accident_detail"] = "";

		}else{

			if($_POST["type_accident"] == "1"){
				$_POST["accident_detail"] = "";
			}else{
				$_POST["wounded_vehicle"] = "";
				$_POST["wounded_detail"] = "";
				$_POST["cause_accident"] = "";
				$_POST["with_cause_accident"] = "";
				$_POST["list_with_cause_accident"] = "";

			}
		}
		
		if($_POST["cure"] != "admit"){
			$_POST["admit_ward"] = "";

		}
		if($_POST["cure"] != "d/c"){
			$_POST["to_hpt_lp"] = "";
		}

		if($_POST["list_ptright2"] == "P01"){
			$_POST["list_ptright2"] = "";
		}

		if($_POST["cure"] != "refer"){
			$_POST["refer_hospital"] = "";
			$_POST["cause_refer"] = "";
			$_POST["type_patient"] = "";
			$_POST["means_refer"] = "";
			$_POST["take_care"] = "";
			$_POST["doc_refer"] = "";
			$_POST["nurse"] = "";
			$_POST["assistant_nurse"] = "";
			$_POST["estimate"] = "";
			$_POST["no_estimate"] = "";
			$_POST["cradle"] = "";
			$_POST["doc_txt"] = "";
			$_POST["consult"] = "";
			$_POST["er_tell"] = "";
			$_POST["problem_refer"] = "";
			$_POST["suggestion"] = "";
			$_POST["targe"] = "";

		}


		$sql = "Select dbirth From opcard where hn = '".$_POST["hn"]."' limit 1";
		list($dbirth) = Mysql_fetch_row(Mysql_Query($sql));
		
		$_POST["time_diag1"] = sprintf("%04d", $_POST["time_diag1"]);
		$_POST["time_in1"] = sprintf("%04d", $_POST["time_in1"]);
		$_POST["time_out1"] = sprintf("%04d", $_POST["time_out1"]);

		$time_diag = substr($_POST["time_diag1"],0,2).":".substr($_POST["time_diag1"],-2).":00";
		$time_in = substr($_POST["time_in1"],0,2).":".substr($_POST["time_in1"],-2).":00";
		$time_out = substr($_POST["time_out1"],0,2).":".substr($_POST["time_out1"],-2).":00";

		$freshWound = !empty($_POST['freshWound']) ? (int)$_POST['freshWound'] : 'NULL' ;
		$woundhours = !empty($_POST['woundhours']) ? (int)$_POST['woundhours'] : 'NULL' ;

		$sql ="UPDATE `trauma` SET 
		`date` = '".$thaidate."',
		`vn` = '".$_POST["vn"]."',
		`an` = '".$_POST["an"]."',
		`list_ptright` = '".$_POST["list_ptright"]."', 
		`list_ptright2` = '".$_POST["list_ptright2"]."' ,
		`disease_people` = '".jschars($_POST["disease_people"])."',
		`drug_alert` = '".jschars($_POST["drug_alert"])."',
		`dx` = '".jschars($_POST["dx"])."',
		`type_accident` = '".$_POST["type_accident"]."',
		`wounded_vehicle` = '".$_POST["wounded_vehicle"]."',
		`wounded_detail` = '".$_POST["wounded_detail"]."',
		`cause_accident` = '".$_POST["cause_accident"]."',
		`belt` = '".$_POST["belt"]."',
		`helmet` = '".$_POST["helmet"]."',
		`sender` = '".$_POST["sender"]."',
		`als_sender` = '".$_POST['als_sender']."',
		`cure` = '".$_POST["cure"]."',
		`time_diag` = '".$time_diag."',
		`time_in` = '".$time_in."',
		`time_out` = '".$time_out."',
		`officer` = '".$_POST["officer"]."', 
		`trauma` = '".$_POST["trauma"]."', 
		`obs` = '".$_POST["obs"]."', 
		`type_wounded` = '".$_POST["type_wounded"]."', 
		`type_wounded2` = '".$_POST["type_wounded2"]."', 
		`accident_detail` = '".$_POST["accident_detail"]."', 
		`date_in`='".$_POST["date_in"]."',
		`etc_sender`='".$_POST["etc_sender"]."', 
		`with_cause_accident`='".$_POST["with_cause_accident"]."', 
		`list_with_cause_accident`='".$_POST["list_with_cause_accident"]."', 
		`hn` = '".$_POST["hn"]."', 
		`organ` = '".$_POST["organ"]."', 
		`maintenance` = '".jschars($_POST["maintenance"])."', 
		`age` = '".calcage($dbirth)."' , 
		`doctor` = '".$_POST["doctor"]."' , 
		`refer_hospital` = '".$_POST["refer_hospital"]."' , 
		`admit_ward` = '".$_POST["admit_ward"]."', 
		`repeat` = '".$_POST["repeat"]."' , 
		`cause_refer` = '".$_POST["cause_refer"]."', 
		`type_patient` = '".$_POST["type_patient"]."', 
		`means_refer` = '".$_POST["means_refer"]."', 
		`take_care` = '".$_POST["take_care"]."', 
		`doc_refer` = '".$_POST["doc_refer"]."', 
		`nurse` = '".$_POST["nurse"]."', 
		`assistant_nurse` = '".$_POST["assistant_nurse"]."', 
		`estimate` = '".$_POST["estimate"]."', 
		`no_estimate` = '".$_POST["no_estimate"]."', 
		`cradle` = '".$_POST["cradle"]."', 
		`doc_txt` = '".$_POST["doc_txt"]."', 
		`consult` = '".$_POST["consult"]."', 
		`to_or` = '".$_POST["to_or"]."', 
		`to_lr` = '".$_POST["to_lr"]."', 
		`to_etc` = '".$_POST["to_etc"]."', 
		`er_tell` = '".$_POST["er_tell"]."', 
		`problem_refer` = '".$_POST["problem_refer"]."', 
		`suggestion` = '".$_POST["suggestion"]."', 
		`to_hpt_lp` = '".$_POST["to_hpt_lp"]."', 
		`out_changwat` = '".$_POST["out_changwat"]."', 
		`fresh_wound` = $freshWound, 
		`wound_hours` = $woundhours,
		`weight` = '".$_POST["weight"]."', 
		`height` = '".$_POST["height"]."', 
		`bmi` = '".$_POST["bmi"]."'		
		WHERE `row_id` = '".$_POST["row_id"]."' LIMIT 1 ;
		";
		//echo "--->".$sql;


		$result = Mysql_Query($sql) or die(Mysql_error());
		
		if($result){

			if(trim($_POST["disease_people"]) != "ปฏิเสธ"){
				$sql = "Update opcard set congenital_disease = '".$_POST["disease_people"]."' Where hn='".$_POST["hn"]."' limit 1 ;";
				$result_opd = Mysql_Query($sql);
			}

		$sql = "Delete From trauma_lst_labcare where for_id = '".$_POST["row_id"]."' ";
		$result2 = Mysql_Query($sql);
		$sql = "Delete From trauma_labcare where for_id = '".$_POST["row_id"]."' ";
		$result2 = Mysql_Query($sql);
		$sql = "Delete From trauma_cpg where for_id = '".$_POST["row_id"]."' ";
		$result2 = Mysql_Query($sql);

		$count = count($_POST["lst_labcare"]);
			for($i=0;$i<$count;$i++){
				
				$sql = "INSERT INTO `trauma_lst_labcare` (`for_id`, `hn`, `lst_labcare`, `amount`) values ('".$_POST["row_id"]."','".$_POST["hn"]."','".$_POST["lst_labcare"][$i]."', '".$_POST["amount_lst_labcare"][$i]."');";

				if($_POST["lst_labcare"][$i] != "L01")
					$result2 = Mysql_Query($sql);

			}

			$count = count($_POST["labcare"]);
			for($i=0;$i<$count;$i++){
				
				$sql = "INSERT INTO `trauma_labcare` (`for_id`, `hn`, `labcare`, `amount`) values ('".$_POST["row_id"]."','".$_POST["hn"]."','".jschars($_POST["labcare"][$i])."', '".$_POST["amount_labcare"][$i]."');";

				if($_POST["labcare"][$i] != "")
					$result2 = Mysql_Query($sql);

			}
		}

		$count = count($_POST["cpg"]);
			for($i=0;$i<$count;$i++){
				
				$sql = "INSERT INTO `trauma_cpg` (`for_id`, `datetime`, `date_in`, `time_in`, `code_cpg`) values ('".$id."','".$thaidate."','".$_POST["date_in"]."','".$time_in."', '".$_POST["cpg"][$i]."');";
				$result2 = Mysql_Query($sql);

			}
		

		if($_POST["cure"] == "refer"){
			
			$obj->sethn($_POST["hn"]);
			$obj->setan($_POST["an"]);
			$obj->setreferh($_POST["refer_hospital"]);
			$obj->setrefertype("2 ส่งต่อ");
			$obj->setdateopd($thaidate,$_POST["date_in"]);
			$obj->setpttype($_POST["type_wounded2"],$_POST["type_wounded"]);
			$obj->setdiag($_POST["dx"]);
			$obj->setexrefer($_POST["cause_refer"]);
			$obj->setrefercar($_POST["means_refer"]);
			$obj->setoffice($_SESSION["sOfficer"]);
			$obj->setdoctor($_POST["doctor"]);
			$obj->setid($_POST["row_id"]);
			$obj->setward("ER");
			$obj->set_targe($_POST["targe"]);

			$obj->updatetb();
		}

		// บันทึกข้อมูลเข้า ADMISSION 
		$hn = $_POST['hn'];
		$vn = sprintf("%03d",$_POST["vn"]);
		$seq = date('Ymd').$vn;
		$d_update = $dt_serv = date('YmdHis');
		$aetype = $_POST['accident_detail'];
		$typein_ae = $_POST['sender'];
		$vehicle = $traffic = $_POST['wounded_vehicle'];
		$alcohol = $_POST['spirits'];
		$belt = $_POST['belt'];
		$helmet = $_POST['helmet'];
		$urgency = $_POST['type_wounded'];

		$q = mysql_query("SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn'") or die( mysql_error() );
		$opcard_item = mysql_fetch_assoc($q);
		$cid = $opcard_item['idcard'];

		$q = mysql_query("SELECT `id` FROM `accident` WHERE `PID` = '$hn' AND `SEQ` = '$seq' ") or die( mysql_error() );
		$acc = mysql_fetch_assoc($q);
		$accident_id = $acc['id'];

		$sql = "UPDATE `accident` SET 
		`PID`='$hn', `SEQ`='$seq', 
		`DATETIME_SERV`='$dt_serv', `DATETIME_AE`='$dt_serv', 
		`AETYPE`='$aetype', `AEPLACE`=NULL, 
		`TYPEIN_AE`='$typein_ae', `TRAFFIC`='$traffic', 
		`VEHICLE`='$vehicle', `ALCOHOL`='$alcohol', 
		`NACROTIC_DRUG`=NULL, `BELT`='$belt', 
		`HELMET`='$helmet', `AIRWAY`=NULL, 
		`STOPBLEED`=NULL, `SPLINT`=NULL, 
		`FLUID`=NULL, `URGENCY`='$urgency', 
		`COMA_EYE`=NULL, `COMA_SPEAK`=NULL, 
		`COMA_MOVEMENT`=NULL, `D_UPDATE`='$d_update', 
		`CID`='$cid' WHERE (`id`='$accident_id');";
		mysql_query($sql) or die( mysql_error() );

		// บันทึกข้อมูลเข้า ADMISSION 


		if($result){
			
			echo "<CENTER><B>แก้ไขข้อมูลเรียบร้อยแล้ว</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; กลับ</A></CENTER>";

		}else{

			echo "<CENTER><B>ไม่สามารถแก้ไขข้อมูลได้กรุณาติกต่อโปรแกรมเมอร์</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; กลับ</A></CENTER>";

		}
		
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=trauma.php\">";
		exit();
	}if(isset($_POST["submit"]) && $_POST["submit"] == "ยกยอดเวร"){
	include("class_file/class_refer.php");
	$obj = New refer;

		$thaidate = (date("Y")+543).date("-m-d H:i:s");
		
		if($_POST["trauma"] != "trauma"){
				
				$_POST["type_accident"] = "";
				$_POST["wounded_vehicle"] = "";
				$_POST["wounded_detail"] = "";
				$_POST["cause_accident"] = "";
				$_POST["with_cause_accident"] = "";
				$_POST["list_with_cause_accident"] = "";

				$_POST["spirits"] = "";
				$_POST["belt"] = "";
				$_POST["helmet"] = "";
				$_POST["accident_detail"] = "";

		}else{

			if($_POST["type_accident"] == "1"){
				$_POST["accident_detail"] = "";
			}else{
				$_POST["wounded_vehicle"] = "";
				$_POST["wounded_detail"] = "";
				$_POST["cause_accident"] = "";
				$_POST["with_cause_accident"] = "";
				$_POST["list_with_cause_accident"] = "";


			}
		}
		
		if($_POST["cure"] != "admit"){
			$_POST["admit_ward"] = "";

		}
		if($_POST["cure"] != "d/c"){
			$_POST["to_hpt_lp"] = "";
		}
		if($_POST["list_ptright2"] == "P01"){
			$_POST["list_ptright2"] = "";
		}

		if($_POST["cure"] != "refer"){
			$_POST["refer_hospital"] = "";
			$_POST["cause_refer"] = "";
			$_POST["type_patient"] = "";
			$_POST["means_refer"] = "";
			$_POST["take_care"] = "";
			$_POST["doc_refer"] = "";
			$_POST["nurse"] = "";
			$_POST["assistant_nurse"] = "";
			$_POST["estimate"] = "";
			$_POST["no_estimate"] = "";
			$_POST["cradle"] = "";
			$_POST["doc_txt"] = "";
			$_POST["consult"] = "";
			$_POST["er_tell"] = "";
			$_POST["problem_refer"] = "";
			$_POST["suggestion"] = "";
			$_POST["targe"] = "";
		}




		$sql = "Select dbirth From opcard where hn = '".$_POST["hn"]."' limit 1";
		list($dbirth) = Mysql_fetch_row(Mysql_Query($sql));
		
		$_POST["time_diag1"] = sprintf("%04d", $_POST["time_diag1"]);
		$_POST["time_in1"] = sprintf("%04d", $_POST["time_in1"]);
		$_POST["time_out1"] = sprintf("%04d", $_POST["time_out1"]);

		$time_diag = substr($_POST["time_diag1"],0,2).":".substr($_POST["time_diag1"],-2).":00";
		$time_in = substr($_POST["time_in1"],0,2).":".substr($_POST["time_in1"],-2).":00";
		$time_out = substr($_POST["time_out1"],0,2).":".substr($_POST["time_out1"],-2).":00";
		
		if($time_in >= "07:31:00" && $time_in < "15:31:00"){
			$time_in = "15:31:00";
		}else if($time_in >= "15:31:00" && $time_in < "23:31:00"){
			
			/*list($y,$m,$d) = explode("-",$_POST["date_in"]);
			$y=$y-543;
			$ti = mktime(0,0,0,$m,$d+1,$y);
			$_POST["date_in"] = (date("Y",$ti)+543).date("-m-d",$ti);*/
			$time_in = "23:31:00";

		}else if($time_in >= "23:31:00" && $time_in <= "23:59:59"){

			list($y,$m,$d) = explode("-",$_POST["date_in"]);
			$y=$y-543;
			$ti = mktime(0,0,0,$m,$d+1,$y);
			$_POST["date_in"] = (date("Y",$ti)+543).date("-m-d",$ti);

			$time_in = "07:31:00";
		}else if($time_in >= "00:00:00" && $time_in < "07:31:00"){
			$time_in = "07:31:00";
		}

		$freshWound = !empty($_POST['freshWound']) ? (int)$_POST['freshWound'] : 'NULL' ;
		$woundhours = !empty($_POST['woundhours']) ? (int)$_POST['woundhours'] : 'NULL' ;

				$sql ="INSERT INTO `trauma` (  `date` , `vn` , `hn` , `an`, `age` , `list_ptright` , `list_ptright2` , `disease_people` , `drug_alert` , `dx`, `organ`, `maintenance`, `doctor`,  `type_accident` , `wounded_vehicle` , `wounded_detail` , `cause_accident` , `spirits` , `belt` , `helmet` , `sender` , `cure`,  `time_diag` , `time_in` , `time_out`, `officer`, `trauma`, `obs`, `type_wounded`, `type_wounded2`, `accident_detail`, `date_in`,`etc_sender`, `with_cause_accident`, `list_with_cause_accident`, `admit_ward`, `refer_hospital`, `repeat`, `cause_refer`, `type_patient`, `means_refer`, `take_care`,`doc_refer`, `nurse`, `assistant_nurse`, `estimate`, `no_estimate`, `cradle`, `doc_txt`, `consult`, `to_or`, `to_lr`, `to_etc`, `er_tell`, `problem_refer`, `suggestion`, `to_hpt_lp`, `out_changwat`, `next_ka`, `fresh_wound`, `wound_hours`, `weight`, `height`, `bmi`) VALUES ('".$thaidate."', '".$_POST["vn"]."', '".$_POST["hn"]."', '".$_POST["an"]."', '".calcage($dbirth)."', '".$_POST["list_ptright"]."', '".$_POST["list_ptright2"]."', '".jschars($_POST["disease_people"])."', '".jschars($_POST["drug_alert"])."', '".jschars($_POST["dx"])."', '".jschars($_POST["organ"])."', '".jschars($_POST["maintenance"])."', '".$_POST["doctor"]."', '".$_POST["type_accident"]."', '".$_POST["wounded_vehicle"]."', '".$_POST["wounded_detail"]."', '".$_POST["cause_accident"]."', '".$_POST["spirits"]."', '".$_POST["belt"]."', '".$_POST["helmet"]."', '".$_POST["sender"]."', '".$_POST["cure"]."', '".$time_diag."', '".$time_in."', '".$time_out."', '".$_SESSION["sOfficer"]."', '".$_POST["trauma"]."', '".$_POST["obs"]."', '".$_POST["type_wounded"]."', '".$_POST["type_wounded2"]."', '".$_POST["accident_detail"]."','".$_POST["date_in"]."','".$_POST["etc_sender"]."','".$_POST["with_cause_accident"]."','".$_POST["list_with_cause_accident"]."','".$_POST["admit_ward"]."','".$_POST["refer_hospital"]."', '".$_POST["repeat"]."', '".$_POST["cause_refer"]."', '".$_POST["type_patient"]."', '".$_POST["means_refer"]."', '".$_POST["take_care"]."','".$_POST["doc_refer"]."', '".$_POST["nurse"]."', '".$_POST["assistant_nurse"]."', '".$_POST["estimate"]."', '".$_POST["no_estimate"]."', '".$_POST["cradle"]."', '".$_POST["doc_txt"]."', '".$_POST["consult"]."', '".$_POST["to_or"]."', '".$_POST["to_lr"]."', '".$_POST["to_etc"]."', '".$_POST["er_tell"]."', '".$_POST["problem_refer"]."', '".$_POST["suggestion"]."', '".$_POST["to_hpt_lp"]."', '".$_POST["out_changwat"]."', '1', $freshWound, $woundhours, '".$_POST["weight"]."', '".$_POST["height"]."','".$_POST["bmi"]."');";

		$result = Mysql_Query($sql) or Mysql_error();
		$id= Mysql_insert_id();
		
		if($result){
		$count = count($_POST["lst_labcare"]);
			for($i=0;$i<$count;$i++){
				
				$sql = "INSERT INTO `trauma_lst_labcare` (`for_id`, `hn`, `lst_labcare`, `amount`) values ('".$id."','".$_POST["hn"]."','".$_POST["lst_labcare"][$i]."', '".$_POST["amount_lst_labcare"][$i]."');";

				if($_POST["lst_labcare"][$i] != "L01")
					$result2 = Mysql_Query($sql);

			}

			$count = count($_POST["labcare"]);
			for($i=0;$i<$count;$i++){
				
				$sql = "INSERT INTO `trauma_labcare` (`for_id`, `hn`, `labcare`, `amount`) values ('".$id."','".$_POST["hn"]."','".jschars($_POST["labcare"][$i])."', '".$_POST["amount_labcare"][$i]."');";

				if($_POST["labcare"][$i] != "")
					$result2 = Mysql_Query($sql);

			}
		}
		
		if($_POST["cure"] == "refer"){
			
			$obj->sethn($_POST["hn"]);
			$obj->setan($_POST["an"]);
			$obj->setreferh($_POST["refer_hospital"]);
			$obj->setrefertype("2 ส่งต่อ");
			$obj->setdateopd($thaidate,$_POST["date_in"]);
			$obj->setpttype($_POST["type_wounded2"],$_POST["type_wounded"]);
			$obj->setdiag($_POST["dx"]);
			$obj->setexrefer($_POST["cause_refer"]);
			$obj->setrefercar($_POST["means_refer"]);
			$obj->setoffice($_SESSION["sOfficer"]);
			$obj->setdoctor($_POST["doctor"]);
			$obj->setward("ER");
			$obj->set_targe($_POST["targe"]);
			$obj->setid($id);
			$obj->inserttb();
		}

		if($result){
			
			echo "<CENTER><B>บันทึกข้อมูลเรียบร้อยแล้ว</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; กลับ</A></CENTER>";

		}else{

			echo "<CENTER><B>ไม่สามารถบันทึกข้อมูลได้กรุณาติกต่อโปรแกรมเมอร์</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; กลับ</A></CENTER>";

		}
		
		//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=trauma.php\">";
		exit();
	}else if(isset($_GET["action"]) && $_GET["action"] == "del"){



		$sql ="Delete From trauma Where row_id = '".$_GET["id"]."' limit 1" ;
		$result = Mysql_Query($sql) or Mysql_error();
		
		$sql = "Delete From trauma_lst_labcare where for_id = '".$_GET["id"]."' ";
		$result2 = Mysql_Query($sql);
		$sql = "Delete From trauma_labcare where for_id = '".$_GET["id"]."' ";
		$result2 = Mysql_Query($sql);

		$sql = "Delete From trauma_cpg where for_id = '".$_GET["id"]."' ";
		$result2 = Mysql_Query($sql);

		if($result){
			
			echo "<CENTER><B>ลบข้อมูลเรียบร้อยแล้ว</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; กลับ</A></CENTER>";

		}else{

			echo "<CENTER><B>ไม่สามารถลบข้อมูลได้กรุณาติกต่อโปรแกรมเมอร์</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; กลับ</A></CENTER>";

		}
		
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=trauma.php\">";
		exit();
	}







	$list_vehicle = array();
	
	$list_vehicle["0"] = "-------";
	$list_vehicle["V01"] = "จักรยานและสามล้อ";
	$list_vehicle["V02"] = "จักรยานยนต์";
	$list_vehicle["V03"] = "รถเก๋ง";
	$list_vehicle["V04"] = "รถปิกอั๊พ";
	$list_vehicle["V11"] = "รถตู้";
	$list_vehicle["V12"] = "สามล้อเครื่อง ตุ๊ก ตุ๊ก";
	$list_vehicle["V05"] = "รถบรรทุกหนัก ตั้งแต่ 6 ล้อ ขึ้นไป";
	$list_vehicle["V06"] = "รถพ่วง";
	$list_vehicle["V07"] = "รถโดยทาง 2 แถว";
	$list_vehicle["V08"] = "รถโดยสารบัส";
	$list_vehicle["V09"] = "อื่นๆ";
	$list_vehicle["V10"] = "ไม่ทราบ";

	$list_wounded = array();
	
	$list_wounded["0"] = "-------";
	$list_wounded["W01"] = "ผู้ขับขี่";
	$list_wounded["W02"] = "ผู้โดยสาร";
	$list_wounded["W03"] = "คนเดินเท้า";
	$list_wounded["W04"] = "ไม่ทราบ";

	$list_accident_detail = array();


$list_accident_detail["A01"] = "-------";
$list_accident_detail["A02"] = "พลัด ตก หรือหกล้ม (W00 – W19)ุ";
$list_accident_detail["A03"] = "สัมผัสกับแรงเชิงกลวัตถุสิ่งของ (W20 – W49)ุ";
$list_accident_detail["A04"] = "สัมผัสกับแรงเชิงกลของสัตว์ / คน (W50 – W64)ุ";
$list_accident_detail["A05"] = "การตกน้ำ จมน้ำ (W65 – W74)ุ";
$list_accident_detail["A06"] = "คุกคามการหายใจ (W75 – W84)ุ";
$list_accident_detail["A07"] = "สัมผัสกระแสไฟฟ้า รังสีและอุณหภูมิ (W85 – W99)ุ";
$list_accident_detail["A08"] = "สัมผัสควันไฟ และเปลวไฟ (X00 – X09)ุ";
$list_accident_detail["A09"] = "สัมผัสความร้อน ของร้อน (X10 – X19)ุ";
$list_accident_detail["A10"] = "สัมผัสพิษจากสัตว์หรือพืช (X20 – X29)ุ";
$list_accident_detail["A11"] = "สัมผัสพลังงานจากธรรมชาติ (X30 – X39)ุ";
$list_accident_detail["A12"] = "สัมผัสพิษและสารอื่น ๆ (X40 – X49)ุ";
$list_accident_detail["A13"] = "การออกแรงเกิน (X50 – X57)ุ";
$list_accident_detail["A14"] = "สัมผัสกับสิ่งที่ไม่ทราบแน่ชัด (X58 – X59)ุ";
$list_accident_detail["A15"] = "ทำร้ายตัวเองด้วยวิธีต่าง  ๆ  (X60 – X84)ุ";
$list_accident_detail["A16"] = "ถูกทำร้ายด้วยวิธีต่าง ๆ (X85 – Y09)ุ";
$list_accident_detail["A17"] = "บาดเจ็บโดยไม่ทราบเจตนา (Y10 – Y33)ุ";
$list_accident_detail["A18"] = "ดำเนินการทางกฎหมายหรือสงคราม (Y35 – Y36)ุ";
$list_accident_detail["A19"] = "ไม่ทราบทั้งสาเหตุและเจตนา (Y34)ุ";

$list_labcare = array();

$list_labcare["L01"] = "-------";
$list_labcare["L28"] = "ป้ายตา / ปิดตา";
$list_labcare["L29"] = "ฉีดยาใน ER / IM";
$list_labcare["L30"] = "ฉีดยาใน ER / IV";
$list_labcare["L31"] = "ฉีดยาใน ER / SC";
$list_labcare["L15"] = "เจาะ DTX";
$list_labcare["L16"] = "เจาะเลือด / เก็บ specimen";
$list_labcare["L32"] = "เตรียมฉีดยาเข่า (Synvise / GO-ON / KA / Hyruan)";
$list_labcare["L33"] = "เตรียมฉีด Needle puncture";
$list_labcare["L34"] = "เตรียมฉีด KA";
$list_labcare["L35"] = "เตรียม Aspirate cyst";
$list_labcare["L52"] = "Anterior nasal packing";
$list_labcare["L54"] = "Accupunture";
$list_labcare["L60"] = "Abdominal Tapping";
$list_labcare["L47"] = "aspirate Nail/Aspirate knee/Aspirate hematoma";
$list_labcare["L45"] = "Cold compression";
$list_labcare["L58"] = "CPR";
$list_labcare["L67"] = "Close Reduction";
$list_labcare["L17"] = "Dressing wound";
$list_labcare["L66"] = "Drip ยา";
$list_labcare["L06"] = "EKG 12 Lead";
$list_labcare["L26"] = "Eye irrigation";
$list_labcare["L65"] = "FHS";
$list_labcare["L57"] = "Hold ambu-bag";
$list_labcare["L20"] = "I & D";
$list_labcare["L50"] = "Irrigate bladder";
$list_labcare["L61"] = "LP ( lumbar puncture)";
$list_labcare["L04"] = "Nebulizer";
$list_labcare["L46"] = "Nail out/ Partial nail out";
$list_labcare["L22"] = "NG lavage";
$list_labcare["L49"] = "NG-feeding";
$list_labcare["L02"] = "On Oxygen";					
$list_labcare["L03"] = "On 02 – Sat.";					
$list_labcare["L05"] = "On EKG Monitor";
$list_labcare["L07"] = "On BP Monitor";
$list_labcare["L36"] = "On defibrillator";
$list_labcare["L08"] = "On Slab";
$list_labcare["L37"] = "Off Slab";
$list_labcare["L09"] = "On Cast";
$list_labcare["L38"] = "Off Cast";
$list_labcare["L10"] = "On Splint / FS";
$list_labcare["L39"] = "Off Splint / FS";
$list_labcare["L40"] = "Off wire";
$list_labcare["L41"] = "Off gauze bandage";
$list_labcare["L69"] = "Off Staple";
$list_labcare["L42"] = "On hard collar/ on soft collar/ on philladellphia";
$list_labcare["L43"] = "On jones ’bandage";
$list_labcare["L44"] = "On skin traction";
$list_labcare["L12"] = "On IVF";
$list_labcare["L13"] = "On Plug / Lock";
$list_labcare["L14"] = "On Blood";
$list_labcare["L21"] = "On NG tube";
$list_labcare["L48"] = "Off NG-Tube";
$list_labcare["L23"] = "On Foley’s catheter";
$list_labcare["L51"] = "Off Foley’s catheter";
$list_labcare["L56"] = "On ET-Tube/ on TT-Tube";
$list_labcare["L53"] ="Pack gauze";
$list_labcare["L63"] ="PR";
$list_labcare["L64"] ="PV";
$list_labcare["L27"] = "Remove FB";
$list_labcare["L18"] = "Suture"; 
$list_labcare["L19"] = "Stitches – off";
$list_labcare["L24"] = "Single catheter / intermittent cath";
$list_labcare["L25"] = "Sponge bath";
$list_labcare["L55"] ="Suction";
$list_labcare["L59"] ="Thoracentesis/ thoracocentesis";
$list_labcare["L62"] ="Throat Swab";
$list_labcare["L68"] ="Xylocaine block";

	$list_ptright = array();
	
	$list_ptright["P01"] = "-------";
	$list_ptright["P02"] = "ทหาร (น)";
	$list_ptright["P03"] = "ทหาร (นส)";
	$list_ptright["P04"] = "ทหาร (พลฯ)";
	$list_ptright["P05"] = "ครอบครัว";
	$list_ptright["P06"] = "พ.ต้น";
	$list_ptright["P07"] = "พ.";
	$list_ptright["P08"] = "ประกันสังคม";
	$list_ptright["P09"] = "30บาท";
	$list_ptright["P10"] = "30บาทฉุกเฉิน";
	$list_ptright["P11"] = "พรบ.";
	$list_ptright["P12"] = "กท.44";

?><html>
<head>
<title>การบันทึกประวัติผู้ป่วย ER</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>
<!--[if IE]>
<script type="text/javascript" src="assets/js/json2.js"></script>
<![endif]-->
<script language="JavaScript" src="calendar/calendar2.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<script LANGUAGE="JavaScript">
	
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

function viewdetail(action,hn) {
	
		if(document.getElementById("hn").value != ""){
			url = 'trauma.php?action='+action+'&hn=' + hn;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("div_viewdetail").innerHTML = xmlhttp.responseText;
			drugreact('drugreact',hn);
			//congenital_disease('congenital_disease',hn);
			organ('organ',hn);
			disease_people('disease_people',hn);
		}
}

function view_confirm_inj(action,hn) {
	

			url = 'trauma.php?action='+action+'&hn=' + hn;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("Div_Confirm_inject").innerHTML = xmlhttp.responseText;


}

function view_confirm_ds(action,hn) {
	

			url = 'trauma.php?action='+action+'&hn=' + hn;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("Div_Confirm_ds").innerHTML = xmlhttp.responseText;


}

function drugreact(action,hn) {
		var txt;
		if(document.getElementById("hn").value != ""){
			url = 'trauma.php?action='+action+'&hn=' + hn;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			txt = xmlhttp.responseText;

			if(txt.length  > 4 ){
				document.getElementById("drug_alert").value = txt.substr(4) ;
			}
		}
}

function congenital_disease(action,hn) {
		var txt;
		if(document.getElementById("hn").value != ""){
			url = 'trauma.php?action='+action+'&hn=' + hn;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			txt = xmlhttp.responseText;

			if(txt.length  > 4 ){
				document.getElementById("disease_people").value = txt.substr(4) ;
			}
		}
}

function disease_people(action,hn) {
		var txt;
		if(document.getElementById("hn").value != ""){
			url = 'trauma.php?action='+action+'&hn=' + hn;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			txt = xmlhttp.responseText;

			if(txt.length  > 4 ){
				document.getElementById("disease_people").value = txt.substr(4) ;
			}
		}
}
function organ(action,hn) {
		var txt;
		if(document.getElementById("hn").value != ""){
			url = 'trauma.php?action='+action+'&hn=' + hn;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			txt = xmlhttp.responseText;

			if(txt.length  > 4 ){
				document.getElementById("organ").value = txt.substr(4) ;
			}
		}
}

function view_expenses(an) {
		var txt;
		var action = 'view_expenses';
		if(an ==""){
			
			alert("กรุณากรอก AN ด้วยครับ");

		}else{
			url = 'trauma.php?action='+action+'&an=' + an;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			txt = xmlhttp.responseText;
	
	if(txt.length  > 4 ){
		window.open(txt.substr(4),'_blank');
	}else{
		alert('ไม่มีหมายเลข AN นี้ ครับ');
	}
		}
			
}


	function hidden_block(v){
		
		if(v == "trauma"){
			block1.style.display="";
			//block2.style.display="";
		}else{
			block1.style.display="none";
			block2.style.display="none";
		}

	}
	
	function create_lst_labcare(st){

		total = eval(document.getElementById("total_lst_labcare").value);
			if(st != ''){
				ist = eval(st);
			}else{
				ist =0;
			}
			document.getElementById("list_lst_labcare").innerHTML = "";
			for(i=1+ist;i<=total;i++){

				document.getElementById("list_lst_labcare").innerHTML = document.getElementById("list_lst_labcare").innerHTML + " "+i+".&nbsp;หัตถการ : <SELECT NAME='lst_labcare[]'><?php
				foreach($list_labcare as $key => $value){
					echo "<Option value='".$key."' "; if($key == $arr["lst_labcare"]) echo " Selected "; echo ">".$value."</Option> ";
				}
			?></SELECT><BR>จำนวนครั้ง&nbsp;<INPUT TYPE=\"text\" NAME=\"amount_lst_labcare[]\" size=\"2\" onkeypress=\"check_number();\" value=\"1\"><BR><BR>";

			}
	}

	function create_labcare(st){

		total = eval(document.getElementById("total_labcare").value);
			if(st != ''){
				ist = eval(st);
			}else{
				ist =0;
			}
			document.getElementById("list_labcare").innerHTML = "";
			for(i=1+ist;i<=total;i++){
				document.getElementById("list_labcare").innerHTML = document.getElementById("list_labcare").innerHTML + " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+i+".&nbsp;หัตถการ อื่นๆ : <INPUT TYPE='text' NAME='labcare[]' >&nbspจำนวนครั้ง&nbsp;<INPUT TYPE=\"text\" NAME=\"amount_labcare[]\" size=\"2\" onkeypress=\"check_number();\"  value=\"1\"><BR>";

			}
	}

	function check_number() {
	e_k=event.keyCode
		if (e_k != 47 && e_k != 46 && (e_k < 48) || (e_k > 57)) {
			event.returnValue = false;
			alert("กรุณากรอกเป็นตัวเลขเท่านั้นครับ");
			return false;
		}else{
			return true;
		}
	}
	
	function show_tooltip(detail,al,l,r){

	tooltip.style.left=document.body.scrollLeft+event.clientX+l;
	tooltip.style.top=document.body.scrollTop+event.clientY+r;
	tooltip.innerHTML="";
	tooltip.innerHTML = tooltip.innerHTML+"<TABLE border=\"1\" bordercolor=\"blue\"><TR><TD align=\""+al+"\">"+detail+"</TD></TR></TABLE>";
	tooltip.style.display="";
}
	
	function hid_tooltip(){
		tooltip.style.display="none";
		tooltip.innerHTML = "";
	}

	function input_id(name,val){
		document.getElementById(name).value= val;
	}
	
    
</script>
<div id = "tooltip" onMouseOver="tooltip.style.display=''; " onMouseOut="hid_tooltip();" style="position:absolute;display:none;background-color:#FFFFFF;" >
</div>
<?php 
$urlOpd = "";
if($_SESSION['smenucode']=="ADMMAINOPD")
{
	$urlOpd = "?forOpd=1";
}

echo "<A HREF=\"../nindex.htm\">&lt; &lt; เมนู</A>&nbsp;|&nbsp;<A HREF=\"confirn_ds.php$urlOpd\" target=\"_blank\">ยืนยันการทำแผล</A>&nbsp;|&nbsp;<A HREF=\"confirn_inject.php$urlOpd\" target=\"_blank\">ยืนยันการฉีดยา</A>&nbsp;|&nbsp;";
?>
<A HREF="javascript:void(0);" Onclick="if(document.getElementById('menu').style.display=='') document.getElementById('menu').style.display='none'; else document.getElementById('menu').style.display=''; ">รายงานต่างๆ</A> | <A HREF="consent4.php" target="_blank">ใบยินยอม</A> | <A HREF="erstikerdrug.php" target="_blank">stiker ผสมยา</A> | <A HREF="admit_form.php" target="_blank">แจ้งADMIT</A> | <a target=_TOP href="oplist1.php">พิมพ์ใบสั่งยา</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<DIV id="menu" bgcolor="#FFFFFF" style="position: absolute; display:none; "><BR>
<Table bgcolor="#FFFFFF" bordercolor="#0000FF" border="1" cellpadding="2" cellspacing="0">
	<TR>
	<TD bgcolor="#0000FF" align="center">
		<FONT COLOR="#FFFFFF"><B>รายงานต่างๆ</B></FONT>
	</TD>
	</TR>
	<TR>
	<TD>
<A HREF="concisely_trun.php<?=$urlOpd;?>" target="_blank">รายงานสรุปยอดเวร</A> <BR> <A HREF="report_labcare.php" target="_blank">รายการบันทึกหัตถการประจำวัน</A> <BR> 
<A HREF="report_trauma01.php" target="_blank">รายงานสรุป</A> <BR> 
<A HREF="report_trauma01_2.php" target="_blank">รายงานสรุป(เลือกเป็นช่วง)</A> <BR> 
<A HREF="report_trauma02.php" target="_blank">รายงานอุบัติเหตุการจราจร</A> <BR> 
<A HREF="report_trauma03.php" target="_blank">แบบรายงานเฝ้าระวังการบาดเจ็บ 19 สาเหตุ</A> <BR> 
<A HREF="report_trauma04.php" target="_blank">แบบรายงานการบาดเจ็บ/เสียชีวิตจากอุบัติเหตุจราจรของทหาร-ครอบครัว</A> <BR> 
<A HREF="report_trauma05.php" target="_blank">รายงานผู้ป่วยนำส่งโดย อปพร/1669</A>
<BR> <A HREF="report_ds.php<?=$urlOpd;?>" target="_blank">รายชื่อผู้มาทำแผล</A>
<BR> <A HREF="report_inject.php<?=$urlOpd;?>" target="_blank">รายชื่อผู้มาฉีดยา</A>
<BR> <A HREF="report_groupdiag.php" target="_blank">สถิติกลุ่มโรค</A>
<BR> <A HREF="report_trauma06.php" target="_blank">รายชื่อผู้ป่วย Refer</A>
<BR> <A HREF="report_trauma07.php" target="_blank">สรุปยอดผู้ป่วยที่รอตรวจเกิน กำหนด</A>
<BR> <A HREF="report_trauma08.php" target="_blank">สรุปยอดผู้ป่วยที่มีการเปลี่ยนแปลงอาการ</A>
<BR> <A HREF="report_trauma09.php" target="_blank">สรุปการ Refer ผู้ป่วย</A>
<BR> <A HREF="report_trauma10.php" target="_blank">สถิติสิทธิ์การรักษา</A>
<BR> <A HREF="report_trauma11.php" target="_blank">รายชื่ผู้ป่วยตามช่วงเวลา</A>
<BR> <A HREF="report_trauma12.php" target="_blank">สถิติ CPG</A>
<BR> <A HREF="report_trauma13.php" target="_blank">รายชื่อผู้ป่วยที่มาตรวจซ้ำ</A>
<BR> <A HREF="report_trauma14.php" target="_blank">รายงานผู้ป่วย ADMIT ประเภท 1,2</A>
</TD>
</TR>
</Table>
</DIV>
<?php
	if(isset($_GET["action"]) && $_GET["action"]=="edit"){

		$sql = "Select * From trauma where row_id = '".$_GET["id"]."' limit 1; ";

		$result = Mysql_Query($sql);
		$arr = Mysql_fetch_assoc($result);
		$hidden = "<INPUT TYPE=\"hidden\" name=\"row_id\" value=\"".$arr["row_id"]."\">";

		$button = "<CENTER><INPUT TYPE=\"submit\" name=\"submit\" value=\"แก้ไขข้อมูล\">&nbsp;&nbsp;<INPUT TYPE=\"button\" value=\"ยกเลิก\" onclick=\"window.location.href='trauma.php';\">&nbsp;&nbsp;<INPUT TYPE=\"submit\" name=\"submit\" value=\"ยกยอดเวร\"></CENTER>";
		
		$arr["time_in"] = substr($arr["time_in"],0,-3);
		$select_time_in = explode(":",$arr["time_in"]);
		$select_time_in1 = $select_time_in[0];
		$select_time_in2 = $select_time_in[1];

		$arr["time_diag"] = substr($arr["time_diag"],0,-3);
		$select_time_diag = explode(":",$arr["time_diag"]);
		$select_time_diag1 = $select_time_diag[0];
		$select_time_diag2 = $select_time_diag[1];

		$arr["time_out"] = substr($arr["time_out"],0,-3);
		$select_time_out = explode(":",$arr["time_out"]);
		$select_time_out1 = $select_time_out[0];
		$select_time_out2 = $select_time_out[1];

		if($arr["trauma"] != "trauma")
			$hdd = "none";
		
		
		$sql = "Select code_cpg From trauma_cpg where for_id = '".$_GET["id"]."' ";
		$cpg = array();
		$result = Mysql_Query($sql);
		while($list_cpg = Mysql_fetch_assoc($result)){
			$cpg[$list_cpg["code_cpg"]] = true;
		}

		$sql = "Select * From trauma_labcare where for_id = '".$_GET["id"]."' AND hn = '".$arr["hn"]."' ";
		$result = Mysql_Query($sql);
		$total_labcare = Mysql_num_rows($result);

		$div_list_labcare = "";
		$i=1;
		while($arr2 = Mysql_fetch_assoc($result)){
			$div_list_labcare .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$i.".&nbsp;หัตถการ อื่นๆ : <INPUT TYPE='text' NAME='labcare[]' value='".$arr2["labcare"]."'>&nbspจำนวนครั้ง&nbsp;<INPUT TYPE=\"text\" NAME=\"amount_labcare[]\" size=\"2\" onkeypress=\"check_number();\" value=\"".$arr2["amount"]."\"><BR>";
			$i++;
		}

		
		$sql = "Select * From trauma_lst_labcare where for_id = '".$_GET["id"]."' AND hn = '".$arr["hn"]."' ";

		$result = Mysql_Query($sql);
		$total_lst_labcare = Mysql_num_rows($result);

		$div_list_lst_labcare = "";
		$i=1;
		while($arr2 = Mysql_fetch_assoc($result)){
			$div_list_lst_labcare .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$i.".&nbsp;หัตถการ : <SELECT NAME='lst_labcare[]'>";
				foreach($list_labcare as $key => $value){
					$div_list_lst_labcare .= "<Option value='".$key."' "; 
						if($key == $arr2["lst_labcare"]) $div_list_lst_labcare .= " Selected "; 
					$div_list_lst_labcare .= ">".$value."</Option> ";
				}

			$div_list_lst_labcare .= "</SELECT>&nbspจำนวนครั้ง&nbsp;<INPUT TYPE=\"text\" NAME=\"amount_lst_labcare[]\" size=\"2\" onkeypress=\"check_number();\"  value=\"".$arr2["amount"]."\"><BR>";
			$i++;
		}

	}else{

		$hidden = "";
		$button = "<CENTER><INPUT TYPE=\"submit\" name=\"submit\" value=\"เพิ่มข้อมูล\">&nbsp;&nbsp;<INPUT TYPE=\"reset\" value=\"ยกเลิก\">";
		$hdd = "none";

	}
?>

<script LANGUAGE="JavaScript">
	window.onload = function(){
		block1.style.display="<?php echo $hdd;?>";
		block2.style.display="<?php echo $hdd;?>";

	}
	
	function checksom(){
		
		var fn = document.f1;
		var checksom = "";
		var stat2 = false;

		if(document.getElementById("hn").value != "" && fn.repeat.checked == false){

			url = 'trauma.php?action=checksom&hn=' + document.getElementById("hn").value+'&date_in='+fn.date_in.value;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			checksom = xmlhttp.responseText;

			if(checksom.length > 4){
				
				stat2 = confirm(checksom.substr(4));
				
			}else{
				stat2 = true;
			}
				
		}else{

			alert("กรุณากรอก HN ด้วยครับ");
		}

		return stat2;

	}

	function checkForm(){
		var fn = document.f1;
		var checksom = "";
		var stat = true;
		var stat2 = true;
		var txt = "";
		
		<?php if($_GET["action"] != "edit"){?>
		if(document.getElementById("hn").value != "" && fn.repeat.checked == false){

			url = 'trauma.php?action=checksom&hn=' + document.getElementById("hn").value+'&date_in='+fn.date_in.value;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			checksom = xmlhttp.responseText;

			if(checksom.length > 4){
				
				stat2 = confirm(checksom.substr(4));
				
			}		

		}
		<?php
			}	
		?>

		if(document.f1.hn.value == ""){
			txt = txt + "กรุณา กรอก HN ด้วยครับ \n";
			stat = false;
		}
		if(fn.list_ptright.value == "P01"){
			txt = txt + "กรุณา เลือก สิทธิ์ ของคนไข้ด้วยครับ \n";
			stat = false;
		}

		if(fn.doctor.value == ""){
			txt = txt + "กรุณากรอก ข้อมูลแพทย์ผู้รักษา ด้วยครับ \n";
			fn.doctor.focus();
			stat = false;
		}


		if(fn.trauma.value == ""){
			txt = txt + "กรุณา เลือก รายการ Trauma, Non Trauma หรือ OPD ครับ \n";
			fn.trauma.focus();
			stat = false;
		}

		if(fn.obs[0].checked == false && fn.obs[1].checked == false){
			txt = txt + "กรุณา เลือก รายการ Observe หรือ Non Observe ครับ \n";
			stat = false;
		}
		
		
		if(fn.trauma.value == "trauma"){
			
			if(fn.type_accident[0].checked == false  && fn.type_accident[1].checked == false){
				txt = txt + "กรุณา เลือก สาเหตุของการบาดเจ็บ ด้วยครับ \n";
				fn.type_accident[0].focus();
				stat = false;
			}

			if(fn.type_accident[0].checked == true){
				if(fn.accident_detail.value == "A01"){
					txt = txt + "สาเหตุของการบาดเจ็บ กรุณา เลือก รายการ อุบัติเหตุอื่นๆ ด้วยครับ \n";
					fn.accident_detail.focus();
					stat = false;
				}
			}else if(fn.type_accident[1].checked == true){

				if(fn.wounded_detail.value !='W03' && fn.wounded_vehicle.value == "0"){
					txt = txt + "กรุณาเลือกรายการ พาหนะผู้บาดเจ็บ ด้วยครับ \n";
					fn.wounded_vehicle.focus();
					stat = false;
				}else{
					
					if(fn.wounded_vehicle.value == "V01" || fn.wounded_vehicle.value == "V02"){
						if(fn.wounded_detail.value !='W03' && fn.helmet.value == ""){
							txt = txt + "กรุณากรอกข้อมูล พฤติกรรมเสี่ยง ผู้ป่วยสวมหมวกนิรภัยหรือไม่ ? \n";
							fn.helmet.focus();
							stat = false;
						}
					}else{
						if(fn.wounded_detail.value !='W03' && fn.belt.value == ""){
							txt = txt + "กรุณากรอกข้อมูล พฤติกรรมเสี่ยง ผู้ป่วยคาดเข็มขัดนิรภัยหรือไม่ ? \n";
							fn.belt.focus();
							stat = false;
						}
					}


				}

				if(fn.wounded_detail.value == "0"){
					txt = txt + "กรุณาเลือกรายการ ลักษณะผู้บาดเจ็บ ด้วยครับ \n";
					fn.wounded_detail.focus();
					stat = false;
				}

				if(fn.cause_accident[0].checked == false && fn.cause_accident[1].checked == false && fn.cause_accident[2].checked == false ){
					txt = txt + "กรุณาเลือกรายการ การบาดเจ็บเกิดจาก ด้วยครับ \n";
					fn.cause_accident[0].focus();
					stat = false;
				}

				if( fn.cause_accident[2].checked == true && (fn.with_cause_accident.value == "" && fn.list_with_cause_accident.value == "0") ){
					txt = txt + "กรุณากรอกข้อมูล ผู้ป่วยชนกับ ?\n";
					fn.with_cause_accident.focus();
					stat = false;
				}

				if(fn.spirits.value == ""){
					txt = txt + "กรุณากรอกข้อมูล พฤติกรรมเสี่ยง ผู้ป่วยดื่มสุราหรือไม่ ? \n";
					fn.spirits.focus();
					stat = false;
				}

			}


		}
		
		if(fn.sender[0].checked == false && fn.sender[1].checked == false && fn.sender[2].checked == false && fn.sender[3].checked == false && fn.sender[4].checked == false && fn.sender[5].checked == false ){
					txt = txt + "กรุณาเลือก รายการผู้นำส่ง ด้วยครับ\n";
					fn.sender[0].focus();
					stat = false;
				}

				if(fn.sender[5].checked == true && fn.etc_sender.value == "" ){
					txt = txt + "กรุณากรอกข้อมูลผู้นำส่งอื่นๆ ด้วยครับ\n";
					fn.etc_sender.focus();
					stat = false;
				}

		if(fn.cure[0].checked == false  && fn.cure[1].checked == false  && fn.cure[2].checked == false  && fn.cure[3].checked == false && fn.cure[4].checked == false ){
			txt = txt + "กรุณา เลือก ผลการรักษา ด้วยครับ \n";
			fn.cure[0].focus();
			stat = false;
		}

		if(fn.cure[2].checked == true ){
			if(fn.cause_refer.value == ""){
				txt = txt + "กรุณา กรอก สาเหตุการ Refer \n";
				fn.cause_refer.focus();
				stat = false;
			}

			if(fn.type_patient.value == ""){
				txt = txt + "กรุณา กรอก ประเภทของคนไข้  \n";
				fn.type_patient.focus();
				stat = false;
			}

			if(fn.refer_hospital.value == ""){
				txt = txt + "กรุณา กรอกข้อมูล Refer ที่ โรงพยาบาล \n";
				fn.refer_hospital.focus();
				stat = false;
			}

			if(fn.doc_refer.checked == false && fn.nurse.checked == false && fn.assistant_nurse.checked == false && fn.estimate.checked == false && fn.cradle.checked == false && fn.doc_txt.checked == false && fn.suggestion.checked == false){
				txt = txt + "กรุณา เลือก หมายเหตุ ของการ refer ด้วยครับ \n";
				fn.no_estimate.focus();
				stat = false;
			}

			if(fn.estimate.checked == true && fn.no_estimate.value == ""){
				txt = txt + "กรุณา หมายเลข แบบประเมิน รพ.ลำปาง \n";
				fn.no_estimate.focus();
				stat = false;
			}

		}

		if( fn.trauma.value != "opd" && (fn.time_diag1.value == "")){
			if( ( fn.type_wounded.value == "1" || fn.type_wounded.value == "2" )){
				
				txt = txt + "กรุณา กรอก เวลาที่แพทย์ตรวจ ด้วยครับ \n";
					fn.time_diag1.focus();
					stat = false;

			}else if( ( fn.type_wounded2.value == "1" || fn.type_wounded2.value == "2" )){
				txt = txt + "กรุณา กรอก เวลาที่แพทย์ตรวจ ด้วยครับ  \n";
					fn.time_diag1.focus();
					stat = false;
			}
		}

		if(fn.cure[0].checked == true  && fn.admit_ward.value == ""){
			txt = txt + "กรุณา เลือก ward ที่ Admin คนไข้ ด้วยครับ \n";
			fn.admit_ward.focus();
			stat = false;
		}

		if(fn.cure[2].checked == true  && fn.refer_hospital.value == ""){
			txt = txt + "กรุณา กรอก ชื่อโรงพยาบาลที่ Refer คนไข้ด้วยครับ \n";
			fn.refer_hospital.focus();
			stat = false;
		}

		if(fn.date_in.value == ""){
			txt = txt + "กรุณา กรอก วันที่ผู้ป่วยเข้ารับการตรวจ ด้วยครับ \n";
			fn.date_in.focus();
			stat = false;
		}
		
		if(fn.time_in1.value == "" || fn.time_out1.value == "" ){
			txt = txt + "กรุณา กรอกเวลาเข้า/ออก ด้วยครับ \n";
			stat = false;
		}

		if(stat == false && stat2 == true)
			alert(txt);

		return stat;

	}

	function control_layer(xxx){
		document.getElementById("Layer_admit").style.display = 'none';
		document.getElementById("Layer_refer").style.display = 'none';
		document.getElementById("Layer_dc").style.display = 'none';
		if(xxx != "")
			document.getElementById(xxx).style.display = '';
	}

	function add_bylist(xxx ,yyy){
		xxx.value = yyy;
	}

	function add_bylist2(xxx ,yyy){
		var comma ;
		if(xxx.value != ""){
			comma = ", ";
		}else{
			comma = "";
		}
		xxx.value += comma+yyy;
	}

	function function_doctor(value){
			
			if(value != "แพทย์จากโรงพยาบาลอื่น")
				document.getElementById("doctor").value = value;
			else
				document.getElementById("doctor").value = "";
	}

	function check_alert(xxx){
		var yyy;
		if(document.f1.type_wounded.value != xxx)
			alert("ผู้ป่วยมีอาการเปลี่ยนแปลงเนื่องจากท่านเลือก 'ประเภท' ไม่เหมือนกัน ? ");

	}


</script>

<script type="text/javascript">
	function check_number_hn(event) {
		e_k = event.which || event.keyCode;
		if ( ((e_k >= 48) && (e_k <= 57)) || e_k == 45 || e_k == 8 ) {
			return true;
		}else{
			
			if( event.preventDefault ){
				event.preventDefault();
			}else{
				event.returnValue = false;
			}
			
			// event.returnValue = false;
			// alert("สามารถพิมพ์ HN เป็น ตัวเลข และเครื่องหมาย - เท่านั้นครับ");
			return false;
		}
	}

	function check_number_vn() {
		e_k = event.which || event.keyCode;
		if (((e_k >= 48) && (e_k <= 57)) ) {
			return true;
		}else{
			event.returnValue = false;
			alert("สามารถพิมพ์ VN เป็น ตัวเลข เท่านั้นครับ");
			return false;
		}
	}

	function check_number_an() {
	e_k=event.keyCode
		if (((e_k >= 48) && (e_k <= 57)) || e_k ==47 ) {
			return true;
		}else{
			event.returnValue = false;
			alert("สามารถพิมพ์ AN เป็น ตัวเลข และเครื่องหมาย / เท่านั้นครับ");
			return false;
		}
	}



	function calbmi(a,b){
		//alert(a);
		var h=a/100;
		var bmi=b/(h*h);
		document.f1.bmi.value=bmi.toFixed(2);
	}
	 </script>
   <? 
		 $ht = $arr["height"]/100;
		 $bmi=number_format($arr["weight"]/($ht*$ht),2);
	?>
    	
</script>

<TABLE width="100%" border="0">
<TR valign="top">
	<TD width="470" valign="top">
<FORM name="f1" METHOD=POST ACTION="" Onsubmit="return checkForm();">
<TABLE  border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE border="0">
<TR>
	<TD align="center"  bgcolor="#3366FF" class="font_title" colspan ="8">การบันทึกประวัติผู้ป่วย ER</TD>
</TR>
<TR>
	<TD width="77" align="right">Hn</TD>
	<TD colspan="7">
	<INPUT TYPE="text" ID="hn" NAME="hn" size="6" value="<?php echo $arr["hn"];?>" onKeyPress="check_number_hn(event);" title="สามารถพิมพ์ HN เป็น ตัวเลข และเครื่องหมาย - เท่านั้น">&nbsp;<INPUT TYPE="button" value="View" Onclick="if(checksom()){viewdetail('view',document.getElementById('hn').value);document.getElementById('vn').value='';}">
	&nbsp;<INPUT TYPE="button" value="ซักประวัติ" Onclick="window.open('basic_opd.php?close=true&hn='+document.getElementById('hn').value);"> &nbsp;
	<INPUT TYPE="button" value="ดูผล LAB" Onclick="window.open('report_lablst.php?close=true&hn='+document.getElementById('hn').value);">
	
	<script type="text/javascript">
		var input_hn = document.getElementById("hn");
		if( input_hn.addEventListener ){
			input_hn.addEventListener("blur", hn_blur, true);
		} else { // สำหรับ IE
			input_hn.attachEvent("onblur", hn_blur, true);
		}
	
		function hn_blur(){
			
			if( input_hn.value === '' ){
				return false;
			}
			
			// ส่งค่าไปตรวจสอบ AN กับ VN
			url = 'trauma.php?action=get_hn_an&hn=' + input_hn.value;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			txt = xmlhttp.responseText;
			
			var res = JSON.parse(txt);
			if( res.status  === 200 ){
				document.getElementById("vn").value = ( res.vn === null ) ? '' : res.vn ;
				document.getElementById("an").value = ( res.an === null ) ? '' : res.an ;
			}
		}
	</script>	</TD>
</TR>
<TR>
	<TD align="right">Vn</TD><TD colspan="7">
	<INPUT TYPE="text" id="vn" NAME="vn" size="6" value="<?php echo $arr["vn"];?>" onKeyPress="check_number_vn();">
	&nbsp;<INPUT TYPE="button" value="Lab ผป. นอก" Onclick="if(document.getElementById('vn').value !=''){window.open('trauma_lab.php?vn='+document.getElementById('vn').value,'_blank');document.getElementById('vn').value='';}else{alert('กรุณากรอก VN ด้วยครับ');}" >
	&nbsp;<INPUT TYPE="button" value="X-RAY ผป. นอก" Onclick="if(document.getElementById('vn').value !=''){window.open('trauma_xray.php?vn='+document.getElementById('vn').value,'_blank');document.getElementById('vn').value='';}else{alert('กรุณากรอก VN ด้วยครับ');}" > 
	</TD>
</TR>
<TR>
	<TD align="right">AN</TD><TD colspan="7">
	<INPUT TYPE="text" id="an" NAME="an" size="6" value="<?php echo $arr["an"];?>" onKeyPress="check_number_an();">&nbsp;<INPUT TYPE="button" value="คิดเงิน ผป. ใน" onClick="if(document.f1.an.value !=''){window.open('eripage.php?get_hn='+document.f1.an.value,'_blank');} else{alert('กรุณากรอก AN');}">&nbsp;
	<INPUT TYPE="button" value="ค่าใช้จ่าย" onClick="view_expenses(document.f1.an.value);">
	&nbsp;
	<button onClick="print_sticker_an(event)">Stick ผป.ใน</button>
	
	<script tyep="text/javascript">
		function print_sticker_an(event){
			
			if( event.preventDefault ){
				event.preventDefault();
			}else{
				event.returnValue = false;
			}
			
			var an = document.getElementById('an').value;
			// var hn = document.getElementById('hn').value;
			if( an === '' ){
				alert('กรุณาใส่ AN');
				return false;
			}
			
			window.open('anchkstk_er.php?Can='+an);
		}
	</script>
    
	<script tyep="text/javascript">
		function print_sticker_ipd(event){
			
			if( event.preventDefault ){
				event.preventDefault();
			}else{
				event.returnValue = false;
			}
			
			var hn = document.getElementById('hn').value;
			// var hn = document.getElementById('hn').value;
			if( hn === '' ){
				alert('กรุณาใส่ hn');
				return false;
			}
			
			window.open('hnchkstk_er.php?Chn='+hn);
		}
	</script>    
	
	</TD>
</TR>
<TR>
  <TD align="right">&nbsp;</TD>
  <TD colspan="7"><button onClick="print_sticker_ipd(event)">Stick ผป.นอก</button></TD>
</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD colspan="6" ><span id="div_viewdetail"></span></TD>
</TR>
<TR>
	<TD  align="right" valign="top">สิทธิ์หลัก</TD><TD width="197">
		<SELECT NAME="list_ptright">
		<?php
			foreach($list_ptright as $key => $value){
				echo "<Option value='".$key."' ";
					if($key == $arr["list_ptright"]) echo " Selected ";
				echo ">".$value."</Option>";
			}
		?>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD  align="right" valign="top">สิทธิ์รอง</TD><TD>
		<SELECT NAME="list_ptright2">
		<?php
			foreach($list_ptright as $key => $value){
				echo "<Option value='".$key."' ";
					if($key == $arr["list_ptright2"]) echo " Selected ";
				echo ">".$value."</Option>";
			}
		?>
		</SELECT>
	</TD>
</TR>
<TR>
  <TD  align="right" valign="top">น้ำหนัก</TD>
  <TD valign="top" colspan="5"><input name="weight" type="text" id="weight" size="3" value="<?php echo $weight;?>"  onblur="calbmi(document.f1.height.value,this.value)"/>
                 กก.</TD>
  <td valign="top">&nbsp;</td>
</TR>
<TR>
  <TD  align="right" valign="top">ส่วนสูง</TD>
  <TD valign="top" colspan="5"><input name="height" type="text" id="height" size="3" value="<?php echo $height;?>"  onblur="calbmi(this.value,document.f1.weight.value)"/>
ซม.</TD>
  <td valign="top">&nbsp;</td>
</TR>
<TR>
  <TD  align="right" valign="top">ค่า BMI</TD>
  <TD valign="top" colspan="5"><input name="bmi" type="text" size="3" maxlength="5" value="<?php echo $bmi;?>" /></TD>
  <td valign="top">&nbsp;</td>
</TR>
<TR>
	<TD  align="right" valign="top">โรคประจำตัว</TD><TD valign="top" colspan="5">
		<TEXTAREA ID="disease_people" NAME="disease_people" ROWS="3" COLS="30"><?php echo $arr["disease_people"];?></TEXTAREA>
	</TD>
    <td width="51" valign="top">
		<INPUT TYPE="button" value="ปฏิเสธ" Onclick="document.getElementById('disease_people').value='ปฏิเสธ'; ">    </td>    
</TR>
<TR>
	<TD  align="right"  valign="top">การแพ้ยา</TD><TD colspan="5" valign="top">
		<TEXTAREA ID="drug_alert" NAME="drug_alert" ROWS="3" COLS="30"><?php echo $arr["drug_alert"];?></TEXTAREA>
		
	</TD>
    <td width="53" valign="top">
		<INPUT TYPE="button" value="ปฏิเสธ" Onclick="document.getElementById('drug_alert').value='ปฏิเสธ'; ">    </td>
</TR>
<TR>
	<TD  align="right" valign="top">Dx</TD><TD colspan="5">
		<TEXTAREA id="dx" NAME="dx" ROWS="3" COLS="30"><?php echo $arr["dx"];?></TEXTAREA>
	</TD>
</TR>
<TR>
	<TD  align="right" valign="top">อาการ</TD><TD colspan="5" valign="top">
		<TEXTAREA ID="organ" NAME="organ" ROWS="3" COLS="30"><?php echo $arr["organ"];?></TEXTAREA>
        &nbsp;<BR>
		<FONT COLOR="#FF0000">ตัวช่วย : </FONT>
		<SELECT NAME="choose_organ" Onchange="document.getElementById('organ').value = document.getElementById('organ').value+' '+this.value;">
			<option value="">-----------</option>
			<option value="ตรวจตามนัด">ตรวจตามนัด</option>
			<option value="ฉีดยาตามนัด">ฉีดยาตามนัด</option>
			<option value="ต่อใบนัดทำแผล">ต่อใบนัดทำแผล</option>
			<option value="รับจาก OPD">รับจาก OPD</option>
            <option value="รับจากจุดคัดกรอง">รับจากจุดคัดกรอง</option>
			<option value="ตัดไหม">ตัดไหม ตามนัด</option>
		</SELECT>
	</TD>
    <TD width="110" valign="top">
        <div><INPUT TYPE="button" value="รับจากจุดคัดกรอง" Onclick="document.getElementById('organ').value='รับจากจุดคัดกรอง'; "></div>
        <div style="margin-top:10px;"><INPUT TYPE="button" value="รับจาก OPD" Onclick="document.getElementById('organ').value='รับจาก OPD'; "></div>    </TD>    
</TR>
<TR>
	<TD  align="right" valign="top">การรักษา</TD><TD colspan="5">
		<TEXTAREA ID="maintenance" NAME="maintenance" ROWS="3" COLS="30"><?php echo $arr["maintenance"];?></TEXTAREA>&nbsp;		<BR>
		<FONT COLOR="#FF0000"><a style="CURSOR: pointer" onClick="if(document.f1.choose_maintenance.style.display=='none'){document.f1.choose_maintenance.style.display=''}else{document.f1.choose_maintenance.style.display='none'}">ตัวช่วย(tv.)</a> : </FONT>
		<SELECT NAME="choose_maintenance" Onchange="document.getElementById('maintenance').value = document.getElementById('maintenance').value+' '+this.value; document.f1.choose_maintenance.style.display='none';" multiple="multiple"  SIZE="10" style="position: absolute; display:none;">
			<option value="">-----------</option>
			<option value="verorab 1 amp. M">verorab 1 amp. M</option>
			<option value="T.T. 0.5 ml M">T.T. 0.5 ml M</option>
			<option value="Go-on เข็ม ">Go-on เข็ม</option>
			<option value="Synvisc เข็ม ">Synvisc เข็ม</option>
			<option value="Hyruan เข็ม ">Hyruan เข็ม</option>
			<option value="Cef-3 2 gm + 0.9 nss 100 ml v drip in 1/2 hr.">Cef-3 2 gm + 0.9 nss 100 ml v drip in 1/2 hr.</option>
			<option value="รับยา, advice">รับยา, advice</option>
			<option value="D/S OD">D/S OD</option>
			<option value="Stitch Off">Stitch Off</option>
			<option value="rest , Observe อาการ">rest , Observe อาการ</option>
			<option value="ดีขึ้นกลับบ้านได้">ดีขึ้นกลับบ้านได้</option>
			<option value="อาการไม่ดีขึ้น รายงานแพทย์">อาการไม่ดีขึ้น รายงานแพทย์</option>
			<option value="consult">consult</option>
			<option value="ใบรับรองแพทย์">ใบรับรองแพทย์</option>
			<option value="FU">FU</option>
			<option value="eye irrigation c nss 100 ml">eye irrigation c nss 100 ml</option>
			<option value="เจาะ lab">เจาะ lab</option>
			<option value="สั่ง x-ray">สั่ง x-ray</option>
			<option value="admitจากคลินิก">admitจากคลินิก</option>
			<option value="admit">admit</option>
			<option value="refer">refer</option>
			<option value="suture">suture</option>
			<option value="off staple">off staple</option>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD  align="right" valign="top">Doctor</TD><TD colspan="6">
		<INPUT TYPE="text"  ID="doctor" NAME="doctor" value="<?php echo $arr["doctor"];?>">

		<select size="1" name="doctor2" Onchange="function_doctor(this.value)">

<option value="" selected>-----------------------</option>

<?php

	$sql = "Select name From doctor where erstatus = 'y' AND row_id != '0' Order by name ASC ";
	$result = Mysql_Query($sql);
	
	while(list($name) = Mysql_fetch_row($result)){
		echo "<option value=\"".$name."\" ";
			if($arr["doctor"] == $name) echo " Selected ";
		echo ">".$name."</option>";
	}
?>
			<option value="แพทย์จากโรงพยาบาลอื่น" <?php if($arr["doctor"] == "แพทย์จากโรงพยาบาลอื่น") echo " Selected ";?> >แพทย์จากโรงพยาบาลอื่น</option>
		</select>


	</TD>
</TR>
<TR>
	<TD  align="right" valign="top">&nbsp;</TD><TD colspan="6">
		<SELECT NAME="trauma" Onchange=" hidden_block(this.value);">
			<Option value="">--------</Option>
			<Option value="trauma" <?php if($arr["trauma"] == "trauma") echo " Selected ";?>>Trauma</Option>
			<Option value="nontrauma" <?php if($arr["trauma"] == "nontrauma") echo " Selected ";?>>Non Trauma</Option>
			<Option value="opd" <?php if($arr["trauma"] == "opd") echo " Selected ";?>>OPD</Option>
	</SELECT>

	</TD>
</TR>
<TR>
	<TD  align="right" valign="top">&nbsp;</TD><TD colspan="6">
		<INPUT TYPE="radio" NAME="obs" value="1" <?php if($arr["obs"] == "1") echo " Checked ";?>>Observe &nbsp;&nbsp;&nbsp;  <INPUT TYPE="radio" NAME="obs" value="0" <?php if($arr["obs"] == "0") echo " Checked ";?>>Non Observe
	</TD>
</TR>
<TR>
	<TD  align="right" valign="top">ประเภท</TD><TD  colspan="5">
		<SELECT NAME="type_wounded">
			<Option value="1" <?php if($arr["type_wounded"] == "1") echo " Selected ";?>>1</Option>
			<Option value="2" <?php if($arr["type_wounded"] == "2") echo " Selected ";?>>2</Option>
			<Option value="3" <?php if($arr["type_wounded"] == "3") echo " Selected ";?>>3</Option>
			<Option value="4" <?php if($arr["type_wounded"] == "4") echo " Selected ";?>>4</Option>
            <Option value="5" <?php if($arr["type_wounded"] == "5") echo " Selected ";?>>5</Option>
	</SELECT>
	</TD>
</TR>
<TR>
	<TD  align="right" valign="top">ประเภท</TD><TD  colspan="5">
		<SELECT NAME="type_wounded2" Onchange="check_alert(this.value);">
			<Option value="" >-</Option>
			<Option value="1" <?php if($arr["type_wounded2"] == "1") echo " Selected ";?>>1</Option>
			<Option value="2" <?php if($arr["type_wounded2"] == "2") echo " Selected ";?>>2</Option>
			<Option value="3" <?php if($arr["type_wounded2"] == "3") echo " Selected ";?>>3</Option>
			<Option value="4" <?php if($arr["type_wounded2"] == "4") echo " Selected ";?>>4</Option>
            <Option value="5" <?php if($arr["type_wounded2"] == "5") echo " Selected ";?>>5</Option>
	</SELECT>&nbsp;<FONT COLOR="#FF0000">* ผู้ป่วยมีการเปลี่ยนแปลง</FONT>
	</TD>
</TR>
<TR>
	<TD align="right" valign="top">CPG : </TD><TD  colspan="5">
		<TABLE border='0'>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="cpg[]" VALUE="10" <?php if(isset($cpg["10"])) echo "Checked"; ?> Onclick="if(this.checked == true && !confirm('คุณต้องการลงบันทึกการทำ copd ใช่หรือไม่?')){ return false;}"> COPD</TD>
		</TR>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="cpg[]" VALUE="20" <?php if(isset($cpg["20"])) echo "Checked"; ?> Onclick="if(this.checked == true && !confirm('คุณต้องการลงบันทึกการทำ MI ใช่หรือไม่?')){ return false;}"> MI</TD>
		</TR>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="cpg[]" VALUE="30" <?php if(isset($cpg["30"])) echo "Checked"; ?> Onclick="if(this.checked == true && !confirm('คุณต้องการลงบันทึกการทำ sepsis ใช่หรือไม่?')){ return false;}"> sepsis</TD>
		</TR>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="cpg[]" VALUE="40" <?php if(isset($cpg["40"])) echo "Checked"; ?> Onclick="if(this.checked == true && !confirm('คุณต้องการลงบันทึกการทำ head injury ใช่หรือไม่?')){ return false;}" > head injury</TD>
		</TR>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="cpg[]" VALUE="50" <?php if(isset($cpg["50"])) echo "Checked"; ?> Onclick="if(this.checked == true && !confirm('คุณต้องการลงบันทึกการทำ Stroke Fast track ใช่หรือไม่?')){ return false;}" >Stroke Fast track</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD colspan="2">
		จำนวนหัตถการ : <INPUT TYPE="text" id="total_lst_labcare" NAME="total_lst_labcare" size="2" maxlength="2" onkeypress = "if(event.keyCode == 13){ create_lst_labcare('<?php echo $total_lst_labcare;?>'); return false; }else{ check_number();}" value="<?php echo $total_lst_labcare;?>">
		<BR><?php echo $div_list_lst_labcare;?>
		<div id="list_lst_labcare">		</div><BR>
		จำนวนหัตถการ อื่นๆ : <INPUT TYPE="text" id="total_labcare" NAME="total_labcare" size="2" maxlength="2" onkeypress = "if(event.keyCode == 13){ create_labcare('<?php echo $total_labcare;?>'); return false; }else{ check_number();}" value="<?php echo $total_labcare;?>">
		<BR><?php echo $div_list_labcare;?>
		<div id="list_labcare">		</div>	</TD>
</TR>
<TR id="block1">
	<TD  align="right">สาเหตุของ<BR>การบาดเจ็บ</TD><TD colspan="5" >&nbsp;&nbsp;<INPUT TYPE="radio" NAME="type_accident" value="2"<?php if($arr["type_accident"] == "2") echo " Checked ";?> onClick="block2.style.display='none';">อุบัติเหตุอื่นๆ&nbsp;&nbsp;
	<SELECT NAME="accident_detail">
		<?php
			foreach($list_accident_detail as $key => $value){
				echo "<Option value='".$key."' ";
					if($key == $arr["accident_detail"]) echo " Selected ";
				echo ">".$value."</Option>";
			}
		?>
	</SELECT><BR>
	&nbsp;&nbsp;<INPUT TYPE="radio" NAME="type_accident" value="1" <?php if($arr["type_accident"] == "1") echo " Checked ";?> onClick="block2.style.display='';">จราจร
	
	</TD>
</TR>
<TR>
	<TD  colspan ="8">

		<TABLE  id="block2">
		<TR valign="top">
			<TD>

			<TABLE border='0'>
			<TR>
				<TD>พาหนะผู้บาดเจ็บ</TD>
				<TD colspan="2">
					<SELECT NAME="wounded_vehicle">
						
						<?php
							foreach($list_vehicle as $key => $value){
								echo "<Option value='".$key."' ";
									if($key == $arr["wounded_vehicle"]) echo " Selected ";
								echo ">".$value."</Option>";
							}
						?>
					</SELECT>				</TD>
			</TR>
			<TR>
				<TD>ลักษณะผู้บาดเจ็บ</TD>
				<TD colspan="2">
					<SELECT NAME="wounded_detail">
						
					<?php
							foreach($list_wounded as $key => $value){
								echo "<Option value='".$key."'  ";
									if($key == $arr["wounded_detail"]) echo " Selected ";
								echo ">".$value."</Option>";
							}
						?>
					</SELECT>				</TD>
			</TR>
			<TR>
				<TD>การบาดเจ็บเกิดจาก</TD>
				<TD><INPUT TYPE="radio"  NAME="cause_accident" value="1"  <?php if($arr["cause_accident"] == "1") echo " Checked ";?>></TD>
				<TD>ตกจากยานพาหนะ</TD>
			</TR>
			<TR>
				<TD>&nbsp;</TD>
				<TD><INPUT TYPE="radio" NAME="cause_accident" value="2" <?php if($arr["cause_accident"] == "2") echo " Checked ";?>></TD>
				<TD>พาหนะล้มคว่ำ ตกล้มจม</TD>
			</TR>
			<TR>
				<TD>&nbsp;</TD>
				<TD><INPUT TYPE="radio" NAME="cause_accident" value="3" <?php if($arr["cause_accident"] == "3") echo " Checked ";?>></TD>
				<TD>ถูกชนกับ <INPUT TYPE="text" NAME="with_cause_accident" size="7" value="<?php echo $arr["with_cause_accident"];?>"></TD>
			</TR>
			<TR>
				<TD colspan="3" align="right">
					<FONT COLOR="#FF0000">ถูกชนกับ :</FONT> <SELECT NAME="list_with_cause_accident" >
						
						<?php
							foreach($list_vehicle as $key => $value){
								echo "<Option value='".$key."' ";
									if($key == $arr["list_with_cause_accident"]) echo " Selected ";
								echo ">".$value."</Option>";
							}
						?>
					</SELECT>				</TD>
			</TR>
			<TR>
				<TD colspan="3"><INPUT TYPE="checkbox" NAME="out_changwat" value="1" <?php if($arr["out_changwat"] == "1") echo "Checked"; ?>>&nbsp;ประสบอุบัติเหตุต่างจังหวัด</TD>
			</TR>
			</TABLE>			</TD>
			<TD>
			<TABLE border='0'>
			<TR>
				<TD colspan="3">พฤติกรรมเสี่ยง</TD>
			</TR>
			<TR>
				<TD>ดื่มสุรา</TD>
				<TD colspan="2"><SELECT NAME="spirits">
								<Option value="">-------</Option>
								<Option value="1" <?php if($arr["spirits"] == "1") echo " Selected ";?>>ดื่ม</Option>
								<Option value="0" <?php if($arr["spirits"] == "0") echo " Selected ";?>>ไม่ดื่ม</Option>
								<Option value="2" <?php if($arr["spirits"] == "2") echo " Selected ";?>>ไม่ทราบ</Option>
							</SELECT>				</TD>
			</TR>
			<TR>
				<TD>เข็มขัดนิรภัย</TD>
				<TD colspan="2"><SELECT NAME="belt">
								<Option value="">-------</Option>
								<Option value="1" <?php if($arr["belt"] == "1") echo " Selected ";?>>ใช้</Option>
								<Option value="0" <?php if($arr["belt"] == "0") echo " Selected ";?>>ไม่ใช้</Option>
								<Option value="2" <?php if($arr["belt"] == "2") echo " Selected ";?>>ไม่ทราบ</Option>
							</SELECT>				</TD>
			</TR>
			<TR>
				<TD>หมวกนิรภัย</TD>
				<TD colspan="2"><SELECT NAME="helmet">
								<Option value="">-------</Option>
								<Option value="1" <?php if($arr["helmet"] == "1") echo " Selected ";?>>ใช้</Option>
								<Option value="0" <?php if($arr["helmet"] == "0") echo " Selected ";?>>ไม่ใช้</Option>
								<Option value="2" <?php if($arr["helmet"] == "2") echo " Selected ";?>>ไม่ทราบ</Option>
							</SELECT>				</TD>
			</TR>
			</TABLE>			</TD>
		</TR>
		</TABLE>	</TD>
</TR>
<TR>
  <TD>ผู้นำส่ง</TD>
  <TD colspan="7"><INPUT TYPE="radio" NAME="sender" value="1" <?php if($arr["sender"] ==1) echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.spName.style.display='none';}">
&nbsp;มาเอง </TD>
</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD colspan="7"><INPUT TYPE="radio" NAME="sender" value="2" <?php if($arr["sender"] ==2) echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.spName.style.display='';}">
	&nbsp;ALS  <span id="spName" style="display:none"><INPUT TYPE="radio" NAME="als_sender" value="รพ.ค่ายสุรศักดิ์มนตรี" <?php if($arr["als_sender"] == "ค่ายสุรศักดิ์มนตรี") echo " Checked ";?>> รพ.ค่ายฯ <INPUT TYPE="radio" NAME="als_sender" value="รพ.อื่นๆ" <?php if($arr["als_sender"] == "รพ.อื่นๆ") echo " Checked ";?>> รพ.อื่นๆ </span></TD> 
</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD colspan="7"><INPUT TYPE="radio" NAME="sender" value="3" <?php if($arr["sender"] ==3) echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.spName.style.display='none';}">
	&nbsp;BLS</TD>
</TR>
<TR>
  <TD>&nbsp;</TD>
  <TD colspan="7"><input type="radio" name="sender" value="4" <?php if($arr["sender"] ==4) echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.spName.style.display='none';}">
    &nbsp;FR</TD>
</TR>
<TR>
  <TD>&nbsp;</TD>
  <TD colspan="7"><INPUT TYPE="radio" NAME="sender" value="5" <?php if($arr["sender"] ==5) echo " Checked ";?>>&nbsp;อื่นๆ<INPUT TYPE="text" NAME="etc_sender" size="7" value="<?php echo $arr["etc_sender"];?>"></TD>
</TR>
<!--<TR>
  <TD>&nbsp;</TD>
  <TD colspan="7"><input type="radio" name="sender" value="6" <?php//if($arr["sender"] == "6") echo " Checked ";?>>
    &nbsp;กู้ชีพ รพ.ค่าย</TD>
</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD colspan="7"><INPUT TYPE="radio" NAME="sender" value="4" <?php//if($arr["sender"] == "4") echo " Checked ";?>>&nbsp;1669</TD>
</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD colspan="7"><INPUT TYPE="radio" NAME="sender" value="3" <?php//if($arr["sender"] == "3") echo " Checked ";?>>&nbsp;อื่นๆ<INPUT TYPE="text" NAME="etc_sender" size="7" value="<?php//echo $arr["etc_sender"];?>"></TD>
</TR>-->
<TR>
	<TD  colspan ="8">
		ผลการรักษา&nbsp;&nbsp;

		<TABLE>
		<TR>
			<TD><INPUT TYPE="radio" NAME="cure" onClick="control_layer('Layer_admit');" value="admit" <?php if($arr["cure"] == "admit") echo " Checked ";?>></TD>
			<TD>Admit</TD>
			<TD><INPUT TYPE="radio" NAME="cure" onClick="control_layer('Layer_dc');" value="d/c" <?php if($arr["cure"] == "dic" || $arr["cure"] == "d/c") echo " Checked ";?>></TD>
			<TD>D/C </TD>
			<TD><INPUT TYPE="radio" NAME="cure" onClick="control_layer('Layer_refer');" value="refer" <?php if($arr["cure"] == "refer") echo " Checked ";?>></TD>
			<TD>Refer</TD>
			<TD><INPUT TYPE="radio" NAME="cure" onClick="control_layer('');" value="death" <?php if($arr["cure"] == "death") echo " Checked ";?>></TD>
			<TD>Death</TD>
			<TD><INPUT TYPE="radio" NAME="cure" onClick="control_layer('');" value="no" <?php if($arr["cure"] == "no") echo " Checked ";?>>ไม่รอรับบริการ</TD>
		</TR>
		<TR>
			<TD>ส่งต่อ</TD>
			<TD>
				<SELECT NAME="to_etc">
					<Option value="">---------</Option>
					<Option value="ส่งต่อ OR" <?php if($arr["to_etc"] == "ส่งต่อ OR") echo " Selected ";?>>OR</Option>
					<Option value="ส่งต่อ LR" <?php if($arr["to_etc"] == "ส่งต่อ LR") echo " Selected ";?>>LR</Option>
					<Option value="ส่งต่อ ไตเทียม" <?php if($arr["to_etc"] == "ส่งต่อ ไตเทียม") echo " Selected ";?>>ไตเทียม</Option>
					<Option value="ส่งต่อ OPD" <?php if($arr["to_etc"] == "ส่งต่อ OPD") echo " Selected ";?>>OPD</Option>
					<Option value="ส่งต่อ กายภาพ" <?php if($arr["to_etc"] == "ส่งต่อ กายภาพ") echo " Selected ";?>>กายภาพ</Option>
					<Option value="ส่งต่อ ทันตกรรม" <?php if($arr["to_etc"] == "ส่งต่อ ทันตกรรม") echo " Selected ";?>>ทันตกรรม</Option>
					<Option value="ส่งต่อ ฝั่งเข็ม" <?php if($arr["to_etc"] == "ส่งต่อ ฝั่งเข็ม") echo " Selected ";?>>ฝั่งเข็ม</Option>
				</SELECT>			</TD>
			<TD><!-- <INPUT TYPE="checkbox" NAME="to_or" value="1" <?php// if($arr["to_or"] == "1") echo " Checked ";?>> --></TD>
			<TD><!-- ส่งต่อ OR --></TD>
			<TD><!-- <INPUT TYPE="checkbox" NAME="to_lr"  value="1" <?php// if($arr["to_lr"] == "1") echo " Checked ";?>> --></TD>
			<TD><!-- ส่งต่อ LR --></TD>
			
			<TD></TD>
			<TD></TD>
			<TD></TD>
		</TR>
		</TABLE>

		 
		<table>
			<tr>
				<td><label for="freshWound">แผลสด : </label></td>
				<td>
				<input type="checkbox" name="freshWound" id="freshWound" value="1">&nbsp;เป็นมาแล้ว&nbsp;<select name="woundhours" id="woundhours">
						<option value="">เลือกข้อมูล</option>
						<?php 
						for ($i=1; $i <= 24; $i++) { 
							?><option value="<?=$i;?>"><?=$i;?></option><?php
						}
						?>
					</select> ชั่วโมง				</td>
			</tr>
		</table>
		
		
		
		
		<?php if($arr["next_ka"] == "1") echo " <FONT COLOR=\"blue\"><B>[ ยกยอดเวร ]</B></FONT> ";?>
		&nbsp;<BR>
	
	<INPUT TYPE="checkbox" NAME="repeat" value="1" <?php if($arr["repeat"] == "1") echo " Checked ";?>>มาตรวจซ้ำ<BR>
	<DIV style="background-color: #D6D6D6" ID="Layer_admit" <?php  if($arr["cure"] != "admit"){ ?>style="display:none"<?php } ?>>
		&nbsp;Admit ที่ Ward : <SELECT NAME="admit_ward">
										<Option value="">-----------------</Option>
										<Option value="รวม" <?php if($arr["admit_ward"] == "รวม") echo " Selected ";?>>หอผู้ป่วยรวม</Option>
										<Option value="พิเศษ" <?php if($arr["admit_ward"] == "พิเศษ") echo " Selected ";?>>หอผู้ป่วยพิเศษ</Option>
										<Option value="icu" <?php if($arr["admit_ward"] == "icu") echo " Selected ";?>>หอผู้ป่วย ICU</Option>
										<Option value="สูติ" <?php if($arr["admit_ward"] == "สูติ") echo " Selected ";?>>หอผู้ป่วยสูติ</Option>
										</SELECT>
		</DIV>

		<DIV  style="background-color: #D6D6D6" ID="Layer_refer"  <?php  if($arr["cure"] != "refer"){ ?>style="display:none"<?php } ?>>
		&nbsp;&nbsp;&nbsp;สาเหตุการ Refer : <INPUT TYPE="text" NAME="cause_refer" size ="16" value="<?php echo $arr["cause_refer"];?>">&nbsp;
		
		<SELECT NAME="list_cause_refer" Onchange="add_bylist(document.f1.cause_refer, this.value);">
										<Option value="">-----------------</Option>
										<Option value="เตียงเต็ม" >เตียงเต็ม</Option>
										<Option value="ICU เต็ม" >ICU เต็ม</Option>
										<Option value="Propermangement" >Propermangement</Option>
										<Option value="สิทธิ์รักษา รพ. ลำปาง">สิทธิ์รักษา รพ. ลำปาง</Option>
										<Option value="พบแพทย์เฉพาะทาง">พบแพทย์เฉพาะทาง</Option>
										</SELECT><BR>
		&nbsp;&nbsp;&nbsp;ประเภทของคนไข้ : <INPUT TYPE="text" NAME="type_patient" size ="12" value="<?php echo $arr["type_patient"];?>">&nbsp;<SELECT NAME="list_type_patient" Onchange="add_bylist(document.f1.type_patient, this.value);">
										<Option value="">--------</Option>
										<Option value="Med" >Med</Option>
										<Option value="Sx" >Sx</Option>
										<Option value="Ortho">Ortho</Option>
										<Option value="OB. Gyne">OB. Gyne</Option>
										<Option value="Ped">Ped</Option>
										<Option value="Eye">Eye</Option>
										<Option value="Ent">Ent</Option>
										<Option value="Psycho">Psycho</Option>
										</SELECT><BR>
                                        
                                        &nbsp;&nbsp;&nbsp;วัตุประสงค์/เพื่อ : <INPUT TYPE='radio' NAME='targe' VALUE='1'>ปรึกษา/วินิจฉัย&nbsp;<INPUT TYPE='radio' NAME='targe' VALUE='2'>รักษาแล้วให้ส่งกลับ&nbsp;<INPUT TYPE='radio' NAME='targe' VALUE='3'>โอนย้าย<BR>
                                        
		&nbsp;&nbsp;&nbsp;วิธีการ Refer : <SELECT NAME="means_refer">
										<Option value="รถพยาบาล" <?php if($arr["means_refer"] == "รถพยาบาล") echo " Selected ";?>>รถพยาบาล</Option>
										<Option value="ไปเอง" <?php if($arr["means_refer"] == "ไปเอง") echo " Selected ";?>>ไปเอง</Option>
								</SELECT><BR>
		&nbsp;&nbsp;&nbsp;Refer ที่ โรงพยาบาล : <INPUT TYPE="text" ID="refer_hospital" NAME="refer_hospital" value="<?php echo $arr["refer_hospital"];?>">&nbsp;ตัวช่วย <A HREF="javascript:input_id('refer_hospital','โรงพยาบาลลำปาง'); ">รพ.ศูนย์</A>
		&nbsp;&nbsp;&nbsp;

		<BR>
		&nbsp;&nbsp;&nbsp;Consult แพทย์&nbsp;ก่อน refer: 
		<INPUT ID="consult" TYPE="text" size="30" NAME="consult" value="<?php echo $arr["consult"];?>"><DD><DD><DD>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select ID="consult2" size="1" name="consult2" Onchange="add_bylist2(document.f1.consult, this.value);">
			<option value="">-----------------------</option>
			<option value="เลือก ด่านสว่าง"  > เลือก ด่านสว่าง</option>
			<option value="ณรงค์ ปรีดาอนันทสุข"  > ณรงค์ ปรีดาอนันทสุข</option>
			<option value="อรรณพ ธรรมลักษมี"  > อรรณพ ธรรมลักษมี</option>
			<option value="นภสมร ธรรมลักษมี"  > นภสมร ธรรมลักษมี</option>
			<option value="อนุพงษ์ รอดสาย"  > อนุพงษ์ รอดสาย</option>
			<option value="ธนบดินทร์ ผลศรีนาค"  > ธนบดินทร์ ผลศรีนาค</option>
			<option value="สมัชชา เบี้ยจรัส"  > สมัชชา เบี้ยจรัส</option>
			<option value="ศุภชัย คูสุวรรณ"  > ศุภชัย คูสุวรรณ</option>
			<option value="อัศวิน แก้วเนตร"  > อัศวิน แก้วเนตร</option>
			<option value="สิทธิชัย จิตสมจินต์"  > สิทธิชัย จิตสมจินต์</option>
			<option value="หนึ่งฤทัย มหายศนันท์"  > หนึ่งฤทัย มหายศนันท์</option>
			<option value="เกื้อกูล ผสมทรัพย์"  > เกื้อกูล ผสมทรัพย์</option>
			<option value="ศุภสิทธิ์  คงมีผล"  > ศุภสิทธิ์  คงมีผล</option>
			<option value="ปฏิพงค์  ศรีทิภัณฑ์"  > ปฏิพงค์  ศรีทิภัณฑ์</option>
			<option value="วรวิทย์ วงษ์มณี"  >วรวิทย์ วงษ์มณี</option>
			<option value="วีระยุทธ์ วงศ์จันทร์"  >วีระยุทธ์ วงศ์จันทร์</option>
			<option value="ธิติ  สุธีรศานต์"  >ธิติ  สุธีรศานต์</option>
			<option value="เอกวิทย์ หาญกิติพงศ์ไพศาล"  > เอกวิทย์ หาญกิติพงศ์ไพศาล</option>
			<option value="สุรวุฒิ เอื้อคณิต"  >สุรวุฒิ เอื้อคณิต</option>
			<option value="วันชาติ นำประเสริฐชัย"  >วันชาติ นำประเสริฐชัย</option>
			<option value="สุรภัทร ศรีนนท์"  >สุรภัทร ศรีนนท์</option>
			<option value="ศรายุทธ กาญจนธารายนต์"  >ศรายุทธ กาญจนธารายนต์</option>
			<option value="กฤษดากร ไวทยโยธิน"  >กฤษดากร ไวทยโยธิน</option>
			<option value="ทองแดง  อาฒยะพันธ์" >ทองแดง  อาฒยะพันธ์</option>
			<option value="วุฒิไชย  อิศระ"  >วุฒิไชย  อิศระ</option>
			<option value="นิธิไชย  บุญไชย"  >นิธิไชย  บุญไชย</option>
			<option value="การุณย์  สุริยวงศ์พงศา"  >การุณย์  สุริยวงศ์พงศา</option>
			<option value="กระสิน  เขียวปิง"  >กระสิน  เขียวปิง</option>
			<option value="พิพิธ  บุรัสการ"  >พิพิธ  บุรัสการ</option>
			<option value="ไพบูลย์  คูหเพ็ญแสง"  >ไพบูลย์  คูหเพ็ญแสง</option>
			<option value="ไปรยา ธรรมสอน" >ไปรยา ธรรมสอน</option>
			<option value="ชัยเนตรอาร์ เนตรพิชิต"  >ชัยเนตรอาร์ เนตรพิชิต</option>
			<option value="ปิยะบุตร บุญมี"  >ปิยะบุตร บุญมี</option>
		</select>
		<BR>
		
		&nbsp;&nbsp;&nbsp;เบอร์โทรศัพท์ผู้ป่วย : <INPUT TYPE="text" NAME="er_tell" value="<?php echo $arr["er_tell"];?>"><BR>
		&nbsp;&nbsp;&nbsp;ปัญหาการ Refer : <TEXTAREA NAME="problem_refer" ROWS="3" COLS="35"><?php echo $arr["problem_refer"];?></TEXTAREA><BR>
		

		<TABLE>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="take_care" value="1" <?php if($arr["take_care"] == "1") echo " Checked ";?>></TD>
			<TD>ได้รับการดูแลทันที</TD>
			<TD></TD>
			<TD></TD>
			<TD></TD>
			<TD></TD>
		</TR>

		<TR>
			<TD colspan="6">หมายเหตุ : </TD>
		</TR>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="doc_refer" value="1" <?php if($arr["doc_refer"] == "1") echo " Checked ";?>></TD>
			<TD>ใบ Refer</TD>
			<TD><INPUT TYPE="checkbox" NAME="nurse" value="1" <?php if($arr["nurse"] == "1") echo " Checked ";?>></TD>
			<TD>พยาบาล</TD>
			<TD><INPUT TYPE="checkbox" NAME="assistant_nurse" value="1" <?php if($arr["assistant_nurse"] == "1") echo " Checked ";?>></TD>
			<TD>ผู้ช่วย</TD>
			<TD><INPUT TYPE="checkbox" NAME="suggestion" value="1" <?php if($arr["suggestion"] == "1") echo " Checked ";?>></TD>
			<TD>ให้คำแนะนำ</TD>
		</TR>
		<TR valign="top">
			<TD><INPUT TYPE="checkbox" NAME="estimate" value="1" <?php if($arr["estimate"] == "1") echo " Checked ";?>></TD>
			<TD>แบบประเมิน รพ.ลำปาง<BR>หมายเลข <INPUT TYPE="text" NAME="no_estimate" value="<?php echo $arr["no_estimate"];?>" size="5"></TD>
			<TD><INPUT TYPE="checkbox" NAME="cradle" value="1" <?php if($arr["cradle"] == "1") echo " Checked ";?>></TD>
			<TD>เปล</TD>
			<TD><INPUT TYPE="checkbox" NAME="doc_txt" value="1" <?php if($arr["doc_txt"] == "1") echo " Checked ";?>></TD>
			<TD>ใบบันทึกข้อความ</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
		</TR>
		</TABLE>

		 
		</DIV>

		<DIV style="background-color: #D6D6D6" ID="Layer_dc" <?php  if($arr["cure"] != "d/c"){ ?>style="display:none"<?php } ?>>
		<TABLE>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="to_hpt_lp" value="1" <?php if($arr["to_hpt_lp"] == "1") echo " Checked ";?>></TD>
			<TD>แนะนำรักษาต่อโรงพยาบาลลำปาง</TD>
		</TR>
		</TABLE>
		</DIV>
		
		วันที่ผู้ป่วยเข้ารับการตรวจ&nbsp;
		
		<INPUT TYPE="text" ID="date_in" NAME="date_in" value="<?php if($arr["date_in"] ==""){echo (date("Y")+543).date("-m-d"); $ss=mktime(0,0,0,date("m"),date("d"),date("Y"));}else{ echo $arr["date_in"];$ss=mktime(0,0,0,substr($arr["date_in"],5,2),substr($arr["date_in"],-2),substr($arr["date_in"],0,4)-543);}?>" size="11"> 
		<?php
		if($arr["date_in"] =="" || $arr["date_in"] == (date("Y")+543).date("-m-d")){	
		?>
		<A HREF="javascript:void(0);" Onclick="document.getElementById('date_in').value = '<?php echo (date("Y",($ss-86400))+543).date("-m-d",($ss-86400));?>';" ><?php echo (date("Y",($ss-86400))+543).date("-m-d",($ss-86400));?></A>
		&nbsp;
		<A HREF="javascript:void(0);" Onclick="document.getElementById('date_in').value = '<?php echo (date("Y",($ss))+543).date("-m-d",($ss));?>';" ><?php echo (date("Y",($ss))+543).date("-m-d",($ss));?></A>
		&nbsp;
		<A HREF="javascript:void(0);" Onclick="document.getElementById('date_in').value = '<?php echo (date("Y",($ss-86400))+543).date("-m-d",($ss+86400));?>';" ><?php echo (date("Y",($ss-86400))+543).date("-m-d",($ss+86400));?></A>
		<?php } ?>
		
		
		<BR><FONT COLOR="red"><B>* รูปแบบของวันที่ 5 มิถุนายน 2552 = 2552-06-05</B></FONT>
		<BR>

เวลาเข้า&nbsp;&nbsp;
		<INPUT TYPE="text" NAME="time_in1" maxlength="4" size="2" value="<?php echo $select_time_in1;?><?php echo $select_time_in2;?>" onKeyPress="check_number()"> น.

		<BR>
		เวลาที่แพทย์ตรวจ&nbsp;&nbsp;
		<INPUT TYPE="text" NAME="time_diag1" maxlength="4" size="2" value="<?php echo $select_time_diag1;?><?php echo $select_time_diag2;?>" onKeyPress="check_number()"> น.
		<BR>
เวลาออก&nbsp;
		<INPUT TYPE="text" NAME="time_out1" maxlength="4" size="2" value="<?php echo $select_time_out1;?><?php echo $select_time_out2;?>" onKeyPress="check_number()"> น.	</TD>
</TR>
<TR>
	<TD  colspan ="8">	</TD>
</TR>
</TABLE>
<?php 
	echo $hidden;
	echo $button,"<BR>";
?>

</TD>
</TR>
</TABLE>
</FORM>
<a name="cf"></a>

<script LANGUAGE="JavaScript">

function rediv(xx){
	if(xx == "inj"){
		setTimeout("view_confirm_inj('reconfirm_inj','');",3000);
	}else if(xx == "ds"){
		setTimeout("view_confirm_ds('reconfirm_ds','');",3000);
	}

}

</script>

<FORM name="form_confirn_inject" METHOD=POST ACTION="confirn_inject2.php" onSubmit=" rediv('inj')" target="_blank">
<DIV ID="Div_Confirm_inject">
<TABLE  width="100%"  border="1" bordercolor="#3366FF">
<TR>
	<TD>
		<table width="100%" border="0" align="center">
      <tr align="center" bgcolor="#3366FF" class="font_title">
        <td >ยืนยันการฉีดยา</td>
      </tr>
	  <tr>
        <td >
			HN : <INPUT TYPE="text" NAME="hn">
		</td>
      </tr>
	  <tr>
        <td >
		<INPUT TYPE="button" value=" ตกลง " onClick="view_confirm_inj('confirm_inj',document.form_confirn_inject.hn.value);">
		</td>
      </tr>
	  </table>
	  </TD>
</TR>
</TABLE>
</Div>
</FORM>
<FORM name="form_confirn_ds" METHOD=POST ACTION="confirn_ds2.php" onSubmit=" rediv('ds')" target="_blank" >
<Div ID="Div_Confirm_ds">
<TABLE  width="100%"  border="1" bordercolor="#3366FF">
<TR>
	<TD>
		<table width="100%" border="0" align="center">
      <tr align="center" bgcolor="#3366FF" class="font_title">
        <td >ยืนยันการทำแผล</td>
      </tr>
	  <tr>
        <td >
			HN : <INPUT TYPE="text" NAME="hn">
		</td>
      </tr>
	  <tr>
        <td >
		<INPUT TYPE="button" value=" ตกลง " onClick="view_confirm_ds('confirm_ds',document.form_confirn_ds.hn.value);">
		</td>
      </tr>
	  </table>
	  </TD>
</TR>
</TABLE>
</DIV>
</FORM>
</TD>
	<TD valign="top">
	
	<!--  -->
	
	<TABLE width="100%" border="0">
	<TR>
		<TD>
		<FORM METHOD=GET ACTION="">
		<TABLE border="1" bordercolor="#3366FF">
		<TR>
			<TD class="font_title" align="center" bgcolor="#3366FF">
		<B>ค้นหา</B>
		</TD>
		</TR>
		<TR>
			<TD>
		วันที่ : <INPUT TYPE="text" NAME="search_date" id="search_date" size="10" readonly> <input type="button" name="calendar_button" value="....." onClick="showCalendar('search_date','YY-MM-DD')"><BR>
		HN : <INPUT TYPE="text" NAME="search_hn" size="10"><BR>
		<CENTER><INPUT TYPE="submit" value="ค้นหา"></CENTER>
		</TD>
		</TR>
		</TABLE>
		</FORM>

		
		</TD>
		<TD align="right" valign="bottom">

		<?php
			
			$where ="";
			if($_REQUEST["search_hn"] != "")
			$where .=" hn = '".$_REQUEST["search_hn"]."' AND ";
			if($_REQUEST["search_date"] != "")
			$where .= "date_in = '".$_REQUEST["search_date"]."' AND ";
			
			if($where != ""){
				$where = " where ".$where; 
				$where = substr($where,0,-4);
			}

			if($where == ""){
				$where = " where  date_in = '".(date("Y")+543).date("-m-d")."' ";
			}

			$sql = "Select count(row_id) as count_tb From trauma ".$where;
			list($rows) = Mysql_fetch_row(Mysql_Query($sql));
			
			if(empty($_GET["page"]))
				$_GET["page"] = 1;

			$max = 30;
			if($rows <= $max){
				$total_page = 1;
				$limit = "  limit 0,".$max." ";
			}else{
				$xxx = number_format($rows/$max,0,",","");
				if($rows%2 == 1) $i=1; else $i=0;
				$total_page = $xxx + $i;
				$start = $max*($_GET["page"]-1);
				$limit = "  limit ".$start.",".$max." ";
			}
			

			echo "<FORM METHOD=GET ACTION=\"\">";
			echo "หน้า <INPUT TYPE=\"text\" NAME=\"page\" onkeypress = \"if(event.keyCode != 13){ check_number();}\" size=\"2\" value=\"".$_GET["page"]."\"> of ".$total_page;
			echo "<INPUT TYPE=\"hidden\" name=\"search_date\" value=\"".$_REQUEST["search_date"]."\">";
			echo "<INPUT TYPE=\"hidden\" name=\"search_hn\" value=\"".$_REQUEST["search_hn"]."\">";
			echo "</FORM>";
		?>
	</TD>
	</TR>
	</TABLE>
	<table width="100%"  border="1" bordercolor="#3366FF">
  <tr>
    <td ><table width="100%" border="0" align="center">
      <tr align="center" bgcolor="#3366FF" class="font_title">
        <td >วันที่รักษา</td>
		<td >เวลา</td>
        <td >HN</td>
        <td >DX/อาการ/การรักษา</td>
		<td >ปภ</td>
		<td >trauma</td>

		<td >ลบ</td>
      </tr>
	  <?php
		

		//$sql = "Select a.row_id, date_format(a.date_in,'%d/%m/%y') as f_date, left(a.time_in,5) as time_in2, CONCAT(a.time_in,' ',date_format(a.date,'%H:%i:%s')) as h_date , a.vn, a.hn, a.dx, a.trauma, a.type_wounded, CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name From trauma as a, opcard as b where a.hn = b.hn Order by date_in DESC,  h_date desc ".$limit;
		

		$sql = "Select a.row_id, date_format(a.date_in,'%d/%m/%y') as f_date, left(a.time_in,5) as time_in2, CONCAT(a.time_in,' ',date_format(a.date,'%H:%i:%s')) as h_date , a.vn, a.hn, a.dx, a.organ, a.maintenance, a.trauma, a.type_wounded, a.type_wounded2,next_ka, doctor From trauma as a ".$where."  Order by date_in DESC,  h_date desc ".$limit;


		$result = Mysql_Query($sql) or die(Mysql_Error());

$list_hn = array();

		while($arr = Mysql_fetch_assoc($result)){
			array_push($list_hn,$arr["hn"]);
		}

	$sql = "Select hn, CONCAT(yot,' ',name,' ',surname) as full_name From opcard where hn in ('".implode("','",$list_hn)."') ";
	$result2 = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result2)){

		$hn[$arr["hn"]] = $arr["full_name"];

	}

		mysql_data_seek  ( $result , 0);
		$i=0;
		while($arr = Mysql_fetch_assoc($result)){
			if($i%2 == 0){
				$bgcolor = "#FFFFB7";
			}else{
				$bgcolor = "#FFFFFF";
			}
			$i++;
	  ?>
      <tr bgcolor="<?php echo $bgcolor;?>">
        <td align="center">
		
			<?php echo $arr["f_date"];?><BR>
			<?php if($arr["next_ka"] == "1") echo "<FONT COLOR=\"#3300FF\">[ยกยอดเวร]</FONT>";?>
			
		</td>
		<td align="center"><a href="javascript:void(0);" 
		Onclick="if(confirm('ท่านต้องการใบบส่งตัวผู้ป่วย Lab หรือไม่?'))
							{window.open('er_stiker_lab.php?hn=<?php echo urlencode($arr["hn"]);?>&p1=true&p2=true','_blank');}
							else
							{window.open('er_stiker_lab.php?hn=<?php echo urlencode($arr["hn"]);?>&p2=true','_blank');
							}" ><?php echo $arr["time_in2"];?></A></td>
        <td><A HREF="trauma.php?action=edit&id=<?php echo $arr["row_id"];?>" onmouseover= "show_tooltip('<?php echo $hn[$arr["hn"]];?>','center',0,0);" onMouseOut="hid_tooltip();" style="text-decoration:none;"><?php echo $arr["hn"];?></A></td>
        <td>
		<TABLE>
		<TR>
			<TD align='right'>DX : </TD>
			<TD>
				<A HREF="javascript:void(0);" Onclick="document.getElementById('dx').value='<?php echo $arr["dx"];?>';" style="color: #0000FF;text-decoration:none;"><?php echo $arr["dx"];?></A>
			</TD>
		</TR>
		<TR>
			<TD align='right'>อาการ : </TD>
			<TD><A HREF="javascript:void(0);" <?php if(strlen($arr["organ"]) > 18){?> Onclick="document.getElementById('organ').value='<?php echo $arr["organ"];?>';" onmouseover= "show_tooltip('<?php echo jschars($arr["organ"]);?>','left',0,0);" onMouseOut="hid_tooltip();" <?php }else{ ?><?php }?> style="color: #0000FF;text-decoration:none;"><?php echo substr($arr["organ"],0,18); if(strlen($arr["organ"]) > 18) echo " ...";?></A></TD>
		</TR>
		<TR>
			<TD align='right'>รักษา : </TD>
			<TD><A HREF="javascript:void(0);" <?php if(strlen($arr["maintenance"]) > 18){?> onmouseover= "show_tooltip('<?php echo jschars($arr["maintenance"]);?>','left',0,0);" onMouseOut="hid_tooltip();" <?php }else{ ?> Onclick="document.getElementById('maintenance').value='<?php echo $arr["maintenance"];?>';" <?php }?>  style="color: #0000FF;text-decoration:none;"><?php echo substr($arr["maintenance"],0,18); if(strlen($arr["maintenance"]) > 18) echo " ...";?></A></TD>
		</TR>
		</TABLE>
		
		
		</td>
		<td><?php echo $arr["type_wounded"],",&nbsp;&nbsp;",$arr["type_wounded2"];?></td>
		<td align="center"><?php if($arr["trauma"]=="nontrauma") echo "non<BR>trauma"; else echo $arr["trauma"];?></td>
		<td align="center"><A HREF="#" onClick="if(confirm('ท่านต้องการลบรายการนี้ใช้หรือไม่')){ window.location.href='<?php echo $_SERVER['PHP_MYSELF'];?>?action=del&id=<?php echo $arr["row_id"];?>'; }">ลบ</A><BR><BR><A HREF="consent4.php?id=<?php echo $arr["row_id"]; ?>&hn=<?php echo urlencode($arr["hn"]); ?>&doctor=<?php echo urlencode($arr["doctor"]);?>" target="_blank">ใบยินยอม</A></td>
      </tr>
	  <?php }?>
    </table></td>
  </tr>
</table>
	<!--  -->
	
	</TD>
</TR>
</TABLE>

</body>
</html>
<?php include("unconnect.inc");?>
