<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 21px;  
}
body {
	background-color: #CCFFCC;
}
-->
</style></head>

<body>
<? $m=date('m'); ?>
<div align="center" style="margin-top:50px;">
<p><strong>��§ҹ�١˹�����ѡ�Ҿ�Һ�Ż�Ш���͹</strong></p>
<form method="POST" action="report_chkcreditvn1.php" target="_blank">
  <strong>���͡��͹</strong> 
  <select size="1" name="mon">
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
				echo " �.�. <select name='year'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
&nbsp;&nbsp;&nbsp;&nbsp;
<strong>���͡�١˹��</strong> 
  <select size="1" name="credit">
    <option value="all" selected="selected">������</option>
     <option value="�Թʴ" >�Թʴ</option>
     <option value="���µç" >���µç</option>
     <option value="��Сѹ�ѧ��" >��Сѹ�ѧ��</option>
     <option value="30�ҷ" >30�ҷ</option>
     <option value="���µç ͻ�." >���µç ͻ�.</option>
     <option value="������" >������</option>
     <option value="HD" >HD</option>
     <option value="�ú." >�ú.</option>
     <option value="��44" >��44</option>
     <option value="��" >��</option>
  </select>                
&nbsp;&nbsp;&nbsp;&nbsp;  
  <input type="submit" value="      ����§ҹ      " name="B1">     
</form>
</div>
</body>
</html>
