<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.forminput {
	font-family: TH SarabunPSK;
	font-size: 20px;	
}
.profilelab {	font-family: "TH Sarabun New";
	font-size: 18px;
	color: #000;
	font-weight: bold;
}
-->
</style>
<?
include("connect.inc");
if($_POST["act"]=="add"){
$ht = $_POST["height"]/100;
$bmi=number_format($_POST["weight"] /($ht*$ht),2);
$thidate=date("Y-m-d H:i:s");
$date=date("Y-m-d");
$thdatehn=$date.$_POST["hn"];

		$add="insert into dxofyear set thidate='$thidate',
														thdatehn='$thdatehn',
														hn='$_POST[hn]',
														ptname='$_POST[ptname]',
														age='$_POST[age]',
														camp='$_POST[camp]',
														height='$_POST[height]',
														weight='$_POST[weight]',
														round_='$_POST[round_]',
														temperature='$_POST[temperature]',
														pause='$_POST[pause]',
														rate='$_POST[rate]',
														bmi='$bmi',
														bp1='$_POST[bp1]',
														bp2='$_POST[bp2]',
														drugreact='$_POST[drugreact]',
														prawat='$_POST[prawat]',
														congenital_disease='$_POST[congenital_disease]',
														type='$_POST[type]',
														organ='$_POST[organ]',
														doctor='$_POST[doctor]',
														clinic='$_POST[clinic]',
														cigarette='$_POST[cigarette]',
														alcohol='$_POST[alcohol]',
														exercise='$_POST[exercise]',
														ua_color='$_POST[color]',
														ua_appear='$_POST[appear]',
														ua_spgr='$_POST[spgr]',
														ua_phu='$_POST[phu]',
														ua_bloodu='$_POST[bloodu]',
														ua_prou='$_POST[prou]',
														ua_gluu='$_POST[gluu]',
														ua_ketu='$_POST[ketu]',
														ua_urobil='$_POST[urobil]',
														ua_bili='$_POST[bili]',
														ua_nitrit='$_POST[nitrit]',
														ua_wbcu='$_POST[wbcu]',
														ua_rbcu='$_POST[rbcu]',
														ua_epiu='$_POST[epiu]',
														ua_bactu='$_POST[bactu]',
														ua_yeast='$_POST[yeast]',
														ua_mucosu='$_POST[mucosu]',
														ua_amopu='$_POST[amopu]',
														ua_castu='$_POST[castu]',
														ua_crystu='$_POST[crystu]',
														ua_otheru='$_POST[otheru]',
														cbc_wbc='$_POST[wbc]',
														wbcrange='$_POST[wbcrange]',
														cbc_rbc='$_POST[rbc]',
														cbc_hb='$_POST[hb]',
														cbc_hct='$_POST[hct]',
														hctrange='$_POST[hctrange]',
														cbc_mcv='$_POST[mcv]',
														cbc_mch='$_POST[mch]',
														cbc_mchc='$_POST[mchc]',
														cbc_pltc='$_POST[pltc]',
														pltcrange='$_POST[pltcrange]',
														cbc_plts='$_POST[plts]',
														cbc_neu='$_POST[neu]',
														cbc_lymp='$_POST[lymp]',
														cbc_mono='$_POST[mono]',
														cbc_eos='$_POST[eos]',
														cbc_baso='$_POST[baso]',
														cbc_band='$_POST[band]',
														cbc_atyp='$_POST[atyp]',
														cbc_nrbc='$_POST[nrbc]',
														cbc_rbcmor='$_POST[rbcmor]',
														cbc_other='$_POST[other]',
														bs='$_POST[glu]',
														bsrange='$_POST[bsrange]',
														bun='$_POST[bun]',
														bunrange='$_POST[bunrange]',
														cr='$_POST[crea]',
														crrange='$_POST[crrange]',
														uric='$_POST[uric]',
														uricrange='$_POST[uricrange]',
														chol='$_POST[chol]',
														cholrange='$_POST[cholrange]',
														tg='$_POST[trig]',
														tgrange='$_POST[tgrange]',
														sgot='$_POST[ast]',
														sgotrange='$_POST[sgotrange]',
														sgpt='$_POST[alt]',
														sgptrange='$_POST[sgptrange]',
														alk='$_POST[alp]',	
														alkrange='$_POST[alkrange]',																										
														yearchk='$_POST[yearchk]'";
		//echo $add;
		if(mysql_query($add)){
			echo "<script>alert('�ѹ�֡���������º��������');window.location='updatearmychkup_58.php?thdatehn=$thdatehn&hn=$_POST[hn]&year=$_POST[yearchk]';</script>";
		}else{
			echo "<script>alert('!!! �Դ��Ҵ�ѹ�֡��������������');window.location='addarmychkup_58.php';</script>";
		}																																								
}
?>
<a href ="../nindex.htm" >&lt;&lt; ��Ѻ˹����ѡ</a>
<p align="center"><strong>�ѹ�֡�š�õ�Ǩ�آ�Ҿ���÷����Ѻ��õ�Ǩ�ҡ�ç��Һ�����</strong></p>
<form action="addarmychkup_58.php" method="post" name="form1">
<input name="act" type="hidden" value="add">
<input name="type" type="hidden" id="type" value="�Թ��">
<input name="organ" type="hidden" id="organ" value="��Ǩ�آ�Ҿ��Шӻ�">
<input name="clinic" type="hidden" id="clinic" value="12 �Ǫ��Ժѵ�">
<input type="hidden" name="doctor" id="doctor" value="MD022 ᾷ���Ǫ��Ժѵ�">
<input name="yearchk" type="hidden" value="59">
<input name="wbcrange" type="hidden" value="5.0 - 10.0">
<input name="hctrange" type="hidden" value="37 - 49">
<input name="pltcrange" type="hidden" value="140 - 400">
<input name="bsrange" type="hidden" value="74 - 106">
<input name="bunrange" type="hidden" value="7 - 18">
<input name="crrange" type="hidden" value="0.60 - 1.3">
<input name="uricrange" type="hidden" value="2.6 - 7.2">
<input name="cholrange" type="hidden" value="0 - 200">
<input name="tgrange" type="hidden" value="0 - 150">
<input name="sgotrange" type="hidden" value="15 - 37">
<input name="sgptrange" type="hidden" value="0 - 50">
<input name="alkrange" type="hidden" value="46 - 116">
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="25%" align="right" bgcolor="#CCFFCC"><strong>HN : </strong></td>
    <td width="23%" bgcolor="#CCFFCC"><input name="hn" type="text" class="forminput" id="hn">    </td>
    <td width="11%" align="right" bgcolor="#CCFFCC"><strong>���� - ���ʡ�� : </strong></td>
    <td width="41%" bgcolor="#CCFFCC"><input name="ptname" type="text" class="forminput" id="ptname"></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>�ѧ�Ѵ : </strong></td>
    <td bgcolor="#CCFFCC"><select name="camp" class="forminput" id="camp">
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
        <option value="D33 ˹��·�������">˹��·�������</option>
         <option value="D34 ���.33" selected>���.33</option>
    </select></td>
    <td align="right" bgcolor="#CCFFCC"><strong>���� :</strong></td>
    <td bgcolor="#CCFFCC"><input name="age" type="text" class="forminput" id="age" size="10"></td>
  </tr>
  <tr>
    <td width="25%" align="right" bgcolor="#CCFFCC"><strong>��ǹ�٧ :</strong></td>
    <td bgcolor="#CCFFCC"><input name="height" type="text" class="forminput" id="height" size="10" value="170"></td>
    <td align="right" bgcolor="#CCFFCC"><strong>���˹ѡ : </strong></td>
    <td bgcolor="#CCFFCC"><input name="weight" type="text" class="forminput" id="weight" size="10" value="65"></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>�ͺ��� :</strong></td>
    <td bgcolor="#CCFFCC"><input name="round_" type="text" class="forminput" id="age6" size="10"></td>
    <td align="right" bgcolor="#CCFFCC"><strong>T :</strong></td>
    <td bgcolor="#CCFFCC"><input name="temperature" type="text" class="forminput" id="age5" size="10" value="36"></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>P : </strong></td>
    <td bgcolor="#CCFFCC"><input name="pause" type="text" class="forminput" id="pause" size="10" value="80"></td>
    <td align="right" bgcolor="#CCFFCC"><strong>R :</strong></td>
    <td bgcolor="#CCFFCC"><input name="rate" type="text" class="forminput" id="age12" size="10" value="20"></td>
  </tr>
  
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>�����ѹ���Ե :</strong></td>
    <td bgcolor="#CCFFCC"><input name="bp1" type="text" class="forminput" id="age11" size="10" value="120">
      / 
      <input name="bp2" type="text" class="forminput" id="bp2" size="10" value="80"></td>
    <td align="right" bgcolor="#CCFFCC">&nbsp;</td>
    <td bgcolor="#CCFFCC">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>���� :</strong></td>
    <td colspan="3" bgcolor="#CCFFCC"><input name="drugreact" type="radio" id="drugreact1" value="0" checked />
����� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="drugreact" type="radio" id="drugreact2" value="1"/>
��</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>������ :</strong></td>
    <td colspan="3" bgcolor="#CCFFCC"><input name="cigarette" type="radio" value="0" checked/>
������ٺ&nbsp;&nbsp;&nbsp;
<input type="radio" name="cigarette" value="1"/>
���ٺ ����ԡ����
&nbsp;&nbsp;&nbsp;
<input type="radio" name="cigarette" value="2"/>
�ٺ������ �繤��駤���
&nbsp;&nbsp;&nbsp;
<input type="radio" name="cigarette" value="3"/>
�ٺ������ �繻�Ш�</td>
    </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>���� :</strong></td>
    <td colspan="3" bgcolor="#CCFFCC"><input name="alcohol" type="radio" value="0" checked />
��������&nbsp;&nbsp;&nbsp;
<input type="radio" name="alcohol" value="1" />
�´��� ����ԡ����&nbsp;&nbsp;&nbsp;
 &nbsp;
 <input type="radio" name="alcohol" value="2" />
���� �繤��駤���&nbsp;&nbsp;&nbsp;
 &nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;
 <input type="radio" name="alcohol" value="3"/>
���� �繻�Ш�</td>
    </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>�͡���ѧ��� :</strong></td>
    <td colspan="3" bgcolor="#CCFFCC"><input name="exercise" type="radio" value="0"  />
