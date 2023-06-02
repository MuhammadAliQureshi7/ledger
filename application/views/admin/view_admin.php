<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>
<body>
    <div class="page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1 col-md-1 no-padding">
                    <?php include('navigation.php'); ?> 
                </div>
                <div class="col-lg-11 col-md-11 no-padding">
                    <?php include('header.php'); ?>
                    <div class="section">
                        <div class="profile">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h1>User Profile</h1>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="panel row">
                                            <div class="col-lg-3">
                                                <div class="img-container">
                                                    <img src="<?php echo $view->image_path; ?>" alt="<?php echo $view->full_name; ?>">
                                                </div>
                                                <!--<div class="form">
                                                    <form action="<?php echo base_url('admin/update_admin_image'); ?>" method="post">
                                                        <input type="hidden" name="Full_name" value="<?php echo $view->full_name;?>">
                                                        <input type="file" name="image">
                                                        <button type="submit">Update</button>
                                                    </form>
                                                </div>-->
                                            </div>
                                            <div class="col-lg-9 col-md-9">
                                                <div class="details">
                                                    <h1><?php echo $view->full_name; ?></h1>
                                                    <div class="contact-details">
                                                        <div class="col-lg-4 col-md-4">
                                                            <div class="field">
                                                                <label>Phone :</label>
                                                                <p><?php echo $view->contact_no; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4">
                                                            <div class="field">
                                                                <label>Email :</label>
                                                                <p><?php echo $view->Email; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4">
                                                            <div class="field">
                                                                <label>Role :</label>
                                                                <p><?php echo $view->role; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4">
                                                            <div class="field">
                                                                <label>Role :</label>
                                                                <p><?php echo $view->role; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4"></div>
                                                        <div class="col-lg-4 col-md-4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('footer.php'); ?>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>