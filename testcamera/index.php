<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
.canvasContain{
    position: relative;
    width: 360px;
    float: left;
}
.removeBtn{
    position: absolute;
    top: 0;
    right: 0;
    width: 20px;
    height: 20px;
    background-color: white;
}
.removeBtn:hover{
    cursor: pointer;
}
.clearfix {
  overflow: auto;
}
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<form action="save.php" method="post" enctype="multipart/form-data">
    <h3>Example Camera capture barcode and QR Code</h3>
    <div>
        <!-- https://davidwalsh.name/browser-camera -->
        <video id="video" autoplay loop preload="auto" plays-inline><p>Your browser doesn't support HTML5 video</p></video>
    </div>
    <div>
        <button type="button" id="snap">Snap Photo</button>
    </div>
    <div id="resultCamera" class="clearfix"></div>
    <!-- <canvas id="canvas"> </canvas> -->
    <div>
        <button type="submit">save</button>
    </div>
</form>
<script> 

// DEFAULT 
// Grab elements, create settings, etc.
var video = document.getElementById('video');
let canvas = null;
let photo = null;
let width = 320; // เอา width เป็น base แล้วค่อยไปหาความสูงอีกทีหนึ่ง
let height = 0;

// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Not adding `{ audio: true }` since we only want video now
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        //video.src = window.URL.createObjectURL(stream);
        video.srcObject = stream;
        video.play();
    });
}


video.addEventListener(
    "canplay",
    (ev)=>{

        canvas = document.createElement("canvas");

        height = (video.videoHeight / video.videoWidth) * width;

        // ตั้งค่าความสูงและความกว้างตอน event canplay
        video.setAttribute("width", width);
        video.setAttribute("height", height);

        canvas.setAttribute("width", width);
        canvas.setAttribute("height", height);
    }
)


// Elements for taking the snapshot
var i = 1;  

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() { 

    // https://en.wikipedia.org/wiki/List_of_common_display_resolutions#/media/File:Vector_Video_Standards8.svg
    // full hd 1920 x 1080
    // HD & Apple TV Preview 1280 x 720
    // Full HD Broadcast 1080p 1440 x 1080
    var context = canvas.getContext("2d");

    // ตั้งความสูงและกว้างให้ canvas
    canvas.width = width;
    canvas.height = height;

    context.drawImage(video, 0, 0, width, height);
    var dataURL = canvas.toDataURL("image/png");

    var cDiv = document.createElement("div");
    cDiv.setAttribute('class', 'canvasContain');
    cDiv.setAttribute('id', 'containId'+i);

    // ทดสอบสร้างรูปจาก img แล้วใส่ dataURL เข้าไปใน attribute src 
    photo = document.createElement('img');
    photo.src = dataURL;
    // document.getElementById('resultCamera').append(photo);
    cDiv.appendChild(photo);

    i++;

    var rem = document.createElement("div");
    rem.setAttribute('class', 'removeBtn');
    rem.innerHTML = '[x]';
    cDiv.appendChild(rem);

    // cDiv.appendChild(canvas); // ����ٻ������������� div

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "imgScan[]");
    input.setAttribute("value", dataURL);
    // append to form element that you want .
    
    cDiv.appendChild(input); // ��� input ���� div

    document.getElementById('resultCamera').appendChild(cDiv);




    // close button
    var imgBtn = document.querySelectorAll('.removeBtn');
    for (var index = 0; index < imgBtn.length; index++) {
        var item = imgBtn[index];
        item.addEventListener('click', function(event){
            var testId = this.parentNode.getAttribute('id');
            document.getElementById(testId).innerHTML = '';
        });
    }
    

});






</script>

</body>
</html>