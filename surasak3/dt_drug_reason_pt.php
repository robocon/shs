<?php
session_start();
include("connect.inc");
include("checklogin.php");
include("dt_menu.php");
include("dt_patient.php");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFC1; color:#0000FF; }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
<body >
<script>
function rechk(con){
	for(var m=1;m<=con;m++){
		if(document.getElementById("reason"+m).selectedIndex==0){
			alert("��س����͡�˵ؼ�");
			return false;
		}
	}
}


</script>
<?
$count = count($_SESSION["list_drugcode"]);


?>
<FORM name="form5" METHOD=POST ACTION="dt_drug_add_pt.php" onSubmit="return rechk(<?=$count?>)" >
<table width="90%" border="0" align="center">
<tr>
  <td colspan="3" align="center"><u><strong>��س��к��˵ؼš���������㹺ѭ������ѡ��觪ҵ�</strong></u></td>
  </tr>
<tr><td width="10%" align="center"><strong>������</strong></td><td width="19%" align="center"><strong>���͡�ä��</strong></td><td width="71%" align="center"><strong>�˵ؼ�</strong></td></tr>
<?
$countddy=0;
for($i=0;$i<$count;$i++){
	$sql = "Select tradname, unit, stock, salepri, freepri, part, medical_sup_free  From druglst_pt  where drugcode = '".$_SESSION["list_drugcode"][$i]."' limit 1";
	$result = Mysql_Query($sql);
	list($drugname,$unit, $stock, $salepri, $freepri, $part, $medical_sup_free) = Mysql_fetch_row($result);
	if($part=="DDY"){
		$countddy++;
?>
<tr><td bgcolor="#FFFFCC"><?=$_SESSION["list_drugcode"][$i]?></td>
<td bgcolor="#FFFFCC"><?=$drugname?></td>
<?
		if(substr($_SESSION["list_drug_reason"][$i],0,3)=="FPT"){
	?>
	<td><SELECT NAME="reason<?=$countddy?>">
   				<Option value="">��س����͡�˵ؼ�</Option>
                <Option value="F �������ʴ������ӹ���ͧ��� (�ԡ�����)" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F") echo "selected='selected'"; ?>>�������ʴ������ӹ���ͧ��� (�ԡ�����)</Option>
		</SELECT></td>
	<?	
		}else{
?>
<td><SELECT NAME="reason<?=$countddy?>">
				<Option value="">��س����͡�˵ؼ�</Option>
                <Option value="A �Դ�ҡ�â�ҧ��§㹡������㹺ѭ������ѡ��觪ҵ� (ADR) ��������" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="A") echo "selected='selected'"; ?>>�Դ�ҡ�â�ҧ��§㹡������㹺ѭ������ѡ��觪ҵ� (ADR) ��������</Option>
                <Option value="B ����������㹺ѭ������ѡ��觪ҵ����� �š���ѡ����������������" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="B") echo "selected='selected'"; ?>>����������㹺ѭ������ѡ��觪ҵ����� �š���ѡ����������������</Option>
                <Option value="C �������㹺ѭ������ѡ��觪ҵ������ ��������բ�ͺ觪�������ҹ������� ��. ��˹�" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="C") echo "selected='selected'"; ?>>�������㹺ѭ������ѡ��觪ҵ������ ��������բ�ͺ觪�������ҹ������� ��. ��˹�</Option>
                <Option value="D �� Contraindication ���� drug interaction �Ѻ��㹺ѭ������ѡ��觪ҵ�" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="D") echo "selected='selected'"; ?>>�� Contraindication ���� drug interaction �Ѻ��㹺ѭ������ѡ��觪ҵ�</Option>
                <Option value="E ��㹺ѭ������ѡ��觪ҵ��Ҥ�ᾧ����" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="E") echo "selected='selected'"; ?>>��㹺ѭ������ѡ��觪ҵ��Ҥ�ᾧ����</Option>
                <Option value="F �������ʴ������ӹ���ͧ��� (�ԡ�����)" <? if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F") echo "selected='selected'"; ?>>�������ʴ������ӹ���ͧ��� (�ԡ�����)</Option>
		</SELECT></td>
<?
		}
?>
<td>
<SELECT NAME="reason2<?=$countddy?>">
				<Option value="">��س����͡��ͺ觪��</Option>
                <Option value="1" <? if($_SESSION["list_drug_reason2"][$i]=="1") echo "selected='selected'"; ?>>������㹺ѭ������ѡ�ҡ�͹</Option>
               <Option value="2" <? if($_SESSION["list_drug_reason2"][$i]=="2") echo "selected='selected'"; ?>>�������㹺ѭ������ѡ��觪ҵ�</Option>
		</SELECT>
</td>
        </tr>
<?
	}
}
?>
<tr><td colspan="3" align="center"><input type="submit" value="          ��ŧ          "></td></tr>
</table>
</FORM>
<?
if($countddy==0){
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dt_drug_add_pt.php\">";
	
}else{ if(substr($_SESSION["ptright_now"],0,3)!="R03"){
	
	?>
<script>
alert('�������ա�����ҹ͡�ѭ������ѡ��觪ҵ� \n ��س�ŧ�����ͪ���� ��Ѻ�ͧ�ҹ͡�ѭ������ѡ��觪ҵ� ');
</script>
	<?
}

}

	?>
	</body>