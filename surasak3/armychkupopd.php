<?
session_start();
if (isset($sIdname)){} else {die;} //for security
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
.style1 {font-weight: bold}
-->
#showMe{
    display:none;
}
.style2 {
	color: #FF0000;
	font-weight: bold;
}
</style>
<title>�ѹ�֡�ŵ�Ǩ�آ�Ҿ���û�Шӻ�</title><a href ="../nindex.htm" >&lt;&lt; �����</a>
<form action="armychkupopd.php" method="post">
<input name="act" type="hidden" value="show" />
<div align="center"><strong>�ѹ�֡�ŵ�Ǩ�آ�Ҿ���û�Шӻ� <?=$nPrefix;?></strong></div>
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
<input name="post_vn" type="hidden" value="1" />
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
		$sql="select * from  chkup_solider where hn='$_POST[p_hn]' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_id"])){
		$sql="select * from  chkup_solider where idcard='$_POST[p_id]' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_name"])){
		$sql="select * from  chkup_solider where ptname like '%$_POST[p_name]%' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_sname"])){
		$sql="select * from  chkup_solider where ptname like '%$_POST[p_sname]%' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_name"]) && !empty($_POST["p_sname"])){
		$sql="select * from  chkup_solider where (ptname like '%$_POST[p_name]%') || (ptname like '%$_POST[p_sname]%') and yearchkup='$nPrefix' order by row_id asc";
	}
	//echo $sql;
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	//echo $num;
	if($num<1){
		echo "<script>alert('!!!��辺������ ���ŧ����¹��Ǩ�آ�Ҿ���û�Шӻ� $nPrefix');window.location='armychkupopd.php';</script>";
	}	
	$rows=mysql_fetch_array($query);
	
		$chksql="select hn, dbirth, congenital_disease, drugreact from opcard where hn='".$rows["hn"]."'";
		//echo $chksql;
		$chkquery=mysql_query($chksql);
		$chkrows=mysql_fetch_array($chkquery);
		list($yy,$mm,$dd)=explode("-",$chkrows["dbirth"]);
		$ys=$yy-543;
		$dbirth="$dd/$mm/$yy";
		$birthday="$ys-$mm-$dd";
		
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
<form name="vsform" action="armychkupopd.php" method="post">
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
        <td colspan="4" align="center" bgcolor="#FF6699"><strong>�ѹ�֡�ŵ�Ǩ�آ�Ҿ���û�Шӻ� <?=$nPrefix;?><input name="yearchkup" type="hidden" value="<?=$nPrefix?>"></strong></td>
      </tr>
      <tr>
        <td colspan="4" align="center" bgcolor="#FFFFFF">�ѧ�Ѵ          <?=$camp;?><input name="chkidcard" type="hidden" value="<?=$rows["idcard"];?>"><input name="camp" type="hidden" value="<?=$rows["camp"];?>"><input name="dxptright" type="hidden" value="<?=$rows["dxptright"];?>"></td>
      </tr>
      <tr>
        <td colspan="4" align="left" bgcolor="#FFCC99"><strong>���������ͧ��</strong></td>
        </tr>
      <tr>
        <td width="14%"><strong>HN</strong></td>
        <td width="2%" align="center">:</td>
        <td colspan="2"><?=$rows["hn"];?><input name="hn" type="hidden" value="<?=$rows["hn"];?>"></td>
      </tr>
      <tr>
        <td><strong>���� - ���ʡ��</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$rows["yot"]." ".$rows["ptname"];?><input name="yot" type="hidden" value="<?=$rows["yot"];?>"><input name="ptname" type="hidden" value="<?=$rows["ptname"];?>"></td>
      </tr>
      <tr>
        <td><strong>�����</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$chunyot;?><input name="chunyot" type="hidden" value="<?=$rows["chunyot"];?>"></td>
      </tr>
      <tr>
        <td><strong>��</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$gender;?><input name="gender" type="hidden" value="<?=$rows["gender"];?>"></td>
      </tr>
      <tr>
        <td><strong>���˹�</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$rows["position"];?><input name="position" type="hidden" value="<?=$rows["position"];?>"></td>
      </tr>
      <tr>
        <td><strong>�����Ҫ��� (�����)</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$rows["ratchakarn"];?><input name="ratchakarn" type="hidden" value="<?=$rows["ratchakarn"];?>"></td>
      </tr>
      <tr>
        <td><strong>�ѹ/��͹/�� �Դ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$dbirth;?><input name="birthday" type="hidden" value="<?=$birthday;?>"></td>
      </tr>
      <tr>
        <td><strong>����</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$rows["age"];?><input name="age" type="hidden" value="<?=$rows["age"];?>"><input name="hospitalcongenital_disease" type="hidden" value="<?=$chkrows["congenital_disease"];?>"></td>
      </tr>
      <tr>
        <td><strong>����</strong></td>
        <td align="center">:</td>
        <td colspan="2" style="color:#FF0000;"><?=$chkrows["drugreact"];?><input name="hospitaldrugreact" type="hidden" value="<?=$chkrows["drugreact"];?>"></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>��õ�Ǩ��ҧ���</strong></td>
        </tr>
      <tr>
        <td><strong>���˹ѡ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtweight" type="text" class="frmsaraban" id="txtweight" value="<?=$arr_view["weight"];?>" OnChange="fncSum();">
          &nbsp;��.</td>
      </tr>
      <tr>
        <td><strong>��ǹ�٧</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtheight" type="text" class="frmsaraban" id="txtheight" value="<?=$arr_view["height"];?>" OnChange="fncSum();">
          &nbsp;��.</td>
      </tr>
      <tr>
        <td><strong>BMI</strong></td>
        <td align="center">:</td>
        <td colspan="2">
          <input name="txtbmi" type="text" class="frmsaraban" id="txtbmi" value="<?=$arr_view["bmi"];?>"></td>
      </tr>
      <tr>
        <td><strong>����ͺ���</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtwaist" type="text" class="frmsaraban" id="txtwaist" value="<?=$arr_view["waist"];?>">
          &nbsp;����</td>
      </tr>
      <tr>
        <td><strong>�س����� (T)</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txttemperature" type="text" class="frmsaraban" id="txttemperature" value="<?=$arr_view["temperature"];?>"> 
          &nbsp;C</td>
      </tr>
      <tr>
        <td><strong>�վ�� (P)</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtpulse" type="text" class="frmsaraban" id="txtpulse" value="<?=$arr_view["pulse"];?>" onKeyUp="gettext( );">
