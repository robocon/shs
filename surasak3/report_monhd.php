<style type="text/css">
<!--
.forntsarabun {
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
<form id="form1" name="form1" method="post" action="">
  <table  border="0" align="center">
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC">�١˹��͡�</td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td>�ѹ/��͹/��</td>
      <td><select name='d_start' class="font1">
        <option value="" selected="selected">--������͡---</option>
        <? 
				//$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					//if($dd==$d){
					?>
        <option value="<?=$d;?>"> <?=$d;?></option>
        <?
				//	}else{
				?>
    <!--    <option value="<?//=$d;?>"> <?//=$d;?> </option>-->
        <?
				//}
				}
				
				?>
      </select>
        <? $m=date('m'); ?>
        <select name="m_start" class="font1">
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
				echo "<select name='y_start' class='font1'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
          <?=$i;?>
        </option>
        <?
				}
				echo "</select>";
				?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="��ŧ" /> <a target=_self  href='../nindex.htm' class="forntsarabun"><------ �����</a></td>
    </tr>
  </table>
</form>
<br />
</div>

<?
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

include("connect.inc");

if($_POST['d_start']==''){
	
$today=$_POST['y_start'].'-'.$_POST['m_start'];
$sh="��Ш���͹";
$shtodate=($_POST['y_start']-543).'-'.$_POST['m_start'];
$dateshow=$printmonth." ".$_POST['y_start'];


}else{
	
$today=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
$sh="��Ш��ѹ��� ";	
$dateshow=$_POST['d_start']." ".$printmonth." ".$_POST['y_start'];
	
$shtodate=($_POST['y_start']-543).'-'.$_POST['m_start'].'-'.$_POST['d_start'];


}

	
	


print "<div align=\"center\" class=\"forntsarabun\">�١˹��͡�  $sh  $dateshow</div><BR>";

$query = "SELECT  count(*)as count,credit_detail FROM  `opacc` WHERE 1  AND  `credit` ='hd' and date LIKE '".$today."%' and price>0 group by credit_detail ";
	
	
	$result = mysql_query($query) or die("Query failed ".$query."");

//echo $query;
?>
<script language="JavaScript">
	function fncOpenPopup()
	{
		window.open('report_monhd_detail.php','width=700,height=500,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
	}
</script>
<table border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:#000;" class="forntsarabun">
  <tr bgcolor="#CCCCCC">
    <td align="center">�ӴѺ</td>
    <td align="center">credit_detail</td>
    <td align="center">�ӹǹ</td>

  </tr>
 <?   
 $i=1;
 while (list ($count,$credit_detail) = mysql_fetch_row ($result)) {
	 

?>

  <tr>
    <td align="center"><?=$i;?></td>
    <td><a href="report_monhd_detail.php?tdate=<?=$today;?>&tcredit=<?=$credit_detail;?>" target="_blank"><?=$credit_detail;?></a></td>
    <td><?=$count;?></td>
  </tr>
  <? 	
  $i++;
  }
  
/*  print "�Ȫ��  ".$nsex." �� <BR>"; 
  print "��˭ԧ  ".$nsex2." ��"; */
  ?>
</table>