<meta http-equiv="X-UA-Compatible" content="IE=10;IE=9;IE=8,chrome=1">
<style>
body {
	background-color:#CCE9FD;
}
fieldset { border:1px solid green }

legend {
  padding: 0.2em 0.5em;
  border:1px solid green;
  color:green;
  font-size:90%;
  text-align:right;
  }
  .fonttitle{
/*	 font-family:"Angsana New";
	 size:25PX;*/
	 color:#030;
 }
 .fonthead{
	 font-family:"Angsana New";
	 size:16PX;
	/* font-weight:bold;*/
 }
 .fonthead1{
	 font-family:"Angsana New";
	 size:16PX;
	 color:#FF0000;
	/* font-weight:bold;*/
 } 

 .chk_table{
    border-collapse: collapse;
	font-family: 'TH Sarabun New','TH SarabunPSK';
	color: #000000;
	font-size: 14pt;
}

.chk_table th, .chk_table td{
    border: 1px solid black;
	padding: 3px;
}

.icf_code{
	color: blue;
}
.icf_code:hover, #btn_show_icf:hover{
	text-decoration: underline;
	cursor: pointer;
}
.close-icf:hover, .close_icf_static{
	cursor: pointer;
}
#btn_show_icf{
	color: blue;
}

.notify43{
	border: 2px solid #f95506;
}

.style1 {color: #FF0000}
</style>
<script language="JavaScript1.2">
<!--
window.moveTo(0,0);
if (document.all) {
	top.window.resizeTo(screen.availWidth,screen.availHeight);
}
else if (document.layers||document.getElementById) {
	if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
		top.window.outerHeight = screen.availHeight;
		top.window.outerWidth = screen.availWidth;
	}
}
//-->
</script>

<?php
    session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("cPtright1");
    session_unregister("nVn");  
    session_unregister("cAge");  
    session_unregister("cNote");
	session_unregister("cNote_vip");  
 	session_unregister("cIdcard"); 
 	session_unregister("cIdguard"); 
    $nRunno="";
    $vAN="";

    $cPtname="";
    $cPtright="";    
    $nVn="";
    $cAge="";
	$borow='';
    session_register("nRunno");  
    session_register("vAN");
    session_register("cHn");  
    session_register("cPtname");
    session_register("cPtright");
    session_register("cPtright1");
    session_register("nVn");  
    session_register("cAge");  
    session_register("cNote");
	session_register("cNote_vip");  
 	session_register("cIdcard");  
  	session_register("cIdguard");  

	// Reset new_vn
	$_SESSION['check_vn'] = null;

    include("connect.inc");
	
	if(isset($_GET["action"]) && $_GET["action"] == "hospcode"){
	
	$sql = "SELECT hospcode,hosptype,name  FROM hospcode WHERE  hospcode  like '".$_GET["search2"]."%' ";
	
	$result = Mysql_Query($sql)or die(Mysql_error());


	if(Mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
				<td ><font style=\"color: #FFFFFF\"><strong>���� þ.</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>���� þ.</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list3').innerHTML ='';\">�Դ</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
			

				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
						<td  align=\"center\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '".$arr["hospcode"].'-'.$arr["hosptype"].' '.$arr["name"]."';document.getElementById('list3').innerHTML ='';\">",$arr["hospcode"],"</A></td>
					<td>".$arr["hosptype"].' '.$arr["name"]."</td>	
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					
				</tr>
			";

		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
	
	
	
	if(isset($_GET["cHn"]) && $_GET["cHn"] != ""){
		$_SESSION["cHn"] = $_GET["cHn"];
	}
	


    $query = "SELECT * FROM opcard WHERE hn = '$cHn' limit 0,1";
    $result = mysql_query($query)or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
    if($result){
	//	$cRegisdate=$row->regisdate;
		$cIdcard =$row->idcard;
		$cMid=$row->mid;
		$cHn =$row->hn;
		$cYot=$row->yot;
		$cName=$row->name;
		$cSurname =$row->surname;
		$cEducation =$row->education;
		$cGoup =$row->goup;
		$cMarried =$row->married;
	//	$cCbirth (�ѹ�Դ��ͤ���������)
		$cCbirth =$row->cbirth; // (�ѹ�Դ��ͤ���������)
		$cDbirth =$row->dbirth;
		$cGuardian=$row->guardian;
		$cIdguard=$row->idguard;
		$cNation =$row->nation;
		$cReligion =$row->religion;
		$cCareer =$row->career;
		$cPtright =$row->ptright;
		$cPtright1 =$row->ptright1;
		//echo "==>$cPtright - $cPtright1";
		$cPtrightdetail=$row->ptrightdetail;
		$cAddress =$row->address;
		$cTambol =$row->tambol;
		$cAmpur =$row->ampur;
		$cChangwat =$row->changwat;
		$cPhone =$row->phone;
		$chPhone =$row->hphone;
		$cFather =$row->father;
		$cMother =$row->mother;
		$cCouple =$row->couple;
		$cNote=$row->note;
		$cNote_vip=$row->note_vip;
		$cSex =$row->sex;
		$cCamp =$row->camp;
		$cRace=$row->race;
		$cDrugreact=$row->drugreact;
		$cPtf=$row->ptf;
		$cPtfadd=$row->ptfadd;
		$cPtffone=$row->ptffone;

		$cPtfmon=$row->ptfmon;
		$cLastupdate=$row->lastupdate;
		$cBlood=$row->blood;
		$cPtright2 =$row->ptright2;
		$cHospcode=$row->hospcode;
		$typearea = $row->typearea;
		$vstatus = $row->vstatus;

		$cToborow = $row->toborow;

		//��Դ 19
		$cPrename=$row->prename;
		$cName_eng=$row->name_eng;
		$cSurname_eng =$row->surname_eng;
		$cPassport =$row->passport;	
		$cAddress_eng=$row->house_no;
		$cAddress_moo=$row->address_moo;
		$cAddress_soi=$row->address_soi;
		$cAddress_road=$row->address_road;
		$cTambol_eng =$row->tambol_eng;
		$cAmpur_eng =$row->ampur_eng;
		$cChangwat_eng =$row->changwat_eng;
		
		
		//echo substr($cPtright,1,3);
		if(substr($cPtright,0,3)=="R12"){  //��Сѹ�آ�Ҿ��ǹ˹��(���ԡ��)
			echo '<script>alert("�������Է�Ի�Сѹ�آ�Ҿ��ǹ˹��(���ԡ��)\��سҵ�Ǩ�ͺ�Է�ԡ���ѡ��\r\n���ͷ��ǹ����ѡ�Ҿ�Һ�������觵�͡���ѡ��仵��ѧ�Ѵ");</script>';
		}			
		
					
		
		if($cPtright=="R09 ��Сѹ�آ�Ҿ��ǹ˹��" && $cHospcode=="11512-�ç��Һ�� ��������ѡ��������"){
			echo "<script>alert('��سҵ�Ǩ�ͺ�Է�ԡ���ѡ�Ҽ�������¹����¤�Ѻ');</script>";
		}
		$employee = $row->employee;
		
		$hcode=explode("/",$cHospcode);
		$hcode1=$hcode[0];
		
		//$cCase=$row->case;
		//  2494-05-28
		$cD=substr($cDbirth,8,2);
		$cM=substr($cDbirth,5,2); 
		$cY=substr($cDbirth,0,4); 
  		$cD1=substr($cLastupdate,8,2);
		$cM1=substr($cLastupdate,5,2); 
		$cY1=substr($cLastupdate,0,4); 
		$cT1=substr($cLastupdate,11,8); 
	} 
  	else {
      	echo "��辺 HN : $cHn ";
	}  

//print "$cDbirth";

//print "<body bgcolor='#808080' text='#FFFFFF'>";

	if($cIdcard=="" || $cIdcard=="-"){
		$img=$cHn.'.jpg';
	}else{
		$img=$cIdcard.'.jpg';
	}

////////// ��Ǩ�ͺ��� ��.���ʹ��ҧ�����������
	$strsql="select * from accrued where hn = '$cHn' and status_pay='n' ";
	$strresult = mysql_query($strsql);
	$strrow=mysql_num_rows($strresult);
	
	if($strrow>0){
		echo "<script>alert('���������ʹ��ҧ����  ��سҵԴ�����ǹ���Թ�����') </script>";
		//echo "&nbsp;&nbsp;&nbsp<b><font style='font-weight:bold'><a target=BLANK  href='accrued_list.php?hn=$hnid'>���ʹ��ҧ����</a></b></font>";
	}
//////////////////////////////////////////
	
	$sql_chkname="SELECT  * FROM opcard where name='".$cName."' and surname='".$cSurname."' and hn !='". $cHn."' ";
	$result_chkname = mysql_query($sql_chkname);
	$rows=mysql_num_rows($result_chkname);
	$arr=mysql_fetch_array($result_chkname);

if($rows>0){	
?>
	<script>
		alert('�����ª��� <?=$arr[name];?> ���ʡ�� <?=$arr[surname];?> \n �����к�����¹ HN : <?=$arr[hn];?>');
    </script>
    <?
	echo"<span style=\"background-color: #FFFFCC\"><FONT SIZE='5' COLOR='red'>����͹</FONT><br>";
	echo"<FONT SIZE='4' COLOR='red'>�����ª���  $arr[name]  $arr[surname] �����к�����¹  (HN :: $arr[hn])</FONT><br>";
	echo"<FONT SIZE='4' COLOR='red'>��سҵ�Ǩ�ͺ������</FONT><span>";
	}
?>

<SCRIPT LANGUAGE='JavaScript'>
	function checkID(){
		var stat = true;
		var id13 = document.f1.idcard.value;
		var sum = 0;

		if(id13 != "" && id13 != "-"){
			if(id13.length != 13){
				alert("�Ţ�ѵû�ЪҪ� �Ҵ�����Թ 13 ��ѡ");
				stat = false;
			}
			if(stat == true){
				
				// https://goo.gl/yaX3FN
				for (i = 0; i < 12; i++){
					sum += parseFloat(id13.charAt(i))*(13-i);
				}

				var sum_mod = sum%11;
				var pre_digit = 1;
				if(sum_mod>1){
					pre_digit = 11;
				}
				var new_sum = pre_digit-sum_mod;
				if( new_sum != parseFloat(id13.charAt(12)) )
					if(confirm("�к���Ǩ�ͺ��Ҥس��͡�Ţ�ѵû�ЪҪ����١��ͧ \n �س��ͧ��á�Ѻ�����������?"))
						stat = false;
					else
						stat = true;
			}
		}
		
		return stat;
	}
	
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

function searchSuggest2(str,len,getto1) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'opedit.php?action=hospcode&search2=' + str+'&getto1=' + getto1

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list3").innerHTML = xmlhttp.responseText;
		}
}
	</SCRIPT>

