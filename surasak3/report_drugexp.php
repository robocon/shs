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
<p align="center" style="margin-top: 20px;"><strong>��§ҹ��������ص����ǧ����</strong></p>
<div align="center">
<form method="POST" action="report_drugexp1.php" target="_blank">
	<strong>�����ҧ�ѹ��� : </strong>
    <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>���͡��͹ : </strong><select size="1" name="month1" class="txt">
    <option selected>-------���͡-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>���Ҥ�</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>����Ҿѹ��</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>�չҤ�</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>����¹</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>����Ҥ�</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>�Զع�¹</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>�á�Ҥ�</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>�ԧ�Ҥ�</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>�ѹ��¹</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>���Ҥ�</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>��Ȩԡ�¹</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>�ѹ�Ҥ�</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year1'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       &nbsp; <strong>�֧�ѹ���</strong> 
    <input name="date2" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>���͡��͹ : </strong><select size="1" name="month2" class="txt">
    <option selected>-------���͡-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>���Ҥ�</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>����Ҿѹ��</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>�չҤ�</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>����¹</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>����Ҥ�</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>�Զع�¹</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>�á�Ҥ�</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>�ԧ�Ҥ�</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>�ѹ��¹</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>���Ҥ�</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>��Ȩԡ�¹</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>�ѹ�Ҥ�</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year2'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>       
       <input type="submit" value="�٢�����" name="B1"  class="txt" />
</form>
</div>
