<style type="text/css">
<!--
body{ font-family:"TH SarabunPSK"; 
font-size:18px;
}
.headsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:22px;
	color: #0000FF;
	}
.txtsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:16px; 
	font-weight:bold;
	}

.style1 {
	font-family: "TH SarabunPSK";
	font-size: 28px;
	font-weight: bold;
}
-->
</style>
<?php
    include("connect.inc");

    $query = "SELECT * FROM druglst WHERE drugcode = '$Dgcode'";
	//echo $query;
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
        $cComcode=$row->comcode;
        $cDrugcode=$row->drugcode;
        $cTradname=$row->tradname;
        $cGenname=$row->genname;
		$cDrugname=$row->drugname;
		$cDrug_nature=$row->drug_nature;
		$cDrug_properties=$row->drug_properties;
		$cDrugnote=$row->drugnote;
        $cMinimum=$row->minimum;
        $cUnit=$row->unit;
       $cUnitpri=$row->unitpri;
      $cSalepri =$row->salepri;
      $cPart =$row->part;
      $cFreepri =$row->freepri;
	$cFreelimit =$row->freelimit; 
      $cStock =$row->stock;
      $cMainstk=$row->mainstk;
      $cTotalstk=$row->totalstk;
      $cSlcode =$row->slcode;
      $cBcode =$row->bcode;
     $cEdpri =$row->edpri;
     $cPack =$row->pack;
	 $cPack2 =$row->packing;
     $cPackpri =$row->packpri;
     $cPackpri_vat =$row->packpri_vat;
     $cContract =$row->contract;
	 $spec =$row->spec;
	 $default_order = $row->default_order;
	$snspec =$row->snspec;
		$cCode24 =$row->code24;
		$cDrugtype = $row->drugtype;
		$cdpy_code = $row->dpy_code;
		$cmedical_sup_free = $row->medical_sup_free;
		$status_drug = $row->status;
		$typedrug = $row->typedrug;
		$tmt = $row->tmt;
        $procat = $row->product_category;
		$prodrugtype = $row->product_drugtype;
		
        $edpri_from = $row->edpri_from;
		$grouptype = $row->grouptype;
                  }  
   else {
      echo "��辺 ���� : $drugcode ";
           }    
include("unconnect.inc");
?>
 <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><div style="margin: 5px 5px 5px 5px;"><img src="../shs.png" width="119" height="92" border="0" /></div>      
    <p class="style1">�������Ѻ��ا�����䢢�������/�Ǫ�ѳ��</p>
    </td>
  </tr>
</table>
 <br />
 <table width="95%" border="5" align="center" cellpadding="2" cellspacing="0" bordercolor="#339999">
    <td>
<?
        $cComcode=trim($cComcode);
        $cDrugcode=trim($cDrugcode);
        $cTradname=trim($cTradname);
        $cGenname=trim($cGenname);
		$cDrugname=trim($cDrugname);
print "<form method='POST' action='dgupdate.php' >";
print "<table border='0' width='100%' height='345'>";
print "<tr>";
print " <td width='7%' height='25'></td>";
print "  <td width='48%' height='25'>";
print "  <p align='left' class='headsarabun'><b>�����䢢������ռŵ�ͤ�ѧ��</b></p></td>";
print "  <td width='45%' height='25'><p align='left' class='headsarabun'><b>�ô�Ӵ��¤������Ѵ���ѧ</b></p></td>";
print " </tr>";
print " <tr>";
print " <td width='7%' height='236'></td>";
print "   <td width='48%' height='236'>���ʺ���ѷ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='comcode' size='15' tabindex='1' value='$cComcode'><br>";
print "  ������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drugcode' size='15' tabindex='2' value='$cDrugcode' readonly ><br>";
print "   ���͡�ä��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='tradname' size='40' tabindex='3' value='$cTradname'><br>";
print "  �������ѭ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='genname' size='40' tabindex='4' value='$cGenname'><br>";
print "  ������������&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drugname' size='40' tabindex='4' value='$cDrugname'><br>";

print "  �ѡɳ���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drug_nature' size='40' tabindex='4' value='$cDrug_nature'><br>";
print "  ��þ�س&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drug_properties' size='40' tabindex='4' value='$cDrug_properties'><br>";
print "  ����͹�������&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drugnote' size='40' tabindex='4' value='$cDrugnote'><br>";

print "  ��������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <select name='typedrug' class='txtsarabun' >
 			<option value='$typedrug' selected>$typedrug</option>
			<option value=''>--���͡--</option>
			<option value='T01 ���'>���</option>
			<option value='T02 ���'>���</option>
			<option value='T03 �մ'>�մ</option>
			<option value='T04 �Ѥ�չ'>�Ѥ�չ</option>
			</select><br>";

