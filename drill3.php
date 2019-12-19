<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/conn.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/header.php");

if( isset($_REQUEST["action"]) && $_REQUEST["action"] == "add_cool_tag" ){
    // tag_id, post_id
    $tag_id = $_REQUEST["tag_id"];
    $article_id = $_REQUEST["post_id"];
    $add_cool_tag_query = "INSERT INTO post_tags (tag_id, article_id) VALUES ($tag_id, $article_id)";

    if(mysqli_query($conn, $add_cool_tag_query)) {
        // She work
    }
}

?>

<div class="container"> 
    <div class="col-12 row"> <h1>SSP Drill  3</h1> </div> <!-- col-12 -->
        <div class="row">

            

            <div class="col-8 card"> <!-- This is where the posts go  -->

            <?php

            $articles_query = "SELECT * FROM posts";

            if($articles_results = mysqli_query($conn, $articles_query)) {
                while($article_row = mysqli_fetch_array($articles_results)) {
                    echo "<h3>";
                    echo $article_row["title"];
                    echo "</h3>";

                    // this is where it will show the tags that have been added to the posts
                    echo "<p><strong>Tags:</strong>"; 
                    
                    $cool_tag_query = " SELECT post_tags.*, tags.tag
                                        FROM post_tags
                                        LEFT JOIN tags
                                        ON post_tags.tag_id = tags.id
                                        WHERE post_tags.article_id = " .$article_row["id"];
                    
                    if($cool_tag_results = mysqli_query($conn, $cool_tag_query)) {
                        $comma = "";
                        while($cool_tag_row = mysqli_fetch_array($cool_tag_results)){
                            echo $comma . $cool_tag_row["tag"];
                            $comma = ", ";
                        }
                    }

                    echo "</p>";

                    ?>

                    <form action="drill3.php" class="input-group">
                        <input type="hidden" name="post_id" value="<?= $article_row["id"] ?>">
                        <select name="tag_id" class="form-control">
                            <?php
                            $tags_query = "SELECT * FROM tags";

                            if($tags_results = mysqli_query($conn, $tags_query)) {
                                while($tag_option = mysqli_fetch_array($tags_results)) {
                                    echo "<option value='" . $tag_option["id"] . "'>" . $tag_option["tag"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="action" value="add_cool_tag">Add Tag</button>
                        </div>
                    </form>

                    <?php
                    echo "<hr>";
                } // end of $article_row while
            } // end of $article_results if

            
            ?>
        


            
            </div> <!-- End posts -->

           









            <?php

            if( isset($_GET["action"]) && $_GET["action"] == "add_tag" ) :

                $tag = htmlspecialchars($_GET["tag"], ENT_QUOTES);

                $query =    "INSERT INTO tags (tag)
                            VALUES ('$tag')";

                // print_r($query);
                // exit;

                if ( mysqli_query($conn, $query) ) {
                    

                    // Successs

                    
                } else {
                    echo "Failed update";
                }

            elseif( isset($_GET["action"]) && $_GET["action"] == "delete") :

            $id = $_GET["id"];
            $delete_query = "DELETE FROM tags WHERE id = $id";

            mysqli_query($conn, $delete_query);



            elseif( isset($_GET["action"]) && $_GET["action"] == "update_tag" ) :

            $id = $_GET["tag_id"];
            $new_tag = $_GET["tag"];

            $update_query = "   UPDATE tags 
                                SET tag = '$new_tag' 
                                WHERE id = $id";

            mysqli_query($conn, $update_query);


            endif;

            ?>



            <div class="col-4 card p-4"> <!-- This is where the tags go -->

            <?php

            $tag_query = "SELECT * FROM tags";


            if($result = mysqli_query($conn, $tag_query)) {
                echo "<ul>";
                while($item_row = mysqli_fetch_array($result)) {
                    echo "<li>" . $item_row['tag'] .  " 
                        <a href='?action=delete&id=" . $item_row["id"] . "'>x</a>
                        <a href='?action=edit&id=" . $item_row["id"] . "'>edit</a>
                        </li>";
                }
                echo "</ul>";
            } else {
                echo mysqli_error($conn);
            }

            ?>

                <form class="col-12" action="/drill3.php" method="get">
                    <div class="form-row input-group">

                        <?php
                        // if action is edit, select tag from database
                        // select the tag from database
                        // fill input feild with text
                        // if action is not set leave feild blank

                        $tag_value = '';
                        $button_value = "add_tag";
                        $button_text = "Add Tag";

                        if(isset($_GET["action"]) && $_GET["action"] == "edit") {
                            
                            $cool_id = $_GET["id"];

                            ?>

                            <input type="hidden" name="tag_id" value="<?=$cool_id?>">

                            <?php

                            $edit_query = " SELECT *
                                            FROM tags
                                            WHERE id = $cool_id";


                            if( $edit_query_results = mysqli_query($conn, $edit_query) ) {

                                $button_value = "update_tag";
                                $button_text = "Update Tag";


                                while( $item_row = mysqli_fetch_array($edit_query_results) ) {

                                    $tag_value = $item_row["tag"];

                                }
                            } // end if 
                            


                        }


                        ?>

                        <input type="text" class="form-control" placeholder="new tag" name="tag" value="<?= $tag_value ?>">

                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="action" value="<?= $button_value ?>"><?= $button_text ?></button>
                        </div>

                    </div>
                </form>
                
            </div><!-- End tags -->
        </div> <!-- End row -->
   
</div> <!-- container -->





<?php


require_once($_SERVER["DOCUMENT_ROOT"] . "/footer.php");

?>