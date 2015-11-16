<?php
	
Class class_borrowAN extends class_variable{
		
var $borrowAN_year;
var $borrowAN_id ;
var $HN;
var $AN;
var $borrower;
var $receiver;
var $borrowAN_startdate;
var $borrowAN_enddate;

	function show_borrowAN_top(){
	$title = "ระบบ ยืม/คืนเวชระเบียนผู้ป่วยใน ";
	$link_text = array("กลับเมนูหลัก");
	$link_file = array("../nindex.htm");
	$link_target = array("target=\"_parent\"");

	$max_menu = count($link_text);
		echo "
		<TABLE>
		<TR>
			<TD colspan=\"",$max_menu,"\">".$title."</TD>
		</TR>
		<TR>";
		
		for($i=0;$i<$max_menu;$i++){
			echo "<TD><A HREF=\"",$link_file[$i],"\"  ",$link_target[$i],">",$link_text[$i],"</A></TD>";
		}
			echo "
		</TR>
		</TABLE>
		";
	}
	
	//java
	function checkform(){

		echo "
		<SCRIPT LANGUAGE=\"JavaScript\">
		<!--
			function checkForm(){
				var stat = true;
				
				if(document.form_borrowAN.AN.value == ''){
					alert(\"กรุณากรอก AN\");
					stat = false;
	
				}else if(document.form_borrowAN.borrower.value == ''){

					alert(\"กรุณากรอกชื่อผู้ยืม\");
					stat = false;

				}else if(document.form_borrowAN.AN_Name.value == ''){
					alert(\"กรุณาเช็ก ชื่อ - สกุล ของ เวชระเบียน\");					
					stat = false;

				}
			return stat;
			}
		//-->
		</SCRIPT>
		";

	}

	//  form add
	function form_borrowAN_add(){
		$title_form = "เพิ่ม ยืม/คืนเวชระเบียนผู้ป่วยใน";

		$select_date = "<Select name=\"DATE_SERV_MM\">";
			while (list($key, $val) = each($this->list_month)) {
				$select_date .= "<Option value=\"".$key."\" ";
					if($key == date("m")){  $select_date .= " Selected ";}
				$select_date .=">".$val."</Option>";
			}
		$select_date .= "</Select>";

		$select_year = "<Select name=\"DATE_SERV_YY\">";
			for($i=date("Y")-5;$i<date("Y")+5;$i++){
				$select_year .= "<Option value=\"".$i."\" ";
					if($i == date("Y")){  $select_year .= " Selected ";}
				$select_year .= ">".($i+543)."</Option>";
			}
		$select_year .= "</Select>";

		echo "
		
		<FORM Name=\"form_borrowAN\"  METHOD=POST ACTION=\"".$_SERVER['PHP_SELF']."\"  Onsubmit=\"return checkForm();\">
			<TABLE align=\"center\">
			<TR>
				<TD colspan=\"2\"  align=\"center\">",$title_form,"</TD>
			</TR>
			<TR>
				<TD align=\"right\">วัน/เดือน/ปี (ที่ยืม)&nbsp;:&nbsp;</TD>
				<TD><INPUT TYPE=\"text\" NAME=\"DATE_SERV_DD\" size=\"2\" value=\"".date("d")."\">&nbsp;/&nbsp;$select_date&nbsp;/&nbsp;$select_year</TD>
			</TR>
			<TR>
				<TD align=\"right\">AN&nbsp;:&nbsp;</TD>
				<TD><INPUT TYPE=\"text\" NAME=\"AN\">&nbsp;&nbsp;<INPUT TYPE=\"button\" VALUE=\"ค้นหา\" ONCLICK=\"window.parent.right.location.href='editor_borrowAN_right.php?action=an&search='+document.form_borrowAN.AN.value\"></TD>
			</TR>
			<TR>
				<TD align=\"right\">ชื่อ - สกุล&nbsp;:&nbsp;</TD>
				<TD><INPUT TYPE=\"text\" NAME=\"AN_Name\" readonly></TD>
			</TR>
			<TR>
				<TD align=\"right\">ชื่อผู้ยืม&nbsp;:&nbsp;</TD>
				<TD><INPUT TYPE=\"text\" NAME=\"borrower\"></TD>
			</TR>
			<TR>
				<TD align=\"center\" colspan=\"2\"><INPUT TYPE=\"submit\" value=\"เพิ่มข้อมูล\" >&nbsp;&nbsp;<INPUT TYPE=\"reset\" value=\"ยกเลิก\">&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=\"button\" VALUE=\"แสดงข้อมูล\" ONCLICK=\"window.parent.right.location.href='editor_borrowAN_right.php';\"></TD>
			</TR>
			</TABLE>
			<INPUT TYPE=\"hidden\" NAME=\"form_action\" value=\"form_add\">
			<INPUT TYPE=\"hidden\" NAME=\"HN\" value=\"\">
		</FORM>
		";
		$this->checkform();

	}	
	// End form add

	//  form edit
	function form_borrowAN_edit(){
		$title_form = "แก้ไข ยืม/คืนเวชระเบียนผู้ป่วยใน";
		
		$date_serv_f = explode("-",$this->borrowAN_startdate);
		$select_date = "<Select name=\"DATE_SERV_MM\">";
			while (list($key, $val) = each($this->list_month)) {
				$select_date .= "<Option value=\"".$key."\" ";
					if($key == $date_serv_f[1]){  $select_date .= " Selected ";}
				$select_date .=">".$val."</Option>";
			}
		$select_date .= "</Select>";

		$select_year = "<Select name=\"DATE_SERV_YY\">";
			for($i=date("Y")-5;$i<date("Y")+5;$i++){
				$select_year .= "<Option value=\"".$i."\" ";
					if($i ==$date_serv_f[0]){  $select_year .= " Selected ";}
				$select_year .= ">".($i+543)."</Option>";
			}
		$select_year .= "</Select>";
		
$sql = "Select yot, name, surname From opcard where hn = '".$this->HN."' ";
$result =Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);
$an_name = $arr["yot"]." ".$arr["name"]." ".$arr["surname"];

		echo "
		
		<FORM Name=\"form_borrowAN\"  METHOD=POST ACTION=\"".$_SERVER['PHP_SELF']."\" Onsubmit=\"return checkForm();\">
			<TABLE align=\"center\">
			<TR>
				<TD colspan=\"2\"  align=\"center\">",$title_form,"</TD>
			</TR>
			<TR>
				<TD align=\"right\">วัน/เดือน/ปี (ที่ยืม)&nbsp;:&nbsp;</TD>
				<TD><INPUT TYPE=\"text\" NAME=\"DATE_SERV_DD\" size=\"2\" value=\"".$date_serv_f[2]."\">&nbsp;/&nbsp;$select_date&nbsp;/&nbsp;$select_year</TD>
			</TR>
			<TR>
				<TD align=\"right\">AN&nbsp;:&nbsp;</TD>
				<TD><INPUT TYPE=\"text\" NAME=\"AN\" value=\"".$this->AN."\">&nbsp;&nbsp;<INPUT TYPE=\"button\" VALUE=\"ค้นหา\" ONCLICK=\"window.parent.right.location.href='editor_borrowAN_right.php?action=an&search='+document.form_borrowAN.AN.value;\"></TD>
			</TR>
			<TR>
				<TD align=\"right\">ชื่อ - สกุล&nbsp;:&nbsp;</TD>
				<TD><INPUT TYPE=\"text\" NAME=\"AN_Name\" value=\"".$an_name."\" readonly></TD>
			</TR>
			<TR>
				<TD align=\"right\">ชื่อผู้ยืม&nbsp;:&nbsp;</TD>
				<TD><INPUT TYPE=\"text\" NAME=\"borrower\" value=\"",$this->borrower,"\"></TD>
			</TR>
			<TR>
				<TD align=\"center\" colspan=\"2\"><INPUT TYPE=\"submit\" value=\"แก้ไขข้อมูล\" >&nbsp;&nbsp;<INPUT TYPE=\"button\" value=\"ยกเลิก\" onclick=\"window.location.href='".$_SERVER['PHP_SELF']."';\">
				&nbsp;&nbsp;<INPUT TYPE=\"button\" VALUE=\"แสดงข้อมูล\" ONCLICK=\"window.parent.right.location.href='editor_borrowAN_right.php';\">
				</TD>
			</TR>
			</TABLE>
			<INPUT TYPE=\"hidden\" NAME=\"form_action\" value=\"form_edit\">
			<INPUT TYPE=\"hidden\" NAME=\"edit_year\" value=\"".$this->borrowAN_year."\">
			<INPUT TYPE=\"hidden\" NAME=\"edit_id\" value=\"".$this->borrowAN_id."\">
			<INPUT TYPE=\"hidden\" NAME=\"HN\" value=\"".$this->HN."\">
		</FORM>
		";

		$this->checkform();

	}	
	// End form edit
	
	//  form add
	function form_borrowAN_receiver(){
		$title_form = " ยืมเวชระเบียนผู้ป่วยใน";
		
		$select_date = "<Select name=\"DATE_SERV_MM\">";
			while (list($key, $val) = each($this->list_month)) {
				$select_date .= "<Option value=\"".$key."\" ";
					if($key == date("m")){  $select_date .= " Selected ";}
				$select_date .=">".$val."</Option>";
			}
		$select_date .= "</Select>";

		$select_year = "<Select name=\"DATE_SERV_YY\">";
			for($i=date("Y")-5;$i<date("Y")+5;$i++){
				$select_year .= "<Option value=\"".$i."\" ";
					if($i == date("Y")){  $select_year .= " Selected ";}
				$select_year .= ">".($i+543)."</Option>";
			}
		$select_year .= "</Select>";

		echo "
		
		<FORM Name=\"form_borrowAN\"  METHOD=POST ACTION=\"".$_SERVER['PHP_SELF']."\">
			<TABLE align=\"center\">
			<TR>
				<TD colspan=\"2\"  align=\"center\">",$title_form,"</TD>
			</TR>
			<TR>
				<TD align=\"right\">วัน/เดือน/ปี (ที่คืน)&nbsp;:&nbsp;</TD>
				<TD><INPUT TYPE=\"text\" NAME=\"DATE_SERV_DD\" size=\"2\" value=\"".date("d")."\">&nbsp;/&nbsp;$select_date&nbsp;/&nbsp;$select_year</TD>
			</TR>
			<TR>
				<TD align=\"right\">ผู้รับคืน&nbsp;:&nbsp;</TD>
				<TD><INPUT TYPE=\"text\" NAME=\"receiver\" value=\"".$this->receiver."\"></TD>
			</TR>
			<TR>
				<TD align=\"center\" colspan=\"2\"><INPUT TYPE=\"submit\" value=\"ตกลง\" >&nbsp;&nbsp;<INPUT TYPE=\"button\" value=\"ยกเลิก\" onclick=\"window.location.href='".$_SERVER['PHP_SELF']."';\">&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=\"button\" VALUE=\"แสดงข้อมูล\" ONCLICK=\"window.parent.right.location.href='editor_borrowAN_right.php';\"></TD>
			</TR>
			</TABLE>
			<INPUT TYPE=\"hidden\" NAME=\"form_action\" value=\"form_receiver\">
			<INPUT TYPE=\"hidden\" NAME=\"edit_year\" value=\"",$this->borrowAN_year,"\">
			<INPUT TYPE=\"hidden\" NAME=\"edit_id\" value=\"",$this->borrowAN_id,"\">
		</FORM>
		";

	}	
	// End form add

	//เพิ่มข้อมูล
	function add_borrowAN(){
		$thidate = (date("Y")+543);
		$this->borrowAN_year = substr($thidate,2,2);
		
		$sql = "Select borrowAN_id From borrowan where AN = '".$this->AN."' AND receiver  is null Order by borrowAN_id DESC";
		$result = mysql_query($sql);
		$rows = Mysql_num_rows($result);

if($rows > 0){
$result = false;
}else{
		$sql = "Select borrowAN_id From borrowan where borrowAN_year = '".$this->borrowAN_year."' Order by borrowAN_id DESC";

		$result = mysql_query($sql);
		
		if(mysql_num_rows($result) == 0){
			$this->borrowAN_id = 1;
		}else{
			$arr = Mysql_fetch_assoc($result);
			$this->borrowAN_id = $arr["borrowAN_id"] +1;
		}
		
		$sql = "INSERT INTO `borrowan` ( `borrowAN_year` , `borrowAN_id` , `HN` , `AN` , `borrower` , `receiver` , `borrowAN_startdate` , `borrowAN_enddate` ) 
						VALUES (
						'".$this->borrowAN_year."', '".$this->borrowAN_id."', '".$this->HN."', '".$this->AN."', '".$this->borrower."', ".$this->receiver.", '".$this->borrowAN_startdate."', ".$this->borrowAN_enddate."
						);

					";

		$result = Mysql_Query($sql);
	}

	return $result ;
	}
	
	//แก้ไข ข้อมูล
		function edit_borrowAN(){
		
		$sql = "UPDATE `borrowan` set  
		 `HN` =  '".$this->HN."', 
		 `AN` =  '".$this->AN."', 
		 `borrower` =  '".$this->borrower."',
		 `borrowAN_startdate` =  '".$this->borrowAN_startdate."' 
		Where  
		 `borrowAN_year` = '".$this->borrowAN_year."'
		 AND `borrowAN_id` = '".$this->borrowAN_id."'
		";

		$result = Mysql_Query($sql);
	}

	//ยืน
		function receiver_borrowAN(){
		
		$sql = "UPDATE `borrowan` set  
		 `receiver` =  '".$this->receiver."',
		 `idname` = '".$_SESSION["sIdname"]."',
		 `borrowAN_enddate` =  '".date("Y-m-d")."'
		Where  
		 `borrowAN_year` = '".$this->borrowAN_year."'
		 AND `borrowAN_id` = '".$this->borrowAN_id."'
		";


		$result = Mysql_Query($sql);
	}

	function change_date($date_now){
		$date = explode("-",$date_now);
		$date[0] = $date[0]+543;
		
		$date[1] = $this->list_month[$date[1]];
		return $date[2]." ".$date[1]." ".$date[0];
	}
	
	// ยืม/คืนเวชระเบียนผู้ป่วยใน
	function view_borrowAN(){
		$sql = "Select a.borrowAN_year, a.borrowAN_id, a.borrowAN_startdate, b.an, b.hn, a.borrower, a.receiver, b.ptname From borrowan as a, ipcard as b  where a.receiver is null AND a.AN  = b.an  Order by a.borrowAN_startdate DESC";

		$result = Mysql_Query($sql);
		
		echo "
		ข้อมูลเวชระเบียนที่ยังไม่ได้คืน&nbsp;&nbsp;|&nbsp;&nbsp;<A HREF=\"editor_borrowAN_right.php?action=old\">ข้อมูลการยืม เววระเบียน</A><BR>
		<FORM METHOD=POST ACTION=\"\">
		<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"99%\" border=\"1\" bordercolor=\"#3300FF\">
		<TR>
			<TD>
		<TABLE  align=\"center\" width=\"100%\" border=\"0\">
		<TR align=\"center\" class=\"title\" bgcolor=\"#3300FF\">
			<TD><B>วัน/เดือน/ปี(ที่ยืม)</B></TD>
			<TD><B>HN</B></TD>
			<TD><B>AN</B></TD>
			<TD><B>ชื่อ - สกุล</B></TD>
			<TD><B>ชื่อผู้ยืม</B></TD>
			<TD><B>คืนเวชฯลฯ</B></TD>
			<TD><B>แก้ไข</B></TD>
			<TD><B>ลบ</B></TD>
		</TR>
		"; 
		while($arr = Mysql_fetch_assoc($result)){
		
			if($i ==0){
				$color = "#FFFF99";
				$i=1;
			}else{
				$color = "#FFFFEE";
				$i=0;
			}

		echo "<TR  class=\"detail\" bgcolor=\"$color\">
			<TD>",$this->change_date($arr["borrowAN_startdate"]),"</TD>
			<TD>",$arr["hn"],"</TD>
			<TD>",$arr["an"],"</TD>
			<TD>",$arr["ptname"],"</TD>
			<TD>",$arr["borrower"],"</TD>
			<TD align=\"center\"><A HREF=\"editor_borrowAN_left.php?receiver=true&id=",$arr["borrowAN_id"],"&year=",$arr["borrowAN_year"],"\" target = \"left\">คืนเวชฯลฯ</A></TD>
			<TD align=\"center\"><A HREF=\"editor_borrowAN_left.php?edit=true&id=",$arr["borrowAN_id"],"&year=",$arr["borrowAN_year"],"\" target=\"left\">แก้ไข</A></TD>
			<TD align=\"center\"><INPUT TYPE=\"checkbox\" NAME=\"list[]\" value=\"",$arr["borrowAN_year"],"-",$arr["borrowAN_id"],"\"></TD>
		</TR>";

		}
		
		echo "
			<TR>
				<TD colspan=\"8\" align=\"right\">
				<INPUT TYPE=\"reset\" value=\"ยกเลิก Check\">&nbsp;&nbsp;
				<INPUT TYPE=\"submit\" value=\"ลบข้อมูล\" name=\"delete\">
				
				</TD>
			</TR>
		</TABLE>
			</TD>
		</TR>
		</TABLE>
		</Form>
		"; 
	}

	// ยืม/คืนเวชระเบียนผู้ป่วยใน
	function view_borrowANold(){
		$sql = "Select a.borrowAN_year, a.borrowAN_id, a.borrowAN_startdate, a.borrowAN_enddate, a.HN, a.AN, a.borrower, a.receiver, b.ptname From borrowan as a, ipcard as b  where a.receiver is not null AND a.AN  = b.an Order by a.borrowAN_startdate DESC";
		
		$result = Mysql_Query($sql);
		
		echo "
		<A HREF=\"editor_borrowAN_right.php\">ข้อมูลเวชระเบียนที่ยังไม่ได้คืน</A>&nbsp;&nbsp;|&nbsp;&nbsp;ข้อมูลการยืม เววระเบียน<BR>
		<FORM METHOD=POST ACTION=\"\">
		<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"99%\" border=\"1\" bordercolor=\"#3300FF\">
		<TR>
			<TD>
		<TABLE  align=\"center\" width=\"100%\" border=\"0\">
		<TR align=\"center\" class=\"title\" bgcolor=\"#3300FF\">
			<TD><B>วัน/เดือน/ปี(ที่ยืม)</B></TD>
			<TD><B>HN</B></TD>
			<TD><B>AN</B></TD>
			<TD><B>ชื่อ - สกุล</B></TD>
			<TD><B>ชื่อผู้ยืม</B></TD>
			<TD><B>ผู้รับคืน</B></TD>
			<TD><B>วัน/เดือน/ปี(ที่คืน)</B></TD>
		</TR>
		"; 
		while($arr = Mysql_fetch_assoc($result)){
		
			if($i ==0){
				$color = "#FFFF99";
				$i=1;
			}else{
				$color = "#FFFFEE";
				$i=0;
			}

		echo "<TR  class=\"detail\" bgcolor=\"$color\">
			<TD>",$this->change_date($arr["borrowAN_startdate"]),"</TD>
			<TD>",$arr["HN"],"</TD>
			<TD>",$arr["AN"],"</TD>
			<TD>",$arr["ptname"],"</TD>
			<TD>",$arr["borrower"],"</TD>
			<TD>",$arr["receiver"],"</TD>
			<TD>",$this->change_date($arr["borrowAN_enddate"]),"</TD>
		</TR>";

		}
		
		echo "
			<TR>
				<TD colspan=\"7\" align=\"right\">
				&nbsp;				
				</TD>
			</TR>
		</TABLE>
			</TD>
		</TR>
		</TABLE>
		</Form>
		"; 
	}
	
	//ข้อมูลAN
	function view_an(){

		if(isset($_GET["search"]) && $_GET["search"] !="")
			$where = " Where ((a.an = '".$_GET["search"]."') OR (a.hn = '".$_GET["search"]."') OR (a.hn = '".$_GET["search"]."') OR (b.name LIKE '%".$_GET["search"]."%' ) OR (b.surname LIKE '%".$_GET["search"]."%' ) ) AND a.hn = b.hn";
		else
			$where = " Where a.hn = b.hn";

		$sql = "Select a.an, a.hn, b.yot , b.name  , b.surname From ipcard as a, opcard as b ".$where." ";

		$result = Mysql_Query($sql);
		
		echo "

		<FORM METHOD=GET ACTION=\"",$_SERVER['PHP_SELF'],"\">
			<INPUT TYPE=\"text\" NAME=\"search\" value=\"".$_GET["search"]."\">&nbsp;&nbsp;<INPUT TYPE=\"submit\" value=\"ค้นหา\">
			<INPUT TYPE=\"hidden\" NAME=\"action\" value=\"an\">
		</FORM>

		<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"99%\" border=\"1\" bordercolor=\"#3300FF\">
		<TR>
			<TD>
		<TABLE  align=\"center\" width=\"100%\" border=\"0\">
		<TR align=\"center\" class=\"title\" bgcolor=\"#3300FF\">
			<TD width=\"100\"><B>AN</B></TD>
			<TD width=\"100\"><B>HN</B></TD>
			<TD><B>ชื่อ - สกุล</B></TD>
		</TR>
		"; 
		while($arr = Mysql_fetch_assoc($result)){
		
			if($i ==0){
				$color = "#FFFF99";
				$i=1;
			}else{
				$color = "#FFFFEE";
				$i=0;
			}

		echo "<TR  class=\"detail\" bgcolor=\"$color\">
			<TD align=\"center\"><A HREF=\"#\" Onclick=\"window.parent.left.document.form_borrowAN.AN.value='".$arr["an"]."'; window.parent.left.document.form_borrowAN.AN_Name.value='",$arr["yot"]," ",$arr["name"]," ",$arr["surname"],"'; window.parent.left.document.form_borrowAN.HN.value='",$arr["hn"],"';\">",$arr["an"],"</A></TD>
			<TD align=\"center\">",$arr["hn"],"</TD>
			<TD align=\"center\">",$arr["yot"]," ",$arr["name"]," ",$arr["surname"],"</TD>
		</TR>";

		}
		
		echo "</TABLE>
			</TD>
		</TR>
		</TABLE>
		"; 
	}

	function delete_borrowAN($id=""){
		
		$list = explode("-",$id);

		$sql = "Delete From borrowan where borrowAN_year = '".$list[0]."' AND borrowAN_id = '".$list[1]."' ";
		$result = Mysql_Query($sql);
		
	}

	}

?>