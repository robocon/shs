<?php 

include 'bootstrap.php';

$day = sprintf("%02d", (empty($_POST['day']) ? date('d') : $_POST['day'] ));
$month = sprintf("%02d", (empty($_POST['month']) ? date('m') : $_POST['month'] ));
$year = sprintf("%d", (empty($_POST['year']) ? date('Y') : $_POST['year'] ));

$year_range = range(date('Y',strtotime("-5 year")), date('Y'));



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
		$chknPrefix="25".$nPrefix;
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดูการมาตรวจสุขภาพทหาร</title>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 18px;
        }
        .chk_table{
            border-collapse: collapse;
        }
        .chk_table th,
        .chk_table td{
            padding: 3px;
            border: 1px solid black;
        }
    </style>
    <form action="opday_dxofyear_so.php" method="post">
        <div>
            <h3>ค้นหารายชื่อตรวจสุขภาพทหาร</h3>
        </div>
        <div>
            
            เลือกวันที่ <?=getDateList('day', $day);?>
            เดือน <?=getMonthList('month', $month);?>
            ปี <?=getYearList('year', true, $year, $year_range);?>
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="search">
        </div>
    </form>
<?php
$page = sprintf("%s", $_POST['page']);
if($page==='search'){

    $dbi = new mysqli(HOST,USER,PASS,DB);
    $dbi->query("SET NAMES UTF8");

    $thidate = ($year+543)."-$month-$day";
    $sql = "SELECT `row_id` AS`opday_id`, `thidate` AS `opday_date`, `hn` AS `opday_hn`, `vn` AS `opday_vn`, `toborow`, `ptright`,
        `ptname` AS `opday_ptname`,`camp` AS `opday_camp`,CONCAT((SUBSTRING(`thidate`,1,4)-543),SUBSTRING(`thidate`,5,6),`hn`) AS `enDateHn` 
        FROM `opday` 
        WHERE `thidate` LIKE '$thidate%' 
        AND (`ptright` LIKE 'R22%' && `toborow` LIKE 'EX26%')";
		//echo $sql;
    $q = $dbi->query($sql);
    if($q->num_rows > 0){
        ?>
        <table class="chk_table" style="margin-top:8px;">
            <tr>
                <th>#</th>
                <th>ชื่อ-สกุล</th>
                <th>HN</th>
                <th>VN</th>
				<th>การมาโรงพยาบาล</th>
				<th>สิทธิการรักษา</th>
                <th>วันที่ลงทะเบียน</th>
                <th>วันที่ซักประวัติ/คัดกรอง</th>
				<th>วันที่แพทย์อ่านผล</th>
				<th>แพทย์</th>
                <th>สังกัด</th>
            </tr>
        
        <?php 
        $i = 1;
        
        while ($a = $q->fetch_assoc()) { 
            $style = '';

			
   $query="SELECT  thidate FROM dxofyear  WHERE hn = '".$a['opday_hn']."' and yearchk='$nPrefix' group by hn order by row_id desc";
  	//echo $query."<br>";
   $result = mysql_query($query);
   list($opddate)=mysql_fetch_array($result);
   
   $query1="SELECT  thidate,doctor FROM condxofyear_so  WHERE hn = '".$a['opday_hn']."' and yearcheck='$chknPrefix' group by hn order by row_id desc";
  	//echo $query;
   $result1 = mysql_query($query1);
   list($dxdate,$doctor)=mysql_fetch_array($result1);   
   
            if(empty($dxdate)){
                $style = 'style="background-color:#ffff92;"';
            }   
        ?>
            <tr>
                <td <?=$style;?>><?=$i;?></td>
                <td <?=$style;?>><?=$a['opday_ptname'];?></td>
                <td <?=$style;?>><?=$a['opday_hn'];?></td>
                <td <?=$style;?>><?=$a['opday_vn'];?></td>
				<td <?=$style;?>><?=$a['toborow'];?></td>
				<td <?=$style;?>><?=$a['ptright'];?></td>
                <td <?=$style;?>><?=$a['opday_date'];?></td>
                <td <?=$style;?>><?=$opddate;?></td>
				<td <?=$style;?>><?=$dxdate;?></td>
				<td <?=$style;?>><?=$doctor;?></td>
				<td <?=$style;?>><?=$a['opday_camp'];?></td>
            </tr>
        
        <?php
            $i++;
        }
        ?>
        </table>
        <?php
    }else{
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
}

?>
</body>
</html>