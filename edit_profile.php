<?php

require_once("header.php");

$user_id = (isset($_GET["user_id"]) ) ? $_GET["user_id"] : $_SESSION["user_id"];

$user_query = " SELECT users.*, images.url AS profile_pic
                FROM users 
                LEFT JOIN images
                ON users.profile_pic_id = images.id
                WHERE users.id = " . $user_id; 

if ( $user_request = mysqli_query($conn, $user_query) ) :

    while ($user_row = mysqli_fetch_array($user_request)) :
    
        // print_r($user_row);

    

?>


<div class="container">
    <div class="row">
        <div class="col-12">

            <h1>Editing <?php echo $user_row["first_name"] . " " . $user_row["last_name"]; ?></h1>

            <div class="row">
                <div class="col-4">
                    <img class="w-100" src="<?php echo $user_row["profile_pic"]; ?>" alt="">
                </div>
            </div>

            <?php

            include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php"); //error check auto outputs error messages
            ?>

            <form action="/actions/edit_user.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="user_id" value="<?php echo $user_row["id"] ?>">

                <div class="form-row form-group">
                    <div class="col">
                        <div class="form-group">
                            <label for="profile_pic">Profile Image</label>
                            <input type="file" name="profile_pic" id="profile_pic" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-row form-group">

                    <div class="col">  <!-- first name -->
                        <input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo $user_row["first_name"]; ?>" tabindex="1">
                    </div>
                    
                    <div class="col"> <!-- last name -->
                        <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo $user_row["last_name"]; ?>" tabindex="2">
                    </div>
                    
                </div>


                <div class="form-row form-group">

                    <div class="col"> <!-- address -->
                        <input class="form-control" type="text" name="address" placeholder="Address" value="<?php echo $user_row["address"]; ?>" tabindex="2">
                    </div>

                    <div class="col"> <!-- address2 -->
                        <input class="form-control" type="text" name="address2" placeholder="Address 2" value="<?php echo $user_row["address2"]; ?>" tabindex="2">
                    </div>

                </div>


                <div class="form-row form-group">

                    <div class="col"> <!-- postal code -->
                        <input class="form-control" type="text" name="postal_code" placeholder="Postal Code" value="<?php echo $user_row["postal_code"]; ?>" tabindex="2">
                    </div>

                    <div class="col"> <!-- email -->
                        <input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $user_row["email"]; ?>" tabindex="2">
                    </div>

                </div>

                <div class="form-row form-group">

                    <div class="col"> <!-- province -->
                        <select class="form-control" name="province_id" id="province_id">

                            <?php  

                            $province_query = "SELECT * FROM provinces";

                            if( $province_results = mysqli_query($conn, $province_query) ) :
                                
                                echo "<option disabled ";
                                if(!$user_row["province_id"]) echo "selected";
                                echo ">Province</option>";

                                while($province = mysqli_fetch_array($province_results)) :
                                    ?>
                                    <option value="<?= $province["id"];?>" <?php 
                                        if($province["id"] == $user_row["province_id"]) echo " selected";
                                    ?>><?= $province["name"]; ?></option>
                                    <?php
                                endwhile;

                            else :
                                echo mysqli_error($conn);
                            endif;

                            ?>
                            <div class="col"> <!-- city -->
                                <input class="form-control mt-3" type="text" name="city" placeholder="City" value="<?php echo $user_row["city"]; ?>">
                            </div>

                        </select>
                    </div>

                </div>

                
                <hr>

                <?php

                    if($_SESSION["user_id"] == $user_id || $_SESSION["role"] == 1) :

                ?>

                <div class="col">
                    <a href="/reset_password.php">Change Password</a>
                </div>

                <div class="col text-right ml-auto">
                    <button type="submit" name="action" value="delete" class="btn btn-text text-danger">Delete Account</button>
                    <button type="submit" name="action" value="update" class="btn btn-primary" tabindex="3">Update Account</button>
                </div>

                <?php

                    endif;

                ?>

            </form>

        </div>
    </div>
</div>


<?php

endwhile;

else :
    echo mysqli_error($conn);
endif; 


require_once("footer.php");

?>