<?php
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_opcard.php';
require_once dirname(__FILE__).'/class_file/class_opday.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$classOpday = new Opday();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="pre_vn.php" method="post">
        <div>
            <button type="submit">ดำเนินการออก vn อัตโนมัติ องค์การบริหารส่วนจังหวัดลำปาง 68</button>
            <input type="hidden" name="action" value="generate">
        </div>
    </form>
<?php
$action = $_POST['action'];
if($action==='generate'){
    $sqlPreVn = "SELECT * FROM `pre_vn` ORDER BY `id` ASC";
    $q = $dbi->query($sqlPreVn);
    if($q->num_rows>0){
        ?>
        <table>
            <tr>
                <th>HN</th>
                <th>VN</th>
                <th>ชื่อ-สกุล</th>
                <th>สิทธิ์</th>
                <th>ออก OPD CARD</th>
                <th>จนท.</th>
            </tr>
        <?php
        while($a = $q->fetch_assoc()){
            
            $hn = $a['hn'];
            $ptrightCode = $a['ptright'];

            $thisDay = $classOpday->getThisDay($hn);
            if($thisDay===false){

                if($ptrightCode=='R33'){
                    $classOpday->setToborow('EX51 ตรวจสุขภาพ อปท.');
                }elseif ($ptrightCode=='R07') {
                    $classOpday->setToborow('EX46 ตรวจสุขภาพประกันสังคม');
                }
                
                $classOpday->sOfficer = 'กรรณิกา ทาใจ';
                $opday = $classOpday->createOpday($hn);
                ?>
                <tr bgcolor="green">
                    <td><?=$opday['hn'];?></td>
                    <td><?=$opday['vn'];?></td>
                    <td><?=$opday['ptname'];?></td>
                    <td><?=$opday['ptright'];?></td>
                    <td><?=$opday['toborow'];?></td>
                    <td><?=$opday['officer'];?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr bgcolor="yellow">
                    <td><?=$thisDay['hn'];?></td>
                    <td><?=$thisDay['vn'];?></td>
                    <td><?=$thisDay['ptname'];?></td>
                    <td><?=$thisDay['ptright'];?></td>
                    <td><?=$thisDay['toborow'];?></td>
                    <td><?=$thisDay['officer'];?></td>
                </tr>
                <?php
            }
        }
        ?>
        </table>
        <?php
    }
}

?>
</body>
</html>