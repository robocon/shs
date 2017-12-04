<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>

<div align="center">
<h1 > อัพโหลด ไฟล์ </h1>
<?
include("../Connections/connect.inc.php"); 

$id=$_REQUEST['id'];	


$query = "SELECT row_id,hn,an,ptname,detail,date FROM patdata WHERE row_id = '$id'";
$result = mysql_query($query) or die("Query failed");
$dbarr= mysql_fetch_array($result);




?>

<table width='46%' border='0'>
  <tr>
    <td width="16%" bgcolor="#CCCCCC">HN</td>
    <td width="28%"><?=$dbarr['hn'];?></td>
    <td width="10%" bgcolor="#CCCCCC">AN</td>
    <td width="46%"><?=$dbarr['an'];?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">ชื่อ-สกุล</td>
    <td><?=$dbarr['ptname'];?></td>
    <td bgcolor="#CCCCCC">รายการ</td>
    <td><?=$dbarr['detail'];?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">วันและเวลา</td>
    <td><?=$dbarr['date'];?></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<form name="upload" action="?do=uploadfile&id=<?=$id;?>" enctype="multipart/form-data" method="post">
  <input type="file" name="fileupload" />
<input type="submit" name="submit" value="อัพโหลด" />
<input type="hidden" name="row_id" value="<?=$id;?>"> &nbsp;
<input name="btnButton" type="button" value="กลับไปรายการ" onclick='JavaScript:history.back();' />
</form>
<br/>
<?
if($_REQUEST['do']=="uploadfile"){
	
$id=$_REQUEST['id'];
$row_id=$_POST[row_id];
	
$fileupload=$_FILES['fileupload']['tmp_name'];
$fileupload_name=$_FILES['fileupload']['name'];
$fileupload_size=$_FILES['fileupload']['size'];
$fileupload_type=$_FILES['fileupload']['type'];


			if(empty($fileupload))
				{
							echo "<FONT SIZE=\"\" COLOR=\"#CC0000\"><B><CENTER>คุณยังไม่ได้เลือกไฟล์</CENTER></B></FONT> ";
							//echo "<meta http-equiv=refresh content=1;URL=upload.php?id='$id'>";
				} else
					{
						$ext=strtolower(end(explode('.',$fileupload_name)));
						if($ext=="pdf" or $ext=="PDF" or $ext=="jpg")
							{

								$filename=$row_id.".". $ext;
		
								copy($fileupload, "dcorder/$filename");

								//$sql="update news set news_pdf='$filename1' where news_id='$news_id' ";
							  //	$sql_query = mysql_query($sql) or die ("Error Query [".$sql."]");
							
								echo "<H3  class='style5'>อัพโหลดไฟล์เรียบร้อยแล้ว</H3>";
								echo "<meta http-equiv=refresh content=1;URL=hnlabcheck.php>";
								}else
								{
								echo "<FONT SIZE=\"\" COLOR=\"#CC0000\"><B><CENTER>ไฟล์ที่คุณเลือก ไม่สามารถ Upload ได้ กรุณาเลือกไฟล์ที่มีนามสกุล .pdf เท่านั้นครับ</CENTER></B></FONT> ";
								//echo "<meta http-equiv=refresh content=5;URL=upload.php?id=$id>";
								}
								
					}	

}
?>
</div>
</body>
</html>