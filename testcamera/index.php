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
        <video id="video" width="360" height="300" autoplay loop preload="auto" plays-inline><p>Your browser doesn't support HTML5 video</p></video>
    </div>
    <div>
        <button type="button" id="snap">Snap Photo</button>
    </div>
    <div id="resultCamera" class="clearfix"></div>
    <div>
        <button type="submit">save</button>
    </div>
</form>
<script> 

// DEFAULT 
// Grab elements, create settings, etc.
var video = document.getElementById('video');

// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Not adding `{ audio: true }` since we only want video now
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        //video.src = window.URL.createObjectURL(stream);
        video.srcObject = stream;
        video.play();
    });
}


// Elements for taking the snapshot
// var canvas = document.getElementById('canvas');
// var context = canvas.getContext('2d');
// var video = document.getElementById('video');
var i = 1;
// Trigger photo take
document.getElementById("snap").addEventListener("click", function() { 

    // CREATE CANVAS FROM JS
    var x = document.createElement("CANVAS");
    // full hd 1920 x 1080
    // HD & Apple TV Preview 1280 x 720
    // Full HD Broadcast 1080p 1440 x 1080
    x.width = 1920;
    x.height = 1080;

    var ctx = x.getContext("2d");
    ctx.drawImage(video, 0, 0, x.width, x.height);
    x.style.height = "300px";
    x.style.width = "360px";

    var dataURL = x.toDataURL();

    var cDiv = document.createElement("div");
    cDiv.setAttribute('class', 'canvasContain');
    cDiv.setAttribute('id', 'containId'+i);

    i++;

    var rem = document.createElement("div");
    rem.setAttribute('class', 'removeBtn');
    rem.innerHTML = '[x]';
    cDiv.appendChild(rem);

    cDiv.appendChild(x); // เอารูปที่ได้ใส่เข้าไปใน div

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "imgScan[]");
    input.setAttribute("value", dataURL);
    //append to form element that you want .
    
    cDiv.appendChild(input); // เอา input ใส่ใน div

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