������͡���ѧ���&nbsp;&nbsp;&nbsp;
<input type="radio" name="exercise" value="1"/>
�͡���ѧ��� ��ӡ���ࡳ�� &nbsp;&nbsp;&nbsp;
<input type="radio" name="exercise" value="2" checked/>
�͡���ѧ��� ���ࡳ�� </td>
    </tr>
  <tr>
    <td align="right" bgcolor="#CCFFCC"><strong>����ѵ��ä��Шӵ�� : </strong></td>
    <td colspan="3" bgcolor="#CCFFCC"><select name="prawat" id="prawat">
      <option value="0">������ä��Шӵ��</option>
      <option value="1">�����ѹ���Ե�٧</option>
      <option value="2">����ҹ</option>
      <option value="3">�ä���������ʹ���ʹ</option>
      <option value="4">��ѹ����ʹ�٧</option>
      <option value="5">�ä����˹�������� 2 �ä����</option>
      <option value="6">�ä��Шӵ������</option>
    </select></td>
    </tr>
  <tr>
    <td align="right" valign="top" bgcolor="#CCFFCC"><strong>�ä��Шӵ�� :</strong></td>
    <td colspan="3" bgcolor="#CCFFCC"><label>
      <textarea name="congenital_disease" id="congenital_disease" cols="45" rows="5">����ʸ</textarea>
    </label></td>
    </tr>
  <tr>
    <td colspan="4" align="center" valign="top">
  <p style="background-color:#66CCCC;">
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td colspan="10" align="center" bgcolor="#0099CC"><strong>
        <label>        </label>
        �ѹ�֡�� UA</strong></td>
    </tr>
    <tr>
       <td align="right"><strong>PHU : </strong></td>
      <td><input name="phu" type="text" id="phu" size="10"></td>
   <td align="right"><strong>SPGR : </strong></td>
      <td><input name="spgr" type="text" id="spgr" size="10"></td>
    <td align="right"><strong>PROU : </strong></td>
      <td><input name="prou" type="text" id="prou" size="10"></td>
    <td align="right"><strong>GLUU : </strong></td>
      <td><input name="gluu" type="text" id="gluu" size="10"></td>
 <td align="right"><strong>BILI : </strong></td>
      <td><input name="bili" type="text" id="bili" size="10"></td>
    </tr>
    <tr>
 <td align="right"><strong>UROBIL : </strong></td>
      <td><input name="urobil" type="text" id="urobil" size="10"></td>
   
    <td align="right"><strong>NITRIT : </strong></td>
      <td><input name="nitrit" type="text" id="nitrit" size="10"></td>
     
  <td align="right"><strong>BLOODU : </strong></td>
      <td><input name="bloodu" type="text" id="bloodu" size="10" ></td>
   
