<?php
require('../fpdf.php');
session_start();
if(!isset($_SESSION["company"]) || !isset($_SESSION["name"])) {
    header("Location: ../form/error.php?err=nosetCN");
    exit();
} else if(!isset($_SESSION["eName"]) || !isset($_SESSION["location"])) {
    header("Location: ../form/error.php?err=nosetEL");
    exit();
} else {
    $company = $_SESSION["company"];
    $name = $_SESSION["name"];
    $event = $_SESSION["eName"];
    $location = $_SESSION["location"]; 
    $fDate = date('l F jS, Y', strtotime($_SESSION['date']));
    $sTime = date('h:i a', strtotime($_SESSION['sTime']));
    $eTime = date('h:i a', strtotime($_SESSION['eTime']));
}
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../img/logo-SP.png', 48, 12, 200);
        // Line break
        $this->Ln(56);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Printed on '. date("m/d/Y"). ' - Valid through '. $_SESSION['date'] . ' : ' . $_SESSION['count'],0,0,'C');
    }
}   
// Instantiation of inherited class
$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',32);
$pdf->Cell(0, 20, $company, 0, 1, 'C');
$pdf->Cell(0, 20, $event, 0, 1, 'C');
$pdf->Cell(0, 15, $fDate, 0, 1, 'C');
$pdf->Cell(0, 15,  $sTime . ' - ' . $eTime, 0, 1, 'C');
$pdf->Cell(0, 15, 'Location: ' . $location, 0, 1, 'C');
$pdf->SetFont('Arial','I', 12);
$pdf->Cell(0, 10, '', 0, 1, 'C');
$pdf->Cell(0, 5, 'Display clearly on dashboard of vehicle.', 0, 1, 'C');
$pdf->Cell(0, 5, 'Destroy after use.', 0, 1, 'C');
$pdf->Cell(0, 5, 'Any abuse, unauthorized reproduction or alteration of this permit.', 0, 1, 'C');
$pdf->Cell(0, 4, 'may result in ticketing or loss of parking privileges.', 0, 1, 'C');
$pdf->Output();

session_destroy();
?>
