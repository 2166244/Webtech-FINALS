<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>

<head>
    <meta charset="UTF-8">
    <title>VehiLink Service Provider</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="">
    
    <!-- Base Css Files -->
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style-responsive.css" rel="stylesheet" />

    <link rel="shortcut icon" href="assets/img/favicon.png">
</head>

<body class="login-page">
    <!-- Begin page -->
    <div class="container">
        <div class="full-content-center">
            <p class="text-center"><a href="#"><img src="assets/img/login-logo.png" alt="Logo" class="login-logo"></a></p>
            <div class="login-wrap animated flipInX">
                <div class="login-block">
                    <img src="assets/img/icons/user.png" class="img-circle not-logged-avatar">					
                    <form action="Login" method="POST">
                        <div class="form-group login-input">
                            <i class="fa fa-user overlay"></i>
                            <input type="text" class="form-control text-input" name="username" id="username" autocomplete="off" placeholder="Username">
                        </div>
                        <div class="form-group login-input">
                            <i class="fa fa-key overlay"></i>
                            <input type="password" class="form-control text-input" name="password" id="password" placeholder="********">
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-success btn-block" placeholder="Submit"></button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
