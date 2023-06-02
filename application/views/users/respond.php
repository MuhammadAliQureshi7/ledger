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
                    <div class="col-xl-12">
                        <?php foreach($request as $request): ?>  
                            <a href="<?php echo base_url('user/dashboard') ?>" class="btn btn-info back"><i class="fas fa-arrow-left"></i> Go back to Dashboard</a>
                        <fieldset class="details">
                            <legend>Request Details</legend>
                                                          
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
                                    <div class="field">
                                        <label>Status:</label>
                                        <strong><?php echo $request->status; ?></strong>
                                    </div>
                                    <div class="field">
                                        <label>Date:</label>
                                        <strong><?php echo $request->date; ?></strong>
                                    </div>
                                    <div class="field">
                                        <label>Note:</label>
                                        <strong><?php echo $request->note; ?></strong>
                                    </div>
                                    <?php if(!empty($more_details)):?>
                                        <label>More Details:</label>
                                        <?php foreach($more_details as $details):?>
                                            <p><?php echo $details->details; ?></p>
                                        <?php endforeach;?>
                                    <?php else:?>

                                    <?php endif;?>
                                </div>                            
                        </fieldset>
                        <?php if($request->status == "Approved"):?>
                            <fieldset>
                                <legend>Response</legend>
                                <?php if($msg_news = $this->session->flashdata('msg_news')):
                                        $msg_news_class = $this->session->flashdata('msg_news_class');?> 
                                    <div class="alert <?php echo $msg_news_class;?>">
                                        <?php echo $msg_news;?>
                                    </div>
                                <?php endif;?>
                                <form action="<?php echo base_url('user/response/'.$id); ?>" method="post">                                                              
                                    <div class="field">
                                        <label>Paid Via</label>                                                
                                        <?php if($request->admin != 0): ?>
                                            <select name="paid_via" onchange="pay()" id="paid">
                                                <option value="">Select how payment was made</option>
                                                <option>Check from LO</option>
                                                <option>Deduction from commissions</option>
                                                <option>Credit Card Charged</option>                                        
                                            </select>
                                        <?php else:?>
                                            <select name="paid_via" onchange="pay()" id="paid">
                                                <option value="">Select how payment was made</option>
                                                <option>Check</option>
                                                <option>Included in commission</option>
                                                <option>Credit Card Charged</option>                                        
                                            </select>
                                            
                                        <?php endif;?>
                                    </div> 
                                    
                                    <div class="field" id="pay_details">
                                        <label for="">Payment Details:</label>
                                        <input type="text" value="Select Paid Via First" disable class="">
                                    </div>  
                                    <div class="field textarea">
                                        
                                        <input type="hidden" step="0.01" name="amount_response" value="<?php echo $request->amount; ?>">                                    
                                    </div>                                
                                    <div class="field textarea">
                                        <label>Note</label>
                                        <textarea name="note_response" value="<?php echo set_value('note')?>"></textarea>
                                        <?php echo form_error('note') ?>
                                    </div>
                                    <div class="btn-set">
                                        <button type="submit">Pay</button>
                                    </div>
                                </form>
                            </fieldset>
                        <?php else:?>
                            <fieldset>
                                <legend>Provide More Details</legend>
                                <?php if($msg = $this->session->flashdata('msg')):
                                        $msg_class = $this->session->flashdata('msg_class');?> 
                                    <div class="alert <?php echo $msg_class;?>">
                                        <?php echo $msg;?>
                                    </div>
                                <?php endif;?>
                                <form action="<?php echo base_url('user/more_details/'.$id); ?>" method="post">                                                                                                                                 
                                    <div class="field textarea">
                                        <label>Provide more details</label>
                                        <textarea name="details" value="<?php echo set_value('details')?>"></textarea>
                                        <?php echo form_error('details') ?>
                                    </div>
                                    <div class="btn-set">
                                        <button type="submit">Submit</button>
                                    </div>
                                </form>
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