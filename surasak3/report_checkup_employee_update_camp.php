<?php
require_once 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

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
$sql = "select b.* from lab67 as a 
LEFT JOIN (
	select * from dxofyear_out where yearchk = '67' and (thidate>='2024-01-29 00:00:00' and thidate<='2024-02-02 23:59:59')
)as b on b.hn = a.hn
where b.row_id IS NOT NULL";
$q = $dbi->query($sql);
while ($a = $q->fetch_assoc()) {
    if($a['camp']!=='ตรวจสุขภาพประกันสังคม'){
        $dxofyear_out_id = $a['row_id'];
        $sqlUpdate = "UPDATE dxofyear_out SET camp = 'ตรวจสุขภาพประกันสังคม' WHERE row_id = '$dxofyear_out_id' ";
        dump($sqlUpdate);
        $dxofyear_out_update = $dbi->query($sqlUpdate);
        dump($dxofyear_out_update);
    }
}
?>
</body>
</html>