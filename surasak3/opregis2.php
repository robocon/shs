<?php
session_start();
session_unregister("cHn");  
session_unregister("cPtname");
session_unregister("cPtright");
session_unregister("nVn");  
session_unregister("cAge");  
session_unregister("nRunno");  
session_unregister("vAN");
session_unregister("thdatehn");  
session_unregister("cNote");  
session_unregister("Ptright1");
//    session_destroy();
?>

<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script>

<p>ระบบลงทะเบียนผู้ป่วย</p>
<script type="text/javascript">
	document.getElementById('hn_value').focus();
</script>
<FORM Name="f1" METHOD=POST ACTION="" Onsubmit = "return checkForm();">
	<Table border="0" align="center">
		<TR><TD align="right">ID&nbsp;:&nbsp;</TD><TD>
		<input type="textbox" name="id_value" maxlength="13" onkeypress="return Numberonly(event)" onclick="readonlyall(document.f1.id_value,'');  document.f1.id_value.focus(); document.f1.type[2].checked = true;">
		</TD></TR>
		<TR>
		<TD align="right">HN&nbsp;:&nbsp;</TD><TD>
		<input type="textbox" name="hn_value" onkeypress="return Hnonly(event)" onclick="readonlyall(document.f1.hn_value,''); document.f1.hn_value.focus(); document.f1.type[0].checked = true;"> 
		</TD>
		
		</TR>
		<TR>
		<TD align="right">ชื่อ&nbsp;:&nbsp;</TD><TD>
		<input type="textbox" name="firstname" onclick="readonlyall(document.f1.firstname,document.f1.lastname); document.f1.firstname.focus();document.f1.type[1].checked = true;">
		&nbsp;&nbsp;
		สกุล&nbsp;:&nbsp;
		<input type="textbox" name="lastname" onclick="readonlyall(document.f1.firstname,document.f1.lastname); document.f1.type[1].checked = true;" >
		</TD>
		</TR>
		
		<TR><TD align="center"  colspan="3">
		<INPUT TYPE="submit" name="submit" value="ตกลง">&nbsp;&nbsp;<INPUT TYPE="reset" value="ยกเลิก">
		</TD></TR>
	</Table>
</FORM>


<table>
	<tr bgcolor="6495ED">
		<th height="22">HN</th>
		<th width="70">ยศ</th>
		<th>ชื่อ</th>
		
		<th>สกุล</th>
		<th>ใบต่อแบบใหม่</th>
		<th>มา รพ.</th>
		<th>ตรวจนอน</th>
		<th>ใบต่อ</th>
		<!-- <th>ใบยานอก</th>
		<th>ใบสั่งยา</th>
		<th>ใบตรวจโรค</th>-->
		<th colspan="4">ใบตรวจโรค</th>
		<th>สถานะ ward</th>
	</tr>

