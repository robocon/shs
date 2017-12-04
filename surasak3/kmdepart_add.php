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
.style5 {font-size: 14px;
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
<?
include("connect.inc");
?>
<form action="" method="post"  enctype="multipart/form-data" name="f1" id="f1">
  <table width="765"  border="0" align="center" class="fontthai" bgcolor="#FFCC99">
    <tr>
      <td colspan="2" align="center" class="style13">เพิ่มทีมงานในระบบ</td>
    </tr>
    <tr class="style51">
      <td colspan="2" ><hr></td>
    </tr>
    <tr class="style51">
      <td width="14%" align="right" >ชื่อทีม :</td>
      <td width="86%" ><input name="name" type="text" class="style5" id="name" size="30" maxlength="100" /></td>
    </tr>
    <tr class="style5">
      <td align="right" >&nbsp;</td>
      <td ></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input name="Submit" type="submit" class="style13" value="บันทึกข้อมูล" />
        <input name="Reset" type="reset" class="style13" value="Reset" />
        <div align="center"><a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก </a> &nbsp;&nbsp; <a href="km_Search2.php" class="forntsarabun">ค้นหาเอกสาร </a> || <a href="km_index.php">เอกสารตามประเภท</a></div>        </td>
    </tr>
  </table>
</form>

<?php
if(isset($_POST['Submit'])){

include("connect.inc");

$sql="INSERT INTO  `kmdepart` ( `name` ) 
VALUES ('".$_POST['name']."')";
$sql_query= mysql_query($sql) or die(mysql_error());

if($sql_query){
					echo "<meta http-equiv=refresh content=1;URL=km_index.php>";
echo "<br><CENTER><B><FONT SIZE=\"+1\" COLOR=\"#CC0000\">เพิ่มข้อมูลเรียบร้อยแล้ว.......</FONT></B></CENTER><br>";	
					}

}//if 
?>
