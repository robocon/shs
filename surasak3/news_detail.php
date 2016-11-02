<?php
include 'bootstrap.php';
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
$id = input_get('id');
// DB::load();
$db = Mysql::load();

$sql = "SELECT * 
FROM `news` 
WHERE `id` = :id 
AND `status` = 1";
// $item = DB::select($sql, array(':id' => $id), true);
$db->select($sql, array(':id' => $id));
$item = $db->get_item();
if( !empty($item) ){
?>
<div class="body-contain">
	<div>
		<div><a href="../display.php">&lt;&lt;&nbsp;��Ѻ�˹����ѡ</a></div>
	</div>
	<div>
		<h3>��Ǣ�͢���:: <?=$item['title'];?></h3>
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
	<div><p>��辺�����ŷ���ͧ���</p></div>
</div>
<?php
}