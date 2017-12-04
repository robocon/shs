<style type="text/css">
.font1 {
	font-family: "TH Niramit AS";
	font-size:24px;
}
</style>
<?php

	include("connect.inc");
	
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

?>

<style type="text/css">
<!--
.font3 {
	color:#000;
}
-->
</style>
<?
    

    $query = "SELECT * FROM opday WHERE thdatehn = '$cTdatehn' AND vn = '".$_GET["cVn"]."' ";
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
/*
CREATE TABLE opday (
  row_id int(11) NOT NULL auto_increment,
  thidate datetime default NULL,
  thdatehn varchar(20) default NULL,
  hn varchar(12) NOT NULL default '',
  vn varchar(5) default NULL,
  thdatevn varchar(13) default NULL,
  an varchar(12) default NULL,
  ptname varchar(30) default NULL,
  ptright varchar(32) default NULL,
  goup varchar(24) default NULL,
  camp varchar(24) default NULL,
  dxgroup char(2) default NULL,
  diag varchar(40) default NULL,
  icd10 varchar(8) default NULL,
  doctor varchar(40) default NULL,
  PRIMARY KEY  (row_id),
  KEY thdatehn (thdatehn),
  KEY thdatevn (thdatevn)
) TYPE=MyISAM;
*/
   If ($result){
        //vn,ptname,hn,an,goup,diag,dxgroup
        $cPtname=$row->ptname;
        $cHn=$row->hn;
        $cGoup=$row->goup;
        $cDiag=$row->diag;
       	$cTdate=$row->thidate;
		$cDiag_morbidity  = $row->diag_morbidity;
		$cDiag_complication  = $row->diag_complication;
		$cDiag_other = $row->diag_other;
		$CExternal_cause = $row->external_cause;
		
		$cDoctor=$row->doctor;
        $cDxgroup=$row->dxgroup;
        $cIcd10=$row->icd10;
        $cIcd101=$row->icd101;
		$cIcd10_complication = $row->icd10_complication;
		$cIcd10_other = $row->icd10_other;
		$cIcd10_external_cause = $row->icd10_external_cause;

        $cIcd9cm=$row->icd9cm;
    $cokopd=$row->okopd;
    $cthidate=$row->thidate;
	$thdatehn_value = $row->thdatehn;
	    $Cclinic=$row->clinic;

	$sql = "Select diag, left(toborow,5), left(toborow,4) From opday2 where thdatehn = '".$thdatehn_value."' AND (left(toborow,5) in ('EX 91', 'EX 92') OR left(toborow,4) in ('EX91', 'EX92')) ";
	$result2 = Mysql_Query($sql); 
	while(list($opday2_diag, $toborow, $toborow2) = Mysql_fetch_row($result2)){
		
		if(substr($opday2_diag,0 ,1) == ","){
			$opday2_diag = substr($opday2_diag,1);
		}
		if($cDiag != "")
			$list_diag = ", ";
		else
			$list_diag = "";

		if($toborow == "EX 91" || ($toborow2 == "EX91" ||  $toborow2 == "EX17")){
			$head_diag_ex91 = "<BR><FONT SIZE=\"2\" COLOR=\"red\">โรค (จากกายภาพ/นวดแผนไทย)</FONT>";
			$detail_diag_ex91 = "<BR><FONT SIZE=\"2\" COLOR=\"red\">".$opday2_diag."</FONT>";
			$list_diag .= $opday2_diag;
		}else if($toborow == "EX 92" || $toborow2 == "EX92"){
			$head_diag_ex92 = "<BR><FONT SIZE=\"2\" COLOR=\"red\">โรค (จากฝังเข็ม)</FONT>";
			$detail_diag_ex92 = "<BR><FONT SIZE=\"2\" COLOR=\"red\">".$opday2_diag."</FONT>";
			$list_diag .= $opday2_diag;
		}

	}

                  }  
   else {
      echo "ไม่พบ รหัส : $cTdatehn";
           }    


