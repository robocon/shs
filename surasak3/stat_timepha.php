<?php
include("connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�������ػ���һ�Ш��ѹ������</title>
<style type="text/css">
<!--
.font1 {	font-family:AngsanaUPC;
	font-size: 20px;
}
-->
</style>
</head>
<body>
<form name="timeline" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
	<span class="font1">�������ػ���һ�Ш��ѹ������ || <a href="stat_timephaarmy.php">�������ػ���һ�Ш��ѹ������Ф�ͺ����</a> || <a href="stat_timephaarmymount.php">��ػ���һ�Ш���͹������Ф�ͺ����</a><br />
	<br />
	<?php
	$d=date("d");
	$m=date("m");
	$year=date("Y");
	?>
	�ѹ��� 
	<select name="d1">
	<?php
		for($a=1;$a<32;$a++){
			if($a<10) $ss = "0";
			else $ss='';
			?>
			<option value="<?=$ss?><?=$a?>" <?php if($d==$a) echo "selected='selected'"?>>
			<?=$a?>
			</option>
		<?php } ?>
	</select>
	��͹
	<select name="m1">
		<?php
		$month = array('0','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
		for($a=1;$a<13;$a++){
			if($a<10) $ss = "0";
			else $ss='';
			?>
			<option value="<?=$ss?><?=$a?>" <?php if($m==$a) echo "selected='selected'"?>>
			<?=$month[$a]?>
			</option>
			<?php
		}
		?>
	</select>
	�.�.
	<select name="yr1">
		<?php
		$year = date("Y")+543;
		for($a=($year-5);$a<($year+5);$a++){
			?>
			<option value="<?=$ss?><?=$a?>" <?php if($year==$a) echo "selected='selected'"?>>
			<?=$a?>
			</option>
			<?php
		}
		?>
	</select>
	</span>
	<div>
		<?php 
		$user_idguard = isset($_POST['idguard']) ? $_POST['idguard'] : false ; 
		$guard_lists = array('mx01' => '����/��ͺ����', 'mx00' => '�����͹');
		?>
		<span>�����:&nbsp;</span>
		<select name="idguard" id="idguard">
			<option value="">������</option>
			<?php foreach ($guard_lists as $key => $item) { ?>
			<?php $select = ( $key == $user_idguard ) ? 'selected="selected"' : '' ;?>
			<option value="<?php echo $key;?>" <?php echo $select; ?>><?php echo $item;?></option>
			<?php } ?>
		</select>
	</div>
	<a href="../nindex.htm" class="forntsarabun"><< �������ѡ >></a>
	<br />
	<br />
	<input name="okbtn" type="submit" value="  ��ŧ  " class="font1"/>
</form>

<?php
if(isset($_POST['okbtn'])){
	
	$group_txt = '';
	if( !empty($user_idguard) ){
		$group_txt = ( $user_idguard == 'mx01' ) ? '����/��ͺ����' : '�����͹' ;
	}
	
?>
	<center>�������ػ������ͧ�����һ�Ш��ѹ��� <?=$d1?>-<?=$m1?>-<?=$yr1?> <?php echo $group_txt;?></center> 
	<table width="100%" class="font1" border="1" cellpadding="0" cellspacing="0">
		<tr>
			<td width="2%" rowspan="2" align="center">VN</td>
			<td width="5%" rowspan="2" align="center">HN</td>
			<td width="15%" rowspan="2" align="center">����-ʡ��</td>
			<td colspan="5" align="center">����</td>
			<td width="6%" rowspan="2" align="center">�������(3-1)</td>
		</tr>
		<tr>
			<td width="6%" height="22" align="center">ᾷ���Ǩ����</td>
			<td width="6%" align="center">�Ѻ������(1)</td>
			<td width="6%" align="center">�Ѵ��(2)</td>
			<td width="6%" align="center">���¡�Ѻ(3)</td>
			<td width="6%" align="center">������(4)</td>
		</tr>
		<?php
		
		$ymd = $_POST['yr1']."-".$_POST['m1']."-".$_POST['d1'];
		
		if( !empty($user_idguard) ){
			$pt = strtoupper($user_idguard);
			
			$query = "CREATE TEMPORARY TABLE `opday1` 
			SELECT a.* 
			FROM `opday` AS a LEFT JOIN `opcard` AS b ON b.`hn`=a.`hn`
			WHERE a.`thidate` LIKE '$ymd%'
			AND b.`idguard` LIKE '$pt%'";
			
		}else{
			$query = "CREATE TEMPORARY TABLE `opday1` 
			SELECT * FROM `opday` 
			WHERE `thidate` LIKE '$ymd%'";
		}
		
		$resultopday = mysql_query($query);
		
		$sql = "select * from opday1 order by thidate asc ";
		$rows = mysql_query($sql);
		$n=0;
		$hh=0;
		$ii=0;
		$ss=0;
		$countmx=0;
		while($result = mysql_fetch_array($rows)){
			$sql2 = "select thidate,dc_diag from opd  where thidate like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%' and hn='".$result['hn']."' ";
			
			$rows2 = mysql_query($sql2);
			$result2 = mysql_fetch_array($rows2);
			
			$sql3 = "select date,pharin,stkcutdate,pharout,pharout1 from dphardep where  dr_cancle is null and date like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%' and hn='".$result['hn']."' ";
			
			$rows3 = mysql_query($sql3);
			$result3 = mysql_fetch_array($rows3);
			
			
			$sql4 = "select  hn,idguard  from opcard where   hn='".$result['hn']."' and substring(idguard,1,4)='MX01' ";
			$query4 = mysql_query($sql4);
			$row4 = mysql_num_rows($query4);
			if($row4 > 0){
				$countmx++;
			}
			
			if($result3['pharin'] && $result3['pharout'] !=''){
				$starttime = $result3['pharin'];
				$lasttime = $result3['pharout'];
				if($starttime && $lasttime!=""){
					$n++;
					$stringtime3=strtotime($lasttime) - strtotime($starttime);
					$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));	
				}else{
					$time3 = "-";
				}
				
				$cuttime=explode(':',$time3);
				
				if($cuttime[0]>00 || $cuttime[1]>30){
				
					$sumtime1++;
					if($sumtime1==0){
						$sumtime1="0";	
					}
				}
				if($cuttime[0]==00 && $cuttime[1]<30){
				
					$sumtime2++;
					if($sumtime2==0){
						$sumtime2="0";	
					}
				}
				
				$count1++;
				if($count1==0){
					$count1="0";	
				}
				
				$ss=$ss+$cuttime[2];
				$ii=$ii+$cuttime[1];
				$hh=$hh+$cuttime[0];
				//echo "$ii=$ii+$cuttime[1] <br>";
			
			}else{
				$time3="-";
			}
			?>
			<tr>
				<td align="center"><?=$result['vn']?></td>
				<td><?=$result['hn']?></td>
				<td><?=$result['ptname']?></td>
				<td align="center"><?php if(empty($result3['date'])){ echo "-";}else{ echo substr($result3['date'],11);}?></td>
				<td align="center"><?php if(empty($result3['pharin'])){ echo "-";}else{ echo $result3['pharin'];}?></td>
				<td align="center"><?php if(empty($result3['stkcutdate'])){ echo "-";}else{ echo $result3['stkcutdate'];}?></td>
				<td align="center"><?php if(empty($result3['pharout'])){ echo "-";}else{ echo $result3['pharout'];}?></td>  
				<td align="center"><?php if(empty($result3['pharout1'])){ echo "-";}else{ echo $result3['pharout1'];}?></td>  
				<td align="center"><?php if(empty($time3)){ echo "-";}else{ echo $time3;}?></td>
			</tr>
			<?php
		}
		//echo "$hh, $ii, $ss <br>";
		$sumss=$ss/60;
		$sumhh=$hh*60;
		$sumtime=$sumhh+$ii+$sumss;
		$avgtime=$sumtime/$count1;
		?>
	</table>
	<BR />
	<?php
	/*echo "�¡������ �����·���� MX01 ���� /��ͺ���� ".$countmx." ��";
	echo "<br>";*/
	echo "�Ѻ������ - ���¡�Ѻ ".$count1." ��";
	echo "<br>";
	if($sumtime1){
		echo "�ӹǹ�����ҷ���������Թ 30 �ҷ�  �ӹǹ ".$sumtime1." ��";
	}else{
		echo "�ӹǹ�����ҷ���������Թ 30 �ҷ�  �ӹǹ 0 ��";
	}
	echo "<br>";
	
	echo "�ӹǹ�����ҷ������������Թ 30 �ҷ� �ӹǹ ".$sumtime2." ��";
	echo "<br>";
	echo "����������ҡ������ԡ��/�� ".number_format($avgtime,2)." �ҷ�";
}
?>
</body>
</html>