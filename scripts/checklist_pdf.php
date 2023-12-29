<?php

require_once('../etc/const.php');

require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ChecklistAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');


require ('chinese.php');

//ini_set('display_errors', 1);
//error_reporting(E_ALL);

class HeaderFooterPDF extends PDF_Chinese
{
    
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-20);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Text color in gray
        $this->SetTextColor(128);
        // Page number
        $this->Cell(0,10,'Post address: PO Box K595, Haymarket，NSW 1240, Australia',0,0,'C');
        $this->Ln(5);
        $this->Cell(0,10,'Office address: Suite 309-311 Sussex Centre. 401 Sussex St. Sydney, 2000',0,0,'C');
        $this->Ln(5);
        $this->Cell(0,10,'Tel: 00612 9281 6299  www.geic.com.au',0,0,'C');
    }
}

$cl_act = isset($_REQUEST['cl_act'])? $_REQUEST['cl_act'] : '';
$cl_typ = isset($_REQUEST['cl_typ'])? $_REQUEST['cl_typ'] : '';
$cl_appid = isset($_REQUEST['cl_appid'])? $_REQUEST['cl_appid'] : 0;
$cl_tplid = isset($_REQUEST['cl_tplid'])? $_REQUEST['cl_tplid'] : 0;

if (!$cl_typ || !$cl_appid)
    die('Incorrect parameters');

$o_check = new ChecklistAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


$pdf=new HeaderFooterPDF();
$pdf->AddGBFont('simsun','宋体');
$pdf->AddPage();
$pdf->SetFont('simsun','',10);

$visa = $o_c->getApplyVisa(0, $cl_appid);

$i = 1;
$pdf->Cell(10, 40, $pdf->Image(__ROOT_PATH.'/css/images/global2.png',0,0,200,60), 0, 'L', false );
$pdf->Ln(50);
$pdf->Cell(8, 10, date("m/d/Y"), 0, 'L', false);
$pdf->Ln(5);

$client = $o_c->getOneClientInfo($visa[$cl_appid]['cid']);
$pdf->Cell(0, 10, $client['fname']. ' '. $client['lname'], 0, 'L', false);
$pdf->Ln(5);

$pdf->Cell(0, 10, $visa[$cl_appid]['visa'].' '.$visa[$cl_appid]['class'], 0, 'L', false);
$pdf->Ln(10);

//Page width - cell#1 - cell#2 - left margin -right magin
$ln_break = 210-8-20-10-10 + 0.0;

//Table Title
$pdf->Cell(8,10,'No.',1,0,'C');
$pdf->Cell(20, 10, 'Received', 1, 'C');
$pdf->MultiCell(0, 10, 'Item', 1,'C');

foreach ($o_check->getApp($cl_typ, $cl_appid, false) as  $row) {
    $title = trim(preg_replace("/(\n){2,}/", "\n", $row['tit']));
    $title_lines = explode("\n", $title);
    $count = count($title_lines);
    foreach ($title_lines as $l) {
        if (round($pdf->GetStringWidth($l)) >= $ln_break)
            $count++;
    }
    
    $pdf->Cell(8,10*$count,$i++,1,0,'L');
    $pdf->Cell(20, 10*$count, ($row['rcd'] > '0000-00-00'? $row['rcd'] : ''), 1, 'L');
    $pdf->MultiCell(0,10, $title,1,'L');
}

$pdf->Output();
?>