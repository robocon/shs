<?php
require_once dirname(__FILE__).'/bootstrap.php';
?>
<style type="text/css">
	.body-contain{
		background-color: #008080;
		color: #ffffff;
		padding: 5px;
	}
	.body-contain a{
		color: #ffffff;
		text-decoration: none;
	}
	.body-contain a:hover{
		text-decoration: underline;
	}
</style>
<?php
$sql = sprintf("SELECT * FROM `news` WHERE `id` = '%s' AND `status` = 1", $dbi->real_escape_string($_GET['id']));
$q = $dbi->query($sql);
$rows = $q->num_rows;
if( $rows > 0 ){
	$item = $q->fetch_assoc();
?>
<div class="body-contain">
	<div>
		<div><a href="../display.php">&lt;&lt;&nbsp;กลับไปหน้าหลัก</a></div>
	</div>
	<div>
		<h3>หัวข้อข่าว:: <?=$item['title'];?></h3>
	</div>
	<div>
		<?php
		$fds = glob('news/'.$item['folder'].'/*.pdf');
		foreach( $fds as $key => $fd ){
			?><embed src="<?=$fd;?>" type="" width="100%" height="100%"><div style="padding: 5px;"></div><?php
		}
		?>
	</div>
</div>
<?php
}else{
?>
<div class="body-contain">
	<div><p>ไม่พบข้อมูลที่ต้องการ</p></div>
</div>
<?php
}