print "<body bgcolor='##669999' text='#FFFFFF'>";
//print "<form method='POST' action='dxopok.php' >";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "แก้ไขได้เฉพาะประเภทบุคคล กลุ่มโรค คลีนิก แพทย์ และรหัสICD10,ICD9CM</p>";
//print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่    $cthidate </p>";

?>

<?php print "<p><input type='text' name='cokopd' size='2' value='$cokopd'>";?>
<TABLE width="80%" border="0" align="center" class="font1">
<TR>
  <TD colspan="5" ><table border="0">
    <tr>
      <td>HN</td>
      <td><?php echo "<input type='text' name='hn' size='10' value='$cHn'>";?></td>
      <td>ชื่อผู้ป่วย</td>
      <td><?php echo "<input type='text' name='ptname' size='30' value='$cPtname'>";?></td>
      <td>ประเภทบุคคล</td>
      <td><?php
					print " <select  name='goup'>";
					print " <option value='$cGoup' selected>$cGoup</option>";
					print " <option value='0' ><-เลือกประเภทบุคค-></option>";
					print " <option value='G11&nbsp;ก.1 นายทหารประจำการ'>G11&nbsp;ก.1 นายทหารประจำการ</option>";
					print " <option value='G12&nbsp;ก.2 นายสิบ  พลทหารประจำการ'>G12&nbsp;ก.2 นายสิบ  พลทหารประจำการ</option>";
					print " <option value='G13&nbsp;ก.3 ข้าราชการกลาโหมพลเรือน'>G13&nbsp;ก.3 ข้าราชการกลาโหมพลเรือน</option>";
					print " <option value='G14&nbsp;ก.4 ลูกจ้างประจำ'>G14&nbsp;ก.4 ลูกจ้างประจำ</option>";
					print " <option value='G15 &nbsp;ก.5 ลูกจ้างชั่วคราว'>G15 &nbsp;ก.5 ลูกจ้างชั่วคราว</option>";
					print " <option value='G21&nbsp;ข.1 สิบตรี พลทหารกองประจำการ'>G21&nbsp;ข.1 สิบตรี พลทหารกองประจำการ</option>";
					print " <option value='G22&nbsp;ข.2 นักเรียนทหาร'>G22&nbsp;ข.2 นักเรียนทหาร</option>";
					print " <option value='G23 &nbsp;ข.3 อาสาสมัครทหารพราน'>G23 &nbsp;ข.3 อาสาสมัครทหารพราน</option>";
					print " <option value='G24 &nbsp;ข.4 นักโทษทหาร'>G24 &nbsp;ข.4 นักโทษทหาร</option>";
					print " <option value='G31&nbsp;ค.1 ครอบครัวทหาร'>G31&nbsp;ค.1 ครอบครัวทหาร</option>";
					print " <option value='G32&nbsp;ค.2 ทหารนอกประจำการ'>G32&nbsp;ค.2 ทหารนอกประจำการ</option>";
					print " <option value='G33&nbsp;ค.3 นักศึกษาวิชาทหาร(รด)'>G33&nbsp;ค.3 นักศึกษาวิชาทหาร(รด)</option>";
					print " <option value='G34&nbsp;ค.4 วิวัฒน์พลเมือง'>G34&nbsp;ค.4 วิวัฒน์พลเมือง</option>";
					print " <option value='G35&nbsp;ค.5 บัตรประกันสังคม'>G35&nbsp;ค.5 บัตรประกันสังคม</option>";
					print " <option value='G36&nbsp;ค.6 บัตรทอง30บาท'>G36&nbsp;ค.6 บัตรทอง30บาท</option>";
					print " <option value='G37&nbsp;ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)'>G37&nbsp;ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)</option>";
					print " <option value='G38&nbsp;ค.8 พลเรือน(ไม่เบิกต้นสังกัด)'>G38&nbsp;ค.8 พลเรือน(ไม่เบิกต้นสังกัด)</option>";
					print " <option value='G39&nbsp;ค.9 อื่นๆไม่ระบุ'>G39&nbsp;ค.9 อื่นๆไม่ระบุ</option>";
					print "   </select>";
				?></td>
      </tr>
    <tr>
      <td>คลีนิก</td>
      <td><?php
						print " <select  name='clinic' >";
						print " <option value='$Cclinic' selected>$Cclinic</option>";
						print " <option value='99' ><-เลือกคลีนิก-></option>";
						print " <option value='01 อายุรกรรม'>อายุรกรรม</option>";
						print " <option value='02 ศัลยกรรม'>ศัลยกรรม</option>";
						print " <option value='03 สูติกรรม'>สูติกรรม</option>";
						print " <option value='04 นารีเวชกรรม'>นารีเวชกรรม</option>";
						print " <option value='05 กุมารเวช'>กุมารเวช</option>";
						print " <option value='06 โสต ศอ นาสิก'>โสต สอ นาสิก</option>";
						print " <option value='07 จักษุ'>จักษุ</option>";
						print " <option value='08 ศัลยกรรมกระดูก'>ศัลยกรรมกระดุก</option>";
						print " <option value='09 จิตเวช'>จิตเวช</option>";
						print " <option value='10 รังษีวิทยา'>รังษีวิทยา</option>";
						print " <option value='11 ทันตกรรม'>ทันตกรรม</option>";
						print " <option value='12 ฉุกเฉิน'>ฉุกเฉิน</option>";
						print " <option value='13 กายภาพบำบัด'>กายภาพบำบัด</option>";
						print " <option value='14 แพทย์แผนไทย'>แพทย์แผนไทย</option>";
						print " <option value='15 PCU ใน รพ.'>PCU ใน รพ.</option>";
						print " <option value='99 อื่นๆ'>อื่นๆ</option>";
						print "   </select>";
			?></td>
      <td>แพทย์</td>
      <td><?php
						print "<select  name='doctor1'>";
						print " <option value='$cDoctor' selected>$cDoctor</option>";
						$strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
						$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
						while($objResult = mysql_fetch_array($objQuery)) 
						{ 
							echo "<option value='".$objResult["name"]."'>".$objResult["name"]."</option> ";
						} 
						print "   </select>";
						?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    </table></TD>
