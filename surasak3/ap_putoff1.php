<?php
	session_start();
	include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font3 {
	font-family: "TH SarabunPSK";
	font-size:30px;
}
.font1 {
	font-family: "TH SarabunPSK";
	font-size:20px;
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
</head>
<script language=JavaScript type=text/javascript>
<!-- 
function CheckAll() {
	for (var i = 0; i < document.form12.elements.length; i++) {
		if(document.form12.elements[i].type == 'checkbox'){
			document.form12.elements[i].checked = !(document.form12.elements[i].checked);
		}
	}
}
//-->
</script>
<body>
<div id="no_print" >
<center><span class="font3"><strong>���������͹�Ѵ</strong></span></center>
<a target=_top  href="../nindex.htm"><< ����� </a><br />
<form action="ap_putoff1.php" method="post" class="font1" name="form11">
<table width="38%" border="1" cellpadding="0" cellspacing="0">
<tr>
  <td>
	<table width="100%">
  <tr>
    <td>�ѹ���
      <select name="d">
        <option value="0">-</option>
        <?
		for($a=1;$a<=31;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
        <option value="<?=$ss?><?=$a?>">
          <?=$a?>
          </option>
        <?
	}
	?>
        </select>
      ��͹
      <select name="m">
        <?
	$month = array('0','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
	for($a=1;$a<13;$a++){
	?>
        <option value="<?=$month[$a]?>">
          <?=$month[$a]?>
          </option>
        <?
	}
	?>
        </select>
      �.�.
      <select name="yr">
        <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
        <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'";?>>
          <?=$a?>
          </option>
        <?
	}
	?>
      </select></td>
    </tr>
  <tr>
    <td>ᾷ��
      <select name="dr">
        <?
	$strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
	while($objResult = mysql_fetch_array($objQuery)){
	?>
        <option value="<?=$objResult["name"];?>">
          <?=$objResult["name"];?>
          </option>
        <?
	}
	?>
      </select></td>
    </tr>
  <tr>
    <td align="center"><input name="okbtn" type="submit" value="  ��ŧ  " class="font1"/></td>
    </tr></table></td></tr>
</table>
</form><br />
</a>
</div>
<?

$doctor111 =substr($_POST['dr'],0,5);

	if(isset($_POST['okbtn'])){
		$sql = "select * from appoint where appdate LIKE '".$_POST['d']." ".$_POST['m']." ".$_POST['yr']."%' and doctor like '$doctor111%' and apptime !='¡��ԡ��ùѴ'";
		
		$row = mysql_query($sql);
		$num1 = mysql_num_rows($row);
		//echo $sql ;
		
		if($num1>0){
			echo "<form action='ap_putoff1.php' method='post' class='font1' name='form12'>";
			echo "<strong>�ѹ��� ".$_POST['d']." ".$_POST['m']." ".$_POST['yr']."</strong>";
			echo "<table border='1' class='font1' style='border-collapse:collapse' width='100%'><tr><strong><td align='center'>HN</td><td align='center'>����-ʡ��</td><td align='center'>�������</td><td align='center'>������.</td><td align='center'>����</td><td align='center'>�Ѵ������</td><td align='center'>�ѹ���</td><td align='center'>����</td><td align='center'>���͡ </td></strong>";
			//<input name='chch' type='checkbox' onclick=CheckAll();>
			$i=0;
			while($result = mysql_fetch_array($row)){
				$sql3 = "select concat(address,' ',tambol,' ',ampur,' ',changwat) as address,phone from opcard where hn='".$result['hn']."'";
				$row3 = mysql_query($sql3);
				$num3 = mysql_fetch_array($row3);
				$i++;
				echo "<tr><td>".$result['hn']."</td>";
				echo "<td>".$result['ptname']."</td>";
				echo "<td>".$num3['address']."</td>";
				echo "<td>".$num3['phone']."</td>";
				echo "<td>".$result['age']."</td>";
				echo "<td>".$result['detail']."</td>";
				echo "<td>".$result['appdate']."</td>";
				echo "<td>".$result['apptime']."</td>";
				echo "<td align='center'><input name='ch".$i."' id='ch".$i."' type='checkbox' value='".$result['row_id']."' ></td></tr>";
			}?>
			</table><br />
			����͹�Ѵ���ѹ��� <input name="datenew" type="text"  size="5"/>
			 <select name="monnew">
			  <?
			$month = array('0','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
			for($a=1;$a<13;$a++){
			?>
			  <option value="<?=$month[$a]?>"><?=$month[$a]?></option>
			  <?
			}
			?>
			</select>
			<select name="yrnew">
		  <?
		$year = date("Y")+543;
		for($a=($year-5);$a<($year+5);$a++){
		?>
		  <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'";?>>
		  <?=$a?>
		  </option>
		  <?
		}
		?>
		</select>
			<br />
			<br />
����
<?php if($_SESSION["sIdname"]== '�ѧ���' || $_COOKIE["until"] == "�ѧ���"){
		   
		   if(empty($_COOKIE["until"])){
			 @setcookie("until", "�ѧ���", time()+(3600*12));
		   }
	
		   ?>
<select size="1" name="capptime">
		<option value="07:30 �. - 08:00 �.">07:30 �. - 08:00 �.</option>
			<option value="08:30 �. - 09:00 �.">08:30 �. - 09:00 �.</option>
			<option value="09:30 �. - 10:00 �.">09:30 �. - 10:00 �.</option>
			<option value="10:30 �. - 11:00 �.">10:30 �. - 11:00 �.</option>
			<option value="11:30 �. - 12:00 �.">11:30 �. - 12:00 �.</option>
			<option value="12:30 �. - 13:00 �.">12:30 �. - 13:00 �.</option>
			<option value="15:30 �. - 16:00 �.">15:30 �. - 16:00 �.</option>
			<option value="16:30 �. - 17:00 �.">16:30 �. - 17:00 �.</option>
			<option value="17:30 �. - 18:00 �.">17:30 �. - 18:00 �.</option>
			<option value="18:30 �. - 19:00 �.">18:30 �. - 19:00 �.</option>
	
	</select>
	
	   <?php }else{ ?>
		<select size="1" name="capptime">
		<option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>
		<option selected>08:00 &#3609;. - 11.00 &#3609;.</option>
		<option>07:00 &#3609;.</option>
		<option>07:30 &#3609;.</option>
		<option>08:00 &#3609;.</option>
		<option>08:30 &#3609;.</option>
		<option>09:00 &#3609;.</option>
		<option>09:30 &#3609;.</option>
		<option>10:00 &#3609;.</option>
		<option>10:30 &#3609;.</option>
		<option>11:00 &#3609;.</option>
		<option>11:30 &#3609;.</option>
		<option>13:00 &#3609;.</option>
		<option>13:30 &#3609;.</option>
		<option>14:00 &#3609;.</option>
		<option>14:30 &#3609;.</option>
		<option>15:00 &#3609;.</option>
		<option>15:30 &#3609;.</option>
		<option>16:00 &#3609;.</option>
		<option>16:30 &#3609;.</option>
		<option>17:00 &#3609;.</option>
		<option>17:30 &#3609;.</option>
		<option>18:00 &#3609;.</option>
		<option>18:30 &#3609;.</option>
		<option>19:00 &#3609;.</option>
		<option>19:30 &#3609;.</option>
		<option>20:00 &#3609;.</option>
		<option>21:00 &#3609;.</option>
		</select>
		<?php 
		} 
		?>
		<br>
		<input name="chdr" type="checkbox" value="1" onClick="if(document.getElementById('dr2').style.display=='none'){document.getElementById('dr2').style.display='';}else{document.getElementById('dr2').style.display='none'}"/>��ͧ�������¹ᾷ�� 
		<select name="dr2" id="dr2" style="display:none">
		<?php
			$strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
			while($objResult = mysql_fetch_array($objQuery)){
				?>
				<option value="<?=$objResult["name"];?>" <?php if($doctor==$objResult["name"]) echo "selected";?>><?=$objResult["name"];?>
				</option>
				<?php
			}
		?>
		</select>
		<br>

		<input name="count" type="hidden" value="<?=$i?>" />
		<input type="submit" name="ok2" value="��ŧ����͹�Ѵ"  />
		<?
        echo "</form>";		
		}else{
		echo "����բ����š�ùѴ";
	}
	}
	
if(isset($_POST['ok2'])){ 

	$def_fullm_th = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
					'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
					'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');

	$_SESSION['putid'] = array();
	$_SESSION['cancle'] = array();
	
	$labcode= array();
	$dateadd = (date("Y")+543).date("-m-d H:i:s");
	$_POST['datenew']=($_POST['datenew']+0);
	if($_POST['datenew']<10){ 
		$_POST['datenew'] = "0".$_POST['datenew'];
	}
	
	$newdate = $_POST['datenew']." ".$_POST['monnew']." ".$_POST['yrnew'];
	$count = $_POST['count'];


	$month = array_keys($def_fullm_th, $_POST['monnew']);
	$appdate_en = ($_POST['yrnew']-543).'-'.$month['0'].'-'.sprintf('%02d', $_POST['datenew']);
	

	for($a=0; $a<=$count; $a++){
		
		if(isset($_POST['ch'.$a])){
			$sql1 = "select * from appoint where row_id ='".$_POST['ch'.$a]."' ";
			// echo "<pre>";
			// var_dump($sql1);
			// echo "</pre>";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);

			// ����ա�õ������¹���
			if($_POST['chdr']=="1"){
				$result1['doctor'] = $_POST['dr2'];
			}

			$insert1 = "insert into appoint(
				row_id,date,officer,hn,ptname,age,doctor,appdate,apptime,room,
				detail,detail2,advice,patho,xray,other,depcode,came,diag,remark,labextra,appdate_en) 
				values
				(NULL,'".$dateadd."','".$sOfficer."','".$result1['hn']."','".$result1['ptname']."','".$result1['age']."','".$result1['doctor']."','".$newdate."','".$_POST['capptime']."','".$result1['room']."',
				'".$result1['detail']."','".$result1['detail2']."','".$result1['advice']."','".$result1['patho']."','".$result1['xray']."','".$result1['other']."','".$result1['depcode']."','".$result1['came']."','".$result1['diag']."','".$result1['remark']."','".$result1['labextra']."','$appdate_en')";
			
			if(mysql_query($insert1)){

				$idno = mysql_insert_id();

				$updatelab="UPDATE appoint_lab SET id='$idno' WHERE  id='".$_POST['ch'.$a]."'";
				$queryuplab = mysql_query($updatelab);

				$cHn = $result1['hn'];
				$update1 = "update appoint SET apptime='¡��ԡ��ùѴ' where row_id='".$_POST['ch'.$a]."'";
				$re = mysql_query($update1);
				if($re){
					array_push($_SESSION['putid'],$idno);
					array_push($_SESSION['cancle'],$result1['appdate']);
				}
				?>
				<div style="page-break-after:always;"></div>
				<?
			}
			else
			{
				echo mysql_error();
			}
			
		}
	} // Endfor

	// exit;

	if($re){
		?>
			<script>
                  alert("�ѹ�֡���������º��������");
            </script>
            <a href="ap_putoff1print.php" target="_blank" style="font-family:AngsanaUPC; font-size:24px;">�����㺹Ѵ</a><br /><br />

			<a href="ap_putoff1print2.php" target="_blank" style="font-family:AngsanaUPC; font-size:24px;">�������ɳ�ºѵ�</a>
		<?
	}
}
?>

</body>
</html>