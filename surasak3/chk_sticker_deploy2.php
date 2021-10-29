<?php 

include 'bootstrap.php';
$db = Mysql::load();

$part = input_get('part');

$sql = "SELECT a.*FROM `opcardchk` AS a WHERE a.`part` = '$part' ORDER BY a.`row` ASC";
$db->select($sql);
$items = $db->get_items();

?>
<style>
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
.vertical-num{
    float:left;
}

</style>
<?php
    
$ii = 0;
foreach ($items as $key => $item) {
    
    ++$ii;

    $left_exam_no = $exam_no = $item['exam_no'];
    $ptname = $item['name'].' '.$item['surname'];
    $branch = $item['branch'];

    if(strlen($item['exam_no'])==9)
    {
        $left_exam_no = substr($item['exam_no'],6,3);
    }
    
    // ปริ้นเผื่อมาสัก 3 ใบ พี่สมยศบอก
    for ($i=0; $i < 2; $i++) { 

        $last_code = '';

        ?>
        <div class="clearfix container">
            <div class="vertical-num">
                <img src="vertical_number.php?font=<?=$left_exam_no;?>" alt="">
            </div>
            <div class="content">
                <font style="font-size: 36px;" face="Angsana New"><center><b><?=$exam_no;?></b></center></font>
                <font style="font-size: 20px;" face="Angsana New"><center><b><?=$ptname;?></b></center></font>
                <font face="Angsana New"><center><b><?=$branch;?></b></center></font>
            </div>
        </div>
        <div style="page-break-before: always;"></div>
        <?php
    }

    // if( $ii == 5 ){ exit; }
    
}