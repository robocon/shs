<?
session_start();
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.txt {	font-family: TH SarabunPSK;
	font-size: 18px;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
</head>

<body>
<p align="center" style="margin-top: 20px;"><strong>���͡�ѹ����ͧ��ô٢����� Diag Not Found �Է���ԡ���µç</strong></p>
<div align="center">
  <form method="post" action="report_diagnotfound_cscd.php">
    <input type="hidden" name="act" value="show" />
    <strong>�����ҧ�ѹ��� : </strong>
    <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt" />
    <strong>���͡��͹ : </strong>
    <select size="1" name="month1" class="txt">
      <option selected="selected">-------���͡-------</option>
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
    <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
      <?=$i;?>
    </option>
    <?
				}
				echo "<select>";
				?>
    &nbsp; <strong>�֧�ѹ���</strong>
    <input name="date2" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt" />
    <strong>���͡��͹ : </strong>
    <select size="1" name="month2" class="txt">
      <option selected="selected">-------���͡-------</option>
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
    <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
      <?=$i;?>
    </option>
    <?
				}
				echo "<select>";
				?>
    <input type="submit" value="�٢�����" name="B1"  class="txt" />
    &nbsp;&nbsp;
    <input type="button" value="�������ѡ" name="B2"  class="txt" onclick="window.location='../nindex.htm' " />
  </form>
</div>
<?
if($_POST["act"]=="show"){
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
?>
<hr />
<div align="center" style="margin-top: 20px;"><strong>��§ҹ�ʴ������� Diag Not Found �Է���ԡ���µç</strong></div>
<div align="center">����ҧ�ѹ���
  <?=$showdate1;?>
  �֧�ѹ���
  <?=$showdate2;?>
</div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>�ѹ/��͹/��</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="19%" align="center" bgcolor="#66CC99"><strong>���ͼ�����</strong></td>
    <td width="16%" align="center" bgcolor="#66CC99"><strong>������ç��Һ��</strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>Doctor</strong></td>
    <td width="20%" align="center" bgcolor="#66CC99"><strong>Diagnosis</strong></td>
  </tr>
  <?
$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

$sql="CREATE TEMPORARY TABLE reportdiagnotfoundcscd select * from opacc where (txdate >= '$chkdate1 00:00:00' and txdate <='$chkdate2 23:59:59') AND credit =  '���µç' AND (an='' OR an IS NULL) AND icd10_cscd!='y' group by hn,vn";
//echo $sql;
$query=mysql_query($sql);

$querytmp="SELECT * FROM reportdiagnotfoundcscd order by txdate ASC";
$resulttmp = mysql_query($querytmp) or die("Query reportdiagnotfoundcscd failed");
$i=0;
while($rows=mysql_fetch_array($resulttmp)){
$chkdate=substr($rows["txdate"],0,10);
$chkhn=$rows["hn"];
$chkvn=$rows["vn"];

$sql1="select * from opday where thidate like '$chkdate%' and hn='$chkhn' AND vn =  '$chkvn' and (icd10='' OR icd10 IS NULL) ORDER BY ABS(vn) ASC";
//echo $sql1."<br>";
$query1=mysql_query($sql1);
$num=mysql_num_rows($query1);
$result=mysql_fetch_array($query1);
if($num > 0){
$i++;
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["txdate"]?></td>
    <td align="center"><?=$rows["vn"]?></td>
    <td align="center"><?=$rows["hn"]?></td>
    <td><?=$result["ptname"]?></td>
    <td><?=$result["toborow"]?></td>
    <td><? if(empty($result["doctor"])){ echo "&nbsp;";}else{ echo $result["doctor"];}?></td>
    <td><? if(empty($result["diag"])){ echo "&nbsp;";}else{ echo $result["diag"];}?></td>
  </tr>
  <?
  }
}
?>
</table>
<?
}
?>
</body>
</html>
