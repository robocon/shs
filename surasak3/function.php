<?

function displaydate($x) {
	$date_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

	$date_array=explode("-",$x);
	$y=$date_array[0]+543;
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$date_m[$m];

	$displaydate="$d $m $y";
	return $displaydate;
} 


function displaydate_th($x) {
	$date_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$date_m[$m];

	$displaydate="$d $m $y";
	return $displaydate;
} 


function date_th($date)
{
    if ($date == '0000-00-00')
        return '-';

    $date_array = explode('-', $date);
    $th_date = $date_array[2] .
        '/' . $date_array[1] . '/' .
        ($date_array[0] + 543);

    return $th_date;
}

function date_en($date)
{
    $date_array = explode('/', $date);
    $en_date = ($date_array[2] - 543) . '-' .
        $date_array[1] . '-' . $date_array[0];
    return $en_date;
}
?>