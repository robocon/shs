<style type="text/css">
<!--
.forntsarabun {
	font-family:"TH Niramit AS";
	font-size: 16px;
}
.font{
	font-family:"TH Niramit AS";
	font-size:16;
	
}
@media print{
#no_print{display:none;}
}
.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<!--<h1 class="forntsarabun">ʶԵ�Ἱ��ѧ�ա���</h1>-->
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right">������ѹ���</td>
    <td >
     <select name="startday"  id="startday">
        <? 
		
		$d=date("d");
		for($i=1;$i<=31;$i++){
			
			if($i<10){
				$i="0".$i;
			}
			if($d==$i){
			echo "<option value='$i' selected=\"selected\">$i</option>";	
			}else{
			 echo "<option value='$i'>$i</option>";
			}
		}
			 ?>
      </select>
       <? $m=date('m'); ?>
      <select name="m_start" class="forntsarabun">
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
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
 
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    <td>�֧</td>
    <td><select name="endday"  id="endday">
        <? 
		
		$d=date("d");
		for($i=1;$i<=31;$i++){
			
			if($i<10){
				$i="0".$i;
			}
			if($d==$i){
			echo "<option value='$i' selected=\"selected\">$i</option>";	
			}else{
			 echo "<option value='$i'>$i</option>";
			}
		}
			 ?>
      </select>
       <? $m=date('m'); ?>
      <select name="m_end" class="forntsarabun">
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
				echo "<select name='y_end' class='forntsarabun'>";
				foreach($dates as $i){
 
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="4" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>&nbsp; 
      <font class="font">* ���ҧ�á=�ç��Сͺ�����(R)  / ���ҧ�ͧ=�ç��Һ��(H)</td>
  </tr>
</table>
</form>
</div>
<?
if($_POST['submit']=="����"){

$month['01'] = "���Ҥ�";
$month['02'] = "����Ҿѹ��";
$month['03'] = "�չҤ�";
$month['04'] = "����¹";
$month['05'] = "����Ҥ�";
$month['06'] = "�Զع�¹";
$month['07'] = "�á�Ҥ�";
$month['08'] = "�ԧ�Ҥ�";
$month['09'] = "�ѹ��¹";
$month['10'] = "���Ҥ�";
$month['11'] = "��Ȩԡ�¹";
$month['12'] = "�ѹ�Ҥ�";	
	
	function Dbetween($Datestart, $Dateend){
    $Oday = 60*60*24; #�ѹ
    $Datestart = strtotime($Datestart); #�ŧ�ѹ����� unixtime
    $Dateend = strtotime($Dateend); #�ŧ�ѹ����� unixtime
    $Diffday = round(($Dateend - $Datestart)/$Oday); 
    $arrayDate = array();
    $arrayDate[] = date('Y-m-d',$Datestart);    
    for($x = 1; $x < $Diffday; $x++){
        $arrayDate[] = date('Y-m-d',($Datestart+($Oday*$x)));
    }
    $arrayDate[] = date('Y-m-d',$Dateend);
    return $arrayDate;
}
	
$start_date=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['startday'];
$end_date=$_POST['y_end'].'-'.$_POST['m_end'].'-'.$_POST['endday'];
	
$start_date1=($_POST['y_start']-543).'-'.$_POST['m_start'].'-'.$_POST['startday'];
$end_date1=($_POST['y_end']-543).'-'.$_POST['m_end'].'-'.$_POST['endday'];


$showdate1=$_POST['startday'].' '.$month[$_POST['m_start']].' '.($_POST['y_start']);
$showdate2=$_POST['endday'].' '.$month[$_POST['m_end']].' '.($_POST['y_end']);	
	include("connect.inc");
	
	
$sumday = Dbetween($start_date1,$end_date1);

		
$tsql1="CREATE TEMPORARY TABLE   food1  SELECT *  FROM food WHERE SUBSTRING( regisdate, 1, 10 ) 
BETWEEN '$start_date' AND '$end_date'";
$tquery1 = mysql_query($tsql1) or die (mysql_error());


//////////////////////////////////////
?>
<h1 class="font" align="center">��ػ�ʹ��������§���ѭ�����ͧ����� �ͺ�ѻ����</h1>
<h1 class="font" align="center">�����.....<?=$showdate1;?>....�֧.....<?=$showdate2;?>.....</h1>
<table border="1" align="center" style="border-collapse:collapse; border-color:#000;" cellpadding="0" cellspacing="0" class="font">
  <tr>
    <td>&nbsp; &nbsp; �ѹ / ��͹ / ��&nbsp; &nbsp; </td>
    <td>&nbsp; &nbsp; ��§���ѭ&nbsp; &nbsp; </td>
    <td>&nbsp; &nbsp; ��ͧ�����&nbsp; &nbsp; </td>
    <td>&nbsp; &nbsp; ���&nbsp; &nbsp; </td>
    <td>&nbsp; &nbsp; ����ӹǹ�Թ&nbsp; &nbsp; </td>
  </tr>
<?
foreach ($sumday as $value) {
	
$value1=explode("-",$value);

$value2=$value1[2].' '.$month[$value1[1]].' '.($value1[0]+543);

$regisdate=($value1[0]+543).'-'.$value1[1].'-'.$value1[2];

//// �������  ��§���ѭ///
$sql42="Select count(an)as count42 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '42%' AND food !=  'NPO (�������, ���)'";
$query42 = mysql_query($sql42) or die (mysql_error());
$arr42=mysql_fetch_array($query42);

$sql43="Select count(an)as count43 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '43%'  AND food !=  'NPO (�������, ���)'";
$query43 = mysql_query($sql43) or die (mysql_error());
$arr43=mysql_fetch_array($query43);

$sql44="Select count(an)as count44 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '44%'  AND food !=  'NPO (�������, ���)'";
$query44 = mysql_query($sql44) or die (mysql_error());
$arr44=mysql_fetch_array($query44);

$sql45="Select count(an)as count45 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '45%' AND food !=  'NPO (�������, ���)'";
$query45 = mysql_query($sql45) or die (mysql_error());
$arr45=mysql_fetch_array($query45);


/////////  ���͡�ҧ�ѹ  ���ѭ ///

$sql142="Select count(an)as count142 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '42%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query142 = mysql_query($sql142) or die (mysql_error());
$arr142=mysql_fetch_array($query142);

$sql143="Select count(an)as count143 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '43%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query143 = mysql_query($sql143) or die (mysql_error());
$arr143=mysql_fetch_array($query143);

$sql144="Select count(an)as count144 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '44%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query144 = mysql_query($sql144) or die (mysql_error());
$arr144=mysql_fetch_array($query144);

$sql145="Select count(an)as count145 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '45%' AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query145 = mysql_query($sql145) or die (mysql_error());
$arr145=mysql_fetch_array($query145);

/////////  ���͡�ҧ���  ���ѭ ///

$sql242="Select count(an)as count242 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '42%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query242 = mysql_query($sql242) or die (mysql_error());
$arr242=mysql_fetch_array($query242);

$sql243="Select count(an)as count243 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '43%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query243 = mysql_query($sql243) or die (mysql_error());
$arr243=mysql_fetch_array($query243);

$sql244="Select count(an)as count244 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '44%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query244 = mysql_query($sql244) or die (mysql_error());
$arr244=mysql_fetch_array($query244);

$sql245="Select count(an)as count245 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '45%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query245 = mysql_query($sql245) or die (mysql_error());
$arr245=mysql_fetch_array($query245);


//////////////////////// ����� ���ѭ ///

$fward=$arr42['count42']+$arr242['count242']+$arr142['count142']; 
$gward=$arr43['count43']+$arr243['count243']+$arr143['count143']; 
$vipward=$arr45['count45']+$arr245['count245']+$arr145['count145']; 
$icuward=$arr44['count44']+$arr244['count244']+$arr144['count144']; 

$sum1=$fward+$gward+$vipward+$icuward;



$avg=ceil($sum1/3);


///////////////////////// �� ��§���ѭ ///////////////////


////////////// ��§����� //////
//// �������  ��§�����///1.
$sql421="Select count(an)as count421 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '42%'  AND food !=  'NPO (�������, ���)'";
$query421= mysql_query($sql421) or die (mysql_error());
$arr421=mysql_fetch_array($query421);

$sql431="Select count(an)as count431 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '43%'  AND food !=  'NPO (�������, ���)'";
$query431 = mysql_query($sql431) or die (mysql_error());
$arr431=mysql_fetch_array($query431);

$sql441="Select count(an)as count441 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '44%' AND food !=  'NPO (�������, ���)' ";
$query441 = mysql_query($sql441) or die (mysql_error());
$arr441=mysql_fetch_array($query441);

$sql451="Select count(an)as count451 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '45%'  AND food !=  'NPO (�������, ���)'";
$query451 = mysql_query($sql451) or die (mysql_error());
$arr451=mysql_fetch_array($query451);


///  ���͡�ҧ�ѹ  ����� ///2.

$sql422="Select count(an)as count422 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '42%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query422 = mysql_query($sql422) or die (mysql_error());
$arr422=mysql_fetch_array($query422);

$sql432="Select count(an)as count432 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '43%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query432 = mysql_query($sql432) or die (mysql_error());
$arr432=mysql_fetch_array($query432);

$sql442="Select count(an)as count442 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '44%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query442 = mysql_query($sql442) or die (mysql_error());
$arr442=mysql_fetch_array($query442);

$sql452="Select count(an)as count452 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '45%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query452 = mysql_query($sql452) or die (mysql_error());
$arr452=mysql_fetch_array($query452);


///  �������  ����� ///3.

$sql423="Select count(an)as count423 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '42%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query423 = mysql_query($sql423) or die (mysql_error());
$arr423=mysql_fetch_array($query423);

$sql433="Select count(an)as count433 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '43%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query433 = mysql_query($sql433) or die (mysql_error());
$arr433=mysql_fetch_array($query433);

$sql443="Select count(an)as count443 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '44%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query443 = mysql_query($sql443) or die (mysql_error());
$arr443=mysql_fetch_array($query443);

$sql453="Select count(an)as count453 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '45%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query453 = mysql_query($sql453) or die (mysql_error());
$arr453=mysql_fetch_array($query453);


$fward2=$arr421['count421']+$arr422['count422']+$arr423['count423']; 
$gward2=$arr431['count431']+$arr432['count432']+$arr433['count433']; 
$vipward2=$arr451['count451']+$arr452['count452']+$arr453['count453']; 
$icuward2=$arr441['count441']+$arr442['count442']+$arr443['count443']; 

$sum2=$fward2+$gward2+$vipward2+$icuward2;

$avg2=ceil($sum2/3);

$sum12=$sum1+$sum2;

$sumavg1=($avg*120)+($avg2*170);
$sumavg2=($avg*150)+($avg2*200);

global  $sum1,$sum2,$avg1,$avg2,$sum12,$sumavg1,$sumavg2;


?>


  <tr>
    <td><?=$value2;?></td>
    <td align="center"><?=$sum1;?></td>
    <td align="center"><?=$sum2;?></td>
    <td align="center"><?=number_format($sum12);?></td>
    <td align="right"><?=number_format($sumavg1);?></td>
  </tr>
  <? 
  $s1+=$sum1;
  $s2+=$sum2;
  $s3+=$sum12;
  $s4+=$sumavg1;
  }
  
   ?>
  <tr>
    <td align="center">���</td>
    <td align="center"><?=$s1;?></td>
    <td align="center"><?=$s2;?></td>
    <td align="center"><?=number_format($s3);?></td>
    <td align="right"><?=number_format($s4);?></td>
  </tr>
</table>
<br />
<table border="0" align="center" class="font">
  <tr>
    <td colspan="3" align="center">��Ǩ�١��ͧ</td>
  </tr>
  <tr>
    <td width="46">&nbsp;</td>
    <td>&nbsp;</td>
    <td>�.�.˭ԧ..................................</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="170">&nbsp;</td>
    <td width="179" align="center">( �ŸԪ� ᵧ����ѵ� )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>�.����ҡ�� þ.��������ѡ��������</td>
  </tr>
</table>

<div style="page-break-before:always;">

<h1 class="font" align="center">��ػ�ʹ��������§���ѭ�����ͧ����� �ͺ�ѻ����</h1>
<h1 class="font" align="center">�����.....<?=$showdate1;?>....�֧.....<?=$showdate2;?>.....</h1>
<table border="1" align="center" style="border-collapse:collapse; border-color:#000;" cellpadding="0" cellspacing="0" class="font">
  <tr>
    <td>&nbsp; &nbsp; �ѹ / ��͹ / ��&nbsp; &nbsp; </td>
    <td>&nbsp; &nbsp; ��§���ѭ&nbsp; &nbsp; </td>
    <td>&nbsp; &nbsp; ��ͧ�����&nbsp; &nbsp; </td>
    <td>&nbsp; &nbsp; ���&nbsp; &nbsp; </td>
    <td>&nbsp; &nbsp; ����ӹǹ�Թ&nbsp; &nbsp; </td>
  </tr>
 <? foreach ($sumday as $value) {
	
$value1=explode("-",$value);

$value2=$value1[2].' '.$month[$value1[1]].' '.($value1[0]+543);

$regisdate=($value1[0]+543).'-'.$value1[1].'-'.$value1[2];

//// �������  ��§���ѭ///
$sql42="Select count(an)as count42 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '42%' AND food !=  'NPO (�������, ���)'";
$query42 = mysql_query($sql42) or die (mysql_error());
$arr42=mysql_fetch_array($query42);

$sql43="Select count(an)as count43 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '43%'  AND food !=  'NPO (�������, ���)'";
$query43 = mysql_query($sql43) or die (mysql_error());
$arr43=mysql_fetch_array($query43);

$sql44="Select count(an)as count44 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '44%'  AND food !=  'NPO (�������, ���)'";
$query44 = mysql_query($sql44) or die (mysql_error());
$arr44=mysql_fetch_array($query44);

$sql45="Select count(an)as count45 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '45%' AND food !=  'NPO (�������, ���)'";
$query45 = mysql_query($sql45) or die (mysql_error());
$arr45=mysql_fetch_array($query45);


/////////  ���͡�ҧ�ѹ  ���ѭ ///

$sql142="Select count(an)as count142 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '42%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query142 = mysql_query($sql142) or die (mysql_error());
$arr142=mysql_fetch_array($query142);

$sql143="Select count(an)as count143 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '43%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query143 = mysql_query($sql143) or die (mysql_error());
$arr143=mysql_fetch_array($query143);

$sql144="Select count(an)as count144 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '44%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query144 = mysql_query($sql144) or die (mysql_error());
$arr144=mysql_fetch_array($query144);

$sql145="Select count(an)as count145 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '45%' AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query145 = mysql_query($sql145) or die (mysql_error());
$arr145=mysql_fetch_array($query145);

/////////  ���͡�ҧ���  ���ѭ ///

$sql242="Select count(an)as count242 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '42%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query242 = mysql_query($sql242) or die (mysql_error());
$arr242=mysql_fetch_array($query242);

$sql243="Select count(an)as count243 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '43%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query243 = mysql_query($sql243) or die (mysql_error());
$arr243=mysql_fetch_array($query243);

$sql244="Select count(an)as count244 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '44%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query244 = mysql_query($sql244) or die (mysql_error());
$arr244=mysql_fetch_array($query244);

$sql245="Select count(an)as count245 from food1 Where regisdate like '$regisdate%' and bedpri='300.00' and typefood='��������' and bedcode like '45%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query245 = mysql_query($sql245) or die (mysql_error());
$arr245=mysql_fetch_array($query245);


//////////////////////// ����� ���ѭ ///

$fward=$arr42['count42']+$arr242['count242']+$arr142['count142']; 
$gward=$arr43['count43']+$arr243['count243']+$arr143['count143']; 
$vipward=$arr45['count45']+$arr245['count245']+$arr145['count145']; 
$icuward=$arr44['count44']+$arr244['count244']+$arr144['count144']; 

$sum1=$fward+$gward+$vipward+$icuward;



$avg=ceil($sum1/3);


///////////////////////// �� ��§���ѭ ///////////////////


////////////// ��§����� //////
//// �������  ��§�����///1.
$sql421="Select count(an)as count421 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '42%'  AND food !=  'NPO (�������, ���)'";
$query421= mysql_query($sql421) or die (mysql_error());
$arr421=mysql_fetch_array($query421);

$sql431="Select count(an)as count431 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '43%'  AND food !=  'NPO (�������, ���)'";
$query431 = mysql_query($sql431) or die (mysql_error());
$arr431=mysql_fetch_array($query431);

$sql441="Select count(an)as count441 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '44%' AND food !=  'NPO (�������, ���)' ";
$query441 = mysql_query($sql441) or die (mysql_error());
$arr441=mysql_fetch_array($query441);

$sql451="Select count(an)as count451 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '45%'  AND food !=  'NPO (�������, ���)'";
$query451 = mysql_query($sql451) or die (mysql_error());
$arr451=mysql_fetch_array($query451);


///  ���͡�ҧ�ѹ  ����� ///2.

$sql422="Select count(an)as count422 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '42%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query422 = mysql_query($sql422) or die (mysql_error());
$arr422=mysql_fetch_array($query422);

$sql432="Select count(an)as count432 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '43%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query432 = mysql_query($sql432) or die (mysql_error());
$arr432=mysql_fetch_array($query432);

$sql442="Select count(an)as count442 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '44%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query442 = mysql_query($sql442) or die (mysql_error());
$arr442=mysql_fetch_array($query442);

$sql452="Select count(an)as count452 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='����á�ҧ�ѹ' and bedcode like '45%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query452 = mysql_query($sql452) or die (mysql_error());
$arr452=mysql_fetch_array($query452);


///  �������  ����� ///3.

$sql423="Select count(an)as count423 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '42%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query423 = mysql_query($sql423) or die (mysql_error());
$arr423=mysql_fetch_array($query423);

$sql433="Select count(an)as count433 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '43%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query433 = mysql_query($sql433) or die (mysql_error());
$arr433=mysql_fetch_array($query433);

$sql443="Select count(an)as count443 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '44%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query443 = mysql_query($sql443) or die (mysql_error());
$arr443=mysql_fetch_array($query443);

$sql453="Select count(an)as count453 from food1 Where regisdate like '$regisdate%' and bedpri !='300.00' and typefood='��������' and bedcode like '45%'  AND food != 'NPO (�������, ���)' and food !='NPO (�������, ���) �����ҹ 1 �Ǵ' ";
$query453 = mysql_query($sql453) or die (mysql_error());
$arr453=mysql_fetch_array($query453);


$fward2=$arr421['count421']+$arr422['count422']+$arr423['count423']; 
$gward2=$arr431['count431']+$arr432['count432']+$arr433['count433']; 
$vipward2=$arr451['count451']+$arr452['count452']+$arr453['count453']; 
$icuward2=$arr441['count441']+$arr442['count442']+$arr443['count443']; 

$sum2=$fward2+$gward2+$vipward2+$icuward2;

$avg2=ceil($sum2/3);

$sum12=$sum1+$sum2;

$sumavg1=($avg*120)+($avg2*170);
$sumavg2=($avg*150)+($avg2*200);
?>
 <tr>
    <td><?=$value2;?></td>
    <td align="center"><?=$sum1;?></td>
    <td align="center"><?=$sum2;?></td>
    <td align="center"><?=number_format($sum12);?></td>
    <td align="right"><?=number_format($sumavg2);?></td>
  </tr>
  <? 
  $su1+=$sum1;
  $su2+=$sum2;
  $su3+=$sum12;
  $su4+=($sumavg2);

 }
   ?>
  <tr>
    <td align="center">���</td>
    <td align="center"><?=$su1;?></td>
    <td align="center"><?=$su2;?></td>
    <td align="center"><?=number_format($su3);?></td>
    <td align="right"><?=number_format($su4);?></td>
  </tr>
</table>
<br />
<table border="0" align="center" class="font">
  <tr>
    <td colspan="3" align="center">��Ǩ�١��ͧ</td>
  </tr>
  <tr>
    <td width="46">&nbsp;</td>
    <td>&nbsp;</td>
    <td>�.�.˭ԧ..................................</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="170">&nbsp;</td>
    <td width="179" align="center">( �ŸԪ� ᵧ����ѵ� )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>�.����ҡ�� þ.��������ѡ��������</td>
  </tr>
</table>

<?
}// ����
?>
