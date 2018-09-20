<?php 

include("connect.inc"); 

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

?>

<form action="lpru_money_fix.php" method="post">

    <div>
        <button type="submit">บันทึก</button>
        <input type="hidden" name="action" value="save">
    </div>

</form>

<?php

$action = $_POST['action'];

if( $action == 'save' ){

    $sql = "SELECT * 
    FROM `opcardchk` 
    WHERE `part` = 'ราชภัฎ61' 
    ORDER BY `row` ASC";
    $q_pretest = mysql_query($sql) or die( mysql_error() );
    
    while ( $user = mysql_fetch_assoc($q_pretest) ) {

        $hn = $user['HN'];
        $sql_depart = "SELECT * 
        FROM `depart` 
        WHERE `date` LIKE '2561-09-20%' 
        AND `hn` = '$hn' 
        AND depart = 'PATHO' ";

        $q_depart = mysql_query($sql_depart);
        while ($qItem = mysql_fetch_assoc($q_depart)) {
            // dump($qItem);

            $depart_id = $qItem['row_id'];

            
            $dep_delete = mysql_query("DELETE FROM `depart` WHERE `row_id` = '$depart_id' LIMIT 1");
            dump($dep_delete);

            $pat_delete = mysql_query("DELETE FROM `patdata` WHERE `idno` = '$depart_id'");
            dump($pat_delete);

        }

        echo "<hr>";

    }


}






