<?php

$db2 = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

$where = "AND ( 
    `HN` != '59-6732' 
    AND `HN` != '60-10275' 
    AND `HN` != '53-9356' 
    AND `HN` != '60-6965' 
    AND `HN` != '61-1398' 
    AND `HN` != '60-9637' 
    AND `HN` != '57-9091' 
    AND `HN` != '60-4618' 
    AND `HN` != '60-4602' 
    AND `HN` != '56-1603' 
    AND `HN` != '49-8590' 
    AND `HN` != '54-9280' 
    AND `HN` != '56-5433' 
    AND `HN` != '60-1900' 
    AND `HN` != '52-3883' 
    AND `HN` != '47-7024' 
    AND `HN` != '47-4278' 
    AND `HN` != '60-3950' 
    AND `HN` != '61-1878' 
    AND `HN` != '52-7668' 
    AND `HN` != '48-19281' 
    AND `HN` != '49-14315' 
)";

$sql_opcardchk = "select `HN` from opcardchk where part = 'ลูกจ้าง61' $where ";
$q_opcard = mysql_query($sql_opcardchk);



while ($op = mysql_fetch_assoc($q_opcard)) {
    
    $hn = $op['HN'];

    $sql_depart = "select `row_id`,`date`,`ptname`,`hn`,`depart`,`cashok` 
    from depart 
    where date like '2561-04%' 
    and hn = '$hn' 
    and cashok = 'SSOCHECKUP61' 
    and depart = 'XRAY' 
    limit 1";
    $q_depart = mysql_query($sql_depart);
    $iDep = mysql_fetch_assoc($q_depart);
    if( $iDep !== false ){

        // dump($iDep);

        $dep_id = $iDep['row_id'];
        $sql_depart_update = "UPDATE  `depart` SET  `cashok` =  'SSOCHKUP61' WHERE  `row_id` =  '$dep_id' LIMIT 1 ;";
        dump($sql_depart_update);
        $dep_res = mysql_query($sql_depart_update);
        dump($dep_res);
    }


    $sql_opacc = "select `row_id`,`date`,`hn`,`depart`,`credit` 
    from opacc 
    where date like '2561-04%' 
    and hn = '$hn' 
    and credit = 'SSOCHECKUP61' 
    and depart = 'XRAY' 
    limit 1";
    $q_opacc = mysql_query($sql_opacc);
    $iOpa = mysql_fetch_assoc($q_opacc);
    if( $iOpa !== false ){

        $opa_id = $iOpa['row_id'];
        $sql_opacc_update = "UPDATE  `opacc` SET `credit` =  'SSOCHKUP61' WHERE  `row_id` =  '$opa_id' LIMIT 1 ;";
        dump($sql_opacc_update);
        $opa_res = mysql_query($sql_opacc_update);
        dump($opa_res);
    }

}

