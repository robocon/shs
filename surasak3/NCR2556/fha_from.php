<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>�к���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>

<?php include 'menu.php'; ?>

<div><!-- InstanceBeginEditable name="detail" -->
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('fha_date'));

};
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
			url = 'fha_getfill.php?action=an&search=' + str+'&getto1=' + getto1+'&getto2=' + getto2+'&getto3=' + getto3;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list3").innerHTML = xmlhttp.responseText;
		}
}
	function searchSuggest2(str,len,getto1,getto2) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'fha_getfill.php?action=hn&search2=' + str+'&getto1=' + getto1+'&getto2=' + getto2;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list3").innerHTML = xmlhttp.responseText;
		}
}
</script>

<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:24px;
	font-weight:bold;
}
.font2{
	font-family:Tahoma, Geneva, sans-serif;
	font-size:14px;
}
.font22{
	font-family:"TH SarabunPSK";
	font-size:16pt;
	color:#00F;
}

/*a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14px;
	color: #FFFFFF;
	font-weight: bold;
}*/
</style>
<script language=Javascript>
function fncSubmit()
{
	var fn = document.f1;
	
	if(fn.ptname.value=="")
	{
		alert('��س��к� ����-���ʡ�ż�����');
		fn.ptname.focus();
		return false;
	}
	if(fn.hn.value=="")
	{
		alert('��س��к� HN ������');
		fn.hn.focus();
		return false;
	}		

	if(fn.area.value=="")
	{
		alert('��س��к� ʶҹ����Դ�˵�');
		fn.area.focus();		
		return false;
	}	
	if(fn.fha_date.value=="")
	{
		alert('��س��к� �ѹ��͹�շ���Դ������Ҵ����͹�ҧ�Ң�� ');
		fn.fha_date.focus();		
		return false;
	}	
	if(fn.fha_time1.selectedIndex==0 && fn.fha_time2.selectedIndex==0){
		alert('��س����͡���ҷ���Դ������Ҵ����͹�ҧ�Ң��');
		fn.fha_time1.focus();
		return false;
	}
	if(fn.order_name.value==""){
		alert('��س��к� ��������');
		fn.order_name.focus();		
		return false;
	}
	if(fn.pay_name.value==""){
		alert('��س��к� ��������');
		fn.pay_name.focus();		
		return false;
	}
	if(fn.give_name.value==""){
		alert('��س��к� ��������');
		fn.give_name.focus();		
		return false;
	}
	if(fn.report_name.value==""){
		alert('��س��к� �����§ҹ');
		fn.report_name.focus();		
		return false;
	}
	if(fn.depart.value==""){
		alert('��س��к� �ͧ/Ἱ�');
		fn.depart.focus();		
		return false;
	}
	
	fn.submit();
}

</script>

<link rel="stylesheet" type="text/css" href="epoch_styles.css"/>

<h1 class="font1" align="center">Ẻ��§ҹ������Ҵ����͹�ҧ�Ңͧ�ç��Һ�Ť�������ѡ�������� �ӻҧ</h1>
<!--<a href="../sm3/nindex.htm"><-----�����</a>-->
<script language="javascript">
/*function fncSubmit1(strPage)
{
	if(strPage == "page1")
	{
		document.f1.action="<?//=$_SERVER['PHP_SELF'];?>?do=select";
	}

	document.f1.submit();
}*/
</script>
<?




 $thidate=(date("Y")+543).'-'.date("m").'-'.date("d"); 

 if($_GET["edit"]=="true"){
include("connect.inc");		
		$sql = "Select * From drug_fail_2 where row_id = '".$_GET["row_id"]."' limit  1 ";
		$result = mysql_query($sql) or die(mysql_error());
		$arr_edit = mysql_fetch_assoc($result);
		
		//echo $sql;
		
		$hn=$arr_edit['hn'];
		$ptname=$arr_edit['ptname'];
		$file = "fha_edit.php";
		
		
		$hd = "<input name=\"row_id\" type=\"hidden\" value=\"".$arr_edit["row_id"]."\" />";
	}else{
		$file = "fha_add2.php";
	}
 
 
?>


<form name="f1" action="<?php echo $file;?>" method="post" onSubmit="return fncSubmit();">
<table align="center" border="1">
<tr>
<td>
 
