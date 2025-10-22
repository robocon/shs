<?php 
require_once 'bootstrap.php';

if(empty($_SESSION['sOfficer'])){
	?>
	<p>Session หมดอายุ</p>
	<p>กรุณา Login ใหม่อีกครั้ง</p>
	<?php
	exit;
}

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
    ?>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 16pt;
        }
        h3,p{
            margin: 0;
            padding: 0;
        }
        h3{
            font-size: 20pt;
        }
    </style>
    <?php
    $datehn = substr($date,8,2).'-'.substr($date,5,2).'-'.substr($date,0,4).$hn;
    $sqlOpday="SELECT `ptright` FROM `opday` WHERE `thdatehn` = '$datehn'";
    $qop = $dbi->query($sqlOpday);
    $opday = $qop->fetch_assoc();
    $ptright = $opday['ptright'];
    ?>
    <table align="center">
        <tr>
            <td>
                <table align="center">
                    <tr>
                        <td rowspan="5"><img src="images/LogoFSH_mini.jpg" style="height:120px;">&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><h3>ใบนัดผู้ป่วยฉีดยาต่อเนื่อง</h3></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><h3>โรงพยาบาลค่ายสุรศักดิ์มนตรี</h3></td>
                    </tr>
                    <tr>
                        <td>
                            <p><B>HN</B> : <?=$hn;?></p>
                            <p><B>อายุ</B> : <?=$age;?></p>
                        </td>
                        <td>
                            <p><B>ชื่อ-สกุล</B> :  <?=$fullname;?></p>
                            <p><B>สิทธิ</B> : <?=$ptright;?></p>
                        </td>
                    </tr>
                </table>
                <table align='center' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse;'>
                    <tr>
                        <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;<FONT><B>เพื่อ</B> : <U><B><?=$detail2;?></B></U></FONT>&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <table border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
                                <tr align='center'>
                                    <td><B>นัดวันที่</B></td>
                                    <td><B>เวลา</B></td>
                                    <td><B>ผู้ฉีด</B></td>
                                </tr>
                                <?php
                                for($i=0;$i<count($list);$i++){
        
                                    list($y,$m,$d) = explode('-', $list[$i]['appdate']);
                                    $fulldate = $d.' '.$def_fullm_th[$m].' '.$y;

                                    $apptime = $list[$i]['apptime'];
                                    
                                    echo "<tr><td class='font_title_n'>&nbsp;$fulldate&nbsp;</td>";
                                    echo "<td align='center' class='font_title_n'>&nbsp;$apptime&nbsp;</td>";
                                    echo "<td width='100'>&nbsp;</td></tr>";
                                }
                                ?>
                            </table>
                        </td>
                        <td valign="top">
                            <table>
                                <tr>
                                    <td class='font_title_n' align="right"><B>ยื่นใบนัดที่</B> : </td>
                                    <td class='font_title_n'><?=$room;?></td>
                                </tr>
                                <tr>
                                    <td class='font_title_n' align="right"><B>แพทย์ผู้นัด</B> : </td>
                                    <td class='font_title_n'><?=substr($doctor,5);?></td>
                                </tr>
                                <tr>
                                    <td class='font_title_n' align="right"><B>ผู้ออกใบนัด</B> : </td>
                                    <td class='font_title_n'><?=$officer;?></td>
                                </tr>
                                <tr>
                                    <td class='font_title_n' align="right"><B>วันที่ออกใบนัด</B> : </td>
                                    <td class='font_title_n'><?=$date;?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class='font_title_n' align="center"><B>หมายเหตุ</B> : <U><B><?=$remark;?></B></U></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
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
    <h3>พิมพ์ใบนัดฉีดยา(ห้องฉุกเฉิน)ย้อนหลัง</h3><span>ข้อมูล3เดือนย้อนหลัง</span>
</div>

<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 16pt;
    }
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
        <td>🖨️<a href="reprint_inj_appoint.php?page=reprint&hn=<?=$hn;?>&date=<?=$date;?>" target="_blank"><?=$a['hn'];?></a></td>
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