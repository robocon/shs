<?php 

$servername = "localhost";
$username = "surasakh_tawaiprapon";
$password = "nO9clvDW1";
$dbname = "surasakh_tawaiprapon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$conn->query("SET NAMES UTF8");

$status = 1;

$sql = "INSERT INTO `message` (`id`, `date`, `intro`, `name`, `status`) VALUES (NULL, NOW(), ?, ?, ?);";
$stmt = $conn->prepare($sql);

$stmt->bind_param("ssi", $intro, $fullname, $status);

// set parameters and execute
$intro = $_POST['intro'];
$fullname = $_POST['fullname'];
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: index.php");