&nbsp;����/�ҷ�</td>
      </tr>
      <tr>
        <td><strong>���� (R)</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtrate" type="text" class="frmsaraban" id="txtrate" value="<? if(empty($arr_view["rate"])){ echo "20";}else{ echo $arr_view["rate"];}?>">
&nbsp;����/�ҷ�</td>
      </tr>
      <tr>
        <td><strong>�����ѹ���Ե 1</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtbp1" type="text" class="frmsaraban" id="txtbp1" value="<?=$arr_view["bp1"];?>">
&nbsp;��. ��ͷ</td>
      </tr>
      <tr>
        <td><strong>�����ѹ���Ե 2</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtbp2" type="text" class="frmsaraban" id="txtbp2" value="<?=$arr_view["bp2"];?>">
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
        <td colspan="2"><select name="prawat" class="frmsaraban" id="prawat" onchange="showHide1(this)">
          <option value='<? echo $prawat;?>' >
            <? if($prawat=="0"){ echo "������ä��Шӵ��";}else if($prawat=="1"){ echo "�����ѹ���Ե�٧";}else if($prawat=="2"){ echo "����ҹ";}else if($prawat=="3"){ echo "�ä���������ʹ���ʹ";}else if($prawat=="4"){ echo "��ѹ����ʹ�٧";}else if($prawat=="5"){ echo "�ä����˹�������� 2 �ä����";}else if($prawat=="6"){ echo "�ä��Шӵ������";}else if($prawat=="7"){ echo "�ä��ҷ�";}else if($prawat=="8"){ echo "�ä�ا���觾ͧ";}else if($prawat==""){ echo "----------- ���͡ -----------";}?>
            </option>
          <option value="0">������ä��Шӵ��</option>
          <option value="1">�����ѹ���Ե�٧</option>
          <option value="2">����ҹ</option>
          <option value="3">�ä���������ʹ���ʹ</option>
          <option value="4">��ѹ����ʹ�٧</option>
          <option value="5">�ä����˹�������� 2 �ä����</option>
          <option value="6">�ä��Шӵ������</option>
          <option value="7">�ä��ҷ�</option>
          <option value="8">�ä�ا���觾ͧ</option>
        </select>
          &nbsp;
          <strong>�ä����к�</strong> :
            <input name="congenital_disease" type="text" class="frmsaraban" id="congenital_disease" value="<?=$arr_view["congenital_disease"];?>" />          </td>
      </tr>    
      <tr>
        <td colspan="4">
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
        <td colspan="4" bgcolor="#FFCC99"><strong>�ó��繼������ä�����ѹ���Ե�٧, ����ҹ, ��ѹ����ʹ�٧ ����к��ç��Һ�ŷ���ѡ��</strong></td>
        </tr>
      <tr>
        <td><strong>�Ѻ����ѡ�ҷ��</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="hospital" id="hospital1" type="checkbox" class="frmsaraban" <?php if($arr_view["hospital"]=="�ç��Һ�Ť�������ѡ��������"){ echo "checked"; } ?> value="�ç��Һ�Ť�������ѡ��������" />
          �ç��Һ�Ť�������ѡ��������
        <input name="hospital" id="hospital2" type="checkbox" class="frmsaraban" <?php if($arr_view["hospital"]=="�ç��Һ���ӻҧ"){ echo "checked"; } ?> value="�ç��Һ���ӻҧ" />
        �ç��Һ���ӻҧ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        <strong>�ç��Һ������ �к</strong>�
        <input name="hospital_other" type="text" class="frmsaraban" id="hospital_other" value="<?php if(($arr_view["hospital"]!="�ç��Һ�Ť�������ѡ��������") && ($arr_view["hospital"]!="�ç��Һ���ӻҧ")){ echo $arr_view["hospital"]; } ?>"></td>
      </tr>
      <tr>
        <td><strong>��ػ</strong></td>
        <td align="center">&nbsp;</td>
        <td colspan="2"><input name="diagtype" id="diagtype1" type="checkbox" class="frmsaraban" value="control" <?php if($diagtype=="control"){ echo "checked"; } ?> /> 
          Control
&nbsp;&nbsp;&nbsp;
<input name="diagtype" id="diagtype2" type="checkbox" class="frmsaraban" value="uncontrol" <?php if($diagtype=="uncontrol"){ echo "checked"; } ?> />
Un Control
		    &nbsp;&nbsp;&nbsp;
            <input name="diagtype" id="diagtype3" type="checkbox" class="frmsaraban" value="newcase" <?php if($diagtype=="newcase"){ echo "checked"; } ?> /> 
            New Case</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFCC">&nbsp;</td>
        <td align="center" bgcolor="#FFFFCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFFFCC">*** <strong>Control</strong> ��� �ջ���ѵԻ������ä������ѧ (HT, DM, DLP) �ѡ�ҵ������ ��мš���ѡ��������дѺ���Ǻ������ (����)</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFCC">&nbsp;</td>
        <td align="center" bgcolor="#FFFFCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFFFCC">*** <strong>Un Control</strong> ��� �ջ���ѵԻ������ä������ѧ (HT, DM, DLP) �ѡ�ҵ������ ��š���ѡ�ҤǺ�������� (�Դ����)</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFCC">&nbsp;</td>
        <td align="center" bgcolor="#FFFFCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFFFCC">*** <strong>New Case</strong> ��� ����ջ���ѵԻ������ä������ѧ (HT, DM, DLP) ��͡��һ��� ��м��͡�ҼԴ����</td>
      </tr>
      <tr>
        <td><strong>����ѵԡ������</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="drugreact" type="radio" class="frmsaraban" id="drugreact1" value="0" <? if($arr_view["drugreact"]=="0"){ echo "checked='checked'";}?> />
