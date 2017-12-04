<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบรายชื่อผู้ป่วย CSCD  ที่มีปัญหา </p>
  <a target=_self  href='../nindex.htm'><<ไปเมนู</a>


</form>

<table>
 <tr>
   <th bgcolor=CD853F>#</th>

  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>ยศ</th>
  <th bgcolor=CD853F>ชื่อ</th>
  <th bgcolor=CD853F>สกุล</th>
  <th bgcolor=CD853F>เลขประชาชน</th>
  <th bgcolor=CD853F>สิทธิ</th>
  <th bgcolor=CD853F>รายการ</th>


 </tr>

<?php
{
    include("connect.inc");
    $query = "SELECT row_id,hn,yot,name,surname,idcard,dbirth,ptright,note,idguard FROM opcard WHERE idguard LIKE 'มีปัญ%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($row_id,$hn,$yot,$name,$surname,$idcard,$dbirth,$ptright,$note,$idguard) = mysql_fetch_row ($result)) {
		 $num++;
        print (" <tr>\n".
		     "  <td BGCOLOR=F5DEB3>$num</a></td>\n".

           "  <td BGCOLOR=F5DEB3>$hn</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$yot</td>\n".
           "  <td BGCOLOR=F5DEB3>$name</td>\n".
           "  <td BGCOLOR=F5DEB3>$surname</td>\n".
           "  <td BGCOLOR=F5DEB3>$idcard</a></td>\n".
			              "  <td BGCOLOR=F5DEB3>$ptright</a></td>\n".
     "  <td BGCOLOR=F5DEB3>$idguard</a></td>\n".



           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