<?php
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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

	if($cYot=="�.�."||$cYot=="�.�."||$cYot=="�硪��"||$cYot=="��˭ԧ"){
		$agechk = substr(calcage($cDbirth),0,2);
		if($agechk>=15){
		?>
		<script>
        	alert("���ؤú 15 �� ��س�����¹�ӹ�˹�Ҫ��ʹ��¤�");
        </script>
		<?
		}
	}
	$cPtname=$cYot." ".$cName." ".$cSurname;
	
	if(substr($cPtright,0,3)=='R07'){
		$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			$color = "#339966";
		}else{
			$color = "#FF0033";
		}
	}else if(substr($cPtright,0,3)=='R03'){
		$sql = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			$color = "#339966";
		}else{
			$color = "#FF0033";
		}
	}else{
		$color = "#339966";
	}
?>
<body bgcolor='<?=$color;?>' text='#3300FF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
<h3 align="center" class="fonttitle">�Ǫ����¹ / MEDICAL RECORD</h3>
<h3 align="center" class="fonttitle">�ç��Һ�Ť�������ѡ��������  �ӻҧ</h3>
<form name='f1' method='POST' action='opwork.php' onsubmit='return checkForm();' enctype="multipart/form-data">
<fieldset>
    <legend>�����Ż���ѵ���ǹ��� :  HN : <a href="printpt.php" target="_blank"><font color="#FF0000"><?=$cHn;?></font></a></legend>
<table width="100%" border="0">
  <tr>
    <td width="15%" align="center">
<a href='Capture1.php?id=<?=$cIdcard;?>&hn=<?=$cHn;?>&yot=<?=$cYot;?>&name1=<?=$cName;?>&name2=<?=$cSurname;?>' target=_blank>
    <IMG SRC='../image_patient/<?=$img;?>' WIDTH='100' HEIGHT='150' BORDER='0' ALT=''></a></td>
    <td width="85%" valign="top">
    	<table border="0">
      	<tr style="vertical-align:top;">
        <td align="right"  class="fonthead">�ӹ�˹��:</td>
        <td>
			<div style="position: relative;">
				<input name="yot" type="text" id="yot" value="<?=$cYot;?>" class="notify43">
				<div><a href="javascript:void(0);" class="fonthead" style="color:#a67a42;" onClick="check_yot()">���ʹ�˹�Ҫ��� ��з�ǧ��Ҵ��</a></div>

				<div id="res_yot" style="position: absolute; top: 0; left: 0; background-color: #ffffff; z-index: 1; padding: 4px; display: none;">
					<div id="close_res_yot" style="text-align: center; background-color: #bbbbbb;" onClick="close_res_yot()">[�Դ˹�ҵ�ҧ]</div>
					
					<table style="width:600px;">
						<tr>
							<td colspan="4">���Ҥӹ�˹�� : <input type="text" id="search_res_yot"></td>
						</tr>
						<tr>
							<th>������</th>
							<th>��������´</th>
							<th></th>
						</tr>
						<?php 
						$sql_prefix = "SELECT * FROM `f43_person_1`";
						$q = mysql_query($sql_prefix);
						if($q!==false)
						{
							$pref_i = 0;
							while ($pref = mysql_fetch_assoc($q)) {
								$mod = ( ($pref_i % 2) == 0 ) ? 'style="background-color: #bbbbbb;"' : '';
								?>
								<tr <?=$mod;?> class="find_my_prefix" data-prefix="<?=$pref['detail'];?>">
									<td><?=$pref['abbreviations'];?></td>
									<td><?=$pref['detail'];?></td>
									<td><a href="javascript:void(0)" style="color: #a67a42;" data-prefix-selected="<?=$pref['abbreviations'];?>" class="prefix-selected">���͡</a></td>
								</tr>
								<?php
								$pref_i++;
							}
							
						}
						?>
					</table>
				</div>
			</div>
		</td>
        <td align="right" class="fonthead">����:</td>
        <td> 
          <input name="name" type="text" id="name" value="<?=$cName;?>" size="15" class="notify43">        </td>
        <td align="right" class="fonthead">ʡ��:</td>
        <td> 
          <input name="surname" type="text" id="surname" value="<?=$cSurname;?>" size="15" class="notify43">        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      	<tr>
      	  <td align="right" bgcolor="#CCE9FD"  class="fonttitle">Prename:</td>
      	  <td bgcolor="#CCE9FD" class="fonttitle"><span style="position: relative;">
      	    <input name="prename" type="text" id="prename" value="<?=$cPrename;?>" size="5" >
      	  </span></td>
      	  <td align="right" bgcolor="#CCE9FD" class="fonttitle">Name:</td>
      	  <td bgcolor="#CCE9FD" class="fonttitle"><input name="name_eng" type="text" id="name_eng" value="<?=$cName_eng;?>" size="15" ></td>
      	  <td align="right" bgcolor="#CCE9FD" class="fonttitle">Surname:</td>
      	  <td bgcolor="#CCE9FD" class="fonttitle"><input name="surname_eng" type="text" id="surname_eng" value="<?=$cSurname_eng;?>" size="15"></td>
      	  <td><span class="style1">***</span></td>
      	  <td>&nbsp;</td>
      	  <td>&nbsp;</td>
      	  <td>&nbsp;</td>
      	  <td>&nbsp;</td>
    	  </tr>
      <tr>
        <td align="right" class="fonthead">��:</td>
        <td> 
          <select size="1" name="sex" id="sex">
            <option value="">���͡</option>
            <option <? if($cSex=='�' ||$cSex=='1' ){ echo "selected"; }?> value="�">���</option>
            <option <? if($cSex=='�' ||$cSex=='2' ){ echo "selected"; }?> value="�">˭ԧ</option>
          </select>        </td>
        <td colspan="3" align="right" class="fonthead">�����Ţ��Шӵ�ǻ�ЪҪ�:</td>
        <td> 
          <input name="idcard" type="text" id="idcard" value="<?=$cIdcard;?>" size="15" maxlength="13" <? if(!empty($cIdcard) && $cIdcard != '-'){ echo "readonly";}?> class="notify43">        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td align="right" class="fonthead">&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="3" align="right" class="fonthead">�Ţ��� Passport:</td>
        <td><input name="passport" type="text" id="passport" value="<?=$cPassport;?>" size="15" maxlength="13" <? if(!empty($cIdcard) && $cIdcard != '-'){ echo "readonly";}?>></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="fonthead">�ѹ�Դ:</td>
        <td colspan="10" class="fonthead"> 
            <input type='text' id="birth_d" name='d' size='2' value='<?=$cD;?>' maxlength='2' class="notify43">
            <input type='text' id="birth_m" name='m' size='2' value='<?=$cM;?>' maxlength='2' class="notify43">
            <input type='text' id="birth_y" name='y' size='4' value='<?=$cY;?>' maxlength='4' class="notify43">
          ���ͪҵ�: <select size="1" name="race" id="race">
            <option value=""><-���͡-></option>
            <option  value="��"<? if($cRace=='��'){ echo "selected";}?> >��</option>
            <option value="�չ"<? if($cRace=='�չ'){ echo "selected";}?> >�չ</option>
            <option value="���"<? if($cRace=='���'){ echo "selected";}?>  >���</option>
            <option value="����"<? if($cRace=='����'){ echo "selected";}?> >����</option>
            <option  value="����٪�"<? if($cRace=='����٪�'){ echo "selected";}?>>����٪�</option>
            <option  value="�Թ���"<? if($cRace=='�Թ���'){ echo "selected";}?>>�Թ���</option>
            <option value="���´���"<? if($cRace=='���´���'){ echo "selected";}?> >���´���</option>
            <option value="����" <? if($cRace=='����'){ echo "selected";}?> >����</option>
            </select>
            �ѭ�ҵ�: 
            <select size="1" name="nation" id="nation">
            <option value=""><-���͡-></option>
            <option  value="��"<? if($cNation=='��'){ echo "selected";}?> >��</option>
            <option value="�չ"<? if($cNation=='�չ'){ echo "selected";}?> >�չ</option>
            <option value="���"<? if($cNation=='���'){ echo "selected";}?> >���</option>
            <option value="����"<? if($cNation=='����'){ echo "selected";}?> >����</option>
            <option value="����٪�"<? if($cNation=='����٪�'){ echo "selected";}?> >����٪�</option>
            <option value="�Թ���"<? if($cNation=='�Թ���'){ echo "selected";}?> >�Թ���</option>
            <option value="���´���"<? if($cNation=='���´���'){ echo "selected";}?> >���´���</option>
            <option value="����"<? if($cNation=='����'){ echo "selected";}?> >����</option>
            </select>
              ��ʹ�: 
            <select size="1" name="religion" id="religion">
            <option value=""><-���͡-></option>
            <option value="�ط�"<? if($cReligion=='�ط�'){ echo "selected";}?>>�ط�</option>
            <option value="���ʵ�"<? if($cReligion=='���ʵ�'){ echo "selected";}?>>���ʵ�</option>
            <option value="������"<? if($cReligion=='������'){ echo "selected";}?>>������</option>
			<option value="�������-�Թ��"<? if($cReligion=='�������-�Թ��'){ echo "selected";}?>>�������-�Թ��</option>
			<option value="�ԡ��"<? if($cReligion=='�ԡ��'){ echo "selected";}?>>�ԡ��</option>
            <option value="����"<? if($cReligion=='����'){ echo "selected";}?>>����</option>
            </select>        </td>
        </tr>
      <tr>
        <td align="right" class="fonthead">ʶҹ�Ҿ:</td>
        <td> 
		<select size="1" name="married" id="married">
			<option value=""><-���͡-></option>
            <option value="�ʴ" <? if($cMarried=='�ʴ'){ echo "selected";}?>>�ʴ</option>
            <option value="����" <? if($cMarried=='����'){ echo "selected";}?>>����</option>
            <option value="�����" <? if($cMarried=='�����'){ echo "selected";}?>>�����</option>
            <option value="����" <? if($cMarried=='����'){ echo "selected";}?>>����</option>
            <option value="�¡" <? if($cMarried=='�¡'){ echo "selected";}?>>�¡</option>
            <option value="����" <? if($cMarried=='����'){ echo "selected";}?>>����</option>
            <option value="����" <? if($cMarried=='����'){ echo "selected";}?>>����</option>
		</select>        </td>
        <td class="fonthead">�Ҫվ:</td>
        <td colspan="3"> 
        <select size="1" name="career" id="career">
			<option value='<?=$cCareer;?>' selected><?=$cCareer;?></option>
			<option value=""><-���͡-></option>
			<option value="01 �ɵá�"<? if($cCareer=='01 �ɵá�'){ echo "selected";}?>>01 �ɵá�</option>
			<option value="02 �Ѻ��ҧ�����"<? if($cCareer=='02 �Ѻ��ҧ�����'){ echo "selected";}?>>02 �Ѻ��ҧ�����</option>
            <option value="03 ��ҧ�����" <? if($cCareer=='03 ��ҧ�����'){ echo "selected";}?>>03 ��ҧ�����</option>
            <option value="04 ��áԨ"<? if($cCareer=='04 ��áԨ'){ echo "selected";}?>>04 ��áԨ</option>
            <option value="05 ����/���Ǩ"<? if($cCareer=='05 ����/���Ǩ'){ echo "selected";}?>>05 ����/���Ǩ</option>
            <option value="06 �ѡ�Է���ҵ����йѡ෤�ԡ"<? if($cCareer=='06 �ѡ�Է���ҵ����йѡ෤�ԡ'){ echo "selected";}?>>06 �ѡ�Է���ҵ����йѡ෤�ԡ</option>
            <option value="07 �ؤ�ҡô�ҹ�Ҹ�ó�آ"<? if($cCareer=='07 �ؤ�ҡô�ҹ�Ҹ�ó�آ'){ echo "selected";}?>>07 �ؤ�ҡô�ҹ�Ҹ�ó�آ</option>
            <option value="08 �ѡ�ԪҪվ/�ѡ�Ԫҡ��"<? if($cCareer=='08 �ѡ�ԪҪվ/�ѡ�Ԫҡ��'){ echo "selected";}?>>08 �ѡ�ԪҪվ/�ѡ�Ԫҡ��</option>
            <option value="09 ����Ҫ��÷����"<? if($cCareer=='09 ����Ҫ��÷����'){ echo "selected";}?>>09 ����Ҫ��÷����</option>
            <option value="10 �Ѱ����ˡԨ"<? if($cCareer=='10 �Ѱ����ˡԨ'){ echo "selected";}?>>10 �Ѱ����ˡԨ</option>
            <option value="11 ��������������Ҫվ"<? if($cCareer=='11 ��������������Ҫվ'){ echo "selected";}?>>11 ��������������Ҫվ</option>
            <option value="12 �ѡ�Ǫ/�ҹ��ҹ��ʹ�"<? if($cCareer=='12 �ѡ�Ǫ/�ҹ��ҹ��ʹ�'){ echo "selected";}?>>12 �ѡ�Ǫ/�ҹ��ҹ��ʹ�</option>
            <option value="13 ����"<? if($cCareer=='13 ����'){ echo "selected";}?>>13 ����</option>
		</select>        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="fonthead">�дѺ����֡��</td>
        <td colspan="5"><select name="education" id="education" class="notify43">
            <option value="">----- ��س����͡������ -----</option>
            <?
        $sql="select * from education order by row_id asc";
		$query=mysql_query($sql);
		while($rows=mysql_fetch_array($query)){
			if($cEducation==$rows["edu_code"]){
		?>
            <option value="<?=$rows["edu_code"];?>" selected="selected">
              <?=$rows["edu_code"]."-".$rows["edu_name"];?>
              </option>
            <?
			}else{
		?>
            <option value="<?=$rows["edu_code"];?>">
              <?=$rows["edu_code"]."-".$rows["edu_name"];?>
              </option>
            <?
			}
		}
		?>
          </select>
  &nbsp;<span style="color:#FF0000">***</span> </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="right" class="fonthead">�����Ţ��Шӵ�Ƿ���</td>
        <td colspan="4" class="fonthead"><input name="mid" type="text" id="mid" value="<?=$cMid;?>" size="15" maxlength="13"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <p><input type="file" name="filUpload"><!---style="display: none; -->
		  <!--<input name="tmpPath" type="text" value="D:\image_patient\<?//=$cIdcard;?>.jpg" size="50" readonly>
		  <strong><a href="#" onClick="filUpload.click();tmpPath.value=filUpload.value;" class="fonttitle">���͡���</a></strong>-->
    </p>
      <input type="hidden" name="cIdcard" value="<?=$cIdcard;?>"></td>
  </tr>
  </table>

