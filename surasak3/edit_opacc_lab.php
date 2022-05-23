<?php 
include 'bootstrap.php';

$dbi = new mysqli('192.168.131.250','remoteuser','',DB);
$code = $_REQUEST['code'];
?>
<table>
    <tr>
        <th>code</th>
        <th>detail</th>
        <th>price</th>
    </tr>
<?php
$sql = "SELECT * FROM `labcare` WHERE `code` LIKE '$code%' ";
$q = $dbi->query($sql);
if($q->num_rows > 0)
{
    while ($a = $q->fetch_assoc()) {

        $data = "'".$a['code']."','".$a['detail']."','".$a['depart']."','".$a['part']."','".$a['price']."','".$a['yprice']."','".$a['nprice']."'";

        ?>
        <tr>
            <td><a href="javascript:void(0);" onclick="sendBack(<?=$data;?>)" target="myWindow"><?=$a['code'];?></a></td>
            <td><?=$a['detail'];?></td>
            <td><?=$a['price'];?></td>
        </tr>
        <?php
    }
}
?>
</table>
<script>
    function sendBack(code,detail,depart,part,price,yprice,nprice){
        self.opener.document.getElementById("code").value = code;
        self.opener.document.getElementById("detail").value = detail;
        self.opener.document.getElementById("depart").value = depart;
        self.opener.document.getElementById("part").value = part;
        self.opener.document.getElementById("price").value = price;
        self.opener.document.getElementById("yprice").value = yprice;
        self.opener.document.getElementById("nprice").value = nprice;
        // this.close();
    }
</script>