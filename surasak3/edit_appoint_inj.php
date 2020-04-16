<?php 

include 'bootstrap.php';

$db = Mysql::load();

$page = input('page');
$action = input('action');

if ( $action == 'save' ) {

    $new_date = input_post('new_date');
    $appoint_id = input_post('appoint_id');
    $ddrugrx_id = input_post('ddrugrx_id');
    // $ddrugrx_date = input_post('ddrugrx_date');
    $dphardep_id = input_post('dphardep_id');
    $hn = input_post('hn');

    $msg = "�ѹ�֡���������º����";
    
    // �.�. �� �.�.
    $new_date = ad_to_bc($new_date);

    $sql = "UPDATE `ddrugrx` SET `date`='$new_date' WHERE `row_id`='$ddrugrx_id';";
    $db->exec($sql);

    $sql = "UPDATE `dphardep` SET `date`='$new_date' WHERE `row_id`='$dphardep_id';";
    $db->exec($sql);

    redirect('edit_appoint_inj.php', $msg);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>��䢩մ�ҡó������ç�Ѵ</title>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
    <style>
    body, button{
        font-family: "TH Sarabun New", "TH SarabunPSK";
        font-size: 16pt;
    }
    .chk_table{
        border-collapse: collapse;
    }

    .chk_table th,
    .chk_table td{
        padding: 3px;
        border: 1px solid black;
        font-size: 16pt;
    }
    </style>
    <div>
        <h3>��䢩մ�ҡó������ç�Ѵ</h3>
    </div>
    <fieldset>
        <legend>���Ҩҡ HN</legend>
        <form action="edit_appoint_inj.php" method="post">
            <div>
                HN: <input type="text" name="hn" id="">
            </div>
            <div>
                <button type="submit">����</button>
                <input type="hidden" name="page" value="search_hn">
            </div>
        </form>
    </fieldset>
<?php
if ( $page == 'search_hn' ) {

    $hn = input_post('hn');

    $sql = "SELECT * 
    FROM `appoint` 
    WHERE `detail` LIKE 'FU22%' 
    AND `hn` = '$hn' 
    GROUP BY `detail2`,`appdate` 
    ORDER BY `detail2`,`appdate` DESC ";

    $db->select($sql);
    $items = $db->get_items();

    ?>
    <fieldset>
        <legend>��������´�Ѵ�մ��</legend>
        <table class="chk_table">
            <tr>
                <th>HN</th>
                <th>����-ʡ��</th>
                <th>�Ѵ���ѹ���</th>
                <th>����</th>
                <th>�Ѵ������</th>
                <th>�ҩմ</th>
                <th>������</th>
                <th>���</th>
            </tr>
        
        <?php
        foreach ($items as $key => $item) { 

            list($y,$m,$d) = explode('-',$item['appdate']);

            $mTh = $def_fullm_th[$m];
            ?>
            <tr>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$d.' '.$mTh.' '.$y;?></td>
                <td><?=$item['apptime'];?></td>
                <td><?=$item['detail'];?></td>
                <td><?=$item['detail2'];?></td>
                <td><?=$item['injno'];?></td>
                <td><a href="edit_appoint_inj.php?id=<?=$item['row_id'];?>&page=edit_form">���</a></td>
            </tr>
            <?php
        }
        ?>
        </table>
    </fieldset>
    <?php
}elseif ( $page == 'edit_form' ) {
    // 

    $id = input_get('id');

    $sql = "SELECT `row_id`,`hn`,`appdate`,`ptname`,`detail` FROM `appoint` WHERE `row_id` = '$id' LIMIT 1 ";
    $db->select($sql);
    $item = $db->get_item();

    $hn = $item['hn'];
    $appdateTH = $item['appdate'];
    $appdate = bc_to_ad($item['appdate']);

    list($y,$m,$d) = explode('-',$item['appdate']);
    $mTh = $def_fullm_th[$m];

    // �� vn
    $sql = "SELECT `row_id`,`date`,`tradname`,`injno` FROM `ddrugrx` WHERE `date` LIKE '$appdateTH%' AND `hn` = '$hn' ";
    $db->select($sql);
    $drug = $db->get_item();

    $sql = "SELECT `row_id` FROM `dphardep` WHERE `date` LIKE '$appdateTH%' AND `hn` = '$hn' ";
    $db->select($sql);
    $phar = $db->get_item();

    // $sql = "SELECT * FROM `drugrx` WHERE `datedr` = '$ddrugrx_date'";
    // $db->select($sql);
    // if ( $db->get_rows() > 0 ) {
    //     echo "�������ö����� ���ͧ�ҡ�ա�äԴ������������º��������";
    //     exit;
    // }
    
    ?>
    <link type="text/css" href="epoch_styles.css" rel="stylesheet" />
    <script type="text/javascript" src="epoch_classes.js"></script>
    <style>
    .shsTitle{
        padding: 6px 0 12px;
    }
    .shsTitle p{
        padding: 0;
        margin: 0;
    }
    .shsTitle .shsHeader{
        border-bottom: 1px solid #8b8b8b;
        margin-bottom: 6px;
    }
    </style>
    <fieldset>
        <legend>����ѹ�Ѵ�մ��</legend>
        <div class="shsTitle">
            <div class="shsHeader">���������ͧ��</div>
            <div>
                <p><b>HN:</b> <?=$item['hn'];?> <b>����-ʡ��:</b> <?=$item['ptname'];?> <b>�Ѵ�ѹ���:</b> <?=$d.' '.$mTh.' '.$y;?> <b>�Ѵ������:</b> <?=$item['detail'];?> </p>
                <p><b>�ҩմ:</b> <?=$drug['tradname'];?> <?=$drug['injno'];?></p>
            </div>
        </div>
        <form action="edit_appoint_inj.php" method="post">
            <div>
                ����͹�ѹ�Ѵ: <input type="text" name="new_date" id="new_date" value="<?=$appdate;?>">
            </div>
            <div>

                <?php 
                /**
                 * @todo ���� form event submit �����硨ҡ� drugrx 
                 * 
                 * ���� 
                 * 
                 * join ���Ƿ��� alert ����
                 */
                ?>
                <button type="submit">�ѹ�֡</button>
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="appoint_id" value="<?=$item['row_id'];?>">
                <input type="hidden" name="ddrugrx_id" value="<?=$drug['row_id'];?>">
                <input type="hidden" name="ddrugrx_date" value="<?=$drug['date'];?>">
                <input type="hidden" name="dphardep_id" value="<?=$phar['row_id'];?>">
                <input type="hidden" name="hn" value="<?=$item['hn'];?>">
            </div>
        </form>
    </fieldset>
    <script type="text/javascript">
        var popup1;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('new_date'),false);
        };
    </script>
    <?php

}
?>
</body>
</html>