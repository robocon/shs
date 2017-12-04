<form method="post" action="<?php echo $PHP_SELF ?>">
 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โปรแกรมตรวจสอบสถานะประวัติผู้ป่วยใน</p> <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบหมายเลข  AN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="an" size="12" id="aLink" ></p>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>

  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>
<?
if(!empty($an)){
    include("connect.inc");
    global $an;
	$query = "SELECT dcnumber FROM ipcard WHERE an = '$an'";
    $result = mysql_query($query) or die("Query failed");
    list($dcnumber) = mysql_fetch_row ($result);
	if($dcnumber!="")
	echo "<B>ลำดับการจำหน่าย&nbsp; </B>".$dcnumber."<BR>";

	
$sql = "Select ptname,doctor,dcdate,dctype From ipcard where an = '$an' ";
$result2 = Mysql_Query($sql);
list($ptname,$doctor,$dcdate,$dctype) = Mysql_fetch_row($result2);
echo "<B>ชื่อ</B>".$ptname."";
echo "&nbsp;&nbsp;<B>แพทย์</B>".$doctor."<BR>";
echo "<B>วันจำหน่าย</B>&nbsp;".$dcdate."";
echo "&nbsp;&nbsp;<B>ประเภทการจำหน่าย</B>&nbsp;".$dctype."<br>";

?>
<table>
 <tr>
  <th bgcolor=CD853F>วันที่</th>
    <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>สถานะ</th>
  <th bgcolor=CD853F>ผู้บันทึก</th>
 </tr>

<?php
	
	   $query = "SELECT date,status,office,an FROM dcstatus WHERE an = '$an'";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$status,$office,$an) = mysql_fetch_row ($result)) {


        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3>$date</a></td>\n".
			           "  <td BGCOLOR=F5DEB3>$an</a></td>\n".
           "  <td BGCOLOR=#FF9999>$status</td>\n".
           "  <td BGCOLOR=F5DEB3>$office</td>\n".
           " </tr>\n");
       }
include("unconnect.inc");
       }
      
?>



</table>
