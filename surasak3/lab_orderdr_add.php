<?php
session_start();
include("connect.inc");


session_unregister("list_bill");
session_register("list_bill");
$_SESSION["list_bill"] = "";


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
					setTimeout(\"window.location.href='lab_orderdr.php';\",5000);
				}
			</SCRIPT>
			<BR><BR><CENTER>��س����͡��¡�õ�Ǩ LAB ���ҧ���� 1 ��¡��</CENTER>";
				exit();

	}

// ��駤�ҵ�ҧ�
	$cPtname = $_SESSION["cPtname"];
	$cHn = $_SESSION["cHn"];
	$cAn = "";
	$cDoctor = $_POST['sdoctor'];
	$cDepart = "PATHO";
	$cLab = "DR";
	$aDetail="��ҵ�Ǩ���������ä";
	$cDiag = "��Ǩ�����������͡���ѡ��";
	$tvn = $_SESSION["tvn"];
	$cPtright = $_SESSION["cPtright"];
	
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$Thidate2 = date("Y").date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$patienttype = "OPD";
	$sourcecode = "";//����ward
	$build = array("42"=>"�ͼ�����˭ԧ","44"=>"�ͼ����� ICU","43"=>"�ͼ������ٵ�","45"=>"�ͼ����¾����");

	$sourcename = "";//����ward
	$room = ""; //��ͧ������
	$clinicalinfo = "";

			
	for($i=0;$i< $item;$i++){

		$sql = "Select yprice, nprice, price, part,detail From labcare where code = '".$_SESSION["list_code"][$i]."' limit 1 ";
		list($yprice[$i], $nprice[$i], $price[$i], $aPart[$i],$labDetail[$i]) = Mysql_fetch_row(Mysql_Query($sql));

	}

	$aSumYprice = array_sum($yprice);
	$aSumNprice = array_sum($nprice);
	
	$Netprice = $aSumYprice+$aSumNprice;
	$pathopri=$Netprice;
/////////////////////////////labtranx//////////////////////////////////
	$query = "SELECT runno, startday FROM runno WHERE title = 'lab'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nLab=$row->runno;
	$dLabdate=$row->startday;
	$dLabdate=substr($dLabdate,0,10);
	
	if(substr($dLabdate,0,10) != date("Y-m-d")){
		$nLab = 1;
		$dLabdate = date("Y-m-d 00:00:00");
	}
	
	$today = date("Y-m-d"); 
	
	if($cDoctor != "��س����͡ᾷ��"){
		$sql = "Select codedoctor, name From inputm where name='".$cDoctor."' OR mdcode = '".substr($cDoctor,0,5)."' limit 1";
		list($doctorcode, $doctorname) = mysql_fetch_row(mysql_query($sql));
	
		$cliniciancode = $doctorcode;//����ᾷ��
		$clinicianname =$cDoctor;//����ᾷ��
		
	}else{
		
		$cliniciancode = "";//����ᾷ��
		$clinicianname = "��س����͡ᾷ��";//����ᾷ��
		
	
	}
	$room = $tvn;
	
	if(!empty($cAn)){
		$sql = 'Select bedcode From ipcard where an = \''.$cAn.'\' limit 0,1;';
		list($patient_from) = mysql_fetch_row(mysql_query($sql));
	}else{
		$patient_from = "OPD";
	}
	
	//insert data into depart
   $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright,lab)VALUES('$nRunno','$Thidate','$cPtname','$cHn','$cAn','$cDoctor','$cDepart','$item','$aDetail', '$Netprice','$aSumYprice','$aSumNprice','','$sOfficer','$cDiag','0','$tvn','$cPtright','$nLab');";

      $result = mysql_query($query) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>
	*�ô��Ǩ�ͺ�������¡������� [�١�è����Թ] �������<br>
	*������ʴ���� ��ѹ�֡仡�͹����<br>
	*���������ʴ����  ��úѹ�֡�������<br><br>
                -------- ��¡�� ---------<br> 
	$Thaidate<br>
	$cPtname HN:$cHn AN:$cAn VN:$tvn<br>
                �Է��: $cPtright<br>
                �ä:$cDiag<br>
                ᾷ��:$cDoctor<br>
                $aDetail<br>
               �ӹǹ $item ��¡��<br>
               �Ҥ���� $Netprice �ҷ<br>
               ���. $sOfficer<br>");

  $idno=mysql_insert_id();
  $x=$item;

