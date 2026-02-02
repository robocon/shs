<?php
session_start();
include("connect.inc");

// ส่วนจัดการการ UPDATE
if(isset($_POST["act"]) && $_POST["act"]=="edit"){
    if(isset($_POST["submit_update"]) && !empty($_POST["row_id"])){
        $status = ($_POST["submit_update"] == "ล็อกยา") ? "N" : "Y";
        $ids = implode("','", $_POST["row_id"]);
        
        // กำหนด Field ที่จะ Update ตามเงื่อนไขการค้นหาล่าสุด
        $field = ($_POST["lock_type"] == "opd") ? "`lock`" : "`lock_ipd`";
        $sql = "UPDATE druglst SET $field = '$status' WHERE row_id IN ('$ids')";
        
        if(mysql_query($sql)){
            echo "<script>alert('ปรับปรุงสถานะเรียบร้อยแล้ว'); window.location.href=window.location.href;</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการสถานะการจ่ายยา</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root { 
            --primary: #3366FF; 
            --danger: #ef4444; 
            --success: #22c55e;
            --warning: #f59e0b;
            --bg-locked: #fff1f2; /* แดงระเรื่อสำหรับแถวที่ล็อค */
            --bg-normal: #ffffff;
        }
        body { font-family: 'Sarabun', sans-serif; background: #f1f5f9; margin: 0; padding: 20px; }
        .container { max-width: 1400px; margin: 0 auto; }
        
        /* Search Panel */
        .search-panel { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); margin-bottom: 20px; border-top: 4px solid var(--primary); }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; align-items: flex-end; }
        select, button { padding: 12px; border-radius: 8px; border: 1px solid #cbd5e1; font-family: 'Sarabun'; font-size: 15px; }
        .btn-search { background: var(--primary); color: white; border: none; cursor: pointer; font-weight: 600; transition: 0.2s; }
        .btn-search:hover { background: #1e40af; }
        
        /* Table Style */
        .table-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1); }
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 1000px; }
        th { background: #f8fafc; color: #475569; padding: 15px; text-align: left; border-bottom: 2px solid #e2e8f0; font-weight: 600; }
        td { padding: 12px 15px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        
        /* Row Status */
        .row-has-lock { background-color: var(--bg-locked); }
        .row-normal { background-color: var(--bg-normal); }
        tr:hover { filter: brightness(0.98); }

        /* Badge Styles */
        .badge { padding: 4px 10px; border-radius: 6px; font-size: 13px; font-weight: 600; display: inline-block; }
        .badge-ed { background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; } /* เขียว ED */
        .badge-ned { background-color: #fef3c7; color: #92400e; border: 1px solid #fde68a; } /* ส้ม NED */
        
        /* Lock Indicators */
        .lock-indicator { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; margin-right: 4px; }
        .is-locked { background: var(--danger); color: white; }
        .is-open { background: var(--success); color: white; }
        
        .action-bar { padding: 25px; text-align: center; background: #f8fafc; border-top: 1px solid #e2e8f0; }
        .btn-lock { background: var(--danger); color: white; padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; transition: 0.2s; }
        .btn-unlock { background: var(--success); color: white; padding: 12px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; transition: 0.2s; }
        .btn-lock:hover, .btn-unlock:hover { transform: translateY(-2px); opacity: 0.9; }

        code { background: #f1f5f9; padding: 2px 5px; border-radius: 4px; color: #e11d48; }
    </style>
</head>
<body>

<div class="container">
    <div class="search-panel">
        <h3 style="margin-top:0; color:var(--primary); display:flex; align-items:center; gap:10px;">
            <span>💊 ระบบจัดการสถานะ Lock การจ่ายยา</span>
        </h3>
        <form method="POST" action="">
            <input name="act" type="hidden" value="show">
            <div class="grid">
                <div>
                    <label style="font-weight:600; font-size:14px; color:#64748b;">ประเภทยา:</label>
                    <select name="part" style="width:100%; margin-top:5px;">
                        <option value="">ทั้งหมด (ED/NED)</option>
                        <option value="DDL" <?php if($_POST["part"]=="DDL") echo "selected"; ?>>ยาหลักแห่งชาติ (ED)</option>
                        <option value="DDY" <?php if($_POST["part"]=="DDY") echo "selected"; ?>>นอกบัญชี เบิกได้ (NED)</option>
                        <option value="DDN" <?php if($_POST["part"]=="DDN") echo "selected"; ?>>นอกบัญชี เบิกไม่ได้ (NED)</option>
                    </select>
                </div>
                <div>
                    <label style="font-weight:600; font-size:14px; color:#64748b;">สถานะการล็อค:</label>
                    <select name="lock" style="width:100%; margin-top:5px;">
                        <option value="">ทั้งหมด</option>
                        <option value="OPD_Y" <?php if($_POST["lock"]=="OPD_Y") echo "selected"; ?>>OPD: ปกติ</option>
                        <option value="OPD_N" <?php if($_POST["lock"]=="OPD_N") echo "selected"; ?>>OPD: ล็อก</option>
                        <option value="IPD_Y" <?php if($_POST["lock"]=="IPD_Y") echo "selected"; ?>>IPD: ปกติ</option>
                        <option value="IPD_N" <?php if($_POST["lock"]=="IPD_N") echo "selected"; ?>>IPD: ล็อก</option>
                    </select>
                </div>
                <button type="submit" name="submit_search" value="1" class="btn-search">🔍 ค้นหาข้อมูล</button>
            </div>
        </form>
    </div>
	
<div style="padding:10px 20px; display:flex; gap:10px; background:#f8fafc;">
    <button type="button" onclick="exportData('excel')" class="btn-unlock" style="background:#16a34a;">📊 Export Excel</button>
    <button type="button" onclick="exportData('pdf')" class="btn-lock" style="background:#e11d48;">📄 Export PDF</button>
</div>

    <?php if($_POST["act"]=="show"){ 
        $where = "drug_active='y'";
        if(!empty($_POST["part"])) $where .= " AND part = '".$_POST["part"]."'";
        else $where .= " AND part LIKE 'DD%'";

        if(!empty($_POST["lock"])){
            if($_POST["lock"] == "OPD_Y") $where .= " AND `lock` ='Y'";
            if($_POST["lock"] == "OPD_N") $where .= " AND `lock` ='N'";
            if($_POST["lock"] == "IPD_Y") $where .= " AND `lock_ipd` ='Y'";
            if($_POST["lock"] == "IPD_N") $where .= " AND `lock_ipd` ='N'";
        }
        
        $result = mysql_query("SELECT * FROM druglst WHERE $where ORDER BY tradname ASC");
        $num = mysql_num_rows($result);
    ?>

    <form method="POST" action="">
        <input name="act" type="hidden" value="edit">
        <input name="lock_type" type="hidden" value="<?php echo (strpos($_POST["lock"],'IPD')!==false)?'ipd':'opd'; ?>">
        
        <div class="table-card">
            <div style="padding:15px 20px; background:#f8fafc; border-bottom:1px solid #e2e8f0;">
                พบรายการยา <span style="color:var(--danger); font-size:18px; font-weight:bold;"><?php echo number_format($num); ?></span> รายการ
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th width="60" style="text-align:center">#</th>
                            <th width="120">รหัสยา</th>
                            <th>ชื่อยา (Trade / Generic Name)</th>
                            <th width="100">บัญชียา</th>
                            <th width="180">สถานะการล็อค</th>
                            <th width="120" style="text-align:right">ราคา</th>
                            <th width="80" style="text-align:center">เลือก</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=0;
                        while($arr = mysql_fetch_assoc($result)){ 
                            $i++;
                            $is_opd_locked = ($arr["lock"] == "N");
                            $is_ipd_locked = ($arr["lock_ipd"] == "N");
                            
                            // ถ้ามีการล็อคอย่างใดอย่างหนึ่ง ให้ไฮไลท์แถว
                            $row_class = ($is_opd_locked || $is_ipd_locked) ? "row-has-lock" : "row-normal";
                            
                            // แยกสี Badge ED/NED
                            if($arr["part"]=="DDL") {
                                $part_label = "ED";
                                $part_class = "badge-ed";
                            } else {
                                $part_label = "NED";
                                $part_class = "badge-ned";
                            }
                        ?>
                        <tr class="<?php echo $row_class; ?>">
                            <td align="center" style="color:#64748b; font-size:13px;"><?php echo $i; ?></td>
                            <td><code><?php echo $arr["drugcode"]; ?></code></td>
                            <td>
                                <div style="font-weight:600; color:#1e293b;"><?php echo $arr["tradname"]; ?></div>
                                <div style="font-size:13px; color:#64748b; font-style:italic;"><?php echo $arr["genname"]; ?></div>
                            </td>
                            <td><span class="badge <?php echo $part_class; ?>"><?php echo $part_label; ?></span></td>
                            <td>
                                <span class="lock-indicator <?php echo $is_opd_locked ? 'is-locked':'is-open'; ?>">
                                    OPD: <?php echo $is_opd_locked ? 'LOCK':'OPEN'; ?>
                                </span>
                                <span class="lock-indicator <?php echo $is_ipd_locked ? 'is-locked':'is-open'; ?>">
                                    IPD: <?php echo $is_ipd_locked ? 'LOCK':'OPEN'; ?>
                                </span>
                            </td>
                            <td align="right" style="font-weight:600; color:#0f172a;">
                                <?php echo number_format($arr["salepri"], 2); ?>
                            </td>
                            <td align="center">
                                <input type="checkbox" name="row_id[]" value="<?php echo $arr["row_id"]; ?>" style="width:20px; height:20px; cursor:pointer;">
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
            <div class="action-bar">
                <div style="margin-bottom:15px; font-size:14px; color:#64748b;">
                    * เลือกรายการยาที่ต้องการ แล้วกดปุ่มเพื่อเปลี่ยนสถานะ (อ้างอิงตามประเภทการล็อคที่เลือกค้นหา)
                </div>
                <button type="submit" name="submit_update" value="ล็อกยา" class="btn-lock">🔒 ล็อกการจ่ายยา</button>
                <button type="submit" name="submit_update" value="ไม่ล็อกยา" class="btn-unlock">🔓 ปลดล็อกการจ่ายยา</button>
            </div>
        </div>
    </form>
    <?php } ?>
</div>
<script>
function exportData(type) {
    const form = document.querySelector('form[method="POST"]');
    const prevAction = form.action;
    const targetFile = (type === 'excel') ? 'export_lock_drug.php' : 'export_pdf.php';
    
    // สร้าง Hidden Input ชั่วคราวเพื่อส่งค่าค้นหาไปด้วย
    form.action = targetFile;
    form.target = '_blank';
    form.submit();
    
    // คืนค่าเดิมให้ Form
    form.action = prevAction;
    form.target = '_self';
}
</script>
</body>
</html>