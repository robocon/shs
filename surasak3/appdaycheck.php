<form method="post" action="appdaycheck.php">
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบจำนวนครั้งที่นัดมาโรงพยาบาล</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="hn" size="12"></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
    </form>

<table>
    <tr>
        <th bgcolor=CD853F>HN</th>
        <th bgcolor=CD853F>ชื่อ-สกุล</th>
        <th bgcolor=CD853F>แพทย์</th>
        <th bgcolor=CD853F>วันนัด</th>
        <th bgcolor=CD853F>นัดเพื่อ</th>
        <th bgcolor=CD853F>เวลานัด</th>
        <th bgcolor=CD853F>แลบ</th>
        <th bgcolor=CD853F>เอกซเรย์</th>
        <th bgcolor=CD853F>อื่น</th>
    </tr>

    <?php
    $hn = trim($_REQUEST['hn']);
    If (!empty($hn)){ 

        include("connect.inc");

        $month["01"]="มกราคม";
        $month["02"]="กุมภาพันธ์";
        $month["03"]="มีนาคม";
        $month["04"]="เมษายน";
        $month["05"]="พฤษภาคม";
        $month["06"]="มิถุนายน";
        $month["07"]="กรกฎาคม";
        $month["08"]="สิงหาคม";
        $month["09"]="กันยายน";
        $month["10"]="ตุลาคม";
        $month["11"]="พฤศจิกายน";
        $month["12"]="ธันวาคม";

        $months_key = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม',);
        $months_val = array('01','02','03','04','05','06','07','08','09','10','11','12',);

        $day_now = date("d");
        $month_now = date("m");
        $year_now = (date("Y")+543);

        $select_day2 = $day_now." ".$month[$month_now]." ".$year_now;

        ///บวกวันที่เพิ่มขึ้นอีก 1 วัน
        $timestamp = strtotime ( "+1 days" );       
        $newtimestamp=date ( "Y-m-d", $timestamp);
        list($ty,$tm,$td)=explode("-",$newtimestamp);
        $ty=$ty+543;
        $select_tomorow = $td." ".$month[$tm]." ".$ty;

        // global $hn;

        // $query = "SELECT a.`row_id`,a.`hn`,a.`ptname`,a.`doctor`,a.`appdate`,a.`apptime`,a.`detail`,a.`patho`,a.`xray`,a.`other`,a.`date`,a.`injno`, 
		// CASE WHEN `appdate` = '".$select_day2."'  THEN '#009966' 
		//     WHEN `appdate` = '".$select_tomorow."'  THEN '#FF6699' ELSE '#F5DEB3' 
		// END AS `color` 
        // FROM `appoint` AS a 
        // RIGHT JOIN (
        //     SELECT MAX(`row_id`) AS `row_id`, SUBSTRING(`doctor`, 1, 5) as `doctor_code`
        //     FROM `appoint` 
        //     WHERE `hn` = '$hn' 
        //     GROUP BY `appdate`,`doctor_code`
        // ) AS b ON b.`row_id` = a.`row_id` 
        // ORDER BY a.`date` DESC 
        // LIMIT 50";
        
        $limit = '50';

        $query = "SELECT a.`row_id`,a.`hn`,a.`ptname`,a.`doctor`,a.`appdate`,a.`apptime`,a.`detail`,a.`patho`,a.`xray`,a.`other`,a.`date`,a.`injno`, 
		CASE WHEN `appdate` = '".$select_day2."'  THEN '#009966' 
		    WHEN `appdate` = '".$select_tomorow."'  THEN '#FF6699' ELSE '#F5DEB3' 
		END AS `color` 
        FROM (
            SELECT MAX(`row_id`) AS `row_id`, SUBSTRING(`doctor`, 1, 5) as `doctor_code`
            FROM `appoint` 
            WHERE `hn` = '$hn' 

            GROUP BY `appdate`,`doctor_code` 
        ) AS b 
        LEFT JOIN `appoint` AS a ON b.`row_id` = a.`row_id` 
        ORDER BY a.`date` DESC ";

        $result = mysql_query($query) or die( mysql_error() );
        $all_rows = mysql_num_rows($result);
        
        $page = (empty($_GET['page'])) ? '0' : $_GET['page'] - 1 ;
        $page_start = $page * $limit;
        $total_pages = $all_rows / $limit;
        $total_pages = (int) ceil($total_pages);
        $query .= " LIMIT $page_start, $limit";

        $whereToDay = date('Y-m-d');
        $strtotime = strtotime("-1 year");
        $whereEnDate = date('Y-m-d', $strtotime);

        $result = mysql_query($query) or die( mysql_error() );
        $items = array();
        $i=1;
        while( $item = mysql_fetch_assoc($result) ){
            
            list($testAppDate, $appTime) = explode(' ', $item['date']);
            
            //
            if( !preg_match('/\d+\-\d+\-\d+/', $item['appdate']) ){
                $appdate = str_replace($months_key, $months_val, trim($item['appdate']));
                list($d, $m, $y) = explode(' ', $appdate);
                
            }else{
                list($y, $m, $d) = explode('-', $item['appdate']);
                
            }

            // $appoint_date = strtotime(($y-543)."-$m-$d $appTime");
            $new_date = strtotime(($y-543)."-$m-$d $appTime");
            $items[$new_date] = $item; // ตั้งคีย์ใหม่เอาไว้สำหรับ sort ตามวันนัด
            $i++;
        }

        krsort($items); // ให้เรียงตามคีย์ที่ตั้งไว้

        if(!empty($page))
        {
            ?><p style="padding: 0;">กำลังแสดงหน้าที่ <?=$page;?></p><?php
        }
        ?>
        <?php
        
        foreach( $items as $key => $item){
            print (" <tr>\n".
            "  <td BGCOLOR='".$item['color']."'><A HREF=\"appinsert2.php?row_id=".$item['row_id']."\" target=\"_blank\">{$item['hn']}</A></td>\n".
            "  <td BGCOLOR='".$item['color']."'><A HREF=\"appdayprint.php?row_id=".$item['row_id']."\" target=\"_blank\">{$item['ptname']}</A></td>\n".
            "  <td BGCOLOR='".$item['color']."'>".$item['doctor']."</td>\n".
            "  <td BGCOLOR='".$item['color']."' title=\"ออกใบนัดเมื่อ {$item['date']}\">{$item['appdate']}</td>\n".
            "  <td BGCOLOR='".$item['color']."'>{$item['detail']}</td>\n".
            "  <td BGCOLOR='".$item['color']."'>{$item['apptime']}</td>\n".
            "  <td BGCOLOR='".$item['color']."'>{$item['patho']}</td>\n".
            "  <td BGCOLOR='".$item['color']."'>{$item['xray']}</td>\n".
            "  <td BGCOLOR='".$item['color']."'>{$item['other']}{$item['injno']}</td>\n".
            " </tr>\n");
        }

        if($all_rows > $limit){
        ?>
        <style>
            @media print {
                .chk_table{
                    display: none;
                }
            }
            .chk_table tr td a{
                padding: 4px;
            }
        </style>
        <table class="chk_table">
            <tr>
                <td><a href="appdaycheck.php?page=1&hn=<?=$hn;?>#work_done" title="ไปหน้าแรก">&lt;&lt;</a></td>
                <td>
                    <?php 
                    for ($i=1; $i <= $total_pages; $i++) { 
                        $bg_style = ($i==$_GET['page']) ? 'style="background-color: #bbb"' : '' ;
                        ?>
                        <td><a href="appdaycheck.php?page=<?=$i;?>&hn=<?=$hn;?>#work_done" <?=$bg_style;?> ><?=$i;?></a></td>
                        <?php 
                    }
                    ?>
                </td>
                <td><a href="appdaycheck.php?page=<?=$total_pages;?>&hn=<?=$hn;?>#work_done" title="ไปหน้าสุดท้าย">&gt;&gt;</a></td>
            </tr>
        </table>
        <?php
        }
    }
    ?>
</table>
