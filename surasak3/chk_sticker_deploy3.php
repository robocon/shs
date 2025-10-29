<?php 
/**
 * @important ใช้แสดงแค่เลขลำดับที่กับชื่อเท่านั้น
 */
include 'bootstrap.php';
$db = Mysql::load();

$part = input_get('part');

$sql = "SELECT a.*FROM `opcardchk` AS a WHERE a.`part` = '$part' ORDER BY a.`row` ASC";
$db->select($sql);
$items = $db->get_items();

?>
<style>
.clearfix::after {content: "";clear: both;display: table;}
.vertical-num{float:left;}
</style>
<?php
$ii = 0;
foreach ($items as $key => $item) {
    ++$ii;
    $ptname = $item['name'].' '.$item['surname'];

    $pid = (int) $item['pid'];

    for ($i=1; $i <= 4; $i++) { 
        ?>
        <div class="clearfix container">
            <div class="content">
                <font style="font-size: 36px;" face="Angsana New"><center><b><?=$pid;?></b></center></font>
                <font style="font-size: 20px;" face="Angsana New"><center><b><?=$ptname;?></b></center></font>
                <font face="Angsana New"><center><b><?=$branch;?></b></center></font>
            </div>
        </div>
        <div style="page-break-before: always;"></div>
        <?php
    }
}