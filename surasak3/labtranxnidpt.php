<body Onload="">
<?php
session_start();
if (isset($sIdname)){} else {die;} //for security

if($cPtname == "" || $cHn == "" || $cDoctor == "" || $cDepart==""){
    echo "�����¤�Ѻ�к��դ����Դ��Ҵ��硹��� ��سһԴ������ç��Һ����зӡ������к������Ѻ";
    exit();
}

$code = isset($_GET['code']) ? trim($_GET['code']) : false ;

// ���͡�ѹ����������Ǩ �������ش
$date_start_th = ( isset($_SESSION['date_start']) && !empty($_SESSION['date_start']) ) ? $_SESSION['date_start'] : false ;
$date_end_th =  ( isset($_SESSION['date_end']) && !empty($_SESSION['date_start']) ) ? $_SESSION['date_end'] : false ;

$thaimonthFull = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');
                    
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	
//item count
$item=0;
for ($n=1; $n<=$x; $n++){
    if(!empty($aDgcode[$n])){
        $item++;
    }
}

include("connect.inc");

//�Ţ LAB
$query = "SELECT * FROM runno WHERE title = 'nid_pt'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
    if(!($row = mysql_fetch_object($result)))
    continue;
}

//  	    $cTitle=$row->title;  //=VN
$nNid = $row->runno;
$fNid = $row->prefix;
$today = date("Y-m-d"); 


$nRunno = $nNid.''.$fNid;


$sql = "SELECT `depart` FROM `labcare` WHERE `code` = '$code'";
$q = mysql_query($sql);
$lab = mysql_fetch_assoc($q);

$cPart = $lab['depart']; // �ԧ��� labcare

// �ѹ�֡�����š���ѡ��
$thidate5 = (date("Y")+543).date("-m-d H:i:s"); 
$query = "INSERT INTO medicalcertificate  (thidate,number,hn,part,doctor)VALUES(' $thidate5','$nRunno','$cHn','$cPart','$cDoctor');";
$result = mysql_query($query) or die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>");

$dateNow = date('Y-m-d');
$sql = "SELECT * FROM `medicalcertificate` 
WHERE `hn` = '$cHn' 
AND `part` = '$cPart' 
AND ( `date_start` <= '$dateNow' AND `date_start` IS NOT NULL ) 
AND ( `date_end` >= '$dateNow' AND `date_end` IS NOT NULL ) ";
// echo "<pre>";
// var_dump($sql);
$q = mysql_query($sql) or die( mysql_error() );
$rows = mysql_num_rows($q);
// var_dump($rows);
$showStart = 0;

// ����ѧ����բ������ѹ����������Ǩ ����ѹ�������ش
if( $rows == 0 && $date_start_th !== false && $date_end_th !== false ){
    list($sy, $sm, $sd) = explode('-', $date_start_th);
    list($ey, $em, $ed) = explode('-', $date_end_th);
    
    $txt_date_start = $sd.' '.$thaimonthFull[$sm].' '.$sy;
    $txt_date_end = $ed.' '.$thaimonthFull[$em].' '.$ey;
    
    $date_start = ( $sy - 543 )."-$sm-$sd";
    $date_end = ( $ey - 543 )."-$em-$ed";
    
    $sql = "UPDATE `medicalcertificate` 
    SET `date_start` = '$date_start', `date_end` = '$date_end' 
    WHERE `number` = '$nRunno' ";
    mysql_query($sql);
    $showStart = 1;
    
    $_SESSION['date_start'] = null;
    $_SESSION['date_end'] = null;
}

$cDoctor1 = trim(substr($cDoctor,5,50));
$cDoctor2 = substr($cDoctor,0,5);

//
$acu = 0;
$licen = '';
if($cDoctor2 == "MD058"){
  
    // �ѹ��� �֧ �ء���繢ͧ ���Ծ� �Թ�ѹ
    $subDoctor = (int) $_GET['subDoctor'];
    if( $subDoctor === 1 ){
        $cDoctor1 = "���Ծ� �Թ�ѹ";
        $doctorcode = "��.�. 1272";
    }else if( $subDoctor === 2 ){
        $cDoctor1 = "�ѭ��Ǵ� ����ѵ��";
        $doctorcode = "��.�. 1038";
    }else if( $subDoctor === 3 ){
        $cDoctor1 = "˷���ѵ�� ��Ūԧ���";
        $doctorcode = "��.�. 2252";
    }

    $yot = "�.�.";
    $position = "ᾷ��Ἱ�»���ء��";
    $certificate = "�͹حҵ��Сͺ�ä��Ż� �Ң� ���ᾷ��Ἱ�»���ء��";
    $licen = "ᾷ��Ἱ�»���ء�� $doctorcode";
    $acu = 1;

}else{
    $sql = "select * from doctor where name like '%$cDoctor1%'";
    $query = mysql_query($sql);
    $rows = mysql_fetch_array($query);
    $yot = $rows["yot"];
    $doctorcode = "�. ".$rows["doctorcode"];
    $position = "ᾷ���Ш��ç��Һ�Ť�������ѡ��������";
    $certificate = "�͹حҵ��Сͺ�Ҫվ�Ǫ����";
}
$Thaidate1=substr($Thaidate,0,10);

list($d, $m, $y) = explode('-', $Thaidate1);
$thaiTxt = $d.' '.$thaimonthFull[$m].' '.$y;

