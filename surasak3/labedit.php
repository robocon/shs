<?php
session_start();
$user_code = $_SESSION['smenucode'];
$user_id = $_SESSION['sIdname'];
if( $user_code !== 'ADM' ){
    
    // ตรวจสอบชื่อ และ menucode ว่าอยู่ในรายการหรือไม่
    $check_level = in_array($user_code, array('ADMLAB'));
    $check_user = in_array($user_id, array('สมยศ','พิทักษ์1','พัชรี'));  //รับคำสั่ง หน.ห้อง LAB วันที่ 14/05/62
    
    if( $check_level === false OR $check_user === false ){
        ?>
        <p>คุณไม่มีสิทธิ์ในการแก้ไขข้อมูล กรุณาติดต่อ</p>
        <ol>
            <li>พ.ท. สมยศ แสงสุข</li>
            <li>ร.อ. พิทักษ์  ตุ้มปามา</li>
            <li>นางพัชรี  คำฟู</li>
        </ol>
        <p>เพื่อทำการแก้ไขข้อมูล</p>
        <p><a href="../nindex.htm">คลิกที่นี่</a> เพื่อกลับไปหน้าเมนูหลัก</p>
        <?php
        exit;
    }
}

    include("connect.inc");

    $query = "SELECT  code,detail,price,yprice,nprice FROM labcare WHERE code = '$code'";
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

   If ($result){
        $code=$row->code;
        $detail=$row->detail;
        $price=$row->price;
  $yprice=$row->yprice;
  $nprice=$row->nprice;
                  }  
   else {
      echo "ไม่พบ รหัส : $code ";
           }    
include("unconnect.inc");

print "<body bgcolor='#808080' text='#FFFFFF'>";
print "<form method='POST' action='labupdate.php' target='_BLANK'>";
print "<table border='0' width='100%' height='345'>";
print "<tr>";
print " <td width='7%' height='21'></td>";
print "  <td width='48%' height='21'>";
print "  <p align='center'><b>'แก้ไขข้อมูลหัถการ';</b>&nbsp;&nbsp;</td>";
print "  <td width='45%' height='21'><b>&#3650;&#3611;&#3619;&#3604;&#3607;&#3635;&#3604;&#3657;&#3623;&#3618;&#3588;&#3623;&#3634;&#3617;&#3619;&#3632;&#3617;&#3633;&#3604;&#3619;&#3632;&#3623;&#3633;&#3591;</b></td>";
print " </tr>";
print " <tr>";
print " รหัส ";
print "   <input type='text' name='code' size='20' tabindex='5'value=$code><br>";
print " ห้ามทำการเปลี่ยนรหัส ถ้าต้องการเปลี่ยนให้ลบทิ้งแล้วเพิ่มใหม่ ";
print " <td width='7%' height='236'></td>";
print " ราคาเต็ม";
print "   <input type='text' name='price' size='20' tabindex='5'value=$price><br>";

print " ราคาเบิกได้";
print "   <input type='text' name='yprice' size='20' tabindex='5'value=$yprice><br>";

print " ราคาเบิกไม่ได้";
print "   <input type='text' name='nprice' size='20' tabindex='5'value=$nprice><br>";

print "  <input type='submit' value='   &#3605;&#3585;&#3621;&#3591;   ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "    <input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></td>";
print "     <td width='45%' height='76'></td>";
print "    </tr>";
print " </table>";
print "</form>";
print "</body>";

?>




    