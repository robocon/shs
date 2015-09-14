<?php 
$charset = (defined('CHARSET') !== false) ? CHARSET : 'utf-8' ; 
$title = isset($title) ? $title : '' ;
$content = isset($content) ? $content : '' ;
?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
        
        <meta http-equiv="Content-type" content="text/html; charset=<?php echo $charset;?>" />
        
        <link rel="stylesheet" type="text/css" media="all"  href="templates/classic/default.css" />
        <!--[if lt IE 8]><link rel="stylesheet" href="assets/css/cascade/production/icons-ie7.min.css"><![endif]-->
        <link href="jquery-ui-1.9.2/css/ui-lightness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
        
        <!--[if lt IE 9]><script src="assets/js/shim/iehtmlshiv.js"></script><![endif]-->
        <title><?php echo $title;?></title>
        <meta name="description" content="<?php echo $content;?>">
        <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="assets/js/module/jquery/jquery-1.11.1.min.js"></script>
        <script src="jquery-ui-1.9.2/js/jquery-ui-1.9.2.custom.js"></script>
        
    </head>
    <body class="documentation">