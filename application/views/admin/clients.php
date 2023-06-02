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
                        <div class="clients">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <?php if($success=$this->session->flashdata('msg')):
                                            $class=$this->session->flashdata('msg_class')
                                         ?>

                                            <div class="alert <?php echo $class; ?>">
                                                <?php echo $success; ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="top">
                                            <div class="col-lg-8 col-md-8">
                                                <h1>Clients</h1>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="panel">
                                            <form action="<?php echo base_url('admin/add_client'); ?>" method="post" enctype="multipart/form-data">
                                                <label>Logo:</label>
                                                <input type="file" name="logo">
                                                <?php if(isset($upload_error)) {echo $upload_error;}?>
                                                <button type="submit">Submit</button>
                                            </form>
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
        <div id="addMember" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Team Member</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form">
                            <form action="<?php echo base_url('admin/add_team') ?>" enctype="multipart/form-data" method="post">
                                <div class="field">
                                    <div class="col-lg-12 col-md-12">
                                        <label>Image <span>*</span> :</label>
                                        <input type="file" name="image">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="field">
                                    <div class="col-lg-6 col-md-6">
                                        <label>Full Name <span>*</span> :</label>
                                        <input type="text" placeholder="Enter Full Name" name="Full_name">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label>Email Address <span>*</span> :</label>
                                        <input type="email" placeholder="Enter Email" name="email">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="field">                                    
                                    <div class="col-lg-6 col-md-6">
                                        <label>Contact Number <span>*</span> :</label>
                                        <input type="text" placeholder="Enter Contact Number" name="contact_no">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label>Alternate Contact :</label>
                                        <input type="text" placeholder="Enter Alternate Contact Number" name="alt_contact_no">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="field">
                                    <div class="col-lg-6 col-md-6">
                                        <label>CNIC Number :</label>
                                        <input type="text" placeholder="Enter CNIC Number" name="CNIC">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label>Residential Address <span>*</span> :</label>
                                        <input type="text" placeholder="Enter Residential Address" name="Residential_address">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="field">
                                    <div class="col-lg-6 col-md-6">
                                        <label>Designation <span>*</span> :</label>
                                        <input type="text" placeholder="Enter Designation" name="designation">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label>Date Joined <span>*</span> :</label>
                                        <input type="date" placeholder="Date Joined" name="date_joined">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                               
                                <div class="field">
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="addadmin" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Core Team Member</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form">
                            <form action="<?php echo base_url('admin/add_core_team') ?>" enctype="multipart/form-data" method="post">
                                <div class="field">
                                    <div class="col-lg-12 col-md-12">
                                        <label>Image <span>*</span> :</label>
                                        <input type="file" name="image">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="field">
                                    <div class="col-lg-6 col-md-6">
                                        <label>Full Name <span>*</span> :</label>
                                        <input type="text" placeholder="Enter Full Name" name="Full_name">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label>Email Address <span>*</span> :</label>
                                        <input type="email" placeholder="Enter Email" name="Email">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="field">                                    
                                    <div class="col-lg-6 col-md-6">
                                        <label>Contact Number <span>*</span> :</label>
                                        <input type="text" placeholder="Enter Contact Number" name="contact_no">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label>Designation <span>*</span> :</label>
                                        <input type="text" placeholder="Enter Designation" name="role">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="field">
                                    
                                    <div class="col-lg-6 col-md-6">
                                        <label>Password<span>*</span> :</label>
                                        <input type="password" placeholder="Password" name="password">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                               
                                <div class="field">
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</body>
</html>