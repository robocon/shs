<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
		font-size:20px;
}
-->
</style>
</head>
<style type="text/css">
<!--
.style3 {font-size: 14px}
-->

@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

</style>
	<link type="text/css" href="datepicker/css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="datepicker/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
		<script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() +543);//


		    // �óյ�ͧ�����軯ԷԹŧ��ҡ���� 1 �ѹ���˹�� ����������� Code ����÷Ѵ��ҹ��ҧ���¤�Ѻ (1 �ش = 1 ��ԷԹ)
  $("#datepicker-th-1").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay,dayNames: ['�ҷԵ��','�ѹ���','�ѧ���','�ظ','����ʺ��','�ء��','�����'],
              dayNamesMin: ['��.','�.','�.','�.','��.','�.','�.'],
              monthNames: ['���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�'],
              monthNamesShort: ['�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.']});



		    $("#datepicker-th-2").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay,dayNames: ['�ҷԵ��','�ѹ���','�ѧ���','�ظ','����ʺ��','�ء��','�����'],
              dayNamesMin: ['��.','�.','�.','�.','��.','�.','�.'],
              monthNames: ['���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�'],
              monthNamesShort: ['�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.']});

     		    $("#datepicker-en").datepicker({ dateFormat: 'dd/mm/yy'});

		    $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });


			});
		</script>


<body>
<h3 align="center" class="forntsarabun">����¹����Ѻ��ԡ��͹������㹧ҹ���ҧ��������Ԥ����ѹ�ä</h3>
<h4 align="center" class="forntsarabun"> ��ͧ��Ǩ�ä�����¹͡ �ç��Һ�Ť�������ѡ��������</h4>
<div align="center" class="forntsarabun">
<div id="no_print">
  <FORM METHOD="POST" ACTION="" name="FrmR" enctype="multipart/form-data" >
	<span class="style14">������ѹ��� : &nbsp;&nbsp;
	 <input name="date1" type="text" class="forntsarabun" id="datepicker-th-1" size="10" />
&nbsp;&nbsp;&nbsp;&nbsp;�֧�ѹ��� :   &nbsp;&nbsp;
	 <input name="date2" type="text" class="forntsarabun" id="datepicker-th-2" size="10" />
	</span>	&nbsp;&nbsp;&nbsp;&nbsp;
<INPUT TYPE="submit"  name="SubReoprt" value="View Report" class="forntsarabun">
 <input type="button" name="button"  class="forntsarabun" value="��������§ҹ"  onClick="JavaScript:window.print();">  
   <input type=button value='��Ѻ����'  class="forntsarabun" onClick="window.location='service.php'">&nbsp;
 <input type=button value='��Ѻ˹���á'  class="forntsarabun" onClick="window.location='../nindex.htm'">
</FORM>
</div>
</div>
<?
include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

$date1=$_POST['date1'];
$date2=$_POST['date2'];


$id=$_GET[id];
$day=date('Y-m-d');
					  
if($date1!='' ||$date2!='' ){
	$sql="SELECT  * FROM
  `opcard` INNER JOIN
  `tb_service` ON `tb_service`.`hn` = `opcard`.`hn` INNER JOIN
  `vaccine` ON `vaccine`.`id_vac` = `tb_service`.`id_vac` where  `tb_service`.`date_ser`  between '$date1' and '$date2' and `tb_service`.`id_vac`='$id' order by `tb_service`.`date_ser` desc ";

}else{
$sql="SELECT  * FROM
  `opcard` INNER JOIN
  `tb_service` ON `tb_service`.`hn` = `opcard`.`hn` INNER JOIN
  `vaccine` ON `vaccine`.`id_vac` = `tb_service`.`id_vac` where  `tb_service`.`id_vac`='$id' order by `tb_service`.`date_ser` desc ";
}


$result = mysql_query($sql);
  
$rows=mysql_num_rows($result);

$n=1;
?>

<br />
  

<table width="100%"  border="1" align="center" cellpadding="3" cellspacing="0" style="border-collapse:collapse"   bordercolor="#000000">
  <tr class="forntsarabun">
    <td  height="48" align="center" >�ӴѺ</td>
    <td  align="center" >�.�.�.</td>
    <td  align="center" >hn</td>
    <td  align="center" >���� - ʡ��</td>
    <td  align="center" >����</td>
    <td  align="center" >�������</td>
    <td align="center">�Ѥ�չ</td>
    <td  align="center" >������</td>
    <td  align="center" >LotNo</td>
    <td  align="center" >Exp.</td>
    <td  align="center" >�Ѥ�չ</td>
    <td  align="center" >������</td>
    <td  align="center" >LotNo</td>
    <td  align="center" >Exp.</td>
    <td  align="center" >ᾷ��</td>
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
	  
	  
	 
?>
<tr class="forntsarabun">
    <td align="center"><?=$n++; ?></td>
    <td><?=displaydate($row['date_ser']);?></td>
    <td align="center"><?=$row['hn'];?></td>
    <td><?=$row['yot'].$row['name'].' '.$row['surname'];?></td>
    <td><?=calcage($row['dbirth']);?></td>
    <td><?=$row['address'].' '.$row['tambol'].' '.$row['ampur'].' '.$row['changwat'];?></td>
    <td align="center"><?=$name1; ?></td>
    <td align="center"><?=$row['num'];?></td>
    <td align="center"><?=$row['lotno'];?></td>
    <td align="center"><?=$row['date_end'];?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo ""; }else{ echo $name2;}?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo ""; }else{ echo $row['num']; }?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo ""; }else{ echo $row['lotno2']; }?></td>
    <td align="center"><? if ($row['lotno2']=='' and $row['date_end2']==''){ echo ""; }else{ echo $row['date_end2']; }?></td>
    <td><?=$row['name_doc'];?></td>
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
<p>&nbsp;</p>
<table  border="1" align="center" cellpadding="3" cellspacing="0" style="border-collapse:collapse"   bordercolor="#000000" class="forntsarabun">
  <tr>
    <td align="center" bgcolor="#CCCCCC">�Ѥ�չ</td>
    <td  align="center" bgcolor="#CCCCCC">�ӹǹ����Ѻ��ԡ��</td>
  </tr>
  <tr>
    <td>MMR</td>
    <td><? if($mmr==''){ echo "0"; }else{ echo $mmr; }?> ���</td>
  </tr>
  <tr>
    <td>JEV</td>
    <td><? if($jev){ echo $jev; }else{  echo "0"; }?> ���</td>
  </tr>
  <tr>
    <td>TT</td>
    <td><? if($tt){ echo $tt; }else{ echo "0"; }?> ���</td>
  </tr>
  <tr>
    <td> VEROLAB </td>
    <td><? if($vero){ echo $vero; }else{ echo "0";; }?> ���</td>
  </tr>
  <tr>
    <td> OPV </td>
    <td><? if($opv){ echo $opv; }else{ echo "0"; }?> ���</td>
  </tr>
  <tr>
    <td> VAC ���</td>
    <td><? if($vac){ echo $vac; }else{ echo "0"; }?> ���</td>
  </tr>
  <tr>
    <td> DPT </td>
    <td><? if($dpt){ echo $dpt; }else{ echo "0"; }?> ���</td>
  </tr>
</table>

</body>
</html>