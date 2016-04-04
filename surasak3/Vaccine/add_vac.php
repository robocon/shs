<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>จัดการข้อมูลวัคซีน (เพิ่ม ลบ แก้ไข)</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend{
	
font-family:"TH SarabunPSK";
font-size: 18pt;
font-weight: bold;
color:#600;	
padding:0px 3px;

}
fieldset{

display:inline;
background-color:#FEFDDE;
/*width:300px;*/
border-color:#000;


}
</style>

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<body>


<div id="no_print">
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>หน้าหลัก</span></a></li>
        <li><a href="service.php"><span>สมุดทะเบียนวัคซีนเด็ก</span></a></li>
        <li><a href="clinic_well_baby.php"><span>คลินิก Well baby</span></a></li>
     	<li><a href="#"><span>รายงานการรับบริการวัคซีนเด็ก</span></a></li>
  	<ul>
	  	<li><a href="Report_m.php"><span>รายงานการรับบริการประจำเดือน</span></a></li>
        <li><a href="Report_vac.php"><span>รายงานการรับบริการตามวัคซีน</span></a></li>
        <li><a href="Report_all.php"><span>รายงานการรับบริการทั้งหมด</span></a></li>
        
    </ul>
    <li><a href="Report_clinic_wellbaby.php"><span>รายงาน คลินิก Well baby</span></a></li>
    <li><a href="show_edit.php"><span>แก้ไขข้อมูลวัคซีน</span></a></li>
     <li><a href="add_vac.php"><span>จัดการข้อมูลวัคซีน</span></a></li>
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>

<div align="center" class="forntsarabun">
<form action="?do=addvac" name="frmAdd" method="post">
  เพิ่มจำนวน วัคซีน : 
    <select name="menu1" onChange="MM_jumpMenu('parent',this,0)" class="forntsarabun">
<?
for($i=1;$i<=5;$i++)
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
	<option value="<?=$_SERVER["PHP_SELF"];?>?Line=<?=$i;?>" <?=$sel;?>><?=$i;?></option>
<?
}
?>
</select> &nbsp;<!--<input type=button value='กลับเมนู' onClick="window.location='service.php'">-->
    <table width="290" border="1" class="forntsarabun">
  <tr >
   <?
  $line = $_GET["Line"];
  if($line == 0){$line=1;}
  for($i=1;$i<=$line;$i++)
  {
  ?>
    <th width="131"> <div align="center">ชื่อวัคซีน <?=$i;?></div></th>
    <th width="143"><input type="text" name="txtName<?=$i;?>" size="20" class="forntsarabun"></th>
    </tr>

  <?
  }
  ?>
  </table>
  <input type="submit" name="submit" value="submit">
  <input type="hidden" name="hdnLine" value="<?=$i;?>">
  </form>
  
  
  <?
include("Connections/connect.inc.php");

$select="select  *  from  vaccine ORDER By id_vac asc";
$objQuery = mysql_query($select);

$n=1;
  ?>
  </div>
  <table  border="1" align="center" class="forntsarabun">
  <tr>
    <td  align="center" bgcolor="#CCCCCC">ลำดับที่</td>
    <td  align="center" bgcolor="#CCCCCC">ชื่อวัคซีน</td>
    <td  align="center" bgcolor="#CCCCCC">จัดการข้อมูล</td>
  </tr>
  <?
  while($dbarr=mysql_fetch_array($objQuery)){
  ?>
  <tr>
    <td><?=$n++;?></td>
    <td><?=$dbarr['vac_name'];?></td>
    <td align="center"> <a href="add_vac.php?do=frmedit&id_vac=<?=$dbarr['id_vac'];?>">แก้ไข</a> &nbsp;
    
    		<a href="JavaScript:if(confirm('คุณต้องการลบวัคซีน  <?=$dbarr['vac_name'];?> ใช่หรือไม่?')==true){window.location='add_vac.php?do=del&id_vac=<?=$dbarr['id_vac'];?>';}">ลบ</a>
&nbsp;<a href="add_vac.php?do=frmdetail&id_vac=<?=$dbarr['id_vac'];?>">เพิ่มรายละเอียด</a>
 &nbsp; <a href="add_vac.php?do=editdetail&id_vac=<?=$dbarr['id_vac'];?>">แก้ไขรายละเอียด</a>
    </td>
  </tr>
  <? 

  }
  
  ?>
</table>

