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
<?php 
include 'main_menu.php';
?>

<div><!-- InstanceBeginEditable name="detail" -->
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
      <td colspan="2" align="center" bgcolor="#CCCCCC">ʶԵԧҹ�ǴἹ��</td>
    </tr>
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td>��ǧ����</td>
      <td><select name="seltime" id="seltime">
        <option value="1" selected>������Ҫ���</option>
        <option value="2">�͡�����Ҫ���</option>
      </select>
      </td>
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
      <td><input type="submit" name="button" id="button" value="��ŧ" /></td>
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

include("../connect.inc");

if($_POST['d_start']==''){ // �����������͡�ѹ���
	
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


print "<div align=\"center\" class=\"forntsarabun\">����¹����Ѻ��ԡ��ᾷ��Ἱ��  ($sh  $dateshow)</div>";
print "<div align=\"center\" class=\"forntsarabun\">�ҹᾷ��Ἱ�� �͡��������Ţ FR-TTM-001/3 ��䢤��駷�� 01 �ѹ����ռźѧ�Ѻ�� 1 �.�.56</div><BR>";

if($_POST["seltime"]=="1"){  //������Ҫ���
	if($_POST['d_start']==''){ // �����������͡�ѹ���
	$query = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a','58130P','58131P','58130S','58131S')) AND (b.date BETWEEN '".$today."-01 08:00:00' AND '".$today."-31 16:00:00')  and  a.status='Y' and a.price >0 Group by b.date ,b.hn,a.code ";
	}else{  //���͡�ѹ���
	$query = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a','58130P','58131P','58130S','58131S')) AND (b.date BETWEEN '".$today." 08:00:00' AND '".$today." 16:00:00')  and  a.status='Y' and a.price >0 Group by b.date ,b.hn,a.code ";	
	}
}else if($_POST["seltime"]=="2"){  //�͡�����Ҫ���
	if($_POST['d_start']==''){ // �����������͡�ѹ���
	$today=($_POST['y_start']-543).'-'.$_POST['m_start'].'-'.date("d");
	$query = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a','58130P','58131P','58130S','58131S')) AND (b.date BETWEEN '".$today."-01 16:00:01' AND '".$today."-31 23:59:59')  and  a.status='Y' and a.price >0 Group by b.date ,b.hn,a.code ";
	}else{  //���͡�ѹ���
	$query = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a','58130P','58131P','58130S','58131S')) AND (b.date BETWEEN '".$today." 16:00:01' AND '".$today." 23:59:59')  and  a.status='Y' and a.price >0 Group by b.date ,b.hn,a.code ";	
	}
}else{
	$today=(date("Y")+543).'-'.date("m").'-'.date("d");
$query = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND ( a.code in ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a','58130P','58131P','58130S','58131S')) AND (b.date BETWEEN '".$today." 08:00:00' AND '".$today." 23:59:59')  and  a.status='Y' and a.price >0 Group by b.date ,b.hn,a.code ";
}
	//echo $query;
	
	$result = mysql_query($query) or die("Query failed ".$query."");

//echo $query;
?>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:#000;" class="forntsarabun">
  <tr bgcolor="#CCCCCC">
    <td align="center">�ӴѺ</td>
    <td align="center">����-ʡ�� ����Ѻ��ԡ��</td>
    <td align="center">��</td>
    <td align="center">HN</td>
    <td align="center">����-ʡ�� ��ѡ�ҹ</td>
    <td align="center">����ԹԨ����ä</td>
    <td align="center">�Է�ԡ���ѡ��</td>
    <td align="center">�Ѵ���駵���</td>
    <td align="center">�����˵�</td>
  </tr>
 <?   
 
$sql = "
CREATE TEMPORARY TABLE `appoint_tmp`
SELECT * FROM `appoint`
WHERE `date` LIKE '$today%'
AND `appdate` != '' 
AND `apptime` != '¡��ԡ��ùѴ'
";
mysql_query($sql);
 
 $i=1;
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
     
	//  Back up Old code
	//  $subdate=explode(" ",$date);
	//  $strsql2="SELECT  appdate   FROM appoint    WHERE  hn='$hn'  and date like '$subdate[0]%' ";
    list($subdate, $subdate) = explode(" ",$date);
    $strsql2 = "
    SELECT `appdate`
FROM `appoint_tmp`
WHERE `hn` = '$hn' 
AND `date` LIKE '$subdate%'
ORDER BY `row_id` DESC LIMIT 1
    ";
	 $objquery2  = mysql_query($strsql2);
	list($appdate) = mysql_fetch_row($objquery2);
		 
//echo $strsql2;
?>

  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$ptname;?></td>
    <td><?=$sex?></td>
    <td><?=$hn;?></td>
    <td><?=$staf_massage;?></td>
    <td><?=$diag;?></td>
    <td><?=$ptright;?></td>
    <td><?=$appdate;?></td>
    <td>&nbsp;</td>
  </tr>
  <? 	
  $i++;
  }
  
/*  print "�Ȫ��  ".$nsex." �� <BR>"; 
  print "��˭ԧ  ".$nsex2." ��"; */
  ?>
</table>
<BR />
<p>
<table width="100%" border="0" class="forntsarabun">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���ѹ�֡</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">( ........................................................................)</td>
    <td align="center">( ........................................................................)</td>
  </tr>
  <tr>
    <td align="center">���˹�ҷ���á��</td>
    <td align="center">ᾷ��Ἱ��</td>
  </tr>
  <tr>
    <td align="center">................/................../................../</td>
    <td align="center">................/................../................../</td>
  </tr>
</table>

</p>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>