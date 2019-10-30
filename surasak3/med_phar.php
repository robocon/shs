<?php 

include 'bootstrap.php';
$action = input('action');
$page = input('page');
if ($action === 'active') {
    $confirm = trim($_SESSION['sOfficer']);
    $id = input_get('id');

    $sql = "UPDATE `med_scan` SET 
    `lastupdate`=NOW(), 
    `confirm`='y', 
    `lasteditor`='$confirm' 
    WHERE (`id`='$id');";
    $q = mysql_query($sql);
    if( $q !== false ){
        $msg = 'บันทึกข้อมูลเรียบร้อย';
    }else{
        $err = set_log(mysql_error());
        $msg = 'ไม่สามารถบันทึกข้อมูลได้'.$err['id'].' ' .$err['msg'];
    }

    redirect('med_phar.php?action=print&id='.$id,$msg);
    exit;
}elseif ( $action === 'print' ) {
    
    $sql = "SELECT * FROM `med_scan` WHERE `id` = '$id' ";
    $q = mysql_query($sql);

    $item = mysql_fetch_assoc($q);

    ?>
    <style>
    @media print{
        .no-print{
            display: none;
        }
    }
    
    </style>
    <div class="no-print">
        <button type="button" onclick="print_img()" >พิมพ์</button> | <a href="med_phar.php">กลับหน้ารายการ</a>
    </div>
    <img src="<?=$item['path'];?>" id="mainImg">
    <script>
        function print_img(){
            window.print();
        }

        window.onload = function(){
            window.print();
        };
    </script>
    <?php

    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>นำร่องอายุรกรรม</title>
</head>
<body>

<style>
*{
    font-family: "TH SarabunPSK","TH Sarabun New";
    font-size: 16pt;
}
p{
    margin: 0;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}

tr{
    vertical-align: top;
}

#imgContainer{
    position: absolute;
    top: 2%;
    left: 2%;
    background-color: #ffffff;
    border: 2px solid #000000;
}
#imgBtnClose{
    text-align: center; 
    background-color: #b8b8b8;
}
#imgBtnClose:hover{
    cursor: pointer;
}

.btnActive{
    padding: 3px;
    color: #000000;
    background-color: #b8b8b8;
    margin: 2px;
    text-decoration: none;
}
</style>
<div>
    <p><a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลัก</a> | <a href="med_ward.php">หน้าวอร์ด</a></p>
</div>
<?php
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 2px solid #afaf00; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}
?>
<div>
    <h3>นำร่องอายุรกรรม(ช่วงทดสอบ)</h3>
</div>
<?php
$sql = "SELECT * FROM `med_scan` WHERE `confirm` IS NULL ORDER BY `id` DESC";
$q = mysql_query($sql);

if ( mysql_num_rows($q) > 0 ) {
    
    ?>
    <table class="chk_table">
        <tr>
            <th>วันที่บันทึกข้อมูล</th>
            <th>รายละเอียด</th>
            <th>ไฟล์</th>
            <th>ยืนยันการรับข้อมูล</th>
        </tr>
    
    <?php
    while ($item = mysql_fetch_assoc($q)) {
        
        ?>
        <tr>
            <td>
                <p><?=$item['date'];?></p>
            </td>
            <td>
                <p>HN: <?=$item['hn'];?></p>
                <p>AN: <?=$item['an'];?></p>
                <p>ชื่อ-สกุล: <?=$item['ptname'];?></p>
            </td>
            <td>
                <a href="javascript:void(0)"><img src="<?=$item['path'];?>" class="showImg" alt="" width="200px;"></a>
            </td>
            <td style="vertical-align: middle;">
                <a href="med_phar.php?action=active&id=<?=$item['id'];?>&an=<?=$item['an'];?>" class="btnActive">Active & Print</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}
?>


<fieldset>
    <legend>ค้นหาเอกสารด้วย AN</legend>
    <form action="med_phar.php" method="post">
        <div>
            AN: <input type="text" name="an" id="">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="searchFile">
        </div>
    </form>
</fieldset>

<?php 
if ( $page === 'searchFile' ) {
    
    $an = input('an');
    $sql = "SELECT * FROM `med_scan` WHERE `an` = '$an' AND `confirm` = 'y' ORDER BY `id` DESC";
    $q = mysql_query($sql);
    if ( mysql_num_rows($q) > 0 ) {

        ?>
        <table class="chk_table">
            <tr>
                <th>วันที่บันทึกข้อมูล</th>
                <th>ข้อมูล</th>
                <th>ไฟล์</th>
                <th>Re-Print</th>
            </tr>
        
        <?php
        while ($item = mysql_fetch_assoc($q)) {
            ?>
            <tr>
                <td>
                    <p><?=$item['date'];?></p>
                </td>
                <td>
                    <p>HN: <?=$item['hn'];?></p>
                    <p>AN: <?=$item['an'];?></p>
                    <p>ชื่อ-สกุล: <?=$item['ptname'];?></p>
                </td>
                <td>
                    <a href="javascript:void(0)"><img class="showImg" src="<?=$item['path'];?>" alt="" width="200px;"></a>
                </td>
                <td style="vertical-align: middle;">
                    <a href="med_phar.php?action=print&&id=<?=$item['id'];?>" class="btnActive" target="_blank">พิมพ์</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }else{
        echo "ไม่พบข้อมูล $an";
    }


}

?>
<div id="imgContainer" style="display: none;">
    <div id="imgBtnClose">[Close]</div>
    <div><img src="" alt="" id="imgContent"></div>
</div>
<script>
    
    // open popup
    var imgs = document.querySelectorAll('.showImg');
    for (var index = 0; index < imgs.length; index++) {
        var item = imgs[index];
        
        item.addEventListener('click', function(event) {
            document.getElementById('imgContent').setAttribute('src', this.getAttribute('src'));
            document.getElementById('imgContainer').style.display = ''; // show

            var doc = document.documentElement;
            var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
            document.getElementById('imgContainer').setAttribute('style', 'top: '+top+'px;');
        });
        
    }

    // close button
    var imgBtn = document.querySelectorAll('#imgBtnClose');
    imgBtn[0].addEventListener('click', function(event){
        document.getElementById('imgContainer').style.display = 'none';
    });
    
</script>

</body>
</html>