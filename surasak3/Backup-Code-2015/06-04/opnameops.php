<?php
   session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");  
    session_unregister("nRunno");  
    session_unregister("vAN");
    session_unregister("thdatehn");  
    session_unregister("cNote");  
//    session_destroy();
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>ค้นหาคนไข้จาก&nbsp; ชื่อและนามสกุล</p>
    <p>ให้ใส่ข้อมูลทั้งชื่อและนามสกุลทั้งสองข้อมูล</p>

  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="name" size="12" id="aLink"> <script type="text/javascript">
document.getElementById('aLink').focus();
</script>&nbsp;&nbsp;&nbsp;&nbsp; สกุล&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="sname" size="12"></p>
 
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ตกลง  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  " name="B2"></p>
</form>

<table>
 <tr>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ยศ</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>สกุล</th>
  <th bgcolor=6495ED>ว/ด/ป เกิด</th>
  <th bgcolor=6495ED>บัตร ปชช.</th>
  <th bgcolor=6495ED>มา รพ.</th>
  <th bgcolor=6495ED>ตรวจนัด</th>
  <th bgcolor=6495ED>ตรวจนอน</th>
 </tr>

<?php
If (!empty($name)){
    include("connect.inc");
    global $name;
    $query = "SELECT hn,yot,name,surname,dbirth,idcard FROM opcard WHERE name LIKE '$name%' and surname LIKE '$sname%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$yot,$name,$surname,$dbirth,$idcard) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"opedit.php? cHn=$hn \">$hn</a></td>\n".
           "  <td BGCOLOR=66CDAA>$yot</td>\n".
           "  <td BGCOLOR=66CDAA>$name</td>\n".
           "  <td BGCOLOR=66CDAA>$surname</td>\n".
         "  <td BGCOLOR=66CDAA>$dbirth</td>\n".
         "  <td BGCOLOR=66CDAA>$idcard</td>\n".
         "  <td BGCOLOR=66CDAA><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">มา รพ.</td>\n".
         "  <td BGCOLOR=66CDAA><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">ตรวจนัด</td>\n".
    "  <td BGCOLOR=66CDAA><a target= _BLANK href=\"ancheck.php?hn=$hn\">ตรวจนอน</td>\n".
           " </tr>\n");
           }
include("unconnect.inc");
          }
?>

</table>