//insert data into patdata
    for ($n=0; $n<$x; $n++){
		If (!empty($_SESSION["list_code"][$n])){
			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','".$_SESSION["list_code"][$n]."','$labDetail[$n]','1','$price[$n]','$yprice[$n]','$nprice[$n]','$cDepart','$aPart[$n]','$idno','$cPtright');";
                $result = mysql_query($query) or die("Query failed,cannot insert into patdata");

        }
	}

	$Thdhn=date("d-m-").(date("Y")+543).$cHn;
	$query ="UPDATE opday SET  patho=patho+$pathopri WHERE thdatehn= '$Thdhn' AND vn = '".$tvn."' ";

	$result = mysql_query($query) or die("Query failed,update opday");
	
	for ($n=0; $n<$x; $n++){
		 list($olddetail,$detail) = mysql_fetch_row(mysql_query("Select oldcode From labcare where code = '".$_SESSION["list_code"][$n]."' limit 0,1 "));

		$sql = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $nLab)."', '".$_SESSION["list_code"][$n]."', '".$olddetail."', '".$labDetail[$n]."');";
		 $result = mysql_query($sql) or die("Query failed,INSERT orderdetail");

		 $clinicalinfo .=$_SESSION["list_code"][$n]." ,";
	 }

	 /*if($cDiag == "chk01-��Ǩ�آ�Ҿ��Шӻաͧ�Ѻ��" || $cDiag == "chk01-��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��")
			$clinicalinfo = "��Ǩ�آ�Ҿ��Шӻ�55";

	  if($cDiag == "��Ǩ�آ�Ҿ")
			$clinicalinfo = "��Ǩ�آ�Ҿ��Шӻ�55";*/
	
	$sql = "Select sex, dbirth From opcard where hn = '".$cHn."' limit 0,1 ";
	$result = mysql_query($sql) or die("Query failed,update opday");
	list($sex, $dbirth) = mysql_fetch_row($result);

	if($sex == "�")
		$gender = "M";
	else if($sex == "�")
		$gender = "F";
	else
		$gender = "0";
	
	if(empty($_SESSION["aPriority"]))
		$priority = "R";
	else
		$priority = $_SESSION["aPriority"];
	
	$first_year = explode("-",$dbirth);
	$first_year[0] = $first_year[0]-543;
	if(checkdate($first_year[1],$first_year[2],$first_year[0])){
		$dbirth = $first_year[0].substr($dbirth,4);
	}else{
		$dbirth = date("Y-m-d");
	}
	
	$sql = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $nLab)."', '".$cHn."', '".$patienttype."', '".$cPtname."', '".$gender."', '".$dbirth."', '".$sourcecode."', '".$sourcename."', '".$room."','".$cliniciancode."', '".$clinicianname."', '".$priority."', '".$clinicalinfo."');";
	$result = mysql_query($sql)or die("Query failed,INSERT orderhead ");



		$nLab++;
		$query ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
		$result = mysql_query($query) or die("Query failed");
// End

			
//���˹��
  print "���˹��<br>";
     print "<font face='Angsana New'>$cPtname HN:$cHn VN:$tvn  �Է��: $cPtright<br>";
//    print "�Է��: $cPtright<br>";
    print "�ä:$cDiag ᾷ��:$cDoctor<br>";
//    print "ᾷ��:$cDoctor<br>";
      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>��¡��</th>";
      print "  <th>�ӹǹ</th>";
      print "  <th>�Ҥ�</th>";
      print "  <th>�ԡ�����</th>";
      print " </tr>";

    $no=0;
    for ($n=0; $n<$x; $n++){
          If (!empty($_SESSION["list_code"][$n])){
              $no++;
         print (" <tr>\n".
           "  <td>$no</td>\n".
           "  <td>$labDetail[$n]</td>\n".
           "  <td>1</td>\n".
           "  <td>$price[$n]</td>\n".
           "  <td>$nprice[$n]</td>\n".
           " </tr>\n");
                         }
                         } ;
      print "</table>";
   print "<B>�Ҥ���� $Netprice �ҷ </B><br>";
   if ($aSumNprice>0){
			print"<B>(�ԡ����� $aSumNprice �ҷ )</B><br>";
			?>
			<script>
            	alert("��� �ѵ���� ����ǹ�Թ����������ö�ԡ�� �������ª����Թ��ǹ�Թ�����ǹ���Թ");
            </script>
			<?
					   }
   print "���. $sOfficer";  
      print "<font face='Angsana New'>&nbsp;&nbsp;$Thaidate<br>";
      print "***************************************************<br>";  
	     print "<B>�����˹��仪����Թ�����ͧ���Թ</B>";  

		/*if($result){

		$drugstk = "<center><div style='line-height:20px;width:240PX'><font face='Angsana New' size= 1 >LAB ������&nbsp;$Thidate&nbsp;VN:".$_SESSION["vn_now"]."<br></font>";
			$drugstk .= "<font face='Angsana New' size= 3 ><b> ".$_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"]."  &nbsp;HN:".$_SESSION["hn_now"]."</b></font><br>";

			$drugstk .= "<font face='Angsana New' size= 2 >ᾷ��".$_SESSION["dt_doctor"]."<br></font>";

			$drugstk .= "<font face='Angsana New' size= 2 >�Է��&nbsp;".$_SESSION["ptright_now"]."</font>";
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
				$drugstk .= "<font face='Angsana New' size= 3 ><br>��蹷���ͧ&nbsp;�����Ţ 4</font></u></b>";
			}else{
				$drugstk .= "<font face='Angsana New' size= 3 ><br>��蹷����ͧ LAB</font></u></b>";
			}

			
			$drugstk .= "<font face='Angsana New' size= 1 ><br>�Ҥ�&nbsp; ".$Netprice."&nbsp; <u>�ԡ�����&nbsp; ".$aSumNprice." &nbsp; �ҷ</u>&nbsp;";
			$drugstk .= "<BR><B>LAB</B> : ";
		for ($n=0; $n<$item; $n++){
			If (!empty($_SESSION["list_code"][$n])){
					$drugstk .=$_SESSION["list_code"][$n].", ";
			}
		}
				$drugstk .="</font></div></center>";
				
			
		}else{
			$drugstk = "<BR><BR><CENTER>�������ö�ѹ�֡��������</CENTER>";
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
		}*/
		
	//$pathopri=$Netprice;
		//$sql ="UPDATE opday SET patho=patho+".$pathopri." WHERE thdatehn= '".$Thdhn."' AND  vn = '".$tvn."' ";
		//$result = Mysql_Query($sql) or die("Error update opday ".Mysql_Error());

		/*echo "<html><head>
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
				
	";*/
	?>
	<script>
		window.opener.location.href='labhndr.php';
		//setTimeout("window.opener.location.href='labhndr.php';",3000);
    </script>