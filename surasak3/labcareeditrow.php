<?php
session_start();
include("connect.inc");

/**
CREATE TABLE `outlab_list` (
  `id` int(11) NOT NULL auto_increment,
  `lab_id` int(11) default NULL,
  `company_part_id` int(11) default NULL,
  `company` varchar(255) default NULL,
  `name` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;
 */

function dump($txt){
	echo "<pre>";
	var_dump($txt);
	echo "</pre>";
}

if(isset($_POST['b1'])){
	include("connect.inc");
	
	$update = "UPDATE labcare SET  
	codelab='".$_POST['codelab']."',
	outlab_name='".$_POST['outlab_name']."',
	labpart='".$_POST['part']."',
	labtype='".$_POST['labtype']."',
	labstatus='".$_POST['status']."',
	chkup='".$_POST['chkup']."',
	reportlabno='".$_POST['reportlabno']."' 
	WHERE row_id='".$_POST['rowid']."' ";
	// $query1 = mysql_query($update);

	dump($_POST);

	$lab_id = $_POST['rowid'];
	$company = $_POST['outlab_name'];

	if( count($_POST['company_part']) > 0 ){

		foreach ($_POST['company_part'] as $key => $company_part) {
			
			/**
			 * @todo
			 * [] ตรวจสอบก่อนว่ามีข้อมูลในรายการรึป่าว
			 * [] ถ้ายังไม่มีจะเพิ่ม
			 * [] ถ้ามีจะอัพเดท
			 * 
			 * 
 			 */
			$sql = "SELECT `id` FROM `outlab_list` 
			WHERE `lab_id` = '$lab_id' AND `company_part_id` = '$company_part' LIMIT 1;";

			$query = mysql_query($sql) or die( mysql_error() );
			$outlab_row = mysql_num_rows($query);
// dump($sql);
// dump($outlab_row);
			// update
			if( $outlab_row > 0 ){ // แก้ไขข้อมูล

				$sql = "UPDATE `outlab_list` SET 
				`` = '', 
				`` = '', 
				`` = '', 
				`` = '', 
				";

			}else if( $outlab_row == 0 ){ // เพิ่มข้อมูล

				// 
				$sql = "SELECT a.`company_name`,b.`name` AS `part_name` 
				FROM ( 
					SELECT `id` AS `company_id` ,`name` AS `company_name` FROM `outlab_company` WHERE `name` = '$company' 
				) AS a 
				LEFT JOIN `outlab_company_part` AS b ON b.`company_id` = a.`company_id`
				WHERE b.`id` = '$company_part' LIMIT 1";
				$query = mysql_query($sql) or die( mysql_error() );
				$part = mysql_fetch_assoc($query);
				$part_name = $part['part_name'];

				$sql = "INSERT INTO `outlab_list` (`id`,`lab_id`,`company_part_id`,`company`,`name`) VALUES 
				(NULL, '$lab_id','$company_part','$company','$part_name') ";
				$query = mysql_query($sql) or die( mysql_error() );


			}
			


		}

	}



	exit;

	if($query1){
		echo "<h1 align=center class='font1'>แก้ไขข้อมูลเสร็จเรียบร้อยแล้ว    กำลัง............กลับหน้ารายการ</h1>";
		echo "<meta http-equiv='refresh' content='3; url=labcareedit1.php'>" ;
	}
	
	
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:22px;
}
</style>
<script>

function Show(sel){
		//alert(sel);
		var obj=document.getElementById('labtype').value;
		if (obj=='OUT'){
			if(document.getElementById('sel').style.display=='none'){
			document.getElementById('sel').style.display='block';
			// document.getElementById('sel1').style.display='none';
        
			document.getElementById('outlab_part').style.display='table-row';
      

			} 
		}else if (obj=='IN'){
			
			if (document.getElementById('sel').style.display=='block'){
			document.getElementById('sel').style.display='none';
			// document.getElementById('sel1').style.display='none';
			document.getElementById('outlab_part').style.display='none';

			}
		}
	}

function fncSubmit(){
	var obj=document.getElementById('labtype').value;
	if(obj=='OUT'){
	if(document.f1.outlab_name.value=='')
	{
		alert('กรุณระบุชื่อ Lab - นอก');
		document.f1.outlab_name.focus();
		return false;
	}	
	}
	document.f1.submit();
}


