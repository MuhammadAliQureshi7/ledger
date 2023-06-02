<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="section">
        <!--<div class="count">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="total panel">                                        
                            <h5>Total Requests</h5>
                            <h3>0</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="active panel">                                        
                            <h5></i>Approved Requests</h5>
                            <h3>0</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="reject panel">                                        
                            <h5>Declined Requests</h5>
                            <h3>0</h3>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="pending panel">                                        
                            <h5>Pending Requests</h5>
                            <h3>0</h3>
                        </div>
                    </div>                                    
                </div>
            </div>
        </div>-->
       
        <div class="table">

            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <?php if($msg_news = $this->session->flashdata('msg_news')):
                                $msg_news_class = $this->session->flashdata('msg_news_class');?> 
                            <div class="alert <?php echo $msg_news_class;?>">
                                <?php echo $msg_news;?>
                            </div>
                        <?php endif;?>
                        <div class="amount">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="panel">
                                        <h5>Balance</h5>
                                        <h2>$ 
                                            
                                            <?php 
                                             $total = 0;
                                                
                                             foreach($credit as $credit){
                                                 if(empty($credit->amount_response)){
                                                     $total = $credit->amount + $total;    
                                                 } 
                                                 else{
                                                    $total = $credit->amount + $total - $credit->amount_response;
                                                 }                                                                                                  
                                             } 
                                               $total_balance = 0;
                                               
                                                   foreach($balance as $balance){
                                                       if(empty($balance->amount_response)){
                                                           $total_balance = $balance->amount + $total_balance;    
                                                       } 
                                                       else{
                                                        $total_balance = $balance->amount + $total_balance - $balance->amount_response;
                                                     }                                                                                                   
                                                   }    
                                                   
                                                   echo $total - $total_balance;                                                     
                                                   
                                                                                                                   
                                                /* foreach($credit as $credit){
                                                    print_r($credit);
                                                    exit;
                                                }
                                                $data = array(
                                                    array('column1' => 10, 'column2' => 20),
                                                    array('column1' => 30, 'column2' => 40),
                                                    array('column1' => 5, 'column2' => 10)
                                                );
                                                
                                                $total = array('column1' => 0, 'column2' => 0);
                                                
                                                foreach ($data as $row) {
                                                    $total['column1'] += $row['column1'];
                                                    $total['column2'] += $row['column2'];
                                                }
                                                $tot = $total['column1'] - $total['column2'];
                                                //print_r($total);
                                                echo $tot; */
                                                                                                     
                                            ?>
                                        </h2>
                                    </div>
                                </div>
                                <!-- <div class="col-xl-6 col-lg-6">
                                    <div class="panel">
                                        <h5>Credit</h5>
                                        <h2>$ 
                                            
                                            <?php 
                                                $total = 0;
                                                
                                                    foreach($credit as $credit){
                                                        if(empty($credit->amount_response)){
                                                            $total = $credit->amount + $total;    
                                                        }                                                                                                   
                                                    }    
                                                    
                                                    echo $total;                                                     
                                                    
                                                                            
                                                    
                                            ?>
                                        </h2>
                                    </div>
                                </div> -->
                                <!--<div class="col-xl-6 col-lg-6">
                                    <div class="panel">
                                        <h5>Credit</h5>
                                        <h2>$ 
                                            
                                            <?php 
                                                   /*  $total = 0;
                                                
                                                    foreach($balance as $credit){
                                                        if(!empty($credit->admin)){
                                                            $total = $credit->amount_response + $total;    
                                                        }                                            
                                                    }      
                                                    echo $total; */ 
                                                                            
                                                    
                                            ?>
                                        </h2>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        <?php if($msg = $this->session->flashdata('msg')):
                                $msg_class = $this->session->flashdata('msg_class');?> 
                            <div class="alert <?php echo $msg_class;?>">
                                <?php echo $msg;?>
                            </div>
                        <?php endif;?>
                        <div class="top">
                            <h2>Requests</h2>
                            <a href="<?php echo base_url('user/make_request'); ?>">Make a Request</a> 
                        </div>                        
                        <table>
                            <thead>
                                <tr>
                                    <th>Transaction Id</th>
                                    <th>By</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Paid Via</th>
                                    <th>Supporting Document</th>
                                    <th>Status</th>
                                    <th>Action</th>                                    
                                </tr>
                            </thead>
                            <tbody>                                
                                <?php foreach($requests as $requests):?>
                                    <?php if(!empty($requests->amount_response)): ?>
                                        <tr>                                    
                                            <td>
                                                <strong><?php echo $requests->transaction_id; ?></strong>
                                                <br>
                                                <br>
                                                <br>
                                                <strong>Response to Request</strong>
                                            </td>
                                            <td>
                                                <?php if(empty($requests->admin)):?>
                                                    <strong class="text text-success">You</strong>
                                                <?php else:?>
                                                    <strong class="text text-danger">Admin</strong>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <?php echo $requests->date; ?>
                                                <br>
                                                <br>
                                                <?php echo $requests->date_response; ?>
                                            </td>
                                            <td><?php echo $requests->category; ?></td>                                                
                                            <!--<td>
                                                <?php // if(!empty($requests->admin)):?>
                                                    <?php //if(!empty($requests->note_response)):?>
                                                        <p><?php //echo $requests->note; ?></p>
                                                        by <?php //echo $requests->full_name; ?>
                                                        <br>
                                                        <br>
                                                        <p><?php //echo $requests->note_response; ?></p> 
                                                        by Admin
                                                    <?php //else:?>
                                                        <p><?php //echo $requests->note; ?></p> 
                                                        by Admin
                                                    <?php //endif;?>
                                                <?php //else:?>
                                                    <p><?php// echo $requests->note; ?></p>
                                                    by Admin
                                                <?php// endif;?>                                                       
                                            </td>  -->     
                                                                        
                                            <td>
                                                Amount Requested: <?php echo "$". $requests->amount;?>                                                     
                                                <br> 
                                                <br> 
                                                Amount Paid: 
                                                <?php echo "$". $requests->amount_response;?> 
                                                <br>
                                                <br> 
                                                <?php if(!empty($requests->admin)):?>
                                                    Balance: <?php
                                                    $balance = $requests->amount - $requests->amount_response;
                                                    echo "$". $balance ;?> 
                                                <?php else: ?>
                                                    Credit: <?php
                                                    $balance = $requests->amount - $requests->amount_response;
                                                    echo "$". $balance ;?>
                                                <?php endif;?>
                                            </td>
                                            <td><?php echo  $requests->paid_via;?></td> 
                                            <td>
                                                <?php if(!empty($requests->proof)):?>
                                                    <a href="<?php echo base_url($requests->proof);?>" target="_blank"><i class="fas fa-file-download"></i></a>
                                                <?php else:?>

                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <?php if($requests->status == "Approved"){
                                                    echo "<span class='badge badge-success'>Approved</span>";
                                                }
                                                elseif($requests->status == "Rejected"){
                                                    echo "<span class='badge badge-danger'>Rejected</span>";
                                                }
                                                elseif($requests->status == "More Details Required"){
                                                    echo "<span class='badge badge-info'>More Details Required</span>";
                                                }
                                                elseif($requests->status == "Details Submitted"){
                                                    echo "<span class='badge badge-primary'>Details Submitted</span>";
                                                }
                                                else{
                                                    echo "<span class='badge badge-secondary'>Pending</span>";
                                                }
                                                ?>
                                            </td> 
                                            <td>
                                                <a href="<?php echo base_url('user/view_details/'.$requests->id);?>">View Details</a>                                                    
                                            </td>                                   
                                        </tr>
                                    <?php else:?>
                                        <tr>                                    
                                            <td><strong><?php echo $requests->transaction_id; ?></strong></td>
                                            <td>
                                                <?php if(empty($requests->admin)):?>
                                                    <strong class="text text-success">You</strong>
                                                <?php else:?>
                                                    <strong class="text text-danger">Admin</strong>
                                                <?php endif;?>
                                            </td>
                                            <td><?php echo $requests->date; ?></td>
                                            <td><?php echo $requests->category; ?></td>                                                
                                            <!--<td>
                                                <?php// if(empty($requests->admin)):?>
                                                    <?php// if(!empty($requests->note_response)):?>
                                                        <p><?php //echo $requests->note; ?></p>
                                                        by <?php //echo $requests->full_name; ?>
                                                        <br>
                                                        <br>
                                                        <p><?php //echo $requests->note_response; ?></p> 
                                                        by Admin
                                                    <?php //else:?>
                                                        <p><?php //echo $requests->note; ?></p> 
                                                        by Admin
                                                    <?php //endif;?>
                                                <?php //else:?>
                                                    <p><?php //echo $requests->note; ?></p>
                                                    by Admin
                                                <?php //endif;?>                                                       
                                            </td>  -->                                  
                                            <td>
                                                Amount Requested: <?php echo "$". $requests->amount;?>
                                                <br>
                                                <br>
                                                <?php if(!empty($requests->admin)):?>
                                                    Balance: <?php
                                                    $balance = $requests->amount - $requests->amount_response;
                                                    echo "$". $balance ;?> 
                                                <?php else: ?>
                                                    Credit: <?php
                                                    $balance = $requests->amount - $requests->amount_response;
                                                    echo "$". $balance ;?>
                                                <?php endif;?>
                                            </td>
                                            <td><?php echo  $requests->paid_via;?></td> 
                                            <td>
                                                <?php if(!empty($requests->proof)):?>
                                                    <a href="<?php echo base_url($requests->proof);?>" target="_blank"><i class="fas fa-file-download"></i></a>
                                                <?php else:?>

                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <?php if($requests->status == "Approved"){
                                                    echo "<span class='badge badge-success'>Approved</span>";
                                                }
                                                elseif($requests->status == "Rejected"){
                                                    echo "<span class='badge badge-danger'>Rejected</span>";
                                                }
                                                elseif($requests->status == "More Details Required"){
                                                    echo "<span class='badge badge-info'>More Details Required</span>";
                                                }
                                                elseif($requests->status == "Details Submitted"){
                                                    echo "<span class='badge badge-primary'>Details Submitted</span>";
                                                }
                                                else{
                                                    echo "<span class='badge badge-secondary'>Pending</span>";
                                                }
                                                ?>
                                            </td> 
                                            <td>
                                                <a href="<?php echo base_url('user/view_details/'.$requests->id);?>">View Details</a>                                                    
                                                <?php if(!empty($requests->admin)):?>
                                                    <?php if($requests->status == "Approved" ): ?>
                                                        <a href="<?php echo base_url('user/response/'.$requests->id);?>">Respond</a>
                                                    <?php else: ?>
                                                        <a data-toggle="tooltip" title="Button will be disabled until you approve this request." class="disabled" href="javascript:void(0)">Respond</a>
                                                    <?php endif;?>
                                                <?php endif;?>
                                            </td>                                   
                                        </tr>
                                    <?php endif;?>
                                <?php endforeach;?>                                                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
  
    <script>

$('.table td p').text(function( index, value ) {

  if (value.length > 100){

    return value.substr(0, 100);

  }

});
$('.table td strong').text(function( index, value ) {

if (value.length > 30){

  return value.substr(0, 30);

}

});

</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>