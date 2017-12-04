<?php
   session_start();
    session_unregister("cIdcard");  
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");  
    session_unregister("cAge");  
    session_unregister("nRunno");  
    session_unregister("vAN");
    session_unregister("thdatehn");  
    session_unregister("cNote");  
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;ให้คิวผู้ป่วยจากเลขบัตรประจำตัวประชาชน</p>
  <p>&nbsp;&nbsp;&nbsp;ค้นหาคนไข้จากเลขบัตรประจำตัว13หลัก</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ID&nbsp;&nbsp;&nbsp;
  <input type="text" name="idcard" size="13" id="aLink"></p>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="     ตกลง     " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  " name="B2"></p>
</form>

<table>
 <tr>
  <th bgcolor=6495ED>เลขบัตร ปชช.</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ยศ</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>สกุล</th>
 <th bgcolor=6495ED>มา รพ.</th>
  <th bgcolor=6495ED>ตรวจนัด</th>
  <th bgcolor=6495ED>ตรวจนอน</th>
 </tr>

<?php
If (!empty($idcard)){
    include("connect.inc");
    $query = "SELECT idcard,hn,yot,name,surname FROM opcard WHERE idcard = '$idcard'";
    $result = mysql_query($query)
        or die("query failed,opcard");

    while (list ($idcard,$hn,$yot,$name,$surname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a   href=\"opeditkew.php? cIdcard=$idcard&cHn=$hn & cName=$name &cSurname=$surname\">$idcard</a></td>\n".
           "  <td BGCOLOR=66CDAA>$hn</td>\n".
           "  <td BGCOLOR=66CDAA>$yot</td>\n".
           "  <td BGCOLOR=66CDAA>$name</td>\n".
           "  <td BGCOLOR=66CDAA>$surname</td>\n".
 "  <td BGCOLOR=66CDAA><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">มา รพ.</td>\n".
         "  <td BGCOLOR=66CDAA><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">ตรวจนัด</td>\n".
    "  <td BGCOLOR=66CDAA><a target= _BLANK href=\"ancheck.php?hn=$hn\">ตรวจนอน</td>\n".
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
