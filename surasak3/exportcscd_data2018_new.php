<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
  <?
  $seldate=date("d");
  $selmon=date("m");
  ?>
<form method="POST" action="datacscd2018_new/exportdatacscd.php">
<p><strong>��������ԡ��Ҫ��·ҧ���ᾷ������¹͡ �Է���ԡ���µç (ECD-CSCD)<br />
���Ѳ���к�&nbsp;&nbsp;&nbsp;�.�. ��Թ ������ ���˹�ҷ���ٹ���ԡ�ä���������&nbsp;&nbsp;&nbsp;��. 8500<br />
<div style="color:#FF0000">�������ѹ��� 14 ��͹�չҤ� �.�.2562 �֧�ѹ��� 18 ��͹����¹ �.�.2562 ��ҹ��</div></strong>
<div style="color:#0000FF">��ҧ�觢����Ţͧ�ѹ��� 1-18 ��͹ ����¹ �.�.2562 ���ͧ�ҡ�͡��ŧ�����ä <a href="report_diagnotfound_cscd.php" target="_blank" >ICD10</a> ��������ѵ���� <a href="report_icd9cmnotfound_cscd.php" target="_blank" >ICD9CM</a> ��������</div></strong>
</p>
  <strong>�����Ż�Ш��ѹ��� : </strong>
  <select name="rptdate" class="txt" id="rptdate">
  <?
  for($i=1;$i<=31;$i++){
	  if($i < 10){
	  	$dd="0".$i;
	  }else{
	  	$dd=$i;
	  }
  ?>
    <option value="<?=$dd;?>" <? if($seldate==$dd){ echo "selected='selected'";}?>><?=$dd;?></option>
  <?
  }
  ?>
  </select>
  &nbsp; 

  <select size="1" name="rptmo" class="txt">
    <option selected>-------���͡-------</option>
    <option value="01" <? if($selmon=="01"){ echo "selected='selected'";}?>>���Ҥ�</option>
    <option value="02" <? if($selmon=="02"){ echo "selected='selected'";}?>>����Ҿѹ��</option>
    <option value="03" <? if($selmon=="03"){ echo "selected='selected'";}?>>�չҤ�</option>
    <option value="04" <? if($selmon=="04"){ echo "selected='selected'";}?>>����¹</option>
    <option value="05" <? if($selmon=="05"){ echo "selected='selected'";}?>>����Ҥ�</option>
    <option value="06" <? if($selmon=="06"){ echo "selected='selected'";}?>>�Զع�¹</option>
    <option value="07" <? if($selmon=="07"){ echo "selected='selected'";}?>>�á�Ҥ�</option>
    <option value="08" <? if($selmon=="08"){ echo "selected='selected'";}?>>�ԧ�Ҥ�</option>
    <option value="09" <? if($selmon=="09"){ echo "selected='selected'";}?>>�ѹ��¹</option>
    <option value="10" <? if($selmon=="10"){ echo "selected='selected'";}?>>���Ҥ�</option>
    <option value="11" <? if($selmon=="11"){ echo "selected='selected'";}?>>��Ȩԡ�¹</option>
    <option value="12" <? if($selmon=="12"){ echo "selected='selected'";}?>>�ѹ�Ҥ�</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
      <p style="margin-left: 65px;"><input type="submit" value="���͡������" name="B1"  class="txt" />&nbsp;&nbsp;&nbsp;<input type="button" value="��Ѻ˹����ѡ" onclick="window.location.href='../nindex.htm' " class="txt" /></p>
</form>

