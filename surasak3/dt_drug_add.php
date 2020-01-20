<?php
session_start();

include("connect.inc");
function jschars($str)
{
	$str = str_replace("'", " ", $str);
	$str = str_replace("\\\\", "\\\\", $str);
	$str = str_replace("\"", "\\\"", $str);
	$str = str_replace("'", "\'", $str);
	$str = str_replace("\r\n", "\\n", $str);
	$str = str_replace("\r", "\\n", $str);
	$str = str_replace("\n", "\\n", $str);
	$str = str_replace("\t", "\\t", $str);
	$str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
	$str = str_replace(">", "\\x3E", $str);
	$str = str_replace(",", "\,", $str);
    return $str;
}
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$Thidate2 = date("d-m-").(date("Y")+543).date(" H:i:s");
	 
	if(isset($_SESSION["cancle_row_id"]) && $_SESSION["cancle_row_id"] != ""){

		$sql = "Update dphardep set dr_cancle='1' where hn='".$_SESSION["hn_now"]."' AND row_id = '".$_SESSION["cancle_row_id"]."' ";
		$result = Mysql_Query($sql);
		$_SESSION["cancle_row_id"] = "";
		session_unregister("cancle_row_id");
	}
	
	$count = count($_SESSION["list_drugcode"]);

	if($sIdname != "HDณรงค์" && $sIdname != "HDเลือก"){


	/*for($i=0;$i<$count;$i++){
		$drugcode = $_SESSION["list_drugcode"][$i];
		if( ($drugcode[0] == "0" || $drugcode[0] == "2") && !(ord($drugcode[1]) >=48 && ord($drugcode[1]) <=57) ){
			
			$sql = "Select part, salepri From druglst where drugcode = 'INJ' limit 1";
			list($part, $salepri) = mysql_fetch_row(mysql_query($sql));
			$_POST[$part] = $_POST[$part]+$salepri;
			$_POST["totalitem"]++;
			$_POST["Netprice"] = $_POST["Netprice"]+$salepri;
			array_push($_SESSION["list_drugcode"],"INJ");
				array_push($_SESSION["list_drugamount"],"1");
				array_push($_SESSION["list_drugslip"],"");
				array_push($_SESSION["list_drug_inject_amount"],"");
				array_push($_SESSION["list_drug_inject_unit"],"");
				array_push($_SESSION["list_drug_inject_amount2"],"");
				array_push($_SESSION["list_drug_inject_unit2"],"");
				array_push($_SESSION["list_drug_inject_time"],"");
				array_push($_SESSION["list_drug_inject_slip"],"");
				array_push($_SESSION["list_drug_inject_type"],"");
				array_push($_SESSION["list_drug_inject_etc"],"");
				array_push($_SESSION["list_drug_reason"],"");
		}
	}*/
	}
