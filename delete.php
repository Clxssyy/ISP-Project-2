<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "isp";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM books WHERE id=$id";
    $connection->query($sql);
}

header("location: /isp/pa2/ZippyBooks.php");
exit;
?>