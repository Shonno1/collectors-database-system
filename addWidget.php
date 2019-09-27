<?php

// load the functions
require 'functions.php';

//check to see if there is a message in the GET
$computerSays = report();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/reset.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <title>
        My collection (database) viewer
    </title>
</head>
<body>
<header>
    <?php
    //show successful insert message
    echo $computerSays . '<br />';
    ?>
    <a href="index.php">
        view widgets
        <hr/>
    </a>
</header>
<main>
    <section>
        <h1>
            Add a new item
        </h1>
        <div class="innerSection">
            <form action="insert.php" method="post" id="addNewWidget">
                <label>
                    Name:
                    <span class="requiredStars">
                        *
                    </span>
                    <input name="widgetName" type="text" placeholder="Name" class="nameBox" maxlength="255" required/>
                </label>
                <label>
                    <span class="requiredStars">
                        *
                    </span>
                    Description:
                    <input name="widgetDescription" type="textarea" placeholder="Description" class="descriptionBox"
                           maxlength="255" required/>
                </label>
                <label>
                    <span class="requiredStars">
                        *
                    </span>
                    Size:
                    <select name="widgetSize" required>
                        <option value="0" selected>
                            0
                        <option value="1">
                            1
                        </option>
                        <option value="2">
                            2
                        </option>
                        <option value="3">
                            3
                        </option>
                        <option value="4">
                            4
                        </option>
                        <option value="4">
                            5
                        </option>
                    </select>
                </label>
                <br/>
                <label>
                    <span class="requiredStars">
                        *
                    </span>
                    Rating:
                    <select name="widgetRating" required>
                        <option value="0" selected>
                            0
                        </option>
                        <option value="1">
                            1
                        </option>
                        <option value="2">
                            2
                        </option>
                        <option value="3">
                            3
                        </option>
                        <option value="4">
                            4
                        </option>
                        <option value="5">
                            5
                        </option>
                        <option value="6">
                            6
                        </option>
                        <option value="7">
                            7
                        </option>
                        <option value="8">
                            8
                        </option>
                        <option value="9">
                            9
                        </option>
                    </select>
                </label>
                <br/>
                <input type="submit" value="Add item to the collection"/>
            </form>
        </div>
    </section>
</main>
</body>
<html>