<?php
if(!empty($hn_value)||!empty($firstname)||!empty($lastname)||!empty($id_value)){
	include("connect.inc");
	if($_POST["hn_value"] != ""){
		$where = " Where hn = '".$_POST["hn_value"]."' ";
	}else if($_POST["firstname"] != ""||$_POST["lastname"]!=""){
		$where = " Where name like '%".$_POST["firstname"]."%' AND surname like '%".$_POST["lastname"]."%' " ;
	}else{
		$where = " Where idcard = '".$_POST["id_value"]."' ";
	}
	$sql_chkname="SELECT  * FROM opcard $where";
	$result_chkname = mysql_query($sql_chkname);
	while($dbarr= mysql_fetch_array($result_chkname)){
	
	global $hn;
	$hn=$dbarr['hn'];
	$query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE hn = '$hn'";
	$result = mysql_query($query)or die("Query failed");
	
		while (list ($hn,$yot,$name,$surname,$ptright,$ptright1,$idcard) = mysql_fetch_row ($result)) {
		
			$alert_msg = '-';
			
			if(substr($ptright,0,3)=='R07' && !empty($idcard)){
				$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
				
				if(Mysql_num_rows(Mysql_Query($sql)) > 0){
					$color = "#CCFF00";
				}else{
					$color = "FF8C8C";
				}
			}else if(substr($ptright,0,3)=='R03'){
				$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
				
				if(Mysql_num_rows(Mysql_Query($sql)) > 0){
					$color = "99CC00";
				}else{
					$color = "FF8C8C";
				}
			}else{
				$color = "66CDAA";
			}
		
		
			if(!empty($idcard)){
				$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
				if(Mysql_num_rows(Mysql_Query($sql)) > 0){
					echo"<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยมีสิทธิประกันสังคม</FONT>";
				}
			}else{
				echo"<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยไม่มีเลขประจำตัวประชาชน</FONT>";
				?>
				<script type="text/javascript">
					alert('ผู้ป่วยไม่มีเลขประจำตัวประชาชน');
				</script>
				<?php
			}


			if(!empty($hn)){
				$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
				if(Mysql_num_rows(Mysql_Query($sql)) > 0){
					echo"<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยมีสิทธิจ่ายตรง</FONT>";
				}
			}else{
				echo"<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยไม่มี HN</FONT>";
			}
					
		
			$sql = sprintf("SELECT `hn`,`dcdate`, `my_ward`
			FROM `ipcard` 
			WHERE `hn` = '%s' 
			ORDER BY `row_id` DESC LIMIT 1", $hn);
			$query = mysql_query($sql);
			$item = mysql_fetch_assoc($query);
			
			if($item != false && $item['dcdate'] == '0000-00-00 00:00:00'){
				$alert_msg = $item['my_ward'];
			}
		
		
		
			print (" <tr>\n".
			"  <td BGCOLOR=".$color."><a target=_BLANK onclick=\"checkIpd(this, event, '$hn')\" href=\"opedit.php? cHn=$hn & cName=$name &cSurname=$surname\">$hn</a></td>\n".
			"  <td BGCOLOR=".$color.">$yot</td>\n".
			"  <td BGCOLOR=".$color.">$name</td>\n".
			"  <td BGCOLOR=".$color.">$surname</td>\n".
			"  <td BGCOLOR=".$color."><a target=_BLANK  href=\"opdcard_opregis.php?cHn=$hn\">$ptright</a></td>\n".
			"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">มา รพ.</td>\n".
			"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">ตรวจนัด</td>\n".
			// "  <td BGCOLOR=".$color."><a target= _BLANK href=\"ancheck.php?hn=$hn\">ตรวจนอน</td>\n".
			"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"opdprint2.php?cHn=$hn\">ใบต่อ</td>\n".
			/*"  <td BGCOLOR=".$color."><a target= _BLANK href=\"edprint.php?cHn=$hn\">ใบยานอก</td>\n".
			"  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint.php?cHn=$hn\">ผู้ป่วยนัด</td>\n".
			"  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint1.php?cHn=$hn\">ใบตรวจโรค</td>\n".*/
			"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointhdvn.php?cHn=$hn\">ไต</td>\n".
			"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointdenvn.php?cHn=$hn\">ฟัน</td>\n".
			"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointeyevn.php?cHn=$hn\">ตา</td>\n".
			"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appoint.php?cHn=$hn\">ผป.นัด</td>\n".
			
			"<td BGCOLOR=".$color." align='center'>".$alert_msg."</td>".
			
			" </tr>\n");
		}
	}
	
	
	// ตรวจสอบและเปลี่ยน HN AN ตอนขึ้นปีใหม่
	$sql = "Select left(prefix,2) From runno where title = 'HN' ";
	list($title_hn) = Mysql_fetch_row(Mysql_Query($sql));
	$year_now = substr(date("Y")+543,2);
	if($title_hn != $year_now){
		$sql = "Update runno set prefix = '".$year_now."-', runno = 0 where  title = 'HN' limit 1;";
		$result = mysql_Query($sql);
	}
	
	$sql = "Select left(prefix,2) From runno where title = 'AN' ";
	list($title_an) = Mysql_fetch_row(Mysql_Query($sql));
	$year_now = substr(date("Y")+543,2);
	if($title_an != $year_now){
		$sql = "Update runno set prefix = '".$year_now."/', runno = 0 where  title = 'AN' limit 1;";
		$result = mysql_Query($sql);
	}
	// END
	
	?>
	</table>
	<FONT SIZE="2" COLOR="#990000">***คำอธิบาย***</FONT> <BR>
	<FONT SIZE="" COLOR="66CDAA">สีเขียว คือ ยังไม่ได้ทำการตรวจสิทธิการรักษา</FONT><BR>
	<FONT SIZE="" COLOR="#CCFF00">สีเขียวอ่อน คือ ตรวจสอบแล้ว มีสิทธิประกันสังคม</FONT><BR>
	<FONT SIZE="" COLOR="#99CC00">สีเขียวอ่อน คือ ตรวจสอบแล้ว มีสิทธิจ่ายตรง</FONT><BR>
	<FONT SIZE="" COLOR="#FF0033">สีแดง คือ ไม่มีสิทธิ</FONT><BR>
	<?php
	
	$id_value = isset($_POST['id_value']) ? $_POST['id_value'] : '' ;
	$hn_value = isset($_POST['hn_value']) ? $_POST['hn_value'] : '' ;
	$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '' ;
	$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '' ;
	
	if($id_value != ''){
		$where = '';
	}else if($hn_value != ''){
		$where = '';
	}else{
		$where = '';
	}
	
	?>
	<hr />
	<?
	include("unconnect.inc");
}
?>
</table>
<script type="text/javascript">
	/* checkIpd */
	function checkIpd(link, ev, hn){
		// SmPreventDefault(ev);
		// var href = this.href;
		var newSm = new SmHttp();
		newSm.ajax(
			'templates/regis/checkIpd.php',
			{ id: hn },
			function(res){
				var txt = JSON.parse(res);
				if( txt.state === 400 ){
					alert('สถานะของผู้ป่วยยังอยู่ '+txt.msg+' กรุณาติดต่อที่ Ward เพื่อ Discharge');
					SmPreventDefault(ev);
				}else{
					// window.open(link.href, '_blank');
				}
			},
			false // true is Syncronous and false is Assyncronous (Default by true)
		);
		
	}
</script>