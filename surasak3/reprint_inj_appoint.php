<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->set_charset("utf8");

$page = $_GET['page'];
if($page=='reprint')
{

    $date = $_GET['date'];
    $hn = $_GET['hn'];
    $sql = "SELECT * FROM `appoint` WHERE `date` = '$date' AND `hn` = '$hn' ";
    $q = $dbi->query($sql);
    $remark = $date = $officer = $doctor = $room = $detail2 = $age = $hn = $fullname = "";
    $list = array();
    while ($a = $q->fetch_assoc()) {
        
        $list[] = array('appdate' => $a['appdate'], 'apptime' => $a['apptime']);
        
        $fullname = $a['ptname'];
        $hn = $a['hn'];
        $age = $a['age'];
        $detail2 = $a['detail2'];
        $room = $a['room'];
        $doctor = $a['doctor'];
        $officer = $a['officer'];
        $date = $a['date'];
        $remark = $a['remark'];

    }

    $datehn = substr($date,8,2).'-'.substr($date,5,2).'-'.substr($date,0,4).$hn;
    $sqlOpday="SELECT `ptright` FROM `opday` WHERE `thdatehn` = '$datehn'";
    $qop = $dbi->query($sqlOpday);
    $opday = $qop->fetch_assoc();
    $ptright = $opday['ptright'];
    
    echo "<TABLE align='center'><TR><TD>";

    echo "<CENTER><B><FONT  class='font_title_b'>ใบนัดผู้ป่วยฉีดยาต่อเนื่อง โรงพยาบาลค่ายสุรศักดิ์มนตรี</FONT></B></CENTER>";
    echo "&nbsp;&nbsp;<B>ชื่อ</B> :  $fullname";
    echo "&nbsp;&nbsp;<B>HN</B> : $hn";
    echo "&nbsp;&nbsp;<B>อายุ</B> : $age";
    echo "&nbsp;&nbsp;<B>สิทธิ</B> : $ptright";
    
    echo "<p><TABLE align='center' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
    <TR>
        <TD>&nbsp;&nbsp;&nbsp;<FONT  class='font_title_b'><B>เพื่อ</B> : <U><B>$detail2</B></U></FONT>&nbsp;&nbsp;&nbsp;</TD>
    </TR>
    </TABLE></p>";
    
    echo "<table><tr><td><table border='1' width='300' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>";
    echo "<tr align='center'><td><B>นัดวันที่</B></td><td><B>เวลา</B></td><td><B>ผู้ฉีด</B></td></tr>";
    for($i=0;$i<count($list);$i++){
        
        list($y,$m,$d) = explode('-', $list[$i]['appdate']);
        $fulldate = $d.' '.$def_fullm_th[$m].' '.$y;

        $apptime = $list[$i]['apptime'];
    
        echo "<tr><td width='130' class='font_title_n'>$fulldate</td>";
        echo "<td align='center'  width='70' class='font_title_n'>$apptime</td>";
        echo "<td  width='100'>&nbsp;</td></tr>";
    }
    echo "</table></td><td>";
    
    echo "<table>";
    echo "<tr ><td align='right' class='font_title_n'><B>ยื่นใบนัดที่</B> : </td><td class='font_title_n'>$room</td></tr>";
    echo "<tr><td align='right' class='font_title_n'><B>แพทย์ผู้นัด</B> : </td><td class='font_title_n'>".substr($doctor,5)."</td></tr>";
    echo "<tr><td align='right' class='font_title_n'><B>ผู้ออกใบนัด</B> : </td><td class='font_title_n'>$officer</td></tr>";
    echo "<tr><td align='center' class='font_title_n' colspan='2'>$date</td></tr>";
    echo "</table>";
    
    echo "</td></table>";
    
    echo "<CENTER><FONT class='font_title_b'><B>หมายเหตุ</B> : <U><B>$remark</B></U></FONT></CENTER>";
    
    echo "</TD></TR></TABLE>";
    ?>
    <script>
        window.onload = function(){
            window.print();
        }
    </script>
    <?php

    exit;
}


$tt = strtotime("-3 month");
$endate = date('Y-m-d',$tt);
$sql = "SELECT `hn`,`ptname`,`date`,`appdate`,`apptime`,`detail2`,`depcode`,`remark`,`room` 
FROM `appoint` 
WHERE `appdate_en` >= '$endate' 
AND `apptime` != 'ยกเลิกการนัด' 
AND ( `depcode`LIKE 'U16%'  OR `depcode`LIKE 'U22%' )
AND `detail2` LIKE '%ฉีดยา%' 
GROUP BY `date`,`hn`
ORDER BY `date` DESC ";

$q = $dbi->query($sql);
?>
<div>
<A HREF="..\nindex.htm">&lt;&lt;&nbsp;เมนู</A> | <a href="inject_wound_er.php">ออกใบนัดฉีดยา</a>
</div>

<div>
    <h3>พิมพ์ใบนัดฉีดยา(ห้องฉุกเฉิน)ย้อนหลัง</h3>
    <br><span>ข้อมูล3เดือนย้อนหลัง</span>
</div>

<style>
    .chk_table{
        border-collapse: collapse;
    }
    .chk_table th,
    .chk_table td{
        padding: 3px;
        border: 1px solid black;
    }
</style>

<table class="chk_table">
    <tr>
        <th>HN</th>
        <th>ชื่อ-สกุล</th>
        <th>เริ่มวันนัด</th>
        <th>เวลา</th>
        <th>รายละเอียด</th>
        <th>ยื่นใบนัด</th>
        <th>หมายเหตุ</th>
    </tr>

<?php
while ($a = $q->fetch_assoc()) {
    $date = $a['date'];
    $hn = $a['hn'];
    ?>
    <tr>
        <td><a href="reprint_inj_appoint.php?page=reprint&hn=<?=$hn;?>&date=<?=$date;?>" target="_blank"><?=$a['hn'];?></a></td>
        <td><?=$a['ptname'];?></td>
        <td><?=$a['appdate'];?></td>
        <td><?=$a['apptime'];?></td>
        <td><?=$a['detail2'];?></td>
        <td><?=$a['room'];?></td>
        <td><?=$a['remark'];?></td>
    </tr>
    <?php
}
?>
</table>