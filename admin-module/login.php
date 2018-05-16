<?php ob_start(); ?>

<?php require_once 'init.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>VehiLink Admin Module</title>
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
					
                    <?php
						if (Session::exists('registered'))
							echo '<div class="alert alert-success"><p>' . Session::flash('registered') . '</p></div>';

						if (Input::exists()) {
							if (Token::check(Input::get('token'))) {
								$validate = new Validate();
								$validation = $validate->check($_POST, array(
									'username' => array(
										'required' => true
									),
									'password' => array(
										'required' => true
									)
								));

								if ($validation->passed()) {
									$user = new User();

									$login = $user->login(Input::get('username'), Input::get('password'));

									if ($login === 'true')
										Redirect::to('index.php');
                                    elseif ($login === 'not valid')
                                        echo '<div class="alert alert-danger"><p>Not a valid account</p></div>';
                                    else
                                        echo '<div class="alert alert-danger"><p>Invalid username/password combination</p></div>';
								} else {
									echo '<div class="alert alert-danger">';
										show_errors($validation->errors());
									echo '</div>';
								}
							}
						}
					?>
                    
					<form action="" method="post">
                        <div class="form-group login-input">
                            <i class="fa fa-user overlay"></i>
                            <input type="text" class="form-control text-input" name="username" id="username" autocomplete="off" placeholder="Username">
                        </div>
                        <div class="form-group login-input">
                            <i class="fa fa-key overlay"></i>
                            <input type="password" class="form-control text-input" name="password" id="password" placeholder="********">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
								<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                <button type="submit" class="btn btn-success btn-block">LOGIN</button>
                            </div>
                            <div class="col-sm-6">
                                <a href="register.php" class="btn btn-default btn-block">Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
