<style type="text/css">
<!--
.forntsarabun {
	font-family:"TH Niramit AS";
	font-size: 16px;
}
.font{
	font-family:"TH Niramit AS";
	font-size:16;
	
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
<!--<h1 class="forntsarabun">ʶԵ�Ἱ��ѧ�ա���</h1>-->
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right">������ѹ���</td>
    <td ><? 
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
				?></td>

    </tr>
  <tr>
    <td colspan="4" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>&nbsp; 
      </td>
  </tr>
</table>
</form>
</div>
<?
if($_POST['submit']=="����"){

$month['01'] = "���Ҥ�";
$month['02'] = "����Ҿѹ��";
$month['03'] = "�չҤ�";
$month['04'] = "����¹";
$month['05'] = "����Ҥ�";
$month['06'] = "�Զع�¹";
$month['07'] = "�á�Ҥ�";
$month['08'] = "�ԧ�Ҥ�";
$month['09'] = "�ѹ��¹";
$month['10'] = "���Ҥ�";
$month['11'] = "��Ȩԡ�¹";
$month['12'] = "�ѹ�Ҥ�";	
	
	
$start_date=$_POST['y_start'];

include("connect.inc");
	


//////////////////////////////////////
?>
<h1 class="font">Credit null</h1>
<table border="1">
  <tr>
    <td align="center">#</td>
    <td align="center">�ѹ���</td>
    <td align="center">hn</td>
    <td align="center">depart</td>
    <td align="center">�Ҥ�</td>
    <td align="center">�Է��</td>
  </tr>
<?
	
$sql="Select * from opacc Where date like '$start_date%' and credit ='' ";
$query= mysql_query($sql) or die (mysql_error());
$i=1;
while($arr=mysql_fetch_array($query)){
?>


  <tr>
    <td><?=$i++;?></td>
    <td><?=$arr['date'];?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['depart'];?></td>
    <td><?=$arr['price'];?></td>
    <td><?=$arr['ptright'];?></td>
  </tr>
  
  <? } ?>
</table>



<?

}// ����
?>
