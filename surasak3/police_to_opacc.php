<?php 
include 'bootstrap.php';

$mysqli = new mysqli($host,$username,$password,$db);
?>
<form action="police_to_opacc.php" method="post" enctype="multipart/form-data">

    <div>
        <input type="file" name="file" id="">
    </div>

    <div>
        <button type="submit">บันทึก Opacc</button>
        <input type="hidden" name="action" value="save">
    </div>

</form>
<?php

$action = input_post('action');
if ( $action == 'save' ) {
    
    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);

    if( $content !== false && $part !== false ){
    
        
        


        $hn_csv = array();
        $items = explode("\r\n", $content);
        foreach ($items as $key => $item) {
            # code...

            list($hn,$number,$name,$surname,$book,$bookNumber) = explode(',', $item);

            // $sql = "SELECT * FROM `police2`";
            // dump($hn);
            // dump($name);
            // dump($hn);
            // dump($bookNumber);
            // $mysqli->select($sql);

            if( !empty($bookNumber) ){
                // $hn_csv[] = $hn;
                // echo "<hr>";
                $sql = "UPDATE `log_opcardchk` SET `bill` = '$book/$bookNumber' WHERE `log_hn` = '$hn' ";
                $update = $mysqli->query($sql);
                dump($sql);
                dump($update);
            }
            
        }

        // dump($hn_csv);

        // $sql = "SELECT * FROM `log_opcardchk`";
        // $result = $mysqli->query($sql);

        
        // while ($rows = $result->fetch_assoc()) {
        //     # code...
        //     $hn = $rows['log_hn'];
        //     if ( !in_array($hn,$hn_csv) ) {
        //         # code...
        //         dump($hn);
        //     }
        // }

    }

}