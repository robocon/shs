<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
  <?
  $seldate=date("d");
  $selmon=date("m");
  ?>
<form method="POST" action="exportcipn_data.php">
<input type="hidden" name="act" value="show" />
<p><strong>��������ԡ��Ҫ��·ҧ���ᾷ�������� �Է���ԡ���µç (CIPN)<br />
���Ѳ���к�&nbsp;&nbsp;&nbsp;�.�. ��Թ ������ ���˹�ҷ���ٹ���ԡ�ä���������&nbsp;&nbsp;&nbsp;��. 8500<br />
<div style="color:#FF0000">������������ѹ��� 22 ��͹���Ҥ� �.�.2563 �繵�� (last update : 2020-08-17)</div></strong>
</p>
  <strong>�����Ż�Ш���͹ : </strong>
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
      <p style="margin-left: 65px;"><input type="submit" value="���¡�٢�����" name="B1"  class="txt" />&nbsp;&nbsp;&nbsp;<input type="button" value="��Ѻ˹����ѡ" onclick="window.location.href='../nindex.htm' " class="txt" /></p>
</form>
<?
if($_POST["act"]=="show"){
$thimonth=$_POST["thiyr"]."-".$_POST["rptmo"];
?>
<div align="center"><strong>�����ż��������ԡ CIPN ��Ш���͹ <?=$thimonth;?></strong></div>
<table width="90%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#20B2AA"><strong>�ӴѺ</strong></td>
    <td width="11%" align="center" bgcolor="#20B2AA"><strong>�ѹ����˹���</strong></td>
    <td width="7%" align="center" bgcolor="#20B2AA"><strong>HN</strong></td>
    <td width="7%" align="center" bgcolor="#20B2AA"><strong>AN</strong></td>
    <td width="21%" align="center" bgcolor="#20B2AA"><strong>���� - ���ʡ��</strong></td>
    <td width="11%" align="center" bgcolor="#20B2AA"><strong>�����Ţ͹��ѵ�</strong></td>
    <td width="10%" align="center" bgcolor="#20B2AA"><strong>�ӹǹ�Թ</strong></td>
    <td width="14%" align="center" bgcolor="#20B2AA"><strong>���͡������</strong></td>
    <td width="15%" align="center" bgcolor="#20B2AA"><strong>���Թ���</strong></td>
  </tr>
<?
$sql="select * from ipcard where dcdate LIKE '$thimonth%' and (ptright LIKE 'R02%' OR ptright LIKE 'R03%') AND price > 0 and status_log='��˹���' order by dcdate";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["claimcipn"]=="s"){  //���ѧ�觢�����
	$bgcolor="#F0E68C";
}else if($rows["claimcipn"]=="y"){  //�觢����ż�ҹ�͵ͺ��Ѻ
	$bgcolor="#66CDAA";
}else if($rows["claimcipn"]=="n"){  //�觢���������ҹ
	$bgcolor="#F08080";
}else if($rows["claimcipn"]=="c"){  //�ŵͺ��Ѻ�Դ C
	$bgcolor="#DA70D6";
}else{
	$bgcolor="#F5FFFA";
}
?>  
  <tr style="background-color:<?=$bgcolor;?>">
    <td align="center"><?=$i;?></td>
    <td><?=$rows["dcdate"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["an"];?></td>
    <td><?=$rows["ptname"];?></td>   
    <td align="center"><?=$rows["opreg"];?></td>
    <td align="center"><?=number_format($rows["price"],2);?></td>
	<?php
	if($rows["an"]=="63/2594" || $rows["an"]=="63/2726" || $rows["an"]=="64/58"){
	?>
    <td align="center"><? if($rows["claimcipn"]!="y"){ ?><a href="datacipn/exportdatacipn_other.php?an=<?=$rows["an"];?>">��ǹ���Ŵ���</a><? } ?></td>
	<?php
	}else{
	?>
    <td align="center"><? if($rows["claimcipn"]!="y"){ ?><a href="datacipn/exportdatacipn.php?an=<?=$rows["an"];?>">��ǹ���Ŵ���</a><? } ?></td>    
    <?php
	}
	?>
    <td align="center"><? if($rows["claimcipn"]=="s" || $rows["claimcipn"]=="n"  || $rows["claimcipn"]=="c"){?><a href="updatedatacipn.php?an=<?=$rows["an"];?>">��Ѻ��اʶҹ�</a><? } ?></td>
  </tr>
<?
}
?>  
</table>
<?
}
?>
<hr />
<? if($thimonth=="2563-10"){ ?>
<div style="margin-left:50px;">
</div>
<? } ?>