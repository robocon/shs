<?php
session_start();
   
require "includes/functions.php";

if(PHP_VERSION_ID <= 50217){
	session_unregister("cIdcard");  
	session_unregister("cHn");  
	session_unregister("cPtname");
	session_unregister("cPtright");
	session_unregister("nVn");
	session_unregister("cAge");  
	session_unregister("nRunno");  
	session_unregister("vAN"); 
	session_unregister("thdatehn"); 
	session_unregister("cNote"); 
}else{
	unset($_SESSION['cIdcard']);
	unset($_SESSION['cHn']);
	unset($_SESSION['cPtname']);
	unset($_SESSION['cPtright']);
	unset($_SESSION['nVn']);
	unset($_SESSION['cAge']);
	unset($_SESSION['nRunno']);
	unset($_SESSION['vAN']);
	unset($_SESSION['thdatehn']);
	unset($_SESSION['cNote']);
}
?>
<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="js/ptrightOnline.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script>

<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		var stat = true;
		var id13 = document.f1.idcard.value;
		var sum = 0;

		
			if(id13 != "" && id13 != "-"){
				
				if(id13.length != 13){
					alert("เลขบัตรประชาชนไม่ถูกต้อง");
					stat = false;
				}

				if(stat == true){
						
						for (i = 0; i < 12; i++)
						{
							sum += eval(id13.charAt(i)) * (13 - i);
						}

					sum = ((11 - (sum % 11)) % 10)
					
					if(eval(id13.charAt(12)) != sum)
						if(confirm("ระบบตรวจสอบว่าคุณกรอกเลขบัตรประชาชนไม่ถูกต้อง \n คุณต้องการกลับไปแก้ไขหรือไม่?"))
							stat = false;
						else
							stat = true;
				}
			}
			
		return stat;
	}

</SCRIPT>

<form name="f1" method="post" action="<?php echo $PHP_SELF ?>" Onsubmit="return checkForm();">
	<p>&nbsp;&nbsp;&nbsp;ค้นหาคนไข้จากเลขบัตรประจำตัว13หลัก</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ID&nbsp;&nbsp;&nbsp;
	<input type="text" name="idcard" size="16" id="aLink"></p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" value="     ตกลง     " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  " name="B2"></p>
</form>
<script type="text/javascript">
	document.getElementById('aLink').focus();
</script>
		
<table>
	<tr bgcolor="6495ED">
		<th>เลขบัตร ปชช.</th>
		<th>HN</th>
		<th>ยศ</th>
		<th>ชื่อ</th>
		<th>สกุล</th>
		<th>สิทธิ</th>
		<th>มา รพ.</th>
		<th>ตรวจนัด</th>
		<th>ตรวจนอน</th>
		<th></th>
	</tr>

<?php
$pre_hn = null;
If (!empty($idcard)){
    include("connect.inc");
    $query = "SELECT idcard,hn,yot,name,surname,ptright1, idcard FROM opcard WHERE idcard = '$idcard'";
    $result = mysql_query($query) or die("query failed,opcard");

    while (list ($idcard,$hn,$yot,$name,$surname,$ptright, $idcard) = mysql_fetch_row ($result)) {
		
		$pre_hn = $hn;
		
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
				echo"ผู้ป่วยมีสิทธิประกันสังคม";
			}else{
				echo"";
			}
		}else{
			echo"ผู้ป่วยไม่มีเลขประจำตัวประชาชน";
		}

		if(!empty($hn)){
			$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";			
			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				echo"ผู้ป่วยมีสิทธิจ่ายตรง";
			}else{
				echo"";
			}
		}else{
			echo"ผู้ป่วยไม่มี HN";
		}

		print (" <tr>\n".
		"  <td BGCOLOR=".$color."><a target=\"_BLANK\" onclick=\"checkIpd(this, event, '$hn')\" href=\"opedit.php?cIdcard=$idcard&cHn=$hn&cName=$name&cSurname=$surname\">$idcard</a></td>\n".
		"  <td BGCOLOR=".$color.">$hn</td>\n".
		"  <td BGCOLOR=".$color.">$yot</td>\n".
		"  <td BGCOLOR=".$color.">$name</td>\n".
		"  <td BGCOLOR=".$color.">$surname</td>\n".
		"  <td BGCOLOR=".$color.">$ptright</td>\n".
		"  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"hndaycheck.php?hn=$hn\">มา รพ.</a></td>\n".
		"  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"appdaycheck.php?hn=$hn\">ตรวจนัด</a></td>\n".
		"  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"ancheck.php?hn=$hn\">ตรวจนอน</a></td>\n".
		"  <td BGCOLOR=".$color."><button type=\"button\" id=\"checkPt\" onclick=\"checkPtRight(this, event, '$idcard')\">ตรวจสอบสิทธิ</button></td>\n".
		" </tr>\n");
	} // End while

} // End if
?>
</table>
<FONT SIZE="2" COLOR="#990000">***คำอธิบาย***</FONT> <BR>
<FONT SIZE="" COLOR="66CDAA">สีเขียว คือ ยังไม่ได้ทำการตรวจสิทธิการรักษา</FONT><BR>
<FONT SIZE="" COLOR="#CCFF00">สีเขียวอ่อน คือ ตรวจสอบแล้ว มีสิทธิประกันสังคม</FONT><BR>
<FONT SIZE="" COLOR="#99CC00">สีเขียวอ่อน คือ ตรวจสอบแล้ว มีสิทธิจ่ายตรง</FONT><BR>
<FONT SIZE="" COLOR="#FF0033">สีแดง คือ ไม่มีสิทธิ</FONT><BR>

<?php
if($pre_hn !== null){
	
	$sql_pre = "SELECT b.`my_ward`,b.`dcdate` FROM `bed` AS a 
	LEFT JOIN `ipcard` AS b ON b.`an` = a.`an` 
	WHERE a.`hn` = '%s' ;";
	$sql = sprintf($sql_pre, $pre_hn);
	$query = mysql_query($sql);
	$item = mysql_fetch_assoc($query);
	
	if($item != false && $item['dcdate'] == '0000-00-00 00:00:00'){
		?>
		<script type="text/javascript">
			alert('<?php echo 'ผู้ป่วยยังอยู่ที่ '.$item['my_ward'];?>');
		</script>
		<?php
	}
}
?>
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
<?php
include("unconnect.inc");
?>