<td align="right"><strong>KETU : </strong></td>
      <td><input name="ketu" type="text" id="ketu" size="10"></td>
    
<td align="right"><strong>AMOPU : </strong></td>
      <td><input name="amopu" type="text" id="amopu" size="10"></td>
    </tr>
    <tr>
<td align="right"><strong>APPEAR : </strong></td>
      <td><input name="appear" type="text" id="appear" size="10"></td>
      <td align="right"><strong>BACTU : </strong></td>
      <td><input name="bactu" type="text" id="bactu" size="10"></td>
  
     <td align="right"><strong>CASTU : </strong></td>
      <td><input name="castu" type="text" id="castu" size="10"></td>
      <td align="right"><strong>COLOR : </strong></td>
      <td><input name="color" type="text" id="color" size="10" value="Yellow"></td>
      <td align="right"><strong>CRYSTU : </strong></td>
      <td><input name="crystu" type="text" id="crystu" size="10"></td>
    </tr>
    <tr>
 <td align="right"><strong>EPIU : </strong></td>
      <td><input name="epiu" type="text" id="epiu" size="10" ></td>
   
      <td align="right"><strong>MUCOSU : </strong></td>
      <td><input name="mucosu" type="text" id="mucosu" size="10"></td>
      <td align="right"><strong>OTHERU : </strong></td>
      <td><input name="otheru" type="text" id="otheru" size="10"></td>
  
<td align="right"><strong>RBCU : </strong></td>
      <td><input name="rbcu" type="text" id="rbcu" size="10" value="0-1"></td>
         <td align="right"><strong>WBCU : </strong></td>
      <td><input name="wbcu" type="text" id="wbcu" size="10" value="0-1"></td>
    </tr>
    <tr>
      <td align="right"><strong>YEAST : </strong></td>
      <td><input name="yeast" type="text" id="yeast" size="10"></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</p>
