<?php
session_start();

include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

if($_POST['button2']){ 

	$register=date("Y-m-d H:i:s");
	$thidate=explode('/',$_POST['date1']);
	$thidate2=$thidate[2].'-'.$thidate[1].'-'.$thidate[0];

	$develop_age_id = $_POST['develop_age'];
	$q = mysql_query("SELECT * FROM `f43_nutrition_201` WHERE `code` = '$develop_age_id' ");
	$nu = mysql_fetch_assoc($q);
	$develop_age = $nu['detail'];
	
	$sql="INSERT INTO `well_baby` ( thidate,`hn` , `age` , `weight` , `develop_age` , `growth` , `breastmilk` , `register` )
	VALUES ('".$thidate2."','".$_POST['phn']."', '".$_POST['age']."', '".$_POST['weight']."', '".$develop_age."', '".$_POST['growth']."', '".$_POST['breastmilk']."','".$register."');";
	$query=mysql_query($sql)or die (mysql_error());

	if($query){
		echo"<h1 align=center>�ѹ�֡���������º�������� </h1>";
	}else {
		echo "<h1 align=center>�������ö������������</h1>";
	}

	echo "<meta http-equiv='refresh' content='2; url=clinic_well_baby.php'>" ;
	exit;
}

?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>��ش����¹����Ѻ��ԡ���Ѥ�չ��</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend{
	
font-family:"TH SarabunPSK";
font-size: 18pt;
font-weight: bold;
color:#600;	
padding:0px 3px;

}
fieldset{

display:inline;
background-color:#FEFDDE;
/*width:300px;*/
border-color:#000;


}
</style>

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
label{
	cursor: pointer;
}
table tr{
	vertical-align: top;
}
.table43 td{
	padding-bottom: 10px;
}
.table43 .table_font1{
	/* text-align: right; */
}

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<body>


<div id="no_print">
<?php include 'main_menu.php'; ?>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'));

};

</script>

<form action="" method="post" name="form1" id="form1" onSubmit="JavaScript:return ch_null();">
  <table width="200" border="1" align="center" bordercolor="#0099FF">
    <tr>
      <td><table width="285" border="0" align="center" >
        <tr>
          <td colspan="3" class="forntsarabun"><h2 align="center">��Թԡ Well Baby</h2></td>
          </tr>
        <tr>
          <td width="96" align="right" class="forntsarabun"><span class="table_font1">�к� HN</span> :</td>
          <td width="173" colspan="2" align="left"><label>
            <input name="hn" type="text" class="table_font2" id="hn" />
            </label></td>
          </tr>
        <tr>
          <td colspan="3" align="center"><label>
            <input name="button" type="submit" class="table_font1" id="button" value="��ŧ" />
            </label></td>
          </tr>
        </table></td>
      </tr>
    </table>

</form>

