<?php
require_once __DIR__ . '/tcpdf/tcpdf.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "portfolio_form";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve ID from URL parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id == 0) {
    die("Invalid ID.");
}

// Fetch user data from the database
$sql = "SELECT * FROM form_portfolio WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("No record found.");
}

$row = $result->fetch_assoc();

// Create PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($row['Full_Name']);
$pdf->SetTitle('Portfolio - ' . $row['Full_Name']);
$pdf->SetHeaderData('', 0, 'Generated Portfolio', '');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetMargins(15, 10, 15);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->AddPage();

// Title
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 10, "Portfolio of " . $row['Full_Name'], 0, 1, 'C');
$pdf->Ln(5);

// Image Path Handling
$imagePath = __DIR__ . "/" . trim($row['photo']); // Use the full path from DB

if (!empty($row['photo']) && file_exists($imagePath)) {
    $pdf->Image($imagePath, 15, $pdf->GetY(), 50); // Adjust size as needed
    $pdf->Ln(55); // Add space after image
} else {
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, "Image not available", 0, 1, 'C');
}

// Display user data
$pdf->SetFont('helvetica', '', 12);
$html = '
    <h3 style="background-color:#d3d3d3; padding:5px;">Personal Information</h3>
    <p><strong>Full Name:</strong> ' . $row['Full_Name'] . '</p>
    <p><strong>Contact Info:</strong> ' . $row['contact_info'] . '</p>
    <p><strong>Biography:</strong> ' . nl2br($row['biography']) . '</p>

    <h3 style="background-color:#d3d3d3; padding:5px;">Skills</h3>
    <p><strong>Soft Skills:</strong> ' . $row['soft_skills'] . '</p>
    <p><strong>Technical Skills:</strong> ' . $row['technical_skills'] . '</p>

    <h3 style="background-color:#d3d3d3; padding:5px;">Academic Background</h3>';
if (!empty($row['institute'])) {
    $html .= '<p><strong>Institute:</strong> ' . $row['institute'] . '</p>';
}
if (!empty($row['degree'])) {
    $html .= '<p><strong>Degree:</strong> ' . $row['degree'] . '</p>';
}
if (!empty($row['year'])) {
    $html .= '<p><strong>Year:</strong> ' . $row['year'] . '</p>';
}
if (!empty($row['grade'])) {
    $html .= '<p><strong>Grade:</strong> ' . $row['grade'] . '</p>';
}

$html .= '
    <h3 style="background-color:#d3d3d3; padding:5px;">Work Experience</h3>
    <p><strong>Company Name:</strong> ' . $row['company_name'] . '</p>
    <p><strong>Job Duration:</strong> ' . $row['job_duration'] . '</p>
    <p><strong>Job Responsibility:</strong> ' . nl2br($row['job_responsibility']) . '</p>

    <h3 style="background-color:#d3d3d3; padding:5px;">Previous Projects & Publications</h3>';
if (!empty($row['previous_project'])) {
    $html .= '<p><strong>Previous Project:</strong> ' . $row['previous_project'] . '</p>';
}
if (!empty($row['previous_publication'])) {
    $html .= '<p><strong>Previous Publication:</strong> ' . $row['previous_publication'] . '</p>';
}

// Write HTML to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF
$pdf->Output('portfolio_' . $id . '.pdf', 'I'); // 'I' to display in browser, 'D' to force download

$conn->close();
?>
