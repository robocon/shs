<?php
include 'bootstrap.php';

$type_lists = array(
    'nhso' => 'ประกันสังคม',
    'nhso-lmc' => 'ประกันสังคม L-MC',
    'sso' => '30บาท'
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
                <legend>ค้นหาตาม HN</legend>
                <form action="nhso_and_sso.php" method="post">
                    <div class="col">
                        <div class="cell">
                            <label for="hn">HN: </label>
                            <input type="text" id="hn" name="hn" value="<?=$hn;?>">
                        </div>
                    </div>
                    <div class="col">
                        <div class="cell">
                            <label>เลือกใบ: </label>
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
                            <button type="submit">ค้นหา</button>
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
                    <legend>กรอกข้อมูล <?=$type_lists[$type];?></legend>
                    <form action="nhso_and_sso.php" method="post" target="_blank">
                        <div class="col">
                            <div class="cell">
                                <label for="run_number">เลขที่ กห:</label>
                                <input type="text" id="run_number" name="run_number" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="cell">
                                <label for="run_number">วัน/เดือน/ปี:</label>
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
                                    <label for="run_number">เรียน ผู้อำนวยการโรงพยาบาล :</label>
                                    <input type="text" name="to">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col">
                            <div class="cell">
                                <label for="run_number">ชื่อสกุล:</label> <span><?=$user['ptname'];?></span>
                            </div>
                        </div>
                        <?php
                        if ( $type === 'sso' ) {
                            ?>
                            <div class="col">
                                <div class="cell">
                                    <label for="run_number">เลขบัตประชาชน:</label> <span><?=$user['idcard'];?></span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col">
                            <div class="cell">
                                <button type="submit">บันทึกข้อมูล</button>
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
    $pdf->SetThaiFont(); // เซ็ตฟอนต์
    $pdf->SetAutoPageBreak(false, 0);
    $pdf->SetMargins(30, 19, 20, 25); // left, top, right
    $pdf->AddPage();
    $pdf->SetFont('THSarabun','',16); // เรียกใช้งานฟอนต์ที่เตรียมไว้

    $pdf->SetXY(30, 19);
    $pdf->Image('images/ks_025_2.png', 94, 19, 30, 30, 'PNG');

    $pdf->SetXY(30, 39);
    $pdf->Cell(47, 5, 'ที่ กห ๐๔๘๓.๖๓.๔/'.to_thai_number($run_number), 1, 1);

    $pdf->SetXY(145, 39);
    $pdf->MultiCell(45, 5, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี'."\n".'ตำบลพิชัย อำเภอเมือง'."\n".'จังหวัดลำปาง ๕๒๐๐๐', 1, 'L');

    $pdf->SetXY(110, 59);
    $pdf->Cell(0, 5, $thai_date, 1, 1, 'L');

    if( $type === 'sso' ){
        $title = 'เรื่อง ขอส่งตัวผู้ป่วยสิทธิหลักประกันสุขภาพถ้วนหน้า รักษาต่อ';
    }else{
        $title = 'เรื่อง ขอรับรองสิทธิผู้ประกันตนของโรงพยาบาลค่ายสุรศักดิ์มนตรี';
    }
    $pdf->SetXY(30, 69);
    $pdf->Cell(0, 5, $title, 1, 1);

    if( $type === 'nhso-lmc' ){
        $to = 'เรียน คลินิกเวชกรรม L-MC ลำปาง';
    }else{
        $to = 'เรียน ผู้อำนวยการโรงพยาบาล'.$to;
    }
    $pdf->SetXY(30, 79);
    $pdf->Cell(0, 5, $to, 1, 1);

    if( $type === 'nhso' ){
        $pdf->SetXY(55, 89);
        $pdf->Cell(0, 5, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี ขอส่ง..............................................................................ซึ่งเป็น', 1, 1);
        $pdf->SetXY(108, 89);
        $pdf->Cell(0, 5, $user['ptname'], 1, 1);
        $pdf->SetXY(30, 94);
        $pdf->Cell(0, 5, 'ผู้ประกันตนที่เลือกโรงพยาบาลค่ายสุรศักดิ์มนตรีเป็น MAIN CONTRACTOR มารับการรักษาที่โรงพยาบาล', 1, 1);
        $pdf->SetXY(30, 99);
        $pdf->Cell(0, 5, 'ของท่าน ดังนั้นจึงขอความอนุเคราะห์ให้การรักษาพยาบาลแก่บุคคลดังกล่าว ตามสิทธิในฐานะที่เป็น SUPRA', 1, 1);
        $pdf->SetXY(30, 104);
        $pdf->Cell(0, 5, 'CONTRACTOR ของโรงพยาบาลค่ายสุรศักดิ์มนตรี ตามความเหมาะสม ในกรณีที่มีค่าใช้จ่ายยาและเวชภัณฑ์', 1, 1);
        $pdf->SetXY(30, 109);
        $pdf->Cell(0, 5, 'มากกว่า ๕๐,๐๐๐ บาท ขอให้ประสานมายังโรงพยาบาลค่ายสุรศักดิ์มนตรี เพื่อพิจารณาค่าใช้จ่ายในการรักษา', 1, 1);
        $pdf->SetXY(30, 114);
        $pdf->Cell(0, 5, 'ต่อไป', 1, 1);
        
        $pdf->SetXY(55, 124);
        $pdf->Cell(0, 5, 'จึงเรียนมาเพื่อทราบและหวังว่าคงได้รับความอนุเคราะห์จากท่านด้วยดี กับขอบคุณมา', 1, 1);
        $pdf->SetXY(30, 129);
        $pdf->Cell(0, 5, 'ณ โอกาสนี้ด้วย', 1, 1);
        
        $pdf->SetXY(110, 139);
        $pdf->Cell(80, 5, 'ขอแสดงความนับถือ', 1, 1, 'C');

        $pdf->SetXY(110, 159);
        $pdf->Cell(80, 5, 'พันเอก', 1, 1, 'L');
        $pdf->SetXY(110, 169);
        $pdf->Cell(80, 5, '( ณัฐนนท์ ภุคุกะ )', 1, 1, 'C');
        $pdf->SetXY(110, 174);
        $pdf->Cell(80, 5, 'ผู้อำนวยการโรงพยาบาลค่ายสุรศักดิ์มนตรี', 1, 1, 'C');

        $pdf->SetXY(30, 204);
        $pdf->Cell(0, 5, 'ประกันสังคม', 1, 1, 'L');
        $pdf->SetXY(30, 209);
        $pdf->Cell(0, 5, 'โทร ๐-๕๔๘๓-๙๓๐๕-๘ ต่อ ๑๑๒๓', 1, 1, 'L');
        $pdf->SetXY(30, 214);
        $pdf->Cell(0, 5, 'โทรสาร ๐-๕๔๘๓-๙๓๑๐', 1, 1, 'L');

    }else if( $type === 'nhso-lmc' ){

    }else if( $type === 'sso' ){
        $pdf->SetXY(55, 89);
        $pdf->Cell(0, 5, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี ขอส่ง..........................................................หมายเลขประจำตัว', 1, 1);
        $pdf->SetXY(108, 89);
        $pdf->Cell(0, 5, $user['ptname'], 1, 1);

        $pdf->SetXY(30, 94);
        $pdf->Cell(0, 5, '....................................................................... ซึ่งเป็นผู้ป่วยบัตรประกันสุขภาพถ้วนหน้า และเลือกโรงพยาบาล', 1, 1);
        $pdf->SetXY(45, 94);
        $idcard = to_thai_number($user['idcard']);
        $pdf->Cell(0, 5, $idcard, 1, 1);

        $pdf->SetXY(30, 99);
        $pdf->Cell(0, 5, 'ค่ายสุรศักดิ์มนตรีเป็นสถานพยาบาลหลักมารักษาพบาบาลต่อ จึงขอความร่วมมือท่านให้การรักษาพยาบาล', 1, 1);
        $pdf->SetXY(30, 104);
        $pdf->Cell(0, 5, 'ตามความเหมาะสม ส่วนค่าใช้จ่ายในการรักษานั้นขอให้ส่งหลักฐานเรียกเก็บตามระเบียบ ต่อไป', 1, 1);

        $pdf->SetXY(55, 114);
        $pdf->Cell(0, 5, 'จึงเรียนมาเพื่อทราบ และขอขอบคุณมา ณ โอกาสนี้', 1, 1);

        $pdf->SetXY(110, 124);
        $pdf->Cell(80, 5, 'ขอแสดงความนับถือ', 1, 1, 'C');

        $pdf->SetXY(110, 144);
        $pdf->Cell(0, 5, 'พันโท', 1, 1);
        $pdf->SetXY(110, 149);
        $pdf->Cell(0, 5, '( มนต์ชัย พรพัฒนะเจริญชัย )', 1, 1,'C');
        $pdf->SetXY(110, 154);
        $pdf->Cell(0, 5, 'เลขานุการโครงการหลักประกันสุขภาพแห่งชาติ', 1, 1,'C');
        $pdf->SetXY(110, 159);
        $pdf->Cell(0, 5, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 1, 1,'C');

        $pdf->SetXY(30, 179);
        $pdf->Cell(0, 5, 'หมายเหตุ - ๑. หนังสือรับรองสิทธิฉบับนี้ใช้สำหรับการตรวจรักษาที่โรงพยาบาล.....................................เท่านั้น', 0, 1);
        $pdf->SetXY(48, 184);
        $pdf->Cell(0, 5, '๒. ใช้สำหรับการตรวจรักษาในวันที่.......................................................................................เท่านั้น', 0, 1);

        $pdf->SetXY(30, 204);
        $pdf->Cell(0, 5, 'กองทุนหลักประกันสุขภาพแห่งชาติ', 0, 1);
        $pdf->Cell(0, 5, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 0, 1);
        $pdf->Cell(0, 5, 'โทร. (๐๕๔) ๘๓๙๓๐๕ - ๘ ต่อ ๑๑๒๔', 0, 1);
        $pdf->Cell(0, 5, 'โทรสาร. (๐๕๔) ๘๓๙๓๑๐', 0, 1);
    }
    
    // $pdf->AutoPrint(true);
    $pdf->Output();

}