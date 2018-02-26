<?php

include 'bootstrap.php';
$db = Mysql::load();

$action = input_post('action');
if( $action === 'save' ){

    $hn = input_post('hn');
    $vn = input_post('vn');
    $prefix = input_post('yot');
    $name = input_post('name');
    $surname = input_post('surname');
    $idcard = input_post('idcard');
    $address = input_post('address');
    $date_chk = input_post('date_chk');
    $yearchk = get_year_checkup();
    $ear = $_POST['ear'];
    $eye = $_POST['eye'];
    $snell_eye = $_POST['snell_eye'];
    $cxr = $_POST['cxr'];
    $conclution = $_POST['conclution'];

    $normal_suggest = $_POST['normal_suggest'];
    $normal_suggest_date = input_post('normal_suggest_date');

    $abnormal_suggest = $_POST['abnormal_suggest'];
    $abnormal_suggest_date = input_post('abnormal_suggest_date');

    $doctor = input_post('doctor');
    $officer = $_SESSION['sOfficer'];

    $res_cbc = $_POST['res_cbc'];
    $res_ua = $_POST['res_ua'];
    $res_glu = $_POST['res_glu'];
    $res_crea = $_POST['res_crea'];
    $res_chol = $_POST['res_chol'];
    $res_hdl = $_POST['res_hdl'];
    $res_hbsag = $_POST['res_hbsag'];

    $diag = input_post('diag');
    
    $sex = input_post('sex');
    $breast = '';
    if( $sex == "�" ){
        $breast = input_post('breast');
    }

    $curr_date = date('Y-m-d');
    $sql = "SELECT `id` FROM `chk_doctor` WHERE `date_chk` LIKE '$curr_date%' AND `hn` = '$hn' ";
    $db->select($sql);
    $rows = $db->get_rows();
    
    if ( $rows == 0 ) {
        
        $sql = "INSERT INTO `chk_doctor` (
            `id`, `hn`, `vn`, `prefix`, `name`, `surname`, 
            `idcard`, `address`, `date_chk`, `yearchk`, `ear`, `breast`, 
            `eye`, `snell_eye`, `cxr`, `conclution`, `normal_suggest`,
            `normal_suggest_date`, `abnormal_suggest`, `abnormal_suggest_date`, `doctor`, `officer`, 
            `res_cbc`, `res_ua`, `res_glu`, `res_crea`, `res_chol`, `res_hdl`, 
            `res_hbsag`,`diag`
        ) VALUES (
            NULL, '$hn', '$vn', '$prefix', '$name', '$surname', 
            '$idcard', '$address', NOW(), '$yearchk', '$ear', '$breast', 
            '$eye', '$snell_eye', '$cxr', '$conclution', '$normal_suggest', 
            '$normal_suggest_date', '$abnormal_suggest', '$abnormal_suggest_date', '$doctor', '$officer', 
            '$res_cbc', '$res_ua', '$res_glu', '$res_crea', '$res_chol', '$res_hdl', 
            '$res_hbsag', '$diag'
        );";
        $save = $db->insert($sql);

    }else if( $rows > 0 ){

        $up = $db->get_item();
        $id = $up['id'];

        $sql = "UPDATE `chk_doctor` SET 
        `ear` = '$ear', 
        `breast` = '$breast', 
        `eye` = '$eye', 
        `snell_eye` = '$snell_eye', 
        `cxr` = '$cxr', 
        `conclution` = '$conclution', 
        `normal_suggest` = '$normal_suggest',
        `normal_suggest_date` = '$normal_suggest_date', 
        `abnormal_suggest` = '$abnormal_suggest', 
        `abnormal_suggest_date` = '$abnormal_suggest_date',
        `doctor` = '$doctor',
        `res_cbc` = '$res_cbc', 
        `res_ua` = '$res_ua', 
        `res_glu` = '$res_glu', 
        `res_crea` = '$res_crea', 
        `res_chol` = '$res_chol', 
        `res_hdl` = '$res_hdl', 
        `res_hbsag` = '$res_hbsag',
        `diag` = '$diag'
        WHERE `id` = '$id' ; ";
        $save = $db->update($sql);

    }

    $msg = '�ѹ�֡���������º����';
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }

    redirect('chk_doctor_preprint.php?hn='.$hn.'&vn='.$vn.'&date='.$curr_date, $msg);
    exit;
}