?>
<style type="text/css">
    .clearfix:after{
        content: "";
        display: table; 
        clear: both;
    }
</style>
<script type="text/javascript">
    window.onload = function(){
        window.print();
    };
</script>
<div style="text-align: center;">
    <img  WIDTH=100 HEIGHT=100 SRC='logo.jpg'>
</div>
<div style="height: 24px;">
    <div style="float: left; padding-left: 2em;">
        <font face="Angsana New" size ="4">�Ţ���&nbsp;<?=$nRunno;?></font>
    </div>
    <div style="float: right; padding-right: 4em;">
        <font face="Angsana New" size ="4">�ѹ���&nbsp;<b><?=$thaiTxt;?></b></font>
    </div>
</div>
<div class="clearfix"></div>
<div style="text-align: center;">
    <font face='Angsana New' size ='4'>
        <B>��Ѻ�ͧ��õ�Ǩ��ҧ��¢ͧᾷ��</B>&nbsp;�ç��Һ�Ť�������ѡ�������� �ӻҧ
    </font>
</div>
<br>
<font face="Angsana New" size ="3">
    ��Ҿ��� <B><?=$yot;?>&nbsp;<?=$cDoctor1;?></B> ���˹� <?=$position;?>
    <br>
    <?=$certificate;?> �Ţ��� &nbsp;<B><?=$doctorcode;?></B><BR>
</font>
<font face="Angsana New" size ="3">
    ��ӡ�õ�Ǩ��ҧ��� &nbsp;<B><?=$cPtname;?></B> &nbsp;HN:<?=$cHn;?>  &nbsp;&nbsp;�ԹԨ�����һ������ä:&nbsp;&nbsp;<B><?=$cDiag;?></B><BR>
</font>
<?php
	  
// ���ͺ��� diag �դ�����ҹ�������ֻ���
$diag_list = array('����ġ��','����ҵ','CVA','�ҡԹ�ѹ��');
$diag_list2 = array('��Ѵ','������','�ä�ͺ�״');

function test_diag($str, $diags){
    foreach ($diags as $key => $lc) {
        $test_pos = strpos($str, $lc);
        if( $test_pos !== false ){
            return true;
        }
    }
    return false;
}

// ���������ʢͧ ��Ѵ ������ �ͺ�״ �йѺ�繡��ͺ������ع��
$inBy = test_diag($cDiag, $diag_list2);
$nid_ext = '�Ǵ�������Ф���ع��';
if( $inBy === true ){
    $nid_ext = 'ͺ�͹����ع��';
}
      
print "<font face='Angsana New' size ='3'>��������������ѡ�ҷҧᾷ��Ἱ�´��¡�� $nid_ext "; 
	  
// �����ᾷ��Ἱ��
if( $cDoctor2 === "MD058" ){
    
    // $inList = test_diag($cDiag, $diag_list);
    // if( $inList !== true ){
    //     $for_txt = '���� ��鹿����ö�Ҿ�ͧ��ҧ���';
    // }else{
    //     $for_txt = '���� ��úӺѴ�ѡ����п�鹿����ö�Ҿ�ͧ��ҧ���';
    // }
    
    // // ������������˹���
    // if( $inBy === false && $inList === false ){
    //     $for_txt = '���� ������ҡ�ûǴ';
    // }
    $for_txt = '���ͺӺѴ�ѡ���ä';
    
    // 
    echo $for_txt;
    echo "<br>";
    
    if( $showStart > 0 && ( $date_start_th !== false && $date_end_th !== false ) ){
        echo "������ѹ���&nbsp;&nbsp;$txt_date_start&nbsp;&nbsp;�֧&nbsp;&nbsp;$txt_date_end ";
    }
    // else{
    //     echo "������ѹ���................................................�֧................................................";
    // }
    print "<br><br>";
    
}else{
    print "����.............................................................................<BR>";
    print "<font face='Angsana New' size ='3'>���������........................�֧........................�.<BR><BR>";
}
      



// ����Ҩ���������������ֻ���������Ѻ��õ���ԡ
// $auto_name = ( isset($_GET['auto']) && $_GET['auto'] == 1 ) ? 1 : 0 ;
// if( $auto_name ){
//     print "<font face='Angsana New' size ='3'><CENTER>ŧ����&nbsp;&nbsp;&nbsp;$yot&nbsp;$cDoctor1&nbsp;&nbsp;&nbsp;ᾷ�����Ǩ<BR></CENTER>";
// } else {
    print "<font face='Angsana New' size ='3'><CENTER>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ŧ����&nbsp;$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ᾷ�����Ǩ<BR></CENTER>";
// }

	  
$Thaidate1=substr($Thaidate,0,10);
// if( $cDoctor2 !== "MD058" ){ //��������ᾷ��Ἱ��
    print "<font face='Angsana New' size ='3'><CENTER>(&nbsp;$cDoctor1&nbsp;)</CENTER>";
// }
 
print "<font face='Angsana New' size ='3'><CENTER>$licen</CENTER>"; 

$nNid++;
$query ="UPDATE runno SET runno = $nNid WHERE title='nid_pt'";
$result = mysql_query($query) or die("Query failed");

	    // print "<B>�����˹��仪����Թ�����ͧ���Թ</B>";  
//�����˹��
?>