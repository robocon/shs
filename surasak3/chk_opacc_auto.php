<?php 

include 'bootstrap.php';

$db = Mysql::load();

/**
 * »Õ63 ÁÑ¹¨ÐÁÕáºè§ÊÍ§ÇÑ¹
 */
$sql = "SELECT * 
FROM `log_opcardchk` 
WHERE `log_part` = 'ÊÍºµÓÃÇ¨63' 
GROUP BY `log_hn` 
ORDER BY `log_id` ";
dump($sql);
$db->select($sql);
$items = $db->get_items();

$Thidate2 =(date("Y")+543).date("-m-d H:i:s");
$depart = "OTHER";
$detail = "¤èÒºÃÔ¡ÒÃµÃÇ¨ÊØ¢ÀÒ¾µÓÃÇ¨";
$price = 880;
$paid  = 880;
$idname='¹Ò§¾Ç§à¾çªÃ â¹ã¨»Ô§';
$credit="à§Ô¹Ê´";

$billno = '';

foreach ($items as $key => $value) {

    $hn = $value['log_hn'];
    
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
    dump($insert);
    echo "<hr>";
}

exit;