$count = count($_SESSION["list_drugcode"]);
	// ออกคิวให้ผู้ป่วยรับยา

	if($count <=4){
		$field = "pharx_m";
	}else{
		$field = "pharx_l";
	}
	$sql = "Select runno, date_format(startday,'%d-%m-%Y') as dformat, prefix From runno where title = '".$field."' limit 1";
	list($kew,$date,$prefix) = Mysql_fetch_row(Mysql_Query($sql));
	

	if($date == date("d-m-Y")){
		
		$kew = $kew+1;
		$update = "";
		
	}else{
		
		$kew = 1;
		$update = ", startday= '".date("Y-m-d H:i:s")."' ";
		
	}
	
	$sql = "update runno set runno=".$kew." ".$update." where title = '".$field."' limit 1";
	$result = Mysql_Query($sql);
	$kew = $prefix.sprintf("%03d",$kew);
	// จบออกคิวให้ผู้ป่วยรับยา
	
	$Ptname = $_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"];

	if(!empty($_POST["clinic150"])){//     คิดค่าบริการคลินิกนอกเวลา
		
		$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart' ";
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $chktranx =$row->runno;
    $chktranx++;

    $query ="UPDATE runno SET runno = $chktranx WHERE title='depart' ";
    $result = mysql_query($query) or die("Query failed");
		
	$sql = "Select code, price,  yprice,  nprice, detail, depart, part From labcare where code = 'clinic200' limit 1 ";
	list($c,$p,$y,$n, $d, $dp, $pa) = mysql_fetch_row(mysql_query($sql));
	
	$p = $y = $n = $_POST["clinic150"];
	$y = 0;
	 $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright)VALUES('".$chktranx."','".$Thidate."','".$Ptname."','".$_SESSION["hn_now"]."','','".$_SESSION["dt_doctor"]."','".$dp."','1','ค่าบริการทางการแพทย์', '".$p."','".$y."','".$n."','','".$_SESSION["sOfficer"]."','".jschars($_SESSION["dt_diag"])."','0','".$_SESSION["vn_now"]."','".$_SESSION["ptright_now"]."');";


	$result = mysql_query($query) or die("Query failed,cannot insert into depart");
	$idno=mysql_insert_id();

	 $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$Thidate."','".$_SESSION["hn_now"]."','','".$Ptname."','".$_SESSION["dt_doctor"]."','1','clinic150','".$d."','1', '".$p."','".$y."','".$n."','".$dp."','".$pa."','".$idno."','".$_SESSION["ptright_now"]."');";

    
	$result = mysql_query($query) or die("Query failed,cannot insert into patdata");

	}

	$pricetype["DDL1"] = 0;
	$pricetype["DDY1"] = 0;
	$pricetype["DPY1"] = 0;
	$pricetype["DSY1"] = 0;
	$pricetype["DDN1"] = 0;
	$pricetype["DSN1"] = 0;
	$pricetype["DPN1"] = 0;
	$total_item=0;
	$Netprice = 0;
	
	for($i=0;$i<$count;$i++){
		
		
		$sql = "Select tradname, unit, stock, salepri, freepri, part, medical_sup_free  From druglst  where drugcode = '".$_SESSION["list_drugcode"][$i]."' limit 1";
		$result = Mysql_Query($sql);
		list($drugname,$unit, $stock, $salepri, $freepri, $part, $medical_sup_free) = Mysql_fetch_row($result);
				
		if($_SESSION["list_drugamount"][$i] > 0){
			if($part == "DPY"){
				if($freepri > $salepri)
					$freepri = $salepri;
					
					$pricetype["DPY1"]= $pricetype["DPY1"] + ($freepri * $_SESSION["list_drugamount"][$i]); 
					$pricetype["DPN1"]=$pricetype["DPN1"] + (($salepri - $freepri) * $_SESSION["list_drugamount"][$i]);

			}else if($part == "DSY"){
						
				if($freepri > $salepri)
					$freepri = $salepri;

				if($medical_sup_free ==0){
					$pricetype["DSN1"]=$pricetype["DSN1"] + ($salepri * $_SESSION["list_drugamount"][$i]);
				}else{
					$pricetype["DSY1"]= $pricetype["DSY1"] + ($freepri * $_SESSION["list_drugamount"][$i]); 
					$pricetype["DSN1"]=$pricetype["DSN1"] + (($salepri - $freepri) * $_SESSION["list_drugamount"][$i]);
				}

			}else{
				$pricetype[$part."1"] = $pricetype[$part."1"] + ($salepri * $_SESSION["list_drugamount"][$i]);
			}

			$total_price = $total_price+ ($salepri * $_SESSION["list_drugamount"][$i]);
			if($_SESSION["list_drugcode"][$i] != "INJ");
				$total_item++;
			$Netprice = 	$Netprice + ($salepri * $_SESSION["list_drugamount"][$i]);
		}
	
	
		if($part == "DDY"){
			$countddys++;
			////เหตุผลใหม่/////
			if(isset($_POST['reason'.$countddys])){
				$_SESSION['list_drug_reason'][$i] = $_POST['reason'.$countddys];
			}
			////เหตุผลใหม่/////
			if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F"){
				$sql = "Select tradname, part, salepri, freepri, unit  From druglst  where drugcode = '".$_SESSION["list_drugcode"][$i]."' limit 1";
				$result = Mysql_Query($sql);
				list($tradname, $part, $salepri, $freepri, $unit ) = Mysql_fetch_row($result);
			
				$pricetype["DDN1"]+=($salepri * $_SESSION["list_drugamount"][$i]);//บวกราคาใหม่
				$pricetype["DDY1"]-=($salepri * $_SESSION["list_drugamount"][$i]);//ลบราคาเก่าออก
				
			}
		}
			
		
	}
	
	$sql = "INSERT INTO dphardep(chktranx,date,ptname,hn,price,doctor,item,idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright,whokey,kew)VALUES('".$nRunno."','".$Thidate."','".$Ptname."','".$_SESSION["hn_now"]."','".$Netprice."','".$_SESSION["dt_doctor"]."','".$_POST["totalitem"]."','".$_SESSION["sOfficer"]."','".jschars($_SESSION["dt_diag"])."','".$pricetype["DDL1"]."','".$pricetype["DDY1"]."','".$pricetype["DDN1"]."','".$pricetype["DPY1"]."','".$pricetype["DPN1"]."','".$pricetype["DSY1"]."','".$pricetype["DSN1"]."','".$_SESSION["vn_now"]."','".$_SESSION["ptright_now"]."','DR','".$kew."');";
	//echo "<!-- ".$sql." -->";
	$result = Mysql_Query($sql);
	if($result){ $insert1 = true; $idno=mysql_insert_id();}else{ $insert1 = false; }
	

	$commar = "";

	
	//$_SESSION["dt_drugstk"] = "<font style=\"font-family:'MS Sans Serif'; font-size:12px\"  >&nbsp;&nbsp;&nbsp;&nbsp&nbsp;".$Thidate2.";&nbsp;&nbsp;HN:".$_SESSION["hn_now"].", &nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;".$_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"]."&nbsp;&nbsp;โรค ".$_SESSION["dt_diag"]."<BR>";
	
	if( !empty($_SESSION["dt_drugstk"]) ){
		$_SESSION["dt_drugstk"] .= "<DIV style=\"page-break-after:always\"></DIV>";
	}

	$_SESSION["dt_drugstk"] .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" class=\"test_sticker_line\">
	<TR>
		<TD colspan=\"3\"><font style=\"font-family:'MS Sans Serif'; font-size:12px\"  >&nbsp;&nbsp;&nbsp;&nbsp&nbsp;".$Thidate2.";&nbsp;&nbsp;HN:".$_SESSION["hn_now"].",&nbsp;VN:".$_SESSION["vn_now"].",&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;".$_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"]."&nbsp;&nbsp;โรค ".$_SESSION["dt_diag"]."<br>OTHER: ".$_SESSION['stk_diag_other']."</TD>
	</TR>";

