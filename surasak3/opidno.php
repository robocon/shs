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
<style>
body {
	background-color: #FFFFF0;
    font-family: "TH SarabunPSK";
        font-size: 18px;
    }
.txtsarabun {
font-family:"TH SarabunPSK";
font-size:20px;
}	
.style2 {
	font-family:"TH SarabunPSK";
	font-size: 18;
	}
</style>
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
<div style="margin-left:50px; margin-top: 30px;">
<form name="f1" method="post" action="<?php echo $PHP_SELF ?>" Onsubmit="return checkForm();">
	<p style="font-size:24px;"><b>ค้นหาคนไข้จากเลขบัตรประจำตัว13หลัก</b></p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ID&nbsp;&nbsp;&nbsp;
	<input name="idcard" type="text" class="txtsarabun" id="aLink" size="16">
  </p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="B1" type="submit" class="txtsarabun" value="     ค้นหา     ">
  &nbsp;&nbsp;&nbsp;&nbsp; <input name="B2" type="reset" class="txtsarabun" value="  ยกเลิก  ">
  </p>
</form>
<script type="text/javascript">
	document.getElementById('aLink').focus();
</script>
		
<table width="85%" border="0" cellpadding="10" cellspacing="4" bordercolor="#FFFFFF">
<tr bgcolor="6495ED">
		<th bgcolor="#009688">เลขบัตร ปชช.</th>
	  <th bgcolor="#009688">HN</th>
	  <th bgcolor="#009688">ยศ</th>
	  <th bgcolor="#009688">ชื่อ</th>
	  <th bgcolor="#009688">สกุล</th>
	  <th bgcolor="#009688">สิทธิ</th>
	  <th bgcolor="#009688">มา รพ.</th>
	  <th bgcolor="#009688">ตรวจนัด</th>
	  <th bgcolor="#009688">ตรวจนอน</th>
      <th bgcolor=#009688>เช็คสิทธิ์ ธ.ออมสิน</th>
      <th bgcolor=#009688>เช็คสิทธิ์ ธปท.</th>
	<th bgcolor=#009688>เช็คสิทธิ์ ททท.</th>      
	  <th bgcolor="#009688"></th>
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
				$color = "#208eb4";
			}else{
				$color = "#FF8C8C";
			}
		}else if(substr($ptright,0,3)=='R03'){
			$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "#7dcf80";
			}else{
				$color = "#FF8C8C";
			}
		}else{
			$color = "#fdee6e";
		}

		if(!empty($idcard)){
			$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				echo"ผู้ป่วยมีสิทธิประกันสังคม";
			}else{
				$sql1="Select Idcard From gsbdata where Idcard LIKE '$idcard%' limit 1 ";
				if(Mysql_num_rows(Mysql_Query($sql1)) > 0){
					echo"ผู้ป่วยมีสิทธิธนาคารออมสิน";
				}else{
						$sql2="Select emp_idcard From botdata where emp_idcard LIKE '$idcard%' limit 1 ";
						if(Mysql_num_rows(Mysql_Query($sql2)) > 0){
							echo"ผู้ป่วยมีสิทธิธนาคารแห่งประเทศไทย";
						}else{
							$sql3="Select emp_idcard From traveldata where emp_idcard LIKE '$idcard%' limit 1 ";
							if(Mysql_num_rows(Mysql_Query($sql3)) > 0){
								echo"ผู้ป่วยมีสิทธิการท่องเที่ยวแห่งประเทศไทย";
							}else{							
								echo"";
							}
						}
				}
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

		print (" <tr style='font-size: 18px;'>\n".
		"  <td BGCOLOR=".$color."><a target=\"_BLANK\" onclick=\"checkIpd(this, event, '$hn')\" href=\"opedit.php?cIdcard=$idcard&cHn=$hn&cName=$name&cSurname=$surname\">$idcard</a></td>\n".
		"  <td BGCOLOR=".$color.">$hn</td>\n".
		"  <td BGCOLOR=".$color.">$yot</td>\n".
		"  <td BGCOLOR=".$color.">$name</td>\n".
		"  <td BGCOLOR=".$color.">$surname</td>\n".
		"  <td BGCOLOR=".$color.">$ptright</td>\n".
		"  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"hndaycheck.php?hn=$hn\">มา รพ.</a></td>\n".
		"  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"appdaycheck.php?hn=$hn\">ตรวจนัด</a></td>\n".
		"  <td BGCOLOR=".$color."><a target=\"_BLANK\" href=\"ancheck.php?hn=$hn\">ตรวจนอน</a></td>\n".
		"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"gsb_chk.php\">ตรวจสอบ</a></td>\n".	
		"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"bot_chk.php\">ตรวจสอบ</a></td>\n".
		"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"travel_chk.php\">ตรวจสอบ</a></td>\n".	
		"  <td BGCOLOR=".$color.">
		<button type=\"button\" class=\"txtsarabun\" id=\"checkPt\" onclick=\"checkPtRight(this, event, '$idcard')\">ตรวจสอบสิทธิ</button><br>
		<a target= _BLANK href=\"register_print_qrcode.php?hn=$hn\">พิมพ์ QR Code</a><br><br>
		<a href=\"javascript:void(0);\" onclick=\"testCheckSit('$idcard')\">WebService สปสช</a>
		</td>\n".
		" </tr>\n");
	} // End while

} // End if
?>
</table>

