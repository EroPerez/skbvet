<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Site Title-->
        <title> <?php echo isset($title) ? $title : "Animal Health Records" ?></title>
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">

        <!-- Stylesheets-->
        <link rel="icon" href="<?php echo view_css('img/favicon.ico'); ?>" type="image/x-icon">
        <!-- Stylesheets-->
        <!--<link href="<?php echo view_css('plugins/css/tagmanager.css'); ?>" rel="stylesheet">-->
        <?php if (!isset($jsscript['hide_admin_forms'])) { ?>
            <link href = "<?php echo view_css('admin-tools/admin-forms/css/admin-forms.css'); ?>" rel = "stylesheet">
        <?php } ?>

        <link rel="stylesheet" type="text/css" href="<?php echo view_css('fonts/stateface/stateface.css'); ?>">
        <link href="<?php echo view_css('plugins/css/magnific-popup.css'); ?>" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="<?php echo view_css('fonts/glyphicons/glyphicons.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo view_css('fonts/icomoon/icomoon.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo view_css('plugins/css/core.css'); ?>">
        <!-- Grid -->
        <link rel="stylesheet" type="text/css" href="<?php echo view_css('plugins/css/jquery.dataTables.css'); ?>"> 
        <link rel="stylesheet" type="text/css" href="<?php echo view_css('plugins/css/buttons.dataTables.css'); ?>"> 
        <!-- Stylesheets datagrid easyui
        <link rel="stylesheet" type="text/css" href="<?php //echo view_css('skin/default_skin/css/easyui.css');                                               ?>">-->
        <!-- Stylesheets theme aplication-->
        <link rel="stylesheet" type="text/css" href="<?php echo view_css('skin/default_skin/css/theme.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo view_css('plugins/css/tagmanager.css'); ?>">         

        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:300,400,700,900">

        <link rel="stylesheet" type="text/css" href="<?php echo view_css('js/ammap/ammap.css'); ?>">
        <script src="<?php echo view_js('js/ammap/ammap.js'); ?>"></script>
        <script src="<?php echo view_js('js/ammap/maps/js/stKittsNevisHigh.js'); ?>"></script>
        <script src="<?php echo view_js('js/amcharts/amcharts.js'); ?>"></script>
        <script src="<?php echo view_js('js/amcharts/pie.js'); ?>"></script>
        <script src="<?php echo view_js('js/amcharts/serial.js'); ?>"></script>
        <script src="<?php echo view_js('js/amcharts/plugins/responsive/responsive.min.js'); ?>"></script>

        <script src="<?php echo view_js('js/amcharts/plugins/dataloader/dataloader.min.js'); ?>"></script>
        <script src="<?php echo view_js('js/amcharts/plugins/export/export.min.js'); ?>"></script>
        <link  type="text/css" href="<?php echo view_css('js/amcharts/plugins/export/export.css'); ?>" rel="stylesheet">


        <style>
            a[href="http://www.amcharts.com/javascript-charts/"], a[href="http://www.amcharts.com/javascript-maps/"]{
                display: none !important;
            }
            .dataTables_wrapper .dataTables_filter input {
                margin-bottom: 0.5em !important;
            }
        </style>
        <?php
        if (isset($jsscript['css_files'])) {
            foreach ($jsscript['css_files'] as $file):
                ?>
                <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                <?php
            endforeach;
        }
        ?>
        <!--[if lt IE 10]>
