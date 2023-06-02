<div class="header">

    <div class="container">

        <div class="row">

            <div class="col-lg-4 col-md-4">

                <div class="logo">

                    <a href="<?php echo base_url('user/dashboard'); ?>"><h1>My Ledger</h1></a>

                </div>

            </div>

            <div class="col-xl-5 col-lg-5"></div>

            <div class="col-lg-3 col-md-3">

                <div class="loggedin_user">                      
                    <div class="img-container">
                        <?php if(!empty($user['0']->image)):?>
                            <img src="<?php echo base_url($user['0']->image); ?>" alt="">
                        <?php else:?>
                            <img src="<?php echo base_url('assets/images/ceo.jpg'); ?>" alt="">
                        <?php endif;?>
                    </div>
                    <div class="text-wrap">

                    <h5>Welcome,</h5>

                    <h2><?php echo $user['0']->full_name; ?></h2>

                    <h4><?php echo $user['0']->username; ?></h4>

                    </div>  

                    <div class="dropdown">

                        <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">

                            <i class="fa fa-chevron-down"></i>

                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            <a class="dropdown-item" href="<?php echo base_url('user/dashboard'); ?>">Activity</a>                            

                            <a class="dropdown-item" href="<?php echo base_url('user/profile'); ?>">My Profile</a>

                            <a class="dropdown-item " href="<?php echo base_url('user/logout') ?>">Logout</a>

                        </div>

                    </div>

                </div>

               

            </div>

        </div>

    </div>

</div>