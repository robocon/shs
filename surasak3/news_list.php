<?php

include 'bootstrap.php';

$userCode = get_session('smenucode');
if( $userCode != 'ADM' && $userCode != 'ADMCOM' ){ 
    echo "เฉพาะเจ้าหน้าที่ศูนย์คอมเท่านั้นที่เข้าใช้งานได้"; 
    exit; 
}

// Load Databse
DB::load();

$task = isset($_REQUEST['task']) ? trim($_REQUEST['task']) : false ;
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;

if( $action === 'save' ){
    
    $id = input_post('id');
    $files = $_FILES['files'];
    
    if( $id === false ){
        $folder_name = time();
        mkdir('news/'.$folder_name);
    }else{
        $sql = "SELECT `folder` FROM `news` WHERE `id` = :id";
        $item = DB::select($sql, array(':id' => $id), true);
        $folder_name = $item['folder'];
    }
    
    $file_row = count($files['error']);
    for( $i = 0; $i < $file_row; $i++ ){
        
        $err = $files['error'][$i];
        $ext = strrchr($files['name'][$i], ".");
        if( $err === 0 && $ext === '.pdf' ){
            
            $file_name = $files['name'][$i];
            move_uploaded_file($files['tmp_name'][$i], 'news/'.$folder_name.'/'.$file_name);
        }
    }
    $title = input_post('title');
    $owner = get_session('sOfficer');
    
    if( $id === false ){
        $sql = "INSERT INTO  `smdb`.`news` (`id` ,`title` ,`folder` ,`date_start` ,`date_end` ,`status` ,`owner`)
        VALUES (
        NULL ,  '$title',  '$folder_name',  NOW(), NULL ,  '1',  '$owner'
        );";
        $save = DB::exec($sql);
    } else {
        $sql = "UPDATE  `smdb`.`news` SET  
        `title` =  '$title',
        `date_end` = NOW(),
        `owner` = '$owner'
        WHERE  `news`.`id` = :id LIMIT 1 ;";
        $save = DB::exec($sql, array(':id' => $id));
    }
    
    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( isset($save['error']) ){
        $msg = 'บันทึกข้อมูลไม่สำเร็จกรุณาเก็บโค้ดนี้ '.$save['id'].' เพื่อแจ้งให้ผู้ดูแลระบบทำการแก้ไขต่อไป';
    }
    
    redirect('news_list.php', $msg);
    exit;
} else if( $action === 'delete' ){
    
    
    $id = input_get('id');
    $sql = "UPDATE  `smdb`.`news` SET  `status` =  '0' WHERE  `news`.`id` =:id LIMIT 1 ;";
    DB::exec($sql, array(':id' => $id));
    redirect('news_list.php', 'ดำเนินการเรียบร้อยแล้ว');
    exit;
} else if( $action === 'remove_path' ){
    $path = input_post('path');
    if(is_file($path)){
        unlink($path);
    }
    echo '{"successful":true}';
    exit;
}

include 'templates/classic/header.php';
?>
<div class="site-header-fixture no-print">
    <div class="site-header">
        <div class="col width-fit mobile-width-fit">
            <div class="cell">
                <a href="#" class="logo"></a>
            </div>
        </div>
        <div class="col width-fill mobile-width-fill">
            <div class="cell">
                <ul class="col nav clear">
                    <li class="active"><a href="../nindex.htm">หน้าหลักโปรแกรม SHS</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="col page-header-col">
	<div class="cell">
		<div class="page-header">
			<h1>ระบบข่าวประชาสัมพันธ์</h1>
		</div>
	</div>
</div>
<div class="col nav-menu-col">
	<div class="menu cell">
		<ul class="nav clear">
			<li><a href="news_list.php">หน้าหลัก</a></li>
			<li><a href="news_list.php?task=form">เพิ่มข่าวประชาสัมพันธ์</a></li>
		</ul>
	</div>
</div>
<?php // Notification ?>
<?php if( isset($_SESSION['x-msg']) ): ?>
<div class="notify-warning"><?php echo $_SESSION['x-msg']; ?></div>
<?php unset($_SESSION['x-msg']); ?>
<?php endif; ?>

