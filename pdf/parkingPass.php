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
}
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Cell(0, 20, 'SPECAIL PARKING', 0, 1, 'C');
        $this->Image('../img/logo.png', 48, 12, 200);
        // Line break
        $this->Ln(56);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',14);
        // Page number
        $this->Cell(0,10,'Printed on '. date("m/d/Y"). ' - Valid through '. $_SESSION["date"]. '',0,0,'C');
    }
}   
// Instantiation of inherited class
$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',48);
$pdf->Cell(0, 20, $company, 0, 1, 'C');
$pdf->SetFont('Times','',36);
$pdf->Cell(0, 20, $event, 0, 1, 'C');
$pdf->SetFont('Times','',28);
$pdf->Cell(0, 15, $location, 0, 1, 'C');
$pdf->Cell(0, 15, ''. $_SESSION["date"]. ' from '. $_SESSION["sTime"]. ' to ' . $_SESSION["eTime"] . '', 0, 1, 'C');
$pdf->Output();

session_destroy();
?>
