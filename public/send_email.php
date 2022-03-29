<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "magaghat-one-page";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO emails (email) VALUES ('" . $_POST['email'] . "')";

    $conn->exec($sql);
    header("Location: http://magaghat.loc?success=1");
    die();
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
