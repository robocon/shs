<?php 
/**
 * โค้ดส่วนใหญ่เอามาจาก lab_lst_print_opd1new2.php
 * ความตั้งใจคือ รับค่า พวก labnumber หรือ clinicalinfo เอาไว้ปริ้นสำหรับตรวจสุขภาพทีละบริษัท
 * 
 * @readme !!! Important โปรดอ่าน !!! 
 * ตอนนี้ให้มันปริ้น METAMP ได้ก่อน
 */
require 'bootstrap.php';
$dbi = new mysqli(REMOTE_HOST,REMOTE_USER,'',DB);

function getAge($birthday) {
	$then = strtotime($birthday);
	return(floor((time()-$then)/31556926));
}

/**
 * @param $rows array date_format(orderdate,'%Y-%m-%d') as neworderdate,patientname,labnumber,sex,dob,comment resulthead
 */
function getHeader($rows,$next = false){
	// global $gethn,$getlabnumber,$getdepart,$getlistlab,$dateB,$getdoctor;

    $age = getAge($rows['dob']);
    $getdepart = '-';
    $getdoctor = 'N/A';
?>
<thead>
	<tr>
		<th colspan="7">
			<table width="100%" class="tg">
				<tr>
					<th class="tg-0lax" colspan="1" scope="colgroup"><b>โรงพยาบาลค่ายสุรศักดิ์มนตรี</b></th>
					<th class="tg-0lax" colspan="6" scope="colgroup"><b>ใบรายงานผลทางห้องปฏิบัติการ</b></th>
				</tr>
				<tr>
					<th class="tg-0lax" rowspan="3" scope="rowgroup" width="28%">
						<img src="images/logo2.png" alt="โรงพยาบาลค่ายสุรศักดิ์มนตรี"><br>
						<span class="style1">1 หมู่ 1 ต.พิชัย อ.เมือง จ.ลำปาง 52000 โทร 054-839305</span>
					</th>
					<th class="tg-0lax" scope="col" align="right"><b>Name : </b></th>
					<th class="tg-0lax" scope="col" align="left"><?=$rows["patientname"];?></th>
					<th class="tg-0lax" scope="col" align="right"><b>HN : </b></th>
					<th class="tg-0lax" scope="col" align="left"><?=$rows['hn'];?></th>
					<th class="tg-0lax" scope="col" align="right"><b>Lab Number : </b></th>
					<th class="tg-0lax" scope="col" align="left"><?=$rows['labnumber'];?></th>
				</tr>
				<tr>
					<th class="tg-0lax" scope="col" align="right"><b>Ward : </b></th>
					<th class="tg-0lax" colspan="5" scope="colgroup" align="left"><?=$getdepart;?>&nbsp;&nbsp;&nbsp;<b>Test : </b><?=$rows['profilecode'];?></th>
				</tr>
				<tr>
					<th class="tg-0lax" scope="col" align="right"><b>Age : </b></th>
					<th class="tg-0lax" colspan="5" scope="colgroup" align="left"><?=$age." ปี";?>&nbsp;&nbsp;&nbsp;<b>Doctor : </b><?=$getdoctor;?> <b>Comment : </b><?=$rows["comment"];?></th>
				</tr>
				<tr>
					<th colspan="7">
						<table width="100%" class="tg">
							<th class="tg-0lax labTitle" colspan="2" scope="colgroup" width="32%"><b>Test</b></th>
							<th class="tg-0lax labTitle" colspan="2" scope="colgroup" align="right" width="20%"><b>Result</b></th>
							<th class="tg-0lax labTitle" scope="col" width="8%"></th>
							<th class="tg-0lax labTitle" scope="col" width="10%"><b>Unit</b></th>
							<th class="tg-0lax labTitle" scope="col" width="20%"><b>Reference Range</b></th>
						</table>
					</th>
				</tr>
				<tr>
					<th class="tg-0lax" colspan="7" scope="colgroup" align="left"><b><u><?=$rows['testgroupname'];?></u></b></th>
				</tr>
			</table>
		</th>
	</tr>
</thead>
<?php
}

