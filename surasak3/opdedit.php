<?php
session_start();
session_unregister("cHn");  
session_unregister("cPtname");
session_unregister("cPtright");
session_unregister("cPtright1");
session_unregister("nVn");
session_unregister("cAge");
session_unregister("cIdcard");
session_unregister("cNote");
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
session_register("cIdcard");   
session_register("cNote");  
session_register("cIdcard");  
session_register("cIdguard");  

$_SESSION["cHn"] = trim($_GET["cHn"]);

include("connect.inc");

$query = "SELECT * FROM opcard WHERE hn = '$cHn'";
$result = mysql_query($query) or die("Query failed");

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
	$chPhone =$row->hphone;
	$cPhone =$row->phone;
	$cFather =$row->father;
	$cMother =$row->mother;
	$cCouple =$row->couple;
	$cNote=$row->note;
	$cSex =$row->sex;
	$cCamp =$row->camp;
	$cRace=$row->race;
	$cPtf=$row->ptf;
	$cPtfadd=$row->ptfadd;
	$cPtffone=$row->ptffone;

	$cPtfmon=$row->ptfmon;
	$cLastupdate=$row->lastupdate;
	$cBlood=$row->blood;
	$cDrugreact=$row->drugreact;
	$cHospcode=$row->hospcode;
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
 } else {
	echo "��辺 HN : $cHn ";
}
		   
if(substr($cIdguard,0,4)=="MX07"){
	?>
	<script type="text/javascript">
		alert("HN: <?=$cHn;?> ��ʶҹз���»���ѵ�");
	</script>
	<?php 
}else if(substr($cIdguard,0,4)=="MX05"){
	?>
	<script type="text/javascript">
		alert("HN: <?=$cHn;?> ��ʶҹ��غ����ѵ�");
	</script>
	<?php 
}

//print "$cDbirth";
?>

<style>
body { background-color: #66CC99; }
fieldset { border:1px solid #0033FF; }
legend {
  padding: 0.2em 0.5em;
  border:1px solid #0033FF;
  color: #0033FF;
  font-size:90%;
  text-align:right;
}
.fonttitle{ color:#030; }
.fonthead{
  font-family:"Angsana New";
  size: 16px;
}
</style>
<script type="text/javascript">
window.moveTo(0,0);
if (document.all) {
  top.window.resizeTo(screen.availWidth,screen.availHeight);
} else if (document.layers||document.getElementById) {
  if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
    top.window.outerHeight = screen.availHeight;
    top.window.outerWidth = screen.availWidth;
  }
}
</script>

<script type="text/javascript">
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
		url = 'opdedit.php?action=hospcode&search2=' + str+'&getto1=' + getto1
		//alert(url);
		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);

		document.getElementById("list3").innerHTML = xmlhttp.responseText;
	}
}
</script>

<?php
if(isset($_GET["action"]) && $_GET["action"] == "hospcode"){
	$sql = "SELECT hospcode,hosptype,name  FROM hospcode WHERE  hospcode  like '".$_GET["search2"]."%' ";
	//echo "==>".$sql;
	
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
		}  //close while
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}  //close numrows
		exit();
}
?>
<title>��䢢������Ǫ����¹������</title>
<body bgcolor='<?=$color;?>' text='#3300FF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
<h3 align="center" class="fonttitle">�Ǫ����¹ / MEDICAL RECORD</h3>
<h3 align="center" class="fonttitle">�ç��Һ�Ť�������ѡ��������  �ӻҧ</h3>
<form name='f1' method='POST' action='opdwork.php' onsubmit='return checkForm();' >
<input name="hn" type="hidden" value="<?=$cHn;?>">
<fieldset>
    <legend>�����Ż���ѵ���ǹ��� :  HN : <?=$cHn;?></legend>
    
    <table width="100%" border="0">
  <tr>
    <td width="15%" align="center">
