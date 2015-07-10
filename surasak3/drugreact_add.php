<?php
   session_start();
   include("connect.inc");
    $no=0;

    $aDrugcode = array("รหัส");
    $aTradname  = array("รายการ");
    $aAdvreact = array("อาการแพ้"); 
    $aAsses  = array("ประเมิน");
    $aReporter  = array("ผู้รายงาน");
    $aRepdate= array("วันที่รายงาน");

    
     
    //echo"<font face='Angsana New'>ชื่อ: $sPtname,HN: $sHn, ";  
    //echo "สิทธิการรักษา: $sPtright<br>";
	//print_r($_POST);
	$Thaidate=(date("Y")+543).date("-m-d H:i:s");
for($no=1; $no<=$_POST['numm']; $no++){
	if($_POST['ch'.$no]=='1'){
     $sql = "INSERT INTO drugreact(hn,drugcode,tradname,advreact,asses,reporter,date,officer) VALUES('".$_SESSION['sHn']."','".trim($_POST['drug'.$no])."','".$_POST['trad'.$no]."','".$_POST['adv']."','".$_POST['accept']."','".$_POST['repot']."','$Thaidate','".$_SESSION['sOfficer']."');";
	 //echo $sql;
     $result = mysql_query($sql);
	}
}
////////////////
if($result){
     print "<br>บันทึกข้อมูลเรียบร้อย <br>";
	 print "<br>ปิดหน้าต่าง <br>";
	 ?>
	 <script>
     window.location.href='dgadv.php?cHn=<?=$_SESSION['sHn']?>';
     </script>
	 <?
     
	 
}
  include("unconnect.inc");
    session_unregister("sHn");
    session_unregister("sPtname");
    session_unregister("sPtright");
?>