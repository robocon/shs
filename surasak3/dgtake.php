<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdhn=date("d-m-").(date("Y")+543).$sHn;
    include("connect.inc");

/*จับเวลาตั้งแต่พิมพ์ใบสั่งยา และ update data in opday
echo "$sDate$sHn<br>";

    $d=substr($sDate,8,2);
    $m=substr($sDate,5,2);
    $yr=substr($sDate,0,4);  
    $thdatehn=$d.'-'.$m.'-'.$yr.$sHn;
	echo "thdatehn=$thdatehn<br>";

    $query = "SELECT thidate FROM opday WHERE  thdatehn = '$thdatehn' ";
    $result = mysql_query($query)
        or die("Query failed opday");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $regtime=$row->thidate;

//  $date1=$cDate;  //admit date
  $date1=(substr($regtime,0,4)-543).substr($regtime,4);
  echo "date1= $date1<br>";
  $date2=date("Y-m-d H:i:s");  //discharge date 
  echo "date2 เวลาจ่ายยา $date2<br>";
  //$date1=("2003-08-30 08:30:20");//admit
  //$date2=("2003-09-10 08:30:20");//discharge
   $s = strtotime($date2)-strtotime($date1);
   echo "second $s<br>";  //seconds
   $d = intval($s/86400);   //day
   echo "days= $d<br>";
   $s -= $d*86400;
   $h  = intval($s/3600);    //hour
   echo "hours= $h<br>";

        $query ="UPDATE opday SET waittime = '$s'
                       WHERE thdatehn= '$thdatehn' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");
*/

//update phardep
        $query ="UPDATE phardep SET dgtake = '$Thidate'
                       WHERE row_id = '$nRow_id' ";
        $result = mysql_query($query)
                       or die("Query failed,update phardep");

      print "เวลาจ่ายยา $Thaidate<br>";
      print "ชื่อ $sPtname  HN:$sHn<br>";
?>