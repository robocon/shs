<?php

function displaydate($x) {
	$date_m=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");

	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$date_m[$m];

	$displaydate="$d $m $y";
	return $displaydate;
} 

  function ThaiDate()

    { 
	 //$date_defualf_timezone_set("Asia/bangkok");
     $day = date("j") ;    // ค่าวัน(1-31)
	 $week=date("w");   // ค่าวันในสัปดาห์(0-6)
	 $month=date("n")-1;  // ค่าเดือน(1-12)
     $year =date("Y") + 543;   //  ค่า ค.ศ.2007)
	 $aweek=array("อาทิตย์","จันทร์", "อังคาร", "พุธ", "พฤหัสบดี","ศุกร์","เสาร์");
     $amonth =array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน",

                           	"พฤษภาคม" , "มิถุนายน","กรกฏาคม","สิงหาคม",

                            "กันยายน" , "ตุลาคม","พฤศจิกายน","ธันวาคม");

   	 return " วัน $aweek[$week] ที่ $day  $amonth[$month] พ.ศ $year ";

  }
  
  function dateFormatThai($datetime){
	$split = explode(" ",$datetime);
	$splitDate = explode("-",$split[0]);
	//$splitTime = explode(":",$split[1]);
	$year = $splitDate[0] + 543;
	$month = $splitDate[1];
	$date = (int)$splitDate[2];
	switch($month){
		case "1": $printmonth = "มกราคม"; break;
		case "2": $printmonth = "กุมภาพันธ์"; break;
		case "3": $printmonth = "มีนาคม"; break;
		case "4": $printmonth = "เมษายน"; break;
		case "5": $printmonth = "พฤษภาคม"; break;
		case "6": $printmonth = "มิถุนายน"; break;
		case "7": $printmonth = "กรกฏาคม"; break;
		case "8": $printmonth = "สิงหาคม"; break;
		case "9": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}
	return $printmonth." ".$year;
}
  


?> 
<?PHP 
function convert($number){ 
$txtnum1 = 
array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
$txtnum2 = 
array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
$number = str_replace(",","",$number); 
$number = str_replace(" ","",$number); 
$number = str_replace("บาท","",$number); 
$number = explode(".",$number); 
if(sizeof($number)>2){ 
return 'ทศนิยมหลายตัวนะจ๊ะ'; 
exit; 
} 
$strlen = strlen($number[0]); 
$convert = ''; 
for($i=0;$i<$strlen;$i++){ 
$n = substr($number[0], $i,1); 
if($n!=0){ 
if($i==($strlen-1) AND $n==1){ $convert .= 
'เอ็ด'; } 
elseif($i==($strlen-2) AND $n==2){ 
$convert .= 'ยี่'; } 
elseif($i==($strlen-2) AND $n==1){ 
$convert .= ''; } 
else{ $convert .= $txtnum1[$n]; } 
$convert .= $txtnum2[$strlen-$i-1]; 
} 
} 
$convert .= 'บาท'; 
if($number[1]=='0' OR $number[1]=='00' OR 
$number[1]==''){ 
$convert .= 'ถ้วน'; 
}else{ 
$strlen = strlen($number[1]); 
for($i=0;$i<$strlen;$i++){ 
$n = substr($number[1], $i,1); 
if($n!=0){ 
if($i==($strlen-1) AND $n==1){$convert 
.= 'เอ็ด';} 
elseif($i==($strlen-2) AND 
$n==2){$convert .= 'ยี่';} 
elseif($i==($strlen-2) AND 
$n==1){$convert .= '';} 
else{ $convert .= $txtnum1[$n];} 
$convert .= $txtnum2[$strlen-$i-1]; 
} 
} 
$convert .= 'สตางค์'; 
} 
return $convert; 
} 

//$x = '543219'; 
//echo $x.' => '.convert($x); 
function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}
?>