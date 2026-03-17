<?php   
include("connect.inc");

// --- ส่วนที่เพิ่มใหม่: จัดการการคืนสถานะ (Undo Cancel) ---
// ตรวจสอบว่ามีการส่งคำขอ "คืนสถานะ" มาหรือไม่
if(isset($_GET["action"]) && $_GET["action"] == "undo_cancel"){
    
    $rid = $_GET["row_id"];
    
    // ตรวจสอบความปลอดภัยเบื้องต้น (ป้องกัน SQL Injection สำหรับ PHP รุ่นเก่า)
    if(is_numeric($rid) || !empty($rid)){
        $rid = mysql_real_escape_string($rid);
        
        // คำสั่ง UPDATE โดยกำหนดให้เป็น NULL (ไม่มีเครื่องหมาย ' ')
        $sql = "UPDATE dphardep SET dr_cancle = NULL WHERE row_id = '$rid'";
        
        if(mysql_query($sql)){
            // เมื่อสำเร็จ ให้ Refresh หน้าตัวเองเพื่อแสดงผลล่าสุด
            // (ส่งค่าวันที่เดิมกลับไปด้วยเพื่อให้ List ไม่หาย)
            header("Location: drxlist.php?d=".$_GET["d"]."&m=".$_GET["m"]."&yr=".$_GET["yr"]."&vn_drx=".$_GET["vn_drx"]);
            exit;
        } else {
            echo "Error updating record: " . mysql_error();
        }
    }
}
// -------------------------------------------------------

if(isset($_GET["action"]) && $_GET["action"] =="refresh"){
    header("content-type: application/x-javascript; charset=UTF-8");
}

