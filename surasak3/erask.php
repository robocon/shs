
<?php
   session_start();
   include("connect.inc");
 /*  print "�����¹͡<br>";
   print "HN :$cHn<br>";
     print "VN:$tvn<br>";

   print "$cPtname<br>";*/
   
      ////////// ��Ǩ�ͺ��� ��.���ʹ��ҧ�����������
	$strsql="select * from accrued where hn = '$cHn' and status_pay='n' ";
	$strresult = mysql_query($strsql);
	$strrow=mysql_num_rows($strresult);
	


	if($strrow>0){
		echo "<script>alert('���������ʹ��ҧ����  ��سҵԴ�����ǹ���Թ�����') </script>";
		//echo "&nbsp;&nbsp;&nbsp<b><font style='font-weight:bold'><a target=BLANK  href='accrued_list.php?hn=$hnid'>���ʹ��ҧ����</a></b></font>";

	}
	
		$sqlage = "select idcard,dbirth from opcard where hn ='".$cHn."'";
		$arr_age = mysql_fetch_array(mysql_query($sqlage));
		
		$idcard=$arr_age['idcard'];
		
		if($idcard=="" || $idcard=="-"){
		$img=$cHn.'.jpg';
		}else{
		$img=$idcard.'.jpg';
		}
	
	if(file_exists("../image_patient/$img")){
		
		$image="<IMG SRC='../image_patient/$img' WIDTH='100' HEIGHT='150' BORDER='1' ALT=''>";
	}else{
		$image="";
	}
?>
<table  border="0">
  <tr>
    <td>�����¹͡</td>
   <td rowspan="5" valign="top">
   <?=$image;?>
 
 </td>
  </tr>
  <tr>
     <td>HN :<?=$cHn;?></td>
    </tr>
  <tr>
    <td>VN :<?=$tvn;?></td>
    </tr>
  <tr>
   <td><?=$cPtname;?></td>
    </tr>
</table>
<?
////////////////////////////////////////// 
  ?>
  <script>
  function check()
{
	if(document.getElementById("doctor").selectedIndex=='0'){
		alert("��س����͡ᾷ��");
		return false;
	}
	else{
		return true;
	}
}
  </script>
  <? 
   //print "�Է�ԡ���ѡ�� :$cPtright<br>";
   include("connect.inc");
   $sqlpt = "select * from ptright where status = 'a' order by code asc";
   $rowpt = mysql_query($sqlpt);
?>
<form method="POST" action="prelab.php" onsubmit="return check();">
	�Է�ԡ���ѡ�� :<select name="pt">
   <?
   while($resultpt = mysql_fetch_array($rowpt)){
	$re = $resultpt[0]."�".$resultpt[1];
	//R01��Թʴ
		if($cPtright==$re){
			 $c=0;
			 ?>
			<option value="<?=$cPtright?>" selected="selected"><?=$cPtright?></option>
			 <?
		}
		else{
			$b=0;
			?>
			<option value="<?=$re?>"><?=$re?></option>   
			<?
		}
	}
	if(!isset($c)){
		?>
		<option value="<?=$cPtright?>" selected="selected"><?=$cPtright?></option>
		<?
	}
   ?>
   </select>
  <p>
	<style type="text/css">
	.nid_diag{
		text-decoration: underline;
		cursor: pointer;
	}
	</style>
	<font face="Angsana New">&nbsp;&nbsp;
		<a target=_BLANK href='diaghlp.htm'>�ä</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="diag" id="diag" size="20">
		<span>��ԡ�������� Diag</span>&nbsp;
		<span class="nid_diag" onclick="add_diag('����ġ��')">����ġ��</span>,&nbsp;
		<span class="nid_diag" onclick="add_diag('����ҵ')" data-val="����ҵ">����ҵ</span>,&nbsp;
		<span class="nid_diag" onclick="add_diag('CVA')" data-val="CVA">CVA</span>,&nbsp;
		<span class="nid_diag" onclick="add_diag('����Ѵ')" data-val="CVA">����Ѵ</span>,&nbsp;
		<span class="nid_diag" onclick="add_diag('������')" data-val="CVA">������</span>
  	</font>
	<script type="text/javascript">
		// ���� diag ŧ㹪�ͧ��ҧ
		function add_diag(txt){
			document.getElementById('diag').value = txt;
		}
	</script>
  </p>
  <p><font face="Angsana New">&nbsp;&nbsp;</font><font face="Angsana New">&#3649;&#3614;&#3607;&#3618;&#3660;&nbsp;&nbsp;
  </font><font face="Angsana New">

   <?php
  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));

  if($menucode == "ADMMAINOPD"){
  ?>
  
  <? 
 include("connect.inc");
$strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'   order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" id="doctor"> 
<option value="-��س����͡ᾷ��-">-��س����͡ᾷ��-</option> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>


  <?php }else  if($menucode == "ADMDEN"){

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode ='ADMDEN'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" id="doctor"> 
<option value="-��س����͡ᾷ��-">-��س����͡ᾷ��-</option> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>



  
	  <?php }else{?>
	  <? 
	 $strSQL = "SELECT name FROM doctor where status='y'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" id="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>

	  <?php 
	  }
	  
 if($menucode == "ADMPT"){	   
?>
 <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;੾�йǴἹ�� <br />
���Ǵ <select name="staf_massage" id="staf_massage"> 
<option value="">--���͡--</option> 
<? 
$strstaf = "SELECT name FROM staf_massage order by row_id asc "; 
$objstaf = mysql_query($strstaf) or die ("Error Query [".$strstaf."]");  
while($objarr = mysql_fetch_array($objstaf)) { 
?>
<option value="<?=$objarr['name']?>"><?=$objarr['name']?></option> 
<?
	}
 ?>
</select>	
<?
}  //close if ADMPT

