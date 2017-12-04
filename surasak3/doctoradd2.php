<?php
include("connect.inc");
$field='doctor';
$sql = "Select runno,prefix From runno where title = '".$field."' limit 1";
	list($kew,$prefix) = Mysql_fetch_row(Mysql_Query($sql));

$kew=sprintf('%03d',$kew);
$name1="$prefix$kew $name";
print"$name1";

     $sql = "INSERT INTO doctor(name,doctorcode,status)
                 VALUES('$name1','$doctorcode','$status');";
      $result = mysql_query($sql);
      if (mysql_errno() == 0){
           print "<br><br><br>";
           print "ชื่อ-นามสกุล      :$name1<br>";
           print "รหัส ว.แพทย์ :$doctorcode<br>";
            print "รหัส :$kew<br>";
           
           print "บันทึกข้อมูลเรียบร้อย";

$kew++;
$sql = "update runno set runno=".$kew." where title = '".$field."' limit 1";
	$result = Mysql_Query($sql);

			}
      else { 
           print "<br><br><br>รายการแพทย์ $name ซ้ำของเดิม โปรดแก้ไข<br>";
              }
include("unconnect.inc");
?>


