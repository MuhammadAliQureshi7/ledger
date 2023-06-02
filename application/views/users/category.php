<!DOCTYPE html>

<html lang="en">

<head>

    <?php include('head.php') ?>

</head>

<body>

    <?php include('header.php');?>
    <div class="section">
        <div class="banner <?php echo $page_title; ?>">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <h1><?php echo $page_title; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="top category">
            <div class="container">
                <div class="row">                    
                    <?php if(empty($article)): ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-circle"></i>
                            Currently, no Tech Acts in respective category
                        </div>
                    <?php else:?>
                        <?php foreach($article as $blog): ?>    
                            <div class="col-xl-3 col-lg-3">
                                <div class="panel <?php echo $blog->category; ?>">
                                    <div class="tag">
                                        <span><?php echo $blog->category; ?></span>
                                    </div>
                                    <div class="img-box">
                                        <img src="<?php echo base_url($blog->image); ?>" alt="">
                                    </div>
                                    <div class="text-wrap">
                                        <h2><a href="<?php echo base_url('home/view_details/'.$blog->id.'/'.$blog->hashtag); ?>"><?php echo $blog->title; ?></a></h2>
                                        <?php echo $blog->description; ?>
                                        <div class="details">
                                            <span><?php echo $blog->date_posted; ?></span>
                                            <a href="<?php echo base_url('home/view_details/'.$blog->id.'/'.$blog->hashtag); ?>">Read More <i class="fas fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        <?php endforeach;?>
                    <?php endif;?>
                </div>                
            </div>
        </div>     
    </div>
    <?php include('footer.php');?>
</body>

</html>