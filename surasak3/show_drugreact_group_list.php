<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$id = sprintf("%d", $_GET['id']);
if(!empty($id) && $id>0){ 

    $q = $dbi->query("SELECT * FROM drugreact_group WHERE id = '$id' ");
    $g = $q->fetch_assoc();

    $q = $dbi->query("SELECT * FROM drugreact_group_list WHERE drugreact_group = '$id' ");

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
    <div class="container">
        <h3><?=$g['name'];?></h3>
        <div class="input-group">
            <div class="form-outline">
                <input type="search" id="form1" class="form-control" />
                <label class="form-label" for="form1">Search</label>
            </div>
            <button type="button" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
<?php 
}else{
    echo "Invalid";
}