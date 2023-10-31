<?php

$Name = $_POST["Name"];
$Email = $_POST["Email"];
$Querry = $_POST["Querry"];

// establish a db connection
/* $host = "3307";
$username = "root";
$Password = "nicholas011"; // This should be the password for your database
$dbname = "nicholas";*/

// Create a database connection
$conn = mysqli_connect($host, $username, $Password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

$sql = "INSERT INTO message (Name, Email, Querry) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sss", $Name, $Email, $Querry);

if (mysqli_stmt_execute($stmt)) {
    echo "Record saved.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
