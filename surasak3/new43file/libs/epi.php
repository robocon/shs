<?php
//
//-------------------- Create file epi ไฟล์ที่ 39 --------------------//
//
$sql221 = "SELECT date,hn,drugcode,SUBSTRING(`date`, 1, 10) AS `date2`
FROM drugrx 
WHERE date LIKE '$thimonth%' 
and drugcode like '0%' 
and amount='1' 
GROUP BY `date2`, `hn`";
$result221 = mysql_query($sql221) or die("Query Create file epi Error");
$txt = '';
while (list ($thidate,$hn,$drugcode) = mysql_fetch_row ($result221)) {	
    
    $chkdate = substr($thidate,0,10);	
    $sqlopd221 = "select vn,doctor,idcard 
    from opday 
    where thidate like '$chkdate%' 
    and hn='$hn'";
    $resultopd221 = mysql_query($sqlopd221);	
    list($vn,$doctor,$cid) = mysql_fetch_array($resultopd221);	
    $newdoctor = substr($doctor,7,10);

    $vaccinetype = '815';

    $regis1 = substr($thidate,0,10);
    $regis2 = substr($thidate,11,19);
    list($yy,$mm,$dd) = explode("-",$regis1);
    list($hh,$ss,$ii) = explode(":",$regis2);
    $yy = $yy-543;
    $d_update = $yy.$mm.$dd.$hh.$ss.$ii;

    $date_serv = "$yy$mm$dd";
    $vn = sprintf("%03d",$vn);
    $seq = $date_serv.$vn;	  //ลำดับที่	

    $sqldoc22 = mysql_query("select doctorcode from doctor where name like'%$newdoctor%'");
    list($doctorcode) = mysql_fetch_array($sqldoc22);
    if(empty($doctorcode)){
        $sqldoc22 = mysql_query("select codedoctor from inputm where name like'%$doctor%'");
        list($doctorcode) = mysql_fetch_array($sqldoc22);
        if(empty($doctorcode)){
            $provider = $date_serv.$vn."00000";
        }else{
            $provider = $date_serv.$vn.$doctorcode;
        }
    }else{
        $provider = $date_serv.$vn.$doctorcode;
    }	

    $inline = "$hospcode|$hn|$seq|$date_serv|$vaccinetype|$hospcode|$provider|$d_update|$cid\r\n";	
    // print($inline);
    $txt .= $inline;
}  //close while
$filePath = $dirPath.'/epi.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|SEQ|DATE_SERV|VACCINETYPE|VACCINEPLACE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_epi.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม epi เสร็จเรียบร้อย<br>";