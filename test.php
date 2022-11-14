<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button type="button" onclick="testSend()">Send</button>
    <div id="body"></div>
    <script>

        async function testSend(){ 
            var hostTxt = '<?=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>';
            var targetTxt = 'http://e-medical-certificate.com/send_notify.php';
            const response =await fetch(targetTxt, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/x-www-form-urlencoded' 
                },
                body: JSON.stringify({'message':'ทดสอบการส่งข้อความผ่าน javascript แบบ Crossdomain HOST: '+hostTxt+' TO: '+targetTxt, 'token':'bXrbN0yds9GRmkTEX6ZLsWZh57aqmRlPbT8oBGo6MpS'})
            });
            var body = await response.text();
            document.getElementById("body").innerHTML = body;
        }

        /**
         * ท่าส่งแบบปกติที่เป็น POST FORM
         
var details = {
    'userName': 'test@gmail.com',
    'password': 'Password!',
    'grant_type': 'password'
};

var formBody = [];
for (var property in details) {
  var encodedKey = encodeURIComponent(property);
  var encodedValue = encodeURIComponent(details[property]);
  formBody.push(encodedKey + "=" + encodedValue);
}
formBody = formBody.join("&");

fetch('https://example.com/login', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
  },
  body: formBody
})



         */
        
    </script>
</body>
</html>