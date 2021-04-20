<?php 
require_once 'bootstrap.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานผู้ฉีดวัคซีนโควิด 19</title>

    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <div class="w3-container w3-teal w3-bar w3-xlarge">
        <a href="../nindex.htm" class="w3-bar-item w3-button" style="text-shadow: 2px 2px 2px #444;" title="กลับหน้าหลัก"><i class="fa fa-home" aria-hidden="true"></i></a>
        <a href="javascript:void(0);" class="w3-bar-item w3-button" style="text-shadow: 2px 2px 2px #444;">รายงานผู้ฉีดวัคซีนโควิด 19</a>
        <a href="c19_form.php" target="_blank" class="w3-bar-item w3-right w3-button" style="text-shadow: 2px 2px 2px #444;">ฟอร์มบันทึก</a>
    </div>
    
    <div class="w3-card-4">
        <form action="c19_report.php" class="w3-container" method="POST">
            <p><b>ค้นหาตามวันที่</b></p>
            <div class="w3-container w3-cell">
                <p>
                    <label class="w3-text"><b>วัน</b></label>
                    <input class="w3-input w3-border w3-light-grey" id="day" name="day" type="text">
                </p>
            </div>
            <div class="w3-container w3-cell">
                <p>
                    <label class="w3-text"><b>เดือน</b></label>
                    <input class="w3-input w3-border w3-light-grey" id="month" name="month" type="text">
                </p>
            </div>
            <div class="w3-container w3-cell">
                <p>
                    <label class="w3-text"><b>ปี</b></label>
                    <input class="w3-input w3-border w3-light-grey" id="year" name="year" type="text">
                </p>
            </div>
            <p>
                <button class="w3-btn w3-ripple w3-teal" type="submit">ค้นหา</button>
            </p>
        </form>
    </div>

    <div class="w3-card-4">
        <table class="w3-table-all">
            <tr>
                <th>#</th>
                <th>date</th>
                <th>hn</th>
                <th>ptname</th>
                <th>age</th>
                
                <th>vaccine</th>

                <th>doctor</th>
            </tr>
            <tr>
                <td>1</td>
                <td>date</td>
                <td>hn</td>
                <td>ptname</td>
                <td>age</td>
                <td>
                    vaccine
                    lot
                    serial
                    เข็มที่
                </td>
                <td>1</td>
            </tr>
        </table>
    </div>
    

</body>
</html>