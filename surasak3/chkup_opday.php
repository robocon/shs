<style>
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.font1{
	font-family: "TH SarabunPSK";
	font-size:20px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.style1 {
	font-size: 16px;
	color: #FF3333;
}
</style>
<script>
function check(){
	if(document.form2.chunyot.value =="0"){
		alert('��س����͡�����');
		document.form2.chunyot.focus();
		return false;
	}else if(document.form2.idcard.value ==""){
		alert('��سҡ�͡�Ţ���ѵû�Шӵ�ǻ�ЪҪ�');
		document.form2.idcard.focus();
		return false;						
	}else if(document.form2.camp.value =="0"){
		alert('��س����͡�ѧ�Ѵ����Ǩ�آ�Ҿ');
		document.form2.camp.focus();
		return false;	
	}else if(document.form2.position.value ==""){
		alert('��سҡ�͡�����ŵ��˹�');
		document.form2.position.focus();
		return false;																																
	}else if(document.form2.camp.value =="D33 ˹��·�������" && document.form2.othercamp.value ==""){
		alert('��سҡ�͡�����Ū���˹��·��÷���ѧ�Ѵ');
		document.form2.othercamp.focus();
		return false;																																
	}else{
		return true;
	}
}
</script>
<?php
include("connect.inc");
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
		$pAge="$ageY";
	}else{
		if ($ageM > 5){
			$ageY=$ageY+1;
			$pAge="$ageY";
		}else{
			$pAge="$ageY";
		}
	}

return $pAge;
}

		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		$nPrefix=$row->prefix;
		
