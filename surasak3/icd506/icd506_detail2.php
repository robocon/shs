<?
If(!empty($hn)){
    include("Connections/connect.inc.php");
 	include("Connections/all_function.php");
	
	$hn=$_REQUEST['hn'];

    $query = "SELECT * FROM opcard  WHERE hn ='$hn' ";
    $result = mysql_query($query) or die("query failed,opcard");
    $dbarr= mysql_fetch_array ($result);
	
	$ptname=$dbarr['yot'].' ' .$dbarr['name'].' '.$dbarr['surname'];
	
	$address='��ҹ�Ţ��� '.$dbarr['address'].'  �Ӻ�'.$dbarr['tambol'].'  �����'.$dbarr['ampur'].'  �ѧ��Ѵ'.$dbarr['changwat'];
	
	$age=calcage($dbarr['dbirth']);

if($dbarr['sex']=="�"){
	$sex1="Checked"; }
	elseif($dbarr['sex']=="�"){ 
	$sex2="Checked"; }
	
if($dbarr['married']=="�ʴ"){ 
	$married1="Checked"; }
elseif($dbarr['married']=="����"){  
	$married2="Checked"; }
elseif($dbarr['married']=="�����/��"){  
	$married3="Checked"; }
elseif($dbarr['married']=="����"){  
	$married4="Checked"; }		
	
	
if($dbarr['nation']=="��"){
	$nation1="Checked"; }else{ 
	$nation2="Checked"; }
?>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.forntsarabun11 {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 15px;
}
-->
</style>

<form name="f1" action="" method="post">
<TABLE cellpadding="0" cellspacing="0"  class="forntsarabun">
<TR>
  <TD align="center" >Ẻ��§ҹ������ Ẻ ç.506</TD>
</TR>
<TR>
  <TD align="center" >�ç��Һ�Ť�������ѡ�������� �.�ӻҧ �� 054-839305</TD>
</TR>
<TR>
  <TD  class="forntsarabun11"><strong>���ͼ�����</strong>
<?=$ptname;?>
    &nbsp;&nbsp;&nbsp;<strong>HN</strong>&nbsp;&nbsp;
    <?=$dbarr['hn'];?>
    &nbsp;&nbsp;<strong>�Ţ��Шӵ�ǻ�ЪҪ�</strong>&nbsp;&nbsp;<?=$dbarr['idcard'];?>
    &nbsp;&nbsp;<strong>�������Ѿ��</strong>&nbsp;<?=$dbarr['phone'];?>&nbsp;</TD>
</TR>
<TR>
	<TD ><span class="forntsarabun11"><strong>�� LAB</strong>.......................&nbsp;<strong>Hb/Hct</strong>...............................&nbsp;<strong>Ptt</strong>................................&nbsp;<strong>����</strong>....................................</span></TD>
</TR>
<TR>
  <TD ><span class="forntsarabun11"><strong>���ͺԴ� - ��ô����ͼ�黡��ͧ(����Ѻ�������硷�������ص�ӡ��� 15 ��)</strong>.............................................<strong>�Ҫվ</strong>............................</span></TD>
</TR>
<TR>
  <TD ><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse" class="forntsarabun1">
    <tr >
      <td width="9%" align="left" valign="top"><div align="center">��</div>
          <label>
            <input type="radio" name="radio" id="radio" value="radio" <?=$sex1;?>/>
          </label>
          ���
          <br />
          <label>
            <input type="radio" name="radio" id="radio2" value="radio" <?=$sex2;?> />
          </label>
          ˭ԧ</td>
      <td width="10%" align="center" valign="top"><div align="center">����</div><? echo calcage($dbarr['dbirth']);?>

      </td>
      <td width="20%" valign="top"><div align="center">��������</div>
        <label>
          <input type="radio" name="married" id="radio3" value="radio"  <?=$married1;?>/>
          �ʴ</label><br />
<label>
  <input type="radio" name="married" id="radio4" value="radio"  <?=$married2;?>/>
</label>
����
<label>
  <br />
  <input type="radio" name="married" id="radio5" value="radio" <?=$married3;?>/>
</label>
������ҧ <br />
<label>
  <input type="radio" name="married" id="radio6" value="radio" <?=$married4;?>/>
</label> 
�����
</td>
      <td width="43%" valign="top"><div align="center">�ѭ�ҵ�</div>
        <label>
          <input type="radio" name="nation" id="radio7" value="radio"  <?=$nation1;?>/>
          ����</label>
        <br />
        <label>
          <input type="radio" name="nation" id="radio8" value="radio" <?=$nation2;?>/>
        </label>
        ����ҧ�ҵ� ������ 
        <label>
          <input type="radio" name="nationt" id="radio9" value="radio" />
          1
        </label>
        <label>
          <input type="radio" name="nationt" id="radio11" value="radio" />
        </label>
        2
        <label>
          <input type="radio" name="radiot" id="radio12" value="radio" />
          3</label>
        <br />
        <br />
        �к��ѭ�ҵ�......................................................<br /></td>
      <td width="18%" align="center" valign="top"><div align="center">�ҹ����</div>
        ...................................<br />
        (<label>
          <input type="checkbox" name="checkbox" id="checkbox" />
          
          <input type="checkbox" name="checkbox2" id="checkbox2" />)        </label></td>
    </tr>
    <tr>
      <td colspan="5">������袳����������
        &nbsp;&nbsp;
        <?=$address;?>
        </span>
        <table  border="0" cellspacing="0" cellpadding="0" class="forntsarabun1">
          <tr>
            <td width="519">ʶҹ��������§......................................................................................................
              (
              <input type="checkbox" name="checkbox3" id="checkbox3" />
              <input type="checkbox" name="checkbox4" id="checkbox4" />
              )&nbsp;
              (
              <input type="checkbox" name="checkbox5" id="checkbox5" />
              <input type="checkbox" name="checkbox6" id="checkbox6" />
              )
              <input type="radio" name="nation_type" id="radio10" value="radio" />
              ࢵ�Ⱥ��&nbsp;&nbsp;</td>
            <td width="146">
              <input type="radio" name="nation_type" id="radio14" value="radio" />
              ͺ�.</td>
          </tr>
        </table>
	</td>
      </tr>
    <tr>
      <td colspan="2" align="center">�ѹ������������</td>
      <td align="center">�ѹ��辺������</td>
      <td align="center">ʶҹ����ѡ��</td>
      <td align="center">������������</td>
    </tr>
    <tr>
      <td colspan="2" align="left" valign="top">�ѹ���.................
        (<input type="checkbox" name="checkbox7" id="checkbox7" /><input type="checkbox" name="checkbox8" id="checkbox8" />)<br />
        ��͹................
        (<input type="checkbox" name="checkbox9" id="checkbox9" /><input type="checkbox" name="checkbox9" id="checkbox10" />)<br />
�.�...................
        (<input type="checkbox" name="checkbox10" id="checkbox11" /><input type="checkbox" name="checkbox10" id="checkbox12" />
)</span></td>
      <td align="left" valign="top">�ѹ���.................
        (<input type="checkbox" name="checkbox11" id="checkbox13" /><input type="checkbox" name="checkbox11" id="checkbox14" />
)<br />
��͹................
        (<input type="checkbox" name="checkbox12" id="checkbox15" /><input type="checkbox" name="checkbox12" id="checkbox16" />)<br />
�.�...................
        (<input type="checkbox" name="checkbox13" id="checkbox17" /><input type="checkbox" name="checkbox13" id="checkbox18" />)</td>
      <td align="left" valign="top"><table  border="0" align="center" cellpadding="0" cellspacing="0" class="forntsarabun1">
        <tr>
          <td >
            <input type="checkbox" name="checkbox14" id="checkbox19" />
þ.�ٹ��<br />
<input type="checkbox" name="checkbox15" id="checkbox20" />
þ.�����<br />
<input type="checkbox" name="checkbox16" id="checkbox21" />
þ.�����</td>
          <td valign="top"><p>
            
            <input type="checkbox" name="checkbox17" id="checkbox22" />
            ��Թԡ�ͧ�Ҫ���<br />
            <input type="checkbox" name="checkbox18" id="checkbox23" />
            �.�.<br />
            <input type="checkbox" name="checkbox19" id="checkbox24" />
            þ.�Ҫ���� ���</p></td>
          <td  valign="top">
            <input type="checkbox" name="checkbox20" id="checkbox25" />
            ��Թԡ þ.�͡��<br />
            <input type="checkbox" name="checkbox21" id="checkbox26" />
            ��ҹ</td>
        </tr>
      </table></td>
      <td valign="top">
        <input type="checkbox" name="checkbox22" id="checkbox27" /> 
        �����¹͡
  <br />
  <input type="checkbox" name="checkbox22" id="checkbox28" />
        �������<br />
  <input type="checkbox" name="checkbox23" id="checkbox29" /> 
        �鹾�㹪����
      </td>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="forntsarabun1">
        <tr>
          <td colspan="2" align="center"><span class="forntsarabun1">��Ҿ������</span></td>
          <td width="44%"  align="center"><span class="forntsarabun1">�ѹ�����</span></td>
        </tr>
        <tr>
          <td width="27%"  align="left" valign="top"><span class="forntsarabun1">
            <input type="checkbox" name="checkbox24" id="checkbox30" />
            ���</span></td>
          <td width="29%" align="left" valign="top"><span class="forntsarabun1">
            <input type="checkbox" name="checkbox27" id="checkbox33" />
            �ѧ����Һ</span></td>
          <td align="left" valign="top"><span class="forntsarabun1">�ѹ���.................
        (<input type="checkbox" name="checkbox29" id="checkbox35" /><input type="checkbox" name="checkbox29" id="checkbox36" />)</span></td>
        </tr>
        <tr>
          <td align="left" valign="top"><span class="forntsarabun1">
            <input type="checkbox" name="checkbox25" id="checkbox31" />
            ���</span></td>
          <td align="left" valign="top"><span class="forntsarabun1">
            <input type="checkbox" name="checkbox28" id="checkbox34" />
            �ѧ�ժ��Ե����</span></td>
          <td align="left" valign="top"><span class="forntsarabun1">��͹................
        (<input type="checkbox" name="checkbox30" id="checkbox37" /><input type="checkbox" name="checkbox30" id="checkbox38" />)</span></td>
        </tr>
        <tr>
          <td align="left" valign="top"><span class="forntsarabun1">
            <input type="checkbox" name="checkbox26" id="checkbox32" />
            �ѧ�ѡ������</span></td>
          <td align="left" valign="top">&nbsp;</td>
          <td align="left" valign="top"><span class="forntsarabun1">�.�...................
        (<input type="checkbox" name="checkbox31" id="checkbox39" /><input type="checkbox" name="checkbox31" id="checkbox40" />)</span></td>
        </tr>
      </table></td>
      <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="forntsarabun1">
        <tr>
          <td align="center"><span class="forntsarabun1">���ͼ����§ҹ</span></td>
          <td align="center"><span class="forntsarabun1">ʶҹ���ӧҹ</span></td>
          <td align="center"><span class="forntsarabun1">�ѧ��Ѵ</span></td>
          <td align="center"><span class="forntsarabun1">�ѹ�����¹��§ҹ</span></td>
          </tr>
        <tr>
          <td align="center"><span class="forntsarabun1">...................................</span></td>
          <td align="center"><span class="forntsarabun1">.....................................</span></td>
          <td align="center"><span class="forntsarabun1">.........................</span></td>
          <td align="center"><span class="forntsarabun1">.............................</span></td>
          </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center"><span class="forntsarabun1">(<input type="checkbox" name="checkbox32" id="checkbox41" /><input type="checkbox" name="checkbox32" id="checkbox42" />)</span></td>
          <td align="center"><span class="forntsarabun1">(<input type="checkbox" name="checkbox33" id="checkbox43" /><input type="checkbox" name="checkbox33" id="checkbox44" /> <input type="checkbox" name="checkbox34" id="checkbox45" /><input type="checkbox" name="checkbox35" id="checkbox46" /><input type="checkbox" name="checkbox36" id="checkbox47" /><input type="checkbox" name="checkbox37" id="checkbox48" />)</span></td>
        </tr>
      </table></td>
      </tr>
    <tr class="forntsarabun1">
      <td colspan="3" align="left" valign="top">�ѹ����Ѻ��§ҹ�ͧ ���.<br />
        .....................................(<input type="checkbox" name="checkbox38" id="checkbox49" /><input type="checkbox" name="checkbox38" id="checkbox50" /><input type="checkbox" name="checkbox38" id="checkbox51" /><input type="checkbox" name="checkbox38" id="checkbox52" /><input type="checkbox" name="checkbox38" id="checkbox53" /><input type="checkbox" name="checkbox38" id="checkbox54" />)</td>
      <td colspan="2" align="left" valign="top"><table  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td  align="left" valign="top" bordercolorlight="#FFFFFF" bordercolordark="#000000" class="forntsarabun1">�ѹ����Ѻ��§ҹ�ͧ �ʨ.<br />
            ...............................(<input name="checkbox39" type="checkbox"  id="checkbox55" /><input name="checkbox39" type="checkbox"  id="checkbox56" /><input type="checkbox" name="checkbox39" id="checkbox57" /><input type="checkbox" name="checkbox39" id="checkbox58" /><input type="checkbox" name="checkbox39" id="checkbox59" /><input type="checkbox" name="checkbox39" id="checkbox60" />)&nbsp;</td>
          <td  colspan="2" align="left" valign="top" bordercolorlight="#FFFFFF" bordercolordark="#000000" class="forntsarabun1">�ѹ����Ѻ��§ҹ�ͧ�ӹѡ�кҴ�Է��<br />
            .........................(<input type="checkbox" name="checkbox40" id="checkbox61" /><input type="checkbox" name="checkbox40" id="checkbox62" /><input type="checkbox" name="checkbox40" id="checkbox63" /><input type="checkbox" name="checkbox40" id="checkbox64" /><input type="checkbox" name="checkbox40" id="checkbox65" /><input type="checkbox" name="checkbox40" id="checkbox66" />)</td>
       </tr>
      </table></td>
      </tr>
  </table></TD>
</TR>
</TABLE>
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="forntsarabun1">
  <tr>
    <td width="33%" valign="top" class="font1"><p>��������ͧ���� x  㹪�ͧ 
      <input type="checkbox" name="checkbox41" id="checkbox67" />˹�Ң�ͤ�������ͧ�����С�͡��������´㹪�ͧ��ҧ���ú��ǹ��ЪѴਹ ¡���
<input type="checkbox" name="checkbox42" id="checkbox68" />
        <input type="checkbox" name="checkbox43" id="checkbox69" />

  </td>
    <td width="1%" valign="top" class="forntsarabun1">&nbsp;</td>
    <td width="66%" valign="top" class="forntsarabun1"><strong>�����</strong> <u>��ҧ�ҵԻ����� 1</u> ��� ��ǵ�ҧ�ҵԷ������Ң���ç�ҹ㹻������<br />
        <u>��ҧ�ҵԻ����� 2</u> ��� �ѡ��ͧ����ǵ�ҧ�ҵ� <u><br />
        ��ҧ�ҵԻ����� 3</u> ��� ��ǵ�ҧ�ҵԷ��������ѡ��㹻������ �������������Թ�ҧ��Ѻ����Ȣͧ��<br />      
      <br />
    </td>
    </tr>
</table>
<p>&nbsp;</p>
</form>

<?
}
?>
