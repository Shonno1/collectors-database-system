<?php
function connectDb () {
    /*
     * Opens a connection to the database
     *
     * @Return STRING - Connection String
     */
    // connect to database
    $db = new PDO ('mysql:host=db; dbname=seanCollection','root','password');
    // set default return mode to ASSOC_ARRAY
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // return the connection variable
    return $db;
}
