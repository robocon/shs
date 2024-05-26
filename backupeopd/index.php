<?php 
$dbi = new mysqli('localhost','root','1234','smdb');
$dbi->query("SET NAMES UTF8");

$urlHost = "http://192.168.131.240:8081/storage/";

$last5min = date('Y-m-d H:i:s', strtotime("-15 minutes"));

$sql = "SELECT `file_name` FROM `digital_opcard` WHERE last_update >= '$last5min' ORDER BY row_id ASC";
$q = $dbi->query($sql);
if($q->num_rows>0){
    while ($a = $q->fetch_assoc()) {
        
        $imgName = $a['file_name'];
        $thumbImgName  = 'thumbnail_'.$a['file_name'];

        $fullImg = $urlHost.$imgName;
        $thumbImg = $urlHost.$thumbImgName;
        
        $fullImgHeader = get_headers($fullImg);
        if(strpos($fullImgHeader[0], '200')){
            // $res = file_put_contents($imgName, file_get_contents($fullImg));
        }

        $thumbImgHeader = get_headers($thumbImg);
        if(strpos($thumbImgHeader[0], '200')){
            // $res = file_put_contents($thumbImgName, file_get_contents($thumbImg));
        }
    }
}