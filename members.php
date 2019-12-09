<?php

require_once("header.php")

?>

<div class="container">
    <div class="row">

        <div class="col-12">
            <h1><?php  
            
            if(isset($_GET["search"])) {
                echo "Search results for: " . $_GET["search"];
            } else {
                echo "Members";
            }
            
            ?></h1>
        </div>
        <hr>

        <?php

            // This is to make the search bar find users

            $users_query = "SELECT users.id, users.first_name, users.last_name, images.url AS profile_pic
                            FROM users
                            LEFT JOIN images
                            ON users.profile_pic_id = images.id";
            
            $search = (isset($_GET["search"])) ? $_GET["search"] : false;

            if($search) {

                // explode is taking the full user input from the search bar and removing whatever is in the first quotes after explode(" ","") {in this case it removes the space between first and last name} and it will take the values and turn each of them into an item in an array
                $search_words = explode(" ", $search);
                $users_query .= "";

                for($i = 0; $i < count($search_words); $i++) {
                    $users_query .= ($i > 0) ? " OR " : " WHERE ";
                    $users_query .= "users.first_name LIKE '%" . $search_words[$i] . "%'";
                    $users_query .= " OR users.last_name LIKE '%" . $search_words[$i] . "%'";

                }

    

            }






            if( $users_result = mysqli_query($conn, $users_query) ) {
                while( $user_row = mysqli_fetch_array($users_result) ) {
                    ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">

                                <img class="w-100" src="<?php echo $user_row["profile_pic"]; ?>" alt="">

                                <div class="card-header">
                                    <h5>
                                        <a href="/profile.php?user_id=<?=$user_row["id"];?>">
                                            
                                            <?= $user_row["first_name"] . " " . $user_row["last_name"] ?>
                                        </a>
                                    </h5>
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

require_once("footer.php")

?>