<?php


if ( $task === false ) {
    ?>
    <div class="col">
        <div class="cell">
            <h3>หน้ารายการข่าวประชาสัมพันธ์</h3>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อข่าว</th>
                        <th>วันที่เพิ่มข่าว</th>
                        <th>แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $sql = "SELECT * FROM `news` WHERE `status` = 1 ORDER BY `id` DESC";
                    $items = DB::select($sql);
                    $i = 1;
                    foreach( $items as $key => $item ){
                        
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$item['title'];?></td>
                        <td><?=$item['date_start'];?></td>
                        <td><a href="news_list.php?task=form&action=edit&id=<?=$item['id'];?>">แก้ไข</a> | <a href="news_list.php?action=delete&id=<?=$item['id'];?>">ลบ</a></td>
                    </tr>
                    <?php
                    $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}else if( $task === 'form' ){
    
    $id = input_get('id');
    if( $id !== false ){
        
        $sql = "SELECT * 
        FROM `news` 
        WHERE `id` = :id 
        AND `status` = 1";
        $item = DB::select($sql, array(':id' => $id), true);
    }
    ?>
    <style type="text/css">
        label{
            font-weight: bold;
        }
        .del-oldfile{
            cursor: pointer;
            
        }
        .del-oldfile:hover{
            color: red;
            text-decoration: underline;
        }
    </style>
    <div>
        <div class="col">
            <div class="cell">
                <h3>แบบฟอร์มข่าวประชาสัมพันธ์</h3>
            </div>
        </div>
        <div>
            <form action="news_list.php" method="post" enctype="multipart/form-data">
                <div class="col">
                    <div class="cell">
                        <label for="title">ชื่อเรื่อง</label>
                        <input type="text" name="title" value="<?=$item['title'];?>" class="width-2of5">
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <label for="">รายการไฟล์</label>
                        <?php
                        if( $id !== false ){
                            
                            $fds = glob('news/'.$item['folder'].'/*.pdf');
                            foreach ($fds as $key => $fd) {
                                $file_name = substr( strrchr($fd, '/'), 1);
                                ?>
                                <div><?=$file_name;?> <span data-path="<?=$fd;?>" class="del-oldfile">[ ลบ ]</span></div>
                                <?php
                            }
                            
                        }
                        ?>
                        <div id="file-lists">
                            <div class="file-contain">
                                <input type="file" name="files[]">
                            </div>
                        </div>
                        <div>
                            <button id="addFile">เพิ่มไฟล์อัพโหลด</button>
                            <div style="font-size: 16px; color: red;">* อนุญาตเฉพาะไฟล์ .pdf</div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <button type="submit">เพิ่มข้อมูล</button>
                        <input type="hidden" name="action" value="save">
                        <?php
                        if( $id !== false ){
                            ?><input type="hidden" name="id" value="<?=$id;?>"><?php
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        
        function delFile(th){
            th.parentNode.remove();
            return false;
        }
        
        $(function(){
            
            $("#addFile").on("click", function(e){
                e.preventDefault();
                var divFile = '<div class="file-contain"><input type="file" name="files[]"><span class="del-file" onclick="return delFile(this)">[ ลบ ]</span></div>';
                $('#file-lists').append(divFile);
            });
            
            if( $(".del-oldfile").length > 0 ){
                $(".del-oldfile").on("click", function(){
                    
                    var c = confirm("ยืนยันที่จะลบไฟล์ดังกล่าว?");
                    if( c === false ){
                        return false;
                    }
                    var path = $(this).attr('data-path');
                    var span = $(this);
                    $.ajax({
                        url: 'news_list.php',
                        method: 'post',
                        data: {'action':'remove_path', 'path':path},
                        success: function(text){
                            
                            var res = $.parseJSON($.trim(text));
                            if( res.successful === true ){
                                span.parent().remove();
                            }
                        }
                    });
                    
                });
            }
            
        });
    </script>
    <?php
}

include 'templates/classic/footer.php';