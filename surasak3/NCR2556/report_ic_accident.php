<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>�к���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>
<?php include 'menu.php'; ?>

<div><!-- InstanceBeginEditable name="detail" -->
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('nonconf_date'));

};

</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<h1 class="forntsarabun" align="center" id="no_print">��§ҹ�غѵԡ�ó� ����Ҩ�ռ����ؤ�ҡ����Ѻ��õԴ���ͨҡ��Ժѵԧҹ </h1>
<div align="center" id="no_print">
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" align="center" bgcolor="#99CC99">������غѵԡ�ó�</td>
    </tr>
  <tr class="forntsarabun">
    <td align="right"><span class="forntsarabun">��͹/��</span></td>
    <td><!--<INPUT NAME="nonconf_date" TYPE="text" class="forntsarabun" ID="nonconf_date" value="<?//php echo $date_now;?>" size="10" readonly>-->
    <? $m=date('m'); ?>
      <select name="m_start" class="forntsarabun">
      <option value="">�ٷ�駻�</option>
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
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
    </td>
    </tr>
  <!--<tr class="forntsarabun">
    <td  align="right">NCR </td>
    <td ><input type="text" name="ncr"  class="forntsarabun"/></td>
  </tr>-->
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">--><BR>* �ҡ��ͧ��ô٢����ŷ�駻� ����к� �ٷ�駻� 㹪�ͧ��͹</td>
  </tr>
</table>
</form>

<HR>

</div>
<BR>
<?php
include("connect.inc");

$month=$_POST['m_start'];

$year=$_POST['y_start'];

$date1=$year.'-'.$month;
if($month==""){
	
	$to="��";
}else{
	$to="��͹";
}

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
	  $dateshow=$printmonth." ".$_POST['y_start'];


/*if(isset($_POST['submit'])!=''){

$sql1="SELECT *  FROM  ic_accident  WHERE thidate like '".$date1."%' and depart='".$_SESSION["Codencr"]."' order by row_id  asc";

}else{*/
$sql1="SELECT  *  FROM  ic_accident  as a , departments as b WHERE a.depart=b.code  and a.thidate like '".$date1."%'   order by row_id asc";	
//}
//echo $sql1;
	
	$query1 = mysql_query($sql1)or die (mysql_error());
	$row=mysql_num_rows($query1);
	/*if($row){*/
	

	
print "<div align=\"center\"><font class='forntsarabun' >��§ҹ�غѵԡ�ó� ����Ҩ�ռ����ؤ�ҡ����Ѻ��õԴ���ͨҡ��Ժѵԧҹ   <BR>��Ш�$to $dateshow </font></div><br>";
	?>
   <table width="100%" border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td width="5%" align="center">�ӴѺ</td>
    <td align="center">�ѹ���</td>
    <td align="center">˹��§ҹ</td>
    <td align="center">����-ʡ�� </td>
 	<td align="center">�������ؤ�ҡ�</td>
 	<td align="center">�٢�����</td>
	<!--<td width="5%" align="center">�Ѵ���</td>-->

    </tr>
    <?

	$i=0;
	while($arr1=mysql_fetch_array($query1)){
		
		$accept=$arr1['accept'];
		global $accept;
		
/*		$sql="SELECT * FROM `departments` where code='".$arr1['until']."' and status='y' ";
		$query=mysql_query($sql)or die (mysql_error());
		$arr=mysql_fetch_array($query);*/
		
$i++;
if($i%2==0)
{
$bg = "#CCCCCC";
}
else
{
$bg = "#FFFFFF";
}
	?>
    <tr bgcolor="<?=$bg;?>">
      <td align="center"><?=$i?></td>
      
      <td><?=substr($arr1['thidate'],0,10)?></td>
      <td><?=$arr1['name']?></td>
      <td><?=$arr1['ptname']?></td>
      <td><?=$arr1['staff']?></td>
      <td align="center"><a  href="ic_accident_view.php?id=<?=$arr1['row_id'];?>" target="_blank">�٢�����</a></td>
  <!--     <td align="center"><a  href="ncf2_edit.php?nonconf_id=<?//=$arr1['nonconf_id'];?>" target="_blank">���</a></td>-->

<!--       <td align="center"><a href="javascript:if(confirm('�׹�ѹ���ź NCR : <?//=$arr1['nonconf_id']?>')==true){MM_openBrWindow('ncf_del.php?id=<?//=$arr1['nonconf_id']?>','','width=400,height=500')}">ź</a></td>-->
      
     </tr>
    <?
	}  
	
	
	?>
    </table>
<?

/*}else{
	echo "<font class=\"forntsarabun\">����բ����Ţͧ $_POST[doctor]  $day  $dateshow</font>";
}*/
?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>