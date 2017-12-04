<?
session_start();
include("connect.inc");
function calcage($birth){

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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
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

<body>
<? if(!isset($_GET['view'])&!isset($_GET['stricker'])){?>
<div id="no_print" > 
<form action="pdx_ofyear.php" method="post">
<center><font class="pdxhead"><strong>ใบตรวจสุขภาพประจำปีแบบกลุ่ม</strong></font></center>
<table class="pdxhead" border="1" bordercolor="#FFFF00">
  <tr><td width="480" align="center" bgcolor="#FFFF99"><strong>กรอกข้อมูล HN </strong></td></tr>
  <tr><td>HN: <input name="hn" type="text" size="10" class="pdxhead"  /> 
  <input type="submit"  value="   ตกลง   " name="okhn" class="pdxhead"/></td></tr>
  <tr><td>ชื่อ - สกุล : <input name="namep" type="text" size="20" class="pdxhead"  /> 
  <input type="submit"  value="   ตกลง   " name="okhn" class="pdxhead"/></td></tr>
</table>
<br />
<a href="search_dxofyear.php" target="_blank">****ค้นหาจากชื่อ-สกุล****</a>
<br />
<a href="pdx_ofyear.php">****หน้าแรกตรวจสุขภาพประจำปี****</a>
<br />
<a href ="../nindex.htm" >**** &lt;&lt; เมนู****</a>
</form>
</div>

<?
}
if(isset($_POST['okhn'])){
	$sql = "select concat(yot,' ',name,' ',surname),dbirth,concat(address,' ',tambol,' ',ampur,' ',changwat),phone from opcard where hn = '".$_POST['hn']."'";
	$result = mysql_query($sql);
	$sum = mysql_num_rows($result);
	if($sum=="0"){
		$_SESSION["age_n"] = "วัน/เดือน/ปี เกิด....................... อายุ :.........ปี";
		$_SESSION['add_n'] = ".....................................................................................................................................";
		$_SESSION['tel_n'] = ".......................";
		$_SESSION['name_n'] = $_POST['namep'];
		$_SESSION['hn_n'] = ".......................";
	}else{
		$result = mysql_query($sql);
		$arr = mysql_fetch_array($result);
		$_SESSION["age_n"] = "วัน/เดือน/ปี เกิด....................... อายุ :.........ปี";
		$_SESSION['add_n'] = ".....................................................................................................................................";
		$_SESSION['tel_n'] = ".......................";
		$_SESSION['name_n'] = $arr[0];
		$_SESSION['hn_n'] = $_POST['hn'];
	}
	?>
<form action="<? $_SERVER['PHP_SELF']?>" method="POST" name="pdxofyear1">
	<table>
    	<tr>
    	  <td colspan="2" align="center" bgcolor="#FFFF99" class="pdxhead"><strong>ข้อมูลประวัติ</strong></td>
   	  </tr>
    	<tr>
        	<td width="336"><span class="pdxhead">ชื่อ-สกุล : 
       	    <?=$_SESSION['name_n']?>
        	</span></td>
            <td width="357">&nbsp;</td>
        </tr>
        <tr>
        	<td><span class="pdxhead">หน่วยงาน : 
                <select name="company">
                  <option value='SCG-บริษัท ปูนซีเมนต์ไทย (ลำปาง) จำกัด'>บริษัท ปูนซีเมนต์ไทย (ลำปาง) จำกัด</option> 
                </select>
            </span></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><span class="pdxhead">แบบตรวจสุขภาพ : 
            <select name="type">
              <option value='กลุ่มที่ 1 พนักงานปูนลำปาง/SCG-A(ไม่ได้สัมผัสสารเคมีและกากวัสดุไม่ใช้แล้ว)'>กลุ่มที่ 1 พนักงานปูนลำปาง/SCG-A(ไม่ได้สัมผัสสารเคมีและกากวัสดุไม่ใช้แล้ว)</option>
              <option value='กลุ่มที่ 2 พนักงานปูนลำปาง(สัมผัสสารเคมี)'>กลุ่มที่ 2 พนักงานปูนลำปาง(สัมผัสสารเคมี)</option>
              <option value='กลุ่มที่ 3 พนักงานปูนลำปาง(สัมผัสกากวัสดุไม่ใช้แล้ว)'>กลุ่มที่ 3 พนักงานปูนลำปาง(สัมผัสกากวัสดุไม่ใช้แล้ว)</option>
              <option value='กลุ่มที่ 4 พนักงานคู่ธุรกิจ(สัมผัสสารเคมี)'>กลุ่มที่ 4 พนักงานคู่ธุรกิจ(สัมผัสสารเคมี)</option>
              <option value='กลุ่มที่ 5 พนักงานคู่ธุรกิจ(สัมผัสกากวัสดุไม่ใช้แล้ว)'>กลุ่มที่ 5 พนักงานคู่ธุรกิจ(สัมผัสกากวัสดุไม่ใช้แล้ว)</option>
              <option value='กลุ่มที่ 6 พนักงานคู่ธุรกิจ(สัมผัสฝุ่นปูนซีเมนต์,ฝุ่น Biomass)'>กลุ่มที่ 6 พนักงานคู่ธุรกิจ(สัมผัสฝุ่นปูนซีเมนต์,ฝุ่น Biomass)</option>
              <option value='กลุ่มที่ 7 พนักงานคู่ธุรกิจ(สัมผัสเสียงดังขณะเครื่องจักรทำงาน)'>กลุ่มที่ 7 พนักงานคู่ธุรกิจ(สัมผัสเสียงดังขณะเครื่องจักรทำงาน)</option>
              <option value='กลุ่มที่ 8 พนักงานคู่ธุรกิจ(สัมผัสกากอุตสาหกรรมที่ไม่ใช้แล้ว และสัมผัสเสียงดังขณะเครื่องจักรทำงาน)'>กลุ่มที่ 8 พนักงานคู่ธุรกิจ(สัมผัสกากอุตสาหกรรมที่ไม่ใช้แล้ว และสัมผัสเสียงดังขณะเครื่องจักรทำงาน)</option>
              <option value='กลุ่มที่ 9 พนักงานคู่ธุรกิจ(สัมผัสสารเคมีและสัมผัสเสียงดังขณะเครื่องจักรทำงาน)'>กลุ่มที่ 9 พนักงานคู่ธุรกิจ(สัมผัสสารเคมีและสัมผัสเสียงดังขณะเครื่องจักรทำงาน)</option>
              <option value='กลุ่มที่ 10 พนักงานคู่ธุรกิจ(สัมผัสฝุ่นปูนซีเมนต์,ฝุ่น Biomass,เสียงดังขณะเครื่องจักรทำงาน)'>กลุ่มที่ 10 พนักงานคู่ธุรกิจ(สัมผัสฝุ่นปูนซีเมนต์,ฝุ่น Biomass,เสียงดังขณะเครื่องจักรทำงาน)</option>
              <option value='กลุ่มที่ 11 บ. พี.วาย.เมตัล งานสัญญาบำรุงรักษาเครื่องจักรชุด Clinker Production'>กลุ่มที่ 11 บ. พี.วาย.เมตัล งานสัญญาบำรุงรักษาเครื่องจักรชุด Clinker Production</option>
              <option value='กลุ่มที่ 12 หจก.เอ็ม.เควี.ลำปางเซอร์วิส 1'>กลุ่มที่ 12 หจก.เอ็ม.เควี.ลำปางเซอร์วิส 1</option>
              <option value='กลุ่มที่ 13 หจก.เอ็ม.เควี.ลำปางเซอร์วิส 2'>กลุ่มที่ 13 หจก.เอ็ม.เควี.ลำปางเซอร์วิส 2</option>
              <option value='กลุ่มที่ 14 หจก.พลีบัตรลำปางรวมช่าง 1'>กลุ่มที่ 14 หจก.พลีบัตรลำปางรวมช่าง 1</option>
              <option value='กลุ่มที่ 15 หจก.พลีบัตรลำปางรวมช่าง 2'>กลุ่มที่ 15 หจก.พลีบัตรลำปางรวมช่าง 2</option>
              <option value='กลุ่มที่ 16 บ.บ้านแพรกเอ็นจิเนียริ่ง'>กลุ่มที่ 16 บ.บ้านแพรกเอ็นจิเนียริ่ง</option>              <option value='กลุ่มที่ 17 บ.บ้านสาเจริญกิจ'>กลุ่มที่ 17 บ.บ้านสาเจริญกิจ</option>
              <option value='กลุ่มที่ 18 หจก.เมืองเหนือเทคนิค'>กลุ่มที่ 18 หจก.เมืองเหนือเทคนิค</option>
            </select>
          </span></td>
        </tr>
        <tr>
          <td colspan="2"><span class="pdxhead">หมายเหตุ</span> <input type="text" size="20" name="comment" /></td>
        </tr>
        <tr><td colspan="2" align="center"><input type="submit"  value="   ตกลง   " name="okselect"/></td></tr>
</table>
</form>
	<?
}elseif(isset($_POST['okselect'])){
        $pic = explode("-",$_POST['company']);
		if($_SESSION['hn_n']=="......................."){
			$sql2 = "insert into predxofyear(row_id,hn,ptname,company,type_check,comment) value ('','','".$_SESSION['name_n']."','".$_POST['company']."','".$_POST['type']."','".$_POST['comment']."')";
		}else{
			$sql2 = "insert into predxofyear(row_id,hn,ptname,company,type_check,comment) value ('','".$_SESSION['hn_n']."','".$_SESSION['name_n']."','".$_POST['company']."','".$_POST['type']."','".$_POST['comment']."')";
		}
		if(mysql_query($sql2)){
				
		}else{
			echo "บันทึกข้อมูลผิดพลาด กรุณาบันทึกข้อมูลใหม่";
		}
	?>
<table width="100%"><tr><td>
<table width="87%">
    <tr>
    	<td rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
    	<td width="435" align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">แบบการตรวจสุขภาพ    	  
   	    <?=$pic[1]?></span></span></strong></td>
        <td rowspan="3" align="center" valign="top"><img src="images/<?=$pic[0]?>.jpg" width="120" height="75" /></td>
    </tr>
    <tr>
      <td align="center" class="pdxhead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305</strong></td>
      </tr>
    <tr>
      <td align="center" class="pdxhead">ตรวจเมื่อวันที่..................................เวลา.....................</td>
      </tr>
      </table>
      <span class="pdx"><strong>คำแนะนำสำหรับการตรวจสุขภาพ</strong><br />
      <strong>1. กรุณากรอกข้อมูล<br />
2. ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจตามสถานีที่กำหนดทุกสถานี <br />
3. เมื่อตรวจครบทุกสถานีแล้วกรุณานำใบตรวจสุขภาพส่งคืนที่สถานีที่ 6 <br />
4. ผู้เข้ารับการตรวจสุขภาพ มีปัญหาหรือข้อสงสัย ติดต่อสอบถามได้ที่สถานีที่ 6</strong></strong></span><br />
<br />
      <table width="83%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
      <tr><td>
      <table>
    <tr>
      <td class="pdxpro">HN :
        <strong>
        <?=$_SESSION['hn_n']?>
        </strong>       ชื่อ-สกุล : 
      <strong><?=$_SESSION['name_n']?></strong>
      <?=$_SESSION["age_n"]?> เลขบัตรปชช :.................................
      </td>
      </tr>
    <tr>
      <td class="pdx">ที่อยู่ :
        <?=$_SESSION['add_n']?>
โทรศัพท์ :
<?=$_SESSION['tel_n']?></td>
    </tr>
    <tr>
      <td class="pdx">เชื้อชาติ :.................. สัญชาติ :.................. ศาสนา :.................. </td>
    </tr>
    <tr>
      <td class="pdx">กลุ่มเลือด :................. สถานภาพ  [ ] โสด [ ] สมรส [ ] หย่า/หม้าย [ ] อื่นๆ </td>
    </tr>
    <tr>
      <td class="pdx">บิดา :................................... มารดา :................................... คู่สมรส :................................... </td>
    </tr>
    <tr>
      <td class="pdx"> ผู้ที่สามารถติดต่อได้ :.................................................. เกี่ยวข้องเป็น...........................โทรศัพท์............................</td>
    </tr>
    <tr>
      <td class="pdx">สิทธิการรักษา [ ] บริษัท(มหาชน) [ ] ประกันสังคม [ ] เงินสด [ ] อื่นๆ .....................</td>
    </tr>
      </table>
      </td></tr>
    </table>
    <br />
	<table width="83%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
    <tr><td>
    <table>
    <tr>
      <td colspan="3" class="pdx"><strong>สถานีที่ 1 ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจสถานีนี้ทุกคน</strong></td>
    </tr>
    <tr>
      <td colspan="3" class="pdx">น้ำหนัก :.............กก. ส่วนสูง :.............ซม. โรคประจำตัว :.................................. แพ้ยา :........................................................... </td>
      </tr>
    <tr>
      <td colspan="3" class="pdx">T :.................... C ํ P :...................ครั้ง/นาที R :....................ครั้ง/นาที BP :.........../..............mmHg.</td>
      </tr>
      </table></td></tr>
    </table>
    <?
	$ban = explode(" ",$_POST['type']);
    $arrtype = array('ตรวจ x-ray ปอด','ตรวจสมรรถภาพปอด','ตรวจสมรรถภาพการได้ยิน','ตรวจหน้าที่ของตับ','ตรวจหน้าที่ของไต','ตรวจความสมบูรณ์ของเม็ดเลือด','ตรวจปัสสาวะ','ตรวจปริมาณโลหะหนัก');
	?>
<table width="857">
    <tr>
      <td class="pdxpro">&nbsp;</td>
    </tr>
    <tr>
      <td class="pdxpro"><strong>รายการตรวจสุขภาพ <?=$row['type_check']?></strong></td>
      </tr>
    <tr>
      <td class="pdx">
	  <? 
	  	if($ban[1]=="1"){
			$q =1;
			for($r=0;$r<4;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="2"){
			$q =1;
			for($r=0;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="3"){
			$q =1;
			for($r=0;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="4"){
			$q =1;
			for($r=3;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="5"){
			$q =1;
			for($r=3;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="6"){
			$q =1;
			for($r=0;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="7"){
			$q =1;
			for($r=2;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="8"){
			$q =1;
			for($r=2;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="9"){
			$q =1;
			for($r=2;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="10"){
			$q =1;
			for($r=0;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="11"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="12"){
				echo "1. ตรวจ x-ray ปอด<br>";
				echo "2. ตรวจสมรรถภาพการได้ยิน";
		}
		elseif($ban[1]=="13"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="14"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="15"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="16"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="17"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="18"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
	  ?></td>
      </tr>
    <tr>
      <td class="pdx"><? if($_POST['comment']==""){ } else{ echo "หมายเหตุ :".$_POST['comment'];}?></td>
    </tr>
    <tr>
      <td class="pdx"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
      </tr>
    <tr>
      <td class="pdx">
	  <? 
	  	if($ban[1]=="1"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="2"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br> ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="3"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="4"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="5"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="6"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="7"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></table>";
		}
		elseif($ban[1]=="8"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="9"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="10"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="11"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="12"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="13"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="14"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="15"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="16"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="17"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="18"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
	  ?></td>
    </tr>
    <tr>
      <td class="pdx">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" class="pdx">ผู้ตรวจสอบ.....................................................................</td>
    </tr>
    </table>
</td></tr></table>
	<?
}elseif(isset($_GET['view'])){
	?>
		<script>
           window.print();
      	</script>
	<?
	$sqls = "select * from predxofyear where row_id = '".$_GET['view']."'";
	$datenow = (date("Y")+543).date("-m-d H:i:s");
	$time = date("H:i:s");
	$date = date("d-m-").(date("Y")+543);
	$result = mysql_query($sqls);
	$row = mysql_fetch_array($result);
	$pic = explode("-",$row['company']);
	$ban = explode(" ",$row['type_check']);
    $arrtype = array('ตรวจ x-ray ปอด','ตรวจสมรรถภาพปอด','ตรวจสมรรถภาพการได้ยิน','ตรวจหน้าที่ของตับ','ตรวจหน้าที่ของไต','ตรวจความสมบูรณ์ของเม็ดเลือด','ตรวจปัสสาวะ','ตรวจปริมาณโลหะหนัก');
	$sqlupdate = "update predxofyear SET thidate = '$datenow' where row_id = '".$_GET['view']."'";
	mysql_query($sqlupdate);

	?>
	<table width="100%"><tr><td>
<table width="87%">
    <tr>
    	<td rowspan="4" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
    	<td width="435" align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">แบบการตรวจสุขภาพ    	  
   	    <?=$pic[1]?></span></span></strong></td>
        <td rowspan="4" align="center" valign="top"><img src="images/<?=$pic[0]?>.jpg" width="120" height="75" /></td>
    </tr>
    <tr>
      <td align="center" class="pdxhead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305</strong></td>
      </tr>
    <tr>
      <td align="center" class="pdxhead">ตรวจเมื่อวันที่......<?=$date?>.....เวลา....<?=$time?>...</td>
      </tr>
      </table>
      <span class="pdx"><strong>คำแนะนำสำหรับการตรวจสุขภาพ</strong><br />
      <strong>1. กรุณากรอกข้อมูล<br />
2. ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจตามสถานีที่กำหนดทุกสถานี <br />
3. เมื่อตรวจครบทุกสถานีแล้วกรุณานำใบตรวจสุขภาพส่งคืนที่สถานีที่ 6 <br />
4. ผู้เข้ารับการตรวจสุขภาพ มีปัญหาหรือข้อสงสัย ติดต่อสอบถามได้ที่สถานีที่ 6</strong></strong></span><br />
<br />
      <table width="83%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
      <tr><td>
      <table>
    <tr>
      <td class="pdxpro">HN :
        <strong>
        <?=$row['hn']?>
        </strong>       ชื่อ-สกุล : 
      <strong><?=$row['ptname']?></strong>
      วัน/เดือน/ปี เกิด....................... อายุ :...........ปี เลขบัตรปชช :.................................
      </td>
      </tr>
    <tr>
      <td class="pdx">ที่อยู่ :
        .....................................................................................................................................
โทรศัพท์ :
.......................</td>
    </tr>
    <tr>
      <td class="pdx">เชื้อชาติ :.................. สัญชาติ :.................. ศาสนา :.................. </td>
    </tr>
    <tr>
      <td class="pdx">กลุ่มเลือด :................. สถานภาพ  [ ] โสด [ ] สมรส [ ] หย่า/หม้าย [ ] อื่นๆ </td>
    </tr>
    <tr>
      <td class="pdx">บิดา :................................... มารดา :................................... คู่สมรส :................................... </td>
    </tr>
    <tr>
      <td class="pdx"> ผู้ที่สามารถติดต่อได้ :.................................................. เกี่ยวข้องเป็น...........................โทรศัพท์............................</td>
    </tr>
    <tr>
      <td class="pdx">สิทธิการรักษา [ ] บริษัท(มหาชน) [ ] ประกันสังคม [ ] เงินสด [ ] อื่นๆ .....................</td>
    </tr>
      </table>
      </td></tr>
    </table>
    <br />
	<table width="83%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
    <tr><td>
    <table>
    <tr>
      <td colspan="3" class="pdx"><strong>สถานีที่ 1 ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจสถานีนี้ทุกคน</strong></td>
    </tr>
    <tr>
      <td colspan="3" class="pdx">น้ำหนัก :.............กก. ส่วนสูง :.............ซม. โรคประจำตัว :.................................. แพ้ยา :........................................................... </td>
      </tr>
    <tr>
      <td colspan="3" class="pdx">T :.................... C ํ P :...................ครั้ง/นาที R :....................ครั้ง/นาที BP :.........../..............mmHg.</td>
      </tr>
      </table></td></tr>
    </table>

<table width="857">
    <tr>
      <td class="pdxpro">&nbsp;</td>
    </tr>
    <tr>
      <td class="pdxpro"><strong>รายการตรวจสุขภาพ <?=$_POST['type']?></strong></td>
      </tr>
    <tr>
      <td class="pdx">
	  <? 
	  	if($ban[1]=="1"){
			$q =1;
			for($r=0;$r<4;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="2"){
			$q =1;
			for($r=0;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="3"){
			$q =1;
			for($r=0;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="4"){
			$q =1;
			for($r=3;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="5"){
			$q =1;
			for($r=3;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="6"){
			$q =1;
			for($r=0;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="7"){
			$q =1;
			for($r=2;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="8"){
			$q =1;
			for($r=2;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="9"){
			$q =1;
			for($r=2;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="10"){
			$q =1;
			for($r=0;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="11"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="12"){
				echo "1. ตรวจ x-ray ปอด<br>";
				echo "2. ตรวจสมรรถภาพการได้ยิน";
		}
		elseif($ban[1]=="13"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="14"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="15"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="16"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="17"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="18"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
	  ?></td>
      </tr>
    <tr>
      <td class="pdx"><? if($row['comment']==""){ } else{ echo "หมายเหตุ :".$row['comment'];}?></td>
    </tr>
    <tr>
      <td class="pdx"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
      </tr>
    <tr>
      <td class="pdx">
	  <? 
	  	if($ban[1]=="1"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="2"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br> ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="3"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="4"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="5"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="6"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="7"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></table>";
		}
		elseif($ban[1]=="8"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="9"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 2<br>เจาะเลือด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="10"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="11"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="12"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 5<br>เอ็กซ์เรย์<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="13"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="14"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="15"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="16"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 4<br>ตรวจการได้ยิน<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="17"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="18"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 1<br>ซักประวัติ<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>สถานี 3<br>ตรวจสมรรถภาพปอด<br>ผู้รับผิดชอบ<br>.............................</td></tr></table></td></tr></table>";
		}
	  ?></td>
    </tr>
    <tr>
      <td class="pdx">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" class="pdx">ผู้ตรวจสอบ.....................................................................</td>
    </tr>
    </table>
</td></tr></table>
	<?
}elseif(isset($_GET['stricker'])){
	$sqls = "select * from predxofyear where row_id = '".$_GET['stricker']."'";
	$result = mysql_query($sqls);
	$row = mysql_fetch_array($result);
	$pic = explode("-",$row['company']);
	echo "<span class='stricker1'>".$pic[1]."</span><br>";
	?>
	<span class='stricker'><strong>HN:<?=$row['hn']?></strong></span><br />
    <span class='stricker'><strong>ชื่อ:<?=$row['ptname']?></strong></span><br />
	<span class='stricker1'><?=$row['type_check']?></span>
    <script>
    window.print();
    </script>
<?
}
include("unconnect.inc");

?>
</body>
</html>