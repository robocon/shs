<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ��Ш���͹</title>
<style type="text/css">
.forntsarabun1 {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.forntsarabun1 {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<body>

<? include("connect.inc");  ?>
<h1 class="forntsarabun">��¡����� Xray �ҡᾷ��</h1>
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">�ѹ���</span></td>
    <td ><select name='d_start' class="forntsarabun">
    			 <? 
				$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					if($dd==$d){
					?>
                    
                    <option value="<?=$d;?>" selected><?=$d;?></option>
				<?
					}else{
				?>
                <option value="<?=$d;?>"><?=$d;?></option>
                <?
				}
				}
				
				?>
            </select><? $m=date('m'); ?>
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
				?></td>&nbsp;

    </tr>
  <tr>
    <td colspan="3" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
      <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a><!--&nbsp;&nbsp; 
      <a href="xray_menu.php" class="forntsarabun">������§ҹ</a>-->
      </td>
  </tr>
</table>
</form>
<br/>

<? 
if($_POST['submit']=="����"){

include("connect.inc"); 

$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];


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
	
   $dateshow=$_POST['d_start']." ".$printmonth." ".$_POST['y_start'];

print "��§ҹ������ XRAY   $dateshow <br/><br/> ";

$Thidate = (date("Y")+543).date("-m-d");
  $sql = "Select distinct xrayno, date_format(date,'%H:%i') as time2, hn, vn, yot, name, sname, doctor, xrayno, detail_all From xray_doctor where date like '".$date1."%' AND orderby = 'DR' ";
$result = mysql_query($sql)or die (mysql_error());
$rows=mysql_num_rows($result);
?>
��¡����觨ҡᾷ��
<TABLE border="3" bordercolor="#FFFFFF" style='BORDER-COLLAPSE: collapse' width="100%" >
<TR  bgcolor="#3366FF" style="font-family:  MS Sans Serif; font-size: 14 px;	color:#FFFFFF;	font-weight: bold;">
	<TD align="center" >No.</TD>
	<TD align="center" >����</TD>
	<TD align="center" >���� - ʡ��</TD>
	<TD align="center" >ᾷ�������</TD>
</TR>

  <?php
	$i=1;
	  
	while($arr = mysql_fetch_assoc($result)){

		if($i % 2 == 0){
			$bgcolor="#FFFFFF";
		}else{
			$bgcolor="#BFFFBF";
		}
		
		echo "<TR bgcolor=\"",$bgcolor,"\">";
			echo "<TD align=\"center\" >",$i,"</TD>";
			echo "<TD align=\"center\" >",$arr["time2"],"</TD>";
			echo "<TD align=\"center\" >$arr[name] $arr[sname]</A></TD>";
			echo "<TD align=\"center\" >$arr[doctor]</TD>";
		echo "</TR>";
		echo "<TR bgcolor=\"",$bgcolor,"\">";
			echo "<TD colspan=\"1\" >&nbsp;</TD>";
			echo "<TD colspan=\"3\" >",nl2br($arr["detail_all"]),"</TD>";
		echo "</TR>";
		echo "<TR bgcolor=\"#FFFF06\">";
			echo "<TD colspan=\"4\" height=\"5\"></TD>";
		echo "</TR>";
		$i++;

	}
	?>
</TABLE>
<?
} 
?></body>
</html>