<?php
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/includes/JSON.php';
$json = new Services_JSON();

$action = isset($_POST['action']) ? $_POST['action'] : '';
if($action === 'getDrugList'){
    
    $sql = sprintf("SELECT a.*,b.`name` FROM ( 
    SELECT `drugcode`,`tradname`,`genname` FROM `druglst` WHERE `drugcode` LIKE '%%%s%%' OR `tradname` LIKE '%%%s%%' OR `genname` LIKE '%%%s%%' 
    ) AS a LEFT JOIN ( 

        SELECT x.*,y.`name` FROM ( 
            SELECT `drugcode`,`drugreact_group` FROM `drugreact_group_list` 
        ) AS x LEFT JOIN `drugreact_group` AS y ON x.`drugreact_group` = y.`id`

    ) AS b ON a.`drugcode` = b.`drugcode`", 
        $dbi->real_escape_string($_POST['drugcode']),
        $dbi->real_escape_string($_POST['drugcode']),
        $dbi->real_escape_string($_POST['drugcode'])
    );
    $q = $dbi->query($sql);
    if($q->num_rows > 0){
        ?>
        <table id="resTableDruglst">
        <?php
        while($a = $q->fetch_assoc()){
            ?>
            <tr>
                <td>
                    <?php
                    if(!empty($a['name'])){
                        ?><?=$a['drugcode'];?><?php
                    }else{
                        ?><a href="javascript:void(0);" onclick="selectDrug('<?=$a['drugcode'];?>')"><?=$a['drugcode'];?></a><?php
                    }
                    ?>
                    
                </td>
                <td><?=$a['tradname'];?></td>
                <td><?=$a['genname'];?></td>
                <td>
                    <span style="color: red; font-weight: bold;">
                    <?php
                    if(!empty($a['name'])){
                        echo $a['name'];
                    }
                    ?>
                    </span>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }else{
        ?>
        <table id="resTableDruglst" width="100%"><tr><td>ไม่พบข้อมูล</td></tr></table>
        <?php
    }
    exit;

}elseif ($action==='addDrug') {

    $sql = sprintf("INSERT INTO `drugreact_group_list` (`drugcode`, `drugreact_group`, `officer`, `last_update`) VALUES ('%s', '%s', '%s', NOW());", 
        $dbi->real_escape_string($_POST['drugcode']),
        $dbi->real_escape_string($_POST['group']),
        $dbi->real_escape_string($_SESSION['sIdname'])
    );
    $q = $dbi->query($sql);
    
    header("Location: drugreact_group_item.php?id=".$_POST['group']);
    exit;
}

$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TITLE</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK", sans-serif;
            font-size: 20px;
        }

        /* Model */
        .modal {
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 1em; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        #myModalContainer{
            width: 90%;
            background: #fff;
            padding: 1em;
            margin:0 auto;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        /* Model */

        /* ตาราง */
        .chk_table{
            border-collapse: collapse;
        }
        .chk_table th{
            background-color: #e3e3e3;
        }
        .chk_table th,
        .chk_table td{
            padding: 3px;
            border: 1px solid black;
        }

        .chk_table a{
            text-decoration: none;
        }
        .chk_table a:hover{
            text-decoration: underline;
        }

        h3{
            font-size: 32px;
            padding:0;
            margin:0;
        }
        .mt-1{
            margin-top: 1em;
        }
        .mt-2{
            margin-top: 2em;
        }


        fieldset{
            display: inline-block;
        }

        #resTableDruglst{
            min-width: 600px;
        }
        #resTableDruglst tr:hover{
            background-color:rgb(221, 221, 221);
        }
        
    </style>
    <div class="container mt-1">
        <?php
        $sql = sprintf("SELECT * FROM `drugreact_group` WHERE `id` = '%s';", $dbi->real_escape_string($id));
        $q = $dbi->query($sql);
        if($q->num_rows > 0){
            $a = $q->fetch_assoc();
            ?>
            <h3>รายการยาในกลุ่ม: <?=$a['name'];?></h3>
            <?php
            $sql = sprintf("SELECT a.*,b.`tradname`,b.`genname` 
            FROM ( SELECT * FROM `drugreact_group_list` WHERE `drugreact_group` = '%s' ) AS a 
            LEFT JOIN druglst AS b ON b.`drugcode` = a.`drugcode` ;", 
                $dbi->real_escape_string($id)
            );
            $q = $dbi->query($sql);
            ?>

            <div class="clearfix">
                <fieldset style="float: left;">
                    <legend>เพิ่มยา</legend>
                    <form action="drugreact_group_item.php" method="post">
                        <table>
                            <tr>
                                <td>Drugcode</td>
                                <td><input type="text" name="drugcode" id="drugcode" onkeyup="onSearchDrug();"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit">บันทึก</button>
                                    <input type="hidden" name="action" value="addDrug">
                                    <input type="hidden" name="group" value="<?=$id;?>">
                                </td>
                            </tr>
                        </table>
                    </form>
                </fieldset>
                <div style="float: left; position: relative; display:none;" id="drugContainerList">
                    <div style="position: absolute; background-color: #ffffff; border:1px solid #000;">
                        <div id="closeDruglst" style="text-align:center; background-color: #b8b8b8;"><a href="javascript:void(0);" onclick="closeContainer()">ปิด [❌]</a></div>
                        <div id="resContent"></div>
                    </div>
                </div>
            </div>
            
            <table class="chk_table mt-1">
                <tr>
                    <th>#</th>
                    <th>ชื่อยา</th>
                    <th>ผู้บันทึก</th>
                    <th>วันที่บันทึก</th>
                    <th></th>
                </tr>
            <?php
            $i = 1;
            while($a = $q->fetch_assoc()){
                ?>
                <tr valign="top">
                    <td><?=$i;?></td>
                    <td><?=$a['tradname'].' (<b>'.$a['drugcode'].'</b>)';?><br><?=$a['genname'];?></td>
                    <td><?=$a['officer'];?></td>
                    <td><?=$a['last_update'];?></td>
                    <td>
                        <a href="javascript:void(0);">🚮</a>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
            </table>
            <?php
        }else{
            ?>
            <p><strong>ไม่พบข้อมูล</strong></p>
            <?php
        }
        ?>
    </div>

<div id="myModal" class="modal" style="display:none;">
    <div id="myModalContainer">
        <div class="clearfix">
            <div id="myModalHeader"><a href="javascript:void(0);" onclick="closeFormAdd()"><span class="close">&times; ปิด</span></a></div>
        </div>
        <div id="resContent">
            <div>
                <table>
                    <tr>
                        <td>Drugcode</td>
                        <td><input type="text" name="" id=""></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    function closeContainer(){
        document.getElementById('drugContainerList').style.display='none';
        document.getElementById('drugcode').value='';
    }

    function selectDrug(code){
        document.getElementById('drugcode').value = code;
        document.getElementById('drugContainerList').style.display='none';
    }

    async function onSearchDrug(){
        let name = document.getElementById('drugcode').value.trim();

        var data = [];
		data.push(encodeURIComponent('action')+"="+encodeURIComponent('getDrugList'));
		data.push(encodeURIComponent('drugcode')+"="+encodeURIComponent(name));
		var dataPost = data.join("&");

        const response = await fetch('drugreact_group_item.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            body: dataPost
        });
        const res = await response.text();

        document.getElementById('resContent').innerHTML = res;
        document.getElementById('drugContainerList').style.display='';

    }

    async function sendPost(url, dataPost){
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            body: dataPost
        });
        const res = await response.json();
        return res;
    }

</script>

</body>
</html>