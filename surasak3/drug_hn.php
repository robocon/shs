<style type="text/css">
<!--
.font1 {	font-family: AngsanaUPC;
	font-size: 20px;
}
.font2 {	font-size: 24px;
}
-->
</style>
<form action="" method="post" name="form1">
<A HREF="../nindex.htm"><<�����</A>
<table width="85%" border="0" cellpadding="0" cellspacing="0" bordercolor="#336633" class="font1">
  <tr>
    <td align="center" class="font1"><strong class="font2">���ҡ�����ҵ��������</strong></td>
  </tr>
  <tr>
    <td><strong>������</strong> :
      <input name="dg" type="text" id="dg" size="15">
      <br />
      �ѹ���
      <?
			$date=31;
			$dates=range(1,$date);
			$y=1;
			echo "<select name='day1'>";
			foreach($dates as $i){
	?>
      <option value='<? if($i<10) echo "0";?><?=$i?>' <? if($y==$i){ echo "selected"; }?>>
      <?=$i;?>
      </option>
      <?
			}
			echo "<select>";
	?>
��͹
<select name="mon1">
  <option value="01">���Ҥ�</option>
  <option value="02">����Ҿѹ��</option>
  <option value="03">�չҤ�</option>
  <option value="04">����¹</option>
  <option value="05">����Ҥ�</option>
  <option value="06">�Զع�¹</option>
  <option value="07" selected="selected">�á�Ҥ�</option>
  <option value="08">�ԧ�Ҥ�</option>
  <option value="09">�ѹ��¹</option>
  <option value="10">���Ҥ�</option>
  <option value="11">��Ȩԡ�¹</option>
  <option value="12">�ѹ�Ҥ�</option>
</select>
�.�.
<?
      $y=2553;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='yr1'>";
				foreach($dates as $i){

				?>
<option value='<?=$i?>' <? if($y==$i){ echo "selected"; }?>>
<?=$i;?>
</option>
<?
				}
				echo "<select>";
	  ?>
-
      �ѹ���
<?
			$date=31;
			$y=12;
			$dates=range(1,$date);
			echo "<select name='day2'>";
			foreach($dates as $i){
	?>
<option value='<? if($i<10) echo "0";?><?=$i?>' <? if($y==$i){ echo "selected"; }?>>
<?=$i;?>
</option>
<?
			}
			echo "<select>";
	?>
��͹
<select name="mon2">
  <option value="01">���Ҥ�</option>
  <option value="02">����Ҿѹ��</option>
  <option value="03">�չҤ�</option>
  <option value="04">����¹</option>
  <option value="05">����Ҥ�</option>
  <option value="06">�Զع�¹</option>
  <option value="07">�á�Ҥ�</option>
  <option value="08">�ԧ�Ҥ�</option>
  <option value="09" selected="selected">�ѹ��¹</option>
  <option value="10">���Ҥ�</option>
  <option value="11">��Ȩԡ�¹</option>
  <option value="12">�ѹ�Ҥ�</option>
</select>
�.�.
<?
$y=2555;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='yr2'>";
				foreach($dates as $i){

				?>
<option value='<?=$i?>' <? if($y==$i){ echo "selected"; }?>>
<?=$i;?>
</option>
<?
				}
				echo "<select>";
?></td>
  </tr>
  <tr>
    <td align="center"><input type="submit" name="ok" id="ok" value=" ���� "></td>
  </tr>
