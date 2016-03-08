<?php use helpers\url; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Panel">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="/uploads/<?= $site_info['favicon'] ?>">

    <title><?= !empty($page_title) ? $page_title.' | ' : '' ?>Green Innovation Admin</title>

    <!-- Bootstrap CSS -->    
    <link href="/app/templates/admin/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="/app/templates/admin/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="/app/templates/admin/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="/app/templates/admin/css/font-awesome.min.css" rel="stylesheet" />    
    <!-- full calendar css-->
    <link href="/app/templates/admin/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
    <link href="/app/templates/admin/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="/app/templates/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="/app/templates/admin/css/owl.carousel.css" type="text/css">
    <link href="/app/templates/admin/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="/app/templates/admin/css/fullcalendar.css">
    <link href="/app/templates/admin/css/widgets.css" rel="stylesheet">
    <link href="/app/templates/admin/css/style.css" rel="stylesheet">
    <link href="/app/templates/admin/css/style-responsive.css" rel="stylesheet" />
    <link href="/app/templates/admin/css/xcharts.min.css" rel=" stylesheet">   
    <link href="/app/templates/admin/css/jquery-ui-1.10.4.min.css" rel="stylesheet">

    <link href="/app/templates/admin/css/_build.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="clearfix">

    <header class="header">

        <div class="header-content clearfix">

            <div class="nav search-row burger-row hidden-md hidden-lg">
                <!-- burger menu -->
                <div class="js-sidebar-toggle btn text-info">
                    <i class="fa fa-bars fa-lg"></i>
                    <i class="fa fa-times fa-lg"></i>
                </div>                
            </div>

            
            
            <!--logo start-->
            <a href="/admin" class="logo"><span class="lite">Admin Panel</span></a>
            <!--logo end-->      

            <div class="search-row">
                
            </div>  

            <div class="nav search-row" id="top_menu">
                <!--  search form start -->
                <!-- <ul class="nav top-menu">                    
                    <li>
                        <form class="navbar-form">
                            <input class="form-control" placeholder="Search" type="text">
                        </form>
                    </li>                    
                </ul> -->
                <!--  search form end -->                
            </div>

            <div class="nav search-row pull-right">
                <a href="/" class="btn text-primary"><i class="fa fa-home"></i> Go to Site</a>
                <span class="text-disabled">|</span>
                <a href="/logout" class="btn text-default text-muted"><i class="fa fa-sign-out"></i> Logout</a>
            </div>

            <div class="header-divider"></div>

        </div>       
        

    </header>      
  <!--header end-->