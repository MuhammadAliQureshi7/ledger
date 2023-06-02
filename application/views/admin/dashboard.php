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
                        <?php if($msg = $this->session->flashdata('msg')):
                                $msg_class = $this->session->flashdata('msg_class');?> 
                            <div class="alert <?php echo $msg_class;?>">
                                <?php echo $msg;?>
                            </div>
                        <?php endif;?>
                        <div class="top">
                            <h2>Requests</h2>
                            <a href="<?php echo base_url('admin/make_request'); ?>">Charge to Debit</a> 
                        </div>                        
                        <table>
                            <thead>
                                <tr>
                                    <th>Transaction Id</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Note</th>
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
                                                    <?php echo $requests->date; ?>
                                                    <br>
                                                    <br>
                                                    <?php echo $requests->date_response; ?>
                                                </td>
                                                <td><?php echo $requests->category; ?></td>
                                                <td>
                                                    <?php if(empty($requests->admin)):?>                                                        
                                                            <p><?php echo $requests->note; ?></p> 
                                                            by <?php echo $requests->full_name; ?>                                                        
                                                    <?php else:?>
                                                        <p><?php echo $requests->note; ?></p>
                                                        by Admin
                                                    <?php endif;?>                                                                                                        
                                                </td>                                    
                                                <td>
                                                    Amount Requested: <?php echo "$". $requests->amount;?>                                                     
                                                    <br> 
                                                    <br> 
                                                    Amount Paid: 
                                                    <?php echo "$". $requests->amount_response;?> 
                                                    <br>
                                                    <br> 
                                                    <?php if(empty($requests->admin)):?>
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
                                                    <a href="<?php echo base_url('admin/view_details/'.$requests->request_id);?>">View Details</a>                                                    
                                                </td>                                   
                                            </tr>
                                        <?php else:?>
                                            <tr>                                    
                                                <td><strong><?php echo $requests->transaction_id; ?></strong></td>
                                                <td><?php echo $requests->date; ?></td>
                                                <td><?php echo $requests->category; ?></td>
                                                <td>
                                                <?php if(empty($requests->admin)):?>                                                        
                                                        <p><?php echo $requests->note; ?></p> 
                                                        by <?php echo $requests->full_name; ?>                                                        
                                                <?php else:?>
                                                    <p><?php echo $requests->note; ?></p>
                                                    by Admin
                                                <?php endif;?>                                                   
                                                                             
                                                </td> 
                                                                                  
                                                <td>
                                                    Amount Requested: <?php echo "$". $requests->amount;?>
                                                    <br>
                                                    <br>
                                                    <?php if(empty($requests->admin)):?>
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
                                                    <a href="<?php echo base_url('admin/view_details/'.$requests->request_id);?>">View Details</a>
                                                    <?php if(empty($requests->admin)):?>
                                                        <?php if($requests->status == "Approved"): ?>
                                                            <a href="<?php echo base_url('admin/response/'.$requests->request_id);?>">Respond</a>
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