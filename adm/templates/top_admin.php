<?php include_once("templates/validate_pages.php"); ?>
<html>

    <body>
        <?php include_once '../css/include_adm_css.php'; ?>	
        <?php include_once("../css/css_includes.php"); ?>
        <link rel="stylesheet" href="../css/admin.css">
        <style>
            #menu-text{
                color: white;
                font-size: 1.2em
            }
            
            #menu-text:hover{
                opacity: .2;
            }
            
            .fa{
                color: skyblue;
            }
            
            #logo{
                color:goldenrod;
            }
            .top-gp
            {
                background-color: #4373d3;
            }
            .side-menu-gp{
                background-color: #4373d3; /*height: 20em;*/
            }
            .active1{
                background-color: #1a3b7f;
            }
        </style>
        <!--<img src="../../images/NAF1.jpg"/>-->
        <nav class="navbar navbar-default navbar-static-top" style="margin-top: -3.5em;">
            <div class="container-fluid top-gp"> 
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <!--<button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
                        SIDE MENU
                    </button> -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<img class="image-responsive" width="40%" height="10%" src="https://res.cloudinary.com/candidbusiness/image/upload/v1455406304/dispute-bills-chicago.png" alt="Dispute Bills">-->
                    <!--<img src="../../images/chicago.png"  alt="Dispute Bills" class="image-responsive" width="100%" height="10%">-->
                    <!--<a class="navbar-brand" href="#" id='logo'>--> <!--<img src="../../images/Banner.png" width="100%" height="150%"/>-->
                        <!--<img class="image-responsive" width="50%" height="150%" src="https://res.cloudinary.com/candidbusiness/image/upload/v1455406304/dispute-bills-chicago.png" alt="Dispute Bills">-->    
                        <!--<img src="../../images/naflogo.png"  alt="NAF LOGO" class="img-responsive" width="50%" height="150%">-->
                         <!--NAF RECRUITMENT PORTAL--> 
                    <!--</a>-->
                    <a class="navbar-left" href="#"> 
                        <!--<img src="../../images/chicago.png"  alt="NAF LOGO" class="img-responsive" width="27px" height="27px">-->
                        <img src="http://airforce.mil.ng/images/logo.png"  alt="NAF LOGO" class="img-responsive" width="60%" height="60%">
                        <!--NAF RECRUITMENT PORTAL--> 
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

                    <ul class="nav navbar-nav">
                        <li style="padding-left: 420px;"><a href="#" id="menu-text" style="color: azure"><span class="fa fa-dashboard"></span> Admin Dashboard</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <!--<li><a href="http://www.pingpong-labs.com" target="_blank">Visit Site</a></li>-->
                        <li class="dropdown " style="padding-right: 1.5em">
                            <a href="logout.php"  id='menu-text'>

                                <span class="fa fa-sign-out"></span> Logout
                            </a>

                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->


            <?php
            require_once '../global/connection.php';
            require_once '../global/functions_overview.php';
            $number = get_dssc_today_stats();
            ?>
            <!-- show number registered today as a badge -->   
        </nav>  	
        <div class="container-fluid main-container" >
            <div class="col-md-2 sidebar" >
                <div class="row">
                    <!-- uncomment code for absolute positioning tweek see top comment in css -->
                    <div class="absolute-wrapper"> </div>
                    <!-- Menu -->
                    <div class="side-menu side-menu-gp" >
                        <nav class="navbar navbar-default" role="navigation" >
                            <!-- Main Menu -->
                            <div class="side-menu-container">
                                <ul class="nav navbar-nav side-menu-gp">
                                    <li class="active1"><a href="#" class="fa fa-home" id="menu-text"> Home <span class="badge badge-info"><?php echo $number['number']; ?></span></a></li>
                                    <li class="panel panel-default" id="dropdown">
                                        <a data-toggle="collapse" href="#dropdown-candidate" href="#" class="fa fa-users" id='menu-text'>
                                            Candidate
                                            <span class="caret"></span>
                                        </a>
                                        <!-- Dropdown for Candidates' Categories -->
                                        <div id="dropdown-candidate" class="panel-collapse collapse">

                                            <ul class="nav navbar-nav">
                                                <li><a href="dssc/centres_candidates.php" id='menu-text'> <span>DSSC</span></a></li>
                                                <li><a href="recruit/centres_candidates.php" id='menu-text'> Recruit</a></li>
                                            </ul>

                                        </div>

                                    </li>
                                    <!--<li><a href="specialty/index.ph" class="fa fa-space-shuttle">Specialty</a></li>-->
                                    <li  class="panel panel-default" id="dropdown">
                                        <a data-toggle="collapse" href="#dropdown-specialty" href="#" class="fa fa-space-shuttle" id='menu-text'>
                                            Specialty & Trade
                                            <span class="caret"></span>
                                        </a>
                                        <!-- Dropdown for Specialty's Categories -->
                                        <div id="dropdown-specialty" class="panel-collapse collapse">

                                            <ul class="nav navbar-nav">
                                                <li><a href="specialty/index.php" id='menu-text'> Specialty</a></li>
                                                <li><a href="trade/index.php" id='menu-text'> Trade</a></li>
                                            </ul>

                                        </div>
                                    </li>
                                    
                                    <li><a href="centre/index.php" class="fa fa-university" id='menu-text'> Centre</a></li>
                                    <li><a href="lga/index.php" class="fa fa-line-chart" id='menu-text'> LGA</a></li>

                                    <li><a href="#" class="fa fa-sign-out" style="margin-top: 30%" id='menu-text'> Logout</a></li>


                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </nav>

                    </div>
                </div>  		
            </div>
            <div class="col-md-10 content">
                <div class="panel panel-default">
                    <!--<div class="panel-heading">
                        Dashboard
                    </div>-->
                    <div class="panel-body">
                        
                    