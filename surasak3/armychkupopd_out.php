<?
session_start();
//if (isset($sIdname)){} else {die;} //for security
include("connect.inc");

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
?>
<style type="text/css">
<!--
body,td,th {
	font-family: "cs ChatThai", "CS ChatThaiUI";
	font-size: 18px;
}
.frmsaraban{
	font-family: "cs ChatThai", "CS ChatThaiUI";
	font-size: 18px;
}
.labfont {		
	font-family: "cs ChatThai", "CS ChatThaiUI";
	font-size: 18px;
}
-->
#showMe{
    display:none;
}
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.style1 {font-family: "cs ChatThai", "CS ChatThaiUI"; font-size: 18px; font-weight: bold; }
</style>
<title>�ѹ�֡�ŵ�Ǩ�آ�Ҿ���û�Шӻ� (��Ǩ������)</title><a href ="../nindex.htm" >&lt;&lt; �����</a>
<form action="armychkupopd_out.php" method="post">
<input name="act" type="hidden" value="show" />
<div align="center"><strong>�ѹ�֡�ŵ�Ǩ�آ�Ҿ���û�Шӻ� <?=$nPrefix;?></strong> (��Ǩ������)</div>
<br>
<TABLE width="357" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#393939" >
  <TR>
	<TD width="439" height="148">
	<TABLE width="451" height="142" border="0" cellpadding="2" cellspacing="0">
	<TR>
	  <TD height="30" colspan="2" align="center" bgcolor="#339999" class="tb_font_1"><strong>���� HN / ID</strong></TD>
		</TR>
	<TR>
	  <TD width="35" height="22" align="right" bgcolor="#66CC99" class="tb_font">HN :&nbsp;</TD>
		<TD width="416" bgcolor="#66CC99" class="tb_font"><input type="text" name="p_hn" />
		  &nbsp;(Hospital Number)</TD>
	</TR>
	<TR>
	  <TD align="right" bgcolor="#66CC99" class="tb_font">ID :&nbsp;</TD>
	  <TD height="35" bgcolor="#66CC99" class="tb_font"><input type="text" name="p_id"  />
	    &nbsp;(�Ţ���ѵû�ЪҪ�)</TD>
	  </TR>
	<tr>
	  <td height="31" align="right" bgcolor="#66CC99" class="tb_font">���� :&nbsp;</td>
      <td height="31" bgcolor="#66CC99" class="tb_font"><input type="text" name="p_name"  />
ʡ�� :
  <input type="text" name="p_sname" /></td>
	</tr>
	<TR>
	  <TD colspan="2" align="center" bgcolor="#66CC99" class="tb_font"><input name="Submit" type="submit" class="frmsaraban" value="��ŧ" /></TD>
	  </TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<br />
</form>
<script language="JavaScript">
	function fncSum()
	{
		 if(isNaN(document.vsform.txtheight.value) || document.vsform.txtheight.value == "")
		 {
			//alert('(��ǹ�٧)Please input Number only.');
			document.vsform.txtNumberA.focus();
			return;
		 }

		 if(isNaN(document.vsform.txtweight.value) || document.vsform.txtweight.value == "")
		 {
			//alert('(���˹ѡ)Please input Number only.');
			document.vsform.txtNumberB.focus();
			return;
		 }
		
		
		var high_m= parseFloat(document.vsform.txtheight.value)/100;
		var high_2=high_m*high_m;
		var bmi=parseFloat(document.vsform.txtweight.value)/high_2;
		//alert(bmi);
		var bmi=bmi.toFixed(2);
		document.vsform.txtbmi.value = bmi;
		document.vsform.txtbmi1.value = bmi;
	}
</script>
<script language="javascript">
function gettext( ){
	if(document.vsform.txtpulse.value ==""){ 
		document.vsform.txtsteptest1.value='';
	}else { 
		document.vsform.txtsteptest1.value=document.vsform.txtpulse.value;
	}
}
</script>

<script>
function checkfrm(){
	if(document.vsform.txtweight.value ==""){
		alert('��سҡ�͡�����Ź��˹ѡ');
		document.vsform.txtweight.focus();
		return false;
	}else if(document.vsform.txtheight.value ==""){
		alert('��سҡ�͡�����Ť����٧');
		document.vsform.txtheight.focus();
		return false;		
	}else if(document.vsform.txtwaist.value ==""){
		alert('��سҡ�͡�������ͺ���');
		document.vsform.txtwaist.focus();
		return false;		
	}else if(document.vsform.txttemperature.value ==""){
		alert('��سҡ�͡������ TEMPERATURE');
		document.vsform.txttemperature.focus();
		return false;		
	}else if(document.vsform.txtpause.value ==""){
		alert('��سҡ�͡������ PAUSE');
		document.vsform.txtpause.focus();
		return false;		
	}else if(document.vsform.txtrate.value ==""){
		alert('��سҡ�͡������ RATE');
		document.vsform.txtrate.focus();
		return false;	
	}else if(document.vsform.txtbp1.value ==""){
		alert('��سҡ�͡�����Ť����ѹ���Ե BP1');
		document.vsform.txtbp1.focus();
		return false;
	}else if(document.vsform.txtbp2.value ==""){
		alert('��سҡ�͡�����Ť����ѹ���Ե BP1');
		document.vsform.txtbp2.focus();
		return false;		
	}else if(document.vsform.prawat.value ==""){
		alert('��س����͡�����Ż���ѵ��ä��Шӵ��');
		document.vsform.prawat.focus();
		return false;						
	}else if(document.vsform.prawat.value =="6" && document.vsform.congenital_disease.value ==""){
		alert('��سҡ�͡�������ä��Шӵ�� (�ä��Шӵ������)');
		document.vsform.congenital_disease.focus();
		return false;
	}else if(document.vsform.prawat.value !="0" && document.vsform.hospital.value ==""){
		alert('��سҡ�͡�������ç��Һ�ŷ���Ѻ����ѡ��');
		document.vsform.congenital_disease.focus();
		return false;				
	}else if(document.vsform.drugreact1.checked == false && document.vsform.drugreact2.checked == false){
		alert('��سҡ�͡���͡�����š������');
		document.vsform.drugreact1.focus();
		return false;																																		
	}else{
		return true;
	}
}
</script>
<?
if($_POST["act"]=="show"){
	if(!empty($_POST["p_hn"])){
		$sql="select * from  armychkup where hn='$_POST[p_hn]' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_id"])){
		$sql="select * from  armychkup where idcard='$_POST[p_id]' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_name"])){
		$sql="select * from  armychkup where ptname like '%$_POST[p_name]%' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_sname"])){
		$sql="select * from  armychkup where ptname like '%$_POST[p_sname]%' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_name"]) && !empty($_POST["p_sname"])){
		$sql="select * from  armychkup where (ptname like '%$_POST[p_name]%') || (ptname like '%$_POST[p_sname]%') and yearchkup='$nPrefix' order by row_id asc";
	}
	//echo $sql;
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	//echo $num;
	$rows=mysql_fetch_array($query);
	
		$chksql="select hn, dbirth, congenital_disease, drugreact from opcard where hn='".$rows["hn"]."'";
		//echo $chksql;
		$chkquery=mysql_query($chksql);
		$chknum=mysql_num_rows($chkquery);
		$chkrows=mysql_fetch_array($chkquery);
		if($chknum >0){
		list($yy,$mm,$dd)=explode("-",$chkrows["dbirth"]);
		$ys=$yy-543;
		$dbirth="$dd/$mm/$yy";
		$birthday="$ys-$mm-$dd";
		}
		
		$chksql1="select congenital_disease from opcard where hn='".$chkrows["hn"]."' and congenital_disease like '%HIV%'";
		//echo $chksql1;
		$chkquery1=mysql_query($chksql1);
		$num1=mysql_num_rows($chkquery1);
		if(!empty($num1)){
			$chkrows["congenital_disease"]=$chkrows["congenital_disease"]="����ʸ";
		}
		
		
			
	$camp=substr($rows["camp"],4);
	$chunyot=substr($rows["chunyot"],4);
	
	if($rows["gender"]=="1"){
		$gender="���";
	}else if($rows["gender"]=="2"){
		$gender="˭ԧ";
	}else{
		$gender="������к�";
	}

