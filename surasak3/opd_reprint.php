<?php
include("connect.inc");  
session_start();

$def_fullm_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}
?>
<style>
body {
	background-color: #FFFFF0;
    font-family: "TH SarabunPSK";
    font-size: 20px;
    }
.txtsarabun {
font-family:"TH SarabunPSK";
font-size:20px;
}	
.style2 {
	font-family:"TH SarabunPSK";
	font-size: 20px;
	}
	

a:link, a:visited {
  background-color: white;
  color: black;
  border: 2px solid #2980B9;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-weight:bold;
}

a:hover, a:active {
  background-color: #2980B9;
  color: white;
}

</style>
<title>พิมพ์ใบตรวจโรคผู้ป่วยนอก</title>
<?php
    $today=date("d-m-").(date("Y")+543);
    print "<strong class=\"txtsarabun\" style='font-size:28px;'>รายการใบตรวจโรคผู้ป่วยนอก</strong>";
	print "<strong class=\"txtsarabun\" style='margin-left:20px;font-size:28px;'>วันที่ $today</strong>";
    $today=(date("Y")+543)."-".date("m-d");
?>
<div style="margin-left:50px; margin-top: 30px;">
<form method="post" action="opd_reprint.php">
    <p style="font-size:24px;"><b>ค้นหาจาก</b></p>

    <table style="font-size:20px;">
        <tr>
            <td><b>HN ผู้ป่วย</b></td>
            <td><input name="hn" type="text" class="txtsarabun" id="aLink"  size="50" height="40"></td>
        </tr>
        <tr>
            <td colspan="2" style="line-height:16px;">หรือ</td>
        </tr>
        <tr>
            <td><b>ประเภท</b></td>
            <td>
                <select name="case" id="case" class="txtsarabun">
                    <option value="">------------เลือกดูข้อมูล------------</option>
                    <?php 
                    $sql = "select type_name from typeopcard";
                    $result = mysql_query($sql);
                    while(list($typename) = mysql_fetch_row($result)){
                        echo "<option value='".$typename."' >".$typename."</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="line-height:16px;">หรือ</td>
        </tr>
        <tr>
            <td><b>คลินิก</b></td>
            <td>
                <?php
                $post_clinic = $_POST['clinic'];
                ?>
                <select name="clinic" id="clinic" class="txtsarabun">
                    <option value="0">แสดงทั้งหมด</option>
                    <?php
                    $q = mysql_query("SELECT * FROM `clinic` ORDER BY `code`");
                    while ($a = mysql_fetch_assoc($q)) {
                        ?><option value="<?=$a['detail'];?>"><?=$a['detail'];?></option><?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="line-height:16px;">หรือ</td>
        </tr>
        <tr>
            <td align="right"><b>วันที่</b></td>
            <td>
                <?php 
                $days = range(1,31);
                ?>
                <select name="day" id="day" class="txtsarabun">
                    <?php 
                    $getDay = $_REQUEST['day'] ? $_REQUEST['day'] : date('d') ;
                    foreach ($days as $day) { 
                        $day = sprintf("%02d", $day);
                        $selected = ($day==$getDay) ? 'selected="selected"' : '';
                        ?><option value="<?=$day;?>" <?=$selected;?> ><?=$day;?></option><?php
                    }
                    ?>
                </select>
                <b>เดือน</b>
                <select name="month" id="month" class="txtsarabun">
                    <?php 
                    $getMonth = $_REQUEST['month'] ? $_REQUEST['month'] : date('m') ;
                    foreach ($def_fullm_th as $key => $month) { 
                        $selected = ($key==$getMonth) ? 'selected="selected"' : '';
                        ?><option value="<?=$key;?>" <?=$selected;?> ><?=$month;?></option><?php
                    }
                    ?>
                </select>
                <b>ปี</b>
                <?php 
                $years = range(2565,(date('Y')+543));
                ?>
                <select name="year" id="year" class="txtsarabun">
                    <?php 
                    $getYear = $_REQUEST['year'] ? $_REQUEST['year'] : date('Y')+543 ;
                    foreach ($years as $year) { 
                        $selected = ($year==$getYear) ? 'selected="selected"' : '';
                        ?><option value="<?=$year;?>" <?=$selected;?> ><?=$year;?></option><?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-top:20px;">
                <input name="B1" type="submit" class="txtsarabun" value="     ค้นหา     " style="margin-right:18px;">
                <input name="B2" type="reset" class="txtsarabun" value="     ยกเลิก     " onclick="clearData()" style="margin-right:18px;">
                <input type="button" name="button" id="button" value="   กลับหน้าหลัก   " onclick="window.location='../nindex.htm'" class="txtsarabun" />
            </td>
        </tr>
    </table>

</form>
<script type="text/javascript">
    document.getElementById('aLink').focus();
    function clearData(){
        document.getElementById("clinic").selectedIndex = 0;
        document.getElementById("case").selectedIndex = 0;
        document.getElementById("aLink").value = '';
        
    }
</script>
</div>
<div style="margin-left:50px;">
<table width="95%" cellpadding="5">
 <tr>
  <th bgcolor="#16A085">#</th>
  <th bgcolor="#16A085">เวลา</th>
  <th bgcolor="#16A085">ชื่อ</th>
  <th bgcolor="#16A085">HN</th>
  <th bgcolor="#16A085">VN</th>
  <th bgcolor="#16A085">สิทธิ</th>
  <th bgcolor="#16A085">การมาโรงพยาบาล</th>
  <th bgcolor="#16A085">แพทย์</th>
  <th bgcolor="#16A085">คลินิก</th>  
  <th bgcolor="#16A085" width="10%">ใบตรวจโรค <br>(ใบต่อ)</th>
  <th bgcolor="#16A085" width="12%">สติ๊กเกอร์ QR CODE</th>
  <th bgcolor="#16A085" width="10%">ใบนัด</th>
  <th bgcolor="#16A085" width="10%">แบบฟอร์มใบตรวจโรค<br> (กรณีใช้ต่อด้านหลัง)</th>
   <th bgcolor="#A569BD" width="10%">ใบตรวจโรค <br>(ทันตกรรม)</th>
 </tr>

<?php
    $num=0; 
    if(preg_match('/(\d{4}\-\d{2}\-\d{2})/', $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']) > 0){
        $today = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
    }
    
	if(!empty($_POST["hn"])){
		$query = "SELECT thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow FROM opday WHERE hn='".$_POST["hn"]."' and thidate LIKE '$today%' ORDER BY row_id DESC ";
		echo "<div style='font-size:22px;'>ข้อมูลที่ค้นหาจาก HN ผู้ป่วย</div>";
	}else if(!empty($_POST["case"])){
		$case=substr($_POST["case"],0,4);
		$query = "SELECT thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow FROM opday WHERE toborow LIKE '".$case."%' and thidate LIKE '$today%' ORDER BY row_id DESC ";
		echo "<div style='font-size:22px;'>ข้อมูลที่ค้นหาจากประเภทการมาโรงพยาบาล</div>";
	}else if(!empty($_POST["clinic"])){
        $cli = sprintf("%s", $_POST["clinic"]);
        $query = "SELECT thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow FROM opday WHERE clinic = '$cli' and thidate LIKE '$today%' ORDER BY row_id DESC ";
		echo "<div style='font-size:22px;'>ข้อมูลที่ค้นหาจากประเภทการมาโรงพยาบาล</div>";
    }else{
		$query = "SELECT thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow FROM opday WHERE thidate LIKE '$today%' ORDER BY row_id DESC ";
		echo "<div style='font-size:22px;'>ข้อมูลทั้งหมดที่ลงทะเบียนวันนี้</div>";
	}	
	
	$result = mysql_query($query)or die("Query failed");
	$numrows = mysql_num_rows($result);
        
	if($numrows > 0){

    while (list ($thidate,$thdatehn,$ptname,$hn,$ptright,$doctor,$vn,$clinic,$toborow) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($thidate,11);

	$sql112 = "Select row_id From appoint where hn = '".$hn."' and apptime !='ยกเลิกการนัด'  and date LIKE '$today%' order by row_id desc limit 1 ";
	$result112 = Mysql_Query($sql112);
	$numapp=mysql_num_rows($result112);
	list($row_id) = Mysql_fetch_row($result112);
	if($numapp > 0){
		$printapp="<A target=_BLANK HREF=\"appinsert2.php?row_id=".urlencode($row_id)."\"><img src='images/print-green.png' height='20px' width='20px' /><div style='margin-top:5px;'>พิมพ์ใบนัด</div></A>";	
	}else{
		$printapp="";
	}

	if($_SESSION["smenucode"]=="ADMMAINOPD"){
		$printstk="<A target=_BLANK HREF=\"printQrCode_opd.php?hn=".urlencode($hn)."\"><img src='images/print.png' height='20px' width='20px' /><div style='margin-top:5px;'>พิมพ์สติ๊กเกอร์</div></A>";
	}else{
		$printstk="<A target=_BLANK HREF=\"printQrCode_opd.php?hn=".urlencode($hn)."\"><img src='images/print.png' height='20px' width='20px' /><div style='margin-top:5px;'>พิมพ์สติ๊กเกอร์ ใหญ่</div></A>
		<div style='margin-top:20px;'><A target=_BLANK HREF=\"printQrCode_opd1.php?hn=".urlencode($hn)."\"><img src='images/print.png' height='20px' width='20px' /><div style='margin-top:5px;'>พิมพ์สติ๊กเกอร์เล็ก</div></A></div>
        <div><a href='sticker_qr_opd.php?hn=".rawurldecode($hn)."' target='_blank' style='padding:0 20px; border:0;'>สติกเกอร์เล็ก PDF</div>";
	}	


if($num%2==0){
	$bg = "#A2D9CE";
}else{
	$bg = "#FFFFFF";
}
	//print_r($_SESSION);
        print (" <tr BGCOLOR='$bg'>\n".
           "  <td align='center'>$num</td>\n".
           "  <td>$time</td>\n".
           "  <td>$ptname</td>\n".
           "  <td>$hn</td>\n".
           "  <td>$vn</td>\n".
		   "  <td>$ptright</td>\n".
		   "  <td>$toborow</td>\n".
   		   "  <td>$doctor</td>\n".
		   "  <td>$clinic</td>\n".
		   "  <td align='center'><A target=_BLANK HREF=\"digital_opd.php?dthn=".urlencode($thdatehn)."\"><img src='images/printer.png' height='20px' width='20px' /><div style='margin-top:5px;'>พิมพ์เอกสาร</div></A></td>\n".
		   "  <td align='center'>$printstk</td>\n".
		   "  <td align='center'>$printapp</td>\n".
		   "  <td align='center'><A target=_BLANK HREF=\"digital_opd_form.php?dthn=".urlencode($thdatehn)."\"><img src='images/print-yellow.png' height='20px' width='20px' /><div style='margin-top:5px;'>พิมพ์แบบฟอร์ม</div></A></td>\n".
		   "  <td align='center'><A target=_BLANK HREF=\"digital_dental.php?dthn=".urlencode($thdatehn)."\"><img src='images/printer.png' height='20px' width='20px' /><div style='margin-top:5px;'>พิมพ์ใบตรวจโรค</div></A>
		   <div style='margin-top:20px;'><A target=_BLANK HREF=\"digital_dental_consentform.php?dthn=".urlencode($thdatehn)."\"><img src='images/print-yellow.png' height='20px' width='20px' /><div style='margin-top:5px;'>พิมพ์ใบยินยอม</div></A></div></td>\n".
		   " </tr>\n");
       }
	}else{
		print (" <tr>\n".
           "  <td colspan='14' BGCOLOR=#FADBD8 align='center' style='color:red; font-weight:bold; font-size:24px;'>------------------ ไม่พบข้อมูล ------------------</td>\n".
		   " </tr>\n");   
	}		
    include("unconnect.inc");
?>
</table>


</div>