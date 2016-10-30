<?php

include 'bootstrap.php';
include 'templates/classic/header.php';

$def_year = get_year_checkup(true, true);
$range_year = range(( $def_year - 13 ), $def_year);
?>
<div class="col no-print" id="top-container">
    <div class="cell">
        <div>
            <a href="eye_from.php">&lt;&lt;&nbsp;��Ѻ�˹����ش����¹��</a>
        </div>
        <h3>��ª��ͼ�������ͧ�� ���º��º�Ѻ��Թԡ����ҹ</h3>
        <div>
            <form action="report_dm_eye.php" method="post">
                <div class="col">
                    <div class="cell">
                        <label for="">���͡�է�����ҳ</label>
                        <?php
                        echo getYearList('years', true, $def_year, $range_year);
                        ?>
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <button type="submit">��ŧ</button>
                        <input type="hidden" name="action" value="show">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$action = input_post('action');
if( $action === 'show' ){

    $year_checkup = input('years');
    $date_start = ($year_checkup - 1).'-10-01';
    $date_end = $year_checkup.'-09-30';

    $db = Mysql::load();

    ?>
    <style type="text/css">
        @media print{
            table{
                width: 100%!important;
            }
            .page-break{
                page-break-after: always;
            }
        }
        .menu-wrapper{
            border: 1px solid #333333; 
            width: auto; 
            padding: 4px; 
            position: fixed; 
            top: 10px;
            right: 10px; 
            background-color: #ffffff;
        }
        .quick-menu{
            position: relative; 
        }
        .quick-menu a{
            display: block;
            cursor: pointer;
        }
        .quick-menu ul lo:hover{
            text-decoration: underline;
        }
    </style>
    <!--[if lt IE 7]>
        <style type="text/css">
        .menu-wrapper{
            position: absolute; 
            top: expression( ( 10 + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) ) + 'px' ); 
        }
        </style>
    <![endif]-->
    <div class="menu-wrapper">
        <div class="quick-menu no-print">
            <div>�����Ѵ</div>
            <ul>
                <lo>
                    <a href="#tab1">1. ��ª��ͼ�������ͧ�� ������Ѻ��õ�Ǩ��㹤�Թԡ����ҹ</a>
                </lo>
                <lo>
                    <a href="#tab2">2. ��ª��ͼ����¤�Թԡ����ҹ �����������ͧ��</a>
                </lo>
                <lo>
                    <a href="#tab3">3. ��ª��ͼ�������ͧ�ҷ�� �����㹤�Թԡ����ҹ</a>
                </lo>
                <lo>
                    <a href="#top-container">��Ѻ��鹴�ҹ��</a>
                </lo>
            </ul>
        </div>
    </div>
    
    <div class="col">
        <div class="cell">
            <h3>�է�����ҳ <?=ad_to_bc($year_checkup);?></h3>
        </div>
    </div>
    <div class="col" id="tab1">
        <div class="cell">
            <h3>1. ��ª��ͼ�������ͧ�� ������Ѻ��õ�Ǩ��㹤�Թԡ����ҹ</h3>
        </div>
    </div>
    <div class="col">
        <div class="cell">
            <table class="width-3of5">
                <thead>
                    <tr>
                        <th>�ӴѺ���</th>
                        <th>HN</th>
                        <th>����-ʡ��</th>
                        <th>�Է��</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                // 1. �����·���բ����ŷ����ͧ�� ��� DM����ҹ
                $sql = "SELECT a.`hn`,a.`ptname`,a.`retinal_date`,a.`retinal`,b.`date_eye`,b.`ptright`
                FROM `diabetes_clinic` AS a
                INNER JOIN `opd_eye` AS b ON a.`hn` = b.`hn` 
                WHERE ( b.`date_eye` >= '$date_start' AND b.`date_eye` <= '$date_end' )
                ORDER BY b.`row_id` DESC";
                $db->select($sql);
                $items = $db->get_items();

                $i = 0;
                foreach ($items as $key => $item) {
                    ++$i;
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$item['hn'];?></td>
                        <td><?=$item['ptname'];?></td>
                        <td><?=$item['ptright'];?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="page-break"></div>

    <div class="col" id="tab2">
        <div class="cell">
            <h3>2. ��ª��ͼ����¤�Թԡ����ҹ �����������ͧ��</h3>
        </div>
    </div>
    <div class="col">
        <div class="cell">
            <table class="width-3of5">
                <thead>
                    <tr>
                        <th>�ӴѺ���</th>
                        <th>HN</th>
                        <th>����-ʡ��</th>
                        <th>�Է��</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // 2. �����·���բ�����㹽�觢ͧ DM
                $sql = "SELECT a.`hn`,a.`ptname`,a.`retinal_date`,a.`retinal`,a.`ptright`
                FROM `diabetes_clinic` AS a
                LEFT JOIN `opd_eye` AS b ON a.`hn` = b.`hn` 
                WHERE b.`hn` IS NULL 
                AND ( a.`dateN` >= '$date_start' AND a.`dateN` <= '$date_end' )
                ORDER BY b.`row_id` DESC";
                $db->select($sql);
                $items = $db->get_items();
                
                $i = 0;
                foreach ($items as $key => $item) {
                    ++$i;
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$item['hn'];?></td>
                        <td><?=$item['ptname'];?></td>
                        <td><?=$item['ptright'];?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="page-break"></div>

    <div class="col" id="tab3">
        <div class="cell">
            <h3>3. ��ª��ͼ�������ͧ�ҷ�� �����㹤�Թԡ����ҹ</h3>
        </div>
    </div>
    <div class="col">
        <div class="cell">
            <table class="width-3of5">
                <thead>
                    <tr>
                        <th>�ӴѺ���</th>
                        <th>HN</th>
                        <th>����-ʡ��</th>
                        <th>�Է��</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                # 3. ੾�Ф�����ͧ�ҷ�������� DM����ҹ
                # ��ͧ�Ҩе��� �͡þ� ����ҵ�Ǩ������ҹ��鹵�
                $sql = "SELECT b.`hn`,b.`ptname`,b.`ptright`
                FROM `diabetes_clinic` AS a
                RIGHT JOIN `opd_eye` AS b ON a.`hn` = b.`hn`
                WHERE a.`hn` IS NULL 
                AND ( b.`date_eye` >= '$date_start' AND b.`date_eye` <= '$date_end' ) 
                ORDER BY b.`row_id` DESC";
                $db->select($sql);
                $items = $db->get_items();
                
                $i = 0;
                foreach ($items as $key => $item) {
                    ++$i;
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$item['hn'];?></td>
                        <td><?=$item['ptname'];?></td>
                        <td><?=$item['ptright'];?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}
include 'templates/classic/footer.php';