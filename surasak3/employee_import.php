<?php
include dirname(__FILE__).'/bootstrap.php';
// setlocale( LC_ALL, 'th_TH' );

include dirname(__FILE__).'/class_file/class_opcard.php';

if($_POST['action']==='save'){
    $file = $_FILES['employee'];

    $handle = fopen($file['tmp_name'], "r");
    $items = array();
    $newItem = array();

    $opcard = new Opcard();

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        
        $lab = array();
        $i = 0;
        foreach($data AS $d){
            $d = trim($d);
            if($i>=2 && !empty($d)){
                $lab[] = $d;
            }
            $i++;
        }

        $labItem = implode('|', $lab);
        
        $user = $opcard->getByHn($data['0']);

        $hn = $data['0'];
        $ptname = $user['ptname'];
        $depart = $data['1'];
        $lab = $labItem;

        $sql = "INSERT INTO `employee` 
        (`id`, `hn`, `full_name`, `department`, `lab`, `status`, `date_register`) 
        VALUES 
        (NULL, '$hn', '$ptname', '$depart', '$lab', NULL, NULL);";
        $q = $dbi->query($sql);
        if($q===false){
            dump($dbi->error);
        }else{
            dump($q);
        }
        
    }
    fclose($handle);

    exit;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="employee_import.php" method="post" enctype="multipart/form-data">
        <div>
            <input type="file" name="employee" id="employee">
        </div>
        <div>
            <input type="submit" value="บันทึก">
            <input type="hidden" name="action" value="save">
        </div>
    </form>
    <?php
    
    ?>
</body>
</html>