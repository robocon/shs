<?php
   session_start();
   if(isset($sIdname)){} else {die;}
    include("connect.inc");

  
    ////////// ��Ǩ�ͺ��� ��.���ʹ��ҧ�����������
	$strsql="select * from accrued where hn = '$cHn' and status_pay='n' ";
	$strresult = mysql_query($strsql);
	$strrow=mysql_num_rows($strresult);
	


	if($strrow>0){
		echo "<script>alert('���������ʹ��ҧ����  ��سҵԴ�����ǹ���Թ�����') </script>";
		//echo "&nbsp;&nbsp;&nbsp<b><font style='font-weight:bold'><a target=BLANK  href='accrued_list.php?hn=$hnid'>���ʹ��ҧ����</a></b></font>";

	}
//////////////////////////////////////////
   
   function calcage($birth){
		$today = getdate();   
		$nY  = $today['year']; 
		$nM = $today['mon'] ;
		$bY=substr($birth,0,4)-543;
		$bM=substr($birth,5,2);
		$ageY=$nY-$bY;
		$ageM=$nM-$bM;
	
		if ($ageM<0) {
			$ageY=$ageY-1;
			$ageM=12+$ageM;
		}
	
		if ($ageM==0){
			$pAge="$ageY ��";
		}else{
			$pAge="$ageY �� $ageM ��͹";
		}
	
	return $pAge;
}
		$sqlage = "select idcard,dbirth,idguard,goup   from opcard where hn ='".$cHn."'";
		$arr_age = mysql_fetch_array(mysql_query($sqlage));
		$age = calcage($arr_age['dbirth']);
		
		
		$idcard=$arr_age['idcard'];
				$idguard=$arr_age['idguard'];
				$goup=$arr_age['goup'];
		
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
	
	$chkdate=(date("Y")+543)."-".date("m-d");
	$sql1=mysql_query("select ptright,toborow from opday where hn='$cHn' and thidate like '$chkdate%' order by row_id desc limit 1 ");
	//echo $sql1;
	list($aptright,$atoborow)=mysql_fetch_array($sql1);
	
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
  <tr>
    <td><font color='#FF0000' style='font-size:18px'>����: <?=$age;?></font></td>
    </tr>
    <tr>
    <td><font color='#FF0000' style='font-size:18px'><?=$idguard;?></font></td>
    </tr>
      <tr>
    <td><font color='#FF0000' style='font-size:18px'><?=$goup;?></font></td>
    </tr>
      <tr>
    <td><font color='#0000FF' style='font-size:18px'><?=$atoborow;?></font></td>
    </tr> 
      <tr>
    <td><font color='#0000FF' style='font-size:18px'><?=$aptright;?></font></td>
    </tr>        
 <!--     <tr>
    <td><hr /><font color='#0000FF' style='font-size:16px'>*** �ó� ��Ǩ�آ�Ҿ���û�Шӻ� ������͡***<br />�ä : ��Ǩ�آ�Ҿ<br />�Է�� : R22 ��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��</font><hr /></td>
    </tr>    -->
</table>

 <? 
if(substr($atoborow,0,4)=="EX26"){  
   $sqlpt = "select * from ptright where code = 'R22' order by code asc";
}else{
   $sqlpt = "select * from ptright where status = 'a' order by code asc";
}   
   $rowpt = mysql_query($sqlpt);
   
   
   $sqlpt1 = "select * from ptright where chk_up = 'y' order by code asc"; 
   $rowpt1 = mysql_query($sqlpt1);


   $cXraydetail = "";
   session_register("cXraydetail");
?>
<script>
function check()
{
	if(document.getElementById("doctor").value == ' ��س����͡ᾷ��'){
		alert("��س����͡ᾷ��");
		return false;
	}
	else if(document.getElementById("cXraydetail").innerHTML == ''){
		alert("��س����͡��Ǩ(���)");
		return false;
	}
	else{
		return true;
	}
}
function sit(){
		document.getElementById('pt').style.display='none';
		document.getElementById('pt2').style.display='';
}
function sit2(){
		document.getElementById('pt').style.display='';
		document.getElementById('pt2').style.display='none';
}
</script>
   <form method="POST" action="prelab.php" onsubmit="return check();">
   <input type="hidden" name="chktoborow" value="<?=$atoborow;?>" />
    <p><font face="Angsana New">
