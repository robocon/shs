<?php 

include '../bootstrap.php';
include 'head.php';
?>

<fieldset>
    <legend>ค้นหาข้อมูลตาม AN</legend>
    <form action="formNewborncare.php" method="post">
        <div>
            AN : <input type="text" name="an" id="an">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="searchAn">
        </div>
    </form>
</fieldset>

<?php 
include 'footer.php';
?>