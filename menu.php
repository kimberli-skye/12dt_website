<?php

/* Connects to database */
$con = mysqli_connect("localhost", "joneski", 'spicysong14', "joneski_canteen");

/* Products Query */
/* Selects all information from Products where available is no*/
/* Contains it in results */
$unavailable_products_query = "SELECT * 
                               FROM products
                               WHERE products.available = 'no'
                               AND ProductType = 'food'";
$unavailable_products_result = mysqli_query($con, $unavailable_products_query);

/* Available Products Query */
/* Selects all information from Products*/
/* Checks if the id's match */
$available_products_query = "SELECT *
                             FROM products
                             WHERE products.available = 'yes'
                             AND ProductType = 'food'";
$available_products_result = mysqli_query($con, $available_products_query);
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

        <!-- Page name class -->
        <div class="page-name">

        </div>

        <!-- all menus (every product) class -->
        <div class="all-menus-block">

            <p>
                <br><br> <b> Available Meals: </b> <br>
                <!-- Opens PHP -->
                <?php
                /* Runs through all results as long as they are in the record */
                while($available_products_record = mysqli_fetch_assoc($available_products_result)){
                    /* echo == prints out info */
                    /* e.g. ProductName from the record or a paragraph break etc. */
                    echo "<br>";
                    echo $available_products_record['ProductName'];
                    echo "<br>";
                    echo "Cost: $". $available_products_record['Price'];
                    echo "<br>Dietary info: ";
                    /* Checks whether the Dietary requirement is yes or no */
                    /* if no, skip, if yes print appropriate info */
                    /* Meat info */
                    if($available_products_record['Meat'] == 'no') {
                    } else {
                        echo "- Meat -";
                    }
                    /* Vegan info */
                    if($available_products_record['Vegan'] == 'no') {
                    } else {
                        echo "- Vegan -";
                    }
                    /* Vegetarian info */
                    if($available_products_record['Vegetarian'] == 'no') {
                    } else {
                        echo "- Vegetarian -";
                    }
                    /* Gluten Free info */
                    if($available_products_record['GlutenFree'] == 'no') {
                    } else {
                        echo "- Gluten Free -";
                    }

                    /* Paragraph break */
                    echo "<br> <br>";
                }

                ?>

                <!-- meals that unavailable = no -->
                <br><br> <b> Unavailable Meals </b> <br>

                <!-- Opens PHP -->
                <?php
                /* Runs through all results as long as they are in the record */
                while($unavailable_products_record = mysqli_fetch_assoc($unavailable_products_result)){
                    /* echo == prints out info */
                    /* e.g. ProductName from the record or a paragraph break etc. */
                    echo "<br>";
                    echo $unavailable_products_record['ProductName'];
                    echo "<br>";
                    echo "Cost: $". $unavailable_products_record['Price'];
                    echo "<br>Dietary info: ";
                    /* Checks whether the Dietary requirement is yes or no */
                    /* if no, skip, if yes print appropriate info */
                    /* Meat info */
                    if($unavailable_products_record['Meat'] == 'no') {
                    } else {
                        echo "- Meat -";
                    }
                    /* Vegan info */
                    if($unavailable_products_record['Vegan'] == 'no') {
                    } else {
                        echo "- Vegan -";
                    }
                    /* Vegetarian info */
                    if($unavailable_products_record['Vegetarian'] == 'no') {
                    } else {
                        echo "- Vegetarian -";
                    }
                    /* Gluten Free info */
                    if($unavailable_products_record['GlutenFree'] == 'no') {
                    } else {
                        echo "- Gluten Free -";
                    }

                    /* Paragraph break */
                    echo "<br> <br>";
                }
                ?>
            </p>

        </div>

        <div class="footer">
            <p> hello </p>
        </div>
    </div>

</html>