</fieldset>
<BR>
<fieldset>
    <legend>�����š�õԴ���:</legend>
        
<table border="0" align="center">
  <tr>
    <td align="right" class="fonthead"> ��ҹ�Ţ���:</td>
    <td><input type="text" name="address" size="10" value="<?=$cAddress;?>"></td>
    <td align="right" class="fonthead">�Ӻ�:</td>
    <td><input type="text" name="tambol" size="10" value="<?=$cTambol;?>"></td>
    <td align="right" class="fonthead">�����:</td>
    <td><input type="text" name="ampur" size="10"  value="<?=$cAmpur;?>"></td>
    <td align="right" class="fonthead">�ѧ��Ѵ:</td>
    <td><input type="text" name="changwat" size="10" value="<?=$cChangwat;?>"></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCE9FD" class="fonthead">&nbsp;</td>
    <td colspan="7" bgcolor="#CCE9FD">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCE9FD" class="fonttitle">�����������ѧ���</td>
    <td colspan="7" bgcolor="#CCE9FD" class="fonttitle"><span class="style1">***</span></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#CCE9FD" class="fonttitle">House No:</td>
    <td bgcolor="#CCE9FD" class="fonttitle"><input name="address_eng" type="text" id="address_eng" value="<?=$cAddress_eng;?>" size="10"></td>
    <td align="right" bgcolor="#CCE9FD" class="fonttitle">Moo:</td>
    <td bgcolor="#CCE9FD" class="fonttitle"><input name="address_moo" type="text" id="address_moo" value="<?=$cAddress_moo;?>" size="10"></td>
    <td align="right" bgcolor="#CCE9FD" class="fonttitle">Soi:</td>
    <td bgcolor="#CCE9FD" class="fonttitle"><input name="address_soi" type="text" id="address_soi" value="<?=$cAddress_soi;?>" size="10"></td>
    <td align="right" bgcolor="#CCE9FD" class="fonttitle">Road:</td>
    <td bgcolor="#CCE9FD" class="fonttitle"><input name="address_road" type="text" id="address_road" value="<?=$cAddress_road;?>" size="10"></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCE9FD" class="fonttitle">Sub-District:</td>
    <td bgcolor="#CCE9FD" class="fonttitle"><input name="tambol_eng" type="text" id="tambol_eng" value="<?=$cTambol_eng;?>" size="10"></td>
    <td align="right" bgcolor="#CCE9FD" class="fonttitle">District:</td>
    <td bgcolor="#CCE9FD" class="fonttitle"><input name="ampur_eng" type="text" id="ampur_eng"  value="<?=$cAmpur_eng;?>" size="10"></td>
    <td align="right" bgcolor="#CCE9FD" class="fonttitle">Province:</td>
    <td bgcolor="#CCE9FD" class="fonttitle"><input name="changwat_eng" type="text" id="changwat_eng" value="<?=$cChangwat_eng;?>" size="10"></td>
    <td align="right" bgcolor="#CCE9FD" class="fonttitle">&nbsp;</td>
    <td bgcolor="#CCE9FD" class="fonttitle">&nbsp;</td>   
  </tr>
  <tr>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">���Ѿ���ҹ:</td>
    <td><input type="text" name="hphone" size="10" value="<?=$chPhone;?>" id="hphone"></td>
    <td align="right" class="fonthead">��Ͷ��:</td>
    <td><input type="text" name="phone" size="10" value="<?=$cPhone;?>"></td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">�Դ�:</td>
    <td> 
      <input type="text" name="father" size="15" value="<?=$cFather;?>">    </td>
    <td align="right" class="fonthead">��ô�:</td>
    <td> 
      <input type="text" name="mother" size="15" value="<?=$cMother;?>" >    </td>
    <td align="right" class="fonthead">�������:</td>
    <td> 
      <input type="text" name="couple" size="15" value="<?=$cCouple;?>">    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php /* ?>
  <tr>
    <td align="right" class="fonthead">�Ţ���ѵû�ЪҪ��Դ�:</td>
    <td> 
      <input type="text" name="idcard_father" size="13" value="">
    </td>
    <td align="right" class="fonthead">�Ţ���ѵû�ЪҪ���ô�:</td>
    <td> 
      <input type="text" name="idcard_mother" size="13" value="" >
    </td>
    <td align="right" class="fonthead">�Ţ���ѵû�ЪҪ��������:</td>
    <td> 
      <input type="text" name="idcard_couple" size="13" value="">
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php */ ?>
  <tr>
    <td align="right" class="fonthead">���������ö�Դ�����:</td>
    <td>
      <input type='text' name="ptf" size='15'  value="<?=$cPtf;?>">    </td>
    <td align="right" class="fonthead">����Ǣ�ͧ��:</td>
    <td><input type='text' name="ptfadd" size='10'  value="<?=$cPtfadd;?>"></td>
    <td align="right" class="fonthead">���Ѿ��:</td>
    <td>
      <input type='text' name="ptffone" size='10'  value="<?=$cPtffone;?>">    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
	<td align="right" class="fonthead">ʶҹкؤ��</td>
	<td colspan="5">
		<?php 
		$typearea_list = array(
			1 => '�ժ�������������¹��ҹ�ࢵ�Ѻ�Դ�ͺ��������ԧ',
			2 => '�ժ�������������¹��ҹ�ࢵ�Ѻ�Դ�ͺ������������ԧ',
			3 => '������������ࢵ�Ѻ�Դ�ͺ�����¹��ҹ����͡ࢵ�Ѻ�Դ�ͺ',
			4 => '������������͡ࢵ�Ѻ�Դ�ͺ���������Ѻ��ԡ��',
			5 => '��������ࢵ�Ѻ�Դ�ͺ�����������������¹��ҹ�ࢵ�Ѻ�Դ�ͺ �� �������͹ ����շ��ѡ����� �繵�'
		);
		?>
		<select name="typearea" id="typearea" class="notify43">
			<option value="">-- ���͡������ ʶҹкؤ�� --</option>
			<?php
			foreach ($typearea_list as $key => $item) { 

				$type_selected = ( $key == $typearea ) ? 'selected="selected"' : '' ;
				?>
				<option value="<?=$key;?>" <?=$type_selected;?>><?=$item;?></option>
				<?php
			}
			?>
		</select>	</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
  </tr>
