<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>��ش����¹����Ѻ��ԡ���Ѥ�չ��</title>
    <style type="text/css">

.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}

.style3 {font-size: 14px}

} 

</style>
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
<?php include 'main_menu.php'; ?>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->

<? $y=date('Y')+543;
	$m=date('m');
	$d=date('d');
	$datetime=$d.'/'.$m.'/'.$y;?>

<h3 align="center" class="forntsarabun">��䢢����š�ú�ԡ���Ѥ�չ</h3>

<div align="center" class="forntsarabun">
<div id="no_print" >
<FORM METHOD="POST" ACTION="" name="FrmR" enctype="multipart/form-data" >
	<span class="style14">�ѹ��� : &nbsp;&nbsp;
	 <input name="date1" type="text" class="forntsarabun" value="<?=$datetime;?>" />
&nbsp;</span>&nbsp;&nbsp;&nbsp;
<INPUT  name="SubReoprt" TYPE="submit" class="forntsarabun" value="����"> 

   <input type=button class="forntsarabun" onClick="window.location='service.php'" value='��Ѻ����'>&nbsp;
 <input type=button class="forntsarabun" onClick="window.location='../../nindex.htm'" value='��Ѻ˹���á'>
</FORM>
</div>
</div>
<?


include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

$date1=$_POST['date1'];

				  
if($date1!=''){
	$sql="SELECT  * FROM
  `opcard` INNER JOIN
  `tb_service` ON `tb_service`.`hn` = `opcard`.`hn` INNER JOIN
  `vaccine` ON `vaccine`.`id_vac` = `tb_service`.`id_vac` where  `tb_service`.`date_ser` like  '%$date1%'  order by `tb_service`.`date_ser` desc ";

}else{
	
$sql="SELECT  * FROM
  `opcard` INNER JOIN
  `tb_service` ON `tb_service`.`hn` = `opcard`.`hn` INNER JOIN
  `vaccine` ON `vaccine`.`id_vac` = `tb_service`.`id_vac` order by `tb_service`.`date_ser` desc ";
}


$result = mysql_query($sql);
  
$rows=mysql_num_rows($result);

$n=1;
?>

<br />
  

<table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="#000000">
  <tr class="forntsarabun"  bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td  height="48" align="center" bgcolor="#FF99FF" >�ӴѺ</td>
    <td  align="center" bgcolor="#FF99FF" >�.�.�.</td>
    <td  align="center" bgcolor="#FF99FF" >hn</td>
    <td  align="center" bgcolor="#FF99FF" >���� - ʡ��</td>
    <td  align="center" bgcolor="#FF99FF" >����</td>
    <td  align="center" bgcolor="#FF99FF" >�������</td>
    <td align="center" bgcolor="#FF99FF">�Ѥ�չ</td>
    <td  align="center" bgcolor="#FF99FF" >������</td>
    <td  align="center" bgcolor="#FF99FF" >LotNo</td>
    <td  align="center" bgcolor="#FF99FF" >Exp.</td>
    <td  align="center" bgcolor="#FF99FF" >�Ѥ�չ</td>
    <td  align="center" bgcolor="#FF99FF" >������</td>
    <td  align="center" bgcolor="#FF99FF" >LotNo</td>
    <td  align="center" bgcolor="#FF99FF" >Exp.</td>
    <td  align="center" bgcolor="#FF99FF" >ᾷ��</td>
    <td  align="center" bgcolor="#FF99FF" >���</td>
    <td  align="center" bgcolor="#FF99FF" >ź</td>
  </tr>
<?

if($rows){


  while($row= mysql_fetch_array($result)){
	  
if($row['vac_name']=="VAC+OPV"){
		  
		  $name1=substr($row['vac_name'],0,3);
		  
		   if($name1=="VAC"){ 
		   $vac++; 
	  	   }
		  $name2=substr($row['vac_name'],4,3);
		  
		   if($name2=="OPV"){ 
		   $opv++; 
	  	   }

	  }elseif($row['vac_name']=="DPT+OPV"){
		  
		  $name1=substr($row['vac_name'],0,3);
		 	
			if($name1=="DPT"){ 
		   $dpt++; 
	  	   }
		  
		  $name2=substr($row['vac_name'],4,3);
		  
		  if($name2=="OPV"){ 
		   $opv++; 
	  	   }
		   
	  }else{
		$name1=$row['vac_name'];  
		
		
		if($name1=="MMR"){ 
		   $mmr++; 
	  	   }elseif($name1=="JEV"){ 
		   $jev++; 
	  	   }elseif($name1=="TT"){ 
		   $tt++; 
	  	   }elseif($name1=="VEROLAB"){ 
		   $vero++; 
	  	   }
	  }
	  
	  
	  $y=substr($row['date_ser'],0,4);
$m=substr($row['date_ser'],5,2);
$d=substr($row['date_ser'],8,2);

$y=$y+543;
switch($m){
		case "01": $printmonth = "�.�."; break;
		case "02": $printmonth = "�.�."; break;
		case "03": $printmonth = "��.�."; break;
		case "04": $printmonth = "��.�."; break;
		case "05": $printmonth = "�.�."; break;
		case "06": $printmonth = "��.�."; break;
		case "07": $printmonth = "�.�."; break;
		case "08": $printmonth = "�.�."; break;
		case "09": $printmonth = "�.�."; break;
		case "10": $printmonth = "�.�."; break;
		case "11": $printmonth = "�.�."; break;
		case "12": $printmonth = "�.�."; break;
	}
	
   $dateshow=$d." ".$printmonth." ".$y;

?>
<tr class="forntsarabun" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td align="center"><?=$n++; ?></td>
    <td><?=$dateshow;?></td>
    <td align="center"><?=$row['hn'];?></td>
    <td><?=$row['yot'].$row['name'].' '.$row['surname'];?></td>
    <td><?=calcage($row['dbirth']);?></td>
    <td><?=$row['address'].' '.$row['tambol'].' '.$row['ampur'].' '.$row['changwat'];?></td>
    <td align="center"><?= $name1;?></td>
    <td align="center"><?=$row['num'];?></td>
    <td align="center"><?=$row['lotno'];?></td>
    <td align="center"><?=$row['date_end'];?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo ""; }else{ echo $name2; }?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo ""; }else{ echo $row['num']; }?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo ""; }else{ echo $row['lotno2']; }?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo ""; }else{ echo $row['date_end2']; }?></td>
    <td><?=$row['name_doc'];?></td>
    <td align="center"><a href="show_edit2.php?id_s=<?=$row['id_s'];?>" target="_blank">���</a></td>
    <td align="center"><a href="?do=del&&id_s=<?=$row['id_s'];?>" onclick="return confirm('�׹�ѹ���ź :<?=$row['hn'];?>')">ź</a></td>
  </tr>
  <? 
  } 
  
 } else {
	echo "<tr>";
 	echo "<td colspan='10' align=center class='forntsarabun'><font color=red>�ѧ�������¡��</font></td>";
	echo "</tr>";
}
?>

</table>

<? 
if($_REQUEST['do']=='del'){
	

$sqldel="delete from tb_service where id_s ='".$_GET['id_s']."'  ";

$query=mysql_query($sqldel);

if($query){
echo "ź���������º��ͺ����";	
echo "<meta http-equiv=refresh content=2;URL=show_edit.php>";
}else{
echo "�������öź��������";	
echo "<meta http-equiv=refresh content=2;URL=show_edit.php>";
}
}


?>

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>