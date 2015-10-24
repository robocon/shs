<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=smdb', 'root', '1234');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$sql = "
UPDATE `opday` SET `kew` = NULL WHERE `thdatehn` ='21-10-255848-210' LIMIT 1 ;
UPDATE `opday` SET `kew` = NULL WHERE `thdatehn` ='21-10-255858-2085' LIMIT 1 ;
";
$stmt = $dbh->prepare($sql);
$run = $stmt->execute();
print_r($run);