<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<p><b>ทดสอบการขอ Authen ผ่าน NHSO Secure Smartcard Agent</b></p>
<p><b>ใช้งานผ่าน Google Chrome, Firefox, Microsoft Edge เท่านั้น</b></p>

<form action="smartcard_agent.php" id="adminForm">
    <div>
        เลขบัตรประชาชน: <input type="text" name="idcard" id="idcard">
    </div>
    <div>
        <button type="submit">ค้นหาประวัติ</button>
    </div>
    <div id="resNhso"></div>
</form>
<script>
    
    document.getElementById("adminForm").addEventListener("submit", function(event){
        event.preventDefault();
        var idcard = document.getElementById('idcard').value;
        testSearch(idcard);
    });

    var handleError = function (err) {
        return false;
    };

    async function testSearch(idcard){
        var res = document.getElementById('resNhso');
        if(idcard!==""){
            var response = await fetch('http://localhost:8189/api/nhso-service/latest-authen-code/'+idcard).catch(handleError);
            if(response.ok){
                var data = await response.json();
                if(data.claimCode===undefined){
                    res.innerHTML = 'เลขบัตรประชาชนไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง';
                }else{ 
                    var resHTML = '<div>';
                    resHTML += '<p><b>วันที่ขอเคลม:</b> '+data.claimDateTime+'</p>';
                    resHTML += '<p><b>เคลม Code:</b> '+data.claimCode+'</p>';
                    resHTML += '<p><b>ประเภทการเคลม:</b> '+data.claimType+'</p>';
                    resHTML += '<p><b>HCODE:</b> '+data.hcode+'</p>';
                    resHTML += '</div>';
                    res.innerHTML = resHTML;
                }
            }else{
                
                res.innerHTML = 'ไม่พบ SmartCard Agent กรุณาติดตั้ง <a href="https://www.nhso.go.th/downloads/208" target="_blank">NHSO Secure SmartCard Agent.</a> ก่อนใช้งาน';
            }
        }else{
            res.innerHTML = '<b>กรุณาใส่เลขบัตรประชาชน</b>';
        }
    }
</script>
</body>
</html>