</TR>
<?
$date=explode(" ",$cthidate);
$date1=$date[0];
$sqlxray="select * from xray_stat where date like '$date1%' and hn='$cHn' ";
$objxray = mysql_query($sqlxray) or die ("Error Query [".$sqlxray."]");

$row_xray=mysql_num_rows($objxray);

if($row_xray){
?>
<TR>
  <TD colspan="5" align="center" >การตรวจ Xray</TD>
  </TR>
  <?
  while($arr=mysql_fetch_array($objxray)){
   ?>
<TR>
  <TD width="29%" align="center" >&nbsp;</TD>
  <TD width="20" ><?=$arr['detail'];?></TD>
  <TD width="17%" align="left" >&nbsp;</TD>
  <TD width="19%" align="left" >&nbsp;</TD>
  </TR>
<?
  }
}
?>
<tr>
  <td colspan="5" align="center"><div id="list" style="left:150px; top: 20px; position: absolute;"></div><b><br />
    : ICD10 (diagnosis) :</b></td>
</tr>

<?
$test1 = "select * from diag where hn='".$cHn."' and svdate like '".substr($cthidate,0,10)."%' and type='PRINCIPLE' and an='".$_GET["cVn"]."' and status='Y' order by row_id desc ";
$rows = mysql_query($test1)or die (mysql_error());

$rs = mysql_fetch_array($rows);
?>
<tr>
  <td align="right">PRINCIPLE DX</td>
  <td colspan="3"><input type='text' name='icd10' size='8' id="icd10" onkeypress="searchSuggest3(this.value,3,'icd10','diag');" onkeydown="if(event.keyCode == 40&&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" value="<?=$rs['icd10']?>"/>    <input name="diag" type="text" id="diag" size="40" value="<?=$rs['diag']?>" onkeypress="searchSuggest3(this.value,3,'icd10','diag');"/>
  <input name="prin" type="hidden" value="<?=$rs['row_id']?>" />
  <input name="thaiprin" type="hidden" value="<?=$rs['diag_thai']?>"/></td>
  </tr>
