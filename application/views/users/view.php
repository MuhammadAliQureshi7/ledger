<!DOCTYPE html>

<html lang="en">

<head>

    <?php include('head.php') ?>

</head>

<body>

    <?php include('header.php');?>
    <div class="section">
        <div class="banner view">
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
           
        <div class="details">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        <?php foreach($article as $blog): ?>
                            <h2><?php echo $blog->title;?></h2>
                            <strong><?php echo $blog->date_posted;?></strong>
                            <span class="tag <?php echo $blog->category;?>"><?php echo $blog->category;?></span>
                            <img src="<?php echo base_url($blog->image); ?>" alt="<?php echo $blog->title;?>" title="<?php echo $blog->title;?>">                            
                            <?php echo $blog->description;?>
                            <a href="#">#<?php echo $blog->hashtag;?></a>
                            <?php if(empty($blog->video)): ?>
                            <?php else:?>
                                <div class="video">
                                    <a href="<?php echo $blog->video;?>" target="_blank">View Video</a> 
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="related">
                            <h2>Related Articles</h2>
                            <ul>
                                <?php foreach($hash as $blog): ?>
                                    <li>
                                        <a href="<?php echo base_url('home/view_details/'.$blog->id.'/'.$blog->hashtag); ?>"><?php echo $blog->title;?></a>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    <?php include('footer.php');?>
</body>

</html>