/**
 * Require releasename, authorisedate, authorisename FROM resultdetail
 */
function getFooter($arr3){
	?>
	<tfoot class="tbFooter">
		<tr>
			<td colspan="7">
				<table width="100%" class="tg">
					<tr>
						<td class="tg-0lax" colspan="4" align="left"><b>Reported by : </b><?=$arr3["releasename"];?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Authorize by : </b><?=$arr3["authorisename"];?></td>
						<td class="tg-0lax" align="right"><b>หมายเหตุ</b></td>
						<td class="tg-0lax" colspan="2">L, H หมายถึง ค่าที่ต่ำหรือสูงกว่าค่าอ้างอิงในคน</td>
					</tr>
					<tr>
						<td class="tg-0lax" colspan="4" align="left"><b>Date Authorise : </b><?=$arr3["authorisedate"];?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Date Printed : </b><?=date("Y-m-d H:i:s");?></td>
						<td class="tg-0lax"></td>
						<td class="tg-0lax" colspan="2" align="left">LL, HH หมายถึง ค่าที่อยู่ในช่วงวิกฤต</td>
					</tr>
				</table>
			</td>
		</tr>
	</tfoot>
	<?php
}

$hn = $_REQUEST['hn'];
$labnumber = $_REQUEST['labnumber'];

$sqlResHead = "SELECT `autonumber`, DATE_FORMAT(`orderdate`,'%Y-%m-%d') AS `orderdate`,`labnumber`,`hn`,`patientname`,`sex`,`dob`,`profilecode`,`comment`,`testgroupname`
FROM `resulthead` 
WHERE `hn` = '$hn' 
AND `labnumber` = '$labnumber' 
AND `profilecode` = 'METAMP' 
LIMIT 0,1";
$q = $dbi->query($sqlResHead);
if($q->num_rows>0)
{

?>
<table class="tg" width="100%">
    <?php 
    // ในตัว lab_lst_print_opd1new2.php ข้างนอก Table จะเป็นการ select เพื่อ GROUP BY testgroupname แบ่งตาม CHEMISTRY, HEMATOLOGY, MICROSCOPIC
    $rows = $q->fetch_assoc();
    getHeader($rows);
    ?>
    <tbody>
        <tr>
            <td colspan="7">
                <table width="100%" class="tg">

                <?php 
                $autonumber = $rows['autonumber'];

                $sqlResDetail = "SELECT * FROM `resultdetail` WHERE `autonumber` = '$autonumber' ";
                $q_resDetail = $dbi->query($sqlResDetail);
                $arr3 = false;
                while ($arr2 = $q_resDetail->fetch_assoc()) {
                    $arr3 = $arr2;
                    ++$ii;
                    if($arr2["flag"] != 'N'){
                        $bgcolor="#FFDDDD"; 
                    }else{
                        $bgcolor="#FFFFFF";
                    }
                    ?>
                    <tr bgcolor="<?php echo $bgcolor;?>">
                        <td width="32%" class="labContent">&nbsp;&nbsp;&nbsp;<?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo $arr2["labname"];?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></td>
                        <td align="right" width="20%" class="labContent"><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo $arr2["result"];?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></td>
                        <td align="right" width="8%" style="color: red;" class="labContent"><B><?php if($arr2["flag"] != 'N'){  echo"[", $arr2["flag"],"]";};?></B></td>
                        <td align="left" width="10%" class="labContent"><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo "". ($arr2["unit"] !=""?"".$arr2["unit"]."":"")."";?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></td>
                        <td align="left" width="20%" class="labContent"><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php if($arr2["normalrange"] != ""){ echo "[",$arr2["normalrange"],"]" ;};?><?php if($arr2["flag"] != 'N'){ echo "</B>";}?></td>
                    </tr>
                <?php 
                }
                ?>
                </table>
            </td>
        </tr>
    </tbody>
    <?php
    getFooter($arr3)
    ?>
</table>
<div style="page-break-after: always"></div>
<?php
} // end if rows > 0