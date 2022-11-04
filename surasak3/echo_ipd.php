<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกผล echo ผู้ป่วยใน</title>
</head>
<body>
    <table>
        <tr>
            <td>
                <a href="../nindex.htm">&lt;&lt;&nbsp;กลับเมนูหลัก</a>
            </td>
        </tr>
    </table>
    <fieldset>
        <legend><h3>บันทึกข้อมูล Echo ผู้ป่วยใน</h3></legend>
        <form action="echo_ipd.php" method="post">
            <div>
                <label for="an">ค้นหาตาม AN: <input type="text" name="an" id="an"></label>
            </div>
            <?php 
            if($_SESSION['smenucode']!='ADMDR' OR $_SESSION['smenucode']!='ADMDR1'){
            ?>
            <div>
                <input type="hidden" name="doctor" id="doctor" class="echoInput" value="วิรดา  อนันตวงศ์ (ว.43724)" readonly>
                <input type="hidden" name="staff" class="echoInput" value="<?=$_SESSION['sOfficer'];?>">
            </div>
            <?php
            }
            ?>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="page" value="search">
            </div>
        </form>
    </fieldset>

    <br>
    <?php 
    $page = $_REQUEST['page'];
    if ($page === 'search') {
        $sql = sprintf("SELECT * FROM `ipcard` WHERE `an` = '%s'", $_POST['an']);
        $q = $dbi->query($sql);
        if ($q->num_rows > 0) {
            $ip = $q->fetch_assoc();
            $an = $ip['an'];
            ?>
            <style>
                .tb_head{
                    background-color: #2E86C1;
                    padding:4px;
                    font-weight:bold;
                    color: #FFFFCA;
                    text-align: center;
                }
                .tb_title{
                    background-color: #FFFFC1;
                }
            </style>
            <div>
                <table width="80%" align="center">
                    <tr>
                        <td colspan="6" class="tb_head">ข้อมูลผู้ป่วยใน</td>
                    </tr>
                    <tr>
                        <td align="right" class="tb_title"><b>AN: </b></td>
                        <td><?=$ip['an'];?></td>
                        <td align="right" class="tb_title"><b>HN: </b></td>
                        <td><?=$ip['hn'];?></td>
                        <td align="right" class="tb_title"><b>ชื่อ-สกุล: </b></td>
                        <td><?=$ip['ptname'];?></td>
                    </tr>
                    <tr>
                        <td align="right" class="tb_title"><b>อายุ: </b></td>
                        <td><?=$ip['age'];?></td>
                        <td align="right" class="tb_title"><b>Ward: </b></td>
                        <td><?=$ip['my_ward'];?></td>
                        <td align="right" class="tb_title"><b>D/C: </b></td>
                        <td><?=$ip['dcdate'];?></td>
                    </tr>
                </table>
            </div>
            <?php 

            $current_hn = $ip['hn'];

            // ถ้าเป็นผู้ป่วยใน vn จะถูกใส่ค่าด้วย an 
            $vn = $ip['an'];
            $ptname = $ip['ptname'];
            $age = $ip['age'];
            $pause = '';
            $bp = '';

            $thdatehn = date('d-m-').(date('Y')+543).$current_hn;
            $sql = "SELECT * FROM `echo_cardio` WHERE `thdatehn` = '$thdatehn' ";
            $q = $dbi->query($sql);
            if($q->num_rows > 0){
                $ec = $q->fetch_assoc();
                $id = $ec['id'];
            }

            $type = 'IPD';
            ?>
            <br>
            <?php
            require_once 'echo_dt_form.php'; 

            
        }else{
            ?>
            <p>ไม่พบข้อมูล <?=$_REQUEST['an'];?></p>
            <?php
        }
        
    }
    ?>
    <script>
    document.getElementById("echoForm").onsubmit = function(ev){ 

        ev.preventDefault ? ev.preventDefault() : (ev.returnValue = false);

        var inputs = document.getElementsByClassName('echoInput');
        var test_str = [];
        for (var index = 0; index < inputs.length; index++) { 
            var el = inputs[index];
            if(el.value){ 
                test_str.push(encodeURIComponent(el.getAttribute('name'))+"="+encodeURIComponent(el.value));
            }
        }
        var data = test_str.join("&");

        var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if( request.readyState == 4 && request.status == 200 ){
                setInput(request.responseText);
            }
        };
        request.open('POST', 'echo_save.php', true);
        request.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
        request.send(data);

        return false;
    }

    function setInput(res){ 
        var txt = JSON.parse(res);
        document.getElementById('resHtmlContain').style.display = "";
        if(txt.data[0].errno){
            document.getElementById("resHtmlTxt").innerHTML = 'ERROR: '+txt.data[0].errno+' '+txt.data[0].error;

        }else{
            document.getElementById("echoId").value = txt.data[0].id;
            document.getElementById("resHtmlTxt").innerHTML = 'บันทึกข้อมูลเรียบร้อย';
        }

        setTimeout(() => {
            btnClose();
        }, 3000);
    }

    function btnClose(){
        document.getElementById('resHtmlContain').style.display = 'none';
    }
    </script>
</body>
</html>