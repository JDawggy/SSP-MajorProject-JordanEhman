<?php

require_once("header.php");


// print_r($session);

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Sign up For Free Account</h1>
        </div>
        <form action="/actions/login.php" class="col-12" method="post"> 

            <?php
            include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
            ?>
        
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="first_name">First Name</label>
                <input name="first_name" type="text" class="form-control" id="first_name" placeholder="First Name">
                </div>
                <div class="form-group col-md-6">
                <label for="last_name">Last Name</label>
                <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Last Name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                <label for="emai">Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group col-md-12">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group col-md-12">
                <label for="password2">Password</label>
                <input name="password2" type="password" class="form-control" id="password2" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input name="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input name="address2" type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="city">City</label>
                <input name="city" type="text" class="form-control" id="city">
                </div>
                <div class="form-group col-md-4">
                <label for="province">Province</label>
                <select name="province" id="province" class="form-control">
                    <option selected disabled>Choose...</option>
                    <?php
                    $provinces = [
                        "British Columbia",
                        "Alberta",
                        "Saskatchewan",
                        "Manitoba",
                        "Ontario",
                        "Quebec",
                        "New Brunswick",
                        "Nova Scotia",
                        "Prince Edward Island",
                        "Newfoundland",
                        "Labradour",
                        "Yukon",
                        "North West Territories"
                    ];
                    for($i = 0; $i < count($provinces); $i++){
                        echo "<option value='" . ($i + 1) . "'>" . $provinces[$i] . "</option>";
                    }
                    ?>
                </select>
                </div>
                <div class="form-group col-md-2">
                <label for="postal_code">Postal Code</label>
                <input name="postal_code" type="text" class="form-control" id="postal_code">
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                <input name="agree_terms" class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Agree to the Terms &amp Conditions
                </label>
                </div>
            </div>

            <div class="form-group">

                Sign up for Newsletter? 
                <div class="form-check">

                    <input class="form-check-input" type="radio" name="newsletter" id="newsletter_yes" value="true" checked>
                    <label class="form-check-label" for="newsletter_yes">
                        Yes
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="newsletter" id="newsletter_no" value="false">
                    <label class="form-check-label" for="newsletter_no">
                        No
                    </label>
                </div>
            </div>

                <button name="action" value="signup" type="submit" class="btn btn-primary">Sign up</button>
                
        </form>
    </div>
</div>


<?php

require_once("footer.php");

?>