<a href='Capture.php?id=<?=$cIdcard;?>&hn=<?=$cHn;?>&yot=<?=$cYot;?>&name1=<?=$cName;?>&name2=<?=$cSurname;?>' target=_blank>
    <IMG SRC='../image_patient/<?=$cIdcard;?>.jpg' WIDTH='100' HEIGHT='150' BORDER='0' ALT='' style="border: #FFFFFF solid 3px; padding: 2px 2px 2px 2px;"></a></td>
    <td width="85%" valign="top">
    <table border="0">
      <tr>
        <td align="right"  class="fonthead">�ӹ�˹��:</td>
        <td> 
          <input name="yot" type="text" id="yot" value="<?=$cYot;?>" size="5" >        </td>
        <td align="right" class="fonthead">����:</td>
        <td> 
          <input name="name" type="text" id="name" value="<?=$cName;?>" size="15" >        </td>
        <td align="right" class="fonthead">ʡ��:</td>
        <td> 
          <input name="surname" type="text" id="surname" value="<?=$cSurname;?>" size="15">        </td>
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
            <option value="">���͡</option>
            <option <?php if($cSex=='�' ||$cSex=='1' ){ echo "selected"; }?> value="�">���</option>
            <option <?php if($cSex=='�' ||$cSex=='2' ){ echo "selected"; }?> value="�">˭ԧ</option>
          </select>        </td>
        <td colspan="3" align="right" class="fonthead">�����Ţ��Шӵ�ǻ�ЪҪ�:</td>
        <td> 
          <input name="idcard" type="text" id="idcard" value="<?=$cIdcard;?>" size="15" maxlength="13">        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td align="right" class="fonthead">�ѹ�Դ:</td>
        <td colspan="10" class="fonthead"> 
<input type='text' name='d' size='2' value='<?=$cD;?>' maxlength='2'>
<input type='text' name='m' size='2' value='<?=$cM;?>' maxlength='2'>
<input type='text' name='y' size='4' value='<?=$cY;?>' maxlength='4'>
          ���ͪҵ�: 
            <select size="1" name="race" id="race">
<option <?php if($cRace=='��'){ echo "selected";}?>value="��">��</option>
<option <?php if($cRace=='�չ'){ echo "selected";}?> value="�չ">�չ</option>
<option <?php if($cRace=='���'){ echo "selected";}?>  value="���">���</option>
<option <?php if($cRace=='����'){ echo "selected";}?> value="����">����</option>
<option <?php if($cRace=='����٪�'){ echo "selected";}?> value="����٪�">����٪�</option>
<option <?php if($cRace=='�Թ���'){ echo "selected";}?> value="�Թ���">�Թ���</option>
<option <?php if($cRace=='���´���'){ echo "selected";}?> value="���´���">���´���</option>
<option <?php if($cRace=='����'){ echo "selected";}?> value="����">����</option>
              </select>
            �ѭ�ҵ�: 
              <select size="1" name="nation" id="nation">
<option  value="��"<?php if($cNation=='��'){ echo "selected";}?> >��</option>
<option value="�չ"<?php if($cNation=='�չ'){ echo "selected";}?> >�չ</option>
<option value="���"<?php if($cNation=='���'){ echo "selected";}?> >���</option>
<option value="����"<?php if($cNation=='����'){ echo "selected";}?> >����</option>
<option value="����٪�"<?php if($cNation=='����٪�'){ echo "selected";}?> >����٪�</option>
<option value="�Թ���"<?php if($cNation=='�Թ���'){ echo "selected";}?> >�Թ���</option>
<option value="���´���"<?php if($cNation=='���´���'){ echo "selected";}?> >���´���</option>
<option value="����"<?php if($cNation=='����'){ echo "selected";}?> >����</option>
</select>
              ��ʹ�: 
                <select size="1" name="religion" id="religion">
<option value="�ط�"<?php if($cReligion=='�ط�'){ echo "selected";}?>>�ط�</option>
<option value="���ʵ�"<?php if($cReligion=='���ʵ�'){ echo "selected";}?>>���ʵ�</option>
<option value="������"<?php if($cReligion=='������'){ echo "selected";}?>>������</option>
<option value="����"<?php if($cReligion=='����'){ echo "selected";}?>>����</option>
</select>        </td>
        </tr>
      <tr>
        <td align="right" class="fonthead">ʶҹ�Ҿ:</td>
        <td> 
