<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="logo">
                    <a href="<?php echo base_url('admin/dashboard'); ?>"><h1>Admin Panel</h1></a>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5"></div>
            <div class="col-lg-3 col-md-3">
                <div class="loggedin_user">
                    <div class="img-container">
                        <?php if(!empty($userinfo['0']->image)):?>
                            <img src="<?php echo base_url($userinfo['0']->image); ?>" alt="">
                        <?php else:?>
                            <img src="<?php echo base_url('assets/images/ceo.jpg'); ?>" alt="">
                        <?php endif;?>
                    </div>                      
                      <div class="text-wrap">
                        <h2><?php echo $userinfo['0']->full_name; ?></h2>
                        <h4><?php echo $userinfo['0']->role; ?></h4>
                      </div>  
                      <div class="dropdown">
                        <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo base_url('admin/dashboard'); ?>">Activity</a>
                            <?php if($userinfo['0']->role == "Admin" ||  $userinfo['0']->role == "Editor"):?>
                                <a class="dropdown-item" href="<?php echo base_url('admin/users'); ?>">Users</a> 
                            <?php else:?>
                            
                            <?php endif;?>
                            
                            <?php if($userinfo['0']->role == "Admin"):?>
                                <a class="dropdown-item" href="<?php echo base_url('admin/admins'); ?>">Admins</a> 
                            <?php else:?>
                            
                            <?php endif;?>
                                                    
                            <a class="dropdown-item" href="<?php echo base_url('admin/profile'); ?>">My Profile</a>
                            <a class="dropdown-item " href="<?php echo base_url('admin/logout') ?>">Logout</a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>