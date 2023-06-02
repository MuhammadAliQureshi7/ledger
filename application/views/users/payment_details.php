<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="section">
        <div class="form table">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <h1>Payment Details</h1>
                        <?php if(!empty($card)):?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Card Number</th>
                                        <th>Expiration Date</th>
                                        <th>CVV</th>   
                                        <th>Action</th>                                 
                                    </tr>
                                </thead>
                                <tbody>                                
                                    <?php foreach($card as $card):?>
                                    <tr>
                                            <td><?php echo $card->full_name; ?></td>
                                            <td><?php echo $card->card_number; ?></td>
                                            <td><?php echo $card->exp_month; ?>/<?php echo $card->exp_year; ?></td>
                                            <td><?php echo $card->cvv; ?></td>
                                            <td><a onclick="alert('Are you Sure?')" href="<?php echo base_url('user/del_card/'.$card->id); ?>"><i class="fas fa-trash"></i></a></td>
                                    </tr>
                                    <?php endforeach;?>                                                           
                                </tbody>
                            </table>
                        <?php else:?>

                        <?php endif;?>
                        <?php if($msg = $this->session->flashdata('msg')):
                                $msg_class = $this->session->flashdata('msg_class');?> 
                            <div class="alert <?php echo $msg_class;?>">
                                <?php echo $msg;?>
                            </div>
                        <?php endif;?>
                        <fieldset>
                            <legend>Payment Details</legend>
                            <form action="<?php echo base_url('user/payment_details'); ?>" method="post">
                                <div class="field">
                                    <label>Full Name:</label>
                                    <input type="text" name="full_name" value="<?php echo set_value('full_name')?>">
                                    <?php echo form_error('full_name') ?>
                                </div>
                                <div class="field">
                                    <label>Card Number</label>
                                   <input type="number" name="card_number" value="<?php echo set_value('card_number')?>">
                                   <?php echo form_error('card_number') ?>
                                </div>
                                <div class="field">
                                    <label>Expiration Month</label>
                                    <select name="exp_month">
                                        <option value="">Select Expiration Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <?php echo form_error('exp_month') ?>
                                </div>
                                <div class="field year">
                                    <label>Expiration Year</label>
                                    <input type="number" name="exp_year" min="23" max="99">
                                    <?php echo form_error('exp_year') ?>
                                </div>
                                <div class="field">
                                    <label>CVV</label>
                                    <input type="number" min="0" name="cvv" value="<?php echo set_value('cvv')?>">
                                    <?php echo form_error('cvv') ?>
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
  
  
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>