<?php 

/**
 * @link labtranxnid1.php ���鹩�Ѻ
 */

include 'bootstrap.php';

$action = input('action');
if( $action === 'print' ){

    $id = input('id');

    // �Ҩҡ����������¤���
    $sql = "SELECT *
    FROM `depart`
    WHERE `row_id` = '$id' ";
    $q = mysql_query($sql);
    $depart = mysql_fetch_assoc($q);

    $cHn = $depart['hn'];
    $cPtname = $depart['ptname'];
    $cDiag = $depart['diag'];
    $cDoctor = $depart['doctor'];
    $Thaidate = $depart['date'];

    $sql = "SELECT `row_id`,`yot`,`name`,`menucode`,`position`,`doctorcode` FROM `doctor` WHERE `name` = '$cDoctor' ";
    $q = mysql_query($sql);
    $doctorItem = mysql_fetch_assoc($q);
    $yot = $doctorItem['yot'];

    $Thaidate1=substr($Thaidate,0,10);

    list($y, $m, $d) = explode('-', $Thaidate1);
    $thaiTxt = $d.' '.$def_fullm_th[$m].' '.$y;

    $cDoctor1 = substr($cDoctor,5,50);
    // ��ҹ�˹�Ҵ��� NID ���Ѵ�͡
    if( preg_match('/NID\s/',$cDoctor, $matchs) > 0 ){
        $cDoctor1 = str_replace('NID ','',$cDoctor);
    }

    $cDoctor2 = substr($cDoctor,0,5);

    $licen = '';

    if( $cDoctor2 === 'MD128' ){
        $yot = '���';
        $cDoctor1 = '�Ҥ���� ���ط��ǧ��';
        $doctorcode = '��. 714';

    }else if( $cDoctor2 === 'MD129' ){
        $yot = '�.�.';
        $cDoctor1 = "����� �����ѵ��";
        $doctorcode = "��. 819";

    }else if( $cDoctor2 === 'MD151' ){
        $yot = '�.�.';
        $cDoctor1 = "�ѹ¡� ��ࡵ�";
        $doctorcode = "��. 907";

    }else if( $cDoctor2 === 'MD163' ){
        $yot = '���';
        $cDoctor1 = "����Ե�� ����";
        $doctorcode = "��. 1254";

    }

    $position = "ᾷ��Ἱ�չ";
    $certificate = "�͹حҵ��Сͺ�ä��Ż� �Ңҡ��ᾷ��Ἱ�չ";
    
    if( $doctorItem['menucode'] != 'ADMNID' ){
        $doctorcode = "�. ".$doctorItem["doctorcode"];
        $position = "ᾷ���Ш��ç��Һ�Ť�������ѡ��������";
        $certificate = "�͹حҵ��Сͺ�Ҫվ�Ǫ����";
    }

    $licen = "$position $doctorcode";

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
    
    $nNid=$row->runno;
    $fNid=$row->prefix;
    $today = date("Y-m-d"); 
    
    $nRunno=$fNid.''.$nNid;
    $cPart='nid';

    ?>

    <style type="text/css">
        .clearfix:after{
            content: "";
            display: table; 
            clear: both;
        }
        @media print{
            .noPrint{
                display: none;
            }
        }
    </style>
    <div class="noPrint">&lt;&lt;&nbsp;<a href="nid_certificate.php">��Ѻ˹���͡��Ѻ�ͧ</a></div>
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
    OR $cDoctor2 == 'MD151' 
    OR $cDoctor2 == 'MD163'){

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
    ?>
    <script type="text/javascript">
        window.onload = function(){
            window.print();
        };
    </script>
    <?php

    // $query = "INSERT INTO medicalcertificate (thidate,number,hn,part,doctor)VALUES('$Thaidate','$nRunno','$cHn','$cPart','$cDoctor');";
    // $result = mysql_query($query);

    $nNid++;
    // $query ="UPDATE runno SET runno = $nNid WHERE title='nid_c'";
    // $result = mysql_query($query) or die("Query failed");

    exit;
}


$view = input_post('view');
if($view === false){

    ?>
    <link type="text/css" href="epoch_styles.css" rel="stylesheet" />
    <script type="text/javascript" src="epoch_classes.js"></script>
    <style>
    *{
        font-family: "TH Sarabun New","TH SarabunPSK";
        font-size: 14pt;
    }
    </style>
    <div>&lt;&lt;&nbsp;<a href="../nindex.htm">��Ѻ˹����ѡ �.�.</a></div>
    <div>
        <h1>�к��͡��Ѻ�ͧ ᾷ��Ἱ�չ ��͹��ѧ</h1>
    </div>
    <form action="nid_certificate.php" method="post">
        <table>
            <tr>
                <td  align="right">HN : </td>
                <td><input type="text" name="hn" id=""></td>
            </tr>
            <tr>
                <td  align="right">�ѹ������Ѻ��ԡ�� : </td>
                <td><input type="text" name="date" id="date"></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit">�����ѹ����Ѻ��ԡ��</button>
                    <input type="hidden" name="view" value="search">
                </td>
            </tr>
        </table>
        
        <div>
        * ��þ������Ѻ�ͧ����Ф��� �Ţ�����Ѻ�ͧ�����Ţ����
        </div>
    </form>
    <script type="text/javascript">
        var popup1;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('date'),false);
        };
    </script>
    <?php

}elseif ($view === 'search') {
    
    $date = input_post('date');
    $hn = input_post('hn');

    if (empty($date) OR empty($hn)) {
        echo "��س����͡������";
        exit;
    }

    $date = ad_to_bc($date);

    $sql = "SELECT * 
    FROM `depart`
    WHERE `date` LIKE '$date%' 
    AND `hn` LIKE '$hn' 
    AND `depart` = 'NID' ORDER BY `date` DESC";

    $q = mysql_query($sql);
    if ( mysql_num_rows($q) > 0 ) {
        
        ?> 
        <style>
            *{
                font-family: "TH Sarabun New","TH SarabunPSK";
                font-size: 14pt;
            }
            .chk_table{
                border-collapse: collapse;
            }
            .chk_table th,
            .chk_table td{
                padding: 3px;
                border: 1px solid black;
            }
        </style>
        <div>&lt;&lt;&nbsp;<a href="nid_certificate.php">��Ѻ˹�Ҥ���</a></div>
        <div>
            <h3>���͡��¡�õ�Ǩ��͹��ѧ</h3>
        </div>
        <table class="chk_table">
            <tr>
                <th>�ѹ������Ѻ��ԡ��</th>
                <th>ᾷ��</th>
                <th>Diag</th>
                <th></th>
            </tr>
        <?php
        while($item = mysql_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?=$item['date'];?></td>
                <td><?=$item['doctor'];?></td>
                <td><?=$item['diag'];?></td>
                <td><a href="nid_certificate.php?id=<?=$item['row_id'];?>&action=print">�͡��Ѻ�ͧᾷ��Ἱ�չ</a></td>
            </tr>
            <?php
        }

        ?>
        </table>
        <?php

    }else{
        echo "��辺������";
    }
    
}
?>

