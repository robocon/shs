<?php
// session_start();
include_once 'bootstrap.php';
include_once 'class_file/class_appoint.php';
include_once 'class_file/class_doctor.php';

include("connect.inc");

$app = new Appoint();
$doctor = new Doctor();

$th_days = array(0 => 'อาทิตย์',1 => 'จันทร์',2 => 'อังคาร',3 => 'พุธ',4 => 'พฤหัสบดี',5 => 'ศุกร์',6 => 'เสาร์');


$page = $_REQUEST['page'];
if($page==='loadCalendar'){ 
	$doctorCode=$_REQUEST['id'];
	$today=$_REQUEST['today'];
	$dfMonth=$_REQUEST['dfMonth'];
	$dfYear=$_REQUEST['dfYear'];
	$app->getCalendar($doctorCode,$today,$dfMonth,$dfYear);
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>โปรแกรมเลื่อนนัด</title>
<style type="text/css">
.font3 {
	font-family: "TH SarabunPSK";
	font-size:30px;
}
.font1 {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
</head>
<script language=JavaScript type=text/javascript>
function CheckAll() {
	for (var i = 0; i < document.form12.elements.length; i++) {
		if(document.form12.elements[i].type == 'checkbox'){
			document.form12.elements[i].checked = !(document.form12.elements[i].checked);
		}
	}
}
</script>
<body>
<div id="no_print" >
<center><span class="font3"><strong>โปรแกรมเลื่อนนัด</strong></span></center>
<a target=_top  href="../nindex.htm"><< ไปเมนู </a><br />
<form action="ap_putoff1.php" method="post" class="font1" name="form11">
<table width="38%" border="1" cellpadding="0" cellspacing="0">
<tr>
  <td>
	<table width="100%">
  <tr>
    <td>วันที่
		<?php 
		$dSelect = !empty($_POST['d']) ? $_POST['d'] : '' ;
		$mSelect = !empty($_POST['m']) ? $_POST['m'] : '' ;
		$ySelect = !empty($_POST['yr']) ? $_POST['yr'] : '' ;
		?>
      <select name="d">
        <option value="0">-</option>
        <?php
		for($a=1;$a<=31;$a++){
			$a = sprintf('%02d',$a);
			$selected = ($a==$dSelect) ? 'selected="selected"' : '' ;
			?>
			<option value="<?=$a?>" <?=$selected;?>><?=$a?></option>
			<?
		}
	?>
        </select>
      เดือน
      <select name="m">
        <?
		$month = array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
		for($a=1;$a<13;$a++){
			// $b = sprintf('%02d', $a);
			$selected = ($month[$a]===$mSelect) ? 'selected="selected"' : '' ;
			?>
			<option value="<?=$month[$a]?>" <?=$selected;?>><?=$month[$a]?></option>
			<?
		}
		?>
        </select>
      พ.ศ.
      <select name="yr">
        <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
        <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'";?>>
          <?=$a?>
          </option>
        <?
	}
	?>
      </select></td>
    </tr>
  <tr>
    <td>แพทย์
	<?php 
	$post_dr = $_POST['dr'];
	?>
      <select name="dr">
        <?php
	$strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
	while($objResult = mysql_fetch_array($objQuery)){ 
		$selected = ($post_dr==$objResult["name"]) ? 'selected="selected"' : '' ;
	?>
        <option value="<?=$objResult["name"];?>" <?=$selected;?> >
          <?=$objResult["name"];?>
          </option>
        <?
	}
	?>
      </select></td>
    </tr>
  <tr>
    <td align="center"><input name="okbtn" type="submit" value="  ตกลง  " class="font1"/></td>
    </tr></table></td></tr>
</table>
</form><br />
</a>
</div>
<?

$doctor111 =substr($_POST['dr'],0,5);

	if(isset($_POST['okbtn'])){
		$sql = "select * from appoint where appdate LIKE '".$_POST['d']." ".$_POST['m']." ".$_POST['yr']."%' and doctor like '$doctor111%' and apptime !='ยกเลิกการนัด'";
		
		$row = mysql_query($sql);
		$num1 = mysql_num_rows($row);
		
		if($num1>0){
			echo "<form action='ap_putoff1.php' method='post' class='font1' name='form12'>";
			echo "<strong>วันที่ ".$_POST['d']." ".$_POST['m']." ".$_POST['yr']."</strong>";
			echo "<table border='1' class='font1' style='border-collapse:collapse' width='100%'><tr><strong><td align='center'>HN</td><td align='center'>ชื่อ-สกุล</td><td align='center'>ที่อยู่</td><td align='center'>เบอร์โทร.</td><td align='center'>อายุ</td><td align='center'>นัดมาเพื่อ</td><td align='center'>วันที่</td><td align='center'>เวลา</td><td align='center'>เลือก </td></strong>";
			//<input name='chch' type='checkbox' onclick=CheckAll();>
			$i=0;
			while($result = mysql_fetch_array($row)){
				$sql3 = "select concat(address,' ',tambol,' ',ampur,' ',changwat) as address,phone from opcard where hn='".$result['hn']."'";
				$row3 = mysql_query($sql3);
				$num3 = mysql_fetch_array($row3);
				$i++;
				echo "<tr><td>".$result['hn']."</td>";
				echo "<td>".$result['ptname']."</td>";
				echo "<td>".$num3['address']."</td>";
				echo "<td>".$num3['phone']."</td>";
				echo "<td>".$result['age']."</td>";
				echo "<td>".$result['detail']."</td>";
				echo "<td>".$result['appdate']."</td>";
				echo "<td>".$result['apptime']."</td>";
				echo "<td align='center'><input name='ch".$i."' id='ch".$i."' type='checkbox' value='".$result['row_id']."' ></td></tr>";
			}?>
			</table>

			<fieldset>
				<legend>
					<h3 style="margin:0;">เลื่อนนัดเป็นวันที่</h3>
				</legend>
			
			<div id="test_calendar_main">
				<?php 
				$test = $doctor->getDoctorFromMdName($post_dr);
				echo $app->getCalendar($test['doctorcode']);
				?>
			</div>
			<script>
                // สร้าง ajax ไป get content กลับมาแสดงผลใน id=test_calendar_main
                function request_calendar(selector, path) { 
                    var request = new XMLHttpRequest();
                    request.open('GET', path, true);
                    request.onreadystatechange = function () {
                        if (this.readyState === 4) {
                            if (this.status >= 200 && this.status < 400) {
                                document.getElementById(selector).innerHTML = request.responseText;
                            } else {
                                // Error :(
                            }
                        }
                    };
                    request.send();
                }
                // default function ที่เรียกใช้ตาราง
                function show_carlendar(url){
                    request_calendar('test_calendar_main','ap_putoff1.php?page=loadCalendar&'+url);
                }
            </script>

			</fieldset>
			<br />
เวลา
<?php if($_SESSION["sIdname"]== 'ฝังเข็ม' || $_COOKIE["until"] == "ฝังเข็ม"){
		   
		   if(empty($_COOKIE["until"])){
			 @setcookie("until", "ฝังเข็ม", time()+(3600*12));
		   }
	
		   ?>
<select size="1" name="capptime">
		<option value="07:30 น. - 08:00 น.">07:30 น. - 08:00 น.</option>
			<option value="08:30 น. - 09:00 น.">08:30 น. - 09:00 น.</option>
			<option value="09:30 น. - 10:00 น.">09:30 น. - 10:00 น.</option>
			<option value="10:30 น. - 11:00 น.">10:30 น. - 11:00 น.</option>
			<option value="11:30 น. - 12:00 น.">11:30 น. - 12:00 น.</option>
			<option value="12:30 น. - 13:00 น.">12:30 น. - 13:00 น.</option>
			<option value="15:30 น. - 16:00 น.">15:30 น. - 16:00 น.</option>
			<option value="16:30 น. - 17:00 น.">16:30 น. - 17:00 น.</option>
			<option value="17:30 น. - 18:00 น.">17:30 น. - 18:00 น.</option>
			<option value="18:30 น. - 19:00 น.">18:30 น. - 19:00 น.</option>
	
	</select>
	
	   <?php }else{ ?>
		<select size="1" name="capptime">
		<option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>
		<option selected>08:00 &#3609;. - 11.00 &#3609;.</option>
		<option>07:00 &#3609;.</option>
		<option>07:30 &#3609;.</option>
		<option>08:00 &#3609;.</option>
		<option>08:30 &#3609;.</option>
		<option>09:00 &#3609;.</option>
		<option>09:30 &#3609;.</option>
		<option>10:00 &#3609;.</option>
		<option>10:30 &#3609;.</option>
		<option>11:00 &#3609;.</option>
		<option>11:30 &#3609;.</option>
		<option>12:30 &#3609;.</option>
		<option>13:00 &#3609;.</option>
		<option>13:30 &#3609;.</option>
		<option>14:00 &#3609;.</option>
		<option>14:30 &#3609;.</option>
		<option>15:00 &#3609;.</option>
		<option>15:30 &#3609;.</option>
		<option>16:00 &#3609;.</option>
		<option>16:30 &#3609;.</option>
		<option>17:00 &#3609;.</option>
		<option>17:30 &#3609;.</option>
		<option>18:00 &#3609;.</option>
		<option>18:30 &#3609;.</option>
		<option>19:00 &#3609;.</option>
		<option>19:30 &#3609;.</option>
		<option>20:00 &#3609;.</option>
		<option>21:00 &#3609;.</option>
		</select>
		<?php 
		} 
		?>
		<br>
		<input name="chdr" type="checkbox" value="1" onClick="if(document.getElementById('dr2').style.display=='none'){document.getElementById('dr2').style.display='';}else{document.getElementById('dr2').style.display='none'}"/>ต้องการเปลี่ยนแพทย์ 
		<select name="dr2" id="dr2" style="display:none">
		<?php
			$strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
			while($objResult = mysql_fetch_array($objQuery)){
				?>
				<option value="<?=$objResult["name"];?>" <?php if($doctor==$objResult["name"]) echo "selected";?>><?=$objResult["name"];?>
				</option>
				<?php
			}
		?>
		</select>
		<br>

		<input name="count" type="hidden" value="<?=$i?>" />
		<input type="submit" name="ok2" value="ตกลงเลื่อนนัด"  />
		<?
        echo "</form>";		
		}else{
		echo "ไม่มีข้อมูลการนัด";
	}
	}
	
if(isset($_POST['ok2'])){ 

	$def_fullm_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', 
					'05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', 
					'09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

	$_SESSION['putid'] = array();
	$_SESSION['cancle'] = array();
	
	$labcode= array();
	$dateadd = (date("Y")+543).date("-m-d H:i:s");

	$dateAppoint = sprintf("%s", $_POST['date_appoint']);
	list($datenew,$monnew,$yrnew) = explode(' ', sprintf("%s", $_POST['date_appoint']));

	// $_POST['datenew']=($_POST['datenew']+0);
	// if($_POST['datenew']<10){ 
	// 	$_POST['datenew'] = "0".$_POST['datenew'];
	// }
	
	// $newdate = $_POST['datenew']." ".$_POST['monnew']." ".$_POST['yrnew'];
	$newdate = $dateAppoint;
	$count = $_POST['count'];


	$month = array_keys($def_fullm_th, $monnew);
	// $appdate_en = ($_POST['yrnew']-543).'-'.$month['0'].'-'.sprintf('%02d', $_POST['datenew']);
	$appdate_en = ($yrnew-543).'-'.$month['0'].'-'.$datenew;
	

	for($a=0; $a<=$count; $a++){
		
		if(isset($_POST['ch'.$a])){
			$sql1 = "select * from appoint where row_id ='".$_POST['ch'.$a]."' ";
			// echo "<pre>";
			// var_dump($sql1);
			// echo "</pre>";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);

			// ถ้ามีการติ๊กเปลี่ยนหมอ
			if($_POST['chdr']=="1"){
				$result1['doctor'] = $_POST['dr2'];
			}

			$insert1 = "insert into appoint(
				row_id,date,officer,hn,ptname,age,doctor,appdate,apptime,room,
				detail,detail2,advice,patho,xray,other,depcode,came,diag,remark,labextra,appdate_en) 
				values
				(NULL,'".$dateadd."','".$sOfficer."','".$result1['hn']."','".$result1['ptname']."','".$result1['age']."','".$result1['doctor']."','".$newdate."','".$_POST['capptime']."','".$result1['room']."',
				'".$result1['detail']."','".$result1['detail2']."','".$result1['advice']."','".$result1['patho']."','".$result1['xray']."','".$result1['other']."','".$result1['depcode']."','".$result1['came']."','".$result1['diag']."','".$result1['remark']."','".$result1['labextra']."','$appdate_en')";
			
			if(mysql_query($insert1)){

				$idno = mysql_insert_id();

				$updatelab="UPDATE appoint_lab SET id='$idno' WHERE  id='".$_POST['ch'.$a]."'";
				$queryuplab = mysql_query($updatelab);

				$cHn = $result1['hn'];
				$update1 = "update appoint SET apptime='ยกเลิกการนัด' where row_id='".$_POST['ch'.$a]."'";
				$re = mysql_query($update1);
				if($re){
					array_push($_SESSION['putid'],$idno);
					array_push($_SESSION['cancle'],$result1['appdate']);
				}
				?>
				<div style="page-break-after:always;"></div>
				<?
			}
			else
			{
				echo mysql_error();
			}
			
		}
	} // Endfor

	// exit;

	if($re){
		?>
			<script>
                  alert("บันทึกข้อมูลเรียบร้อยแล้ว");
            </script>
            <a href="ap_putoff1print.php" target="_blank" style="font-family:AngsanaUPC; font-size:24px;">พิมพ์ใบนัด</a><br /><br />

			<a href="ap_putoff1print2.php" target="_blank" style="font-family:AngsanaUPC; font-size:24px;">พิมพ์ไปรษณียบัตร</a>
		<?
	}
}
?>

</body>
</html>