/*$dt_hn = date("d-m-").(date("Y")+543).$_SESSION["hn_now"];
$sql = "Select ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor   From opd where thdatehn = '".$dt_hn."' limit 1 ";
$result_dt_hn = Mysql_Query($sql);
if(mysql_num_rows($result_dt_hn) > 0){


list($ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor) = Mysql_fetch_row($result_dt_hn);
$_SESSION["dt_drugstk"] .= "
  <tr>
    <td colspan=\"3\" style=\"line-height:12px;font-family:'MS Sans Serif';font-size:10px;\">T <U>$temperature</U>&nbsp;C&deg; , P <u>$pause</u>&nbsp;ครั้ง/นาที , R <u>$rate</u>&nbsp;ครั้ง/นาที , BP <u>$bp1 / $bp2</u>&nbsp;mmHg</td>
  </tr>
  <tr>
    <td colspan=\"3\" style=\"line-height:12px;font-family:'MS Sans Serif';font-size:10px;\">นน. <u>$weight</u>&nbsp; กก. , ส่วนสูง. <u>$height</u>&nbsp;ซม.</td>
  </tr>
  <tr>
    <td colspan=\"3\" style=\"line-height:12px;font-family:'MS Sans Serif';font-size:10px;\">โรคประจำตัว <u>$congenital_disease</u> แพ้ยา <u>".($drugreact==0?"ผู้ป่วยไม่แพ้ยา":"ผู้ป่วยแพ้ยา")."&nbsp;&nbsp;".($_SESSION["list_drugreact"])."</u></td>
  </tr>
  <tr>
    <td colspan=\"3\" style=\"line-height:12px;font-family:'MS Sans Serif';font-size:10px;\">ลักษณะ <u>$type</u>&nbsp;&nbsp;อาการ <u>$organ</u></td>
  </tr>";
}*/
	
	$query = "INSERT INTO ddrugrx(date,hn,drugcode,tradname,amount,price,item,slcode,part,idno, salepri, freepri, drug_inject_amount,drug_inject_unit, drug_inject_amount2,drug_inject_unit2,drug_inject_time,drug_inject_slip, drug_inject_type, drug_inject_etc,reason,DPY , DPN,indicator  ) VALUES";
	
	
	
