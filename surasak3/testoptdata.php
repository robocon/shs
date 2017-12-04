<?php

include 'bootstrap.php';

$ban_lists = array('80','81','82','83','84','85','86','87','88','89','8A','8B','8C','8D','8E','8F',
'90','91','92','93','94','95','96','97','9','99','9A','9B','9C','9D','9E','9F',
'A0', 'FE');

$db = Mysql::load();
$sql = "SELECT * FROM `optdata`";
$db->select($sql);
$items = $db->get_items();
foreach ($items as $key => $item) {

    // if( $item['hn'] === '50-9811' ){

        // echo "<pre>";
        // var_dump($item['hn']);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump(str_split($item['name']));
        // echo "</pre>";

        $chars = str_split($item['name']);
        $test_fe = false;
        foreach( $chars as $key => $i ){

            // echo "<pre>";
            // var_dump($i.' : '.bin2hex($i));
            // echo "</pre>";

            $hextxt = strtoupper(bin2hex($i));

            if( in_array($hextxt, $ban_lists) ){
                $chars[$key] = ' ';
                $test_fe = true;
            }

            
        }

        if( $test_fe === true ) {
            # code...
            // echo "<pre>";
            // var_dump(implode($chars));
            // echo "</pre>";

            $new_name = implode($chars);
            $id = $item['row_id'];

            $sql = "UPDATE  `optdata` SET  
            `name` =  '$new_name' 
            WHERE  `row_id` =  '$id' LIMIT 1 ;";
            $db->update($sql);
        }

    // }
}