</table>    
</fieldset>
<BR>
<fieldset>
    <legend>�������Է�ԡ���ѡ��:</legend>
    <table  border="0" align="center">
  <tr>
    <td align="right" class="fonthead">������:</td>
    <td><!--<select size="1" name="goup" id="goup">
<option value="<?//=$cGoup;?>" selected><?//=$cGoup;?></option>
<option value="G11 �.1 ��·��û�Шӡ��">G11 �.1 ��·��û�Шӡ��</option>
<option value="G12 �.2 ����Ժ  �ŷ��û�Шӡ��">G12 �.2 ����Ժ  �ŷ��û�Шӡ��</option>
<option value="G13 �.3 ����Ҫ��á����������͹">G13 �.3 ����Ҫ��á����������͹</option>
<option value="G14 �.4 �١��ҧ��Ш�">G14 �.4 �١��ҧ��Ш�</option>
<option value="G15 �.5 �١��ҧ���Ǥ���">G15 �.5 �١��ҧ���Ǥ���</option>
<option value="G21 �.1 �Ժ��� �ŷ��áͧ��Шӡ��">G21 �.1 �Ժ��� �ŷ��áͧ��Шӡ��</option>
<option value="G22 �.2 �ѡ���¹����">G22 �.2 �ѡ���¹����</option>
<option value="G23 �.3 ������Ѥ÷��þ�ҹ">G23 �.3 ������Ѥ÷��þ�ҹ</option>
<option value="G24 �.4 �ѡ�ɷ���">G24 �.4 �ѡ�ɷ���</option>
<option value="G31 �.1 ��ͺ���Ƿ���">G31 �.1 ��ͺ���Ƿ���</option>
<option value="G32 �.2 ���ù͡��Шӡ��">G32 �.2 ���ù͡��Шӡ��
<option value="G33 �.3 �ѡ�֡���Ԫҷ���(ô)">G33 �.3 �ѡ�֡���Ԫҷ���(ô)</option>
<option value="G34 �.4 ���Ѳ������ͧ">G34 �.4 ���Ѳ������ͧ</option>
<option value="G35 �.5 �ѵû�Сѹ�ѧ��">G35 �.5 �ѵû�Сѹ�ѧ��
<option value="G36 �.6 �ѵ÷ͧ30�ҷ">G36 �.6 �ѵ÷ͧ30�ҷ</option>
<option value="G37 �.7 ����Ҫ��þ����͹(�ԡ���ѧ�Ѵ)">G37 �.7 ����Ҫ��þ����͹(�ԡ���ѧ�Ѵ)</option>
<option value="G38 �.8 �����͹(����ԡ���ѧ�Ѵ)">G38 �.8 �����͹(����ԡ���ѧ�Ѵ)</option>
<option value="G39 �.9 ��������к�">G39 �.9 ��������к�
</select>-->

     <select name="goup" id="goup">
        <option  selected="selected" value="0" >-------------------------���͡-------------------------</option>
        <?
						include("connect.inc");
						$query = "SELECT * 
						FROM `grouptype` 
						WHERE `status` = 'y'
						ORDER BY type ASC,`row_id` ASC";
						$result = mysql_query($query);
						while($tbrows=mysql_fetch_assoc($result)){
						$code = substr($cGoup,0,3);
							if($tbrows['code'] == $code){
		?>
                        <option value="<?=$tbrows['name'];?>" selected="selected">
                        <?=$tbrows['name']?>
                        </option>
                        <?
								}else{
					     ?>
                        <option value="<?=$tbrows['name'];?>" >
                        <?=$tbrows['name']?>
                        </option>
    					<?
                                 }
						  }
						?>
      </select></td>
    <td align="right" class="fonthead">�ѧ�Ѵ:</td>
    <td><!--<select size="1" name="camp" id="camp">
      <option value="<?//=$cCamp;?>" selected><?//=$cCamp;?></option>
      <option value="M01 �����͹">�����͹</option>
      <option value="M02 �.17 �ѹ2">�.17 �ѹ2</option>
      <option value="M03 ���ŷ��ú����32">���ŷ��ú����32</option>
      <option value="M04 �.�.��������ѡ��������">�.�.��������ѡ��������</option>
      <option value="M05 �.�ѹ4">�.�ѹ4</option>
      <option value="M06 ���½֡ú����ɻ�еټ�">���½֡ú����ɻ�еټ�</option>
      <option value="M0301 ��.���.32">��.���.32</option>
      <option value="M0302 ���.���.32">���.���.32</option>
      <option value="M0303 ���.,���.���.32">���.,���.���.32</option>
      <option value="M0304 �¡.���.32">�¡.���.32</option>
      <option value="M0305 ���.���.32">���.���.32</option>
      <option value="M0306 ���.���.32">���.���.32</option>
      <option value="M0307 ���.���.32">���.���.32</option>
      <option value="M0308 ���.���.32">���.���.32</option>
      <option value="M0309 �ʡ.���.32">�ʡ.���.32</option>
      <option value="M0310 ����.���.32">����.���.32</option>
      <option value="M0311 ���.���.32">���.���.32</option>
      <option value="M0312 ͡.��� ���.32">͡.��� ���.32</option>
      <option value="M0313 ����.���.32">����.���.32</option>
      <option value="M0314 ���.���.32">���.���.32</option>
      <option value="M0315 �Ȩ.���.32">�Ȩ.���.32</option>
      <option value="M0316 ����.���.32">����.���.32</option>
      <option value="M0317 ʢ�.���.32">ʢ�.���.32</option>
      <option value="M0313 è.���.32">è.���.32</option>
      <option value="M0318 ���.���.32">���.���.32</option>
      <option value="M0319 ��.���.32">��.���.32</option>
      <option value="M0320 ���.���.32">���.���.32</option>
      <option value="M0321 ����.��.���.32">����.��.���.32</option>
      <option value="M0322 ��.��.���.32">��.��.���.32</option>
      <option value="M0323 �ʾ.���.32">�ʾ.���.32</option>
      <option value="M0324 ��þ���ѧ ���.32">��þ���ѧ ���.32</option>
      <option value="M0325 Ƚ.�ȷ.���.32">Ƚ.�ȷ.���.32</option>
      <option value="M0326 ���.���.32">���.���.32</option>
      <option value="M0327 �ٹ�����Ѿ�� ���.32">�ٹ�����Ѿ�� ���.32</option>
      <option value="M0328 ���.���.32">���.���.32</option>
      <option value="M08 ��ʴըѧ��Ѵ�ӻҧ">��ʴըѧ��Ѵ�ӻҧ</option>
      <option value="M09 ��.��ѧ ʻ.��">��.��ѧ ʻ.��</option>
      <option value="M10 ��� ��.33">��� ��.33</option>
      <option value="M07 ˹��·�������">˹��·�������</option>
    </select>-->
		<SELECT NAME="camp" id="camp">
		<option value="<?=$cCamp;?>" selected><?=$cCamp;?></option>
		<option value=""><-���͡-></option>
      <? 
		$sqlcamp="SELECT * FROM `camp` order by row_id";
		$querycamp=mysql_query($sqlcamp)or die (mysql_error());
		while($arrcamp=mysql_fetch_array($querycamp)){
			if($cCamp==$arrcamp['name']){
		  ?>
			<option value="<?=$arrcamp['name']?>" selected> <?=$arrcamp['name']?></option>
      <? }else{ ?>
			<option value="<?=$arrcamp['name']?>"><?=$arrcamp['name']?></option>
      <? 
	  		}
		}
	  ?>
		</select>    </td>
    </tr>
    <tr>
    <td align="right" class="fonthead">�Է�ԡ���ѡ��</td>
    <td>
	<select size="1" name="ptright1" id="ptright1">
    <?

	//////////////////////////////////����Ѿഷ�Է�ԻѨ�غѹ//////////////////////////////////////
	/*
	if($cIdcard !="" || $cIdcard !="-"){
		if(substr($cPtright1,0,3)=='R03'||substr($cPtright1,0,3)=='R07'){
			$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			?>
				<option  value="R07 ��Сѹ�ѧ��" selected>R07 ��Сѹ�ѧ��</option>
			<?
			}else{
				$sql55 = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
				if(Mysql_num_rows(Mysql_Query($sql55)) > 0){
				?>
					<option  value="R03 �ç����ԡ���µç" selected>R03 �ç����ԡ���µç</option>
				<?
				}else{
				?>
					<option  value="0" selected>��س����͡�Է�ԡ���ѡ��</option>
				<?
				}
			}
		}else{
			$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			?>
				<option  value="R07 ��Сѹ�ѧ��" selected>R07 ��Сѹ�ѧ��</option>
			<?
			}else{
				$sql55 = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
				if(Mysql_num_rows(Mysql_Query($sql55)) > 0){
				?>
					<option  value="R03 �ç����ԡ���µç" selected>R03 �ç����ԡ���µç</option>
				<?
				}else{
				?>
					<option  value="<?=$cPtright1;?>" selected><?=$cPtright1;?></option>
				<?
				}
			}
		}
	}  // if check idcard
	?>
		<option  value="<?=$cPtright1;?>" selected><?=$cPtright1;?></option>
	<?
	*/
	/*******/////////////////////////////////////////////////////////////////////////////////**********/
	
	// ������ѡ�ҡ ptright1
	$ptCode = substr($cPtright1, 0, 3);

	// ������ ssodata �ʴ������ ���
	$q = mysql_query("SELECT id FROM ssodata WHERE id LIKE '$cIdcard%' LIMIT 1 ");
	$sso_row = mysql_num_rows($q);
	if( $sso_row > 0 ){
		$ptCode = 'R07';
	
	}else{

		// �������� ��� ��� cscd (�ԡ���µç)
		$sql_cscd = "SELECT hn, status 
		FROM cscddata 
		WHERE hn = '$cHn' 
		AND ( status LIKE '%U%' OR status = '\r' OR status LIKE '%V%' )  
		LIMIT 1 ";
		$q = mysql_query($sql_cscd);
		$cscd_row = mysql_num_rows($q);
		if( $cscd_row > 0 ){
			$ptCode = 'R03';
		}
	}

	include("connect.inc");
	$sql = "Select * From ptright Order by code ASC ";
	$result = mysql_query($sql) or die(mysql_error());
	while(list($ptright_code, $ptright_name) = mysql_fetch_row($result)){

		$full_ptright = "$ptright_code $ptright_name";

		$select = ( $ptright_code == $ptCode ) ? 'selected="selected"' : '' ;

		?>
		<option value='<?=$full_ptright;?>' <?=$select;?>><?=$full_ptright;?></option>
		<?php
	}
	?>
    </select>    
	</td>
    <td class="fonthead">�������Է�� :</td>
    <td><select name="ptrightdetail" size="1" id="ptrightdetail">
      <option  value="<?=$cPtrightdetail;?>" selected><?=$cPtrightdetail;?></option>
      <option value="" ><-���͡-></option>
