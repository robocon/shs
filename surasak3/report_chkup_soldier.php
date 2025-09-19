<?php

include 'bootstrap.php';
include("connect.inc");
include("function.php");
$db = Mysql::load();
$date_selected=(date("Y")+543)."-".date("m-d");
?>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<style>
@media print{
    .no-print{
        display: none;
    }
}
/* ตาราง */
body, button{
    font-family: TH SarabunPSK, TH Sarabun NEW;
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}


.chk_table1{
    border-collapse: collapse;
}
.chk_table1, th, td{
    border: 1px solid black;
    font-size: 16pt;
}
.chk_table1 th,
.chk_table1 td{
    padding: 3px;
}

    tbody tr:nth-child(even) {
        background-color: #EAECEE;
        color: black;
    } 
</style>
<script type="text/javascript" src="diabetes_clinic/epoch_classes.js"></script>
<script type="text/javascript">



	var popup1;
	window.onload = function() {
		popup1 = new Epoch('popup1','popup',document.getElementById('date_selected'),false);
	};
</script>	
<div class="no-print">
    <div>
        <a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลัก ร.พ.</a> ||  <a href="dashboard_chkup_soldier.php" target="_blank">Dashboard ตรวจสุขภาพประจำปี</a> ||  <a href="report_chkup_soldier.php">รายชื่อผู้เข้ารับการตรวจสุขภาพประจำวัน</a>  ||  <a href="report_chkup_soldier_all.php">รายชื่อผู้เข้ารับการตรวจสุขภาพทั้งหมด</a>  ||  <a href="report_chkup_soldier_novisit.php">รายชื่อกำลังพลที่ยังไม่ได้เข้ารับการตรวจสุขภาพ</a>
    </div>
    <div>
        <form action="report_chkup_soldier.php" method="post">
            <div>
                เลือกวันที่ : <input type="text" name="date_selected" id="date_selected" value="<?=$date_selected;?>" autocomplete="off">
            </div>
            <div>
                <button type="submit">แสดงข้อมูล</button>
                <input type="hidden" name="task" value="print">
            </div>
        </form>
    </div>
    
</div>

<?php
$task = input_post('task');

		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		$nPrefix=$row->prefix;
		$yearcheck="25".$nPrefix;
		
