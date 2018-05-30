<%@page import="java.sql.Statement"%>
<%@page import="javax.imageio.ImageIO"%>
<%@page import="java.awt.image.BufferedImage"%>
<%@page import="sun.misc.BASE64Encoder"%>
<%@page import="java.lang.NullPointerException"%>
<%@page import="java.io.InputStream"%>
<%@page import="java.io.ByteArrayOutputStream"%>
<%@page import="javabeans.Car"%>
<%@page import="java.util.*"%>
<%@page import="com.Request"%>
<%@page import="com.Service"%>
<%@page import="java.sql.Connection"%>
<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.PreparedStatement"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.Blob"%>

<%@page language="java" contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add a car</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="">
    <meta name="keywords" content="coco bootstrap template, coco admin, bootstrap,admin template, bootstrap admin,">
    <meta name="author" content="Huban Creative">
    <!-- Base Css Files -->
    <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" />
    <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet" />
    <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
    <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" />
    <link href="assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" />
    <link href="assets/libs/pace/pace.css" rel="stylesheet" />
    <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" />
    <link href="assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
    <link href="assets/libs/jquery-icheck/skins/all.css" rel="stylesheet" />
    <!-- Code Highlighter for Demo -->
    <link href="assets/libs/prettify/github.css" rel="stylesheet" />
    <!-- Extra CSS Libraries Start -->
    <link href="assets/libs/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/morrischart/morris.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/jquery-clock/clock.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-calendar/css/bic_calendar.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/jquery-weather/simpleweather.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-xeditable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- Extra CSS Libraries End -->
    <link href="assets/css/style-responsive.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    <link rel="shortcut icon" href="assets/img/favicon.png">
</head>