<div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
<script src="js/html5shiv.min.js"></script>
        <![endif]-->
    </head>
    <body class="blank-page">
        <!-- Start: Main-->
        <div id="main">
            <!-- Page Header-->
            <!--
            ---------------------------------------------------------------+
            ".navbar" Helper Classes:
            -------------------------------------------------------------------+
            * Positioning Classes:
            '.navbar-static-top' - Static top positioned navbar
            '.navbar-static-top' - Fixed top positioned navbar
            * Available Skin Classes:
            .bg-dark    .bg-primary   .bg-success
            .bg-info    .bg-warning   .bg-danger
            .bg-alert   .bg-system
            -------------------------------------------------------------------+
            Example: <header class="navbar navbar-fixed-top bg-primary">
            Results: Fixed top navbar with primary background
            -----------------------------------------------------------------
            -->
            <!-- Start: Header-->
            <header class="navbar navbar-shadow flexbox align-items-center undefined">
                <div class="navbar-branding"><a href="<?php echo site_url('pages/dashboard'); ?>" class="navbar-brand">Animal Health R</a><span id="toggle_sidemenu_l" class="fa fa-align-left"></span></div>
                <ul class="nav navbar-nav navbar-left veil reveal-lg-flex">
                    <li class="flexbox align-items-center">
                        <?php
                        switch ($pag) {
                            case 'farm':
                                ?>  
                                <form role="search" class="navbar-form navbar-left navbar-search alt"><a href="javascript:search_farmer();"><span class="hide visible-md-inline-block visible-lg-inline-block fa fa-search fs18"></span></a>
                                    <div class="form-group">
                                        <input id="search_farm" type="text" placeholder="Search..." class="form-control">
                                    </div>
                                </form>
                                <?php
                                break;
                            case 'surveillance':
                                ?> 
                                <form role="search" class="navbar-form navbar-left navbar-search alt"><a href="javascript:search_surveillance();"><span class="hide visible-md-inline-block visible-lg-inline-block fa fa-search fs18"></span></a>
                                    <div class="form-group">
                                        <input id="surveillance_case" type="text" placeholder="Search by date..." class="form-control">
                                    </div>
                                </form>
                                <?php
                                break;
                            case 'illness':
                                ?> 
                                <form role="search" class="navbar-form navbar-left navbar-search alt"><a href="javascript:search_case();"><span class="hide visible-md-inline-block visible-lg-inline-block fa fa-search fs18"></span></a>
                                    <div class="form-group">
                                        <input id="search_case" type="text" placeholder="Search..." class="form-control">
                                    </div>
                                </form>
                                <?php
                                break;
                            case 'comexp':
                                ?> 
                                <form role="search" class="navbar-form navbar-left navbar-search alt"><a href="javascript:search_comexp();"><span class="hide visible-md-inline-block visible-lg-inline-block fa fa-search fs18"></span></a>
                                    <div class="form-group">
                                        <input id="search_comexp" type="text" placeholder="Search..." class="form-control">
                                    </div>
                                </form>
                                <?php
                                break;
                            case 'comimp':
                                ?> 
                                <form role="search" class="navbar-form navbar-left navbar-search alt"><a href="javascript:search_comimp();"><span class="hide visible-md-inline-block visible-lg-inline-block fa fa-search fs18"></span></a>
                                    <div class="form-group">
                                        <input id="search_comimp" type="text" placeholder="Search..." class="form-control">
                                    </div>
                                </form>
                                <?php
                                break;
                            case 'animimp':
                                ?> 
                                <form role="search" class="navbar-form navbar-left navbar-search alt"><a href="javascript:search_animimp();"><span class="hide visible-md-inline-block visible-lg-inline-block fa fa-search fs18"></span></a>
                                    <div class="form-group">
                                        <input id="search_animimp" type="text" placeholder="Search..." class="form-control">
                                    </div>
                                </form>
                                <?php
                                break;
                            case 'animexp':
                                ?> 
                                <form role="search" class="navbar-form navbar-left navbar-search alt"><a href="javascript:search_animexp();"><span class="hide visible-md-inline-block visible-lg-inline-block fa fa-search fs18"></span></a>
                                    <div class="form-group">
                                        <input id="search_animexp" type="text" placeholder="Search..." class="form-control">
                                    </div>
                                </form>
                                <?php
                                break;
                            case 'specimen':
                                ?> 
                                <form role="search" class="navbar-form navbar-left navbar-search alt"><a href="javascript:search_specimen();"><span class="hide visible-md-inline-block visible-lg-inline-block fa fa-search fs18"></span></a>
                                    <div class="form-group">
                                        <input id="search_specimen" type="text" placeholder="Search..." class="form-control">
                                    </div>
                                </form>
                                <?php
                                break;
                        }
                        ?>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (can(array('surveillance-report', 'number-of-biological-report', 'import-licences-report', 'export-meats-report', 'animal-imported-report', 'animal-imported-report', 'export-animals-report', 'animal-illness-cases-report', 'withdrawal-period-report'))): ?>
                        <li class="p5 flexbox align-items-center pl25 br-l">
                            <div class="navbar-btn btn-group"><a href="#" data-toggle="button" class="topbar-menu-toggle btn btn-sm bg-paris-daisy circle"><span class="fa fa-magic"></span><span class="badge badge-success">8</span></a></div>
                        </li>                    
                    <?php endif ?>

                    <li class="dropdown menu-merge">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle fs16 fw400 flexbox align-items-center">