$sql1="select * from armychkup where hn='".$rows["hn"]."' and yearchkup='$nPrefix'";
//echo $sql1;
$query1=mysql_query($sql1);
$num1=mysql_num_rows($query1);
$arr_view=mysql_fetch_array($query1);
$prawat=$arr_view["prawat"];
$cigarette=$arr_view["cigarette"];
$alcohol=$arr_view["alcohol"];
$exercise=$arr_view["exercise"];
$diagtype=$arr_view["diagtype"];

?>
<form name="vsform" action="armychkupopd_out.php" method="post">
<? if($num1 < 1){ ?>
<input type="hidden" name="act" value="add">
<? }else{ ?>
<input type="hidden" name="act" value="edit">
<input name="row_id" type="hidden" value="<?=$arr_view["row_id"];?>">
<? } ?>
<table width="80%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#FFCCCC">
      <tr>
        <td colspan="3" align="center" bgcolor="#FF6699"><strong>�ѹ�֡�ŵ�Ǩ�آ�Ҿ���û�Шӻ� <?=$nPrefix;?><input name="yearchkup" type="hidden" value="<?=$nPrefix?>"></strong></td>
      </tr>
      <tr>
        <td colspan="3" align="center" bgcolor="#FFFFFF">�ѧ�Ѵ
          <select name="camp" class="forntsarabun" id="camp">
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
          </select>
          <input name="dxptright" type="hidden" value="<?=$rows["dxptright"];?>"></td>
      </tr>
      <tr>
        <td colspan="3" align="left" bgcolor="#FFCC99"><strong>���������ͧ��</strong></td>
        </tr>
      <tr>
        <td width="14%"><strong>HN</strong></td>
        <td width="2%" align="center">:</td>
        <td width="84%"><input name="hn" type="text" value="<?=$_POST["p_hn"];?>"></td>
      </tr>
      <tr>
        <td><strong>��-����-���ʡ��</strong></td>
        <td align="center">:</td>
        <td><input name="yot" type="text" value="<?=$rows["yot"];?>" size="10">
          &nbsp;&nbsp;
          <input name="ptname" type="text" value="<?=$rows["ptname"];?>"></td>
      </tr>
      <tr>
        <td><strong>�Ţ���ѵû�ЪҪ�</strong></td>
        <td align="center">:</td>
        <td><input name="chkidcard" type="text" value="<?=$rows["idcard"];?>"></td>
      </tr>
      <tr>
        <td><strong>�����</strong></td>
        <td align="center">:</td>
        <td>
          <select name="chunyot" class="forntsarabun" id="chunyot">
            <option value="<?=$chunyot;?>">
            <?=substr($chunyot,5);?>
            </option>
            <option value="CH01 ��·��ê���ѭ�Һѵ�">��·��ê���ѭ�Һѵ�</option>
            <option value="CH02 ��·��ê�鹻�зǹ">��·��ê�鹻�зǹ</option>
            <option value="CH04 �١��ҧ��Ш�">�١��ҧ��Ш�</option>
          </select></td>
      </tr>
      <tr>
        <td><strong>��</strong></td>
        <td align="center">:</td>
        <td>
          <input name="gender" type="radio" id="gender1" value="1" <? if($rows["gender"]==1){ echo "checked";}?>>
          ���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio" name="gender" id="gender2" value="2" <? if($rows["gender"]==2){ echo "checked";}?>>
          ˭ԧ</td>
      </tr>
      <tr>
        <td><strong>���˹�</strong></td>
        <td align="center">:</td>
        <td><input name="position" type="text" value="<?=$rows["position"];?>"></td>
      </tr>
      <tr>
        <td><strong>�����Ҫ��� (�����)</strong></td>
        <td align="center">:</td>
        <td><input name="ratchakarn" type="text" value="<?=$rows["ratchakarn"];?>"></td>
      </tr>
      <tr>
        <td><strong>�ѹ/��͹/�� �Դ</strong></td>
        <td align="center">:</td>
        <td>
        <? if($num1 < 1){ ?>
        <input name="birthday" type="text" >
        <? }else{ ?>
        <input name="birthday" type="text" value="<?=$birthday;?>">
        <? } ?>
        (������ҧ 2017-01-01)</td>
      </tr>
      <tr>
        <td><strong>����</strong></td>
        <td align="center">:</td>
        <td><input name="age" type="text" value="<?=$rows["age"];?>"></td>
      </tr>
      <tr>
        <td><strong>����</strong></td>
        <td align="center">:</td>
        <td style="color:#FF0000;"><input name="hospitaldrugreact" type="text" value="<?=$chkrows["drugreact"];?>"></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#FFCC99"><strong>��õ�Ǩ��ҧ���</strong></td>
        </tr>
      <tr>
        <td><strong>���˹ѡ</strong></td>
        <td align="center">:</td>
        <td><input name="txtweight" type="text" class="frmsaraban" id="txtweight" value="<?=$arr_view["weight"];?>" OnChange="fncSum();">
          &nbsp;��.</td>
      </tr>
      <tr>
        <td><strong>��ǹ�٧</strong></td>
        <td align="center">:</td>
        <td><input name="txtheight" type="text" class="frmsaraban" id="txtheight" value="<?=$arr_view["height"];?>" OnChange="fncSum();">
          &nbsp;��.</td>
      </tr>
      <tr>
        <td><strong>BMI</strong></td>
        <td align="center">:</td>
        <td>
          <input name="txtbmi" type="text" class="frmsaraban" id="txtbmi" value="<?=$arr_view["bmi"];?>"></td>
      </tr>
      <tr>
        <td><strong>����ͺ���</strong></td>
        <td align="center">:</td>
        <td><input name="txtwaist" type="text" class="frmsaraban" id="txtwaist" value="<?=$arr_view["waist"];?>">
          &nbsp;����</td>
      </tr>
      <tr>
        <td><strong>�س����� (T)</strong></td>
        <td align="center">:</td>
        <td><input name="txttemperature" type="text" class="frmsaraban" id="txttemperature" value="<?=$arr_view["temperature"];?>"> 
          &nbsp;C</td>
      </tr>
      <tr>
        <td><strong>�վ�� (P)</strong></td>
        <td align="center">:</td>
        <td><input name="txtpulse" type="text" class="frmsaraban" id="txtpulse" value="<?=$arr_view["pulse"];?>" onKeyUp="gettext( );">