&nbsp;&nbsp;&#3650;&#3619;&#3588;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;
  <select size="1" name="diag" id="aLink" onchange="if(this.value=='��Ǩ�آ�Ҿ'){sit();} else{sit2();}"><script type="text/javascript">
document.getElementById('aLink').focus();
</script>
    <option value="��Ǩ�����������͡���ѡ��" selected>��Ǩ�����������͡���ѡ��</option>
    <? if($_SESSION["smenucode"]=="ADMXR"){ ?>
    <option value="��Ǩ�آ�Ҿ" <? if(substr($atoborow,0,4)=="EX26" OR substr($atoborow,0,4)=="EX45" ){ echo "selected";}?>>��Ǩ�آ�Ҿ</option>
    <? }else{ ?>
    <option value="��Ǩ�آ�Ҿ">��Ǩ�آ�Ҿ</option>
    <? } ?>
    
  </select>&nbsp;</font></p>
<font face="Angsana New">�Է��&nbsp;
<? if($_SESSION["smenucode"]=="ADMXR"){ ?>
	<select name="pt" id="pt" style="display:">
	<?
	while($resultpt = mysql_fetch_array($rowpt)){
		$re = $resultpt[0]."�".$resultpt[1];
		if($cPtright==$re){  //����Է�Լ����µç�Ѻ�Է�ԻѨ�غѹ
			$c=0;
			 ?>
			<option value="<?=$cPtright?>" selected="selected">
  				<?=$cPtright?>
  			</option>
  			<?
		}else{
			$b=0;
			?>
			<option value="<?=$re?>" <? if(substr($atoborow,0,4)=="EX26" OR substr($atoborow,0,4)=="EX45" ){ echo "selected";}?>>
				<?=$re?>  <!--R22-->
			</option>
			<?
		}
	}

	if(!isset($c)){
		?>
  <option value="<?=$cPtright?>" <? if(substr($atoborow,0,4)!="EX26" OR substr($atoborow,0,4)=="EX45" ){ echo "selected";}?>>
  <?=$cPtright?>  <!--����Է�Լ�����-->
  </option>
  <?
	}
   ?>
</select>
<? }else{ ?>
<select name="pt" id="pt" style="display:">
  <?
   while($resultpt = mysql_fetch_array($rowpt)){
	$re = $resultpt[0]."�".$resultpt[1];
	//R01��Թʴ
		if($cPtright==$re){
			 $c=0;
			 ?>
  <option value="<?=$cPtright?>" selected="selected">
  <?=$cPtright?>
  </option>
  <?
		}
		else{
			$b=0;
			?>
  <option value="<?=$re?>">
  <?=$re?>
  </option>
  <?
		}
	}
	if(!isset($c)){
		?>
  <option value="<?=$cPtright?>" selected="selected">
  <?=$cPtright?>
  </option>
  <?
	}
   ?>
</select>
<? } ?>

<!--�������� �óշ�����͡�� ��Ǩ�آ�Ҿ-->
<select name="pt2" id="pt2" style="display:none">
  <?
   while($resultpt = mysql_fetch_array($rowpt1)){
	$re = $resultpt[0]." ".$resultpt[1];
	//R01��Թʴ
		if($cPtright==$re){
			 $c=0;
  ?>

  <?=$cPtright?>
  </option>
  <?
		}
		else{
			$b=0;
			?>
  <option value="<?=$re?>">
  <?=$re?>
  </option>
  <?
		}
	}
	if(!isset($c)){
		?>

  <?=$cPtright?>
  </option>
  <?
	}
   ?>
</select>

