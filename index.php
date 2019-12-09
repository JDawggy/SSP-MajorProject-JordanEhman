<?php

require_once("header.php");

$_SESSION["name"] = "Jordan";

// print_r($_SESSION);


?>

<!-- HTML goes here -->

<div class="container">
<div class="col-12"><h1>SSP Major Project</h1></div>
    <div class="row">
        <?php
        echo '<div class="col-12">';
        if(isset($_SESSION["user_id"])) :
            echo "<h2>Welcome Back " . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . "<h2>";

        ?>
        <form action="/actions/login.php" method="post">
            <button type="submit" name="action" value="logout" class="btn btn-warning">Logout</button>
        </form>
        <?php
        
        else :
        ?>
        <form action="/actions/login.php" method="post" class="col">

            <h2>Login</h2>

            <?php
            include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
            ?>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" class="form-control">
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>

            <div class="form-group">
                <p>
                    <button class="btn btn-primary" type="submit" name="action" value="login">Login</button>
                </p>
                <p>
                    <a href="/signup.php">Create Account?</a>
                </p>
            </div>

        </form>
        <?php
        endif;
        echo '</div class="col-12">';
        ?>
    </div>
</div>



<?php

require_once("footer.php");

?>