<?php 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>�к���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>

<?php include 'menu.php'; ?>

<div><!-- InstanceBeginEditable name="detail" -->
<!--<style type="text/css">


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
</style>-->
<style>
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
label:hover{
	cursor: pointer;
}
</style>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />

<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

	window.onload = function () {
		dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('nonconf_date'));

	};

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


	
	function CheckForm(){
		
		var ff = document.f1;

		// ��Ǩ �дѺ�����ع�ç ��������͡�������
		var dmg_check = false;
		for (var index = 0; index < ff.clinic.length; index++) {
			var element = ff.clinic[index].checked;
			if(element == true){
				dmg_check = true;
			}
		}

		// ��Ǩ ��Դ�ͧ��������§
		// var testTypeRisk = document.getElementsByClassName('type_risk');
		// var risk_check = false;
		// for (let index = 0; index < testTypeRisk.length; index++) {
		// 	const element = testTypeRisk[index].checked;
		// 	if(element == true){
		// 		risk_check = true;
		// 	}
		// }
		
		if(ff.until.value==""){
			alert("��س����͡ ˹��§ҹ �ͧ��ҹ");
			ff.until.focus();
			return false;
		
		}else if( ff.topic1_1.checked == false && ff.topic1_2.checked == false && ff.topic1_3.checked == false && ff.topic1_4.checked == false && ff.topic1_5.checked == false && ff.topic1_6.checked == false && ff.topic1_7.value.length == 0 
			&& ff.topic2_1.checked == false && ff.topic2_2.checked == false && ff.topic2_3.checked == false && ff.topic2_4.checked == false && ff.topic2_5.checked == false && ff.topic2_6.checked == false && ff.topic2_7.value.length == 0 
			&& ff.topic3_1.checked == false && ff.topic3_2.checked == false && ff.topic3_3.checked == false && ff.topic3_4.value.length == 0 
			&& ff.topic4_1.checked == false && ff.topic4_2.checked == false && ff.topic4_3.checked == false && ff.topic4_4.checked == false && ff.topic4_5.checked == false && ff.topic4_6.value.length == 0 
			&& ff.topic5_1.checked == false && ff.topic5_2.checked == false && ff.topic5_3.checked == false && ff.topic5_4.checked == false && ff.topic5_5.checked == false && ff.topic5_6.checked == false && ff.topic5_7.checked == false && ff.topic5_8.checked == false && ff.topic5_9.checked == false && ff.topic5_10.checked == false && ff.topic5_11.value.length == 0 
			&& ff.topic6_1.checked == false && ff.topic6_2.checked == false && ff.topic6_3.checked == false && ff.topic6_4.checked == false && ff.topic6_5.value.length == 0 
			&& ff.topic7_1.checked == false && ff.topic7_2.checked == false && ff.topic7_3.checked == false && ff.topic7_4.checked == false && ff.topic7_5.checked == false && ff.topic7_6.checked == false && ff.topic7_7.value.length == 0 
			&& ff.topic8_1.checked == false && ff.topic8_2.checked == false && ff.topic8_3.checked == false && ff.topic8_4.checked == false && ff.topic8_5.checked == false && ff.topic8_6.checked == false && ff.topic8_7.checked == false && ff.topic8_8.checked == false && ff.topic8_9.checked == false && ff.topic8_10.checked == false && ff.topic8_11.value.length == 0 
			&& ff.topic9_1.checked == false && ff.topic9_2.checked == false && ff.topic9_3.checked == false && ff.topic9_4.checked == false && ff.topic9_5.checked == false && ff.topic9_6.value.length == 0){
			alert("��س����͡ ��¡�÷���ͧ�����");
			return false;

		}else if(ff.sum_up.value == ""){
			alert("��سҡ�͡��������´ ��������ػ�˵ء�ó�");
			ff.sum_up.focus();
			return false;

		}else if( dmg_check == false ){
			alert("��س����͡ �дѺ�����ع�ç");
			ff.clinic1.focus();
			return false;

		}else if(ff.head_name.value==""){
			alert("��سҡ�͡ �������˹�� ");
			ff.head_name.focus();
			return false;

		}/*else if( risk_check == false ){
			alert("��س����͡ ��Դ�ͧ��������§");
			ff.risk1.focus();
			return false;

		}*/else{
			return true;
		}
	}	

	function textdisabled(){
		var ff = document.f1;
			
		//****   1      **//	
		
		if(ff.topic1_1.checked == true || ff.topic1_2.checked == true || ff.topic1_3.checked == true || ff.topic1_4.checked == true || ff.topic1_5.checked == true || ff.topic1_6.checked == true){
			ff.topic1_7.disabled=true;
			ff.topic1_7.value="";
		}else{
			ff.topic1_7.disabled=false;
		}
		//****    2      **//
		
			if(ff.topic2_1.checked == true || ff.topic2_2.checked == true || ff.topic2_3.checked == true || ff.topic2_4.checked == true || ff.topic2_5.checked == true || ff.topic2_6.checked == true){
			ff.topic2_7.disabled=true;
			ff.topic2_7.value="";
		}else{
			ff.topic2_7.disabled=false;
		}
		//****    3      **//
		
		if(ff.topic3_1.checked == true || ff.topic3_2.checked == true || ff.topic3_3.checked == true){
			ff.topic3_4.disabled=true;
			ff.topic3_4.value="";
		}else{
			ff.topic3_4.disabled=false;
		}
		//****    4      **//
		if(ff.topic4_1.checked == true || ff.topic4_2.checked == true || ff.topic4_3.checked == true || ff.topic4_4.checked == true || ff.topic4_5.checked == true){
			ff.topic4_6.disabled=true;
			ff.topic4_6.value="";
		}else{
			ff.topic4_6.disabled=false;
		}
		//****    5      **//
		if(ff.topic5_1.checked == true || ff.topic5_2.checked == true || ff.topic5_3.checked == true || ff.topic5_4.checked == true || ff.topic5_5.checked == true || ff.topic5_6.checked == true || ff.topic5_7.checked == true || ff.topic5_8.checked == true || ff.topic5_9.checked == true || ff.topic5_10.checked == true){
			ff.topic5_11.disabled=true;
			ff.topic5_11.value="";
		}else{
			ff.topic5_11.disabled=false;
		}
		//****    6    **//
		if(ff.topic6_1.checked == true || ff.topic6_2.checked == true || ff.topic6_3.checked == true || ff.topic6_4.checked == true){
			ff.topic6_5.disabled=true;
			ff.topic6_5.value="";
		}else{
			ff.topic6_5.disabled=false;
		}
		//****    7   **//
			if(ff.topic7_1.checked == true || ff.topic7_2.checked == true || ff.topic7_3.checked == true || ff.topic7_4.checked == true || ff.topic7_5.checked == true || ff.topic7_5.checked == true || ff.topic7_6.checked == true){
			ff.topic7_7.disabled=true;
			ff.topic7_7.value="";
		}else{
			ff.topic7_7.disabled=false;
		}
		//****   8   **//
		if(ff.topic8_1.checked == true || ff.topic8_2.checked == true || ff.topic8_3.checked == true || ff.topic8_4.checked == true || ff.topic8_5.checked == true || ff.topic8_6.checked == true || ff.topic8_7.checked == true || ff.topic8_8.checked == true || ff.topic8_9.checked == true || ff.topic8_10.checked == true){
			ff.topic8_11.disabled=true;
			ff.topic8_11.value="";
		}else{
			ff.topic8_11.disabled=false;
		}	

		if(ff.topic9_1.checked === true || ff.topic9_2.checked === true || ff.topic9_3.checked === true || ff.topic9_4.checked === true || ff.topic9_5.checked === true){
			ff.topic9_6.disabled=true;
			ff.topic9_6.value="";
		}else{
			ff.topic9_6.disabled=false;
		}
	}
