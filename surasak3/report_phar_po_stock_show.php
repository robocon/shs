<? 
session_start();
include("connect.inc");

$billno = $_POST["billno"]; 
$date_po = $_POST["date_po"]; 

//-----> convert date eng to th
$date_po_th_Y = substr($date_po, 0,4)+543;
$date_po_th_M = substr($date_po, 5,2);
$date_po_th_D = substr($date_po, 8,2);
$date_po_th = $date_po_th_D."/".$date_po_th_M."/".$date_po_th_Y;
  
$sql = "SELECT * FROM stktranx WHERE billno = '".$billno."' AND getdate like '%".$date_po."%' ORDER BY row_id ASC";

//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
	echo "<h1 align='center'>ไม่พบข้อมูล</h1>";echo "<br>".exit();
}//end if
 
 
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.txt1 {	font-family: TH SarabunPSK;
	font-size: 20px;
}

#table1 {
  border-collapse: collapse;
}
#printable { display: block; }
@media print { 
     #non-printable { display: none; } 
     #printable { page-break-after:always; } 
} 
.style1 {font-weight: bold}
-->
</style>

<title>รายการเบิกจากคลังยา ตามเลขที่ใบเบิก</title>
<div id="non-printable0">
<h2 align="center"><u><b>รายการเบิกจากคลังยา<br> เลขที่ใบเบิก <?php echo $billno; ?> วันที่ <?php echo $date_po_th; ?></b></u></h2>
 

<center>
<table border="1" width="90%" id="table1">
	<tr>
	<td align="center" style="font-size:15"><b>ลำดับ</b></td>
	<td align="center" style="font-size:15"><b>รหัส</b></td>
	<td align="center" style="font-size:15"><b>รายการ</b></td>
	<td align="center" style="font-size:15"><b>Exp.</b></td>
	<td align="center" style="font-size:15"><b>เบิก</b></td>
	<td align="center" style="font-size:15"><b>หน่วย</b></td>
	<td align="center" style="font-size:15"><b>ในคลัง</b></td>
	<td align="center" style="font-size:15"><b>ในห้องจ่าย</b></td>
	<td align="center" style="font-size:15"><b>ทุน</b></td>
	<td align="center" style="font-size:15"><b>มูลค่าเบิก</b></td> 
	</tr>
<? 
$count = 0;
$sum_price = 0;
$sum_price_total = 0;
 while($rows = mysql_fetch_array($query)){ $count++;

	 echo '
	 	<tr>
	<td align="center" style="font-size:15">'.$count.'</td>
	<td align="left" style="font-size:15">'.$rows['drugcode'].'</td>
	<td align="left" style="font-size:15">'.$rows['tradname'].'</td>
	<td align="center" style="font-size:15">'.$rows['expdate'].'</td>
	<td align="right" style="font-size:15">'.number_format($rows['stkcut']).'</td>
	<td align="left" style="font-size:15">'.$rows['unit'].'</td>
	<td align="right" style="font-size:15">'.number_format($rows['mainstk']).'</td>
	<td align="right" style="font-size:15">'.number_format($rows['stock']).'</td>
	<td align="right" style="font-size:15">'.number_format($rows['unitpri'],4).'</td>
	<td align="right" style="font-size:15">'.number_format($rows['unitpri'] * $rows['stkcut'],2).'</td>
	</tr>
	 ';
 
		$sum_price = $rows['unitpri'] * $rows['stkcut'];
		$sum_price_total = $sum_price_total + $sum_price;

 }//end while

 echo '
	 	<tr>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15">&nbsp;</td>
	<td align="center" style="font-size:15"><b>มูลค่าเบิกรวม : </b></td>
	<td align="right" style="font-size:15"><b>'.number_format($sum_price_total,2).'</b></td>
	</tr>
	 ';
?>
	
</table>
<br><br>
<table style="width: 90%;">
        <tr>
            <td width="40%" colspan="2">
                <p>
                    ตรวจแล้วเห็นว่า .............................................................................................................<br>
                    .........................................................................................................................................
                </p>
            </td>
            <td width="50%" colspan="2">
                <p>
                    ขอเบิกสิ่งอุปกรณ์ตามที่ระบุไว้ในช่อง"จำนวนเบิก"และขอมอบให้<br>
                    ..........................................................................เป็นผู้รับแทน
                </p>
            </td>
        </tr>
        <tr>
            <td align="center" width="25%">.....................................................</td>
            <td align="center" width="25%">.....................................................</td>
            <td align="center" width="25%">.....................................................</td>
            <td align="center" width="25%">.....................................................</td>
        </tr>
        <tr>
            <td align="center">(ลงนาม) ผู้ตรวจสอบ</td>
            <td align="center">วัน เดือน ปี</td>
            <td align="center">(ลงนาม) ผู้เบิก</td>
            <td align="center">วัน เดือน ปี</td>
        </tr>
        <tr>
            <td width="40%" colspan="2">
                <p>อนุมัติให้จ่ายได้เฉพาะในรายการและจำนวนที่ผู้ตรวจสอบเสนอ</p>
            </td>
            <td width="50%" colspan="2">
                <p>ได้รับสิ่งอุปกรณ์ตามรายการและจำนวนที่แจ้งไว้ในช่อง "จ่ายจริง"</p>
            </td>
        </tr>
        <tr>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
        </tr>
        <tr>
            <td align="center">(ลงนาม) ผู้สั่งจ่าย</td>
            <td align="center">วัน เดือน ปี</td>
            <td align="center">(ลงนาม) ผู้รับ</td>
            <td align="center">วัน เดือน ปี</td>
        </tr>
        <tr>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
        </tr>
        <tr>
            <td align="center">(ลงนาม) ผู้จ่าย</td>
            <td align="center">วัน เดือน ปี</td>
            <td align="center">(ลงนาม) จนท.ส่วนควบคุมทางบัญชี</td>
            <td align="center">วัน เดือน ปี</td>
        </tr>
    </table>

<? exit(); ?>
 
</center>
</div>

