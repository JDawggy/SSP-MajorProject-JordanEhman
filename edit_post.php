<?php

// is user logged in they can view the page if not they will be returned to the header function
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: http://" . $_SERVER["SERVER_NAME"] ); //. "login.php" to get to a diffrent page and remove the ) after SERVER_NAME]
} 

require_once("header.php");


if( isset($_GET["post_id"]) ) {


$article_id = $_GET["post_id"];
$article_query = "  SELECT *
                    FROM posts
                    WHERE id = $article_id";
if( $results = mysqli_query($conn, $article_query) ) {
    
    while($article_row = mysqli_fetch_array($results) ) {

        // print_r($article_row);
?>


<div class="container">
    
    <div class="col-12"><h1>Edit Post</h1></div>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php"); ?>


    <form action="/actions/update_post_action.php" method="post" enctype="multipart/form-data">

        <input type="hidden" name="post_id" value="<?= $article_row["id"]; ?>">
    
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Article Title" class="form-control" value="<?= $article_row["title"]; ?>">
        </div>

        <div class="form-group">
            <label for="title">Content</label>
            <textarea name="content" id="content" class="form-control" rows="10"><?= $article_row["content"]; ?></textarea>
        </div>

        <div class="form-group">
            <label for="title">Featured Image</label>
            <input type="file" name="featured_image" id="featured_image" class="form-control">
        </div>

        

        <button class="btn btn-text text-danger" name="action" value="delete">Delete</button>
        <button class="btn btn-primary" name="action" value="update">Update</button>



    
    </form>

        
    
</div>



<?php
        } // end while

    } // end if for running the query

} // end if GET post_id isset

require_once("footer.php");

?>