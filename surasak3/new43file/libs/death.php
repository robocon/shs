<?php 

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

//-------------------- Create file death ����� 3 --------------------//
$temp3="CREATE  TEMPORARY  TABLE report_death SELECT date,dcdate,hn,an,icd10,doctor,SUBSTRING(result,1,1) AS result From ipcard where dctype like '%dead%' and dcdate like '$thimonth%' and dcdate is not null";
$querytmp3 = mysql_query($temp3, $db2) or die("Query failed,Create temp3");

$sql3="SELECT date,dcdate,hn,an,icd10,doctor,result From report_death";
$result3= mysql_query($sql3, $db2) or die("Query failed, Select report_death (death)");
$txt = '';
while (list ($date,$dcdate,$hn,$an,$icd10,$doctor,$result) = mysql_fetch_row ($result3)) {	
	// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	// list($hospcode)=mysql_fetch_array($sqlhos);
	
	$chkdate=substr($date,0,10);	
	$sqlopd="select vn,TRIM(idcard) AS idcard from opday where thidate like '$chkdate%' and hn='$hn'";
	//echo $sqlopd."<br>";
	$resultopd=mysql_query($sqlopd, $db2);	
	list($vn, $cid)=mysql_fetch_array($resultopd);

    $dateseq=substr($date,0,10);
    $timeseq=substr($date,11,19);
    list($yy,$mm,$dd)=explode("-",$dateseq);
    $yy=$yy-543;
    $date_serv="$yy$mm$dd";

    $vn=sprintf("%03d",$vn);
    $seq=$date_serv.$vn;	  //�ӴѺ���


    $regis1=substr($dcdate,0,10);
    $regis2=substr($dcdate,11,19);
    list($yy,$mm,$dd)=explode("-",$regis1);
    $yy=$yy-543;
    list($hh,$ss,$ii)=explode(":",$regis2);
    $d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //�ѹ��͹�շ���Ѻ��ا������
    $ddeath="$yy$mm$dd";  //�ѹ�����

    $cdeath_a=$icd10;  //�����ä��������˵ء�õ��
    $cdeath=$icd10;  //���˵ء�õ��
    $pregdeath="";  //��õѧ�������С�ä�ʹ
    if( $result == '8' ){
        $pregdeath="1";
    }
    $pdeath="1";  //ʶҹ�����

    $sqldoc=mysql_query("select doctorcode from doctor where name like'%$doctor%'", $db2);
    list($doctorcode)=mysql_fetch_array($sqldoc);
    if(empty($doctorcode)){
    $provider=$date_serv.$vn."00000";
    }else{
    $provider=$date_serv.$vn.$doctorcode;
    }

    $txt .= "$hospcode|$hn|$hospcode|$an|$seq|$ddeath|$cdeath_a|$cdeath_b|$cdeath_c|$cdeath_d|$odisease|$cdeath|$pregdeath|$pdeath|$provider|$d_update|$cid\r\n";				
    // $strFileName3 = "death.txt";
    // $objFopen3 = fopen($strFileName3, 'a');
    // fwrite($objFopen3, $strText3);
                
    // if($objFopen3){
    //     /*echo "File writed.";*/
    // }else{
    //     /*echo "File can not write";*/
    // }
    // fclose($objFopen3);
}  //close while

$filePath = $dirPath.'/death.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|HOSPDEATH|AN|SEQ|DDEATH|CDEATH_A|CDEATH_B|CDEATH_C|CDEATH_D|ODISEASE|CDEATH|PREGDEATH|PDEATH|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_death.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "���ҧ��� death �������º����<br>";
//-------------------- Close file death ����� 3 --------------------//