&nbsp;����/�ҷ�</td>
      </tr>
      <tr>
        <td><strong>���� (R)</strong></td>
        <td align="center">:</td>
        <td><input name="txtrate" type="text" class="frmsaraban" id="txtrate" value="<? if(empty($arr_view["rate"])){ echo "20";}else{ echo $arr_view["rate"];}?>">
&nbsp;����/�ҷ�</td>
      </tr>
      <tr>
        <td><strong>�����ѹ���Ե 1</strong></td>
        <td align="center">:</td>
        <td><input name="txtbp1" type="text" class="frmsaraban" id="txtbp1" value="<?=$arr_view["bp1"];?>">
&nbsp;��. ��ͷ</td>
      </tr>
      <tr>
        <td><strong>�����ѹ���Ե 2</strong></td>
        <td align="center">:</td>
        <td><input name="txtbp2" type="text" class="frmsaraban" id="txtbp2" value="<?=$arr_view["bp2"];?>">
&nbsp;��. ��ͷ</td>
      </tr>
<script type="text/javascript">
function showHide1(obj){
txt = obj.options[obj.selectedIndex].value;  //��ҷ�����͡
var div = document.getElementById('prawat5').style;
	if(txt=='5'){
	div.visibility ='visible';
	div.display = 'block';
	}else{
	div.visibility ='hidden';
	div.display = 'none';
	}
}
</script>      
      <tr>
        <td><strong>����ѵ��ä��Шӵ��</strong></td>
        <td align="center">:</td>
        <td><select name="prawat" class="frmsaraban" id="prawat" onChange="showHide1(this)">
          <option value='<? echo $prawat;?>' >
            <? if($prawat=="0"){ echo "������ä��Шӵ��";}else if($prawat=="1"){ echo "�����ѹ���Ե�٧";}else if($prawat=="2"){ echo "����ҹ";}else if($prawat=="3"){ echo "�ä���������ʹ���ʹ";}else if($prawat=="4"){ echo "��ѹ����ʹ�٧";}else if($prawat=="5"){ echo "�ä����˹�������� 2 �ä����";}else if($prawat=="6"){ echo "�ä��Шӵ������";}else if($prawat==""){ echo "----------- ���͡ -----------";}?>
            </option>
          <option value="0">������ä��Шӵ��</option>
          <option value="1">�����ѹ���Ե�٧</option>
          <option value="2">����ҹ</option>
          <option value="3">�ä���������ʹ���ʹ</option>
          <option value="4">��ѹ����ʹ�٧</option>
          <option value="5">�ä����˹�������� 2 �ä����</option>
          <option value="6">�ä��Шӵ������</option>
        </select>
          &nbsp;
          <strong>�ä����к�</strong> :
            <input name="congenital_disease" type="text" class="frmsaraban" id="congenital_disease" value="<?=$arr_view["congenital_disease"];?>" />          </td>
      </tr>    
      <tr>
        <td colspan="3">
          <div id="prawat5" <? if($prawat != "5"){ echo "style='display: none ;'"; } ?>>
          <strong>�ä����˹�������� 2 �ä����</strong>&nbsp;&nbsp;&nbsp;
            <input name='prawat_ht' type='checkbox' class="frmsaraban" id="prawat_ht" value='1' <?php if($arr_view["prawat_ht"]==1){ echo "checked"; } ?> />
            �����ѹ���Ե�٧
            <input name='prawat_dm' type='checkbox' class="frmsaraban" id="prawat_dm" value='1' <?php if($arr_view["prawat_dm"]==1){ echo "checked"; } ?> />
            ����ҹ
  <input name='prawat_cad' type='checkbox' class="frmsaraban" id="prawat_cad" value='1' <?php if($arr_view["prawat_cad"]==1){ echo "checked"; } ?> />
            �ä���������ʹ���ʹ
  <input name='prawat_dlp' type='checkbox' class="frmsaraban" id="prawat_dlp" value='1' <?php if($arr_view["prawat_dlp"]==1){ echo "checked"; } ?> />
            ��ѹ����ʹ�٧		</div></td>
        </tr>
      <tr>
        <td><strong>����ѵԡ������</strong></td>
        <td align="center">:</td>
        <td><input name="drugreact" type="radio" class="frmsaraban" id="drugreact1" value="0" <? if($arr_view["drugreact"]=="0"){ echo "checked='checked'";}?> />
