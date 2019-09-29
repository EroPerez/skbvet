<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Site Title-->
        <title>Animal Health Records</title>
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <!-- <link rel="icon" href="<?php echo view_css('img/favicon.ico'); ?>" type="image/x-icon">-->
        <!-- Stylesheets-->
        <link href="<?php echo view_css('admin-tools/admin-forms/css/admin-forms.css'); ?>" rel="stylesheet">

        <!-- <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:300,400,700,900">-->
        <link rel="stylesheet" type="text/css" href="<?php echo view_css('skin/default_skin/css/theme.css'); ?>">
        <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
        <![endif]-->
        <!-- Custom styles for this template -->
        <style>
            .err {
                color: red;
                font-weight: bold;
            }
        </style>
    </head>
    <body class="external-page sb-l-c sb-r-c">
        <!-- Start: Main-->
        <div id="main" class="animated fadeIn">
            <!-- Start: Content-Wrapper-->
            <section id="content_wrapper">
                <!-- begin canvas animation bg-->
                <div id="canvas-wrapper">
                    <canvas id="demo-canvas"></canvas>
                </div>
                <!-- Begin: Content-->
                <section id="content">
                    <div id="login1" class="admin-form theme-info">
                        <div class="panel-heading heading-border bg-white"><span class="panel-title"><i class="fa fa-sign-in"></i>Please sign in</span>
<!--                             <div class="section row mn">
                               <div class="col-sm-4"><a href="#" class="button btn-social facebook span-left mr5 btn-block"><span><i class="fa fa-facebook"></i></span>Facebook</a></div>
                               <div class="col-sm-4"><a href="#" class="button btn-social twitter span-left mr5 btn-block"><span><i class="fa fa-twitter"></i></span>Twitter</a></div>
                               <div class="col-sm-4"><a href="#" class="button btn-social googleplus span-left btn-block"><span><i class="fa fa-google-plus"></i></span>Google+</a></div>
                             </div>-->
                             
                        </div>
                        <div class="panel panel-info mt10 br-n">
                           
                            <form id="formlogin" method="post" action="<?php echo site_url('auth/login') ?>">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                       value="<?= $this->security->get_csrf_hash(); ?>">
                                <div class="panel-body bg-light p30">
                                    <div class="row">
                                        <div class="col-sm-7 pr30">
                                            <div class="section">
                                                <label for="Username" class="field-label text-muted fs18 mb10">Username</label>
                                                <!--                                                <label for="Username" class="field prepend-icon">
                                                                                                    <input id="Username" type="text" name="Username" placeholder="Enter username" class="gui-input">
                                                                                                    <label for="Username" class="field-icon"><i class="fa fa-user"></i></label>
                                                                                                </label>-->
                                                <?= form_error('username', '<div class="err">', '</div>'); ?>
                                                <label for="Username" class="field prepend-icon">                                                   
                                                    <input type="text" id="Username" class="gui-input" placeholder="Enter username" value="<?= set_value('username'); ?>"
                                                           name="username" autofocus>
                                                    <label for="Username" class="field-icon"><i class="fa fa-user"></i></label>
                                                </label>
                                            </div>
                                            <div class="section">
                                                <label for="Password" class="field-label text-muted fs18 mb10">Password</label>
                                                <!--                                                <label for="Password" class="field prepend-icon">
                                                                                                    <input id="Password" type="password" name="Password" placeholder="Enter password" class="gui-input">
                                                                                                    <label for="Password" class="field-icon"><i class="fa fa-lock"></i></label>
                                                                                                </label>-->
                                                <?= form_error('password', '<div class="err">', '</div>'); ?>
                                                <label for="Password" class="field prepend-icon">                                                   
                                                    <input type="password" id="Password" class="gui-input" placeholder="Enter password"
                                                           value="<?= set_value('password'); ?>" name="password">
                                                    <label for="Password" class="field-icon"><i class="fa fa-lock"></i></label>
                                                </label>
                                            </div>                                            
                                        </div>
                                        <div class="col-sm-5 br-l br-grey pl30">
                                            <h3 class="mb25"> Animal Health Records</h3>
<!--                                            <p class="mb15"><span class="fa fa-check text-success pr5 "></span></p>
                                            <p class="mb15"><span class="fa fa-times text-warning pr5 "></span></p>
                                            <p class="mb15"><span class="fa fa-check text-success pr5 "></span></p>
                                            <p class="mb15"><span class="fa fa-check text-success pr5 "></span></p>-->

                                            <?= isset($failed) && !empty($failed) ? "<p class=\"mb15\"><span class=\"fa fa-times text-warning pr5 err\"> {$failed}</span></p>" : ""; ?>                                            
                                            <p class="mb15"><span class="text-success pr5 "> <?= $this->session->flashdata('success'); ?></span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer clearfix p10 ph15">
                                    <button type="submit" class="button btn-primary mr10 pull-right">Sign In</button>
                                    <label class="switch ib switch-primary pull-left input-align mt10">
                                        <input id="remember" type="checkbox" name="remember" checked="" value="remember-me">                                      
                                        <label for="remember" data-on="YES" data-off="NO"></label> <span>Remember me</span>
                                    </label>

                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </section>
        </div>
        <!-- core scripts-->
        <script src="<?php echo view_js('plugins/core.min.js'); ?>"></script>
        <!-- Theme Javascript-->
        <!--   Theme Javascript-->
        <script src="<?php echo view_js('js/utility/utility.js'); ?>"></script>
        <!--   Theme Javascript-->
        <!-- <script src="<?php echo view_js('js/demo/demo.js'); ?>"></script>-->
        <script src="<?php echo view_js('js/main.js'); ?>"></script>
        <!-- Page Javascript-->
        <script type="text/javascript">
            jQuery(document).ready(function () {
                "use strict";
                // Init Theme Core
                Core.init();
                // Init Demo JS
                Demo.init();
                // Init CanvasBG and pass target starting location
                CanvasBG.init({
                    Loc: {
                        x: window.innerWidth / 2,
                        y: window.innerHeight / 3.3
                    },
                });
            });
        </script>
    </body>
</html>