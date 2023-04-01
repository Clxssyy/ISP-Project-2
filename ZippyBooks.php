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
    <div class="header">
        <h1>ZippyBooks</h1>
    </div>
    <div class="bookstore">
        <br>
        <h2>List of Books</h2>
        <br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Flag (Discontinued)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "isp";

                $connection = new mysqli($servername, $username, $password, $database);

                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM books";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[title]</td>
                        <td>$row[price]</td>
                        <td>$row[quantity]</td>
                        <td>$row[flag]</td>
                        <td>
                            <a href='/isp/pa2/edit.php?id=$row[id]' class='btn'>Edit</a>
                            <a href='/isp/pa2/delete.php?id=$row[id]' class='btn'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="/isp/pa2/create.php" class="btn">Add Book</a>
        <br><br>
    </div>
</body>
</html>