<?php
//-------------------- Create file accident ไฟล์ที่ 9 --------------------//
$temp9="CREATE  TEMPORARY  TABLE report_accident SELECT  date,hn,date_in,time_in,type_accident,sender,type_wounded,wounded_vehicle,wounded_detail,spirits,belt,helmet,accident_detail  From  trauma where hn !='' and date_in like '$thimonth%' ORDER BY date ASC";
//echo $temp9;
$querytmp9 = mysql_query($temp9) or die("Query failed,Create temp9");

$sql9="SELECT date,hn,date_in,time_in,type_accident,sender,type_wounded,wounded_vehicle,wounded_detail,spirits,belt,helmet,accident_detail  From report_accident";
$result9= mysql_query($sql9) or die("Query failed, Select report_accident (accident)");
$num=mysql_num_rows($result9);
$txt = '';
while (list ($date,$hn,$appdate,$doctor,$type_accident,$depcode,$urgency,$wounded_vehicle,$wounded_detail,$spirits,$belt,$helmet,$accident_detail) = mysql_fetch_row ($result9)) {	

	// $sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	// list($hospcode)=mysql_fetch_array($sqlhos);
	
	$chkdate=substr($appdate,0,10);	
	$sqlopd="select vn from opday where thidate like '$chkdate%' and hn='$hn'";
	//echo $sqlopd."<br>";
	$resultopd=mysql_query($sqlopd);	
	list($vn)=mysql_fetch_array($resultopd);

    $regis1=substr($date,0,10);
    $regis2=substr($date,11,19);
    list($yy,$mm,$dd)=explode("-",$regis1);
    $yy=$yy-543;
    list($hh,$ss,$ii)=explode(":",$regis2);
    $d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล
    $datetime_serv="$yy$mm$dd$hh$ss$ii";  //วันที่และเวลามารับบริการ
    $datetime_ae="$yy$mm$dd$hh$ss$ii";  //วันที่และเวลาที่เกิดอุบัติเหตุ


    list($yy1,$mm1,$dd1)=explode("-",$appdate);
    $yy1=$yy1-543;
    $date_serv="$yy1$mm1$dd1";  //วันที่มารับบริการ
    $vn=sprintf("%03d",$vn);
    $seq=$date_serv.$vn;	  //ลำดับที่

    $aeplace="99";  //สถานที่เกิดอุบัติเหตุ
    $nacrotic_drug="9";  //การใช้สารเสพติด

    if($sender=="1"){
        $typein_ae="1";
    }else if($sender=="2"){
        $typein_ae="4";
    }else if($sender=="3"){
        $typein_ae="3";
    }else if($sender=="4"){
        $typein_ae="2";
    }else if($sender=="5"){
        $typein_ae="7";	
    }else{
        $typein_ae="9";	
    }

    if($wounded_vehicle=="V01"){
        $vehicle="01";
    }else if($wounded_vehicle=="V02"){
        $vehicle="02";
    }else if($wounded_vehicle=="V12"){
        $vehicle="03";
    }else if($wounded_vehicle=="V03"){
        $vehicle="04";
    }else if($wounded_vehicle=="V04"){
        $vehicle="05";
    }else if($wounded_vehicle=="V11"){
        $vehicle="06";
    }else if($wounded_vehicle=="V07"){
        $vehicle="07";
    }else if($wounded_vehicle=="V08"){
        $vehicle="08";	
    }else if($wounded_vehicle=="V05" || $wounded_vehicle=="V06"){
        $vehicle="09";			
    }else if($wounded_vehicle=="V09"){
        $vehicle="98";
    }else if($wounded_vehicle=="V10" || $wounded_vehicle=="0"){
        $vehicle="99";				
    }else{
        $vehicle="99";	
    }

    if($wounded_vehicle=="W01"){
        $traffic="1";
    }else if($wounded_vehicle=="W02"){
        $traffic="2";
    }else if($wounded_vehicle=="W03"){
        $traffic="3";
    }else if($wounded_vehicle=="W04" || $wounded_vehicle=="0"){
        $traffic="9";				
    }else{
        $traffic="9";	
    }

    if($spirits=="1"){
        $alcohol="1";
    }else if($spirits=="0"){
        $alcohol="2";
    }else if($spirits=="2"){
        $alcohol="9";
    }else{
        $alcohol="9";
    }

    if($belt=="1"){
        $belt="1";
    }else if($belt=="0"){
        $belt="2";
    }else if($belt=="2"){
        $belt="9";
    }else{
        $belt="9";
    }		

    if($helmet=="1"){
        $helmet="1";
    }else if($helmet=="0"){
        $helmet="2";
    }else if($helmet=="2"){
        $helmet="9";
    }else{
        $helmet="9";
    }

    if($type_accident=="1"){
        $aetype="01";
    }else if($type_accident=="2"){
        if($accident_detail=="A02"){
            $aetype="02";
        }else if($accident_detail=="A03"){
            $aetype="03";
        }else if($accident_detail=="A04"){
            $aetype="04";
        }else if($accident_detail=="A05"){
            $aetype="05";
        }else if($accident_detail=="A06"){
            $aetype="06";
        }else if($accident_detail=="A03"){
            $aetype="03";
        }else if($accident_detail=="A07"){
            $aetype="07";
        }else if($accident_detail=="A08"){
            $aetype="08";
        }else if($accident_detail=="A03"){
            $aetype="03";
        }else if($accident_detail=="A09"){
            $aetype="09";
        }else if($accident_detail=="A10"){
            $aetype="10";
        }else if($accident_detail=="A11"){
            $aetype="11";
        }else if($accident_detail=="A12"){
            $aetype="12";
        }else if($accident_detail=="A13"){
            $aetype="13";
        }else if($accident_detail=="A14"){
            $aetype="14";
        }else if($accident_detail=="A15"){
            $aetype="15";
        }else if($accident_detail=="A16"){
            $aetype="16";
        }else if($accident_detail=="A17"){
            $aetype="17";		
        }else if($accident_detail=="A18"){
            $aetype="18";																																		
        }else{
            $aetype="19";
        }
    }else{
        $aetype="19";
    }

    $airway="3";
    $stopbleed="3";
    $splint="3";
    $fluid="3";

    $txt .= "$hospcode|$hn|$seq|$datetime_serv|$datetime_ae|$aetype|$aeplace|$typein_ae|$traffic|$vehicle|$alcohol|$nacrotic_drug|$belt|$helmet|$airway|$stopbleed|$splint|$fluid|$urgency|$coma_eye|$coma_speak|$coma_movement|$d_update\r\n";
    // $strFileName9 = "accident.txt";
    // $objFopen9 = fopen($strFileName9, 'a');
    // fwrite($objFopen9, $strText9);
    // if($objFopen9){
    //     /*echo "File writed.";*/
    // }else{
    //     /*echo "File can not write";*/
    // }
    // fclose($objFopen9);		
}  //close while				
$filePath = $dirPath.'/accident.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;


$header = "HOSPCODE|PID|SEQ|DATETIME_SERV|DATETIME_AE|AETYPE|AEPLACE|TYPEIN_AE|TRAFFIC|VEHICLE|ALCOHOL|NACROTIC_DRUG|BELT|HELMET|AIRWAY|STOPBLEED|SPLINT|FLUID|URGENCY|COMA_EYE|COMA_SPEAK|COMA_MOVEMENT|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_accident.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;


echo "สร้างแฟ้ม accident เสร็จเรียบร้อย<br>";
//-------------------- Close create file accident --------------------//