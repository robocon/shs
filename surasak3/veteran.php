��ª��ͷ��ü�ҹ�֡ 
<form name="f1" action="" method="post">
<?
$Y=date("Y")+543;
$date=date("Y")+543+1;
$dates=range(2553,$date);
echo "<select name='y_start' class='forntsarabun'>";
foreach($dates as $i){
?>
	<option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
<?
}
echo "<select>";
echo "<input name='okbtn' type='submit' class='forntsarabun' value='  ��ŧ  '/>";
?>
</form>
<?
if(isset($_POST['okbtn'])){
	$count1=0;
	$count2=0;
	$count3=0;
	$count4=0;
	include("connect.inc");
	$sql1 ="select * from opcard where note like '%��ҹ�֡%'";
	$rows1 = mysql_query($sql1);
	while($result = mysql_fetch_array($rows1)){
		$sql2 ="select * from opday where hn = '".$result['hn']."' and thidate like '".$_POST['y_start']."%' ";
		$rows2 = mysql_query($sql2);
		while($result2 = mysql_fetch_array($rows2)){
			$count1++;
		}
		
		$sql3 ="select distinct(hn) from opday where hn = '".$result['hn']."' and thidate like '".$_POST['y_start']."%' ";
		$rows3 = mysql_query($sql3);
		while($result3 = mysql_fetch_array($rows3)){
			$count2++;
		}
		
		$sql4 ="select hn from ipcard where hn = '".$result['hn']."' and date like '".$_POST['y_start']."%' ";
		$rows4 = mysql_query($sql4);
		while($result4 = mysql_fetch_array($rows4)){
			$count3++;
		}
		
		$sql5 ="select distinct(hn) from ipcard where hn = '".$result['hn']."' and date like '".$_POST['y_start']."%' ";
		$rows5 = mysql_query($sql5);
		while($result5 = mysql_fetch_array($rows5)){
			$count4++;
		}
	}
	echo "<b>�� ".$_POST['y_start']."</b><br>";
	echo "<b>�����¹͡</b><br>";
	echo "�ӹǹ������Ѻ��ԡ�� $count1 ����<br>";
	echo "�ӹǹ������Ѻ��ԡ�� $count2 ��<br><br>";
	
	echo "<b>�������</b><br>";
	echo "�ӹǹ������Ѻ��ԡ�� $count3 ����<br>";
	echo "�ӹǹ������Ѻ��ԡ�� $count4 ��<br>";
}
?>