<? 
if($_POST['button']!=''){
	


	$sql1 = "select *  from opcard Where  hn = '".$_POST['hn']."' ";
	$result1 = mysql_query($sql1);
	$numrows=mysql_num_rows($result1);
	$fetch= mysql_fetch_array($result1);
	
	$dbirth=$fetch['dbirth'];
	$age = calcage($dbirth);
	
	$age2= calcage2($dbirth);
	
	$calage=explode('/',$age2);
	
	
?>
<div align="center">
<script>

function fncSubmit()
{
	if(document.form2.weight.value=="")
	{
		alert('��س��кع��˹ѡ���¤�Ѻ');
		document.form2.weight.focus();
		return false;
	}
	if(document.form2.develop_age.value==""){
		alert("��س��кآ����� �Ѳ�ҡ������� ��ҹ��ҧ������������") ;
		document.form2.develop_age.focus() ;
		return false ;
	}		

	if(document.form2.growth_0.checked == false && document.form2.growth_1.checked == false && document.form2.growth_2.checked == false)
	{
		alert('��س����͡ �����ԭ�Ժ⵵����õðҹ������й��˹ѡ');
		
		return false;
	}	
	
if(document.form2.age1.value<=0 && document.form2.age2.value<=6){	
	if(document.form2.breastmilk_0.checked == false && document.form2.breastmilk_1.checked == false && document.form2.breastmilk_2.checked == false)
	{
		alert('��س����͡ �������� 2-6 ��͹');
		
		return false;
	}	
	
}
	
	document.form2.submit();
}

</script>

<fieldset><legend style="margin:0px 20px">�����ż�����</legend>
  <form name="form2" method="post" action="" onSubmit="JavaScript:return fncSubmit();">
    <table width="100%" border="0" align="center" >
		<tr>
			<td colspan="2">
				<span class="table_font1">HN :</span><span class="table_font2"><?=$fetch['hn'];?></span> <input name="phn" type="hidden" value="<?=$fetch['hn'];?>"><span class="table_font1">����-ʡ�� :</span><span class="table_font2"><?=$fetch['yot'].$fetch['name'].' '.$fetch['surname'];?></span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<span class="table_font1">�Է�ԡ���ѡ�� :</span><span class="table_font2"><?=$fetch['ptright'];?></span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<span class="table_font1">���� : </span><span class="table_font2"><?=$age;?></span>
				<input name="age" type="hidden" value="<?=$age;?>">
				<input name="age1" id="age1" type="hidden" value="<?=$calage[0];?>">
				<input name="age2" id="age2" type="hidden" value="<?=$calage[1];?>">
			</td>
		</tr>
		<tr>
			<td class="table_font1">�ѹ����Ѻ��ԡ�� : </td>
			<td class="table_font2">
				<input name="date1" type="text" class="table_font2" id="date1" value="<?=date("d/m/Y");?>"><span>*���͡�ѹ���ҡ��ԷԹ</span>
			</td>
		</tr>
		<tr>
			<td class="table_font1">���˹ѡ : </td>
			<td class="table_font2"><input name="weight" type="text" class="table_font2" id="weight" size="10">�.�.</td>
		</tr>
		<!--
		<tr>
			<td class="table_font1" colspan="2">�Ѳ�ҡ������� ��ҹ��ҧ������������</td>
		</tr>
		<tr>
			<td class="table_font1" colspan="2"><input name="develop_age" type="text" class="table_font2" id="develop_age" size="70"></td>
		</tr>
-->
		<tr>
			<td class="table_font1" colspan="2">�����ԭ�Ժ⵵����õðҹ������й��˹ѡ</td>
		</tr>
		<tr>
		<td colspan="2">
			<label class="table_font2"><input type="radio" name="growth" value="N" id="growth_0">���ࡳ��</label>
			<label class="table_font2"><input type="radio" name="growth" value="L" id="growth_1">��ӡ���ࡳ��</label>
			<label class="table_font2"><input type="radio" name="growth" value="M" id="growth_2">�Թ����ࡳ��</label>
		</td>
		</tr>

		<?php if($calage[0]<=0 && $calage[1]<=6 ){ ?>
		<tr>
			<td class="table_font1" colspan="2">�������� 2-6 ��͹</td>
		</tr>
		<tr>
			<td colspan="2">
			<label class="table_font2">
			<input type="radio" name="breastmilk" value="�����" id="breastmilk_0">
			�����</label>
			<label class="table_font2">
			<input type="radio" name="breastmilk" value="�����+�����" id="breastmilk_1">
			�����+�����</label>
			<label class="table_font2">
			<input type="radio" name="breastmilk" value="�����" id="breastmilk_2">
			�����</label>
			</td>
		</tr>
		<?php } ?>
    <tr>
		<td style="text-align: center; background-color: #b3b3b3;" class="table_font1" colspan="2">������ 43���</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table43">
				<tr>
					<td class="table_font1">��ǹ�٧ : </td>
					<td class="table_font2"><input type="text" name="HEIGHT" id="">��.</td>
				</tr>
				<tr>
					<td class="table_font1">����ͺ����� : </td>
					<td class="table_font2"><input type="text" name="HEADCIRCUM" id="">��.</td>
				</tr>
				<tr>
					<td class="table_font1">�дѺ�Ѳ�ҡ���� : </td>
					<td class="table_font2">
					<?php 
					$q = mysql_query("SELECT * FROM `f43_nutrition_201`");
					$i = 1;
					while( $item = mysql_fetch_assoc($q) ){ 
						?>
						<!-- develop_age is CHILDDEVELOP-->
						<input type="radio" name="develop_age" id="cdev<?=$i;?>" value="<?=$item['code'];?>">&nbsp;<label for="cdev<?=$i;?>"><?=$item['detail'];?></label>
						<?php
						$i++;
					}
					?>
					</td>
				</tr>
				<tr>
					<td class="table_font1">����÷���Ѻ��зҹ�Ѩ�غѹ : </td>
					<td class="table_font2">
					<?php 
					$q = mysql_query("SELECT * FROM `f43_nutrition_202`");
					$i = 1;
					while( $item = mysql_fetch_assoc($q) ){ 
						?>
						<input type="radio" name="FOOD" id="food<?=$i;?>" value="<?=$item['code'];?>">&nbsp;<label for="food<?=$i;?>"><?=$item['detail'];?></label><br>
						<?php
						$i++;
					}
					?>
					</td>
				</tr>
				<tr>
                    <td class="table_font1">�����Ǵ�� : </td>
                    <td class="table_font2">
						<?php 
						$q = mysql_query("SELECT * FROM `f43_nutrition_203`");
						$i = 1;
						while( $item = mysql_fetch_assoc($q) ){ 
							?>
							<input type="radio" name="BOTTLE" id="bottle<?=$i;?>" value="<?=$item['code'];?>">&nbsp;<label for="bottle<?=$i;?>"><?=$item['detail'];?></label><br>
							<?php
							$i++;
						}
						?>
						</td>
                    </td>
                </tr>
				<tr>
                    <td class="table_font1">ᾷ��������ԡ�� : </td>
                    <td class="table_font2">
                        <?php 
                        // $db->select("SELECT `PROVIDER`,`REGISTERNO`,`NAME`,`LNAME` FROM `tb_provider_9` ORDER BY `ROW_ID` ");
						// $providerLists = $db->get_items();

						$query = mysql_query("SELECT `PROVIDER`,`REGISTERNO`,`NAME`,`LNAME` FROM `tb_provider_9` WHERE `REGISTERNO` <> '' ORDER BY `ROW_ID` ");
						// mysql_fetch_assoc();
						?>
						<select name="PROVIDER" id="">
							<option value="">��س����͡�������ԡ��</option>
							<?php 
							// foreach ($providerLists as $key => $pv) {
							while( $pv = mysql_fetch_assoc($query) ){
								
								$dr_no = '';
								if( $pv['REGISTERNO'] ){
									$dr_no = ' ('.$pv['REGISTERNO'].')';
								}
							
							?>
							<option value="<?=$pv['PROVIDER'];?>"><?=$pv['NAME'].' '.$pv['LNAME'].$dr_no;?></option>
							<?php
							}
							?>
						</select>
						<?php
                        ?>
                    </td>
                </tr>
			</table>
		</td>
	</tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" colspan="2"><input name="button2" type="submit" class="table_font1" id="button2" value="�ѹ�֡������"></td>
      </tr>
	 
    </table>
  </form>
</fieldset>

<? 
}

?>
</div>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>