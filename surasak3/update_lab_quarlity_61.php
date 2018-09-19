<?php 
// include 'bootstrap.php';

$db2 = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

?>

<form action="update_lab_quarlity_61.php" method="POST" enctype="multipart/form-data">

    <div>
        <input type="file" name="fix_egfr" id="">
    </div>
    <div>
        <button type="submit">upload</button>
        <input type="hidden" name="action" value="update_lab">
    </div>

</form>

<?php

$action = $_POST['action'];
if ( $action === 'update_lab' ) {
    
    $file = $_FILES['fix_egfr'];
    
    if($file['error'] > 0){
        echo "Something is missing";
        exit;
    }

    $content = file_get_contents($file['tmp_name']);
    $items = explode("\r\n", $content);
    
    foreach ($items as $key => $item) {

        if( empty($item) ){
            continue;
        }
        
        list($hn, $age, $new_egfr) = explode(',', $item);

        $sql_resulthead = "SELECT MAX(`autonumber`) AS `autonumber` 
        FROM `resulthead` 
        WHERE `hn` = '$hn' 
        AND `clinicalinfo` = 'µÃÇ¨ÊØ¢ÀÒ¾»ÃĞ¨Ó»Õ61' 
        AND `profilecode` = 'CREAG' ";

        $q = mysql_query($sql_resulthead, $db2) or die( mysql_error() );
        $resHead = mysql_fetch_assoc($q);

        $head_autonumber = $resHead['autonumber'];
        $age = (int) $age;
        $avg = '';

        if( $age >= 1 && $age <= 29 ){
            $avg = 'Average = 116';
        } else if ( $age >= 1 && $age <= 39 ){
            $avg = 'Average = 107';
        } else if ( $age >= 30 && $age <= 49 ){
            $avg = 'Average = 99';
        } else if ( $age >= 50 && $age <= 59 ){
            $avg = 'Average = 93';
        } else if ( $age >= 60 && $age <= 69 ){
            $avg = 'Average = 85';
        }

        mysql_free_result($q);

        if( !empty($head_autonumber) ){

            $sql_detail = "UPDATE `resultdetail` SET 
            `result` = '$new_egfr', 
            `normalrange` = '$avg' 
            WHERE `autonumber` = '$head_autonumber' 
            AND `labcode` = 'GFR' ";
            dump($sql_detail);

            mysql_query($sql_detail, $db2) or die( mysql_error() );

        }

    }
    
    exit;

}
?>