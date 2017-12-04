<? 
session_start();
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<title>:: การบันทึกภาพจากกล้องเว็บแคมเป็นรูปภาพ ::</title>
<STYLE type=text/css>
  A:link { color: #0000cc; text-decoration:none}
  A:visited {color: #0000cc; text-decoration: none}
  A:hover {color: red; text-decoration: none}
 </STYLE>
<style type="text/css">
<!--
small { font-family: Arial, Helvetica, sans-serif; font-size: 8pt; } 
input, textarea { font-family: Arial, Helvetica, sans-serif; font-size: 9pt; } 
b { font-family: Arial, Helvetica, sans-serif; font-size: 12pt; } 
big { font-family: Arial, Helvetica, sans-serif; font-size: 14pt; } 
strong { font-family: Arial, Helvetica, sans-serif; font-size: 11pt; font-weight : extra-bold; } 
font, td { font-family: Arial, Helvetica, sans-serif; font-size: 11pt; } 
BODY { font-size: 11pt; font-family: Arial, Helvetica, sans-serif; } 
-->
</style>


</head>

<body>
<center>

<p><big>ระบบบันทึกภาพจากกล้องเว็บแคมเป็นรูปภาพ </big>
  
  <br>
  <br>
  
<!-- แทรกไฟล์ croflash.swf ลงไปใน Code ด้านล่างครับ (หลักการเหมือนแทรกรูปภาพธรรมดา) -->
  <object width="550" height="400">
    <param name="movie" value="croflash.swf">
    <embed src="croflash.swf" width="550" height="400">
    </embed>
  </object>
  
  <br>
  <br>
  HN : <?=$_GET['hn'];?><br>
  ชื่อ- สกุล : <?=$_GET['yot'].$_GET['name1'].' '.$_GET['name2'];?><br>
  ID : <input type="text" name="id" id="id" value="<?=$_GET['id'];?>" readonly>
  
  <? 
  
  $_SESSION['id']=$_GET['id'];
  ?>
  <br>
  1. กดที่ Allow  จะเป็นการเปิดกล้องให้ทำงาน<br>
  2. กดที่ "Take a Snapshot" เพื่อถ่ายภาพ<br>
<br></center>
</body>

</html>
