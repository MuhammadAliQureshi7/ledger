<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('head.php'); ?>
</head>
<body>
    <?php include('header.php'); ?>
    <div class="section">        
        <div class="view">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-7">
                        <?php foreach($article as $blog):?>
                            <img src="<?php echo base_url($blog->image); ?>" alt="<?php echo $blog->title; ?>" title="<?php echo $blog->title; ?>">
                            <h1><?php echo $blog->title; ?></h1>
                            <span class="date"><?php echo $blog->date_posted; ?></span>
                            <span class="category <?php echo $blog->category; ?>"><?php echo $blog->category; ?></span>
                            <?php echo $blog->description;?>
                            <a href="<?php echo $blog->video; ?>">Link to Video </a>
                            <br><br><br>
                            <label for="">Hashtag:</label>
                            <a class="hashtag" href="#"><?php echo $blog->hashtag; ?></a>
                            <div class="fields">
                                <div class="field">
                                    <label>Is Trending:</label>
                                    <strong><?php echo $blog->trending; ?></strong>
                                </div>
                                <div class="field">
                                    <label>Is Exclusive:</label>
                                    <strong><?php echo $blog->exclusive; ?></strong>
                                </div>
                            </div>
                            
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Blog</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="fields">
                            <div class="field">
                                <label>Title:</label>
                                <input type="text" name="title" placeholder="Blog Title...">
                            </div>
                            <div class="field">
                                <label>Category:</label>
                                <select name="cateory">
                                    <option value="">Select a category</option>
                                    <option>Business</option>
                                    <option>Designing</option>
                                    <option>Development</option>
                                    <option>Digital</option>
                                    <option>Environment</option>
                                    <option>Global</option>
                                </select>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label>Is Trending:</label>
                                <select name="trending">
                                    <option value="">Is Trending</option>
                                    <option>Yes</option>
                                    <option>No</option>                                
                                </select>
                            </div>
                            <div class="field">
                                <label>Exclusive:</label>
                                <select name="exclusive">
                                    <option value="">Exclusive</option>
                                    <option>Yes</option>
                                    <option>No</option>                                
                                </select>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label>Video:</label>
                                <input type="text" name="video" placeholder="Enter Video Url...">
                            </div>
                            <div class="field">
                                <label>Image:</label>
                                <input type="file" name="image">
                            </div>
                            
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label>Hashtag:</label>
                                <input type="text" name="hashtag" placeholder="Enter Relative Hashtag...">
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field full">
                                <label>Description:</label>
                                <textarea name="description" id="desc" rows="20"></textarea>
                            </div>
                        </div>   
                        <div class="fields">
                            <div class="btn-set">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div> 
                        </div>      
                    </form>      
                </div>
            </div>
        </div>
    </div>
    <script>

$('.table td p').text(function( index, value ) {

  if (value.length > 50){

    return value.substr(0, 50);

  }

});
$('.table td strong').text(function( index, value ) {

if (value.length > 20){

  return value.substr(0, 20);

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