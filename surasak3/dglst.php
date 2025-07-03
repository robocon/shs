<?php
session_start();

require_once dirname(__FILE__).'/connect.php';
require_once dirname(__FILE__).'/bootstrap.php';

$user_id = trim($_SESSION['sIdname']);
if(empty($user_id)){
    echo '<a href="../nindex.htm">คลิกที่นี่</a> เพื่อเข้าสู่ระบบ';
    exit;
}

// ถ้ายังไม่มี cookie 'dglst' ให้สร้าง cookie ใหม่ และส่งข้อความแจ้งเตือนว่ามีคนเข้าใช้งาน
if(empty($_COOKIE['dglst'])){
    setcookie('dglst','1',strtotime("+15 min"),'/');

    // $sMessage = '👾 '.$_SESSION['sIdname'].' ได้เข้าใช้งานเมนู ::PHAR- แก้ไขข้อมูลยา ';
    // sendText($sMessage);
    
}
?>
<style type="text/css">
.txt {	font-family: "TH SarabunPSK";
	font-size: 18px;
}
body,td,th {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
</style>
<?php
$user_code = $_SESSION['smenucode'];
$user_id = trim($_SESSION['sIdname']);
if ($user_code !== 'ADM') {
    // ตรวจสอบชื่อ และ menucode ว่าอยู่ในรายการหรือไม่
    $check_level = in_array($user_code, array('ADMPH', 'ADMPHA', 'ADMPURCHASE'));
    //$check_user = in_array($user_id, array('อรัญญา', 'วนิดาดา', 'พรทิพา','จีราภรณ์4','สงคราม','รุ่งทิวา','อมรรัตน์'));
    //$check_user = in_array($user_id, array('พรทิพา','วนิดาดา','สงคราม','รุ่งทิวา','อมรรัตน์','ภูมิพัฒน์','ภัททิยา','กฤตย์ตนันต์','รัฐปริญญ์','ศิวาพร'));  //รับคำสั่ง หน.กองเภสัชกรรม วันที่ 27/12/60 // เพิ่ม ภัททิยา 2563-05-14
    $check_user = in_array($user_id, array('วนิดาดา', 'รุ่งทิวา', 'อมรรัตน์', 'ภูมิพัฒน์', 'กฤตย์ตนันต์', 'รัฐปริญญ์', 'พิมผกา', 'ปภาวิน', 'พชร', 'จีรอาภา', 'ตรัณ', 'วรัญญากร', 'ภัทริษฐ์ชา'));  //รับคำสั่ง หน.คลังยา วันที่ 17/03/65 // เพิ่ม ศิวาพร,ณัชชา 2563-05-14
    if ($check_level === false or $check_user === false) {
    ?>
        <p>คุณไม่มีสิทธิ์ในการแก้ไขข้อมูลยา กรุณาติดต่อ</p>
        <ol>
            <li>พ.อ.หญิง วนิดา โล่ห์สุวรรณ</li>
            <li>พ.ท. ภูมิพัฒน์ สมิทธนโชติ</li>
            <li>รุ่งทิวา ใจเดียว</li>
            <li>อมรรัตน์ นันทะวงค์</li>
            <li>กฤตย์ตนันต์ หมูแสนทอง</li>
            <li>รัฐปริญญ์ มิ่งเชื้อ</li>
            <li>พิมผกา อายะชู</li>
            <li>ปภาวิน จันทร์มณี</li>
            <li>พชร วงศ์ศิริอำนวย</li>
            <li>จีรอาภา ใจจินา</li>
            <li>ตรัณ วิญญา</li>
        </ol>
        <p>เพื่อทำการแก้ไขข้อมูลยา</p>
        <p><a href="../nindex.htm">คลิกที่นี่</a> เพื่อกลับไปหน้าเมนูหลัก</p>
        <?php
        exit;
    }
}

print "รายการยาเวชภัณฑ์ <br> ";

// แสดงรายการยา ตอนคีย์ค้นหาจากรหัสยา (aJax)
if (isset($_GET["action"]) && $_GET["action"] == "drugcode" && !empty($_GET["search1"]) ) {

    $sql = "Select drugcode,tradname from druglst  where  drugcode like '%" . $_GET["search1"] . "%' limit 10 ";
    
    $result = Mysql_Query($sql) or die(Mysql_error());
    if (Mysql_num_rows($result) > 0) {
        echo "<Div style=\"position: absolute;text-align: center; width:300px; height:430px; overflow:auto; \">";
        echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\"><td width=\"80\"><font style=\"color: #FFFFFF;\"><strong>รหัสยา</strong></font></td><td width=\"150\" align='center'><font style=\"color: #FFFFFF;\"><strong>ชื่อยา(การค้า)</strong></font></td><td width=\"20\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td></tr>";
        $i = 1;
        while ($se = Mysql_fetch_assoc($result)) {
            echo "<tr><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('" . $_GET["getto"] . "').value = '" . trim($se["drugcode"]) . "';document.getElementById('list').innerHTML ='';\">&nbsp;", $se["drugcode"], "</A></td><td>&nbsp;" . $se['tradname'] . "</td><td>&nbsp;</td></tr>";
        }
        echo "</TABLE></Div>";
    }
    exit();
}
?>
<script>
    function newXmlHttp() {
        var xmlhttp = false;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                xmlhttp = false;
            }
        }

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}
function searchSuggest(str,len,getto) {
    str = str+String.fromCharCode(event.keyCode);
    if(str.length >= len){
        url = 'dglst.php?action=drugcode&search1=' + str+'&getto=' + getto;
        xmlhttp = newXmlHttp();
        xmlhttp.open("GET", url, false);
        xmlhttp.send(null);
        document.getElementById("list").innerHTML = xmlhttp.responseText;
    }
}
</script>

