<?php

include 'bootstrap.php';

// Load Databse
DB::load();

$task = isset($_REQUEST['task']) ? trim($_REQUEST['task']) : false ;
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;

if( $action === 'save' ){
    /**
     * @todo
     * Validation file
     * mkdir with date
     * store into db
     */
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
    # code...
}else if( $task === 'form' ){
    ?>
    
    <div>
        <div class="col">
            <div class="cell">
                
            </div>
        </div>
        <div>
            <form action="news_list.php" method="post" enctype="multipart/form-data">
                <div class="col">
                    <div class="cell">
                        <label for="title">ชื่อเรื่อง</label>
                        <input type="text" name="title">
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <div id="file-lists">
                            <div class="file-contain">
                                <input type="file" name="files[]">
                                <span class="del-file" onclick="return delFile(this)">[ ลบ ]</span>
                            </div>
                        </div>
                        <div>
                            <button onclick="return addFile()">เพิ่มไฟล์อัพโหลด</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <button type="submit">เพิ่มข้อมูล</button>
                        <input type="hidden" name="action" value="save">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function addFile(){
            var divFile = '<div class="file-contain"><input type="file" name="files[]"><span class="del-file" onclick="return delFile(this)">[ ลบ ]</span></div>';
            var fl = document.getElementById('file-lists');
            fl.innerHTML = fl.innerHTML + divFile;
            return false;
        }
        
        function delFile(th){
            th.parentNode.remove();
            return false;
        }
    </script>
    <?php
}




include 'templates/classic/footer.php';