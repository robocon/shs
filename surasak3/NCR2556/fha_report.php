<body onLoad="window.print();">
<style type="text/css">
.font1{
	font-family:"TH SarabunPSK";
	font-size:16pt;
	font-weight:bold;
}
.font2{
	font-family:"TH SarabunPSK";
	font-size:14pt;
}
@media print{
  #no_print{display:none;}
}
.theBlocktoPrint { 
  background-color: #000; 
  color: #FFF; 
} 
</style>
<?php
include("connect.inc");

  // ���ҧ departments key
  $q = mysql_query("SELECT `code`,`name` FROM `departments`");
  $departs = array();
  while ($item = mysql_fetch_assoc($q)) {
    $key = $item['code'];
    $departs[$key] = $item['name'];
  }

		$sql = "Select * From drug_fail_2  where row_id = '".$_GET["row_id"]."' limit  1 ";
		$result = mysql_query($sql) or die(mysql_error());
		$arr_edit = mysql_fetch_assoc($result);
		
		
		$sql="SELECT * FROM `departments` where code='".$arr_edit['depart']."' and status='y' ";
		$query=mysql_query($sql)or die (mysql_error());
		$arr=mysql_fetch_array($query);
		
		$sql2="SELECT * FROM `departments` where code='".$arr_edit['area']."' and status='y' ";
		$query2=mysql_query($sql2)or die (mysql_error());
		$arr2=mysql_fetch_array($query2);
		
		
?>
<h1 class="font1" align="center">Ẻ��§ҹ������Ҵ����͹�ҧ�Ңͧ�ç��Һ�Ť�������ѡ�������� �ӻҧ</h1>
<form name="f1" action="fha_add.php" method="post" onSubmit="return fncSubmit();">


<table border="0" align="center" cellpadding="2" cellspacing="0" class="font2">
  <tr>
    <td>����-���ʡ�ż�����</td>
    <td align="center"><?=$arr_edit['ptname'];?></td>
    <td align="right">HN</td>
    <td align="center"><?=$arr_edit['hn'];?></td>
    <td align="right">AN</td>
    <td align="center"><? if($arr_edit['an']!=''){ echo $arr_edit['an'];}else{ echo "-"; }?></td>
    <td><input type="radio" name="type_opd" id="radio10" value="opd" <? if($arr_edit['type_opd']=="opd" || $arr_edit['an']==''){ echo "checked"; } ?> disabled/>
      �����¹͡
      <input type="radio" name="type_opd" id="radio11" value="ipd"  <? if($arr_edit['type_opd']=="ipd" || $arr_edit['an']<>''){ echo "checked"; } ?> disabled/>        �������</td>
  </tr>
  <tr>
    <td >ʶҹ����Դ�˵�</td>
    <td align="center">&nbsp;<?=$arr2['name'];?></td>
    <td>�ѹ��͹��</td>
    <td align="center"><?=$arr_edit['fha_date'];?></td>
    <td>����</td>
    <td align="center"><?=$arr_edit['fha_time'];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>��������</td>
    <td align="center"><?=$arr_edit['order_name'];?></td>
    <td>��������</td>
    <td align="center"><?=$arr_edit['pay_name'];?></td>
    <td>��������</td>
   <td align="center"><?=$arr_edit['give_name'];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>�����§ҹ</td>
    <td align="center"><?=$arr_edit['report_name'];?></td>
    <td>�ͧ/Ἱ�</td>
    <td align="center">&nbsp;<?=$arr['name'];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>�����</td>
    <td colspan="7">
    <?php
    $lists = array('1' => 'ENV ROUND',
    '2' => 'IC ROUND',
    '3' => 'RM ROUND',
    '4' => '12 �Ԩ�������ǹ',
    '5' => '˹�����§ҹ�ͧ',
    '6' => '����',
    '7' => '��õ�Ǩ��þ�Һ��',
    '8' => '��·�����û�Ш��ѹ'
    );
    $from_id = $arr_edit['come_from_id'];
    if( $from_id !== '6' ){
      echo $lists[$from_id];
    }else{
      $from_detail_id = $arr_edit['come_from_detail'];
      echo $departs[$from_detail_id];
    }
    ?>
    </td>
  </tr>
</table><br />
<table border="1" align="center" cellpadding="0" cellspacing="0" class="font2" style="border-collapse:collapse" bordercolor="#000000">
  <tr>
    <td colspan="4" align="center">��Դ������Ҵ����͹�ҧ��</td>
    </tr>
  <tr>
    <td colspan="2" align="center">�������� (Prescribing error)</td>
    <td colspan="2" align="center">��è�����(Dispensing error)</td>
    </tr>
  <tr>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="p1" type="checkbox" id="p1" value="1"  <? if($arr_edit['p1']=="1"){ echo "checked"; }?> disabled/>
          �����������բ�ͺ���</td>
        </tr>
      <tr>
        <td><input name="p2" type="checkbox" id="p2" value="1"  <? if($arr_edit['p2']=="1"){ echo "checked"; }?> disabled/>
