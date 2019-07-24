<?php
session_start();
if (!isset($sIdname)){ exit(); } //for security

if($cPtname == "" || $cHn == "" || $cDoctor == "" || $cDepart==""){
    echo "�����¤�Ѻ�к��դ����Դ��Ҵ��硹��� ��سһԴ������ç��Һ����зӡ������к������Ѻ";
    exit();
}

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
    if ( !empty($aDgcode[$n]) ){
        $item++;
    }
}

include("connect.inc");

//�Ţ LAB
$query = "SELECT * FROM runno WHERE title = 'nid_c'";
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
$nNid=$row->runno;
$fNid=$row->prefix;
$today = date("Y-m-d"); 

$nRunno=$fNid.''.$nNid;
$cPart='nid';

//insert data into depart
$thidate5 = (date("Y")+543).date("-m-d H:i:s"); 
$query = "INSERT INTO medicalcertificate (thidate,number,hn,part,doctor)VALUES(' $thidate5','$nRunno','$cHn','$cPart','$cDoctor');";
$result = mysql_query($query) or die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>");

$dateNow = date('Y-m-d');
$sql = "SELECT * FROM `medicalcertificate` 
WHERE `hn` = '$cHn' 
AND `part` = '$cPart' 
AND ( `date_start` <= '$dateNow' AND `date_start` IS NOT NULL ) 
AND ( `date_end` >= '$dateNow' AND `date_end` IS NOT NULL ) ";
$q = mysql_query($sql) or die( mysql_error() );
$rows = mysql_num_rows($q);

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



$cDoctor1 = substr($cDoctor,5,50);
// ��ҹ�˹�Ҵ��� NID ���Ѵ�͡
if( preg_match('/NID\s/',$cDoctor, $matchs) > 0 ){
    $cDoctor1 = str_replace('NID ','',$cDoctor);
}

$cDoctor2 = substr($cDoctor,0,5);

/*if($cDoctor2=='MD054'){$doctorcode='�.13553';}else
if($cDoctor2=='MD052'){$doctorcode='�.14286';}else
if($cDoctor2=='MD037'){$doctorcode='�.10212';}else
if($cDoctor2=='MD089'){$doctorcode='�.32166';}else{$doctorcode='';};*/


$Thaidate1=substr($Thaidate,0,10);
$licen = '';

// ᾷ��Ἱ�չ
if( $cDoctor2 === 'MD115' ){

    $subDoctor = (int) $_GET['subDoctor'];
    if( $subDoctor === 1 ){
        $yot = '���';
        $cDoctor1 = '�Ҥ���� ���ط��ǧ��';
        $doctorcode = '��. 714';
    }else if( $subDoctor === 2 ){
        $yot = '�.�.';
        $cDoctor1 = "����� �����ѵ��";
        $doctorcode = "��. 819";
    }else if( $subDoctor === 3 ){
        $yot = '�.�.';
        $cDoctor1 = "�ѹ¡� ��ࡵ�";
        $doctorcode = "��. 907";
    }else if( $subDoctor === 4 ){
        $yot = '���';
        $cDoctor1 = "����Ե�� ����";
        $doctorcode = "��. 1254";
    }

    $position = "ᾷ��Ἱ�չ";
    $certificate = "�͹حҵ��Сͺ�ä��Ż� �Ңҡ��ᾷ��Ἱ�չ";
    $licen = "$position $doctorcode";
    
}else{
    $sql = "select * from doctor where name like '%$cDoctor1%'";
    $query = mysql_query($sql);
    $rows = mysql_fetch_array($query);
    $yot = $rows["yot"];
	if($rows["name"]=="MD128 �Ҥ���� ���ط��ǧ��" || $rows["name"]=="MD129 ����� �����ѵ��" || $rows["name"]=="MD151 �ѹ¡� ��ࡵ�" || $rows["name"]=="MD163 ����Ե�� ����"){
        
        $doctorcode = "��. ".$rows["doctorcode"];
        $position = "ᾷ��Ἱ�չ";
        $certificate = "�͹حҵ��Сͺ�ä��Ż� �Ңҡ��ᾷ��Ἱ�չ";

	}else{

        $doctorcode = "�. ".$rows["doctorcode"];
        $position = "ᾷ���Ш��ç��Һ�Ť�������ѡ��������";
        $certificate = "�͹حҵ��Сͺ�Ҫվ�Ǫ����";

	}

}



$date_log = date('Y-m-d H:i:s');
$dt_log = "{\"yot\":\"$yot\",\"name\":\"$cDoctor1\",\"code\":\"$doctorcode\"}";
$log = "INSERT INTO `medicalcertificate`
(`thidate`,
`hn`,
`part`,
`doctor`)
VALUES
('$date_log',
'$cHn',
'$cPart',
'$dt_log');\n\n";
file_put_contents('logs/doctor-cert.log', $log, FILE_APPEND);

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

function test_diag($str, $diags){
    foreach ($diags as $key => $lc) {
        $test_pos = strpos($str, $lc);
        if( $test_pos !== false ){
            return true;
        }
    }
    return false;
}

$inList = test_diag($cDiag, $diag_list);

print "<font face='Angsana New' size ='3'>��������������ѡ�Ҵ��¡�ýѧ���&nbsp;&nbsp;&nbsp;";

if( $cDoctor2 == 'MD037' 
OR $cDoctor2 == 'MD054' 
OR $cDoctor2 == 'MD089' 
OR $cDoctor2 == 'MD115' 
OR $cDoctor2 == 'MD128' 
OR $cDoctor2 == 'MD129' 
OR $cDoctor2 == 'MD116' 
OR $cDoctor2 == 'MD130' 
OR $cDoctor2 == 'MD151' ){

    if( $inList === true ){
        print '���� ��鹿����ö�Ҿ��ҧ���';
    }else{
        // ������ä����价�������� list
        print '���� �ӺѴ�ä';
    }
    
    print "<br>";
    if( $showStart > 0 && ( $date_start_th !== false && $date_end_th !== false ) ){
        echo "������ѹ���&nbsp;&nbsp;$txt_date_start&nbsp;&nbsp;�֧&nbsp;&nbsp;$txt_date_end ";
    }
    // else{
    //     echo "������ѹ���................................................�֧................................................";
    // }
    
}else{
    print "����................................................";
}
print "<br><br>";

// ����Ҩ���������������ֻ���������Ѻ��õ���ԡ
$auto_name = ( isset($_GET['auto']) && $_GET['auto'] == 1 ) ? 1 : 0 ;
if( $auto_name > 0 ){
    print "<font face='Angsana New' size ='3'><CENTER>ŧ����&nbsp;$yot&nbsp;$cDoctor1&nbsp;&nbsp;&nbsp;ᾷ�����Ǩ<BR></CENTER>";
}else{
    print "<font face='Angsana New' size ='3'><CENTER>ŧ����&nbsp;$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ᾷ�����Ǩ<BR></CENTER>";
}

// if( $cDoctor2 !== 'MD115' AND $cDoctor2 !== 'MD037' AND $cDoctor2 !== 'MD054' AND $cDoctor2 !== 'MD089' ){
    print "<font face='Angsana New' size ='3'><CENTER>(&nbsp;$cDoctor1&nbsp;)</CENTER>"; 
// }

// print "<font face='Angsana New' size ='3'><CENTER>$position&nbsp;$doctorcode</CENTER>"; 
print "<font face='Angsana New' size ='3'><CENTER>$licen</CENTER>"; 

$nNid++;
$query ="UPDATE runno SET runno = $nNid WHERE title='nid_c'";
$result = mysql_query($query) or die("Query failed");
