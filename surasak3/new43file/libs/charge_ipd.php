<?php 
// $db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
// mysql_select_db('smdb', $db2) or die( mysql_error() );

//-------------------- Create file charge_ipd ไฟล์ที่ 18 --------------------//
// $temp18="CREATE  TEMPORARY  TABLE report_admission4 
// SELECT *  
// FROM `ipcard` 
// WHERE `dcdate` LIKE '$thimonth%' 
// AND `dcdate` IS NOT NULL";
// $querytmp18 = mysql_query($temp18) or die("Query failed,Create temp18"); 

// หา code จาก ptrightdetail
$sql = "SELECT `code`,`detail` FROM `ptrightdetail`";
$result = mysql_query($sql, $db2) or die(mysql_error());
$items = array();
while( $item = mysql_fetch_assoc($result) ){
	$key = $item['detail'];
	$items[$key] = $item['code'];
}

// ptrightdetail จากใน ipcard
$sql = "SELECT b.`hn`,b.`ptrightdetail`,b.`ipcard` 
FROM `ipcard` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
WHERE a.`dcdate` LIKE '$thimonth%' 
AND a.`dcdate` IS NOT NULL 
AND b.`ptrightdetail` != '';";
$ptLists = array();
$ipcardLists = array();
$query = mysql_query($sql, $db2);
while( $item = mysql_fetch_assoc($query) ){
	$key = $item['hn'];
    $ptLists[$key] = $item['ptrightdetail'];
    $ipcardLists[$key] = $item['ipcard'];
}

// สิทธิตอนจ่ายเงิน
$sql = "SELECT `an`,`credit` 
FROM `ipmonrep` 
WHERE `dcdate` LIKE '$thimonth%' 
AND `dcdate` IS NOT NULL 
AND ( `price` > 0 AND `paid` > 0 )
AND `credit` != '' ";
$query = mysql_query($sql, $db2);
$creditLists = array();
while( $item = mysql_fetch_assoc($query) ){
	$key = $item['an'];
	$creditLists[$key] = $item['credit'];
}

$where = "AND `dcdate` LIKE '$thimonth%' ";

$test_match_day = preg_match('\d{4}\-\d{2}\-\d{2}', $thimonth, $matchs);
if( $test_match_day > 0 ){
    $where = "AND ( `date` <= '$thimonth' AND `dcdate` >= '$thimonth' )";
}

$txt = '';
$sql = "SELECT a.`date`,b.`hn`,b.`date`,b.`my_ward`,a.`an`,a.`depart`,a.`amount`,SUM(a.`price`) AS `price` ,SUM(a.`paid`) AS `paid`,a.`part` 
FROM `ipacc` AS a, 
( 
    SELECT * 
    FROM `ipcard` 
    WHERE `bedcode` <> '' 
    $where 

) AS b
WHERE a.`an` = b.`an` 
AND a.`amount` > 0 
AND a.`price` > 0 
GROUP BY a.`an`,a.`depart`,a.`part`";

