<?php

if(isset($_GET['y'])){
    $y = $_GET['y'];
} else {
    $y = date("Y");
}
if(isset($_GET['m'])){
    $m = $_GET['m'];
} else {
    $m = date("m");
}

// ฟังก์ชันการเติม 0 ไปข้างหน้า กรณีเป็นวันที่เลขตัวเดียว เช่น 1 , 2 ,3 , 4 , ...
function fillzero($tmp){
     if (strlen($tmp) == 1)
         $tmp = "0".$tmp;
     return $tmp;
}

// ฟังก์ชันการใส่สีให้กับวันที่ปัจจุบัน
function colortoday($now_date,$now_month,$now_year,$d,$m,$y){
    if (($now_date == $d) & ($now_month == $m) & ($now_year == $y))
         return "bgcolor=#FFCC99";
    else
         return "bgcolor=#FFFFFF";
}

function calendar($year, $month, $day_offset = 0){ 

   $separate = "/"; // ใส่รูปแบบ ตัวคั่น ระหว่าง วัน เดือน ปี ค.ศ.
   $days = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
   $months = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

   $day_offset = $day_offset % 7;
   $start_day = gmmktime(0,0,0,$month,1,$year); 
   $start_day_number = date("w",$start_day);
   $days_in_month = date("t",$start_day);

   $now_date = date("d");
   $now_month = date("m");
   $now_year = date("Y");
    
    $previous_month = ($month-1);
    $previous_year = $year;
    if($previous_month == 0){
      $previous_month = '12';
      $previous_year = ($year-1);
    } 
    
    $next_month = ($month+1);
    $next_year = $year;
    if($next_month == '13'){
      $next_month = '1';
      $next_year = ($year+1);
    } 
    
   $final_html .= "<table border=1 bordercolor=#000000 width=80%><tr height=40><td width=20%><a href=\"calendar1.php?y=".$previous_year."&amp;m=".$previous_month."\">&lt;&lt; เดือนก่อนหน้า</a></td><td width=60% align=center>".$months[$month-1]." $year</td><td width=20% align=right><a href=\"calendar1.php?y=".$next_year."&amp;m=".$next_month."\">เดือนถัดไป &gt;&gt;</a></td></tr>\n";
    $final_html .= "<tr><td colspan=3>\n<table width=100% border=0><tr>";
    for($x=0;$x<=6;$x++){
       $final_html .= "<td width=14.29% align=center>".$days[($x+$day_offset)%7]."</td>";
    }
    $final_html .= "</tr></table>\n</td></tr>\n";
    
    $final_html .= "<tr><td colspan=3>\n<table width=100% border=0>\n<tr>"; 
    
    
    $blank_days = $start_day_number - $day_offset;
    if($blank_days<0){$blank_days = 7-abs($blank_days);}
   for($x=0;$x<$blank_days;$x++){
       $final_html .= "<td width=14.29% align=center>&nbsp;</td>";
    }
    for($x=1;$x<=$days_in_month;$x++){
       if(($x+$blank_days-1)%7==0){
           $final_html .= "</tr>\n<tr>";
        }

        $now_date_str = fillzero($x).$separate.fillzero($month).$separate.$year;

        $today_color = colortoday($now_date,$now_month,$now_year,$x,$month,$year);
        $final_html .= "<td width=14.29% align=center $today_color><a href=\"javascript:alert('$now_date_str');\">$x</a></td>";

    }
    while((($days_in_month+$blank_days)%7)!=0){
        $final_html .= "<td width=14.29% align=center>&nbsp;</td>";
        $days_in_month++;
    }
    $final_html .= "</tr>\n</table>\n</td></tr>\n</table>";
    return($final_html);
} 

?>

<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=tis-620">
<title>:: Calendar ::</title>

</head>
<body>

<center>


<?
    echo calendar($y,$m); 
?>

<br><br>
</center>

</body>
</html>