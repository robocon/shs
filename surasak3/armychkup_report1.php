<?
$date="12 กุมภาพันธ์ 2560";
list($d,$m,$y)=explode(" ",$date);
$yy=$y-543;
	if($m=="มกราคม"){
		$mon ="01";
	}else if($m=="กุมภาพันธ์"){
		$mon ="02";
	}else if($m=="มีนาคม"){
		$mon ="03";
	}else if($m=="เมษายน"){
		$mon ="04";
	}else if($m=="พฤษภาคม"){
		$mon ="05";
	}else if($m=="มิถุนายน"){
		$mon ="06";
	}else if($m=="กรกฎาคม"){
		$mon ="07";
	}else if($m=="สิงหาคม"){
		$mon ="08";
	}else if($m=="กันยายน"){
		$mon ="09";
	}else if($m=="ตุลาคม"){
		$mon ="10";
	}else if($m=="พฤศจิกายน"){
		$mon ="11";
	}else if($m=="ธันวาคม"){
		$mon ="12";
	}	
$newdate=$yy."-".$mon."-".$d;

		
$chkdate=date("w",strtotime($newdate));  //หาวันหยุด เสาร์=6, อาทิตย์=0 

if($chkdate==0){  //อาทิตย์
$strnewdate=date("Y-m-d",strtotime("+1 day",strtotime($newdate)));
}else if($chkdate==6){  //เสาร์
$strnewdate=date("Y-m-d",strtotime("+2 day",strtotime($newdate)));
}else if($chkdate==5){  //ศุกร์
$strnewdate=date("Y-m-d",strtotime("+3 day",strtotime($newdate)));
}else{
$strnewdate=date("Y-m-d",strtotime("+1 day",strtotime($newdate)));
}
echo "==>".$strnewdate;

function thaidate($x) {
	$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="$d $m $y";
	return $displaydate;
} // end function displaydate

echo thaidate($strnewdate);
							
?>