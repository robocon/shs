<?php 

include 'bootstrap.php';

$db = Mysql::load($shs_configs);
// $hn = input_post('hn');

// $db->select("SET NAMES UTF8");

$action = input_post('action');
if( $action == 'search' ){

    $search_txt = iconv("UTF-8","TIS-620",$_POST['word']);
    $sql = "SELECT * FROM `icf_code` WHERE `detail` LIKE '%$search_txt%'";
    
    $db->select($sql);
    $items = $db->get_items();
    ?>
    <style>
        .chk_table{
            border-collapse: collapse;
        }
        .chk_table th,
        .chk_table td{
            padding: 3px;
            border: 1px solid black;
            font-size: 16pt;
        }
        .icf_code{
            color: blue;
        }
        .icf_code:hover{
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
    <div style="text-align: center; background-color: #ffb3b3;"><b>[ปิด]</b></div>
    <div style="position: absolute; background-color: #ffffff; border: 1px solid #000000; width: 100%;">
        <table class="chk_table" style="width: 100%;">
            <tr>
                <th>รหัส</th>
                <th>รายละเอียด</th>
            </tr>
        <?php
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td class="icf_code"><?=$item['code'];?></td>
                <td><?=$item['detail'];?></td>
            </tr>
            <?php
        }
        ?>
        </table>
    </div>
    <?php
    exit;
}

?>
<style>
	*{
		font-family: 'TH Sarabun New','TH SarabunPSK';
		font-size: 18px;
	}
	input[readonly]{
		background-color: #d8d8d8;
	}
    input[type='radio'],
    label.radio{
        cursor: pointer;
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
    <div>บันทึกข้อมูล ICF & DISABILITY</div>
</div>
<div>
    <fieldset>
        <legend>ค้นหาจาก HN</legend>
        <form action="icf_form.php" method="post">
            <div>
                <input type="text" name="hn" id="" value="<?=$hn;?>">
            </div>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="page" value="search">
            </div>
        </form>
    </fieldset>
</div>

<?php 

$page = input('page');

if ( $page == 'search' ) {
    
    $hn = input_post('hn');
    $sql = "SELECT `row_id`,`thidate`,`hn`,`ptname`,`toborow`,`icd10` FROM `opday` WHERE `hn` = '$hn' ORDER BY `row_id` DESC LIMIT 100";
    $db->select($sql);
    $items = $db->get_items();

    ?>
    <div>
        <p>วันที่มาใช้บริการ</p>
    </div>
    <div>
        <table class="chk_table">
            <tr>
                <th>วันที่</th>
                <th>HN</th>
                <th>ชื่อสกุล</th>
                <th>VN</th>
                <th>ออกOPD Card</th>
                <th>ICD10</th>
            </tr>
            <?php 
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><a href="icf_form.php?page=form&id=<?=$item['row_id'];?>"><?=$item['thidate'];?></a></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['vn'];?></td>
                    <td><?=$item['toborow'];?></td>
                    <td><?=$item['icd10'];?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <?php

}elseif ( $page == 'form' ) {
    
    $id = input_post('id');

    $sql = "SELECT * FROM `opday` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $item = $db->get_item();

    $disabtype_list = array(
        1 => 'ความพิการทางการเห็น',
        2 => 'ความพิการทางการได้ยินหรือการสื่อความหมาย',
        3 => 'ความพิการการเคลื่อนไหวหรือทางร่างกาย',
        4 => 'ความพิการทางจิตใจหรือพฤติกรรมหรือออทิสติก',
        5 => 'ความพิการทางสติปัญญา',
        6 => 'ความพิการทางการเรียนรู้',
        7 => 'ความพิการทางออทิสติก'
    );
    ?>
    <form action="icf_form.php" method="post">
    <div>
        <fieldset>
            <legend>ฟอร์มบันทึกข้อมูล</legend>

            <fieldset>
                <legend>ข้อมูลเบื้องต้น</legend>
                <div>
                    HN: <?=$item['hn'];?> ชื่อ-สกุล: <?=$item['ptname'];?> เลขที่บัตรปชช: <?=$item['idcard'];?>
                    ตรวจวันที่: <?=$item['thidate'];?>
                </div>
            </fieldset>

            <fieldset>
                <legend>ICF</legend>
                <div>
                    เลขทะเบียนผู้พิการ(DISABID): <input type="text" name="disabid" id="">
                </div>
                <div>
                    รหัสสภาวะสุขภาพ(ICF): <input type="text" name="icf" id="icf">
                </div>
                <div id="icf_res" style="position:relative;"></div>
            </fieldset>

            <fieldset>
                <legend>Disability</legend>

            </fieldset>

        </fieldset>
    </div>
    </form>
    <script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery.noConflict();
        (function( $ ) {
        $(function() {

            $(document).on('keyup', '#icf', function(){
                var search_txt = $(this).val();
                $.ajax({
                    method: "POST",
                    url: "icf_form.php",
                    data: { 'action': 'search', 'word': search_txt},
                    success: function(res){
                        // res = $.parseJSON(res);
                        // if(res.length == 0){
                        //     return false;
                        // }
                        $("#icf_res").html(res);
                    }
                });

            });
            
        });
        })(jQuery);
    </script>
    <?php

}