<?php 
$charset = (defined('CHARSET') !== false) ? CHARSET : 'UTF-8' ; 
$title = isset($title) ? $title : '' ;
$content = isset($content) ? $content : '' ;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="<?php echo $charset;?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title;?></title>
        <meta name="description" content="<?php echo $content;?>">
        <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
        
        <link rel="stylesheet" type="text/css" media="all"  href="templates/classic/default.css" />
        <!--[if lt IE 8]><link rel="stylesheet" href="assets/css/cascade/production/icons-ie7.min.css"><![endif]-->
        <link href="jquery-ui-1.9.2/css/ui-lightness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
            <script src="assets/js/shim/iehtmlshiv.js"></script>
            <script src="templates/classic/respond.js"></script>
        <![endif]-->
        
        <script src="templates/classic/main.js"></script>
        <script src="assets/js/module/jquery/jquery-1.11.1.min.js"></script>
        <script src="jquery-ui-1.9.2/js/jquery-ui-1.9.2.custom.js"></script>
        
    </head>
    <body class="documentation">