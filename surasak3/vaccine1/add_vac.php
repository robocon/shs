<html>
<head>
<title>���������� �Ѥ�չ</title>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>
<body>
<div align="center" class="forntsarabun">
<form action="?do=addvac" name="frmAdd" method="post">
  �����ӹǹ �Ѥ�չ : 
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
</select> &nbsp;<input type=button value='��Ѻ����' onClick="window.location='service.php'">
    <table width="290" border="1" class="forntsarabun">
  <tr >
   <?
  $line = $_GET["Line"];
  if($line == 0){$line=1;}
  for($i=1;$i<=$line;$i++)
  {
  ?>
    <th width="131"> <div align="center">�����Ѥ�չ <?=$i;?></div></th>
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
    <td  align="center" bgcolor="#CCCCCC">�ӴѺ���</td>
    <td  align="center" bgcolor="#CCCCCC">�����Ѥ�չ</td>
    <td  align="center" bgcolor="#CCCCCC">�Ѵ��â�����</td>
  </tr>
  <?
  while($dbarr=mysql_fetch_array($objQuery)){
  ?>
  <tr>
    <td><?=$n++;?></td>
    <td><?=$dbarr['vac_name'];?></td>
    <td align="center"> <a href="add_vac.php?do=frmedit&id_vac=<?=$dbarr['id_vac'];?>">���</a> &nbsp;
    
    		<a href="JavaScript:if(confirm('�س��ͧ���ź�Ѥ�չ  <?=$dbarr['vac_name'];?> ���������?')==true){window.location='add_vac.php?do=del&id_vac=<?=$dbarr['id_vac'];?>';}">ź</a>
&nbsp;<a href="add_vac.php?do=frmdetail&id_vac=<?=$dbarr['id_vac'];?>">������������´</a>
 &nbsp; <a href="add_vac.php?do=editdetail&id_vac=<?=$dbarr['id_vac'];?>">�����������´</a>
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
	echo "<h1 align=center class='forntsarabun'>�������������º��������</h1>";
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
   			 <th width="131"> <div align="center">�����Ѥ�չ <?=$_REQUEST['id_vac'];?></div></th>
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
				
					echo "<h1 align=center class='forntsarabun'>ź���������º��������</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
					
			}else{
				
					echo "<h1 align=center class='forntsarabun'>�������öź��</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
					
			}



}elseif($_REQUEST['do']=="edit"){
	
	if($_POST["txtName"] != "")
		{
			$strSQL = "UPDATE vaccine  SET vac_name='".$_POST["txtName"]."' WHERE  id_vac='".$_POST["id_vac"]."' ";
			$objQuery = mysql_query($strSQL);
		
		
		
		if($objQuery){
				
					echo "<h1 align=center class='forntsarabun'>��䢢��������º��������</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
					
			}else{
				
					echo "<h1 align=center class='forntsarabun'>�������ö�����</h1>";
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
    <td>�Ѥ�չ</td>
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
    <td>������</td>
    <td><input type="text" name="sno" class="forntsarabun"></td>
  </tr>
  <tr>
    <td>��������´</td>
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
	echo "<h1 align=center class='forntsarabun'>�������������º��������</h1>";
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
    <td>�Ѥ�չ</td>
    <td>������</td>
    <td>��������´</td>
    <td>���</td>
    <td>ź</td>
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
    <td><a href="?do=frmeditdetail2&&id_no=<?=$rs1['id_no'];?>&&id_vac=<?=$ref_id_vac;?>">���</a></td>
    <td><a href="?do=deldetail2&&id_no=<?=$rs1['id_no'];?>">ź</a></td>
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
    <td>�Ѥ�չ</td>
    <td>������</td>
    <td>��������´</td>
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

					echo "<h1 align=center class='forntsarabun'>��䢢��������º��������</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";

	}
}elseif($_REQUEST['do']=="deldetail2"){
	
	
			$strSQL = "delete from vaccine  WHERE  id_vac='".$_REQUEST["id_vac"]."' ";
			$objQuery = mysql_query($strSQL);
				
			if($objQuery){
				
					echo "<h1 align=center class='forntsarabun'>ź���������º��������</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
					
			}else{
				
					echo "<h1 align=center class='forntsarabun'>�������öź��</h1>";
					echo "<meta http-equiv=refresh content=2;URL=add_vac.php>";
					
			}



}
?>
</body>
</html>
