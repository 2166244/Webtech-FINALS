<?php ob_start(); ?>

<?php require_once 'init.php'; ?>

<?php 
    $user = new User();
    $db = DB::getInstance(); 
?>

<?php get_header(); ?>

<?php if ($user->isLoggedIn()): ?>
	<!-- ============================================================== -->
    <!-- Start Content here -->
    <!-- ============================================================== -->
    <div class="content">
        <?php 
            echo "<p>".Input::get('token')."</p>";

            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {
                    switch (Input::get('table_name')) {
                        case 'users':
                            if (Input::get('action') === 'activate') {
                                try {
                                    $db->query("UPDATE users SET status = 'active' WHERE user_id = " . Input::get('u_id'));

                                    Session::flash('alert', "\"" . Input::get('u_name') . "\" has been activated.");
                                } catch (Exception $e) {
                                    die($e->getMessage());
                                }
                            } elseif (Input::get('action') === 'deny') {
                                try {
                                    $db->query("UPDATE users SET status = 'denied' WHERE user_id = " . Input::get('u_id'));

                                    Session::flash('alert', "\"" . Input::get('u_name') . "\" has been denied.");
                                } catch (Exception $e) {
                                    die($e->getMessage());
                                }
                            } elseif (Input::get('action') === 'delete') {
                                try {
                                    $db->query("UPDATE users SET status = 'deleted' WHERE user_id = " . Input::get('u_id'));

                                    Session::flash('alert', "\"" . Input::get('u_name') . "\" has been deleted.");
                                } catch (Exception $e) {
                                    die($e->getMessage());
                                }
                            }
                            break;

                        case 'vehicles':
                            if (Input::get('action') === 'approve') {
                                try {
                                    $db->query("UPDATE vehicles SET status = 'available' WHERE vehicle_id = " . Input::get('v_id'));

                                    Session::flash('alert', "\"" . Input::get('v_model') . "\" has been approved.");
                                } catch (Exception $e) {
                                    die($e->getMessage());
                                }
                            } elseif (Input::get('action') === 'deny') {
                                try {
                                    $db->query("UPDATE vehicles SET status = 'denied' WHERE vehicle_id = " . Input::get('v_id'));

                                    Session::flash('alert', "\"" . Input::get('v_model') . "\" has been denied.");
                                } catch (Exception $e) {
                                    die($e->getMessage());
                                }
                            }
                            break;
                    }
                } else {
                    echo "no token";
                }
            }

            $token = Token::generate();
        ?>

        <!-- Start info box -->
        <div class="row top-summary">
            <div class="col-lg-3 col-md-6">
                <div class="widget green-1 animated fadeInDown">
                    <div class="widget-content padding">
                        <div class="widget-icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <div class="text-box">
                            <p class="maindata">TOTAL <b>Reservations</b></p>
                            <?php 
                                $reservations = $db->query('SELECT * FROM reservations');
                            ?>
                            <h2><span class="animate-number" data-value="<?php echo $reservations->count(); ?>" data-duration="1000">0</span></h2>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="widget darkblue-2 animated fadeInDown">
                    <div class="widget-content padding">
                        <div class="widget-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="text-box">
                            <p class="maindata">Active <b>Customers</b></p>
                            <?php 
                                $customers = $db->query("SELECT * FROM users WHERE role = 'customer' AND status = 'active'");
                            ?>
                            <h2><span class="animate-number" data-value="<?php echo $customers->count(); ?>" data-duration="1000">0</span></h2>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="widget lightblue-1 animated fadeInDown">
                    <div class="widget-content padding">
                        <div class="widget-icon">
                            <i class="fa fa-car"></i>
                        </div>
                        <div class="text-box">
                            <p class="maindata">AVAILABLE <b>Vehicles</b></p>
                            <?php 
                                $services = $db->query('SELECT * FROM vehicles WHERE status = "available"');
                            ?>
                            <h2><span class="animate-number" data-value="<?php echo $services->count(); ?>" data-duration="1000">0</span></h2>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="widget pink-1 animated fadeInDown">
                    <div class="widget-content padding">
                        <div class="widget-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="text-box">
                            <p class="maindata">Active <b>Service Providers</b></p>
                            <?php 
                                $providers = $db->query("SELECT * FROM users WHERE role = 'service provider' AND status = 'active'");
                            ?>
                            <h2><span class="animate-number" data-value="<?php echo $providers->count(); ?>" data-duration="1000">0</span></h2>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of info box -->

        <?php 
            if (Session::exists('alert'))
            echo '<div class="alert alert-success"><p class="flash">' . Session::flash('alert') . '</p></div>';
        ?>

        <div class="widget">
            <div class="widget-header">
                <h2><i class="icon-users"></i> <strong>Pending</strong> Users</h2>
                <div class="additional-btn">
                    <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                </div>
            </div>
            <div class="widget-content">
                <br>
                <div class="table-responsive">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">User ID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $users = $db->query('SELECT * FROM users WHERE status = "pending"');
                                ?>

                                <?php foreach ($users->results() as $u) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $u->user_id; ?></td>
                                        <td><a href="profile.php?user=<?php echo escape($u->username); ?>"><?php echo $u->first_name . ' ' . $u->last_name; ?></a></td>
                                        <td><?php echo ucfirst($u->role); ?></td>
                                        <td class="text-center"><span class="label label-primary"><?php echo ucfirst($u->status); ?></span></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-xs action-btns">
                                                <form action="" method="post">
                                                    <input type="hidden" name="table_name" value="users">
                                                    <input type="hidden" name="u_id" value="<?php echo $u->user_id; ?>">
                                                    <input type="hidden" name="u_name" value="<?php echo $u->first_name . " " . $u->last_name; ?>">
                                                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                                                    <?php if ($u->status === 'pending' || $u->status === 'denied') : ?>
                                                        <div class="btn-wrap">
                                                            <button type="submit" name="action" value="activate" data-toggle="tooltip" title="Activate" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($u->status === 'pending' || $u->status === 'active') : ?>
                                                        <div class="btn-wrap">
                                                            <button type="submit" name="action" value="deny" data-toggle="tooltip" title="Deny" class="btn btn-warning btn-xs"><i class="fa fa-ban"></i></button>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($u->status === 'pending' || $u->status === 'active' || $u->status === 'denied') : ?>
                                                        <div class="btn-wrap">
                                                            <button type="submit" name="action" value="delete" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    <?php endif; ?>
                                                </form>
                                            </div>  
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget">
            <div class="widget-header">
                <h2><i class="icon-users"></i> <strong>Pending</strong> Vehicles</h2>
                <div class="additional-btn">
                    <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                </div>
            </div>
            <div class="widget-content">
                <br>
                <div class="table-responsive">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Vehicle ID</th>
                                    <th>Model</th>
                                    <th class="text-center">Registration Number</th>
                                    <th class="text-center">Daily Rate</th>
                                    <th>Service Provider</th>
                                    <th>Contact Number</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $vehicles = $db->query('SELECT vehicle_id,model,regno,daily_rate,username,first_name,last_name,contact_no,v.status FROM vehicles v INNER JOIN users u ON v.sp_id = u.user_id WHERE v.status = "pending" AND u.status = "active"');
                                ?>

                                <?php foreach ($vehicles->results() as $vehicle) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $vehicle->vehicle_id; ?></td>
                                        <td><?php echo $vehicle->model; ?></td>
                                        <td class="text-center"><?php echo $vehicle->regno; ?></td>
                                        <td class="text-center"><?php echo $vehicle->daily_rate; ?></td>
                                        <td><a href="profile.php?user=<?php echo escape($vehicle->username); ?>"><?php echo $vehicle->first_name . ' ' . $vehicle->last_name; ?></a></td>
                                        <td><a href="tel:<?php echo $vehicle->contact_no; ?>"><?php echo $vehicle->contact_no; ?></a></td>
                                        <td class="text-center"><span class="label label-primary"><?php echo ucfirst($vehicle->status); ?></span></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-xs action-btns">
                                                <form action="" method="post">
                                                    <input type="hidden" name="table_name" value="vehicles">
                                                    <input type="hidden" name="v_id" value="<?php echo $vehicle->vehicle_id; ?>">
                                                    <input type="hidden" name="v_model" value="<?php echo $vehicle->model . " by " . $vehicle->first_name . " " . $vehicle->last_name; ?>">
                                                    <input type="hidden" name="token" value="<?php echo $token; ?>">

                                                    <?php if ($vehicle->status === 'pending' || $vehicle->status === 'denied') : ?>
                                                        <div class="btn-wrap">
                                                            <button type="submit" name="action" value="approve" data-toggle="tooltip" title="Approve" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($vehicle->status === 'pending') : ?>
                                                        <div class="btn-wrap">
                                                            <button type="submit" name="action" value="deny" data-toggle="tooltip" title="Deny" class="btn btn-warning btn-xs"><i class="fa fa-ban"></i></button>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($vehicle->status === 'denied') : ?>
                                                        <div class="btn-wrap">
                                                            <button type="submit" name="action" value="delete" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    <?php endif; ?>
                                                </form>
                                            </div>  
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget">
            <div class="widget-header">
                <h2><i class="icon-calendar"></i> <strong>Completed</strong> Reservations</h2>
                <div class="additional-btn">
                    <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                    <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                </div>
            </div>
            <div class="widget-content">
                <br>
                <div class="table-responsive">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered datatable-with-total" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Model</th>
                                    <!-- <th class="text-center">Registration No.</th> -->
                                    <th>Customer</th>
                                    <th>Service Provider</th>
                                    <th>Pickup Date</th>
                                    <th>Return Date</th>
                                    <th class="text-center">Daily Rate</th>
                                    <th class="text-center">Total Rate</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="7" class="text-right">Total:</th>
                                    <th colspan="2" width="120" class="text-center"></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php 
                                    $reservations = $db->query('SELECT res_id,pickup_date,return_date,model,regno,daily_rate,c.username AS customer_username,c.first_name AS customer_firstname,c.last_name AS customer_lastname,sp.username AS sp_username,sp.first_name AS sp_firstname,sp.last_name AS sp_lastname,r.status, daily_rate * DATEDIFF(return_date,pickup_date) AS total_rate FROM reservations r INNER JOIN users c ON r.user_id = c.user_id INNER JOIN vehicles v ON r.vehicle_id = v.vehicle_id INNER JOIN users sp ON v.sp_id = sp.user_id WHERE c.status = "active" AND sp.status ="active" AND r.status = "complete"');

                                    $token = Token::generate();
                                ?>

                                <?php foreach ($reservations->results() as $reservation) : ?>
                                    <?php 
                                        switch ($reservation->status) {
                                            case 'pending':
                                                $status_color = 'primary';
                                                break;

                                            case 'active':
                                                $status_color = 'warning';
                                                break;

                                            case 'denied':
                                                $status_color = 'default';
                                                break;

                                            case 'deleted':
                                                $status_color = 'danger';
                                                break;

                                            case 'complete':
                                                $status_color = 'success';
                                                break;
                                        }

                                        $pickup_date = date_create($reservation->pickup_date);
                                        $return_date = date_create($reservation->return_date);
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $reservation->res_id; ?></td>
                                        <td><?php echo $reservation->model; ?></td>
                                        <!-- <td class="text-center"><?php echo $reservation->regno; ?></td> -->
                                        <td><a href="profile.php?user=<?php echo escape($reservation->customer_username); ?>"><?php echo $reservation->customer_firstname . ' ' . $reservation->customer_lastname; ?></a></td>
                                        <td><a href="profile.php?user=<?php echo escape($reservation->sp_username); ?>"><?php echo $reservation->sp_firstname . ' ' . $reservation->sp_lastname; ?></a></td>
                                        <td><?php echo date_format($pickup_date,"M d, Y @ g:ia"); ?></td>
                                        <td><?php echo date_format($return_date,"M d, Y"); ?></td>
                                        <td class="text-center">₱<?php echo number_format($reservation->daily_rate, 2); ?></td>
                                        <td class="text-center">₱<?php echo number_format($reservation->total_rate, 2); ?></td>
                                        <td class="text-center"><span class="label label-<?php echo $status_color;  ?>"><?php echo ucwords($reservation->status); ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<?php else: ?>
	<?php Redirect::to('login.php'); ?>
<?php endif; ?>

<?php get_footer(); ?>
