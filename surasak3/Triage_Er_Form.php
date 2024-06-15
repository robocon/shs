<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triage Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .patient-info {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .header {
            background-color: #ffeb3b;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .header h3 {
            margin: 0;
        }
    </style>
</head>
<body>
<h1 align="center">Triage Form</h1>
<div class="patient-info">
    <div class="header">
        <h3><img src="triage_images/patient.png" width="40" height="40"> ข้อมูลผู้ป่วย</h3>
    </div>
    <form>
        <div class="form-group">
            <label for="hn">HN</label>
            <input type="text" class="form-control" id="hn" placeholder="HN" required>
        </div>
        <div class="form-group">
            <label for="name">ชื่อ-นามสกุล</label>
            <input type="text" class="form-control" id="name" placeholder="ชื่อ-นามสกุล" readonly required>
            <div id="ajax_Result_PtData"></div>
        </div>
        <div class="form-group">
            <label for="age">อายุ</label>
            <input type="text" class="form-control" id="age" placeholder="อายุ" readonly required>
        </div>
        <div class="form-group">
            <label for="disease">โรคประจำตัว</label>
            <input type="text" class="form-control" id="disease" placeholder="โรคประจำตัว" readonly required>
        </div>
        <div class="form-group">
            <label for="rights">สิทธิการรักษา</label>
            <input type="text" class="form-control" id="rights" placeholder="สิทธิการรักษา" readonly required>
        </div>
        <div class="form-group">
            <label for="date">วันที่</label>
            <input type="date" class="form-control" id="date" required>
        </div>
        <div class="form-group">
            <label for="time">เวลา</label>
            <input type="time" class="form-control" id="time" required>
        </div>
        <div class="form-group">
            <label>เหตุผลการเข้ารักษา</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="reason" id="disease" value="disease">
                <label class="form-check-label" for="disease">เจ็บป่วยด้วยโรคต่างๆ</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="reason" id="accident" value="accident">
                <label class="form-check-label" for="accident">บาดเจ็บหรืออุบัติเหตุ</label>
            </div>
        </div>
        <div class="form-group">
            <label for="cc">CC</label>
            <textarea class="form-control" id="cc" rows="3" placeholder="CC"></textarea>
        </div>
        <button type="button" class="btn btn-primary btn-block">ถัดไป</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $("#hn").click(function() {  
            var hn = $("#hn").val();
                $.ajax({
                    type: "POST",
                    url: "Triage_ajax_data_pt.php",
                    data: { hn : hn },
                    success: function(response) {
                        $("#ajax_Result_PtData").html(response);
                    }
                });
            
        });
    });
</script>
</body>
</html>
