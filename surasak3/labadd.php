<?php
include("connect.inc");
     $sql = "INSERT INTO labcare(code,depart,detail,price,yprice,nprice,part)
                  VALUES('$code','$depart','$detail','$price','$yprice','$nprice','$part');";
      $result = mysql_query($sql);
      if (mysql_errno() == 0){
           print "<br><br><br>";
           print "รหัส      :$code<br>";
           print "แผนก   :$depart<br>";
           print "รายการ :$detail<br>";
           print "ราคารวม     :$price<br>";
print "ราคาเบิกได้    :$yprice<br>";
print "ราคาเบิกไม่ได้     :$nprice<br>";
           print "ประเภท :$part<br>";
           print "บันทึกข้อมูลเรียบร้อย";
			}
      else { 
           print "<br><br><br>รหัส  :$code  ซ้ำของเดิม โปรดแก้ไข<br>";
              }
include("unconnect.inc");
?>


