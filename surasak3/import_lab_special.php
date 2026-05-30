<?php
//นำเข้าอัพเดท tat Special lab
include dirname(__FILE__).'/newBootstrap.php';

if($_POST['action'] == "update"){
    $file = $_FILES['file'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    
    // dump($file);

    // 1. Open the file for reading ('r')
    if (($handle = fopen($file_tmp, "r")) !== FALSE) {
        
        // 2. Loop through each line of the CSV
        while ((list($codex,$name,$tat) = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // $dtat is an array of fields in the current row
            $codex = sprintf("%s", $dbi->real_escape_string($codex));
            $tat = sprintf("%s", $dbi->real_escape_string($tat));

            $q = $dbi->query("SELECT * FROM `labcare` WHERE `codex` = '$codex' AND `tube`!='' ");
            if($q->num_rows>0){
                
                if(!empty($codex) && $codex!='-'){
                    $sql = "UPDATE `labcare` SET `tube`='special', `tat`='$tat' WHERE `codex` = '$codex'";
                    dump($sql);
                    $q = $dbi->query($sql);
                    dump($q);
                }else{
                    echo "$codex IS '-'";
                }

            }else{
                echo "$codex Not Found";
            }

            echo "<hr>";
        }
        
        // 3. Close the file handle
        fclose($handle);
    }

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
    <form action="import_lab_special.php" method="post" enctype="multipart/form-data" >
        <input type="file" name="file" id="file">
        <input type="submit" value="Submit">
        <input type="hidden" name="action" value="update">
    </form>
</body>
</html>