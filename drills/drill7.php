<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/header.php");

?>

<div class="container">
    <div class="col-12 mt-4"><h1>SSP Drill  1</h1></div>
        <div class="row">
        
        



        
        </div>
    </div>
</div>

<?php

    $query_users = "SELECT users.*, provinces.name AS province_name 
                    FROM users
                    LEFT JOIN provinces 
                    ON users.province_id = provinces.id";
    
    

    


    if( $user_result = mysqli_query($conn, $query_users) ) :
        // Users Found!!!
        
        while ( $user_row = mysqli_fetch_array($user_result) ) :

?>

<div class="container">

    <ul>

        <li><strong><?php echo $user_row["first_name"]; ?></strong> was created on <?= date("l", strtotime($user_row["date_created"])); ?> and is <?= ( ($user_row["role"] == 1) ? "<strong>Super Admin</strong>" : "a Regular user" ) ?> </li>

    </ul>




</div>


<?php

        endwhile;

    else : 
        echo mysqli_error($conn);
    endif;

?>



<!-- /////////////////// First way above ///////////////////////////-->
<!-- /////////////////// First peters way below ///////////////////////////-->





<?php


require_once($_SERVER["DOCUMENT_ROOT"] . "/footer.php");

?>