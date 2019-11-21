<?php 
include 'bootstrap.php';
$db = Mysql::load();
$id = input_post('id');
$part = input_post('part');

$action = input_post('action');
if ( $action === 'save' ) {
	
	if( $part !== 'foot' AND $part !== 'retinal' AND $part !== 'tooth' ){
		echo 'Invalid input';
		exit;
	}

	$part = input_post('part');
	$id = $_POST['id'];
	$result = $_POST['result'];
	
	$sql = "UPDATE `diabetes_clinic_history` SET `$part` = :result WHERE `row_id` = :id ";
	$save = $db->update($sql, array(':result' => $result, ':id' => $id));
	$resTxt = 'true';
	$msg = "บันทึกข้อมูลเรียบร้อย";
	if( $save !== true ){
		$resTxt = 'false';
		$msg = errorMsg('save', $save['id']);
	}
	
	echo '{"resTxt":'.$resTxt.',"msg":"'.$msg.'"}';
	exit;
	
}
?>
<style>
label{
	cursor: pointer;
}
#formEditResponse{
	border: 2px solid #868800;
    background-color: #ffff92;
    padding: 2px;
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
				<label><input type="radio" class="itemEditForm" name="foot" value="<?=$list;?>" <?=$selected;?>><?=$list;?></label> 
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
				$selected = '';
				if( $item['tooth'] != '' ){
					$selected = ( $key == $item['tooth'] ) ? 'checked="checked"' : '' ;
				}
				?>
				<label><input type="radio" class="itemEditForm" name="tooth" value="<?=$key;?>" <?=$selected;?>><?=$list;?></label> 
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
<div id="formEditResponse" style="display: none;"></div>