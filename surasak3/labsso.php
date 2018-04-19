<?php
session_start();
echo "Hello ลูกจ้าง ปกส.";

echo "<br>";

echo "<pre>";
// var_dump($GLOBALS);
// var_dump($_SESSION);
echo "</pre>";

?>
<table>
    <tr>
        <th>#</th>
        <th>รหัส</th>
        <th>รายละเอียด</th>
        <th>เบิกได้</th>
        <th>เบิกไม่ได้</th>
    </tr>
    <tr>
        <td>1</td>
        <td><a target='right' href="labinfo.php?Dgcode=CBC&Depart=PATHO&Amount=1&Trade=<?=urlencode('(30101)CBC (+ diff. + RBC morphology + plt count) by automation');?>&nPrice=90&tvn=4">cbc</a></td>
        <td>(30101)CBC (+ diff. + RBC morphology + plt count) by automation</td>
        <td>0</td>
        <td>90</td>
    </tr>
    <tr>
        <td>1</td>
        <td><a target='right' href="labinfo.php?Dgcode=CBC&Depart=PATHO&Amount=1&Trade=<?=urlencode('(30101)CBC (+ diff. + RBC morphology + plt count) by automation');?>&nPrice=90&tvn=4">cbc</a></td>
        <td>(30101)CBC (+ diff. + RBC morphology + plt count) by automation</td>
        <td>0</td>
        <td>90</td>
    </tr>
</table>