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
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">��§ҹ�������������է�����ҳ</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">����� - �ѹ/��͹/��</span></td>
    <td >
    		<input name="d_start1" type="text" class="forntsarabun" id="d_start1"  value="<?=$_POST['d_start'];?>" size="10"/>
   
	<? $m=date('m'); ?>
      <select name="m_start1" class="forntsarabun" id="m_start1">
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
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start1' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right">�֧  - �ѹ/��͹/��</td>
    <td > 
      <input name="d_start2" type="text" class="forntsarabun"  value="<?=$_POST['d_start'];?>" size="10"/>
      <? $m=date('m'); ?>
      <select name="m_start2" class="forntsarabun" id="m_start2">
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
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start2' class='forntsarabun'>";
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
    <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>
      </td>
  </tr>
</table>
</form>
<HR>

<?php

if($_POST['submit']){

include("connect.inc"); 
include("function.php"); 

$y1=$_POST['y_start1']-543;
$y2=$_POST['y_start2']-543;
$date1=$y1.'-'.$_POST['m_start1'].'-'.$_POST['d_start1'];
$date2=$y2.'-'.$_POST['m_start2'].'-'.$_POST['d_start2'];


print "<div><font class='forntsarabun' >��§ҹ���������� �����  ".displaydate($date1)."  �֧ ".displaydate($date2)."</font></div><br>";

$tsql1="CREATE TEMPORARY TABLE   db1  SELECT * FROM  `opcard` 
WHERE  `regisdate` BETWEEN  '$date1' AND '$date2' ";
$tquery1 = mysql_query($tsql1);

echo $tsql1;
/*$strsub="SELECT DISTINCT (goup)as dg1 FROM db1  order by goup asc ";
$resultsub=mysql_query($strsub);
while($dbarr1=mysql_fetch_array ($resultsub)){
	
	$sub=substr($dbarr1['dg1'],0,3);
	
	//echo $sub."<br>";*/

$strsql="SELECT goup, COUNT( * ) AS Cdetail
FROM db1
GROUP BY substr(goup,1,3)";
$result=mysql_query($strsql);
$rows=mysql_num_rows($result);

?>
<table border="1" cellspacing="0" cellpadding="0" class="forntsarabun" style="border-collapse:collapse" bordercolor="#000000">
    <tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td>�ӴѺ</td>
    <td align="center">�������ؤ��</td>
    <td>�ӹǹ</td>
  </tr>
  <?

while($dbarr=mysql_fetch_array($result)) {
$n++;

$goup=$dbarr['goup'];

$subgoup=substr($goup,0,3);
$Cdetail=$dbarr['Cdetail'];
  ?>
  <tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td align="center"><?=$n;?></td>
    <td><a href='detail_register.php?do=view&date1=<?=$date1;?>&date2=<?=$date2;?>&goup=<?=$subgoup;?>'><?=$goup;?></a></td>
    <td align="right"><?=$dbarr['Cdetail'];?></td>
  </tr>
  <? 
  $sum+=$dbarr['Cdetail'];
  } ?>
  <tr>
    <td colspan="2" align="center" bgcolor="#99FFCC">���</td>
    <td align="center" bgcolor="#99FFCC"><?=$sum;?></td>
  </tr>
<?
/*}else{ 
echo "<tr><td colspan='3' align='center'>��辺��¡��</td></tr>";
}*/

?>
</table>
<?
}
?>