<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>��ش����¹����Ѻ��ԡ���Ѥ�չ��</title>
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
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>˹����ѡ</span></a></li>
        <li><a href="service.php"><span>��ش����¹�Ѥ�չ��</span></a></li>
        <li><a href="clinic_well_baby.php"><span>��Թԡ Well baby</span></a></li>
     	<li><a href="#"><span>��§ҹ����Ѻ��ԡ���Ѥ�չ��</span></a></li>
  	<ul>
	  	<li><a href="Report_m.php"><span>��§ҹ����Ѻ��ԡ�û�Ш���͹</span></a></li>
        <li><a href="Report_vac.php"><span>��§ҹ����Ѻ��ԡ�õ���Ѥ�չ</span></a></li>
        <li><a href="Report_all.php"><span>��§ҹ����Ѻ��ԡ�÷�����</span></a></li>
        
    </ul>
    <li><a href="Report_clinic_wellbaby.php"><span>��§ҹ ��Թԡ Well baby</span></a></li>
    <li><a href="show_edit.php"><span>��䢢������Ѥ�չ</span></a></li>
     <li><a href="add_vac.php"><span>�Ѵ��â������Ѥ�չ</span></a></li>
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<?
include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

$showdate=date("Y-m");

$d=date('Y-m-d');
$dateN=explode("-",$d);

$mm=$dateN[0].'-'.$dateN[1];
?>

<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date2'));

};
</script>

<!--<p style='page-break-before: always'></p>-->

<div align="center" class="forntsarabun">
<div id="no_print">
<FORM METHOD="POST" ACTION="" name="FrmR" enctype="multipart/form-data" >
	<span class="style14">������ѹ��� : <!--&nbsp;&nbsp;
	 <input name="date1" type="text" class="forntsarabun" id="date1" size="10" />
&nbsp;&nbsp;&nbsp;&nbsp;�֧�ѹ��� :   &nbsp;&nbsp;
	 <input name="date2" type="text" class="forntsarabun" id="date2" size="10" />
	</span>	&nbsp;&nbsp;&nbsp;&nbsp;--><select name='d_start' class="font1">
        <option value="" selected="selected">--������͡---</option>
        <? 
				//$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					//if($dd==$d){
					?>
        <option value="<?=$d;?>"> <?=$d;?></option>
        <?
				//	}else{
				?>
    <!--    <option value="<?//=$d;?>"> <?//=$d;?> </option>-->
        <?
				//}
				}
				
				?>
      </select>
        <? $m=date('m'); ?>
        <select name="m_start" class="font1">
          <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
          <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
          <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
          <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
          <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
          <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
          <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
          <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
          <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
          <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
          <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
          <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
        </select>
        <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='font1'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
          <?=$i;?>
        </option>
        <?
				}
				echo "</select>";
				?>
	<input  name="SubReoprt" type="submit" class="forntsarabun" value="View Report" />
	<input type="button" name="button"  class="forntsarabun" value="��������§ҹ"  onClick="JavaScript:window.print();">
   <input type=button value='��Ѻ����'  class="forntsarabun" onClick="window.location='service.php'">&nbsp;
 <input type=button value='��Ѻ˹���á'  class="forntsarabun" onClick="window.location='../../nindex.htm'">
</FORM>
</div>
</div>
<?
switch($_POST['m_start']){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}


$today=($_POST['y_start']-543).'-'.$_POST['m_start'].'-'.$_POST['d_start'];


if($_POST['d_start']!=""){
	$day="��Ш��ѹ���";
	$dateshow=$_POST['d_start'].' '.$printmonth." ".$_POST['y_start'];
}else{
	$day="��Ш���͹";
	
	$dateshow=$printmonth." ".$_POST['y_start'];
}

			  
if($_POST['SubReoprt']){
	
$sql="SELECT  `opcard`.`yot`,`opcard`.`name`,`opcard`.`surname`,`opcard`.`dbirth`,`well_baby`.`hn`,`well_baby`.`row_id`,`well_baby`.`weight` ,`well_baby`.`develop_age` ,`well_baby`.`growth`,`well_baby`.`breastmilk` FROM
  `opcard`  INNER JOIN
  `well_baby` ON `well_baby`.`hn` = `opcard`.`hn`  WHERE  `well_baby`.`thidate`  like  '$today%'  order by `well_baby`.`row_id` asc ";
  
}else{

$sql="SELECT  `opcard`.`yot`,`opcard`.`name`,`opcard`.`surname`,`opcard`.`dbirth`,`well_baby`.`hn`,`well_baby`.`row_id`,`well_baby`.`weight` ,`well_baby`.`develop_age` ,`well_baby`.`growth`,`well_baby`.`breastmilk`  FROM `opcard` INNER JOIN
  `well_baby` ON `well_baby`.`hn` = `opcard`.`hn` order by `well_baby`.`row_id` asc";
  
}


