<?php
//Update 31 ��. 53 bbm
session_start();

if(isset($_GET["action"]) && $_GET["action"] != ""){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");

if(isset($_GET["action"]) && $_GET["action"] != ""){
	
	$sql = "Select CONCAT( `yot` , ' ', `name` , ' ', `surname` ) AS `full_name` From opcard where hn = '".$_GET["action"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($fullname) = Mysql_fetch_row($result);
	
	echo $fullname;
exit();
}

?>
<html>
<head>
<title>�Ѵ������</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 16 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>

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

function checkname(hn) {
	
	var hn_value = "";

			url = 'appoint2.php?action='+hn;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			hn_value = xmlhttp.responseText;
	
	return hn_value;

}

	function add_hn(){
		var hn_true = "";

		hn_true = checkname(document.getElementById('hn').value);
		if(hn_true.length <= 4){
			alert("����������Ţ HN "+document.getElementById('hn').value);
		}else if(hn_true.length > 4){
			document.getElementById('list_hn').innerHTML = document.getElementById('list_hn').innerHTML + "<INPUT TYPE=\"checkbox\" name=\"list_hn[]\" value=\""+document.getElementById('hn').value+"\" checked>&nbsp;"+document.getElementById('hn').value + " "+hn_true+"<BR>";
			document.getElementById("hn").select();
		}

	}

</SCRIPT>

</head>
<body>

&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm">&lt;&lt; ����</a>&nbsp&nbsp;&nbsp<a target=_self  href='appoint2.php'>&lt;&lt;��������͡㺹Ѵ����</a>&nbsp;&nbsp;&nbsp;<a target="_blank"  href='appoilst.php'>����ª��ͼ����¹Ѵ</a>

<TABLE width="100%" align="center">
<TR valign="top">
	<TD align="center">
	
	<TABLE  border="1" bordercolor="#3366FF">
<TR>
	<TD>

<TABLE>
<TR>
	<TD align="right">
	HN : 
	</TD>
	<TD>
	<INPUT TYPE="text" ID="hn" NAME="hn" onkeypress = "if(event.keyCode == 13){ add_hn(); }">
	</TD>
</TR>
<TR>
	<TD colspan="2" align="center">
		<INPUT TYPE="button" value="��ŧ" Onclick="add_hn();">
	</TD>
</TR>
</TABLE>

</TD>
</TR>
</TABLE>


<?php

	$sql = "Select distinct hn, ptname  From appoint where officer in (Select name From inputm where menucode in (Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' )) Order by row_id DESC limit 20";
	//$result = @Mysql_Query($sql);
	//if(@Mysql_num_rows($result) > 0){
	$result = 0;
	if($result > 0){
?>

<TABLE  border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE>
<?php
while(list($hn,$ptname) = Mysql_fetch_row($result)){	

 echo "
 <TR>
	<TD>
	 <A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('hn').value='".$hn."';add_hn(); \">",$hn,"</A>
	</TD>
	<TD>
	",$ptname,"
	</TD>
</TR>
 ";
 
 
 }?>

</TABLE>
</TD>
</TR>
</TABLE>

<?php } ?>
	</TD>
	<TD align="center">


<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		
		var stat = true;
		
		if(document.getElementById('list_hn').innerHTML == ""){
			alert("��سҡ�͡ HN ");
			stat = false;
		}else if(document.f1.doctor.value == ""){
			alert("��س����͡ᾷ����Ѵ");
			stat = false;
		}else if(document.f1.appdate.value == "" || document.f1.appmo.value == ""){
			alert("��س����͡�ѹ���Ѵ������");
			stat = false;
		}

	return stat;

	}

</SCRIPT>
<FORM Name="f1" METHOD=POST ACTION="appoint2_2.php" Onsubmit="return checkForm();">
	
<TABLE  border="1" bordercolor="#3366FF">
<TR>
	<TD>
<TABLE>
<TR bgcolor="#3366FF">
	<TD colspan="2" align="center" class="font_title">�����¹Ѵ</TD>
</TR>
<TR valign="top">
	<TD align="right">HN : </TD>
	<TD><DIV ID="list_hn"></Div></TD>
</TR>
<TR>
	<TD align="right">ᾷ�� : </TD>
	<TD>
	<? 
	 $strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>
   </TD>
</TR>
<TR>
	<TD align="right">�Ѵ�ѹ��� : </TD>
	<TD>
<select size="1" name="appdate"  id="aLink">
<option value="" selected>--�ѹ���--</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>  
<select size="1" name="appmo">
<option value="" selected>--��͹--</option>
	<?php

	// $months = array('���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');
	
	$def_fullm_th = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
	'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
	'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');
	$def_month = date('m');
	foreach ($def_fullm_th as $key => $month) {
		$selected = ( $key == $def_month ) ? 'selected="selected"' : '' ;
		?>
		<option value="<?=$month;?>" <?=$selected;?>><?=$month;?></option>
		<?php
	}
	?>
