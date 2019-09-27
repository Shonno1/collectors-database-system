<?php
function checkThePost(): array
{
    /** checks the post and returns the data **/

    /*
    * this function:
    *      1 checks that all the post data has been received
    *      2 extracts the post data
    *      3 returns all of the data in an associative array
    *
    * note: returns an empty array if any of the expected post data is not received
    *
    * @returns - ASSOCIATIVE ARRAY - containing either all of the expected data or nothing at all
    */

    //check that if any data has been sent
    if (isset($_POST['widgetName']) && isset($_POST['widgetDescription']) && isset($_POST['widgetSize']) && isset($_POST['widgetRating'])) {//yes

        //extract the post data
        $widgetName = $_POST['widgetName'];
        $widgetDescription = $_POST['widgetDescription'];
        $widgetSize = $_POST['widgetSize'];
        $widgetRating = $_POST['widgetRating'];

        //return all of the data in an associative array
        return ['widgetName' => $widgetName, 'widgetDescription' => $widgetDescription, 'widgetSize' => $widgetSize, 'widgetRating' => $widgetRating];
    } else {

        //return an empty array
        return [];
    }
}

function report(): string
{
    /** outputs any messages received in the get data **/

    /*
    * this function:
    *      1 checks if there's a message in the header
    *      2 returns the message in a string
    *      3 returns and empty message in string if there is no message
    *
    * @returns - STRING - a string containing a message
    */

    //check if there's a message in the header
    if (isset($_GET['computerSays'])) {//yes

        //return the message in a string
        return $_GET['computerSays'];

    } else {//no

        //return with nothing to say
        return "";

    }

}

function getDbKey(): object
{
    /** supplies a key to the database **/

    /*
     * this function:
     *      1 instantiates a new database connection object (PDO)
     *      2 sets the default return mode to associative array
     *      3 returns a database connection object (PDO)
     *
     * @Returns OBJECT - returns the connection PDO
     */

    //instantiates database connection object (PDO)
    $db = new PDO ('mysql:host=db; dbname=seanCollection', 'root', 'password');

    //set default the return mode to associative array
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //return database connection object (PDO)
    return $db;
}

function getDataFromDb(object $db, $sql): array
{
    /** gets some specific data from the database **/

    /*
    * This function:
    *      1 receives the connection PDO object and the sql select query string
    *      2 passes the sql string to the prepare method to instantiate a new database query object
    *      3 runs the execute method in the query object
    *      5 calls the fetchAll method in the query object
    *      6 returns the results in an array
    *
    * @param OBJECT - receives pre-instantiated connection PDO, required to connect to the database
     *
    * @param - STRING - receives sql statement that this function will perform
    *
    * @Returns ARRAY - returns the data from the query in an array
    */

    //prepare query by passing the sql string to the prepare method, thus instantiating a new query object
    $query = $db->prepare($sql);

    //run the execute method in the query object
    $query->execute();

    //call the fetchAll method in the query object and store the results in an array
    $results = $query->fetchAll();

    //return the results in an array
    return $results;
}

function extractDataIntoHtml($results)
{
    /** put query results into some html(specific) **/

    /*
     * This function:
     *      1 receives a set of results in an array
     *      2 creates a html container for the results to appear in
     *      3 adds html to each result
     *      4 echoes out each set of results in html
     *
     * @param - ARRAY - receives an array containing the results from a database query
     */

    // iterate the data
    foreach ($results as $row) {

        // pass each iteration as a new row and add some html
        echo '<div class="dataRow">';
        echo '<div class="dataCol"><h3>' . $row['widgetName'] . '</h3></div>';
        echo '<div class="dataCol"><p>' . $row['widgetDescription'] . '</p></div>';
        echo '<div class="dataCol"><p>' . $row['widgetSize'] . '</p></div>';
        echo '<div class="dataCol"><p>' . $row['widgetRating'] . '</p></div>';
        echo '</div>';

    }

}