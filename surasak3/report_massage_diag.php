<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
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
<div id="no_print">
<form id="form1" name="form1" method="post" action="">
  <table  border="0" align="center"  >
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC">ʶԵԧҹ�ǴἹ��</td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td>�ѹ/��͹/��</td>
      <td><select name='d_start' class="font1">
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
				?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="��ŧ" /></td>
    </tr>
  </table>
</form>
<br />
</div>

<?php
 if(isset($_POST["button"])){
	include("connect.inc");

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

if($_POST['d_start']==''){
	
$today=$_POST['y_start'].'-'.$_POST['m_start'];
$sh="��Ш���͹";
$shtodate=($_POST['y_start']-543).'-'.$_POST['m_start'];
$dateshow=$printmonth." ".$_POST['y_start'];

}else{
	
$today=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
$sh="��Ш��ѹ��� ";	
$dateshow=$_POST['d_start']." ".$printmonth." ".$_POST['y_start'];
	
$shtodate=($_POST['y_start']-543).'-'.$_POST['m_start'].'-'.$_POST['d_start'];
}
	

	$sql = "SELECT count(*)as count FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0 ";
	$result = Mysql_Query($sql);
	list($sum) = Mysql_fetch_row($result);


print "<div align=\"center\" class=\"forntsarabun\">ʶԵԧҹᾷ��Ἱ��  $sh  $dateshow</div><BR>";
?>

<TABLE class="forntsarabun">
<TR>
	<TD colspan="2" bgcolor="#CCCCCC">�ӹǹ�����·���ҵ�Ǩ  <?php echo $dateshow;?> ������ <?php echo $sum;?> ��</TD>
</TR>
<TR>
	<TD colspan="2" bgcolor="#CCCCCC">�ӹǹ�ä���������ҵ�Ǩ (����)</TD>
</TR>
<?php 
$sql = "SELECT b.diag,count(b.hn) as cc FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0  Group by b.diag Order by cc DESC";
	
$result = Mysql_Query($sql);
$sum=0;
while(list($diag,$count) = Mysql_fetch_row($result)){
?>
<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $diag;?></TD>
	<TD><?php echo $count; $sum = $sum+$count;?></TD>
</TR>
<?php }?>

<TR>
	<TD bgcolor="#CCCCCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���</TD>
	<TD bgcolor="#CCCCCC"><?php echo $sum;?></TD>
</TR>

</TABLE> 

<?php
}
?>
 <br /> <br />
 <TABLE class="forntsarabun">
<TR>
	<TD colspan="2" bgcolor="#CCCCCC">�Է�ԡ���ѡ��</TD>
</TR>
<?php 
$sql2 = "SELECT b.ptright,count(b.hn) as cc FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0 Group by substring(b.ptright,1,3) Order by cc DESC";
	
$result2 = Mysql_Query($sql2);
$sum2=0;
while(list($ptright,$count2) = Mysql_fetch_row($result2)){
?>
<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ptright;?></TD>
	<TD><?php echo $count2;?></TD>
</TR>
<?php 
$sum2+=$count2;
}

?>

<TR>
	<TD bgcolor="#CCCCCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���</TD>
	<TD bgcolor="#CCCCCC"><?php echo $sum2;?></TD>
</TR>

</TABLE> 
<br />
<br />
<TABLE class="forntsarabun">
<TR>
	<TD colspan="2" align="center" bgcolor="#CCCCCC">��</TD>
</TR>
<?php 
$sql2 = "SELECT  b.hn FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0";
	
$result2 = Mysql_Query($sql2);
$sum2=0;
while(list($hn) = Mysql_fetch_row($result2)){
	
	$sqlsex = "SELECT sex  FROM `opcard` WHERE  hn='".$hn."' ";
	 $querysex = mysql_query($sqlsex) or die("Query failed ".$sqlsex."");
	 $arrsex=mysql_fetch_array($querysex);
	 
	 if($arrsex['sex']=='�' || $arrsex['sex']=='1'){
		$sex= "���"; 
		$nsex++;
	 }else if($arrsex['sex']=='�' || $arrsex['sex']=='2'){
		$sex= "˭ԧ"; 
		$nsex2++;
	 }
	 
}
?>
<TR>
	<TD>�Ȫ��</TD>
	<TD><?php echo $nsex;?></TD>
</TR>
<TR>
  <TD>��˭ԧ</TD>
  <TD><?php echo $nsex2;?></TD>
</TR>
<?php 
$sum3=$nsex+$nsex2;


?>

<TR>
	<TD bgcolor="#CCCCCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���</TD>
	<TD bgcolor="#CCCCCC"><?php echo $sum3;?></TD>
</TR>

</TABLE>
<!--<TABLE class="forntsarabun">
<TR>
	<TD colspan="2" align="center" bgcolor="#CCCCCC">���Ǵ</TD>
</TR>-->
<!--<?//php 
/*$sql2 = "SELECT  b.hn FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008')) AND b.date LIKE '".$today."%'  and  a.status='Y' and a.price >0";
	
$result2 = Mysql_Query($sql2);
$sum2=0;
while(list($hn) = Mysql_fetch_row($result2)){
	
	$sqlsex = "SELECT sex  FROM `opcard` WHERE  hn='".$hn."' ";
	 $querysex = mysql_query($sqlsex) or die("Query failed ".$sqlsex."");
	 $arrsex=mysql_fetch_array($querysex);
	 
	 if($arrsex['sex']=='�'){
		$sex= "���"; 
		
		$nsex++;
	 }else if($arrsex['sex']=='�'){
		$sex= "˭ԧ"; 
		$nsex2++;
	 }
	 
}*/
?>-->
<!--<TR>
	<TD>�Ȫ��</TD>
	<TD><?//php //echo $nsex;?></TD>
</TR>
<TR>
  <TD>��˭ԧ</TD>
  <TD><?//php //echo $nsex2;?></TD>
</TR>-->
<!--<?php//$sum3=$nsex+$nsex2;


?>-->

<!--<TR>
	<TD bgcolor="#CCCCCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���</TD>
	<TD bgcolor="#CCCCCC"><?//php echo $sum3;?></TD>
</TR>

</TABLE>-->