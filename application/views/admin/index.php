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
                    <a href="<?php echo base_url('admin/dashboard') ?>" class="btn btn-info back"><i class="fas fa-arrow-left"></i> Go back to Dashboard</a>
                        <?php if($msg_news = $this->session->flashdata('msg_news')):
                                $msg_news_class = $this->session->flashdata('msg_news_class');?> 
                            <div class="alert <?php echo $msg_news_class;?>">
                                <?php echo $msg_news;?>
                            </div>
                        <?php endif;?>
                        <fieldset>
                            <legend>Request</legend>
                            <form action="<?php echo base_url('admin/make_request'); ?>" method="post" enctype="multipart/form-data">
                                <div class="field">
                                    <label>User</label>
                                    <select name="user">
                                        <option value="">Select a User</option>
                                        <?php foreach($users as $user): ?>
                                            <option value="<?php echo $user->id ?>"><?php echo $user->full_name; ?> - <?php echo $user->username; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('category') ?>
                                </div>
                                <div class="field">
                                    <label>Category</label>
                                    <select name="category">
                                        <option value="">Select a Category</option>
                                        <option>Technology Fee - Monthly</option>
                                        <option>Credit - Report</option>
                                        <option>Credit - Supplement</option>
                                        <option>Credit - ReScore</option>
                                        <option>Credit - Other</option>
                                        <option>NMLS Dues</option>
                                        <option>Sponsorship/Renewal</option>
                                        <option>Appraisal - Unpaid</option>
                                        <option>Appraisal 1004D - Unpaid</option>
                                        <option>HOA Cert</option>
                                        <option>VOE</option>
                                        <option>Loansifter - Account</option>
                                        <option>Subscription</option>
                                        <option>Reimbursement</option>
                                        <option>Advance</option>
                                        <option>Training & Coaching</option>
                                        <option>Travel & Accommodation</option>
                                        <option>Office</option>
                                        <option>Print - Color Copier</option>
                                        <option>Print - Business Cards</option>
                                        <option>Print - Other</option>
                                        <option>Marketing & Advertising</option>
                                        <option>Software Expense</option>
                                        <option>Event Expense</option>
                                        <option>Supplies</option>
                                    </select>
                                    <?php echo form_error('category') ?>
                                </div>
                                <div class="field textarea">
                                    <label>Amount</label>
                                   <input type="number" step="0.01" name="amount" value="<?php echo set_value('amount')?>">
                                   <?php echo form_error('amount') ?>
                                </div>                                
                                <div class="field textarea">
                                    <label>Note</label>
                                    <textarea name="note" value="<?php echo set_value('note')?>"></textarea>
                                    <?php echo form_error('note') ?>
                                </div>
                                <div class="field textarea">
                                    <label>Supporting Document</label>
                                   <input type="file" name="proof" id="">
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
    <?php include('footer.php') ?>
    <?php foreach($error as $err){
        print_r($err);

    }?>
</body>
</html>