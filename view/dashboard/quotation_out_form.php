<?php
include('./PDF_set/PDF_conn.php');
include('./PDF_set/readprice.php');
$id = $_GET["pdfquoout_id"];
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


// $a = file_get_contents('./quotation_PDF/quotation_content.php');
// $stylesheet = file_get_contents('./PDF_set/PDF.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
// $mpdf->WriteHTML($a, \Mpdf\HTMLParserMode::HTML_BODY);
// $mpdf->Output('./quotation_PDF/quotation_appraisal0.pdf'); //link web of file pdf


$sql = "SELECT * FROM `quotation_out` WHERE quoout_id = '$id'";
$result = mysqli_query($conn, $sql);
while ($infoquo = mysqli_fetch_array($result)) {
    $head = '
<div id="quotationForm" class="container mt-5" style="width: 842px;">
    <div>
        <table>
            <tr>
                <td style="width:250px;">
                    <div class="logo">
                        <img src="../../image/addpay-form-text.png" class="img-fluid position-relative" width="200" hight="auto" alt="addpay_logo_form">
                    </div>
                </td>
                <td style="width:592px;">
                    <div style="margin-left: 60px;">
                        <b class="text-left">บริษัท แอดเพย์ เซอร์วิสพอยท์ จํากัด</b><br>
                        <p class="text-left">406 หมู่ 18 ตําบลขามใหญ่ อําเภอเมือง จังหวัดอุบลราชธานี โทร. 045-317123</p>
                    </div>
                </td>
            </tr>
        </table>
        <table>

            <tr style=" border-collapse: collapse; padding: 0; margin: 0;">
                <td class="text-center" style="width: 200px;  border: 1px solid; padding: 8px;" ROWSPAN="2">
                    <b>ใบเสนอราคา</b><br>
                    <b>Quotation</b>
                </td>
                <td  style="text-align: right; width: 500px; border-collapse: collapse; padding: 0; margin: 0;">เลขที่/No.</td>
                
                <td class="underline" style="text-align: center; width: 142px;">
                    <p class="text-left"> <span>&nbsp;' . $infoquo['quoout_no']  . ' &nbsp;&nbsp;</span> </p>
                </td>

            </tr>
            <tr >
                <td style="text-align: right; border-collapse: collapse; padding: 0; margin: 0;">วันที่/Date.</td>
                <td class="underline" style="text-align: center;">
                    <p class="text-left"> <span>&nbsp;' . $infoquo['quoout_date']  . ' &nbsp;&nbsp;</span> </p>
                </td>
                
            </tr>
        </table>
    </div>

    <div>
        <table style="margin-top: 5px;">
            <tr>
                <td style="width:200px;">
                    <p class="text-left ">ชื่อ ลูกค้า :</p>
                </td>
                <td class="underline" style="width:642px;">
                    <p class="text-left "> <span>&nbsp; ' . $infoquo['quoout_name'] . ' &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            <tr>
                <td style="width:200px;">
                    <p class="text-left ">ที่อยู่ :</p>
                </td>
                <td class="underline" style="width:642px;">
                    <p class="text-left"> <span>&nbsp;' . $infoquo['quoout_address'] . ' &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            <tr>
                <td style="width:200px;">
                    <p class="text-left ">เลขประจำตัวผู้เสียภาษี : </p>
                </td>
                <td class="underline" style="width:642px;">
                    <p class="text-left "> <span>&nbsp;' . $infoquo['quoout_numtax'] . ' &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            
        </table>
    </div>
</div>


<div>
    <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin: 0; margin-top:5px;">
        <tr style="background-color:LightGray; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
            <th class="text-center" style="border-left: 1px solid; width: 59px;">ลำดับที่</th>
            <th class="text-center" style="border-left: 1px solid; width: 497px;">รายการ / Description</th>
            <th class="text-center" style="border-left: 1px solid; width: 67px;">จำนวน<br>Amount</th>
            <th class="text-center" style="border-left: 1px solid; width: 109px;">ราคา / หน่วย<br>Unit / Price</th>
            <th class="text-center" style="border-left: 1px solid; width: 109px;">จำนวนเงิน<br>บาท</th>
        </tr>

';
}


$sql = "SELECT * FROM `quotation_out_details` WHERE quooutde_quooutid = '$id';";
$result = mysqli_query($conn, $sql);
$contentitems = "";
if (mysqli_num_rows($result) > 0) {
    $i = 0;
    while ($infoquoitems = mysqli_fetch_assoc($result)) {
        $i++;
        $contentitems .= '<tr>
        <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;">' . $i . '</td>
        <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:50px;">' . $infoquoitems['quooutde_item'] . '</td>
        <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;">' . $infoquoitems['quooutde_amount'] . '</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;">' . number_format($infoquoitems['quooutde_price'],2) . '</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;">' . number_format($infoquoitems['quooutde_result'],2) . '</td>
    </tr>';
    }
}

