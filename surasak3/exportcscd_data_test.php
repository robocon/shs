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
</style><form method="POST" action="datacscd/exportdatacscd_test.php">
<p><strong>���͡�������ԡ CSCD ������͹</strong>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'  class='txt'><< �����</a></p>
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
    <option value="<?=$dd;?>"><?=$dd;?></option>
  <?
  }
  ?>
  </select>
  &nbsp; 
  <select size="1" name="rptmo" class="txt">
    <option selected>-------���͡-------</option>
    <option value="01">���Ҥ�</option>
    <option value="02">����Ҿѹ��</option>
    <option value="03">�չҤ�</option>
    <option value="04">����¹</option>
    <option value="05">����Ҥ�</option>
    <option value="06">�Զع�¹</option>
    <option value="07">�á�Ҥ�</option>
    <option value="08">�ԧ�Ҥ�</option>
    <option value="09">�ѹ��¹</option>
    <option value="10">���Ҥ�</option>
    <option value="11">��Ȩԡ�¹</option>
    <option value="12">�ѹ�Ҥ�</option>

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
      <p style="margin-left: 65px;"><input type="submit" value="���͡������" name="B1"  class="txt" /></p>
</form>