<tr>
  <td colspan="8"><hr /></td>
</tr>
<tr>
  <td colspan="8" align="center"></td>
</tr>
<tr>
  <td colspan="5"><table width="100%">
  <?
  $r=0;
  $test2 = "select * from diag where hn='".$cHn."' and svdate like '".substr($cthidate,0,10)."%' and type='CO-MORBIDITY' and an='".$_GET["cVn"]."' and status='Y'";
  $rows2 = mysql_query($test2);
  while($rs2 = mysql_fetch_array($rows2)){
  ?>
    <tr>
      <td width="21%"  align="right" valign="middle">CO-MORBIDITY</td>
      <td width="9%"  valign="middle">
        <input name="dt_icd10_morbiditya<?=$r?>" type="text" id="dt_icd10_morbiditya<?=$r?>" onkeypress="searchSuggest6(this.value,3,'<?=$r?>');"  onkeydown="if(event.keyCode == 40&&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="8" value="<?=$rs2['icd10']?>" /></td>
      <td width="70%"  valign="middle"><input name="dt_diag_morbiditya<?=$r?>" type="text" id="dt_diag_morbiditya<?=$r?>" onkeypress="searchSuggest6(this.value,2,'<?=$r?>');" size="40" value="<?=$rs2['diag']?>" />
      <input name="como<?=$r?>" type="hidden" value="<?=$rs2['row_id']?>" />
  	  <input name="thaicomo<?=$r?>" type="hidden" value="<?=$rs2['diag_thai']?>"/></td>
    </tr>
    <?
	$r++;
  }
  $r=0;
	?>
    
  </table>
    </td>
</tr>
<tr>
  <td colspan="7"><hr /></td>
</tr>

<tr>
  <td colspan="5" align="right">
  <table width="100%">
    <?
  $r=0;
  $test3 = "select * from diag where hn='".$cHn."' and svdate like '".substr($cthidate,0,10)."%' and type='COMPLICATION' and an='".$_GET["cVn"]."' and status='Y'";
  $rows3 = mysql_query($test3);
  while($rs3 = mysql_fetch_array($rows3)){
  ?>
    <tr>
      <td width="21%"  align="right" valign="middle">COMPLICATION</td>
      <td width="9%"  valign="middle"><input name="dt_icd10_complicationa<?=$r?>" type="text" id="dt_icd10_complicationa<?=$r?>"  onkeypress="searchSuggest7(this.value,3,'<?=$r?>');"  onkeydown="if(event.keyCode == 40&amp;&amp;document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="8" value="<?=$rs3['icd10']?>" /></td>
      <td width="70%"  valign="middle"><input name="dt_diag_complicationa<?=$r?>" type="text" id="dt_diag_complicationa<?=$r?>" onkeypress="searchSuggest7(this.value,2,'<?=$r?>');" size="40" value="<?=$rs3['diag']?>" />
        <input name="compli<?=$r?>" type="hidden" value="<?=$rs3['row_id']?>" />
        <input name="thaicompli<?=$r?>" type="hidden" value="<?=$rs3['diag_thai']?>"/></td>
    </tr>
    <?
	$r++;
  }
  $r=0;
	?>
  </table>

  <!--COMPLICATION
<input type='text' name='complica' size='8' value=''  onkeypress="searchSuggest3(this.value,3,'complica','comdetail')" onkeydown="if(event.keyCode == 40&&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"/>    
    <input name="comdetail" type="text" id="comdetail" size="40" value=""/>--></td>
</tr>

