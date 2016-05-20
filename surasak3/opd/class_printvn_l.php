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


	function input_hn($hn){
		include("connect.inc");
		$this->hn = $hn;
		$this->Thaidate = date("d-m-").(date("Y")+543);
		$sql = "Select vn, kew, toborow From opday where thdatehn = '".$this->Thaidate.$this->hn."' Order by row_id DESC limit 0,1";
		$result = Mysql_Query($sql);
		list($this->vn, $this->kew, $this->toborow) = Mysql_fetch_row($result);
		
		$sql = "Select yot, name, surname, idcard, ptright, dbirth, idguard, inrxform, note From opcard where hn = '".$this->hn."'  limit 0,1";
		list($yot, $name, $surname,$this->idcard,$this->ptright, $dbirth, $this->idguard, $this->inrxform, $this->note) = Mysql_fetch_row(Mysql_Query($sql));
		$this->ptname = $yot." ".$name." ".$surname;
		$this->age = $this->calcage($dbirth);
		
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
		print "<STYLE>";
		print "A {text-decoration:none}";
		print "A IMG {border-style:none; border-width:0;}";
		print "DIV {position:absolute; z-index:25;}";
		print ".font01 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
		print ".font02 { COLOR:000000;FONT-SIZE:21PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
		print ".font03 { COLOR:000000;FONT-SIZE:22PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
		print ".font04 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
		print ".font05 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
		print "</STYLE>";
		
		print "<center>";
		print "<font style='line-height:24px;font-size: 18px;' face='Angsana New' >ใบติด OPDCARD</font><br>";
		print "<font style='line-height:24px;font-size: 20px;' face='Angsana New' >".date("d-m-").(date("Y")+543)." เวลา  ".date("G:i:s")."</font><br>";
		print "<font  style='line-height:24px;font-size: 22px;' face='Angsana New' ><b><u>".$this->toborow."</u></b></font><br>";
		print "<font style='line-height:24px;font-size: 32px;' face='Angsana New' ><b>VN:&nbsp; ".$this->vn." </b>&nbsp;&nbsp; ".$this->kew."</font>";
		print "<font style='line-height:24px;font-size: 18px;' face='Angsana New' ></font><br>";
		print "<font style='line-height:35px;font-size: 22px;' face='Angsana New' ><b>ชื่อ&nbsp;".$this->ptname."</b></font><br>";
		print "<font style='line-height:24px;font-size: 28px;' face='Angsana New' ><b>HN: &nbsp;".$this->hn."</b></font><br>";
		print "<font style='line-height:24px;font-size: 20px;' face='Angsana New' >อายุ &nbsp; ".$this->age."</font><br>";
		if(trim($this->idguard) != "") 
	    	print "<font style='line-height:24px;font-size: 17px;' face='Angsana New' >".$this->idguard."</font><br>";
		print "<font style='line-height:24px;font-size: 20px;' face='Angsana New'  ><b>สิทธิ :&nbsp; ".$this->ptright."</b></font><br>";
		print "<font style='line-height:24px;font-size: 18px;' face='Angsana New' >บัตร ปชช: &nbsp; ".$this->idcard."</font><br>";
		print "<font style='line-height:24px;font-size: 16px;' face='Angsana New' >หมายเหตุ ".$this->note."</font><BR>";
		print "<img src = \"printbcpha.php?cHn=".$this->hn."\"><BR>";
		print "<font face='Angsana New' style='font-size: 18px;' >".$this->inrxform."&nbsp;&nbsp;".$this->drugreact."</font><BR>";
		print "</center>";
	}
}
?>