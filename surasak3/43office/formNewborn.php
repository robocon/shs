<?php 

include '../bootstrap.php';
include 'libs/functions.php';
if( empty($_SESSION['sIdname']) ){
    redirect('../login_page.php','���ͼ����ҹ���١��ͧ');
    exit;
}

$db = Mysql::load();
$action = input_post('action');
if($action === 'save'){

    include '../includes/JSON.php';
    
    $motherId = input_post('motherId');
    $mpid = input_post('motherHn');
    $idcard = input_post('idcard');
    $bhosp = $hospcode = '11512';
    $garvida = input_post('gravida');
    $ga = input_post('ga');
    $bdate = input_post('dateBorn');
    $btime = input_post('timeBorn');

    $bdate = bc_to_ad($bdate);
    $bdate = str_replace('-','', $bdate);

    $btime = str_replace('.','', $btime);
    $btime = $btime.'00';

    $bplace = input_post('bplace'); //ʶҹ����Դ
    $birthno = input_post('birthNo');
    $btype = input_post('btype');
    $bdoctor = input_post('bdoctor');
    $bweight = input_post('weight');
    $asphyxia = input_post('asphyxia');
    $vitk = input_post('vitk');
    $tsh = input_post('tsh');
    $tshresult = input_post('thyroidResult');
    $d_update = date('YmdHis');

    $date_visit = input_post('date_visit');
    $date_visit = bc_to_ad($date_visit);

    $hn = input_post('hn');
    $an = input_post('an');
    $owner = $_SESSION['sIdname'];
    
    // 43newborncare
    $bcare = date('Ymd', strtotime($date_visit));
    $bcareresult = input_post('disorder');
    $food = input_post('food');
    $seq = genSEQ($date_visit, $hn);
    $provider = input_post('provider');

    $father = input_post('father');
    $father_id = input_post('fatherId');
    $mother = input_post('mother');
    $lborn = input_post('lborn');
    $head = input_post('head');
    $breast = input_post('breast');
    $apgar5 = input_post('apgar5');
    $apgar10 = input_post('apgar10');
    $disorder = input_post('disorder');
    $disorderDetail = input_post('disorderDetail');
    $health = input_post('health');
    $healthDetail = input_post('healthDetail');
    $pku = input_post('pku');
    $pku_result = input_post('pku_result');
    $bcgDate = input_post('bcgDate');
    $hbDate = input_post('hbDate');
    $discharge = input_post('discharge');
    $weight_discharge = input_post('weightDischarge');
    $ipcard_id = input_post('ipcard_id');

    $msg = "�ѹ�֡���������º����";

    $sql = "INSERT INTO `gyn_newborn` (
        `id`, `HOSPCODE`, `PID`, `MPID`, `GRAVIDA`, `GA`, 
        `BDATE`, `BTIME`, `BPLACE`, `BHOSP`, `BIRTHNO`, `BTYPE`, 
        `BDOCTOR`, `BWEIGHT`, `ASPHYXIA`, `VITK`, `TSH`, `TSHRESULT`, 
        `D_UPDATE`, `date_visit`, `date_added`, `hn`, `an`, `father`, 
        `father_id`, `mother`, `mother_id`, `lborn`, `head`, `breast`, `apgar5`, 
        `apgar10`, `disorder`, `disorderDetail`, `health`, `healthDetail`, `pku`, `pku_result`, 
        `bcgDate`, `hbDate`, `discharge`, `weight_discharge`, `owner`
    ) VALUES (
        NULL, '$hospcode', '$hn', '$mpid', '$garvida', '$ga', 
        '$bdate', '$btime', '$bplace', '$bhosp', '$birthno', '$btype', 
        '$bdoctor', '$bweight', '$asphyxia', '$vitk', '$tsh', '$tshresult', 
        '$d_update', '$date_visit', NOW(), '$hn', '$an', '$father', 
        '$father_id', '$mother', '$motherId', '$lborn', '$head', '$breast', '$apgar5', 
        '$apgar10', '$disorder', '$disorderDetail', '$health', '$healthDetail', '$pku', '$pku_result', 
        '$bcgDate', '$hbDate', '$discharge', '$weight_discharge', '$owner' 
    );";
    $save = $db->insert($sql);
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    $sql = "INSERT INTO `43newborn` ( 
        `id`, `HOSPCODE`, `PID`, `MPID`, `GRAVIDA`, `GA`, 
        `BDATE`, `BTIME`, `BPLACE`, `BHOSP`, `BIRTHNO`, `BTYPE`, 
        `BDOCTOR`, `BWEIGHT`, `ASPHYXIA`, `VITK`, `TSH`, `TSHRESULT`, 
        `D_UPDATE`,`CID`, `date_visit`, `date_added`, `an`, 
        `owner` 
        ) 
    VALUES (
        NULL, '$hospcode', '$hn', '$mpid', '$garvida', '$ga', 
        '$bdate', '$btime', '$bplace', '$bhosp', '$birthno', '$btype', 
        '$bdoctor', '$bweight', '$asphyxia', '$vitk', '$tsh', '$tshresult', 
        '$d_update', '$idcard', '$date_visit', NOW(), '$an', 
        '$owner' 
    );";
    $save = $db->insert($sql);
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    $sql = "INSERT INTO `43newborncare` (
        `id`, `HOSPCODE`, `PID`, `SEQ`, `BDATE`, `BCARE`, 
        `BCPLACE`, `BCARERESULT`, `FOOD`, `PROVIDER`, `D_UPDATE`,
        `CID`
    ) VALUES (
        NULL, '$hospcode', '$hn', '$seq', '$bdate', '$bcare', 
        '$hospcode', '$bcareresult', '$food', '$provider', '$d_update',
        '$idcard'
    );";
    $save = $db->insert($sql);
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }


    $policy_item = array(
        'HOSPCODE' => $hospcode, 
        'PID' => $hn, 
        'BDATE' => $bdate, 
        'HC' => number_format($head,1)
    );

    $json = new Services_JSON();
    $policy_data = $json->encode($policy_item);

    $sql = "INSERT INTO `43policy` ( 
        `id`, `hospcode`, `policy_id`, `policy_year`, `policy_data`, 
        `d_update`, `opday_id`, `last_update` 
    ) VALUES ( 
        NULL, '$hospcode', '001', '2017', '$policy_data', 
        '$d_update', '$ipcard_id', NULL 
    );";
    $save = $db->insert($sql);
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    redirect('formNewborn.php', $msg);
    exit;
}

