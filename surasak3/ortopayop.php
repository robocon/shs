<?php
    session_start();
    include("connect.inc");
	
///////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "drugreact"){
	
	$sql = "Select * from dpy where detail like '%".$_GET["search"]."%' or code like '%".$_GET["search"]."%' limit 10 ";
	$result = mysql_query($sql)or die(mysql_error());

	if(mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:450px; height:450px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\">
		<tr align=\"center\" bgcolor=\"#333333\">
		<td width=\"25\"><strong>&nbsp;</strong></td>
		<td width=\"80\"><font style=\"color: #FFFFFF;\"><strong>Code</strong></font></td>
		<td width=\"30\"><font style=\"color: #FFFFFF;\"><strong>Detail</strong></font></td>
		<td width=\"20\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td>
		</tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td valign=\"top\"></td>
		<td><A HREF=\"javascript:void(0);\" 
		Onclick=\"document.getElementById('".$_GET["getto"]."').value = '".$se["detail"]."';
		document.getElementById('".$_GET["getto2"]."').value = '".$se["code"]."';
		document.getElementById('".$_GET["getto3"]."').value = '".$se["price"]."';
		document.getElementById('".$_GET["getto4"]."').value = '".$se["price"]."';
		document.getElementById('list').innerHTML ='';\">".$se["code"]."</A></td>
		<td>".$se['detail']."</td>
		<td>&nbsp;</td>
		</tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
///////////////////////////////
?>
<script>
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
function searchSuggest(str,len,getto,getto2,getto3,getto4) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'ortopayop.php?action=drugreact&search='+ str+'&getto='+ getto+'&getto2='+ getto2+'&getto3='+ getto3+'&getto4='+ getto4;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>

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
/*
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

//สิ่งที่มี
        $cHn=$row->hn;
        $cPtname=$row->ptname;
        $cPtright=$row->ptright;

    $cDiag=$diag;
    $cDoctor=$doctor;
    $cAn="";
    $cAccno=0;
  $tvn="$tvn";

*/
    echo"<font face='Angsana New'>ชื่อ: $cPtname,HN: $cHn, สิทธิ: $cPtright  <br>";  
    echo "โรค: $cDiag, แพทย์: $cDoctor<br>";
    echo "โปรดลงรายการค่าอุปกรณ์เวชภัณฑ์ในการผ่าตัด ลงราคาที่เบิกได้/ไม่ได้";
 print" <a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
 
?>
<p>>>>><input name="n1" type="text" value="ชื่อรายการ" size="20" readonly="readonly">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="T1" type="text" value="เลือกประเภท" size="22" readonly="readonly">
&nbsp;&nbsp;&nbsp;&nbsp;<input name="T2" type="text" value="รหัสอุปรณ์" size="5" readonly="readonly">&nbsp;<input name="T2" type="text" value="จำนวน" size="3" readonly="readonly">
  <input name="T5" type="text" value="ราคารวม" size="8" readonly="readonly" />
  <input name="T3" type="text" value="เบิกได้(รวม)" size="8" readonly="readonly"><input name="T4" type="text" value="เบิกไม่ได้(รวม)" size="8" readonly="readonly">
<Div id="list" style="left:200PX;top:30PX;position:absolute;"></Div>  
<form method="POST" action="orpaid.php" onsubmit="return checklist()" name="form11">
  <p>1.&nbsp;
    <input type="text" name="item1" id="item1" size="25" onKeyPress="searchSuggest(this.value,2,'item1','dpycode1','price1','yprice1');" />
    <select size="1" name="dsp1">
      <option selected value="">*****โปรดเลือกรายการ*****</option>
      <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	 &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode1" id="dpycode1" size="5">
  <input type="text" name="amount1" id="amount1" size="3">
  <input name="price1" type="text" size="8" id="price1" onkeyup="cal('price1');" />
  <input name="yprice1" type="text" id="yprice1" onkeyup="cal('price1');" value="0" size="8"><input name="nprice1" type="text" id="nprice1" value="0" size="8">
  <br>
  2.&nbsp; <input type="text" name="item2" id="item2" size="25" onKeyPress="searchSuggest(this.value,2,'item2','dpycode2','price2','yprice2');">
  <select size="1" name="dsp2">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode2" id="dpycode2" size="5">
  <input type="text" name="amount2" size="3">
  <input name="price2" type="text" size="8" id="price2" onkeyup="cal('price2');"/>
  <input name="yprice2" type="text" id="yprice2" value="0" size="8" onkeyup="cal('price2');"><input name="nprice2" type="text" id="nprice2" value="0" size="8" >
  <br>
  3.&nbsp; <input type="text" name="item3" id="item3" size="25" onKeyPress="searchSuggest(this.value,2,'item3','dpycode3','price3','yprice3');">
  <select size="1" name="dsp3">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode3" id="dpycode3" size="5">
  <input type="text" name="amount3" size="3">
  <input name="price3" type="text" size="8" id="price3" onkeyup="cal('price3');"/>
  <input name="yprice3" type="text" id="yprice3" value="0" size="8" onkeyup="cal('price3');"><input name="nprice3" type="text" id="nprice3" value="0" size="8" >
  <br>
  4.&nbsp; <input type="text" name="item4" id="item4" size="25" onKeyPress="searchSuggest(this.value,2,'item4','dpycode4','price4','yprice4');">
  <select size="1" name="dsp4">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode4" id="dpycode4" size="5">
  <input type="text" name="amount4" size="3">
  <input name="price4" type="text" size="8" id="price4" onkeyup="cal('price4');"/>
  <input name="yprice4" type="text" id="yprice4" value="0" size="8" onkeyup="cal('price4');"><input name="nprice4" type="text" id="nprice4" value="0" size="8" >
  <br>
  5.&nbsp; <input type="text" name="item5" id="item5" size="25" onKeyPress="searchSuggest(this.value,2,'item5','dpycode5','price5','yprice5');">
  <select size="1" name="dsp5">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode5" id="dpycode5" size="5">
  <input type="text" name="amount5" size="3">
  <input name="price5" type="text" size="8" id="price5" onkeyup="cal('price5');"/>
  <input name="yprice5" type="text" id="yprice5" value="0" size="8" onkeyup="cal('price5');"><input name="nprice5" type="text" id="nprice5" value="0" size="8" >
  <br>
  6.&nbsp; <input type="text" name="item6" id="item6" size="25" onKeyPress="searchSuggest(this.value,2,'item6','dpycode6','price6','yprice6');">
  <select size="1" name="dsp6">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode6" id="dpycode6" size="5">
  <input type="text" name="amount6" size="3">
  <input name="price6" type="text" size="8" id="price6" onkeyup="cal('price6');"/>
  <input name="yprice6" type="text" id="yprice6" value="0" size="8" onkeyup="cal('price6');"><input name="nprice6" type="text" id="nprice6" value="0" size="8" >
  <br>
  7.&nbsp; <input type="text" name="item7" id="item7" size="25" onKeyPress="searchSuggest(this.value,2,'item7','dpycode7','price7','yprice7');">
  <select size="1" name="dsp7">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode7" id="dpycode7" size="5">
 <input type="text" name="amount7" size="3">
  <input name="price7" type="text" size="8" id="price7" onkeyup="cal('price7');"/>
  <input name="yprice7" type="text" id="yprice7" value="0" size="8" onkeyup="cal('price7');"><input name="nprice7" type="text" id="nprice7" value="0" size="8" >
  <br>
  8.&nbsp; <input type="text" name="item8" id="item8" size="25" onKeyPress="searchSuggest(this.value,2,'item8','dpycode8','price8','yprice8');">
    <select size="1" name="dsp8">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode8" id="dpycode8" size="5">
  <input type="text" name="amount8" size="3">
  <input name="price8" type="text" size="8" id="price8" onkeyup="cal('price8');"/>
  <input name="yprice8" type="text" id="yprice8" value="0" size="8" onkeyup="cal('price8');"><input name="nprice8" type="text" id="nprice8" value="0" size="8" >
  <br>
  9.&nbsp; <input type="text" name="item9" id="item9" size="25" onKeyPress="searchSuggest(this.value,2,'item9','dpycode9','price9','yprice9');">
  <select size="1" name="dsp9">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode9" id="dpycode9" size="5">
  <input type="text" name="amount9" size="3">
  <input name="price9" type="text" size="8" id="price9" onkeyup="cal('price9');"/>
  <input name="yprice9" type="text" id="yprice9" value="0" size="8" onkeyup="cal('price9');"><input name="nprice9" type="text" id="nprice9" value="0" size="8">
  <br>
  10.<input type="text" name="item10" id="item10" size="25" onKeyPress="searchSuggest(this.value,2,'item10','dpycode10','price10','yprice10');">
  <select size="1" name="dsp10">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode10" id="dpycode10" size="5">
  <input type="text" name="amount10" size="3">
  <input name="price10" type="text" size="8" id="price10" onkeyup="cal('price10');"/>
  <input name="yprice10" type="text" id="yprice10" value="0" size="8" onkeyup="cal('price10');"><input name="nprice10" type="text" id="nprice10" value="0" size="8" >
  <br>
  11.<input type="text" name="item11" id="item11" size="25" onKeyPress="searchSuggest(this.value,2,'item11','dpycode11','price11','yprice11');">
  <select size="1" name="dsp11">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode11" id="dpycode11" size="5">
  <input type="text" name="amount11" size="3">
  <input name="price11" type="text" size="8" id="price11" onkeyup="cal('price11');"/>
  <input name="yprice11" type="text" id="yprice11" value="0" size="8" onkeyup="cal('price11');"><input name="nprice11" type="text" id="nprice11" value="0" size="8" >
  <br>
  12.<input type="text" name="item12" id="item12" size="25" onKeyPress="searchSuggest(this.value,2,'item12','dpycode12','price12','yprice12');">
  <select size="1" name="dsp12">
	<option selected value="">*****โปรดเลือกรายการ*****</option>
    <option value="DP">อวัยวะเทียม/อุปกรณ์</option>
	<option value="DS">เวชภัณฑ์ที่ไม่ใช่ยา</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dpycode12" id="dpycode12" size="5">
  <input type="text" name="amount12" size="3">
  <input name="price12" type="text" size="8" id="price12" onkeyup="cal('price12');"/>
  <input name="yprice12" type="text" id="yprice12" value="0" size="8" onkeyup="cal('price12');"><input name="nprice12" type="text" id="nprice12" value="0" size="8" >
  <br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  ลบทิ้ง  " name="B2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< ไปเมนู</a></p>
</form>
<?php 
$dateid = (date('Y') + 543).'-'.date('m-d');
// แจ้งเตือน: ผู้ป่วย พ.ร.บ.
$q = mysql_query("select * from opday where thidate like '$dateid%' and hn='$cHn' and `ptright` LIKE 'R06%'");
$ptRows = mysql_num_rows($q);
if( $ptRows > 0 ){

	$test_pt = mysql_fetch_assoc($q);
	$user_ptright = substr($test_pt["ptright"], 0, 3);

	// 2561-11-05
	$chkdate = substr($dateid,0,4);
	
	$sql = "SELECT SUBSTRING(`thidate`,1,10) AS `date`,( SUM(`PHAR`) + SUM(`xray`) + SUM(`patho`) + SUM(`emer`) + SUM(`surg`) + SUM(`physi`) + SUM(`denta`) + SUM(`other`) ) AS `total` 
	FROM `opday`
	WHERE hn='$cHn' 
	AND `thidate` LIKE '$chkdate%' 
	AND `ptright` LIKE '$user_ptright%' 
	GROUP BY CONCAT(SUBSTRING(`thidate`, 1, 10), `hn`)";
	$q = mysql_query($sql);
	$count = mysql_num_rows($q);

	if( $count > 0 ){
		$text_list = '<br><span style="font-size: 18px;"><b><u>แจ้งเตือน: ผู้ป่วย พ.ร.บ. มีค่าใช้จ่ายในปี '.$chkdate.' ดังนี้</u></b></span><br>';
		$total = 0;
		while ($item = mysql_fetch_assoc($q)) { 
      $testTotal = (int) $item['total'];
      if($testTotal > 0){
        $text_list .= 'เมื่อวันที่ '.$item['date'].' จำนวน '.$item['total'].' บาท<br>';
			  $total += $item['total'];
      }
		}
		$text_list .= '<b>รวมเป็นเงิน '.$total.' บาท</b>';
		echo $text_list;
	}
}

include("unconnect.inc");  