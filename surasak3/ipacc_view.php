<?php
require_once dirname(__FILE__).'/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดูบัญชีค่ารักษาผู้ป่วยใน</title>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 16pt;
        }
    </style>
<div class="container">
    <h3>ดูบัญชีค่ารักษาผู้ป่วยใน</h3>
    <div>
        <form action="" method="post" id="userForm">
            <div>
                <label for="an">AN : </label><input type="text" name="an" id="an">
            </div>
            <div style="margin-top: 8px;">
                <button type="submit">ค้นหา</button>
            </div>
        </form>
    </div>
    <div id="responseHTML" style="margin-top: 8px;"></div>
    <script>
        document.getElementById('userForm').onsubmit = function(){
            event.preventDefault();
            const an = document.getElementById('an').value.trim();
            getTable(an).then((res)=>{
                // console.log(res);
                document.getElementById('responseHTML').innerHTML = res;
            });
        }

        async function getTable(an) {

            let formData = new FormData();
            formData.append("cAn", an);
            formData.append("cAccno", '1');
            const postData = new URLSearchParams(formData).toString();
            
            let response = await fetch('ipacc.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: postData
            });
            const body = await response.text();
            return body;
        }
    </script>
</div>
</body>
</html>