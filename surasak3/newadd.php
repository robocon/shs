<style type="text/css">
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
<script language="JavaScript">
	function chkNumber(ele)
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
	}
</script>
<body>
<a target=_self  href='../nindex.htm' class="forntsarabun"><------ �����</a>

<form name="f1" method="POST" action="newadd1.php" enctype="multipart/form-data">
  <table  border="0" class="forntsarabun">
    <tr>
      <td colspan="2" align="center" bgcolor="#99CC00">�����������</td>
    </tr>
    <tr>
      <td>Ἱ�</td>
      <td><select name="depart" id="depart">
	<option value="0">���͡Ἱ�</option>
<?
$part = array('','�ͧ�ѧ�Ѻ���','�ͧ��þ�Һ��','�ͼ��������','�ͼ����¾����','�ͼ������ٵԹ���Ǫ����','�ͼ�����˹ѡ','��ͧ�����','��ͧ��ҵѴ','�ͧ���Ѫ����','�ͧ�ѹ�����','��ͧ�ء�Թ','��ͧŧ�����ä','��ͧ����¹','��ͧ��Ǩ�ä�����¹͡','��ǹ���Թ�����','��ͧ��Сѹ�آ�Ҿ�','Ἱ���Ҹ��Է��','Ἱ��ѧ�ա���','Ἱ��觡��ѧ���ا','��Ҹԡ��','ͧ���ᾷ��','�ٹ��Ѳ�Ҥس�Ҿ','���¡���Թ','�ӹѡ�ҹ�Ԩ��þ����','�ٹ���ԡ�ä���������','����Ҿ�ӺѴ','�Ǫ������ͧ�ѹ','��ͧ���¡�ҧ','�ٹ��������','��Сѹ�ѧ��','�ٹ��ͺ����оѲ�Һؤ�ҡ�','��������آ�Ҿ','�ͧ���¾��ʹ��ѡ��','��ͧ�ѧ���','��С����������Ǵ������Ф�����ʹ���','��ͧ��Ǩ��','�ǴἹ��');
		/*$sql="select  *  from  ptright order by code asc";
		$result=mysql_query($sql);*/
			for($i=1;$i<38;$i++) {
    		echo '<option value="'.$part[$i].'">'.$part[$i].' </option>';
		}
	  ?>
      </select></td>
    </tr>
    <tr>
      <td valign="top">��������´�ͧ�������&nbsp;</td>
      <td>
        <TEXTAREA NAME="new" COLS="100" ROWS="10" class="forntsarabun"></TEXTAREA>
        <div>
          <span style="font-size: 16px; color: red;">����ö��鹺�÷Ѵ������¡����� <b>&lt;br&gt;</b> ����ҹ��ѧ��ͤ���</span>
        </div>
      </td>
    </tr>
    <tr>
      <td>�ѹ���</td>
      <td><input name="datetime" type="text" class="forntsarabun" size="20" value="<?=date("d-m-").(date("Y")+543)?>"></td>
    </tr>
    <tr>
      <td>Ṻ����Сͺ</td>
      <td><input name="dataf" type="file" class="forntsarabun" id="dataf" size="40" maxlength="500" /></td>
    </tr>
    <tr>
      <td>��С��˹�Ҩ�ᾷ��</td>
      <td><input name="dr" type="checkbox" id="dr" value="Y"> 
        *���㹪�ͧ�����ʴ�����˹�Ҩͧ͢ᾷ��</td>
    </tr>
    <tr>
      <td>�ӹǹ�ѹ��С�Ȣ���</td>
      <td valign="top"><input name="numday" type="text" class="forntsarabun" id="numday" onKeyPress="return chkNumber(this)" value="7"  size="3" maxlength="2"> 
        �ѹ //* �����੾�е���Ţ 1-99</td>
    </tr>
    <tr>
      <td bgcolor="#99CC00">&nbsp;</td>
      <td bgcolor="#99CC00"><input name="B1" type="submit" class="forntsarabun" value="   ��ŧ   ">
      <input name="B2" type="reset" class="forntsarabun" value="  ź���  "></td>
    </tr>
  </table>
</form>

</body>

<!--OnKeyPress="check_number();"-->