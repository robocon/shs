<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="th" xml:lang="th">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>แก้ไขข้อมูลผู้ป่วย</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #6699ff;
            background: -moz-linear-gradient(-45deg, #6699ff 0%, #6666cc 100%);
            background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,#6699ff), color-stop(100%,#6666cc));
            background: -webkit-linear-gradient(-45deg, #6699ff 0%,#6666cc 100%);
            background: -o-linear-gradient(-45deg, #6699ff 0%,#6666cc 100%);
            background: -ms-linear-gradient(-45deg, #6699ff 0%,#6666cc 100%);
            background: linear-gradient(135deg, #6699ff 0%,#6666cc 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            background: #ffffff;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .header p {
            color: #7f8c8d;
            font-size: 16px;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.8);
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb a {
            color: #6699ff;
            text-decoration: none;
            font-weight: bold;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .edit-card {
            background: #ffffff;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #2c3e50;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 14px;
            background: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #6699ff;
            background-color: #f8f9ff;
        }

        .form-control:disabled {
            background-color: #f8f9fa;
            color: #6c757d;
        }

        .form-control select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 14px;
            background: #fff;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .btn-primary {
            background: #6699ff;
            color: white;
            box-shadow: 0 3px 10px rgba(102, 153, 255, 0.3);
        }

        .btn-primary:hover {
            background: #5588ee;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
        }

        .info-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #6699ff;
        }

        .info-section h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .info-row {
            display: block;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .info-label {
            font-weight: bold;
            color: #495057;
            display: inline-block;
            width: 150px;
            margin-right: 10px;
        }

        .info-value {
            color: #2c3e50;
        }

        .amount {
            font-weight: bold;
            color: #28a745;
            font-size: 16px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #17a2b8;
            color: #0c5460;
        }

        .status-section {
            background: #fff3cd;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #ffc107;
        }

        .status-section h3 {
            color: #856404;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .button-group {
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #dee2e6;
            margin-top: 20px;
        }

        @media screen and (max-width: 768px) {
            .info-label {
                width: 100%;
                display: block;
                margin-bottom: 5px;
            }
            
            .info-row {
                display: block;
                margin-bottom: 15px;
            }
            
            .btn {
                width: 100%;
                margin-right: 0;
                margin-bottom: 10px;
            }
            
            .header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>แก้ไขข้อมูลลูกหนี้ติด C จ่ายตรง</h1>
            <p>จัดการและแก้ไขสถานะข้อมูลลูกหนี้</p>
        </div>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="index.php">หน้าหลัก</a> &raquo; แก้ไขข้อมูลลูกหนี้
        </div>

        <?php
        // Database connection configuration
            $servername = "192.168.131.240";
            $username = "sm3db_user"; 
            $password = "sm3dbPassword";
            $dbname = "sm3db-utf8";

        // Initialize variables
        $patient_data = null;
        $error_message = '';
        $success_message = '';

        // Check if ID is provided
        if ((!isset($_GET['getdate']) && !isset($_GET['gethn'])) || (empty($_GET['getdate']) && empty($_GET['gethn']))) {
            $error_message = 'ไม่พบรหัสข้อมูลที่ต้องการแก้ไข';
        } else {
            $getdate = $_GET['getdate'];
			$gethn = $_GET['gethn'];
			$getbillno = intval($_GET['getbillno']);
			$invno = intval($_GET['invno']);
			$approvecode = intval($_GET['approvecode']);

            // Handle form submission
            if (isset($_POST['update_status'])) {
                // Create connection
                $connection = mysql_connect($servername, $username, $password);
                
                if (!$connection) {
                    $error_message = 'เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: ' . mysql_error();
                } else {
                    // Select database
                    $db_selected = mysql_select_db($dbname, $connection);
                    
                    if (!$db_selected) {
                        $error_message = 'ไม่สามารถเลือกฐานข้อมูลได้: ' . mysql_error();
                    } else {
                        // Set charset
                        mysql_query("SET NAMES utf8", $connection);
                        
                        // Update status
                        $new_status = mysql_real_escape_string($_POST['status']);
                        $update_sql = "UPDATE opacc SET typecscd = '$new_status' WHERE date='$getdate' AND hn='$gethn' AND billno='$getbillno' AND credit_detail='$approvecode' AND credit='จ่ายตรง' ";
                        //echo $update_sql;
						$update_result = mysql_query($update_sql, $connection);
                        
                        if ($update_result) {
                            $success_message = 'บันทึกข้อมูลเรียบร้อยแล้ว';
                        } else {
                            $error_message = 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . mysql_error();
                        }
                    }
                    
                    // Close connection
                    mysql_close($connection);
                }
            }

            // Fetch patient data
            $connection = mysql_connect($servername, $username, $password);
            
            if (!$connection) {
                $error_message = 'เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: ' . mysql_error();
            } else {
                // Select database
                $db_selected = mysql_select_db($dbname, $connection);
                
                if (!$db_selected) {
                    $error_message = 'ไม่สามารถเลือกฐานข้อมูลได้: ' . mysql_error();
                } else {
                    // Set charset
                    mysql_query("SET NAMES utf8", $connection);
                    
                    // Fetch data
                    $sql = "SELECT *,sum(paidcscd) AS sumpaidcscd FROM opacc WHERE date='$getdate' AND hn='$gethn' AND billno='$getbillno' AND credit_detail='$approvecode' AND credit='จ่ายตรง'  group by billno,credit_detail";
					//echo $sql;
					$result = mysql_query($sql, $connection);	
                    if (!$result) {
                        $error_message = 'เกิดข้อผิดพลาดในการค้นหาข้อมูล: ' . mysql_error();
                    } else {
                        $num_rows = mysql_num_rows($result);
                        
                        if ($num_rows > 0) {
                            $patient_data = mysql_fetch_assoc($result);
                        } else {
                            $error_message = 'ไม่พบข้อมูลที่ต้องการแก้ไข';
                        }
                        
                        // Free result
                        mysql_free_result($result);
                    }
					
					
					$sql12356 = "Select idcard,yot,name,surname From opcard where hn = '".$patient_data['hn']."'   ";
					//echo $sql1235 ;
					$result12356 = mysql_query($sql12356, $connection);	
					list($idcard,$yot,$name,$surname) = mysql_fetch_row($result12356);
					$patient_name=$yot.''.$name.'  '.$surname;						
					
                }
                
                // Close connection
                mysql_close($connection);
            }
        }

        // Display messages
        if (!empty($error_message)) {
            echo '<div class="alert alert-danger">' . $error_message . '</div>';
        }

        if (!empty($success_message)) {
            echo '<div class="alert alert-success">' . $success_message . '</div>';
        }

        // Display form if data exists
        if ($patient_data) {
            // Format date
            $service_date = $patient_data['date'];
			$service_txdate = $patient_data['txdate'];
            
            // Format amount
            $amount = '0.00';
            if (is_numeric($patient_data['sumpaidcscd'])) {
                $amount = number_format($patient_data['sumpaidcscd'], 2);
            }		
        ?>

        <!-- Patient Information -->
        <div class="edit-card">
            <div class="info-section">
                <h3>ข้อมูลผู้ป่วย</h3>
                <div class="info-row">
                    <span class="info-label">วันที่รับบริการ:</span>
                    <span class="info-value"><?php echo $service_txdate; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">วันที่เก็บลูกหนี้:</span>
                    <span class="info-value"><?php echo $service_date; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">HN:</span>
                    <span class="info-value"><?php echo htmlspecialchars($patient_data['hn']); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">VN:</span>
                    <span class="info-value"><?php echo htmlspecialchars($patient_data['vn']); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">ชื่อ-นามสกุล:</span>
                    <span class="info-value"><?php echo htmlspecialchars($patient_name); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Approve Code:</span>
                    <span class="info-value"><?php echo htmlspecialchars($patient_data['credit_detail']); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Bill No:</span>
                    <span class="info-value"><?php echo htmlspecialchars($patient_data['billno']); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">จำนวนเงินที่ขอเบิก:</span>
                    <span class="info-value amount">฿<?php echo $amount; ?></span>
                </div>
            </div>

            <!-- Status Update Form -->
            <div class="status-section">
                <h3>แก้ไขสถานะข้อมูล</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="status">สถานะข้อมูล:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">-- เลือกสถานะ --</option>
                            <option value="" <?php echo ($patient_data['typecscd'] == '') ? 'selected="selected"' : ''; ?>>ส่งข้อมูลผ่าน</option>
                            <option value="C" <?php echo ($patient_data['typecscd'] == 'C') ? 'selected="selected"' : ''; ?>>ติด C</option>
                            <option value="A" <?php echo ($patient_data['typecscd'] == 'A') ? 'selected="selected"' : ''; ?>>แก้ไขข้อมูลผ่าน</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <p><strong>สถานะปัจจุบัน:</strong> 
                        <?php 
                        $status_text = $patient_data['typecscd'];
                        if ($patient_data['typecscd'] == '') {
                            $status_text = 'ส่งข้อมูลผ่าน';
                        } elseif ($patient_data['typecscd'] == 'C') {
                            $status_text = 'ติด C';
                        } elseif ($patient_data['typecscd'] == 'A') {
                            $status_text = 'แก้ไขข้อมูลผ่าน';
                        }
                        echo '<span style="color: #dc3545; font-weight: bold;">' . $status_text . '</span>';
                        ?>
                        </p>
                    </div>

                    <div class="button-group">
                        <input type="submit" name="update_status" value="บันทึกข้อมูล" class="btn btn-success" />
                        <a href="index.php" class="btn btn-secondary">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>

        <?php
        } elseif (empty($error_message)) {
            echo '<div class="alert alert-info">กำลังโหลดข้อมูล...</div>';
        }
        ?>

        <!-- Back to search -->
        <div class="edit-card" style="text-align: center;">
            <a href="opacc_search_cscd.php" class="btn btn-primary">กลับไปหน้าค้นหา</a>
        </div>

    </div>

    <script type="text/javascript">
        // Auto-focus on status select when page loads
        window.onload = function() {
            var statusSelect = document.getElementById('status');
            if (statusSelect) {
                statusSelect.focus();
            }
        };

        // Add confirmation for form submission
        function confirmUpdate() {
            var status = document.getElementById('status').value;           
            var statusText = {
                '': 'ส่งข้อมูลผ่าน',
                'C': 'ติด C', 
                'A': 'แก้ไขข้อมูลผ่าน'
            };
            
            return confirm('คุณต้องการเปลี่ยนสถานะเป็น "' + statusText[status] + '" หรือไม่?');
        }

        // Change form submission to use custom confirm
        var form = document.querySelector('form');
        if (form) {
            form.onsubmit = function() {
                return confirmUpdate();
            };
        }
    </script>
</body>
</html>