<select size="1" name="married" id="married">
<option value=""><-���͡-></option>
            <option value="�ʴ" <?php if($cMarried=='�ʴ'){ echo "selected";}?>>�ʴ</option>
            <option value="����" <?php if($cMarried=='����'){ echo "selected";}?>>����</option>
            <option value="�����" <?php if($cMarried=='�����'){ echo "selected";}?>>�����</option>
            <option value="����" <?php if($cMarried=='����'){ echo "selected";}?>>����</option>
            <option value="�¡" <?php if($cMarried=='�¡'){ echo "selected";}?>>�¡</option>
            <option value="����" <?php if($cMarried=='����'){ echo "selected";}?>>����</option>
            <option value="����" <?php if($cMarried=='����'){ echo "selected";}?>>����</option>
</select>        </td>
        <td class="fonthead">�Ҫվ:</td>
        <td colspan="3"> 
          <select size="1" name="career" id="career">
            <option value=""><-���͡-></option>
             <option value='<?=$cCareer;?>' selected><?=$cCareer;?></option>";
<option value="01 �ɵá�"<?php if($cCareer=='01 �ɵá�'){ echo "selected";}?>>01 �ɵá�</option>
<option value="02 �Ѻ��ҧ�����"<?php if($cCareer=='02 �Ѻ��ҧ�����'){ echo "selected";}?>>02 �Ѻ��ҧ�����</option>
<option value="03 ��ҧ�����" <?php if($cCareer=='03 ��ҧ�����'){ echo "selected";}?>>03 ��ҧ�����</option>
<option value="04 ��áԨ"<?php if($cCareer=='04 ��áԨ'){ echo "selected";}?>>04 ��áԨ</option>
<option value="05 ����/���Ǩ"<?php if($cCareer=='05 ����/���Ǩ'){ echo "selected";}?>>05 ����/���Ǩ</option>
<option value="06 �ѡ�Է���ҵ����йѡ෤�ԡ"<?php if($cCareer=='06 �ѡ�Է���ҵ����йѡ෤�ԡ'){ echo "selected";}?>>06 �ѡ�Է���ҵ����йѡ෤�ԡ</option>
<option value="07 �ؤ�ҡô�ҹ�Ҹ�ó�آ"<?php if($cCareer=='07 �ؤ�ҡô�ҹ�Ҹ�ó�آ'){ echo "selected";}?>>07 �ؤ�ҡô�ҹ�Ҹ�ó�آ</option>
<option value="08 �ѡ�ԪҪվ/�ѡ�Ԫҡ��"<?php if($cCareer=='08 �ѡ�ԪҪվ/�ѡ�Ԫҡ��'){ echo "selected";}?>>08 �ѡ�ԪҪվ/�ѡ�Ԫҡ��</option>
<option value="09 ����Ҫ��÷����"<?php if($cCareer=='09 ����Ҫ��÷����'){ echo "selected";}?>>09 ����Ҫ��÷����</option>
<option value="10 �Ѱ����ˡԨ"<?php if($cCareer=='10 �Ѱ����ˡԨ'){ echo "selected";}?>>10 �Ѱ����ˡԨ</option>
<option value="11 ��������������Ҫվ"<?php if($cCareer=='11 ��������������Ҫվ'){ echo "selected";}?>>11 ��������������Ҫվ</option>
<option value="12 �ѡ�Ǫ/�ҹ��ҹ��ʹ�"<?php if($cCareer=='12 �ѡ�Ǫ/�ҹ��ҹ��ʹ�'){ echo "selected";}?>>12 �ѡ�Ǫ/�ҹ��ҹ��ʹ�</option>
<option value="13 ����"<?php if($cCareer=='13 ����'){ echo "selected";}?>>13 ����</option>
          </select>        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="fonthead">�дѺ����֡��</td>
        <td colspan="5"><select name="education" id="education">
        <option value="">----- ��س����͡������ -----</option>
        <?php 
        $sql="select * from education order by row_id asc";
		$query=mysql_query($sql);
		while($rows=mysql_fetch_array($query)){
			if($cEducation==$rows["edu_code"]){
		?>
        	<option value="<?=$rows["edu_code"];?>" selected="selected"><?=$rows["edu_code"]."-".$rows["edu_name"];?></option>
        <?php 
			}else{
		?>
        	<option value="<?=$rows["edu_code"];?>"><?=$rows["edu_code"]."-".$rows["edu_name"];?></option>
        <?php 
			}
		}
		?>
        </select>
