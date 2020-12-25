<?php 

include 'bootstrap.php';

$db = Mysql::load();

/**
 * »Õ63 ÁÑ¹¨ÐÁÕáºè§ÊÍ§ÇÑ¹
 * ÊÍºµÓÃÇ¨63 ¡Ñº ÊÍºµÓÃÇ¨63_02
 */


$sql = "SELECT * FROM `log_opcardchk` WHERE `log_part` = 'ÊÍºµÓÃÇ¨ 64' ORDER BY `log_id` ASC ";
$db->select($sql);
$items = $db->get_items();

$Thidate2 =(date("Y")+543).date("-m-d H:i:s");
$depart = "OTHER";
$detail = "¤èÒºÃÔ¡ÒÃµÃÇ¨ÊØ¢ÀÒ¾µÓÃÇ¨";
$price = 880.00;
$paid  = 880.00;
$idname='¹Ò§¾Ç§à¾çªÃ â¹ã¨»Ô§';
$credit="µÃÇ¨ÊØ¢ÀÒ¾µÓÃÇ¨";

foreach ($items as $key => $value) {

    $hn = $value['log_hn'];
    $logId = $value['log_id'];
    $billno = $value['bill'];
    
    $sqlOpacc = "INSERT INTO `opacc` ( 
        `date` , `txdate` , `hn` , `depart` , `detail` , 
        `price` , `paid` , `idname` , `credit` , `ptright` , 
        `credit_detail` , `billno`
    ) VALUES ( 
        '$Thidate2', '$Thidate2', '$hn', '$depart', '$detail', 
        '$price', '$paid', '$idname',  '$credit', 'R01 à§Ô¹Ê´', 
        '', '$billno'
    );";
    dump($sqlOpacc);

    $insert = $db->insert($sqlOpacc);
    $opaccId = $db->get_last_id();
    dump($insert);

    
    $logQL = "UPDATE `log_opcardchk` SET 
    `opacc_id` = '$opaccId' 
    WHERE `log_id` = '$logId' ";
    $db->update($logQL);

    echo "<hr>";
}

exit;