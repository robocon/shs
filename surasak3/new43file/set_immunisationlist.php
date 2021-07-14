<?php 
include '../bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES TIS620");
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sarabun">
<style>
    *, h3{
        font-family: Sarabun, sans-serif;
    }
</style>

<div class="w3-bar w3-dark-grey">
    <a href="update_vaccine_manufacturer.php" class="w3-bar-item w3-button w3-mobile w3-green">�Ѿഷ��ª����Ѥ�չ�ҡ MophIC</a>
    <a href="map_vaccine_c19.php" class="w3-bar-item w3-button w3-mobile w3-green">Map Vaccine �ѺEPI</a>
    <a href="#" class="w3-bar-item w3-button w3-mobile w3-green">Sync �����š�éմ�ҡ MophIC</a>
</div>

<div class="w3-container">

    <form action="set_immunisationlist.php" method="post">
        <fieldset>
            <legend>���Ң����š�éմ�Ѥ�չ�ҡ MophIC(����Ң��������º��������)</legend>
            <div>
                ���Ҩҡ�ѹ��� : <input type="text" name="search_date" id="search_date"> �ٻẺ 2564-03-28
            </div>
            <div>
                <button type"submit">����</button>
            </div>
        </fieldset>
    </form>
    <?php 
    $search_date = $_POST['search_date'];
    if(!empty($search_date))
    {
        $yearTH = substr($search_date, 0, 4);
        $yearEN = $yearTH-543;
        $search_date = str_replace($yearTH, $yearEN, $search_date);
        
        ?>
        <table>
            <tr>
                <th>�Ţ�ѵû��</th>
                <th>����ʡ��</th>
                <th>������</th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>hn</td>
                <td>patient_name</td>
                <td>vaccine_code</td>
            </tr>
        </table>
        <?php
        $sql = "SELECT * FROM `ImmunizationList` WHERE `immunization_datetime` LIKE '$search_date%' ORDER BY `id` DESC ";
        $q_imlist = $dbi->query($sql);
        while ($item = $q_imlist->fetch_assoc()) {
            var_dump($item);
            
        }
    }
    ?>

</div>