<?php

// This file contains functions for database connection and query execution

// Array of table names used in the database
$tables = array("db_book", "db_customer", "db_order_detail", "db_order", "db_shipper", "db_subject", "db_supplier");

// Function to establish a connection to the database
function getDatabaseConnection() {
    $dbhost = "sysmysql8.auburn.edu";
    $dbuser = "dag0047";
    $dbpass = "ForzaHorizon123!";
    $dbname = "dag0047db";

    // Create connection
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $connection;
}

// Function to run a query on the database
function runQuery($connection, $query) {
    return mysqli_query($connection, $query);
}

// Function to count the number of affected rows
function countRows($connection) {
    return mysqli_affected_rows($connection);
}

// Function to get the error description for the most recent MySQL operation
function getError($connection) {
    return mysqli_error($connection);
}

?>