<tr>
  <td colspan="5" align="right"><table width="100%">
    <?
  $r=0;
  $test4 = "select * from diag where hn='".$cHn."' and svdate like '".substr($cthidate,0,10)."%' and type='OTHER' and an='".$_GET["cVn"]."' and status='Y'";
  $rows4 = mysql_query($test4);
  while($rs4 = mysql_fetch_array($rows4)){
  ?>
    <tr>
      <td width="21%"  align="right" valign="middle">OTHER</td>
      <td width="9%"  valign="middle"><input name="dt_icd10_othera<?=$r?>" type="text" id="dt_icd10_othera<?=$r?>" onkeypress="searchSuggest8(this.value,2,'<?=$r?>');"  onkeydown="if(event.keyCode == 40&amp;&amp;document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="8" value="<?=$rs4['icd10']?>" /></td>
      <td width="70%"  valign="middle"><input name="dt_diag_othera<?=$r?>" type="text" id="dt_diag_othera<?=$r?>" onkeypress="searchSuggest8(this.value,2,'<?=$r?>');" size="40" value="<?=$rs4['diag']?>" />
        <input name="other<?=$r?>" type="hidden" value="<?=$rs4['row_id']?>" />
        <input name="thaiother<?=$r?>" type="hidden" value="<?=$rs4['diag_thai']?>"/></td>
    </tr>
    <?
	$r++;
  }
  $r=0;
	?>
  </table></td>
  </tr>

  <tr>
  <td colspan="5" align="right">
    <!--EXTERNAL CAUSE 
    <input type='text' name='extcause' size='8' value='<?=$rs5['icd10'];?>' onkeypress="searchSuggest3(this.value,3,'extcause','externadetail')" onkeydown="if(event.keyCode == 40&&document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }"/>    
    <input name="externadetail" type="text" id="externadetail" size="40" value='<?=$rs5['diag'];?>'/>-->
    <table width="100%">
      <?
  $r=0;
  $test5 = "select * from diag where hn='".$cHn."' and svdate like '".substr($cthidate,0,10)."%' and type='EXTERNAL CAUSE' and an='".$_GET["cVn"]."' and status='Y'";
  $rows5 = mysql_query($test5);
  while($rs5 = mysql_fetch_array($rows5)){
  ?>
      <tr>
        <td width="21%"  align="right" valign="middle">EXTERNAL CAUSE</td>
        <td width="9%"  valign="middle"><input name="dt_icd10_externala<?=$r?>" type="text" id="dt_icd10_externala<?=$r?>" onkeypress="searchSuggest9(this.value,3,'<?=$r?>');"  onkeydown="if(event.keyCode == 40&amp;&amp;document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }" size="8" value="<?=$rs5['icd10']?>" /></td>
        <td width="70%"  valign="middle"><input name="dt_diag_externala<?=$r?>" type="text" id="dt_diag_externala<?=$r?>" onkeypress="searchSuggest9(this.value,2,'<?=$r?>');" size="40" value="<?=$rs5['diag']?>" />
        <input name="external<?=$r?>" type="hidden" value="<?=$rs5['row_id']?>" />
        <input name="thaiexternal<?=$r?>" type="hidden" value="<?=$rs5['diag_thai']?>"/></td>
        </tr>
      <?
	$r++;
  }
  $r=0;
	?>
    </table></td>
  </tr>
  <!--<TR>
	<TD align="right" >PRINCIPLE DX
	<?php //print $head_diag_ex91;
//print $head_diag_ex92;?></TD>
	<TD><?php //print "<input type='text' name='diag' size='30' value='$cDiag$list_diag'>";?></TD>
	<TD width="214" align="right" >รหัส ICD10 โรคหลัก</TD>
	<TD width="26"><?php //print "<input type='text' name='icd10' size='10' value='$cIcd10'>";?></TD>
</TR>
<TR>
	<TD align="right" >CO-MORBIDITY </TD>
	<TD><?php //print "<input type='text' name='diag_morbidity' size='30' value='$cDiag_morbidity'>";?></TD>
	<TD align="right" >รหัส ICD10 โรครอง</TD>
	<TD><?php //print "<input type='text' name='icd101' size='10' value='$cIcd101'>";?></TD>
