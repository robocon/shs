<?php
    include("connect.inc");
?>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.font1 {
	font-family: AngsanaUPC;
	font-size:14px;
}
.style1 {
font-family: AngsanaUPC;
font-size: 14px;
}
.style2 {
	font-family: AngsanaUPC;
	font-size: 14px;
}
body,td,th {
	font-family: Angsana New;
}
</style>
<div id="no_print" >
<span class="font1">
<font face="Angsana New" size="+2">
<strong>����¹���������Ǫ�ѳ��</strong>

</span>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
<p>������ : 
<input name="drugcode" type="text" size="15" />
��͹ 
 <select name="mon">
   <option value="01" selected="selected">���Ҥ�</option>
   <option value="02">����Ҿѹ��</option>
   <option value="03">�չҤ�</option>
   <option value="04">����¹</option>
   <option value="05">����Ҥ�</option>
   <option value="06">�Զع�¹</option>
   <option value="07">�á�Ҥ�</option>
   <option value="08">�ԧ�Ҥ�</option>
   <option value="09">�ѹ��¹</option>
   <option value="10">���Ҥ�</option>
   <option value="11">��Ȩԡ�¹</option>
   <option value="12">�ѹ�Ҥ�</option>
 </select>
��
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='forntsarabun'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?>&nbsp;&nbsp;
<input name="BOK" value="����§ҹ" type="submit" />
 </p>
