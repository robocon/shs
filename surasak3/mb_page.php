<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Document</title>
    <!--[if lt IE 8]><link rel="stylesheet" href="assets/css/cascade/production/icons-ie7.min.css"><![endif]-->
    
    <!--[if lt IE 9]>
        <script src="assets/js/shim/iehtmlshiv.js"></script>
        <script src="templates/classic/respond.js"></script>
    <![endif]-->
    
    <script src="templates/classic/main.js"></script>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-green.css">
</head>
<body>
    <nav class="w3-sidebar w3-bar-block w3-card" id="mySidebar">
        <div class="w3-container w3-theme-d2">
            <span onclick="closeSidebar()" class="w3-button w3-display-topright w3-large">X</span>
        </div>
        <a class="w3-bar-item w3-button" href="#">���ٷ�� 1</a>
        <a class="w3-bar-item w3-button" href="#">���ٷ�� 2</a>
        <a class="w3-bar-item w3-button" href="logout.php">Logout</a>
    </nav>
    <div class="w3-bar w3-container w3-card w3-theme">
        <button class="w3-bar-item w3-button w3-xxxlarge w3-hover-theme" onclick="openSidebar()">&#9776;</button>
        <h1 class="w3-bar-item">þ.����</h1>
    </div>

    <div class="w3-container">
        Hello the World
    </div>

    <script>
    closeSidebar();
    function openSidebar() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function closeSidebar() {
        document.getElementById("mySidebar").style.display = "none";
    }
    </script>

</body>
</html>