include 'dt_menu.php';

session_unregister("list_bill");
session_register("list_bill");

$_SESSION['list_bill'] = '';
$vn = $_SESSION['vn_now']; //vn
$hn = $_SESSION['hn_now'];
$post_vn = 1;
$_SESSION['dt_doctor'] = $_SESSION['sOfficer'];

$date_now = date("Y-m-d H:i:s");
// $date_hn = date('d-m-').( date('Y') + 543 ).$hn;
$date_hn = date('Y-m-d').$hn;

$sql = "SELECT a.*, 
b.`idcard`, b.`blood`,b.`yot`,b.`name`,b.`surname`,b.`address`,b.`tambol`,b.`ampur`,b.`changwat`,b.`sex`
FROM `dxofyear_out` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`thdatehn` = '$date_hn' ";
$db->select($sql);
$opd = $db->get_item();

$cig_lists = array(0 => '����ٺ', 1 => '�ٺ', 2 => '���ٺ');
$cigok_lists = array(0 => '�����ҡ��ԡ', 1 => '��ҡ��ԡ');
$al_lists = array(0 => '������', 1 => '����', 2 => '�´���');
$drugreact_lists = array(0 => '�����', 1 => '��');

$type_lists = array('�Թ��','���ö��','�͹��','�ҵ�',);

?>
<style type="text/css">
table{
    border-collapse: collapse;
}
.chk_table{
    border-collapse: collapse;
    width: 100%;
    border: 2px solid #000000;
}
.chk_table .title{
    font-weight: bold;
    border-bottom: 2px solid #000000;
    background-color: #b9e3ae;
    text-align: center;
}