$j=29;
$k1=10;
$k2=$k1+150;
$k3=$k2+50;

	for($i=0;$i<$count;$i++){
		
		$sql = "Select tradname, part, salepri, freepri, unit  From druglst  where drugcode = '".$_SESSION["list_drugcode"][$i]."' limit 1";

		$result = Mysql_Query($sql);
		list($tradname, $part, $salepri, $freepri, $unit ) = Mysql_fetch_row($result);
		
		if($part == "DPY"){
			if($freepri > $salepri)
					$freepri = $salepri;
					$dg_dsy = $freepri;
					$dg_dsn = $salepri - $freepri;
			}else{
					$dg_dsy = 0;
					$dg_dsn = 0;
			}
		if(isset($_POST['ch'.$i])){
			$_SESSION['list_drug_reason'][$i] = $_POST['ch'.$i];
		}
	//	$_SESSION['list_drugamount'][$i] = $_POST['piece'.$i];
	//	$_SESSION['list_drugslip'][$i] = $_POST['act'.$i];
		
		if($part=="DDL" || $part=="DDY"){
			if(substr($_SESSION["list_drug_reason"][$i],0,1)=="F"){
				$part="DDN";
			}
		}

$chkDate=substr($Thidate,0,7);
$chkDate1=substr($Thidate,0,10);
$chkPtright=substr($_SESSION["ptright_now"],0,3);

// แก้ไขล่าสุด 14/06/59 โดย แอมป์
if($_SESSION["list_drugcode"][$i]=="4MET25"){
	if($chkPtright=="R02" || $chkPtright=="R03" || $chkPtright=="R07" || $chkPtright=="R09" || $chkPtright=="R12" || $chkPtright=="R21" || $chkPtright=="R33"){  //ยืนยันสิทธิ์โดยพี่ีเพชร จัดเก็บรายได้
	//เพิ่มสิทธิ R12 วันที่ 19/05/2559 ยืนยันโดยพี่อึ่ง หน.ประกันสังคม / 30 บาท
		$sqlb="select * from drugrx 
		where `date` like '$chkDate%' 
		and hn='".$_SESSION["hn_now"]."' 
		and drugcode='4MET25' 
		and part='DDL' 
		and amount >0";
		//echo $sqlb."<br>";
		$queryb=mysql_query($sqlb);
		$numb=mysql_num_rows($queryb);
		//echo "===>".$numb;
		if($numb < 1){  //ถ้าเดือนนี้ยังไม่ได้รับยาฟรี 1 หลอด
				$sql2="select * from ddrugrx as a 
				inner join dphardep as b 
				on a.idno=b.row_id 
				where a.`date` like '$chkDate1%' 
				and a.hn='".$_SESSION["hn_now"]."' 
				and a.drugcode='4MET25' 
				and a.amount ='1' 
				and a.part='DDL' 
				and b.dr_cancle is null";
				//echo "<br>".$sql2."<br>";
				$query2=mysql_query($sql2)or die("Query failed");
				$num2=mysql_num_rows($query2);
				//echo ">>>>".$num2;
				if($num2 < 1){  //ถ้ายังไม่มีการบันทึกข้อมูลฟรียา 4MET25 ในตาราง  ddrugrx
					if($_SESSION["list_drugamount"][$i] == 1){  //ถ้าจำนวนที่สั่งมามี 1 หลอด
						$sumbalm=$sumbalm+count($i);  //หาจำนวนแถวในการสั่งยา Balm
						
						//echo "สั่งมามากกว่า 1 หลอด $sumbalm<br>";
						if($sumbalm==1){  //สั่งยาเพียง 1 แถว
							//echo "บันทึกยาฟรีในรอบแรก <br>";						
							
							$ddlpart="DDL";
							$ddlamount=1;  //จำนวนที่เบิกได้
							$ddlprice=16.50;  //ราคาที่เบิกได้		
										
							$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$ddlamount."','".$ddlprice."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$ddlpart."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
							
								$str="select row_id,essd,nessdn from dphardep where row_id='".$idno."'";
								//echo $str;
								$strquery=mysql_query($str);
								list($rowid,$chkessd,$chknessdn)=mysql_fetch_array($strquery);
								$newessd=$chkessd+16.5;
								$newnessdn=$chknessdn-16.5;
								
								$update="update dphardep set essd='$newessd', nessdn='$newnessdn' where row_id='".$rowid."'";
								//echo "<br>".$update."<br>";
								mysql_query($update);	
							}else{ //ถ้าสั่งยามากกว่า 1 แถว
								//echo "บันทึกยาที่ต้องจ่ายเงิน";
								$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$_SESSION["list_drugamount"][$i]."','".( $_SESSION["list_drugamount"][$i] * $salepri)."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$part."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
								//echo "==>".$query."<br>";								
							}					
					}else{	//else ถ้าสั่งมาหลายๆ หลอด	
						$sumbalm=$sumbalm+count($i);  //หาจำนวนแถวในการสั่งยา Balm
						
						//echo "สั่งมามากกว่า 1 หลอด $sumbalm<br>";
						if($sumbalm==1){  //สั่งยาเพียง 1 แถว
							//echo "บันทึกยาฟรีในรอบแรก <br>";
							$ddlpart="DDL";
							$ddnpart="DDN";
							$ddlamount=1;  //จำนวนที่เบิกได้
							$ddlprice=16.50;  //ราคาที่เบิกได้
							$ddnamount=$_SESSION["list_drugamount"][$i] - 1;  //จำนวนที่เบิกไม่ได้
							$ddnprice=$ddnamount * $salepri;  //ราคาที่เบิกไม่ได้	
										
							$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$ddnamount."','".$ddnprice."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$ddnpart."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."') , ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$ddlamount."','".$ddlprice."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$ddlpart."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";		
						
								$str="select row_id,essd,nessdn from dphardep where row_id='".$idno."'";
								//echo $str;
								$strquery=mysql_query($str);
								list($rowid,$chkessd,$chknessdn)=mysql_fetch_array($strquery);
								$newessd=$chkessd+16.5;
								$newnessdn=$chknessdn-16.5;
								
								$update="update dphardep set essd='$newessd', nessdn='$newnessdn' where row_id='".$rowid."'";
								//echo "<br>".$update."<br>";
								mysql_query($update);	
							}else{ //ถ้าสั่งยามากกว่า 1 แถว
								//echo "บันทึกยาที่ต้องจ่ายเงิน";
								$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$_SESSION["list_drugamount"][$i]."','".( $_SESSION["list_drugamount"][$i] * $salepri)."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$part."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
								//echo "==>".$query."<br>";								
							}						
						}
					}else{  //ถ้ามีการบันทึกข้อมูลแถมฟรีไปแล้ว
						$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$_SESSION["list_drugamount"][$i]."','".( $_SESSION["list_drugamount"][$i] * $salepri)."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$part."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
						//echo "==>".$query."<br>";
					}
		}else{  //ถ้าได้รับยาฟรีไปแล้ว
		$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$_SESSION["list_drugamount"][$i]."','".( $_SESSION["list_drugamount"][$i] * $salepri)."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$part."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
		}
	}else{  //ถ้าเป็น สิทธิอื่นๆ
	$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$_SESSION["list_drugamount"][$i]."','".( $_SESSION["list_drugamount"][$i] * $salepri)."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$part."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
	}
	
}else if($_SESSION["list_drugcode"][$i]=="10H014"){
	if($chkPtright=="R07" || $chkPtright=="R09" || $chkPtright=="R12" || $chkPtright=="R21" || $chkPtright=="R33"){  //ยืนยันสิทธิ์โดยพี่ีเพชร จัดเก็บรายได้
	//เพิ่มสิทธิ R12 วันที่ 19/05/2559 ยืนยันโดยพี่อึ่ง หน.ประกันสังคม / 30 บาท
		$sqlb="select * from drugrx 
		where `date` like '$chkDate%' 
		and hn='".$_SESSION["hn_now"]."' 
		and drugcode='10H014' 
		and part='DDL' 
		and amount >0";
		//echo $sqlb."<br>";
		$queryb=mysql_query($sqlb);
		$numb=mysql_num_rows($queryb);
		//echo "===>".$numb;
		if($numb < 1){  //ถ้าเดือนนี้ยังไม่ได้รับยาฟรี 1 หลอด
				$sql2="select * from ddrugrx as a 
				inner join dphardep as b 
				on a.idno=b.row_id 
				where a.`date` like '$chkDate1%' 
				and a.hn='".$_SESSION["hn_now"]."' 
				and a.drugcode='10H014' 
				and a.amount ='1' 
				and a.part='DDL' 
				and b.dr_cancle is null";
				//echo "<br>".$sql2."<br>";
				$query2=mysql_query($sql2)or die("Query failed");
				$num2=mysql_num_rows($query2);
				//echo ">>>>".$num2;
				if($num2 < 1){  //ถ้ายังไม่มีการบันทึกข้อมูลฟรียา 10H014 ในตาราง  ddrugrx
					if($_SESSION["list_drugamount"][$i] == 1){  //ถ้าจำนวนที่สั่งมามี 1 หลอด
						$sumjel=$sumjel+count($i);  //หาจำนวนแถวในการสั่งยาเจลพิก
						
						//echo "สั่งมามากกว่า 1 หลอด $sumjel<br>";
						if($sumjel==1){  //สั่งยาเพียง 1 แถว
							//echo "บันทึกยาฟรีในรอบแรก <br>";						
							
							$ddlpart="DDL";
							$ddlamount=1;  //จำนวนที่เบิกได้
							$ddlprice=59.00;  //ราคาที่เบิกได้		
										
							$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$ddlamount."','".$ddlprice."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$ddlpart."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
							
								$str="select row_id,essd,nessdn from dphardep where row_id='".$idno."'";
								//echo $str;
								$strquery=mysql_query($str);
								list($rowid,$chkessd,$chknessdn)=mysql_fetch_array($strquery);
								$newessd=$chkessd+59;
								$newnessdn=$chknessdn-59;
								
								$update="update dphardep set essd='$newessd', nessdn='$newnessdn' where row_id='".$rowid."'";
								//echo "<br>".$update."<br>";
								mysql_query($update);	
							}else{ //ถ้าสั่งยามากกว่า 1 แถว
								//echo "บันทึกยาที่ต้องจ่ายเงิน";
								$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$_SESSION["list_drugamount"][$i]."','".( $_SESSION["list_drugamount"][$i] * $salepri)."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$part."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
								//echo "==>".$query."<br>";								
							}					
					}else{	//else ถ้าสั่งมาหลายๆ หลอด	
						$sumjel=$sumjel+count($i);  //หาจำนวนแถวในการสั่งยาเจลพิก
						
						//echo "สั่งมามากกว่า 1 หลอด $sumjel<br>";
						if($sumjel==1){  //สั่งยาเพียง 1 แถว
							//echo "บันทึกยาฟรีในรอบแรก <br>";
							$ddlpart="DDL";
							$ddnpart="DDN";
							$ddlamount=1;  //จำนวนที่เบิกได้
							$ddlprice=59.00;  //ราคาที่เบิกได้
							$ddnamount=$_SESSION["list_drugamount"][$i] - 1;  //จำนวนที่เบิกไม่ได้
							$ddnprice=$ddnamount * $salepri;  //ราคาที่เบิกไม่ได้	
										
							$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$ddnamount."','".$ddnprice."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$ddnpart."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."') , ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$ddlamount."','".$ddlprice."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$ddlpart."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";		
						
								$str="select row_id,essd,nessdn from dphardep where row_id='".$idno."'";
								//echo $str;
								$strquery=mysql_query($str);
								list($rowid,$chkessd,$chknessdn)=mysql_fetch_array($strquery);
								$newessd=$chkessd+59;
								$newnessdn=$chknessdn-59;
								
								$update="update dphardep set essd='$newessd', nessdn='$newnessdn' where row_id='".$rowid."'";
								//echo "<br>".$update."<br>";
								mysql_query($update);	
							}else{ //ถ้าสั่งยามากกว่า 1 แถว
								//echo "บันทึกยาที่ต้องจ่ายเงิน";
								$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$_SESSION["list_drugamount"][$i]."','".( $_SESSION["list_drugamount"][$i] * $salepri)."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$part."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
								//echo "==>".$query."<br>";								
							}						
						}
					}else{  //ถ้ามีการบันทึกข้อมูลแถมฟรีไปแล้ว
						$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$_SESSION["list_drugamount"][$i]."','".( $_SESSION["list_drugamount"][$i] * $salepri)."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$part."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
						//echo "==>".$query."<br>";
					}
		}else{  //ถ้าได้รับยาฟรีไปแล้ว
		$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$_SESSION["list_drugamount"][$i]."','".( $_SESSION["list_drugamount"][$i] * $salepri)."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$part."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
		}
	}else{  //ถ้าเป็น สิทธิอื่นๆ
	$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$_SESSION["list_drugamount"][$i]."','".( $_SESSION["list_drugamount"][$i] * $salepri)."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$part."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
	}
		
}else{  //else ถ้าเป็นยาอื่นๆ
	$query .= "$commar ('".$Thidate."','".$_SESSION["hn_now"]."','".$_SESSION["list_drugcode"][$i]."','".$tradname."', '".$_SESSION["list_drugamount"][$i]."','".( $_SESSION["list_drugamount"][$i] * $salepri)."','".$_POST["totalitem"]."','".$_SESSION["list_drugslip"][$i]."','".$part."','".$idno."','".$salepri."','".$freepri."','".$_SESSION["list_drug_inject_amount"][$i]."','".$_SESSION["list_drug_inject_unit"][$i]."','".$_SESSION["list_drug_inject_amount2"][$i]."','".$_SESSION["list_drug_inject_unit2"][$i]."','".$_SESSION["list_drug_inject_time"][$i]."','".$_SESSION["list_drug_inject_slip"][$i]."','".$_SESSION["list_drug_inject_type"][$i]."','".$_SESSION["list_drug_inject_etc"][$i]."','".$_SESSION["list_drug_reason"][$i]."','".($dg_dsy*$_SESSION["list_drugamount"][$i])."','".($dg_dsn*$_SESSION["list_drugamount"][$i])."' ,'".$_SESSION["list_drug_reason2"][$i]."')";
}
		$commar = ",";



		$sub_drugcode1 = ord(substr($_SESSION["list_drugcode"][$i],0,1));
		$sub_drugcode2 = ord(substr($_SESSION["list_drugcode"][$i],1,1));

		if(($sub_drugcode1 == 50 || $sub_drugcode1 == 48 || $sub_drugcode1 == 55) && ( $sub_drugcode2 < 48 || $sub_drugcode2 > 57 ))
			$tradname = "<U>".$tradname."</U>";
		else if($_SESSION["list_drugcode"][$i] == "7VENN" || $_SESSION["list_drugcode"][$i] =="7BERSO")
			$tradname = "<U>".$tradname."</U>";


		//$_SESSION["dt_drugstk"] .="
		//				<DIV style='left:".$k1."PX;top:".$j."PX;width:306PX;height:30PX; position:absolute'>
		//					<font style=\"font-family:'MS Sans Serif'; font-size:10px\"> ".$tradname." ".$unit."
		//				</DIV>
		//				<DIV style='left:".$k2."px;top:".$j."PX;width:306PX;height:30PX;position:absolute'>
		//					<font style=\"font-family:'MS Sans Serif'; font-size:10px\" >&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION["list_drugslip"][$i]."
		//				</DIV>
		//				<DIV style='left:".$k3."px;top:".$j."PX;width:306PX;height:30PX;position:absolute'>
		//					<font style=\"font-family:'MS Sans Serif'; font-size:10px\">จำนวน&nbsp;".$_SESSION["list_drugamount"][$i]."&nbsp;".$unit."
		//				</DIV>
				
		//		";
		
		if($_SESSION["list_drugcode"][$i] != "INJ"){
			if($_SESSION['list_drug_reason'][$i]==""){
				$_SESSION["dt_drugstk"] .="<TR style='line-height:12px;'>
			<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\"> ".$tradname." ".$unit."</TD>";			
			}else{
				$_SESSION["dt_drugstk"] .="<TR style='line-height:12px;'>
			<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\"> ".$tradname." ".$unit."(".substr($_SESSION['list_drug_reason'][$i],0,1).")</TD>";		
			}
			$_SESSION["dt_drugstk"] .="<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\" >&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION["list_drugslip"][$i]."</TD>
			<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\">จำนวน&nbsp;".$_SESSION["list_drugamount"][$i]."&nbsp;".$unit."</TD>
			</TR>";
			// ชื่อยา หน่วย จำนวน หน่วย
			
			//ถ้ายาฉีด หรือ insurin
			if($_SESSION["list_drug_inject_slip"][$i]!=""){
				if($_SESSION["list_drug_inject_slip"][$i]=="1ins"||$_SESSION["list_drug_inject_slip"][$i]=="2ins"){
					$_SESSION["dt_drugstk"] .="<TR style='line-height:12px;'>
					<TD colspan='3'><font style=\"font-family:'MS Sans Serif'; font-size:10px\">(".$_SESSION["list_drug_inject_amount"][$i]." ".$_SESSION["list_drug_inject_unit"][$i]." ".$_SESSION["list_drug_inject_amount2"][$i]." ".$_SESSION["list_drug_inject_unit2"][$i].")</TD>
					</TR>";
				}
				elseif(trim($_SESSION["list_drug_inject_amount"][$i]) != "" && trim($_SESSION["list_drug_inject_slip"][$i]) != "" && trim($_SESSION["list_drug_inject_type"][$i]) != "" ){

					$_SESSION["dt_drugstk"] .="<TR style='line-height:12px;'>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\">จำนวนที่ฉีด ".$_SESSION["list_drug_inject_amount"][$i]."</TD>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\" >".$_SESSION["list_drug_inject_slip"][$i]."</TD>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\">ฉีดแบบ ".$_SESSION["list_drug_inject_type"][$i]."&nbsp;</TD>
					</TR>";
				}
			}


				/*if(trim($_SESSION["list_drug_inject_amount"][$i]) != "" && trim($_SESSION["list_drug_inject_slip"][$i]) != "" && trim($_SESSION["list_drug_inject_type"][$i]) != "" ){

					$_SESSION["dt_drugstk"] .="<TR style='line-height:12px;'>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\">จำนวนที่ฉีด ".$_SESSION["list_drug_inject_amount"][$i]."</TD>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\" >".$_SESSION["list_drug_inject_slip"][$i]."</TD>
					<TD><font style=\"font-family:'MS Sans Serif'; font-size:10px\">ฉีดแบบ ".$_SESSION["list_drug_inject_type"][$i]."&nbsp;</TD>
					</TR>";
				}*/

			$j = $j+15;
		}
      }
	$j = $j+5;
	
	// เก็บ log หลังจากเพิ่มจากลงใน ddrugrx
	// $logs = "ddrugrx - add\r\n";
	// $logs .= "[mysql] : $query\r\n";
	// $logs .= "---------------------------\r\n\r\n";
	// file_put_contents('logs/doctor-drug.log', $logs, FILE_APPEND);
	
	
	//$_SESSION["dt_drugstk"] .="<DIV style='left:".$k2."px;top:".$j."PX;width:306PX;height:30PX;position:absolute'>
	//					<font style=\"font-family:'MS Sans Serif'; font-size:8px\" >".$_SESSION["dt_doctor"]."
	//					</DIV>";
	
	$_SESSION["dt_drugstk"] .= "
	<TR>
		<TD colspan=\"3\"><font style=\"font-family:'MS Sans Serif'; font-size:8px\" >".$_SESSION["dt_doctor"]."</TD>
	</TR>";

	$j = $j+15;
	//$_SESSION["dt_drugstk"] .="<DIV style='line-height:15px;left:".$k1."px;width:306PX;top:".$j."PX;height:30PX;position:absolute'>
	//						<font style=\"font-family:'MS Sans Serif'; font-size:10px\"> <B>LAB</B> : ";


