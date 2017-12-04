<?php
    session_start();
    if (isset($sIdname)){
		} else {die;}
		
	//header("content-type: application/x-javascript; charset=TIS-620");
?>
<link href="css/style_table.css" rel="stylesheet" type="text/css" />

   หอผู้ป่วยรวม &nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='../ipdcost.php'>รวมเงินทุกเตียง</a>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a target="_blank" href='../ipstikerdrug.php'>STICKER</a>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp  <a target=_self  href="../nindex.htm">ไปเมนู</a>
<script>
/*$(window).load(function() {
$('#toTop').scrollToTop();					
});*/


  </script>
<a name="top" id="top"></a>
<br />
<?php
	
    include("../connect.inc");
	
	$sql="SELECT * FROM bed WHERE bedcode LIKE '42%'";
	$resultsql = mysql_query($sql)or die(mysql_error());
	//$n=mysql_num_rows($resultsql);
	
	
echo"<br><table border=\"0\"  cellspacing=\"1\" cellpadding=\"1\"><tr>";
		$intRows = 0;
		while($arr=mysql_fetch_array($resultsql)){
			
			$status2 = substr($arr['status'],0,3);
			
			if($arr['an']=='' and $status2=="B01"){
			$ff="ว่าง";
			}else{
			$ff="ไม่ว่าง";
			}
			
			echo "<td>"; 
			$intRows++;
	?>
			<!--<center>-->
				<? echo "<a href='#$arr[bed]'>".$arr['bed'].'(<font class="tablefont3">'.$ff.' </font>)'."$i</a>&nbsp;&nbsp;";?>
				<br>
			<!--</center>-->
	<?
			echo"</td>";
			if(($intRows)%12==0)
			{
				echo"</tr>";
			}
		}
		echo"</tr></table>";
	
    $query = "SELECT idcard,bed,date,date_format(date,'%d- %m- %Y'),ptname,an,hn,diagnos,food,doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,chgdate,status,age FROM bed WHERE bedcode LIKE '42%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)or die("Query failed");

    while (list ($idcard,$bed,$date1,$date,$ptname,$an,$hn,$diagnos,$food,$doctor,$ptright,$price,$paid,$debt,$caldate,$bedname,$bedcode,$hn,$chgdate,$status,$age) = mysql_fetch_row ($result)) {
		
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
		
		/*if(file_exists("image_patient/$idcard")){
			$img=$idcard;
		}else{
			$img='nopic.png';
		}*/
?>
<br />

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#000000" bgcolor="<?=$color;?>" >
  <tr>
    <td>
    
    <table width="100%" border="0">
      <tr>
        <td width="25%"><a name="<?=$bed;?>" id="<?=$bed;?>"></a><font class="bed"><? echo"<a href=\"ipbed.php? cBed=$bed&cDate=$date&cPtname=$ptname&cAn=$an&cDiagnos=$diagnos&cFood=$food&cDoctor=$doctor&cPtright=$ptright&cBedcode=$bedcode&cHn=$hn&cChgdate=$chgdate & cbedname=หอผู้ป่วยรวม \" class='bed'>$bed</a>";?></font>&nbsp;&nbsp;&nbsp;
		<? echo "<a target=_blank  href=\"bedstatus.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cstatus=$status\" class='tablefont'>$status</a>"; ?></td>
        <td > <font class="tablefontt1">AN : </font><font class="tablefont"> <? echo "$an"; ?></font>&nbsp;&nbsp;&nbsp;<font class="tablefontt1"> HN : </font><font class='tablefont'><?=$hn; ?></font> &nbsp;&nbsp;&nbsp;<font class="tablefontt1">วันที่รับป่วย : </font>
         <font class="tablefont"> <?=$date.' '.$time[1];?></font>
        </td>
        </tr>
      <tr>
        <td colspan="2">
        <table  border="0">
          <tr >
            <td  rowspan="4"><img src="image_patient/<?=$idcard;?>" width="84" height="115" /></td>
            <td class="tablefontt1">ชื่อ-สกุล</td>
            
            <td class="tablefontt2"> <? echo "$ptname"; ?>&nbsp;&nbsp;&nbsp;</td>
            <td class="tablefontt1">อายุ :</td>
            <td class="tablefont"><?=$age;?>&nbsp;&nbsp;&nbsp;</td>
          
            <td class="tablefontt1">สิทธิการรักษา  :</td>
            <td class="tablefont"><?=$ptright;?></td>
          </tr>
          <tr>
            <td colspan="8"  valign="top" class="tablefontt1">โรค : <? echo "<a target=_blank  href=\"ipdiag.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDiag=$diagnos\" class='tablefont3'>$diagnos</a>";?>&nbsp;&nbsp;&nbsp;แพทย์  :  <? echo "<a target=_blank  href=\"ipdr.php?cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDoctor=$doctor\" class='tablefont3' >$doctor"; ?></td>
            </tr>
          <tr>
            <td colspan="8"  valign="top" class="tablefontt1">อาหาร : <? echo "<a target=_blank  href=\"ipfood.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cFood=$food\" class='tablefont3'>$food</a>"; ?></td>
          </tr>
          <tr>
            <td colspan="10" valign="top" class="tablefontt1">หัตถการ  :
			<? echo "<a target=_blank  href=\"ipdata.php? cBedcode=$bedcode\">บันทึกค่าใช้จ่าย/จำหน่าย</a>"; ?> &nbsp;&nbsp; 
            
            <? echo "<a target=_blank href=\"wpreappoi.php?an=$an&cBed=$bed&cBedcode=$bedcode&cHn=$hn&cbedname=หอผู้ป่วยรวม\" class='tablefont'>สั่ง LAB</a>"; ?> &nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"dt_lab_lst_in.php?hn_now=$hn\" class='tablefont'>ดูผล LAB</a>";
			?>&nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"dt_xray_film_in.php?hn_now=$hn\" class='tablefont'>ดูฟิลม์ xray</a>";
			?>&nbsp;&nbsp; 
            ฉลาก :
			<? echo "<a target=_blank  href=\"ipbeddrug.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=หอผู้ป่วยรวม \" class='tablefont'>ยา(A4)</a>"; ?>&nbsp;&nbsp; 
			<? echo "<a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=หอผู้ป่วยรวม \"  class='tablefont'>ติดเอกสาร(A4)</a>";?>&nbsp;&nbsp; 
			<? echo "<a target=_blank  href=\"ipbed1a.php?cAn=$an&cBed=$bed& cBedcode=$bedcode&cHn=$hn&cbedname=หอผู้ป่วยรวม \" class='tablefont'>ติดเอกสาร(1 ดวง)</a>";?>&nbsp;&nbsp; 
            </td>
          </tr>
        </table></td>
      </tr>
    </table>
    
    </td>
  </tr>
</table>

<a  href="#top">^ Back to Top ^</a>
<? 
        }
	$bbbbcode= "42";
	include("../calroom.php");
    include("../unconnect.inc");
?>



