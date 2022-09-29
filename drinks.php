<?php

/* Connects to database */
$con = mysqli_connect("localhost", "joneski", 'spicysong14', "joneski_canteen");

/* Drinks Query
   Selects all information from products where product type is drink
   Contains it in results */
$all_drinks_query = "SELECT *
                     FROM products
                     WHERE ProductType = 'drink'";
$all_drinks_result = mysqli_query($con, $all_drinks_query);

/* Stores two more results for all drinks that will be used in different divs */
$all_drinks_result_2 = mysqli_query($con, $all_drinks_query);
$all_drinks_result_3 = mysqli_query($con, $all_drinks_query);


/* Adds a new column to table called div_placement */
$added_column = mysqli_query($con, "ALTER TABLE products ADD div_placement VARCHAR(10) NULL");

/* Div number holder
   Counts number of rows of drinks, stores as a count variable,
   Divide this by three to find out the limit of rows for each div,
   Rounds it: */
$count_rows = mysqli_num_rows($all_drinks_result);
$drink_limit = round($count_rows / 3);


/* Updates the different parts of the table
   Adds div_one/two into the table in the div_placement column */

/* Updates products with the lower limit */
$sql_update_lower = "UPDATE products 
                     SET div_placement = 'div_one'   
                     WHERE ProductType = 'drink'
                     LIMIT $drink_limit";       /* limit is linked to drink limit */