</font>


 
  <p><font face="Angsana New" >&nbsp;&nbsp;</font><font face="Angsana New">&#3649;&#3614;&#3607;&#3618;&#3660;&nbsp;&nbsp;
 
  <?php
   include("connect.inc");
   $month = array("","���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
   
   $dd = date("d")." ".$month[date("n")]." ".(date("Y")+543);
   $sqlappoint = "select doctor from appoint where hn = '".$cHn."' and appdate like '$dd%'";
   $app1 = mysql_fetch_array(mysql_query($sqlappoint));
   ////////////////////////////////////
  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));

if($menucode == "ADMNID"){
$strSQL = "SELECT name FROM doctor  where status='y'  and menucode ='ADMNID'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" id="doctor"> 
<?
  	while($objResult = mysql_fetch_array($objQuery)) {
		if($app1['doctor']==$objResult["name"]){
			 ?>
<option value="<?=$objResult["name"]?>" selected="selected"><?=$objResult["name"]?></option>
			 <?
		}
		else{
			?>
			<option value="<?=$objResult["name"];?>" ><?=$objResult["name"];?></option>    
			<?
		}
	}
?>
</select>



  
<?php }else  if($menucode == "ADMDEN"){

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode ='ADMDEN'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" id="doctor"> 
<?
  	while($objResult = mysql_fetch_array($objQuery)) {
		if($app1['doctor']==$objResult["name"]){
			 ?>
<option value="<?=$objResult["name"]?>" selected="selected"><?=$objResult["name"]?></option>
			 <?
		}
		else{
			?>
			<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option>    
			<?
		}
	}
?>
</select>

<?php 
}else  if($menucode == "ADMXR"){

	if($_SESSION["sOfficer"] == "����ѵ�� �������1"){
		$name = "MD013 ����Թ��� ����չҤ";
	}else{
		$name = "MD022 (����Һᾷ��)";
	}
	
	$strSQL = "SELECT name FROM doctor  where status='y' order by name "; 
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
	?>
	<select name="doctor" id="doctor"> 
		<option value="MD022 (����Һᾷ��)">MD022 (����Һᾷ��)</option>
		<?php
		while($objResult = mysql_fetch_array($objQuery)) {
			if($name == $objResult["name"]){
				?>
				<option value="<?=$objResult["name"]?>" selected="selected"><?=$objResult["name"]?></option>
				<?php
			}else{
				?>
				<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option>
				<?php
			}
		}
		?>
	</select>

<?php 

}else{  //���͹�����

	$strSQL = "SELECT name FROM doctor where status='y' order by name"; 
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
	if( $app1 === false ){
		$app1['doctor'] = 'MD022 (����Һᾷ��)';
	}

	?>
	<select name="doctor" id="doctor"> 
		<option value="MD022 (����Һᾷ��)">MD022 (����Һᾷ��)</option>
	<?php
	while($objResult = mysql_fetch_array($objQuery)) {
		if( $app1['doctor'] == $objResult["name"] ){
			?>
			<option value="<?=$objResult["name"]?>" selected="selected"><?=$objResult["name"]?></option>
			<?php
		}
		else{
			?>
			<option value="<?=$objResult["name"];?>" <? if($objResult["name"]=="MD022 (����Һᾷ��)"&&$_SESSION["until_login"] == "LAB") echo "selected='selected'";?>><?=$objResult["name"];?></option>    
			<?php
		}
	}
	?>
	</select>
	<?php 
}
?>
 
 </font> </p>