<!--                            <span class="pl25 text-dark-jungle-green letter-spacing025">
                                
                            </span>
                            <span class="caret caret-tp pr25"></span>-->
                            <div class="avatar-container hidden-xs">
                                <img src="<?php echo base_url('assets/img/avatars/placeholder.png'); ?>" width="88" height="92" class="img-rounded" alt="avatar">
                            </div>
                        </a>
                        <ul role="menu" class="dropdown-menu list-group dropdown-persist w250">
                            <li class="list-group-item"><a href="#" class="animated animated-short fadeInUp"><span class="fa fa-user"></span> <?php echo $this->session->userdata('name'); ?></a></li>

                            <?php if (can(array('index-users'))) { ?>
                                <li class="list-group-item"><a href="<?php echo site_url('pages/users'); ?>" class="animated animated-short fadeInUp"><span class="fa fa-gear"></span> Users</a></li>
                            <?php } ?>
                            <?php if (can(array('index-permissions'))) { ?>
                                <li class="list-group-item"><a href="<?php echo site_url('pages/permissions'); ?>" class="animated animated-short fadeInUp"><span class="fa fa-lock"></span> Permissions</a></li>
                            <?php } ?>
                            <li class="dropdown-footer"><a href="<?php echo site_url('auth/logout'); ?>"><span class="fa fa-power-off pr5"></span> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </header>
            <!-- Start: Sidebar-->
            <aside id="sidebar_left" class="nano nano-light affix">
                <!-- Start: Sidebar Left Content-->
                <div class="sidebar-left-content nano-content">
                    <!-- Sidebar Widget - Menu (slidedown)-->
                    <!--                    <div class="sidebar-widget menu-widget">
                    
                                        </div>-->
                    <!-- Sidebar Widget - Search (hidden)-->
                    <!--                    <div class="sidebar-widget search-widget hidden">
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span>
                                                <input id="sidebar-search" type="text" placeholder="Search..." class="form-control"/>
                                            </div>
                                        </div>-->
                    <ul class="nav sidebar-menu mt-5">
                        <li class="sidebar-label">Option Menu</li>

                        <li class="sidebar-menu-item ">
                            <a href="<?php echo site_url('pages/dashboard'); ?>" class="accordion-toggle <?php if ($pag == 'Dashboard') { ?>menu-open<?php } ?>"><span class="glyphicon glyphicon-dashboard "></span><span class="sidebar-title">Dashboard</span></a>
                        </li>
                        <?php if (can(array('index-farm'))) { ?>
                            <li class="sidebar-menu-item ">
                                <a href="<?php echo site_url('pages/farm'); ?>" class="accordion-toggle <?php if ($pag == 'farm') { ?>menu-open<?php } ?>"><span class="glyphicon glyphicon-home"></span><span class="sidebar-title">Farm</span></a>
                            </li>
                        <?php } ?>
                        <?php if (can(array('index-illness'))) { ?>
                            <li class="sidebar-menu-item ">
                                <a href="<?php echo site_url('pages/illness'); ?>" class="accordion-toggle <?php if ($pag == 'illness') { ?>menu-open<?php } ?>"><span class="fa fa-flash"></span><span class="sidebar-title">Illness</span></a>
                            </li>   
                        <?php } ?>
                        <?php if (can(array('index-comimp'))) { ?>
                            <li class="sidebar-menu-item ">
                                <a href="<?php echo site_url('pages/comimp'); ?>" class="accordion-toggle <?php if ($pag == 'comimp') { ?>menu-open<?php } ?>"><span class="glyphicon glyphicon-arrow-right"></span><span class="sidebar-title">Comp.Imp</span></a>
                            </li>
                        <?php } ?>
                        <?php if (can(array('index-comexp'))) { ?>
                            <li class="sidebar-menu-item ">
                                <a href="<?php echo site_url('pages/comexp'); ?>" class="accordion-toggle <?php if ($pag == 'comexp') { ?>menu-open<?php } ?>"><span class="glyphicon glyphicon-arrow-left"></span><span class="sidebar-title">Comp.Exp</span></a>
                            </li>
                        <?php } ?>
                        <?php if (can(array('index-animalimp'))) { ?>
                            <li class="sidebar-menu-item">
                                <a href="<?php echo site_url('pages/animalimp'); ?>" class="accordion-toggle <?php if ($pag == 'animimp') { ?>menu-open<?php } ?>"><span class="glyphicon glyphicon-arrow-right"></span><span class="sidebar-title">Animal Imp</span></a>
                            </li>
                        <?php } ?>
                        <?php if (can(array('index-animalexp'))) { ?>
                            <li class="sidebar-menu-item">
                                <a href="<?php echo site_url('pages/animalexp'); ?>" class="accordion-toggle <?php if ($pag == 'animexp') { ?>menu-open<?php } ?>"><span class="glyphicon glyphicon-arrow-left"></span><span class="sidebar-title">Animal Exp</span></a>
                            </li>
                        <?php } ?>
                        <!--<li class="sidebar-label">Elements</li> -->
                        <?php if (can(array('index-transfer'))) { ?>
                            <li class="sidebar-menu-item" >
                                <a href="<?php echo site_url('pages/transfer'); ?>" class="accordion-toggle <?php if ($pag == 'transfer') { ?>menu-open<?php } ?>"><span class="glyphicon glyphicon-transfer"></span><span class="sidebar-title">Transfer/Sales</span></a>
                            </li>
                        <?php } ?>