include 'head.php';

$apgarList = array(
    0 => 0,1,2,3,4,5,6,7,8,9,10,
    99 => '����Һ'
);

$gravidaList = array(1 => 1,2,3,4,5,6,7,8,9,10);

?>
<fieldset>
    <legend>���Ң����ŵ�� AN</legend>
    <form action="formNewborn.php" method="post">
        <div>
            AN ��ô� : <input type="text" name="an" id="an">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="page" value="searchAn">
        </div>
    </form>
</fieldset>
<script>
window.onload = function(){
    document.getElementById("an").focus();
}
</script>

<?php 
$page = input_post('page');
if( $page === 'searchAn' ){ 

    $an = input_post('an');
    $sql = "SELECT * FROM `ipcard` WHERE `an` = '$an'";
    $db->select($sql);

    if( $db->get_rows() > 0 ){
        $ipcard = $db->get_item();
        
        $hn = $ipcard['hn'];
        list($dcdate, $dctime) = explode(' ', $ipcard['dcdate']);

        $db->select("SELECT * FROM `opcard` WHERE `hn`= '$hn'");
        $opcard = $db->get_item();

        // if( $opcard['yot'] == '�.�.' ){
        //     $sex = '1';
        // }elseif ( $opcard['yot'] == '�.�.' ) {
        //     $sex = '2';
        // }
        
        $address = $opcard['address'].' �.'.$opcard['tambol'].' �.'.$opcard['ampur'].' �.'.$opcard['changwat'];

        ?>
        <fieldset>
            <legend>���������ͧ���ѹ������Ѻ��ԡ��</legend>
            <table>
                <tr>
                    <td><b>AN : </b><?=$ipcard['an'];?> <b>HN : </b><?=$ipcard['hn'];?> <b>����-ʡ�� : </b><?=$ipcard['ptname'];?></td>
                </tr>
                <tr>
                    <td><b>�ѹ����Ѻ��ԡ�� : </b><?=$ipcard['date'];?></td>
                </tr>
            </table>
        </fieldset>
        <form action="formNewborn.php" method="post">
            <fieldset>
                <legend>�����ž�鹰ҹ</legend>
                <table>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">����ʡ�źԴ� : <input type="text" name="father" id="" value=""></span>
                            <span class="sRow">ID : <input type="text" name="fatherId" size="12"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">����ʡ����ô� : <input type="text" name="mother" id="" value="<?=trim($ipcard['ptname']);?>"></span>
                            <span class="sRow">ID : <input type="text" name="motherId" id="motherId" class="important" size="12" value="<?=$opcard['idcard'];?>"></span>
                            <input type="hidden" name="motherHn" value="<?=$ipcard['hn'];?>">
                            <!-- <button type="button" id="checkMId">��Ǩ�ͺ</button> -->
                            <!-- <span class="sRow"> HN ��ô� : <input type="text" name="motherHn" id="motherHn"></span> -->
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">�ѹ�֡��á�á�Դ : <input type="radio" name="prefix" id="prefix1" value="�.�." <?=($sex==1?'checked="checked"':'');?> > <label for="prefix1">�.�.</label> 
                            <input type="radio" name="prefix" id="prefix2" value="�.�." <?=($sex==2?'checked="checked"':'');?>> <label for="prefix2">�.�.</label></span>

                            <span class="sRow">����-ʡ�� : <input type="text" name="name" id="name"></span>
                            <span class="sRow">ID : <input type="text" name="idcard" id="idcard" size="12"></span>

                            HN : <input type="text" name="findHN" id="findHN" size="6"> <button type="button" id="checkMId">��Ǩ�ͺ�ҡHN</button>

                            <input type="hidden"  name="hn" id="hn" value="">
                            <input type="hidden" name="an" id="ptAN" value="">
                            <input type="hidden" name="sex" id="sex" value="">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">������� : <input type="text" name="address" id="" value="<?=$address;?>" size="40"></span>
                            <span class="sRow">�����÷��Դ����� : <input type="text" name="phone" id="" value="<?=$opcard['phone'];?>"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">Ǵ�.�Դ : <input type="text" name="dateBorn" class="important" id="dateBorn" value=""></span>
                            <span class="sRow">���� : <input type="text" name="timeBorn" class="important" id="" size="10"> �.</span>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>�����š�ä�ʹ</legend>
                <table>
                    <tr>
                        <td class="tdRow">
                            <!-- LABOR -->
                            <span class="sRow">������� : <select name="gravida">
                            <?php 
                                foreach ($gravidaList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                            ?>
                            </select></span>
                            
                            <span class="sRow">���ؤ���� : <input type="text" name="ga" class="important" size="3">�ѻ����</span>

                            <!-- LABOR -->
                            <span class="sRow">����� : <select name="lborn" id="">
                            <?php 
                                foreach ($gravidaList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                            ?>
                            </select></span>

                            <!-- LABOR -->
                            <span class="sRow">ʶҹ��� : <select name="bplace" id="">
                            <?php 
                            $db->select("SELECT * FROM `f43_labor_182_newborn_187`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select></span>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <!-- LABOR -->
                            <span class="sRow">
                                �Ըա�ä�ʹ : <select name="btype" id="">
                                    <?php 
                                    $db->select("SELECT * FROM `f43_labor_184_newborn_190`");
                                    $bdoctorLists = $db->get_items();
                                    foreach ($bdoctorLists as $key => $bdoc) {
                                        ?>
                                        <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </span>

                            <span class="sRow">
                                ���������Ӥ�ʹ : <select name="bdoctor" id="">
                                <?php 
                                $db->select("SELECT * FROM `f43_labor_185_newborn_191`");
                                $bdoctorLists = $db->get_items();
                                foreach ($bdoctorLists as $key => $bdoc) {
                                    ?>
                                    <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">���˹ѡ�á�Դ : <input type="text" name="weight" id="" size="5" class="important">���� </span>
                            <span class="sRow">������� : <input type="text" name="height" id="" size="5" class="important">��. </span>
                            <span class="sRow">����ͺ����� : <input type="text" name="head" id="" size="5" class="important">��. </span>
                            <span class="sRow">����ͺ͡ : <input type="text" name="breast" id="" size="5">��. </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">

                            <span class="sRow">APGAR SCORE : </span>
                            
                            <span class="sRow">(1�ҷ�) <select name="asphyxia" id="" class="important">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                                </select>
                            </span>
                            <span class="sRow">(5�ҷ�) <select name="apgar5" id="">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                                </select>
                            </span>
                            <span class="sRow">(10�ҷ�) <select name="apgar10" id="">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                                </select>
                            </span>
                            <span class="sRow">
                                <input type="checkbox" name="asphyxia" id="noAsphyxia" value="99"> <label for="noAsphyxia">����Һ</label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            �����Դ��������Դ : <span style="color: red;">*</span> <input type="radio" name="disorder" id="disorder1" value="1"><label for="disorder1">�����</label> 
                            <input type="radio" name="disorder" id="disorder2" value="2"><label for="disorder2">��</label> 
                            �к� <input type="text" name="disorderDetail" id="">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            ������آ�Ҿ�á�Դ : <input type="radio" name="health" id="health1" value="���ç��"><label for="health1">���ç��</label> 
                            <input type="radio" name="health" id="health2" value="�Դ����"><label for="health2">�Դ����</label> 
                            �к� <input type="text" name="healthDetail" id="">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">�ӴѺ���ͧ��á : <select name="birthNo" class="important">
                            <?php 
                            $db->select("SELECT * FROM `f43_newborn_18_pp`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select></span>

                            <span class="sRow">����÷���Ѻ��зҹ : <select name="food" class="important">
                            <?php 
                            $db->select("SELECT * FROM `f43_newborncare_197`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            ���Ѻ VIT K �������<span style="color: red;">*</span> : 

                            <?php 
                            $db->select("SELECT * FROM `f43_newborn_193`");
                            $hivLists = $db->get_items();
                            $i = 1;
                            foreach ($hivLists as $key => $item) {
                                ?>
                                <input type="radio" name="vitk" id="vitk<?=$i;?>" value="<?=$item['code'];?>"><label for="vitk<?=$i;?>"><?=$item['detail'];?></label>
                                <?php
                                $i++;
                            }
                            ?>

                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">���Ѻ��õ�Ǩ TSH �������<span style="color: red;">*</span> : 
                                
                                <?php 
                                $db->select("SELECT * FROM `f43_newborn_194`");
                                $hivLists = $db->get_items();
                                $i = 1;
                                foreach ($hivLists as $key => $item) {
                                    ?>
                                    <input type="radio" name="tsh" id="tsh<?=$i;?>" value="<?=$item['code'];?>"><label for="tsh<?=$i;?>"><?=$item['detail'];?></label>
                                    <?php
                                    $i++;
                                }
                                ?>

                            </span>
                            <span class="sRow">�š�õ�Ǩ���´� <input type="text" name="thyroidResult" id="" size="5" class="important">mU/L</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">��õ�ǨPKU : 
                            <input type="radio" name="pku" id="pku1" value="����"><label for="pku1">����</label> 
                            <input type="radio" name="pku" id="pku2" value="�Դ����"><label for="pku2">�Դ����</label>
                            �к� <input type="text" name="pku_result" id="">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <input type="text" name="bcgDate" id="bcg" size="10"> Ǵ�. �����մ�Ѥ�չ��ͧ�ѹ�ä(BCG)
                            <input type="text" name="hbDate" id="hb" size="10"> Ǵ�. �����մ�Ѥ�չ��ͧ�ѹ�ä�Ѻ�ѡ�ʺ��(HB)
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">�ѹ����˹��� <input type="text" name="discharge" id="dischargeDate" value="<?=$dcdate;?>"> </span>
                            <span class="sRow">���˹ѡ�ѹ����˹��� <input type="text" name="weightDischarge" id="" size="5">����</span>
                        </td>
                    </tr>
                </table>
            </fieldset>

            <?php 
            $dr['PROVIDER'] = NULL;
            // $prefixMd = substr($item['doctor'],0,5);
            // $sql = "SELECT b.`PROVIDER` 
            // FROM ( 
            //     SELECT CONCAT('�.',`doctorcode`) AS `doctorcode` FROM `doctor` WHERE `name` LIKE '$prefixMd%'
            // ) AS a 
            // LEFT JOIN `tb_provider_9` AS b ON b.`REGISTERNO` = a.`doctorcode` ";
            // $db->select($sql);
            // $dr = $db->get_item();

            if( preg_match('/MD\d+/', $ipcard['doctor']) > 0 ){
                $prefixMd = substr($ipcard['doctor'],0,5);
                $where = "`name` LIKE '$prefixMd%'";
        
            }elseif ( preg_match('/(\d+){4,5}/', $ipcard['doctor'], $matchs) ) {
                $prefixMd = $matchs['0'];
                $where = "`doctorcode` = '$prefixMd'";
            }

            $sql = "SELECT CONCAT('�.',`doctorcode`) AS `doctorcode` FROM `doctor` WHERE $where ";
            $db->select($sql);
            $dr = $db->get_item();
            $doctorcode = $dr['doctorcode'];

            $sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
            $db->select($sql);
            $dr = $db->get_item();
            ?>
            <div>
                <div>&nbsp;</div>
                <button type="submit">�ѹ�֡������</button>
                <input type="hidden" name="action" value="save">
                
                <input type="hidden" name="provider" value="<?=$dr['PROVIDER'];?>">
                <input type="hidden" name="date_visit" value="<?=$ipcard['date'];?>">

                <input type="hidden" name="ipcard_id" value="<?=$ipcard['row_id'];?>">
            </div>
        </form>
        <script type="text/javascript">
            var popup1, popup2, popup3, popup4;
            window.onload = function() {
                popup1 = new Epoch('popup1','popup',document.getElementById('dateBorn'),false);
                popup2 = new Epoch('popup2','popup',document.getElementById('dischargeDate'),false);
                popup3 = new Epoch('popup2','popup',document.getElementById('bcg'),false);
                popup4 = new Epoch('popup2','popup',document.getElementById('hb'),false);
            };
        </script>
        <?php
        include 'assets/ajax.php';
        ?>
        <script>
        var btnMId = document.getElementById("checkMId");
        btnMId.addEventListener('click', function(event) {

            event.preventDefault();

            var findHn = document.getElementById("findHN").value;
            var newSm = new SmHttp();
            newSm.ajax(
                'checkMId.php', 
                { 'hn': findHn }, 
                function(res){
                    var txt = JSON.parse(res);
                    
                    if( txt.findStatus === 404 ){
                        alert("��辺�����ŷ�á��к��ç��Һ��");

                    }else if( txt.findStatus === 200 ){
                        
                        if (txt.yot === '�.�.') {
                            document.getElementById("prefix1").checked = true;
                            document.getElementById("sex").value = 1;
                            
                        }else if(txt.yot === '�.�.'){
                            document.getElementById("prefix2").checked = true;
                            document.getElementById("sex").value = 2;
                        }

                        document.getElementById("idcard").value = txt.idcard;
                        document.getElementById("name").value = txt.ptname;

                        document.getElementById("hn").value = txt.hn;
                        document.getElementById("ptAN").value = txt.an;

                        document.getElementById("dateBorn").value = txt.dbirth;
                        
                        
                    }
                }
            );
        });
        </script>
        <?php

    }else{
        ?>
        <h1>��辺������</h1>
        <?php
    }
}
include 'footer.php';
?>