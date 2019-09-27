<?php
// functions
function previewArray(array $myArray)
{
    /* ** Fancy Var dump **

     * This function:
     *      1 receives an array
     *      2 adds a formatting
     *      3 echoes out the data from the array in an easy-to-read format
     *
     * @Pararm ARRAY - An array is passed in for formatting
     */

    print_r('<pre>');
    print_r($myArray);
    print_r('</pre>');
}

function connectToDb()
{
    /* ** Connect to a database **

     * This function:
     *      1 creates a new Php Data Object (PDO)
     *      2 forces all database queries to return the data as an Associative Array
     *      3 returns a connection object
     *
     * @Returns OBJECT returns the connection PDO
     */

    // connect to database
    $db = new PDO ('mysql:host=db; dbname=seanCollection', 'root', 'password');
    // set default return mode to ASSOC_ARRAY
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // return the connection object
    return $db;
}

function getDataFromDb(object $db, $sql): array
{
    /* ** get some specific data from the database **

     * This function:
     *      1 receives the connection PDO and the query
     *      2 prepares query by adding the connection PDO data to a string
            3 runs the query on the database
            4 retrieves the data array from the database
            5 returns the data array
     *
     * @Param OBJECT - pre-instantiated connection PDO, required to connect to the database
     *
     * @Param
     *
     * @Returns ARRAY - returns the data from the query in an array
     */

    // prepare query by adding the connection PDO
    $query = $db->prepare($sql);
    // run the query on the database
    $query->execute();
    // retrieve the data array from the database
    $results = $query->fetchAll(); //retrieves data

    return $results;
}

// get the keys to the database
$db = connectToDb();

// create a qury to get all of the collection data from the database
$sql = "SELECT `widgetName`, `widgetDescription`, `widgetSize`, `widgetRating` FROM `widgets`";

// get the data from the database
$results = getDataFromDb($db, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/reset.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <title>My collection (database) viewer</title>
</head>
<body>
<main>
    <section>
        <!-- first row -->
        <h1>My Widgets collection</h1>
        <div class="innerSection">
            <!-- first row -->
            <div class="headingsRow">
                <div class="heading">
                    <h2>
                        Name
                    </h2>
                </div>
                <div class="heading">
                    <h2>
                        Description
                    </h2>
                </div>
                <div class="heading">
                    <h2>
                        Size
                    </h2>
                </div>
                <div class="heading">
                    <h2>
                        Rating
                    </h2>
                </div>
            </div>
        </div>

        <!-- all other rows -->
        <?php

        // iterate the data
        foreach ($results as $row) {

            // pass each iteration as a new row
            echo '<div class="dataRow">';
            echo '<div class="dataCol"><h3>' . $row['widgetName'] . '</h3></div>';
            echo '<div class="dataCol"><p>' . $row['widgetDescription'] . '</p></div>';
            echo '<div class="dataCol"><p>' . $row['widgetSize'] . '</p></div>';
            echo '<div class="dataCol"><p>' . $row['widgetRating'] . '</p></div>';
            echo '</div>';

        }

        ?>

    </section>
</main>
</body>
<html>