<?php
session_start();


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</TITLE>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('nonconf_date'));

};

</script>
</HEAD>

<BODY>

<?php
//		include("includes/menu2.in.php");
		include("connect.inc");


		$sendfile = "ncf2_edit2.php";
		$hidden = "";
		$date_now = (date("Y")+543).date("-m-d");
		$nonconf_time1 = date("H");
		$nonconf_time2 = date("i");
	

		$arr_edit["send_by"] = $_SESSION["firstname_now"];
		
		
		$sqlselect="SELECT * FROM `ncr2556` WHERE nonconf_id ='".$_GET['nonconf_id']."'";
		$txtquery=mysql_query($sqlselect);
		$arr_edit=mysql_fetch_array($txtquery);

?>
<!--<SCRIPT LANGUAGE="JavaScript">

	function clinicandnon(xxx){
		
		for(i=0;i<document.f1.clinic.length;i++){
			
			document.f1.clinic[i].checked = false;

		}

		for(i=0;i<document.f1.nonclinic.length;i++){
			
			document.f1.nonclinic[i].checked = false;

		}

		xxx.checked = true;

	}

</SCRIPT>-->
<SCRIPT LANGUAGE="JavaScript">
<!--
function CheckForm(){
	
	var ff = document.f1;

if(document.getElementById('free_event').checked==false){

	if(ff.until.value==""){
		alert("��س����͡ ˹��§ҹ �ͧ��ҹ");
		ff.until.focus();
		return false;
	
	
	}else if(
		ff.topic1_1.checked == false && ff.topic1_2.checked == false && ff.topic1_3.checked == false && ff.topic1_4.checked == false && ff.topic1_5.checked == false && ff.topic1_6.checked == false  && ff.topic1_7.value.length == 0 && ff.topic2_1.checked == false && ff.topic2_2.checked == false && ff.topic2_3.checked == false && ff.topic2_4.checked == false && ff.topic2_5.checked == false && ff.topic2_6.checked == false && ff.topic2_7.value.length == 0 && ff.topic3_1.checked == false && ff.topic3_2.checked == false && ff.topic3_3.checked == false && ff.topic3_4.value.length == 0 && ff.topic4_1.checked == false && ff.topic4_2.checked == false && ff.topic4_3.checked == false && ff.topic4_4.checked == false && ff.topic4_5.checked == false && ff.topic4_6.value.length == 0 && ff.topic5_1.checked == false && ff.topic5_2.checked == false && ff.topic5_3.checked == false && ff.topic5_4.checked == false && ff.topic5_5.checked == false && ff.topic5_6.checked == false && ff.topic5_7.checked == false && ff.topic5_8.checked == false && ff.topic5_9.checked == false && ff.topic5_10.checked == false && ff.topic5_11.value.length == 0 && ff.topic6_1.checked == false && ff.topic6_2.checked == false && ff.topic6_3.checked == false && ff.topic6_4.checked == false && ff.topic6_5.value.length == 0 && ff.topic7_1.checked == false && ff.topic7_2.checked == false && ff.topic7_3.checked == false && ff.topic7_4.checked == false && ff.topic7_5.checked == false && ff.topic7_6.checked == false  && ff.topic7_7.value.length == 0 && ff.topic8_1.checked == false && ff.topic8_2.checked == false && ff.topic8_3.checked == false && ff.topic8_4.checked == false && ff.topic8_5.checked == false && ff.topic8_6.checked == false && ff.topic8_7.checked == false && ff.topic8_8.checked == false && ff.topic8_9.checked == false && ff.topic8_10.checked == false && ff.topic8_11.value.length == 0
		){
		alert("��س����͡��¡�÷���ͧ�����");
		return false;
	}else if(ff.clinic1.checked == false && ff.clinic2.checked == false && ff.clinic3.checked == false && ff.clinic4.checked == false && ff.clinic5.checked == false && ff.clinic6.checked == false && ff.clinic7.checked == false && ff.clinic8.checked == false && ff.clinic9.checked == false ){
		alert('��س����͡�����ع�ç');
		return false;	
	}else if(ff.risk1.checked == false && ff.risk2.checked == false && ff.risk3.checked == false && ff.risk4.checked == false && ff.risk5.checked == false && ff.risk6.checked == false && ff.risk7.checked == false && ff.risk8.checked == false && ff.risk9.checked == false ){
		alert('��س����͡��Դ�ͧ��������§');
		return false;	
	}else if(ff.head_name.value==""){
		alert("��سҡ�͡�������˹�� ");
		ff.head_name.focus();
		return false;
	}else{
		return true;
	}
	
}else{
	return true;
}

}

//-->
</SCRIPT>

<script type='text/javascript'>
	function clearRdo(){
		tag =document.getElementsByName('event');
		for(i=0;i<tag.length;i++){
			if(tag[i].id=='event'){
				tag[i].checked= false;
			}
		}
	}
function clearChecks(radioName) {
    var radio = document.f1[radioName]
    for(x=0;x<radio.length;x++) {
        document.f1[radioName][x].checked = false
    }
}

</script>
<FORM Name="f1" METHOD='post' POST ACTION="<?php echo $sendfile;?>" Onsubmit="return CheckForm();" target="_blank">

<TABLE align="center" border="1" bordercolor="#3366FF">
<TR>
	<TD bgcolor="#3366FF" align="center">
		<FONT SIZE="1" COLOR="#FFFFFF"><B>�ѹ�֡��§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ ( Non - Conforming Report )</B></FONT>
	</TD>
