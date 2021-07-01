<?php
    session_start();
    if (isset($sIdname)){ } else {die;}
	
	include("connect.inc");

	$action = $_GET['action'];
	if($action==='update')
	{
		$id = (int)$_GET['id'];
		$status = htmlentities($_GET['status'], ENT_QUOTES);

		if($status=='n')
		{
			$status = 'NULL';
		}
		else
		{
			$status = "'$status'";
		}

		$sql = "UPDATE `bed` SET `c19status` = $status WHERE `row_id` = '$id' LIMIT 1 ";
		$q = mysql_query($sql);
		if($q==false)
		{
			echo mysql_error();
		}
		elseif ($q===true && $status == 'y') 
		{
			echo 'ตั้งค่าเรียบร้อย กรุณา Refresh หน้าจอ1ครั้งเพื่อให้ระบบคำนวณค่าเตียงใหม่';
		}
		exit;
	}

	//header("content-type: application/x-javascript; charset=TIS-620");
?>
<link href="css/style_table.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
  
<a name="top" id="top"></a>
<br />
<?php
	
    
	
	
	
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
	}
	//echo "==>$lbedcode";
	$bbbbcode=$lbedcode;
	include("calroom.php");
	include("alert_booking.php");
	?>
<?=$wardname;?> &nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='ipdcost.php'>รวมเงินทุกเตียง</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href='ipstikerdrug.php'>STICKER</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href='booking_system/booking_confirm.php?code=<?=$lbedcode?>'>ระบบจองเตียง</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_self"  href="../nindex.htm">ไปเมนู</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank"  href="med_record.php?code=<?=$lbedcode;?>">Med Record</a>
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
	
    $query = "SELECT idcard,bed,date,date_format(date,'%d- %m- %Y'),ptname,an,hn,diagnos,food,doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,chgdate,status,age,diag1,days,row_id,c19status FROM bed WHERE bedcode LIKE '$lbedcode%' ORDER BY bed ASC ";
  //echo "==>".$query;
    $result = mysql_query($query)or die("Query failed");

$i=1;

    while (list ($idcard,$bed,$date1,$date,$ptname,$an,$hn,$diagnos,$food,$doctor,$ptright,$price,$paid,$debt,$caldate,$bedname,$bedcode,$hn,$chgdate,$status,$age,$diag1,$daysall,$bed_row_id,$c19status) = mysql_fetch_row ($result)) {

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
            <font class='tablefontt1'>อาหาร : </font><? echo "<a target=_blank  href=\"ipfood.php? cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cFood=$food&cbedname=$wardname\" class='tablefont3'>$food</a>"; ?></td>
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
			<td colspan="10">
				<a href="med_ward.php?fill_an=<?=$an;?>" target="_blank">อัพโหลดไฟล์ Doctor Order</a>

				<?php 
				if($lbedcode=='42'){
					$c19checked = ($c19status=='y') ? 'checked="checked"' : '' ;
					?>
					&nbsp;&nbsp;<label for="ptC19<?=$bed_row_id;?>"><input type="checkbox" name="ptC19[]" id="ptC19<?=$bed_row_id;?>" class="ptC19" bed-id="<?=$bed_row_id;?>" value="1" <?=$c19checked;?>>คิดค่าห้องควบคุมผู้ป่วย COVID ใน รพ.</label>
					<?php 
				}
				?>
			</td>
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





if($lbedcode=='42'){ 
?>
<script type="text/javascript">

	function addEventListener(el, eventName, handler) {
		if (el.addEventListener) {
			el.addEventListener(eventName, handler);
		} else {
			el.attachEvent('on' + eventName, function(){
			handler.call(el);
			});
		}
	}

	var ptc19items = document.getElementsByClassName("ptC19");
	if(ptc19items.length > 0)
	{
		for (let index = 0; index < ptc19items.length; index++) {
			ptc19items[index].addEventListener("change", update_c19_inpt);
		}
	}

	// ตั้งค่าเตียงผู้ป่วยโควิด
	function update_c19_inpt(){ 
		var status;
		if(this.checked===true){
			status = 'y';
		}else{
			status = 'n';
		}

		var bed_row_id = this.getAttribute("bed-id");
		var request = new XMLHttpRequest();
		request.open('GET', 'allward.php?action=update&id='+bed_row_id+'&status='+status, true);

		request.onreadystatechange = function() {
		if (this.readyState === 4) {
			if (this.status >= 200 && this.status < 400) {
				// Success!
				var resp = this.responseText;
				if(resp.trim()!==''){
					alert(resp);
				}
			} else {
				
			}
		}
		};

		request.send();
		request = null;

	}
</script>
<?php
}

		
	
    include("unconnect.inc");
?>