�����
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="drugreact" type="radio" class="frmsaraban" id="drugreact2" value="1" <? if($arr_view["drugreact"]=="1"){ echo "checked='checked'";}?> />
�� <font color="#FF0000"><?php echo $chkrows["drugreact"];?></font></span></td>
      </tr>
      <tr>
        <td><strong>����ٺ������</strong></td>
        <td align="center">:</td>
        <td><input name="cigarette" type="radio" class="frmsaraban" value="0" <?php if($cigarette==0){ echo "checked"; } ?> />
������ٺ&nbsp;&nbsp;&nbsp;
<input name="cigarette" type="radio" class="frmsaraban" value="1" <?php if($cigarette==1){ echo "checked"; } ?> />
���ٺ ����ԡ����
&nbsp;&nbsp;&nbsp;
<input name="cigarette" type="radio" class="frmsaraban" value="2" <?php if($cigarette==2){ echo "checked"; } ?> />
		    �ٺ������ �繤��駤���
&nbsp;&nbsp;&nbsp;
<input name="cigarette" type="radio" class="frmsaraban" value="3" <?php if($cigarette==3){ echo "checked"; } ?> />
�ٺ������ �繻�Ш�</td>
      </tr>
      <tr>
        <td><strong>��ô�������</strong></td>
        <td align="center">:</td>
        <td><input name="alcohol" type="radio" class="frmsaraban" value="0" <?php if($alcohol==0){ echo "checked"; } ?> />
����´���&nbsp;&nbsp;&nbsp;
<input name="alcohol" type="radio" class="frmsaraban" value="1" <?php if($alcohol==1){ echo "checked"; } ?> />
�´��� ����ԡ����&nbsp;&nbsp;
 &nbsp;
 <input name="alcohol" type="radio" class="frmsaraban" value="2" <?php if($alcohol==2){ echo "checked"; } ?> />
		    ���� �繤��駤���&nbsp;&nbsp;&nbsp;
 &nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <input name="alcohol" type="radio" class="frmsaraban" value="3" <?php if($alcohol==3){ echo "checked"; } ?> />
���� �繻�Ш�</td>
      </tr>
      <tr>
        <td><strong>����͡���ѧ���</strong></td>
        <td align="center">:</td>
        <td><input name="exercise" type="radio" class="frmsaraban" value="0" <?php if($exercise==0){ echo "checked"; } ?> />
		    ����͡���ѧ���&nbsp;&nbsp;&nbsp;
		    <input name="exercise" type="radio" class="frmsaraban" value="1" <?php if($exercise==1){ echo "checked"; } ?> />
		    ���¡��� 3 ���駵�� 1 �ѻ����
		    &nbsp;&nbsp;&nbsp;
            <input name="exercise" type="radio" class="frmsaraban" value="2" <?php if($exercise==2){ echo "checked"; } ?> /> 
            3 ���駵�� 1 �ѻ�������</td>
      </tr>
