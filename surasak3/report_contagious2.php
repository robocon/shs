<?
session_start();
include("connect.inc");
//echo $DatabaseName;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>รายงานการเฝ้าระวังโรคติดต่อสำคัญในกำลังพลและครอบครัว ทบ.</title>
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
<p align="center" style="margin-top: 20px;"><strong>เลือกเดือนที่ต้องการดูข้อมูลการเฝ้าระวังโรคติดต่อสำคัญในกำลังพลและครอบครัว ทบ.</strong>
</p>
<div align="center">
  <form method="post" action="report_contagious2.php">
    <input type="hidden" name="act" value="show" />
    <strong>เลือกเดือน : </strong>
    <select size="1" name="month1" class="txt">
      <option selected="selected">-------เลือก-------</option>
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
     &nbsp;&nbsp;  
    <input type="submit" value="ดูข้อมูล" name="B1"  class="txt" />
    &nbsp;&nbsp;
    <input type="button" value="ไปเมนูหลัก" name="B2"  class="txt" onclick="window.location='../nindex.htm' " />
  </form>
</div>
<?
if($_POST["act"]=="show"){
$showdate1=$_POST["month1"]."-".$_POST["year1"];
$chkdate=$_POST["year1"]."-".$_POST["month1"];

$sqlg="CREATE TEMPORARY TABLE reportopday select * from opday where thidate like '$chkdate%'";
//echo $sqlg;
$queryg=mysql_query($sqlg);

$querygtmp="SELECT * FROM reportopday";
$resulttmp = mysql_query($querygtmp) or die("Query reportopday failed");


$sqlg11="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'A01%' OR icd10 LIKE 'A02%' OR icd10 LIKE 'A03%' OR icd10 LIKE 'A04%' OR icd10 LIKE 'A05%' OR icd10 LIKE 'A08%' OR icd10 LIKE 'A09%') ";
//echo $sqlg11;
$queryg11=mysql_query($sqlg11);
$numg11=mysql_num_rows($queryg11);

//echo "--->".$numg11;

$sqlg21="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'A01%' OR icd10 LIKE 'A02%' OR icd10 LIKE 'A03%' OR icd10 LIKE 'A04%' OR icd10 LIKE 'A05%' OR icd10 LIKE 'A08%' OR icd10 LIKE 'A09%') ";
//echo $sqlg21;
$queryg21=mysql_query($sqlg21);
$numg21=mysql_num_rows($queryg21);

$sqlg31="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'A01%' OR icd10 LIKE 'A02%' OR icd10 LIKE 'A03%' OR icd10 LIKE 'A04%' OR icd10 LIKE 'A05%' OR icd10 LIKE 'A08%' OR icd10 LIKE 'A09%')";
//echo $sqlg31;
$queryg31=mysql_query($sqlg31);
$numg31=mysql_num_rows($queryg31);

$sqlg41="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'A01%' OR icd10 LIKE 'A02%' OR icd10 LIKE 'A03%' OR icd10 LIKE 'A04%' OR icd10 LIKE 'A05%' OR icd10 LIKE 'A08%' OR icd10 LIKE 'A09%')";
//echo $sqlg41;
$queryg41=mysql_query($sqlg41);
$numg41=mysql_num_rows($queryg41);

$sumg1=$numg11+$numg21+$numg31+$numg41;



$sqlg12="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'A015%') ";
//echo $sqlg12;
$queryg12=mysql_query($sqlg12);
$numg12=mysql_num_rows($queryg12);

//echo "--->".$numg11;

$sqlg22="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'A15%') ";
//echo $sqlg22;
$queryg22=mysql_query($sqlg22);
$numg22=mysql_num_rows($queryg22);

$sqlg32="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'A15%')";
//echo $sqlg32;
$queryg32=mysql_query($sqlg32);
$numg32=mysql_num_rows($queryg32);

$sqlg42="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'A15%')";
//echo $sqlg42;
$queryg42=mysql_query($sqlg42);
$numg42=mysql_num_rows($queryg42);

$sumg2=$numg12+$numg22+$numg32+$numg42;




$sqlg13="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'A90%' OR icd10 LIKE 'A91%') ";
//echo $sqlg13;
$queryg13=mysql_query($sqlg13);
$numg13=mysql_num_rows($queryg13);

//echo "--->".$numg11;

$sqlg23="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'A90%' OR icd10 LIKE 'A91%') ";
//echo $sqlg23;
$queryg23=mysql_query($sqlg23);
$numg23=mysql_num_rows($queryg23);

$sqlg33="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'A90%' OR icd10 LIKE 'A91%')";
//echo $sqlg33;
$queryg33=mysql_query($sqlg33);
$numg33=mysql_num_rows($queryg33);

$sqlg43="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'A90%' OR icd10 LIKE 'A91%')";
//echo $sqlg43;
$queryg43=mysql_query($sqlg43);
$numg43=mysql_num_rows($queryg43);

$sumg3=$numg13+$numg23+$numg33+$numg43;




$sqlg14="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'A920%') ";
//echo $sqlg14;
$queryg14=mysql_query($sqlg14);
$numg14=mysql_num_rows($queryg14);

//echo "--->".$numg11;

$sqlg24="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'A920%') ";
//echo $sqlg24;
$queryg24=mysql_query($sqlg24);
$numg24=mysql_num_rows($queryg24);

$sqlg34="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'A920%')";
//echo $sqlg34;
$queryg34=mysql_query($sqlg34);
$numg34=mysql_num_rows($queryg34);

$sqlg44="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'A920%')";
//echo $sqlg44;
$queryg44=mysql_query($sqlg44);
$numg44=mysql_num_rows($queryg44);

$sumg4=$numg14+$numg24+$numg34+$numg44;




$sqlg15="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'A925%') ";
//echo $sqlg15;
$queryg15=mysql_query($sqlg15);
$numg15=mysql_num_rows($queryg15);

//echo "--->".$numg11;

$sqlg25="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'A925%') ";
//echo $sqlg25;
$queryg25=mysql_query($sqlg25);
$numg25=mysql_num_rows($queryg25);

$sqlg35="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'A925%')";
//echo $sqlg35;
$queryg35=mysql_query($sqlg35);
$numg35=mysql_num_rows($queryg35);

$sqlg45="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'A925%')";
//echo $sqlg45;
$queryg45=mysql_query($sqlg45);
$numg45=mysql_num_rows($queryg45);

$sumg5=$numg15+$numg25+$numg35+$numg45;




$sqlg16="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'B01%' or icd10 LIKE 'B02%') ";
//echo $sqlg16;
$queryg16=mysql_query($sqlg16);
$numg16=mysql_num_rows($queryg16);

//echo "--->".$numg11;

$sqlg26="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'B01%' or icd10 LIKE 'B02%') ";
//echo $sqlg26;
$queryg26=mysql_query($sqlg26);
$numg26=mysql_num_rows($queryg26);

$sqlg36="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'B01%' or icd10 LIKE 'B02%')";
//echo $sqlg36;
$queryg36=mysql_query($sqlg36);
$numg36=mysql_num_rows($queryg36);

$sqlg46="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'B01%' or icd10 LIKE 'B02%')";
//echo $sqlg46;
$queryg46=mysql_query($sqlg46);
$numg46=mysql_num_rows($queryg46);

$sumg6=$numg16+$numg26+$numg36+$numg46;




$sqlg17="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'B05%') ";
//echo $sqlg17;
$queryg17=mysql_query($sqlg17);
$numg17=mysql_num_rows($queryg17);

//echo "--->".$numg11;

$sqlg27="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'B05%') ";
//echo $sqlg27;
$queryg27=mysql_query($sqlg27);
$numg27=mysql_num_rows($queryg27);

$sqlg37="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'B05%')";
//echo $sqlg37;
$queryg37=mysql_query($sqlg37);
$numg37=mysql_num_rows($queryg37);

$sqlg47="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'B05%')";
//echo $sqlg47;
$queryg47=mysql_query($sqlg47);
$numg47=mysql_num_rows($queryg47);

$sumg7=$numg17+$numg27+$numg37+$numg47;



$sqlg18="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'B06%') ";
//echo $sqlg18;
$queryg18=mysql_query($sqlg18);
$numg18=mysql_num_rows($queryg18);

//echo "--->".$numg11;

$sqlg28="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'B06%') ";
//echo $sqlg28;
$queryg28=mysql_query($sqlg28);
$numg28=mysql_num_rows($queryg28);

$sqlg38="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'B06%')";
//echo $sqlg38;
$queryg38=mysql_query($sqlg38);
$numg38=mysql_num_rows($queryg38);

$sqlg48="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'B06%')";
//echo $sqlg48;
$queryg48=mysql_query($sqlg48);
$numg48=mysql_num_rows($queryg48);

$sumg8=$numg18+$numg28+$numg38+$numg48;



$sqlg19="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'B084%' or icd10 LIKE 'B085%') ";
//echo $sqlg19;
$queryg19=mysql_query($sqlg19);
$numg19=mysql_num_rows($queryg19);

//echo "--->".$numg11;

$sqlg29="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'B084%' or icd10 LIKE 'B085%') ";
//echo $sqlg29;
$queryg29=mysql_query($sqlg29);
$numg29=mysql_num_rows($queryg29);

$sqlg39="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'B084%' or icd10 LIKE 'B085%')";
//echo $sqlg39;
$queryg39=mysql_query($sqlg39);
$numg39=mysql_num_rows($queryg39);

$sqlg49="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'B084%' or icd10 LIKE 'B085%')";
//echo $sqlg49;
$queryg49=mysql_query($sqlg49);
$numg49=mysql_num_rows($queryg49);

$sumg9=$numg19+$numg29+$numg39+$numg49;



$sqlg110="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'B26%') ";
//echo $sqlg110;
$queryg110=mysql_query($sqlg110);
$numg110=mysql_num_rows($queryg110);

//echo "--->".$numg11;

$sqlg210="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'B26%') ";
//echo $sqlg210;
$queryg210=mysql_query($sqlg210);
$numg210=mysql_num_rows($queryg210);

$sqlg310="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'B26%')";
//echo $sqlg310;
$queryg310=mysql_query($sqlg310);
$numg310=mysql_num_rows($queryg310);

$sqlg410="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'B26%')";
//echo $sqlg410;
$queryg410=mysql_query($sqlg410);
$numg410=mysql_num_rows($queryg410);

$sumg10=$numg110+$numg210+$numg310+$numg410;


$sqlg111="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'B30%') ";
//echo $sqlg111;
$queryg111=mysql_query($sqlg111);
$numg111=mysql_num_rows($queryg111);

//echo "--->".$numg11;

$sqlg211="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'B30%') ";
//echo $sqlg211;
$queryg211=mysql_query($sqlg211);
$numg211=mysql_num_rows($queryg211);

$sqlg311="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'B30%')";
//echo $sqlg311;
$queryg311=mysql_query($sqlg311);
$numg311=mysql_num_rows($queryg311);

$sqlg411="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'B30%')";
//echo $sqlg411;
$queryg411=mysql_query($sqlg411);
$numg411=mysql_num_rows($queryg411);

$sumg11=$numg111+$numg211+$numg311+$numg411;




$sqlg112="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'J10%' or icd10 LIKE 'J11%') ";
//echo $sqlg112;
$queryg112=mysql_query($sqlg112);
$numg112=mysql_num_rows($queryg112);

//echo "--->".$numg11;

$sqlg212="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'J10%' or icd10 LIKE 'J11%') ";
//echo $sqlg212;
$queryg212=mysql_query($sqlg212);
$numg212=mysql_num_rows($queryg212);

$sqlg312="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'J10%' or icd10 LIKE 'J11%')";
//echo $sqlg312;
$queryg312=mysql_query($sqlg312);
$numg312=mysql_num_rows($queryg312);

$sqlg412="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'J10%' or icd10 LIKE 'J11%')";
//echo $sqlg412;
$queryg412=mysql_query($sqlg412);
$numg412=mysql_num_rows($queryg412);

$sumg12=$numg112+$numg212+$numg312+$numg412;



$sqlg113="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G1%' and (icd10 LIKE 'J12%' or icd10 LIKE 'J13%' or icd10 LIKE 'J14%' or icd10 LIKE 'J15%' or icd10 LIKE 'J16%' or icd10 LIKE 'J18%') ";
//echo $sqlg113;
$queryg113=mysql_query($sqlg113);
$numg113=mysql_num_rows($queryg113);

//echo "--->".$numg11;

$sqlg213="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND goup like 'G2%' and (icd10 LIKE 'J12%' or icd10 LIKE 'J13%' or icd10 LIKE 'J14%' or icd10 LIKE 'J15%' or icd10 LIKE 'J16%' or icd10 LIKE 'J18%') ";
//echo $sqlg213;
$queryg213=mysql_query($sqlg213);
$numg213=mysql_num_rows($queryg213);

$sqlg313="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS01%') and (icd10 LIKE 'J12%' or icd10 LIKE 'J13%' or icd10 LIKE 'J14%' or icd10 LIKE 'J15%' or icd10 LIKE 'J16%' or icd10 LIKE 'J18%')";
//echo $sqlg313;
$queryg313=mysql_query($sqlg313);
$numg313=mysql_num_rows($queryg313);

$sqlg413="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND (goup like 'G3%' and typeservice like 'TS02%') and (icd10 LIKE 'J12%' or icd10 LIKE 'J13%' or icd10 LIKE 'J14%' or icd10 LIKE 'J15%' or icd10 LIKE 'J16%' or icd10 LIKE 'J18%')";
//echo $sqlg413;
$queryg413=mysql_query($sqlg413);
$numg413=mysql_num_rows($queryg413);

$sumg13=$numg113+$numg213+$numg313+$numg413;


//-------------- start โควิด -------------------------------------//

$sqlg114="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G1%' and (icd10 LIKE 'U071%' or icd10 LIKE 'U072%') ";
//echo $sqlg114;
$queryg114=mysql_query($sqlg114);
$numg114=mysql_num_rows($queryg114);

//echo "--->".$numg11;

$sqlg214="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G2%' and (icd10 LIKE 'U071%' or icd10 LIKE 'U072%') ";
//echo $sqlg214;
$queryg214=mysql_query($sqlg214);
$numg214=mysql_num_rows($queryg214);

$sqlg314="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G3%' and (icd10 LIKE 'U071%' or icd10 LIKE 'U072%') ";
//echo $sqlg314;
$queryg314=mysql_query($sqlg314);
$numg314=mysql_num_rows($queryg314);

$sqlg414="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G4%' and (icd10 LIKE 'U071%' or icd10 LIKE 'U072%') ";
//echo $sqlg414;
$queryg414=mysql_query($sqlg414);
$numg414=mysql_num_rows($queryg414);

$sumg14=$numg114+$numg214+$numg314+$numg414;
//-------------- end โควิด -------------------------------------//

//-------------- start มาลาเรีย -------------------------------------//

$sqlg115="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G1%' and (icd10 LIKE 'B50%' or icd10 LIKE 'B51%' or icd10 LIKE 'B53%' or icd10 LIKE 'B54%') ";
//echo $sqlg115;
$queryg115=mysql_query($sqlg115);
$numg115=mysql_num_rows($queryg115);

//echo "--->".$numg11;

$sqlg215="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G2%' and (icd10 LIKE 'B50%' or icd10 LIKE 'B51%' or icd10 LIKE 'B53%' or icd10 LIKE 'B54%') ";
//echo $sqlg215;
$queryg215=mysql_query($sqlg215);
$numg215=mysql_num_rows($queryg215);

$sqlg315="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G3%' and (icd10 LIKE 'B50%' or icd10 LIKE 'B51%' or icd10 LIKE 'B53%' or icd10 LIKE 'B54%') ";
//echo $sqlg315;
$queryg315=mysql_query($sqlg315);
$numg315=mysql_num_rows($queryg315);

$sqlg415="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G4%' and (icd10 LIKE 'B50%' or icd10 LIKE 'B51%' or icd10 LIKE 'B53%' or icd10 LIKE 'B54%') ";
//echo $sqlg415;
$queryg415=mysql_query($sqlg415);
$numg415=mysql_num_rows($queryg415);

$sumg15=$numg115+$numg215+$numg315+$numg415;
//-------------- end มาลาเรีย -------------------------------------//

//-------------- start ไข้กาฬหลังแอ่น -------------------------------------//

$sqlg116="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G1%' and (icd10 LIKE 'A39%' ) ";
//echo $sqlg116;
$queryg116=mysql_query($sqlg116);
$numg116=mysql_num_rows($queryg116);

//echo "--->".$numg11;

$sqlg216="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G2%' and (icd10 LIKE 'A39%' ) ";
//echo $sqlg216;
$queryg216=mysql_query($sqlg216);
$numg216=mysql_num_rows($queryg216);

$sqlg316="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G3%' and (icd10 LIKE 'A39%' ) ";
//echo $sqlg316;
$queryg316=mysql_query($sqlg316);
$numg316=mysql_num_rows($queryg316);

$sqlg416="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G4%' and (icd10 LIKE 'A39%' ) ";
//echo $sqlg416;
$queryg416=mysql_query($sqlg416);
$numg416=mysql_num_rows($queryg416);

$sumg16=$numg116+$numg216+$numg316+$numg416;
//-------------- end ไข้กาฬหลังแอ่น -------------------------------------//

//-------------- start เลปโตสไปโรซิส -------------------------------------//

$sqlg117="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G1%' and (icd10 LIKE 'A27%' ) ";
//echo $sqlg117;
$queryg117=mysql_query($sqlg117);
$numg117=mysql_num_rows($queryg117);

//echo "--->".$numg11;

$sqlg217="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G2%' and (icd10 LIKE 'A27%' ) ";
//echo $sqlg217;
$queryg217=mysql_query($sqlg217);
$numg217=mysql_num_rows($queryg217);

$sqlg317="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G3%' and (icd10 LIKE 'A27%' ) ";
//echo $sqlg317;
$queryg317=mysql_query($sqlg317);
$numg317=mysql_num_rows($queryg317);

$sqlg417="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G4%' and (icd10 LIKE 'A27%' ) ";
//echo $sqlg417;
$queryg417=mysql_query($sqlg417);
$numg417=mysql_num_rows($queryg417);

$sumg17=$numg117+$numg217+$numg317+$numg417;
//-------------- end เลปโตสไปโรซิส -------------------------------------//

//-------------- start สครับไทฟัส -------------------------------------//

$sqlg118="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G1%' and (icd10 LIKE 'A75%' ) ";
//echo $sqlg118;
$queryg118=mysql_query($sqlg118);
$numg118=mysql_num_rows($queryg118);

//echo "--->".$numg11;

$sqlg218="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G2%' and (icd10 LIKE 'A75%' ) ";
//echo $sqlg218;
$queryg218=mysql_query($sqlg218);
$numg218=mysql_num_rows($queryg218);

$sqlg318="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G3%' and (icd10 LIKE 'A75%' ) ";
//echo $sqlg318;
$queryg318=mysql_query($sqlg318);
$numg318=mysql_num_rows($queryg318);

$sqlg418="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G4%' and (icd10 LIKE 'A75%' ) ";
//echo $sqlg418;
$queryg418=mysql_query($sqlg418);
$numg418=mysql_num_rows($queryg418);

$sumg18=$numg118+$numg218+$numg318+$numg418;
//-------------- end สครับไทฟัส -------------------------------------//

//-------------- start โรคไข้ฝีดาษวานร -------------------------------------//

$sqlg119="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G1%' and (icd10 = 'B04' ) ";
//echo $sqlg119;
$queryg119=mysql_query($sqlg119);
$numg119=mysql_num_rows($queryg119);

//echo "--->".$numg11;

$sqlg219="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G2%' and (icd10 = 'B04' ) ";
//echo $sqlg219;
$queryg219=mysql_query($sqlg219);
$numg219=mysql_num_rows($queryg219);

$sqlg319="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G3%' and (icd10 = 'B04' ) ";
//echo $sqlg319;
$queryg319=mysql_query($sqlg319);
$numg319=mysql_num_rows($queryg319);

$sqlg419="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G4%' and (icd10 = 'B04' ) ";
//echo $sqlg419;
$queryg419=mysql_query($sqlg419);
$numg419=mysql_num_rows($queryg419);

$sumg19=$numg119+$numg219+$numg319+$numg419;
//-------------- end โรคไข้ฝีดาษวานร -------------------------------------//

//-------------- start สครับไทฟัส -------------------------------------//

$sqlg120="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G1%' and (icd10 LIKE 'R50.8%' OR icd10 LIKE 'R50.9%') ";
//echo $sqlg120;
$queryg120=mysql_query($sqlg120);
$numg120=mysql_num_rows($queryg120);

//echo "--->".$numg11;

$sqlg220="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G2%' and (icd10 LIKE 'R50.8%' OR icd10 LIKE 'R50.9%')";
//echo $sqlg220;
$queryg220=mysql_query($sqlg220);
$numg220=mysql_num_rows($queryg220);

$sqlg320="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G3%' and (icd10 LIKE 'R50.8%' OR icd10 LIKE 'R50.9%')";
//echo $sqlg320;
$queryg320=mysql_query($sqlg320);
$numg320=mysql_num_rows($queryg320);

$sqlg420="SELECT * FROM reportopday WHERE thidate like '$chkdate%' AND  goup like 'G4%' and (icd10 LIKE 'R50.8%' OR icd10 LIKE 'R50.9%')";
//echo $sqlg420;
$queryg420=mysql_query($sqlg420);
$numg420=mysql_num_rows($queryg420);

$sumg20=$numg120+$numg220+$numg320+$numg420;
//-------------- end สครับไทฟัส -------------------------------------//

$total=$sumg1+$sumg2+$sumg3+$sumg4+$sumg5+$sumg6+$sumg7+$sumg8+$sumg9+$sumg10+$sumg11+$sumg12+$sumg13+$sumg14+$sumg15+$sumg16+$sumg17+$sumg18+$sumg19+$sumg20;
?>
<hr />
<div align="center" style="margin-top: 20px;"><strong>รายงานการเฝ้าระวังโรคติดต่อสำคัญในกำลังพลและครอบครัว ทบ.</strong></div>
<div align="center">ประจำเดือน : <?=$showdate1;?></div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" rowspan="3" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="11%" rowspan="3" align="center" bgcolor="#66CC99"><strong>โรคติดต่อสำคัญ</strong></td>
    <td width="11%" rowspan="3" align="center" bgcolor="#66CC99"><strong>ICD-10</strong></td>
    <td colspan="7" align="center" bgcolor="#66CC99"><strong>ประจำเดือน <?=$showdate1;?></strong></td>
  </tr>
  <tr>
    <td width="8%" colspan="4" align="center" bgcolor="#FFCC66"><strong>จำนวนผู้ป่วยจำแนกตามประเภท</strong></td>
    <td width="8%" rowspan="2" align="center" bgcolor="#FFCC66"><p><strong>จำนวนผู้ป่วยรวม</strong></p>    </td>
    <td width="8%" rowspan="2" align="center" bgcolor="#FFCC66"><p><strong>จำนวนผู้เสียชีวิต</strong></p></td>
    <td width="8%" rowspan="2" align="center" bgcolor="#FFCC66"><strong>รวม</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFCC66">ก</td>
    <td align="center" bgcolor="#FFCC66">ข</td>
    <td align="center" bgcolor="#FFCC66">ค</td>
    <td align="center" bgcolor="#FFCC66">ง</td>
  </tr>

  <tr>
    <td align="center">1</td>
    <td align="left" >อาหารเป็นพิษ/โรคอุจจาระร่วง</td>
    <td align="left" >A01, A02, A03, A04, A05 (A05.1-B05.5, B05.8-B05.9), A08, A09</td>
    <td align="center" ><?=$numg11;?></td>
    <td align="center" ><?=$numg21;?></td>
    <td align="center" ><?=$numg31;?></td>
    <td align="center" ><?=$numg41;?></td>
    <td align="center" ><?=$sumg1;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg1;?></td>
  </tr>
  <tr>
    <td align="center">2</td>
    <td align="left" >วัณโรค</td>
    <td align="left" >A15 (A15.0, A15.4-A15.9)</td>
    <td align="center" ><?=$numg12;?></td>
    <td align="center" ><?=$numg22;?></td>
    <td align="center" ><?=$numg32;?></td>
    <td align="center" ><?=$numg42;?></td>
    <td align="center" ><?=$sumg2;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg2;?></td>
  </tr>
  <tr>
    <td align="center">3</td>
    <td align="left" >โรคไข้เลือดออกเดงกี (DF, DHF, DSS)</td>
    <td align="left" >A90, A91</td>
    <td align="center" ><?=$numg13;?></td>
    <td align="center" ><?=$numg23;?></td>
    <td align="center" ><?=$numg33;?></td>
    <td align="center" ><?=$numg43;?></td>
    <td align="center" ><?=$sumg3;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg3;?></td>
  </tr>
  <tr>
    <td align="center">4</td>
    <td align="left" >โรคไข้ปวดข้อยุงลาย</td>
    <td align="left" >A92.0</td>
    <td align="center" ><?=$numg14;?></td>
    <td align="center" ><?=$numg24;?></td>
    <td align="center" ><?=$numg34;?></td>
    <td align="center" ><?=$numg44;?></td>
    <td align="center" ><?=$sumg4;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg4;?></td>
  </tr>
  <tr>
    <td align="center">5</td>
    <td align="left" >โรคไข้ซิก้าไวรัส</td>
    <td align="left" >A92.5</td>
    <td align="center" ><?=$numg15;?></td>
    <td align="center" ><?=$numg25;?></td>
    <td align="center" ><?=$numg35;?></td>
    <td align="center" ><?=$numg45;?></td>
    <td align="center" ><?=$sumg5;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg5;?></td>
  </tr>
  <tr>
    <td align="center">6</td>
    <td align="left" >โรคอีสุกอีใส</td>
    <td align="left" >B01, B02</td>
    <td align="center" ><?=$numg16;?></td>
    <td align="center" ><?=$numg26;?></td>
    <td align="center" ><?=$numg36;?></td>
    <td align="center" ><?=$numg46;?></td>
    <td align="center" ><?=$sumg6;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg6;?></td>
  </tr>
  <tr>
    <td align="center">7</td>
    <td align="left" >โรคหัด</td>
    <td align="left" >B05 (B05.0-B05.4, B05.8, B05.81, B05.89)</td>
    <td align="center" ><?=$numg17;?></td>
    <td align="center" ><?=$numg27;?></td>
    <td align="center" ><?=$numg37;?></td>
    <td align="center" ><?=$numg47;?></td>
    <td align="center" ><?=$sumg7;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg7;?></td>
  </tr>
  <tr>
    <td align="center">8</td>
    <td align="left" >โรคหัดเยอรมัน</td>
    <td align="left" >B06</td>
    <td align="center" ><?=$numg18;?></td>
    <td align="center" ><?=$numg28;?></td>
    <td align="center" ><?=$numg38;?></td>
    <td align="center" ><?=$numg48;?></td>
    <td align="center" ><?=$sumg8;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg8;?></td>
  </tr>
  <tr>
    <td align="center">9</td>
    <td align="left" >โรคติดเชื้อเอนเทอโรไวรัส (HFMD)</td>
    <td align="left" >B08.4, B08.5</td>
    <td align="center" ><?=$numg19;?></td>
    <td align="center" ><?=$numg29;?></td>
    <td align="center" ><?=$numg39;?></td>
    <td align="center" ><?=$numg49;?></td>
    <td align="center" ><?=$sumg9;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg9;?></td>
  </tr>
  <tr>
    <td align="center">10</td>
    <td align="left" >โรคคางทูม</td>
    <td align="left" >B26</td>
    <td align="center" ><?=$numg110;?></td>
    <td align="center" ><?=$numg210;?></td>
    <td align="center" ><?=$numg310;?></td>
    <td align="center" ><?=$numg410;?></td>
    <td align="center" ><?=$sumg10;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg10;?></td>
  </tr>
  <tr>
    <td align="center">11</td>
    <td align="left" >โรคตาแดงจากเชื้อไวรัส</td>
    <td align="left" >B30 (B30.0-B30.3, B30.8-B30.9)</td>
    <td align="center" ><?=$numg111;?></td>
    <td align="center" ><?=$numg211;?></td>
    <td align="center" ><?=$numg311;?></td>
    <td align="center" ><?=$numg411;?></td>
    <td align="center" ><?=$sumg11;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg11;?></td>
  </tr>
  <tr>
    <td align="center">12</td>
    <td align="left" >โรคไข้หวัดใหญ่</td>
    <td align="left" >J10, J11</td>
    <td align="center" ><?=$numg112;?></td>
    <td align="center" ><?=$numg212;?></td>
    <td align="center" ><?=$numg312;?></td>
    <td align="center" ><?=$numg412;?></td>
    <td align="center" ><?=$sumg12;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg12;?></td>
  </tr>
  <tr>
    <td align="center">13</td>
    <td align="left" >โรคปอดบวม</td>
    <td align="left" >J12, J13, J14, J15, J16, J18</td>
    <td align="center" ><?=$numg113;?></td>
    <td align="center" ><?=$numg213;?></td>
    <td align="center" ><?=$numg313;?></td>
    <td align="center" ><?=$numg413;?></td>
    <td align="center" ><?=$sumg13;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg13;?></td>
  </tr>
  <tr>
    <td align="center">14</td>
    <td align="left" >โรคโควิด-19</td>
    <td align="left" >U071 , U072</td>
    <td align="center" ><?=$numg114;?></td>
    <td align="center" ><?=$numg214;?></td>
    <td align="center" ><?=$numg314;?></td>
    <td align="center" ><?=$numg414;?></td>
    <td align="center" ><?=$sumg14;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg14;?></td>
  </tr>
  <tr>
    <td align="center">15</td>
    <td align="left" >โรคมาลาเรีย</td>
    <td align="left" >B50,B51,B52,B53,B54</td>
    <td align="center" ><?=$numg115;?></td>
    <td align="center" ><?=$numg215;?></td>
    <td align="center" ><?=$numg315;?></td>
    <td align="center" ><?=$numg415;?></td>
    <td align="center" ><?=$sumg15;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg15;?></td>
  </tr>
  <tr>
    <td align="center">16</td>
    <td align="left" >โรคไข้กาฬหลังแอ่น</td>
    <td align="left" >A39 (A39.0,A39.2-A39.5,A39.8-A39.9)</td>
    <td align="center" ><?=$numg116;?></td>
    <td align="center" ><?=$numg216;?></td>
    <td align="center" ><?=$numg316;?></td>
    <td align="center" ><?=$numg416;?></td>
    <td align="center" ><?=$sumg16;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg16;?></td>
  </tr>
  <tr>
    <td align="center">17</td>
    <td align="left" >โรคเลปโตสไปโรซิส</td>
    <td align="left" >A27 (A27.0,A27.8,A27.9)</td>
    <td align="center" ><?=$numg117;?></td>
    <td align="center" ><?=$numg217;?></td>
    <td align="center" ><?=$numg317;?></td>
    <td align="center" ><?=$numg417;?></td>
    <td align="center" ><?=$sumg17;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg17;?></td>
  </tr>
  <tr>
    <td align="center">18</td>
    <td align="left" >โรคสครับไทฟัส</td>
    <td align="left" >A75 (A75.0-A75.3,A75.9)</td>
    <td align="center" ><?=$numg118;?></td>
    <td align="center" ><?=$numg218;?></td>
    <td align="center" ><?=$numg318;?></td>
    <td align="center" ><?=$numg418;?></td>
    <td align="center" ><?=$sumg18;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg18;?></td>
  </tr>
  <tr>
    <td align="center">19</td>
    <td align="left" >โรคไข้ฝีดาษวานร</td>
    <td align="left" >B04</td>
    <td align="center" ><?=$numg119;?></td>
    <td align="center" ><?=$numg219;?></td>
    <td align="center" ><?=$numg319;?></td>
    <td align="center" ><?=$numg419;?></td>
    <td align="center" ><?=$sumg19;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg19;?></td>
  </tr>
  <tr>
    <td align="center">20</td>
    <td align="left" >โรคไข้ไม่ทราบสาเหตุ</td>
    <td align="left" >(R50.8, R50.9)</td>
    <td align="center" ><?=$numg120;?></td>
    <td align="center" ><?=$numg220;?></td>
    <td align="center" ><?=$numg320;?></td>
    <td align="center" ><?=$numg420;?></td>
    <td align="center" ><?=$sumg20;?></td>
    <td align="center">0</td>
    <td align="center" ><?=$sumg20;?></td>
  </tr>  
  <tr>
    <td colspan="3" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td colspan="4" align="center" bgcolor="#999999">&nbsp;</td>
    <td align="center" bgcolor="#FFCC66"><?=$total;?></td>
    <td align="center" bgcolor="#FFCC66">0</td>
    <td align="center" bgcolor="#999999">&nbsp;</td>
  </tr>  
</table>
<?
}
?>
</body>
</html>
