<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<link rel="stylesheet" type="text/css" href="../style.css" />
<style type="text/css">
<!--
.h {
	font-family: "TH SarabunPSK";
	font-size:24px;
}
.hfont{
	font-family: "TH SarabunPSK";
	font-size:18px;
}
-->
</style>
<style type="text/css">
table.sample {
	border-width: 2px;
	border-spacing: 1px;
	border-style: none;
	border-color: black;
	border-collapse: collapse;
	background-color: white;
}
table.sample th {
	border-width: 2px;
	padding: 2px;
	/*border-style: dashed; */
	border-color: black;
	background-color: rgb(255, 245, 238);
	-moz-border-radius: ;
}
table.sample td {
	border-width: 2px;
	padding: 2px;
	/* border-style: dashed; */
	border-color: black;
	background-color: rgb(255, 245, 238);
	-moz-border-radius: ;
}
.font22{
	font-family:"TH SarabunPSK";
	font-size:18px;
	color:#00F;
}

</style>
<SCRIPT LANGUAGE="JavaScript">

	window.onload = function(){
		window.print();
		window.close();
	}

</SCRIPT>
<body>

<?

function displaydate($datex) {
	$date_array=explode("-",$datex);
	$y=$date_array[0];
	$m=$date_array[1];
	$d=$date_array[2];
	$displaydate="$d-$m-$y";
	return $displaydate;
}

include("../connect.inc");

$mysql="SELECT * FROM  `ic_infection` where row_id='".$_GET['row_id']."' ";
$myresult=mysql_query($mysql)or die(mysql_error());	
$myfetch=mysql_fetch_array($myresult);


?>
<br /><br />
<h2 class="h" align="center" style="line-height:1px;">Ẻ�ѹ�֡��õԴ������С�õԴ������ç��Һ�Ť�������ѡ�������� �ͧ�����¡��������§</h2>
<h3 class="h" align="center" style="line-height:1px;">FR-ICC-001/1,00,1  �.�. 50</h3>
<p align="center" style="line-height:1px;">.............................................................................................</p>

<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
  <tr>
    <td>
    
    <table  border="0" align="center" cellpadding="0" cellspacing="0" class="hfont" width="100%">
      <tr>
        <td colspan="8"><strong>�����ŷ���仢ͧ������</strong></td>
      </tr>
      <tr>
        <td><strong>����-ʡ��</strong></td>
        <td><?=$myfetch['ptname'];?></td>
        <td><strong>����</strong></td>
        <td><?=$myfetch['age'];?></td>
        <td><strong>�Է�ԡ���ѡ��</strong></td>
        <td ><?=$myfetch['ptright'];?></td>
        <td><strong>�������Ѿ�� </strong></td>
        <td><?=$myfetch['tel'];?></td>
      </tr>
      <tr>
        <td><strong>HN</strong></td>
        <td><?=$myfetch['hn'];?></td>
        <td><strong>AN</strong></td>
        <td><?=$myfetch['an'];?></td>
        <td><strong>�Ѻ���� �����</strong></td>
        <td><?=$myfetch['addate'];?></td>
        <td><strong>��˹��� �����  </strong></td>
        <td><?=$myfetch['dcdate'];?></td>
      </tr>
      </table>
      <table width="100%" class="hfont">
      <tr>
        <td colspan="2"><strong>����ԹԨ����ä</strong></td>
        <td colspan="4">1. <?=$myfetch['diag1'];?></td>
        <td width="65%">2. <?=$myfetch['diag2'];?></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td colspan="4">3. <?=$myfetch['diag3'];?></td>
        <td>4. <?=$myfetch['diag4'];?></td>
      </tr>
      <tr>
        <td width="11%"><strong>�ä��Шӵ��</strong></td>
        <td colspan="6"><?=$myfetch['disease'];?></td>
        </tr>
      <tr>
        <td colspan="6"><strong>����Тͧ����������ͨ�˹���</strong></td>
        <td><strong>
          <label>
            <input name="status_dc" type="radio" id="status_dc1"  value="1"  <? if($myfetch['status_dc']==1){ echo "checked='checked'";} ?>/>
          </label>
          </strong>����ó�</td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
        <td><strong>
          <input type="radio" name="status_dc" id="status_dc2"  value="2" <? if($myfetch['status_dc']==2){ echo "checked='checked'";} ?>/>
          </strong>��ͧ��á�ô��ŵ�����ͧ����ҹ</td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
        <td><strong>
          <input type="radio" name="status_dc" id="status_dc3"  value="3" <? if($myfetch['status_dc']==3){ echo "checked='checked'";} ?>/>
        </strong>
          ������Ѻ����ѡ�ҵ�ͷ�� �.�.
          <?=$myfetch['refer_host'];?></td>
      </tr>
    </table><br />
    <div class="hfont">��ǹ��� 1 �Ѩ�������§��������Դ��õԴ������ç��Һ�� �ͧ��������¹�� ��� </div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" class="hfont" style="border-collapse:collapse" bordercolor="#000000">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">�Ѩ�������§</td>
    <td align="center">�ѹ ��͹ ��</td>
  </tr>
  <tr>
    <td align="center">1.</td>
    <td>����������ǹ�������</td>
    <td align="center"><?=displaydate($myfetch['date2']);?></td>
  </tr>
  <tr>
    <td align="center">2.</td>
    <td>���������ͧ��������<strong>
