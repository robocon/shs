<?php
session_start();
include("connect.inc");

// 2. รับค่าวันที่และแปลงเป็น พ.ศ.
$date_start_input = isset($_POST['date_start']) ? $_POST['date_start'] : date('Y-m-d');
$date_end_input   = isset($_POST['date_end']) ? $_POST['date_end'] : date('Y-m-d');

function convertToBE($date_string) {
    if(!$date_string) return "";
    $part = explode("-", $date_string);
    $year_be = $part[0] + 543;
    return $year_be . "-" . $part[1] . "-" . $part[2];
}

$start_be = convertToBE($date_start_input);
$end_be   = convertToBE($date_end_input);

// 3. SQL Query
$sql = "SELECT 
            p.date,
			p.code,			
            p.detail, 
            SUM(p.amount) AS total_amount,
            l.price, 
            l.costprice,
			(SUM(p.amount) * l.price) AS total_price_sum,
			(SUM(p.amount) * l.costprice) AS total_cost_sum			
        FROM patdata p 
        LEFT JOIN labcare l ON p.code = l.code
        WHERE (p.an IS NULL OR p.an ='') AND (p.date BETWEEN '$start_be 00:00:00' AND '$end_be 23:59:59')
        AND p.ptright LIKE 'R07%'
        AND p.part IN ('LAB','LABY','LABN','BLOOD','BLOODY','BLOODN') 
		AND p.amount > 0 
		GROUP BY p.code
        ORDER BY p.date ASC";
		//echo $sql;
$result = mysql_query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายงานต้นทุนค่าน้ำยา LAB สิทธิประกันสังคม</title>
    <style>
        /* โหลดฟอนต์สารบรรณ (ต้องมีไฟล์ฟอนต์ในเครื่องหรือ Server) */
        @font-face {
            font-family: 'THSarabunPSK';
            src: local('TH SarabunPSK'), local('THSarabunPSK');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'THSarabunPSK', sans-serif;
            font-size: 16pt;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 18pt;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px 8px;
            text-align: left;
            line-height: 1.2;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }

        /* สำหรับการพิมพ์ */
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
            @page { size: A4; margin: 1cm; }
        }
        
        .search-box {
            background: #e9ecef;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="no-print search-box">
    <form method="post">
        วันที่เริ่ม: <input type="date" name="date_start" value="<?php echo $date_start_input; ?>">
        ถึงวันที่: <input type="date" name="date_end" value="<?php echo $date_end_input; ?>">
        <button type="submit">ค้นหารายงาน</button>
        <button type="button" onclick="window.print()">พิมพ์รายงาน</button>
    </form>
</div>

<div class="header">
    รายงานต้นทุนค่าน้ำยา LAB ของผู้ป่วยสิทธิประกันสังคม<br>
    ตั้งแต่วันที่ <?php echo date('d/m/Y', strtotime($date_start_input)); ?> 
    ถึงวันที่ <?php echo date('d/m/Y', strtotime($date_end_input)); ?>
</div>

<table>
    <thead>
        <tr>
            <th width="10%">รหัส LAB</th>
            <th width="35%">รายการ LAB</th>
			<th width="10%">ราคาขาย</th>
			<th width="12%">ราคาต้นทุน</th>
            <th width="10%">จำนวนที่ทำ</th>
			<th width="12%">ราคาขายรวม</th>
            <th width="12%">ราคาต้นทุนรวม</th>
            
        </tr>
    </thead>
    <tbody>
        <?php 
        $total_price = 0;
		$total_cost = 0;
        if(mysql_num_rows($result) > 0): 
            while($row = mysql_fetch_assoc($result)): 
                $total_price += ($row['price'] * $row['total_amount']);
				$total_cost += ($row['costprice'] * $row['total_amount']);
        ?>
        <tr>
            <td class="text-center"><?php echo $row['code']; ?></td>
            <td><?php echo $row['detail']; ?></td>
            <td class="text-right"><?php echo number_format($row['price'], 2); ?></td>
			<td class="text-right"><?php echo number_format($row['costprice'], 2); ?></td>
            <td class="text-right"><?php echo number_format($row['total_amount'], 0); ?></td>
            <td class="text-right"><?php echo number_format($row['total_price_sum'], 2); ?></td>
            <td class="text-right"><?php echo number_format($row['total_cost_sum'], 2); ?></td>
        </tr>
        <?php endwhile; ?>
        <tr style="font-weight: bold; background-color: #eee;">
            <td colspan="5" class="text-right">รวมทั้งหมด</td>
            <td class="text-right"><?php echo number_format($total_price, 2); ?></td>
			<td class="text-right"><?php echo number_format($total_cost, 2); ?></td>
        </tr>
        <?php else: ?>
        <tr>
            <td colspan="8" class="text-center">-- ไม่พบข้อมูลในช่วงเวลาที่เลือก --</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<div style="margin-top: 30px; text-align: right;">
    ลงชื่อ.......................................................... ผู้จัดทำรายงาน<br>
    ( .......................................................... )<br>
    วันที่ออกรายงาน: <?php echo date('d/m/Y H:i'); ?>
</div>

</body>
</html>