<!--                        <li class="sidebar-menu-item" ><a href="<?php // echo site_url('pages/abbatoir');                                        ?>" class="accordion-toggle"><span class="glyphicon glyphicon-remove"></span><span class="sidebar-title">Abbatoir</span></a>
</li>-->
                        <?php if (can(array('index-specimen'))) { ?>
                            <li class="sidebar-menu-item" >
                                <a href="<?php echo site_url('pages/specimen'); ?>" class="accordion-toggle <?php if ($pag == 'specimen') { ?>menu-open<?php } ?>"><span class="glyphicon glyphicon-arrow-right"></span><span class="sidebar-title">Specimen Permits</span></a>
                            </li>
                        <?php } ?>
                        <?php if (can(array('index-surveillance'))) { ?>
                            <li class="sidebar-menu-item ">
                                <a href="<?php echo site_url('pages/surveillance'); ?>" class="accordion-toggle <?php if ($pag == 'surveillance') { ?>menu-open<?php } ?>"><span class="glyphicon glyphicon-arrow-right"></span><span class="sidebar-title">Surveillance</span></a>
                            </li>
                        <?php } ?>
                        <li class="sidebar-menu-item">
                            <?php if (can(array('surveillance-report', 'number-of-biological-report', 'import-licences-report', 'export-meats-report', 'animal-imported-report', 'animal-imported-report', 'export-animals-report', 'animal-illness-cases-report', 'withdrawal-period-report'))) { ?>
                                <a href="#" class="accordion-toggle <?php if ($pag == 'report') { ?>menu-open<?php } ?>"><span class="fa fa-magic"></span><span class="sidebar-title">Reports</span></a>
                                <ul class="nav sub-nav">
                                    <?php if (can(array('import-licences-report'))) { ?>
                                        <li>
                                            <a href="<?php echo site_url('report/import-licences'); ?>"><span class="fa fa-search"></span>Meats Import Licences</a>
                                        </li>
                                    <?php } ?>
                                    <?php if (can(array('export-meats-report'))) { ?>
                                        <li>
                                            <a href="<?php echo site_url('report/export-meats'); ?>"><span class="fa fa-search"></span>Meats Export Licences</a>
                                        </li>
                                    <?php } ?>
                                    <?php if (can(array('animal-imported-report'))) { ?>
                                        <li>
                                            <a href="<?php echo site_url('report/animal-imported'); ?>"><span class="fa fa-search"></span>Animal Import Licences</a>
                                        </li>
                                    <?php } ?>
                                    <?php if (can(array('export-animals-report'))) { ?>
                                        <li>
                                            <a href="<?php echo site_url('report/export-animals'); ?>"><span class="fa fa-search"></span>Animal Export Licences</a>
                                        </li> 
                                    <?php } ?>
                                    <?php if (can(array('animal-illness-cases-report'))) { ?>
                                        <li>
                                            <a href="<?php echo site_url('report/animal-illness-cases'); ?>"><span class="fa fa-search"></span>Illness Cases</a>
                                        </li>
                                    <?php } ?>
                                    <?php if (can(array('withdrawal-period-report'))) { ?>
                                        <li>
                                            <a href="<?php echo site_url('report/withdrawal-period'); ?>"><span class="fa fa-search"></span>Withdrawal Period</a>
                                        </li>
                                    <?php } ?>
                                    <?php if (can(array('number-of-biological-report'))) { ?>
                                        <li>
                                            <a href="<?php echo site_url('report/number-of-biological'); ?>"><span class="fa fa-search"></span>Permit Issued</a>
                                        </li>
                                    <?php } ?>
                                    <?php if (can(array('surveillance-report'))) { ?>
                                        <li>
                                            <a href="<?php echo site_url('report/surveillance'); ?>"><span class="fa fa-search"></span>Surveillance</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>

                        <li class="sidebar-label">Maintenance</li>
                        <?php if (can(array('index-users', 'index-permissions'))) { ?>
                            <li class="sidebar-menu-item">
                                <a href="#" class="accordion-toggle <?php if ($pag == 'user') { ?>menu-open<?php } ?>"><span class="fa fa-cog"></span><span class="sidebar-title">Setting</span></a>
                                <ul class="nav sub-nav">
                                    <?php if (can(array('index-users'))) { ?>
                                        <li>
                                            <a href="<?php echo site_url('pages/users'); ?>"><span class="fa fa-user"></span>Users</a>
                                        </li>
                                    <?php } if (can(array('index-permissions'))) { ?>
                                        <li>
                                            <a href="<?php echo site_url('pages/permissions'); ?>"><span class="fa fa-lock"></span>Permissions</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li> 
                        <?php } ?>
                        <?php if (can(array('index-setup'))) { ?>
                            <li class="sidebar-menu-item">
                                <a href="<?php echo site_url('pages/setup'); ?>" class="accordion-toggle <?php if ($pag == 'setup') { ?>menu-open<?php } ?>"><span class="fa fa-rocket"></span><span class="sidebar-title">Setup</span></a>
                            </li>
                        <?php } ?>
                        <li class="list-group-item">
                            <a href="<?php echo site_url('auth/logout'); ?>" class="animated animated-short fadeInUp"><span class="fa fa-power-off "></span><span class="sidebar-title">Logout</span> </a>
                        </li>
                        <!-- sidebar bullets-->
                        <!-- sidebar progress bars-->
                    </ul>

                </div>
            </aside>

            <!-- Start: Content-Wrapper-->
            <section id="content_wrapper">
                <!-- Start: Topbar-Dropdown-->
                <div id="topbar-dropmenu" class="alt">
                    <div class="topbar-menu row">
                        <?php if (can(array('import-licences-report'))): ?>
                            <div class="col-xs-4 col-sm-2"><a href="<?php echo site_url('report/import-licences'); ?>" class="metro-tile bg-primary light"><span class="glyphicon glyphicon-search text-muted"></span><span class="metro-title">Meat Import</span></a></div>
                        <?php endif ?>
                        <?php if (can(array('export-meats-report'))): ?>
                            <div class="col-xs-4 col-sm-2"><a href="<?php echo site_url('report/export-meats'); ?>" class="metro-tile bg-info light"><span class="glyphicon glyphicon-search text-muted"></span><span class="metro-title">Meat Export</span></a></div>
                        <?php endif ?>
                        <?php if (can(array('animal-imported-report'))): ?>
                            <div class="col-xs-4 col-sm-2"><a href="<?php echo site_url('report/animal-imported'); ?>" class="metro-tile bg-success light"><span class="glyphicon glyphicon-search text-muted"></span><span class="metro-title">Animal Import</span></a></div>
                        <?php endif ?>
                        <?php if (can(array('export-animals-report'))): ?>
                            <div class="col-xs-4 col-sm-2"><a href="<?php echo site_url('report/export-animals'); ?>" class="metro-tile bg-system light"><span class="glyphicon glyphicon-search text-muted"></span><span class="metro-title">Animal Export</span></a></div>
                        <?php endif ?>
                        <?php if (can(array('animal-illness-cases-report'))): ?>
                            <div class="col-xs-4 col-sm-2"><a href="<?php echo site_url('report/animal-illness-cases'); ?>" class="metro-tile bg-warning light"><span class="fa fa-search text-muted"></span><span class="metro-title">Illness Case</span></a></div>
                        <?php endif ?>
                        <?php if (can(array('surveillance-report'))): ?>
                            <div class="col-xs-4 col-sm-2"><a href="<?php echo site_url('report/surveillance'); ?>" class="metro-tile bg-alert light"><span class="glyphicon glyphicon-search text-muted"></span><span class="metro-title">Surveillance</span></a></div>
                        <?php endif ?>
                        <?php if (can(array('number-of-biological-report'))): ?>
                            <div class="col-xs-4 col-sm-2"><a href="<?php echo site_url('report/number-of-biological'); ?>" class="metro-tile bg-system light"><span class="glyphicon glyphicon-search text-muted"></span><span class="metro-title">Specimen Permit Issued</span></a></div>
                        <?php endif ?>
                        <?php if (can(array('withdrawal-period-report'))): ?>
                            <div class="col-xs-4 col-sm-2"><a href="<?php echo site_url('report/withdrawal-period'); ?>" class="metro-tile bg-danger light"><span class="glyphicon glyphicon-search text-muted"></span><span class="metro-title">Withdrawal Period</span></a></div>
                        <?php endif ?>
                    </div>
                </div>                
                <!-- Begin: Content-->
                <section id="content" class="animated fadeIn">
                    <!--AQUI PONGO EL CONTENIDO -->
                    <?php echo $the_view_content ?>
                </section>
            </section>
            <!-- Start: Right Sidebar-->

        </div>
        <!-- core scripts-->
        <script src="<?php echo view_js('js/jquery-3.1.1.min.js'); ?>"></script>
        <script src="<?php echo view_js('js/jquery/jquery_002.js'); ?>"></script>
        <script src="<?php echo view_js('plugins/core.min.js'); ?>"></script>
        <!-- Datatablet -->
        <script src="<?php echo view_js('js/jquery/jquery.dataTables.js'); ?>"></script>
        <script src="<?php echo view_js('js/jquery/dataTables.buttons.js'); ?>"></script>

        <script src="<?php echo view_js('js/jquery/pdfmake.js'); ?>"></script>
        <script src="<?php echo view_js('js/jquery/jszip.js'); ?>"></script>
        <script src="<?php echo view_js('js/jquery/vfs_fonts.js'); ?>"></script>
        <script src="<?php echo view_js('js/jquery/buttons.html5.js'); ?>"></script>
        <script src="<?php echo view_js('js/jquery/buttons.print.js'); ?>"></script>
        <!-- jQuery easy ui-->
        <script src="<?php echo view_js('js/jquery.easyui.min.js'); ?>"></script>
        <!-- jQuery Validate Plugin-->
        <script src="<?php echo view_js('admin-tools/admin-forms/js/jquery.validate.min.js'); ?>"></script>
        <!-- jQuery Validate Addon-->
        <script src="<?php echo view_js('admin-tools/admin-forms/js/additional-methods.min.js'); ?>"></script>
        <!-- AdminForms JS-->
        <script src="<?php echo view_js('admin-tools/admin-forms/js/jquery-ui-monthpicker.min.js'); ?>"></script>
        <script src="<?php echo view_js('admin-tools/admin-forms/js/jquery-ui-datepicker.min.js'); ?>"></script>
        <script src="<?php echo view_js('admin-tools/admin-forms/js/jquery.spectrum.min.js'); ?>"></script>
        <script src="<?php echo view_js('admin-tools/admin-forms/js/jquery.stepper.min.js'); ?>"></script>
        <!-- grid plugin 
       <script src="<?php echo view_js('plugins/grid/gijgo.min.js'); ?>"></script> -->

        <!-- grid multiselect --> 
        <script src="<?php echo view_js('js/dual-list-box.min.js'); ?>"></script>
        <!--   Theme Javascript-->
        <script src="<?php echo view_js('js/utility/utility.js'); ?>"></script>
        <script src="<?php echo view_js('js/demo/demo.js'); ?>"></script>
        <script src="<?php echo view_js('js/main.js'); ?>"></script>

        <script src="<?php echo view_js('js/demo/widgets.js'); ?>"></script>

        <?php echo $jsscript['script']; ?>

        <?php
        if (isset($jsscript['js_files'])) {
            foreach ($jsscript['js_files'] as $file):
                ?>
                <script src="<?php echo $file; ?>"></script>
                <?php
            endforeach;
        }
        ?>
<!--        <script type="text/javascript">
window.onload = function () {
//hideGroups();
}
//map.hideGroup("Saint John Capisterre");
</script>-->
    </body>
</html>