if ( $task === 'print' ) {  

		$sqlchk="select row_id from register_chkup_soldier where yearcheck='$yearcheck' and `register_date` != '0000-00-00 00:00:00' and active='y'";
		//echo $sqlchk;
		$querychk=mysql_query($sqlchk);
		$numchk=mysql_num_rows($querychk);
?>
    <h3>รายชื่อกำลังพลมาตรวจสุขภาพประจำปี  <?=$yearcheck;?><br>เข้ารับการตรวจแล้วทั้งสิ้น <?=$numchk;?> นาย</h3>
    <?php

    /**
     * @notice
     * ไม่แน่ใจว่าจะมีปัญหา เรื่องวันที่ 29 เดือน กพ. รึป่าว ถ้าเลือกที่จะ condition แบบปี พ.ศ.
     */

	list($y,$m,$d)=explode("-",$_POST["date_selected"]);
	$yy=$y-543;
	$chkdate="$yy-$m-$d";
	$showdate="$d/$m/$y";
	
    $date_for_select = $chkdate.' 23:59:59';

    $sql = "SELECT * 
    FROM `register_chkup_soldier` 
    WHERE yearcheck='$yearcheck' and `register_date` LIKE '$chkdate%' and active='y'
	ORDER BY row_id,camp";
    //echo $sql;
	$db->select($sql);
    $items = $db->get_items();
	$rows = $result->num_rows;
    
	

	?>
    <div>
        <h3>ข้อมูลประจำวันที่ <?=$showdate;?></h3>
        <table class="chk_table1" width="40%" style='margin-left:10px;'>	
		<?php
		$sqlchk1="select camp,count(row_id) as amount from register_chkup_soldier where yearcheck='$yearcheck' and `register_date` LIKE '$chkdate%' and active='y' group by camp";
		//echo $sqlchk1;
		$querychk1=mysql_query($sqlchk1);
		$numchk1=mysql_num_rows($querychk1);
		if($numchk1 > 0){
			$n=0;
			$total=0;
			while(list($camp,$amount)=mysql_fetch_array($querychk1)){
				$n++;
				$total=$total+$amount;
			?>
            <tr>
                <td width="7%">หน่วยที่  <?=$n;?></td>
				<td width="20%" align="left"><?=$camp;?></td>
                <td width="13%">จำนวน <?=$amount;?> นาย</td>
            </tr>
			<?
			}
		}		
		?>
		</table>
		<div style='margin-left:10px;font-weight:bold;margin-top:10px;'>กำลังพลเข้ารับการตรวจสุขภาพประจำปี รวมทั้งสิ้น <?php echo $total;?> นาย มีรายชื่อดังต่อไปนี้</div>
        <table class="chk_table" width="90%">
            <tr>
                <th>#</th>
				<th>ID</th>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>				
				<th>สังกัด</th>
				<th>ตำแหน่ง</th>
				<th>ช่วยราชการ</th>
				<th>ข้อมูลซักประวัติ<br>วัน/เดือน/ปี</th>
				<th>แพทย์อ่านผลตรวจ<br>วัน/เดือน/ปี</th>
				<th>หมายเหตุ</th>
            </tr>
            <?php 
            $i = 0;
            foreach ($items as $key => $item) {	
			$i++;
			$ptname=$item['yot']." ".$item['name']." ".$item['surname'];	
			
			$sql1="select hn from opcard where idcard='".$item['idcard']."'";
			$query1=mysql_query($sql1);
			list($hn)=mysql_fetch_array($query1);				
			
			
			if($item['opd_date'] !="0000-00-00 00:00:00"){
				$opddate=substr($item['opd_date'],0,10);
				$opd_date=displaydate($opddate);
			}else{
				$opd_date="-";
			}	
			
			$sqlchk1="select thidate from condxofyear_so where hn='$hn' and yearcheck='$yearcheck' order by row_id desc limit 1";
			//echo $sqlchk1."-->";
			$querychk1=mysql_query($sqlchk1);
			$numchk1=mysql_num_rows($querychk1);
			if($numchk1 > 0){	
				list($thidate)=mysql_fetch_array($querychk1);			
				
				$doctordate=substr($thidate,0,10);
				$doctor_date=displaydate($doctordate);	
				//echo "วันที่ ".$doctor_date."<br>";
			}else{
				if($item['doctor_date'] !="0000-00-00 00:00:00"){
					$doctordate=substr($item['doctor_date'],0,10);
					$doctor_date=displaydate($doctordate);
				}else{
					$doctor_date="-";
				}				
			}	                
				?>
                <tr>
                    <td align='center'><?=$i;?></td>
					<td align='center'><?=$item['row_id'];?></td>
                    <td><?=$hn;?></td>
                    <td><?=$ptname;?></td>
                    <td><?=$item['camp'];?></td>
					<td><?=$item['position'];?></td>
					<td><?=$item['ratchakan'];?></td>
					<td align="center"><?=$opd_date;?></td>
					<td align="center"><?=$doctor_date;?></td>
					<td><?=$item['comment'];?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
	<?
    $sqlnum = "SELECT * 
    FROM `register_chkup_soldier` 
    WHERE yearcheck='$yearcheck' and active='y'";
    //echo $sqlnum;
	$querynum=mysql_query($sqlnum);
	$numrow=mysql_num_rows($querynum);
	?>
	<div style="margin-top:10px;">
	<b><u>หมายเหตุ</u></b> แสดงข้อมูลเฉพาะกำลังพลที่ส่งรายชื่อตรวจตามข้อตกลงการชำระเงินในนามหน่วยต้นสังกัด จำนวน <?=$numrow;?> ราย เท่านั้น	
	</div>
    <?php
}
?>