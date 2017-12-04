<?php
session_start();
include("connect.inc");
if($_POST["act"]=="edit"){
       $edit="update drug_interaction set effect='$_POST[effect]',
															action='$_POST[action]',
															follow='$_POST[follow]',
															onset='$_POST[onset]',
															violence='$_POST[violence]',
															referable='$_POST[referable]',
															status='$_POST[status]' where first_drugcode='$_POST[first]' and between_drugcode='$_POST[second]'";
   if(mysql_query($edit)){
  echo "<script>alert('แก้ไขข้อมูลเสร็จแล้ว');window.location='showdruginteraction.php';</script>";													
  }else{
  echo "<script>alert('ผิดพลาด ไม่สามารถแก้ไขข้อมูลได้');window.location='editdruginteraction.php?first=$_POST[first]&second=$_POST[second]';</script>";	
  }
}
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
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
-->
</style>
<div align="center">
<?
$sql="select * from drug_interaction where first_drugcode='$_GET[first]' and between_drugcode='$_GET[second]'";
$query=mysql_query($sql) or die ("Query Error");
$rows=mysql_fetch_array($query);
?>
  <form name="form1" method="post" action="editdruginteraction.php">
  <input name="act" type="hidden" value="edit">
  <input name="first" type="hidden" value="<?=$rows["first_drugcode"];?>">
  <input name="second" type="hidden" value="<?=$rows["between_drugcode"];?>">  
    <p align="center"><strong>แก้ไขข้อมูล Drug Interaction</strong></p>
    <div align="center"><a href="../nindex.htm">ไปหน้าแรก</a> || <a href="showdruginteraction.php">ข้อมูล drug interaction</a></div>
    <hr>
    <table width="80%" height="302" border="0" cellpadding="5" cellspacing="0">
      <tr>
        <td width="35%" align="right"><strong>first_drugcode</strong></td>
        <td width="3%" align="center"><strong>:</strong></td>
        <td width="62%"><?=$rows["first_drugcode"];?> (<?=$rows["first_tradname"];?>
          ) (
          <?=$rows["first_genname"];?>
        )</td>
      </tr>
      <tr>
        <td align="right"><strong>between_drugcode</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><?=$rows["between_drugcode"];?> (<?=$rows["between_tradname"];?>
          ) (
          <?=$rows["first_genname"];?>
        )</td>
      </tr>
      <tr>
        <td align="right"><strong>effect</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input name="effect" type="text" id="effect" value="<?=$rows["effect"];?>"></td>
      </tr>
      <tr>
        <td align="right"><strong>action</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input name="action" type="text" id="action" value="<?=$rows["action"];?>"></td>
      </tr>
      <tr>
        <td align="right"><strong>follow</strong></td>
        <td width="3%" align="center"><strong>:</strong></td>
        <td><input name="follow" type="text" id="follow" value="<?=$rows["follow"];?>"></td>
      </tr>
      <tr>
        <td align="right"><strong>onset</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input name="onset" type="text" id="onset" value="<?=$rows["onset"];?>"></td>
      </tr>
      <tr>
        <td align="right"><strong>violence</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input name="violence" type="text" id="violence" value="<?=$rows["violence"];?>"></td>
      </tr>
      <tr>
        <td align="right"><strong>referable</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input name="referable" type="text" id="referable" value="<?=$rows["referable"];?>"></td>
      </tr>
      <tr>
        <td align="right"><strong>ลักษณะการ Lock</strong></td>
        <td align="center"><strong>:</strong></td>
        <td><input name="status" type="radio" id="radio" value="lock" <? if($rows["status"]=="lock"){ echo "checked";}?>>
          Lock
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="status" id="radio2" value="popup" <? if($rows["status"]=="popup"){ echo "checked";}?>>
          Popup </td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td>
          <input type="submit" name="Submit" id="button" value="Update"></td>
      </tr>
    </table>
  </form>
</div>

