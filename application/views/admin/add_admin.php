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
                        <a href="<?php echo base_url('admin/dashboard') ?>" class="btn btn-info back"><i class="fas fa-arrow-left"></i> Go back to Dashboard</a>
                        <?php if($msg_news = $this->session->flashdata('msg_news')):
                                $msg_news_class = $this->session->flashdata('msg_news_class');?> 
                            <div class="alert <?php echo $msg_news_class;?>">
                                <?php echo $msg_news;?>
                            </div>
                        <?php endif;?>
                        <fieldset>
                            <legend>Add New Admin</legend>
                            <form action="<?php echo base_url('admin/add_admin'); ?>" method="post" enctype="multipart/form-data">
                                <div class="field">
                                    <label>Full Name <span>*</span></label>
                                    <input type="text" name="full_name" placeholder="Enter Full Name" value="<?php echo set_value('full_name')?>">
                                    <?php echo form_error('full_name') ?>
                                </div>
                                <div class="field">
                                    <label>Username <span>*</span></label>
                                    <input type="text" name="username" placeholder="Enter Username" value="<?php echo set_value('username')?>">
                                    <?php echo form_error('username') ?>
                                </div>
                                <div class="field">
                                    <label>Email Address <span>*</span></label>
                                    <input type="email" name="email" placeholder="Enter Email Address" value="<?php echo set_value('email')?>">
                                    <?php echo form_error('email') ?>
                                </div>                                
                                <div class="field">
                                    <label>Role <span>*</span></label>
                                    <select name="role">
                                        <option value="">Select a Role</option>
                                        <option>Editor</option>
                                        <option>Moderator</option>
                                    </select>                                    
                                    <?php echo form_error('role') ?>
                                </div>
                                <div class="field">
                                    <label>Password <span>*</span></label>
                                    <input type="password" name="password" placeholder="Enter Password" value="<?php echo set_value('username')?>">
                                    <?php echo form_error('username') ?>
                                </div>
                                <div class="field">
                                    <label>Image</label>
                                    <input type="file" name="image" id="">
                                </div>
                                <div class="btn-set">
                                    <button type="submit">Submit</button>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>