<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style type="text/css">
    body{
        margin: 0;
        padding: 0;
    }
    .clearfix:after{
        content: "";
        display: table;
        clear: both;
    }
    </style>

    <div class="clearfix">
        <div style="page-break-after: always; position: relative; width: 22cm; height: 28cm; border: 1px solid red;">
            <div style="position: absolute; top: 0;">test 1111</div>
        </div>
    </div>
    
    <div class="clearfix" style="height: auto;">
        <div style="page-break-after: always; position: relative; width: 22cm; height: 28cm; ">
            <div style="position: absolute; top: 0;">test 2222</div>
            <div style="position: absolute; top: 20px;">test 2222</div>
            <div style="position: absolute; top: 40px;">test 2222</div>
            <div style="position: absolute; top: 60px;">test 2222</div>
            <div style="position: absolute; top: 80px;">test 2222</div>
        </div>
    </div>

    <div class="clearfix">
        <div style="position: relative; width: 22cm; height: 28cm; ">
            <div style="float: left;">test 3333</div>
        </div>
    </div>
</body>
</html>