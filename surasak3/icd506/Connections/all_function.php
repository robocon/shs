<?php

function displaydate($x) {
	$date_m=array("�.�.","�.�.","��.�.","��.�.","�.�.","��.�.","�.�.","�.�.","�.�.","�.�.","�.�.","�.�.");

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
     $day = date("j") ;    // ����ѹ(1-31)
	 $week=date("w");   // ����ѹ��ѻ����(0-6)
	 $month=date("n")-1;  // �����͹(1-12)
     $year =date("Y") + 543;   //  ��� �.�.2007)
	 $aweek=array("�ҷԵ��","�ѹ���", "�ѧ���", "�ظ", "����ʺ��","�ء��","�����");
     $amonth =array("���Ҥ�","����Ҿѹ��","�չҤ�","����¹",

                           	"����Ҥ�" , "�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�",

                            "�ѹ��¹" , "���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");

   	 return " �ѹ $aweek[$week] ��� $day  $amonth[$month] �.� $year ";

  }
  
  function dateFormatThai($datetime){
	$split = explode(" ",$datetime);
	$splitDate = explode("-",$split[0]);
	//$splitTime = explode(":",$split[1]);
	$year = $splitDate[0] + 543;
	$month = $splitDate[1];
	$date = (int)$splitDate[2];
	switch($month){
		case "1": $printmonth = "���Ҥ�"; break;
		case "2": $printmonth = "����Ҿѹ��"; break;
		case "3": $printmonth = "�չҤ�"; break;
		case "4": $printmonth = "����¹"; break;
		case "5": $printmonth = "����Ҥ�"; break;
		case "6": $printmonth = "�Զع�¹"; break;
		case "7": $printmonth = "�á�Ҥ�"; break;
		case "8": $printmonth = "�ԧ�Ҥ�"; break;
		case "9": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}
	return $printmonth." ".$year;
}
  


?> 
<?PHP 
function convert($number){ 
$txtnum1 = 
array('�ٹ��','˹��','�ͧ','���','���','���','ˡ','��','Ỵ','���','�Ժ'); 
$txtnum2 = 
array('','�Ժ','����','�ѹ','����','�ʹ','��ҹ'); 
$number = str_replace(",","",$number); 
$number = str_replace(" ","",$number); 
$number = str_replace("�ҷ","",$number); 
$number = explode(".",$number); 
if(sizeof($number)>2){ 
return '�ȹ������µ�ǹШ��'; 
exit; 
} 
$strlen = strlen($number[0]); 
$convert = ''; 
for($i=0;$i<$strlen;$i++){ 
$n = substr($number[0], $i,1); 
if($n!=0){ 
if($i==($strlen-1) AND $n==1){ $convert .= 
'���'; } 
elseif($i==($strlen-2) AND $n==2){ 
$convert .= '���'; } 
elseif($i==($strlen-2) AND $n==1){ 
$convert .= ''; } 
else{ $convert .= $txtnum1[$n]; } 
$convert .= $txtnum2[$strlen-$i-1]; 
} 
} 
$convert .= '�ҷ'; 
if($number[1]=='0' OR $number[1]=='00' OR 
$number[1]==''){ 
$convert .= '��ǹ'; 
}else{ 
$strlen = strlen($number[1]); 
for($i=0;$i<$strlen;$i++){ 
$n = substr($number[1], $i,1); 
if($n!=0){ 
if($i==($strlen-1) AND $n==1){$convert 
.= '���';} 
elseif($i==($strlen-2) AND 
$n==2){$convert .= '���';} 
elseif($i==($strlen-2) AND 
$n==1){$convert .= '';} 
else{ $convert .= $txtnum1[$n];} 
$convert .= $txtnum2[$strlen-$i-1]; 
} 
} 
$convert .= 'ʵҧ��'; 
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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}
?>