�����������բ��������</td>
      </tr>
      <tr>
        <td><input name="p3" type="checkbox" id="p3" value="1" <? if($arr_edit['p3']=="1"){ echo "checked"; }?> disabled/>
����ҷ��������ջ���ѵ���</td>
      </tr>
      <tr>
        <td><input name="p4" type="checkbox" id="p4" value="1"  <? if($arr_edit['p4']=="1"){ echo "checked"; }?> disabled/>
����ҷ���Դ��ԡ����ҵ�͡ѹ</td>
      </tr>
      <tr>
        <td><input name="p5" type="checkbox" id="p5" value="1" <? if($arr_edit['p5']=="1"){ echo "checked"; }?> disabled />
�����㹢�Ҵ�٧�Թ�</td>
      </tr>
      <tr>
        <td><input name="p6" type="checkbox" id="p6" value="1" <? if($arr_edit['p6']=="1"){ echo "checked"; }?> disabled/>

          �����㹢�Ҵ����Թ�</td>
      </tr>
      <tr>
        <td><input name="p7" type="checkbox" id="p7" value="1"  <? if($arr_edit['p7']=="1"){ echo "checked"; }?> disabled/>  ����...... <?=$arr_edit['p_detail']?>.......</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
     </td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="p8" type="checkbox" id="p8" value="1"  <? if($arr_edit['p8']=="1"){ echo "checked"; }?> disabled/>
          ����кؤ����ç/�Ը���/�ӹǹ</td>
      </tr>
      <tr>
        <td><input name="p9" type="checkbox" id="checkbox9" value="1"  <? if($arr_edit['p9']=="1"){ echo "checked"; }?> disabled/>
        �Դ������/��Դ��</td>
      </tr>
      <tr>
        <td><input name="p10" type="checkbox" id="checkbox10" value="1" <? if($arr_edit['p10']=="1"){ echo "checked"; }?> disabled/>
          �Դ�����ç</td>
      </tr>
      <tr>
        <td><input name="p11" type="checkbox" id="checkbox11" value="1" <? if($arr_edit['p11']=="1"){ echo "checked"; }?> disabled/>
          �Դ�ٻẺ��</td>
      </tr>
      <tr>
        <td><input name="p12" type="checkbox" id="checkbox12" value="1" <? if($arr_edit['p12']=="1"){ echo "checked"; }?> disabled />
          �Դ�Ը���</td>
      </tr>
      <tr>
        <td><input name="p13" type="checkbox" id="checkbox13" value="1" <? if($arr_edit['p13']=="1"){ echo "checked"; }?> disabled/>
          �Դ����ҳ/�ӹǹ��</td>
      </tr>
      <tr>
        <td><input name="p14" type="checkbox" id="checkbox14" value="1" <? if($arr_edit['p14']=="1"){ echo "checked"; }?> disabled/>
        ����ҫ�ӫ�͹</td>
      </tr>
      <tr>
        <td><input name="p15" type="checkbox" id="checkbox29" value="1" <? if($arr_edit['p15']=="1"){ echo "checked"; }?> disabled /> 
          ��觨��������ç�Ѻ������
