<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>�к���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<div id="no_print">
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>������ç��Һ��</span></a></li>
        <li><a href="report_massage_diag.php" class="parent"><span>ʶԵԧҹ�ǴἹ��</span></a></li>
     	
         <li><a href="#"><span>��§ҹ�ǴἹ��</span></a></li>
     
     <ul>
	  	<li class="last"><a href="report_massage.php"><span>������</span></a></li>
	  	<li class="last"><a href="report_staf_massage.php"><span>�¡��� ���Ǵ���Ф�</span></a></li>
          	<li class="last"><a href="report_massage_emg.php"><span>੾�� EMG</span></a></li>
            <li class="last"><a href="report_massage_foot.php"><span>�Ǵ������</span></a></li>
        
       	</ul>
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}.forntsarabun2 {
	font-family: "TH SarabunPSK";
	font-size: 22PX;
	font-weight:bold;
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
    <tr class="forntsarabun2">
      <td colspan="2" align="center" bgcolor="#CCCCCC">ʶԵԧҹ�ǴἹ�� ���Ǵ���Ф�</td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr bordercolor="#666666" class="forntsarabun">
      <td  align="right"><span class="forntsarabun">����� -�ѹ/ ��͹/��</span></td>
      <td ><input name="d_start1" type="text"  class="forntsarabun" id="d_start1" value="01" size="5"/>
        <? $m=date('m'); ?>
        <select name="m_start1" class="forntsarabun" id="m_start1">
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
				echo "<select name='y_start1' class='forntsarabun'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
          <?=$i;?>
          </option>
        <?
				}
				echo "<select>";
				?></td>
    </tr>
    <tr bordercolor="#666666" class="forntsarabun">
      <td  align="right">�֧  -�ѹ/ ��͹/��</td>
      <? $calday = cal_days_in_month(CAL_GREGORIAN , date('m'), date("Y")+543);?>
      <td ><input name="d_start2" type="text"  class="forntsarabun" id="d_start2" value="<?=$calday;?>" size="5"/>
        <? $m=date('m'); ?>
        <select name="m_start2" class="forntsarabun" id="m_start2">
          <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
          <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
          <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
          <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
          <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
          <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
          <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
          <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
          <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
          <option value="10" <? if($m=='10'){ echo "selected"; }?> >���Ҥ�</option>
          <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
          <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
        </select>
        <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start2' class='forntsarabun'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
          <?=$i;?>
          </option>
        <?
				}
				echo "<select>";
				?></td>
    </tr>
    <tr bordercolor="#666666" class="forntsarabun">
      <td  align="right">���Ǵ</td>
      <td >
        <select name="staf_massage" class="forntsarabun" id="staf_massage">
          <option value="">--���͡--</option>
          <?
		  include("../connect.inc");
		   $sql_staf="SELECT * FROM `staf_massage` Order by row_id asc";
		  		$query_staf=mysql_query($sql_staf);
				while($arr_staf=mysql_fetch_array($query_staf)){
		  ?>
          <option value="<?=$arr_staf['name'];?>"><?=$arr_staf['name'];?></option>
    <? } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><a target="_self"  href='../../nindex.htm' class="forntsarabun2">�����</a></td>
      <td><input name="button" type="submit" class="forntsarabun2" id="button" value="��ŧ" />
        <span class="forntsarabun">*�й�����͡��§ҹ�� �ǹ͹��Ѻ</span></td>
    </tr>
  </table>
</form>
<br />
</div>

