<?php

/* Connects to database */
$con = mysqli_connect("localhost", "joneski", 'spicysong14', "joneski_canteen");

/* Drinks Query */
/* Selects all information from products where product type is drink*/
/* Contains it in results */
$all_drinks_query = "SELECT *
                    FROM products
                    WHERE ProductType = 'drink' 
                    ORDER BY 'ProductID' ASC";
$all_drinks_result = mysqli_query($con, $all_drinks_query);

$drink_id = "SELECT ProductID FROM products WHERE ProductType = 'drink'";
$drink_id_results = mysqli_query($con, $drink_id);

/* Selects all information from products and available where the id is available*/
/* Contains it in results */
$available_drinks_query = "SELECT *
                          FROM products, available
                          WHERE ProductType = 'drink'
                          AND products.ProductID = available.ProductID";
$available_drinks_result = mysqli_query($con, $available_drinks_query);
$available_drinks_record = mysqli_fetch_assoc($available_drinks_result);

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
            <h1>
                Drinks
            </h1>
        </div>

        <!-- Opens PHP -->
        <?php

        /* Adds a new column called div_placement */
        $added= mysqli_query($con, "ALTER TABLE products ADD div_placement VARCHAR(10) NULL");

        /* Div number holder*/
        /* Count number of rows of drinks, store as a count,
           Divide this by three to find out the limit of rows for each div,
           Rounds it: */
        $count_rows = mysqli_num_rows($all_drinks_result);
        $limit = round($count_rows / 3);

        /* Takes the top and bottom limit info */
        $div_one_query = "SELECT *
                              FROM products
                              WHERE ProductType = 'drink' 
                              LIMIT $limit";
        $div_one_result = mysqli_query($con, $div_one_query);

        $div_two_query = "SELECT *
                              FROM products
                              WHERE ProductType = 'drink' 
                              ORDER BY ProductID DESC /* The product ID (numerals) descending*/
                              LIMIT $limit";
        $div_two_result = mysqli_query($con, $div_two_query);


        /* Updates the different parts of the table*/

        /* Updates products with the lower limit */
        $sql_update_one = "UPDATE products 
                               SET div_placement = 'div_one' 
                               WHERE ProductType = 'drink'
                               LIMIT $limit";

        /* Updates products with the higher limit */
        $sql_update_two = "UPDATE products 
                               SET div_placement = 'div_two' 
                               WHERE ProductType = 'drink'
                               ORDER BY ProductID DESC
                               LIMIT $limit";


        ?>

        <!--- Runs through all results as long as they are in the record --->
        <div class="drink-info-one">
            <p>
                <?php
                while($div_one_record = mysqli_fetch_assoc($div_one_result)) {
                    /* echo == prints out info */
                    /* e.g. SpecialsID from the record or a paragraph break etc. */
                    echo "<br>";
                    echo "<h2>" . $div_one_record['ProductName'] . "</h2>";
                    echo "<br><p> $" . $div_one_record['Price'];
                    echo "<br>Dietary info: <br>";

                    /* Checks whether the Dietary requirement is yes or no */
                    /* if no, skip, if yes print appropriate info */
                    /* Meat info */
                    if($div_one_record['Meat'] == 'no') {
                    } else {
                        echo "- Meat -";
                    }

                    /* Vegan info */
                    if($div_one_record['Vegan'] == 'no') {
                    } else {
                        echo "- Vegan -";
                    }

                    /* Vegetarian info */
                    if($div_one_record['Vegetarian'] == 'no') {
                    } else {
                        echo "- Vegetarian -";
                    }

                    /* Gluten Free info */
                    if($div_one_record['GlutenFree'] == 'no') {
                    } else {
                        echo "- Gluten Free -";
                    }

                    /* Available, checks if the info is in the available drinks record*/
                    if($div_one_record['ProductName'] == $available_drinks_record['ProductName']) {
                        echo "<br>";
                        echo "<b>- Available -</b>";
                    } else {
                        echo "<br>";
                        echo "<b>- Out of Stock -</b>";
                    }
                    echo "<br>";
                    echo "<br>";
                }
                ?>
            </p>
        </div>

        <!--- Runs through all results as long as they are in the record --->
        <div class="drink-info-three">
            <p>
                <?php
                while($div_two_record = mysqli_fetch_assoc($div_two_result)) {
                    /* echo == prints out info */
                    /* e.g. SpecialsID from the record or a paragraph break etc. */
                    echo "<br>";
                    echo "<h2>" . $div_two_record['ProductName'] . "</h2>";
                    echo "<br><p> $" . $div_two_record['Price'];
                    echo "<br>Dietary info: <br>";

                    /* Checks whether the Dietary requirement is yes or no */
                    /* if no, skip, if yes print appropriate info */
                    /* Meat info */
                    if($div_two_record['Meat'] == 'no') {
                    } else {
                        echo "- Meat -";
                    }

                    /* Vegan info */
                    if($div_two_record['Vegan'] == 'no') {
                    } else {
                        echo "- Vegan -";
                    }

                    /* Vegetarian info */
                    if($div_two_record['Vegetarian'] == 'no') {
                    } else {
                        echo "- Vegetarian -";
                    }

                    /* Gluten Free info */
                    if($div_two_record['GlutenFree'] == 'no') {
                    } else {
                        echo "- Gluten Free -";
                    }

                    /* Available, checks if the info is in the available drinks record*/
                    if($div_two_record['ProductName'] == $available_drinks_record['ProductName']) {
                        echo "<br>";
                        echo "<b>- Available -</b>";
                    } else {
                        echo "<br>";
                        echo "<b>- Out of Stock -</b>";
                    }
                    echo "<br>";
                    echo "<br>";
                }
                ?>
            </p>
        </div>

        <!--- Runs through all results as long as they are in the record --->
        <div class="drink-info-two">
            <p>
                <?php
                while($all_drinks_record = mysqli_fetch_assoc($all_drinks_result)) {
                    if(is_null($all_drinks_record['div_placement'])) {
                        echo "<br>";
                        echo "<h2>" . $all_drinks_record['ProductName'] . "</h2>";
                        echo "<br><p> $" . $all_drinks_record['Price'];
                        echo "<br>Dietary info: <br>";

                        /* Checks whether the Dietary requirement is yes or no */
                        /* if no, skip, if yes print appropriate info */
                        /* Meat info */
                        if ($all_drinks_record['Meat'] == 'no') {
                        } else {
                            echo "- Meat -";
                        }

                        /* Vegan info */
                        if ($all_drinks_record['Vegan'] == 'no') {
                        } else {
                            echo "- Vegan -";
                        }

                        /* Vegetarian info */
                        if ($all_drinks_record['Vegetarian'] == 'no') {
                        } else {
                            echo "- Vegetarian -";
                        }

                        /* Gluten Free info */
                        if ($all_drinks_record['GlutenFree'] == 'no') {
                        } else {
                            echo "- Gluten Free -";
                        }

                        /* Available, checks if the info is in the available drinks record*/
                        if ($all_drinks_record['ProductName'] == $available_drinks_record['ProductName']) {
                            echo "<br>";
                            echo "<b>- Available -</b>";
                        } else {
                            echo "<br>";
                            echo "<b>- Out of Stock -</b>";
                        }
                        echo "<br>";
                        echo "<br>";
                    }
                }

                ?>
            </p>
        </div>

        <div class="footer">
        </div>

    </div>

</html>