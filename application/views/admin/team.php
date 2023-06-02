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
                        <div class="team">
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
                                                <h1>Team</h1>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="panel">
                                            <div class="core_team">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <h2>Core Team</h2>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <div class="search">
                                                            <form action="">
                                                                <div class="row">
                                                                    <div class="col-lg-10 col-md-10 no-padding">
                                                                        <input type="text" placeholder="Search for Core team member" name="team"> 
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 no-padding">
                                                                        <button type="submit">GO</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2">
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#addadmin">Add Member</button>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="clearfix"></div>
                                                <div class="table">
                                                    <table>
                                                        <thead>
                                                            <tr>            
                                                                <th>Image</th>
                                                                <th>Full Name</th>
                                                                <th>Contact Number</th>
                                                                <th>Email Address</th>
                                                                <th>Designation</th>
                                                                <th>Action</th>
                                                                <th></th>
                                                            </tr> 
                                                        </thead>
                                                        <tbody>
                                                            <?php if(count($core)): ?>
                                                            <?php foreach ($core as $admin) :?>
                                                            <tr>
                                                                <td><img src="<?php echo $admin->image_path; ?>" alt="<?php echo $admin->full_name; ?>"></td>
                                                                <td>
                                                                    <?php echo $admin->full_name; ?>
                                                                </td>
                                                                <td><?php echo $admin->contact_no; ?></td>
                                                                <td><?php echo $admin->Email; ?></td>
                                                                <td><?php echo $admin->role; ?></td>
                                                                <td>    
                                                                    <?php echo anchor("admin/view_admin/{$admin->id}","View",array('class'=>'btn btn-primary')); ?>
                                                                </td>
                                                                <td>
                                                                    <form action="<?php echo base_url('admin/deladmin') ?>" method="post">
                                                                        <input type="hidden" name="id" value="<?php echo $admin->id; ?>">
                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                            <?php else: ?>
                                                            <tr class="text-danger">
                                                                <td colspan="6">No Data Available</td>
                                                            </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="team_member">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <h2>Core Team</h2>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <div class="search">
                                                            <form action="">
                                                                <div class="row">
                                                                    <div class="col-lg-10 col-md-10 no-padding">
                                                                        <input type="text" placeholder="Search for team member" name="team"> 
                                                                    </div>
                                                                    <div class="col-lg-2 col-md-2 no-padding">
                                                                        <button type="submit">GO</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2">
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#addmember">Add Member</button>
                                                    </div>
                                                </div>
                                                <hr>                            
                                                <div class="clearfix"></div>
                                                <div class="table">
                                                    <table>
                                                        <thead>
                                                            <tr>            
                                                                <th>Image</th>
                                                                <th>Full Name</th>
                                                                <th>Contact Number</th>
                                                                <th>Email Address</th>
                                                                <th>CNIC Number</th>
                                                                <th>Designation</th>
                                                                <th>Action</th>
                                                                <th></th>
                                                            </tr> 
                                                        </thead>
                                                        <tbody>
                                                            <?php if(count($member)): ?>
                                                            <?php foreach ($member as $member) :?>
                                                            <tr>
                                                                <td><img src="<?php echo $member->image_path;?>" alt="<?php echo $member->full_name; ?>"></td>
                                                                <td>
                                                                    <?php echo $member->full_name; ?>
                                                                </td>
                                                                <td><?php echo $member->contact_no; ?></td>
                                                                <td><?php echo $member->email; ?></td>
                                                                <td><?php echo $member->CNIC; ?></td>
                                                                <td><?php echo $member->designation; ?></td>
                                                                <td>    
                                                                    <?php echo anchor("admin/edit_team/{$member->id}","Edit",array('class'=>'btn btn-primary')); ?>
                                                                </td>
                                                                <td>
                                                                    <form action="<?php echo base_url('admin/delteam') ?>" method="post">
                                                                        <input type="hidden" name="id" value="<?php echo $member->id; ?>">
                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                            <?php else: ?>
                                                            <tr class="text-danger">
                                                                <td colspan="6">No Data Available</td>
                                                            </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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
                                        <?php if(isset($upload_error)) {echo $upload_error;}?>
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