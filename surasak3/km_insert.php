<html>
<head>
<title>เพิ่มไฟล์เอกสาร</title>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>
<body>
<form action="" name="frmAdd" method="post" enctype="multipart/form-data" >
<table align="center">
<tr>
<td height="50">
เลือกจำนวนไฟล์ที่ต้องการเพิ่ม : 
  <select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
<?
for($i=1;$i<=10;$i++)
{
	if($_GET["Line"] == $i)
	{
		$sel = "selected";
	}
	else
	{
		$sel = "";
	}
?>
	<option value="<?=$_SERVER["PHP_SELF"];?>?doc_id=<?=$_GET['doc_id'];?>&Line=<?=$i;?>" <?=$sel;?>><?=$i;?></option>
<?
}
?>
</select>
  <?
  $line = $_GET["Line"];
  if($line == 0){$line=1;}
  for($i=1;$i<=$line;$i++)
  {
  ?>
  
  
  </td>
  </tr>
<tr>
  <td><input name="file[]" type="file"></td>
  <?
  }
  ?>
</tr>
<tr>
  <td align="center"><input type="submit" name="submit" value="submit">
    <input type="hidden" name="hdnLine" value="<?=$i;?>"></td>
  </tr>
  </table>
  </form>
  
  
  <?
  if($_POST['submit']){
	  
include("connect.inc");	  

$structure = 'km_file/';	  
$attach = $_FILES['file'];

$id=$_GET['doc_id'];  
	  
$sql="SELECT doc_id ,file_name  FROM `km_file` WHERE `doc_id` = '".$id."'
ORDER BY `file_name` DESC  LIMIT 1";
$sql_query= mysql_query($sql) or die (mysql_error());
$arr= mysql_fetch_array($sql_query);


$sub1=explode('.',$arr['file_name']);

$sub2=explode('_',$sub1[0]);


$n=$sub2[1]+1;


//echo $n."<br>";
for($i=0;$i<count($attach['name']);$i++)
	{
	
	$document=$attach['tmp_name'][$i];
	$document_name=$attach['name'][$i];
	$document_size=$attach['size'][$i]['size'];
	$document_type=$attach['type'][$i];
			
			if(empty($document)) //ตรวจสอบว่ามีค่าหรือไม่
				{
				echo"<CENTER>คุณไม่ได้เลือกไฟล์เอกสารแนบ  หรือ <BR> ขนาดไฟล์ที่คุณทำการ Upload นั้นอาจมีขนาดใหญ่เกินไป . กรุณาเลือกไฟล์ใหม่  </CENTER>";
				}else
					{
						$thai=explode('.',$document_name);
						
						$ext=strtolower(end(explode('.',$document_name)));
						if($ext=="doc" or $ext=="xls" or $ext=="xlsx" or $ext=="pdf" or $ext=="ppt" or $ext=="pptx" or $ext=="docx" or $ext=="JPG"or $ext=="jpg")
							{
								
								$filename=$arr['doc_id'].'_'.$n.".". $ext;
								
								copy($document, "$structure/$filename");
								
												
				$sql = "INSERT  INTO  km_file";
				$sql .="(doc_id ,file_name,name_thai,file_type) ";
				$sql .="VALUES";
				$sql .="('".$arr['doc_id']."','".$filename."','".$thai[0]."','".$ext."')";
				$sql_query1 = mysql_query($sql) or die ("Error Query [".$sql."]"); 
								//echo $filename."<br>";
								
								
	$n++;						
	}
	} 
 }
 
if($sql_query1){
		
//echo "<meta http-equiv=refresh content=5;URL=document_Search2.php>";
echo "<br><CENTER><B><FONT SIZE=\"+1\" COLOR=\"#CC0000\">อัพโหลดเอกสารเรียบร้อยแล้ว<BR> กรุณารอสักครู่เพื่อไปยังหน้าดาวน์โหลดไฟล์.......</FONT></B></CENTER><br>";	
?>
<script>
window.opener.location.reload();

setTimeout("window.close()",3000);
</script>
<?
}  
  
  }
  ?>
</body>
</html>