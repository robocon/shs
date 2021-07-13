<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 24px;
}
-->
</style>
<?php

	function DateThai($strDate)
	{
		$strMonth= date("n",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strMonthThai";
	}

	$strDate = date('m');



class printvn{
	
	var $vn;
	var $hn;
	var $ptname;
	var $ptright;
	var $idcard;
	var $kew;
	var $toborow;
	var $age;
	var $idguard;
	var $inrxform;
	var $note;
	var $drugreact;
	var $Thaidate;
	var $txt_dbirth;
	
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

	function calcage2($birth){
		$yy=substr($birth,0,4);
		$mm=substr($birth,5,2);
		$dd=substr($birth,8,2);
		$sum = "$dd/$mm/$yy";
		
		return $sum;
	}


	function input_hn($hn){
		include("connect.inc");
		$this->hn = $hn;
		$this->Thaidate = date("d-m-").(date("Y")+543);
		$sql = "Select vn, kew, toborow From opday where thdatehn = '".$this->Thaidate.$this->hn."' Order by row_id DESC limit 0,1";
		$result = Mysql_Query($sql);
		list($this->vn, $this->kew, $this->toborow) = Mysql_fetch_row($result);
		
		$sql = "Select yot, name, surname, idcard, ptright, dbirth, idguard, inrxform, note,address,tambol,ampur,changwat,phone,dbirth From opcard where hn = '".$this->hn."'  limit 0,1";
		list($yot, $name, $surname,$this->idcard,$this->ptright, $dbirth, $this->idguard, $this->inrxform, $this->note, $this->address, $this->tambol, $this->ampur, $this->changwat, $this->phone, $this->dbirth) = Mysql_fetch_row(Mysql_Query($sql));
		$this->ptname = $yot." ".$name." ".$surname;
		$this->age = $this->calcage($dbirth);
		$this->txt_dbirth = $this->calcage2($dbirth);
		 

		if( $this->inrxform != ""){
			
			if($this->inrxform == "ผู้ป่วยกลุ่มเสี่ยงต้องได้รับการฉีดวัคซีนป้องกันโรคไข้หวัดใหญ่(ฟรี)")
				$this->inrxform .= "<BR>Influza Vaccine 0.5 ml. IM";

			$this->inrxform = "<table width='210' border='0'><TR><TD align='center'>".$this->inrxform;
			$this->inrxform .= "<TD></TR></Table>";
		}
		
		$sql = "Select tradname, advreact  From drugreact where hn = '".$this->hn."' ";
		$result = Mysql_Query($sql);
		
		if(Mysql_num_rows($result) > 0){
			$this->drugreact = "<Table width='210' border='0'><TR><TD colspan='2'><U><B>แพ้ยา</B></U></TD></TR>";
				while($arr = Mysql_fetch_assoc($result)){
					$this->drugreact .= "<TR><TD>ยา:".$arr["tradname"]."<BR>อาการ:".$arr["advreact"]."</TD></TR>";
				}
			$this->drugreact .= "</Table>";
			}

 
		include("unconnect.inc");
	}

	function outputprint(){

		$full_month_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');
		$m = date('m');
?>	
<center><img src='opd/consentform-head.png'></center> 

<table width="900" border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
    <td width="431" align='left' valign="bottom"><? echo "<img src ='printbcpha.php?cHn=".$this->hn."' width='250' height='80'>"; ?> <span style="margin-left:30px;"><font size='5'><b><? echo $this->idcard; ?></b></font></span></td>
    <td width="449" align='right' valign="top"><font size='5'>
	<b>หน่วยบริการ</b> โรงพยาบาลค่ายสุรศักดิ์มนตรี <br />	       
	<? echo "<b>วันที่</b> ".date('d')." <b>เดือน</b> ".$full_month_th[$m]." <b>พ.ศ</b> ".(date('Y')+543); ?></font>
   </td>
</tr> 
</table>
<table width="900" border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
    <td width="450" align='left'><font size='5'><b>ชื่อ-นามสกุล </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $this->ptname; ?></font>   </td>
   <td width="450" align='right'><font size='5'>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<b>อายุ </b><? echo $this->age; ?>
	&nbsp;&nbsp;&nbsp;
	<b>วัน/เดือน/ปีเกิด </b><? echo $this->txt_dbirth; ?></font>
   </td>
</tr>
	<? echo $txt_idcard;
	include_once "includes/JSON.php";
	$url = file_get_contents("http://192.168.129.20/moph/test_immunization_target.php?idcard=$this->idcard");
	$json = new Services_JSON();
	$data = $json->decode($url);

	$pt_address = $data->result->vaccine_certificate[0]->patient_address;
	$pt_address = iconv("UTF-8", "TIS-620", $pt_address);

	$pt_phone = $data->result->person->mobile_phone;
	$pt_phone = iconv("UTF-8", "TIS-620", $pt_phone);
		 
	?>
<!--tr>
    <td width="400" align='left' colspan="2"><font size='5'>
	<b>เบอร์โทรศัพท์ </b>&nbsp;&nbsp;<? echo $pt_phone; ?></font>
	<span style="margin-left:25px;"><font size='5'>
	<b>ที่อยู่ </b>
	<? echo $pt_address; ?>
</font></span>
   </td>
</tr--> 
</table>
<br />
<center><img src='opd/consentform-detail.png' height="850" width="900">
</center>
<!--<center><img src='opd/covid-body.PNG' width='700'></center>-->
<?
	}
}
?>