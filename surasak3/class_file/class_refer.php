<?php


Class refer{

	
	var $hn;
	var $an;
	var $clinic;
	var $referh;
	var $refertype;
	var $dateopd;
    var $name;
    var $sname;
    var $idcard;
    var $pttype;
    var $diag;
    var $ptnote;
    var $exrefer;
    var $refercar;
    var $office;
    var $doctor;
	var $id;
	var $ward;

	var $age;
	var $type_wound;
	var $time_refer;
	var $problem_refer;
	var $list_type_patient;
	var $organ;
	var $maintenance;
	
	var $doc_refer;
 	var  $nurse;
 	var  $assistant_nurse;
 	var  $estimate;
 	var  $no_estimate;
 	var  $cradle ;
 	var  $doc_txt;
 	var  $suggestion;
	var  $targe;
	
	function   set_doc_refer($val){$this->doc_refer = $val;}
	function   set_nurse($val){$this->nurse = $val;}
 	function   set_assistant_nurse($val){$this->assistant_nurse = $val;}
 	function   set_estimate($val){$this->estimate = $val;}
 	function   set_no_estimate($val){$this->no_estimate = $val;}
 	function   set_cradle ($val){$this->cradle = $val;}
 	function   set_doc_txt($val){$this->doc_txt = $val;}
 	function   set_suggestion($val){$this->suggestion = $val;}
	function   set_targe($val){$this->targe = $val;}


	function setorgan($val){

		$this->organ = $val;
	}

	function setmaintenance($val){

		$this->maintenance = $val;
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
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

	return $pAge;
	}
	
	function setlist_type_patient($val){
		
		$this->list_type_patient = $val;

	}

	function sethn($val){ $this->hn = $val; 
		
		$sql = "Select name, surname, idcard, dbirth From opcard where hn = '".$val."' Limit 1 ";
		$result = Mysql_Query($sql);
		$arr = Mysql_fetch_assoc($result);
		
		$this->setname($arr["name"]);
		$this->setsname($arr["surname"]);
		$this->setidcard($arr["idcard"]);
		$dbirth = $this->calcage($arr["dbirth"]);
		$this->setage($dbirth);
	
	}
	function setan($val){ $this->an = $val; }

	function setclinic($val){ $this->clinic = $val; }
	function setreferh($val,$val2=""){ 
		if($val2 != ""){
			$this->referh = $val2;
		}else{
			$this->referh = "10672 ลำปาง"; 
		
			switch($val){
			
				case "โรงพยาบาลลำปาง" : $this->referh = "10672 ลำปาง"; break;
				case "รพห้างฉัตร" : $this->referh = "11156 ห้างฉัตร"; break;
				case "รพ. เขลางค์" : $this->referh = "12003 เขลางค์"; break;

			}
		}
		
	}

	function setrefertype($val){ $this->refertype = $val; }
	function setdateopd($val, $val2=''){ $this->dateopd = $val; 
		
		if($val2 != ""){
			$date = explode("-",$val2);
			$sql = "Select clinic From opday where thdatehn = '".$date[2]."-".$date[1]."-".$date[0].$this->hn."' limit 1";
			$result = Mysql_Query($sql);
			$arr = Mysql_fetch_assoc($result);
			$this->setclinic($arr["clinic"]);
		}
	}
	function setname($val){ $this->name = $val; }
	function setsname($val){ $this->sname = $val; }
	function setidcard($val){ $this->idcard = $val; }
	function setpttype($val,$val2=""){ if($val == ""){$this->pttype = $val2;}else{$this->pttype = $val;} }
	function setdiag($val){ $this->diag = $val; }
	function setptnote($val){ $this->ptnote = $val; }
	function setexrefer($val,$val2){ if($val2 != ""){$this->exrefer = $val2;}else{$this->exrefer = $val;} }
	function setrefercar($val){ 

		switch($val){
			case 'ไปเอง':	$this->refercar = "02 ผู้ป่วยเดินทางเอง"; break;
			default :	$this->refercar = "01 รถพยาบาลไปรับ/ส่ง"; break;
		}


		}
	function setoffice($val){ $this->office = $val; }
	function setdoctor($val){ $this->doctor = $val; }

	function setid($val){ $this->id = $val; }
	function setward($val){ $this->ward = $val; 

		if(substr($val,0,4) == "Ward"){
			
			$sql = "Select row_id From ipcard Where an = '".$this->an."' Order by row_id DESC limit 1";
			$result = Mysql_Query($sql);
			list($idno) = Mysql_fetch_row($result);
			$this->setid($idno);
		
		}
		
	}
	
	function setage($val){ $this->age = $val; }
	function settype_woud($val){ $this->type_wound = $val; }
	function settime_refer($val){ $this->time_refer = $val; }
	function setproblem_refer($val){$this->problem_refer = $val;}


	function inserttb(){
		$query = "SELECT title,runno,prefix FROM runno WHERE title = 'referno'";
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
		
			$sReferno=$row->runno;
			$sPrefix=$row->prefix;
			$sReferno++;
			$query ="UPDATE runno SET runno = ".$sReferno." WHERE title='referno'";
			$result = mysql_query($query) or die("Query failed");
			$sReferno=$sPrefix."".$sReferno;
			
		$sql = "INSERT INTO `smdb`.`refer` (`hn` ,`an` ,`clinic` ,`referh` ,`refertype` ,`dateopd` ,`name` ,`sname` ,`idcard` ,`pttype` ,`diag` ,`ptnote` ,`exrefer` ,`refercar` ,`office` ,`doctor`,`ward`,`trauma_id` ,`age`,`type_wound`,`time_refer`,`problem_refer`, `list_type_patient`, `organ`, `maintenance`,`doc_refer` ,`nurse` ,`assistant_nurse` ,`estimate` ,`no_estimate` ,`cradle` ,`doc_txt` ,`suggestion` ,`officer` ,`refer_runno`,	`target_refer`  )VALUES ('".$this->hn."', '".$this->an."', '".$this->clinic."', '".$this->referh."', '".$this->refertype."', '".$this->dateopd."', '".$this->name."', '".$this->sname."', '".$this->idcard."', '".$this->pttype."', '".$this->diag."', '".$this->ptnote."', '".$this->exrefer."', '".$this->refercar."', '".$this->office."', '".$this->doctor."', '".$this->ward."', '".$this->id."' ,'".$this->age."','".$this->type_wound."','".$this->time_refer."', '".$this->problem_refer."','".$this->list_type_patient."', '".$this->organ."', '".$this->maintenance."', '".$this->doc_refer."', '".$this->nurse."', '".$this->assistant_nurse."', '".$this->estimate."', '".$this->no_estimate."', '".$this->cradle."', '".$this->doc_txt."', '".$this->suggestion."', '".$_SESSION["sOfficer"]."', '".$sReferno."', '".$this->targe."');";
		Mysql_Query($sql) or die(Mysql_Error());


	}

	function updatetb(){
		

		$sql = "Select count(hn) From refer Where trauma_id = '".$this->id."' limit 1 ";
		$result = Mysql_Query($sql);
		$arr = Mysql_fetch_row($result);


		if($arr[0] > 0){
		$sql = "Update `refer` set `hn` = '".$this->hn."' ,`an` = '".$this->an."' ,`clinic` = '".$this->clinic."' ,`referh` = '".$this->referh."' ,`refertype` = '".$this->refertype."' ,`dateopd` = '".$this->dateopd."' ,`name` = '".$this->name."' ,`sname` = '".$this->sname."' ,`idcard` = '".$this->idcard."' ,`pttype` = '".$this->pttype."' ,`diag` = '".$this->diag."' ,`ptnote` = '".$this->ptnote."' ,`exrefer` = '".$this->exrefer."' ,`refercar` = '".$this->refercar."' ,`office` = '".$this->office."' ,`doctor` = '".$this->doctor."', ward = '".$this->ward."', trauma_id = '".$this->id."', age='".$this->age."',type_wound='".$this->type_wound."',time_refer='".$this->time_refer."', problem_refer = '".$this->problem_refer."', `officer` = '".$_SESSION["sOfficer"]."', `target_refer` = '".$this->targe."'  Where trauma_id = '".$this->id."' AND ward = '".$this->ward."' ";

		Mysql_Query($sql) or die(Mysql_Error());
		}else{
			$this->inserttb();
		}


	}
















}

?>