<?php
include 'bootstrap.php';

$post_year = $year = '2560';
$newyear = $year-543;
$yy = substr($newyear,2,2);
$post_month = $mm = '10';

$post_credit = 'UC';

if($post_credit=="OFC"){
	$showptright="�ԡ���µç";
	$newcredit = "(ptright like '%R02%' OR ptright
    LIKE '%R03%'
    )";
}else if($post_credit=="SSS"){
	$showptright="��Сѹ�ѧ��";
	$newcredit = "ptright like '%R07%' ";
}else if($post_credit=="LGO"){
	$showptright="���µç ͻ�.";
	$newcredit = "(ptright like '%R21%' OR ptright
    LIKE '%R33%'
    )";
}else if($post_credit=="UC"){
	$showptright="��Сѹ�آ�Ҿ";
	$newcredit = "( `ptright` LIKE '%��Сѹ�آ�Ҿ%' OR `ptright` LIKE '%R35%' OR `ptright` LIKE '%R17%' OR `ptright` LIKE '%R36%' OR `ptright` LIKE '%R06%')";
}


//---------------Start Dataset16---------------//
//��������ŷ�� 16 �ҵðҹ��������š������ (DRU)
$dbname16 = "DRU".$yy.$mm.".dbf";
$def16 = array(
    array("HCODE","C",5),
    array("HN","C",15),
    array("AN","C",9),
    array("CLINIC","C",4),
    array("PERSON_ID","C",13),	  
    array("DATE_SERV","D"),	  
    array("DID","C",30), 
    array("DIDNAME","C",255),	 
    array("AMOUNT","C",12),
    array("DRUGPRIC","C",14),
    array("DRUGCOST","C",14),
    array("DIDSTD","C",24), 
    array("UNIT","C",20),	 
    array("UNIT_PACK","C",20),
    array("SEQ","C",15),
    array("DRUGREMARK","C",2),	  
    array("PA_NO","C",9),
    array("TOTCOPAY","N",7,0),	//��������  
    array("USE_STATUS","C",1),
    array("TOTAL","N",12,2),	  //��������  
    array("SIGCODE","C",50),
    array("SIGTEXT","C",255)
);

// creation
// if (!dbase_create($dbname16, $def16)) {
//   echo "Error, can't create the database16\n";
// }

        //--------------------------------- �������¼������	---------------------------------//	