</select>
<select size="1" name="thiyr">
<?php for($i=date("Y")+542;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>

</select>
   </TD>
</TR>
<TR>
	<TD align="right">���� : </TD>
	<TD>
	<select size="1" name="capptime">
	 <?php if($_SESSION["sIdname"]== '�ѧ���'  || $_COOKIE["until"] == "�ѧ���"){
		  if(empty($_COOKIE["until"])){
		 @setcookie("until", "�ѧ���", time()+(3600*12));
	   }
	   ?>
		<option value="07:30 �. - 08:00 �.">07:30 �. - 08:00 �.</option>
		<option value="08:30 �. - 09:00 �.">08:30 �. - 09:00 �.</option>
		<option value="09:30 �. - 10:00 �.">09:30 �. - 10:00 �.</option>
		<option value="10:30 �. - 11:00 �.">10:30 �. - 11:00 �.</option>
		<option value="11:30 �. - 12:00 �.">11:30 �. - 12:00 �.</option>
		<option value="12:30 �. - 13:00 �.">12:30 �. - 13:00 �.</option>
		<option value="15:30 �. - 16:00 �.">15:30 �. - 16:00 �.</option>
		<option value="16:30 �. - 17:00 �.">16:30 �. - 17:00 �.</option>
		<option value="17:30 �. - 18:00 �.">17:30 �. - 18:00 �.</option>
		<option value="18:30 �. - 19:00 �.">18:30 �. - 19:00 �.</option>

	 <?php }else{ ?>
		<option>08:00 �. - 11.00 �.</option>
		<option>07:00 �.</option>
		<option>07:30 �.</option>
		<option>08:00 �.</option>
		<option>08:30 �.</option>
		<option>09:00 �.</option>
		<option>09:30 �.</option>
		<option>10:00 �.</option>
		<option>10:30 �.</option>
		<option>11:00 �.</option>
		<option>11:30 �.</option>
		<option>13:00 �.</option>
		<option>13:30 �.</option>
		<option>14:00 �.</option>
		<option>14:30 �.</option>
		<option>15:00 �.</option>
		<option>15:30 �.</option>
		<option>16:00 �.</option>
		<option>16:30 �.</option>
		<option>17:00 �.</option>
		<option>17:30 �.</option>
		<option>18:00 �.</option>
		<option>18:30 �.</option>
		<option>19:00 �.</option>
		<option>19:30 �.</option>
		<option>20:00 �.</option>
		<option>21:00 �.</option>
		<?php } ?>
   </select>
   </TD>
</TR>
<TR>
	<TD align="right">���㺹Ѵ��� : </TD>
	<TD>
	<select size="1" name="room">
		<option>�ش��ԡ�ùѴ��� 1</option>
		<option>�ش��ԡ�ùѴ��� 2</option>
		<option>Ἱ�����¹</option>
		<option>��ͧ�ء�Թ</option>
		<option>�ͧ�ѹ�����</option>
		<option>Ἱ���Ҹ��Է��</option>
		<option>Ἱ��͡�����</option>
		<option>�ͧ�ٵ�-����</option>
		<option>����Ҿ</option>
		<option>��չԡ�ѧ���</option>
		<option>�ǴἹ��</option>
		<option>��ͧ�����</option>
		<option>Ἱ��ѧ���</option>
		<option>Ἱ��ѡ��</option>
		<option>OPD �Ǫ��ʵ���鹿�</option>
        <option>��Թԡ�ä�</option>
        <option>����Ҿ�ӺѴ���2</option>
        <option>��ͧ��Ъ��1</option>
   </select>
   </TD>
</TR>
<TR>
	<TD align="right">�Ѵ������ : </TD>
	<TD>
		<select size="1" name="detail">
			<!--<option value="FU01 ��Ǩ����Ѵ">��Ǩ����Ѵ</option>
			<option value="FU02 ����ŵ�Ǩ">����ŵ�Ǩ</option>
			<option value="FU03 �͹�ç��Һ��">�͹�ç��Һ��</option>
			<option value="FU04 �ѹ�����">�ѹ�����</option>
			<option value="FU05 ��ҵѴ">��ҵѴ</option>
			<option value="FU06 �ٵ�">�ٵ�</option>
			<option value="FU07 ��չԡ�ѧ���">��չԡ�ѧ���</option>
			<option value="FU08 Echo">Echo</option>
			<option value="FU09 ��š�д١">��š�д١</option>
			<option value="FU10 ����Ҿ">����Ҿ</option>
			<option value="FU11 ��Ǩ����Ѵ���������ѵԼ������"-->
			<?
			
			$app = "select * from applist where status='Y' ";
	 		$row = mysql_query($app);
	 		while($result = mysql_fetch_array($row)){
		  		$str="";
				if($result['applist']=="��Ǩ����Ѵ���������ѵԼ������"){
					$sql1 = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
					$result1 = Mysql_Query($sql1);
					$arr = Mysql_fetch_row($result1);
					
					if($arr[0] == "ADMICU" || $arr[0] == "ADMWF" || $arr[0] == "ADMVIP" || $arr[0] == "ADMOBG"){
							$str= "  Selected  ";
					}
				}
?>
      	<option value="<?=$result['appvalue']?>" <?=$str;?>><?=$result['applist']?></option>
        
		<?
				}
		?>
			<!--��Ǩ����Ѵ���������ѵԼ������</option>
			<option value="FU12 �ǴἹ��">�ǴἹ��</option>
			<option value="FU13 ��ͧ������">��ͧ������</option>
			<option value="FU14 ������ʹ��辺ᾷ��">������ʹ��辺ᾷ��</option>
			<option value="FU15 OPD �͡����">OPD �͡�����Ҫ���</option>
			<option value="FU16 ��Թԡ�����">��Թԡ���¡����͡���Ҿ����(��Һ�ԡ�� 100 �ҷ)</option>
			<option value="FU17 X-ray ��辺ᾷ��">X-ray ��辺ᾷ��</option>
			<option value="FU18 �����">�����</option>
				<option value="FU19 ��Ǩ����Ѵ OPD �Ǫ��ʵ���鹿�">��Ǩ����Ѵ OPD �Ǫ��ʵ���鹿�</option>
                <option value="FU26 EMG">EMG</option>
                <option value="FU27 X-ray ��͹��ᾷ��">X-ray ��͹��ᾷ��</option>
                <option value="FU28 Lab ��͹��ᾷ��">Lab ��͹��ᾷ��</option>
                <option value="FU29 X-ray + Lab ��͹��ᾷ��">X-ray + Lab ��͹��ᾷ��</option>
                <option value="FU30 ��Թԡ�ä�">��Թԡ�ä�</option>-->
		</select>
   </TD>
</TR>
<TR>
	<TD align="right">��ͤ�û�Ժѵԡ�͹��ᾷ�� : </TD>
	<TD>
	<select size="1" name="advice">
    <option value="�����">�����</option>
    <option>����ͧ��������������</option>
    <option>���������������ѧ���� 20:00 �.</option>
    <option>���������������ѧ���� 24:00 �.</option>
	<option>���������������ѧ���� ........... �.</option>
	<option>�͡����� ��͹��ᾷ��</option>
    <option>������������ͧ��дѺ�ء��Դ �����Ū�� �駺���ǳ�鹤� ᢹ ��Т�</option>
  </select>
   </TD>
</TR>
<TR>
	<TD align="right">������ʹ : </TD>
	<TD>
		<select size="1" name="patho">
			<option selected value="�����">�����</option>
			<option>CBC</option>
				<option>CBC,BS</option>
			<option>UA</option>
			<option>CBC, UA</option>
			<option>BS</option>
			<option>CBC ,BS, CHOL, TG</option>
			<option>BS, CHOL, TG</option>
			<option>BUN,CR</option>
			<option>CHOL, TG</option>
			<option>CBC, CD4, LFT</option>
			<option>CBC,UA,BS,BUN,CR,LFT,CHOL,TG,URIC</option>
			<option>URIC ACID</option>
			<option>Anti HIV</option>
			<option>CBC,CD4</option>
			<option>BS,CHOL,TG,HDL,LDL</option>
			<option>CHOL,TG,HDL,LDL</option>
			<option>BS,HbA1C</option>
			<option>FT3,FT4,TSH</option>
			<option>FBs,Bun,Cr</option>
			<option>FBs,HbA1C,Chol,Tg</option>
			<option>FBs,HbA1C,Chol,Tg,UA</option>
			<option>Bun,Cr,E-lyte,Hct</option>
			<option>FBs,HbA1C,Bun,Cr,Chol,Tg</option>
			<option>FBs,Chol,Tg,Bun,Cr,Ua</option>
			<option>FBs,HbA1C,Chol,Tg,Bun,Cr,Ua</option>
		</select>
   </TD>
</TR>
<TR>
	<TD align="right">�͡����� : </TD>
	<TD>
	<select size="1" name="xray">
		<option selected value="�����">�����</option>
		<option>CXR</option>
		<option>KUB</option>
	</select>
   </TD>
</TR>
<TR>
	<TD align="right">Ἱ����Ѵ : </TD>
	<TD>
	<select size="1" name="depcode">
    <option>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3649;&#3612;&#3609;&#3585;&#3607;&#3637;&#3656;&#3609;&#3633;&#3604;&gt;</option>
    <option>U09&nbsp;
    ��ͧ��Ǩ�ä</option>
    <option>U01&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3594;&#3634;&#3618;</option>
    <option>U02&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3597;&#3636;&#3591;</option>
    <option>U03&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3626;&#3641;&#3605;&#3636;&#3609;&#3619;&#3637;</option>
    <option>U19&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3614;&#3636;&#3648;&#3624;&#3625;3</option>
    <option>U04&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3609;&#3633;&#3585;ICU</option>
    <option>U05&nbsp;
    &#3627;&#3657;&#3629;&#3591;&#3612;&#3656;&#3634;&#3605;&#3633;&#3604;</option>
    <option>U06&nbsp; &#3623;&#3636;&#3626;&#3633;&#3597;&#3597;&#3637;</option>
   <!-- <option selected>U12&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3652;&#3605;&#3648;&#3607;&#3637;&#3618;&#3617;</option>-->
    <option>U10&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3614;&#3618;&#3634;&#3608;&#3636;</option>
    <option>U11&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3648;&#3629;&#3585;&#3595;&#3660;&#3648;&#3619;&#3618;&#3660;</option>
    <option>U13&nbsp;
    &#3585;&#3629;&#3591;&#3607;&#3633;&#3609;&#3605;&#3585;&#3619;&#3619;&#3617;</option>
    <option>U16&nbsp;
    &#3627;&#3657;&#3629;&#3591;&#3593;&#3640;&#3585;&#3648;&#3593;&#3636;&#3609;</option>
    <option>U19&nbsp; �ͧ��Ǩ�ä�������ٵ�</option>
    <option>U20&nbsp; ����Ҿ</option>
	<option>U21&nbsp; �ǴἹ��</option>
	<option>U22&nbsp; �����</option>
	<option>U23&nbsp; ��Թԡ�����</option>
		<option>U24&nbsp; Ἱ��ѧ���</option>
			<option>U25&nbsp; Ἱ��ѡ��</option>
            <option>U26&nbsp; ��Թԡ�ä�</option>
            <option>U27&nbsp; OPD PM&R</option>
            <option>U28&nbsp; �Ǫ������ͧ�ѹ</option>
            <option>U29&nbsp; ��������آ�Ҿ</option>
  </select>
   </TD>
</TR>
<TR>
	<TD colspan="2" align="center"><INPUT TYPE="submit" value="  ��ŧ  "></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>

	</TD>
</TR>
</TABLE>


</body>
</html>
<?php include("unconnect.inc");?>
