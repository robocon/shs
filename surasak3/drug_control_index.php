<a target=_self  href='../nindex.htm'><<�����</a>
<?
session_start();
include("connect.inc");

if($_SESSION['sOfficer']!=''){
	echo "<br><span class='font1'>".$_SESSION['sOfficer']."</span>";
?>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
}
-->
</style>

<form id="form1" name="form1" method="post" action="drug_control.php">
<table width="68%">
  <tr>
    <td width="100%" align="center" class="font1"><strong>�к��һ�Шӵ��</strong></td>
  </tr>
  <tr>
    <td class="font1">&nbsp;
      �ѹ���
      <input type="text" name="rptday1" maxlength="2" size="2" value="<?=date('d')?>" />
      &#3648;&#3604;&#3639;&#3629;&#3609;&nbsp;
      <? $m=date('m'); ?>
      <select size="1" name="rptmo1">
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
				echo "<select name='thiyr1'>";
				foreach($dates as $i){

				?>
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
        <?=$i;?>
        </option>
      <?
				}
				echo "<select>";
				?>
      &nbsp;&nbsp;-&nbsp;&nbsp; �ѹ���
      <input type="text" name="rptday2" maxlength="2" size="2" value="<?=date('d')?>"/>
      &#3648;&#3604;&#3639;&#3629;&#3609;&nbsp;
      <? $m=date('m'); ?>
      <select size="1" name="rptmo2">
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
				echo "<select name='thiyr2'>";
				foreach($dates as $i){

				?>
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
        <?=$i;?>
        </option>
      <?
				}
				echo "<select>";
				?>
    </td>
  </tr>
  <tr>
    <td align="center" class="font1">
      <input type="submit" name="ok2" id="ok2" value="��ŧ" />
    </td>
  </tr>
</table>
</form>
<span class="font1">
<?
}else{
	echo "���� login ������ҡ�س� login ����";
	echo "<a target=_self  href='../nindex.htm'><<�����</a>";
}
?>
</span>