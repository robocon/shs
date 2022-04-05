<?php
    session_start();
    if (isset($sIdname)){
		} else {die;}
		
	//header("content-type: application/x-javascript; charset=TIS-620");
?>
<link href="css/style_table.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
  
<a name="top" id="top"></a>
<br />
<?php
	
    include("connect.inc");
	
	
	
	$lbedcode=substr($_GET['code'],0,2);
	if($lbedcode=='42'){
$wardname="หอผู้ป่วยรวม";	
$sortname="รวม";
	}elseif($lbedcode=='43'){
$wardname="หอผู้ป่วยสูติ";	
$sortname="สูติ";
	}elseif($lbedcode=='44'){
$wardname="หอผู้ป่วยICU";	
$sortname="ICU";
	}elseif($lbedcode=='45'){
$wardname="หอผู้ป่วยพิเศษ";	
$sortname="พิเศษ";
	}elseif($lbedcode=='46'){
$wardname="หอผู้ป่วย Cohort Ward";	
$sortname="cohortward";
	}elseif($lbedcode=='47'){
$wardname="ผู้ป่วย Home Isolation";	
$sortname="Home Isolation";
	}elseif($lbedcode=='48'){
$wardname="ผู้ป่วย รพ.สนาม";	
$sortname="รพ.สนาม";
	}
	
	//echo "==>$lbedcode";
	$bbbbcode=$lbedcode;
include("calroom.php");
	include("alert_booking.php");
	?>
<strong style="font-size:24px"><?=$wardname;?></strong> &nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='ipdcost.php'>รวมเงินทุกเตียง</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href='ipstikerdrug.php'>STICKER</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href='booking_system/booking_confirm.php?code=<?=$lbedcode?>'>ระบบจองเตียง</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank"  href="med_record.php?code=<?=$lbedcode;?>">Med Record</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank"  href="ipptchk.php">รายชื่อผู้ป่วยใน</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank"  href="report_opsihitoday.php">รายงานข้อมูลสถิติผู้ป่วยโควิด (เริ่ม 1 เม.ย. 65)</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_self"  href="../nindex.htm">ไปเมนู</a>
<br />


    
    <?
	/*$sql="SELECT * FROM bed WHERE bedcode LIKE '$lbedcode%'";
	$resultsql = mysql_query($sql)or die(mysql_error());*/
	//$n=mysql_num_rows($resultsql);
	
	
/*echo"<br><table border=\"0\"  cellspacing=\"1\" cellpadding=\"1\"><tr>";
		$intRows = 0;
		while($arr=mysql_fetch_array($resultsql)){
			
			$status2 = substr($arr['status'],0,3);
			
			if($arr['an']=='' and $status2=="B01"){
			$ff="<font class='tablefont3'>ว่าง</font>";
			}else{
			$ff="<font color='#990000' style='font-size:12PX;'>ไม่ว่าง</font>";
			}
			
			echo "<td>"; 
			$intRows++;*/
	?>
			<!--<center>-->
				<? //echo "<a href='#$arr[bed]'>".$arr['bed'].'('.$ff.')'."$i</a>&nbsp;&nbsp;";?>
		<!--		<br>-->
			<!--</center>-->
	<?
	/*		echo"</td>";
			if(($intRows)%9==0)
			{
				echo"</tr>";
			}
		}
		echo"</tr></table>";*/
	
	if($lbedcode=='47'){
    $query = "SELECT idcard,bed,date,date_format(date,'%d- %m- %Y'),ptname,an,hn,diagnos,food,doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,chgdate,status,age,diag1,days FROM bed WHERE bedcode LIKE '$lbedcode%' ORDER BY row_id ASC ";
	}else{
    $query = "SELECT idcard,bed,date,date_format(date,'%d- %m- %Y'),ptname,an,hn,diagnos,food,doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,chgdate,status,age,diag1,days FROM bed WHERE bedcode LIKE '$lbedcode%' ORDER BY bedcode ASC ";
	}
  //echo "==>".$query;
    $result = mysql_query($query)or die("Query failed");

