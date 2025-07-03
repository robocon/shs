<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ประวัติการใช้ยา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #dddddd;
        }
        .header {
            background-color: #2ecc71;
            color: white;
            padding: 1rem;
            position: relative;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        .close-btn {
            position: absolute;
            right: 1rem;
            top: 1rem;
            font-size: 2.2rem;
            color: yellow;
            text-decoration: none;
        }
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .btn-green {
            background-color: #27ae60;
            color: white;
        }
        .btn-green:hover {
            background-color: #219150;
        }

    .custom-drug-card {
        background: linear-gradient(135deg, #e6f9ed, #d0f2df);
        border: 1px solid #2ecc71;
        border-left: 6px solid #27ae60;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease-in-out, box-shadow 0.2s;
    }

    .custom-drug-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    .custom-drug-card .card-title {
        font-weight: 600;
        color: #229954;
    }

    .custom-drug-card .card-text {
        color: #2d3436;
    }
		
    </style>
</head>
<body>
<?php
include("connect.inc");
include("function.php");
$patient_id="54-7404";  //รับค่า  HN
$patient_name = "54-7404 : ส.อ.เทวิน ศรีแก้ว";  แสดงHN+ชื่อผู้รับบริการ
?>
<div class="container mt-5">
    <div class="card">
        <div class="header">
            <h4 class="mb-0">ประวัติการใช้ยา</h4>
            <a href="#" class="close-btn" onclick="window.close(); return false;">&times;</a>
        </div>
        <div class="card-body">
            <form method="post" class="row g-3 mb-4">
                <div class="h6 pb-2 mb-4 border-bottom border-success">ผู้รับบริการ <br><?php echo $patient_name;?></div>
				<div class="col-md-5">              
					<label class="form-label">เลือกรายการยา</label>
					 <?php
					// คำสั่ง SQL ดึงชื่อยา
					$sql = "SELECT drugcode,tradname FROM drugrx WHERE hn='$patient_id' AND an IS NULL GROUP BY drugcode ORDER BY drugcode ASC";			
					//echo $sql;
					$query = mysql_query($sql);			
					?>

					<select name="drug_code" class="form-select">
						<option value="">-- ทั้งหมด --</option>
						<?php while($row = mysql_fetch_array($query)) { ?>
							<option value="<?php echo $row['drugcode']; ?>">
								<?php echo htmlspecialchars($row['tradname']); ?>
							</option>
						<?php } ?>
					</select>
                </div>
                <div class="col-md-5">
                    <label class="form-label">เลือกวันที่ได้รับ</label>
					 <?php
					// คำสั่ง SQL ดึงชื่อยา
					$sql = "select substring(date,1,10) as showdate from drugrx where hn='$patient_id' and an is null group by substring(date,1,10) ORDER BY `date` DESC";			
					//echo $sql;
					$query = mysql_query($sql);			
					?>					
                    <select name="drug_date" class="form-select">
						<option value="">-- ทั้งหมด --</option>
						<?php while($row = mysql_fetch_array($query)) { ?>
							<option value="<?php echo $row['showdate']; ?>">
								<?php echo htmlspecialchars(displaydate_th($row['showdate'])); ?>
							</option>
						<?php } ?>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-green w-100">ค้นหา</button>
                </div>
            </form>
<div class="container mt-4">
    <!-- รายการยา -->
    <?php 
					// คำสั่ง SQL ดึงชื่อยา
					$drug_code=$_POST["drug_code"];
					$drug_date=$_POST["drug_date"];
					if(!empty($drug_code)&& empty($drug_date)){
						$sql = "SELECT drugcode,tradname,date,amount FROM drugrx WHERE hn='$patient_id' AND drugcode='$drug_code' AND amount > 0 AND an IS NULL ORDER BY date DESC";			
					}else if(!empty($drug_date) && empty($drug_code)){
						$sql = "SELECT drugcode,tradname,date,amount FROM drugrx WHERE hn='$patient_id' AND date LIKE '$drug_date%'  AND amount > 0 AND an IS NULL ORDER BY date DESC";			
					}else if(!empty($drug_code) && !empty($drug_date)){
						$sql = "SELECT drugcode,tradname,date,amount FROM drugrx WHERE hn='$patient_id' AND (drugcode='$drug_code'  AND amount > 0 AND date LIKE '$drug_date%') AND an IS NULL ORDER BY date DESC";			
					}else{
						$sql = "SELECT drugcode,tradname,date,amount FROM drugrx WHERE hn='$patient_id'  AND amount > 0 AND an IS NULL ORDER BY date DESC";
					}			
					//echo $sql;
					$query = mysql_query($sql);	
					$num=mysql_num_rows($query);					
					if($num > 0){
					while($item = mysql_fetch_array($query)){ ?>
						<div class="card custom-drug-card mb-3">
							<div class="card-body">
								<h5 class="card-title text-success">
									💊 <?= htmlspecialchars($item['tradname']) ?>
								</h5>
								<p class="card-text mb-1">
									<strong>📅 วันที่ได้รับ:</strong> <?= $item['date'] ?>
								</p>
								<p class="card-text">
									<strong>🔢 จำนวน:</strong> <?= $item['amount'] ?> 
								</p>
							</div>
						</div>
					<?php } ?>

					<?php 
					}else{ ?>
						<div class="alert alert-warning text-center">
							ไม่พบประวัติการใช้ยาตามที่เลือก
						</div>
					<?php } ?>
</div>
        </div>
    </div>
</div>

</body>
</html>
