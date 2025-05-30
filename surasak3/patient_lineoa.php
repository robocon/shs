<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ประวัติการรักษา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9f9;
        }
        .header {
            background-color: #5499c7;
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
            background-color: #5dade2;
            color: white;
        }
        .btn-green:hover {
            background-color: #2980b9;
        }

    .custom-drug-card {
        background: linear-gradient(135deg, #d6eaf8, #d6eaf8);
        border: 1px solid #2980b9;
        border-left: 6px solid #5dade2;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease-in-out, box-shadow 0.2s;
		width: 98%;
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
$patient_name = "54-7404 : ส.อ.เทวิน ศรีแก้ว"; // แสดงHN+ชื่อผู้รับบริการ
?>
<div class="container mt-5">
    <div class="card">
        <div class="header">
            <h4 class="mb-0">ประวัติการรักษา</h4>
            <a href="#" class="close-btn" onclick="window.close(); return false;">&times;</a>
        </div>
        <div class="card-body">
            <form method="post" class="row g-3 mb-4">
                <div class="h6 pb-2 mb-4 border-bottom border-success">ผู้รับบริการ <br><?php echo $patient_name;?></div>
				<div class="col-md-5">              
					<label class="form-label">เลือกคลินิก/แผนก</label>
					 <?php
					// คำสั่ง SQL ดึงชื่อยา
					$sql = "SELECT clinic FROM opday WHERE thidate >='2566-01-01 00:00:00' AND hn='$patient_id' AND clinic !='' AND an IS NULL GROUP BY clinic ORDER BY clinic ASC";			
					//echo $sql;
					$query = mysql_query($sql);			
					?>

					<select name="clinic_code" class="form-select">
						<option value="">-- ทั้งหมด --</option>
						<?php while($row = mysql_fetch_array($query)) { ?>
							<option value="<?php echo $row['clinic']; ?>">
								<?php echo htmlspecialchars($row['clinic']); ?>
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
					$clinic_code=$_POST["clinic_code"];
					if(!empty($clinic_code)){
						$sql = "SELECT thidate,clinic,toborow FROM opday WHERE thidate >='2566-01-01 00:00:00' AND hn='$patient_id' AND clinic='$clinic_code' AND an IS NULL ORDER BY thidate DESC";				
					}else{
						$sql = "SELECT thidate,clinic,toborow FROM opday WHERE thidate >='2566-01-01 00:00:00' AND hn='$patient_id' AND an IS NULL ORDER BY thidate DESC";
					}			
					//echo $sql;
					$query = mysql_query($sql);	
					$num=mysql_num_rows($query);					
					if($num > 0){
					while($item = mysql_fetch_array($query)){ 
					if($item['clinic']=="อื่นๆ" || $item['clinic']==""){
						$clinic_name="คลินิกอื่นๆ";
					}else{
						$clinic_name=$item['clinic'];
					}
					$toborow=substr($item['toborow'],5);
					if($toborow=="" || $toborow=="ออก VN" || $toborow=="ออก VN โดยตู้ Kiosk"){
						$toborow_name="รักษาโรคทั่วไป";
					}else{
						$toborow_name=$toborow;
					}

					list($date,$time)=explode(" ",$item['thidate']);
					$date_th=displaydate_th($date);
					$thidate=$date_th." เวลา ".$time." น.";
					?>
						<div class="card custom-drug-card mb-3">
							<div class="card-body">
								<h5 class="card-title text-success">
									🏥 <?= htmlspecialchars($clinic_name) ?>
								</h5>
								<p class="card-text mb-1">
									<strong>🩺 การมารับบริการ: </strong> <?= $toborow_name ?>
								</p>
								<p class="card-text mb-1">
									<strong>📅 วันที่มารับบริการ: </strong> <?= $thidate ?>
								</p>
							</div>
						</div>
					<?php } ?>

					<?php 
					}else{ ?>
						<div class="alert alert-warning text-center">
							ไม่พบประวัติการมารับบริการตามที่เลือก
						</div>
					<?php } ?>
</div>
        </div>
    </div>
</div>

</body>
</html>