<input type="radio" name="respirator" id="Respirator1"  value="��� ET-Tube" <? if($myfetch['respirator']=='��� ET-Tube'){ echo "checked='checked'";} ?>/>
</strong>��� ET-Tube<strong>
<input type="radio" name="respirator" id="Respirator2" value="��Ф�" <? if($myfetch['respirator']=='��Ф�'){ echo "checked='checked'";} ?> />
</strong> ��Ф�</td>
    <td align="center"><?=displaydate($myfetch['date3']);?></td>
  </tr>
  <tr>
    <td align="center">3.</td>
    <td>����ѵԡ�����ѡ�����,���</td>
    <td align="center"><?=displaydate($myfetch['date4']);?></td>
  </tr>
  <tr>
    <td align="center">4.</td>
    <td>��ü�ҵѴ....<?=$myfetch['surgery'];?>
<input type="radio" name="surgeryor" id="Surgeryor1" value="��� Drain"  <? if($myfetch['surgeryor']=='��� Drain'){ echo "checked='checked'";} ?>/>
��� Drain 
<input type="radio" name="surgeryor" id="Surgeryor2" value="������ Drain"  <? if($myfetch['surgeryor']=='������ Drain'){ echo "checked='checked'";} ?>/>
������ Drain</td>
    <td align="center"><?=displaydate($myfetch['date5']);?></td>
  </tr>
  <tr>
    <td align="center">5.</td>
    <td>��ä�ʹ 
      <input type="radio" name="birth" id="Birth1"  value="C/S"  <? if($myfetch['birth']=='C/S'){ echo "checked='checked'";} ?>/>
C/S 
<input type="radio" name="Birth" id="Birth2"  value="N/L" <? if($myfetch['birth']=='N/L'){ echo "checked='checked'";} ?>/>
N/L 
<input type="radio" name="birth" id="Birth3"  value="�ѵ����" <? if($myfetch['birth']=='�ѵ����'){ echo "checked='checked'";} ?> />
�ѵ����</td>
    <td align="center"><?=displaydate($myfetch['date6']);?></td>
  </tr>
  <tr>
    <td align="center">6.</td>
    <td>��÷��ѵ���õ�ҧ�...........................<?=$myfetch['procedure'];?></td>
    <td align="center"><?=displaydate($myfetch['dateproc']);?></td>
  </tr>
    </table>
