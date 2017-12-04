<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style><div align="center">รายงานห้องยา</div>
<form name="form1" method="post" action="<? $PHP_SELF;?>">
<input name="act" type="hidden" value="show">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <strong>เลือกเดือน : </strong><select size="1" name="month" class="txt">
    <option selected>-------เลือก-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>มกราคม</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>กุมภาพันธ์</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>มีนาคม</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>เมษายน</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>พฤษภาคม</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>มิถุนายน</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>กรกฎาคม</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>สิงหาคม</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>กันยายน</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>ตุลาคม</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>พฤศจิกายน</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>ธันวาคม</option>

  </select>    
    <strong>เลือกปี พ.ศ. : </strong>
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
    <td>ช่วงอายุ : 
      <select name="age" id="age">
        <option value="50">ระหว่าง 50 - 59 ปี</option>
        <option value="60">ระหว่าง 60 - 65 ปี</option>
        <option value="70">ตั้งแต่ 66 ปีขึ้นไป</option>
      </select>      </td>
    <td>โรค : 
      <select name="diag" id="diag">
        <option value="esrd">esrd</option>
        <option value="none">none esrd</option>
      </select>      </td>
  </tr>
  <tr>
    <td colspan="3" align="center"><input type="submit" name="button" id="button" value="ดูรายงาน"></td>
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
<div>รหัสยา : <?=$value;?> ชื่อการค้า : <?=$tradname;?> ชื่อสามัญ : <?=$genname;?></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99">ลำดับ</td>
    <td width="19%" align="center" bgcolor="#66CC99">วัน/เดือน/ปี</td>
    <td width="6%" align="center" bgcolor="#66CC99">HN</td>
    <td width="31%" align="center" bgcolor="#66CC99">ชื่อ - นามสกุล</td>
    <td width="6%" align="center" bgcolor="#66CC99">โรค</td>
    <td width="9%" align="center" bgcolor="#66CC99">วิธีใช้</td>
    <td width="14%" align="center" bgcolor="#66CC99">จำนวน</td>
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