</TR>
<TR>
	<TD align="right" >COMPLICATION </TD>
	<TD><?php //print "<input type='text' name='diag_complication' size='30' value='$cDiag_complication'>";?></TD>
	<TD align="right" >รหัส ICD10 โรคแทรก</TD>
	<TD><?php //print "<input type='text' name='icd10_complication' size='10' value='$cIcd10_complication'>";?></TD>
</TR>
<TR>
	<TD align="right" >OTHER </TD>
	<TD><?php //print "<input type='text' name='diag_other' size='30' value='$cDiag_other'>";?></TD>
	<TD align="right" >รหัส ICD10 โรคอื่นๆ</TD>
	<TD><?php //print "<input type='text' name='icd10_other' size='10' value='$cIcd10_other'>";?></TD>
</TR>
<TR>
	<TD align="right" >EXTERNAL CAUSE </TD>
	<TD><?php //print "<input type='text' name='diag_external' size='30' value='$CExternal_cause'>";?></TD>
	<TD align="right" >รหัส ICD10 สาเหตุภายนอก</TD>
	<TD><?php //print "<input type='text' name='icd10_external' size='10' value='$cIcd10_external_cause'>";?></TD>
</TR>-->
<TR>
	<TD colspan="5" align="center" ><?php //print "<input type='text' name='icd9cm' size='30' value='$cIcd9cm'>";?><hr />
	  <strong>:
	  ICD9CM :</strong>
	  <table width="100%" border="0">
	    <tr>
	      <td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
	        <tr>
	          <td colspan="3" align="center"></td>
	          </tr>
	        <tr>
	          <td colspan="3" align="center"></td>
	          </tr>
	        <tr>
	          <td colspan="2"><!--******************************************* -->
	            <? 
$test6="SELECT * FROM  opicd9cm WHERE hn='$cHn' and svdate like '$date1%' and vn='".$_GET["cVn"]."' and status='Y' ";
$rows6= mysql_query($test6) or die("Query failed icd10"); 
?>
	<table width="100%">
<? 
	  $a=0;
	  while($rs6 = mysql_fetch_array($rows6)){
		  
	$text="select * from icd9cm where code='".$rs6['icd9cm']."'";
	$result7= mysql_query($text) or die("Query failed icd10/7"); 
	$rs7 = mysql_fetch_array($result7);
	
	?>
	              <tr>
	                <td width="29%"  align="right" valign="middle">ICD9CM:</td>
	                <td width="10%"  valign="middle"><input name="icd9cma<?=$a?>" type="text" id="icd9cma<?=$a?>" onkeypress="searchSuggest10(this.value,3,'<?=$a?>');" value="<?=$rs6['icd9cm']?>" size="8" onkeydown="if(event.keyCode == 40 &amp;&amp;document.getElementById('list1').innerHTML != ''){document.getElementById('choice2').focus();document.getElementById('choice2').checked=true;return false; }" /></td>
	                <td width="61%"  valign="middle"><input name="icd9cmdetaila<?=$a?>" type="text" id="icd9cmdetaila<?=$a?>" size="40" value="<?=$rs7['detail']?>" />
                    <input name="icd9<?=$a?>" type="hidden" value="<?=$rs6['row_id']?>" /></td>
	                </tr>
	              <?
	$a++;
	 }
	 $a=0;
	 ?>
	              </table>
	           
	            <!--******************************************* --></td>
	          </tr>
	        </table></td>
        </tr>
    </table></TD>
  </TR>
</TABLE>
<?php
//print "<CENTER><input type='submit' value='      &#3605;&#3585;&#3621;&#3591;      ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "<input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></p>";
//print "<INPUT TYPE=\"hidden\" Name=\"Tdate\" Value=\"".$sTdatehn."\">";
//print "<INPUT TYPE=\"hidden\" Name=\"cTdate\" Value=\"".$cTdate."\">";//วันที่มารับบริการกับเวลาที่ลงข้อมูล
//print "<INPUT TYPE=\"hidden\" Name=\"cVn\" Value=\"".$_GET["cVn"]."\"></CENTER>";
//print "</form>";
print "</body>";
include("unconnect.inc");
?>

    