if(isset($_POST['save2'])){
	$sel = "select * from chkup_solider where hn='".$_POST['hn']."' and yearchkup='".$_POST["yearchkup"]."'";
	$rowsel = mysql_query($sel);
	$numrow= mysql_num_rows($rowsel);
	if($numrow==0){
		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		
		$nRunno=$row->runno;
		$nPrefix=$row->prefix;
		$nRunno++;
		$n_runno= $nPrefix."/".$nRunno;
		$query ="UPDATE runno SET runno = $nRunno WHERE title='s_chekup'";
		$result = mysql_query($query) or die("Query failed");
		$datenow=(date("Y")+543).date("-m-d H:i:s");
		$sql = "insert into chkup_solider (thidate,hn,yot,ptname,age,gender,chunyot,idcard,position,ratchakarn,dxptright,camp,othercamp,idno,yearchkup) values('".$datenow."','".$_POST['hn']."','".$_POST['yot']."','".$_POST['ptname']."','".$_POST['age']."','".$_POST['gender']."','".$_POST['chunyot']."','".$_POST['idcard']."','".$_POST['position']."','".$_POST['ratchakarn']."','".$_POST['dxptright']."','".$_POST['camp']."',othercamp ='".$_POST['othercamp']."','".$n_runno."','".$_POST['yearchkup']."')";
		//echo $sql;
		$result =mysql_query($sql);
		$sql1=mysql_query("update opcard set yot='".$_POST['yot']."', camp='".$_POST['campshs']."' where hn='".$_POST['hn']."'");
		if($result){
			echo "<div align='center'><strong>�ѹ�֡���������º��������</strong></div>";
			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1;URL=chkup_opday.php\">";
		}		
	}else{
		$rep = mysql_fetch_array($rowsel);
		$sql = "update chkup_solider set yot ='".$_POST['yot']."',ptname ='".$_POST['ptname']."',age ='".$_POST['age']."',gender ='".$_POST['gender']."',chunyot ='".$_POST['chunyot']."',idcard ='".$_POST['idcard']."',position ='".$_POST['position']."',ratchakarn ='".$_POST['ratchakarn']."',dxptright ='".$_POST['dxptright']."',camp ='".$_POST['camp']."',othercamp ='".$_POST['othercamp']."',yearchkup='".$_POST['yearchkup']."' where row_id='".$rep['row_id']."' ";
		$result =mysql_query($sql);
		$sql1=mysql_query("update opcard set yot='".$_POST['yot']."', camp='".$_POST['campshs']."' where hn='".$_POST['hn']."'");
		if($result){
			echo "<div align='center'><strong>��䢢��������º��������</strong></div>";
			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1;URL=chkup_opday.php\">";
		}			
	}

}elseif(isset($_POST['hn']) || isset($_POST['idcard'])){
		echo "<a href ='chkup_opday.php' >&lt;&lt; ��Ѻ</a>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;<a href ='chk_year.php' target='_blank' >��ª��ͷ��÷��ŧ����¹��Ǩ�آ�Ҿ</a>";
?>		
<form name="form2" method="post" action="" class="font1" onsubmit="return check()" >
<?
		if(!empty($_POST['hn'])){
			$sql = "select * from opcard where hn = '".$_POST['hn']."'";
		}else{
			$sql = "select * from opcard where idcard='".$_POST['idcard']."'";
		}
		//echo $sql;
		$row = mysql_query($sql);
		$rep = mysql_fetch_array($row);
		$gender=$rep["sex"]; 
		list($y,$m,$d)=explode("-",$rep["dbirth"]);
		$dbirth="$d/$m/$y";
		
		if(!empty($_POST['hn'])){
		$query=mysql_query("select yot,ptname,chunyot, camp, othercamp, position, ratchakarn from chkup_solider where hn = '".$_POST['hn']."' and yearchkup='".$nPrefix."'");
		}else{
		$query=mysql_query("select yot,ptname,chunyot, camp, othercamp, position, ratchakarn from chkup_solider where idcard = '".$_POST['idcard']."' and yearchkup='".$nPrefix."'");
		}
		list($yot,$ptname,$chunyot,$camp,$othercamp,$position,$ratchakarn)=mysql_fetch_row($query);
		if(mysql_num_rows($query) > 0){
			$newcamp=substr($camp,4);
			echo "<script>alert('$yot $ptname �ѧ�Ѵ $newcamp ��������к�����');</script>";
		}
?>		
<table width="50%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td height="48" colspan="2" align="center" valign="middle" bgcolor="#009999"><strong>ŧ����¹��Ǩ�آ�Ҿ���û�Шӻ� 
      <?="25".$nPrefix;?>
      <input type="hidden" name="yearchkup" id="yearchkup" value="<?=$nPrefix;?>" />
      <input type="hidden" name="dxptright" id="dxptright" value="1" />
    </strong></td>
  </tr>
  <tr>
    <td width="40%" align="right" bgcolor="#66CC99"><strong>HN : </strong></td>
    <td width="60%" bgcolor="#CCFFCC"><input name="hn" type="text" class="forntsarabun" id="hn" size="6" value="<?=$rep["hn"];?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>�� : </strong></td>
    <td bgcolor="#CCFFCC"><input name="yot" type="text" class="forntsarabun" id="yot" value="<?=$rep["yot"];?>" size="6" />
      <span class="style1">�� ��.�. , �.�. , �.�. , ...���</span></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>����-���ʡ�� : </strong></td>
    <td bgcolor="#CCFFCC"><input name="ptname" type="text" class="forntsarabun" id="name" value="<?=$rep["name"]." ".$rep["surname"];?>" size="15" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>�� : </strong></td>
    <td bgcolor="#CCFFCC"><span class="tb_font_2">
      <select name="gender" class="forntsarabun" id="gender">
        <option value='<? if($gender=="�"){ echo "1";}else if($gender=="�"){ echo "2";}?>' >
        <? if($gender=="�"){ echo "���";}else if($gender=="�"){ echo "˭ԧ";}else{ echo "";}?>
        </option>
        <option value="1">���</option>
        <option value="2">˭ԧ</option>
      </select>
    </span></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>����� : </strong></td>
    <td bgcolor="#CCFFCC"><select name="chunyot" class="forntsarabun" id="chunyot">
      <option value="<?=$chunyot;?>">
        <?=substr($chunyot,5);?>
        </option>
      <option value="CH01 ��·��ê���ѭ�Һѵ�">��·��ê���ѭ�Һѵ�</option>
      <option value="CH02 ��·��ê�鹻�зǹ">��·��ê�鹻�зǹ</option>
      <option value="CH04 �١��ҧ��Ш�">�١��ҧ��Ш�</option>
    </select></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>�Ţ��Шӵ�ǻ�ЪҪ� : </strong></td>
    <td bgcolor="#CCFFCC"><input name="idcard" type="text" class="forntsarabun" id="idcard" value="<?=$rep["idcard"];?>" size="15" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>�ѧ�Ѵ (��Ǩ�آ�Ҿ) : </strong></td>
    <td bgcolor="#CCFFCC"><select name="camp" class="forntsarabun" id="camp">
     <option value="<?=$camp;?>"><?=substr($camp,4);?></option>
      <option value="D01 þ.��������ѡ��������">þ.��������ѡ��������</option>
      <option value="D02 ��� ��� ͡.��� ���.32">��� ��� ͡.��� ���.32</option>
      <option value="D03 ���.���.32">���.���.32</option>
      <option value="D04 ʧ.ʴ.��.�.�.">ʧ.ʴ.��.�.�.</option>
      <option value="D05 ���.���.32">���.���.32</option>
      <option value="D06 �¡.���.32">�¡.���.32</option>
      <option value="D07 ���.���.32">���.���.32</option>
      <option value="D08 ���.���.32">���.���.32</option>
      <option value="D09 ���.���.32">���.���.32</option>
      <option value="D10 �ʡ.���.32">�ʡ.���.32</option> 
      <option value="D11 ���.���.32">���.���.32</option>  
      <option value="D12 ����.���.32">����.���.32</option> 
      <option value="D13 ��.���.32">��.���.32</option> 
      <option value="D14 ���.���.32">���.���.32</option>  
      <option value="D15 ���.���.32">���.���.32</option> 
      <option value="D16 ��Ȩ.���.32">��Ȩ.���.32</option> 
      <option value="D17 ���.���.32">���.���.32</option>  
      <option value="D18 ���.���.32">���.���.32</option> 
      <option value="D19 ��.�.���.32">��.�.���.32</option> 
      <option value="D20 ���.���.32">���.���.32</option>  
      <option value="D21 �ͧ è.���.32">�ͧ è.���.32</option>                                    
      <option value="D22 ����.��.���.32">����.��.���.32</option>  
      <option value="D23 ���.���.32">���.���.32</option>  
      <option value="D24 ʢ�.���.32">ʢ�.���.32</option>  
      <option value="D25 ��þ���ѧ ���.32">��þ���ѧ ���.32</option>  
      <option value="D26 ����.���.32">����.���.32</option>  
      <option value="D27 �ʾ.���.32">�ʾ.���.32</option>  
      <option value="D28 ��.��.���.32">��.��.���.32</option>  
      <option value="D29 Ƚ.�ȷ.���.32">Ƚ.�ȷ.���.32</option>  
      <option value="D30 �.17 �ѹ.2">�.17 �ѹ.2</option>  
      <option value="D31 �.�ѹ.4 ����4">�.�ѹ.4 ����4</option>  
      <option value="D32 ����.�þ.3">����.�þ.3</option>
        <option value="D34 ���.33">���.33</option>
      <option value="D33 ˹��·�������">˹��·�������</option>                            
    </select></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>�кت���˹��·������� :</strong> </td>
    <td bgcolor="#CCFFCC"><input name="othercamp" type="text" class="forntsarabun" id="othercamp" value="<?php echo $othercamp; ?>" size="15" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>�ѧ�Ѵ (�ç��Һ��) : </strong></td>
    <td bgcolor="#CCFFCC"><?		
		$sql3 = "select * from camp";
		$row3 = mysql_query($sql3);
		echo "<select name='campshs' class='forntsarabun'>";
		echo "<option value=''>-- ���͡ --</option>";
		while($rep3 = mysql_fetch_array($row3)){
			$exp = explode(" ",$rep3['name']);
			?>
			<option value='<?=$rep3['name']?>' <? if(substr($rep['camp'],0,3)==$exp[0]) echo "selected";?>><?=$rep3['name']?></option>
            <?
		}
		echo "</select>";
		?>		</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>���˹� : </strong></td>
    <td bgcolor="#CCFFCC"><input name="position" type="text" class="forntsarabun" value="<?php echo $position; ?>" size="15" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>�����Ҫ��� (�����) : </strong></td>
    <td bgcolor="#CCFFCC"><input name="ratchakarn" type="text" class="forntsarabun" id="ratchakarn" value="<?php echo $ratchakarn; ?>" size="15" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>�ѹ/��͹/�� �Դ : </strong></td>
    <td bgcolor="#CCFFCC"><input name="dbirth" type="text" class="forntsarabun" id="dbirth" size="15"  value="<?=$dbirth;?>"/></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#66CC99"><strong>���� : </strong></td>
    <td bgcolor="#CCFFCC"><input name="age" type="text" class="forntsarabun" id="age" size="15" value="<?=calcage($rep["dbirth"]);?>" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#009999">&nbsp;</td>
    <td bgcolor="#009999"><input name='save2' type='submit' class="forntsarabun" id='save2' value='�ѹ�֡������'></td>
  </tr>
</table>
</form>
<?
}else{
?>
<a href ="../nindex.htm" >&lt;&lt; �����</a>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;<a href ="chk_year.php" target="_blank" >��ª��ͷ��÷��ŧ����¹��Ǩ�آ�Ҿ</a>
<form name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>">
<strong>ŧ����¹��Ǩ�آ�Ҿ����</strong><br>
<table width="40%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="26%" align="right"><strong>HN :</strong></td>
    <td width="74%"><input name="hn" type="text" class="forntsarabun" id="hn" />
����</td>
  </tr>
  <tr>
    <td align="right"><strong>ID CARD :</strong></td>
    <td><input name="idcard" type="text" class="forntsarabun" id="idcard" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="save" type="submit" class="forntsarabun" value="��ŧ" /></td>
  </tr>
</table>
<br>
</form>
<?
}
?>