</script>


<?php

include("connect.inc");

$sendfile = "ncf_add2.php";
$hidden = "";
$date_now = (date("Y")+543).date("-m-d");
$nonconf_time1 = date("H");
$nonconf_time2 = date("i");

$arr_edit2["send_by"] = $_SESSION["firstname_now"];

?>
<FORM Name="f1" id="f1Form" METHOD="post" ACTION="ncf_add2.php" Onsubmit="return CheckForm();">
<div style="color: red;">
	<u>�к����� �зӡ�� Lock �������͡��������͹��ѧ ��ѧ�ҡ�ѹ���5 �ͧ������͹</u>
</div>
<br>
<TABLE align="center" border="1" style="border-collapse:collapse;" cellpadding="0" cellspacing="0" bordercolor="#000000" >
<TR bgcolor="#CCCCCC">
	<TD height="48"  align="center" bgcolor="#99CCFF">
		<B>�ѹ�֡��§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ ( Non - Conforming Report )</B></TD>
</TR>
<TR>
  <TD height="42" align="center" bgcolor="#99CCFF">�ٹ��Ѳ�Ҥس�Ҿ �͡��������Ţ FR-QMR -009/1 ,06, 3 �.�. 56</TD>
</TR>
<TR>
	<TD>
<TABLE border="0" width="800">
<TR valign="top">
	<TD bgcolor="#CCCCCC">�Ţ��� NCR : �Ţ��� NCR ���ѹ������ѵ��ѵ 
      <!-- input ������ -->
      <!-- <INPUT TYPE="text" NAME="ncr" size="10" value=""> -->
      
      <!--<INPUT TYPE="hidden" NAME="ncr" size="10" value="<?php//echo $nRunno;?>">-->
      <!--<INPUT TYPE="hidden" NAME="ncr" size="10" value="000">-->
      <br>
      ˹��§ҹ / ��� :
<SELECT NAME="until">
	<Option value="">--------------</Option>
	<?php
	$sql="SELECT * FROM `departments` where status='y' ";
	$query=mysql_query($sql);

	while($arr=mysql_fetch_array($query)){
		echo "<option value='$arr[code]'>$arr[name]</option> ";
	}
	?>
