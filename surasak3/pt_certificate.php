<?php 
/**
 * @link labtranxnidpt.php ไฟล์ต้นฉบับ
 */

include 'bootstrap.php';

if (!isset($_SESSION['sIdname'])){
    ?>
    <div>
        <p><a href="login_page.php">คลิกที่นี่</a> เพื่อเข้าสู่ระบบอีกครั้ง</p>
    </div>
    <?php
}

$action = input('action');
if($action == 'print'){

    $code = $_REQUEST['code'];
    $id = $_REQUEST['id'];
    $date = $_REQUEST['date'];

    $startDate = $_REQUEST['startDate'];
    $endDate = $_REQUEST['endDate'];

    $date_start_th = ad_to_bc($_REQUEST['startDate']);
    $date_end_th = ad_to_bc($_REQUEST['endDate']);

    $thaimonthFull = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');
    $thDateTime = (date("Y")+543).date("-m-d H:i:s"); 
    $Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $enDate = date('Y-m-d');

    $sql = "SELECT `hn`,`doctor`,`diag` FROM `depart` WHERE `row_id` = '$id' ";
    $q = mysql_query($sql);
    $dtDepart = mysql_fetch_assoc($q);
    $cDoctor = $dtDepart['doctor'];
    $cDiag = $dtDepart['diag'];
    $cHn = $dtDepart['hn'];

    //เลข นวดแผนไทย 
    $query = "SELECT * FROM runno WHERE title = 'nid_pt'";
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
        continue;
    }

    $nNid = $row->runno;
    $fNid = $row->prefix;
    $nRunno = $nNid.''.$fNid;

    $qLab = mysql_query("SELECT `depart` FROM `labcare` WHERE `code` = '$code'");
    $lab = mysql_fetch_assoc($qLab);
    $cPart = $lab['depart']; // อิงตาม labcare 


    $sql = "SELECT * FROM `medicalcertificate` WHERE `hn` = '$cHn' AND `part` = '$cPart' AND `thidate` LIKE '$date%' ";
    $qMed = mysql_query($sql);
    if ( mysql_num_rows($qMed) === 0 ) {
        mysql_query("INSERT INTO `medicalcertificate` (`thidate`,`number`,`hn`,`part`,`doctor`)VALUES('$thDateTime','$nRunno','$cHn','$cPart','$cDoctor');");
    }

    $showStart = 0;
    if( !empty($startDate) && !empty($endDate) ){
        $showStart = 1;
    }

    $cDoctor1 = trim(substr($cDoctor,5,50));
    $cDoctor2 = substr($cDoctor,0,5);

    $acu = 0;
    $licen = '';
    
    if($cDoctor2 == "MD058" || $cDoctor2 == 'MD155' || $cDoctor2 == 'MD156' || $cDoctor2 == 'MD157'){
    
        // จันทร์ ถึง ศุกร์เป็นของ ศิริพร อินปัน
        if( $cDoctor2 == 'MD156' ){
            $cDoctor1 = "อัจฉรา อวดห้าว";
            $doctorcode = "พท.ป. 2556";

        }else if( $cDoctor2 == 'MD157' ){
            $cDoctor1 = "ธัญญาวดี มูลรัตน์";
            $doctorcode = "พท.ป. 1038";

        }else if( $cDoctor2 == 'MD155' ){
            $cDoctor1 = "หทัยรัตน์ กุลชิงชัย";
            $doctorcode = "พท.ป. 2252";
        }

        $yot = "น.ส.";
        $position = "แพทย์แผนไทยประยุกต์";
        $certificate = "ใบอนุญาตประกอบโรคศิลปะ สาขา การแพทย์แผนไทยประยุกต์";
        $licen = "แพทย์แผนไทยประยุกต์ $doctorcode";
        $acu = 1;

    }else{
        $sql = "select * from doctor where name like '%$cDoctor1%'";
        $query = mysql_query($sql);
        $rows = mysql_fetch_array($query);
        $yot = $rows["yot"];
        $doctorcode = "ว. ".$rows["doctorcode"];
        $position = "แพทย์ประจำโรงพยาบาลค่ายสุรศักดิ์มนตรี";
        $certificate = "ใบอนุญาตประกอบอาชีพเวชกรรม";
    }
    $Thaidate1=substr($Thaidate,0,10);

    list($d, $m, $y) = explode('-', $Thaidate1);
    $thaiTxt = $d.' '.$thaimonthFull[$m].' '.$y;

    ?>
    <style type="text/css">
        .clearfix:after{
            content: "";
            display: table; 
            clear: both;
        }
    </style>
    <div style="text-align: center;">
        <img  WIDTH=100 HEIGHT=100 SRC='logo.jpg'>
    </div>
    <div style="height: 24px;">
        <div style="float: left; padding-left: 2em;">
            <font face="Angsana New" size ="4">เลขที่&nbsp;<?=$nRunno;?></font>
        </div>
        <div style="float: right; padding-right: 4em;">
            <font face="Angsana New" size ="4">วันที่&nbsp;<b><?=$thaiTxt;?></b></font>
        </div>
    </div>
    <div class="clearfix"></div>
    <div style="text-align: center;">
        <font face='Angsana New' size ='4'>
            <B>ใบรับรองการตรวจร่างกายของแพทย์</B>&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง
        </font>
    </div>
    <br>
    <font face="Angsana New" size ="3">
        ข้าพเจ้า <B><?=$yot;?>&nbsp;<?=$cDoctor1;?></B> ตำแหน่ง <?=$position;?>
        <br>
        <?=$certificate;?> เลขที่ &nbsp;<B><?=$doctorcode;?></B><BR>
    </font>
    <font face="Angsana New" size ="3">
        ได้ทำการตรวจร่างกาย &nbsp;<B><?=$cPtname;?></B> &nbsp;HN:<?=$cHn;?>  &nbsp;&nbsp;วินิจฉัยว่าป่วยเป็นโรค:&nbsp;&nbsp;<B><?=$cDiag;?></B><BR>
    </font>
    <?php 
    // ทดสอบว่า diag มีคำเหล่านี้อยู่รึป่าว
    $diag_list = array('อัมพฤกษ์','อัมพาต','CVA','พากินสันต์');
    $diag_list2 = array('หวัด','ภูมิแพ้','โรคหอบหืด');

    function test_diag($str, $diags){
        foreach ($diags as $key => $lc) {
            $test_pos = strpos($str, $lc);
            if( $test_pos !== false ){
                return true;
            }
        }
        return false;
    }

    // ถ้าอยู่ในเคสของ หวัด ภูมิแพ้ หอบหืด จะนับเป็นการอบด้วยสมุนไพร
    $inBy = test_diag($cDiag, $diag_list2);
    $nid_ext = 'นวดพร้อมประคบสมุนไพร';
    if( $inBy === true ){
        $nid_ext = 'อบไอน้ำสมุนไพร';
    }
      
    print "<font face='Angsana New' size ='3'>เห็นสมควรให้การรักษาทางแพทย์แผนไทยด้วยการ $nid_ext "; 
	  
    // ถ้าเป็นแพทย์แผนไทย
    if( $cDoctor2 === "MD058"  || $cDoctor2 == 'MD155' || $cDoctor2 == 'MD156' || $cDoctor2 == 'MD157'){
        
        // $inList = test_diag($cDiag, $diag_list);
        // if( $inList !== true ){
        //     $for_txt = 'เพื่อ ฟื้นฟูสมรรถภาพของร่างกาย';
        // }else{
        //     $for_txt = 'เพื่อ การบำบัดรักษาและฟื้นฟูสมรรถภาพของร่างกาย';
        // }
        
        // // ถ้าไม่เข้าเคสไหนเลย
        // if( $inBy === false && $inList === false ){
        //     $for_txt = 'เพื่อ บรรเทาอาการปวด';
        // }
        $for_txt = 'เพื่อบำบัดรักษาโรค';
        
        echo $for_txt;
        echo "<br>";
        
        if( $showStart > 0 && ( $date_start_th !== false && $date_end_th !== false ) ){ 

            list($sy, $sm, $sd) = explode('-', $date_start_th);
            list($ey, $em, $ed) = explode('-', $date_end_th);
            
            $txt_date_start = $sd.' '.$thaimonthFull[$sm].' '.$sy;
            $txt_date_end = $ed.' '.$thaimonthFull[$em].' '.$ey;

            echo "ตั้งแต่วันที่&nbsp;&nbsp;$txt_date_start&nbsp;&nbsp;ถึง&nbsp;&nbsp;$txt_date_end ";
        }
        print "<br><br>";
        
    }else{
        print "เพื่อ.............................................................................<BR>";
        print "<font face='Angsana New' size ='3'>ตั้งแต่เวลา........................ถึง........................น.<BR><BR>";
    }
    
    print "<font face='Angsana New' size ='3'><CENTER>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลงชื่อ&nbsp;$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แพทย์ผู้ตรวจ<BR></CENTER>";

    $Thaidate1=substr($Thaidate,0,10);
    print "<font face='Angsana New' size ='3'><CENTER>(&nbsp;$cDoctor1&nbsp;)</CENTER>";
    print "<font face='Angsana New' size ='3'><CENTER>$licen</CENTER>"; 

    ?>
    <script type="text/javascript">
        window.onload = function(){
            window.print();
        };
    </script>
    <?php

    $nNid++;
    $query ="UPDATE runno SET runno = $nNid WHERE title='nid_pt'";
    $result = mysql_query($query) or die("Query failed");

    exit;

}





