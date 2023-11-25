<?php 
require_once dirname(__FILE__).'/database.php';
require_once dirname(__FILE__).'/class_doctor.php';

class Appoint extends DbConnect{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * รายชื่อผู้ป่วยนัดที่ไม่มาในวันนั้นๆ
     * @param string $date รูปแบบไทย YYYY-mm-dd
     * @return mixed $res
     */
    public function getDisAppoint($date=null){
        if (empty($date)) {
            return "Date is required";
        }
        $pattern = '/(\d{4})-(\d{2})-(\d{2})/';
        $testMatch = preg_match($pattern, $date, $matchs);
        if ($testMatch===false) {
            return "Invalid date format";
        }
        $enDate = ($matchs[1]-543).'-'.$matchs[2].'-'.$matchs[3];

        $sql = "SELECT a.*,b.vn FROM (
            SELECT row_id,hn,ptname,room,detail,detail2,depcode FROM appoint WHERE appdate_en = '$enDate' AND apptime != 'ยกเลิกการนัด'
        ) AS  a LEFT JOIN (
            SELECT row_id,hn,ptname,vn FROM opday WHERE thidate LIKE '$date%' 
        ) AS b ON a.hn = b.hn 
        WHERE b.row_id IS NULL 
        ORDER BY a.room ASC";
        $q = $this->dbi->query($sql);
        if ($q->num_rows>0) {
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            $res = $items;
        }else{
            $res = $this->dbError();
        }
        return $res;
    }

    /*
    // ฝั่ง php ที่รับ requrest มา generate ตารางขึ้นมาใหม่
    $page = $_REQUEST['page'];
    if($page==='loadCalendar'){ 
        $doctorCode=$_REQUEST['id'];
        $today=$_REQUEST['today'];
        $dfMonth=$_REQUEST['dfMonth'];
        $dfYear=$_REQUEST['dfYear'];
        $app->getCalendar($doctorCode,$today,$dfMonth,$dfYear);
        exit;
    }

    <html>
        <body>
            <!-- โหลดครั้งแรก -->
            <div id="test_calendar_main">
            <?php
            $doctorCode = '12891';
            $app->getCalendar($doctorCode);
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
                    request_calendar('test_calendar_main','test_appoint.php?page=loadCalendar&'+url);
                }
            </script>
        </body>
    </html>
    */
    public function getCalendar($dt_doctor=null,$today=null, $dfMonth=null, $dfYear=null){

        // if( $_GET['id'] != "" ){
        //     $dt_doctor = iconv('UTF-8','UTF-8',$_GET['id']);
        // }

        if (empty($dt_doctor)) {
            return array('error'=>400,'message'=>'Doctorcode is required');
        }

        ?>
        <style>
        .examday{ position: absolute; left: 0; top: 0; width:10px; height:4px; background-color: green; }
        .chk_table{ border-collapse: collapse; }
        .chk_table th, .chk_table td{ padding: 3px; border: 1px solid black; font-size: 18px; }
        .today { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #C6B3FF; color: #000000;  }
        .sunday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FF9393; color: #FFFFFF; position: relative;}
        .saturday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #ECC4FF; color: #000000; position: relative;}
        .norm { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #000000; position: relative;}
        .link_calendar { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #000000; }
        .total_appointnorm { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #FF0000; text-decoration:none;}
        .total_appointnorm:hover{cursor: default;}
        .total_appointsunday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FF9393; color: #FF0000;text-decoration:none;}
        .total_appointsaturday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #ECC4FF; color: #FF0000; text-decoration:none;}
        .tooltips{
            background: white;
            color: #000000!important;
            z-index: 9; 
            position: absolute;
            top: 0;
            left: 50px;
            margin: 0 auto;
            text-align: center;
            width: auto;
            padding: 5px 10px;
            white-space: nowrap;
        }
        </style>
        <?php

        $dt = new Doctor();
        $doctor = $dt->getDoctorFromCode($dt_doctor);
        $appoint_doctor = $doctor['name'];
        $dr_position = $doctor['positon'];
        $doctorcode = $doctor['doctorcode'];

        // หาตารางออกตรวจของแพทย์
        $all_days_exam = array();
        $days_exam = array();
        $items = $dt->getExamTableFromDoctorId($dt_doctor);
        foreach ($items as $item) { 
            $days_exam[] = $item;
            $day_explode = explode(',', $item['day']);
            foreach ($day_explode as $b) {
                $all_days_exam[$b] = $b;
            }
        }
        ksort($all_days_exam);
    
        /* $diffHour และ $diffMinute คือตัวแปรที่ใช้เก็บจำนวนชั่วโมงและจำนวนนาทีที่แตกต่างกันระหว่างเครื่อง ไคลเอนต์กับเครื่องเซิร์ฟเวอร์ ตามลำดับ เช่นถ้าเวลาของเครื่องไคลเอ็นต์เร็วกว่าเวลาของเครื่องเซิร์ฟเวอร์ 11 ชั่วโมง 15 นาที ก็ให้กำหนด $diffHour เป็น 11 และกำหนด $diffMinute เป็น 15 */
        $diffHour = 0;
        $diffMinute = 0;
    
        if ($dfMonth == "") {
        /* ถ้าไม่มีการระบุให้แสดงปฏิทินของเดือนใดเดือนหนึ่ง เราจะแสดงปฏิทินของเดือนปัจจุบันตามเวลาในเครื่องไคลเอ็นต์ โดยใช้ฟังก์ชั่น getdate() สร้างวันที่/เวลาปัจจุบันของเครื่องไคลเอ็นต์เก้บไว้ในตัวแปร $calTime ซึ่งฟังก์ชั่นนี้จะคืนค่ากลับมาเป็นอาร์เรย์ */
        $calTime = getdate(date(mktime(date("H") + $diffHour, date("i") + $diffMinute)));
        $today = $calTime["mday"]; //วันที่
        $month = $calTime["mon"]; //เดือน
        $year = $calTime["year"]; // ปี

        } else {
            /* กรณีที่ระบุให้แสดงปฏิทินของเดือน/ปีหนึ่งๆ นั้น จะมีการส่งตัวแปร $today, $dfMonth และ $dfYear ผ่านมาทาง query string ด้วย */
            if ($dfMonth == 0) {
                /* ถ้าตัวแปร $dfMonth เป็น 0 เราจะแสดงปฏิทินของเดือนธันวาคมของปีที่น้อยกว่าปีที่กำลังแสดงอยู่ */
                $dfMonth = 12;
                $dfYear = $dfYear - 1;
            } elseif ($dfMonth == 13) {
                /* ถ้าตัวแปร $dfMonth เป็น 13 เราจะแสดงปฏิทินของเดือนมกราคมของปีที่มากกว่าปีที่กำลังแสดงอยู่ */
                $dfMonth = 1;
                $dfYear = $dfYear + 1;
            }
        
            //สร้างวัน/เวลาของเดือนและปีที่ผู้ใช้ระบุ เก็บไว้ในตัวแปร $calTime
            $calTime = getdate(date(mktime((date("H") + $diffHour), (date("i") + $diffMinute), 0, $dfMonth, $today, $dfYear)));
            $today = $calTime["mday"]; //วันที่
            $month = $calTime["mon"]; //เดือน
            $year = $calTime["year"]; //ปี
        }
    
    
    
        /* เรียกฟังก์ชัน LastDay() ซึ่งเป็นฟังก์ชั่นที่เราสร้างขึ้นเอง เพื่อหา"จำนวนวัน" ของเดือนและปีที่จะแสดงปฏิทิน โดยเก้บไว้ในตัวแปร $Lday */
        // $Lday = LastDay($month, $year);
        $Lday = date("t", "$year-$month-01");

        //เก็บ timestamp ของวันที่ 1 ของเดือนที่จะแสดงปฏิทิน ไว้ในตัวแปร $FTime
        $FTime = getdate(date(mktime(0, 0, 0, $month, 1, $year)));
        //เก็บ "วันในสัปดาห์" (จันทร์, อังคาร ฯลฯ) ของวันที่ 1 ของเดือนไว้ในตัวแปร $wday
        $wday = $FTime["wday"];
        
        //สร้างตัวแปรชนิดอาร์เรย์เก็บชื่อเดือนภาษาไทย
        $thmonthname = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        
        $thai_date = $thmonthname[($month - 1)]." ".($year + 543);
        
        $en_year_month = "$year-".sprintf('%02d', $month);
        $tableDate = $year.'-'.sprintf('%02d', $month).'-01';
        
        // ถ้าหมอที่เลือกจาก dropdown เป็นหมอ intern
        $total_items = array();
        if( $dr_position == '99 เวชปฏิบัติ' ){
            
            // จำนวนผู้ป่วยนัดของแพทย์เวชปฏิบัติทั้งหมด
            $sql = "SELECT b.`appdate`, COUNT(DISTINCT b.`hn`) AS `total`, SUBSTRING(b.`appdate`, 1, 2) AS `code` 
            FROM ( 
                SELECT * FROM `doctor` WHERE `position` = '99 เวชปฏิบัติ' AND `status` = 'y' 
            ) AS a 
            LEFT JOIN ( 
                SELECT `appdate`,`apptime`,`hn`,`doctor` FROM `appoint` WHERE `appdate_en` LIKE '$en_year_month%' 
                AND `apptime` <> 'ยกเลิกการนัด' 
            ) AS b ON a.`name` = b.`doctor` 
            WHERE b.`appdate` IS NOT NULL 
            GROUP BY b.`appdate`  ";
        
            $result = $this->dbi->query($sql);
            while ($item = $result->fetch_assoc()) {
                $code = 'A'.$item['code'];
                $total_items[$code] = $item;
            }
        }
        
        $drfMonth = sprintf('%02d', $month);
        $drfYear = $year + 543;
        $appoint_doctor = trim($appoint_doctor);
        $sqlOff = "SELECT `dateoffline` FROM `dr_offline` WHERE `name` = '$appoint_doctor' AND `dateoffline` LIKE '%$drfMonth-$drfYear' ORDER BY `dateoffline`";
        $offResult = $this->dbi->query($sqlOff);
        $drTxtOffline = '';
        if( $offResult->num_rows > 0 ){
        
            $drTxtOffline = '<div style="color: red; text-decoration: underline;">แจ้งแพทย์ '.$appoint_doctor.' ไม่อยู่วันที่ ';
            $dayList = array();
            while ($drOff = $offResult->fetch_assoc()) {
        
                list($offD, $offM, $offY) = explode('-', $drOff['dateoffline']);
        
                $holiday["A".$offD]["date"] = true;
                $holiday["A".$offD]["detail"] = 'แพทย์ไม่อยู่';
        
                $dayList[] = $offD;
            }
        
            $dayTxt = implode(', ',$dayList);
            $drTxtOffline .= $dayTxt.' '.$thmonthname[($offM - 1)].' '.$offY.'</div>';
        }
        
        $list_app = array();
        
        // 2562-12-25 ทดสอบปรับมาใช้ Procedure 
        // ข้อมูลอื่นๆเกี่ยวกับ Store Procedure สามารถ Google จากคีย์เวิร์ด mysql stored procedure ตัวอย่าง
        // $sqlCall = "CALL appoint_opd('$thai_date','$appoint_doctor'); ";
        $sqlCall = "SELECT `row_id`,`date`,`officer`,`hn`,`ptname`,`age`,`doctor`,`appdate`,`apptime`,COUNT(distinct `hn`) AS `total_app` 
        FROM `appoint` 
        WHERE ( `appdate_en` LIKE '$en_year_month%' AND `appdate` LIKE '%$thai_date' ) 
        AND `doctor` = '$appoint_doctor' 
        AND `apptime` <> 'ยกเลิกการนัด' 
        GROUP BY `appdate_en`,`apptime`;";
        $callResult = $this->dbi->query($sqlCall);
        while ($arr = $callResult->fetch_assoc()) {
            $list_app["A".substr($arr["appdate"],0,2)]["detail"] .= " ".$arr["apptime"]." จำนวน ".$arr["total_app"]." คน<BR>";
            $list_app["A".substr($arr["appdate"],0,2)]["sum"] = $list_app["A".substr($arr["appdate"],0,2)]["sum"] + $arr["total_app"];
        }
        $callResult->free();
        $this->dbi->next_result();
        
        $sql = "SELECT DATE_FORMAT(date_holiday,'%d') AS date_holiday2, detail FROM holiday WHERE date_holiday LIKE '".($year+543)."-".sprintf("%02d",$month)."%' ";
        $result = $this->dbi->query($sql);
        while($arr = $result->fetch_assoc()){ 
            $holiday["A".$arr["date_holiday2"]]["date"] = true;
            $holiday["A".$arr["date_holiday2"]]["detail"] = $arr["detail"];
        }
        
        $long_time = $month+$year;
        $month2 = date("m");
        $year2 = date("Y");
        $long_time2 = $month2 + $year2;
        
        $title_time = '';
        // $start = new DateTime(date('Y-m-01'));
        // $test_date = new DateTime($tableDate);
        $start = strtotime(date('Y-m-01'));
        $test_date = strtotime($tableDate);
        $endOfDay = date('t');
        $monthsTxt = round(($test_date - $start) / (60*60*24*$endOfDay));
        if($monthsTxt>0){
            $title_time = " (นัด $monthsTxt เดือน)";
            
        }else if($monthsTxt<0){
            ?>
            <p style="color:red;"><b><u>!!! ท่านกำลังเลือกเดือนย้อนหลัง !!!</u></b></p>
            <?php
        }
        
        echo "<TABLE><TR valign=\"top\"><TD></TD></TD><TD>";
        
        if(!checkdate  ( $month - 1, $today  , $year  )){
            $today1 = "1";
        }else{
            $today1 = $today;
        }
        
        if(!checkdate  ( $month + 1, $today  , $year  )){
            $today2 = "1";
        }else{
            $today2 = $today;
        }
    
    
        $next_1month = strtotime(date('Y-m-d')." +1 month");
        $next_2month = strtotime(date('Y-m-d')." +2 months");
        $next_3month = strtotime(date('Y-m-d')." +3 months");
    
        $next_6month = strtotime(date('Y-m-d')." +6 months");
        $next_1year = strtotime(date('Y-m-d')." +1 year");
        $next_2year = strtotime(date('Y-m-d')." +2 years");
    
        list($n1mY, $n1mM, $n1mD) = explode('-', date('Y-m-d', $next_1month));
        list($n2mY, $n2mM, $n2mD) = explode('-', date('Y-m-d', $next_2month));
        list($n3mY, $n3mM, $n3mD) = explode('-', date('Y-m-d', $next_3month));
    
        list($n6mY, $n6mM, $n6mD) = explode('-', date('Y-m-d', $next_6month));
        list($n1yY, $n1yM, $n1yD) = explode('-', date('Y-m-d', $next_1year));
        list($n2yY, $n2yM, $n2yD) = explode('-', date('Y-m-d', $next_2year));
    
        echo '<a href="javascript: void(0);" onclick="show_carlendar(\'id='.rawurlencode($dt_doctor).'&today='.date('d').'&dfMonth='.date('m').'&dfYear='.date('Y').'\')">&gt;&gt; วันปัจจุบัน</a>&nbsp;||&nbsp;';
        // echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$n1mD.'&dfMonth='.$n1mM.'&dfYear='.$n1mY.'\')">&gt;&gt; นัด 1เดือน</a>&nbsp;||&nbsp;';
        echo '<a href="javascript: void(0);" onclick="show_carlendar(\'id='.rawurlencode($dt_doctor).'&today='.$n2mD.'&dfMonth='.$n2mM.'&dfYear='.$n2mY.'\')">&gt;&gt; นัด 2เดือน</a>&nbsp;||&nbsp;';
        echo '<a href="javascript: void(0);" onclick="show_carlendar(\'id='.rawurlencode($dt_doctor).'&today='.$n3mD.'&dfMonth='.$n3mM.'&dfYear='.$n3mY.'\')">&gt;&gt; นัด 3เดือน</a>';
        echo '<br>';
        echo '<a href="javascript: void(0);" onclick="show_carlendar(\'id='.rawurlencode($dt_doctor).'&today='.$n6mD.'&dfMonth='.$n6mM.'&dfYear='.$n6mY.'\')">&gt;&gt; นัด 6เดือน</a>&nbsp;||&nbsp;';
        echo '<a href="javascript: void(0);" onclick="show_carlendar(\'id='.rawurlencode($dt_doctor).'&today='.$n1yD.'&dfMonth='.$n1yM.'&dfYear='.$n1yY.'\')">&gt;&gt; นัด 1ปี</a>&nbsp;||&nbsp;';
        echo '<a href="javascript: void(0);" onclick="show_carlendar(\'id='.rawurlencode($dt_doctor).'&today='.$n2yD.'&dfMonth='.$n2yM.'&dfYear='.$n2yY.'\')">&gt;&gt; นัด 2ปี</a>';
        echo '<br>';
    
        echo $drTxtOffline;
    
        $dt_encode = rawurlencode($dt_doctor);
    
        echo "<table border=\"1\" bordercolor=\"black\" width=\"320\" height=\"270\" style=\"float:left;\">
        <tr class=\"norm\"><td width=\"50\" align=\"center\">
        <a href=\"javascript:void(0);\" Onclick=\"show_carlendar('id=$dt_encode&today=".$today1."&dfMonth=".($month - 1)."&dfYear=".$year."');\">&lt;</a>
        </td>
        <td width=\"250\" align=\"center\" colspan=\"5\" bgcolor=\"#F9F4DD\">
        ".$thmonthname[$month - 1]."&nbsp;
        ".($year + 543)." ".$title_time."
        </td>
        <td width=\"50\" align=\"center\">
        <a href=\"javascript:void(0);\" Onclick=\"show_carlendar('id=$dt_encode&today=".$today2."&dfMonth=".($month + 1)."&dfYear=".$year."');\">&gt;</a>
        </td></tr>
        
        <tr><td width=\"50\" align=\"center\" class=\"sunday\">อา</td>
        <td width=\"50\" align=\"center\" class=\"norm\">จ</td>
        <td width=\"50\" align=\"center\" class=\"norm\">อ</td>
        <td width=\"50\" align=\"center\" class=\"norm\">พ</td>
        <td width=\"50\" align=\"center\" class=\"norm\">พฤ</td>
        <td width=\"50\" align=\"center\" class=\"norm\">ศ</td>
        <td width=\"50\" align=\"center\" class=\"saturday\">ส</td></tr><tr height=\"60\" valign=\"top\">";
    
    
    $iday = 1;
    //แสดงแถวแรกของปฏิทิน
    for ($i=0; $i<=6; $i++) {
        $holiday_detail = "";
       if ($i < $wday) {    //แสดงเซลล์ว่างก่อนวันที่ 1 ของเดือน
          if ($i == 0) {       //กรณีที่เป็นวันอาทิตย์
             echo "<td width=\"50\" align=\"center\" class=\"sunday\">&nbsp;</td>\n";
          }else if ($i == 6) {       //กรณีที่เป็นวันเสาร์
             echo "<td width=\"50\" align=\"center\" class=\"saturday\">&nbsp;</td>\n";
          }
          else {              //กรณีที่เป็นวันอื่นๆ ที่ไม่ใช่วันอาทิตย์
             echo "<td width=\"50\" align=\"center\" class=\"norm\">&nbsp;</td>\n";
          }
       }
       else {                  //แสดงวันที่ในแถวแรกของปฏิทิน
    
        $key = 'A'.sprintf("%02d",$iday);
        $dr_intern_txt = '';
        $intern_total = 0;
        if( !empty($total_items[$key]) ){
            $item = $total_items[$key];
            $dr_intern_txt = '<br><div>(<span style="color: green;" onmouseout="hid_tooltip('.$month.'-'.$iday.');" onmouseover="show_tooltip(\'ผู้ป่วยนัดของแพทย์เวชปฏิบัติ\',\''.$item['total'].' คน\', \'left\', -10, -110)">'.$item['total'].'</span>)</div>';
            $intern_total = $item['total'];
        }
    
        $intern_limit = '';
        $data_count = '';
        if( $dr_position == '99 เวชปฏิบัติ' ){
            // วันจันทร์จะลิมิตไว้ที่ 40 วันอื่นๆที่ 50
            $max_limit = 50;
            if( $i == 1 ){
                $max_limit = 40;
            }
    
            $intern_limit = 'intern-limit="'.$max_limit.'"';
            $data_count = 'data-count="'.$intern_total.'"';
        }
    
        $displayExam = '';
        if (in_array($i, $all_days_exam)===true) {
            $displayExam = '<div class="examday"></div>';
        }
    
          if ($i == 0 ) {
          //กรณีที่เป็นวันอาทิตย์ และไม่ใช่วันปัจจุบัน
             echo "<td width=\"50\" valign=\"top\" align=\"center\" class=\"sunday\" id=\"$month-$iday\">$displayExam
             <A 
                class=\"sunday countnum\" $intern_limit $data_count 
                href=\"javascript:void(0);\" 
                data-date=\"".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."\" 
                onclick=\"document.getElementById('date_appoint').value=this.getAttribute('data-date')\"
             >$iday</A>";
             if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
                 echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210,'$month-$iday');\" OnmouseOut = \"hid_tooltip('$month-$iday');\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
             else
                 echo "<BR>&nbsp;";
    
             echo $dr_intern_txt;
    
             echo "</td>\n";
          }else  if ($i == 6 ) {
          //กรณีที่เป็นวันอาทิตย์ และไม่ใช่วันปัจจุบัน
             echo "<td width=\"50\" align=\"center\" class=\"saturday\" id=\"$month-$iday\">$displayExam<A class=\"saturday countnum\" $intern_limit $data_count href=\"javascript:void(0);\" data-date=\"".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."\" onclick=\"document.getElementById('date_appoint').value=this.getAttribute('data-date')\">$iday</A>";
              if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
                 echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-250,-210,'$month-$iday');\" OnmouseOut = \"hid_tooltip('$month-$iday');\" class=\"total_appointsaturday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
              else
                 echo "<BR>&nbsp;";
    
            echo $dr_intern_txt;
    
             echo "</td>\n";
          }
          else {
    
              if($holiday["A".sprintf("%02d",$iday)]["date"]){
                $class = "sunday";
                $holiday_detail = " OnmouseOver = \"show_tooltip('วันหยุด','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210,'$month-$iday');\" OnmouseOut = \"hid_tooltip('$month-$iday');\" ";
              }else{
                $class = "norm";
              }

             echo "<td width=\"50\" align=\"center\" class=\"".$class."\" id=\"$month-$iday\">$displayExam<A class=\"".$class." countnum\" $intern_limit $data_count href=\"javascript:void(0);\" data-date=\"".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."\"  ".$holiday_detail." onclick=\"document.getElementById('date_appoint').value=this.getAttribute('data-date')\">$iday</A>";
              if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
                 echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-80,-150,'$month-$iday');\" OnmouseOut = \"hid_tooltip('$month-$iday');\" class=\"total_appoint".$class."\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
              else
                 echo "<BR>&nbsp;";
    
            echo $dr_intern_txt;
    
             echo "</td>\n";
    
          }
    
          $iday++;
    
       }
    }
    
    //แสดงแถวที่เหลือของปฏิทิน (หลังจากแสดงแถวแรกไปแล้ว จะเหลืออย่างมาก 5 แถว)
    for ($j=0; $j<=4; $j++) {
       if ($iday <= $Lday) {
          echo "<tr  height=\"60\" valign=\"top\">\n";
            for ($i=0; $i<=6; $i++) {
    
    
                $key = 'A'.sprintf("%02d",$iday);
                $dr_intern_txt = '';
                $intern_total = 0;
                if( !empty($total_items[$key]) ){
                    $item = $total_items[$key];
                    $dr_intern_txt = '<br><div>(<span style="color: green;" onmouseout="hid_tooltip('.$month.'-'.$iday.');" onmouseover="show_tooltip(\'ผู้ป่วยนัดของแพทย์เวชปฏิบัติ\',\''.$item['total'].' คน\', \'left\', -10, -110)">'.$item['total'].'</span>)</div>';
                    $intern_total = $item['total'];
                }
    
                $intern_limit = '';
                $data_count = '';
                if( $dr_position == '99 เวชปฏิบัติ' ){
                    // วันจันทร์จะลิมิตไว้ที่ 40 วันอื่นๆที่ 50
                    $max_limit = 50;
                    if( $i == 1 ){
                        $max_limit = 40;
                    }
            
                    $intern_limit = 'intern-limit="'.$max_limit.'"';
                    $data_count = 'data-count="'.$intern_total.'"';
                }
    
    
                $holiday_detail = "";
                if ($iday <= $Lday) {
                    
                    $displayExam = '';
                    if (in_array($i, $all_days_exam)===true) {
                        $displayExam = '<div class="examday"></div>';
                    }
    
                if ($i == 0 ) {
                    if($holiday["A".sprintf("%02d",$iday)]["date"]){
                        $class = "sunday";
                        $holiday_detail = " OnmouseOver = \"show_tooltip('วันหยุด','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210);\" OnmouseOut = \"hid_tooltip('$month-$iday');\" ";
                      }else{
                        $class = "norm";
                      }
                    echo "<td width=\"50\" align=\"center\" class=\"sunday\" id=\"$month-$iday\">$displayExam<A class=\"sunday countnum\" $intern_limit $data_count href=\"javascript:void(0);\" data-date=\"".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."\" ".$holiday_detail." onclick=\"document.getElementById('date_appoint').value=this.getAttribute('data-date')\">$iday</A>";
                        if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
                            echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-80,-150,'$month-$iday');\" OnmouseOut = \"hid_tooltip('$month-$iday');\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
                            
                            echo $dr_intern_txt;
                            
                            echo "</td>\n";
                }else  if ($i == 6 ) {
                    if($holiday["A".sprintf("%02d",$iday)]["date"]){
                        $class = "sunday";
                        $holiday_detail = " OnmouseOver = \"show_tooltip('วันหยุด','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210,'$month-$iday');\" OnmouseOut = \"hid_tooltip('$month-$iday');\" ";
                      }else{
                        $class = "norm";
                      }
                    echo "<td width=\"50\" align=\"center\" class=\"saturday\" id=\"$month-$iday\">$displayExam<A class=\"saturday countnum\" $intern_limit $data_count href=\"javascript:void(0);\" data-date=\"".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."\" ".$holiday_detail." onclick=\"document.getElementById('date_appoint').value=this.getAttribute('data-date')\">$iday</A>";
                        if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
                            echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-80,-150,'$month-$iday');\" OnmouseOut = \"hid_tooltip('$month-$iday');\" class=\"total_appointsaturday\" >".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
                    
                            echo $dr_intern_txt;
                    
                            echo "</td>\n";
                }else {
                    if($holiday["A".sprintf("%02d",$iday)]["date"]){
                        $class = "sunday";
                        $holiday_detail = " OnmouseOver = \"show_tooltip('วันหยุด','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-210,'$month-$iday');\" OnmouseOut = \"hid_tooltip('$month-$iday');\" ";
                      }else{
                        $class = "norm";
                      }
                    echo "<td width=\"50\" align=\"center\" class=\"".$class."\" id=\"$month-$iday\">$displayExam</div><A class=\"".$class." countnum\" $intern_limit $data_count href=\"javascript:void(0);\" data-date=\"".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."\" ".$holiday_detail." onclick=\"document.getElementById('date_appoint').value=this.getAttribute('data-date')\">$iday</A>";
                        if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
                            echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver=\"show_tooltip('ผู้ป่วยนัด','".$list_app["A".sprintf("%02d",$iday)]["detail"]."','left',-80,-150,'$month-$iday');\" OnmouseOut = \"hid_tooltip('$month-$iday');\" class=\"total_appoint".$class."\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
                    
                            echo $dr_intern_txt;
    
                            echo "</td>\n";
                }
            $iday++;
            }
            else {
            echo "<td width=\"50\" align=\"center\" class=\"norm\">&nbsp;</td>\n";
            }
          }
          echo "</tr>\n";
       }
       else {
          break;
       }
    }
    
    echo "</table>";
    ?>
    <!-- ตารางออกตรวจ -->
    <div style="float:left; margin-left:8px;">
    <?php 
    if(count($days_exam)>0){
        ?>
        <p style="margin:0;padding:0;"><b>วัน-เวลาออกตรวจ</b></p>
        <table class="chk_table">
            <tr style="background-color: #13795b; color: #ffffff;">
                <th>#</th>
                <th>วัน</th>
                <th>เวลา</th>
            </tr>
            <?php 
            $th_days = array(0 => 'อาทิตย์',1 => 'จันทร์',2 => 'อังคาร',3 => 'พุธ',4 => 'พฤหัสบดี',5 => 'ศุกร์',6 => 'เสาร์');
            $ex_i = 1;
            foreach ($days_exam as $d) { 
                $dList = explode(',', $d['day']);
                
                ?>
                <tr valign="top">
                    <td><?=$ex_i;?></td>
                    <td>
                        <?php 
                        $dlItem = array(); 
                        foreach ($dList as $dl) {
                            $dlItem[] = $th_days[$dl];
                        }
                        echo implode(', ', $dlItem);
                        ?>
                    </td>
                    <td><?=$d['time_start'];?>-<?=$d['time_end'];?></td>
                </tr>
                <?php
                $ex_i++;
            }
            ?>
        </table>
        <?php
    }
    ?>
    </div>
    <?php
    echo "</TD>
    </TR>";
    
    if( $dr_position == '99 เวชปฏิบัติ' ){
        ?>
        <tr>
            <td colspan="2">
                <span style="color: #FF0000; font-size: 18px;">(สีแดง) ผู้ป่วยนัดของของแพทย์ที่กำลังเลือก</span>
                <br>
                <span style="color: #008000; font-size: 18px;">(สีเขียว) ผู้ป่วยนัดของแพทย์เวชปฏิบัติทั้งหมดต่อวัน</span>
            </td>
        </tr>
        <?php
    }
    
    echo "<tr><td colspan=\"2\"><br><font face=\"Angsana New\">นัดมาวันที่ : </font><INPUT TYPE=\"text\" ID=\"date_appoint\" NAME=\"date_appoint\" size=\"15\" readonly>";
    echo "</td></tr></TABLE>";
        ?>
        <script>
            function show_tooltip(title,detail,al,l,r, x){ 
                
                var tooltip = document.createElement('div');
                tooltip.classList.add("tooltips");
                tooltip.id='child'+x;
                
                var table = "<TABLE border=\"1\" bordercolor=\"blue\">";
                table += "<TR bgcolor=\"blue\">";
                table += "    <TD align=\"center\"><B><FONT COLOR=\"#FFFFFF\">"+title+"</FONT></B></TD>";
                table += "</TR>";
                table += "<TR>";
                table += "    <TD align=\""+al+"\">"+detail+"</TD>";
                table += "</TR>";
                table += "</TABLE>";

                tooltip.innerHTML=table;
                var divParent = document.getElementById(x);
                divParent.appendChild(tooltip);

            }

            function hid_tooltip(x){
                var childX = document.getElementById('child'+x).remove();
            }
        </script>
        <?php
    }
}