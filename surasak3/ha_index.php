<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตัวชี้วัด</title>
</head>
<body>
    <?php 
    include_once 'ha_menu.php';
    ?>
    <style>
        .list-item{
            display: block;
            position: relative;
            min-width: 200px;
        }
        .list-item a{
            display: block;
            background-color: #009688;
            border: 1px solid #009688;
            padding: 4px 8px;
            color: #ffffff;
        }
        .list-item a:hover{
            background-color: #00b9a7;
        }

        .list-item-thip{
            display: block;
            position: relative;
            min-width: 200px;
        }
        .list-item-thip a{
            display: block;
            background-color: #009688;
            border: 1px solid #009688;
            padding: 4px 8px;
            color: #ffffff;
            margin-bottom: 8px;
            border-radius: 6px;
            box-shadow: 0 4px #999;
        }
        .list-item-thip a:hover{
            background-color: #01796d;
        }
        .list-item-thip a:active {
            transform: translateY(2px);
        }


        .sub{
            display: block;
            position: absolute;
            top: 0;
            left: 200px;
            display: none;
            z-index: 1;
        }
        .sub > a{
            border: 1px solid #006c62;
            display: block;
        }
        .list-item:hover .sub{
            display: block;
            display: inline-block;
            min-width: 250px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
    <div>
        <h1>เลือกตัวชี้วัดที่จะบันทึก</h1>
    </div>
    
    <div style="display:inline-block;">
        <?php 
        $q = $dbi->query("SELECT * FROM `indicator_main` WHERE `status` = 'y' AND `parent` IS NULL ORDER BY `sort` ");
        if ($q->num_rows>0) {
            $i = 1;
            while ($a = $q->fetch_assoc()) { 
                $id = $a['id'];

                $q_sub = $dbi->query("SELECT * FROM `indicator_main` WHERE `parent` = '$id' AND `status` = 'y' ORDER BY `sort`");
                $sub_rows = $q_sub->num_rows;

                $url = 'ha_data.php?id='.$a['id'].'&page_action=save';
                if($sub_rows > 0){
                    $url = 'javascript:void(0);';
                }
                ?>
                <div class="list-item">
                    
                    <a href="<?=$url;?>"><?=$a['name'];?></a>
                    <?php 
                    
                    if ($sub_rows > 0) {
                        ?>
                        <div class="sub">
                        <?php
                        while ($s = $q_sub->fetch_assoc()) {
                            ?>
                            <a href="ha_data.php?id=<?=$s['id'];?>&page_action=save"><?=$s['name'];?></a>
                            <?php
                        }
                        ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                $i++;
            }
        }
        ?>
    </div>
<?php 
/*
2 คนนี้เป็น Superadmin เห็นได้ทุกเมนูย่อย สุมีนา / นิธิวดี
IC และ CMS  ==>  ปพิชญา
NSO  ==>  ปณิธิ
PCT Med  ==>  วิลาวรรณ / ภิรมภรณ์ / ปิยาภรณ์ / จีราภรณ์ / จันทร์วลัย
PCT OB-Gyne  ==>  วราภรณ์ (ศรีรัตนา ห้องคลอด)
PCT Sx  ==>  วราภรณ์(ชัย) / นันท์นภัส
PCT QMR / HRD / PTC  ==>  ภัทรียา / ปภาวิน / ภูมิพัฒน์ 
*/

$thip_items = array(
    array(
        'name' => '[THIP] IC และ CMS', 
        'link' => 'https://docs.google.com/spreadsheets/d/1ufumSlAJTPR6NRMsfHu-rrVSOhArC-IjCX3UAuWuIc0/edit?usp=sharing', 
        'allow'=>array('ปพิชญา')
    ),
    array(
        'name' => '[THIP] NSO', 
        'link' => 'https://docs.google.com/spreadsheets/d/1hWn2SXbtQeg3y0r4-ewK3Mbr-ewnZNzoFp3hVFT2pK8/edit?usp=sharing', 
        'allow'=>array('ปณิธิ')
    ),
    array(
        'name' => '[THIP] PCT Med', 
        'link' => 'https://docs.google.com/spreadsheets/d/13veL0zpa42qeapAXVXiKXyHS-ZeSimjVSK-rlemCqL8/edit?usp=sharing', 
        'allow'=>array('วิลาวรรณ','ภิรมภรณ์','ปิยาภรณ์','จีราภรณ์2','จันทร์วลัย')
    ),
    array(
        'name' => '[THIP] PCT OB-Gyne', 
        'link' => 'https://docs.google.com/spreadsheets/d/13QH2ijKYKQ5_k1tX9Et6y0ZNXgQQCWRzgjtb5YmnoTY/edit?usp=drive_link', 
        'allow'=>array('วราภรณ์'/* วราภรณ์ ศรีรัตนา */)
    ),
    array(
        'name' => '[THIP] PCT Sx', 
        'link' => 'https://docs.google.com/spreadsheets/d/1FMQ8GAARMhfP45KbelR1t9d5r4N8UPtjODMGi8YbBJs/edit?usp=sharing', 
        'allow'=>array('วราภรณ์2'/* วราภรณ์ ชัยวณิชยา */,'นันท์นภัส','นฤมล')
    ),
    array(
        'name' => '[THIP] PCT QMR / HRD / PTC', 
        'link' => 'https://docs.google.com/spreadsheets/d/1lnTLYxmZe_oGsxbB1rLr3Ck6I6aG5MX7NzjocWHiYsw/edit?usp=sharing', 
        'allow'=>array('ภัทรียา','ปภาวิน','ภูมิพัฒน์')
    ),
    array(
        'name' => 'ตัวชี้วัดทีม PCT Med', 
        'link' => 'https://docs.google.com/spreadsheets/d/1FdSjRkHcyqVrNnOPefSg5eBJ6bZuwS3-/edit?gid=1498424793#gid=1498424793', 
        'allow'=>array('ภิรมภรณ์','พูนทรัพย์','ปิยาภรณ์','จีราภรณ์2','ตรัณ','ปภาวิน','ปุณนาพร','วรางคณา','ณัฐชนน','สุวพันธ์3')
    ),
    
);
?>
<div style="margin-top:8px;">
    <div style="display:inline-block;">
        <div class="list-item-thip">
            <?php 
            $ii = 1;
            foreach ($thip_items as $thip) {
                if(in_array($_SESSION['sIdname'], $thip['allow'])==true || $_SESSION['smenucode']=='ADM' || in_array($_SESSION['sIdname'], array('สุมีนา','นิธิวดี'))==true ){
                    
                    if($ii==7){
                        $style='background-color: #131aff; border: #00048b;';
                    }
                    ?>
                    <a href="<?=$thip['link'];?>" style="<?=$style;?>" target="_blank"><?=$thip['name'];?></a>
                    <?php 
                }
                $ii++;
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>