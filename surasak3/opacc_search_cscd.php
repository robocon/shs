<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="th" xml:lang="th">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ระบบค้นหาข้อมูลลูกหนี้ผู้ป่วยจ่ายตรง</title>
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
            max-width: 1200px;
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

        .search-card {
            background: #ffffff;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .search-form {
            width: 100%;
        }

        .form-row {
            width: 100%;
            margin-bottom: 20px;
        }

        .form-group {
            float: left;
            width: 30%;
            margin-right: 5%;
        }

        .form-group.last {
            margin-right: 0;
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
        }

        .btn-primary {
            background: #6699ff;
            color: white;
            box-shadow: 0 3px 10px rgba(102, 153, 255, 0.3);
        }

        .btn-primary:hover {
            background: #5588ee;
        }

        .btn-success {
            background: #ffc107;
            color: black;
            padding: 6px 12px;
            font-size: 12px;
        }

        .btn-success:hover {
            background: #218838;
        }

        .results-card {
            background: #ffffff;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            overflow-x: auto;
            border-radius: 8px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            min-width: 1000px;
        }

        .table th {
            background: #6699ff;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 13px;
        }

        .table td {
            padding: 12px 8px;
            border-bottom: 1px solid #e1e8ed;
            font-size: 13px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .amount {
            font-weight: bold;
            color: #28a745;
            text-align: right;
        }

        .no-results {
            text-align: center;
            padding: 40px 20px;
            color: #7f8c8d;
        }

        .no-results h3 {
            font-size: 18px;
            margin-bottom: 10px;
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

        .alert-info {
            background-color: #d1ecf1;
            border-color: #17a2b8;
            color: #0c5460;
        }

        .clearfix {
            clear: both;
        }

        /* Simple responsive */
        @media screen and (max-width: 768px) {
            .form-group {
                float: none;
                width: 100%;
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .header h1 {
                font-size: 22px;
            }
            
            .table {
                font-size: 11px;
            }
            
            .table th,
            .table td {
                padding: 8px 4px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>ระบบค้นหาข้อมูลลูกหนี้ผู้ป่วยจ่ายตรง</h1>
            <p>ค้นหาและจัดการข้อมูลลูกหนี้</p>
        </div>

        <!-- Search Form -->
        <div class="search-card">
            <form method="POST" action="" class="search-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="service_date">วันที่รับบริการ</label>
                        <input type="text" 
                               class="form-control" 
                               id="service_date" 
                               name="service_date"
                               placeholder="yyyy-mm-dd"
                               value="<?php echo isset($_POST['service_date']) ? htmlspecialchars($_POST['service_date']) : ''; ?>" />
                    </div>
                    
                    <div class="form-group">
                        <label for="hn">HN ผู้ป่วย</label>
                        <input type="text" 
                               class="form-control" 
                               id="hn" 
                               name="hn" 
                               placeholder="กรอก HN ผู้ป่วย"
                               value="<?php echo isset($_POST['hn']) ? htmlspecialchars($_POST['hn']) : ''; ?>" />
                    </div>
                    
                    <div class="form-group last">
                        <label>&nbsp;</label>
                        <input type="submit" name="search" value="ค้นหาข้อมูล" class="btn btn-primary" />
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>

        <!-- Results -->
        <div class="results-card">
            <?php
            // Database connection configuration
            $servername = "192.168.131.240";
            $username = "sm3db_user"; 
            $password = "sm3dbPassword";
            $dbname = "sm3db-utf8";

            // Function to escape string for old MySQL
            function escape_string($string) {
                return mysql_real_escape_string($string);
            }

            // Function to format Thai date
            function format_thai_date($date) {
                if (empty($date) || $date == '0000-00-00') {
                    return '-';
                }
                
                $timestamp = strtotime($date);
                if ($timestamp === false) {
                    return $date;
                }
                
                return date('d/m/Y', $timestamp);
            }

            // Function to format amount
            function format_amount($amount) {
                if (is_numeric($amount)) {
                    return number_format($amount, 2);
                }
                return '0.00';
            }

            if (isset($_POST['search'])) {
                // Create connection using old MySQL extension
                $connection = mysql_connect($servername, $username, $password);
                
                if (!$connection) {
                    echo '<div class="alert alert-danger">เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: ' . mysql_error() . '</div>';
                } else {
                    // Select database
                    $db_selected = mysql_select_db($dbname, $connection);
                    
                    if (!$db_selected) {
                        echo '<div class="alert alert-danger">ไม่สามารถเลือกฐานข้อมูลได้: ' . mysql_error() . '</div>';
                    } else {
                        // Set charset
                        mysql_query("SET NAMES utf8", $connection);
                        
                        // Build query conditions
                        $conditions = array();
                        $service_date = '';
                        $hn = '';
                        
                        if (!empty($_POST['service_date'])) {
                            $service_date = escape_string($_POST['service_date']);
                            $conditions[] = "DATE(txdate) LIKE '$service_date'";
                        }
                        
                        if (!empty($_POST['hn'])) {
                            $hn = escape_string($_POST['hn']);
                            $conditions[] = "hn LIKE '%$hn%'";
                        }

                        if (empty($conditions)) {
                            echo '<div class="alert alert-info">กรุณาระบุเงื่อนไขการค้นหาอย่างน้อย 1 เงื่อนไข</div>';
                        } else {
                            // Execute query
                            $sql = "SELECT date,txdate,hn,vn,credit,credit_detail,billno,typecscd,sum(paidcscd) AS sumpaidcscd FROM opacc WHERE " . implode(" AND ", $conditions) . " AND credit='จ่ายตรง' group by credit_detail,billno ORDER BY row_id ASC";
                            //echo $sql;
							$result = mysql_query($sql, $connection);
                            
                            if (!$result) {
                                echo '<div class="alert alert-danger">เกิดข้อผิดพลาดในการค้นหา: ' . mysql_error() . '</div>';
                            } else {
                                $num_rows = mysql_num_rows($result);
                                
                                if ($num_rows > 0) {
                                    echo '<div class="alert alert-info">พบข้อมูล ' . $num_rows . ' รายการ</div>';
                                    echo '<div class="table-container">';
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>ลำดับ</th>';
                                    echo '<th>วันที่เก็บลูกหนี้</th>';
                                    echo '<th>HN</th>';
                                    echo '<th>VN</th>';
                                    echo '<th>ชื่อ-นามสกุล</th>';
                                    echo '<th>ลูกหนี้</th>';
									echo '<th>Approve Code</th>';
                                    echo '<th>Bill No</th>';
                                    echo '<th>สถานะ</th>';
									echo '<th>Statment No</th>';
                                    echo '<th>จำนวนเงิน</th>';
                                    echo '<th>ดำเนินการ</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    
                                    $counter = 1;
                                    while ($row = mysql_fetch_assoc($result)) {
                                        // Format date
                                        $service_date_formatted = format_thai_date($row['date']);
                                        
                                        // Format amount
                                        $amount = format_amount($row['sumpaidcscd']);
                                        
                                        // Status badge
                                        $status_class = 'status-active';
                                        $status_text = "";
										if ($row['credit'] == 'จ่ายตรง') {
											if ($row['typecscd'] == 'A') {
												$status_class = 'status-pending';
												$status_text = 'แก้ไขผ่าน';
											} elseif ($row['typecscd'] == 'C') {
												$status_class = 'status-cancelled';
												$status_text = 'ติด C';
											} elseif ($row['typecscd'] == '') {
												$status_text = 'ผ่าน';
											}
											
											$d=substr($row['txdate'],8,2);
											$m=substr($row['txdate'],5,2); 
											$y=substr($row['txdate'],0,4); 
											$y1=$y-543;

											$date="$y1$m$d";		
											$invbillno=str_replace(array("/"," "),'',$row['billno']);	
											$invbillno=sprintf('%05d',$invbillno);
											$invvn=sprintf('%03d',$row['vn']);

											$invno=$date.$invvn.$invbillno;  //อ้างอิง billtran.invno ขนาดข้อมูลต้อง >=9 && <= 16	
											$approvecode=$row['credit_detail'];
										
										
											$sql1="select accperiod	 from stm_cscd where hn='".$row['hn']."' and invno='".$invno."'";
											$query1=mysql_query($sql1);
											$rows1=mysql_fetch_array($query1);
											$accperiod=$rows1["accperiod"];										
										
										
										}else{
											$status_class = '';
											$status_text = "";
										}			
                                        
										$sql12356 = "Select idcard,yot,name,surname From opcard where hn = '".$row['hn']."'   ";
										//echo $sql1235 ;
										$result12356 = mysql_query($sql12356, $connection);	
										list($idcard,$yot,$name,$surname) = mysql_fetch_row($result12356);
										$patient_name=$yot.''.$name.'  '.$surname;									
										
                                        echo '<tr>';
                                        echo '<td>' . $counter . '</td>';
                                        echo '<td>' . $service_date_formatted . '</td>';
                                        echo '<td><strong>' . htmlspecialchars($row['hn']) . '</strong></td>';
                                        echo '<td>' . htmlspecialchars($row['vn']) . '</td>';
                                        echo '<td>' . htmlspecialchars($patient_name) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['credit']) . '</td>';
										echo '<td>' . htmlspecialchars($row['credit_detail']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['billno']) . '</td>';
                                        echo '<td><span class="status-badge ' . $status_class . '">' . $status_text . '</span></td>';
										echo '<td><strong style=color:blue;>' . htmlspecialchars($accperiod) . '</strong></td>';
                                        echo '<td class="amount">฿' . $amount . '</td>';
                                        if ($row['credit'] == 'จ่ายตรง') {
										echo '<td><a href="opacc_edit_cscd.php?getdate=' .$row['date']. '&gethn=' .$row['hn']. '&getbillno=' .$row['billno']. '&invno=' .$invno. '&approvecode=' .$approvecode. '" class="btn btn-success">แก้ไข</a></td>';
										}else{
										echo '<td></td>';	
										}	
                                        echo '</tr>';
                                        $counter++;
                                    }
                                    
                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                } else {
                                    echo '<div class="no-results">';
                                    echo '<h3>ไม่พบข้อมูล</h3>';
                                    echo '<p>ไม่พบข้อมูลที่ตรงกับเงื่อนไขการค้นหา กรุณาลองค้นหาด้วยเงื่อนไขอื่น</p>';
                                    echo '</div>';
                                }
                                
                                // Free result
                                mysql_free_result($result);
                            }
                        }
                    }
                    
                    // Close connection
                    mysql_close($connection);
                }
            } else {
                echo '<div class="no-results">';
                echo '<h3>ระบบพร้อมใช้งาน</h3>';
                echo '<p>กรุณาใส่เงื่อนไขการค้นหาและกดปุ่ม "ค้นหาข้อมูล" เพื่อเริ่มต้นการค้นหา</p>';
                echo '</div>';
            }
            ?>
			
        <!-- Back to search -->
        <div class="edit-card" style="text-align: center;">
            <p style="margin-top:20px;"><a href="index.php" class="btn btn-primary">🏠 หน้าหลักโปรแกรม</a>
			<span style="margin-left:20px;"><input type="button" value="🗂️ Approve Code" name="B2" class="btn btn-primary" onclick="window.open('report_approvecode.php','_blank')" /></span></p>
        </div>				
        </div>	
    </div>

    <script type="text/javascript">
        // Simple date validation
        function validateDate(dateString) {
            var regEx = /^\d{4}-\d{2}-\d{2}$/;
            return dateString.match(regEx) != null;
        }

        // Form validation
        document.getElementById('service_date').onblur = function() {
            var dateValue = this.value;
            if (dateValue && !validateDate(dateValue)) {
                alert('กรุณาใส่วันที่ในรูปแบบ yyyy-mm-dd เช่น 2024-01-31');
                this.focus();
            }
        };

        // Auto-focus on first input when page loads
        window.onload = function() {
            document.getElementById('service_date').focus();
        };
    </script>
</body>
</html>