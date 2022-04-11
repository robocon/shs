<?php 
include 'bootstrap.php';
$dbi = new mysqli('192.168.131.250','remoteuser','',DB);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหา PART</title>
</head>
<body>
    <style>
        .chk_table{
            border-collapse: collapse;
        }
        .chk_table th,
        .chk_table td{
            padding: 3px;
            border: 1px solid black;
        }
        a.opaccId:visited{
            color: green;
        }
    </style>

    <form action="find_part.php" method="post">
        <div>
            วันที่ <input type="text" name="findDate" id="findDate" value="<?=(date('Y')+543).date('-m');?>">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="action" value="findPart">
        </div>
    </form>
    
    <?php 
    $action = $_POST['action'];
    if($action==='findPart')
    {
        $date = $_POST['findDate'];
        $sql = "SELECT a.*, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname` 
        FROM ( 
            SELECT `hn`, `row_id`, `date`, `depart`, `detail`, `price` 
            FROM `opacc` 
            WHERE `date` LIKE '$date%' AND ( 
                ( `depart` = '' OR `depart` IS NULL )
                OR 
                (`detail` IS NULL OR `detail` = '')
            ) 
        ) AS a 
        LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` ";
        $q = $dbi->query($sql);
        ?>
        <table class="chk_table">
            <tr>
                <td>row_id</td>
                <td>date</td>
                <td>hn</td>
                <td>ptname</td>
                <td>depart</td>
                <td>detail</td>
                <td>price</td>
            </tr>
        <?php
        while ($item = $q->fetch_assoc()) {
            $shortDate = substr($item['date'],0,10);
            ?>
            <tr>
                <td><a href="edit_opacc.php?date=<?=$shortDate;?>&hn=<?=$item['hn'];?>" target="_blank" class="opaccId"><?=$item['row_id'];?></a></td>
                <td><?=$item['date'];?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['depart'];?></td>
                <td><?=$item['detail'];?></td>
                <td><?=$item['price'];?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }
    ?>
</body>
</html>
