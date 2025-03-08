<?php
$conn = new mysqli('localhost', 'root', '', 'portfolio_form');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$recordUpdated = false;

if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    $result = $conn->query("SELECT * FROM form_portfolio WHERE ID=$ID");
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'];
    $Full_Name = $_POST['Full_Name'];
    $contact_info = $_POST['contact_info'];
    $biography = $_POST['biography'];
    $soft_skills = $_POST['soft_skills'];
    $technical_skills = $_POST['technical_skills'];

    $sql = "UPDATE form_portfolio SET 
                Full_Name='$Full_Name', 
                contact_info='$contact_info', 
                biography='$biography', 
                soft_skills='$soft_skills', 
                technical_skills='$technical_skills' 
            WHERE ID=$ID";

    if ($conn->query($sql) === TRUE) {
        $recordUpdated = true;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Portfolio</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmFIB46ZmdtAc9eNBH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2);
        }

        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .success-message {
            color: green;
            font-size: 20px;
            font-weight: bold;
        }

        .back-button {
            background-color: #04AA6D;
            color: white;
            padding: 10px 20px;
            border: none;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            cursor: pointer;
        }

        .back-button:hover {
            opacity: 0.8;
        }

        /* Navbar styles */
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
    </style>
</head>

<body>

    <div class="navbar">
        <a href="login.html#login">Login</a>
        <a href="reg.html#registration">Registration</a>
        <a href="updatepsw.html#update">Update</a>
        <a href="retrieve.html#retrieve">Retrieve</a>
        <a href="delete.html#delete">Delete</a>
        <div class="dropdown">
            <button class="dropbtn">Portfolio Form <i class="fa fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="P2.html#page2">Portfolio Form</a>
                <a href="PortfolioUpdate.html#PortfolioUpdate">Update Portfolio</a>
                <a href="PortfolioDelete.html#PortfolioDelete">Delete Portfolio</a>
            </div>
        </div>
    </div>

    <?php if ($recordUpdated): ?>
        <div class="container">
            <p class="success-message">Record updated successfully!</p>
            <a class="back-button" href="login.html">Back to Login</a>
        </div>
    <?php else: ?>
        <h2>Edit Portfolio</h2>
        <div class="container">
            <form method="POST">
                <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                <label>Full Name:</label>
                <input type="text" name="Full_Name" value="<?php echo $row['Full_Name']; ?>" required><br>
                <label>Contact Info:</label>
                <input type="text" name="contact_info" value="<?php echo $row['contact_info']; ?>" required><br>
                <label>Biography:</label>
                <input type="text" name="biography" value="<?php echo $row['biography']; ?>" required><br>
                <label>Soft Skills:</label>
                <input type="text" name="soft_skills" value="<?php echo $row['soft_skills']; ?>" required><br>
                <label>Technical Skills:</label>
                <input type="text" name="technical_skills" value="<?php echo $row['technical_skills']; ?>" required><br>
                <input type="submit" value="Update">
            </form>
        </div>
    <?php endif; ?>

</body>
</html>