if($menucode == "ADMNID"){	   
		$today = date("Y-m-d");
		$submonth=substr($today,0,7);
?>
<p><strong>੾�нѧ��� ���˵ء�û��� (�����ä)</strong></p>
<table width="40%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left">
    <?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='01'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
    <input name="selnid1" type="checkbox" id="selnid1" value="01" <? if($rows["groupnid"]=="01"){ echo "checked='checked'";}?> />01</td>
    <td align="left">
    <?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='02'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>    
    <input type="checkbox" name="selnid2" id="selnid2" value="02" <? if($rows["groupnid"]=="02"){ echo "checked='checked'";}?> />02</td>
    <td align="left">
    <?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='03'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>    
    <input type="checkbox" name="selnid3" id="selnid3" value="03" <? if($rows["groupnid"]=="03"){ echo "checked='checked'";}?> />03</td>
    <td align="left">
	<?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='04'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
      <input type="checkbox" name="selnid4" id="selnid4" value="04" <? if($rows["groupnid"]=="04"){ echo "checked='checked'";}?> />04</td>
  </tr>
  <tr>
    <td align="left">
	<?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='05'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
        <input type="checkbox" name="selnid5" id="selnid5" value="05" <? if($rows["groupnid"]=="05"){ echo "checked='checked'";}?> />05</td>
    <td align="left"><?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='06'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
        <input type="checkbox" name="selnid6" id="selnid6" value="06" <? if($rows["groupnid"]=="06"){ echo "checked='checked'";}?> />06</td>
    <td align="left">
	<?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='07'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
        <input type="checkbox" name="selnid7" id="selnid7" value="07" <? if($rows["groupnid"]=="07"){ echo "checked='checked'";}?> />07</td>
    <td align="left"><?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='08'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
        <input type="checkbox" name="selnid8" id="selnid8" value="08" <? if($rows["groupnid"]=="08"){ echo "checked='checked'";}?> />08</td>
  </tr>
  <tr>
    <td align="left">
	<?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='09'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
      <input type="checkbox" name="selnid9" id="selnid9" value="09" <? if($rows["groupnid"]=="09"){ echo "checked='checked'";}?> />09</td>
    <td align="left">
	<?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='10'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
        <input type="checkbox" name="selnid10" id="selnid10" value="10" <? if($rows["groupnid"]=="10"){ echo "checked='checked'";}?> />10</td>
    <td align="left"><?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='11'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
        <input type="checkbox" name="selnid11" id="selnid11" value="11" <? if($rows["groupnid"]=="11"){ echo "checked='checked'";}?> />11</td>
    <td align="left">
	<?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='12'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
        <input type="checkbox" name="selnid12" id="selnid12" value="12" <? if($rows["groupnid"]=="12"){ echo "checked='checked'";}?> />12</td>
  </tr>
  <tr>
    <td align="left">
	<?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='13'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
        <input type="checkbox" name="selnid13" id="selnid13" value="13" <? if($rows["groupnid"]=="13"){ echo "checked='checked'";}?> />13</td>
    <td align="left">
	<?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='14'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
        <input type="checkbox" name="selnid14" id="selnid14" value="14" <? if($rows["groupnid"]=="14"){ echo "checked='checked'";}?> />14</td>
    <td align="left">
	<?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='15'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
        <input type="checkbox" name="selnid15" id="selnid15" value="15" <? if($rows["groupnid"]=="15"){ echo "checked='checked'";}?> />15</td>
    <td align="left">
	<?
		$tbsql="select * from clinicnid where date_time like '$submonth%' && hn='$cHn' && groupnid='16'";
		$result=mysql_query($tbsql);
		$rows=mysql_fetch_array($result);
	?>
        <input type="checkbox" name="selnid16" id="selnid16" value="16" <? if($rows["groupnid"]=="16"){ echo "checked='checked'";}?> />16</td>
  </tr>
</table>	
<?
}  //close if ADMNID
?>	  
 </font> </p>

  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input type="submit" value="   ��ŧ   " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp; <input type="reset" value=" ¡��ԡ " name="B2"></font></p>
</form>