<?php
		$sqlptr = "Select * From  ptrightdetail Order by code ASC ";
		$resultptr = mysql_query($sqlptr) or die(mysql_error());
		while(list($ptrcode, $ptrname) = mysql_fetch_row($resultptr)){
			if($cPtrightdetail==$ptrname){
				print " <option value='$ptrname' selected>$ptrname</option>";
			}else{
				print " <option value='$ptrname'>$ptrname</option>";	
			}
		}
?>
    </select></td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">�ԡ�ҡ:</td>
    <td><select   size="1" name="ptfmon" id="ptfmon">
      <option value="<?=$cPtfmon;?>" selected><?=$cPtfmon;?></option>
      <option value="" ><-���͡-></option>
      <option value="MO01 ���ͧ">MO01 ���ͧ</option>
      <option value="MO02 �Դ�">MO02 �Դ�</option>
      <option value="MO03 ��ô�">MO03 ��ô�</option>
      <option value="MO04 �ص�">MO04 �ص�</option>
      <option value="MO05 �������">MO05 �������</option>
    </select></td>
    <td class="fonthead">˹��§ҹ :</td>
    <td><input type='text' name="guardian" size='20'  value="<?=$cGuardian;?>" id="guardian"></td>
    <td align="right" class="fonthead"></td>
    <td>&nbsp;</td>
    </tr>
	<tr>
		<td class="fonthead"><label for="employee">�١��ҧ þ.�����</label></td>
	  <td colspan="3"><?php
			$checked = ( $employee === 'y' ) ? 'checked="checked"' : '' ;
			?>
			<input type="checkbox" id="employee" name="employee" value="y" <?=$checked;?>>
			<span class="fonthead" style="color:#FF3366;">(������١��ҧ þ.����� ������͡ check box ����)</span>		</td>
	  </tr>
    </table>

</fieldset>
<BR>
<?php 
$disabtype_list = array(
  1 => '�����ԡ�÷ҧ������',
  2 => '�����ԡ�÷ҧ������Թ���͡�����ͤ�������',
  3 => '�����ԡ�á������͹������ͷҧ��ҧ���',
  4 => '�����ԡ�÷ҧ�Ե����;ĵԡ��������ͷ�ʵԡ',
  5 => '�����ԡ�÷ҧʵԻѭ��',
  6 => '�����ԡ�÷ҧ������¹���',
  7 => '�����ԡ�÷ҧ�ͷ�ʵԡ'
);

$disabcause_list = array(
  1 => '�����ԡ������Դ',
  2 => '�����ԡ�èҡ��úҴ��',
  3 => '�����ԡ�èҡ�ä'
);


$q = mysql_query("SELECT * FROM `disabled_user` WHERE `hn` = '$cHn' ");
$dis = mysql_fetch_assoc($q);

?>
<fieldset>
	<legend>�����ż��ԡ��:</legend>
		<table>
			<tr style="vertical-align: top;">
				<td class="fonthead" width="25%" align="right">�Ţ����¹���ԡ��(DISABID):</td>
				<td width="25%">
					<input type="text" name="disabid" id="disabid" value="<?=$dis['disabid'];?>">
				</td>
				<td class="fonthead" width="25%" align="right">����������آ�Ҿ(ICF):</td>
				<td width="25%">
					<div>
						<input type="text" name="icf" id="icf" value="<?=$dis['icf'];?>">
					</div>
					<span class="fonthead" id="btn_show_icf" style="color: #a67a42;">�ʴ���������´������</span>
				</td>
			</tr>
			</tr>
				<td class="fonthead" align="right">�����������ԡ��(DISABTYPE):</td>
				<td>
					<select name="disabtype" id="">
					<?php
					foreach ($disabtype_list as $key => $dis) {

						$selected = ( $key == $dis['disabtype'] ) ? 'selected="selected"' : '' ;

						?>
						<option value="<?=$key;?>" <?=$selected;?> ><?=$key.'.'.$dis;?></option>
						<?php
					}
					?>
					</select>
				</td>
				<td class="fonthead" align="right">���˵ؤ����ԡ��(DISABCAUSE):</td>
				<td>
					<select name="disabcause" id="">
					<?php
					foreach ($disabcause_list as $key => $dis) {

						$selected = ( $key == $dis['disabcause'] ) ? 'selected="selected"' : '' ;

						?>
						<option value="<?=$key;?>" <?=$selected;?> ><?=$key.'.'.$dis;?></option>
						<?php
					}
					?>
					</select>
				</td>
			</tr>
		</table>
	<div id="icf_res" style="position:relative;"></div>
	<div id="icf_static" style="display: none;">
		<?php 
		$q = mysql_query("SELECT * FROM `icf_icf`");
		?>
		<div class="close_icf_static" style="text-align: center; background-color: #ffb3b3;"><b>[�Դ]</b></div>
		<div style="position: absolute; background-color: #ffffff; border: 1px solid #000000; width: 100%;">
			<table class="chk_table" style="width: 100%; color: #000000;">
			<tr>
				<th width="5%">����</th>
				<th>��������´</th>
			</tr>
			<?php 
			while( $item = mysql_fetch_assoc($q) ){
					?>
					<tr valign="top">
						<td class="icf_code" item-data="<?=$item['id'];?>"><?=$item['id'];?></td>
						<td><?=$item['detail'];?></td>
					</tr>
					<?php
			}
			?>
			</table>
		</div>
	</div>
