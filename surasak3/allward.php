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
$wardname="�ͼ��������";	
$sortname="���";
	}elseif($lbedcode=='43'){
$wardname="�ͼ������ٵ�";	
$sortname="�ٵ�";
	}elseif($lbedcode=='44'){
$wardname="�ͼ�����ICU";	
$sortname="ICU";
	}elseif($lbedcode=='45'){
$wardname="�ͼ����¾����";	
$sortname="�����";
	}
	//echo "==>$lbedcode";
	$bbbbcode=$lbedcode;
	include("calroom.php");
	include("alert_booking.php");
	?>
<?=$wardname;?> &nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='ipdcost.php'>����Թ�ء��§</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href='ipstikerdrug.php'>STICKER</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href='booking_system/booking_confirm.php?code=<?=$lbedcode?>'>�к��ͧ��§</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_self"  href="../nindex.htm">�����</a>
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
			$ff="<font class='tablefont3'>��ҧ</font>";
			}else{
			$ff="<font color='#990000' style='font-size:12PX;'>�����ҧ</font>";
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
	
    $query = "SELECT idcard,bed,date,date_format(date,'%d- %m- %Y'),ptname,an,hn,diagnos,food,doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,chgdate,status,age,diag1,days,row_id FROM bed WHERE bedcode LIKE '$lbedcode%' ORDER BY bed ASC ";
  //echo "==>".$query;
    $result = mysql_query($query)or die("Query failed");

$i=1;

    while (list ($idcard,$bed,$date1,$date,$ptname,$an,$hn,$diagnos,$food,$doctor,$ptright,$price,$paid,$debt,$caldate,$bedname,$bedcode,$hn,$chgdate,$status,$age,$diag1,$daysall,$bed_row_id) = mysql_fetch_row ($result)) {

if($diag1=='' and $an!=''){ $diag1='�����'; }			
$status2 = substr($status,0,3);

$time=explode(" ",$date1);

		switch($status2){
			case "B01" : $color="#66FFCC"; break;
			case "B02" : $color="#FF9999"; break;
			case "B03" : $color="#FFFF99"; break;

		}
		
		if($an=='' and $status2=="B01"){
			
			$color="#FFFFFF";
			//$ff="��ҧ";
		}else{
			//$ff="�����ҧ";
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
 
<br />��§ : <?=$bed;?>&nbsp;&nbsp; <?=$status;?>&nbsp;&nbsp; 
<input type="button" id="btn1<?=$i;?>" value="�ʴ���§">
<input type="button" id="btn2<?=$i;?>" value="��͹��§">
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
        <td > <font class="tablefontt1">AN : </font><font class="tablefont"><a href="show_wardlog.php?sAn=<?=$an;?>" target="_blank"><?=$an;?></a></font>&nbsp;&nbsp;&nbsp;<font class="tablefontt1"> HN : </font><font class='tablefont'><?=$hn; ?></font> &nbsp;&nbsp;&nbsp;<font class="tablefontt1">�ѹ����Ѻ���� : </font>
         <font class="tablefont"> <?=$date.' '.$time[1];?></font>&nbsp;&nbsp;&nbsp;<font class="tablefontt1">�ѹ�͹��� </font>
         <font class="tablefont"> <?=$daysall;?> �ѹ</font>
        </td>
        </tr>
      <tr>
        <td colspan="2">
        <table  border="0">
          <tr  style="line-height:22PX;">
            <td  rowspan="5"><img src="../image_patient/<?=$img='NoPicture.jpg';;?>" width="81" height="101" /></td>
            <td class="tablefontt1">����-ʡ��</td>
            
            <td class="tablefontt2"> <? echo "<a target=_blank  href=\"ipdata1.php? cBedcode=$bedcode\">$ptname</a>"; ?>&nbsp;&nbsp;&nbsp;</td>
            <td class="tablefontt1">���� :</td>
            <td class="tablefont"><?=$age;?>&nbsp;&nbsp;&nbsp;</td>
          
            <td class="tablefontt1">�Է�ԡ���ѡ��  :</td>
            <td class="tablefont"><?=$ptright;?></td>
          </tr>
          <tr style="line-height:22PX;">
            <td colspan="8"  valign="top" >
            <font class='tablefontt1'>�ä : </font><? echo "<a target=_blank  href=\"ipdiag.php? cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDiag=$diagnos&cbedname=$wardname\" class='tablefont3'>$diagnos</a>";?>&nbsp;&nbsp;&nbsp;
            <font class='tablefontt1'>ᾷ��  : </font> <? echo "<a target=_blank  href=\"ipdr.php?cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDoctor=$doctor&cbedname=$wardname\" class='tablefont3' >$doctor</a>"; ?>&nbsp;&nbsp;&nbsp;
            
            <font class='tablefontt1'>�ä��Шӵ��  : </font>
           <font class='tablefont'> <? echo "<a target=_blank  href=\"ipdiag1.php?cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDiag=$diag1&cbedname=$wardname\">$diag1</a>";?></font>
            </td>
            </tr>
          <tr style="line-height:22PX;">
            <td colspan="8"  valign="top">
            <font class='tablefontt1'>����� : </font><? echo "<a target=_blank  href=\"ipfood.php? cAn=$an&cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cFood=$food&cbedname=$wardname\" class='tablefont3'>$food</a>"; ?></td>
          </tr>
          <tr style="line-height:25PX;">
            <td colspan="10" valign="top" ><font class='tablefontt1'>�ѵ����  :</font>
			<? echo "<a target=_blank  href=\"ipdata.php? cBedcode=$bedcode\" class='tablefont'>�ѹ�֡��������/ �׹�� / ��˹���</a>"; ?> &nbsp;&nbsp; 
            
            <? echo "<a target=_blank href=\"wpreappoi.php?an=$an&cBed=$bed&cBedcode=$bedcode&cHn=$hn&cbedname=$wardname\" class='tablefont'>��� LAB</a>"; ?> &nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"dt_lab_lst_in.php?hn_now=$hn\" class='tablefont'>�ټ� LAB</a>";
			?>&nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"dt_xray_film_in.php?hn_now=$hn\" class='tablefont'>�ٿ���� xray</a>";
			?>&nbsp;&nbsp; 
            <? 
			$str = "month=".date('m')."&year=".(date('Y')+543)."&date=".date('dmy');
			echo "<a target=_blank  href=\"rp_profile.php?an=$an&$str\" class='tablefont'>Drugprofile</a>";
			?>&nbsp;&nbsp; 
            <? 
			$str = "month=".date('m')."&year=".(date('Y')+543)."&date=".date('dmy');
			echo "<a target=_blank  href=\"warddividedrug.php?an=$an&$str\" class='tablefont'>�һѨ�غѹ</a>";
			?>&nbsp;&nbsp;  
            <? echo "<a target=_blank  href=\"set_from_ward.php?an=$an&bedcode=$lbedcode\" class='tablefont'>�SET��ҵѴ</a>"; ?>
            </td>
          </tr>
          <tr style="line-height:25PX;">
            <td colspan="10" valign="top" ><font class='tablefontt1'>��ҡ : </font><? echo "<a target=_blank  href=\"drug1a.php?Ptname=$ptname&cAn=$an&cBed=$bed& cBedcode=$bedcode&cHn=$hn&cbedname=$sortname\" class='tablefont3'>��(1 �ǧ)</a>";?>&nbsp;&nbsp; <? echo "<a target=_blank  href=\"ipbeddrug.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cPtname=$ptname & cbedname=$wardname\" class='tablefont3'>��(A4)</a>"; ?>&nbsp;&nbsp; <? echo "<a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=$wardname\"  class='tablefont3'>�͡���(A4)</a>";?>&nbsp;&nbsp; <? echo "<a target=_blank  href=\"liststk.php?cAn=$an&cBed=$bed& cBedcode=$bedcode&cHn=$hn&cbedname=$sortname\" class='tablefont3'>�͡���(1 �ǧ)</a>";?></td>
		  </tr>
		  <tr>
			<td colspan="10">
				<a href="med_ward.php?fill_an=<?=$an;?>" target="_blank">�Ѿ��Ŵ��� Doctor Order</a>
				&nbsp;&nbsp;<label for="ptC19"><input type="checkbox" name="ptC19" id="ptC19" value="1" onclick="update_pt_c19(event,'<?=$bed_row_id;?>',this.checked)">������Covid19</label>
			</td>
		  </tr>
        </table></td>
      </tr>
    </table>
    
    </div>
    
    </td>
  </tr>
</table>

<?php 
if($lbedcode=='42'){ 
?>
<script type="text/javascript">
	function update_pt_c19(ev,bed_row_id,status_checkbox){
		// ev.preventDefault();
		console.log(bed_row_id);
		console.log(status_checkbox);
		/*
		var request = new XMLHttpRequest();
		request.open('GET', 'allward.php?id='+bed_row_id, true);

		request.onreadystatechange = function() {
		if (this.readyState === 4) {
			if (this.status >= 200 && this.status < 400) {
				// Success!
				var resp = this.responseText;
				if(resp === 'N')
				{
					alert("��辺 HN �ҡ�Ţ�ѵû�ЪҪ�");
				}
				else
				{
					document.getElementById("PID").value = resp;
				}
			} else {
				
			}
		}
		};

		request.send();
		request = null;
		*/
	}
</script>
<?php
}
?>

<a  href="#top" class="tablefont3">^ Back to Top</a>
<? 
        
		$i++;
		}
		
	
    include("unconnect.inc");
?>



