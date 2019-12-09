<?php

require "header.php";

// $article_row and stuff is a post row if its matched the database names

?>


<div class="container">

    <div class="row">

        <?php

        if(isset($_GET["id"])){

            $article_query = "  SELECT  posts.*, 
                                        users.first_name, users.last_name,
                                        images.url AS featured_image
                                FROM posts
                                LEFT JOIN users
                                ON posts.author_id = users.id
                                LEFT JOIN images
                                ON posts.image_id = images.id
                                WHERE posts.id = " . $_GET["id"];  

            if( $article_result = mysqli_query($conn, $article_query)){
                while($article_row = mysqli_fetch_array($article_result)){

                    // print_r($article_row);
                    
                    ?>
                    <div class="col-12">
                        <h1><?= $article_row["title"] ?></h1>
                        <p class="text-muted">Published on <?= date("M jS Y @ gA", strtotime($article_row["date_created"])); ?> by <?= $article_row["first_name"] . " " . $article_row["last_name"] ?></p>
                    </div>
                    <div class="col-5">
                        <figure>
                            <img src="<?= $article_row["featured_image"]; ?>" class="w-100">
                        </figure>
                    </div>
                    <div class="col-7">
                        <?php
                            echo $article_row["content"];
                        ?>
                    </div>
                    <?php

                    // if logged in and the post belongs to you or if you are the super admin show edit button/menu

                    if( isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $article_row["author_id"] ) {
                        $this_post = $article_row["id"] ;
                        echo "<hr>";
                        echo "<div class='col-12'>";
                            echo "<a href='edit_post.php?post_id=" . $this_post ."' class='btn btn-primary'>Edit Article</a>";
                        echo "</div>";

                    }


                }
            } else {
                echo mysqli_error($conn);
            }

            
        } else {
            // if no ID set, show ALL articles
            // if query includes search

            $search_query = (isset($_GET["search"])) ? $_GET["search"] : false;

            if($search_query) {
                // this is just the title with its col-12 from below on 1 line
                echo "<div class='col-12'><div class='row'><h1>Search Results for : $search_query</h1></div>";
            } else {
                echo "<div class='col-12'><div class='row'><h1>Search Results for : Articles</h1></div>";
            }



            ?>
            <div class="col-12">
                <div class="row">
                    <h1>Articles</h1>   
                </div>

                <div class="row">
                <?php
                
                $article_query = "  SELECT  posts.title, posts.author_id, posts.date_created, posts.id,
                                            images.url AS featured_image,
                                            users.first_name, users.last_name
                                    FROM posts
                                    LEFT JOIN images
                                    ON posts.image_id = images.id
                                    LEFT JOIN users
                                    ON posts.author_id = users.id";
                                    
                if($search_query){

                $article_query .= " WHERE posts.title LIKE '%$search_query%'
                                    OR posts.content LIKE '%$search_query%'";

                }

                $article_query .= " ORDER BY posts.date_created DESC";
                
                if($article_result = mysqli_query($conn, $article_query)) {
                    while($article_row = mysqli_fetch_array($article_result)) {
                        ?>

                        <div class="card col-12 mb-3">
                            <div class="row no-gutters">
                                <div class="col-sm-3">
                                    <img src="<?= $article_row["featured_image"] ?>" class="card-img">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="/articles.php?id=<?= $article_row["id"]?>"><?= $article_row["title"] ?></a>
                                        </h5>
                                        <small class="text-muted"><?= "By " . $article_row["first_name"] . " " . $article_row["last_name"] . " on " . date("M jS Y @ gA", strtotime($article_row["date_created"]))  ?></small>
                                        <p>
                                            <a href="/articles.php?id=<?= $article_row["id"]?>">Read more</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                    }
                } else {
                    echo mysqli_error($conn);
                }

                ?>
                </div>
            </div>
            <?php
        }
        ?>
        
    
    
    
    </div>
</div>



<?php

require "footer.php";

?>