</fieldset>
<br>
<fieldset>
    <legend>������ ����:</legend>
    
    
    <table  border="0" align="center" width="100%">
  <tr>
    <td align="right" class="fonthead">��������ʹ</td>
    <td><SELECT NAME="blood" id="blood">
     <option value="<?=$cBlood;?>"><?=$cBlood;?> </option>
      <option value="����Һ�������ʹ" <? if($cBlood=='����Һ�������ʹ'){ echo "selected";}?> >����Һ�������ʹ</option>
      <option value="����µ�Ǩ�������ʹ " <? if($cBlood=='����µ�Ǩ�������ʹ'){ echo "selected";}?> >����µ�Ǩ�������ʹ </option>
      <option value="��"<? if($cBlood=='��' || $cBlood=='A' ){ echo "selected";}?>>��</option>
      <option value="��" <? if($cBlood=='��' || $cBlood=='B' ){ echo "selected";}?>>��</option>
      <option value="�ͺ�" <? if($cBlood=='�ͺ�' || $cBlood=='AB' ){ echo "selected";}?>>�ͺ�</option>
      <option value="��" <? if($cBlood=='��' || $cBlood=='O' ){ echo "selected";}?>>��</option>
    </SELECT></td>
    <td class="fonthead">����<div id="list3" style="position: absolute;"></div></td>
    <td class="fonthead"><INPUT TYPE="text" NAME="drugreact" id="drugreact" value="<?=$cDrugreact;?>">  
 
<input name="rdo1" type="checkbox"  id="rdo1" value="30 �ҷ" <? if($cPtright=="R09 ��Сѹ�آ�Ҿ��ǹ˹��"){ echo "checked"; }?>> 
30 �ҷ
<input name="rdo1" type="checkbox" id="rdo2" value="��." <? if($cPtright=="R07 ��Сѹ�ѧ��"){ echo "checked"; }?>> 
��Сѹ�ѧ��  
      þ.���ѧ�Ѵ
<INPUT NAME="hospcode" TYPE="text" id="hospcode" onKeyPress="searchSuggest2(this.value,3,'hospcode');" size="40" value="<?=$cHospcode;?>">    </td>
    </tr>
  <tr>
    <td align="right" class="fonthead">�����˵�</td>
    <td><select size="1" name="idguard" id="idguard">
            <option  selected="selected" value="0" >--------------------���͡--------------------</option>
            <?
						include("connect.inc");
						$query = "SELECT * from guardtype order by guard_id asc";
						$result = mysql_query($query);
						while($tbrows=mysql_fetch_assoc($result)){
						$cIdguard = substr($cIdguard,0,4);
							if($tbrows['guard_code'] == $cIdguard){
		?>
            <option value="<?=$tbrows['guard_name'];?>" selected="selected">
            <?=$tbrows['guard_name']?>
            </option>
            <?
								}else{
					     ?>
            <option value="<?=$tbrows['guard_name'];?>" >
            <?=$tbrows['guard_name']?>
            </option>
            <?
                                 }
						  }
						?>
          </select></td>
    <td class="fonthead">�����˵�</td>
    <td><input type="text" name="note" size="50" value="<?=$cNote;?>" id="note"></td>
    </tr>
  <tr>
    <td align="right" class="fonthead">Note VIP</td>
    <td><input type="text" name="note_vip" size="50" value="<?=$cNote_vip;?>" id="note_vip"></td>
    <td class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>    
	<?php /* ?>
	<tr>
		<td align="right" class="fonthead">ʶҹ�㹪����</td>
		<td>
		<?php 
		$vstatus_list = array(
			'1' => '�ӹѹ ����˭��ҹ',
			'2' => '���.',
			'3' => 'ᾷ���ШӵӺ�',
			'4' => '��Ҫԡͺ�. / �Ⱥ��',
			'5' => '����'
		);
		?>
		<select name="vstatus" id="">
			<option value="">-- ���͡������ --</option>
			<?php
			foreach ($vstatus_list as $key => $vitem) {
				$selected = ( $key == $vstatus ) ? 'selected="selected"' : '' ;
				?><option value="<?=$key;?>" <?=$selected;?> ><?=$vitem;?></option><?php 
			}
			?>
		</select>
		</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php */ ?>
    </table>

</fieldset>
<BR>
<fieldset>
<legend>��س����͡��¡�� ���ͷ�����ʶԵԼ����� ������͡�Է�Ԣͧ������㹡���ѡ��</legend>
<?
////////////////  ��Ǩ�ͺ����������Ҫ����������
$time=date("H:i:s");

if($time >='16:00:00'){
	$cktime='selected';
}
?>
<table width="100%" border="0">
  <tr>
    <td align="right" class="fonthead">�͡ OPD CARD </td>
    <td colspan="2" class="fonthead"><!--<?//=$time;?>--> <select  id='case1' name='case'>
<?

$today = date("d-m-Y");
$d=substr($today,0,2);
$m=substr($today,3,2);
$yr=substr($today,6,4) +543;  
//  $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
$thdatehn=$d.'-'.$m.'-'.$yr.$_SESSION["cHn"]; 

$sql = "Select toborow From opday where thdatehn = '".$thdatehn."' and  hn = '".trim($_GET["cHn"])."' order by thidate DESC limit 1 ";
$result = Mysql_Query($sql);
list($toborow) = Mysql_fetch_row($result);
	
$querytype = "select * from typeopcard where status != 'z' ";
$rows = mysql_query($querytype) or die (mysql_error());
while(list($rid,$typename,$typestatus)= mysql_fetch_array($rows)){
	?>
	<option value='<?=$typename?>' <? if($toborow==$typename) echo "selected";?>><?=$typename?></option>
    <?
}

?>
</select>&nbsp;&nbsp;���ͼ����� : <input type='text' name='borow' size='30' value='<?=$borow;?>'> </td>
    <td class="fonthead">�Է�ԡ���ѡ�һѨ�غѹ</td>
    <td class="fonthead">
    <input type="checkbox" value="lock" name="lockptright5" <? if($cPtright2!="") echo "checked";?>> (LOCK)&nbsp;
    <select  name='ptright' id="ptright">
    <?
	//////////////////////////////////����Ѿഷ�Է�ԻѨ�غѹ//////////////////////////////////////
if($cPtright2==""){
	if($cIdcard !="" || $cIdcard !="-"){
	if(substr($cPtright1,0,3)=='R03' || substr($cPtright1,0,3)=='R07'){
		$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
		?>
			<option  value="R07 ��Сѹ�ѧ��" selected>R07 ��Сѹ�ѧ��</option>
		<?
		}else{
			$sql55 = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql55)) > 0){
			?>
				<option  value="R03 �ç����ԡ���µç" selected>R03 �ç����ԡ���µç</option>
			<?
			}else{
			?>
				<option  value="0" selected>��س����͡�Է�ԡ���ѡ��</option>
				<script>alert('�������ա������¹�ŧ�Է��� \n��س����͡�Է��������������¹�ŧ������� OPD CARD ���¤�');</script>
			<?
			}
		}
	}else{
		$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
		?>
			<option  value="R07 ��Сѹ�ѧ��" selected>R07 ��Сѹ�ѧ��</option>
		<?
		}else{
			$sql55 = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql55)) > 0){
			?>
				<option  value="R03 �ç����ԡ���µç" selected>R03 �ç����ԡ���µç</option>
			<?
			}else{
			?>
				<option  value="<?=$cPtright;?>" selected><?=$cPtright;?></option>
			<?
			}
		}
	}
	}else{
	?>
	<option value='<?=$cPtright1;?>' selected><?=$cPtright1;?></option>
	<?	
	}
}else{
	?>
	<option value='<?=$cPtright2;?>' selected><?=$cPtright2;?></option>
	<?
}
	/*******/////////////////////////////////////////////////////////////////////////////////**********/
?>
<!-- <option value='<?=$cPtright;?>' selected><?=$cPtright;?></option>
 <option value='0' ><-���͡�Է�ԡ���ѡ��-></option>-->
<?
$sql = "Select * From ptright where status !='n' Order by code ASC ";
$result = mysql_query($sql);
while(list($ptright_code, $ptright_name) = mysql_fetch_row($result)){
	print " <option value='{$ptright_code}&nbsp;{$ptright_name}' >{$ptright_code}&nbsp;{$ptright_name}</option>";
}
?>
</select></td>
  </tr>
  <tr>
    <td align="right" class="fonthead">��Һ�ԡ�ù͡�����Ҫ���</td>
    <td class="fonthead1"><input name="doctor80" type="checkbox" value="doctor80">
��Һ�ԡ�÷ҧ���ᾷ�� 80 �ҷ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="doctor50" type="checkbox" value="doctor50">
��Һ�ԡ�÷ҧ���ᾷ�� 50 �ҷ</td>
    <td colspan="3" class="fonthead">**�Ҥ����ش���� <?=$cD1;?>-<?=$cM1;?>-<?=$cY1;?> <?=$cT1;?> **</td>
    </tr>
  <tr>
    <td height="37" align="right" valign="top" class="fonthead">��Һ�ԡ�õ�Ǩ�آ�Ҿ</td>
    <td valign="top" class="fonthead1"><input name="chkup50" type="checkbox" value="chkup50">
