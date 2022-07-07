<?php 
include 'bootstrap.php';
$action = $_REQUEST['action'];
// $dbi = new mysqli(HOST,USER,PASS,DB);
$dbi = new mysqli('192.168.131.250','remoteuser','',DB);

if($action==='save'){

    $xraycode = trim($_POST['xraycode']);
    $xraytype = $_POST['xraytype'];
    $xraytype2 = $_POST['xraytype2'];
    $xraysub = trim($_POST['xraysub']);

    if($xraytype==='First Page'){
        $typevalue = 0;
        if(!empty($xraytype2)){
            $typevalue = 3;
        }
    }elseif ($xraytype==='Extremities') {
        $typevalue = 1;
    }


    $sql = "INSERT INTO `xraylist` (`row_id`, `xraycode`, `xraytype`, `xraysub`) VALUES(
        NULL,'$xraycode','$typevalue','$xraysub'
    )";
    $save = $dbi->query($sql);
    $msg = "บันทึกข้อมูลเรียบร้อย";
    if($save===false){
        $msg = $dbi->error;
    }
    redirect('xray_form.php',$msg);
    exit;
}

?>
<h1>ฟอร์มเพิ่มท่าตรวจ X-Ray</h1>
<?php 
if(!empty($_SESSION['x-msg'])){
    echo '<p>'.$_SESSION['x-msg'].'</p>';
    $_SESSION['x-msg'] = null;
}
?>
<form action="xray_form.php" method="post">
    <div>
        xray code <input type="text" name="xraycode" id="">
    </div>
    <div>
        หน้าที่จะแสดง<label for="fp"><input type="radio" name="xraytype" id="fp" value="First Page" checked>First Page</label>
        <label for="ex"><input type="radio" name="xraytype" id="ex" value="Extremities">Extremities</label>
    </div>
    <div>
        <input type="checkbox" name="xraytype2" id="xt2" value="1"> <label for="xt2">RT LT &lt;&lt; เลือกกรณีจะให้แสดง RT LT ในหน้า First Page</label>
    </div>
    <div>
        xray sub <input type="text" name="xraysub" id="xraysub">
        <a href="javascript:void(0);" onclick="addsub('AP')">AP</a>,
        <a href="javascript:void(0);" onclick="addsub('LAT')">LAT</a>,
        <a href="javascript:void(0);" onclick="addsub('OBL')">OBL</a>,
        <a href="javascript:void(0);" onclick="addsub('TOWNE')">TOWNE</a>,
        <a href="javascript:void(0);" onclick="addsub('WATER')">WATER</a>,
        <a href="javascript:void(0);" onclick="addsub('AXIAL')">AXIAL</a>
        
    </div>
    <div>
        <button type="submit">บันทึก</button>
        <input type="hidden" name="action" value="save">
    </div>
</form>
<script>
    function addsub(name){
        var sub = document.getElementById('xraysub');
        if(sub.value===''){
            sub.value = name;
        }else{
            sub.value = sub.value+', '+name
        }
    }
</script>