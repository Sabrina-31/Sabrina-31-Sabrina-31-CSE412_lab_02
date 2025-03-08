<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'portfolio_form');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // Initialize message variable

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the ID from the form and trim spaces
    $ID = trim($_POST['ID']);

    // Check if ID is empty
    if (empty($ID)) {
        $message = "Error: ID field is required.";
    } else {
        // Verify if ID exists in the database before deleting
        $checkQuery = "SELECT * FROM form_portfolio WHERE ID = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("s", $ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $message = "Error: No record found with ID [$ID].";
        } else {
            // Prepare DELETE statement
            $deleteQuery = "DELETE FROM form_portfolio WHERE ID = ?";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bind_param("s", $ID);

            // Execute DELETE query
            if ($stmt->execute()) {
                $message = "Record with ID [$ID] deleted successfully!";
            } else {
                $message = "Error deleting record: " . $stmt->error;
            }
        }

        // Close statement
        $stmt->close();
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Record</title>
    <style>
        .navbar {
            overflow: hidden;
            background-color: #333;
        }

        .navbar a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .dropdown {
            float: left;
            overflow: hidden;
        }

        .dropdown .dropbtn {
            font-size: 18px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .navbar a:hover, .dropdown:hover .dropbtn {
            background-color: red;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            float: none;
            color: rgb(5, 7, 23);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #83dff4;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: lavender;
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"] {
            width: calc(100% - 5px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 0 auto;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            font-weight: bold;
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="login.html#login" style="font-size: 18px;">Login</a>
        <a href="reg.html#registration" style="font-size: 18px;">Registration</a>
        <a href="updatepsw.html#update" style="font-size: 18px;">Update</a>
        <a href="retrieve.html#retrieve" style="font-size: 18px;">Retrieve</a>
        <a href="delete.php" style="font-size: 18px;">Delete</a>
        <div class="dropdown">
            <button class="dropbtn">Portfolio Form <i class="fa fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="P2.html#page2">Portfolio Form</a>
                <a href="PortfolioUpdate.html#PortfolioUpdate">Update Portfolio</a>
                <a href="PortfolioDelete.html#PortfolioDelete">Delete Portfolio</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Delete Record</h2>
        <form action="delete.php" method="POST">
            <label for="ID">Enter ID to Delete</label>
            <input type="text" id="ID" name="ID" required>
            <input type="submit" value="Delete">
        </form>

        <?php if (!empty($message)) { ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } ?>
    </div>

</body>
</html>