�����
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="drugreact" type="radio" class="frmsaraban" id="drugreact2" value="1" <? if($arr_view["drugreact"]=="1"){ echo "checked='checked'";}?> />
�� <font color="#FF0000"><?php echo $chkrows["drugreact"];?></font></span></td>
      </tr>
      <tr>
        <td><strong>����ٺ������</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="cigarette" type="radio" class="frmsaraban" value="0" <?php if($cigarette==0){ echo "checked"; } ?> />
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
        <td colspan="2"><input name="alcohol" type="radio" class="frmsaraban" value="0" <?php if($alcohol==0){ echo "checked"; } ?> />
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
        <td colspan="2"><input name="exercise" type="radio" class="frmsaraban" value="0" <?php if($exercise==0){ echo "checked"; } ?> />
		    ����͡���ѧ���&nbsp;&nbsp;&nbsp;
		    <input name="exercise" type="radio" class="frmsaraban" value="1" <?php if($exercise==1){ echo "checked"; } ?> />
		    ���¡��� 3 ���駵�� 1 �ѻ����
		    &nbsp;&nbsp;&nbsp;
            <input name="exercise" type="radio" class="frmsaraban" value="2" <?php if($exercise==2){ echo "checked"; } ?> /> 
            3 ���駵�� 1 �ѻ�������</td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>��ҡ���Ѵ % ����˹ѧ</strong></td>
        </tr>
      <tr>
        <td><strong>BMI</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtbmi1" type="text" class="frmsaraban" id="txtbmi1" value="<?=$arr_view["bmi"];?>"></td>
      </tr>
      <tr>
        <td><strong>BMR</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtbmr" type="text" class="frmsaraban" id="txtbmr" value="<?=$arr_view["bmr"];?>"></td>
      </tr>
      <tr>
        <td><strong>%TBW</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txttbw" type="text" class="frmsaraban" id="txttbw" value="<?=$arr_view["tbw"];?>"></td>
      </tr>
      <tr>
        <td><strong>%FAT</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtfat" type="text" class="frmsaraban" id="txtfat" value="<?=$arr_view["fat"];?>"></td>
      </tr>
      <tr>
        <td><strong>Fat Mass</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtfatmass" type="text" class="frmsaraban" id="txtfatmass" value="<?=$arr_view["fat_mass"];?>">
          &nbsp;kg.</td>
      </tr>
      
      <tr>
        <td><strong>Visceral Fat</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtvisceralfat" type="text" class="frmsaraban" id="txtvisceralfat" value="<?=$arr_view["visceral_fat"];?>"></td>
      </tr>
      <tr>
        <td><strong>Muscle Mass</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtmusclemass" type="text" class="frmsaraban" id="txtmusclemass" value="<?=$arr_view["muscle_mass"];?>"></td>
      </tr>
      <tr>
        <td><strong>VFA level</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtvfalevel" type="text" class="frmsaraban" id="txtvfalevel" value="<?=$arr_view["vfa_level"];?>"></td>
      </tr>
      <tr>
        <td><strong>�š�÷��ͺ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="resultfat" type="radio" class="frmsaraban" value="1" <?php if($arr_view["result_fat"]==1){ echo "checked"; } ?> />
          ���          &nbsp;&nbsp;
 &nbsp;
            <input name="resultfat" type="radio" class="frmsaraban" value="2" <?php if($arr_view["result_fat"]==2){ echo "checked"; } ?> />
          ��͹��ҧ���          &nbsp;&nbsp;
 &nbsp;
 <input name="resultfat" type="radio" class="frmsaraban" value="3" <?php if($arr_view["result_fat"]==3){ echo "checked"; } ?> />
 ����ǹ          &nbsp;&nbsp;
 &nbsp;
 <input name="resultfat" type="radio" class="frmsaraban" value="4" <?php if($arr_view["result_fat"]==4){ echo "checked"; } ?> />
 ��͹��ҧ��ǹ          &nbsp;&nbsp;
 &nbsp;
 <input name="resultfat" type="radio" class="frmsaraban" value="5" <?php if($arr_view["result_fat"]==5){ echo "checked"; } ?> /> 
 ��ǹ</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>��÷��ͺ�������ç�ͧ��������ʹ����Ѵ�ç�պ���</strong></td>
        </tr>
      
      <tr>
        <td><strong>�š�÷��ͺ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txthand1" type="text" class="frmsaraban" id="txthand1" value="<?=$arr_view["hand1"];?>"></td>
      </tr>
      <tr>
        <td><strong>�š�÷��ͺ/���˹ѡ���</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txthand2" type="text" class="frmsaraban" id="txthand2" value="<?=$arr_view["hand2"];?>"></td>
      </tr>
      <tr>
        <td><strong>�дѺ���ö�Ҿ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="resulthand" type="radio" class="frmsaraban" value="5" <?php if($arr_view["result_hand"]==5){ echo "checked"; } ?> />
        ���ҡ
        &nbsp;&nbsp;
          &nbsp;
          <input name="resulthand" type="radio" class="frmsaraban" value="4" <?php if($arr_view["result_hand"]==4){ echo "checked"; } ?> />
          ��          &nbsp;&nbsp;
          &nbsp;
          <input name="resulthand" type="radio" class="frmsaraban" value="3" <?php if($arr_view["result_hand"]==3){ echo "checked"; } ?> />
          ����          &nbsp;&nbsp;
          &nbsp;
          <input name="resulthand" type="radio" class="frmsaraban" value="2" <?php if($arr_view["result_hand"]==2){ echo "checked"; } ?> />
          ��͹��ҧ���          &nbsp;&nbsp;
          &nbsp;
          <input name="resulthand" type="radio" class="frmsaraban" value="1" <?php if($arr_view["result_hand"]==1){ echo "checked"; } ?> />
          ��� </td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>��÷��ͺ�������ç�ͧ��������ʹ����ç����´��</strong></td>
        </tr>
      <tr>
        <td><strong>�š�÷��ͺ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtleg1" type="text" class="frmsaraban" id="txtleg" value="<?=$arr_view["leg1"];?>"></td>
      </tr>
      <tr>
        <td><strong>�š�÷��ͺ/���˹ѡ���</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtleg2" type="text" class="frmsaraban" id="txtleg2" value="<?=$arr_view["leg2"];?>"></td>
      </tr>
      <tr>
        <td><strong>�дѺ���ö�Ҿ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="resultleg" type="radio" class="frmsaraban" value="5" <?php if($arr_view["result_leg"]==5){ echo "checked"; } ?> />
          ���ҡ
          &nbsp;&nbsp;
          &nbsp;
              <input name="resultleg" type="radio" class="frmsaraban" value="4" <?php if($arr_view["result_leg"]==4){ echo "checked"; } ?> />
          ��          &nbsp;&nbsp;
          &nbsp;
              <input name="resultleg" type="radio" class="frmsaraban" value="3" <?php if($arr_view["result_leg"]==3){ echo "checked"; } ?> />
          ����          &nbsp;&nbsp;
          &nbsp;
              <input name="resultleg" type="radio" class="frmsaraban" value="2" <?php if($arr_view["result_leg"]==2){ echo "checked"; } ?> />
          ��͹��ҧ���          &nbsp;&nbsp;
          &nbsp;
              <input name="resultleg" type="radio" class="frmsaraban" value="1" <?php if($arr_view["result_leg"]==1){ echo "checked"; } ?> />
          ��� </td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>��÷��ͺ�������ç�ͧ�к��ҧ�Թ��������к�������¹���Ե���¡�÷��ͺ���Ǣ�� - ŧ 3 �ҷ� (3 minute step test)</strong></td>
        </tr>
      <tr>
        <td><strong>�վ�á�͹��÷��ͺ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtsteptest1" type="text" class="frmsaraban" id="txtsteptest1" value="<?=$arr_view["steptest1"];?>">
