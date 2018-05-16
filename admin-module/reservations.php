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
        <!-- Page Heading Start -->
        <div class="page-heading">
            <h1><i class="fa fa-calendar"></i> Reservations</h1>
            <h3>View All Active, Denied, Pending, and Completed Reservations</h3>             
        </div>
        <!-- Page Heading End-->
        <div class="widget">
            <div class="widget-header">
                <h2><i class="icon-calendar"></i> <strong>All</strong> Reservations</h2>
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
                                    $reservations = $db->query('SELECT res_id,pickup_date,return_date,model,regno,daily_rate,c.username AS customer_username,c.first_name AS customer_firstname,c.last_name AS customer_lastname,sp.username AS sp_username,sp.first_name AS sp_firstname,sp.last_name AS sp_lastname,r.status, daily_rate * DATEDIFF(return_date,pickup_date) AS total_rate FROM reservations r INNER JOIN users c ON r.user_id = c.user_id INNER JOIN vehicles v ON r.vehicle_id = v.vehicle_id INNER JOIN users sp ON v.sp_id = sp.user_id WHERE c.status = "active" AND sp.status ="active"');

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
