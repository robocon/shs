<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<style>
body{
	font-family:"TH SarabunPSK";
}
.font1{ 
/*font-family:"Angsana New";*/
font-size:18pt;
font-weight:bold;
}
.font2 { /*font-family:"Angsana New";*/
font-size:16pt;
}
.font3 { /*font-family:"Angsana New";*/
font-size:16pt;
font-weight:bold;
}
</style>
<? include("connect.inc"); ?>
<body>

<? 
$sql="SELECT * FROM `refer` WHERE refer_runno='".$_GET['runno']."'  ";
$query=mysql_query($sql);
$arr=mysql_fetch_array($query);
$cHn=$arr['hn'];
$cAn=$arr['an'];
$cPtname=$arr['name'].' '.$arr['sname'];


switch ($arr['type_wound']) {
	case "P02":
	$type_wound="ทหาร (น)";
	 break;
	case "P03":
	$type_wound="ทหาร (นส)";
	 break;
 	case "P04":
	$type_wound="ทหาร (พลฯ)";
	 break;
	case "P05":
	$type_wound="ครอบครัว";
	 break;
	case "P06":
	$type_wound= "พ.ต้น";
	 break;
	case "P07":
	$type_wound= "พ.";
	 break;
	case "P08":
	$type_wound= "ประกันสังคม";
	 break;
	case "P09":
	$type_wound="30บาท";
	 break;
	 case "P10":
	$type_wound= "30บาทฉุกเฉิน";
	 break;
	 case "P11":
	$type_wound= "พรบ.";
	 break;
	 case "P12":
	$type_wound= "กท.44";
	 break;
	

}

?>
<table width="100%" border="0" >
  <tr>
    <td colspan="2" align="center" class="font1">ใบส่งต่อผู้ป่วย</td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="font1">โรงพยาบาลค่ายสุรศักดิ์มนตรี  จ.ลำปาง <hr width="50%"/></td>
  </tr>
  <tr>
    <td width="1%"  class="font3">&nbsp;</td>
    <td width="99%"  class="font3">เลขที่ Refer : <?=$arr['refer_runno'];?> &nbsp;&nbsp;&nbsp;  วันที่ส่งต่อ : <?=$arr['dateopd'];?></td>
  </tr>
  <tr>
    <td class="font3">&nbsp;</td>
    <td class="font3">HN : <?=$cHn;?>&nbsp;&nbsp;&nbsp; <? if($cAn!=''){ ?>AN : <?=$cAn;  }?> ชื่อ-สกุล :<?=$cPtname;?> &nbsp;&nbsp;&nbsp; อายุ : <?=$arr['age'];?> </td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">ID : <?=$arr['idcard'];?> &nbsp;&nbsp;&nbsp; สิทธิ : <?=$type_wound;?>&nbsp;&nbsp;&nbsp; แพทย์ผู้รักษา :  <?=$arr['doctor'];?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">Referที่ : <?=$arr['ward'];?> 
    <? /*if($arr['ward']=="opd"){ echo "ห้องตรวจโรค"; }else if($arr['ward']=="opd_obg"){ echo "หอผู้ป่วยสูติ"; }else if($arr['ward']=="opd_eye"){ echo "จักษุ"; }else if($arr['ward']=="ER"){ echo "ห้องฉุกเฉิน"; }*/?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">วัตุประสงค์/เพื่อ : <? if($arr['target_refer']==1){ echo "ปรึกษา/วินิจฉัย"; }else if($arr['target_refer']==2){ echo "รักษาแล้วให้ส่งกลับ"; }else if($arr['target_refer']==3){ echo "โอนย้าย"; }?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">การวินิจฉัยโรค : <span class="font21">
      <?=$arr['diag'];?>
    </span></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">อาการ : <span class="font21">
      <?=$arr['organ'];?>
    </span></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">การรักษา : <span class="font21">
      <?=$arr['maintenance'];?>
    </span></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">สาเหตุการ Refer&nbsp;: <?=$arr['exrefer'];?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">Refer ไปที่ :  <? $sub=explode(" ",$arr['referh']); echo "โรงพยาบาล".$sub[1]?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">ปัญหาการ Refer&nbsp;:<?=$arr['problem_refer'];?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">ประเภทการ Refer&nbsp;:
<? if($arr['pttype']==1){ echo "Emergency "; }else if($arr['pttype']==2){ echo "Urgent "; }else if($arr['pttype']==3){ echo "Non-Urgent  "; }?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">ประเภทคนไข้&nbsp;:&nbsp;
    <?=$arr['list_type_patient'];?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">ไปโดย&nbsp;:  <?=$arr['refercar'];?>
</td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">ผลการติดตามผู้ป่วย  : <?=$arr['follow_refer'];?></td>
  </tr>
  <tr>
    <td class="font2">&nbsp;</td>
    <td class="font2">&nbsp;</td>
  </tr>
</table>
</body>
</html>