<style>
body {
	background-color: #66CC99;
}
fieldset { border:1px solid #0033FF}

legend {
  padding: 0.2em 0.5em;
  border:1px solid #0033FF;
  color: #0033FF;
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
    session_unregister("cIdcard");  
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
    session_register("cIdcard");   
    session_register("cNote");  
	session_register("cNote_vip");  
  session_register("cIdcard");  
  session_register("cIdguard");  
	
	$_SESSION["cHn"] = $_GET["cHn"];

    include("connect.inc");


    $query = "SELECT * FROM opcard WHERE hn = '$cHn'";
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
   If ($result){
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
	$cNote_vip=$row->note_vip;
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
$typearea = $row->typearea;

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
		   
		   if(substr($cIdguard,0,4)=="MX07"){
			   
			   ?>
               <script>
			   alert("HN: <?=$cHn;?> ��ʶҹз���»���ѵ�");
			   </script>
               <?
		
		   }else if(substr($cIdguard,0,4)=="MX05"){
			  ?>
               <script>
			   alert("HN: <?=$cHn;?> ��ʶҹ��غ����ѵ�");
			   </script>
               <?  
			   
		   }

//print "$cDbirth";
?>
<SCRIPT LANGUAGE='JavaScript'>
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

<?
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
      <tr style="vertical-align:top;">
        <td align="right"  class="fonthead">�ӹ�˹��:</td>
        <td> 
        <div style="position: relative;">
          <input name="yot" type="text" id="yot" value="<?=$cYot;?>" size="5" >

            <div><a href="javascript:void(0);" class="fonthead" style="color:#a67a42;" onclick="check_yot()">���ʹ�˹�Ҫ��� ��з�ǧ��Ҵ��</a></div>

            <div id="res_yot" style="position: absolute; top: 0; left: 0; background-color: #ffffff; z-index: 1; padding: 4px; display: none;">
              <div id="close_res_yot" style="text-align: center; background-color: #bbbbbb;" onclick="close_res_yot()">[�Դ˹�ҵ�ҧ]</div>
              
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
        <td align="right" bgcolor="#66CC99"  class="fonthead">Prename:</td>
        <td bgcolor="#66CC99"><span style="position: relative;">
          <input name="prename" type="text" id="prename" value="<?=$cPrename;?>" size="5" >
        </span></td>
        <td align="right" bgcolor="#66CC99" class="fonthead">Name:</td>
        <td bgcolor="#66CC99"><input name="name_eng" type="text" id="name_eng" value="<?=$cName_eng;?>" size="15" ></td>
        <td align="right" bgcolor="#66CC99" class="fonthead">Surname:</td>
        <td bgcolor="#66CC99"><input name="surname_eng" type="text" id="surname_eng" value="<?=$cSurname_eng;?>" size="15"></td>
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
            <option <? if($cSex=='�' ||$cSex=='1' ){ echo "selected"; }?> value="�">���</option>
            <option <? if($cSex=='�' ||$cSex=='2' ){ echo "selected"; }?> value="�">˭ԧ</option>
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
<input type='text' name='d' size='2' value='<?=$cD;?>' maxlength='2'>
<input type='text' name='m' size='2' value='<?=$cM;?>' maxlength='2'>
<input type='text' name='y' size='4' value='<?=$cY;?>' maxlength='4'>
          ���ͪҵ�: 
            <select size="1" name="race" id="race">
<option <? if($cRace=='��'){ echo "selected";}?>value="��">��</option>
<option <? if($cRace=='�չ'){ echo "selected";}?> value="�չ">�չ</option>
<option <? if($cRace=='���'){ echo "selected";}?>  value="���">���</option>
<option <? if($cRace=='����'){ echo "selected";}?> value="����">����</option>
<option <? if($cRace=='����٪�'){ echo "selected";}?> value="����٪�">����٪�</option>
<option <? if($cRace=='�Թ���'){ echo "selected";}?> value="�Թ���">�Թ���</option>
<option <? if($cRace=='���´���'){ echo "selected";}?> value="���´���">���´���</option>
<option <? if($cRace=='����'){ echo "selected";}?> value="����">����</option>
              </select>
            �ѭ�ҵ�: 
              <select size="1" name="nation" id="nation">
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
<option value="�ط�"<? if($cReligion=='�ط�'){ echo "selected";}?>>�ط�</option>
<option value="���ʵ�"<? if($cReligion=='���ʵ�'){ echo "selected";}?>>���ʵ�</option>
<option value="������"<? if($cReligion=='������'){ echo "selected";}?>>������</option>
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
            <option value=""><-���͡-></option>
            <?php 
            $cCareer_lists = array(
              '01 �ɵá�', '02 �Ѻ��ҧ�����', '03 ��ҧ�����', '04 ��áԨ', '05 ����/���Ǩ', 
              '06 �ѡ�Է���ҵ����йѡ෤�ԡ', '07 �ؤ�ҡô�ҹ�Ҹ�ó�آ', '08 �ѡ�ԪҪվ/�ѡ�Ԫҡ��', '09 ����Ҫ��÷����', '10 �Ѱ����ˡԨ', 
              '11 ��������������Ҫվ', '12 �ѡ�Ǫ/�ҹ��ҹ��ʹ�', '13 ����' 
            );

            // �����������¡�ô�ҹ�����ʴ��繵���á�ش
            // �ʴ�����繢��������
            if( !in_array($cCareer, $cCareer_lists) ){
              ?>
              <option value="<?=$cCareer;?>" selected="selected" ><?=$cCareer;?></option>
              <option value="">---------</option>
              <?php
            }

            foreach ($cCareer_lists as $key => $career_item) {
              $career_selected = ( $career_item == $cCareer ) ? 'selected="selected"' : '' ;
              ?>
              <option value="<?=$career_item;?>" <?=$career_selected;?> ><?=$career_item;?></option>
              <?php
            }
            ?>
            </select>          </td>
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
        <?
        $sql="select * from education order by row_id asc";
		$query=mysql_query($sql);
		while($rows=mysql_fetch_array($query)){
			if($cEducation==$rows["edu_code"]){
		?>
        	<option value="<?=$rows["edu_code"];?>" selected="selected"><?=$rows["edu_code"]."-".$rows["edu_name"];?></option>
        <?
			}else{
		?>
        	<option value="<?=$rows["edu_code"];?>"><?=$rows["edu_code"]."-".$rows["edu_name"];?></option>
        <?
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
    <td align="right" bgcolor="#66CC99" class="fonthead">�����������ѧ���</td>
    <td colspan="7" bgcolor="#66CC99"><span class="style1">***</span></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#66CC99" class="fonthead">House NO:</td>
    <td bgcolor="#66CC99"><input name="address_eng" type="text" id="address_eng" value="<?=$cAddress_eng;?>" size="10"></td>
    <td align="right" bgcolor="#66CC99" class="fonthead">Moo:</td>
    <td bgcolor="#66CC99"><input name="address_moo" type="text" id="address_moo" value="<?=$cAddress_moo;?>" size="10"></td>
    <td align="right" bgcolor="#66CC99" class="fonthead">Soi:</td>
    <td bgcolor="#66CC99"><input name="address_soi" type="text" id="address_soi" value="<?=$cAddress_soi;?>" size="10"></td>
    <td align="right" bgcolor="#66CC99" class="fonthead">Road:</td>
    <td bgcolor="#66CC99"><input name="address_road" type="text" id="address_road" value="<?=$cAddress_road;?>" size="10"></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#66CC99" class="fonthead">Sub-District:</td>
    <td bgcolor="#66CC99"><input name="tambol_eng" type="text" id="tambol_eng" value="<?=$cTambol_eng;?>" size="10"></td>
    <td align="right" bgcolor="#66CC99" class="fonthead">District:</td>
    <td bgcolor="#66CC99"><input name="ampur_eng" type="text" id="ampur_eng"  value="<?=$cAmpur_eng;?>" size="10"></td>
    <td align="right" bgcolor="#66CC99">Province:</td>
    <td bgcolor="#66CC99"><input name="changwat_eng" type="text" id="changwat_eng" value="<?=$cChangwat_eng;?>" size="10"></td>
    <td align="right" bgcolor="#66CC99">&nbsp;</td>
    <td bgcolor="#66CC99">&nbsp;</td>
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
		<select name="typearea" id="typearea">
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
     <SELECT NAME="goup" id="goup">
     <option value="<?=$cGoup;?>" selected><?=$cGoup;?></option>
    <option value=""><-���͡-></option>
      <? 
		  $sqlg="SELECT * 
						FROM `grouptype` 
						WHERE `status` = 'y'
						ORDER BY type ASC,`row_id` ASC";
		  $queryg=mysql_query($sqlg)or die (mysql_error());
		  while($arrg=mysql_fetch_array($queryg)){

		 if($arrg['name']==$cGoup){
 		  ?>
      <option value="<?=$arrg['name']?>" selected="selected"> <?=$arrg['name']?></option>
      <? }else{ ?>

      <option value="<?=$arrg['name']?>"><?=$arrg['name']?></option>
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
    <td width="7%" align="right" class="fonthead">��������ʹ</td>
    <td width="29%"><SELECT NAME="blood" id="blood">
     <option value="<?=$cBlood;?>"><?=$cBlood;?></option>
      <option value="����Һ�������ʹ">����Һ�������ʹ</option>
      <option value="����µ�Ǩ�������ʹ ">����µ�Ǩ�������ʹ </option>
      <option value="��">��</option>
      <option value="��">��</option>
      <option value="�ͺ�">�ͺ�</option>
      <option value="��">��</option>
    </SELECT></td>
    <td width="6%" class="fonthead">����<div id="list3" style="position: absolute;"></div></td>
    <td width="58%"><INPUT TYPE="text" NAME="drugreact" id="drugreact" value="<?=$cDrugreact;?>">
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
  <tr>
    <td align="right" class="fonthead">Note VIP :</td>
    <td><input type="text" name="note_vip" size="50" value="<?=$cNote_vip;?>" id="note_vip"></td>
    <td class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    </table>

</fieldset>
<BR>
<?
print "  <font face='Angsana New' size='4' color =red>&nbsp;&nbsp;&nbsp; **�Ҥ����ش����&nbsp;&nbsp;&nbsp; $cD1-$cM1-$cY1&nbsp;$cT1 **</font>";
?>
<p align="center"><input type='submit' value='���/ŧ����¹' name='B1'>&nbsp;&nbsp;
</p>
</form>
<script>
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
</body>