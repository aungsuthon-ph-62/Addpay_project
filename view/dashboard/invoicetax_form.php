<style>
    * {
        font-size: 14px;
    }

    .btn {
        transition: all 0.2s ease-in-out;
    }

    .btn:hover {
        border-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transform: scale(1.1);
    }

    .bg-primary-addpay {
        /* fallback for old browsers */
        background: #07aaf2;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, #07aaf2, #50b4df);

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to bottom, #079ad9, #07aaf2, #50b4df);
    }

    /* Darkblue Background Color */
    .bg-secondary-addpay {
        /* fallback for old browsers */
        background: #046197;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, #046197, #034266);

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to bottom, #046197, #034266);
    }

    /* Button Color */
    .btn-addpay {
        /* fallback for old browsers */
        background: #fe9100;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, #fdb04c, #fe9100);

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to bottom, #fdb04c, #fe9100);
    }
</style>
<link rel="stylesheet" href="./PDF_set/PDF.css">

<?php
include('./PDF_set/PDF_conn.php');
include('./PDF_set/readprice.php');
include('./PDF_set/thaidate.php');
$id = $_GET["pdfinvtax_id"];

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
        <table style="padding-bottom: 20px;">
            <tr>
                <td style="width:150px;" rowspan="4">
                    <div class="logo">
                        <img src="../../image/addpay-form-text.png" class="img-fluid position-relative" width="130" hight="auto" alt="addpay_logo_form">
                    </div>
                </td>
                <td style="width:472px; text-align: center;" rowspan="4">
                        <h3><b> บริษัท แอดเพยเ์ซอร์วิสพอยท์จำกัด (สำนักงานใหญ่)</b></h3>
                        <b> 406 หมู่ 18 ตําบลขามใหญ่ อําเภอเมือง จังหวัดอุบลราชธานี 34000</b><br>
                        <b> เลขประจำตัวผู้เสียภาษีอากร 0 3455 58001 37 0</b><br>
                        <b> โทร . 045-317123 Fax. 045-317678</b><br>
                  
                </td>
                
            </tr>
            <tr>
                <td  class="text-center" style="width:220px;  border: 1px solid; margin:0; " rowspan="2">
                        <h3><b>ใบแจ้งหนี้ / ใบกำกับภาษี</b></h3>
                </td>
            </tr>
            

        </table>

<!--php  ดึงข้อมูลลูกค้า -->
<table style="width: 842px; border:1px solid;border-bottom: 0; border-collapse: collapse; padding: 0; margin: 0;  margin-top: 10px; overflow: wrap;">
    <tr style="border-bottom: 0 solid;">
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 150px;">
            <b>ชื่อลูกค้า / Customer :</b> <br>
        </td>
        <td VALIGN="TOP" align="left" style=" width: 426px;">
            <b>' . $infoinvtax['invtax_name']  . '</b><br>
        </td>
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 266px;">
            <b>เลขที่ / No.</b> &nbsp;&nbsp;' . $infoinvtax['invtax_no']  . '<br>
        </td>
    </tr>
    <tr style="border-bottom: 0 solid;">
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 150px;">
            <b>ที่อยู่ / Address :</b><br>
        </td>
        <td VALIGN="TOP" align="left" style="width: 426px;">
        <b>' . $infoinvtax['invtax_address']  . '</b><br>
        </td>
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 266px;">
            <b>วันที่ / Date.</b> &nbsp;&nbsp;' . ConvDate($infoinvtax['invtax_date'])  . '
        </td>
    </tr>
        <tr style="border-bottom: 0 solid;">
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 150px;">
            <b>เลขประจำตัวผู้เสียภาษี :</b>
        </td>
        <td VALIGN="TOP" align="left" style=" width: 426px;">
            <b>' . $infoinvtax['invtax_cusid']  . '</b>
        </td>
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 266px;">
        </td>
    </tr>
</table>

