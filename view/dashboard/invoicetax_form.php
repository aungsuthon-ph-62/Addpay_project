<?php
include('./PDF_set/PDF_conn.php');
include('./PDF_set/readprice.php');
$id = $_GET["pdfinvtax_id"];
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

$sql = "SELECT * FROM invoicetax WHERE invtax_id = '$id'";
$query = $conn->query($sql);
$infoinvtax = $query->fetch_assoc();
$head = '
<div id="invtaxtForm" class="container mt-5" style="width: 842px;">
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
                    <b>ใบแจ้งหนี้/ ใบกำกับภาษี</b>
                </td>
                <td  style="text-align: right; width: 500px; border-collapse: collapse; padding: 0; margin: 0;">เลขที่/No.</td>
                
                <td class="underline" style="text-align: center; width: 142px;">
                    <p class="text-left"> <span>&nbsp;' . $infoinvtax['invtax_no']  . ' &nbsp;&nbsp;</span> </p>
                </td>

            </tr>
            <tr >
                <td style="text-align: right; border-collapse: collapse; padding: 0; margin: 0;">วันที่/Date.</td>
                <td class="underline" style="text-align: center;">
                    <p class="text-left"> <span>&nbsp;' . $infoinvtax['invtax_date']  . ' &nbsp;&nbsp;</span> </p>
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
                    <p class="text-left "> <span>&nbsp; ' . $infoinvtax['invtax_name'] . ' &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            <tr>
                <td style="width:200px;">
                    <p class="text-left ">ที่อยู่ :</p>
                </td>
                <td class="underline" style="width:642px;">
                    <p class="text-left"> <span>&nbsp;' . $infoinvtax['invtax_address'] . ' &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            <tr>
                <td style="width:200px;">
                    <p class="text-left ">เลขประจำตัวผู้เสียภาษี : </p>
                </td>
                <td class="underline" style="width:642px;">
                    <p class="text-left "> <span>&nbsp;' . $infoinvtax['invtax_cusid'] . ' &nbsp;&nbsp;</span> </p>
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



$sql = "SELECT * FROM invoicetax_details WHERE invtaxd_tid = '$id';";
$result = mysqli_query($conn, $sql);
$contentitems  = "";
if (mysqli_num_rows($result) > 0) {
    $i = 0;
    while ($infoinvtaxitems = mysqli_fetch_assoc($result)) {
        $i++;
        $contentitems .= '<tr>
        <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:10px;">' . $i . '</td>
        <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:10px;">' . $infoinvtaxitems['invtaxd_item'] . '</td>
        <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:10px;">' . $infoinvtaxitems['invtaxd_amount'] . '</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:10px;">' . number_format($infoinvtaxitems['invtaxd_price'], 2) . '</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:10px;">' . number_format($infoinvtaxitems['invtaxd_result'], 2) . '</td>
    </tr>';
    }
}

$head1 = ' ';
$sql = "SELECT * FROM invoicetax WHERE invtax_id = '$id'";
$result = mysqli_query($conn, $sql);
$contentsum = "";
if (mysqli_num_rows($result) > 0) {

    while ($infoinvtaxsum = mysqli_fetch_assoc($result)) {
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

        <tr style="text-align:center; background-color:LightGray; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
            <td style=" text-align:center; border:1px solid; border-collapse: collapse; padding: 5px; margin: 0;" VALIGN="TOP" ROWSPAN="5" colspan="2" >
                ' . Convert($infoinvtaxsum['invtax_total']) . ' <br> (ตัวอักษร)
            </td>

            <td style="text-align: right; border-left: 0px solid;" colspan="2">รวมเงิน</td>
            <td style="text-align: right; border-left: 1px solid;">' . number_format($infoinvtaxsum['invtax_sum'], 2) . '</td>
        </tr>
            <tr style="background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <td style="text-align: right; border-left: 0px solid;" colspan="2">ภาษีมูลค่าเพิ่ม 7%</td>
                <td style="text-align: right; border-left: 1px solid;">' . number_format($infoinvtaxsum['invtax_vat'], 2) . '</td>
            </tr>
            <tr style=" background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <td style="text-align: right; border-left: px solid;" colspan="2">จำนวนเงินรวมทั้งสิน</td>
                <td style="text-align: right; border-left: 1px solid;">' . number_format($infoinvtaxsum['invtax_total'], 2) . '</td>
            </tr>

        </tr>
    </table>

</div>
       
';
    }
}

$head2 = ' ';
$sql = "SELECT invtax_total FROM invoicetax WHERE invtax_id = '$id'";
$result = mysqli_query($conn, $sql);
$footer = "";
if (mysqli_num_rows($result) > 0) {
    while ($infoinvtaxtext = mysqli_fetch_assoc($result)) {
        $footer .= '
        <div>
        <!-- footer -->
        <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin-top: 10px; ">
            <tr>
                <td VALIGN="TOP" style="text-align: center; width: 50%; border:1px solid; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                    <p> ข้าพเจ้าได้รับเอกสารข้างต้นถูกต้องครบถ้วนแล้ว </p>
                    <p>ผู้รับเอกสาร</p>
                    <br><br><br><br><br>
                    <p> (....................................................................)
                    </p>
                    <p> วันที่&nbsp;…………………/…………………/…………………</p>
                </td>
                <td VALIGN="BOTTOM" style="text-align: center; width: 50%; border:1px solid; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                    <p>(นายวรกฤต ศิรธนิตรา)</p>
                    <p>ผู้มีอำนาจลงนาม</p>
                    <!-- วันที่ในใบเสนอราคา -->
                    <p>วันที่ 11 มกราคม 2564</p>
                    <p>เลขบัญชี 850-6000-548 ธนาคารกรุงไทย สาขาสุนีย์</p>
                </td>
                
        </table>
        
        <p style="text-align: center;">กรุณาตรวจสอบเอกสารและหัก ณ ที่จ่าย (ถ้ามี)พร้อมส่งหนังสือรับรองการหักภาษี ณ ที่จ่ายมาด้วยทุกครั้งที่ชำระเงิน</p>
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

$mpdf->Output('./invoicetax_PDF/invoicetax0.pdf');



?>


<style>
.btn-pdf{
    background: #fe9100; 
    background: -webkit-linear-gradient(to right, #fdb04c, #fe9100); 
    background: linear-gradient(to bottom, #fdb04c, #fe9100);
}
.btn-pdf:hover {
    border-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transform: scale(1.1);
}

</style>

<body>

    <div class="container py-md-5 px-md-4" style="width: 100%; ">
        <p class="text-end text-danger ">** โปรดตรวจสอบความถูกต้องของข้อมูลก่อนกด พิมพ์เอกสาร</p>
        <div class="mx-auto d-flex justify-content-end me-5">
            <a class="btn btn-pdf px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold text-light" role="button" href="./invoicetax_PDF/invoicetax0.pdf"><i class="fa-solid fa-print"></i> พิมพ์เอกสาร</a>
        </div>
        <hr>
        <?php
        include("./invoicetax_PDF/invoicetax_content.php");
        ?>
    </div>

</body>

</html>