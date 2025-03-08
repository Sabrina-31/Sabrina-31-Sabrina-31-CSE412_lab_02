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
        }
</style>
<title>Registration Page</title>

</head>

<body>
  <div class="navbar">
    <a href="login.html#login" style="font-size: 18px;margin-bottom: 15px;">Login</a>
    <a href="reg.html#registration" style="font-size: 18px;">Registration</a>
    <a href="updatepsw.html#update" style="font-size: 18px;">Update</a>
    <a href="retrieve.html#retrieve" style="font-size: 18px;">Retrieve</a>
    <a href="delete.html#delete" style="font-size: 18px;">Delete</a>
    <div class="dropdown">
      <button class="dropbtn">Portfolio Form</i></button>
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
$dottedPsw = str_repeat('*', strlen($password));
$conn = new mysqli('localhost', 'root', '', 'reg_form_portfolio');

if($conn->connect_error){
    die("Connection Failed : ".$conn->connect_error);
}

else{
    $stmt = $conn->prepare("insert into reg(ID, user_name, password)
    values(?, ?, ?)");
    $stmt->bind_param("iss", $ID, $user_name, $dottedPsw);
    $stmt->execute();
    echo "<div style='text-align: center; font-size:30px; margin-top:100px'><p>Registration successful.</p></div>";
    $stmt->close();
    $conn->close();
}
?>
<?php
$ID = $_POST['ID'];
$user_name = $_POST['user_name'];
$password = $_POST['password'];
$dottedPsw = str_repeat('*', strlen($password));
$conn = new mysqli('localhost', 'root', '', 'login_form_portfolio');

if($conn->connect_error){
    die("Connection Failed : ".$conn->connect_error);
}

else{
    $stmt = $conn->prepare("insert into login_form(ID, user_name, password)
    values(?, ?, ?)");
    $stmt->bind_param("sss", $ID, $user_name, $dottedPsw);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h2 style="text-align: center; margin-top:100px;">Access to the Portfolio Form <a href='P2.html#page2'><br>Go to the Portfolio Form.</br></a></h2>
</body>
</html>