$view = input_post('view');
if($view === false){
    ?>
    <link type="text/css" href="epoch_styles.css" rel="stylesheet" />
    <script type="text/javascript" src="epoch_classes.js"></script>
    <style>
    *{
        font-family: "TH Sarabun New","TH SarabunPSK";
        font-size: 14pt;
    }
    </style>
    <div>&lt;&lt;&nbsp;<a href="../nindex.htm">กลับหน้าหลัก ร.พ.</a></div>
    <div>
        <h1>ระบบออกใบรับรอง แพทย์แผนไทย ย้อนหลัง</h1>
    </div>
    <form action="pt_certificate.php" method="post">
        <table>
            <tr>
                <td  align="right">HN : </td>
                <td><input type="text" name="hn" id=""></td>
            </tr>
            <tr>
                <td  align="right">วันที่มารับบริการ : </td>
                <td><input type="text" name="date" id="date"></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit">ค้นหาวันที่รับบริการ</button>
                    <input type="hidden" name="view" value="search">
                </td>
            </tr>
        </table>
        
        <div>
        * การพิมพ์ใบรับรองในแต่ละครั้ง เลขที่ใบรับรองจะเป็นเลขใหม่
        </div>
    </form>
    <script type="text/javascript">
        var popup1;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('date'),false);
        };
    </script>
    <?php
}elseif ($view === 'search') {
    
    $date = input_post('date');
    $hn = input_post('hn');

    if (empty($date) OR empty($hn)) {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน";
        exit;
    }

    $date = ad_to_bc($date);

    $sql = "SELECT a.`row_id`,a.`date`,a.`doctor`,a.`staf_massage`,a.`diag`, b.`code` 
    FROM `depart` AS a 
    LEFT JOIN `patdata` AS b ON b.`idno` = a.`row_id` 
    WHERE a.`date` LIKE '$date%' 
    AND a.`hn` LIKE '$hn' 
    AND a.`depart` = 'PHYSI' 
    AND a.`staf_massage` IS NOT NULL 
    AND b.`code` LIKE '58%'
    ORDER BY a.`date` DESC";

    $q = mysql_query($sql);
    if ( mysql_num_rows($q) > 0 ) {
        
        ?> 
        <link type="text/css" href="epoch_styles.css" rel="stylesheet" />
        <script type="text/javascript" src="epoch_classes.js"></script>
        <style>
            *{
                font-family: "TH Sarabun New","TH SarabunPSK";
                font-size: 14pt;
            }
            .chk_table{
                border-collapse: collapse;
            }
            .chk_table th,
            .chk_table td{
                padding: 3px;
                border: 1px solid black;
            }
            p{
                margin: 0;
            }
        </style>
        <div>&lt;&lt;&nbsp;<a href="pt_certificate.php">กลับหน้าค้นหา</a></div>
        <div>
            <h3>เลือกรายการตรวจย้อนหลัง</h3>
        </div>
        <table>
        <?php
        $i = 1;
        $startItems = array();
        $endItems = array();
        $onLoad = '';
        while($item = mysql_fetch_assoc($q)) { 

            $id = $item['row_id'];

            array_push($startItems, 'startDate'.$i );
            array_push($endItems, 'endDate'.$i );

            $onLoad .= "startDate$i = new Epoch('startDate$i','popup',document.getElementById('startDate$i'),false);";
            $onLoad .= "endDate$i = new Epoch('endDate$i','popup',document.getElementById('endDate$i'),false);";

            ?>
            <tr>
                <td>
                <form action="pt_certificate.php" method="post">
                    <fieldset>
                        <legend><b>วันที่รับบริการ : </b><?=$item['date'];?> </legend>
                        <p><b>แพทย์ : </b><?=$item['doctor'];?></p>
                        <p><b>ผู้นวด : </b><?=$item['staf_massage'];?></p>
                        <p><b>Diag : </b><?=$item['diag'];?></p>
                        <p><b>วันที่เริ่ม : </b><input type="text" name="startDate" id="startDate<?=$i;?>"> <b>วันที่สิ้นสุด : </b><input type="text" name="endDate" id="endDate<?=$i;?>"></p>
                        <p><button type="submit">ตกลง</button></p>
                        <input type="hidden" name="id" value="<?=$id;?>">
                        <input type="hidden" name="action" value="print">
                        <input type="hidden" name="date" value="<?=$date;?>">
                    </fieldset>
                </form>
                </td>
            </tr>
            <?php 
            $i++;
        }

        $preStart = 'var '.implode(',',$startItems).';';
        $preEnd = 'var '.implode(',',$endItems).';';

        ?>
        </table>
        <script type="text/javascript">
        <?=$preStart;?><?=$preEnd;?>
            window.onload = function() {
                <?=$onLoad;?>
            };
        </script>
        <?php

    }else{
        echo "ไม่พบข้อมูล";
    }
    
}
?>