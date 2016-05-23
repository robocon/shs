<?php
//-------------------- Create file card ไฟล์ที่ 4 --------------------//
$temp4="CREATE  TEMPORARY  TABLE report_card SELECT regisdate, hn, ptright,ptrightdetail,hospcode FROM opcard WHERE regisdate like '$yrmonth%' ORDER BY regisdate ASC";
//echo $temp4;
$querytmp4 = mysql_query($temp4) or die("Query failed,Create temp4");

$sql4="SELECT regisdate,hn,ptright,ptrightdetail,hospcode From report_card";
$result4= mysql_query($sql4) or die("Query failed, Select report_card (card)");
$num=mysql_num_rows($result4);
$txt = '';
while (list ($regisdate,$hn,$ptright,$ptrightdetail,$main) = mysql_fetch_row ($result4)) {	

	// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	// list($hospcode)=mysql_fetch_array($sqlhos);

    $regis1=substr($regisdate,0,10);
    $regis2=substr($regisdate,11,19);
    list($yy,$mm,$dd)=explode("-",$regis1);
    list($hh,$ss,$ii)=explode(":",$regis2);
    $d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

        
    /*$newptright=substr($ptright,0,3);
    if($newptright=="R01" || $newptright=="R05"){  //เงินสด
        $instype_new="9100";  //ประเภทสิทธิการรักษา
    }else if($newptright=="R02" || $newptright=="R03"  || $newptright=="R04"){  //โครงการเบิกจ่ายตรง
        $instype_new="1100";  //ประเภทสิทธิการรักษา
    }else if($newptright=="R06"){  //พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ
        $instype_new="6100";  //ประเภทสิทธิการรักษา
    }else if($newptright=="R07"){  //ประกันสังคม
        $instype_new="4200";  //ประเภทสิทธิการรักษา
    }else if($newptright=="R09"){  //ประกันสุขภาพถ้วนหน้า
        $instype_new="0100";  //ประเภทสิทธิการรักษา
    }*/

    $sqlptr = "Select code From  ptrightdetail where detail='$ptrightdetail'";
    $resultptr = mysql_query($sqlptr) or die(mysql_error());
    list($instype_new) = mysql_fetch_row($resultptr);
        
    $inside="";  //เลขที่บัตรตามสิทธิ
    $startdate="";  //วันเดือนปีที่ออกบัตร
    $expiredate="";  //วันเดือนปีที่หมดอายุ
    $main=substr($main,0,5);  //สถานบริการหลัก
    $sub=substr($main,0,5);  //สถานบริการรอง
    $txt .= "$hospcode|$hn|$instype_old|$instype_new|$inside|$startdate|$expiredate|$main|$sub|$d_update\r\n";	
    // $strFileName4 = "card.txt";
    // $objFopen4 = fopen($strFileName4, 'a');
    // fwrite($objFopen4, $strText4);
                
    // if($objFopen4){
    //     //echo "File writed.";
    // }else{
    //     //echo "File can not write";
    // }
    // fclose($objFopen4);
}  //close while

$filePath = $dirPath.'/card.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|INSTYPE_OLD|INSTYPE_NEW|INSID|STARTDATE|EXPIREDATE|MAIN|SUB|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_card.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม card เสร็จเรียบร้อย<br>";

//-------------------- Close file card ไฟล์ที่ 4 --------------------//