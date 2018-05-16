<?php 

require_once 'init.php';

if ( ! $username = Input::get('user')) {
	Redirect::to('index.php');
} else {
	$user = new User($username);

	if ( ! $user->exists())
		Redirect::to(404);
	else
		$data = $user->data();
?>

<?php get_header(); ?>

	<!-- ============================================================== -->
    <!-- Start Content here -->
    <!-- ============================================================== -->
    <div class="profile-banner" style="background-image: url(assets/img/about-background.jpg);">
        <div class="col-sm-3 avatar-container">
            <img src="assets/img/icons/user.png" class="img-circle profile-avatar" alt="User avatar">
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-sm-3">
                <!-- Begin user profile -->
                <div class="text-center user-profile-2">
                    <h4><b><?php echo escape($data->first_name) . " " . escape($data->last_name); ?></b></h4>
                    <h5><?php echo ucfirst($data->role); ?></h5>
                    <ul class="list-group profile-labels">
                        <?php
                            $db = DB::getInstance();

                            $approved = $db->query('SELECT * FROM reservations WHERE (status = "active" OR status = "complete") AND user_id = "' . $data->user_id . '"');
                            $approved_reservations = $approved->count();

                            $pending = $db->query('SELECT * FROM reservations WHERE status = "pending" AND user_id = "' . $data->user_id . '"');
                            $pending_reservations = $pending->count();

                            $denied = $db->query('SELECT * FROM reservations WHERE status = "denied" AND user_id = "' . $data->user_id . '"');
                            $denied_reservations = $denied->count();


                            $approved = $db->query('SELECT * FROM vehicles WHERE (status = "available" OR status = "not available") AND sp_id = "' . $data->user_id . '"');
                            $approved_vehicles = $approved->count();

                            $pending = $db->query('SELECT * FROM vehicles WHERE status = "pending" AND sp_id = "' . $data->user_id . '"');
                            $pending_vehicles = $pending->count();

                            $denied = $db->query('SELECT * FROM vehicles WHERE status = "denied" AND sp_id = "' . $data->user_id . '"');
                            $denied_vehicles = $denied->count();

                            switch ($data->role) {
                                case 'customer':
                                    echo '<li class="list-group-item">';
                                    echo '<span class="badge">'. $approved_reservations .'</span> Approved Reservations';
                                    echo '</li>';
                                    echo '<li class="list-group-item">';
                                    echo '<span class="badge">'. $pending_reservations .'</span> Pending Reservations';
                                    echo '</li>';
                                    echo '<li class="list-group-item">';
                                    echo '<span class="badge">'. $denied_reservations .'</span> Denied Reservations';
                                    echo '</li>';
                                    break;

                                case 'service provider':
                                    echo '<li class="list-group-item">';
                                    echo '<span class="badge">'. $approved_vehicles .'</span> Approved Vehicles';
                                    echo '</li>';
                                    echo '<li class="list-group-item">';
                                    echo '<span class="badge">'. $pending_vehicles .'</span> Pending Vehicles';
                                    echo '</li>';
                                    echo '<li class="list-group-item">';
                                    echo '<span class="badge">'. $denied_vehicles .'</span> Denied Vehicles';
                                    echo '</li>';
                                    break;
                            }
                        ?>
                    </ul>
                    <?php if ($data->role === 'admin') : ?>
                        <!-- User button -->
                        <div class="user-button">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="change_password.php" class="btn btn-success btn-sm btn-block">Change Password</a>
                                </div>
                                <div class="col-lg-6">
                                    <a href="#" class="btn btn-danger btn-sm btn-block md-trigger" data-modal="logout-modal">Logout</a>
                                </div>
                            </div>
                        </div>
                        <!-- End div .user-button -->
                    <?php endif; ?>
                </div>
                <!-- End div .box-info -->
                <!-- Begin user profile -->
            </div>
            <!-- End div .col-sm-4 -->
            <div class="col-sm-9">
                <div class="widget widget-tabbed">
                    <div class="user-profile-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4><strong>ABOUT</strong> ME</h4>
                                <p>
                                    <strong>First Name:</strong> 
                                    <?php echo $data->first_name; ?>
                                </p>
                                <p>
                                    <strong>Last Name:</strong> <?php echo $data->last_name; ?>
                                </p>
                                <p>
                                    <strong>Role:</strong> <?php echo ucwords($data->role); ?>
                                </p>
                                <p>
                                    <strong>Status:</strong> <?php echo ucwords($data->status); ?>
                                </p>
                                <p>
                                    <strong>Date Joined:</strong> <?php echo date_format(date_create($data->registration_date),"F d, Y"); ?>
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <h4><strong>CONTACT</strong> ME</h4>
                                <p>
                                    <strong>Phone:</strong> <a href="tel:<?php echo $data->contact_no; ?>"><?php echo $data->contact_no; ?></a>
                                </p>
                                <p>
                                    <strong>Email:</strong> <a href="mailto:<?php echo $data->email; ?>"><?php echo $data->email; ?></a>
                                </p>
                                <p>
                                    <strong>Address:</strong> <?php echo $data->address; ?>
                                </p>
                            </div>
                        </div>
                        <!-- End div .row -->
                    </div>
                </div>
                <!-- End div .box-info -->
            </div>
        </div>

<?php get_footer(); ?>

<?php } ?>