$sql = "Select * From patdata where depart = 'PATHO' AND date like '".(date("Y")+543).date("-m-d")."%' AND hn = '".$_SESSION["hn_now"]."' ";

$result = Mysql_Query($sql);
if(Mysql_num_rows($result) > 0){

$_SESSION["dt_drugstk"] .= "
	<TR>
		<TD colspan=\"3\"><font style=\"font-family:'MS Sans Serif'; font-size:10px\"> <B>LAB</B> :";

$commar = "";
while($arr = mysql_fetch_assoc($result)){
	$_SESSION["dt_drugstk"] .=$commar.$arr["code"];
	$commar = ", ";
}

	$_SESSION["dt_drugstk"] .="</TD>
	</TR>";

}
$_SESSION["dt_drugstk"] .="</TABLE>";

$sql = "Select detail_all From xray_doctor where date like '".(date("Y")+543).date("-m-d")."%' AND hn = '".$_SESSION["hn_now"]."' AND doctor = '".$_SESSION["dt_doctor"]."' Order by date DESC limit 1";


$result = Mysql_Query($sql);
if(Mysql_num_rows($result) > 0){

$_SESSION["dt_drugstk"] .= "
	<TR>
		<TD colspan=\"3\"><font style=\"font-family:'MS Sans Serif'; font-size:10px\"> <B>X-Ray</B> :";

$arr = mysql_fetch_assoc($result);
$_SESSION["dt_drugstk"] .= "<BR>".nl2br($arr["detail_all"]);

	$_SESSION["dt_drugstk"] .="</TD>
	</TR>";

}
$_SESSION["dt_drugstk"] .="</TABLE>";


	 if($insert1 == true && $count > 0)
		$result2 = Mysql_Query($query) or die(Mysql_error());
		//echo "<!-- ".$query." -->";

		if($insert1 ==true && $result2 ==true){
		
		$_SESSION["nRunno"] = "";
		$_SESSION["list_drugcode"] = array() ;
		$_SESSION["list_drugamount"] = array() ;
		$_SESSION["list_drugslip"] = array() ;

		$_SESSION["list_drug_inject_amount"] = array() ;
		$_SESSION["list_drug_inject_unit"] = array() ;
		$_SESSION["list_drug_inject_amount2"] = array() ;
		$_SESSION["list_drug_inject_unit2"] = array() ;
		$_SESSION["list_drug_inject_time"] = array() ;
		$_SESSION["list_drug_inject_slip"] = array() ;
		$_SESSION["list_drug_inject_type"] = array() ;
		$_SESSION["list_drug_inject_etc"] = array() ;

	echo "
	<html>
	<head>
		<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){
			
			//print();
			//setTimeout(\"window.location.href='dt_index.php';\",5000);


		}
		
