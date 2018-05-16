<?php ob_start(); ?>

<?php require 'init.php'; ?>

<?php get_header(); ?>

<?php

$user = new User();

if ( ! $user->isLoggedIn())
	Redirect::to('index.php');

?>

<!-- ============================================================== -->
<!-- Start Content here -->
<!-- ============================================================== -->
<div class="content">
	<div class="full-content-center">
		<div class="login-wrap animated fadeIn">
		    <div class="login-block">
		    	<?php
					if (Input::exists()) {
						if (Token::check(Input::get('token'))) {
							$validate = new Validate();
							$validation = $validate->check($_POST, array(
								'current_password' => array(
									'required' => true,
									'min' => 6
								),
								'new_password' => array(
									'required' => true,
									'min' => 6,
								),
								'repeat_new_password' => array(
									'required' => true,
									'min' => 6,
									'matches' => 'new_password'
								),
							));

							if ($validation->passed()) {
								if (Input::get('current_password') != $user->data()->password) {
	                                echo '<div class="alert alert-danger"><p>Your current password is wrong</p></div>';
								} else {
									$user->update(array(
										'password' => Input::get('new_password')
									));

									Session::flash('changed', 'Your password has been changed.');
								}
							} else {
								echo '<div class="alert alert-danger">';
									show_errors($validation->errors());
								echo '</div>';
							}
						}
					}
		    	?>

		    	<?php 
			    	if (Session::exists('changed'))
	    		        echo '<div class="alert alert-success"><p class="flash">' . Session::flash('changed') . '</p></div>';
		    	?>

				<form action="" method="post">
					<div class="form-group login-input">
						<i class="fa fa-key overlay"></i>
						<input type="password" class="form-control text-input" name="current_password" id="current-password" placeholder="Current Password">
					</div>
					<div class="form-group login-input">
						<i class="fa fa-lock overlay"></i>
						<input type="password" class="form-control text-input" name="new_password" id="new-password" placeholder="New Password">
					</div>
					<div class="form-group login-input">
						<i class="fa fa-lock overlay"></i>
						<input type="password" class="form-control text-input" name="repeat_new_password" id="repeat-new-password" placeholder="Repeat New Password">
					</div>
					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
							<button type="submit" class="btn btn-success btn-block">Change</button>
						</div>
					</div>
				</form>
		    </div>
		</div>
	</div>

<?php get_footer(); ?>
