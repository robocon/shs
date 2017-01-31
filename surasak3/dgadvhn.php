<?php
session_start();
session_unregister("cHn");  
session_unregister("cPtname");
session_unregister("cPtright");
session_unregister("nVn");  
session_unregister("cAge");  
session_unregister("nRunno");  
session_unregister("vAN");
session_unregister("thdatehn");  
session_unregister("cNote");  

// var_dump($_SESSION);

if( empty($_SESSION['sOfficer']) ){
    ?>
    <p>Sessionหมดอายุ <a href="login_page.php">คลิกที่นี่</a>เพื่อเข้าสู่ระบบอีกครั้ง </p>
    <?php
    exit;
}

//    session_destroy();
?>
<form method="post" action="dgadvhn.php">
  <p>HN คนไข้แพ้ยา</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="     ตกลง     " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  " name="B2"> 
  <a href="list_drugreact.php" target="_blank">ดูรายชื่อผู้ป่วยแพ้ยาทั้งหมด</a></p>
</form>

<table>
 <tr>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ยศ</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>สกุล</th>
 </tr>

<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT hn,yot,name,surname FROM opcard WHERE hn = '$hn'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$yot,$name,$surname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target='_blank'  href=\"dgadv.php? cHn=$hn & cName=$name &cSurname=$surname\">$hn</a></td>\n".
           "  <td BGCOLOR=66CDAA>$yot</td>\n".
           "  <td BGCOLOR=66CDAA>$name</td>\n".
           "  <td BGCOLOR=66CDAA>$surname</td>\n".
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
