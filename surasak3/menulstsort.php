<?php
session_start();
include("connect.php");

function dump($t){
	echo '<pre>';
	var_dump($t);
	echo '</pre>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>จัดเรียงเมนู</title>
	<script src="js/sweetalert2.all.min.js"></script>
</head>
<body>

<link type="text/css" href="sm3_style.css" rel="stylesheet" />
<style>
	*{
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	body{
		padding: 4px;
	}
	#userMainMenu > tr:hover, #addMenu > tr:hover{
		background-color: #ADDFFF;
	}
	.removeItem{
		opacity:0.5;
		text-decoration: none;
	}

	#userMainMenu tr:hover .removeItem{
		opacity:1;
	}
	.clearfix::after {
		content: "";
		clear: both;
		display: table;
	}
	button:hover{
		cursor: pointer;
	}
</style>
<a href="../nindex.htm" class="fontsara"><--ไปเมนู </a>
<BR />
<div class="fontsara"><br>** กรุณาใส่ตัวเลขในช่องเฉพาะที่ต้องการเรียงเมนูค่ะ ** <br></div>
<div class="fontsara">เรียงลำดับเมนูทั้งหมด <?=$x;?> รายการ <br></div>

<div class="clearfix">
	<div style="float:left;">
		<form METHOD="POST" ACTION="menulstsort_edit.php" id="inputForm" onsubmit="onSubmitForm()">
			<table style="border-collapse:collapse" bordercolor="#000000" cellpadding="0" cellspacing="0" border="1" class="fontsara1">
				<thead>
					<tr bgcolor="#ffff99" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
						<th width="40" align="center">#</th>
						<th>เมนู</th>
						<th>ลำดับที่</th>
					</tr>
				</thead>
				<tbody id="userMainMenu">
					<?php 
					$sRowid = $_SESSION['sRowid'];
					$smenucode = $_SESSION['smenucode'];
					
					/**
					 * รายการเมนุ default
					 */
					$department_menu = array();
					$query = sprintf("SELECT `row_id`,`menu`,`script`,`target`,menu_sort AS `sort` FROM `menulst` WHERE `menucode` = '%s' GROUP BY `script` ORDER BY `menu_sort` ASC", mysql_real_escape_string($smenucode));
					$result = mysql_query($query) or die("Query failed : ".mysql_error());
					$department_numrow = mysql_num_rows($result);
					if($department_numrow > 0){
						while ($a = mysql_fetch_assoc($result)) {
							$department_menu[] = $a;
						}
					}

					// dump($department_menu);

					/**
					 * menu_user เป็นเมนูที่ user จัดเรียงเอง จะเป็นตารางที่ถูกเก็บแยกออกมาต่างหาก
					 */
					$items = array();
					$query1 = sprintf("SELECT `row_id`,`menu`,`link` AS `script`,`target`,`sort` FROM `menu_user` WHERE `member_code`='$sRowid' ORDER BY `sort`,`row_id` ", mysql_real_escape_string($sRowid));
					$result1 = mysql_query($query1) or die("Query failed : ".mysql_error());
					$menuUserRows = $numrow = mysql_num_rows($result1);
					if($numrow > 0){
						while ($a = mysql_fetch_assoc($result1)) {
							$items[] = $a;
						}
					}else{
						$items = $department_menu;
						$numrow = $department_numrow;
					}

					// หาว่าจาก menulst ที่เป็นเมนูหลัก มีอะไรบ้างที่ menu_user ไม่มีใน menulst
					$diffItems = array_diff_assoc($department_menu, $items);
					
					$n = 1;
					foreach($items AS $row){
						?>
						<tr id="leftTr<?=$row['row_id'];?>">
							<td align="center"><?=$n;?></td>
							<td><?=$row['menu'];?></td>
							<td align='right'>
								<input type="text" name="sort[]" value='<?=$row['sort'];?>' size="5" class="fontsara1">

								<input type="hidden" name="row_id[]" value="<?=$row['row_id'];?>">
								<input type="hidden" name="script[]" value="<?=$row['script'];?>">
								<input type="hidden" name="menu[]" value="<?=$row['menu'];?>">
								<input type="hidden" name="target[]" value="<?=$row['target'];?>">

								<?php
								if($menuUserRows>0){
									?><a href="javascript:void(0);" onclick="removeItem('<?=$row['row_id'];?>')" class="removeItem" title="ลบเมนู">❌</a><?php
								}
								?>
								
							</td>
						</tr>
						<?
						$n++;
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3" align="center">
							<input type='hidden' name="max" value="<?=$numrow;?>">
							<input type="submit" value="  บันทึกการจัดเรียงเมนู  " name="edit" class="fontsara">
							<input type="hidden" name="action" value="save">
						</td>
					</tr>
				</tfoot>
			</table>
		</form>
	</div>
	<?php
	if(count($diffItems)>0){
	?>
	<div style="float:left; margin-left:8px;">
		<div>
			<table>
				<thead>
					<tr>
						<th colspan="2" style="text-align:center;">เพิ่มเมนู</th>
					</tr>
				</thead>
				<tbody id="addMenu">
				<?php
				foreach ($diffItems as $diff) {
					?>
					<tr>
						<td>
							<!-- คลิกแล้ว send post ไป save ให้เรียบร้อย ถ้า response 200 กลับมา ให้ดึงเอาข้อมูล ส่งไปสร้าง tr ใหม่ในฟอร์มทางซ้ายมือ -->
							<button type="button" style="padding:2px 4px;" onclick="addMenuToLeft(this)" 
							data-id="<?=$diff['row_id'];?>" 
							data-sort="<?=$diff['sort'];?>" 
							data-script="<?=$diff['script'];?>" 
							data-menu="<?=$diff['menu'];?>" 
							data-target="<?=$diff['target'];?>"
							>⬅👈 Add </button>
						</td>
						<td>&nbsp;&nbsp;<?=$diff['menu'];?></td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
			<?php
			?>
		</div>
	</div>
	<?php
	}
	?>
	
</div>

<script>

	const Toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 800,
		// timerProgressBar: true,
		didOpen: (toast) => {
			toast.onmouseenter = Swal.stopTimer;
			toast.onmouseleave = Swal.resumeTimer;
		}
	});
	
	function removeItem(id){

		const formData = new FormData();
		formData.append("action", "del");
		formData.append("id", id);

		const postData = new URLSearchParams(formData).toString();
		sendForm('menulstsort_edit.php', postData).then((res)=>{
			if(res.status===200){
				Toast.fire({
					icon: "success",
					title: res.msg
				}).then((test)=>{
					location.reload();
				});
			}else{
				Swal.fire({
					icon: "error",
					title: res.msg
				})
			}
		});

		//document.getElementById('leftTr'+id).remove();
		

	}

	function addMenuToLeft(v){
		const id = v.getAttribute('data-id');
		const sort = v.getAttribute('data-sort');
		const script = v.getAttribute('data-script');
		const menu = v.getAttribute('data-menu');
		const target = v.getAttribute('data-target');

		const formData = new FormData();
		formData.append("action", "insert_one");
		formData.append("id", id);
		formData.append("sort", sort);
		formData.append("script", script);
		formData.append("menu", menu);
		formData.append("target", target);
		const postData = new URLSearchParams(formData).toString();

		sendForm('menulstsort_edit.php', postData).then((res)=>{
			if(res.status===200){
				Toast.fire({
					icon: "success",
					title: res.msg
				}).then((test)=>{
					location.reload();
				});
			}else{
				Swal.fire({
					icon: "error",
					title: res.msg
				})
			}
		});
		
	}

	function onSubmitForm(){
		event.preventDefault();

		const allFormData = document.getElementById('inputForm');
		const url = allFormData.getAttribute('action');

		const formData = new FormData(allFormData);
		const postData = new URLSearchParams(formData).toString();

		sendForm(url, postData).then((res)=>{
			let swalIcon = "success";
			if(res.status===400){
				let swalIcon = "error";
			}

			Swal.fire({
				icon: swalIcon,
				title: res.msg
			}).then(()=>{
				location.reload();
			});
		});
	}

	async function sendForm(url, dataPost){
		let response = await fetch(url, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
			},
			body: dataPost
		});
		const body = await response.json();
		return body;
	}
</script>

</body>
</html>