$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการใบสั่งยา - <?php echo $today; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Sarabun', sans-serif; background-color: #f4f7f6; color: #333; }
        .main-card { border: none; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-top: 20px; }
        .header-section { background: linear-gradient(135deg, #6495ED 0%, #4169E1 100%); color: white; padding: 20px; border-radius: 15px 15px 0 0; display: flex; justify-content: space-between; align-items: center; }
        .table thead th { background-color: #f8f9fa; color: #555; font-weight: 600; border-bottom: 2px solid #dee2e6; text-align: center; white-space: nowrap; }
        .table tbody td { vertical-align: middle; text-align: center; }
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; }
        .btn-nav { background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.4); transition: all 0.3s; text-decoration: none; padding: 8px 15px; border-radius: 8px; font-size: 0.9rem; }
        .btn-nav:hover { background: white; color: #4169E1; }
        a { text-decoration: none; color: #007bff; }
        /* สไตล์เพิ่มเติมสำหรับปุ่มคืนสถานะ */
        .btn-undo { font-size: 0.7rem; padding: 1px 6px; margin-left: 5px; vertical-align: middle; }
    </style>

    <script>
        function newXmlHttp(){
            var xmlhttp = false;
            try{ xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); }
            catch(e){
                try{ xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }
                catch(e){ xmlhttp = false; }
            }
            if(!xmlhttp && document.createElement){ xmlhttp = new XMLHttpRequest(); }
            return xmlhttp;
        }

        function searchSuggest() {
            var url = 'drxlist.php?action=refresh&d=<?php echo $_GET["d"];?>&m=<?php echo $_GET["m"];?>&yr=<?php echo $_GET["yr"];?>&vn_drx=<?php echo $_GET["vn_drx"];?>';
            var xmlhttp = newXmlHttp();
            xmlhttp.open("GET", url, false);
            xmlhttp.send(null);
            var listEl = document.getElementById("list");
            if(listEl) listEl.innerHTML = xmlhttp.responseText;
            setTimeout("searchSuggest();", 20000);
        }
    </script>
</head>
<body onload="if('<?php echo $_GET["action"];?>' != 'refresh') setTimeout('searchSuggest()', 20000);">

<div class="container-fluid px-4">
    <div class="card main-card">
        <div class="header-section">
            <div>
                <h4 class="mb-0">
                    <i class="fa-solid fa-file-medical-pulse me-2"></i>
                    รายการใบสั่งยาจากแพทย์ ประจำวันที่ <?php echo $today; ?>
                </h4>
            </div>
            <div>
                <a href="../nindex.htm" class="btn-nav me-2"><i class="fa-solid fa-house me-1"></i> ไปเมนู</a>
                <a href="drx1date.php" class="btn-nav"><i class="fa-solid fa-calendar-day me-1"></i> เลือกวันที่ใหม่</a>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive" id="list">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><i class="fa-solid fa-hashtag me-1"></i> VN</th>
                            <th><i class="fa-solid fa-clock me-1"></i> เวลา</th>
                            <th><i class="fa-solid fa-user me-1"></i> ชื่อ-นามสกุล</th>
                            <th><i class="fa-solid fa-id-card me-1"></i> HN</th>
                            <th><i class="fa-solid fa-baht-sign me-1"></i> ค่ายา</th>
                            <th><i class="fa-solid fa-hand-holding-heart me-1"></i> สิทธิ</th>
                            <th><i class="fa-solid fa-user-md me-1"></i> แพทย์</th>
                            <th>คิวแพทย์</th>
                            <th>คิวห้องยา</th>
                            <th>เวลารับใบสั่ง</th>
                            <th>เวลาตัดสต็อก</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT tvn, date, ptname, hn, price, row_id, accno, ptright, doctor, stkcutdate, kew, kewphar, pharin, dr_cancle 
                              FROM dphardep 
                              WHERE whokey='DR' AND date LIKE '$today%' 
                              AND tvn = '".$_GET["vn_drx"]."' AND department ='' 
                              ORDER BY stkcutdate, hn DESC";
                    
                    $result = mysql_query($query) or die("Query failed");
                    $num = mysql_num_rows($result);

                    while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin, $dr_cancle) = mysql_fetch_row ($result)) {
                        
                        $time = substr($date,11);
                        $chkptright = substr($ptright,0,3);
                        $ptBadgeClass = ($chkptright=="R01" || $chkptright=="R04") ? "bg-danger" : "bg-info text-dark";
                        
                        // ปรับปรุงเงื่อนไขการแสดงผลสีแถวและปุ่มคืนสถานะ
                        if ($dr_cancle == '1') {
                            $rowStyle = "table-danger opacity-75"; 
                            
                            // สร้าง URL สำหรับปุ่มคืนสถานะ
                            $undoUrl = "drxlist3.php?action=undo_cancel&row_id=$row_id&d=".$_GET["d"]."&m=".$_GET["m"]."&yr=".$_GET["yr"]."&vn_drx=".$_GET["vn_drx"];
                            
                            $cancelText = "<div class='text-danger fw-bold' style='font-size:0.75rem;'>";
                            $cancelText .= "<i class='fa-solid fa-ban'></i> ถูกยกเลิกโดยแพทย์ ";
                            // ปุ่มคืนสถานะ
                            $cancelText .= "<a href='$undoUrl' class='btn btn-outline-primary btn-undo' onclick=\"return confirm('ยืนยันการคืนสถานะใบสั่งยาของ $ptname หรือไม่?')\"><i class='fa-solid fa-rotate-left'></i> คืนสถานะ</a>";
                            $cancelText .= "</div>";
                            
                            $ptNameStyle = "text-decoration-line-through text-muted"; 
                        } else {
                            $rowStyle = ($stkcutdate == "") ? "table-warning" : "";
                            $cancelText = "";
                            $ptNameStyle = "";
                        }
                        
                        echo "<tr class='$rowStyle'>";
                        echo "<td>$num</td>";
                        echo "<td><strong>$tvn</strong></td>";
                        echo "<td><span class='badge bg-light text-dark border'>$time</span></td>";
                        
                        echo "<td class='text-start'>";
                        echo "<a href='drxdetail.php?sDate=$date&nRow_id=$row_id&nAccno=$accno&sPtright=$ptright&sVn=$tvn' class='$ptNameStyle'><strong>$ptname</strong></a>";
                        echo $cancelText; 
                        echo "</td>";

                        echo "<td>$hn</td>";
                        echo "<td class='text-end fw-bold text-primary'>" . number_format($price, 2) . "</td>";
                        echo "<td><span class='status-badge $ptBadgeClass'>$ptright</span></td>";
                        echo "<td>$doctor</td>";
                        echo "<td><span class='badge rounded-pill bg-secondary'>$kew</span></td>";
                        echo "<td><span class='badge rounded-pill bg-dark'>$kewphar</span></td>";
                        echo "<td><small class='text-muted'>$pharin</small></td>";
                        
                        echo "<td>";
                        if ($dr_cancle == '1') {
                            echo "<span class='text-muted'><i class='fa-solid fa-circle-xmark'></i> ยกเลิกรายการ</span>";
                        } else {
                            echo ($stkcutdate ? "<i class='fa-solid fa-check-circle text-success'></i> $stkcutdate" : "<i class='fa-solid fa-hourglass-half text-warning'></i> รอตัดสต็อก");
                        }
                        echo "</td>";
                        echo "</tr>";
                        
                        $num--;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-3 text-center text-muted">
        <small><i class="fa-solid fa-sync fa-spin me-1"></i> หน้าจอจะอัปเดตอัตโนมัติทุก 20 วินาที</small>
    </div>
</div>

</body>
</html>
<?php include("unconnect.inc"); ?>