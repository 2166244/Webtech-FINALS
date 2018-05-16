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
            <div class="login-wrap animated fadeInDownBig">
                <div class="login-block">
                    <img src="assets/img/icons/user.png" class="img-circle not-logged-avatar">
					
                    <?php
						if (Input::exists()) {
							if (Token::check(Input::get('token'))) {
								$validate = new Validate();
								$validation = $validate->check($_POST, array(
									'username' => array(
										'required' => true,
										'min' => 2,
										'max' => 45,
										'unique' => 'users'
									),
									'password' => array(
										'required' => true,
										'min' => 6
									),
									'password_again' => array(
										'required' => true,
										'matches' => 'password'
									),
									'fname' => array(
										'required' => true,
										'min' => 2,
										'max' => 45
									),
									'lname' => array(
										'required' => true,
										'min' => 2,
										'max' => 45
									),
									'address' => array(
										'required' => true
									),
									'contact' => array(
										'required' => true
									),
									'email' => array(
										'required' => true
									)
								));

								if ($validation->passed()) {
									$user = new User();

									try {
										$user->create(array(
											'username' => Input::get('username'),
											'password' => Input::get('password'),
											'first_name' => Input::get('fname'),
											'last_name' => Input::get('lname'),
											'address' => Input::get('address'),
											'email' => Input::get('email'),
											'contact_no' => Input::get('contact'),
											'role' => Input::get('role'),
											'registration_date' => date('Y-m-d H:i:s'),
											'status' => 'Pending'
										));

										Session::flash('registered', "New ".Input::get('role')." has been registered and can now log in using the ".Input::get('role')." module.");
										Redirect::to('login.php');
									} catch (Exception $e) {
										die($e->getMessage());
									}
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
							<input type="text" class="form-control text-input" name="username" id="username" placeholder="Username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
						</div>
						<div class="form-group login-input">
							<i class="fa fa-key overlay"></i>
							<input type="password" class="form-control text-input" name="password" id="password" placeholder="Password">
						</div>
						<div class="form-group login-input">
							<i class="fa fa-key overlay"></i>
							<input type="password" class="form-control text-input" name="password_again" id="password-again" placeholder="Repeat Password">
						</div>
						<div class="form-group login-input">
							<i class="fa fa-user overlay"></i>
							<input type="text" class="form-control text-input" name="fname" id="fname" placeholder="First Name" value="<?php echo escape(Input::get('fname')); ?>" autocomplete="off">
						</div>
						<div class="form-group login-input">
							<i class="fa fa-user overlay"></i>
							<input type="text" class="form-control text-input" name="lname" id="lname" placeholder="Last Name" value="<?php echo escape(Input::get('lname')); ?>" autocomplete="off">
						</div>
						<div class="form-group login-input">
							<i class="fa fa-map-marker overlay"></i>
							<input type="text" class="form-control text-input" name="address" id="address" placeholder="Address" value="<?php echo escape(Input::get('address')); ?>" autocomplete="off">
						</div>
						<div class="form-group login-input">
							<i class="fa fa-envelope overlay"></i>
							<input type="email" class="form-control text-input" name="email" id="email" placeholder="E-mail" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off">
						</div>
						<div class="form-group login-input">
							<i class="fa fa-phone overlay"></i>
							<input type="tel" class="form-control text-input" name="contact" id="contact" placeholder="Contact Number" value="<?php echo escape(Input::get('contact')); ?>" autocomplete="off">
						</div>
						<div class="form-group login-input">
							<div class="radio iradio">
							  <label>
								<input type="radio" name="role" id="role-service-provider" value="Service Provider" checked>
								Service Provider
							  </label>
							</div>
							<div class="radio iradio">
							  <label>
								<input type="radio" name="role" id="role-client" value="Customer">
								Customer
							  </label>
							</div>
					  	</div>
						<div class="row">
							<div class="col-sm-12">
								<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
								<button type="submit" class="btn btn-default btn-block">Register</button>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
