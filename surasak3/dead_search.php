<? 
session_start();
?>

<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.forntsarabun2 {
	font-family: "TH SarabunPSK";
	font-size: 16pt;
	border-collapse:collapse;
}
.fornbody {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<div id="no_print">
  <form name="f1" action="" method="post">
    <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
      <tr class="forntsarabun">
        <td colspan="2" bgcolor="#99CC99">��§ҹ���������ª��Ե</td>
      </tr>
      <tr class="forntsarabun">
        <td  align="right"><span class="forntsarabun">��͹/��</span></td>
        <td >
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
          </select><? 
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
      </tr>
      <tr>
        <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>
        &nbsp;&nbsp;
          <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">--> (<a  class="forntsarabun2" target="_top" href="../nindex.htm">&lt;&lt; ��Ѻ������ѡ</a>)</td>
      </tr>
  </table>
  </form>
  <HR>
</div>

<?php
if($_POST['submit']){
	
?>
<!--<script>
//window.print() ;
</script>-->
<?	
	
include("../connect.inc"); 
$month=$_POST['m_start'];

$year1=$_POST['y_start'];

$code=$_GET['code'];

$date1=$year1.'-'.$month;



switch($_POST['m_start']){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}
	  $dateshow=$printmonth." ".$_POST['y_start'];
	
	
	$sql="SELECT * FROM `ipcard` WHERE `dctype` LIKE '%Dead%'  and dcdate like '$date1%'  ";
	$query = mysql_query($sql)or die (mysql_error());
	$num=mysql_num_rows($query);

$i=1;
?>
 <h1 class="forntsarabun2" align="center">��ª��ͼ��������ª��Ե ��͹ <?=$dateshow;?></h1>
<table  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun2">
  <tr align="center">
    <td>�ӴѺ</td>
    <td>�ѹ��� admit</td>
    <td>HN</td>
    <td>AN</td>
    <td>����-���ʡ��</td>
    <td>����</td>
    <td>�Է��</td>
    <td>diag</td>
    <td>�ѹ����˹���</td>
    <td>ward</td>
    <td>ᾷ��</td>
    </tr>
  <? 	
  if(empty($num)){
  	echo "<tr><td colspan='11' align='center' style='color:red'>-------------------------------------- ����բ����ŷ���ҹ���� --------------------------------------</td></tr>";
  }
  while($arr=mysql_fetch_array($query)){ ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$arr['date'];?>&nbsp;</td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['an'];?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['age'];?></td>
    <td><?=$arr['ptright'];?></td>
    <td><?=$arr['diag'];?></td>
    <td><?=$arr['dcdate'];?></td>
    <td><?=$arr['my_ward'];?>&nbsp;</td>
    <td><?=$arr['doctor'];?></td>
    </tr>
  <?  
  $i++;
  } ?>
</table>

<?  
}
	  
	  ?>
</div>
</body>
