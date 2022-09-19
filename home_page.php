<?php

/* Connects to database */
$con = mysqli_connect("localhost", "joneski", 'spicysong14', "joneski_canteen");

/* Specials Query */
/* Selects all information from products and specials */
/* Contains it in results */
$all_specials_query = "SELECT *
                       FROM products, weeklyspecials
                       WHERE products.ProductID = weeklyspecials.ProductID";
$all_specials_result = mysqli_query($con, $all_specials_query);
?>

<!DOCTYPE html>
<!-- Sets language as English-->
<html lang="en">
    <head>
        <!-- Sets utf-8 as chr -->
        <!-- Links CSS page -->
        <meta charset="utf-8"/>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>

    <!-- class that is linked to full grid in css -->
    <div class="grid-container">

        <!-- Header class, linked to grid -->
        <div class="header">

        </div>

        <!-- Navigation class, linked to grid -->
        <div class="navigation">
            <!-- links the navigation buttons to different pages of the website -->
            <!-- links to class "one" for first link type -->
            <a class="one" href="home_page.php">Home</a>
            <a class="one" href="menu.php">Menu</a>
            <a class="one" href="diets.php">Diets</a>
            <a class="one" href="drinks.php">Drinks</a>
        </div>

        <!-- "page name" class, linked to grid -->
        <div class="page-name">

        </div>

        <!-- "menu block" class, linked to grid -->
        <div class="menu-block">

        </div>

        <!-- Specials class, linked to grid -->
        <div class="specials-block">
            <p>
                <!-- Opens PHP -->
                <?php
                /* Runs through all results as long as they are in the record */
                while($all_specials_record = mysqli_fetch_assoc($all_specials_result)){

                    /* echo == prints out info */
                    /* e.g. SpecialsID from the record or a paragraph break etc. */
                    echo "<br>";
                    echo " " . $all_specials_record['SpecialsID'];
                    echo ":<br>";
                    echo $all_specials_record['ProductName'];
                    echo " $" . $all_specials_record['DiscountedPrice'];
                    echo "<br>Dietary info: ";

                    /* Checks whether the Dietary requirement is yes or no */
                    /* if no, skip, if yes print appropriate info */
                    /* Meat info */
                    if($all_specials_record['Meat'] == 'no') {
                    } else {
                        echo "- Meat -";
                    }

                    /* Vegan info */
                    if($all_specials_record['Vegan'] == 'no') {
                    } else {
                        echo "- Vegan -";
                    }

                    /* Vegetarian info */
                    if($all_specials_record['Vegetarian'] == 'no') {
                    } else {
                        echo "- Vegetarian -";
                    }

                    /* Gluten Free info */
                    if($all_specials_record['GlutenFree'] == 'no') {
                    } else {
                        echo "- Gluten Free -";
                    }

                    /* Two paragraph breaks */
                    echo "<br> <br>";
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