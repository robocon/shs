<style type="text/css">
<!--
.text {
	font-family: AngsanaUPC;
	font-size: 16px;
}
-->
</style>

<?php
include("connect.inc");
//print "�ѧ�������¹�����";
//2030-06-09
if(isset($_POST['search'])){
	echo "<span class='text'><strong style='font-size:22px'>��¡���ҷ�������� =< 3 ��͹</strong><br>";
	echo "������ѹ��� ".$_POST['day']."-".$_POST['mon']."-".$_POST['yr'];
//$datenow = date("Y-m-d");
$datenow = ($_POST['yr']-543)."-".$_POST['mon']."-".$_POST['day'];
//echo $datenow;
$info1 = cal_days_in_month( CAL_GREGORIAN , $_POST['mon']+1 , ($_POST['yr']-543) ) ;
$info2 = cal_days_in_month( CAL_GREGORIAN , $_POST['mon']+2 , ($_POST['yr']-543) ) ;
$info3 = cal_days_in_month( CAL_GREGORIAN , $_POST['mon']+3 , ($_POST['yr']-543) ) ;
$info =  $info1+$info2+$info3;
$tomorrow = mktime(date("H"),date("i"),date("s"),$_POST['mon'],$_POST['day']+$info,($_POST['yr']-543)); 
$date3month = date("Y-m-d",$tomorrow);
//������ ������ ��͵ �ѹ������� �ӹǹ㹤�ѧ�˭�
?>
<br />
<table width="80%" border="1" cellpadding="0" cellspacing="0" class="text">
	<tr><td align="center">#</td>
    <td align="center">����</td>
    <td align="center">������</td>
    <td align="center">Lot.</td>
    <td align="center">�ѹ�������</td>
    <td align="center">�ӹǹ㹤�ѧ�˭�</td>
    </tr>
<?
$i=0;
$sqlexp = "select * from combill where amount >0 order by expdate asc";
$rowexp = mysql_query($sqlexp);
while($resultexp = mysql_fetch_array($rowexp)){
	if($resultexp['expdate']>=$datenow){
		if($resultexp['expdate']<=$date3month){
			$i++;
			$sqldglst = "select * from druglst where drugcode ='".$resultexp['drugcode']."' ";
			$rowdglst = mysql_query($sqldglst);
			$resultdglst = mysql_fetch_array($rowdglst);
			?>
			<tr><td align="center"><?=$i?></td>
            <td><?=$resultexp['drugcode']?></td>
            <td><?=$resultexp['tradname']?></td>
            <td><?=$resultexp['lotno']?></td>
            <td><?=$resultexp['expdate']?></td>
            <td><?=$resultdglst['mainstk']?></td>
            </tr>
            <?
		}
	}
}
?>
</table>
<?
}else{
?>
<a href ="../nindex.htm" >&lt;&lt; �����</a><br>
<span class="text"><strong style="font-size:22px">��¡���ҷ�������� =< 3 ��͹</strong>
<br />
<form action="<? $_SERVER['PHP_SELF']?>" method="post" target="_blank">
<br />
�ѹ���&nbsp;<input type="text" name="day" maxlength="2" size="2" value="<?=date("d")?>" />
��͹&nbsp;
<? $m=date('m'); ?>
<select size="1" name="mon">
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
echo " ��&nbsp;<select name='yr'>";
foreach($dates as $i){
?>
<option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
<?
}
echo "<select>";
?>
<input type="submit" name="search" id="search" value="��ŧ" />
</span>
</form>
<?
}
?>