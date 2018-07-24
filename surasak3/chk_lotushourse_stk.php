<?php

include 'bootstrap.php';

$db = Mysql::load();

?>
<style type="text/css">
/* @media print{
    #userForm{
        display: none;
    }
} */
</style>
<form action="chk_lotushourse_stk.php" method="post" id="userForm">
    <div>
        <h3>พิมพ์สติกเกอร์ บ.โลตัสฮอสฯ</h3>
    </div>
    <div>
        <button type="submit">พิมพ์</button>
        <input type="hidden" name="action" value="print">
    </div>
</form>
<?php

$action = input_post('action');

if ( $action == 'print' ) {
    
    $sql = "SELECT * FROM `opcardchk` WHERE `part` = 'โลตัสฮอส61' ";
    $db->select($sql);

    $users = $db->get_items($sql);

    foreach ($users as $key => $user) {

        $ptname = $user['name'].' '.$user['surname'];
        $hn = $user['HN'];

        $exam_no = $user['exam_no'];

        $lab_number = "180724".$exam_no;

        $labno1 = $lab_number."01";
        $labno2 = $lab_number."02";


        //CBC
        print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$ptname</b></center></font>";
        print "<div style='text-align:center;'>
            <span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno1\"></span>
            &nbsp;<span style='font-size: 32px;'>1</span>
        </div>";
        print "<div style=\"page-break-before: always;\"></div>";

        //CHEM
        print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$ptname</b></center></font>";
        print "<div style='text-align:center;'>
            <span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno2\"></span>
            &nbsp;<span style='font-size: 32px;'>2</span>
        </div>";
        print "<div style=\"page-break-before: always;\"></div>";

        print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$ptname</b></center></font>";
        print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$hn</b></center></font>";
        print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$exam_no</b></center></font>";
        print "<div style=\"page-break-before: always;\"></div>";

        // ตะกั่ว7คน
        if( $user['HN'] == '614035' 
        OR $user['HN'] == '614036' 
        OR $user['HN'] == '614088' 
        OR $user['HN'] == '614089' 
        OR $user['HN'] == '614090' 
        OR $user['HN'] == '614091' 
        OR $user['HN'] == '614092' ){ 

            for ($i=0; $i < 3; $i++) { 
                print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$ptname</b></center></font>";
                print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$hn</b></center></font>";
                print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$exam_no</b></center></font>";
                print "<div style=\"page-break-before: always;\"></div>";
            }

        }
        
    }

}

