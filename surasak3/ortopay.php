<?php
    session_start();
    include("connect.inc");
?>
<script>
function cal(nameid){
	var num1 =parseInt(document.getElementById('y'+nameid).value);
	var num2 =parseInt(document.getElementById(nameid).value);
	sum = parseInt(num2) - parseInt(num1) ;
	
	return document.getElementById('n'+nameid).value=parseInt(sum);
}

function  checklist(){
	for(var i=1;i<=12;i++){
		if(document.getElementById('item'+i).value!=""){
			if(document.getElementById('dsp'+i).value==""){
				alert('กรุณาเลือกรายการ');
				document.getElementById('item'+i).focus();
				return false;	
			}
		}
	}
}
</script>
<?
//seek $an in bed
    $query = "SELECT * FROM bed WHERE an = '$an'";
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

   if(mysql_num_rows($result)){
      $cPtname= $row->ptname;
      $cPtright = $row->ptright;
      $cDoctor= $row->doctor;      
      $cHn=$row->hn;
      $cAn=$row->an;
      $cBedcode=$row->bedcode;
      $cDiag= $row->diagnos;
      $cAccno=$row->accno;

    echo"<font face='Angsana New'>ชื่อ: $cPtname,HN: $cHn,   AN: $cAn, เตียง: $cBedcode<br>";  
    echo "สิทธิการรักษา: $cPtright, โรค: $cDiag, แพทย์: $cDoctor<br>";
    echo "โปรดลงรายการค่าอุปกรณ์เวชภัณฑ์ในการผ่าตัด ลงราคาที่เบิกได้/ไม่ได้";
//    echo"<br><b>***ชื่อรายการ / ประเภท / จำนวนชิ้น / ราคารวม / ราคาส่วนที่เบิกได้(บาท)</b>";
           }  
   else {
    die("ไม่พบ AN : $an ในข้อมูลผู้ป่วยใน หรือจำหน่ายผู้ป่วยแล้ว<br><br>
            <a target=_self  href='../nindex.htm'><<ไปเมนู</a>");
           }   
 include("unconnect.inc");  
?>

<p>>>>><input name="n1" type="text" value="ชื่อรายการ" size="20" readonly="readonly">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="T1" type="text" value="เลือกประเภท" size="22" readonly="readonly">
&nbsp;&nbsp;&nbsp;&nbsp;<input name="T2" type="text" value="รหัสอุปรณ์" size="5" readonly="readonly">&nbsp;<input name="T2" type="text" value="จำนวน" size="3" readonly="readonly">
  <input name="T5" type="text" value="ราคารวม" size="8" readonly="readonly" />
  <input name="T3" type="text" value="เบิกได้(รวม)" size="8" readonly="readonly"><input name="T4" type="text" value="เบิกไม่ได้(รวม)" size="8" readonly="readonly">
<form method="POST" action="orpaid.php" onsubmit="return checklist()" name="form11">
  <p>1.&nbsp;
    <input type="text" name="item1" size="25" />
    <select size="1" name="dsp1">
      <option selected value="">*****โปรดเลือกรายการ*****</option>
      <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	 &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode1" size="5">
  <input type="text" name="amount1" size="3">
  <input name="price1" type="text" size="8" id="price1" onkeyup="cal('price1');" />
  <input name="yprice1" type="text" id="yprice1" onkeyup="cal('price1');" value="0" size="8"><input name="nprice1" type="text" id="nprice1" value="0" size="8">
  <br>
  2.&nbsp; <input type="text" name="item2" size="25">
  <select size="1" name="dsp2">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode2" size="5">
  <input type="text" name="amount2" size="3">
  <input name="price2" type="text" size="8" id="price2" onkeyup="cal('price2');"/>
  <input name="yprice2" type="text" id="yprice2" value="0" size="8" onkeyup="cal('price2');"><input name="nprice2" type="text" id="nprice2" value="0" size="8" >
  <br>
  3.&nbsp; <input type="text" name="item3" size="25"> 
  <select size="1" name="dsp3">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode3" size="5">
  <input type="text" name="amount3" size="3">
  <input name="price3" type="text" size="8" id="price3" onkeyup="cal('price3');"/>
  <input name="yprice3" type="text" id="yprice3" value="0" size="8" onkeyup="cal('price3');"><input name="nprice3" type="text" id="nprice3" value="0" size="8" >
  <br>
  4.&nbsp; <input type="text" name="item4" size="25">
  <select size="1" name="dsp4">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode4" size="5">
  <input type="text" name="amount4" size="3">
  <input name="price4" type="text" size="8" id="price4" onkeyup="cal('price4');"/>
  <input name="yprice4" type="text" id="yprice4" value="0" size="8" onkeyup="cal('price4');"><input name="nprice4" type="text" id="nprice4" value="0" size="8" >
  <br>
  5.&nbsp; <input type="text" name="item5" size="25">
  <select size="1" name="dsp5">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode5" size="5">
  <input type="text" name="amount5" size="3">
  <input name="price5" type="text" size="8" id="price5" onkeyup="cal('price5');"/>
  <input name="yprice5" type="text" id="yprice5" value="0" size="8" onkeyup="cal('price5');"><input name="nprice5" type="text" id="nprice5" value="0" size="8" >
  <br>
  6.&nbsp; <input type="text" name="item6" size="25">
  <select size="1" name="dsp6">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode6" size="5">
  <input type="text" name="amount6" size="3">
  <input name="price6" type="text" size="8" id="price6" onkeyup="cal('price6');"/>
  <input name="yprice6" type="text" id="yprice6" value="0" size="8" onkeyup="cal('price6');"><input name="nprice6" type="text" id="nprice6" value="0" size="8" >
  <br>
  7.&nbsp; <input type="text" name="item7" size="25">
  <select size="1" name="dsp7">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode7" size="5">
 <input type="text" name="amount7" size="3">
  <input name="price7" type="text" size="8" id="price7" onkeyup="cal('price7');"/>
  <input name="yprice7" type="text" id="yprice7" value="0" size="8" onkeyup="cal('price7');"><input name="nprice7" type="text" id="nprice7" value="0" size="8" >
  <br>
  8.&nbsp; <input type="text" name="item8" size="25"> 
    <select size="1" name="dsp8">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode8" size="5">
  <input type="text" name="amount8" size="3">
  <input name="price8" type="text" size="8" id="price8" onkeyup="cal('price8');"/>
  <input name="yprice8" type="text" id="yprice8" value="0" size="8" onkeyup="cal('price8');"><input name="nprice8" type="text" id="nprice8" value="0" size="8" >
  <br>
  9.&nbsp; <input type="text" name="item9" size="25"> 
  <select size="1" name="dsp9">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode9" size="5">
  <input type="text" name="amount9" size="3">
  <input name="price9" type="text" size="8" id="price9" onkeyup="cal('price9');"/>
  <input name="yprice9" type="text" id="yprice9" value="0" size="8" onkeyup="cal('price9');"><input name="nprice9" type="text" id="nprice9" value="0" size="8">
  <br>
  10.<input type="text" name="item10" size="25">
  <select size="1" name="dsp10">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode10" size="5">
  <input type="text" name="amount10" size="3">
  <input name="price10" type="text" size="8" id="price10" onkeyup="cal('price10');"/>
  <input name="yprice10" type="text" id="yprice10" value="0" size="8" onkeyup="cal('price10');"><input name="nprice10" type="text" id="nprice10" value="0" size="8" >
  <br>
  11.<input type="text" name="item11" size="25"> 
  <select size="1" name="dsp11">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode11" size="5">
  <input type="text" name="amount11" size="3">
  <input name="price11" type="text" size="8" id="price11" onkeyup="cal('price11');"/>
  <input name="yprice11" type="text" id="yprice11" value="0" size="8" onkeyup="cal('price11');"><input name="nprice11" type="text" id="nprice11" value="0" size="8" >
  <br>
  12.<input type="text" name="item12" size="25"> 
  <select size="1" name="dsp12">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode12" size="5">
  <input type="text" name="amount12" size="3">
  <input name="price12" type="text" size="8" id="price12" onkeyup="cal('price12');"/>
  <input name="yprice12" type="text" id="yprice12" value="0" size="8" onkeyup="cal('price12');"><input name="nprice12" type="text" id="nprice12" value="0" size="8" >
  <br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      &#3605;&#3585;&#3621;&#3591;      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  " name="B2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>

