

<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.font{
	font-family:Tahoma;
	font-size:14;
	
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
    <td width="64"  align="right">���͡��</td>
    <td width="387" >
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
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>&nbsp; 
      </td>
  </tr>
</table>
</form>
</div>
<?
if($_POST['submit']=="����"){
	
	$date1=($_POST['y_start']);
	
	include("connect.inc");
	
		
//////////////////////////////  �����Тͧ������ DM ����դ�� LDL < 100 mg/dl /////////////
/*$list1 = array();
$list2 = array();*/
?>
<h3  class="forntsarabun" align="center">��Ť�ҡ������ ��  <?=$date1;?></h3>
<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" class="font">
    <p>�Է�ԡ���ѡ��</p></td>
<td colspan="13" align="center" class="font">�� 
  <?=($date1)?>
</td>
</tr>
<tr>
  <td align="center" class="font">�.�.</td>
  <td align="center" class="font">�.�.</td>
  <td align="center" class="font">��.�.</td>
  <td align="center" class="font">��.�.</td>
  <td align="center" class="font">�.�.</td>
  <td align="center" class="font">��.�.</td>
  <td align="center" class="font">�.�.</td>
  <td align="center" class="font">�.�.</td>
  <td align="center" class="font">�.�.</td>
  <td align="center" class="font">�.�.</td>
  <td align="center" class="font">�.�.</td>
  <td align="center" class="font">�.�.</td>
  <td align="center" class="font">���</td>
</tr>

<? 
$sum=0;
$strptr="select  code,name  from  ptright";
$strresult = mysql_query($strptr);
while($obj= mysql_fetch_array($strresult)){
echo "<tr><td class='font'>$obj[code] $obj[name]</td>";
		for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;




		$selectsql = "SELECT SUM(price) as sumprice,ptright ,date   FROM   phardep  WHERE date  like '".$date1."-".$m."-%'  and  ptright like '".$obj['code']."%' ";
		$result = mysql_query($selectsql);
		while($arr = mysql_fetch_array($result)){
/*		array_push($list1,$arr['sumprice']);
		array_push($list2,$arr['ptright']);*/
		?>


<td align="right" class="font"><?=number_format($arr['sumprice'],2);?></td>


        
<?
$sum+=$arr['sumprice'];

}


}

$totol=number_format($sum,2);
echo "<td align='right' class='font'>$totol</td>";
echo "</tr>";
$sum=0;
}

?>


</table>
<? } ?>