<?php 
$date = date('Y-m-d H:i:s');
if( $date >= "2019-03-29 09:00:00" && $date <= "2019-03-29 11:00:00" ){
    ?>
    <h1>START</h1>
    <?php
}else{
    ?>
    <h1>END</h1>
    <?php
}