<table border="0" align="center" cellpadding="2" cellspacing="0" class="font2">
  <tr>
    <td><input type="radio" name="type_opd" id="radio10" value="opd" <?php if($arr_edit["type_opd"]=="opd") echo " Checked "; ?> onClick="javaScript:if(this.checked){document.all.spHN.style.display='';document.all.spPANME.style.display='';document.all.spAN.style.display='none';document.all.hn.focus();document.all.an.value=''}"/>
      �����¹͡
      <input type="radio" name="type_opd" id="radio11" value="ipd" <?php if($arr_edit["type_opd"]=="ipd") echo " Checked "; ?> onClick="javaScript:if(this.checked){document.all.spHN.style.display='';document.all.spAN.style.display='';document.all.spPANME.style.display='';document.all.an.focus();}"/>  �������</td>
    <td colspan="6">&nbsp;&nbsp;&nbsp;
    <span id="spHN" style="display:none;">
    HN <input type="text" name="hn"  class="font22" value="<?=$hn;?>"  id="hn" onKeyPress="searchSuggest2(this.value,3,'hn','ptname');"/>
      </span>
    <span id="spAN" style="display:none;">
      AN  <input type="text" name="an"  class="font22" value="<?=$arr_edit['an'];?>" id="an" onKeyPress="searchSuggest(this.value,3,'an','ptname','hn');"/>
     </span>
     <span id="spPANME" style="display:none;">
      ����-���ʡ�ż�����
      <input type="text" name="ptname"  class="font22" value="<?=$ptname;?>" id="ptname" />
      </span>
      
      
      </td>
    </tr>
  <tr>
    <td>ʶҹ����Դ�˵�<div id="list3" style="position: absolute;"></div></td>
    <td>
    <select name="area"  id="area" class="font2">
            <option value="">--------------</option>
             <?php
									include("connect.inc");
										$sql="SELECT * FROM `departments` where status='y' ";
										$query=mysql_query($sql);
										
										while($arr=mysql_fetch_array($query)){
											
											if($arr_edit["area"]==$arr['code']){
											echo "<option value='$arr[code]' selected>$arr[name]</option> ";
											}else{
											echo "<option value='$arr[code]'>$arr[name]</option> ";	
											}
										}
									?>
          </select>
    </td>
    <td>�ѹ��͹��</td>
    <td><input name="fha_date" type="text" id="fha_date" size="10" maxlength="10" class="font2" value="<? if($arr_edit['fha_date']=="0000-00-00"){ echo $thidate; }else{ echo $arr_edit['fha_date']; }?>"/></td>
    <td>����</td>
    <td><select name="fha_time1">
		  		<option value="0">--</option>
                <?php 
				list($fha_time1,$fha_time2,$fha_time3) = explode(":",$arr_edit["fha_time"]);
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($fha_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
              </select>
          :
          <select name="fha_time2">
		  	<option value="0">--</option>
            <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($fha_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
          </select>�.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>��������</td>
    <td><input type="text" name="order_name"  class="font2" value="<?=$arr_edit['order_name'];?>"/></td>
    <td>��������</td>
    <td><input type="text" name="pay_name"  class="font2" value="<?=$arr_edit['pay_name'];?>"/></td>
    <td>��������</td>
    <td><input type="text" name="give_name"  class="font2" id="give_name" value="<?=$arr_edit['give_name'];?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>�����§ҹ</td>
    <td> <input type="text" name="report_name"  class="font2" id="report_name" value="<?=$arr_edit['report_name'];?>"/></td>
    <td>�ͧ/Ἱ�</td>
    <td><select name="depart"  id="depart" class="font2">
            <option value="">--------------</option>
             <?php
										include("connect.inc");
										$sql="SELECT * FROM `departments` where status='y' ";
										$query=mysql_query($sql);
										
										while($arr=mysql_fetch_array($query)){
											
											if($arr_edit["depart"]==$arr['code']){
											echo "<option value='$arr[code]' selected>$arr[name]</option> ";
											}else{
											echo "<option value='$arr[code]'>$arr[name]</option> ";	
											}
										}
									?>
          </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>�����</td>
    <td>
      <style type="text/css">
      label{cursor: pointer;}
      </style>
      <label for="come1">
        <input type="radio" id="come1" name="come_from_id" value="1" <?php if($arr_edit["come_from_id"] == "1") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;ENV ROUND<BR>
      </label>
      <label for="come2">
        <input type="radio" id="come2" name="come_from_id" value="2" <?php if($arr_edit["come_from_id"] == "2") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;IC ROUND<BR>
      </label>
      <label for="come3">
        <input type="radio" id="come3" name="come_from_id" value="3" <?php if($arr_edit["come_from_id"] == "3") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;RM ROUND<BR>
      </label>
      <label for="come4">
        <input type="radio" id="come4" name="come_from_id" value="4" <?php if($arr_edit["come_from_id"] == "4") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;12 �Ԩ�������ǹ<BR>
      </label>
    </td>
    <td>
      <label for="come5">
        <input type="radio" id="come5" name="come_from_id" value="5" <?php if($arr_edit["come_from_id"] == "5") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;˹�����§ҹ�ͧ<BR>
      </label>
      <label for="come6">
        <input type="radio" id="come6" name="come_from_id" value="7" <?php if($arr_edit["come_from_id"] == "7") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;��õ�Ǩ��þ�Һ��<BR>
      </label>
      <label for="come7">
        <input type="radio" id="come7" name="come_from_id" value="8" <?php if($arr_edit["come_from_id"] == "8") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;��·�����û�Ш��ѹ<BR>
      </label>
      <label for="come8">
        <input type="radio" id="come8" name="come_from_id" value="6" <?php if($arr_edit["come_from_id"] == "6") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='';}">&nbsp;����&nbsp;&nbsp;<br>
      </label>
      <select name="come_from_detail" style="display:none;">
        <option value="">--------------</option>
        <?php
        $sql2="SELECT * FROM `departments` where status='y' ";
        $query2=mysql_query($sql2);
        while($arr2=mysql_fetch_array($query2)){
          echo "<option value='$arr2[code]'>$arr2[name]</option> ";
        }
        ?>
      </select>
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
        <td><input name="p1" type="checkbox" id="p1" value="1" <?php if($arr_edit["p1"]=="1") echo " Checked "; ?>/>
          �����������բ�ͺ���</td>
        </tr>
      <tr>
        <td><input name="p2" type="checkbox" id="p2" value="1" <?php if($arr_edit["p2"]=="1") echo " Checked "; ?>/>
�����������բ��������</td>
      </tr>
      <tr>
        <td><input name="p3" type="checkbox" id="p3" value="1" <?php if($arr_edit["p3"]=="1") echo " Checked "; ?>/>
����ҷ��������ջ���ѵ���</td>
      </tr>
      <tr>
        <td><input name="p4" type="checkbox" id="p4" value="1" <?php if($arr_edit["p4"]=="1") echo " Checked "; ?>/>
����ҷ���Դ��ԡ����ҵ�͡ѹ</td>
      </tr>
      <tr>
        <td><input name="p5" type="checkbox" id="p5" value="1" <?php if($arr_edit["p5"]=="1") echo " Checked "; ?>/>
�����㹢�Ҵ�٧�Թ�</td>
      </tr>
      <tr>
        <td><input name="p6" type="checkbox" id="p6" value="1"  <?php if($arr_edit["p6"]=="1") echo " Checked "; ?>/>
          �����㹢�Ҵ����Թ�</td>
      </tr>
      <tr>
        <td><input name="p7" type="checkbox" id="p7" value="1"  <?php if($arr_edit["p7"]=="1") echo " Checked "; ?>/> 
          ����
</td>
      </tr>
      <tr>
        <td><input name="p_detail" type="text" class="font2" id="p_detail" value="<?=$arr_edit['p_detail'];?>"/></td>
      </tr>
    </table>
      </td>
    <td><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="p8" type="checkbox" id="p8" value="1" <?php if($arr_edit["p8"]=="1") echo " Checked "; ?>/>
          ����кؤ����ç/�Ը���/�ӹǹ</td>
      </tr>
      <tr>
        <td><input name="p9" type="checkbox" id="checkbox9" value="1" <?php if($arr_edit["p9"]=="1") echo " Checked "; ?>/>
        �Դ������/��Դ��</td>
      </tr>
      <tr>
        <td><input name="p10" type="checkbox" id="checkbox10" value="1" <?php if($arr_edit["p10"]=="1") echo " Checked "; ?>/>
          �Դ�����ç</td>
      </tr>
      <tr>
        <td><input name="p11" type="checkbox" id="checkbox11" value="1" <?php if($arr_edit["p11"]=="1") echo " Checked "; ?>/>
          �Դ�ٻẺ��</td>
      </tr>
      <tr>
        <td><input name="p12" type="checkbox" id="checkbox12" value="1" <?php if($arr_edit["p12"]=="1") echo " Checked "; ?>/>
          �Դ�Ը���</td>
      </tr>
      <tr>
        <td><input name="p13" type="checkbox" id="checkbox13" value="1" <?php if($arr_edit["p13"]=="1") echo " Checked "; ?>/>
          �Դ����ҳ/�ӹǹ��</td>
      </tr>
      <tr>
        <td><input name="p14" type="checkbox" id="checkbox14" value="1" <?php if($arr_edit["p14"]=="1") echo " Checked "; ?>/>
        ����ҫ�ӫ�͹</td>
      </tr>
      <tr>
        <td><input name="p15" type="checkbox" id="checkbox29" value="1" <?php if($arr_edit["p15"]=="1") echo " Checked "; ?>/> 
          ��觨��������ç�Ѻ������
</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="d1" type="checkbox" id="checkbox15" value="1" <?php if($arr_edit["d1"]=="1") echo " Checked "; ?>/>
          ���������ç�Ѻ������ </td>
      </tr>
      <tr>
        <td><input name="d2" type="checkbox" id="checkbox16" value="1" <?php if($arr_edit["d2"]=="1") echo " Checked "; ?>/>
        �����ҼԴ��Դ/������</td>
      </tr>
      <tr>
        <td><input name="d3" type="checkbox" id="checkbox17" value="1" <?php if($arr_edit["d3"]=="1") echo " Checked "; ?>/>
          �Դ��Ҵ</td>
      </tr>
      <tr>
        <td><input name="d4" type="checkbox" id="checkbox18" value="1" <?php if($arr_edit["d4"]=="1") echo " Checked "; ?>/>
          �Դ�����ç</td>
      </tr>
      <tr>
        <td><input name="d5" type="checkbox" id="checkbox19" value="1" <?php if($arr_edit["d5"]=="1") echo " Checked "; ?>/>
          �Դ�ӹǹ/����ҳ</td>
      </tr>
      <tr>
        <td><input name="d6" type="checkbox" id="checkbox20" value="1" <?php if($arr_edit["d6"]=="1") echo " Checked "; ?>/>
          �Դ�ٻẺ</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="d7" type="checkbox" id="checkbox22" value="1" <?php if($arr_edit["d7"]=="1") echo " Checked "; ?>/>
          �������������/��������Ҿ����Ҿ������������</td>
      </tr>
      <tr>
        <td><input name="d8" type="checkbox" id="checkbox23" value="1" <?php if($arr_edit["d8"]=="1") echo " Checked "; ?>/>
          �ҢҴ Stock �������ö�Ѵ���������觢�й��</td>
      </tr>
      <tr>
        <td><input name="d9" type="checkbox" id="checkbox28" value="1" <?php if($arr_edit["d9"]=="1") echo " Checked "; ?>/>
          ���� </td>
      </tr>
      <tr>
        <td><input name="d_detail" type="text" class="font2" id="d_detail"  value="<?=$arr_edit['d_detail']?>"/></td>
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
        <td><input name="t1" type="checkbox" id="checkbox21" value="1" <?php if($arr_edit["t1"]=="1") echo " Checked "; ?>/>
          �Դ������/��Դ��</td>
      </tr>
      <tr>
        <td><input name="t2" type="checkbox" id="checkbox24" value="1" <?php if($arr_edit["t2"]=="1") echo " Checked "; ?>/>
        �Դ�����ç</td>
      </tr>
      <tr>
        <td><input name="t3" type="checkbox" id="checkbox25" value="1" <?php if($arr_edit["t3"]=="1") echo " Checked "; ?>/>
          �Դ�ٻẺ��</td>
      </tr>
      <tr>
        <td><input name="t4" type="checkbox" id="checkbox26" value="1" <?php if($arr_edit["t4"]=="1") echo " Checked "; ?>/>
          �Դ�Ը���</td>
      </tr>
      <tr>
        <td><input name="t5" type="checkbox" id="checkbox27" value="1" <?php if($arr_edit["t5"]=="1") echo " Checked "; ?>/>
          �Դ����ҳ/�ӹǹ�ҫ�ӫ�͹</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="t6" type="checkbox" id="checkbox32" value="1" <?php if($arr_edit["t6"]=="1") echo " Checked "; ?>/>
          �����ç�Ѻ���ͼ����</td>
      </tr>
      <tr>
        <td><input name="t7" type="checkbox" id="checkbox33" value="1" <?php if($arr_edit["t7"]=="1") echo " Checked "; ?>/>
          �ҷ��ᾷ����������</td>
      </tr>
      <tr>
        <td><input name="t8" type="checkbox" id="checkbox34" value="1" <?php if($arr_edit["t8"]=="1") echo " Checked "; ?>/>
          ����</td>
      </tr>
      <tr>
        <td><input name="t_detail" type="text" class="font2" id="t_detail"  value="<?=$arr_edit['t_detail'];?>"/></td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="a1" type="checkbox" id="checkbox39" value="1" <?php if($arr_edit["a1"]=="1") echo " Checked "; ?>/>
          ������������ҷ���˹�/��������</td>
      </tr>
      <tr>
        <td><input name="a2" type="checkbox" id="checkbox40" value="1" <?php if($arr_edit["a2"]=="1") echo " Checked "; ?>/>
          �Դ��Ҵ/�����ç</td>
      </tr>
      <tr>
        <td><input name="a3" type="checkbox" id="checkbox41" value="1" <?php if($arr_edit["a3"]=="1") echo " Checked "; ?>/>
          �Դ������/��Դ��</td>
      </tr>
      <tr>
        <td><p>
          <input name="a4" type="checkbox" id="checkbox42" value="1" <?php if($arr_edit["a4"]=="1") echo " Checked "; ?>/>
          �Դ�ѵ�ҡ�������/��������</p></td>
      </tr>
      <tr>
        <td><input name="a5" type="checkbox" id="checkbox43" value="1" <?php if($arr_edit["a5"]=="1") echo " Checked "; ?>/>
          �Դ���˹�/�Զշҧ/�ٻẺ</td>
      </tr>
      <tr>
        <td><input name="a6" type="checkbox" id="checkbox44" value="1" <?php if($arr_edit["a6"]=="1") echo " Checked "; ?>/>
          �Դ��</td>
      </tr>
      <tr>
        <td><input name="a7" type="checkbox" id="checkbox45" value="1" <?php if($arr_edit["a7"]=="1") echo " Checked "; ?>/>
          ���� </td>
      </tr>
      <tr>
        <td><input name="a_detail" type="text" class="font2" id="textfield4"  value="<?=$arr_edit['a_detail'];?>"/></td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="a8" type="checkbox" id="checkbox46" value="1" <?php if($arr_edit["a8"]=="1") echo " Checked "; ?>/>
          ��������ú��¡��(�Ҵ/�Թ)</td>
      </tr>
      <tr>
        <td><input name="a9" type="checkbox" id="checkbox47" value="1" <?php if($arr_edit["a9"]=="1") echo " Checked "; ?>/>
          ������ҡ����/���¡��Ҩӹǹ���駷�����</td>
      </tr>
      <tr>
        <td><input name="a10" type="checkbox" id="checkbox48" value="1" <?php if($arr_edit["a10"]=="1") echo " Checked "; ?>/>
          �����/����ҼԴ</td>
      </tr>
      <tr>
        <td><p>
          <input name="a11" type="checkbox" id="checkbox49" value="1" <?php if($arr_edit["a11"]=="1") echo " Checked "; ?>/>
          ���ѡ���ҼԴ(�Ҥ�ҧ stock/<br />
          �����ѹ�����ö�ء�Թ <br />
          �������������� �蹹͡������ ����ͧ�ѹ�ʧ)</p></td>
      </tr>
      <tr>
        <td><input name="a12" type="checkbox" id="checkbox50" value="1" <?php if($arr_edit["a12"]=="1") echo " Checked "; ?>/>
          ������������/��������Ҿ</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top">Compliance Error (������Ңͧ������)</td>
    </tr>
  <tr>
    <td colspan="4" valign="top"><input name="c1" type="checkbox" id="c1" value="1" <?php if($arr_edit["c1"]=="1") echo " Checked "; ?>/>
      ������������Ѻ��зҹ�ҵ��ᾷ�����
      <input name="c2" type="checkbox" id="checkbox31" value="1" <?php if($arr_edit["c2"]=="1") echo " Checked "; ?>/>
      ���� 
      <input name="c_detail" type="text" class="font2" id="c_detail"  value="<?=$arr_edit['c_detail'];?>"/></td>
    </tr>
</table>
<br />
<table border="0" align="center" cellpadding="0" cellspacing="0" class="font2">
  <tr>
    <td colspan="3"><u>�дѺ�����ع�ç</u></td>
    </tr>
  <tr>
    <td width="27"><input type="radio" name="level_vio" id="radio" value="A" <?php if($arr_edit["level_vio"]=="A") echo " Checked "; ?>/></td>
    <td width="17">A</td>
    <td width="718">�˵ء�ó������͡�ʷ��С������Դ������Ҵ����͹</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio2" value="B"  <?php if($arr_edit["level_vio"]=="B") echo " Checked "; ?>/></td>
    <td>B</td>
    <td>�Դ������Ҵ����͹��������֧������</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio3" value="C"  <?php if($arr_edit["level_vio"]=="C") echo " Checked "; ?>/></td>
    <td>C</td>
    <td>�Դ������Ҵ����͹�Ѻ������ �����������������Ѻ�ѹ����</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio4" value="D" <?php if($arr_edit["level_vio"]=="D") echo " Checked "; ?>/></td>
    <td>D</td>
    <td>�Դ������Ҵ����͹�Ѻ����� ��ͧ���������ѧ������������������Դ�ѹ�����������������͵�ͧ�պӺѴ�ѡ��</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio5" value="E" <?php if($arr_edit["level_vio"]=="E") echo " Checked "; ?>/></td>
    <td>E</td>
    <td>�Դ������Ҵ����͹�Ѻ������ �觼�����Դ�ѹ���ª��Ǥ��� ��е�ͧ�ա�úӺѴ�ѡ��</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio6" value="F" <?php if($arr_edit["level_vio"]=="F") echo " Checked "; ?>/></td>
    <td>F</td>
    <td>�Դ������Ҵ����͹�Ѻ������ �觼�����Դ�ѹ���ª��Ǥ��� ��е�ͧ�͹��ç��Һ�����������ç��Һ�Źҹ���</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio7" value="G" <?php if($arr_edit["level_vio"]=="G") echo " Checked "; ?>/></td>
    <td>G</td>
    <td>�Դ������Ҵ����͹�Ѻ������ �觼�����Դ�ѹ���¶����������</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio8" value="H" <?php if($arr_edit["level_vio"]=="H") echo " Checked "; ?>/></td>
    <td>H</td>
    <td>�Դ������Ҵ����͹�Ѻ������ �觼ŷ�����ͧ�ӡ�ê��ª��Ե</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio9" value="I" <?php if($arr_edit["level_vio"]=="I") echo " Checked "; ?>/></td>
    <td>I</td>
    <td>�Դ������Ҵ����͹�Ѻ������ ����Ҩ�������˵آͧ������ª��Ե</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3">��������´���� �ͧ�˵ء�ó� </td>
  </tr>
  <tr>
    <td colspan="3"><textarea name="action_detail" cols="100" rows="10" class="font2" id="action_detail"><?=$arr_edit['action_detail'];?></textarea></td>
  </tr>
  <tr>
    <td colspan="3" align="center">
    <hr />
    <input type="hidden" name="row_id" id="row_id" value="<?=$arr_edit['row_id'];?>" />
    <input type="submit" name="submit" id="submit" value="�ѹ�֡������" class="font1"/></td>
  </tr>
</table>

</td>
</tr>

</table>

</form>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>