print " &#3627;&#3609;&#3656;&#3623;&#3618;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input class='txtsarabun'  type='text' name='unit' size='20' tabindex='6'value='$cUnit'><br>";
print "  &#3619;&#3634;&#3588;&#3634;&#3607;&#3640;&#3609;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp; <input class='txtsarabun'  type='text' name='unitpri' size='20' tabindex='6'value='$cUnitpri'><br>";
print "  &#3619;&#3634;&#3588;&#3634;&#3586;&#3634;&#3618;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp; <input class='txtsarabun'  type='text' name='salepri' size='20' tabindex='7'value='$cSalepri'><br>";
print "  <a target=_BLANK href='part.htm'>&#3585;&#3621;&#3640;&#3656;&#3617;</a>(part)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "  <input class='txtsarabun'  type='text' name='part' size='20' tabindex='8'value='$cPart'><br>";
?>
<select name='part' tabindex='8' class="txtsarabun">
          <option value='DDL' <?=($cPart=='DDL')?'selected':'';?>>DDL = ��㹺ѭ������ѡ��觪ҵ� </option>
          <option value='DDY' <?=($cPart=='DDY')?'selected':'';?>>DDY = �ҹ͡�ѭ������ѡ��觪ҵ� ���ԡ��</option>
          <option value='DDN' <?=($cPart=='DDN')?'selected':'';?>>DDN = �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����</option>
          <option value='DSY' <?=($cPart=='DSY')?'selected':'';?>>DSY = �Ǫ�ѳ���ԡ��</option>
          <option value='DSN' <?=($cPart=='DSN')?'selected':'';?>>DSN = �Ǫ�ѳ���ԡ�����</option>
          <option value='DPY' <?=($cPart=='DPY')?'selected':'';?>>DPY = �ػ�ó��ԡ��</option>
          <option value='DPN' <?=($cPart=='DPN')?'selected':'';?>>DPN = �ػ�ó��ԡ����� </option>
      </select><br>
<?
print "  �ѭ����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='drugtype' size='2' value='$cDrugtype' onkeypress='if(event.keyCode>=3585 && event.keyCode <=3592) return true; else return false;'><br>";

print "  &#3619;&#3634;&#3588;&#3634;&#3629;&#3640;&#3611;&#3585;&#3619;&#3603;&#3660;&#3648;&#3610;&#3636;&#3585;&#3652;&#3604;&#3657;&nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='freepri' size='10' tabindex='9'value='$cFreepri'><br>";
print "  ('' '' �ԡ������Թ)&nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='freelimit' size='11' tabindex='9'value='$cFreelimit'><BR>";

print "     �����Ţ ʻ ���ᾷ��&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='spec' size='20' tabindex='20' value=$spec><BR>";

print "     ������ 24 ��ѡ&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='code24' size='30' tabindex='24' value=$cCode24><BR>";
print "     �ӹǹ�ҷ����觫��ͻ�Ш�&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='default_order' size='20' tabindex='20' value=$default_order><BR>";

print "     �Ǫ�ѳ������¹͡&nbsp;&nbsp;&nbsp;&nbsp; <SELECT NAME=\"medical_sup_free\" class='txtsarabun'><Option value=\"0\" ".($cmedical_sup_free==0?"Selected":"")." >�ԡ�����</Option><Option value=\"1\" ".($cmedical_sup_free==1?"Selected":"")." >�ԡ��</Option></SELECT>";

print "  </td>";