<?php 
$qToken = mysql_query("SELECT `cid`,`token` FROM `runno_token` WHERE `id` = '1'") or die(mysql_error());;
$t = mysql_fetch_array($qToken);
$person_id = preg_replace('/\D/','', $t['cid']);
$smctoken = $t['token'];
?>
<style>
#ptrightNotify{top: 2%;left: 50%;width:600px;height:250px;margin-top: 1em;margin-left: -300px;border: 1px solid #ccc;background-color: #f3f3f3;position:fixed;}
#ptnotifyHeader{padding: 6px;background: #636363;text-align: right;}
#ptrightClose{font-size: 24px;color: #fff;text-decoration: none;}
#ptnotifyContent{padding: 6px;}
</style>
<div id="ptrightNotify" style="display: none;">
    <div id="ptnotifyHeader">
        <a href="javascript:void(0);" id="ptrightClose" onclick="document.getElementById('ptrightNotify').style.display = 'none';">Close</a>
    </div>
    <div style="padding: 6px;" id="ptnotifyContent">กำลังตรวจสอบสิทธิจาก WebService สปสช กรุณารอสักครู่</div>
</div>

<script type="text/javascript" src="js/nhso.js"></script>
<script type="text/javascript">
    function testCheckSit(idcard){ 
		document.getElementById('ptnotifyContent').innerHTML = 'กำลังตรวจสอบสิทธิจาก WebService สปสช กรุณารอสักครู่';
        registerChecksit('ptnotifyContent',idcard,'<?=$person_id;?>','<?=$smctoken;?>');
        document.getElementById('ptrightNotify').style.display = '';
    }

    /* checkIpd */
    function checkIpd(link, ev, hn){
        
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
<div style="margin-top: 30px; font-size:18px; font-weight:bold;">
<FONT COLOR="#990000">***คำอธิบาย***</FONT> <BR>
    <FONT COLOR="#fdee6e">สีเหลือง คือ ยังไม่ได้ทำการตรวจสิทธิการรักษา</FONT><BR>
    <FONT COLOR="#208eb4">สีน้ำเงิน คือ ตรวจสอบแล้ว มีสิทธิประกันสังคม</FONT><BR>
    <FONT COLOR="#7dcf80">สีเขียว คือ ตรวจสอบแล้ว มีสิทธิจ่ายตรง</FONT><BR>
    <FONT COLOR="#FF0033">สีแดง คือ ไม่มีสิทธิ</FONT><BR>
</div>
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
</div>