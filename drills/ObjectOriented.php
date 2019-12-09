<?php

include_once ("header.php");

?>


<div class="container">
    <div class="row mt-4">

        <div class="col-12">

            <h1>Object Oriented Programming</h1>

        </div>

        <div class="col-12">

        <?php

        class Person {
            public $first_name = "";
            public $last_name = "";
            public $hair = "brown";
            public $birthdate;

            public function getAge() {
                $date = new DateTime($this->birthdate);
                $now = new DateTime();
                $age = $now->diff($date);
                return $age->y;
            }
        }

        $person1 = new Person();
        $person1->first_name = "Jordan"; 
        $person1->last_name = "Ehman"; 
        $person1->hair = "Blonde"; 
        $person1->birthdate = "1997-06-05"; 
        
        print_r($person1);

        echo $person1->getAge();

        echo "<hr>";



        $taylor = new Person();
        $taylor->first_name = "Taylor";
        $taylor->birthdate = "1994-11-26"; 
        echo $taylor->first_name . " is " . $taylor->getAge();


        // peters birthday 1971-04-31

        ?>

        </div>
    </div>
</div>

            



            
    
<?php


include_once ("footer.php");



?>



