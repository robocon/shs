
<body onLoad="document.f1.yot.focus();">
<?php
   session_start();
   if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
   }
include("connect.inc");
   if(isset($_GET["action"]) && $_GET["action"] == "district"){
	
	$sql = "Select a.DISTRICT_NAME, b.AMPHUR_NAME, c.PROVINCE_NAME  From district_new as a, amphur_new as b ,province_new as c where DISTRICT_NAME  like '".$_GET["search"]."%' AND a.PROVINCE_ID = c.PROVINCE_ID AND a.AMPHUR_ID = b.AMPHUR_ID ";
	
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
				<td ><font style=\"color: #FFFFFF\"><strong>�������</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list2').innerHTML ='';\">�Դ</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				

				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
					<td  align=\"center\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '",$arr["DISTRICT_NAME"],"';document.getElementById('".$_GET["getto2"]."').value = '",$arr["AMPHUR_NAME"],"';document.getElementById('".$_GET["getto3"]."').value = '",$arr["PROVINCE_NAME"],"';document.getElementById('list2').innerHTML ='';\">�.",$arr["DISTRICT_NAME"],"&nbsp;�.",$arr["AMPHUR_NAME"],"&nbsp;�.",$arr["PROVINCE_NAME"],"</A></td>
					<td></td>
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
/////////////////////////

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
?>
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
</style>
<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		var stat = true;
		var id13 = document.f1.idcard.value;
		var sum = 0;

		
			if(id13 != "" && id13 != "-"){
				
				if(id13.length != 13){
					alert("�Ţ�ѵû�ЪҪ����١��ͧ");
					stat = false;
				}

				if(stat == true){
						
						for (i = 0; i < 12; i++)
						{
							sum += eval(id13.charAt(i)) * (13 - i);
						}

					sum = ((11 - (sum % 11)) % 10)
					
					if(eval(id13.charAt(12)) != sum)
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

function searchSuggest(str,len,getto1,getto2,getto3) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'opcard.php?action=district&search=' + str+'&getto1=' + getto1+'&getto2=' + getto2+'&getto3=' + getto3;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list2").innerHTML = xmlhttp.responseText;
		}
}
function searchSuggest2(str,len,getto1) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'opcard.php?action=hospcode&search2=' + str+'&getto1=' + getto1

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list3").innerHTML = xmlhttp.responseText;
		}
}
</SCRIPT>
<?  include("connect.inc"); ?>
<h3 align="center" class="fonttitle">�Ǫ����¹ / MEDICAL RECORD</h3>
<h3 align="center" class="fonttitle">�ç��Һ�Ť�������ѡ��������  �ӻҧ</h3>

<form name="f1" method="POST" action="opdadd.php" Onsubmit="return checkForm();">

<fieldset>
    <legend>�����Ż���ѵ���ǹ���:</legend>
    
    <table width="100%" border="0">
  <tr>
    <td width="15%" align="center"><IMG SRC='../image_patient/NoPicture.jpg' WIDTH='100' HEIGHT='150' BORDER='0' ALT=''></td>
    <td width="85%" valign="top">
    <table border="0">
      <tr>
        <td align="right"  class="fonthead">�ӹ�˹��:</td>
        <td> 
          <input type="text" name="yot" size="5" id="yot" >

        </td>
        <td align="right" class="fonthead">����:</td>
        <td> 
          <input type="text" name="name" size="15" id="name" >
        </td>
        <td align="right" class="fonthead">ʡ��:</td>
        <td> 
          <input type="text" name="surname" size="15" id="surname">
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td align="right" class="fonthead">��:</td>
        <td> 
          <select size="1" name="sex" id="sex">
            <option value="" selected><-���͡-></option>
            <option value="�">���</option>
            <option value="�">˭ԧ</option>
          </select>
        </td>
        <td colspan="3" align="right" class="fonthead">�����Ţ��Шӵ�ǻ�ЪҪ�:</td>
        <td> 
          <input type="text" name="idcard" size="15" value="-" id="idcard">
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td align="right" class="fonthead">�ѹ�Դ:</td>
        <td colspan="10" class="fonthead"> 
          <input type="text" name="d" size="2" value="��" maxlength="2" id="d">
          <input type="text" name="m" size="2" value="��" maxlength="2" id="m">
          <input type="text" name="y" size="4" value="�.�." maxlength="4" id="y">
          ���ͪҵ�: 
        <select size="1" name="race" id="race">
               <option value="��" selected>��</option>
                <option value="�չ">�չ</option>
                <option value="���">���</option>
                <option value="����">����</option>
                <option value="����٪�">����٪�</option>
                <option value="�Թ���">�Թ���</option>
                <option value="���´���">���´���</option>
                <option value="����">����</option>
              </select>

            �ѭ�ҵ�: 
              <select size="1" name="nation" id="nation">
                <option value="��" selected>��</option>
                <option value="�չ">�չ</option>
                <option value="���">���</option>
                <option value="����">����</option>
                <option value="����٪�">����٪�</option>
                <option value="�Թ���">�Թ���</option>
                <option value="���´���">���´���</option>
                <option value="����">����</option>
                </select>
  
              </td>
        </tr>
      <tr>
        <td align="right" class="fonthead">��ʹ�:</td>
        <td colspan="10" class="fonthead">
        <select size="1" name="religion" id="religion">
         <option><-���͡-></option>
                  <option  value="�ط�" selected>�ط�</option>
                  <option value="���ʵ�">���ʵ�</option>
                  <option value="������">������</option>
                  <option value="����">����</option>
                </select>
        
    </td>
      </tr>
      <tr>
        <td align="right" class="fonthead">ʶҹ�Ҿ:</td>
        <td> 
          <select size="1" name="married" id="married">
            <option  value="" selected><-���͡-></option>
            <option value="�ʴ">�ʴ</option>
            <option value="����">����</option>
            <option value="�����">�����</option>
            <option value="����">����</option>
            <option value="�¡">�¡</option>
            <option value="����">����</option>
            <option value="�ʴ">����</option>
          </select>
         
        </td>
        <td class="fonthead">�Ҫվ:</td>
        <td colspan="3"> 
        <select size="1" name="career" id="career">
  <option  value="" selected><-���͡-></option>
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
          </select>
          
          
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        
      </tr>
      <tr>
        <td colspan="6" class="fonthead">�����Ţ��Шӵ�Ƿ���: 
          <input name="mid" type="text" id="mid" value="-" size="15" maxlength="13"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  </table>