<?
if($_POST['button']){

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

include("../connect.inc");


$y1=$_POST['y_start1'];
$y2=$_POST['y_start2'];
$date1=$y1.'-'.$_POST['m_start1'].'-'.$_POST['d_start1'].' '."00:00:00";
$date2=$y2.'-'.$_POST['m_start2'].'-'.$_POST['d_start2'].' '."23:59:59";
	
$staf_massage=$_POST['staf_massage'];


print "<div align=\"center\" class=\"forntsarabun\">ʶԵԧҹᾷ��Ἱ��   �����  $date1   �֧  $date2</div>";
print "<div align=\"center\" class=\"forntsarabun\">���Ǵ $staf_massage</div>";



$query = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a')) AND (b.date between '$date1' and '$date2' ) and  a.status='Y' and a.price >0  and staf_massage='$staf_massage' Group by b.date ,b.hn,a.code";
$result = mysql_query($query) or die("Query failed ".$query."");

//echo $query;
?>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:#000;" class="forntsarabun">
  <tr bgcolor="#CCCCCC">
    <td align="center">�ӴѺ</td>
    <td align="center">�ѹ���</td>
    <td align="center">����-ʡ�� ����Ѻ��ԡ��</td>
    <td align="center">��</td>
    <td align="center">HN</td>
    <td align="center">����-ʡ�� ��ѡ�ҹ</td>
    <td align="center">����ԹԨ����ä</td>
    <td align="center">�Է�ԡ���ѡ��</td>
    <td align="center">�����˵�</td>
  </tr>
 <?   
 $i=1;
 $r=0;
 while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$tvn,$staf_massage,$diag,$ptright) = mysql_fetch_row ($result)) {
	 
	 $sql = "SELECT sex  FROM `opcard` WHERE  hn='".$hn."' ";
	 $query = mysql_query($sql) or die("Query failed ".$sql."");
	 $arr=mysql_fetch_array($query);
	 
	 if($arr['sex']=='�' || $arr['sex']=='1'){
		$sex= "���"; 
		
		$nsex++;
	 }else if($arr['sex']=='�' || $arr['sex']=='2'){
		$sex= "˭ԧ"; 
		$nsex2++;
	 }
		 
$r++;
  	  if($r=='21'){
$r=1;


echo "<table width='100%' border='0' class='forntsarabun'>
  <tr>
    <td><b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���ѹ�֡</td>
    <td align='center'>&nbsp;</td>
  </tr>
  <tr>
    <td align='center'>( ........................................................................)</td>
    <td align='center'>( ........................................................................)</td>
  </tr>
  <tr>
    <td align='center'>ᾷ��Ἱ��</td>
    <td align='center'>���˹��Ἱ�ᾷ��ҧ���͡</td>
  </tr>
  <tr>
    <td align='center'>................/................../................../</td>
    <td align='center'>................/................../................../</td>
  </tr>
</table>";
		echo "</table>";
		
		//echo "<div style='page-break-after: always'> ";
		echo "<div style='page-break-before: always'> ";
		
print "<div align=\"center\" class=\"forntsarabun\">ʶԵԧҹᾷ��Ἱ��   �����  $date1   �֧  $date2</div>";
print "<div align=\"center\" class=\"forntsarabun\">���Ǵ $staf_massage</div>";	

		echo "<table width='100%' border='1' align='center' cellpadding='0' cellspacing='0' style='border-collapse:collapse; border-color:#000;' class='forntsarabun'>
  <tr bgcolor='#CCCCCC'>
    <td align='center'>�ӴѺ</td>
    <td align='center'>�ѹ���</td>
    <td align='center'>����-ʡ�� ����Ѻ��ԡ��</td>
    <td align='center'>��</td>
    <td align='center'>HN</td>
    <td align='center'>����-ʡ�� ��ѡ�ҹ</td>
    <td align='center'>����ԹԨ����ä</td>
    <td align='center'>�Է�ԡ���ѡ��</td>
    <td align='center'>�����˵�</td>
  </tr>";
?>


<? } ?>


  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$date;?></td>
    <td><?=$ptname;?></td>
    <td><?=$sex?></td>
    <td><?=$hn;?></td>
    <td><?=$staf_massage;?></td>
    <td><?=$diag;?></td>
    <td><?=$ptright;?></td>
    <td>&nbsp;</td>
  </tr>
  <? 	
  $i++;
  }
  echo "</div>";
/*  print "�Ȫ��  ".$nsex." �� <BR>"; 
  print "��˭ԧ  ".$nsex2." ��"; */
  ?>
</table>
<BR />
<p>
<table width="100%" border="0" class="forntsarabun">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���ѹ�֡</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">( ........................................................................)</td>
    <td align="center">( ........................................................................)</td>
  </tr>
  <tr>
    <td align="center">ᾷ��Ἱ��</td>
    <td align="center">���˹�ҧҹᾷ��Ἱ��</td>
  </tr>
  <tr>
    <td align="center">................/................../................../</td>
    <td align="center">................/................../................../</td>
  </tr>
</table>

</p>

<? } ?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>