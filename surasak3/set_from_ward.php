
<script type="text/javascript">
if ((typeof Range !== "undefined")
&& !Range.prototype.createContextualFragment)
{
    Range.prototype.createContextualFragment = function(html)
    {
        var frag = document.createDocumentFragment(),
        div = document.createElement("div");
        frag.appendChild(div);
        div.outerHTML = html;
        return frag;
    };
}
</script>
<html>
<head>
<title>� SET ��ҵѴ</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>


<link rel="stylesheet" type="text/css" href="epoch_styles.css" />

<style>
.f1{
	font-family:"Angsana New";
	font-size:16pt;	
}
</style>
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_surg'));

};



function fncSubmit()
{

	if(document.frmMain.ward.value == "")
	{
		alert('��س����͡ �ͼ�����');
		document.frmMain.ward.focus();		
		return false;
	}	
		if(document.frmMain.hn.value == "")
	{
		alert('��س��к� HN');
		document.frmMain.hn.focus();		
		return false;
	}	
			if(document.frmMain.ptname.value == "")
	{
		alert('��س��к� ����-ʡ�� ');
		document.frmMain.ptname.focus();		
		return false;
	}	
		if(document.frmMain.diag.value == "")
	{
		alert('��س��кء���ԹԨ��� (diag)');
		document.frmMain.diag.focus();		
		return false;
	}	
	if(document.frmMain.surg.value == "")
	{
		alert('��س��кء�ü�ҵѴ');
		document.frmMain.surg.focus();		
		return false;
	}	
		if(document.frmMain.inhalation_type.value == "")
	{
		alert('��س��кت�Դ����');
		document.frmMain.inhalation_type.focus();		
		return false;
	}
	if(document.frmMain.doctor.value == "")
	{
		alert('��س��к�ᾷ��');
		document.frmMain.doctor.focus();		
		return false;
	}	
	
	document.frmMain.submit();
}

</script>

<?
include("connect.inc");
$date_now = (date("Y")).date("-m-d");


	$sql = "SELECT * FROM ipcard  WHERE an = '".$_GET['an']."' ";
	
	$result = mysql_query($sql)or die(mysql_error());
	
	$arr=mysql_fetch_array($result);
?>
<body>


<h1 class="f1" align="center">�ç��Һ�Ť�������ѡ��������</h1>
<h1 class="f1" align="center">� SET ��ҵѴ --/--- FR-NUR-002/1 ,03 ,1 �.�.48</h1>
<form name="frmMain" method="post" onSubmit="JavaScript:return fncSubmit();" action="set_from_or_print.php" target="_blank">
  <table border="1" align="center" cellpadding="0" cellspacing="0" class="f1" style="border-collapse:collapse; border-color:#000;">
  <tr>
    <td bgcolor="#FF66CC"><div align="center">�ͼ�����</div></td>
    <td><select name="ward" id="ward">
      <option value="">----��س����͡----</option>
      <option value="OPD">OPD</option>
      <option value="ER">ER</option>
      <option value="�ͼ��������" <? if($_GET['bedcode']=='42'){ echo "selected"; }?>>�ͼ��������</option>
      <option value="�ͼ������ٵ�" <? if($_GET['bedcode']=='43'){ echo "selected"; }?>>�ͼ������ٵ�</option>
      <option value="�ͼ����¾����" <? if($_GET['bedcode']=='45'){ echo "selected"; }?>>�ͼ����¾����</option>
      <option value="�ͼ�����˹ѡ" <? if($_GET['bedcode']=='44'){ echo "selected"; }?>>�ͼ�����˹ѡ</option>
      <option value="����к�">����к�</option>
    </select></td>
    <td bgcolor="#FF66CC"><div align="center">�ѹ/��͹/��</div></td>
    <td><input type="text" name="date_surg" id="date_surg" value="<?=$date_now;?>" size="10">
    ���� <SELECT NAME="time1">
    <option value="-" selected>-</option>
          <?php 
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						//if($nonconf_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
        </SELECT>
        :
        <SELECT NAME="time2">
        <option value="-" selected>-</option>
          <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
					//	if($nonconf_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
        </SELECT> </td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">HN</td>
    <td><input name="hn" type="text" id="hn" size="15" value="<?=$arr['hn'];?>"></td>
    <td bgcolor="#FF66CC">AN</td>
    <td><input name="an" type="text" id="an" size="15"  value="<?=$arr['an'];?>"></td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">����-ʡ��</td>
    <td><input type="text" name="ptname" id="ptname"  value="<?=$arr['ptname'];?>"></td>
    <td bgcolor="#FF66CC">����</td>
    <td><input type="text" name="age" id="age"  value="<?=$arr['age'];?>" ></td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">�Է�� </td>
    <td><input type="text" name="ptright" id="ptright"  value="<?=$arr['ptright'];?>"></td>
    <td bgcolor="#FF66CC">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">����ԹԨ���</td>
    <td><input type="text" name="diag" id="diag"></td>
    <td bgcolor="#FF66CC">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">��ü�ҵѴ</td>
    <td><input type="text" name="surg" id="surg"></td>
    <td bgcolor="#FF66CC">��Դ����</td>
    <td><input type="text" name="inhalation_type" id="inhalation_type"></td>
    </tr>
  <tr>
    <td bgcolor="#FF66CC">ᾷ��</td>
    <td><select name="doctor" id="doctor">
      <?php 
		echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
		echo "<option value='��ͧ��Ǩ�ä�����' >��ͧ��Ǩ�ä�����</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
    </select></td>
    <td bgcolor="#FF66CC">�����˵�</td>
    <td><label for="comment"></label>
      <textarea name="comment" id="comment" cols="45" rows="5"></textarea></td>
    </tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" name="button" id="button" value="     ��ŧ    ">  
    <a href="../nindex.htm">&lt;&lt;-����;</a> <a href="set_from_print.php" target="_blank">��§ҹ� SET ��ҵѴ </a></td>
    </tr>
</table>
<br>
<div id="list2" style="position: absolute; left: 447px; top: 181px;"></div>
<br>

</form>


<?
include("set_from_list_ward.php");
?>


</body>
</html>
