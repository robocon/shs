<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ลงนามถวายพระพรออนไลน์</title>
    <style>
        * {
  box-sizing: border-box;
}
    html, body {height: 100%;margin: 0;}
    .imgThumb {width: 640px;max-width:640px;}
    label{cursor: pointer;display: block;}
    </style>
</head>
<body style="background-color: #b2dfea;">

    <div style="background-color: #ddd66d;margin-bottom:12px;">
        <img src="head.jpg" alt="ขอพระองค์ทรงพระเจริญ ด้วยเกล้าด้วยกระหม่อม ขอเดชะ" style="display: block;margin-left: auto;margin-right: auto;max-width:955px; width:100%;height:auto;">
    </div>

    <div style="max-width: 955px;width:100%;margin-left: auto;margin-right: auto;padding: 6px;border: 3px solid #bdc39d;margin-bottom: 12px;border-radius: 6px;background-color: #caf3ff;">

        <div style="margin-bottom: 12px;">
            <img src="img1.jpg" alt="ขอพระองค์ทรงพระเจริญ ด้วยเกล้าด้วยกระหม่อม ขอเดชะ" class="imgThumb" style="display: block;margin-left: auto;margin-right: auto;max-width: 640px;width: 100%;height: auto;">
        </div>

        <form action="save.php" method="post">

            <div style="max-width:640px;width:100%;margin-left: auto;margin-right: auto; margin-bottom:12px;">
                <div>
                    <b>เลือกข้อความ<span style="color:red;font-size:18px;">*</span></b>
                </div>
                <label for="intro1">
                    <input type="radio" name="intro" id="intro1" value="ขอพระองค์ทรงพระเจริญ ด้วยเกล้าด้วยกระหม่อม ขอเดชะ" required> ขอพระองค์ทรงพระเจริญ ด้วยเกล้าด้วยกระหม่อม ขอเดชะ
                </label>
                <label for="intro2">
                    <input type="radio" name="intro" id="intro2" value="ขอพระองค์ทรงพระเจริญยิ่งยืนนาน ด้วยเกล้าด้วยกระหม่อม ขอเดชะ"> ขอพระองค์ทรงพระเจริญยิ่งยืนนาน ด้วยเกล้าด้วยกระหม่อม ขอเดชะ
                </label>
                <label for="intro3">
                    <input type="radio" name="intro" id="intro3" value="ขอพระราชทานถวายพระพรชัยมงคล ขอพระองค์ทรงพระเจริญ ด้วยเกล้าด้วยกระหม่อม ขอเดชะ"> ขอพระราชทานถวายพระพรชัยมงคล ขอพระองค์ทรงพระเจริญ ด้วยเกล้าด้วยกระหม่อม ขอเดชะ
                </label>
            </div>

            <div style="max-width:640px;width:100%;margin-left: auto;margin-right: auto; margin-bottom:12px;display:table;">
                <b>ข้าพระพุทธเจ้า<span style="color:red;font-size:18px;">*</span></b>
                <div>

                </div>
                <input type="text" name="fullname" id="fullname" placeholder="ระบุชื่อ-นามสกุล" autocomplete="off" style="display: table-cell;width: 100%;padding: 6px;" required>
            </div>

            <div style="max-width:640px;width:100%;margin-left: auto;margin-right: auto; margin-bottom:12px;">
                <button style="padding: 6px;">ลงนามถวายพระพร</button>
            </div>

        </form>


        <!-- Slideshow container -->


<!-- Full-width slides/quotes -->
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

$sql = "SELECT * FROM `message` WHERE `status` = 1 ORDER BY `date` DESC LIMIT 5";
$result = $conn->query($sql);


$dotTxt = '';
if ($result->num_rows > 0) {
    // output data of each row
    ?>
    <div style="max-width:640px;width:100%;margin-left: auto;margin-right: auto; margin-bottom:12px;display:table;">
    <div class="slideshow-container">
    <?php
    $i = 1;
    while($row = $result->fetch_assoc()) {
        ?>
        <div class="mySlides">
            <q><?=$row['intro'];?></q>
            <p class="author">- ข้าพระพุทธเจ้า <?=$row['name'];?></p>
        </div>
        <?php
        $dotTxt .= '<span class="dot" onclick="currentSlide('.$i.')"></span>';

        $i++;
    }

    ?>
    <!-- Next/prev buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <!-- Dots/bullets/indicators -->
    <div class="dot-container"><?=$dotTxt;?></div>

    </div>
    <?php
}
?>



<style>
/* Slideshow container */
.slideshow-container {
  position: relative;
  background: #e6eff8;
}

/* Slides */
.mySlides {
  display: none;
  padding: 40px;
  text-align: center;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -30px;
  padding: 16px;
  color: #888;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  position: absolute;
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
  color: white;
}

/* The dot/bullet/indicator container */
.dot-container {
  text-align: center;
  padding: 20px;
  background: #d5dde5;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

/* Add a background color to the active dot/circle */
.active, .dot:hover {
  background-color: #717171;
}

/* Add an italic font style to all quotes */
q {font-style: italic;font-size:19px;}

/* Add a blue color to the author */
.author {color: cornflowerblue;}

</style>
    <script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

    </script>
    </div>
    
</body>
</html>