</table>
</form>
<?
include("connect.inc");
if(isset($_POST['ok'])){
	$drughn= array();
	$sql ="select hn,date,idno,amount from drugrx where hn!='' and (an='' or an is null) and drugcode = '".$_POST['dg']."' and date between '".$_POST['yr1']."-".$_POST['mon1']."-".$_POST['day1']." 00:00:00' and '".$_POST['yr2']."-".$_POST['mon2']."-".$_POST['day2']." 23:59:59' ";
	$row = mysql_query($sql);
	while($result = mysql_fetch_array($row)){
		$sql2 ="select * from phardep where row_id = '".$result['idno']."' ";
		$row2 = mysql_query($sql2);
		$result2 = mysql_fetch_array($row2);
		if(array_key_exists($result['hn'],$drughn)){
			$drughn[$result['hn']]+=$result['amount'];
			
		}else{
			$drughn[$result['hn']]=$result['amount'];
		}
	}
	?>
   <span class="font1"> ������ : <?=$_POST['dg']?><br />
�ѹ��� <?=$_POST['day1']."/".$_POST['mon1']."/".$_POST['yr1']." �֧�ѹ��� ".$_POST['day2']."/".$_POST['mon2']."/".$_POST['yr2']?></span><br />
	<table width="725" border="1" cellpadding="0" cellspacing="0" class="font1"><tr><td width="92" align="center">#</td><td width="92" align="center">HN</td><td width="223" align="center">���� - ʡ��</td>
	  <td width="322" align="center">�Է��</td>
	  <td width="78" align="center">�ӹǹ</td>
	  <td width="78" align="center">�Ҥ�</td>
	</tr>
	<?
	$sumall=0;
	$sumpri=0;
	$drugsql = "select salepri from druglst where drugcode='".$_POST['dg']."' ";
	$rowdrug = mysql_query($drugsql);
	list($salepri) = mysql_fetch_array($rowdrug);
		
	$sql ="select hn,idno from drugrx where hn!='' and (an='' or an is null) and drugcode = '".$_POST['dg']."' and date between '".$_POST['yr1']."-".$_POST['mon1']."-".$_POST['day1']." 00:00:00' and '".$_POST['yr2']."-".$_POST['mon2']."-".$_POST['day2']." 23:59:59' group by hn order by hn asc";
	$row = mysql_query($sql);
	while($result = mysql_fetch_array($row)){
		$k++;
		$sql2 ="select * from phardep where row_id = '".$result['idno']."' ";
		$row2 = mysql_query($sql2);
		$result2 = mysql_fetch_array($row2);
	?>
	<tr><td align="center"><?=$k;?></td><td><a href="drug_hn.php?shn=<?=$result['hn']?>&dg=<?=$_POST['dg']?>&d1=<?=$_POST['day1']?>&m1=<?=$_POST['mon1']?>&y1=<?=$_POST['yr1']?>&d2=<?=$_POST['day2']?>&m2=<?=$_POST['mon2']?>&y2=<?=$_POST['yr2']?>" target="_blank"><?=$result['hn']?></a></td><td><?=$result2['ptname']?></td><td><?=$result2['ptright']?></td><td align="center"><?=$drughn[$result['hn']]?></td>
	  <td align="right"><?=number_format($drughn[$result['hn']]*$salepri,2)?></td>
	</tr>
	<?
	$sumall += $drughn[$result['hn']];
	$sumpri +=($drughn[$result['hn']]*$salepri);
	}
	?>
    <tr>
	  <td colspan="4" align="center">���</td>
	  <td align="center"><?=number_format($sumall,2)?></td>
	  <td align="center"><?=number_format($sumpri,2)?></td>
	  </tr>
    </table>
<br />
	<?
}

if(isset($_GET['shn'])){
	?>
	<table width="624" border="1" cellpadding="0" cellspacing="0" class="font1"><tr><td width="43" align="center">#</td><td width="137" align="center">�ѹ���</td><td width="88" align="center">HN</td><td width="260" align="center">���� - ʡ��</td>
	  <td width="84" align="center">�ӹǹ</td>
	</tr>
	<?
	$sql ="select * from drugrx where hn='".$_GET['shn']."' and (an='' or an is null) and drugcode = '".$_GET['dg']."' and date between '".$_GET['y1']."-".$_GET['m1']."-".$_GET['d1']."' and '".$_GET['y2']."-".$_GET['m2']."-".$_GET['d2']."' order by hn asc";
	$row = mysql_query($sql);
	while($result = mysql_fetch_array($row)){
			$sql2 ="select * from phardep where row_id = '".$result['idno']."' ";
			$row2 = mysql_query($sql2);
			$result2 = mysql_fetch_array($row2);
			$p++;
		?>
		<tr><td width="43" align="center"><?=$p;?></td><td width="137"><?=$result['date']?></td><td width="88"><?=$result['hn']?></td><td width="260"><?=$result2['ptname']?></td>
	  <td width="84" align="center"><?=$result['amount']?></td></tr>
		<?
	}
	?>
	</table>
	<?
}
?>
