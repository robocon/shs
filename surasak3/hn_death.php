<link href="sm3_style.css" rel="stylesheet" type="text/css" />
<body onLoad="hide()">


<script>
function hide(){
	
	var opd=document.getElementById('opd1').checked;
	var ipd=document.getElementById('opd2').checked;
	
	if(opd==true){
		document.getElementById('show1').style.display='';
		document.getElementById('show2').style.display='none';
	}else if(ipd==true){
		document.getElementById('show1').style.display='none';
		document.getElementById('show2').style.display='';
	}else{
		document.getElementById('show1').style.display='none';
		document.getElementById('show2').style.display='none';
	}
}
</script>
<fieldset class="fontsara1" style="width:50%">
  <legend>�к� HN </legend><form id="form1" name="form1" method="post" >
  <table border="0" align="center">
    <tr>
      <td colspan="2"><input type="radio" name="opd" id="opd1" value="opd"  onClick="hide()">
        �����¹͡ 
        <input type="radio" name="opd" id="opd2" value="ipd" onClick="hide()">
        �������</td>
      </tr>
    <tr id="show1">
      <td>HN:</td>
      <td><input name="cHn" type="text" class="fontsara1" id="cHn" value="<?=$_POST['cHn'];?>" /></td>
    </tr>
    <tr id="show2">
      <td>AN:</td>
      <td>
      <input name="cAn" type="text" class="fontsara1" id="cAn" value="<?=$_POST['cAn'];?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="fontsara1" id="button" value="��ŧ" /><a target=_self  href='../nindex.htm'><<�����</a>&nbsp;&nbsp;<a target=_self  href='report_death.php'>��§ҹ����駵��</a>
    </td>
    </tr>
  </table>
</form>
</fieldset>
<? 
	include("connect.inc");

if(isset($_POST['button'])){
	

	
if($_POST['opd']=='opd'){
$sql="SELECT *,concat(yot,name,' ',surname)as ptname FROM `opcard` WHERE hn='".$_POST['cHn']."' ";
}else if($_POST['opd']=='ipd'){
$sql="SELECT * FROM `ipcard` WHERE an='".$_POST['cAn']."' ";
}

$query=mysql_query($sql) or die (mysql_error());
$arr=mysql_fetch_array($query);

	$sqlid="SELECT idcard FROM `opcard` WHERE hn='$arr[hn]' ";
	$queryid=mysql_query($sqlid) or die (mysql_error());
	$arrid=mysql_fetch_array($queryid);
	
	///// runno //////
$year_now = substr(date("Y")+543,2);	
	
	$sqlrunno="SELECT prefix,runno FROM `runno` WHERE `title` = 'death' ";
	$queryrunno=mysql_query($sqlrunno) or die (mysql_error());
	$arrrunno=mysql_fetch_array($queryrunno);
	
if($arrrunno['prefix']!=$year_now){

$sql1= "Update runno set prefix = '$year_now', runno = 1 where  title = 'death'";
$result1 = mysql_Query($sql1);
}

?>
<form id="form2" name="form2" method="post" >
<table width="50%" border="0" >
  <tr>
    <td width="34%">HN
    : <strong>
    <?=$arr['hn'];?>
    </strong></td>
    <td width="66%">AN :
      <strong>
      <?=$arr['an'];?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="2">����-ʡ��
    : <strong>
    <?=$arr['ptname'];?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="2">ID : <strong>
      <?=$arrid['idcard'];?>
    </strong></td>
  </tr>
<!--  <tr>
    <td colspan="2">�����Ţ����駵�� : <?//=$arrrunno['runno'];?></td>
  </tr>-->
  <tr>
    <td colspan="2">
    <input type="hidden" name="ptname" value="<?=$arr['ptname'];?>">
    <input type="hidden" name="hn" value="<?=$arr['hn'];?>">
    <input type="hidden" name="an" value="<?=$arr['an'];?>">
    <input type="hidden" name="pid" value="<?=$arrid['idcard'];?>">
    <input type="hidden" name="prefix" value="<?=$arrrunno['prefix'];?>">
    <input type="hidden" name="runno" value="<?=$arrrunno['runno'];?>">
    <input type="submit" name="button2" id="button2" value="���Ţ����駵��" class="fontsara1">
    </td>
  </tr>
</table>
</form>

<?
 } 
if(isset($_POST['button2'])){
	
	$d_update=date('Y-m-d H:i:s');
	
$sqlstr="INSERT INTO `death` (`hospcode` , `pid` , `runno` , `hn` , `an` , `d_update` )
VALUES ('11512', '".$_POST['pid']."','".$_POST['prefix'].'/'.$_POST['runno']."', '".$_POST['hn']."', '".$_POST['an']."','".$d_update."');";
$strquery=mysql_query($sqlstr) or die (mysql_error());
	
		$nRunno=$_POST['runno']+1;
		
		$query ="UPDATE runno SET runno = $nRunno  WHERE title='death'";
		$result = mysql_query($query) or die("Query failed runno");	
		
		if($_POST['an']!=''){
		$an="AN: <strong>$_POST[an]</strong>";	
		}
		
		if($strquery){
		echo "<BR><BR>";	
		echo "<div align=\"center\" class='fontsara2'><strong>$_POST[ptname]</strong>  HN: <strong>$_POST[hn]</strong> $an</div>";	
		echo "<div align=\"center\" class='fontsara2'>�Ţ����駵�¤�� <strong>$_POST[runno]/$_POST[prefix]</strong></div>";	
		//echo "<a href='hn_death.php'></a>";
		}
	
}



?>
</body>