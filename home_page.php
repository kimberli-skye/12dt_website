<?php
$con = mysqli_connect("localhost", "joneski", 'spicysong14', "joneski_canteen");

/* Specials Query */
/* Selects specials id, name, price and dietary info from products and specials */
$all_specials_query = "SELECT *
                       FROM products, weeklyspecials
                       WHERE products.ProductID = weeklyspecials.ProductID";
$all_specials_result = mysqli_query($con, $all_specials_query);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Name of website in browser, as to keep track  -->
        <meta charset="utf-8"/>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>

    <!-- class that is linked to grid in css -->
    <div class="grid-container">
        <div class="header">

        </div>

        <!-- links the navigation buttons to different pages of the website -->
        <!-- links to class "one" for first link type -->
        <div class="navigation">
            <a class="one" href="home_page.php">Home</a>
            <a class="one" href="menu.php">Menu</a>
            <a class="one" href="diets.php">Diets</a>
            <a class="one" href="drinks.php">Drinks</a>
    </div>

    <div class="page-name">

    </div>

    <div class="menu-block">

    </div>

    <div class="specials-block">
        <p>
            <?php
            while($all_specials_record = mysqli_fetch_assoc($all_specials_result)){
                echo " " . $all_specials_record['SpecialsID'];
                echo ":<br>";
                echo $all_specials_record['ProductName'];
                echo " $" . $all_specials_record['DiscountedPrice'];
                echo "<br>Dietary info: ";

                /* Checks whether the Dietary requirement is yes or no, if yes, print appropriate info*/
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

                echo "<br> <br>";
                echo "<br> <br>";
            }
            ?>
        </p>
    </div>
</div>

</html>