$result = mysql_query($sql, $db2) or die( mysql_error() );
while (list ($date,$hn,$admdate,$myward,$an,$depart,$amount,$price,$paid,$part) = mysql_fetch_row ($result)) {
	
	$chargelist="000000";

	// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	// list($hospcode)=mysql_fetch_array($sqlhos);

	// $sqlpt = mysql_query("select ptrightdetail from opcard where hn='$hn'");
	// list($ptrightdetail) = mysql_fetch_array($sqlpt);
	
    $ptrightdetail = ( isset($ptLists[$hn]) ) ? $ptLists[$hn] : false ;
    // $cid = ( isset($ipcardLists[$hn]) ) ? $ipcardLists[$hn]['ipcard'] : '0000000000000' ;
    $instype = ( isset($items[$ptrightdetail]) ) ? $items[$ptrightdetail] : 9100 ;
    
	// $sqlptr = "Select code From  ptrightdetail where detail='$ptrightdetail'";
	// $resultptr = mysql_query($sqlptr) or die(mysql_error());
    // list($instype) = mysql_fetch_row($resultptr);	
    
    $q = mysql_query("SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn' ");
    $item = mysql_fetch_assoc($q);
    $cid = trim($item['idcard']);

    $cost="0.00";  //ราคาทุน

    // $sqlmonrep = "SELECT `credit` FROM `ipmonrep` WHERE `an` = '$an'";
    // $resultmonrep= mysql_query($sqlmonrep) or die(mysql_error());
    // list($credit) = mysql_fetch_row($resultmonrep);	
	
	$credit = ( isset($creditLists[$an]) ) ? $creditLists[$an] : 'เงินสด' ;
	
    if($credit=="เงินสด" || $credit=="อื่นๆ"){
        $price = $price;
        $payprice = $price;
    }else{
        $price = $paid;
        $payprice = $price - $paid;
    }
    $payprice = number_format($payprice,2);	
    $quantity = $amount;

//ปรับปรุง 17-08-59 BY AMP
    if($depart=="WARD"){
        if($part=="BFY" || $part=="BFN"){
            $chargeitem="01";
        }else{
            $chargeitem="12";
        }	
    }else if($depart=="PHAR"){
        if($part=="dpy" || $part=="dpn"){
            $chargeitem="02";
        }else if($part=="dsy" || $part=="dsn"){
            $chargeitem="05";
        }else if($part=="nessdy" || $part=="nessdn"){
            $chargeitem="17";
        }else if($part=="DDL"){
            $chargeitem="03";
        }else if($part=="DDY" || $part=="DDN"){
            $chargeitem="17";
        }
    }else if($depart=="PATHO"){
        $chargeitem="07";
    }else if($depart=="XRAY"){
        $chargeitem="08";
    }else if($depart=="HEMO"){
        $chargeitem="09";
    }else if($depart=="SURG"){
        $chargeitem="11";
    }else if($depart=="OTHER" || $depart=="EMER" || $depart=="EYE"){
        $chargeitem="12";
    }else if($depart=="DENTA"){
        $chargeitem="13";
    }else if($depart=="PHYSI"){
        $chargeitem="14";
    }else if($depart=="NID"){
        $chargeitem="15";
    }else if($depart=="" || empty($depart)){
        if($part=="TOOL" || $part=="TOOLY"){
            $chargeitem="10";
        }else if($part=="NCARE" || $part=="NCAREY"){
            $chargeitem="12";
        }else if($part=="LAB" || $part=="LABY"){
            $chargeitem="06";
        }else if($part=="SINV" || $part=="SINVY"){
            $chargeitem="09";
        }else if($part=="SURG" || $part=="SURGY"){
            $chargeitem="11";
        }else if($part=="MCY" || $part=="MCN"){
            $chargeitem="16";
        }else{
			$chargeitem="16";
		}
	}else{
		$chargeitem="16";
	}
	
	$regis1=substr($admdate,0,10);
	$regis2=substr($admdate,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy=$yy-543;
	list($hh,$ss,$ii)=explode(":",$regis2);
	$datetime_admit = "$yy$mm$dd$hh$ss$ii";  //วันที่และเวลาที่รับผู้ป่วย	
	
	if($myward=="หอผู้ป่วย ICU"){
		$wardstay="10100";
	}else if($myward=="หอผู้ป่วยสูติ"){
		$wardstay="10300";
	}else if($myward=="หอผู้ป่วยรวม"){
		$wardstay="10100";
	}else if($myward=="หอผู้ป่วยพิเศษ"){
		$wardstay="10200";
	}else{
		$wardstay="19900";
	}	

	$regis1=substr($date,0,10);
	$regis2=substr($date,11,19);
	list($yy,$mm,$dd)=explode("-",$regis1);
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=($yy-543).$mm.$dd.$hh.$ss.$ii;

    $inline = "$hospcode|$hn|$an|$datetime_admit|$wardstay|$chargeitem|$chargelist|$quantity|$instype|$cost|$price|$payprice|$d_update|$cid\r\n";
    // dump($inline);
    $txt .= $inline;
    // $strFileName18 = "charge_ipd.txt";
    // $objFopen18 = fopen($strFileName18, 'a');
    // fwrite($objFopen18, $strText18);
                
    // if($objFopen18){
    //     /*echo "File writed.";*/
    // }else{
    //     /*echo "File can not write";*/
    // }
    // fclose($objFopen18);
}  //close while

// exit;
$filePath = $dirPath.'/charge_ipd.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|AN|DATETIME_ADMIT|WARDSTAY|CHARGEITEM|CHARGELIST|QUANTITY|INSTYPE|COST|PRICE|PAYPRICE|D_UPDATE|CID\r\n";
$charge_ipd_txt = $header.$txt;
$qofPath = $dirPath.'/qof_charge_ipd.txt';
file_put_contents($qofPath, $charge_ipd_txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม charge_ipd เสร็จเรียบร้อย<br>";
//-------------------- Close file charge_ipd ไฟล์ที่ 18 --------------------//