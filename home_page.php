<?php

/* Connects to database */
$con = mysqli_connect("localhost", "joneski", 'spicysong14', "joneski_canteen");

/* Specials Query
   Selects all information from products and weekly specials
   Where product id's from each table are equal to each other
   Contains it in results */
$all_specials_query = "SELECT *
                       FROM products, weeklyspecials
                       WHERE products.ProductID = weeklyspecials.ProductID";
$all_specials_result = mysqli_query($con, $all_specials_query);
?>

<!DOCTYPE html>
<!-- Sets language as English-->
<html lang="en">
    <head>
        <!-- Sets utf-8 as chr
             Links CSS page
             Creates title (what shows in the browser bar)-->
        <meta charset="utf-8"/>
        <link href="style.css" rel="stylesheet" type="text/css">
        <title>WGC Canteen - Kimberli Jones</title>
    </head>

    <!-- class that is linked to full grid in css -->
    <div class="grid-container">

        <!-- Header class, linked to grid -->
        <div class="header">
            <div class="header">
                <!-- Creates an image link to home page, adds alternate info, sets height and width -->
                <a href="home_page.php">
                    <img src="wgc_logo.png" alt="Wellington Girl's College Logo" height=120px width=120px>
                </a>
            </div>
        </div>

        <!-- Navigation class, linked to grid -->
        <div class="navigation">
            <!-- links the navigation buttons to different pages of the website
                 links to class "one" for first link type -->
            <a class="one" href="home_page.php">Home</a>
            <a class="one" href="menu.php">Menu</a>
            <a class="one" href="diets.php">Diets</a>
            <a class="one" href="drinks.php">Drinks</a>
        </div>

        <!-- "page name" class, linked to grid -->
        <div class="page-name">
            <h1> WGC Canteen </h1>
        </div>

        <!-- "menu block" class, linked to grid -->
        <div class="menu-block">
            <h2> Menus </h2>
            <p> Click to go to a different menu <br></p>

            <!-- links to class "two" for first link type -->
            <a class="two" href="menu.php">Meals</a>
            <a class="two" href="diets.php">Diets</a>
            <a class="two" href="drinks.php">Drinks</a>

        </div>

        <!-- Specials class, linked to grid -->
        <div class="specials-block">
            <h3> <br>This Weeks Specials:</h3>

            <!-- Opens PHP -->
            <?php

            /* Runs through all results as long as they are in the record */
            while($all_specials_record = mysqli_fetch_assoc($all_specials_result)){

                /* echo " " == prints out info, text tags inside determine text size
                   echo $blah_record['blah'] gets the blah column info from the blah record
                   e.g. SpecialsID from the record or a paragraph break etc. */

                echo "<h2><br>" . $all_specials_record['SpecialsID'] . " Special";
                echo ":</h2><br><br><p><b>" . $all_specials_record['ProductName'] . "</b>";
                echo " $" . $all_specials_record['DiscountedPrice'];
                echo "<br>Dietary info: ";

                /* Checks whether the Requirement equals yes or no
                   if no, skip, if yes print appropriate info
                   Meat info */
                if($all_specials_record['Meat'] == 'yes') {
                    echo "- Meat -";
                }

                /* Vegan info */
                if($all_specials_record['Vegan'] == 'yes') {
                    echo "- Vegan -";
                }

                /* Vegetarian info */
                if($all_specials_record['Vegetarian'] == 'yes') {
                    echo "- Vegetarian -";
                }


                /* Gluten Free info */
                if($all_specials_record['GlutenFree'] == 'no') {
                    echo "- Gluten Free -";
                }

                /* Checks if available is yes
                   If yes echo available
                   if no echo out of stock*/
                echo "<br>";
                if($all_specials_record['available'] == 'yes') {
                    echo "<b>- Available -</b>";
                } else{
                    echo "<b>- Out of Stock -</b>";
                }

                /* Two paragraph breaks and end of <p> tag*/
                echo "<br> <br></p>";
            }
            ?>
        </div>

        <!-- Footer class -->
        <div class="footer">
        </div>

    </div>

</html>