��Һ�ԡ�õ�Ǩ�آ�Ҿ��Сѹ�ѧ�� þ.����  50 �ҷ</td>
    <td colspan="3" valign="top" class="fonthead">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">��Һ�ԡ�÷���</td>
    <td class="fonthead1"><div><input name="E-DRESS" type="checkbox" value="E-DRESS-S">
��Һ�ԡ�÷��� Size S  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;70 �ҷ</div>
<div><input name="E-DRESS" type="checkbox" value="E-DRESS-M">
��Һ�ԡ�÷��� Size M  &nbsp;&nbsp;140 �ҷ</div>
<div><input name="E-DRESS" type="checkbox" value="E-DRESS-L">
��Һ�ԡ�÷��� Size L&nbsp;&nbsp;&nbsp;  270 �ҷ</div></td>
    <td colspan="3" class="fonthead">&nbsp;</td>
  </tr>  
</table>

</fieldset>
<br>
<?php
// ������ opday �� thdatehn ����������ѧ
$sql = "SELECT COUNT(`row_id`) AS `crow_id` 
FROM `opday` 
WHERE `thdatehn` = '".$thdatehn."' 
LIMIT 0,1 ";
$result = Mysql_Query($sql);
list($rows) = Mysql_fetch_row($result);
if($rows > 0){ // ������ʴ������ŧ����¹��ѹ�������

	// <Option value=\"\">----------------</Option>
	// <Option value=\"1\">�͡ VN ����</Option>
	print "<BR><span style=\"background-color: #FFFFCC\"><FONT SIZE=\"3\" COLOR=\"red\">��������ŧ����¹��ѹ������� ����͡ VN ����㹡óշ�����ѡ�Ҥ�������ء����
	<SELECT NAME=\"new_vn\">
		<Option value=\"0\">�� VN ���</Option>
	</SELECT>";
	
	$sql = "Select date_format(thidate,'%d-%m-%Y %H:%i:%s'),toborow,kew,vn From opday where hn = '".trim($_GET["cHn"])."' ORder by thidate DESC limit 1 ";
	$result = Mysql_Query($sql);
	list($thidate,$toborow,$kew,$vn) = Mysql_fetch_row($result);
	echo "<BR>&nbsp;&nbsp;&nbsp;**�Ҥ����ش���������&nbsp; ".$thidate."&nbsp;VN&nbsp;".$vn."&nbsp;��&nbsp;".$toborow."&nbsp;&nbsp;���Ƿ��&nbsp;".$kew."</FONT></span>";

}else{
	print "<INPUT TYPE=\"hidden\" name=\"new_vn\" value=\"1\">";
}
//////////////////////////////


$list_month["01"] ="���Ҥ�";
$list_month["02"] ="����Ҿѹ��";
$list_month["03"] ="�չҤ�";
$list_month["04"] ="����¹";
$list_month["05"] ="����Ҥ�";
$list_month["06"] ="�Զع�¹";
$list_month["07"] ="�á�Ҥ�";
$list_month["08"] ="�ԧ�Ҥ�";
$list_month["09"] ="�ѹ��¹";
$list_month["10"] ="���Ҥ�";
$list_month["11"] ="��Ȩԡ�¹";
$list_month["12"] ="�ѹ�Ҥ�";

$today2 = date("d")." ".$list_month[date("m")]." ".(date("Y")+543); 

$sql = "SELECT a.*
FROM `appoint` AS a
RIGHT JOIN (
	SELECT MAX(`row_id`) AS `row_id` 
	FROM `appoint` 
	WHERE `hn` = '$cHn' 
	AND `appdate` = '$today2' 
	GROUP BY `doctor` 
) AS b ON b.`row_id` = a.`row_id` 
WHERE a.`apptime` != '¡��ԡ��ùѴ'";

$query = mysql_query($sql);
$appoint_num = mysql_num_rows($query);
if( $appoint_num > 0){
	echo "<span style=\"background-color: #FF0000\">
	<B>
	<FONT SIZE=\"5\"  COLOR=\"#CCFFFF\">
	<BR>&nbsp;&nbsp;&nbsp;�������չѴ�ѹ����Ѻ&nbsp;&nbsp;&nbsp;
	</FONT>
	</B>
	</span>";
}

if(substr($cPtright,0,3)=='R07'){
			$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			echo "<div style=\"background-color: #0033CC; height: 30px;\"><B><FONT SIZE=\"5\"  COLOR=\"#FFFF00\">&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�ҡ�Է�Լ��������Է�Ի�Сѹ�ѧ��&nbsp;&nbsp;&nbsp;</FONT></B></div>";
			}else{
				echo "<span style=\"background-color: #FF0000\"><B><FONT SIZE=\"5\"  COLOR=\"#0033CC\"><BR>&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�ҡ�Է�Լ���������Է�Ի�Сѹ�ѧ��&nbsp;&nbsp;&nbsp;</FONT></B></span>";
			}
		}else if(substr($cPtright,0,3)=='R03'){
			$sql = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			echo "<div style=\"background-color: #0033CC; height: 30px;\"><B><FONT SIZE=\"5\"  COLOR=\"#FFFF00\">&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�ҡ�Է�Լ��������Է����µç&nbsp;&nbsp;&nbsp;</FONT></B></div>";
			}else{
				echo "<span style=\"background-color: #FF0000\"><B><FONT SIZE=\"5\"  COLOR=\"#0033CC\"><BR>&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�ҡ�Է�Լ���������Է�Ԩ��µç&nbsp;&nbsp;&nbsp;</FONT></B></span>";
			}
		}else{
			$color = "66CDAA";
		}


if(!empty($cIdcard)){
	$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
	if(Mysql_num_rows(Mysql_Query($sql)) > 0){
		echo"<FONT SIZE='5' COLOR='#0000FF'><BR>&nbsp;&nbsp;��Ǩ�ͺ�ҹ�����ż��������Է�Ի�Сѹ�ѧ��</FONT>";
	}else{
		echo"<FONT SIZE='5' COLOR='#FF3366'><BR>&nbsp;&nbsp;��Ǩ�ͺ�ҹ�����ż�����������Է�Ի�Сѹ�ѧ��</FONT>";
	}
	
	$sql1 = "Select Idcard From gsbdata where Idcard LIKE '$cIdcard%' limit 1 ";
	if(Mysql_num_rows(Mysql_Query($sql1)) > 0){
		echo"<FONT SIZE='5' COLOR='#0000FF'><BR>&nbsp;&nbsp;��Ǩ�ͺ�ҹ�����ż��������Է�Ը�Ҥ������Թ</FONT>";
	}else{
		echo"<FONT SIZE='5' COLOR='#FF3366'><BR>&nbsp;&nbsp;��Ǩ�ͺ�ҹ�����ż�����������Է�Ը�Ҥ������Թ</FONT>";
	}
	
	$sql2 = "Select emp_idcard From botdata where emp_idcard LIKE '$cIdcard%' limit 1 ";
	if(Mysql_num_rows(Mysql_Query($sql2)) > 0){
		echo"<FONT SIZE='5' COLOR='#0000FF'><BR>&nbsp;&nbsp;��Ǩ�ͺ�ҹ�����ż��������Է�Ը�Ҥ����觻������</FONT>";
	}else{
		echo"<FONT SIZE='5' COLOR='#FF3366'><BR>&nbsp;&nbsp;��Ǩ�ͺ�ҹ�����ż�����������Է�Ը�Ҥ����觻������</FONT>";
	}
			
}else{
	echo"<FONT SIZE='5' COLOR='#FF3366'><BR>&nbsp;&nbsp;��Ǩ�ͺ�ҹ�����ż�����������Ţ��Шӵ�ǻ�ЪҪ�</FONT>";
}


if(!empty($cHn)){
$sql = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";			
if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				echo"<FONT SIZE='5' COLOR='#0000FF'><BR>&nbsp;&nbsp;��Ǩ�ͺ�ҹ�����ż��������Է�Ԩ��µç</FONT><br>";
			}else{
				echo"<FONT SIZE='5' COLOR='#FF3366'><BR>&nbsp;&nbsp;��Ǩ�ͺ�ҹ�����ż�����������Է�Ԩ��µç</FONT><br>";
			}
	}else{
			echo"<FONT SIZE='5' COLOR='#FF3366'>&nbsp;&nbsp;��Ǩ�ͺ�ҹ�����ż���������� HN</FONT><br>";
		}

if(substr($cPtright,0,3)=="R12" || substr($cPtright,0,3)=="R13" || substr($cPtright,0,3)=="R14" || substr($cPtright,0,3)=="R36"){
	echo"<FONT SIZE='5' COLOR='#FFCC66'>&nbsp;&nbsp;��سҵ�Ǩ�ͺ�Է�ԡ���ѡ�� ���ͷ��ǹ����ѡ�Ҿ�Һ�������觵�͡���ѡ��仵��ѧ�Ѵ</FONT><br>";
}