$result = mysql_query($sql)or die (mysql_error());
  
$rows=mysql_num_rows($result);


$n=1;
?>
<br>
<br>
<h3 align="center" class="forntsarabun">Ẻ�������úѹ�֡�����������آ�Ҿ������ 0-5 �� ��Թԡ Well baby</h3>
<h3 align="center" class="forntsarabun"><span class="forntsarabun">��ͧ��Ǩ�ä�����¹͡ �ç��Һ�Ť�������ѡ��������</span></h3>
<h3 align="center" class="forntsarabun"><span class="forntsarabun"><?=$day;?>  <?=$dateshow;?></span></h3>
<br /><table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse"   bordercolor="#000000">
 <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse"   bordercolor="#000000">
    <tr class="forntsarabun">
      <td  align="center" >�ӴѺ</td>
      <td align="center">���� - ʡ��</td>
      <td align="center">HN</td>
      <td align="center">����</td>
      <td  align="center" >���˹ѡ<br>
        (�.�)</td>
      <td align="center">�Ѳ�ҡ�������<br>
      ��ҹ��ҧ������������</td>
      <td align="center">�����ԭ�Ժ⵵���ҵðҹ������й��˹ѡ</td>
      <td align="center">�������� 0-6 ��͹</td>
      <div id="no_print">
       <td align="center" id="no_print">���</td>
       <td align="center" id="no_print">ź</td>
      </div>
      </tr>
  
<?
$r=0;
if($rows){

while($row= mysql_fetch_array($result)){
	  $r++;
	  

$y=$y+543;
/*switch($m){
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
	
   $dateshow=$d." ".$printmonth." ".$y;*/
   
   
   if($row['growth']=="N"){
	   $growth="���ࡳ��"; 
   }else  if($row['growth']=="L"){
	   $growth="��ӡ���ࡳ��"; 
   }else  if($row['growth']=="M"){
	   $growth="�Թ����ࡳ��"; 
   }
	  

	  if($r=='21'){
		 $r=1;
		echo "</table>";
		echo "<div style='page-break-after: always'> ";
		echo "<div style='page-break-before: always'> ";
?>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse"   bordercolor="#000000">
    <tr class="forntsarabun">
      <td  align="center" >�ӴѺ</td>
      <td  align="center" >���� - ʡ��</td>
       <td align="center">HN</td>
      <td  align="center" >����</td>
      <td  align="center" >���˹ѡ<br>
        (�.�)</td>
      <td align="center">�Ѳ�ҡ�������<br>
      ��ҹ��ҧ������������</td>
      <td  align="center" >�����ԭ�Ժ⵵���ҵðҹ������й��˹ѡ</td>
      <td  align="center" >�������� 2-6 ��͹</td>
      <td align="center" id="no_print">���</td>
      </tr>

<? } ?>
 <tr class="forntsarabun">
      <td align="center"><?=$n++; ?></td>
      <td><?=$row['yot'].$row['name'].' '.$row['surname'];?></td>
      <td><?=$row['hn'];?></td>
      <td><?=calcage($row['dbirth']);?></td>
      <td align="center"><?=$row['weight']?></td>
      <td><?=$row['develop_age']?></td>
      <td><?= $growth;?></td>
      <td><?=$row['breastmilk'];?></td>
       
      <td align="center" id="no_print"><a href="javascript:MM_openBrWindow('clinic_well_baby_edit.php?row_id=<?=$row['row_id'];?>','','width=600,height=600')">���</a></td>
      <td align="center"><a href="JavaScript:if(confirm('�׹�ѹ���ź������?')==true){window.location='clinic_wellbaby_del.php?row_id=<?=$row["row_id"];?>';}">ź</a></td>
      </tr>
 <?  
}
} else {
	echo "<tr>";
 	echo "<td colspan='10' align=center class='forntsarabun'><font color=red>�ѧ�������¡��</font></td>";
	echo "</tr>";
}
echo "</div>";
echo "</div>";
?>

</table>
</table>

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>