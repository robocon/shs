<form method="POST" action="drload.php"  target=_BLANK>
  <p>&nbsp;<font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="4"><b>
    ��§ҹ�ӹǹ�����Ǩ�����͹�ͧᾷ��</b></font></font></p>
  <font face="Angsana New">��Ǩ��͹&nbsp;&nbsp;
    <? $m=date('m'); ?>
      <select name="appmo" size="1">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
        </select>

     <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></p>
  <p><font face="Angsana New">ᾷ�����Ǩ&nbsp;
  <select size="1" name="doctor">
    <option selected><���͡ᾷ��></option>
    <option>MD022 (����Һᾷ��)</option>
    <option>MD006 ���͡ ��ҹ���ҧ</option>
    <option>MD007 �ç�� ��մ�͹ѹ��آ</option>
    <option>MD008 ��ó� �����ѡ���</option>
    <option>MD009 ����� �����ѡ���</option>
    <option>MD011 ͹ؾ��� �ʹ���</option>
    <option>MD013 ����Թ��� ����չҤ</option>
    <option>MD014 ��Ѫ�� ���¨���</option>
    <option>MD015 ������ ������ó</option>
    <option>MD016 ����Թ ���๵�</option>
    <option>MD017 �Է�Ԫ�� �Ե���Թ��</option>
    <option>MD020 ˹��ķ�� ����ȹѹ��</option>
    <option>MD026 ͪ�� ྪô�</option>
    <option>MD030 ���͡�� �����Ѿ��</option>
     <option>MD036 ����Է���  ���ռ�</option>
    <option>MD037 ��Ծ���  ��շ��ѳ��</option>
    <option>MD038 �Է���  �����ѵ��</option>
    <option>MD039  ���Ծѹ��  ���ҧ���</option>
    <option>MD040  �ѯ�ҡ�  ǧ�����Թ���</option>
    <option>MD041  ���Է�� ǧ�����</option>
    <option>MD042  ྪ� �Ѫ��Թ���</option>
    </select></font> </p>

  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     &#3605;&#3585;&#3621;&#3591;    " name="B1">
  </form>
