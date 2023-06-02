<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php') ?>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="section">
        <div class="form">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="text-wrap">
                            <h1>Success</h1>
                            <h6>Your Request has been Submitted Successfully</h6>
                            <img src="<?php echo base_url('assets/images/success.png') ?>" alt="">
                            <a href="<?php echo base_url('user/dashboard'); ?>"><i class="fas fa-arrow-left"></i> Go back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>