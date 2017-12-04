<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
.text {	font-family: "TH SarabunPSK";
	font-size: 14px;
}
.text1 {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.text2 {	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.text3 {	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.text16 {	font-family: "TH SarabunPSK";
	font-size: 12px;
}
.texthead {	font-family: "TH SarabunPSK";
	font-size: 25px;
}
</style>
</head>

<body>

<?
function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

include("connect.inc");
$todate=$_GET['today'];
$vn=$_GET['vn'];
$hn=$_GET['hn'];
$sql="SELECT * FROM `opday` WHERE  `thidate` LIKE '$todate%' AND `vn` = '$vn' and hn='$hn' ";
$query = mysql_query($sql)or die (mysql_error());
$arropday = mysql_fetch_array($query);

	$sql2 = "select concat(yot,name,' ',surname)as ptname ,dbirth,hn ,ptright from opcard  where hn='".$arropday['hn']."' ";
	$query2 = mysql_query($sql2)or die (mysql_error());
	$arr2 = mysql_fetch_array($query2);
	
	$sql3 = "select * from opd  where  thidate like '".substr($arropday['thidate'],0,10)."%'  and hn='".$arr2['hn']."' ";
	$query3 = mysql_query($sql3)or die (mysql_error());
	$arr3 = mysql_fetch_array($query3);

//echo $sql3;

	$sql = "Select drugcode, tradname From drugreact where hn = '".$arropday["hn"]."' ";
	$result = mysql_query($sql) or die(mysql_error());
	$i=0;
	while(list($drugcode, $tradname) = mysql_fetch_row($result)){ $txt_react[$i] = "&nbsp;&nbsp;&nbsp;<b>[".$drugcode."]</b> ".$tradname.", "; $i++; }
	
	$txt_react2 = implode("",$txt_react);
	
	$txt_react2 = "ยาที่แพ้&nbsp;:&nbsp;".$txt_react2;
	
	////////////////////////
	
	
	if($arr3['cigarette']==1) {
	$cigarette="สูบ";
	}elseif($arr3['cigarette']==0) {
	$cigarette="ไม่สูบ";	
	}elseif($arr3['cigarette']==2) {
	$cigarette="เคยสูบ";	
	}
	
	if($arr3['alcohol']==1) {
	$cigarette="ดื่ม";
	}elseif($arr3['alcohol']==0) {
	$cigarette="ไม่ดื่ม";	
	}elseif($arr3['alcohol']==2) {
	$cigarette="เคยดื่ม";	
	}

?>
<table width="100%" border="0">
  <tr>
    <td ><table width="100%">
      <tr>
        <td align="center" valign="top" class="texthead"><strong>ใบสรุปผลการตรวจ </strong></td>
        </tr>
      <tr>
        <td  valign="top" class="texthead"><table width="100%"   border="1" class="text1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000">
          <tr class="text3">
            <td colspan="2"  valign="top" class="text3"><strong class="text2"><u>ข้อมูล </u> </strong>&nbsp;&nbsp;<strong>วันที่</strong>
<?=$arropday['thidate']?> &nbsp;&nbsp;<strong>VN</strong> :
<?=$arropday['vn'];?>
&nbsp;&nbsp;<strong>สิทธิการรักษา</strong> :
<?=$arropday['ptright'];?> &nbsp; <strong>ออก VN โดย </strong>
<?=$arropday['toborow'];?>
</td>
          </tr>
          <tr>
            <td colspan="2"   valign="top" class="text2"><strong>HN :</strong> <strong>
              <?=$arr2['hn']?>
              </strong><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อ :</strong> <span style="font-size:24px"><strong>
                <?=$arr2['ptname']?>
                </strong></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วัน/เดือน/ปี เกิด</strong>
              <?=$arr2['dbirth'];?>
              <strong> อายุ :</strong>
            <?=calcage($arr2['dbirth']);?></td>
            </tr>
          <tr>
            <td width="50%" align="center"   valign="top" bgcolor="#CCCCCC" class="text">ข้อมูลซักประวัติ</td>
            <td width="50%" align="center"  valign="top" bgcolor="#CCCCCC" class="text">DIAG</td>
          </tr>
          <tr>
            <td   valign="top" class="text16">
              <table width="100%" border="0">
  <tr>
    <td>T
      <?=$arr3['temperature'];?>
      c, P
      <?=$arr3['pause'];?>
      ครั้ง/นาที , R
      <?=$arr3['rate'];?>
ครั้ง/นาที , BP
<?=$arr3['bp1'];?>
/
<?=$arr3['bp2'];?>
mmHg </td>
  </tr>
  <tr>
    <td>น้ำหนัก.
      <?=$arr3['weight'];?>
&nbsp;&nbsp;กก - สูง .
<?=$arr3['height'];?>
ซม.  &nbsp; ,แพ้ยา : 
<? if($arr3['drugreact']==0){ echo "ไม่แพ้ยา"; }else{ echo "แพ้ยา  ".$txt_react2; }?> &nbsp;&nbsp;, โรคประจำตัว : 
<?=$arr3['congenital_disease'];?></td>
  </tr>
  <tr>
    <td>บุหรี่ :
      <?=$cigarette;?>
,  สุรา :
<?=$cigarette;?>
&nbsp;&nbsp;&nbsp;ลักษณะผู้ป่วย :
<?=$arr3['type'];?>
&nbsp;คลินิก :
<?=$arr3['clinic'];?></td>
  </tr>
  <tr>
    <td>&nbsp;อาการ :
      <?=$arr3['organ'];?></td>
  </tr>
              </table></td>
            <td align="center"  valign="top" class="text2">
            <?  
			$svdate=substr($arropday[thidate],0,10);
			
			$sqldiag="SELECT * FROM `diag` WHERE 1 AND `hn` = '$arropday[hn]' and an ='$arropday[vn]' and svdate like '$svdate%' "; 
			$querydiag=mysql_query($sqldiag)or die (mysql_error());
			//echo $sqldiag;
			?>
            <table border="0" align="left" class="text16">
            <?
			while($arrdiag=mysql_fetch_array($querydiag)){
			?>
              <tr>
                <td align="left"><strong>ICD10 :</strong> <?=$arrdiag['icd10']?></td>
                <td align="left"><strong>DIAG :</strong>
                  <?=$arrdiag['diag']?></td>
                <td align="left"><strong>TYPE :</strong>
                  <?=$arrdiag['type'];?></td>
                </tr>
              <? } ?>
            </table>
            
            </td>
          </tr>
          <tr>
            <td align="center"   valign="top" bgcolor="#CCCCCC" class="text">หัตถการ</td>
            <td align="center"  valign="top" bgcolor="#CCCCCC" class="text">ยา</td>
          </tr>
          <?  $sqldepat="SELECT b.hn , b.date , b.code ,b.detail FROM `depart` as a ,patdata as b  WHERE  a.row_id=b.idno and a.hn = '$arropday[hn]' and a.tvn ='$arropday[vn]' and a.date like '$svdate%'  "; 
		  		$querydepat=mysql_query($sqldepat)or die (mysql_error());
				
	//	echo $sqldepat;
		  ?>
          <tr>
            <td   valign="top" class="text2"><table width="100%" border="0" class="text16">
               <tr >
                <td bgcolor="#CCCCCC">CODE</td>
                <td bgcolor="#CCCCCC">DETAIL</td>
                <td bgcolor="#CCCCCC">RESULT</td>
               </tr>
            <? while($arrdepart=mysql_fetch_array($querydepat)){
				
				$orderdate=substr($arrdepart['date'],0,10);
				
				$orderdate2=explode('-',$orderdate);
				
				$orderdate3=(($orderdate2[0])-543).'-'.$orderdate2[1].'-'.$orderdate2[2];
				//echo $orderdate3;
				
				if($arrdepart['code']=='BS'){
					$arrdepart['code']='GLU';
				}
				if($arrdepart['code']=='TRI'){
					$arrdepart['code']='TRIG';
				}
				if($arrdepart['code']=='HBA1C'){
					$arrdepart['code']='HBA1CC';
				}
				if($arrdepart['code']=='SGOT'){
					$arrdepart['code']='AST';
				}
				if($arrdepart['code']=='SGPT'){
					$arrdepart['code']='ALT';
				}
				if($arrdepart['code']=='ALK'){
					$arrdepart['code']='ALP';
				}
				if($arrdepart['code']=='CR'){
					$arrdepart['code']='CREA';
				}
				if($arrdepart['code']=='HVC'){
					$arrdepart['code']='HCVAB';
				}
				
$sqlre="SELECT * FROM resulthead as a , `resultdetail` as b  WHERE a.autonumber=b.autonumber and a.hn='".$arrdepart['hn']."'  and  a.orderdate  like '".$orderdate3."%' and b.labcode  ='".$arrdepart['code']."' ";
$queryre=mysql_query($sqlre)or die (mysql_error());
$arrre=mysql_fetch_array($queryre);

//echo $sqlre;

				 ?>
              <tr>
                <td><?=$arrdepart['code']?></td>
                <td><?=$arrdepart['detail']?></td>
                <td><?=$arrre['result']?>&nbsp;&nbsp;<?=$arrre['unit']?></td>
              </tr>
              <? } ?>
            </table>
            
            </td>
            <td  valign="top" class="text2">
            
           <?  $sqldrug="SELECT b.drugcode ,b.tradname ,b.amount ,b.slcode ,b.reason ,b.part FROM `phardep` as a ,drugrx as b  WHERE  a.row_id=b.idno and a.hn = '$arropday[hn]' and a.tvn ='$arropday[vn]' and a.date like '$svdate%'  "; 
		  		$querydrug=mysql_query($sqldrug)or die (mysql_error());
				
		//echo $sqldepat;
		  ?> 
            <table width="100%" border="0" class="text16">
              <tr >
                <td bgcolor="#CCCCCC">รหัสยา</td>
                <td bgcolor="#CCCCCC">ชื่อยา (การค้า)</td>
                <td bgcolor="#CCCCCC">จำนวน</td>
                <td bgcolor="#CCCCCC">วิธีใช้ </td>
                <td align="center" bgcolor="#CCCCCC">part</td>
                 <td bgcolor="#CCCCCC">เหตุผลการใช้ยา </td>
              </tr>
              <? while($arrdrug=mysql_fetch_array($querydrug)){ ?>
              <tr>
                <td><?=$arrdrug['drugcode']?></td>
                <td><?=$arrdrug['tradname']?></td>
                <td><?=$arrdrug['amount']?></td>
                <td><?=$arrdrug['slcode']?></td>
                <td><?=$arrdrug['part']?></td>
                <td><?=substr($arrdrug['reason'],0,1);?></td>
              </tr>
              <? } ?>
            </table>
            
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center"  valign="top" class="texthead"><strong>แพทย์ :</strong> <?=$arropday['doctor'];?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>