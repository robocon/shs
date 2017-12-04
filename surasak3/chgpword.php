<?php
    session_start();
    include("connect.inc");
    if ($newpw1==$newpw2){
//        echo "newpw1=$newpw1<br>";
//        echo "newpw2=$newpw2<br>";
       $query = "SELECT * FROM inputm WHERE idname = '$username' and pword='$password'";
       $result = mysql_query($query) or die("Query failed");
           for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
           if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
              }

          if(!($row = mysql_fetch_object($result)))
              continue;
             }
       if(mysql_num_rows($result)){
//           echo "old PW=$sPword<br>"; 
           $sPword=$newpw1;
//           echo "new sPword =$sPword<br>";
//           echo "newpd1=$newpw1<br>";
           $query ="UPDATE inputm SET pword = '$newpw1',date_pword='".date("Y-m-d H:s:i")."' WHERE idname= '$username' ";
           $result = mysql_query($query)or die("รหัสผ่านซ้ำที่มีอยู่เดิม ไม่สามารถเปลี่ยนรหัสผ่านได้");
//           echo mysql_errno() . ": " . mysql_error(). "\n";
//           echo "<br>";
           echo ".....<br>";  
           echo ".....<br>";
           echo ".....<br>";
           echo ".....<br>";
           echo ".....เปลี่ยนรหัสผ่านเรียบร้อย <br>";	   
	}
   else {
         echo "<br><br><br>........ชื่อผู้ใช้หรือรหัสผ่านเดิมไม่ถูกต้อง  ไม่สามารถเปลี่ยนรหัสผ่านได้ !<br>";
             }
	}
   else {
         echo "<br><br><br>........รหัสผ่านใหม่ พิมพ์สองครั้งไม่เหมือนกัน ไม่สามารถเปลี่ยนได้ !<br>";
             }
       include("unconnect.inc");
?>