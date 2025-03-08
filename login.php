<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

    .navbar a:hover,
    .dropdown:hover .dropbtn {
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
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
    }

    form {
      border: 3px solid #f1f1f1;
    }

    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      background-color: #04AA6D;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      opacity: 0.8;
    }

    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }

    .container {
      width: 600px;
      padding: 50px;
      margin-left: 450px;
    }

    span.psw {
      float: right;
      padding-top: 16px;
    }

    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }

      .cancelbtn {
        width: 100%;
      }
    }
  </style>
    <title>Login Page</title>
</head>

<body>
  <div class="navbar">
    <a href="login.html#login" style="font-size: 18px;margin-bottom: 15px;">Login</a>
    <a href="reg.html#registration" style="font-size: 18px;">Registration</a>
    <a href="updatepsw.html#update" style="font-size: 18px;">Update</a>
    <a href="retrieve.html#retrieve" style="font-size: 18px;">Retrieve</a>
    <a href="delete.html#delete" style="font-size: 18px;">Delete</a>
    <div class="dropdown">
      <button class="dropbtn">Portfolio Form</button>
      <div class="dropdown-content">
        <a href="P2.html#page2">Portfolio Form</a>
        <a href="PortfolioUpdate.html#PortfolioUpdate">Update Portfolio</a>
        <a href="PortfolioDelete.html#PortfolioDelete">Delete Portfolio</a>
      </div>
    </div>
  </div>
  </body>
  </html>
<?php
$ID = $_POST['ID'];
$user_name = $_POST['user_name'];
$password = $_POST['password'];
//$new_password = $_POST['new_password'];
$dottedPsw = str_repeat('*', strlen($password));
$conn = new mysqli('localhost', 'root', '', 'login_form_portfolio');

if($conn->connect_error){
    die("Connection Failed : ".$conn->connect_error);
}
// Check if ID exists
$checkQuery = "SELECT * FROM login_form WHERE ID = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("s", $ID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // If ID exists, allow login
  echo "<div style='text-align: center; font-size:30px;margin-top:100px'>
          <p>Login successful.</p>
          <h2 style='text-align: center; margin-top:100px;'>Access to the Portfolio Form 
          <a href='P2.html#page2'><br>Go to the Portfolio Form.</br></a></h2>
        </div>";
} else {
  // If ID does not exist, show registration message
  echo "<div style='text-align: center; font-size:30px;margin-top:100px'>
          <p>Login Unsuccessful. Register First.</p>
          <p>Don't have an account? <a href='reg.html'>Register here</a></p>
        </div>";
}

$conn->close();
?>
