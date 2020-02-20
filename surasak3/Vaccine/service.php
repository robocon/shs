<?php
session_start();
include 'Connections/config.php';
include 'Connections/all_function.php';

$action = $_POST['action'];
if( $action === 'save' ){

	$hn=$_POST['hn'];
	$vaccine = $_POST['vaccine'];
	$vaccine_detail = $_POST['vaccine_detail'];
	$unit=$_POST['unit'];
	$doctor =$_POST['doctor'];
	$lotno=$_POST['lotno'];
	$lotno2=$_POST['lotno2'];
	$date2 =$_POST['date2'];//date_end
	$date3 =$_POST['date3'];//date_end2

	$y=date('Y')+543;
	$m=date('m');
	$d=date('d');
	$datetime=$d.'/'.$m.'/'.$y.' '.date('H:i:s');
	$date11=explode('/',$_POST['date1']);
	$date1=$date11[2].'-'.$date11[1].'-'.$date11[0];

	$sql_add2="INSERT  INTO tb_service (date_ser,hn,id_vac,num,unit,name_doc,lotno,date_end,lotno2,date_end2,date_insert) VALUES ('$date1','$hn','$vaccine','$vaccine_detail','$unit','$doctor','$lotno','$date2','$lotno2','$date3','$datetime') ";
	$query_add2=mysql_query($sql_add2) or die( mysql_error() );

	/**
	 * เก็บข้อมูล43แฟ้ม
	 */
	$VACCINETYPE = $_POST['VACCINETYPE'];
	// เจน SEQ 
	// @todo วันที่จาก date1 จะเป็น mmddYYYY
	list($m1,$d1,$y1) = explode('/',$_POST['date1']);
	$sql = "SELECT `row_id`,`vn`,`clinic` FROM `opday` WHERE `thidate` LIKE '".($y1+543)."-$m1-$d1%' AND `hn` = '$hn'";
	$q = mysql_query($sql);

	$vn = '00';
	$clinicCode = '99';
	$opday_id = '';
	if ( mysql_num_rows($q) > 0 ) {
		$item = mysql_fetch_assoc($q);
		$clinicName = $item['clinic'];
		$vn = $item['vn'];
		$opday_id = $item['row_id'];
	} 

	if ( preg_match('/(\d+)\s(.+)/', $clinicName, $matchs) > 0 ) { 
        
        $clinicCode = $matchs['1'];

    }elseif( $clinicName !== null ){ 
		$q = mysql_query("SELECT `code` FROM `f43_clinic` WHERE `detail` = '$clinicName' ");
		$clinicDb = mysql_fetch_assoc($q);
		$clinicCode = $clinicDb['code'];
    }

    $s1 = date('Ymd', strtotime("$y1-$m1-$d1"));
    $newHn = sprintf('%06d', $vn);
	// เจน SEQ

	$SEQ = $s1.$clinicCode.$newHn;
	$DATE_SERV = $y1.$m1.$d1;

	//
	if( preg_match('/MD\d+/', $doctor) > 0 ){
        $prefixMd = substr($doctor,0,5);
        $where = "`name` LIKE '$prefixMd%'";

    }elseif ( preg_match('/(\d+){4,5}/', $doctor, $matchs) ) {
        $prefixMd = $matchs['0'];
        $where = "`doctorcode` = '$prefixMd'";
    }

	$q = mysql_query("SELECT `doctorcode` FROM `doctor` WHERE $where ");
	$dr = mysql_fetch_assoc($q);
	$doctorcode = $dr['doctorcode'];

	$q = mysql_query("SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ");
	$dr = mysql_fetch_assoc($q);
	$PROVIDER = $dr['PROVIDER'];
	// 

	$D_UPDATE = date('YmdHis'); 

	$q = mysql_query("SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn' ");
	$opcard = mysql_fetch_assoc($q);
	$CID = $opcard['idcard'];

	$vaccList = array($VACCINETYPE);
	if( strstr($VACCINETYPE, ',') !== false ){
		$vaccList = explode(',', $VACCINETYPE);
	}

	foreach ($vaccList as $key => $value) {

		// เก็บข้อมูล 43แฟ้ม
		$sql = "INSERT INTO `43epi` ( 
			`id`, `HOSPCODE`, `PID`, `SEQ`, `DATE_SERV`, `VACCINETYPE`, 
			`VACCINEPLACE`, `PROVIDER`, `D_UPDATE`, `CID`, `opday_id` 
		) VALUES ( 
			NULL, '11512', '$hn', '$SEQ', '$DATE_SERV', '$value', 
			'11512', '$PROVIDER', '$D_UPDATE', '$CID', '$opday_id' 
		);";
		$query_add2 = mysql_query($sql);
		if (!$query_add2) {
			$sql_add2 = mysql_error();
		}
	}
	
	if($query_add2){
		echo "บันทึกข้อมูลเรียบร้อยแล้ว";
	}else{
		echo "Error Save [".$sql_add2."]";
	}

	echo "<meta http-equiv='refresh' content='2; url=service.php'>" ;
	exit;
}


