<?php
?>
<form method="POST" action="dg1day.php"  target=_BLANK>
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
 ��§ҹ���Ǫ�ѳ������µ���ѹ</b></font></font></p>
  <p><font face="Angsana New"><font size="3">
 (�ѹ��� 01,02,....30,31  ���������ѹ��� ���繢����ŵ����͹)</font></font></p>
  <font face="Angsana New">�ѹ���&nbsp;&nbsp;<input type="text" name="appdate" size="2">
  <? $m=date('m'); ?>
  <select size="1" name="appmo">
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
  </select>&nbsp;&nbsp; &#3614;.&#3624;
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
  <p>
	�������� <SELECT NAME="drugtype">
		<Option value="">�ٷ�����</Option>
		<Option value="�">�</Option>
		<Option value="�">�</Option>
		<Option value="�">�</Option>
		<Option value="�">�</Option>
		<Option value="�">�</Option>
	</SELECT>
  </p>
  <p>
	<INPUT TYPE="checkbox" NAME="only_drug" value="1"> ���¡��੾����
  </p>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="         &#3605;&#3585;&#3621;&#3591;       " name="B1">
	</form>
<?php
    print "&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";
?>