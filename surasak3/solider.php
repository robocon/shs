<?php
include("connect.inc");
?>
<STYLE>
.font1 {
	font-family: "Angsana New";
	font-size:20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</STYLE>
</head>

<body>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; �����</a>
<form id="form1" name="form1" method="post" action="solider.php">
<table width="48%" border="0" align="center">
  <tr>
    <td align="center">��§ҹ��õ�Ǩ��ҧ��»�Шӻ� ��.</td>
  </tr>
  <tr>
    <td align="center">
          ����� :  
<select  name='camp'>
<option value='0' >--���͡�ѧ�Ѵ--</option>
<option value='�����͹'>�����͹</option>
<option value='�.17 �ѹ2'>�.17 �ѹ2</option>
<option value='���ŷ��ú����32'>���ŷ��ú����32</option>
<option value='�.�.��������ѡ��������'>�.�.��������ѡ��������</option>
<option value='�.�ѹ4'>�.�ѹ4</option>
<option value='���½֡ú����ɻ�еټ�'>���½֡ú����ɻ�еټ�</option>
<option value='��.���.32'>��.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.,���.���.32'>���.,���.���.32</option>
<option value='�¡.���.32'>�¡.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='�ʡ.���.32'>�ʡ.���.32</option>
<option value='����.���.32'>����.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='͡.��� ���.32'>͡.��� ���.32</option>
<option value='����.���.32'>����.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='�Ȩ.���.32'>�Ȩ.���.32</option>
<option value='����.���.32'>����.���.32</option>
<option value='ʢ�.���.32'>ʢ�.���.32</option>
<option value='è.���.32'>è.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='��.���.32'>��.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='����.��.���.32'>����.��.���.32</option>
<option value='��.��.���.32'>��.��.���.32</option>
<option value='�ʾ.���.32'>�ʾ.���.32</option>
<option value='��þ���ѧ ���.32'>��þ���ѧ ���.32</option>
<option value='Ƚ.�ȷ.���.32'>Ƚ.�ȷ.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='�ٹ�����Ѿ�� ���.32'>�ٹ�����Ѿ�� ���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='��ʴըѧ��Ѵ�ӻҧ'>��ʴըѧ��Ѵ�ӻҧ</option>
<option value='��.��ѧ ʻ.��'>��.��ѧ ʻ.��</option>
<option value='��� ��.33'>��� ��.33</option>
<option value='˹��·�������'>˹��·�������</option>
</select>
&nbsp;�� :
<select name="year">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select>
    </td>
    </tr>
  <tr>
    <td align="center"><input type="submit" name="button" id="button" value="��ŧ" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</div>
<?
if(isset($_POST['button'])){
	$query2 = "select * from condxofyear_so where camp like '%".$_POST['camp']."%' and yearcheck='".$_POST['year']."' ";
	$aa2 = mysql_query($query2);
	while($result2 = mysql_fetch_array($aa2)){
		$query = "select *,concat(yot,' ',name,' ',surname) as name from opcard where hn='".$result2['hn']."'";
		$aa = mysql_query($query);
		$result = mysql_fetch_array($aa);
		$camp = substr($result[camp],4);
	?>
	<table width="100%" class="font1">
    	<tr><td colspan="4" align="center">��§ҹ��õ�Ǩ��ҧ��»�Шӻ�</td></tr>
        <tr><td width="37%">�Ţ��� </td><td colspan="2">���� <?=$result['name']?></td><td width="25%">���� 
        <?=$result2['age']?></td></tr>
        <tr><td>��ҹ�Ţ��� 
        <?=$result['address']?></td><td width="22%">�Ӻ� 
        <?=$result['tambol']?></td><td width="16%">����� 
        <?=$result['ampur']?></td><td>�ѧ��Ѵ 
        <?=$result['changwat']?></td></tr>
        <tr>
          <td colspan="4">˹����ѧ�Ѵ
            <?=$result2['camp']?>
            <br /><hr />
		</td>
        </tr>
        <tr>
          <td colspan="4">�ä����Ǩ��
          <?=$result2['diag']?></td>
        </tr>
        <tr>
          <td colspan="4">������繢ͧᾷ�����Ǩ
          <?=$result2['dx']?></td>
        </tr>
        <tr>
        <?
        $datetime= explode(" ",$result2['thidate']);
		$add=explode("-",$datetime[0]);
		?>
          <td colspan="2">��Ǩ����� <?=$add[2]."/".$add[1]."/".$add[0]." ".$datetime[1]?></td>
          <td colspan="2">ᾷ�����Ǩ
          <?=$result2['doctor']?></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4" align="center"><u>��§ҹ�Ţͧ��õ�Ǩ�����ҷ����</u></td>
        </tr>
        <tr>
          <td>�.�ѡɳз����</td>
          <td colspan="3"><?=$result2['soldier1']?>&nbsp;<?=$result2['reason_sol1']?></td>
        </tr>
        <tr>
          <td>�.���˹ѧ</td>
          <td colspan="3"><?=$result2['soldier2']?>&nbsp;<?=$result2['reason_sol2']?></td>
        </tr>
        <tr>
          <td>�.�ҧ�Թ��������</td>
          <td colspan="3"><?=$result2['soldier3']?>&nbsp;<?=$result2['reason_sol3']?></td>
        </tr>
        <tr>
          <td>�.�ҧ�Թ���������</td>
          <td colspan="3"><?=$result2['soldier4']?>&nbsp;<?=$result2['reason_sol4']?></td>
        </tr>
        <tr>
          <td>�.�ҧ�Թ������Ե</td>
          <td colspan="3"><?=$result2['soldier5']?>&nbsp;<?=$result2['reason_sol5']?></td>
        </tr>
        <tr>
          <td>�.�ҧ�Թ��觹������ͧ</td>
          <td colspan="3"><?=$result2['soldier6']?>&nbsp;<?=$result2['reason_sol6']?></td>
        </tr>
        <tr>
          <td>�.�ҧ�Թ��觻����������������׺�ѹ���</td>
          <td colspan="3"><?=$result2['soldier7']?>&nbsp;<?=$result2['reason_sol7']?></td>
        </tr>
        <tr>
          <td>�.��ͧ��л���ҷ</td>
          <td colspan="3"><?=$result2['soldier8']?>&nbsp;<?=$result2['reason_sol8']?></td>
        </tr>
        <tr>
          <td>�.��д١��Т��</td>
          <td colspan="3"><?=$result2['soldier9']?>&nbsp;<?=$result2['reason_sol9']?></td>
        </tr>
        <tr>
          <td>�.��,��,��,��١</td>
          <td colspan="3"><?=$result2['soldier10']?>&nbsp;<?=$result2['reason_sol10']?></td>
        </tr>
        <tr>
          <td colspan="4" align="center"><u>��§ҹ�Ţͧ��õ�Ǩ�����</u></td>
        </tr>
        <tr>
          <td>�.�ب����</td>
          <td>����ա�õ�Ǩ</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>�.�������</td>
          <td><?=$result2['stat_ua']?>&nbsp;<?=$result2['reason_ua']?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>�.�����</td>
          <td>����ա�õ�Ǩ</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>�.���ʹ</td>
          <td><?=$result2['summary']?>&nbsp;<?
          if($result2['stat_sgot']=="�Դ����"|$result2['stat_sgpt']=="�Դ����"|$result2['stat_alk']=="�Դ����") echo "�Ѻ ";
		if($result2['stat_cr']=="�Դ����"|$result2['stat_bun']=="�Դ����") echo "� ";
		if($result2['stat_chol']=="�Դ����"|$result2['stat_tg']=="�Դ����") echo "��ѹ ";
		if($result2['stat_bs']=="�Դ����") echo "����ҹ ";
		if($result2['stat_uric']=="�Դ����") echo "URIC ";
		//if($result2['stat_cbc']=="�Դ����") echo "CBC ";
		?>
          </td>
          <td colspan="2">�������ʹ&nbsp;&nbsp;
          <?=$result['blood']?></td>
        </tr>
        <tr>
          <td>�.��Ǩ�ä��ꡫ����</td>
          <td><?=$result2['cxr']?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>�.��Ǩ���Ը�����</td>
          <td>-</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
	</table>
	<?
	echo "<div style='page-break-after: always'></div>";
	}
}
?>
</body>
</html>