</fieldset>
<BR>
<fieldset>
    <legend>�����š�õԴ���:</legend>
     <div id="list2" style="position: absolute;"></div>       
<table border="0" align="center">
  <tr>
    <td align="right" class="fonthead"> ��ҹ�Ţ���:</td>
    <td><input type="text" name="address" size="10"></td>
    <td align="right" class="fonthead">�Ӻ�:</td>
    <td><input type="text" name="tambol" size="10" onKeyPress="searchSuggest(this.value,3,'tambol','ampur','changwat');"></td>
    <td align="right" class="fonthead">�����:</td>
    <td><input type="text" name="ampur" size="10" value="���ͧ"></td>
    <td class="fonthead">�ѧ��Ѵ:</td>
    <td><input type="text" name="changwat" size="10" value="�ӻҧ"></td>
  </tr>
  <tr>
    <td align="right" class="fonthead">���Ѿ���ҹ:</td>
    <td><input type="text" name="hphone" size="10" value="-" id="hphone"></td>
    <td align="right" class="fonthead">��Ͷ��:</td>
    <td><input type="text" name="phone" size="10" value="-"></td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">�Դ�:</td>
    <td> 
      <input type="text" name="father" size="15" value="-">
    </td>
    <td align="right" class="fonthead">��ô�:</td>
    <td> 
      <input type="text" name="mother" size="15" value="-" >
    </td>
    <td align="right" class="fonthead">�������:</td>
    <td> 
      <input type="text" name="couple" size="15" value="-">
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">���������ö�Դ�����:</td>
    <td>
      <input type='text' name="ptf" size='15'  value="-">
    </td>
    <td align="right" class="fonthead">����Ǣ�ͧ��:</td>
    <td><input type='text' name="ptfadd" size='10'  value="-"></td>
    <td align="right" class="fonthead">���Ѿ��:</td>
    <td>
      <input type='text' name="ptffone" size='10'  value="-">
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>    
</fieldset>
<BR>
<fieldset>
    <legend>�������Է�ԡ���ѡ��:</legend>
    
    
    <table  border="0" align="center">
  <tr>
    <td align="right" class="fonthead">������:</td>
    <td>
      <SELECT NAME="goup" id="goup">
      <option value="" selected><-----------------------���͡-----------------------></option>
      <? 
		  $sqlg="SELECT * FROM `grouptype` order by row_id";
		  $queryg=mysql_query($sqlg)or die (mysql_error());
		  while($arrg=mysql_fetch_array($queryg)){
		  ?>
      <option value="<?=$arrg['name']?>"><?=$arrg['name']?></option>
      <?
		  }
	  ?>
    </select>      </td>
    <td align="right" class="fonthead">�ѧ�Ѵ:</td>
    <td>
     <SELECT NAME="camp" id="camp">
        <option value="" selected><---------------���͡---------------></option>
        <? 
		  $sqlcamp="SELECT * FROM `camp` order by row_id";
		  $querycamp=mysql_query($sqlcamp)or die (mysql_error());
		  while($arrcamp=mysql_fetch_array($querycamp)){
		  ?>
        <option value="<?=$arrcamp['name']?>"> <?=$arrcamp['name']?></option>
        <? 
		  }
	  ?>
      </select>    </td>
    </tr>
  <tr>
    <td align="right" class="fonthead">�Է�ԡ���ѡ��:</td>
    <td><select size="1" name="ptright">
     <option value="" selected><-----------------------���͡-----------------------></option>
      <?php

	$sql = "Select * From ptright Order by code ASC ";
