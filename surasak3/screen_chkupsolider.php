<?php
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.txtform {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<form action="<?=$PHP_SELF;?>" method="post" name="form1">
<input name="act" type="hidden" value="show">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" align="center"><strong>��سҡ�͡ HN ���ͤ��Ң�����</strong></td>
    </tr>
  <tr>
    <td width="43%" align="right"><strong>HN&nbsp;:</strong>&nbsp;</td>
    <td width="13%"><label>
      <input name="hn" type="text" class="txtform" id="hn">
    </label></td>
    <td width="44%"><label>
      &nbsp;
      <input name="button" type="submit" class="txtform" id="button" value="  ����  ">
    </label></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><a target=_self  href='../nindex.htm'>��Ѻ���˹��������ѡ</a></td>
    </tr>
</table>
</form>
<?
if($_POST["act"]=="show"){

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
		$chkupyear="25$nPrefix";
	////*runno ��Ǩ�آ�Ҿ*/////////

$sql="select * from condxofyear_so where hn='$_POST[hn]' and yearcheck='$chkupyear' order by row_id desc limit 1";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
if($num < 1){
	echo "<script>alert('!!! �Դ��Ҵ...��辺 HN ����ҹ��ͧ��ä���');window.location='screen_chkupsolider.php';</script>";
}
$rows=mysql_fetch_array($query);

	$sql1="select * from opcard where hn='$rows[hn]'";
	$query1=mysql_query($sql1);
	$result=mysql_fetch_array($query1);
	list($dy,$dm,$dd)=explode("-",$result["dbirth"]);
	$dy=$dy-543;
	$birhtday="$dy-$dm-$dd";
?>
<div style="border:#000000 solid 1px; margin-left: 10px; margin-right: 10px;">
<form name="form2" method="post" action="">
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="5" >
  <tr>
    <td align="center"><strong>���Ǩ��ФѴ��ͧ��������§����آ�Ҿ��Шӻ� 
        <?=$chkupyear;?>
    </strong></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">�Ţ���
      <input name="no" type="text" class="txtform" id="no" autofocus>      </td>
  </tr>
  <tr>
    <td align="right">˹��º�ԡ�÷������ԡ�õ�Ǩ�Ѵ��ͧ
      <input name="hospital" type="text" class="txtform" id="hospital" value="�ç��Һ�Ť�������ѡ��������">
      &nbsp;�Ţ���ʶҹ��Һ�� 
      <input name="hcode" type="text" class="txtform" id="hcode" value="11512" maxlength="5"></td>
  </tr>
  <tr>
    <td align="right">�ѹ����Ǩ&nbsp;
      <input name="datechkup" type="text" class="txtform" id="datechkup" value="<?=date("Y-m-d");?>"></td>
  </tr>
  <tr>
    <td align="left"><strong>�����ŷ����</strong></td>
  </tr>
  <tr>
    <td align="left">�����Ţ�ѵû�Шӵ�ǻ�ЪҪ� 
      <input name="idcard" type="text" class="txtform" id="idcard" value="<?=$result["idcard"];?>" maxlength="13"></td>
  </tr>
  <tr>
    <td align="left">�Ȫ��� 
      <input name="name" type="text" class="txtform" id="name" value="<?=$result["yot"]." ".$result["name"];?>">
      &nbsp;���ʡ�� 
      <input name="surname" type="text" class="txtform" id="surname" value="<?=$result["surname"];?>">
      &nbsp;
      <input name="type" type="radio" id="radio" value="1" checked>
      ����Ҫ���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="type" id="radio2" value="2">
      �١��ҧ��Ш�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="type" id="radio3" value="3">
      ��ѡ�ҹ�Ҫ���</td>
  </tr>
  <tr>
    <td align="left">�ѹ��͹���Դ 
      <input name="birthday" type="text" class="txtform" id="birthday" value="<?=$birhtday;?>">
      &nbsp;���� 
      <input name="age" type="text" class="txtform" id="age" value="<?=$rows["age"];?>"></td>
  </tr>
  <tr>
    <td align="left">�������Ѩ�غѹ 
      <input name="address" type="text" class="txtform" id="address" value="<?=$result["address"];?>" size="10">
      &nbsp;�Ӻ� 
      <input name="tambol" type="text" class="txtform" id="tambol" value="<?=$result["tambol"];?>" size="15">      
      &nbsp;����� 
      <input name="ampur" type="text" class="txtform" id="ampur" value="<?=$result["ampur"];?>" size="15">
      &nbsp;�ѧ��Ѵ 
      <input name="changwat" type="text" class="txtform" id="changwat" value="<?=$result["changwat"];?>" size="15">
      &nbsp;������ɳ�� 
      <input name="zipcode" type="text" class="txtform" id="zipcode" value="" size="10"></td>
  </tr>
  <tr>
    <td align="left">���Ѿ����ӧҹ 
      <input name="telwork" type="text" class="txtform" id="telwork" value="">
      &nbsp;���Ѿ����Ͷ�� 
      <input name="tel" type="text" class="txtform" id="tel" value="<?=$result["phone"];?>"></td>
  </tr>
  <tr>
    <td align="left"><strong>1. ����ѵ���ǹ�ؤ��</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left: 20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="9%">��</td>
          <td width="15%"><input type="radio" name="gender" id="radio4" value="m" <? if($result["sex"]=="�"){ echo "checked";}?>>
            ���</td>
          <td width="17%"><input type="radio" name="gender" id="radio5" value="f" <? if($result["sex"]=="�"){ echo "checked";}?>>
            ˭ԧ</td>
          <td width="17%">&nbsp;</td>
          <td width="42%">&nbsp;</td>
        </tr>
        <tr>
          <td>����֡��</td>
          <td><input type="radio" name="edu" id="radio6" value="1">
            ��ж��֡��</td>
          <td><input type="radio" name="edu" id="radio7" value="2">
�Ѹ���֡��</td>
          <td><input type="radio" name="edu" id="radio8" value="3"> 
            ͹ػ�ԭ�</td>
          <td><input type="radio" name="edu" id="radio9" value="4"> 
            ��ԭ�ҵ��/�٧����</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>2. ����ѵԤ�ͺ����</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left: 20px;"><strong>�Դ� ���� ��ô� �ͧ��ҹ�ջ���ѵԡ���纻��´����ä<br>
    </strong>
        <table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td width="38%"><input type="radio" name="fm" id="radio10" value="dm">
              ����ҹ (DM)</td>
            <td width="62%"><input type="radio" name="fm" id="radio10" value="crf">
              ����������ѧ (CRF)</td>
          </tr>
          <tr>
            <td><input type="radio" name="fm" id="radio11" value="ht">
�����ѹ���Ե�٧ (HT)</td>
            <td><input type="radio" name="fm" id="radio11" value="copd">
              �ا���觾ͧ (COPD)</td>
          </tr>
          <tr>
            <td><input type="radio" name="fm" id="radio12" value="mi">
������������㨵�� (MI)</td>
            <td><input type="radio" name="fm" id="radio12" value="stroke">
              ������ʹ��ͧᵡ /�պ ����ҵ ����ġ�� (STROKE)</td>
          </tr>
          <tr>
            <td><input type="radio" name="fm" id="radio13" value="gout">
�ä�ҵ� (GOUT)</td>
            <td><input type="radio" name="fm" id="radio13" value="other">
            ���� �� �Ѵ��, �Һʹ �к� 
              <input type="text" name="otherdetail" id="otherdetail"></td>
          </tr>
          <tr>
            <td><input type="radio" name="fm" id="radio14" value="deny">
����Һ</td>
            <td><input type="radio" name="fm" id="radio14" value="not">
              �����</td>
          </tr>
        </table>
    
    </div>    </td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left: 20px;"><strong>�Դ� ���� ��ô� ���ª��Ե�����ä�����������<br>
      </strong>
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="38%"><input type="radio" name="fm" id="radio15" value="dm">
                �Դ������ô��ѧ�ժ��Ե����</td>
              <td width="62%"><input type="radio" name="fm" id="radio15" value="crf">
                �Դ�������ô����ª��Ե�����ä���</td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio16" value="ht">
                �Դ����ª��Ե�����ä����</td>
              <td><input type="radio" name="fm" id="radio16" value="copd">
                ��ô����ª��Ե�����ä����</td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio17" value="mi">
                ��駺Դ������ô����ª��Ե�����ä����</td>
              <td>&nbsp;</td>
            </tr>
          </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left: 20px;"><strong>����ͧ (��µç) �ͧ��ҹ�ջ���ѵԡ���纻��´����ä<br>
      </strong>
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="38%"><input type="radio" name="fm" id="radio18" value="dm">
                ����ҹ (DM)</td>
              <td width="62%"><input type="radio" name="fm" id="radio18" value="crf">
                ����������ѧ (CRF)</td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio19" value="ht">
                �����ѹ���Ե�٧ (HT)</td>
              <td><input type="radio" name="fm" id="radio19" value="copd">
                �ا���觾ͧ (COPD)</td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio20" value="mi">
                ������������㨵�� (MI)</td>
              <td><input type="radio" name="fm" id="radio20" value="stroke">
                ������ʹ��ͧᵡ /�պ ����ҵ ����ġ�� (STROKE)</td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio21" value="gout">
                �ä�ҵ� (GOUT)</td>
              <td><input type="radio" name="fm" id="radio21" value="other">
                ���� �� �Ѵ��, �Һʹ �к�
                <input type="text" name="otherdetail2" id="otherdetail2"></td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio22" value="deny">
                ����Һ</td>
              <td><input type="radio" name="fm" id="radio22" value="not">
                �����</td>
            </tr>
          </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>3. ��ҹ�ջ���ѵԡ���纻��� ���͵�ͧ��ᾷ�� �����ä</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="22%">- ����ҹ (DM)</td>
    <td width="16%"><input type="radio" name="radio23" id="radio23" value="radio23">
      �����</td>
    <td width="62%"><input type="radio" name="radio25" id="radio25" value="radio25">
      ��&nbsp;( 
      <input type="radio" name="radio26" id="radio26" value="radio26">
      �Ѻ��зҹ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio27" value="radio27">
      ����Ѻ��зҹ�� )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio24" value="radio24">
      ����µ�Ǩ</td>
  </tr>
  <tr>
    <td>- �����ѹ���Ե�٧ (HT)</td>
    <td><input type="radio" name="radio23" id="radio28" value="radio23">
      �����</td>
    <td><input type="radio" name="radio25" id="radio29" value="radio25">
      ��&nbsp;(
      <input type="radio" name="radio26" id="radio30" value="radio26">
      �Ѻ��зҹ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio31" value="radio27">
      ����Ѻ��зҹ�� )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio27" value="radio24">
      ����µ�Ǩ</td>
  </tr>
  
  <tr>
    <td>- �ä�Ѻ</td>
    <td><input type="radio" name="radio23" id="radio33" value="radio23">
      �����</td>
    <td><input type="radio" name="radio25" id="radio34" value="radio25">
      ��&nbsp;(
      <input type="radio" name="radio26" id="radio35" value="radio26">
      �Ѻ��зҹ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio36" value="radio27">
      ����Ѻ��зҹ�� )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio32" value="radio24">
      ����µ�Ǩ</td>
  </tr>
  
  <tr>
    <td>- �ä����ҵ</td>
    <td><input type="radio" name="radio23" id="radio38" value="radio23">
      �����</td>
    <td><input type="radio" name="radio25" id="radio39" value="radio25">
      ��&nbsp;(
      <input type="radio" name="radio26" id="radio40" value="radio26">
      �Ѻ��зҹ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio41" value="radio27">
      ����Ѻ��зҹ�� )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio37" value="radio24">
      ����µ�Ǩ</td>
  </tr>
  
  <tr>
    <td>- �ä����</td>
    <td><input type="radio" name="radio23" id="radio43" value="radio23">
      �����</td>
    <td><input type="radio" name="radio25" id="radio44" value="radio25">
      ��&nbsp;(
      <input type="radio" name="radio26" id="radio45" value="radio26">
      �Ѻ��зҹ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio46" value="radio27">
      ����Ѻ��зҹ�� )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio42" value="radio24">
      ����µ�Ǩ</td>
  </tr>
  
  <tr>
    <td>- ��ѹ����ʹ�Դ����</td>
    <td><input type="radio" name="radio23" id="radio48" value="radio23">
      �����</td>
    <td><input type="radio" name="radio25" id="radio49" value="radio25">
      ��&nbsp;(
      <input type="radio" name="radio26" id="radio50" value="radio26">
      �Ѻ��зҹ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio51" value="radio27">
      ����Ѻ��зҹ�� )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio47" value="radio24">
      ����µ�Ǩ</td>
  </tr>
  
  <tr>
    <td>- �ŷ�����/�Ѵ�� (�ҡ����ҹ)</td>
    <td><input type="radio" name="radio23" id="radio52" value="radio23">
      �����</td>
    <td><input type="radio" name="radio25" id="radio53" value="radio25">
      ��</td>
  </tr>
  <tr>
    <td>- ��ʹ�صù��˹ѡ�Թ 4 ���š���</td>
    <td><input type="radio" name="radio23" id="radio56" value="radio23">
      �����</td>
    <td><input type="radio" name="radio25" id="radio57" value="radio25">
      ��</td>
  </tr>
</table>

    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>��ͺ�շ���ҹ�� ����㹢�й���ҹ���ҡ�üԴ���������վĵԡ������仹���������</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="59%">- ������Ӻ�������ҡ</td>
    <td width="15%"><input type="radio" name="radio23" id="radio54" value="radio23" />
�����</td>
    <td width="26%"><input type="radio" name="radio25" id="radio55" value="radio25" />
��</td>
  </tr>
  <tr>
    <td>- ������С�ҧ�׹ 3 ���駢���</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- �Թ������ŧ</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- ���˹ѡŴ/��͹����</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- ���ŷ������ջҡ���� �������ҡ</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- �ѹ������˹ѧ ����������׺�ѹ���</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- �Ҿ������ ��ͧ����¹��蹺���</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- �һ������ ������� ������Һ���˵�</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- �ա�͹�����������ʹ����㹻������</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- �Һ�� ��Һ����� 2 ��ҧ ����˹ѧ�Һ��</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- ��������ѧ</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- ��˹��͡�ç��ҧ�ҡ���� 5 �ҷ� ����͹㨨ТҴ�����Ѻ�˧����͡</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- ��鹺ѹ�仪�� 2 ���͢���оҹ��� ��ͧ����ͺ������ش�ѡ</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- ������͹�Դ����</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- �����ʹ ���͹���͡�Դ�������١ / �� / ��ǹ�</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- ����Դ��͡ѹ�ҹ�ҡ���� 2 �ѻ����</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- ��ͧ�����ҡ���� 3 ���駵���ѹ �Թ 2 �ѻ����</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- ���ҡ�õ������ͧ ���͵�����ͧ</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- ���ҡ��ᢹ ���͢���͹�ç ��ҧ㴢�ҧ˹�����ͷ���ͧ��ҧ</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td>- �Ǵ, ���, ᴧ ��͹⤹������������� ������ ������ �Թ��趹Ѵ</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
  <tr>
    <td> &nbsp;&nbsp;(��ѧ�Թ�����ѵ�� �ѵ��ա ����ͧ��ѵ�� ����� �����)</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- �����������֡���</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      �����</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      ��</td>
  </tr>
</table>

    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>�ó����ä / �ҡ�ôѧ����Ƿ�ҹ��ԺѵԵ����ҧ��</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td width="38%"><input type="radio" name="fm" id="radio58" value="dm" />
          �Ѻ����ѡ������ / ��ԺѵԵ�����ᾷ���й�</td>
        </tr>
      <tr>
        <td><input type="radio" name="fm" id="radio59" value="ht" />
          �ѡ���������������</td>
        </tr>
      <tr>
        <td><input type="radio" name="fm" id="radio60" value="mi" />
          ���ѡ�� �袳й������ѡ�� / ���ҷҹ�ͧ</td>
        </tr>
    </table>
    </div>    </td>
  </tr>
  <tr>
    <td align="left"><strong>4. ������������͹����͡�ç / �͡���ѧ���</strong></td>
  </tr>
  <tr>
    <td align="left">4.1 �͡���ѧ��������آ�Ҿ / ��蹡��� ����</td>
  </tr>
  <tr>
    <td align="left">4.2 �ա���͡�ç��дѺ�ҹ��ҧ���� �� ��ҧö �ٺ�ҹ ��˹�ҵ�ҧ ���ǹ �ش�Թ ����㹨ѧ�������</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��鹺ѹ� �Թ���� ���ѡ��ҹ ���</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(��ҷ�ҹ��ԺѵԵ����� 4.1 ���� 4.2 ������ 30 �ҷբ��� ���ͪ�ǧ�� 10 �ҷ� ��������ѹ����� 30 �ҷյ���ѹ</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��º��ҡѺ������͡���ѧ�����ѹ���)</td>
  </tr>
  <tr>
    <td align="left"><strong>�������͹����͡�ç / ����͡���ѧ��� �ͧ��ҹ���ࡳ�����</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td width="38%"><input type="radio" name="fm" id="radio61" value="dm" />
          ����͡���ѧ������</td>
        <td width="62%"><input type="radio" name="fm" id="radio61" value="crf" />
          �͡���ѧ����ѻ������ 1-2 �ѹ</td>
      </tr>
      <tr>
        <td><input type="radio" name="fm" id="radio62" value="ht" />
          �͡���ѧ����ѻ������ 3-6 �ѹ</td>
        <td><input type="radio" name="fm" id="radio62" value="copd" />
          �͡���ѧ��·ء�ѹ</td>
      </tr>
    </table>
    </div>    </td>
  </tr>
  <tr>
    <td align="left"><strong>5. ��ҹ�ͺ�������� (�ͺ���ҡ����� 1 ���)</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="23%"><input type="checkbox" name="checkbox" id="checkbox" />            
            ��ҹ</td>
          <td width="22%"><input type="checkbox" name="checkbox2" id="checkbox2" />
            ���</td>
          <td width="21%"><input type="checkbox" name="checkbox3" id="checkbox3" />
            �ѹ</td>
          <td width="34%"><input type="checkbox" name="checkbox4" id="checkbox4" />
            ���ͺ�ء���</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>6. ����ʾ�Դ</strong></td>
  </tr>
  <tr>
    <td align="left"><strong>�ٺ������</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio63" value="dm" />
            ������ٺ</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio64" value="ht" />
            ���ٺ����ԡ����</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td width="38%"><input type="radio" name="fm" id="radio66" value="dm" />
                  ��ԡ�ٺ���¡��� 6 ��͹</td>
                <td width="62%"><input type="radio" name="fm" id="radio66" value="crf" />
                  ��ԡ�ٺ 6 ��͹����</td>
              </tr>
            </table>
          </div></td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio65" value="mi" />
            �ٺ�繤��駤������ء�ѹ</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio67" value="mi" />
�ٺ�繻�Шӷء�ѹ</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>��������</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio68" value="dm" />
            ����´���</td>
          <td width="62%"><input type="radio" name="fm" id="radio68" value="crf" />
            �´�������ԡ����</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio69" value="ht" />
            �����繤��駤���</td>
          <td><input type="radio" name="fm" id="radio69" value="copd" />
            �����繻�Ш� 
              <input name="textfield" type="text" id="textfield" size="5" />
              �ѹ / �ѻ����</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>7. ��Ҿ����Թ�ͧ��ҹ�����ҧ��</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio70" value="dm" />
            ���Թ������� �������������</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio71" value="ht" />
            ���Թ�������������͹����ͧ������ ������������</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio72" value="mi" />
            �����������е�ͧ������</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio73" value="mi" /> 
            ���� �к� 
              <input type="text" name="textfield2" id="textfield2" /></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>��ҹ��˹���������</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio74" value="dm" />
            �����</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio75" value="ht" />
            ��</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="38%"><input type="radio" name="fm" id="radio76" value="dm" />
                    &lt; 50,000 �ҷ</td>
                  <td width="62%"><input type="radio" name="fm" id="radio76" value="crf" />
                    50,000 - 100,000 �ҷ</td>
                </tr>
                <tr>
                  <td><input type="radio" name="fm" id="radio79" value="dm" />
                    100,001 - 1,000,000 �ҷ</td>
                  <td><input type="radio" name="fm" id="radio79" value="crf" />
                    &gt; 1,000,000 �ҷ</td>
                </tr>
              </table>
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>8. �غѵ��˵�</strong></td>
  </tr>
  <tr>
    <td align="left"><strong>8.1 ��ѧ��ô�������, �����, �ǹ� ��� ��ҹ�Ѻö�������</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio77" value="dm" />
            ���Ѻö��ѧ����</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio78" value="ht" />
            �Ѻ�ҧ����</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio80" value="mi" />
            �Ѻ�ء������ѧ����</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>8.2 ��û�ͧ�ѹ�غѵ��˵� ����Ѻ���Ѻ��� ���������ö�ѡ��ҹ¹�� ��ҹ�����ǡ�ѹ��ͤ�������</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio81" value="dm" />
            ���ء����</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio82" value="ht" />
            ���ҧ����</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio83" value="mi" />
            ��������</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>8.3 ��ҹ�Ѻ���ö¹�������繼������ù�觢�ҧ˹�� ��ҹ�Ҵ����Ѵ�������������</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio84" value="dm" />
            �Ҵ�ء����</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio85" value="ht" />
            �Ҵ�ҧ����</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio86" value="mi" />
            ���Ҵ</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>8.4 ��ҹ����������ѹ��Ѻ ˭ԧ/��� ���������������������</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio87" value="dm" />
            �����</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio88" value="ht" />
            �� ����·�ҹ��Ф��͹��ا�ҧ͹�����������</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="28%"><input type="radio" name="fm" id="radio89" value="dm" />
                    �������</td>
                  <td width="30%"><input type="radio" name="fm" id="radio89" value="crf" />
                    ��ҧ����</td>
                  <td width="42%"><input type="radio" name="fm" id="radio90" value="crf" />
��ء����</td>
                </tr>
              </table>
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>9. �������´</strong></td>
  </tr>
  <tr>
    <td align="left"><strong>�ѭ�ҷ�������ҹ���´�ҡ����ش</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="31%"><input type="radio" name="fm" id="radio91" value="dm" />
            �ҹ�˹�ҷ��</td>
          <td width="35%"><input type="radio" name="fm" id="radio91" value="crf" />
            �ѭ��㹤�ͺ����</td>
          <td width="34%"><input type="radio" name="fm" id="radio93" value="crf" />
�ѭ�ҡ���Թ</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio92" value="ht" />
            �ѭ�ҡ�����ͧ</td>
          <td><input type="radio" name="fm" id="radio92" value="copd" />
            ���� �к� 
              <input type="text" name="textfield3" id="textfield3" /></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>10. ��Ҿ�Ǵ����</strong></td>
  </tr>
  <tr>
    <td align="left"><strong>��Ҿ�Ǵ��������ǳ���ѡ����¢ͧ��ҹ���ѡɳ������ҧ��</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio94" value="dm" />
            ���Ҵ�� �ա���红�����������繻�Ш�</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio95" value="ht" />
            ��͹��ҧʡ�á �ա���红���繤��駤���</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio96" value="mi" />
          ʡ�á�ҡ �ա�÷�駢������͹��Ҵ</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio97" value="mi" /> 
            ���� �к� 
              <input type="text" name="textfield4" id="textfield4" /></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>��Ҿ�Ǵ����㹷��ӧҹ�ͧ��ҹ���ѡɳ����ҧ�� (�ͺ���ҡ���� 1 ���)</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="checkbox" name="checkbox5" id="checkbox5" />            
            ���Ҵ</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="checkbox9" id="checkbox9" /> 
            ��͹��ҧʡ�á</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="checkbox6" id="checkbox6" />            
            ���ʧ���ҧ��§��</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="checkbox7" id="checkbox7" />            
            ��͹��ҧ�״</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="checkbox10" id="checkbox10" /> 
            �Ѻ᤺</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="checkbox8" id="checkbox8" />
            ���� �к�
            <input type="text" name="textfield5" id="textfield5" /></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>����Ѻ���˹�ҷ��</strong></td>
  </tr>
  <tr>
    <td align="left"><strong>11. ��õ�Ǩ��ҧ���</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td colspan="2">���˹ѡ 
            <input type="text" name="weight" id="weight" value="<?=$rows["weight"];?>" class="txtform" /> 
            ��. &nbsp;��ǹ�٧ 
            <input type="text" name="height" id="height" value="<?=$rows["height"];?>" class="txtform" />
            ��. &nbsp;BMI 
            <input type="text" name="bmi" id="bmi" value="<?=$rows["bmi"];?>" class="txtform" />
            ��./�</td>
        </tr>
        <tr>
          <td colspan="2">����ͺ��� (�Ѵ��ҹ�д��) 
            <input type="text" name="round_cm" id="round_cm" value="<?=$rows["round_"];?>" class="txtform"  />
            ��. (
            <input type="text" name="round_inc" id="round_inc" value="<?=number_format($rows["round_"]/2.54,2);?>" class="txtform" />
            ����)</td>
        </tr>
        <tr>
          <td>�վ�� 
            <input type="text" name="pause" id="pause" value="<?=$rows["pause"];?>" class="txtform" /> 
            ����/�ҷ�, </td>
          <td>�����ѹ���Ե (���駷�� 1)
            <input type="text" name="bp11" id="bp11" value="<?=$rows["bp1"]."/".$rows["bp2"];?>" class="txtform" />
��. ��ͷ</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>�����ѹ���Ե (���駷�� 2)
            <input name="bp21" type="text" class="txtform" id="bp21" value="" />
��. ��ͷ</td>
        </tr>
        <tr>
          <td colspan="2">(�Ѵ�����ѹ���Ե���駷�� 2 ੾�Сóշ���Ѵ�����á�Դ���� ��кѹ�֡��ҷ�軡�����������§�����ҡ����ش)</td>
        </tr>
        <tr>
          <td colspan="2"><strong>��õ�Ǩ��ҧ��µ���к�</strong></td>
        </tr>
        <tr>
          <td colspan="2"><textarea name="textarea" id="textarea" cols="45" rows="5"></textarea></td>
        </tr>
        <tr>
          <td colspan="2">ᾷ�����Ǩ 
            <input type="text" name="textfield6" id="textfield6" /></td>
        </tr>
        <tr>
          <td colspan="2"><strong>�ѹ�ᾷ�� : �آ�Ҿ��ͧ�ҡ</strong></td>
        </tr>
        <tr>
          <td colspan="2"><input name="radio98" type="radio" class="txtform" id="radio98" value="radio98" />
            ����</td>
        </tr>
        <tr>
          <td colspan="2"><input name="radio99" type="radio" class="txtform" id="radio99" value="radio99" />
            ��軡��</td>
        </tr>
        <tr>
          <td width="29%"><strong>�ä�ѹ</strong></td>
          <td width="71%"><strong>�ä�˧�͡</strong></td>
        </tr>
        <tr>
          <td><input type="radio" name="radio100" id="radio100" value="radio100" />
            �ѹ��</td>
          <td><input type="radio" name="radio100" id="radio100" value="radio100" />
            �ä�˧�͡�ѡ�ʺ</td>
        </tr>
        <tr>
          <td><input type="radio" name="radio101" id="radio101" value="radio101" />
            �ѹ�֡</td>
          <td><input type="radio" name="radio101" id="radio101" value="radio101" />
            �ä��Էѹ���ѡ�ʺ</td>
        </tr>
        <tr>
          <td><input type="radio" name="radio102" id="radio102" value="radio102" />
            �ѹ�ش</td>
          <td>����Ǩ 
            <input type="text" name="textfield15" id="textfield15" /></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>��ػ���ͧ��</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="100%"><input type="radio" name="fm" id="radio106" value="dm" />
            ��辺��������§</td>
          </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio103" value="dm" />
����������§���ͧ�鹵���ä</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td width="21%"><input type="radio" name="fm" id="radio104" value="dm" />
                DM</td>
                <td width="22%"><input type="radio" name="fm" id="radio104" value="crf" />
                  HT</td>
                <td width="22%"><input type="radio" name="fm" id="radio105" value="crf" /> 
                  Stroke</td>
                <td width="35%"><input type="radio" name="fm" id="radio107" value="crf" /> 
                  Obesity</td>
              </tr>
            </table>
          </div></td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio108" value="dm" />
            ���´����ä������ѧ</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td width="21%"><input type="radio" name="fm" id="radio109" value="dm" />
                  DM</td>
                <td width="22%"><input type="radio" name="fm" id="radio109" value="crf" />
                  HT</td>
                <td width="22%"><input type="radio" name="fm" id="radio110" value="crf" />
                  Stroke</td>
                <td width="35%"><input type="radio" name="fm" id="radio111" value="crf" />
                  Obesity</td>
              </tr>
            </table>
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>12. �ó������Թ 35 �բ��� �ջ���ѵ�����§ ��Ф�� BMI &gt; 25 ��/� ���Թ��õ�Ǩ Total Cholesterol</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio112" value="dm" />
            ��Ǩ</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio113" value="ht" />
            ����Ǩ</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>��ô��Թ�ҹ</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio114" value="dm" />
            �����йС�ô��ŵ��ͧ ��е�Ǩ�Ѵ��ͧ��ӷء 1 ��</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio115" value="ht" />
            ŧ����¹���������§��͡�����ä Metabolic ����й�����ç��û�Ѻ����¹�ĵԡ���</td>
        </tr>
        <tr>
          <td><input type="radio" name="radio116" id="radio116" value="radio116" />
            �觵�������ѡ��</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>��ػ�š�õ�Ǩ�آ�Ҿ��Шӻ�</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="100%"><input type="radio" name="fm" id="radio117" value="dm" />
            ����</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio118" value="dm" />
            �ջѨ�������§�����Դ�ä (�Դ������硹���)</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="21%"><input type="radio" name="fm" id="radio119" value="dm" />
                    Overweight</td>
                  <td width="22%"><input type="radio" name="fm" id="radio119" value="crf" />
                    Hyperuricemia</td>
                  <td width="22%"><input type="radio" name="fm" id="radio120" value="crf" />
                    Anemia</td>
                  <td width="35%"><input type="radio" name="fm" id="radio121" value="crf" />
                    HLD</td>
                </tr>
                <tr>
                  <td><input type="radio" name="fm" id="radio126" value="dm" />
                    Impaired FG</td>
                  <td><input type="radio" name="fm" id="radio126" value="crf" />
                    Renal insufficiency</td>
                  <td><input type="radio" name="fm" id="radio127" value="crf" />
                    Mild hepatitis</td>
                  <td><input type="radio" name="fm" id="radio128" value="crf" />
                    Other 
                      <input type="text" name="textfield16" id="textfield16" /></td>
                </tr>
              </table>
          </div></td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio122" value="dm" />
          ���ä 
            <input type="text" name="textfield17" id="textfield17" /></td>
        </tr>
        <tr>
          <td>ŧ���� 
            <input name="textfield18" type="text" class="txtform" id="textfield18" value="<?=$rows["doctor"];?>" size="25" /> 
            ᾷ�����Ǩ</td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</form>
</div>
<?
}  //close if show
?>