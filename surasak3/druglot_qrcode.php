<?php
session_start();
?>
<html>
<head>
</head>
<body onLoad="print();">
<?php
echo $_SESSION["druglot_qrcode"];
?></body>
</html>