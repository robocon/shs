<html>
<head>
<title>แก้ไขข้อมูล</title>
<style type="text/css">
.font1 {	font-family: "TH Niramit AS";
	font-size:20px;
}
</style>
</head>
<body>
<form action="certificate_saveedit.php?row_id=<?=$_GET["row_id"];?>" name="frmEdit" method="post">
<?
include("connect.inc");

$strSQL = "SELECT * FROM  certificate  WHERE row_id = '".$_GET["row_id"]."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if(!$objResult)
{
	echo "Not found row_id=".$_GET["row_id"];
}
else
{
?>
<table  border="1" width="100%">
  <tr>
    <th> <div align="center">เล่มที่</div></th>
    <th> <div align="center">เลขที่</div></th>
    <th> <div align="center">HN</div></th>
    <th> <div align="center">แพทย์</div></th>
    <th> <div align="center">การวินิจฉัย </div></th>
    <th> <div align="center">ความคิดเห็น </div></th>
    <th><div align="center">ว/ด/ป ที่ออก </div></th>
  </tr>
  <tr>
    <td align="center"><div align="center"><input name="bookid" type="text" class="font1" value="<?=$objResult["bookid"];?>" size="10"></div></td>
    <td align="center"><input name="noid" type="text" class="font1" value="<?=$objResult["noid"];?>" size="10"></td>
    <td align="center"><input name="hn" type="text" class="font1" value="<?=$objResult["hn"];?>" size="20"></td>
    <td align="center"><div align="center">
      <select name="doctor" class="font1" id="doctor">
        <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		if(substr($objResult["doctor"],0,5)==substr($name,0,5)){
		echo "<option value='".$name."' selected>".$name."</option>";
		}else{
			echo "<option value='".$name."' >".$name."</option>";
		}
		}
		
		//echo substr($objResult["hn"],0,5);
		?>
      </select>
    </div></td>
    <td align="center"><textarea name="diag" cols="45" rows="2" class="font1" id="diag"><?=$objResult["diag"];?></textarea></td>
    <td align="center"><textarea name="comment" cols="45" rows="2" class="font1" id="comment"><?=$objResult["comment"];?></textarea></td>
    <td align="center"><input name="thaidate" type="text" class="font1"  value="<?=$objResult["thaidate"];?>"/></td>
  </tr>
  </table>
  <input type="submit" name="submit" value="submit">
  <?
  }

  ?>
  </form>
</body>
</html>