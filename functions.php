<?php
function var_dumper(array $myArray)
{
    /* ** Fancy Var dump **
     * This function:
     *      1 receives an array
     *      3 outputs the html and data in an easy-to-read format
     *      4 kills the script from running
     *
     * @Pararm ARRAY - An array is passed in for formatting
     */

    //output formatted html
    print_r('<pre>');
    print_r($myArray);
    print_r('</pre>');
    //kill the script
    die();
}

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

function validateData(string $widgetName, string $widgetDescription, int $widgetSize, int $widgetRating): array
{
    /** ensures correct data-types and lengths recursively **/

    /*
     * This function:
     *      1 receives two strings and two integers
     *      2 creates an array for collecting all of the validated data
     *      3 checks that the name is less than or equal to 255
     *      4 adds the name to the array
     *      4 checks that the description is less than or equal to 255
     *      4 adds the description to the array
     *      5 checks that the size is between 0 and 9
     *      4 adds the size to the array
     *      6 checks that the rating is between 0 and 5
     *      4 adds the rating to the array
     *      8 returns an array of validated data
     *      9 bounces back to the input page with an error message if anything goes wrong at any stage of the checking
     *
     * @param STRING - the name of the widget
     *
     * @param STRING - the description of the widget
     *
     * @param STRING - the size of the widget
     *
     * @param STRING - the rating of the widget
     *
     * @returns ARRAY - the cleaned data
     */

    //set the location for bounce-backs
    $bounceTo = 'addWidget.php';

    //create an array for collecting the validated data
    $validData = [];

    //check if the name string is less than or equal to 255 characters long
    if (strlen($widgetName) <= 255) {//yes

        //add the name to the array
        $validData ['widgetName'] = $widgetName;
        //check if the description string is less than or equal to 255 characters long
        if (strlen($widgetDescription) <= 255) {//yes

            //add the key value pair to the array
            $validData ['widgetDescription'] = $widgetDescription;

            //check if the size integer is between 0 and 9
            if (($widgetSize >= 0) && ($widgetSize <= 9)) {//yes

                //add the key value pair to the array
                $validData ['widgetSize'] = $widgetSize;

                //check if the rating integer is between 0 and 5
                if ($widgetRating >= 0 && $widgetRating <= 5) {//yes

                    //add the key value pair to the array
                    $validData ['widgetRating'] = $widgetRating;

                } else {

                    //bounce back to input page with a message
                    header('Location: ' . $bounceTo . '?computerSays=Error: your widget\'s rating is not a number between 0 and 5. Please Try again.');

                }


            } else {

                //bounce back to input page with a message
                header('Location: ' . $bounceTo . '?computerSays=Error: your widget\'s size is not a number between 0 and 9. Please Try again.');

            }


        } else {

            //bounce back to input page with a message
            header('Location: ' . $bounceTo . '?computerSays=Error: your widget\'s description is larger than 255 characters long. Please Try again.');

        }


    } else {

        //bounce back to input page with a message
        header('Location: ' . $bounceTo . '?computerSays=Error: your widget\'s name is larger than 255 characters. Please Try again.');

    }

    //return validated data
    return $validData;

}

function cleanTheData(string $widgetName, string $widgetDescription, int $widgetSize, int $widgetRating): array
{
    /** removes specified escape characters recursively **/

    /*
     * This function:
     *      1 receives two strings and two integers
     *      2 creates an array for collecting all of the cleaned data
     *      3 checks that the name string is not empty
     *      4 removes escape characters
     *      5 adds the name to the array
     *      6 checks that the description string is not empty
     *      7 removes escape characters
     *      8 adds the description to the array
     *      9 checks that the size string is not empty
     *      10 removes escape characters
     *      11 adds the size to the array
     *      12 checks that the rating string is not empty
     *      14 removes escape characters
     *      15 adds the rating to the array
     *      16 returns the array of validated data
     *      17 bounces back to the input page with an error message if anything goes wrong at any stage of the checking
     *
     * @param STRING - the name of the widget
     *
     * @param STRING - the description of the widget
     *
     * @param INTEGER - the size of the widget
     *
     * @param INTEGER - the rating of the widget
     *
     * @returns ARRAY - the cleaned data
     */

    //create an array to put the checked data into
    $cleanedStrings = [];

    //create an array for the characters that we want to remove
    $charactersToBeRemoved = [':', '-', '/', '*', ')', '(', ','];

    //check that the name has been received
    if (isset($widgetName)) {//yes

        //remove any escape characters from the string
        $widgetName = str_replace($charactersToBeRemoved, '', $widgetName);

        //add the string to the array
        $cleanedStrings['$widgetName'] = $widgetName;

        //check that the description has been received
        if (isset($widgetDescription)) {//yes

            //remove any escape characters from the string
            $widgetDescription = str_replace($charactersToBeRemoved, '', $widgetDescription);

            //add the string to the array
            $cleanedStrings['widgetDescription'] = $widgetDescription;

            //check that the size has been received
            if (isset($widgetSize)) {//yes

                //remove any escape characters from the string
                $widgetSize = str_replace($charactersToBeRemoved, '', $widgetSize);

                //add the string to the array
                $cleanedStrings['widgetSize'] = $widgetSize;

                //check that the rating has been received
                if (isset($widgetRating)) {//yes

                    //add the string to the array
                    $cleanedStrings['widgetRating'] = $widgetRating;

                } else {//no

                    //bounce back to input page with a message
                    header('Location: addWidget.php?computerSays=missing rating');

                }

            } else {//no

                //bounce back to input page with a message
                header('Location: addWidget.php?computerSays=missing size');

            }

        } else {//no

            //bounce back to input page with a message
            header('Location: addWidget.php?computerSays=missing description');

        }

    } else {//no

        //bounce back to input page with a message
        header('Location: addWidget.php?computerSays=missing name');

    }

    //echo ($widgetName);die();
    $cleanedData = ['widgetName' => $cleanedStrings['$widgetName'], 'widgetDescription' => $cleanedStrings['widgetDescription'], 'widgetSize' => $cleanedStrings['widgetSize'], 'widgetRating' => $cleanedStrings['widgetRating']];

    //return the string
    return $cleanedData;
}

function addWidgetToTheDatabase(object $db, string $widgetName, string $widgetDescription, int $widgetSize, int $widgetRating)
{
    /** adds a widget to the database **/

    /*
    *  This function:
    *      1 receives and object, two strings and two integers
    *      3 prepares a query object
    *      4 binds all parameters
    *      5 executes the data insertion into the database
    *
    * @param OBJECT - Database connection object (the database keys)
    *
    * @param STRING - name of the widget
    *
    * @param STRING - description of the widget
    *
    * @param INTEGER - size of the widget
    *
    * @param INTEGER - rating of the widget
    */


    //prepare the query
    $query = $db->prepare("INSERT INTO `widgets` (`widgetName`, `widgetDescription`, `widgetSize` ,`widgetRating`) VALUES (:widgetName, :widgetDescription, :widgetSize, :widgetRating)");

    //bind the parameters
    $query->bindParam(':widgetName', $widgetName);
    $query->bindParam(':widgetDescription', $widgetDescription);
    $query->bindParam(':widgetSize', $widgetSize);
    $query->bindParam('widgetRating', $widgetRating);

    //run the query
    $query->execute();

    //go back to the index page with a success confirmation
    header('Location: index.php?computerSays=' . $widgetName . ' has been added to the database');


}