</script>
<style type="text/css">
.hd{
	font-family:"Angsana New";
	font-size: 30px;
}
.forntsarabun{
	font-family:"Angsana New";
	font-size: 22px;
}
.del-item{
  color: blue;
}
.del-item:hover{
  text-decoration: underline;
  cursor: pointer;
}
</style>
<!--onsubmit="JavaScript:return fncSubmit();"--> <!--ถ้าต้องการเช็ค-->

<body onload="Show(sel);">
<?php


$sql="select * from labcare Where row_id='".$_GET['rowid']."'";

$query=mysql_query($sql);
$dbarr=mysql_fetch_array($query);
?>

<form name="f1" action="" method="post"   onSubmit="JavaScript:return fncSubmit();">
<table border="1" cellspacing="0" cellpadding="0" class="font1" style="border-collapse:collapse; font-weight: bold;" bordercolor="#666666">
  <tr>
    <td colspan="2" align="center" bgcolor="#0099FF">แก้ไขข้อมูล</td>
 
  </tr>
  <tr>
    <td>codelab</td>
    <td><input type="text" name="codelab"  value="<?php echo $dbarr['codelab'];?>" class="font1"/></td>
  </tr>
  <tr>
    <td>Part</td>
    <td><select name="part" class="font1">
     <option value="" >--กรุณาเลือก--</option>
    <option value="Heamato" <?php if($dbarr['labpart']=="Heamato"){ echo "selected"; }?>>Heamato</option>
    <option value="Chemistry" <?php if($dbarr['labpart']=="Chemistry"){ echo "selected"; }?>>Chemistry</option>
    <option value="Micros" <?php if($dbarr['labpart']=="Micros"){ echo "selected"; }?>>Micros</option>
    <option value="Micro" <?php if($dbarr['labpart']=="Micro"){ echo "selected"; }?>>Micro</option>
    <option value="Serology" <?php if($dbarr['labpart']=="Serology"){ echo "selected"; }?>>Serology</option>
    <option value="Outlab" <?php if($dbarr['labpart']=="Outlab"){ echo "selected"; }?>>Outlab</option>
    <option value="Blood Bank" <?php if($dbarr['labpart']=="Blood Bank"){ echo "selected"; }?>>Blood Bank</option>
    </select>
    </td>
  </tr>
  <tr>
    <td>ประเภทLab  </td>
    <td>
      <select name="labtype"  id="labtype" class="font1" onChange="Show(this);" >
        <option value="" >--กรุณาเลือก--</option>
        <option value="IN" <?php if($dbarr['labtype']=="IN"){ echo "selected"; }?>>LAB ใน</option>
        <option value="OUT"  <?php if($dbarr['labtype']=="OUT"){ echo "selected"; }?>>LAB นอก</option>
      </select>
