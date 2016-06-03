<?php
   session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cAge");
	session_unregister("cptright");
session_unregister("cnote");
session_unregister("cidguard");

?>
<form method="post" action="hnappoi.php">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ออกใบนัดผู้ป่วย</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN :&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ตกลง  " name="B1">
    &nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< เมนู</a></p>
คำเตือน  .....  การออกใบนัด กรุณาอย่าใช้อักษรที่พิเศษเช่น (  , "  '  เป็นต้น)   อาจทำให้ข้อมูลไม่สามารถบันทึกลงในคอมพิวเตอร์
</form>

<table>
 <tr>
  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>ยศ</th>
  <th bgcolor=CD853F>ชื่อ</th>
  <th bgcolor=CD853F>สกุล</th>
    <th bgcolor=CD853F>สิทธิ</th>
 <th bgcolor=CD853F>หมายเหตุ</th>
 </tr>

<?php
$hn = $_POST['hn'];
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT hn,yot,name,surname,dbirth,ptright,note,idguard FROM opcard WHERE hn = '$hn'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$yot,$name,$surname,$dbirth,$ptright,$note,$idguard) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><a target='right'  href=\"preappoi.php? cHn=$hn&cYot=$yot & cName=$name &cSurname=$surname&Age=$dbirth&ptright=$ptright&note=$note&idguard=$idguard\">$hn</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$yot</td>\n".
           "  <td BGCOLOR=F5DEB3>$name</td>\n".
           "  <td BGCOLOR=F5DEB3>$surname</td>\n".
			          "  <td BGCOLOR=F5DEB3>$ptright</td>\n".
    "  <td BGCOLOR=F5DEB3>$idguard</td>\n".

           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
