<?php 
session_start();
$db2 = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

$page = $_POST['page'];
if( $page === 'search' ){

    $keyword = iconv('UTF-8', 'TIS-620', $_POST['keyword']);

    $sql = "SELECT * FROM `icf_icf` 
    WHERE `id` LIKE '$keyword%' 
    OR `detail` LIKE '%$keyword%' ";
    $q = mysql_query($sql) or die( mysql_error() );

    $icf_rows = mysql_num_rows($q);
    if ( $icf_rows > 0 ) {
        
        ?>
        <style>
            .icf_data{
                cursor: pointer;
                color: blue;
            }
            .icf_data:hover{
                text-decoration: underline;
            }
            #icf_content{
                border: 1px solid #000;
                position: relative;
            }
            .btn_icf_close{
                top: 0;
                right: 0;
                position: absolute;
                cursor: pointer;
                color: blue;
            }
        </style>
        <div id="icf_content">
            <div class="btn_icf_close">[ปิด]</div>
            <table>
                <tr>
                    <th>ICF</th>
                    <th>Detail</th>
                </tr>
                <?php
                while ( $item = mysql_fetch_assoc($q) ) {
                    ?>
                    <tr>
                        <td><div class="icf_data" item-data="<?=$item['id'];?>"><?=$item['id'];?></div></td>
                        <td><?=$item['detail'];?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php

    }else{
        ?>
        <div>ไม่พบข้อมูล</div>
        <?php
    }
    
    exit;
    
}


$action = $_POST['action'];
if ( $action === 'save' ) {

    $hn = $_POST['hn'];

    $disabtype = $_POST['disabtype'];
    $icf = $_POST['icf'];

    $sql = "SELECT * FROM `ICF` WHERE `hn` = '$hn' ";
    $q = mysql_query($sql) or die( mysql_error() );
    $icf_row = mysql_num_rows($q);
    
    if ( $icf_row > 0 ) {
        // update
        mysql_query("UPDATE `ICF` SET `ICF` = '$icf',`last_update` = NOW() WHERE `hn` = '$hn' ") or die( mysql_error() );
    }else {
        // insert
        mysql_query("INSERT INTO `ICF` (`hn`,`ICF`,`last_update`) VALUES ('$hn','$icf',NOW());") or die( mysql_error() );
    }

    $sql = "SELECT * FROM `DISABILITY` WHERE `hn` = '$hn' ";
    $q = mysql_query($sql) or die( mysql_error() );
    $disability_row = mysql_num_rows($q);
    if ( $disability_row > 0 ) {
        // update
        mysql_query("UPDATE `DISABILITY` SET `DISABTYPE` = '$disabtype',`last_update` = NOW() WHERE `hn` = '$hn' ") or die( mysql_error() );
    }else {
        // insert
        mysql_query("INSERT INTO `DISABILITY` (`hn`,`DISABTYPE`,`last_update`) VALUES ('$hn','$disabtype',NOW());") or die( mysql_error() );
    }

    $_SESSION['x_message'] = 'บันทึกข้อมูลเรียบร้อย';
    header('Location: disability_andicf_form.php');
    exit;

}

?>
<div>
    <a href="disability_view.php" target="_blank">ดูข้อมูล DISABTYPE และ ICF</a>
</div>
<?php

if ( $_SESSION['x_message'] ) {
    ?>
    <div style="border: 1px solid #699a55;background-color: #acffa7;padding: 10px;">
        <?=$_SESSION['x_message'];?>
    </div>
    <?php
    unset($_SESSION['x_message']);
}


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

<div>
    <h3>ระบบจัดการข้อมูล ICF และ DISABILITY</h3>
</div>
<div>
    <form action="disability_andicf_form.php" method="post">
        <div>
            HN: <input type="text" name="hn" id="hn">
        </div>
        <div>
            DISABTYPE: 
            <select name="disabtype" id="disabtype">
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
            ICF: <input type="text" name="icf" id="icf">
        </div>
        <div>
            <button type="submit">บันทึกข้อมูล</button>
            <input type="hidden" name="action" value="save">
        </div>
    </form>
</div>
<div id="icf_detail"></div>

<script src="../js/vendor/jquery-1.11.2.min.js"></script>
<script>
    jQuery.noConflict();
	(function( $ ) {
	$(function() {

		$(document).on("keyup", "#icf",function(){
            var keyword = $('#icf').val();
            $.ajax({
                method: "POST",
                url: "disability_andicf_form.php",
                data: { 'page': 'search', 'keyword': keyword},
                success: function(res){
                    $("#icf_detail").html(res);
                }
            });
        });

        $(document).on("click", ".icf_data", function(){
            var test_data = $(this).attr("item-data");
            $("#icf").val(test_data);
        });

        $(document).on("click", ".btn_icf_close", function(){
            $("#icf_content").remove();
        });
        
	});
	})(jQuery);
</script>

<?php