$dbsql ="select * from  ipcard  
where $newcredit 
and dcdate like '".$post_year."-".$post_month."%' 
AND an = '60/2474' ";
$dbresult = mysql_query($dbsql) or die("Query ipcard failed16");
while($rowsdb = mysql_fetch_array($dbresult)){
    //$hcode16 ="11486";
    $hcode2 ="11512";
    $hn16=$rowsdb["hn"];  //  HN �����ù�����Ң�����	
    $an16=$rowsdb["an"]; //  AN �����ù�����Ң�����
    
    $newdatetime = substr($rowsdb["dcdate"],0,10);
    $datedc =explode("-",$newdatetime);
    $newdatedc=$datedc[0]-543;
    $newdcdate =$newdatedc.$datedc[1].$datedc[2];  //  DATE_SERV �����ù�����Ң�����							
                
    $sqlip ="select *, sum(price) as sumprice, sum(amount) as sumamount from  ipacc  where an='".$an16."' AND depart='PHAR' AND (part ='DDL' || part ='DDY') group by code";
    //echo $sqlip."==>";
    $resultip = mysql_query($sqlip) or die("Query ipcard failed16");
    $i=0;
    while($rowsip = mysql_fetch_array($resultip)){

        dump($rowsip);

        $i++;
        $dateip=$rowsip["date"];
        $newdateip = substr($dateip,0,10);
        //echo "$i===>$an16===>".$rowsip["code"];
        $sqldrglist="select drugcode from druglst where drugcode='".$rowsip["code"]."'";
        //echo $sqldrglist."</br>";
        $querydrglist=mysql_query($sqldrglist);
        list($drugcode16)=mysql_fetch_array($querydrglist);
        
                    
        //$drugcode16=$rowsip["code"];		
        $drugname16=$rowsip["detail"];	
        $amount16=$rowsip["sumamount"];  //  AMOUNT �ӹǹ��
        $saleprice=$rowsip["price"]/$rowsip["amount"];	//�Ҥ�/˹���	DRUGPRICE(�ҤҢ��)
        //$total=$saleprice*$rowsip["sumamount"];  //TOTAL �Ҥ�����ҷ����ԡ ���
        $total=$rowsip["sumprice"];  //TOTAL �Ҥ�����ҷ����ԡ ����
                    
        //echo "===>������:$drugcode16 ===>�Ҥ�:$saleprice==>�ӹǹ:$amount16 ===>���:$total<br>";
    
        //---------------------������Ũҡ���ҧ opday---------------------//	 	
        $sqlop ="select * from opday where an ='".$an16."' ";   //  Query ��Ң����Ũҡ���ҧ opday
        $resultop = mysql_query($sqlop) or die("Query opcard failed");
        $rowsop = mysql_fetch_array($resultop);
        $personid=$rowsop["idcard"]; //  PERSON_ID �����ù�����Ң�����	
                        
                        //CLINIC
        $clinic3=$rowsop["clinic"];
        $clinic1=0;
        $clinic2=1;
        $clinic=substr($clinic3,0,2);
        if($clinic==''){$clinic="00";} ;
        $newclinic=$clinic1.$clinic.$clinic2;  //  CLINIC �����ù�����Ң�����								

        //SEQ
        $rowidop=$rowsop["row_id"];
        $newrowid = substr($rowidop,3,4);		
        
        $vn=$rowsop["vn"];
        $newvn=sprintf('%03d',$vn);
        $newseq=$newdcdate.$newvn.$newrowid;  //  SEQ �����ù�����Ң�����		
                        
                        
        //---------------------��������Ҩҡ���ҧ druglst---------------------//					
        $sqldrx= "SELECT * FROM  druglst WHERE drugcode ='".$drugcode16."' ";
        $resultdrx = mysql_query($sqldrx) or die("Query druglst failed");
        $rowsdrx=mysql_fetch_array($resultdrx);
        $code24=$rowsdrx["code24"];    //  DIDSTD �����ù�����Ң�����
        //$saleprice=$rowsdrx["salepri"];    //  DRUGPRICE(�ҤҢ��) �����ù�����Ң�����
        $unitprice=$rowsdrx["unitpri"];    //  DRUGCOST(�Ҥҷع) �����ù�����Ң�����
        $unit=$rowsdrx["unit"];    //  DIDSTD �����ù�����Ң�����
        $packing=$rowsdrx["packing"];    //  UNIT_PACK �����ù�����Ң�����	
                            
                    

        $sql161 ="select * from  drugrx  where an='".$an16."' and drugcode ='".$drugcode16."' ";
        //echo $sql161."</br>";
        $result161 = mysql_query($sql161) or die("Query failed16");
        $num161= mysql_num_rows($result161);
        $rows161 = mysql_fetch_array($result161);	
        
        $sigcode=$rows161["slcode"];  //�����Ը�����
        
        $sqlslcode=mysql_query("select * from drugslip where slcode='".$rows161["slcode"]."'");
        $resultslcode=mysql_fetch_array($sqlslcode);
        
        $sigtext=$resultslcode["detail1"]." ".$resultslcode["detail2"]." ".$resultslcode["detail3"]." ".$resultslcode["detail4"];  //�Ը�����

                    
        // �к������˵ؼ� EA, EB, EC, ED, EE, EF
        $reason161=$rows161["reason"]; 
        $reason1=substr($reason161,0,1);
        $reasondefault1 ="00";													
                    

                    /*
                    if(($reason1 =="A" || $reason1 =="B" || $reason1 =="C" || $reason1 =="D" || $reason1 =="E" || $reason1 =="F") && $reason1 !=" "){
                    $newreason1 ="E".$reason1;

                    
                    $db16 = dbase_open($dbname16, 2);
                    if ($db16) {
                        dbase_add_record($db16, array(
                            $hcode16, //
                            $hn16, //
                            $an16, //
                            $newclinic,  //
                            $personid, //
                            $newdcdate, //
                            $drugcode16,  // drugcode
                            $drugname16,   //
                            $amount16,  //
                            $saleprice,  //
                            $unitprice,  //
                            $code24, 	 //
                            $unit, 	 //
                            $packing, 	  //
                            $newseq, 	 //
                            $newreason1, 		//																															
                            $pano,
                            $totcopay,  //�ӹǹ�Թ��� ˹����繺ҷ ���ǹ����ԡ�����
                            $use_status ,  //��Ǵ��¡����
                            $total,  //�ӹǹ�Թ��������ԡ�ͧ��¡�ù��
                            $sigcode,  //�����Ը����� (�����)
                            $sigtext		//�Ը����� (�����)								
                            ));     
                            dbase_close($db16);
                        }  //if db		
                    }else{
                        $db16 = dbase_open($dbname16, 2);
                            if ($db16) {
                                dbase_add_record($db16, array(
                                    $hcode16, //
                                    $hn16, //
                                    $an16, //
                                    $newclinic,  //
                                    $personid,  //
                                    $newdcdate, //
                                    $drugcode16,  // drugcode
                                    $drugname16,   //
                                    $amount16,  //
                                    $saleprice,  //
                                    $unitprice,  //
                                    $code24, 	 //
                                    $unit, 	 //
                                    $packing, 	  //
                                    $newseq, 	 //
                                    $reasondefault1, //																											
                                    $pano,
                                    $totcopay,  //�ӹǹ�Թ��� ˹����繺ҷ ���ǹ����ԡ�����
                                    $use_status ,  //��Ǵ��¡����
                                    $total,  //�ӹǹ�Թ��������ԡ�ͧ��¡�ù��
                                    $sigcode,  //�����Ը����� (�����)
                                    $sigtext		//�Ը����� (�����)								
                                    ));     
                                    dbase_close($db16);
                                }  //if db						
                    }  // if $reason
                    
                */ 
                }  // while
                
        }  // while	

//---------------End Dataset16---------------//

?>