&nbsp;<span style="color:#FF0000">***</span>        </td>
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
    </table></td>
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
    <td class="fonthead">�ѧ��Ѵ:</td>
    <td><input type="text" name="changwat" size="10" value="<?=$cChangwat;?>"></td>
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
      <input type="text" name="father" size="15" value="<?=$cFather;?>">
    </td>
    <td align="right" class="fonthead">��ô�:</td>
    <td> 
      <input type="text" name="mother" size="15" value="<?=$cMother;?>" >
    </td>
    <td align="right" class="fonthead">�������:</td>
    <td> 
      <input type="text" name="couple" size="15" value="<?=$cCouple;?>">
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">���������ö�Դ�����:</td>
    <td>
      <input type='text' name="ptf" size='15'  value="<?=$cPtf;?>">
    </td>
    <td align="right" class="fonthead">����Ǣ�ͧ��:</td>
    <td><input type='text' name="ptfadd" size='10'  value="<?=$cPtfadd;?>"></td>
    <td align="right" class="fonthead">���Ѿ��:</td>
    <td>
      <input type='text' name="ptffone" size='10'  value="<?=$cPtffone;?>">
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
     <option value="<?=$cGoup;?>" selected><?=$cGoup;?></option>
    <option value=""><-���͡-></option>
      <?php
		  $sqlg="SELECT * FROM `goup` order by row_id";
		  $queryg=mysql_query($sqlg)or die (mysql_error());
		  while($arrg=mysql_fetch_array($queryg)){

		 if($arrg['name']==$cGoup){
 		  ?>
      <option value="<?=$arrg['name']?>" selected="selected"> <?=$arrg['name']?></option>
      <?php }else{ ?>

      <option value="<?=$arrg['name']?>"><?=$arrg['name']?></option>
      <?php
	  }
		  }
	  ?>
    </select></td>
    <td align="right" class="fonthead">�ѧ�Ѵ:</td>
    <td>
    <SELECT NAME="camp" id="camp">
        <option value="<?=$cCamp;?>" selected><?=$cCamp;?></option>
      <option value=""><-���͡-></option>
      <?php
		  $sqlcamp="SELECT * FROM `camp` order by row_id";
		  $querycamp=mysql_query($sqlcamp)or die (mysql_error());
		  while($arrcamp=mysql_fetch_array($querycamp)){

			  if($cCamp==$arrcamp['name']){
		  ?>
      <option value="<?=$arrcamp['name']?>" selected> <?=$arrcamp['name']?></option>
      <?php }else{ ?>
      <option value="<?=$arrcamp['name']?>"><?=$arrcamp['name']?></option>
      <?php 
	  }
		  }
	  ?>
    </select>    </td>
    </tr>
  <tr>
    <td align="right" class="fonthead">�Է�ԡ���ѡ��:</td>
    <td><select size="1" name="ptright1" id="ptright1">
      <option  value="<?=$cPtright1;?>"> <?=$cPtright1;?></option>
      <?php
include("connect.inc");
	$sql = "Select * From ptright Order by code ASC ";
$result = mysql_query($sql) or die(mysql_error());
while(list($ptright_code, $ptright_name) = mysql_fetch_row($result)){
	print " <option value='$ptright_code&nbsp;$ptright_name'>$ptright_code&nbsp;$ptright_name</option>";
}
	//include("unconnect.inc");
	?>
    </select></td>
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
      <option value="<?=$cPtfmon;?>">
        <?=$cPtfmon;?>
        </option>
      <option value="MO01 ���ͧ">MO01 ���ͧ</option>
      <option value="MO02 �Դ�">MO02 �Դ�</option>
      <option value="MO03 ��ô�">MO03 ��ô�</option>
      <option value="MO04 �ص�">MO04 �ص�</option>
      <option value="MO05 �������">MO05 �������</option>
    </select></td>
    <td class="fonthead">˹��§ҹ:</td>
    <td><input type='text' name="guardian" size='20'  value="<?=$cGuardian;?>" id="guardian"></td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
		<td class="fonthead"><label for="employee">�١��ҧ þ.�����</label></td>
	  <td colspan="3"><?php
			$checked = ( $employee === 'y' ) ? 'checked="checked"' : '' ;
			?>
			<input type="checkbox" id="employee" name="employee" value="y" <?=$checked;?>>
			<span class="fonthead" style="color: #FF0033;">(������١��ҧ þ.����� ������͡ check box ����)</span>		</td>

  </tr>
    </table>

