<?  session_start(); ?>
<style>
.style2 {
	color: #0033FF;
	font-size: 12px;
}
.style3 {
	font-weight: bold;
	font-size: 14px;
	color: #336600;
}
.style4 {color: #FFFFFF}
.style5 {
	font-size: 14px;
	font:Tahoma;
}
.style6 {color: #0033FF; font-size: 12px; }
.style7 {color: #333333}
.style12 {font-size: 12}
.style13 {color: #0066FF ;font-weight:bold; }
.style14 {font-size: 12px; }
.style51 {font-size: 12px; color: #0000FF; }
.style61 {color: #999900}
.menu {
	color: #F00;
	font-size: 12px;
}
</style>

<script language="JavaScript" type="text/javascript">
	var cnt = 0; 
	var tbl = null; 
	function init() { 
		tbl = document.getElementById('tbl'); 
	} 
	
	function addRow() { 
		cnt++; 
		var tr = tbl.insertRow(tbl.rows.length - 2); 
		tr.id = 'tr_' + cnt; 
		var td = tr.insertCell(0); 
		var s = '<div class="style51"> ไฟล์เอกสาร : <input name="attach[]" type="file" id="attach_' + cnt + '" size="50" /> '; 
		s += ' <a href="#" onclick="return removeRow(' + cnt + ')">ลบออก</a></div>'; 
		td.innerHTML = s; 
		
		return false; 
	} 
	
	function removeRow(id) { 
		var o = document.getElementById('tr_'+id); 
		tbl.deleteRow(o.rowIndex); 
		return false; 
	} 
</script>
<script language="javascript">
////// เช็คค่าว่าง
function fncSubmit(){

	var fn = document.f1;
	
	if(fn.depart.selectedIndex==0){
		alert('กรุณาระบุแผนกด้วยครับ');
		fn.depart.focus();
		return false;
	}
	if(fn.doc_name.value==""){
		alert('กรุณาระบุชื่อเอกสารด้วยครับ');
		fn.doc_name.focus();
		return false;
	}
	
	if(fn.attach_0.value==""){
		alert('อัพโหลดเอกสารด้วยครับ');
		fn.attach_0.focus();
		return false;
	}
	if(fn.post_name.value==""){
		alert('กรุณาระบุชื่อผู้อัพโหลดด้วยครับ');
		fn.post_name.focus();
		return false;
	}
	fn.submit();
}
</script>
<?
include("connect.inc");

/*$sql="select max(row_id) from document";
$result=mysql_query($sql);
$r=mysql_fetch_array($result);
$id_max=$r[0]+1;*/
$sql = "select * from document order by row_id desc" ;
$result = mysql_query($sql) ;
$num_result  = mysql_num_rows($result) ;
$dbarr = mysql_fetch_row($result) ;
$id_max = $dbarr[0]+1 ; // นำค่า id มาเพิ่มให้กับค่ารหัสครั้งละ1

?>
<form action="" method="post"  enctype="multipart/form-data" name="f1" id="f1" onSubmit="JavaScript:return fncSubmit()">
	<table width="765"  border="0" align="center" class="fontthai" bgcolor="#FFFFCC">
		<tr>
			<td colspan="2" align="center" class="style13">ระบบจัดเก็บองค์ความรู้</td>
		</tr>
		<tr>
			<td class="style51">แผนก :</td>
			<td>
				<select name="depart" size="1" class="style5">
					<option value="0" >- - เลือก - - </option>
					<?
					$sql = "select * From departments  where status='y' order by id  asc";
					$result = mysql_query($sql);
					while($row= mysql_fetch_array($result))
					{
					$name = $row["name"];
					
					echo "<option value='$name'>$name</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr class="style51">
			<td >เลขที่เอกสาร :</td>
			<td><input name="doc_id" type="text" id="doc_id" size="30" maxlength="100" readonly="readonly" value="<?=$id_max ;?>" /></td>
		</tr>
		<tr class="style51">
			<td width="14%" >ชื่อเอกสาร :</td>
			<td width="86%">
				<input name="doc_name" type="text"  id="doc_name" size="70" maxlength="100" />*
			</td>
		</tr>
		<tr class="style51">
			<td colspan="2" ><hr></td>
		</tr>
		<tr class="style51">
			<td colspan="2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tbl" onclick="init()" align="center" valign='top'  bgcolor="#FFFFCC">
					<tr>
						<td class="style51"  bgcolor="#FFFFCC" width="100%">
							ไฟล์เอกสาร : <input type="file" name="attach[]" id="attach_0" size="50" />
							<a href="#" onclick="return addRow()">+ เพิ่มรายการอัพโหลด</a><span class="menu">//เลือกไฟล์ช่องนี้ก่อน</span>
						</td>
					</tr>
					<tr>
						<td width="100%" align="center" class="style51"><a href="#" onclick="return addRow()"></a></td>
					</tr>
				</table>
	
			</td>
		</tr>
		<tr class="style51">
			<td colspan="2" ><hr></td>
		</tr>
		<tr class="style51">
			<td >ผู้จัดเก็บเอกสาร :</td>
			<td ><input name="post_name" type="text" class="style5" id="post_name" size="30" maxlength="100" /></td>
		</tr>
		<tr class="style5">
			<td align="right" >&nbsp;</td>
			<td ></td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td>
				<input name="Submit" type="submit" class="style13" value="บันทึกข้อมูล" />
				<input name="Reset" type="reset" class="style13" value="Reset" />
				<div align="center"><a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก </a> &nbsp;&nbsp; <a href="document_Search2.php" class="forntsarabun">ค้นหาเอกสาร </a> || <a href="document_list.php">เอกสารตามแผนก</a></div> 
			</td>
		</tr>
	</table>
</form>

<?php
if(isset($_POST['Submit'])){

	include("connect.inc");

	$id=$_POST['doc_id'];

	$sql="INSERT INTO  `document` (  `row_id` ,  `doc_id` ,  `depart` ,  `doc_name` ,  `post_name` ,  `doc_date` ) 
	VALUES ('',  '".$_POST['doc_id']."',  '".$_POST['depart']."',  '".$_POST['doc_name']."',  '".$_POST['post_name']."',  '".date("Y-m-d H:i:s")."')";
	$sql_query= mysql_query($sql) or die(mysql_error());

//echo $sql;
/////////////
	$structure = 'document_file/'; 

	$attach = $_FILES['attach'];

/*if (!mkdir($structure, 0777, true)) {
die('Failed to create folders...');
}*/
////////////
	$n=1;
	for($i=0;$i<count($attach['name']);$i++){
	
		$document=$attach['tmp_name'][$i];
		$document_name=$attach['name'][$i];
		$document_size=$attach['size'][$i]['size'];
		$document_type=$attach['type'][$i];
		
		
		if(empty($document)) //ตรวจสอบว่ามีค่าหรือไม่
		{
			echo"<CENTER>คุณไม่ได้เลือกไฟล์เอกสารแนบ  หรือ <BR> ขนาดไฟล์ที่คุณทำการ Upload นั้นอาจมีขนาดใหญ่เกินไป . กรุณาเลือกไฟล์ใหม่  </CENTER>";
		} else{
			$thai=explode('.',$document_name);
		
			$ext=strtolower(end(explode('.',$document_name)));
			if($ext=="rar" or $ext=="zip" or $ext=="doc" or $ext=="xls" or $ext=="xlsx" or $ext=="pdf" or $ext=="ppt" or $ext=="pptx" or $ext=="docx" or $ext=="JPG"or $ext=="jpg")
			{
			
				$filename=$id.'_'.$n.".". $ext;
				
				copy($document, "$structure/$filename");
				
				
				$sql = "INSERT  INTO  document_file";
				$sql .="(doc_id ,file_name,name_thai,file_type) ";
				$sql .="VALUES";
				$sql .="('".$_POST['doc_id']."','".$filename."','".$thai[0]."','".$ext."')";
				$sql_query1 = mysql_query($sql) or die ("Error Query [".$sql."]"); 
				
				
				//echo $sql;
			}else{
				echo "<FONT SIZE=\"\" COLOR=\"#CC0000\"><B><CENTER>ไฟล์ที่คุณเลือก ไม่สามารถ Upload ได้ กรุณาเลือกไฟล์ที่มีนามสกุลดังนี้  .doc .docx .xls .ppt .pdf .rar .zip  </CENTER></B></FONT> ";
			}
		}			//ปิดไฟล์แนบ
		
		
		$n++;	
	} //for

	if($sql_query && $sql_query1){
		echo "<meta http-equiv=refresh content=5;URL=document_Search2.php>";
		echo "<br><CENTER><B><FONT SIZE=\"+1\" COLOR=\"#CC0000\">อัพโหลดเอกสารเรียบร้อยแล้ว<BR> กรุณารอสักครู่เพื่อไปยังหน้าดาวน์โหลดไฟล์.......</FONT></B></CENTER><br>";	
	}

}//if 
?>
