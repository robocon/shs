
<?php
session_start();
if(isset($_GET["action"]) && $_GET["action"] != "edit"){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");

Function calcage($birth){

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

 if(isset($_GET["action"]) && $_GET["action"] =="view"){
		
		
		$sql = "Select concat(yot,' ',name,' ',surname), idcard, date_format(dbirth,'%d-%m-%Y'), concat(address,' ', tambol,' ', ampur,' ', changwat), nation, religion, sex, married, dbirth From opcard where hn='".$_GET["hn"]."' limit 1";
		$result = Mysql_Query($sql) or die(mysql_error());
		$arr = Mysql_fetch_row($result);
	
		$pAge = calcage($arr[8]);
		
		echo $arr[0]."][".$arr[1]."][".$arr[2]."][".$arr[3]."][".$arr[4]."][".$arr[5]."][".$arr[6]."][".$arr[7]."][".$pAge;
	
		$sql2 = "Select hn From cancer where hn = '".$_GET["hn"]."' limit 1 ";
		$result = Mysql_Query($sql2) or die(mysql_error());
		$rows = Mysql_num_rows($result);

		if($rows > 0){
			echo "][<FONT COLOR='#FF0000'>คนไข้เคยบันทึกข้อมูลแล้ว</FONT>";
		}

		exit();
	}



?>
<html>
<head>
<title></title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

.fontbody {
	font-family:  Angsana New;
	font-size: 22 px;
}

.font_title{
	font-family:  Angsana New;
	font-size: 22 px;
	color:#FFFFFF;
	font-weight: bold;

}

.hfont{
	font-family: "TH SarabunPSK";
	font-size:18px;
}
</style>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes_cancer.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date2'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date3'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date4'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date5'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date6'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date7'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date8'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date9'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('register_date'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_diag'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('last_update'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('doctor_date'));
};
</script>
<!--<script language="JavaScript" src="calendar/calendar3.js">
</script>-->
<!--<link href="calendar/calendar.css" rel="stylesheet" type="text/css">-->
<SCRIPT LANGUAGE="JavaScript">

	function newXmlHttp(){
		var xmlhttp = false;

			try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}catch(e){
			try{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}catch(e){
					xmlhttp = false;
				}
			}

			if(!xmlhttp && document.createElement){
				xmlhttp = new XMLHttpRequest();
			}
		return xmlhttp;
	}

	function viewdetail(action,hn) {
		var text;
		var text2;
			if(document.f1.hn.value != ""){
				url = 'cancer.php?action='+action+'&hn=' + hn;

				xmlhttp = newXmlHttp();
				xmlhttp.open("GET", url, false);
				xmlhttp.send(null);

				text = xmlhttp.responseText;
				text2 = text.split('][');
				document.f1.name.value = text2[0];
				document.f1.id.value = text2[1];

				if(text2[9] =="<FONT COLOR='#FF0000'>คนไข้เคยบันทึกข้อมูลแล้ว</FONT>"){
					window.location.href='cancer.php?edit=true&hn='+hn;
				}else{

				document.getElementById("detail").innerHTML = '<B>ชื่อ-สกุล :</B> '+text2[0]+' <B>เพศ :</B> '+text2[6]+' <B>อายุ :</B> '+text2[8]+' <B>ว.ด.ป.เกิด :</B> '+text2[2]+' <BR><B>ที่อยู่ :</B> '+text2[3]+' <BR><B>สถานภาพสมรส :</B> '+text2[7]+' <B>เชื้อชาติ :</B> '+text2[4]+' <B>ศาสนา :</B> '+text2[5]+'<BR>'+text2[9]+'<BR>';
				}
				

			}
	}

</SCRIPT>
</head>
<body>

<A HREF="../nindex.htm" class="fontbody">&lt;&lt; เมนู</A>

<A HREF="cancer_hn.php" class="fontbody"> พิมพ์แบบรายงานโรคมะเร็ง </A>
<?php

	if(isset($_GET["edit"])){
		
		$sql = "Select concat(yot,' ',name,' ',surname), idcard, date_format(dbirth,'%d-%m-%Y'), concat(address,' ', tambol,' ', ampur,' ', changwat), nation, religion, sex, married, dbirth From opcard where hn='".$_GET["hn"]."' limit 1";
		$result = Mysql_Query($sql) or die(mysql_error());
		$arr = Mysql_fetch_row($result);
		
		$pAge = calcage($arr[8]);
		$detail = "<B>ชื่อ-สกุล :</B> $arr[0] <B>เพศ :</B> $arr[6] <B>อายุ :</B> $pAge <B>ว.ด.ป.เกิด :</B> $arr[2] <BR><B>ที่อยู่ :</B> $arr[3] <BR><B>สถานภาพสมรส :</B> $arr[7] <B>เชื้อชาติ :</B> $arr[4] <B>ศาสนา :</B> $arr[5]<BR>";
		

		$sql = "Select hn, id, date_diag,doctor_date, lab_name, lab_no, diag_type1, diag_type2, diag_type3, diag_type4, diag_type5, diag_type6, diag_type7, diag_type8, diag_type9, position, lab_detail, stage, a, b,t,n,m,grade,side, cure_surgery, cure_radiation, cure_chemotherapy,cure_targeted, cure_hormone, cure_intervention,cure_immuno, cure_other, cure_support, status, last_update, dead ,register_date,officer,date1,date2,date3,date4,date5,date6,date7,date8,date9 From cancer Where hn = '".$_GET["hn"]."' limit 1 ";
		$result = Mysql_Query($sql) or die(mysql_error());
		$arr_edit = Mysql_fetch_assoc($result);
	
	$action = "cancer_edit.php";
	$cancle = "<INPUT TYPE=\"button\" value=\"ยกเลิก\" Onclick=\"window.location.href='cancer.php';\">";
	
	}else{
		
		
		$sql = "Select concat(yot,' ',name,' ',surname), idcard, date_format(dbirth,'%d-%m-%Y'), concat(address,' ', tambol,' ', ampur,' ', changwat), nation, religion, sex, married, dbirth From opcard where hn='".$_GET["hn"]."' limit 1";
		$result = Mysql_Query($sql) or die(mysql_error());
		$arr = Mysql_fetch_row($result);
		
		$pAge = calcage($arr[8]);
		$detail = "<B>ชื่อ-สกุล :</B> $arr[0] <B>เพศ :</B> $arr[6] <B>อายุ :</B> $pAge <B>ว.ด.ป.เกิด :</B> $arr[2] <BR><B>ที่อยู่ :</B> $arr[3] <BR><B>สถานภาพสมรส :</B> $arr[7] <B>เชื่อชาติ :</B> $arr[4] <B>ศาสนา :</B> $arr[5]<BR>";
		
	$action = "cancer_add.php";
	$cancle = "<INPUT TYPE=\"reset\" value=\"ยกเลิก\">";
	}

?>
<TABLE align="center" width="69%"  border="1" bordercolor="#3366FF" class="fontbody"> 
<TR>
	<TD>
<FORM name="f1" METHOD=POST ACTION="<?php echo $action;?>">
	<TABLE width="100%">
	<TR >
		<TD align="center" colspan="3" style="color:#FFFFFF;background-color: #0033FF;font-weight:bold; ">เพิ่มข้อมูลผู้ป่วยโรคมะเร็ง</TD>
	</TR>
	<TR >
		<TD align="right" >HN : </TD><TD><INPUT TYPE="text" NAME="hn" size="7" value="<?php echo $_GET["hn"];?>">&nbsp;<INPUT TYPE="button" Onclick="viewdetail('view',document.f1.hn.value);" value="View"> <a href="labviewdc.php?hn=<?php echo $_GET["hn"];?>" target="_blank">ดูผลตรวจชิ้นเนื้อ</a></TD>
	</TR>
	<TR >
		<TD align="center" colspan="3" style="color:#FFFFFF;background-color: #0033FF;font-weight:bold; ">ข้อมูลผู้ป่วย</TD>
	</TR>
	<TR>
		<TD align="left" colspan="3" >

	<Div id="detail"><?php echo $detail;?></Div><BR>
		</TD>
	</TR>
	<TR >
		<TD align="center" colspan="3" style="color:#FFFFFF;background-color: #0033FF;font-weight:bold; ">ข้อมูลโรคมะเร็ง</TD>
	</TR>
	<TR>
		<TD align="right" >ID : </TD><TD><INPUT TYPE="text" NAME="id" value="<?php echo $arr[1];?>" readonly></TD>
	</TR>
	<TR>
		<TD align="right" >ชื่อ Lab : </TD><TD><INPUT TYPE="text" NAME="lab_name" value="<?php echo $arr_edit["lab_name"];?>" ></TD>
	</TR>
	<TR>
		<TD align="right" >Lab No : </TD><TD><INPUT TYPE="text" NAME="lab_no" value="<?php echo $arr_edit["lab_no"];?>" ></TD>
	</TR>
	<TR>
	  <TD align="right" >วันที่มาพบแพทย์ครั้งแรก</TD>
	  <TD><INPUT TYPE="text" NAME="doctor_date" value="<?php echo $arr_edit["doctor_date"];?>"  id="doctor_date"></TD>
	  </TR>
	<TR>
		<TD align="right" >วันที่วินิจฉัยว่าเป็นมะเร็ง : </TD><TD><INPUT TYPE="text" NAME="date_diag" value="<?php echo $arr_edit["date_diag"];?>"  id="date_diag">
		&nbsp;</TD>
	</TR>
	<TR>
		<TD align="right" valign="top" >วิธีวินิจฉัยโรค : </TD>
		<TD>
				<INPUT TYPE="checkbox" NAME="diag_type1" <?php if($arr_edit["diag_type1"] == "0 มรณะบัตร") echo " Checked "; ?> value="0 มรณะบัตร">0 มรณะบัตร<BR>
				<INPUT TYPE="checkbox" NAME="diag_type2" <?php if($arr_edit["diag_type2"] == "1 ซักประวัติและตรวจร่างกาย") echo " Checked "; ?>  value="1 ซักประวัติและตรวจร่างกาย">1 ซักประวัติและตรวจร่างกาย<BR>
				<INPUT TYPE="checkbox" NAME="diag_type3" <?php if($arr_edit["diag_type3"] == "2 รังสีวินิจฉัย ส่องกล้อง Ultrasound") echo " Checked "; ?>  value="2 รังสีวินิจฉัย ส่องกล้อง Ultrasound">2 รังสีวินิจฉัย ส่องกล้อง Ultrasound<BR>
				<INPUT TYPE="checkbox" NAME="diag_type4" <?php if($arr_edit["diag_type4"] == "3 ผ่าตัด หรือ ผ่าศพ โดยไม่มีผลชิ้นเนื้อ") echo " Checked "; ?>  value="3 ผ่าตัด หรือ ผ่าศพ โดยไม่มีผลชิ้นเนื้อ">3 ผ่าตัด หรือ ผ่าศพ โดยไม่มีผลชิ้นเนื้อ<BR>
				<INPUT TYPE="checkbox" NAME="diag_type5" <?php if($arr_edit["diag_type5"] == "4 Specific Biochem / Immuno tests") echo " Checked "; ?>  value="4 Specific Biochem / Immuno tests">4 Specific Biochem / Immuno tests<BR>
				<INPUT TYPE="checkbox" NAME="diag_type6" <?php if($arr_edit["diag_type6"] == "5 การตรวจเซลล์ หรือ การตรวจเลือด") echo " Checked "; ?>  value="5 การตรวจเซลล์ หรือ การตรวจเลือด">5 การตรวจเซลล์ หรือ การตรวจเลือด<BR>
				<INPUT TYPE="checkbox" NAME="diag_type7" <?php if($arr_edit["diag_type7"] == "6 การตรวจชิ้นเนื้อที่กระจาย") echo " Checked "; ?>  value="6 การตรวจชิ้นเนื้อที่กระจาย">6 การตรวจชิ้นเนื้อที่กระจาย<BR>
				<INPUT TYPE="checkbox" NAME="diag_type8" <?php if($arr_edit["diag_type8"] == "7 การตรวจชิ้นเนื้องอกปฐมภูมิ") echo " Checked "; ?>  value="7 การตรวจชิ้นเนื้องอกปฐมภูมิ">7 การตรวจชิ้นเนื้องอกปฐมภูมิ<BR>
				<INPUT TYPE="checkbox" NAME="diag_type9" <?php if($arr_edit["diag_type9"] == "8 การผ่าศพและมีผลชิ้นเนื้อ") echo " Checked "; ?>  value="8 การผ่าศพและมีผลชิ้นเนื้อ">8 การผ่าศพและมีผลชิ้นเนื้อ<BR>
</TD>
	</TR>
	<TR>
		<TD align="right" >ตำแหน่ง/อวัยวะที่เป็นมะเร็ง : </TD><TD><INPUT TYPE="text" NAME="position" value="<?php if(!empty($arr_edit["position"])){ echo $arr_edit["position"];}else{ echo $_GET["diag"];}?>"></TD>
	</TR>
	<TR>
		<TD align="right" >ผลทางพยาธิวิทยา : </TD><TD><INPUT TYPE="text" NAME="lab_detail" value="<?php echo $arr_edit["lab_detail"];?>"></TD>
	</TR>
	<TR>
	  <TD align="right" >เกรด :</TD>
	  <TD><SELECT NAME="grade">
				<Option value="well differentiated" selected <?php if($arr_edit["grade"] =="well differentiated") echo " Selected ";?> >Well differentiated</Option>
                <Option value="moderately differentiated" <?php if($arr_edit["grade"] =="moderately differentiated") echo " Selected ";?> >Moderately differentiated</Option>
                <Option value="poorly differentiated" <?php if($arr_edit["grade"] =="poorly differentiated") echo " Selected ";?> >Poorly differentiated</Option>
                <Option value="undifferentiated" <?php if($arr_edit["grade"] =="undifferentiated") echo " Selected ";?> >Undifferentiated</Option>
                <Option value="T-cell" <?php if($arr_edit["grade"] =="T-cell") echo " Selected ";?> >T-cell</Option>
                <Option value="B-cell" <?php if($arr_edit["grade"] =="B-cell") echo " Selected ";?> >B-cell</Option>
				 <Option value="unknown" <?php if($arr_edit["grade"] =="unknown") echo " Selected ";?> >Unknown</Option>
			</SELECT></TD>
	  </TR>
	<TR>
	  <TD align="right" >TNM :</TD>
	  <TD>T
	    <input name="tnm1" type="text" id="tnm1" size="5" value="<?=$arr_edit["t"];?>">
	    N
	    <input name="tnm2" type="text" id="tnm2" size="5" value="<?=$arr_edit["n"];?>">
	    M
	    <input name="tnm3" type="text" id="tnm3" size="5" value="<?=$arr_edit["m"];?>"></TD>
	  </TR>
	<TR>
	  <TD align="right" >ข้าง</TD>
	  <TD><SELECT NAME="side">
	    <Option value="right" selected <?php if($arr_edit["side"] =="right") echo " Selected ";?> >Right</Option>
        <Option value="left" selected <?php if($arr_edit["side"] =="left") echo " Selected ";?> >Left</Option>
        <Option value="bilateral" selected <?php if($arr_edit["side"] =="bilateral") echo " Selected ";?> >Bilateral</Option>
        <Option value="unilateral unspecified" selected <?php if($arr_edit["side"] =="unilateral unspecified") echo " Selected ";?> >Unilateral unspecified</Option>
        <Option value="not applicable" selected <?php if($arr_edit["side"] =="not applicable") echo " Selected ";?> >Not applicable</Option>
        <Option value="not known" selected <?php if($arr_edit["side"] =="not known") echo " Selected ";?> >Not known</Option>
	    
	    </SELECT></TD>
	  </TR>
	<TR>
		<TD align="right" >Stage : </TD>
		<TD>
			<SELECT NAME="stage">
				<Option value="Stage 0" <?php if($arr_edit["stage"] =="Stage 0") echo " Selected ";?> >Stage 0</Option>
				<Option value="Stage I,A" <?php if($arr_edit["stage"] =="Stage I,A") echo " Selected ";?> >Stage I,A</Option>
				<Option value="Stage II,B" <?php if($arr_edit["stage"] =="Stage II,B") echo " Selected ";?> >Stage II,B</Option>
				<Option value="Stage III,C" <?php if($arr_edit["stage"] =="Stage III,C") echo " Selected ";?> >Stage III,C</Option>
				<Option value="Stage IV,D" <?php if($arr_edit["stage"] =="Stage IV,D") echo " Selected ";?> >Stage IV,D</Option>
				<Option value="Stage II a,B1" <?php if($arr_edit["stage"] =="Stage II a,B1") echo " Selected ";?> >Stage II a,B1</Option>
				<Option value="Stage II b,B2" <?php if($arr_edit["stage"] =="Stage II b,B2") echo " Selected ";?> >Stage II b,B2</Option>
				<Option value="Stage III a,C1" <?php if($arr_edit["stage"] =="Stage III a,C1") echo " Selected ";?> >Stage III a,C1</Option>
				<Option value="ไม่ทราบ" <?php if($arr_edit["stage"] =="ไม่ทราบ") echo " Selected ";?> >ไม่ทราบ</Option>
			</SELECT>	
		</TD>
	</TR>
	<TR>
		<TD align="right" >การแพร่กระจายของโรค : </TD>
		<TD>
			<SELECT NAME="a">
				<Option value="In Situ" <?php if($arr_edit["a"] =="In Situ") echo " Selected ";?> >In Situ</Option>
				<Option value="Localized" <?php if($arr_edit["a"] =="Localized") echo " Selected ";?> >Localized</Option>
				<Option value="Direct extension" <?php if($arr_edit["a"] =="Direct extension") echo " Selected ";?> >Direct extension</Option>
				<Option value="Regional lymph nodes" <?php if($arr_edit["a"] =="Regional lymph nodes") echo " Selected ";?> >Regional lymph nodes</Option>
				<Option value="Distant metastasis" <?php if($arr_edit["a"] =="Distant metastasis") echo " Selected ";?> >Distant metastasis</Option>
				<Option value="Not applicable" <?php if($arr_edit["a"] =="Not applicable") echo " Selected ";?> >Not applicable</Option>
				<Option value="Not known" <?php if($arr_edit["a"] =="Not known") echo " Selected ";?> >Not known</Option>
			</SELECT>
		</TD>
	</TR>
	<TR>
		<TD align="right" >ตำแหน่งที่แพร่กระจาย : </TD>
		<TD>
			<SELECT NAME="b">
				<Option value="None" <?php if($arr_edit["b"] =="None") echo " Selected ";?> >None</Option>
				<Option value="Distant Lymph node" <?php if($arr_edit["b"] =="Distant Lymph node") echo " Selected ";?> >Distant Lymph node</Option>
				<Option value="Bone" <?php if($arr_edit["b"] =="Bone") echo " Selected ";?> >Bone</Option>
				<Option value="Liver" <?php if($arr_edit["b"] =="Liver") echo " Selected ";?> >Liver</Option>
				<Option value="Lung/Pleure" <?php if($arr_edit["b"] =="Lung/Pleure") echo " Selected ";?> >Lung/Pleure</Option>
				<Option value="Brain" <?php if($arr_edit["b"] =="Brain") echo " Selected ";?> >Brain</Option>
				<Option value="Peritoneum" <?php if($arr_edit["b"] =="Peritoneum") echo " Selected ";?> >Peritoneum</Option>
				<Option value="Other" <?php if($arr_edit["b"] =="Other") echo " Selected ";?> >Other</Option>
				<Option value="Multiple sites" <?php if($arr_edit["b"] =="Multiple sites") echo " Selected ";?> >Multiple sites</Option>
			</SELECT>
		</TD>
	</TR>
	<TR>
		<TD align="right" valign="top">การรักษา :</TD>
		<TD>
		<TABLE>
		<TR>
		  <TD colspan="4">&nbsp;</TD>
		  <TD width="144">วันที่เริ่มรักษา</TD>
		  </TR>
		<TR>
			<TD width="121">Surgery</TD>
			<TD width="49"><INPUT TYPE="radio" NAME="cure_surgery" <?php if($arr_edit["cure_surgery"] == "Yes") echo " Checked ";?> value="Yes" >&nbsp;Yes</TD>
			<TD width="46"><INPUT TYPE="radio" NAME="cure_surgery" <?php if($arr_edit["cure_surgery"] == "No") echo " Checked ";?> value="No" >&nbsp;No</TD>
			<TD width="131"><INPUT TYPE="radio" NAME="cure_surgery" <?php if($arr_edit["cure_surgery"] == "Not known") echo " Checked ";?> value="Not known" >&nbsp;Not known</TD>
			<TD><input name="date1" type="text" class="hfont" id="date1" value="<?=$arr_edit['date1'];?>"></TD>
		</TR>
		<TR>
			<TD>Radiation</TD>
			<TD><INPUT TYPE="radio" NAME="cure_radiation" <?php if($arr_edit["cure_radiation"] == "Yes") echo " Checked ";?> value="Yes" >&nbsp;Yes</TD>
			<TD><INPUT TYPE="radio" NAME="cure_radiation" <?php if($arr_edit["cure_radiation"] == "No") echo " Checked ";?> value="No" >&nbsp;No</TD>
			<TD><INPUT TYPE="radio" NAME="cure_radiation" <?php if($arr_edit["cure_radiation"] == "Not known") echo " Checked ";?> value="Not known" >&nbsp;Not known</TD>
			<TD><input name="date2" type="text" class="hfont" id="date2" value="<?=$arr_edit['date2'];?>"></TD>
		</TR>
		<TR>
			<TD>Chemotherapy</TD>
			<TD><INPUT TYPE="radio" NAME="cure_chemotherapy" <?php if($arr_edit["cure_chemotherapy"] == "Yes") echo " Checked ";?> value="Yes" >&nbsp;Yes</TD>
			<TD><INPUT TYPE="radio" NAME="cure_chemotherapy" <?php if($arr_edit["cure_chemotherapy"] == "No") echo " Checked ";?> value="No" >&nbsp;No</TD>
			<TD><INPUT TYPE="radio" NAME="cure_chemotherapy" <?php if($arr_edit["cure_chemotherapy"] == "Not known") echo " Checked ";?> value="Not known" >&nbsp;Not known</TD>
			<TD><input name="date3" type="text" class="hfont" id="date3" value="<?=$arr_edit['date3'];?>"></TD>
		</TR>
		<TR>
		  <TD>Targeted therapy</TD>
		  <TD><INPUT TYPE="radio" NAME="cure_targeted" <?php if($arr_edit["cure_targeted"] == "Yes") echo " Checked ";?> value="Yes" >
		    &nbsp;Yes</TD>
		  <TD><INPUT TYPE="radio" NAME="cure_targeted" <?php if($arr_edit["cure_targeted"] == "No") echo " Checked ";?> value="No" >
		    &nbsp;No</TD>
		  <TD><INPUT TYPE="radio" NAME="cure_targeted" <?php if($arr_edit["cure_targeted"] == "Not known") echo " Checked ";?> value="Not known" >
		    &nbsp;Not known</TD>
		  <TD><input name="date4" type="text" class="hfont" id="date4" value="<?=$arr_edit['date4'];?>"></TD>
		  </TR>
		<TR>
			<TD>Hormone</TD>
			<TD><INPUT TYPE="radio" NAME="cure_hormone" <?php if($arr_edit["cure_hormone"] == "Yes") echo " Checked ";?> value="Yes" >&nbsp;Yes</TD>
			<TD><INPUT TYPE="radio" NAME="cure_hormone" <?php if($arr_edit["cure_hormone"] == "No") echo " Checked ";?> value="No" >&nbsp;No</TD>
			<TD><INPUT TYPE="radio" NAME="cure_hormone" <?php if($arr_edit["cure_hormone"] == "Not known") echo " Checked ";?> value="Not known" >&nbsp;Not known</TD>
			<TD><input name="date5" type="text" class="hfont" id="date5" value="<?=$arr_edit['date5'];?>"></TD>
		</TR>
		<TR>
			<TD>Immuno</TD>
			<TD><INPUT TYPE="radio" NAME="cure_immuno" <?php if($arr_edit["cure_immuno"] == "Yes") echo " Checked ";?> value="Yes" >&nbsp;Yes</TD>
			<TD><INPUT TYPE="radio" NAME="cure_immuno" <?php if($arr_edit["cure_immuno"] == "No") echo " Checked ";?> value="No" >&nbsp;No</TD>
			<TD><INPUT TYPE="radio" NAME="cure_immuno" <?php if($arr_edit["cure_immuno"] == "Not known") echo " Checked ";?> value="Not known" >&nbsp;Not known</TD>
			<TD><input name="date6" type="text" class="hfont" id="date6" value="<?=$arr_edit['date6'];?>"></TD>
		</TR>
		<TR>
		  <TD>Intervention treatment</TD>
		  <TD><INPUT TYPE="radio" NAME="cure_intervention" <?php if($arr_edit["cure_intervention"] == "Yes") echo " Checked ";?> value="Yes" >
		    &nbsp;Yes</TD>
		  <TD><INPUT TYPE="radio" NAME="cure_intervention" <?php if($arr_edit["cure_intervention"] == "No") echo " Checked ";?> value="No" >
		    &nbsp;No</TD>
		  <TD><INPUT TYPE="radio" NAME="cure_intervention" <?php if($arr_edit["cure_intervention"] == "Not known") echo " Checked ";?> value="Not known" >
		    &nbsp;Not known</TD>
		  <TD><input name="date7" type="text" class="hfont" id="date7" value="<?=$arr_edit['date7'];?>"></TD>
		  </TR>
		<TR>
			<TD>Other</TD>
			<TD><INPUT TYPE="radio" NAME="cure_other" <?php if($arr_edit["cure_other"] == "Yes") echo " Checked ";?> value="Yes" >&nbsp;Yes</TD>
			<TD><INPUT TYPE="radio" NAME="cure_other" <?php if($arr_edit["cure_other"] == "No") echo " Checked ";?> value="No" >&nbsp;No</TD>
			<TD><INPUT TYPE="radio" NAME="cure_other" <?php if($arr_edit["cure_other"] == "Not known") echo " Checked ";?> value="Not known" >&nbsp;Not known</TD>
			<TD><input name="date8" type="text" class="hfont" id="date8" value="<?=$arr_edit['date8'];?>"></TD>
		</TR>
		<TR>
			<TD>Support</TD>
			<TD><INPUT TYPE="radio" NAME="cure_support" <?php if($arr_edit["cure_support"] == "Yes") echo " Checked ";?> value="Yes" >&nbsp;Yes</TD>
			<TD><INPUT TYPE="radio" NAME="cure_support" <?php if($arr_edit["cure_support"] == "No") echo " Checked ";?> value="No" >&nbsp;No</TD>
			<TD><INPUT TYPE="radio" NAME="cure_support" <?php if($arr_edit["cure_support"] == "Not known") echo " Checked  ";?> value="Not known" >&nbsp;Not known</TD>
			<TD><input name="date9" type="text" class="hfont" id="date9" value="<?=$arr_edit['date9'];?>"></TD>
		</TR>
		</TABLE>
		
		</TD>
	</TR>
	<TR>
		<TD align="right" >สถาพปัจจุบัน : </TD>
		<TD>
			<INPUT TYPE="radio" NAME="status" value="มีชีวิต" <?php if($arr_edit["status"] == "มีชีวิต") echo " Checked ";?> >&nbsp;มีชีวิต&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="status" value="ตาย" <?php if($arr_edit["status"] == "ตาย") echo " Checked ";?> >&nbsp;เสียชีวิต
            <INPUT TYPE="radio" NAME="status" value="ไม่ระบุ" <?php if($arr_edit["status"] == "ไม่ระบุ") echo " Checked ";?> >&nbsp;ไม่ระบุ
		</TD>
	</TR>
	<TR>
		<TD align="right" >วันที่ติดต่อล่าสุด/วันที่ผู้ป่วยตาย : </TD><TD><INPUT TYPE="text" NAME="last_update" size="20" maxlength="10" value="<?php echo $arr_edit["last_update"];?>" id="last_update">&nbsp;แบบ 2555-01-01</TD>
	</TR>
	<TR>
		<TD align="right" >สาเหตุการตาย : </TD><TD>
			<INPUT TYPE="radio" NAME="dead" value="โรคมะเร็ง" <?php if($arr_edit["dead"] == "โรคมะเร็ง") echo " Checked ";?>>&nbsp;โรคมะเร็ง&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="dead" value="โรคอื่นๆ" <?php if($arr_edit["dead"] == "โรคอื่นๆ") echo " Checked ";?>>&nbsp;โรคอื่นๆ&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="dead" value="ไม่ทราบ" <?php if($arr_edit["dead"] == "ไม่ทราบ") echo " Checked ";?>>&nbsp;ไม่ระบุ

		</TD>
	</TR>
	<TR>
	  <TD align="right" >วันที่เก็บรวบรวมข้อมูล</TD>
	  <TD><INPUT TYPE="text" NAME="register_date" size="20" maxlength="10" value="<?php echo $arr_edit["register_date"];?>" id="register_date"></TD>
	  </TR>
	<TR>
	  <TD align="right" >ผู้รวบรวมข้อมูล</TD>
	  <TD><input name="officer" type="text" id="officer" size="30" value="<?php echo $arr_edit["officer"];?>" ></TD>
	  </TR>
	<TR>
		<TD align="center" colspan="2"><INPUT TYPE="submit" value="บันทึก">&nbsp;&nbsp;<?php echo $cancle;?></TD>
	</TR>

	</TABLE>

</FORM>
	</TD>
</TR>
</TABLE>


</body>
</html>
<?php include("unconnect.inc");?>
