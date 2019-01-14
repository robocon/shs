<?php 

include 'bootstrap.php';

//$shs_configs
$db = Mysql::load();
// $hn = input_post('hn');

// $db->select("SET NAMES UTF8");






$action = input_post('action');
if( $action == 'save' ){

    dump($_POST);

    exit;

} elseif( $action == 'search' ){

    $search_txt = iconv("UTF-8","TIS-620",$_POST['word']);

    // dump($search_txt);

    if( is_null($_SESSION['icf_list']) ){

        $sql = "SELECT * FROM `icf_code`";
        $db->select($sql);
        $icf_list = $db->get_items();
    
        dump($icf_list);
        $_SESSION['icf_list'] = $icf_list;
    
    }

    // $sql = "SELECT * FROM `icf_code` WHERE `detail` LIKE '%$search_txt%'";
    // $db->select($sql);

    // $rows = $db->get_rows();
    // if( $rows > 0 ){
        // $items = $db->get_items();
        ?>
        <div class="close-icf" style="text-align: center; background-color: #ffb3b3;"><b>[ปิด]</b></div>
        <div style="position: absolute; background-color: #ffffff; border: 1px solid #000000; width: 100%;">
            <table class="chk_table" style="width: 100%;">
                <tr>
                    <th>รหัส</th>
                    <th>รายละเอียด</th>
                </tr>
            <?php
            dump($search_txt);
            foreach ($_SESSION['icf_list'] as $key => $item) {

                $test_match = preg_match('/('.$search_txt.')/', $item['detail'], $matchs);
                // dump($test_match);
                
                if( $test_match > 0 ){
                    ?>
                    <tr>
                        <td class="icf_code" item-data="<?=$item['code'];?>"><?=$item['code'];?></td>
                        <td><?=$item['detail'];?></td>
                    </tr>
                    <?php
                }
                
                

            }
            ?>
            </table>
        </div>
        <?php
    // }
    
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

    .icf_code{
        color: blue;
    }
    .icf_code:hover{
        text-decoration: underline;
        cursor: pointer;
    }
    .close-icf:hover{
        cursor: pointer;
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
    $sql = "SELECT `row_id`,`thidate`,`hn`,`ptname`,`vn`,`toborow`,`icd10` FROM `opday` WHERE `hn` = '$hn' ORDER BY `row_id` DESC LIMIT 100";
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
    
    $id = input_get('id');

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

    $disabcause_list = array(
        1 => 'ความพิการแต่กาเนิด',
        2 => 'ความพิการจากการบาดเจ็บ',
        3 => 'ความพิการจากโรค'
    );
    ?>
    <form action="icf_form.php" method="post" id="userForm">
    <div>
        <fieldset>
            <legend>ฟอร์มบันทึกข้อมูล</legend>

            <fieldset>
                <legend>ข้อมูลเบื้องต้น</legend>
                <div>
                    <b>HN:</b> <?=$item['hn'];?> <b>ชื่อ-สกุล:</b> <?=$item['ptname'];?> <b>เลขที่บัตรปชช:</b> <?=$item['idcard'];?>
                    <b>ตรวจวันที่:</b> <?=$item['thidate'];?>
                </div>
            </fieldset>

            <fieldset>
                <legend>ICF</legend>
                <div>
                    เลขทะเบียนผู้พิการ(DISABID): <input type="text" name="disabid" id="disabid">
                </div>
                <div>
                    รหัสสภาวะสุขภาพ(ICF): <input type="text" name="icf" id="icf">
                </div>
                <div id="icf_res" style="position:relative;"></div>
            </fieldset>

            <fieldset>
                <legend>Disability</legend>
                <div>
                    ประเภทความพิการ(DISABTYPE): <select name="disabtype" id="">
                    <?php
                    foreach ($disabtype_list as $key => $dis) {
                        ?>
                        <option value="<?=$key;?>"><?=$key;?>. <?=$dis;?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div>
                    สาเหตุความพิการ(DISABCAUSE): <select name="disabcause" id="">
                    <?php
                    foreach ($disabcause_list as $key => $dis) {
                        ?>
                        <option value="<?=$key;?>"><?=$key;?>. <?=$dis;?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div>
                    รหัสโรคหรือการบาดเจ็บที่เป็นสาเหตุของความพิการ: 
                    <?php 
                    if( empty($item['icd10']) ){
                        echo '<span style="background-color: red;">ไม่มีการลงข้อมูล</span>';
                    }else{
                        echo $item['icd10'];
                    }
                    ?>
                </div>
            </fieldset>
            <div>
                <button type="submit">บันทึกข้อมูล</button>
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?=$item['id'];?>">
                <input type="hidden" name="test_icd" id="test_icd" value="<?=$item['icd10'];?>">
            </div>
        </fieldset>
    </div>
    </form>
    <script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery.noConflict();
        (function( $ ) {
        $(function() {

            var icf_list = [];

            <?php 
            $sql = "SELECT * FROM `icf_code`";
            $db->select($sql);
            $icf_list = $db->get_items();
            $i = 0;
            foreach( $icf_list as $key => $item ){
                ?> icf_list[<?=$i;?>] = '<?=$item['detail'];?>'; <?php
                $i++;
            }
            ?>


            $(document).on('keypress', '#icf', function(){
                var search_txt = $(this).val();

                if( search_txt.length > 3 ){

                    var regex1 = new RegExp(search_txt,'g');

                    // search_txt.match(/(search_txt)/);

                    for (let index = 0; index < icf_list.length; index++) {
                        const element = icf_list[index];

                        // console.log(regex1.test(element));

                        console.log(element.match(regex1));

                        // console.log(element);

                        // if( regex1.test(element) == true ){
                        //     console.log(element);
                        // }

                        
                    }

                    
                    /*
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
                    */

                }

            });

            
            $(document).on('click', '.close-icf', function(){ 
                $('#icf_res').hide();
            });

            $(document).on('click', '.icf_code', function(){
                var code = $(this).attr('item-data');
                $('#icf').val(code);
                $('#icf_res').hide();
            });

            $(document).on('submit', '#userForm', function(){

                if( $('#test_icd').val() == '' ){

                    var c = confirm("ยังไม่มีการลงข้อมูล ICD10 อาจทำให้ข้อมูล 43แฟ้ม ไม่ครบถ้วน\nยืนยันที่จะบันทึกข้อมูลหรือไม่");
                    if( c==false ){
                        return false;
                    }

                }

            });
            
        });
        })(jQuery);
    </script>
    <?php

}