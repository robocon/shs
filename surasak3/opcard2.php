<body bgcolor="#669999" text="#FFFFFF">

<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		var stat = true;
		var id13 = document.f1.idcard.value;
		var sum = 0;
		if(id13.length != 13){
			stat = false;
		}

		if(stat == true){
				
				for (i = 0; i < 12; i++)
				{
					sum += eval(id13.charAt(i)) * (13 - i);
				}

			sum = ((11 - (sum % 11)) % 10)
			
			if(eval(id13.charAt(12)) != sum)
				stat = false;
		}

		return stat;
	}

</SCRIPT>

<form name="f1" method="POST" action="opdadd.php" Onsubmit="return checkForm();">

<TABLE style="font-family: Angsana New;">
<TR>
	<TD align="right">��&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="yot" size="5" ></TD>
	<TD align="right">����&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="name" size="15" ></TD>
	<TD align="right">ʡ��&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="surname" size="15"></TD>
</TR>
<TR>
	<TD align="right">��&nbsp;:&nbsp;</TD>
	<TD>
		<select size="1" name="sex">
			<option selected>?</option>
			<option>�</option>
			<option>�</option>
		</select>
	</TD>
	<TD align="right">�Ţ�ѵ� ���.&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="idcard" size="15" value="-" maxlength="13"></TD>
	<TD></TD>
	<TD></TD>
</TR>
<TR>
	<TD align="right">�ѹ�Դ&nbsp;:&nbsp;</TD>
	<TD colspan="5">
		<input type="text" name="d" size="2" value="��" maxlength="2">
		<input type="text" name="m" size="2" value="��" maxlength="2">
		<input type="text" name="y" size="4" value="�.�." maxlength="4"></TD>
</TR>
<TR>
	<TD align="right">���ͪҵ�&nbsp;:&nbsp;</TD>
	<TD>
		<select size="1" name="race">
		<option selected>��</option>
		<option>�չ</option>
		<option>���</option>
		<option>����</option>
		<option>����٪�</option>
		<option>�Թ���</option>
		<option>���´���</option>
		<option>����</option>
		</select>
	</TD>
	<TD align="right">�ѭ�ҵ�&nbsp;:&nbsp;</TD>
	<TD>
	<select size="1" name="nation">
    <option selected>��</option>
    <option>�չ</option>
    <option>���</option>
    <option>����</option>
    <option>����٪�</option>
    <option>�Թ���</option>
    <option>���´���</option>
    <option>����</option>
  </select>
  </TD>
  	<TD align="right">��ʹ�&nbsp;:&nbsp;</TD>
	<TD>
	<select size="1" name="religion">
    <option selected>�ط�</option>
    <option>���ʵ�</option>
    <option>������</option>
    <option>����</option>
   </select>
   </TD>
</TR>
<TR>
	<TD align="right">ʶҹ�Ҿ&nbsp;:&nbsp;</TD>
	<TD>
		<select size="1" name="married">
		<option selected><-���͡-></option>
		<option >�ʴ</option>
		<option>����</option>
		<option>�����/����</option>
		<option>����</option>
		</select>
	</TD>
	<TD align="right">�Ҫվ&nbsp;:&nbsp;</TD>
	<TD colspan="3">
		<select size="1" name="career">
    <option selected><-���͡-></option>
    <option>01&nbsp;&nbsp; �ɵá�</option>
      <option>02&nbsp;&nbsp; �Ѻ��ҧ�����</option>
      <option>03&nbsp;&nbsp; ��ҧ�����</option>
      <option>04&nbsp;&nbsp; ��áԨ&nbsp;&nbsp; </option>
      <option>05&nbsp;&nbsp; ����/���Ǩ</option>
      <option>06&nbsp;&nbsp;
      �ѡ�Է���ҵ����йѡ෤�ԡ</option>
      <option>07&nbsp;&nbsp;
      �ؤ�ҡô�ҹ�Ҹ�ó�آ</option>
      <option>08&nbsp;&nbsp;
      �ѡ�ԪҪվ/�ѡ�Ԫҡ��</option>
      <option>09&nbsp;&nbsp; ����Ҫ��÷����</option>
      <option>10&nbsp;&nbsp; �Ѱ����ˡԨ</option>
      <option>11&nbsp;&nbsp;
      ��������������Ҫվ</option>
      <option>12&nbsp;&nbsp;
      �ѡ�Ǫ/�ҹ��ҹ��ʹ�</option>
      <option>13&nbsp;&nbsp; ����</option>
    </select>
	</TD>
