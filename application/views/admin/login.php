<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>
<body>
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2"></div>
                <div class="col-xl-8 col-lg-8 col-md-8">
                    <div class="row login-panel">
                        <div class="col-xl-5 col-lg-5 col-md-5 no-padding">                            
                            <div class="left-panel">
                                <h5>Admin Login</h5>
                                <h2>Welcome To</h2>
                                <h3>Ledger</h3>
                                <ul>
                                    <li>Lorem Ipsum Doler vit.</li>
                                    <li>Lorem Ipsum Doler vit.</li>
                                    <li>Lorem Ipsum Doler vit.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7 col-md-7 no-padding">
                            <div class="form">
                                <?php if($error=$this->session->flashdata('login_failed')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>
                                <form action="<?php echo base_url('login/index'); ?>" method="post">
                                    <div class="field">
                                        <label>Username or Email <span>*</span>:</label>
                                        <input type="text" name="user" value="<?php echo set_value('user'); ?>">
                                        <span class="text-danger"><?php echo form_error('user'); ?></span>
                                    </div>
                                    <div class="field">
                                        <label>Password <span>*</span>:</label>
                                        <input type="password" name="pass"  value="<?php echo set_value('pass'); ?>">
                                        <span class="text-danger"><?php echo form_error('pass'); ?></span>
                                        <a href="#">Forget Your Password?</a>
                                        <div class="clearfix"></div>
                                    </div>
                                    <button type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!--<div class="create">
                        <p>Don't have an account? <a href="#">Contact us</a></p>
                    </div>-->
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2"></div>
            </div>
        </div>
    </div>
</body>
</html>