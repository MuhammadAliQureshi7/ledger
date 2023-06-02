<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php') ?>
</head>
<body>
    <?php include('header.php') ?>
    <div class="section">
        <div class="form profile">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <?php foreach($user as $user):?>
                            <a href="<?php echo base_url('user/dashboard') ?>" class="btn btn-info back"><i class="fas fa-arrow-left"></i> Go back to Dashboard</a>

                            <fieldset class="details">
                                <legend>My Profile</legend>
                                <?php if($msg = $this->session->flashdata('msg')):
                                        $msg_class = $this->session->flashdata('msg_class');?> 
                                    <div class="alert <?php echo $msg_class;?>">
                                        <?php echo $msg;?>
                                    </div>
                                <?php endif;?>
                                <form action="<?php echo base_url('user/profile'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3">
                                            <div class="img-box">
                                                <?php if(empty($user->image)):?>
                                                    <img src="<?php echo base_url('assets/images/ceo.jpg'); ?>" alt="">
                                                <?php else:?>
                                                    <img src="<?php echo base_url($user->image); ?>" alt="">
                                                <?php endif;?>
                                                <label for="">Select Profile image</label>
                                                <input type="file" name="image" id="">
                                            </div>                                    
                                        </div>
                                        <div class="col-xl-9 col-lg-9">
                                            <div class="fields">
                                                <div class="field">
                                                    <label>Full Name:</label>
                                                    <input type="text" name="full_name" value="<?php echo $user->full_name; ?>">
                                                    <strong></strong>
                                                </div>
                                                <div class="field">
                                                    <label>Username:</label>                                                
                                                    <strong><?php echo $user->username; ?></strong>
                                                </div>
                                                <div class="field">
                                                    <label>Email:</label>
                                                    <input type="text" name="email" value="<?php echo $user->email; ?>">
                                                    <strong></strong>
                                                </div>
                                                <div class="field">
                                                    <label>Phone:</label>
                                                    <input type="text" name="phone" value="<?php echo $user->phone; ?>">
                                                    <strong></strong>
                                                </div>
                                                <div class="field">
                                                    <label>Password:</label>
                                                    <input type="password" name="password" value="<?php echo $user->password; ?>">
                                                    <strong></strong>
                                                </div>
                                                <div class="btn-set">
                                                    <button type="submit">Update</button>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </form>                       
                            </fieldset>                            
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php') ?>
    <script>
        function pay() {
            var paid = document.getElementById("paid").value;
            if(paid == "Check" || paid == "Check from LO"){
                document.getElementById("pay_details").innerHTML = "<label>Recieved Date:</label>" +
                    "<input type='date' name='paying_details'>";
            }
            else if(paid == "Included in commission" || paid == "Deduction from commissions"){
                document.getElementById("pay_details").innerHTML = "<label>Date Completed:</label>" +
                    "<input type='date' name='paying_details'>";
            }
            else if(paid == "Credit Card Charged"){
                document.getElementById("pay_details").innerHTML = "<label>Transaction Id:</label>" +
                    "<input type='number' min='0' name='paying_details'>";
            }
            else{
                document.getElementById("pay_details").innerHTML = "<label>Payment Details:</label>" +
                    "<input type='text' value='Select Paid Via First' disable>";
            }
        }
    </script>
</body>
</html>
