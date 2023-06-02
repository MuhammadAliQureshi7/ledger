<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="section">        
        <div class="table">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <?php if($msg = $this->session->flashdata('msg')):
                                $msg_class = $this->session->flashdata('msg_class');?> 
                            <div class="alert <?php echo $msg_class;?>">
                                <?php echo $msg;?>
                            </div>
                        <?php endif;?>
                        <div class="top">
                            <h2>Admins</h2> 
                            <a href="<?php echo base_url('admin/dashboard') ?>" class="btn btn-info back"><i class="fas fa-arrow-left"></i> Go back to Dashboard</a>
                            <a href="<?php echo base_url('admin/add_admin'); ?>"><i class="fas fa-plus-circle"></i> Add New Admin</a>                             
                        </div>                      
                        <?php if(!empty($admin)):?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>email</th>                                        
                                        <th>Role</th>                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($admin as $users):?>
                                    <tr>                                    
                                        <td><strong><?php echo $users->full_name; ?></strong></td>
                                        <td><?php echo $users->email; ?></td>
                                        <td><p><?php echo $users->role; ?></p></td>                                                                        
                                        <td>
                                            <a onclick="javascript:alert('Are you sure?');" href="<?php echo base_url('admin/del_user/'.$users->id); ?>" data-toggle="tooltip" title="Delete User" class="text text-danger"><i class="fas fa-trash"></i></a>                                        
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="alert alert-warning"><i class="fas fa-exclamation-circle"></i> There are no registered users yet.</div>
                        <?php endif;?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>    
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>