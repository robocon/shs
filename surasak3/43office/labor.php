<?php 
include '../bootstrap.php';
include 'libs/functions.php';

$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $GRAVIDA = input_post('GRAVIDA');

    $LMP = input_post('LMP');
    $LMP = bc_to_ad($LMP);
    $LMP = str_replace('-','', $LMP);

    $EDC = input_post('EDC');
    $EDC = bc_to_ad($EDC);
    $EDC = str_replace('-','', $EDC);

    $BDATE = input_post('BDATE');
    $BDATE = bc_to_ad($BDATE);
    $BDATE = str_replace('-','', $BDATE);

    $BRESULT = input_post('BRESULT');
    $BPLACE = input_post('BPLACE');
    $BHOSP = input_post('BHOSP');
    $BTYPE = input_post('BTYPE');
    $BDOCTOR = input_post('BDOCTOR');
    $LBORN = (int) $_POST['LBORN'];
    $SBORN = (int) $_POST['SBORN'];
    $D_UPDATE = date('YmdHis');
    $CID = input_post('CID');
    $ipcard_id = input_post('ipcard_id');
    $ipcard_date = input_post('ipcard_date');

    $sql = "INSERT INTO `43labor` ( 
        `id`, `HOSPCODE`, `PID`, `GRAVIDA`, `LMP`, `EDC`, 
        `BDATE`, `BRESULT`, `BPLACE`, `BHOSP`, `BTYPE`, `BDOCTOR`, 
        `LBORN`, `SBORN`, `D_UPDATE`, `CID`, `ipcard_id`, 
        `ipcard_date` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$GRAVIDA', '$LMP', '$EDC', 
        '$BDATE', '$BRESULT', '$BPLACE', '$BHOSP', '$BTYPE', '$BDOCTOR', 
        '$LBORN', '$SBORN', '$D_UPDATE', '$CID', '$ipcard_id', 
        '$ipcard_date' 
    );";
    
    $save = $db->insert($sql);

    $msg = '�ѹ�֡���������º����';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    
    redirect('labor.php', $msg);
    exit;
}

include 'head.php';
?>
<div class="clearfix">
    <h1 style="margin:0;">LABOR</h1> <span>�����Ż���ѵԡ�ä�ʹ ���͡������ش��õ�駤����</span>
</div>
<fieldset>
    <legend>��� : LABOR</legend>
    <form action="labor.php" method="post">
        <table>
            <tr>
                <td>���ҵ�� AN : </td>
                <td><input type="text" name="an" id=""></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">����</button>
                    <input type="hidden" name="page" value="search">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<?php
