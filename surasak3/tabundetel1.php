<?php
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$yrmonth%'  ";
    $result = mysql_query($query) or die("Query failed,opday");


  print "รายงานประจำ  $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
   $query="SELECT  toborow ,COUNT(*) AS duplicate FROM opday1 GROUP BY toborow HAVING duplicate > 0 ORDER BY toborow";
   $result = mysql_query($query);
     $n=0;
	 $sum=0;
 while (list ($toborow,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chktbdetel.php?toborow=".urlencode($toborow)."&today=$yrmonth\">$toborow&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน = $duplicate</td>\n".
               " </tr>\n<br>");
			   $sum = $sum + $duplicate;
               }

print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'>รวมทั้งหมด</td>\n".
               "  <td BGCOLOR=66CDAA colspan=\"2\">$sum</td>\n".
               " </tr>\n<br>");
?>
<h3>แยกตามสิทธิ์</h3>
<table border="1">
    <tr>
      <th>#</th>
      <th>สิทธิ</th>
      <th>จำนวน</th>
    </tr>
<?php
$i = 1;

$sql = "SELECT COUNT(a.`row_id`) AS `rows`, SUBSTRING(a.`ptright`,1,3) AS `ptCode`, b.`name` FROM ( SELECT * FROM `opday` WHERE `thidate` LIKE '$yrmonth%' ) AS a LEFT JOIN `ptright` AS b ON b.`code` = SUBSTRING(a.`ptright`,1,3) GROUP BY SUBSTRING(a.`ptright`,1,3) ORDER BY SUBSTRING(a.`ptright`,1,3) ";
$q = mysql_query($sql);
while ($item = mysql_fetch_assoc($q)) {
  ?>
    <tr>
      <td><?=$i;?></td>
      <td><?=$item['ptCode'].' '.$item['name'];?></td>
      <td><?=$item['rows'];?></td>
    </tr>
  <?php
  $i++;
}
?>
</table>
<?php
   include("unconnect.inc");
?>


