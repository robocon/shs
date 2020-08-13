<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'>วันที่ $today  รายชื่อคนไข้ที่ทำหัตถการ  หรือตรวจวิเคราะห์โรค";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
    <tr>
        <th bgcolor=6495ED>#</th>
        <th bgcolor=6495ED>เวลา</th>
        <th bgcolor=6495ED>ชื่อ</th>
        <th bgcolor=6495ED>HN</th>
        <th bgcolor=6495ED>AN</th>
        <th bgcolor=6495ED>VN</th>
        <th bgcolor=6495ED>แผนก</th>
        <th bgcolor=6495ED>รายการ</th>
        <th bgcolor=6495ED>รวมเงิน</th>
        <th bgcolor=6495ED>จ่ายเงิน</th>
        <th bgcolor=6495ED>สิทธิ</th>
        <th bgcolor=6495ED>ประเภท</th>
    </tr>
<?php
//    $detail="ค่ายา";
    $num=0;
    include("connect.inc");
  
    $query = "SELECT a.date,a.ptname,a.hn,a.an,a.depart,a.detail,a.price,a.paid,a.row_id,a.accno,a.ptright,a.tvn,b.`goup` 
    FROM depart AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE a.date LIKE '$today%' 
    AND a.depart='DENTA' ";
    $result = mysql_query($query) or die("Query failed");
    $lists = array();
    $totalpri = 0;
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright,$tvn,$goup) = mysql_fetch_row ($result)) { 

        $num++;
        $time=substr($date,11);
        $totalpri=$totalpri+$price;

        if(empty($lists[$goup])){
            $lists[$goup]['count'] = 1;
            $lists[$goup]['price'] = (int)$price;
        }else{
            $lists[$goup]['count']++;
            $lists[$goup]['price'] += (int)$price;
        }
        

        print (" <tr>\n".
        "  <td BGCOLOR=66CDAA>$num</td>\n".
        "  <td BGCOLOR=66CDAA>$time</td>\n".
        "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"invdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
        "  <td BGCOLOR=66CDAA>$hn</td>\n".
        "  <td BGCOLOR=66CDAA>$an</td>\n".
        "  <td BGCOLOR=66CDAA>$tvn</td>\n".
        "  <td BGCOLOR=66CDAA>$depart</td>\n".
        "  <td BGCOLOR=66CDAA>$detail</td>\n".
        "  <td BGCOLOR=66CDAA>$price</td>\n".
        "  <td BGCOLOR=66CDAA>$paid</td>\n".
        "  <td BGCOLOR=66CDAA>$ptright</td>\n".
        "  <td BGCOLOR=66CDAA>$goup</td>\n".
        " </tr>\n");
    }
   
    include("unconnect.inc");
?>
</table>
<?php 
print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท";
?>
<p><b>สรุปตามประเภทของผู้มาใช้บริการ</b></p>
<table>
    <tr>
        <td bgcolor="6495ED">ประเภท</td>
        <td bgcolor="6495ED">ยอดรวม(คน)</td>
        <td bgcolor="6495ED">รวมค่าใช้จ่าย(บาท)</td>
    </tr>
<?php
foreach ($lists as $name => $item) {
    ?>
    <tr>
        <td bgcolor="66CDAA"><?=$name;?></td>
        <td align="right" bgcolor="66CDAA"><?=$item['count'];?></td>
        <td align="right" bgcolor="66CDAA"><?=number_format($item['price'],2);?></td>
    </tr>
    <?php
}
?>
</table>