</form>
</div>
<?
if(isset($_POST['BOK'])){
	$thmon = array('','�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.');
	$drugcode=$_POST["drugcode"];
	if($_POST['mon']=="01"){
		$mon ="�.�.";
	}else if($_POST['mon']=="02"){
		$mon ="�.�.";
	}else if($_POST['mon']=="03"){
		$mon ="��.�.";
	}else if($_POST['mon']=="04"){
		$mon ="��.�.";
	}else if($_POST['mon']=="05"){
		$mon ="�.�.";
	}else if($_POST['mon']=="06"){
		$mon ="��.�.";
	}else if($_POST['mon']=="07"){
		$mon ="�.�.";
	}else if($_POST['mon']=="08"){
		$mon ="�.�.";
	}else if($_POST['mon']=="09"){
		$mon ="�.�.";
	}else if($_POST['mon']=="10"){
		$mon ="�.�.";
	}else if($_POST['mon']=="11"){
		$mon ="�.�.";
	}else if($_POST['mon']=="12"){
		$mon ="�.�.";
	}

$mount=$_POST['mon'];
$year=$_POST['year'];
$datestart="$year-$mount-01";
$dateend="$year-$mount-31";
	
$sql1 = "SELECT * FROM drugrp5 WHERE drugcode ='".$drugcode."' order by row_id DESC limit 1";
$result1 = mysql_query($sql1) or die("Query failed2");
$num1=mysql_num_rows($result1);
while($row = mysql_fetch_array($result1)){
	$dcode=$row["drugcode"];
	$tname=$row["tradname"];					
								
	$page = 1;
	print  "<center><font face='Angsana New'><b>����¹���������Ǫ�ѳ��</b></center>";
	print  "�蹷��........$page.........<br>";
	print  "������...............................�������ͪ�Դ��ʴ�...($dcode)$tname....<br> ";
	print  "��Ҵ�����ѡɳ�...............................�ӹǹ���ҧ�٧.................................................<br> ";
	print  "˹��¹Ѻ......................�����............................�ӹǹ���ҧ���...................................<br> ";
?>	
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td colspan="2" align="center" class="font1" >�.� 
    <?=$year+543;?></td>
  <td rowspan="2" align="center" class="font1" >����͡���</td>
  <td rowspan="2" align="center" class="font1" >�Ѻ�ҡ-�������</td>
  <td rowspan="2" align="center" class="font1" >�Ţ����Ѻ<br>�ӴѺ��ѧ</td>
  <td colspan="3" align="center" class="font1" >�Ѻ</td>
  <td colspan="3" align="center" class="font1">����</td>
  <td colspan="3" align="center" class="font1" >�������</td>
  <td rowspan="2" align="center" class="font1" >�����˵�</td>
</tr>
  <tr>
    <td align="center" class="font1" >��͹</td>
    <td align="center" class="font1" >�ѹ���</td>
    <td align="center" class="font1" >�Ҥҵ��˹���</td>
    <td align="center" class="font1" >�ӹǹ</td>
    <td align="center" class="font1" >�ӹǹ�Թ</td>
    <td align="center" class="font1">�Ҥҵ��˹���</td>
    <td align="center" class="font1">�ӹǹ</td>
    <td align="center" class="font1" >�ӹǹ�Թ</td>
    <td align="center" class="font1" >�Ҥҵ��˹���</td>
    <td align="center" class="font1" >�ӹǹ</td>
    <td align="center" class="font1" >�ӹǹ�Թ</td>
  </tr>
 <!--���ʴ���¡���ʹ¡�Ңͧ��͹����	-->  
<?
$sql1="select rest_unitprice,rest_num,rest_price from drugrp5 where drugcode='$drugcode' and getdate < '$datestart' ORDER BY getdate DESC Limit 1";
$query1=mysql_query($sql1);
list($restunitprice,$restnum,$restprice)=mysql_fetch_array($query1);
 ?>
 		<tr align="right">
           <td align="center"><?=$mon;?></td>
           <td align="center">01</td>
           <td >&nbsp;</td>
           <td align="left">�ʹ¡��</td>
		   <td >&nbsp;</td>
		   <td  align="right">&nbsp;</td>
		   <td  align="right">&nbsp;</td>
		   <td  align="right">&nbsp;</td>
		   <td  align="right">&nbsp;</td>
           <td  align="right">&nbsp;</td>
		   <td  align="right">&nbsp;</td>
		   <td  align="right"><?=$restunitprice;?></td>
		   <td  align="right"><?=$restnum;?></td>
           <td  align="right"><?=number_format($restprice,2);?></td>
           <td  align="right">&nbsp;</td>
           </tr>
<!--�����ʴ���¡���ʹ¡�Ңͧ��͹����	-->            
<!--���ʴ���¡�ä�������͹��Ǣͧ�����͹����	--> 
<?     	   
$query = "SELECT *  FROM drugrp5  WHERE drugcode ='".$drugcode."' and (getdate between '$datestart' and '$dateend') ORDER BY getdate, row_id asc";
		//echo "��¡�����͹ : ".$query2;
		$result = mysql_query($query) or die("Query failed");
		$tbnum=mysql_num_rows($result);
		while($rows = mysql_fetch_array($result)) {	
			$month = substr($rows["getdate"],5,2);
			$day = substr($rows["getdate"],8,2);
			$month=$thmon[$month+0];				
?>				
        <tr align="right">
          <td align="center"><?=$month;?></td>
              <td align="center"><?=$day;?></td>
              <td align="center"><?=$rows["billno"];?></td>
              <td align="left"><?=$rows["detail"];?></td>
              <td align="center" ><?=$rows["stkno"];?></td>
              <td  align="right"><?=$rows["drug_unitprice"];?></td>
              <td  align="right"><? if($rows["drug_num"]!=0){ echo $rows["drug_num"];}?></td>
              <td  align="right"><?=number_format($rows["drug_price"],2);?></td>
              <td  align="right"><?=$rows["pay_unitprice"];?></td>
              <td  align="right"><? if($rows["pay_num"]!=0){ echo $rows["pay_num"];}?></td>
              <td  align="right"><?=number_format($rows["pay_price"],2);?></td>
              <td  align="right"><?=$rows["rest_unitprice"];?></td>
              <td  align="right"><?=$rows["rest_num"];?></td>
              <td  align="right"><?=number_format($rows["rest_price"],2);?></td>
              <td  align="right">&nbsp;</td>
      </tr>
            <?  
					}  //while 
			?>
<!--�����ʴ���¡�ä�������͹��Ǣͧ�����͹����	-->          
 </table>
 <?	
			echo "<br>";
			echo "<div style='page-break-after:always'></div>";
		}  //  while($row = mysql_fetch_array($result1)){ ǹ�Ң����ŵ�������� 
}// close if BOK		
?>				