$page = input('page');
if ( $page === 'search' ) {

    $labor_id = input_get('labor_id');

    if(empty($labor_id))
    {
        $an = input_post('an');

        $sql = "SELECT * FROM `ipcard` WHERE `an` = '$an' ";
        $db->select($sql);
        $ipcard = $db->get_item();

        if(empty($ipcard))
        {
            echo "��辺������ $an ��سҵ�Ǩ�ͺ��ä����ա����";
            exit;
        }

        $hn = $ipcard['hn'];
        $sql = "SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn'";
        $db->select($sql);
        $opcard = $db->get_item();

        $an = $ipcard['an'];
        $ptname = $ipcard['ptname'];
        $date = $ipcard['date'];
        $PID = $ipcard['hn'];
        $CID = $opcard['idcard'];

        $ipcard_id = $ipcard['row_id'];

        $ipcard_date = bc_to_ad(substr($ipcard['date'], 0, 10));
        $ipcard_date = str_replace('-', '', $ipcard_date);
    }
    else
    {
        $db->select("SELECT * FROM `43labor` WHERE `id` = '$labor_id' ");
        $item = $db->get_item();

        $sql = "SELECT * FROM `ipcard` WHERE `row_id` = '".$item['ipcard_id']."' ";
        $db->select($sql);
        $ipcard = $db->get_item();

        $an = $ipcard['an'];
        $ptname = $ipcard['ptname'];
        $date = $ipcard['date'];
        $PID = $item['PID'];
        $GRAVIDA = $item['GRAVIDA'];
        $LMP = $item['LMP'];
        $EDC = $item['EDC'];
        $BDATE = $item['BDATE'];
        $BRESULT = $item['BRESULT'];
        $BPLACE = $item['BPLACE'];
        $BTYPE = $item['BTYPE'];
        $BDOCTOR = $item['BDOCTOR'];
        $LBORN = $item['LBORN'];
        $SBORN = $item['SBORN'];
        $CID = $item['CID'];

        $ipcard_id = $item['ipcard_id'];
        $ipcard_date = $item['ipcard_date'];

    }
    ?>
    <fieldset>
        <legend>������ѹ�֡ LABOR</legend>
        <form action="labor.php" method="post">
            <table>
                <tr>
                    <td colspan="2">
                    <b>AN : </b> <?=$an;?> <b>����-ʡ�� : </b> <?=$ptname;?> <b>�ѹ������Ѻ��ԡ�� : </b> <?=$date;?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">����ʶҹ��ԡ�� : </td>
                    <td>
                        <input type="text" name="HOSPCODE" value="11512" readonly>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">����¹�ؤ��(HN) : </td>
                    <td>
                        <input type="text" name="PID" value="<?=$PID;?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">������� : </td>
                    <td><input type="text" name="GRAVIDA" id="GRAVIDA" value="<?=$GRAVIDA;?>">(������ 0 ��˹���� 1,2,10)</td>
                </tr>
                <tr>
                    <td class="txtRight">�ѹ�á�ͧ����ջ�Ш���͹�����ش���� : </td>
                    <td><input type="text" name="LMP" id="LMP" value="<?=$LMP;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">�ѹ����˹���ʹ : </td>
                    <td><input type="text" name="EDC" id="EDC" value="<?=$EDC;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">�ѹ��ʹ/�ѹ����ش��õ�駤���� : </td>
                    <td><input type="text" name="BDATE" id="BDATE" value="<?=$BDATE;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">������ش��õ�駤���� : </td>
                    <td><input type="text" name="BRESULT" id="BRESULT" value="<?=$BRESULT;?>" >�����ä ICD - 10 TM <span id="labor181" style="position: relative;"></div></td>
                </tr>
                <tr>
                    <td class="txtRight">ʶҹ����ʹ : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_labor_182_newborn_187`");
                        $labor182Lists = $db->get_items();
                        $i = 1;
                        foreach ($labor182Lists as $key => $item) {
                            $checked = ($BPLACE==$item['code']) ? 'checked="checked"' : '' ;
                            ?>
                            <input type="radio" name="BPLACE" id="bplace<?=$i;?>" value="<?=$item['code'];?>" <?=$checked;?> ><label for="bplace<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">����ʶҹ��Һ�ŷ���ʹ : </td>
                    <td><input type="text" name="BHOSP" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">�Ըա�ä�ʹ/����ش��õ�駤���� : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_labor_184_newborn_190`");
                        $btypeLists = $db->get_items();
                        $i = 1;
                        foreach ($btypeLists as $key => $item) { 
                            $checked = ($BTYPE==$item['code']) ? 'checked="checked"' : '' ;
                            ?>
                            <input type="radio" name="BTYPE" id="btype<?=$i;?>" value="<?=$item['code'];?>" <?=$checked;?> ><label for="btype<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">�������ͧ���Ӥ�ʹ : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_labor_185_newborn_191`");
                        $hivLists = $db->get_items();
                        $i = 1;
                        foreach ($hivLists as $key => $item) { 
                            $checked = ($BDOCTOR==$item['code']) ? 'checked="checked"' : '' ;
                            ?>
                            <input type="radio" name="BDOCTOR" id="bdoctor<?=$i;?>" value="<?=$item['code'];?>" <?=$checked;?> ><label for="bdoctor<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ�Դ�ժվ : </td>
                    <td><input type="text" name="LBORN" value="0" value="<?=$LBORN;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӹǹ��¤�ʹ : </td>
                    <td><input type="text" name="SBORN" value="0" value="<?=$SBORN;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">�Ţ���ѵû�ЪҪ�(��ô�) : </td>
                    <td><input type="text" name="CID" value="<?=$CID;?>" readonly></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit">�ѹ�֡</button>
                        <input type="hidden" name="ipcard_id" value="<?=$ipcard_id;?>">
                        <input type="hidden" name="ipcard_date" value="<?=$ipcard_date;?>">
                        <input type="hidden" name="action" value="save">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </fieldset>
    <?php
    include 'assets/ajax.php';
    ?>
    <script type="text/javascript">
        var popup1, popup2, popup3;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('LMP'),false);
            popup2 = new Epoch('popup2','popup',document.getElementById('EDC'),false);
            popup3 = new Epoch('popup2','popup',document.getElementById('BDATE'),false);
        };


        var btnBRESULT = document.getElementById("BRESULT");
        btnBRESULT.addEventListener('keyup', function(event) {

            var newSm = new SmHttp();
            newSm.ajax(
                'labor181.php', 
                { 'word': btnBRESULT.value }, 
                function(res){
                    document.getElementById('labor181').innerHTML = res;

                    /* https://clubmate.fi/detect-click-with-pure-javascript/ */
                    var el = document.getElementsByClassName('icd10');
                    for (var i=0; i < el.length; i++) {
                        // Here we have the same onclick
                        el.item(i).onclick = function(){

                            document.getElementById('BRESULT').value = this.getAttribute('data');
                            document.getElementById('labor181').innerHTML = '';
                        };
                    }

                    // �����Դ
                    var btnClose = document.getElementById("btnLaborClose");
                    btnClose.addEventListener('click', function(event) { 
                        document.getElementById('labor181').innerHTML = '';
                    });

                }
            );
        });


    </script>
    <?php

}