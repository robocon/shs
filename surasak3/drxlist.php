<?php  
if(isset($_GET["action"]) && $_GET["action"] =="refresh"){
    header("content-type: text/html; charset=UTF-8");
}
include("connect.inc");

// ส่วนของการ Refresh ข้อมูลผ่าน AJAX
if(isset($_GET["action"]) && $_GET["action"] =="refresh"){
    $today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
    
    // Query เดิม
    $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew,kewphar,pharin,idname FROM dphardep WHERE whokey='DR' and date LIKE '$today%' AND dr_cancle is null AND department ='' ORDER BY stkcutdate, hn DESC ";
    $result = mysql_query($query) or die("Query failed");
    $num = mysql_num_rows($result);

    echo "<div class='d-flex justify-content-between align-items-center mb-2'>
            <span class='badge bg-primary fs-6'><i class='fas fa-list-ol me-2'></i>จำนวนทั้งหมด $num รายการ</span>
          </div>";

    print ("<div class='table-responsive'>
    <table class='table table-hover align-middle shadow-sm'>
     <thead class='table-dark'>
        <tr class='text-center'>
            <th>#</th>
            <th><i class='fas fa-fingerprint'></i> VN</th>
            <th><i class='fas fa-clock'></i> เวลา</th>
            <th><i class='fas fa-user'></i> ชื่อ-นามสกุล</th>
            <th><i class='fas fa-id-card'></i> HN</th>
            <th><i class='fas fa-hand-holding-usd'></i> ค่ายา</th>
            <th><i class='fas fa-file-medical'></i> สิทธิการรักษา</th>
            <th><i class='fas fa-user-md'></i> แพทย์</th>
            <th><i class='fas fa-user-edit'></i> ผู้บันทึก</th>
            <th>คิวแพทย์</th>
            <th>คิวห้องยา</th>
            <th>เวลารับใบสั่ง</th>
            <th><i class='fas fa-check-circle'></i> ตัดสต็อก</th>
            <th><i class='fas fa-virus'></i> COVID-19</th>
        </tr>
     </thead>
     <tbody>");

    while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin,$idname) = mysql_fetch_row ($result)) {
        $time = substr($date,11);
        $y = substr($date,0,4);
        $m = substr($date,5,2);
        $d = substr($date,8,2);
        $thdatehn = "$d-$m-$y$hn";
    
        $sql2 = "select * from opselfisolation where thdatehn='$thdatehn'";
        $query2 = mysql_query($sql2);
        $num2 = mysql_num_rows($query2);
        
        $opsi = ($num2 < 1) ? "" : "<a href='opselfisolation_print.php?hn=$hn&thidatehn=$thdatehn' target='_BLANK' class='btn btn-sm btn-outline-danger'><i class='fas fa-file-pdf'></i> ดูข้อมูล</a>";

        // กำหนดสีแถว: ถ้ายังไม่ตัดสต็อก (Pending) ให้ใช้สีเขียวอ่อน/เหลือง
        $row_class = ($stkcutdate == "") ? "table-warning" : "";
        $status_icon = ($stkcutdate == "") ? "<span class='badge bg-secondary'><i class='fas fa-hourglass-half fa-spin'></i> รอตัด</span>" : "<span class='badge bg-success'><i class='fas fa-check'></i> $stkcutdate</span>";

        print "<tr class='$row_class text-center'>\n".
              "  <td>$num</td>\n".
              "  <td><small class='text-muted'>$tvn</small></td>\n".
              "  <td><span class='badge bg-light text-dark border'>$time</span></td>\n";
        
        if($tvn==""){
            print "  <td class='text-start'>$ptname</td>\n";
        }else{
            print "  <td class='text-start'><a href=\"drxdetail.php?sDate=$date&nRow_id=$row_id&nAccno=$accno&sPtright=$ptright&sVn=$tvn\" target='_BLANK' class='text-decoration-none fw-bold text-primary'>$ptname</a></td>\n";
        }

        print "  <td>$hn</td>\n".
              "  <td class='text-end fw-bold text-success'>".number_format($price,2)."</td>\n".
              "  <td align='left'><small>$ptright</small></td>\n".
              "  <td align='left'><small>$doctor</small></td>\n".
              "  <td align='right'><small>$idname</small></td>\n".
              "  <td><span class='badge rounded-pill bg-info text-dark'>$kew</span></td>\n".
              "  <td><span class='badge rounded-pill bg-dark'>$kewphar</span></td>\n".
              "  <td><small class='text-muted'>$pharin</small></td>\n".
              "  <td>$status_icon</td>\n".
              "  <td>$opsi</td>\n".
              " </tr>\n";
        $num--;
    }
    print ("</tbody></table></div>");
    exit();
}

