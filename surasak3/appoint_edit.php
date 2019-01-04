<?php 

include 'bootstrap.php'; 
$db = Mysql::load();
$db->set_charset('TIS620');
?>

<style>
/* ���ҧ */
body, button{
    font-family: TH Sarabun NEW, TH SarabunPSK;
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
<h3>�к���� LAB, X-RAY �����¹Ѵ(��ǧ���ͺ)</h3>
<form action="" method="post">
    <fieldset>
        <legend>���ҵ�� HN</legend>
        <div>
            HN: <input type="text" name="hn" id="hn">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="page" value="search">
        </div>
    </fieldset>
</form>
<?php 

$page = input('page');

if ( $page == 'search' ) {
    
    $hn = input_post('hn');
    $sql = "SELECT * FROM `appoint` WHERE `hn` = '$hn' ";
    $db->select($sql);
    $rows = $db->get_rows();

    if ( $rows > 0 ) {
        $items = $db->get_items();

        ?>
        <table class="chk_table">
            <tr>
                <th>�ѹ���ŧ������</th>
                <th>�Ѵ�ҵ�Ǩ�ѹ���</th>
                <th>���ҷ��Ѵ��Ǩ</th>
                <th>ᾷ��</th>
                <th></th>
            </tr>
            <?php 
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$item['date'];?></td>
                    <td><?=$item['appdate'];?></td>
                    <td><?=$item['apptime'];?></td>
                    <td><?=$item['doctor'];?></td>
                    <td><a href="appoint_edit.php?page=form&id=<?=$item['row_id'];?>">���</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }else{
        ?>
        <p><b>��辺������</b></p>
        <?php
    }

}elseif ( $page == 'form' ) {
    
    $id = input_get('id');

    $sql = "SELECT * FROM `appoint` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $rows = $db->get_rows();

    if( $rows > 0 ){

        $item = $db->get_item();

        $sql = "SELECT a.*, b.`detail`
        FROM `appoint_lab` AS a 
        LEFT JOIN `labcare` AS b ON b.`code` = a.`code` 
        WHERE a.`id` = '$id'";
        $db->select($sql);

        $row_lab = $db->get_rows();
        // 

        ?>
        <style>
        .lab_container{
            display: none;
            position: absolute;
            top: 260px;
            left: 140px;
            background-color: #ffffff;
            border: 1px solid red;
            padding: 4px;
            width: 600px;
        }
        </style>
        <form action="appoint_edit.php" method="post">
            <div>
                <b>����-ʡ��:</b> <?=$item['ptname'];?> <b>HN:</b> <?=$item['hn'];?> ���� <?=$item['age'];?> <br>
                <b>ᾷ��:</b> <?=$item['doctor'];?> <b>�Ѵ�ҵ�Ǩ�ѹ���:</b> <?=$item['appdate'];?> ���� <?=$item['apptime'];?>
            </div>

            <div>
                <button class="table_lab">������¡�� LAB</button>
            </div>

            <div id="list_patho">
                <?php
                if ( $row_lab > 0 ) { 

                    $lab_items = $db->get_items();
                    foreach ($lab_items as $key => $lab) {
                        ?>
                        <div>
                            <?=$lab['detail'];?><a href="javascript:void(0);" class="del_item"> [ź]</a>
                        </div>
                        <?php
                    }

                }
                ?>
            </div>

        </form>

        <div class="lab_container">
            <p style="text-align: center; "><b>��¡�õ�Ǩ�ҧ��Ҹ�</b></p>
            <?php
            $sql2 = "select * from labcare where lab_list !=0 order by lab_list asc";
            $rows2 = mysql_query($sql2);
            ?>
            <table class="chk_table" width="100%">
                <tr>
                    <?php 
                    // ���� 5
                    $i = 0;
                    while($result2 = mysql_fetch_array($rows2)){ 
                        ++$i;
                        ?>
                        <td>
                            <a href="javascript: void(0);" title="<?=$result2['detail']?>" data-code="<?=$result2['code']?>" class="lab_add"><?=$result2['lab_listdetail']?></a>
                        </td>
                        <?php

                        if( $i % 5 == 0 ){
                            ?></tr><tr><?php
                            $i = 0;

                        }
                    }
                    ?>
                    
                </tr>
            </table>
        </div>

        <script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script type="text/javascript">

            /**
             * [] �Դ-�Դ ��¡�� lab
             * [] ��ԡ�����������������ѧ�����
             * [] ź��¡���͡�ҡ�����
             */
            $(document).on('click', '.table_lab', function(){
                $('.lab_container').toggle();
                return false;
            });
            
        </script>

        <?php

    }else {
        ?>
        <p><b>��辺������</b></p>
        <?php
    }

}