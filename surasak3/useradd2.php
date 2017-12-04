<?php
include("connect.inc");
     $sql = "INSERT INTO inputm(name,idname,pword,menucode,status)
                  VALUES('$name','$idname','$pword','$menucode','$status');";
      $result = mysql_query($sql);
      if (mysql_errno() == 0){
           print "<br><br><br>";
           print "=ชื่อ-นามสกุล      :$name<br>";
           print "รหัสผู้ใช้   :$idname<br>";
           print "รหัสผ่าน :$pword<br>";
           print "แผนก     :$menucode<br>";

           print "บันทึกข้อมูลเรียบร้อย";
			}
      else { 
           print "<br><br><br>รหัส  :$idname  ซ้ำของเดิม โปรดแก้ไข<br>";
              }
include("unconnect.inc");
?>


