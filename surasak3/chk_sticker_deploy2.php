<?php 

include 'bootstrap.php';
$db = Mysql::load();

$part = input_get('part');

$sql = "SELECT a.*
FROM `opcardchk` AS a 
WHERE a.`part` = '$part' 
ORDER BY a.`row` ASC";
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

    $exam_no = $item['exam_no'];
    // $lab_chem = $exam_no."02";
    $ptname = $item['name'].' '.$item['surname'];
    // $hn = $item['HN'];
    
    // �����������ѡ 3 � ������Ⱥ͡
    for ($i=0; $i < 1; $i++) { 

        $last_code = '';

        ?>
        <div class="clearfix container">
            <div class="vertical-num">
                <img src="vertical_number.php?font=<?=$exam_no;?>" alt="">
            </div>
            <div class="content">
                <font style="font-size: 36px;" face='Angsana New' ><center><b><?=$exam_no;?></b></center></font>
                <font style="font-size: 20px;" face='Angsana New' ><center><b><?=$ptname;?></b></center></font>
                <font face='Angsana New' ><center><b><?=$last_code;?></b></center></font>
            </div>
        </div>
        <div style="page-break-before: always;"></div>
        <?php
    }

    // if( $ii == 5 ){ exit; }
    
}