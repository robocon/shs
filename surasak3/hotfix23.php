<?php
include_once 'bootstrap.php';
$dbi = new mysqli(REMOTE_HOST,REMOTE_USER,'',DB);
/**
 * ตัวตั้งต้นใน opday
 * -> เอาไปหาใน opacc2 ก่อนว่ามี depart อะไรบ้าง
 *      ->ถ้าเป็น LAB(PATHO) ไปหาใน resulthead ได้ว่ามี lab อะไรที่สั่งไปบ้าง
 *      ->ถ้าเป็น ค่ายา(PHAR) ไปที่หน้าฟอร์ม
 */
$sql = "select `thidate`,`thdatehn`,`hn`,`vn`,`ptname`,`ptright` 
from opday 
where thdatehn like '23-03-2565%' 
and ( thidate >= '2565-03-23 03:00:00' and thidate <= '2565-03-23 10:00:00' ) 
and ( 
    ptright not like 'R03%' 
    and ptright not like 'R01%' 
    and ptright not like 'R33%' 
    and ptright not like 'R02%' 
    and ptright not like 'R49%' 
) 
order by thidate asc 
limit 500 ";
$q = $dbi->query($sql);
?>
<table border="1">
    <tr>
        <th>thidate</th>
        <th>hn</th>
        <th>vn</th>
        <th>ptright</th>
        <th>depart</th>
        <th></th>
    </tr>
<?php
while ($it = $q->fetch_assoc()) {
    
    $hn = $it['hn'];
    $vn = $it['vn'];

    $sql = "select `depart`,`price` from opacc2 where date like '2565-03-23%' and hn = '$hn' GROUP BY depart, price ";
    $q2 = $dbi->query($sql);
    if($q2->num_rows == 0){ 
        continue;
    }
    ?>
    <tr>
        <td><?=$it['thidate'];?></td>
        <td><?=$it['hn'];?></td>
        <td><?=$it['vn'];?></td>
        <td><?=$it['ptname'];?></td>
        <td><?=$it['ptright'];?></td>
        <td>
            <table>
            <?php
            while ($it2 = $q2->fetch_assoc()) { 

                /**
                 * เช็กกับใน ตาราง depart อีกทีว่ามีค่าใช้จ่ายพวกนี้แล้วรึยัง
                 */

                ?>
                <tr>
                    <td>
                        <?php 
                        if ($it2['depart'] == 'PATHO') {
                            ?>
                            <a href="javascript:void(0);" onclick="window.open('hotfix23Patho.php?hn=<?=$hn;?>','hotfix23PATHO')"><?=$it2['depart'];?></a>
                            <?php
                        }else{
                            echo $it2['depart'];
                        }
                        /*
                        HEMO
                        CHD	(71641)การใช้ไตเทียม (Hemodialysis) - Chronic Hemo...	1	1500.00	1500.00
                        CHD	(71641)การใช้ไตเทียม (Hemodialysis) - Chronic Hemo...	1	500.00
                        HD1	(71640)การใช้ไตเทียม (Hemodialysis)  - Acute Hemod...	1	3000.00	3000.00
                        */
                        ?>
                    </td>
                    <td><?=$it2['price'];?></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
            ?>
        </td>
    </tr>
    <?php
}
?>
</table>