<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "isp";

$connection = new mysqli($servername, $username, $password, $database);

$title = "";
$price = "";
$quantity = "";
$flag = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST["title"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $flag = $_POST["flag"];

    do {
        if (empty($title) || empty($price) || empty($quantity) || empty($flag)) {
            $errorMessage = "All fields are required";
            break;
        }

        $sql = "INSERT INTO books (title, price, quantity, flag)" . "VALUES ('$title', '$price', '$quantity', '$flag')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $title = "";
        $price = "";
        $quantity = "";
        $flag = "";

        $successMessage = "Book added successfully";

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
            <h2>Add a Book</h2>
        </div>

        <?php
        if (!empty($errorMessage)) {
            echo "<p>$errorMessage</p>";
        }
        ?>

        <form method="post">
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
                <label>Flag (Discontinued)</label>
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
                    <button type="submit" class="btn">Add Book</button>
                    <a href="/isp/pa2/ZippyBooks.php" class="btn">Cancel</a>
                </div>
            </div>
            <br>
        </form>
    </div>
</body>
</html>