</fieldset>
<BR>
<fieldset>
    <legend>������ ����:</legend>
    
    
    <table  border="0" align="center" width="100%">
  <tr>
    <td align="right" class="fonthead">��������ʹ</td>
    <td><SELECT NAME="blood" id="blood">
     <option value="<?=$cBlood;?>"><?=$cBlood;?></option>
      <option value="����Һ�������ʹ">����Һ�������ʹ</option>
      <option value="����µ�Ǩ�������ʹ ">����µ�Ǩ�������ʹ </option>
      <option value="��">��</option>
      <option value="��">��</option>
      <option value="�ͺ�">�ͺ�</option>
      <option value="��">��</option>
    </SELECT></td>
    <td class="fonthead">����<div id="list3" style="position: absolute;"></div></td>
    <td><INPUT TYPE="text" NAME="drugreact" id="drugreact" value="<?=$cDrugreact;?>">
<input name="rdo1" type="radio"  id="rdo1" value="30 �ҷ" <?php if($hcode1=="30 �ҷ"){ echo "checked"; }?>> 
30 �ҷ 
<input name="rdo1" type="radio" id="rdo2" value="��." <?php if($hcode1=="��."){ echo "checked"; }?>> 
��Сѹ�ѧ��  
      þ.���ѧ�Ѵ
<INPUT NAME="hospcode" TYPE="text" id="hospcode" onKeyPress="searchSuggest2(this.value,3,'hospcode');" size="40" value="<?=$cHospcode;?>">    
    </td>
    </tr>
  <tr>
    <td align="right" class="fonthead">�����˵�</td>
    <td><select size="1" name="idguard" id="idguard">
      <option value="<?=$cIdguard;?>"><?=$cIdguard;?></option>
      <option value=''>-----���͡-----</option>
      <option value='MX01 ����/��ͺ����'>MX01 ����/��ͺ����</option>
      <option value='MX02 �ջѭ������ͧ�Է��'>MX02 �ջѭ������ͧ�Է��</option>
      <option value='MX03 VIP'>MX03 VIP</option>
      <option value='MX04 ���ª��Ե'>MX04 ���ª��Ե</option>
	  <option value='MX04 ���ª��Ե(�)'>MX04 ���ª��Ե(�)</option>
	  <option value='MX05 �غ����ѵ�'>MX05 �غ����ѵ�</option>
	  <option value='MX06 �ѵ÷ͧ���ԡ��'>MX06 �ѵ÷ͧ���ԡ��</option>
	  <option value='MX07 ����»���ѵ�'>MX07 ����»���ѵ�</option>
      <option value='MX08 ����/��ͺ����(���ª��Ե)'>MX08 ����/��ͺ����(���ª��Ե)</option>
      <option value='MX09 ����/��ͺ����(�ؾ���Ҿ)'>MX09 ����/��ͺ����(�ؾ���Ҿ)</option>
      
    </select></td>
    <td class="fonthead">�����˵�</td>
    <td><input type="text" name="note" size="50" value="<?=$cNote;?>" id="note"></td>
    </tr>
    </table>

</fieldset>
<BR>
<?php 
print "  <font face='Angsana New' size='4' color =red>&nbsp;&nbsp;&nbsp; **�Ҥ����ش����&nbsp;&nbsp;&nbsp; $cD1-$cM1-$cY1&nbsp;$cT1 **</font>";
?>
<p align="center"><input type='submit' value='���/ŧ����¹' name='B1'>&nbsp;&nbsp;
</p>
</form>

</body>