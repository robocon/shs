<?php 

$appdate = $_POST['appdate'];
$appmo = $_POST['appmo'];
$thiyr = $_POST['thiyr'];
$detail = $_POST['detail'];
$def_fullm_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');
$def_fullm_th = array_flip($def_fullm_th);

    $appd=$appdate.' '.$appmo.' '.$thiyr;
    print "<font face='Angsana New'><b>รายชื่อคนไข้นัดตรวจ ".$detail."</b></font><br>";
    print "<b>นัดมาวันที่</b> $appd ";
//    print ".........<input type=button onclick='history.back()' value=' << กลับไป '>";
?>
<table width="90%">
	<tr>
		<th bgcolor=6495ED><font face='Angsana New'>วันเดือนปี</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>ชื่อ</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>HN</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>เบอร์โทรศัพท์</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>วันเดือนปีที่รับแจ้ง</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>แพทย์</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>นัดมาเพื่อ</font></th>
		<th bgcolor=6495ED><font face='Angsana New'>พิมพ์</font></th>
        <th bgcolor=6495ED><font face='Angsana New'>ยกเลิก</font></th>
	</tr>

<?php
    include("connect.inc");
		
		if($detail == "FU13 ส่องกระเพาะ"){
			$where = " OR detail = 'FU20 ส่องกระเพาะ(คลินิกพิเศษ)' ";
		}else if($detail == "FU20 ส่องกระเพาะ(คลินิกพิเศษ)"){
			$where = " OR detail = 'FU13 ส่องกระเพาะ' ";
		}

	$appdate_en = ($thiyr-543).'-'.$def_fullm_th[$appmo].'-'.$appdate;

    $query = "SELECT a.row_id, date_format(a.date,'%d-%m-%Y'), a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, a.came, b.phone  
	FROM appoint as a 
	INNER JOIN opcard as b ON a.hn = b.hn 
	WHERE appdate_en = '$appdate_en' 
	#appdate like '%".$appd."' 
	AND apptime != 'ยกเลิกการนัด' 
	and (detail = '$detail' $where ) 
	Order by appdate ASC, detail ASC ";
    $result = mysql_query($query) or die("Query failed ".mysql_error());
    $num=0;
    while (list ($row_id, $date, $officer, $hn, $ptname, $age, $doctor, $appdate, $apptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode, $came, $phone) = mysql_fetch_row ($result)) {
        $num++;
		if($num %2 ==0)
			$bgcolor = "#FFFFBB";
		else
			$bgcolor = "#FFFFFF";

		if($detail == "FU20 ส่องกระเพาะ(คลินิกพิเศษ)"){
			$style = " style='color:#FF0000;' ";
		}else{
			$style = " style='color:#000000;' ";
		}

        print (" <tr bgcolor='".$bgcolor."'>\n".
"<td align='center'><font face='Angsana New'>$appdate<BR>$apptime </font></td>\n".
"<td><font face='Angsana New'>$ptname</font></td>\n".
"<td><font face='Angsana New'>$hn</font></td>\n".
"<td><font face='Angsana New'>$phone</font></td>\n".
"<td><font face='Angsana New'>$date</font></td>\n".
"<td><font face='Angsana New'>".substr($doctor,5)."</font></td>\n".
"<td ".$style." ><font face='Angsana New'>".substr($detail,4)."<BR>$detail2</font></td>\n".
"<td><font face='Angsana New'><a href='appinsert2.php?row_id=$row_id' target='_blank'>พิมพ์</a></font></td>\n".
"  <td><font face='Angsana New'><a target=_BLANK  href=\"delappoi.php? cRow=$row_id\">ยกเลิก</a></font></td>\n".

           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




