<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$id = sprintf("%d", $_GET['id']);
if(!empty($id) && $id>0){ 

    $q = $dbi->query("SELECT * FROM drugreact_group WHERE id = '$id' ");
    $g = $q->fetch_assoc();

    $sqlDrugreactGroupList = "SELECT a.drugcode,b.tradname,b.genname,a.officer FROM ( 
        SELECT * FROM drugreact_group_list WHERE drugreact_group = '$id' 
    ) AS a 
    LEFT JOIN druglst AS b ON a.drugcode = b.drugcode";
    $q = $dbi->query($sqlDrugreactGroupList);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$g['name'];?></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="">
        <h3>ยา<?=$g['name'];?></h3>
        <!-- <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
            <button class="btn btn-primary" type="button" id="button-addon2">ค้นหา</button>
        </div> -->
        <table class="table table-striped table-hover">
            <?php 
            while ($a = $q->fetch_assoc()) {
                ?>
                <tr>
                    <td><small><?=$a['drugcode'];?></small></td>
                    <td><small><?=$a['tradname'];?></small></td>
                    <td><small><?=$a['genname'];?></small></td>
                    <td><small><?=$a['officer'];?></small></td>
                </tr>
                <?php
            }
            ?>
            
        </table>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
<?php 
}else{
    echo "Invalid";
}