<br/>
    <div class="hfont">��ǹ��� 2 �š�õԴ��������� �ѹ���Դ���......<?=displaydate($myfetch['date7']);?></div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" class="hfont" style="border-collapse:collapse;" bordercolor="#000000">
  <tr>
    <td width="7%" align="center">�ӴѺ</td>
    <td width="63%" align="center">�ҡ��</td>
    <td width="5%" align="center">��</td>
    <td width="5%" align="center">�����</td>
    <td width="20%" align="center">�ѹ�����������ҡ��</td>
  </tr>
  <tr>
    <td align="center">1.</td>
    <td>�� �ҡ���� 38 ͧ��������</td>
    <td align="center"><input type="radio" name="fever" id="fever1"  value="1" <? if($myfetch['fever']==1){ echo "checked='checked'";} ?>/></td>
    <td align="center"><input type="radio" name="fever" id="fever2"  value="2" <? if($myfetch['fever']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($myfetch['date8']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">2.</td>
    <td>������СлԴ�л���<br />�Ǵ��ͧ����<br />���纺���ǳ����˹��</td>
    <td align="center"><input type="radio" name="urine" id="Urine1"  value="1"  <? if($myfetch['urine']==1){ echo "checked='checked'";} ?>/><br /><input type="radio" name="abdominal" id="abdominal1"  value="1" <? if($myfetch['abdominal']==1){ echo "checked='checked'";} ?>/><br /><input type="radio" name="pubis" id="pubis1"  value="1" <? if($myfetch['pubis']==1){ echo "checked='checked'";} ?>/></td>
    <td align="center"><input type="radio" name="urine" id="Urine2"  value="2" <? if($myfetch['urine']==2){ echo "checked='checked'";} ?>/><br /><input type="radio" name="abdominal" id="abdominal2"  value="2" <? if($myfetch['abdominal']==2){ echo "checked='checked'";} ?>/><br /><input type="radio" name="pubis" id="pubis2"  value="2" <? if($myfetch['pubis']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($myfetch['date9']);?><br /><?=displaydate($myfetch['date10']);?><br /><?=displaydate($myfetch['date11']);?></td>
  </tr>
  <tr>
    <td align="center">3.</td>
    <td>�� ������� ������ / �����</td>
    <td align="center"><input type="radio" name="cough" id="cough1"  value="1"  <? if($myfetch['cough']==1){ echo "checked='checked'";} ?>/></td>
        <td align="center"><input type="radio" name="cough" id="cough2"  value="2" <? if($myfetch['cough']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($myfetch['date12']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">4.</td>
    <td>�ż�ҵѴ �ѡ�ʺ ��� ��˹ͧ<br />����纺�� / ᴧ /�¡ /��˹ͧ<br />
    ��Ӥ�ǻ���ա�������</td>
 <td align="center">
 <input type="radio" name="wound" id="wound1"  value="1" <? if($myfetch['wound']==1){ echo "checked='checked'";} ?>/><br />
 <input type="radio" name="episiotomy" id="episiotomy1"  value="1" <? if($myfetch['episiotomy']==1){ echo "checked='checked'";} ?>/><br />
 <input type="radio" name="smell" id="smell1"  value="1"/ <? if($myfetch['smell']==1){ echo "checked='checked'";} ?>></td>
    <td align="center">
<input type="radio" name="wound" id="wound2"  value="2" <? if($myfetch['wound']==2){ echo "checked='checked'";} ?>/><br />
<input type="radio" name="episiotomy" id="episiotomy2"  value="2" <? if($myfetch['episiotomy']==2){ echo "checked='checked'";} ?>/><br />
<input type="radio" name="smell" id="smell2"  value="2" <? if($myfetch['smell']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($myfetch['date13']);?><br /><?=displaydate($myfetch['date14']);?><br /><?=displaydate($myfetch['date15']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">5.</td>
    <td>���˹ѧ����ǳ�����ѵ���� ��� ᴧ �ѡ�ʺ ��˹ͧ</td>
    <td align="center"><input type="radio" name="skin" id="skin1"  value="1" <? if($myfetch['skin']==1){ echo "checked='checked'";} ?>/></td>
        <td align="center"><input type="radio" name="skin" id="skin2"  value="2" <? if($myfetch['skin']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($myfetch['date16']);?></td>
  </tr>
    </table>
<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr class="hfont">
            <td><strong>����ԹԨ������ͧ��</strong></td>
            <td><label>
              <input type="radio" name="initial_diag" id="initial_diag1"  value="1" <? if($myfetch['initial_diag']==1){ echo "checked='checked'";} ?>/>
            </label>
              �Ҵ��ҹ�Ҩ��ա�õԴ���ͨҡ�ç��Һ��</td>
        </tr>
          <tr class="hfont">
            <td>&nbsp;</td>
            <td><label>
              <input type="radio" name="initial_diag" id="initial_diag2"  value="0" <? if($myfetch['initial_diag']==0){ echo "checked='checked'";} ?>/>
            </label>              ��辺���С�õԴ���ͨҡ��õԴ���������ѧ </td>
        </tr>
      </table>
    
    
    
    </td>
   </tr>
    </table>  
    
    </body>
</html>