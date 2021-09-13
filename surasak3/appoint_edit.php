<?php 

include 'bootstrap.php'; 

$db = Mysql::load();

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES TIS620");
$db->set_charset('TIS620');

$action = input('action');

if( $action == 'print' )
{

    $id = input_get('id');

    echo "<p>บันทึกข้อมูลเรียบร้อย</p>";
    echo '<p><a href="appinsert2.php?row_id='.$id.'" target="_blank">พิมพ์ใบนัด</a></p>';
    echo '<p><a href="appoint_edit.php">กลับหน้าเดิม</a></p>';
    exit;

}
elseif ($action=='search') 
{
    $value = trim(input_get('value'));

    if(empty($value))
    {
        exit;
    }

    $sql = "SELECT `code`,`detail`,`olddetail` FROM `labcare` WHERE ( `code` LIKE '%$value%' OR `codelab` LIKE '%$value%' OR `codex` LIKE '%$value%' )";
    $q = $dbi->query($sql);

    ?>
    <div id="close_lab_search_name" style="text-align: center; font-weight: bold; background-color: #bbbbbb">[ ปิด ]</div>
    <table class="chk_table" width="100%">
        <tr>
            <th>code</th>
            <th>detail</th>
            <th>olddetail</th>
        </tr>
    <?php
    while ($item = $q->fetch_assoc()) 
    {
        ?>
        <tr>
            <td><a href="javascript:void(0);" data-detail="<?=$item['detail'];?>" data-code="<?=$item['code'];?>" class="lab_add selected_code_detail"><?=$item['code'];?></a></td>
            <td><?=$item['detail'];?></td>
            <td><?=$item['olddetail'];?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
    exit;
}

?>

<style>
/* ตาราง */
*{
    font-family: "TH Sarabun New", "TH SarabunPSK";
    font-size: 14pt;
}
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
</style>

<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;เมนูหลัก ร.พ.</a>
</div>

<h3>ระบบแก้ไข LAB, X-RAY ผู้ป่วยนัด(ช่วงทดสอบ)</h3>
<?php 
if( isset($_SESSION['msg']) )
{
    ?><div style="border: 1px solid #bfbf00;padding: 4px;background-color: #ffffbc;display: table;width: 50%;"><?=$_SESSION['msg'];?></div><?php
    $_SESSION['msg'] = NULL;
}
?>
<form action="appoint_edit.php" method="post">
    <fieldset style="width: 200px;">
        <legend>ค้นหาตาม HN</legend>
        <div>
            HN: <input type="text" name="hn" id="hn">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="search">
        </div>
    </fieldset>
</form>
<?php 

$page = input('page');

if ( $page == 'search' )
{
    
    $hn = input_post('hn');

    $curr_date = date('Y-m-d');

    $sql = "SELECT * FROM `appoint` 
    WHERE `hn` = '$hn' 
    AND (`appdate_en` IS NOT NULL AND `appdate_en` >= '$curr_date' ) 
    ORDER BY `row_id` DESC ";
    
    $db->select($sql);
    $rows = $db->get_rows();

    if ( $rows > 0 )
    {
        $items = $db->get_items();

        ?>
        <table class="chk_table">
            <tr>
                <th>วันที่ลงข้อมูล</th>
                <th>นัดมาตรวจวันที่</th>
                <th>เวลาที่นัดตรวจ</th>
                <th>นัดมาเพื่อ</th>
                <th>แพทย์</th>
                <th></th>
            </tr>
            <?php 
            foreach ($items as $key => $item) 
            {
                ?>
                <tr>
                    <td><?=$item['date'];?></td>
                    <td><?=$item['appdate'];?></td>
                    <td><?=$item['apptime'];?></td>
                    <td><?=$item['detail'];?></td>
                    <td><?=$item['doctor'];?></td>
                    <td><a href="appoint_edit.php?page=form&id=<?=$item['row_id'];?>" target="_blank">แก้ไข</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    else
    {
        ?>
        <p><b>ไม่พบข้อมูลการนัด</b></p>
        <?php
    }

}
elseif($page=="form")
{
    require_once 'appoint_edit_form.php';
}