</TR>
<TR>
  <TD bgcolor="#3366FF" align="center"><FONT SIZE="1" COLOR="#FFFFFF">�ٹ��Ѳ�Ҥس�Ҿ �͡��������Ţ FR-QMR -009/1 ,06, 3 �.�. 56</FONT></TD>
</TR>
<TR>
	<TD>
<TABLE border="0" width="800">
<TR valign="top">
  <TD>
    <TABLE bgcolor="#FFCAB0" height="115" width="98%">
      <TR>
        <TD>
          �Ţ��� NCR : <INPUT TYPE="text" NAME="ncr" size="10" value="<?=$arr_edit["ncr"];?>"><BR>
          ˹��§ҹ / ��� : <SELECT NAME="until">
            <Option value="">--------------</Option>
            <?php
										$sql="SELECT * FROM `departments` where status='y' ";
										$query=mysql_query($sql);
										while($arr=mysql_fetch_array($query)){
											
											if($arr_edit["until"]==$arr['code']){
											echo "<option value='$arr[code]' selected>$arr[name]</option> ";
											}else{
											echo "<option value='$arr[code]' >$arr[name]</option> ";	
											}
										}
									?>
            </SELECT>
          
          <BR>
          �ѹ��� : <INPUT ID="nonconf_date" TYPE="text" NAME="nonconf_date" size="10" value="<?=$arr_edit["nonconf_date"];?>" readonly>&nbsp;
          
          ���� : <INPUT TYPE="hidden" name="nonconf_time">
          <?
		  $timea=substr($arr_edit["nonconf_time"],0,5);
		  $timeb=explode(':',$timea);
		 
		  
		  ?>
          <SELECT NAME="nonconf_time1">
            <?php 
				
				
				
				
			
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($timeb[0] == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
            </SELECT>:
          <SELECT NAME="nonconf_time2">
            <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($timeb[1] == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
            </SELECT>
          
          <br>
  <!--<strong>�ѹ�֡��§ҹ</strong> <br>

		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="�˵ء�ó��Ӥѭ" <?//php if($arr_edit["type"] == "�˵ء�ó��Ӥѭ") echo " Checked ";?>>&nbsp;�˵ء�ó��Ӥѭ<br>
		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="�غѵԡ�ó�" <?//php if($arr_edit["type"] == "�غѵԡ�ó�") echo " Checked ";?>>&nbsp;�غѵԡ�ó�<br>
		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="��������ʹ���ͧ" <?//php if($arr_edit["type"] == "��������ʹ���ͧ") echo " Checked ";?>>&nbsp;��������ʹ���ͧ<br>-->��͹�����§ҹ: 
        <? if($arr_edit["nonconf_dategroup"]==""){ 
			$arr_edit["nonconf_dategroup"]=(date("Y")+543).date("-m");
			}else{
			$arr_edit["nonconf_dategroup"]=$arr_edit["nonconf_dategroup"];
		}
		?>
          <INPUT ID="nonconf_dategroup" TYPE="text" NAME="nonconf_dategroup" size="10" value="<?=$arr_edit["nonconf_dategroup"];?>">
          </TD>
        </TR>
      </TABLE>
    </TD>
  <TD colspan="2">
    <TABLE  height="115" width="100%" bgcolor="#FFCAB0">
      <TR  valign="top">
        <TD><B>�����</B></TD>
        <TD>
          <INPUT TYPE="radio" NAME="come_from_id" value="1"  <?php if($arr_edit["come_from_id"] == "1") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;ENV ROUND<BR>
          <INPUT TYPE="radio" NAME="come_from_id" value="2"  <?php if($arr_edit["come_from_id"] == "2") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;IC ROUND<BR>
          <INPUT TYPE="radio" NAME="come_from_id" value="3"  <?php if($arr_edit["come_from_id"] == "3") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;RM ROUND<BR>
          
          </TD>
        <TD>
          <INPUT TYPE="radio" NAME="come_from_id" value="4"  <?php if($arr_edit["come_from_id"] == "4") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;12 �Ԩ�������ǹ<BR>
          <INPUT TYPE="radio" NAME="come_from_id" value="5"  <?php if($arr_edit["come_from_id"] == "5") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;˹�����§ҹ�ͧ<BR>
          <INPUT TYPE="radio" NAME="come_from_id" value="6"  <?php if($arr_edit["come_from_id"] == "6") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='';}">&nbsp;����&nbsp;&nbsp;<INPUT TYPE="text" id="come_from_detail"NAME="come_from_detail" value="<?php echo $arr_edit["come_from_detail"];?>" style="display:none"><BR>
          </TD>
        </TR>
      </TABLE>
    
    </TD>
</TR>
<TR valign="top">
  <TD colspan="3" bgcolor="#CCCCCC" ><strong style="font-weight:bold;">�˵ء�ó� (��������ͧ���¶١㹪�ͧ�����������ء��ͷ���Դ�������͸Ժ���˵ء�ó����Դ���)</strong></TD>
</TR>
<TR valign="top">
  <TD colspan="3" bgcolor="#CCCCCC" ><strong style="font-weight:bold;">Sentinel Event ����ͧ��§ҹ��ǹ���� 6 ������� ��� ��.þ.����� ���� ����Ѵ��ä�������§</strong></TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="1" <?php if($arr_edit["event"] == "1") echo " Checked ";?>>
    1.���������ª��Ե�ҡ��æ�ҵ�ǵ��</TD>
  <TD colspan="2" bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="6" <?php if($arr_edit["event"] == "6") echo " Checked ";?>>
    6.���������Ѻ�š�з����ͤ�����������Ҩ�֧�ԡ���������ª��Ե �ѹ���˵ؤ��������ͧ�ͧ�ػ�ó�/����ͧ��ͷҧ���ᾷ�� ����֧�ҡ�ؤ�ҡ÷ҧ���ᾷ��/��кǹ����ѡ����ç��Һ�� </TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="2" <?php if($arr_edit["event"] == "2") echo " Checked ";?>>
  2.������ª��Ե�ҡ���������ʹ�Դ���� �Դ��</TD>
  <TD colspan="2" bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="7" <?php if($arr_edit["event"] == "7") echo " Checked ";?>> 
  7.�������觢ͧ/�ػ�ó쵡��ҧ�������ҧ��¼�����
</TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="3" <?php if($arr_edit["event"] == "3") echo " Checked ";?>> 
    3.���������ª��Ե����������ǡѺ��ô��Թ�ͧ�ä���͡���纻���㹢�й��
</TD>
  <TD colspan="2" bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="8" <?php if($arr_edit["event"] == "8") echo " Checked ";?>> 
    8.��÷�������ҧ���/����׹������ǧ�Թ�ҧ��/�ҵ������ç��Һ��
</TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="4" <?php if($arr_edit["event"] == "4") echo " Checked ";?>> 
    4.��ü�ҵѴ�Դ���˹� / �Դ������ / ��ҵѴ�Դ��
</TD>
  <TD colspan="2" bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="9" <?php if($arr_edit["event"] == "9") echo " Checked ";?>> 
    9.����ѡ�ҵ�Ƿ�á/������ͺ��á�Դ��ͺ����</TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="5" <?php if($arr_edit["event"] == "5") echo " Checked ";?>> 
    5.�������٭����˹�ҷ���÷ӧҹ�ͧ��ҧ��������շؾ��Ҿ���ҧ�������������Ǣ�ͧ�Ѻ��ô��Թ�ͧ�ä���͡���纻���㹢�й��
</TD>
  <TD colspan="2" bgcolor="#FFCAB0"><a href="javascript:clearChecks('event')">clear</a>
    �������� <strong style="font-weight:bold;">Sentinel Event</strong></TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0">&nbsp;</TD>
  <TD colspan="2" bgcolor="#FFCAB0">&nbsp;</TD>
</TR>
<TR  valign="top">
  <TD valign="top">
    <TABLE bgcolor="#FFCAB0" width='100%'>
      <TR>
        <TD>
          <B>1. ������ʹ��� / ��/ ˡ���</B><BR>
          <INPUT TYPE="checkbox" NAME="topic1_1" value="1" <?php if($arr_edit["topic1_1"] == "1") echo " Checked ";?>> 1. ���<BR>
          <INPUT TYPE="checkbox" NAME="topic1_2" value="1" <?php if($arr_edit["topic1_2"] == "1") echo " Checked ";?>> 2. ����ҹ͹���躹���<BR>
          <INPUT TYPE="checkbox" NAME="topic1_3" value="1" <?php if($arr_edit["topic1_3"] == "1") echo " Checked ";?>> 3. ���ҡ��§/������/���<BR>
          <INPUT TYPE="checkbox" NAME="topic1_4" value="1" <?php if($arr_edit["topic1_4"] == "1") echo " Checked ";?>> 4. ����ͧ�Ѵ��֧��ش<BR>
          <INPUT TYPE="checkbox" NAME="topic1_5" value="1" <?php if($arr_edit["topic1_5"] == "1") echo " Checked ";?>> 5. �չ�����������§<BR>
          <INPUT TYPE="checkbox" NAME="topic1_6" value="1" <?php if($arr_edit["topic1_6"] == "1") echo " Checked ";?>> 
          6. ��Ѵ�������ҧ�������͹����<BR>
          
          <TABLE cellpadding="0" cellspacing="0">
            <TR valign="top">
              <TD>&nbsp;&nbsp;</TD>
              <TD><TEXTAREA NAME="topic1_7" ROWS="4" COLS="21" ><?php echo $arr_edit["topic1_7"];?></TEXTAREA></TD>
              </TR>
            </TABLE>
          </TD>
        </TR>
      </TABLE><BR>
  <TABLE bgcolor="#FFCAB0" width='100%'>
  <TR>
    <TD>
      <B>2. ��õԴ����������</B><BR>
      <INPUT TYPE="checkbox" NAME="topic2_1" value="1" <?php if($arr_edit["topic2_1"] == "1") echo " Checked ";?>> 1. �������§ҹ�� Lab/Film X-ray ��ǹ<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���� �Դ����<BR>
      <INPUT TYPE="checkbox" NAME="topic2_2" value="1" <?php if($arr_edit["topic2_2"] == "1") echo " Checked ";?>> 2. �������§ҹᾷ��/ᾷ�����ͺ<BR>
      <INPUT TYPE="checkbox" NAME="topic2_3" value="1" <?php if($arr_edit["topic2_3"] == "1") echo " Checked ";?>> 3. ��Ժѵ����١��ͧ��������<BR>
      <INPUT TYPE="checkbox" NAME="topic2_4" value="1" <?php if($arr_edit["topic2_4"] == "1") echo " Checked ";?>> 4. �Ǫ����¹�������ó�<BR>
      <INPUT TYPE="checkbox" NAME="topic2_5" value="1" <?php if($arr_edit["topic2_5"] == "1") echo " Checked ";?>> 5. ��Թ������ç�Ѻ�ѵ����<BR>
      <INPUT TYPE="checkbox" NAME="topic2_6" value="1" <?php if($arr_edit["topic2_6"] == "1") echo " Checked ";?>> 6. ���ѵ�������������Թ���<BR>
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic2_7" ROWS="4" COLS="21" ><?php echo $arr_edit["topic2_7"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
  <BR>
  <TABLE bgcolor="#FFCAB0" width='100%' height="236">
  <TR>
    <TD valign="top">
      <B>3. ���ʹ</B><BR>
      <INPUT TYPE="checkbox" NAME="topic3_1" value="1" <?php if($arr_edit["topic3_1"] == "1") echo " Checked ";?> > 1. �Դ��<BR>
      <INPUT TYPE="checkbox" NAME="topic3_2" value="1" <?php if($arr_edit["topic3_2"] == "1") echo " Checked ";?> > 2. �����á��͹�ҡ���������ʹ<BR>
      <INPUT TYPE="checkbox" NAME="topic3_3" value="1" <?php if($arr_edit["topic3_3"] == "1") echo " Checked ";?> > 3. �����ʹ<BR>
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic3_4" ROWS="4" COLS="21" ><?php echo $arr_edit["topic3_4"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
    
    </TD>
  <TD>
  <TABLE bgcolor="#FFCAB0" width='100%'>
  <TR>
    <TD>
      <B>4. ����ͧ���</B><BR>
      
  <INPUT TYPE="checkbox" NAME="topic4_1" value="1" <?php if($arr_edit["topic4_1"] == "1") echo " Checked ";?> >  1.�����¶١�ǡ / ����<BR>
  <INPUT TYPE="checkbox" NAME="topic4_2" value="1" <?php if($arr_edit["topic4_2"] == "1") echo " Checked ";?> >  2.����������<BR>
  <INPUT TYPE="checkbox" NAME="topic4_3" value="1" <?php if($arr_edit["topic4_3"] == "1") echo " Checked ";?> >  3.���ӧҹ / �ӧҹ�Դ����<BR>
  <INPUT TYPE="checkbox" NAME="topic4_4" value="1" <?php if($arr_edit["topic4_4"] == "1") echo " Checked ";?> >  4.���������ͧ��� ��<BR>
  <INPUT TYPE="checkbox" NAME="topic4_5" value="1" <?php if($arr_edit["topic4_5"] == "1") echo " Checked ";?> >  5.�Կ�����ӧҹ<BR>
      
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic4_6" ROWS="4" COLS="21" ><?php echo $arr_edit["topic4_6"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE><BR>
  <TABLE bgcolor="#FFCAB0" width='100%'>
  <TR>
    <TD>
      <B>5. ����ԹԨ��� / �ѡ��</B><BR>
      <INPUT TYPE="checkbox" NAME="topic5_1" value="1" <?php if($arr_edit["topic5_1"] == "1") echo " Checked ";?>> 1. �Ѻ Admit ������ä����  7 �ѹ<BR>
      <INPUT TYPE="checkbox" NAME="topic5_2" value="1" <?php if($arr_edit["topic5_2"] == "1") echo " Checked ";?>> 2. �������ö�ԹԨ����ä����ͧ admit  ������ ER ���<BR>
      <INPUT TYPE="checkbox" NAME="topic5_3" value="1" <?php if($arr_edit["topic5_3"] == "1") echo " Checked ";?>> 3. ��ҹ����硫�����Դ<BR>
      <INPUT TYPE="checkbox" NAME="topic5_4" value="1" <?php if($arr_edit["topic5_4"] == "1") echo " Checked ";?>> 4. ��Ҫ��㹡���ѡ�Ҽ����·���شŧ<BR>
      <INPUT TYPE="checkbox" NAME="topic5_5" value="1" <?php if($arr_edit["topic5_5"] == "1") echo " Checked ";?>> 5. �����á��͹�ҡ�ѵ����<BR>
      <INPUT TYPE="checkbox" NAME="topic5_6" value="1" <?php if($arr_edit["topic5_6"] == "1") echo " Checked ";?>> 6. �� Diag  Proc ����������Ἱ<BR>
      <INPUT TYPE="checkbox" NAME="topic5_7" value="1" <?php if($arr_edit["topic5_7"] == "1") echo " Checked ";?>> 7. ���������ѧ�����§��<BR>
      <INPUT TYPE="checkbox" NAME="topic5_8" value="1" <?php if($arr_edit["topic5_8"] == "1") echo " Checked ";?>> 8. ��� Cath / Tube / Drain ���١<BR>
      <INPUT TYPE="checkbox" NAME="topic5_9" value="1" <?php if($arr_edit["topic5_9"] == "1") echo " Checked ";?>> 9. ���� Cath / Tube / Drain <BR>
      <INPUT TYPE="checkbox" NAME="topic5_10" value="1" <?php if($arr_edit["topic5_10"] == "1") echo " Checked ";?>> 10. ���¼�������� ICU �������Ἱ<BR>
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic5_11" ROWS="4" COLS="21" ><?php echo $arr_edit["topic5_11"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
  <BR>
  <TABLE bgcolor="#FFCAB0" width='100%'>
  <TR>
    <TD>
      <B>6. ��ä�ʹ</B><BR>
      <INPUT TYPE="checkbox" NAME="topic6_1" value="1" <?php if($arr_edit["topic6_1"] == "1") echo " Checked ";?>> 1. ��辺 Fetal distress �ѹ��ǧ��<BR>
      <INPUT TYPE="checkbox" NAME="topic6_2" value="1" <?php if($arr_edit["topic6_2"] == "1") echo " Checked ";?>> 2. ��ҵѴ��ʹ����Թ�<BR>
      <INPUT TYPE="checkbox" NAME="topic6_3" value="1" <?php if($arr_edit["topic6_3"] == "1") echo " Checked ";?>> 3. �����á��͹�ҡ��ä�ʹ<BR>
      <INPUT TYPE="checkbox" NAME="topic6_4" value="1" <?php if($arr_edit["topic6_4"] == "1") echo " Checked ";?>> 4. �Ҵ�纨ҡ��ä�ʹ<BR>
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic6_5" ROWS="4" COLS="21" ><?php echo $arr_edit["topic6_5"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
    </TD>
  <TD>
    
  <TABLE bgcolor="#FFCAB0" width='100%'>
    <TR>
      <TD>
        <B>7. ��ü�ҵѴ / ���ѭ��</B><BR>
        <INPUT TYPE="checkbox" NAME="topic7_1" value="1" <?php if($arr_edit["topic7_1"] == "1") echo " Checked ";?>> 1. �����á��͹�ҧ���ѭ��<BR>
        <INPUT TYPE="checkbox" NAME="topic7_2" value="1" <?php if($arr_edit["topic7_2"] == "1") echo " Checked ";?>> 2. ��ҵѴ�Դ�� / �Դ��ҧ / �Դ���˹�<BR>
        <INPUT TYPE="checkbox" NAME="topic7_3" value="1" <?php if($arr_edit["topic7_3"] == "1") echo " Checked ";?>> 3. �Ѵ�������͡��������ҧἹ<BR>
        <INPUT TYPE="checkbox" NAME="topic7_4" value="1" <?php if($arr_edit["topic7_4"] == "1") echo " Checked ";?>> 4. ��纫��������з��Ҵ��<BR>
        <INPUT TYPE="checkbox" NAME="topic7_5" value="1" <?php if($arr_edit["topic7_5"] == "1") echo " Checked ";?>> 5. �������ͧ��� / ���� ���㹼�����<BR>
        <INPUT TYPE="checkbox" NAME="topic7_6" value="1" <?php if($arr_edit["topic7_6"] == "1") echo " Checked ";?>> 6. ��Ѻ�Ҽ�ҵѴ���<BR>
        <TABLE cellpadding="0" cellspacing="0">
          <TR valign="top">
            <TD>&nbsp;&nbsp;</TD>
            <TD><TEXTAREA NAME="topic7_7" ROWS="4" COLS="21" ><?php echo $arr_edit["topic7_7"];?></TEXTAREA></TD>
            </TR>
          </TABLE>
  </TD>
      </TR>
    </TABLE>
    <BR>
    
    <TABLE bgcolor="#FFCAB0" width='100%'>
      <TR>
        <TD>
          <B>8. ��� �</B><BR>
          <INPUT TYPE="checkbox" NAME="topic8_1" value="1" <?php if($arr_edit["topic8_1"] == "1") echo " Checked ";?>> 1. ������ / �ҵ� ���֧���<BR>
          <INPUT TYPE="checkbox" NAME="topic8_2" value="1" <?php if($arr_edit["topic8_2"] == "1") echo " Checked ";?>> 2. �����Ѥ������ þ.<BR>
          <INPUT TYPE="checkbox" NAME="topic8_3" value="1" <?php if($arr_edit["topic8_3"] == "1") echo " Checked ";?>> 3. �ա�÷�������ҧ��� ������ / �ҵ� /  ���˹�ҷ��<BR>
          <INPUT TYPE="checkbox" NAME="topic8_4" value="1" <?php if($arr_edit["topic8_4"] == "1") echo " Checked ";?>> 4. �����¾�������ҵ�ǵ�� / ��������ҧ��µ���ͧ<BR>
          <INPUT TYPE="checkbox" NAME="topic8_5" value="1" <?php if($arr_edit["topic8_5"] == "1") echo " Checked ";?>> 5. �á��� / �ѡ����<BR>
          <INPUT TYPE="checkbox" NAME="topic8_6" value="1" <?php if($arr_edit["topic8_6"] == "1") echo " Checked ";?>> 6. ��äء��� / ������<BR>
          <INPUT TYPE="checkbox" NAME="topic8_7" value="1" <?php if($arr_edit["topic8_7"] == "1") echo " Checked ";?>> 7. ����Ǵ�������ѹ���� / �����͹<BR>
          <INPUT TYPE="checkbox" NAME="topic8_8" value="1" <?php if($arr_edit["topic8_8"] == "1") echo " Checked ";?>> 8. �غѵ��˵������<BR>
          <INPUT TYPE="checkbox" NAME="topic8_9" value="1" <?php if($arr_edit["topic8_9"] == "1") echo " Checked ";?>> 9. ���. �Ҵ�纨ҡ��÷ӧҹ <BR>
          <INPUT TYPE="checkbox" NAME="topic8_10" value="1" <?php if($arr_edit["topic8_10"] == "1") echo " Checked ";?>> 10. ��������¡�纤�������<BR>
          <TABLE cellpadding="0" cellspacing="0">
            <TR valign="top">
              <TD>&nbsp;&nbsp;</TD>
              <TD><TEXTAREA NAME="topic8_11" ROWS="4" COLS="21" ><?php echo $arr_edit["topic8_11"];?></TEXTAREA></TD>
              </TR>
            </TABLE>
          
  </TD>
        </TR>
      </TABLE>
    
    <BR>
    
    <!-- <TABLE bgcolor="#FFCAB0" width='100%'>
	<TR>
		<TD>
	<B>9. ��� �</B><BR>
		
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><TEXTAREA NAME="topic9_1" ROWS="4" COLS="21" ><?php //echo $arr_edit["topic9_1"];?></TEXTAREA></TD>
		</TR>
		</TABLE>

</TD>
	</TR>
	</TABLE> -->
    
    </TD>
</TR>
<!--<TR>
	<TD bgcolor="#FFCAB0">-->
		<!--<B>�����ҵԢͧ��úҴ��</B><BR>
		<INPUT TYPE="radio" NAME="type_injured" value="1" <?//php if($arr_edit["type_injured"] == "1") echo " Checked ";?> > 1.  ��д١��С��������<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="2" <?//php if($arr_edit["type_injured"] == "2") echo " Checked ";?> > 2. ���˹ѧ<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="3" <?//php if($arr_edit["type_injured"] == "3") echo " Checked ";?> > 3. ����ҷ��ǹ��ҧ<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="4" <?//php if($arr_edit["type_injured"] == "4") echo " Checked ";?> > 4. ������лʹ-->
	<!--</TD>
	<TD bgcolor="#FFCAB0">-->
		<!--<B>�ѹ�֡��Ǫ����¹</B> <INPUT TYPE="radio" NAME="save_in_medical_record" value="1" <?//php if($arr_edit["save_in_medical_record"] == "1") echo " Checked ";?> > �� &nbsp;&nbsp;&nbsp;&nbsp; <INPUT TYPE="radio" NAME="save_in_medical_record" value="0" <?//php if($arr_edit["save_in_medical_record"] == "0") echo " Checked ";?> > ����<BR>
		��§ҹᾷ�� : <BR>&nbsp;&nbsp;<TEXTAREA NAME="tell_doctor" ROWS="4" COLS="21"><?//php echo $arr_edit["tell_doctor"];?></TEXTAREA>-->
	<!--</TD>
	<TD bgcolor="#FFCAB0">-->
		<!--ᾷ��������Թ : <INPUT TYPE="text" NAME="estimate_doctor" value="<?//php echo $arr_edit["estimate_doctor"];?>"><BR>
		�š�û����Թ<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="1" <?//php if($arr_edit["estimate_result"] == "1") echo " Checked ";?> >&nbsp;����ա�úҴ��<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="2" <?//php if($arr_edit["estimate_result"] == "2") echo " Checked ";?> >&nbsp;�����繡�úҴ�纪Ѵਹ<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="3" <?//php if($arr_edit["estimate_result"] == "3") echo " Checked ";?> >&nbsp;��ͧ���� þ. �ҹ���<BR>-->
<!--	</TD>
</TR>-->
<TR valign="top">
	<TD colspan="3"  bgcolor="#FFCAB0">
		<B>��������ػ�˵ء�ó�</B> : <BR>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME="sum_up" ROWS="6" COLS="60"><?php echo $arr_edit["sum_up"];?></TEXTAREA>
	</TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><TABLE width="100%" border='1' bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
    <TR>
      <TD colspan="3"><B>�����ع�ç</B></TD>
    </TR>
    <TR>
      <TD><input type="radio" Name="clinic"   id="clinic1" value="A" <?php if($arr_edit["clinic"] == "A") echo " Checked ";?>>
        &nbsp;A ���˵ء�ó������͡�ʷ��������Դ������Ҵ����͹ �����Ҩ�Դ����˹��§ҹ ���ѧ����Դ<br>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic2"  value="B" <?php if($arr_edit["clinic"] == "B") echo " Checked ";?>>
        &nbsp;B  �Դ������Ҵ����͹��� ������֧������/þ./���˹�ҷ�� ����ѧ����դ�����������</TD>
      <td width="10%" align="center" valign="top" class="fonttable">�дѺ 1<br />
        ��ͺ��Ҵ <br /></td>
      <TD rowspan="3" align="center"> ����§ҹ�ٹ��Ѳ�Ҥس�Ҿ </TD>
    </TR>
    <TR>
      <TD><INPUT TYPE="radio" NAME="clinic" id="clinic3"  value="C" <?php if($arr_edit["clinic"] == "C") echo " Checked ";?>>
        &nbsp;C  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� ��������Ѻ�ѹ�����������������ª������§ ��Ѿ���Թ���������硹��� ��Ť������Թ 2,000 �ҷ</TD>
      <td align="center" class="fonttable">�дѺ 2<br />
        ����</td>
      </TR>
    <TR>
      <TD valign="top"><INPUT TYPE="radio" NAME="clinic"  id="clinic4" value="D" <?php if($arr_edit["clinic"] == "D") echo " Checked ";?>>
        &nbsp;D  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� ��觵�ͧ������ѧ / �Դ���������� �������§�Ҿ����������� �Դ�����������ҧ㨨ҡ��������Ф�������дǡ����Ѻ��ԡ�� ��Ѿ���Թ���������硹�����Ť�� 2,000 -5,000 �ҷ<BR>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic5" value="E" <?php if($arr_edit["clinic"] == "E") echo " Checked ";?>>
        &nbsp;E  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� �觼�����Դ�ѹ���ª��Ǥ�����е�ͧ�ա�úӺѴ�ѡ�� �Դ�����������ҧ� �ҡ����ѷ��Сѹ /˹��§ҹ�ͧ�Ѱ ��Ѿ���Թ��������ҡ���� 5,000 - 15,000 �ҷ <BR>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic6" value="F" <?php if($arr_edit["clinic"] == "F") echo " Checked ";?>>
        &nbsp;F  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� �觼�����Դ�ѹ���ª��Ǥ��� ��е�ͧ�͹�ç��Һ�����������ç��Һ�Źҹ��� �Դ�����������ҧ㨨ҡ����ѷ��Сѹ / ˹��§ҹ�ͧ�Ѱ ��ͧ��ش�ҹ�ҡ���� 3 �ѹ ��Ѿ���Թ��������ҡ���� 15,000 �ҷ������Թ 30,000 �ҷ</TD>
      <td align="center" class="fonttable">�дѺ 3 <br />
        �ҹ��ҧ</td>
      </TR>
    <TR>
      <TD  valign="top"><INPUT TYPE="radio" NAME="clinic"  id="clinic7" value="G" <?php if($arr_edit["clinic"] == "G") echo " Checked ";?>>
        &nbsp;G  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� �觼�����Դ�ѹ���¶��� ��Ѿ���Թ������� ����Ť���ҡ���� 30,000 �ҷ ������Թ 50,000 �ҷ �������§�Ҿ����������»�ҡ�������Ҹ�ó�<BR>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic8" value="H" <?php if($arr_edit["clinic"] == "H") echo " Checked ";?>>
        &nbsp;H  �Դ������Ҵ����͹�Ѻ������  /þ./���˹�ҷ�� �觼�����ͧ�ӡ�ê��ª��Ե ��úҴ��/�纻��¨ҡ�ҹ��дѺ�ع�ç ��Ѿ���Թ������� ����Ť���ҡ���� 50,000 ������Թ 100,000 �ҷ �������§�Ҿ����������»�ҡ�������Ҹ�ó�<BR>
        <INPUT TYPE="radio" NAME="clinic" id="clinic9"  value="I" <?php if($arr_edit["clinic"] == "I") echo " Checked ";?>>
        &nbsp;I   �Դ������Ҵ����͹�Ѻ������   /þ./���˹�ҷ��  ��������˵آͧ������ª��Ե ��Ѿ���Թ������� ����Ť���ҡ���� 100,000 �ҷ �������§�Ҿ����������»�ҡ�������Ҹ�ó�/�١��ͧ��ͧ���ͧ����ԪҪվ<BR></TD>
      <td align="center" class="fonttable">�дѺ 4 <br />
        �ҡ</td>
      <TD align="center">��§ҹ��ǹ���� 6 �������<BR>
        ��.þ�����, <BR>
        ����Ѵ��ä�������§</TD>
    </TR>
    <TR>
      <TD colspan="3" align="center"  valign="top"><a href="javascript:clearChecks('clinic')">clear</a></TD>
      </TR>
  </TABLE></TD>
</TR>
<TR valign="top">
	<TD colspan="3"  bgcolor="#FFCAB0">
		<B>�ѭ�ҷ�辺/���˵�</B> : <BR>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME="problem" ROWS="6" COLS="60"><?php echo $arr_edit["problem"];?></TEXTAREA>
	</TD>
</TR>
<TR valign="top">
	<TD colspan="3"  bgcolor="#FFCAB0">
		<B>�ҵá����䢷������Թ�������� / �ҵá�û�ͧ�ѹ</B> : <BR>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME="protect" ROWS="6" COLS="60"><?php echo $arr_edit["protect"];?></TEXTAREA>
	</TD>
</TR>

<TR>
  <TD colspan="3" bgcolor="#FFCAB0">&nbsp;</TD>
</TR>

<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><B>ŧ���� </B>
    <INPUT NAME="head_name" TYPE="text" value="<?php echo $arr_edit["head_name"];?>" size="40">
    ���˹��˹��§ҹ </TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0">&nbsp;</TD>
</TR>
<?
 if($_SESSION["statusncr"]=='admin'){
 ?>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><strong>���¤س�Ҿ</strong></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><input name="quality" type="radio" id="quality1" onClick="javaScript:if(this.checked){document.all.cpno.style.display='none';}" value="1" <?php if($arr_edit["quality"] == "1") echo " Checked ";?>>
    �Ң������������ 
      <input name="quality" type="radio" id="quality2" onClick="javaScript:if(this.checked){document.all.cpno.style.display='none';}" value="2" <?php if($arr_edit["quality"] == "2") echo " Checked ";?>>
�Դ����������ͧ��������ʹ���ͧ 
<input name="quality" type="radio" id="quality3" onClick="javaScript:if(this.checked){document.all.cpno.style.display='';}" value="3" <?php if($arr_edit["quality"] == "3") echo " Checked ";?>> 
�͡ CAR / PAR �Ţ��� 
<input type="text" name="cpno" id="cpno"  value="<?=$arr_edit["cpno"];?>"></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0">&nbsp;</TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><strong>��Դ�ͧ��������§</strong></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><table border="0">
    <tr>
      <td><input name="risk1" type="checkbox" id="risk1" value="1" <?php if($arr_edit["risk1"] == "1") echo " Checked ";?>> 
      1.Clinical Risk
</td>
      <td><input name="risk6" type="checkbox" id="risk6" value="1" <?php if($arr_edit["risk6"] == "1") echo " Checked ";?>> 
        6.Customer Complaint Risk
</td>
    </tr>
    <tr>
      <td><input name="risk2" type="checkbox" id="risk2" value="1" <?php if($arr_edit["risk2"] == "1") echo " Checked ";?>> 
        2.Infection control Risk
</td>
      <td><input name="risk7" type="checkbox" id="risk7" value="1" <?php if($arr_edit["risk7"] == "1") echo " Checked ";?>> 
        7.Financial Risk
</td>
    </tr>
    <tr>
      <td><input name="risk3" type="checkbox" id="risk3" value="1" <?php if($arr_edit["risk3"] == "1") echo " Checked ";?>> 
        3.Medication Risk
</td>
      <td><input name="risk8" type="checkbox" id="risk8" value="1" <?php if($arr_edit["risk8"] == "1") echo " Checked ";?>> 
        8.Utilization Management Risk
</td>
    </tr>
    <tr>
      <td><input name="risk4" type="checkbox" id="risk4" value="1" <?php if($arr_edit["risk4"] == "1") echo " Checked ";?>> 
        4.Medical Equipment Risk
</td>
      <td><input name="risk9" type="checkbox" id="risk9" value="1" <?php if($arr_edit["risk9"] == "1") echo " Checked ";?>> 
        9.Information Risk</td>
    </tr>
    <tr>
      <td><input name="risk5" type="checkbox" id="risk5" value="1" <?php if($arr_edit["risk5"] == "1") echo " Checked ";?>> 
        5.Safety and Environment Risk
</td>
      <td>&nbsp;</td>
    </tr>
    <? }?>
  </table></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><strong>Patient Safety Goal</strong></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><input name="pro_f" type="checkbox" id="pro_f" value="1" <?php if($arr_edit["pro_f"] == "1") echo " Checked ";?>>
    F 
      <input name="pro_b" type="checkbox" id="pro_b" value="1" <?php if($arr_edit["pro_b"] == "1") echo " Checked ";?>> 
      B 
      <input name="pro_i" type="checkbox" id="pro_i" value="1" <?php if($arr_edit["pro_i"] == "1") echo " Checked ";?>> 
      I 
      <input name="pro_t" type="checkbox" id="pro_t" value="1" <?php if($arr_edit["pro_t"] == "1") echo " Checked ";?>> 
      T 
      <input name="pro_s" type="checkbox" id="pro_s" value="1" <?php if($arr_edit["pro_s"] == "1") echo " Checked ";?>> 
      S
      <input name="pro_otherchk" type="checkbox" id="pro_otherchk" value="1" <?php if($arr_edit["pro_other"] != "") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.spName.style.display='';}else{ document.all.spName.style.display='none'; }">
      ���� <span id="spName" style="display:none;">�к�
      <input type="text" name="pro_other" id="pro_other" value="<?=$arr_edit["pro_other"];?>"></span></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><strong>ʶҹС���觡�Ѻ</strong></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><input name="return" type="checkbox" id="return" value="1" <?php if($arr_edit["return"] == "1") echo " Checked ";?>>
    ʶҹС���觡�Ѻ�ٹ��س�Ҿ</TD>
