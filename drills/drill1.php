<?php

include_once ("header.php");

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

        <li><?php echo $user_row["first_name"]; ?> lives in <?= $user_row["province_name"]; ?> and started on <?= date("l", strtotime($user_row["date_created"])); ?> of <?= date("F", strtotime($user_row["date_created"])); ?> in <?= date("Y", strtotime($user_row["date_created"])); ?></li>

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


include_once ("footer.php");

?>