&nbsp;����/�ҷ�</td>
      </tr>
      <tr>
        <td><strong>�վ����ѧ��þѡ 1 �ҷ�</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtsteptest2" type="text" class="frmsaraban" id="txtsteptest2" value="<?=$arr_view["steptest2"];?>">
&nbsp;����/�ҷ�</td>
      </tr>
      <tr>
        <td><strong>�վ����ѧ��÷��ͺ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtsteptest3" type="text" class="frmsaraban" id="txtsteptest3" value="<?=$arr_view["steptest3"];?>">
&nbsp;����/�ҷ�</td>
      </tr>
      
      <tr>
        <td><strong>�дѺ���ö�Ҿ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="resultsteptest" type="radio" class="frmsaraban" value="5" <?php if($arr_view["result_steptest"]==5){ echo "checked"; } ?> />
���ҡ
          &nbsp;&nbsp;
          &nbsp;
          <input name="resultsteptest" type="radio" class="frmsaraban" value="4" <?php if($arr_view["result_steptest"]==4){ echo "checked"; } ?> />
��          &nbsp;&nbsp;
          &nbsp;
          <input name="resultsteptest" type="radio" class="frmsaraban" value="3" <?php if($arr_view["result_steptest"]==3){ echo "checked"; } ?> />
�ҹ��ҧ          &nbsp;&nbsp;
          &nbsp;
          <input name="resultsteptest" type="radio" class="frmsaraban" value="2" <?php if($arr_view["result_steptest"]==2){ echo "checked"; } ?> />
���          &nbsp;&nbsp;
          &nbsp;
          <input name="resultsteptest" type="radio" class="frmsaraban" value="1" <?php if($arr_view["result_steptest"]==1){ echo "checked"; } ?> />
����ҡ</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>��÷��ͺ��ҧ���</strong></td>
        </tr>
      <tr>
        <td><strong>�ѹ���</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtpressure" type="text" class="frmsaraban" id="txtpressure" value="<?=$arr_view["pressure_test"];?>" />
&nbsp;����/2 �ҷ�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name='pressure_result' type='radio' value='��ҹ' id="pressure_result1" <?php if($arr_view["pressure_result"]=="��ҹ"){ echo "checked"; } ?>/>
��ҹ
<input name='pressure_result' type='radio' value='����ҹ' id="pressure_result2" <?php if($arr_view["pressure_result"]=="����ҹ"){ echo "checked"; } ?>/>
����ҹ</td>
      </tr>
      <tr>
        <td><strong>�ء���</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtsitup" type="text" class="frmsaraban" id="txtsitup" value="<?=$arr_view["situp_test"];?>" />
          &nbsp;����/2 �ҷ�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name='situp_result' type='radio' value='��ҹ' id="situp_result1" <?php if($arr_view["situp_result"]=="��ҹ"){ echo "checked"; } ?>/>
          ��ҹ
          <input name='situp_result' type='radio' value='����ҹ' id="situp_result2" <?php if($arr_view["situp_result"]=="����ҹ"){ echo "checked"; } ?>/>
          ����ҹ</td>
      </tr>
      <tr>
        <td><strong>��� 2 ��������</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtrun" type="text" class="frmsaraban" id="txtrun" value="<?=$arr_view["run_test"];?>" />
          &nbsp;�ҷ�<span style="margin-left:63px;"><input name='run_result' type='radio' value='��ҹ' id="run_result1" <?php if($arr_view["run_result"]=="��ҹ"){ echo "checked"; } ?>/>
          ��ҹ
          <input name='run_result' type='radio' value='����ҹ' id="run_result2" <?php if($arr_view["run_result"]=="����ҹ"){ echo "checked"; } ?>/>
          ����ҹ</span></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>�� X-Ray</strong></td>
        </tr>
      <tr>
        <td><strong>�š�� X-Ray</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name='xray' type='radio' id="xray1" value='����' checked="checked" <?php if($arr_view["xray"]=="����"){ echo "checked"; } ?>/>
	      ����
	        <input name='xray' type='radio' value='�Դ����' id="xray2" <?php if($arr_view["xray"]=="�Դ����"){ echo "checked"; } ?>/>
	      �Դ������硹���
	        <input name='xray' type='radio' value='�Դ����' id="xray3" <?php if($arr_view["xray"]=="�Դ���Ԥ�þ�ᾷ��"){ echo "checked"; } ?>/>
�Դ���Ԥ�þ�ᾷ��</td>
      </tr>
      <tr>
        <td><strong>��ҼԴ���� �к�</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="xraydetail" type="text" class="frmsaraban" id="xraydetail" value="<?=$arr_view["xray_detail"];?>"></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>��õ�Ǩ�آ�Ҿ��ͧ�ҡ</strong></td>
        </tr>
      <tr>
        <td><strong>������Ъ�ͧ�ҡ</strong></td>
        <td align="center">:</td>
        <td width="19%"><input name='resultdental' type='radio' value='����' id="dental1" <?php if($arr_view["result_dental"]=="����"){ echo "checked"; } ?>/>
