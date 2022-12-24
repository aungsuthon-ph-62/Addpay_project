<?php
include("./quotation_PDF/quotation_head.php");

require_once __DIR__ . '../../../vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];


$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/fonts',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' =>  'THSarabunNew Bold.ttf',
        ]
    ],
    'default_font' => 'sarabun',
    'default_font_size' => 18,
]);


$a = file_get_contents('./quotation_PDF/quotation_content.php');
$stylesheet = file_get_contents('./quotation_PDF/quotation_PDF.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($a,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('./quotation_PDF/quotation_appraisal0.pdf'); //link web of file pdf

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Addpay-Project
    </title>

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../../image/addpaylogo.png" type="image/x-icon">
    <!-- FAVICON -->

    <!-- CSS -->
    <link rel="stylesheet" href="./quotation_PDF/quotation_PDF.css">
    <!-- CSS -->

</head>


<body>
    <div class="container  py-md-5 px-md-4" style="width: 100%;">
        <?php
        include("./docout_PDF/docout_content.php");
        ?>
    </div>
    <div class="mx-auto d-flex justify-content-end me-5">
        <a class="btn btn-danger px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button" href="./quotation_PDF/quotation_appraisal0.pdf"><i class="fa-solid fa-print"></i> พิมพ์เอกสาร</a>
    </div>
</body>
</html>