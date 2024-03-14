<?php 
require_once 'bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_drugreact.php';
require_once dirname(__FILE__).'/class_file/class_drug.php';
require_once dirname(__FILE__).'/class_file/opcard.php';

$hn = sprintf("%s", $_GET['hn']);
if (empty($hn)) {
    echo "Invlid data";
    exit;
}

$drugreact = new Drugreact();
$items = $drugreact->getDrugreactFromHn($hn,null," AND advreact != '' AND g6pd IS NULL ");

$opcard = new Opcard();
$user = $opcard->getByHn($hn,array('hn','yot','name','surname'));
$ptname = $user['yot'].$user['name'].' '.$user['surname'];

$fields = array('groupname');
// $groupFromHn = $drugreact->getDrugreactFromHn($hn, $fields, "AND groupname <> ''", 'GROUP BY groupname');

$drug = new Drug();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติแพ้ยา <?=$ptname;?> (HN: <?=$user['hn'];?>)</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    if(!$items['error']){
    ?>
    <div class="">
        <h3 class="mt-2">ประวัติแพ้ยา <?=$ptname;?> (HN: <?=$user['hn'];?>)</h3>
        <table class="table table-striped table-hover">
            <tr class="table-danger">
                <th>รหัสยา</th>
                <th>ชื่อการค้า</th>
                <th>ชื่อสามัญ</th>
                <th>อาการ</th>
            </tr>
            <?php 
            foreach($items as $key => $a){ 
                ?>
                <tr>
                    <td><small><?=$a['drugcode'];?></small></td>
                    <td><small><?=$a['tradname'];?></small></td>
                    <td><small><?=$a['genname'];?></small></td>
                    <td><small><?=$a['advreact'];?></small></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php 
        $userGroup = $drugreact->getDrugreactGroupByHn($hn);
        if(!$userGroup['error']){
            ?>
            <h3 class="text-center">กลุ่มยาที่มีโอกาสแพ้</h3>
            <table>
                <?php 
                foreach ($userGroup as $key => $g) { 
                    $drugInGroup = $drugreact->getDrugreactGroupList($group['id']);
                    ?>
                    <tr>
                        <td>
                            <h4 class="text-left" data-bs-toggle="collapse" data-bs-target="#table<?=$g['id'];?>" title="คลิกเพื่อดูรายละเอียดยาในกลุ่ม">
                                <a href="javascript:void(0);"><?=$g['name'];?></a>
                            </h4>
                            <table class="table table-striped table-hover collapse" id="table<?=$g['id'];?>">
                                <tr class="table-warning">
                                    <th>รหัสยา</th>
                                    <th>ชื่อการค้า</th>
                                    <th>ชื่อสามัญ</th>
                                </tr>
                            <?php
                            foreach ($drugInGroup as $keyDg => $dg) { 
                                $dd = $drug->getDruglst($dg['drugcode'], array('tradname', 'genname'));
                                ?>
                                <tr>
                                    <td><small><?=$dg['drugcode'];?></small></td>
                                    <td><small><?=$dd['tradname'];?></small></td>
                                    <td><small><?=$dd['genname'];?></small></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                

            </table>

            <?php
        }
        ?>
        
    </div>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <?php 
    }else{
        ?><div class="container"><h1>ไม่พบประวัติแพ้ยา</h1></div><?php
    }
    ?>
</body>
</html>