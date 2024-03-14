<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$labnumber = sprintf("%s", ($_GET['labnumber']) ? $_GET['labnumber'] : '' );
if(empty($labnumber)){
    echo "Invalid lab number";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขแลป <?=$labnumber;?></title>
</head>
<body>
<?php 
require_once 'chk_menu.php';
?>
    <div>
        <?php 
        $sql = "SELECT * FROM resulthead WHERE labnumber = '$labnumber' ";
        $q = $dbi->query($sql);
        if($q->num_rows>0){
            ?>
            <table>
                <tr>
                    <th>Autonumber</th>
                    <th>Labnumber</th>
                    <th>Profilecode</th>
                    <th>Group</th>
                    <th>Comment</th>
                </tr>
            <?php
            while ($a = $q->fetch_assoc()) {
                ?>
                <tr>
                    <td><?=$a['autonumber'];?></td>
                    <td><?=$a['labnumber'];?></td>
                    <td><?=$a['profilecode'];?></td>
                    <td><?=$a['testgroupname'];?></td>
                    <td><?=$a['comment'];?></td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }
        ?>
        <h1>กำลังพัฒนาต่อ ให้สามารถแก้ไขรายละเอียดได้แบบเป็นตัวๆ จาย เยน เยน</h1>
    </div>
</body>
</html>