?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=windows-874" /> -->
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>สมุดทะเบียนการรับบริการวัคซีนเด็ก</title>
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
.chk_table{
    border-collapse: collapse;
	font-size:16pt;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
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
	var dp_cal;
	window.onload = function () {
		dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'),false);
	};
</script>
<script src="../templates/classic/main.js"></script>

<script language=Javascript>
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val) {
    //  var req = Inint_AJAX();
    //  req.onreadystatechange = function () { 
    //       if (req.readyState==4) {
    //            if (req.status==200) {
    //             document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
    //            } 
    //       }
    //  };
    //  req.open("GET", "locale.php?data="+src+"&val="+val); //สร้าง connection
    //  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
    //  req.send(null); //ส่งค่า

  var newSm = new SmHttp();
  newSm.ajax(
    'locale.php?data='+src+'&val='+val,
    {},
    function(res){
      // console.log(res);
      document.getElementById(src).innerHTML=res; //รับค่ากลับมา
    }
  );

}

// window.onLoad=dochange('vaccine', -1);     

function ch_null(){
	if(document.form1.hn.value==""){
		alert("กรุณากรอก HN ด้วยครับ");
		return false;
	}
}

function fncSubmit()
{
	if(document.sel.vaccine.selectedIndex==0)
	{
		alert('กรุณาเลือกวัคซีนด้วยครับ');
		document.sel.vaccine.focus();
		return false;
	}
	if(document.sel.vaccine_detail.selectedIndex==0) {
		alert("กรุณาระบุเข็มที่ฉีดด้วยครับ") ;
		document.sel.vaccine_detail.focus() ;
		return false ;
	}		

	if(document.sel.doctor.selectedIndex==0)
	{
		alert('กรุณาเลือกแพทย์ด้วยครับ');
		document.sel.doctor.focus();		
		return false;
	}	
	
	document.sel.submit();
}

</script>

<form action="" method="post" name="form1" id="form1" onSubmit="JavaScript:return ch_null();">
<table width="285" border="0" align="center">
        <tr>
          <td colspan="3" class="forntsarabun"><h2 align="center">รับบริการวัคซีน</h2></td>
          </tr>
        <tr>
          <td width="96" align="right" class="forntsarabun"><span class="table_font1">HN</span> :</td>
          <td width="173" colspan="2" align="left"><input name="hn" type="text" class="table_font2" id="hn" /></td>
          </tr>
        <tr>
          <td colspan="3" align="center"><input name="button" type="submit" class="table_font1" id="button" value="ตกลง" />
         </td>
          </tr>
        </table>

</form>

