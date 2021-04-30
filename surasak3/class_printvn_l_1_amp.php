<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<?php

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
				$pAge="$ageY ปี"; //$ageM เดือน
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
?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="1080" valign="bottom">&nbsp;</td>
    <td width="421" valign="bottom"><strong>&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="1111" align="center"><div style="margin-top:10px;"><? echo "<img src ='printbcpha.php?cHn=".$this->hn."'>"; ?></div></td>
    <td width="112">23</td>
    <td width="170">เมษายน</td>
    <td width="88">2564</td>
  </tr>
</table>
<?
	}
}
?>