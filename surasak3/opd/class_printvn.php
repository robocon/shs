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
	var $clinic;
	var $doctor;
	var $room;	
	var $noteall;
	
	function set_clinic($xxx){
		$this->clinic = $xxx;
	}

	function set_doctor($xxx){
		$this->doctor = $xxx;
	}
	
	function set_room($xxx){
		$this->room = $xxx;
	}	
	
	function set_toborow($xxx){
		$this->toborow = $xxx;
	}

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
				$pAge="$ageY ��";
			}else{
				$pAge="$ageY �� $ageM ��͹";
			}
		return $pAge;
	}


	function input_hn($hn){
		include("connect.inc");
		$this->hn = $hn;
		$this->Thaidate = date("d-m-").(date("Y")+543);
		$sql = "Select vn, kew, toborow, clinic, doctor From opday where thdatehn = '".$this->Thaidate.$this->hn."' Order by row_id DESC limit 0,1";
		$result = Mysql_Query($sql);
		list($this->vn, $this->kew, $this->toborow, $this->clinic, $this->doctor) = Mysql_fetch_row($result);
		
		$sql = "Select yot, name, surname, idcard, ptright, dbirth, idguard, inrxform, note, ptrcode, hospcode  From opcard where hn = '".$this->hn."'  limit 0,1";
		list($yot, $name, $surname,$this->idcard,$this->ptright, $dbirth, $this->idguard, $this->inrxform, $this->note,$this->ptrcode,$this->hospcode) = Mysql_fetch_row(Mysql_Query($sql));
		$this->ptname = $yot." ".$name." ".$surname;
		$this->noteall = $this->note." ".$this->ptrcode." ".$this->hospcode;
		$this->age = $this->calcage($dbirth);
		
		if( $this->inrxform != ""){
			
			if($this->inrxform == "�����¡��������§��ͧ���Ѻ��éմ�Ѥ�չ��ͧ�ѹ�ä����Ѵ�˭�(���)")
				$this->inrxform .= "<BR>Influza Vaccine 0.5 ml. IM";

			$this->inrxform = "<table width='210' border='0'><TR><TD align='center'>".$this->inrxform;
			$this->inrxform .= "<TD></TR></Table>";
		}
		
		$sql = "Select tradname, advreact  From drugreact where hn = '".$this->hn."' ";
		$result = Mysql_Query($sql);
		
		if(Mysql_num_rows($result) > 0){
			$this->drugreact = "<Table width='210' border='0'><TR><TD colspan='2'><U><B>����</B></U></TD></TR>";
				while($arr = Mysql_fetch_assoc($result)){
					$this->drugreact .= "<TR><TD>��:".$arr["tradname"]."<BR>�ҡ��:".$arr["advreact"]."</TD></TR>";
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
		print "<font style='line-height:24px; font-size: 18px;' face='Angsana New' >㺵�Ǩ�ä �ç��Һ�Ť�������ѡ��������</font><br>";
		print "<font style='line-height:24px;font-size: 20px;' face='Angsana New' >".date("d-m-").(date("Y")+543)." ����  ".date("G:i:s")."</font><br>";
		print "<font style='line-height:24px;font-size: 22px;' face='Angsana New' ><b><u>".$this->toborow."</u></b></font><br>";
		print "<font style='line-height:24px;font-size: 32px;' face='Angsana New' ><b>VN:&nbsp; ".$this->vn." </b>&nbsp;&nbsp; ".$this->kew."</font>";
		print "<font style='line-height:24px;font-size: 20px;' face='Angsana New' ></font><br>";
		print "<font style='line-height:35px;font-size: 22px;' face='Angsana New' ><b>����&nbsp;".$this->ptname."</b></font><br>";
		print "<font style='line-height:24px;font-size: 28px;' face='Angsana New' ><b>HN: &nbsp;".$this->hn."</b></font><br>";
		print "<font style='line-height:24px;font-size: 20px;' face='Angsana New' >���� &nbsp; ".$this->age."</font><br>";
		
		if(trim($this->idguard) != "") 
	    	print "<font style='line-height:24px;font-size: 17px;' face='Angsana New' >".$this->idguard."</font><br>";
		
		print "<font style='line-height:24px;font-size: 20px;' face='Angsana New' ><b>�Է�� :&nbsp; ".$this->ptright."</b></font><br>";
		print "<font style='line-height:24px;font-size: 18px;' face='Angsana New' >�ѵ� ���: &nbsp; ".$this->idcard."</font><br>";
		print "<font  style='line-height:24px;font-size: 16px;' face='Angsana New' >".$this->noteall."</font><br>";
		print "<img src = \"printbcpha.php?cHn=".$this->hn."\"><br>";
		
		if($this->clinic != "")
			print "<font face='Angsana New' style='font-size: 20px;' >��Թԡ : ".$this->clinic."</font><br>";
		
		if($this->doctor != "")
			print "<font face='Angsana New' style='font-size: 20px;' >ᾷ�� : ".$this->doctor."</font><BR>";
		
		if($this->room != "")
			print "<font face='Angsana New' style='font-size: 20px;' >��ͧ��Ǩ : ".$this->room."</font><BR>";		
		
		print "<font face='Angsana New' style='font-size: 20px;' >".$this->inrxform."&nbsp;&nbsp;".$this->drugreact."</font><BR>";
		print "<font style='line-height:24px;font-size: 17px;' face='Angsana New' >ᾷ��..............................................</font><BR>";
		print "<font style='line-height:24px;font-size: 22px;' face='Angsana New' ><u><INPUT TYPE=\"checkbox\" NAME=\"\" readonly> �Ѻ����蹷���ͧ�����Ţ 6</u></font><BR>";
		print "<TABLE style='font-size: 16px; font-family: Angsana New;' border='0' width='200'>
			<TR>
				<TD align='right' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly></TD>
				<TD>LAB............</TD>
				<TD align='right' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly></TD>
				<TD colspan='4'>XRAY...........</TD>
			</TR>
						<TR>
				<TD align='right' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly></TD>
				<TD>OPD................</TD>
				<TD align='right' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly></TD>
				<TD colspan='4'>ER................</TD>
			</TR>
						<TR>
				<TD align='right' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly></TD>
				<TD>�ѧ���...............</TD>
				<TD align='right' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly></TD>
				<TD colspan='4'>PT................</TD>
			</TR>
					</TR>
						<TR>
				<TD align='right' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly></TD>
				<TD>EKG.............</TD>
				<TD align='right' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly></TD>
				<TD colspan='4'>����................</TD>
			</TR>
			<TR>
				<TD align='right' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly></TD>
				<TD>..........................................</TD>
				<TD align='right' ></TD>
				<TD colspan='4'></TD>
			</TR>
			</TABLE>
		";
		print "</center>";
	}
}


class printkew extends printvn{
	
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
		print "<font face='Angsana New' size= 3 ><B>��� ".$this->kew."</B><br>";
		print "<font style='line-height:35px;' face='Angsana New' size= 4 ><b>����&nbsp;".$this->ptname."&nbsp;&nbsp;HN: &nbsp;".$this->hn."</b><br>";
		print "<font style='line-height:24px;' face='Angsana New' size= 3 ><b>�Է�� :&nbsp; ".substr($this->ptright,3)."</b><br>";
		if($this->clinic != "")
			print "<font face='Angsana New' size= 3 >��Թԡ : ".substr($this->clinic,3)."<BR>";
		if($this->doctor != "")
			print "<font face='Angsana New' size= 3 >ᾷ�� : ".substr($this->doctor,5)."<BR>";
		if($this->room != "")
			print "<font face='Angsana New' size= 3 >��ͧ��Ǩ : ".substr($this->doctor,5)."<BR>";			
	}
}

?>