<?php 
include 'bootstrap.php';
$db = Mysql::load();
$id = input_post('id');
$part = input_post('part');

$action = input_post('action');
if ( $action === 'save' ) {
	
	dump($_POST);
	exit;
	
}
?>
<style>
label{
	cursor: pointer;
}
</style>
<form action="" id="formEditDiabetes" method="post">
	<?php 
	$sql = "SELECT `row_id`,`foot`,`retinal`,`tooth` FROM `diabetes_clinic_history` WHERE `row_id` = '$id'"; 
	$db->select($sql);
	$item = $db->get_item($sql);

    if( $part == 'foot' ){ 
		$lists = array('Low Risk','Moderate Risk','Hight Risk');
        ?>
        <div>
			<div>แก้ไขข้อมูล Foot Exam: </div>
			<?php 
			foreach ($lists as $key => $list) {
				$selected = ( $list == $item['foot'] ) ? 'checked="checked"' : '' ;
				?>
				<label><input type="radio" class="itemEditForm" name="foot" value="<?=$list;?>"><?=$list;?></label> 
				<?php
			}
			?>
        </div>
        <?php
    }elseif( $part == 'retinal' ){
		$lists = array('No DR','Mind DR','Moderate DR','Severe DR');
        ?>
        <div>
			<div>แก้ไขข้อมูล Retinal Exam: </div>
            <?php 
			foreach ($lists as $key => $list) {
				$selected = ( $list == $item['retinal'] ) ? 'checked="checked"' : '' ;
				?>
				<label><input type="radio" class="itemEditForm" name="retinal" value="<?=$list;?>" <?=$selected;?>><?=$list;?></label> 
				<?php
			}
			?>
        </div>
        <?php
    }elseif( $part == 'tooth' ){
		$lists = array(0 => 'ไม่ได้รับการตรวจ', 1 => 'ได้รับการตรวจ');
        ?>
        <div>
			<div>แก้ไขข้อมูล ตรวจสุขภาพฟัน: </div>
			<?php 
			foreach ($lists as $key => $list) {
				$selected = ( $key === $item['tooth'] ) ? 'checked="checked"' : '' ;
				?>
				<label><input type="radio" class="itemEditForm" name="tooth" value="<?=$list;?>" <?=$selected;?>><?=$list;?></label> 
				<?php
			}
			?>
        </div>
        <?php
    }
    ?>
    <div>
        <button type="submit" id="btnSaveEditForm">บันทึกข้อมูล</button>
        <input type="hidden" name="editFormPart" id="editFormPart" value="<?=$part;?>">
        <input type="hidden" name="editFormId" id="editFormId" value="<?=$id;?>">
    </div>
</form>