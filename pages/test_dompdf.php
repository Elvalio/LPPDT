<?php
require '../vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml('<h1>Test Dompdf</h1>');
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('test.pdf', ['Attachment' => false]);
?>