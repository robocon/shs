<?php
session_start();
include("connect.inc");
include("dt_menu.php");

session_unregister("list_bill");
session_register("list_bill");
$_SESSION["list_bill"] = "";

	if($_SESSION["dt_dental"] == true){
		$first_page = "dt_dental.php";

	}else{
		//$first_page = "dt_index.php";
		$first_page = "dt_diag.php";
	}


//require('thaipdfclass.php');
//$pdf=new ThaiPDF();
?>
<style>
.strickerfont{
	font-family:'Angsana New';
	font-size:14px;
}
</style>
<?

		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
		$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
		$Thdhn=date("d-m-").(date("Y")+543).$_SESSION["hn_now"];

		$item=0;
	
			$item  = count($_SESSION["list_code"]);

			if($item == 0){
				
				echo "
				<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){
			setTimeout(\"window.location.href='".$first_page."';\",5000);
		}
		
		</SCRIPT>
			<BR><BR><CENTER>กรุณาเลือกรายการตรวจ LAB อย่างน้อย 1 รายการ</CENTER>";
				exit();

			}

// ตั้งค่าต่างๆ
	$cPtname = $_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"];
	$cHn = $_SESSION["hn_now"];
	$cAn = "";
	$cDoctor = $_SESSION["dt_doctor"];
	$cDepart = "PATHO";
		$cLab = "DR";
	 $aDetail="ค่าตรวจวิเคราะห์โรค";
	$cDiag = $_POST["type_diag"];
	$tvn = $_SESSION["vn_now"];
	$cPtright = $_SESSION["ptright_now"];

	for($i=0;$i< $item;$i++){

		$sql = "Select yprice, nprice, price, part From labcare where code = '".$_SESSION["list_code"][$i]."' limit 1 ";
		list($yprice[$i], $nprice[$i], $price[$i], $aPart[$i]) = Mysql_fetch_row(Mysql_Query($sql));

	}

	$aSumYprice = array_sum($yprice);
	$aSumNprice = array_sum($nprice);
	
	$Netprice = $aSumYprice+$aSumNprice;

// End

			$sql = "INSERT INTO labdepart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright,detailbydr,lab,priority)VALUES('".$nRunno."','".$Thidate."','".$cPtname."','".$cHn."','".$cAn."','".$cDoctor."','".$cDepart."','".$item."','".$aDetail."','".$Netprice."','".$aSumYprice."','".$aSumNprice."','','".$_SESSION["dt_doctor"]."','".$cDiag."','".$cAccno."','".$tvn."','".$cPtright."','".$_POST["detailbydr"]."','".$cLab."','".$_POST["priority"]."');";
			
			$result = Mysql_Query($sql) or die("Error depart ".Mysql_Error());
		$idno=mysql_insert_id();
		
		$sql = "INSERT INTO labpatdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright,priority) VALUES ";
		
		$list = array();
		for ($n=0; $n<$item; $n++){
         If (!empty($_SESSION["list_code"][$n])){
                $q = "('".$Thidate."','".$cHn."','".$cAn."','".$cPtname."','".$cDoctor."','".$item."','".$_SESSION["list_code"][$n]."','".$_SESSION["list_detail"][$n]."','1','".$price[$n]."','".$yprice[$n]."','".$nprice[$n]."','".$cDepart."','".$aPart[$n]."','".$idno."','".$cPtright."','".$_POST["priority"]."') ";
				array_push($list,$q);
              
		 }
        }

		if($n > 0){
			$sql .= implode(", ",$list);
			$result = Mysql_Query($sql) or die("Error patdata ".Mysql_Error());
		}

		if($result){
			?>
            <br /><br />
			<center><a href="hd_stiker_lab.php?hn=<?=$cHn?>&p2" target="_blank"><span style="font-size:28px; font-family:'Angsana New';">Stricker ติด Tube lab</span></a></center>
             <br /><br />
			<?
		$drugstk = "<center><div style='line-height:20px;width:240PX'><font face='Angsana New' size= 1 >LAB ผู้ป่วย&nbsp;$Thidate&nbsp;VN:".$_SESSION["vn_now"]."<br></font>";
			$drugstk .= "<font face='Angsana New' size= 3 ><b> ".$_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"]."  &nbsp;HN:".$_SESSION["hn_now"]."</b></font><br>";

			$drugstk .= "<font face='Angsana New' size= 2 >แพทย์".$_SESSION["dt_doctor"]."<br></font>";

			$drugstk .= "<font face='Angsana New' size= 2 >สิทธิ&nbsp;".$_SESSION["ptright_now"]."</font>";
			$drugstk .= "<font face='Angsana New' size= 3 ><u><b> </font>";
			
			$cd = true;
				switch(substr($_SESSION["ptright_now"],0,3)){
					case "R01": $cd = false; break;
					case "R02": $cd = false; break;
					case "R04": $cd = false; break;
					case "R05": $cd = false; break;
					case "R06": $cd = false; break;
					case "R15": $cd = false; break;
					case "R16": $cd = false; break;
					case "R20": $cd = false; break;
					case "R21": $cd = false; break;
				}


			if($aSumNprice > 0 || $cd == false){
				$drugstk .= "<font face='Angsana New' size= 3 ><br>ยื่นที่ช่อง&nbsp;หมายเลข 4</font></u></b>";
			}else{
				$drugstk .= "<font face='Angsana New' size= 3 ><br>ยื่นที่ห้อง LAB</font></u></b>";
			}

			
			$drugstk .= "<font face='Angsana New' size= 1 ><br>ราคา&nbsp; ".$Netprice."&nbsp; <u>เบิกไม่ได้&nbsp; ".$aSumNprice." &nbsp; บาท</u>&nbsp;";
			$drugstk .= "<BR><B>LAB</B> : ";
		for ($n=0; $n<$item; $n++){
			If (!empty($_SESSION["list_code"][$n])){
					$drugstk .=$_SESSION["list_code"][$n].", ";
			}
		}
				$drugstk .="</font></div></center>";
				
			
		}else{
			$drugstk = "<BR><BR><CENTER>ไม่สามารถบันทึกข้อมูลได้</CENTER>";
		}


		IF (!empty($cAn)) {

			$sql = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES ";
			$list = array();
			for ($n=0; $n<$item; $n++){
				If (!empty($_SESSION["list_code"][$n])){
					$q = "('$Thidate','$cAn','".$_SESSION["list_code"][$n]."','$cDepart','".$_SESSION["list_detail"][$n]."','1','".$price[$n]."','".$_SESSION["dt_doctor"]."','$aPart[$n]','$cAccno','$idno') ";
					array_push($list,$q);

				}
			}
			
			if($n > 0){
				$sql .= implode(", ",$list);
				$result = Mysql_Query($sql) or die("Error ipacc ".Mysql_Error());
			}
		}
		
		$pathopri=$Netprice;
		//$sql ="UPDATE opday SET patho=patho+".$pathopri." WHERE thdatehn= '".$Thdhn."' AND  vn = '".$tvn."' ";
		//$result = Mysql_Query($sql) or die("Error update opday ".Mysql_Error());

		echo "<html><head>
		<SCRIPT LANGUAGE=\"JavaScript\">
		window.onload = function(){
			//window.print();
			setTimeout(\"window.location.href='".$first_page."';\",8000);
		}
		</SCRIPT>
	</head>
	<body leftmargin=\"0\" topmargin=\"0\">
		",$drugstk,"
	</body>
	</html>
				
	";
	?>
	