$head1 = ' ';
$sql = "SELECT * FROM `quotation_out` WHERE quoout_id = '$id'";
$result = mysqli_query($conn, $sql);
$contentsum = "";
if (mysqli_num_rows($result) > 0) {

    while ($infoquosum = mysqli_fetch_assoc($result)) {
        $contentsum .= ' 
        
        <tr>
            <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;"></td>
            <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:50px;"></td>
            <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;"></td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;"></td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;"></td>
        </tr>
        <tr>
            <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;"></td>
            <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:50px;"></td>
            <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;"></td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;"></td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;"></td>
        </tr>

        <tr style="background-color:LightGray; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
            <td style=" border:1px solid; border-collapse: collapse; padding: 5px; margin: 0;" VALIGN="TOP" ROWSPAN="5" colspan="2">
            <p>
                หมายเหตุ <br>
                ราคาขาย หน่วยเป็นบาท และขอยืนยันราคา 30 วันนับจากวันที่ออกใบเสนอราคา <br>
                ใบเสนอราคา/ ใบสั่งซื้อนี้ถือเป็นส่วนหนึ่งของสัญญา <br>
                ขอขอบคุณที่ให้ความไว้วางใจในสินค้าและบริการของบริษัท แอดเพยเ์ซอร์วิสพอยท์ จำกัด <br>
            </p>
            </td>

            <td style="text-align: right; border-left: 0px solid;" colspan="2">รวมเงิน</td>
            <td style="text-align: right; border-left: 1px solid;">' . number_format($infoquosum['quoout_sum'],2) . '</td>
        </tr>

            <tr style="background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <td style="text-align: right; border-left: 0px solid; color:red;" colspan="2">หักส่วนลดพิเศษ</td>
                <td style="text-align: right; border-left: 1px solid;">' . number_format($infoquosum['quoout_specialdis'],2) . '</td>
            </tr>
            <tr style="background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <td style="text-align: right; border-left: 0px solid;" colspan="2">ยอดรวมหลังหักส่วนลด</td>
                <td style="text-align: right; border-left: 1px solid;">' . number_format($infoquosum['quoout_afterdis'],2) . '</td>
            </tr>
            <tr style="background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <td style="text-align: right; border-left: 0px solid;" colspan="2">ภาษีมูลค่าเพิ่ม 7%</td>
                <td style="text-align: right; border-left: 1px solid;">' . number_format($infoquosum['quoout_vat'],2) . '</td>
            </tr>
            <tr style=" background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <td style="text-align: right; border-left: px solid;" colspan="2">จำนวนเงินรวมทั้งสิน</td>
                <td style="text-align: right; border-left: 1px solid;">' . number_format($infoquosum['quoout_total'],2) . '</td>
            </tr>

        </tr>
    </table>

</div>
       
';
    }
}

$head2 = ' ';
$sql = "SELECT quoout_total FROM `quotation_out` WHERE quoout_id = '$id'";
$result = mysqli_query($conn, $sql);
$footer = "";
if (mysqli_num_rows($result) > 0) {
    while ($infoquotext = mysqli_fetch_assoc($result)) {
        $footer .= '
        <div>
        <table style="text-align: left; width:842px; border:1px solid; border-collapse: collapse; padding: 0; margin-top: 10px;">
            <tr style="border-bottom: 1px solid;">
                <td VALIGN="TOP" style="text-align: left;  width: 20%; padding:5px 10px;">จำนวนเงินตัวอักษร <br> The Sum Of Bahts </td>
                <td VALIGN="TOP" style="text-align: left;  width: 80%; padding:5px 10px;">' . Convert($infoquotext['quoout_total']) . '</td>
            </tr>
        </table>
        <!-- footer -->
        <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin-top: 10px; ">
            <tr>
                <td VALIGN="TOP" style="text-align: center; width: 50%; border:1px solid; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                    <p> ยินดีรับข้อเสนอของ บริษัท แอดเพย์ เซอร์วิสพอยท์ จำกัด </p>
                    <br><br><br><br><br>
                    <p> ผู้อนุมัติสั่งซื้อ / Customer Signature </p>
                    <p> วันที่&nbsp;................................................................................</p>
                </td>
                <td VALIGN="TOP" style="text-align: center; width: 50%; border:1px solid; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                    <p>ขอแสงความนับถือ</p>
                    <br><br><br><br><br>
                    <p>ผู้มีอำนาจลงนาม / Authorlzed Siganture</p>

                    <!-- วันที่ในใบเสนอราคา -->
                    <p>วันที่ 11 มกราคม 2564</p>
                </td>

        </table>
    </div>
        ';
    }
}

$stylesheet = file_get_contents('./PDF_set/PDF.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($head);
$mpdf->WriteHTML($contentitems);
$mpdf->WriteHTML($contentsum);
$mpdf->WriteHTML($footer);
$mpdf->WriteHTML($head1);
$mpdf->WriteHTML($head2);

mysqli_close($conn);

$mpdf->Output('./quotation_out_PDF/quotation_out0.pdf');



?>

<body>

    <div class="container py-md-5 px-md-4" style="width: 100%; ">
        <p class="text-end text-danger ">** โปรดตรวจสอบความถูกต้องของข้อมูลก่อนกด พิมพ์เอกสาร</p>
        <div class="mx-auto d-flex justify-content-end ">
            <a class="btn btn-outline-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold" role="button" href="./quotation_out_PDF/quotation_out0.pdf"><i class="fa-solid fa-print"></i> พิมพ์เอกสาร</a>
            <a class="btn btn-outline-danger px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold ms-3" role="button" href="./quotation_out_list.php"><i class="fa-regular fa-rectangle-xmark"></i> ยกเลิก</a>
        </div>
        <hr>
        <?php
        include("./quotation_out_PDF/quotation_out_content.php");
        ?>
    </div>

</body>

</html>