<div>
<table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
    <tr style="border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
        <th class="text-center" style="border-left: 1px solid; width: 60px;">ลำดับที่<br> Item</th>
        <th class="text-center" style="border-left: 1px solid; width: 420px;">รายการ<br>Order</th>
        <th class="text-center" style="border-left: 1px solid; width: 96px;">จำนวน<br>Amount</th>
        <th class="text-center" style="border-left: 1px solid; width: 96px;">ราคา / หน่วย<br>Unit / Price</th>
        <th class="text-center" style="border-left: 1px solid; width: 170px;">จำนวนเงินรวม<br>Total</th>
    </tr>';




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
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:10px; padding: auto 5px;">' . number_format($infoinvtaxitems['invtaxd_price'], 2) . '</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:10px; padding: auto 5px;">' . number_format($infoinvtaxitems['invtaxd_result'], 2) . '</td>
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

        <tr style="text-align:center;  border:1px solid; border-bottom:0; border-collapse: collapse; padding: 0; margin: 0;">
            <td style=" text-align:center; border:1px solid; border-collapse: collapse; padding: 5px; margin: 0;" VALIGN="middle" ROWSPAN="3" colspan="2" >
                <b>' . Convert($infoinvtaxsum['invtax_total']) . '</b> <br> (ตัวอักษร)
            </td>

            <td style="text-align: right; border-right:1px solid; border-bottom:0;" colspan="2"><b>รวมมูลค่าสินค้า</b></td>
            <td style="text-align: right; border-right:1px solid; padding: auto 5px;">' . number_format($infoinvtaxsum['invtax_sum'], 2) . '</td>
        </tr>
        <tr style=" width: 100%; border-bottom:1px solid ; border-collapse: collapse; padding: 0; margin: 0;">
            <td style="text-align: right; border-right:1px solid; " colspan="2"><b>ภาษีมูลค่าเพิ่ม 7%</b></td>
            <td style="text-align: right; border-right:1px solid; border-bottom:1px solid ; border-top:1px solid ; padding: auto 5px;">' . number_format($infoinvtaxsum['invtax_vat'], 2) . '</td>
        </tr>
        <tr  style=" width: 100%;  border-bottom: 0; border-collapse: collapse; padding: 0; margin: 0;">
            <td style="text-align: right; border-right:1px solid;" colspan="2"><b>จำนวนเงินรวมทั้งสิ้น</b></td>
            <td style="text-align: right; border-right:1px solid; padding: auto 5px;">' . number_format($infoinvtaxsum['invtax_total'], 2) . '</td>
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
        <table style="width: 842px; border:1px solid; border-top:0; border-collapse: collapse; padding: 0; ">
            <tr>
                <td VALIGN="TOP" style=" width: 480px; border-right:1px solid; border-bottom: 0; border-collapse: collapse; padding: 10px; margin: 0;">
                    <br><b> ข้าพเจ้าได้รับเอกสารข้างต้นถูกต้องครบถ้วนแล้ว </b>
                </td>
            </tr>
            <tr>
                <td VALIGN="TOP" style="text-align: center; width: 480px; border-right:1px solid; border-bottom: 0;border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                    
                    <p >ผู้รับเอกสาร</p>
                    <br><br><br>
                    <p > (....................................................................)
                    </p>
                    <p > วันที่&nbsp;…………………/…………………/…………………</p>
                </td>
                <td VALIGN="BOTTOM" style="text-align: center; width: 362px; border-right:1px solid; border-top: 0; border-bottom: 0;border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                    <p>(นายวรกฤต ศิรธนิตรา)</p>
                    <p>ผู้มีอำนาจลงนาม</p>
                    <!-- วันที่ในใบเสนอราคา -->
                    <p> วันที่&nbsp;…………………/…………………/…………………</p>
                    <p>เลขบัญชี 850-6000-548 ธนาคารกรุงไทย สาขาสุนีย์</p>
                </td>
            </tr>
                
            
                
        </table>
        
        <table style="margin-top:10px;">
                <tr>
                    <td style="width:842px; text-align: center; ">
                        <label>&nbsp;กรุณาตรวจสอบเอกสารและหัก ณ ที่จ่าย (ถ้ามี) พร้อมส่งหนังสือรับรองการหักภาษี ณ ที่จ่ายมาด้วยทุกครั้งที่ชำระเงิน</label>
                    </td>
                </tr>
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

$mpdf->Output('./invoicetax_PDF/invoicetax0.pdf');



?>


<style>
    * {
        font-size: 14px;
    }

    .btn-pdf {
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
        <p style="font-size: 16px;" class="text-end text-danger ">** โปรดตรวจสอบความถูกต้องของข้อมูลก่อนกด พิมพ์เอกสาร</p>
        <div class="mx-auto d-flex justify-content-end me-5">
            <a class="btn btn-addpay px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold text-light" role="button" href="./invoicetax_PDF/invoicetax0.pdf"><i class="fa-solid fa-print"></i> พิมพ์เอกสาร</a>
        </div>
        <hr>
        <?php
        include("./invoicetax_PDF/invoicetax_content.php");
        ?>
    </div>

</body>

</html>