$i=1;

    while (list ($idcard,$bed,$date1,$date,$ptname,$an,$hn,$diagnos,$food,$doctor,$ptright,$price,$paid,$debt,$caldate,$bedname,$bedcode,$hn,$chgdate,$status,$age,$diag1,$daysall) = mysql_fetch_row ($result)) {

if($diag1=='' and $an!=''){ $diag1='ไม่มี'; }			
$status2 = substr($status,0,3);

$time=explode(" ",$date1);

		switch($status2){
			case "B01" : $color="#66FFCC"; break;
			case "B02" : $color="#FF9999"; break;
			case "B03" : $color="#FFFF99"; break;

		}
		
		if($an=='' and $status2=="B01"){
			
			$color="#FFFFFF";
			//$ff="ว่าง";
		}else{
			//$ff="ไม่ว่าง";
		}
		
		$idcard=$idcard.'.jpg';
		
		if(file_exists("../image_patient/$idcard")){
			$img=$idcard;
		}else{
			$img='../image_patient/NoPicture.jpg';
		}



$sql = "SELECT hi_type FROM ipcard  WHERE `an` = '".$an."' limit 1 ";

$rows = mysql_query($sql);

list($hi_type) = Mysql_fetch_row($rows);

	if($hi_type=="in"){
		$location="ผู้ป่วย HI รักษาเรือนรับรอง";
	}else 	if($hi_type=="out"){
		$location="ผู้ป่วย HI รักษาที่บ้าน";
	}else{
		$location="";
	}

?>
<script type="text/javascript">
$(document).ready(function(){

<? if($color=="#FFFFFF" || $color=="#FF9999" || $color=="#FFFF99"){?>
	$("#div<?=$i;?>").hide();
<? } ?>
	$("#btn2<?=$i;?>").click(function(){
		$("#div<?=$i;?>").hide(1000);
	});

	$("#btn1<?=$i;?>").click(function(){
		$("#div<?=$i;?>").show(1000);
	});

});
</script>
 
<br />เตียง : <?=$bed;?>&nbsp;&nbsp; <?=$status;?>&nbsp;&nbsp; 
<input type="button" id="btn1<?=$i;?>" value="แสดงเตียง">
<input type="button" id="btn2<?=$i;?>" value="ซ่อนเตียง">
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#000000" bgcolor="<?=$color;?>" >
  <tr>
    <td>
    <div id="div<?=$i;?>">
    <table width="100%" border="0">
      <tr>
        <td width="25%">
				<a name="<?=$bed;?>" id="<?=$bed;?>"></a>
				<font class="bed">
					<?php
					$food = htmlspecialchars($food, ENT_QUOTES);
					$href = "ipbed.php?cBed=$bed&cDate=$date&cPtname=$ptname&cAn=$an&cDiagnos=$diagnos&cFood=$food&cDoctor=$doctor&cPtright=$ptright&cBedcode=$bedcode&cHn=$hn&cChgdate=$chgdate&cbedname=$wardname";
					echo"<a href=\"$href\" class=\"bed\">$bed</a>";
					?>
				</font>&nbsp;&nbsp;&nbsp;
		<? echo "<a target=_blank  href=\"bedstatus.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cstatus=$status\" class='tablefont'>$status</a>"; ?></td>
        <td > <font class="tablefontt1">AN : </font><font class="tablefont"><a href="show_wardlog.php?sAn=<?=$an;?>" target="_blank"><?=$an;?></a></font>&nbsp;&nbsp;&nbsp;<font class="tablefontt1"> HN : </font><font class='tablefont'><?=$hn; ?></font> &nbsp;&nbsp;&nbsp;<font class="tablefontt1">วันที่รับป่วย : </font>
         <font class="tablefont"> <?=$date.' '.$time[1];?></font>&nbsp;&nbsp;&nbsp;<font class="tablefontt1">วันนอนรวม </font>
         <font class="tablefont"> <?=$daysall;?> วัน</font>
        </td>
        </tr>
      <tr>
        <td colspan="2">
        <table  border="0">
          <tr  style="line-height:22PX;">
            <td  rowspan="5"><img src="../image_patient/<?=$img='NoPicture.jpg';;?>" width="81" height="101" /></td>
            <td class="tablefontt1">ชื่อ-สกุล</td>
            
            <td class="tablefontt2"> <? echo "<a target=_blank  href=\"ipdata1.php? cBedcode=$bedcode\">$ptname</a>"; ?>&nbsp;&nbsp;&nbsp;</td>
            <td class="tablefontt1">อายุ :</td>
            <td class="tablefont"><?=$age;?>&nbsp;&nbsp;&nbsp;</td>
          
            <td class="tablefontt1">สิทธิการรักษา  :</td>
            <td class="tablefont"><?=$ptright;?></td>
          </tr>
          <tr style="line-height:22PX;">
            <td colspan="8"  valign="top" >
            <font class='tablefontt1'>โรค : </font><? echo "<a target=_blank  href=\"ipdiag.php? cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDiag=$diagnos&cbedname=$wardname\" class='tablefont3'>$diagnos</a>";?>&nbsp;&nbsp;&nbsp;
            <font class='tablefontt1'>แพทย์  : </font> <? echo "<a target=_blank  href=\"ipdr.php?cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDoctor=$doctor&cbedname=$wardname\" class='tablefont3' >$doctor</a>"; ?>&nbsp;&nbsp;&nbsp;
            
            <font class='tablefontt1'>โรคประจำตัว  : </font>
           <font class='tablefont'> <? echo "<a target=_blank  href=\"ipdiag1.php?cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDiag=$diag1&cbedname=$wardname\">$diag1</a>";?></font>
            </td>
            </tr>
          <tr style="line-height:22PX;">
            <td colspan="8"  valign="top">
            <font class='tablefontt1'>อาหาร : </font><? echo "<a target=_blank  href=\"ipfood.php? cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cFood=$food&cbedname=$wardname\" class='tablefont3'>$food</a>"; ?><strong style="margin-left:20px; color:#FC0944;"><?php echo $location;?></strong></td>
          </tr>
          <tr style="line-height:25PX;">
            <td colspan="10" valign="top" ><font class='tablefontt1'>หัตถการ  :</font>
			<? echo "<a target=_blank  href=\"ipdata.php? cBedcode=$bedcode\" class='tablefont'>บันทึกค่าใช้จ่าย/ คืนยา / จำหน่าย</a>"; ?> &nbsp;&nbsp; 
            
            <? echo "<a target=_blank href=\"wpreappoi.php?an=$an&cBed=$bed&cBedcode=$bedcode&cHn=$hn&cbedname=$wardname\" class='tablefont'>สั่ง LAB</a>"; ?> &nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"dt_lab_lst_in.php?hn_now=$hn\" class='tablefont'>ดูผล LAB</a>";
			?>&nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"dt_xray_film_in.php?hn_now=$hn\" class='tablefont'>ดูฟิลม์ xray</a>";
			?>&nbsp;&nbsp; 
            <? 
			$str = "month=".date('m')."&year=".(date('Y')+543)."&date=".date('dmy');
			echo "<a target=_blank  href=\"rp_profile.php?an=$an&$str\" class='tablefont'>Drugprofile</a>";
			?>&nbsp;&nbsp; 
            <? 
			$str = "month=".date('m')."&year=".(date('Y')+543)."&date=".date('dmy');
			echo "<a target=_blank  href=\"warddividedrug.php?an=$an&$str\" class='tablefont'>ยาปัจจุบัน</a>";
			?>&nbsp;&nbsp;  
            <? echo "<a target=_blank  href=\"set_from_ward.php?an=$an&bedcode=$lbedcode\" class='tablefont'>ใบSETผ่าตัด</a>"; ?>
            </td>
          </tr>
          <tr style="line-height:25PX;">
            <td colspan="10" valign="top" ><font class='tablefontt1'>ฉลาก : </font><? echo "<a target=_blank  href=\"drug1a.php?Ptname=$ptname&cAn=$an&cBed=$bed& cBedcode=$bedcode&cHn=$hn&cbedname=$sortname\" class='tablefont3'>ยา(1 ดวง)</a>";?>&nbsp;&nbsp; <? echo "<a target=_blank  href=\"ipbeddrug.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cPtname=$ptname & cbedname=$wardname\" class='tablefont3'>ยา(A4)</a>"; ?>&nbsp;&nbsp; <? echo "<a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=$wardname\"  class='tablefont3'>เอกสาร(A4)</a>";?>&nbsp;&nbsp; <? echo "<a target=_blank  href=\"liststk.php?cAn=$an&cBed=$bed& cBedcode=$bedcode&cHn=$hn&cbedname=$sortname\" class='tablefont3'>เอกสาร(1 ดวง)</a>";?></td>
		  </tr>
		  <tr>
			<td colspan="10"><a href="med_ward.php?fill_an=<?=$an;?>" target="_blank">อัพโหลดไฟล์ Doctor Order</a></td>
		  </tr>
        </table></td>
      </tr>
    </table>
    
    </div>
    
    </td>
  </tr>
</table>

<a  href="#top" class="tablefont3">^ Back to Top</a>
<? 
        
		$i++;
		}
		
	
    include("unconnect.inc");
?>