</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="d1" type="checkbox" id="checkbox15" value="1"  <? if($arr_edit['d1']=="1"){ echo "checked"; }?> disabled/>
          ���������ç�Ѻ������ </td>
      </tr>
      <tr>
        <td><input name="d2" type="checkbox" id="checkbox16" value="1"  <? if($arr_edit['d2']=="1"){ echo "checked"; }?> disabled/>
        �����ҼԴ��Դ/������</td>
      </tr>
      <tr>
        <td><input name="d3" type="checkbox" id="checkbox17" value="1"   <? if($arr_edit['d3']=="1"){ echo "checked"; }?> disabled/>
          �Դ��Ҵ</td>
      </tr>
      <tr>
        <td><input name="d4" type="checkbox" id="checkbox18" value="1"  <? if($arr_edit['d4']=="1"){ echo "checked"; }?> disabled/>
          �Դ�����ç</td>
      </tr>
      <tr>
        <td><input name="d5" type="checkbox" id="checkbox19" value="1"  <? if($arr_edit['d5']=="1"){ echo "checked"; }?>  disabled/>
          �Դ�ӹǹ/����ҳ</td>
      </tr>
      <tr>
        <td><input name="d6" type="checkbox" id="checkbox20" value="1"  <? if($arr_edit['d6']=="1"){ echo "checked"; }?> disabled/>
          �Դ�ٻẺ</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="d7" type="checkbox" id="checkbox22" value="1"   <? if($arr_edit['d7']=="1"){ echo "checked"; }?> disabled/>
          �������������/��������Ҿ����Ҿ������������</td>
      </tr>
      <tr>
        <td><input name="d8" type="checkbox" id="checkbox23" value="1"  <? if($arr_edit['d8']=="1"){ echo "checked"; }?> disabled/>
          �ҢҴ Stock �������ö�Ѵ���������觢�й��</td>
      </tr>
      <tr>
        <td><input name="d9" type="checkbox" id="checkbox28" value="1"   <? if($arr_edit['d9']=="1"){ echo "checked"; }?> disabled/>
          ���� .......<?=$arr_edit['d_detail']?>........</td>
      </tr>
      <tr>
        <td align="center"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center">��äѴ�͡����� (Transcribing error)</td>
    <td colspan="2" align="center">��ú������� (Administration error)</td>
    </tr>
  <tr>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">

      <tr>
        <td><input name="t1" type="checkbox" id="checkbox21" value="1"   <? if($arr_edit['t1']=="1"){ echo "checked"; }?> disabled/>
          �Դ������/��Դ��</td>
      </tr>
      <tr>
        <td><input name="t2" type="checkbox" id="checkbox24" value="1" <? if($arr_edit['t2']=="1"){ echo "checked"; }?> disabled/>
        �Դ�����ç</td>
      </tr>
      <tr>
        <td><input name="t3" type="checkbox" id="checkbox25" value="1"  <? if($arr_edit['t3']=="1"){ echo "checked"; }?> disabled/>
          �Դ�ٻẺ��</td>
      </tr>
      <tr>
        <td><input name="t4" type="checkbox" id="checkbox26" value="1"  <? if($arr_edit['t4']=="1"){ echo "checked"; }?> disabled/>
          �Դ�Ը���</td>
      </tr>
      <tr>
        <td><input name="t5" type="checkbox" id="checkbox27" value="1"  <? if($arr_edit['t5']=="1"){ echo "checked"; }?> disabled/>
          �Դ����ҳ/�ӹǹ�ҫ�ӫ�͹</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="t6" type="checkbox" id="checkbox32" value="1"  <? if($arr_edit['t6']=="1"){ echo "checked"; }?> disabled/>
          �����ç�Ѻ���ͼ����</td>
      </tr>
      <tr>
        <td><input name="t7" type="checkbox" id="checkbox33" value="1"  <? if($arr_edit['t7']=="1"){ echo "checked"; }?> disabled/>
          �ҷ��ᾷ����������</td>
      </tr>
      <tr>
        <td><input name="t8" type="checkbox" id="checkbox34" value="1" <? if($arr_edit['t8']=="1"){ echo "checked"; }?> disabled/>
          ����.....<?=$arr_edit['t_detail']?>......</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="a1" type="checkbox" id="checkbox39" value="1" <? if($arr_edit['a1']=="1"){ echo "checked"; }?> disabled/>
          ������������ҷ���˹�/��������</td>
      </tr>
      <tr>
        <td><input name="a2" type="checkbox" id="checkbox40" value="1"  <? if($arr_edit['a2']=="1"){ echo "checked"; }?> disabled/>
          �Դ��Ҵ/�����ç</td>
      </tr>
      <tr>
        <td><input name="a3" type="checkbox" id="checkbox41" value="1" <? if($arr_edit['a3']=="1"){ echo "checked"; }?> disabled/>
          �Դ������/��Դ��</td>
      </tr>
      <tr>
        <td><p>
          <input name="a4" type="checkbox" id="checkbox42" value="1" <? if($arr_edit['a4']=="1"){ echo "checked"; }?> disabled/>
          �Դ�ѵ�ҡ�������/��������</p></td>
      </tr>
      <tr>
        <td><input name="a5" type="checkbox" id="checkbox43" value="1"  <? if($arr_edit['a5']=="1"){ echo "checked"; }?> disabled/>
          �Դ���˹�/�Զշҧ/�ٻẺ</td>
      </tr>
      <tr>
        <td><input name="a6" type="checkbox" id="checkbox44" value="1"  <? if($arr_edit['a6']=="1"){ echo "checked"; }?> disabled/>
          �Դ��</td>
      </tr>
      <tr>
        <td><input name="a7" type="checkbox" id="checkbox45" value="1"  <? if($arr_edit['a7']=="1"){ echo "checked"; }?> disabled/>
          ���� .....<?=$arr_edit['a_detail']?>.....</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="a8" type="checkbox" id="checkbox46" value="1"  <? if($arr_edit['a8']=="1"){ echo "checked"; }?> disabled/>
          ��������ú��¡��(�Ҵ/�Թ)</td>
      </tr>
      <tr>
        <td><input name="a9" type="checkbox" id="checkbox47" value="1"  <? if($arr_edit['a9']=="1"){ echo "checked"; }?> disabled/>
          ������ҡ����/���¡��Ҩӹǹ���駷�����</td>
      </tr>
      <tr>
        <td><input name="a10" type="checkbox" id="checkbox48" value="1"  <? if($arr_edit['a10']=="1"){ echo "checked"; }?> disabled/>
          �����/����ҼԴ</td>
      </tr>
      <tr>
        <td><p>
          <input name="a11" type="checkbox" id="checkbox49" value="1"  <? if($arr_edit['a11']=="1"){ echo "checked"; }?> disabled/>
          ���ѡ���ҼԴ(�Ҥ�ҧ stock/<br />
          �����ѹ�����ö�ء�Թ <br />
          �������������� �蹹͡������ ����ͧ�ѹ�ʧ)</p></td>
      </tr>
      <tr>
        <td><input name="a12" type="checkbox" id="checkbox50" value="1"  <? if($arr_edit['a12']=="1"){ echo "checked"; }?> disabled/>
          ������������/��������Ҿ</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top">Compliance Error (������Ңͧ������)</td>
    </tr>
  <tr>
    <td colspan="4" valign="top"><input name="c1" type="checkbox" id="c1" value="1"  <? if($arr_edit['c1']=="1"){ echo "checked"; }?> disabled/>
      ������������Ѻ��зҹ�ҵ��ᾷ�����
      <input name="c2" type="checkbox" id="checkbox31" value="1" <? if($arr_edit['c2']=="1"){ echo "checked"; }?> disabled />
      ����.............<?=$arr_edit['c_detail']?>............</td>
    </tr>
