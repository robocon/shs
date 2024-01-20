<?php 
// require_once 'bootstrap.php';
define('LARAVEL_API_HOST', 'http://192.168.131.240:8081/api/');

$action = sprintf("%s", $_POST['action']);
if($action==='save'){
    $hn = sprintf("%s", $_POST['hn']);
    echo "Save $hn";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
</head>
<body>
    <div style="border: 2px solid red; padding:8px;">
        <div id="reader" width="200px"></div>
        <div style="text-align:center;">
            <button type="button" style="padding: 8px 16px;" onclick="checkHn()">ตรวจสอบ</button>
        </div>
        <div id="responseSuccess"></div>
        <div id="responseFailure"></div>
    </div>
    <form action="test_qrcode.php" method="post">
        <div>
            <table>
                <tr>
                    <td>ชื่อ-สกุล: </td>
                    <td id="ptname"></td>
                </tr>
                <tr>
                    <td><label for="hn">HN: </label></td>
                    <td><input type="text" name="hn" id="hn"></td>
                </tr>
            </table>
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="action" value="save">
        </div>
    </form>
    
    <script type="text/javascript">
        var testHn = '';
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // console.log(`Code matched = ${decodedText}`, decodedResult);
            testHn = decodedText;
        }

        function checkHn(){
            if(testHn.match(/^(\d+\-\d+)/g)){
                findHn(testHn).then((res)=>{ 

                    document.getElementById('responseFailure').innerHTML = '';

                    let item = res.data[0];
                    document.getElementById('hn').value = item.hn;

                    let ptname = item.yot+item.name+' '+item.surname;
                    document.getElementById('ptname').innerHTML = ptname;
                });
            }else{
                document.getElementById('responseFailure').innerHTML = 'รูปแบบ HN ไม่ถูกต้องกรุณาตรวจสอบอีกครั้ง';

                document.getElementById('hn').value = '';
                document.getElementById('ptname').innerHTML = '';

            }
        }

        async function findHn(hn){
            const response = await fetch('<?=LARAVEL_API_HOST;?>opcard/getOneHn?hn='+hn);
            const data = await response.json();
            return data;
        }

        function onScanFailure(error) { 
            testHn = '';
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 300, height: 300} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</body>
</html>