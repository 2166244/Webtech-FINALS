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
                    if (Input::get('action') === 'activate') {
                        try {
                            $db->query("UPDATE users SET status = 'active' WHERE user_id = " . Input::get('u_id'));

                            Session::flash('alert', "<div class='alert alert-success'><p class='flash'>\"" . Input::get('u_name') . "\" has been activated.</p></div>");
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    } elseif (Input::get('action') === 'deny') {
                        try {
                            $db->query("UPDATE users SET status = 'denied' WHERE user_id = " . Input::get('u_id'));

                            Session::flash('alert', "<div class='alert alert-warning'><p class='flash'>\"" . Input::get('u_name') . "\" has been denied.</p></div>");
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    } elseif (Input::get('action') === 'delete') {
                        try {
                            $db->query("UPDATE users SET status = 'deleted' WHERE user_id = " . Input::get('u_id'));

                            Session::flash('alert', "<div class='alert alert-danger'><p class='flash'>\"" . Input::get('u_name') . "\" has been deleted.</p></div>");
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }
                    }
                }
            }
        ?>
        <!-- Page Heading Start -->
        <div class="page-heading">
            <h1><i class="fa fa-users"></i> User Management</h1>
            <h3>View, Activate, Deny, and Delete Users</h3>             
        </div>
        <!-- Page Heading End-->
        <?php 
            if (Session::exists('alert'))
                echo Session::flash('alert');
        ?>
        <div class="widget">
            <div class="widget-header">
                <h2><i class="icon-users"></i> <strong>All</strong> Users</h2>
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
                                    $users = $db->query('SELECT * FROM users WHERE NOT role = "admin"');

                                    $token = Token::generate();
                                ?>

                                <?php foreach ($users->results() as $u) : ?>
                                    <?php 
                                        switch ($u->status) {
                                            case 'pending':
                                                $status_color = 'primary';
                                                break;

                                            case 'active':
                                                $status_color = 'success';
                                                break;

                                            case 'denied':
                                                $status_color = 'warning';
                                                break;

                                            case 'deleted':
                                                $status_color = 'danger';
                                                break;
                                        }
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $u->user_id; ?></td>
                                        <td><a href="profile.php?user=<?php echo escape($u->username); ?>"><?php echo $u->first_name . ' ' . $u->last_name; ?></a></td>
                                        <td><?php echo ucwords($u->role); ?></td>
                                        <td class="text-center"><span class="label label-<?php echo $status_color;  ?>"><?php echo ucwords($u->status); ?></span></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-xs action-btns">
                                                <form action="" method="post">
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
<?php else: ?>
	<?php Redirect::to('login.php'); ?>
<?php endif; ?>

<?php get_footer(); ?>