print "  <td width='45%' height='236'>&#3592;&#3635;&#3609;&#3623;&#3609;&#3651;&#3609;&#3627;&#3657;&#3629;&#3591;&#3592;&#3656;&#3634;&#3618;&nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='stock' size='10' tabindex='11' value='$cStock' readonly><br>";
print "   &#3592;&#3635;&#3609;&#3623;&#3609;&#3651;&#3609;&#3588;&#3621;&#3633;&#3591;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input class='txtsarabun'  type='text' name='mainstk' size='10' tabindex='12' value='$cMainstk' readonly><br>";
print " &#3592;&#3635;&#3609;&#3623;&#3609;&#3626;&#3640;&#3607;&#3608;&#3636;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "<input class='txtsarabun'  type='text' name='totalstk' size='10' tabindex='13' value='$cTotalstk' readonly><br>";
print "  <a target=_BLANK href='slipcode.php'>&#3619;&#3627;&#3633;&#3626;&#3623;&#3636;&#3608;&#3637;&#3651;&#3594;&#3657;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp; <input class='txtsarabun'  type='text' name='slcode' size='10' tabindex='14' value=$cSlcode>&nbsp;&nbsp;&nbsp;&nbsp;<br>";
print "    <a target=_BLANK href='bcode.php'>&#3619;&#3627;&#3633;&#3626;&#3626;&#3634;&#3619;&#3610;&#3633;&#3597;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input class='txtsarabun'  type='text' name='bcode' size='15' tabindex='14'value=$cBcode><br>";
print "   &#3619;&#3634;&#3588;&#3634;&#3585;&#3621;&#3634;&#3591;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "    <input class='txtsarabun'  type='text' name='edpri' size='10' tabindex='16'value=$cEdpri><br>";
print "   packing&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print " &nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='pack' size='10' tabindex='17' value=$cPack><br>";
print "   pack&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print " &nbsp;&nbsp;&nbsp;<input class='txtsarabun'  type='text' name='pack2' size='10' tabindex='17' value=$cPack2><br>";
print "   &#3619;&#3634;&#3588;&#3634;/&#3649;&#3614;&#3588;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input class='txtsarabun'  type='text' name='packpri' size='10' tabindex='18' value=$cPackpri>�Ҥ������� VAT<br>";
print "   &#3619;&#3634;&#3588;&#3634;/&#3649;&#3614;&#3588;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "   <input class='txtsarabun'  type='text' name='packpri_vat' size='10' tabindex='18' value=$cPackpri_vat>�Ҥ���� VAT<br>";
print "     &#3592;&#3656;&#3634;&#3618;&#3648;&#3591;&#3636;&#3609;contack&nbsp;&nbsp;&nbsp;";
print "    &nbsp;&nbsp;&nbsp; <input class='txtsarabun'  type='text' name='contract' size='10' tabindex='19' value=$cContract><br>";

print "     �ӹǹ�ҧ�дѺ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='minimum' size='10' tabindex='20' value=><br>";

print "     �����Ţ����ػ�ó�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='snspec' size='20' tabindex='21' value='$snspec'><br>";

print "     �����ػ�ó�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='dpy_code' size='20' tabindex='22' value=$cdpy_code><br>";

print "     ��Ѻ�ͧ������� <SELECT NAME=\"status_chdrug\"><Option value=\"\" ".($status_drug==""?"Selected":"")." >����ա����</Option><Option value=\"A\" ".($status_drug=="A"?"Selected":"")." >ANGIOTENSIN II RECEPTOR ANTAGONISTS</Option><Option value=\"B\" ".($status_drug=="B"?"Selected":"")." >STATINS</Option><Option value=\"C\" ".($status_drug=="C"?"Selected":"")." >PROTON PUMP INHIBITORS</Option><Option value=\"D\" ".($status_drug=="D"?"Selected":"")." >COX-2 SELECTIVE INHIBITORS</Option><Option value=\"E\" ".($status_drug=="E"?"Selected":"")." >���⤫��չ</Option></SELECT><br>";

print "   TMT CODE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input class='txtsarabun'  type='text' name='tmt' size='10' tabindex='23' value='$tmt'><br>";

$edpri_from_list = array(
    1 => '(�) �Ҥҷ�����Ҩҡ��äӹǳ�����ѡࡳ���褳С�������Ҥҡ�ҧ��˹�',
    2 => '(�) �Ҥҷ�����Ҩҡ�ҹ�������Ҥ���ҧ�ԧ�ͧ��ʴط�����ѭ�ա�ҧ�Ѵ��',
    3 => '(�) �Ҥ��ҵðҹ����ӹѡ������ҳ����˹��§ҹ��ҧ��蹡�˹�(�Ҥ��ҵðҹ�Ǫ�ѳ���������� ��� ʸ 0228.07.2/�688 ŧ �ѹ��� 6 �ԧ�Ҥ� �.�.2556)<br>(����������ѵ�Ҥ����������������ػ�ó�㹡�úӺѴ�ѡ���ä ��� �� 0422.2/����� � 1 ŧ�ѹ��� 4 �ѹ�Ҥ� 2556)',
    4 => '(�) �Ҥҷ�����Ҩҡ����׺�ҤҨҡ��ͧ��Ҵ',
    5 => '(�) �Ҥҷ���«������ͨ�ҧ������ѧ�ش�������������ͧ�է�����ҳ',
    6 => '(�) �Ҥ����㴵����ѡࡳ�� �Ըա�� �����Ƿҧ��ԺѵԢͧ˹��§ҹ�ͧ�Ѱ����',
);
?>
���觷���Ңͧ�Ҥҡ�ҧ 
<select name="edpri_from" class="txtsarabun">
    <?php 

    $def_edpri = 5;
    if ( $cEdpri > 0 OR $cFreelimit > 0 ) {
        $def_edpri = 3;
    }

    if( $edpri_from !== NULL ){
        $def_edpri = $edpri_from;
    }

    foreach ($edpri_from_list as $key => $value) {

        $selected = ( $key == $def_edpri ) ? 'selected' : '' ;

        ?>
        <option value="<?=$key;?>" <?=$selected;?>><?=substr($value,1,80).'...';?></option>
        <?php
    }
    ?>
