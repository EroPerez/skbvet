<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="product" content="Name Plantilla">
    <meta name="description" content="Plnatilla Generica para Desarrollo">
    <meta name="author" content="Leonardo Comeron M">

    <link href="<?php echo view_css('metro-bootstrap.css'); ?>" rel="stylesheet">
   
    <link href="<?php echo view_css('iconFont.css'); ?>" rel="stylesheet">
    <link href="<?php echo view_js('prettify/prettify.css'); ?>" rel="stylesheet">

    <!-- Load JavaScript Libraries -->
    <script src="<?php echo view_js('jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo view_js('jquery/jquery.widget.min.js'); ?>"></script>
    <script src="<?php echo view_js('jquery/jquery.mousewheel.js'); ?>"></script>
    <script src="<?php echo view_js('jquery/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo view_js('prettify/prettify.js'); ?>"></script>
    <!-- Metro UI CSS JavaScript plugins -->
    <script src="<?php echo view_js('load-metro.js'); ?>"></script>

    <!-- Local JavaScript -->
 

    <title><?php echo $page_title; ?></title>
</head>
<body class="metro">
    <div class="container">
    <?php echo $header_view; ?>  
        <div class="main-content clearfix">  
            <?php echo $the_view_content; ?>
        </div>
    <?php echo $footer_view; ?>    
    </div>
    
    
</body>
</html>