����
  <input name='resultdental' type='radio' value='�Դ����' id="dental2" <?php if($arr_view["result_dental"]=="�Դ����"){ echo "checked"; } ?>/>
�Դ����</td>
        <td width="65%"><strong>�дѺ : 
          <input name="level_dental" type="text" class="frmsaraban" id="level_dental" value="<?=$arr_view["level_dental"];?>" />
        </strong></td>
      </tr>
      <tr>
        <td><strong>�ä�ѹ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="dental_disease1" type="checkbox" class="frmsaraban" value="1" <?php if($arr_view["dental_disease1"]==1){ echo "checked"; } ?> />
          �ѹ�� (D,I)
          &nbsp;&nbsp;
          &nbsp;
          <input name="dental_disease2" type="checkbox" class="frmsaraban" value="1" <?php if($arr_view["dental_disease2"]==1){ echo "checked"; } ?> />
�ѹ�֡ (E,J)         &nbsp;&nbsp;
          &nbsp;
          <input name="dental_disease3" type="checkbox" class="frmsaraban" value="1" <?php if($arr_view["dental_disease3"]==1){ echo "checked"; } ?> />          
          �ä��Էѹ���ѡ�ʺ (F,K)</td>
      </tr>
      <tr>
        <td><strong>�ä�˧�͡</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="gum_disease1" type="checkbox" class="frmsaraban" value="1" <?php if($arr_view["gum_disease1"]==1){ echo "checked"; } ?> />
�ä�˧�͡�ѡ�ʺ (B)
          &nbsp;&nbsp;
          &nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input name="gum_disease2" type="checkbox" class="frmsaraban" value="1" <?php if($arr_view["gum_disease2"]==1){ echo "checked"; } ?> /> 
          �ѹ�ش (L)</td>
      </tr>
      <tr>
        <td><strong>����</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="other_disease1" type="checkbox" class="frmsaraban" id="other_disease1" value="1" <?php if($arr_view["other_disease1"]==1){ echo "checked"; } ?> />
        �٭���¿ѹ ��Ф�����ѹ��᷹ (G)
        &nbsp;&nbsp;
          &nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;
              <input name="other_disease2" type="checkbox" class="frmsaraban" id="other_disease2" value="1" <?php if($arr_view["other_disease2"]==1){ echo "checked"; } ?> />
          �Ǵ ��� ����/����ä㹪�ͧ�ҡ (M)</td>
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
        <td colspan="4" bgcolor="#FFCC99"><strong>�š�õ�Ǩ�ҧ��Ҹ� ������ѹ��� <?php echo $lab_date;?>
            <input name="rowlab2" type="hidden" id="rowlab2"  value="<?php echo $lab_date;?>" />
        </strong></td>
        </tr>
      <tr>
        <td colspan="4">
<!-- �š�õ�Ǩ�ҧ��Ҹ� -->
<TABLE width="100%" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" >
<TR>
	<TD>
	<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="left" bgcolor="#FFFFCC">&nbsp;&nbsp; <span class="style5"><strong>�� UA :</strong></span> <span class="labfont">
        <input name='ua_lab' type='radio' value='����' <?php if($arr_view["ua_lab"]=="����"){ echo "checked"; } ?>/>
����
<input name='ua_lab' type='radio' value='�Դ����' <?php if($arr_view["ua_lab"]=="�Դ����"){ echo "checked"; } ?>/>
�Դ����
		</span></TD>
	</TR>
	<TR>
	  <TD align="left" bgcolor="#FFFFFF"><span class="style2">- ��ͧ����դ�� + ��� Positive ����ն����� �Դ����</span></TD>
	  </TR>
	<TR class="tb_font">
		<TD bgcolor="#FFCCCC"><table border="0">
	  <tr>
	  <?php
	  $i=1;
	  	while(list($labname,$labresult, $unit) = mysql_fetch_row($result_ua)){
		if($labname == "OTHERU"){
			$size="13";
		}else{
			$size="6";
		}

		//if(!empty($arr_dxofyear[$list_ua[$labname]]))
			//$labresult = $arr_dxofyear[$list_ua[$labname]];
	  ?>
          <td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td>&nbsp;<input name="<?php echo  $list_ua[$labname];?>" type="text" class="frmsaraban" value="<?php echo $labresult;?>"  size="<?php echo $size;?>" readonly />&nbsp;<?php //echo //$unit;?>&nbsp;</td>
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}?>
		  </tr>
      </table>
	  <hr />
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFCC">&nbsp;&nbsp; <span class="style5"><strong>�� CBC :</strong></span> <span class="labfont">
    <input name='cbc_lab' type='radio' value='����' <?php if($arr_view["cbc_lab"]=="����"){ echo "checked"; } ?>/>
����
<input name='cbc_lab' type='radio' value='�Դ����' <?php if($arr_view["cbc_lab"]=="�Դ����"){ echo "checked"; } ?>/>
�Դ���� </span></td>
  </tr>
</table>

	  <table border="0">
	  <tr>
	  <?php
	  $i=1;
	  	while(list($labname,$labresult, $unit,$normalrange,$flag) = mysql_fetch_row($result_cbc)){
		if($labname == "HB" || $labname == "HCT" || $labname == "WBC" || $labname == "PLTC"){
			$color="#FF0000";
			$rang=$normalrange;
		}else{
			$color="#000000";
		}
	  ?>
          <td align="right" class="tb_font_2"><strong style="color:<?=$color;?>"><?php echo $labname;?> : </strong></td>
          <td>&nbsp;<input name="<?php echo  $list_cbc[$labname];?>" type="text" value="<?php echo $labresult;?>" readonly size="5" /> <? if($labname == "HB" || $labname == "HCT" || $labname == "WBC" || $labname == "PLTC"){ echo "( $normalrange )";}?>
          <input type="hidden" name="<?=$labname?>range" value="<?=$normalrange?>" />
          <input type="hidden" name="<?=$labname?>flag" value="<?=$flag?>" />
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}?>		  </tr>
      </table>      </TD>
	</TR>
    <tr>
      <td>HB ��� ��õ�Ǩ�Ѵ��������鹢ͧ�����źԹ</td>
    </tr>
    <tr>
    <td>HCT ��� �дѺ������ʹᴧ ��ҹ��¡��� 37 �觺͡�֧���Ыմ</td>
    </tr>
    <tr>
      <td>WBC ��� �дѺ������ʹ���</td>
    </tr>
    <tr>
      <td>PLTC ��� ����ҳ������ʹ</td>
    </tr>   
	</TABLE>	</TD>