</TR>
<TR valign="top">
  <TD colspan="3" align="center"  bgcolor="#FFCAB0"><input name="free_event"   type="checkbox" id="free_event" value="1" <?php if($arr_edit["free_event"] == "1") echo " Checked ";?>>
    �ó� ��§ҹ�˵ء�ó� ����դ�������§,����դ����ع�ç</TD>
</TR>
<?
		if($_SESSION["statusncr"]=='admin'){
	  ?> 
<TR valign="top">
  <TD colspan="3" align="center"  bgcolor="#FFCAB0"><input name="accept" type="checkbox" id="accept" value="A" <?php if($arr_edit["accept"] == "A") echo " Checked ";?>>
    �׹�ѹ���������§ҹ�˵ء�ó��Ӥѭ�</TD>
</TR>
<? } ?>
<TR>
	<TD colspan="3" bgcolor="#FFCAB0"><!--<B>���ͼ����</B> <INPUT TYPE="text" NAME="send_by" value="<?//php echo $arr_edit["send_by"];?>">--></TD>
</TR>

<TR>
	<TD colspan="3" align="center"><INPUT TYPE="hidden" value="<?=$arr_edit["nonconf_id"];?>" name="nonconf_id"> <INPUT TYPE="submit" value="�ѹ�֡������"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" value="<?php echo $_SESSION["smenucode"];?>" name="menucode">
<INPUT TYPE="hidden" value="<?php  if(empty($_SESSION["Userncr"])){echo $_SESSION["sOfficer"];}else{echo $_SESSION["Namencr"];}?>" name="officer">
<?php
	echo $hidden;
?>
</FORM>
</BODY>
</HTML>
