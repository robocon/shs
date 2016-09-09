<?php
    $appd=$appdate.' '.$appmo.' '.$thiyr;
    print "<font face='Angsana New'><b>รายชื่อคนไข้นัดตรวจ</b><br>";
    print "<b>แผนก</b> $detail <br>"; 
    print "<b>นัดมาวันที่</b> $appd ";
//    print ".........<input type=button onclick='history.back()' value=' << กลับไป '>";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
    <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>
    <th bgcolor=6495ED><font face='Angsana New'>DIAG ก่อนนัด</th>
	    <th bgcolor=6495ED><font face='Angsana New'>เจ้าหน้าที่</th>
  <th bgcolor=6495ED>มา?</th>
  <th bgcolor=6495ED>แก้ไข</th>
  <th bgcolor=6495ED>ยกเลิก</th>
  <th bgcolor=6495ED>พิมพ์</th>
  </tr>

<?php
    include("connect.inc");
		
    $where = "";
	if($_SESSION["sIdname"] == "ฝังเข็ม"){
        $where = " WHERE a.`apptime` != 'ยกเลิกการนัด' ";
    }
	
    $query = "SELECT a.`hn`,a.`ptname`,a.`appdate`,a.`apptime`,a.`diag`,a.`came`,a.`row_id`,a.`age`,a.`depcode`,a.`officer`  
    FROM appoint AS a 

    RIGHT JOIN (
        SELECT MAX(`row_id`) AS `row_id`, 
        `hn`, `appdate`, 
        TRIM(`doctor`) AS `doctor`, 
        SUBSTRING(`doctor`, 1, 5) as `doctor_code` 
        FROM `appoint` 
        WHERE `appdate` = '$appd' 
        AND `detail` = '$detail' 
        GROUP BY `hn`,`appdate`
    ) AS b ON b.`row_id` = a.`row_id` 

    #WHERE `appdate` = '$appd' 
    #AND `detail` = '$detail' 
    $where 
    ORDER BY a.`apptime` ASC ";
    $result = mysql_query($query) or die( mysql_error() );
    $num=0;
    while (list ($hn,$ptname,$appdate,$apptime,$diag,$came,$row_id,$age,$depcode,$officer) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$apptime</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
		       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depcode</td>\n".
			    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
			         "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$came</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"editappoi.php? cRow=$row_id&cAppdate=$appdate&cApptime=$apptime\">แก้ไข</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"delappoi.php? cRow=$row_id\">ยกเลิก</a></td>\n".
		   "  <td BGCOLOR=66CDAA><font face='Angsana New'><A HREF=\"appinsert2.php?row_id=".$row_id."\" target=\"_blank\">พิมพ์</a></td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




