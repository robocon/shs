<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style><div align="center">��§ҹ��ͧ��</div>
<form name="form1" method="post" action="<? $PHP_SELF;?>">
<input name="act" type="hidden" value="show">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <strong>���͡��͹ : </strong><select size="1" name="month" class="txt">
    <option selected>-------���͡-------</option>
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
    <strong>���͡�� �.�. : </strong>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
                    </td>
    <td>��ǧ���� : 
      <select name="age" id="age">
        <option value="50">�����ҧ 50 - 59 ��</option>
        <option value="60">�����ҧ 60 - 65 ��</option>
        <option value="70">����� 66 �բ���</option>
      </select>      </td>
    <td>�ä : 
      <select name="diag" id="diag">
        <option value="esrd">esrd</option>
        <option value="none">none esrd</option>
      </select>      </td>
  </tr>
  <tr>
    <td colspan="3" align="center"><input type="submit" name="button" id="button" value="����§ҹ"></td>
    </tr>
</table>
</form>
<hr>
<?
if($_POST["act"]=="show"){
include("connect.inc");  
$arr=array("1BREX","1NID","1NID-C","1VOL-C","1VOL-N","1VOL-NN","1IBRU400","1IBRU400-N","1ARCO","1ARCO30","1ARCO_60","1CELE200*","1CELE_400","1MOBI","1MOBI-C","1MOB7.5","1NAPR","1PONS");
foreach($arr as $value){
	$sql="select tradname, genname from druglst where drugcode like '$value%'";
	//echo $sql;
	$query=mysql_query($sql);
	list($tradname,$genname)=mysql_fetch_array($query);
	
?>
<div>������ : <?=$value;?> ���͡�ä�� : <?=$tradname;?> �������ѭ : <?=$genname;?></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99">�ӴѺ</td>
    <td width="19%" align="center" bgcolor="#66CC99">�ѹ/��͹/��</td>
    <td width="6%" align="center" bgcolor="#66CC99">HN</td>
    <td width="31%" align="center" bgcolor="#66CC99">���� - ���ʡ��</td>
    <td width="6%" align="center" bgcolor="#66CC99">�ä</td>
    <td width="9%" align="center" bgcolor="#66CC99">�Ը���</td>
    <td width="14%" align="center" bgcolor="#66CC99">�ӹǹ</td>
    <td width="11%" align="center" bgcolor="#66CC99">ICR</td>
  </tr>
<?
if($_POST["diag"]=="esrd"){
$date=$_POST["year"]."-".$_POST["month"];
$sql1="SELECT a.date, a.hn, a.drugcode, a.amount, a.slcode, b.ptname, b.diag, c.age, c.icd10 
FROM drugrx as a 
INNER JOIN phardep as b ON a.hn=b.hn 
INNER JOIN opday AS c ON a.hn = c.hn 
WHERE a.drugcode='$value' and a.amount >0 and a.date like '$date%' and c.icd10='N180' 
GROUP BY a.date,a.hn";
}else{
$sql1="SELECT a.date, a.hn, a.drugcode, a.amount, a.slcode, b.ptname, b.diag, c.age, c.icd10 
FROM drugrx as a 
INNER JOIN phardep as b ON a.hn=b.hn 
INNER JOIN opday AS c ON a.hn = c.hn 
WHERE a.drugcode='$value' and a.amount >0 and a.date like '$date%' and c.icd10='N180' 
GROUP BY a.date,a.hn";
}
//echo $sql1;
$result=mysql_query($sql1);
$i=0;
while($rows=mysql_fetch_array($result)){
$chkdate=substr($rows["date"],0,10);

$chkage=substr($rows["age"],0,2);

if(($_POST["age"]=="50" && ($chkage >=50 &&  $chkage <=59)) || ($_POST["age"]=="60" && ($chkage >=60 &&  $chkage <=65)) || ($_POST["age"]=="70" && ($chkage >=66))){
$i++;
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["date"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["ptname"];?></td>
    <td><? if(empty($rows["diag"])){ echo "&nbsp;";}else{ echo $rows["diag"]; }?></td>
    <td><?=$rows["slcode"];?></td>
    <td><?=$rows["amount"];?></td>
    <td><?=$chkage;?></td>
  </tr>
<?
	}
}
?>  
</table>
<hr>
<?
	}
}
?>
