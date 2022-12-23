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

// $mpdf = new \Mpdf\Mpdf([
//     'mode' => 'utf-8', 'format' => 'A4-P',
//     'fontdata' => $fontData + [
//         'Sarabun' => [
//             'R' => 'Sarabun-Regular.ttf',
//             'I' => 'Sarabun-Italic.ttf',
//         ]
//     ]
// ]);

$a = file_get_contents("./quotation_PDF/quotation_content.php");

$mpdf->WriteHTML($a);
$mpdf->Output('./quotation_PDF/quotation_appraisal0.pdf'); //link web of file pdf

?>


<style>
    body {
        font-family: 'Sarabun', sans-serif;
    
    }
    .text-center{
        justify-items: center;
        align-items: center;
    }
    .text-left{
        justify-items: left;
    }
    .text-right{
        justify-items: right;
    }
</style>

<body>
    <div class="container  py-md-5 px-md-4" style="width: 100%;">
        <?php
        include("./quotation_PDF/quotation_content.php");
        ?>
    </div>
    <div class="mx-auto d-flex justify-content-end me-5">
        <a class="btn btn-danger px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button" href="./quotation_PDF/quotation_appraisal0.pdf"><i class="fa-solid fa-print"></i> พิมพ์เอกสาร</a>
    </div>
</body>