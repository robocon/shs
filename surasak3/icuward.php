<?php
    session_start();
    if (isset($sIdname)){
		} else {die;}
		
	//header("content-type: application/x-javascript; charset=TIS-620");
	
?>
<link href="css/style_table.css" rel="stylesheet" type="text/css" />

   �ͼ�����˹ѡ(ICU) &nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='ipdcost.php'>����Թ�ء��§</a>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href='ipstikerdrug.php'>STICKER</a>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp  <a target=_self  href="../nindex.htm">�����</a>
<script>
/*$(window).load(function() {
$('#toTop').scrollToTop();					
});*/


  </script>
<a name="top" id="top"></a>
<br />
<?php
	
    include("connect.inc");
	$bbbbcode= "44";
	include("calroom.php");
	$sql="SELECT * FROM bed WHERE bedcode LIKE '44%'";
	$resultsql = mysql_query($sql)or die(mysql_error());
	//$n=mysql_num_rows($resultsql);
	
	
echo"<br><table border=\"0\"  cellspacing=\"1\" cellpadding=\"1\"><tr>";
		$intRows = 0;
		while($arr=mysql_fetch_array($resultsql)){
			
			$status2 = substr($arr['status'],0,3);
			
			if($arr['an']=='' and $status2=="B01"){
			$ff="<font class='tablefont3'>��ҧ</font>";
			}else{
			$ff="<font color='#990000' style='font-size:12PX;'>�����ҧ</font>";
			}
			
			echo "<td>"; 
			$intRows++;
	?>
			<!--<center>-->
				<? echo "<a href='#$arr[bed]'>".$arr['bed'].'('.$ff.')'."$i</a>&nbsp;&nbsp;";?>
				<br>
			<!--</center>-->
	<?
			echo"</td>";
			if(($intRows)%9==0)
			{
				echo"</tr>";
			}
		}
		echo"</tr></table>";
	
    $query = "SELECT idcard,bed,date,date_format(date,'%d- %m- %Y'),ptname,an,hn,diagnos,food,doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,chgdate,status,age,diag1 FROM bed WHERE bedcode LIKE '44%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)or die("Query failed");

    while (list ($idcard,$bed,$date1,$date,$ptname,$an,$hn,$diagnos,$food,$doctor,$ptright,$price,$paid,$debt,$caldate,$bedname,$bedcode,$hn,$chgdate,$status,$age,$diag1) = mysql_fetch_row ($result)) {
		
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
		
if($idcard=="" || $idcard=="-"){
	$img=$hn.'.jpg';
}else{
	$img=$idcard.'.jpg';
}
		
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
        <td width="25%"><a name="<?=$bed;?>" id="<?=$bed;?>"></a><font class="bed"><? echo"<a href=\"ipbed.php? cBed=$bed&cDate=$date&cPtname=$ptname&cAn=$an&cDiagnos=$diagnos&cFood=$food&cDoctor=$doctor&cPtright=$ptright&cBedcode=$bedcode&cHn=$hn&cChgdate=$chgdate & cbedname=�ͼ�����ICU \" class='bed'>$bed</a>";?></font>&nbsp;&nbsp;&nbsp;
		<? echo "<a target=_blank  href=\"bedstatus.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cstatus=$status\" class='tablefont'>$status</a>"; ?></td>
        <td > <font class="tablefontt1">AN : </font><font class="tablefont"> <a href="show_wardlog.php?sAn=<?=$an;?>" target="_blank"><?=$an;?></a></font>&nbsp;&nbsp;&nbsp;<font class="tablefontt1"> HN : </font><font class='tablefont'><?=$hn; ?></font> &nbsp;&nbsp;&nbsp;<font class="tablefontt1">�ѹ����Ѻ���� : </font>
         <font class="tablefont"> <?=$date.' '.$time[1];?></font>
        </td>
        </tr>
      <tr>
        <td colspan="2">
        <table  border="0">
          <tr style="line-height:22PX;">
            <td  rowspan="4"><img src="../image_patient/<?=$img;?>" width="81" height="101" /></td>
            <td class="tablefontt1">����-ʡ��</td>
            
            <td class="tablefontt2"> <? echo "<a target=_blank  href=\"ipdata1.php? cBedcode=$bedcode\">$ptname</a>"; ?>&nbsp;&nbsp;&nbsp;</td>
            <td class="tablefontt1">���� :</td>
            <td class="tablefont"><?=$age;?>&nbsp;&nbsp;&nbsp;</td>
          
            <td class="tablefontt1">�Է�ԡ���ѡ��  :</td>
            <td class="tablefont"><?=$ptright;?></td>
          </tr>
          <tr style="line-height:22PX;">
            <td colspan="8"  valign="top" ><font class='tablefontt1'>�ä : </font><? echo "<a target=_blank  href=\"ipdiag.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDiag=$diagnos&cbedname=�ͼ�����ICU&cAn=$an\" class='tablefont3'>$diagnos</a>";?>&nbsp;&nbsp;&nbsp;<font class='tablefontt1'>ᾷ��  : </font> <? echo "<a target=_blank  href=\"ipdr.php?cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDoctor=$doctor&cbedname=�ͼ�����ICU&cAn=$an\" class='tablefont3' >$doctor</a>";?>
            &nbsp;&nbsp;&nbsp;
            <font class='tablefontt1'>�ä��Шӵ��  : </font>
           <font class='tablefont'> <? echo "<a target=_blank  href=\"ipdiag1.php?cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDiag=$diag1&cbedname=�ͼ�����ICU&cAn=$an\">$diag1</a>";?></font>
            
            </td>
            </tr>
          <tr style="line-height:22PX;">
            <td colspan="8"  valign="top"><font class='tablefontt1'>����� : </font><? echo "<a target=_blank  href=\"ipfood.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cFood=$food&cbedname=�ͼ�����ICU&cAn=$an\" class='tablefont3'>$food</a>"; ?>
            
            
            </td>
          </tr>
          <tr style="line-height:25PX;">
            <td colspan="10" valign="top" class="tablefontt1">�ѵ����  :
			<? echo "<a target=_blank  href=\"ipdata.php? cBedcode=$bedcode\" class='tablefont'>�ѹ�֡��������/ �׹�� / ��˹���</a>"; ?> &nbsp;&nbsp; 
            
            <? echo "<a target=_blank href=\"wpreappoi.php?an=$an&cBed=$bed&cBedcode=$bedcode&cHn=$hn&cbedname=�ͼ�����ICU\" class='tablefont'>��� LAB</a>"; ?> &nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"dt_lab_lst_in.php?hn_now=$hn\" class='tablefont'>�ټ� LAB</a>";
			?>&nbsp;&nbsp; 
            <? echo "<a target=_blank  href=\"dt_xray_film_in.php?hn_now=$hn\" class='tablefont'>�ٿ���� xray</a>";
			?>&nbsp;&nbsp; 
             <font class='tablefontt1'>��ҡ : </font>
            <? echo "<a target=_blank  href=\"drug1a.php?Ptname=$ptname&cAn=$an&cBed=$bed& cBedcode=$bedcode&cHn=$hn&cbedname=ICU \" class='tablefont3'>��(1 �ǧ)</a>";?>&nbsp;&nbsp;
			<? echo "<a target=_blank  href=\"ipbeddrug.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=�ͼ�����ICU \" class='tablefont3'>��(A4)</a>"; ?>&nbsp;&nbsp; 
			<? echo "<a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=�ͼ�����ICU \"  class='tablefont3'>�Դ�͡���(A4)</a>";?>&nbsp;&nbsp; 
			<? echo "<a target=_blank  href=\"liststk.php?cAn=$an&cBed=$bed& cBedcode=$bedcode&cHn=$hn&cbedname=ICU \" class='tablefont3'>�͡���(1 �ǧ)</a>";?>
            </td>
          </tr>
        </table></td>
      </tr>
    </table>
    
    </td>
  </tr>
</table>

<a  href="#top" class="tablefont3">^ Back to Top</a>
<? 
        }
	
    include("unconnect.inc");
?>



