<?php
include('./PDF_set/PDF_conn.php');
include('./PDF_set/thaidate.php');
$id = $_GET["pdfdocout"];
?>

<?php
include("./PDF_set/PDF_head.php");

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
    'default_font_size' => 16,
]);

$sql = "SELECT * FROM `docout` WHERE docout_id = '$id'";
$result = mysqli_query($conn, $sql);
while ($infodoc = mysqli_fetch_array($result)) {
    $content = '
    <div class="container py-5" style="width: 842px;">
        <div class="main-body">
            <table>
                <tr>
                    <td class="pt-10" style="width: 250px;">
                        <img src="../../image/logo-addpay.png" alt="" width="200" hight="auto">
                    </td>

                    <td class="docright pt-10" style="width: 500px;">
                        <b>บริษัท แอดเพย์ เซอร์วิสพอยท์ จำกัด
                            ADDPAY SERVICE POINT CO.,LTD.
                            406 หมู่ 18 ตำบลขามใหญ่ อำเภอเมือง จังหวัดอุบลราชธานี</b>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="padding-top: 20px;">ที่ อพ.</td>
                    <td style="padding-top: 20px;">'.$infodoc['docout_no'].'</td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: center;">
                    '.DateThai($infodoc['docout_date']).'
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="padding-top: 15px;">เรื่อง</td>
                    <td style="padding-top: 15px; padding-left:10px">'.$infodoc['docout_title'].'</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="">เรียน</td>
                    <td style=" padding-left:10px;">'.$infodoc['docout_to'].'</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="">สิ่งที่ส่งมาด้วย</td>
                    <td style=" padding-left:10px; ">'.$infodoc['docout_send'].'</td>
                </tr>
                <tr>
                    <td></td>
                    <td style=" padding-left:10px"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style=" padding-left:10px"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>'.$infodoc['docout_details'].'</td>
                </tr>
            </table>

            
            <table style="text-align: center; width: 100%;">
                <tr>
                    <td style=" padding-top:50px">
                        ขอแสดงความนับถือ <br><br><br><br>
                        ( '.$infodoc['docout_signame'].' )<br>
                        '.$infodoc['docout_position'].' <br>
                        บริษัท แอดเพย์ เซอร์วิสพอยท์ จำกัด
                    </td>
                </tr>
            </table>
            <div style="padding-top: 40px;">
                <label for="">ผู้ประสานงาน<br>
                    โทร. 085-4964855 , 045-317123<br>
                    แฟกซ์ 045-317678
                </label>
            </div>

        </div>
    </div>


    ';
}



$stylesheet = file_get_contents('./PDF_set/PDF.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($content);

mysqli_close($conn);

$mpdf->Output('./docout_PDF/docout_PDF.pdf'); //link web of file pdf

?>

<body>

    <div class="container  py-md-5 px-md-4" style="width: 100%;">
        <p class="text-end text-danger ">** โปรดตรวจสอบความถูกต้องของข้อมูลก่อนกด พิมพ์เอกสาร</p>
        <div class="mx-auto d-flex justify-content-end me-5">
            <a class="btn btn-outline-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold " role="button" href="./docout_PDF/docout_PDF.pdf"><i class="fa-solid fa-print"></i> พิมพ์เอกสาร</a>
            <a class="btn btn-outline-danger px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold ms-3" role="button" href="./docout_list.php"><i class="fa-regular fa-rectangle-xmark"></i> ยกเลิก</a>
        </div><hr>
        <?php
        include("./docout_PDF/docout_content.php");
        ?>
    </div>

</body>

</html>