</TR>
</TABLE>        </td>
        </tr>
      <!--����� LAB �����ҡ����������ҡѺ 35 ��-->
      <tr>
        <td colspan="4"><?
//echo "==>".substr($arr_view["age"],0,2);
if($rows["age"]>= 35){
////��lab �ͧ�շ������
////*runno ��Ǩ�آ�Ҿ*/////////
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
////*runno ��Ǩ�آ�Ҿ*/////////
?>
<table border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF"  width="100%" bgcolor="#FFCCCC">
  <tr><td>
	  <table width="100%" border="0">
	    <tr>
	      <td colspan="7" align="left" bgcolor="#FFFFCC" class="tb_font_2"><strong>�� LAB ੾�м�����������ҡ���� 35 ��</strong></td>
	      </tr>
	    <tr>
	      <td align="right" class="tb_font_2">&nbsp;</td>
	      <td align="center" bgcolor="#339999" class="profilelab"><strong><?=($nPrefix-2)?></strong></td>
          <td align="center" bgcolor="#339999" class="profilelab"><strong><?=($nPrefix-1)?></strong></td>
	      <td align="center" bgcolor="#339999" class="profilelab"><strong><?=$nPrefix?></strong></td>
	      <td class="labfont">&nbsp;</td>
	      <td align="center" class="labfont">&nbsp;</td>
	      <td class="labfont">&nbsp;</td>
	      </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='GLU' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='GLU' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='GLU' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>      
	    <tr>
	      <td width="29%" align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>GLU(����ҹ) :</strong></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab2;?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab1;?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 74 || $resultlab > 106){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="glu_result" id="glu_result" value="<?=$resultlab;?>"><input type="hidden" name="glu_flag" id="glu_flag" value="<?=$flaglab;?>"></td>
	    <td class="labfont">(<?=$ranglab;?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo "style='color:#F00;font-weight:bold;'";}?>><?=$flaglab;?></span></td>
	    <td class="labfont"><input name='glu_lab' type='radio' value='����' <?  if($resultlab >= 74 && $resultlab <= 106){ echo "checked";}?>/>
����
  		<input name='glu_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && $resultlab < 74 || $resultlab > 106){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && $resultlab < 74 || $resultlab > 106){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>  		</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>          
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>CHOL(��õ�Ǩ��ѹ) :</strong></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab2;?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab1;?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab > 200){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="chol_result" id="chol_result" value="<?=$resultlab;?>">
            <input type="hidden" name="chol_flag" id="chol_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab;?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab;?></span></td>
	    <td class="labfont"><input name='chol_lab' type='radio' value='����' <? if(!empty($resultlab) && $resultlab <= 200){ echo "checked";}?> />
����
  <input name='chol_lab' type='radio' value='�Դ����' <? if($resultlab > 200){ echo "checked";}?>/>
            <? 
			if($resultlab > 200){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>        </td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>       
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>TRIG(��õ�Ǩ��ѹ) :</strong></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab2;?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab1;?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab > 150){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>		<input type="hidden" name="trig_result" id="trig_result" value="<?=$resultlab;?>"><input type="hidden" name="trig_flag" id="trig_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab;?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab;?></span></td>
	    <td class="labfont"><input name='trig_lab' type='radio' value='����' <? if(!empty($resultlab) && $resultlab <= 150){ echo "checked";}?> />
����
  <input name='trig_lab' type='radio' value='�Դ����'  <? if($resultlab > 150){ echo "checked";}?>/>
            <? 
			if($resultlab > 150){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>        </td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>         
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>HDL(��õ�Ǩ��ѹ��) :</strong></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
          <?=$resultlab2;?>
        </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
          <?=$resultlab1;?>
        </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($resultlab < 40 || $resultlab > 60){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="hdl_result" id="hdl_result" value="<?=$resultlab;?>"><input type="hidden" name="hdl_flag" id="hdl_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(
	        <?=$ranglab?>
	      )</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>>
	      <?=$flaglab?>
	      </span></td>
	    <td class="labfont"><input name='hdl_lab' type='radio' value='����' <? if($resultlab >= 40 && $resultlab <= 60){ echo "checked";}?>/>
	      ����
	      <input name='hdl_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && $resultlab < 40 || $resultlab > 60){ echo "checked";}?>/>
    <? 
			if(!empty($resultlab) && $resultlab < 40 || $resultlab > 60){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>        </td>
	  </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>       
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>LDL(��õ�Ǩ��ѹ���) :</strong></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
          <?=$resultlab2;?>
        </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
          <?=$resultlab1;?>
        </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($resultlab > 100){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="ldl_result" id="ldl_result" value="<?=$resultlab;?>"><input type="hidden" name="ldl_flag" id="ldl_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(
	        <?=$ranglab;?>
	      )</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>>
	      <?=$flaglab;?>
	      </span></td>
	    <td class="labfont"><input name='ldl_lab' type='radio' value='����' <? if(!empty($resultlab) && $resultlab <= 100){ echo "checked";}?> />
	      ����
	      <input name='ldl_lab' type='radio' value='�Դ����' <? if($resultlab > 100){ echo "checked";}?>/>
    <? 
			if($resultlab > 100){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>        </td>
	  </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>BUN(��÷ӧҹ�ͧ�) :</strong></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab2;?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab1;?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 7 || $resultlab > 18){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="bun_result" id="bun_result" value="<?=$resultlab;?>"><input type="hidden" name="bun_flag" id="bun_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
	    <td class="labfont"><input name='bun_lab' type='radio' value='����' <? if($resultlab >= 7 && $resultlab <= 18){ echo "checked";}?>/>
����
  <input name='bun_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && $resultlab < 7 || $resultlab > 18){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && $resultlab < 7 || $resultlab > 18){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>        </td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>CREA(��÷ӧҹ�ͧ�) :</strong></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab2;?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab1;?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 0.6 || $resultlab > 1.3){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="crea_result" id="crea_result" value="<?=$resultlab;?>"><input type="hidden" name="crea_flag" id="crea_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab;?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
	    <td class="labfont"><input name='crea_lab' type='radio' value='����' <? if($resultlab >= 0.6 && $resultlab <= 1.3){ echo "checked";}?> />
����
  <input name='crea_lab' type='radio' value='�Դ����' <? if(!empty($result['cr']) && $resultlab < 0.6 || $resultlab > 1.3){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && $resultlab < 0.6 || $resultlab > 1.3){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>		</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>ALP(�Ѻ,��д١) :</strong></td>
          <td width="9%" align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
            <?=$resultlab2;?>
          </span></td>
          <td width="9%" align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
            <?=$resultlab1;?>
          </span></td>
          <td width="8%" align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 46 || $resultlab > 116){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>          	<input type="hidden" name="alp_result" id="alp_result" value="<?=$resultlab;?>"><input type="hidden" name="alp_flag" id="alp_flag" value="<?=$flaglab;?>" /></td>
			<td width="12%" class="labfont">(<?=$ranglab?>)</td>
            <td width="8%" align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
			<td width="25%" class="labfont"><input name='alp_lab' type='radio' value='����' <? if($resultlab >= 46 && $resultlab <= 116){ echo "checked";}?>/>
			���� 
			  <input name='alp_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && $resultlab < 46 || $resultlab > 116){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && $resultlab < 46 || $resultlab > 116){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>            </td>
            </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>            
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>ALT(��÷ӧҹ�ͧ�Ѻ) :</strong></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab2;?>
	    </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab1;?>
	    </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab > 50){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="alt_result" id="alt_result" value="<?=$resultlab;?>"><input type="hidden" name="alt_flag" id="alt_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
	    <td class="labfont"><input name='alt_lab' type='radio' value='����' <? if($resultlab > 0 && $resultlab <= 50){ echo "checked";}?>/>
����
  <input name='alt_lab' type='radio' value='�Դ����' <? if($resultlab > 50){ echo "checked";}?>/>
            <? 
			if($resultlab > 50){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>  		</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>          
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>AST(��÷ӧҹ�ͧ�Ѻ) :</strong></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab2;?>
	    </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab1;?>
	    </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 15 || $resultlab > 37){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>       <input type="hidden" name="ast_result" id="ast_result" value="<?=$resultlab;?>"><input type="hidden" name="ast_flag" id="ast_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
	    <td class="labfont"><input name='ast_lab' type='radio' value='����' <? if($resultlab >= 15 && $resultlab <= 37){ echo "checked";}?>/>
����
  <input name='ast_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && ($resultlab < 15 || $resultlab > 37)){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && ($resultlab < 15 || $resultlab > 37)){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>		</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='��Ǩ�آ�Ҿ��Шӻ�".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>        
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>URIC(�ä��ҷ�) :</strong></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab2;?>
	    </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab1;?>
	    </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 2.6 || $resultlab > 7.2){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="uric_result" id="uric_result" value="<?=$resultlab;?>"><input type="hidden" name="uric_flag" id="uric_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
	    <td class="labfont"><input name='uric_lab' type='radio' value='����' <? if($resultlab >= 2.6 && $resultlab <= 7.2){ echo "checked";}?>/>
����
  <input name='uric_lab' type='radio' value='�Դ����' <? if(!empty($resultlab) && ($resultlab < 2.6 || $resultlab > 7.2)){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && ($resultlab < 2.6 || $resultlab > 7.2)){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>		</td>
	    </tr>
            </table>
        </TD>
	</TR>
	</TABLE>
    <br>
<?
} // close if age
?>        </td>
        </tr>
      <!--�� �����ҡ����������ҡѺ 35 ��-->   
<? //} //�Դ�� thaywin?>           
      <tr>
        <td colspan="4" align="center" bgcolor="#0099FF"><span class="style1">�����Թ����Ф�������§</span></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>�Ҫ��͹����</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td align="center">:</td>
        <td colspan="2"><input name='health_risk' type='radio' value='��' id="health_risk1" <?php if($arr_view["health_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='health_risk' type='radio' value='�����' id="health_risk2" <?php if($arr_view["health_risk"]=="�����" || empty($arr_view["health_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>�غѵ��˵ب�Ҩ�</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='accident_risk' type='radio' value='��' id="accident_risk1" <?php if($arr_view["accident_risk"]=="��"){ echo "checked"; } ?>/>
��
  <input name='accident_risk' type='radio' value='�����' id="accident_risk2" <?php if($arr_view["accident_risk"]=="�����" || empty($arr_view["accident_risk"])){ echo "checked"; } ?>/> 
  �����</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>���ʾ�Դ/ͺ���آ</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='addictive_risk' type='radio' value='��' id="addictive_risk1" <?php if($arr_view["addictive_risk"]=="��"){ echo "checked"; } ?>/>
��
  <input name='addictive_risk' type='radio' value='�����' id="addictive_risk2" <?php if($arr_view["addictive_risk"]=="�����"  || empty($arr_view["addictive_risk"])){ echo "checked"; } ?>/> 
  �����</td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>�آ�Ҿ�Ե</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">�дѺ��ṹ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name="score_stress" type="text" id="score_stress" value="<?=$arr_view["score_stress"];?>" /></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">�������´</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name="result_stress" type="radio" class="frmsaraban" id="result_stress1" value="���´����" checked="checked" <?php if($arr_view["result_stress"]=="���´����"){ echo "checked"; } ?> />
���´����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="result_stress" id="result_stress2" type="radio" class="frmsaraban" value="���´�ҹ��ҧ" <?php if($arr_view["result_stress"]=="���´�ҹ��ҧ"){ echo "checked"; } ?> />
���´�ҹ��ҧ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="result_stress" id="result_stress3" type="radio" class="frmsaraban" value="���´�ҡ" <?php if($arr_view["result_stress"]=="���´�ҡ"){ echo "checked"; } ?> />
���´�ҡ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="result_stress" id="result_stress4" type="radio" class="frmsaraban" value="���´�ҡ����ش" <?php if($arr_view["result_stress"]=="���´�ҡ����ش"){ echo "checked"; } ?> />
���´�ҡ����ش</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>����ҹ</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='diabetes_risk' type='radio' value='��' id="diabetes_risk1" <?php if($arr_view["diabetes_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='diabetes_risk' type='radio' value='�����' id="diabetes_risk2" <?php if($arr_view["diabetes_risk"]=="�����" || empty($arr_view["diabetes_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>�</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='kidney_risk' type='radio' value='��' id="kidney_risk1" <?php if($arr_view["kidney_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='kidney_risk' type='radio' value='�����' id="kidney_risk2" <?php if($arr_view["kidney_risk"]=="�����" || empty($arr_view["kidney_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>�ѳ�ä</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='tb_risk' type='radio' value='��' id="tb_risk1" <?php if($arr_view["tb_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='tb_risk' type='radio' value='�����' id="tb_risk2" <?php if($arr_view["tb_risk"]=="�����" || empty($arr_view["tb_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>����</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='heart_risk' type='radio' value='��' id="heart_risk1" <?php if($arr_view["heart_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='heart_risk' type='radio' value='�����' id="heart_risk2" <?php if($arr_view["heart_risk"]=="�����" || empty($arr_view["heart_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>�����</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='cancer_risk' type='radio' value='��' id="cancer_risk1" <?php if($arr_view["cancer_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='cancer_risk' type='radio' value='�����' id="cancer_risk2" <?php if($arr_view["cancer_risk"]=="�����" || empty($arr_view["cancer_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>HIV</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='hiv_risk' type='radio' value='��' id="hiv_risk1" <?php if($arr_view["hiv_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='hiv_risk' type='radio' value='�����' id="hiv_risk2" <?php if($arr_view["hiv_risk"]=="�����" || empty($arr_view["hiv_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      

      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>�Ѻ</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='liver_risk' type='radio' value='��' id="liver_risk1" <?php if($arr_view["liver_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='liver_risk' type='radio' value='�����' id="liver_risk2" <?php if($arr_view["liver_risk"]=="�����" || empty($arr_view["liver_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>��ʹ���ʹ��ͧ</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='stroke_risk' type='radio' value='��' id="stroke_risk1" <?php if($arr_view["stroke_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='stroke_risk' type='radio' value='�����' id="stroke_risk2" <?php if($arr_view["stroke_risk"]=="�����" || empty($arr_view["stroke_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>��ҷ�</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='gout_risk' type='radio' value='��' id="gout_risk1" <?php if($arr_view["gout_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='gout_risk' type='radio' value='�����' id="gout_risk2" <?php if($arr_view["gout_risk"]=="�����" || empty($arr_view["gout_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>������������</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='knee_risk' type='radio' value='��' id="knee_risk1" <?php if($arr_view["knee_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='knee_risk' type='radio' value='�����' id="knee_risk2" <?php if($arr_view["knee_risk"]=="�����" || empty($arr_view["knee_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>��д١�Ѻ���</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">����ػ</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='bone_risk' type='radio' value='��' id="bone_risk1" <?php if($arr_view["bone_risk"]=="��"){ echo "checked"; } ?>/>
          ��
          <input name='bone_risk' type='radio' value='�����' id="bone_risk2" <?php if($arr_view["bone_risk"]=="�����" || empty($arr_view["bone_risk"])){ echo "checked"; } ?>/>
          �����</td>
      </tr>
      

      
      <tr>
        <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>��ػ���ͧ��</strong> <? if($result['bmi'] >=35.0 && $result['bmi'] <=39.9){
			echo "��ǹ�ҡ";}else if($arr_view['bmi'] >=40.0){
			echo "�ä��ǹ";
		} ?></td>
        </tr>
      <tr>
        <td colspan="4"><input name='resultdiagnormal' type='checkbox' value='1' id="resultdiagnormal" <?php if($arr_view["resultdiag_normal"]==1){ echo "checked"; } ?>/>        
          ��辺��������§����ä NCDs</td>
        </tr>
      <tr>
        <td colspan="4"><input name='resultdiagrisk' type='checkbox' value='1' id="resultdiagrisk" <?php if($arr_view["resultdiag_risk"]==1){ echo "checked"; } ?>/>
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
        <td colspan="4"><input name='resultdiagdiseases' type='checkbox' value='1' id="resultdiagdiseases" <?php if($arr_view["resultdiag_diseases"]==1){ echo "checked"; } ?>/>
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
        <td height="52" colspan="4" align="center" bgcolor="#FF6699">
<? if($num1 < 1){ ?>
<input name="Submit" type="submit" class="frmsaraban" value="�ѹ�֡������" onclick="return checkfrm()" />
<? }else{ ?>
<input name="Submit" type="submit" class="frmsaraban" value="��䢢�����" onclick="return checkfrm()" />
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
													 xray_detail='$_POST[xraydetail]',
													 result_dental='$_POST[resultdental]',
													 dental_disease1='$_POST[dental_disease1]',
													 dental_disease2='$_POST[dental_disease2]',
													 dental_disease3='$_POST[dental_disease3]',	
													 gum_disease1='$_POST[gum_disease1]',
													 gum_disease2='$_POST[gum_disease2]',
													 level_dental='$_POST[level_dental]',
													 other_disease1='$_POST[other_disease1]',
													 other_disease2='$_POST[other_disease2]',													 
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
													 yearchkup='$_POST[yearchkup]'";
													//echo $add;
	if(mysql_query($add)){
		echo "<script>alert('�ѹ�֡���������º����');window.location='armychkupopd.php';</script>";
	}else{
		echo "<script>alert('�Դ��Ҵ �ѹ�֡��������������');window.location='armychkupopd.php';</script>";
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
													 level_dental='$_POST[level_dental]',
													 other_disease1='$_POST[other_disease1]',
													 other_disease2='$_POST[other_disease2]',														 
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
													 lastupdate_officer='$officer' where row_id='$_POST[row_id]'";
													 //echo $edit;
	if(mysql_query($edit)){
		echo "<script>alert('��䢢��������º����');window.location='armychkupopd.php';</script>";
	}else{
		echo "<script>alert('�Դ��Ҵ ��䢢�������������');window.location='armychkupopd.php';</script>";
	}													 
}
?>