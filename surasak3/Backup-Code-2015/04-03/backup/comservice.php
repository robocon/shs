<?
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>บันทึกการปฏิบัติงาน ศูนย์คอมพิวเตอร์</title>
<style type="text/css">
<!--
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
.style2 {	font-size: 22px;
	font-weight: bold;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style3 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<?
if($_POST["act"]=="add"){
$keydate =date('Y-m-d');
$keytime =date('H:i:s');
$datekey =$keydate." ".$keytime;
$add = "insert into comservice set datework ='$_POST[datework]',
													timework ='$_POST[timework]',
													depart='$_POST[depart]',
													idsupport='$_POST[idsupport]',
													personal='$_POST[personal]',
													detail='$_POST[detail]',
													type='$_POST[type]',
													user='$_POST[user]',
													location='$_POST[location]',													
													datekey='$datekey' ";
				if(mysql_query($add)){
					echo "<script>alert('บันทึกข้อมูลสำเร็จ');window.location='showcomservice.php';</script>";									
				}else{
					echo "<script>alert('ผิดพลาด บันทึกข้อมูลไม่สำเร็จ');window.location='comservice.php';</script>";
				}
}
?>
<body>
<table width="80%" border="0" align="center">
  <tr>
    <td colspan="2" align="center" bgcolor="#3399CC"><span class="style3">บันทึกการปฏิบัติงานประจำวัน</span></td>
  </tr>
  <tr>
    <td width="46%"><strong><a target="_self"  href='../nindex.htm'>&lt;--------- ไปเมนู</a></strong></td>
    <td width="54%" align="right"><a href="showcomservice.php">ดูข้อมูล</a></td>
  </tr>
</table>
<? if($_GET["act"]=="win"){
$num = "A";
list($y,$m,$d)=explode("-",$datecomin);
$y=$y-543;
$newdate="$y-$m-$d";

$newtime = substr($_GET["datecomin"],11,5);


$sql = "SELECT  * FROM com_support   WHERE status ='$num' and row='$_GET[row]' ORDER BY row  ";
$query=mysql_query($sql); 
$num=mysql_num_rows($query);  
$rows =mysql_fetch_array($query);
	$datecomin = substr($rows["date"],0,10); 
	list($y,$m,$d)=explode("-",$datecomin);
	$y=$y-543;
	$newdate="$y-$m-$d";

	$newtime = substr($rows["date"],11,5);	
	
	$runnumber = $rows["row"];
	$user = $rows["user"];
	$detail = $rows["detail"];
	$programmer = $rows["programmer"];

?>
<form id="form1" name="form1" method="post" action="comservice.php">
<input name="act" type="hidden" value="add" />
<input name="idsupport" type="hidden" value="<?=$runnumber;?>" />
  <table width="100%" border="0" align="center" bgcolor="#CCCCCC">
    <tr>
      <td width="40%" align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>แผนกที่ร้องขอ : </strong></td>
      <td width="60%" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="depart" id="depart" class="forntsarabun">
          <option value="0">----------เลือกแผนก----------</option>
          <?
		  				$num = "A";
						$sql ="SELECT * FROM com_support WHERE status ='$num' and row='$_GET[row]'"; //ข้อมูลจากตารางหลัก
						$rs = mysql_query($sql);
						$rowsdb = mysql_fetch_array($rs);
						$depart = $rowsdb['depart']; //ฟิลที่นำมาโชว์ก่อนการแก้ไขข้อมูล
					?>
          <?
						$query1 = "SELECT * from departments where status='y' order by name asc";
						$result1 = mysql_query($query1);
						while($tbrows=mysql_fetch_assoc($result1)){
							if($tbrows['name'] == $depart)
							{
					?>
          <option value="<?=$tbrows['name'];?>" selected="selected">
          <?=$tbrows['name']?>
          </option>
          <?
					}else{
					?>
          <option value="<?=$tbrows['name'];?>" >
          <?=$tbrows['name']?>
          </option>
          <?
						}
					}
					?>
        </select></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>ชื่อผู้ร้องขอ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><label>
        <input name="personal" type="text" id="personal" value="<?="($runnumber) $user";?>" size="30" class="forntsarabun" />
      <a href="com_support.php" target="_blank"><span style="font-size:16px; color:#FF0000;">ข้อมูลแจ้งปรับปรุง</span></a></label></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>วันที่ปฏิบัติงาน :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="datework" type="text" class="forntsarabun" id="datework" value="<? echo date('Y-m-d');?>" size="10" />        &nbsp;&nbsp;&nbsp;<span class="style2">เวลา : 
          <input name="timework" type="text" class="forntsarabun" id="timework" value="<? echo date('H:i');?>" size="5" /> 
      น.</span></td>
    </tr>
    <tr>
      <td align="right" valign="top" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>ประเภทงาน :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="type" id="type" class="forntsarabun">
        <option value="0" selected="selected">----------เลือก----------</option>
        <option value="1">โปรแกรม SHS</option>
        <option value="2">โปรแกรมอื่นๆ</option>
        <option value="3">SHS+โปรแกรมอื่นๆ</option>
        <option value="4">ฮาร์ดแวร์</option>
        <option value="5">ธุรการ/อื่นๆ</option>
            </select></td>
    </tr>
    <tr>
      <td align="right" valign="top" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>รายละเอียดงานที่ทำ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><label>
        <textarea name="detail" id="detail" cols="80" rows="10" class="forntsarabun"><?=$detail;?></textarea>
      </label></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>สถานที่ปฏิบัติงาน :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="location" type="text" id="location" value="ห้องโปรแกรมเมอร์" size="40" class="forntsarabun" /></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>ผู้รับผิดชอบงาน :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="user" id="user" class="forntsarabun">
        <option value="0" selected="selected" >----------เลือก----------</option>
        <option value="นายเพลิงพายุ  อุปนันท์" selected="selected" <? if($programmer=="เพลิงพายุ"){ echo "selected='selected'";}?>>เพลิงพายุ  อุปนันท์</option>
        <option value="นายภูมินทร์  อุปนันท์" <? if($programmer=="ภูมินทร์"){ echo "selected='selected'";}?>>ภูมินทร์  อุปนันท์</option>
        <option value="นายเทวิน  ศรีแก้ว" <? if($programmer=="เทวิน"){ echo "selected='selected'";}?>>เทวิน  ศรีแก้ว</option>
      </select></td>
    </tr>
    <tr>
      <td height="48" align="right" valign="bottom" bordercolor="#CCCCCC" bgcolor="#CCCCCC">&nbsp;</td>
      <td valign="bottom" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="button" type="submit" class="forntsarabun" id="button" value="บันทึกข้อมูล" />
      &nbsp;&nbsp;
      <input name="button2" type="reset" class="forntsarabun" id="button2" value="ลบทิ้ง" /></td>
    </tr>
  </table>
</form>
<? }else{ ?>
<form id="form1" name="form1" method="post" action="comservice.php">
<input name="act" type="hidden" value="add" />
  <table width="80%" border="0" align="center" bgcolor="#CCCCCC">
    <tr>
      <td width="20%" align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>แผนกที่ร้องขอ : </strong></td>
      <td width="80%" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="depart" id="depart" class="forntsarabun">
        <option value="0">----------เลือกแผนก----------</option>
        <?
		$sql="select  *  from   departments where status='y' order by id asc";
		$result=mysql_query($sql);
			while($arr=mysql_fetch_array($result)) {
    		echo '<option value="'.$arr['name'].'">'.$arr['name'].' </option>';
		}
	  ?>
      </select></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>ชื่อผู้ร้องขอ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><label>
        <input name="personal" type="text" id="personal" size="30" class="forntsarabun" />
      </label></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>วันที่ปฏิบัติงาน :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="datework" type="text" class="forntsarabun" id="datework" value="<? echo date('Y-m-d');?>" size="10" />
      &nbsp;&nbsp;&nbsp;<span class="style2">เวลา : 
      <input name="timework" type="text" class="forntsarabun" id="timework" value="<? echo date('H:i');?>" size="5" /> 
      น.</span></td>
    </tr>
    <tr>
      <td align="right" valign="top" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>ประเภทงาน :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="type" id="type" class="forntsarabun">
        <option value="0" selected="selected">----------เลือก----------</option>
        <option value="1">โปรแกรม SHS</option>
        <option value="2">โปรแกรมอื่นๆ</option>
        <option value="3">SHS+โปรแกรมอื่นๆ</option>
        <option value="4">ฮาร์ดแวร์</option>
        <option value="5">ธุรการ/อื่นๆ</option>
            </select></td>
    </tr>
    <tr>
      <td align="right" valign="top" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>รายละเอียดงานที่ทำ :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><label>
        <textarea name="detail" id="detail" cols="80" rows="10" class="forntsarabun"></textarea>
      </label></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>สถานที่ปฏิบัติงาน :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="location" type="text" id="location" size="40" class="forntsarabun" value="ห้องโปรแกรมเมอร์" /></td>
    </tr>
    <tr>
      <td align="right" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><strong>ผู้รับผิดชอบงาน :</strong></td>
      <td bordercolor="#CCCCCC" bgcolor="#CCCCCC"><select name="user" id="user" class="forntsarabun">
        <option value="0" selected="selected" >----------เลือก----------</option>
        <option value="นายเพลิงพายุ  อุปนันท์">เพลิงพายุ  อุปนันท์</option>
        <option value="นายภูมินทร์  อุปนันท์">ภูมินทร์  อุปนันท์</option>
        <option value="นายเทวิน  ศรีแก้ว">เทวิน  ศรีแก้ว</option>
		<option value="นายกฤษณะศักดิ์ กันธรส">กฤษณะศักดิ์ กันธรส</option>
      </select>      </td>
    </tr>
    <tr>
      <td height="48" align="right" valign="bottom" bordercolor="#CCCCCC" bgcolor="#CCCCCC">&nbsp;</td>
      <td valign="bottom" bordercolor="#CCCCCC" bgcolor="#CCCCCC"><input name="button" type="submit" class="forntsarabun" id="button" value="บันทึกข้อมูล" />
      &nbsp;&nbsp;
      <input name="button2" type="reset" class="forntsarabun" id="button2" value="ลบทิ้ง" /></td>
    </tr>
  </table>
</form>
<? } ?>
<p>&nbsp;</p>
</body>
</html>