/*
if(substr($cPtright,0,3)=='R07'){
$sql = "Select id From ssodata where id LIKE '$cIdcard%' ";
if(Mysql_num_rows(Mysql_Query($sql)) > 0){
echo "<span style=\"background-color: #0033CC\"><B><FONT SIZE=\"5\"  COLOR=\"#FFFF00\">&nbsp;&nbsp;&nbsp;���������Է�Ի�Сѹ�ѧ��&nbsp;&nbsp;&nbsp;</FONT></B></span>";
}else{echo "<span style=\"background-color: #FF0000\"><B><FONT SIZE=\"5\"  COLOR=\"#0033CC\">&nbsp;&nbsp;&nbsp;������������Է�Ի�Сѹ�ѧ��&nbsp;&nbsp;&nbsp;</FONT></B></span>";
}
}
*/
		$sqlg3="SELECT * FROM `admit` where hn='$cHn' and D_UPDATE like '".date("Y-m-d")."%' order by row_id desc limit 1";

		$queryg3=mysql_query($sqlg3) or die (mysql_error());
		$arrg3=mysql_num_rows($queryg3);

		if($arrg3>0){
			$arrg4=mysql_fetch_array($queryg3);
			?>
			<script>
			window.open('admit_print.php?row_id=<?=$arrg4['row_id']?>','','');
            </script>
			<?
		}

?>
<p align="center">
<input type='submit' value='   �ѹ�֡ / ŧ����¹   ' name='B1' style="height:50px;">
</p>
<!--<p align="center">
<input type="button" value=" ��Ǩ�ͺ�Է�� �.����Թ " onclick="window.location.href='gsb_chk.php' " style="height:50px;"  />&nbsp;&nbsp;&nbsp;
<input type="button" value=" ��Ǩ�ͺ�Է�� ���. " onclick="window.location.href='bot_chk.php' " style="height:50px;"  />&nbsp;&nbsp;&nbsp;
</p>
-->
</td>
 </tr>
</table>
</form>
<?
//substr($cPtright,0,3)=='R07';

if(substr($cPtright,0,3)!=substr($cPtright1,0,3)){
	?>
	<script>alert('���������Է�����ѡ�Ѻ�Է����ͧ���ç�ѹ\n��سҵ�Ǩ�ͺ�Է������ѡ�Ңͧ������');</script>
    <?
}
?>
<SCRIPT LANGUAGE="JavaScript">



function checkForm(){
		
		var stat = true;
		var stat2 = true;


		var birth_d = document.getElementById('birth_d');
		var birth_m = document.getElementById('birth_m');
		var birth_y = document.getElementById('birth_y');

		stat2 = checkID();
		if(document.f1.new_vn.value == ''){
			
			alert("��������ŧ����¹���� ��س����͡��ҵ�ͧ����� VN ��� ���� �͡ VN ���� ���¤�Ѻ");
			return false;

		} else if( birth_d.value.length < 2 ){

			alert("�ٻẺ�ѹ������١��ͧ ��سҵ�Ǩ�ͺ�ա���� \n������ҧ�ٻẺ�ѹ��� �� 05 �繵�");
			birth_d.focus();
			return false;
		
		} else if( birth_m.value.length < 2 ){

			alert("�ٻẺ��͹���١��ͧ ��سҵ�Ǩ�ͺ�ա���� \n������ҧ�ٻẺ��͹ �� 02 �繵�");
			birth_m.focus();
			return false;

		} else if( birth_y.value.length < 4 ){

			alert("�ٻẺ�����١��ͧ ��سҵ�Ǩ�ͺ�ա���� \n������ҧ�ٻẺ�� �� 2561 �繵�");
			birth_y.focus();
			return false;

		}else if(document.f1.ptright1.value == '0'||document.f1.ptright.value == '0'){
			
			alert("��س����͡�Է�ԡ���ѡ�Ҵ��¤�Ѻ");
			if(document.f1.ptright1.value == '0') {document.f1.ptright1.focus();}
			else if(document.f1.ptright.value == '0') {document.f1.ptright.focus();}
			return false;
		}else if(document.f1.education.value == ''){		
			alert("��س����͡�дѺ����֡�Ҵ��¤�Ѻ ���ͤ�������ó�ͧ 43 ���");			
			document.f1.education.focus();
			return false;
		}else if(document.f1.typearea.value == ''){		
			alert("��س����͡ʶҹкؤ�Ŵ��¤�Ѻ ���ͤ�������ó�ͧ 43 ���");			
			document.f1.typearea.focus();
			return false;
		}else{	
			if(stat2 == true){
				var ex = document.getElementById('case1').value;
				ex = ex.substr(0,4);
				<?php 
				$sql = "Select distinct part From doctor_off  where date_off = '".(date("Y")+543).date("-m-d")."' ";
				$result = Mysql_Query($sql);
				while($arr = Mysql_fetch_assoc($result)){
					
					echo "if(ex == '".$arr["part"]."' ) stat = false; \n";
				}
				?>
				if(stat == false)
					alert(document.getElementById('case1').value+" ����յ�Ǩ�ѹ����Ѻ");
					return stat;
				}else{
					return stat2;
				}
		}
		
}
</SCRIPT>

<?php 

// if($ptCode == 'R45' && $toborowCode == 'EX52')
if(preg_match("/(kiosk)/", strtolower($cNote)) > 0)
{
	?>
	
	<div style="position:absolute; top: 0; left: 0;" id="notify_c19_kiosk">
		<div style="position: relative;border: 1px solid blue;color: #000;text-align: center;background-color: #ffffe6; width: 400px;">
			<div style="position:absolute;top: 0;right: 0;background-color: #9c9c9c;padding: 3px;" onClick="do_notify_c19_kiosk()">[�Դ]</div>
			<div>
				<p><b>!!!!!! ����͹ !!!!!</b><br>�������ա��ŧ����¹���µ������<br>��سҷ��ǹ�Է��㹡���ѡ��</p>
			</div>
		</div>
	</div>
	<script type='text/javascript'>
		alert("!!!!!! ����͹ !!!!!\n�������ա��ŧ����¹���µ������\n��سҷ��ǹ�Է��㹡���ѡ��");
		function do_notify_c19_kiosk(){
			document.getElementById("notify_c19_kiosk").style.display = 'none';
		}
	</script>
	<?php
}

include 'includes/ajax.php';
?>
<script type="text/javascript">

function check_yot(){
	document.getElementById('res_yot').style.display = '';
}

function close_res_yot(){
	document.getElementById('res_yot').style.display = 'none';
}

</script>

<script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
		jQuery.noConflict();
		(function( $ ) {
		$(function() {

				var icf_list = [];

				<?php 
				$q = mysql_query("SELECT * FROM `icf_icf`");
				$i = 0; 

				while( $item = mysql_fetch_assoc($q) ){
						?>
						var myObj = new Object();
						myObj.code = '<?=$item['id'];?>';
						myObj.detail = '<?=$item['detail'];?>';
						icf_list[<?=$i;?>] = myObj; 
						<?php
						$i++;
				}
				?>

				$(document).on('keyup', '#icf', function(){
						var search_txt = $(this).val();
						$('#icf_static').hide();
						if( search_txt.length > 3 ){

								var regex1 = new RegExp(search_txt,'g');

								var htm = '';
								htm += '<div class="close-icf" style="text-align: center; background-color: #ffb3b3;"><b>[�Դ]</b></div>';
								htm += '<div style="position: absolute; background-color: #ffffff; border: 1px solid #000000; width: 100%;">';
								htm += '<table class="chk_table" style="width: 100%;">';
								htm += '<tr>';
								htm += '<th width="5%">����</th>';
								htm += '<th>��������´</th>';
								htm += '</tr>';

								for (var index = 0; index < icf_list.length; index++) {

										var icf_item = icf_list[index];
										var element = icf_item.detail;
										var icf_code = icf_item.code;

										if( regex1.test(element) == true ){
												htm += '<tr valign="top">';
												htm += '<td class="icf_code" item-data="'+icf_code+'">'+icf_code+'</td>';
												htm += '<td>'+element+'</td>';
												htm += '</tr>';
										}
								}

								htm += '</table>';
								htm += '</div>';
								
								$("#icf_res").html(htm);
								$('#icf_res').show();
						}

				});

				// ��Ƿ��ਹ�ҡ js
				$(document).on('click', '.close-icf', function(){ 
						$('#icf_res').hide();
				});

				$(document).on('click', '.icf_code', function(){
						var code = $(this).attr('item-data');
						$('#icf').val(code);
						$('#icf_res').hide();
						$('#icf_static').hide();
				});


				// ��Ƿ��ਹ�ҡ php
				$(document).on('click', '#btn_show_icf', function(){
					$('#icf_res').hide();
					$('#icf_static').toggle();
				})
				$(document).on('click', '.close_icf_static', function(){
					$('#icf_static').hide();
				});
				


			// input ���Ҥӹ�˹�Ҫ���
			$(document).on('keyup', '#search_res_yot', function(){
				var search_key = this.value;
				var patt = new RegExp("("+search_key+")");
				if(search_key.length < 3)
				{
					return;
				}

				for (var index = 0; index < $('.find_my_prefix').length; index++) {
					var find_item = $('.find_my_prefix')[index];
					var data_value = $(find_item).attr('data-prefix');
					if(patt.test(data_value)!==true)
					{
						$(find_item).hide();
					}
					else
					{
						$(find_item).show();
					}
				}

			});

			// ��ԡ���͡�ӹ�˹�Ҫ���
			$(document).on('click', '.prefix-selected', function(){ 
				var prefix = $(this).attr('data-prefix-selected');
				document.getElementById('yot').value = prefix;
				document.getElementById('res_yot').style.display = 'none';
			});

		});
		})(jQuery);
</script>


<?php
print "</body>";
include("unconnect.inc");
?>