$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายการใบสั่งยาจากแพทย์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #f8f9fa;
        }
        .header-banner {
            background: linear-gradient(135deg, #17A589 0%, #117A65 100%);
            color: white;
            padding: 20px;
            border-radius: 0 0 20px 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .search-box {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .table { font-size: 0.95rem; }
        .table thead th { font-weight: 500; letter-spacing: 0.5px; }
        .btn-menu {
            transition: all 0.3s;
            text-decoration: none;
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
        }
        .btn-menu:hover { color: white; transform: translateY(-2px); }
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
            var url = 'drxlist.php?action=refresh&d=<?php echo $_GET["d"];?>&m=<?php echo $_GET["m"];?>&yr=<?php echo $_GET["yr"];?>';
            var xmlhttp = newXmlHttp();
            xmlhttp.open("GET", url, false);
            xmlhttp.send(null);
            document.getElementById("list").innerHTML = xmlhttp.responseText;
            setTimeout("searchSuggest();", 20000);
        }
        
        // เริ่มทำงานครั้งแรก
        window.onload = function() {
            searchSuggest();
        };
    </script>
</head>

<body>

<div class="header-banner">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="mb-0"><i class="fas fa-prescription-bottle-medical me-2"></i> รายการใบสั่งยา</h2>
                <p class="mb-0 opacity-75">ประจำวันที่ <?php echo $today; ?></p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="../nindex.htm" class="btn-menu me-3"><i class="fas fa-home"></i> ไปเมนู</a>
                <a href="drx1date.php" class="btn-menu me-3"><i class="fas fa-calendar-alt"></i> เลือกวันที่ใหม่</a>
                <a href="drxlist_not.php" target="_blank" class="btn btn-warning btn-sm shadow-sm"><i class="fas fa-exclamation-circle"></i> รายการค้างจ่าย</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="search-box">
        <form method="GET" action="drxlist3.php" target="_blank" class="row g-3 align-items-center">
            <div class="col-auto">
                <label class="fw-bold"><i class="fas fa-search me-1"></i> ค้นหาด้วย VN :</label>
            </div>
            <div class="col-auto">
                <input type="text" name="vn_drx" class="form-control" placeholder="ระบุ VN..." autofocus>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary px-4">ตกลง</button>
            </div>
            <input type="hidden" name="yr" value="<?php echo $_GET["yr"];?>">
            <input type="hidden" name="m" value="<?php echo $_GET["m"];?>">
            <input type="hidden" name="d" value="<?php echo $_GET["d"];?>">
        </form>
    </div>

    <div id="list" class="bg-white p-3 rounded shadow-sm">
        <div class="text-center p-5">
            <div class="spinner-border text-primary" role="status"></div>
            <p class="mt-2">กำลังโหลดข้อมูล...</p>
        </div>
    </div>
</div>

<footer class="text-center mt-4 pb-4 text-muted">
    <small><i class="fas fa-sync fa-spin"></i> ข้อมูลจะอัปเดตอัตโนมัติทุก 20 วินาที</small>
</footer>

</body>
</html>
<?php include("unconnect.inc"); ?>