<?php
//create a session or resume the current one
session_start();

// load the functions
require 'functions.php';

// get the keys to the database
$db = getDbKey('seanCollection');

//check to see if there is a message in the GET
$computerSays = report();

// get the data from the database
$results = getDataFromDb($db, "SELECT `widgetName`, `widgetDescription`, `widgetSize`, `widgetRating` FROM `widgets`");

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
<header>
    <?php
    //show successful insert message
    echo $computerSays . '<br />';
    ?>
    <a href="addWidget.php">
        add a new widget
    </a>
    <hr/>
</header>
<main>
    <section>
        <h1>My Widgets collection</h1>
        <div class="innerSection">
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
        <?php
        //present the results html
        extractDataIntoHtml($results);
        ?>
    </section>
</main>
</body>
<html>
