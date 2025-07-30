<?php
include dirname(__FILE__).'/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$sql = "select a.*,b.* from (
select autonumber,orderdate,labnumber,hn,patientname,clinicalinfo,profilecode from resulthead WHERE orderdate LIKE '2025-07-30%' 
) as a left join employee as b on b.hn = a.hn
where b.id is not null";
dump($sql);
$q = $dbi->query($sql);
while ($a = $q->fetch_assoc()) {
    
    $info = $a['clinicalinfo'];
    $autonumber = $a['autonumber'];

    if($info!=='ตรวจสุขภาพประจำปี68'){
        
        $sqlUpdate = "UPDATE `resulthead` SET `clinicalinfo` = 'ตรวจสุขภาพประจำปี68' WHERE `autonumber` = '$autonumber' ";
        dump($sqlUpdate);
        $qUpdate = $dbi->query($sqlUpdate);
        dump($qUpdate);
    }else{
        dump($a['hn'].' : '.$autonumber.' : '.$info);
    }
    
}
?>
</body>
</html>