</TR>
<TR>
	<TD align="right">������&nbsp;:&nbsp;</TD>
	<TD>
		<select size="1" name="goup">
    <option selected><-���͡-></option>
    <option>G11&nbsp;�.1 ��·��û�Шӡ��</option>
    <option>G12&nbsp;�.2 ����Ժ  �ŷ��û�Шӡ��</option>
  <option>G13&nbsp;�.3 ����Ҫ��á����������͹</option>
 <option>G14&nbsp;�.4 �١��ҧ��Ш�</option>
 <option>G15 &nbsp;�.5 �١��ҧ���Ǥ���</option>
 <option>G21&nbsp;�.1 �Ժ��� �ŷ��áͧ��Шӡ��</option>
 <option>G22&nbsp;�.2 �ѡ���¹����</option>
 <option>G23 &nbsp;�.3 ������Ѥ÷��þ�ҹ</option>
 <option>G24 &nbsp;�.4 �ѡ�ɷ���</option>
 <option>G31&nbsp;�.1 ��ͺ���Ƿ���</option>
 <option>G32&nbsp;�.2 ���ù͡��Шӡ��
 <option>G33&nbsp;�.3 �ѡ�֡���Ԫҷ���(ô)</option>
 <option>G34&nbsp;�.4 ���Ѳ������ͧ</option>
 <option>G35&nbsp;�.5 �ѵû�Сѹ�ѧ��
 <option>G36&nbsp;�.6 �ѵ÷ͧ30�ҷ</option>
 <option>G37&nbsp;�.7 ����Ҫ��þ����͹(�ԡ���ѧ�Ѵ)</option>
 <option>G38&nbsp;�.8 �����͹(����ԡ���ѧ�Ѵ)</option>
 <option>G39&nbsp;�.9 ��������к�
  </select>
	</TD>
	<TD align="right">�ѧ�Ѵ&nbsp;:&nbsp;</TD>
	<TD colspan="3">
	<select size="1" name="camp">
    <option selected><-���͡-></option>
    <option>M01&nbsp; �����͹</option>
    <option>M02&nbsp; �.17 �ѹ2</option>
      <option>M03&nbsp; ���ŷ��ú����32</option>
      <option>M04&nbsp;
      �.�.��������ѡ��������</option>
      <option>M05&nbsp; �.�ѹ4</option>
      <option>M06&nbsp;
      ���½֡ú����ɻ�еټ�</option>
      <option>M07&nbsp; ˹��·�������</option>
    </select>
	</TD>
</TR>
<TR>
	<TD align="right">�������&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="address" size="20"></TD>
	<TD align="right">�Ӻ�&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="tambol" size="10"></TD>
	<TD align="right">�����&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="ampur" size="10" value="���ͧ"></TD>
</TR>
<TR>
	<TD align="right">�ѧ��Ѵ&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="changwat" size="10" value="�ӻҧ"></TD>
	<TD align="right">��.&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="phone" size="10" value="-"></TD>
	<TD></TD>
	<TD></TD>
</TR>
<TR>
	<TD align="right">���ͺԴ�&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="father" size="20" value="-"></TD>
	<TD align="right">������ô�&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="mother" size="20" value="-" ></TD>
	<TD align="right">���ͤ������&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="couple" size="20" value="-"></TD>
</TR>
<TR>
	<TD align="right">���������ö�Դ�����&nbsp;:&nbsp;</TD>
	<TD><input type='text' name="ptf" size='20'  value="-"></TD>
	<TD align="right">����Ǣ�ͧ��&nbsp;:&nbsp;</TD>
	<TD><input type='text' name="ptfadd" size='10'  value="-"></TD>
	<TD align="right">���Ѿ������Դ���&nbsp;:&nbsp;</TD>
	<TD><input type='text' name="ptffone" size='10'  value="-"></TD>
</TR>
<TR>
	<TD align="right">�Է�ԡ���ѡ��&nbsp;:&nbsp;</TD>
	<TD>
		<select size="1" name="ptright">
    <option selected><-���͡-></option>
    <option>R01&nbsp;�Թʴ</option>
    <option>R02&nbsp;�ԡ��ѧ�ѧ��Ѵ</option>
<option>R03&nbsp;�ç����ä�ѡ�ҵ�����ͧ</option>
<option> R04&nbsp;�Ѱ����ˡԨ</option>
<option>R05&nbsp;����ѷ(��Ҫ�)</option>
<option>R07&nbsp;��Сѹ�ѧ��</option>
<option>R09&nbsp;��Сѹ�آ�Ҿ��ǹ˹��</option>
<option>R10&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(���Դ����)</option>
<option>R11&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(�ҵ��8)</option>
<option>R12&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(���ü�ҹ�֡,���ԡ��)</option>
<option>R16&nbsp;�֡�Ҹԡ��(����͡��)</option>  
<option>R17&nbsp;�ŷ���</option>  
<option >R21&nbsp;ͧ��û���ͧ��ǹ��ͧ���</option>
 </select>
	</TD>
	<TD align="right">�ԡ�ҡ&nbsp;:&nbsp;</TD>
	<TD>
		<select   size="1" name="ptfmon">
		<option selected><-���͡-></option>
		<option >MO01&nbsp; ���ͧ</option>
		<option>MO02&nbsp; �Դ�</option>
		<option  >MO03&nbsp; ��ô�</option>
		<option >MO04&nbsp; �ص�</option>
		<option  >MO05&nbsp; �������</option>
		</select>
	</TD>
	<TD align="right">���.��Ңͧ�Է��&nbsp;:&nbsp;</TD>
	<TD><input type='text' name="guardian" size='13'  value="-"></TD>
</TR>
<TR>
	<TD align="right">�����˵�&nbsp;:&nbsp;</TD>
	<TD colspan="5">
	<select size="1" name="idguard">
 <option selected><-���͡-></option>
<option ></option>
<option >MX01&nbsp; ����/��ͺ����</option>
 <option >MX02&nbsp; �ջѭ������ͧ�Է��</option>
 <option >MX03&nbsp; VIP</option>
  </select>
 �����˵�&nbsp;:&nbsp;<input type="text" name="note" size="50" value="-"></TD>
</TR>
<TR>
	<TD colspan="6" align="center">
	<input type="submit" value="  �ѹ�֡  " name="B1">
	&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  ź���  " name="B2">&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_self"  href="../nindex.htm">&lt;&lt;�����</a>
  </TD>
</TR>
</TABLE>

</form>
</body>



