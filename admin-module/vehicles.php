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
            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {
                    if (Input::get('action') === 'approve') {
                        try {
                            $db->query("UPDATE vehicles SET status = 'available' WHERE vehicle_id = " . Input::get('v_id'));

                            Session::flash('alert', "<div class='alert alert-success'><p class='flash'>\"" . Input::get('v_model') . "\" has been approved.</p></div>");
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    } elseif (Input::get('action') === 'deny') {
                        try {
                            $db->query("UPDATE vehicles SET status = 'denied' WHERE vehicle_id = " . Input::get('v_id'));

                            Session::flash('alert', "<div class='alert alert-warning'><p class='flash'>\"" . Input::get('v_model') . "\" has been denied.</p></div>");
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    } elseif (Input::get('action') === 'delete') {
                        try {
                            $db->query("UPDATE vehicles SET status = 'deleted' WHERE vehicle_id = " . Input::get('v_id'));

                            Session::flash('alert', "<div class='alert alert-danger'><p class='flash'>\"" . Input::get('v_model') . "\" has been deleted.</p></div>");
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    }
                }
            }
        ?>
        <!-- Page Heading Start -->
        <div class="page-heading">
            <h1><i class="fa fa-users"></i> Vehicles</h1>
            <h3>View, Approve, Deny, and Delete Vehicles</h3>             
        </div>
        <!-- Page Heading End-->
        <?php 
            if (Session::exists('alert'))
                echo Session::flash('alert');
        ?>
        <div class="widget">
            <div class="widget-header">
                <h2><i class="icon-users"></i> <strong>All</strong> Vehicles</h2>
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
                                    $vehicles = $db->query('SELECT vehicle_id,model,regno,daily_rate,username,first_name,last_name,contact_no,v.status FROM vehicles v INNER JOIN users u ON v.sp_id = u.user_id WHERE u.status = "active"');

                                    $token = Token::generate();
                                ?>

                                <?php foreach ($vehicles->results() as $vehicle) : ?>
                                    <?php 
                                        switch ($vehicle->status) {
                                            case 'pending':
                                                $status_color = 'primary';
                                                break;

                                            case 'available':
                                                $status_color = 'success';
                                                break;

                                            case 'not available':
                                                $status_color = 'info';
                                                break;

                                            case 'denied':
                                                $status_color = 'default';
                                                break;

                                            case 'deleted':
                                                $status_color = 'danger';
                                                break;
                                        }
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $vehicle->vehicle_id; ?></td>
                                        <td><?php echo $vehicle->model; ?></td>
                                        <td class="text-center"><?php echo $vehicle->regno; ?></td>
                                        <td class="text-center">₱<?php echo number_format($vehicle->daily_rate, 2); ?></td>
                                        <td><a href="profile.php?user=<?php echo escape($vehicle->username); ?>"><?php echo $vehicle->first_name . ' ' . $vehicle->last_name; ?></a></td>
                                        <td><a href="tel:<?php echo $vehicle->contact_no; ?>"><?php echo $vehicle->contact_no; ?></a></td>
                                        <td class="text-center"><span class="label label-<?php echo $status_color;  ?>"><?php echo ucwords($vehicle->status); ?></span></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-xs action-btns">
                                                <form action="" method="post">
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
<?php else: ?>
	<?php Redirect::to('login.php'); ?>
<?php endif; ?>

<?php get_footer(); ?>
