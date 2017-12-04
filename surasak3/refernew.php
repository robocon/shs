
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู<br></a>

<?php
    session_start();
    include("connect.inc");
$hospital2="$hospital"."$hospital1";
 $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
/*
  date date 
  hn char(12)
  xn char(12)
  name char(20)
  surname char(20)
*/
   $sql = "INSERT INTO refer (dateopd,hn,an,name,sname,clinic,referh,refertype,idcard,pttype,diag,ptnote,exrefer,refercar,office,doctor)
                VALUES(now(),'$sHn','$an','$sName','$sSurname','$clinic','$hospital2','$refertype','$sIdcard','$pttype','$diag','$ptnote','$exrefer','$erfercar','$office','$doctor');";

   $result = mysql_query($sql);

   If (!$result){
        echo "ไม่บันทึก  ให้กลับบันทึกใหม่";
                    }
   else {
        

echo "แบบบันทึกการ รับ - ส่ง Refer ผู้ป่วย โรงพยาบาลค่ายสุรศักดิ์มนตรี<br>";
echo "ชื่อ-สกุล &nbsp;&nbsp;$sName &nbsp;$sSurname&nbsp;&nbsp;HN:$sHn&nbsp;&nbsp;AN:$an <br>";
echo "วัน/เดือน/ปี  $Thaidate<br>";
echo "แพทย์&nbsp;&nbsp;$doctor<br>";
echo "การวินิจฉัยโรค&nbsp;&nbsp;$diag<br>";
echo "ข้อมูลสำคัญ&nbsp;&nbsp;$ptnote<br>";
echo "สาเหตุการ Refer &nbsp;&nbsp;$exrefer<br>";
echo "โรงพยาบาล &nbsp;&nbsp;$hospital2<br>";
echo "การเดินทาง&nbsp;&nbsp;$refercar<br>";
echo "ผู้นำส่ง&nbsp;&nbsp;$office<br>";
       
          }
include("unconnect.inc");
    session_unregister("sHn");
    session_unregister("sName");
    session_unregister("sSurname");

?>