<div id="sel" style="display:none"><select name="outlab_name" class="font1">
    <option value="" >--กรุณาเลือก Lab-นอก --</option>
      <option value="รัฐบาล" <?php if($dbarr['outlab_name']=="รัฐบาล"){ echo "selected"; }?>>รัฐบาล</option>
      <option value="อินเตอร์-แลป" <?php if($dbarr['outlab_name']=="อินเตอร์-แลป"){ echo "selected"; }?>>อินเตอร์-แลป</option>
      <option value="ธนบุรี-แลป" <?php if($dbarr['outlab_name']=="ธนบุรี-แลป"){ echo "selected"; }?>>ธนบุรี-แลป</option>	  <option value="กรุงเทพ-พยาธิ" <?php if($dbarr['outlab_name']=="กรุงเทพ-พยาธิ"){ echo "selected"; }?>>กรุงเทพ-พยาธิ</option>
      <option value="เมดสตาร์-แลป" <?php if($dbarr['outlab_name']=="เมดสตาร์-แลป"){ echo "selected"; }?>>เมดสตาร์-แลป</option>
    </select></div></td>
  </tr>

  <?php 
  // var_dump($dbarr);
  // if( strtolower($dbarr['labtype']) == "out" ){

    $outlab_name = $dbarr['outlab_name'];

    $sql = "SELECT b.* FROM `outlab_company` AS a 
    LEFT JOIN `outlab_company_part` AS b ON b.`company_id` = a.`id` 
    WHERE a.`name` = '$outlab_name' 
    AND b.`id` IS NOT NULL ";
    $q = mysql_query($sql);

    // $row = mysql_num_rows($q);
    // if( $row > 0 ){

      ?>
      <tr id="outlab_part" style="display:none">
        <td>
          แผนกที่ส่ง
        </td>
        <td>
          <?php 

            $outlab_list = array();
            while ( $item = mysql_fetch_assoc($q) ) {
              $outlab_list[] = $item;
			}

			$row_id = $dbarr['row_id'];

			$sql = "SELECT * FROM `outlab_list` WHERE `lab_id` = '$row_id' ";
			$q = mysql_query($sql) or die(mysql_error());
			
			while ($oLab = mysql_fetch_assoc($q)) {
				
				// dump($oLab);

				?>
				<div class="{item_key}">
				
					<select name="company_part[]" class="font1">
						<option value="">เลือกรายการ</option>
						<?php
						foreach( $outlab_list as $item ){
							$key = $item['id'];

							$selected = ( $oLab['name'] == $item['name'] ) ? 'selected="selected"' : '' ;
							?>
							<option value="<?=$key;?>" <?=$selected;?>><?=$item['name'];?></option>
							<?php
						}
						?>
					</select>
					<span class="del-item" data-del="{item_key}">[ลบ]</span>
				</div>
				<?php


			}

			
			/*
            ?>
            
            <select name="company_part[]" id="" class="font1">
              <option value="">เลือกรายการ</option>
              <?php
              foreach( $outlab_list as $item ){
                $key = $item['id'];
                ?>
                <option value="<?=$key;?>"><?=$item['name'];?></option>
                <?php
              }
              ?>
            </select>

			<!--
			หน้าแก้ไขจะมี del-item ซึ่งจะมี ajax ตรวจตอนลบด้วย
			-->
			
			<?php

			*/

			?>
            <div id="com_more"></div>

            <div>
              <button id="add_btn" type="button" onclick="test_added()">เพิ่มรายการ</button>
            </div>
        </td>
      </tr>
      <?php
    // }
  // }
  ?>
  <tr>
    <td>สถานะ</td>
    <td><select name="status" class="font1">
    <option value="" >--กรุณาเลือก--</option>
      <option value="Y" <?php if($dbarr['labstatus']=="Y"){ echo "selected"; }?>>ใช้งาน</option>
      <option value="N" <?php if($dbarr['labstatus']=="N"){ echo "selected"; }?>>ไม่ใช้งาน</option>
    </select></td>
  </tr>
    <tr>
    <td>chkup</td>
    <td><input type="text" name="chkup"  value="<?php echo $dbarr['chkup'];?>" class="font1"/></td>
  </tr>
    <tr>
      <td>Report LabNo.</td>
      <td><input type="text" name="reportlabno"  value="<?php echo $dbarr['reportlabno'];?>" class="font1"/></td>
    </tr>
  <tr>
    <td colspan="2" align="center">
     <input type="hidden" name="rowid"  value="<?=$_GET['rowid']?>" class="font1"/>
    <input type="submit" name="b1"  value="ตกลง" class="font1"/>
    <a target=_self  href='../nindex.htm' class="font1"><---- ไปเมนู</a>
    </td>
  </tr>
</table>
</form>



<script>
	
	function test_added(){

		var id_rand = Math.floor((Math.random() * 10000) + 1);

		var template_str = '<div class="{item_key}"><select name="company_part[]" class="font1">';
		template_str += '<option value="">เลือกรายการ</option>'
			<?php
			foreach( $outlab_list as $item ){
				$key = $item['id'];
				?>
				template_str += '<option value="<?=$key;?>"><?=$item['name'];?></option>';
				<?php
			}
			?>
		template_str += '</select>';
		template_str += '<span class="del-item" data-del="{item_key}">[ลบ]</span>';
		template_str += '<br></div>';


		var new_template = template_str.replace(/{item_key}/gm, id_rand);
		
		var z = document.createElement('div'); // is a node
		z.innerHTML = new_template;

		var replace_tmp = document.getElementById('com_more');
		replace_tmp.appendChild(z);
	}


</script>

<!-- ด้านล่างจะแสดงเฉพาะของ jQuery เท่านั้น -->
<script src="js/vendor/jquery-1.11.2.min.js"></script>
<script>
$.noConflict();
jQuery( document ).ready(function( $ ) {
	// Code that uses jQuery's $ can follow here.
	$(document).on('click', '.del-item', function(){
		var c=confirm('ยืนยันการลบข้อมูล?');
		if(c==false){
			return false;
		}else{
			var item_del = $(this).attr("data-del");
			$('.'+item_del).remove();
		}
	});
});
</script>
</body>
</html>