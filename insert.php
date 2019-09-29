<?php

//load functions
require 'functions.php';

//collect the post data
$postData = checkThePost();

//validate the data
$validData = validateData($postData['widgetName'], $postData['widgetDescription'], $postData['widgetSize'], $postData['widgetRating']);

//clean the data
$cleanData = cleanTheData($validData['widgetName'], $validData['widgetDescription'], $validData['widgetSize'], $validData['widgetRating']);

// get the keys to the database
$db = getDbKey('seanCollection');

//add new widget into database
addWidgetToTheDatabase($db, $cleanData['widgetName'], $cleanData['widgetDescription'], $cleanData['widgetSize'], $cleanData['widgetRating']);