<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.table_font1{
	font-family: "TH SarabunPSK";
	font-size: 20px;
	color:#900;
}
.table_font2{
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
-->
</style>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'));

};

</script>
<script>

function fncSubmit()
{
	if(document.form2.weight.value=="")
	{
		alert('กรุณาระบุน้ำหนักด้วยครับ');
		document.form2.weight.focus();
		return false;
	}
	if(document.form2.develop_age.value==""){
		alert("กรุณาระบุข้อมูล พัฒนาการสมวัย ด้านร่างกายและอารมณ์") ;
		document.form2.develop_age.focus() ;
		return false ;
	}		

	if(document.form2.growth_0.checked == false && document.form2.growth_1.checked == false && document.form2.growth_2.checked == false)
	{
		alert('กรุณาเลือก การเจริญเติบโตตามมารตรฐานอายุและน้ำหนัก');
		
		return false;
	}	
	
if(document.form2.age1.value<=0 && document.form2.age2.value<=6){	
	if(document.form2.breastmilk_0.checked == false && document.form2.breastmilk_1.checked == false && document.form2.breastmilk_2.checked == false)
	{
		alert('กรุณาเลือก นมแม่ในเด็ก 0-6 เดือน');
		
		return false;
	}	
	
}
	
	document.form2.submit();
}

</script>
<div align="center">

<? 
include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

$sqlstr="SELECT * FROM `well_baby` WHERE row_id= '".$_REQUEST['row_id']."'";
$resultstr = mysql_query($sqlstr);
$fetchstr= mysql_fetch_array($resultstr);

$sql1 = "select *  from opcard Where  hn = '".$fetchstr['hn']."' ";
	$result1 = mysql_query($sql1);
	$numrows=mysql_num_rows($result1);
	$fetch= mysql_fetch_array($result1);
	
	$dbirth=$fetch['dbirth'];
	$age = calcage($dbirth);
	
	$age2= calcage2($dbirth);
	
	$calage=explode('/',$age2);

?>
<fieldset><legend style="margin:0px 20px" class="forntsarabun">ข้อมูลผู้ป่วย</legend>
  <form name="form2" method="post" action="" onSubmit="JavaScript:return fncSubmit();">
    <table width="50%" border="0" align="center" >
      <tr>
        <td ><span class="table_font1">HN :</span><span class="table_font2">
          <?=$fetch['hn'];?>
          </span> <input name="phn" type="hidden" value="<?=$fetchstr['hn'];?>"><span class="table_font1">ชื่อ-สกุล :</span><span class="table_font2">
            <?=$fetch['yot'].$fetch['name'].' '.$fetch['surname'];?>
          </span></td>
      </tr>
      <tr>
        <td ><span class="table_font1">สิทธิการรักษา :</span><span class="table_font2">
          <?=$fetch['ptright'];?>
        </span></td>
      </tr>
      <tr>
        <td ><span class="table_font1">อายุ :</span><span class="table_font2">
          <?=$age;?>
        </span><input name="age" type="hidden" value="<?=$age;?>"><input name="age2" id="age2" type="hidden" value="<?=$age2;?>"></td>
      </tr>
      <tr>
        <td ><span class="table_font1">วันที่ : 
          <input name="date1" type="text" class="table_font2" id="date1" value="<?=date("d/m/Y");?>">
        *เลือกวันที่จากปฎิทิน</span></td>
      </tr>
      <tr>
        <td class="table_font1">น้ำหนัก : 
          <label for="weight"></label>
          <input name="weight" type="text" class="table_font2" id="weight" size="10" value="<?=$fetchstr['weight'];?>">
          ก.ก.</td>
        </tr>
      <tr>
        <td class="table_font1">พัฒนาการสมวัย ด้านร่างกายและอารมณ์</td>
        </tr>
      <tr>
        <td class="table_font1"><input name="develop_age" type="text" class="table_font2" id="develop_age" size="70" value="<?=$fetchstr['develop_age'];?>"></td>
      </tr>
      <tr>
        <td class="table_font1">การเจริญเติบโตตามมารตรฐานอายุและน้ำหนัก</td>
      </tr>
      <tr>
        <td ><p>
           <label class="table_font2">
            <input type="radio" name="growth" value="N" id="growth_0" <? if($fetchstr['growth']=='N'){ echo "checked"; }?>>
            ตามเกณฑ์</label>
           <label class="table_font2">
            <input type="radio" name="growth" value="L" id="growth_1" <? if($fetchstr['growth']=='L'){ echo "checked"; }?>>
            ต่ำกว่าเกณฑ์</label>
           <label class="table_font2">
            <input type="radio" name="growth" value="M" id="growth_2" <? if($fetchstr['growth']=='M'){ echo "checked"; }?>>
            เกินกว่าเกณฑ์</label>
          <br>
        </p></td>
      </tr>
        <? if($calage[0]<=0 && $calage[1]<=6 ){	?>
      <tr>
	
        <td class="table_font1">
        นมแม่ในเด็ก 2-6 เดือน
	</td>
      </tr>
      <tr>
        <td>
        <label class="table_font2">
            <input type="radio" name="breastmilk" value="นมแม่" id="breastmilk_0" <? if($fetchstr['breastmilk']=='นมแม่'){ echo "checked"; }?>>
            นมแม่</label>
           <label class="table_font2">
            <input type="radio" name="breastmilk" value="นมแม่+นมผสม" id="breastmilk_1" <? if($fetchstr['breastmilk']=='นมแม่+นมผสม'){ echo "checked"; }?>>
            นมแม่+นมผสม</label>
           <label class="table_font2">
            <input type="radio" name="breastmilk" value="นมผสม" id="breastmilk_2" <? if($fetchstr['breastmilk']=='นมผสม'){ echo "checked"; }?>>
            นมผสม</label></td>
      </tr>
       <?  } ?>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">
        <input type="hidden" name="row_id" value="<?=$fetchstr['row_id'];?>">
        <input name="button2" type="submit" class="table_font1" id="button2" value="บันทึกการแก้ไขข้อมูล"></td>
      </tr>
	 
    </table>
  </form>
</fieldset>
</div>
<? 
if($_POST['button2']){

$register=date("Y-m-d H:i:s");

$thidate=explode('/',$_POST['date1']);

$thidate2=$thidate[2].'-'.$thidate[1].'-'.$thidate[0];


$sql="UPDATE `well_baby` SET `thidate` = '".$thidate2."',
`hn` = '".$_POST['phn']."',
`age` = '".$_POST['age']."',
`weight` = '".$_POST['weight']."',
`develop_age` = '".$_POST['develop_age']."',
`growth` =  '".$_POST['growth']."',
`breastmilk` = '".$_POST['breastmilk']."'  WHERE `row_id` = '".$_POST['row_id']."' ";

$query=mysql_query($sql)or die (mysql_error());
		 
		 
		 if($query){
			echo"<h1 align='center' class='forntsarabun'>บันทึกข้อมูลเรียบร้อยแล้ว </h1>";
		//	echo "<meta http-equiv='refresh' content='2; url=clinic_well_baby.php'>" ;
		?>
<script>
window.opener.location.reload();
window.open('','_self');
setTimeout("self.close()",2000);
</script>
		<?
	
			}else {
			echo "<h1 align='center' class='forntsarabun'>ไม่สามารถเพิ่มข้อมูลได้</h1>";
		//	echo "<meta http-equiv='refresh' content='2; url=clinic_well_baby.php'>" ;
		?>
        <script>
window.opener.location.reload();
window.open('','_self');
setTimeout("self.close()",3000);
</script>
        <?
			}	
			
			
}
?>