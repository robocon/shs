<?php
    include("connect.inc");
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.style1 {
	font-size: 12px;
	color: #FF0000;
}
.txt {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
-->
</style>
<p align="center" style="margin-top: 20px;"><strong>��§ҹʶҹ�Ҿ������Ǫ�ѳ��</strong></p>
<div align="center">
<form method="POST" action="amed_stat.php">
<input name="act" type="hidden" value="show">
	<strong>�����ҧ�ѹ��� : </strong>
    <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>���͡��͹ : </strong><select size="1" name="month1" class="txt">
    <option selected>-------���͡-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>���Ҥ�</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>����Ҿѹ��</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>�չҤ�</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>����¹</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>����Ҥ�</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>�Զع�¹</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>�á�Ҥ�</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>�ԧ�Ҥ�</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>�ѹ��¹</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>���Ҥ�</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>��Ȩԡ�¹</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>�ѹ�Ҥ�</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year1'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       &nbsp; <strong>�֧�ѹ���</strong> 
    <input name="date2" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>���͡��͹ : </strong><select size="1" name="month2" class="txt">
    <option selected>-------���͡-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>���Ҥ�</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>����Ҿѹ��</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>�չҤ�</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>����¹</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>����Ҥ�</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>�Զع�¹</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>�á�Ҥ�</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>�ԧ�Ҥ�</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>�ѹ��¹</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>���Ҥ�</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>��Ȩԡ�¹</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>�ѹ�Ҥ�</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year2'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>       
       <input type="submit" value="�٢�����" name="B1"  class="txt" />
</form>
</div>
<?
if($_POST["act"]=="show"){
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];

$chkdate1=($_POST["year1"])."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=($_POST["year2"])."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

//echo $chkdate1;
//echo $chkdate2;
?>
<table width="100%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td rowspan="2" align="center">�ӴѺ</td>
    <td rowspan="2" align="center">�ӹǹ Item ��</td>
    <td align="center">STD-CODE</td>
    <td rowspan="2" align="center">������ þ.</td>
    <td rowspan="2" align="center">��¡�� (�¡���������)</td>
    <td width="90" height="174" rowspan="2" align="center">�������ѭ</td>
    <td width="86" rowspan="2" align="center">˹��¹Ѻ</td>
    <td width="142" rowspan="2" align="center">�(4) ��������</td>
    <td width="112" rowspan="2" align="center">(5) �Ҥҷع</td>
    <td width="78" rowspan="2" align="center">�ҤҢ��</td>
    <td colspan="2" align="center">ʶҹ�Ҿ � ��� ����..</td>
    <td align="center">�ʹ�������µ����͹</td>
    <td rowspan="2" align="center"> ���Թ (9)    <span class="style1">�ӹǹ������ (8) x �Ҥҷع (5)</span></td>
    <td rowspan="2" align="center">��Ť��������Ǫ�ѳ�줧��ѧ �Դ��..��Ңͧ�鹷ع��������/��͹ (7)/(9)</td>
  </tr>
  <tr>
    <td align="center">TPU code</td>
    <td align="center">�ӹǹ���ͧ����+��ѧ (6)</td>
    <td align="center">���Թ (7)<br>      
      <span class="style1">�ӹǹ (6) x �Ҥҷع (5)</span></td>
    <td align="center">�ӹǹ (8)</td>
  </tr>
<?
$sql="select * from druglst where grouptype='' and drug_active='y' and drugcode like '0%' order by drugcode";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>  
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>�Ѥ�չ</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>   
  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?> 
  
<?
//----------------------------- ����� ���� 1 -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and drugcode like '1%'  and (drugcode NOT LIKE '10%' AND drugcode NOT LIKE '11%' AND drugcode NOT LIKE '12%' AND drugcode NOT LIKE '13%' AND drugcode NOT LIKE '14%' AND drugcode NOT LIKE '15%' AND drugcode NOT LIKE '16%' AND drugcode NOT LIKE '17%' AND drugcode NOT LIKE '18%' AND drugcode NOT LIKE '19%') order by length(drugcode) asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>�����</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>  

<?
//----------------------------- �ҩմ ���� 2 -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and drugcode like '2%'  and (drugcode NOT LIKE '20%' AND drugcode NOT LIKE '21%' AND drugcode NOT LIKE '22%' AND drugcode NOT LIKE '23%' AND drugcode NOT LIKE '24%' AND drugcode NOT LIKE '25%' AND drugcode NOT LIKE '26%' AND drugcode NOT LIKE '27%' AND drugcode NOT LIKE '28%' AND drugcode NOT LIKE '29%') order by length(drugcode) asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>�ҩմ</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>  

<?
//----------------------------- ��ù��/������� ���� 3 -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and drugcode like '3%'  and (drugcode NOT LIKE '30%' AND drugcode NOT LIKE '31%' AND drugcode NOT LIKE '32%' AND drugcode NOT LIKE '33%' AND drugcode NOT LIKE '34%' AND drugcode NOT LIKE '35%' AND drugcode NOT LIKE '36%' AND drugcode NOT LIKE '37%' AND drugcode NOT LIKE '38%' AND drugcode NOT LIKE '39%') order by length(drugcode) asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>��ù��/�������</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>  

<?
//----------------------------- ����¹͡ ���� 4 -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and drugcode like '4%'  and (drugcode NOT LIKE '40%' AND drugcode NOT LIKE '41%' AND drugcode NOT LIKE '42%' AND drugcode NOT LIKE '43%' AND drugcode NOT LIKE '44%' AND drugcode NOT LIKE '45%' AND drugcode NOT LIKE '46%' AND drugcode NOT LIKE '47%' AND drugcode NOT LIKE '48%' AND drugcode NOT LIKE '49%') order by length(drugcode) asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>����¹͡</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>  

<?
//----------------------------- �ҹ�� ���� 5 -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and drugcode like '5%'  and (drugcode NOT LIKE '50%' AND drugcode NOT LIKE '51%' AND drugcode NOT LIKE '52%' AND drugcode NOT LIKE '53%' AND drugcode NOT LIKE '54%' AND drugcode NOT LIKE '55%' AND drugcode NOT LIKE '56%' AND drugcode NOT LIKE '57%' AND drugcode NOT LIKE '58%' AND drugcode NOT LIKE '59%') order by length(drugcode) asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>�ҹ��</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>  

<?
//----------------------------- �ҵ� ���� 6 -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and drugcode like '6%'  and (drugcode NOT LIKE '60%' AND drugcode NOT LIKE '61%' AND drugcode NOT LIKE '62%' AND drugcode NOT LIKE '63%' AND drugcode NOT LIKE '64%' AND drugcode NOT LIKE '65%' AND drugcode NOT LIKE '66%' AND drugcode NOT LIKE '67%' AND drugcode NOT LIKE '68%' AND drugcode NOT LIKE '69%') order by length(drugcode) asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>�ҵ�</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?> 

<?
//----------------------------- �� �� �� ��١ ���� 7 -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and drugcode like '7%'  and (drugcode NOT LIKE '70%' AND drugcode NOT LIKE '71%' AND drugcode NOT LIKE '72%' AND drugcode NOT LIKE '73%' AND drugcode NOT LIKE '74%' AND drugcode NOT LIKE '75%' AND drugcode NOT LIKE '76%' AND drugcode NOT LIKE '77%' AND drugcode NOT LIKE '78%' AND drugcode NOT LIKE '79%') order by length(drugcode) asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>�� �� �� ��١</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>   

<?
//----------------------------- ���˹�/���ǹ ���� 8 -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and drugcode like '8%'  and (drugcode NOT LIKE '80%' AND drugcode NOT LIKE '81%' AND drugcode NOT LIKE '82%' AND drugcode NOT LIKE '83%' AND drugcode NOT LIKE '84%' AND drugcode NOT LIKE '85%' AND drugcode NOT LIKE '86%' AND drugcode NOT LIKE '87%' AND drugcode NOT LIKE '88%' AND drugcode NOT LIKE '89%') order by length(drugcode) asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>���˹�/���ǹ</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>   

<?
//----------------------------- ������ ���� 9 -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and drugcode like '9%'  and (drugcode NOT LIKE '90%' AND drugcode NOT LIKE '91%' AND drugcode NOT LIKE '92%' AND drugcode NOT LIKE '93%' AND drugcode NOT LIKE '94%' AND drugcode NOT LIKE '95%' AND drugcode NOT LIKE '96%' AND drugcode NOT LIKE '97%' AND drugcode NOT LIKE '98%' AND drugcode NOT LIKE '99%') order by length(drugcode) asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>������</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>   

<?
//----------------------------- ��ع�� ���� 10 -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and drugcode like '10%' order by length(drugcode) asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>��ع��</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>

<?
//----------------------------- �ػ�ó�����Ǫ�ѳ�� -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and (part like 'DS%' || part like 'DP%')order by drugcode asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>�ػ�ó�����Ǫ�ѳ��</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>   

<?
//----------------------------- �������ҧ� -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and  drugcode like '11CAPD%' order by drugcode asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>�������ҧ�</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>  

<?
//----------------------------- �� ���. -----------------------------//
$sql="select * from druglst where grouptype='' and drug_active='y' and  tradname like '%���%' order by drugcode asc";
//echo $sql."<br>";
$query=mysql_query($sql);
$i=0;
?>    
  <tr>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99"><strong>�� ���.</strong></td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td align="center" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
  </tr>
<?  
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["ised"]=="e"){
	$ised="ED";
}else{
	$ised="NED";
}

$sumstock=$rows["totalstk"]*$rows["unitpri"];

$dsql="select sum(amount) from drugrx where drugcode ='".$rows["drugcode"]."' and (date >= '$chkdate1' and date <='$chkdate2')";
//echo $dsql."<br>";
$dquery=mysql_query($dsql);
list($amount)=mysql_fetch_array($dquery);
$sumprice=$amount*$rows["unitpri"];  //8*5
$avg=$sumstock/$sumprice;  //7/9
?>     
  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;</td>
    <td align="center"><?=$rows["tmt"];?></td>
    <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><?=$rows["unit"];?></td>
    <td align="center"><?=$ised;?></td>
    <td align="right"><?=$rows["unitpri"];?></td>
    <td align="right"><?=$rows["salepri"];?></td>
    <td align="right"><?=$rows["totalstk"];?></td>
    <td align="right"><?=number_format($sumstock,4);?></td>
    <td align="right"><?=$amount;?></td>
    <td align="right"><?=number_format($sumprice,4);?></td>
    <td align="right"><?=number_format($avg,4);?></td>
  </tr>
<?
}
?>  
</table>
<?
}
?>