<?php if($cDepart == "PATHO"){?>
	<p>
	<font face="Angsana New">������觴�ǹ : 
	<SELECT NAME="priority">
			<Option value="R">�á��</option>
			<Option value="S">��ǹ</option>
		</SELECT>
		
	<br />
	<br />
    �Ѵ LAB �ѹ��� &nbsp;
    <select size="1" name="appday">
      <?
      for($p=1;$p<32;$p++){
		  if($p<10){ $p="0".$p;}
	  ?>
			<option value="<?=$p?>" <? if(date('d')==$p){ echo "selected";}?>><?=$p?></option>
      <?
	  }
	  ?>
    </select>
    &nbsp;&nbsp;��͹
    <? $m=date('m'); ?>
    <select size="1" name="appmon">
      <option selected="selected">--��͹--</option>
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
    &nbsp;&nbsp; �վ.�.
    <? 
	$Y=date("Y")+543;
 	$date=date("Y")+543+5;
			  
	$dates=range(2547,$date);
	echo "<select name='appyr'>";
	foreach($dates as $i){
		?>
		<option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
		<?
	}
	echo "<select>";
	?>
    </p></font>
	<?php } 
	
	if($_SESSION["until_login"] == "xray"){
	  
	?>
	<font face="Angsana New"><A HREF="xraylst_dr.php" target="right">��Ǩ(���)</A> : <BR>
	<div id="cXraydetail">
	<?php
	$sql = "SELECT `hn` 
	FROM `opcardchk` 
	WHERE `hn` = '$cHn' 
	AND `part` = '�����ҹԪ60'";
	$q = mysql_query($sql) or die( mysql_error() );
	$row = mysql_num_rows($q);
	if( $row > 0 ){
		?>
		<div id="dv1">
			<a href="javascript:void(0);" onclick="document.getElementById('dv1').style.display='none';document.getElementById('dv1').innerHTML='';">CXR </a>
			<input type="hidden" name="xraydetail[]" value="CXR ">
		</div>
		<?php
	}
	?>
	</div>
	<?php
  } ?>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input type="submit" value="   &#3605;&#3585;&#3621;&#3591;   " name="B1"></font></p>
</form>

<?php 
	
	if($_SESSION["until_login"] == "xray"){
	  
  
  $Thidate = (date("Y")+543).date("-m-d");
  $sql = "Select distinct xrayno, date_format(date,'%H:%i') as time2, hn, vn, yot, name, sname, doctor, xrayno, detail_all From xray_doctor where date like '".$Thidate."%' AND hn='".$cHn."' AND orderby = 'DR' ";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
  ?>
��¡����觨ҡᾷ��
<TABLE border="3" bordercolor="#FFFFFF" style='BORDER-COLLAPSE: collapse' width="100%" >
<TR  bgcolor="#3366FF" style="font-family:  MS Sans Serif; font-size: 14 px;	color:#FFFFFF;	font-weight: bold;">
	<TD align="center" >No.</TD>
	<TD align="center" >����</TD>
	<TD align="center" >���� - ʡ��</TD>
	<TD align="center" >ᾷ�������</TD>
</TR>

  <?php
	$i=1;
	  
	while($arr = mysql_fetch_assoc($result)){

		if($i % 2 == 0){
			$bgcolor="#FFFFFF";
		}else{
			$bgcolor="#BFFFBF";
		}
		
		echo "<TR bgcolor=\"",$bgcolor,"\">";
			echo "<TD align=\"center\" >",$i,"</TD>";
			echo "<TD align=\"center\" >",$arr["time2"],"</TD>";
			echo "<TD align=\"center\" ><A HREF=\"xraydoctordetail.php?xrayno=",$arr["xrayno"],"&xraydetail=",urlencode($arr["detail_all"]),"\">",$arr["name"]," ",$arr["sname"],"</A></TD>";
			echo "<TD align=\"center\" ><A HREF=\"xraydoctor_print.php?vn=",urlencode($arr["vn"]),"&hn=",urlencode($arr["hn"]),"&name=",urlencode($arr["yot"]." ".$arr["name"]." ".$arr["sname"]),"&detail_all=",urlencode($arr["detail_all"]),"&doctor=",urlencode($arr["doctor"]),"\" target=\"_blank\">",$arr["doctor"],"</A></TD>";
		echo "</TR>";
		echo "<TR bgcolor=\"",$bgcolor,"\">";
			echo "<TD colspan=\"1\" >&nbsp;</TD>";
			echo "<TD colspan=\"3\" >",nl2br($arr["detail_all"]),"</TD>";
		echo "</TR>";
		echo "<TR bgcolor=\"#FFFF06\">";
			echo "<TD colspan=\"4\" height=\"5\"></TD>";
		echo "</TR>";
		$i++;

	}
	?>
</TABLE>
	<?php
	}
  } ?>