<?
if($_REQUEST['do']=="addvac"){
	  
  for($i=1;$i<=$_POST["hdnLine"];$i++)
	{
		if($_POST["txtName$i"] != "")
		{
			$strSQL = "INSERT INTO vaccine ";
			$strSQL .="(vac_name) ";
			$strSQL .="VALUES ";
			$strSQL .="('".$_POST["txtName$i"]."') ";
			$objQuery = mysql_query($strSQL);
		}
	}
	echo "<h1 align=center class='forntsarabun'>เพิ่มข้อมูลเรียบร้อยแล้ว</h1>";
	echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
	
  }

elseif($_REQUEST['do']=="frmedit"){

$select2="select  *  from  vaccine  where id_vac='$_REQUEST[id_vac]' ORDER By id_vac asc";
$objQuery2 = mysql_query($select2);
$dbarr2=mysql_fetch_array($objQuery2)
?>
</br>
<form action="?do=edit" name="frmedit" method="post">
 <table width="290" border="1"  align="center" class="forntsarabun">
 			 <tr>
   			 <th width="131"> <div align="center">ชื่อวัคซีน <?=$_REQUEST['id_vac'];?></div></th>
 		     <th width="143"><input type="text" name="txtName" size="20" value=<?=$dbarr2['vac_name']?> class='forntsarabun'></th>
    </tr>
 			 <tr>
 			   <th colspan="2"><input type="submit" name="submit" value="submit">
               						   <input type="hidden" name="id_vac" value="<?=$_REQUEST['id_vac'];?>">
              </th>
   </tr>
</table>
</form>

<?
	
}elseif($_REQUEST['do']=="del"){
	
	
			$strSQL = "delete from vaccine  WHERE  id_vac='".$_REQUEST["id_vac"]."' ";
			$objQuery = mysql_query($strSQL);
				
			if($objQuery){
				
					echo "<h1 align=center class='forntsarabun'>ลบข้อมูลเรียบร้อยแล้ว</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
					
			}else{
				
					echo "<h1 align=center class='forntsarabun'>ไม่สามารถลบได้</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
					
			}



}elseif($_REQUEST['do']=="edit"){
	
	if($_POST["txtName"] != "")
		{
			$strSQL = "UPDATE vaccine  SET vac_name='".$_POST["txtName"]."' WHERE  id_vac='".$_POST["id_vac"]."' ";
			$objQuery = mysql_query($strSQL);
		
		
		
		if($objQuery){
				
					echo "<h1 align=center class='forntsarabun'>แก้ไขข้อมูลเรียบร้อยแล้ว</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
					
			}else{
				
					echo "<h1 align=center class='forntsarabun'>ไม่สามารถแก้ไขได้</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
				
			}
	}
}elseif($_REQUEST['do']=="frmdetail"){
	
	$ref_id_vac=$_REQUEST['id_vac'];
?>
</br>
<form action="?do=adddetail" name="frmdetail" method="post">
<table  border="1" class="forntsarabun" align="center">
  <tr>
    <td>วัคซีน</td>
    <td><select name="id_vac" id="id_vac" class="forntsarabun">
        <?
		$sql="select * from vaccine";
		$result=mysql_query($sql);
	  	while($rs=mysql_fetch_array($result)) {
			$id_vac=$rs[id_vac];
			$vac_name=$rs[vac_name];
			if ($ref_id_vac==$id_vac) {
				echo "<OPTION VALUE='$id_vac' SELECTED>$vac_name</OPTION>";
			} else {
				echo "<OPTION VALUE='$id_vac' >$vac_name</OPTION>";
			}
		}
	  ?>
      </select></td>
  </tr>
  <tr>
    <td>เข็มที่</td>
    <td><input type="text" name="sno" class="forntsarabun"></td>
  </tr>
  <tr>
    <td>รายละเอียด</td>
    <td><input type="text" name="detail" class="forntsarabun"></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><label>
      <input type="submit" name="button" id="button" value="Submit">
    </label></td>
  </tr>
</table>
</form>


<?
	
	
}elseif($_REQUEST['do']=="adddetail"){
	
		if($_POST["sno"] != "" and $_POST["detail"] != "")
		{
			$strSQL = "INSERT INTO vaccine_detail ";
			$strSQL .="(id_vac,syringe_no,detail) ";
			$strSQL .="VALUES ";
			$strSQL .="('".$_POST["id_vac"]."','".$_POST["sno"]."','".$_POST["detail"]."') ";
			$objQuery = mysql_query($strSQL);
		}
	echo "<h1 align=center class='forntsarabun'>เพิ่มข้อมูลเรียบร้อยแล้ว</h1>";
	echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";

}elseif($_REQUEST['do']=="editdetail"){
	
$ref_id_vac=$_REQUEST['id_vac'];


$sql1="select * from vaccine_detail WHERE id_vac='$ref_id_vac' Order by syringe_no ASC";
$result1=mysql_query($sql1);

?>
</br>

<form action="?do=editdetail2" name="frmdetail2" method="post">
<table  border="1" class="forntsarabun" align="center">
  <tr>
    <td>วัคซีน</td>
    <td>เข็มที่</td>
    <td>รายละเอียด</td>
    <td>แก้ไข</td>
    <td>ลบ</td>
  </tr>
  <? while($rs1=mysql_fetch_array($result1)){ ?>
  <tr>
    <td><select name="id_vac" id="id_vac" class="forntsarabun" disabled>
        <?
		$sql="select * from vaccine";
		$result=mysql_query($sql);
	  	while($rs=mysql_fetch_array($result)) {
			$id_vac=$rs[id_vac];
			$vac_name=$rs[vac_name];
			if ($ref_id_vac==$id_vac) {
				echo "<OPTION VALUE='$id_vac' SELECTED>$vac_name</OPTION>";
			} else {
				echo "<OPTION VALUE='$id_vac' >$vac_name</OPTION>";
			}
		}
	  ?>
      </select></td>
    <td><input type="text" name="sno" class="forntsarabun" value="<?=$rs1['syringe_no'];?>" disabled></td>
    <td><input type="text" name="detail" class="forntsarabun" value="<?=$rs1['detail'];?>" disabled></td>
    <td><a href="?do=frmeditdetail2&&id_no=<?=$rs1['id_no'];?>&&id_vac=<?=$ref_id_vac;?>">แก้ไข</a></td>
    <td><a href="?do=deldetail2&&id_no=<?=$rs1['id_no'];?>">ลบ</a></td>
  </tr>
    <? } ?>

</table>
</form>
<p>
  <?
}elseif($_REQUEST['do']=="frmeditdetail2"){
	
$id_no=$_REQUEST['id_no'];	
$ref_id_vac=$_REQUEST['id_vac'];

$sql1="select * from vaccine_detail WHERE id_no='$id_no'";
$result1=mysql_query($sql1);
$rs1=mysql_fetch_array($result1);
?>	
</p>
<p>&nbsp;</p>
<form action="?do=frmeditdetail22" name="frmdetail22" method="post">
  <table  border="1" class="forntsarabun" align="center">
  <tr>
    <td>วัคซีน</td>
    <td>เข็มที่</td>
    <td>รายละเอียด</td>
    </tr>
  <tr>
    <td><select name="id_vac" id="id_vac" class="forntsarabun">
        <?
		$sql="select * from vaccine";
		$result=mysql_query($sql);
	  	while($rs=mysql_fetch_array($result)) {
			$id_vac=$rs[id_vac];
			$vac_name=$rs[vac_name];
			if ($ref_id_vac==$id_vac) {
				echo "<OPTION VALUE='$id_vac' SELECTED>$vac_name</OPTION>";
			} else {
				echo "<OPTION VALUE='$id_vac' >$vac_name</OPTION>";
			}
		}
	  ?>
      </select></td>
    <td><input type="text" name="sno" class="forntsarabun" value="<?=$rs1['syringe_no'];?>"></td>
    <td><input type="text" name="detail" class="forntsarabun" value="<?=$rs1['detail'];?>"></td>
    </tr>
  <tr>
    <td colspan="3" align="center"><label>
      <input type="submit" name="button" id="button" value="Submit">
    </label><input type="hidden" name="id_no" value="<?=$rs1['id_no'];?>"></td>
    </tr>
</table>
</form>				
<?	
}elseif($_REQUEST['do']=="frmeditdetail22"){
	
	$id_no=$_REQUEST['id_no'];
	
	if($_REQUEST["sno"] != "" || $_REQUEST["detail"] != ""){
		
			$sql = "UPDATE vaccine_detail  SET 
			id_vac='".$_REQUEST["id_vac"]."',
			syringe_no='".$_REQUEST["sno"]."',
			detail='".$_REQUEST["detail"]."'
			WHERE  id_no='".$id_no."' ";
			$objQuery = mysql_query($sql);

					echo "<h1 align=center class='forntsarabun'>แก้ไขข้อมูลเรียบร้อยแล้ว</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";

	}
}elseif($_REQUEST['do']=="deldetail2"){
	
	
			$strSQL = "delete from vaccine  WHERE  id_vac='".$_REQUEST["id_vac"]."' ";
			$objQuery = mysql_query($strSQL);
				
			if($objQuery){
				
					echo "<h1 align=center class='forntsarabun'>ลบข้อมูลเรียบร้อยแล้ว</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
					
			}else{
				
					echo "<h1 align=center class='forntsarabun'>ไม่สามารถลบได้</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
					
			}



}
?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>