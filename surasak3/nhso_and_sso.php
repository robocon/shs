<?php
include 'bootstrap.php';
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
                        <input type="text" id="hn" name="hn">
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <label>เลือกใบ: </label>
                        <select name="type">
                            <option value="nhso">ประกันสังคม</option>
                            <option value="nhso-lmc">ประกันสังคม L-MC</option>
                            <option value="sso">30บาท</option>
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
        $hn = input_post('hn');
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
                <legend>กรอกข้อมูล</legend>
                <form action="nhso_and_sso.php" method="post">
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
                            getDateList('select_day', '7');
                            getMonthList('select_month', '11');
                            getYearList('select_year', true, '2016');
                            ?>
                        </div>
                    </div>
                    <?php
                    if ( $type !== 'nhso-lmc' ) {
                    ?>
                    <div class="col">
                        <div class="cell">
                            <label for="run_number">เรียน:</label>
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


// @doto
// Action = save
// refer_nhso_sso

include 'templates/classic/footer.php';