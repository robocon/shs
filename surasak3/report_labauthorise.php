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
</style><form method="POST" action="report_labauthorise.php">
<input name="act" type="hidden" value="show">
<p><strong>��§ҹ��ǧ����㹡���͡�� Lab �ͧ�����·�����Ѻ��ԡ�ê�ǧ 06.00 �. �֧ 07.59 �.</strong></p>
    <strong>���͡��ǧ���� : 
    <select name="seltime" class="txt" id="seltime">
      <option value="1">06:00 - 06:59</option>
      <option value="2">07:00 - 07:59</option>
    </select>
    ��͹ : </strong>
  <select size="1" name="chkmonth" class="txt">
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
				echo "<select name='chkyear'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       &nbsp; 
       <input type="submit" value="���͡������" name="B1"  class="txt" />
</form>
<?
if($_POST["act"]=="show"){
$condition=($_POST["chkyear"]-543)."-".$_POST["chkmonth"];
$sql="select substring(orderdate,1,10) as neworderdate from orderhead where orderdate like '$condition%' group by substring(orderdate,1,10)";
//echo $sql;
$query=mysql_query($sql); 
$num=mysql_num_rows($query); 

if($_POST["seltime"]=="1"){
	$showtime="06:00:00 - 06:59:59";
	$head1="���� 06.00 �. �֧ 07.59 �.";
}else if($_POST["seltime"]=="2"){
	$showtime="07:00:00 - 07:59:59";
	$head1="���� 07.00 �. �֧ 07.59 �.";
}
?>
<div align="center"><strong>��ǧ���ҷ�����Ѻ��ԡ�� <?=$showtime;?></strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td height="35" align="center" bgcolor="#999999"><strong>�ѹ / ��͹ / ��</strong></td>
    <td align="center" bgcolor="#999999"><strong>�ӹǹ</strong></td>
    <td align="center" bgcolor="#999999"><strong><?=$head1;?></strong></td>
    <td align="center" bgcolor="#999999"><strong>���� 08.00 �. �֧ 08.59 �.</strong></td>
    <td align="center" bgcolor="#999999"><strong>���� 09.00 �֧ 12.00 �.</strong></td>
  </tr>
 <? 
if(empty($num)){
echo "
	<tr>
		<td colspan='5' align='center' bgcolor='#FFCC99'>---------------------------------------- ����բ����� ----------------------------------------</td>
	</tr>
";
}
$tables=0;	
while($rows=mysql_fetch_array($query)){
$tables++;

list($y,$m,$d)=explode("-",$rows["neworderdate"]);
$y=$y+543;
$showdate="$d/$m/$y";
 
if($_POST["seltime"]=="1"){
	$sqltemp1="select * from resulthead as tb1 inner join resultdetail as tb2 on tb1.autonumber=tb2.autonumber where (tb1.orderdate between '$rows[neworderdate] 06:20:00' and '$rows[neworderdate] 07:19:59') group by tb1.labnumber";
}else if($_POST["seltime"]=="2"){
	$sqltemp1="select * from resulthead as tb1 inner join resultdetail as tb2 on tb1.autonumber=tb2.autonumber where (tb1.orderdate between '$rows[neworderdate] 07:20:00' and '$rows[neworderdate] 08:19:59') group by tb1.labnumber";
}	
	//echo $sqltemp1;
	$querytemp1=mysql_query($sqltemp1); 
	$numchk1=mysql_num_rows($querytemp1);
	$showtime1=0;
	$showtime2=0;
	$showtime3=0;
	while($result=mysql_fetch_array($querytemp1)){
		$chktime = substr($result["authorisedate"],11,8);
		if($chktime < "07:20:00"){
			$showtime1++;
		}else if($chktime >= "07:20:00" and $chktime < "08:20:00"){
			$showtime2++;
			
		}else if($chktime >= "08:20:00" and $chktime <="12:20:00"){
			$showtime3++;
		}
	}
			$sumshowtime1=$sumshowtime1+$showtime1;
			$sumshowtime2=$sumshowtime2+$showtime2;
			$sumshowtime3=$sumshowtime3+$showtime3;
	?>   
  <tr>
    <td align="center"><?=$showdate;?></td>
    <td align="center">
    <?
	if($_POST["seltime"]=="1"){
	$sql1="select * from resulthead where orderdate between '$rows[neworderdate] 06:20:00' and '$rows[neworderdate] 07:19:59' group by labnumber";
	}else if($_POST["seltime"]=="2"){
	$sql1="select * from resulthead where orderdate between '$rows[neworderdate] 07:20:00' and '$rows[neworderdate] 08:19:59' group by labnumber";
	}
	//echo $sql1."<br>";
	$query1=mysql_query($sql1); 
	$num1=mysql_num_rows($query1); 	
	echo $num1;
	$sumtime=$sumtime+$num1;
	?>    </td>
    <td align="center">
    <?
	echo $showtime1;
	?>	</td>
    <td align="center">
	<?
	echo $showtime2;
	?>    </td>
    <td align="center">
	<?
	echo $showtime3;
	?>    </td>
  </tr>
<?
}
?>  
  <tr>
    <td align="right" bgcolor="#CCCCCC"><strong>���������</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>
      <?=$sumtime;?>
    </strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>
      <?=$sumshowtime1;?>
    </strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>
      <?=$sumshowtime2;?>
    </strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>
      <?=$sumshowtime3;?>
    </strong></td>
  </tr>
</table>
<?
}
?>

