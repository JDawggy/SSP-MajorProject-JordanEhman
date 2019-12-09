<?php

// is user logged in they can view the page if not they will be returned to the header function
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: http://" . $_SERVER["SERVER_NAME"] ); //. "login.php" to get to a diffrent page and remove the ) after SERVER_NAME]
} 

require_once("header.php");

?>


<div class="container">
    
    <div class="col-12"><h1>Add Post</h1></div>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php"); ?>
    <form action="/actions/create_post_action.php" method="post" enctype="multipart/form-data">
    
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Article Title" class="form-control">
        </div>

        <div class="form-group">
            <label for="title">Content</label>
            <textarea name="content" id="content" class="form-control" rows="10"></textarea>
        </div>

        <div class="form-group">
            <label for="title">Featured Image</label>
            <input type="file" name="featured_image" id="featured_image" class="form-control">
        </div>

        <button class="btn btn-primary" name="action" value="publish">Publish</button>



    
    </form>

        
    
</div>



<?php

require_once("footer.php");

?>