$result = mysql_query($sql) or die(mysql_error());
while(list($ptright_code, $ptright_name) = mysql_fetch_row($result)){
	print " <option>{$ptright_code}&nbsp;{$ptright_name}</option>";
}

	?>
    </select></td>
    <td align="right" class="fonthead">�������Է�� :</td>
    <td colspan="3"><select name="ptrightdetail" size="1" id="ptrightdetail">
      <option value="" selected><---------------------------------���͡---------------------------------></option>
      <?php
$sqlptr = "Select * From  ptrightdetail Order by code ASC ";
$resultptr = mysql_query($sqlptr) or die(mysql_error());
while(list($ptrcode, $ptrname) = mysql_fetch_row($resultptr)){
	print " <option value='$ptrname'>$ptrname</option>";
}
	?>
    </select></td>
    </tr>
  <tr>
    <td align="right" class="fonthead">�ԡ�ҡ:</td>
    <td><select   size="1" name="ptfmon" id="ptfmon">
     <option value="" selected><-----���͡-----></option>
      <option value="MO01 ���ͧ">MO01 ���ͧ</option>
      <option value="MO02 �Դ�">MO02 �Դ�</option>
      <option value="MO03 ��ô�">MO03 ��ô�</option>
      <option value="MO04 �ص�">MO04 �ص�</option>
      <option  value="MO05 �������">MO05 �������</option>
    </select></td>
    <td class="fonthead">˹��§ҹ :</td>
    <td><input type='text' name="guardian" size='20'  value="-" id="guardian"></td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">����Ѻ��ԡ��:</td>
    <td><SELECT NAME="typeservice" id="typeservice">
      <option value="" selected><-----------���͡-----------></option>
      <? 
		  $sqlts="SELECT * FROM `typeservice` order by ts_id";
		  $queryts=mysql_query($sqlts)or die (mysql_error());
		  while($arrts=mysql_fetch_array($queryts)){
		  ?>
      <option value="<?=$arrts['ts_name']?>">
      <?=$arrts['ts_name']?>
        </option>
      <? 
		  }
	  ?>
    </select></td>
    <td class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    </table>

</fieldset>
<BR>
<fieldset>
    <legend>������ ����:</legend>
    
    
    <table  border="0" align="center" width="100%">
  <tr>
    <td align="right" class="fonthead">��������ʹ</td>
    <td>
    <SELECT NAME="blood" id="blood">
      <option value="����Һ�������ʹ">����Һ�������ʹ</option>
      <option value="����µ�Ǩ�������ʹ ">����µ�Ǩ�������ʹ </option>
      <option value="��">��</option>
      <option value="��">��</option>
      <option value="�ͺ�">�ͺ�</option>
      <option value="��">��</option>
    </SELECT>    </td>
    <td class="fonthead">���� <div id="list3" style="position: absolute;"></div></td>
    <td class="fonthead"><INPUT TYPE="text" NAME="drugreact" id="drugreact"> 
<input name="rdo1" type="radio"  id="rdo1" value="30 �ҷ"> 
30 �ҷ 
<input name="rdo1" type="radio" id="rdo2" value="��."> 
��Сѹ�ѧ��  
      þ.���ѧ�Ѵ
      <INPUT NAME="hospcode" TYPE="text" id="hospcode" onKeyPress="searchSuggest2(this.value,3,'hospcode');" size="40" >  </td>
    </tr>
  <tr>
    <td align="right" class="fonthead">�����˵�</td>
    <td><select size="1" name="idguard" id="idguard">
       <option value="" selected><-----------------------���͡-----------------------></option>
      <? 
		  $sqlg="SELECT * FROM `guardtype` order by guard_id";
		  $queryg=mysql_query($sqlg)or die (mysql_error());
		  while($arrg=mysql_fetch_array($queryg)){
		  ?>
      <option value="<?=$arrg['guard_name']?>"><?=$arrg['guard_name']?></option>
      <?
		  }
	  ?>
    </select>
    </td>
    <td class="fonthead">�����˵�</td>
    <td><input type="text" name="note" size="50" value="-" id="note"></td>
    </tr>
    </table>

</fieldset>
<BR>

<table border="0" align="center">
<tr>
<td>
<input type="submit" value="  �ѹ�֡  " name="B1" >&nbsp;&nbsp;
<a target=_self  href="../nindex.htm"><---�����</a></CENTER>
    </td>
    </tr>
  </table>
  <? include("unconnect.inc"); ?>
  
</form>
</body>



