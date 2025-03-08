
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
      <title>Portfolio Form</title>

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
$Full_Name = $_POST['Full_Name'];
$contact_info = $_POST['contact_info'];
$biography = $_POST['biography'];
$soft_skills = $_POST['soft_skills'];
$technical_skills = $_POST['technical_skills'];
$institute = $_POST['institute'];
$degree = $_POST['degree'];
$year = $_POST['year'];
$grade = $_POST['grade'];
$company_name = $_POST['company_name'];
$job_duration = $_POST['job_duration'];
$job_responsibility = $_POST['job_responsibility'];
$previous_project = $_POST['previous_project'];
$previous_publication = $_POST['previous_publication'];

/*$Type = $_POST['Type'];
$f_Category = $_POST['f_Category'];
$rating = $_POST['rating'];
$date = $_POST['date'];
$loc = $_POST['loc'];
$followUp = $_POST['followUp'];
$permission = $_POST['permission'];
$attachment = $_POST['attachment'];
$dept = $_POST['dept'];
$urgency = $_POST['urgency'];
$anony_Feed = $_POST['anony_Feed'];
$pref_Resolution = $_POST['pref_Resolution'];
$howHeard = $_POST['howHeard'];*/

$photoPath = "";
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create folder if it doesn't exist
        }
        $photoPath = $targetDir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photoPath);
    }
$conn = new mysqli('localhost', 'root', '', 'portfolio_form');

if($conn->connect_error){
    die("Connection Failed : ".$conn->connect_error);
}

else{
    $stmt = $conn->prepare("insert into form_portfolio(ID, Full_Name, contact_info, biography, photo, soft_skills, technical_skills, institute, degree, year, grade, company_name, job_duration, job_responsibility, previous_project, previous_publication)
    values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssssssssss", $ID, $Full_Name, $contact_info, $biography, $photoPath, $soft_skills, $technical_skills, $institute, $degree, $year, $grade, $company_name, $job_duration, $job_responsibility, $previous_project, $previous_publication);
    $stmt->execute();
    echo "<div style='text-align: center; font-size:30px; margin-top:100px;'>
    <p>Submission Successful.</p>
    <button style='display: inline-block; margin-top: 20px; padding: 10px 20px; font-size: 18px; background-color: rgb(255, 0, 43); color: white; border: none; cursor: pointer; border-radius: 5px;' onclick=\"window.location.href='P2.html#page2'\">Back</button>
    </div>";
    $stmt->close();
    $conn->close();
}
?>

</body>

</html>
