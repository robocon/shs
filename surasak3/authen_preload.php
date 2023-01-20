<?php 
$idcard = sprintf("%s", $_REQUEST['idcard']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบเบราเซอร์</title>
    <style>
        #notify-ie{
            background-color: #ffff97;
            border: 2px solid #464600;
            padding: 4px;
            text-align: center;
        }
    </style>
</head>
<body>
    <script type="text/javascript">
        /**
         * ถ้าเปิดใน IE จะไม่ให้ผ่าน
         */
        window.onload = function(){
            if(/Trident\/|MSIE/.test(window.navigator.userAgent)){ 
                document.body.appendChild(document.createElement("br"));
                var el = document.createElement("div");
                el.setAttribute("id","notify-ie");
                el.innerHTML = '<br>เบราเซอร์ที่ท่านใช้งานเก่าเกินไป ไม่สามารถทำงานได้ในโปรแกรมตัวใหม่<br><br><br>ไมโครซอฟหยุด Support Internet Explorer ตั้งแต่ 15 มิถุนายน 2022 เป็นต้นไป<br>ดาวโหลด/อัพเดท เป็น <a href="https://www.microsoft.com/th-th/edge?r=1">Microsoft Edge</a> ได้แล้ววันนี้ <br><br>';
                document.body.appendChild(el);
            }else{
                window.location='getAuthenCode.php?idcard=<?=$idcard;?>';
            }
        }
    </script>
</body>
</html>