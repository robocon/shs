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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
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
			case '�': $sex = "���"; break;
			case '�': $sex = "˭ԧ"; break;
			default : $sex = "<FONT COLOR='#FF000000'><B>�����ŧ������</B></FONT>"; break;
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

		echo $arr["yot"]." ".$arr["name"]." ".$arr["surname"]."  ���� : ".calcage($arr["dbirth"])." �� : ".$sex."  <BR>�Է��� : ".$arr["ptright"]."  tel : ".$arr["phone"]."&nbsp;�������Ǣ�ͧ : ".$arr["ptffone"]."<BR><center>$image</center><A HREF=\"consent4.php?hn=".urlencode($_GET["hn"])."\" target=\"_blank\">�͡��Թ���</A>";
		exit();
	}
	
	if(isset($_GET["action"]) && $_GET["action"] =="checksom"){
		//header("content-type: application/x-javascript; charset=TIS-620");
			
		$sql = "Select hn, date_format(date,'%d/%m/%Y %H:%m:%s') as datetime2  From trauma where hn='".$_GET["hn"]."' AND date_in = '".$_GET["date_in"]."'  limit 1";
		$result = Mysql_Query($sql) or die(mysql_error());
		$arr = Mysql_fetch_assoc($result);
		$rows = Mysql_num_rows($result);
		if($rows > 0)
			echo "��ҹ�ºѹ�֡ HN : ".$arr["hn"]." ������ѹ���� ".$arr["datetime2"]." \n ��ҹ��ͧ��úѹ�֡ HN ����ա�����������?";
		else
			echo "";
		
		exit();
	}
	

	if(isset($_GET["action"]) && $_GET["action"] =="drugreact"){
		//header("content-type: application/x-javascript; charset=TIS-620");

		$sql = "Select tradname, advreact  From drugreact where hn='".$_GET["hn"]."' ";
		$result = Mysql_Query($sql) or die(mysql_error());
		while($arr = Mysql_fetch_assoc($result)){
			echo "����".$arr["tradname"]." �ҡ�� ".$arr["advreact"]." \n";
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
		
			
			if($arr["congenital_disease"] == "����ʸ" || $arr["congenital_disease"] == "����ʸ�ä��Шӵ��"){
				
				$sql = "Select disease_people From trauma where hn='".$_GET["hn"]."' AND disease_people not in ('','����ʸ','����','����ʸ') Order by row_id limit 1";
				$result = mysql_query($sql);
				$rows = mysql_num_rows($result);
				if($rows > 0){
					list($disease_people) = mysql_fetch_row($result);
					echo $disease_people;
				}else{
					echo "����ʸ";
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
							<td >�׹�ѹ��éմ��</td>
						  </tr>
						  <tr>
							<td >";

							if($ptname != ""){
								echo "HN : ".$_GET["hn"]."<BR>";
								echo "����-ʡ�� : ".$ptname."<BR>";
								echo "�Է��� : ".$ptright."<BR>";
		
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
			
			echo "<B>�� </B>".$tradname;

			echo "&nbsp;&nbsp;<B>������</B> 
						<SELECT NAME=\"number[]\">
							<Option value=\"1\" >1</Option>
							<Option value=\"2\" >2</Option>
							<Option value=\"3\" >3</Option>
							<Option value=\"4\" >4</Option>
							<Option value=\"5\" >5</Option>
						</SELECT>
							";

			echo "&nbsp;&nbsp;<B>�Ըթմ</B> 
						<SELECT NAME=\"type[]\">
							<Option value=\"V\" ".$IV.">V</Option>
							<Option value=\"M\" ".$IM.">M</Option>
							<Option value=\"SC\" ".$SC.">SC</Option>
							<Option value=\"NO\" >���Ѻ</Option>
						</SELECT>
						";
			echo "<BR><BR>";

			$sql = "Select unit From druglst where drugcode = '".$drugcode."' limit 1 ";
			list($unit) = mysql_fetch_row(mysql_query($sql));

			echo "&nbsp;&nbsp;<B>�ӹǹ���մ</B> : ".$drug_inject_amount;
			echo "&nbsp;&nbsp;<B>�մẺ</B> : ".$drug_inject_type;
			echo "&nbsp;&nbsp;<B>�ӹǹ������</B> : ".$amount." ".$unit;
			echo "&nbsp;&nbsp;<B>����</B> : ".$drug_inject_etc;
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
				<input type="checkbox" name="isOpd" id="isOpd" value="1" checked="checked"> OPD�մ�� 
			</label>
			<?php
		}
		
		$submit_button = "<INPUT TYPE=\"submit\" value=\" ��ŧ \" >";
		}else{
								echo "����������Ţ HN : ".$_GET["hn"]."";
								$submit_button = "";
		}
		echo "
							</td>
						  </tr>
						  <tr>
							<td >
							".$submit_button."&nbsp;<INPUT TYPE=\"button\" value=\"¡��ԡ\" onclick=\"view_confirm_inj('reconfirm_inj',document.form_confirn_inject.hn.value);\">
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
							<td >�׹�ѹ��÷���</td>
						  </tr>
						  <tr>
							<td >";

							if($ptname != ""){
								echo "HN : ".$_GET["hn"]."<BR>";
								echo "����-ʡ�� : ".$ptname."<BR>";
								echo "�Է��� : ".$ptright."<br>";
								if($_SESSION['smenucode']=="ADMMAINOPD")
								{
									?>
									<label for="isOpd">
										<input type="checkbox" name="isOpd" id="isOpd" value="1" checked="checked"> OPD����
									</label>
									<br>
									<?php
								}
								$submit_button = "<INPUT TYPE=\"submit\" value=\" ��ŧ \" >";
							}else{
								echo "����������Ţ HN : ".$_GET["hn"]."";
								$submit_button = "";
							}

			echo "
							</td>
						  </tr>
						  <tr>
							<td >
							".$submit_button."&nbsp;<INPUT TYPE=\"button\" value=\"¡��ԡ\" onclick=\"view_confirm_ds('reconfirm_ds',document.form_confirn_ds.hn.value);\">
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
							<td >�׹�ѹ��éմ��</td>
						  </tr>
						  <tr>
							<td >
								HN : <INPUT TYPE=\"text\" NAME=\"hn\" id=\"form_confirn_inject_hn\">
							</td>
						  </tr>
						  <tr>
							<td >
							<INPUT TYPE=\"button\" value=\" ��ŧ \" onclick=\"view_confirm_inj('confirm_inj',document.getElementById('form_confirn_inject_hn').value);\">
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
							<td >�׹�ѹ��÷���</td>
						  </tr>
						  <tr>
							<td >
								HN : <INPUT TYPE=\"text\" NAME=\"hn\">
							</td>
						  </tr>
						  <tr>
							<td >
							<INPUT TYPE=\"button\" value=\" ��ŧ \" onclick=\"view_confirm_ds('confirm_ds',document.form_confirn_ds.hn.value);\">
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

	if(isset($_POST["submit"]) && $_POST["submit"] == "����������"){

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
			if(trim($_POST["disease_people"]) != "����ʸ"){
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
			$obj->setrefertype("2 �觵��");
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


		// �ѹ�֡��������� ADMISSION 
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
		// �ѹ�֡��������� ADMISSION
		
		
		if($result){
			
			echo "<CENTER><B>�ѹ�֡���������º��������</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; ��Ѻ</A></CENTER>";

		}else{

			echo "<CENTER><B>�������ö�ѹ�֡���������سҵԡ�������������</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; ��Ѻ</A></CENTER>";

		}
		
		//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=trauma.php\">";
		exit();
	}else if(isset($_POST["submit"]) && $_POST["submit"] == "��䢢�����"){
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

			if(trim($_POST["disease_people"]) != "����ʸ"){
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
			$obj->setrefertype("2 �觵��");
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

		// �ѹ�֡��������� ADMISSION 
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

		// �ѹ�֡��������� ADMISSION 


		if($result){
			
			echo "<CENTER><B>��䢢��������º��������</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; ��Ѻ</A></CENTER>";

		}else{

			echo "<CENTER><B>�������ö��䢢��������سҵԡ�������������</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; ��Ѻ</A></CENTER>";

		}
		
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=trauma.php\">";
		exit();
	}if(isset($_POST["submit"]) && $_POST["submit"] == "¡�ʹ���"){
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
			$obj->setrefertype("2 �觵��");
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
			
			echo "<CENTER><B>�ѹ�֡���������º��������</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; ��Ѻ</A></CENTER>";

		}else{

			echo "<CENTER><B>�������ö�ѹ�֡���������سҵԡ�������������</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; ��Ѻ</A></CENTER>";

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
			
			echo "<CENTER><B>ź���������º��������</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; ��Ѻ</A></CENTER>";

		}else{

			echo "<CENTER><B>�������öź���������سҵԡ�������������</B><BR><A HREF=\"#\" Onclick=\"window.location.href='trauma.php';\">&lt;&lt; ��Ѻ</A></CENTER>";

		}
		
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=trauma.php\">";
		exit();
	}







	$list_vehicle = array();
	
	$list_vehicle["0"] = "-------";
	$list_vehicle["V01"] = "�ѡ��ҹ���������";
	$list_vehicle["V02"] = "�ѡ��ҹ¹��";
	$list_vehicle["V03"] = "ö��";
	$list_vehicle["V04"] = "ö�ԡ���";
	$list_vehicle["V11"] = "ö���";
	$list_vehicle["V12"] = "����������ͧ ��� ���";
	$list_vehicle["V05"] = "ö��÷ء˹ѡ ����� 6 ��� ����";
	$list_vehicle["V06"] = "ö��ǧ";
	$list_vehicle["V07"] = "ö�·ҧ 2 ��";
	$list_vehicle["V08"] = "ö����ú��";
	$list_vehicle["V09"] = "����";
	$list_vehicle["V10"] = "����Һ";

	$list_wounded = array();
	
	$list_wounded["0"] = "-------";
	$list_wounded["W01"] = "���Ѻ���";
	$list_wounded["W02"] = "��������";
	$list_wounded["W03"] = "���Թ���";
	$list_wounded["W04"] = "����Һ";

	$list_accident_detail = array();


$list_accident_detail["A01"] = "-------";
$list_accident_detail["A02"] = "��Ѵ �� ����ˡ��� (W00 � W19)�";
$list_accident_detail["A03"] = "�����ʡѺ�ç�ԧ���ѵ����觢ͧ (W20 � W49)�";
$list_accident_detail["A04"] = "�����ʡѺ�ç�ԧ�Ţͧ�ѵ�� / �� (W50 � W64)�";
$list_accident_detail["A05"] = "��õ���� ����� (W65 � W74)�";
$list_accident_detail["A06"] = "�ء���������� (W75 � W84)�";
$list_accident_detail["A07"] = "�����ʡ����俿�� �ѧ������س����� (W85 � W99)�";
$list_accident_detail["A08"] = "�����ʤ�ѹ� ������� (X00 � X09)�";
$list_accident_detail["A09"] = "�����ʤ�����͹ �ͧ��͹ (X10 � X19)�";
$list_accident_detail["A10"] = "�����ʾ�ɨҡ�ѵ�����;ת (X20 � X29)�";
$list_accident_detail["A11"] = "�����ʾ�ѧ�ҹ�ҡ�����ҵ� (X30 � X39)�";
$list_accident_detail["A12"] = "�����ʾ����������� � (X40 � X49)�";
$list_accident_detail["A13"] = "����͡�ç�Թ (X50 � X57)�";
$list_accident_detail["A14"] = "�����ʡѺ��觷������Һ��Ѵ (X58 � X59)�";
$list_accident_detail["A15"] = "�����µ���ͧ�����Ըյ�ҧ  �  (X60 � X84)�";
$list_accident_detail["A16"] = "�١�����´����Ըյ�ҧ � (X85 � Y09)�";
$list_accident_detail["A17"] = "�Ҵ��������Һਵ�� (Y10 � Y33)�";
$list_accident_detail["A18"] = "���Թ��÷ҧ����������ʧ���� (Y35 � Y36)�";
$list_accident_detail["A19"] = "����Һ������˵����ਵ�� (Y34)�";

$list_labcare = array();

$list_labcare["L01"] = "-------";
$list_labcare["L28"] = "���µ� / �Դ��";
$list_labcare["L29"] = "�մ��� ER / IM";
$list_labcare["L30"] = "�մ��� ER / IV";
$list_labcare["L31"] = "�մ��� ER / SC";
$list_labcare["L15"] = "��� DTX";
$list_labcare["L16"] = "������ʹ / �� specimen";
$list_labcare["L32"] = "������մ����� (Synvise / GO-ON / KA / Hyruan)";
$list_labcare["L33"] = "������մ Needle puncture";
$list_labcare["L34"] = "������մ KA";
$list_labcare["L35"] = "����� Aspirate cyst";
$list_labcare["L52"] = "Anterior nasal packing";
$list_labcare["L54"] = "Accupunture";
$list_labcare["L60"] = "Abdominal Tapping";
$list_labcare["L47"] = "aspirate Nail/Aspirate knee/Aspirate hematoma";
$list_labcare["L45"] = "Cold compression";
$list_labcare["L58"] = "CPR";
$list_labcare["L67"] = "Close Reduction";
$list_labcare["L17"] = "Dressing wound";
$list_labcare["L66"] = "Drip ��";
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
$list_labcare["L03"] = "On 02 � Sat.";					
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
$list_labcare["L43"] = "On jones �bandage";
$list_labcare["L44"] = "On skin traction";
$list_labcare["L12"] = "On IVF";
$list_labcare["L13"] = "On Plug / Lock";
$list_labcare["L14"] = "On Blood";
$list_labcare["L21"] = "On NG tube";
$list_labcare["L48"] = "Off NG-Tube";
$list_labcare["L23"] = "On Foley�s catheter";
$list_labcare["L51"] = "Off Foley�s catheter";
$list_labcare["L56"] = "On ET-Tube/ on TT-Tube";
$list_labcare["L53"] ="Pack gauze";
$list_labcare["L63"] ="PR";
$list_labcare["L64"] ="PV";
$list_labcare["L27"] = "Remove FB";
$list_labcare["L18"] = "Suture"; 
$list_labcare["L19"] = "Stitches � off";
$list_labcare["L24"] = "Single catheter / intermittent cath";
$list_labcare["L25"] = "Sponge bath";
$list_labcare["L55"] ="Suction";
$list_labcare["L59"] ="Thoracentesis/ thoracocentesis";
$list_labcare["L62"] ="Throat Swab";
$list_labcare["L68"] ="Xylocaine block";

	$list_ptright = array();
	
	$list_ptright["P01"] = "-------";
	$list_ptright["P02"] = "���� (�)";
	$list_ptright["P03"] = "���� (��)";
	$list_ptright["P04"] = "���� (���)";
	$list_ptright["P05"] = "��ͺ����";
	$list_ptright["P06"] = "�.��";
	$list_ptright["P07"] = "�.";
	$list_ptright["P08"] = "��Сѹ�ѧ��";
	$list_ptright["P09"] = "30�ҷ";
	$list_ptright["P10"] = "30�ҷ�ء�Թ";
	$list_ptright["P11"] = "�ú.";
	$list_ptright["P12"] = "��.44";

?><html>
<head>
<title>��úѹ�֡����ѵԼ����� ER</title>
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
			
			alert("��سҡ�͡ AN ���¤�Ѻ");

		}else{
			url = 'trauma.php?action='+action+'&an=' + an;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			txt = xmlhttp.responseText;
	
	if(txt.length  > 4 ){
		window.open(txt.substr(4),'_blank');
	}else{
		alert('����������Ţ AN ��� ��Ѻ');
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

				document.getElementById("list_lst_labcare").innerHTML = document.getElementById("list_lst_labcare").innerHTML + " "+i+".&nbsp;�ѵ���� : <SELECT NAME='lst_labcare[]'><?php
				foreach($list_labcare as $key => $value){
					echo "<Option value='".$key."' "; if($key == $arr["lst_labcare"]) echo " Selected "; echo ">".$value."</Option> ";
				}
			?></SELECT><BR>�ӹǹ����&nbsp;<INPUT TYPE=\"text\" NAME=\"amount_lst_labcare[]\" size=\"2\" onkeypress=\"check_number();\" value=\"1\"><BR><BR>";

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
				document.getElementById("list_labcare").innerHTML = document.getElementById("list_labcare").innerHTML + " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+i+".&nbsp;�ѵ���� ���� : <INPUT TYPE='text' NAME='labcare[]' >&nbsp�ӹǹ����&nbsp;<INPUT TYPE=\"text\" NAME=\"amount_labcare[]\" size=\"2\" onkeypress=\"check_number();\"  value=\"1\"><BR>";

			}
	}

	function check_number() {
	e_k=event.keyCode
		if (e_k != 47 && e_k != 46 && (e_k < 48) || (e_k > 57)) {
			event.returnValue = false;
			alert("��سҡ�͡�繵���Ţ��ҹ�鹤�Ѻ");
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

echo "<A HREF=\"../nindex.htm\">&lt; &lt; ����</A>&nbsp;|&nbsp;<A HREF=\"confirn_ds.php$urlOpd\" target=\"_blank\">�׹�ѹ��÷���</A>&nbsp;|&nbsp;<A HREF=\"confirn_inject.php$urlOpd\" target=\"_blank\">�׹�ѹ��éմ��</A>&nbsp;|&nbsp;";
?>
<A HREF="javascript:void(0);" Onclick="if(document.getElementById('menu').style.display=='') document.getElementById('menu').style.display='none'; else document.getElementById('menu').style.display=''; ">��§ҹ��ҧ�</A> | <A HREF="consent4.php" target="_blank">��Թ���</A> | <A HREF="erstikerdrug.php" target="_blank">stiker �����</A> | <A HREF="admit_form.php" target="_blank">��ADMIT</A> | <a target=_TOP href="oplist1.php">�����������</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<DIV id="menu" bgcolor="#FFFFFF" style="position: absolute; display:none; "><BR>
<Table bgcolor="#FFFFFF" bordercolor="#0000FF" border="1" cellpadding="2" cellspacing="0">
	<TR>
	<TD bgcolor="#0000FF" align="center">
		<FONT COLOR="#FFFFFF"><B>��§ҹ��ҧ�</B></FONT>
	</TD>
	</TR>
	<TR>
	<TD>
<A HREF="concisely_trun.php<?=$urlOpd;?>" target="_blank">��§ҹ��ػ�ʹ���</A> <BR> <A HREF="report_labcare.php" target="_blank">��¡�úѹ�֡�ѵ���û�Ш��ѹ</A> <BR> 
<A HREF="report_trauma01.php" target="_blank">��§ҹ��ػ</A> <BR> 
<A HREF="report_trauma01_2.php" target="_blank">��§ҹ��ػ(���͡�繪�ǧ)</A> <BR> 
<A HREF="report_trauma02.php" target="_blank">��§ҹ�غѵ��˵ء�è�Ҩ�</A> <BR> 
<A HREF="report_trauma03.php" target="_blank">Ẻ��§ҹ������ѧ��úҴ�� 19 ���˵�</A> <BR> 
<A HREF="report_trauma04.php" target="_blank">Ẻ��§ҹ��úҴ��/���ª��Ե�ҡ�غѵ��˵ب�Ҩâͧ����-��ͺ����</A> <BR> 
<A HREF="report_trauma05.php" target="_blank">��§ҹ�����¹����� ͻ��/1669</A>
<BR> <A HREF="report_ds.php<?=$urlOpd;?>" target="_blank">��ª��ͼ���ҷ���</A>
<BR> <A HREF="report_inject.php<?=$urlOpd;?>" target="_blank">��ª��ͼ���ҩմ��</A>
<BR> <A HREF="report_groupdiag.php" target="_blank">ʶԵԡ�����ä</A>
<BR> <A HREF="report_trauma06.php" target="_blank">��ª��ͼ����� Refer</A>
<BR> <A HREF="report_trauma07.php" target="_blank">��ػ�ʹ�����·���͵�Ǩ�Թ ��˹�</A>
<BR> <A HREF="report_trauma08.php" target="_blank">��ػ�ʹ�����·���ա������¹�ŧ�ҡ��</A>
<BR> <A HREF="report_trauma09.php" target="_blank">��ػ��� Refer ������</A>
<BR> <A HREF="report_trauma10.php" target="_blank">ʶԵ��Է������ѡ��</A>
<BR> <A HREF="report_trauma11.php" target="_blank">��ª������µ����ǧ����</A>
<BR> <A HREF="report_trauma12.php" target="_blank">ʶԵ� CPG</A>
<BR> <A HREF="report_trauma13.php" target="_blank">��ª��ͼ����·���ҵ�Ǩ���</A>
<BR> <A HREF="report_trauma14.php" target="_blank">��§ҹ������ ADMIT ������ 1,2</A>
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

		$button = "<CENTER><INPUT TYPE=\"submit\" name=\"submit\" value=\"��䢢�����\">&nbsp;&nbsp;<INPUT TYPE=\"button\" value=\"¡��ԡ\" onclick=\"window.location.href='trauma.php';\">&nbsp;&nbsp;<INPUT TYPE=\"submit\" name=\"submit\" value=\"¡�ʹ���\"></CENTER>";
		
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
			$div_list_labcare .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$i.".&nbsp;�ѵ���� ���� : <INPUT TYPE='text' NAME='labcare[]' value='".$arr2["labcare"]."'>&nbsp�ӹǹ����&nbsp;<INPUT TYPE=\"text\" NAME=\"amount_labcare[]\" size=\"2\" onkeypress=\"check_number();\" value=\"".$arr2["amount"]."\"><BR>";
			$i++;
		}

		
		$sql = "Select * From trauma_lst_labcare where for_id = '".$_GET["id"]."' AND hn = '".$arr["hn"]."' ";

		$result = Mysql_Query($sql);
		$total_lst_labcare = Mysql_num_rows($result);

		$div_list_lst_labcare = "";
		$i=1;
		while($arr2 = Mysql_fetch_assoc($result)){
			$div_list_lst_labcare .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$i.".&nbsp;�ѵ���� : <SELECT NAME='lst_labcare[]'>";
				foreach($list_labcare as $key => $value){
					$div_list_lst_labcare .= "<Option value='".$key."' "; 
						if($key == $arr2["lst_labcare"]) $div_list_lst_labcare .= " Selected "; 
					$div_list_lst_labcare .= ">".$value."</Option> ";
				}

			$div_list_lst_labcare .= "</SELECT>&nbsp�ӹǹ����&nbsp;<INPUT TYPE=\"text\" NAME=\"amount_lst_labcare[]\" size=\"2\" onkeypress=\"check_number();\"  value=\"".$arr2["amount"]."\"><BR>";
			$i++;
		}

	}else{

		$hidden = "";
		$button = "<CENTER><INPUT TYPE=\"submit\" name=\"submit\" value=\"����������\">&nbsp;&nbsp;<INPUT TYPE=\"reset\" value=\"¡��ԡ\">";
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

			alert("��سҡ�͡ HN ���¤�Ѻ");
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
			txt = txt + "��س� ��͡ HN ���¤�Ѻ \n";
			stat = false;
		}
		if(fn.list_ptright.value == "P01"){
			txt = txt + "��س� ���͡ �Է��� �ͧ������¤�Ѻ \n";
			stat = false;
		}

		if(fn.doctor.value == ""){
			txt = txt + "��سҡ�͡ ������ᾷ�����ѡ�� ���¤�Ѻ \n";
			fn.doctor.focus();
			stat = false;
		}


		if(fn.trauma.value == ""){
			txt = txt + "��س� ���͡ ��¡�� Trauma, Non Trauma ���� OPD ��Ѻ \n";
			fn.trauma.focus();
			stat = false;
		}

		if(fn.obs[0].checked == false && fn.obs[1].checked == false){
			txt = txt + "��س� ���͡ ��¡�� Observe ���� Non Observe ��Ѻ \n";
			stat = false;
		}
		
		
		if(fn.trauma.value == "trauma"){
			
			if(fn.type_accident[0].checked == false  && fn.type_accident[1].checked == false){
				txt = txt + "��س� ���͡ ���˵آͧ��úҴ�� ���¤�Ѻ \n";
				fn.type_accident[0].focus();
				stat = false;
			}

			if(fn.type_accident[0].checked == true){
				if(fn.accident_detail.value == "A01"){
					txt = txt + "���˵آͧ��úҴ�� ��س� ���͡ ��¡�� �غѵ��˵����� ���¤�Ѻ \n";
					fn.accident_detail.focus();
					stat = false;
				}
			}else if(fn.type_accident[1].checked == true){

				if(fn.wounded_detail.value !='W03' && fn.wounded_vehicle.value == "0"){
					txt = txt + "��س����͡��¡�� ��˹м��Ҵ�� ���¤�Ѻ \n";
					fn.wounded_vehicle.focus();
					stat = false;
				}else{
					
					if(fn.wounded_vehicle.value == "V01" || fn.wounded_vehicle.value == "V02"){
						if(fn.wounded_detail.value !='W03' && fn.helmet.value == ""){
							txt = txt + "��سҡ�͡������ �ĵԡ�������§ �����������ǡ������������� ? \n";
							fn.helmet.focus();
							stat = false;
						}
					}else{
						if(fn.wounded_detail.value !='W03' && fn.belt.value == ""){
							txt = txt + "��سҡ�͡������ �ĵԡ�������§ �����¤Ҵ����Ѵ������������� ? \n";
							fn.belt.focus();
							stat = false;
						}
					}


				}

				if(fn.wounded_detail.value == "0"){
					txt = txt + "��س����͡��¡�� �ѡɳм��Ҵ�� ���¤�Ѻ \n";
					fn.wounded_detail.focus();
					stat = false;
				}

				if(fn.cause_accident[0].checked == false && fn.cause_accident[1].checked == false && fn.cause_accident[2].checked == false ){
					txt = txt + "��س����͡��¡�� ��úҴ���Դ�ҡ ���¤�Ѻ \n";
					fn.cause_accident[0].focus();
					stat = false;
				}

				if( fn.cause_accident[2].checked == true && (fn.with_cause_accident.value == "" && fn.list_with_cause_accident.value == "0") ){
					txt = txt + "��سҡ�͡������ �����ª��Ѻ ?\n";
					fn.with_cause_accident.focus();
					stat = false;
				}

				if(fn.spirits.value == ""){
					txt = txt + "��سҡ�͡������ �ĵԡ�������§ �����´�������������� ? \n";
					fn.spirits.focus();
					stat = false;
				}

			}


		}
		
		if(fn.sender[0].checked == false && fn.sender[1].checked == false && fn.sender[2].checked == false && fn.sender[3].checked == false && fn.sender[4].checked == false && fn.sender[5].checked == false ){
					txt = txt + "��س����͡ ��¡�ü����� ���¤�Ѻ\n";
					fn.sender[0].focus();
					stat = false;
				}

				if(fn.sender[5].checked == true && fn.etc_sender.value == "" ){
					txt = txt + "��سҡ�͡�����ż��������� ���¤�Ѻ\n";
					fn.etc_sender.focus();
					stat = false;
				}

		if(fn.cure[0].checked == false  && fn.cure[1].checked == false  && fn.cure[2].checked == false  && fn.cure[3].checked == false && fn.cure[4].checked == false ){
			txt = txt + "��س� ���͡ �š���ѡ�� ���¤�Ѻ \n";
			fn.cure[0].focus();
			stat = false;
		}

		if(fn.cure[2].checked == true ){
			if(fn.cause_refer.value == ""){
				txt = txt + "��س� ��͡ ���˵ء�� Refer \n";
				fn.cause_refer.focus();
				stat = false;
			}

			if(fn.type_patient.value == ""){
				txt = txt + "��س� ��͡ �������ͧ����  \n";
				fn.type_patient.focus();
				stat = false;
			}

			if(fn.refer_hospital.value == ""){
				txt = txt + "��س� ��͡������ Refer ��� �ç��Һ�� \n";
				fn.refer_hospital.focus();
				stat = false;
			}

			if(fn.doc_refer.checked == false && fn.nurse.checked == false && fn.assistant_nurse.checked == false && fn.estimate.checked == false && fn.cradle.checked == false && fn.doc_txt.checked == false && fn.suggestion.checked == false){
				txt = txt + "��س� ���͡ �����˵� �ͧ��� refer ���¤�Ѻ \n";
				fn.no_estimate.focus();
				stat = false;
			}

			if(fn.estimate.checked == true && fn.no_estimate.value == ""){
				txt = txt + "��س� �����Ţ Ẻ�����Թ þ.�ӻҧ \n";
				fn.no_estimate.focus();
				stat = false;
			}

		}

		if( fn.trauma.value != "opd" && (fn.time_diag1.value == "")){
			if( ( fn.type_wounded.value == "1" || fn.type_wounded.value == "2" )){
				
				txt = txt + "��س� ��͡ ���ҷ��ᾷ���Ǩ ���¤�Ѻ \n";
					fn.time_diag1.focus();
					stat = false;

			}else if( ( fn.type_wounded2.value == "1" || fn.type_wounded2.value == "2" )){
				txt = txt + "��س� ��͡ ���ҷ��ᾷ���Ǩ ���¤�Ѻ  \n";
					fn.time_diag1.focus();
					stat = false;
			}
		}

		if(fn.cure[0].checked == true  && fn.admit_ward.value == ""){
			txt = txt + "��س� ���͡ ward ��� Admin ���� ���¤�Ѻ \n";
			fn.admit_ward.focus();
			stat = false;
		}

		if(fn.cure[2].checked == true  && fn.refer_hospital.value == ""){
			txt = txt + "��س� ��͡ �����ç��Һ�ŷ�� Refer ������¤�Ѻ \n";
			fn.refer_hospital.focus();
			stat = false;
		}

		if(fn.date_in.value == ""){
			txt = txt + "��س� ��͡ �ѹ������������Ѻ��õ�Ǩ ���¤�Ѻ \n";
			fn.date_in.focus();
			stat = false;
		}
		
		if(fn.time_in1.value == "" || fn.time_out1.value == "" ){
			txt = txt + "��س� ��͡�������/�͡ ���¤�Ѻ \n";
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
			
			if(value != "ᾷ��ҡ�ç��Һ�����")
				document.getElementById("doctor").value = value;
			else
				document.getElementById("doctor").value = "";
	}

	function check_alert(xxx){
		var yyy;
		if(document.f1.type_wounded.value != xxx)
			alert("���������ҡ������¹�ŧ���ͧ�ҡ��ҹ���͡ '������' �������͹�ѹ ? ");

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
			// alert("����ö����� HN �� ����Ţ �������ͧ���� - ��ҹ�鹤�Ѻ");
			return false;
		}
	}

	function check_number_vn() {
		e_k = event.which || event.keyCode;
		if (((e_k >= 48) && (e_k <= 57)) ) {
			return true;
		}else{
			event.returnValue = false;
			alert("����ö����� VN �� ����Ţ ��ҹ�鹤�Ѻ");
			return false;
		}
	}

	function check_number_an() {
	e_k=event.keyCode
		if (((e_k >= 48) && (e_k <= 57)) || e_k ==47 ) {
			return true;
		}else{
			event.returnValue = false;
			alert("����ö����� AN �� ����Ţ �������ͧ���� / ��ҹ�鹤�Ѻ");
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
	<TD align="center"  bgcolor="#3366FF" class="font_title" colspan ="8">��úѹ�֡����ѵԼ����� ER</TD>
</TR>
<TR>
	<TD width="77" align="right">Hn</TD>
	<TD colspan="7">
	<INPUT TYPE="text" ID="hn" NAME="hn" size="6" value="<?php echo $arr["hn"];?>" onKeyPress="check_number_hn(event);" title="����ö����� HN �� ����Ţ �������ͧ���� - ��ҹ��">&nbsp;<INPUT TYPE="button" value="View" Onclick="if(checksom()){viewdetail('view',document.getElementById('hn').value);document.getElementById('vn').value='';}">
	&nbsp;<INPUT TYPE="button" value="�ѡ����ѵ�" Onclick="window.open('basic_opd.php?close=true&hn='+document.getElementById('hn').value);"> &nbsp;
	<INPUT TYPE="button" value="�ټ� LAB" Onclick="window.open('report_lablst.php?close=true&hn='+document.getElementById('hn').value);">
	
	<script type="text/javascript">
		var input_hn = document.getElementById("hn");
		if( input_hn.addEventListener ){
			input_hn.addEventListener("blur", hn_blur, true);
		} else { // ����Ѻ IE
			input_hn.attachEvent("onblur", hn_blur, true);
		}
	
		function hn_blur(){
			
			if( input_hn.value === '' ){
				return false;
			}
			
			// �觤��仵�Ǩ�ͺ AN �Ѻ VN
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
	&nbsp;<INPUT TYPE="button" value="Lab ��. �͡" Onclick="if(document.getElementById('vn').value !=''){window.open('trauma_lab.php?vn='+document.getElementById('vn').value,'_blank');document.getElementById('vn').value='';}else{alert('��سҡ�͡ VN ���¤�Ѻ');}" >
	&nbsp;<INPUT TYPE="button" value="X-RAY ��. �͡" Onclick="if(document.getElementById('vn').value !=''){window.open('trauma_xray.php?vn='+document.getElementById('vn').value,'_blank');document.getElementById('vn').value='';}else{alert('��سҡ�͡ VN ���¤�Ѻ');}" > 
	</TD>
</TR>
<TR>
	<TD align="right">AN</TD><TD colspan="7">
	<INPUT TYPE="text" id="an" NAME="an" size="6" value="<?php echo $arr["an"];?>" onKeyPress="check_number_an();">&nbsp;<INPUT TYPE="button" value="�Դ�Թ ��. �" onClick="if(document.f1.an.value !=''){window.open('eripage.php?get_hn='+document.f1.an.value,'_blank');} else{alert('��سҡ�͡ AN');}">&nbsp;
	<INPUT TYPE="button" value="��������" onClick="view_expenses(document.f1.an.value);">
	&nbsp;
	<button onClick="print_sticker_an(event)">Stick ��.�</button>
	
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
				alert('��س���� AN');
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
				alert('��س���� hn');
				return false;
			}
			
			window.open('hnchkstk_er.php?Chn='+hn);
		}
	</script>    
	
	</TD>
</TR>
<TR>
  <TD align="right">&nbsp;</TD>
  <TD colspan="7"><button onClick="print_sticker_ipd(event)">Stick ��.�͡</button></TD>
</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD colspan="6" ><span id="div_viewdetail"></span></TD>
</TR>
<TR>
	<TD  align="right" valign="top">�Է�����ѡ</TD><TD width="197">
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
	<TD  align="right" valign="top">�Է����ͧ</TD><TD>
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
  <TD  align="right" valign="top">���˹ѡ</TD>
  <TD valign="top" colspan="5"><input name="weight" type="text" id="weight" size="3" value="<?php echo $weight;?>"  onblur="calbmi(document.f1.height.value,this.value)"/>
                 ��.</TD>
  <td valign="top">&nbsp;</td>
</TR>
<TR>
  <TD  align="right" valign="top">��ǹ�٧</TD>
  <TD valign="top" colspan="5"><input name="height" type="text" id="height" size="3" value="<?php echo $height;?>"  onblur="calbmi(this.value,document.f1.weight.value)"/>
��.</TD>
  <td valign="top">&nbsp;</td>
</TR>
<TR>
  <TD  align="right" valign="top">��� BMI</TD>
  <TD valign="top" colspan="5"><input name="bmi" type="text" size="3" maxlength="5" value="<?php echo $bmi;?>" /></TD>
  <td valign="top">&nbsp;</td>
</TR>
<TR>
	<TD  align="right" valign="top">�ä��Шӵ��</TD><TD valign="top" colspan="5">
		<TEXTAREA ID="disease_people" NAME="disease_people" ROWS="3" COLS="30"><?php echo $arr["disease_people"];?></TEXTAREA>
	</TD>
    <td width="51" valign="top">
		<INPUT TYPE="button" value="����ʸ" Onclick="document.getElementById('disease_people').value='����ʸ'; ">    </td>    
</TR>
<TR>
	<TD  align="right"  valign="top">�������</TD><TD colspan="5" valign="top">
		<TEXTAREA ID="drug_alert" NAME="drug_alert" ROWS="3" COLS="30"><?php echo $arr["drug_alert"];?></TEXTAREA>
		
	</TD>
    <td width="53" valign="top">
		<INPUT TYPE="button" value="����ʸ" Onclick="document.getElementById('drug_alert').value='����ʸ'; ">    </td>
</TR>
<TR>
	<TD  align="right" valign="top">Dx</TD><TD colspan="5">
		<TEXTAREA id="dx" NAME="dx" ROWS="3" COLS="30"><?php echo $arr["dx"];?></TEXTAREA>
	</TD>
</TR>
<TR>
	<TD  align="right" valign="top">�ҡ��</TD><TD colspan="5" valign="top">
		<TEXTAREA ID="organ" NAME="organ" ROWS="3" COLS="30"><?php echo $arr["organ"];?></TEXTAREA>
        &nbsp;<BR>
		<FONT COLOR="#FF0000">��Ǫ��� : </FONT>
		<SELECT NAME="choose_organ" Onchange="document.getElementById('organ').value = document.getElementById('organ').value+' '+this.value;">
			<option value="">-----------</option>
			<option value="��Ǩ����Ѵ">��Ǩ����Ѵ</option>
			<option value="�մ�ҵ���Ѵ">�մ�ҵ���Ѵ</option>
			<option value="���㺹Ѵ����">���㺹Ѵ����</option>
			<option value="�Ѻ�ҡ OPD">�Ѻ�ҡ OPD</option>
            <option value="�Ѻ�ҡ�ش�Ѵ��ͧ">�Ѻ�ҡ�ش�Ѵ��ͧ</option>
			<option value="�Ѵ���">�Ѵ��� ����Ѵ</option>
		</SELECT>
	</TD>
    <TD width="110" valign="top">
        <div><INPUT TYPE="button" value="�Ѻ�ҡ�ش�Ѵ��ͧ" Onclick="document.getElementById('organ').value='�Ѻ�ҡ�ش�Ѵ��ͧ'; "></div>
        <div style="margin-top:10px;"><INPUT TYPE="button" value="�Ѻ�ҡ OPD" Onclick="document.getElementById('organ').value='�Ѻ�ҡ OPD'; "></div>    </TD>    
</TR>
<TR>
	<TD  align="right" valign="top">����ѡ��</TD><TD colspan="5">
		<TEXTAREA ID="maintenance" NAME="maintenance" ROWS="3" COLS="30"><?php echo $arr["maintenance"];?></TEXTAREA>&nbsp;		<BR>
		<FONT COLOR="#FF0000"><a style="CURSOR: pointer" onClick="if(document.f1.choose_maintenance.style.display=='none'){document.f1.choose_maintenance.style.display=''}else{document.f1.choose_maintenance.style.display='none'}">��Ǫ���(tv.)</a> : </FONT>
		<SELECT NAME="choose_maintenance" Onchange="document.getElementById('maintenance').value = document.getElementById('maintenance').value+' '+this.value; document.f1.choose_maintenance.style.display='none';" multiple="multiple"  SIZE="10" style="position: absolute; display:none;">
			<option value="">-----------</option>
			<option value="verorab 1 amp. M">verorab 1 amp. M</option>
			<option value="T.T. 0.5 ml M">T.T. 0.5 ml M</option>
			<option value="Go-on ��� ">Go-on ���</option>
			<option value="Synvisc ��� ">Synvisc ���</option>
			<option value="Hyruan ��� ">Hyruan ���</option>
			<option value="Cef-3 2 gm + 0.9 nss 100 ml v drip in 1/2 hr.">Cef-3 2 gm + 0.9 nss 100 ml v drip in 1/2 hr.</option>
			<option value="�Ѻ��, advice">�Ѻ��, advice</option>
			<option value="D/S OD">D/S OD</option>
			<option value="Stitch Off">Stitch Off</option>
			<option value="rest , Observe �ҡ��">rest , Observe �ҡ��</option>
			<option value="�բ�鹡�Ѻ��ҹ��">�բ�鹡�Ѻ��ҹ��</option>
			<option value="�ҡ�����բ�� ��§ҹᾷ��">�ҡ�����բ�� ��§ҹᾷ��</option>
			<option value="consult">consult</option>
			<option value="��Ѻ�ͧᾷ��">��Ѻ�ͧᾷ��</option>
			<option value="FU">FU</option>
			<option value="eye irrigation c nss 100 ml">eye irrigation c nss 100 ml</option>
			<option value="��� lab">��� lab</option>
			<option value="��� x-ray">��� x-ray</option>
			<option value="admit�ҡ��Թԡ">admit�ҡ��Թԡ</option>
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
			<option value="ᾷ��ҡ�ç��Һ�����" <?php if($arr["doctor"] == "ᾷ��ҡ�ç��Һ�����") echo " Selected ";?> >ᾷ��ҡ�ç��Һ�����</option>
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
	<TD  align="right" valign="top">������</TD><TD  colspan="5">
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
	<TD  align="right" valign="top">������</TD><TD  colspan="5">
		<SELECT NAME="type_wounded2" Onchange="check_alert(this.value);">
			<Option value="" >-</Option>
			<Option value="1" <?php if($arr["type_wounded2"] == "1") echo " Selected ";?>>1</Option>
			<Option value="2" <?php if($arr["type_wounded2"] == "2") echo " Selected ";?>>2</Option>
			<Option value="3" <?php if($arr["type_wounded2"] == "3") echo " Selected ";?>>3</Option>
			<Option value="4" <?php if($arr["type_wounded2"] == "4") echo " Selected ";?>>4</Option>
            <Option value="5" <?php if($arr["type_wounded2"] == "5") echo " Selected ";?>>5</Option>
	</SELECT>&nbsp;<FONT COLOR="#FF0000">* �������ա������¹�ŧ</FONT>
	</TD>
</TR>
<TR>
	<TD align="right" valign="top">CPG : </TD><TD  colspan="5">
		<TABLE border='0'>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="cpg[]" VALUE="10" <?php if(isset($cpg["10"])) echo "Checked"; ?> Onclick="if(this.checked == true && !confirm('�س��ͧ���ŧ�ѹ�֡��÷� copd ���������?')){ return false;}"> COPD</TD>
		</TR>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="cpg[]" VALUE="20" <?php if(isset($cpg["20"])) echo "Checked"; ?> Onclick="if(this.checked == true && !confirm('�س��ͧ���ŧ�ѹ�֡��÷� MI ���������?')){ return false;}"> MI</TD>
		</TR>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="cpg[]" VALUE="30" <?php if(isset($cpg["30"])) echo "Checked"; ?> Onclick="if(this.checked == true && !confirm('�س��ͧ���ŧ�ѹ�֡��÷� sepsis ���������?')){ return false;}"> sepsis</TD>
		</TR>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="cpg[]" VALUE="40" <?php if(isset($cpg["40"])) echo "Checked"; ?> Onclick="if(this.checked == true && !confirm('�س��ͧ���ŧ�ѹ�֡��÷� head injury ���������?')){ return false;}" > head injury</TD>
		</TR>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="cpg[]" VALUE="50" <?php if(isset($cpg["50"])) echo "Checked"; ?> Onclick="if(this.checked == true && !confirm('�س��ͧ���ŧ�ѹ�֡��÷� Stroke Fast track ���������?')){ return false;}" >Stroke Fast track</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD colspan="2">
		�ӹǹ�ѵ���� : <INPUT TYPE="text" id="total_lst_labcare" NAME="total_lst_labcare" size="2" maxlength="2" onkeypress = "if(event.keyCode == 13){ create_lst_labcare('<?php echo $total_lst_labcare;?>'); return false; }else{ check_number();}" value="<?php echo $total_lst_labcare;?>">
		<BR><?php echo $div_list_lst_labcare;?>
		<div id="list_lst_labcare">		</div><BR>
		�ӹǹ�ѵ���� ���� : <INPUT TYPE="text" id="total_labcare" NAME="total_labcare" size="2" maxlength="2" onkeypress = "if(event.keyCode == 13){ create_labcare('<?php echo $total_labcare;?>'); return false; }else{ check_number();}" value="<?php echo $total_labcare;?>">
		<BR><?php echo $div_list_labcare;?>
		<div id="list_labcare">		</div>	</TD>
</TR>
<TR id="block1">
	<TD  align="right">���˵آͧ<BR>��úҴ��</TD><TD colspan="5" >&nbsp;&nbsp;<INPUT TYPE="radio" NAME="type_accident" value="2"<?php if($arr["type_accident"] == "2") echo " Checked ";?> onClick="block2.style.display='none';">�غѵ��˵�����&nbsp;&nbsp;
	<SELECT NAME="accident_detail">
		<?php
			foreach($list_accident_detail as $key => $value){
				echo "<Option value='".$key."' ";
					if($key == $arr["accident_detail"]) echo " Selected ";
				echo ">".$value."</Option>";
			}
		?>
	</SELECT><BR>
	&nbsp;&nbsp;<INPUT TYPE="radio" NAME="type_accident" value="1" <?php if($arr["type_accident"] == "1") echo " Checked ";?> onClick="block2.style.display='';">��Ҩ�
	
	</TD>
</TR>
<TR>
	<TD  colspan ="8">

		<TABLE  id="block2">
		<TR valign="top">
			<TD>

			<TABLE border='0'>
			<TR>
				<TD>��˹м��Ҵ��</TD>
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
				<TD>�ѡɳм��Ҵ��</TD>
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
				<TD>��úҴ���Դ�ҡ</TD>
				<TD><INPUT TYPE="radio"  NAME="cause_accident" value="1"  <?php if($arr["cause_accident"] == "1") echo " Checked ";?>></TD>
				<TD>���ҡ�ҹ��˹�</TD>
			</TR>
			<TR>
				<TD>&nbsp;</TD>
				<TD><INPUT TYPE="radio" NAME="cause_accident" value="2" <?php if($arr["cause_accident"] == "2") echo " Checked ";?>></TD>
				<TD>��˹�������� �������</TD>
			</TR>
			<TR>
				<TD>&nbsp;</TD>
				<TD><INPUT TYPE="radio" NAME="cause_accident" value="3" <?php if($arr["cause_accident"] == "3") echo " Checked ";?>></TD>
				<TD>�١���Ѻ <INPUT TYPE="text" NAME="with_cause_accident" size="7" value="<?php echo $arr["with_cause_accident"];?>"></TD>
			</TR>
			<TR>
				<TD colspan="3" align="right">
					<FONT COLOR="#FF0000">�١���Ѻ :</FONT> <SELECT NAME="list_with_cause_accident" >
						
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
				<TD colspan="3"><INPUT TYPE="checkbox" NAME="out_changwat" value="1" <?php if($arr["out_changwat"] == "1") echo "Checked"; ?>>&nbsp;���ʺ�غѵ��˵ص�ҧ�ѧ��Ѵ</TD>
			</TR>
			</TABLE>			</TD>
			<TD>
			<TABLE border='0'>
			<TR>
				<TD colspan="3">�ĵԡ�������§</TD>
			</TR>
			<TR>
				<TD>��������</TD>
				<TD colspan="2"><SELECT NAME="spirits">
								<Option value="">-------</Option>
								<Option value="1" <?php if($arr["spirits"] == "1") echo " Selected ";?>>����</Option>
								<Option value="0" <?php if($arr["spirits"] == "0") echo " Selected ";?>>������</Option>
								<Option value="2" <?php if($arr["spirits"] == "2") echo " Selected ";?>>����Һ</Option>
							</SELECT>				</TD>
			</TR>
			<TR>
				<TD>����Ѵ������</TD>
				<TD colspan="2"><SELECT NAME="belt">
								<Option value="">-------</Option>
								<Option value="1" <?php if($arr["belt"] == "1") echo " Selected ";?>>��</Option>
								<Option value="0" <?php if($arr["belt"] == "0") echo " Selected ";?>>�����</Option>
								<Option value="2" <?php if($arr["belt"] == "2") echo " Selected ";?>>����Һ</Option>
							</SELECT>				</TD>
			</TR>
			<TR>
				<TD>��ǡ������</TD>
				<TD colspan="2"><SELECT NAME="helmet">
								<Option value="">-------</Option>
								<Option value="1" <?php if($arr["helmet"] == "1") echo " Selected ";?>>��</Option>
								<Option value="0" <?php if($arr["helmet"] == "0") echo " Selected ";?>>�����</Option>
								<Option value="2" <?php if($arr["helmet"] == "2") echo " Selected ";?>>����Һ</Option>
							</SELECT>				</TD>
			</TR>
			</TABLE>			</TD>
		</TR>
		</TABLE>	</TD>
</TR>
<TR>
  <TD>������</TD>
  <TD colspan="7"><INPUT TYPE="radio" NAME="sender" value="1" <?php if($arr["sender"] ==1) echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.spName.style.display='none';}">
&nbsp;���ͧ </TD>
</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD colspan="7"><INPUT TYPE="radio" NAME="sender" value="2" <?php if($arr["sender"] ==2) echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.spName.style.display='';}">
	&nbsp;ALS  <span id="spName" style="display:none"><INPUT TYPE="radio" NAME="als_sender" value="þ.��������ѡ��������" <?php if($arr["als_sender"] == "��������ѡ��������") echo " Checked ";?>> þ.����� <INPUT TYPE="radio" NAME="als_sender" value="þ.����" <?php if($arr["als_sender"] == "þ.����") echo " Checked ";?>> þ.���� </span></TD> 
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
  <TD colspan="7"><INPUT TYPE="radio" NAME="sender" value="5" <?php if($arr["sender"] ==5) echo " Checked ";?>>&nbsp;����<INPUT TYPE="text" NAME="etc_sender" size="7" value="<?php echo $arr["etc_sender"];?>"></TD>
</TR>
<!--<TR>
  <TD>&nbsp;</TD>
  <TD colspan="7"><input type="radio" name="sender" value="6" <?php//if($arr["sender"] == "6") echo " Checked ";?>>
    &nbsp;���վ þ.����</TD>
</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD colspan="7"><INPUT TYPE="radio" NAME="sender" value="4" <?php//if($arr["sender"] == "4") echo " Checked ";?>>&nbsp;1669</TD>
</TR>
<TR>
	<TD>&nbsp;</TD>
	<TD colspan="7"><INPUT TYPE="radio" NAME="sender" value="3" <?php//if($arr["sender"] == "3") echo " Checked ";?>>&nbsp;����<INPUT TYPE="text" NAME="etc_sender" size="7" value="<?php//echo $arr["etc_sender"];?>"></TD>
</TR>-->
<TR>
	<TD  colspan ="8">
		�š���ѡ��&nbsp;&nbsp;

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
			<TD><INPUT TYPE="radio" NAME="cure" onClick="control_layer('');" value="no" <?php if($arr["cure"] == "no") echo " Checked ";?>>������Ѻ��ԡ��</TD>
		</TR>
		<TR>
			<TD>�觵��</TD>
			<TD>
				<SELECT NAME="to_etc">
					<Option value="">---------</Option>
					<Option value="�觵�� OR" <?php if($arr["to_etc"] == "�觵�� OR") echo " Selected ";?>>OR</Option>
					<Option value="�觵�� LR" <?php if($arr["to_etc"] == "�觵�� LR") echo " Selected ";?>>LR</Option>
					<Option value="�觵�� �����" <?php if($arr["to_etc"] == "�觵�� �����") echo " Selected ";?>>�����</Option>
					<Option value="�觵�� OPD" <?php if($arr["to_etc"] == "�觵�� OPD") echo " Selected ";?>>OPD</Option>
					<Option value="�觵�� ����Ҿ" <?php if($arr["to_etc"] == "�觵�� ����Ҿ") echo " Selected ";?>>����Ҿ</Option>
					<Option value="�觵�� �ѹ�����" <?php if($arr["to_etc"] == "�觵�� �ѹ�����") echo " Selected ";?>>�ѹ�����</Option>
					<Option value="�觵�� ������" <?php if($arr["to_etc"] == "�觵�� ������") echo " Selected ";?>>������</Option>
				</SELECT>			</TD>
			<TD><!-- <INPUT TYPE="checkbox" NAME="to_or" value="1" <?php// if($arr["to_or"] == "1") echo " Checked ";?>> --></TD>
			<TD><!-- �觵�� OR --></TD>
			<TD><!-- <INPUT TYPE="checkbox" NAME="to_lr"  value="1" <?php// if($arr["to_lr"] == "1") echo " Checked ";?>> --></TD>
			<TD><!-- �觵�� LR --></TD>
			
			<TD></TD>
			<TD></TD>
			<TD></TD>
		</TR>
		</TABLE>

		 
		<table>
			<tr>
				<td><label for="freshWound">��ʴ : </label></td>
				<td>
				<input type="checkbox" name="freshWound" id="freshWound" value="1">&nbsp;��������&nbsp;<select name="woundhours" id="woundhours">
						<option value="">���͡������</option>
						<?php 
						for ($i=1; $i <= 24; $i++) { 
							?><option value="<?=$i;?>"><?=$i;?></option><?php
						}
						?>
					</select> �������				</td>
			</tr>
		</table>
		
		
		
		
		<?php if($arr["next_ka"] == "1") echo " <FONT COLOR=\"blue\"><B>[ ¡�ʹ��� ]</B></FONT> ";?>
		&nbsp;<BR>
	
	<INPUT TYPE="checkbox" NAME="repeat" value="1" <?php if($arr["repeat"] == "1") echo " Checked ";?>>�ҵ�Ǩ���<BR>
	<DIV style="background-color: #D6D6D6" ID="Layer_admit" <?php  if($arr["cure"] != "admit"){ ?>style="display:none"<?php } ?>>
		&nbsp;Admit ��� Ward : <SELECT NAME="admit_ward">
										<Option value="">-----------------</Option>
										<Option value="���" <?php if($arr["admit_ward"] == "���") echo " Selected ";?>>�ͼ��������</Option>
										<Option value="�����" <?php if($arr["admit_ward"] == "�����") echo " Selected ";?>>�ͼ����¾����</Option>
										<Option value="icu" <?php if($arr["admit_ward"] == "icu") echo " Selected ";?>>�ͼ����� ICU</Option>
										<Option value="�ٵ�" <?php if($arr["admit_ward"] == "�ٵ�") echo " Selected ";?>>�ͼ������ٵ�</Option>
										</SELECT>
		</DIV>

		<DIV  style="background-color: #D6D6D6" ID="Layer_refer"  <?php  if($arr["cure"] != "refer"){ ?>style="display:none"<?php } ?>>
		&nbsp;&nbsp;&nbsp;���˵ء�� Refer : <INPUT TYPE="text" NAME="cause_refer" size ="16" value="<?php echo $arr["cause_refer"];?>">&nbsp;
		
		<SELECT NAME="list_cause_refer" Onchange="add_bylist(document.f1.cause_refer, this.value);">
										<Option value="">-----------------</Option>
										<Option value="��§���" >��§���</Option>
										<Option value="ICU ���" >ICU ���</Option>
										<Option value="Propermangement" >Propermangement</Option>
										<Option value="�Է����ѡ�� þ. �ӻҧ">�Է����ѡ�� þ. �ӻҧ</Option>
										<Option value="��ᾷ��੾�зҧ">��ᾷ��੾�зҧ</Option>
										</SELECT><BR>
		&nbsp;&nbsp;&nbsp;�������ͧ���� : <INPUT TYPE="text" NAME="type_patient" size ="12" value="<?php echo $arr["type_patient"];?>">&nbsp;<SELECT NAME="list_type_patient" Onchange="add_bylist(document.f1.type_patient, this.value);">
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
                                        
                                        &nbsp;&nbsp;&nbsp;�ѵػ��ʧ��/���� : <INPUT TYPE='radio' NAME='targe' VALUE='1'>��֡��/�ԹԨ���&nbsp;<INPUT TYPE='radio' NAME='targe' VALUE='2'>�ѡ����������觡�Ѻ&nbsp;<INPUT TYPE='radio' NAME='targe' VALUE='3'>�͹����<BR>
                                        
		&nbsp;&nbsp;&nbsp;�Ըա�� Refer : <SELECT NAME="means_refer">
										<Option value="ö��Һ��" <?php if($arr["means_refer"] == "ö��Һ��") echo " Selected ";?>>ö��Һ��</Option>
										<Option value="��ͧ" <?php if($arr["means_refer"] == "��ͧ") echo " Selected ";?>>��ͧ</Option>
								</SELECT><BR>
		&nbsp;&nbsp;&nbsp;Refer ��� �ç��Һ�� : <INPUT TYPE="text" ID="refer_hospital" NAME="refer_hospital" value="<?php echo $arr["refer_hospital"];?>">&nbsp;��Ǫ��� <A HREF="javascript:input_id('refer_hospital','�ç��Һ���ӻҧ'); ">þ.�ٹ��</A>
		&nbsp;&nbsp;&nbsp;

		<BR>
		&nbsp;&nbsp;&nbsp;Consult ᾷ��&nbsp;��͹ refer: 
		<INPUT ID="consult" TYPE="text" size="30" NAME="consult" value="<?php echo $arr["consult"];?>"><DD><DD><DD>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select ID="consult2" size="1" name="consult2" Onchange="add_bylist2(document.f1.consult, this.value);">
			<option value="">-----------------------</option>
			<option value="���͡ ��ҹ���ҧ"  > ���͡ ��ҹ���ҧ</option>
			<option value="�ç�� ��մ�͹ѹ��آ"  > �ç�� ��մ�͹ѹ��آ</option>
			<option value="��ó� �����ѡ���"  > ��ó� �����ѡ���</option>
			<option value="����� �����ѡ���"  > ����� �����ѡ���</option>
			<option value="͹ؾ��� �ʹ���"  > ͹ؾ��� �ʹ���</option>
			<option value="����Թ��� ����չҤ"  > ����Թ��� ����չҤ</option>
			<option value="��Ѫ�� ���¨���"  > ��Ѫ�� ���¨���</option>
			<option value="������ ������ó"  > ������ ������ó</option>
			<option value="����Թ ���๵�"  > ����Թ ���๵�</option>
			<option value="�Է�Ԫ�� �Ե���Թ��"  > �Է�Ԫ�� �Ե���Թ��</option>
			<option value="˹��ķ�� ����ȹѹ��"  > ˹��ķ�� ����ȹѹ��</option>
			<option value="���͡�� �����Ѿ��"  > ���͡�� �����Ѿ��</option>
			<option value="����Է���  ���ռ�"  > ����Է���  ���ռ�</option>
			<option value="��Ծ���  ��շ��ѳ��"  > ��Ծ���  ��շ��ѳ��</option>
			<option value="���Է�� ǧ�����"  >���Է�� ǧ�����</option>
			<option value="�����ط�� ǧ��ѹ���"  >�����ط�� ǧ��ѹ���</option>
			<option value="�Ե�  �ظ���ҹ��"  >�Ե�  �ظ���ҹ��</option>
			<option value="�͡�Է�� �ҭ�ԵԾ�������"  > �͡�Է�� �ҭ�ԵԾ�������</option>
			<option value="����ز� ����ͤ�Ե"  >����ز� ����ͤ�Ե</option>
			<option value="�ѹ�ҵ� �ӻ�����԰���"  >�ѹ�ҵ� �ӻ�����԰���</option>
			<option value="����ѷ� ��չ���"  >����ѷ� ��չ���</option>
			<option value="����ط� �ҭ������¹��"  >����ط� �ҭ������¹��</option>
			<option value="��ɴҡ� �Ƿ��¸Թ"  >��ɴҡ� �Ƿ��¸Թ</option>
			<option value="�ͧᴧ  �Ҳ�оѹ��" >�ͧᴧ  �Ҳ�оѹ��</option>
			<option value="�ز���  �����"  >�ز���  �����</option>
			<option value="�Ը���  �ح��"  >�Ը���  �ح��</option>
			<option value="���س��  �����ǧ�쾧��"  >���س��  �����ǧ�쾧��</option>
			<option value="����Թ  ���ǻԧ"  >����Թ  ���ǻԧ</option>
			<option value="�ԾԸ  ����ʡ��"  >�ԾԸ  ����ʡ��</option>
			<option value="侺����  ������ʧ"  >侺����  ������ʧ</option>
			<option value="���� �����͹" >���� �����͹</option>
			<option value="���๵����� ๵þԪԵ"  >���๵����� ๵þԪԵ</option>
			<option value="���кص� �ح��"  >���кص� �ح��</option>
		</select>
		<BR>
		
		&nbsp;&nbsp;&nbsp;�������Ѿ������� : <INPUT TYPE="text" NAME="er_tell" value="<?php echo $arr["er_tell"];?>"><BR>
		&nbsp;&nbsp;&nbsp;�ѭ�ҡ�� Refer : <TEXTAREA NAME="problem_refer" ROWS="3" COLS="35"><?php echo $arr["problem_refer"];?></TEXTAREA><BR>
		

		<TABLE>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="take_care" value="1" <?php if($arr["take_care"] == "1") echo " Checked ";?>></TD>
			<TD>���Ѻ��ô��ŷѹ��</TD>
			<TD></TD>
			<TD></TD>
			<TD></TD>
			<TD></TD>
		</TR>

		<TR>
			<TD colspan="6">�����˵� : </TD>
		</TR>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="doc_refer" value="1" <?php if($arr["doc_refer"] == "1") echo " Checked ";?>></TD>
			<TD>� Refer</TD>
			<TD><INPUT TYPE="checkbox" NAME="nurse" value="1" <?php if($arr["nurse"] == "1") echo " Checked ";?>></TD>
			<TD>��Һ��</TD>
			<TD><INPUT TYPE="checkbox" NAME="assistant_nurse" value="1" <?php if($arr["assistant_nurse"] == "1") echo " Checked ";?>></TD>
			<TD>������</TD>
			<TD><INPUT TYPE="checkbox" NAME="suggestion" value="1" <?php if($arr["suggestion"] == "1") echo " Checked ";?>></TD>
			<TD>�����й�</TD>
		</TR>
		<TR valign="top">
			<TD><INPUT TYPE="checkbox" NAME="estimate" value="1" <?php if($arr["estimate"] == "1") echo " Checked ";?>></TD>
			<TD>Ẻ�����Թ þ.�ӻҧ<BR>�����Ţ <INPUT TYPE="text" NAME="no_estimate" value="<?php echo $arr["no_estimate"];?>" size="5"></TD>
			<TD><INPUT TYPE="checkbox" NAME="cradle" value="1" <?php if($arr["cradle"] == "1") echo " Checked ";?>></TD>
			<TD>��</TD>
			<TD><INPUT TYPE="checkbox" NAME="doc_txt" value="1" <?php if($arr["doc_txt"] == "1") echo " Checked ";?>></TD>
			<TD>㺺ѹ�֡��ͤ���</TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
		</TR>
		</TABLE>

		�
		</DIV>

		<DIV style="background-color: #D6D6D6" ID="Layer_dc" <?php  if($arr["cure"] != "d/c"){ ?>style="display:none"<?php } ?>>
		<TABLE>
		<TR>
			<TD><INPUT TYPE="checkbox" NAME="to_hpt_lp" value="1" <?php if($arr["to_hpt_lp"] == "1") echo " Checked ";?>></TD>
			<TD>�й��ѡ�ҵ���ç��Һ���ӻҧ</TD>
		</TR>
		</TABLE>
		</DIV>
		
		�ѹ������������Ѻ��õ�Ǩ&nbsp;
		
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
		
		
		<BR><FONT COLOR="red"><B>* �ٻẺ�ͧ�ѹ��� 5 �Զع�¹ 2552 = 2552-06-05</B></FONT>
		<BR>

�������&nbsp;&nbsp;
		<INPUT TYPE="text" NAME="time_in1" maxlength="4" size="2" value="<?php echo $select_time_in1;?><?php echo $select_time_in2;?>" onKeyPress="check_number()"> �.

		<BR>
		���ҷ��ᾷ���Ǩ&nbsp;&nbsp;
		<INPUT TYPE="text" NAME="time_diag1" maxlength="4" size="2" value="<?php echo $select_time_diag1;?><?php echo $select_time_diag2;?>" onKeyPress="check_number()"> �.
		<BR>
�����͡&nbsp;
		<INPUT TYPE="text" NAME="time_out1" maxlength="4" size="2" value="<?php echo $select_time_out1;?><?php echo $select_time_out2;?>" onKeyPress="check_number()"> �.	</TD>
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
        <td >�׹�ѹ��éմ��</td>
      </tr>
	  <tr>
        <td >
			HN : <INPUT TYPE="text" NAME="hn">
		</td>
      </tr>
	  <tr>
        <td >
		<INPUT TYPE="button" value=" ��ŧ " onClick="view_confirm_inj('confirm_inj',document.form_confirn_inject.hn.value);">
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
        <td >�׹�ѹ��÷���</td>
      </tr>
	  <tr>
        <td >
			HN : <INPUT TYPE="text" NAME="hn">
		</td>
      </tr>
	  <tr>
        <td >
		<INPUT TYPE="button" value=" ��ŧ " onClick="view_confirm_ds('confirm_ds',document.form_confirn_ds.hn.value);">
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
		<B>����</B>
		</TD>
		</TR>
		<TR>
			<TD>
		�ѹ��� : <INPUT TYPE="text" NAME="search_date" id="search_date" size="10" readonly> <input type="button" name="calendar_button" value="....." onClick="showCalendar('search_date','YY-MM-DD')"><BR>
		HN : <INPUT TYPE="text" NAME="search_hn" size="10"><BR>
		<CENTER><INPUT TYPE="submit" value="����"></CENTER>
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
			echo "˹�� <INPUT TYPE=\"text\" NAME=\"page\" onkeypress = \"if(event.keyCode != 13){ check_number();}\" size=\"2\" value=\"".$_GET["page"]."\"> of ".$total_page;
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
        <td >�ѹ����ѡ��</td>
		<td >����</td>
        <td >HN</td>
        <td >DX/�ҡ��/����ѡ��</td>
		<td >��</td>
		<td >trauma</td>

		<td >ź</td>
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
			<?php if($arr["next_ka"] == "1") echo "<FONT COLOR=\"#3300FF\">[¡�ʹ���]</FONT>";?>
			
		</td>
		<td align="center"><a href="javascript:void(0);" 
		Onclick="if(confirm('��ҹ��ͧ���㺺�觵�Ǽ����� Lab �������?'))
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
			<TD align='right'>�ҡ�� : </TD>
			<TD><A HREF="javascript:void(0);" <?php if(strlen($arr["organ"]) > 18){?> Onclick="document.getElementById('organ').value='<?php echo $arr["organ"];?>';" onmouseover= "show_tooltip('<?php echo jschars($arr["organ"]);?>','left',0,0);" onMouseOut="hid_tooltip();" <?php }else{ ?><?php }?> style="color: #0000FF;text-decoration:none;"><?php echo substr($arr["organ"],0,18); if(strlen($arr["organ"]) > 18) echo " ...";?></A></TD>
		</TR>
		<TR>
			<TD align='right'>�ѡ�� : </TD>
			<TD><A HREF="javascript:void(0);" <?php if(strlen($arr["maintenance"]) > 18){?> onmouseover= "show_tooltip('<?php echo jschars($arr["maintenance"]);?>','left',0,0);" onMouseOut="hid_tooltip();" <?php }else{ ?> Onclick="document.getElementById('maintenance').value='<?php echo $arr["maintenance"];?>';" <?php }?>  style="color: #0000FF;text-decoration:none;"><?php echo substr($arr["maintenance"],0,18); if(strlen($arr["maintenance"]) > 18) echo " ...";?></A></TD>
		</TR>
		</TABLE>
		
		
		</td>
		<td><?php echo $arr["type_wounded"],",&nbsp;&nbsp;",$arr["type_wounded2"];?></td>
		<td align="center"><?php if($arr["trauma"]=="nontrauma") echo "non<BR>trauma"; else echo $arr["trauma"];?></td>
		<td align="center"><A HREF="#" onClick="if(confirm('��ҹ��ͧ���ź��¡�ù�����������')){ window.location.href='<?php echo $_SERVER['PHP_MYSELF'];?>?action=del&id=<?php echo $arr["row_id"];?>'; }">ź</A><BR><BR><A HREF="consent4.php?id=<?php echo $arr["row_id"]; ?>&hn=<?php echo urlencode($arr["hn"]); ?>&doctor=<?php echo urlencode($arr["doctor"]);?>" target="_blank">��Թ���</A></td>
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