</SCRIPT>
<style type=\"text/css\">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
	</head>
	<body leftmargin=\"0\" topmargin=\"0\">
	";
include("dt_menu.php");
echo "<BR><BR>
	<CENTER>บันทึกข้อมูลเรียบร้อยแล้ว<BR>ถ้าไม่มีนัดให้กดพิมพ์<BR><A HREF=\"dt_printstker.php\">Print Stiker</A></CENTER>
	</body>
	</html>
				
	";
	echo"	<BR><BR> <CENTER>ถ้าแพทย์ต้องการออกใบนัด ให้เลือกเมนูออกใบนัดก่อนการพิมพ์ Stiker<BR>Stikerจะออกมาพร้อมกับใบนัดผู้ป่วย</CENTER>";
			
		}else{
	
	if(isset($_POST["doctor"])){
			$first_page = "dt_dental.php";
		}else{
			$first_page = "dt_index.php";
	}

	echo "<CENTER>ขออภัยเกิดความผิดพลาดบางประการ กรุณากรอก VN ใหม่อีกครับ<BR><A HREF=\"".$first_page."\">เลือกผู้ป่วยใหม่</A></CENTER>";
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$first_page."\">";

		}


$mum50 = '50';
$price1=$_POST["Netprice"] + $mum50 ;
$price2=$_POST["DDN"]  + $_POST["DPN"] + $_POST["DSY"]+ $_POST["DSN"] ;
	
	// print "<center><font face='Angsana New' size= 2 >ใบรับยาผู้ป่วย&nbsp;$Thidate&nbsp;VN:".$_SESSION["vn_now"]."<br></font>";

 //print "<font face='Angsana New' size= 3 ><b> ".$_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"]."  &nbsp;HN:".$_SESSION["hn_now"]."</b></font><br>";

// print "<font face='Angsana New' size= 2 >แพทย์".$_SESSION["dt_doctor"]."<br></font>";

 //  print "<font face='Angsana New' size= 3 >สิทธิ&nbsp;".$_SESSION["ptright_now"]."</font>";
  //  print "<font face='Angsana New' size= 3 ><u><b><br>ยื่นที่ช่อง&nbsp; </font>";
// print "<font face='Angsana New' size= 4 >หมายเลข 6</font></u></b>";
// print "<font face='Angsana New' size= 2 ><br>ราคา&nbsp; $price1&nbsp; <u>เบิกไม่ได้&nbsp; $price2&nbsp; บาท</u>&nbsp;รหัสรับยา&nbsp; $kew </font></center>";


include("unconnect.inc");
?>