<?php
include_once 'bootstrap.php';
$dbi = new mysqli(REMOTE_HOST,REMOTE_USER,'',DB);

$hn = $_GET['hn'];

$sql = "select labnumber from orderhead where patienttype = 'OPD' and orderdate like '2022-03-23%' and hn = '$hn'";
$q = $dbi->query($sql);
while ($a = $q->fetch_assoc()) {

    $labnumber = $a['labnumber'];
    $sqlDetail = "select labnumber,labcode from orderdetail where labnumber = '$labnumber' ";
    $qd = $dbi->query($sqlDetail);
    ?>
    <form action="hotfix23Patho.php?labnumber=<?=$labnumber;?>&hn=<?=$hn;?>" method="POST">
    <table border="1">
        <tr>
            <td>labnumber</td>
            <td>code</td>
            <td>price</td>
        </tr>
    <?php
    $allprice = 0;
    while ($od = $qd->fetch_assoc()) {
        $odLabnumber = $od['labnumber'];
        $odLabcode = $od['labcode'];
        
        $sqlLabcare = "select `code`,`price`,`yprice`,`nprice` from labcare where code = '$odLabcode' ";
        $qlc = $dbi->query($sqlLabcare);
        $lc = $qlc->fetch_assoc();
        ?>
        <tr>
            <td><?=$odLabnumber;?></td>
            <td><?=$odLabcode;?></td>
            <td><?=$lc['price'];?></td>
        </tr>
        <?php
        $allprice += $lc['price'];
    }
    ?>
    <tr>
        <td colspan="2">รวมราคา</td>
        <td><?=$allprice;?></td>
    </tr>
    <tr>
        <td colspan="3">
            <button type="submit">บันทึก depart</button>
            <input type="hidden" name="hn" value="<?=$hn;?>">
        </td>
    </tr>
    </table>
    </form>
    <?php
}

?>


<script>
    function selectAll(source){
        var items = document.getElementsByClassName('selectItem');
        for (let index = 0; index < items.length; index++) {
            const element = items[index];
            element.checked = source.checked;
        }
    }
</script>