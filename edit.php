<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "isp";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$title = "";
$price = "";
$quantity = "";
$flag = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["id"])) {
        header("location: /isp/pa2/ZippyBooks.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM books WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /isp/pa2/ZippyBooks.php");
        exit;
    }

    $title = $row["title"];
    $price = $row["price"];
    $quantity = $row["quantity"];
    $flag = $row["flag"];
}
else {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $flag = $_POST["flag"];

    do {
        if (empty($title) || empty($price) || empty($quantity) || empty($flag)) {
            $errorMessage = "All fields are required";
            break;
        }

        $sql = "UPDATE books SET title = '$title', price = '$price', quantity = '$quantity', flag = '$flag' WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Book updated successfully";

        header("location: /isp/pa2/ZippyBooks.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZippyBooks</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="bookstore">
        <div class="header">
            <h2>Edit Book</h2>
        </div>
        
        <?php
        if (!empty($errorMessage)) {
            echo "<p>$errorMessage</p>";
        }
        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div>
                <label>Title</label>
                <div>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </div>
            </div>
            <div>
                <label>Price</label>
                <div>
                    <input type="text" name="price" value="<?php echo $price; ?>">
                </div>
            </div>
            <div>
                <label>Quantity</label>
                <div>
                    <input type="text" name="quantity" value="<?php echo $quantity; ?>">
                </div>
            </div>
            <div>
                <label>Flag</label>
                <div>
                    <input type="text" name="flag" value="<?php echo $flag; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "<p>$successMessage</p>";
            }
            ?>

            <br>
            <div>
                <div>
                    <button type="submit" class="btn">Update Book</button>
                    <a href="/isp/pa2/ZippyBooks.php" class="btn">Cancel</a>
                </div>
            </div>
            <br>
        </form>
    </div>
</body>
</html>