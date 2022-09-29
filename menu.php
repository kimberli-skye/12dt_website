<?php

/* Connects to database */
$con = mysqli_connect("localhost", "joneski", 'spicysong14', "joneski_canteen");

/* Unavailable Products Query
   Selects all information from Products where available is no
   and Product type is food (no drinks on this page)
   Contains it in results */
$unavailable_products_query = "SELECT * 
                               FROM products
                               WHERE available = 'no'
                               AND ProductType = 'food'";
$unavailable_products_result = mysqli_query($con, $unavailable_products_query);

/* Available Products Query
   Selects all information from Products where it equals yes */
$available_products_query = "SELECT *
                             FROM products
                             WHERE available = 'yes'
                             AND ProductType = 'food'";
$available_products_result = mysqli_query($con, $available_products_query);
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
            <!-- Links to home page -->
            <a href="home_page.php">
                <!-- Links in an image, adds alternate info, sets height and width -->
                <img src="wgc_logo.png" alt="Wellington Girl's College Logo" height=120px width=120px>
            </a>
        </div>

        <!-- Navigation Class -->
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
            <h1> Meals Menu </h1>
        </div>

        <!-- All menus (every product) class -->
        <div class="all-menus-block">

            <!-- Title-->
            <h2><br> <b> Available Meals: </b> <br></h2>

            <!-- Opens PHP -->
            <?php
            /* Runs through all available results as long as they are in the record */
            while($available_products_record = mysqli_fetch_assoc($available_products_result)){

                /* Echo == prints out info */
                /* Grabs general info from the record under column names */
                echo "<p><br><b>" . $available_products_record['ProductName'] . "</b>";
                echo "<br>Cost: $". $available_products_record['Price'];
                echo "<br>Dietary info: ";

                /* Checks whether the Requirement is yes or no
                   if no, skip, if yes print appropriate info
                   Meat info */
                if($available_products_record['Meat'] == 'yes') {
                    echo "- Meat -";
                }

                /* Vegan info */
                if($available_products_record['Vegan'] == 'yes') {
                    echo "- Vegan -";
                }

                /* Vegetarian info */
                if($available_products_record['Vegetarian'] == 'yes') {
                    echo "- Vegetarian -";
                }

                /* Gluten Free info */
                if($available_products_record['GlutenFree'] == 'yes') {
                    echo "- Gluten Free -";
                }

                echo "<br> <br></p>";
            }

            ?>
            </p>

            <h2>
                <!-- Separation title-->
                <br><br> <b> Unavailable Meals: </b> <br>
            </h2>

            <!-- Opens PHP -->
            <?php
            /* Runs through all unavailable results as long as they are in the record */
            while($unavailable_products_record = mysqli_fetch_assoc($unavailable_products_result)){

                echo "<p><br><b>" . $unavailable_products_record['ProductName'] . "</b>";
                echo "<br>Cost: $". $unavailable_products_record['Price'];
                echo "<br>Dietary info: ";

                /* Checks whether the Requirement is yes or no
                      if no, skip, if yes print appropriate info
                      Meat info */
                if($unavailable_products_record['Meat'] == 'yes') {
                    echo "- Meat -";
                }

                /* Vegan info */
                if($unavailable_products_record['Vegan'] == 'yes') {
                    echo "- Vegan -";
                }

                /* Vegetarian info */
                if($unavailable_products_record['Vegetarian'] == 'yes') {
                    echo "- Vegetarian -";
                }

                /* Gluten Free info */
                if($unavailable_products_record['GlutenFree'] == 'yes') {
                    echo "- Gluten Free -";
                }

                echo "<br> <br></p>";
            }
            ?>

        </div>

        <!-- Footer class -->
        <div class="footer">
        </div>

    </div>

</html>
