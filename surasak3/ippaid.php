<?php
global $cHn, $cAn, $electric;
  session_start();
  $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  $th_date = ( date("Y") + 543 ).date("-m-d");
  include("connect.inc");
/*
��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��=
���俿��
������Ѿ��
�������ػ�ó��������
���ö��Һ��
��Һ�ԡ��Ⱦ
��ҩմ��Ⱦ
��ҵ���ѧ��
*/

    $no=0;

    $aCode = array("����");
    $aDetail  = array("��¡��");
    $aMCprice  = array("�Ҥ� ");

    $aCode[1] = "elect";
    $aDetail[1]  = "���俿��";
    $aMCprice[1]  = $electric;

    $aCode[2] = "phone";
    $aDetail[2]  = "������Ѿ��";
    $aMCprice[2]  = $phone;

    $aCode[3] = "loss";
    $aDetail[3]  = "�������ػ�ó��������";
    $aMCprice[3]  = $loss;

    $aCode[4] = "ambulance";
    $aDetail[4]  = "���ö��Һ��";
    $aMCprice[4]  = $ambulance;

    $aCode[4] = "food";
    $aDetail[4]  = "�������íҵԼ�����";
    $aMCprice[4]  = $food;

    $aCode[5] = "death";
    $aDetail[5]  = "��Һ�ԡ��Ⱦ";
    $aMCprice[5]  = $death;

    $aCode[6] = "preserve";
    $aDetail[6]  = "��ҩմ��Ⱦ";
    $aMCprice[6]  = $preserve;

    $aCode[7] = "robe";
    $aDetail[7]  = "��ҵ���ѧ��";
    $aMCprice[7]  = $robe;
	
	// ��Ǩ�ͺ�����ŵ�ҧ�
	if(empty($_POST['electric']) 
	AND empty($_POST['phone']) 
	AND empty($_POST['loss']) 
	AND empty($_POST['ambulance']) 
  AND empty($_POST['food']) 
	AND empty($_POST['death']) 
	AND empty($_POST['preserve']) 
	AND empty($_POST['robe'])){
		echo '��سҡ�͡��Һ�ԡ��<br>';
		echo '<a href="#" onclick="window.history.back();">��ԡ�����</a> ���͡�Ѻ�˹�ҡ�͡������';
		exit;
	}
	
	$sql = "SELECT `an`,`date`,`price` FROM `ipacc` 
	WHERE `an` = '$cAn' 
	AND `date` LIKE '$th_date%' 
	AND `detail` = '���俿��'";
	$q = mysql_query($sql);
	$r_ipacc = mysql_num_rows($q);
	$ipacc = mysql_fetch_assoc($q);
	
    $NetMcpri=0;
    $item=0;
    FOR ($no=1; $no<=7; $no++){
		IF ($aMCprice[$no] > 0) {
			
			// ������äԴ����
			if($no == 1 && $r_ipacc > 0){
				continue;
			}
			
			$NetMcpri=$NetMcpri+$aMCprice[$no];
			$item++;
		}
    }
	
	if($NetMcpri == 0 && $r_ipacc > 0){
		echo '�ա�äԴ��������� '.$ipacc['date'].' ( '.$ipacc['price'].'�ҷ ) ���º��������';
		exit;
	}
	
	
       //insert data into depart
       $query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,
                    idname,diag,accno)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','WARD','$item','��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��',
                    '$NetMcpri','$sOfficer','$cDiag','$cAccno');";
       $result = mysql_query($query) or die("Query failed,cannot insert into depart");
       $idno=mysql_insert_id();

FOR ($no=1; $no<=7; $no++){
   IF ($aMCprice[$no] > 0) {
	   
		if($no == 1 && $r_ipacc > 0){
			echo "$aDetail[$no] $aMCprice[$no] �ҷ (�¤Դ�������������������ѹ��� ".$ipacc['date'].")<br>";
			continue;
		}
	   
//       echo "$aCode[$no] <br>";
         echo "$aDetail[$no]  $aMCprice[$no] �ҷ <br>";
//       echo "$aMCprice[$no] <br>";

       //insert data into ipacc
       $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno)VALUES('$Thidate','$cAn','$aCode[$no]','WARD','$aDetail[$no]',
                    '1','$aMCprice[$no]','$sOfficer','MC','$cAccno','$idno');";
       $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");

       //insert data into patdata
       $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno)
                                 VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','MC','$aDetail[$no]','',
                                 '$aMCprice[$no]','WARD','MC','$idno');";
      $result = mysql_query($query) or die("Query failed,cannot insert into patdata");
	    	}
}
////////////////

          print "<br>�ѹ�֡���������º���� <br>";
          print "�Դ˹�ҵ�ҧ���  <br>";

		  
  include("unconnect.inc");

    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");
    session_unregister('cDate');
//  session_unregister('cBedcode');
//  session_unregister('Bedcode');
    session_unregister('cBed');
    session_unregister('cPtname');
    session_unregister('cAge');
    session_unregister('cPtright');
    session_unregister('cDoctor');
    session_unregister('cHn');
    session_unregister('cAn');
    session_unregister('cDiag');
    session_unregister('cBedpri');
    session_unregister('cChgdate');
    session_unregister('cBedname');
    session_unregister('cAccno');
////
?>