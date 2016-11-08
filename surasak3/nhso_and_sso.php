<?php
include 'bootstrap.php';

$type_lists = array(
    'nhso' => '��Сѹ�ѧ��',
    'nhso-lmc' => '��Сѹ�ѧ�� L-MC',
    'sso' => '30�ҷ'
);

$action = input_post('action');
if( $action !== 'print' ){
    $hn = input_post('hn');
    $type = input_post('type');
    include 'templates/classic/header.php';
    ?>
    <div class="col">
        <div class="cell">
            <fieldset class="no_print">
                <legend>���ҵ�� HN</legend>
                <form action="nhso_and_sso.php" method="post">
                    <div class="col">
                        <div class="cell">
                            <label for="hn">HN: </label>
                            <input type="text" id="hn" name="hn" value="<?=$hn;?>">
                        </div>
                    </div>
                    <div class="col">
                        <div class="cell">
                            <label>���͡�: </label>
                            <select name="type">
                                <?php
                                foreach( $type_lists as $key => $val ){
                                    $selected = ( $type === $key ) ? 'selected="selected"' : '' ;
                                    ?>
                                    <option value="<?=$key;?>" <?=$selected;?>><?=$val;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="cell">
                            <button type="submit">����</button>
                            <input type="hidden" name="search" value="hn">
                        </div>
                    </div>
                </form>
            </fieldset>
            <?php
            
            $search = input_post('search');
            if( $search === 'hn' && !empty($hn) ){

                $type = input_post('type');
                
                $db = Mysql::load();
                $db->select("SELECT `idcard`, CONCAT(`yot`,' ',`name`,' ',`surname`) AS `ptname` 
                FROM `opcard` 
                WHERE `hn` = '$hn'");
                $user = $db->get_item();

                ?>
                <fieldset class="no_print">
                    <legend>��͡������ <?=$type_lists[$type];?></legend>
                    <form action="nhso_and_sso.php" method="post" target="_blank">
                        <div class="col">
                            <div class="cell">
                                <label for="run_number">�Ţ��� ��:</label>
                                <input type="text" id="run_number" name="run_number" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="cell">
                                <label for="run_number">�ѹ/��͹/��:</label>
                                <?php
                                $def_day = date('d');
                                getDateList('select_day', $def_day);

                                $def_month = date('m');
                                getMonthList('select_month', $def_month);

                                $def_year = date('Y');
                                getYearList('select_year', true, $def_year);
                                ?>
                            </div>
                        </div>
                        <?php
                        if ( $type !== 'nhso-lmc' ) {

                            ?>
                            <div class="col">
                                <div class="cell">
                                    <label for="run_number">���¹ ����ӹ�¡���ç��Һ�� :</label>
                                    <input type="text" name="to">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col">
                            <div class="cell">
                                <label for="run_number">����ʡ��:</label> <span><?=$user['ptname'];?></span>
                            </div>
                        </div>
                        <?php
                        if ( $type === 'sso' ) {
                            ?>
                            <div class="col">
                                <div class="cell">
                                    <label for="run_number">�Ţ�ѵ��ЪҪ�:</label> <span><?=$user['idcard'];?></span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col">
                            <div class="cell">
                                <button type="submit">�ѹ�֡������</button>
                                <input type="hidden" name="hn" value="<?=$hn;?>">
                                <input type="hidden" name="action" value="print">
                                <input type="hidden" name="type" value="<?=$type;?>">
                            </div>
                        </div>
                    </form>
                </fieldset>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
    include 'templates/classic/footer.php';

}else if( $action === 'print' ){

    include 'fpdf_thai/shspdf.php';

    $db = Mysql::load();
    $db->select("SELECT `idcard`, CONCAT(`yot`,' ',`name`,' ',`surname`) AS `ptname` 
    FROM `opcard` 
    WHERE `hn` = '47-1'");
    $user = $db->get_item();

    // @todo
    // Save data to database
    // refer_nhso_sso

    $run_number = input_post('run_number');
    $select_day = input_post('select_day');
    $select_month = input_post('select_month');
    $select_year = input_post('select_year') + 543;
    $to = input_post('to');
    $type = input_post('type');
    
    $thai_date = to_thai_number($select_day).' '.$def_fullm_th[$select_month].' '.to_thai_number($select_year);

    $pdf = new SHSPdf('P', 'mm', 'A4');
    $pdf->SetThaiFont(); // �絿͹��
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->SetMargins(30, 19, 20, 25); // left, top, right
    $pdf->AddPage();
    $pdf->SetFont('THSarabun','',16); // ���¡��ҹ�͹������������

    $pdf->SetXY(30, 19);
    $pdf->Image('images/ks_025_2.png', 94, 19, 30, 30, 'PNG');

    $pdf->SetXY(30, 39);
    $pdf->Cell(47, 5, '��� �� ����.��.�/'.to_thai_number($run_number), 1, 1);

    $pdf->SetXY(145, 39);
    $pdf->MultiCell(45, 5, '�ç��Һ�Ť�������ѡ��������'."\n".'�ӺžԪ�� ��������ͧ'."\n".'�ѧ��Ѵ�ӻҧ �����', 1, 'L');

    $pdf->SetXY(110, 59);
    $pdf->Cell(0, 5, $thai_date, 1, 1, 'L');

    if( $type === 'sso' ){
        $title = '����ͧ ���觵�Ǽ������Է����ѡ��Сѹ�آ�Ҿ��ǹ˹�� �ѡ�ҵ��';
    }else{
        $title = '����ͧ ���Ѻ�ͧ�Է�Լ���Сѹ���ͧ�ç��Һ�Ť�������ѡ��������';
    }
    $pdf->SetXY(30, 69);
    $pdf->Cell(0, 5, $title, 1, 1);

    if( $type === 'nhso-lmc' ){
        $to = '���¹ ��Թԡ�Ǫ���� L-MC �ӻҧ';
    }else{
        $to = '���¹ ����ӹ�¡���ç��Һ��'.$to;
    }
    $pdf->SetXY(30, 79);
    $pdf->Cell(0, 5, $to, 1, 1);

    if( $type === 'nhso' ){
        $pdf->SetXY(55, 89);
        $pdf->Cell(0, 5, '�ç��Һ�Ť�������ѡ�������� ����..............................................................................�����', 1, 1);
        $pdf->SetXY(108, 89);
        $pdf->Cell(0, 5, $user['ptname'], 1, 1);
        $pdf->SetXY(30, 94);
        $pdf->Cell(0, 5, '����Сѹ��������͡�ç��Һ�Ť�������ѡ���������� MAIN CONTRACTOR ���Ѻ����ѡ�ҷ���ç��Һ��', 1, 1);
        $pdf->SetXY(30, 99);
        $pdf->Cell(0, 5, '�ͧ��ҹ �ѧ��鹨֧�ͤ���͹�������������ѡ�Ҿ�Һ����ؤ�Ŵѧ����� ����Է��㹰ҹз���� SUPRA', 1, 1);
        $pdf->SetXY(30, 104);
        $pdf->Cell(0, 5, 'CONTRACTOR �ͧ�ç��Һ�Ť�������ѡ�������� �������������� 㹡óշ���դ�������������Ǫ�ѳ��', 1, 1);
        $pdf->SetXY(30, 109);
        $pdf->Cell(0, 5, '�ҡ���� ��,��� �ҷ ��������ҹ���ѧ�ç��Һ�Ť�������ѡ�������� ���;Ԩ�óҤ�������㹡���ѡ��', 1, 1);
        $pdf->SetXY(30, 114);
        $pdf->Cell(0, 5, '����', 1, 1);
        
        $pdf->SetXY(55, 124);
        $pdf->Cell(0, 5, '�֧���¹�����ͷ�Һ�����ѧ��Ҥ����Ѻ����͹�������ҡ��ҹ���´� �Ѻ�ͺ�س��', 1, 1);
        $pdf->SetXY(30, 129);
        $pdf->Cell(0, 5, '� �͡�ʹ�����', 1, 1);
        
        $pdf->SetXY(110, 139);
        $pdf->Cell(80, 5, '���ʴ������Ѻ���', 1, 1, 'C');

        $pdf->SetXY(110, 159);
        $pdf->Cell(80, 5, '�ѹ�͡', 1, 1, 'L');
        $pdf->SetXY(110, 169);
        $pdf->Cell(80, 5, '( �Ѱ���� �ؤء� )', 1, 1, 'C');
        $pdf->SetXY(110, 174);
        $pdf->Cell(80, 5, '����ӹ�¡���ç��Һ�Ť�������ѡ��������', 1, 1, 'C');

        $pdf->SetXY(30, 204);
        $pdf->Cell(0, 5, '��Сѹ�ѧ��', 1, 1, 'L');
        $pdf->SetXY(30, 209);
        $pdf->Cell(0, 5, '�� �-����-����-� ��� ����', 1, 1, 'L');
        $pdf->SetXY(30, 214);
        $pdf->Cell(0, 5, '����� �-����-����', 1, 1, 'L');

    }else if( $type === 'nhso-lmc' ){

    }else if( $type === 'sso' ){
        $pdf->SetXY(55, 89);
        $pdf->Cell(0, 5, '�ç��Һ�Ť�������ѡ�������� ����..........................................................�����Ţ��Шӵ��', 1, 1);
        $pdf->SetXY(108, 89);
        $pdf->Cell(0, 5, $user['ptname'], 1, 1);

        $pdf->SetXY(30, 94);
        $pdf->Cell(0, 5, '....................................................................... ����繼����ºѵû�Сѹ�آ�Ҿ��ǹ˹�� ������͡�ç��Һ��', 1, 1);
        $pdf->SetXY(45, 94);
        $idcard = to_thai_number($user['idcard']);
        $pdf->Cell(0, 5, $idcard, 1, 1);

        $pdf->SetXY(30, 99);
        $pdf->Cell(0, 5, '��������ѡ����������ʶҹ��Һ����ѡ���ѡ�Ҿ�Һ�ŵ�� �֧�ͤ���������ͷ�ҹ������ѡ�Ҿ�Һ��', 1, 1);
        $pdf->SetXY(30, 104);
        $pdf->Cell(0, 5, '�������������� ��ǹ��������㹡���ѡ�ҹ�鹢��������ѡ�ҹ���¡�纵������º ����', 1, 1);

        $pdf->SetXY(55, 114);
        $pdf->Cell(0, 5, '�֧���¹�����ͷ�Һ ��Т͢ͺ�س�� � �͡�ʹ��', 1, 1);

        $pdf->SetXY(110, 124);
        $pdf->Cell(80, 5, '���ʴ������Ѻ���', 1, 1, 'C');

        $pdf->SetXY(110, 144);
        $pdf->Cell(0, 5, '�ѹ�', 1, 1);
        $pdf->SetXY(110, 149);
        $pdf->Cell(0, 5, '( ������ �þѲ����ԭ��� )', 1, 1,'C');
        $pdf->SetXY(110, 154);
        $pdf->Cell(0, 5, '�Ţҹء���ç�����ѡ��Сѹ�آ�Ҿ��觪ҵ�', 1, 1,'C');
        $pdf->SetXY(110, 159);
        $pdf->Cell(0, 5, '�ç��Һ�Ť�������ѡ��������', 1, 1,'C');

        $pdf->SetXY(30, 179);
        $pdf->Cell(0, 5, '�����˵� - �. ˹ѧ����Ѻ�ͧ�Է�ԩ�Ѻ���������Ѻ��õ�Ǩ�ѡ�ҷ���ç��Һ��.....................................��ҹ��', 0, 1);
        $pdf->SetXY(48, 184);
        $pdf->Cell(0, 5, '�. ������Ѻ��õ�Ǩ�ѡ����ѹ���.......................................................................................��ҹ��', 0, 1);

        $pdf->SetXY(30, 204);
        $pdf->Cell(0, 5, '�ͧ�ع��ѡ��Сѹ�آ�Ҿ��觪ҵ�', 0, 1);
        $pdf->Cell(0, 5, '�ç��Һ�Ť�������ѡ��������', 0, 1);
        $pdf->Cell(0, 5, '��. (���) ������ - � ��� ����', 0, 1);
        $pdf->Cell(0, 5, '�����. (���) ������', 0, 1);
    }
    
    // $pdf->AutoPrint(true);
    $pdf->Output();

}