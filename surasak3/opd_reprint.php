<?php
include("connect.inc");  
session_start();
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
</style>
<title>พิมพ์ใบตรวจโรคผู้ป่วยนอก</title>
<?php
    $today=date("d-m-").(date("Y")+543);
    print "<strong class=\"txtsarabun\">วันที่ $today  รายการใบตรวจโรคผู้ป่วยนอก</strong>";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>";
    $today=(date("Y")+543)."-".date("m-d");
?>
<div style="margin-left:50px; margin-top: 30px;">
<form method="post" action="opd_reprint.php">
    <p style="font-size:24px;"><b>ค้นหาจาก</b></p>
    <div><b>HN ผู้ป่วย</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="hn" type="text" class="txtsarabun" id="aLink"  size="50" height="40">
    </div>
	<div>หรือ</div>
    <div><b>ประเภท</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select name="case" id="case" class="txtsarabun">
              <?php 
		echo "<option value='' >------------เลือกดูข้อมูล------------</option>";
		$sql = "select type_name from typeopcard";
		$result = mysql_query($sql);
		while(list($typename) = mysql_fetch_row($result)){
		
		echo "<option value='".$typename."' >".$typename."</option>";
		
		}
		?>
        </select>
    </div>
    <div>หรือ</div>
    <div>
        <?php
        $post_clinic = $_POST['clinic'];
        ?>
        <b>คลินิก</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <select name="clinic" id="clinic" class="txtsarabun">
            <option value="0">แสดงทั้งหมด</option>
            <?php
            $q = mysql_query("SELECT * FROM `clinic` ORDER BY `code`");
            while ($a = mysql_fetch_assoc($q)) {
                ?><option value="<?=$a['detail'];?>"><?=$a['detail'];?></option><?php
            }
            ?>
        </select>
    </div> 	
    <p style="margin-left:100px;">
    <input name="B1" type="submit" class="txtsarabun" value="     ค้นหา     ">
    &nbsp;&nbsp;&nbsp;&nbsp; <input name="B2" type="reset" class="txtsarabun" value="     ยกเลิก     " onclick="clearData()">
    </p>
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
<table width="90%">
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
  <th bgcolor="#16A085">สติ๊กเกอร์ QR CODE</th>
  <th bgcolor="#16A085">ใบนัด</th>
  <th bgcolor="#16A085" width="10%">แบบฟอร์มใบตรวจโรค<br> (กรณีใช้ต่อด้านหลัง)</th>
 </tr>

<?php
    $num=0;
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
	
	$result = mysql_query($query)
        or die("Query failed");


    while (list ($thidate,$thdatehn,$ptname,$hn,$ptright,$doctor,$vn,$clinic,$toborow) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($thidate,11);

	$sql112 = "Select row_id From appoint where hn = '".$hn."' and apptime !='ยกเลิกการนัด'  and date LIKE '$today%' order by row_id desc limit 1 ";
	$result112 = Mysql_Query($sql112);
	$numapp=mysql_num_rows($result112);
	list($row_id) = Mysql_fetch_row($result112);
	if($numapp > 0){
		$printapp="<A target=_BLANK HREF=\"appinsert2.php?row_id=".urlencode($row_id)."\">พิมพ์</A>";	
	}else{
		$printapp="";
	}		

        print (" <tr>\n".
           "  <td BGCOLOR=#A2D9CE align='center'>$num</td>\n".
           "  <td BGCOLOR=#A2D9CE>$time</td>\n".
           "  <td BGCOLOR=#A2D9CE>$ptname</td>\n".
           "  <td BGCOLOR=#A2D9CE>$hn</td>\n".
           "  <td BGCOLOR=#A2D9CE>$vn</td>\n".
		   "  <td BGCOLOR=#A2D9CE>$ptright</td>\n".
		   "  <td BGCOLOR=#A2D9CE>$toborow</td>\n".
   		   "  <td BGCOLOR=#A2D9CE>$doctor</td>\n".
		   "  <td BGCOLOR=#A2D9CE>$clinic</td>\n".
		   "  <td BGCOLOR=#A2D9CE align='center'><A target=_BLANK HREF=\"digital_opd.php?dthn=".urlencode($thdatehn)."\">พิมพ์</A></td>\n".
		   "  <td BGCOLOR=#A2D9CE align='center'><A target=_BLANK HREF=\"printQrCode_opd1.php?hn=".urlencode($hn)."\">พิมพ์</A></td>\n".
		   "  <td BGCOLOR=#A2D9CE>$printapp</td>\n".
		   "  <td BGCOLOR=#A2D9CE align='center'><A target=_BLANK HREF=\"digital_opd_form.php?dthn=".urlencode($thdatehn)."\">พิมพ์แบบฟอร์ม</A></td>\n".
		   " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>
</div>