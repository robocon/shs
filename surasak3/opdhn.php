<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
?>
<body bgcolor='#808080' text='#FFFFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
<form method="POST" action="opdhnadd.php" target="_BLANK">
  <table border="0" cellpadding="0" cellspacing="0" width="100%" height="367">
    <tr>
      <td width="1%" height="367"></td>
      <td width="99%" height="367">
    <p>&nbsp;&nbsp;<font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp; <b>�ѹ�֡�����ŷӺѵõ�Ǩ�ä&nbsp;&nbsp;&nbsp;
    HN </b></font><input type="text" name="hn" size="15"></p>
    <p><font face="Angsana New">&nbsp;&nbsp;&nbsp; ��&nbsp;&nbsp; <input type="text" name="yot" size="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  ����&nbsp; <input type="text" name="name" size="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  ʡ��&nbsp; <input type="text" name="surname" size="15">&nbsp;&nbsp;&nbsp;
    ��&nbsp; <select size="1" name="sex">
      <option selected>�</option>
      <option>�</option>
    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; �Ţ�ѵ�
    ���. <input type="text" name="idcard" size="15"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp; �ѹ�Դ&nbsp;&nbsp; <input type="text" name="d" size="2" value="��" maxlength="2"><input type="text" name="m" size="2" value="��" maxlength="2"><input type="text" name="y" size="4" value="�.�." maxlength="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  ���ͪҵ� <select size="1" name="race">
    <option selected>01 ��</option>
    <option>02 �չ</option>
    <option>03 ���</option>
    <option>04 ����</option>
    <option>05 ����٪�</option>
    <option>06 �Թ���</option>
    <option>07 ���´���</option>
    <option>08 ����</option>
  </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; �ѭ�ҵ�&nbsp;&nbsp; <select size="1" name="nation">
    <option selected>01 ��</option>
    <option>02 �չ</option>
    <option>03 ���</option>
    <option>04 ����</option>
    <option>05 ����٪�</option>
    <option>06 �Թ���</option>
    <option>07 ���´���</option>
    <option>08 ����</option>
  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  ��ʹ�&nbsp; <select size="1" name="religion">
    <option selected>�ط�</option>
    <option>���ʵ�</option>
    <option>������</option>
    <option>����</option>
  </select>&nbsp;&nbsp;&nbsp;&nbsp; ʶҹ�Ҿ<select size="1" name="married">
    <option selected>�ʴ</option>
    <option>����</option>
    <option>�����/����</option>
    <option>����</option>
  </select></font></p>
    <p><font face="Angsana New">&nbsp;&nbsp; �Ҫվ&nbsp; <select size="1" name="career">
    <option selected>...���͡�Ҫվ...</option>
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
    </select>&nbsp;&nbsp;&nbsp; ������&nbsp; <select size="1" name="goup">
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
  </select>&nbsp;&nbsp;&nbsp; �ѧ�Ѵ&nbsp; <select size="1" name="camp">
    <option selected>M01&nbsp; �����͹</option>
    <option>M02&nbsp; �.17 �ѹ2</option>
      <option>M03&nbsp; ���ŷ��ú����32</option>
      <option>M04&nbsp;
      �.�.��������ѡ��������</option>
      <option>M05&nbsp; �.�ѹ4</option>
      <option>M06&nbsp;
      ���½֡ú����ɻ�еټ�</option>
      <option>M07&nbsp; ˹��·�������</option>
    </select></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp; �������&nbsp; <input type="text" name="address" size="10">&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp; �Ӻ�&nbsp; <input type="text" name="tambol" size="10">&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp; �����&nbsp; <input type="text" name="ampur" size="10" value="���ͧ">&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;
  �ѧ��Ѵ&nbsp; <input type="text" name="changwat" size="10" value="�ӻҧ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  ��. <input type="text" name="phone" size="10"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp; ���ͺԴ�&nbsp;&nbsp;
  <input type="text" name="father" size="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;������ô�&nbsp;&nbsp; <input type="text" name="mother" size="15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp; ���ͤ������&nbsp;&nbsp;&nbsp; <input type="text" name="couple" size="15"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp; �Է�ԡ���ѡ��&nbsp;
  <select size="1" name="ptright">
    <option selected>R01&nbsp; �Թʴ</option>
    <option>R02&nbsp; �ԡ��ѧ�ѧ��Ѵ</option>
   <option> R03&nbsp;�Ѱ����ˡԨ</option>
<option>R04&nbsp;�.�.�.������ͧ�����ʺ��¨ҡö</option>
<option>R05&nbsp;��Сѹ�ѧ��</option>
<option>R06&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(30�ҷ)</option>
<option>R07&nbsp;�.�.44(�Ҵ��㹧ҹ)</option>
<option>R08&nbsp;��Сѹ�آ�Ҿ�ѡ���¹(����ѷ)</option>
<option>R09&nbsp; �֡�Ҹԡ��(����͡��)</option>  
  </select>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; ������Է���ԡ&nbsp; <input type="text" name="guardian" size="15" value="����-ʡ��,����Ǣ�ͧ��">&nbsp;&nbsp;
  &nbsp;&nbsp;
  �Ţ�ѵ� ���.&nbsp; <input type="text" name="idguard" size="15"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;
  �����˵�&nbsp;&nbsp;&nbsp; <input type="text" name="note" size="20"></font>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp&nbsp&nbsp;
  <input type="submit" value="  �ѹ�֡  " name="B1">&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  ź���  " name="B2">&nbsp&nbsp&nbsp&nbsp&nbsp;
  <a target=_top  href="../nindex.htm"><< �����</a></font></p>
    </td>
    </tr>
  </table>
</form
</body>