<body onLoad="document.getElementById('drugcode').focus();">
    <form method="post" action="dglst.php">
        <font face="Angsana New">
            <Div id="list" style="left:150PX;top:70PX;position:absolute;"></Div>
            <a target='right' href="drugcode.php">รหัสยา ?</a>&nbsp;&nbsp;
            <input type="text" name="drugcode" size="10" id='drugcode' onKeyPress="searchSuggest(this.value,2,'drugcode');">&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="  ตกลง  " name="B1">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self href='../nindex.htm'>&lt;&lt;&nbsp;ไปเมน</a>
        </font>
        </p>
    </form>
    <table width="100%">
        <tr>
            <th bgcolor=45B39D>รหัส</th>
            <th bgcolor=45B39D>ชื่อการค้า</th>
            <th bgcolor=45B39D>ชื่อสามัญ</th>
            <th bgcolor=45B39D>ราคาขาย</th>
            <th bgcolor=45B39D>PART</th>
            <th bgcolor=45B39D>ห้องจ่าย</th>
            <th bgcolor=45B39D>ในคลัง</th>
            <th bgcolor=45B39D>สุทธิ</th>
            <th bgcolor=45B39D>packing</th>
            <th bgcolor=45B39D>ราคา/แพค (รวม VAT)</th>
            <th bgcolor=45B39D>ราคากลาง</th>
            <th bgcolor=45B39D>ราคาทุน</th>
            <th bgcolor=45B39D>รหัสบริษัท</th>
            <th bgcolor=45B39D>ชื่อบริษัท</th>
            <th bgcolor=45B39D>รหัส 24 หลัก</th>
            <th bgcolor=45B39D>สป<br>สายแพทย์</th>
        </tr>
        <?php 
        $drugcodeSearch = $_POST['drugcode'];
        if (!empty($drugcodeSearch)) {

            if(DEV === false){
                sendTelgramMsg('👾 '.$_SESSION['sIdname'].' ได้ค้นหายา '.$drugcodeSearch.' ในเมนู ::PHAR- แก้ไขข้อมูลยา ');
            }
            
            $query = sprintf("SELECT drugcode,tradname,genname,salepri,part,stock,mainstk,totalstk, pack, packpri_vat, comcode, comname, unitpri,code24, edpri,spec 
            FROM druglst 
            WHERE drugcode LIKE '%s%%' ", mysql_real_escape_string($drugcodeSearch));
            $result = mysql_query($query) or die("Query failed");
            while (list($drugcode, $tradname, $genname, $salepri, $part, $stock, $mainstk, $totalstk, $pack, $packpri_vat, $comcode, $comname, $unitpri, $code24, $edpri, $spec) = mysql_fetch_row($result)) {
                print(" <tr>\n" .
                "  <td BGCOLOR=A3E4D7><a   href=\"dgedit.php?Dgcode=$drugcode\">$drugcode</a></td>\n" .
                "  <td BGCOLOR=A3E4D7>$tradname</td>\n" .
                "  <td BGCOLOR=A3E4D7>$genname</td>\n" .
                "  <td BGCOLOR=A3E4D7>$salepri</td>\n" .
                "  <td BGCOLOR=A3E4D7>$part</td>\n" .
                "  <td BGCOLOR=A3E4D7>$stock</td>\n" .
                "  <td BGCOLOR=A3E4D7>$mainstk</td>\n" .
                "  <td BGCOLOR=A3E4D7>$totalstk</td>\n" .
                "  <td BGCOLOR=A3E4D7>$pack</td>\n" .
                "  <td BGCOLOR=A3E4D7>$packpri_vat</td>\n" .
                "  <td BGCOLOR=A3E4D7>$edpri</td>\n" .
                "  <td BGCOLOR=A3E4D7>$unitpri</td>\n" .
                "  <td BGCOLOR=A3E4D7>$comcode</td>\n" .
                "  <td BGCOLOR=A3E4D7>$comname</td>\n" .
                "  <td BGCOLOR=A3E4D7>$code24</td>\n" .
                "  <td BGCOLOR=A3E4D7>$spec</td>\n" .
                " </tr>\n");
            }
        }
        ?>
    </table>
</body>