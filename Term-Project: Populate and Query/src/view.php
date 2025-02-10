<?php
require 'db.php';

$connection = getDatabaseConnection();

$tables = array("db_book", "db_customer", "db_order_detail", "db_order", "db_shipper", "db_subject", "db_supplier");

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>View Database Contents</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>View Database Contents</h1>";

foreach ($tables as $table) {
    echo "<h2>Table: $table</h2>";
    $result = runQuery($connection, "SELECT * FROM $table");

    if ($result) {
        echo "<table>";
        echo "<tr>";
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
        echo "<p>Error: " . getError($connection) . "</p>";
    }
}
echo '<button onclick="window.history.back();">Go Back</button>';
mysqli_close($connection);

echo "</body>
</html>";
?>