<hr>
  <?php

 $hn=trim($_POST['hn']);

  if($_POST['button']=='ตกลง' || $hn!=''){

	/*$sql="select * from opcard  Where  hn='$hn' ";
	$query=mysql_query($sql);
	$numrows=mysql_num_rows($query);

	$dbarr1=mysql_fetch_array($query);*/

	$yy=date("Y");
	$mm=date("m");
	$dd=date("d");
	$dateN=$dd.'/'.$mm.'/'.$yy;
	
	
	
		
	$sql1 = "select *  from opcard Where  hn = '$hn' ";
	$result1 = mysql_query($sql1);
	$numrows=mysql_num_rows($result1);
	$fetch= mysql_fetch_array($result1);

	
	if($numrows>0){
	$dbirth=$fetch[dbirth];
	$age = calcage($dbirth);
	
	?>

<form action="service.php" method="post" name="sel" id="sel"  onsubmit="JavaScript:return fncSubmit();">
  <table width="50%" border="0" align="Center" cellpadding="2" cellspacing="2">
        <tr>
          <td colspan="2"><table width="100%"  border="0" align="center">
            <tr>
              <td colspan="4" align="center" bgcolor="#E7E7E7" class="table_font1">ข้อมูลผู้ป่วย</td>
            </tr>
            <tr>
              <td    align="right" bgcolor="#E7E7E7" class="table_font1">HN :</td>
              <td ><?=$fetch['hn'];?></td>
              <td bgcolor="#E7E7E7" class="table_font1" >สิทธิ</td>
              <td  ><?=$fetch['ptright'];?></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#E7E7E7" class="table_font1">ชื่อ - สกุล :</td>
              <td colspan="3"><?=$fetch['yot'].$fetch['name'].' '.$fetch['surname'];?></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#E7E7E7" class="table_font1">อายุ:</td>
              <td colspan="3"><?=$age;?></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2" align="center" bgcolor="#E4E3E3" class="table_font1">กรุณากรอกข้อมูล</td>
      </tr>
        <tr>
          <td align="right" class="table_font1">วันที่รับบริการ:</td>
          <td>
		  	<input name="date1" type="text" class="table_font2" id="date1"  value="<?=$dateN;?>" size="15"/> 
			  <a href="javascript: void(0);" onclick="window.open('select_opday.php?hn=<?=$hn;?>','test','width=1024,height=300,status=1')">เลือกวันที่ย้อนหลังตามวันที่มารับบริการ</a>
		  </td>
      </tr>
        <tr>
          <td align="right" class="table_font1">วัคซีนที่ฉีด :</td>
          <td><font id="vaccine"  class="forntsarabun">
          <select name='vaccine' onChange="dochange('vaccine_detail', this.value)" class='table_font2'>

            <option value='0'>===เลือกวัคซีน===</option>
            <?php
            $result=mysql_query("select * from vaccine order by id_vac");
            while($row = mysql_fetch_array($result)){
                echo "<option value=\"$row[id_vac]\" >$row[vac_name]</option> \n" ;
            }

            ?>


          </select>
          </font></td>
      </tr>
        <tr>
          <td align="right" class="table_font1">เข็มที่ :</td>
          <td><font id="vaccine_detail"  class="forntsarabun"><select class="table_font2" ><option value='0'>=========================</option></select></font></td>
      </tr>
        <tr>
          <td align="right" class="table_font1">LotNo:</td>
          <td><input name="lotno" type="text"   class="table_font2" id="lotno" size="15" /></td>
      </tr>
        <tr>
          <td align="right" class="table_font1">วันหมดอายุ</td>
          <td> <input type="text" size="15"  name="date2"  class="table_font2"/></td>
      </tr>
        <tr>
          <td align="right" bgcolor="#99FF99" class="table_font1">LotNo2:</td>
          <td bgcolor="#99FF99"><input name="lotno2" type="text"  class="table_font2" id="lotno3" size="15" />
          * OPV</td>
      </tr>
        <tr>
          <td align="right" bgcolor="#99FF99" class="table_font1">วันหมดอายุ</td>
          <td bgcolor="#99FF99"><input type="text" size="15"  name="date3"  class="table_font2"/>
          * OPV</td>
      </tr>
        <tr>
          <td width="34%" align="right" class="table_font1">แพทย์</td>
          <td width="66%"><select name="doctor" id="doctor" class="forntsarabun">
            <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while($dbarr2= mysql_fetch_array($result)){

		if($dbarr2['name']=="MD041  วรวิทย์ วงษ์มณี"){
			
			echo "<option value='".$dbarr2['name']."' selected>".$dbarr2['name']."</option>";	
		}
		else
		{
			echo "<option value='".$dbarr2['name']."' >".$dbarr2['name']."</option>";
		}
		}
		?>
          </select></td>
      </tr>
	  <tr>
	  	<td colspan="4" align="center" bgcolor="#E7E7E7" class="table_font1">ข้อมูล43แฟ้ม</td>
	  </tr>
	  <tr>
          <td class="table_font1" style="text-align: right;">วัคซีนที่ฉีด : </td>
          <td>
            <input type="text" name="VACCINETYPE" id="VACCINETYPE" class="table_font2">
			<span id="epi198" style="position: relative;"></span>
          </td>
      </tr> 
        <tr>
          <td colspan="2" align="center"><label>
            <input name="unit" type="hidden" id="unit" value="1" />
            <input type="hidden" name="hn" value="<?=$fetch['hn'];?>" />
            <input name="button2" type="submit" class="table_font1" id="button2" value="บันทึกข้อมูล">
            <input type="hidden" name="action" value="save">
            </label></td>
      </tr>
    </table>
     
</form>
<?php
include '../includes/ajax.php';
?>
<script>
	var btnVACCINETYPE = document.getElementById("VACCINETYPE");
	btnVACCINETYPE.addEventListener('keyup', function(event) {

		var newSm = new SmHttp();
		newSm.ajax(
			'http://192.168.1.2/sm3/surasak3/43office/epi198.php', 
			{ 'word': btnVACCINETYPE.value }, 
			function(res){
				document.getElementById('epi198').innerHTML = res;

				/* https://clubmate.fi/detect-click-with-pure-javascript/ */
				var el = document.getElementsByClassName('icd10');
				for (var i=0; i < el.length; i++) {
					// Here we have the same onclick
					el.item(i).onclick = function(){

						document.getElementById('VACCINETYPE').value = this.getAttribute('data');
						document.getElementById('epi198').innerHTML = '';
					};
				}

				// ปุ่มปิด
				var btnClose = document.getElementById("btnLaborClose");
				btnClose.addEventListener('click', function(event) { 
					document.getElementById('epi198').innerHTML = '';
				});

			}
		);
	});
</script>
<?php 
}else{
	echo "<br/>";
	echo "<br/>";
	echo "<h1 align='left'>ไม่พบ HN </h1>";
}
  }

  ?>

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>