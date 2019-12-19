<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/conn.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/header.php");



if( isset($_GET["action"]) && $_GET["action"] == "new_item" ) :

    $item = htmlspecialchars($_GET["item"], ENT_QUOTES);

    $query =    "INSERT INTO shopping_list (item)
                 VALUES ('$item')";


    if ( mysqli_query($conn, $query) ) {
        

        // Successs
    
        
    } else {
        echo "Failed update";
    }



elseif( isset($_GET["action"]) && $_GET["action"] == "delete") :
    
    $id = $_GET["id"];
    $delete_query = "DELETE FROM shopping_list WHERE id = $id";

    mysqli_query($conn, $delete_query);




elseif( isset($_GET["action"]) && $_GET["action"] == "update_item" ) :

    $id = $_GET["item_id"];
    $new_item = $_GET["item"];

    $update_query = "   UPDATE shopping_list 
                        SET item = '$new_item' 
                        WHERE id = $id";

    mysqli_query($conn, $update_query);



endif;

?>

<div class="container">
    <div class="col-12 mt-4"><h1>SSP Drill  2</h1></div>
        <div class="row col-12">
            

            <?php

                $item_query = "SELECT * FROM shopping_list";



                if($result = mysqli_query($conn, $item_query)) {
                    echo "<ul>";
                    while($item_row = mysqli_fetch_array($result)) {
                        echo "<li>" . $item_row['item'] .  " 
                            <a href='?action=delete&id=" . $item_row["id"] . "'>x</a>
                            <a href='?action=edit&id=" . $item_row["id"] . "'>edit</a>
                            </li>";
                    }
                    echo "</ul>";
                } else {
                    echo mysqli_error($conn);
                }

            ?>


            <form class="col-12" action="drill2.php" method="get">
                <div class="form-row input-group">

                    <?php
                    // if action is edit, select item from database
                    // select the item from database
                    // fill input feild with text
                    // if action is not set leave feild blank

                    $item_value = '';
                    $button_value = "add_item";
                    $button_text = "add Item";

                    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
                        
                        $cool_id = $_GET["id"];

                        ?>

                        <input type="hidden" name="item_id" value="<?=$cool_id?>">

                        <?php

                        $edit_query = " SELECT *
                                        FROM shopping_list
                                        WHERE id = $cool_id";


                        if( $edit_query_results = mysqli_query($conn, $edit_query) ) {

                            $button_value = "update_item";
                            $button_text = "Update Item";


                            while( $item_row = mysqli_fetch_array($edit_query_results) ) {

                                $item_value = $item_row["item"];

                                
                            }
                        } // end if 
                        
                        
                        
                    }
                    
                    

                    ?>

                    <input type="text" class="form-control" placeholder="new item" name="item" value="<?= $item_value ?>">

                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="action" value="<?= $button_value ?>"><?= $button_text ?></button>
                    </div>

                </div>
            </form>
        
        
        
        </div>
    </div>
</div>





<?php


require_once($_SERVER["DOCUMENT_ROOT"] . "/footer.php");

?>