label{
    cursor: pointer;
}
.tb-title{
    font-weight: bold;
    text-align: right;
}
.tb-title:after{
    content: "\0020\003A\0020";
}
h1,h3,p{
    margin: 0;
    padding: 0;
}
</style>
<script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
<form action="chk_doctor.php" method="post" id="formSubmit">
    <h2 align="center">�ѹ�֡�ŵ�Ǩ�آ�Ҿ��Сѹ�ѧ��</h2>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>�����ż�����</h3></td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="10%" class="tb-title">����-ʡ��</td>
                        <td width="15%"><?=$opd['ptname'];?></td>
                        <td width="10%" class="tb-title">HN</td>
                        <td width="15%"><?=$opd['hn'];?></td>
                        <td width="10%" class="tb-title">VN</td>
                        <td width="15%"><?=$opd['vn'];?></td>
                        <td width="10%" class="tb-title">����</td>
                        <td width="15%"><?=$opd['age'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">�Ţ�ѵû�ЪҪ�</td>
                        <td><?=$opd['idcard'];?></td>
                        <td class="tb-title">���˹ѡ</td>
                        <td><?=$opd['weight'];?> ��.</td>
                        <td class="tb-title">��ǹ�٧</td>
                        <td><?=$opd['height'];?> ��.</td>
                        <td class="tb-title">BP</td>
                        <td><?=$opd['bp1'].'/'.$opd['bp2'];?> mmHg</td>
                    </tr>
                    <tr>
                        <td class="tb-title">T</td>
                        <td><?=$opd['temperature'];?> &#8451;</td>
                        <td class="tb-title">P</td>
                        <td><?=$opd['pause'];?> ����/�ҷ�</td>
                        <td class="tb-title">R</td>
                        <td><?=$opd['rate'];?> ����/�ҷ�</td>
                        <td class="tb-title">�������ʹ</td>
                        <td><?=$opd['blood'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">�ä��Шӵ��</td>
                        <td><?=$opd['congenital_disease'];?></td>
                        <td class="tb-title">�ٺ������</td>
                        <td>
                            <?php
                            $cig_code = $opd['cigarette'];
                            echo $cig_lists[$cig_code];

                            if( !empty($opd['cigarette']) ){
                                $cigok_code = $opd['cigok'];
                                echo ' ('.$cigok_lists[$cigok_code].')';
                            }
                            ?>
                        </td>
                        <td class="tb-title">��������</td>
                        <td>
                            <?php 
                            $al_code = $opd['alcohol'];
                            echo $al_lists[$al_code];
                            ?>
                        </td>
                        <td class="tb-title">����</td>
                        <td>
                            <?php 
                            $react_code = $opd['drugreact'];
                            echo $drugreact_lists[$react_code];
                            ?>
                        </td>
                    </tr>
                    <tr>
                    
                        <td class="tb-title">�ѡɳм�����</td>
                        <td><?=$opd['type'];?></td>
                        <td class="tb-title">�ҡ��</td>
                        <td><?=$opd['organ'];?></td>
                        <td class="tb-title">BMI</td>
                        <td>
                            <?php 
                            $ht = $opd["height"] / 100;
                            echo number_format(($_SESSION["weight"]/($ht*$ht)),2);
                            ?>
                        </td>
                        <td class=""></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="chk_table">
        <tr>
            <td class="title"><h3>�����ŷҧ��ͧ��Ժѵԡ��</h3></td>
        </tr>
        <tr>
            <td valign="top">
                <?php
                $curr_day = date('Y-m-d');

                $sql = "SELECT b.* 
                FROM `resulthead` AS a 
                    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
                WHERE a.`hn` = '$hn' 
                AND a.`clinicalinfo` LIKE '��Ǩ�آ�Ҿ%' 
                AND a.`profilecode` = 'CBC' 
                AND ( b.`labcode` = 'HB' OR b.`labcode` = 'HCT' OR b.`labcode` = 'WBC' 
                OR b.`labcode` = 'NEU' OR b.`labcode` = 'LYMP' OR b.`labcode` = 'MONO' 
                OR b.`labcode` = 'EOS' OR b.`labcode` = 'BASO' OR b.`labcode` = 'PLTC' 
                OR b.`labcode` = 'RBC' ) 
                AND a.`orderdate` LIKE '$curr_day%' 
                ORDER BY b.seq ASC";
                $db->select($sql);
                $cbc_items = $db->get_items();
                ?>
                <table width="100%">
                    <tr>
                        <th colspan="3" align="center"><b>CBC</b></th>
                    </tr>
                    <tr style="background-color: #e6e6e6;">
                        <th width="40%">��¡�õ�Ǩ</th>
                        <th width="30%">�ŵ�Ǩ</th>
                        <th width="30%">��һ���</th>
                    </tr>
                    <?php
                    $result_cbc = '';
                    foreach ($cbc_items as $key => $cbc) {
                        ?>
                        <tr>
                            <td><?=$cbc['labname'];?></td>
                            <td align="center"><?=$cbc['result'];?></td>
                            <td align="center"><?=$cbc['normalrange'];?></td>
                        </tr>
                        <?php
                        $result_cbc = $cbc['autonumber'];
                    }
                    ?>
                    <tr bgcolor="#abcea1" style="font-weight: bold;">
                        <td>�š�õ�Ǩ</td>
                        <td>
                            <label for="res_cbc">
                                <input type="radio" name="res_cbc" class="res_cbc" id="res_cbc" value="1"> ����
                            </label> 
                            <label for="res_cbc2">
                                <input type="radio" name="res_cbc" class="res_cbc" id="res_cbc2" value="2"> �Դ����
                            </label>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td valign="top">
                <?php
                $sql = "SELECT b.* 
                FROM `resulthead` AS a 
                    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
                WHERE a.`hn` = '$hn' 
                AND a.`clinicalinfo` LIKE '��Ǩ�آ�Ҿ%' 
                AND a.`profilecode` = 'UA' 
                AND ( b.`labcode` = 'SPGR' OR b.`labcode` = 'PHU' OR b.`labcode` = 'GLUU' 
                OR b.`labcode` = 'RBCU' OR b.`labcode` = 'WBCU' OR b.`labcode` = 'EPIU' 
                OR b.`labcode` = 'BLOODU' OR b.`labcode` = 'KETU' ) 
                AND a.`orderdate` LIKE '$curr_day%' ";
                $db->select($sql);
                $ua_items = $db->get_items();

                ?>
                <table  width="100%">
                    <tr>
                        <th colspan="3" align="center"><b>UA</b></th>
                    </tr>
                    <tr style="background-color: #e6e6e6;">
                        <th width="40%">��¡�õ�Ǩ</th>
                        <th width="30%">�ŵ�Ǩ</th>
                        <th width="30%">��һ���</th>
                    </tr>
                    <?php
                    $result_ua = '';
                    foreach ($ua_items as $key => $ua) {
                        ?>
                        <tr>
                            <td><?=$ua['labname'];?></td>
                            <td align="center"><?=$ua['result'];?></td>
                            <td align="center"><?=$ua['normalrange'];?></td>
                        </tr>
                        <?php
                        $result_ua = $ua['autonumber'];
                    }
                    ?>
                    <tr bgcolor="#abcea1" style="font-weight: bold;">
                        <td>�š�õ�Ǩ</td>
                        <td>
                            <label for="res_ua">
                                <input type="radio" name="res_ua" class="res_ua" id="res_ua" value="1"> ����
                            </label> 
                            <label for="res_ua2">
                                <input type="radio" name="res_ua" class="res_ua" id="res_ua2" value="2"> �Դ����
                            </label>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <?php

        $sql = "SELECT b.* 
        FROM `resulthead` AS a 
            RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
        WHERE a.`hn` = '$hn' 
        AND a.`clinicalinfo` LIKE '��Ǩ�آ�Ҿ%' 
        AND ( 
            b.`labcode` = 'GLU' 
            OR b.`labcode` = 'CREA' 
            OR b.`labcode` = 'CHOL' 
            OR b.`labcode` = 'HDL' 
            OR b.`labcode` = 'HBSAG' 
            OR b.`labcode` = 'STOCB' 
            OR b.`labcode` = '38302' 
        ) 
        AND a.`orderdate` LIKE '$curr_day%' ";

        $db->select($sql);
        $etc_rows = $db->get_rows();
        if( $etc_rows > 0 ){
            $etc_items = $db->get_items();
            ?>
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <th colspan="4" align="center"><b>��Ǩ����</b></th>
                        </tr>
                        <tr style="background-color: #e6e6e6;">
                            <th>��¡�õ�Ǩ</th>
                            <th align="center">�ŵ�Ǩ</th>
                            <th align="center">��һ���</th>
                            <th bgcolor="#abcea1">�š�õ�Ǩ</th>
                        </tr>
                        <?php
                        foreach ($etc_items as $key => $etc) {

                            $labcode = strtolower($etc['labcode']);

                            ?>
                            <tr>
                                <td><?=$etc['labname'];?></td>
                                <td align="center"><?=$etc['result'];?></td>
                                <td align="center"><?=$etc['normalrange'];?></td>
                                <td bgcolor="#abcea1" style="font-weight: bold;">
                                    <label for="res_<?=$labcode;?>">
                                        <input type="radio" name="res_<?=$labcode;?>" class="res_<?=$labcode;?>" id="res_<?=$labcode;?>" value="1"> ����
                                    </label> 
                                    <label for="res_<?=$labcode;?>2">
                                        <input type="radio" name="res_<?=$labcode;?>" class="res_<?=$labcode;?>" id="res_<?=$labcode;?>2" value="2"> �Դ����
                                    </label>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>�������آ�Ҿ</h3></td>
        </tr>
        <tr>
            <td width="25%" class="tb-title">��äѴ��ͧ������Թ</td>
            <td>
                <label for="ear1"><input type="radio" name="ear" id="ear1" value="1"> ���� </label>
                <label for="ear2"><input type="radio" name="ear" id="ear2" value="2"> �Դ���� </label>
            </td>
        </tr>
        <?php
        if( $opd['sex'] == '�' ){
        ?>
        <tr>
            <td class="tb-title">��õ�Ǩ��ҹ���ᾷ��<br>���ͺؤ�ҡ��Ҹ�ó�آ</td>
            <td>
                <label for="breast1"><input type="radio" name="breast" id="breast1" value="1"> ���� </label>
                <label for="breast2"><input type="radio" name="breast" id="breast2" value="2"> �Դ���� </label>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td class="tb-title">��õ�Ǩ���¤������Ţͧ�ѡ��ᾷ��</td>
            <td>
                <label for="eye1"><input type="radio" name="eye" id="eye1" value="1"> ���� </label>
                <label for="eye2"><input type="radio" name="eye" id="eye2" value="2"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">��õ�Ǩ�Ҵ��� Snellen eye Chart</td>
            <td>
                <label for="snell_eye1"><input type="radio" name="snell_eye" id="snell_eye1" value="1"> ���� </label>
                <label for="snell_eye2"><input type="radio" name="snell_eye" id="snell_eye2" value="2"> �Դ���� </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">Chest X-ray <a href="http://pacssrsh/explore.asp?path=/All%20Patients/InternalPatientUID=58-2733" target="_blank">�ټš�õ�Ǩ</a> </td>
            <td>
                <label for="cxr1"><input type="radio" name="cxr" class="cxr" id="cxr1" value="1"> ���� </label>
                <label for="cxr2"><input type="radio" name="cxr" class="cxr" id="cxr2" value="2"> �Դ���� </label>
            </td>
        </tr>
    </table>
    <br>
    <style type="text/css">
    .normal, .abnormal, .norm-sugges{
        display: none;
    }
    table.calendar{
        font-size: 1.2em!important;
    }
    </style>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>��ػ�š�õ�Ǩ��С�ô��Թ�ҹ</h3></td>
        </tr>
        <tr>
            <td width="25%" class="tb-title">�š�õ�Ǩ</td>
            <td>
                <label for="conclution1"><input type="radio" name="conclution" class="conclution" id="conclution1" value="1"> ���� </label>
                <label for="conclution2"><input type="radio" name="conclution" class="conclution" id="conclution2" value="2"> �Դ���� </label>
            </td>
        </tr>
        <tr class="normal">
            <td width="25%" class="tb-title" valign="top">���йӡóջ���</td>
            <td>
                <input type="radio" name="normal_suggest" class="suggest_detail cleardate" id="normal_suggest2" value="1">
                <label for="normal_suggest2" class="cleardate"> ����������й� </label>
                <br>
                <input type="radio" name="normal_suggest" class="suggest_detail"  id="normal_suggest1" value="2">
                <label for="normal_suggest1">�й�����Ѻ��õ�Ǩ������ͧ ���駵�����ѹ��� </label>
                <input type="text" name="normal_suggest_date" id="normal_suggest_date">
            </td>
        </tr>
        <tr class="abnormal" valign="top">
            <td width="25%" class="tb-title">���йӡóռԴ����</td>
            <td>
                <input type="radio" name="abnormal_suggest" class="suggest_detail cleardate" id="abs0" value="1"> <label for="abs0" class="cleardate"> ����������й� </label><br>
                <input type="radio" name="abnormal_suggest" class="suggest_detail" id="abs1" value="2"> <label for="abs1"> �����й�㹡�õ�Ǩ�Դ���/��Ǩ��� ���駵���</label><br>
                <input type="radio" name="abnormal_suggest" class="suggest_detail" id="abs2" value="3"> <label for="abs2"> �����й�����Ѻ����ѡ�ҡó��纻����¹Ѵ����Ѻ��ԡ��</label><br>
                <input type="radio" name="abnormal_suggest" class="suggest_detail" id="abs3" value="4"> <label for="abs3"> �����й�����ѡ����ѡ�ҡó������á��͹�ҡ�ä������ѧ</label><br>
                ��ѹ��� <input type="text" name="abnormal_suggest_date" id="abnormal_suggest_date">
            </td>
        </tr>
    </table>
    <br>
    <table class="chk_table">
        <tr>
            <td class="title" style="text-align: left;"><h3>�ѹ�֡����Թԩ�¨ҡᾷ��</h3></td>
        </tr>
        <tr>
            <td>
                <textarea name="diag" id="" cols="60" rows="5"></textarea>
            </td>
        </tr>
    </table>
    <br>
    <div align="center">
        <button type="submit" id="submit-btn">�ѹ�֡������</button>

        <input type="hidden" name="action" value="save">
        <input type="hidden" name="hn" value="<?=$hn;?>">
        <input type="hidden" name="vn" value="<?=$vn;?>">
        <input type="hidden" name="idcard" value="<?=$opd['idcard'];?>">
        <input type="hidden" name="doctor" value="<?=$_SESSION['dt_doctor'];?>">
        <input type="hidden" name="cbc" value="<?=$result_cbc;?>">
        <input type="hidden" name="ua" value="<?=$result_ua;?>">

        <input type="hidden" name="yot" value="<?=$opd['yot'];?>">
        <input type="hidden" name="name" value="<?=$opd['name'];?>">
        <input type="hidden" name="surname" value="<?=$opd['surname'];?>">

        <input type="hidden" name="sex" value="<?=$opd['sex'];?>">

        <?php
        $address = $opd['address'].' '.( !empty($opd['tambol']) ? '�.'.$opd['tambol'] : '' ).' '.( !empty($opd['ampur']) ? '�.'.$opd['ampur'] : '' ).' '.( !empty($opd['changwat']) ? '�.'.$opd['changwat'] : '' );
        ?>
        <input type="hidden" name="address" value="<?=$address;?>">
    </div>
</form>


<link type="text/css" href="epoch_styles.css" rel="stylesheet">
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">
    var popup1, popup2, popup3;
    window.onload = function() {
        popup1 = new Epoch('popup1','popup',document.getElementById('normal_suggest_date'),false);
        popup1 = new Epoch('popup2','popup',document.getElementById('abnormal_suggest_date'),false);
    };
</script>
<script type="text/javascript">
    $(function(){

        $(document).on('click', '#conclution1', function(){
            $('.normal').show();
            $('.abnormal').hide();

            clear_sub();
        });

        $(document).on('click', '#conclution2', function(){
            $('.normal').hide();
            $('.abnormal').show();
            
            clear_sub();
        });

        $(document).on('click', '.cleardate', function(){
            $('#normal_suggest_date').val('');
            $('#abnormal_suggest_date').val('');
            
        });

        function clear_sub(){
            $('#normal_suggest1').prop('checked', false);
            $('#normal_suggest2').prop('checked', false);
            
            $('#abs0').prop('checked', false);
            $('#abs1').prop('checked', false);
            $('#abs2').prop('checked', false);
            $('#abs3').prop('checked', false);
            
        }

        $(document).on('submit', '#formSubmit', function(){
            var res_cbc = $('.res_cbc').is(':checked');
            var res_ua = $('.res_ua').is(':checked');
            var cxr = $('.cxr').is(':checked');
            var conclution = $('.conclution').is(':checked');
            var suggest_detail = $('.suggest_detail').is(':checked');

            var res_glu = $('.res_glu').is(':checked');
            var res_crea = $('.res_crea').is(':checked');
            var res_chol = $('.res_chol').is(':checked');
            var res_hdl = $('.res_hdl').is(':checked');
            var res_hbsag = $('.res_hbsag').is(':checked');
            
            var ret_stat = true;

            if( res_cbc === false ){
                alert('��س����͡�š�õ�Ǩ CBC');
                ret_stat = false;

            }else if( res_ua === false ){
                alert('��س����͡�š�õ�Ǩ UA');
                ret_stat = false;

            }else if( res_glu === false || res_crea === false || res_chol === false || res_hdl === false || res_hbsag === false ){
                alert('��س����͡�š�õ�Ǩ����');
                ret_stat = false;

            }else if( cxr === false ){
                alert('��س����͡�š�õ�Ǩ X-Ray');
                ret_stat = false;

            }else if( conclution === false ){
                alert('��س����͡��ػ�š�õ�Ǩ�آ�Ҿ');
                ret_stat = false;

            }else if( suggest_detail === false ){
                alert('��س����͡�����й�㹡�õ�Ǩ�آ�Ҿ');
                ret_stat = false;

            }

            return ret_stat;
        });
        
    });
</script>