</select>
<?php


print "   </tr>";
print "<tr>";
print "  <td></td>";
print "<td>Product Category&nbsp;&nbsp;&nbsp;";
?>
<select name="pro_cat" class="txtsarabun">
          <option value='' <? if($procat==''){ echo "selected"; } ?>>1 = ��Ἱ�Ѩ�غѹ����繼�Ե�ѳ��ҧ��ä��</option>
		  <option value='2' <? if($procat=='2'){ echo "selected"; } ?>>2 = ��Ἱ�Ѩ�غѹ��Ե���ͧ</option>
		  <option value='3'  <? if($procat=='3'){ echo "selected"; } ?>>3 = ��Ἱ�·���繼�Ե�ѳ��ҧ��ä��</option>
		  <option value='4'  <? if($procat=='4'){ echo "selected"; } ?>>4 = ��Ἱ�¼�Ե���ͧ</option>
		  <option value='5'  <? if($procat=='5'){ echo "selected"; } ?>>5 = ��Ἱ����ѡ�ҷҧ���͡���</option> 
		  <option value='6' <? if($procat=='6'){ echo "selected"; } ?>>6 = �Ǫ�ѳ��</option> 
		  <option value='7'  <? if($procat=='7'){ echo "selected"; } ?>>7 = ����</option> 
</select>
<?
print "</td>";
print "</tr>";
print "<tr>";
print "<td></td>";
print "<td colspan='2'>��ʴ���������آ�Ҿ����Ҹ�ó�آ&nbsp;&nbsp;&nbsp;";
?>
<select name="product_drugtype" class="txtsarabun">
          <option value='' <? if($prodrugtype==''){ echo "selected='selected'"; } ?>>����������Ǵ 6 ��ʴ���������آ�Ҿ����Ҹ�ó�آ</option>
		  <option value='1' <? if($prodrugtype=='1'){ echo "selected='selected'"; } ?>>1 = �ҵ���������ѭ (gereric name) 㹺ѭ������ѡ��觪ҵ�</option>
          <option value='2' <? if($prodrugtype=='2'){ echo "selected='selected'"; } ?>>2 = �ҷ������㹺ѭ������ѡ��觪ҵ������Ǫ�ѳ�� ���ͧ�������Ѫ����������ҡҪҴ�����Ե�͡��˹�������</option>
		  <option value='3'  <? if($prodrugtype=='3'){ echo "selected='selected'"; } ?>>3 = �ҷ������㹺ѭ������ѡ��觪ҵ������Ǫ�ѳ�� ���ͧ�������Ѫ���������ç�ҹ���Ѫ�������� �����繼���Ե���ը�˹���</option>
		  <option value='4'  <? if($prodrugtype=='4'){ echo "selected='selected'"; } ?>>4 = ������Ǫ�ѳ�������鹺ѭ�չ�ѵ������</option>
		  <option value='5'  <? if($prodrugtype=='5'){ echo "selected='selected'"; } ?>>5 = �Ѥ�չ�ä�Ѻ�ѡ�ʺ�� ��м�Ե�ѳ������ �����ҡҪҴ�¼�Ե�ͧ ������������㹺ѭ��</option> 
</select>
<?
print "</td>";
print "</tr>";
print "<tr>";
print "<td></td>";
print "<td colspan='2'>˹��·��Ѵ����&nbsp;&nbsp;&nbsp;";
?>
<select name="grouptype">
          <option value='' <? if($grouptype==''){ echo "selected"; } ?>>�ͧ���Ѫ����</option>
		  <option value='pc' <? if($grouptype=='pc'){ echo "selected"; } ?>>Ἱ��Ѵ���� ʻ.���ᾷ��</option>
</select>
<?
print "</td>";
print "</tr>";
?>
<tr align="center">
<td  width='7%' height='76'></td>
<td colspan="2" width='93%' height='76'>
<input type='submit' value='�ѹ�֡/��䢢�����' name='B1' class="txtsarabun">&nbsp;&nbsp;
<input type="button" name="button" id="button" value="�����ҵ������" onclick="window.location='dglst.php' " class="txtsarabun" />&nbsp;&nbsp;
<input type="button" name="button" id="button" value="��Ѻ˹����ѡ" onclick="window.location='../nindex.htm' " class="txtsarabun" />
</td>
</tr>
</table>
</form> 
    </td>
  </tr>
</table>




    