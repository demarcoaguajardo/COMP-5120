<?php

// This file is responsible for establishing a connection to the database and running queries

require 'db.php';
$connected = getDatabaseConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Page title -->
    <meta charset="UTF-8">
    <title>Term Project -- Demarco Guajardo</title>
</head>

<body>
    <!-- Page title and SQL form --> 
    <h1>Bookstore Database Interface -- Demarco Guajardo</h1>

    <!-- Button to view tables -->
    <h2>View Tables</h2>
    <button onclick="location.href='view.php';">View Tables</button>

    <!-- Form to enter SQL statements -->
    <h2>Enter SQL Statement</h2>
    <form method="post" action="query.php">
        <label for="sql">Enter SQL Statement:</label><br>
        <textarea id="sql" name="sql" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>