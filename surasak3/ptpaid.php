<?php
  	session_start();
    $Thaidate=date("d-m-").(date("Y")+543);

    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	include("connect.inc");
 	$aCode = array("����");
    $aDetail  = array("��¡��");
    $aDSPY = array("dspy"); 
	$aDSPN = array("dspn"); 
    $aAmount  = array("�ӹǹ");
    $aMCprice  = array("�Ҥ����");
    $aYprino= array("�Ҥ��ԡ��");
    $aNprino= array("�Ҥ��ԡ�����");
    $no=0;
	for($no=1; $no<=12; $no++){
		if($_POST['item'.$no] !=""){
			$NetMcpri=$NetMcpri+$_POST['price'.$no]; //����Թ������
			$Netyprice=$Netyprice+$_POST['yprice'.$no]; //����Թ����ԡ��
			$Netnprice=$Netnprice+$_POST['nprice'.$no]; //����Թ����ԡ�����
			if($_POST['yprice'.$no] >=0&&$_POST['dsp'.$no] =="DS") {
				$ydspp="DSY";
			}elseif($_POST['yprice'.$no] >=0&&$_POST['dsp'.$no] =="DP") {
				$ydspp="DPY";
			}
			
			if($_POST['nprice'.$no] >=0&&$_POST['dsp'.$no] =="DS") {
				$ndspp="DSN";
			}elseif($_POST['nprice'.$no] >=0&&$_POST['dsp'.$no] =="DP") {
				$ndspp="DPN";
			}
			
			$aCode[$no] = "PHYSI";
			$aDetail[$no]  = $_POST['dpycode'.$no].' '.$_POST['item'.$no];
			$aDSPY[$no]= $ydspp;
			$aDSPN[$no]= $ndspp;
			$aAmount[$no]  = $_POST['amount'.$no];
			$aMCprice[$no]  = $_POST['price'.$no];
			$aYprino[$no]= $_POST['yprice'.$no]; 
			$aNprino[$no]=$_POST['nprice'.$no]; 
			$item++;
		}
		if($_POST['item1']==""){
			 if (!empty($cAn)){
			?>
			<script>
				alert("�������¡�ä���ػ�ó� ��س�ŧ�ѹ�֡����");
				window.location.href='ptipitem.php';
			</script>
			<?
			}
			else{
			?>
			<script>
				alert("�������¡�ä���ػ�ó� ��س�ŧ�ѹ�֡����");
				window.location.href='ptpage.php';
			</script>
			<?
			} 
		}
	}
       //insert data into depart
	   if (!empty($cAn)){
                $tvn=$cAn;
       	}
    	else{
                $tvn=$tvn;
		} 
       $query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,
                    idname,diag,accno,tvn,ptright)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','PHYSI','$item','�������������/�ػ�ó�㹡�úӺѴ�ѡ��',
                    '$NetMcpri','$Netyprice','$Netnprice','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright');";
       $result = mysql_query($query) or die("Query failed,cannot insert into depart");
       $idno=mysql_insert_id();

    echo "<font face='Angsana New'>��¡�ä������������/�ػ�ó�㹡�úӺѴ�ѡ�� �ѹ��� $Thaidate<br>";
    if (!empty($cAn)){
                echo"������� ����: $cPtname,HN: $cHn,AN: $cAn, ��§: $cBedcode<br>";  
       	}
    else{
                echo"�����¹͡ ����: $cPtname,HN: $cHn<br>"; 
	} 
    echo "�Է��: $cPtright, �ä: $cDiag<br>";
    echo "ᾷ��: $cDoctor<br>";


for($no=1; $no<=12; $no++){
   if($_POST['item'.$no] !="") {
       //insert data into patdata
	   if($_POST['yprice'.$no] >0){
		   $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,ptright,idno) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','PHYSI','$aDetail[$no]','$aAmount[$no]','$aMCprice[$no]','$aYprino[$no]','$aNprino[$no]','PHYSI','$aDSPY[$no]','$cPtright','$idno');";
		  	$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
	   }else{
		   $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,ptright,idno) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','PHYSI','$aDetail[$no]','$aAmount[$no]','$aMCprice[$no]','$aYprino[$no]','$aNprino[$no]','PHYSI','$aDSPN[$no]','$cPtright','$idno');";
		  	$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
	   }


	if ($cAn!=""){
		if($aYprino[$no] > 0 and ($aDSPY[$no]=="DPY" or $aDSPY[$no]=="DSY")){
            //insert data into ipacc
       		$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno,ptright)VALUES('$Thidate','$cAn','$aCode[$no]','PHYSI','$aDetail[$no]','$aAmount[$no]','$aYprino[$no]','$sOfficer','$aDSPY[$no]','$cAccno','$idno','$cPtright');";
       		$result1 = mysql_query($query) or die("Query failed,cannot insert into ipacc");
	   }
       if($aNprino[$no] > 0 and $aDSPN[$no]=="DPN"){
            $cNprice='(�ԡ�����)';
            $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno,ptright)VALUES('$Thidate','$cAn',
	'$aCode[$no]','PHYSI','$aDetail[$no] $cNprice',
                    '$aAmount[$no]','$aNprino[$no]','$sOfficer','$aDSPN[$no]','$cAccno','$idno','$cPtright');";
          	$result1 = mysql_query($query) or die("Query failed,cannot insert into ipacc");
	   }
		if($aNprino[$no] > 0 and $aDSPN[$no]=="DSN"){
            $cNprice='(�ԡ�����)';
            $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno,ptright)VALUES('$Thidate','$cAn',
	'$aCode[$no]','PHYSI','$aDetail[$no] $cNprice',
                    '$aAmount[$no]','$aNprino[$no]','$sOfficer','$aDSPN[$no]','$cAccno','$idno','$cPtright');";
            $result1 = mysql_query($query) or die("Query failed,cannot insert into ipacc");
		}
	}
   }
}

print"<table>";
print" <tr>";
print"  <th bgcolor=6495ED>#</th>";
print"  <th bgcolor=6495ED>������¡��</th>";
print"  <th bgcolor=6495ED>������</th>";
print"  <th bgcolor=6495ED>�ӹǹ</th>";
print"  <th bgcolor=6495ED>�Ҥ����</th>";
print"  <th bgcolor=6495ED>�ԡ��</th>";
print"  <th bgcolor=6495ED>�ԡ�����</th>";
print"  </tr>";
if($result1){
	$sql2 ="select detail,part,amount,price,yprice,nprice from patdata where an='$cAn' and date ='$Thidate' and code='PHYSI' ";
}elseif($result){
	$sql2 ="select detail,part,amount,price,yprice,nprice from patdata where hn='$cHn' and date ='$Thidate' and code='PHYSI' ";
}
$result5 = mysql_query($sql2);
while(list($detail,$part,$amount,$price,$yprice,$nprice) = mysql_fetch_array($result5)){
	$nnn++;
print("<tr>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$nnn</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$detail</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$part</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$amount</td>\n".    
                "<td bgcolor=F5DEB3><font face='Angsana New'>$price</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$yprice</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$nprice</td>\n".  
                " </tr>\n");
}
print"</table>";
////////////////
if($result1||$result){
    print "�ѹ�֡���������º����,���ѹ�֡:$sOfficer";
    print "<a target=_self  href='../nindex.htm'><<�����</a>";
  include("unconnect.inc");
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("cDiag");
    session_unregister("cAn"); 
    session_unregister("cDoctor"); 
    session_unregister("cAccno"); 
    session_unregister("cBedcode"); 
}else{
	print "�ѹ�֡�����żԴ��Ҵ ��سҺѹ�֡����";
}
?>