<?php
include 'bootstrap.php';
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
                        <input type="text" id="hn" name="hn">
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <label>���͡�: </label>
                        <select name="type">
                            <option value="nhso">��Сѹ�ѧ��</option>
                            <option value="nhso-lmc">��Сѹ�ѧ�� L-MC</option>
                            <option value="sso">30�ҷ</option>
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
                <legend>��͡������</legend>
                <form action="nhso_and_sso.php" method="post">
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
                            <label for="run_number">���¹:</label>
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