<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบรายชื่อผู้ป่วยทั้งหมด </p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แถว&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="text" name="hn1" size="12"></p>

&nbsp;&nbsp;&nbsp;โปรแกรมจะเริ่มตั้งแต่จำนวนแถว  จำนวน 1000 แถว&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>

<table>
 <tr>
   <th bgcolor=CD853F>แถว</th>

 
 <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>ชื่อ - สกุล</th>
 

 
  <th bgcolor=CD853F>วันที่มาครั้งสุดท้าย</th>


  <th bgcolor=CD853F>ไม่มาติดต่อ</th>


 </tr>

<?php

{
    include("connect.inc");
    $query = "SELECT regisdate,row_id,hn,yot,name,surname,idcard,dbirth,ptright,note,lastupdate FROM opcard WHERE row_id  >='$hn1' limit 1000 ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($regisdate,$row_id,$hn,$yot,$name,$surname,$idcard,$dbirth,$ptright,$note,$lastdate) = mysql_fetch_row ($result)) {
 $thidate2 = (date("Y")).date("-m-d H:i:s"); 
$cPtname=$yot.' '.$name.'  '.$surname;
$lastdate1=$thidate2 - $lastdate;
        print (" <tr>\n".
  "  <td BGCOLOR=F5DEB3>$row_id</a></td>\n".

        
   "  <td BGCOLOR=F5DEB3>$hn</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$cPtname</td>\n".
      //   "  <td BGCOLOR=F5DEB3>$regisdate</td>\n".
      "  <td BGCOLOR=F5DEB3>$lastdate</td>\n".
         "  <td BGCOLOR=F5DEB3>$lastdate1</td>\n".
    //  "  <td BGCOLOR=F5DEB3>$thidate2</a></td>\n".
         //  "  <td BGCOLOR=F5DEB3>พบ..ไม่พบ</a></td>\n".
           "  <td BGCOLOR=F5DEB3></a></td>\n".



           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
