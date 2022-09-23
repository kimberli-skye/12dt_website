<?php
/* Connects to database */
$con = mysqli_connect("localhost", "joneski", 'spicysong14', "joneski_canteen");

/* Queries for each diets
   e.g. Vegetarian, Vegan etc.*/
$vegan_query = "SELECT *
                FROM products
                WHERE products.Vegan = 'yes'";
$vegan_result = mysqli_query($con, $vegan_query);
$vegan_result_two = mysqli_query($con, $vegan_query);

$vegetarian_query = "SELECT ProductName, Price
                     FROM products
                     WHERE products.Vegetarian = 'yes'";
$vegetarian_result = mysqli_query($con, $vegetarian_query);

$GlutenFree_query = "SELECT ProductName, Price
                     FROM products
                     WHERE products.GlutenFree = 'yes'";
$GlutenFree_result = mysqli_query($con, $GlutenFree_query);

$product_query = "SELECT *
                  FROM products, available";
$product_result = mysqli_query($con, $product_query);

$available_food = "SELECT * FROM available";
$available_result = mysqli_query($con, $available_food);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- links to stylesheet -->
        <meta charset="utf-8"/>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>

    <!-- class that is linked to grid in css -->
    <div class="grid-container">

        <!-- Header Class -->
        <div class="header">

        </div>

        <!-- Nav Class -->
        <div class="navigation">
            <!-- links the navigation buttons to different pages of the website -->
            <!-- links to class "one" for first link type -->
            <a class="one" href="home_page.php">Home</a>
            <a class="one" href="menu.php">Menu</a>
            <a class="one" href="diets.php">Diets</a>
            <a class="one" href="drinks.php">Drinks</a>
        </div>

        <!-- "diets page name" Class -->
        <div class="diets-page-name">
            <h1> Diets </h1>

        </div>

        <!-- "diets toggle block" Class -->
        <div class="diets-toggle-block">
            <!--
                How to choose a Diet
                from the click of a button
                Code used: https://www.geeksforgeeks.org/how-to-call-php-function-on-the-click-of-a-button/
            -->

            <form method="post">
                <input type="submit" name="Vegan"
                       value="Vegan" />

                <input type="submit" name="Vegetarian"
                       value="Vegetarian" />

                <input type="submit" name="GlutenFree"
                       value="GlutenFree" />
            </form>

        </div>

        <!-- "toggled diet name" class -->
        <div class="toggled-diet-name">
            <?php

            /* Checks if the button (or form) has been clicked
               Prints info in the diet name */
            if(isset($_POST['Vegan'])) {
                echo "<h1> Vegan Products</h1>";
            }
            if(isset($_POST['Vegetarian'])) {
                echo "<h1> Vegetarian Products</h1>";
            }
            if(isset($_POST['GlutenFree'])) {
                echo "<h1> Gluten Free Products</h1>";
            }

            ?>
        </div>

        <!-- diets info Class -->
        <div class="diets-info">
            <p>
                <?php

                /* Checks if the button (or form) has been clicked for each diet
                    Prints info in the diet info block (i.e. product name and price) */

                if(isset($_POST['Vegan'])) {
                    /* Runs through all available results as long as they are in the record */
                    while($vegan_record = mysqli_fetch_assoc($vegan_result)) {

                        /* echo == prints out info */
                        /* e.g. ProductName from the record or a paragraph break etc. */
                        echo "<br>";
                        echo "<b>" . $vegan_record['ProductName'] . "</b>";
                        echo "<br>";
                        echo "Cost: $" . $vegan_record['Price'];
                        echo "<br>";

                    }
                }
                if(isset($_POST['Vegetarian'])) {
                    /* Runs through all available results as long as they are in the record */
                    while($vegetarian_record = mysqli_fetch_assoc($vegetarian_result)) {

                        /* echo == prints out info */
                        /* e.g. ProductName from the record or a paragraph break etc. */
                        echo "<br>";
                        echo "<b>" . $vegetarian_record['ProductName'] . "</b>";
                        echo "<br>";
                        echo "Cost: $" . $vegetarian_record['Price'];
                        echo "<br>";
                    }
                }
                if(isset($_POST['GlutenFree'])) {
                    /* Runs through all available results as long as they are in the record */
                    while($GlutenFree_record = mysqli_fetch_assoc($GlutenFree_result)) {

                        /* echo == prints out info */
                        /* e.g. ProductName from the record or a paragraph break etc. */
                        echo "<br>";
                        echo "<b>" . $GlutenFree_record['ProductName'] . "</b>";
                        echo "<br>";
                        echo "Cost: $" . $GlutenFree_record['Price'];
                        echo "<br>";
                    }
                }

                ?>

            </p>

        </div>

        <!-- footer class in grid -->
        <div class="footer">

        </div>

    </div>

</html>