<body class="fixed-left">
    <!-- Modal Start -->
    <!-- Modal Task Progress -->
    <div class="md-modal md-just-me" id="logout-modal">
        <div class="md-content">
            <h3><strong>Logout</strong> Confirmation</h3>
            <div>
                <p class="text-center">Are you sure want to logout?</p>
                <p class="text-center">
                    <button class="btn btn-danger md-close">Nope!</button>
                    <a href="login.jsp" class="btn btn-success md-close">Yeah, I'm sure</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Modal End -->
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <div class="topbar-left">
                <div class="logo">
                    <h1><a href="index.jsp"><img src="assets/img/logo.png" alt="Logo"></a></h1>
                </div>
                <button class="button-menu-mobile open-left">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-collapse2">
                        <ul class="nav navbar-nav navbar-right top-navbar">
                            <li class="dropdown iconify hide-phone">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i><span class="label label-danger absolute">4</span></a>
                                <ul class="dropdown-menu dropdown-message">
                                    <li class="dropdown-header notif-header"><i class="icon-bell-2"></i> New Notifications<a class="pull-right" href="#"><i class="fa fa-cog"></i></a></li>
                                   
                                    <li class="dropdown-footer">
                                        <div class="btn-group btn-group-justified">
                                         
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                            <li class="dropdown topbar-profile">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="rounded-image topbar-profile-image"><img src="assets/img/icons/user.png"></span> <%=session.getAttribute("username")%> <i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">My Profile</a></li>
                                    <li><a href="#">Change Password</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-help-2"></i> Help</a></li>
                                    <li><a class="md-trigger" data-modal="logout-modal"><i class="icon-logout-1"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->
        <!-- Left Sidebar Start -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!-- Search form -->
                <!-- <form role="search" class="navbar-form">
                    <div class="form-group">
                        <input type="text" placeholder="Search" class="form-control">
                        <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                    </div>
                </form> -->
                <div class="clearfix">&nbsp;</div>
                <!--- Profile -->
                <div class="profile-info">
                    <div class="col-xs-4">
                        <a href="#" class="rounded-image profile-image"><img src="assets/img/icons/user.png"></a>
                    </div>
                    <div class="col-xs-8">
                        <div class="profile-text">Welcome <b><%=session.getAttribute("username")%></b></div>
                        <div class="profile-buttons">
                            <a href="#"><i class="fa fa-user pulse"></i></a>
                            <a href="lockscreen.html"><i class="icon-lock-1"></i></a>
                            <a href="#" class="md-trigger" data-modal="logout-modal" title="Sign Out"><i class="fa fa-power-off text-red-1"></i></a>
                        </div>
                    </div>
                </div>
                <!--- Divider -->
                <div class="clearfix"></div>
                <hr class="divider" />
                <div class="clearfix"></div>
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>
                       <li class='has_sub'><a href='javascript:void(0);'><i class='glyphicon glyphicon-plus'></i><span>Requests</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                            <ul>
                                <li><a href='requests.jsp'><span>Current Requests</span></a></li>
                                <li><a href='crequests.jsp'><span>Canceled Requests</span></a></li>
                            </ul>
                        </li>
                        <li><a href='javascript:void(0);'><i class='icon-exchange'></i><span>Transactions</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                            <ul>
                                 <li><a href='cutransactions.jsp'><span>Current Transactions</span></a></li>
                                <li><a href='catransactions.jsp'><span>Canceled Transactions</span></a></li>
                                <li><a href='hitransactions.jsp'><span>History of Transactions</span></a></li>
                            </ul>
                        </li>
                        <li><a href='javascript:void(0);'><i class='fa fa-car'></i><span>All Cars</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                             <ul>
                                <li><a href='garage.jsp'><span>Garage</span></a></li>
                                <li><a href='addCar.jsp'><span>Add a Car</span></a></li>   
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Start right content -->
        <div class="content-page">
            <!-- ============================================================== -->
            <!-- Start Content here -->
            <!-- ============================================================== -->
            <div class="content">
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <!--<form action ="AddCar" method="POST">-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Car</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        

                    </div>
                    <!--</form>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 portlets">
                        <div class="widget">
                            <div class="widget-header">
                                <h2><i class="fa fa-cab"></i> <strong>Add</strong> Car</h2>
                                <div class="additional-btn">
                                    <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                                    <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                                    <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                                </div>
                            </div>
                            <div class="modal-body">
                            <form>
                                <div class="row">
                                    
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Model" name="model">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Seating Capacity" name="seating_capacity">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Luggage Capacity" name="luggage_capacity">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Daily Rate" name="price">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control"  placeholder="Aircondition" name="aircon">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Transmission (Automatic/Manual)" name="transmission">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Pickup Location" name="location">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="photo">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                                        <%
                                        String model=request.getParameter("model");
                                        String seating_capacity=request.getParameter("seating_capacity");
                                        String luggage_capacity=request.getParameter("luggage_capacity");
                                        String aircon=request.getParameter("aircon");                                       
                                        String regno=request.getParameter("regno");
                                        String price=request.getParameter("price");
                                        String photo=request.getParameter("photo");
                                        String transmission=request.getParameter("transmission");
                                        String location=request.getParameter("location");
                                        try
                                        {
                                        Class.forName("com.mysql.jdbc.Driver");
                                        Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/rental", "root", "");
                                         Statement st=conn.createStatement();

                                        int i=st.executeUpdate("insert into vehicles(model,seating_capacity,luggage_capacity,air_conditioned,transmission,regno,daily_rate,picture,pickup_location)values('"+model+"','"+seating_capacity+"','"+luggage_capacity+"','"+aircon+"','"+transmission+"','"+regno+"','"+price+"','"+photo+"','"+location+"')");
                                        out.println("Data is successfully inserted!");
                                        }
                                        catch(Exception e)
                                        {
                                        System.out.print(e);
                                        e.printStackTrace();
                                        }
                                        %>
                                        <button type="submit" class="btn btn-primary">Save changes</a></button>
                                    </div>
                                </div>
                            </form>
                          <!-- end here -->
                        </div>
                            <!--<div class="widget-content">
                                <div id="addCar" class="collapse in hidden-xs">
                                    &nbsp;
                                    <div class="row" style="margin: 0;">
                                          
                                    </div>
                                    &nbsp;
                                </div>-->
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
                
                <!-- Footer Start -->
                <footer>
                    VehiLink &copy; 2018
                    <div class="footer-links pull-right">
                        <a href="#">About</a><a href="#">Terms of Service</a><a href="#">Contact Us</a>
                    </div>
                </footer>
                <!-- Footer End -->
            </div>
            <!-- ============================================================== -->
            <!-- End content here -->
            <!-- ============================================================== -->
        </div>
        <!-- End right content -->
    </div>
    <!-- End of page -->
    <!-- the overlay modal element -->
    <div class="md-overlay"></div>
    <!-- End of eoverlay modal -->
    <script>
    var resizefunc = [];
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/libs/jquery/jquery-1.11.1.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/libs/jquery-detectmobile/detect.js"></script>
    <script src="assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
    <script src="assets/libs/ios7-switch/ios7.switch.js"></script>
    <script src="assets/libs/fastclick/fastclick.js"></script>
    <script src="assets/libs/jquery-blockui/jquery.blockUI.js"></script>
    <script src="assets/libs/bootstrap-bootbox/bootbox.min.js"></script>
    <script src="assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
    <script src="assets/libs/nifty-modal/js/classie.js"></script>
    <script src="assets/libs/nifty-modal/js/modalEffects.js"></script>
    <script src="assets/libs/sortable/sortable.min.js"></script>
    <script src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
    <script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/libs/bootstrap-select2/select2.min.js"></script>
    <script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/libs/pace/pace.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="assets/libs/jquery-icheck/icheck.min.js"></script>
    <!-- Demo Specific JS Libraries -->
    <script src="assets/libs/prettify/prettify.js"></script>
    <script src="assets/js/init.js"></script>
    <!-- Page Specific JS Libraries -->
    <script src="assets/libs/d3/d3.v3.js"></script>
    <script src="assets/libs/rickshaw/rickshaw.min.js"></script>
    <script src="assets/libs/raphael/raphael-min.js"></script>
    <script src="assets/libs/morrischart/morris.min.js"></script>
    <script src="assets/libs/jquery-knob/jquery.knob.js"></script>
    <script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js"></script>
    <script src="assets/libs/jquery-clock/clock.js"></script>
    <script src="assets/libs/jquery-easypiechart/jquery.easypiechart.min.js"></script>
    <script src="assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js"></script>
    <script src="assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js"></script>
    <script src="assets/libs/bootstrap-calendar/js/bic_calendar.min.js"></script>
    <script src="assets/js/apps/calculator.js"></script>
    <script src="assets/js/apps/todo.js"></script>
    <script src="assets/js/apps/notes.js"></script>
    <script src="assets/js/pages/index.js"></script>
</body>
</html>
