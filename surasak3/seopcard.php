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
	$cHn =$row->hn;
	$cYot=$row->yot;
	$cName=$row->name;
	$cSurname =$row->surname;
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
include("unconnect.inc");
//print "$cDbirth";

?>
<title>�ʴ��������Ǫ����¹������</title>
<body bgcolor='<?=$color;?>' text='#3300FF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
<h3 align="center" class="fonttitle">�Ǫ����¹ / MEDICAL RECORD</h3>
<h3 align="center" class="fonttitle">�ç��Һ�Ť�������ѡ��������  �ӻҧ</h3>
<form name='f1' method='POST' action='opdwork.php' onsubmit='return checkForm();'>

<fieldset>
    <legend>�����Ż���ѵ���ǹ��� :  HN : <?=$cHn;?></legend>
    
    <table width="100%" border="0">
  <tr>
    <td width="15%" align="center">
<a href='Capture.php?id=<?=$cIdcard;?>&hn=<?=$cHn;?>&yot=<?=$cYot;?>&name1=<?=$cName;?>&name2=<?=$cSurname;?>' target=_blank>
    <IMG SRC='../image_patient/<?=$cIdcard;?>.jpg' WIDTH='100' HEIGHT='150' BORDER='0' ALT=''></a></td>
    <td width="85%" valign="top">
    <table border="0">
      <tr>
        <td align="right"  class="fonthead">�ӹ�˹��:</td>
        <td> 
          <input name="yot" type="text" id="yot" value="<?=$cYot;?>" size="5" >
        </td>
        <td align="right" class="fonthead">����:</td>
        <td> 
          <input name="name" type="text" id="name" value="<?=$cName;?>" size="15" >
        </td>
        <td align="right" class="fonthead">ʡ��:</td>
        <td> 
          <input name="surname" type="text" id="surname" value="<?=$cSurname;?>" size="15">
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
            <option>?</option>
            <option <? if($cSex=='�'){ echo "selected"; }?> value="�">�</option>
            <option <? if($cSex=='�'){ echo "selected"; }?> value="�">�</option>
          </select>
        </td>
        <td colspan="3" align="right" class="fonthead">�����Ţ��Шӵ�ǻ�ЪҪ�:</td>
        <td> 
          <input name="idcard" type="text" id="idcard" value="<?=$cIdcard;?>" size="15" maxlength="13">
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
</select>
        </td>
        </tr>
      <tr>
        <td align="right" class="fonthead">ʶҹ�Ҿ:</td>
        <td> 
          <select size="1" name="married" id="married">
<option value=""><-���͡-></option>
<option value="�ʴ"<? if($cMarried=='�ʴ'){ echo "selected";}?>>�ʴ</option>
<option value="����"<? if($cMarried=='����'){ echo "selected";}?>>����</option>
<option value="�����/����"<? if($cMarried=='�����/����'){ echo "selected";}?>>�����/����</option>
<option value="����"<? if($cMarried=='����'){ echo "selected";}?>>����</option>
</select>
        </td>
        <td class="fonthead">�Ҫվ:</td>
        <td colspan="3"> 
          <select size="1" name="career" id="career">
            <option value=""><-���͡-></option>
             <option value='<?=$cCareer;?>' selected><?=$cCareer;?></option>";
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
    <select size="1" name="goup" id="goup">
        <option  selected="selected" value="0" >-------------------------���͡-------------------------</option>
        <?
						include("connect.inc");
						$query = "SELECT * from grouptype order by row_id asc";
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
      </select>
      </td>
    <td align="right" class="fonthead">�ѧ�Ѵ:</td>
    <td><select size="1" name="camp" id="camp">
      <option value="<?=$cCamp;?>" selected><?=$cCamp;?></option>
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
    </select></td>
    </tr>
  <tr>
    <td align="right" class="fonthead">�Է�ԡ���ѡ��:</td>
    <td><select size="1" name="ptright1" id="ptright1">
      <option  value="<?=$cPtright1;?>"><?=$cPtright1;?></option>
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
    <td class="fonthead">�ԡ�ҡ:</td>
    <td><select   size="1" name="ptfmon" id="ptfmon">
      <option value="<?=$cPtfmon;?>"><?=$cPtfmon;?></option>
      <option value="MO01 ���ͧ">MO01 ���ͧ</option>
      <option value="MO02 �Դ�">MO02 �Դ�</option>
      <option value="MO03 ��ô�">MO03 ��ô�</option>
      <option value="MO04 �ص�">MO04 �ص�</option>
      <option value="MO05 �������">MO05 �������</option>
    </select></td>
    <td align="right" class="fonthead">˹��§ҹ:</td>
    <td><input type='text' name="guardian" size='20'  value="<?=$cGuardian;?>" id="guardian"></td>
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
    <td class="fonthead">����</td>
    <td><INPUT TYPE="text" NAME="drugreact" id="drugreact" value="<?=$cDrugreact;?>"></td>
    </tr>
  <tr>
    <td align="right" class="fonthead">�����˵�</td>
    <td><select size="1" name="idguard" id="idguard">
      <option value="<?=$cIdguard;?>"><?=$cIdguard;?></option>
      <option >MX01 ����/��ͺ����</option>
      <option >MX02 �ջѭ������ͧ�Է��</option>
      <option >MX03 VIP</option>
    </select></td>
    <td class="fonthead">�����˵�</td>
    <td><input type="text" name="note" size="50" value="<?=$cNote;?>" id="note"></td>
    </tr>
    </table>

</fieldset>
<BR>
<?
print "  <font face='Angsana New' size='4' color =#oooooo>&nbsp;&nbsp;&nbsp; **�Ҥ����ش����&nbsp;&nbsp;&nbsp; $cD1-$cM1-$cY1&nbsp;$cT1 **</font>";
?>
<!--<p align="center"><input type='submit' value='�ѹ�֡/ŧ����¹' name='B1'>&nbsp;&nbsp;
</p>-->
</form>

</body>