</SELECT>
<BR>
�ѹ��� :
<INPUT ID="nonconf_date" TYPE="text" NAME="nonconf_date" size="10" value="<?php echo $date_now;?>" readonly>
&nbsp;
		
		���� :
        <INPUT TYPE="hidden" name="nonconf_time">
        <SELECT NAME="nonconf_time1">
          <?php 
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($nonconf_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
        </SELECT>
        :
        <SELECT NAME="nonconf_time2">
          <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($nonconf_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
        </SELECT></TD>
	<TD colspan="2" bgcolor="#CCCCCC">
		<TABLE  height="115" width="100%" >
		<TR  valign="top">
			<TD><B>�����</B></TD>
			<TD>
				<INPUT TYPE="radio" NAME="come_from_id" value="1"  <?php if($arr_edit["come_from_id"] == "1") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;ENV ROUND<BR>
				<INPUT TYPE="radio" NAME="come_from_id" value="2"  <?php if($arr_edit["come_from_id"] == "2") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;IC ROUND<BR>
				<INPUT TYPE="radio" NAME="come_from_id" value="3"  <?php if($arr_edit["come_from_id"] == "3") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;RM ROUND<BR>
        <INPUT TYPE="radio" NAME="come_from_id" value="4"  <?php if($arr_edit["come_from_id"] == "4") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;12 �Ԩ�������ǹ<BR>
				
			</TD>
			<TD>
				<INPUT TYPE="radio" NAME="come_from_id" value="5"  <?php if($arr_edit["come_from_id"] == "5") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;˹�����§ҹ�ͧ<BR>
				<INPUT TYPE="radio" NAME="come_from_id" value="7"  <?php if($arr_edit["come_from_id"] == "7") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;��õ�Ǩ��þ�Һ��<BR>
        <INPUT TYPE="radio" NAME="come_from_id" value="8"  <?php if($arr_edit["come_from_id"] == "8") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;��·�����û�Ш��ѹ<BR>
        <INPUT TYPE="radio" NAME="come_from_id" value="6"  <?php if($arr_edit["come_from_id"] == "6") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='';}">&nbsp;����&nbsp;&nbsp;<br>
        <!--<INPUT TYPE="text" id="come_from_detail"NAME="come_from_detail" value="<?//phpecho $arr_edit["come_from_detail"];?>" style="display:none;">-->
                <SELECT NAME="come_from_detail" style="display:none;">
  			<Option value="">--------------</Option>
  <?php
										$sql2="SELECT * FROM `departments` where status='y' ";
										$query2=mysql_query($sql2);
										
										while($arr2=mysql_fetch_array($query2)){
											echo "<option value='$arr2[code]'>$arr2[name]</option> ";
										}
									?>
</SELECT><BR>
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
  <TD bgcolor="#CCCCCC" ><input name="event" type="radio" id="event1" value="1">
    1.���������ª��Ե�ҡ��æ�ҵ�ǵ��</TD>
  <TD colspan="2" bgcolor="#CCCCCC" ><input name="event" type="radio" id="event6" value="6"> 
    6.���������Ѻ�š�з����ͤ�����������Ҩ�֧�ԡ���������ª��Ե �ѹ���˵ؤ��������ͧ�ͧ�ػ�ó�/����ͧ��ͷҧ���ᾷ�� ����֧�ҡ�ؤ�ҡ÷ҧ���ᾷ��/��кǹ����ѡ����ç��Һ��
</TD>
</TR>
<TR valign="top">
  <TD bgcolor="#CCCCCC" ><input name="event" type="radio" id="event2" value="2">
  2.������ª��Ե�ҡ���������ʹ�Դ���� �Դ��</TD>
  <TD colspan="2" bgcolor="#CCCCCC" ><input name="event" type="radio" id="event7" value="7"> 
  7.�������觢ͧ/�ػ�ó쵡��ҧ�������ҧ��¼�����
</TD>
</TR>
<TR valign="top">
  <TD bgcolor="#CCCCCC" ><input name="event" type="radio" id="event3" value="3"> 
    3.���������ª��Ե����������ǡѺ��ô��Թ�ͧ�ä���͡���纻���㹢�й��
</TD>
  <TD colspan="2" bgcolor="#CCCCCC" ><input name="event" type="radio" id="event8" value="8"> 
    8.��÷�������ҧ���/����׹������ǧ�Թ�ҧ��/�ҵ������ç��Һ��
</TD>
</TR>
<TR valign="top">
  <TD bgcolor="#CCCCCC" ><input name="event" type="radio" id="event4" value="4"> 
    4.��ü�ҵѴ�Դ���˹� / �Դ������ / ��ҵѴ�Դ��
</TD>
  <TD colspan="2" bgcolor="#CCCCCC" ><input name="event" type="radio" id="event9" value="9"> 
    9.����ѡ�ҵ�Ƿ�á/������ͺ��á�Դ��ͺ����</TD>
</TR>
<TR valign="top">
  <TD bgcolor="#CCCCCC" ><input name="event" type="radio" id="event5" value="5"> 
    5.�������٭����˹�ҷ���÷ӧҹ�ͧ��ҧ��������շؾ��Ҿ���ҧ�������������Ǣ�ͧ�Ѻ��ô��Թ�ͧ�ä���͡���纻���㹢�й��
</TD>
  <TD colspan="2" bgcolor="#CCCCCC" ><!--<input type="button" onClick="clearRdo()" value='clear'>--><a href="javascript:clearChecks('event')">clear</a>
  �������� <strong style="font-weight:bold;">Sentinel Event</strong></TD>
</TR>
<TR valign="top">
  <TD bgcolor="#CCCCCC" >&nbsp;</TD>
  <TD colspan="2" bgcolor="#CCCCCC" >&nbsp;</TD>
</TR>
<TR  valign="top">
  <TD valign="top" bgcolor="#CCCCCC">
    <TABLE  width='91%'>
      <TR>
        <TD>
          <B>1. ������ʹ��� / ��/ ˡ���</B><BR>
          <INPUT TYPE="checkbox" NAME="topic1_1" value="1" <?php if($arr_edit["topic1_1"] == "1") echo " Checked ";?> onClick="textdisabled()"> 1. ���<BR>
          <INPUT TYPE="checkbox" NAME="topic1_2" value="1" <?php if($arr_edit["topic1_2"] == "1") echo " Checked ";?> onClick="textdisabled()"> 2. ����ҹ͹���躹���<BR>
          <INPUT TYPE="checkbox" NAME="topic1_3" value="1" <?php if($arr_edit["topic1_3"] == "1") echo " Checked ";?> onClick="textdisabled()"> 3. ���ҡ��§/������/���<BR>
          <INPUT TYPE="checkbox" NAME="topic1_4" value="1" <?php if($arr_edit["topic1_4"] == "1") echo " Checked ";?> onClick="textdisabled()"> 4. ����ͧ�Ѵ��֧��ش<BR>
          <INPUT TYPE="checkbox" NAME="topic1_5" value="1" <?php if($arr_edit["topic1_5"] == "1") echo " Checked ";?> onClick="textdisabled()"> 5. �չ�����������§<BR>
          <INPUT TYPE="checkbox" NAME="topic1_6" value="1" <?php if($arr_edit["topic1_6"] == "1") echo " Checked ";?> onClick="textdisabled()"> 
          6. ��Ѵ�������ҧ�������͹����<BR>
          
          <TABLE cellpadding="0" cellspacing="0">
            <TR valign="top">
              <TD>&nbsp;&nbsp;</TD>
              <TD><TEXTAREA NAME="topic1_7" ROWS="4" COLS="30" ><?php echo $arr_edit["topic1_7"];?></TEXTAREA></TD>
              </TR>
            </TABLE>
          </TD>
        </TR>
      </TABLE><BR>
  <TABLE  width='100%'>
  <TR>
    <TD>
      <B>2. ��õԴ����������</B><BR>
      <INPUT TYPE="checkbox" NAME="topic2_1" value="1" <?php if($arr_edit["topic2_1"] == "1") echo " Checked ";?>onClick="textdisabled()"> 1. �������§ҹ�� Lab/Film X-ray ��ǹ<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���� �Դ����<BR>
      <INPUT TYPE="checkbox" NAME="topic2_2" value="1" <?php if($arr_edit["topic2_2"] == "1") echo " Checked ";?> onClick="textdisabled()"> 2. �������§ҹᾷ��/ᾷ�����ͺ<BR>
      <INPUT TYPE="checkbox" NAME="topic2_3" value="1" <?php if($arr_edit["topic2_3"] == "1") echo " Checked ";?> onClick="textdisabled()"> 3. ��Ժѵ����١��ͧ��������<BR>
      <INPUT TYPE="checkbox" NAME="topic2_4" value="1" <?php if($arr_edit["topic2_4"] == "1") echo " Checked ";?> onClick="textdisabled()"> 4. �Ǫ����¹�������ó�<BR>
      <INPUT TYPE="checkbox" NAME="topic2_5" value="1" <?php if($arr_edit["topic2_5"] == "1") echo " Checked ";?> onClick="textdisabled()"> 5. ��Թ������ç�Ѻ�ѵ����<BR>
      <INPUT TYPE="checkbox" NAME="topic2_6" value="1" <?php if($arr_edit["topic2_6"] == "1") echo " Checked ";?> onClick="textdisabled()"> 6. ���ѵ�������������Թ���<BR>
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic2_7" ROWS="4" COLS="30" ><?php echo $arr_edit["topic2_7"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
  <BR>
  <TABLE  width='100%' height="236">
  <TR>
    <TD valign="top">
      <B>3. ���ʹ</B><BR>
      <INPUT TYPE="checkbox" NAME="topic3_1" value="1" <?php if($arr_edit["topic3_1"] == "1") echo " Checked ";?> onClick="textdisabled()" > 1. �Դ��<BR>
      <INPUT TYPE="checkbox" NAME="topic3_2" value="1" <?php if($arr_edit["topic3_2"] == "1") echo " Checked ";?> onClick="textdisabled()"> 2. �����á��͹�ҡ���������ʹ<BR>
      <INPUT TYPE="checkbox" NAME="topic3_3" value="1" <?php if($arr_edit["topic3_3"] == "1") echo " Checked ";?> onClick="textdisabled()"> 3. �����ʹ<BR>
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic3_4" ROWS="4" COLS="30" ><?php echo $arr_edit["topic3_4"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
    
    </TD>
  <TD bgcolor="#CCCCCC">
  <TABLE  width='100%'>
  <TR>
    <TD>
      <B>4. ����ͧ���</B><BR>
      
  <INPUT TYPE="checkbox" NAME="topic4_1" value="1" <?php if($arr_edit["topic4_1"] == "1") echo " Checked ";?> onClick="textdisabled()">  1.�����¶١�ǡ / ����<BR>
  <INPUT TYPE="checkbox" NAME="topic4_2" value="1" <?php if($arr_edit["topic4_2"] == "1") echo " Checked ";?> onClick="textdisabled()">  2.����������<BR>
  <INPUT TYPE="checkbox" NAME="topic4_3" value="1" <?php if($arr_edit["topic4_3"] == "1") echo " Checked ";?> onClick="textdisabled()">  3.���ӧҹ / �ӧҹ�Դ����<BR>
  <INPUT TYPE="checkbox" NAME="topic4_4" value="1" <?php if($arr_edit["topic4_4"] == "1") echo " Checked ";?> onClick="textdisabled()">  4.���������ͧ��� ��<BR>
  <INPUT TYPE="checkbox" NAME="topic4_5" value="1" <?php if($arr_edit["topic4_5"] == "1") echo " Checked ";?> onClick="textdisabled()">  5.�Կ�����ӧҹ<BR>
      
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic4_6" ROWS="4" COLS="30" ><?php echo $arr_edit["topic4_6"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE><BR>
  <TABLE  width='100%'>
  <TR>
    <TD>
      <B>5. ����ԹԨ��� / �ѡ��</B><BR>
      <INPUT TYPE="checkbox" NAME="topic5_1" value="1" <?php if($arr_edit["topic5_1"] == "1") echo " Checked ";?> onClick="textdisabled()"> 1. �Ѻ Admit ������ä����  7 �ѹ<BR>
      <INPUT TYPE="checkbox" NAME="topic5_2" value="1" <?php if($arr_edit["topic5_2"] == "1") echo " Checked ";?> onClick="textdisabled()"> 2. �������ö�ԹԨ����ä����ͧ admit  ������ ER ���<BR>
      <INPUT TYPE="checkbox" NAME="topic5_3" value="1" <?php if($arr_edit["topic5_3"] == "1") echo " Checked ";?> onClick="textdisabled()"> 3. ��ҹ����硫�����Դ<BR>
      <INPUT TYPE="checkbox" NAME="topic5_4" value="1" <?php if($arr_edit["topic5_4"] == "1") echo " Checked ";?> onClick="textdisabled()"> 4. ��Ҫ��㹡���ѡ�Ҽ����·���شŧ<BR>
      <INPUT TYPE="checkbox" NAME="topic5_5" value="1" <?php if($arr_edit["topic5_5"] == "1") echo " Checked ";?> onClick="textdisabled()"> 5. �����á��͹�ҡ�ѵ����<BR>
      <INPUT TYPE="checkbox" NAME="topic5_6" value="1" <?php if($arr_edit["topic5_6"] == "1") echo " Checked ";?> onClick="textdisabled()"> 6. �� Diag  Proc ����������Ἱ<BR>
      <INPUT TYPE="checkbox" NAME="topic5_7" value="1" <?php if($arr_edit["topic5_7"] == "1") echo " Checked ";?> onClick="textdisabled()"> 7. ���������ѧ�����§��<BR>
      <INPUT TYPE="checkbox" NAME="topic5_8" value="1" <?php if($arr_edit["topic5_8"] == "1") echo " Checked ";?> onClick="textdisabled()"> 8. ��� Cath / Tube / Drain ���١<BR>
      <INPUT TYPE="checkbox" NAME="topic5_9" value="1" <?php if($arr_edit["topic5_9"] == "1") echo " Checked ";?> onClick="textdisabled()"> 9. ���� Cath / Tube / Drain <BR>
      <INPUT TYPE="checkbox" NAME="topic5_10" value="1" <?php if($arr_edit["topic5_10"] == "1") echo " Checked ";?> onClick="textdisabled()"> 10. ���¼�������� ICU �������Ἱ<BR>
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic5_11" ROWS="4" COLS="30" ><?php echo $arr_edit["topic5_11"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
  <BR>
  <TABLE  width='100%'>
  <TR>
    <TD>
      <B>6. ��ä�ʹ</B><BR>
      <INPUT TYPE="checkbox" NAME="topic6_1" value="1" <?php if($arr_edit["topic6_1"] == "1") echo " Checked ";?> onClick="textdisabled()" > 1. ��辺 Fetal distress �ѹ��ǧ��<BR>
      <INPUT TYPE="checkbox" NAME="topic6_2" value="1" <?php if($arr_edit["topic6_2"] == "1") echo " Checked ";?> onClick="textdisabled()"> 2. ��ҵѴ��ʹ����Թ�<BR>
      <INPUT TYPE="checkbox" NAME="topic6_3" value="1" <?php if($arr_edit["topic6_3"] == "1") echo " Checked ";?> onClick="textdisabled()"> 3. �����á��͹�ҡ��ä�ʹ<BR>
      <INPUT TYPE="checkbox" NAME="topic6_4" value="1" <?php if($arr_edit["topic6_4"] == "1") echo " Checked ";?> onClick="textdisabled()"> 4. �Ҵ�纨ҡ��ä�ʹ<BR>
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic6_5" ROWS="4" COLS="30" ><?php echo $arr_edit["topic6_5"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
    </TD>
  <TD bgcolor="#CCCCCC">
    
  <TABLE  width='100%'>
    <TR>
      <TD>
        <B>7. ��ü�ҵѴ / ���ѭ��</B><BR>
        <INPUT TYPE="checkbox" NAME="topic7_1" value="1" <?php if($arr_edit["topic7_1"] == "1") echo " Checked ";?> onClick="textdisabled()"> 1. �����á��͹�ҧ���ѭ��<BR>
        <INPUT TYPE="checkbox" NAME="topic7_2" value="1" <?php if($arr_edit["topic7_2"] == "1") echo " Checked ";?> onClick="textdisabled()"> 2. ��ҵѴ�Դ�� / �Դ��ҧ / �Դ���˹�<BR>
        <INPUT TYPE="checkbox" NAME="topic7_3" value="1" <?php if($arr_edit["topic7_3"] == "1") echo " Checked ";?> onClick="textdisabled()"> 3. �Ѵ�������͡��������ҧἹ<BR>
        <INPUT TYPE="checkbox" NAME="topic7_4" value="1" <?php if($arr_edit["topic7_4"] == "1") echo " Checked ";?> onClick="textdisabled()"> 4. ��纫��������з��Ҵ��<BR>
        <INPUT TYPE="checkbox" NAME="topic7_5" value="1" <?php if($arr_edit["topic7_5"] == "1") echo " Checked ";?> onClick="textdisabled()"> 5. �������ͧ��� / ���� ���㹼�����<BR>
        <INPUT TYPE="checkbox" NAME="topic7_6" value="1" <?php if($arr_edit["topic7_6"] == "1") echo " Checked ";?> onClick="textdisabled()"> 6. ��Ѻ�Ҽ�ҵѴ���<BR>
        <TABLE cellpadding="0" cellspacing="0">
          <TR valign="top">
            <TD>&nbsp;&nbsp;</TD>
            <TD><TEXTAREA NAME="topic7_7" ROWS="4" COLS="30" ><?php echo $arr_edit["topic7_7"];?></TEXTAREA></TD>
            </TR>
          </TABLE>
  </TD>
      </TR>
    </TABLE>
    <BR>
    
    <TABLE  width='100%'>
      <TR>
        <TD>
          <B>8. ��� �</B><BR>
          <INPUT TYPE="checkbox" NAME="topic8_1" value="1" <?php if($arr_edit["topic8_1"] == "1") echo " Checked ";?> onClick="textdisabled()"> 1. ������ / �ҵ� ���֧���<BR>
          <INPUT TYPE="checkbox" NAME="topic8_2" value="1" <?php if($arr_edit["topic8_2"] == "1") echo " Checked ";?> onClick="textdisabled()"> 2. �����Ѥ������ þ.<BR>
          <INPUT TYPE="checkbox" NAME="topic8_3" value="1" <?php if($arr_edit["topic8_3"] == "1") echo " Checked ";?> onClick="textdisabled()"> 3. �ա�÷�������ҧ��� ������ / �ҵ� /  ���˹�ҷ��<BR>
          <INPUT TYPE="checkbox" NAME="topic8_4" value="1" <?php if($arr_edit["topic8_4"] == "1") echo " Checked ";?> onClick="textdisabled()"> 4. �����¾�������ҵ�ǵ�� / ��������ҧ��µ���ͧ<BR>
          <INPUT TYPE="checkbox" NAME="topic8_5" value="1" <?php if($arr_edit["topic8_5"] == "1") echo " Checked ";?> onClick="textdisabled()"> 5. �á��� / �ѡ����<BR>
          <INPUT TYPE="checkbox" NAME="topic8_6" value="1" <?php if($arr_edit["topic8_6"] == "1") echo " Checked ";?> onClick="textdisabled()"> 6. ��äء��� / ������<BR>
          <INPUT TYPE="checkbox" NAME="topic8_7" value="1" <?php if($arr_edit["topic8_7"] == "1") echo " Checked ";?> onClick="textdisabled()"> 7. ����Ǵ�������ѹ���� / �����͹<BR>
          <INPUT TYPE="checkbox" NAME="topic8_8" value="1" <?php if($arr_edit["topic8_8"] == "1") echo " Checked ";?> onClick="textdisabled()"> 8. �غѵ��˵������<BR>
          <INPUT TYPE="checkbox" NAME="topic8_9" value="1" <?php if($arr_edit["topic8_9"] == "1") echo " Checked ";?> onClick="textdisabled()"> 9. ���. �Ҵ�纨ҡ��÷ӧҹ <BR>
          <INPUT TYPE="checkbox" NAME="topic8_10" value="1" <?php if($arr_edit["topic8_10"] == "1") echo " Checked ";?> onClick="textdisabled()"> 10. ��������¡�纤�������<BR>
          <TABLE cellpadding="0" cellspacing="0">
            <TR valign="top">
              <TD>&nbsp;&nbsp;</TD>
              <TD><TEXTAREA NAME="topic8_11" ROWS="4" COLS="30" ><?php echo $arr_edit["topic8_11"];?></TEXTAREA></TD>
              </TR>
            </TABLE>
          
  </TD>
        </TR>
      </TABLE>
    
    <BR>

	<table width="100%">
		<tr>
			<td>
				<b>9. Miss-identification</b></br>
				<input type="checkbox" name="topic9_1" value="1" id="topic9_1" onclick="textdisabled()" > <label for="topic9_1">1. ���ѵ���üԴ��</label><br>
				<input type="checkbox" name="topic9_2" value="1" id="topic9_2" onclick="textdisabled()" > <label for="topic9_2">2. ���ѵ���üԴ��ҧ/�Դ������/�Դ���˹�</label><br>
				<input type="checkbox" name="topic9_3" value="1" id="topic9_3" onclick="textdisabled()" > <label for="topic9_3">3. ������ʹ�Դ��</label><br>
				<input type="checkbox" name="topic9_4" value="1" id="topic9_4" onclick="textdisabled()" > <label for="topic9_4">4. �͡��üԴ��</label><br>
				<input type="checkbox" name="topic9_5" value="1" id="topic9_5" onclick="textdisabled()" > <label for="topic9_5">5. �Դʵԡ����Դ��/������</label><br>
			</td>
		</tr>
		<tr>
			<td>
				<textarea name="topic9_6" id="topic9_6" cols="30" rows="4"></textarea>
			</td>
		</tr>
	</table>
    
    <!-- <TABLE  width='100%'>
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
	<TD >-->
		<!--<B>�����ҵԢͧ��úҴ��</B><BR>
		<INPUT TYPE="radio" NAME="type_injured" value="1" <?//php if($arr_edit["type_injured"] == "1") echo " Checked ";?> > 1.  ��д١��С��������<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="2" <?//php if($arr_edit["type_injured"] == "2") echo " Checked ";?> > 2. ���˹ѧ<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="3" <?//php if($arr_edit["type_injured"] == "3") echo " Checked ";?> > 3. ����ҷ��ǹ��ҧ<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="4" <?//php if($arr_edit["type_injured"] == "4") echo " Checked ";?> > 4. ������лʹ-->
	<!--</TD>
	<TD >-->
		<!--<B>�ѹ�֡��Ǫ����¹</B> <INPUT TYPE="radio" NAME="save_in_medical_record" value="1" <?//php if($arr_edit["save_in_medical_record"] == "1") echo " Checked ";?> > �� &nbsp;&nbsp;&nbsp;&nbsp; <INPUT TYPE="radio" NAME="save_in_medical_record" value="0" <?//php if($arr_edit["save_in_medical_record"] == "0") echo " Checked ";?> > ����<BR>
		��§ҹᾷ�� : <BR>&nbsp;&nbsp;<TEXTAREA NAME="tell_doctor" ROWS="4" COLS="21"><?//php echo $arr_edit["tell_doctor"];?></TEXTAREA>-->
	<!--</TD>
	<TD >-->
		<!--ᾷ��������Թ : <INPUT TYPE="text" NAME="estimate_doctor" value="<?//php echo $arr_edit["estimate_doctor"];?>"><BR>
		�š�û����Թ<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="1" <?//php if($arr_edit["estimate_result"] == "1") echo " Checked ";?> >&nbsp;����ա�úҴ��<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="2" <?//php if($arr_edit["estimate_result"] == "2") echo " Checked ";?> >&nbsp;�����繡�úҴ�纪Ѵਹ<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="3" <?//php if($arr_edit["estimate_result"] == "3") echo " Checked ";?> >&nbsp;��ͧ���� þ. �ҹ���<BR>-->
<!--	</TD>
</TR>-->
<TR valign="top">
	<TD colspan="3" bgcolor="#CCCCCC"  >
		<B>��������ػ�˵ء�ó�</B> : <BR>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME="sum_up" id="sum_up" ROWS="6" COLS="60"><?php echo $arr_edit["sum_up"];?></TEXTAREA>
	</TD>
</TR>
<TR valign="top">
  <TD colspan="3" bgcolor="#CCCCCC"  ><TABLE width="100%" border='1' bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
    <TR>
      <TD colspan="3"><B>�����ع�ç</B></TD>
    </TR>
    <TR>
      <TD width="78%"><input type="radio" name="clinic"   id="clinic1" value="A" <?php if($arr_edit2["clinic"] == "A") echo " Checked ";?>>
        &nbsp;A ���˵ء�ó������͡�ʷ��������Դ������Ҵ����͹ �����Ҩ�Դ����˹��§ҹ ���ѧ����Դ<br>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic2"  value="B" <?php if($arr_edit2["clinic"] == "B") echo " Checked ";?>>
        &nbsp;B  �Դ������Ҵ����͹��� ������֧������/þ./���˹�ҷ�� ����ѧ����դ�����������</TD>
      <td width="10%" align="center" valign="top" class="fonttable">�дѺ 1<br />
        ��ͺ��Ҵ <br /></td>
      <TD width="22%" rowspan="3" align="center"> ����§ҹ�ٹ��Ѳ�Ҥس�Ҿ </TD>
    </TR>
    <TR>
      <TD><INPUT TYPE="radio" NAME="clinic" id="clinic3"  value="C" <?php if($arr_edit2["clinic"] == "C") echo " Checked ";?>>
        &nbsp;C  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� ��������Ѻ�ѹ�����������������ª������§ ��Ѿ���Թ���������硹��� ��Ť������Թ 2,000 �ҷ</TD>
      <td align="center" class="fonttable">�дѺ 2<br />
        ����</td>
      </TR>
    <TR>
      <TD valign="top"><INPUT TYPE="radio" NAME="clinic"  id="clinic4" value="D" <?php if($arr_edit2["clinic"] == "D") echo " Checked ";?>>
        &nbsp;D  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� ��觵�ͧ������ѧ / �Դ���������� �������§�Ҿ����������� �Դ�����������ҧ㨨ҡ��������Ф�������дǡ����Ѻ��ԡ�� ��Ѿ���Թ���������硹�����Ť�� 2,000 -5,000 �ҷ<BR>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic5" value="E" <?php if($arr_edit2["clinic"] == "E") echo " Checked ";?>>
        &nbsp;E  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� �觼�����Դ�ѹ���ª��Ǥ�����е�ͧ�ա�úӺѴ�ѡ�� �Դ�����������ҧ� �ҡ����ѷ��Сѹ /˹��§ҹ�ͧ�Ѱ ��Ѿ���Թ��������ҡ���� 5,000 - 15,000 �ҷ <BR>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic6" value="F" <?php if($arr_edit2["clinic"] == "F") echo " Checked ";?>>
        &nbsp;F  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� �觼�����Դ�ѹ���ª��Ǥ��� ��е�ͧ�͹�ç��Һ�����������ç��Һ�Źҹ��� �Դ�����������ҧ㨨ҡ����ѷ��Сѹ / ˹��§ҹ�ͧ�Ѱ ��ͧ��ش�ҹ�ҡ���� 3 �ѹ ��Ѿ���Թ��������ҡ���� 15,000 �ҷ������Թ 30,000 �ҷ</TD>
      <td align="center" class="fonttable">�дѺ 3 <br />
        �ҹ��ҧ</td>
      </TR>
    <TR>
      <TD  valign="top"><INPUT TYPE="radio" NAME="clinic"  id="clinic7" value="G" <?php if($arr_edit2["clinic"] == "G") echo " Checked ";?>>
        &nbsp;G  �Դ������Ҵ����͹�Ѻ������ /þ./���˹�ҷ�� �觼�����Դ�ѹ���¶��� ��Ѿ���Թ������� ����Ť���ҡ���� 30,000 �ҷ ������Թ 50,000 �ҷ �������§�Ҿ����������»�ҡ�������Ҹ�ó�<BR>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic8" value="H" <?php if($arr_edit2["clinic"] == "H") echo " Checked ";?>>
        &nbsp;H  �Դ������Ҵ����͹�Ѻ������  /þ./���˹�ҷ�� �觼�����ͧ�ӡ�ê��ª��Ե ��úҴ��/�纻��¨ҡ�ҹ��дѺ�ع�ç ��Ѿ���Թ������� ����Ť���ҡ���� 50,000 ������Թ 100,000 �ҷ �������§�Ҿ����������»�ҡ�������Ҹ�ó�<BR>
        <INPUT TYPE="radio" NAME="clinic" id="clinic9"  value="I" <?php if($arr_edit2["clinic"] == "I") echo " Checked ";?>>
        &nbsp;I   �Դ������Ҵ����͹�Ѻ������   /þ./���˹�ҷ��  ��������˵آͧ������ª��Ե ��Ѿ���Թ������� ����Ť���ҡ���� 100,000 �ҷ �������§�Ҿ����������»�ҡ�������Ҹ�ó�/�١��ͧ��ͧ���ͧ����ԪҪվ<BR></TD>
      <td align="center" class="fonttable">�дѺ 4 <br />
        �ҡ</td>
      <TD align="center">��§ҹ��ǹ���� 6 �������<BR>
        ��.þ�����, <BR>
        ����Ѵ��ä�������§</TD>
    </TR>
    <TR>
      <TD colspan="3" align="center"  valign="top"><!--<input type="button" onclick="clearRdo2()" value='clear �����ع�ç'>--><a href="javascript:clearChecks('clinic')">clear</a></TD>
      </TR>
  </TABLE></TD>
</TR>
<TR valign="top">
	<TD colspan="3" bgcolor="#CCCCCC" >
		<B>�ѭ�ҷ�辺/���˵</B>� : <BR>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME="problem" ROWS="6" COLS="60"><?php echo $arr_edit["problem"];?></TEXTAREA>
	</TD>
</TR>
<TR valign="top">
	<TD colspan="3" bgcolor="#CCCCCC"  >
		<B>�ҵá����䢷������Թ�������� / �ҵá�û�ͧ�ѹ</B> : <BR>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME="protect" ROWS="6" COLS="60"><?php echo $arr_edit["protect"];?></TEXTAREA>
	</TD>
</TR>

<TR>
  <TD colspan="3" bgcolor="#CCCCCC" >&nbsp;</TD>
</TR>

<TR>
  <TD colspan="3" bgcolor="#CCCCCC" ><!--<B>���ͼ����</B> <INPUT TYPE="text" NAME="send_by" value="<?//php echo $arr_edit2["send_by"];?>">--><B>ŧ����  </B> <INPUT NAME="head_name" TYPE="text" value="<?php echo $arr_edit2["head_name"];?>" size="40"> 
    ���˹��˹��§ҹ
    </TD>
</TR>
<TR valign="top">
  <TD colspan="3" align="center" bgcolor="#CCCCCC"  >&nbsp;</TD>
</TR>
<?php
// if($_SESSION["statusncr"]=='admin'){
	?>
	<TR valign="top">
		<TD colspan="3" bgcolor="#CCCCCC"  ><strong>���¤س�Ҿ</strong></TD>
	</TR>
	<TR valign="top">
		<TD colspan="3" bgcolor="#CCCCCC"  >
			<input name="quality" type="radio" id="quality1" onClick="javaScript:if(this.checked){document.all.cpno.style.display='none';}" value="1">
			�Ң������������ 
			<input name="quality" type="radio" id="quality2" onClick="javaScript:if(this.checked){document.all.cpno.style.display='none';}" value="2">
			�Դ����������ͧ��������ʹ���ͧ 
			<input name="quality" type="radio" id="quality3" onClick="javaScript:if(this.checked){document.all.cpno.style.display='';}" value="3"> 
			�͡ CAR / PAR �Ţ��� 
			<input type="text" name="cpno" id="cpno" style="display:none;">
		</TD>
	</TR>
	<TR valign="top">
		<TD colspan="3" bgcolor="#CCCCCC"  >&nbsp;</TD>
	</TR>
	<TR valign="top">
		<TD colspan="3" bgcolor="#CCCCCC"  ><strong>��Դ�ͧ��������§</strong></TD>
	</TR>
	<TR valign="top">
		<TD colspan="3" bgcolor="#CCCCCC"  >
			<table border="0">
				<tr>
					<td>
						<input name="risk1" class="type_risk" type="checkbox" id="risk1" value="1"> 
						1.Clinical Risk
					</td>
					<td>
						<input name="risk6" class="type_risk" type="checkbox" id="risk6" value="1"> 
						6.Customer Complaint Risk
					</td>
				</tr>
				<tr>
					<td>
						<input name="risk2" class="type_risk" type="checkbox" id="risk2" value="1"> 
						2.Infection control Risk
					</td>
					<td>
						<input name="risk7" class="type_risk" type="checkbox" id="risk7" value="1"> 
						7.Financial Risk
					</td>
				</tr>
				<tr>
					<td>
						<input name="risk3" class="type_risk" type="checkbox" id="risk3" value="1"> 
						3.Medication Risk
					</td>
					<td>
						<input name="risk8" class="type_risk" type="checkbox" id="risk8" value="1"> 
						8.Utilization Management Risk
					</td>
				</tr>
				<tr>
					<td>
						<input name="risk4" class="type_risk" type="checkbox" id="risk4" value="1"> 
						4.Medical Equipment Risk
					</td>
					<td>
						<input name="risk9" class="type_risk" type="checkbox" id="risk9" value="1"> 
						9.Information Risk
					</td>
				</tr>
				<tr>
					<td>
						<input name="risk5" class="type_risk" type="checkbox" id="risk5" value="1"> 
						5.Safety and Environment Risk
					</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</TD>
	</TR>
	<TR valign="top">
		<TD colspan="3" bgcolor="#CCCCCC"  >&nbsp;</TD>
	</TR>
	<?php
	// }
	?>
<TR>
	<TD colspan="3" align="center"><INPUT TYPE="submit" value="�ѹ�֡������" class="fontsara"></TD>
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
<!-- InstanceEndEditable -->

</div>

<script type="text/javascript">

var j2 = jQuery.noConflict();
j2("#f1Form").submit(function(ev){

	var tr = j2('.type_risk');
	var risk_length = tr.length;
	
	var risk_check = false;
	for (var index = 0; index < risk_length; index++) {
		var element = tr[index].checked;
		if(element == true){
			risk_check = true;
		}
	}

	if( risk_check == false ){ 
		ev.preventDefault();
		alert("��س����͡ ��Դ�ͧ��������§");
		return false;

	}else{
		return true;
	}

});


</script>


</body>
<!-- InstanceEnd --></html>
