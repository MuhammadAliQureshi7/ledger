<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php') ?>
</head>
<body>
    <?php include('header.php') ?>
    <div class="section">
        <div class="form">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <?php foreach($request as $request):?>
                            <a href="<?php echo base_url('admin/dashboard') ?>" class="btn btn-info back"><i class="fas fa-arrow-left"></i> Go back to Dashboard</a>
                            <fieldset class="details">
                                <legend>Request Details</legend>
                                <?php if($msg = $this->session->flashdata('msg')):
                                        $msg_class = $this->session->flashdata('msg_class');?> 
                                    <div class="alert <?php echo $msg_class;?>">
                                        <?php echo $msg;?>
                                    </div>
                                <?php endif;?>
                                <div class="fields">
                                    <div class="field">
                                        <label>Full Name:</label>
                                        <strong><?php echo $request->full_name; ?></strong>
                                    </div>
                                    <div class="field">
                                        <label>Email:</label>
                                        <strong><?php echo $request->email; ?></strong>
                                    </div>
                                    <div class="field">
                                        <label>Phone:</label>
                                        <strong><?php echo $request->phone; ?></strong>
                                    </div>
                                    <div class="field">
                                        <label>Transaction Id:</label>
                                        <strong class="badge badge-secondary"><?php echo $request->transaction_id; ?></strong>
                                    </div>
                                    <div class="field">
                                        <label>Category:</label>
                                        <strong><?php echo $request->category; ?></strong>
                                    </div>
                                    <div class="field">
                                        <label>Amount:</label>
                                        <strong>$<?php echo $request->amount; ?></strong>
                                    </div>
                                
                                    <?php if(!empty($request->proof)):?>
                                        <div class="field">
                                        <label>Supporting Document:</label>                                            
                                        <a target="_blank" href="<?php echo base_url($request->proof) ?>"> <i class="fas fa-file-download"></i> click here to open file</a>
                                        </div>
                                    <?php else:?>

                                    <?php endif;?>
                                    
                                    <div class="field">
                                        <label>Status:</label>
                                        <?php if($request->status == "Approved"): ?>
                                            <strong class="badge badge-success"><?php echo $request->status; ?></strong>
                                        <?php elseif($request->status == "Rejected"): ?>
                                            <strong class="badge badge-danger"><?php echo $request->status; ?></strong>
                                        <?php else: ?>
                                            <form method="post" action="<?php echo base_url("admin/add_request_status/".$request->request_id); ?>">
                                                <select name="status">
                                                    <option value="">Select Status for this Request</option>
                                                    <option>Approved</option>
                                                    <option>More Details Required</option>
                                                    <option>Rejected</option>
                                                </select>
                                                <button type="submit">submit</button>
                                            </form>
                                        <?php endif;?>
                                    </div>
                                    
                                    <div class="field">
                                        <label>Date:</label>
                                        <strong><?php echo $request->date; ?></strong>
                                    </div>
                                    <div class="field">
                                        <label>Note:</label>
                                        <strong><?php echo $request->note; ?></strong>
                                    </div> 
                                    <div class="field">
                                        <?php if(!empty($more_details)):?>
                                            <label>More Details:</label>
                                            <?php foreach($more_details as $details):?>
                                                <strong><?php echo $details->details; ?></strong>
                                                <?php if(!empty($details->document)):?>
                                                    <a target="_blank" href="<?php echo base_url($details->document);?>"><i class="fas fa-file-pdf"></i></a>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        <?php else:?>

                                        <?php endif;?>
                                    </div>                                    
                                    
                                                             
                                </div>                          
                            </fieldset>
                            <?php if(!empty($request->amount_response)):?>
                                <fieldset class="details">
                                    <legend>Response for Request</legend>
                                    <div class="fields">
                                        <div class="field">
                                            <label>Date:</label>
                                            <strong><?php echo $request->date_response; ?></strong>
                                        </div>
                                        <div class="field">
                                            <label>Paid Via</label>
                                            <strong><?php echo $request->paid_via; ?></strong>
                                        </div>
                                        <div class="field">
                                            <?php if($request->paid_via == "Check" || $request->paid_via == "Check from LO"):?>
                                                <label>Recieved Date:</label>
                                                <strong><?php echo $request->paying_details; ?></strong>
                                            <?php elseif($request->paid_via == "Included in commission" || $request->paid_via == "Deduction from commission"):?>
                                                <label>Date Completed:</label>
                                                <strong><?php echo $request->paying_details; ?></strong>
                                            <?php elseif($request->paid_via == "Credit Card Charged"):?>
                                                <label>Transaction Id:</label>
                                                <strong><?php echo $request->paying_details; ?></strong>
                                            <?php else:?>

                                            <?php endif;?>
                                        </div>           
                                        <div class="field">
                                            <label>Amount:</label>
                                            <strong>$<?php echo $request->amount_response; ?></strong>
                                        </div>
                                        <div class="field">
                                            <label>Note:</label>
                                            <strong><?php echo $request->note_response; ?></strong>
                                        </div>                                    
                                    </div>
                                </fieldset>
                            <?php endif;?>
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