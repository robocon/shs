<?php
if( $_POST['action'] === 'curl' ){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://192.168.1.5/scanit/check_login.php");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:text/html; charset=UTF-8'));
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "txtuser=opd&txtpass=123456");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $sv_output = curl_exec($ch);
    curl_close($ch);

    var_dump($sv_output);
    exit;
}

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

$test_user = $_GET['user'];
$test_pass = $_GET['pass'];
dump($test_user);
dump($test_pass);

$data_post = http_build_query(array('txtuser' => $test_user, 'txtpass' => $test_pass));
dump($data_post);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://192.168.1.5/scanit/check_login.php");

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded','Connection:keep-alive'));
curl_setopt($ch, CURLOPT_HEADER, 1); // ให้ค่า header แสดงผลใน output ด้วย

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_VERBOSE, 1);

$sv_output = curl_exec($ch);
curl_close($ch);

dump($sv_output);

$sv_output = substr($sv_output, -1);


if( $sv_output == '1' ){
    ?>

    <form name="frmlogin" id="frmlogin" method="POST" action="http://192.168.1.5/scanit/import.php" class="form-signin">
        <input type="text" class="form-control" name="txtuser" id="txtuser" placeholder="Username" value="<?=$test_user;?>">
        <input type="password" class="form-control" name="txtpass" id="txtpass" placeholder="Password" value="<?=$test_pass;?>">
        <button class="btn btn-lg btn-success btn-block " name="submit" value="Login" type="submit">Login <span class="glyphicon glyphicon-log-in"></span></button>
    </form>

    <?php
}
exit;



?>
<!DOCTYPE html>
<html>
<head>
    <!-- <meta charset="UTF-8"> -->
</head>
<body>
    <script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
    <a href="javascript: void(0);" id="login-btn">ทดสอบ Login</a>
    <div style="display: none;">
        <form action="http://192.168.1.5/scanit/check_login.php" method="post" id="hide_login" target="_blank">
            <input type="text" name="txtuser" id="txtuser" value="opd">
            <input type="text" name="txtpass" id="txtpass" value="1234">
        </form>
    </div>
    <script type="text/javascript">
    $(function(){
        $(document).on('click', '#login-btn', function(){

            var user = $('#txtuser').val();
            var pass = $('#txtpass').val();
            
            $.ajax({
                // url: "http://192.168.1.5/scanit/check_login.php",
                url: "test_login_scan.php",
                data: {'txtuser': user, 'txtpass': pass, 'action': 'curl'},
                method: 'POST',
                dataType: 'json',
                success: function(data){
                    alert(data);
                    console.log(data);
                }
            });

        });

    });
    </script>
</body>
</html>