<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>�����ٻ 1 ����</title>
</head>
<body style="padding: 0; margin: 0;">
    <style>
        .container{
        }
        .glass{
            height: 708px;
            width: 944px;
            z-index: 0;
        }
    </style>
    <div>���й�㹡����ҹ</div>
    <ol>
        <li>��س������������������ �� Google Chrome ���� Firefox ����Ѿഷ���������ش</li>
        <li>���������׹����㹡�ͺ�չ���Թ</li>
    </ol>
    <div style="position: relative;">
        <div class="container" id="container_img">
            <video id="video" class="glass" autoplay><u style="color: red;">�����������ͧ�Ѻ��÷ӧҹ�ͧ���ͧ�����ٻ</u></video>
            <div style="border: 1px solid blue; width: 472px; height: 708px; left: 236px; position: absolute; top: 0;"></div>
            <button id="snap" style="width: 200px; height: 200px; font-size: 50px; vertical-align: top;">�����ٻ</button>
        </div>
    </div>

    <div>
        <canvas id="canvas" width="472" height="708" ></canvas>
        <a id="download" href="javascript: void(0);" style="font-size: 2em;">�����Ŵ�ٻ</a>
    </div>

    <script>
    // Grab elements, create settings, etc.
    var video = document.getElementById('video');

    // Get access to the camera!
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Not adding `{ audio: true }` since we only want video now
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            video.src = window.URL.createObjectURL(stream);
            video.play();
        });
    }

    // Elements for taking the snapshot
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');

    // Trigger photo take
    document.getElementById("snap").addEventListener("click", function() {
        context.drawImage(video, -236, 0, 944, 708);
    });

    function downloadCanvas(link, canvasId, filename) {
        link.href = document.getElementById(canvasId).toDataURL();
        link.download = filename;
        console.log(link);
    }

    /** 
    * The event handler for the link's onclick event. We give THIS as a
    * parameter (=the link element), ID of the canvas and a filename.
    */
    document.getElementById('download').addEventListener('click', function() {
        var d = new Date();
        
        downloadCanvas(this, 'canvas', d.getMilliseconds()+'.png');
    }, false);

    </script>

</body>

</html>