<p style="background-color:#FFCCCC;">
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td colspan="12" align="center" bgcolor="#FF9999"><strong>
        <label>        </label>
        �ѹ�֡�� CBC</strong></td>
      </tr>
 <tr>
       <td align="right"><strong>WBC : </strong></td>
      <td><input name="wbc" type="text" id="wbc" size="10"></td>
     <td align="right"><strong>NEU : </strong></td>
      <td><input name="neu" type="text" id="neu" size="10"></td>
 	<td align="right"><strong>LYMP : </strong></td>
      <td><input name="lymp" type="text" id="lymp" size="10"></td>
     <td align="right"><strong>MONO : </strong></td>
      <td><input name="mono" type="text" id="mono" size="10"></td>
      <td align="right"><strong>EOS : </strong></td>
      <td><input name="eos" type="text" id="eos" size="10"></td>
  <td align="right"><strong>BASO : </strong></td>
      <td><input name="baso" type="text" id="baso" size="10"></td>
    </tr>
    <tr>
       <td align="right"><strong>RBC : </strong></td>
      <td><input name="rbc" type="text" id="rbc" size="10"></td>
     <td align="right"><strong>HB : </strong></td>
      <td><input name="hb" type="text" id="hb" size="10"></td>
     <td align="right"><strong>HCT : </strong></td>
      <td><input name="hct" type="text" id="hct" size="10"></td>
    <td align="right"><strong>MCV : </strong></td>
      <td><input name="mcv" type="text" id="mcv" size="10"></td>
  <td align="right"><strong>MCH : </strong></td>
      <td><input name="mch" type="text" id="mch" size="10"></td>
      <td align="right"><strong>MCHC : </strong></td>
      <td><input name="mchc" type="text" id="mchc" size="10"></td>
   </tr>
    <tr>

      
     <td align="right"><strong>PLTS : </strong></td>
      <td><input name="plts" type="text" id="plts" size="10"></td>
     <td align="right"><strong>PLTC : </strong></td>
      <td><input name="pltc" type="text" id="pltc" size="10"></td>
<td align="right"><strong>RBCMOR : </strong></td>
      <td><input name="rbcmor" type="text" id="rbcmor" size="10"></td>
<td align="right"><strong>ATYP : </strong></td>
      <td><input name="atyp" type="text" id="atyp" size="10"></td>
      <td align="right"><strong>NRBC : </strong></td>
      <td><input name="nrbc" type="text" id="nrbc" size="10"></td>
      <td align="right"><strong>BAND : </strong></td>
      <td><input name="band" type="text" id="band" size="10"></td>
    </tr>
    <tr>
      <td align="right"><strong>OTHER : </strong></td>
      <td><input name="other" type="text" id="other" size="10"></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>   </tr>
  </table>
</p>
<p style="background-color: #FFCC99;">
 <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td colspan="10" align="center" bgcolor="#FF9966"><strong>
        <label>        </label>
        �ѹ�֡�� Lab ����</strong></td>
      </tr>
    <tr>
      <td align="right"><strong>GLU : </strong></td>
      <td><input name="glu" type="text" id="glu" size="10"></td>
      <td align="right"><strong>BUN : </strong></td>
      <td><input name="bun" type="text" id="bun" size="10"></td>
      <td align="right"><strong>CREA : </strong></td>
      <td><input name="crea" type="text" id="crea" size="10" ></td>
      <td align="right"><strong>URIC : </strong></td>
      <td><input name="uric" type="text" id="uric" size="10"></td>
      <td align="right"><strong>CHOL : </strong></td>
      <td><input name="chol" type="text" id="chol" size="10"></td>
    </tr>
    <tr>
      <td align="right"><strong>TRIG : </strong></td>
      <td><input name="trig" type="text" id="trig" size="10"></td>
      <td align="right"><strong>AST : </strong></td>
      <td><input name="ast" type="text" id="ast" size="10"></td>
      <td align="right"><strong>ALT : </strong></td>
      <td><input name="alt" type="text" id="alt" size="10"></td>
      <td align="right"><strong>ALP : </strong></td>
      <td><input name="alp" type="text" id="alp" size="10"></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table> 
</p></td>
    </tr>
  <tr>
    <td colspan="4" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="4" align="center" valign="top">
      <input name="button" type="submit" class="forminput" id="button" value="�ѹ�֡��">
    </td>
    </tr>
</table>

</form>