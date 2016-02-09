<?php
/*$con=mysql_connect("localhost","root","1234");
if($con){
	
    mysql_select_db("smdb");
    
}else{
    echo mysql_error();
}

*/
  print "<a target=_self  href='../nindex.htm'><< ไปเมนู</a><br>";
  include("connect.inc");


?>
<style type="text/css">
@media print
{
#non-printable { display:none; }
#printable { display:none; }
}
.f { font-family:"Angsana New"; font-size:25px; }
.f1 { font-family:"Angsana New"; font-size:22px; }
.f2 { font-family:"Angsana New"; font-size:24px; }
.f3 { font-family:"Angsana New"; font-size:25px; }

}

</style>

<center><b class="f">แบบการแจ้งนอนโรงพยาบาล</b></center>
<body>
<div id="printable">
<form name="form1" method="post" action="">
<td  align=left  >   
Hn<input name="code" type="text" size ="10" >
</table>

<input type="submit" name="button1" id="button1" value="ตกลง" />
</form>
</div>
<p>
  <?
if(isset($_POST['code']) && (!empty($_POST['code']))){ 


    $sql="select * from opcard where hn = '$code' limit 1";
    $rs= mysql_query($sql);
	$show=mysql_fetch_array($rs) ;
	
	function calcage($birth){
	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

?>
</p>
<form action="" method="post" name="form2">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td  class="f3"><strong>&nbsp;HN</strong>&nbsp;
      <?=$show['hn'];?>&nbsp;&nbsp;&nbsp;<strong>ชื่อ</strong>&nbsp;<?=$show['yot'];?>&nbsp;<?=$show['name'];?>&nbsp;&nbsp;
      <?=$show['surname'];?>
      <strong>&nbsp;&nbsp;&nbsp;อายุ</strong>&nbsp;
      <?=calcage($show['dbirth'])?>
      <strong>สิทธิ์</strong>&nbsp;
      <?=$show['ptright'];?>
      </td>
    </tr>
  </table>
  <input type="hidden" name="hn" value="<?=$show['hn'];?>">
   <input type="hidden" name="name" value="<?=$show['name'];?>">
    <input type="hidden" name="surname" value="<?=$show['surname'];?>">
     <input type="hidden" name="age" value=" <?=calcage($show['dbirth'])?>">
     <input type="hidden" name="ptright" value=" <?=$show['ptright']?>">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
        <td class="f" style="border-bottom-style:none; border-right-style:none;">ประเภท</td>
    <td class="f1" style="border-bottom-style:none; border-right-style:none;"><input type="radio" name="type" id="type" value="ปกติ" />      ปกติ</td>
    <td colspan="5" class="f1" style="border-bottom-style:none; border-left-style:none;"><input type="radio" name="type" id="type" value="ฉุกเฉิน" />      ฉุกเฉิน</td>
    </tr>
  <tr>
    <td class="f" style="border-bottom-style:none; border-right-style:none; border-top-style:none;">Clinic</td>
    <td class="f1" style="border-bottom-style:none; border-right-style:none; border-top-style:none;"><input type="radio" name="clinic" id="clinic" onclick="document.form1.case11.disabled=true;" value="อายุรกรรม" />      อายุรกรรม</td>
    <td class="f1" style="border-bottom-style:none; border-right-style:none; border-top-style:none; border-left-style:none;"><input type="radio" name="clinic" id="clinic" onclick="document.form.case11.disabled=true;" value="ศัลยกรรม" />      ศัลยกรรม</td>
    <td class="f1" style="border-bottom-style:none; border-right-style:none; border-top-style:none; border-left-style:none;"><input type="radio" name="clinic" id="clinic" onclick="document.form1.case11.disabled=true;" value="สูติ" />   
    สูติ</td>
    <td class="f1" style="border-bottom-style:none; border-right-style:none; border-top-style:none; border-left-style:none;">    <input type="radio" name="clinic" id="radio" onclick="document.form1.case11.disabled=true;" value="จักษุ" />
    จักษุ</td>
    <td class="f1" style="border-bottom-style:none; border-top-style:none; border-left-style:none;"></input>
      <span class="f1" style="border-bottom-style:none; border-top-style:none; border-left-style:none;">
      <input type="radio" name="clinic" id="clinic" onclick="document.form1.case11.disabled=false;" value="อื่นๆ" />
      </span> อื่นๆ
      <span class="f1" style="border-bottom-style:none; border-top-style:none; border-left-style:none;">

        <input  type="text" id="case11" size="20"  name="case11" />                                                        
      </span></td>
    
    </tr>
       <tr >
      <td class="f1" style="border-bottom-style:none; border-top-style:none; border-right-style:none;">ห้อง</td>
      <td class="f1" style="border-bottom-style:none; border-top-style:none; border-right-style:none;" ><input type="radio" name="room" id="room" value="ธรรมดา" />ธรรมดา</td>
      <td class="f1" style="border-bottom-style:none; border-top-style:none; border-style:none;"><input type="radio" name="room" id="room" value="พิเศษได้" />พิเศษได้</td>
      <td class="f1" style="border-bottom-style:none; border-top-style:none; border-style:none;"><input type="radio" name="room" id="room" value="ICU" />ICU </td>
      </tr>



  <tr>
    <td class="f" style="border-bottom-style:none; border-right-style:none; border-top-style:none;">แพทย์</td>
    <? $doc1="SELECT * FROM `doctor` WHERE STATUS = 'y'";
$d1 = mysql_query($doc1);
?>
    <td colspan="8" style="border-bottom-style:none; border-top-style:none;"><select name="doctor" id="doctor">
      <? while($show1=mysql_fetch_array($d1)){?>
      <option value="<?=$show1['name'];?>">
        <?=$show1['name'];?>
        </option>
      <? } ?>
    </select></td>
    </tr>
  <tr>
    <td class="f" style="border-right-style:none; border-top-style:none;">หมายเหตุ</td>
    <td colspan="8" style="border-top-style:none;"><textarea name="comment" id="comment" cols="80" rows="5"></textarea></td>
  </tr>
</table>
<p>
  <center><input type="submit" name="button2" id="button2" value="ตกลง"></center>
</form>
<? } ?>
<?
if($_POST['button2']){
/*$sql="select * from opcard where hn like '%".$_POST['hn'].$_POST['name'].$_POST['surname'].$_POST['dbirth']."%' limit 1";
$rs1=mysql_query($sql);
$ee=mysql_fetch_array($rs1);*/

$hn=$_POST['hn'];
$name=$_POST['name'];
$surname=$_POST['surname'];
$age=$_POST['age'];
$ptright=$_POST['ptright'];
$type=$_POST['type'];

if($_POST['clinic']=='อื่นๆ'){
	
	$clinic=$_POST['case11'];
}else{
	$clinic=$_POST['clinic'];
}

$room=$_POST['room'];
$doctor=$_POST['doctor'];
$comment=$_POST['comment'];



$sql="INSERT INTO `admit` (`hn` , `name` , `surname` , `age` , `ptright` , `type` , `clinic` , `room` , `doctor` , `comment` , `D_UPDATE` )
VALUES ('$hn', '$name', '$surname', '$age', '$ptright', '$type', '$clinic','$room', '$doctor', '$comment',now()
)";

if(mysql_query($sql)){
	
	$id=mysql_insert_id();
	echo "บันทึกสำเร็จ";
	?>
    <script>
	window.open('admit_print.php?row_id=<?=$id?>');
	</script>
    <?
	
}else{
	echo mysql_error();
}
}
?>
