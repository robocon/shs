<?php 
/**
 * @link labtranxnidpt.php ���鹩�Ѻ
 */

include 'bootstrap.php';

if (!isset($_SESSION['sIdname'])){
    ?>
    <div>
        <p><a href="login_page.php">��ԡ�����</a> �����������к��ա����</p>
    </div>
    <?php
}

$action = input('action');
if($action == 'print'){

    $code = $_REQUEST['code'];
    $id = $_REQUEST['id'];
    $date = $_REQUEST['date'];

    $startDate = $_REQUEST['startDate'];
    $endDate = $_REQUEST['endDate'];

    $date_start_th = ad_to_bc($_REQUEST['startDate']);
    $date_end_th = ad_to_bc($_REQUEST['endDate']);

    $thaimonthFull = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', '05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', '09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');
    $thDateTime = (date("Y")+543).date("-m-d H:i:s"); 
    $Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $enDate = date('Y-m-d');

    $sql = "SELECT `hn`,`doctor`,`diag` FROM `depart` WHERE `row_id` = '$id' ";
    $q = mysql_query($sql);
    $dtDepart = mysql_fetch_assoc($q);
    $cDoctor = $dtDepart['doctor'];
    $cDiag = $dtDepart['diag'];
    $cHn = $dtDepart['hn'];

    //�Ţ �ǴἹ�� 
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

    $nNid = $row->runno;
    $fNid = $row->prefix;
    $nRunno = $nNid.''.$fNid;

    $qLab = mysql_query("SELECT `depart` FROM `labcare` WHERE `code` = '$code'");
    $lab = mysql_fetch_assoc($qLab);
    $cPart = $lab['depart']; // �ԧ��� labcare 


    $sql = "SELECT * FROM `medicalcertificate` WHERE `hn` = '$cHn' AND `part` = '$cPart' AND `thidate` LIKE '$date%' ";
    $qMed = mysql_query($sql);
    if ( mysql_num_rows($qMed) === 0 ) {
        mysql_query("INSERT INTO `medicalcertificate` (`thidate`,`number`,`hn`,`part`,`doctor`)VALUES('$thDateTime','$nRunno','$cHn','$cPart','$cDoctor');");
    }

    $showStart = 0;
    if( !empty($startDate) && !empty($endDate) ){
        $showStart = 1;
    }

    $cDoctor1 = trim(substr($cDoctor,5,50));
    $cDoctor2 = substr($cDoctor,0,5);

    $acu = 0;
    $licen = '';
    
    if($cDoctor2 == "MD058" || $cDoctor2 == 'MD155' || $cDoctor2 == 'MD156' || $cDoctor2 == 'MD157'){
    
        // �ѹ��� �֧ �ء���繢ͧ ���Ծ� �Թ�ѹ
        if( $cDoctor2 == 'MD156' ){
            $cDoctor1 = "�Ѩ��� �Ǵ����";
            $doctorcode = "��.�. 2556";

        }else if( $cDoctor2 == 'MD157' ){
            $cDoctor1 = "�ѭ��Ǵ� ����ѵ��";
            $doctorcode = "��.�. 1038";

        }else if( $cDoctor2 == 'MD155' ){
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
    if( $cDoctor2 === "MD058"  || $cDoctor2 == 'MD155' || $cDoctor2 == 'MD156' || $cDoctor2 == 'MD157'){
        
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
        
        echo $for_txt;
        echo "<br>";
        
        if( $showStart > 0 && ( $date_start_th !== false && $date_end_th !== false ) ){ 

            list($sy, $sm, $sd) = explode('-', $date_start_th);
            list($ey, $em, $ed) = explode('-', $date_end_th);
            
            $txt_date_start = $sd.' '.$thaimonthFull[$sm].' '.$sy;
            $txt_date_end = $ed.' '.$thaimonthFull[$em].' '.$ey;

            echo "������ѹ���&nbsp;&nbsp;$txt_date_start&nbsp;&nbsp;�֧&nbsp;&nbsp;$txt_date_end ";
        }
        print "<br><br>";
        
    }else{
        print "����.............................................................................<BR>";
        print "<font face='Angsana New' size ='3'>���������........................�֧........................�.<BR><BR>";
    }
    
    print "<font face='Angsana New' size ='3'><CENTER>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ŧ����&nbsp;$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ᾷ�����Ǩ<BR></CENTER>";

    $Thaidate1=substr($Thaidate,0,10);
    print "<font face='Angsana New' size ='3'><CENTER>(&nbsp;$cDoctor1&nbsp;)</CENTER>";
    print "<font face='Angsana New' size ='3'><CENTER>$licen</CENTER>"; 

    ?>
    <script type="text/javascript">
        window.onload = function(){
            window.print();
        };
    </script>
    <?php

    $nNid++;
    $query ="UPDATE runno SET runno = $nNid WHERE title='nid_pt'";
    $result = mysql_query($query) or die("Query failed");

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
        <h1>�к��͡��Ѻ�ͧ ᾷ��Ἱ�� ��͹��ѧ</h1>
    </div>
    <form action="pt_certificate.php" method="post">
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
        echo "��سҡ�͡���������ú��ǹ";
        exit;
    }

    $date = ad_to_bc($date);

    $sql = "SELECT a.`row_id`,a.`date`,a.`doctor`,a.`staf_massage`,a.`diag`, b.`code` 
    FROM `depart` AS a 
    LEFT JOIN `patdata` AS b ON b.`idno` = a.`row_id` 
    WHERE a.`date` LIKE '$date%' 
    AND a.`hn` LIKE '$hn' 
    AND a.`depart` = 'PHYSI' 
    AND a.`staf_massage` IS NOT NULL 
    AND b.`code` LIKE '58%'
    ORDER BY a.`date` DESC";

    $q = mysql_query($sql);
    if ( mysql_num_rows($q) > 0 ) {
        
        ?> 
        <link type="text/css" href="epoch_styles.css" rel="stylesheet" />
        <script type="text/javascript" src="epoch_classes.js"></script>
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
            p{
                margin: 0;
            }
        </style>
        <div>&lt;&lt;&nbsp;<a href="pt_certificate.php">��Ѻ˹�Ҥ���</a></div>
        <div>
            <h3>���͡��¡�õ�Ǩ��͹��ѧ</h3>
        </div>
        <table>
        <?php
        $i = 1;
        $startItems = array();
        $endItems = array();
        $onLoad = '';
        while($item = mysql_fetch_assoc($q)) { 

            $id = $item['row_id'];

            array_push($startItems, 'startDate'.$i );
            array_push($endItems, 'endDate'.$i );

            $onLoad .= "startDate$i = new Epoch('startDate$i','popup',document.getElementById('startDate$i'),false);";
            $onLoad .= "endDate$i = new Epoch('endDate$i','popup',document.getElementById('endDate$i'),false);";

            ?>
            <tr>
                <td>
                <form action="pt_certificate.php" method="post">
                    <fieldset>
                        <legend><b>�ѹ����Ѻ��ԡ�� : </b><?=$item['date'];?> </legend>
                        <p><b>ᾷ�� : </b><?=$item['doctor'];?></p>
                        <p><b>���Ǵ : </b><?=$item['staf_massage'];?></p>
                        <p><b>Diag : </b><?=$item['diag'];?></p>
                        <p><b>�ѹ�������� : </b><input type="text" name="startDate" id="startDate<?=$i;?>"> <b>�ѹ�������ش : </b><input type="text" name="endDate" id="endDate<?=$i;?>"></p>
                        <p><button type="submit">��ŧ</button></p>
                        <input type="hidden" name="id" value="<?=$id;?>">
                        <input type="hidden" name="action" value="print">
                        <input type="hidden" name="date" value="<?=$date;?>">
                    </fieldset>
                </form>
                </td>
            </tr>
            <?php 
            $i++;
        }

        $preStart = 'var '.implode(',',$startItems).';';
        $preEnd = 'var '.implode(',',$endItems).';';

        ?>
        </table>
        <script type="text/javascript">
        <?=$preStart;?><?=$preEnd;?>
            window.onload = function() {
                <?=$onLoad;?>
            };
        </script>
        <?php

    }else{
        echo "��辺������";
    }
    
}
?>