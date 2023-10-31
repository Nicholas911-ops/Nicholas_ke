<?php

$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
$email = $_POST["email"];
$tel_no = $_POST["telno"];
$password = $_POST["password"];
$description = $_POST["description"];
$community_status = filter_input(INPUT_POST, "Status" ,FILTER_VALIDATE_INT);
$education_level = filter_input(INPUT_POST, "level" ,FILTER_VALIDATE_INT);
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_INT);

if (!$terms) {
    die("Terms and Conditions must be accepted!");
}

$host = "localhost";
$username = "root";
$Password = "";
$dbname = "contact_db";

$conn = mysqli_connect($host, $username, $Password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

$sql = "INSERT INTO applicant (firstname, lastname, email, tel_no, password, description, Status, level, terms)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssssssiii",
    $fname,
    $lname,
    $email,
    $tel_no,
    $password,
    $description,
    $community_status,
    $education_level,
    $terms
);

mysqli_stmt_execute($stmt);

echo "Record saved.";
?>
