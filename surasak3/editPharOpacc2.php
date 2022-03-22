<?php 
include_once 'bootstrap.php';
?>
<form action="edit_opacc2.php" method="post">
    <div>
        วันที่: <input type="text" name="date" id="date" value="<?=$_REQUEST['date'];?>"> * 2563-09-13
    </div>
    <div>
        HN: <input type="text" name="hn" id="hn" value="<?=$_REQUEST['hn'];?>">
    </div>
    <div>
        <button type="submit">search</button>
    </div>
</form>
<?php 
if($_REQUEST['hn']){
    dump($_REQUEST);
}