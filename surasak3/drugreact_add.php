<?php
   session_start();
   include("connect.inc");
    $no=0;

    $aDrugcode = array("����");
    $aTradname  = array("��¡��");
    $aAdvreact = array("�ҡ����"); 
    $aAsses  = array("�����Թ");
    $aReporter  = array("�����§ҹ");
    $aRepdate= array("�ѹ�����§ҹ");

    
     
    //echo"<font face='Angsana New'>����: $sPtname,HN: $sHn, ";  
    //echo "�Է�ԡ���ѡ��: $sPtright<br>";
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
     print "<br>�ѹ�֡���������º���� <br>";
	 print "<br>�Դ˹�ҵ�ҧ <br>";
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