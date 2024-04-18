<?php
require('chinese.php');

$pdf=new PDF_Chinese();
$pdf->AddGBFont('simsun','宋体');
$pdf->AddPage();
$pdf->SetFont('simsun','',20);
$pdf->Write(10, iconv('utf-8', 'GBK', '简体中文汉字'));
$pdf->Output();
?>