</table>
<br />
<table border="0" align="center" cellpadding="0" cellspacing="0" class="font2">
  <tr>
    <td colspan="3"><u>�дѺ�����ع�ç</u></td>
    </tr>
  <tr>
    <td width="27"><input type="radio" name="level_vio" id="radio" value="A"  <? if($arr_edit['level_vio']=="A"){ echo "checked"; }?> disabled/></td>
    <td width="17">A</td>
    <td width="718">�˵ء�ó������͡�ʷ��С������Դ������Ҵ����͹</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio2" value="B"  <? if($arr_edit['level_vio']=="B"){ echo "checked"; }?> disabled/></td>
    <td>B</td>
    <td>�Դ������Ҵ����͹��������֧������</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio3" value="C"  <? if($arr_edit['level_vio']=="C"){ echo "checked"; }?> disabled/></td>
    <td>C</td>
    <td>�Դ������Ҵ����͹�Ѻ������ �����������������Ѻ�ѹ����</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio4" value="D"  <? if($arr_edit['level_vio']=="D"){ echo "checked"; }?> disabled/></td>
    <td>D</td>
    <td>�Դ������Ҵ����͹�Ѻ������ ��ͧ���������ѧ������������������Դ�ѹ�����������������͵�ͧ�պӺѴ�ѡ��</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio5" value="E"  <? if($arr_edit['level_vio']=="E"){ echo "checked"; }?> disabled/></td>
    <td>E</td>
    <td>�Դ������Ҵ����͹�Ѻ������ �觼�����Դ�ѹ���ª��Ǥ��� ��е�ͧ�ա�úӺѴ�ѡ��</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio6" value="F"  <? if($arr_edit['level_vio']=="F"){ echo "checked"; }?> disabled/></td>
    <td>F</td>
    <td>�Դ������Ҵ����͹�Ѻ������ �觼�����Դ�ѹ���ª��Ǥ��� ��е�ͧ�͹��ç��Һ�����������ç��Һ�Źҹ���</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio7" value="G"  <? if($arr_edit['level_vio']=="G"){ echo "checked"; }?> disabled/></td>
    <td>G</td>
    <td>�Դ������Ҵ����͹�Ѻ������ �觼�����Դ�ѹ���¶����������</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio8" value="H" <? if($arr_edit['level_vio']=="H"){ echo "checked"; }?> disabled/></td>
    <td>H</td>
    <td>�Դ������Ҵ����͹�Ѻ������ �觼ŷ�����ͧ�ӡ�ê��ª��Ե</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio9" value="I" <? if($arr_edit['level_vio']=="I"){ echo "checked"; }?> disabled/></td>
    <td>I</td>
    <td>�Դ������Ҵ����͹�Ѻ������ ����Ҩ�������˵آͧ������ª��Ե</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td height="32" colspan="3">��������´���� �ͧ�˵ء�ó� </td>
  </tr>
  <tr>
    <td colspan="3"><?=$arr_edit['action_detail'] ?></td>
  </tr>
  <tr id="no_print">
    <td><a href="fha_from.php">��Ѻ�˹��Ẻ�����</a></td>
  </tr>
</table>
</form>
</body>