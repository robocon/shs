<?
$date="12 ����Ҿѹ�� 2560";
list($d,$m,$y)=explode(" ",$date);
$yy=$y-543;
	if($m=="���Ҥ�"){
		$mon ="01";
	}else if($m=="����Ҿѹ��"){
		$mon ="02";
	}else if($m=="�չҤ�"){
		$mon ="03";
	}else if($m=="����¹"){
		$mon ="04";
	}else if($m=="����Ҥ�"){
		$mon ="05";
	}else if($m=="�Զع�¹"){
		$mon ="06";
	}else if($m=="�á�Ҥ�"){
		$mon ="07";
	}else if($m=="�ԧ�Ҥ�"){
		$mon ="08";
	}else if($m=="�ѹ��¹"){
		$mon ="09";
	}else if($m=="���Ҥ�"){
		$mon ="10";
	}else if($m=="��Ȩԡ�¹"){
		$mon ="11";
	}else if($m=="�ѹ�Ҥ�"){
		$mon ="12";
	}	
$newdate=$yy."-".$mon."-".$d;

		
$chkdate=date("w",strtotime($newdate));  //���ѹ��ش �����=6, �ҷԵ��=0 

if($chkdate==0){  //�ҷԵ��
$strnewdate=date("Y-m-d",strtotime("+1 day",strtotime($newdate)));
}else if($chkdate==6){  //�����
$strnewdate=date("Y-m-d",strtotime("+2 day",strtotime($newdate)));
}else if($chkdate==5){  //�ء��
$strnewdate=date("Y-m-d",strtotime("+3 day",strtotime($newdate)));
}else{
$strnewdate=date("Y-m-d",strtotime("+1 day",strtotime($newdate)));
}
echo "==>".$strnewdate;

function thaidate($x) {
	$thai_m=array("���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
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