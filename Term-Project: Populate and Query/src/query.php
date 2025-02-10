<?php

// This file is responsible for running SQL queries on the database

require 'db.php';

// Checking if form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = $_POST["sql"];

    // Remove any backslashes added to the input
    $sql = stripslashes($sql);

    // Prevent DROP statements
    if (stripos($sql, 'DROP') !== false) {
        echo "<p>Error: DROP statements are not allowed.</p>";
    } else {
        // Establish connection to the database
        $connection = getDatabaseConnection();

        // Run the query
        if ($result = runQuery($connection, $sql)) {
            // Check if the query is a SELECT statement
            if (stripos($sql, 'SELECT') === 0) {
                // Count the number of rows retrieved
                $num_rows = mysqli_num_rows($result);
                echo "<p>Number of rows retrieved: $num_rows</p>";

                // Print the result as a table
                echo "<table border='1'><tr>";
                // Print column headers
                while ($field = mysqli_fetch_field($result)) {
                    echo "<th>{$field->name}</th>";
                }
                echo "</tr>";
                // Print rows
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>{$cell}</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
                mysqli_free_result($result);
            } else {
                // Handle CREATE, DELETE, UPDATE, INSERT statements
                if (stripos($sql, 'CREATE') === 0) {
                    echo "<p>Table Created/Updated</p>";
                } elseif (stripos($sql, 'DELETE') === 0) {
                    $affected_rows = mysqli_affected_rows($connection);
                    echo "<p>Row(s) Deleted: $affected_rows</p>";
                } elseif (stripos($sql, 'UPDATE') === 0) {
                    $affected_rows = mysqli_affected_rows($connection);
                    echo "<p>Row(s) Updated: $affected_rows</p>";
                } elseif (stripos($sql, 'INSERT') === 0) {
                    echo "<p>Row Inserted</p>";
                } else {
                    echo "<p>Query executed successfully.</p>";
                }
            }
        } else {
            // Error handling
            echo "<p>Error: " . getError($connection) . "</p>";
            echo '<button onclick="window.history.back();">Try Again</button>';
        }

        // Close the connection
        mysqli_close($connection);
    }

    // Add a Go Back button
    echo '<button onclick="window.location.href=\'index.php\';">Go Back</button>';
}
?>