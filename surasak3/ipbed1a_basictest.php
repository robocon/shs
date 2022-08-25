<?php
include("connect.php");
$Conn = mysqli_connect($ServerName, $User, $Password, $DatabaseName) or die(mysqli_error($Conn));
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}
mysqli_set_charset($Conn,"utf8");
$cbedname = $_GET['cbedname'];
if( $cbedname == 'รวม' ){
	$cbedname = 'อายุรกรรม';
}

$sql = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$cAn' ";
$result_dt_hn =mysqli_query($Conn, $sql);
list($chn, $can, $cptname , $cage , $cptright , $cbedcode , $cdoctor , $cBed1 ,$cdiagnos ) = mysqli_fetch_row($result_dt_hn);

// Default ขนาดตัวหนังสือจะ 14
// $text_size = 14;
$text_size = 16;

// ถ้าเป็นหมอเลอปรัชชื่อจะยาวเลยต้องปรับให้เหลือตัวหนังสือ13
$drCode = substr($cdoctor, 0, 5);
if( $drCode == 'MD089' ){
	// $text_size = 13;
	$text_size = 14;
}

?>
<style>
	*{
		margin: 0;
		padding: 0;
		font-family: "Angsana New","TH SarabunPSK";
		font-size: <?=$text_size;?>px;
		line-height: 12px;
	}
</style>
<?php

$exName = '';

// เช็กว่าเป็นWardพิเศษรึป่าว
$wardExTest = preg_match('/45.+/', $cbedcode);
if( $wardExTest > 0 ){
	//
	// เช็กว่าเป็นชั้น3 ถ้าไม่ใช่เป็นชั้น2
	$wardBxTest = preg_match('/45(F[1-3]|M[1-6])/', $cbedcode); // B1-B9
	$wardR3Test = preg_match('/45R3[0-9]{2}/', $cbedcode); // R301-R310
	$exName = ($wardBxTest > 0 || $wardR3Test > 0) ? 'ชั้น3' : 'ชั้น2' ;

	// เฉพาะ ward พิเศษที่ตัวหนังสือ 11
	$text_size = 13;
	
}

$type = $_REQUEST['type_sticker'];
if($type==1){

	$full_text = $cbedname.$exName."/$cBed1 อายุ:$cage<br>";
	$full_text .= "AN:$can HN:$chn<br>";
	$full_text .= "$cptname<br>";
	$full_text .= "โรค:$cdiagnos<br>";
	$full_text .= "สิทธิ:$cptright<br>";
	$full_text .= "แพทย์:$cdoctor<br>";

}else{
	$full_text = $cbedname.$exName."/".$cBed1." AN :".$can."<br>";
	$full_text .= "$cptname<br>";
	$full_text .= "โรค:$cdiagnos<br>";
	$full_text .= "แพทย์:$cdoctor<br>";

}
echo $full_text;

?>
<script>
	window.onload = function(){
		window.print();
	}
</script>