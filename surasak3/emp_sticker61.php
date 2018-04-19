<?php
include 'bootstrap.php';

$db = Mysql::load();

$users = array(

    '1520100095074',
    '1520100098308',
    '3520100252397',
    '3520400166135'

);

$i = 301;

foreach ($users as $key => $item) {
    
    $sql = "SELECT * FROM opcard 
    WHERE idcard = '$item' ";

    $db->select($sql);

    $user = $db->get_item();

    $name = $user['yot'].$user['name'].' '.$user['surname'];
    $hn = $user['hn'];

    $labno1 = "180422".$i."01";
    $labno2 = "180422".$i."02";
    // dump($user['dbirth']);
    list($y, $m, $d) = explode('-', $user['dbirth']);
    $y = $y - 543;

    $bday = mktime(0,0,0,$m,$d,$y);
    $now = mktime(0,0,0,date('m'),date('d'),date('Y'));
    // dump($y);
    $mage = $now - $bday;
    // dump($mage);
    $test_bday = date('Y', $mage)-1970;
    // dump($test_bday);

    //CBC
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$name</b></center></font>";
    print "<div style='text-align:center;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno1\"></span></div>";
    print "<div style=\"page-break-before: always;\"></div>";

    //CHEM
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$name</b></center></font>";
    print "<div style='text-align:center;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno2\"></span></div>";
    print "<div style=\"page-break-before: always;\"></div>";

    //UA
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$name</b></center></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$hn</b></center></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>UA</b></center></font>";
    print "<div style=\"page-break-before: always;\"></div>";

    //1
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$name</b></center></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$hn</b></center></font>";
    print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>180422$i</b></center></font>";
    print "<div style=\"page-break-before: always;\"></div>";

    if( $test_bday >= 50 ){
        //2
        print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$name</b></center></font>";
        print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$hn</b></center></font>";
        print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>180422$i</b></center></font>";
        print "<div style=\"page-break-before: always;\"></div>";
    }
    

    $i++;

}

