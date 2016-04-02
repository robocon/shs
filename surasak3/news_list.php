<?php

include 'bootstrap.php';

// Load Databse
DB::load();

$task = isset($_REQUEST['task']) ? trim($_REQUEST['task']) : false ;
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;


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
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="col">
                    <div class="cell">
                        <label for="title">ชื่อเรื่อง</label>
                        <input type="text" name="title">
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <input type="file">
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <button type="submit">เพิ่มข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
}




include 'templates/classic/footer.php';