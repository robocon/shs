<?
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.txtsarabun{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<p align="center" style="margin-top: 20px;"><strong>���͡�ѹ������ʹ٢����Ť���ѡ�Ҿ�Һ�ż����¹͡���Դ C (�ԡ���µç)</strong></p>
<div align="center">
<form method="POST" action="show_datacscd_c.php">
<input type="hidden" name="act" value="show" />
	<strong>�ѹ��� : </strong>
    <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txtsarabun">
    <strong>���͡��͹ : </strong><select size="1" name="month1" class="txtsarabun">
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
				echo "<select name='year1'  class='txtsarabun'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       &nbsp;
       <strong>HN : </strong><input name="hn" type="text" class="txtsarabun">&nbsp;&nbsp;
       <input type="submit" value="�٢�����" name="B1"  class="txtsarabun" />
       &nbsp;&nbsp;
    <input type="button" value="�������ѡ" name="B2"  class="txtsarabun" onClick="window.location='../nindex.htm' " />
</form>
</div>
<br>
<?
if($_POST["act"]=="show"){
$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"];
$hn=$_POST["hn"];
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];

?>
<div align="center"><strong>�����Ť���ѡ�Ҿ�Һ�ż����¹͡���Դ C (�ԡ���µç)</strong></div>
<div align="center"><strong>�ѹ��� 
<?=$showdate1;?> HN : <?=$hn;?></strong></div>
<table width="98%" border="1" align="center" cellpadding="6" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center"><strong>�ӴѺ</strong></td>
    <td width="11%" align="center"><strong>�ѹ����Դ��������</strong></td>
    <td width="7%" align="center"><strong>HN</strong></td>
    <td width="11%" align="center"><strong>����-���ʡ��</strong></td>
    <td width="7%" align="center"><strong>��Ǵ����</strong></td>
    <td width="17%" align="center"><strong>��¡��</strong></td>
    <td width="5%" align="center"><strong>VN</strong></td>
    <td width="8%" align="center"><strong>BillNo</strong></td>
    <td width="10%" align="center"><strong>ApproveCode</strong></td>
    <td width="10%" align="center"><strong>�ӹǹ�Թ</strong></td>
    <td width="10%" align="center"><strong>�ӹǹ�Թ�����ԡ</strong></td>
  </tr>
<?
$sql="select * from opacc where (hn='$hn' AND date like '$chkdate1%') AND typecscd ='C'";
//echo $sql;
$query=mysql_query($sql) or die("SQL ERROR");
$i=0;
$sumprice=0;
$sumpaidcscd=0;
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["depart"]=="PHAR"){
	$depart="��/�Ǫ�ѳ��";
}else if($rows["depart"]=="PATHO"){
	$depart="LAB";
}else if($rows["depart"]=="XRAY"){
	$depart="XRAY";	
}else if($rows["depart"]=="EMER"){
	$depart="EMER";		
}else{
	$depart="����";
}
$sumprice=$sumprice+$rows["price"];
$sumpaidcscd=$sumpaidcscd+$rows["paidcscd"];

	$sql3="select * from opcard where hn='".$rows["hn"]."'";
	$query3=mysql_query($sql3);
	$result3=mysql_fetch_array($query3);	
	$ptname=$result3["name"]." ".$result3["surname"];
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["date"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$ptname;?></td>
    <td><?=$depart;?></td>
    <td><?=$rows["detail"];?></td>
	<td><?=$rows["vn"];?></td>    
    <td><?=$rows["billno"];?></td>
    <td align="center"><?=$rows["credit_detail"];?></td>
    <td align="right"><?=$rows["price"];?></td>
    <td align="right"><?=$rows["paidcscd"];?></td>
  </tr>
<?
}
?>  
	<tr>
    <td colspan="9" align="right"><strong>���������</strong></td>
    <td align="right"><?=number_format($sumprice,2);?></td>
    <td align="right"><?=number_format($sumpaidcscd,2);?></td>    
    </tr>
</table>
<?
}
?>