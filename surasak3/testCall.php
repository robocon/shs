<?php 

?>
<form action="testCall.php" method="post">

    <div>
        <input type="text" name="date" id="" value=""> ธันวาคม 2562
    </div>

    <div>
        <input type="text" name="doctor" id="" value=""> MD013
    </div>

    <div>
        <button type="submit">test</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>
<?php

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

$action = $_POST['action'];
if ( $action === 'show' ) {
    # code...

    $date = $_POST['date'];
    $doctor = $_POST['doctor'];

    dump($date);
    dump($doctor);

// # ทดสอบรันใน local แต่ access เข้า .2
$mysqli = new mysqli("192.168.1.2","remoteuser","","smdb");

// ลองรันบนเซิฟเวอร์
// $mysqli = new mysqli("localhost","root","1234","smdb");

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

$sql = "CALL appoint('$date','$doctor'); ";
dump($sql);
$result = $mysqli->query($sql);
dump($result);
if ( $result === false ) {
    var_dump($mysqli->error);
}

dump($result->num_rows);

// $items = $result->fetch_all(MYSQLI_ASSOC);
// dump($items);

while ($item = $result->fetch_assoc()) {
    dump($item);
}

$result->free_result();
$mysqli->close();

exit;
}