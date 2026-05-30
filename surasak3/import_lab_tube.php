<?php
//นำเข้าอัพเดท tubelab IN-OUT
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
        while ((list($code,$detail,$note_code,$tube) = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // $data is an array of fields in the current row
            $code = sprintf("%s", $dbi->real_escape_string($code));
            $tube = sprintf("%s", $dbi->real_escape_string($tube));

            $q = $dbi->query("SELECT * FROM `labcare` WHERE `code` = '$code' ");
            if($q->num_rows>0){
                
                if(!empty($tube)){
                    $sql = "UPDATE `labcare` SET `tube` = '$tube' WHERE `code` = '$code'";
                    dump($sql);
                    $q = $dbi->query($sql);
                    dump($code);
                    dump($detail);
                    dump($tube);
                    dump($q);
                }

                if(!empty($note_code)){
                    $sql = "UPDATE `labcare` SET `note_code` = '$note_code' WHERE `code` = '$code'";
                    $q = $dbi->query($sql);

                    dump($note_code);
                    dump($q);
                }


            }else{
                echo "$code Not Found";
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
    <form action="import_lab_tube.php" method="post" enctype="multipart/form-data" >
        <input type="file" name="file" id="file">
        <input type="submit" value="Submit">
        <input type="hidden" name="action" value="update">
    </form>
</body>
</html>