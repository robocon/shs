<?php 

include 'bootstrap.php';
$action = input('action');
$page = input('page');
if ($action === 'active') {
    $confirm = trim($_SESSION['sOfficer']);
    $id = input_get('id');

    $sql = "UPDATE `med_scan` SET 
    `lastupdate`=NOW(), 
    `confirm`='y', 
    `lasteditor`='$confirm' 
    WHERE (`id`='$id');";
    $q = mysql_query($sql);
    if( $q !== false ){
        $msg = '�ѹ�֡���������º����';
    }else{
        $err = set_log(mysql_error());
        $msg = '�������ö�ѹ�֡��������'.$err['id'].' ' .$err['msg'];
    }

    redirect('med_phar.php?action=print&id='.$id,$msg);
    exit;
}elseif ( $action === 'print' ) {
    
    $sql = "SELECT * FROM `med_scan` WHERE `id` = '$id' ";
    $q = mysql_query($sql);

    $item = mysql_fetch_assoc($q);

    ?>
    <style>
    @media print{
        .no-print{
            display: none;
        }
    }
    
    </style>
    <div class="no-print">
        <button type="button" onclick="print_img()" >�����</button> | <a href="med_phar.php">��Ѻ˹����¡��</a>
    </div>
    <img src="<?=$item['path'];?>" id="mainImg">
    <script>
        function print_img(){
            window.print();
        }

        window.onload = function(){
            window.print();
        };
    </script>
    <?php

    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>����ͧ����á���</title>
</head>
<body>

<style>
*{
    font-family: "TH SarabunPSK","TH Sarabun New";
    font-size: 16pt;
}
p{
    margin: 0;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}

tr{
    vertical-align: top;
}

#imgContainer{
    position: absolute;
    top: 2%;
    left: 2%;
    background-color: #ffffff;
    border: 2px solid #000000;
}
#imgBtnClose{
    text-align: center; 
    background-color: #b8b8b8;
}
#imgBtnClose:hover{
    cursor: pointer;
}

.btnActive{
    padding: 3px;
    color: #000000;
    background-color: #b8b8b8;
    margin: 2px;
    text-decoration: none;
}
</style>
<div>
    <p><a href="../nindex.htm">&lt;&lt;&nbsp;˹����ѡ</a> | <a href="med_ward.php">˹������</a></p>
</div>
<?php
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 2px solid #afaf00; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}
?>
<div>
    <h3>����ͧ����á���(��ǧ���ͺ)</h3>
</div>
<?php
$sql = "SELECT * FROM `med_scan` WHERE `confirm` IS NULL ORDER BY `id` DESC";
$q = mysql_query($sql);

if ( mysql_num_rows($q) > 0 ) {
    
    ?>
    <table class="chk_table">
        <tr>
            <th>�ѹ���ѹ�֡������</th>
            <th>��������´</th>
            <th>���</th>
            <th>�׹�ѹ����Ѻ������</th>
        </tr>
    
    <?php
    while ($item = mysql_fetch_assoc($q)) {
        
        ?>
        <tr>
            <td>
                <p><?=$item['date'];?></p>
            </td>
            <td>
                <p>HN: <?=$item['hn'];?></p>
                <p>AN: <?=$item['an'];?></p>
                <p>����-ʡ��: <?=$item['ptname'];?></p>
            </td>
            <td>
                <a href="javascript:void(0)"><img src="<?=$item['path'];?>" class="showImg" alt="" width="200px;"></a>
            </td>
            <td style="vertical-align: middle;">
                <a href="med_phar.php?action=active&id=<?=$item['id'];?>&an=<?=$item['an'];?>" class="btnActive">Active & Print</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}
?>


<fieldset>
    <legend>�����͡��ô��� AN</legend>
    <form action="med_phar.php" method="post">
        <div>
            AN: <input type="text" name="an" id="">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="page" value="searchFile">
        </div>
    </form>
</fieldset>

<?php 
if ( $page === 'searchFile' ) {
    
    $an = input('an');
    $sql = "SELECT * FROM `med_scan` WHERE `an` = '$an' AND `confirm` = 'y' ORDER BY `id` DESC";
    $q = mysql_query($sql);
    if ( mysql_num_rows($q) > 0 ) {

        ?>
        <table class="chk_table">
            <tr>
                <th>�ѹ���ѹ�֡������</th>
                <th>������</th>
                <th>���</th>
                <th>Re-Print</th>
            </tr>
        
        <?php
        while ($item = mysql_fetch_assoc($q)) {
            ?>
            <tr>
                <td>
                    <p><?=$item['date'];?></p>
                </td>
                <td>
                    <p>HN: <?=$item['hn'];?></p>
                    <p>AN: <?=$item['an'];?></p>
                    <p>����-ʡ��: <?=$item['ptname'];?></p>
                </td>
                <td>
                    <a href="javascript:void(0)"><img class="showImg" src="<?=$item['path'];?>" alt="" width="200px;"></a>
                </td>
                <td style="vertical-align: middle;">
                    <a href="med_phar.php?action=print&&id=<?=$item['id'];?>" class="btnActive" target="_blank">�����</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }else{
        echo "��辺������ $an";
    }


}

?>
<div id="imgContainer" style="display: none;">
    <div id="imgBtnClose">[Close]</div>
    <div><img src="" alt="" id="imgContent"></div>
</div>
<script>
    
    // open popup
    var imgs = document.querySelectorAll('.showImg');
    for (var index = 0; index < imgs.length; index++) {
        var item = imgs[index];
        
        item.addEventListener('click', function(event) {
            document.getElementById('imgContent').setAttribute('src', this.getAttribute('src'));
            document.getElementById('imgContainer').style.display = ''; // show

            var doc = document.documentElement;
            var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
            document.getElementById('imgContainer').setAttribute('style', 'top: '+top+'px;');
        });
        
    }

    // close button
    var imgBtn = document.querySelectorAll('#imgBtnClose');
    imgBtn[0].addEventListener('click', function(event){
        document.getElementById('imgContainer').style.display = 'none';
    });
    
</script>

</body>
</html>