<?
//if($sIdname=="thaywin"){

	$sqllabdate = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$rows["hn"]."'  AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix')  Order by a.autonumber DESC limit 0,1";
	//echo $sqllabdate;
	list($lab_date) = mysql_fetch_row(mysql_query($sqllabdate));
	

	$sqlua = "Select labcode, result, unit,normalrange,flag  From resulthead as a , resultdetail as b  where a.hn='".$rows["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix' ) Order by labcode ASC ";
	//echo $sqlua;
	$result_ua = mysql_query($sqlua);

	$sqlcbc = "Select labcode, result, unit,normalrange,flag From resulthead as a , resultdetail as b  where a.hn='".$rows["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix') Order by labcode ASC";
	//echo $sqlcbc;
	$result_cbc = mysql_query($sqlcbc);
?>      
      <tr>
        <td colspan="3" bgcolor="#FFCC99"><strong>�š�õ�Ǩ�ҧ��Ҹ�</strong></td>
        </tr>
      <tr>
        <td colspan="3">
<!-- �š�õ�Ǩ�ҧ��Ҹ� -->
<TABLE width="100%" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" >
<TR>
	<TD>
	<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
	<TR>
      <TD align="right" bgcolor="#FFFFCC">&nbsp;&nbsp; <span class="style5"><strong>�� CBC :</strong></span></TD>
	  <TD align="left" bgcolor="#FFFFCC"><span class="labfont">
        <input name='cbc_lab' type='radio' value='����' <?php if($arr_view["cbc_lab"]=="����"){ echo "checked"; } ?>/>
	    ����
	    <input name='cbc_lab' type='radio' value='�Դ����' <?php if($arr_view["cbc_lab"]=="�Դ����"){ echo "checked"; } ?>/>
	    �Դ���� </span></TD>
	  </TR>
	<TR>
		<TD width="13%" align="right" bgcolor="#FFFFCC">&nbsp;&nbsp; <span class="style5"><strong>�� UA :</strong></span></TD>
	    <TD width="87%" align="left" bgcolor="#FFFFCC"><span class="labfont">
	      <input name='ua_lab' type='radio' value='����' <?php if($arr_view["ua_lab"]=="����"){ echo "checked"; } ?>/>
����
<input name='ua_lab' type='radio' value='�Դ����' <?php if($arr_view["ua_lab"]=="�Դ����"){ echo "checked"; } ?>/>
�Դ���� </span></TD>
	</TR>
	<TR class="tb_font">
		<TD colspan="2" bgcolor="#FFCCCC"><table width="100%" border="0" cellpadding="0" cellspacing="0">
</table>	  </TD>
	</TR>   
	</TABLE>	</TD>
</TR>
</TABLE>        </td>
        </tr>
      <!--����� LAB �����ҡ����������ҡѺ 35 ��-->
      <tr>
        <td colspan="3">
<table border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF"  width="100%" bgcolor="#FFCCCC">
  <tr><td>
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
	      <td colspan="3" align="left" bgcolor="#FFFFCC" class="tb_font_2"><strong>�� LAB ੾�м�����������ҡ���� 35 ��</strong></td>
	      </tr>    
	    <tr>
	      <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#33CCCC" class="text3"><strong>LAB ����Ǩ</strong></td>
	      <td align="left" bgcolor="#33CCCC" class="labfontlab"><strong>�ŵ�Ǩ</strong></td>
	      <td bgcolor="#33CCCC" class="style1">��ػ��</td>
	      </tr>
	    <tr>
	      <td width="28%" align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>GLU(����ҹ) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input type="text" name="glu_result" id="glu_result"></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='glu_lab' type='radio' value='����' <?  if($resultlab >= 74 && $resultlab <= 106){ echo "checked";}?>/>
����
  		<input name='glu_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && $resultlab < 74 || $resultlab > 106){ echo "checked";}?>/>
  		�Դ����</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>          
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>CHOL(��õ�Ǩ��ѹ) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	        <input type="text" name="chol_result" id="chol_result">
	      </label></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='chol_lab' type='radio' value='����' <? if(!empty($resultlab) && $resultlab <= 200){ echo "checked";}?> />
����
  <input name='chol_lab' type='radio' value='�Դ����' <? if($resultlab > 200){ echo "checked";}?>/>
  �Դ����</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>       
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>TRIG(��õ�Ǩ��ѹ) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	        <input type="text" name="trig_result" id="trig_result">
	      </label></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='trig_lab' type='radio' value='����' <? if(!empty($resultlab) && $resultlab <= 150){ echo "checked";}?> />
����
  <input name='trig_lab' type='radio' value='�Դ����'  <? if($resultlab > 150){ echo "checked";}?>/>
  �Դ����</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>         
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>HDL(��õ�Ǩ��ѹ��) :</strong></td>
	    <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	      <input type="text" name="hdl_result" id="hdl_result">
	    </label></td>
	    <td bgcolor="#FFFFFF" class="labfont"><input name='hdl_lab' type='radio' value='����' <? if($resultlab >= 40 && $resultlab <= 60){ echo "checked";}?>/>
	      ����
	      <input name='hdl_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && $resultlab < 40 || $resultlab > 60){ echo "checked";}?>/>
	      �Դ����</td>
	  </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>       
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>LDL(��õ�Ǩ��ѹ���) :</strong></td>
	    <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	      <input type="text" name="ldl_result" id="ldl_result">
	    </label></td>
	    <td bgcolor="#FFFFFF" class="labfont"><input name='ldl_lab' type='radio' value='����' <? if(!empty($resultlab) && $resultlab <= 100){ echo "checked";}?> />
	      ����
	      <input name='ldl_lab' type='radio' value='�Դ����' <? if($resultlab > 100){ echo "checked";}?>/>
	      �Դ����</td>
	  </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>BUN(��÷ӧҹ�ͧ�) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	        <input type="text" name="bun_result" id="bun_result">
	      </label></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='bun_lab' type='radio' value='����' <? if($resultlab >= 7 && $resultlab <= 18){ echo "checked";}?>/>
����
  <input name='bun_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && $resultlab < 7 || $resultlab > 18){ echo "checked";}?>/>
  �Դ����</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>CREA(��÷ӧҹ�ͧ�) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	        <input type="text" name="crea_result" id="crea_result">
	      </label></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='crea_lab' type='radio' value='����' <? if($resultlab >= 0.6 && $resultlab <= 1.3){ echo "checked";}?> />
����
  <input name='crea_lab' type='radio' value='�Դ����' <? if(!empty($result['cr']) && $resultlab < 0.6 || $resultlab > 1.3){ echo "checked";}?>/>
  �Դ����</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>ALP(�Ѻ,��д١) :</strong></td>
          <td width="22%" align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
            <input type="text" name="alp_result" id="alp_result">
          </label></td>
          <td width="50%" bgcolor="#FFFFFF" class="labfont"><input name='alp_lab' type='radio' value='����' <? if($resultlab >= 46 && $resultlab <= 116){ echo "checked";}?>/>
			���� 
			  <input name='alp_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && $resultlab < 46 || $resultlab > 116){ echo "checked";}?>/>
			  �Դ����</td>
            </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>            
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>ALT(��÷ӧҹ�ͧ�Ѻ) :</strong></td>
	    <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	      <input type="text" name="alt_result" id="alt_result">
	    </label></td>
	    <td bgcolor="#FFFFFF" class="labfont"><input name='alt_lab' type='radio' value='����' <? if($resultlab > 0 && $resultlab <= 50){ echo "checked";}?>/>
����
  <input name='alt_lab' type='radio' value='�Դ����' <? if($resultlab > 50){ echo "checked";}?>/>
  �Դ����</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>          
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>AST(��÷ӧҹ�ͧ�Ѻ) :</strong></td>
	    <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	      <input type="text" name="ast_result" id="ast_result">
	    </label></td>
	    <td bgcolor="#FFFFFF" class="labfont"><input name='ast_lab' type='radio' value='����' <? if($resultlab >= 15 && $resultlab <= 37){ echo "checked";}?>/>
����
  <input name='ast_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && ($resultlab < 15 || $resultlab > 37)){ echo "checked";}?>/>
  �Դ����</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>        
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>URIC(�ä��ҷ�) :</strong></td>
	    <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	      <input type="text" name="uric_result" id="uric_result">
	    </label></td>
	    <td bgcolor="#FFFFFF" class="labfont"><input name='uric_lab' type='radio' value='����' <? if($resultlab >= 2.6 && $resultlab <= 7.2){ echo "checked";}?>/>
����
  <input name='uric_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && ($resultlab < 2.6 || $resultlab > 7.2)){ echo "checked";}?>/>
  �Դ����</td>
	    </tr>
            </table>
        </TD>
	</TR>
	</TABLE>
    <br>
        </td>
        </tr>
      <!--�� �����ҡ����������ҡѺ 35 ��-->   
<? //} //�Դ�� thaywin?>
      <tr>
        <td colspan="3" bgcolor="#FFCC99"><strong>��ػ���ͧ��</strong> <? if($result['bmi'] >=35.0 && $result['bmi'] <=39.9){
			echo "��ǹ�ҡ";}else if($arr_view['bmi'] >=40.0){
			echo "�ä��ǹ";
		} ?></td>
        </tr>
      <tr>
        <td colspan="3"><input name='resultdiagnormal' type='checkbox' value='1' id="resultdiagnormal" <?php if($arr_view["resultdiag_normal"]==1){ echo "checked"; } ?>/>        
          ��辺��������§����ä NCDs</td>
        </tr>
      <tr>
        <td colspan="3"><input name='resultdiagrisk' type='checkbox' value='1' id="resultdiagrisk" <?php if($arr_view["resultdiag_risk"]==1){ echo "checked"; } ?>/>
  ����������§���ͧ�鹵���ä&nbsp;&nbsp;
&nbsp;&nbsp;
<input name='risk_dm' type='checkbox' class="frmsaraban" id="risk_dm" value='1' <?php if($arr_view["risk_dm"]==1){ echo "checked"; } ?> />
DM(����ҹ)
<input name='risk_ht' type='checkbox' class="frmsaraban" id="risk_ht" value='1' <?php if($arr_view["risk_ht"]==1){ echo "checked"; } ?> />
HT(�����ѹ���Ե�٧)
<input name='risk_dlp' type='checkbox' class="frmsaraban" id="risk_dlp" value='1' <?php if($arr_view["risk_dlp"]==1){ echo "checked"; } ?> />
DLP(��ѹ����ʹ�٧)
<input name='risk_storke' type='checkbox' class="frmsaraban" id="risk_storke" value='1' <?php if($arr_view["risk_storke"]==1){ echo "checked"; } ?> />
Stroke

<input name='risk_obesity' type='checkbox' class="frmsaraban" id="risk_obesity" value='1' <?php if($arr_view["risk_obesity"]==1){ echo "checked"; } ?> />
Obesity</td>
        </tr>
      <tr>
        <td colspan="3"><input name='resultdiagdiseases' type='checkbox' value='1' id="resultdiagdiseases" <?php if($arr_view["resultdiag_diseases"]==1){ echo "checked"; } ?>/>
  ���´����ä������ѧ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;
          <input name='diseases_dm' type='checkbox' class="frmsaraban" id="diseases_dm" value='1' <?php if($arr_view["diseases_dm"]==1){ echo "checked"; } ?> />
          DM(����ҹ)
          <input name='diseases_ht' type='checkbox' class="frmsaraban" id="diseases_ht" value='1' <?php if($arr_view["diseases_ht"]==1){ echo "checked"; } ?> />
          HT(�����ѹ���Ե�٧)
          <input name='diseases_dlp' type='checkbox' class="frmsaraban" id="diseases_dlp" value='1' <?php if($arr_view["diseases_dlp"]==1){ echo "checked"; } ?> />
          DLP(��ѹ����ʹ�٧)
          <input name='diseases_stroke' type='checkbox' class="frmsaraban" id="diseases_stroke" value='1' <?php if($arr_view["diseases_stroke"]==1){ echo "checked"; } ?> />
          Stroke
          <input name='diseases_obesity' type='checkbox' class="frmsaraban" id="diseases_obesity" value='1' <?php if($arr_view["diseases_obesity"]==1){ echo "checked"; } ?> />
Obesity</td>
        </tr>
      <tr height="50">
        <td height="52" colspan="3" align="center" bgcolor="#FF6699">
<? if($num1 < 1){ ?>
<input name="Submit" type="submit" class="frmsaraban" value="�ѹ�֡������" onClick="return checkfrm()" />
<? }else{ ?>
<input name="Submit" type="submit" class="frmsaraban" value="��䢢�����" onClick="return checkfrm()" />
<? } ?>        </td>
        </tr>
      
    </table></td>
  </tr>
</table>
</form>
<? } ?>
<?
if($_POST["act"]=="add"){
$datekey=date("Y-m-d H:i:s");
$officer=$_SESSION["sOfficer"];
if($_POST["hospital"]==""){
$_POST["hospital"]=$_POST["hospital_other"];
}
	$add="insert into armychkup set registerdate='$datekey',
													 hn='$_POST[hn]',
													 yot='$_POST[yot]',
													 ptname='$_POST[ptname]',
													 idcard='$_POST[chkidcard]',
													 camp='$_POST[camp]',
													 position='$_POST[position]',
													 ratchakarn='$_POST[ratchakarn]',
													 chunyot='$_POST[chunyot]',
													 gender='$_POST[gender]',
													 birthday='$_POST[birthday]',
													 age='$_POST[age]',
													 dxptright='$_POST[dxptright]',
													 hospitalcongenital_disease='$_POST[hospitalcongenital_disease]',
													 hospitaldrugreact='$_POST[hospitaldrugreact]',
													 weight='$_POST[txtweight]',
													 height='$_POST[txtheight]',
													 bmi='$_POST[txtbmi]',
													 waist='$_POST[txtwaist]',
													 temperature='$_POST[txttemperature]',
													 pulse='$_POST[txtpulse]',
													 rate='$_POST[txtrate]',
													 bp1='$_POST[txtbp1]',
													 bp2='$_POST[txtbp2]',
													 prawat='$_POST[prawat]',
													 prawat_ht='$_POST[prawat_ht]',
													 prawat_dm='$_POST[prawat_dm]',
													 prawat_cad='$_POST[prawat_cad]',
													 prawat_dlp='$_POST[prawat_dlp]',
													 congenital_disease='$_POST[congenital_disease]',
													 hospital='$_POST[hospital]',
													 diagtype='$_POST[diagtype]',
													 drugreact='$_POST[drugreact]',
													 cigarette='$_POST[cigarette]',
													 alcohol='$_POST[alcohol]',
													 exercise='$_POST[exercise]',
													 bmr='$_POST[txtbmr]',
													 tbw='$_POST[txttbw]',
													 fat='$_POST[txtfat]',
													 fat_mass='$_POST[txtfatmass]',
													 visceral_fat='$_POST[txtvisceralfat]',
													 muscle_mass='$_POST[txtmusclemass]',
													 vfa_level='$_POST[txtvfalevel]',
													 result_fat='$_POST[resultfat]',
													 hand1='$_POST[txthand1]',
													 hand2='$_POST[txthand2]',
													 result_hand='$_POST[resulthand]',
													 leg1='$_POST[txtleg1]',
													 leg2='$_POST[txtleg2]',
													 result_leg='$_POST[resultleg]',	
													 steptest1='$_POST[txtsteptest1]',
													 steptest2='$_POST[txtsteptest2]',
													 steptest3='$_POST[txtsteptest3]',
													 result_steptest='$_POST[resultsteptest]',
													 
													 pressure_test='$_POST[txtpressure]',
													 pressure_result='$_POST[pressure_result]',
													 situp_test='$_POST[txtsitup]',
													 situp_result='$_POST[situp_result]',
													 run_test='$_POST[txtrun]',
													 run_result='$_POST[run_result]',
													 
													 xray='$_POST[xray]',
													 xray_detail='$_POST[xraydetail]',														 												 													 result_dental='$_POST[resultdental]',
													 dental_disease1='$_POST[dental_disease1]',
													 dental_disease2='$_POST[dental_disease2]',
													 dental_disease3='$_POST[dental_disease3]',	
													 gum_disease1='$_POST[gum_disease1]',
													 gum_disease2='$_POST[gum_disease2]',
													 ua_lab='$_POST[ua_lab]',
													 cbc_lab='$_POST[cbc_lab]',
													 glu_result='$_POST[glu_result]',
													 glu_flag='$_POST[glu_flag]',
													 glu_lab='$_POST[glu_lab]',
													 chol_result='$_POST[chol_result]',
													 chol_flag='$_POST[chol_flag]',
													 chol_lab='$_POST[chol_lab]',
													 trig_result='$_POST[trig_result]',
													 trig_flag='$_POST[trig_flag]',
													 trig_lab='$_POST[trig_lab]',
													 hdl_result='$_POST[hdl_result]',
													 hdl_flag='$_POST[hdl_flag]',
													 hdl_lab='$_POST[hdl_lab]',
													 ldl_result='$_POST[ldl_result]',
													 ldl_flag='$_POST[ldl_flag]',
													 ldl_lab='$_POST[ldl_lab]',
													 bun_result='$_POST[bun_result]',
													 bun_flag='$_POST[bun_flag]',
													 bun_lab='$_POST[bun_lab]',
													 crea_result='$_POST[crea_result]',
													 crea_flag='$_POST[crea_flag]',
													 crea_lab='$_POST[crea_lab]',
													 alp_result='$_POST[alp_result]',
													 alp_flag='$_POST[alp_flag]',
													 alp_lab='$_POST[alp_lab]',
													 alt_result='$_POST[alt_result]',
													 alt_flag='$_POST[alt_flag]',
													 alt_lab='$_POST[alt_lab]',
													 ast_result='$_POST[ast_result]',
													 ast_flag='$_POST[ast_flag]',
													 ast_lab='$_POST[ast_lab]',
													 uric_result='$_POST[uric_result]',
													 uric_flag='$_POST[uric_flag]',
													 uric_lab='$_POST[uric_lab]',
													 health_risk='$_POST[health_risk]',
													 accident_risk='$_POST[accident_risk]',
													 addictive_risk='$_POST[addictive_risk]',
													 score_stress='$_POST[score_stress]',
													 result_stress='$_POST[result_stress]',											 
													 diabetes_risk='$_POST[diabetes_risk]',
													 kidney_risk='$_POST[kidney_risk]',
													 tb_risk='$_POST[tb_risk]',
													 heart_risk='$_POST[heart_risk]',
													 cancer_risk='$_POST[cancer_risk]',
													 hiv_risk='$_POST[hiv_risk]',
													 liver_risk='$_POST[liver_risk]',
													 stroke_risk='$_POST[stroke_risk]',
													 gout_risk='$_POST[gout_risk]',
													 knee_risk='$_POST[knee_risk]',
													 bone_risk='$_POST[bone_risk]',														 													
													 resultdiag_normal='$_POST[resultdiagnormal]',
													 resultdiag_risk='$_POST[resultdiagrisk]',
													 risk_dm='$_POST[risk_dm]',
													 risk_ht='$_POST[risk_ht]',
													 risk_dlp='$_POST[risk_dlp]',
													 risk_stroke='$_POST[risk_stroke]',
													 risk_obesity='$_POST[risk_obesity]',
													 resultdiag_diseases='$_POST[resultdiagdiseases]',
													 diseases_dm='$_POST[diseases_dm]',
													 diseases_ht='$_POST[diseases_ht]',
													 diseases_dlp='$_POST[diseases_dlp]',
													 diseases_stroke='$_POST[diseases_stroke]',
													 diseases_obesity='$_POST[diseases_obesity]',
													 register_officer='$officer',
													 yearchkup='$_POST[yearchkup]',
													 typechkup='out'";
													//echo $add;
	if(mysql_query($add)){
		echo "<script>alert('�ѹ�֡���������º����');window.location='armychkupopd_out.php';</script>";
	}else{
		echo "<script>alert('�Դ��Ҵ �ѹ�֡��������������');window.location='armychkupopd_out.php';</script>";
	}													 
}

if($_POST["act"]=="edit"){
$lastupdate=date("Y-m-d H:i:s");
$officer=$_SESSION["sOfficer"];
if($_POST["hospital"]==""){
$_POST["hospital"]=$_POST["hospital_other"];
}
	$edit="update armychkup set yot='$_POST[yot]',
													 ptname='$_POST[ptname]',
													 idcard='$_POST[chkidcard]',
													 camp='$_POST[camp]',
													 position='$_POST[position]',
													 ratchakarn='$_POST[ratchakarn]',
													 chunyot='$_POST[chunyot]',
													 gender='$_POST[gender]',
													 birthday='$_POST[birthday]',
													 age='$_POST[age]',
													 dxptright='$_POST[dxptright]',
													hospitalcongenital_disease='$_POST[hospitalcongenital_disease]',
													 hospitaldrugreact='$_POST[hospitaldrugreact]',
													 weight='$_POST[txtweight]',
													 height='$_POST[txtheight]',
													 bmi='$_POST[txtbmi]',
													 waist='$_POST[txtwaist]',
													 temperature='$_POST[txttemperature]',
													 pulse='$_POST[txtpulse]',
													 rate='$_POST[txtrate]',
													 bp1='$_POST[txtbp1]',
													 bp2='$_POST[txtbp2]',
													 prawat='$_POST[prawat]',
													 prawat_ht='$_POST[prawat_ht]',
													 prawat_dm='$_POST[prawat_dm]',
													 prawat_cad='$_POST[prawat_cad]',
													 prawat_dlp='$_POST[prawat_dlp]',													 
													 congenital_disease='$_POST[congenital_disease]',
													 hospital='$_POST[hospital]',
													 diagtype='$_POST[diagtype]',
													 drugreact='$_POST[drugreact]',
													 cigarette='$_POST[cigarette]',
													 alcohol='$_POST[alcohol]',
													 exercise='$_POST[exercise]',
													 bmr='$_POST[txtbmr]',
													 tbw='$_POST[txttbw]',
													 fat='$_POST[txtfat]',
													 fat_mass='$_POST[txtfatmass]',
													 visceral_fat='$_POST[txtvisceralfat]',
													 muscle_mass='$_POST[txtmusclemass]',
													 vfa_level='$_POST[txtvfalevel]',
													 result_fat='$_POST[resultfat]',
													 hand1='$_POST[txthand1]',
													 hand2='$_POST[txthand2]',
													 result_hand='$_POST[resulthand]',
													 leg1='$_POST[txtleg1]',
													 leg2='$_POST[txtleg2]',
													 result_leg='$_POST[resultleg]',	
													 steptest1='$_POST[txtsteptest1]',
													 steptest2='$_POST[txtsteptest2]',
													 steptest3='$_POST[txtsteptest3]',
													 result_steptest='$_POST[resultsteptest]',
													 
													 pressure_test='$_POST[txtpressure]',
													 pressure_result='$_POST[pressure_result]',
													 situp_test='$_POST[txtsitup]',
													 situp_result='$_POST[situp_result]',
													 run_test='$_POST[txtrun]',
													 run_result='$_POST[run_result]',													 
													 
													 xray='$_POST[xray]',
													 xray_detail='$_POST[xraydetail]',
													 result_dental='$_POST[resultdental]',																				
													 dental_disease1='$_POST[dental_disease1]',
													 dental_disease2='$_POST[dental_disease2]',
													 dental_disease3='$_POST[dental_disease3]',	
													 gum_disease1='$_POST[gum_disease1]',
													 gum_disease2='$_POST[gum_disease2]',
													 ua_lab='$_POST[ua_lab]',
													 cbc_lab='$_POST[cbc_lab]',
													 glu_result='$_POST[glu_result]',
													 glu_flag='$_POST[glu_flag]',
													 glu_lab='$_POST[glu_lab]',
													 chol_result='$_POST[chol_result]',
													 chol_flag='$_POST[chol_flag]',
													 chol_lab='$_POST[chol_lab]',
													 trig_result='$_POST[trig_result]',
													 trig_flag='$_POST[trig_flag]',
													 trig_lab='$_POST[trig_lab]',
													 hdl_result='$_POST[hdl_result]',
													 hdl_flag='$_POST[hdl_flag]',
													 hdl_lab='$_POST[hdl_lab]',
													 ldl_result='$_POST[ldl_result]',
													 ldl_flag='$_POST[ldl_flag]',
													 ldl_lab='$_POST[ldl_lab]',
													 bun_result='$_POST[bun_result]',
													 bun_flag='$_POST[bun_flag]',
													 bun_lab='$_POST[bun_lab]',
													 crea_result='$_POST[crea_result]',
													 crea_flag='$_POST[crea_flag]',
													 crea_lab='$_POST[crea_lab]',
													 alp_result='$_POST[alp_result]',
													 alp_flag='$_POST[alp_flag]',
													 alp_lab='$_POST[alp_lab]',
													 alt_result='$_POST[alt_result]',
													 alt_flag='$_POST[alt_flag]',
													 alt_lab='$_POST[alt_lab]',
													 ast_result='$_POST[ast_result]',
													 ast_flag='$_POST[ast_flag]',
													 ast_lab='$_POST[ast_lab]',
													 uric_result='$_POST[uric_result]',
													 uric_flag='$_POST[uric_flag]',
													 uric_lab='$_POST[uric_lab]',
													 health_risk='$_POST[health_risk]',
													 accident_risk='$_POST[accident_risk]',
													 addictive_risk='$_POST[addictive_risk]',
													 score_stress='$_POST[score_stress]',
													 result_stress='$_POST[result_stress]',	
													 diabetes_risk='$_POST[diabetes_risk]',
													 kidney_risk='$_POST[kidney_risk]',
													 tb_risk='$_POST[tb_risk]',
													 heart_risk='$_POST[heart_risk]',
													 cancer_risk='$_POST[cancer_risk]',
													 hiv_risk='$_POST[hiv_risk]',
													 liver_risk='$_POST[liver_risk]',
													 stroke_risk='$_POST[stroke_risk]',
													 gout_risk='$_POST[gout_risk]',
													 knee_risk='$_POST[knee_risk]',
													 bone_risk='$_POST[bone_risk]',															 												 
													 resultdiag_normal='$_POST[resultdiagnormal]',
													 resultdiag_risk='$_POST[resultdiagrisk]',
													 risk_dm='$_POST[risk_dm]',
													 risk_ht='$_POST[risk_ht]',
													 risk_dlp='$_POST[risk_dlp]',
													 risk_stroke='$_POST[risk_stroke]',
													 risk_obesity='$_POST[risk_obesity]',
													 resultdiag_diseases='$_POST[resultdiagdiseases]',
													 diseases_dm='$_POST[diseases_dm]',
													 diseases_ht='$_POST[diseases_ht]',
													 diseases_dlp='$_POST[diseases_dlp]',
													 diseases_stroke='$_POST[diseases_stroke]',
													 diseases_obesity='$_POST[diseases_obesity]',
													 lastupdate='$lastupdate',
													 lastupdate_officer='$officer',
													 typechkup='out' where row_id='$_POST[row_id]'";
													 //echo $edit;
	if(mysql_query($edit)){
		echo "<script>alert('��䢢��������º����');window.location='armychkupopd_out.php';</script>";
	}else{
		echo "<script>alert('�Դ��Ҵ ��䢢�������������');window.location='armychkupopd_out.php';</script>";
	}													 
}
?>