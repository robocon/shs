<?php
  print "�ô���͡ ��͹ �� ���дټ������ ����˹���<br>";
?>
<form method="POST" action="dciplst.php">
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp; ������㹢ͧ��͹&nbsp;<select size="1" name="mo">
<? $m=date('m'); ?>
    <option selected>--���͡--</option>
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
  </select>&nbsp;&nbsp; �.�.<input type="text" name="thiyr" size="4" value="<?=date("Y")+543;?>"></font></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ��ŧ     " name="B1">
       &nbsp;&nbsp;&nbsp;&nbsp <a target=_self  href="../nindex.htm"><< ¡��ԡ</a></td>
</form>