/* Updates products with the higher limit */
$sql_update_higher = "UPDATE products 
                     SET div_placement = 'div_two' 
                     WHERE ProductType = 'drink'
                     ORDER BY ProductID DESC       /* Descending ProductID (e.g. 9,8,7) */
                     LIMIT $drink_limit";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- links to stylesheet -->
        <meta charset="utf-8"/>
        <link href="style.css" rel="stylesheet" type="text/css">
        <title>WGC Canteen - Kimberli Jones</title>
    </head>

    <!-- class that is linked to grid in css -->
    <div class="grid-container">

        <!-- Header Class -->
        <div class="header">
            <div class="header">
                <!-- Creates an image link to home page, adds alternate info, sets height and width -->
                <a href="home_page.php">
                    <img src="wgc_logo.png" alt="Wellington Girl's College Logo" height=120px width=120px>
                </a>
            </div>
        </div>

        <!-- Nav Class -->
        <div class="navigation">
            <!-- links the navigation buttons to different pages of the website
                 links to class "one" for first link type -->
            <a class="one" href="home_page.php">Home</a>
            <a class="one" href="menu.php">Menu</a>
            <a class="one" href="diets.php">Diets</a>
            <a class="one" href="drinks.php">Drinks</a>
        </div>

        <!-- Page name class -->
        <div class="page-name">
            <h1>
                Drinks
            </h1>
        </div>

        <!--- Runs through all results as long as they are in the record --->
        <div class="drink-info-left">
            <p>
                <?php
                /* Creates and runs through record as long as the item is in all drinks */
                while($div_left_record = mysqli_fetch_assoc($all_drinks_result)) {

                    /* Checks if the div placement is div_one, if equal, echo info */
                    if ($div_left_record['div_placement'] == "div_one") {
                        /* echo == prints out info
                           e.g. SpecialsID from the record or a paragraph break etc. */
                        echo "<br><h2>" . $div_left_record['ProductName'] . "</h2>";
                        echo "<p> $" . $div_left_record['Price'];
                        echo "<br>Dietary info: <br>";


                        /* Checks whether the Dietary requirement is yes or no
                           if no, skip, if yes print appropriate info */

                        /* Meat info */
                        if ($div_left_record['Meat'] == 'yes') {
                            echo " Meat,";
                        }

                        /* Vegan info */
                        if ($div_left_record['Vegan'] == 'yes') {
                            echo " Vegan,";
                        }

                        /* Vegetarian info */
                        if ($div_left_record['Vegetarian'] == 'yes') {
                            echo " Vegetarian,";
                        }

                        /* Gluten Free info */
                        if ($div_left_record['GlutenFree'] == 'yes') {
                            echo " Gluten Free,";
                        }

                        /* Available, checks if it equals YES */
                        echo "<br>";
                        if ($div_left_record['available'] == "yes") {
                            echo "<b>Available</b>";
                        } else {
                            echo "<b>Out of Stock</b>";
                        }
                        echo "<br><br>";
                    }
                }

                ?>
            </p>
        </div>

        <!--- Runs through all results as long as they are in the record --->
        <div class="drink-info-right">
            <p>
                <?php
                while($div_right_record = mysqli_fetch_assoc($all_drinks_result_2)) {
                    /* Checks if the div placement is div_one, if equal, echo info */
                    if( $div_right_record['div_placement'] == "div_two") {
                        /* echo == prints out info
                           e.g. SpecialsID from the record or a paragraph break etc. */
                        echo "<br>";
                        echo "<h2>" . $div_right_record['ProductName'] . "</h2>";
                        echo "<p> $" . $div_right_record['Price'];
                        echo "<br>Dietary info: <br>";


                        /* Checks whether the Dietary requirement is yes or no
                           if no, skip, if yes print appropriate info */

                        /* Meat info */
                        if ($div_right_record['Meat'] == 'yes') {
                            echo " Meat,";
                        }

                        /* Vegan info */
                        if ($div_right_record['Vegan'] == 'yes') {
                            echo " Vegan,";
                        }

                        /* Vegetarian info */
                        if ($div_right_record['Vegetarian'] == 'yes') {
                            echo " Vegetarian,";
                        }

                        /* Gluten Free info */
                        if ($div_right_record['GlutenFree'] == 'yes') {
                            echo " Gluten Free,";
                        }

                        /* Available, checks if it equals YES */
                        echo "<br>";
                        if ($div_right_record['available'] == "yes") {
                            echo "<b>Available</b>";
                        } else {
                            echo "<b>Out of Stock</b>";
                        }
                        echo "<br><br>";
                    }
                }

                ?>
            </p>
        </div>

        <!--- Runs through all results as long as they are in the record --->
        <div class="drink-info-middle">
            <p>
                <?php
                while($div_middle_record = mysqli_fetch_assoc($all_drinks_result_3)) {

                    /* Checks if div_placement is null:
                    https://www.w3schools.com/php/func_var_is_null.asp#:~:
                    text=The%20is_null()%20function%20checks,otherwise%20it%20returns%20false%2Fnothing.
                    (Got inspo for code here) */
                    if(is_null($div_middle_record['div_placement'])) {
                        echo "<br>";
                        echo "<h2>" . $div_middle_record['ProductName'] . "</h2>";
                        echo "<p> $" . $div_middle_record['Price'];
                        echo "<br>Dietary info: <br>";


                        /* Checks whether the Dietary requirement is yes or no
                           if no, skip, if yes print appropriate info */

                        /* Meat info */
                        if ($div_middle_record['Meat'] == 'yes') {
                            echo " Meat,";
                        }

                        /* Vegan info */
                        if ($div_middle_record['Vegan'] == 'yes') {
                            echo " Vegan,";
                        }

                        /* Vegetarian info */
                        if ($div_middle_record['Vegetarian'] == 'yes') {
                            echo " Vegetarian,";
                        }

                        /* Gluten Free info */
                        if ($div_middle_record['GlutenFree'] == 'yes') {
                            echo " Gluten Free,";
                        }

                        /* Available, checks if it equals YES */
                        echo "<br>";
                        if ($div_middle_record['available'] == "yes") {
                            echo "<b>Available</b>";
                        } else {
                            echo "<b>Out of Stock</b>";
                        }
                        echo "<br><br>";
                    }
                }
                ?>
            </p>
        </div>

        <div class="footer">
            <h2> ⓒ Copyright of Wellington Girls' College (Kimberli Jones)</h2>
        </div>

    </div>

</html>