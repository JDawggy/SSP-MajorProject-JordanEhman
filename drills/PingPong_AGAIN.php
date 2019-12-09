<?php

include_once ("header.php");

?>


<div class="container">
    <div class="row mt-4">
        <div class="col-12">

            <h1>SSP Drill  3</h1>

            <p>Make a loop that for every 3rd interval echo ping, and every 7th interval echo pong. <br> 
            If the interval is devisable by both 3 and 7 echo PingPong.</p>


            <ol start="1" style="columns:4;">
           
            <?php

            for ($zero=1; $zero<=100; $zero++ ) :

                echo "<li>";

                if( ($zero % 3 == 0) && ($zero % 7 == 0) ) :
                    echo "<span class='text-success'>pingpong</span>";
                    echo "<br>";
                
                elseif ($zero % 3 == 0) :
                    echo "<span class='text-warning'>ping</span>";
                    echo "<br>";

                elseif ($zero % 7 == 0) :
                    echo "<span class='text-danger'>pong</span>";
                    echo "<br>";
                
                endif;

                echo "</li>";

            endfor;


            ?>

                
            </ol>








            <hr class="mt-5 mb-5">









            <div style="columns:4;">
           
            <?php

            for ($zero=1; $zero<=100; $zero++ ) :

                echo $zero . ":";

                if( ($zero % 3 == 0) && ($zero % 7 == 0) ) :
                    echo "<span class='text-success'> pingpong</span>";
                
                elseif ($zero % 3 == 0) :
                    echo "<span class='text-warning'> ping</span>";

                elseif ($zero % 7 == 0) :
                    echo "<span class='text-danger'> pong</span>";
                
                endif;

                echo "<br>";

            endfor;





            // $variable+=1 means everytime it gets counted it will add one to it

            // this can replace the span tags above if i also give them the variable $color=0 or $color+=1 before the echo that outputs the word ping or pong

            switch($color) {
                case 1:
                    $append = "<span class='text-danger'>";
                break;
            
                case 2:
                    $append = "<span class='text-success'>";
                break;

                case 3:
                    $append = "<span class='text-warning'>";
                break;

                default:
                    $append = "<span>";
                break;
            
            }


            ?>

            </div>

            <hr class="mt-5 mb-5">


<?php




$cars = ["Ford", "Toyota", "BMW", "Audi"];

// For each loops can use the AS feature as rename things in an array to give them independant values

foreach ($cars as $car) {
    echo $car . "<br>";

    switch($car) {
        case "Ford":
            echo "Horsepower: None";
        break;

        case "Toyota":
            echo "Horsepower: None plus 1";
        break;

        case "BMW":
            echo "Horsepower: Some";
        break;

        case "Audi":
            echo "Horsepower: When it runs";
        break;

        default:
            echo "Unknown";
        break;

    }

    echo "<hr>";
}





            
    



include_once ("footer.php");



// for( var i = 0; i <= 100; i++ ) {
    
//     if( i % 3 == 0 && i % 7 == 0 ) {
//         $("body").append( i + "pingpong" + "<br>");
// } else if( i % 3 == 0 ) {
//     $("body").append( i + "pong" + "<br>" );
// } else if(i % 7 == 0){
//     $("body").append( i + "ping" + "<br>" );
// }

// $("body").append(i + "<br>");
// }



?>



