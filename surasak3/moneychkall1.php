<?php
    
session_start();
/*
if($_SESSION["sIdname"] != "bbm"){
	echo "อยู่ระหว่างปรับปรุง";
	exit();
}
*/
$appd=$appdate.' '.$appmo.' '.$thiyr;
$appd1=$thiyr.'-'.$appmo.'-'.$appdate;
    print "<font face='Angsana New'><b>รายการที่ถูกบันทึกผู้ป่วยนอก</b><br>";
  
  print "<b>วันที่</b> $appd ";
   
 print ".........<input type=button onclick='history.back()' value=' << กลับไป '>";
?>


<?php
    include("connect.inc");
//    $query="CREATE TEMPORARY TABLE opacc1 SELECT * FROM opacc WHERE date like '$appd1%' ";
	
  //  $result = mysql_query($query) or die("Query failed,app");


print "จำนวนรายการที่บันทึก/กดดู = รายชื่อผู้ป่วย<a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
$query="SELECT  credit,COUNT(*) AS duplicate FROM opacc WHERE date like '$appd1%'   GROUP BY credit HAVING duplicate > 0 ORDER BY credit";
$result = mysql_query($query);
$n=0;

while (list ($credit,$duplicate) = mysql_fetch_row ($result)) {

  if($credit=="ตรวจสุขภาพตำรวจ")
  {
    continue;
  }

  $n++;
  $num= $duplicate+$num;
  
  $getvalue=urlencode("?doctor1=$credit&yr=$thiyr&m=$appmo&d=$appdate");
  print (" <tr>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chkmonycredit1.php?doctor1=$credit&yr=$thiyr&m=$appmo&d=$appdate\">$credit&nbsp;&nbsp;</a></td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;รายการ</td>\n".
  " </tr>\n<br>");
}

/**
 * @todo 
 * 1.) กำหนด $appd1 ให้ตรงกับวันที่ต้องการออกรายงาน
 * 2.) กำหนด $part ให้ตรงกับ code ในตาราง chk_company_list 
 */
if( $appd1 == '2568-05-26' ){

  $log_datechk = ($thiyr-543).'-'.$appmo.'-'.$appdate;;
  $part = 'ศูนย์ฝึกอบรมตำรวจภูธร ภาค 5 68';

  $sql = "SELECT `log_datechk`,`type`,COUNT(`log_id`) AS `log_count`
  FROM `log_opcardchk` 
  WHERE log_datechk LIKE '$log_datechk%' AND `log_part` = '$part' 
  GROUP BY `type`;";

  $q = mysql_query($sql);
  if(mysql_num_rows($q) > 0){ 

    $partEncode = urlencode($part);

    while($a = mysql_fetch_assoc($q)){
      $typeEncode = urlencode($a['type']);
      $count = $a['log_count'];

      echo '<a target="_BLANK" href="chk_credit_police63.php?repdate='.$appd.'&part='.$partEncode.'&type='.$typeEncode.'">ตรวจสุขภาพตำรวจ - '.$a['type'].'</a> จำนวน = '.$count.' รายการ<br>';

    }
  }
}


include("unconnect.inc");
?>




